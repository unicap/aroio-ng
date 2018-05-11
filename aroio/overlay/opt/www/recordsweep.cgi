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
?>
<html>
	<meta name="viewport" content="width=615, initial-scale=1">

	<head>
		<title> <? print ${title_measurement._.$lang}; ?> </title>
	</head>

	<a href="http://www.abacus-electronics.de" target="_blank"><img src="abacus_logo_wide.png" border="0"></a>

	<body>
		<br><a href="<?php echo $PHP_SELF?>?lang=en" target=""><img src="english.png" border="0"></a>
		<a href="<?php echo $PHP_SELF?>?lang=de" target=""><img src="german.png" border="0"></a>
		<a href="index.php" target=""><? print ${linktext_configuration._.$lang} ?></a>
		<a href="system.php" target=""><? print ${linktext_system._.$lang} ?></a>
		<a href="measurement.php" target=""><? print ${linktext_measurement._.$lang} ?></a>
		<? if ($ini_array['BRUTEFIR'] == "ON"){?>
			<a href="brutefir.php"target=""><? print ${linktext_brutefir._.$lang} ?></a> <?
		}?>

		<h1> <? print ${page_title_measurement._.$lang} ; print $ini_array["HOSTNAME"] ?></h1>
		<form id="Network settings" Name="Network settings" action="" method="post">
		<div class="content">
			<fieldset>
				<legend> <? print ${measurement_form._.$lang} ; ?> </legend>
				<? print "${measurement_warning._.$lang}" ; ?> <br><br>
				<? if ( isset($_POST['start_measurement']) )
				{
					?> <pre> <?
						print "Messung l&auml;uft, bitte warten...";
					?> </pre> <?
					measurement();
					$measurement_done="true";
				}
				else
				{
						?> <input type="submit" value=" <? print ${start_measurement._.$lang} ?> " name="start_measurement"> <?
				} ?>
		</div>
	</body>
</html>
