#  Aufgabe 9: Stored Procedures

### Stored Procedures für den Messenger erstellen

In PhpMyAdmin die Datenbank auswählen welche für HUGE genutzt wird und dort obem im Reiter auf Routinen gehen welches dann so aussehen wollte da es noch keine gibt für diese Tabelle:

![Routinen](/_pictures/9Ue_Stored_Procedures.png)

Dort einfach auf neue Routinen erstellen drücken und dann kommt ein Fenster in welchen man einige felder ausfüllen kann wie `Prozeduren-Name`, `Parameter`, `Definition`, `Ist plangesteuert`, `Ersteller`, `Sicherheits-Typ`, `SQL-Datenzugriff` und `Kommentar`

![Routinen erstellen per Fenster](/_pictures/9Ue_Stored_Procedures_erstellt_per_eingabeFenster.png)

Man kann sie aber auch mit SQL Befehlen erstellen bei welchen es aber wichtig ist das Demeter am anfang und ende steht um Abhängigkeiten zwischen Objekten zu minimieren

![Stored Procedures erstellen per SQL](/_pictures/9Ue_Stored_Procedures_erstellt_per_SQL.png)

So habe ich für alle SQL Abfragen im MessageModel ein Stored Procedures erstellt

![Routinen](/_pictures/9Ue_Stored_Procedures_alle_erstellt.png)

Im Model müssen nun nur noch die SQL Abfragen entfernt werden und mit einen Call für die Stored Procedures geändert werden

![Aufruf der Stored Procedures im Model](/_pictures/9Ue_Stored_Procedures_im_Model_einbauen.png)

Wie man sehen kann Funktioniert der Messenger noch normal also hat das erstellen der Stored Procedures funktioniert

![Funktionierender Messager mit Stored Procedures](/_pictures/9Ue_Messenger_funktioniert.png)