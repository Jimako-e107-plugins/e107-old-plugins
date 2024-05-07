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
// $Id: finnish.php,v 1.8 2005/07/05 05:35:58 gaugau Exp $
// ------------------------------------------------------------------------- //

// K��nt�j� ja tietoja k��nn�ksest�
$lang_translation_info = array(
        'lang_name_english' => 'Finnish',
        'lang_name_native' => 'Suomi',
        'lang_country_code' => 'fi',
        'trans_name'=> 'Mikko Kulmala',
        'trans_email' => 'mikko@kulmalat.org',
        'trans_website' => 'http://www.kulmalat.org',
        'trans_date' => '2004-06-13',
);

$lang_charset = 'iso-8859-1';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// lyhenteet Tavulle, Kilolle ja Megalle
$lang_byte_units = array('tavua', 'KB', 'MB');

// Viikonp�iv�t ja kuukaudet
$lang_day_of_week = array('Su', 'Ma', 'Ti', 'Ke', 'To', 'Pe', 'La');
$lang_month = array('Tammikuu', 'Helmikuu', 'Maaliskuu', 'Huhtikuu', 'Toukokuu', 'Kes�kuu', 'Hein�kuu', 'Elokuu', 'Syyskuu', 'Lokakuu', 'Marraskuu', 'Joulukuu');

// Yleist�
$lang_yes = 'Kyll�';
$lang_no  = 'Ei';
$lang_back = 'Takaisin';
$lang_continue = 'Jatka';
$lang_info = 'Tietoa';
$lang_error = 'Virhe';

// P�iv�ys
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%B %d, %Y';
$lastcom_date_fmt =  '%m/%d/%y at %H:%M';
$lastup_date_fmt = '%B %d, %Y';
$register_date_fmt = '%B %d, %Y';
$lasthit_date_fmt = '%B %d, %Y at %I:%M %p';
$comment_date_fmt =  '%B %d, %Y at %I:%M %p';

// Kirosanafiltteri (ei k��nnetty)
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array(
        'random' => 'Satunnaiset kuvat', 
        'lastup' => 'Uusimmat kuvat', 
        'lastalb'=> 'Viimeksi p�ivitetyt albumit', 
        'lastcom' => 'Uusimmat komentit', 
        'topn' => 'Katsotuimmat', 
        'toprated' => 'Suosituimmat', 
        'lasthits' => 'Viimeksi tarkasteltu', 
        'search' => 'Haun tulokset', 
        'favpics'=> 'Omat suosikkini'
);

$lang_errors = array(
	'access_denied' => 'Ei oikeuksia t�lle sivulle.',
	'perm_denied' => 'Ei oikeuksia kyseisen toiminnon suorittamiseen.',
	'param_missing' => 'Skripti� kutsuttu ilman vaadittavia parametrej�.',
	'non_exist_ap' => 'Valittua albumia/kuvaa ei l�ydy !',
	'quota_exceeded' => 'Levytilasi on t�ynn�<br /><br />Levytilasi on t�ynn� [quota]K, kuviesi viev� tila [space]K, lis��m�ll� t�m�n kuvan tilasi koko ylittyisi.',
	'gd_file_type_err' => 'Kun k�yt�t GD:t�, sallitut tiedostomuodot ovat JPEG ja PNG.',
	'invalid_image' => 'Kuva on korruptoitunut eik� sit� voi k�sitell� GD:ll�',
	'resize_failed' => 'Ongelma thumbnailien luomisessa.',
	'no_img_to_display' => 'Ei n�yttett�vi� kuvia',
	'non_exist_cat' => 'Valittua kategoriaa ei l�ydy',
	'orphan_cat' => 'Ongelmia kategoriassa. Aja kategoriamanageri ongelman selvitt�miseksi.',
	'directory_ro' => 'Hakemistoon \'%s\' ei ole m��ritelty kirjoitusoikeuksia. Kuvia ei voi poistaa',
	'non_exist_comment' => 'Valittua kommenttia ei l�ydy.',
	'pic_in_invalid_album' => 'Kuvaa ei ole albumissa (%s)!?',
	'banned' => 'Sinulta on ev�tty p��sy t�lle sivulle.', 
	'not_with_udb' => 'T�m� toiminto on poistettu k�yt�st� Coppermine gallerissa, koska t�m� on integroitu foorumiohjelmistoon. Toiminto, jota yritit tehd�, ei ole tuettuna t�ss� kokoonpanossa. Toiminto l�ytyy mahdollisesti foorumiohjelmistosta.', 
	'offline_title' => 'Offline', //cpg1.3.0
	'offline_text' => 'Galleria on t�ll� hetkell� offline-tilassa - palaa my�hemmin uudelleen.', //cpg1.3.0
        'ecards_empty' => 'Yht��n e-korttia ei ole k�ytett�viss�. Varmista, ett� olet sallinut e-korttien k�ytt�misen gallerian asetuksista.', //cpg1.3.0
	'action_failed' => 'Toiminto ep�onnistui.  Coppermine ei pysty k�sittelem��n valitsemaasi toimintoa.', //cpg1.3.0
        'no_zip' => 'Zip-tiedostojen k�sittelyss� v�ltt�m�tt�mi� tiedostoja ei ole saatavilla. Ota yhteys gallerian yll�pitoon.', //cpg1.3.0
	'zip_type' => 'Sinulla ei ole oikeutta siirt�� palvelimelle Zip-tiedostoja.', //cpg1.3.0
);

$lang_bbcode_help = 'Seuraavat koodit ovat k�ytt�kelpoisia: <li>[b]<b>Lihavoitu</b>[/b]</li> <li>[i]<i>Kursivoitu</i>[/i]</li> <li>[url=http://omasivu.com/]Linkki[/url]</li> <li>[email]k�ytt�j�@domain.com[/email]</li>'; //cpg1.3.0

// ------------------------------------------------------------------------- //
// Tiedosto theme.php                                                        //
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => 'Siirry albumilistaan',
	'alb_list_lnk' => 'Albumilista',
	'my_gal_title' => 'Siirry omaan galleriaan',
	'my_gal_lnk' => 'Oma galleria',
	'my_prof_lnk' => 'Omat asetukset',
	'adm_mode_title' => 'Vaihda yll�pitotilaan',
	'adm_mode_lnk' => 'Yll�pitotila',
	'usr_mode_title' => 'Vaihda k�ytt�j�tilaan',
	'usr_mode_lnk' => 'K�ytt�j�tila',
	'upload_pic_title' => 'Lis�� kuva albumiin',
	'upload_pic_lnk' => 'Lis�� kuva',
	'register_title' => 'Luo uusi tili',
	'register_lnk' => 'Rekister�idy',
	'login_lnk' => 'Kirjaudu',
	'logout_lnk' => 'Poistu',
	'lastup_lnk' => 'Viimeksi lis�tty',
	'lastcom_lnk' => 'Uusimmat kommentit',
	'topn_lnk' => 'Katsotuimmat',
	'toprated_lnk' => 'Suosituimmat',
	'search_lnk' => 'Haku',
	'fav_lnk' => 'Suosikkini',
	'memberlist_title' => 'K�ytt�j�lista', //cpg1.3.0
	'memberlist_lnk' => 'N�yt� k�ytt�j�lista', //cpg1.3.0
	'faq_title' => 'Usein kysytyt kysymykset', //cpg1.3.0
	'faq_lnk' => 'FAQ', //cpg1.3.0
);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => 'Tarkistettavat',
	'config_lnk' => 'Asetukset',
	'albums_lnk' => 'Albumit',
	'categories_lnk' => 'Kategoriat',
	'users_lnk' => 'K�ytt�j�t',
	'groups_lnk' => 'Ryhm�t',
	'comments_lnk' => 'Kommentit',
	'searchnew_lnk' => 'Lis�� kuvia',
	'util_lnk' => 'K�sittele kuvia',
	'ban_lnk' => 'Bannaa k�ytt�ji�',
	'db_ecard_lnk' => 'N�yt� e-kortit', //cpg1.3.0
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => 'Luo / muokkaa albumeita.',
	'modifyalb_lnk' => 'Muokkaa omaa albumia.',
	'my_prof_lnk' => 'Omat asetukset',
);

$lang_cat_list = array(
	'category' => 'Kategoria',
	'albums' => 'Albumit',
	'pictures' => 'Kuvat', //cpg1.3.0
);

$lang_album_list = array(
	'album_on_page' => '%d albumia %d sivu(a)'
);

//J�rjest� tiedoston nimen ja p�iv�m��r�n mukaan
$lang_thumb_view = array(
	'date' => 'P�iv�m��r�',
	'name' => 'Nimi', 
	'title' => 'Otsikko', 
	'sort_da' => 'J�rjest� p�iv�m��ritt�in nousevasti',
	'sort_dd' => 'J�rjest� p�iv�m��ritt�in laskevasti',
	'sort_na' => 'J�rjest� nimell� nousevasti',
	'sort_nd' => 'J�rjest� nimell� laskevasti',
	'sort_ta' => 'J�rjest� otsikolla nousevasti', 
	'sort_td' => 'J�rjest� otsikolla laskevasti',
	'download_zip' => 'Lataa Zip-tiedostona', //cpg1.3.0
	'pic_on_page' => '%d kuvaa %d sivu(a)',
	'user_on_page' => '%d k�ytt�j�� %d sivu(a)' //cpg1.3.0
);

$lang_img_nav_bar = array(
	'thumb_title' => 'Takaisin thumbnail-sivulle',
	'pic_info_title' => 'N�yt�/piilota kuvan tiedot',
	'slideshow_title' => 'Diashow',
	'ecard_title' => 'L�het� t�m� kuva e-korttina.',
	'ecard_disabled' => 'E-kortit pois p��lt�.',
	'ecard_disabled_msg' => 'Sinulla ei ole oikeutta l�hett�� e-kortteja.',
	'prev_title' => 'N�yt� edellinen kuva',
	'next_title' => 'N�yt� seuraava kuva',
	'pic_pos' => 'Kuva %s/%s',
);

$lang_rate_pic = array(
	'rate_this_pic' => '��nest� t�t� kuvaa ',
	'no_votes' => '(ei ��ni� viel�)',
	'rating' => '(nykyinen taso : %s / 5 ja %s ��nt�)',
	'rubbish' => 'T�ytt� roskaa',
	'poor' => 'Melko huono',
	'fair' => 'Keskitasoa',
	'good' => 'Hyv�',
	'excellent' => 'Loistava',
	'great' => 'Aivan uskomaton',
);

// ------------------------------------------------------------------------- //
// Tiedosto include/exif.inc.php                                             //
// ------------------------------------------------------------------------- //

// tyhj�

// ------------------------------------------------------------------------- //
// Tiedosto include/functions.inc.php                                        //
// ------------------------------------------------------------------------- //

$lang_cpg_die = array(
	INFORMATION => $lang_info,
	ERROR => $lang_error,
	CRITICAL_ERROR => 'Kriittinen virhe',
	'file' => 'Tiedosto: ',
	'line' => 'Rivi: ',
);

$lang_display_thumbnails = array(
	'filename' => 'Tiedoston nimi : ',
	'filesize' => 'Tiedoston koko : ',
	'dimensions' => 'Tarkkuus : ',
	'date_added' => 'Lis�tty : '
);

$lang_get_pic_data = array(
	'n_comments' => '%s kommenttia',
	'n_views' => '%s tarkastelua',
	'n_votes' => '(%s ��nt�)'
);

$lang_cpg_debug_output = array(
	'debug_info' => 'Virheilmoitus', //cpg1.3.0
	'select_all' => 'Valitse kaikki', //cpg1.3.0
	'copy_and_paste_instructions' => 'Jos aiot pyyt�� apua Copperminen foorumeilta, liit� t�m� virheinfo viestiisi. Muista korvata salasanat t�hdill� (*) ennen kuin l�het�t viestin.', //cpg1.3.0
	'phpinfo' => 'N�yt� phpinfo', //cpg1.3.0
);

$lang_language_selection = array(
	'reset_language' => 'Alkuper�iset kieliasetukset', //cpg1.3.0
	'choose_language' => 'Valitse kieli', //cpg1.3.0
);

$lang_theme_selection = array(
	'reset_theme' => 'Alkuper�inen ulkoasu', //cpg1.3.0
	'choose_theme' => 'Valitse ulkoasu', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// Tiedosto include/init.inc.php                                             //
// ------------------------------------------------------------------------- //

// tyhj�

// ------------------------------------------------------------------------- //
// Tiedosto include/picmgmt.inc.php                                          //
// ------------------------------------------------------------------------- //

// tyhj�

// ------------------------------------------------------------------------- //
// Tiedosto include/smilies.inc.php                                          //
// ------------------------------------------------------------------------- //

if (defined('SMILIES_PHP')) $lang_smilies_inc_php = array(
	'Exclamation' => 'Huuto',
	'Question' => 'Kysymys',
	'Very Happy' => 'Eritt�in Iloinen',
	'Smile' => 'Hymy',
	'Sad' => 'Suru',
	'Surprised' => 'Yll�ttynyt',
	'Shocked' => 'J�rkyttynyt',
	'Confused' => 'H�keltynyt',
	'Cool' => 'Cool',
	'Laughing' => 'Nauru',
	'Mad' => 'Hullu',
	'Razz' => 'Razz',
	'Embarassed' => 'Embarassed',
	'Crying or Very sad' => 'Itke�',
	'Evil or Very Mad' => 'Eritt�in Hullu',
	'Twisted Evil' => 'Kieroutunut Hullu',
	'Rolling Eyes' => 'Py�riv�t silm�t',
	'Wink' => 'Vink',
	'Idea' => 'Idea',
	'Arrow' => 'Nuoli',
	'Neutral' => 'Neutraali',
	'Mr. Green' => 'Mr. Vihre�',
);

// ------------------------------------------------------------------------- //
// Tiedosto addpic.php                                                       //
// ------------------------------------------------------------------------- //

// tyhj�

// ------------------------------------------------------------------------- //
// Tiedosto admin.php                                                        //
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
	0 => 'Poistuu yll�pitotilasta.',
	1 => 'Siirtyy yll�pitotilaan.',
);

// ------------------------------------------------------------------------- //
// Tiedosto albmgr.php                                                       //
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => 'Albumi tarvitsee nimen !',
	'confirm_modifs' => 'Haluatko varmasti tehd� n�m� muutokset?',
	'no_change' => 'Et tehnyt yht��n muutosta!',
	'new_album' => 'Uusi albumi',
	'confirm_delete1' => 'Haluatko varmasti poistaa t�m�n albumin?',
	'confirm_delete2' => '\nKaikki kuvat ja kommentit tulevat poistumaan!',
	'select_first' => 'Valitse albumi ensin',
	'alb_mrg' => 'Albumien k�sittely',
	'my_gallery' => '* Oma galleria *',
	'no_category' => '* Ei kategoriaa *',
	'delete' => 'Poista',
	'new' => 'Uusi',
	'apply_modifs' => 'Hyv�ksy muutokset',
	'select_category' => 'Valitse kategoria',
);

// ------------------------------------------------------------------------- //
// Tiedosto catmgr.php                                                       //
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => 'Toimintoa \'%s\'ei voitu suorittaa.',
	'unknown_cat' => 'Valittua kategoriaa ei ole en�� tietokannassa.',
	'usergal_cat_ro' => 'K�ytt�jien gallerioiden kategorioita ei voi poistaa!',
	'manage_cat' => 'Hallitse kategorioita',
	'confirm_delete' => 'Haluatko varmasti poistaa t�m�n kategorian?',
	'category' => 'Kategoria',
	'operations' => 'Toiminnot',
	'move_into' => 'Siirr�',
	'update_create' => 'P�ivit�/Luo kategoria',
	'parent_cat' => 'P��kategoria',
	'cat_title' => 'Kategorian otsikko',
        'cat_thumb' => 'Kategorian thumbnail', //cpg1.3.0
	'cat_desc' => 'Kategorian tarkenne'
);

// ------------------------------------------------------------------------- //
// Tiedosto config.php                                                       //
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => 'Asetukset',
	'restore_cfg' => 'Palauta oletukset',
	'save_cfg' => 'Tallenna muutokset',
	'notes' => 'Huomio',
	'info' => 'Info',
	'upd_success' => 'Gallerian asetukset p�ivitetty',
	'restore_success' => 'Gallerian oletusasetukset palautettu',
	'name_a' => 'Nimi nousevasti',
	'name_d' => 'Nimi laskevasti',
	'title_a' => 'Otsikko nousevasti', 
        'title_d' => 'Otsikko laskevasti',
	'date_a' => 'P�iv� nousevasti',
	'date_d' => 'P�iv� laskevasti',
        'th_any' => 'Max Aspect',
        'th_ht' => 'Korkeus',
        'th_wd' => 'Leveys',
        'label' => 'otsikko', //cpg1.3.0
        'item' => 'linkki', //cpg1.3.0
        'debug_everyone' => 'Kaikki', //cpg1.3.0
        'debug_admin' => 'Vain yll�pit�j�', //cpg1.3.0
        );

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'Yleiset asetukset',
	array('Gallerian nimi', 'gallery_name', 0),
	array('Gallerian tarkenne', 'gallery_description', 0),
	array('Gallerian yll�pit�j�n s�hk�posti', 'gallery_admin_email', 0),
	array('Kohdeosoite \'N�yt� enemm�n kuvia\' -linkiss� e-korteissa', 'ecards_more_pic_target', 0),
        array('Galleria on offline-tilassa', 'offline', 1), //cpg1.3.0
        array('Salli e-kortit', 'log_ecards', 1), //cpg1.3.0
        array('Salli Zip-tiedostot', 'enable_zipdownload', 1), //cpg1.3.0

  'Kieli, teema &amp; merkist�',
	array('Kieli', 'lang', 5),
	array('Teema', 'theme', 6),
        array('N�yt� lista kielist�', 'language_list', 8), //cpg1.3.0
        array('N�yt� kieli� vastaavat liput', 'language_flags', 8), //cpg1.3.0
        array('N�yt� &quot;oletusasetus&quot; kielivalinnassa', 'language_reset', 1), //cpg1.3.0
        array('N�yt� lista teemoista', 'theme_list', 8), //cpg1.3.0
        array('N�yt� &quot;oletusasetus&quot; teemavalinnassa', 'theme_reset', 1), //cpg1.3.0
        array('N�yt� FAQ', 'display_faq', 1), //cpg1.3.0
        array('N�yt� apua bb-koodin k�ytt��n ', 'show_bbcode_help', 1), //cpg1.3.0
        array('Merkist�', 'charset', 4), //cpg1.3.0

  'Albumin n�ytt�asetukset',
	array('P��taulukon leveys (pikseleiss� tai %)', 'main_table_width', 0),
	array('Kuinka monta kategoriaa n�ytet��n tasolla', 'subcat_level', 0),
	array('Kuinka monta albumia n�ytet��n sivulla', 'albums_per_page', 0),
	array('Kuinka monta saraketta n�ytet��n albumilistassa', 'album_list_cols', 0),
	array('Thumbnailien koko pikseleiss�', 'alb_list_thumb_size', 0),
	array('Mit� tietoja etusivulla n�ytet��n', 'main_page_layout', 0),
	array('N�yt� ensimm�isen tason albumin thumbnailit kategoriassa','first_level',1),

  'Thumbnailien n�ytt�',
	array('Sarakkeita thumbnail-sivulla', 'thumbcols', 0),
	array('Rivej� thumbnail sivulla', 'thumbrows', 0),
	array('Kaistaleiden maksimim��r�', 'max_tabs', 10), //cpg1.3.0
	array('N�yt� kuvateksti thumbnaileissa', 'caption_in_thumbview', 1), //cpg1.3.0
        array('N�yt� katselukertojen m��r� thumbnailin alla', 'views_in_thumbview', 1), //cpg1.3.0
	array('N�yt� kommenttien m��r� thumbnaileissa', 'display_comment_count', 1),
        array('N�yt� tiedoston siirt�j�n nimi kuvan alla', 'display_uploader', 1), //cpg1.3.0
	array('Kuvien oletusj�rjestys', 'default_sort_order', 3), //cpg1.3.0
	array('Tarvittavien ��nien m��r� ennen suosituimmat-listalle p��sy�', 'min_votes_for_rating', 0), //cpg1.3.0

  'Kuvien n�ytt�- &amp; kommenttiasetukset',
	array('Kuvan n�ytt� taulukon leveys (pikselein� tai %)', 'picture_table_width', 0), //cpg1.3.0
	array('Kuvan tiedot oletuksena n�kyviss�', 'display_pic_info', 1), //cpg1.3.0
	array('Kirosanafiltteri', 'filter_bad_words', 1),
	array('Hyv�ksy hymi�t kommentissa', 'enable_smilies', 1),
        array('Salli useita kommentteja samaan kuvaan samalta k�ytt�j�lt� (flood-suojaus pois k�yt�st�)', 'disable_comment_flood_protect', 1), //cpg1.3.0
	array('Kuvatekstin maksimipituus', 'max_img_desc_length', 0),
	array('Maksimim��r� merkkej� sanassa', 'max_com_wlength', 0),
	array('Kommenttirivien maksimim��r�', 'max_com_lines', 0),
	array('Kommentin maksimipituus', 'max_com_size', 0),
	array('N�yt� thumbnaileja kuvasivulla', 'display_film_strip', 1), 
        array('Thumbnaileja kuvasivulla', 'max_film_strip_items', 0),
        array('Ilmoita kommenteista yll�pit�j�lle s�hk�postilla', 'email_comment_notification', 1), //cpg1.3.0
        array('Kuvien v�li diaesityksess� millisekunteina (1 sekunti = 1000 millisekuntia)', 'slideshow_interval', 0), //cpg1.3.0

  'Kuvien ja thumbnailien asetukset', //cpg1.3.0
	array('Tarkkuus JPEG -tiedostoilla', 'jpeg_qual', 0),
	array('Thumbnailin maksimileveys tai -korkeus <a href="#notice2" class="clickable_option">**</a>', 'thumb_width', 0), //cpg1.3.0
        array('K�yt� mittaa ( leveys tai korkeus tai maksimimitta thumbnaileissa )<b>**</b>', 'thumb_use', 7),
	array('Luo normaalikokoiset kuvat','make_intermediate',1),
	array('V�liaikaisten kuvien maksimileveys tai -korkeus <a href="#notice2" class="clickable_option">**</a>', 'picture_width', 0), //cpg1.3.0
	array('Ladattavien kuvien maksimikoko (KB)', 'max_upl_size', 0), //cpg1.3.0
	array('Ladattavien kuvien maksimileveys tai -korkeus (pikselein�)', 'max_upl_width_height', 0), //cpg1.3.0

  'Tiedostojen ja thumbnailien edistyneemm�t asetukset', //cpg1.3.0
        array('N�yt� yksityisen albumien ikoni kirjautumattomalle k�ytt�j�lle','show_private',1), //cpg1.3.0
        array('Merkit, joita ei saa k�ytt�� tiedostonimiss�', 'forbiden_fname_char',0), //cpg1.3.0
      //array('Sallitut tiedostomuodot siirretyiss� kuvissa', 'allowed_file_extensions',0), //cpg1.3.0
        array('Sallitut kuvatiedostot', 'allowed_img_types',0), //cpg1.3.0
        array('Sallitut videotiedostot', 'allowed_mov_types',0), //cpg1.3.0
        array('Sallitut ��nitiedostot', 'allowed_snd_types',0), //cpg1.3.0
        array('Sallitut dokumenttitiedostot', 'allowed_doc_types',0), //cpg1.3.0
        array('Kuvien koon muuttamisessa k�ytetty systeemi','thumb_method',2), //cpg1.3.0
        array('T�ydellinen polku ImageMagick -ohjelmistoon (esim. /usr/bin/X11/)', 'impath', 0), //cpg1.3.0
      //array('Sallitut kuvatyypit (k�yt�ss� vain ImageMagick-ohjelman kanssa)', 'allowed_img_types',0), //cpg1.3.0
        array('ImageMagickin komentorivin asetukset', 'im_options', 0), //cpg1.3.0
        array('Lue EXIF-tietoa JPEG-tiedostoista', 'read_exif_data', 1), //cpg1.3.0
        array('Lue IPTC-tietoa JPEG-tiedostoista', 'read_iptc_data', 1), //cpg1.3.0
        array('Albumien hakemisto <a href="#notice1" class="clickable_option">*</a>', 'fullpath', 0), //cpg1.3.0
        array('Kuvien hakemisto <a href="#notice1" class="clickable_option">*</a>', 'userpics', 0), //cpg1.3.0
        array('Normaalikokoisten kuvien etuliite <a href="#notice1" class="clickable_option">*</a>', 'normal_pfx', 0), //cpg1.3.0
        array('Thumbnailien etuliite <a href="#notice1" class="clickable_option">*</a>', 'thumb_pfx', 0), //cpg1.3.0
        array('Hakemistojen oletusoikeudet', 'default_dir_mode', 0), //cpg1.3.0
        array('Tiedostojen oletusoikeudet', 'default_file_mode', 0), //cpg1.3.0

  'K�ytt�j�asetukset',
        array('Salli uusien k�ytt�jien rekister�ity�', 'allow_user_registration', 1),
	array('Rekister�inti vaatii s�hk�postivarmistuksen', 'reg_requires_valid_email', 1),
        array('Ilmoita yll�pit�j�lle s�hk�postilla uudesta rekister�itymisest�', 'reg_notify_admin_email', 1), //cpg1.3.0
	array('Salli kahdelle k�ytt�j�lle sama s�hk�postiosoite', 'allow_duplicate_emails_addr', 1),
	array('K�ytt�j�t saavat yksityiset albumit (Huom! Jos kiell�t yksityiset albumit, kaikista yksityisist� albumeista tulee julkisia)', 'allow_private_albums', 1), //cpg1.3.0
        array('Ilmoita yll�pidolle jos k�ytt�j�n suorittama kuvan siirto odottaa hyv�ksynt��', 'upl_notify_admin_email', 1), //cpg1.3.0
        array('Salli kirjautuneiden k�ytt�jien tarkastella k�ytt�j�listaa', 'allow_memberlist', 1), //cpg1.3.0

  'Valinnaiset kent�t kuvan n�yt�ss� (j�t� tyhj�ksi jos et halua k�ytt��))',
	array('Kent�n 1 nimi', 'user_field1_name', 0),
	array('Kent�n 2 nimi', 'user_field2_name', 0),
	array('Kent�n 3 nimi', 'user_field3_name', 0),
	array('Kent�n 4 nimi', 'user_field4_name', 0),

  'Ev�steet',
        array('Ev�steen nimi (kun k�yt�t galleriaa foorumin yhteydess�, varmista ett� gallerian ev�ste on eri niminen kuin foorumin)', 'cookie_name', 0),
	array('Ev�steen polku', 'cookie_path', 0),

  'Muut asetukset',
        array('Siirry debug-tilaan', 'debug_mode', 9), //cpg1.3.0
        array('N�yt� ilmoitukset debug-tilassa', 'debug_notice', 1), //cpg1.3.0

  '<br /><div align="left"><a name="notice1"></a>(*) N�it� asetuksia ei tulisi muuttaa, jos kuvia tai muita tiedostoja on jo lis�tty.<br />
  <a name="notice2"></a>(**) Kun n�it� asetuksia muutetaan, ne alkavat vaikuttaa tiedostoihin vasta vaihtamisen j�lkeen. Siksi on suositeltavaa ettei n�it� asetuksia muutettaisi jos galleriassa on jo tiedostoja. Jo albumissa olevia tiedostoja voidaan kuitenkin muuttaa k�ytt�m�ll�  &quot;<a href="util.php">k�sittele kuvia</a>&quot; -toimintoa yll�pidon valikosta.</div><br />', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// Tiedosto db_ecard.php //cpg1.3.0                                          //
// ------------------------------------------------------------------------- //

if (defined('DB_ECARD_PHP')) $lang_db_ecard_php = array(
        'title' => 'L�hetetyt e-kortit', //cpg1.3.0
        'ecard_sender' => 'L�hett�j�', //cpg1.3.0
        'ecard_recipient' => 'Vastaanottaja', //cpg1.3.0
        'ecard_date' => 'P�iv�ys', //cpg1.3.0
        'ecard_display' => 'N�yt� e-kortit', //cpg1.3.0
        'ecard_name' => 'Nimi', //cpg1.3.0
        'ecard_email' => 'S�hk�posti', //cpg1.3.0
        'ecard_ip' => 'IP #', //cpg1.3.0
        'ecard_ascending' => 'nouseva j�rjestys', //cpg1.3.0
        'ecard_descending' => 'laskeva j�rjestys', //cpg1.3.0
        'ecard_sorted' => 'J�rjestetty', //cpg1.3.0
        'ecard_by_date' => 'p�iv�m��r�n mukaan', //cpg1.3.0
        'ecard_by_sender_name' => 'l�hett�j�n nimen mukaan', //cpg1.3.0
        'ecard_by_sender_email' => 'l�hett�j�n s�hk�postin mukaan', //cpg1.3.0
        'ecard_by_sender_ip' => 'l�hett�j�n IP:n mukaan', //cpg1.3.0
        'ecard_by_recipient_name' => 'vastaanottajan nimen mukaan', //cpg1.3.0
        'ecard_by_recipient_email' => 'vastaanottajan s�hk�postin mukaan', //cpg1.3.0
        'ecard_number' => 'N�ytt�� kohteet %s - %s. Yhteens� kohteita %s', //cpg1.3.0
        'ecard_goto_page' => 'Siirry sivulle', //cpg1.3.0
        'ecard_records_per_page' => 'Kohteita sivulla', //cpg1.3.0
        'check_all' => 'Valitse kaikki', //cpg1.3.0
        'uncheck_all' => 'Poista valinta kaikista', //cpg1.3.0
        'ecards_delete_selected' => 'Poista valitut', //cpg1.3.0
        'ecards_delete_confirm' => 'Haluatko varmasti poistaa kaikki? Klikkaa ruksi valintaruutuun!', //cpg1.3.0
        'ecards_delete_sure' => 'Olen varma', //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// Tiedosto db_input.php                                                     //
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
        'empty_name_or_com' => 'Nimi ja kommentti ovat pakolliset',
        'com_added' => 'Kommentti lis�tty',
        'alb_need_title' => 'Albumille tarvitsee lis�t� otsikko!',
        'no_udp_needed' => 'P�ivityst� ei tarvita',
        'alb_updated' => 'Albumi p�ivitetty',
        'unknown_album' => 'Valittua albumia ei ole tai sinulla ei ole oikeutta lis�t� siihen kuvaa',
        'no_pic_uploaded' => 'Tiedostoa ei lis�tty!<br /><br />Jos olet valinnut tiedoston lis�tt�v�ksi, varmista ett� serveri sallii tiedostojen lis��misen...', //cpg1.3.0
        'err_mkdir' => 'Tiedoston %s luominen ep�onnistui!',
        'dest_dir_ro' => 'Skripti ei pysty kirjoittamaan kohdekansioon %s!',
        'err_move' => 'Tiedoston %s siirt�minen kansioon %s on mahdotonta!',
        'err_fsize_too_large' => 'Tiedoston koko on liian suuri (suurin sallittu koko on is %s x %s)', //cpg1.3.0
        'err_imgsize_too_large' => 'Tiedoston koko on liian suuri (suurin sallittu on %s KB) !',
        'err_invalid_img' => 'Siirt�m�si tiedosto ei ole p�tev� kuvatiedosto!',
        'allowed_img_types' => 'Voi siirt�� vain %s kuvaa.',
        'err_insert_pic' => 'Tiedostoa \'%s\' ei voida laittaa albumiin', //cpg1.3.0
        'upload_success' => 'Tiedoston siirto onnistui<br /><br />Se tulee n�kyviin yll�pidon hyv�ksynn�n j�lkeen.', //cpg1.3.0
        'notify_admin_email_subject' => '%s - Ilmoitus kuvansiirrosta', //cpg1.3.0
        'notify_admin_email_body' => '%s on siirt�nyt kuvan, joka pit�� hyv�ksy�. Siirry osoitteeseen %s', //cpg1.3.0
        'info' => 'Tiedot',
        'com_added' => 'Kommentti lis�tty',
        'alb_updated' => 'Albumi lis�tty',
        'err_comment_empty' => 'Kommenttirivi on tyhj�!',
        'err_invalid_fext' => 'Vain seuraavat tiedostomuodot ovat hyv�ksyttyj�: <br /><br />%s.',
        'no_flood' => 'Olet lis�nnyt viimeisen kommentin t�h�n kuvaan.<br /><br />Muokkaa edellist� kommenttia jos haluat lis�t� jotain', //cpg1.3.0
        'redirect_msg' => 'Sinut uudelleenohjataan.<br /><br /><br />Paina \'Jatka\' jos sivu ei p�ivity itsest��n',
        'upl_success' => 'Tiedosto on lis�tty onnistuneesti', //cpg1.3.0
        'email_comment_subject' => 'Kommentti lis�tty Coppermine-valokuvagalleriaan', //cpg1.3.0
        'email_comment_body' => 'Galleriaasi on lis�tty kommentti. Lue se osoitteessa', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// Tiedosto delete.php                                                       //
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
        'caption' => 'Caption',
        'fs_pic' => 't�ysikokoinen kuva',
        'del_success' => 'poistettu onnistuneesti',
        'ns_pic' => 'normaalikokoinen kuva',
        'err_del' => 'ei voida poistaa',
        'thumb_pic' => 'thumbnail',
        'comment' => 'kommentti',
        'im_in_alb' => 'kuva albumissa',
        'alb_del_success' => 'Albumi \'%s\' poistettu',
        'alb_mgr' => 'Albumihallinta',
        'err_invalid_data' => 'Puutteellista tietoa saatu kohteesta \'%s\'',
        'create_alb' => 'Luo albumia \'%s\'',
        'update_alb' => 'P�vitt�� albumia \'%s\'. Ostikko  \'%s\' ja tunnus \'%s\'',
        'del_pic' => 'Poista tiedosto', //cpg1.3.0
        'del_alb' => 'Poista albumi',
        'del_user' => 'Poista k�ytt�j�',
        'err_unknown_user' => 'Valittua k�ytt�j�� ei ole olemassa!',
        'comment_deleted' => 'Kommentti poistettu onnistuneesti',
);

// ------------------------------------------------------------------------- //
// Tiedosto displayecard.php                                                 //
// ------------------------------------------------------------------------- //

// tyhj�

// ------------------------------------------------------------------------- //
// Tiedosto displayimage.php                                                 //
// ------------------------------------------------------------------------- //

if (defined('DISPLAYIMAGE_PHP')){

$lang_display_image_php = array(
        'confirm_del' => 'Oletko varma ett� halaut poistaa t�m�n tiedoston? \\nKommentit tulevat my�s poistumaan', //js-alert //cpg1.3.0
        'del_pic' => 'Poista tiedosto', //cpg1.3.0
        'size' => '%s x %s pikseli�',
        'views' => '%s kertaa',
        'slideshow' => 'Diaesitys',
        'stop_slideshow' => 'Pys�yt� diaesitys',
        'view_fs' => 'Klikkaa n�hd�ksesi kuvan oikeassa koossa',
        'edit_pic' => 'Muuta tietoja', //cpg1.3.0
        'crop_pic' => 'Muokkaa ja k��nn�', //cpg1.3.0
);

$lang_picinfo = array(
        'title' =>'Tiedoston tiedot', //cpg1.3.0
        'Filename' => 'Tiedoston nimi',
        'Album name' => 'Albumin nimi',
        'Rating' => 'Arvostelu (%s ��nt�)',
        'Keywords' => 'Hakusanat',
        'File Size' => 'Koko',
        'Dimensions' => 'Mitat',
        'Displayed' => 'Katsottu',
        'Camera' => 'Kamera',
        'Date taken' => 'Kuvan p�iv�ys',
  	'Aperture' => 'Aukko',
  	'Exposure time' => 'Valotusaika',
  	'Focal length' => 'Polttov�li',
        'Comment' => 'Kommentti',
        'addFav'=>'Lis�� suosikkeihin', //cpg1.3.0
        'addFavPhrase'=>'Suosikit', //cpg1.3.0
        'remFav'=>'Poista suosikeista', //cpg1.3.0
        'iptcTitle'=>'IPTC Otsikko', //cpg1.3.0
        'iptcCopyright'=>'IPTC copyright', //cpg1.3.0
        'iptcKeywords'=>'IPTC hakusanat', //cpg1.3.0
        'iptcCategory'=>'IPTC kategoria', //cpg1.3.0
        'iptcSubCategories'=>'IPTC Alakategoriat', //cpg1.3.0
);

$lang_display_comments = array(
        'OK' => 'OK',
        'edit_title' => 'Muokkaa kommenttia',
        'confirm_delete' => 'Haluatko varmasti poistaa kommentin?', //js-alert
        'add_your_comment' => 'Lis�� kommentti',
        'name' => 'Nimi',
        'comment' => 'Kommentti',
	'your_name' => 'Anonyymi',
);

$lang_fullsize_popup = array(
        'click_to_close' => 'Klikkaa kuvaa sulkeaksesi t�m�n ikkunan',
);

}

// ------------------------------------------------------------------------- //
// Tiedosto ecard.php                                                        //
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php = array(
        'title' => 'L�het� e-kortti',
        'invalid_email' => '<b>Varoitus</b> : Kelpaamaton s�hk�postiosoite!',
        'ecard_title' => '%s on l�hett�nyt sinulle e-kortin',
        'error_not_image' => 'Vain kuvia voi l�hett�� e-korttina', //cpg1.3.0
        'view_ecard' => 'Jos e-kortti ei n�y oikein, klikkaa t�t� linkki�',
        'view_more_pics' => 'Klikkaa t�t� linkki� n�hd�ksesi lis�� kuvia!',
        'send_success' => 'E-kortin l�hetys onnistui',
        'send_failed' => 'E-korttiasi ei jostain syyst� voitu l�hett�� oikein...',
        'from' => 'L�hett�j�',
        'your_name' => 'Nimi',
        'your_email' => 'S�hk�postiosoite',
        'to' => 'Vastaanottaja',
        'rcpt_name' => 'Nimi',
        'rcpt_email' => 'S�hk�postiosoite',
        'greetings' => 'Tervehdys',
        'message' => 'Viesti',
);

// ------------------------------------------------------------------------- //
// Tiedosto editpics.php                                                     //
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
        'pic_info' => 'Tiedot', //cpg1.3.0
        'album' => 'Albumi',
        'title' => 'Otsikko',
        'desc' => 'Kuvaus',
        'keywords' => 'Hakusanat',
        'pic_info_str' => '%s &times; %s - %s KB - katsottu %s kertaa - %s ��nt�',
        'approve' => 'Hyv�ksy tiedosto', //cpg1.3.0
        'postpone_app' => 'Siirr� hyv�ksyminen my�hemm�ksi',
        'del_pic' => 'Poista tiedosto', //cpg1.3.0
        'read_exif' => 'Lue EXIF uudelleen', //cpg1.3.0
        'reset_view_count' => 'Nollaa katsojalaskuri',
        'reset_votes' => 'Nollaa ��nestys',
        'del_comm' => 'Poista kommentit',
        'upl_approval' => 'Upload approval',
        'edit_pics' => 'Muokkaa tiedostoja', //cpg1.3.0
        'see_next' => 'Katsele seuraavia tiedostoja', //cpg1.3.0
        'see_prev' => 'Ketsele edellisi� tiedostoja', //cpg1.3.0
        'n_pic' => '%s tiedostoa', //cpg1.3.0
        'n_of_pic_to_disp' => 'N�ytett�vi� tiedostoja', //cpg1.3.0
        'apply' => 'Hyv�ksy muutokset', //cpg1.3.0
        'crop_title' => 'Coppermine kuvaeditori', //cpg1.3.0
        'preview' => 'Esikatselu', //cpg1.3.0
        'save' => 'Tallenna kuva', //cpg1.3.0
        'save_thumb' =>'Tallenna thumbnailina', //cpg1.3.0
        'sel_on_img' =>'Valinnan on oltava kokonaan kuvassa!', //js-alert //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// Tiedosto faq.php //cpg1.3.0                                               //
// ------------------------------------------------------------------------- //

if (defined('FAQ_PHP')) $lang_faq_php = array(
        'faq' => 'Usein kysytyt kysymykset', //cpg1.3.0
        'toc' => 'Sis�llysluettelo', //cpg1.3.0
        'question' => 'Kysymys: ', //cpg1.3.0
        'answer' => 'Vastaus: ', //cpg1.3.0
);

if (defined('FAQ_PHP')) $lang_faq_data = array(
  'Yleinen FAQ', //cpg1.3.0
        array('Miksi minun pit�� rekister�ity�?', 'Yll�pito ei v�ltt�m�tt� vaadi rekister�itymist�. Rekister�ityminen antaa j�senelle lis�� mahdollisuuksia k�ytt�� galleriaa, kuten esimerkiksi kuvien siirto, omien albumien luonti, suosikkilista, kuvien arvostelu ja kommenttien lis��minen jne.', 'allow_user_registration', '0'), //cpg1.3.0
        array('Miten voin rekister�ity�?', 'Paina linkki� &quot;Rekister�idy&quot; ja t�yt� vaadittavat kent�t (ja valinnaiset jos haluat).<br />Yll�pito voi vaatia s�hk�postivarmistuksen rekister�itymisen yhteydess�. T�ll�in saat rekister�itymisen j�lkeen gallerian l�hett�m�n s�hk�postiviestin antamaasi s�hk�postiosoitteeseen. Viesti antaa ohjeet tunnuksen aktivointiin. Tunnus pit�� aktivoida ennen sis��nkirjautumista.', 'allow_user_registration', '1'), //cpg1.3.0
        array('Miten kirjaudun sis��n?', 'Paina linkki� &quot;Kirjaudu&quot; ja t�yt� k�ytt�j�nimesi ja salasanasi niille varattuihin kenttiin. &quot;Muista minut&quot; -kohtaan laittamalla rastin galleria muistaa sinut kun seuraavan kerran tulet sivulle, eik� sinun tarvitse en�� kirjautua sis��n.<br /><b>HUOM: Ev�steiden pit�� olla p��ll� ja sivun asettamia ev�steit� ei saa poistaa mik�li haluat k�ytt�� &quot;Muista minut&quot; -toimintoa.</b>', 'offline', 0), //cpg1.3.0
        array('Miksi en voi kirjautua sis��n?', 'Oletko rekister�itynyt ja klikannut linkki� joka l�hetettiin s�hk�postiisi?. Linkki aktivoi tilisi. Jos ongelmia on edelleen, ota yhteys gallerian yll�pitoon.', 'offline', 0), //cpg1.3.0
        array('Unohdin salasanani. Mit� teen?', 'Jos sivuilla on k�yt�ss� &quot;Unohdin salasanani&quot; -linkki, k�yt� sit�. Muussa tapauksessa ota yhteytt� gallerian yll�pitoon.', 'offline', 0), //cpg1.3.0
      //array('Mit� teen kun s�hk�postiosoitteeni on vaihtunut?', 'Yksinkertaisesti vain kirjaudu sis��n ja vaihda s�hk�postiosoitteesi &quot;Profile&quot;', 'offline', 0), //cpg1.3.0
        array('Miten tallennan kuvan &quot;Omat suosikkini&quot; -kansioon?', 'Klikkaa kuvaa ja valitse linkki &quot;kuvan tiedot&quot; (<img src="images/info.gif" width="16" height="16" border="0" alt="Picture information" />); siirry sivun alalaitaan ja klikkaa linkki� &quot;Lis�� suosikkeihin&quot;.<br />Yll�pito on voinut laittaa oletusasetuksesi kuvan tietojen n�kymisen &quot;kuvan tiedot&quot; -kohdassa.<br />HUOM: Ev�steiden pit�� olla p��ll� ja sivun asettamia ev�steit� ei saa poistaa.', 'offline', 0), //cpg1.3.0
        array('Miten voin ��nest�� kuvaa?', 'Klikkaa kuvan thumbnailia, mene sivun alalaitaan ja valitse haluamasi ��nestysvaihtoehto.', 'offline', 0), //cpg1.3.0
        array('Miten voin kommentoida kuvaa?', 'Klikkaa kuvan thumbnailia, mene sivun alalaitaan ja kirjoita kommenttisi.', 'offline', 0), //cpg1.3.0
        array('Miten siirr�n kuvan galleriaan?', 'Mene &quot;Lis�� kuva&quot; -osioon ja valitse albumi johon haluat siirt�� kuvan, valitse &quot;Selaa&quot; ja etsi kuvat jotka haluat siirt��. Valitse sitten &quot;avaa&quot; (lis�� otsikko ja kuvaus jos haluat) ja klikkaa &quot;L�het�&quot;.', 'allow_private_albums', 0), //cpg1.3.0
        array('Minne voin siirt�� kuvani?', 'Voit siirt�� kuvasi haluamaasi albumiin &quot;Omassa galleriassa&quot;. Yll�pito on voinut my�s sallia kuvien siirt�misen my�s albumeihin jotka ovat Yleisesss� galleriassa.', 'allow_private_albums', 0), //cpg1.3.0
        array('Kuinka suuria tiedostoja voin siirt�� ja mit� tiedostomuotoja?', 'Koko ja tiedostomuodot (jpg, png, jne.) riippuvat yll�pit�j�st�.', 'offline', 0), //cpg1.3.0
        array('Mik� on &quot;Oma galleria&quot;?', '&quot;Oma galleria&quot; on k�ytt�j�n henkil�kohtainen galleria jonne k�ytt�j� voi siirt�� kuvia ja hallita.', 'allow_private_albums', 0), //cpg1.3.0
        array('Miten luon, nime�n uudelleen tai poistan albuminen &quot;Omassa galleriassa&quot;?', 'Sinun pit�� olla &quot;Yll�pitotilassa&quot;.<br />Mene kohtaan &quot;Luo / Muokkaa albumeita&quot; ja klikkaa &quot;Uusi&quot;. Albumin oletuksena nimi on &quot;Uusi albumi&quot;, jonka voit vaihtaa haluamaksesi nimeksi.<br />Voit my�s nimet� uudelleen mink� tahansa albumin omassa galleriassasi.<br />Klikkaa &quot;Hyv�ksy muutokset&quot; jolloin tekem�si muutokset tulevat voimaan.', 'allow_private_albums', 0), //cpg1.3.0
        array('Miten voin muokata k�ytt�jien oikeuksia omassa galleriassa?', 'Sinun pit�� olla &quot;Yll�pitotilassa&quot;.<br />Mene kohtaan &quot;Muokkaa omia albumeita&quot;.  &quot;Update Album&quot; bar, select the album that you want to modify.<br />Here, you can change the name, description, thumbnail picture, restrict viewing and comment/rating permissions.<br />Click &quot;Update Album&quot;.', 'allow_private_albums', 0), //cpg1.3.0
        array('Miten voin katsella muidan k�ytt�jien omia gallerioita?', 'Mene &quot;Albumilistaan&quot; ja valitse &quot;K�ytt�jien galleriat&quot;.', 'allow_private_albums', 0), //cpg1.3.0
        array('Mit� ovat ev�steet?', 'Ev�steet ovat pelkk�� teksti� sis�lt�vi� tiedostoja, jotka l�hetet��n internetsivulta ja siirret��n k�ytt�j�n omalle koneelle.<br />Usein ev�steet sallivat k�ytt�j�n poistumisen ja palaamisen internetsivustolle ilman uutta kirjautumista.', 'offline', 0), //cpg1.3.0
        array('Mist� voin saada Coppermine-ohjelman omalle sivulleni?', 'Coppermine on ilmainen galleriaohjelma ja se on julkaistu GNU GPL:n alaisena. Se on t�ynn� erilaisia ominaisuuksiaja se sopii monille erilaisille k�ytt�j�rjestelmille. Vieraile ohjelman sivuilla <a href="http://coppermine.sf.net/">Coppermine Home Page</a> saadaksesi lis�� tietoa ja ladataksesi ohjelman.', 'offline', 0), //cpg1.3.0

  'Liikkuminen galleriassa', //cpg1.3.0
        array('Mik� on &quot;Albumilista&quot;?', 'N�ytt�� koko sen kategorian, jossa olet sill� hetkell� sis�lt�en linkin jokaiseen albumiin. Jos et ole miss��n kategoriassa, se n�ytt�� koko gallerian ja linkin jokaiseen kategoriaan. Thumbnailit voivat olla linkki kategoriaan.', 'offline', 0), //cpg1.3.0
        array('Mik� on &quot;Oma galleria&quot;?', 'T��ll� k�ytt�j� saa luoda oman gallerian sek� lis�t�, poistaa tai muokata albumeita ja lis�t� kuvia niihin.', 'allow_private_albums', 0), //cpg1.3.0
        array('Mitk� ovat &quot;Yll�pitotilan&quot; ja &quot;K�ytt�j�tilan&quot; erot?', 'Yll�pitotilassa voit muokata omaa galleriaasi (my�s muita albumeita, riippuen yll�pidon asetuksista).', 'allow_private_albums', 0), //cpg1.3.0
        array('Mit� tarkoittaa &quot;Lis�� kuva&quot;?', 'Voit lis�t� omia tiedostoja (koko ja tiedostomuodot ovat yll�pidon p��tett�viss�) sellaiseen galleriaan johon sivun yll�pit�j� on antanut luvan.', 'allow_private_albums', 0), //cpg1.3.0
        array('Mit� n�en linkin &quot;Viimeksi lis�tty&quot; takaa?', 'T��lt� n�et kuvat, jotka on viimeksi siirretty galleriaan.', 'offline', 0), //cpg1.3.0
        array('Mik� on &quot;Viimeiset kommentit&quot;?', 'T��lt� l�yd�t viimeksi lis�tyt kommentit ja tiedostot, joita on kommentoitu.', 'offline', 0), //cpg1.3.0
        array('Mik� on &quot;Katsotuimmat&quot;?', 'N�ytt�� eniten huomiota saaneet kuvat, eli kuvat joita on katsottu useimmin.', 'offline', 0), //cpg1.3.0
        array('Mik� on &quot;Suosituimmat&quot;?', 'T��ll� n�kyv�t ne tiedostot, jotka ovat saaneet parhaat arvostelut. Tuloksissa n�kyy ��nten keskiarvo (esim: viisi k�ytt�j�� antoivat kukin <img src="images/rating3.gif" width="65" height="14" border="0" alt="" />: tiedoston keskiarvo olisi silloin <img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> ; Viisi k�ytt�j�� antoi kuvalle pisteet yhdest� viiteen (1,2,3,4,5) jolloin keskiarvo olisi <img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> .)<br />Arvosteluasteikko on <img src="images/rating5.gif" width="65" height="14" border="0" alt="best" /> (paras) -- <img src="images/rating0.gif" width="65" height="14" border="0" alt="worst" /> (huonoin).', 'offline', 0), //cpg1.3.0
  	array('Mit� tarkoittaa &quot;Suosikkini&quot;?', 'T�m� toiminto antaa k�ytt�j�n tallettaa omat suosikkikuvansa ev�steiden, jotka l�hetet��n k�ytt�j�n omalle koneelle, avulla.', 'offline', 0), //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// Tiedosto forgot_passwd.php //cpg1.3.0                                     //
// ------------------------------------------------------------------------- //

if (defined('FORGOT_PASSWD_PHP')) $lang_forgot_passwd_php = array(
        'forgot_passwd' => 'Salasanan muistuttaja', //cpg1.3.0
        'err_already_logged_in' => 'Olet jo kirjautunut sis��n!', //cpg1.3.0
        'enter_username_email' => 'Kirjoita k�ytt�j�nimesi tai salasanasi', //cpg1.3.0
        'submit' => 'L�het�', //cpg1.3.0
        'failed_sending_email' => 'Salasananmuistuttajan s�hk�postia ei voida l�hett��!', //cpg1.3.0
        'email_sent' => 'S�hk�posti, jossa on k�ytt�j�tunnuksesi ja salasanasi on l�hetetty %s', //cpg1.3.0
        'err_unk_user' => 'Valittua k�ytt�j�� ei ole olemassa!', //cpg1.3.0
        'passwd_reminder_subject' => '%s - Salasananmuistuttaja', //cpg1.3.0
        'passwd_reminder_body' => 'Olet pyyt�nyt rekister�itymistietoja:
K�ytt�j�nimi: %s
Salasana: %s
Klikkaa %s kirjautuaksesi sis��n.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// Tiedosto groupmgr.php                                                     //
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
  	'group_name' => 'K�ytt�j�ryhm�',
  	'disk_quota' => 'Levytilaa',
  	'can_rate' => 'Voi ��nest��', //cpg1.3.0
  	'can_send_ecards' => 'Voi l�hett�� e-kortteja',
  	'can_post_com' => 'Voi lis�t� kommentteja',
  	'can_upload' => 'Voi siirt�� tiedostoja', //cpg1.3.0
  	'can_have_gallery' => 'Saa oman gallerian',
  	'apply' => 'Hyv�ksy muutokset',
  	'create_new_group' => 'Luo uusi ryhm�',
  	'del_groups' => 'Poista valittu ryhm�',
  	'confirm_del' => 'Kun poistat k�ytt�j�ryhm�n, kaikki sen rym�h edustajat siirtyv�t ryhm�n \'Rekister�itynyt\' j�seniksi.\n\nHaluatko varmasti jatkaa?', //js-alert //cpg1.3.0
  	'title' => 'Muokkaa k�ytt�j�ryhmi�',
  	'approval_1' => 'Yleisen siirron hyv�ksynt� (1)',
  	'approval_2' => 'Yksityisen siirron hyv�ksynt� (2)',
  	'upload_form_config' => 'Tiedoston siirron tyyppi', //cpg1.3.0
  	'upload_form_config_values' => array( 'Tiedot yksitellen', 'Monta tiedostoa kerralla', 'Vain URI siirtoja', 'Vain ZIP siirtoja', 'Tiedosto-URI', 'Tiedosto-ZIP', 'URI-ZIP', 'Tiedosto-URI-ZIP'), //cpg1.3.0
  	'custom_user_upload'=>'K�ytt�j� voi valita siirrett�ville tiedostoille tarkoitettujen kenttien m��r�n?', //cpg1.3.0
  	'num_file_upload'=>'Suurin / tarkka m��r� siirrett�ville tiedostoille tarkoitettuja kentti�', //cpg1.3.0
  	'num_URI_upload'=>'Suurin / tarkka m��r� URI-siirroille tarkoitettuja kentti�', //cpg1.3.0
  	'note1' => '<b>(1)</b> Kuvan lis�ys julkiseen albumiin vaatii yll�pidon hyv�ksynn�n',
  	'note2' => '<b>(2)</b> Kuvan lis�ys yksityiseen albumiin vaatii yll�pidon hyv�ksynn�n',
  	'notes' => 'Huom',
);

// ------------------------------------------------------------------------- //
// Tiedosto index.php                                                        //
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
  	'welcome' => 'Tervetuloa!',
);

$lang_album_admin_menu = array(
  	'confirm_delete' => 'Haluatko varmasti poistaa t�m�n albumin? \\nKaikki tiedostot ja kommentit poistuvat albumin mukan.', //js-alert //cpg1.3.0
  	'delete' => 'Poista',
  	'modify' => 'Asetukset',
  	'edit_pics' => 'Muokkaa kuvia', //cpg1.3.0
);

$lang_list_categories = array(
  	'home' => 'Koti',
  	'stat1' => '<b>[albums]</b> albumia jotka sis�lt�v�t <b>[pictures]</b> kuvaa. <b>[cat]</b> kategoriaa joissa <b>[comments]</b> kommenttia. Katseltu <b>[views]</b> kertaa.', //cpg1.3.0
  	'stat2' => '<b>[albums]</b> albumia jotka sis�lt�v�t <b>[pictures]</b> kuvaa. Katseltu <b>[views]</b> kertaa.', //cpg1.3.0
  	'xx_s_gallery' => '%s:n Galleria',
  	'stat3' => '<b>[albums]</b> albumia jotka sis�lt�v�t <b>[pictures]</b> kuvaa. <b>[comments]</b> kommenttia ja kuvia katseltu <b>[views]</b> kertaa.', //cpg1.3.0
);

$lang_list_users = array(
  	'user_list' => 'K�ytt�j�lista',
  	'no_user_gal' => 'Ei k�ytt�jien gallerioita',
  	'n_albums' => '%s albumia',
  	'n_pics' => '%s tiedostoa', //cpg1.3.0
);

$lang_list_albums = array(
  	'n_pictures' => '%s tiedostoa', //cpg1.3.0
  	'last_added' => ', viimeisin lis�tty %s',
);

}

// ------------------------------------------------------------------------- //
// Tiedosto login.php                                                        //
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
  	'login' => 'Kirjaudu',
  	'enter_login_pswd' => 'Kirjoita k�ytt�j�nimesi ja salasanasi kirjautuaksesi sis��n.',
  	'username' => 'K�ytt�j�nimi',
  	'password' => 'Salasana',
  	'remember_me' => 'Muista minut',
  	'welcome' => 'Tervetuloa %s',
  	'err_login' => '*** Kirjautuminen ep�onnistui. Yrit� uudelleen ***',
  	'err_already_logged_in' => 'Olet jo kirjautunut sis��n!',
        'forgot_password_link' => 'Unohdin salasanani', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// Tiedosto logout.php                                                       //
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
  	'logout' => 'Kirjaudu ulos',
  	'bye' => 'N�kemiin %s',
  	'err_not_loged_in' => 'Et ole kirjautunut sis��n!',
);

// ------------------------------------------------------------------------- //
// Tiedosto phpinfo.php //cpg1.3.0                                           //
// ------------------------------------------------------------------------- //

if (defined('PHPINFO_PHP')) $lang_phpinfo_php = array(
  	'php_info' => 'PHP info', //cpg1.3.0
	'explanation' => 'T�m�n teksin on luonut PHP-funktio <a href="http://www.php.net/phpinfo">phpinfo()</a>. Coppermine n�ytt�� tekstin (muotoilee tekstin).', //cpg1.3.0
  	'no_link' => 'Phpinfon n�ytt�minen muille saattaa olla turvallisuusriski. T�st� syyst� t�m� sivu n�kyy ainoastaan silloin kun on kirjautunut sis��n yll�pit�j�n�. Sivua ei voi linkitt�� ulkopuolisille, sill� heilt� on p��sy kielletty.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// Tiedosto modifyalb.php                                                    //
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
        'upd_alb_n' => 'P�ivit� albumi %s',
        'general_settings' => 'Yleiset asetukset',
        'alb_title' => 'Albumin otsikko',
        'alb_cat' => 'Albumin kategoria',
        'alb_desc' => 'Albumin kuvaus',
        'alb_thumb' => 'Albumin thumbnail',
        'alb_perm' => 'K�ytt�jien oikeudet t�h�n albumiin',
        'can_view' => 'Albumia voi katsella',
        'can_upload' => 'Vierailijat voivat siirt�� tiedostoja albumiin',
        'can_post_comments' => 'Vierailijat voivat lis�t� kommentteja',
        'can_rate' => 'Vierailijat voivat ��nest�� kuvia',
        'user_gal' => 'K�ytt�j�n galleria',
        'no_cat' => '* Ei kategoriaa *',
        'alb_empty' => 'Albumi on tyhj�',
        'last_uploaded' => 'Viimeksi lis�tty',
        'public_alb' => 'Kaikki (julkinen)',
        'me_only' => 'Vain min�',
        'owner_only' => 'Vain albumin omistaja (%s)',
        'groupp_only' => 'Ryhm��n \'%s\' kuuluvat',
        'err_no_alb_to_modify' => 'Tietokannassa ei ole yht��n albumia jota voisit muokata.',
        'update' => 'P�ivit� albumi', //cpg1.3.0
        'notice1' => '(*) riippuvat %sgroups%s -asetuksista', //cpg1.3.0 (do not translate %s!)
);

// ------------------------------------------------------------------------- //
// Tiedosto ratepic.php                                                      //
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
  	'already_rated' => 'Olet jo ��nest�nyt t�t� kuvaa.', //cpg1.3.0
  	'rate_ok' => '��nesi on hyv�ksytty.',
  	'forbidden' => 'Et voi ��nest�� omia tiedostojasi.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// Tiedosto register.php & profile.php                                       //
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
Sivuston {SITE_NAME} yll�pito yritt�� poistaa ja muokata kaikkea haitallista materiaalia niin pian kuin mahdollista. On kuitenkin mahdotonta ehti� aina ensimm�isen� paikalle tai n�hd� kaikkia tietoja, joita sivulle ilmestyy. Siksi pit�� muistaa, ett� haitallinen tieto, joka ei ole yll�pidon itsens� l�hett�m�, ei kuvasta sivuston yll�pitoa vaan yksinomaan tiedon l�hett�j��. Kommentti leimaa siis kirjoittajansa, ei sivuston yll�pitoa.
<br /><br />
Hyv�ksyt, ett� et l�het� sivulle hy�kk�v��, s��dyt�nt�, mautonta, herjaavaa, vastenmielista, uhkaava, seksuaalista, rasistista tai mit��n muutakaan lainvastaista, loukkaavaa tai hyvien tapojen vastaista materiaalia. Suostut my�s siihen, ett� sivuston {SITE_NAME} yll�pito ja valvojat saattavat poistaa tai muokata l�hett�m��si materiaalia milloin tahansa ilmoittamatta. K�ytt�j�n� hyv�ksyt my�s sen, ett� tietosi tallennetaan sivuston tietokantaan. Vaikka k�ytt�j�tietoja ei tietoisesti luovuteta kolmansille osapuolille ilman k�ytt�j�n suostumusta, yll�pitoa ei pidet� vastuullisena tietomurron kautta saatujen tietojen v��rink�ytt��n.
<br /><br />
T�m� galleria k�ytt�� ev�steit� tallentaakseen tietoja k�ytt�j�n koneelle. Ev�steit� k�ytet��n vain gallerian selaamisen helpottamiseen. Luovuttamaasi s�hk�postiosoitetta k�ytet��n ainoastaan rekister�itymisen vahvistamiseen, eik� sit� luovuteta kolmansien osapuolten k�ytt��n.
<br /><br />
Klikkaamalla alla olevaa linkki� sitoudut noudattamaan n�it� k�ytt�ehtoja.
EOT;

$lang_register_php = array(
  	'page_title' => 'Rekister�ityminen',
  	'term_cond' => 'K�ytt�ehdot',
  	'i_agree' => 'Hyv�ksyn',
  	'submit' => 'Submit registration',
  	'err_user_exists' => 'Valitsemasi k�ytt�j�tunnus on jo k�yt�ss�. Valitse uusi k�ytt�j�tunnus.',
  	'err_password_mismatch' => 'Kirjoittamasi kaksi salasanaa eiv�t ole samat. Kirjoita ne uudelleen.',
  	'err_uname_short' => 'K�ytt�j�nimen on oltava v�hint��n kaksi merkki� pitk�.',
  	'err_password_short' => 'Salasanan on oltava v�hint��n kaksi merkki� pitk�.',
  	'err_uname_pass_diff' => 'K�ytt�j�tunnus ja salasana eiv�t saa olla samat.',
  	'err_invalid_email' => 'S�hk�postiosoite on v��r�.',
  	'err_duplicate_email' => 'Sama s�hk�postiosoite on toisen k�ytt�j�n k�yt�ss�.',
  	'enter_info' => 'Kaikki pakolliset kohdat on t�ytett�v�',
  	'required_info' => 'Pakolliset tiedot',
  	'optional_info' => 'Valinnaiset tiedot',
  	'username' => 'K�ytt�j�tunnus',
  	'password' => 'Salasana',
  	'password_again' => 'Salasana uudelleen',
  	'email' => 'S�hk�postiosoite',
  	'location' => 'Asuinpaikka',
  	'interests' => 'Harrastukset',
  	'website' => 'Kotisivu',
  	'occupation' => 'Ammatti',
  	'error' => 'Virhe',
  	'confirm_email_subject' => '%s - Rekister�itymisen varmistus',
  	'information' => 'Tieto',
  	'failed_sending_email' => 'Rekiste�ritymisen varmistavaa s�hk�postia ei voida l�hett��!',
  	'thank_you' => 'Kiitos rekister�itymisest�.<br /><br />K�ytt�j�tilin aktivoimista koskeva s�hk�posti on l�hetetty antamaasi s�hk�postiosoitteeseen.',
  	'acct_created' => 'K�ytt�j�tilisi on luotu ja voit nyt kirjautua sis��n k�ytt�m�ll� k�ytt�j�tunnustasi ja salasanaasi.',
  	'acct_active' => 'K�ytt�j�tunnuksesi on aktivoitu ja voit nyt kirjautua sis��n k�ytt�m�ll� k�ytt�j�tunnustasi ja salasanaasi.',
  	'acct_already_act' => 'K�ytt�j�tunnuksesi on jo aktivoitu!',
  	'acct_act_failed' => 'Tunnusta ei voida aktivoida!',
  	'err_unk_user' => 'Valittua k�ytt�j�� ei ole olemassa!',
  	'x_s_profile' => '%s: profiili',
  	'group' => 'K�ytt�j�ryhm�',
  	'reg_date' => 'Liittynyt',
  	'disk_usage' => 'Tilank�ytt�',
  	'change_pass' => 'Vaihda salasana',
  	'current_pass' => 'Nykyinen salasana',
  	'new_pass' => 'Uusi salasana',
  	'new_pass_again' => 'Uusi salasana uudelleen',
  	'err_curr_pass' => 'Nykyinen salasana on v��r�',
  	'apply_modif' => 'Hyv�ksy muutokset',
  	'change_pass' => 'Vaihda salasanaa',
  	'update_success' => 'K�ytt�j�tietosi on p�ivitetty',
  	'pass_chg_success' => 'Salasanasi on vaihdettu',
  	'pass_chg_error' => 'Salasanaasi ei vaihdettu',
  	'notify_admin_email_subject' => '%s - Rekister�itymisilmoitus', //cpg1.3.0
  	'notify_admin_email_body' => 'Uusi k�ytt�j�, %s, on rekister�itynyt galleriaasi.', //cpg1.3.0
);

$lang_register_confirm_email = <<<EOT
Kiitos kun rekister�idyit - {SITE_NAME}

K�ytt�j�nimesi on : "{USER_NAME}"
Salasanasi on : "{PASSWORD}"

Aktivoidaksesi tunnuksen sinun on klikattava alla olevaa linkki�
tai kopioita se selaimesi osoiteriville.

{ACT_LINK}

Toivottaa,

{SITE_NAME} : Yll�pito

EOT;

}

// ------------------------------------------------------------------------- //
// Tiedosto reviewcom.php                                                    //
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
  	'title' => 'Katsele kommentteja',
  	'no_comment' => 'Ei yht��n kommenttia',
  	'n_comm_del' => '%s kommenttia poistettu',
  	'n_comm_disp' => 'N�ytett�vien kommenttien m��r�',
  	'see_prev' => 'Edellinen',
  	'see_next' => 'Seuraava',
  	'del_comm' => 'Poista valitut kommentit',
);


// ------------------------------------------------------------------------- //
// Tiedosto search.php - OK                                                  //
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
  	0 => 'Etsi tiedostot',
);

// ------------------------------------------------------------------------- //
// Tiedosto searchnew.php                                                    //
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
  	'page_title' => 'Etsi uusia tiedostoja', //cpg1.3.0
  	'select_dir' => 'Valitse kansio',
  	'select_dir_msg' => 'T�m�n toiminnon avulla voit lis�t� tiedostoja, jotka olet jo siirt�nyt FTP:ll�.<br /><br />Valitse kansio, johon olet siirt�nyt tiedostot.', //cpg1.3.0
  	'no_pic_to_add' => 'Ei lis�tt�vi� tiedostoja', //cpg1.3.0
  	'need_one_album' => 'T�m� toiminto vaatii v�hint��n yhden albumin',
  	'warning' => 'Varoitus',
  	'change_perm' => 'Skripti ei voi kirjoittaa valitsemaasi kansioon. Vaihda kansion oikeudet muotoon 755 tai 777 ennen kuin yrit�t lis�t� tiedostoja!', //cpg1.3.0
  	'target_album' => '<b>Siirr� &quot;</b>%s<b>&quot; tiedostot albumiin </b>%s', //cpg1.3.0
  	'folder' => 'Kansio',
  	'image' => 'tiedosto',
  	'album' => 'Albumi',
  	'result' => 'Tulos',
  	'dir_ro' => 'Ei voida kirjoittaa. ',
  	'dir_cant_read' => 'Ei voida lukea. ',
  	'insert' => 'Lis�� uusia tiedostoja galleriaan', //cpg1.3.0
  	'list_new_pic' => 'Lista uusista tiedostoista', //cpg1.3.0
  	'insert_selected' => 'Lis�� valitut tiedostot', //cpg1.3.0
  	'no_pic_found' => 'Uusia tiedostoja ei l�ytynyt', //cpg1.3.0
  	'be_patient' => 'Ole k�rsiv�llinen, skripti tarvitsee aikaa tiedostojen lis��miseen', //cpg1.3.0
  	'no_album' => 'albumia ei valittu',  //cpg1.3.0
  	'notes' =>  '<ul>'.
                          '<li><b>OK</b> : tarkoittaa, ett� tiedosto lis�ttiin onnistuneesti</li>'.
                          '<li><b>DP</b> : tarkoittaa, ett� sama tiedosto on jo tietokannassa</li>'.
                          '<li><b>PB</b> : tarkoittaa, ett� tiedostoa ei voitu lis�t�. Tarkista kohdekansioiden k�ytt�oikeudet</li>'.
                          '<li><b>NA</b> : tarkoittaa, ett� et ole valinnut albumia johon kuvat pit�isi siirt��. Siirry \'<a href="javascript:history.back(1)">takaisin</a>\' ja valitse albumi. Jos galleriassa ei ole yht��n albuamia, <a href="albmgr.php">luo</a> ensin yksi albumi</li>'.
                          '<li>Jos merkit OK, DP, PB eiv�t ilmesty, klikkaa rikkoutunutta tiedosta n�hd�ksesi PHP:n tuottaman virheilmoituksen</li>'.
                          '<li>Jos selaimesi menee timeout-tilaan, p�ivit� sivu</li>'.
                          '</ul>', //cpg1.3.0
  	'select_album' => 'valitse albumi', //cpg1.3.0
  	'check_all' => 'Valise kaikki', //cpg1.3.0
  	'uncheck_all' => 'Poista valinta kaikista', //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// Tiedosto thumbnails.php                                                   //
// ------------------------------------------------------------------------- //

// tyhj�

// ------------------------------------------------------------------------- //
// Tiedosto banning.php                                                      //
// ------------------------------------------------------------------------- //

if (defined('BANNING_PHP')) $lang_banning_php = array(
  	'title' => 'Bannaa k�ytt�ji�',
  	'user_name' => 'K�ytt�j�nimi',
  	'ip_address' => 'IP-osoite',
  	'expiry' => 'P��ttymisaika (tyhj� tarkoittaa pysyv��)',
  	'edit_ban' => 'Tallenna muutokset',
  	'delete_ban' => 'Poista',
  	'add_new' => 'Lis�� uusi',
  	'add_ban' => 'Lis��',
  	'error_user' => 'Ei l�yd� k�ytt�j��', //cpg1.3.0
  	'error_specify' => 'K�ytt�j�nimi tai IP-osoite on pakollinen tieto', //cpg1.3.0
  	'error_ban_id' => 'Virheellinen bannin ID!', //cpg1.3.0
  	'error_admin_ban' => 'Et voi bannata itse�si!', //cpg1.3.0
  	'error_server_ban' => 'Olet bannaamassa omaa palvelintasi? Teht�v�� ei voi toteuttaa.', //cpg1.3.0
  	'error_ip_forbidden' => 'Et voi bannata t�t� IP-osoitetta - sit� ei ole reititetty!', //cpg1.3.0
  	'lookup_ip' => 'Etsi IP-osoitetta', //cpg1.3.0
  	'submit' => 'Etsi', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// Tiedosto upload.php                                                       //
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
  	'title' => 'Siirr� tiedosto', //cpg1.3.0
  	'custom_title' => 'Muokkaa tiedostonsiirtolomaketta', //cpg1.3.0
  	'cust_instr_1' => 'Voit valita haluamasi m��r�n siirrett�ville tiedostoille tarkoitettuja kentti�. Et voi kuitenkaan valita kentti� enemp�� kuin yll�pit�j� on m��r�nnyt.', //cpg1.3.0
  	'cust_instr_2' => 'Kenttien m��r�', //cpg1.3.0
  	'cust_instr_3' => 'Suoraa tiedostojen siirtoa palvelimelle varten enint��n: %s', //cpg1.3.0
  	'cust_instr_4' => 'URI/URL -siirtoa varten enint��n: %s', //cpg1.3.0
	'cust_instr_5' => 'URI/URL -siirtoa varten:', //cpg1.3.0
  	'cust_instr_6' => 'Suoraa siirtoa palvelimelle varten:', //cpg1.3.0
  	'cust_instr_7' => 'Valitse haluamasi m��r� siirtokentti�. Siirry sitten eteenp�in klikkaamalla \'Jatka\'. ', //cpg1.3.0
  	'reg_instr_1' => 'Lomakkeessa viallinen tieto.', //cpg1.3.0
  	'reg_instr_2' => 'Voit nyt siirt�� tiedostoja kirjoittamalla niiden sijainnin alla oleviin kenttiin. Tiedoston koko ei saa ylitt�� %s KB:ta. ZIP-tiedostot jotka siirret��n \'Suoran siirron\' tai \'URI/URL -siirron\' kautta s�ilyv�t pakattuina.', //cpg1.3.0
  	'reg_instr_3' => 'Jos haluat ett� pakattu tiedosto puretaan, se pit�� lis�t� \'Purkaa ZIP-tiedoston\' -kent�n kautta.', //cpg1.3.0
  	'reg_instr_4' => 'URI/URL -siirtoa k�ytett�ess� tiedoston polku pit�� kirjoitttaa t�ydellisesti: http://www.omasivu.com/images/example.jpg', //cpg1.3.0
  	'reg_instr_5' => 'Kun olet t�ytt�nyt lomakkeen, jatka klikkaamalla \'Jatka\'.', //cpg1.3.0
  	'reg_instr_6' => 'Purettavat ZIP-tiedostot:', //cpg1.3.0
  	'reg_instr_7' => 'Tiedosto siirret��n palvelimelle:', //cpg1.3.0
  	'reg_instr_8' => 'URI/URL -siirrot:', //cpg1.3.0
  	'error_report' => 'Virheraportti', //cpg1.3.0
  	'error_instr' => 'Seuraavissa siirroissa oli ongelmia:', //cpg1.3.0
  	'file_name_url' => 'Tiedoston nimi/URL', //cpg1.3.0
  	'error_message' => 'Virheraportti', //cpg1.3.0
  	'no_post' => 'POST ei siirt�nyt tiedostoa.', //cpg1.3.0
  	'forb_ext' => 'Kielletty tiedostomuoto.', //cpg1.3.0
  	'exc_php_ini' => 'php.ini sallii kokorajoituksen ylitt�misen.', //cpg1.3.0
  	'exc_file_size' => 'CPG ylitti tiedostokoon rajoituksen.', //cpg1.3.0
  	'partial_upload' => 'Vain osittainen siirto.', //cpg1.3.0
  	'no_upload' => 'Siirto ei onnistunut.', //cpg1.3.0
  	'unknown_code' => 'Tuntematon PHP-virhe siirron yhteydess�.', //cpg1.3.0
  	'no_temp_name' => 'Ei siirtoa - Ei v�liaikaista nime�.', //cpg1.3.0
  	'no_file_size' => 'Ei sis�ll� tietoa / tieto vaurioitunut', //cpg1.3.0
  	'impossible' => 'Ei voida siirt��.', //cpg1.3.0
  	'not_image' => 'Tiedosto ei ole kuva / tieto vaurioitunut', //cpg1.3.0
  	'not_GD' => 'Ei GD tiedostotarkennin.', //cpg1.3.0
  	'pixel_allowance' => 'Pixel allowance exceeded.', //cpg1.3.0 //Ei k��nnetty - Sopivaa suomennosta ei l�ydy
  	'incorrect_prefix' => 'V��r� URI/URL', //cpg1.3.0
  	'could_not_open_URI' => 'Ei voinut avata URI:a.', //cpg1.3.0
  	'unsafe_URI' => 'Turvallisuus ei ole varmaa.', //cpg1.3.0
  	'meta_data_failure' => 'Meta data failure', //cpg1.3.0 //Ei k��nnetty - Sopivaa suomennosta ei l�ydy
  	'http_401' => '401 Unauthorized', //cpg1.3.0 //Ei k��nnetty - K��nn�s tarpeeton virheilmoituksissa
  	'http_402' => '402 Payment Required', //cpg1.3.0 //Ei k��nnetty - K��nn�s tarpeeton virheilmoituksissa
  	'http_403' => '403 Forbidden', //cpg1.3.0 //Ei k��nnetty - K��nn�s tarpeeton virheilmoituksissa
  	'http_404' => '404 Not Found', //cpg1.3.0 //Ei k��nnetty - K��nn�s tarpeeton virheilmoituksissa
  	'http_500' => '500 Internal Server Error', //cpg1.3.0 //Ei k��nnetty - K��nn�s tarpeeton virheilmoituksissa
  	'http_503' => '503 Service Unavailable', //cpg1.3.0 //Ei k��nnetty - K��nn�s tarpeeton virheilmoituksissa
  	'MIME_extraction_failure' => 'MIME:� ei havaittu.', //cpg1.3.0
  	'MIME_type_unknown' => 'Tuntematon MIME-tyyppi', //cpg1.3.0
  	'cant_create_write' => 'Ei voi luoda tiedostoa.', //cpg1.3.0
  	'not_writable' => 'Ei voi kirjoittaa tiedostoon.', //cpg1.3.0
  	'cant_read_URI' => 'Ei voi lukea URI/URL', //cpg1.3.0
  	'cant_open_write_file' => 'Ei voi avata URI -kirjoitustiedostoa.', //cpg1.3.0
  	'cant_write_write_file' => 'Ei voi kirjoittaa URI -kirjoitustiedostoon.', //cpg1.3.0
  	'cant_unzip' => 'Ei voi purkaa tiedostoa.', //cpg1.3.0
  	'unknown' => 'Tuntematon virhe', //cpg1.3.0
  	'succ' => 'Onnistuneet tiedostonsiirrot', //cpg1.3.0
  	'success' => '%s siirtoa onnistui.', //cpg1.3.0
  	'add' => 'Klikkaa \'Jatka\' lis�t�ksesi tiedostot albumeihin.', //cpg1.3.0
  	'failure' => 'Siirrossa tapahtui virhe', //cpg1.3.0
  	'f_info' => 'Tiedoston tiedot', //cpg1.3.0
  	'no_place' => 'Edellist� tiedostoa ei voitu sijoittaa haluamallasi tavalla.', //cpg1.3.0
  	'yes_place' => 'Edellinen tiedosto sijoitettiin onnistuneesti.', //cpg1.3.0
  	'max_fsize' => 'Suurin sallittu tiedoston koko on %s KB',
  	'album' => 'Albumi',
  	'picture' => 'Tiedosto', //cpg1.3.0
  	'pic_title' => 'Tiedoston otsikko', //cpg1.3.0
  	'description' => 'Tiedoston kuvaus', //cpg1.3.0
  	'keywords' => 'Hakusanat (erottele v�lily�nneill�)',
  	'err_no_alb_uploadables' => 'Ei ole albumia johon sinulla olisi oikeus siirt�� tiedostoja', //cpg1.3.0
  	'place_instr_1' => 'Sijoita tiedostot albumeihin. Voit my�s lis�t� tiedostoihin haluamiasi tietoja.', //cpg1.3.0
  	'place_instr_2' => 'Lis�� tiedostoja odottaa sijoitusta. Klikkaa \'Jatka\'.', //cpg1.3.0
  	'process_complete' => 'Kaikki tiedostot sijoitettu onnistuneesti.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// Tiedosto usermgr.php                                                      //
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
  	'title' => 'Muokkaa k�ytt�ji�',
  	'name_a' => 'Nimi nousevasti',
  	'name_d' => 'Nimi laskevasti',
  	'group_a' => 'K�ytt�j�ryhm� nousevasti',
  	'group_d' => 'K�ytt�j�ryhm� laskevasti',
  	'reg_a' => 'Rek. pvm. nousevasti',
  	'reg_d' => 'Rek. pvm. laskevasti',
  	'pic_a' => 'Tiedostojen m��r� nousevasti',
  	'pic_d' => 'Tiedostojen m��r� laskevasti',
  	'disku_a' => 'Tilank�ytt� nousevasti',
  	'disku_d' => 'Tilank�ytt� laskevasti',
  	'lv_a' => 'Viimeinen k�ynti nousevasti', //cpg1.3.0
  	'lv_d' => 'Viimeinen k�ynti laskevasti', //cpg1.3.0
  	'sort_by' => 'J�rjest� k�ytt�j�t',
  	'err_no_users' => 'Ei k�ytt�ji�!',
  	'err_edit_self' => 'Et voi muokata omaa profiiliasi. K�yt� \'Omat tiedot\' linkki� siihen tarkoitukseent',
  	'edit' => 'Muokkaa',
  	'delete' => 'Poista',
  	'name' => 'K�ytt�j�nimi',
  	'group' => 'K�ytt�j�ryhm�',
  	'inactive' => 'Passiivinen',
  	'operations' => 'Toiminnat',
  	'pictures' => 'Tiedostot', //cpg1.3.0
  	'disk_space' => 'Tilaa k�ytetty / Yl�raja',
  	'registered_on' => 'Rekiste�ritymisen p�iv�m��r�',
  	'last_visit' => 'Viimeksi vieraillut', //cpg1.3.0
  	'u_user_on_p_pages' => '%d k�ytt�j�� %d sivulla',
  	'confirm_del' => 'Haluatko varmasti poistaa t�m�n k�ytt�j�n? \\nKaikki h�nen albuminsa ja tiedostonsa poistuvat my�s.', //js-alert //cpg1.3.0
  	'mail' => 'Posti',
  	'err_unknown_user' => 'Valittua k�ytt�j�� ei ole!',
  	'modify_user' => 'Muokkaa k�ytt�j��',
  	'notes' => 'Huom',
  	'note_list' => '<li>Jos et halua vaihtaa nykyist� salasanaa, j�t� salasana-kentt� tyhj�ksi',
  	'password' => 'Salasana',
  	'user_active' => 'K�ytt�j� on aktiivinen',
  	'user_group' => 'K�ytt�j�ryhm�',
  	'user_email' => 'S�hk�posti',
  	'user_web_site' => 'Kotisivu',
  	'create_new_user' => 'Luo uusi k�ytt�j�',
  	'user_location' => 'Sijainti',
  	'user_interests' => 'Harrastukset',
  	'user_occupation' => 'Ammatti',
  	'latest_upload' => 'Viimeiset tiedostonsiirrot', //cpg1.3.0
  	'never' => 'ei koskaan', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// Tiedosto util.php                                                         //
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
  	'title' => 'Yll�pit�j�n asetukset (Muokkaa kuvien kokoa)', //cpg1.3.0
  	'what_it_does' => 'Teht�v�t',
  	'what_update_titles' => 'Muokkaa tiedoston otsikkoa',
  	'what_delete_title' => 'Poistaa otsikon',
  	'what_rebuild' => 'Tekee thumbnailit ja uudelleen ja muokkaa kuvan kokoa',
  	'what_delete_originals' => 'Poistaa alkuper�isen kokoiset kuvat ja korvaa ne muokatuilla',
  	'file' => 'Tiedosto',
  	'title_set_to' => 'otsikko asetettu',
  	'submit_form' => 'l�het�',
  	'updated_succesfully' => 'muokkaus onnistui',
  	'error_create' => 'Virhe!',
  	'continue' => 'Muokkaa lis�� kuvia',
  	'main_success' => 'Tiedostoa %s k�ytettiin onnistuneesti p��tiedostona', //cpg1.3.0
  	'error_rename' => 'Virhe uudelleennimett�ess� tiedostoa %s muotoon %s',
  	'error_not_found' => 'Tiedostoa %s ei l�ytynyt',
  	'back' => 'takaisin p��valikkoon',
  	'thumbs_wait' => 'P�ivitt�� thumbnaileja / muokkaa kuvia. Odota hetki...',
  	'thumbs_continue_wait' => 'Jatkaa thumbnailien p�ivityst� / kuvien muokkausta...',
  	'titles_wait' => 'P�ivitt�� otsikkoja. Odota hetki...',
  	'delete_wait' => 'Poista otsikkoja. Odota hetki...',
  	'replace_wait' => 'Poistaa alkuper�isi kuvia ja korvaa niit� muokatuilla. Odota hetki...',
  	'instruction' => 'Pikaohjeet',
  	'instruction_action' => 'Valitse toiminto',
  	'instruction_parameter' => 'Aseta parametrit',
  	'instruction_album' => 'Valitse albumi',
  	'instruction_press' => 'Paina %s',
  	'update' => 'P�ivit� thumbnailit / muokatut kuvat',
  	'update_what' => 'Mit� p�ivitet��n',
  	'update_thumb' => 'Vain thumbnailit',
  	'update_pic' => 'Vain muokatut kuvat',
  	'update_both' => 'Sek� thumbnailit ett� muokatut kuvat',
  	'update_number' => 'K�sitelt�vi� kuvia per klikkaus',
  	'update_option' => '(Aseta alemmalle tasolle mik�li selain joutuu toistuvasti timeout-tilaan)',
  	'filename_title' => 'Tiedostonimi &rArr; Otsikko', //cpg1.3.0
  	'filename_how' => 'Miten tiedostonime� muokataan',
  	'filename_remove' => 'Poista .jpg-p��te ja korvaa _ (alaviiva) v�lily�nnill�',
  	'filename_euro' => 'Muuta 2003_11_23_13_20_20.jpg muotoon 23/11/2003 13:20',
  	'filename_us' => 'Muuta 2003_11_23_13_20_20.jpg muotoon 11/23/2003 13:20',
  	'filename_time' => 'Muuta 2003_11_23_13_20_20.jpg muotoon 13:20',
  	'delete' => 'Poista otsikot ja alkuper�isen kokoiset kuvat', //cpg1.3.0
  	'delete_title' => 'Poista otsikot', //cpg1.3.0
  	'delete_original' => 'Poista alkuper�isen kokoiset kuvat',
  	'delete_replace' => 'Poista alkuper�isen kokoiset kuvat ja korvaa ne muokatuilla versioilla',
  	'select_album' => 'Valitse albumi',
  	'delete_orphans' => 'Poista yksitt�iset kommentit (toimii kaikkiin albumeihin)', //cpg1.3.0
  	'orphan_comment' => 'yksitt�ist� kommenttia l�ytynyt', //cpg1.3.0
  	'delete' => 'Poista', //cpg1.3.0
  	'delete_all' => 'Poista kaikki', //cpg1.3.0
  	'comment' => 'Kommentti: ', //cpg1.3.0
  	'nonexist' => 'liitetty olemattomaan tiedostoon # ', //cpg1.3.0
  	'phpinfo' => 'N�yt� phpinfo', //cpg1.3.0
  	'update_db' => 'P�ivit� tietokanta', //cpg1.3.0
  	'update_db_explanation' => 'Jos olet korvannut copperminen tiedostoja, lis�nnyt muokkauksia tai p�ivitt�nyt aiemmasta versiosta, muista p�ivitt�� tietokanta. T�m� luo tarvittavat taulukot ja/tai configin arvot gallerian tietokantaan.', //cpg1.3.0
);

?>