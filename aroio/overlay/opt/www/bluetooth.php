  <div class="content">
    <fieldset>
      <legend>
        <? print ${bluetooth_form._.$lang};?>
      </legend>
      <table>
        <tr>
          <td>
            <a title="<? print ${helptext_bluetooth._.$lang} ?>"class="tooltip">
            <span title=""><label for="Bluetooth settings"> <? print ${bluetooth._.$lang} ; ?> </label></span></a>
            <input type="hidden" name="ADVANCED" value="OFF">
          </td>
          <td>
            <input class="button" type="submit" value=" <? print ${button_bluetooth_pairing._.$lang} ?> " name="bluetooth_pairing">
            <input class="button" type="submit" value=" <? print ${button_bluetooth_dbpurge._.$lang} ?> " name="bluetooth_dbpurge">
          </td>
        </tr>
      </table>
    </fieldset>
  </div>
