
      <tr> <?
        if ($ini_array["ADVANCED"] == "ON")
        { ?>
          <tr>
            <td>
              <a title="<? print ${helptext_display_rotate._.$lang} ?>"class="tooltip">
              <span title=""><label for="display_rotate"> <? print ${display_rotate._.$lang} ; ?> </label></span></a>
              <input type="hidden" name="DISPLAY_ROTATE" value="OFF"> <?
              if ($ini_array["DISPLAY_ROTATE"] == "ON")
              { ?>
                <input type="checkbox" id="display_rotate" name="DISPLAY_ROTATE" value="ON" checked> <?
              }
              else
              { ?>
                <input type="checkbox" id="display_rotate"name="DISPLAY_ROTATE" value="ON"> <?
              } ?>
            </td>
          </tr>
          <td>
            <a title="<? print ${helptext_jack_buffer._.$lang} ?>"class="tooltip">
            <span title=""><label for="Jackbuffer"> <? print ${jack_buffer._.$lang} ; ?> </label></span></a>
          </td>
          <td>
            <?$arr_jackbuffer= array(32,64,128,256,512,1024,2048,4096,8192,16384);
            print_optgroup("JACKBUFFER",$arr_jackbuffer,$ini_array["JACKBUFFER"]);?>
          </td>

          <tr>
            <td>
              <a title="<? print ${helptext_jack_period._.$lang} ?>"class="tooltip">
              <span title=""><label for="Jackperiod"> <? print ${jack_period._.$lang} ; ?> </label></span></a>
            </td>
            <td>
              <?$arr_jackperiod= array(2,3);
              print_optgroup("JACKPERIOD",$arr_jackperiod,$ini_array["JACKPERIOD"]);?>
            </td>
          </tr>

          <tr>
            <td>
              <a title="<? print ${helptext_squeeze_maxfrequency._.$lang} ?>"class="tooltip">
              <span title=""><label for="squeeze_maxfrequency"> <? print ${squeeze_maxfrequency._.$lang} ; ?> </label></span></a>
            </td>
            <td>
              <?$arr_squeeze_maxfrequency= array(44100,48000,88000,96000,176400,192000,348000);
              print_optgroup("SQUEEZE_MAXFREQUENCY",$arr_squeeze_maxfrequency,$ini_array["SQUEEZE_MAXFREQUENCY"]);?>
            </td>
          </tr>

          <tr>
            <td>
              <a title="<? print ${helptext_squeeze_intbuffer._.$lang} ?>"class="tooltip">
              <span title=""><label for="squeeze_intbuffer"> <? print ${squeeze_intbuffer._.$lang} ; ?> </label></span></a>
            </td>
            <td>
              <?$arr_squeeze_intbuffer= array(512,1024,2048,4096,8192,16384,32768,65536,131072,262144,524288,1048576);
              print_optgroup("SQUEEZE_INTBUFFER",$arr_squeeze_intbuffer,$ini_array["SQUEEZE_INTBUFFER"]);?>
            </td>
          </tr>

          <tr>
            <td>
              <a title="<? print ${helptext_squeeze_outbuffer._.$lang} ?>"class="tooltip">
              <span title=""><label for="squeeze_outbuffer"> <? print ${squeeze_outbuffer._.$lang} ; ?> </label></span></a>
            </td>
            <td>
              <?$arr_squeeze_outbuffer= array(512,1024,2048,4096,8192,16384,32768,65536,131072,262144,524288,1048576);
              print_optgroup("SQUEEZE_OUTBUFFER",$arr_squeeze_outbuffer,$ini_array["SQUEEZE_OUTBUFFER"]);?>
            </td>
          </tr>

          <tr>
            <td>
              <a title="<? print ${helptext_sp_outbuffer._.$lang} ?>"class="tooltip">
              <span title=""><label for="sp_outbuffer"> <? print ${sp_outbuffer._.$lang} ; ?> </label></span></a>
            </td>
            <td>
              <?$arr_sp_outbuffer= array(512,1024,2048,4096,8192,16384,32768,65536,131072,262144,524288,1048576);
              print_optgroup("SP_OUTBUFFER",$arr_sp_outbuffer,$ini_array["SP_OUTBUFFER"]);?>
            </td>
          </tr>

          <tr>
            <td>
              <a title="<? print ${helptext_bf_partitions._.$lang} ?>"class="tooltip">
              <span title=""><label for="bf_partitions"> <? print ${bf_partitions._.$lang} ; ?> </label></span></a>
            </td>
            <td>
              <?$arr_bf_partitions= array(1,2,4,8,16,32);
              print_optgroup("BF_PARTITIONS",$arr_bf_partitions,$ini_array["BF_PARTITIONS"]);?>
            </td>
          </tr>
          <tr>
            <td>
              <a title="<? print ${helptext_sp_samplerate._.$lang} ?>"class="tooltip">
              <span title=""><label for="sp_samplerate"> <? print ${sp_samplerate._.$lang} ; ?> </label></span></a>
            </td>
            <td>
              <?$arr_sprate= array('44100','88200','176400');
              print_optgroup("SPRATE",$arr_sprate,$ini_array["SPRATE"]);?>
            </td>
          </tr>
          </div> <?
        } ?>
      </tr>
