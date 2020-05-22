<div class="content">
  <fieldset> <!-- Einstellungen Webinterface -->
    <legend>
      <? print ${"webinterface_form_"."$lang"};?>
    </legend>
    <table>
      <tr>
        <td>
          <a title="<? print ${"helptext_userpwd_"."$lang"} ?>"class="tooltip">
          <span title=""><label for="Userpassword"> <? print ${"userpwd_"."$lang"} ; ?> </label></span></a>
        </td>
        <td>
          <input class="actiongroup" type="password" name="USERPASSWD" value="<? print $ini_array["USERPASSWD"] ?>">
        </td>
      </tr>
    </table>
  </fieldset>
</div>
