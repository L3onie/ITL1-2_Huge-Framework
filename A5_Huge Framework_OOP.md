#  Aufgabe 5: Huge Framework / OOP

### Fragen

**Aus welchen Bausteinen besteht das Framework**?

config, controller, core, model, view


**Wie sieht die DB aus**?

***users***: Speichert alle Benutzerinformationen

***notes***: Speichert die von Benutzern erstellten Notizen und enthält einen Fremdschlüssel zur users-Tabelle


**Wozu dient der public Ordner**?

Der public Ordner enthält alle Dateien die direkt vom Browser aufgerufen werden können


**Beschreibe folgende Bausteine**:

| Baustein  | Beschreibung |
| ------------- |:-------------:|
| Config | Speichert alle Einstellungen wie Datenbankzugang, App-Name oder Pfade |
| Model | Kümmert sich um die Datenbank und verwaltet die Daten |
| Controller | Verbindet Model und View und steuert, welche Daten angezeigt werden |
| Core | Enthält das Herzstück des Frameworks wie Routing, Request-Handling und Basis-Klassen |
| View | Zeigt die Daten für den Nutzer über HTML-Templates an |


**Wie sieht der Konstruktor in PHP Klassen aus**?

```
function __construct($name) {
    $this->name = $name;
  }
```

**Wozu dient die „Variable“ $this**?

`$this` verweist auf das aktuelle Objekt und erlaubt den Zugriff auf seine eigenen Eigenschaften und Methoden

**Welche Vorteile hat die Verwendung von OOP in PHP**?

Klassen können mehrfach genutzt werden und dadurch ist der Code auch übersichtlicher weil alles in Objekte und Klassen aufgeteilt ist. Neue Klassen können bestehenede Klassen übernehmen was alles gut Erweiterbar macht. Außerdem können Daten und Methoden durch z.B private oder protected vor fremden Zugriff geschützt werden.

**Welche Datenkapselungsmethoden gibt es in PHP**?

***public***: Zugriff von überall möglich

***protected***: Zugriff nur innerhalb der Klasse und Unterklassen

***private***: Zugriff nur innerhalb der Klasse selbst

**Wie sehen abstrakte Klassen in PHP aus**?

```
<?php
abstract class Katze {
    protected $name;

    public function __construct($name) {
        $this->name = $name;
    }
}
```


### Bilder

Chat Liste

![chat liste bild](/_pictures/8Ue_index.png)

***

Chat Verlauf

![chat liste bild](/_pictures/8Ue_Chatverlauf.png)

***

Nachricht schreiben

![nachricht schreiben bild](/_pictures/8Ue_Nachricht_schreiben.png)

***

Nachricht abschicken

![nachricht abschicken bild](/_pictures/8Ue_Nachricht_abgeschickt.png)
