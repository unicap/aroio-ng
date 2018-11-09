<div class="content">
  <fieldset> <!-- Einstellungen Webinterface -->
    <legend>
      <? print ${webinterface_form._.$lang};?>
    </legend>
    <table>
      <tr>
        <td>
          <a title="<? print ${helptext_userpwd._.$lang} ?>"class="tooltip">
          <span title=""><label for="Userpassword"> <? print ${userpwd._.$lang} ; ?> </label></span></a>
        </td>
        <td>
          <input class="actiongroup" type="password" name="USERPASSWD" value="<? print $ini_array["USERPASSWD"] ?>">
        </td>
      </tr>
    </table>
  </fieldset>
</div>