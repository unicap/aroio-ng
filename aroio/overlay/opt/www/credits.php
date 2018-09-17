<?php
    include('strings.php');
    include('functions.inc.php');
    include('style.css');
    
    if($_GET["lang"] === "en") $lang='en'; else $lang='de';
    $ini_array = parse_ini_file("/boot/userconfig.txt", 1);
    
    include "header.php";?>

<!-- Navigation -->
        <ul>
            <li><a href="index.php" target=""><? print ${linktext_configuration._.$lang} ?></span></a></li>
            <li><a href="system.php" target=""><? print ${linktext_system._.$lang} ?></a></li>
            <li><a href="measurement.php" target=""><? print${linktext_measurement._.$lang} ?></a></li>
            <li>
            <? if ($ini_array['BRUTEFIR'] == "OFF"){?>
                <a style="color: #c5c5c5" href="brutefir.php"target=""><? print ${linktext_brutefir._.$lang} ?></a>
            <?}else{?>
                <a href="brutefir.php"target=""><? print ${linktext_brutefir._.$lang} ?></a>
            <?}?>
            </li>
            <li style="float:right"><a class="select" href="credits.php" target=""><? print ${linktext_credits._.$lang} ?></a></li>
        </ul><!-- Ende Navigation -->

        <hr class="top">
        </div> <!-- Ende vom Head -->

        <div class="content">

            <h1><? print AroioOS ?> - <? print ${page_title_credits._.$lang}?></h1>

            <form id="AroioOS infos" Name="AroioOS infos" action="" method="post">
            <fieldset>
                <legend><? print ${aroioos_form._.$lang} ; ?></legend> <!-- Aroio Info-Kasten-->
                <? print "${aroio_infos_text._.$lang}" ; ?>
            </fieldset>
            <fieldset>
                <form id="Opensource infos" Name="Opensource infos" action="" method="post">
                <legend><? print ${opensource_modules_form._.$lang} ; ?></legend> <!-- Aroio Info-Kasten-->
                <? print "${opensource_moduls_infos_text._.$lang}" ; ?>
                </form>
            </fieldset>
        </div>

<? include "footer.php";?>
