#!/bin/sh

if test -s "../${QUERY_STRING}/index.php" ; then
  echo -e "Status: 302 Found\r"
  echo -e "Location: index.php\r"
  exit 0
fi

# standardkonformen HTTP-Header erzeugen
echo -en "Content-Type: text/html\r\n\r\n"
cat << EOF
<html>
  <head>
    <title>Index of ${QUERY_STRING}</title>
  </head>
  <body>
    <h2>Index of ${QUERY_STRING}</h2>
    <table cellspacing="2" border="0">
      <tr align="left"><th>Name</th><th>&nbsp;&nbsp;Last modified</th><th>&nbsp;&nbsp;Size</th></tr>
      <tr><td colspan="3"><hr></td></tr>
      <tr><td>$([ "$QUERY_STRING" == "/" ] || echo '<a href="..">..</a>')</td></tr>
      $(
        # alle Fehler ins Nirvana umleiten
        exec 2>/dev/null
        # Datumsformat 1 zum Finden in der Verzeichnisliste
        date_format1="[A-Z][a-z]{2} [A-Z][a-z]{2} [ 123][0-9] [0-9]{2}:[0-9]{2}:[0-9]{2} [0-9]{4}"
        # langer Ersetzungsausdruck (daher separat), der eine Tabellenzeile
        # generiert
        replace="<tr><td><tt><a href=\"\3\">\3<\/a><\/tt><\/td><td><tt>\&nbsp;\&nbsp;\2<\/tt><\/td><td align=right><tt>\&nbsp;\&nbsp;\1<\/tt><\/td><\/tr>"
        # Datumsformat 2 zum Separieren eines führenden Leerzeichens bei der
        # Tageszahl (muß durch festes HTML-Leerzeichen &nbsp; ersetzt werden)
        date_format2="([A-Z][a-z]{2} [A-Z][a-z]{2} ) ([0-9] [0-9]{2}:[0-9]{2}:[0-9]{2} [0-9]{4})"
        busybox ls -lLep ../${QUERY_STRING} |
          # im Wurzelverzeichnis "cgi-bin" herausfiltern
          ([ "$QUERY_STRING" == "/" ] && grep -v 'cgi-bin' || cat) |
          # Zeilen numerieren, damit Reihenfolge innerhalb der beiden Gruppen
          # (Verzeichnisse und der Rest) später erhalten bleibt beim Sortieren
          awk '{printf("%5d %s\n", NR,$0)}' |
          # "X" vor Verzeichnisse setzen, "Y" vor den Rest ("X" < "Y")
          sed -r 's/^([0-9 ]+ d)/X \1/' |
          sed -r 's/^([0-9 ]+)/Y \1/' |
          # Sortieren bewirkt Gruppierung der Einträge
          sort |
          # Sortierhilfen + nicht benötigte Spalten löschen
          sed -r 's/^([^ ]+ +){6}(.*)/\2/' |
          # Dateigrößen für Verzeichnisse durch "---" ersetzen
          sed -r 's/^[0-9]+(.*)\/$/---\1/' |
          # eine Tabellenzeile je Verzeichniseintrag erzeugen
          sed -r "s/^([-0-9, ]+) ($date_format1) +(.*)$/$replace/" |
          # Sonderfall führendes Leerzeichen bei Tageszahl im Datum
          sed -r "s/$date_format2/\1\&nbsp;\2/"
      )
    </table>
  </body>
</html>
EOF
