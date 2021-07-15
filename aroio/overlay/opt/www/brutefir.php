<?php
		include('strings.php');
    include('functions.inc.php');

    if($_GET["lang"] === "en" || $_POST["lang"]=="en")
		{
			$lang='en';
			$GLOBALS["lang"]='en';
		}
		else
		{
			$lang='de';
			$GLOBALS["lang"]='de';
		}

        if(isset($_POST["set"]))
		{
			$savedbank=$_POST['savedbank'];
			validateAndSave(10,$_POST);

            $shell_exec_ret=shell_exec('cardmount rw');
            wrtToUserconfig('DEF_COEFF',$_POST['savedbank']);
            $shell_exec_ret=shell_exec('cardmount ro');

/*            if ($ini_array[MSCODING]=='ON') {
				volControl(1,($_POST[vol.$savedbank])*-1);
			}
*/
//			else {
				volControl(0,($_POST['vol'.$savedbank])*-1);
//			}
		}

		if(isset($_POST["save"]))
		{
			$savedbank=$_POST['savedbank'];

            validateAndSave('10',$_POST);

            $shell_exec_ret=shell_exec('cardmount rw');
			wrtToUserconfig('DEF_COEFF',$_POST['savedbank']);
            $shell_exec_ret=shell_exec('cardmount ro');
            shell_exec('controlaudio restart &> /dev/null ' );
            if ($ini_array['MSCODING']=='ON') {
				volControl(1,$_POST['vol'.$savedbank]);
			}
			else {
				volControl(0,$_POST['vol'.$savedbank]);
			}
		}

// Load ini-array from userconfig.txt
    $ini_array = parse_ini_file("/boot/userconfig.txt", 1);

    // Switch filter bank

    $bank_test= $_POST['bank'];
    $activeFilter=getFilter();

    if(isset($_POST['bank']))
    {
        $activeFilter = $_POST["bank"];
        validateAndSave(10,$_POST);

        $shell_exec_ret=shell_exec('cardmount rw');
        wrtToUserconfig('DEF_COEFF',$activeFilter);
        $shell_exec_ret=shell_exec('cardmount ro');
        switchFilter($_POST['bank']);

        // Check if MSCODING is on
/*        if ($ini_array[MSCODING]=='ON') {
            volControl(1,$ini_array[COEFF_ATT.$activeFilter]);
        }
        else {
            volControl(0,$ini_array[COEFF_ATT.$activeFilter]);
        }
*/
    }
    else
    {
        $activeFilter = getFilter();
        if(isset($_POST["save"])){
            if($ini_array['MSCODING']=='ON') {
                volControl(1,$ini_array['COEFF_ATT'.$activeFilter]);
            }
            else {
                volControl(0,$ini_array['COEFF_ATT'.$activeFilter]);
            }
        }
    }

    // Mute channels
    if(isset($_POST["mute"]))
		{
			tgglMute(0);
			tgglMute(1);
		}

		// LOUDER !!
		if(isset($_POST["volPlus"]))
		{
			$actVol=getVol();
			$actVol-=0.5;
			//if($ini_array[MSCODING]=='ON')
			//{
			//	volControl(1,$actVol);
			//}
			//else
			//{
				volControl(0,$actVol);
			//}
			$ini_array[COEFF_ATT.$activeFilter]=$actVol;
		}
		// less louder ...
		if(isset($_POST["volMinus"]))
		{
			$actVol=getVol(); //auslesen
			$actVol+=0.5;	//setzen
            //if($ini_array[MSCODING]=='ON')
     	//	{
          //  	volControl(1,$actVol);
           // }
            //else
            //{
                volControl(0,$actVol);
            //}
			$ini_array[COEFF_ATT.$activeFilter]=$actVol; //ins array
		}



    $ini_array = parse_ini_file("/boot/userconfig.txt", 1);
    if ( isset($_POST['convolver_submit']))
    {
        if ( !$error )
        {
            $shell_exec_ret=shell_exec('cardmount rw');
            write_config();
            $shell_exec_ret=shell_exec('cardmount ro');
            unset($_POST['reboot']);
            $ini_array = parse_ini_file("/boot/userconfig.txt", 1);
            echo '<meta http-equiv="refresh"> ';
        }
		shell_exec('/usr/bin/controlaudio restart &> /dev/null' );
    }

    include "header.php";?>

<!-- Navigation -->
<ul>
<li><a href="index.php" target=""><? print ${"linktext_configuration_"."$lang"} ?></span></a></li>
<li><a href="system.php" target=""><? print ${"linktext_system_"."$lang"} ?></a></li>
<li><a href="measurement.php" target=""><? print${"linktext_measurement_"."$lang"} ?></a></li>
<li>
    <a class="select" href="brutefir.php"target=""><? print ${"linktext_brutefir_"."$lang"} ?></a>
</li>

<li style="float:right"><a href="credits.php" target=""><? print ${"linktext_credits_"."$lang"} ?></a></li>
</ul><!-- Ende Navigation -->

<hr class="top">
</div> <!-- Ende vom Head -->

<div class="content">

<h1><? print $ini_array["HOSTNAME"] ?> - <? print ${"page_title_convolver_"."$lang"}?></h1>

<div id="convolver_settings" data-output="<? print $ini_array["AUDIO_OUTPUT"] ?>">
<form action="<?echo $_SERVER['PHP_SELF'] ?>" method="post">

<!-- Filterauswahl -->
<fieldset>
    <legend><? print ${"convolution_filterselection_"."$lang"}?></legend>
    <? echo print_filterset(10,$ini_array)?>
</fieldset>

<input type="hidden" name="actVol" value="<?echo getVol()?>">
<input type="hidden" name="lang" value="<?echo $lang?>">
<input type="hidden" name="savedbank" value="<?echo $activeFilter?>">

<button type="submit" name="save" title="<? print ${"helptext_bf_button_savereload_"."$lang"} ?>"><? print ${"button_savefilter_"."$lang"}?></button>
<button type="submit" name="set" title="<? print ${"helptext_bf_button_setcoeffs_"."$lang"} ?>"><? print ${"button_setcoeffs_"."$lang"}?></button>
<button type="submit" <?if(isMuted()) echo 'style="background-color:#a00; "'; else echo 'style="color:white"';?> name="mute" value="1"><? print ${"button_mute_"."$lang"}?></button>
</form>
</div>
</div>

<div class="content">
<fieldset> <!-- Erläuterungen -->
    <legend><? print ${"helptext_convolver_"."$lang"} ?></legend>
    <? print ${"helptext_bf_"."$lang"} ;?>
</fieldset>
</div>

<? include "footer.php"; ?>
