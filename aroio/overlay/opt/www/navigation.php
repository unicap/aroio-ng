<hr class="top">
<div class="head">

<!-- Headerbild mit Verlinkung -->
<a href="http://www.abacus-electronics.de" title="ABACUS Website" target="_blank"><img class="top" src="img/abacus_logo_wide.png" border="0"></a>

<!-- Fahnen -->
<a style="float: right" href="<?php echo $PHP_SELF?>?lang=en" target=""><img src="img/english.png" border="0"></a>
<a style="float: right" href="<?php echo $PHP_SELF?>?lang=de" target=""><img src="img/german.png" border="0"></a>

<!-- Navigation -->
<ul>
<li>
    <a href="index.php" target=""><? print ${linktext_configuration._.$lang} ?></span></a>
</li>
<li>
    <a href="system.php" target=""><? print ${linktext_system._.$lang} ?></a>
</li>
<li>
    <a href="measurement.php" target=""><? print${linktext_measurement._.$lang} ?></a>
</li>
<li>
<? if ($ini_array['BRUTEFIR'] == "OFF"){?>
    <a style="color: #c5c5c5" href="brutefir.php"target=""><? print ${linktext_brutefir._.$lang} ?></a>
    <?}else{?>
        <a href="brutefir.php"target=""><? print ${linktext_brutefir._.$lang} ?></a>
    <?}?>
</li>
<li style="float:right">
    <a href="credits.php" target=""><? print ${linktext_credits._.$lang} ?></a>
</li>

</ul><!-- Ende Navigation -->

<hr class="top">
</div> <!-- Ende vom Head -->
