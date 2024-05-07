<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.3.0                                            //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002,2003 Gregory DEMAR                                     //
//  http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                        //
// (http://coppermine.sf.net/team/)                                          //
// see /docs/credits.html for details                                        //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
// ------------------------------------------------------------------------- //
// Tanslation updated by Michal Ambroz <rebus@seznam.cz>                     //
// ------------------------------------------------------------------------- //
// $Id: czech.php,v 1.10 2004/12/29 23:06:36 chtito Exp $
// ------------------------------------------------------------------------- //


// info about translators and translated language
$lang_translation_info = array(
'lang_name_english' => 'Czech',  
'lang_name_native' => '&#x10C;esky', 
'lang_country_code' => 'cz', 
'trans_name'=> 'Michal Soukup aka migon', //the name of the translator - can be a nickname
'trans_email' => 'migon@boule.cz', //translator's email address (optional)
'trans_website' => 'http://www.boule.cz/', //translator's website (optional)
'trans_date' => '2003-10-02', //the date the translation was created / last modified
);


$lang_charset = 'iso-8859-2';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Byt�', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('Ne', 'Po', '�t', 'St', '�t', 'P�', 'So');
$lang_month = array('Leden', '�nor', 'B�ezen', 'Duben', 'Kv�ten', '�erven', '�ervenec', 'Srpen', 'Z���', '��jen', 'Listopad', 'Prosinec');

// Some common strings
$lang_yes = 'Ano';
$lang_no  = 'Ne';
$lang_back = 'ZP�T';
$lang_continue = 'POKRA�OVAT';
$lang_info = 'Informace';
$lang_error = 'Chyba';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%B %d, %Y';
$lastcom_date_fmt =  '%m/%d/%y at %H:%M';
$lastup_date_fmt = '%B %d, %Y';
$register_date_fmt = '%B %d, %Y';
$lasthit_date_fmt = '%B %d, %Y at %I:%M %p';
$comment_date_fmt =  '%B %d, %Y at %I:%M %p';

// For the word censor
$lang_bad_words = array('p��a', 'hovno', '*fuck*', 'prdel', '��r�k', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array(
        'random' => 'N�hodn� obr�zky',
        'lastup' => 'Nejnov�j��',
        'lastalb'=> 'Naposledy aktualizovan� galerie',
        'lastcom' => 'Nejnov�j�� koment��e',
        'topn' => 'Nejprohl�en�j��',
        'toprated' => 'Nejl�pe hodnocen�',
        'lasthits' => 'Naposledy zobrazen�',
        'search' => 'V�sledky hled�n�',
        'favpics'=> 'Obl�ben� obr�zky',
);

$lang_errors = array(
    'access_denied' => 'Nem�te opr�vn�n� na tuto str�nku',
    'perm_denied' => 'Nem�te dostate�n� pr�va pro potvrzen� t�to operace.',
    'param_missing' => 'Skriptu nebyly p�ed�ny pot�ebn� parametry',
    'non_exist_ap' => 'Vybran� galerie/obr�zek neexistuje',
    'quota_exceeded' => 'Vy�erpal(a) jste m�sto na disku.<br /><br />Va�e kv�ta je[quota]K, Va�e obr�zky zb�raj� [space]K, p�id�n�m tohoto obr�zku byste svoji kv�tu p�ekro�il',
    'gd_file_type_err' => 'Pokud pou��v�te GD knihovnu jsou podporov�ny jen obr�zky JPG a PNG',
    'invalid_image' => 'Tento obr�zek je po�kozen/poru�en GD knihovna s n�m nem��e pracovat.',
    'resize_failed' => 'Nelze vytvo�it n�hled �i zmen�en� obr�zek',
    'no_img_to_display' => 'Zde nen� ��dn� obr�zek, kter� byste si mohl(a) prohl�dnout',
    'non_exist_cat' => 'Vybran� kategorie neexistuje',
    'orphan_cat' => 'Podkategorie nem� nad��zenou kategorii. Probl�m opravte p�es nastaven� kategori�.',
    'directory_ro' => 'Do adres��e \'%s\' nelze zapisovat (nedostate�n� pr�va), obr�zky nemohly b�t smaz�ny.',
    'non_exist_comment' => 'Vybran� koment�� neexistuje',
    'pic_in_invalid_album' => 'Obr�zek(y) je/jsou v neexituj�c� galerii (%s)!?',
    'banned' => 'Byl jse vykopnut z t�chto str�nek, nen� V�m umo�n�no je pou��vat.',
    'not_with_udb' => 'Tato funkce je vypnut� jeliko� je integrov�na ve f�ru. Bu� nen� po�adovan� fukce dostupn� na tomto syst�mu, nebo tuto/tyto funci/e pln� f�rum.',
    'offline_title' => 'Odpojeno', //cpg1.3.0
    'offline_text' => 'Galerie je moment�ln� odpojena - pros�m zkuste to znovu pozd�ji', //cpg1.3.0
    'ecards_empty' => 'Moment�ln� nejsou k zobran� dostupn� ��dn� z�znamy o ecards. Ov��te pros�m, �e je zapnut� volba "ecard logging" v konfiguraci coppermine!', //cpg1.3.0
    'action_failed' => 'Akce selhala.  Coppermine nen� schopno v� po�adavek zpracovat.', //cpg1.3.0
    'no_zip' => 'Knihovny pot�ebn� pro zpracov�n� ZIP soubor� nejsou dostupn�.  Pros�m kontaktujte Va�eho administr�tora aplikace Coppermine.', //cpg1.3.0
    'zip_type' => 'Nem�te povolen� nahr�vat na server soubory ZIP.', //cpg1.3.0
);

$lang_bbcode_help = 'N�sleduj�c� zna�ky mohou b�t u�ite�n�: <li>[b]<b>Tu�n�</b>[/b]</li> <li>[i]<i>Kurz�va</i>[/i]</li> <li>[url=http://vasedomena.cz/]Text odkazu[/url]</li> <li>[email]uzivatel@domena.cz[/email]</li>'; //cpg1.3.0


// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
    'alb_list_title' => 'P�ej�t na seznam galeri�',
    'alb_list_lnk' => 'Seznam galeri�',
    'my_gal_title' => 'P�ej�t do m� osobn� galerie',
    'my_gal_lnk' => 'Moje galerie',
    'my_prof_lnk' => 'M�j Profil',
    'adm_mode_title' => 'Do Admin m�du',
    'adm_mode_lnk' => 'Admin m�d',
    'usr_mode_title' => 'Do U�ivatelsk�ho m�du',
    'usr_mode_lnk' => 'U�ivatelsk� m�d',
    'upload_pic_title' => 'Nahr�t obr�zek do gallerie',
    'upload_pic_lnk' => 'Upload obr�zku',
    'register_title' => 'Vytvo�it ��et',
    'register_lnk' => 'Registrovat se',
    'login_lnk' => 'P�ihl�sit',
    'logout_lnk' => 'Odhl�sit',
    'lastup_lnk' => 'Nejnov�j�� obr�zky',
    'lastcom_lnk' => 'Posledn� koment��e',
    'topn_lnk' => 'Nejprohl�en�j��',
    'toprated_lnk' => 'Nejl�pe hodnocen�',
    'search_lnk' => 'Vyhled�v�n�',
    'fav_lnk' => 'Obl�ben�',
    'memberlist_title' => 'Uka� seznam �len�', //cpg1.3.0
    'memberlist_lnk' => 'Seznam �len�', //cpg1.3.0
    'faq_title' => 'FAQ = nej�ast�ji kladen� ot�zky na galerii &quot;Coppermine&quot;', //cpg1.3.0
    'faq_lnk' => 'FAQ', //cpg1.3.0

);

$lang_gallery_admin_menu = array(
    'upl_app_lnk' => 'Potvrzen� uploadu',
    'config_lnk' => 'Nastaven�',
    'albums_lnk' => 'Galerie',
    'categories_lnk' => 'Kategorie',
    'users_lnk' => 'U�ivatel�',
    'groups_lnk' => 'U�. skupiny',
    'comments_lnk' => 'Koment��e',
    'searchnew_lnk' => 'D�vkov� p�id�n� obr�zk�',
    'util_lnk' => 'Zm�nit velikost obr�zk�',
    'ban_lnk' => 'Vykopnout u�ivatele',
);

$lang_user_admin_menu = array(
    'albmgr_lnk' => 'Vytvo�it / organizovat moje galerie',
    'modifyalb_lnk' => 'Zm�nit moje galerie',
    'my_prof_lnk' => 'M�j profil',
);

$lang_cat_list = array(
    'category' => 'Kategorie',
    'albums' => 'Galerie',
    'pictures' => 'Obr�zky',
);

$lang_album_list = array(
    'album_on_page' => '%d galeri� na %d str�nk�ch'
);
           //ascending VZESTUPNE
$lang_thumb_view = array(
    'date' => 'DATUM',
    //Sort by filename and title
    'name' => 'JM�NO SOUBORU',
    'title' => 'NADPIS',
    'sort_da' => '�adit vzestupn� podle data',
    'sort_dd' => '�adit sestupn� podle data',
    'sort_na' => '�adit vzestupn� podle jm�na',
    'sort_nd' => '�adit sestupn� podle jm�na',
    'sort_ta' => '�adit podle nadpisu vzestupn�',
    'sort_td' => '�adit podle nadpisu sestupn�',
    'download_zip' => 'Download jako Zip soubor', //cpg1.3.0
    'pic_on_page' => '%d obr�zkk� na %d str�nk�ch',
    'user_on_page' => '%d u�ivatel� na %d str�nk�ch'
);

$lang_img_nav_bar = array(
    'thumb_title' => 'Zp�t na str�nku s n�hledy',
    'pic_info_title' => 'Zobraz/skryj informace o obr�zku',
    'slideshow_title' => 'Slideshow',
    'ecard_title' => 'Poslat tento obr�zek jako pohlednici',
    'ecard_disabled' => 'Pohlednice jsou vypnut�',
    'ecard_disabled_msg' => 'Nem�te dostate�n� pr�va pro zasl�n� pohlednice',
    'prev_title' => 'P�edchoz� obr�zek',
    'next_title' => 'Dal�� obr�zek',
    'pic_pos' => 'OBR�ZEK %s/%s',
);

$lang_rate_pic = array(
    'rate_this_pic' => 'Hodnotit tento obr�zek ',
    'no_votes' => '(��dn� hodnocen�)',
    'rating' => '(Aktualn� hodnocen� : %s / z 5, hlasov�no %s kr�t)',
    'rubbish' => 'Hnusn�',
    'poor' => 'Mizern�',
    'fair' => 'Ujde to',
    'good' => 'Dobr�',
    'excellent' => 'V�born�',
    'great' => 'Dokonal�',
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
    CRITICAL_ERROR => 'Kritick� chyba',
    'file' => 'Soubor: ',
    'line' => '��dka: ',
);

$lang_display_thumbnails = array(
    'filename' => 'Jm�no souboru : ',
    'filesize' => 'Velikost souboru : ',
    'dimensions' => 'Rozm�ry : ',
    'date_added' => 'Datum p�id�n� : '
);

$lang_get_pic_data = array(
    'n_comments' => '%s Koment��(�)',
    'n_views' => '%s zobrazen�',
    'n_votes' => '(%s hlas(�))'
);

$lang_cpg_debug_output = array(
  'debug_info' => 'Debug Info', //cpg1.3.0
  'select_all' => 'Vybrat v�e', //cpg1.3.0
  'copy_and_paste_instructions' => 'Pokud se chyst�te po�adovat pomoc na podpo�e coppermine, vlo�te tento lad�c� v�stup do va�echo p��sp�vku. P�ed takov�m vlo�en�m se ujist�te, �e jste v�echna va�e hesla z tohoto textu nahradili pomoc� "***".', //cpg1.3.0
  'phpinfo' => 'Zobrazit phpinfo', //cpg1.3.0
);

$lang_language_selection = array(
  'reset_language' => 'P�ednastaven� jazyk', //cpg1.3.0
  'choose_language' => 'Vyberte V� jazyk', //cpg1.3.0
);

$lang_theme_selection = array(
  'reset_theme' => 'P�ednastaven� t�ma', //cpg1.3.0
  'choose_theme' => 'vyberte t�ma', //cpg1.3.0
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
    'Exclamation' => 'Exclamation',
    'Question' => 'Question',
    'Very Happy' => 'Very Happy',
    'Smile' => 'Smile',
    'Sad' => 'Sad',
    'Surprised' => 'Surprised',
    'Shocked' => 'Shocked',
    'Confused' => 'Confused',
    'Cool' => 'Cool',
    'Laughing' => 'Laughing',
    'Mad' => 'Mad',
    'Razz' => 'Razz',
    'Embarassed' => 'Embarassed',
    'Crying or Very sad' => 'Crying or Very sad',
    'Evil or Very Mad' => 'Evil or Very Mad',
    'Twisted Evil' => 'Twisted Evil',
    'Rolling Eyes' => 'Rolling Eyes',
    'Wink' => 'Wink',
    'Idea' => 'Idea',
    'Arrow' => 'Arrow',
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
    0 => 'Opou�t�m Admin M�d....:-(',
    1 => 'Vstupuji do Admin M�du....:-)',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
    'alb_need_name' => 'Galerie mus� m�t jm�no',
    'confirm_modifs' => 'Jste si jist(a) t�mito zm�nami ?',
    'no_change' => 'Neud�lal(a) jste ��dn� zm�ny !',
    'new_album' => 'Nov� galerie',
    'confirm_delete1' => 'Jste si jist(a), �e chcete smazat tuto galerii ?',
    'confirm_delete2' => '\nV�echny obr�zky a koment��e budou smaz�ny !',
    'select_first' => 'Nejprve vyberte galerii',
    'alb_mrg' => 'Spr�vce galeri�',
    'my_gallery' => '* Moje galerie *',
    'no_category' => '* Nen� kategorie *',
    'delete' => 'Smazat',
    'new' => 'Nov�/�',
    'apply_modifs' => 'Potvrdit zm�ny',
    'select_category' => 'Vybrat kategorii',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
    'miss_param' => 'Parametry pot�ebn� pro \'%s\'operaci not supplied !',
    'unknown_cat' => 'Vybran� kategorie v datab�zi neexistuje',
    'usergal_cat_ro' => 'Nelze smazat u�ivatelsk� galerie !',
    'manage_cat' => 'Spravovat kategorie',
    'confirm_delete' => 'Opravdu chcete SMAZAT tuto kategorii',
    'category' => 'Kategorie',
    'operations' => 'Operace',
    'move_into' => 'P�esunout do',
    'update_create' => 'Aktualizovat/Vytvo�it kategorii',
    'parent_cat' => 'Nad�azen� kategorie',
    'cat_title' => 'Nadpis kategorie',
    'cat_thumb' => 'Miniatura kategorie', //cpg1.3.0
    'cat_desc' => 'Popis kategorie'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
    'title' => 'Nastaven�',
    'restore_cfg' => 'Nastavit v�choz�',
    'save_cfg' => 'Ulo�it konfiguraci',
    'notes' => 'Pozn�mky',
    'info' => 'Informace',
    'upd_success' => 'Konfigurace byla zm�n�na',
    'restore_success' => 'Konfigurace byla nastavena na v�choz� nastaven�',
    'name_a' => 'Jm�no vzestupn�',
    'name_d' => 'Jm�no sestupn�',
    'title_a' => 'Nadpis vzestupn�',
    'title_d' => 'Nadpis sestupn�',
    'date_a' => 'Datum vzestupn�',
    'date_d' => 'Datum sestupn�',
    'th_any' => 'Max Aspect',
    'th_ht' => 'V��ka',
    'th_wd' => '���ka',
    'label' => 'popiska', //cpg1.3.0
    'item' => 'polo�ka', //cpg1.3.0
    'debug_everyone' => 'Ka�d�', //cpg1.3.0
    'debug_admin' => 'Pouze Admin', //cpg1.3.0

);

if (defined('CONFIG_PHP')) $lang_config_data = array(
    'Z�kladn� nastaven�',
    array('Jm�no gallerie', 'gallery_name', 0),
    array('Popis Galerie', 'gallery_description', 0),
    array('Email administr�tora galerie', 'gallery_admin_email', 0),
    array('C�lov� adresa pro odkaz \'Zobrazit dal�� obr�zky\' v odkazu pohlednice', 'ecards_more_pic_target', 0),
    array('Galrie je odpojena', 'offline', 1), //cpg1.3.0
    array('Logovat ecards', 'log_ecards', 1), //cpg1.3.0
    array('Povolit ZIP-stahov�n� obl�ben�ch', 'enable_zipdownload', 1), //cpg1.3.0

    'Jazyk, T�mata &amp; nastaven� znakov� sady',
    array('Jazyk', 'lang', 5),
    array('T�m�tko', 'theme', 6),
    array('Zobrazit seznam jazyk�', 'language_list', 1), //cpg1.3.0
    array('Zobrazit vlajky jazyk�', 'language_flags', 8), //cpg1.3.0 
    array('Zobrazit &quot;reset&quot; ve v�b�ru jazyka', 'language_reset', 1), //cpg1.3.0
    array('Zobrazit seznam t�mat', 'theme_list', 1), //cpg1.3.0
    array('Zobrazit &quot;reset&quot; ve v�b�ru t�mat', 'theme_reset', 1), //cpg1.3.0
    array('Zobrazit FAQ', 'display_faq', 1), //cpg1.3.0
    array('Zobrazit n�pov�du bbcode', 'show_bbcode_help', 1), //cpg1.3.0
    array('K�dov�n� znak�', 'charset', 4), //cpg1.3.0

    'Nastaven� zobrazen�',
    array('���ka hlavn� tabulky v (pixelech nebo %)', 'main_table_width', 0),
    array('Po�et �rovn� subkategori�', 'subcat_level', 0),
    array('Po�et galeri� na str�nku', 'albums_per_page', 0),
    array('Po�et sloupc� v p�ehledu galeri�', 'album_list_cols', 0),
    array('Velikost n�hled� v pixelech', 'alb_list_thumb_size', 0),
    array('Obsah hlavn� str�nky', 'main_page_layout', 0),
    array('Ukazovat v kategori�ch n�hledy galeri� prvn� �rovn�','first_level',1),

    'Zobrazen� n�hled�',
    array('Po�et sloupc� na str�nku', 'thumbcols', 0),
    array('Po�et ��dk� na str�nku', 'thumbrows', 0),
    array('Maxim�ln� mno�stv� z�lo�ek', 'max_tabs', 0),
    array('Zobrazit legendu obr�zku pod n�hledem', 'caption_in_thumbview', 1),
    array('Zobrazit po�et shl�dnut� pod n�hledem', 'views_in_thumbview', 1), //cpg1.3.0
    array('Zobrazit po�et koment��� pod n�hldem', 'display_comment_count', 1),
    array('Zobrazit jm�no autora pod n�hledem', 'display_uploader', 1), //cpg1.3.0
    array('Z�kladn� �azen� n�hled�', 'default_sort_order', 3),
    array('Min. po�et hlas� pot�ebn� k za�azen� do seznamu \'Nejl�pe hodnocen�\'', 'min_votes_for_rating', 0),

    'Zobrazen� obr�zk� &amp; Nastaven� koment���',
    array('���ka tabulky pro zobrazen� obr�zku (v pixelech nebo %)', 'picture_table_width', 0),
    array('V�dy zobrazit podrobn� info', 'display_pic_info', 1),
    array('CENZUROVAT slova v koment���ch', 'filter_bad_words', 1),
    array('Povolit smajl�ky v koment���ch', 'enable_smilies', 1),
    array('Maxim�ln� d�lka popisu obr�zku', 'max_img_desc_length', 0),
    array('Maxim�ln� d�lka slova v koment��i', 'max_com_wlength', 0),
    array('Maxim�ln� mno�stv� ��dk� v koment��i', 'max_com_lines', 0),
    array('Maxim�ln� d�lka koment��e', 'max_com_size', 0),
    array('Uk�zat filmov� prou�ek', 'display_film_strip', 1),
    array('Po�et polo�ek ve filmov�m prou�ku', 'max_film_strip_items', 0),
    array('Upozornit adminitratora na koment��e pomoc� emailu', 'email_comment_notification', 1), //cpg1.3.0 
    array('Slideshow interval v milisekund�ch (1 sekunda = 1000 milisekund)', 'slideshow_interval', 0), //cpg1.3.0 

    'Obr�zky a nastaven� n�hled�',
    array('Kvalita soubor� JPEG', 'jpeg_qual', 0),
    array('Maxim�ln� rozm�ry n�hledu <b>*</b>', 'thumb_width', 0),
    array('Pou��t rozm�r ( ���ka nebo v��ka nebo maxim�ln� rozm�r n�hledu )<b>*</b>', 'thumb_use', 7),
    array('Vytvo�it st�edn� obr�zek','make_intermediate',1),
    array('Maxim�ln� ���ka nebo v��ka st�en�ho obr�zku <a href="#notice2" class="clickable_option">**</a>', 'picture_width', 0), //cpg1.3.0
    array('Maxim�ln� velikost uploadovan�ch obr�zk� (KB)', 'max_upl_size', 0),
    array('Maxim�ln� rozm�ry uploadovan�ch obr�zk� (v pixelech)', 'max_upl_width_height', 0),

    'Obr�zky a n�hledy roz���en� nastaven�',
    array('Zobrazit ikonu zamknut� galerie nep�ihl�en�mu u�ivateli.','show_private',1),
    array('Znaky zak�zan� v n�zvech soubor�', 'forbiden_fname_char',0),
    //array('Povolen� koncovky uploadovan�ch soubor�', 'allowed_file_extensions',0),
    array('Povolen� typy obr�zk�', 'allowed_img_types',0), //cpg1.3.0
    array('Povolen� typy videa', 'allowed_mov_types',0), //cpg1.3.0
    array('Povolen� typy audia', 'allowed_snd_types',0), //cpg1.3.0
    array('Povolen� typy document�', 'allowed_doc_types',0), //cpg1.3.0
    array('Metoda zm�ny velikosti obr�zk�','thumb_method',2),
    array('Cesta k ImageMagicu (p��klad /usr/bin/X11/)', 'impath', 0),
    //array('Povolen� typy obr�zk� (pouze pro ImageMagic)', 'allowed_img_types',0),
    array('Parametry pro ImageMagic', 'im_options', 0),
    array('��st EXIF data ze soubor� JPEG', 'read_exif_data', 1),
    array('��st IPTC data ze soubor� JPEG', 'read_iptc_data', 1), //cpg1.3.0
    array('Adres�� pro galerie <b>*</b>', 'fullpath', 0),
    array('Adres�� pro galerie u�ivatel� <b>*</b>', 'userpics', 0),
    array('Prefix pro st�edn� velk� obr�zky <b>*</b>', 'normal_pfx', 0),
    array('Prefix pro n�hledy <b>*</b>', 'thumb_pfx', 0),
    array('Z�kladn� m�d pro adres��e', 'default_dir_mode', 0),
    array('Z�kladn� m�d pro obr�zky', 'default_file_mode', 0),

    'Nastaven� u�ivatel�',
    array('Povolit registraci nov�ch u�ivatel�', 'allow_user_registration', 1),
    array('Pro registraci vy�adovat potvrzen� admina', 'reg_requires_valid_email', 1),
    array('Upozornit administr�tora na registraci nov�ho u�ivatele pomoc� emailu', 'reg_notify_admin_email', 1), //cpg1.3.0
    array('Povolit pro dva u�ivatele stejn� email', 'allow_duplicate_emails_addr', 1),
    array('Maj� m�t u�ivatel� vlastn� galerii?', 'allow_private_albums', 1),
    array('Upozornit administr�tora na vlo�en� soubor �ekaj�c� na schv�len�', 'upl_notify_admin_email', 1), //cpg1.3.0
    array('Dovolit p�ihl�en�m u�ivatel�m, aby vid�li seznam u�ivatel�', 'allow_memberlist', 1), //cpg1.3.0

    'Vlastn� polo�ky pro popis obr�zku (Nechte pr�zn� a nezobraz� se)',
    array('Jm�no polo�ky 1', 'user_field1_name', 0),
    array('Jm�no polo�ky 2', 'user_field2_name', 0),
    array('Jm�no polo�ky 3', 'user_field3_name', 0),
    array('Jm�no polo�ky 4', 'user_field4_name', 0),

    'Cookies &amp; K�dov� str�ka',
    array('Jm�no cookies u��van� programem (expertn� volba)', 'cookie_name', 0),
    array('Cesta pro cookies u��van� programem (expertn� volba)', 'cookie_path', 0),
    array('K�dov� str�nka', 'charset', 4),

    'Dal�� nastaven�',
    array('Zapnout lad�c� m�d (jen pro testov�n�)', 'debug_mode', 1),
    array('Zobrazovat v lad�c�m m�du upozorn�n�', 'debug_notice', 1), //cpg1.3.0


    '<br /><div align="center">(*) Polo�ky ozna�en� * se NESM� zm�nit pokud ji� m�te ve va�� galerii nahran� obr�zky</div><br />
    <a name="notice2"></a>(**) P�i zm�n� tohoto nastaven� se zm�na projev� pouze u soubor�, kter� jsou 
	p�id�ny a� od tohoto okam�iku. Je doporu�eno nem�nit toto nastaven� pokud uz jsou v galerii n�jak� soubory. 
	P�est je mo�n� nechat prom�tnout zm�ny i na u� existuj�c� soubory pomoc� n�stroje
	&quot;<a href="util.php">admin tools</a> (resize pictures)&quot; v admin menu.</div><br />', //cpg1.3.0

);

// ------------------------------------------------------------------------- //
// File db_ecard.php //cpg1.3.0
// ------------------------------------------------------------------------- //
if (defined('DB_ECARD_PHP')) $lang_db_ecard_php = array(
  'title' => 'Zas�l�n� ecards', //cpg1.3.0
  'ecard_sender' => 'Odes�latel', //cpg1.3.0
  'ecard_recipient' => 'P��jemce', //cpg1.3.0
  'ecard_date' => 'Datum', //cpg1.3.0
  'ecard_display' => 'Zobrazit ecard', //cpg1.3.0
  'ecard_name' => 'Jm�no', //cpg1.3.0
  'ecard_email' => 'Email', //cpg1.3.0
  'ecard_ip' => 'IP #', //cpg1.3.0
  'ecard_ascending' => 'vzestupn�', //cpg1.3.0
  'ecard_descending' =>'sestupn�', //cpg1.3.0
  'ecard_sorted' => 'Set��d�n�', //cpg1.3.0
  'ecard_by_date' => 'podle data', //cpg1.3.0
  'ecard_by_sender_name' => 'podle jm�na odes�latele', //cpg1.3.0
  'ecard_by_sender_email' => 'podle emailu odes�latele', //cpg1.3.0
  'ecard_by_sender_ip' => 'podle IP addressy odes�latele', //cpg1.3.0
  'ecard_by_recipient_name' => 'podle jm�na p��jemce', //cpg1.3.0
  'ecard_by_recipient_email' => 'podle emailu p��jemce', //cpg1.3.0
  'ecard_number' => 'zobrazen� z�znamu %s a� %s z %s', //cpg1.3.0
  'ecard_goto_page' => 'p�echod na stranu', //cpg1.3.0
  'ecard_records_per_page' => 'Z�znamu na jedn� str�nce', //cpg1.3.0
  'check_all' => 'Zatrhnout v�e', //cpg1.3.0
  'uncheck_all' => 'Odzna�it v�e', //cpg1.3.0
  'ecards_delete_selected' => 'Smazat vybran� ecards', //cpg1.3.0
  'ecards_delete_confirm' => 'Jste si jist, �e chcete smazat z�znamy? Nastavte checkbox!', //cpg1.3.0 
  'ecards_delete_sure' => 'Jsem si jist.', //cpg1.3.0
);
                                                                                                                  



// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
    'empty_name_or_com' => 'Vlo�te jm�no a V� koment��',
    'com_added' => 'V� koment�� byl p�id�n',
    'alb_need_title' => 'Pros�m, dejte galerii nadpis !',
    'no_udp_needed' => 'Aktualizace nen� t�eba.',
    'alb_updated' => 'Galerie byla p�id�na',
    'unknown_album' => 'Vybran� galerie neexistuje nebo nem�te pr�va pro upload do t�to galerie',
    'no_pic_uploaded' => 'Obr�zek nebyl uploadov�n!<br /><br />zkontrolujte zda server podporuje upload soubor�, �i zda jste opravdu zadal(a) obr�zek k uploadu...',
    'err_mkdir' => '  ERROR: Chyba p�i vytv��en� adres��e (nebyl vytvo�en) %s !',
    'dest_dir_ro' => 'Do c�lov�ho adres��e %s nem��e skript zapisovat (zkontrolujte pr�va) !',
    'err_move' => 'Nelze p�esunout %s do %s !',
    'err_fsize_too_large' => 'Rozm�ry obr�zku, kter� se sna��te uploadovat, jsou p��li� velk� (max. velikost je %s x %s) !',
    'err_imgsize_too_large' => 'Velikost souboru, kter� se sna��te uploadovat, je p��li� velk� (max. velikost je %s KB) !',
    'err_invalid_img' => 'Soubor kter� jste nahr�l(a) na server nen� validn�m obr�zkem !',
    'allowed_img_types' => 'M��ete uploadovat pouze obr�zky %s .',
    'err_insert_pic' => 'Obr�zek \'%s\' nelze vlo�it do galerie ',
    'upload_success' => 'V� obr�zek byl nahr�n na server bez probl�m�<br /><br />Bude viditeln� po schv�len� adminem.',
    'notify_admin_email_subject' => '%s - upozorn�n� na Upload', //cpg1.3.0 
    'notify_admin_email_body' => '%s nahr�l do galerie obr�zek, kter� vy�aduje va�e potvrzen�. Nav�tivte pros�m %s', //cpg1.3.0
    'info' => 'Informace',
    'com_added' => 'Koment��u p�id�no',
    'alb_updated' => 'Galerie aktualizov�na',
    'err_comment_empty' => 'V� koment�� je pr�zdn� !',
    'err_invalid_fext' => 'Pouze soubory s n�sleduj�c�mi koncovkami jsou podporovan� : <br /><br />%s.',
    'no_flood' => 'Jste autor posledn�ho koment��e k tomuto obr�zku<br /><br />Pokud ho chcete zm�nit pou�ijte volbu upravit ',
    'redirect_msg' => 'Pr�v� jste p�esm�rov�v�n(a).<br /><br /><br />Klikn�te na \'POKRA�OVAT\' pokud se str�nka nep�esm�ruje sama',
    'upl_success' => 'V� obr�zek byl v po��dku p�id�n',
    'email_comment_subject' => 'Koment�� byl p�id�n do Coppermine Photo Gallery', //cpg1.3.0 
    'email_comment_body' => 'N�kdo p�idal koment�� do va�� galerie. Prohl�dn�te si ho na', //cpg1.3.0

);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
    'caption' => 'Legenda(popisek)',
    'fs_pic' => 'p�vodn� velikost obr�zku',
    'del_success' => 'bezchybn� smaz�no',
    'ns_pic' => 'norm�ln� velikost obr�zku',
    'err_del' => 'nelze smazat',
    'thumb_pic' => 'n�hled',
    'comment' => 'koment��',
    'im_in_alb' => 'pat�� do galerie',
    'alb_del_success' => 'Galerie \'%s\' smaz�na',
    'alb_mgr' => 'Spr�vce galeri�',
    'err_invalid_data' => 'Obdr�ena chybn� data \'%s\'',
    'create_alb' => 'Vytv���m galerii \'%s\'',
    'update_alb' => 'Aktualizuji galerii \'%s\' s nadpisem \'%s\' a seznamem \'%s\'',
    'del_pic' => 'Smazat obr�zek',
    'del_alb' => 'Smazat galerii',
    'del_user' => 'Smazat u�ivatele',
    'err_unknown_user' => 'Vybran� u�ivatel neexistuje !',
    'comment_deleted' => 'Koment�� bezchybn� smaz�n ! ',
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
    'confirm_del' => 'Jste si jist, �e chcete smazat tento obr�zek ? \\nP�ilo�en� koment��e budou straceny.',
      'del_pic' => 'SMAZAT TENTO OBR�ZEK',
    'size' => '%s x %s pixelel�',
    'views' => '%s kr�t',
    'slideshow' => 'Slideshow',
    'stop_slideshow' => 'ZASTAVIT SLIDESHOW',
    'view_fs' => 'klikn�te pro zobrazen� p�vodn�ho obr�zku',
    'edit_pic' => 'Edit description', //cpg1.3.0
    'crop_pic' => 'Crop and Rotate', //cpg1.3.0

);

$lang_picinfo = array(
    'title' =>'Informace o obr�zku',
    'Filename' => 'Jm�no souboru',
    'Album name' => 'Jm�no galerie',
    'Rating' => 'Hodnocen� (%s hlas(�))',
    'Keywords' => 'Kl��ov� slova',
    'File Size' => 'Velikost souboru',
    'Dimensions' => 'Rozm�ry',
    'Displayed' => 'Zobrazeno',
    'Camera' => 'Fotoapar�t',
    'Date taken' => 'Datum po��zen� sn�mku',
    'Aperture' => 'Clona',
    'Exposure time' => 'Expozi�n� �as',
    'Focal length' => 'Ohniskov� vzd�lenost',
    'Comment' => 'Koment��e',
    'addFav' => 'P�idat k obl�ben�m',
    'addFavPhrase' => 'Obl�ben�',
    'remFav' => 'Odstranit z obl�ben�ch',
    'iptcTitle'=>'IPTC Title', //cpg1.3.0
    'iptcCopyright'=>'IPTC Copyright', //cpg1.3.0
    'iptcKeywords'=>'IPTC Keywords', //cpg1.3.0
    'iptcCategory'=>'IPTC Category', //cpg1.3.0
    'iptcSubCategories'=>'IPTC Sub Categories', //cpg1.3.0
);

$lang_display_comments = array(
    'OK' => 'OK',
    'edit_title' => 'Upravit tento koment��',
    'confirm_delete' => 'Jste si jist(a), �e chcete smazat tento koment�� ?',
    'add_your_comment' => 'P�idat koment��',
    'name'=>'Jm�no',
    'comment'=>'Koment��',
    'your_name' => 'Anonym',
);

$lang_fullsize_popup = array(
        'click_to_close' => 'Kliknut�m na obr�zek zav�ete okno',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
    'title' => 'Poslat pohlednici',
    'invalid_email' => '<b>Varov�n�</b> : neplatn� emailov� adresa !',
    'ecard_title' => 'Pohlednice ze serveru %s pro v�s/tebe',
    'error_not_image' => 'Pouze obr�zky mohou b�t posl�ny jako ecard.', //cpg1.3.0
    'view_ecard' => 'Pokud se pohlednice nezobrazila klikni na link',
    'view_more_pics' => 'Klikni pro dal�� obr�zky !',
    'send_success' => 'Va�e pohlednice byla odesl�na',
    'send_failed' => 'Omlouv�me se, ale server nebyl schopen odeslat Va�� pohlednici zkuste
     to znovu za chv�li...',
    'from' => 'Od',
    'your_name' => 'Va�e jm�no',
    'your_email' => 'V� email',
    'to' => 'Komu',
    'rcpt_name' => 'Jm�no p��jemce',
    'rcpt_email' => 'Doru�it na email',
    'greetings' => 'Pozdrav/osloven�',
    'message' => 'Zpr�va',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
    'pic_info' => 'Info&nbsp;o obr�zku',
    'album' => 'Galerie',
    'title' => 'Nadpis',
    'desc' => 'Popis',
    'keywords' => 'Kl��ov� slova',
    'pic_info_str' => '%sx%s - %sKB - %s zobrazen� - %s hlas(�)',
    'approve' => 'Schv�lit obr�zek',
    'postpone_app' => 'Odlo�it schv�len�',
    'del_pic' => 'Smazat obr�zek',
    'read_exif' => 'Na��st znovu EXIF info', //cpg1.3.0
    'reset_view_count' => 'Vynulovat po��tadlo zobrazen�',
    'reset_votes' => 'Vynulovat hlasy',
    'del_comm' => 'Smazat koment��e',
    'upl_approval' => 'Potvrzen� uploadu',
    'edit_pics' => 'Upravit obr�zky',
    'see_next' => 'Zobrazit dal�� obr�zky',
    'see_prev' => 'Zobrazit p�edchoz� obr�zky',
    'n_pic' => '%s obr�zk�',
    'n_of_pic_to_disp' => 'Po�et obr�zku k zobrazen�',
    'apply' => 'Ulo�it zm�ny',
    'crop_title' => 'Coppermine Editor Obr�zk�', //cpg1.3.0 
	 'preview' => 'Preview', //cpg1.3.0
    'save' => 'Save picture', //cpg1.3.0
    'save_thumb' =>'Save as thumbnail', //cpg1.3.0
    'sel_on_img' =>'The selection has to be entirely on the image!', //js-alert //cpg1.3.0

);

// ------------------------------------------------------------------------- //
// File faq.php //cpg1.3.0
// ------------------------------------------------------------------------- //
//TODO
if (defined('FAQ_PHP')) $lang_faq_php = array(
  'faq' => '�asto kladen� ot�zky', //cpg1.3.0
  'toc' => 'Obsah', //cpg1.3.0
  'question' => 'Ot�zka: ', //cpg1.3.0
  'answer' => 'Odpov��: ', //cpg1.3.0
);

if (defined('FAQ_PHP')) $lang_faq_data = array(
  'General FAQ', //cpg1.3.0
  array('Why do I need to register?', 'Registration may or may not be required by the administrator. Registration gives a member additional features such as uploading, having a favorite list, rating pictures and posting comments etc.', 'allow_user_registration', '0'), //cpg1.3.0
  array('How do I register?', 'Go to &quot;Register&quot; and fill out the required fields (and the optional ones if you want to).<br />If the Administrator has Email Activation enabled ,then after submitting your information you should recieve an email message at the address that you have submitted while registering, giving you instructions on how to activate your membership. Your membership must be activated in order for you to login.', 'allow_user_registration', '1'), //cpg1.3.0
  array('How Do I login?', 'Go to &quot;Login&quot;, submit your username and password and check &quot;Remember Me&quot; so you will be logged in on the site if you should leave it.<br /><b>IMPORTANT:Cookies must be enabled and the cookie from this site must not be deleted in order to use &quot;Remember Me&quot;.</b>', 'offline', 0), //cpg1.3.0
  array('Why can I not login?', 'Did you register and click the link that was sent to you via email?. The link will activate your account. For other login problems contact the site administrator.', 'offline', 0), //cpg1.3.0
  array('What if I forgot my password?', 'If this site has a &quot;Forgot password&quot; link then use it. Other
than that contact the site administrator for a new password.', 'offline', 0), //cpg1.3.0
  //array('What if I changed my email address?', 'Just simply login and change your email address through &quot;Profile&quot;', 'offline', 0), //cpg1.3.0
  array('How do I save a picture to &quot;My Favorites&quot;?', 'Click on a picture and click on the &quot;picture info&quot; link (<img src="images/info.gif" width="16" height="16" border="0" alt="Picture information" />); scroll down to the picture information set and click &quot;Add to fav&quot;.<br />The administrator may have the &quot;picture information&quot; on by default.<br />IMPORTANT:Cookies must be enabled and the cookie from this site must not be deleted.', 'offline', 0), //cpg1.3.0
  array('How do I rate a file?', 'Click on a thumbnail and go to the bottom and choose a rating.', 'offline', 0), //cpg1.3.0
  array('How do I post a comment for a picture?', 'Click on a thumbnail and go to the bottom and post a comment.', 'offline', 0), //cpg1.3.0
array('How do I upload a file?', 'Go to &quot;Upload&quot;and select the album that you want to upload to, click
&quot;Browse&quot; and find the file to upload and click &quot;open&quot; (add a title and description if you want to) and click &quot;Submit&quot;', 'allow_private_albums', 0), //cpg1.3.0
  array('Where do I upload a picture to?', 'You will be able to upload a file to one of your albums in &quot;My Gallery&quot;. The Administrator may also allow you to upload a file to one or more of the albums in the Main Gallery.', 'allow_private_albums', 0), //cpg1.3.0
  array('What type and size of a file can I upload?', 'The size and type (jpg, png, etc.) is up to the administrator.', 'offline', 0), //cpg1.3.0
  array('What is &quot;My Gallery&quot;?', '&quot;My Gallery&quot; is a personal gallery that the user can upload to and manage.', 'allow_private_albums', 0), //cpg1.3.0
  array('How do I create, rename or delete an album in &quot;My Gallery&quot;?', 'You should already be in &quot;Admin-Mode&quot;<br />Go to &quot;Create/Order My Albums&quot;and click &quot;New&quot;. Change &quot;New Album&quot; to your desired name.<br />You can also rename any of the albums in your gallery.<br />Click &quot;Apply Modifications&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('How can I modify and restrict users from viewing my albums?', 'You should already be in &quot;Admin Mode&quot;<br />Go to &quot;Modify My Albums. On the &quot;Update Album&quot; bar, select the album that you want to modify.<br />Here, you can change the name, description, thumbnail picture, restrict viewing and comment/rating permissions.<br />Click &quot;Update Album&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('How can I view other users\' galleries?', 'Go to &quot;Album List&quot; and select &quot;User Galleries&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('What are cookies?', 'Cookies are a plain text piece of data that is sent from a website and is put on to your computer.<br />Cookies usually allow a user to leave and return to the site without having to login again and other various chores.', 'offline', 0), //cpg1.3.0
  array('Where can I get this program for my site?', 'Coppermine is a free Multimedia Gallery, released under GNU GPL. It is full of features and has been ported to various platforms. Visit the <a href="http://coppermine.sf.net/">Coppermine Home Page</a> to find out more or download it.', 'offline', 0), //cpg1.3.0

  'Navigating the Site', //cpg1.3.0
  array('What\'s &quot;Album List&quot;?', 'This will show you the entire category you are currently in, with a link to each album. If you are not in a category, it will show you the entire gallery with a link to each category. Thumbnails may be a link to the category.', 'offline', 0), //cpg1.3.0
  array('What\'s &quot;My Gallery&quot;?', 'This feature lets a user create their own gallery and add,delete or modify albums as well as upload to them.', 'allow_private_albums', 0), //cpg1.3.0
  array('What\'s the difference between &quot;Admin Mode&quot; and &quot;User Mode&quot;?', 'This feature, when in admin-mode, allows a user to modify their gallery (as well as others if allowed by the administrator).', 'allow_private_albums', 0), //cpg1.3.0
  array('What\'s &quot;Upload Picture&quot;?', 'This feature allows a user to upload a file (size and type is set by the site administrator) to a gallery selected by either you or the administrator.', 'allow_private_albums', 0), //cpg1.3.0
  array('What\'s &quot;Last Uploads&quot;?', 'This feature shows the last uploads to the site.', 'offline', 0), //cpg1.3.0
  array('What\'s &quot;Last Comments&quot;?', 'This feature shows the last comments along with the files posted by users.', 'offline', 0), //cpg1.3.0
  array('What\'s &quot;Most Viewed&quot;?', 'This feature shows the most viewed files by all users (whether logged in or not).', 'offline', 0), //cpg1.3.0
  array('What\'s &quot;Top Rated&quot;?', 'This feature shows the top rated files rated by the users, showing the average rating (e.g: five users each gave a <img src="images/rating3.gif" width="65" height="14" border="0" alt="" />: the file would have an average rating of <img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> ;Five users rated the file from 1 to 5 (1,2,3,4,5) would result in an average <img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> .)<br />The ratings go from <img src="images/rating5.gif" width="65"
height="14" border="0" alt="best" /> (best) to <img src="images/rating0.gif" width="65" height="14" border="0" alt="worst" /> (worst).', 'offline', 0), //cpg1.3.0
  array('What\'s &quot;My Favorites&quot;?', 'This feature will let a user store a favorite file in the cookie that was sent to your computer.', 'offline', 0), //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File forgot_passwd.php //cpg1.3.0
// ------------------------------------------------------------------------- //
//FOTO
if (defined('FORGOT_PASSWD_PHP')) $lang_forgot_passwd_php = array(
  'forgot_passwd' => 'P�ipomenut� hesla', //cpg1.3.0
  'err_already_logged_in' => 'U� jste p�ihl�en(a)!', //cpg1.3.0
  'enter_username_email' => 'Zadejte va�e p�ihla�ovac� jm�no a email adresu', //cpg1.3.0
  'submit' => 'Prove�', //cpg1.3.0
  'failed_sending_email' => 'Email s p�ipomenut�m hesla nemohl b�t odesl�n!', //cpg1.3.0
  'email_sent' => 'Na adresu 5s byl odesl�n dopis z va��m u�ivatelsk�m jm�nem a heslem', //cpg1.3.0
  'err_unk_user' => 'Zadan� u�ivatel neexistuje!', //cpg1.3.0
  'passwd_reminder_subject' => '%s - Pripomenuti hesla', //cpg1.3.0
  'passwd_reminder_body' => 'Po��dali jste o p�ipomenut� va�ich p�ihla�ovac�ch �daj�:
U�ivatelsk� jm�no: %s
Heslo:             %s
Klikn�te na %s pro p�ihl�en�.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
    'group_name' => 'Jm�no skupiny',
    'disk_quota' => 'Diskov� kv�ta',
    'can_rate' => 'Mohou hodnotit obr�zky',
    'can_send_ecards' => 'mohou pos�lat pohlednice',
    'can_post_com' => 'Mohou pos�lat koment��e',
    'can_upload' => 'Mohou nahr�vat obr�zky',
    'can_have_gallery' => 'Mohou m�t osobn� galerii',
    'apply' => 'Ulo�it zm�ny',
    'create_new_group' => 'Vytvo�it novou skupinu',
    'del_groups' => 'Smazat vybran� skupiny',
    'confirm_del' => 'Pokud sma�ete tuto skupinu v�ichni u�ivatel�, pat��c� do t�to skupiny budou p�esunuti do skupiny \'Registered\' !\n\nP�ejete si pokra�ovat ?',
    'title' => 'Spravovat u�ivatelsk� skupiny',
    'approval_1' => 'Potvrzen� ve�ejn�ho. Upl. (1)',
    'approval_2' => 'Potvrzen� soukrom�ho. Upl. (2)',
    'upload_form_config' => 'Konfigurace formul��e pro upload', //cpg1.3.0 
    'upload_form_config_values' => array( 'Pouze jednotliv� soubory', 'Pouze mnoho soubor�', 'Pouze URI uploads', 'Pouze ZIP upload', 'Soubory-URI', 'Soubory-ZIP', 'URI-ZIP', 'Soubory-URI-ZIP'), //cpg1.3.0  //TODO
    'custom_user_upload'=>'U�ivatel m��e upravit po�et vstupn�ch pol��ek pro upload?', //cpg1.3.0
    'num_file_upload'=>'Maxim�ln�/p�esn� po�et pol��ek pro upload soubor�', //cpg1.3.0
    'num_URI_upload'=>'Maxim�ln�/p�esn� po�et pol��ek pro upload URI', //cpg1.3.0

    'note1' => '<b>(1)</b> Upload do ve�ejn�ch galeri� vy�aduje potvrzen� adminem',
    'note2' => '<b>(2)</b> Upload do galerie pat��c� u�ivateli vy�aduje potvrzen� adminem',
    'notes' => 'Pozn�mky'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
    'welcome' => 'V�tejte !'
);

$lang_album_admin_menu = array(
    'confirm_delete' => 'Jste si jist(a), �e chcete smazat tuto galerii? \\nV�echny obr�zky a koment��e p�jdou do pekla taky. P�ejete si pokra�ovat.',
    'delete' => 'SMAZAT',
    'modify' => 'VLASTNOSTI',
    'edit_pics' => 'UPRAVIT OBR.',
);

$lang_list_categories = array(
    'home' => 'Dom�',
    'stat1' => '<b>[pictures]</b> obr�zk� v <b>[albums]</b> galeri�ch v <b>[cat]</b> kategori�ch s <b>[comments]</b> koment��i zobrazeno <b>[views]</b> kr�t',
    'stat2' => '<b>[pictures]</b> obr�zk� v <b>[albums]</b> galeri�ch zobrazeno <b>[views]</b> kr�t',
    'xx_s_gallery' => '%s\' galeri�',
    'stat3' => '<b>[pictures]</b> obr�zk� v <b>[albums]</b> galeri�ch s <b>[comments]</b> koment��i zobrazeno <b>[views]</b> kr�t'
);

$lang_list_users = array(
    'user_list' => 'Seznam u�ivatel�',
    'no_user_gal' => 'Nejsou ��dn� u�ivatelsk� alerie',
    'n_albums' => '%s galeri�',
    'n_pics' => '%s obr�zk�'
);

$lang_list_albums = array(
    'n_pictures' => '%s obr�zk�',
    'last_added' => ', posledn� p�id�n %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
    'login' => 'P�ihl�en�',
    'enter_login_pswd' => 'Zadejte Va�e jm�no a heslo pro p�ihl�en�',
    'username' => 'Jm�no',
    'password' => 'Heslo',
    'remember_me' => 'Pamatuj si m�',
    'welcome' => 'V�tej u n�s %s ...',
    'err_login' => '*** Chyba p�i p�ihl�en� skuste to znova ***',
    'err_already_logged_in' => 'Ji� jste p�ihl�en !',
    'forgot_password_link' => 'Zapomn�l jsem sv� heslo.', //cpg1.3.0

);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
    'logout' => 'Odhl�sit',
    'bye' => 'Tak si to u�ij zase jinde %s ...',
    'err_not_loged_in' => 'Nejste p�ihl�en !',
);


// ------------------------------------------------------------------------- //
// File phpinfo.php //cpg1.3.0
// ------------------------------------------------------------------------- //
//TODO

if (defined('PHPINFO_PHP')) $lang_phpinfo_php = array(
  'php_info' => 'PHP info', //cpg1.3.0
  'explanation' => 'This is the output generated by the PHP-function <a href="http://www.php.net/phpinfo">phpinfo()</a>, displayed within Copermine (trimming the output at the right corner).', //cpg1.3.0
  'no_link' => 'Having others see your phpinfo can be a security risk, that\'s why this page is only visible when you\'re logged in as admin. You can not post a link to this page for others, they will be denied access.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
    'upd_alb_n' => 'Aktualizovat album %s',
    'general_settings' => 'Z�kladn� nastaven�',
    'alb_title' => 'Nadpis galerie',
    'alb_cat' => 'Kategorie galerie',
    'alb_desc' => 'Popis galerie',
    'alb_thumb' => 'N�hled reprezentuj�c� album',
    'alb_perm' => 'P��stupov� pr�va pro tuto galerii',
    'can_view' => 'Album m��ou prohl�et',
    'can_upload' => 'N�v�t�vn�ci sm�j� p�id�vat obr�zky',
    'can_post_comments' => 'Povolit koment��e',
    'can_rate' => 'N�v�t�vn�ci mohou hlasovat',
    'user_gal' => 'User Gallery',
    'no_cat' => '* Nen� kategorie *',
    'alb_empty' => 'Galerie je pr�zdn�',
    'last_uploaded' => 'Nejnov�j�� obr�zek',
    'public_alb' => 'kdokoliv (ve�ejn� galerie)',
    'me_only' => 'Pouze j�',
    'owner_only' => 'Pouze vlastn�k (%s)',
    'groupp_only' => '�lenov� skupiny \'%s\'',
    'err_no_alb_to_modify' => 'Album nelze modifikovat v datab�zi.',
    'update' => 'Aktualizovat album',
    'notice1' => '(*) depending on %sgroups%s settings', //cpg1.3.0 (do not translate %s!)
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
    'already_rated' => 'Tento ob�zek jste ji� hodnotil(a)',
    'rate_ok' => 'V�s hlas byl p�ijat. D�kujeme.',
    'forbidden' => 'You can not rate your own files.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
Administr�to�i serveru {SITE_NAME}, pota�mo t�to galerie si vyhrazuj� pr�vo z�sahu do obsahu galerie nap�. koment��e, maz�n� obr�zk� p��padn� �prava (pokud poru�uj� pravidla galerie nebo dobr� mravy).
Pokud budou obr�zky nahran� u�ivetelem poru�ovat z�kon(y) budou ihned po zji�t�n� jejich um�st�n� na serveru smaz�ny. Administr�to�i/provozovatel� t�to galerie si distancuj� od
p��padn�ho z�vadn�ho obsahu nahran�ho na server u�ivateli. Vlastn�kem dat v galerii jsou jejich auto�i. Administr�to�i p�edpokl�daj�, �e na server jsou um�s�ovan� u�ivateli pouze obr�zky k n�m� vlastn� u�ivatel autorsk� pr�va.
<br />
Pokud souhlas�te, �e nebudete pos�lat jak�koliv z�vadn� materi�l jako vulg�rn� a obsc�n� obr�zky/koment��e, jak�koliv materi�l vzbuzuj�c� nen�vist, rasismus, nebo jin� materi�l poru�uj�c� z�kony. Souhlas�te, �e administr�to�i, provozovatel� a moder�to�i  {SITE_NAME}   maj� pr�vo smazat p��padn� upravit jak�koliv materi�l kdykoliv to uznaj� za vhodn�. Vlo�en� informace budou ulo�en� na serveru a v datab�zi a nebudou poskytnuty ��dn� t�et� stran� bez va�eho souhlasu. Administ�to�i/povozovatel� serveru  v�ak nejsou ani nebudou ru�it za data na serveru ulo�en� pokud dojde k jak�mukoliv �toku na sever.
<br />
<br />
Tyto str�nky vyu��vaj� k ulo�en� u�ivatelsk�ch dat cookies. Cookies slou�� pouze pro zv��en� konfortu p�i pou��v�n� t�to aplikace. Emailov� adresa slou�� jen pro potvrzen� va�ich �daj� a posl�n� hesla.<br />
<br />
Kliknut�m na 'Souhlas�m' souhlas�te z v��e uveden�mi pravidly..
EOT;

$lang_register_php = array(
    'page_title' => 'Registrace nov�ho u�ivatele',
    'term_cond' => 'Podm�nky a pravidla',
    'i_agree' => 'Souhlas�m',
    'submit' => 'Poslat registraci',
    'err_user_exists' => 'Zadan� u�ivatelsk� jm�no ji� existuje vyberte si pros�m jin�',
    'err_password_mismatch' => 'Hesla se mus� schodovat pokuste je ob� zadat znovu',
    'err_uname_short' => 'Minim�ln� d�lka u�ivatelsk�ho jm�na je 2 znaky',
    'err_password_short' => 'Heslo mus� b�t alespo� 2 znaky dlouh�',
    'err_uname_pass_diff' => 'Jm�no a heslo se nesm� shodovat',
    'err_invalid_email' => 'Byla zad�na neplatn� emailov� adresa',
    'err_duplicate_email' => 'Jin� u�ivatel se zaregistroval se zadan�m emailem. Email mus� b�t jedine�n�',
    'enter_info' => 'Zadan� registra�n� informace',
    'required_info' => 'Vy�adovan� informace',
    'optional_info' => 'Voliteln� informace',
    'username' => 'Jm�no',
    'password' => 'Heslo',
    'password_again' => 'Heslo (potvrzen�)',
    'email' => 'Email',
    'location' => 'M�sto (nap�. Brno apod.)',
    'interests' => 'Z�jmy',
    'website' => 'Dom�c� str�nka',
    'occupation' => 'Povol�n�',
    'error' => 'CHYBA',
    'confirm_email_subject' => '%s - Potvrzen� registracce',
    'information' => 'Informace',
    'failed_sending_email' => 'Nelze odeslat potvrzen� registace !',
    'thank_you' => 'D�kujeme za registraci.<br /><br />Na adresu zadanou p�i registraci V�m budou doru�eny informace o aktivaci va�eho ��tu',
    'acct_created' => 'V� u�ivatelsk� ��et byl bezchybn� vytvo�en. Nyn� se p�ihla�te pomoc� va�eho jm�na a hesla',
    'acct_active' => 'V� ��et je nyn� aktivn� p�ihla�te se pomoc� va�eho jm�na a hesla.',
    'acct_already_act' => 'V� ��et je ji� aktivn� !',
    'acct_act_failed' => 'Tento ��et nm��e b�t aktivov�n !',
    'err_unk_user' => 'Vybran� u�ivatel neexistuje !',
    'x_s_profile' => '%s\' profil',
    'group' => 'Skupina',
    'reg_date' => 'P�ipojen',
    'disk_usage' => 'Vyu�it� disku',
    'change_pass' => 'Zm�nit heslo',
    'current_pass' => 'Sou�asn� heslo',
    'new_pass' => 'Nov� heslo',
    'new_pass_again' => 'Nov� heslo (kontola)',
    'err_curr_pass' => 'Sou�asn� heslo zad�no nespr�vn�',
    'apply_modif' => 'potvrdit zm�ny',
    'change_pass' => 'Zm�nit heslo',
    'update_success' => 'V� profil byl aktualizov�n',
    'pass_chg_success' => 'Vy�e heslo bylo zm�n�no',
    'pass_chg_error' => 'Va�e heslo nebylo zm�n�no',
    'notify_admin_email_subject' => '%s - upozorneni na registraci', //cpg1.3.0 
    'notify_admin_email_body' => 'Nov� u�ivatel se jm�nem "%s" se registroval ve va�� galerii', //cpg1.3.0
);

$lang_register_confirm_email = <<<EOT
D�kujeme za registraci na {SITE_NAME}

Va�e jm�no je : "{USER_NAME}"
Va�e heslo je: "{PASSWORD}"

Pro aktivaci va�eho ��tu je p�eba kliknout na odkaz n�e nebo ho zkop�rovat
do adresn�ho ��dku va�eho browseru a p�ej�t na tuto str�nku


{ACT_LINK}

S Pozdravem,

Spr�va serveru {SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
    'title' => 'Kontrola koment���',
    'no_comment' => 'Nejsou ��dn� koment��e ke kontrole',
    'n_comm_del' => '%s koment��(�) smaz�n(o)',
    'n_comm_disp' => 'Po�et koment��� k zobrazen�',
    'see_prev' => 'P�edchoz�',
    'see_next' => 'Dal��',
    'del_comm' => 'Smazat vybran� koment��e',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
    0 => 'Prohled�vat obr�zky',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
    'page_title' => 'Naj�t nov� obr�zky',
    'select_dir' => 'Vybrat adres��',
    'select_dir_msg' => 'Tato funkce v�m umo�n� d�vkov� zpracovat obr�zky nahran� p�es FTP.<br /><br />Vyberte adres�� kde se nach�zej� obr�zky k spracov�n�',
    'no_pic_to_add' => 'Nejsou zde ��dn� obr�zky k p�id�n�',
    'need_one_album' => 'Po�ebujete m�t vytvo�enu alespo� jednu galerii',
    'warning' => 'Varov�n�',
    'change_perm' => 'Skript nem��e zapisovat do tohoto adres��e, mus�te ho nastavit na CHMOD 755 nebo 777 p�ed p�id�n�m obr�zk� !',
    'target_album' => '<b>Vlo�it obr�zky z &quot;</b>%s<b>&quot; do </b>%s',
    'folder' => 'Slo�ka',
    'image' => 'Obr�zek',
    'album' => 'Galerie',
    'result' => 'V�sledek',
    'dir_ro' => 'Nezapisovateln�. ',
    'dir_cant_read' => 'Ne�iteln�. ',
    'insert' => 'P�id�v�m nov� obr�zky do galerie',
    'list_new_pic' => 'Seznam obr�zk�',
    'insert_selected' => 'Vlo�it vybran� obr�zky',
    'no_pic_found' => 'Nov� obr�zky nenalezeny',
    'be_patient' => 'Pros�m bu�te trp�liv�(�), program pot�ebuje na zpracov�n� obr�zku n�ja� ten �as.',
    'notes' =>  '<ul>'.
                '<li><b>OK</b> : Tyto obr�zky byly p�id�ny'.
                '<li><b>DP</b> : Zdvojen�!, Tento obr�zek ji existuje'.
                '<li><b>PB</b> : tento obr�zek nelze p�idat, skontrolujte konfiguraci p��padn� p��stupov� pr�va'.
                '<li>Kdy� se neuk�e \'ozna�en�\' OK, DP, PB klepn�te na obr�zek a uvid�te chybovou hl�ku generovanou PHP, kter� V�m pom��e zjistit p���inu probl�mu'.
                '<li>Pokud dojde k timeoutu F5 nebo reload str�nky by m�l pomoci'.
                '</ul>',
     'select_album' => 'Vyberte galerii', //cpg1.3.0 
     'check_all' => 'Vybrat v�e', //cpg1.3.0
     'uncheck_all' => 'Odzna�it v�e', //cpg1.3.0
                
);


// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //

// Void

// ------------------------------------------------------------------------- //
// File banning.php
// ------------------------------------------------------------------------- //

if (defined('BANNING_PHP')) $lang_banning_php = array(
                'title' => 'Vykopnut� u�ivatel�',
                'user_name' => 'U�ivatelsk� jm�no',
                'ip_address' => 'IP Adresa',
                'expiry' => 'Vypr�� za (nevypl�ovat pro st�l� vykopnut�)',
                'edit_ban' => 'Ulo�it zm�ny',
                'delete_ban' => 'Smazat',
                'add_new' => 'P�idat dal�� vykopnut�',
                'add_ban' => 'P�idat',
                'error_user' => 'Nemohu nal�zt u�ivatele', //cpg1.3.0 
                'error_specify' => 'Je pot�eba zadat bu� u�ivatelsk� jm�no nebo IP adresu', //cpg1.3.0
                'error_ban_id' => '�patn� ID pro z�kaz!', //cpg1.3.0
                'error_admin_ban' => 'Nem��ete zak�zat s�m sebe!', //cpg1.3.0
                'error_server_ban' => 'Sna��te se zak�zat vlastn� server? To nen� mo�n� ud�lat.', //cpg1.3.0
                'error_ip_forbidden' => 'Nen� mo�n� zak�zat toto IP - nen� dosa�iteln�!', //cpg1.3.0
                'lookup_ip' => 'Naj�t IP adresu', //cpg1.3.0
                'submit' => 'Odeslat', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(  
    'title' => 'Upload obr�zku', 
    'custom_title' => 'Upraven� Formul��', //cpg1.3.0
    'cust_instr_1' => 'M��ete zvolit po�adovan� po�et vstupn�ch pol��ek. Nen� ale mo�n� p�ekro�it omezen� po�tu pol��ek uveden� n�e.', //cpg1.3.0
    'cust_instr_2' => 'Box Number Requests', //cpg1.3.0
    'cust_instr_3' => 'Pol��ka pro upload soubor�: %s', //cpg1.3.0
    'cust_instr_4' => 'Pol��ka pro URI/URL upload: %s', //cpg1.3.0
    'cust_instr_5' => 'Pol��ka pro URI/URL upload:', //cpg1.3.0
    'cust_instr_6' => 'Pol��ka pro upload soubor�:', //cpg1.3.0
    'cust_instr_7' => 'Pros�m zadejte po�adovan� po�et ke ka�d�mu typu vstupn�ch pol��ek pro upload. Potom stiskn�te \'Pokra�ovat\'. ', //cpg1.3.0
    'reg_instr_1' => 'Neplatn� akce pro vytvo�en� formul��e.', //cpg1.3.0  
    'reg_instr_2' => 'Pomoc� pol��ek dole m��ete nechat na server nahr�t soubory. Velikost jednotliv�ch nahr�van�ch soubor� p�i uploadu na server by nem�la p�es�hnout %s KB. Soubory ZIP nahran� pomoc� sekc� \'Upload Soubor�\' nebo \'URI/URL Upload\' z�stanou zkomprimovan� jako jeden soubor i po nahr�n� na server.', //cpg1.3.0
    'reg_instr_3' => 'Pokud chcete, aby soubory zabalen� v archivu ZIP byly rozbaleny, mus�te pou��t pro zad�n� souboru pol��ko v sekci \'Decompressive ZIP Upload\'.', //cpg1.3.0
    'reg_instr_4' => 'Pokud pou��v�te sekci URI/URL upload, pros�m zad�vejte cestu k souboru takto: http://www.mojedomena.cz/obrazky/priklad1.jpg', //cpg1.3.0
    'reg_instr_5' => 'Po vypln�n� formul��e stiskn�te tla��tko \'Pokra�ovat\'.', //cpg1.3.0
    'reg_instr_6' => 'Upload ZIP Archivu:', //cpg1.3.0
    'reg_instr_7' => 'Upload Soubor�:', //cpg1.3.0
    'reg_instr_8' => 'URI/URL Uploads:', //cpg1.3.0
    'error_report' => 'Error Report', //cpg1.3.0
    'error_instr' => 'The following uploads encountered errors:', //cpg1.3.0
    'file_name_url' => 'File Name/URL', //cpg1.3.0
    'error_message' => 'Error Message', //cpg1.3.0
    'no_post' => 'File not uploaded by POST.', //cpg1.3.0
    'forb_ext' => 'Forbidden file extension.', //cpg1.3.0
    'exc_php_ini' => 'P�ekro�ena velikost souboru povolen� v php.ini.', //cpg1.3.0
    'exc_file_size' => 'P�ekro�ena velikost souboru povolen� galeri�.', //cpg1.3.0
    'partial_upload' => 'Pouze ��ste�n� upload.', //cpg1.3.0
    'no_upload' => 'Neprob�hl ��dn� upload soubor�.', //cpg1.3.0
    'unknown_code' => 'Nezn�m� chyba PHP p�i uploadu.', //cpg1.3.0
    'no_temp_name' => '��dn� upload - �adn� do�asn� jm�no.', //cpg1.3.0
    'no_file_size' => 'Neobsahuje ��dn� data/rozbit�', //cpg1.3.0
    'impossible' => 'Nebylo mo�n� p�esunout.', //cpg1.3.0
    'not_image' => 'Nen� obr�zkem/rozit�', //cpg1.3.0
    'not_GD' => 'Chyb� roz���en� GD.', //cpg1.3.0
    'pixel_allowance' => 'Pixel allowance exceeded.', //cpg1.3.0 //TODO
    'incorrect_prefix' => 'Neplatn� URI/URL prefix', //cpg1.3.0
    'could_not_open_URI' => 'Nebylo mo�n� otev��t URI.', //cpg1.3.0
    'unsafe_URI' => 'Safety not verifiable.', //cpg1.3.0  //TODO
    'meta_data_failure' => 'Chyba v meta datech', //cpg1.3.0
    'http_401' => '401 Neautorizovan� p��stup', //cpg1.3.0
    'http_402' => '402 Po�adov�na platba', //cpg1.3.0
    'http_403' => '403 Zak�zan� p��stup', //cpg1.3.0
    'http_404' => '404 Nebylo nalezeno', //cpg1.3.0
    'http_500' => '500 Intern� chyba serveru', //cpg1.3.0
    'http_503' => '503 Slu�ba nen� dostupn�', //cpg1.3.0
    'MIME_extraction_failure' => 'MIME nebylo rozpozn�no.', //cpg1.3.0
    'MIME_type_unknown' => 'Nezn�m� MIME typ', //cpg1.3.0
    'cant_create_write' => 'Nebylo mo�n� vytvo�it soubor pro z�pis.', //cpg1.3.0
    'not_writable' => 'Nebylo mo�n� zapisovat do souboru pro z�pis.', //cpg1.3.0
    'cant_read_URI' => 'Nebylo mo�n� p�e��st URI/URL', //cpg1.3.0
    'cant_open_write_file' => 'Nebylo mo�n� otev��t soubor pro URI.', //cpg1.3.0
    'cant_write_write_file' => 'Nebylo mo�n� zapisovat do souboru pro URI.', //cpg1.3.0
    'cant_unzip' => 'Nebylo mo�n� rozbalit ZIP archiv.', //cpg1.3.0
    'unknown' => 'Nezn�m� chyba', //cpg1.3.0
    'succ' => 'Usp�n� Upload', //cpg1.3.0
    'success' => '%s soubor� bylo �sp�n� nahr�no.', //cpg1.3.0
    'add' => 'Pros�m stiskn�te \'Pokra�ovat\' pro p�id�n� soubor� do galerie.', //cpg1.3.0
    'failure' => 'Chyba p�i Uploadu', //cpg1.3.0
    'f_info' => 'Informace o souboru', //cpg1.3.0
    'no_place' => 'P�edchoz� soubor nen� mo�n� um�stit.', //cpg1.3.0
    'yes_place' => 'P�edchoz� soubor byl �sp�n� um�st�n.', //cpg1.3.0
    'max_fsize' => 'Max. velikost souboru je %s KB',
    'album' => 'Galerie',
    'picture' => 'Obr�zek',
    'pic_title' => 'Nadpis obr�zku',
    'description' => 'Popis obr�zku',
    'keywords' => 'Kl��ov� slova (odd�len� mezerou)',
    'err_no_alb_uploadables' => 'Zde se nenal�z� galerie, do kter� je povolen upload.', 
    'place_instr_1' => 'Pros�m um�st�te te� soubory do galeri�. M��ete tak� zadat informace t�kaj�c� se jednotliv�ch soubor�.', //cpg1.3.0
    'place_instr_2' => 'Dal�� soubory je pot�eba um�stit. Pros�m stisk�te \'Pokra�ovat\'.', //cpg1.3.0
    'process_complete' => 'Usp�n� jste um�stil v�echny soubory.', //cpg1.3.0

);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
    'title' => 'Spravovat u�ivatele',
    'name_a' => 'Jm�no vzestup.',
    'name_d' => 'Jm�no sestup.',
    'group_a' => 'Skupina vzestup.',
    'group_d' => 'Skupina sestup.',
    'reg_a' => 'Datum registrace vzestup.',
    'reg_d' => 'Datum registrace sestup.',
    'pic_a' => 'Po�et obr�zk� vzestup.',
    'pic_d' => 'Po�et obr�zk� sestup.',
    'disku_a' => 'Vyu�it� disku vzestup.',
    'disku_d' => 'Vyu�it� disku sestup.',
    'lv_a' => 'Last visit ascending', //cpg1.3.0
    'lv_d' => 'Last visit descending', //cpg1.3.0
    'sort_by' => '�adit u��ivatele podle',
    'err_no_users' => 'Tabulka u�ivatel� je pr�zdn�!',
    'err_edit_self' => 'Zde nelze editovat vlastn� profil pou�ijte p��slu�nou volbu pracuj�c� s va��m profilem',
    'edit' => 'UPRAVIT',
    'delete' => 'SMAZAT',
    'name' => 'U�iv. jm�no',
    'group' => 'Skupina U�iv.',
    'inactive' => 'Neaktivn�',
    'operations' => 'Operace',
    'pictures' => 'Obr�zky',
    'disk_space' => 'M�sto vyu�it� / kv�ta',
    'registered_on' => 'Registrov�n',
    'last_visit' => 'Posledn� n�v�t�va', //cpg1.3.0
    'u_user_on_p_pages' => '%d u�ivatel� na %d str�nk�ch',
    'confirm_del' => 'Jste si jist(a), �e chcete smazat tohoto u�ivatele ? \\nV�echny jeho obr�zky, galerie a koment��e budou smaz�ny.',
    'mail' => 'MAIL',
    'err_unknown_user' => 'Vybran� u�iv. neexistuje !',
    'modify_user' => 'Zm�nit u�iv.',
    'notes' => 'Pozn�mky',
    'note_list' => '<li>Pokud nechcete zm�nit heslo ponechte pol��ko pro heslo pr�zdn�',
    'password' => 'Heslo',
    'user_active' => 'U�iv. je aktivn�',
    'user_group' => 'U�iv. Skupina',
    'user_email' => 'U�iv. emaill',
    'user_web_site' => 'U�iv. dom�c� str�nka',
    'create_new_user' => 'Vytvo�it nov�ho u�ivatle.',
    'user_location' => 'M�sto U�iv. (nap�. Praha apod.)',
    'user_interests' => 'U�iv. z�jmy',
    'user_occupation' => 'U�iv. povol�n�',
    'latest_upload' => 'Recent uploads', //cpg1.3.0
    'never' => 'nikdy', //cpg1.3.0

);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => 'Zm�nit velikost obr�zku',
        'what_it_does' => 'Co to d�l�?',
        'what_update_titles' => 'Aktualizovat nadpisy podle jm�na soubor�',
        'what_delete_title' => 'Smazat nadpisy',
        'what_rebuild' => 'P�ed�lat nahledy a zm�n�n� obr�zky',
        'what_delete_originals' => 'Smazat origin�ly a nahradit je st�edn�mi obr�zky',
        'file' => 'Soubor',
        'title_set_to' => 'Nastavit nadpis na',
        'submit_form' => 'odeslat',
        'updated_succesfully' => 'Aktualizace prob�hla OK',
        'error_create' => 'CHYBA p�i vytv��en�',
        'continue' => 'Zpracovatv�ce obr�zk�',
        'main_success' => 'Skoubor %s byl usp�n� pou�it jako hlavn� obr�zek',
        'error_rename' => 'Chyba p�ejmenov�n� %s na %s',
        'error_not_found' => 'Soubor %s nebyl nalezen',
        'back' => 'zp�t na halvn�',
        'thumbs_wait' => 'Aktualizuji n�hledy a/nebo st�edn� obr�zky, pros�m �ekejte...',
        'thumbs_continue_wait' => 'Pokra�uji v aktualizaci n�hled� a/nebo st�edn�ch obr�zk�...',
        'titles_wait' => 'Aktualizuji nadpisy, pros�m �ekejte...',
        'delete_wait' => 'Ma�u nadpisy, pros�m �ekejte...',
        'replace_wait' => 'Ma�u origin�ly a nahrazuji je st�edn�mi obr�zky, pros�m �ekejte...',
        'instruction' => 'Rychl� instrukce',
        'instruction_action' => 'Vyberte akci',
        'instruction_parameter' => 'Nastavit parametry',
        'instruction_album' => 'Vybrat galerii',
        'instruction_press' => 'Stiskn�te %s',
        'update' => 'Aktualizovat n�hledy a/nebo st�edn� obr�zky',
        'update_what' => 'Co m� b�t aktualizov�no',
        'update_thumb' => 'Jen n�hledy',
        'update_pic' => 'Pouze st�edn� obr�zky',
        'update_both' => 'Oboj� n�hledy i st�edn� obr�zky',
        'update_number' => 'Po�et obr�zk�, kter� zpracovat na 1 kliknut�',
        'update_option' => '(Sni�te ��slo pokud m�te probl�my s timeoutem)',
        'filename_title' => 'Jm�no souboru ? Nadpis obr�zku',
        'filename_how' => 'Jak se m� zm�nit jm�no obr�zku?',
        'filename_remove' => 'Odstranit .jpg koncovku a p�epsat _ (podtr��tka mezerami)',
        'filename_euro' => 'Zm�nit 2003_11_23_13_20_20.jpg na 23/11/2003 13:20',
        'filename_us' => 'Zm�nit 2003_11_23_13_20_20.jpg na 11/23/2003 13:20',
        'filename_time' => 'Zm�nit 2003_11_23_13_20_20.jpg na 13:20',
        'delete' => 'Smazat nadpisy obr�zk� nebo origin�ln� obr�zky',
        'delete_title' => 'Smazat nadpisy obr�zk�',
        'delete_original' => 'Smazat origin�ln� obr�zky',
        'delete_replace' => 'Smazat origin�ly a nahradit je st�edn� verz� obr�zk�',
        'select_album' => 'Vybrat galerii',
        'delete_orphans' => 'Smazat osi�el� koment��e (plat� pro v�echny galerie)', //cpg1.3.0 
        'orphan_comment' => 'Nalezeny osi�el� koment��e', //cpg1.3.0
        'delete' => 'Smazat', //cpg1.3.0 
        'delete_all' => 'Smazat v�e', //cpg1.3.0
        'comment' => 'Koment��: ', //cpg1.3.0
        'nonexist' => 'p�i�azeno k neexistuj�c�mu souboru # ', //cpg1.3.0
        'phpinfo' => 'Zobrazit phpinfo', //cpg1.3.0
        'update_db' => 'Update datab�ze', //cpg1.3.0
        'update_db_explanation' => 'Pokud jste vym�nili soubory aplikace galerie coppermine, p�idali modifikaci nebo upgradovali ze star�� verze, ujist�te se, �e jste spustili update datab�ze. To vytvo�� pot�ebn� tabulky a/nebo konfigura�n� hodnoty ve va�� datab�zi.', //cpg1.3.0
);
?>
