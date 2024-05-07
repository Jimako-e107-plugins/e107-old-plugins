<?php
// ------------------------------------------------------------------------- //
//  Coppermine Photo Gallery v1.1 Devel                                      //
// ------------------------------------------------------------------------- //
//  Copyright (C) 2002  Gregory DEMAR <gdemar@wanadoo.fr>                    //
//  http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
//  Based on PHPhotoalbum by Henning Støverud <henning@stoverud.com>         //
//  http://www.stoverud.com/PHPhotoalbum/                                    //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
// ------------------------------------------------------------------------- //
//  Hacked by Tarique Sani <tarique@sanisoft.com> and Girsh Nair             //
//  <girish@sanisoft.com> see http://www.sanisoft.com/cpg/README.txt for     //
//  details                                                                  //
// ------------------------------------------------------------------------- //

// info about translators and translated language
$lang_translation_info = array(
'lang_name_english' => 'German',  //the name of your language in English, e.g. 'Greek' or 'Spanish'
'lang_name_native' => 'Deutsch', //the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol'
'lang_country_code' => 'de', //the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
'trans_name'=> 'GauGau', //the name of the translator - can be a nickname
'trans_email' => 'mail@gaugau.de', //translator's email address (optional)
'trans_website' => 'http://gaugau.de/', //translator's website (optional)
'trans_date' => '2003-10-07', //the date the translation was created / last modified
);

$lang_charset = 'iso-8859-1';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'kB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa');
$lang_month = array('Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember');

// Some common strings
$lang_yes = 'Ja';
$lang_no  = 'Nein';
$lang_back = 'zurück';
$lang_continue = 'weiter';
$lang_info = 'Information';
$lang_error = 'Fehler';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%d.%B %Y';
$lastcom_date_fmt =  '%d.%m.%y um %H:%M';
$lastup_date_fmt = '%d.%B %Y';
$register_date_fmt = '%d.%B %Y';
$lasthit_date_fmt = '%d.%B %Y um %H:%M';
$comment_date_fmt =  '%d.%B %Y um %H:%M';

// For the word censor
$lang_bad_words = array('*fuck*', '*fick*', '*arsch*', 'hure*', 'nutte', 'fotze', 'möse', 'scheiss*', 'scheiß*', 'motherfucker','nigger*', 'pussy', 'shit', 'slut', 'titties', 'titty');

$lang_meta_album_names = array(
        'random' => 'Zufalls-Bilder',
        'lastup' => 'neueste Bilder',
        'lastalb'=> 'Zuletzt aktualisierte Alben',
        'lastcom' => 'neueste Kommentare',
        'topn' => 'am meisten angesehen',
        'toprated' => 'am besten bewertet',
        'lasthits' => 'zuletzt angesehen',
        'search' => 'Suchergebnisse',
        'favpics'=> 'Favourite Pictures' //new in cpg1.2.0
);

$lang_errors = array(
        'access_denied' => 'Du hast kein Recht, diese Seite anzusehen.',
        'perm_denied' => 'Du hast nicht das Recht, diese Operation auszuführen.',
        'param_missing' => 'Das Skript wurde ohne den/die erfordlichen Parameter aufgerufen.',
        'non_exist_ap' => 'Das gewählte Album bzw. Bild existiert nicht!',
        'quota_exceeded' => 'Speicherplatz erschöpft<br /><br />Du hast ein Speicherlimit von [quota]K, Deine Bilder belegen zu Zeit [space] kB, das Hinzufügen dieses Bildes würde Deinen Speicherplatz überschreiten.',
        'gd_file_type_err' => 'Bei Verwendung der GD-Bibliothek sind nur die Dateitypen JPG und PNG erlaubt.',
        'invalid_image' => 'Das Bild, das Du hochgeladen hast ist beschädigt oder kann nicht von der GD-Bibliothek verarbeitet werden',
        'resize_failed' => 'Kann Thumbnail nicht erzeugen.',
        'no_img_to_display' => 'Kein Bild zum Anzeigen vorhanden (oder Du hast keine Berechtigung, das Album zu sehen)',
        'non_exist_cat' => 'Die gewählte Kategorie existiert nicht',
        'orphan_cat' => 'Eine Kategorie besitzt ein nicht-existierendes Eltern-Element, benutze den Kategorie-Manager um das Problem zu beheben.',
        'directory_ro' => 'Das Verzeichnis \'%s\' ist nicht beschreibbar, die Bilder können nicht gelöscht werden',
        'non_exist_comment' => 'Der gewählte Kommentar existiert nicht.',
        'pic_in_invalid_album' => 'Das Bild befindet sich in einem nicht-existierenden Album (%s)!?',
        'banned' => 'Du bist zur Zeit von dieser Seite verbannt.',  //new in cpg1.2.0
        'not_with_udb' => 'Diese Funktion ist innerhalb Coppermine deaktiviert, weil Sie in die Forums-Software integriert ist. Entweder wird das, was Du gerade zu tun versucht hast in dieser Konfiguration nicht unterstützt oder die Funktion sollte von der Forums-Software übernommen werden.',  //new in cpg1.2.0
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
        'alb_list_title' => 'Gehe zur Alben-Übersicht',
        'alb_list_lnk' => 'Alben-Übersicht',
        'my_gal_title' => 'zu meiner persönlichen Galerie',
        'my_gal_lnk' => 'meine Galerie',
        'my_prof_lnk' => 'mein Profil',
        'adm_mode_title' => 'in Admin-Modus schalten',
        'adm_mode_lnk' => 'Admin-Modus',
        'usr_mode_title' => 'in Benutzer-Modus schalten',
        'usr_mode_lnk' => 'Benutzer-Modus',
        'upload_pic_title' => 'Bild in ein Album hochladen',
        'upload_pic_lnk' => 'Bild hochladen',
        'register_title' => 'Konto erzeugen',
        'register_lnk' => 'Registrieren',
        'login_lnk' => 'anmelden',
        'logout_lnk' => 'abmelden',
        'lastup_lnk' => 'neueste Uploads',
        'lastcom_lnk' => 'neueste Kommentare',
        'topn_lnk' => 'am meisten angesehen',
        'toprated_lnk' => 'am besten bewertet',
        'search_lnk' => 'Suche',
        'fav_lnk' => 'Meine Favoriten', //new in cpg1.2.0
        );

$lang_gallery_admin_menu = array(
        'upl_app_lnk' => 'Upload-Bestätigung',
        'config_lnk' => 'Einstellungen',
        'albums_lnk' => 'Alben',
        'categories_lnk' => 'Kategorien',
        'users_lnk' => 'Benutzer',
        'groups_lnk' => 'Gruppen',
        'comments_lnk' => 'Kommentare',
        'searchnew_lnk' => 'Batch-hinzufügen',
        'util_lnk' => 'Grösse ändern', //new in cpg1.2.0
        'ban_lnk' => 'Benutzer verbannen', //new in cpg1.2.0
);

$lang_user_admin_menu = array(
        'albmgr_lnk' => 'Alben erzeugen / anordnen',
        'modifyalb_lnk' => 'Meine Alben bearbeiten',
        'my_prof_lnk' => 'Mein Profil',
);

$lang_cat_list = array(
        'category' => 'Kategorie',
        'albums' => 'Alben',
        'pictures' => 'Bilder',
);

$lang_album_list = array(
        'album_on_page' => '%d Alben auf %d Seite(n)'
);

$lang_thumb_view = array(
        'date' => 'Datum',
        //Sort by filename and title
        'name' => 'Dateiname',
        'title' => 'Titel',
        'sort_da' => 'aufsteigend nach Datum sortieren',
        'sort_dd' => 'absteigend nach Datum sortieren',
        'sort_na' => 'aufsteigend nach Name sortieren',
        'sort_nd' => 'absteigend nach Name sortieren',
        'sort_ta' => 'aufsteigend nach Titel sortieren',
        'sort_td' => 'absteigend nach Titel sortieren',
        'pic_on_page' => '%d Bilder auf %d Seite(n)',
        'user_on_page' => '%d Benutzer auf %d Seite(n)'
);

$lang_img_nav_bar = array(
        'thumb_title' => 'zurück zur Thumbnail-Seite',
        'pic_info_title' => 'Bildinformationen anzeigen/verbergen',
        'slideshow_title' => 'Diashow',
        'ecard_title' => 'Bild als eCard versenden',
        'ecard_disabled' => 'eCards sind deaktiviert',
        'ecard_disabled_msg' => 'Du hast nicht das Recht, eCards zu versenden',
        'prev_title' => 'vorheriges Bild anzeigen',
        'next_title' => 'nächstes Bild anzeigen',
        'pic_pos' => 'Bild %s/%s',
);

$lang_rate_pic = array(
        'rate_this_pic' => 'Dieses Bild bewerten ',
        'no_votes' => '(noch keine Bewertung)',
        'rating' => '- derzeitige Bewertung : %s/5 mit %s Stimme(n)',
        'rubbish' => 'sehr schlecht',
        'poor' => 'schlecht',
        'fair' => 'ganz OK',
        'good' => 'gut',
        'excellent' => 'sehr gut',
        'great' => 'super',
);

// ------------------------------------------------------------------------- //
// File include/exif.inc.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File include/functions.inc.php
// ------------------------------------------------------------------------- //

$lang_cpg_die = array(
        INFORMATION => $lang_info,
        ERROR => $lang_error,
        CRITICAL_ERROR => 'Kritischer Fehler',
        'file' => 'Datei: ',
        'line' => 'Zeile: ',
);

$lang_display_thumbnails = array(
        'filename' => 'Dateiname : ',
        'filesize' => 'Dateigrösse : ',
        'dimensions' => 'Abmessungen : ',
        'date_added' => 'hinzugefügt am : '
);

$lang_get_pic_data = array(
        'n_comments' => '%s Kommentar(e)',
        'n_views' => '%s x angesehen',
        'n_votes' => '(%s Bewertungen)'
);

// ------------------------------------------------------------------------- //
// File include/init.inc.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File include/picmgmt.inc.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File include/smilies.inc.php
// ------------------------------------------------------------------------- //

if (defined('SMILIES_PHP')) $lang_smilies_inc_php = array(
        'Exclamation' => 'Ausruf',
        'Question' => 'Frage',
        'Very Happy' => 'sehr glücklich',
        'Smile' => 'lachen',
        'Sad' => 'traurig',
        'Surprised' => 'überrascht',
        'Shocked' => 'schockiert',
        'Confused' => 'verwirrt',
        'Cool' => 'cool',
        'Laughing' => 'lachend',
        'Mad' => 'wütend',
        'Razz' => 'scheu',
        'Embarassed' => 'schüchtern',
        'Crying or Very sad' => 'traurig',
        'Evil or Very Mad' => 'böse',
        'Twisted Evil' => 'verschlagen',
        'Rolling Eyes' => 'na ja',
        'Wink' => 'zwinker',
        'Idea' => 'Idee',
        'Arrow' => 'Pfeil',
        'Neutral' => 'neutral',
        'Mr. Green' => 'Mr. Green',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
        0 => 'Beende Admin-Modus...',
        1 => 'Starte Admin-Modus...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
        'alb_need_name' => 'Alben müssen einen Namen haben!',
        'confirm_modifs' => 'Bist Du sicher, dass Du diese Änderungen durchführen willst?',
        'no_change' => 'Du hast nichts verändert!',
        'new_album' => 'neues Album',
        'confirm_delete1' => 'Willst Du dieses Album wirklich löschen?',
        'confirm_delete2' => '\nAlle Bilder und Kommentare, die darin enthalten sind werden gelöscht!',
        'select_first' => 'Wähle zuerst ein Album',
        'alb_mrg' => 'Alben-Manager',
        'my_gallery' => '* meine Galerie *',
        'no_category' => '* keine Kategorie *',
        'delete' => 'löschen',
        'new' => 'neu',
        'apply_modifs' => 'Änderungen übernehmen',
        'select_category' => 'wähle Kategorie',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
        'miss_param' => 'Fehlender Parameter für die Operation \'%s\' !',
        'unknown_cat' => 'Gewählte Kategorie existiert nicht in Datenbank',
        'usergal_cat_ro' => 'Benutzer-Galerie kann nicht gelöscht werden!',
        'manage_cat' => 'Kategorien verwalten',
        'confirm_delete' => 'Willst Du diese Kategorie wirklich LÖSCHEN',
        'category' => 'Kategorie',
        'operations' => 'Operationen',
        'move_into' => 'verschieben in',
        'update_create' => 'Kategorie erzeugen/ändern',
        'parent_cat' => 'Eltern-Kategorie',
        'cat_title' => 'Titel der Kategorie',
        'cat_desc' => 'Beschreibung Kategorie',
        'no_category' => 'keine Kategorie'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
        'title' => 'Einstellungen',
        'restore_cfg' => 'auf Werkseinstellungen zurücksetzen',
        'save_cfg' => 'neue Einstellungen speichern',
        'notes' => 'Anmerkungen',
        'info' => 'Information',
        'upd_success' => 'Die Einstellungen von Coppermine wurden aktualisiert',
        'restore_success' => 'Coppermine Standard-Einstellungen wieder hergestellt',
        'name_a' => 'aufsteigend nach Name',
        'name_d' => 'absteigend nach Name',
        'title_a' => 'aufsteigend nach Titel',
        'title_d' => 'absteigend nach Titel',
        'date_a' => 'aufsteigend nach Datum',
        'date_d' => 'absteigend nach Datum',
        'th_any' => 'Maximalwert (entweder Höhe oder Breite)',
        'th_ht' => 'Höhe',
        'th_wd' => 'Breite',
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
        'Allgemeine Einstellungen',
        array('Galerie-Name', 'gallery_name', 0),
        array('Galerie Beschreibung', 'gallery_description', 0),
        array('Galerie-Admin E-Mail', 'gallery_admin_email', 0),
        array('Ziel-Adresse für den  \'mehr Bilder ansehen\' Link in e-cards', 'ecards_more_pic_target', 0),
        array('Sprache', 'lang', 5),
        //array('Sprachauswahl aktivieren', 'lang_select_enable', 8),
        array('Design', 'theme', 6),
        //array('Theme-Auswahl durch Benutzer aktivieren', 'theme_select_enable', 8),

        'Ansicht Albumliste',
        array('Breite der Haupttabelle (in Pixel oder %)', 'main_table_width', 0),
        array('Anzahl anzuzeigende Kategorie-Ebenen', 'subcat_level', 0),
        array('Anzahl anzuzeigende Alben', 'albums_per_page', 0),
        array('Anzahl Spalten in Album-Liste', 'album_list_cols', 0),
        array('Thumbnail-Grösse in Pixel', 'alb_list_thumb_size', 0),
        array('Inhalt der Hauptseite', 'main_page_layout', 0),
        array('Erste Ebene der Thumbnails der Alben auch in Kategorien anzeigen','first_level',1), //new in cpg1.2.0

        'Ansicht Thumbnail',
        array('Spaltenzahl auf Thumbnail-Seite', 'thumbcols', 0),
        array('Zeilenzahl auf Thumbnail-Seite', 'thumbrows', 0),
        array('Anzahl maximal anzuzeigende Tabs', 'max_tabs', 0),
        array('Bild-Beschriftung anzeigen (zusätzlich zum Bild-Titel) unterhalb der Thumbnails', 'caption_in_thumbview', 1),
        array('Anzahl der Kommentare unterhalb dem Thumbnail anzeigen', 'display_comment_count', 1),
        array('Standard-Sortierung für Bilder', 'default_sort_order', 3),
        array('Mindestmenge Stimmen, die ein Bild benötigt, um in der \'am besten bewertet\' Liste zu erscheinen', 'min_votes_for_rating', 0),

        'Ansicht Bild &amp; Einstellungen Kommentare',
        array('Tabellenbreite für Bildanzeige (in Pixel oder %)', 'picture_table_width', 0),
        array('Bildinformationen sind standardmäßig sichtbar', 'display_pic_info', 1),
        array('Schimpfwörter in Kommentaren zensieren', 'filter_bad_words', 1),
        array('Smilies in Kommentaren erlauben', 'enable_smilies', 1),
        array('Maximallänge für Bildbeschreibung', 'max_img_desc_length', 0),
        array('Maximale Anzahl von Buchstaben in einem Wort', 'max_com_wlength', 0),
        array('Maximale Zeilenzahl eines Kommentars', 'max_com_lines', 0),
        array('Maximale Länge eines Kommentars', 'max_com_size', 0),
        array('Film-Streifen anzeigen', 'display_film_strip', 1),
        array('Anzahl Elemente in Film-Streifen', 'max_film_strip_items', 0),

        'Bild- und Thumbnail-Einstellungen',
        array('Qualität für JPEG-Dateien', 'jpeg_qual', 0),
        array('Welche Dimension soll genutzt werden für Thumbnails ( Breite oder Höhe oder das, was jeweils grösser ist)<b>*</b>', 'thumb_use', 7),    //new in cpg1.2.0
        array('Maximale Höhe oder Breite von Thumbnails <b>*</b>', 'thumb_width', 0),
        array('Bilder in Zwischengröße erzeugen','make_intermediate',1),
        array('Maximale Breite oder Höhe von Bildern in Zwischengröße <b>*</b>', 'picture_width', 0),
        array('Maximalgröße für das Hochladen von Bildern (KB)', 'max_upl_size', 0),
        array('Maximale Breite oder Höhe für das Hochladen von Bildern (in Pixel)', 'max_upl_width_height', 0),

        'Benutzer-Einstellungen',
        array('Registrierung von Benutzern zulassen', 'allow_user_registration', 1),
        array('Registrierung von Benutzern erfordert Überprüfung per E-Mail', 'reg_requires_valid_email', 1),
        array('Zulassen, daß mehrere Benutzer die gleiche E-Mail Adresse haben', 'allow_duplicate_emails_addr', 1),
        array('Benutzer dürfen Privatalbum anlegen', 'allow_private_albums', 1),

        'Benutzerdefinierte Felder für zusätzliche Bildinformationen (leer lassen, falls nicht benötigt)',
        array('Name Feld 1', 'user_field1_name', 0),
        array('Name Feld 2', 'user_field2_name', 0),
        array('Name Feld 3', 'user_field3_name', 0),
        array('Name Feld 4', 'user_field4_name', 0),

        'Erweiterte Bild- und Thumbnail-Einstellungen',
        array('Icons für Persönliche Alben nicht eingeloggten Benutzern anzeigen?','show_private',1),
        array('Nicht erlaubte Zeichen in Dateinamen', 'forbiden_fname_char',0),
        array('erlaubte Datei-Erweiterungen für das Hochladen von Bildern', 'allowed_file_extensions',0),
        array('Methode zur Größenänderung von Bildern','thumb_method',2),
        array('Pfad zur \'convert\' Anwendung von ImageMagick (z.B. /usr/bin/X11/)', 'impath', 0),
        array('Erlaubte Datei-Typen (nur gültig für ImageMagick)', 'allowed_img_types',0),
        array('Kommandozeilen-Parameter für ImageMagick', 'im_options', 0),
        array('EXIF-Daten in JPEG-Dateien lesen', 'read_exif_data', 1),
        array('Alben-Verzeichnis <b>*</b>', 'fullpath', 0),
        array('Verzeichnis für Benutzer-Bilder <b>*</b>', 'userpics', 0),
        array('Vorsilbe für Bilder in Zwischengröße <b>*</b>', 'normal_pfx', 0),
        array('Vorsilbe für Thumbnails <b>*</b>', 'thumb_pfx', 0),
        array('Standard-Modus für Verzeichnisse', 'default_dir_mode', 0),
        array('Standard-Modus für Bilder', 'default_file_mode', 0),

        'Cookies &amp; Zeichensatz-Einstellungen',
        array('Cookie-Name, der vom Skript verwendet wird', 'cookie_name', 0),
        array('Cookie-Pfad', 'cookie_path', 0),
        array('Zeichensatz', 'charset', 4),

        'Verschiedene Einstellungen',
        array('Debug-Modus ein', 'debug_mode', 1),

        '<br /><div align="center">(*) Felder, die mit * gekennzeichnet sind dürfen nicht geändert werden, wenn sich schon Bilder in der Galerie befinden!</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
        'empty_name_or_com' => 'Du musst Deinen Namen und einen Kommentar eingeben',
        'com_added' => 'Dein Kommentar wurde hinzugefügt',
        'alb_need_title' => 'Du musst einen Titel für das Album eingeben!',
        'no_udp_needed' => 'Keine Aktualisierung notwendig.',
        'alb_updated' => 'Das Album wurde aktualisiert',
        'unknown_album' => 'Das gewählte Album existiert nicht oder Du hast keine Berechtigung, Bilder in dieses Album hochzuladen',
        'no_pic_uploaded' => 'Es wurde kein Bild hochgeladen!<br /><br />Wenn Du tatsächlich ein Bild zum Hochladen selektiert hast, überprüfe ob Dein Server das Hochladen von Dateien zulässt...',
        'err_mkdir' => 'Verzeichnis %s konnte nicht angelegt werden!',
        'dest_dir_ro' => 'In das Zielverzeichnis %s kann vom Skript nicht geschrieben werden!',
        'err_move' => '%s kann nicht nach %s verschoben werden!',
        'err_fsize_too_large' => 'Die Datei, die Du hochgeladen hast ist zu groß (maximal zulässig ist %s x %s) !',
        'err_imgsize_too_large' => 'Die Datei, die Du hochgeladen hast ist zu groß (maximal zulässig ist %s KB) !',
        'err_invalid_img' => 'Die Datei, die Du hochgeladen hast ist kein gültiger Bildtyp!',
        'allowed_img_types' => 'Du kannst nur %s Bilder hochladen.',
        'err_insert_pic' => 'Das Bild \'%s\' kann nicht in das Album eingefügt werden',
        'upload_success' => 'Dein Bild wurde erfolgreich hochgeladen.<br /><br />Es wird nach der Bestätigung durch den Admin sichtbar sein.',
        'info' => 'Information',
        'com_added' => 'Kommentar hinzugefügt',
        'alb_updated' => 'Album aktualisiert',
        'err_comment_empty' => 'Dein Kommentar enthält keine Zeichen!',
        'err_invalid_fext' => 'Nur Dateien mit den folgenden Erweiterungen sind zulässig: <br /><br />%s.',
        'no_flood' => 'Leider bist Du schon der Autor des letzten Kommentars zu diesem Bild<br /><br />Bearbeite Deinen bestehenden Kommentar, wenn Du ihn verändern willst',
        'redirect_msg' => 'Du wirst weitergeleitet.<br /><br /><br />Klicke \'weiter\', falls die Seite sich nicht automatisch aktualisiert',
        'upl_success' => 'Dein Bild wurde erfolgreich hinzugefügt',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
        'caption' => 'Überschrift',
        'fs_pic' => 'Bild in Originalgröße',
        'del_success' => 'erfolgreich gelöscht',
        'ns_pic' => 'normal grosses Bild',
        'err_del' => 'kann nicht gelöscht werden',
        'thumb_pic' => 'Thumbnail',
        'comment' => 'Kommentar',
        'im_in_alb' => 'Bild in Album',
        'alb_del_success' => 'Album \'%s\' gelöscht',
        'alb_mgr' => 'Alben-Manager',
        'err_invalid_data' => 'Ungültige Daten empfangen in \'%s\'',
        'create_alb' => 'Erzeuge Album \'%s\'',
        'update_alb' => 'Aktualisiere Album \'%s\' mit Titel \'%s\' und Index \'%s\'',
        'del_pic' => 'Bild löschen',
        'del_alb' => 'Album löschen',
        'del_user' => 'Benutzer löschen',
        'err_unknown_user' => 'Der gewählte Benutzer ist nicht vorhanden!',
        'comment_deleted' => 'Kommentar wurde gelöscht',
);

// ------------------------------------------------------------------------- //
// File displayecard.php
// ------------------------------------------------------------------------- //

// Void

// ------------------------------------------------------------------------- //
// File displayimage.php
// ------------------------------------------------------------------------- //

if (defined('DISPLAYIMAGE_PHP')){

$lang_display_image_php = array(
        'confirm_del' => 'Dieses Bild wirklich LÖSCHEN? \\nKommentare werden ebenfalls gelöscht.',
        'del_pic' => 'Dieses Bild Löschen',
        'edit_pic' => 'Dieses Bild bearbeiten',
        'size' => '%s x %s Pixel',
        'views' => '%s mal',
        'slideshow' => 'Diashow',
        'stop_slideshow' => 'Diashow anhalten',
        'view_fs' => 'Klicken für Bild in voller Grösse',
);

$lang_picinfo = array(
        'title' =>'Bild-Information',
        'Filename' => 'Dateiname',
        'Album name' => 'Name des Albums',
        'Rating' => 'Bewertung (%s Stimmen)',
        'Keywords' => 'Stichworte',
        'File Size' => 'Dateigrösse',
        'Dimensions' => 'Abmessungen',
        'Displayed' => 'Angezeigt',
        'Camera' => 'Kamera',
        'Date taken' => 'Aufnahmedatum',
        'Aperture' => 'Blende',
        'Exposure time' => 'Belichtungszeit',
        'Focal length' => 'Brennweite',
        'Comment' => 'Kommentar',
        'addFav'=>'zu Favoriten hinzufügen', //new in cpg1.2.0
        'addFavPhrase'=>'Favoriten', //new in cpg1.2.0
        'remFav'=>'aus Favoriten entfernen', //new in cpg1.2.0
);

$lang_display_comments = array(
        'OK' => 'OK',
        'edit_title' => 'Diesen Kommentar bearbeiten',
        'confirm_delete' => 'Willst Du diesen Kommentar wirklich löschen?',
        'add_your_comment' => 'Füge Deinen Kommentar hinzu',
        'name'=>'Name',
        'comment'=>'Kommentar',
        'your_name' => 'Dein Name',
);

$lang_fullsize_popup = array(
        'click_to_close' => 'Bild anklicken, um das Fenster zu schliessen!',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
        'title' => 'eCard senden',
        'invalid_email' => '<b>Achtung</b> : ungültige E-Mail Adresse !',
        'ecard_title' => 'Eine eCard von %s für Dich',
        'view_ecard' => 'Falls diese eCard nicht korrekt angezeigt wird klicke auf den folgenden Link: ',
        'view_more_pics' => 'Klicke auf diesen Link, um mehr Bilder ansehen zu können!',
        'send_success' => 'Deine eCard wurde gesendet',
        'send_failed' => 'Leider kann der Server Deine eCard nicht versenden...',
        'from' => 'Von',
        'your_name' => 'Dein Name',
        'your_email' => 'Deine E-Mail Adresse',
        'to' => 'An',
        'rcpt_name' => 'Empfänger Name',
        'rcpt_email' => 'Empfanger E-Mail Adresse',
        'greetings' => 'Grüsse',
        'message' => 'Nachricht',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
        'pic_info' => 'Bild-Info',
        'album' => 'Album',
        'title' => 'Titel',
        'desc' => 'Beschreibung',
        'keywords' => 'Stichworte',
        'pic_info_str' => '%sx%s - %sKB - %s x angesehen - %s x bewertet',
        'approve' => 'Bild genehmigen',
        'postpone_app' => 'Genehmigung verschieben',
        'del_pic' => 'Bild löschen',
        'reset_view_count' => 'Zähler x mal angesehen auf Null setzen',
        'reset_votes' => 'Anzahl Stimmen auf Null setzen',
        'del_comm' => 'Kommentare löschen',
        'upl_approval' => 'Genehmigung zum Hochladen',
        'edit_pics' => 'Bilder bearbeiten',
        'see_next' => 'nächste Bilder ansehen',
        'see_prev' => 'vorherige Bilder ansehen',
        'n_pic' => '%s Bilder',
        'n_of_pic_to_disp' => 'Bilder pro Seite',
        'apply' => 'Änderungen ausführen'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
        'group_name' => 'Gruppen-Name',
        'disk_quota' => 'Speicherplatz',
        'can_rate' => 'Darf Bilder bewerten',
        'can_send_ecards' => 'Darf eCards versenden',
        'can_post_com' => 'Darf Kommentare abgeben',
        'can_upload' => 'Darf Bilder hochladen',
        'can_have_gallery' => 'Darf eine persönliche Galerie haben',
        'apply' => 'Änderungen ausführen',
        'create_new_group' => 'Neue Gruppe erstellen',
        'del_groups' => 'ausgewählte Gruppe(n) löschen',
        'confirm_del' => 'Achtung: wenn Du eine Gruppe löschst werden die dazu gehörenden Benutzer in die Gruppe \'Registrierte Benutzer\' Verschoben !\n\nWillst Du das ?',
        'title' => 'Benutzer-Gruppen verwalten',
        'approval_1' => 'Öffentl. Upload best. (1)',
        'approval_2' => 'Priv. Upload best. (2)',
        'note1' => '<b>(1)</b> Das Hochladen in ein öffentliches Album muß durch den Admin bestätigt werden',
        'note2' => '<b>(2)</b> Das Hochladen in ein privates Album muß durch den Admin bestätigt werden',
        'notes' => 'Anmerkungen'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
        'welcome' => 'Startseite'
);

$lang_album_admin_menu = array(
        'confirm_delete' => 'Willst Du dieses Album wirklich LÖSCHEN? \\nAlle darin befindlichen Bilder und Kommentare werden ebenfalls gelöscht.',
        'delete' => 'löschen',
        'modify' => 'Eigenschaften',
        'edit_pics' => 'Bilder bearbeiten',
);

$lang_list_categories = array(
        'home' => 'Galerie',
        'stat1' => '<b>[pictures]</b> Bilder in <b>[albums]</b> Alben und <b>[cat]</b> Kategorien mit <b>[comments]</b> Kommentaren, <b>[views]</b> mal angesehen',
        'stat2' => '<b>[pictures]</b> Bilder in <b>[albums]</b> Alben, <b>[views]</b> mal angesehen',
        'xx_s_gallery' => '%s\'s Galerie',
        'stat3' => '<b>[pictures]</b> Bilder in <b>[albums]</b> Alben mit <b>[comments]</b> Kommentaren, <b>[views]</b> mal angesehen'
);

$lang_list_users = array(
        'user_list' => 'Benutzer-Liste',
        'no_user_gal' => 'Es gibt keine Benutzer, die eigene Alben haben dürfen',
        'n_albums' => '%s Album/en',
        'n_pics' => '%s Bild(er)'
);

$lang_list_albums = array(
        'n_pictures' => '%s Bilder',
        'last_added' => ', letzte Aktualisierung am %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
        'login' => 'Anmeldung (Login)',
        'enter_login_pswd' => 'Gib Deinen Benutzernamen und Dein Passwort ein, um Dich anzumelden',
        'username' => 'Benutzername',
        'password' => 'Passwort',
        'remember_me' => 'Immer angemeldet bleiben',
        'welcome' => 'Hallo %s ...',
        'err_login' => '*** Konnte Dich nicht anmelden. Versuche es nochmal ***',
        'err_already_logged_in' => 'Du bist schon angemeldet!',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
        'logout' => 'Abmelden',
        'bye' => 'Tschüss %s ...',
        'err_not_loged_in' => 'Du bist nicht angemeldet!',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
        'upd_alb_n' => 'Album %s aktualisieren',
        'general_settings' => 'Allgemeine Einstellungen',
        'alb_title' => 'Album Titel',
        'alb_cat' => 'Album Kategorie',
        'alb_desc' => 'Album Beschreibung',
        'alb_thumb' => 'Album Thumbnail',
        'alb_perm' => 'Berechtigungen für dieses Album',
        'can_view' => 'Album kann angesehen werden von',
        'can_upload' => 'Besucher können Bilder hochladen',
        'can_post_comments' => 'Besucher können Kommentare abgeben',
        'can_rate' => 'Besucher können Bilder bewerten',
        'user_gal' => 'Benutzer-Galerie',
        'no_cat' => '* keine Kategorie *',
        'alb_empty' => 'Album ist leer',
        'last_uploaded' => 'Letzes Bild, das hochgeladen wurde',
        'public_alb' => 'Jeder (öffentliches Album)',
        'me_only' => 'Nur ich',
        'owner_only' => 'Nur der Besitzer des Albums (%s)',
        'groupp_only' => 'Mitglieder der Gruppe \'%s\'',
        'err_no_alb_to_modify' => 'Es ist kein Album zum Bearbeiten in der Datenbank.',
        'update' => 'Album aktualisieren'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
        'already_rated' => 'Du hast dieses Bild schon bewertet',
        'rate_ok' => 'Deine Bewertung wurde akzeptiert',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
Obwohl die Administratoren von {SITE_NAME} versuchen werden, generell alle anstössigen Inhalte so schnell wie möglich zu löschen oder bearbeiten ist es unmöglich, jeden Beitrag zu überprüfen. Daher bestätigst Du, dass alle Beiträge auf dieser Seite die Ansichten und Meinungen des Authors widerspiegeln und nicht die des Administrators oder Webmasters (außer den Beiträgen, die durch sie verfasst wurden) und sie daher dafür nicht verantwortlich gemacht werden können.<br />
<br />
Du stimmst zu, keine beleidigende, obszöne, vulgäre, verleumderische, verhetzende,drohende, sexuell-orientierte oder sonstwie illegalen Beiträge zu verfassen. Du stimmst zu, daß der/die Webmaster, Administrator(en) oder Moderator(en) von {SITE_NAME} das recht haben, jeden Inhalt zu löschen oder ändern, bei dem sie es für richtig halten. Als Benutzer stimmst Du zu, daß alle Informationen, die Du oben eingetragen hast in einer Datenbank gespeichert werden. Obwohl diese Daten ohne Deine ausdrückliche Zustimmung nicht an Dritte weitergegeben werden können der Webmaster oder Administrator nicht dafür zur Verantwortung gezogen werden, wenn durch einen Angriff (Hacking) die gespeicherten Daten kompromitiert werden.<br />
<br />
Diese Seite benutzt Cookies, um Daten auf Deinem Rechner zu speichern. Diese Cookies dienen nur dazu, die Bedienung der Seite zu ermöglichen. Die E-Mail Adresse wird nur dazu verwendet, die Registrierungs-Details und das Passwort zu bestätigen.<br />
<br />
Durch das Anklicken von 'ich stimme zu' stimmst Du diesen Bedingungen zu.
EOT;

$lang_register_php = array(
        'page_title' => 'Benutzer-Registrierung',
        'term_cond' => 'Nutzungsbedingungen',
        'i_agree' => 'ich stimme zu',
        'submit' => 'Registrieren absenden',
        'err_user_exists' => 'Der Benutzername, den Du eingegeben hast existiert schon, bitte wähle einen anderen',
        'err_password_mismatch' => 'Die Passwörter stimmen nicht überein, bitte nochmals eingeben',
        'err_uname_short' => 'Der Benutzername muß mindestens 2 Zeichen lang sein',
        'err_password_short' => 'Das Passwort muß mindestens 2 Zeichen lang sein',
        'err_uname_pass_diff' => 'Benutzername und Passwort müssen unterschiedlich sein',
        'err_invalid_email' => 'E-Mail Adresse ist ungültig',
        'err_duplicate_email' => 'Es hat sich schon ein anderer Benutzer mit der angegebenen E-Mail Adresse registriert',
        'enter_info' => 'Gib Registrierungs-Informationen ein',
        'required_info' => 'Pflichtfeld',
        'optional_info' => 'Optional',
        'username' => 'Benutzername',
        'password' => 'Passwort',
        'password_again' => 'Passwort-Bestätigung',
        'email' => 'E-Mail Adresse',
        'location' => 'Ort',
        'interests' => 'Hobbies',
        'website' => 'Homepage',
        'occupation' => 'Beruf',
        'error' => 'ERROR',
        'confirm_email_subject' => '%s - Registrierungs-Bestätigung',
        'information' => 'Information',
        'failed_sending_email' => 'Die Registrierungs-bestätigung kann nicht per E-Mail versendet werden!',
        'thank_you' => 'Danke für Deine Registrierung.<br /><br />Eine E-Mail mit Informationen, wie Du Dein Benutzerkonto aktivieren kannst wurde an die angegebene E-Mail Adresse gesendet.',
        'acct_created' => 'Dein Benutzerkonto wurde erstellt. Du kannst Dich jetzt mit Benutzername und passwort anmelden',
        'acct_active' => 'Dein Benutzerkonto ist jetzt aktiviert - Du kannst Dich mit Benutzername und Passwort anmelden',
        'acct_already_act' => 'Dein Benutzerkonto ist bereits aktiviert!',
        'acct_act_failed' => 'Dieses Benutzerkonto kann nicht aktiviert werden!',
        'err_unk_user' => 'Der gewählte Benutzer existiert nicht!',
        'x_s_profile' => '%s\'s Benutzerprofil',
        'group' => 'Gruppe',
        'reg_date' => 'Registriert am',
        'disk_usage' => 'Speicherplatz-Verbrauch',
        'change_pass' => 'Passwort ändern',
        'current_pass' => 'derzeitiges Passwort',
        'new_pass' => 'neues Passwort',
        'new_pass_again' => 'neues Passwort bestätigen',
        'err_curr_pass' => 'Derzeitiges Passwort ist verkehrt',
        'apply_modif' => 'Änderungen speichern',
        'change_pass' => 'Mein Passwort ändern',
        'update_success' => 'Dein Benutzerprofil wurde aktualisiert',
        'pass_chg_success' => 'Dein Passwort wurde geändert',
        'pass_chg_error' => 'Dein Passwort wurde nicht geändert',
);

$lang_register_confirm_email = <<<EOT
Danke für Deine Registrierung bei {SITE_NAME}

Dein Benutzername ist : "{USER_NAME}"
Dein Passwort lautet : "{PASSWORD}"

Um Dein Benutzerkonto zu aktivieren musst Du auf untenstehenden Link klicken
oder ihn kopieren und in der Adresszeile Deines Browsers einfügen.
{ACT_LINK}

Grüsse,

Das Team von {SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
        'title' => 'Kommentare bearbeiten',
        'no_comment' => 'keine zu bearbeitenden Kommentare vorhanden',
        'n_comm_del' => '%s Kommentar(e) gelöscht',
        'n_comm_disp' => 'Anzahl anzuzeigende Kommentare',
        'see_prev' => 'vorherigen anzeigen',
        'see_next' => 'nächsten anzeigen',
        'del_comm' => 'markierte Kommentare löschen',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
        0 => 'Bildersammlung durchsuchen',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
        'page_title' => 'neue Bilder suchen',
        'select_dir' => 'Wähle Verzeichnis',
        'select_dir_msg' => 'Diese Funktion ermöglicht, mehrere Bilder der Galerie hinzuzufügen, die mit einem FTP-Programm schon auf Deine Webseite hochgeladen wurden.<br /><br />Wähle das Verzeichnis, in das Du die Bilder hochgeladen hast',
        'no_pic_to_add' => 'Kein Bild zum Hinzufügen gefunden',
        'need_one_album' => 'Du brauchst mindestens ein Album, um dieses Funktion auszuführen',
        'warning' => 'Achtung',
        'change_perm' => 'das Skript kann in dieses Verzeichnis nicht schreiben, Du musst die Lese-/Schreibberechtigung (chmod) auf 755 oder 777 setzen, bevor Du versuchst, Bilder hinzuzufügen!',
        'target_album' => '<b>Bilder aus dem Verzeichnis &quot;</b>%s<b>&quot; in </b>%s ablegen',
        'folder' => 'Verzeichnis',
        'image' => 'Bild',
        'album' => 'Album',
        'result' => 'Resultat',
        'dir_ro' => 'Verzeichnis nicht beschreibbar. ',
        'dir_cant_read' => 'Verzeichnis nicht lesbar. ',
        'insert' => 'Füge neue Bilder der Galerie hinzu',
        'list_new_pic' => 'Liste neuer Bilder',
        'insert_selected' => 'Markierte Bilder einfügen',
        'no_pic_found' => 'Keine neuen Bilder gefunden',
        'be_patient' => 'Bitte Geduld, das Skript brauchst Zeit, um die Bilder hinzuzufügen',
        'notes' =>  '<ul>'.
                                '<li><b>OK</b> : bedeuted, daß das Bild erfolgreich hinzugefügt wurde'.
                                '<li><b>DP</b> : bedeutet, daß das Bild ein Duplikat ist und schon in der Datenbank vorhanden ist'.
                                '<li><b>PB</b> : bedeutet, daß das Bild nicht hinzugefügt werden konnte; überprüfe Deine Einstellungen und die Berechtigungen der Verzeichnisse, in dem die Bilder liegen'.
                                '<li>Falls die OK, DP, PB \'Zeichen\' nicht erscheinen klicke auf die nicht-funktionierenden Bilder, um die Fehlermeldungen von PHP zu sehen'.
                                '<li>Wenn Dein Browser in ein Timeout läuft, klicke auf die Aktualisieren-Schaltfläche'.
                                '</ul>',
);


// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //

// Void

// ------------------------------------------------------------------------- // 
// File banning.php 
// ------------------------------------------------------------------------- // 

if (defined('BANNING_PHP')) $lang_banning_php = array( 
                'title' => 'Benutzer verbannen', 
                'user_name' => 'Benutzername', 
                'ip_address' => 'IP-Adresse', 
                'expiry' => 'läft ab (leer bedeutet &quot;für immer&quot;)', 
                'edit_ban' => 'Änderungen speichern', 
                'delete_ban' => 'Löschen', 
                'add_new' => 'Neuen Bann hinzufügen', 
                'add_ban' => 'hinzufügen', 
); 

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
        'title' => 'Bild hochladen',
        'max_fsize' => 'Maximal zulässige Dateigrösse ist %s KB. Es können nur .jpg und .png - Dateien hochgeladen werden',
        'album' => 'Album',
        'picture' => 'Bild',
        'pic_title' => 'Bild-Titel',
        'description' => 'Bild-Beschreibung',
        'caption' => 'Bild-Beschreibung',
        'keywords' => 'Stichworte (Trennung mit Komma)',
        'err_no_alb_uploadables' => 'Leider gibt es kein Album, in das Du Bilder hochladen darfst',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
        'title' => 'Benutzer verwalten',
        'name_a' => 'Name aufsteigend',
        'name_d' => 'Name absteigend',
        'group_a' => 'Gruppe aufsteigend',
        'group_d' => 'Gruppe absteigend',
        'reg_a' => 'Registrierungsdatum aufsteigend',
        'reg_d' => 'Registrierungsdatum absteigend',
        'pic_a' => 'Bilderanzahl aufsteigend',
        'pic_d' => 'Bilderanzahl absteigend',
        'disku_a' => 'Speicherplatz-Verbrauch aufsteigend',
        'disku_d' => 'Speicherplatz-Verbrauch absteigend',
        'sort_by' => 'Benutzer sortieren nach',
        'err_no_users' => 'Benutzer-Tabelle ist leer!',
        'err_edit_self' => 'Du kannst Dein eigenes Profil hier nicht bearbeiten, benutze dafür den Link \'mein Profil\'',
        'edit' => 'bearbeiten',
        'delete' => 'löschen',
        'name' => 'Benutzername',
        'group' => 'Gruppe',
        'inactive' => 'Inaktiv',
        'operations' => 'Operationen',
        'pictures' => 'Bilder',
        'disk_space' => 'Speicherplatzverbrauch / Quota',
        'registered_on' => 'Registriert am',
        'u_user_on_p_pages' => '%d Benutzer auf %d Seite(n)',
        'confirm_del' => 'Willst Du diesen Benutzer wirklich LÖSCHEN? \\nAlle seine Bilder und Alben werden ebenfalls gelöscht.',
        'mail' => 'MAIL',
        'err_unknown_user' => 'Gewählter Benutzer existiert nicht!',
        'modify_user' => 'Benutzer ändern',
        'notes' => 'Anmerkungen',
        'note_list' => '<li>Wenn Du das derzeitige Passwort nicht ändern willst, lasse das Feld "Passwort" leer',
        'password' => 'Passwort',
        'user_active' => 'Benutzer ist aktiv',
        'user_group' => 'Benutzergruppe',
        'user_email' => 'E-Mail Adresse des Benutzers',
        'user_web_site' => 'Webseite des Benutzers',
        'create_new_user' => 'neuen Benutzer anlegen',
        'user_location' => 'Ort',
        'user_interests' => 'Hobbies/Interessen',
        'user_occupation' => 'Beruf/Beschäftigung',
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => 'Grösse ändern',
        'what_it_does' => 'Was macht dieses Tool',
        'what_update_titles' => 'Erzeugt Titel aus Dateinamen',
        'what_delete_title' => 'Löscht Titel',
        'what_rebuild' => 'Erneuert Thumbnails und Bilder in Zwischengrösse gemäß aktuellen EInstellungen',
        'what_delete_originals' => 'Löscht Bilder in Original-Grösse und ersetzt sie mit Bildern in Zwischengrösse',
        'file' => 'Datei',
        'title_set_to' => 'Ändere Titel auf',
        'submit_form' => 'los',
        'updated_succesfully' => 'erfolgreich geändert',
        'error_create' => 'FEHLER beim erzeugen von',
        'continue' => 'Mehr Bilder durchlaufen',
        'main_success' => 'Die Datei %s wurde erfolgreich als Hauptbild benutzt',
        'error_rename' => 'Fehler beim Umbenennen von %s zu %s',
        'error_not_found' => 'Die Datei %s wurde nicht gefunden',
        'back' => 'zurück zur Auswahl',
        'thumbs_wait' => 'Aktualisiere Thumbnails und/oder Bilder in Zwischengrösse, bitte warten...',
        'thumbs_continue_wait' => 'Fortfahren mit der Aktualisierung der Thumbnails und/oder Bilder in Zwischengrösse...',
        'titles_wait' => 'Aktualisiere Überschriften, bitte warten...',
        'delete_wait' => 'Lösche Überschriften, bitte warten...',
        'replace_wait' => 'Lösche Originale und ersetze sie mit Bilder in Zwischengrösse, bitte warten..',
        'instruction' => 'Kurzanleitung',
        'instruction_action' => 'Wähle Aktion',
        'instruction_parameter' => 'Wähle Parameter',
        'instruction_album' => 'Wähle Album',
        'instruction_press' => 'Klicke %s',
        'update' => 'Thumbnails und/oder Bilder in Zwischengrösse aktualisieren',
        'update_what' => 'Was soll aktualisiert werden',
        'update_thumb' => 'Nur Thumbnails',
        'update_pic' => 'Nur Bilder in Zwischengrösse',
        'update_both' => 'Sowohl Thumbnails als auch Bilder in Zwischengrösse',
        'update_number' => 'Anzahl der Bilder, die pro Klick aktualisiert werden sollen',
        'update_option' => '(Verringere diesen Wert niedriger, wenn &quot;Time-Out&quot;-Probleme auftreten sollten)',
        'filename_title' => 'Dateiname &rArr; Bild-Überschrift',
        'filename_how' => 'Wie soll der Dateiname modifiziert werden',
        'filename_remove' => 'Übersetze die Engung .jpg und ersetze _ (Unterstrich) mit Leerzeichen',
        'filename_euro' => 'Ändere 2003_11_23_13_20_20.jpg zu 23/11/2003 13:20',
        'filename_us' => 'Ändere 2003_11_23_13_20_20.jpg zu 11/23/2003 13:20',
        'filename_time' => 'Ändere 2003_11_23_13_20_20.jpg zu 13:20',
        'delete' => 'Lösche Bild-Überschriften oder Bilder in Original-Grösse',
        'delete_title' => 'Bild-Überschriften löschen',
        'delete_original' => 'Bilder in Originalgrösse löschen',
        'delete_replace' => 'Lösche die Original-Bilder und ersetze sie mit Bilder in Zwischengrösse',
        'select_album' => 'Wähle Album',
);
?>