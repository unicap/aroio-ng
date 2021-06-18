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
//  print_r($ini_array);



  if ( isset($_POST['submit']) || isset($_POST['audiosettings_submit']) )
  {
    if ($_POST['DHCP'] == "OFF")
    {
      if ( !validate_input("IPADDR",$_POST['LAN_IPADDR']) )
        $error="${error_invalid_ipaddr._.$lang}<br />";

      if ( !validate_input("IPADDR",$_POST['LAN_DNSSERV']) )
        $error.="${error_invalid_dnsserver._.$lang}<br />";

      if ( !validate_input("NETMASK",$_POST['LAN_NETMASK']) )
          $error.="${error_invalid_netmask._.$lang}<br />";

      if ( !validate_input("HOSTNAMEORIP",$_POST['LAN_GATEWAY']) )
          $error.="${error_invalid_gateway._.$lang}<br />";

      if ( !validate_input("LMS",$_POST['SERVERNAME']) )
          $error.="${error_invalid_servername._.$lang}<br />";
    }

    if ( !validate_input("HOSTNAME",$_POST['HOSTNAME']) )
      $error.="${error_invalid_hostname._.$lang}<br />";

    if ( !validate_input("SERVERPORT",$_POST['SERVERPORT']) )
      $error.="${error_invalid_squeezeport._.$lang}<br />";

    if ($_POST["PLATFORM"] == "AroioSU" || $_POST["PLATFORM"] == "AroioEX")
    {
     $_POST['VOLUME_START']=0;
    }


    if ($_POST["ADVANCED"] == "OFF")
    {
      $_POST['SP_INTERPOL']='soxr';
      switch ($_POST["RATE"])
      {
        case 44100:
          $_POST['JACKBUFFER']=4096;
          $_POST['JACKPERIOD']=3;
          $_POST['SQUEEZE_ALSABUFFER']=16384;
          $_POST['SQUEEZE_ALSAPERIOD']=4;
          $_POST['SQUEEZE_INTBUFFER']=16384;
          $_POST['SQUEEZE_OUTBUFFER']=8192;
          $_POST['SP_OUTBUFFER']=32768;
          $_POST['SP_PERIOD']=2;
          $_POST['BF_PARTITIONS']=2;
          $_POST['RESAMPLING']='speexrate_medium';
          $_POST['SPRATE']=44100;
          $_POST['SP_INTERPOL']='soxr';
        break;

        case 48000:
          $_POST['JACKBUFFER']=4096;
          $_POST['JACKPERIOD']=3;
          $_POST['SQUEEZE_ALSABUFFER']=16384;
          $_POST['SQUEEZE_ALSAPERIOD']=4;
          $_POST['SQUEEZE_INTBUFFER']=8192;
          $_POST['SQUEEZE_OUTBUFFER']=8192;
          $_POST['SP_OUTBUFFER']=32768;
          $_POST['SP_PERIOD']=2;
          $_POST['BF_PARTITIONS']=2;
          $_POST['RESAMPLING']='speexrate_medium';
          $_POST['SPRATE']=44100;
          $_POST['SP_INTERPOL']='soxr';
        break;

        case 96000:
          $_POST['JACKBUFFER']=4096;
          $_POST['JACKPERIOD']=3;
          $_POST['SQUEEZE_ALSABUFFER']=8192;
          $_POST['SQUEEZE_ALSAPERIOD']=4;
          $_POST['SQUEEZE_INTBUFFER']=4096;
          $_POST['SQUEEZE_OUTBUFFER']=4096;
          $_POST['SP_OUTBUFFER']=32768;
          $_POST['SP_PERIOD']=2;
          $_POST['BF_PARTITIONS']=2;
          $_POST['RESAMPLING']='speexrate_medium';
          $_POST['SPRATE']=44100;
          $_POST['SP_INTERPOL']='soxr';
        break;

        case 176400:
          $_POST['JACKBUFFER']=4096;
          $_POST['JACKPERIOD']=3;
          $_POST['SQUEEZE_ALSABUFFER']=4096;
          $_POST['SQUEEZE_ALSAPERIOD']=2;
          $_POST['SQUEEZE_INTBUFFER']=4096;
          $_POST['SQUEEZE_OUTBUFFER']=4096;
          $_POST['SP_OUTBUFFER']=32768;
          $_POST['SP_PERIOD']=2;
          $_POST['BF_PARTITIONS']=2;
          $_POST['RESAMPLING']='speexrate_medium';
          $_POST['SPRATE']=176400;
          $_POST['SP_INTERPOL']='soxr';

        case 192000:
          $_POST['JACKBUFFER']=4096;
          $_POST['JACKPERIOD']=3;
          $_POST['SQUEEZE_ALSABUFFER']=4096;
          $_POST['SQUEEZE_ALSAPERIOD']=2;
          $_POST['SQUEEZE_INTBUFFER']=4096;
          $_POST['SQUEEZE_OUTBUFFER']=4096;
          $_POST['SP_OUTBUFFER']=32768;
          $_POST['SP_PERIOD']=2;
          $_POST['BF_PARTITIONS']=2;
          $_POST['RESAMPLING']='speexrate_medium';
          $_POST['SPRATE']=44100;
          $_POST['SP_INTERPOL']='soxr';
        break;
      }
    }

    // Adjust AUDIO_OUTPUT with Cleaner checkbox
    if ($_POST['CLEANER'] == 'ON')
    {
      switch ($_POST['AUDIO_OUTPUT'])
      {
        case 'vol-plug':
          $_POST['AUDIO_OUTPUT'] = 'vol-plug-ms';
        break;

        case 'jack':
          $_POST['AUDIO_OUTPUT'] = 'jack-ms';
        break;

        case 'jack-bf':
          $_POST['AUDIO_OUTPUT'] = 'jack-bfms';
        break;
      }
    }

    // Unify all player config values (temporary solution)
    $_POST['RAW_PLAYERMS'] = $_POST['RAW_PLAYER'];

    $_POST['JACKMS_SQUEEZELITE'] = $_POST['JACK_SQUEEZELITE'];
    $_POST['JACKMS_SPOTIFYD'] = $_POST['JACK_SPOTIFYD'];
    $_POST['JACKMS_GMEDIARENDER'] = $_POST['JACK_GMEDIARENDER'];
    $_POST['JACKMS_SHAIRPORTSYNC'] = $_POST['JACK_SHAIRPORTSYNC'];
    $_POST['JACKMS_NETJACK'] = $_POST['JACK_NETJACK'];

    $_POST['JACKBF_SQUEEZELITE'] = $_POST['JACK_SQUEEZELITE'];
    $_POST['JACKBF_SPOTIFYD'] = $_POST['JACK_SPOTIFYD'];
    $_POST['JACKBF_GMEDIARENDER'] = $_POST['JACK_GMEDIARENDER'];
    $_POST['JACKBF_SHAIRPORTSYNC'] = $_POST['JACK_SHAIRPORTSYNC'];
    $_POST['JACKBF_NETJACK'] = $_POST['JACK_NETJACK'];

    $_POST['JACKBFMS_SQUEEZELITE'] = $_POST['JACK_SQUEEZELITE'];
    $_POST['JACKBFMS_SPOTIFYD'] = $_POST['JACK_SPOTIFYD'];
    $_POST['JACKBFMS_GMEDIARENDER'] = $_POST['JACK_GMEDIARENDER'];
    $_POST['JACKBFMS_SHAIRPORTSYNC'] = $_POST['JACK_SHAIRPORTSYNC'];
    $_POST['JACKBFMS_NETJACK'] = $_POST['JACK_NETJACK'];

    if ($_POST['JACK_INPUT'] == "")
    {
      $_POST['JACKMS_INPUT'] = "OFF";
      $_POST['JACKBF_INPUT'] = "OFF";
      $_POST['JACKBFMS_INPUT'] = "OFF";
    }
    if ($_POST['JACK_BLUEALSAAPLAY'] == "")
    {
      $_POST['JACKMS_BLUEALSAAPLAY'] = "OFF";
      $_POST['JACKBF_BLUEALSAAPLAY'] = "OFF";
      $_POST['JACKBFMS_BLUEALSAAPLAY'] = "OFF";
    }

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

  if ( isset($_POST['reboot']) )
  {
    $shell_exec_ret=shell_exec('cardmount rw');
    write_config();
    $shell_exec_ret=shell_exec('cardmount ro');
    unset($_POST['submit']);
    print '<h1>Configuration saved, will reboot now and redirect you here...</h1>';
    sleep(3);
    shell_exec('checksoundcard &');
    shell_exec('echo heartbeat >/sys/class/leds/led0/trigger');
    shell_exec('reboot -d 1 &');
    echo '<meta http-equiv="refresh" content="15">';
  }

  if ( isset($_POST['scan']) )
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
  }

  include "header.php";
  include "nav.php";
?><form id="Audio settings" Name="Audio settings" action="" method="post"><?
  include "network.php";
  include "webui.php";
  include "hardware.php";
  include "lms.php";
  include "audio.php";
?></form><?



unset($_POST['submit']);

include('update_check.php');
include "footer.php";

?>
