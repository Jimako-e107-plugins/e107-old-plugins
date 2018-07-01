<?php
  /*
  +---------------------------------------------------------------+
  |
  |	e107 website system
  |	GUESTBOOK PLUGIN V4.0
  |
  |	Released under the terms and conditions of the
  |	GNU General Public License Version 2 (http://gnu.org).
  |
  ----------------------------------------------------------------+
  | original: ©Andrew Rockwell 2003
  |	      http://2sdw.com
  |           chavo@2sdw.com
  +---------------------------------------------------------------+
  | updates:  ©Richard Perry 2005
  |           http://www.greycube.com
  |           code@greycube.com
  +---------------------------------------------------------------+
  | updates:  ©Titanik 2007
  |          http://upc.utc.sk
  |           tomasss@inmail.sk
  +---------------------------------------------------------------+
  | updates:  ©Smarti October 2007
  |          http://www.platinwebservice.de
  |           webmaster@platinwebservice.de
  +---------------------------------------------------------------+
  |
  |	Erweitere LAN Definitionen von: Rainer Janz (Smarti)
  |	Sollten Fehler in der Übersetzung sein, bitte 
  |	im Forum auf www.platinwebservice.de oder per Mail an:
  |	webmaster@platinwebservice.de darauf hinweisen.
  |
  +---------------------------------------------------------------+
*/ 

define("GB_LAN_SIGN", "Ins Gästebuch eintragen");
define("GB_LAN_NOTICE",	"- HTML ist nicht erlaubt<br />- Email Adresse ist nicht öffentlich<br />- Sie haben 10 Minuten Zeit zum schreiben");
define("GB_LAN_NAME", "Name");
define("GB_LAN_EMAIL", "Email");
define("GB_LAN_WEBSITE", "Webseite");
define("GB_LAN_COMMENT", "Kommentar");
define("GB_LAN_EMOTES",	"Smilies");
define("GB_LAN_SUBMIT",	"Übermitteln");
define("GB_LAN_SECURE",	"Bitte den Text im Bild eingeben");
define("GB_LAN_WRONGCODE",	"Falscher Code eingegeben");
define("GB_LAN_UPDATED", "Eintrag aktualisiert");
define("GB_LAN_THANKYOU", "Vielen Dank für den Gästebucheintrag!");
define("GB_LAN_THANKYOUMOD", "Vielen Dank für den Gästebucheintrag!<br />Er wird von einem Admin überprüft und dann freigeschaltet.");

define("GB_LAN_REPEAT",	"Sie haben sich schon ins Gästebuch eingetragen");
define("GB_LAN_CONFIRM", "Bitte bestätigen");
define("GB_LAN_PERMISSION",	"Sie haben keine Rechte");
define("GB_LAN_NOHTML",	"Sorry, HTML ist nicht erlaubt");
define("GB_LAN_NOLINKS", "Sorry, Links sind im Kommentar nicht erlaubt");
define("GB_LAN_GOBACK",	"zurück");

define("GB_LAN_EDIT", "Bearbeiten");
define("GB_LAN_DELETE",	"Löschen");
define("GB_LAN_PROFILE", "Profil");
define("GB_LAN_ALLCOMMENT", "Gesamt Einträge:");


define("GB_LAN_DONE", "Plugin erfolgreich installiert - Bitte jetzt im Admin Menü konfigurieren");
define("GB_LAN_UPDONE", "Upgrade erfolgreich!");
define("GB_LAN_ADM_NAME", "Gästebuch");
define("GB_LAN_ADM_1", "Eintrag");
define("GB_LAN_ADM_2", "Name");
define("GB_LAN_ADM_3", "Status");
define("GB_LAN_ADM_4", "Option");
define("GB_LAN_ADM_5", "Freischalten");
define("GB_LAN_ADM_6", "Löschen");
define("GB_LAN_ADM_7", "Eintragsdatum");
define("GB_LAN_ADM_8", "IP/HOST ");
define("GB_LAN_ADM_9", "Sperren");
define("GB_LAN_ADM_10",	"Anzahl Eintragungen pro Seite");
define("GB_LAN_ADM_11",	"Gästebuch Titel");
define("GB_LAN_ADM_12",	"Tabelle mit Style umgeben");
define("GB_LAN_ADM_13",	"BBCode einschalten und in der Toolbar anzeigen");
define("GB_LAN_ADM_14",	"Wiederholungseinträge mit der gleichen IP blockieren");
define("GB_LAN_ADM_15",	"Links sind nicht erlaubt im Kommentar");
define("GB_LAN_ADM_16",	"Nur Mitgliedern die Webseiten anzeigen");
define("GB_LAN_ADM_17",	"Einstellungen aktualisieren");
define("GB_LAN_ADM_18",	"Einstellungen aktualisiert");
define("GB_LAN_ADM_19", "Sichere Bild Überprüfung");
define("GB_LAN_ADM_20",	"Gästebuch Einträge");
define("GB_LAN_ADM_21",	"Neue Gästebuch Einträge");
define("GB_LAN_ADM_22",	"Neue Einträge nur nach Admin Überprüfung freischalten");
define("GB_LAN_ADM_23", "Neuer Eintrag");
define("GB_LAN_ADM_24", "Freigeschaltet");
define("GB_LAN_ADM_25",	"Der Eintrag mit der ID ");
define("GB_LAN_ADM_26",	" wurde freigeschaltet.");
define("GB_LAN_ADM_27",	" wurde gelöscht.");
define("GB_LAN_ADM_28", "Es sind keine neuen Gästebucheinträge vorhanden.");
define("GB_LAN_ADM_29", "Moderator Klasse");
define("GB_LAN_ADM_30", "Zeit zum editieren (Minuten)");
define("GB_LAN_ADM_31", " wurde geblockt.");
define("GB_LAN_ADM_32", "Eintrag geblockt!");


define("GB_LAN_M_1", "Optionen");
define("GB_LAN_M_2", "Einstellungen");
define("GB_LAN_M_3", "Einträge ansehen");
define("GB_LAN_M_4", "Neue Einträge");
define("GB_LAN_M_5", "Geblockte Einträge");


define("GB_LAN_NT_1", "Gästebuch Ereignisse");
define("GB_LAN_NT_2", "Ein neuer Eintrag wurde geschrieben");
define("GB_LAN_NT_3", "Geschrieben von");
define("GB_LAN_NT_4", "IP Adresse des Absenders");
define("GB_LAN_NT_5", "Text der Nachricht");
define("GB_LAN_NT_6", "Gästebuch Nachricht gepostet");
define("GB_LAN_NT_7", "Hinweis: <span style='color:red'>Emailbenachrichtigung ist ausgeschaltet! <a href ='".e_ADMIN."notify.php'>Hier einschalten</a></span>");
define("GB_LAN_NT_8", "Hinweis: <span style='color:red'>Emailbenachrichtigung bei neuen Einträgen ist aktiviert.</span>");

?>