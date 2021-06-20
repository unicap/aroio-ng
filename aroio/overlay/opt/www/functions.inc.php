<?php
include('strings.php');

function deliver_logs()
{
    exec('aroio_prepare_logs');
    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . '/getlogs.php');
	die();
}

function scanwifi()
{
    $wlan_ip=get_ipaddr_wlan();
	if( $wlan_ip[0] == '192.168.99.1' ){
        $wifiscan=exec('iw dev wlan0 scan ap-force 2>/dev/null | sed \'s/\"//g\' | awk -F":" \'/SSID/{if ($2) print $2}\' | sort -u  ',$wifilist);
	}
    else {
        $wifiscan=exec('ip link set wlan0 up && iw dev wlan0 scan 2>/dev/null | sed \'s/\"//g\' | awk -F":" \'/SSID/{if ($2) print $2}\' | sort -u ',$wifilist);
    }
    array_unshift($wifilist, "");
	return $wifilist;
}

function validate_input($case,$input)
{
	switch ($case)
	{
	case "IPADDR":
		$check='/^(\b(?:\d{1,3}\.){3}\d{1,3}\b)$/';
		break;
    case "HOSTNAME":
    	$check='/^$|[0-9a-zA-Z]([0-9a-zA-Z\-]{0,61}[0-9a-zA-Z])?(\.[0-9a-zA-Z](0-9a-zA-Z\-]{0,61}[0-9a-zA-Z])?)*$/';
    	break;
	case "HOSTNAMEORIP":
    	//$check='/^([A-Za-z0-9]+(?:-[A-Za-z0-9]+)*(?:\.[A-Za-z0-9]+(?:-[A-Za-z0-9]+)*)*$)|(\b(?:\d{1,3}\.){3}\d{1,3}\b)/' ;
    	$check='/^([A-Za-z0-9]+(?:-[A-Za-z0-9]+)*(?:\.[A-Za-z0-9]+(?:-[A-Za-z0-9]+)*)*$)|(\b(?:\d{1,3}\.){3}\d{1,3}\b)/' ;
       	break;
    case "LMS":
    	//$check='/^([A-Za-z0-9]+(?:-[A-Za-z0-9]+)*(?:\.[A-Za-z0-9]+(?:-[A-Za-z0-9]+)*)*$)|(\b(?:\d{1,3}\.){3}\d{1,3}\b)/' ;
    	$check='/^$|([A-Za-z0-9]+(?:-[A-Za-z0-9]+)*(?:\.[A-Za-z0-9]+(?:-[A-Za-z0-9]+)*)*$)|(\b(?:\d{1,3}\.){3}\d{1,3}\b)/' ;
       	break;
    case "NETMASK":
       	$check='/^(((0|128|192|224|240|248|252|254).0.0.0)|(255.(0|128|192|224|240|248|252|254).0.0)|(255.255.(0|128|192|224|240|248|252|254).0)|(255.255.255.(0|128|192|224|240|248|252|254)))$/';
       		break;
	case "SERVERPORT":
		$check='/^$|(\b([1-9][0-9]{0,3}|[1-5][0-9]{4}|60[0-9]{3}|61000)\b)$/';
		break;
		// Fehler:
		default:
       		return 0;
	}

	if ( preg_match($check, $input) )
	{
		return 1;
	}
	else
	{
		return 0;
	}
}

function write_config()
{
	foreach($_POST as $key=> $value)
		{
			wrtToUserconfig($key,$value);
		}
}


//Gibt Systembefehle in eigenen div aus
function print_cmdout($command)
{
	exec($command,$arr_out);
	$out = '<div class="system">';
	foreach($arr_out as $line)
	{
		$out .= $line.'<br>';
	}
	$out .= '<div>';
	echo $out;
}

function echo_uptime()
{
	$uptime=exec("uptime | awk '{print $1}'");
	return $uptime;
}

function echo_ps()
{
	echo '<pre>';
	passthru('ps');
	echo '</pre>';
}

function echo_iwlist()
{
	echo '<pre>';
	passthru('iw dev wlan0 2>/dev/null');
	echo '</pre>';
}


// 0 für nix und 1 für Kabel steckt
function echo_carrierstate()
{
	$carrierstate=exec('cat /sys/class/net/eth0/carrier');
	return $carrierstate;
}

// MAC-Adresse eth
function echo_mac_lan()
{
	$mac_lan=exec('cat /sys/class/net/eth0/address');
	return $mac_lan;
}

// MAC-Adresse wlan
function echo_mac_wlan()
{
	$mac_wlan=exec('cat /sys/class/net/wlan0/address');
	return $mac_wlan;
}

// Ping Squeeze-Server
function ping_squeezeserver()
{
	exec("ping -c1 -W1 $(netstat -n -t | grep -o -E '\b([0-9]{1,3}\.){3}[0-9]{1,3}\b':3483 | grep -oE '\b([0-9]{1,3}\.){3}[0-9]{1,3}\b')" , $output , $return_var);
	return $return_var;
}

// IP-Adresse von eth0 rausfinden
function get_ipaddr_lan()
{
	exec("ifconfig eth0 | grep inet | grep 'inet addr' | awk -F: '{ print $2 }' | awk '{ print $1 }'" , $output);
	return $output;
}

// IP-Adresse von wlan0 rausfinden
function get_ipaddr_wlan()
{
	exec("ifconfig wlan0 | grep inet | grep 'inet addr' | awk -F: '{ print $2 }' | awk '{ print $1 }'" , $output);
	return $output;
}

function test_wlan()
{
#	exec("dmesg | grep -qe WLAN -e Realtek" , $output , $return_val);
#	return $return_val;
	if (file_exists("/sys/class/net/wlan0")) return "enabled";
}

function test_bt()
{
  if (!file_exists("/sys/class/bluetooth/hci0")) print "disabled";
}

function test_input()
{
  if (!file_exists("/proc/asound/card0/pcm0c")) print "disabled";
}

function restart_lms()
{
	shell_exec('killall startstreamer.sh');
	shell_exec('killall shairport');
	shell_exec('killall squeezelite');
	shell_exec('/usr/bin/startstreamer.sh &> /dev/null &');
}



//HTML-Functions


//Gibt Option Group aus
//$name : Name der Opt-Group
//$arr_values: auswählbare Optionen in Array

function print_optgroup($name,$arr_values,$sel_value)
{
	$out = '<select name="'.$name.'"class="actiongroup" > \n';
	foreach ($arr_values as $option)
	{
		if ($option != $sel_value)
			{ $out.='<option>'.$option.'</option> \n'; }
		else
			{ $out .= '<option selected>'.$sel_value.'</option> \n'; }
	}
	$out.='</select>';

	echo $out;
}


function print_optgroup2D($name,$arr_values,$sel_value)
{
	$out = '<select name="'.$name.'"class="actiongroup" > \n';
	foreach ($arr_values as $option)
	{
		if($option[0] != $sel_value)
		{
			$out.='<option value="'.$option[0].'">'.$option[1].'</option> \n';
		}
		else
		{
			$out .= '<option selected value="'.$sel_value.'">'.$option[1].'</option> \n';
		}
	}
	$out.='</select>';
	echo $out;
}

function get_audio_output($value)
{
	switch($value)
	{
		case "vol-plug-ms":
			return "vol-plug";
		case "jack-ms":
			return "jack";
		case "jack-bfms":
			return "jack-bf";
		default:
			return $value;
	}
}

// Adds "checked" if a setting is enabled
function check_if_on($setting)
{
	if ($setting == "ON") {
		echo "checked";
	}
}

function get_cleaner_enabled($output)
{
	$cleaner_players = array("vol-plug-ms", "jack-ms", "jack-bfms");
	if (in_array($output, $cleaner_players))
	{
		return true;
	}
	return false;
}

//liest die Filter aus Pfad aus und
function fltrSelect($id, $ini_array)
{
	//$directory = '/home/sftparoio'; //evtl als konstante bzw in config-file
	$directory = '/run/filter'; //evtl als konstante bzw in config-file
	if ($regexString=browseDirectory($directory)) {
	    /*while(false !== ($entry = readdir($handle)))
	    {
	        if ($entry != "." && $entry != "..") $regexString.=$entry.' ';
	    }
	    closedir($handle);*/

		$rate = (int)($ini_array["RATE"] / 1000);
		//$pattern = "/(\\w*)L|R(\\d*).dbl/";
		$pattern = "/(\\w*)(L|R)".$rate.".dbl/";

		//check if surround
		if ($ini_array["CHANNELS"] == 4)
		{
			$pattern = "/(\\w*)S(L|R)".$rate.".dbl/";
		}

		preg_match_all($pattern, $regexString, $banks); // in $banks[1] Coeffset-Name
		$result = array_unique($banks[1]);

		$out = '<select class="filter" name="coeff'.$id.'">';
		if ($ini_array["COEFF_NAME"."$id"] == "" || empty($ini_array["COEFF_NAME"."$id"]))
		{
			$out .= '<option selected>BypassFilter</option>';
		}

		foreach ($result as &$option) {
			if ($ini_array["COEFF_NAME"."$id"] == $option)
			{
				$out .= '<option selected>'.$option.'</option>';
			}
			else
			{
				$out .= '<option>'.$option.'</option>';
			}
		}

		$out .= '</select>';
		return $out;
	}

}

//Browse Directory and return array
function browseDirectory($directory)
{
	if ($handle = opendir($directory)) {
	    while(false !== ($entry = readdir($handle)))
	    {
	        if ($entry != "." && $entry != "..") $dirArr.=$entry.' ';
	    }
	    closedir($handle);
	    return $dirArr;
	}
	else return null;
}


//Gibt den Text aus File in eigenem div aus
//$file: Name des Files im Root-Verzeichnis
function print_txtrelative($file)
{
	$path='/var/log/'.$file;
	$handle = fopen($path,r);
	$out='<div class="system">';
	while($inhalt = fgets ($handle, 4096 ))
	{
		$out.=$inhalt.'<br>';
	}
	$out.='</div>';
	echo $out;
}

// Gibt journalctl Rueckgaben in eigenem div aus.
// $unit gibt zu übergebende unit an.
function print_journalctl($unit)
{
	exec("journalctl -b -u $unit",$arr_out);
	$out = '<div class="system">';
	foreach($arr_out as $line)
	{
		$out .= $line.'<br>';
	}
	$out .= '<div>';
	echo $out;
}

// Gibt journalctl -b in eigenem div aus.
function print_journalctl_boot()
{
	exec("journalctl -b",$arr_out);
	$out = '<div class="system">';
	foreach($arr_out as $line)
	{
		$out .= $line.'<br>';
	}
	$out .= '<div>';
	echo $out;
}

// Gibt Hardware-Parameter des ausgewaehlten Audio Geraetes zurueck.
function print_audio_hw_params()
{
	exec("controlaudio stop");
	exec("aplay --duration=1 -Dhw:0 --dump-hw-params /dev/zero 2>&1",$arr_out);
	exec("controlaudio start");
	$out = '<div class="system">';
	foreach($arr_out as $line)
	{
		$out .= $line.'<br>';
	}
	$out .= '<div>';
	echo $out;
}


//Gibt die korrekte Squeezebox Adresse aus
function print_squeezeaddr($port)
{
	if ($port=="") $port="9000";
	$out = exec("netstat -n -t | grep -o -E '\b([0-9]{1,3}\.){3}[0-9]{1,3}\b':3483 | grep -oE '\b([0-9]{1,3}\.){3}[0-9]{1,3}\b'");
	return $out .= ":".$port;
}


// PHP aktiver Filter für Filterset
function activeFilter()
{
	if(isset($_GET["filter"]))
	{
		switchFilter($_GET["filter"]);
		return $activeFilter = $_GET["filter"];
	}
	else
	{
		return $activeFilter = getFilter();
	}
}


//Filter-Control
function print_filterset($count,$ini_array)
{
    if($GLOBALS["lang"]=='en')
    {
        $out='<table><thead><tr>
        <td>Bank</td>
        <td>Note</td>
        <td>Filter</td>
        <td>Level</td>
        </tr></thead><tbody>';
    }else{
        $out='<table><thead><tr>
        <td>Bank</td>
        <td>Notiz</td>
        <td>Filter</td>
        <td>Pegel</td>
        </tr></thead><tbody>';
    }

    for ($i=0;$i<$count; $i++) {
        $out.='<tr>';
        if($GLOBALS["lang"]=='en')
		{
            $out.='<td class="convolve">';
            if(activeFilter()==$i)
            {
				$out.='<button type="submit" name="bank" style="background-color: #a00" value="'.$i.'">Bank '.($i+1).'</button>';
                $out.='</td>';
            }
            else
            {
                $out.='<button type="submit" name="bank" value="'.$i.'">Bank '.($i+1).'</button> ';
                $out.='</td>';
            }
            $out.='<td class="convolve"><input type="text" autocomplete="off" name=comm'.$i.' value="'.$ini_array['COEFF_COMMENT'.$i].'"/></td>';
        }
		else
		{
            $out.='<td class="convolve">';
            if(activeFilter()==$i)
			{
				$out.='<button type="submit" name="bank" value="'.$i.'" style="background-color: #a00" >Bank '.($i+1).'</button>';
                $out.='</td>';
            }
			else
			{
                $out.='<button type="submit" name="bank" value="'.$i.'">Bank '.($i+1).'</button>';
                $out.='</td>';
            }
            $out.='<td class="convolve"><input type="text" autocomplete="off" name=comm'.$i.' value="'.$ini_array["COEFF_COMMENT"."$i"].'"/></td>';
        }
        $out.='<td class="convolve">';
		$out.=	fltrSelect($i,$ini_array);
		//$out.='</td>';
        //$out.='<td class="convolve">';
        //if-Abfrage für Prefilter
        //if($ini_array["LOAD_PREFILTER"] == "ON"){
            $att=$ini_array["COEFF_ATT"."$i"]*-1;
        //} else{
        //    $att=$ini_array[COEFF_ATT.$i]*-1; //Hier Filterauswahl ohne ABACUS-Presets
        //}
        $out.='</td>';
        $out.='<td class="convolve">';
        $out.='<input type="text" name=vol'.$i.' class="volume" value="'.$att.'"> dB</br>';
        $out.='</td>';
        $out.='</tr>';
    }
    $out.='</tbody></table>';
	return $out;
}


// Validates volume from array
// if value is numeric write to config
function validateAndSave($size,$arr)
{
	$shell_exec_ret=exec('cardmount rw');
	for ($i=0; $i < $size; $i++)
	{
		if(is_numeric($arr['vol'.$i])){
			if (-90<$arr['vol'.$i] && $arr['vol'.$i]<=3) {
				wrtToUserconfig('COEFF_ATT'.$i,(-1*$arr['vol'.$i]));
			}
		}
    wrtToUserconfig('COEFF_NAME'.$i,$arr['coeff'.$i]);
		wrtToUserconfig('COEFF_COMMENT'.$i,$arr['comm'.$i]);
	}
	$shell_exec_ret=exec('cardmount ro');
  $i=0;
  //echo $arr['coeff'.$i];
}


// Liest die Userconfig bis zur veraenderten Variable
// und schreibt sie in das File
function wrtToUserconfig($varName,$value)
{
	$value=strval($value);
//	echo $varName.'="'.$value.'"';
//	$shell_exec_ret=exec('cardmount rw');
	$file="/boot/userconfig.txt";
	//$pattern='/'.$varName.'=\".*\"/';
    $pattern='/\b'.$varName.'\b=\".*\"/';
	$content=file_get_contents($file);
	$content=preg_replace($pattern, $varName.'="'.$value.'"', $content);
	file_put_contents($file, $content);
//	$shell_exec_ret=exec('cardmount ro');
}

//Liest die Coeffsets ein und gibt die jeweilige Zurordnung
//als Array zurueck
//Uebergabe: anzahl an Coeffsets

function readCoeffNamesFromBrutefir($sets)
{
	$file="/etc/brutefir/brutefir_config";
	$content=file_get_contents($file);
	for ($i=0; $i < $sets; $i++) {
		$pattern='/coeff\"left'.$i.'\"{filename:\"\/boot\/brutefir\/(\w*)(L|R)(\d*).dbl\"/';
		preg_match($pattern, $content,$match);
		$results[$i]=$match[1];
	}
	return $results;
}

/* Brutefir Funktionen:
 -switchfilter
 -getFilter
 -delay
 -togglemute
 -volcontrol
 -invertPhase
*/

function switchFilter($fltrBank)
{
	$cmd = '/usr/bin/controlbrutefir chgFilter'; //evtl als konstante auslagern
	$directory = '/run/filter';
	$coeffSet0=2*$fltrBank;
	$coeffSet1=2*$fltrBank+1;
	$coeffSet2=2*$fltrBank+2;
	$coeffSet3=2*$fltrBank+3;

	$ch_1=" 0 ";
	$ch_2=" 1 ";
	shell_exec($cmd.$ch_1.$coeffSet0.$ch_2.$coeffSet1);

/*	if ($regexString=browseDirectory($directory)) {
		$pattern = "/".$fltrBank."S[L]|[R](\\d*).dbl/";
		if(preg_match_all($pattern, $regexString)>0){
			shell_exec($cmd.' 2 '.$coeffSet2);
			shell_exec($cmd.' 3 '.$coeffSet3);
		}
	}
*/
}

//returns active filter set
function getFilter()
{
	$cmd='/usr/bin/controlbrutefir getFilter';
	$str=shell_exec($cmd);
	$str=strtok($str, ':');
	$out=strtok(':');
	return intval($out)/2;
}

function getVol()
{
	$cmd='/usr/bin/controlbrutefir getVol';
	$str=shell_exec($cmd);
	$str=strtok($str, '/');
	$out=strtok('/');
	return floatval($out);
 }

 function getDelay()
 {
 	$cmd='/usr/bin/controlbrutefir getDelay';
	$str=shell_exec($cmd);
	$str=strtok($str, ' ');
	$out=strtok(' ');
	return floatval($out);
 }

function chgDelay($fltrBank,$delay)
{
	$cmd = '/usr/bin/controlbrutefir chgDelay';
	shell_exec($cmd.' '.$fltrBank.' '.$delay);
}

function tgglMute($channel)
{
	$cmd = '/usr/bin/controlbrutefir tgglMute';
	shell_exec($cmd.' '.$channel);
}

function isMuted()
{
	$str = shell_exec("echo 'lo' | nc -q0 localhost 3000 ");
	$re = "/muted/";
	preg_match($re, $str, $matches);

	if(isset($matches[0]))
	{
		if($matches[0] == "muted") return true;
	}
	else
	{
		return false;
	}

}

function volControl()
{
	$cmd = '/usr/bin/controlbrutefir volControl '.$ms.' '.$attenuation;
	shell_exec($cmd);
}


function measurement()
{
	while (exec('pgrep controlaudio'))
	{
		sleep(1);
	}

	if($_POST['MEASURE_MS'] == "ON") $ms="ms_on";
	else $ms="ms_off";

	if(isset($_POST['MEASUREMENT_CONTROL'])) $control="control_on";
	else $control="control_off";

	$cmd="/usr/bin/recordsweep $ms $control 2>&1";

	while (@ ob_end_flush()); // end all output buffers if any

	$proc = popen($cmd, 'r');
	echo '<pre>' ;
	while (!feof($proc))
	{
	    echo fread($proc, 4096);
	    @ flush();
	}
    echo '</pre>' ;
}


function cancel_measurement()
{
	exec('rm /tmp/measurement');
	//exec('pkill -P $(pgrep -o recordsweep_)');
	exec('killall aplay');
	exec('killall arecord');
	while (exec('pgrep controlaudio'))
	{
		sleep(1);
	}
	exec('controlaudio stop');
	exec('controlaudio start');
	echo '<pre>';
	echo 'Measurement cancelled.';
	echo '</pre>';
}


function play_noise($ms)
{
	shell_exec("record_checkvolume '$ms' &> /dev/null &");
}


function stop_noise()
{
	shell_exec('killall aplay');
	shell_exec('controlaudio start');
}


function update($beta)
{
	if ($beta == "beta")
	{
		$cmd='/usr/bin/update -m -u beta 2>&1';
	}
	else
	{
		$cmd='/usr/bin/update -m -u beta 2>&1';
	}
	while (@ ob_end_flush()); // end all output buffers if any
		$proc = popen($cmd, 'r');
		echo '<pre>' ;
		while (!feof($proc))
		{
			echo fread($proc, 4096);
			@ flush();
		}
    		echo '</pre>' ;
}

function upload_measurement()
{
	$cmd='/usr/bin/scp /root/measurement.wav root:toor@127.0.0.1:/tmp/measurement.wav';
	shell_exec($cmd) ;
}

?>
