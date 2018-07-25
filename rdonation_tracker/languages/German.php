<?php
/*
+ ----------------------------------------------------------------------------+
|     ROOFDOG DONATION TRACKER v2.6
|     By roofdog78 & DelTree
|    
|     Original Donation Tracker plugin by Septor
|     Original Donate Menu plugin by Lolo Irie,Cameron,Barry Keal,Richard Perry
|     Plugin support at http://www.roofdog78.com
|     
|     For the e107 website system visit http://e107.org     
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
+----------------------------------------------------------------------------+
*/

//-----------------------------------------------------------------------------------------------------------+

define("LAN_TRACK_M_0", "Projekt unterstützen!");
define("LAN_TRACK_00", "Konfigurieren Roofdog Donation Tracker");             
define("LAN_TRACK_01", "PayPal-Einstellungen");                              
define("LAN_TRACK_02", "Konfiguration");                                     
define("LAN_TRACK_03", "Einstellungen gespeichert");                         
define("LAN_TRACK_04", "Einstellungen speichern");                                     
define("RD_TRACK_PROTECTION_01", "Um Spam zu vermeiden Erreichen der PayPal-Adresse"); 
define("RD_TRACK_PROTECTION_02", "Bitte beantworten Sie");                             
define("RD_TRACK_PROTECTION_03", "Senden");                                            
define("RD_TRACK_PROTECTION_04", "Bitte klicken Sie unten, um die Spende zu machen."); 
define("LAN_TRACK_05", "Ja");                                                
define("LAN_TRACK_06", "Nein");                                                
define("LAN_TRACK_07", "Main");                                              
define("LAN_TRACK_08", "Optional");                                          
define("LAN_TRACK_09", "Extra");                                             
define("LAN_TRACK_10", "Roofdog Donation Tracker erfolgreich installiert!"); 
define("LAN_TRACK_11", "Plugin ist jetzt aktualisiert!");                    
define("LAN_TRACK_12", "Update Spende Status");                              
define("LAN_TRACK_13", "ReadMe.txt");                                        
define("LAN_TRACK_14", "Roofdog Donation Tracker erfolgreich aktualisiert!");
define("LAN_TRACK_15", "Menü-Einstellungen");                                
define("LAN_TRACK_16", "Paypal Email");                                      
define("LAN_TRACK_17", "
[center][color=#ff9900][size=18][b]Wir brauchen Ihre Hilfe[/b][/size][/color][/center]

[center]Wir sind eine Non-Profit-Organisation vollständig von Ihnen unterstützt wird, die Mitglieder.
 Unsere Server ausgeführt werden und im Besitz von unseren Mitgliedern.
 Wir ermutigen alle Mitglieder auf unserem Server Fonds in keiner Weise, dass sie dazu beitragen können.
 Da wir nicht über unsere Server oder Bandbreite gespendet müssen wir unsere Rechnungen bezahlen jeden Monat, um die Dinge geht.
 Für diejenigen unter Ihnen, die können, bitten wir Sie, einen monetären Beitrag zu leisten, in welcher Konfession Sie möchten.
 Jedes kleine Bisschen zählt.[/center]

[center][color=#ff9900][size=14][b]Spenden Sie jetzt![/b][/size][/color][/center]
");
//-----------------------------------------------------------------------------------------------------------+

define("LAN_TRACK_CONFIG_01", "Menu Titel: ");                
define("LAN_TRACK_CONFIG_02", " Currency auf Menü-Anzeige: ");
define("LAN_TRACK_CONFIG_03", " Progress Bar Vollfarbe: ");   
define("LAN_TRACK_CONFIG_04", " Progress Bar leer Farbe: ");  
define("LAN_TRACK_CONFIG_05", " Progress Bar Rahmenfarbe: "); 
define("LAN_TRACK_CONFIG_06", " Progress bar Höhe: ");        
define("LAN_TRACK_CONFIG_07", " Ziel Spendenbetrag: ");       
define("LAN_TRACK_CONFIG_08", " Aktuelle Spendenbetrag: ");   
define("LAN_TRACK_CONFIG_09", " Fälligkeit: ");               
define("LAN_TRACK_CONFIG_10", "Diesen Monat Spender: ");                                                            
define("LAN_TRACK_CONFIG_11", " Der Titel Ihrer Spende Tracker-Menü.");                                            
define("LAN_TRACK_CONFIG_12", " Wählen Sie das Währungssymbol in die Menü-Anzeige.");                              
define("LAN_TRACK_CONFIG_13", " Die Farbe des vollen Fortschrittsbalken. Geben Sie den 6-stelligen Hex-Code.");    
define("LAN_TRACK_CONFIG_14", " Die Hintergrundfarbe der Fortschrittsbalken. Geben Sie den 6-stelligen Hex-Code.");
define("LAN_TRACK_CONFIG_15", " Die Farbe des Rahmens. Geben Sie den 6-stelligen Hex-Code.");                      
define("LAN_TRACK_CONFIG_16", " Die Höhe der Fortschrittsbalken. Geben Sie Ihren Wert in Pixeln. ");                
define("LAN_TRACK_CONFIG_17", " Geben Sie Ihre Ziel-Spendenbetrag. Deaktivieren Sie die Option zu deaktivieren. "); 
define("LAN_TRACK_CONFIG_18", " Höhe der eingegangenen Spenden so weit. Deaktivieren Sie die Option zu deaktivieren. ");
define("LAN_TRACK_CONFIG_19", "Das Datum, an dem Sie Ihre Zielgruppe Spende erhalten, deaktivieren zu deaktivieren. <br> Wenn nicht die Fälligkeit es der letzte Tag des laufenden Monats werden definiert.");
define("LAN_TRACK_CONFIG_20", "Text zu zeigen, für Ihre Besucher Brüllen der Grafik bar, sollte formatiert XHTML wie <br /> für neue Linien.");
define("LAN_TRACK_CONFIG_21", "Display Bar ");                                                                                  
define("LAN_TRACK_CONFIG_22", "Deaktivieren Sie auf Fortschrittsbalken deaktivieren. ");                                        
define("LAN_TRACK_CONFIG_23", "Display Total Fund Box ");                                                                       
define("LAN_TRACK_CONFIG_24", "Deaktivieren Sie die Option zu deaktivieren gesamten Fonds-Box.");                              
define("LAN_TRACK_CONFIG_25", "Total Stiftungsfonds Amount: ");                                                                 
define("LAN_TRACK_CONFIG_26", "Geben Sie den Gesamtbetrag der Spenden erhalten ");                                              
define("LAN_TRACK_CONFIG_27", "Verbrauchte / Allocated: ");                                                                     
define("LAN_TRACK_CONFIG_28", "Geben Sie den Gesamtbetrag der Mittel, die bereitgestellt wurden oder verbracht. ");             
define("LAN_TRACK_CONFIG_29", "Erste Bilanz: ");                                                                                
define("LAN_TRACK_CONFIG_30", "Geben Sie einfach Ihre erste Bilanz betragen. Deaktivieren Sie die Option zu deaktivieren. ");   
define("LAN_TRACK_CONFIG_31", "Show-Taste Bilanz der Klasse: ");                                                                
define("LAN_TRACK_CONFIG_32", "Definieren Sie die Benutzer-Klasse, die erlaubt, das finanzielle Gleichgewicht  zu sehen ist."); 
define("LAN_TRACK_CONFIG_33", "Menu Text ");                                                                                    
define("LAN_TRACK_CONFIG_34", "Format ");                                                                                       
define("LAN_TRACK_CONFIG_35", "Display Spender-Liste ");                                                                        
define("LAN_TRACK_CONFIG_36", "Deaktivieren Sie die Option nicht angezeigt die Spenden-Liste.");                               
define("LAN_TRACK_CONFIG_37", "Beschreibung: ");                                                                                
//-----------------------------------------------------------------------------------------------------------+

define("LAN_TRACK_PAL_01",  "Button Text: ");                                                                     
define("LAN_TRACK_PAL_02",  "Text oben-Taste Bild, sollte formatiert XHTML wie <br /> für neue Linien werden."); 
define("LAN_TRACK_PAL_03",  "Button Image: ");                                                                    
define("LAN_TRACK_PAL_04",  "Wählen Sie ein Bild oder laden Sie selbst in '/ rdonation_tracker / images /'");     
define("LAN_TRACK_PAL_05",  "Wählen Sie ");                                                                       
define("LAN_TRACK_PAL_06",  "Button Popup: ");                                                                    
define("LAN_TRACK_PAL_07",  "Erscheint, wenn der Mauszeiger über den Button.");                                  
define("LAN_TRACK_PAL_08",  "Make a Donation mit PayPal ");                                                       
define("LAN_TRACK_PAL_09",  "PayPal E-Mail oder PayPal Business ID: ");                                           
define("LAN_TRACK_PAL_10",  "Es muss eine gültige PayPal-Konto sein. ");                                          
define("LAN_TRACK_PAL_11",  "Donation Beschreibung: ");                                                           
define("LAN_TRACK_PAL_12",  "Wenn leer, wird der Spender sehen ein Feld, das sie in sich selbst füllen kann. ");  
define("LAN_TRACK_PAL_13",  "Währung: ");                                                                         
define("LAN_TRACK_PAL_14",  "Legt die Währung, die den Betrag eingezahlt werden soll ");                          
define("LAN_TRACK_PAL_15",  "Spam-Schutz: ");                                                                     
define("LAN_TRACK_PAL_16",  "Verhindert Spambots von der Ernte der PayPal E-Mail-Adresse.");                     

//-----------------------------------------------------------------------------------------------------------+

define("LAN_TRACK_PAL_17",  "Fordern Sie eine Postanschrift: ");                               
define("LAN_TRACK_PAL_18",  "Fordert die Spender eine Postanschrift erfassen.");         
define("LAN_TRACK_PAL_19",  "Fordern Sie eine Anmerkung: ");                                  
define("LAN_TRACK_PAL_20",  "Fordert die Geber auf eine kurze Notiz mit der Zahlung geben. ");
define("LAN_TRACK_PAL_21",  "Custom Hinweis Bildunterschrift: ");                             
define("LAN_TRACK_PAL_22",  "Text, der über der Note dargestellt. ");                         
define("LAN_TRACK_PAL_23",  "Erfolgreiche Zahlung URL ");                                     
define("LAN_TRACK_PAL_24",  "Link Spender werden hier nach Abschluss ihrer Zahlung weitergeleitet. Zur Nutzung Standardseite kopieren Sie diesen Link: <br /> www.yoursite.com/e107_plugins/rdonation_tracker/thank_you.php");
define("LAN_TRACK_PAL_25",  "Abbrechen Zahlung URL");
define("LAN_TRACK_PAL_26",  "Link Spender werden hier weitergeleitet werden, wenn sie auf Abbrechen klicken. Zur Nutzung Standardseite kopieren Sie diesen Link: <br /> www.yoursite.com/e107_plugins/rdonation_tracker/cancel_return.php");
define("LAN_TRACK_PAL_27",  "Page Style Name:");
define("LAN_TRACK_PAL_28",  "Melden Sie sich bei PayPal, um Stile zu schaffen. Ihr Konto, Profil, Benutzerdefinierte Zahlungsseiten.");
define("LAN_TRACK_PAL_41",  "IPN - Instant Payment Notification:");
define("LAN_TRACK_PAL_42",  "Überprüfen Sie die Zahlungen und speichern Sie es auf Ihrer Website Datenbank. So verwenden standardmäßig Routine kopieren Sie diesen Link: <br /> www.yoursite.com/e107_plugins/rdonation_tracker/ipn_validate.php");

//-----------------------------------------------------------------------------------------------------------+

define("LAN_TRACK_PAL_29",  "Orte: ");                                                                          
define("LAN_TRACK_PAL_30",  "Defaults auf US-Englisch, mit einem zweistelligen 'ISO 3166-1 Code' zu ändern.");    
define("LAN_TRACK_PAL_31",  "Item Number: ");                                                                     
define("LAN_TRACK_PAL_32",  "Wenn eingestellt ist unter dem Item-Namen angezeigt. ");                             
define("LAN_TRACK_PAL_33",  "Eigenes: ");                                                                          
define("LAN_TRACK_PAL_34",  "Nicht zu Spender gezeigt, ging zurück zur Verfolgung payments.");                   
define("LAN_TRACK_PAL_35",  "Rechnung: ");                                                                        
define("LAN_TRACK_PAL_36",  "Nicht zu Spender gezeigt, ging zurück zur Verfolgung payments.");                   
define("LAN_TRACK_PAL_37",  "Amount: ");                                                                          
define("LAN_TRACK_PAL_38",  "Fixes Zahlung Wert erlaubt leere Spender, um die Menge gesetzt. ");                  
define("LAN_TRACK_PAL_39",  "Steuern: ");                                                                         
define("LAN_TRACK_PAL_40",  "Überschreiben Sie alle Steuer-Einstellungen, die Teil einer Spender-Profil sind. "); 

//-----------------------------------------------------------------------------------------------------------+
define("LAN_TRACK_F_0", "Cash Mananger");
define("LAN_TRACK_F_1", " REGISTER #");
define("LAN_TRACK_F_2", "Datum:");
define("LAN_TRACK_F_3", "Type:");
define("LAN_TRACK_F_4", "Kredit");
define("LAN_TRACK_F_5", "Soll");
define("LAN_TRACK_F_6", "Transaktion ID:");
define("LAN_TRACK_F_7", "Wert:");
define("LAN_TRACK_F_8", "Gebühr:");
define("LAN_TRACK_F_9", "Status:");
define("LAN_TRACK_F_10", "fertiggestellt");
define("LAN_TRACK_F_11", "Pending");
define("LAN_TRACK_F_12", "Denied");
define("LAN_TRACK_F_13", "User/Hist:");
define("LAN_TRACK_F_14", "Comment/Group:");
define("LAN_TRACK_F_15", "1.ändern");
define("LAN_TRACK_F_16", "zurück");
define("LAN_TRACK_F_17", "umfassen");
define("LAN_TRACK_F_18", "Abbruch");
define("LAN_TRACK_F_19", "Bilanz");
define("LAN_TRACK_F_20", "Zeitraum zwischen");
define("LAN_TRACK_F_21", "NEUER REKORD");
define("LAN_TRACK_F_22", "VERLAUF");
define("LAN_TRACK_F_23", "ID");
define("LAN_TRACK_F_24", "DATUM");
define("LAN_TRACK_F_25", "BESCHREIBUNG/NOTIZ");
define("LAN_TRACK_F_26", "ID/KOMMENTARE");
define("LAN_TRACK_F_27", "STATUS");
define("LAN_TRACK_F_28", "TYP");
define("LAN_TRACK_F_29", "MENGE");
define("LAN_TRACK_F_30", "GEBÜHR");
define("LAN_TRACK_F_31", "BILANZ");
define("LAN_TRACK_F_32", " OPT");
define("LAN_TRACK_F_33", "ANFANGS- BILANZ");
define("LAN_TRACK_F_34", "CRED");
define("LAN_TRACK_F_35", "DEBT");
define("LAN_TRACK_F_36", "Bitte bestätigen Sie, dass Sie es löschen möchten");
define("LAN_TRACK_F_37", "Bearbeiten");
define("LAN_TRACK_F_38", "Löschen");
define("LAN_TRACK_F_39", "### Keine Einträge für diesen Zeitraum ###");
define("LAN_TRACK_F_40", "GESAMMT");
define("LAN_TRACK_F_41", "Notiz:");
define("LAN_TRACK_F_42", "FINANZIELLE BILANZ");
define("LAN_TRACK_F_43", "Abgebrochen");
define("LAN_TRACK_F_44", "Zurückgezahlt");
define("LAN_TRACK_F_45", "abgelaufen");
define("LAN_TRACK_F_46", "Failed");
define("LAN_TRACK_F_47", "Erstellt");
define("LAN_TRACK_F_48", "umgekehrt");
define("LAN_TRACK_F_49", "Verarbeitete");
define("LAN_TRACK_F_50", "Voided");

//-----------------------------------------------------------------------------------------------------------+
define("LAN_TRACK_M_1", "NEU");
define("LAN_TRACK_M_2", "BEARBEITEN");
define("LAN_TRACK_M_3", "KEIN ZUGRIFF!!!");
define("LAN_TRACK_M_4", "Sie sind keine Berechtigung diese Seite zu sehen!");
define("LAN_TRACK_M1", "Erfolgreich erstellt");
define("LAN_TRACK_M2", "Erstellung failed");
define("LAN_TRACK_M3", "Erfolgreich fehlgeschlagen");
define("LAN_TRACK_M4", "Aktualisierung fehlgeschlagen");
define("LAN_TRACK_M5", "Erfolgreich gelöscht");
define("LAN_TRACK_M6", "löschen fehlgeschlagen");
define("LAN_TRACK_M7", "ungültig");
define("LAN_TRACK_M8", "E-mail");
//-----------------------------------------------------------------------------------------------------------+

define("LAN_TRACK_MENU_01",  "erhalten!");
define("LAN_TRACK_MENU_02",  "bis jetz erhalten:");
define("LAN_TRACK_MENU_03",  "verbleibende:");
define("LAN_TRACK_MENU_04",  "Ziel:");
define("LAN_TRACK_MENU_05",  "Bis Datum:");
define("LAN_TRACK_MENU_06",  "Spender dieses Monat:");
define("LAN_TRACK_MENU_07",  "Admin konfigurieren");
define("LAN_TRACK_MENU_08",  "gesamt:");
define("LAN_TRACK_MENU_09",  "Spent/Allocated:");

//------------------------------------------------------------------------------------------------------------+

define("LAN_TRACK_ADMENU_01",  "Donation status");
define("LAN_TRACK_ADMENU_02",  "Menu settings");
define("LAN_TRACK_ADMENU_03",  "PayPal settings");
define("LAN_TRACK_ADMENU_04",  "Cash Manager");
define("LAN_TRACK_ADMENU_05",  "Readme.txt");

//------------------------------------------------------------------------------------------------------------+

define("LAN_TRACK_THANKS_01", "Danke!");
define("LAN_TRACK_THANKS_02", "
<br /><br /><br /><br /><br /><br /><font face='Verdana' size='2'><br /><br /><br />
<b>Vielen Dank für Ihre Spende!</b>
<br /><br /><br /><br /><br /><br /><br />
Bitte überprüfen Sie Ihre E-Mail-Box auf <br />
Bestätigung von PayPal.<br />
<br />
Nochmals vielen Dank!
<br><center>
<a href='../../index.php'>Zurück zur Startseite</a>
</font></center>");

//-------------------------------------------------------------------------------------------------------------+

define("LAN_TRACK_CANCELLED_01", "Abgebrochene Zahlung");
define("LAN_TRACK_CANCELLED_02", "Sie haben Ihre Transaktion abgebrochen. Bitte beachten Sie, eine Spende in die Zukunft oder versuchen Sie es erneut jetzt.<br /><br /><a href='".e_BASE."index.php'>Zurück zur Startseite</a>");
define("LAN_PAL_BUTTON_POPUP_DEFAULT", "Klicken Sie hier, um mit PayPal zu spenden");

//-------------------------------------------------------------------------------------------------------------+
define("DAY_LAN_MONTHS",",Jan,Feb,Mär,Apr,Mai,Jun,Jul,Aug,Sep,Okt,Nov,Dez");
define("DAY_LAN_MONTHL",",Januar,Februar,Mäzt,April,Mai,Juni,Juli,August,September,Oktober,November,Dezember");
define("DAY_LAN_MONTHSUFFIX",",st,nd,rd,th,th,th,th,th,th,th,th,th,th,th,th,th,th,th,th,th,st,nd,rd,th,th,th,th,th,th,th,st");


?>