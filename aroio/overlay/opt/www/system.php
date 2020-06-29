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
        shell_exec('cardmount rw');
        wrtToUserconfig('USEBETA',$_POST['USEBETA']);
        shell_exec('cardmount ro');

        if ($_POST['USEBETA'] == "ON")
        {
            exec ( "/usr/bin/update -c -u beta" , $ausgabe , $return_var );
        }
        else
        {
            exec ( "/usr/bin/update -c" , $ausgabe , $return_var );
        }

        if (preg_match( '/([0-9])([\.][0-9]){1,2}/', "$ausgabe[0]" ) )
        {
          list($remote[0], $remote[1], $remote[2]) = explode(".", $ausgabe[0]);
          list($local[0], $local[1], $local[2]) = explode(".", $ausgabe[1]);
        }
        if ($remote[0] > $local[0])
        {
            $update_message="<h1>${"infotext_update_available_"."$lang"}</h1>";
        }
        else
        {
            if ($remote[0] == $local[0] && $remote[1] > $local[1])
            {
                $update_message="<h1>${"infotext_update_available_"."$lang"}</h1>";
            }
            else
            {
                if ($remote[0] == $local[0] && $remote[1] == $local[1] && $remote[2] > $local[2])
                {
                    $update_message="<h1>${"infotext_update_available_"."$lang"}</h1>";
                }
                else
                {
                    $update_message="<b>${"infotext_update_unchanged_"."$lang"}</b>";
                }
            }
        }
        unset($_POST['submit']);
    }

    $ini_array = parse_ini_file("/boot/userconfig.txt", 1);

    if ( isset($_POST['update']) )
    {
        $update=true;
    }

    if ( isset($_POST['bluetooth_pairing']) )
    {
        shell_exec ( "killall bluetooth-sspmode > /dev/null" );
        shell_exec ( "bluetooth-sspmode > /dev/null &" );
    }

    if ( isset($_POST['bluetooth_dbpurge']) )
    {
        shell_exec ( "/usr/bin/bluetooth-dbpurge > /dev/null" );
    }
?>

<!-- Navigation -->
<ul>
  <li><a href="index.php" target=""><? print ${"linktext_configuration_"."$lang"} ?></span></a></li>
  <li><a class="select" href="system.php" target=""><? print ${"linktext_system_"."$lang"} ?></a></li>
  <li><a href="measurement.php" target=""><? print${"linktext_measurement_"."$lang"} ?></a></li>
  <li>
    <? if ($ini_array['BRUTEFIR'] == "OFF"){?>
      <a style="color: #c5c5c5" href="brutefir.php"target=""><? print ${"linktext_brutefir_"."$lang"} ?></a>
    <?}else{?>
      <a href="brutefir.php"target=""><? print ${"linktext_brutefir_"."$lang"} ?></a>
    <?}?>
  </li>

  <li style="float:right"><a href="credits.php" target=""><? print ${"linktext_credits_"."$lang"} ?></a></li>
</ul>
<!-- Ende Navigation -->

<hr class="top">
</div> <!-- Ende vom Head -->


<form id="Network settings" Name="Network settings" action="" method="post">
<div class="content">

<h1> <? print $ini_array["HOSTNAME"] ?> - <? print ${"page_title_system_"."$lang"} ?></h1>

<fieldset> <!-- Afang Update -->
  <legend><? print ${"update_form_"."$lang"};?></legend>

<?
if ($update == false){ ?>
  <fieldset style="border-style: dotted">
    <? print "${"update_info1_"."$lang"}" ; ?>
    <a href="https://www.abacus-electronics.de/produkte/streaming/aroioos.html#aroionews" target="_blank">
    <input type="button" class="button" value="Aroio News"/></a>
    <div style="text-align: center">
       <? print "${"update_info2_"."$lang"}" ; ?>
    </div>
  </fieldset>

  <table>
    <tr>
      <td>
        <a style="text-decoration: none href="#" title="<? print ${"helptext_beta_"."$lang"} ?>"class="tooltip">
        <span title=""><label for="Use beta"> <? print ${"beta_"."$lang"} ; ?> </label></span></a>

        <? if ($ini_array['USEBETA'] == "ON"){ ?>
          <input class="actiongroup" type="radio" name="USEBETA" value="OFF"> <? print ${"use_beta_off_"."$lang"} ; ?>
          <input class="actiongroup" type="radio" name="USEBETA" value="ON" checked> <? print ${"use_beta_on_"."$lang"} ; ?>
        <? }
        else
        { ?>
          <input class="actiongroup" type="radio" name="USEBETA" value="OFF" checked> <? print ${"use_beta_off_"."$lang"} ; ?>
          <input class="actiongroup" type="radio" name="USEBETA" value="ON"> <? print ${"use_beta_on_"."$lang"} ;
        } ?>
      <td>
        <input class="button" type="submit" value=" <? print ${"button_check_update_"."$lang"} ?> " name="check_update">
      </td>
    </tr>
    <tr>
      <td>
        <? print ${"local_version_"."$lang"};?>
        <? if(is_numeric($local[2])) $separator_local="." ?>
        <b><? echo $local[0].".".$local[1]."$separator_local".$local[2]; ?></b>
        <br>
        <? if(is_numeric($remote[2])) $separator_remote="." ?>
        <? print ${"remote_version_"."$lang"};?>
        <b><? echo $remote[0].".".$remote[1]."$separator_remote".$remote[2]; ?></b>
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
        <input class="button" type="submit" value=" <? print ${"button_update_"."$lang"} ?> " name="update">
      </div>
    </fieldset> <?
  }
}
else
{
  print ${"infotext_update_running_"."$lang"}; ?>
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

<? include "bluetooth.php"; ?>  


<fieldset> <!-- System-Informationen -->
<legend><? print ${"sysinfo_form_"."$lang"};?></legend>

<?
$uptime=echo_uptime();
$mac_addr_lan=echo_mac_lan();
$ip_addr_lan=get_ipaddr_lan();
$mac_addr_wlan=echo_mac_wlan();
$ip_addr_wlan=get_ipaddr_wlan();
$carrierstate=echo_carrierstate();

if ( $carrierstate == '0')
$carrierstate=${"infotext_carrierstate_0_"."$lang"};
else $carrierstate=${"infotext_carrierstate_1_"."$lang"};
?>
<p>
<table>
  <tr>
    <td>
        <? print ${"infotext_uptime_"."$lang"};?>
    </td>
    <td>
        <? echo "$uptime"; ?>
    </td>
  </tr>
  <tr>
    <td>
        <? print ${"infotext_macaddr_lan_"."$lang"};?>
    </td>
    <td>
        <? echo "$mac_addr_lan"; ?>
    </td>
  </tr>
  <tr>
    <td>
        <? print ${"infotext_ipaddr_lan_"."$lang"};?>
    </td>
    <td>
        <? echo "$ip_addr_lan[0]"; ?>
    </td>
  </tr>
  <tr>

    <? $test_wlan=test_wlan();
if ($test_wlan == "0"){?>
    <td>
        <? print ${"infotext_macaddr_wlan_"."$lang"};?>
    </td>
    <td>
        <? echo "$mac_addr_wlan"; ?>
    </td>
  </tr>
  <tr>
    <td>
        <? print ${"infotext_ipaddr_wlan_"."$lang"};?>
    </td>
    <td>
        <? if ($ip_addr_wlan[0] == "") echo ${"infotext_wlan_unconfigured_"."$lang"};
        else echo "$ip_addr_wlan[0]"; ?>
    </td>
  </tr>

<?}?>
  <tr>
    <td><? print ${"infotext_carrierstate_"."$lang"}.$carrierstate; ?> </td><td></td>

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
      <input class="button" type="submit" class="actiongroup" value=" <? print ${"button_ifconfig_"."$lang"} ?> " name="ifconfig">
    </td>

    <td>
      <input class="button" type="submit" class="actiongroup" value=" <? print ${"button_dmesg_"."$lang"} ?> " name="dmesg">
    </td>

    <td>
      <input class="button" type="submit" class="actiongroup" value=" <? print ${"button_deliver_log_"."$lang"} ?> " name="deliver_log">
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
