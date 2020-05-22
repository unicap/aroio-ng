  <div class="content">
    <fieldset>
      <legend>
        <? print ${"hardware_form_"."$lang"};?>
      </legend>
      <table>
        <tr>
          <td>
            <a title="<? print ${"helptext_platform_"."$lang"} ?>"class="tooltip">
            <span title=""><label for="Userpassword"> <? print ${"platform_form_"."$lang"} ; ?> </label></span></a>
          </td>
          <td>
            <? $arr_platform=array('AroioEX','AroioSU','AroioLT','RaspberryPi');
            print_optgroup("PLATFORM",$arr_platform,$ini_array["PLATFORM"]); ?>
          </td>
        </tr>
      </table>
    </fieldset>
  </div>
