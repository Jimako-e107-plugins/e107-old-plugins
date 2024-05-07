<?php
// ------------------------------------------------------------------------- //
//  Coppermine Photo Gallery                                                 //
// ------------------------------------------------------------------------- //
//  Copyright (C) 2002,2003  Grégory DEMAR <gdemar@wanadoo.fr>               //
//  http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
//  Based on PHPhotoalbum by Henning Støverud <henning@stoverud.com>         //
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
'lang_name_english' => 'Danish',  //the name of your language in English, e.g. 'Greek' or 'Spanish' 
'lang_name_native' => 'Dansk', //the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '????????' or 'Español' 
'lang_country_code' => 'dk', //the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es' 
'trans_name'=> 'Laugesen', //the name of the translator - can be a nickname 
'trans_email' => 'laugesen@tommerup.net', //translator's email address (optional) 
'trans_website' => 'http://www.tommerup.net', //translator's website (optional) 
'trans_name2'=> 'David Holm', //the name of the translator - can be a nickname 
'trans_email2' => 'wormie@alberg.dk', //translator's email address (optional)
'trans_date' => '2003-10-07', //the date the translation was created / last modified 
); 

$lang_charset = 'iso-8859-1';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Byte', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('Søn', 'Man', 'Tir', 'Ons', 'Tor', 'Fre', 'Lør');
$lang_month = array('Jan', 'Feb', 'Mar', 'Apr', 'Maj', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec');

// Some common strings
$lang_yes = 'Ja';
$lang_no  = 'Nej';
$lang_back = 'TILBAGE';
$lang_continue = 'FORTSÆT';
$lang_info = 'Information';
$lang_error = 'Fejl';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%d. %B, %Y';
$lastcom_date_fmt =  '%d/%b/%y kl. %H:%M';
$lastup_date_fmt = '%d. %B, %Y';
$register_date_fmt = '%d. %B, %Y';
$lasthit_date_fmt = '%d. %B, %Y kl. %R';
$comment_date_fmt =  '%d. %B, %Y kl. %R';

// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array( 
        'random' => 'Tilfældige billeder', 
        'lastup' => 'Nyeste billeder', 
        'lastalb'=> 'Sidst opdaterede albums', 
        'lastcom' => 'Nyeste kommentarer', 
        'topn' => 'Mest viste', 
        'toprated' => 'Mest populære', 
        'lasthits' => 'Sidst viste', 
        'search' => 'Søge resultat', 
        'favpics'=> 'Foretrukne billeder', 
); 

$lang_errors = array(
	'access_denied' => 'Du har ikke tilladelse til at se denne side.',
	'perm_denied' => 'Du har ikke tilladelse til at udføre denne handling.',
	'param_missing' => 'Script kaldt uden de nødvendige parametre(r).',
	'non_exist_ap' => 'Det valgte album/billede eksister ikke !',
	'quota_exceeded' => 'Disk mængden overskredet<br /><br />Du har plads til en [quota]K, Dine billeder bruger aktuelt [space]K, tilføjelse af dette billede medfører en overskridelse af din tilladte mængde.',
	'gd_file_type_err' => 'Når der anvendes GD billedeteknink, er tilladte typer kun JPEG og PNG.',
	'invalid_image' => 'Billedet som du har uploadet er defekt eller kan ikke bruges med GD billedeteknik',
	'resize_failed' => 'Ej muligt at oprette minibillede eller mellem stort billede.',
	'no_img_to_display' => 'Intet billede at vise',
	'non_exist_cat' => 'Den valgte kategori findes ikke',
	'orphan_cat' => 'En kategori har ikke et tilhørsforhold, kør kategori manager for at rette problemet.',
	'directory_ro' => 'Mappen \'%s\' er skrivebeskyttet, billeder kan ikke slettes',
	'non_exist_comment' => 'Den valgte kommentar findes ikke.',
	'pic_in_invalid_album' => 'Billede er i et ikke eksisterende album (%s)!?',
        'banned' => 'Din adgang til denne side er spærret.', 
        'not_with_udb' => 'Denne funktion er deaktiveret i Coppermine da den er integreret med forum software. Enten er det du ønsker at gøre ikke understøttet i denne opsætning eller også skal det gøres vha. forum software.', 
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => 'Gå til albumlisten',
	'alb_list_lnk' => 'Albumliste',
	'my_gal_title' => 'Gå til personligt galleri',
	'my_gal_lnk' => 'Mit galleri',
	'my_prof_lnk' => 'Min profil',
	'adm_mode_title' => 'Skift til admin mode',
	'adm_mode_lnk' => 'Admin mode',
	'usr_mode_title' => 'Skift til bruger mode',
	'usr_mode_lnk' => 'Bruger mode',
	'upload_pic_title' => 'Upload et billede til album',
	'upload_pic_lnk' => 'Upload billede',
	'register_title' => 'Opret en konto',
	'register_lnk' => 'Registrer',
	'login_lnk' => 'Log ind',
	'logout_lnk' => 'Log ud',
	'lastup_lnk' => 'Nyeste uploads',
	'lastcom_lnk' => 'Nyeste kommentar',
	'topn_lnk' => 'Mest viste',
	'toprated_lnk' => 'Top karakter',
	'search_lnk' => 'Søg',
	'fav_lnk'=>'Foretrukne',
);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => 'Upload til godkendelse',
	'config_lnk' => 'Opsætning',
	'albums_lnk' => 'Album',
	'categories_lnk' => 'Kategorier',
	'users_lnk' => 'Bruger',
	'groups_lnk' => 'Grupper',
	'comments_lnk' => 'Kommentarer',
	'searchnew_lnk' => 'Masse tilføj billede',
        'util_lnk' => 'Ændre billedstørrelse',
        'ban_lnk' => 'Bloker brugere', 
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => 'Opret / ordne albums',
	'modifyalb_lnk' => 'Ret i mit album',
	'my_prof_lnk' => 'Min profil',
);

$lang_cat_list = array(
	'category' => 'Kategori',
	'albums' => 'Album',
	'pictures' => 'Billeder',
);

$lang_album_list = array(
	'album_on_page' => '%d album på %d side(r)'
);

$lang_thumb_view = array(
	'date' => 'DATO',
        //Sort by filename and title
	'name' => 'FILNAVN',
        'title' => 'TITEL',
	'sort_da' => 'Sorter stigende efter dato',
	'sort_dd' => 'Sorter faldende efter dato',
	'sort_na' => 'Sorter stigende efter navn',
	'sort_nd' => 'Sorter faldende efter navn',
        'sort_ta' => 'Sorter stigende efter titel',
        'sort_td' => 'Sorter faldende efter titel',
	'pic_on_page' => '%d billeder på %d side(r)',
	'user_on_page' => '%d brugere på %d side(r)',
);

$lang_img_nav_bar = array(
	'thumb_title' => 'Retur til oversigt',
	'pic_info_title' => 'Vis/skjul billede information',
	'slideshow_title' => 'Slideshow',
	'ecard_title' => 'Send dette billede som et e-postkort',
	'ecard_disabled' => 'E-postkort er slået fra',
	'ecard_disabled_msg' => 'Du har ikke tilladelse til at sende e-postkort',
	'prev_title' => 'Se forrige billede',
	'next_title' => 'Se næste billede',
	'pic_pos' => 'BILLEDE %s/%s',
);

$lang_rate_pic = array(
	'rate_this_pic' => 'Bedøm dette billede ',
	'no_votes' => '(Ej bedømt endnu)',
	'rating' => '(Aktuel karakter: %s / 5 med %s stemmer)',
	'rubbish' => 'Dårligt',
	'poor' => 'Ringe',
	'fair' => 'Rimeligt',
	'good' => 'Godt',
	'excellent' => 'Rigtig godt',
	'great' => 'Fantastisk',
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
	CRITICAL_ERROR => 'Kritisk fejl',
	'file' => 'Fil: ',
	'line' => 'Linje: ',
);

$lang_display_thumbnails = array(
	'filename' => 'Filnavn : ',
	'filesize' => 'Filstørrelse : ',
	'dimensions' => 'Dimensioner : ',
	'date_added' => 'Tilføjet dato : ',
);

$lang_get_pic_data = array(
	'n_comments' => '%s kommentarer',
	'n_views' => '%s visninger',
	'n_votes' => '(%s stemmer)',
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
	'Exclamation' => 'Udråb',
	'Question' => 'Spørgsmål',
	'Very Happy' => 'Meget glad',
	'Smile' => 'Smil',
	'Sad' => 'Trist',
	'Surprised' => 'Overrasket',
	'Shocked' => 'Chokeret',
	'Confused' => 'Forvirret',
	'Cool' => 'Sejt',
	'Laughing' => 'Griner',
	'Mad' => 'Sur',
	'Razz' => 'Drille',
	'Embarassed' => 'Genert',
	'Crying or Very sad' => 'Græder eller meget trist',
	'Evil or Very Mad' => 'Ond eller meget sur',
	'Twisted Evil' => 'Lusket ond',
	'Rolling Eyes' => 'Ruller med øjne',
	'Wink' => 'Vinker',
	'Idea' => 'God ide',
	'Arrow' => 'Pil',
	'Neutral' => 'Neutral',
	'Mr. Green' => 'Hr. Grøn',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
	0 => 'Forlader admin mode...',
	1 => 'Logger ind som admin...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => 'Album skal have et navn!',
	'confirm_modifs' => 'Er du sikker på at du vil lave disse ændringer?',
	'no_change' => 'Du lavede ingen ændringer!',
	'new_album' => 'Nyt album',
	'confirm_delete1' => 'Er du sikker på du vil slette dette album?',
	'confirm_delete2' => '\nAlle billeder og kommentarer forsvinder!',
	'select_first' => 'Vælg først et album',
	'alb_mrg' => 'Album Manager',
	'my_gallery' => '* Mit galleri *',
	'no_category' => '* Ingen kategori *',
	'delete' => 'Slet',
	'new' => 'Ny',
	'apply_modifs' => 'Godkend rettelser',
	'select_category' => 'Vælg kategori',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => 'Parameter Parameters obligatorisk ved \'%s\'operation ej udført!',
	'unknown_cat' => 'Valgte kategori eksister ikke i databasen',
	'usergal_cat_ro' => 'Bruger galleri kategorien kan ikke slettes!',
	'manage_cat' => 'Administrer kategorier',
	'confirm_delete' => 'Er du sikker på du ønsker at SLETTE denne kategori',
	'category' => 'Kategori',
	'operations' => 'Handling',
	'move_into' => 'Flyt til',
	'update_create' => 'Opdater/Opret kategori',
	'parent_cat' => 'Hoved kategori',
	'cat_title' => 'Kategori titel',
	'cat_desc' => 'Kategori beskrivelse',
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => 'Konfiguration',
	'restore_cfg' => 'Genskab standard indstillinger',
	'save_cfg' => 'Gem ny opsætning',
	'notes' => 'Noter',
	'info' => 'Information',
	'upd_success' => 'Coppermine opsætning er opdateret',
	'restore_success' => 'Coppermine standard opsætning er genskabt',
	'name_a' => 'Navn stigende',
	'name_d' => 'Navn faldende',
        'title_a' => 'Titel stigende',
        'title_d' => 'Titel faldende',
	'date_a' => 'Dato stigende',
	'date_d' => 'Dato faldende',,
        'th_any' => 'Max Aspect',
        'th_ht' => 'Height',
        'th_wd' => 'Width',
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'Generelle indstillinger',
	array('Galleri navn', 'gallery_name', 0),
	array('Galleri beskrivelse', 'gallery_description', 0),
	array('Galleri administrator e-mail', 'gallery_admin_email', 0),
	array('Mål adressen for \'Se flere billeder\' link i e-postkort', 'ecards_more_pic_target', 0),
	array('Sprog', 'lang', 5),
	array('Tema', 'theme', 6),

	'Albumsliste visning',
	array('Bredde på hoved tabellen (pixels eller %)', 'main_table_width', 0),
	array('Antal af trin i kategorier for fremvisning', 'subcat_level', 0),
	array('Antal af album til fremvisning', 'albums_per_page', 0),
	array('Antal af kolonner for albumliste', 'album_list_cols', 0),
	array('Størrelse af minibilleder i pixels', 'alb_list_thumb_size', 0),
	array('Indholdet af hovedsiden', 'main_page_layout', 0),
        array('Vis øverste album niveaus minibilleder i kategorier','first_level',1),

	'Minibillede visning',
	array('Antal kolonner på minibillede siden', 'thumbcols', 0),
	array('Antal rækker på minibillede siden', 'thumbrows', 0),
	array('Max antal minibilleder pr side', 'max_tabs', 0),
	array('Vis billedeoverskriften (i tilføjelse til titel) nedenfor minibillede', 'caption_in_thumbview', 1),
	array('Vis antal af kommentarer nedenfor minibilledet', 'display_comment_count', 1),
	array('Standard sortering af billeder', 'default_sort_order', 3),
	array('Min antal stemmer for billede før visning i \'top karakter\' listen', 'min_votes_for_rating', 0),

	'Billedevisning &amp; Kommentar indstillinger',
	array('Bredde for tabellen til visning af billeder (pixels eller %)', 'picture_table_width', 0),
	array('Billede information er synlig som standard', 'display_pic_info', 1),
	array('Filtrer bande ord i kommentarer', 'filter_bad_words', 1),
	array('Tillad smilies i kommentarer', 'enable_smilies', 1),
	array('Max længde for billedbeskrivelse', 'max_img_desc_length', 0),
	array('Max længde på et ord', 'max_com_wlength', 0),
	array('Max antal linjer i en kommentar', 'max_com_lines', 0),
	array('Maximum længde på en kommentar', 'max_com_size', 0),
        array('Vis film rulle', 'display_film_strip', 1),
        array('Antal emner i film rulle', 'max_film_strip_items', 0),

	'Billede og minibillede indstillinger',
	array('Kvalitet for JPEG billeder', 'jpeg_qual', 0),
	array('Maks. dimension på minibilleder <b>*</b>', 'thumb_width', 0),
        array('Brug dimension ( bredde, højde eller maksimum af de to til minibilleder )<b>*</b>', 'thumb_use', 7),
	array('Opret mellemstore billeder','make_intermediate',1),
	array('Max bredde eller højde for et mellemstort billede <b>*</b>', 'picture_width', 0),
	array('Max størrelse for uploadet billeder (KB)', 'max_upl_size', 0),
	array('Max bredde eller højde for uploadet billeder (pixels)', 'max_upl_width_height', 0),

	'Bruger indstillinger',
	array('Tillad registrering af nye brugere', 'allow_user_registration', 1),
	array('Forlang e-mail godkendelse ved registrering', 'reg_requires_valid_email', 1),
	array('Tillad to brugere at have samme e-mail adresse', 'allow_duplicate_emails_addr', 1),
	array('Brugere kan have private albums', 'allow_private_albums', 1),

	'Brugerdefinerede felter til billedbeskrivelse (lad det forblive blanke, hvis ikke de skal bruges)',
	array('Felt 1 navn', 'user_field1_name', 0),
	array('Felt 2 navn', 'user_field2_name', 0),
	array('Felt 3 navn', 'user_field3_name', 0),
	array('Felt 4 navn', 'user_field4_name', 0),

	'Avancerede billede og minibillede indstillinger',
        array('Vis ikon for private album for anononyme brugere','show_private',1),
	array('Forbudte karakterer i filnavne', 'forbiden_fname_char',0),
	array('Accepterede filtyper for uploadede billeder', 'allowed_file_extensions',0),
	array('Program til skalering af billeder','thumb_method',2),
	array('Sti til ImageMagick \'konveter\' værktøj (eksempel /usr/bin/X11/)', 'impath', 0),
	array('Tillad billedetyper (kun aktiv ved brug af ImageMagick)', 'allowed_img_types',0),
	array('Kommandolinje indstillinger ved brug af ImageMagick', 'im_options', 0),
	array('Læs EXIF data i JPEG filer', 'read_exif_data', 1),
	array('Album mappen <b>*</b>', 'fullpath', 0),
	array('Mappen for bruger billeder <b>*</b>', 'userpics', 0),
	array('Foranstillet navn på mellembilleder <b>*</b>', 'normal_pfx', 0),
	array('Foranstillet navn på minibilleder <b>*</b>', 'thumb_pfx', 0),
	array('Standard tilstand på mapper', 'default_dir_mode', 0),
	array('standard tilstand på billeder', 'default_file_mode', 0),

	'Cookies &amp; tegn-kodnings indstillinger',
	array('Navn på cookie brugt af dette system', 'cookie_name', 0),
	array('Stien til cookie brugt at dette system', 'cookie_path', 0),
	array('Tegn-kodning', 'charset', 4),

	'Avancerede indstillinger',
	array('Aktiver fejlfindings tilstand', 'debug_mode', 1),
	
	'<br /><div align="center">(*) Felter markeret med * skal skiftes hvis du allerede har billeder i dit galleri</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => 'Du skal indtaste dit navn og en kommentar',
	'com_added' => 'Din kommentar blev tilføjet',
	'alb_need_title' => 'Du skal angive en titel for dit album!',
	'no_udp_needed' => 'Der var ikke behov for en opdatering.',
	'alb_updated' => 'Albummet blev opdateret',
	'unknown_album' => 'Det valgte album eksisterer ikke eller du har ikke rettigheder til at uploade til det',
	'no_pic_uploaded' => 'Der blev ikke uploadet noget billede !<br /><br />Hvis du valgte et billede at uploade så kontroller at serveren tillader fil upload...',
	'err_mkdir' => 'Kunne ikke oprette denne mappe: %s !',
	'dest_dir_ro' => 'Destinations mappen %s er ikke skrivbar af dette script !',
	'err_move' => 'Kunne ikke flytte %s til %s !',
	'err_fsize_too_large' => 'Det billede du har uploadet er for stort (max tilladte størrelse er %s x %s) !',
	'err_imgsize_too_large' => 'Den fil du har uploadet er for stor (max tilladte filstørrelse er %s KB) !',
	'err_invalid_img' => 'Filen du har uploadet er ikke et gyldigt billede!',
	'allowed_img_types' => 'Du kan kun uploade %s billeder.',
	'err_insert_pic' => 'Billedet \'%s\' kunne ikke indsættes i albummet ',
	'upload_success' => 'Dit billede blev uploadet med success<br /><br />Det er synligt når en administrator har godkendt det.',
	'info' => 'Information',
	'com_added' => 'Kommentar tilføjet',
	'alb_updated' => 'Album opdateret',
	'err_comment_empty' => 'Din kommentar er tom !',
	'err_invalid_fext' => 'Kun filer med følgende endelser er gyldige : <br /><br />%s.',
	'no_flood' => 'Desværre, men du er stadig den seneste der har kommenteret dette billede<br /><br />Rediger kommentaren hvis du vil ændre den',
	'redirect_msg' => 'Du bliver viderestillet.<br /><br /><br />Tryk på \'FORTSÆT\' hvis siden ikke opdateres automatisk',
	'upl_success' => 'Dit billede blev tilføjet med succes',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => 'Overskrift',
	'fs_pic' => 'Fuld størrelse billede',
	'del_success' => 'Slettet',
	'ns_pic' => 'Mellem størrelse billede',
	'err_del' => 'Kan ikke slettes',
	'thumb_pic' => 'Minibillede',
	'comment' => 'Kommentar',
	'im_in_alb' => 'Billede i album',
	'alb_del_success' => 'Album \'%s\' slettet',
	'alb_mgr' => 'Album Administrator',
	'err_invalid_data' => 'Forkert data modtaget i \'%s\'',
	'create_alb' => 'Opretter album \'%s\'',
	'update_alb' => 'Opdaterer album \'%s\' med titel \'%s\' og index \'%s\'',
	'del_pic' => 'Slet billede',
	'del_alb' => 'Slet album',
	'del_user' => 'Slet bruger',
	'err_unknown_user' => 'Den valgte bruger findes ikke !',
	'comment_deleted' => 'Kommentaren blev slettet',
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
	'confirm_del' => 'Er du sikker på du ønsker at SLETTE dette billede? \\nKommentarer bliver også slettet.',
	'del_pic' => 'SLET DETTE BILLEDE',
	'size' => '%s x %s pixels',
	'views' => '%s gange',
	'slideshow' => 'Slideshow',
	'stop_slideshow' => 'STOP SLIDESHOW',
	'view_fs' => 'Klik for at se fuld størrelse billede',
);

$lang_picinfo = array(
	'title' =>'Billede information',
	'Filename' => 'Filnavn',
	'Album name' => 'Album navn',
	'Rating' => 'Karakter (%s stemmer)',
	'Keywords' => 'Nøgleord',
	'File Size' => 'Filstørrelse',
	'Dimensions' => 'Dimensioner',
	'Displayed' => 'Vist',
	'Camera' => 'Kamera',
	'Date taken' => 'Optaget dato',
	'Aperture' => 'Blænderåbning',
	'Exposure time' => 'Eksponeringstid ',
	'Focal length' => 'Brændvidde',
	'Comment' => 'Kommentar',
	'addFav'=>'Føj til foretrukne',
	'addFavPhrase'=>'Foretrukne',
	'remFav'=>'Fjern fra foretrukne',
);

$lang_display_comments = array(
	'OK' => 'OK',
	'edit_title' => 'Ret denne kommentar',
	'confirm_delete' => 'Er du sikker på at du vil slette denne kommentar?',
	'add_your_comment' => 'Tilføj din kommentar',
        'name'=>'Navn',
        'comment'=>'Kommentar',
	'your_name' => 'Anonym',
);

$lang_fullsize_popup = array(
        'click_to_close' => 'Klik på billedet for at lukke dette vindue',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => 'Send et e-postkort',
	'invalid_email' => '<b>Advarsel</b>: ugyldig e-mail adresse!',
	'ecard_title' => 'Et e-postkort fra %s til dig',
	'view_ecard' => 'Hvis kortet ikke vises korrekt, klik her',
	'view_more_pics' => 'Klik på dette link for at se flere billeder!',
	'send_success' => 'Dit e-postkort blev sendt',
	'send_failed' => 'Beklager men serveren kan ikke sende dit e-postkort...',
	'from' => 'Fra',
	'your_name' => 'Dit navn',
	'your_email' => 'Din e-mail adresse',
	'to' => 'Til',
	'rcpt_name' => 'Modtagers navn',
	'rcpt_email' => 'Modtagers e-mail adresse',
	'greetings' => 'Hilsen',
	'message' => 'Besked',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => 'Billede&nbsp;info',
	'album' => 'Album',
	'title' => 'Titel',
	'desc' => 'Beskrivelse',
	'keywords' => 'Nøgleord',
	'pic_info_str' => '%sx%s - %sKB - %s visninger - %s stemmer',
	'approve' => 'Godkend billede',
	'postpone_app' => 'Udskyd godkendelsen',
	'del_pic' => 'Slet billede',
	'reset_view_count' => 'Nulstil tæller',
	'reset_votes' => 'Nulstil afstemning',
	'del_comm' => 'Slet kommentarer',
	'upl_approval' => 'Upload godkendelse',
	'edit_pics' => 'Rediger billeder',
	'see_next' => 'Se næste billede',
	'see_prev' => 'Se forrige billede',
	'n_pic' => '%s billeder',
	'n_of_pic_to_disp' => 'Antal billeder til fremvisning',
	'apply' => 'Tilføj rettelser',
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => 'Gruppe navn',
	'disk_quota' => 'Disk kvote',
	'can_rate' => 'Kan give karakter',
	'can_send_ecards' => 'Kan sende e-postkort',
	'can_post_com' => 'Kan oprette kommentar',
	'can_upload' => 'Kan uploade billeder',
	'can_have_gallery' => 'Kan have privat billede galleri',
	'apply' => 'Tilføj rettelser',
	'create_new_group' => 'Opret ny gruppe',
	'del_groups' => 'Slet valgte gruppe(er)',
	'confirm_del' => 'Advarsel, når du sletter en gruppe, vil brugere tilhørende denne gruppe blive flyttet til gruppen af \'Registrerede\' brugere !\n\nVil du fortsætte?',
	'title' => 'Administrer bruger grupper',
	'approval_1' => 'Offentlig upload godkendelse(1)',
	'approval_2' => 'Privat Upload godkendelse(2)',
	'note1' => '<b>(1)</b> Upload i det offentlige album, kræver admin godkendelse',
	'note2' => '<b>(2)</b> Upload i et album som tilhører brugeren, kræver admin godkendelse',
	'notes' => 'Noter',
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
	'welcome' => 'Velkommen!'
);

$lang_album_admin_menu = array(
	'confirm_delete' => 'Er du sikker på du vil SLETTE dette album? \\nAlle billeder og kommentarer vil også blive slettet.',
	'delete' => 'SLET',
	'modify' => 'REDIGER',
	'edit_pics' => 'REDIGER BILLEDER',
);

$lang_list_categories = array(
	'home' => 'Hjem',
	'stat1' => '<b>[pictures]</b> billeder i <b>[albums]</b> albums og <b>[cat]</b> kategorier med <b>[comments]</b> kommentarer vist <b>[views]</b> gange',
	'stat2' => '<b>[pictures]</b> billeder i <b>[albums]</b> albums vist <b>[views]</b> gange',
	'xx_s_gallery' => '%s\'s Galleri',
	'stat3' => '<b>[pictures]</b> billeder i <b>[albums]</b> albums med <b>[comments]</b> kommentarer vist <b>[views]</b> gange'
);

$lang_list_users = array(
	'user_list' => 'Bruger liste',
	'no_user_gal' => 'Der er ingen bruger gallerier',
	'n_albums' => '%s album(s)',
	'n_pics' => '%s billede(r)'
);

$lang_list_albums = array(
	'n_pictures' => '%s billeder',
	'last_added' => ', sidste tilføjet den %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => 'Log ind',
	'enter_login_pswd' => 'Skriv dig brugernavn og password',
	'username' => 'Brugernavn',
	'password' => 'Password',
	'remember_me' => 'Husk mig',
	'welcome' => 'Velkommen %s ...',
	'err_login' => '*** Kunne ikke logge ind. Prøv igen ***',
	'err_already_logged_in' => 'Du er allerede logget ind !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => 'Logud',
	'bye' => 'Farvel %s ...',
	'err_not_loged_in' => 'Du er ikke logget ind!',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => 'Opdater album %s',
	'general_settings' => 'Generelle indstillinger',
	'alb_title' => 'Album titel',
	'alb_cat' => 'Album kategori',
	'alb_desc' => 'Album beskrivelse',
	'alb_thumb' => 'Album minibillede',
	'alb_perm' => 'Tilladelser for dette album',
	'can_view' => 'Album kan vises af',
	'can_upload' => 'Gæster kan oploade billeder',
	'can_post_comments' => 'Gæster kan skrive kommentarer',
	'can_rate' => 'Gæster kan stemme på billeder',
	'user_gal' => 'Bruger Galleri',
	'no_cat' => '* Ingen kategori *',
	'alb_empty' => 'Album er tomt',
	'last_uploaded' => 'Sidst indsendt',
	'public_alb' => 'Alle (offentligt album)',
	'me_only' => 'Kun mig',
	'owner_only' => 'Album ejer (%s)',
	'groupp_only' => 'Medlemmer af \'%s\' gruppen',
	'err_no_alb_to_modify' => 'Intet album at korrigerer i databasen.',
	'update' => 'Opdater album'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => 'Beklager, men du har allerede stemt på dette billede',
	'rate_ok' => 'Din stemme blev accepteret',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
Mens administratorerne af denne site {SITE_NAME} vil prøve at fjerne eller tilrette alt generelt relevant materiale så hurtigt som muligt, er det umuligt at gennemse alle indlæg. Derfor bør du være opmærksom på at alle indlæg der er lavet til denne site Tilkendegiver meninger og holdninger af de forskellige forfattere og ikke altid administratorernes mening (med undtagelse af de indlæg skrevet af disse) derfor kan disse ikke stille til ansvar for andres indlæg.<br><br>
Du accepterer hermed ikke at indsende anstødelige, vulgære, usmagelige, hadefulde, truende, sex-relaterede eller andet materiale der er i strid med lovgivningen. Du accepterer hermed at webmaster, administratorerne af {SITE_NAME} har lov til at fjerne eller rette i indholdet til enhver tid. Som bruger accepterer du at alle dine oplysninger bliver gemt i en database. Men dine informationer bliver ikke givet videre til andre uden din accept. Administratorerne kan ikke kræves til ansvar overfor hackerforsøg der eventuelt kan føre til videregivelse af dine oplysninger.<br><br>
Denne site bruger cookies til at gemme informationer på din private computer. Disse cookies tjener kun det formål at forbedre billedkvaliteten. Denne e-mail bekræfter din registrering, detaljer og password.<br>
Ved at klikke på "jeg accepterer" knappen forneden acceptere du ovenstående betingelser
EOT;

$lang_register_php = array(
	'page_title' => 'Bruger registrering',
	'term_cond' => 'Regler og betingelser',
	'i_agree' => 'Jeg er enig',
	'submit' => 'Send registrering',
	'err_user_exists' => 'Brugernavnet du har skrevet findes allerede, vælge venligst et andet',
	'err_password_mismatch' => 'de to password er ikke ens, prøv igen',
	'err_uname_short' => 'Brugernavn skal være på mindst 2 karakterer',
	'err_password_short' => 'Password skal være på mindst 2 karakterer',
	'err_uname_pass_diff' => 'Brugernavn og password skal være forskellige',
	'err_invalid_email' => 'E-mail adresse er ugyldig',
	'err_duplicate_email' => 'En anden bruger er allerede registret med den e-mail du har opgivet',
	'enter_info' => 'Angiv registrerings information',
	'required_info' => 'Information forlanges',
	'optional_info' => 'Information er valgfri',
	'username' => 'Brugernavn',
	'password' => 'Password',
	'password_again' => 'gentag password',
	'email' => 'E-mail',
	'location' => 'Sted',
	'interests' => 'Interesser',
	'website' => 'Hjemmeside',
	'occupation' => 'Beskæftigelse',
	'error' => 'FEJL',
	'confirm_email_subject' => '%s - Registrerings godkendelse ',
	'information' => 'Information',
	'failed_sending_email' => 'Registrerings godkendelsen kan ikke sendes!',
	'thank_you' => 'Tak for din registrering.<br /><br />En e-mail med informationer om hvordan du aktiver din konto, er blevet sendt til den adresse som du har angivet.',
	'acct_created' => 'Din konto er blevet oprettet og du kan nu logge ind med dit brugernavn og password',
	'acct_active' => 'Din konto er nu aktiv og du kan logge ind med dit brugernavn og password',
	'acct_already_act' => 'Din konto er allerede aktiv!',
	'acct_act_failed' => 'Denne konto kan ikke blive aktiveret!',
	'err_unk_user' => 'Valgte bruger eksister ikke!',
	'x_s_profile' => '%s\'s profil',
	'group' => 'Gruppe',
	'reg_date' => 'Tilsluttet',
	'disk_usage' => 'Disk behandling',
	'change_pass' => 'Skift password',
	'current_pass' => 'Nuværende password',
	'new_pass' => 'Nyt password',
	'new_pass_again' => 'Nyt password igen',
	'err_curr_pass' => 'Nuværende password er forkert',
	'apply_modif' => 'Tilføj rettelser',
	'change_pass' => 'Skift mit password',
	'update_success' => 'Din profil blev opdateret',
	'pass_chg_success' => 'Dit password blev ændret',
	'pass_chg_error' => 'Dit password blev ikke ændret',
);

$lang_register_confirm_email = <<<EOT
Tak for din registrering hos {SITE_NAME}

Dit brugernavn er : "{USER_NAME}"
Dit password er : "{PASSWORD}"

Som led i at aktiver din konto, skal du klikke på linket her under
eller kopier og indsætte det i din web browser.

{ACT_LINK}

Mange hilsner,

{SITE_NAME} - Administrationen

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => 'Kommentar overblik',
	'no_comment' => 'Der er ingen kommentar at se tilbage på',
	'n_comm_del' => '%s kommentar(er) slettet',
	'n_comm_disp' => 'Antal af kommentarer at vise',
	'see_prev' => 'Se foregående',
	'see_next' => 'Se næste',
	'del_comm' => 'Slet valgte kommentarer',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => 'Søg i billede samlingen',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => 'Søg i nye billeder',
	'select_dir' => 'Vælg mappe',
	'select_dir_msg' => 'Denne funktion tillader dig at massetilføje de billeder som du har uploadet via FTP.<br /><br />Vælg den mappe hvor du har uploadet dine billeder',
	'no_pic_to_add' => 'Der er intet billede at tilføje',
	'need_one_album' => 'Du skal have mindst et album oprettet, for at bruge denne funktion',
	'warning' => 'Advarsel',
	'change_perm' => 'systemet kan ikke skrive i dette mappe, du skal ændre server rettigheder på denne mappe til 755 or 777 før du prøver at tilføje billeder !',
	'target_album' => '<b>Anbring billeder af &quot;</b>%s<b>&quot; til </b>%s',
	'folder' => 'Folder',
	'image' => 'Billede',
	'album' => 'Album',
	'result' => 'Resultat',
	'dir_ro' => 'Ej skrivebar. ',
	'dir_cant_read' => 'Ej læsebar. ',
	'insert' => 'Tilføje nye billeder til galleriet',
	'list_new_pic' => 'Liste af nye billeder',
	'insert_selected' => 'Indsæt valgte billeder',
	'no_pic_found' => 'Ingen nye billeder blev fundet',
	'be_patient' => 'Hav lidt tålmodighed, systemet arbejder på at tilføje billederne',
	'notes' =>  '<ul>'.
				'<li><b>OK</b> : Betyder at billedet blev tilføjet'.
				'<li><b>DP</b> : Betyder at billedet er en duplikat og det allerede ligger i databasen'.
				'<li><b>PB</b> : Betyder at billedet ikke kunne tilføjes, kontrollerer venligst din konfiguration samt tilladelser på de respektive mapper'.
				'<li>Hvis OK, DP, PB \'signalet\' ikke kommer frem, klik da på de manglede billeder for at se om der da fremkommer nogle fejlmeddelelser som frembringes af PHP'.
				'<li>Hvis din browser laver time-out, da opdater den browser'.
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
                'title' => 'Bloker brugere', 
                'user_name' => 'Bruger navn', 
                'ip_address' => 'IP Adresse', 
                'expiry' => 'Udløber (efterlad tom for aldrig)', 
                'edit_ban' => 'Gem ændringer', 
                'delete_ban' => 'Slet', 
                'add_new' => 'Tilføj ny blokering', 
                'add_ban' => 'Tilføj', 
); 

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
	'title' => 'Upload billede',
	'max_fsize' => 'Max tilladte filstørrelse er sat til %s KB',
	'album' => 'Album',
	'picture' => 'Billede',
	'pic_title' => 'Billede titel',
	'description' => ' Billede beskrivelse',
	'keywords' => 'Nøgleord (Adskil med mellemrum)',
	'err_no_alb_uploadables' => 'Beklager der er intet album, som du har tilladelse til at uploade billeder til',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => 'Administrer bruger',
	'name_a' => 'Navn stigende',
	'name_d' => 'Navn faldende',
	'group_a' => 'Gruppe stigende',
	'group_d' => 'Gruppe faldende',
	'reg_a' => 'Reg dato stigende',
	'reg_d' => 'Reg dato faldende',
	'pic_a' => 'Billede tæller stigende',
	'pic_d' => 'Billede tæller faldende',
	'disku_a' => 'Disk behandling stigende',
	'disku_d' => 'Disk behandling faldende',
	'sort_by' => 'Sorter brugere efter',
	'err_no_users' => 'Bruger tabel er tom!',
	'err_edit_self' => 'Du kan ikke rette i egen profil, brug \'Min profil\' link til dette formål',
	'edit' => 'RET',
	'delete' => 'SLET',
	'name' => 'Brugernavn',
	'group' => 'Gruppe',
	'inactive' => 'Inaktiv',
	'operations' => 'Handlinger',
	'pictures' => 'Billeder',
	'disk_space' => 'Plads brugt / Kvote',
	'registered_on' => 'Registreret den',
	'u_user_on_p_pages' => '%d bruger på %d side(r)',
	'confirm_del' => 'Er du sikker på du vil SLETTE denne bruger? \\nAlle billeder og albums vil også blive slettet.',
	'mail' => 'POST',
	'err_unknown_user' => 'Valgt bruger eksister ikke!',
	'modify_user' => 'Rediger bruger',
	'notes' => 'Noter',
	'note_list' => '<li>Hvis du ikke vil rette det aktuelle password, så lad feltet "password" stå tomt',
	'password' => 'Password',
	'user_active' => 'Bruger er aktiv',
	'user_group' => 'Brugers gruppe',
	'user_email' => 'Brugers e-mail',
	'user_web_site' => 'Brugers webside',
	'create_new_user' => 'Opret ny bruger',
	'user_location' => 'Brugers placering',
	'user_interests' => 'Brugers interesser',
	'user_occupation' => 'Brugers beskæftigelse',
);

// ------------------------------------------------------------------------- // 
// File util.php 
// ------------------------------------------------------------------------- // 

if (defined('UTIL_PHP')) $lang_util_php = array( 
        'title' => 'Ændre størrelse på billeder', 
        'what_it_does' => 'Gør dette', 
        'what_update_titles' => 'Opdater titler fra filnavn', 
        'what_delete_title' => 'Slet titler', 
        'what_rebuild' => 'Genskab minibilleder og mellemstore billeder', 
        'what_delete_originals' => 'Sletter billeder med original størrelse og erstatter dem med de mellemstore billeder', 
        'file' => 'Fil', 
        'title_set_to' => 'titel sat til', 
        'submit_form' => 'Udfør', 
        'updated_succesfully' => 'opdateret med succes', 
        'error_create' => 'FEJL ved oprettelse af', 
        'continue' => 'Fortsæt', 
        'main_success' => 'Filen %s bliver nu brugt som original billede', 
        'error_rename' => 'Fejl da filen skulle omdøbes fra %s til %s', 
        'error_not_found' => 'Filen %s blev ikke fundet', 
        'back' => 'tilbage til hovedmenu', 
        'thumbs_wait' => 'Opdaterer minibilleder og/eller mellemstore billeder, vent venligst...', 
        'thumbs_continue_wait' => 'Fortsætter med opdatering af minibilleder og/eller mellemstore billeder...', 
        'titles_wait' => 'Opdaterer titler, vent venligst...', 
        'delete_wait' => 'Slettet titler, vent venligst...', 
        'replace_wait' => 'Sletter originale billeder og erstatter dem med de mellemstore, vent venligst...', 
        'instruction' => 'Hurtig manual', 
        'instruction_action' => 'Vælg funktion', 
        'instruction_parameter' => 'Indstil parametre', 
        'instruction_album' => 'Vælg album', 
        'instruction_press' => 'Tryk %s', 
        'update' => 'Opdater minibilleder og/eller mellemstore billeder', 
        'update_what' => 'Hvad skal opdateres', 
        'update_thumb' => 'Kun minibilleder', 
        'update_pic' => 'Kun mellemstore billeder', 
        'update_both' => 'Både mini- og mellemstore billeder', 
        'update_number' => 'Antal behandlede billeder pr. klik', 
        'update_option' => '(Prøv at sætte den værdi lavere hvis du oplever timeout fejl)', 
        'filename_title' => 'Filnavn -> Billed titel', 
        'filename_how' => 'Hvordan skal filnavnet modificeres', 
        'filename_remove' => 'Fjern .jpg endelsen og erstat _ (underscore) med mellemrum', 
        'filename_euro' => 'Omdøb 2003_11_23_13_20_20.jpg til 23/11/2003 13:20', 
        'filename_us' => 'Omdøb 2003_11_23_13_20_20.jpg til 11/23/2003 13:20', 
        'filename_time' => 'Omdøb 2003_11_23_13_20_20.jpg til 13:20', 
        'delete' => 'Slet titler eller original størrelse billeder', 
        'delete_title' => 'Slet billede titler', 
        'delete_original' => 'Slet original størrelse billeder', 
        'delete_replace' => 'Sletter de originale billeder og erstatter dem med de mellemstore', 
        'select_album' => 'Vælg album', 
); 

?>
