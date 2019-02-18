<?php
    ob_start();
    include('header.php');
    include('strings.php');
    include('functions.inc.php');
    include('style.css');
//    print_r($_POST);

    if($_GET["lang"] === "en") $lang='en'; else $lang='de';

    if ( isset($_POST['check_update']) )
    {
        //$shell_exec_ret=shell_exec('chmod 750 /usr/bin/update check');
        wrtToUserconfig('USEBETA',$_POST['USEBETA']);
        if ($_POST['USEBETA'] == "ON"){
            exec ( "/usr/bin/update -c -u beta" , $ausgabe , $return_var  );}
        else{
            exec ( "/usr/bin/update -c" , $ausgabe , $return_var  );}
        list($remote[0], $remote[1]) = explode(".", $ausgabe[0]);
        list($local[0], $local[1]) = explode(".", $ausgabe[1]);
        if (is_numeric("$remote[0]")){
            if ($remote[0] > $local[0]) $update_message="<h1>${infotext_update_available._.$lang}</h1>";}
        if ($remote[0] == $local[0] && $remote[1] > $local[1])
        {
            $update_message="<h1>${infotext_update_available._.$lang}</h1>";
            shell_exec('cardmount rw');
        }
        else
        {
            $update_message="<b>${infotext_update_unchanged._.$lang}</b>";
            shell_exec('cardmount rw');
        }
        unset($_POST['submit']);
    }

    $ini_array = parse_ini_file("/boot/userconfig.txt", 1);

    if ( isset($_POST['update']) )
    {
        $update=true;
        //exec("/usr/bin/update update" , $update_output);
    }

//    include "header.php";
?>

<!-- Navigation -->
<ul>
<li><a href="index.php" target=""><? print ${linktext_configuration._.$lang} ?></span></a></li>
<li><a class="select" href="system.php" target=""><? print ${linktext_system._.$lang} ?></a></li>
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


<form id="Network settings" Name="Network settings" action="" method="post">
<div class="content">

<h1> <? print $ini_array["HOSTNAME"] ?> - <? print ${page_title_system._.$lang} ?></h1>

<fieldset> <!-- Afang Update -->
<legend><? print ${update_form._.$lang};?></legend>

<?
if ($update == false){ ?>
  <fieldset style="border-style: dotted">
      <? print "${update_info1._.$lang}" ; ?>
      <a href="https://www.abacus-electronics.de/produkte/streaming/aroioos.html#aroionews" target="_blank">
      <input type="button" class="button" value="Aroio News"/></a>

      <div style="text-align: center">
         <? print "${update_info2._.$lang}" ; ?>
      </div>
  </fieldset>

  <table>
    <tr>
      <td>
        <a style="text-decoration: none href="#" title="<? print ${helptext_beta._.$lang} ?>"class="tooltip">
        <span title=""><label for="Use beta"> <? print ${beta._.$lang} ; ?> </label></span></a>

        <? if ($ini_array['USEBETA'] == "ON"){ ?>
          <input class="actiongroup" type="radio" name="USEBETA" value="OFF"> <? print ${use_beta_off._.$lang} ; ?>
          <input class="actiongroup" type="radio" name="USEBETA" value="ON" checked> <? print ${use_beta_on._.$lang} ; ?>
        <? }
        else
        { ?>
          <input class="actiongroup" type="radio" name="USEBETA" value="OFF" checked> <? print ${use_beta_off._.$lang} ; ?>
          <input class="actiongroup" type="radio" name="USEBETA" value="ON"> <? print ${use_beta_on._.$lang} ;
        } ?>
      <td>
        <input class="button" type="submit" value=" <? print ${button_check_update._.$lang} ?> " name="check_update">
      </td>
    </tr>
    <tr>
      <td>
        <? print ${local_version._.$lang};?>
        <b><? echo $local[0].".".$local[1]; ?></b>
        <br>
        <? print ${remote_version._.$lang};?>
        <b><? echo $remote[0].".".$remote[1]; ?></b>
      </td>
    </tr>
  </table>

  <?
  if ($update_message != "")
  { ?>
    <fieldset style="border-style: dotted">
      <div style="text-align: center; margin-top: 15px">
        <? print $update_message; ?>
        <br>
        <input class="button" type="submit" value=" <? print ${button_update._.$lang} ?> " name="update">
      </div>
    </fieldset> <?
  }
}
else
{
  print ${infotext_update_running._.$lang}; ?>
  <br>
  <fieldset style="border-style: dotted"> <?
    echo '<pre>';
      if ($_POST['USEBETA'] == "ON")
      {
        while (@ ob_end_flush()); // end all output buffers if any
          $proc = popen('/usr/bin/update -u beta -m', 'r');
          echo '<pre>' ;
            while (!feof($proc))
            {
              echo fread($proc, 4096);
              @ flush();
            }
          echo '</pre>' ;
      }
      else
      {
        while (@ ob_end_flush()); // end all output buffers if any
          $proc = popen('/usr/bin/update -m', 'r');
          echo '<pre>' ;
            while (!feof($proc))
            {
              echo fread($proc, 4096);
              @ flush();
            }
          echo '</pre>' ;
      }
    echo '</pre>'; ?>
  </fieldset>
  <br>  <?
  print_r($update_output);
} ?>







</table>
</fieldset> <!-- Ende Update -->

<fieldset> <!-- System-Informationen -->
<legend><? print ${sysinfo_form._.$lang};?></legend>

<?
$uptime=echo_uptime();
$mac_addr_lan=echo_mac_lan();
$ip_addr_lan=get_ipaddr_lan();
$mac_addr_wlan=echo_mac_wlan();
$ip_addr_wlan=get_ipaddr_wlan();
$carrierstate=echo_carrierstate();

if ( $carrierstate == '0')
$carrierstate=${infotext_carrierstate_0._.$lang};
else $carrierstate=${infotext_carrierstate_1._.$lang};
?>
<p>
<table>
  <tr>
    <td>
        <? print ${infotext_uptime._.$lang};?>
    </td>
    <td>
        <? echo "$uptime"; ?>
    </td>
  </tr>
  <tr>
    <td>
        <? print ${infotext_macaddr_lan._.$lang};?>
    </td>
    <td>
        <? echo "$mac_addr_lan"; ?>
    </td>
  </tr>
  <tr>
    <td>
        <? print ${infotext_ipaddr_lan._.$lang};?>
    </td>
    <td>
        <? echo "$ip_addr_lan[0]"; ?>
    </td>
  </tr>
  <tr>

    <? $test_wlan=test_wlan();
if ($test_wlan == "0"){?>
    <td>
        <? print ${infotext_macaddr_wlan._.$lang};?>
    </td>
    <td>
        <? echo "$mac_addr_wlan"; ?>
    </td>
  </tr>
  <tr>
    <td>
        <? print ${infotext_ipaddr_wlan._.$lang};?>
    </td>
    <td>
        <? if ($ip_addr_wlan[0] == "") echo ${infotext_wlan_unconfigured._.$lang};
        else echo "$ip_addr_wlan[0]"; ?>
    </td>
  </tr>

<?}?>
  <tr>
    <td><? print ${infotext_carrierstate._.$lang}.$carrierstate; ?> </td><td></td>

  </tr>
  <tr>
    <td>LMS Server Address
    </td>
    <td>
        <? echo '<a class="forward" target="_blank" href="http://'.print_squeezeaddr($ini_array["SERVERPORT"]).'">http://'.print_squeezeaddr($ini_array["SERVERPORT"]).'</a>';?>
    </td>
  </tr>
</table>
</p>

<table>
  <tr>
    <td>
      <input class="button" type="submit" class="actiongroup" value=" <? print ${button_ifconfig._.$lang} ?> " name="ifconfig">
    </td>

    <td>
      <input class="button" type="submit" class="actiongroup" value=" <? print ${button_dmesg._.$lang} ?> " name="dmesg">
    </td>

    <td>
      <input class="button" type="submit" class="actiongroup" value=" <? print ${button_deliver_log._.$lang} ?> " name="deliver_log">
    </td>

    <td>
      <input class="button" type="submit" class="actiongroup" value="squeezelitelog" name="squeezelitelog">
    </td>
 </tr>

  <tr>
    <td>
      <input class="button" type="submit" class="actiongroup" value="systemlog" name="systemlog">
    </td>

    <td>
      <input class="button" type="submit" class="actiongroup" value="jackdlog" name="jackdlog">
    </td>

    <td>
      <input class="button" type="submit" class="actiongroup" value="brutefirlog" name="brutefirlog">
    </td>

    <td>
      <input class="button" type="submit" class="actiongroup" value="Audio-HW-Info" name="Audio-HW-Info">
    </td>
  </tr>
</table>

<?
if ( isset($_POST['ifconfig']) )
    print_cmdout('ifconfig');
if ( isset($_POST['dmesg']) )
    print_cmdout('dmesg');
if ( isset($_POST['mount']) )
    print_cmdout('mount');
if ( isset($_POST['free']) )
    print_cmdout('free');
if ( isset($_POST['systemlog']) )
    print_journalctl_boot();
if ( isset($_POST['squeezelitelog']) )
    print_journalctl('squeezelite');
if ( isset($_POST['jackdlog']) )
    print_journalctl('jackd');
if ( isset($_POST['brutefirlog']) )
    print_journalctl('brutefir');
if ( isset($_POST['Audio-HW-Info']) )
    print_audio_hw_params();
if ( isset($_POST['deliver_log']) )
//    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . '/getlogs.php');
    deliver_logs();
?>
</fieldset>
</form>
</div>
<? include "footer.php"; ?>
