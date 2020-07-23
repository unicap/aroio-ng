  <div class="content">
    <fieldset>
      <legend>
        <? print ${"bluetooth_form_"."$lang"};?>
      </legend>
      <table>
        <tr>
          <td>
            <a title=<? print ${"helptext_bluetooth_"."$lang"} ?>"class="tooltip">
            <span title=""><label for="Bluetooth settings"> <? print ${"bluetooth_"."$lang"} ; ?> </label></span></a>
            <input type="hidden" name="ADVANCED" value="OFF">
          </td>
          <td>
            <input class="button" type="submit" value=" <? print ${"button_bluetooth_pairing_"."$lang"} ?> " name="bluetooth_pairing">
            <input class="button" type="submit" value=" <? print ${"button_bluetooth_dbpurge_"."$lang"} ?> " name="bluetooth_dbpurge">
          </td>
        </tr>
      </table>
    </fieldset>
  </div>
