<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.3.0                                            //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002,2003 Gregory DEMAR                                     //
// http://www.chezgreg.net/coppermine/                                       //
// ------------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                        //
// (http://coppermine.sf.net/team/)                                          //
// see /docs/credits.html for details                                        //
// ------------------------------------------------------------------------- //
// This program is free software; you can redistribute it and/or modify      //
// it under the terms of the GNU General Public License as published by      //
// the Free Software Foundation; either version 2 of the License, or         //
// (at your option) any later version.                                       //
// ------------------------------------------------------------------------- //
// ENCODING CHECK; SHOULD BE YEN BETA MU: � � �
// ------------------------------------------------------------------------- //
/*
$Id: swedish.php,v 1.9 2004/12/29 23:06:37 chtito Exp $
*/

// info about translators and translated language
$lang_translation_info = array(
  'lang_name_english' => 'Swedish',
  'lang_name_native' => 'Svenska',
  'lang_country_code' => 'se',
  'trans_name'=> 'Musicalg and JMG',
  'trans_email' => 'musikalgalning@yahoo.se',
  'trans_website' => 'fotoalbum.jimmysvensson.com',
  'trans_date' => '2004-06-23',
);

$lang_charset = 'iso-8859-1';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('S�n', 'M�n', 'Tis', 'Ons', 'Tors', 'Fre', 'L�r');
$lang_month = array('Jan', 'Feb', 'Mar', 'Apr', 'Maj', 'Jun', 'Jul', 'Aug', 'Sept', 'Okt', 'Nov', 'Dec');

// Some common strings
$lang_yes = 'Ja';
$lang_no  = 'Nej';
$lang_back = 'TILLBAKA';
$lang_continue = 'FORTS�TT';
$lang_info = 'Information';
$lang_error = 'Fel';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%d %B %Y';
$lastcom_date_fmt =  '%d %B %Y %H:%M'; //cpg1.3.0
$lastup_date_fmt = '%d %B %Y';
$register_date_fmt = '%d %B %Y';
$lasthit_date_fmt = '%d %B %Y %H:%M'; //cpg1.3.0
$comment_date_fmt =  '%d %B %Y %H:%M'; //cpg1.3.0

// For the word censor
$lang_bad_words = array('*knulla*', 'fitta', 'arsle', 'kuk', 'mutta', 'fan', 'helvete', 'blatte', 'nigger', 'svarting', 'nasse', 'r�v', 'ollon', 'dildo', 'fanculo', 'pattar', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array(
  'random' => 'Slumpm�ssiga objekt', //cpg1.3.0
  'lastup' => 'Senast inlagda',
  'lastalb'=> 'Senast uppdaterade album',
  'lastcom' => 'Senaste kommentarer',
  'topn' => 'Mest visade',
  'toprated' => 'Topplista',
  'lasthits' => 'Senast visade',
  'search' => 'S�kresultat',
  'favpics'=> 'Mina Favoriter', //cpg1.3.0
);

$lang_errors = array(
  'access_denied' => 'Du har inte beh�righet till den h�r sidan.',
  'perm_denied' => 'Du �r inte beh�righet att utf�ra denna operation.',
  'param_missing' => 'Parametrar saknars f�r att kunna utf�ra operationen.',
  'non_exist_ap' => 'Det valda objektet finns inte', //cpg1.3.0
  'quota_exceeded' => 'Tilldelat diskutrymme �verskridet<br /><br />Du har ett diskutrymme p� [quota]K och ditt objekt �r p� [space]K. Skulle detta objekt l�ggas till �verskrids ditt diskutrymme.', //cpg1.3.0
  'gd_file_type_err' => 'Vid anv�ndande av GD image library �r endast bilder i JPEG- och PNG-format till�tna.',
  'invalid_image' => 'Bilden du laddade upp �r skadad eller kan inte hanteras av GD image library',
  'resize_failed' => 'Kan inte skapa miniatyr eller �ndra storleken p� objektet.',
  'no_img_to_display' => 'Inget objekt att visa',
  'non_exist_cat' => 'Den valda kategorin finns inte',
  'orphan_cat' => 'En kategori saknar root, k�r category manager f�r att r�tta till problemet', //cpg1.3.0
  'directory_ro' => 'Du saknar r�ttigheter i biblioteket \'%s\'. Objektet kan inte raderas.', //cpg1.3.0
  'non_exist_comment' => 'Den valda kommentaren finns inte.',
  'pic_in_invalid_album' => 'Objektet finns i ett icke existerande album (%s)!?', //cpg1.3.0
  'banned' => 'Du �r f�r tillf�llet blockerad fr�n den h�r sajten.',
  'not_with_udb' => 'Den h�r funktionen �r inaktiverad i Commermine eftersom den �r integrerad med forumets mjukvara. Antingen st�ds inte det du f�rs�ker g�ra i den h�r funktionen eller s� funktionen hanteras av forumets mjukvara..',
  'offline_title' => 'Ej online', //cpg1.3.0
  'offline_text' => 'Biblioteket �r f�r tillf�llet inte online - f�rs�k igen om en stund', //cpg1.3.0
  'ecards_empty' => 'Det finns f�r tillf�llet inte n�gra e-vykort att visa. Kontrollera att du aktiverat e-vykort i Coppermines inst�llningar!', //cpg1.3.0
  'action_failed' => 'Uppgiften misslyckades.  Coppermine kan inte utf�ra �nskad uppgift.', //cpg1.3.0
  'no_zip' => 'Filerna som beh�vs f�r att hantera ZIP-filer kan inte hittas.  Kontakta Coppermineadministrat�ren.', //cpg1.3.0
  'zip_type' => 'Du har inte beh�righet att ladda upp ZIP-filer.', //cpg1.3.0
);

$lang_bbcode_help = 'F�ljande tags kan anv�ndas: <li>[b]<b>Fetstil</b>[/b]</li> <li>[i]<i>Kursiverad</i>[/i]</li> <li>[url=http://dinsajt.com/]Url Text[/url]</li> <li>[email]anv�ndare@dom�n.com[/email]</li>'; //cpg1.3.0

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
  'alb_list_title' => 'G� till albumlistan',
  'alb_list_lnk' => 'Albumlista',
  'my_gal_title' => 'G� till mitt privata galleri',
  'my_gal_lnk' => 'Mitt galleri',
  'my_prof_lnk' => 'Min profil',
  'adm_mode_title' => 'V�xla till adminl�ge',
  'adm_mode_lnk' => 'Adminl�ge',
  'usr_mode_title' => 'V�xla till anv�ndarl�ge',
  'usr_mode_lnk' => 'Anv�ndarl�ge',
  'upload_pic_title' => 'Ladda upp objekt till album', //cpg1.3.0
  'upload_pic_lnk' => 'Ladda upp objekt', //cpg1.3.0
  'register_title' => 'Skapa nytt konto',
  'register_lnk' => 'Registrera',
  'login_lnk' => 'Logga in',
  'logout_lnk' => 'Logga ut',
  'lastup_lnk' => 'Senast inlagda',
  'lastcom_lnk' => 'Senaste kommentarer',
  'topn_lnk' => 'Mest visade',
  'toprated_lnk' => 'Topplista',
  'search_lnk' => 'S�k',
  'fav_lnk' => 'Mina favoriter',
  'memberlist_title' => 'Visa medlemmar', //cpg1.3.0
  'memberlist_lnk' => 'Medlemmar', //cpg1.3.0
  'faq_title' => 'FAQ kring bildgalleriet &quot;Coppermine&quot;', //cpg1.3.0
  'faq_lnk' => 'FAQ', //cpg1.3.0
);

$lang_gallery_admin_menu = array(
  'upl_app_lnk' => 'Klara f�r publicering',
  'config_lnk' => 'Inst�llningar',
  'albums_lnk' => 'Album',
  'categories_lnk' => 'Kategorier',
  'users_lnk' => 'Anv�ndare',
  'groups_lnk' => 'Grupper',
  'comments_lnk' => 'L�s kommentarer', //cpg1.3.0
  'searchnew_lnk' => 'L�gg till flera objekt p� en g�ng', //cpg1.3.0
  'util_lnk' => 'Adminverktyg', //cpg1.3.0
  'ban_lnk' => 'Blockera anv�ndare',
  'db_ecard_lnk' => 'Visa e-vykort', //cpg1.3.0
);

$lang_user_admin_menu = array(
  'albmgr_lnk' => 'Skapa / sortera mina album',
  'modifyalb_lnk' => '�ndra i mina album',
  'my_prof_lnk' => 'Min profil',
);

$lang_cat_list = array(
  'category' => 'Kategori',
  'albums' => 'Album',
  'pictures' => 'Objekt', //cpg1.3.0
);

$lang_album_list = array(
  'album_on_page' => '%d album p� %d sida(or)',
);

$lang_thumb_view = array(
  'date' => 'DATUM',
  //Sort by filename and title
  'name' => 'FILNAMN',
  'title' => 'TITEL',
  'sort_da' => 'Sortera per datum, stigande',
  'sort_dd' => 'Sortera per datum, fallande',
  'sort_na' => 'Sortera per namn, stigande',
  'sort_nd' => 'Sortera per namn, fallande',
  'sort_ta' => 'Sortera per tite, stigande',
  'sort_td' => 'Sortera per titel, fallande',
  'download_zip' => 'Ladda ner som ZIP-fil', //cpg1.3.0
  'pic_on_page' => '%d objekt p� %d sida(or)',
  'user_on_page' => '%d anv�ndare p� %d sida(or)', //cpg1.3.0
);

$lang_img_nav_bar = array(
  'thumb_title' => '�terv�nd till miniatyrsidan',
  'pic_info_title' => 'Visa/d�lj objektinformation', //cpg1.3.0
  'slideshow_title' => 'Bildspel',
  'ecard_title' => 'Skicka denna bild som ett e-vykort', //cpg1.3.0
  'ecard_disabled' => 'e-vykort �r inaktiverat',
  'ecard_disabled_msg' => 'Du har inte beh�righet att skicka e-vykort', //js-alert //cpg1.3.0
  'prev_title' => 'Se f�reg�ende objekt', //cpg1.3.0
  'next_title' => 'Se n�sta objekt', //cpg1.3.0
  'pic_pos' => 'OBJEKT %s/%s', //cpg1.3.0
);

$lang_rate_pic = array(
  'rate_this_pic' => 'Betygs�tt den h�r bilden ', //cpg1.3.0
  'no_votes' => '(Ingen r�st �nnu)',
  'rating' => '(nuvarade betyg : %s / 5 fr�n %s r�ster)',
  'rubbish' => 'Skr�p',
  'poor' => 'Kass',
  'fair' => 'Godk�nd',
  'good' => 'Bra',
  'excellent' => 'Mycket bra',
  'great' => 'B�st',
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
  CRITICAL_ERROR => 'Kritiskt fel',
  'file' => 'Fil: ',
  'line' => 'Rad: ',
);

$lang_display_thumbnails = array(
  'filename' => 'Filnamn : ',
  'filesize' => 'Filstorlek : ',
  'dimensions' => 'Bildstorlek : ',
  'date_added' => 'Inlagd den : ', //cpg1.3.0
);

$lang_get_pic_data = array(
  'n_comments' => '%s kommentarer',
  'n_views' => 'visad %s g�nger',
  'n_votes' => '(%s r�ster)',
);

$lang_cpg_debug_output = array(
  'debug_info' => 'Debuginformation', //cpg1.3.0
  'select_all' => 'V�lj alla', //cpg1.3.0
  'copy_and_paste_instructions' => 'Om du vill ha hj�lp p� Commermines supportforum, kopiera den h�r debuginformationen och klista in den i ditt inl�gg. Var noga med att ers�tta k�nslig information (t.ex. l�senord) med *** innan du postar inl�gget.', //cpg1.3.0
  'phpinfo' => 'visa phpinfo', //cpg1.3.0
);

$lang_language_selection = array(
  'reset_language' => 'Standardspr�k', //cpg1.3.0
  'choose_language' => 'V�lj spr�k', //cpg1.3.0
);

$lang_theme_selection = array(
  'reset_theme' => 'Standardtema', //cpg1.3.0
  'choose_theme' => 'V�lj ett tema', //cpg1.3.0
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
  'Exclamation' => 'Utrop',
  'Question' => 'Fr�ga',
  'Very Happy' => 'Mycket glad',
  'Smile' => 'Smil',
  'Sad' => 'Ledsen',
  'Surprised' => '�verraskad',
  'Shocked' => 'Shockad',
  'Confused' => 'F�rbryllad',
  'Cool' => 'Cool',
  'Laughing' => 'Skrattande',
  'Mad' => 'Galen',
  'Razz' => 'Rumlande',
  'Embarassed' => 'F�rl�gen',
  'Crying or Very sad' => 'Gr�ter eller v�ldigt ledsen',
  'Evil or Very Mad' => 'Elak eller mycket arg',
  'Twisted Evil' => 'Fifflande elak',
  'Rolling Eyes' => 'Rullande elak',
  'Wink' => 'Blink',
  'Idea' => 'Id�',
  'Arrow' => 'Pil',
  'Neutral' => 'Neutral',
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
  0 => 'L�mnar adminl�ge...',
  1 => 'Startar adminl�ge...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
  'alb_need_name' => 'Album m�ste namnges !', //js-alert
  'confirm_modifs' => '�r du s�ker p� att du vill g�ra dessa f�r�ndringar?', //js-alert
  'no_change' => 'Du gjorde ingen f�r�ndring!', //js-alert
  'new_album' => 'Nytt album',
  'confirm_delete1' => '�r du s�ker p� att du vill radera detta album?', //js-alert
  'confirm_delete2' => '\nAlla objekt dess kommentarer kommer att f�rkloras', //js-alert
  'select_first' => 'V�lj ett album f�rst', //js-alert
  'alb_mrg' => 'Administrera album',
  'my_gallery' => '* Mitt galleri *',
  'no_category' => '* Ingen kategori *',
  'delete' => 'Radera',
  'new' => 'Nytt',
  'apply_modifs' => 'Verkst�ll f�r�ndringar',
  'select_category' => 'V�lj kategori',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
  'miss_param' => 'Parametrar som kr�vs f�r \'%s\'operationen st�ds inte!',
  'unknown_cat' => 'Vald kategori finns inte i databasen',
  'usergal_cat_ro' => 'Kategorin Anv�ndargalleri kan inte raderas!',
  'manage_cat' => 'Inst�llningar f�r kategorier',
  'confirm_delete' => '�r du s�ker p� att du vill RADERA denna kategori?', //js-alert
  'category' => 'Kategori',
  'operations' => 'Operationer',
  'move_into' => 'Flytta till',
  'update_create' => 'Uppdatera/Skapa galleri',
  'parent_cat' => 'Huvudkategori',
  'cat_title' => 'Kategorititel',
  'cat_thumb' => 'Kategoriminiatyr', //cpg1.3.0
  'cat_desc' => 'Kategoribeskrivning',
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
  'title' => 'Inst�llningar',
  'restore_cfg' => '�terst�ll systemets grundinst�llning',
  'save_cfg' => 'Spara inst�llningar',
  'notes' => 'Anm�rkningar',
  'info' => 'Information',
  'upd_success' => 'Coppermines inst�llningar uppdaterades',
  'restore_success' => 'Coppermines grundinst�llning �terskapades',
  'name_a' => 'Namn stigande',
  'name_d' => 'Namn fallande',
  'title_a' => 'Titel stigande',
  'title_d' => 'Titel fallande',
  'date_a' => 'Datum stigande',
  'date_d' => 'Datum fallande',
  'th_any' => 'Max Aspect',
  'th_ht' => 'H�jd',
  'th_wd' => 'Bredd',
  'label' => 'rubrik', //cpg1.3.0
  'item' => 'alternativ', //cpg1.3.0
  'debug_everyone' => 'Alla', //cpg1.3.0
  'debug_admin' => 'Enbart admin', //cpg1.3.0
        );

if (defined('CONFIG_PHP')) $lang_config_data = array(
  'Allm�nna inst�llningar',
  array('Gallerinamn', 'gallery_name', 0),
  array('Galleribeskrivning', 'gallery_description', 0),
  array('Galleriadministrat�rens e-post', 'gallery_admin_email', 0),
  array('M�ladress f�r \'Se fler bilder\' l�nk i e-vykort', 'ecards_more_pic_target', 0),
  array('Galleriet offline', 'offline', 1), //cpg1.3.0
  array('Logga e-vykort', 'log_ecards', 1), //cpg1.3.0
  array('Till�t nedladdning av favoriter i ZIP-format', 'enable_zipdownload', 1), //cpg1.3.0

  'Spr�k-, tema- &amp; teckenupps�ttningsinst�llningar',
  array('Spr�k', 'lang', 5),
  array('Tema', 'theme', 6),
  array('Visa lista med spr�k', 'language_list', 8), //cpg1.3.0
  array('Visa spr�kflaggor', 'language_flags', 8), //cpg1.3.0
  array('Visa &quot;�terst�ll&quot; i spr�kinst�llningarna', 'language_reset', 1), //cpg1.3.0
  array('Visa lista med teman', 'theme_list', 8), //cpg1.3.0
  array('Visa &quot;�terst�ll&quot; i temalistan', 'theme_reset', 1), //cpg1.3.0
  array('Visa FAQ', 'display_faq', 1), //cpg1.3.0
  array('Visa bbcode-hj�lp', 'show_bbcode_help', 1), //cpg1.3.0
  array('Teckenkodning', 'charset', 4), //cpg1.3.0

  'Utseende p� albumlista',
  array('Bredd p� huvudtabell (i pixlar eller %)', 'main_table_width', 0),
  array('Antal underkategorier som visas', 'subcat_level', 0),
  array('Antal album som visas', 'albums_per_page', 0),
  array('Antal kolumner i albumlistan', 'album_list_cols', 0),
  array('Storlek p� miniatyrer (i pixlar)', 'alb_list_thumb_size', 0),
  array('Inneh�ll p� huvudsidan', 'main_page_layout', 0),
  array('Visa f�rsta underkategorins miniatyrer i kategorierna','first_level',1),

  'Utseende p� miniatyrer',
  array('Antal kolumner p� miniatyrsida', 'thumbcols', 0),
  array('Antal rader p� miniatyrsida', 'thumbrows', 0),
  array('Max antal flikar som visas', 'max_tabs', 10), //cpg1.3.0
  array('Visa bildrubrik (tillsammans med titeln) nedanf�r miniatyrerna', 'caption_in_thumbview', 1), //cpg1.3.0
  array('Visa antalet visningar nedanf�r miniatyrerna', 'views_in_thumbview', 1), //cpg1.3.0
  array('Visa antalet kommentarer under miniatyrerna', 'display_comment_count', 1),
  array('Visa vem som laddat upp bilden under miniatyrerna', 'display_uploader', 1), //cpg1.3.0
  array('Grundinst�llning f�r sortering av bilder', 'default_sort_order', 3), //cpg1.3.0
  array('Minsta antal r�ster f�r att en bild ska synas i \'topplistan\'', 'min_votes_for_rating', 0), //cpg1.3.0

  'Utseende p� bilder samt inst�llningar f�r kommentarer',
  array('Tabellbredd f�r bildvisning (pixlar eller %)', 'picture_table_width', 0), //cpg1.3.0
  array('Bildinformation �r synlig som standard', 'display_pic_info', 1), //cpg1.3.0
  array('Filtrera bort fula ord i kommentarer', 'filter_bad_words', 1),
  array('Till�t smilies i kommentarer', 'enable_smilies', 1),
  array('Till�t flera kommentarer fr�n en och samma anv�ndare p� samma bild (st�nger av masspostningsskyddet)', 'disable_comment_flood_protect', 1), //cpg1.3.0
  array('Max l�ngd p� bildbeskrivning', 'max_img_desc_length', 0),
  array('Max antal tecken i ett ord', 'max_com_wlength', 0),
  array('Max antal rader i en kommentar', 'max_com_lines', 0),
  array('Max l�ngd p� en kommentar', 'max_com_size', 0),
  array('Visa filmrutor', 'display_film_strip', 1),
  array('Antal objekt i filmrutorna', 'max_film_strip_items', 0),
  array('Underr�tta admin om kommentarer via e-post', 'email_comment_notification', 1), //cpg1.3.0
  array('Visning av varje bild i bildspel, anges i millisekunder (1 sekund = 1000 millisekunder)', 'slideshow_interval', 0), //cpg1.3.0

  'Bild- och miniatyrinst�llningar', //cpg1.3.0
  array('Kvalitet p� JPEG-bilder', 'jpeg_qual', 0),
  array('Max dimension p� en miniatyr <a href="#notice2" class="clickable_option">**</a>', 'thumb_width', 0), //cpg1.3.0
  array('Anv�nd dimension ( bredd eller h�jd eller maxstorlek p� miniatyr)<b>**</b>', 'thumb_use', 7),
  array('Skapa mellanliggande bilder','make_intermediate',1),
  array('Max bredd eller h�jd p� en mellanliggande bild/film <a href="#notice2" class="clickable_option">**</a>', 'picture_width', 0), //cpg1.3.0
  array('Max storlek p� uppladdade objekt (KB)', 'max_upl_size', 0), //cpg1.3.0
  array('Max bredd eller h�jd f�r uppladdade bilder/filmer (i pixlar)', 'max_upl_width_height', 0), //cpg1.3.0

  'Avancerade inst�llningar f�r bilder och miniatyrer', //cpg1.3.0
  array('Visa ikon f�r privata album f�r ej inloggade anv�ndare','show_private',1), //cpg1.3.0
  array('F�rbjudna tecken i filnamn', 'forbiden_fname_char',0), //cpg1.3.0
  //array('Accepted file extensions for uploaded pictures', 'allowed_file_extensions',0), //cpg1.3.0
  array('Accepterade fil�ndelser f�r bilder', 'allowed_img_types',0), //cpg1.3.0
  array('Accepterade fil�ndelser f�r filmer', 'allowed_mov_types',0), //cpg1.3.0
  array('Accepterade fil�ndelser f�r ljud', 'allowed_snd_types',0), //cpg1.3.0
  array('Accepterade fil�ndelser f�r dokument', 'allowed_doc_types',0), //cpg1.3.0
  array('Metod f�r att �ndra storlek p� bilder','thumb_method',2), //cpg1.3.0
  array('S�kv�g till ImageMagick \'konverteringsfunktion\' (t.ex. /usr/bin/X11/)', 'impath', 0), //cpg1.3.0
  //array('Allowed image types (only valid for ImageMagick)', 'allowed_img_types',0), //cpg1.3.0
  array('Command line f�r ImageMagick', 'im_options', 0), //cpg1.3.0
  array('L�s ut EXIF-information ur JPEG-filer', 'read_exif_data', 1), //cpg1.3.0
  array('L�s ut IPTC-information ur JPEG-filer', 'read_iptc_data', 1), //cpg1.3.0
  array('Katalog f�r album <a href="#notice1" class="clickable_option">*</a>', 'fullpath', 0), //cpg1.3.0
  array('Katalog f�r anv�ndarnas objekt<a href="#notice1" class="clickable_option">*</a>', 'userpics', 0), //cpg1.3.0
  array('Prefix p� mellanliggande bilder <a href="#notice1" class="clickable_option">*</a>', 'normal_pfx', 0), //cpg1.3.0
  array('Prefix p� miniatyrer <a href="#notice1" class="clickable_option">*</a>', 'thumb_pfx', 0), //cpg1.3.0
  array('Standardinst�llning f�r kataloger', 'default_dir_mode', 0), //cpg1.3.0
  array('Standardinst�llning f�r filer', 'default_file_mode', 0), //cpg1.3.0

  'Anv�ndarinst�llningar',
  array('Till�t att nya anv�ndare registrerar sig', 'allow_user_registration', 1),
  array('Anv�ndarregistrering kr�ver e-postverifiering', 'reg_requires_valid_email', 1),
  array('Underr�tta admin via e-post n�r ny anv�ndare registrerats', 'reg_notify_admin_email', 1), //cpg1.3.0
  array('Till�t tv� anv�ndare att ha samma e-postadress', 'allow_duplicate_emails_addr', 1),
  array('Anv�ndare kan ha privata album (Om du byter fr�n \'ja\' to \'nej\' blir alla existerande album offentliga)', 'allow_private_albums', 1), //cpg1.3.0
  array('Underr�tta admin om uppladdade anv�ndarbilder som v�ntar p� godk�nnande', 'upl_notify_admin_email', 1), //cpg1.3.0
  array('Till�t att inloggade anv�ndare ser anv�ndarlistan', 'allow_memberlist', 1), //cpg1.3.0

  'Valfria f�lt f�r bildbeskrivningar (l�mna blankt om du inte vill anv�nda funktionen)',
  array('F�lt 1 namn', 'user_field1_name', 0),
  array('F�lt 2 namn', 'user_field2_name', 0),
  array('F�lt 3 namn', 'user_field3_name', 0),
  array('F�lt 4 namn', 'user_field4_name', 0),

  'Inst�llningar f�r Cookies',
  array('Namn p� Cookien scriptet anv�nder sig av (om du anv�nder bbs-integrationen, se till att denna skiljer sig fr�n namnet p� bbs:ens cookie)', 'cookie_name', 0),
  array('S�kv�g till cookie som scripten anv�nder sig av', 'cookie_path', 0),

  '�vriga inst�llningar',
  array('Aktivera debug mode', 'debug_mode', 9), //cpg1.3.0
  array('Visa meddelanden i debug mode', 'debug_notice', 1), //cpg1.3.0

  '<br /><div align="left"><a name="notice1"></a>(*) Denna inst�llning f�r inte �ndras om du redan har bilder i din databas.<br />
  <a name="notice2"></a>(**) Om du �ndrar inst�llningen kommer enbart de filer som l�ggs in i databasen fram�ver att p�verkas, d�rf�r rekommenderas det att man underviker att �ndra denna parameter n�r det redan finns bilder i databasen. Du kan dock till�mpa �ndringarna p� gamla bilder genom  &quot;<a href="util.php">Administrationsverktygs</a> (�ndra storlek p� bilder)&quot; funktionen fr�n administrationsmenyn.</div><br />', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File db_ecard.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('DB_ECARD_PHP')) $lang_db_ecard_php = array(
  'title' => 'Skickade e-vykort', //cpg1.3.0
  'ecard_sender' => 'Avs�ndare', //cpg1.3.0
  'ecard_recipient' => 'Mottagare', //cpg1.3.0
  'ecard_date' => 'Datum', //cpg1.3.0
  'ecard_display' => 'Visa e-vykort', //cpg1.3.0
  'ecard_name' => 'Namn', //cpg1.3.0
  'ecard_email' => 'E-post', //cpg1.3.0
  'ecard_ip' => 'IP #', //cpg1.3.0
  'ecard_ascending' => 'stigande', //cpg1.3.0
  'ecard_descending' => 'fallande', //cpg1.3.0
  'ecard_sorted' => 'Sorterad', //cpg1.3.0
  'ecard_by_date' => 'efter datum', //cpg1.3.0
  'ecard_by_sender_name' => 'efter avs�ndarens namn', //cpg1.3.0
  'ecard_by_sender_email' => 'efter avst�ndarens e-post', //cpg1.3.0
  'ecard_by_sender_ip' => 'efter avs�ndarens IP-address', //cpg1.3.0
  'ecard_by_recipient_name' => 'efter mottagarens namn', //cpg1.3.0
  'ecard_by_recipient_email' => 'efter mottagaren e-post', //cpg1.3.0
  'ecard_number' => 'visar poster %s till %s av %s', //cpg1.3.0
  'ecard_goto_page' => 'g� till sida', //cpg1.3.0
  'ecard_records_per_page' => 'Poster per sida', //cpg1.3.0
  'check_all' => 'Markera alla', //cpg1.3.0
  'uncheck_all' => 'Avmarkera alla', //cpg1.3.0
  'ecards_delete_selected' => 'Radera markerade e-vykort', //cpg1.3.0
  'ecards_delete_confirm' => '�r du s�ker p� att du vill radera alla dessa poster? Markera i kryssrutan!', //cpg1.3.0
  'ecards_delete_sure' => 'Jag �r s�ker!', //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
  'empty_name_or_com' => 'Du m�ste skriva ditt namn och en kommentar',
  'com_added' => 'Din kommentar �r inlagd',
  'alb_need_title' => 'Du m�ste ge albumet en titel!',
  'no_udp_needed' => 'Ingen uppdatering beh�vdes.',
   'alb_updated' => 'Albumet uppdaterades',
  'unknown_album' => 'Valt album existerar inte eller s� har du inte beh�righet att ladda upp i detta album',
  'no_pic_uploaded' => 'Ingen bild laddades upp<br /><br />Om du �r s�ker p� att du valt en bild f�r uppladdning, kontrollera att servern till�ter uppladdning...', //cpg1.3.0
  'err_mkdir' => 'Misslyckades att skapa katalogen %s !',
  'dest_dir_ro' => 'M�lkatalogen %s �r inte skrivbart av scriptet!',
  'err_move' => 'Om�jligt att flytta %s till %s !',
  'err_fsize_too_large' => 'Bilden du laddat upp �r f�r stor (max till�tet �r %s x %s) !', //cpg1.3.0
  'err_imgsize_too_large' => 'Filstorleken p� bilden du laddat upp �r f�r stor (max till�tet �r %s KB) !',
  'err_invalid_img' => 'Filen du laddat upp �r inte i giltigt format!',
  'allowed_img_types' => 'Du kan bara ladda upp %s bilder.',
  'err_insert_pic' => 'Bilden \'%s\' kan inte infogas i albumet', //cpg1.3.0
  'upload_success' => 'Din bild laddades upp utan problem<br /><br />Den kommer att bli synlig n�r admin godk�nt den', //cpg1.3.0
  'notify_admin_email_subject' => '%s - Bild eller film uppladdad', //cpg1.3.0
  'notify_admin_email_body' => '%s har laddat upp en bild eller film som beh�ver godk�nnas. G� in p� %s', //cpg1.3.0
  'info' => 'Information',
  'com_added' => 'Kommentar inlagd',
  'alb_updated' => 'Album uppdaterat',
  'err_comment_empty' => 'Din kommentar �r tom!',
  'err_invalid_fext' => 'Enbart filer med f�ljande �ndelser �r till�tna: <br /><br />%s.',
  'no_flood' => 'Det var du som skrev den senaste kommentaren f�r den h�r bilden<br /><br />�ndra den redan inlagda kommentaren om du vill �ndra n�got', //cpg1.3.0
  'redirect_msg' => 'Du skickas vidare.<br /><br /><br />Klicka \'FORTS�TT\' om inte sidan uppdateras automatiskt',
  'upl_success' => 'Din bild infogades utan problem', //cpg1.3.0
  'email_comment_subject' => 'Ny kommentar p� Coppermine Photo Gallery', //cpg1.3.0
  'email_comment_body' => 'N�gon har skrivit en ny kommentar i ditt galleri. L�s den p�', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
  'caption' => 'Rubrik',
  'fs_pic' => 'full storlek p� bild',
  'del_success' => 'radering lyckades',
  'ns_pic' => 'normal storlek p� bild',
  'err_del' => 'kan inte raderas',
  'thumb_pic' => 'miniatyr',
  'comment' => 'kommentar',
  'im_in_alb' => 'bild i album',
  'alb_del_success' => 'Album \'%s\' raderades',
  'alb_mgr' => 'Albumhanterare',
  'err_invalid_data' => 'Ogiltig data togs emot i \'%s\'',
  'create_alb' => 'Skapar album \'%s\'',
  'update_alb' => 'Uppdaterar albumet \'%s\' med titeln \'%s\' och index \'%s\'',
  'del_pic' => 'Radera bild', //cpg1.3.0
  'del_alb' => 'Radera album',
  'del_user' => 'Radera anv�ndare',
  'err_unknown_user' => 'Den valda anv�ndaren finns inte!',
  'comment_deleted' => 'Kommentaren raderades utan problem',
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
  'confirm_del' => '�r du s�ker p� att du vill RADERA denna bild ? \\n�ven dess kommentarer kommer att raderas.', //js-alert //cpg1.3.0
  'del_pic' => 'RADERA DENNA BILD', //cpg1.3.0
  'size' => '%s x %s pixlar',
  'views' => '%s g�nger',
  'slideshow' => 'Bildspel',
  'stop_slideshow' => 'STOPPA BILDSPEL',
  'view_fs' => 'Klicka h�r f�r att se bilden i fullstorlek',
  'edit_pic' => '�ndra beskrivning', //cpg1.3.0
  'crop_pic' => 'Besk�r och rotera', //cpg1.3.0
);

$lang_picinfo = array(
  'title' =>'Bildinformation', //cpg1.3.0
  'Filename' => 'Filnamn',
  'Album name' => 'Albumnamn',
  'Rating' => 'Betyg (%s r�ster)',
  'Keywords' => 'Nyckelord',
  'File Size' => 'Filstorlek',
  'Dimensions' => 'Dimensioner',
  'Displayed' => 'Visad',
  'Camera' => 'Kamera',
  'Date taken' => 'Datum f�r fototillf�lle',
  'Aperture' => 'Slutare',
  'Exposure time' => 'Exponeringstid',
  'Focal length' => 'Fokall�ngd',
  'Comment' => 'Kommentar',
  'addFav'=>'L�gg till favoriter', //cpg1.3.0
  'addFavPhrase'=>'Favoriter', //cpg1.3.0
  'remFav'=>'Ta bort fr�n favoriter', //cpg1.3.0
  'iptcTitle'=>'IPTC-titel', //cpg1.3.0
  'iptcCopyright'=>'IPTC-copyright', //cpg1.3.0
  'iptcKeywords'=>'IPTC-nyckelord', //cpg1.3.0
  'iptcCategory'=>'IPTC-kategori', //cpg1.3.0
  'iptcSubCategories'=>'IPTC-underkategorier', //cpg1.3.0
);

$lang_display_comments = array(
  'OK' => 'OK',
  'edit_title' => 'Redigera denna kommentar',
  'confirm_delete' => '�r du s�ker p� att du vill radera denna kommentar?', //js-alert
  'add_your_comment' => 'L�gg till din kommentar',
  'name'=>'Namn',
  'comment'=>'Kommentar',
  'your_name' => 'Anonym',
);

$lang_fullsize_popup = array(
  'click_to_close' => 'Klicka p� bilden f�r att st�nga det h�r f�nstret',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
  'title' => 'Skicka ett e-vykort',
  'invalid_email' => '<b>Varning</b> : E-postadressen �r ej giltig!',
  'ecard_title' => 'Du har f�tt ett e-vykort fr�n %s',
  'error_not_image' => 'Enbart bilder kan skickas som e-vykort.', //cpg1.3.0
  'view_ecard' => 'Klicka p� den h�r l�nken om du inte ser n�got e-vykort',
  'view_more_pics' => 'Klicka p� den h�r l�nken f�r att se fler bilder!',
  'send_success' => 'Din e-vykort skickades',
  'send_failed' => 'Servern kan tyv�rr inte skicka ditt e-vykort...',
  'from' => 'Fr�n',
  'your_name' => 'Ditt namn',
  'your_email' => 'Din e-postadress',
  'to' => 'Till',
  'rcpt_name' => 'Mottagarens namn',
  'rcpt_email' => 'Mottagarens e-postadress',
  'greetings' => 'Hej',
  'message' => 'Meddelande',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
  'pic_info' => 'Bild&nbsp;info', //cpg1.3.0
  'album' => 'Album',
  'title' => 'Titel',
  'desc' => 'Beskrivning',
  'keywords' => 'Nyckelord',
  'pic_info_str' => '%s &times; %s - %s KB - visad %s g�nger - %s r�ster',
  'approve' => 'Godk�nn bild', //cpg1.3.0
  'postpone_app' => 'Senarel�gg godk�nnande',
  'del_pic' => 'Radera bild', //cpg1.3.0
  'read_exif' => 'L�s EXIF-informationen p� nytt', //cpg1.3.0
  'reset_view_count' => 'Nollst�ll bes�karr�knaren',
  'reset_votes' => 'Nollst�ll r�ster',
  'del_comm' => 'Radera kommentarer',
  'upl_approval' => 'Godk�nnande f�r uppladdning',
  'edit_pics' => 'Redigera bild', //cpg1.3.0
  'see_next' => 'Se kommande bilder', //cpg1.3.0
  'see_prev' => 'Se f�reg�ende bilder', //cpg1.3.0
  'n_pic' => '%s bilder', //cpg1.3.0
  'n_of_pic_to_disp' => 'Antal bilder att visa', //cpg1.3.0
  'apply' => 'Verkst�ll f�r�ndringar', //cpg1.3.0
  'crop_title' => 'Commermine Bildredigerare', //cpg1.3.0
  'preview' => 'Visa utkast', //cpg1.3.0
  'save' => 'Spara bild', //cpg1.3.0
  'save_thumb' =>'Spara som miniatyr', //cpg1.3.0
  'sel_on_img' =>'Det valda omr�det m�ste helt vara inom bildens yta', //js-alert //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File faq.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FAQ_PHP')) $lang_faq_php = array(
  'faq' => 'Vanliga fr�gor', //cpg1.3.0
  'toc' => 'Kapitelf�rteckning', //cpg1.3.0
  'question' => 'Fr�ga: ', //cpg1.3.0
  'answer' => 'Svar: ', //cpg1.3.0
);

if (defined('FAQ_PHP')) $lang_faq_data = array(
  'Allm�n FAQ', //cpg1.3.0
  array('Varf�r m�ste jag registera mig?', 'Det �r upp till administrat�ren att best�mma om registrering kr�vs. Som registrerad f�r du dock tillg�ng till ytterligare funktioner, t.ex. ladda upp objekt, skapa en favoritlista, betygs�tta bilder och skriva kommentarer mm.', '0'), //cpg1.3.0
  array('Hur registrerar jag mig?', 'G� till &quot;Registrera dig&quot; och fyll i de obligatoriska f�lten (och de frivilliga efter �nskem�l).<br />Om administrat�ren har aktiverat e-postaktivering kommer du att f� ett mejl till den adress du angav n�r du registrerade dig med vidare instruktioner om hur du ska g�ra f�r att ditt medlemsskap ska aktiveras. Ditt konto m�ste d�refter aktiveras innan du kan logga in.', 'allow_user_registration', '1'), //cpg1.3.0
  array('Hur loggar jag in?', 'G� till &quot;Logga in&quot; och skriv ditt anv�ndarnamn och l�senord. Om du markerar &quot;Kom ih�g mig&quot; kommer du automatiskt att loggas in varje g�ng du kommer tillbaka.<br /><b>VIKTIGT: cookies m�ste vara aktiverade i din webbl�sare och du f�r inte radera Cookien fr�n den h�r sajten om du ska kunna anv�nda &quot;Kom ih�g mig&quot;.</b>', 'offline', 0), //cpg1.3.0
  array('Varf�r kan jag inte logga in?', 'Har du registrerat dig och sedan klickat p� l�nken som du fick via e-post? Genom att g�ra s� aktiveras ditt konto. Om inte detta l�ste problemet kontakta sajtens administrat�r.', 'offline', 0), //cpg1.3.0
  array('Vad g�r jag om jag gl�mt mitt l�senord?', 'Om den h�r sajten har har l�nk med texten &quot;Gl�mt bort l�senord&quot; s� anv�nd den. I annat fall m�ste du kontakta sajtens administrat�r f�r att f� ett nytt l�sen.', 'offline', 0), //cpg1.3.0
  //array('Hur g�r jag om jag byter e-postadress', 'Logga in och �ndra din e-postadress i &quot;Profil&quot;', 'offline', 0), //cpg1.3.0
  array('Hur l�gger jag till en bild i &quot;Mina favoriter&quot;?', 'Klicka p� en bild och klicka d�refter p� &quot;bildinformation&quot;-l�nken (<img src="images/info.gif" width="16" height="16" border="0" alt="Picture information" />); Rulla ner till st�ll in bildinformation och klicka p� &quot;L�gg till favoriter&quot;.<br />Administrat�ren m�ste ha st�llt in att &quot;bildinformation&quot; visas som standard.<br />VIKTIGT: Cookies m�ste vara aktiverat i din webbl�sare och cookien fr�n den h�r sajten f�r inte raderas om funktionen ska fungera.', 'offline', 0), //cpg1.3.0
  array('Hur betygs�tter jag en bild eller film?', 'Klicka p� miniatyren och betygs�tt den sedan en bit ner p� sidan.', 'offline', 0), //cpg1.3.0
  array('Hur kommenterar jag en bild?', 'Klicka p� miniatyren och skriv sedan en kommentar l�ngst ner p� sidan (under betygs�ttningen).', 'offline', 0), //cpg1.3.0
array('Hur laddar jag upp en bild?', 'G� till &quot;Ladda upp&quot; och v�lj vilket album du vill ladda upp bilden till. Klicka sedan p� &quot;v�lj fil&quot; och v�lj vilken fil du vill ladda upp. Klicka d�refter p� &quot;�ppna&quot; (h�r har du �ven m�jlighet att skriva in en titel och beskrivning av bilden) och sedan p� &quot;Skicka&quot; (kommandona �r beroende av vilken webbl�sare du anv�nder och kan d�rf�r variera n�got)', 'allow_private_albums', 0), //cpg1.3.0
  array('Var hamnar mina uppladdade bilder?', 'Du har m�jlighet att ladda upp bilder eller filmer till n�got av dina album i &quot;Mitt Galleri&quot;. Administrat�ren har ocks� m�jlighet att ge dig beh�righet att ladda upp material till andra album i Huvudgalleriet.', 'allow_private_albums', 0), //cpg1.3.0
  array('Vilka format och hur stora filer kan jag ladda upp?', 'Till�ten filstorlek och filtyp (jpg, png, etc.) best�ms av administrat�ren.', 'offline', 0), //cpg1.3.0
  array('Vad �r &quot;Mitt galleri&quot;?', '&quot;Mitt galleri&quot; �r ett personligt galleri som anv�ndaren dit anv�ndare kan ladda upp sina bilder och sedan sj�lv hantera.', 'allow_private_albums', 0), //cpg1.3.0
  array('Hur skapar jag, d�per om, eller raderar jag album i &quot;Mitt Galleri&quot;?', 'Du borde redan vara i &quot;Adminl�ge&quot;<br />G� till &quot;Skapa/Organsiera mina album&quot; och klicka p� &quot;Nytt&quot;. �ndra &quot;Nytt Album&quot; till �nskat namn.<br />Du kan �ven d�pa om albumen som finns i ditt galleri.<br />Klicka p� &quot;Verkst�ll f�r�ndringar&quot; f�r att verkst�lla �ndringarna.', 'allow_private_albums', 0), //cpg1.3.0
  array('Hur kontrollerar jag vilka anv�ndare som har tillg�ng till mina album?', 'Du borde redan vara i  &quot;Adminl�ge&quot;<br />G� till&quot;�ndra mina album. V�lj det album du vill �ndra p�&quot;Uppdatera Album&quot;-raden.<br />H�r kan du �ndra namn, beskrivning, miniatyr och anv�ndarnas r�ttigheter f�r att kunna kommentera och r�sta p� bilderna.<br />Klicka &quot;Uppdatera album&quot; n�r du gjort dina �ndringar.', 'allow_private_albums', 0), //cpg1.3.0
  array('Hur kan jg se andra anv�ndares gallerier?', 'G� till &quot;Albumlista&quot; och v�lj &quot;Anv�ndargallerier&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('Vad �r cookies och hur anv�nder denna sajt dem?', 'Cookies �r en liten text fil inneh�llande information som skickas fr�n webbsajter och som lagras p� din dators h�rddisk.<br />Normalt sett anv�ndes cookies f�r att kunna lagra information som beh�vs f�r att man ska kunna l�mna en sajt och sedan kunna komma tillbaka och f� upp sin information igen utan att beh�va g�ra alla inst�llningar p� nytt.<br />Coppermine anv�nder cookies f�r att lagra din inloggningsinformation (s� du slipper logga in p� nytt varje g�ng du bes�ker sajten) om Kom ih�g mig �r valt. Coppermine anv�nder �ven cookies f�r att komma ih�g vilka bilder som ligger i mina favoriter. Cookies anv�nds dock inte f�r at samla in n�gon personlig information och anv�nds inte heller i syfte att kartl�gga dig eller anv�nda uppgifter i kommersiella syften.', 'offline', 0), //cpg1.3.0
  array('Hur kan jag f� tag p� Coppermine till min egen sajt?', 'Coppermine �r ett gratis multimediagalleri som faller under GNU GPL. Det inneh�ller massor av funktioner och finns f�r flera olika plattformar. Bes�k <a href="http://coppermine.sf.net/">Coppermine Home Page</a> f�r mer information eller f�r att ladda ner det.', 'offline', 0), //cpg1.3.0

  'Hitta p� sajten', //cpg1.3.0
  array('Vad �r &quot;Albumlista&quot;?', 'I albumlistan ser du alla album tillh�rande den kategori som du �r inne i. Om du inte �r inne i n�gon kategori kommer du ist�llet att se hela galleriet med l�nkar till varje kategori. Varje miniatyrer kan vara en l�nk till en kategori.', 'offline', 0), //cpg1.3.0
  array('Vad �r &quot;Mitt galleri&quot;?', 'Denna funktion till�ter anv�ndare att skapa sitt eget galleri dit de kan l�gga till, �ndra och skapa egna album och �ven ladda upp bilder i dessa.', 'allow_private_albums', 0), //cpg1.3.0
  array('Vad �r skillnaden mellan &quot;Adminl�ge&quot; and &quot;Anv�ndarl�ge&quot;?', 'N�r anv�ndare g�r in i &quot;Adminl�ge&quot kan de modifiera sina gallerier, medan det enbart g�r att titta p� dem i &quot;Anv�ndarl�ge&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('Vad �rt;Ladda upp bild&quot;?', 'Denna funktion g�r det m�jlgit f�r anv�ndare att ladda upp en fil (till�ten storlek och typ best�ms av administrat�ren) till ett galleri som antingen valts av anv�ndaren eller administrat�ren.', 'allow_private_albums', 0), //cpg1.3.0
  array('Vad �r &quot;Senast inlagda&quot;?', 'Den h�r funktionen visar de senast uppladdade objekten till sajten.', 'offline', 0), //cpg1.3.0
  array('Vad �r &quot;Senast kommenterades&quot;?', 'Den h�r funktionen visar de senaste objekten som kommenterats tillsammans med dess kommentarer.', 'offline', 0), //cpg1.3.0
  array('Vad �r &quot;Mest visade&quot;?', 'Den h�r funktionen visar vilka objekt som �r visade flest g�nger (b�de f�r inloggade och ej inloggade anv�ndare).', 'offline', 0), //cpg1.3.0
  array('Vad �r &quot;Topplista&quot;?', 'Den h�r funktionen visar de objekt som f�tt h�gst genomsnittligt betyg av anv�nderna (t.ex. om fem anv�ndare vardera ger <img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> f�r objektet ett genomsnitt p� <img src="images/rating3.gif" width="65" height="14" border="0" alt="" />. Om fem anv�ndare ist�llet ger betyget 1 till 5 (1,2,3,4,5) ger detta objektet ett genomsnitt p� <img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> .)<br /> Betygen g�r fr�n <img src="images/rating5.gif" width="65" height="14" border="0" alt="best" /> (b�st) till <img src="images/rating0.gif" width="65" height="14" border="0" alt="worst" /> (s�mst).', 'offline', 0), //cpg1.3.0
  array('Vad �r &quot;Mina favoriter&quot;?', 'Den h�r funktionen l�ter anv�ndaren spara en lista �ver sina favoritobjekt i en cookie som lagras p� anv�ndarens h�rddisk.', 'offline', 0), //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// File forgot_passwd.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FORGOT_PASSWD_PHP')) $lang_forgot_passwd_php = array(
  'forgot_passwd' => 'Jag har gl�mt bort mitt l�sen', //cpg1.3.0
  'err_already_logged_in' => 'Du �r redan inloggad!', //cpg1.3.0
  'enter_username_email' => 'Skriv in ditt anv�ndarnamn eller e-postadress', //cpg1.3.0
  'submit' => 'Skicka', //cpg1.3.0
  'failed_sending_email' => 'Ditt l�sen kan inte skickas!', //cpg1.3.0
  'email_sent' => 'Ett mejl med ditt anv�ndarnamn och l�senord har skickats till  %s', //cpg1.3.0
  'err_unk_user' => 'Anv�ndaren finns inte!', //cpg1.3.0
  'passwd_reminder_subject' => '%s - Bortgl�mt l�sen', //cpg1.3.0
  'passwd_reminder_body' => 'Du har beg�rt att f� dina inloggningsuppgifter p� nytt:
Anv�ndarnamn: %s
L�sen: %s
Klicka pp %s f�r att logga in.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
  'group_name' => 'Gruppnamn',
  'disk_quota' => 'Diskutrymme',
  'can_rate' => 'Kan betygs�tta objekt', //cpg1.3.0
  'can_send_ecards' => 'Kan skicka e-vykort',
  'can_post_com' => 'Kan skriva kommentarer',
  'can_upload' => 'Kan ladda upp objekt', //cpg1.3.0
  'can_have_gallery' => 'Kan ha ett personligt galleri',
  'apply' => 'Verkst�ll f�r�ndringar',
  'create_new_group' => 'Create new group',
  'del_groups' => 'Radera vald(a) grupp(er)',
  'confirm_del' => 'Varning! N�r du raderar en grupp kommer anv�ndare i den gruppen att flyttas till gruppen \'Registrerad\' !\n\nVill du forts�tta?', //js-alert //cpg1.3.0
  'title' => 'Administrera anv�ndargrupper',
  'approval_1' => 'Godk�nn publika uppladdningar (1)',
  'approval_2' => 'Godk�nn personliga uppladdningar (2)',
  'upload_form_config' => 'Konfiguerera uppladdningsformul�r', //cpg1.3.0
  'upload_form_config_values' => array( 'Ladda enbart upp enstaka objekt', 'Ladda enbart upp flera objekt samtidigt', 'Enbart URI-uppladdningar', 'Enbart ZIP-uplladningar', 'Fil-URI', 'Fil-ZIP', 'URI-ZIP', 'Fil-URI-ZIP'), //cpg1.3.0
  'custom_user_upload'=>'Anv�ndaren kan v�lja antalet uppladdningsf�lt', //cpg1.3.0
  'num_file_upload'=>'Max/exakt antal uppladdningsf�lt', //cpg1.3.0
  'num_URI_upload'=>'Max/exakt antal URI uppladdningsf�lt', //cpg1.3.0
  'note1' => '<b>(1)</b> Uppladdningar i ett publikt album kr�ver admins godk�nnande',
  'note2' => '<b>(2)</b> Uppladdningar i ett album som tillh�r anv�ndare kr�ver admins godk�nnande',
  'notes' => 'Anm�rkningar',
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
  'welcome' => 'V�lkommen !',
);

$lang_album_admin_menu = array(
  'confirm_delete' => '�r du s�ker p� att du vill radera detta album? \\nAlla objekt och kommentarer kommer att raderas.', //js-alert //cpg1.3.0
  'delete' => 'RADERA',
  'modify' => 'EGENSKAPER',
  'edit_pics' => 'REDIGERA OBJEKT', //cpg1.3.0
);

$lang_list_categories = array(
  'home' => 'Hem',
  'stat1' => '<b>[pictures]</b> objekt i <b>[albums]</b> album och <b>[cat]</b> kategorier med <b>[comments]</b> kommentarer visade <b>[views]</b> g�nger', //cpg1.3.0
  'stat2' => '<b>[pictures]</b> objekt i <b>[albums]</b> album visade <b>[views]</b> g�nger', //cpg1.3.0
  'xx_s_gallery' => '%ss galleri',
  'stat3' => '<b>[pictures]</b> objekt i <b>[albums]</b> album med <b>[comments]</b> kommentarer visade <b>[views]</b> g�nger', //cpg1.3.0
);

$lang_list_users = array(
  'user_list' => 'Anv�ndarlista',
  'no_user_gal' => 'Det fins inga anv�ndargallerier',
  'n_albums' => '%s album',
  'n_pics' => '%s objekt', //cpg1.3.0
);

$lang_list_albums = array(
  'n_pictures' => '%s objekt', //cpg1.3.0
  'last_added' => ', senaste inlagd %s',
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
  'login' => 'Logga in',
  'enter_login_pswd' => 'Skriv ditt anv�ndarnamn och l�senord f�r att logga in',
  'username' => 'Anv�ndarnamn',
  'password' => 'L�senord',
  'remember_me' => 'Kom ih�g mig',
  'welcome' => 'V�lkommen %s ...',
  'err_login' => '*** Kunde inte logga in. F�rs�k igen ***',
  'err_already_logged_in' => 'Du �r redan inloggad!',
  'forgot_password_link' => 'Jag har gl�mt mitt l�senord', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
  'logout' => 'Logga ut',
  'bye' => 'Hej d� %s ...',
  'err_not_loged_in' => 'Du �r inte inloggad!',
);

// ------------------------------------------------------------------------- //
// File phpinfo.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('PHPINFO_PHP')) $lang_phpinfo_php = array(
  'php_info' => 'PHP info', //cpg1.3.0
  'explanation' => 'Det h�r informationen �r genererad av PHP-funktionen <a href="http://www.php.net/phpinfo">phpinfo()</a> och visas inom Coppermine (du kan kontrollera storleken i det h�gra h�rnet).', //cpg1.3.0
  'no_link' => 'Det kan vara en s�kerhetsrisk att l�ta andra se din phpinfo, av den anledningen �r den h�r sidan enbart tillg�nglig n�r du �r inloggad som admin. Du kan d�rf�r inte skicka denna sida som l�nk till n�gon annan, de har inte beh�righet att se sidan.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
  'upd_alb_n' => 'Uppdatera album %s',
  'general_settings' => 'Allm�nna inst�llningar',
  'alb_title' => 'Albumtitel',
  'alb_cat' => 'Albumkategori',
  'alb_desc' => 'Albumbeskrivning',
  'alb_thumb' => 'Albumminiatyr',
  'alb_perm' => 'R�ttigheter f�r detta album',
  'can_view' => 'Album kan ses av',
  'can_upload' => 'Bes�kare kan ladda upp bilder',
  'can_post_comments' => 'Bes�kare kan kommentera',
  'can_rate' => 'Bes�kare kan betygs�tta bilder',
  'user_gal' => 'Anv�ndaregalleri',
  'no_cat' => '* Ingen kategori *',
  'alb_empty' => 'Album �r tomt',
  'last_uploaded' => 'Senast uppladdat',
  'public_alb' => 'Alla (publikt album)',
  'me_only' => 'Endast jag',
  'owner_only' => 'Endast album�gare (%s)',
  'groupp_only' => 'Medlemmar av gruppen \'%s\'',
  'err_no_alb_to_modify' => 'Inget album att redigera i databasen.',
  'update' => 'Uppdatera album', //cpg1.3.0
  'notice1' => '(*) beroende av inst�llningar f�r %sgrupper%s', //cpg1.3.0 (do not translate %s!)
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
  'already_rated' => 'Du har redan betygsatt detta objekt', //cpg1.3.0
  'rate_ok' => 'Ditt betyg �r registrerat',
  'forbidden' => 'Du kan inte betygs�tta dina egna objekt.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
Trots att administrat�rerna h�r p� (SITE_NAME) f�rs�ker att ta bort eller �ndra allt st�rande eller st�tande material s� fort som m�jligt, �r det om�jligt att g� igenom alla meddelanden. D�rf�r m�ste alla inl�gg som skrivits p� denna sajt betraktas som ett uttryck av f�rfattarens personliga tankar och �sikter, och administrat�rer eller webmaster kan inte st� till ansvar f�r det (givetvis bortsett fr�n vad de sj�lv skrivit).<br />
<br />
Du g�r med p� att inte posta n�got st�rande, st�tande, rasistiskt, sexistiskt, vulg�rt, hatiskt, hotande eller annat material som kan t�nkas bryta mot n�gon till�mplig lag. Om du bryter mot det h�r kan det leda till att du blir permanent avst�ngd fr�n sajten (och din internetleverant�r blir kontaktad). Vid varje inl�gg sparas f�rfattarens IP-adress f�r att kunna anv�ndas vid s�dana h�r situationer (dock enbart synlig f�r administrat�rerna). Som anv�ndare g�r du med p� att webmaster, administrat�r och moderatorer har r�tt att ta bort, �ndra, flytta eller st�nga vilka inl�gg som helst n�r som helst. Som en anv�ndare g�r du med p� att all information som du skrivit in sparas elektroniskt i databasen. Information p� denna sajt kommer INTE att distribueras till n�gon 3:e part utan ditt samtycke. Webmastern, administrat�ren eller moderatorer kan inte h�llas ansvariga vid hackningsf�rs�k som kan leda till att data stj�ls. <br />
<br />
Denna sajt anv�nder cookies f�r att spara information p� din dator. Dessa cookies inneh�ller inte n�got av den information du skrivit in, utan anv�nds endast f�r att g�ra ditt anv�ndande av forumet b�ttre och smidigare. Din e-postadress anv�nds enbart f�r att aktivera din registrering, samt f�r omregistrering vid t.ex. byte av din e-post adress.<br />
<br />
Genom att klicka p� knappen "Jag godk�nner" nedan godk�nner du ovan vilkor.
EOT;

$lang_register_php = array(
  'page_title' => 'Anv�ndarregistrering',
  'term_cond' => 'Anv�ndarvillkor',
  'i_agree' => 'Jag godk�nner',
  'submit' => 'Skicka registrering',
  'err_user_exists' => 'Anv�ndarnamnet du skrev in finns redan, v�lj ett nytt',
  'err_password_mismatch' => 'L�senorden st�mmer inte �verens med varandra. Skriv in dem igen.',
  'err_uname_short' => 'Anv�ndarnamnet m�ste vara minst 2 tecken l�ngt',
  'err_password_short' => 'L�senordet m�ste vara minst 2 tecken l�ngt',
  'err_uname_pass_diff' => 'Anv�ndarnamn och l�senord f�r inte vara lika',
  'err_invalid_email' => 'E-postadressen �r ogiltig',
  'err_duplicate_email' => 'En annan anv�ndare �r redan registrerad med din e-postadress',
  'enter_info' => 'Fyll i registeringsuppgifter',
  'required_info' => 'Obligatorisk information',
  'optional_info' => 'Frivillig information',
  'username' => 'Anv�ndarnamn',
  'password' => 'L�senord',
  'password_again' => 'Skriv l�senordet igen',
  'email' => 'E-post',
  'location' => 'Finns i',
  'interests' => 'Intressen',
  'website' => 'Hemsida',
  'occupation' => 'Yrke',
  'error' => 'FEL',
  'confirm_email_subject' => '%s - Bekr�ftande av registrering',
  'information' => 'Information',
  'failed_sending_email' => 'Registeringsinformation kan inte skickas!',
  'thank_you' => 'Tack f�r din registrering.<br /><br />Ett e-postmeddelande med information om hur di ska aktivera ditt konto skickades till den e-postadress du angav.',
  'acct_created' => 'Ditt konto har skapats och du kan nu logga in med ditt anv�ndarnamn och l�senord.',
  'acct_active' => 'Ditt konto �r nu aktiverat och du kan logga in med ditt anv�ndarnamn och l�senord.',
  'acct_already_act' => 'Ditt konto �r redan aktiverat!',
  'acct_act_failed' => 'Detta konto kan inte aktiveras!',
  'err_unk_user' => 'Vald anv�ndare finns inte!',
  'x_s_profile' => '%ss profil',
  'group' => 'Grupp',
  'reg_date' => 'Blev medlem',
  'disk_usage' => 'Diskanv�ndning',
  'change_pass' => 'Byt l�senord',
  'current_pass' => 'Nuvarande l�senord',
  'new_pass' => 'Nytt l�senord',
  'new_pass_again' => 'Nytt l�senord igen',
  'err_curr_pass' => 'Detta l�senord �r inte korrekt',
  'apply_modif' => 'Verkst�ll �ndringar',
  'change_pass' => '�ndra mitt l�senord',
  'update_success' => 'Din profil uppdaterade',
  'pass_chg_success' => 'Ditt l�senord �ndrades',
  'pass_chg_error' => 'Ditt l�senord �ndrades inte',
  'notify_admin_email_subject' => '%s - Ny anv�ndare registrerad', //cpg1.3.0
  'notify_admin_email_body' => 'En anv�ndare med anv�ndarnamn "%s" har registrerat sig i ditt galleri.', //cpg1.3.0
);

$lang_register_confirm_email = <<<EOT
Tack f�r att du registerade dig p� {SITE_NAME}

Ditt anv�ndarnamn �r : "{USER_NAME}"
Ditt l�senord �r : "{PASSWORD}"

F�r att ditt konto ska aktiveras m�ste du klicka p� nedanst�ende l�nk
eller kopiera den och klista in den i din webbl�sare.

{ACT_LINK}

V�nligen

Administrat�ren av {SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
  'title' => 'Granska kommentarer',
  'no_comment' => 'Det finns ingen kommentar att granska',
  'n_comm_del' => '%s kommentar(er) raderad(e)',
  'n_comm_disp' => 'Antal kommentarer att visa',
  'see_prev' => 'Se f�reg�ende',
  'see_next' => 'Se n�sta',
  'del_comm' => 'Radera valda kommentarer',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
  0 => 'S�k bland objekten',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
  'page_title' => 'S�k efter nya objekt', //cpg1.3.0
  'select_dir' => 'V�lj katalog',
  'select_dir_msg' => 'Den h�r funktionen g�r det m�jligt att l�gga till ett parti med objekt som du laddat upp p� servern via FTP.<br /><br />V�lj katalogen dit du laddade upp dina bilder', //cpg1.3.0
  'no_pic_to_add' => 'Det finns inga objekt att l�gga till', //cpg1.3.0
  'need_one_album' => 'Du m�ste ha minst album f�r att anv�nda denna funktion',
  'warning' => 'Varning',
  'change_perm' => 'Scriptet kan inte skriva i denna katalog. Du m�ste �ndra dess r�ttigheter till 755 eller 77 innan du kan l�gga till objekten!', //cpg1.3.0
  'target_album' => '<b>L�gg objekten &quot;</b>%s<b>&quot; i </b>%s', //cpg1.3.0
  'folder' => 'Katalog',
  'image' => 'Objekt',
  'album' => 'Album',
  'result' => 'Resultat',
  'dir_ro' => 'Inte skrivbart. ',
  'dir_cant_read' => 'Inte l�sbart. ',
  'insert' => 'L�gger till nya objekt i galleriet', //cpg1.3.0
  'list_new_pic' => 'F�rteckning �ver nya objekt', //cpg1.3.0
  'insert_selected' => 'S�tt in valda objekt', //cpg1.3.0
  'no_pic_found' => 'Inga nya objekt hittades', //cpg1.3.0
  'be_patient' => 'Ha t�lamod, scriptet beh�ver lite tid att bearbeta objekten', //cpg1.3.0
  'no_album' => 'inget album valt',  //cpg1.3.0
  'notes' =>  '<ul>'.
                          '<li><b>OK</b> : betyder att objektet blev inlagda'.
                          '<li><b>DP</b> : betyder att objektet �r en kopia av ett objekt som redan finns i databasen'.
                          '<li><b>PB</b> : betyder att objektet inte kunde l�ggas till, kontrollera din konfiguration och r�ttigheterna i katalogen objekten ska placeras i'.
                          '<li><b>NA</b> : means that you haven\'t selected an album the files should go to, hit \'<a href="javascript:history.back(1)">back</a>\' and select an album. If you don\'t have an album <a href="albmgr.php">create one first</a></li>'.
                          '<li>Om OK, DP, PB \'symbolerna\' inte visas, klicka p� det felaktiga objektet f�r att se felmeddelandet som skapats av PHP'.
                          '<li>Om din webbl�sare g�r timeout, tryck p� knappen \'Uppdatera\''.
                          '</ul>', //cpg1.3.0
  'select_album' => 'v�lj album', //cpg1.3.0
  'check_all' => 'Markera alla', //cpg1.3.0
  'uncheck_all' => 'Avmarkera alla', //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //

// Void

// ------------------------------------------------------------------------- //
// File banning.php
// ------------------------------------------------------------------------- //

if (defined('BANNING_PHP')) $lang_banning_php = array(
  'title' => 'Blockera anv�ndare',
  'user_name' => 'Anv�ndarnamn',
  'ip_address' => 'IP-address',
  'expiry' => 'F�rfaller (blankt inneb�r permanent)',
  'edit_ban' => 'Spara �ndringar',
  'delete_ban' => 'Radera',
  'add_new' => 'L�gg till ny blockering',
  'add_ban' => 'L�gg till',
  'error_user' => 'Anv�ndaren finns inte', //cpg1.3.0
  'error_specify' => 'Du m�ste specifiera antingen ett anv�ndarnamn eller en IP-adress', //cpg1.3.0
  'error_ban_id' => 'Ogiltig blockerings-ID!', //cpg1.3.0
  'error_admin_ban' => 'Du kan inte blockera dig sj�lv!', //cpg1.3.0
  'error_server_ban' => 'Du h�ll p� att blocka din egen server? Tsk tsk, gl�m det...', //cpg1.3.0
  'error_ip_forbidden' => 'Du kan inte banna den h�r IP-adressen, den g�r inte att routa!', //cpg1.3.0
  'lookup_ip' => 'Sl� upp en IP-adress', //cpg1.3.0
  'submit' => 'Sl� upp', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
  'title' => 'Ladda upp objekt', //cpg1.3.0
  'custom_title' => 'Anpassat uppladdningsforuml�r', //cpg1.3.0
  'cust_instr_1' => 'YDu kan v�lja et antal f�lt f�r uppladdning, du kan dock inte �verskrida gr�nsen angiven nedan.', //cpg1.3.0
  'cust_instr_2' => 'Antal uppladdningsf�lt', //cpg1.3.0
  'cust_instr_3' => 'Filuppladdningsf�lt: %s', //cpg1.3.0
  'cust_instr_4' => 'URI/URL-uppladdningsf�lt: %s', //cpg1.3.0
  'cust_instr_5' => 'URI/URL-uppladdningsf�lt:', //cpg1.3.0
  'cust_instr_6' => 'Filuppladdningsf�lt:', //cpg1.3.0
  'cust_instr_7' => 'Ange antal uppladdningsf�lt av varje typ. Klicka sedan p� \'Forts�tt\'. ', //cpg1.3.0
  'reg_instr_1' => 'Ogiltig �tg�rd n�r formul�ret skapades.', //cpg1.3.0
  'reg_instr_2' => 'Du kan nu ladda upp dina objekt genom f�lten nedan. Storleken p� filerna du laddar upp f�r vardera inte �verskrida %s KB. ZIP-filer som laddas upp i \'Ladda upp fil\' och \'Ladda upp URI/URL\' kommer att f�rbli packade.', //cpg1.3.0
  'reg_instr_3' => 'Om du vill packa upp en zippad fil eller arkiv att packas upp m�ste du anv�nda uppladdningsformul�ret som finns i \'ZIP-uppladdning med uppackning\'', //cpg1.3.0
  'reg_instr_4' => 'N�r du anv�nder URI/URL-uppladdning ange s�kv�gen i form av: http://www.minsajt.se/bilder/exempel.jpg', //cpg1.3.0
  'reg_instr_5' => 'Klicka p�  \'Forts�tt\' n�r du valt alla filer du vill ladda upp.', //cpg1.3.0
  'reg_instr_6' => 'ZIP-uppladdning med uppackning:', //cpg1.3.0
  'reg_instr_7' => 'Filuppladdning:', //cpg1.3.0
  'reg_instr_8' => 'URI/URL-uppladdning:', //cpg1.3.0
  'error_report' => 'Felrapport', //cpg1.3.0
  'error_instr' => 'F�ljande uppladdningar r�kade ut f�r problem:', //cpg1.3.0
  'file_name_url' => 'Filnamn/URL', //cpg1.3.0
  'error_message' => 'Felmeddelande', //cpg1.3.0
  'no_post' => 'Filen inte uppladdad genom POST.', //cpg1.3.0
  'forb_ext' => 'Ej till�ten fil�ndelse.', //cpg1.3.0
  'exc_php_ini' => 'Filstorlek st�rre �n php.ini till�ter.', //cpg1.3.0
  'exc_file_size' => 'Filstorlek st�rre �n Coppermine till�ter.', //cpg1.3.0
  'partial_upload' => 'Enbart delvis uppladdad.', //cpg1.3.0
  'no_upload' => 'Det var inget som laddades upp.', //cpg1.3.0
  'unknown_code' => 'Ok�nd PHP felkod.', //cpg1.3.0
  'no_temp_name' => 'Ingenting laddades upp - Inget tempor�rt namn.', //cpg1.3.0
  'no_file_size' => 'Inneh�ller ingen data/filfel', //cpg1.3.0
  'impossible' => 'Gick inte att flytta filen.', //cpg1.3.0
  'not_image' => 'Ingen bild/filfel', //cpg1.3.0
  'not_GD' => 'Ingen GD-fil�ndelse.', //cpg1.3.0
  'pixel_allowance' => 'Antal till�tna pixlar �verskridet.', //cpg1.3.0
  'incorrect_prefix' => 'Felaktigt URI/URL-prefix', //cpg1.3.0
  'could_not_open_URI' => 'Kunde inte �ppna URI.', //cpg1.3.0
  'unsafe_URI' => 'S�kerheten inte kontrollerbar.', //cpg1.3.0
  'meta_data_failure' => 'Metadatafel', //cpg1.3.0
  'http_401' => '401 Ej till�ten', //cpg1.3.0
  'http_402' => '402 Betalning kr�vs', //cpg1.3.0
  'http_403' => '403 F�rbjuden', //cpg1.3.0
  'http_404' => '404 Ej hittad', //cpg1.3.0
  'http_500' => '500 Internt serverfel', //cpg1.3.0
  'http_503' => '503 Service otillg�nglig', //cpg1.3.0
  'MIME_extraction_failure' => 'MIME-typ kunde inte fastst�llas.', //cpg1.3.0
  'MIME_type_unknown' => 'Ok�nd MIME-typ', //cpg1.3.0
  'cant_create_write' => 'Kan inte skapa fil.', //cpg1.3.0
  'not_writable' => 'Kan inte skriva till fil.', //cpg1.3.0
  'cant_read_URI' => 'Kan inte l�sa URI/URL', //cpg1.3.0
  'cant_open_write_file' => 'Kan inte �ppna URI-fil.', //cpg1.3.0
  'cant_write_write_file' => 'Kan inte skriva till URI-fil.', //cpg1.3.0
  'cant_unzip' => 'Kan inte packa upp.', //cpg1.3.0
  'unknown' => 'Ok�nt fel', //cpg1.3.0
  'succ' => 'Uppladdning lyckades', //cpg1.3.0
  'success' => '%s uppladdningar lyckades.', //cpg1.3.0
  'add' => 'Klicka p� \'Forts�tt\' f�r att l�gga objekten i album.', //cpg1.3.0
  'failure' => 'Fel vid uppladdning', //cpg1.3.0
  'f_info' => 'Filinformation', //cpg1.3.0
  'no_place' => 'Den f�reg�ende filen kunde inte placeras.', //cpg1.3.0
  'yes_place' => 'Den f�reg�ende filen placerades.', //cpg1.3.0
  'max_fsize' => 'Max till�ten filstorlek f�r uppladdning �r %s KB',
  'album' => 'Album',
  'picture' => 'Objekt', //cpg1.3.0
  'pic_title' => 'Objektets titel', //cpg1.3.0
  'description' => 'Objektets beskrivning', //cpg1.3.0
  'keywords' => 'Nyckelord (avskiljda med mellanslag)',
  'err_no_alb_uploadables' => 'Det finns inget album du har beh�righet att ladda upp bilder till', //cpg1.3.0
  'place_instr_1' => 'L�gg objekten i album. Du kan ocks� l�gga in information om varje objekt nu.', //cpg1.3.0
  'place_instr_2' => 'Fler objekt m�ste placeras i album. Klicka p� \'Forts�tt\'.', //cpg1.3.0
  'process_complete' => 'Du har placerat alla objekten i album.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
  'title' => 'Administrera anv�ndare',
  'name_a' => 'Namn stigande',
  'name_d' => 'Namn fallande',
  'group_a' => 'Grupp stigande',
  'group_d' => 'Grupp fallande',
  'reg_a' => 'Registreringsdatum stigande',
  'reg_d' => 'Registreringsdatum fallande',
  'pic_a' => 'Objektr�knare stigande',
  'pic_d' => 'Objektr�knare fallande',
  'disku_a' => 'Diskanv�ndande stigande',
  'disku_d' => 'Diskanv�ndande fallande',
  'lv_a' => 'Senaste bes�k stigande', //cpg1.3.0
  'lv_d' => 'Senaste bes�k fallande', //cpg1.3.0
  'sort_by' => 'Sortera anv�ndare efter',
  'err_no_users' => 'Anv�ndartabellen �r tom!',
  'err_edit_self' => 'Du kan inte redigera din egen profil h�r. G� ist�llet in p� \'Min profil\'.',
  'edit' => 'REDIGERA',
  'delete' => 'RADERA',
  'name' => 'Anv�ndarnamn',
  'group' => 'Grupp',
  'inactive' => 'Inaktiv',
  'operations' => 'Funktioner',
  'pictures' => 'Objekt', //cpg1.3.0
  'disk_space' => 'Diskutrymme anv�nt / Tilldelat',
  'registered_on' => 'Registrerades',
  'last_visit' => 'Senaste bes�k', //cpg1.3.0
  'u_user_on_p_pages' => '%d anv�ndare p� %d sida(or)',
  'confirm_del' => '�r du s�ker p� att du vill RADERA denna anv�ndare? \\nAlla hans/hennes objekt och album kommer att raderas.', //js-alert //cpg1.3.0
  'mail' => 'E-POST',
  'err_unknown_user' => 'Vald anv�ndare finns inte!',
  'modify_user' => 'Spara anv�ndare',
  'notes' => 'Anm�rkningar',
  'note_list' => '<li>Om du inte vill byta ut ditt nuvarande l�senord, l�mna "l�senord"-f�ltet blankt.',
  'password' => 'L�senord',
  'user_active' => 'Anv�ndaren �r aktiv',
  'user_group' => 'Anv�ndargrupp',
  'user_email' => 'Anv�ndarens e-post',
  'user_web_site' => 'Anv�ndarens hemsida',
  'create_new_user' => 'Skapa ny anv�ndare',
  'user_location' => 'Anv�ndaren finns i',
  'user_interests' => 'Anv�ndarens intressen',
  'user_occupation' => 'Anv�ndarens yrke',
  'latest_upload' => 'Nyligen uppladdade', //cpg1.3.0
  'never' => 'aldrig', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
  'title' => 'Administrationsvertyg (�ndra storlek p� bilder)', //cpg1.3.0
  'what_it_does' => 'H�r kan du',
  'what_update_titles' => 'Uppdatera titlar fr�n filnamnet',
  'what_delete_title' => 'Radera titlar',
  'what_rebuild' => '�teruppbygga miniatyrbilder och storleks�ndrade bilder',
  'what_delete_originals' => 'Radera original och ers�tta det med en storleks�ndrad versione',
  'file' => 'Fil',
  'title_set_to' => 'titel satt till',
  'submit_form' => 'skicka',
  'updated_succesfully' => 'uppdatering lyckades',
  'error_create' => 'fel vid skapande av',
  'continue' => 'Bearbeta fler bilder',
  'main_success' => 'Filen %s anv�nds nu som huvudobjekt', //cpg1.3.0
  'error_rename' => 'Misslyckades att byta namn fr�n %s till %s',
  'error_not_found' => 'Filen %s hittades inte',
  'back' => 'tillbaka till huvudsidan',
  'thumbs_wait' => 'Uppdaterar miniatyrer och/eller storleks�ndrade bilder. Var god v�nta...',
  'thumbs_continue_wait' => 'Forts�tter att uppdatera miniatyrer och/eller storleks�ndrade bilder...',
  'titles_wait' => 'Uppdaterar titlar, var god v�nta...',
  'delete_wait' => 'Raderar titlar, var god v�nta...',
  'replace_wait' => 'Raderar original och ers�tter dem med storleksf�r�ndrade bilder, var god v�nta....',
  'instruction' => 'Snabbinstruktioner',
  'instruction_action' => 'V�lj funktion',
  'instruction_parameter' => 'S�tt parametrar',
  'instruction_album' => 'V�lj album',
  'instruction_press' => 'Tryck %s',
  'update' => 'Uppdatera miniatyrer och/eller storleksf�r�ndra bilder',
  'update_what' => 'Vad ska uppdateras',
  'update_thumb' => 'Enbart miniatyrer',
  'update_pic' => 'Enbart storleksf�r�ndrade bilder',
  'update_both' => 'B�de miniatyrer och storleksf�r�ndrade bilder',
  'update_number' => 'Antal bearbetade bilder per klick',
  'update_option' => '(F�rs�k v�lja ett l�gre v�rde om du f�r timeout-problem)',
  'filename_title' => 'Filnamn &rArr; Objektets titel', //cpg1.3.0
  'filename_how' => 'Hur ska filnamnet �ndras',
  'filename_remove' => 'Ta bort .jpg-�ndelsen och ers�tt _ (underscore) med mellanslag',
  'filename_euro' => '�ndra 2003_11_23_13_20_20.jpg till 23/11/2003 13:20',
  'filename_us' => '�ndra 2003_11_23_13_20_20.jpg till 11/23/2003 13:20',
  'filename_time' => '�ndra 2003_11_23_13_20_20.jpg till 13:20',
  'delete' => 'Radera objekttitlar eller objekt i originalstorle', //cpg1.3.0
  'delete_title' => 'Radera objekttitlar', //cpg1.3.0
  'delete_original' => 'Radera originalbildstorlek',
  'delete_replace' => 'Radera originalbilder och ers�tter dem med storleksf�r�ndrade versioner',
  'select_album' => 'V�lj album',
  'delete_orphans' => 'Radera kommentarer som inte l�ngre �r l�nkade till n�gon bild (fungerar i alla album)', //cpg1.3.0
  'orphan_comment' => 'Kommentarer som inte �r l�nkade till n�got objekt hittade', //cpg1.3.0
  'delete' => 'Radera', //cpg1.3.0
  'delete_all' => 'Radera alla', //cpg1.3.0
  'comment' => 'Kommentar: ', //cpg1.3.0
  'nonexist' => 'kopplad till ej existerande fil # ', //cpg1.3.0
  'phpinfo' => 'Visa phpinfo', //cpg1.3.0
  'update_db' => 'Uppdatera databas', //cpg1.3.0
  'update_db_explanation' => 'Om du har ersatt Coppermineobjekt, �ndrat dem eller uppgraderat fr�n en �ldre version av Coppermine s� k�r Uppdatera databas. Detta kommer att skapa n�dv�ndiga tabeller och �ndra n�dv�ndiga konfigurationer i din Copperminedatabas.', //cpg1.3.0
);

?>