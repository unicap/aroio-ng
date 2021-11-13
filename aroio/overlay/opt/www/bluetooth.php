  <div class="content">
    <fieldset>
      <legend>
        <? print ${"bluetooth_form_"."$lang"};?>
      </legend>
      <table>
      <tr>
          <td>
            <a title="<? print ${"bluetooth_"."$lang"} ?>"class="tooltip">
              <span title=""><? print ${"bluetooth_"."$lang"} ; ?></span>
            </a>
          </td>
          <td>
          </td>
          <td>
            <a title="<? print ${"helptext_bluetooth_"."$lang"} ?>"class="tooltip">
            <input class="button" type="submit" value=" <? print ${"button_bluetooth_pairing_"."$lang"} ?> " name="bluetooth_pairing">
            <input class="button" type="submit" value=" <? print ${"button_bluetooth_dbpurge_"."$lang"} ?> " name="bluetooth_dbpurge">
          </td>
        </tr>
        <tr>
          <td>
            <a title="<? print ${"helptext_bluetooth_reconnect_"."$lang"} ?>"class="tooltip">
              <span title=""><label for="bluetooth_reconnect_checkbox"> <? print ${"bluetooth_reconnect_"."$lang"} ; ?> </label></span>
            </a>
            <input type="hidden" name="BTRECONNECT" value="OFF">
            <input type="checkbox" id="bluetooth_reconnect_checkbox" name="BTRECONNECT" value="ON" <? check_if_on($ini_array["BTRECONNECT"]) ?>>
          </td>
          <td>
          </td>
          <td>
            <input class="button" type="submit" value=" <? print ${"button_submit_apply_"."$lang"} ?> " name="bluetooth_reconnect">
          </td>
        </tr>
      </table>
    </fieldset>
  </div>
