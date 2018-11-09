<!-- Logitech Media Server -->
<div class="content">
  <fieldset>
    <legend><? print ${squeeze_serv_form._.$lang};?></legend>
    <table>
      <tr>
        <td>
          <a title="<? print ${helptext_servername._.$lang} ?>"class="tooltip">
          <span title=""><label for="Address or hostname"> <? print ${squeeze_serv_hostname._.$lang} ; ?> </label></span></a>
        </td>
        <td>
          <input class="actiongroup" <?if ($_POST['DHCP'] == "OFF") {if ( isset($_POST['submit']) && !validate_input("LMS",$_POST['SERVERNAME']) ){echo 'style="border:2px solid #ff0000"';};}?> type="text" name="SERVERNAME" value="<? if (isset($_POST['submit']))print $_POST['SERVERNAME']; else print $ini_array["SERVERNAME"] ?>">
        </td>
      </tr>
      <tr>
        <td>
          <a title="<? print ${helptext_squeezeuser._.$lang} ?>"class="tooltip">
          <span title=""><label for="Username (if set)"> <? print ${squeeze_serv_user._.$lang} ; ?> </label></span></a>
        </td>
        <td>
          <input class="actiongroup" type="text" name="SQUEEZEUSER" value="<? print $ini_array["SQUEEZEUSER"] ?>">
        </td>
      </tr>
      <tr>
        <td>
          <a title="<? print ${helptext_squeezepwd._.$lang} ?>"class="tooltip">
          <span title=""><label for="Password (if set)"> <? print ${squeeze_serv_passwd._.$lang} ; ?> </label></span></a>
        </td>
        <td>
          <input class="actiongroup" type="password" name="SQUEEZEPWD" value="<? print $ini_array["SQUEEZEPWD"] ?>">
        </td>
      </tr>
      <tr>
        <td>
          <a title="<? print ${helptext_serverport._.$lang} ?>"class="tooltip">
          <span title=""><label for="Port (default 9000)"> <? print ${squeeze_serv_port._.$lang} ; ?> </label></span></a>
        </td>
        <td>
          <input class="actiongroup" <?if ( isset($_POST['submit']) && !validate_input("SERVERPORT",$_POST['SERVERPORT']) ){echo 'style="border:2px solid #ff0000"';};?> type="text" name="SERVERPORT" value="<? if (isset($_POST['submit']))print $_POST['SERVERPORT']; else print $ini_array["SERVERPORT"] ?>">
        </td>
      </tr>
    </table>

    <a href=<? echo 'http://'.print_squeezeaddr($ini_array["SERVERPORT"]).'' ?> target="_blank">
      <button type="button" style="padding: 10px 10px; margin: 0px;">LMS Webinterface</button>
    </a>

  </fieldset>
</div>
