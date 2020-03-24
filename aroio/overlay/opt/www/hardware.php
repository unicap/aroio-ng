  <div class="content">
    <fieldset>
      <legend>
        <? print ${hardware_form._.$lang};?>
      </legend>
      <table>
        <tr>
          <td>
            <a title="<? print ${helptext_platform._.$lang} ?>"class="tooltip">
            <span title=""><label for="Userpassword"> <? print ${platform_form._.$lang} ; ?> </label></span></a>
          </td>
          <td>
            <? $arr_platform=array('AroioEX','AroioSU','AroioLT','RaspberryPi','Caroio');
            print_optgroup("PLATFORM",$arr_platform,$ini_array["PLATFORM"]); ?>
          </td>
        </tr>
      </table>
    </fieldset>
  </div>
