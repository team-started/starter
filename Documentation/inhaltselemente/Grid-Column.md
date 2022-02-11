# Inhaltselement Grid-Column

Mit diesem Inhaltselement wird eine **einfache Möglichkeit** geschaffen, Inhalte in Spalten zu verwalten.

![Backend-Preview CE:Grid-Column](../assets/ce-gridcolumn-be-preview.png =500x268)

## Verwendung

In diesem Inhaltselement werden weitere Inhaltselemente als Inline-Relations (IRRE) angelegt. Dabei entspricht
**jedes IRRE Element einer Spalte**.

Komplexe Strukturen, wie mehrere Inhalte pro Spalte sind mit diesem Inhaltselement **nicht** möglich. In solchen Fällen
kann zum Beispiel auf die [Extension gridelements][1] zurück gegriffen werden


## Zusätzliche Elemente konfigurieren

Im Default-Zustand ist das Inhaltselement "Text" zugelassen. Werden weitere Inhaltselemente benötigt, so lassen sich
diese per PageTs konfigurieren.

**Beachte:** Die ColPos darf **nicht** verändert werden - auch, wenn das per PageTs möglich wäre.

```
##
# Inhaltselement "starter_textmedia" zusätzlich erlauben
##
tx_starter {
  inlineContentElementSettings {
    starter_column_grid {
      allowed = text,starter_textmedia
      default = text
    }
  }
}
```

[1]: https://extensions.typo3.org/extension/gridelements
