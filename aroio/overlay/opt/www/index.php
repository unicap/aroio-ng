<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL & ~E_NOTICE);


//print_r($_POST);

    include('strings.php');
    include('functions.inc.php');
    include('style.css');

    if($_GET["lang"] === "en") $lang='en';
    else $lang='de';

    $ini_array = parse_ini_file("/boot/userconfig.txt", 1);
    if ( isset($_POST['submit']) || isset($_POST['audiosettings_submit']) )
    {
        if ($_POST['DHCP'] == "OFF")
        {
            if ( !validate_input("IPADDR",$_POST['IPADDR']) )
                $error="${error_invalid_ipaddr._.$lang}<br />";

            if ( !validate_input("IPADDR",$_POST['DNSSERV']) )
                $error.="${error_invalid_dnsserver._.$lang}<br />";

            if ( !validate_input("NETMASK",$_POST['NETMASK']) )
                $error.="${error_invalid_netmask._.$lang}<br />";

            if ( !validate_input("HOSTNAMEORIP",$_POST['GATEWAY']) )
                $error.="${error_invalid_gateway._.$lang}<br />";

            if ( !validate_input("LMS",$_POST['SERVERNAME']) )
                $error.="${error_invalid_servername._.$lang}<br />";
        }

        if ( !validate_input("HOSTNAME",$_POST['HOSTNAME']) )
            $error.="${error_invalid_hostname._.$lang}<br />";

        if ( !validate_input("SERVERPORT",$_POST['SERVERPORT']) )
            $error.="${error_invalid_squeezeport._.$lang}<br />";

        if ( !$error )
        {
            $shell_exec_ret=shell_exec('cardmount rw');
            write_config();
            $shell_exec_ret=shell_exec('cardmount ro');
            unset($_POST['reboot']);
            $ini_array = parse_ini_file("/boot/userconfig.txt", 1);
            echo '<meta http-equiv="refresh"> ';
        }
    }
//echo "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
//print_r($ini_array);


    if ( isset($_POST['reboot']) )
    {
        $shell_exec_ret=shell_exec('cardmount rw');
        write_config();
        $shell_exec_ret=shell_exec('cardmount ro');
        unset($_POST['submit']);
        print '<h1>Configuration saved, will reboot now and redirect you here...</h1>';
        sleep(3);
        shell_exec('checksoundcard &');
        shell_exec('reboot -d 1 &');
        echo '<meta http-equiv="refresh" content="15">';
    }

    if ( isset($_POST['scan']))
    {
        $wifilist=scanwifi();
    }

    if ( isset($_POST['lms_submit']) )
    {
        $shell_exec_ret=shell_exec('cardmount rw');
        write_config();
        $shell_exec_ret=shell_exec('cardmount ro');
        restart_lms();
        $ini_array = parse_ini_file("/boot/userconfig.txt", 1);
    }

    if ( isset($_POST['audiosettings_submit']) )
    {
        shell_exec('/usr/bin/controlaudio restart &> /dev/null' );
//        shell_exec('/etc/init.d/amixer &> /dev/null &');
    }
    include "header.php";?>

<!-- Navigation -->
<ul>
<li><a class="select" href="index.php" target=""><? print ${linktext_configuration._.$lang} ?></span></a></li>
<li><a href="system.php" target=""><? print ${linktext_system._.$lang} ?></a></li>
<li><a href="measurement.php" target=""><? print${linktext_measurement._.$lang} ?></a></li>
<li>
<? if ($ini_array['BRUTEFIR'] == "OFF"){?>
    <a style="color: #c5c5c5" href="brutefir.php"target=""><? print ${linktext_brutefir._.$lang} ?></a>
    <?}else{?>
        <a href="brutefir.php"target=""><? print ${linktext_brutefir._.$lang} ?></a>
        <?}?>
</li>

<li style="float:right"><a href="credits.php" target=""><? print ${linktext_credits._.$lang} ?></a></li>
</ul><!-- Ende Navigation -->

<hr class="top">
</div> <!-- Ende vom Head -->


<div class="content">

<h1> <? print $ini_array["HOSTNAME"]?> - <? print ${page_title_main._.$lang} ?></h1>

<!-- #<? if(!$error && isset($_POST['submit']))
#{
#    echo '<h1><center>Configuration saved!</center></h1>';
#    unset($_POST['submit']);
#}
#else  echo $error;?> -->

<form id="Network settings" Name="Network settings" action="" method="post">

<!-- Einstellungen Netzwerk -->
<fieldset>
<legend><? print ${network_form._.$lang} ; ?></legend>

<table>
  <tr>
    <td>
      <a style="text-decoration: none href="#" title="<? print ${helptext_hostname._.$lang} ?>"class="tooltip">
      <span title=""><label for="Hostname">Hostname</label></span></a>
    </td>
    <td>
      <input class="actiongroup" <?if ( isset($_POST['submit']) && !validate_input("HOSTNAME",$_POST['HOSTNAME']) ){echo 'style="border:2px solid #ff0000"';};?> type="text" name="HOSTNAME" value="<? if (isset($_POST['submit']))print $_POST['HOSTNAME']; else print $ini_array["HOSTNAME"] ?>">
    </td>
  </tr>
  <tr>
    <td>
      <a style="text-decoration: none href="#"  title="<? print ${helptext_dhcp._.$lang} ?>"class="tooltip">
      <span title=""><label for="DHCP"><? print ${dhcp._.$lang} ; ?></label></span></a>
    </td>
    <td>
    <?
    if ($ini_array["DHCP"] == "OFF" || $_POST["DHCP"] == "OFF")
    {?>
        <input class="actiongroup" type="radio" name="DHCP" value="ON"> <?print ${dhcp_on._.$lang}?><br>
        <input class="actiongroup" type="radio" name="DHCP" value="OFF" checked> <?print ${dhcp_off._.$lang}?>
    <?}
    else
    {?>
        <input class="actiongroup" type="radio" name="DHCP" value="ON" checked> <?print ${dhcp_on._.$lang}?><br>
        <input class="actiongroup" type="radio" name="DHCP" value="OFF"> <?print ${dhcp_off._.$lang}?>
    <?}
    if ($ini_array["DHCP"] == "OFF" || $_POST['DHCP'] == "OFF")
    {?>
    </td>
  </tr>
  <tr>
    <td>
      <a style="text-decoration: none href="#" title="<? print ${helptext_ipaddr._.$lang} ?>"class="tooltip">
      <span title=""><label for="IP-address"> <? print ${ipaddr._.$lang} ; ?> </label></span></a>
    </td>
    <td>
      <input class="actiongroup" <?if ( isset($_POST['submit']) && !validate_input("IPADDR",$_POST['IPADDR']) ){echo 'style="border:2px solid #ff0000"';};?> type="text" name="IPADDR" value="<? if (isset($_POST['submit']))print $_POST['IPADDR']; else print $ini_array["IPADDR"]; ?>">
    </td>
  </tr>
  <tr>
    <td>
      <a style="text-decoration: none href="#" title="<? print ${helptext_netmask._.$lang} ?>"class="tooltip">
      <span title=""><label for="Network-mask"> <? print ${netmask._.$lang} ; ?> </label></span></a>
    </td>
    <td>
      <input class="actiongroup" <?if ( isset($_POST['submit']) && !validate_input("NETMASK",$_POST['NETMASK']) ){echo 'style="border:2px solid #ff0000"';};?> type="text" name="NETMASK" value="<?if (isset($_POST['submit']))print $_POST['NETMASK']; else print $ini_array["NETMASK"]; ?>">
    </td>
  </tr>
  <tr>
    <td>
      <a style="text-decoration: none href="#" title="<? print ${helptext_dnsserv._.$lang} ?>"class="tooltip">
      <span title=""><label for="DNS-server"> <? print ${dnsserv._.$lang} ; ?> </label></span></a>
    </td>
    <td>
      <input class="actiongroup" <?if ( isset($_POST['submit']) && !validate_input("IPADDR",$_POST['DNSSERV']) ){echo 'style="border:2px solid #ff0000"';};?> type="text" name="DNSSERV" value="<?if (isset($_POST['submit']))print $_POST['DNSSERV']; else print $ini_array["DNSSERV"] ?>">
    </td>
  </tr>
  <tr>
    <td>
      <a style="text-decoration: none href="#" title="<? print ${helptext_gateway._.$lang} ?>"class="tooltip">
      <span title=""><label for="Gateway"> <? print ${gateway._.$lang} ; ?> </label></span></a>
    </td>
    <td>
      <input class="actiongroup" <?if ( isset($_POST['submit']) && !validate_input("HOSTNAMEORIP",$_POST['GATEWAY']) ){echo 'style="border:2px solid #ff0000"';};?> type="text" name="GATEWAY" value="<? if (isset($_POST['submit']))print $_POST['GATEWAY']; else  print $ini_array["GATEWAY"] ?>">
    </td>
  </tr>
    <?}
  else{
    $test_wlan=test_wlan();
    if ($test_wlan == "0"){?>
  <tr>
    <td>
      <a style="text-decoration: none href="#" title="<? print ${helptext_sitesurvey._.$lang} ?>"class="tooltip">
      <span title=""><label for="Scan"> <? print ${site_survey._.$lang} ; ?> </label></span></a>
    </td>
    <td>
      <input class="button" type="submit" value="<? print ${button_scan._.$lang} ?>" name="scan">
    </td>
  </tr>
  <tr>
    <td>
      <a style="text-decoration: none href="#" title="<? print ${helptext_wlanssid._.$lang} ?>"class="tooltip">
      <span title=""><label for="Wireless network"> <? print ${wlanssid._.$lang} ; ?> </label></span></a>
    </td>
    <td>
    <?
    echo'<select name="WLANSSID" class="actiongroup">';
    if (isset($_POST['scan']))
    {
        foreach($wifilist as $ssid){
            if($ssid == $ini_array["WLANSSID"]){
                echo'<option selected>'.$ssid.'</option>';
            }
            else echo'<option>'.$ssid.'</option>';
        }
        echo '<option>Aroio-Access-Point</option>';
    }
    //elseif (isset($_POST['WLANSSID'])) echo'<option selected>'.$_POST['WLANSSID'].'</option>';
    else echo'<option selected>'.$ini_array['WLANSSID'].'</option>';
    echo'</select>';
    ?>
    </td>
  </tr>
  <tr>
    <td>
      <a style="text-decoration: none href="#" title="<? print ${helptext_wlanpwd._.$lang} ?>"class="tooltip">
      <span title=""><label for="Wireless passphrase"> <? print ${wlanpwd._.$lang} ; ?> </label></span></a>
    </td>
    <td>

      <script src="showpswd.js"></script>

      <input type="password" id="newpass" name="WLANPWD" onkeyup="runPassword(this.value, 'newpass');" value="<? print $ini_array["WLANPWD"] ?>"/>
      <a style="text-decoration: none href="#" title="<? print ${helptext_showpwd._.$lang} ?>"class="tooltip_check">
      <span title=""></span>
      <input type="checkbox" id="showpwd" onclick="machText(this.checked,this.form)"><label></label>
      </a>
    </td>
  </tr>
    <?}
}?>
</table>
</fieldset>
</div> <!-- Ende Einstellungen Netzwerk -->

<div class="content">
<fieldset> <!-- Einstellungen Webinterface -->
<legend><? print ${webinterface_form._.$lang};?></legend>
<table>
  <tr>
    <td>
      <a style="text-decoration: none href="#" title="<? print ${helptext_userpwd._.$lang} ?>"class="tooltip">
      <span title=""><label for="Userpassword"> <? print ${userpwd._.$lang} ; ?> </label></span></a>
    </td>
    <td>
      <input class="actiongroup" type="password" name="USERPASSWD" value="<? print $ini_array["USERPASSWD"] ?>">
    </td>
  </tr>
</table>
</fieldset>
</div> <!-- Ende Einstellungen Webinterface -->

<div class="content">

<div class="content">
<fieldset> <!-- Einstellungen Hardware-Plattform -->
<legend><? print ${hardware_form._.$lang};?></legend>
<table>
  <tr>
    <td>
      <a style="text-decoration: none href="#" title="<? print ${helptext_platform._.$lang} ?>"class="tooltip">
      <span title=""><label for="Userpassword"> <? print ${platform_form._.$lang} ; ?> </label></span></a>
    </td>
    <td>
        <?$arr_platform= array('AroioEX','AroioSU','AroioLT');
            print_optgroup("PLATFORM",$arr_platform,$ini_array["PLATFORM"]);
    ?>
    </td>
  </tr>
</table>
</fieldset>
</div> <!-- Ende Einstellungen Hardware-Plattform -->

<div class="content">

<!-- Logitech Media Server -->

<fieldset>
<legend><? print ${squeeze_serv_form._.$lang};?></legend>
<table>
  <tr>
    <td>
      <a style="text-decoration: none href="#" title="<? print ${helptext_servername._.$lang} ?>"class="tooltip">
      <span title=""><label for="Address or hostname"> <? print ${squeeze_serv_hostname._.$lang} ; ?> </label></span></a>
    </td>
    <td>
      <input class="actiongroup" <?if ($_POST['DHCP'] == "OFF") {if ( isset($_POST['submit']) && !validate_input("LMS",$_POST['SERVERNAME']) ){echo 'style="border:2px solid #ff0000"';};}?> type="text" name="SERVERNAME" value="<? if (isset($_POST['submit']))print $_POST['SERVERNAME']; else print $ini_array["SERVERNAME"] ?>">
    </td>
  </tr>
  <tr>
    <td>
      <a style="text-decoration: none href="#" title="<? print ${helptext_squeezeuser._.$lang} ?>"class="tooltip">
      <span title=""><label for="Username (if set)"> <? print ${squeeze_serv_user._.$lang} ; ?> </label></span></a>
    </td>
    <td>
      <input class="actiongroup" type="text" name="SQUEEZEUSER" value="<? print $ini_array["SQUEEZEUSER"] ?>">
    </td>
  </tr>
  <tr>
    <td>
      <a style="text-decoration: none href="#" title="<? print ${helptext_squeezepwd._.$lang} ?>"class="tooltip">
      <span title=""><label for="Password (if set)"> <? print ${squeeze_serv_passwd._.$lang} ; ?> </label></span></a>
    </td>
    <td>
      <input class="actiongroup" type="password" name="SQUEEZEPWD" value="<? print $ini_array["SQUEEZEPWD"] ?>">
    </td>
  </tr>
  <tr>
    <td>
      <a style="text-decoration: none href="#" title="<? print ${helptext_serverport._.$lang} ?>"class="tooltip">
      <span title=""><label for="Port (default 9000)"> <? print ${squeeze_serv_port._.$lang} ; ?> </label></span></a>
    </td>
    <td>
      <input class="actiongroup" <?if ( isset($_POST['submit']) && !validate_input("SERVERPORT",$_POST['SERVERPORT']) ){echo 'style="border:2px solid #ff0000"';};?> type="text" name="SERVERPORT" value="<? if (isset($_POST['submit']))print $_POST['SERVERPORT']; else print $ini_array["SERVERPORT"] ?>">
    </td>
  </tr>
</table>

<?
$squeezeserverstate=ping_squeezeserver();
if ( $squeezeserverstate == "0")
{?>
    <a href=<? echo 'http://'.print_squeezeaddr($ini_array["SERVERPORT"]).'' ?> target="_blank">
    <button type="button" style="padding: 10px 10px; margin: 0px;">LMS Webinterface</button>
    </a>
<?}
else
{?>
    <a disabled href=<? echo 'http://'.print_squeezeaddr($ini_array["SERVERPORT"]).'' ?> target="_blank">
    <button disabled type="button" style="padding: 10px 10px; margin: 0px;">LMS Webinterface</button>
    </a>
<?}?>



</fieldset>
</div> <!-- Ende LMS -->

<div class="content">
<!-- Audio Einstellungen -->
<fieldset>
<legend><? print ${audio_form._.$lang};?></legend>
<table>
  <tr>
    <td>
      <a style="text-decoration: none href="#" title="<? print ${helptext_playername._.$lang} ?>"class="tooltip">
      <span title=""><label for="Player name"> <? print ${player_name._.$lang} ; ?> </label></span></a>
    </td>
    <td>
      <? if ( $ini_array["PLAYERNAME"] == "" ) { $ini_array["PLAYERNAME"] = $ini_array["HOSTNAME"]; } ?>
      <input class="actiongroup" type="text" name="PLAYERNAME" value="<? print $ini_array["PLAYERNAME"] ?>">
    </td>
  </tr>
  <tr>
    <td>
      <a style="text-decoration: none href="#" title="<? print ${helptext_volume._.$lang} ?>"class="tooltip">
      <span title=""><label for="Volume"> <? print ${volume._.$lang} ; ?> </label></span></a>
    </td>
    <td>
      <? print_optgroup("VOLUME",$arr_volume,$ini_array["VOLUME"]); ?>
    </td>
  </tr>
  <tr>
    <td>
    <? if ($ini_array["BRUTEFIR"] == "ON"){ ?>
        <a style="text-decoration: none href="#" title="<? print ${helptext_jack_buffer._.$lang} ?>"class="tooltip">
        <span title=""><label for="Jackbuffer"> <? print ${jack_buffer._.$lang} ; ?> </label></span></a>
    </td>
    <td>
        <?$arr_jackbuffer= array(2048,4096,8192);
        print_optgroup("JACKBUFFER",$arr_jackbuffer,$ini_array["JACKBUFFER"]);?>
    </td>
    <?}?>
  </tr>
  <tr>
    <td>
        <a style="text-decoration: none href="#" title="<? print ${helptext_soundcard._.$lang} ?>"class="tooltip">
        <span title=""><label for="Soundcard"> <? print ${soundcard._.$lang} ; ?> </label></span></a>
    </td>
    <td>
        <?$arr_soundcard= array('Internal HDMI audio','Internal audio jack','AroioDAC','IQAudIO DAC','HiFiBerry DAC+','HiFiBerry Digi','RME Fireface UCX','Focusrite Scarlett','USB Class Compliant device');
        //<?$arr_soundcard= array('IQAudIO DAC','HiFiBerry DAC+','HiFiBerry Digi','M-Audio Fast Track Pro','Lynx Hilo','Focusrite Scarlett','NI Audio 8 DJ');
        print_optgroup("SOUNDCARD",$arr_soundcard,$ini_array["SOUNDCARD"]);
    ?>
    </td>
  </tr>

</table>

<br>


</-- Audio Output Auswahl-->


<div class="content">
  <table>
  <tr>
    <td>
        Samplerate:
    </td>
    <td>
        <?
        switch ($ini_array["SOUNDCARD"]){
            case "Internal HDMI audio":
            case "Internal audio jack":
            case "M-Audio Fasttrack Pro":
                $arr_rate= array('44100','48000');
                break;

            case "Platzhalter":
                $arr_rate= array('44100','48000','88200');
                break;

            case "AudioQuest DragonFly":
            case "AudioQuest Beetle":
            case "RME FireFace UCX":
                $arr_rate= array('44100','48000','88200','96000');
                break;

            case "Platzhalter2":
                $arr_rate= array('44100','48000','88200','96000','192000');
                break;

            case "XMOS Evaluation Board":
            case "USB Class Compliant device":
                $arr_rate= array('44100','48000','88200','96000','192000','348000');
                break;
            }
        print_optgroup("RATE",$arr_rate,$ini_array["RATE"]);
    ?>
    </td>
  </tr>
  </table>
</div>


<div class="content">
<fieldset>

<table>

<tr>
<td>

</td>
<td>
squeeze
</td>
<td>
gmrender
</td>
<td>
shairport
</td>
<td>
btalsa
</td>
<td>
netjack
</td>
</tr>


<?
if ($ini_array["SOUNDCARD"] != "Focusrite Scarlett")
{

    if ($ini_array["AUDIO_OUTPUT"] == "i2s"){
        ?> <tr><td> <input class="actiongroup" type="radio" name="AUDIO_OUTPUT" value="i2s" checked> Direct <?}
    else {
        ?> <tr><td> <input class="actiongroup" type="radio" name="AUDIO_OUTPUT" value="i2s"> Direct <?}

    switch ($ini_array["RAW_PLAYER"]){
	case "squeezelite":
        ?>
		<td> <input class="actiongroup" type="radio" name="RAW_PLAYER" value="squeezelite" checked> </td>
	    <td> <input class="actiongroup" type="radio" name="RAW_PLAYER" value="gmediarender" > </td>
	    <td> <input class="actiongroup" type="radio" name="RAW_PLAYER" value="shairportsync" > </td>
	    <td> <input class="actiongroup" type="radio" name="RAW_PLAYER" value="bluealsaaplay" > </td><td></td>
	    </tr>
        <?
        break;

	case "gmediarender":
        ?>
        <td> <input class="actiongroup" type="radio" name="RAW_PLAYER" value="squeezelite" > </td>
	    <td> <input class="actiongroup" type="radio" name="RAW_PLAYER" value="gmediarender" checked> </td>
	    <td> <input class="actiongroup" type="radio" name="RAW_PLAYER" value="shairportsync" > </td>
	    <td> <input class="actiongroup" type="radio" name="RAW_PLAYER" value="bluealsaaplay" > </td><td></td>
	    </tr>
        <?
        break;

	case "shairportsync":
        ?>
        <td> <input class="actiongroup" type="radio" name="RAW_PLAYER" value="squeezelite" > </td>
        <td> <input class="actiongroup" type="radio" name="RAW_PLAYER" value="gmediarender" > </td>
        <td> <input class="actiongroup" type="radio" name="RAW_PLAYER" value="shairportsync" checked> </td>
        <td> <input class="actiongroup" type="radio" name="RAW_PLAYER" value="bluealsaaplay" > </td><td></td>
        </tr>
        <?
        break;

	case "bluealsaaplay":
        ?>
        <td> <input class="actiongroup" type="radio" name="RAW_PLAYER" value="squeezelite" > </td>
	    <td> <input class="actiongroup" type="radio" name="RAW_PLAYER" value="gmediarender" > </td>
	    <td> <input class="actiongroup" type="radio" name="RAW_PLAYER" value="shairportsync" > </td>
	    <td> <input class="actiongroup" type="radio" name="RAW_PLAYER" value="bluealsaaplay" checked> </td><td></td>
	    </tr>
        <?
        break;
    }

    if ($ini_array["AUDIO_OUTPUT"] == "i2s-mscoded"){
        ?> <tr><td> <input class="actiongroup" type="radio" name="AUDIO_OUTPUT" value="i2s-mscoded" checked> MS-Coded <?}
    else {
        ?> <tr><td> <input class="actiongroup" type="radio" name="AUDIO_OUTPUT" value="i2s-mscoded"> MS-Coded <?}

    switch ($ini_array["RAW_PLAYERMS"]){
	case "squeezelite":
        ?>
		<td> <input class="actiongroup" type="radio" name="RAW_PLAYERMS" value="squeezelite" checked> </td>
	    <td> <input class="actiongroup" type="radio" name="RAW_PLAYERMS" value="gmediarender" > </td>
	    <td> <input class="actiongroup" type="radio" name="RAW_PLAYERMS" value="shairportsync" > </td>
	    <td> <input class="actiongroup" type="radio" name="RAW_PLAYERMS" value="bluealsaaplay" > </td><td></td>
	    </tr>
        <?
        break;

	case "gmediarender":
        ?>
        <td> <input class="actiongroup" type="radio" name="RAW_PLAYERMS" value="squeezelite" > </td>
	    <td> <input class="actiongroup" type="radio" name="RAW_PLAYERMS" value="gmediarender" checked> </td>
	    <td> <input class="actiongroup" type="radio" name="RAW_PLAYERMS" value="shairportsync" > </td>
	    <td> <input class="actiongroup" type="radio" name="RAW_PLAYERMS" value="bluealsaaplay" > </td><td></td>
	    </tr>
        <?
        break;

	case "shairportsync":
        ?>
        <td> <input class="actiongroup" type="radio" name="RAW_PLAYERMS" value="squeezelite" > </td>
        <td> <input class="actiongroup" type="radio" name="RAW_PLAYERMS" value="gmediarender" > </td>
        <td> <input class="actiongroup" type="radio" name="RAW_PLAYERMS" value="shairportsync" checked> </td>
        <td> <input class="actiongroup" type="radio" name="RAW_PLAYERMS" value="bluealsaaplay" > </td><td></td>
        </tr>
        <?
        break;

	case "bluealsaaplay":
        ?>
        <td> <input class="actiongroup" type="radio" name="RAW_PLAYERMS" value="squeezelite" > </td>
	    <td> <input class="actiongroup" type="radio" name="RAW_PLAYERMS" value="gmediarender" > </td>
	    <td> <input class="actiongroup" type="radio" name="RAW_PLAYERMS" value="shairportsync" > </td>
	    <td> <input class="actiongroup" type="radio" name="RAW_PLAYERmS" value="bluealsaaplay" checked> </td><td></td>
	    </tr>
        <?
        break;
    }
}

?>
<tr> <?
if ($ini_array["SOUNDCARD"] != "Internal HDMI audio" && $ini_array["SOUNDCARD"] != "Internal audio jack")
{ ?>
    <td> <?
        if ($ini_array["AUDIO_OUTPUT"] == "plug-dmixer")
            { ?> <input class="actiongroup" type="radio" name="AUDIO_OUTPUT" value="plug-dmixer" checked> DMix <?}
        else
            { ?> <input class="actiongroup" type="radio" name="AUDIO_OUTPUT" value="plug-dmixer"> DMix <?}?>
    </td>

    <td>
        <input type="hidden" name="DMIX_SQUEEZELITE" value="OFF"><?
        if ($ini_array["DMIX_SQUEEZELITE"] == "ON")
            {?> <input type="checkbox" name="DMIX_SQUEEZELITE" value="ON" checked> <?}
        else
            {?> <input type="checkbox" name="DMIX_SQUEEZELITE" value="ON"> <?}?>
    </td>

    <td>
        <input type="hidden" name="DMIX_GMEDIARENDER" value="OFF"><?
        if ($ini_array["DMIX_GMEDIARENDER"] == "ON")
            { ?> <input type="checkbox" name="DMIX_GMEDIARENDER" value="ON" checked> <?}
        else
            {?> <input type="checkbox" name="DMIX_GMEDIARENDER" value="ON"> <?}?>
    </td>

    <td>
        <input type="hidden" name="DMIX_SHAIRPORTSYNC" value="OFF"><?
        if ($ini_array["DMIX_SHAIRPORTSYNC"] == "ON")
            {?> <input type="checkbox" name="DMIX_SHAIRPORTSYNC" value="ON" checked> <?}
        else
            {?> <input type="checkbox" name="DMIX_SHAIRPORTSYNC" value="ON"><?}?>
    </td>

    <td>
        <input type="hidden" name="DMIX_BLUEALSAAPLAY" value="OFF"><?
        if ($ini_array["DMIX_BLUEALSAAPLAY"] == "ON")
            { ?> <input type="checkbox" name="DMIX_BLUEALSAAPLAY" value="ON" checked> <?}
        else
            {?> <input type="checkbox" name="DMIX_BLUEALSAAPLAY" value="ON"> <?}?>
    </td>
</tr>


<tr>
    <td><?
	    if ($ini_array["AUDIO_OUTPUT"] == "dmixer-mscoded"){
            ?> <input class="actiongroup" type="radio" name="AUDIO_OUTPUT" value="dmixer-mscoded" checked> DMix MS <?}
        else {
            ?> <input class="actiongroup" type="radio" name="AUDIO_OUTPUT" value="dmixer-mscoded"> DMix MS  <?}?>
    </td>

    <td>
        <input type="hidden" name="DMIXMS_SQUEEZELITE" value="OFF"><?
        if ($ini_array["DMIXMS_SQUEEZELITE"] == "ON")
            {?> <input type="checkbox" name="DMIXMS_SQUEEZELITE" value="ON" checked> <?}
        else
            {?> <input type="checkbox" name="DMIXMS_SQUEEZELITE" value="ON"> <?}?>
    </td>

    <td>
        <input type="hidden" name="DMIXMS_GMEDIARENDER" value="OFF"><?
        if ($ini_array["DMIXMS_GMEDIARENDER"] == "ON"){
            ?> <input type="checkbox" name="DMIXMS_GMEDIARENDER" value="ON" checked> <?}
        else
            {?> <input type="checkbox" name="DMIXMS_GMEDIARENDER" value="ON"> <?}?>
    </td>

    <td>
    	<input type="hidden" name="DMIXMS_SHAIRPORTSYNC" value="OFF"><?
        if ($ini_array["DMIXMS_SHAIRPORTSYNC"] == "ON")
            {?> <input type="checkbox" name="DMIXMS_SHAIRPORTSYNC" value="ON" checked> <?}
        else
            {?> <input type="checkbox" name="DMIXMS_SHAIRPORTSYNC" value="ON"><?}?>
    </td>

    <td>
        <input type="hidden" name="DMIXMS_BLUEALSAAPLAY" value="OFF"><?
        if ($ini_array["DMIXMS_BLUEALSAAPLAY"] == "ON")
            { ?> <input type="checkbox" name="DMIXMS_BLUEALSAAPLAY" value="ON" checked> <?}
        else
            {?> <input type="checkbox" name="DMIXMS_BLUEALSAAPLAY" value="ON"> <?}?>
    </tr><?

}
?>

<td>
</td>
</tr>

<tr>
<td>

  <? if ($ini_array["AUDIO_OUTPUT"] == "jack"){ ?>
    <input class="actiongroup" type="radio" id="output" name="AUDIO_OUTPUT" value="jack" checked> Jack
  <?} else {?>
      <input class="actiongroup" type="radio" id="output" name="AUDIO_OUTPUT" value="jack"> Jack
  <?}?>

</td>
<td>
	<input type="hidden" name="JACK_SQUEEZELITE" value="OFF">
  	<? if ($ini_array["JACK_SQUEEZELITE"] == "ON"){ ?>
    <input type="checkbox" id="jack" name="JACK_SQUEEZELITE" value="ON" checked>
  	<?} else {?>
    <input type="checkbox" id="jack" name="JACK_SQUEEZELITE" value="ON">
  <?}?>
</td>
<td>
	<input type="hidden" name="JACK_GMEDIARENDER" value="OFF">
  <? if ($ini_array["JACK_GMEDIARENDER"] == "ON"){ ?>
    <input type="checkbox" id="jack" name="JACK_GMEDIARENDER" value="ON" checked>
  <?} else {?>
    <input type="checkbox" id="jack" name="JACK_GMEDIARENDER" value="ON">
  <?}?>
</td>
<td>
	<input type="hidden" name="JACK_SHAIRPORTSYNC" value="OFF">
  <? if ($ini_array["JACK_SHAIRPORTSYNC"] == "ON"){ ?>
    <input type="checkbox" id="jack"  name="JACK_SHAIRPORTSYNC" value="ON" checked>
  <?} else {?>
    <input type="checkbox" id="jack" name="JACK_SHAIRPORTSYNC" value="ON">
  <?}?>
</td>
<td>
	<input type="hidden" name="JACK_BLUEALSAAPLAY" value="OFF">
  <? if ($ini_array["JACK_BLUEALSAAPLAY"] == "ON"){ ?>
    <input type="checkbox" id="jack" name="JACK_BLUEALSAAPLAY" value="ON" checked>
  <?} else {?>
    <input type="checkbox" id="jack" name="JACK_BLUEALSAAPLAY" value="ON">
  <?}?>
</td>
<td>
	<input type="hidden" name="JACK_NETJACK" value="OFF">
  <? if ($ini_array["JACK_NETJACK"] == "ON"){ ?>
    <input type="checkbox" id="jack" name="JACK_NETJACK" value="ON" checked>
  <?} else {?>
    <input type="checkbox" id="jack" name="JACK_NETJACK" value="ON">
  <?}?>
</td>
</tr>


<tr>
    <td><?
        if ($ini_array["AUDIO_OUTPUT"] == "jack-bf")
            { ?> <input class="actiongroup" type="radio" name="AUDIO_OUTPUT" value="jack-bf" checked> BruteFIR <?}
        else
            {?> <input class="actiongroup" type="radio" name="AUDIO_OUTPUT" value="jack-bf"> BruteFIR <?}?>
    </td>

    <td>
        <input type="hidden" name="JACKBF_SQUEEZELITE" value="OFF"><?
        if ($ini_array["JACKBF_SQUEEZELITE"] == "ON")
            { ?> <input type="checkbox" id="jackbf" name="JACKBF_SQUEEZELITE" value="ON" checked> <?}
        else
            {?> <input type="checkbox" id="jackbf" name="JACKBF_SQUEEZELITE" value="ON"> <?}?>
    </td>

    <td>
	    <input type="hidden" name="JACKBF_GMEDIARENDER" value="OFF"><?
        if ($ini_array["JACKBF_GMEDIARENDER"] == "ON")
            { ?> <input type="checkbox" id="jackbf" name="JACKBF_GMEDIARENDER" value="ON" checked> <?}
        else
        {?> <input type="checkbox" id="jackbf"name="JACKBF_GMEDIARENDER" value="ON"> <?}?>
    </td>

    <td>
	    <input type="hidden" name="JACKBF_SHAIRPORTSYNC" value="OFF"> <?
        if ($ini_array["JACKBF_SHAIRPORTSYNC"] == "ON")
            { ?> <input type="checkbox" id="jackbf" name="JACKBF_SHAIRPORTSYNC" value="ON" checked> <?}
        else
            {?> <input type="checkbox" id="jackbf" name="JACKBF_SHAIRPORTSYNC" value="ON"> <?}?>
    </td>

    <td>
	    <input type="hidden" name="JACKBF_BLUEALSAAPLAY" value="OFF"> <?
        if ($ini_array["JACKBF_BLUEALSAAPLAY"] == "ON")
            { ?> <input type="checkbox" id="jackbf" name="JACKBF_BLUEALSAAPLAY" value="ON" checked> <?}
        else
            {?> <input type="checkbox" id="jackbf" name="JACKBF_BLUEALSAAPLAY" value="ON"> <?}?>
    </td>

    <td>
	    <input type="hidden" name="JACKBF_NETJACK" value="OFF"> <?
        if ($ini_array["JACKBF_NETJACK"] == "ON")
            { ?> <input type="checkbox" id="jackbf" name="JACKBF_NETJACK" value="ON" checked> <?}
        else
          {?> <input type="checkbox" id="jackbf" name="JACKBF_NETJACK" value="ON"> <?}?>
    </td>
</tr>


<tr>
    <td><?
        if ($ini_array["AUDIO_OUTPUT"] == "jack-bfms")
            { ?> <input class="actiongroup" type="radio" name="AUDIO_OUTPUT" value="jack-bfms" checked> BruteFIR MS <?}
        else
            {?> <input class="actiongroup" type="radio" name="AUDIO_OUTPUT" value="jack-bfms"> BruteFIR MS <?}?>
    </td>

    <td>
        <input type="hidden" name="JACKBFMS_SQUEEZELITE" value="OFF"><?
        if ($ini_array["JACKBFMS_SQUEEZELITE"] == "ON")
            { ?> <input type="checkbox" id="jackbfms" name="JACKBFMS_SQUEEZELITE" value="ON" checked> <?}
        else
            {?> <input type="checkbox" id="jackbfms" name="JACKBFMS_SQUEEZELITE" value="ON"> <?}?>
    </td>

    <td>
	    <input type="hidden" name="JACKBFMS_GMEDIARENDER" value="OFF"><?
        if ($ini_array["JACKBFMS_GMEDIARENDER"] == "ON")
            { ?> <input type="checkbox" id="jackbfms" name="JACKBFMS_GMEDIARENDER" value="ON" checked> <?}
        else
        {?> <input type="checkbox" id="jackbfms"name="JACKBFMS_GMEDIARENDER" value="ON"> <?}?>
    </td>

    <td>
	    <input type="hidden" name="JACKBFMS_SHAIRPORTSYNC" value="OFF"> <?
        if ($ini_array["JACKBFMS_SHAIRPORTSYNC"] == "ON")
            { ?> <input type="checkbox" id="jackbfms" name="JACKBFMS_SHAIRPORTSYNC" value="ON" checked> <?}
        else
            {?> <input type="checkbox" id="jackbfms" name="JACKBFMS_SHAIRPORTSYNC" value="ON"> <?}?>
    </td>

    <td>
	    <input type="hidden" name="JACKBFMS_BLUEALSAAPLAY" value="OFF"> <?
        if ($ini_array["JACKBFMS_BLUEALSAAPLAY"] == "ON")
            { ?> <input type="checkbox" id="jackbfms" name="JACKBFMS_BLUEALSAAPLAY" value="ON" checked> <?}
        else
            {?> <input type="checkbox" id="jackbfms" name="JACKBFMS_BLUEALSAAPLAY" value="ON"> <?}?>
    </td>

    <td>
	    <input type="hidden" name="JACKBFMS_NETJACK" value="OFF"> <?
        if ($ini_array["JACKBFMS_NETJACK"] == "ON")
            { ?> <input type="checkbox" id="jackbfms" name="JACKBFMS_NETJACK" value="ON" checked> <?}
        else
          {?> <input type="checkbox" id="jackbfms" name="JACKBFMS_NETJACK" value="ON"> <?}?>
    </td>
</tr>

</table>

</fieldset>
</div>


<br>
<input class="button" type="submit" value=" <? print ${button_submit_audiosettings._.$lang} ?> " name="audiosettings_submit">
<br>
</fieldset>
</div> <!-- Ende Audio Einstellungen -->


<div class="content"> <!-- Content zentrieren -->
<input class="button" type="submit" value=" <? print ${button_submit._.$lang} ?> " name="submit">
<input class="button" type="submit" value=" <? print ${button_reboot._.$lang} ?> " name="reboot">
</div>

</form>
<? unset($_POST['submit']);?>

<? include "footer.php";?>




<script>

$(document).ready(function () {
  $('input[id="raw"]').prop('checked', false);
  $('input[id="raw"]:first').prop('checked', true)

  $('input[id="raw"]').click(function (event) {
    $('input[id="raw"]').prop('checked', false);
    $(this).prop('checked', true);

    //event.preventDefault();
  });



  $('input[id="raw"]').click(function (event) {
    $('input[id="output"]').prop('checked', false);
    $(this).prop('checked', true);

    //event.preventDefault();
  });


});



</script>
