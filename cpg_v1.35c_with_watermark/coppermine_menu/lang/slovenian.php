<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.3.0                                            //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002-2004 Gregory DEMAR                                     //
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
// $Id: slovenian.php,v 1.7 2004/12/29 23:06:38 chtito Exp $
// ------------------------------------------------------------------------- //

// info about translators and translated language
$lang_translation_info = array(
  'lang_name_english' => 'Slovenian',
  'lang_name_native' => 'Sloven��ina',
  'lang_country_code' => 'sl',
  'trans_name'=> 's55hh',
  'trans_email' => 's55hh@slovhf.net',
  'trans_website' => 'http://prekmurje.info/',
  'trans_date' => '2004-03-18',
);
//$lang_charset = 'iso-8859-2';
$lang_charset = 'windows-1250';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytov', 'kB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('Ne', 'Po', 'To', 'Sr', '�e', 'Pe', 'So');
$lang_month = array('Jan', 'Feb', 'Mar', 'Apr', 'Maj', 'Jun', 'Jul', 'Avg', 'Sep', 'Okt', 'Nov', 'Dec');

// Some common strings
$lang_yes = 'Da';
$lang_no  = 'Ne';
$lang_back = 'NAZAJ';
$lang_continue = 'NAPREJ';
$lang_info = 'Informacija';
$lang_error = 'Napaka';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%B %d, %Y';
$lastcom_date_fmt =  '%m/%d/%y ob %H:%M'; //cpg1.3.0
$lastup_date_fmt = '%B %d, %Y';
$register_date_fmt = '%B %d, %Y';
$lasthit_date_fmt = '%B %d, %Y ob %I:%M %p'; //cpg1.3.0
$comment_date_fmt =  '%B %d, %Y ob %I:%M %p'; //cpg1.3.0

// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'rit', 'kurac', 'pizda', 'sranje', 'zajebano', 'jebi*', 'wop*');

$lang_meta_album_names = array(
  'random' => 'Naklju�ne datoteke', //cpg1.3.0
  'lastup' => 'Zadnje dodano',
  'lastalb'=> 'Zadnji posodobljeni album',
  'lastcom' => 'Zadnji komentarji',
  'topn' => 'Najve� ogledov',
  'toprated' => 'Naj ocene',
  'lasthits' => 'Zadnji ogledi',
  'search' => 'Rezultati iskanja',
  'favpics'=> 'Priljubljene datoteke', //cpg1.3.0
);

$lang_errors = array(
  'access_denied' => 'Nima� pravic za dostop do te strani.',
  'perm_denied' => 'Nima� pravic za izvedbo tega ukaza.',
  'param_missing' => 'Manjkajo podatki za izvedbo...',
  'non_exist_ap' => 'Izbrani album/slika ne obstaja!', //cpg1.3.0
  'quota_exceeded' => 'Disk je poln<br /><br />Na razpolago ima� [quota]K, tvoje slike pa trenutno zasedajo [space]K, �e bi dodal pa �e to sliko, bi prekora�il prostor na disku.', //cpg1.3.0
  'gd_file_type_err' => 'Pri uporabi GD knji�nice lahko uporabi� samo JPEG in PNG slike.',
  'invalid_image' => 'Poslana slika je po�kodovana ali pa ni v pravilnem formatu za GD knji�nico.',
  'resize_failed' => 'Ne morem narediti ikone ali pomanj�ane slike.',
  'no_img_to_display' => 'Trenutno �e brez slik',
  'non_exist_cat' => 'Izbrana kategorija ne obstaja',
  'orphan_cat' => 'Kategorija ima dolo�eno neobstoje�o nadrejeno kategorijo. Popravi napako v nastavitvah.', //cpg1.3.0
  'directory_ro' => 'Direktorij \'%s\' ne dopu��a pisanja, slik ni mo�no pobrisati', //cpg1.3.0
  'non_exist_comment' => 'Izbrani komentar ne obstaja.',
  'pic_in_invalid_album' => 'Slika je v neobstoje�em albumu (%s)!?', //cpg1.3.0
  'banned' => 'Trenutno ima� prepoved dostopa do teh strani.',
  'not_with_udb' => 'Ta ukaz je onemogo�en, ker je premaknjen v forum. Ali to kar �eli� narediti ni omogo�eno v nastavitvah ali pa je predvideno za izvedbo v forumu.',
  'offline_title' => 'Izklopljeno', //cpg1.3.0
  'offline_text' => 'Galerija je trenutno izklopljena - preveri pozneje...', //cpg1.3.0
  'ecards_empty' => 'Trenutno ni podatkov o poslanih e-razglednicah. Preveri, �e je v nastavitvah vklopljeno bele�enje poslanih e-razglednic!', //cpg1.3.0
  'action_failed' => 'Ukaz je bil prekinjen. Tvojega zahtevka ni mo�no izvesti.', //cpg1.3.0
  'no_zip' => 'Potrebna knji�nica za izvedbo ZIP datoteke manjka. Sporo�i napako administratorju galerije.', //cpg1.3.0
  'zip_type' => 'Nima� dovoljenja za nalaganje ZIP datotek.', //cpg1.3.0
);

$lang_bbcode_help = 'Naslednje kode so lahko v pomo�: <li>[b]<b>Povdarjeno</b>[/b]</li> <li>[i]<i>Po�evno</i>[/i]</li> <li>[url=http://tvojastran.com/]Url besedilo[/url]</li> <li>[email]nekaj@domain.com[/email]</li>'; //cpg1.3.0

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
  'alb_list_title' => 'Pojdi na seznam albumov',
  'alb_list_lnk' => 'Seznam albumov',
  'my_gal_title' => 'Pojdi v mojo osebno galerijo',
  'my_gal_lnk' => 'Moja galerija',
  'my_prof_lnk' => 'Moj profil',
  'adm_mode_title' => 'Preklop v administracijo',
  'adm_mode_lnk' => 'Administracija',
  'usr_mode_title' => 'Preklop v uporabni�ki na�in',
  'usr_mode_lnk' => 'Uporabni�ki na�in',
  'upload_pic_title' => 'Nalo�i sliko v album', //cpg1.3.0
  'upload_pic_lnk' => 'Nalaganje slik', //cpg1.3.0
  'register_title' => 'Ustvari ra�un',
  'register_lnk' => 'Registracija',
  'login_lnk' => 'Prijava',
  'logout_lnk' => 'Odjava',
  'lastup_lnk' => 'Zadnje dodane slike',
  'lastcom_lnk' => 'Zadnji komentarji',
  'topn_lnk' => 'Najve� ogledov',
  'toprated_lnk' => 'Najbolj ocenjeno',
  'search_lnk' => 'Iskanje',
  'fav_lnk' => 'Moji favoriti',
  'memberlist_title' => 'Poka�i seznam �lanov', //cpg1.3.0
  'memberlist_lnk' => 'Seznam �lanov', //cpg1.3.0
  'faq_title' => 'Pogosto zastavljena vpra�anja o foto-galeriji &quot;Coppermine&quot;', //cpg1.3.0
  'faq_lnk' => 'FAQ', //cpg1.3.0
);

$lang_gallery_admin_menu = array(
  'upl_app_lnk' => 'Odobri slike',
  'config_lnk' => 'Nastavitve',
  'albums_lnk' => 'Albumi',
  'categories_lnk' => 'Kategorije',
  'users_lnk' => 'Uporabniki',
  'groups_lnk' => 'Skupine',
  'comments_lnk' => 'Komentarji', //cpg1.3.0
  'searchnew_lnk' => 'Najdi nove slike', //cpg1.3.0
  'util_lnk' => 'Orodja', //cpg1.3.0
  'ban_lnk' => 'Zavrni uporabnika',
  'db_ecard_lnk' => 'Prika�i e-razglednice', //cpg1.3.0
);

$lang_user_admin_menu = array(
  'albmgr_lnk' => 'Ustvari/naro�i svoj album',
  'modifyalb_lnk' => 'Spremeni svoj album',
  'my_prof_lnk' => 'Moj profil',
);

$lang_cat_list = array(
  'category' => 'Kategorija',
  'albums' => 'Albumi',
  'pictures' => 'Slike', //cpg1.3.0
);

$lang_album_list = array(
  'album_on_page' => '�t. albumov:%d (�t. strani:%d)',
);

$lang_thumb_view = array(
  'date' => 'Datum',
  //Sort by filename and title
  'name' => 'Datoteka',
  'title' => 'Naziv',
  'sort_da' => 'Sortiraj po datumu nara��ujo�e',
  'sort_dd' => 'Sortiraj po datumu padajo�e',
  'sort_na' => 'Sortiraj po imenu datoteke nara��ujo�e',
  'sort_nd' => 'Sortiraj po imenu datoteke padajo�e',
  'sort_ta' => 'Sortiraj po nazivu nara��ujo�e',
  'sort_td' => 'Sortiraj po nazivu padajo�e',
  'download_zip' => 'Download kot Zip datoteka', //cpg1.3.0
  'pic_on_page' => '�t. slik:%d (�t. strani:%d)',
  'user_on_page' => '�t. uporabnikov:%d (�t. strani:%d)', //cpg1.3.0
);

$lang_img_nav_bar = array(
  'thumb_title' => 'Nazaj na stran z ikonami',
  'pic_info_title' => 'Prika�i/skrij informacije o sliki', //cpg1.3.0
  'slideshow_title' => 'Samodejno predvajaj slike',
  'ecard_title' => 'Po�lji sliko kot e-razglednico', //cpg1.3.0
  'ecard_disabled' => 'Po�iljanje e-razglednic ni dovoljeno',
  'ecard_disabled_msg' => 'Nima� pravic za po�iljanje e-razglednic', //js-alert //cpg1.3.0
  'prev_title' => 'Poglej predhodno sliko', //cpg1.3.0
  'next_title' => 'Poglej naslednjo sliko', //cpg1.3.0
  'pic_pos' => 'Slika %s od %s', //cpg1.3.0
);

$lang_rate_pic = array(
  'rate_this_pic' => 'Oceni to sliko ', //cpg1.3.0
  'no_votes' => '(Brez ocen do sedaj)',
  'rating' => '(trenutna ocena: %s (najve� 5; �t. glasov:%s)',
  'rubbish' => 'Zani�',
  'poor' => 'Slabo',
  'fair' => 'Tako tako',
  'good' => 'Dobro',
  'excellent' => 'Odli�no',
  'great' => 'Super',
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
  CRITICAL_ERROR => 'Kriti�na napaka',
  'file' => 'Datoteka: ',
  'line' => 'Vrstica: ',
);

$lang_display_thumbnails = array(
  'filename' => 'Ime datoteke: ',
  'filesize' => 'Velikost datoteke: ',
  'dimensions' => 'Dimenzija: ',
  'date_added' => 'Datum objave: ', //cpg1.3.0
);

$lang_get_pic_data = array(
  'n_comments' => '�t. komentarjev:%s',
  'n_views' => '�t. ogledov:%s',
  'n_votes' => '(�t. ocen:%s)',
);

$lang_cpg_debug_output = array(
  'debug_info' => 'Debug info', //cpg1.3.0
  'select_all' => 'Izberi vse', //cpg1.3.0
  'copy_and_paste_instructions' => '�e �eli� pomo� s strani coppermine foruma, kopiraj in prilepi (copy-paste) izpis napake v svoje sporo�ilo. Pred po�iljanjem preveri in zamenjaj (�e obstaja v izpisu) geslo z ***.', //cpg1.3.0
  'phpinfo' => 'Prika�i phpinfo', //cpg1.3.0
);

$lang_language_selection = array(
  'reset_language' => 'Privzeti jezik', //cpg1.3.0
  'choose_language' => 'Izberi jezik', //cpg1.3.0
);

$lang_theme_selection = array(
  'reset_theme' => 'Privzeta tema', //cpg1.3.0
  'choose_theme' => 'Izberi temo', //cpg1.3.0
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
  'Exclamation' => 'Vzklik',
  'Question' => 'Vpra�anje',
  'Very Happy' => 'Zelo sre�en',
  'Smile' => 'Sme�ko',
  'Sad' => '�alosten',
  'Surprised' => 'Presene�en',
  'Shocked' => 'V �oku',
  'Confused' => 'Zmeden',
  'Cool' => 'Hladen',
  'Laughing' => 'Nasmejan',
  'Mad' => 'Nor',
  'Razz' => 'Nagajiv',
  'Embarassed' => 'Embarassed',
  'Crying or Very sad' => 'Jokajo� ali �alosten',
  'Evil or Very Mad' => 'Vra�ji ali zloben',
  'Twisted Evil' => 'Slepar',
  'Rolling Eyes' => 'Kotale�e o�i',
  'Wink' => 'Me�ikanje',
  'Idea' => 'Ideja',
  'Arrow' => 'Pu��ica',
  'Neutral' => 'Nevtralen',
  'Mr. Green' => 'Gospod zelenko',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
  0 => 'Zapu��am administracijo...',
  1 => 'Vstop v administracijo...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
  'alb_need_name' => 'Album mora imeti ime!', //js-alert
  'confirm_modifs' => 'Res �eli� izvesti te spremembe?', //js-alert
  'no_change' => 'Nobenih sprememb nisi naredil!', //js-alert
  'new_album' => 'Novi album',
  'confirm_delete1' => 'Res �eli� pobrisati ta album?', //js-alert
  'confirm_delete2' => '\nVse slike in vsi komentarji bodo prav tako pobrisani!', //js-alert
  'select_first' => 'Najprej izberi album', //js-alert
  'alb_mrg' => 'Urejanje albumov',
  'my_gallery' => '* Moja galerija *',
  'no_category' => '* Brez kategorij *',
  'delete' => 'Brisanje',
  'new' => 'Novo',
  'apply_modifs' => 'Izvedi spremembe',
  'select_category' => 'Izberi kategorijo',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
  'miss_param' => 'Parameter potreben za \'%s\'operacijo ni vpisan!',
  'unknown_cat' => 'Izbrana kategorija ne obstaja v bazi',
  'usergal_cat_ro' => 'Brisanje kategorije od uporabni�kih galerij ni mo�no!',
  'manage_cat' => 'Urejanje kategorij',
  'confirm_delete' => 'Res �eli� pobrisati to kategorijo', //js-alert
  'category' => 'Kategorija',
  'operations' => 'Operacija',
  'move_into' => 'Premakni v',
  'update_create' => 'Posodobi/ustvari kategorijo',
  'parent_cat' => 'Nadrejena kategorija',
  'cat_title' => 'Ime kategorije',
  'cat_thumb' => 'Ikona kategorije', //cpg1.3.0
  'cat_desc' => 'Opis kategorije',
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
  'title' => 'Nastavitve',
  'restore_cfg' => 'Povrni osnovne nastavitve',
  'save_cfg' => 'Shrani nove nastavitve',
  'notes' => 'Opombe',
  'info' => 'Informacija',
  'upd_success' => 'Nastavitve galerije so bile uspe�no posodobljene',
  'restore_success' => 'Povrnjene so bile osnovne nastavitve galerije',
  'name_a' => 'Naziv nara��ujo�e',
  'name_d' => 'Naziv padajo�e',
  'title_a' => 'Naslov nara��ujo�e',
  'title_d' => 'Naslov padajo�e',
  'date_a' => 'Datum nara��ujo�e',
  'date_d' => 'Datum padajo�e',
  'th_any' => 'Max razmerje',
  'th_ht' => 'Vi�ina',
  'th_wd' => '�irina',
  'label' => 'labela', //cpg1.3.0
  'item' => 'vsebina', //cpg1.3.0
  'debug_everyone' => 'Vsi', //cpg1.3.0
  'debug_admin' => 'Samo admin', //cpg1.3.0
        );

if (defined('CONFIG_PHP')) $lang_config_data = array(
  'Osnovne nastavitve',
  array('Ime galerije', 'gallery_name', 0),
  array('Opis galerije', 'gallery_description', 0),
  array('Administratorjev e-mail', 'gallery_admin_email', 0),
  array('Naslov za link v e-razglednicah (Poglej si ve� slik)', 'ecards_more_pic_target', 0),
  array('Galerija je izklopljena', 'offline', 1), //cpg1.3.0
  array('Bele�i e-razglednice', 'log_ecards', 1), //cpg1.3.0
  array('Dovoli ZIP-download priljubljenih slik', 'enable_zipdownload', 1), //cpg1.3.0

  'Language, Themes &amp; Charset settings',
  array('Jezik', 'lang', 5),
  array('Tema', 'theme', 6),
  array('Prika�i seznam jezikov', 'language_list', 1), //cpg1.3.0
  array('Prika�i zastave jezikov', 'language_flags', 8), //cpg1.3.0
  array('Prika�i &quot;reset&quot; na seznamu jezikov', 'language_reset', 1), //cpg1.3.0
  array('Prika�i seznam tem', 'theme_list', 1), //cpg1.3.0
  array('Prika�i &quot;reset&quot; na seznamu tem', 'theme_reset', 1), //cpg1.3.0
  array('Prika�i FAQ', 'display_faq', 1), //cpg1.3.0
  array('Prika�i pomo� za bbcode', 'show_bbcode_help', 1), //cpg1.3.0
  array('Kodiranje strani', 'charset', 4), //cpg1.3.0

  'Seznam albumov',
  array('�irina glavne tabele (pixli ali %)', 'main_table_width', 0),
  array('�tevilo nivojev za prikaz kategorij', 'subcat_level', 0),
  array('�tevilo albumov na strani', 'albums_per_page', 0),
  array('�tevilo kolon za prikaz albumov', 'album_list_cols', 0),
  array('Velikost ikon v pixlih', 'alb_list_thumb_size', 0),
  array('Vsebina na glavni strani', 'main_page_layout', 0),
  array('Prikaz ikon albumov za prvi nivo kategorij','first_level',1),

  'Prikaz ikon',
  array('�tevilo kolon na strani z ikonami', 'thumbcols', 0),
  array('�tevilo vrstic na strani z ikonami', 'thumbrows', 0),
  array('Max. �t. tabulatorjev', 'max_tabs', 10), //cpg1.3.0
  array('Prika�i opis slike (zraven imena) pod ikono', 'caption_in_thumbview', 1), //cpg1.3.0
  array('Prika�i �tevilo ogledov pod ikono', 'views_in_thumbview', 1), //cpg1.3.0
  array('Prika�i �tevilo komentarjev pod ikono', 'display_comment_count', 1),
  array('Prika�i po�iljatelja pod ikono', 'display_uploader', 1), //cpg1.3.0
  array('Privzeto sortiranje slik', 'default_sort_order', 3), //cpg1.3.0
  array('Minimalno �tevilo ocen za sliko, da se uvrsti na seznam  \'naj-ocene\'', 'min_votes_for_rating', 0), //cpg1.3.0

  'Prikaz slik &amp; nastavitve za komentarje',
  array('�irina tabele za prikaz slik (pixli ali %)', 'picture_table_width', 0), //cpg1.3.0
  array('Informacija o sliki je privzeto vidna', 'display_pic_info', 1), //cpg1.3.0
  array('Izlo�i grde besede v komentarjih', 'filter_bad_words', 1),
  array('Dovoli sme�kote v komentarjih', 'enable_smilies', 1),
  array('Dovoli ve� komentarjev od enega uporabnika (iklopi kontrolo smeti...)', 'disable_comment_flood_protect', 1), //cpg1.3.0
  array('Max. velikost za opis slike', 'max_img_desc_length', 0),
  array('Max. �tevilo znakov v besedi', 'max_com_wlength', 0),
  array('Max. �tevilo vrstic komentarja', 'max_com_lines', 0),
  array('Max. velikost komentarja', 'max_com_size', 0),
  array('Prika�i filmski trak z ikonami', 'display_film_strip', 1),
  array('�t. ikon na traku', 'max_film_strip_items', 0),
  array('Obvesti admin. o novem komentarju', 'email_comment_notification', 1), //cpg1.3.0
  array('Interval pri samodejnem predvajanju v mili sekundah (1 sekunda = 1000 mili sekund)', 'slideshow_interval', 0), //cpg1.3.0

  'Nastavitve slik in ikon', //cpg1.3.0
  array('Kvaliteta za JPEG datoteke', 'jpeg_qual', 0),
  array('Max. velikost za ikone <a href="#notice2" class="clickable_option">**</a>', 'thumb_width', 0), //cpg1.3.0
  array('Velikost uporabi za �irino ali vi�ino ali razmerje ikone<b>**</b>', 'thumb_use', 7),
  array('Ustvari vmesne slike','make_intermediate',1),
  array('Max. �irina ali vi�ina vmesnih slik/videa <a href="#notice2" class="clickable_option">**</a>', 'picture_width', 0), //cpg1.3.0
  array('Max. velikost datotek/slik (kB)', 'max_upl_size', 0), //cpg1.3.0
  array('Max. �irina ali vi�ina dodanih slik/videa (pixli)', 'max_upl_width_height', 0), //cpg1.3.0

  'Dodatne nastavitve slik in ikon', //cpg1.3.0
  array('Prika�i ikone privatnih albumov neprijavljenim uporabnikom','show_private',1), //cpg1.3.0
  array('Prepovedani znaki v imenih datotek', 'forbiden_fname_char',0), //cpg1.3.0
  //array('Accepted file extensions for uploaded pictures', 'allowed_file_extensions',0), //cpg1.3.0
  array('Dovoljene vrste datotek za dodajanje slik', 'allowed_img_types',0), //cpg1.3.0
  array('Dovoljene vrste datotek za dodajanje filmov', 'allowed_mov_types',0), //cpg1.3.0
  array('Dovoljene vrste datotek za audio', 'allowed_snd_types',0), //cpg1.3.0
  array('Dovoljene vrste datotek', 'allowed_doc_types',0), //cpg1.3.0
  array('Na�in kreiranja ikon','thumb_method',2), //cpg1.3.0
  array('Pot do ImageMagick programa (example /usr/bin/X11/)', 'impath', 0), //cpg1.3.0
  //array('Allowed image types (only valid for ImageMagick)', 'allowed_img_types',0), //cpg1.3.0
  array('Opcija za ukazno vrstico od ImageMagick', 'im_options', 0), //cpg1.3.0
  array('Prika�i EXIF podatke v JPEG datotekah', 'read_exif_data', 1), //cpg1.3.0
  array('Prika�i IPTC podatke v JPEG datotekah', 'read_iptc_data', 1), //cpg1.3.0
  array('Direktorij za albume <a href="#notice1" class="clickable_option">*</a>', 'fullpath', 0), //cpg1.3.0
  array('Direktorij za slike od uporabnikov <a href="#notice1" class="clickable_option">*</a>', 'userpics', 0), //cpg1.3.0
  array('Predpona za vmesne slike <a href="#notice1" class="clickable_option">*</a>', 'normal_pfx', 0), //cpg1.3.0
  array('Predpona za ikone <a href="#notice1" class="clickable_option">*</a>', 'thumb_pfx', 0), //cpg1.3.0
  array('Privzete pravice za direktorije', 'default_dir_mode', 0), //cpg1.3.0
  array('Privzete pravice za slike', 'default_file_mode', 0), //cpg1.3.0

  'Nastavitve uporabnikov',
  array('Dovoli registriranje novih uporabnikov', 'allow_user_registration', 1),
  array('Registracija zahteva preverjanje e-mail naslova', 'reg_requires_valid_email', 1),
  array('Obvesti admina o novi registraciji', 'reg_notify_admin_email', 1), //cpg1.3.0
  array('Dva uporabnika lahko imata enak e-mail naslov', 'allow_duplicate_emails_addr', 1),
  array('Uporabniki imajo lahko privatne albume (Opomba: �e preklopi� iz DA na NE bodo trenutni privatni albumi postali javni)', 'allow_private_albums', 1), //cpg1.3.0
  array('Obvesti admina o �akajo�ih slikah za odobritev', 'upl_notify_admin_email', 1), //cpg1.3.0
  array('Dovoli prijavljenim uporabnikom ogled seznama �lanov', 'allow_memberlist', 1), //cpg1.3.0

  'Dodatna polja za vpis informacij o sliki (pusti prazno, �e ne uporablja�)',
  array('Polje 1', 'user_field1_name', 0),
  array('Polje 2', 'user_field2_name', 0),
  array('Polje 3', 'user_field3_name', 0),
  array('Polje 4', 'user_field4_name', 0),

  'Pi�kotki',
  array('Ime za pi�kotke, ki jih uporablja galerija (�e uporablja� �e bbs, poskrbi za razli�no ime od pi�kotkov bbs-ja)', 'cookie_name', 0),
  array('Pot do pi�kotkov', 'cookie_path', 0),

  'Ostale nastavitve',
  array('Vklju�i na�in za odkrivanje napak', 'debug_mode', 9), //cpg1.3.0
  array('Prika�i opombe v na�inu za odkrivanje napak', 'debug_notice', 1), //cpg1.3.0

  '<br /><div align="left"><a name="notice1"></a>(*) Teh nastavitev ni dovoljeno spreminjati, ko so v galeriji �e slike.<br />
  <a name="notice2"></a>(**) �e spremeni� te nastavitve, bodo vplivale samo na slike dodane od spremembe naprej. �eljene spremembe lahko izvede� tudi na �e obstoje�ih slikah z uporabo &quot;<a href="util.php">administracijskih orodij</a> (spreminjanje velikosti slik)&quot; pripomo�ka, ki se nahaja v administracijskem meniju.</div><br />', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File db_ecard.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('DB_ECARD_PHP')) $lang_db_ecard_php = array(
  'title' => 'Po�lji e-razglednico', //cpg1.3.0
  'ecard_sender' => 'Po�iljatelj', //cpg1.3.0
  'ecard_recipient' => 'Naslovnik', //cpg1.3.0
  'ecard_date' => 'Datum', //cpg1.3.0
  'ecard_display' => 'Prika�i e-razglednico', //cpg1.3.0
  'ecard_name' => 'Ime', //cpg1.3.0
  'ecard_email' => 'e-mail', //cpg1.3.0
  'ecard_ip' => 'IP #', //cpg1.3.0
  'ecard_ascending' => 'nara��ajo�e', //cpg1.3.0
  'ecard_descending' => 'padajo�e', //cpg1.3.0
  'ecard_sorted' => 'Sortirano', //cpg1.3.0
  'ecard_by_date' => 'po datumu', //cpg1.3.0
  'ecard_by_sender_name' => 'po po�iljateljevem imenu', //cpg1.3.0
  'ecard_by_sender_email' => 'po po�iljateljevem e-mail naslovu', //cpg1.3.0
  'ecard_by_sender_ip' => 'po po�iljateljevi IP �tevilki', //cpg1.3.0
  'ecard_by_recipient_name' => 'po naslovnikovem imenu', //cpg1.3.0
  'ecard_by_recipient_email' => 'po naslovnikovem e-mail naslovu', //cpg1.3.0
  'ecard_number' => 'prikazani zapisi od %s do %s (vseh zapisov: %s', //cpg1.3.0
  'ecard_goto_page' => 'pojdi na stran', //cpg1.3.0
  'ecard_records_per_page' => 'Zapisov po strani', //cpg1.3.0
  'check_all' => 'Ozna�i vse', //cpg1.3.0
  'uncheck_all' => 'Odzna�i vse', //cpg1.3.0
  'ecards_delete_selected' => 'Bri�i ozna�eno', //cpg1.3.0
  'ecards_delete_confirm' => 'Si prepri�an, da �eli� to narediti? Ozna�i ustrezno polje!', //cpg1.3.0
  'ecards_delete_sure' => 'Sem prepri�an!', //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
  'empty_name_or_com' => 'Vpisati mora� ime in komentar',
  'com_added' => 'Komentar je bil dodan',
  'alb_need_title' => 'Vpisati mora� ime za album!',
  'no_udp_needed' => 'Posodobitve niso potrebne.',
  'alb_updated' => 'Album je bil posodobljen',
  'unknown_album' => 'Izbrani album ne obstaja ali pa nima� pravic za dodajanje slik v njega',
  'no_pic_uploaded' => 'Nobena slika ni bila dodana!<br /><br />�e si resni�no poslal sliko, preveri ali je to sploh dovoljeno...', //cpg1.3.0
  'err_mkdir' => 'Kreiranje direktorija %s ni bilo uspe�no!',
  'dest_dir_ro' => '�eljeni direktorij %s ne omogo�a pisanja - pravice!',
  'err_move' => 'Nemogo�e je premakniti %s v %s !',
  'err_fsize_too_large' => 'Dimenzije slike so prevelike (dovoljeno je %s x %s)!', //cpg1.3.0
  'err_imgsize_too_large' => 'Velikost datoteke presega limit (dovoljeno je %s kB)!',
  'err_invalid_img' => 'Poslana slika ni v pravilnem formatu!',
  'allowed_img_types' => 'Doda� lahko samo %s slike.',
  'err_insert_pic' => 'Slike \'%s\' se ne da dodati v album ', //cpg1.3.0
  'upload_success' => 'Tvoja slika je bila dodana.<br /><br />Vidna bo takoj po administratorjevi odobritvi.', //cpg1.3.0
  'notify_admin_email_subject' => '%s - slik za odobritev', //cpg1.3.0
  'notify_admin_email_body' => 'Dodane so bile slike (po�iljatelj: %s) in �akajo na odobritev. Obi��i %s', //cpg1.3.0
  'info' => 'Informacija',
  'com_added' => 'Komentar dodan',
  'alb_updated' => 'Album posodobljen',
  'err_comment_empty' => 'Komentar je prazen!',
  'err_invalid_fext' => 'Veljavne so samo datoteke z naslednjimi kon�nicami: <br /><br />%s.',
  'no_flood' => 'Oprosti, ampak si �e avtor zadnjega komentarja za to sliko<br /><br />Izberi urejanje,�e ga �eli� spremeniti', //cpg1.3.0
  'redirect_msg' => 'Prestavljen bo� na novo stran.<br /><br /><br />Klikni \'NAPREJ\', �e se stran samodejno ne zamenja',
  'upl_success' => 'Tvoje slike so bile uspe�no dodane', //cpg1.3.0
  'email_comment_subject' => 'Dodan komentar v galerijo', //cpg1.3.0
  'email_comment_body' => 'Nekdo je vpisal komentar v galerijo. Poglej ga', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
  'caption' => 'Naslov',
  'fs_pic' => 'velika slika',
  'del_success' => 'uspe�no pobrisano',
  'ns_pic' => 'normalna velikost slike',
  'err_del' => 'brisanje ni mo�no',
  'thumb_pic' => 'ikona',
  'comment' => 'komentar',
  'im_in_alb' => 'slika v albumu',
  'alb_del_success' => 'Album \'%s\' pobrisan',
  'alb_mgr' => 'Urejanje albumov',
  'err_invalid_data' => 'Napa�ni podatki v \'%s\'',
  'create_alb' => 'Kreiram album \'%s\'',
  'update_alb' => 'Posodabljam album \'%s\' z naslovom \'%s\' in indeksom \'%s\'',
  'del_pic' => 'Pobri�i sliko', //cpg1.3.0
  'del_alb' => 'Pobri�i album',
  'del_user' => 'Pobri�i uporabnika',
  'err_unknown_user' => 'Izbrani uporabnik ne obstaja!',
  'comment_deleted' => 'Komentar uspe�no pobrisan',
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
  'confirm_del' => 'Res �eli� pobrisati to sliko? \\nTudi komentarji od nje bodo pobrisani.', //js-alert //cpg1.3.0
  'del_pic' => 'POBRI�I TO SLIKO', //cpg1.3.0
  'size' => '%s x %s pixlov',
  'views' => '%s krat',
  'slideshow' => 'Samodejno predvajanje',
  'stop_slideshow' => 'Ustavi predvajanje',
  'view_fs' => 'Klikni za ogled ve�je slike',
  'edit_pic' => 'Uredi opis', //cpg1.3.0
  'crop_pic' => 'Obre�i in rotiraj', //cpg1.3.0
);

$lang_picinfo = array(
  'title' =>'Informacija o sliki', //cpg1.3.0
  'Filename' => 'Ime datoteke',
  'Album name' => 'Ime albuma',
  'Rating' => 'Ocena (�t. glasov:%s)',
  'Keywords' => 'Klju�ne besede',
  'File Size' => 'Velikost datoteke',
  'Dimensions' => 'Velikost slike',
  'Displayed' => '�t. ogledov',
  'Camera' => 'Kamera',
  'Date taken' => 'Datum posnetka',
  'Aperture' => 'Zaslonka',
  'Exposure time' => '�as',
  'Focal length' => 'Gori��na razdalja',
  'Comment' => 'Komentar',
  'addFav'=>'Dodaj med priljubljene', //cpg1.3.0
  'addFavPhrase'=>'Priljubljene', //cpg1.3.0
  'remFav'=>'Odstrani iz priljubljenih', //cpg1.3.0
  'iptcTitle'=>'IPTC naziv', //cpg1.3.0
  'iptcCopyright'=>'IPTC Copyright', //cpg1.3.0
  'iptcKeywords'=>'IPTC klju�ne besede', //cpg1.3.0
  'iptcCategory'=>'IPTC kategorija', //cpg1.3.0
  'iptcSubCategories'=>'IPTC pod kategorija', //cpg1.3.0
);

$lang_display_comments = array(
  'OK' => 'DA',
  'edit_title' => 'Uredi komentar',
  'confirm_delete' => 'Res �eli� pobrisati komentar?', //js-alert
  'add_your_comment' => 'Dodaj komentar',
  'name'=>'Ime',
  'comment'=>'Komentar',
  'your_name' => 'Anonimne�',
);

$lang_fullsize_popup = array(
  'click_to_close' => 'Klikni sliko, da zapre� to okno',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
  'title' => 'Po�lji e-razglednico',
  'invalid_email' => '<b>Opozorilo</b>: napa�ni e-mail naslov!',
  'ecard_title' => 'To je e-razglednica od %s za tebe',
  'error_not_image' => 'Samo slike je mo�no poslati kot razglednico.', //cpg1.3.0
  'view_ecard' => '�e razglednice ne vidi� pravilno, klikni na to povezavo',
  'view_more_pics' => 'Klikni tukaj za ogled ve�ih slik!',
  'send_success' => 'Razglednica je bila poslana',
  'send_failed' => 'Oprosti, ampak server ne omogo�a po�iljanja razglednic...',
  'from' => 'Od',
  'your_name' => 'Tvoje ime',
  'your_email' => 'Tvoj e.mail naslov',
  'to' => 'Za',
  'rcpt_name' => 'Naslovnikovo ime',
  'rcpt_email' => 'Naslovnikov e-mail naslov',
  'greetings' => 'Pozdrav',
  'message' => 'Sporo�ilo',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
  'pic_info' => 'Informacija o sliki', //cpg1.3.0
  'album' => 'Album',
  'title' => 'Naziv',
  'desc' => 'Opis',
  'keywords' => 'Klju�ne besede',
  'pic_info_str' => '%s &times; %s - %s kB - %s ogledov - %s ocen',
  'approve' => 'Odobri sliko', //cpg1.3.0
  'postpone_app' => 'Prelo�i odobritev',
  'del_pic' => 'Pobri�i sliko', //cpg1.3.0
  'read_exif' => 'Preberi EXIF podatke �e enkrat', //cpg1.3.0
  'reset_view_count' => 'Resetiraj �tevec ogledov',
  'reset_votes' => 'Resetiraj ocene',
  'del_comm' => 'Pobri�i komentarje',
  'upl_approval' => 'Dodaj odobritev',
  'edit_pics' => 'Uredi sliko', //cpg1.3.0
  'see_next' => 'Naslednje slike', //cpg1.3.0
  'see_prev' => 'predhodne slike', //cpg1.3.0
  'n_pic' => '%s slik', //cpg1.3.0
  'n_of_pic_to_disp' => '�tevilo slik za prikaz', //cpg1.3.0
  'apply' => 'Izvedi spremembe', //cpg1.3.0
  'crop_title' => 'Urejanje slik', //cpg1.3.0
  'preview' => 'Predogled', //cpg1.3.0
  'save' => 'Shrani sliko', //cpg1.3.0
  'save_thumb' =>'Shrani kot ikono', //cpg1.3.0
  'sel_on_img' =>'Izbrano podro�je mora biti na sliki!', //js-alert //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File faq.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FAQ_PHP')) $lang_faq_php = array(
  'faq' => 'Pogosto zastavljena vpra�anja', //cpg1.3.0
  'toc' => 'Kazalo', //cpg1.3.0
  'question' => 'Vpra�anje: ', //cpg1.3.0
  'answer' => 'Odgovor: ', //cpg1.3.0
);

if (defined('FAQ_PHP')) $lang_faq_data = array(
  'Osnovna vpra�anja', //cpg1.3.0
  array('Zakaj je potrebna registracija?', 'Registracija je ali pa ni potrebna - o tem odlo�a administrator. Registracija daje �lanom dodatne mo�nosti kot je dodajanje slik, kreiranje priljubljenih slik, urejanje albumov, ocenjevanje slik, dodajanje komentarjev....', 'allow_user_registration', '0'), //cpg1.3.0
  array('Kako se registriram?', 'Pojdi na &quot;Registracija&quot; in izpolni obrazec.<br />�e je administrator vklopil obve��anje preko e-mail naslovov, prejme� na svoj e-mail naslov sporo�ilo z navodili za aktiviranje svojega ra�una in s tem bo� imel mo�nost, da se s svojimi podatki potem prijavi�.', 'allow_user_registration', '1'), //cpg1.3.0
  array('Kako se prijavim?', 'Pojdi na &quot;Prijava&quot;, vpi�i svoje uporabni�ko ime in geslo, odkljukaj polje &quot;Zapomni si me&quot; in bo� prijavljen.<br /><b>POMEMBNO:omogo�eno mora� imeti uporabo pi�kotkov in pa le-ti ne smejo biti pobrisani, �e ho�e� izkoristiti tudi opcijo &quot;Zapomni si me&quot;.</b>', 'offline', 0), //cpg1.3.0
  array('Zakaj se ne morem prijaviti?', 'Si se �e registriral in odgovoril na povezavo, ki ti je bila poslana preko e-mail sporo�ila?. Poslana povezava slu�i za aktiviranje tvojega ra�una. Za ostale te�ave pri prijavi po�lji e-mail administratorju.', 'offline', 0), //cpg1.3.0
  array('Kaj �e pozabim geslo?', '�e se le da, uporabi povezavo &quot;Pozabljeno geslo&quot;. V nasprotnem primeru po�lji e-mail administratorju in zaprosi za novo geslo.', 'offline', 0), //cpg1.3.0
  //array('Kaj �e sem spremenil svoj e-mail naslov?', 'Prijavi se in v svojih nastavitvah popravi naslov. Uporabi povezavo &quot;Profil&quot;', 'offline', 0), //cpg1.3.0
  array('Kako shranim sliko v &quot;Moji favoriti&quot;?', 'Klikni na sliko in vklopi prikaz &quot;informacija o sliki&quot; (<img src="images/info.gif" width="16" height="16" border="0" alt="Informacija o sliki" />); v okvir�ku s podatki najde� povezavo &quot;Dodaj med priljubljene&quot;.<br />Informacija o sliki je mogo�e �e vklopljena, kar pa je odvisno od nastavitev same galerije.<br />POMEMBNO:omogo�eno mora� imeti uporabo pi�kotkov in pa le-ti ne smejo biti pobrisani.', 'offline', 0), //cpg1.3.0
  array('Kako lahko ocenim sliko?', 'Pri ogledu posamezne slike ima� mo�nost tudi oceniti le-to (seveda le, �e je to dovoljeno s strani lastnika albuma). Klikni na slikico, ki predstavlja posamezno oceno.', 'offline', 0), //cpg1.3.0
  array('Kako lahko dodam komentar?', 'Pri ogledu posamezne slike ima� mo�nost tudi dodati svoj komentar (seveda le, �e je to dovoljeno s strani lastnika albuma).', 'offline', 0), //cpg1.3.0
  array('Kako lahko dodam svojo sliko?', 'Izberi &quot;Nalaganje slik&quot;in dolo�i najprej album v katerega jo �eli� dodati, klikni na &quot;Prebrskaj&quot; in najdi sliko na disku, ki jo �eli� dodati. Ko jo najde�, klikni &quot;odpri/open&quot; (vpi�i naslov za sliko in opis, �e �eli�) in klikni kon�no �e &quot;Dodaj sliko&quot;', 'allow_private_albums', 0), //cpg1.3.0
  array('Kam lahko dodam sliko?', 'Ima� mo�nost, da jo doda� v enega od svojih albumov v &quot;Moja galerija&quot; ali pa, v katerikoli drugi album, �e je administrator to omogo�il.', 'allow_private_albums', 0), //cpg1.3.0
  array('Kako velike in kak�ne vrste slik lahko dodam?', 'Velikost in vrsta slik (jpg,gif,...) sta dolo�ena s strani administratorja.', 'offline', 0), //cpg1.3.0
  array('Kaj je &quot;Moja galerija&quot;?', '&quot;Moja galerija&quot; je osebna galerija, ki jo lahko imajo registrirani uporabniki. Omogo�a pa samostojno urejanje in upravljanje s slikami in albumi.', 'allow_private_albums', 0), //cpg1.3.0
  array('Kako lahko ustvarim, spremenim ali bri�em albume v&quot;Moji galeriji&quot;?', 'Biti mora� prijavljen in v &quot;na�inu za administracijo&quot;<br />Klikni na &quot;Ustvari/naro�i svoj album&quot; in klikni na &quot;Novo&quot;. Spremeni &quot;Novi album&quot; v svoje �eljeno ime za album.<br />V svoji galeriji lahko tako preimenuje� kateri koli album.<br />Klikni na &quot;Izvedi spremembe&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('Kako lahko dolo�im, da ostali ne vidijo slik v mojem albumu?', 'Biti mora� prijavljen in v &quot;na�inu za administracijo&quot;<br />Klikni na &quot;Spremeni svoj album&quot; Sedaj lahko nastavi� mo�nosti za tvoj album (dovoli� dodajanje slik, ocenjevanje slik, dodajanje komentarjev in pa dostop do albuma).<br />Na koncu klikni �e &quot;Posodobi album&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('Kako lahko vidim albume od ostalih uporabnikov?', 'Klikni na &quot;Seznam albumov ali logotip od galerije &quot; in izberi kategorijo &quot;Uporabni�ke galerije&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('Kaj so pi�kotki?', 'Pi�kotki so majhbe tekstovne datoteke, ki jih web stran shrani na tvojem ra�unalniku.<br />pi�kotki omogo�ajo la�jo prijavo na web strani.', 'offline', 0), //cpg1.3.0
  array('Kje lahko najdem ta program za svoje web strani?', 'Coppermine je prosta multimedijska galerija, objavljena pod GNU GPL. Omogo�a veliko raznoraznih funkcij in je predvidena za razli�ne sisteme. Obi��i <a href="http://coppermine.sf.net/">doma�o stran od Coppermine galerije</a> za download in ostale informacije.', 'offline', 0), //cpg1.3.0

  'Navigacija po straneh', //cpg1.3.0
  array('Kaj je &quot;Seznam albumov&quot;?', 'To je popolni seznam povezav do posameznih kategorij in/ali albumov v galeriji. Ikone so lahko tudi povezava do posamezne kategorije.', 'offline', 0), //cpg1.3.0
  array('Kaj je &quot;Moja galerija&quot;?', 'To je mo�nost, da uporabniki ustvarijo svoje albume in v njih dodajajo, urejajo in bri�ejo slike brez posredovanja administratorja.', 'allow_private_albums', 0), //cpg1.3.0
  array('Kak�na je razlika med &quot;Administracijo&quot; in &quot;Uporabni�kim na�inom&quot;?', 'Administracija omogo�a uporabnikom spreminjanje oz. urejanje svojih albumov in s tem slik.', 'allow_private_albums', 0), //cpg1.3.0
  array('Kaj pomeni &quot;Nalaganje slik&quot;?', 'To je mo�nost, da v posamezni album dodaja� slike (vrsta in velikost ter album so dolo�eni s strani administratorja).', 'allow_private_albums', 0), //cpg1.3.0
  array('Kaj pomeni &quot;Zadnje dodane slike&quot;?', 'Tukaj vidi� ikone od slik, ki so bile nazadnje nalo�ene na server.', 'offline', 0), //cpg1.3.0
  array('Kaj so &quot;Zadnji komentarji&quot;?', 'Tukaj vidi� vpisane zadnje komentarje k slikam s strani obiskovalcev.', 'offline', 0), //cpg1.3.0
  array('Kaj pomeni &quot;Najve� ogledov&quot;?', 'Tukaj vidi� seznam slik, ki so bile najve�krat pogledane s strani obiskovalcev.', 'offline', 0), //cpg1.3.0
  array('Kaj pomeni &quot;Najbolj ocenjeno&quot;?', 'Tukaj vidi� seznam slik, ki so dobile najve�je ocene s strani obiskovalcev, prikazana je povpre�na ocena (primer: 5 uporabnikov, vsak da oceno <img src="images/rating3.gif" width="65" height="14" border="0" alt="" />: slika bo imela povpre�no oceno <img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> ;Pet uporabnikov oceni sliko z ocenami od 1 do 5 (1,2,3,4,5) - rezultat bo povpre�na ocena <img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> .)<br />Ocene so od <img src="images/rating5.gif" width="65" height="14" border="0" alt="best" /> (super) do <img src="images/rating0.gif" width="65" height="14" border="0" alt="worst" /> (zani�).', 'offline', 0), //cpg1.3.0
  array('Kaj so &quot;Moji favoriti&quot;?', 'To omogo�a, da se v pi�kotek shrani seznam uporabniku najlep�ih slik.', 'offline', 0), //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// File forgot_passwd.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FORGOT_PASSWD_PHP')) $lang_forgot_passwd_php = array(
  'forgot_passwd' => 'Pozabljeno geslo', //cpg1.3.0
  'err_already_logged_in' => 'Trenutno si �e prijavljen!', //cpg1.3.0
  'enter_username_email' => 'Vpi�i uporabni�ko ime ali e-mail naslov', //cpg1.3.0
  'submit' => 'naprej', //cpg1.3.0
  'failed_sending_email' => 'Sporo�ila o pozabljenem geslu ni mo�no poslati!', //cpg1.3.0
  'email_sent' => 'Sporo�ilo s tvojim uporabni�kim imenom in geslo je bilo poslano na %s', //cpg1.3.0
  'err_unk_user' => 'Vpisani uporabnik ne obstaja!', //cpg1.3.0
  'passwd_reminder_subject' => '%s - pozabljeno geslo', //cpg1.3.0
  'passwd_reminder_body' => 'Tvoji podatki za prijavo:
Uporabni�ko ime: %s
Geslo: %s
Klikni %s za prijavo.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
  'group_name' => 'Ime skupine',
  'disk_quota' => 'Velikost diska',
  'can_rate' => 'Lahko ocenjuje slike', //cpg1.3.0
  'can_send_ecards' => 'Lahko po�ilja razglednice',
  'can_post_com' => 'Lahko dodaja komentarje',
  'can_upload' => 'Lahko dodaja slike', //cpg1.3.0
  'can_have_gallery' => 'Lahko ima osebno galerijo',
  'apply' => 'Izvedi spremembe',
  'create_new_group' => 'Ustvari novo skupino',
  'del_groups' => 'Pobri�i izbrano skupino',
  'confirm_del' => 'Opozorilo: pri brisanju skupine se vsi �lani premaknejo v skupino z imenom \'Registered\'!\n\n�eli� nadaljevati?', //js-alert //cpg1.3.0
  'title' => 'Urejanje uporabni�kih skupin',
  'approval_1' => 'Javne odobritve slik (1)',
  'approval_2' => 'Privatne odobritve slik (2)',
  'upload_form_config' => 'Upload form configuration', //cpg1.3.0
  'upload_form_config_values' => array( 'Single file uploads only', 'Multiple file uploads only', 'URI uploads only', 'ZIP upload only', 'File-URI', 'File-ZIP', 'URI-ZIP', 'File-URI-ZIP'), //cpg1.3.0
  'custom_user_upload'=>'User may customize number of upload boxes?', //cpg1.3.0
  'num_file_upload'=>'Maximum/exact number of file upload boxes', //cpg1.3.0
  'num_URI_upload'=>'Maximum/exact number of URI upload boxes', //cpg1.3.0
  'note1' => '<b>(1)</b> Slike v javnih albumih potrebujejo odobritev za prikaz',
  'note2' => '<b>(2)</b> Slike v privatnih albumih potrebujejo odobritev za prikaz',
  'notes' => 'Opombe',
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
  'welcome' => 'Dobrodo�el!',
);

$lang_album_admin_menu = array(
  'confirm_delete' => 'Res �eli� pobrisati ta album? \\nVse slike in komentarji v njem bodo tudi pobrisani.', //js-alert //cpg1.3.0
  'delete' => 'BRISANJE',
  'modify' => 'LASTNOSTI',
  'edit_pics' => 'UREJANJE', //cpg1.3.0
);

$lang_list_categories = array(
  'home' => 'Domov',
  'stat1' => '�t. slik:<b>[pictures]</b> - �t. albumov:<b>[albums]</b> - �t. kategorij:<b>[cat]</b>  - �t. komentarjev:<b>[comments]</b> - �t. ogledov:<b>[views]</b>', //cpg1.3.0
  'stat2' => '�t. slik:<b>[pictures]</b> - �t. albumov:<b>[albums]</b> - �t. ogledov<b>[views]</b>', //cpg1.3.0
  'xx_s_gallery' => 'Galerija od %s',
  'stat3' => '�t. slik:<b>[pictures]</b> - �t. albumov:<b>[albums]</b> - �t. komentarjev:<b>[comments]</b>  - �t. ogledov:<b>[views]</b>', //cpg1.3.0
);

$lang_list_users = array(
  'user_list' => 'Seznam uporabnikov',
  'no_user_gal' => 'Brez uporabni�kih galerij',
  'n_albums' => '�t. albumov:%s',
  'n_pics' => '�t. slik:%s', //cpg1.3.0
);

$lang_list_albums = array(
  'n_pictures' => '�t. slik:%s', //cpg1.3.0
  'last_added' => ', zadnja dodana %s',
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
  'login' => 'Prijava',
  'enter_login_pswd' => 'Vpi�i uporabni�ko ime in geslo',
  'username' => 'Uporabni�ko ime',
  'password' => 'Geslo',
  'remember_me' => 'Zapomni si me',
  'welcome' => 'Pozdravljen/a %s ...',
  'err_login' => '*** Prijava ni uspelo. Poskusi znova ***',
  'err_already_logged_in' => 'Si �e prijavljen!',
  'forgot_password_link' => 'Pozabil sem geslo', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
  'logout' => 'Odjava',
  'bye' => 'Lepo pozdravljen %s ...',
  'err_not_loged_in' => 'Nisi prijavljen!',
);

// ------------------------------------------------------------------------- //
// File phpinfo.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('PHPINFO_PHP')) $lang_phpinfo_php = array(
  'php_info' => 'PHP info', //cpg1.3.0
  'explanation' => 'To je rezultat, ki ga je generiral php ukaz <a href="http://www.php.net/phpinfo">phpinfo()</a>, prikazan s strani galerije.', //cpg1.3.0
  'no_link' => '�e te podatke vidijo ostali je to lahko varnostno sporno. Zato jih lahko vidi� samo, �e si prijavljen kot administrator. �eprav bi ostalim poslal pot do te strani, je ne bodo videli.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
  'upd_alb_n' => 'Posodobi album %s',
  'general_settings' => 'Splo�ne nastavitve',
  'alb_title' => 'Ime albuma',
  'alb_cat' => 'Kategorija od albuma',
  'alb_desc' => 'Opis albuma',
  'alb_thumb' => 'Ikona albuma',
  'alb_perm' => 'Pravice za ta album',
  'can_view' => 'Album lahko vidijo',
  'can_upload' => 'Obiskovalci lahko dodajajo slike',
  'can_post_comments' => 'Obiskovalci lahko dodajajo komentarje',
  'can_rate' => 'Obiskovalci lahko ocenjujejo slike',
  'user_gal' => 'Uporabni�ka galerija',
  'no_cat' => '* Brez kategorije *',
  'alb_empty' => 'Album je prazen',
  'last_uploaded' => 'Zadnje dodano...',
  'public_alb' => 'Vsi (javni album)',
  'me_only' => 'Samo jaz',
  'owner_only' => 'Lastnik albuma (%s)',
  'groupp_only' => '�lani skupine \'%s\'',
  'err_no_alb_to_modify' => 'Ni albumov, ki bi jih lahko urejal.',
  'update' => 'Posodobi album', //cpg1.3.0
  'notice1' => '(*) odvisno od %sskupine%s (lastnosti)', //cpg1.3.0 (do not translate %s!)
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
  'already_rated' => 'Oprosti, ampak to sliko si �e ocenil', //cpg1.3.0
  'rate_ok' => 'Tvoja ocena je bila zabele�ena',
  'forbidden' => 'Lastnih slik ne more� ocenjevati.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
�eprav bo administrator {SITE_NAME} posku�al odstraniti vsako neprimerno vsebino objavljeno v galeriji, je nemogo�e hkrati in pravo�asno pregledati vse kar je objavljeno s strani obiskovalcev. Zavedati se morate, da vse objavljeno na teh straneh predstavlja pogled in mnenje avtorja in ne administratorja oz. vzdr�evalca teh spletnih strani (razen tistega kar je objavljeno z njune strani).<br />
<br />
S sodelovanjem na teh spletnih straneh se tudi strinjate, da ne boste objavljali nobenih obscenih, vulgarnih, �aljivih, seksualnih, sovra�nih, rasno nestrpnih in ostalih vsebin, ki so v nasprotju z veljavno zakonodajo. Strinjate se tudi, da ima aministrator in/ali moderator dolo�enih vsebin na {SITE_NAME} pravico v katerem koli trenutku odstraniti po njegovem mnenju sporni objavljeni prispevek. Kot uporabnik se strinjate, da je z va�e strani objavljeno gradivo shranjeno v bazi. �eprav ti podatki ne bodo posredovani nobeni tretji stranki, administrator oziroma skrbnik teh strani ne odgovarja za izgubljene podatke v primeru hekerskega poskusa kraje podatkov.<br />
<br />
Te spletne strani uporabljajo pi�kotke (cookies) za shranjevanje informacij na va�em ra�unalniku. Ti podatki so namenjeni isklju�no temu, da vam olaj�ajo brskanje na teh straneh. Va� email naslov pa je uporabljen samo za to, da vam lahko posredujemo geslo za prijavo.<br />
<br />

S klikom na 'STRINJAM SE' potrjujete, da ste seznanjeni s pogoji sodelovanje na straneh {SITE_NAME} in da je poslano gradivo va�a osebna last. V nasprotnem primeru ste dol�ni navesti izvor poslanega gradiva. Prav tako ste dol�ni navesti kot izvor {SITE_NAME}, �e uporabite gradivo s teh strani. Dovoljena je izklju�no uporaba v izobra�evalne namene. Za vse ostale primere si morate priskrbeti dovoljenje lastnika teh strani.<br />
EOT;

$lang_register_php = array(
  'page_title' => 'Registracija',
  'term_cond' => 'Navodila in pogoji za sodelovanje',
  'i_agree' => 'STRINJAM SE',
  'submit' => 'Po�lji registracijo',
  'err_user_exists' => 'To uporabni�ko ime �e obstaja, izberi si drugo',
  'err_password_mismatch' => 'Gesli se ne ujemata - ponovi vpis',
  'err_uname_short' => 'Uporabni�ko ime mora imeti vsaj dva znaka',
  'err_password_short' => 'Geslo mora biti dolgo vsaj dva znaka',
  'err_uname_pass_diff' => 'Uporabni�ko ime in geslo morata biti razli�na',
  'err_invalid_email' => 'Napa�ni e-mail naslov!',
  'err_duplicate_email' => 'Ta e-mail naslov je nekdo �e uporabil',
  'enter_info' => 'Vpis podatkov za registracijo',
  'required_info' => 'Obvezni podatki',
  'optional_info' => 'Neobvezni vpis',
  'username' => 'Uporabni�ko ime',
  'password' => 'Geslo',
  'password_again' => 'Ponovi geslo',
  'email' => 'e-mail',
  'location' => 'Kraj',
  'interests' => 'Zanimanje',
  'website' => 'Doma�a stran',
  'occupation' => 'Zaposlitev',
  'error' => 'NAPAKA',
  'confirm_email_subject' => '%s - registracija potrjena',
  'information' => 'Informacija',
  'failed_sending_email' => 'Ne morem poslati e-mail sporo�ila s podatki o registraciji!',
  'thank_you' => 'Hvala za registracijo.<br /><br />Navodila za aktiviranje ra�una so bila poslana na vpisani e-mail naslov.',
  'acct_created' => 'Tvoj ra�un je bil ustvarjen - lahko se prijavi� s svojim uporabni�kim imenom in geslom',
  'acct_active' => 'Tvoj ra�un je aktiven in se lahko prijavi�',
  'acct_already_act' => 'Tvoj ra�un je �e aktiven!',
  'acct_act_failed' => 'Tega ra�una ni mo�no aktivirati!',
  'err_unk_user' => 'Izbrani uporabnik ne obstaja!',
  'x_s_profile' => 'Profil od %s',
  'group' => 'Skupina',
  'reg_date' => 'Datum pristopa',
  'disk_usage' => 'Velikost diska',
  'change_pass' => 'Spremeni geslo',
  'current_pass' => 'Staro geslo',
  'new_pass' => 'Novo geslo',
  'new_pass_again' => 'Novo geslo ponovno',
  'err_curr_pass' => 'Staro geslo ni pravilno',
  'apply_modif' => 'Izvedi spremembe',
  'change_pass' => 'Spremeni moje geslo',
  'update_success' => 'Profil je bil posodobljen',
  'pass_chg_success' => 'Geslo je bilo spremenjeno',
  'pass_chg_error' => 'Geslo ni bilo spremenjeno',
  'notify_admin_email_subject' => '%s - obvestilo o registraciji', //cpg1.3.0
  'notify_admin_email_body' => 'Registriral se je novi uporabnik "%s" ', //cpg1.3.0
);

$lang_register_confirm_email = <<<EOT
Hvala za registracijo pri: {SITE_NAME}

Tvoje uporabni�ko ime je: "{USER_NAME}"
Tvoje geslo je: "{PASSWORD}"

�e �eli� aktivirati svoj ra�un, mora� klikniti na spodnjo povezavo
ali pa jo vpisati v naslovno vrstico brskalnika.

{ACT_LINK}

Lep pozdrav,

administrator od {SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
  'title' => 'Prikaz komentarjev',
  'no_comment' => 'Ni komentarjev za prikaz',
  'n_comm_del' => '�t. pobrisanik komentarjev:%s',
  'n_comm_disp' => '�t. komentarjev za prikaz',
  'see_prev' => 'Poglej predhodnega',
  'see_next' => 'Poglej naslednjega',
  'del_comm' => 'Pobri�i izbrane komentarje',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
  0 => 'Iskanje slik',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
  'page_title' => 'Iskanje novih slik', //cpg1.3.0
  'select_dir' => 'Izberi direktorij',
  'select_dir_msg' => 'Ta ukaz ti omogo�a dodajanje slik, ki si jih dodal na server s pomo�jo FTP protokola.<br /><br />Izberi direktorij v katerega si dodal slike', //cpg1.3.0
  'no_pic_to_add' => 'Tu ni nobenih slik za dodajanje', //cpg1.3.0
  'need_one_album' => 'Za uporabo te funkcije mora� imeti vsaj en album',
  'warning' => 'Opozorilo',
  'change_perm' => 'pisanje v direktorij ni omogo�eno, spremeni pravice v 755 ali 777 pred ponovnim poskusom dodajanja slik!', //cpg1.3.0
  'target_album' => '<b>Dodaj slike </b>%s<b> v </b>%s', //cpg1.3.0
  'folder' => 'Direktorij',
  'image' => 'Slika',
  'album' => 'Album',
  'result' => 'Rezultat',
  'dir_ro' => 'Pisanje onemogo�eno. ',
  'dir_cant_read' => 'Branje onemogo�eno. ',
  'insert' => 'Dodajanje novih slik v galerijo', //cpg1.3.0
  'list_new_pic' => 'Seznam novih slik', //cpg1.3.0
  'insert_selected' => 'Dodaj izbrane slike', //cpg1.3.0
  'no_pic_found' => 'Brez novih slik', //cpg1.3.0
  'be_patient' => 'Potrpe�ljivost... dodajanje traja nekaj �asa', //cpg1.3.0
  'no_album' => 'nisi izbral albuma',  //cpg1.3.0
  'notes' =>  '<ul>'.
                          '<li><b>OK</b> : pomeni, da so slike uspe�no dodane'.
                          '<li><b>DP</b> : pomeni, da je slika duplikat in je �e v bazi'.
                          '<li><b>PB</b> : pomeni, da slike ni mo�no dodati. Preveri nastavitve in pravice za direktorij v katerem se nahajajo'.
                          '<li><b>NA</b> : pomeni, da nisi izbral albuma za slike, klikni \'<a href="javascript:history.back(1)">nazaj</a>\' in izberi album. �e albuma �e nima�, <a href="albmgr.php">ustvari enega najprej</a></li>'.
                          '<li>�e ne vidi� oznak OK, DP ali PB, klikni na manjkajo�o slikico za prikaz napake, ki jo generira PHP'.
                          '<li>Za osve�itev prikaza pritisni tipko "ponovno nalo�i/reload"  v svojem brskalniku'.
                          '</ul>', //cpg1.3.0
  'select_album' => 'izberi album', //cpg1.3.0
  'check_all' => 'Ozna�i vse', //cpg1.3.0
  'uncheck_all' => 'Odzna�i vse', //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //

// Void

// ------------------------------------------------------------------------- //
// File banning.php
// ------------------------------------------------------------------------- //

if (defined('BANNING_PHP')) $lang_banning_php = array(
  'title' => 'Zavrni uporabnika',
  'user_name' => 'Uporabni�ko ime',
  'ip_address' => 'IP naslov',
  'expiry' => 'Pote�e (za trajno - pusti prazno)',
  'edit_ban' => 'Shrani spremembe',
  'delete_ban' => 'Pobri�i',
  'add_new' => 'Dodaj novo prepoved',
  'add_ban' => 'Dodaj',
  'error_user' => 'Ne najdem uporabnika', //cpg1.3.0
  'error_specify' => 'Vpisati mora� uporabni�ko ime ali IP �tevilko', //cpg1.3.0
  'error_ban_id' => 'Napa�na IP �tevilka!', //cpg1.3.0
  'error_admin_ban' => 'Sebi ne more� prepovedati dostopa!', //cpg1.3.0
  'error_server_ban' => 'Posku�a� prepovedati dostop svojemu serverju? Tsk tsk, tega pa ne bom podpiral...', //cpg1.3.0
  'error_ip_forbidden' => 'Temu IP naslovu ne more� prpovedati dostopa - je nepovezljiv (non-routable)!', //cpg1.3.0
  'lookup_ip' => 'Poglej IP naslov', //cpg1.3.0
  'submit' => 'NAPREJ!', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
  'title' => 'Dodaj sliko', //cpg1.3.0
  'custom_title' => 'Obrazec za dodajanje', //cpg1.3.0
  'cust_instr_1' => 'Izbere� lahko poljubno �tevilo datotek za upload, vendar najve� kot je navedeno spodaj.', //cpg1.3.0
  'cust_instr_2' => '�tevilka zahtevka', //cpg1.3.0
  'cust_instr_3' => 'Upload datotek (najve�): %s', //cpg1.3.0
  'cust_instr_4' => 'URI/URL upload (najve�): %s', //cpg1.3.0
  'cust_instr_5' => 'URI/URL upload:', //cpg1.3.0
  'cust_instr_6' => 'Upload datotek:', //cpg1.3.0
  'cust_instr_7' => 'Izberi �tevilo posameznih na�inov za upload in klikni \'NAPREJ\'. ', //cpg1.3.0
  'reg_instr_1' => 'Napa�ni ukaz za obrazec.', //cpg1.3.0
  'reg_instr_2' => 'Sedaj lahko doda�/po�lje� svoje datoteke na server. Velikost posamezne datoteke ne sme prese�i %s kB. ZIP datoteke dodane s pomo�jo \'Upload datotek\' in \'URI/URL dodajanje\' bodo ostale kompresirane.', //cpg1.3.0
  'reg_instr_3' => '�e ho�e�, da bodo ZIP datoteke razpakirane, uporabi polje \'Dekompresivni ZIP upload\'.', //cpg1.3.0
  'reg_instr_4' => 'Ko uporablja� URI/URL upload, vpi�i pot do datoteke na naslednji na�in: http://www.mojastran.com/images/slika.jpg', //cpg1.3.0
  'reg_instr_5' => 'Ko si izpolnil obrazec, klikni \'NAPREJ\'.', //cpg1.3.0
  'reg_instr_6' => 'Dekompresivni ZIP upload:', //cpg1.3.0
  'reg_instr_7' => 'Dodajanje slik:', //cpg1.3.0
  'reg_instr_8' => 'URI/URL upload:', //cpg1.3.0
  'error_report' => 'Poro�ilo o napaki', //cpg1.3.0
  'error_instr' => 'Tvoja zahteva za upload je povzro�ila napako:', //cpg1.3.0
  'file_name_url' => 'Slika ime/URL', //cpg1.3.0
  'error_message' => 'Sporo�ilo o napaki', //cpg1.3.0
  'no_post' => 'Slike niso bile poslane.', //cpg1.3.0
  'forb_ext' => 'Napa�na kon�nica datoteke.', //cpg1.3.0
  'exc_php_ini' => 'Prevelika datoteka/slika glede na dovoljeno nastavitev v php.ini.', //cpg1.3.0
  'exc_file_size' => 'Prevelika datoteka/slika glede na dovoljeno nastavitev v galeriji.', //cpg1.3.0
  'partial_upload' => 'Samo delno poslane/dodane slike.', //cpg1.3.0
  'no_upload' => 'Nobene slike ni bilo poslane/dodane.', //cpg1.3.0
  'unknown_code' => 'Neznana PHP koda o napaki.', //cpg1.3.0
  'no_temp_name' => 'No upload - No temp name.', //cpg1.3.0
  'no_file_size' => 'Datoteka ne vsebuje podatkov/pokvarjena', //cpg1.3.0
  'impossible' => 'Tega ni mo� premakniti.', //cpg1.3.0
  'not_image' => 'Datoteka ni slika/pokvarjena', //cpg1.3.0
  'not_GD' => 'Slika ni dovoljena za GD knji�nico(gif,jpg).', //cpg1.3.0
  'pixel_allowance' => 'Pixel toleranca prekora�ena.', //cpg1.3.0
  'incorrect_prefix' => 'Napa�en URI/URL prefix', //cpg1.3.0
  'could_not_open_URI' => 'Ne morem odpreti URI.', //cpg1.3.0
  'unsafe_URI' => 'Ni mo�no preveriti varnosti.', //cpg1.3.0
  'meta_data_failure' => 'Meta podatki manjkajo', //cpg1.3.0
  'http_401' => '401 Dostop samo z geslom', //cpg1.3.0
  'http_402' => '402 Potrebno pla�ilo', //cpg1.3.0
  'http_403' => '403 Prepovedano', //cpg1.3.0
  'http_404' => '404 Ne najdem', //cpg1.3.0
  'http_500' => '500 Napaka na serverju', //cpg1.3.0
  'http_503' => '503 Tega ni na razpolago', //cpg1.3.0
  'MIME_extraction_failure' => 'MIME tipa podatka ne morem razbrati.', //cpg1.3.0
  'MIME_type_unknown' => 'Neznana MIME vrsta', //cpg1.3.0
  'cant_create_write' => 'Kreiranje datoteke ni uspelo.', //cpg1.3.0
  'not_writable' => 'Pisanje v datoteko ni uspelo.', //cpg1.3.0
  'cant_read_URI' => 'Ne morem prebrati URI/URL naslova', //cpg1.3.0
  'cant_open_write_file' => 'Ne morem odpreti URI datoteke za pisanje.', //cpg1.3.0
  'cant_write_write_file' => 'Ne morem pisati v URI datoteko.', //cpg1.3.0
  'cant_unzip' => 'Unzip ni uspel.', //cpg1.3.0
  'unknown' => 'Neznana napaka', //cpg1.3.0
  'succ' => 'Uspe�no poslano na server', //cpg1.3.0
  'success' => '�t. uspe�nih uploadov:%s.', //cpg1.3.0
  'add' => 'Klikni \'NAPREJ\' za dodajanje slik v album.', //cpg1.3.0
  'failure' => 'Dodajanje ni uspelo', //cpg1.3.0
  'f_info' => 'Podatki o sliki', //cpg1.3.0
  'no_place' => 'Predhodna slika ni bila dodana.', //cpg1.3.0
  'yes_place' => 'Predhodna slika je bila uspe�no dodana.', //cpg1.3.0
  'max_fsize' => 'najve�ja dovoljena velikost je %s kB',
  'album' => 'Album',
  'picture' => 'Slika', //cpg1.3.0
  'pic_title' => 'Ime slike', //cpg1.3.0
  'description' => 'Opis slike', //cpg1.3.0
  'keywords' => 'Klju�ne besede (lo�i s presledki)',
  'err_no_alb_uploadables' => 'Oprosti, trenutno nobeden album ne omogo�a dodajanja slik', //cpg1.3.0
  'place_instr_1' => 'Dodaj vse slike sedaj. Vpi�e� lahko tudi dodatne informacije za posamezno sliko.', //cpg1.3.0
  'place_instr_2' => 'Na dodajanje �aka �e ve� slik. Prosim klikni \'NAPREJ\'.', //cpg1.3.0
  'process_complete' => 'Uspe�no si dodal vse slike.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
  'title' => 'Urejanje uporabnikov',
  'name_a' => 'Ime nara��ajo�e',
  'name_d' => 'Ime padajo�e',
  'group_a' => 'Skupina nara��ajo�e',
  'group_d' => 'Skupina padajo�e',
  'reg_a' => 'Datum reg. nara��ajo�e',
  'reg_d' => 'Datum reg. padajo�e',
  'pic_a' => '�t. slik nara��ajo�e',
  'pic_d' => '�t. slik padajo�e',
  'disku_a' => 'Poraba diska nara��ajo�e',
  'disku_d' => 'Poraba diska padajo�e',
  'lv_a' => 'Zadnji obiski nara��ajo�e', //cpg1.3.0
  'lv_d' => 'Zadnji obiski padajo�e', //cpg1.3.0
  'sort_by' => 'Sortiraj uporabnike po',
  'err_no_users' => 'Tabela s podatki je prazna!',
  'err_edit_self' => 'Svojega prifila ne more� spremeniti. Uporabi povezavo \'Moj profil\'',
  'edit' => 'UREJANJE',
  'delete' => 'BRISANJE',
  'name' => 'Uporabni�ko ime',
  'group' => 'Skupina',
  'inactive' => 'Neaktivni',
  'operations' => 'Operacije',
  'pictures' => 'Slike', //cpg1.3.0
  'disk_space' => 'Porabljen prostor',
  'registered_on' => 'Registriran',
  'last_visit' => 'Zadnji obisk', //cpg1.3.0
  'u_user_on_p_pages' => '�t. uporabnikov:%d (�t. strani:%d)',
  'confirm_del' => 'Res �eli� pobrisati tega uporabnika? \\nTudi njegove slike in albumi bodo pobrisani.', //js-alert //cpg1.3.0
  'mail' => 'PO�TA',
  'err_unknown_user' => 'Izbrani uporabnik ne obstaja!',
  'modify_user' => 'Uredi uporabnika',
  'notes' => 'Opombe',
  'note_list' => '<li>�e gesla ne �eli� spreminjati, pusti polje za geslo prazno',
  'password' => 'Geslo',
  'user_active' => 'Uporabnik je aktiven',
  'user_group' => 'Uporabnikova skupina',
  'user_email' => 'Uporabnikov email',
  'user_web_site' => 'Uporabnikova doma�a stran',
  'create_new_user' => 'Ustvari novega uporabnika',
  'user_location' => 'Uporabnikova lokacija',
  'user_interests' => 'Uporabnikovo zanimanje',
  'user_occupation' => 'Uporabnikova zaposlitev',
  'latest_upload' => 'Zadnje dodano', //cpg1.3.0
  'never' => 'nikoli', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
  'title' => 'Spremeni velikost slik', //cpg1.3.0
  'what_it_does' => 'Kaj to pomeni',
  'what_update_titles' => 'Kreira imena slik iz imena datotek',
  'what_delete_title' => 'Brisanje imen',
  'what_rebuild' => 'Ponastavi ikone in spremeni velikost slik',
  'what_delete_originals' => 'Pobri�e originalne slike in jih nadomesti z novimi',
  'file' => 'Datoteka',
  'title_set_to' => 'naslov spremenjen v',
  'submit_form' => 'po�lji',
  'updated_succesfully' => 'uspe�no posodobljeno',
  'error_create' => 'NAPAKA pri kreiranju',
  'continue' => 'Nadaljuj na naslednjih slikah',
  'main_success' => 'Datoteka %s je bila uporabljena za originalno sliko', //cpg1.3.0
  'error_rename' => 'Napaka pri preimenovanju %s v %s',
  'error_not_found' => 'Ne najdem datoteke %s',
  'back' => 'nazaj na glavno stran',
  'thumbs_wait' => 'Poteka posodabljanje ikon in/ali spreminjanje slik, prosim po�akaj...',
  'thumbs_continue_wait' => 'Nadaljujem s posodabljanjem ikon in/ali slik, prosim po�akaj...',
  'titles_wait' => 'Posodabljanje naslovov, prosim po�akaj...',
  'delete_wait' => 'Brisanje naslovov, prosim po�akaj...',
  'replace_wait' => 'Brisanje originalnih slik in nadome��anje s spremenjenimi, prosim po�akaj...',
  'instruction' => 'Kratka navodila',
  'instruction_action' => 'Izberi ukaz',
  'instruction_parameter' => 'Nastavi parametre',
  'instruction_album' => 'Izberi album',
  'instruction_press' => 'Pritisni %s',
  'update' => 'Posodobi ikone in/ali spremenjene slike',
  'update_what' => 'Kaj naj posodobim',
  'update_thumb' => 'Samo ikone',
  'update_pic' => 'Samo spremenjene slike',
  'update_both' => 'Ikone in spremenjene slike',
  'update_number' => '�tevilo slik za spreminjanje za vsak klik',
  'update_option' => '(Poskusi z manj�o vrednostjo, �e pride do poteka �asa med izvajanjem opracije)',
  'filename_title' => 'Ime datoteke &rArr; Ime slike', //cpg1.3.0
  'filename_how' => 'Kako naj pretvorim ime datoteke',
  'filename_remove' => 'Odstrani kon�nico .jpg in nadomesti _ (pod�rtaj) s presledki',
  'filename_euro' => 'Spremeni 2003_11_23_13_20_20.jpg v 23/11/2003 13:20',
  'filename_us' => 'Spremeni 2003_11_23_13_20_20.jpg v 11/23/2003 13:20',
  'filename_time' => 'Spremeni 2003_11_23_13_20_20.jpg v 13:20',
  'delete' => 'Pobri�i naslove slik ali originalne slike', //cpg1.3.0
  'delete_title' => 'Pobri�i naslove slik', //cpg1.3.0
  'delete_original' => 'Pobri�i originalne slike',
  'delete_replace' => 'Pobri�i originalne slike, nadomesti jih s spremenjenimi (po velikosti)',
  'select_album' => 'Izberi album',
  'delete_orphans' => 'Pobri�i komentarje, ki ne pripadajo nobeni sliki (deluje na vseh albumih)', //cpg1.3.0
  'orphan_comment' => 'najden komentar brez "lastnika"', //cpg1.3.0
  'delete' => 'Brisanje', //cpg1.3.0
  'delete_all' => 'Pobri�i vse', //cpg1.3.0
  'comment' => 'Komentar: ', //cpg1.3.0
  'nonexist' => 'pripeto k neobstoje�i sliki # ', //cpg1.3.0
  'phpinfo' => 'Prika�i phpinfo', //cpg1.3.0
  'update_db' => 'Posodobi bazo', //cpg1.3.0
  'update_db_explanation' => '�e si zamenjal kak�ne datoteke od galerije, dodal spremembe ali nadgradil s prej�nje verije, izvedi vsaj enkrat ukaz "posodobi bazo". To bo naredilo potrebne spremembe v bazi, kreiralo manjkajo�e tabele in nastavilo potrebne vrednosti za delovanje v konfiguracijskih tabelah.', //cpg1.3.0
);

?>