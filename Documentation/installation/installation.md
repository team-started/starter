# Installation

Die Installation ist mit Composer und klassischen ablegen des Extension-Ordners im TYPO3-Extension-Ordner
möglich. **Empfohlen ist die Installation mit Composer**, wodurch auf eine Dokumentation des klassischen Wegs
verzichtet wird.

## Anpassen der composer.json

Vor der Installation des Package mittels Composer, muss die composer.json des Gesamtprojektes angepasst werden. Dies ist
notwendig, da es sich hierbei um keine öffentlich Extension handelt und Composer daher mitgeteilt werden muss, wo das
Package zu finden ist.

In die Datei `composer.json` des Projektes muss das Repository `http://packagist.starter.team` hinzugefügt werden, damit
Composer unter dieser URL nach dem Package suchen kann.

Die angepasste `composer.json` sollte nun wie nachfolgend aussehen.

```
{
	"repositories": [
		{
			"type": "path",
			"url": "packages/*"
		},
		{
			"type": "composer",
			"url": "http://packagist.starter.team"
		},
		{
			"type": "composer",
			"url": "https://composer.typo3.org/"
		}
	],
	....
}
```

Abschließend sollte der Befehl `ddev composer update --lock` (bei Verwendung von DDEV) oder `composer update --lock` ausgeführt werden, damit
diese Änderungen ebenfalls in der Lock-Datei landen.

## Installation mit Composer und DDEV

Die lokale Entwicklungsumgebung mittels Docker und DDEV ermöglicht die Installation innerhalb des Docker-Container mit
dem nachfolgenden Befehl.

::: { .info }
`ddev composer req starterteam/starter`
:::

## Installation mit Composer und lokalem Webserver

Diese Installationsvariante sollte nur genutzt werden, wenn man nicht mit einem Docker-Setup arbeitet und auf seinem
lokalen Computer einen Webserver betreibt, z.B. mit XAMP, MAMP oder einer nativen Variante.

Hierbei ist darauf zu achten, das die korrekte PHP Version eingestellt ist, welche später auch auf dem Webserver des
Kunden konfiguriert ist, da es sonst zu Versionskonflikten und zu einem Ausfall der Website kommen kann.

::: { .info }
`composer req starterteam/starter`
:::

## Extension in TYPO3 aktivieren

Nach einer erfolgreichen Installatino befindet sich die Extension im Verzeichnis `public/typo3conf/ext/` und muss nun
aktiviert werden. Die schnellste Variante dies zu erledigen ist die Nutzung der TYPO3-Console.

### Aktivierung mit DDEV

`ddev typo3cms install:generatepackagestates`

### Aktivierung mit lokalem Webserver

`php vendor/bin/typo3cms install:generatepackagestates`


## Extension mit Composer aktualisieren

Durch den oben beschriebenen Installationwegs, wird in die Root-Composer des Projektes ein Eintrag ähnlich
_"starterteam/starter": "^2.0"_ eingetragen. Bei einem Update wird nun überprüft, ob es für die Version 2.x.x
der Ext:starter ein Update verfügbar ist. Somit wird die aktuellste Version < 3.0.0 eingespielt.

Ein Update ist ebenfall mit Composer einem Befehl auf der Shell möglich.

::: { .info }
`ddev composer update starterteam/starter` bzw. `composer update starterteam/starter`
:::

Die Bedeutung des `^` und `~` kann in der [Composer-Dokumentation](https://comopser.org) nachgelesen werden.

## Extension mit Composer deinstallieren

Auch das Deinstallieren der Extension ist mittels Composer auf der Shell möglich.

::: { .info }
`ddev composer remove starterteam/starter` bzw. `composer remove starterteam/starter`
:::

Hierdurch wird die Extension deinstalliert, zuvor in TYPO3 deaktiviert und anschließend aus dem Dateisystem entfernt.
Vorhandene Verweise wie TypoScript, Sass, JavaScript auf die Ext:starter **müssen manuell entfernt werden**.

> Weiter führende Themen:
> * [Konfiguration](./konfiguration.md)
> * [CSS Framework](./css-framework/index.md)
> * [JavaScript & Sass](./js-css/index.md)
> * [Zusätzliche Felder von EXT:starter](./Fields/Tt_content.md)
