# Felder für tt_content

Beschreibungen für Felder in tt_content, sofern es keine Standardfelder des TYPO3 Core sind:

**tx_starter_celink:**
Mit dieser Option kann das gesamte Inhaltselement verlinkt werden. Um diese Option zu nutzen, muss per PageTs die Option
aktiviert werden:

```
TCEFORM {
    tt_content {
        tx_starter_celink.disabled = 0
    }
}
```

Zusätzlich sollte für das entsprechende Inhaltselemente im RTE die Möglichkeit der Verlinkung deaktiviert werden, da es
sonst zu verschachtelten Links kommt, was nicht vom jedem Browser korrekt interpretiert wird. Zum anderen kommt es zu
Missverständnissen bei den Redakteuren.

Das FLUID Template des entsprechenden Inhaltselementes muss zusätzlich angepasst werden, damit ein entsprechender Link
erzeugt und um das Element gewrapped wird.

**header_layout**\
Dieses Feld aus dem TYPO3 Core wurde jediglich erweitert, um eine H6 und die Option, eine Headline zu setzen, diese aber nicht als Headline zu rendern (99).

**tx_starter_headerclass**\
Zur freien Nutzung, z.B. graphische Header, Schriftart, keine default Werte im Starter.

**tx_starter_headerfontsize**\
Setzt die Schriftgröße entsprechend dem Level, ändert jedoch nicht den HTML Tag (h1, h2, ...).\
Der Grund dieses Konzeptes ist, dass das Design (also, meistens die Schriftgröße) für den Redakteur frei nutzbar wird, unabhängig davon, welche Level die Headline für SEO haben muss.

**tx_starter_headercolor**\
Schriftfarbe, kein default im Starter.

**tx_starter_height**


**tx_starter_textclass**\
Zur freien Nutzung, kein default im Starter.

**tx_starter_textcolor**\
Schriftfarbe des `bodytext`, kein default im Starter.
