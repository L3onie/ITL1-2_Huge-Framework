#  Aufgabe 11: reCAPTCHA

### reCAPTCHA im HUGE Framework

Erstmal in Google anmelden und dann auf die seite `https://www.google.com/recaptcha` aufrufen und dort auf "Jetzt starten" drücken

![Google reCAPTCHA: Neue Webseite registrieren](/_pictures/11UE_reCAPTCHA.png)

Dann öffnet sich die Seite wo man einfach ein Label eingibt, kann egal was sein und dann muss man noch bei reCAPCHA-Typ wo ich einfach so wie im Bild ausgefüllt hab und dann unten auf Senden

![Site und Secret Key in config eingefügt](/_pictures/11Ue_Keys_einfügen.png)

Dann werden die Keys angzeigt welche dann in Huge im Backend in der `config.development.php` im Ordner `application/config` so wie man es im bild oben sehen kann

![Überprüfung des reCAPTCHA im RegisterController](/_pictures/11Ue_prüfung_einbauen.png)

Als nächstes wurde in der `register_action` im RegisterController die Prüfung des reCAPTCHA eingebaut. Dabei wird beim Absenden des Formulars überprüft ob der Nutzer das reCAPTCHA erfolgreich bestätigt hat. Nur wenn diese Überprüfung erfolgreich ist wird der Benutzer anschließend in der Datenbank angelegt

![Einbauen des Buttons für reCAPTCHA](/_pictures/11Ue_Button_anzeigen.png)

Abschließend wurde im `view/register/index.php` der Button für das reCAPTCHA eingebaut, dadurch ist das reCAPTCHA-Element nun auch im Registrierungsformular sichtbar

***

### Bilder

Register Formular mit reCAPTCHA Button

![Register Formular mit reCAPTCHA Button](/_pictures/11Ue_Register.png)

reCAPTCHA Test

![reCAPTCHA Test](/_pictures/11Ue_reCAPTCHA_Test.png)

Beim erfolgreichen bestehen des Tests wird ein haken gesetzt

![reCAPTCHA Test bestanden](/_pictures/11Ue_reCAPTCHA_Check.png)

Dann kann man einfach auf Register drücken und wenn die reCAPTCHA bestanden wurde wird der nutzer in der Datenbank erstellt

![reCAPTCHA Test bestanden](/_pictures/11Ue_Register_erfolgreich.png)