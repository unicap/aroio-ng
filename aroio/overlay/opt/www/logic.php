  if($_GET["lang"] === "en") $lang='en';
  else $lang='de';

  $ini_array = parse_ini_file("/boot/userconfig.txt", 1);

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

    if ($_POST["ADVANCED"] == "OFF")
    {
      switch ($_POST["RATE"])
      {
        case 44100:
          $_POST[JACKBUFFER]=2048;
          $_POST[JACKPERIOD]=3;
          $_POST[SQUEEZE_ALSABUFFER]=16384;
          $_POST[SQUEEZE_ALSAPERIOD]=4;
          $_POST[SQUEEZE_INTBUFFER]=16384;
          $_POST[SQUEEZE_OUTBUFFER]=8192;
          $_POST[SP_OUTBUFFER]=16384;
          $_POST[SP_PERIOD]=2;
          $_POST[BF_PARTITIONS]=2;
          $_POST[RESAMPLING]=speexrate_medium;
          $_POST[SPRATE]=44100;
          $_POST['SP_INTERPOL']=soxr;
        break;

        case 48000:
          $_POST[JACKBUFFER]=2048;
          $_POST[JACKPERIOD]=3;
          $_POST[SQUEEZE_ALSABUFFER]=16384;
          $_POST[SQUEEZE_ALSAPERIOD]=4;
          $_POST[SQUEEZE_INTBUFFER]=8192;
          $_POST[SQUEEZE_OUTBUFFER]=8192;
          $_POST[SP_OUTBUFFER]=16384;
          $_POST[SP_PERIOD]=2;
          $_POST[BF_PARTITIONS]=4;
          $_POST[RESAMPLING]=speexrate_medium;
          $_POST[SPRATE]=44100;
          $_POST['SP_INTERPOL']=soxr;
        break;

        case 96000:
          $_POST[JACKBUFFER]=2048;
          $_POST[JACKPERIOD]=3;
          $_POST[SQUEEZE_ALSABUFFER]=8192;
          $_POST[SQUEEZE_ALSAPERIOD]=4;
          $_POST[SQUEEZE_INTBUFFER]=4096;
          $_POST[SQUEEZE_OUTBUFFER]=4096;
          $_POST[SP_OUTBUFFER]=16384;
          $_POST[SP_PERIOD]=2;
          $_POST[BF_PARTITIONS]=2;
          $_POST[RESAMPLING]=speexrate_medium;
          $_POST[SPRATE]=88200;
          $_POST['SP_INTERPOL']=soxr;
        break;

        case 176400:
          $_POST[JACKBUFFER]=2048;
          $_POST[JACKPERIOD]=3;
          $_POST[SQUEEZE_ALSABUFFER]=4096;
          $_POST[SQUEEZE_ALSAPERIOD]=4;
          $_POST[SQUEEZE_INTBUFFER]=4096;
          $_POST[SQUEEZE_OUTBUFFER]=4096;
          $_POST[SP_OUTBUFFER]=16384;
          $_POST[SP_PERIOD]=2;
          $_POST[BF_PARTITIONS]=1;
          $_POST[RESAMPLING]=speexrate_medium;
          $_POST[SPRATE]=176400;
          $_POST['SP_INTERPOL']=soxr;
        break;

        case 192000:
          $_POST[JACKBUFFER]=2048;
          $_POST[JACKPERIOD]=3;
          $_POST[SQUEEZE_ALSABUFFER]=4096;
          $_POST[SQUEEZE_ALSAPERIOD]=4;
          $_POST[SQUEEZE_INTBUFFER]=4096;
          $_POST[SQUEEZE_OUTBUFFER]=4096;
          $_POST[SP_OUTBUFFER]=16384;
          $_POST[SP_PERIOD]=2;
          $_POST[BF_PARTITIONS]=1;
          $_POST[RESAMPLING]=speexrate_medium;
          $_POST[SPRATE]=44100;
          $_POST['SP_INTERPOL']=soxr;
        break;
      }
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
