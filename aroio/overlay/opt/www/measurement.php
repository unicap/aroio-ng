<?php
    include('strings.php');
    include('functions.inc.php');
    include('style.css');

    if($_GET["lang"] === "en" || $_POST[lang]=='en')
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
<li><a href="index.php" target=""><? print ${linktext_configuration._.$lang} ?></span></a></li>
<li><a href="system.php" target=""><? print ${linktext_system._.$lang} ?></a></li>
<li><a class="select" href="measurement.php" target=""><? print${linktext_measurement._.$lang} ?></a></li>
<li>
<? if ($ini_array['BRUTEFIR'] == "OFF"){?>
    <a style="color: #c5c5c5" href="brutefir.php"target=""><? print ${linktext_brutefir._.$lang} ?></a>
    <?}else{?>
        <a href="brutefir.php"target=""><? print ${linktext_brutefir._.$lang} ?></a>
        <?}?>
</li>

<li style="float:right"><a href="credits.php" target=""><? print ${linktext_credits._.$lang} ?></a></li>
</ul><!-- Ende Navigation -->

<hr class="top">
</div> <!-- Ende vom Head -->



<form id="Network settings" Name="Network settings" action="" method="post">
	<div class="content">
		<h1><? print $ini_array["HOSTNAME"] ?> - <? print ${page_title_measurement._.$lang}?></h1>

		<!-- Raumkorrekturmessung -->
		<fieldset>
		<legend>
			<? print ${measurement_form._.$lang} ; ?>
		</legend>

		<?
		print ${measurement_warning._.$lang};
		if ( isset($_POST['start_measurement']) ) { ?>
			<pre> <?
				print ${measurement_runs_.$lang}; ?>
			</pre>
   		 	<input type="submit" class="button" value=" <? print ${cancel_measurement._.$lang} ?> " name="cancel_measurement">
    		<?
    		measurement();
    		$measurement_done="true";
		}

		else { ?>
			<input type="submit" class="button" value=" <? print ${start_measurement._.$lang} ?> " name="start_measurement"> <?
		}

		if ( isset($_POST['cancel_measurement']) ) cancel_measurement() ; ?>

	</div> <!-- Ende Raumkorrekturmessung -->

	<div class="content">
		<!-- Auswertung der Messung -->
		<fieldset>
		<legend>
			<? print ${measurement_analysis_form._.$lang} ; ?>
		</legend>
		<a href="http://www.audiovero.de" target="_blank"> <img class="link" src="audiovero.png" border="0" style="float: right;"> 	</a>
		<? print "${measurement_analysis_text._.$lang}" ; ?>
	</div>
</form>

<? include "footer.php"; ?>
