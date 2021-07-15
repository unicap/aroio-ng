<!-- Logitech Media Server -->
<div class="content" id="lms_settings">
  <fieldset>
    <legend><? print ${"squeeze_serv_form_"."$lang"};?></legend>
    <table>
      <tr>
        <td>
          <a title="<? print ${"helptext_servername_"."$lang"} ?>"class="tooltip">
          <span title=""><label for="Address or hostname"> <? print ${"squeeze_serv_hostname_"."$lang"} ; ?> </label></span></a>
        </td>
        <td>
          <input class="actiongroup" <?if ($_POST['DHCP'] == "OFF") {if ( isset($_POST['submit']) && !validate_input("LMS",$_POST['SERVERNAME']) ){echo 'style="border:2px solid #ff0000"';};}?> type="text" name="SERVERNAME" value="<? if (isset($_POST['submit']))print $_POST['SERVERNAME']; else print $ini_array["SERVERNAME"] ?>">
        </td>
      </tr>
      <tr>
        <td>
          <a title="<? print ${"helptext_squeezeuser_"."$lang"} ?>"class="tooltip">
          <span title=""><label for="Username (if set)"> <? print ${"squeeze_serv_user_"."$lang"} ; ?> </label></span></a>
        </td>
        <td>
          <input class="actiongroup" type="text" autocomplete="off" name="SQUEEZEUSER" value="<? print $ini_array["SQUEEZEUSER"] ?>">
        </td>
      </tr>
      <tr>
        <td>
          <a title="<? print ${"helptext_squeezepwd_"."$lang"} ?>"class="tooltip">
          <span title=""><label for="Password (if set)"> <? print ${"squeeze_serv_passwd_"."$lang"} ; ?> </label></span></a>
        </td>
        <td>
          <input class="actiongroup" type="password" autocomplete="off" name="SQUEEZEPWD" value="<? print $ini_array["SQUEEZEPWD"] ?>">
        </td>
      </tr>
      <tr>
        <td>
          <a title="<? print ${"helptext_serverport_"."$lang"} ?>"class="tooltip">
          <span title=""><label for="Port (default 9000)"> <? print ${"squeeze_serv_port_"."$lang"} ; ?> </label></span></a>
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

  <input class="button" type="submit" value=" <? print ${"button_submit_apply_"."$lang"} ?> " name="lms_submit">
  <div>
    <br>
    <hr class="top">
    <br>
  </div>

</div>
