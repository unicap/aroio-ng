
<div class="content">
  <ul>
    <li>
       <a class="select" href="index.php" target=""><? print ${"linktext_configuration_"."$lang"} ?></span></a>
    </li>
    <li>
       <a href="system.php" target=""><? print ${"linktext_system_"."$lang"} ?></a>
    </li>
    <li>
       <a href="measurement.php" target=""><? print ${"linktext_measurement_"."$lang"} ?></a>
    </li>
    <li> <?
      if ($ini_array['BRUTEFIR'] == "OFF") { ?>
        <a style="color: #c5c5c5" href="brutefir.php"target=""><? print ${"linktext_brutefir_"."$lang"} ?> </a> <?
      }
      else { ?>
        <a href="brutefir.php"target=""><? print ${"linktext_brutefir_"."$lang"} ?></a> <?
      } ?>
    </li>
    <li style="float:right"><a href="credits.php" target=""><? print ${"linktext_credits_"."$lang"} ?></a></li>
  </ul><!-- Ende Navigation -->
  <hr class="top">
</div> <!-- Ende vom Head -->
