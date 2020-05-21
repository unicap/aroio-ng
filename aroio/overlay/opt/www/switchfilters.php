<!doctype html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Beispiel-Seite mit exemplarischem Inhalt im Head-Element">
    <meta name="keywords" content="example, html, head, meta">
	<meta name="viewport" content="width=300, initial-scale=4">
    <title>Switchfilters</title>
  </head>
<body>
<?php
//print_r($_POST);
?>
  <form method="post">
    <div class="content">
      <input class="button" type="submit" value="XO" name="filterset">
		<? if ( isset($_POST['filterset']) )
		{ if ($_POST['filterset'] == "XO")
    		{ ?>  ACTIVE <? ;
			shell_exec ( '/usr/bin/switchfilters 0' );}
		} ?>

      <br><br><input class="button" type="submit" value="Set 1" name="filterset">
		<? if ( isset($_POST['filterset']) )
		{ if ($_POST['filterset'] == "Set 1")
    		{ ?>  ACTIVE <? ;
			shell_exec ( '/usr/bin/switchfilters 1' );}
		} ?>

      <br><input class="button" type="submit" value="Set 2" name="filterset">
		<? if ( isset($_POST['filterset']) )
		{ if ($_POST['filterset'] == "Set 2")
    		{ ?>  ACTIVE <? ;
			shell_exec ( '/usr/bin/switchfilters 2' );}
		} ?>

      <br><input class="button" type="submit" value="Set 3" name="filterset">
		<? if ( isset($_POST['filterset']) )
		{ if ($_POST['filterset'] == "Set 3")
    		{ ?>  ACTIVE <? ;
			shell_exec ( '/usr/bin/switchfilters 3' );}
	} ?>

      <br><input class="button" type="submit" value="Set 4" name="filterset">
		<? if ( isset($_POST['filterset']) )
		{ if ($_POST['filterset'] == "Set 4")
    		{ ?>  ACTIVE <? ;
			shell_exec ( '/usr/bin/switchfilters 4' );}
		} ?>

      <br><input class="button" type="submit" value="Set 5" name="filterset">
 		<? if ( isset($_POST['filterset']) )
		{ if ($_POST['filterset'] == "Set 5")
    		{ ?>  ACTIVE <? ;
			shell_exec ( '/usr/bin/switchfilters 5' );}
		} ?>
   </div>
</body>
