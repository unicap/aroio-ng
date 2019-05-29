<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.5">
    <script type='text/javascript' src='http://code.jquery.com/jquery-1.8.2.js'></script>

    <!-- VIEWPORT SETTINGS FOR DIFFERENT DEVICES -->
    <script>
      var screenWidth = screen.availWidth;
      var screenHeight = screen.availHeight;
      var tabletSize = 799;

      if(screenHeight > tabletSize || screenWidth > tabletSize)
      { //Tablets and Monitors
        $('meta[name=viewport]').remove();
        $('head').append('<meta name="viewport" content="width=device-width, initial-scale=1">');
      }
      else
      { //Smartphones
        $('meta[name=viewport]').remove();
        $('head').append('<meta name="viewport" content="width=device-width, initial-scale=0.5">');
      }
    </script>

    <title>
      <? $path = $_SERVER['REQUEST_URI'];
      switch($path)
      {
        case "/index.php": echo ${title_main._.$lang}; break;
        case "/system.php": echo ${title_system._.$lang}; break;
        case "/measurement.php": echo ${title_measurement._.$lang}; break;
        case "/credits.php": echo ${title_credits._.$lang}; break;
        case "/brutefir.php": echo ${title_brutefir._.$lang}; break;
      } ?>
    </title>

    <link rel="icon" href="/favicon_aroio.png" type="image/x-icon" />
    <link rel="shortcut icon" href="/favicon_aroio.png" type="image/x-icon" />
  </head>

  <body>
  <div id="wrapper">
    <hr class="top">
    <div id="content">
        <div class="header">
        <!-- Headerbild mit Verlinkung -->
        <a href="http://www.abacus-electronics.de" title="ABACUS Website" target="_blank"><img class="top" src="abacus_logo_wide.png" border="0"></a>

        <!-- Fahnen -->
        <a style="float: right" href="<?php echo $PHP_SELF?>?lang=en" target=""><img src="english.png" border="0"></a>
        <a style="float: right" href="<?php echo $PHP_SELF?>?lang=de" target=""><img src="german.png" border="0"></a>
