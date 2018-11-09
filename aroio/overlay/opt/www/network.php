<!-- Einstellungen Netzwerk -->
<form id="Network settings" Name="Network settings" action="" method="post">
  <div class="content">
    <fieldset>
      <legend>
        <? print ${network_form._.$lang} ; ?>
     </legend>
      
      <table>
        <tr>
          <td>
            <a title="<? print ${helptext_hostname._.$lang} ?>"class="tooltip">
            <span title=""><label for="Hostname">Hostname</label></span></a>
          </td>
          <td>
            <input class="actiongroup" <?if ( isset($_POST['submit']) && !validate_input("HOSTNAME",$_POST['HOSTNAME']) ){echo 'style="border:2px solid #ff0000"';};?> type="text" name="HOSTNAME" value="<? if (isset($_POST['submit']))print $_POST['HOSTNAME']; else print $ini_array["HOSTNAME"] ?>">
          </td>
        </tr>
      
        <tr>
          <td>
            <a  title="<? print ${helptext_dhcp._.$lang} ?>"class="tooltip">
            <span title=""><label for="DHCP"><? print ${dhcp._.$lang} ; ?></label></span></a>
          </td>
          <td>

          <?
          if ($ini_array["LAN_DHCP"] == "OFF" || $_POST["LAN_DHCP"] == "OFF")
          { ?>
              <input class="actiongroup" type="radio" name="LAN_DHCP" value="ON"> <?print ${dhcp_on._.$lang}?><br>
              <input class="actiongroup" type="radio" name="LAN_DHCP" value="OFF" checked> <?print ${dhcp_off._.$lang}?> <?
          }
          else
          { ?>
              <input class="actiongroup" type="radio" name="LAN_DHCP" value="ON" checked> <?print ${dhcp_on._.$lang}?><br>
              <input class="actiongroup" type="radio" name="LAN_DHCP" value="OFF"> <?print ${dhcp_off._.$lang}?> <?
          }
          
          if ($ini_array["LAN_DHCP"] == "OFF" || $_POST['LAN_DHCP'] == "OFF")
          { ?>
            </td>
            </tr>
            <tr>
            <td>
              <a title="<? print ${helptext_ipaddr._.$lang} ?>"class="tooltip">
              <span title=""><label for="IP-address"> <? print ${ipaddr._.$lang} ; ?> </label></span></a>
            </td>
            <td>
              <input class="actiongroup" <?if ( isset($_POST['submit']) && !validate_input("IPADDR",$_POST['LAN_IPADDR']) ){echo 'style="border:2px solid #ff0000"';};?> type="text" name="LAN_IPADDR" value="<? if (isset($_POST['submit']))print $_POST['LAN_IPADDR']; else print $ini_array["LAN_IPADDR"]; ?>">
            </td>
            </tr>
            <tr>
              <td>
                <a title="<? print ${helptext_netmask._.$lang} ?>"class="tooltip">
                <span title=""><label for="Network-mask"> <? print ${netmask._.$lang} ; ?> </label></span></a>
              </td>
              <td>
                <input class="actiongroup" <?if ( isset($_POST['submit']) && !validate_input("NETMASK",$_POST['LAN_NETMASK']) ){echo 'style="border:2px solid #ff0000"';};?> type="text" name="LAN_NETMASK" value="<?if (isset($_POST['submit']))print $_POST['LAN_NETMASK']; else print $ini_array["LAN_NETMASK"]; ?>">
              </td>
            </tr>
            <tr>
              <td>
                <a title="<? print ${helptext_dnsserv._.$lang} ?>"class="tooltip">
                <span title=""><label for="DNS-server"> <? print ${dnsserv._.$lang} ; ?> </label></span></a>
              </td>
              <td>
                <input class="actiongroup" <?if ( isset($_POST['submit']) && !validate_input("IPADDR",$_POST['LAN_DNSSERV']) ){echo 'style="border:2px solid #ff0000"';};?> type="text" name="LAN_DNSSERV" value="<?if (isset($_POST['submit']))print $_POST['LAN_DNSSERV']; else print $ini_array["LAN_DNSSERV"] ?>">
              </td>
            </tr>
            <tr>
              <td>
                <a title="<? print ${helptext_gateway._.$lang} ?>"class="tooltip">
                <span title=""><label for="Gateway"> <? print ${gateway._.$lang} ; ?> </label></span></a>
              </td>
              <td>
                <input class="actiongroup" <?if ( isset($_POST['submit']) && !validate_input("HOSTNAMEORIP",$_POST['LAN_GATEWAY']) ){echo 'style="border:2px solid #ff0000"';};?> type="text" name="LAN_GATEWAY" value="<? if (isset($_POST['submit']))print $_POST['LAN_GATEWAY']; else  print $ini_array["LAN_GATEWAY"] ?>">
              </td>
            </tr> <?
          }
        else
        {
          $test_wlan=test_wlan();
          if ($test_wlan == "0") 
            { ?>
              <tr>
                <td>
                  <a title="<? print ${helptext_sitesurvey._.$lang} ?>"class="tooltip">
                  <span title=""><label for="Scan"> <? print ${site_survey._.$lang} ; ?> </label></span></a>
                </td>
                <td>
                  <input class="button" type="submit" value="<? print ${button_scan._.$lang} ?>" name="scan">
                </td>
              </tr>
              <tr>
                <td>
                  <a title="<? print ${helptext_wlanssid._.$lang} ?>"class="tooltip">
                  <span title=""><label for="Wireless network"> <? print ${wlanssid._.$lang} ; ?> </label></span></a>
                </td>
                <td>
                <?
                echo'<select name="WLANSSID" class="actiongroup">';
                if (isset($_POST['scan']))
                {
                    foreach($wifilist as $ssid){
                        if($ssid == $ini_array["WLANSSID"]){
                            echo'<option selected>'.$ssid.'</option>';
                        }
                        else echo'<option>'.$ssid.'</option>';
                    }
                    echo '<option>AroioAP</option>';
                }
                //elseif (isset($_POST['WLANSSID'])) echo'<option selected>'.$_POST['WLANSSID'].'</option>';
                else
              	{
              		echo '<option>WIFI-OFF!</option>';
              		echo '<option>AroioAP</option>';
              		echo'<option selected>'.$ini_array['WLANSSID'].'</option>';
              	}
                echo'</select>'; ?>
                </td>
              </tr>
              <tr>
                <td>
                  <a title="<? print ${helptext_wlanpwd._.$lang} ?>"class="tooltip">
                  <span title=""><label for="Wireless passphrase"> <? print ${wlanpwd._.$lang} ; ?> </label></span></a>
                </td>
                <td>
                  <script src="showpswd.js"></script>
                  <input type="password" id="newpass" name="WLANPWD" onkeyup="runPassword(this.value, 'newpass');" value="<? print $ini_array["WLANPWD"] ?>"/>
                  <a title="<? print ${helptext_showpwd._.$lang} ?>"class="tooltip_check">
                  <span title=""></span>
                  <input type="checkbox" id="showpwd" onclick="machText(this.checked,this.form)"><label></label>
                  </a>
                </td>
              </tr> <?
            }
        } ?>
        </table>
    </fieldset>
  </div>
</form>
