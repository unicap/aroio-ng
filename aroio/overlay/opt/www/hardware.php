  <!-- Hardware -->
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

        <tr id="onboard_wifi">
          <td>
            <a title="<? print ${"helptext_onboard_wifi_"."$lang"} ?>"class="tooltip">
            <span title=""><label for="onboard_wifi"> <? print ${"onboard_wifi_form_"."$lang"} ; ?> </label></span></a>
          </td>
          <td>
          <?
          if ($ini_array["ONBOARD_WIFI"] == "ON")
          { ?>
              <input class="actiongroup" type="radio" name="ONBOARD_WIFI" value="ON" checked> <?print ${"on_"."$lang"}?>
              <input class="actiongroup" type="radio" name="ONBOARD_WIFI" value="OFF"> <?print ${"off_"."$lang"}?> <?
          }
          else
          { ?>
              <input class="actiongroup" type="radio" name="ONBOARD_WIFI" value="ON"> <?print ${"on_"."$lang"}?>
              <input class="actiongroup" type="radio" name="ONBOARD_WIFI" value="OFF" checked> <?print ${"off_"."$lang"}?> <?
          } ?>
          </td>
        </tr>

      </table>
    </fieldset>
  </div>
