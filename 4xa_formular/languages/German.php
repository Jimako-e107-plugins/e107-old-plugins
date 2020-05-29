<?php
/*
+---------------------------------------------------------------+
|	4xA-Formular v0.10 - by ***RuSsE*** (www.e107.4xA.de) 23.02.2011
|	sorce: ../../4xa_formular/languages/German.php
|
|	For the e107 website system
|	©Steve Dunstan
|	http://e107.org
|	jalist@e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
//vers. 0.1
define("LAN_4xA_FORM_01", "4xA-Formular");
define("LAN_4xA_FORM_02", "Ein e107-Plugin mit dem mann bequemm persönliche Formulare erstellen kann.");
define("LAN_4xA_FORM_03", "Optionen");
define("LAN_4xA_FORM_04", "Voreinstellungen");
define("LAN_4xA_FORM_05", "Plugin-Menü");

define("LAN_4xA_FORM_06", "<b>Formular Feld-Name</b><br/>Eindeutige Name ohne Sonder- und leer-Zeichen!");
define("LAN_4xA_FORM_06a", "<b>Feld-Name</b>");
define("LAN_4xA_FORM_07", "<b>Formular angezeigter Feld-Name</b><br/>Belibiges Bezeichnung des Formular-Elements, wie es halt auf der Seite angezeigt werden soll.");
define("LAN_4xA_FORM_07a", "<b>Angez. Name</b>");
define("LAN_4xA_FORM_08", "<b>Formular Feld-Typ</b><br/>Bitte auswählen von wilche Typ das Formular-Element sein soll.");
define("LAN_4xA_FORM_08a", "<b>Feld-Typ</b>");
define("LAN_4xA_FORM_09", "text");
define("LAN_4xA_FORM_10", "dropdown");
define("LAN_4xA_FORM_11", "checkbox");
define("LAN_4xA_FORM_12", "table");
define("LAN_4xA_FORM_13", "radio");
define("LAN_4xA_FORM_14", "date");
define("LAN_4xA_FORM_15", "datestamp");
define("LAN_4xA_FORM_15b", "textarea");
define("LAN_4xA_FORM_16", "<b>Feld- Parameter</b><br/>Übergabe-Parametern die für das Erstellung des Elements wichtig sind. Bitte Hilfe lesen!!!");
define("LAN_4xA_FORM_16a", "<b>Parameter</b>");
define("LAN_4xA_FORM_17", "<b>Feld- Beschreibung</b><br/>Formulat-Element- Beschreibung als Hilfe wie es ausgefühlt werden soll.");
define("LAN_4xA_FORM_17a", "<b>Beschreibung</b>");
define("LAN_4xA_FORM_18", "<b>Feld- Rheienfolge</b><br/>In welche Reihenvolge sollen Formular-Elemente auf der Seite angezeigt werden.");
define("LAN_4xA_FORM_18a", "<b>Rheien- folge</b>");
define("LAN_4xA_FORM_19", "<b>Feld-Status</b><br/> Aktiv oder nicht aktiv.");
define("LAN_4xA_FORM_19a", "<b>Status</b>");
define("LAN_4xA_FORM_20", "Formular- Überschrift");
define("LAN_4xA_FORM_21", "Wer darf Formular benutzen");
define("LAN_4xA_FORM_22", "Einstellungen speichern");
define("LAN_4xA_FORM_23", "Hilfe");
define("LAN_4xA_FORM_24", "<font style='font-size:200%'>Das ist nur ein Test!!!</font><br/>1. Neu erstellen
2. uner form_opt_iso_name: eine eindeutige Feldname ohne sonderzeichen usw. zbsp. country
unrer form_opt_name: einfach Feld-Bezeichnung, was praktisch später auf dem Formular stehen soll. zBsp. Land.
unter form_opt_typ: bitte das Typ der Formularobjektes auswählen. Es kann ein Textfeld oder checkbox usw. sein.
Tipp am Rande: da ich es weiss, dass das e107 vom Hause aus eine Tabelle mit Länder hat, habe ich diesen Feldtyp als Tabelle ausgewählt.

 form_opt_par: das ist die wichtigste Angabe überhaupt. Denn je nach ausgewählten Feld-Typ, muss man verschiedene Parametern an das Programm weiter geben, damit dieses Formular-Feld richtig dargestellt wird. Klingt kompleziert, ist aber nicht, nur ein bisshen aufpassen und ein paar Regeln merken.

Wir haben das Feld-Typ als Tabelle gewählt, also müssen wir als Parameter volgende Werte übergeben:
a)Name der Tabelle wo die information steht. um unseren Fall ist es die Tabelle: user_extended_country 
b)Name des Feldes in diese Tabelle die den genutztes Wert beinhaltet (meistens ist es das allererstes Feld mit bezeichnung xxx_id) im inseren Fall ist es aber :country_iso
c)Name des Feldes in diese Tabelle wo die Angezeigte Werte stehen sollen. zBsp: country_name. klingt etwas verwirend ist aber nicht. Warum nimmt mann für das Speichern und anzeigen verschiedene Felder??? ganz einfach: INDEX.
So, alle diese Werte werden mit dem ; Semikolla getrent (!!! Ohne Lehrzeichen !!!!).
So entseht es zBsp. für die unsere Tabelle folgende Parametern: user_extended_country; country_iso;country_name
Wenn du etwas üben möchtest, für die Ausgabe der Daten aus der User-Tabelle werden folgende Parameter benötigt:
user;user_id;user_name  ist doch ganz easy, oda  
form_opt_text: ist unwichtig, hier kann mann kurze Beschreibung oder Hilfe zu dem Feld erfassen.
 form_opt_sort: ist für die Reihenfolge gedacht um die Felder auf dem Formular nach eigenen Bedaf anzeigen.
 form_opt_enable: hier bitte Hacken setzen falls das Feld benutzt werden soll, also Aktiv /Inaktiv.
Zu dem form_opt_typ: muss ich eine kurze Anleitung ertellen, weill wie gesagt, jedes Feld hat eigene Werte. zBsp. normale Textfeld braucht eigentlich keine Werte aber mann kann diese trotzdem übergebem im etwas mehr kontrolle drüber zu erhalten. so kann man diesem 
a) vorgegebenes Text übergeben
b) Länge des Felders (ist zBsp. zu schade für einen Nausnummer-Feld ein 20-Zeichen langen Feld anzuzeigen)
c) Maximalle Länge des Textes der in das Feld angegeben werden darf.
Beispiel: xxx;3;5
Was viel interresanter ist, ist das erstellen der dropdown oder des radiobox.
in Beiden Fällen müssen mehrere Werte zum Auswahl übergeben werden.
so ist es zBsp. für den Feld Verwendungszweck müssen zwei Sachen zum Auswahl stehen privat und komerziell
Dies wird unter den form_opt_typ so erfasst: 1:privat;2:komerziell Also wie man sieht einzelne Werte werden auch hier durch ; getrennt/aufgelistet. Da aber auch hier das INDEX benutzt werden soll, steht, vor jedem einzelene Auswahl ein eindeutiges INDEX-Wert. 1, 2, 3,.... Das heisst wenn der Benutzer in dem Formular zBsp. komerziell auswählt, wird in dem DB nicht Komerziell gespeichert sondern der INDEX 2..... So erstmal sacken lassen. Noch mal kurz, warum wird INDEX benutzt?!?. Das INDEX iat das A und O bei den Datenbanken. Eine ganz kurze Beispiel. Wie wir oben gesagt haben, hat der Benutzer das komerziell ausgewählt und gespeicher wurde 2.
Würde mann im DB nicht den INDEX sondern den Inhalt selber reinschreiben, wie es bei uns komerziell, so würde es nach der Änderung auf komerziele Nutzung nicht mehr mit einander passen.");


define("LAN_NEW_CREATE", "Neuer Formularfeld erstellen");

define("LAN_CREATE", "Formular senden");
define("LAN_4xA_FORM_26", "Daten per Email an Admin Senden?");
define("LAN_4xA_FORM_27", "Kopftext des Emails.");

define("LAN_4xA_FORM_43", "Januar");
define("LAN_4xA_FORM_44", "Februar");
define("LAN_4xA_FORM_45", "März");
define("LAN_4xA_FORM_46", "April");
define("LAN_4xA_FORM_47", "Mai");
define("LAN_4xA_FORM_48", "Juni");
define("LAN_4xA_FORM_49", "Juli");
define("LAN_4xA_FORM_50", "August");
define("LAN_4xA_FORM_51", "September");
define("LAN_4xA_FORM_52", "Oktober");
define("LAN_4xA_FORM_53", "November");
define("LAN_4xA_FORM_54", "Dezember");

define("LAN_4xA_FORM_55", "Jan");
define("LAN_4xA_FORM_56", "Feb");
define("LAN_4xA_FORM_57", "Mär");
define("LAN_4xA_FORM_58", "Apr");
define("LAN_4xA_FORM_59", "Mai");
define("LAN_4xA_FORM_60", "Jun");
define("LAN_4xA_FORM_61", "Jul");
define("LAN_4xA_FORM_62", "Aug");
define("LAN_4xA_FORM_63", "Sep");
define("LAN_4xA_FORM_64", "Okt");
define("LAN_4xA_FORM_65", "Nov");
define("LAN_4xA_FORM_66", "Dez");

define('LAN_4xA_FORM_38', " Jeder ");
define('LAN_4xA_FORM_39', " Nur Gäste ");
define('LAN_4xA_FORM_40', " Nur Mitglieder ");
define('LAN_4xA_FORM_41', " Nur Admins ");
define('LAN_4xA_FORM_42', " Keiner (inactiv)  ");

define('LAN_4xA_FORM_94', "Speichern");
define('LAN_4xA_FORM_95', "Abbrechen");
define('LAN_4xA_FORM_96', "Sie haben leider keine Berechtigung, für diesen Bereich!");
define('LAN_4xA_FORM_98', "Dieser Bereich darf angesenen werden nur von der Benutzers der Gruppe:");
define('LAN_4xA_FORM_97', "Fehler!");
define('LAN_4xA_FORM_99', "Mein Formular");
define('LAN_4xA_FORM_100', "Sorry, Daten konnten nicht gespeichert werden, versuchen Sie es später noch mal....");
define('LAN_4xA_FORM_101', "Ihre Daten wurden erfolgreich gespeichert!");
define('LAN_4xA_FORM_102', "Formular Beschreibung");
define('LAN_4xA_FORM_103', "Kategorien");

define('LAN_4xA_FORM_104', "<b>Name</b><br/>Eindeutige Name des Formulars. Bitte OHNE Sondernzeichen/Umlauten angeben!!");
define('LAN_4xA_FORM_105', "<b>Name</b>");
define('LAN_4xA_FORM_106', "<b>Überschrift</b><br/>Überschrift des Formulars.");
define('LAN_4xA_FORM_107', "<b>Übersch.</b>");
define('LAN_4xA_FORM_108', "<b>Status</b><br/>Bitte Hacken setzen wenn der Formular aktiv sein soll.");
define('LAN_4xA_FORM_109', "<b>Stat.</b>");
define('LAN_4xA_FORM_110', "<b>Beschreibug</b><br/>Beschreibung des Formulars. Dieser Text erschein ganz oben im Formular und soll Informationen zu dem Formular beinhalten.");
define('LAN_4xA_FORM_111', "<b>Beschr.</b>");
define('LAN_4xA_FORM_112', "<b>Email senden?</b><br/>Bitte Hacken setzen wenn die im Formular erfasste Daten, an den Admin gesendet werden sollen.");
define('LAN_4xA_FORM_113', "<b>MailSend</b>");
define('LAN_4xA_FORM_114', "<b>Email-Überschrifttext</b><br/>Dieser Text erschein ganz oben im, an dem Admin versendeten Email.");
define('LAN_4xA_FORM_115', "<b>MailText</b>");
define('LAN_4xA_FORM_116', "<b>Benutzer- Gruppe</b><br/>Bitte die Gruppe der Benutzers auszuwählen, die diesen Formular sehen dürfen.");
define('LAN_4xA_FORM_117', "<b>Benutzers</b>");
define('LAN_4xA_FORM_118', "Neuen Formular erstellen");
define('LAN_4xA_FORM_119', "Zurück zu der Formularliste");
define('LAN_4xA_FORM_120', "Formularfelder für ");
define('LAN_4xA_FORM_121', "Formulare");
define('LAN_4xA_FORM_122', "Formularfelder für diesen Formular esrtellen");
define('LAN_4xA_FORM_123', "Soll es wirklich gelöscht werden?");
define('LAN_4xA_FORM_124', "Es liegt kein passender Formular for.");
define('LAN_4xA_FORM_125', "Dieser Formular ist momentan ausgeschaltet. Verfuchen Sie es später noch mal, oder setzen Sie sich bitte mit dem Administrator im Verbindung.");
define('LAN_4xA_FORM_126', "Formulare");


define('LAN_4xA_FORM_127', "Keine Datei wurde hoch geladen");

define('LAN_4xA_FORM_128', "Die Datei");
define('LAN_4xA_FORM_129', "wurde erfolgreich auf den Server übertragenagen!"); 
define('LAN_4xA_FORM_130', " ist keine erlaubter Dateiformat!"); 
define('LAN_4xA_FORM_131', "Datei");
define('LAN_4xA_FORM_132', "ist mit"); 
define('LAN_4xA_FORM_133', "viel zu groß!!!<br/>erlaubt sind maximal : "); 
define('LAN_4xA_FORM_134', "grosse kann nicht ermittelt werden!"); 
define('LAN_4xA_FORM_135', "px, ist das Bild zu breit! Maximal erlaubt sind:");
define('LAN_4xA_FORM_136', "px, ist das Bild zu hoch! Maximal erlaubt sind:"); 
define('LAN_4xA_FORM_137', "der Pflichtfeld <b>"); 
define('LAN_4xA_FORM_138', "</b> wurde nicht erfasst!"); 
define('LAN_4xA_FORM_139', "Zurück"); 
define('LAN_4xA_FORM_140', "<br/><br/><i>Achtung, mit <font style='color:#f00'>*</font> markierte Formularfelder sind angabepflichtlich!</i><br/><br/>"); 
define('LAN_4xA_FORM_141', "<b>Pflichtfeld?</b>");
define('LAN_4xA_FORM_142', "<b>Pflichtfeld</b>");

/// ab vers. 0.9
define('LAN_INSTALL_3', " Plugin wurde von der vers. ");
define('LAN_INSTALL_4', " auf die vers. ");
define('LAN_INSTALL_5', " aktualisiert.");

define('LAN_4xA_FORM_146', "Erfasst");
define('LAN_4xA_FORM_147', "Aktualisiert");
define('LAN_4xA_FORM_148', "Opt1");
define('LAN_4xA_FORM_149', "Opt2");
define('LAN_4xA_FORM_150', "Opt3");
define('LAN_4xA_FORM_151', "Opt4");
define('LAN_4xA_FORM_152', "Aktiv");
define('LAN_4xA_FORM_153', "Form. ID");
define('LAN_4xA_FORM_154', "Erfasste daten im Formular");
define('LAN_4xA_FORM_155', "Daten ansehen");
define('LAN_4xA_FORM_156', "Daten Löschen");
define('LAN_4xA_FORM_157', "am");
define('LAN_4xA_FORM_158', "um");
define('LAN_4xA_FORM_159', "Vorschau Antrag-ID");
define('LAN_4xA_FORM_160', "Zurück");
define('LAN_4xA_FORM_161', "Verifizierung");
define('LAN_4xA_FORM_162', "Fehler bei Verifizierung!");

define('LAN_4xA_FORM_163', "<b>Verifizierung</b> Verifizierung für das Formular einschalten?");
define('LAN_4xA_FORM_164', "Ver.");

define('LAN_4xA_FORM_165', "Erlauble Dateiformate: ");
define('LAN_4xA_FORM_166', "Erlauble Dateigröße: ");
define('LAN_4xA_FORM_167', "ins Verzeichniss: ");
?>