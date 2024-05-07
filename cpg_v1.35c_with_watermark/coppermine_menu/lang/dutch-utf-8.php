<?PHP

// ------------------------------------------------------------------------- //
//  Coppermine Photo Gallery                                                 //
// ------------------------------------------------------------------------- //
//  Copyright (C) 2002,2003  Gregory DEMAR <gdemar@wanadoo.fr>               //
//  http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
//  Based on PHPhotoalbum by Henning Stverud <henning@stoverud.com>         //
//  http://www.stoverud.com/PHPhotoalbum/                                    //
// ------------------------------------------------------------------------- //
//  Hacked by Tarique Sani <tarique@sanisoft.com> and Girsh Nair             //
//  <girish@sanisoft.com> see http://www.sanisoft.com/cpg/README.txt for     //
//  details                                                                  //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
// ------------------------------------------------------------------------- //

// info about translators and translated language 
$lang_translation_info = array( 
'lang_name_english' => 'Dutch',  //the name of your language in English, e.g. 'Greek' or 'Spanish' 
'lang_name_native' => 'Nederlands', //the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '????????' or 'Español' 
'lang_country_code' => 'nl', //the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es' 
'trans_name'=> 'Ron Bos', //the name of the translator - can be a nickname 
'trans_email' => 'ron@ronbos.nl', //translator's email address (optional) 
'trans_website' => 'http://www.ronbos.nl/', //translator's website (optional) 
'trans_date' => '2003-10-31', //the date the translation was created / last modified 
); 

$lang_charset = 'iso-8859-1';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('zon', 'maa', 'din', 'woe', 'don', 'vri', 'zat');
$lang_month = array('jan', 'feb', 'mrt', 'apr', 'mei', 'jun', 'jul', 'aug', 'sep', 'okt', 'nov', 'dec');

$lang_yes = 'Ja';
$lang_no  = 'Nee';
$lang_back = 'Terug';
$lang_continue = 'Doorgaan';
$lang_info = 'Informatie';
$lang_error = 'Fout';


// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$album_date_fmt =    '%d %B %Y';
$lastcom_date_fmt =  '%d-%m-%y om %H:%M';
$lastup_date_fmt = '%d %B %Y';
$register_date_fmt = '%d %B %Y';
$lasthit_date_fmt = '%d %B %Y om %H:%M ';
$comment_date_fmt =  '%d %B %Y om %H:%M ';

$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*','kut','lul','neuken','klootzak','hoer','zak','hufter','pijpen','kloot','sex');

$lang_meta_album_names = array( 
        'random' => 'Willekeurige foto\'s', 
        'lastup' => 'Laatste toevoegingen', 
        'lastalb'=> 'Laatste gewijzigde albums', 
        'lastcom' => 'Laatste commentaren', 
        'topn' => 'Meest bekeken', 
        'toprated' => 'Best beoordeeld', 
        'lasthits' => 'Laatst bekeken', 
        'search' => 'Zoek resultaten', 
        'favpics'=> 'Favoriete foto\'s' 
); 

$lang_errors = array(
        'access_denied' => 'Je hebt geen toestemming om deze pagina te bezoeken.',
        'perm_denied' => 'Je hebt geen toestemming om deze handeling uit te voeren.',
        'param_missing' => 'Script aangeroepen zonder de vereiste parameters.',
        'non_exist_ap' => 'Geselecteerde album/foto bestaat niet!',
        'quota_exceeded' => 'Diskquotum overschreden<br /><br />Je hebt een quotum van [quota]K, je foto\'s gebruiken nu [space]K, het toevoegen van deze foto zorgt er voor dat je je quotum overschrijdt.',
        'gd_file_type_err' => 'Indien je de GD image library gebruikt zijn alleen JPEG en PNG toegestaan.',
        'invalid_image' => 'De foto die je hebt geupload is corrupt of kan niet behandeld worden door de GD library.',
        'resize_failed' => 'Niet in staat de thumbnail of de afmetingen van de foto aan te passen.',
        'no_img_to_display' => 'Geen foto om te tonen.',
        'non_exist_cat' => 'De geselecteerde categorie bestaat niet.',
        'orphan_cat' => 'De categorie heeft een niet bestaande ouder, start de categorie manager om het probleem te herstellen.',
        'directory_ro' => 'Map \'%s\' is niet beschrijfbaar, foto kan niet verwijderd worden.',
        'non_exist_comment' => 'Het geselecteerde commentaar is niet aanwezig.',
        'pic_in_invalid_album' => 'Foto is in een niet bestaand album (%s)!?', 
        'banned' => 'Je bent op dit moment uitgesloten van het gebruik van deze site.', 
        'not_with_udb' => 'Deze functie is uitgeschakeld in Coppermine omdat het geïntegreerd is met forum software. Wat je tracht te doen is of niet ondersteund in deze configuratie, of de functie zal afgehandeld moeten worden door de forum software.', 
); 

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
        'alb_list_title' => 'Ga naar de album lijst',
        'alb_list_lnk' => 'Album lijst',
        'my_gal_title' => 'Ga naar mijn persoonlijke galerij',
        'my_gal_lnk' => 'Mijn galerij',
        'my_prof_lnk' => 'Mijn profiel',
        'adm_mode_title' => 'Schakel naar admin-modus',
        'adm_mode_lnk' => 'Admin-modus',
        'usr_mode_title' => 'Schakel naar gebruiker-modus',
        'usr_mode_lnk' => 'Gebruiker-modus',
        'upload_pic_title' => 'Upload van een foto in een album',
        'upload_pic_lnk' => 'Upload foto',
        'register_title' => 'Creëer een account',
        'register_lnk' => 'Registreer',
        'login_lnk' => 'Inloggen',
        'logout_lnk' => 'Uitloggen',
        'lastup_lnk' => 'Laatste upload',
        'lastcom_lnk' => 'Laatste commentaar',
        'topn_lnk' => 'Meest bekeken',
        'toprated_lnk' => 'Best beoordeeld',
        'search_lnk' => 'Zoek',
        'fav_lnk' => 'Mijn Favorieten', 
);

$lang_gallery_admin_menu = array(
        'upl_app_lnk' => 'Upload toestemming',
        'config_lnk' => 'Instellingen',
        'albums_lnk' => 'Albums',
        'categories_lnk' => 'Categorieën',
        'users_lnk' => 'Gebruikers',
        'groups_lnk' => 'Groepen',
        'comments_lnk' => 'Commentaren',
        'searchnew_lnk' => 'Batch toevoegen foto\'s',
        'util_lnk' => 'Afmetingen aanpassen foto\'s', 
        'ban_lnk' => 'Verban gebruiker', //new in cpg1.2.0
);

$lang_user_admin_menu = array(
        'albmgr_lnk' => 'Creëer/sorteer albums',
        'modifyalb_lnk' => 'Wijzig mijn albums',
        'my_prof_lnk' => 'Mijn profiel',
);

$lang_cat_list = array(
        'category' => 'Categorie',
        'albums' => 'Albums',
        'pictures' => 'Foto\'s',
);

$lang_album_list = array(
        'album_on_page' => '%d album(s) op %d pagina(\'s)'
);

$lang_thumb_view = array(
        'date' => 'DATUM',
        //Sort by filename and title 
        'name' => 'BESTANDSNAAM', 
        'title' => 'TITEL', 
        'sort_da' => 'Sorteer op datum oplopend',
        'sort_dd' => 'Sorteer op datum aflopend',
        'sort_na' => 'Sorteer op naam oplopend',
        'sort_nd' => 'Sorteer op naam aflopend',
        'sort_ta' => 'Sorteer op titel oploopend', 
        'sort_td' => 'Sorteer op titel afloopend', 
        'pic_on_page' => '%d foto(\'s) op %d pagina(\'s)',
        'user_on_page' => '%d gebruiker(s) op %d pagina(\'s)'
);


$lang_img_nav_bar = array(
        'thumb_title' => 'Terug naar de thumbnail pagina',
        'pic_info_title' => 'Toon/verberg foto informatie',
        'slideshow_title' => 'Diashow',
        'ecard_title' => 'Stuur deze foto als een e-card',
        'ecard_disabled' => 'E-cards zijn uitgeschakeld',
        'ecard_disabled_msg' => 'Je hebt geen toestemming een e-card te versturen',
        'prev_title' => 'Bekijk voorgaande foto',
        'next_title' => 'Bekijk volgende foto',
        'pic_pos' => 'Foto %s / %s',
);

$lang_rate_pic = array(
        'rate_this_pic' => 'Beoordeel deze foto ',
        'no_votes' => '(Nog geen stemmen)',
        'rating' => '(huidige beoordeling : %s / 5 met %s stemmen)',
        'rubbish' => 'Rotzooi',
        'poor' => 'Zwak',
        'fair' => 'Gemiddeld',
        'good' => 'Goed',
        'excellent' => 'Zeer goed',
        'great' => 'Perfect',
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
        CRITICAL_ERROR => 'Kritieke fout',
        'file' => 'Bestand: ',
        'line' => 'Regel: ',
);

$lang_display_thumbnails = array(
        'filename' => 'Bestandsnaam : ',
        'filesize' => 'Bestandsgrootte : ',
        'dimensions' => 'Afmetingen : ',
        'date_added' => 'Datum toegevoegd : '
);

$lang_get_pic_data = array(
        'n_comments' => '%s commentaren',
        'n_views' => '%s x bekeken',
        'n_votes' => '(%s stemmen)'
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
// File include/smilies.inc.php - OK
// ------------------------------------------------------------------------- //

if (defined('SMILIES_PHP')) $lang_smilies_inc_php = array(
        'Exclamation' => 'Uitroepteken',
        'Question' => 'Vraag',
        'Very Happy' => 'Zeer gelukkig',
        'Smile' => 'Glimlach',
        'Sad' => 'Triest',
        'Surprised' => 'Verbaasd',
        'Shocked' => 'Geshockeerd',
        'Confused' => 'Verward',
        'Cool' => 'Cool',
        'Laughing' => 'Lachen',
        'Mad' => 'Gek',
        'Razz' => 'Razz',
        'Embarassed' => 'Verlegen',
        'Crying or Very sad' => 'Huilen of zeer triest',
        'Evil or Very Mad' => 'Slecht of zeer gek',
        'Twisted Evil' => 'Twisted Evil',
        'Rolling Eyes' => 'Rollende ogen',
        'Wink' => 'Knipoog',
        'Idea' => 'Idee',
        'Arrow' => 'Pijl',
        'Neutral' => 'Neutraal',
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
        0 => 'Verlaten admin-modus',
        1 => 'Admin-modus geactiveerd'
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //


if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
        'alb_need_name' => 'Albums moeten een naam hebben !',
        'confirm_modifs' => 'Weet je zeker dat je deze wijzigingen wilt maken ?',
        'no_change' => 'Je hebt geen enkele wijziging gedaan !',
        'new_album' => 'Nieuw album',
        'confirm_delete1' => 'Weet je het zeker dat je dit album wilt verwijderen ?',
        'confirm_delete2' => '\nAlle foto\\\'s en commentaren zullen verloren gaan !',
        'select_first' => 'Selecteer eerst een album.',
        'alb_mrg' => 'Album Manager',
        'my_gallery' => '* Mijn galerij *',
        'no_category' => '* Geen categorie *',
        'delete' => 'Verwijder',
        'new' => 'Nieuw',
        'apply_modifs' => 'Pas wijzigingen toe',
        'select_category' => 'Selecteer categorie',
);

// ------------------------------------------------------------------------- //
// File catmgr.php - 
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
        'miss_param' => 'Vereiste parameters voor \'%s\'bewerking niet gegeven !',
        'unknown_cat' => 'Geselecteerde categorie bestaat niet in database',
        'usergal_cat_ro' => 'Gebruikergalerijen categorie kan niet verwijderd worden !',
        'manage_cat' => 'Beheer categorieën',
        'confirm_delete' => 'Weet je het zeker dat je deze categorie wilt VERWIJDEREN',
        'category' => 'Categorie',
        'operations' => 'Bewerkingen',
        'move_into' => 'Verplaats naar',
        'update_create' => 'Aanpassen/Creëer categorie',
        'parent_cat' => 'Ouder categorie',
        'cat_title' => 'Categorie titel',
        'cat_desc' => 'Categorie omschrijving'
);


// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
        'title' => 'Configuratie',
        'restore_cfg' => 'Herstel de fabrieksinstellingen',
        'save_cfg' => 'Bewaar nieuwe configuratie',
        'notes' => 'Notitie',
        'info' => 'Informatie',
        'upd_success' => 'Coppermine configuratie is aangepast',
        'restore_success' => 'Coppermine standaard configuratie is hersteld',
        'name_a' => 'Naam oplopend',
        'name_d' => 'Naam aflopend',
        'title_a' => 'Titel oploopend', 
        'title_d' => 'Titel afloopend', 
        'date_a' => 'Datum oplopend',
        'date_d' => 'Datum aflopend',
        'th_any' => 'Max verhouding',
        'th_ht' => 'Hoogte',
        'th_wd' => 'Breedte'
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
        'Algemene instellingen',
        array('galerij naam', 'gallery_name', 0),
        array('galerij omschrijving', 'gallery_description', 0),
        array('E-mailadres van galerij-administrator', 'gallery_admin_email', 0),
        array('Het doel adres van de "Zie meer foto\'s" link in e-cards', 'ecards_more_pic_target', 0),
        array('Taal', 'lang', 5),
        array('Thema', 'theme', 6),

        'Uiterlijk albumlijst',
        array('Breedte van de hoofd tabel (pixels of %)', 'main_table_width', 0),
        array('Aantal te tonen categorie niveaus', 'subcat_level', 0),
        array('Aantal te tonen albums', 'albums_per_page', 0),
        array('Aantal kolommen voor de album lijst', 'album_list_cols', 0),
        array('Grootte van de thumbnails in pixels', 'alb_list_thumb_size', 0),
        array('De inhoud van de hoofd pagina', 'main_page_layout', 0),
        array('Laat eerste niveau album thumbnails zien in categorieën','first_level',1), 

        'Uiterlijk thumbnail',
        array('Aantal kolommen op de thumbnail pagina', 'thumbcols', 0),
        array('Aantal regels op de thumbnail pagina', 'thumbrows', 0),
        array('Maximaal aantal te tonen tabs', 'max_tabs', 0),
        array('Toon foto beschrijving onder de thumbnails', 'caption_in_thumbview', 1),
        array('Toon aantal commentaren onder de thumbnail', 'display_comment_count', 1),
        array('Standaard sorteer volgorde voor foto\'s','default_sort_order', 3),
        array('Minimum aantal stemmen op foto\'s voordat ze in de \'best-gewaardeerd\' lijst verschijnen', 'min_votes_for_rating', 0),

        'Uiterlijk foto &amp; Commentaar instellingen',
        array('Breedte van de tabel om foto\'s te tonen (pixels of %)', 'picture_table_width', 0),
        array('Foto informatie is standaard zichtbaar', 'display_pic_info', 1),
        array('Filter slechte woorden in commentaren', 'filter_bad_words', 1),
        array('Sta emoticons toe in commentaren', 'enable_smilies', 1),
        array('Maximale lengte van fotobeschrijving', 'max_img_desc_length', 0),
        array('Maximale aantal tekens in een woord', 'max_com_wlength', 0),
        array('Maximale aantal regels in een commentaar', 'max_com_lines', 0),
        array('Maximale lengte van commentaar', 'max_com_size', 0),
        array('Laat film strip zien', 'display_film_strip', 1), 
        array('Aantal items in film strip', 'max_film_strip_items', 0), 


        'Foto en thumbnail instellingen',
        array('Kwaliteit voor JPEG bestanden', 'jpeg_qual', 0),
        array('Maximale breedte of hoogte van een thumbnail <b>*</b>', 'thumb_width', 0),
        array('Maximale afmeting van een thumbnail <b>*</b>', 'thumb_width', 0), 
        array('Gebruik afmeting  (breedte of hoogte verhouding van thumbnail) <b>*</b>', 'thumb_use', 7), 
        array('Creëer tussen foto\'s','make_intermediate',1),
        array('Maximale breedte of hoogte van tussen foto\'s <b>*</b>', 'picture_width', 0),
        array('Maximale grootte van upload foto\'s (KB)', 'max_upl_size', 0),
        array('Maximale breedte en hoogte van upload foto\'s (pixels)', 'max_upl_width_height', 0),

        'Gebruiker instellingen',
        array('Laat nieuwe gebruiker registratie toe', 'allow_user_registration', 1),
        array('Gebruiker registratie vereist e-mail verificatie', 'reg_requires_valid_email', 1),
        array('Laat toe dat twee gebruikers hetzelfde e-mail adres hebben', 'allow_duplicate_emails_addr', 1),
        array('Gebruikers kunnen privé albums hebben', 'allow_private_albums', 1),


        'Eigen velden voor foto beschrijving (laat leeg indien niet gebruikt)',
        array('Naam Veld 1', 'user_field1_name', 0),
        array('Naam Veld 2', 'user_field2_name', 0),
        array('Naam Veld 3', 'user_field3_name', 0),
        array('Naam Veld 4', 'user_field4_name', 0),

        'Foto\'s en thumbnails speciale instellingen',
        array('Laat privé album icoon zien aan niet ingelogde gebruiker','show_private',1), 
        array('Verboden tekens in bestandsnamen', 'forbiden_fname_char',0),
        array('Toegestane bestandstype (alleen geldig voor ImageMagick)', 'allowed_img_types',0),
        array('Geaccepteerde bestandsextensies voor upload foto\'s', 'allowed_file_extensions',0),
        array('Methode van aanpassen afmetingen van foto\'s','thumb_method',2),
        array('Pad naar ImageMagick \'convert\' utility (voorbeeld /usr/bin/X11/)', 'impath', 0),
        array('Command line opties voor ImageMagick', 'im_options', 0),
        array('Lees EXIF data in JPEG bestanden', 'read_exif_data', 1),
        array('De album map <b>*</b>', 'fullpath', 0),
        array('De map voor gebruikers foto\'s <b>*</b>', 'userpics', 0),
        array('De prefix voor tussen foto\'s <b>*</b>', 'normal_pfx', 0),
        array('De prefix voor thumbnails <b>*</b>', 'thumb_pfx', 0),
        array('Standaard modus voor mappen', 'default_dir_mode', 0),
        array('Standaard modus voor foto\'s', 'default_file_mode', 0),

        'Cookies &amp; Tekenset instellingen',
        array('Naam van de cookie, gebruikt door het script', 'cookie_name', 0),
        array('Pad van de cookie, gebruikt door het script', 'cookie_path', 0),
        array('Teken encoding', 'charset', 4),

        'Overige instellingen',
        array('Aanzetten debug-modus', 'debug_mode', 1),
        '<br /><div align="center">(*) velden gemarkeerd met * mogen niet veranderd worden als je al foto\'s in je galerij hebt</div><br />'

);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //


if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
        'empty_name_or_com' => 'Je moet je naam en commentaar ingeven.',
        'com_added' => 'je commentaar is toegevoegd.',
        'alb_need_title' => 'Je moet een naam geven aan het album !',
        'no_udp_needed' => 'Geen aanpassing nodig.',
        'alb_updated' => 'Het album is aangepast.',
        'unknown_album' => 'Geselecteerde album bestaat niet of je hebt geen toestemming naar dit album te uploaden.',
        'no_pic_uploaded' => 'Er is geen foto geupload !<br /><br />Indien je echt een foto geselecteerd hebt om te uploaden, controleer of de server bestands upload toestaat...',
        'err_mkdir' => 'Creëeren van map %s niet gelukt !',
        'dest_dir_ro' => 'Doel map %s is niet beschrijfbaar door het script !',
        'err_move' => 'Onmogelijk %s te verplaatsen naar %s !',
        'err_fsize_too_large' => 'De door jou opgeladen foto is te groot (maximum toegelaten is %s x %s) !',
        'err_imgsize_too_large' => 'Het door jou opgeladen bestand is te groot (maximum toegestaan is %s KB) !',
        'err_invalid_img' => 'Het bestand dat je opgeladen hebt is geen geldig fotobestand !',
        'allowed_img_types' => 'Je kan aleen %s foto\'s uploaden.',
        'err_insert_pic' => 'De foto \'%s\' kan niet ingevoegd worden in het album.',
        'upload_success' => 'Je foto is succesvol geladen<br /><br />Het wordt zichtbaar als de admin het goedgekeurd heeft.',
        'info' => 'Informatie',
        'com_added' => 'Commentaar toegevoegd.',
        'alb_updated' => 'Album aangepast.',
        'err_comment_empty' => 'Je commentaar is leeg !',
        'err_invalid_fext' => 'Alleen bestanden met de volgende extentie worden geaccepteerd : <br /><br />%s.',
        'no_flood' => 'Sorry maar je bent de auteur van het laatste geposte commentaar voor deze foto<br /><br />Wijzig het commentaar dat je toegevoegd hebt',
        'redirect_msg' => 'je wordt doorgestuurd.<br /><br /><br />Klik \'Doorgaan\' indien de pagina niet automatisch ververst wordt',
        'upl_success' => 'Je foto is succesvol toegevoegd.',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
        'caption' => 'Koptekst',
        'fs_pic' => 'full size foto',
        'del_success' => 'succesvol verwijderd',
        'ns_pic'  => 'normale grootte foto',
        'err_del' => 'kan niet verwijderd worden',
        'thumb_pic' => 'thumbnail',
        'comment' => 'commentaar',
        'im_in_alb' => 'foto in album',
        'alb_del_success' => 'Album \'%s\' verwijderd',
        'alb_mgr' => 'Album Manager',
        'err_invalid_data' => 'Ongeldige data ontvangen in \'%s\'',
        'create_alb' => 'creëren album \'%s\'',
        'update_alb' => 'Aanpassen album \'%s\' met titel \'%s\' en index \'%s\'',
        'del_pic' => 'Verwijder foto',
        'del_alb' => 'Verwijder album',
        'del_user' => 'Verwijder gebruiker',
        'err_unknown_user' => 'De geselecteerde gebruiker bestaat niet !',
        'comment_deleted' => 'Commentaar succesvol verwijderd',
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
        'confirm_del' => 'Weet je het zeker dat je deze foto wilt VERWIJDEREN ? \\nCommentaar wordt ook verwijderd.',
        'del_pic' => 'VERWIJDER DEZE FOTO',
        'size' => '%s x %s pixels',
        'views' => '%s keer',
        'slideshow' => 'Diashow',
        'stop_slideshow' => 'STOP DIASHOW',
        'view_fs' => 'Klik om de fullsize foto te bekijken',
);

$lang_picinfo = array(
        'title' =>'Foto informatie',
        'Filename' => 'Bestandsnaam',
        'Album name' => 'Albumnaam',
        'Rating' => 'Waardering (%s stemmen)',
        'Keywords' => 'Sleutelwoorden',
        'File Size' => 'Bestandsgrootte',
        'Dimensions' => 'Afmetingen',
        'Displayed' => 'Getoond',
        'Camera' => 'Camera',
        'Date taken' => 'Opnamedatum',
        'Aperture' => 'Opening',
        'Exposure time' => 'Sluitertijd',
        'Focal length' => 'Brandpuntsafstand',
        'Comment' => 'Commentaar', 
        'addFav'=>'Voeg toe aan Favorieten', 
        'addFavPhrase'=>'Favoriet', 
        'remFav'=>'Verwijder uit Favorieten', 
);

$lang_display_comments = array(
        'OK' => 'OK',
        'edit_title' => 'Wijzig dit commentaar.',
        'confirm_delete' => 'Weet je het zeker dat je dit commentaar wilt verwijderen ?',
        'add_your_comment' => 'Voeg je commentaar toe.',
        'name'=>'Naam', 
        'comment'=>'Commentaar', 
        'your_name' => 'Je naam', 
);

$lang_fullsize_popup = array( 
        'click_to_close' => 'Klik op de foto om dit window te sluiten', 
); 

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
        'title' => 'Stuur een e-card',
        'invalid_email' => '<b>Waarschuwing</b> : ongeldig e-mail adres !',
        'ecard_title' => 'Een e-card van %s voor jou.',
        'view_ecard' => 'Indien de e-card niet juist getoond wordt, klik dan op deze link.',
        'view_more_pics' => 'Klik op deze link om meer foto\'s te bekijken !',
        'send_success' => 'Je e-card is verzonden.',
        'send_failed' => 'Sorry, maar de server kan je e-card niet verzenden...',
        'from' => 'Van',
        'your_name' => 'Jouw naam',
        'your_email' => 'Jouw e-mail adres',
        'to' => 'Aan',
        'rcpt_name' => 'Naam geadresseerde',
        'rcpt_email' => 'E-mail adres geadresseerde',
        'greetings' => 'Groeten',
        'message' => 'Bericht',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
        'pic_info' => 'Foto&nbsp;info',
        'album' => 'Album',
        'title' => 'Titel',
        'desc' => 'Beschrijving',
        'keywords' => 'Sleutelwoorden',
        'pic_info_str' => '%s&times;%s - %sKB - %s bekeken - %s stemmen',
        'approve' => 'Laat foto toe',
        'postpone_app' => 'Stel toelating uit',
        'del_pic' => 'Verwijder foto',
        'reset_view_count' => 'Reset bekeken teller',
        'reset_votes' => 'Reset stemmen',
        'del_comm' => 'verwijder commentaar',
        'upl_approval' => 'Upload toestemming',
        'edit_pics' => 'Wijzig foto\'s',
        'see_next' => 'Bekijk volgende foto\'s',
        'see_prev' => 'Bekijk vorige foto\'s',
        'n_pic' => '%s foto\'s',
        'n_of_pic_to_disp' => 'Aantal te tonen foto\'s',
        'apply' => 'Pas wijzigingen toe'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
        'group_name' => 'Groepsnaam',
        'disk_quota' => 'Diskquotum',
        'can_rate' => 'Kan foto\'s beoordelen ',
        'can_send_ecards' => 'Kan e-cards zenden',
        'can_post_com' => 'Kan commentaar posten',
        'can_upload' => 'Kan foto\'s uploaden',
        'can_have_gallery' => 'Kan een persoonlijke galerij hebben',
        'apply' => 'Pas wijzigingen toe',
        'create_new_group' => 'Creëer nieuwe groep',
        'del_groups' => 'Verwijder geselecteerde groep(en)',
        'confirm_del' => 'Waarschuwing, indien je een groep verwijderd, kunnen gebruikers die behoorden tot deze groep niet meer inloggen !\n\nWil je doorgaan ?',
        'title' => 'Beheer gebruikersgroepen',
        'approval_1' => 'Pub. Upl. toestemming (1)',
        'approval_2' => 'Priv. Upl. toestemming (2)',
        'note1' => '<b>(1)</b> upload in een publiek album benodigd toesteming van de admin',
        'note2' => '<b>(2)</b> upload in een album welke behoort aan een gebruiker benodigd toestemming van de admin',
        'notes' => 'Notities'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')) {

$lang_index_php = array(
        'welcome' => 'Welkom !'
);

$lang_album_admin_menu = array(
        'confirm_delete' => 'Weet je het zeker dat je dit album wilt VERWIJDEREN ? \\nAlle foto\\\'s en commentaren worden ook verwijderd.',
        'delete' => 'Verwijder',
        'modify' => 'Eigenschappen',
        'edit_pics' => 'Wijzig foto\'s',
);

$lang_list_categories = array(
        'home' => 'Home',
        'stat1' => '<b>[pictures]</b> foto\'s in <b>[albums]</b> albums en <b>[cat]</b> categorieën met <b>[comments]</b> commentaren en <b>[views]</b> keer bekeken',
        'stat2' => '<b>[pictures]</b> foto\'s in <b>[albums]</b> albums en <b>[views]</b> keer bekeken',
        'xx_s_gallery' => '%s\'s Galerij',
        'stat3' => '<b>[pictures]</b> foto\'s in <b>[albums]</b> albums met <b>[comments]</b> commentaren en <b>[views]</b> keer bekeken'
);

$lang_list_users = array(
        'user_list' => 'Gebruikers lijst',
        'no_user_gal' => 'Er zijn geen gebruikers die toestemming hebben om albums te hebben.',
        'n_albums' => '%s album(s)',
        'n_pics' => '%s foto(\'s)'
);

$lang_list_albums = array(
        'n_pictures' => '%s foto\'s',
        'last_added' => ', laatste toegevoegd op %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
        'login' => 'Login',
        'enter_login_pswd' => 'Geef je gebruikersnaam en wachtwoord om in te loggen',
        'username' => 'Gebruikersnaam',
        'password' => 'Wachtwoord',
        'remember_me' => 'Onthoud mij',
        'welcome' => 'Welkom %s ...',
        'err_login' => '*** Kan niet inloggen. Probeer het nogmaals ***',
        'err_already_logged_in' => 'Je bent reeds ingelogd !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
        'logout' => 'Uitloggen',
        'bye' => 'Tot ziens %s ...',
        'err_not_loged_in' => 'Je bent niet ingelogd !',
);



// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
        'upd_alb_n' => 'Pas album %s aan',
        'general_settings' => 'Algemene instellingen',
        'alb_title' => 'Album titel',
        'alb_cat' => 'Album categorie',
        'alb_desc' => 'Album omschrijving',
        'alb_thumb' => 'Album thumbnail',
        'alb_perm' => 'Permissies voor dit album',
        'can_view' => 'Album kan bekeken worden door',
        'can_upload' => 'Bezoekers kunnen foto\'s uploaden',
        'can_post_comments' => 'Bezoekers kunnen commentaar posten',
        'can_rate' => 'Gebruiker kan foto\'s beoordelen',
        'user_gal' => 'Gebruiker galerij',
        'no_cat' => '* geen categorie *',
        'alb_empty' => 'Album is leeg',
        'last_uploaded' => 'Laatste upload',
        'public_alb' => 'Iedereen (publiek album)',
        'me_only' => 'Alleen ik',
        'owner_only' => 'Alleen albumeigenaar (%s)',
        'groupp_only' => 'Leden van de \'%s\' groep',
        'err_no_alb_to_modify' => 'Geen album die jij kan aanpassen in de database.',
        'update' => 'Pas album aan'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
        'already_rated' => 'Sorry, maar je hebt deze foto al beoordeeld',
        'rate_ok' => 'Je stem is geaccepteerd',

);

// ------------------------------------------------------------------------- //
// File register.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
De beheerder van {SITE_NAME} zal proberen elk aanstootgevend materiaal zo snel als mogelijk te verwijderen. Het is echter onmogelijk elk materiaal te bekijken. Daarom ga je akkoord dat alle postings die op deze site gemaakt worden de gezichtspunten en opinies zijn van de auteur en niet van de beheerder of webmaster (behalve hun eigen postings) en deze zullen daarom niet aansprakelijk gesteld worden.<br />
<br />
Je gaat er mee akkoord geen aanstootgevende, obscene, vulgaire, hatelijke, bedreigende, sexueel-getinte of elk ander materiaal dat elke van toepassing zijnde wet overtreedt, op deze site te plaatsen. Je gaat er mee akkoord dat de webmaster, beheerder en  moderators van {SITE_NAME} het recht hebben elke inhoud te verwijderen en of te wijzigen wanneer zij dat nodig vinden. Als gebruiker ga je er mee akkoord dat alle data die je hebt verstrekt in een database worden bewaard. Terwijl deze informatie niet openbaar gemaakt wordt aan een derde partij zonder jouw toestemming, ga je akkoord met het feit dat de webmaster en de beheerder niet verantwoordelijk gehouden kunnen worden voor elke hack poging, dat kan lijden tot het openbaar worden van de database.<br />
<br />
Deze site gebruikt cookies om informatie te bewaren op je lokale computer. Deze cookies dienen er voor jouw kijk plezier te verhogen. Het e-mail adres wordt alleen gebruikt om jouw registratie details en wachtwoord te bevestigen.<br />
<br />
Door op 'Ik ga akkoord' hieronder te klikken , ga je akkoord dat je gebonden bent aan deze condities.
EOT;

$lang_register_php = array(
        'page_title' => 'Gebruiker registratie',
        'term_cond' => 'Voorwaarde en condities',
        'i_agree' => 'Ik ga akkoord',
        'submit' => 'Zend registratie',
        'err_user_exists' => 'De gebruikersnaam die je ingevoerd hebt bestaat reeds, kies ajb een andere',
        'err_password_mismatch' => 'De twee wachtwoorden zijn niet gelijk, geef ze ajb nogmaals in',
        'err_uname_short' => 'Gebruikersnaam moet minimaal 2 tekens lang zijn',
        'err_password_short' => 'Wachtwoord moet minimaal 2 tekens lang zijn',
        'err_uname_pass_diff' => 'Gebruikersnaam en wachtwoord moeten verschillend zijn',
        'err_invalid_email' => 'E-mail adres is ongeldig',
        'err_duplicate_email' => 'Een andere gebruiker heeft zich reeds geregistreerd met dit e-mail adres',
        'enter_info' => 'Voer registratie informatie in ',
        'required_info' => 'Verplichte informatie',
        'optional_info' => 'Niet verplichte informatie',
        'username' => 'Gebruikersnaam',
        'password' => 'Wachtwoord',
        'password_again' => 'Nogmaals wachtwoord',
        'email' => 'E-mail',
        'location' => 'Locatie',
        'interests' => 'Interesse',
        'website' => 'Home page',
        'occupation' => 'Beroep',
        'error' => 'FOUT',
        'confirm_email_subject' => '%s - Registratie bevestiging',
        'information' => 'Informatie',
        'failed_sending_email' => 'De registratie bevestiging kan niet verzonden worden !',
        'thank_you' => 'Dank je voor het registreren.<br /><br />Een e-mail met informatie over hoe je account te activeren is verzonden naar het adres dat je opgegeven hebt.',
        'acct_created' => 'Je account is gecreëerd en je kan nu inloggen met je gebruikersnaam en wachtwoord',
        'acct_active' => 'Je account is nu actief en je kan inloggen met je gebruikersnaam en wachtwoord',
        'acct_already_act' => 'Je account is al actief !',
        'acct_act_failed' => 'Dit account kan niet geactiveerd worden !',
        'err_unk_user' => 'Geselecteerde gebruiker bestaat niet !',
        'x_s_profile' => '%s\'s profiel',
        'group' => 'Groep',
        'reg_date' => 'Aangemeld',
        'disk_usage' => 'Disk gebruik',
        'change_pass' => 'Verander wachtwoord',
        'current_pass' => 'Huidig wachtwoord',
        'new_pass' => 'Nieuw wachtwoord',
        'new_pass_again' => 'Nieuw wachtwoord opnieuw',
        'err_curr_pass' => 'Huidige wachtwoord is onjuist',
        'apply_modif' => 'Pas wijziging toe',
        'change_pass' => 'Verander mijn wachtwoord',
        'update_success' => 'Je profiel is aangepast',
        'pass_chg_success' => 'Je wachtwoord is aangepast',
        'pass_chg_error' => 'Je wachtwoord is niet aangepast',

);

$lang_register_confirm_email = <<<EOT
Dank je voor het registreren bij {SITE_NAME}

Je gebruikersnaam is : "{USER_NAME}"
je wachtwoord        : "{PASSWORD}"

Om je account te kunnen activeren moet je op de link hier onder klikken
of knip en plak het in je web browser.

{ACT_LINK}

Hartelijke groeten,

De beheerder van {SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
        'title' => 'Beoordeel commentaar',
        'no_comment' => 'Er is geen commentaar te beoordelen',
        'n_comm_del' => '%s commentaren verwijderd',
        'n_comm_disp' => 'Aantal te tonen commentaren',
        'see_prev' => 'Bekijk voorgaande',
        'see_next' => 'Bekijk volgende',
        'del_comm' => 'Verwijder geselecteerde commentaar',
);


// ------------------------------------------------------------------------- //
// File search.php
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
        0 => 'Doorzoek de foto collectie'
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
        'page_title' => 'Zoek nieuwe foto\'s',
        'select_dir' => 'Selecteer map',
        'select_dir_msg' => 'Deze funktie stelt je in staat een aantal foto\'s gelijktijdig naar je server te uploaden d.m.v. FTP.<br /><br />Selecteer de map waar je de foto\'s naar hebt opgeladen',
        'no_pic_to_add' => 'Er is geen foto om toe te voegen',
        'need_one_album' => 'Je hebt minimaal een album nodig om deze funktie te gebruiken',
        'warning' => 'Waarschuwing',
        'change_perm' => 'Het script kan niet schrijven in deze map, je moet zijn mode veranderen naar 755 of 777 voordat je probeert een foto toe te voegen !',
        'target_album' => '<b>Plaats foto\'s van &quot;</b>%s<b>&quot; in </b>%s',
        'folder' => 'Folder',
        'image' => 'Foto',
        'album' => 'Album',
        'result' => 'Resultaat',
	  'dir_ro' => 'Niet beschrijfbaar. ',
	  'dir_cant_read' => 'Niet leesbaar. ',
        'insert' => 'Toevoegen van nieuwe foto\'s aan galerij',
        'list_new_pic' => 'Lijst van nieuwe foto\'s',
        'insert_selected' => 'Invoegen van geselecteerde foto\'s',
        'no_pic_found' => 'Er zijn GEEN foto\'s gevonden',
        'be_patient' => 'Heb geduld, het script heeft tijd nodig om de foto\'s toe te voegen',
        'notes' =>  '<ul>'.
                                '<li><b>OK</b> : betekent dat de foto succesvol toegevoegd is'.
                                '<li><b>DP</b> : betekent dat de foto dubbel is en zich reeds in de database bevindt'.
                                '<li><b>PB</b> : betekent dat de foto niet toegevoegd kon worden, controleer je configuratie en de permissies op mappen waar de foto\'s zich bevinden'.
                                '<li>Als de OK, DP, PB \'tekens\' niet verschijnen klik dan op de verbroken foto om te kijken of er een PHP fout bericht gegeven wordt'.
                                '<li>Indien je browser uittimed klik dan op de herlaad knop'.
                                '</ul>'
);

// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //

// Void


// ------------------------------------------------------------------------- // 
// File banning.php 
// ------------------------------------------------------------------------- // 

if (defined('BANNING_PHP')) $lang_banning_php = array( 
                'title' => 'Verban gebruikers', 
                'user_name' => 'Gebruikersnaam', 
                'ip_address' => 'IP-adres', 
                'expiry' => 'Verloopt (blank is permanent)', 
                'edit_ban' => 'Bewaar veranderingen', 
                'delete_ban' => 'Verwijder', 
                'add_new' => 'Voeg nieuwe verbanning toe', 
                'add_ban' => 'Toevoegen', 
); 

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
        'title' => 'Upload foto',
        'max_fsize' => 'Maximaal toegestane bestandsgrootte is %s KB',
        'album' => 'Album',
        'picture' => 'Foto',
        'pic_title' => 'Foto titel',
        'description' => 'Foto omschrijving',
        'keywords' => 'Sleutelwoorden (scheiden met spaties)',
        'err_no_alb_uploadables' => 'Sorry er is geen album waar het je toegestaan is foto\'s naar te uploaden'
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
        'title' => 'Gebruikers beheer',
        'name_a' => 'Naam oplopend',
        'name_d' => 'Naam aflopend',
        'group_a' => 'Groep oplopend',
        'group_d' => 'Groep aflopend',
        'reg_a' => 'Registratie datum oplopend',
        'reg_d' => 'Registratie datum aflopend',
        'pic_a' => 'Aantal foto\'s oplopend',
        'pic_d' => 'Aantal foto\'s aflopend',
        'disku_a' => 'Disk gebruik oplopend',
        'disku_d' => 'Disk gebruik aflopend',
        'sort_by' => 'Sorteer gebruikers op',
        'err_no_users' => 'Gebruikers tabel is leeg !',
        'err_edit_self' => 'Je kan je eigen profiel niet wijzigen, gebruik daarvoor de \'Mijn profiel\' link',
        'edit' => 'Wijzig',
        'delete' => 'Verwijder',
        'name' => 'Gebruikersnaam',
        'group' => 'Groep',
        'inactive' => 'Inactief',
        'operations' => 'Bewerkingen',
        'pictures' => 'Foto\'s',
        'disk_space' => 'Disk ruimte',
        'registered_on' => 'Geregistreerd op',
        'u_user_on_p_pages' => '%d gebruikers op %d pagina(s)',
        'confirm_del' => 'Weet je het zeker dat je deze gebruiker wilt VERWIJDEREN ? \\nAl zijn foto\\\'s en albums worden ook verwijderd.',
        'mail' => 'MAIL',
        'err_unknown_user' => 'Geselecteerde gebruiker bestaat niet !',
        'modify_user' => 'Wijzig gebruiker',
        'notes' => 'Notities',
        'note_list' => '<li>Als je niet je huidige wachtwoord wilt wijzigen, laat dan het "wachtwoord" veld leeg',
        'password' => 'Wachtwoord',
        'user_active' => 'Gebruiker is actief',
        'user_group' => 'Gebruiker groep',
        'user_email' => 'Gebruiker e-mail',
        'user_web_site' => 'Gebruiker website',
        'create_new_user'=> 'Creëer nieuwe gebruiker',
        'user_location' => 'Gebruiker locatie',
        'user_interests' => 'Gebruiker interesse',
        'user_occupation'  => 'Gebruiker beroep',
);



// ------------------------------------------------------------------------- // 
// File util.php 
// ------------------------------------------------------------------------- // 

if (defined('UTIL_PHP')) $lang_util_php = array( 
        'title' => 'Aanpassen afmetingen foto\'s', 
        'what_it_does' => 'Wat doet deze tool', 
        'what_update_titles' => 'Creëert titels uit bestandsnamen', 
        'what_delete_title' => 'Verwijdert titels', 
        'what_rebuild' => 'Herbouwt thumbnails en past afmetingen aan van foto\'s', 
        'what_delete_originals' => 'Verwijdert de originele foto\'s en vervangt deze met de aangepaste afmetingen versie', 
        'file' => 'Bestand', 
        'title_set_to' => 'titel aangepast naar', 
        'submit_form' => 'Doorvoeren', 
        'updated_succesfully' => 'aanpassing succesvol', 
        'error_create' => 'FOUT bij aanmaken', 
        'continue' => 'Verwerk meer foto\'s', 
        'main_success' => 'Het bestand %s is succesvol gebruikt als hoofd foto', 
        'error_rename' => 'Fout bij hernoemen van %s naar %s', 
        'error_not_found' => 'Het bestand %s is niet gevonden', 
        'back' => 'terug naar begin', 
        'thumbs_wait' => 'Aanpassen van thumbnails en/of afmetingen van foto\'s, even geduld...', 
        'thumbs_continue_wait' => 'Doorgaan met aanpassen van thumbnails en/of afmetingen van foto\'s...', 
        'titles_wait' => 'Aanpassen titels, even geduld...', 
        'delete_wait' => 'Verwijderen titels, even geduld...', 
        'replace_wait' => 'Verwijderen van originele en vervangen door aangepaste afmetingen van foto\'s, even geduld..', 
        'instruction' => 'Snelle instructies', 
        'instruction_action' => 'Selecteer actie', 
        'instruction_parameter' => 'Zet parameters', 
        'instruction_album' => 'Selecteer album', 
        'instruction_press' => 'Klik %s', 
        'update' => 'Aanpassen thumbs en/of afmetingen foto\'s', 
        'update_what' => 'Wat moet er aangepast worden', 
        'update_thumb' => 'Alleen thumbnails', 
        'update_pic' => 'Alleen aangepaste foto\'s', 
        'update_both' => 'Zowel thumbnails als aangepaste foto\'s', 
        'update_number' => 'Aantal verwerkte foto\'s per klik', 
        'update_option' => '(Probeer deze instelling lager te zetten indien je timeout problemen ervaart)', 
        'filename_title' => 'Bestandsnaam &rArr; Foto titel', 
        'filename_how' => 'Hoe moet de bestandsnaam aangepast worden', 
        'filename_remove' => 'Verwijder de .jpg uitgang en vervang _ (underscore) met spaties', 
        'filename_euro' => 'Verander 2003_11_23_13_20_20.jpg naar 23/11/2003 13:20', 
        'filename_us' => 'Verander 2003_11_23_13_20_20.jpg naar 11/23/2003 13:20', 
        'filename_time' => 'Verander 2003_11_23_13_20_20.jpg naar 13:20', 
        'delete' => 'Verwijder foto titel of originele grootte van foto\'s', 
        'delete_title' => 'Verwijder foto titel', 
        'delete_original' => 'Verwijder originele foto\'s', 
        'delete_replace' => 'Verwijder de originele foto\'s en vervang deze door de in afmeting aangepast versies', 
        'select_album' => 'Selecteer album', 
);
?>