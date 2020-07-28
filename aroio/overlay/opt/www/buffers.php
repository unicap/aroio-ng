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
          $_POST['SP_INTERPOL']='soxr';
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
          $_POST['SP_INTERPOL']='soxr';
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
          $_POST['SP_INTERPOL']='soxr';
        break;

        case 176400:
          $_POST[JACKBUFFER]=2048;
          $_POST[JACKPERIOD]=3;
          $_POST[SQUEEZE_ALSABUFFER]=8192;
          $_POST[SQUEEZE_ALSAPERIOD]=4;
          $_POST[SQUEEZE_INTBUFFER]=4096;
          $_POST[SQUEEZE_OUTBUFFER]=4096;
          $_POST[SP_OUTBUFFER]=16384;
          $_POST[SP_PERIOD]=2;
          $_POST[BF_PARTITIONS]=1;
          $_POST[RESAMPLING]=speexrate_medium;
          $_POST[SPRATE]=44100;
          $_POST['SP_INTERPOL']='soxr';
        break;

        case 176400:
          $_POST[JACKBUFFER]=4096;
          $_POST[JACKPERIOD]=3;
          $_POST[SQUEEZE_ALSABUFFER]=8192;
          $_POST[SQUEEZE_ALSAPERIOD]=4;
          $_POST[SQUEEZE_INTBUFFER]=4096;
          $_POST[SQUEEZE_OUTBUFFER]=4096;
          $_POST[SP_OUTBUFFER]=16384;
          $_POST[SP_PERIOD]=2;
          $_POST[BF_PARTITIONS]=2;
          $_POST[RESAMPLING]=speexrate_medium;
          $_POST[SPRATE]=44100;
          $_POST['SP_INTERPOL']='soxr';
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
          $_POST['SP_INTERPOL']='soxr';
        break;
      }
    }
