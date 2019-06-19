<?php
  $ini_array = parse_ini_file("/boot/userconfig.txt", 1);

  if ($ini_array['USEBETA'] == "ON")
  {
    exec ( "/usr/bin/update -c -u beta" , $ausgabe , $return_var );
  }
  else
  {
    exec ( "/usr/bin/update -c" , $ausgabe , $return_var );
  }

  if ($ausgabe[0] != $ini_array[KNOWN_VERSION])
  {
    list($remote[0], $remote[1], $remote[2]) = explode(".", $ausgabe[0]);
    list($local[0], $local[1], $local[2]) = explode(".", $ausgabe[1]);

    if ($remote[0] > $local[0])
    {
      echo '<script type="text/javascript" language="Javascript">
      alert("'.${infotext_update_available._.$lang}.'\n\n'.${local_version._.$lang}.$ausgabe[1].'\n'.${remote_version._.$lang}.$ausgabe[0].'\n\n'.${infotext_update_ack._.$lang}.'")
      </script> ';
      if ($ausgabe[0] != "Could not find remote version...")
      {
        exec( "/usr/bin/cardmount rw" );
        wrtToUserconfig(KNOWN_VERSION,$ausgabe[0]);
        exec( "/usr/bin/cardmount ro" );
      }
    }
    else
    {
      if ($remote[0] == $local[0] && $remote[1] > $local[1])
      {
        echo '<script type="text/javascript" language="Javascript">
        alert("'.${infotext_update_available._.$lang}.'\n\n'.${local_version._.$lang}.$ausgabe[1].'\n'.${remote_version._.$lang}.$ausgabe[0].'\n\n'.${infotext_update_ack._.$lang}.'")
        </script> ';
        exec( "/usr/bin/cardmount rw" );
        wrtToUserconfig(KNOWN_VERSION,$ausgabe[0]);
        exec( "/usr/bin/cardmount ro" );
      }
      else
      {
        if ($remote[0] == $local[0] && $remote[1] == $local[1] && $remote[2] > $local[2])
        {
          echo '<script type="text/javascript" language="Javascript">
          alert("'.${infotext_update_available._.$lang}.'\n\n'.${local_version._.$lang}.$ausgabe[1].'\n'.${remote_version._.$lang}.$ausgabe[0].'\n\n'.${infotext_update_ack._.$lang}.'")
          </script> ';
          exec( "/usr/bin/cardmount rw" );
          wrtToUserconfig(KNOWN_VERSION,$ausgabe[0]);
          exec( "/usr/bin/cardmount ro" );
        }
      }
    }
  }
?>
