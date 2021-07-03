<?php
  include('strings.php');
  include('functions.inc.php');

//print_r($_POST);

  if($_GET["lang"] === "en" || $_POST['lang']=='en')
  {
      $lang='en';
      $GLOBALS["lang"]='en';
  }
  else
  {
    $lang='de';
    $GLOBALS["lang"]='de';
  }

  // Load ini-array from userconfig.txt
  $ini_array = parse_ini_file("/boot/userconfig.txt", 1);

  include "header.php";?>

  <!-- Navigation -->
  <ul>
    <li><a href="index.php" target=""><? print ${"linktext_configuration_"."$lang"} ?></span></a></li>
    <li><a href="system.php" target=""><? print ${"linktext_system_"."$lang"} ?></a></li>
    <li><a class="select" href="measurement.php" target=""><? print${"linktext_measurement_"."$lang"} ?></a></li>
    <li> <?
      if ($ini_array['BRUTEFIR'] == "OFF")
      {  ?>
        <a style="color: #c5c5c5" href="brutefir.php"target=""><? print ${"linktext_brutefir_"."$lang"} ?></a> <?
      }
      else
      { ?>
          <a href="brutefir.php"target=""><? print ${"linktext_brutefir_"."$lang"} ?></a> <?
      } ?>
    </li>
    <li style="float:right"><a href="credits.php" target=""><? print ${"linktext_credits_"."$lang"} ?></a></li>
  </ul><!-- Ende Navigation -->

  <hr class="top">
  </div> <!-- Ende vom Head -->

  <form id="Network settings" Name="Network settings" action="" method="post">
    <div class="content">
      <h1><? print $ini_array["HOSTNAME"] ?> - <? print ${"page_title_measurement_"."$lang"}?></h1>
      <!-- Raumkorrekturmessung -->
      <fieldset>
        <legend>
          <? print ${"measurement_form_"."$lang"} ; ?>
        </legend>

      <?
      print ${"measurement_warning_"."$lang"};
      if (isset($_POST['PLAY_NOISE']))
      {
          if(isset($_POST['MEASURE_MS']) && $_POST['MEASURE_MS'] == "ON")
            {
              $shell_exec_ret=shell_exec('cardmount rw');
              wrtToUserconfig("MEASUREMENT_OUTPUT","vol-plug-ms");
              $shell_exec_ret=shell_exec('cardmount ro');
              $ms="ms_on";
            }
          else
            {
              $shell_exec_ret=shell_exec('cardmount rw');
              wrtToUserconfig("MEASUREMENT_OUTPUT","vol-plug");
              $shell_exec_ret=shell_exec('cardmount ro');
            }
          play_noise($ms);
      }
      if (isset($_POST['STOP_NOISE'])) stop_noise();
      if (isset($_POST['CANCEL_MEASUREMENT'])) cancel_measurement();
      if (isset($_POST['MEASUREMENT']) || file_exists('/tmp/measurement'))
      {
        if (!file_exists('/tmp/measurement') && (isset($_POST['MEASURE_MS']) && $_POST['MEASURE_MS'] == "ON"))
        {
          $shell_exec_ret=shell_exec('cardmount rw');
          wrtToUserconfig("MEASUREMENT_OUTPUT","vol-plug-ms");
          $shell_exec_ret=shell_exec('cardmount ro');
        }
        elseif(!file_exists('/tmp/measurement'))
        {
         $shell_exec_ret=shell_exec('cardmount rw');
         wrtToUserconfig("MEASUREMENT_OUTPUT","vol-plug");
         $shell_exec_ret=shell_exec('cardmount ro');
        } ?>

        <div id="measurement_modal" class="fixed-modal">
          <div class="modal-content">
            <header class="modal-header"><? print ${"start_measurement_"."$lang"}; ?></header>
            <div class="measurement-modal-container">
              <div>
                <? print ${"measurement_runs_"."$lang"}; ?>
                <br>
                <br>
                <input type="submit" class="button" value=" <? print ${"cancel_measurement_"."$lang"} ?> " name="CANCEL_MEASUREMENT">
                <?
                if (!file_exists('/tmp/measurement')) measurement();
                $measurement_done="true";
                ?>
              </div>
              <div id="measurement_finished" class="d-none">
                <br>
                <button id="measurement_close"><? print ${"button_close_"."$lang"} ?></button>
              </div>
            </div>
          </div>
        </div>
      <? }
      elseif (isset($_POST['MEASUREMENT_CONTROL']))
      {
        if (isset($_POST['MEASURE_MS']) && $_POST['MEASURE_MS'] == "ON")
        {
          $shell_exec_ret=shell_exec('cardmount rw');
          wrtToUserconfig("MEASUREMENT_OUTPUT","jack-bfms");
          $shell_exec_ret=shell_exec('cardmount ro');
        }
        else
        {
         $shell_exec_ret=shell_exec('cardmount rw');
         wrtToUserconfig("MEASUREMENT_OUTPUT","jack-bf");
         $shell_exec_ret=shell_exec('cardmount ro');
        } ?>

        <div id="measurement_modal" class="fixed-modal">
          <div class="modal-content">
            <header class="modal-header"><? print ${"start_measurement_control_"."$lang"}; ?></header>
            <div class="measurement-modal-container">
              <div>
                <? print ${"measurement_runs_"."$lang"}; ?>
                <br>
                <br>
                <input type="submit" class="button" value=" <? print ${"cancel_measurement_"."$lang"} ?> " name="CANCEL_MEASUREMENT">
                <? measurement();
                $measurement_done="true";
                ?>
              </div>
              <div id="measurement_finished" class="d-none">
                <br>
                <button id="measurement_close"><? print ${"button_close_"."$lang"} ?></button>
              </div>
            </div>
          </div>
        </div>
      <? }
      else
      {
        if (isset($_POST['PLAY_NOISE']))
        { ?>
          <div id="noise_modal" class="fixed-modal">
            <div class="modal-content">
              <header class="modal-header"><? print ${"play_noise_"."$lang"}; ?></header>
              <div class="measurement-modal-container">
                <input type="submit" class="button" value=" <? print ${"stop_noise_"."$lang"} ?> " name="STOP_NOISE">
              </div>
            </div>
          </div>
        <?
        }
        else
        { ?>
          <hr>
          <a title="<? print ${"helptext_audio_cleaner_"."$lang"} ?>"class="tooltip">
            <span>Cleaner&nbsp;<a href="https://www.abacus-electronics.de/infothek-cleaner" target="_blank" class="glossary">Was ist das?</a></span>
          </a>
          <?
          if (get_cleaner_enabled($ini_array['MEASUREMENT_OUTPUT']))
          { ?>
            <input class="actiongroup" type="radio" name="MEASURE_MS" value="OFF"> <?print ${"cleaner_off_"."$lang"}?>
            <input class="actiongroup" type="radio" name="MEASURE_MS" value="ON" checked> <?print ${"cleaner_on_"."$lang"}?>
          <? }
          else
          { ?>
            <input class="actiongroup" type="radio" name="MEASURE_MS" value="OFF" checked> <?print ${"cleaner_off_"."$lang"}?>
            <input class="actiongroup" type="radio" name="MEASURE_MS" value="ON"> <?print ${"cleaner_on_"."$lang"}?>
          <?
          }
          ?>
          <br>
          <br>
          <input type="submit" class="button" value=" <? print ${"play_noise_"."$lang"} ?> " name="PLAY_NOISE">
          <input type="submit" class="button" value=" <? print ${"start_measurement_"."$lang"} ?> " name="MEASUREMENT">
          <input type="submit" class="button" value=" <? print ${"start_measurement_control_"."$lang"} ?> " name="MEASUREMENT_CONTROL">
        <?
        }
      } ?>
    </div> <!-- Ende Raumkorrekturmessung -->

    <div class="content">
    <!-- Auswertung der Messung -->
    <fieldset>
      <legend>
        <? print ${"measurement_analysis_form_"."$lang"} ; ?>
      </legend>
      <a href="http://www.audiovero.de" target="_blank"> <img class="link" src="img/audiovero.png" border="0" style="float: right;"> 	</a>
      <? print ${"measurement_analysis_text_"."$lang"} ; ?>
    </div>
  </form>
<? include "footer.php"; ?>
