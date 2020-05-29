<?php
/*
+---------------------------------------------------------------+
|        EMS v1.7 - by ***RuSsE*** (www.e107.4xA.de) 19.03.2009
| 	 Original version 1.0 trunk of:	iNfLuX (influx604@gmail.com)
|
|        For the e107 website system
|        ©Steve Dunstan
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
define("PAGE_NAME_EMS_P1", "Mitglieder suche");
define("EMS_INSTALL_DONE_P2", "Installation war erfolgreich. ");
define("EMS_PLUGNAME", "Einfache Mitglieder Suche");
define("EMS_AUTOR", "***RuSsE***");
define("EMS_URL", "http://www.e107.4xa.de");
define("EMS_MAIL", "admin@4xa.de");
define("EMS_VERS", "1.7");
define("EMS_DESC", "Dieses Plugin erlaub es den Mitgliedsdatenbank mit bestimmten Filtern zu durchsuchen.<br /><b>Original versin 1.0 stamm von <a href='http://muzx.net'>\"iNfLuX\"</a></b>.<br /> Ich habe diese um ein paar weiteren Suchfeldern erweitert.");
// admin area
define("EMS_ADSC", "Settings updated successfully.");
define("EMS_AD01", "EMS Einstellungen");
define("EMS_AD02", "Mitglieder Sucheinstellungen");
define("EMS_AD03", "Menü; Einstellungen");
define("EMS_AD04", "Einstellungen");
define("EMS_AD05", "suche nach Benutzername erlauben ?");
define("EMS_AD06", "suche nach Wohnort erlauben ?");
define("EMS_AD07", "suche nach Geschlecht erlauben ?");
define("EMS_AD08", "such nach Fotos erlauben ?");
define("EMS_AD09", "Erweiterter Feldname für Wohnort:");
define("EMS_AD10", "Erweiterter Feldname für Geschlecht:");
define("EMS_AD11", " [<b>Ok:</b> Tabelle gefunden]");
define("EMS_AD12", " [<b>Fehler:</b> <a href='".e_ADMIN."users_extended.php'>Hier überprüfen</a>]");
define("EMS_AD13", "Suchformular anzeigen?<br /><span class='smalltext'>Im Falle dass Sie nur das Menü verwenden wollen</span>");
define("EMS_AD14", "Email Spalte anzeigen, wenn Mitglieder gefungen sind?");
define("PHOTO_btncap", "Speichern");
define("EMS_AD15", "suche nach richtigen Name erlauben ?");
define("EMS_AD16", "suche nach Datum erlauben ?");
define("EMS_AD17", "Erweiterter Feldname für Datum:");
define("EMS_AD18", "Feld für Start:");
define("EMS_AD19", "Feld für Ende:");
define("EMS_AD20", "Zeitspanne für suche, jahr von-bis:");
define("EMS_AD21", " zBsp. 1980-2009 Aber aufpassen, sonnst wird die Auswahlliste sehr laaaaaaaaaaang!!!!");
define("EMS_AD22", "Ergebnisse anzeigen als:");
define("EMS_AD23", "Tabelle");
define("EMS_AD24", "Visitenkarte");
define("EMS_AD25", "Anzahl d. Ergebnisse pro Seite:");
define("EMS_AD26", "Anzahl d. Spalten. bei Kartenansicht!:");
define("EMS_AD27", "Wer darf die Suche Benutzen? :");
define("EMS_AD28", "Jeder");
define("EMS_AD29", "Nur Mitglieder");
define("EMS_AD30", "Nur Admins");
define("EMS_AD31", "keiner (inaktiv)");
define("EMS_AD32", "suche nach Alter erlauben ?");
define("EMS_AD33", "Erweiterter Feldname für Geburtstag:");
/// V1.7
define("EMS_AD34", "Suche nach Familienstand erlauben?");
define("EMS_AD35", "Erweiterter Feldname für Familienstand:");
define("EMS_AD36", "Single");
define("EMS_AD37", "Nicht Single");
define("EMS_AD38", " und ");
define("EMS_AD39", "Dieses Feld soll folgende Werte beinhalten: ");
define("EMS_AD40", "Feld Typ:");
define("EMS_AD41", "Drop-Down Menü");
define("EMS_AD42", "Text Box");
define("EMS_AD43", "Datum");
define("EMS_110", "Familienstand");
// 

define("EMS_111", "Mitglieder Suchformular");
define("EMS_112", "Benutzername oder ein Teil davon");
define("EMS_113", "Geschlecht");
define("EMS_114", "Mann");
define("EMS_115", "Frau");
define("EMS_116", " Suchen ");
define("EMS_117", "Keine Übereinstimmung gefunden.");
define("EMS_118", "Wohnort");
define("EMS_119", "Foto");
define("EMS_120", "Nur Mitglieder mit Foto");
define("EMS_121", "Benutzername");
define("EMS_122", "Email Adresse");
define("EMS_123", "Registriert");
define("EMS_124", "[Verbergen auf Verlangen]");
define("EMS_125", "Gefunden: ");
define("EMS_126", "Registrierte Mitglieder: ");
define("EMS_127", "Mit Foto");
define("EMS_128", "ein Paar");
define("EMS_129", "Auswahl des Geschlechts um <font style='color: #f00'><b>".EMS_128."</b></font> erweitern?");
define("EMS_129a", "Bitte auch den Wert <font style='color: #f00'><b>".EMS_128."</b></font> in der Erweiterte Benutzersfelder eingeben!");
define("EMS_130", "Benuters- Richtigername oder ein Teil davon: ");
define("EMS_131", "Datum: ");
define("EMS_132", "Richtigername");
define("EMS_133", "Datum");
define("EMS_134", "von: ");
define("EMS_135", "bis: ");
define("EMS_136", "User: ");
define("EMS_137", "Name: ");
define("EMS_138", "Ort: ");
define("EMS_139", "Geschl.: ");
define("EMS_140", "Zeitraum: ");
define("EMS_141", "mit Foto: ");
define("EMS_142", "Sie haben keine Berechtigung für diesen Bereich der Seite!.");
define("EMS_143", "User:");
define("EMS_144", "Name:");
define("EMS_145", "ID:");
define("EMS_146", "Dabei seit:");
define("EMS_147", "Zeitraum: ");
define("EMS_148", "-versteckt-");
define("EMS_149", "K. Angaben");
define("EMS_150", "Alter: ");
define("EMS_151", "Geb. am: ");
define("EMS_152", " J.");
?>