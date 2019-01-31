<div class="content">
  <fieldset>
    <table>
      <tr> <!-- Headline with playernames ---------------------------------->
        <td></td>
        <td>
          Squeeze
        </td>
        <td>
          UPnP
        </td>
        <td>
          ShAirPlay
        </td>
        <td>
          Bluetooth
        </td>
        <td>
          Line In
        </td>
        <td>
          NetJack
        </td>
      </tr> <?

      ?> <!-- Output DIRECT ---------------------------------------------------------------------------------------------> <?
      if ($ini_array["SOUNDCARD"] != "Focusrite Scarlett")
      {
        if ($ini_array["AUDIO_OUTPUT"] == "vol-plug")
        { ?>
          <tr>
            <td>
              <input class="actiongroup" type="radio" name="AUDIO_OUTPUT" value="vol-plug" checked>
              <a title="<? print ${helptext_audio_out_direct._.$lang} ?>"class="tooltip"> Direct <?
        }
        else
        { ?>
          <tr>
            <td>
                <input class="actiongroup" type="radio" name="AUDIO_OUTPUT" value="vol-plug">
                <a title="<? print ${helptext_audio_out_direct._.$lang} ?>"class="tooltip"> Direct <?
        }

        switch ($ini_array["RAW_PLAYER"])
        {
          case "squeezelite": ?>
                <td> <input class="actiongroup" type="radio" name="RAW_PLAYER" value="squeezelite" checked> </td>
                <td> <input class="actiongroup" type="radio" name="RAW_PLAYER" value="gmediarender" > </td>
                <td> <input class="actiongroup" type="radio" name="RAW_PLAYER" value="shairportsync" > </td>
                <td> <input class="actiongroup" type="radio" name="RAW_PLAYER" value="bluealsaaplay"  <? test_bt() ?> > </td>
                <td></td>
              </tr> <?
              break;

            case "gmediarender": ?>
                <td> <input class="actiongroup" type="radio" name="RAW_PLAYER" value="squeezelite" > </td>
                <td> <input class="actiongroup" type="radio" name="RAW_PLAYER" value="gmediarender" checked> </td>
                <td> <input class="actiongroup" type="radio" name="RAW_PLAYER" value="shairportsync" > </td>
                <td> <input class="actiongroup" type="radio" name="RAW_PLAYER" value="bluealsaaplay"  <? test_bt() ?> > </td>
                <td></td>
              </tr> <?
              break;

            case "shairportsync": ?>
                <td> <input class="actiongroup" type="radio" name="RAW_PLAYER" value="squeezelite" > </td>
                <td> <input class="actiongroup" type="radio" name="RAW_PLAYER" value="gmediarender" > </td>
                <td> <input class="actiongroup" type="radio" name="RAW_PLAYER" value="shairportsync" checked> </td>
                <td> <input class="actiongroup" type="radio" name="RAW_PLAYER" value="bluealsaaplay"  <? test_bt() ?> > </td>
                <td></td>
              </tr> <?
              break;

            case "bluealsaaplay": ?>
                <td> <input class="actiongroup" type="radio" name="RAW_PLAYER" value="squeezelite" > </td>
                <td> <input class="actiongroup" type="radio" name="RAW_PLAYER" value="gmediarender" > </td>
                <td> <input class="actiongroup" type="radio" name="RAW_PLAYER" value="shairportsync" > </td>
                <td> <input class="actiongroup" type="radio" name="RAW_PLAYER" value="bluealsaaplay" checked <? test_bt() ?> > </td>
                <td></td>
              </tr> <?
              break;
          }

          ?> <!-- Output DIRECT MS---------------------------------------------------------------------------------------> <?
          if ($ini_array["AUDIO_OUTPUT"] == "vol-plug-ms") { ?>
            <tr>
              <td> <input class="actiongroup" type="radio" name="AUDIO_OUTPUT" value="vol-plug-ms" checked>
              <a title="<? print ${helptext_audio_out_direct_ms._.$lang} ?>"class="tooltip"> DirectMS <?
          }
          else { ?>
            <tr>
              <td> <input class="actiongroup" type="radio" name="AUDIO_OUTPUT" value="vol-plug-ms">
              <a title="<? print ${helptext_audio_out_direct_ms._.$lang} ?>"class="tooltip"> DirectMS <?
          }

          switch ($ini_array["RAW_PLAYERMS"]){
            case "squeezelite": ?>
              <td> <input class="actiongroup" type="radio" name="RAW_PLAYERMS" value="squeezelite" checked> </td>
              <td> <input class="actiongroup" type="radio" name="RAW_PLAYERMS" value="gmediarender" > </td>
              <td> <input class="actiongroup" type="radio" name="RAW_PLAYERMS" value="shairportsync" > </td>
              <td> <input class="actiongroup" type="radio" name="RAW_PLAYERMS" value="bluealsaaplay"  <? test_bt() ?> > </td>
              <td></td>
            </tr> <?
            break;

            case "gmediarender": ?>
              <td> <input class="actiongroup" type="radio" name="RAW_PLAYERMS" value="squeezelite" > </td>
              <td> <input class="actiongroup" type="radio" name="RAW_PLAYERMS" value="gmediarender" checked> </td>
              <td> <input class="actiongroup" type="radio" name="RAW_PLAYERMS" value="shairportsync" > </td>
              <td> <input class="actiongroup" type="radio" name="RAW_PLAYERMS" value="bluealsaaplay"  <? test_bt() ?> > </td>
              <td></td>
            </tr> <?
            break;

            case "shairportsync": ?>
              <td> <input class="actiongroup" type="radio" name="RAW_PLAYERMS" value="squeezelite" > </td>
              <td> <input class="actiongroup" type="radio" name="RAW_PLAYERMS" value="gmediarender" > </td>
              <td> <input class="actiongroup" type="radio" name="RAW_PLAYERMS" value="shairportsync" checked> </td>
              <td> <input class="actiongroup" type="radio" name="RAW_PLAYERMS" value="bluealsaaplay"  <? test_bt() ?> > </td><td>
            </td></tr> <?
            break;

            case "bluealsaaplay": ?>
              <td> <input class="actiongroup" type="radio" name="RAW_PLAYERMS" value="squeezelite" > </td>
              <td> <input class="actiongroup" type="radio" name="RAW_PLAYERMS" value="gmediarender" > </td>
              <td> <input class="actiongroup" type="radio" name="RAW_PLAYERMS" value="shairportsync" > </td>
              <td> <input class="actiongroup" type="radio" name="RAW_PLAYERmS" value="bluealsaaplay" checked <? test_bt() ?> > </td>
              <td></td>
            </tr> <?
            break;
          }
        } ?>

        <td></td>
      </tr>

    <tr> <!-- Output JACK (BUS)---------------------------------------------------------------------------------------->
      <td> <?
        if ($ini_array["AUDIO_OUTPUT"] == "jack")
        { ?>
          <input class="actiongroup" type="radio" id="output" name="AUDIO_OUTPUT" value="jack" checked>
          <a title="<? print ${helptext_audio_out_bus._.$lang} ?>"class="tooltip"> Bus <?
        }
        else
        { ?>
          <input class="actiongroup" type="radio" id="output" name="AUDIO_OUTPUT" value="jack">
          <a title="<? print ${helptext_audio_out_bus._.$lang} ?>"class="tooltip"> Bus <?
        } ?>
      </td>

      <td>
        <input type="hidden" name="JACK_SQUEEZELITE" value="OFF"> <?
        if ($ini_array["JACK_SQUEEZELITE"] == "ON")
        { ?>
          <input type="checkbox" id="jack" name="JACK_SQUEEZELITE" value="ON" checked> <?
        }
        else
        { ?>
          <input type="checkbox" id="jack" name="JACK_SQUEEZELITE" value="ON"> <?
        } ?>
      </td>

      <td>
        <input type="hidden" name="JACK_GMEDIARENDER" value="OFF"> <?
        if ($ini_array["JACK_GMEDIARENDER"] == "ON")
        { ?>
          <input type="checkbox" id="jack" name="JACK_GMEDIARENDER" value="ON" checked> <?
        }
        else
        { ?>
          <input type="checkbox" id="jack" name="JACK_GMEDIARENDER" value="ON"> <?
        }?>
      </td>

      <td>
        <input type="hidden" name="JACK_SHAIRPORTSYNC" value="OFF"> <?
        if ($ini_array["JACK_SHAIRPORTSYNC"] == "ON")
        { ?>
          <input type="checkbox" id="jack"  name="JACK_SHAIRPORTSYNC" value="ON" checked> <?
        }
        else
        { ?>
          <input type="checkbox" id="jack" name="JACK_SHAIRPORTSYNC" value="ON"> <?
        } ?>
      </td>

      <td>
        <input type="hidden" name="JACK_BLUEALSAAPLAY" value="OFF" <? test_bt() ?> > <?
        if ($ini_array["JACK_BLUEALSAAPLAY"] == "ON")
        { ?>
          <input type="checkbox" id="jack" name="JACK_BLUEALSAAPLAY" value="ON" checked <? test_bt() ?> > <?
        }
        else
        { ?>
          <input type="checkbox" id="jack" name="JACK_BLUEALSAAPLAY" value="ON" <? test_bt() ?> > <?
        } ?>
      </td>

      <td>
        <input type="hidden" name="JACK_INPUT" value="OFF" <? test_input() ?> > <?
        if ($ini_array["JACK_INPUT"] == "ON")
        { ?>
          <input type="checkbox" id="jack" name="JACK_INPUT" value="ON" checked <? test_input() ?> > <?
        }
        else
        { ?>
          <input type="checkbox" id="jack" name="JACK_INPUT" value="ON" <? test_input() ?> > <?
        } ?>
      </td>
      <td>
        <input type="hidden" name="JACK_NETJACK" value="OFF"> <?
        if ($ini_array["JACK_NETJACK"] == "ON")
        { ?>
          <input type="checkbox" id="jack" name="JACK_NETJACK" value="ON" checked> <?
          }
          else
          { ?>
            <input type="checkbox" id="jack" name="JACK_NETJACK" value="ON"> <?
          } ?>
        </td>
    </tr>

    <td> <?
      ?> <!-- Output JACK MS (BUS MS) -----------------------------------------------------------------------------------> <?
      if ($ini_array["AUDIO_OUTPUT"] == "jack-ms")
      { ?>
        <input class="actiongroup" type="radio" id="output" name="AUDIO_OUTPUT" value="jack-ms" checked>
        <a title="<? print ${helptext_audio_out_bus_ms._.$lang} ?>"class="tooltip"> Bus MS <?
      }
      else
      { ?>
        <input class="actiongroup" type="radio" id="output" name="AUDIO_OUTPUT" value="jack-ms">
        <a title="<? print ${helptext_audio_out_bus_ms._.$lang} ?>"class="tooltip"> Bus MS <?
      } ?>
    </td>

    <td>
      <input type="hidden" name="JACKMS_SQUEEZELITE" value="OFF"> <?
      if ($ini_array["JACKMS_SQUEEZELITE"] == "ON")
      { ?>
        <input type="checkbox" id="jack-ms" name="JACKMS_SQUEEZELITE" value="ON" checked> <?
      }
      else { ?>
        <input type="checkbox" id="jack" name="JACKMS_SQUEEZELITE" value="ON"> <?
      } ?>
    </td>

    <td>
      <input type="hidden" name="JACKMS_GMEDIARENDER" value="OFF"> <?
      if ($ini_array["JACKMS_GMEDIARENDER"] == "ON")
      { ?>
        <input type="checkbox" id="jack-ms" name="JACKMS_GMEDIARENDER" value="ON" checked> <?
      }
      else
      { ?>
        <input type="checkbox" id="jack-ms" name="JACKMS_GMEDIARENDER" value="ON"> <?
      } ?>
    </td>

    <td>
      <input type="hidden" name="JACKMS_SHAIRPORTSYNC" value="OFF"> <?
      if ($ini_array["JACKMS_SHAIRPORTSYNC"] == "ON")
      { ?>
        <input type="checkbox" id="jack-ms"  name="JACKMS_SHAIRPORTSYNC" value="ON" checked> <?
      }
      else
      { ?>
        <input type="checkbox" id="jack-ms" name="JACKMS_SHAIRPORTSYNC" value="ON"> <?
      } ?>
    </td>

    <td>
      <input type="hidden" name="JACKMS_BLUEALSAAPLAY" value="OFF" <? test_bt() ?> > <?
      if ($ini_array["JACKMS_BLUEALSAAPLAY"] == "ON")
      { ?>
        <input type="checkbox" id="jack-ms" name="JACKMS_BLUEALSAAPLAY" value="ON" checked <? test_bt() ?> > <?
      }
      else
      { ?>
        <input type="checkbox" id="jack-ms" name="JACKMS_BLUEALSAAPLAY" value="ON" <? test_bt() ?> > <?
      } ?>
    </td>

    <td>
      <input type="hidden" name="JACKMS_INPUT" value="OFF" <? test_input() ?> > <?
      if ($ini_array["JACKMS_INPUT"] == "ON")
      { ?>
        <input type="checkbox" id="jack-ms" name="JACKMS_INPUT" value="ON" checked <? test_input() ?> > <?
      }
      else
      { ?>
        <input type="checkbox" id="jack-ms" name="JACKMS_INPUT" value="ON" <? test_input() ?> > <?
      } ?>
    </td>
    <td>
      <input type="hidden" name="JACKMS_NETJACK" value="OFF"> <?
      if ($ini_array["JACKMS_NETJACK"] == "ON")
      { ?>
        <input type="checkbox" id="jack-ms" name="JACKMS_NETJACK" value="ON" checked> <?
      }
      else
      { ?>
        <input type="checkbox" id="jack-ms" name="JACKMS_NETJACK" value="ON"> <?
      } ?>
    </td>

    <tr>
      <td> <?
        ?> <!-- Output BRUTEFIR (CONVOL.) -------------------------------------------------------------------------------> <?
        if ($ini_array["AUDIO_OUTPUT"] == "jack-bf")
        { ?>
          <input class="actiongroup" type="radio" name="AUDIO_OUTPUT" value="jack-bf" checked>
          <a title="<? print ${helptext_audio_out_convol._.$lang} ?>"class="tooltip"> Convol. <?
        }
        else
        { ?>
          <input class="actiongroup" type="radio" name="AUDIO_OUTPUT" value="jack-bf">
          <a title="<? print ${helptext_audio_out_convol._.$lang} ?>"class="tooltip"> Convol. <? } ?>
      </td>

      <td>
        <input type="hidden" name="JACKBF_SQUEEZELITE" value="OFF"><?
        if ($ini_array["JACKBF_SQUEEZELITE"] == "ON")
        { ?>
          <input type="checkbox" id="jackbf" name="JACKBF_SQUEEZELITE" value="ON" checked> <?
        }
        else
        { ?>
          <input type="checkbox" id="jackbf" name="JACKBF_SQUEEZELITE" value="ON"> <?
        } ?>
      </td>

      <td>
        <input type="hidden" name="JACKBF_GMEDIARENDER" value="OFF"><?
        if ($ini_array["JACKBF_GMEDIARENDER"] == "ON")
        { ?>
          <input type="checkbox" id="jackbf" name="JACKBF_GMEDIARENDER" value="ON" checked> <?
        }
        else
        { ?>
          <input type="checkbox" id="jackbf"name="JACKBF_GMEDIARENDER" value="ON"> <?
        } ?>
      </td>

      <td>
        <input type="hidden" name="JACKBF_SHAIRPORTSYNC" value="OFF"> <?
        if ($ini_array["JACKBF_SHAIRPORTSYNC"] == "ON")
        { ?>
          <input type="checkbox" id="jackbf" name="JACKBF_SHAIRPORTSYNC" value="ON" checked> <?
        }
        else
        { ?>
          <input type="checkbox" id="jackbf" name="JACKBF_SHAIRPORTSYNC" value="ON"> <?
        } ?>
      </td>

      <td>
        <input type="hidden" name="JACKBF_BLUEALSAAPLAY" value="OFF" <? test_bt() ?> > <?
        if ($ini_array["JACKBF_BLUEALSAAPLAY"] == "ON")
        { ?>
          <input type="checkbox" id="jackbf" name="JACKBF_BLUEALSAAPLAY" value="ON" checked <? test_bt() ?> > <?
        }
        else
        { ?>
          <input type="checkbox" id="jackbf" name="JACKBF_BLUEALSAAPLAY" value="ON" <? test_bt() ?> > <?
        } ?>
      </td>

      <td>
        <input type="hidden" name="JACKBF_INPUT" value="OFF" <? test_input() ?> > <?
          if ($ini_array["JACKBF_INPUT"] == "ON")
          { ?>
            <input type="checkbox" id="jackbf" name="JACKBF_INPUT" value="ON" checked <? test_input() ?> > <?
          }
          else
          { ?>
            <input type="checkbox" id="jackbf" name="JACKBF_INPUT" value="ON" <? test_input() ?> > <?
          } ?>
      </td>
      <td>
        <input type="hidden" name="JACKBF_NETJACK" value="OFF"> <?
        if ($ini_array["JACKBF_NETJACK"] == "ON")
        { ?>
          <input type="checkbox" id="jack" name="JACKBF_NETJACK" value="ON" checked> <?
        }
        else
        { ?>
          <input type="checkbox" id="jack" name="JACKBF_NETJACK" value="ON"> <?
        } ?>
      </td>
    </tr>

    <tr>
      <td> <?
        ?> <!-- Output BRUTEFIR MS (CONVOL. MS) -------------------------------------------------------------------------> <?
        if ($ini_array["AUDIO_OUTPUT"] == "jack-bfms")
        { ?>
          <input class="actiongroup" type="radio" name="AUDIO_OUTPUT" value="jack-bfms" checked>
          <a title="<? print ${helptext_audio_out_convol_ms._.$lang} ?>"class="tooltip"> Convol. MS <?
        }
        else
        { ?>
          <input class="actiongroup" type="radio" name="AUDIO_OUTPUT" value="jack-bfms">
          <a title="<? print ${helptext_audio_out_convol_ms._.$lang} ?>"class="tooltip"> Convol. MS <?
        } ?>
      </td>

    <td>
      <input type="hidden" name="JACKBFMS_SQUEEZELITE" value="OFF"><?
      if ($ini_array["JACKBFMS_SQUEEZELITE"] == "ON")
      { ?>
        <input type="checkbox" id="jackbfms" name="JACKBFMS_SQUEEZELITE" value="ON" checked> <?
      }
      else
      { ?>
        <input type="checkbox" id="jackbfms" name="JACKBFMS_SQUEEZELITE" value="ON"> <?
      } ?>
    </td>

    <td>
      <input type="hidden" name="JACKBFMS_GMEDIARENDER" value="OFF"><?
      if ($ini_array["JACKBFMS_GMEDIARENDER"] == "ON")
      { ?>
        <input type="checkbox" id="jackbfms" name="JACKBFMS_GMEDIARENDER" value="ON" checked> <?
      }
      else
      { ?>
        <input type="checkbox" id="jackbfms"name="JACKBFMS_GMEDIARENDER" value="ON"> <?
      } ?>
    </td>

    <td>
      <input type="hidden" name="JACKBFMS_SHAIRPORTSYNC" value="OFF"> <?
      if ($ini_array["JACKBFMS_SHAIRPORTSYNC"] == "ON")
      { ?>
        <input type="checkbox" id="jackbfms" name="JACKBFMS_SHAIRPORTSYNC" value="ON" checked> <?
      }
      else
      { ?>
        <input type="checkbox" id="jackbfms" name="JACKBFMS_SHAIRPORTSYNC" value="ON"> <?
      } ?>
    </td>

    <td>
      <input type="hidden" name="JACKBFMS_BLUEALSAAPLAY" value="OFF" <? test_bt() ?> > <?
      if ($ini_array["JACKBFMS_BLUEALSAAPLAY"] == "ON")
      { ?>
        <input type="checkbox" id="jackbfms" name="JACKBFMS_BLUEALSAAPLAY" value="ON" checked <? test_bt() ?> > <?
      }
      else
      { ?>
        <input type="checkbox" id="jackbfms" name="JACKBFMS_BLUEALSAAPLAY" value="ON" <? test_bt() ?> > <?
      } ?>
    </td>

    <td>
      <input type="hidden" name="JACKBFMS_INPUT" value="OFF" <? test_input() ?> > <?
      if ($ini_array["JACKBFMS_INPUT"] == "ON")
      { ?>
        <input type="checkbox" id="jackbfms" name="JACKBFMS_INPUT" value="ON" checked <? test_input() ?> > <?
      }
      else
      { ?>
        <input type="checkbox" id="jackbfms" name="JACKBFMS_INPUT" value="ON" <? test_input() ?> > <?
      }?>
    </td>
    <td>
      <input type="hidden" name="JACKBFMS_NETJACK" value="OFF"> <?
      if ($ini_array["JACKBFMS_NETJACK"] == "ON")
      { ?>
        <input type="checkbox" id="jack" name="JACKBFMS_NETJACK" value="ON" checked> <?
      }
      else
      { ?>
        <input type="checkbox" id="jack" name="JACKBFMS_NETJACK" value="ON"> <?
      } ?>
    </td>
    </tr>
    </table>
  </fieldset>
</div>