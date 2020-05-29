<?php
/*
+---------------------------------------------------------------+
|	4xA-EMS v0.5 - by ***RuSsE*** (www.e107.4xA.de) 29.10.2009
|	sorce: ../../4xA_ems/languages/German.php
|	Original- Idee stamm von EMS-Plugin version 1.0 trunk of iNfLuX (influx604@gmail.com)
|
|	For the e107 website system
|	©Steve Dunstan
|	http://e107.org
|	jalist@e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
//vers. 0.5
define("", "");
define("", "");
define("", "");
define("e4xA_EMS_DESC", "Ein Plugin der es erlaubt die Benutzer nach den Freigegebenen Bunutzer-Daten zu filtern.<br/>
							Original- Idee stamm von EMS-Plugin version 1.0 trunk of iNfLuX (influx604@gmail.com)<br/>
							Diese Version wurde so erweitert, dass mann alle Erweiterte- Benutzer- Felder in die Suche mit einbezihen kann.");
define("e4xA_EMS_INSTALL_DONE", "Installation war erfolgreich!");
define("e4xA_PAGE_LINK_NAME", "Benutzer Suche");

define("SEARCH_FORM_CAPTION", "Suchformular");
define("SEARCH_START", "Benutzer Filtern");
define("NO_RESULTS", "Keine Ergebnisse");
define("REGESTRIERTE_MITGIELDER", "Registrierte Benutzer: ");
define("GEFUNDEN_MITGIELDER", "Gefundene Benutzer: ");
define("PAGE_NAME_4xA_EMS", "Benutzer Filtern");
define("VON", " von ");
define("BIS", " bis ");
define("EINSTELLUNGEN_GESCHPEICHERT", "Einstellungen sind gespeichert!");
define("SYSTEM_BENUTZER_FELDER", "System- Felder des Benutzer");
define("DB_FIELD_EDIT", "Erweitertes Benutzer-Feld bearbeiten");
define("ERWEITERTE_BENUTZER_FELDER", "Erweiterte-Benutzer-Felder");
define("e4xA_EMS_RECHTE", "Weitere Einstellungen");
define("VISITENKARTE", "als Visitenkarte");
define("TABELLE", "als Tabelle");
define("RESULTS_ZEIGEN_ALS", "Ergebnisse anzeigen als: ");
define("NO_OF_RESULTS_PER_SITE", "Anzahl d. Ergebnisse pro Seite: ");
define("NO_OF_ROWS_PER_SITE", "Anzahl d. Spalten. (nur bei Kartenansicht!): ");
define("SEARCH_USER_ACCES", "Wer darf die Suche Benutzen?: ");
define("SPEICHERN", "Einstellungen speichern");
define("BESUCHE_MICH", "Besuche unsere Seite!");
define("e4xA_EMS_ADMIN_CAPTION", "4xA-EMS Einstellingen");
define("USER_SEARCH_TO", "Benutzer nach ");
define("USER_SEARCH_TO_ACCES", " filtern erlauben? ");
define("FIELD_TYP_TABLE", "Tabelle");
define("FIELD_TYP_FROM_TABLE", "Inhalt aus der Tabelle: ");
define("FIELD_TYP_FROM_TABLE_ISO", "Wert-Feld: ");
define("FIELD_TYP_FROM_TABLE_TXT", "Text-Feld: ");
define("FIELD_TYP_TXTAREA", "Textbereich");
define("ABFRAGE_PARAMETER", "parameter: ");
define("FIELD_TYP_INT", "Intenger");
define("FIELD_TYP_DATA", "Datum");
define("FIELD_TYP_LANG", "Sprache");
define("JEDER", "jeder");
define("NUR_MITGLIEDER", "nur Mitglieder");
define("NUR_ADMIN", "nur Administratoren");
define("KEINER", "keiner (inaktiv)");
define("e4xA_EMS_SYS_01", "Benutzername");
define("e4xA_EMS_SYS_02", "Richtige Name");
define("e4xA_EMS_SYS_03", "Avatar");
define("e4xA_EMS_SYS_04", "Foto");
define("e4xA_EMS_SYS_05", "Online-Status");
define("e4xA_EMS_SYS_06", "Geburtstag");
define("e4xA_EMS_SYS_07", "Dabei seit");
define("e4xA_EMS_SYS_08", "eMail");
define("e4xA_EMS_CEL_COUNT_TEXT", "Anzahl d. Spalten. bei Kartenansicht!: ");
define("e4xA_EMS_BURT_FIELD_TEXT", "DB-Feld für Geburtstag: ");
define("e4xA_EMS_SEX_FIELD_TEXT", "DB-Feld für Geschlecht: ");
define("e4xA_EMS_NO_DATA", "Keine Angaben");
define("e4xA_EMS_NO_VIEW", "-versteckt-");
define("e4xA_EMS_ALTER", "J.");

//vers. 0.6
define("e4xA_EMS_FIELT_OPT_NAME", "Suchfeld-Bezeichnung: ");
define("e4xA_EMS_FIELT_OPT_NAME2", "Optional! sonnst wird der Text des Felders.");
define("e4xA_EMS_HELP_CAP", "Liesmich 4xA-EMS 0.6");
define("e4xA_EMS_HELP", "<h2>1. Geburtstag.</h2><br/><br/>
in dem DB ist bereits ein Erweitertes Feld <b>burtday</b> angelegt und als Datum konfiguriert.<br/>
Diesen möchten wir natürlich auch zum suchen nach Alter (das heisst zBsp. zeige alle Benutzer die vo 10 Jahre alt bis 20 Jahre alt sind.)<br/><br/>
Damit das Plugin es auch richtig tut, mus dieses Feld unter 4xA-EMS->Einstellungen etwas besonnders konfiguriert werden.<br/>
<h3>und zwar:</h3><br/>
a) hacken setzen<br/>
b) die Parametern angeben. Hier ist es wichtig dass mann alles richtig angiebt, denn diese Zeichenkette wird mehrmals von der Programm ausseinander gelegt um die Feld-Parametern auszulesen.<br/>
<br/>
Ein Beispiel für ein <b>Datum-Feld</b>: <input style='width: 300px;' name='bespiel001' type='text' value='A|2|10,16,18,20,25,30,35,40,4 5,60,70,90,100|'/><br/><br/>

Erläuterung: an der Erste Stelle steht <b>A</b>, dass bedeutet das dieses Feld soll als <b>Alter</b> behandelt werden.<br/>
Dann nach einem Trennzeichen <b>|</b> kommt die <b>2</b> dass bedeutet das in dem Suchfolmulas sollen die Suchfelder als Kombobox angezeigt werden.<br/>
Hier kann auch eine <b>1</b> eingesetzt werden, dann wird es ein Textbox.<br/>
Nach einem weiteren Trennzeichen <b>|</b> Kommen djede Menge Zahlen. Das sind die Werte die in dem Kombobox zum Auswahl stehen sollen.<br/>
Achtung!!!!! ein Textbox braucht diese defenierte Werte nicht also kann man es leer lassen, dann würde es bei einem Textbox so aussehen: <b>A|1||</b> (ist doch ganz einfach?  )<br/><br/>
<h3>Eine weitere Besonderheit:</h3><br/>
In dem Beispiel oben stehen werte aufgelistet <b>10,16,18,20,25,30,35,40,4 5,60,70,90,100</b> es kann mehr oder weniger sein, ist alles nach Ihrem Geschmak, ABER die Werte sollen alle mit Komma getrennt stehen.<br/>
Wenn man es aber nicht alle Werte selber angeben möchte, kann man es auch so darstellen: <b>1,-,100</b> oder <b>10,-,60</b> usw. Es werden automatisch alle Werte zbsp. von 1 bis 100 aufgwlistet. Dabei sind die Kommas vor und nach <b>-</b> Zeichen sehr wichtig.<br/><br/>

Diese Parametern sind jetzt nur für DB-Feldern, die als <b>Datum</b> angeleng sind wichtig!<br/>
Mann kann auch weitere Felder so nutzen, Beispiel Datum des Eheschliessung. Und dann kann es gesucht werden nach dem Wert <i>Wie lange man schon verheiratet ist</i> zum Beispiel.<br/><br/>

<br/>
<h2>2. Zeit-Interwale</h2><br/>

Sowas kann man zBsp. benutzen für die Informationen, wann man die Schule besucht hat. Oder wann mann in dem Verein aktiv war....<br/>

Dafür muss man unter der Erweiterten- Benutzerfelder ZWEI neue Felder anlegen, zBsp. <b>weding1</b> und <b>weding2</b> (wie diese heissen ist wurscht, hauptsache keine Sonderzeichen und keine Leerzeichen)
Um besseren Darstellung zu ermöglichen soll man Eine Feld-Gruppe erstellen (sieh unter Erweiterten- Benutzerfelder). Die zwei erstellte Felder soll man dann in diese Gruppe zuweisen.<br/>
<br/>
<h3>Dann unter 4xA-EMS->Einstellungen:</h3><br/> 
a) hacken setzen aber bitte nur bei einem von der zwei damit es in dem Suchformular nicht doppelt erschent.<br/>
b) die Parametern angeben. Hier ist es wichtig dass mann alles richtig angiebt, denn diese Zeichenkette wird mehrmals von der Programm ausseinander gelegt um die Feld-Parametern auszulesen.<br/>
<br/>
Ein Beispiel für ein <b>Datum-Feld</b>: <input style='width: 300px;' name='bespiel002' type='text' value='VB|2|1960,-,2010|user_weding2|'/><br/><br/>

Erläuterung: an der Erste Stelle steht <bVB</b>, dass bedeutet das dieses Feld soll als <b>VON-BIS</b> behandelt werden.<br/>
Dann nach einem Trennzeichen <b>|</b> kommt die <b>2</b> dass bedeutet das in dem Suchfolmulas sollen die Suchfelder als Kombobox angezeigt werden.<br/>
Hier kann auch eine <b>1</b> eingesetzt werden, dann wird es ein Textbox. Also Quasi wie bei dem <i>ALTER</i>.<br/>
Dann wiesed der Interwal der im Kombobox angezeigt werden soll <b>1960,-,2010</b> ist genau so wie oben.<br/><br/>

Und jetzt kommt noch was, und zwar Name des <i>Zweitern</i> Feldes <b>weding2</b> damit der Zeitinterwal bestimmt werden kann.<br/><br/>");
?>