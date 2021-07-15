<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.5">
    <script type='text/javascript' src='js/jquery-1.8.2.min.js'></script>
    <script type='text/javascript' src='js/main.js'></script>
    <link rel="stylesheet" href="css/style.css">

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
        case "/index.php": echo ${"title_main_"."$lang"}; break;
        case "/system.php": echo ${"title_system_"."$lang"}; break;
        case "/measurement.php": echo ${"title_measurement_"."$lang"}; break;
        case "/credits.php": echo ${"title_credits_"."$lang"}; break;
        case "/brutefir.php": echo ${"title_brutefir_"."$lang"}; break;
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
        <a href="http://www.abacus-electronics.de" title="ABACUS Website" target="_blank"><img class="top" src="img/abacus_logo_wide.png" border="0"></a>

        <!-- Fahnen -->
        <a style="float: right" href="<?php echo $PHP_SELF?>?lang=en" target=""><img src="img/english.png" border="0"></a>
        <a style="float: right" href="<?php echo $PHP_SELF?>?lang=de" target=""><img src="img/german.png" border="0"></a>
