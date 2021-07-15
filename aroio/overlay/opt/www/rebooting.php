<html>
  <head>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="icon" href="/favicon_aroio.png" type="image/x-icon"/>
    <link rel="shortcut icon" href="/favicon_aroio.png" type="image/x-icon"/>
    <title><? print $ini_array["HOSTNAME"] ?></title>
  </head>
  <body>
    <div class="fixed-modal">
      <div class="modal-content">
        <header class="modal-header">
          <? print ${"button_reboot_"."$lang"}; ?>
        </header>
        <div class="modal-container">
          <span><? print ${"infotext_rebooting_"."$lang"}; ?></span>
        </div>
      </div>
    </div>
  </body>
  <script>
    setTimeout(function() {
        window.location = "/index.php";
    }, 25000);
  </script>
</html>
