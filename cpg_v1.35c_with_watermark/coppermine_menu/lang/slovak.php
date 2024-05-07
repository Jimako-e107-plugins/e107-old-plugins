<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.3.2                                            //
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
// CVS version: $Id: slovak.php,v 1.5 2004/12/29 23:03:49 chtito Exp $
// ------------------------------------------------------------------------- //


// info about translators and translated language
$lang_translation_info = array(
'lang_name_english' => 'Slovak',  
'lang_name_native' => 'Slovensky', 
'lang_country_code' => 'sk', 
'trans_name'=> 'Zin (Martin Petriska)', //the name of the translator - can be a nickname
'trans_email' => 'zin@centrum.sk', //translator's email address (optional)
'trans_website' => 'http://zin.blog.sk', //translator's website (optional)
'trans_date' => '2004-11-04', //the date the translation was created / last modified
'trans_note' => 'Podpora slovenciny do Coppermine 1.3.2, preleozene z ceskeho prekladu, je mozne, ze nie vsetko je prelozene. Kodovanie win-1250, v apache treba pridat do suboru 

httpd.conf 

 AddCharset windows-1250 .cp-1250  .win-1250

teda ak to tam nemate, ja som pouzil instalaciu xampp a tam to default nebolo

subor slovak.php zkopirujte do adresara lang a vyberte v konfiguracii

zin@centrum.sk', // translator's note
);


$lang_charset = 'windows-1250';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytov', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('Ne', 'Po', 'Ut', 'St', '�t', 'Pi', 'So');
$lang_month = array('Janu�r', 'Febru�r', 'Marec', 'Apr�l', 'M�j', 'J�n', 'J�l', 'August', 'September', 'Okt�ber', 'November', 'December');

// Some common strings
$lang_yes = '�no';
$lang_no  = 'Nie';
$lang_back = 'NASPE�';
$lang_continue = 'POKRA�OVA�';
$lang_info = 'Inform�cie';
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
$lang_bad_words = array('pi�a', 'hovno', '*fuck*', 'prdel', '�ur�k', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*', 'kokot');

$lang_meta_album_names = array(
        'random' => 'N�hodn� obr�zky',
        'lastup' => 'Najnov�ie',
        'lastalb'=> 'Naposledy aktualizovan� gal�ria',
        'lastcom' => 'Najnov�ie koment�re',
        'topn' => 'Nejpozeranej�ie',
        'toprated' => 'Nejlep�ie hodnoten�',
        'lasthits' => 'Naposledy zobrazen�',
        'search' => 'V�sledky hladania',
        'favpics'=> 'Ob��ben� obr�zky',
);

$lang_errors = array(
    'access_denied' => 'Nem�te opr�vnenie na t�to str�nku',
    'perm_denied' => 'Nem�te dostato�n� pr�va pre potvrdenie tejto oper�cie.',
    'param_missing' => 'Skriptu aleboli predan� potrebn� parametre',
    'non_exist_ap' => 'Vybran� gal�ria/obr�zok neexistuje',
    'quota_exceeded' => 'Vy�erpali(a) ste miesto na disku.<br /><br />Va�a kv�ta je[quota]K, Va�e obr�zky zaberaj� [space]K, pridan�m tohto obr�zku by ste svoju kv�tu prekro�ili',
    'gd_file_type_err' => 'Pokia� pou��vate GD kni�nicu s� podporovan� len obr�zky JPG a PNG',
    'invalid_image' => 'Tento obr�zok je po�koden�/poru�en� GD knihovna s n�m nem��e pracovat.',
    'resize_failed' => 'Nieje mo�n� vytvori� n�h�ad alebo zmen�en� obr�zok',
    'no_img_to_display' => 'Tu nie je �iadny obr�zok, kter� by ste si mohli prezrie�',
    'non_exist_cat' => 'Vybran� kateg�rie neexistuje',
    'orphan_cat' => 'Podkateg�ria nem� nadriaden� kateg�riu. Probl�m opravte cez nastavenie kategori�.',
    'directory_ro' => 'Do adres�ra \'%s\' nieje mo�n� zapisova� (nedostate�n� pr�va), obr�zky nemohli by� zmazan�.',
    'non_exist_comment' => 'Vybran� koment�r neexistuje',
    'pic_in_invalid_album' => 'Obr�zok(y) je/s� v neexituj�cej galerii (%s)!?',
    'banned' => 'Bol ste vykopnut� z t�chto str�nok, nie je V�m umo�nen� ich pou��va�.',
    'not_with_udb' => 'T�to funkcia je vypnut� preto�e je integrov�na ve f�ru. Bu� nie je po�adovan� fukcia dostupn� na tomto syst�me, alebo t�to/tieto funci/e pln� f�rum.',
    'offline_title' => 'Odpojen�', //cpg1.3.0
    'offline_text' => 'Gal�ria je moment�lne odpojen� - pros�m zk�ste to znova nesk�r', //cpg1.3.0
    'ecards_empty' => 'Moment�lne nie s� k zobraniu dostupn� �iadne z�znamy o ecards. Overte pros�m, �i je zapnut� vo�ba "ecard logging" v konfigur�ci coppermine!', //cpg1.3.0
    'action_failed' => 'Akcia zlyhala.  Coppermine nie je schopn� va�u po�iadavku zpracovat.', //cpg1.3.0
    'no_zip' => 'Kni�nice potrebn� pre zpracov�nie ZIP s�borov nie s� dostupn�.  Pros�m kontaktujte Va�eho administr�tora aplik�ce Coppermine.', //cpg1.3.0
    'zip_type' => 'Nem�te povolenie nahr�va� na server s�bory ZIP.', //cpg1.3.0
);

$lang_bbcode_help = 'N�sleduj�ce zna�ky m��u by� u�ito�n�: <li>[b]<b>Tu�n�</b>[/b]</li> <li>[i]<i>Kurz�va</i>[/i]</li> <li>[url=http://vasedomena.cz/]Text odkazu[/url]</li> <li>[email]uzivatel@domena.cz[/email]</li>'; //cpg1.3.0


// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
    'alb_list_title' => 'Prejs� na zoznam gal�ri�',
    'alb_list_lnk' => 'Zoznam gal�ri�',
    'my_gal_title' => 'Prejs� do mojej osobnej gal�rie',
    'my_gal_lnk' => 'Moja gal�ria',
    'my_prof_lnk' => 'M�j Profil',
    'adm_mode_title' => 'Do Admin m�du',
    'adm_mode_lnk' => 'Admin m�d',
    'usr_mode_title' => 'Do U��vate�sk�ho m�du',
    'usr_mode_lnk' => 'U��vate�sk� m�d',
    'upload_pic_title' => 'Nahra� obr�zok do gall�rie',
    'upload_pic_lnk' => 'Upload obr�zku',
    'register_title' => 'Vytvori� ��et',
    'register_lnk' => 'Registrova� sa',
    'login_lnk' => 'Prihl�si�',
    'logout_lnk' => 'Odhl�si�',
    'lastup_lnk' => 'Najnov�ie obr�zky',
    'lastcom_lnk' => 'Posledn� koment�re',
    'topn_lnk' => 'Najprezeranej�ie',
    'toprated_lnk' => 'Najlep�ie hodnoten�',
    'search_lnk' => 'Vyh�ad�vanie',
    'fav_lnk' => 'Ob��ben�',
    'memberlist_title' => 'Uk� zoznam �lenov', //cpg1.3.0
    'memberlist_lnk' => 'Zoznam �lenov', //cpg1.3.0
    'faq_title' => 'FAQ = naj�astej�ie kladen� ot�zky na gal�rii &quot;Coppermine&quot;', //cpg1.3.0
    'faq_lnk' => 'FAQ', //cpg1.3.0

);

$lang_gallery_admin_menu = array(
    'upl_app_lnk' => 'Potvdenie uploadu',
    'config_lnk' => 'Nastavenie',
    'albums_lnk' => 'Gal�ria',
    'categories_lnk' => 'Kateg�rie',
    'users_lnk' => 'U��vatelia',
    'groups_lnk' => 'U�. skupiny',
    'comments_lnk' => 'Koment�re',
    'searchnew_lnk' => 'D�vkov� prid�vanie obr�zkov',
    'util_lnk' => 'Zmeni� ve�kos� obr�zkov',
    'ban_lnk' => 'Vykopn�� u��vate�a',
);

$lang_user_admin_menu = array(
    'albmgr_lnk' => 'Vytvori� / organizova� moju gal�riu',
    'modifyalb_lnk' => 'Zmeni� moju gal�riu',
    'my_prof_lnk' => 'M�j profil',
);

$lang_cat_list = array(
    'category' => 'Kateg�rie',
    'albums' => 'Gal�rie',
    'pictures' => 'Obr�zky',
);

$lang_album_list = array(
    'album_on_page' => '%d galeri� na %d str�nkach'
);
           //ascending VZESTUPNE
$lang_thumb_view = array(
    'date' => 'D�TUM',
    //Sort by filename and title
    'name' => 'MENO S�BORU',
    'title' => 'NADPIS',
    'sort_da' => 'Zoradi� vzostupne pod�a d�tumu',
    'sort_dd' => 'Zoradi� zostupne pod�a data',
    'sort_na' => 'Zoradi� vzostupne pod�a mena',
    'sort_nd' => 'Zoradi� zostupne pod�a mena',
    'sort_ta' => 'Zoradi� pod�a nadpisu vzostupne',
    'sort_td' => 'Zoradi� pod�a nadpisu zostupne',
    'download_zip' => 'Download ako Zip s�bor', //cpg1.3.0
    'pic_on_page' => '%d obr�zkov na %d str�nk�ch',
    'user_on_page' => '%d u��vate�ov na %d str�nk�ch'
);

$lang_img_nav_bar = array(
    'thumb_title' => 'Zpe� na str�nku s n�h�admi',
    'pic_info_title' => 'Zobraz/skry inform�cie o obr�zku',
    'slideshow_title' => 'Slideshow',
    'ecard_title' => 'Posla� tento obr�zok ako poh�adnicu',
    'ecard_disabled' => 'Poh�adnice s� vypnut�',
    'ecard_disabled_msg' => 'Nem�te dostate�n� pr�va pre zaslanie poh�adnice',
    'prev_title' => 'Predch�dzaj�ci obr�zok',
    'next_title' => '�a��� obr�zok',
    'pic_pos' => 'OBR�ZOK %s/%s',
);

$lang_rate_pic = array(
    'rate_this_pic' => 'Hodnoti� tento obr�zok ',
    'no_votes' => '(�iadne hodnotenie)',
    'rating' => '(Aktu�lne hodnotenie : %s / z 5, hlasovan� %s kr�t)',
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
    'file' => 'S�bor: ',
    'line' => 'Riadok: ',
);

$lang_display_thumbnails = array(
    'filename' => 'Meno s�boru : ',
    'filesize' => 'Ve�kost s�boru : ',
    'dimensions' => 'Rozmery : ',
    'date_added' => 'D�tum pridania : '
);

$lang_get_pic_data = array(
    'n_comments' => '%s koment�r(ov)',
    'n_views' => '%s zobrazenie',
    'n_votes' => '(%s hlas(ov))'
);

$lang_cpg_debug_output = array(
  'debug_info' => 'Debug Info', //cpg1.3.0
  'select_all' => 'Vybra� v�etko', //cpg1.3.0
  'copy_and_paste_instructions' => 'Pokia� sa chyst�te po�adovat pomoc na podpore coppermine, vlo�te tento ladiaci v�stup do v�ho pr�spevku. Pred tak�mto vlo�en�m sa uistite, �e ste v�etky va�e hesl� z tohto textu nahradili pomocou "***".', //cpg1.3.0
  'phpinfo' => 'Zobrazi� phpinfo', //cpg1.3.0
);

$lang_language_selection = array(
  'reset_language' => 'Prednastaven� jazyk', //cpg1.3.0
  'choose_language' => 'Vyberte V� jazyk', //cpg1.3.0
);

$lang_theme_selection = array(
  'reset_theme' => 'Prednastaven� t�ma', //cpg1.3.0
  'choose_theme' => 'vyberte t�mu', //cpg1.3.0
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
    0 => 'Op���am Admin M�d....:-(',
    1 => 'Vstupujem do Admin M�du....:-)',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
    'alb_need_name' => 'Gal�ria mus� ma� meno',
    'confirm_modifs' => 'Ste si ist�(a) t�mito zmenami ?',
    'no_change' => 'Neurobil(a) ste �iadne zmeny !',
    'new_album' => 'Nov� gal�ria',
    'confirm_delete1' => 'Ste si ist�(�), �e chcete zmazat t�to gal�riu ?',
    'confirm_delete2' => '\nV�etky obr�zky a koment�re bud� zmazan� !',
    'select_first' => 'Najprv vyberte gal�riu',
    'alb_mrg' => 'Spr�vca gal�ri�',
    'my_gallery' => '* Moja gal�ria *',
    'no_category' => '* Nie je kateg�ria *',
    'delete' => 'Zmaza�',
    'new' => 'Nov�/�',
    'apply_modifs' => 'Potvrdi� zmeny',
    'select_category' => 'Vybra� kateg�riu',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
    'miss_param' => 'Parametre potrebn� pre \'%s\'oper�ciu nie su dostupn� !',
    'unknown_cat' => 'Vybran� kateg�ria v datab�ze neexistuje',
    'usergal_cat_ro' => 'Nie je mo�n� zmazat u��vate�sk� gal�rie !',
    'manage_cat' => 'Spravova� kateg�rie',
    'confirm_delete' => 'Naozaj chcete SMAZAT t�to kateg�riu',
    'category' => 'Kategoria',
    'operations' => 'Oper�cia',
    'move_into' => 'Presun�� do',
    'update_create' => 'Aktualizova�/Vytvori� kateg�riu',
    'parent_cat' => 'Nadraden� kateg�ria',
    'cat_title' => 'Nadpis kateg�rie',
    'cat_thumb' => 'Miniat�ra kateg�rie', //cpg1.3.0
    'cat_desc' => 'Popis kateg�rie'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
    'title' => 'Nastavenie',
    'restore_cfg' => 'Nastavit v�chodziu',
    'save_cfg' => 'Ulo�i� konfigur�ciu',
    'notes' => 'Pozn�mky',
    'info' => 'Inform�cie',
    'upd_success' => 'Konfigur�cia bola zmenen�',
    'restore_success' => 'Konfigur�cia bola nastaven� na v�chodzie nastavenie',
    'name_a' => 'Meno vzostupne',
    'name_d' => 'Meno zostupne',
    'title_a' => 'Nadpis vzostupne',
    'title_d' => 'Nadpis zostupne',
    'date_a' => 'D�tum vzostupne',
    'date_d' => 'D�tum zostupne',
    'th_any' => 'Max Aspect',
    'th_ht' => 'V��ka',
    'th_wd' => '��rka',
    'label' => 'popis', //cpg1.3.0
    'item' => 'polo�ka', //cpg1.3.0
    'debug_everyone' => 'Ka�d�', //cpg1.3.0
    'debug_admin' => 'Iba Admin', //cpg1.3.0

);

if (defined('CONFIG_PHP')) $lang_config_data = array(
    'Z�kladn� nastavenie',
    array('Meno gal�rie', 'gallery_name', 0),
    array('Popis gal�rie', 'gallery_description', 0),
    array('Email administr�tora gal�rie', 'gallery_admin_email', 0),
    array('Cie�ov� adresa pre odkaz \'Zobrazi� �a��ie obr�zky\' v odkaze poh�adnice', 'ecards_more_pic_target', 0),
    array('Gal�ria je odpojen�', 'offline', 1), //cpg1.3.0
    array('Logova� ecards', 'log_ecards', 1), //cpg1.3.0
    array('Povoli� ZIP-s�ahov�nie ob��ben�ch', 'enable_zipdownload', 1), //cpg1.3.0

    'Jazyk, T�my &amp; nastavenie znakovej sady',
    array('Jazyk', 'lang', 5),
    array('T�ma', 'theme', 6),
    array('Zobrazi� zoznam jazykov', 'language_list', 1), //cpg1.3.0
    array('Zobrazi� vlajky jazykov', 'language_flags', 8), //cpg1.3.0 
    array('Zobrazi� &quot;reset&quot; vo v�bere jazyka', 'language_reset', 1), //cpg1.3.0
    array('Zobrazi� zoznam t�m', 'theme_list', 1), //cpg1.3.0
    array('Zobrazi� &quot;reset&quot; vo v�bere t�m', 'theme_reset', 1), //cpg1.3.0
    array('Zobrazi� FAQ', 'display_faq', 1), //cpg1.3.0
    array('Zobrazi� n�povedu bbcode', 'show_bbcode_help', 1), //cpg1.3.0
    array('K�dov�n�e znakov', 'charset', 4), //cpg1.3.0

    'Nastaven� zobrazen�',
    array('��rka hlavnej tabu�ky v (pixeloch alebo %)', 'main_table_width', 0),
    array('Po�et �rovn� subkategori�', 'subcat_level', 0),
    array('Po�et gal�ri� na str�nku', 'albums_per_page', 0),
    array('Po�et st�pcov v preh�ade gal�ri�', 'album_list_cols', 0),
    array('Ve�kos� n�h�adov v pixeloch', 'alb_list_thumb_size', 0),
    array('Obsah hlavnej str�nky', 'main_page_layout', 0),
    array('Ukazova� v kateg�ri�ch n�h�ady gal�ri� prvej �rovne','first_level',1),

    'Zobrazenie n�h�adov',
    array('Po�et st�pcov na str�nku', 'thumbcols', 0),
    array('Po�et riadkov na str�nku', 'thumbrows', 0),
    array('Maxim�lne mno�stvo z�lo�iek', 'max_tabs', 0),
    array('Zobrazi� legendu obr�zkov pod n�h�adom', 'caption_in_thumbview', 1),
    array('Zobrazi� po�et prehliadnut� pod n�h�adom', 'views_in_thumbview', 1), //cpg1.3.0
    array('Zobrazi� po�et koment�rov pod n�h�adom', 'display_comment_count', 1),
    array('Zobrazi� meno autora pod n�h�adom', 'display_uploader', 1), //cpg1.3.0
    array('Z�kladn� radenie n�h�adov', 'default_sort_order', 3),
    array('Min. po�et hlasov potrebn� k zaradeniu do zoznamu \'Najlep�ie hodnoten�\'', 'min_votes_for_rating', 0),

    'Zobrazenie obr�zkov &amp; Nastavenie koment�rov',
    array('��rka tabu�ky pre zobrazenie obr�zku (v pixeloch alebo %)', 'picture_table_width', 0),
    array('V�dy zobrazi� podrobn� info', 'display_pic_info', 1),
    array('CENZ�ROVAT slova v koment�roch', 'filter_bad_words', 1),
    array('Povoli� smajl�ky v koment�roch', 'enable_smilies', 1),
    array('Maxim�lna d�ka popisu obr�zku', 'max_img_desc_length', 0),
    array('Maxim�lna d�ka slova v koment�ri', 'max_com_wlength', 0),
    array('Maxim�lne mno�stvo riadkov v koment�ri', 'max_com_lines', 0),
    array('Maxim�ln� d�ka koment�re', 'max_com_size', 0),
    array('Uk�za� filmov� pr��ok', 'display_film_strip', 1),
    array('Po�et polo�iek vo filmovom pr��ku', 'max_film_strip_items', 0),
    array('Upozorni� adminitratora na koment�re pomoc� emailu', 'email_comment_notification', 1), //cpg1.3.0 
    array('Slideshow interval v milisekund�ch (1 sekunda = 1000 milisekund)', 'slideshow_interval', 0), //cpg1.3.0 

    'Obr�zky a nastavenie n�h�adov',
    array('Kvalita s�borov JPEG', 'jpeg_qual', 0),
    array('Maxim�lne rozmery n�h�adu <b>*</b>', 'thumb_width', 0),
    array('Pou�i� rozmer ( ��rka alebo v��ka alebo maxim�lny rozmer n�h�adu )<b>*</b>', 'thumb_use', 7),
    array('Vytvori� stredn� obr�zek','make_intermediate',1),
    array('Maxim�lna ��rka alebo v��ka stredn�ho obr�zku <a href="#notice2" class="clickable_option">**</a>', 'picture_width', 0), //cpg1.3.0
    array('Maxim�ln� velikost uploadovan�ch obr�zkov (KB)', 'max_upl_size', 0),
    array('Maxim�lne rozmery uploadovan�ch obr�zkov (v pixelech)', 'max_upl_width_height', 0),

    'Obr�zky a n�h�ady roz��ren� nastavenie',
    array('Zobrazit ikonu zamknut� gal�ria neprihl�sen�mu u�ivate�ovi.','show_private',1),
    array('Znaky zak�zan� v n�zvoch s�borov', 'forbiden_fname_char',0),
    //array('Povolen� koncovky uploadovan�ch s�borov', 'allowed_file_extensions',0),
    array('Povolen� typy obr�zkov', 'allowed_img_types',0), //cpg1.3.0
    array('Povolen� typy videa', 'allowed_mov_types',0), //cpg1.3.0
    array('Povolen� typy audia', 'allowed_snd_types',0), //cpg1.3.0
    array('Povolen� typy dokumentov', 'allowed_doc_types',0), //cpg1.3.0
    array('Met�da zmeny ve�kosti obr�zkov','thumb_method',2),
    array('Cesta k ImageMagicu (pr�klad /usr/bin/X11/)', 'impath', 0),
    //array('Povolen� typy obr�zkov (iba pre ImageMagic)', 'allowed_img_types',0),
    array('Parametre pre ImageMagic', 'im_options', 0),
    array('��ta� EXIF data zo s�borov JPEG', 'read_exif_data', 1),
    array('��ta� IPTC data zo s�borov JPEG', 'read_iptc_data', 1), //cpg1.3.0
    array('Adres�r pre gal�riu <b>*</b>', 'fullpath', 0),
    array('Adres�r pre gal�riu u��vate�ov <b>*</b>', 'userpics', 0),
    array('Prefix pre stredne ve�k� obr�zky <b>*</b>', 'normal_pfx', 0),
    array('Prefix pre n�h�ady <b>*</b>', 'thumb_pfx', 0),
    array('Z�kladn� m�d pre adres�re', 'default_dir_mode', 0),
    array('Z�kladn� m�d pre obr�zky', 'default_file_mode', 0),

    'Nastavenie u��vate�ov',
    array('Povoli� registr�ciu nov�ch u��vate�ov', 'allow_user_registration', 1),
    array('Pre registr�ciu vy�adova� potvrdenie admina', 'reg_requires_valid_email', 1),
    array('Upozorni� administr�tora na registr�ciu nov�ho u��vate�a pomocou emailu', 'reg_notify_admin_email', 1), //cpg1.3.0
    array('Povoli� pre dvoch u�ivate�ov rovnak� email', 'allow_duplicate_emails_addr', 1),
    array('Maj� ma� u��vatelia vlastn� gal�rie?', 'allow_private_albums', 1),
    array('Upozorni� administr�tora na vlo�en� s�bor �ekaj�ci na schv�lenie', 'upl_notify_admin_email', 1), //cpg1.3.0
    array('Dovoli� prihl�sen�m u��vate�om, aby videli zoznam u��vate�ov', 'allow_memberlist', 1), //cpg1.3.0

    'Vlastn� polo�ky pre popis obr�zku (Nechajte pr�zdne a nezobraz� sa)',
    array('Meno polo�ky 1', 'user_field1_name', 0),
    array('Meno polo�ky 2', 'user_field2_name', 0),
    array('Meno polo�ky 3', 'user_field3_name', 0),
    array('Meno polo�ky 4', 'user_field4_name', 0),

    'Cookies &amp; K�dov� str�nka',
    array('Meno cookies u��van� programem (expertn� volba)', 'cookie_name', 0),
    array('Cesta pre cookies u��van� programem (expertn� volba)', 'cookie_path', 0),
    array('K�dov� str�nka', 'charset', 4),

    '�a��ie nastavenie',
    array('Zapn�� ladiaci m�d (len pre testovanie)', 'debug_mode', 1),
    array('Zobrazova� v ladiacom m�de upozornenie', 'debug_notice', 1), //cpg1.3.0


    '<br /><div align="center">(*) Polo�ky ozna�en� * sa NESM� zmeni� pokia� u� m�te ve va�ej gal�rii nahran� obr�zky</div><br />
    <a name="notice2"></a>(**) Pri zmene tohto nastavenia sa zmena prejav� iba u s�borov, kter� s� 
	pridan� a� od tohto okam�iku. Je doporu�en� nemeni� toto nastavenie pokia� u� s� v galerii nejak� s�bory. 
	Aj tak je mo�n� necha� uplatni� zmeny i na u� existuj�ce s�bory pomocou n�stroja
	&quot;<a href="util.php">admin tools</a> (resize pictures)&quot; v admin menu.</div><br />', //cpg1.3.0

);

// ------------------------------------------------------------------------- //
// File db_ecard.php //cpg1.3.0
// ------------------------------------------------------------------------- //
if (defined('DB_ECARD_PHP')) $lang_db_ecard_php = array(
  'title' => 'Zasielanie ecards', //cpg1.3.0
  'ecard_sender' => 'Odosielate�', //cpg1.3.0
  'ecard_recipient' => 'Pr�jemca', //cpg1.3.0
  'ecard_date' => 'D�tum', //cpg1.3.0
  'ecard_display' => 'Zobrazit ecard', //cpg1.3.0
  'ecard_name' => 'Meno', //cpg1.3.0
  'ecard_email' => 'Email', //cpg1.3.0
  'ecard_ip' => 'IP #', //cpg1.3.0
  'ecard_ascending' => 'vzostupne', //cpg1.3.0
  'ecard_descending' =>'zostupne', //cpg1.3.0
  'ecard_sorted' => 'Utrieden�', //cpg1.3.0
  'ecard_by_date' => 'pod�a d�tumu', //cpg1.3.0
  'ecard_by_sender_name' => 'pod�a mena odesielate�a', //cpg1.3.0
  'ecard_by_sender_email' => 'pod�a emailu odesielate�a', //cpg1.3.0
  'ecard_by_sender_ip' => 'pod�a IP addressy odesielate�a', //cpg1.3.0
  'ecard_by_recipient_name' => 'pod�a mena pr�jemcu', //cpg1.3.0
  'ecard_by_recipient_email' => 'pod�a emailu pr�jemcu', //cpg1.3.0
  'ecard_number' => 'zobrazenie z�znamu %s a� %s z %s', //cpg1.3.0
  'ecard_goto_page' => 'prechod na stranu', //cpg1.3.0
  'ecard_records_per_page' => 'z�znamu na jednej strane', //cpg1.3.0
  'check_all' => 'Zatrhnout v�etko', //cpg1.3.0
  'uncheck_all' => 'Odzna�it v�etko', //cpg1.3.0
  'ecards_delete_selected' => 'Zmaza� vybran� ecards', //cpg1.3.0
  'ecards_delete_confirm' => 'Ste si ist�, �e chcete zmaza� z�znamy? Nastavte checkbox!', //cpg1.3.0 
  'ecards_delete_sure' => 'Som si ist�.', //cpg1.3.0
);
                                                                                                                  



// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
    'empty_name_or_com' => 'Vlo�te meno a V� koment�r',
    'com_added' => 'V� koment�r bol pridan�',
    'alb_need_title' => 'Pros�m, dajte gal�rii nadpis !',
    'no_udp_needed' => 'Aktualiz�cia nen� potrebn�.',
    'alb_updated' => 'Gal�ria bola pridan�',
    'unknown_album' => 'Vybran� gal�ria neexistuje alebo nem�te pr�va pre upload do tejto gal�rie',
    'no_pic_uploaded' => 'Obr�zek nebol uploadovan�!<br /><br />zkontrolujte �i server podporuje upload s�borov, �i ste naozaj zadal(a) obr�zok pre upload...',
    'err_mkdir' => '  ERROR: Chyba pri vytv�ran� adres�ra (nebol vytvoren�) %s !',
    'dest_dir_ro' => 'Do cielov�ho adres�ra %s nem��e skript zapisova� (zkontrolujte pr�va) !',
    'err_move' => 'nie je mo�n� presun�� %s do %s !',
    'err_fsize_too_large' => 'Rozmery obr�zku, kter� sa sna��te uploadovat, s� pr�li� ve�k� (max. ve�kos� je %s x %s) !',
    'err_imgsize_too_large' => 'Ve�ikos� s�boru, kter� se sna��te uploadova�, je pr�li� ve�k� (max. ve�kos� je %s KB) !',
    'err_invalid_img' => 'S�bor kter� ste nahral(a) na server nieje obr�zkom !',
    'allowed_img_types' => 'M��ete uploadova� iba obr�zky %s .',
    'err_insert_pic' => 'Obr�zok \'%s\' nie je mo�n� vlo�i� do gal�rie ',
    'upload_success' => 'V� obr�zok bol nahran� na server bez probl�mov<br /><br />Bude vidite�n� po schv�len� adminom.',
    'notify_admin_email_subject' => '%s - upozornenie na Upload', //cpg1.3.0 
    'notify_admin_email_body' => '%s nahral do gal�rie obr�zok, kter� vy�aduje va�e potvrdenie. Nav�t�vte pros�m %s', //cpg1.3.0
    'info' => 'Inform�cie',
    'com_added' => 'koment�rov pridan�ch',
    'alb_updated' => 'Gal�ria aktualizov�na',
    'err_comment_empty' => 'V� koment�r je pr�zdny !',
    'err_invalid_fext' => 'Iba s�bory s n�sleduj�cimi koncovkami s� podporovan� : <br /><br />%s.',
    'no_flood' => 'Ste autor posledn�ho koment�ra k tomuto obr�zku<br /><br />Pokia� ho chcete zmeni� pou�ite vo�bu upravi� ',
    'redirect_msg' => 'Pr�ve ste presmerov�van�(a).<br /><br /><br />Kliknite na \'POKRA�OVAT\' pokia� sa str�nka nepresmeruje sama',
    'upl_success' => 'V� obr�zok bol v poriadku pridan�',
    'email_comment_subject' => 'koment�r bol pridan� do Coppermine Photo Gallery', //cpg1.3.0 
    'email_comment_body' => 'Niekto pridal koment�r do va�ej gal�rie. Prezrite si ho na', //cpg1.3.0

);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
    'caption' => 'Legenda(popis)',
    'fs_pic' => 'p�vodn� ve�kos� obr�zku',
    'del_success' => 'bezchybne zmazan�',
    'ns_pic' => 'norm�lna ve�kos� obr�zku',
    'err_del' => 'nie je mo�n� zmazat',
    'thumb_pic' => 'n�h�ad',
    'comment' => 'koment�r',
    'im_in_alb' => 'patr� do gal�rie',
    'alb_del_success' => 'Gal�ria \'%s\' zmazan�',
    'alb_mgr' => 'Spr�vca gal�ri�',
    'err_invalid_data' => 'Z�skan� chybn� d�ta \'%s\'',
    'create_alb' => 'Vytv�ram gal�riu \'%s\'',
    'update_alb' => 'Aktualizujem gal�riu \'%s\' s nadpisom \'%s\' a zoznamom \'%s\'',
    'del_pic' => 'Zmaza� obr�zok',
    'del_alb' => 'Zmaza� gal�riu',
    'del_user' => 'Zmaza� u��vate�a',
    'err_unknown_user' => 'Vybran� u�ivate� neexistuje !',
    'comment_deleted' => 'koment�r bezchybne zmazan� ! ',
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
    'confirm_del' => 'Ste si ist�, �e chcete zmazat tento obr�zok ? \\nPrilo�en� koment�re bud� straten�.',
      'del_pic' => 'ZMAZA� TENTO OBR�ZEK',
    'size' => '%s x %s pixelelov',
    'views' => '%s kr�t',
    'slideshow' => 'Slideshow',
    'stop_slideshow' => 'ZASTAVI� SLIDESHOW',
    'view_fs' => 'kliknite pre zobrazenie p�vodn�ho obr�zku',
    'edit_pic' => 'Edituj popis', //cpg1.3.0
    'crop_pic' => 'Ore� a oto�', //cpg1.3.0

);

$lang_picinfo = array(
    'title' =>'Inform�cia o obr�zku',
    'Filename' => 'Meno s�boru',
    'Album name' => 'Meno gal�rie',
    'Rating' => 'Hodnotenie (%s hlas(ov))',
    'Keywords' => 'K���ov� slov�',
    'File Size' => 'Ve�kos� s�boru',
    'Dimensions' => 'Rozmery',
    'Displayed' => 'Zobrazen�',
    'Camera' => 'Fotoapar�t',
    'Date taken' => 'D�tum z�skania sn�mku',
    'Aperture' => 'Clona',
    'Exposure time' => 'Expozi�n� �as',
    'Focal length' => 'Ohniskov� vzdialenos�',
    'Comment' => 'koment�re',
    'addFav' => 'Prida� k ob��ben�m',
    'addFavPhrase' => 'Ob��ben�',
    'remFav' => 'Odstr�ni� z ob��ben�ch',
    'iptcTitle'=>'IPTC Title', //cpg1.3.0
    'iptcCopyright'=>'IPTC Copyright', //cpg1.3.0
    'iptcKeywords'=>'IPTC Keywords', //cpg1.3.0
    'iptcCategory'=>'IPTC Category', //cpg1.3.0
    'iptcSubCategories'=>'IPTC Sub Categories', //cpg1.3.0
);

$lang_display_comments = array(
    'OK' => 'OK',
    'edit_title' => 'Upravi� tento koment�r',
    'confirm_delete' => 'Ste si ist�(�), �e chcete zmazat tento koment�r ?',
    'add_your_comment' => 'Prida� koment�r',
    'name'=>'Meno',
    'comment'=>'koment�r',
    'your_name' => 'Anonym',
);

$lang_fullsize_popup = array(
        'click_to_close' => 'Kliknut�m na obr�zok zavriete okno',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
    'title' => 'Posla� poh�adnicu',
    'invalid_email' => '<b>Varov�nie</b> : neplatn� emailov� adresa !',
    'ecard_title' => 'Poh�adnica zo serveru %s pre v�s/teba',
    'error_not_image' => 'Iba obr�zky m��u by� poslan� ako ecard.', //cpg1.3.0
    'view_ecard' => 'Pokia� se poh�adnica nezobrazila klikni na link',
    'view_more_pics' => 'Klikni pre da��ie obr�zky !',
    'send_success' => 'Va�a poh�adnica bola odesl�na',
    'send_failed' => 'Ospravedl�ujeme sa, ale server nebol schopn� odosla� Va�u poh�adnicu zk�ste
     to znovu za chv�u...',
    'from' => 'Od',
    'your_name' => 'Va�e meno',
    'your_email' => 'V� email',
    'to' => 'Komu',
    'rcpt_name' => 'Meno pr�jemcu',
    'rcpt_email' => 'Doru�i� na email',
    'greetings' => 'Pozdrav/oslovenie',
    'message' => 'Spr�va',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
    'pic_info' => 'Info&nbsp;o obr�zku',
    'album' => 'Gal�ria',
    'title' => 'Nadpis',
    'desc' => 'Popis',
    'keywords' => 'K���ov� slov�',
    'pic_info_str' => '%sx%s - %sKB - %s zobrazen� - %s hlas(ov)',
    'approve' => 'Schv�li� obr�zok',
    'postpone_app' => 'Odlo�i� schv�lenie',
    'del_pic' => 'Zmaza� obr�zok',
    'read_exif' => 'Na��ta� znovu EXIF info', //cpg1.3.0
    'reset_view_count' => 'Vynulova� po��tadlo zobrazen�',
    'reset_votes' => 'Vynulova� hlasy',
    'del_comm' => 'Zmaza� koment�re',
    'upl_approval' => 'Potvrdenie uploadu',
    'edit_pics' => 'Upravi� obr�zky',
    'see_next' => 'Zobrazi� �al�ie obr�zky',
    'see_prev' => 'Zobrazit predch�zaj�ce obr�zky',
    'n_pic' => '%s obr�zkov',
    'n_of_pic_to_disp' => 'Po�et obr�zkov k zobrazeniu',
    'apply' => 'Ulo�i� zmeny',
    'crop_title' => 'Coppermine Editor Obr�zkov', //cpg1.3.0 
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
  'answer' => 'Odpove�: ', //cpg1.3.0
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
  'forgot_passwd' => 'Pripomenutie hesla', //cpg1.3.0
  'err_already_logged_in' => 'U� ste prihl�sen�(�)!', //cpg1.3.0
  'enter_username_email' => 'Zadajte va�e prihlasovacie meno a email adresu', //cpg1.3.0
  'submit' => 'Prove�', //cpg1.3.0
  'failed_sending_email' => 'Email s pripomenut�m hesla nemohol by� odoslan�!', //cpg1.3.0
  'email_sent' => 'Na adresu 5s bol odoslan� mail z va�im u�ivate�sk�m menom a heslom', //cpg1.3.0
  'err_unk_user' => 'Zadan� u��vate� neexistuje!', //cpg1.3.0
  'passwd_reminder_subject' => '%s - Pripomenutie hesla', //cpg1.3.0
  'passwd_reminder_body' => 'Po�iadali ste o pripomenutia va�ich prihlasovac�ch �dajov:
U�ivatelsk� jm�no: %s
Heslo:             %s
Kliknite na %s pre prihl�senie.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
    'group_name' => 'Meno skupiny',
    'disk_quota' => 'Diskov� kv�ta',
    'can_rate' => 'M��u hodnoti� obr�zky',
    'can_send_ecards' => 'm��u posiela� poh�adnice',
    'can_post_com' => 'M��u posiela� koment�re',
    'can_upload' => 'M��u nahr�va� obr�zky',
    'can_have_gallery' => 'M��u ma� osobn� gal�riu',
    'apply' => 'Ulo�i� zmeny',
    'create_new_group' => 'Vytvori� nov� skupinu',
    'del_groups' => 'Zmaza� vybran� skupiny',
    'confirm_del' => 'Pokia� zma�ete t�to skupinu v�etci u��vatelia, patriaci do tejto skupiny bud� presunut� do skupiny \'Registered\' !\n\nPrajete si pokra�ova� ?',
    'title' => 'Spravova� u��vate�sk� skupiny',
    'approval_1' => 'Potvrdenie verejn�ho. Upl. (1)',
    'approval_2' => 'Potvrdenie s�kromn�ho. Upl. (2)',
    'upload_form_config' => 'Konfigur�cia formul�ra pre upload', //cpg1.3.0 
    'upload_form_config_values' => array( 'Iba jednotliv� s�bory', 'Iba mnoho s�borov', 'Iba URI uploads', 'Iba ZIP upload', 'S�bory-URI', 'S�bory-ZIP', 'URI-ZIP', 'S�bory-URI-ZIP'), //cpg1.3.0  //TODO
    'custom_user_upload'=>'U�ivate� m��e upravi� po�et vstupn�ch pol��ok pre upload?', //cpg1.3.0
    'num_file_upload'=>'Maxim�lny/presn� po�et pol��ok pre upload s�borov', //cpg1.3.0
    'num_URI_upload'=>'Maxim�lny/presn� po�et pol��ok pre upload URI', //cpg1.3.0

    'note1' => '<b>(1)</b> Upload do verejn�ch galeri� vy�aduje potvrdenie adminom',
    'note2' => '<b>(2)</b> Upload do gal�rie patriacej u��vate�om vy�aduje potvrdenie adminom',
    'notes' => 'Pozn�mky'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
    'welcome' => 'Vitajte !'
);

$lang_album_admin_menu = array(
    'confirm_delete' => 'Ste si is�(�), �e chcete zmaza� t�to gal�riu? \\nV�etky obr�zky a koment�re p�jdu do pekla tie�. Prajete si pokra�ova�.',
    'delete' => 'ZMAZA�',
    'modify' => 'VLASTNOSTI',
    'edit_pics' => 'UPRAVI� OBR.',
);

$lang_list_categories = array(
    'home' => 'Domov',
    'stat1' => '<b>[pictures]</b> obr�zkov v <b>[albums]</b> gal�riach v <b>[cat]</b> kateg�ri�ch s <b>[comments]</b> koment�rmi zobrazen� <b>[views]</b> kr�t',
    'stat2' => '<b>[pictures]</b> obr�zkov v <b>[albums]</b> gal�riach zobrazen� <b>[views]</b> kr�t',
    'xx_s_gallery' => '%s\' galeri�',
    'stat3' => '<b>[pictures]</b> obr�zkov v <b>[albums]</b> gal�riach s <b>[comments]</b> koment�rmi zobrazen� <b>[views]</b> kr�t'
);

$lang_list_users = array(
    'user_list' => 'Zoznam u��vate�ov',
    'no_user_gal' => 'Nie s� �iadne u��vate�sk� gal�rie',
    'n_albums' => '%s gal�ri�',
    'n_pics' => '%s obr�zkov'
);

$lang_list_albums = array(
    'n_pictures' => '%s obr�zkov',
    'last_added' => ', posledn� pridan� %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
    'login' => 'Prihl�senie',
    'enter_login_pswd' => 'Zadajte Va�e meno a heslo pre prihl�senie',
    'username' => 'Meno',
    'password' => 'Heslo',
    'remember_me' => 'Pam�taj si ma',
    'welcome' => 'Vitaj u n�s %s ...',
    'err_login' => '*** Chyba pri prihl�sen� sk�ste to znova ***',
    'err_already_logged_in' => 'U� ste prihl�sen� !',
    'forgot_password_link' => 'Zabudol som svoje heslo.', //cpg1.3.0

);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
    'logout' => 'Odhl�si�',
    'bye' => 'Tak si to u�i zase inde %s ...',
    'err_not_loged_in' => 'Nie ste prihl�sen� !',
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
    'upd_alb_n' => 'Aktualizova� album %s',
    'general_settings' => 'Z�kladn�� nastavenie',
    'alb_title' => 'Nadpis gal�rie',
    'alb_cat' => 'Kateg�rie gal�rie',
    'alb_desc' => 'Popis gal�rie',
    'alb_thumb' => 'N�h�ad reprezentuj�c� album',
    'alb_perm' => 'Pr�stupov� pr�va pre t�to gal�riu',
    'can_view' => 'Album m��u prehliada�',
    'can_upload' => 'N�v�tevn�ci m��u prid�va� obr�zky',
    'can_post_comments' => 'Povoli� koment�re',
    'can_rate' => 'N�v�tevn�ci m��u hlasova�',
    'user_gal' => 'User Gallery',
    'no_cat' => '* Nieje kateg�ria *',
    'alb_empty' => 'Gal�ria je pr�zdn�',
    'last_uploaded' => 'Nejnov�� obr�zok',
    'public_alb' => 'ktoko�vek (verejn� gal�ria)',
    'me_only' => 'Iba ja',
    'owner_only' => 'Iba vlastn�k (%s)',
    'groupp_only' => '�lenovia skupiny \'%s\'',
    'err_no_alb_to_modify' => 'Album nie je mo�n� modifikovat v datab�ze.',
    'update' => 'Aktualizova� album',
    'notice1' => '(*) depending on %sgroups%s settings', //cpg1.3.0 (do not translate %s!)
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
    'already_rated' => 'Tento ob�zok ste u� hodnotil(a)',
    'rate_ok' => 'V�s hlas bol prijat�. �akujeme.',
    'forbidden' => 'You can not rate your own files.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
Administr�tori serveru {SITE_NAME}, alebo tejto gal�rie si vyhradzuj� pr�vo z�sahu do obsahu gal�rie napr. koment�re, maz�nie obr�zkov pr�padne �prava (pokia� poru�uj� pravidl� gal�rie alebo dobr� mravy).
Pokia� bud� obr�zky nahran� u��vate�om poru�ova� z�kon(y) bud� ihne� po zisten� ich umiestnen� na serveri zmazan�. Administr�tori/spr�vcovia tejto gal�rie sa di�tancuj� od
pr�padn�ho z�vadn�ho obsahu nahran�ho na server u��vate�mi. Vlastn�kom d�t v gal�rii s� ich autori. Administr�tori predpokladaj�, �e na server s� umiest�ovan� u��vate�mi obr�zky ku ktor�m vlastn� u�ivate� autorsk� pr�va.
<br />
S�hlas�te, �e nebudete posiela� ak�ko�vek z�vadn� materi�l ako vulg�rny a obsc�nne obr�zky/koment�re, ak�ko�vek materi�l vzbudzuj�ci nen�vis�, rasismus, alebo in� materi�l poru�uj�c� z�kony. S�hlas�te, �e administr�tori, spr�vcovia a moder�tori  {SITE_NAME}   maj� pr�vo zmaza� pr�padne upravi� ak�ko�vek materi�l kedyko�vek to uznaj� za vhodn�. Vlo�en� inform�cie bud� ulo�en� na serveri a v datab�zi a nebud� poskytnut� �iadnej tretej strane bez v�ho s�hlasu. Administ�tori/spr�vcovia serveru  v�ak nebud� ru�i� za d�ta na serveru ulo�en� pokia� d�jde k ak�muko�vek �toku na sever.
<br />
<br />
Tieto str�nky vyu��vaj� k ulo�eniu u�ivate�sk�ch d�t cookies. Cookies sl��ia iba pre zv��enie konfortu pri pou��van� tejto aplik�ce. Emailov� adresa sl��i len pre potvrdenie va�ich �dajov a posielanie hesla.<br />
<br />
Kliknut�m na 'S�hlas�m' s�hlas�te z vy��ie uveden�mi pravidlami..
EOT;

$lang_register_php = array(
    'page_title' => 'Registr�cia nov�ho u��vate�a',
    'term_cond' => 'Podmienky a pravidl�',
    'i_agree' => 'S�hlas�m',
    'submit' => 'Posla� registr�ciu',
    'err_user_exists' => 'Zadan� u��vate�sk� meno u� existuje vyberte si pros�m in�',
    'err_password_mismatch' => 'Hesl� sa musia zhodova� pok�ste sa ich zada� znova',
    'err_uname_short' => 'Minim�lna d�ka u�ivate�skeho mena je 2 znaky',
    'err_password_short' => 'Heslo mus� by� aspo� 2 znaky dlh�',
    'err_uname_pass_diff' => 'Meno a heslo se nesmie zhodova�',
    'err_invalid_email' => 'Bola zadan� neplatn� emailov� adresa',
    'err_duplicate_email' => 'In� u��vate� sa zaregistroval zo zadan�m emailem. Email mus� by� jedine�n�',
    'enter_info' => 'Zadan� registra�n� inform�cie',
    'required_info' => 'Vy�adovan� inform�cie',
    'optional_info' => 'Volite�n� inform�cie',
    'username' => 'Meno',
    'password' => 'Heslo',
    'password_again' => 'Heslo (potvrdenie)',
    'email' => 'Email',
    'location' => 'Miesto (napr. Ko�ice apod.)',
    'interests' => 'Z�ujmy',
    'website' => 'Dom�ca str�nka',
    'occupation' => 'Povolanie',
    'error' => 'CHYBA',
    'confirm_email_subject' => '%s - Potvrdenie registr�cie',
    'information' => 'Inform�cie',
    'failed_sending_email' => 'nie je mo�n� odoslat potvrdenie registr�cie !',
    'thank_you' => '�akujeme za registr�ciu.<br /><br />Na adresu zadan� pri registr�cii V�m bud� doru�en� inform�cie o aktiv�ci v�ho ��tu',
    'acct_created' => 'V� u�ivatelsk� ��et bol bezchybne vytvoren�. Teraz sa prihl�ste pomocou v�ho mena a hesla',
    'acct_active' => 'V� ��et je odteraz akt�vny prihlaste sa pomocou v�ho mena a hesla.',
    'acct_already_act' => 'V� ��et je u� aktivny !',
    'acct_act_failed' => 'Tento ��et nem��e by� aktivovan� !',
    'err_unk_user' => 'Vybran� u��vate� neexistuje !',
    'x_s_profile' => '%s\' profil',
    'group' => 'Skupina',
    'reg_date' => 'Pripojen�',
    'disk_usage' => 'Vyu�itie disku',
    'change_pass' => 'Zmeni� heslo',
    'current_pass' => 'S��asn� heslo',
    'new_pass' => 'Nov� heslo',
    'new_pass_again' => 'Nov� heslo (kontrola)',
    'err_curr_pass' => 'S��asn� heslo zad�n� nespr�vne',
    'apply_modif' => 'potvrdi� zmeny',
    'change_pass' => 'Zmeni� heslo',
    'update_success' => 'V� profil bol aktualizovan�',
    'pass_chg_success' => 'Va�e heslo bolo zmenen�',
    'pass_chg_error' => 'Va�e heslo nebolo zmenen�',
    'notify_admin_email_subject' => '%s - upozornen� na registr�ciu', //cpg1.3.0 
    'notify_admin_email_body' => 'Nov� u��vate� s m�nom "%s" sa registroval vo va�ej gal�rii', //cpg1.3.0
);

$lang_register_confirm_email = <<<EOT
�akujeme za registr�ciu na {SITE_NAME}

Va�e m�no je : "{USER_NAME}"
Va�e heslo je: "{PASSWORD}"

Pre aktiv�ciu v�ho ��tu je treba klikn�� na odkaz ni��ie alebo ho zkop�rova�
do adresn�ho riadku v�ho browseru a prejs� na t�to str�nku


{ACT_LINK}

S pozdravom,

Spr�va serveru {SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
    'title' => 'Kontrola koment�rov',
    'no_comment' => 'Nie s� �iadne koment�re na kontrolu',
    'n_comm_del' => '%s koment�r(ov) zmazan�(ch)',
    'n_comm_disp' => 'Po�et koment�rov k zobrazeniu',
    'see_prev' => 'Predch�dzaj�ci',
    'see_next' => '�a���',
    'del_comm' => 'Zmaza� vybran� koment�re',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
    0 => 'Prehled�va� obr�zky',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
    'page_title' => 'N�js� nov� obr�zky',
    'select_dir' => 'Vybra� adres�r',
    'select_dir_msg' => 'T�to funkcia v�m umo�n� d�vkovo zpracova� obr�zky nahran� cez FTP.<br /><br />Vyberte adres�r kde se nach�dzaj� obr�zky k spracov�niu',
    'no_pic_to_add' => 'Nie s� tu �iadne obr�zky k pridaniu',
    'need_one_album' => 'Potrebujete ma� vytvoren� aspo� jednu gal�riu',
    'warning' => 'Varovanie',
    'change_perm' => 'Skript nem��e zapisova� do tohto adres�ra, mus�te ho nastavi� na CHMOD 755 alebo 777 pred prid�n�m obr�zkov !',
    'target_album' => '<b>Vlo�i� obr�zky z &quot;</b>%s<b>&quot; do </b>%s',
    'folder' => 'Zlo�ka',
    'image' => 'Obr�zek',
    'album' => 'Gal�ria',
    'result' => 'V�sledok',
    'dir_ro' => 'Nezapisovateln�. ',
    'dir_cant_read' => 'Ne�itate�n�. ',
    'insert' => 'Prid�vam nov� obr�zky do gal�rie',
    'list_new_pic' => 'Zoznam obr�zkov',
    'insert_selected' => 'Vlo�i� vybran� obr�zky',
    'no_pic_found' => '�iadne nov� obr�zky',
    'be_patient' => 'Pros�m bu�te trpezliv�(�), program potrebuje na zpracovanie obr�zkov nejak� ten �as.',
    'notes' =>  '<ul>'.
                '<li><b>OK</b> : Tieto obr�zky boli pridan�'.
                '<li><b>DP</b> : Zdvojenie!, Tento obr�zek u� existuje'.
                '<li><b>PB</b> : tento obr�zok nie je mo�n� prida�, skontrolujte konfigur�ciu pr�padne pr�stupov� pr�va'.
                '<li>Ke� sa neuk�e \'ozna�enie\' OK, DP, PB klepnite na obr�zok a uvid�te chybov� hl�ku generovan� PHP, ktor� V�m pom��e zisti� pr��inu probl�mu'.
                '<li>Pokia� d�jde k timeoutu F5 alebo reload str�nky by mal pom�c�'.
                '</ul>',
     'select_album' => 'Vyberte gal�riu', //cpg1.3.0 
     'check_all' => 'Vybra� v�etko', //cpg1.3.0
     'uncheck_all' => 'Odzna�i� v�etko', //cpg1.3.0
                
);


// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //

// Void

// ------------------------------------------------------------------------- //
// File banning.php
// ------------------------------------------------------------------------- //

if (defined('BANNING_PHP')) $lang_banning_php = array(
                'title' => 'Vykopnutie u�ivate�a',
                'user_name' => 'U�ivate�sk� meno',
                'ip_address' => 'IP Adresa',
                'expiry' => 'Vypr�� za (nevypl�ova� pre st�le vykopnutie)',
                'edit_ban' => 'Ulo�i� zmeny',
                'delete_ban' => 'Zmaza�',
                'add_new' => 'Prida� �al�ie vykopnutie',
                'add_ban' => 'Prida�',
                'error_user' => 'Nem��em n�js� u��vate�a', //cpg1.3.0 
                'error_specify' => 'Je potrebn� zada� bu� u�ivate�sk� meno alebo IP adresu', //cpg1.3.0
                'error_ban_id' => 'Chybn� ID pre z�kaz!', //cpg1.3.0
                'error_admin_ban' => 'Nem��ete zak�za� s�m seba!', //cpg1.3.0
                'error_server_ban' => 'Sna��te sa zak�za� vlastn� server? To nie je mo�n� urobi�.', //cpg1.3.0
                'error_ip_forbidden' => 'Nie je mo�n� zak�za� toto IP - nie je dosiahnute�n�!', //cpg1.3.0
                'lookup_ip' => 'N�js� IP adresu', //cpg1.3.0
                'submit' => 'Odosla�', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(  
    'title' => 'Upload obr�zkov', 
    'custom_title' => 'Upraven� Formul�r', //cpg1.3.0
    'cust_instr_1' => 'M��ete zvoli� po�adovan� po�et vstupn�ch pol��ok. Nie je ale mo�n� prekro�i� omedzenie po�tu pol��ok uveden� n힚ie.', //cpg1.3.0
    'cust_instr_2' => 'Box Number Requests', //cpg1.3.0
    'cust_instr_3' => 'Pol��ka pre upload s�borov: %s', //cpg1.3.0
    'cust_instr_4' => 'Pol��ka pre URI/URL upload: %s', //cpg1.3.0
    'cust_instr_5' => 'Pol��ka pre URI/URL upload:', //cpg1.3.0
    'cust_instr_6' => 'Pol��ka pre upload s�borov:', //cpg1.3.0
    'cust_instr_7' => 'Pros�m zadajte po�adovan� po�et ku ka�d�mu typu vstupn�ch pol��ok pre upload. Potom stla�te \'Pokra�ova�\'. ', //cpg1.3.0
    'reg_instr_1' => 'Neplatn� akcia pre vytv�ranie formul�ra.', //cpg1.3.0  
    'reg_instr_2' => 'Pomocou pol��ok dole m��ete nechat na server nahra� s�bory. Ve�kos� jednotliv�ch nahr�van�ch s�borov pri uploade na server by nemala presiahnu� %s KB. S�bory ZIP nahran� pomoc� sekc� \'Upload S�borov\' alebo \'URI/URL Upload\' zostan� zkomprimovan� ako jeden s�bor aj po nahran� na server.', //cpg1.3.0
    'reg_instr_3' => 'Pokia� chcete, aby s�bory zabalen� v archivu ZIP boly rozbalen�, mus�te pou�i� pre zadanie s�boru pol��ko v sekci \'Decompressive ZIP Upload\'.', //cpg1.3.0
    'reg_instr_4' => 'Pokia� pou��v�te sekciu URI/URL upload, pros�m zad�vejte cestu k s�boru takto: http://www.mojadomena.sk/obrazky/priklad1.jpg', //cpg1.3.0
    'reg_instr_5' => 'Po vyplnen� formul�ra stla�te tla��tko \'Pokra�ova�\'.', //cpg1.3.0
    'reg_instr_6' => 'Upload ZIP Archivu:', //cpg1.3.0
    'reg_instr_7' => 'Upload S�borov:', //cpg1.3.0
    'reg_instr_8' => 'URI/URL Uploads:', //cpg1.3.0
    'error_report' => 'Error Report', //cpg1.3.0
    'error_instr' => 'The following uploads encountered errors:', //cpg1.3.0
    'file_name_url' => 'File Name/URL', //cpg1.3.0
    'error_message' => 'Error Message', //cpg1.3.0
    'no_post' => 'File not uploaded by POST.', //cpg1.3.0
    'forb_ext' => 'Forbidden file extension.', //cpg1.3.0
    'exc_php_ini' => 'Prekro�ena ve�kos� s�boru povolen� v php.ini.', //cpg1.3.0
    'exc_file_size' => 'Prekro�en� ve�kos� s�boru povolen� gal�riou.', //cpg1.3.0
    'partial_upload' => 'Iba �iasto�n� upload.', //cpg1.3.0
    'no_upload' => 'Neprobehol �iadny upload s�borov.', //cpg1.3.0
    'unknown_code' => 'Nezn�ma chyba PHP pri uploade.', //cpg1.3.0
    'no_temp_name' => '�iadny upload - �iadne do�asn� meno.', //cpg1.3.0
    'no_file_size' => 'Neobsahuje �iadne d�ta/rozbit�', //cpg1.3.0
    'impossible' => 'Nebolo mo�n� presun��.', //cpg1.3.0
    'not_image' => 'Niejw obr�zkom', //cpg1.3.0
    'not_GD' => 'Ch�ba roz��renie GD.', //cpg1.3.0
    'pixel_allowance' => 'Pixel allowance exceeded.', //cpg1.3.0 //TODO
    'incorrect_prefix' => 'Neplatn� URI/URL prefix', //cpg1.3.0
    'could_not_open_URI' => 'Nebolo mo�n� otvori� URI.', //cpg1.3.0
    'unsafe_URI' => 'Safety not verifiable.', //cpg1.3.0  //TODO
    'meta_data_failure' => 'Chyba v meta d�tach', //cpg1.3.0
    'http_401' => '401 Neautorizovan� pr�stup', //cpg1.3.0
    'http_402' => '402 Po�adov�na platba', //cpg1.3.0
    'http_403' => '403 Zak�zan� pr�stup', //cpg1.3.0
    'http_404' => '404 Nebolo n�jden�', //cpg1.3.0
    'http_500' => '500 Intern� chyba serveru', //cpg1.3.0
    'http_503' => '503 Slu�ba nieje dostupn�', //cpg1.3.0
    'MIME_extraction_failure' => 'MIME nebolo rozpoznan�.', //cpg1.3.0
    'MIME_type_unknown' => 'Nezn�my MIME typ', //cpg1.3.0
    'cant_create_write' => 'Nebolo mo�n� vytvori� s�bor pre z�pis.', //cpg1.3.0
    'not_writable' => 'Nebolo mo�n� zapisova� do s�boru pre z�pis.', //cpg1.3.0
    'cant_read_URI' => 'Nebolo mo�n� pre��ta� URI/URL', //cpg1.3.0
    'cant_open_write_file' => 'Nebolo mo�n� otvori� s�bor pre URI.', //cpg1.3.0
    'cant_write_write_file' => 'Nebolo mo�n� zapisova� do s�boru pre URI.', //cpg1.3.0
    'cant_unzip' => 'Nebolo mo�n� rozbali� ZIP archiv.', //cpg1.3.0
    'unknown' => 'Nezn�m� chyba', //cpg1.3.0
    'succ' => '�spe�n� Upload', //cpg1.3.0
    'success' => '%s s�borov bolo �spe�ne nahran�ch.', //cpg1.3.0
    'add' => 'Pros�m stla�te \'Pokra�ovat\' pre pridanie s�borov do gal�rie.', //cpg1.3.0
    'failure' => 'Chyba pri Uploade', //cpg1.3.0
    'f_info' => 'Inform�cie o s�bore', //cpg1.3.0
    'no_place' => 'Predch�dzaj�ci s�bor nie je mo�n� umiestni�.', //cpg1.3.0
    'yes_place' => 'Predch�dzaj�ci s�bor bol �spe�ne umiestnen�.', //cpg1.3.0
    'max_fsize' => 'Max. ve�kos� s�boru je %s KB',
    'album' => 'Gal�ria',
    'picture' => 'Obr�zok',
    'pic_title' => 'Nadpis obr�zku',
    'description' => 'Popis obr�zku',
    'keywords' => 'K���ov� slov� (oddelen� medzerou)',
    'err_no_alb_uploadables' => 'Tu sa nach�dza gal�ria, do ktorej je povolen� upload.', 
    'place_instr_1' => 'Pros�m umiestnite teraz s�bory do galeri�. M��ete tie� zada� inform�cie t�kaj�ce sa jednotliv�ch s�borov.', //cpg1.3.0
    'place_instr_2' => '�a��ie s�bory je potreba umiestni�. Pros�m stla�te \'Pokra�ova�\'.', //cpg1.3.0
    'process_complete' => 'Uspe�ne ste umiestnil v�etky s�bory.', //cpg1.3.0

);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
    'title' => 'Spravovat u�ivatele',
    'name_a' => 'Meno vzostup.',
    'name_d' => 'Meno zostup.',
    'group_a' => 'Skupina vzostup.',
    'group_d' => 'Skupina zostup.',
    'reg_a' => 'Datum registrace vzostup.',
    'reg_d' => 'Datum registrace zostup.',
    'pic_a' => 'Po�et obr�zkov vzostup.',
    'pic_d' => 'Po�et obr�zkov zostup.',
    'disku_a' => 'Vyu�it� disku vzostup.',
    'disku_d' => 'Vyu�it� disku zostup.',
    'lv_a' => 'Last visit ascending', //cpg1.3.0
    'lv_d' => 'Last visit descending', //cpg1.3.0
    'sort_by' => 'Riadi� u��vate�a pod�a',
    'err_no_users' => 'Tabulka u�ivate�ov je pr�zdna!',
    'err_edit_self' => 'Tu nie je mo�n� editova� vlastn� profil pou�ite pr�slu�n� vo�bu pracuj�cu s va�im profilom',
    'edit' => 'UPRAVI�',
    'delete' => 'ZMAZA�',
    'name' => 'U�iv. meno',
    'group' => 'Skupina U�iv.',
    'inactive' => 'Neaktivny',
    'operations' => 'Oper�cia',
    'pictures' => 'Obr�zky',
    'disk_space' => 'Miesto vyu�it� / kv�ta',
    'registered_on' => 'Registrovan�',
    'last_visit' => 'Posledn� n�v�teva', //cpg1.3.0
    'u_user_on_p_pages' => '%d u�ivate�ov na %d str�nk�ch',
    'confirm_del' => 'Ste si ist�(�), �e chcete zmazat tohto u��vate�a ? \\nV�etky jeho obr�zky, gal�ria a koment�re budou zmazan�.',
    'mail' => 'MAIL',
    'err_unknown_user' => 'Vybran� u�iv. neexistuje !',
    'modify_user' => 'Zmeni� u�iv.',
    'notes' => 'Pozn�mky',
    'note_list' => '<li>Pokia� nechcete zmeni� heslo ponechajte pol��ko pre heslo pr�zdne',
    'password' => 'Heslo',
    'user_active' => 'U�iv. je akt�vny',
    'user_group' => 'U�iv. Skupina',
    'user_email' => 'U�iv. emaill',
    'user_web_site' => 'U�iv. dom�c� str�nka',
    'create_new_user' => 'Vytvori� nov�ho u��vate�a.',
    'user_location' => 'Miesto U�iv. (napr. Bratislava apod.)',
    'user_interests' => 'U�iv. z�ujmy',
    'user_occupation' => 'U�iv. povolanie',
    'latest_upload' => 'Recent uploads', //cpg1.3.0
    'never' => 'nikdy', //cpg1.3.0

);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => 'Zmeni� ve�kos� obr�zku',
        'what_it_does' => '�o to rob�?',
        'what_update_titles' => 'Aktualizova� nadpisy pod�a mena s�borov',
        'what_delete_title' => 'Zmaza� nadpisy',
        'what_rebuild' => 'Prerobi� n�h�ady a zmen�en� obr�zky',
        'what_delete_originals' => 'Zmaza� origin�ly a nahradit ich stredn�mi obr�zkami',
        'file' => 'S�bor',
        'title_set_to' => 'Nastavi� nadpis na',
        'submit_form' => 'odosla�',
        'updated_succesfully' => 'Aktualiz�cia prebehla OK',
        'error_create' => 'CHYBA pri vytv�ran�',
        'continue' => 'Zpracova� viac obr�zkov',
        'main_success' => 'S�bor %s bol uspe�ne pou�i� ako hlavn� obr�zok',
        'error_rename' => 'Chyba premenov�nia %s na %s',
        'error_not_found' => 'S�bor %s nebol n�jden�',
        'back' => 'zp� na hlavn�',
        'thumbs_wait' => 'Aktualizujem n�h�ady a/alebo stredn� obr�zky, pros�m �akajte...',
        'thumbs_continue_wait' => 'Pokra�ujem v aktualiz�cii n�h�adov a/alebo stredn�ch obr�zkov...',
        'titles_wait' => 'Aktualizujem nadpisy, pros�m �akajte...',
        'delete_wait' => 'Ma�em nadpisy, pros�m �akejte...',
        'replace_wait' => 'Ma�em origin�li a nahradzujem ich stredn�mi obr�zkami, pros�m �akajte...',
        'instruction' => 'R�chle in�trukcie',
        'instruction_action' => 'Vyberte akci',
        'instruction_parameter' => 'Nastavi� parametre',
        'instruction_album' => 'Vybra� gal�riu',
        'instruction_press' => 'Stisknite %s',
        'update' => 'Aktualizova� n�h�ady a/alebo stredn� obr�zky',
        'update_what' => '�o m� by� aktualizovan�',
        'update_thumb' => 'Len n�h�ady',
        'update_pic' => 'Iba stredn� obr�zky',
        'update_both' => 'Oboje n�h�ady aj stredn� obr�zky',
        'update_number' => 'Po�et obr�zkov, ktor� zpracova� na 1 kliknutie',
        'update_option' => '(Zn�te ��slo pokia� m�te probl�my s timeoutom)',
        'filename_title' => 'Meno s�boru ? Nadpis obr�zku',
        'filename_how' => 'Ako sa m� zmeni� meno obr�zku?',
        'filename_remove' => 'Odstranit .jpg koncovku a prep�sa� _ (podtr��tka medzerami)',
        'filename_euro' => 'Zmeni� 2003_11_23_13_20_20.jpg na 23/11/2003 13:20',
        'filename_us' => 'Zmeni� 2003_11_23_13_20_20.jpg na 11/23/2003 13:20',
        'filename_time' => 'Zmeni� 2003_11_23_13_20_20.jpg na 13:20',
        'delete' => 'Zmaza� nadpisy obr�zkov alebo origin�lne obr�zky',
        'delete_title' => 'Zmaza� nadpisy obr�zkov',
        'delete_original' => 'Zmaza� origin�lne obr�zky',
        'delete_replace' => 'Zmaza� origin�ly a nahradit ich strednou verziou obr�zkov',
        'select_album' => 'Vybra� gal�riu',
        'delete_orphans' => 'Zmaza� osamel� koment�re (plat� pre v�etky gal�rie)', //cpg1.3.0 
        'orphan_comment' => 'N�jden� osamel� koment�re', //cpg1.3.0
        'delete' => 'Zmaza�', //cpg1.3.0 
        'delete_all' => 'Zmaza� v�etko', //cpg1.3.0
        'comment' => 'koment�r: ', //cpg1.3.0
        'nonexist' => 'priraden� k neexistuj�cemu s�boru # ', //cpg1.3.0
        'phpinfo' => 'Zobrazi� phpinfo', //cpg1.3.0
        'update_db' => 'Update datab�zy', //cpg1.3.0
        'update_db_explanation' => 'Pokia� ste vymenili s�bory aplik�ce gal�ria coppermine, pridali modifik�ciu alebo upgradovali zo star�ej verzie, uistite sa, �e ste spustili update datab�zy. To vytvor� potrebn� tabu�ky a/alebo konfigura�n� hodnoty vo va�ej datab�ze.', //cpg1.3.0
);
?>
