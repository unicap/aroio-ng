
<div class="content">
  <h1> <? print $ini_array["HOSTNAME"]?> - <? print ${page_title_main._.$lang} ?></h1>
  <ul>
    <li>
       <a class="select" href="index.php" target=""><? print ${linktext_configuration._.$lang} ?></span></a>
    </li>
    <li>
       <a href="system.php" target=""><? print ${linktext_system._.$lang} ?></a>
    </li>
    <li>
       <a href="measurement.php" target=""><? print${linktext_measurement._.$lang} ?></a>
    </li>
    <li> <?
      if ($ini_array['BRUTEFIR'] == "OFF") { ?>
        <a style="color: #c5c5c5" href="brutefir.php"target=""><? print ${linktext_brutefir._.$lang} ?> </a> <?
      }
      else { ?>
        <a href="brutefir.php"target=""><? print ${linktext_brutefir._.$lang} ?></a> <?
      } ?>
    </li>
    <li style="float:right"><a href="credits.php" target=""><? print ${linktext_credits._.$lang} ?></a></li>
  </ul><!-- Ende Navigation -->
  <hr class="top">
</div> <!-- Ende vom Head -->
