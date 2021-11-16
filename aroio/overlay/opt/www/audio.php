<?
include "audio_matrix.php";
?>
  <!-- Audio -->
  <div class="content">
    <fieldset>
      <legend><? print ${"audio_form_"."$lang"};?></legend>
      <table>
        <tr>
          <td>
            <a title="<? print ${"helptext_advancedsettings_"."$lang"} ?>"class="tooltip">
            <span title=""><label for="Advanced settings"> <? print ${"advancedsettings_"."$lang"} ; ?> </label></span></a>
            <input type="hidden" name="ADVANCED" value="OFF">
            <input type="checkbox" id="advanced" name="ADVANCED" value="ON" <? check_if_on($ini_array["ADVANCED"]) ?>>
          </td>
        </tr>

        <tr>
          <td>
            <a title="<? print ${"helptext_playername_"."$lang"} ?>"class="tooltip">
            <span title=""><label for="Player name"> <? print ${"player_name_"."$lang"} ; ?> </label></span></a>
          </td>
          <td>
            <? if ( $ini_array["PLAYERNAME"] == "" ) { $ini_array["PLAYERNAME"] = $ini_array["HOSTNAME"]; } ?>
            <input class="actiongroup" type="text" name="PLAYERNAME" value="<? print $ini_array["PLAYERNAME"] ?>">
          </td>
        </tr>
        <?
        if ($_POST["PLATFORM"] != "AroioSU" && $_POST["PLATFORM"] != "AroioEX" && $ini_array["PLATFORM"] !="AroioSU" && $ini_array["PLATFORM"] !="AroioEX") // Depending on theese, values are set in index.php!
        { ?>
          <tr>
            <td>
              <a title="<? print ${"helptext_volume_"."$lang"} ?>"class="tooltip">
              <span title=""><label for="Volume"> <? print ${"volume_"."$lang"} ; ?> </label></span></a>
            </td>
            <td> <?
              $arr_volume=array
              (
                array(0," 0 dB"),
                array(-5,"-5 dB"),
                array(-10,"-10 dB"),
                array(-15,"-15 dB"),
                array(-20,"-20 dB"),
                array(-25,"-25 dB"),
                array(-30,"-30 dB"),
                array(-35,"-35 dB"),
                array(-40,"-40 dB"),
                array(-45,"-45 dB"),
                array(-50,"-50 dB"),
                array(-55,"-55 dB"),
                array(-60,"-60 dB")
              );
              print_optgroup2D("VOLUME_START",$arr_volume,$ini_array["VOLUME_START"]); ?>
            </td>
          </tr> <?
        } ?>

        <tr>
          <td>
            <a title="<? print ${"helptext_soundcard_"."$lang"} ?>"class="tooltip">
            <span title=""><label for="Soundcard"> <? print ${"soundcard_"."$lang"} ; ?> </label></span></a>
          </td>
          <td>
            <?$arr_soundcard= array('Internal HDMI audio','Internal audio jack','AroioDAC','AroioDAC-SRC','JustBoom DAC','HiFiBerry DAC','HiFiBerry DAC+','HiFiBerry DAC+ ADC','HiFiBerry Digi','IQAudIO DAC','Allo Piano DAC','Allo Piano 2.1 DAC','Allo Boss DAC','Allo DigiOne','Dr. DAC prime','Focusrite Scarlett','M-Audio Fast Track Pro','RME Fireface UCX','USB Class Compliant','I-Sabre Q2M');
              print_optgroup("SOUNDCARD",$arr_soundcard,$ini_array["SOUNDCARD"]); ?>
          </td>
        </tr>
      </table>

        <table>
          <tr>
            <td>
              <a title="<? print ${"helptext_samplerate_"."$lang"} ?>"class="tooltip">
              <? print ${"samplerate_"."$lang"} ; ?>
            </td>
            <td> <?
              switch ($ini_array["SOUNDCARD"])
              {
                case "Internal HDMI audio":
                case "Internal audio jack":
                case "M-Audio Fast Track Pro":
                    $arr_rate= array('44100','48000');
                    break;

                case "AudioQuest DragonFly":
                case "AudioQuest Beetle":
                case "RME Fireface UCX":
                case "Focusrite Scarlett":
        			  case "Dr. DAC prime":
                  $arr_rate= array('44100','48000','96000');
                  break;

                case "XMOS Evaluation Board":
                case "USB Class Compliant":
                case "AroioDAC":
                case "AroioDAC-SRC":
                case "IQAudIO DAC":
                case "HiFiBerry Digi":
                case "HiFiBerry DAC":
                case "HiFiBerry DAC+":
                case "HiFiBerry DAC+ ADC":
                case "JustBoom DAC":
                case "Allo Piano DAC":
                case "Allo Piano 2.1 DAC":
                case "Allo Boss DAC":
                case "Allo DigiOne":
                case "I-Sabre Q2M":
                  $arr_rate= array('44100','48000','96000','176400','192000');
                  break;
              }
              print_optgroup("RATE",$arr_rate,$ini_array["RATE"]); ?>
              <span id="rate_direct"><? print ${"samplerate_direct_"."$lang"} ?></span>
            </td>
          </tr> <?
          include "audio_adv.php"; ?>
        </table>
    </fieldset>

    <input class="button" type="submit" value=" <? print ${"button_submit_apply_"."$lang"} ?> " name="audiosettings_submit">
    <div>
      <br>
      <hr class="top">
      <br>
    </div>

  </div>
