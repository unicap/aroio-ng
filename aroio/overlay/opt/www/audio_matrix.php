<?
$arr_audio_output = array
(
  array("vol-plug", "Direct"),
  array("jack", "Bus"),
  array("jack-bf", "Convolver"),
);

$arr_raw_players = array
  (
    array("squeezelite", "Squeeze"),
    array("spotifyd", "Spotifyd"),
    array("gmediarender", "UPnP"),
    array("shairportsync", "ShAirPlay"),
    array("bluealsaaplay", "Bluetooth")
  );
?>

<div class="content">
  <fieldset>
    <legend><? print ${"audio_matrix_form_"."$lang"};?></legend>

    <table>
    <tr>
      <td>
        <a class="tooltip"
           id="help_audio_output"
           title=""
           data-direct="<? print ${"helptext_audio_out_direct_"."$lang"} ?>"
           data-bus="<? print ${"helptext_audio_out_bus_"."$lang"} ?>"
           data-convol="<? print ${"helptext_audio_out_convol_"."$lang"} ?>">
          <span>Output</span>
        </a>
      </td>
      <td id="audio_output">
      <?
      $output_value = get_audio_output($ini_array["AUDIO_OUTPUT"]);
      print_optgroup2D("AUDIO_OUTPUT", $arr_audio_output, $output_value);
      ?>
      </td>
    </tr>

    <tr>
      <td>
        <a title="<? print ${"helptext_audio_cleaner_"."$lang"} ?>"class="tooltip">
          <span>Cleaner</span>
        </a>
      </td>
      <td>
      <?
      if (!get_cleaner_enabled($ini_array["AUDIO_OUTPUT"]) || $_POST["CLEANER"] == "OFF")
      { ?>
          <input class="actiongroup" type="radio" name="CLEANER" value="OFF" checked> <?print ${"cleaner_off_"."$lang"}?>
          <input class="actiongroup" type="radio" name="CLEANER" value="ON"> <?print ${"cleaner_on_"."$lang"}?>
      <? }
      else
      { ?>
          <input class="actiongroup" type="radio" name="CLEANER" value="OFF"> <?print ${"cleaner_off_"."$lang"}?>
          <input class="actiongroup" type="radio" name="CLEANER" value="ON" checked> <?print ${"cleaner_on_"."$lang"}?>
      <? }
      ?>
      </td>
    </tr>

    <tr id="player_raw">
      <td>Player</td>
      <td>
          <select name="RAW_PLAYER" class="actiongroup">
          <?
          foreach ($arr_raw_players as $option)
          {
            $out = "<option ";
            if ($option[0] == $ini_array["RAW_PLAYER"])
              { $out .= "selected "; }
            if ($option[0] == "bluealsaaplay")
              {
                ob_start();
                test_bt();
                $out .= ob_get_clean();
              }
            $out .= " value=".$option[0].">".$option[1]."</option>";
            echo $out;
          }
          ?>
          </select>
        </td>
      </tr>
    </table>

    <table>
      <tr id="output_headline_title">
        <td><b>Players</b></td>
      </tr>
      <tr id="output_headline">
        <!-- Headline with playernames ---------------------------------->
        <td>Squeeze</td>
        <td>Spotifyd</td>
        <td>UPnP</td>
        <td>ShAirPlay</td>
        <td>Bluetooth</td>
        <td>Line In</td>
        <td>NetJack</td>
      </tr>

      <tr id="output_mixer">
        <td>
          <input type="hidden" name="JACK_SQUEEZELITE" value="OFF">
          <input type="checkbox" name="JACK_SQUEEZELITE" value="ON" <? check_if_on($ini_array["JACK_SQUEEZELITE"]) ?> >
        </td>

        <td>
          <input type="hidden" name="JACK_SPOTIFYD" value="OFF">
          <input type="checkbox" name="JACK_SPOTIFYD" value="ON" <? check_if_on($ini_array["JACK_SPOTIFYD"]) ?> >
        </td>

        <td>
          <input type="hidden" name="JACK_GMEDIARENDER" value="OFF">
          <input type="checkbox" name="JACK_GMEDIARENDER" value="ON" <? check_if_on($ini_array["JACK_GMEDIARENDER"]) ?> >
        </td>

        <td>
          <input type="hidden" name="JACK_SHAIRPORTSYNC" value="OFF">
          <input type="checkbox"  name="JACK_SHAIRPORTSYNC" value="ON" <? check_if_on($ini_array["JACK_SHAIRPORTSYNC"]) ?> >
        </td>

        <td>
          <input type="hidden" name="JACK_BLUEALSAAPLAY" value="OFF" <? test_bt() ?> >
          <input type="checkbox" name="JACK_BLUEALSAAPLAY" value="ON" <? check_if_on($ini_array["JACK_BLUEALSAAPLAY"]); test_bt() ?> >
        </td>

        <td>
          <input type="hidden" name="JACK_INPUT" value="OFF" <? test_input() ?> >
          <input type="checkbox" name="JACK_INPUT" value="ON" <? check_if_on($ini_array["JACK_INPUT"]); test_input() ?> >
        </td>

        <td>
          <input type="hidden" name="JACK_NETJACK" value="OFF">
          <input type="checkbox" name="JACK_NETJACK" value="ON" <? check_if_on($ini_array["JACK_NETJACK"]) ?> >
        </td>
      </tr>

    </table>

  </fieldset>
</div>
