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

        <tr>
          <td>
            <a title="<? print ${"helptext_onboard_wifi_"."$lang"} ?>"class="tooltip">
            <span title=""><label for="onboard_wifi"> <? print ${"onboard_wifi_form_"."$lang"} ; ?> </label></span></a>
          </td>
          <td>
            <? $arr_onboard_wifi=array('ON','OFF');
            print_optgroup("ONBOARD_WIFI",$arr_onboard_wifi,$ini_array["ONBOARD_WIFI"]); ?>
          </td>
        </tr>

      </table>
    </fieldset>
  </div>
