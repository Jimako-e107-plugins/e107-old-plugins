<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.3.0                                            //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002-2004 Gregory DEMAR                                     //
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
// $Id: hungarian.php,v 1.8 2004/12/29 23:06:38 chtito Exp $
// ------------------------------------------------------------------------- //

// info about translators and translated language
$lang_translation_info = array(
  'lang_name_english' => 'Hungarian',  
  'lang_name_native' => 'Magyar', 
  'lang_country_code' => 'hu', 
  'trans_name'=> 'Peter Ardo', //the name of the translator - can be a nickname
  'trans_email' => 'petardo@freemail.hu', //translator's email address (optional)
  'trans_website' => '', //translator's website (optional)
  'trans_date' => '2003-10-20', //the date the translation was created / last modified
);

$lang_charset = 'iso-8859-2';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('byte', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('H', 'K', 'Sze', 'Cs', 'P', 'Szo', 'V');
$lang_month = array('Jan', 'Feb', 'M�r', '�pr', 'M�j', 'J�n', 'J�l', 'Aug', 'Szept', 'Okt', 'Nov', 'Dec');

// Some common strings
$lang_yes = 'Igen';
$lang_no  = 'Nem';
$lang_back = 'VISSZA';
$lang_continue = 'TOV�BB';
$lang_info = 'Inform�ci�';
$lang_error = 'Hiba';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%Y %B %d';
$lastcom_date_fmt =  '%y.%m.%d %H:%M';
$lastup_date_fmt = '%Y %B %d';
$register_date_fmt = '%Y %B %d';
$lasthit_date_fmt = '%Y %B %d %H:%M';
$comment_date_fmt =  '%Y %B %d %H:%M';

// For the word censor
$lang_bad_words = array('basz*', 'segg*', 'fasz*', 'kurva*', 'picsa', 'geci');

$lang_meta_album_names = array(
        'random' => 'V�letlen f�jlok', //cpg1.3.0
        'lastup' => 'Friss felt�lt�sek',
        'lastalb'=> 'Utolj�ra m�dos�tott albumok',
        'lastcom' => 'Friss hozz�sz�l�sok',
        'topn' => 'Top-n�zett',
        'toprated' => 'Top-szavazat',
        'lasthits' => 'Utolj�ra n�zett',
        'search' => 'Keres�s eredm�nye',
        'favpics'=> 'Kedvenc F�jlok' //cpg1.3.0
);

$lang_errors = array(
        'access_denied' => 'Nincs jogosults�god ennek az oldalnak a megtekint�s�hez.',
        'perm_denied' => 'Nincs jogosults�god ennek a m�veletnek az elv�gz�s�hez.',
        'param_missing' => 'Szkript h�v�s a sz�ks�ge param�ter(ek) megad�sa n�lk�l.',
        'non_exist_ap' => 'A kijel�lt album / f�jl nem tal�lhat�!', //cpg1.3.0
        'quota_exceeded' => 'Diszk kv�ta t�ll�pve<br /><br />A be�ll�tott diszkkv�ta [quota]K, a k�peid �ltal jelenleg elfoglalt t�rhely [space]K, ennek a f�jlnak a felt�lt�s�vel t�ll�pn�d a kv�t�j�t.', //cpg1.3.0
        'gd_file_type_err' => 'GD k�nyvt�r haszn�lata eset�n csak JPEG �s PNG t�pusok megengedettek.',
        'invalid_image' => 'A felt�lt�tt k�p s�r�lt, vagy a GD k�nyvt�r �ltal nem kezelhet�',
        'resize_failed' => 'Nem siker�lt az ikoniz�lt vagy �tm�retezett k�pek gener�l�sa.',
        'no_img_to_display' => 'Nincs megjelen�thet� k�p',
        'non_exist_cat' => 'A kijel�lt kateg�ria nem l�tezik',
        'orphan_cat' => 'A kateg�ria sz�l�kateg�ri�ja nem l�tezik, futtasd a kateg�riamenedzsert a probl�ma kik�sz�b�l�s�re.',
        'directory_ro' => 'A \'%s\' k�nyvt�r nem �rhat�, a f�jlokat nem lehet t�r�lni', //cpg1.3.0
        'non_exist_comment' => 'A kijel�lt hozz�sz�l�s nem l�tezik.',
        'pic_in_invalid_album' => 'F�jl nem l�tez� albumban (%s)!?', //cpg1.3.0
        'banned' => 'Jelenleg ki vagy tiltva a weblap haszn�lat�b�l.',
        'not_with_udb' => 'Ez a funkci� le van tiltva a Coppermine-ban, mivel a f�rum sw r�sze. A k�rt funkci�t vagy nem t�mogatja a jelen konfigur�ci�, vagy a f�rum sw kezeli.',
        'offline_title' => 'Offline', //cpg1.3.0
        'offline_text' => 'A gal�ria jelenleg  offline - l�togass vissza k�s�bb', //cpg1.3.0
        'ecards_empty' => 'Jelenleg nincs megjelen�thet� e-k�peslap. Ellen�rizd, hogy enged�lyezted -e az e-lapok napl�z�s�t a coppermine konfigur�ci�ban!', //cpg1.3.0
        'action_failed' => 'A m�velet sikertelen.  Coppermine nem tudja feldolgozni a k�r�st.', //cpg1.3.0
        'no_zip' => 'A ZIP f�jlok feldolgoz�s�hoz sz�ks�ges k�nyvt�r nem �ll rendelkez�sre. Fordulj a Coppermine adminisztr�torhoz.', //cpg1.3.0
        'zip_type' => 'Nincs jogosults�god ZIP f�jlok felt�lt�s�re.', //cpg1.3.0
);

$lang_bbcode_help = 'A k�vetkez� k�dok hasznosak lehetnek: <li>[b]<b>Bold</b>[/b]</li> <li>[i]<i>Italic</i>[/i]</li> <li>[url=http://yoursite.com/]Url Text[/url]</li> <li>[email]user@domain.com[/email]</li>'; //cpg1.3.0

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
        'alb_list_title' => 'Ugr�s az albumlist�ra',
        'alb_list_lnk' => 'Albumlista',
        'my_gal_title' => 'Ugr�s a szem�lyes k�pt�rra',
        'my_gal_lnk' => 'K�pt�ram',
        'my_prof_lnk' => 'Profilom',
        'adm_mode_title' => 'V�lt�s adminisztr�tor m�dra',
        'adm_mode_lnk' => 'Admin m�d',
        'usr_mode_title' => 'V�lt�s felhaszn�l� m�dra',
        'usr_mode_lnk' => 'Felhaszn.m�d',
        'upload_pic_title' => 'F�jl felt�lt�s az albumba', //cpg1.3.0
        'upload_pic_lnk' => 'Felt�lt�s', //cpg1.3.0
        'register_title' => 'Felhaszn�l� hozz�ad�sa',
        'register_lnk' => 'Regisztr�ci�',
        'login_lnk' => 'Bejelentkez�s',
        'logout_lnk' => 'Kijelentkez�s',
        'lastup_lnk' => 'Friss felt�lt�sek',
        'lastcom_lnk' => 'Friss hozz�sz�l�sok',
        'topn_lnk' => 'Top-n�zett',
        'toprated_lnk' => 'Top-szavazat',
        'search_lnk' => 'Keres�s',
        'fav_lnk' => 'Kedvencek',
        'memberlist_title' => 'Taglista megmutat�sa', //cpg1.3.0
        'memberlist_lnk' => 'Taglista', //cpg1.3.0
        'faq_title' => 'A &quot;Coppermine&quot; gal�ri�ra vonatkoz� Gyakran Ism�telt K�rd�sek', //cpg1.3.0
        'faq_lnk' => 'GYIK', //cpg1.3.0
);


$lang_gallery_admin_menu = array(
        'upl_app_lnk' => 'Felt�lt�s j�v�hagy�s',
        'config_lnk' => 'Konfigur�ci�',
        'albums_lnk' => 'Albumok',
        'categories_lnk' => 'Kateg�ri�k',
        'users_lnk' => 'Felhaszn�l�k',
        'groups_lnk' => 'Csoportok',
        'comments_lnk' => 'Hozz�sz�l�sok szerkeszt�se', //cpg1.3.0
        'searchnew_lnk' => 'K�tegelt felt�lt�s',
        'util_lnk' => 'Admin eszk�z�k',
        'ban_lnk' => 'Felhaszn�l�k kitilt�sa',
        'db_ecard_lnk' => 'E-lapok megtekint�se', //cpg1.3.0
);

$lang_user_admin_menu = array(
        'albmgr_lnk' => 'Szem�lyes albumok szerkeszt�se',
        'modifyalb_lnk' => 'Szem�lyes albumok tulajdons�gai',
        'my_prof_lnk' => 'Profilom',
);

$lang_cat_list = array(
        'category' => 'Kateg�ria',
        'albums' => 'Albumok',
        'pictures' => 'F�jlok', //cpg1.3.0
);

$lang_album_list = array(
        'album_on_page' => '%d album %d oldalon',
);

$lang_thumb_view = array(
        'date' => 'D�TUM',
        'name' => 'N�V',
        'title' => 'K�p c�m',
        'sort_da' => 'D�tum szerinti sorrendez�s, n�vekv�',
        'sort_dd' => 'D�tum szerinti sorrendez�s, cs�kken�',
        'sort_na' => 'N�v szerinti sorrendez�s, n�vekv�',
        'sort_nd' => 'N�v szerinti sorrendez�s, cs�kken�',
        'sort_ta' => 'Sorrendez�s c�m szerint - n�vekv�',
        'sort_td' => 'Sorrendez�s c�m szerint - cs�kken�',
        'download_zip' => 'Zip f�jl let�lt�se', //cpg1.3.0
        'pic_on_page' => '%d k�p %d oldalon',
        'user_on_page' => '%d felhaszn�l� %d oldalon', //cpg1.3.0
);

$lang_img_nav_bar = array(
        'thumb_title' => 'Vissza az ikonos elrendez�sre',
        'pic_info_title' => 'F�jl inform�ci� megtekint�se / elrejt�se', //cpg1.3.0
        'slideshow_title' => 'Diavet�t�s',
        'ecard_title' => 'F�jl elk�ld�se e-k�peslapk�nt', //cpg1.3.0
        'ecard_disabled' => 'e-lapok k�ld�se nem enged�lyezett',
        'ecard_disabled_msg' => 'Nincs jogosults�god e-k�peslap k�ld�s�re', //js-alert //cpg1.3.0
        'prev_title' => 'El�z� f�jl', //cpg1.3.0
        'next_title' => 'K�vetkez� f�jl', //cpg1.3.0
        'pic_pos' => 'F�JL %s/%s', //cpg1.3.0
);

$lang_rate_pic = array(
        'rate_this_pic' => 'F�jl oszt�lyoz�sa ', //cpg1.3.0
        'no_votes' => '(M�g nincs oszt�lyozva)',
        'rating' => '(jelenlegi oszt�lyzat: %s, %s szavazattal)',
        'rubbish' => 'Vacak',
        'poor' => 'Gyenge',
        'fair' => 'Megfelel�',
        'good' => 'J�',
        'excellent' => 'Kit�n�',
        'great' => 'Szuper',
);

// ------------------------------------------------------------------------- //
// File include/exif.inc.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File banning.php
// ------------------------------------------------------------------------- //

if (defined('BANNING_PHP')) $lang_banning_php = array(
                'title' => 'Tiltott felhaszn�l�k',
                'user_name' => 'Felhaszn�l�n�v',
                'ip_address' => 'IP c�m',
                'expiry' => 'Lej�rat (�lland� eset�n �res marad)',
                'edit_ban' => 'M�dos�t�sok t�rol�sa',
                'delete_ban' => 'T�rl�s',
                'add_new' => '�j tilt�s hozz�ad�sa',
                'add_ban' => 'Hozz�ad�s',
				'error_user' => 'Nem tal�lom a felhaszn�l�t', //cpg1.3.0
				'error_specify' => 'Meg kell adnod vagy a felhaszn�l�nevet, vagy egy IP c�met', //cpg1.3.0
				'error_ban_id' => '�rv�nytelen tilt�s ID!', //cpg1.3.0
				'error_admin_ban' => 'Nem z�rhatod ki magadat!', //cpg1.3.0
				'error_server_ban' => 'Te ki akartad z�rni a saj�t szervered? Zzzzzz..., ezt nem teheted...', //cpg1.3.0
				'error_ip_forbidden' => 'Nem z�rhatod ki ezt az IP-t - ez nem ir�ny�that� (non-routable)!', //cpg1.3.0
				'lookup_ip' => 'Keress egy IP c�met', //cpg1.3.0
				'submit' => 'mehet!', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File include/functions.inc.php
// ------------------------------------------------------------------------- //

$lang_cpg_die = array(
        INFORMATION => $lang_info,
        ERROR => $lang_error,
        CRITICAL_ERROR => 'Kritikus hiba',
        'file' => 'F�jl: ',
        'line' => 'Sor: ',
);

$lang_display_thumbnails = array(
        'filename' => 'F�jln�v : ',
        'filesize' => 'F�jlm�ret : ',
        'dimensions' => 'M�retek : ',
        'date_added' => 'Felt�lt�s d�tuma : ', //cpg1.3.0
);

$lang_get_pic_data = array(
        'n_comments' => '%s komment�r',
        'n_views' => '%s megtekint�s',
        'n_votes' => '(%s szavazat)',
);
$lang_cpg_debug_output = array(
  'debug_info' => 'Debug inf�', //cpg1.3.0
  'select_all' => 'Mind kiv�laszt', //cpg1.3.0
  'copy_and_paste_instructions' => 'If you\'re going to request help on the coppermine support board, copy-and-paste this debug output into your posting. Make sure to replace any passwords from the query with *** before posting.', //cpg1.3.0
  'phpinfo' => 'Phpinfo megjelen�t�se', //cpg1.3.0
);

$lang_language_selection = array(
  'reset_language' => 'Alap�rtelmezett nyelv', //cpg1.3.0
  'choose_language' => 'V�lassz nyelvet', //cpg1.3.0
);

$lang_theme_selection = array(
  'reset_theme' => 'Alap�rtelmezett t�ma', //cpg1.3.0
  'choose_theme' => 'V�lassz t�m�t', //cpg1.3.0
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
        'Exclamation' => 'Felki�lt�s',
        'Question' => 'K�rd�s',
        'Very Happy' => 'Nagyon boldog',
        'Smile' => 'Mosolyog',
        'Sad' => 'Szomor�',
        'Surprised' => 'Meglepett',
        'Shocked' => 'Sokkolt',
        'Confused' => 'Zavarodott',
        'Cool' => 'Higgadt',
        'Laughing' => 'Nevet',
        'Mad' => '�r�lt',
        'Razz' => 'G�nyos',
        'Embarassed' => 'K�nos',
        'Crying or Very sad' => 'S�r / nagyon szomor�',
        'Evil or Very Mad' => 'Gonosz vagy �r�lt',
        'Twisted Evil' => 'Torz gonosz',
        'Rolling Eyes' => 'Gurul� szemek',
        'Wink' => 'Kacsint',
        'Idea' => '�tlet',
        'Arrow' => 'Ny�l',
        'Neutral' => 'Semleges',
        'Mr. Green' => 'Mr. Z�ld',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
        0 => 'Kil�p�s adminisztr�tor m�db�l...',
        1 => 'V�lt�s adminisztr�tor m�dra...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
        'alb_need_name' => 'Az albumokat el kell nevezni!', //js-alert
        'confirm_modifs' => 'Biztos v�gre akarod hajtani ezt a m�dos�t�st?', //js-alert
        'no_change' => 'Semmit nem v�ltoztatt�l!', //js-alert
        'new_album' => '�j album',
        'confirm_delete1' => 'Biztos t�rl�d az albumot?', //js-alert
        'confirm_delete2' => '\nA tartalmazott �sszes k�p �s hozz�sz�l�s t�rl�dik!', //js-alert
        'select_first' => 'El�sz�r v�lassz albumot', //js-alert
        'alb_mrg' => 'Albummenedzser',
        'my_gallery' => '* K�pt�ram *',
        'no_category' => '* Nincs kateg�ria *',
        'delete' => 'T�rl�s',
        'new' => '�j',
        'apply_modifs' => 'M�dos�t�sok v�grehajt�sa',
        'select_category' => 'V�lassz kateg�ri�t',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
        'miss_param' => 'A \'%s\' m�velethez sz�ks�ges param�terek hi�nyoznak!',
        'unknown_cat' => 'Nincs az adatb�zisban a kijel�lt kateg�ria ',
        'usergal_cat_ro' => 'A szem�lyes k�pt�rak nem t�r�lhet�k!',
        'manage_cat' => 'Kateg�ri�k menedzsel�se',
        'confirm_delete' => 'Biztosan t�rl�d ezt a kateg�ri�t?', //js-alert
        'category' => 'Kateg�ria',
        'operations' => 'M�veletek',
        'move_into' => 'Mozgat�s a k�vetkez�be',
        'update_create' => 'Kateg�ria l�trehoz�s / m�dos�t�s',
        'parent_cat' => 'Sz�l� kateg�ria',
        'cat_title' => 'Kateg�ria megnevez�s',
        'cat_thumb' => 'Kateg�ria ikon', //cpg1.3.0
        'cat_desc' => 'Kateg�ria le�r�sa',
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
        'title' => 'Konfigur�ci�',
        'restore_cfg' => 'Gy�ri be�ll�t�sok',
        'save_cfg' => 'Konfigur�ci� t�rol�sa',
        'notes' => 'Megjegyz�sek',
        'info' => 'Inform�ci�',
        'upd_success' => 'Coppermine konfigur�ci� friss�tve',
        'restore_success' => 'Coppermine gy�ri be�ll�t�s vissza�ll�tva',
        'name_a' => 'N�v - n�vekv�',
        'name_d' => 'N�v - cs�kken�',
        'title_a' => 'C�m szerint - n�vekv�',
        'title_d' => 'C�m szerint - cs�kken�',
        'date_a' => 'D�tum n�vekv�',
        'date_d' => 'D�tum cs�kken�',
        'th_any' => 'Max Aspect',
        'th_ht' => 'Magass�g',
        'th_wd' => 'Sz�less�g',
        'label' => 'c�mke', //cpg1.3.0
        'item' => 't�tel', //cpg1.3.0
        'debug_everyone' => 'Mindenki', //cpg1.3.0
        'debug_admin' => 'Csak Admin', //cpg1.3.0
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
        '�ltal�nos be�ll�t�sok',
        array('K�pt�r neve', 'gallery_name', 0),
        array('K�pt�r le�r�sa', 'gallery_description', 0),
        array('K�pt�r adminisztr�tor email c�me', 'gallery_admin_email', 0),
        array('Az e-lapok  \'Tov�bbi k�pek\' linkj�hez tartoz� webc�m', 'ecards_more_pic_target', 0),
        array('Gal�ria offline', 'offline', 1), //cpg1.3.0
        array('E-lapok napl�z�sa', 'log_ecards', 1), //cpg1.3.0
        array('Kedvencek ZIP-let�lt�s�nek enged�lyez�se', 'enable_zipdownload', 1), //cpg1.3.0

        'Nyelv, t�ma �s karakterk�szlet be�ll�t�sok',
        array('Nyelv', 'lang', 5),
        array('T�ma', 'theme', 6),
        array('Leg�rd�l� nyelv-men� megjelen�t�se', 'language_list', 1), //cpg1.3.0
        array('Orsz�g z�szl�k megjelen�t�se', 'language_flags', 8), //cpg1.3.0
        array('&quot;Reset&quot; megjelen�t�se a nyelv-men�ben', 'language_reset', 1), //cpg1.3.0
        array('Leg�rd�l� t�ma-men� megjelen�t�se', 'theme_list', 1), //cpg1.3.0
        array('&quot;Reset&quot; megjelen�t�se a t�ma-men�ben', 'theme_reset', 1), //cpg1.3.0
        array('GYIK megjelen�t�se', 'display_faq', 1), //cpg1.3.0
        array('Bbcode help megjelen�t�se', 'show_bbcode_help', 1), //cpg1.3.0
        array('Karakterk�szlet', 'charset', 4), //cpg1.3.0


        'Albumlista n�zet',
        array('F�t�bl�zat sz�less�ge (pixel vagy %)', 'main_table_width', 0),
        array('Kateg�ri�k megjelen�tend� sz�ma', 'subcat_level', 0),
        array('Oldalank�nt megjelen�tend� albumok sz�ma', 'albums_per_page', 0),
        array('Albumlista oszlopainak sz�ma', 'album_list_cols', 0),
        array('Ikonok m�rete pixelben', 'alb_list_thumb_size', 0),
        array('A f�oldal tartalma', 'main_page_layout', 0),
        array('Els� szint� albumok ikonok megjelen�t�se a kateg�ri�kban','first_level',1),

        'Ikonlista n�zet',
        array('Oszlopok sz�ma az ikonlist�ban', 'thumbcols', 0),
        array('Sorok sz�ma az ikonlist�ban', 'thumbrows', 0),
        array('Megjelen�tend� tab- f�lek maxim�lis sz�ma', 'max_tabs', 10), //cpg1.3.0
        array('F�jl le�r�s megjelen�t�s (a k�p c�m�n fel�l) az ikonok alatt', 'caption_in_thumbview', 1), //cpg1.3.0
        array('Megtekint�sek sz�m�nak megjelen�t�se az ikonok alatt', 'views_in_thumbview', 1), //cpg1.3.0
        array('Az ikon alatt megjelenjen -e a hozz�sz�l�sok sz�ma', 'display_comment_count', 1),
        array('Felt�lt� nev�nek kijelz�se az ikon alatt', 'display_uploader', 1), //cpg1.3.0
        array('F�jlok alap�rtelmezett sorrendje', 'default_sort_order', 3), //cpg1.3.0
        array('Szavazatok minimuma a \'top-szavazat\' list�ra val� felker�l�shez', 'min_votes_for_rating', 0),

        'K�p-n�zet �s hozz�sz�l�s be�ll�t�sok',
        array('A f�jl-n�zethez tartoz� t�bl�zat sz�less�ge (pixel vagy %)', 'picture_table_width', 0), //cpg1.3.0
        array('F�jl inform�ci�k l�that�k alap�rtelmez�sben', 'display_pic_info', 1), //cpg1.3.0
        array('Tr�g�r szavak kisz�r�se a hozz�sz�l�sokb�l', 'filter_bad_words', 1),
        array('Hangulatkarakterek enged�lyez�se a hozz�sz�l�sokban', 'enable_smilies', 1),
        array('T�bb egym�st k�vet� hozz�sz�l�s enged�lyez�se egy k�phez ugyanazon felhaszn�l�nak (vissza�l�s v�delem tilt�sa)', 'disable_comment_flood_protect', 1), //cpg1.3.0
        array('A k�ple�r�s maxim�lis hossza', 'max_img_desc_length', 0),
        array('Maxim�lis karaktersz�m szavank�nt', 'max_com_wlength', 0),
        array('Sorok maxim�lis sz�ma hozz�sz�l�sonk�nt', 'max_com_lines', 0),
        array('Hozz�sz�l�sok maxim�lis hossza', 'max_com_size', 0),
        array('Filmcs�k megjelen�t�se', 'display_film_strip', 1),
        array('K�pkock�k sz�ma a filmcs�kban', 'max_film_strip_items', 0),
        array('Adminisztr�tor �rtes�t�se a hozz�sz�l�sokr�l e-mailben', 'email_comment_notification', 1), //cpg1.3.0
        array('Diavet�t�s id� intervalluma milliszekundumban (1 second = 1000 milliseconds)', 'slideshow_interval', 0), //cpg1.3.0

        'F�jl- �s ikonbe�ll�t�sok', //cpg1.3.0
        array('JPEG f�jlok min�s�ge', 'jpeg_qual', 0),
        array('Ikonok maxim�lis m�rete  <a href="#notice2" class="clickable_option">**</a>', 'thumb_width', 0), //cpg1.3.0
        array('M�retek haszn�lata (ikonok sz�less�ge, magass�ga, vagy maxim�lis m�rete)<a href="#notice2" class="clickable_option">**</a>', 'thumb_use', 7),
        array('K�zbens� m�ret� k�p gener�l�sa','make_intermediate',1),
        array('K�zbens� m�ret� k�p / vide� maxim�lis sz�less�ge �s magass�ga <a href="#notice2" class="clickable_option">**</a>', 'picture_width', 0), //cpg1.3.0
        array('Felt�lt�tt f�jlok maxim�lis m�rete (KB)', 'max_upl_size', 0), //cpg1.3.0
        array('Felt�lt�tt k�pek / vide�k maxim�lis sz�less�ge �s magass�ga (pixel)', 'max_upl_width_height', 0), //cpg1.3.0

  	'F�jlok �s ikonok extra be�ll�t�sai', //cpg1.3.0
  	array('Priv�t album ikon megjelen�t�se be nem jelentkezett felhaszn�l� eset�n','show_private',1), //cpg1.3.0
  	array('F�jlnevekben nem enged�lyezett karakterek', 'forbiden_fname_char',0), //cpg1.3.0
  	//array('Felt�lt�tt k�pek megengedett f�jlkiterjeszt�sei', 'allowed_file_extensions',0), //cpg1.3.0
  	array('Megengedett k�pt�pusok', 'allowed_img_types',0), //cpg1.3.0
  	array('Megengedett vide� t�pusok', 'allowed_mov_types',0), //cpg1.3.0
  	array('Megengedett audi� t�pusok', 'allowed_snd_types',0), //cpg1.3.0
  	array('Megengedett dokumentum t�pusok', 'allowed_doc_types',0), //cpg1.3.0
  	array('K�pek �tm�retez�s�nek m�dszere','thumb_method',2), //cpg1.3.0
  	array('F�jlel�r�si �tvonal az ImageMagick \'convert\' programhoz (p�ld�ul /usr/bin/X11/)', 'impath', 0), //cpg1.3.0
  	//array('Megengedett k�pt�pusok (csak ImageMagick eset�n)', 'allowed_img_types',0), //cpg1.3.0
  	array('ImageMagick parancssor opci�k', 'im_options', 0), //cpg1.3.0
  	array('EXIF adatok �rtelmez�se a JPEG f�jlokban', 'read_exif_data', 1), //cpg1.3.0
  	array('IPTC adatok �rtelmez�se a JPEG f�jlokban', 'read_iptc_data', 1), //cpg1.3.0
  	array('Album el�r�si �tvonal <a href="#notice1" class="clickable_option">*</a>', 'fullpath', 0), //cpg1.3.0
  	array('Felhaszn�l�i f�jlok el�r�si �tvonala <a href="#notice1" class="clickable_option">*</a>', 'userpics', 0), //cpg1.3.0
  	array('K�zbens� m�retez�s� k�pek prefixe <a href="#notice1" class="clickable_option">*</a>', 'normal_pfx', 0), //cpg1.3.0
  	array('Ikonf�jlok prefixe <a href="#notice1" class="clickable_option">*</a>', 'thumb_pfx', 0), //cpg1.3.0
  	array('K�nyvt�rak alap�rtelmezett m�dja', 'default_dir_mode', 0), //cpg1.3.0
  	array('F�jlok alap�rtelmezett m�dja', 'default_file_mode', 0), //cpg1.3.0

         'Felhaszn�l� be�ll�t�sok',
        array('�j felhaszn�l�k regisztr�lhatnak', 'allow_user_registration', 1),
        array('Regisztr�ci� email meger�s�t�shez k�t�tt', 'reg_requires_valid_email', 1),
		array('Admin �rtes�t�se felhaszn�l� regisztr�ci�r�l e-mailben', 'reg_notify_admin_email', 1), //cpg1.3.0
        array('K�t felhaszn�l�nak lehet azonos email c�me', 'allow_duplicate_emails_addr', 1),
        array('Felhaszn�l�knak lehetnek priv�t albumai (Megjegyz�s: ha \'igen\' -r�l \'nem\' -re v�ltasz, minden jelenlegi priv�t album publikuss� v�lik)', 'allow_private_albums', 1), //cpg1.3.0
  		array('Admin �rtes�t�se j�v�hagy�sra v�r� felt�lt�sr�l', 'upl_notify_admin_email', 1), //cpg1.3.0
  		array('Bejelentkezett felhaszn�l�k megtekinthetik a taglist�t', 'allow_memberlist', 1), //cpg1.3.0

        'Saj�t mez�k a k�pek le�r�s�hoz (hagyd �resen, ha nem haszn�lod)',
        array('1. mez�n�v', 'user_field1_name', 0),
        array('2. mez�n�v', 'user_field2_name', 0),
        array('3. mez�n�v', 'user_field3_name', 0),
        array('4. mez�n�v', 'user_field4_name', 0),


        'Cooky be�ll�t�sok',
        array('A szkript �ltal haszn�lt cooky n�v (bbs integr�ci� eset�n gy�z�dj meg r�la, hogy elt�r a bbs cooky n�vt�l)', 'cookie_name', 0),
        array('A szkript �ltal haszn�lt cooky �tvonala', 'cookie_path', 0),

        'Egy�b be�ll�t�sok',
        array('Debug m�d enged�lyez�se', 'debug_mode', 9), //cpg1.3.0
		array('Megjegyz�sek kijelz�se debug m�dban', 'debug_notice', 1), //cpg1.3.0

        '<br /><div align="left"><a name="notice1"></a>(*) * -gal jel�lt mez�ket nem szabad megv�ltoztatni, ha m�r nem �res a k�pt�r.<br />
		<a name="notice2"></a>(**) Ha ezt a be�ll�t�st megv�ltoztatod, csak azok a f�jlok lesznek �rintve, melyeket ett�l kezdve adsz hozz�, ez�rt aj�nlatos ezt a be�ll�t�st nem megv�ltoztatni, ha m�r van f�jl a k�pt�rban. Azonban tetsz�leges albumra �rv�nyes�teni tudod a k�v�nt v�ltoztat�sokat az adminisztr�tori men� &quot;<a href="util.php">Admin eszk�z�k</a>&quot; men�pontj�ban.</div><br />', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File db_ecard.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('DB_ECARD_PHP')) $lang_db_ecard_php = array(
  'title' => 'E-lapok k�ld�se', //cpg1.3.0
  'ecard_sender' => 'Felad�', //cpg1.3.0
  'ecard_recipient' => 'C�mzett', //cpg1.3.0
  'ecard_date' => 'D�tum', //cpg1.3.0
  'ecard_display' => 'E-k�peslap megjelen�t�se', //cpg1.3.0
  'ecard_name' => 'N�v', //cpg1.3.0
  'ecard_email' => 'Email', //cpg1.3.0
  'ecard_ip' => 'IP #', //cpg1.3.0
  'ecard_ascending' => 'n�vekv�', //cpg1.3.0
  'ecard_descending' => 'cs�kken�', //cpg1.3.0
  'ecard_sorted' => 'Sorrendezett', //cpg1.3.0
  'ecard_by_date' => 'd�tum szerint', //cpg1.3.0
  'ecard_by_sender_name' => 'felad� neve szerint', //cpg1.3.0
  'ecard_by_sender_email' => 'felad� e-mail c�me szerint', //cpg1.3.0
  'ecard_by_sender_ip' => 'felad� IP c�me szerint', //cpg1.3.0
  'ecard_by_recipient_name' => 'c�mzett neve szerint', //cpg1.3.0
  'ecard_by_recipient_email' => 'c�mzett e-mail c�me szerint', //cpg1.3.0
  'ecard_number' => 'Rekordok kijelz�se: %s t�l %s �sszesen %s', //cpg1.3.0
  'ecard_goto_page' => 'ugr�s oldalra', //cpg1.3.0
  'ecard_records_per_page' => 'Rekord per lap', //cpg1.3.0
  'check_all' => 'Mind kiv�laszt�sa', //cpg1.3.0
  'uncheck_all' => 'Mind NEM kiv�laszt�sa', //cpg1.3.0
  'ecards_delete_selected' => 'Kiv�lasztott e-lapok t�rl�se', //cpg1.3.0
  'ecards_delete_confirm' => 'Biztosan t�r�lni akarod a rekordokat? Pip�ld ki a n�gyzetet!', //cpg1.3.0
  'ecards_delete_sure' => 'Biztos vagyok benne', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
        'empty_name_or_com' => 'Meg kell adnod a neved �s egy hozz�sz�l�st',
        'com_added' => 'Hozz�sz�l�sod r�gz�tett�k',
        'alb_need_title' => 'Adj nevet az albumnak!',
        'no_udp_needed' => 'Nincs mit m�dos�tani.',
        'alb_updated' => 'Az album m�dos�t�sa megt�rt�nt',
        'unknown_album' => 'A kiv�lasztott album nem l�tezik, vagy nincs felt�lt�si jogosults�god az albumhoz',
        'no_pic_uploaded' => 'Nem t�rt�nt felt�lt�s!<br /><br />Ha t�nyleg kijel�lt�l felt�lt�sre f�jlt, ellen�rizd, hogy a szerveren megengedett-e a felt�lt�s...', //cpg1.3.0
        'err_mkdir' => 'Nem siker�lt a %s k�nyvt�r l�trehoz�sa !',
        'dest_dir_ro' => 'A szkript nem �rhat a %s c�lk�nyvt�rba!',
        'err_move' => 'Nem mozgathat� %s %s -be!',
        'err_fsize_too_large' => 'A felt�lt�tt f�jl m�rete t�l nagy (maximum megengedett: %s x %s)!', //cpg1.3.0
        'err_imgsize_too_large' => 'A felt�lt�tt f�jl m�rete t�l nagy (maximum megengedett: %s KB) !',
        'err_invalid_img' => 'A felt�lt�tt f�jl nem egy �rv�nyes k�pform�tum !',
        'allowed_img_types' => 'Csak %s k�p felt�lt�se megengedett.',
        'err_insert_pic' => 'A \'%s\' f�jl nem adhat� hozz� az albumhoz ', //cpg1.3.0
        'upload_success' => 'A f�jl felt�lt�se sikeres volt<br /><br />J�v�hagy�s ut�n l�that� lesz.', //cpg1.3.0
		'notify_admin_email_subject' => '%s - �rtes�t�s felt�lt�sr�l', //cpg1.3.0
		'notify_admin_email_body' => 'Egy f�jlt felt�lt�tt %s, j�v�hagy�sodra v�r. L�togasd meg %s-t', //cpg1.3.0
        'info' => 'Inform�ci�',
        'com_added' => 'Komment�r hozz�ad�sa megt�rt�nt',
        'alb_updated' => 'Album m�dos�tva',
        'err_comment_empty' => 'Nem adott meg komment�rt !',
        'err_invalid_fext' => 'Csak a k�vetkez� kiterjeszt�s� f�jlok megengedettek: <br /><br />%s.',
        'no_flood' => 'M�r hozz�sz�lt�l a f�jlhoz.<br /><br />Szerkeszd az el�z� hozz�sz�l�sod, ha sz�ks�ges', //cpg1.3.0
        'redirect_msg' => '�tir�ny�t�s folyamatban.<br /><br /><br />Nyomd meg a \'CONTINUE\'-t, ha a k�p nem friss�l automatikusan',
        'upl_success' => 'A f�jl sikeresen hozz�ad�sra ker�lt', //cpg1.3.0
		'email_comment_subject' => 'Hozz�sz�l�s post�zva lett Coppermine Fot�gal�ri�n-n', //cpg1.3.0
		'email_comment_body' => 'Valaki hozz�sz�l�st post�zott a gal�ri�dhoz. L�togasd meg', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
        'caption' => 'K�pal��r�s',
        'fs_pic' => 'teljes m�ret� k�p',
        'del_success' => 't�rl�s sikeres',
        'ns_pic' => 'norm�l m�ret� k�p',
        'err_del' => 'nem lehet t�r�lni',
        'thumb_pic' => 'ikon',
        'comment' => 'megjegyz�s',
        'im_in_alb' => 'k�p az albumban',
        'alb_del_success' => ' \'%s\' album t�r�lve',
        'alb_mgr' => 'Albummenedzser',
        'err_invalid_data' => '�rv�nytelen adat a k�vetkez�ben \'%s\'',
        'create_alb' => 'Album gener�l�sa \'%s\'',
        'update_alb' => 'Album m�dos�t�s \'%s\' n�v: \'%s\' index: \'%s\'',
        'del_pic' => 'F�jl t�rl�se', //cpg1.3.0
        'del_alb' => 'Album t�rl�se',
        'del_user' => 'Felhaszn�l� t�rl�se',
        'err_unknown_user' => 'A kijel�lt felhaszn�l� nem l�tezik !',
        'comment_deleted' => 'A megjegyz�st sikeresen t�r�lt�k',
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
        'confirm_del' => 'Biztosan t�r�lni akarod ezt a f�jlt? \\nA hozz�sz�l�sok is t�rl�dnek.', //js-alert //cpg1.3.0
        'del_pic' => 'A F�JL T�RL�SE', //cpg1.3.0
        'size' => '%s x %s pixel',
        'views' => '%s',
        'slideshow' => 'Diavet�t�s',
        'stop_slideshow' => 'DIAVET�T�S V�GE',
        'view_fs' => 'Teljes m�ret� k�p megtekint�se',
		'edit_pic' => 'Le�r�s szerkeszt�se', //cpg1.3.0
		'crop_pic' => 'Kiv�g�s �s forgat�s', //cpg1.3.0
);

$lang_picinfo = array(
        'title' =>'F�jl inform�ci�', //cpg1.3.0
        'Filename' => 'F�jln�v',
        'Album name' => 'Album n�v',
        'Rating' => 'Oszt�lyoz�s (%s szavazat)',
        'Keywords' => 'Kulcsszavak',
        'File Size' => 'F�jlm�ret',
        'Dimensions' => 'M�retek',
        'Displayed' => 'Megtekint�sek sz�ma',
        'Camera' => 'Kamera',
        'Date taken' => 'Felv�tel d�tuma',
        'Aperture' => 'Apert�ra',
        'Exposure time' => 'Expoz�ci� id�pontja',
        'Focal length' => 'F�kuszt�vols�g',
        'Comment' => 'Megjegyz�s',
        'addFav'=>'Hozz�ad�s a kedvencekhez',
        'addFavPhrase'=>'Kedvencek',
        'remFav'=>'Kiv�tel kedvencekb�l',
		'iptcTitle'=>'IPTC C�m', //cpg1.3.0
		'iptcCopyright'=>'IPTC Copyright', //cpg1.3.0
		'iptcKeywords'=>'IPTC kulcsszavak', //cpg1.3.0
		'iptcCategory'=>'IPTC kateg�ri�k', //cpg1.3.0
		'iptcSubCategories'=>'IPTC alkateg�ri�k', //cpg1.3.0
);

$lang_display_comments = array(
        'OK' => 'OK',
        'edit_title' => 'Hozz�sz�l�s szerkeszt�se',
        'confirm_delete' => 'Biztos t�r�lni k�v�nod a hozz�sz�l�st?', //js-alert
        'add_your_comment' => 'Hozz�sz�l�s hozz�f�z�se',
        'name'=>'N�v',
        'comment'=>'Megjegyz�s',
        'your_name' => 'Anon',
);

$lang_fullsize_popup = array(
        'click_to_close' => 'Klikkelj a k�pre az ablak bez�r�s�hoz',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
        'title' => 'E-k�peslap k�ld�se',
        'invalid_email' => '<b>Figyelmeztet�s</b> : �rv�nytelen e-mail c�m!',
        'ecard_title' => 'Egy e-k�peslap %s -t�l neked',
		'error_not_image' => 'Csak k�peket lehet e-k�peslapk�nt k�ldeni.', //cpg1.3.0
        'view_ecard' => 'Ha az e-k�peslap nem jelenik meg helyesen, klikkelj a k�vetkez� linkre',
        'view_more_pics' => 'Klikkelj erre a linkre tov�bbi k�pek megtekint�s�hez!',
        'send_success' => 'E-k�peslapod tov�bb�tottuk',
        'send_failed' => 'Sajn�lom, de a szerver nem tud e-k�peslapot k�ldeni...',
        'from' => 'Felad�',
        'your_name' => 'Neved',
        'your_email' => 'E-mail c�med',
        'to' => 'C�mzett',
        'rcpt_name' => 'C�mzett neve',
        'rcpt_email' => 'C�mzett e-mail c�me',
        'greetings' => '�dv�zlet',
        'message' => '�zenet',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
        'pic_info' => 'F�jl inform�ci�', //cpg1.3.0
        'album' => 'Album',
        'title' => 'C�m',
        'desc' => 'Le�r�s',
        'keywords' => 'Kulcsszavak',
        'pic_info_str' => '%sx%s - %sKB - %s megtekint�s - %s szavazat',
        'approve' => 'F�jl j�v�hagy�sa', //cpg1.3.0
        'postpone_app' => 'J�v�hagy�s k�s�bb',
        'del_pic' => 'F�jl t�rl�s', //cpg1.3.0
		'read_exif' => 'EXIF inform�ci� �jraolvas�sa', //cpg1.3.0
        'reset_view_count' => 'N�zetts�gsz�ml�l� null�z�sa',
        'reset_votes' => 'Szavazatsz�ml�l� alaphelyzetbe',
        'del_comm' => 'Hozz�sz�l�sok t�rl�se',
        'upl_approval' => 'Felt�lt�s j�v�hagy�s',
        'edit_pics' => 'F�jlok rendez�se', //cpg1.3.0
        'see_next' => 'K�vetkez� f�jl', //cpg1.3.0
        'see_prev' => 'El�z� f�jl', //cpg1.3.0
        'n_pic' => '%s db f�jl', //cpg1.3.0
        'n_of_pic_to_disp' => 'F�jl / oldal', //cpg1.3.0
        'apply' => 'M�dos�t�sok v�grehajt�sa', //cpg1.3.0
		'crop_title' => 'Coppermine k�pszerkeszt�', //cpg1.3.0
		'preview' => 'El�n�zet', //cpg1.3.0
		'save' => 'K�p ment�se', //cpg1.3.0
		'save_thumb' =>'Ment�s ikonk�nt', //cpg1.3.0
		'sel_on_img' =>'A kiv�lasztott r�sznek a k�pen bel�l kell lennie!', //js-alert //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File faq.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FAQ_PHP')) $lang_faq_php = array(
  'faq' => 'Gyakran Ism�telt k�rd�sek', //cpg1.3.0
  'toc' => 'Tartalomjegyz�k', //cpg1.3.0
  'question' => 'K�rd�sek: ', //cpg1.3.0
  'answer' => 'V�laszok: ', //cpg1.3.0
);

if (defined('FAQ_PHP')) $lang_faq_data = array(
  '�ltal�nos GYIK', //cpg1.3.0
  array('Mi�rt kell regisztr�lnom?', 'A regisztr�l�st k�rheti az adminisztr�tor. A regisztr�ci� a tagnak plusz szolg�ltat�sokat biztos�that, mint k�pek felt�lt�s�t, kedvencek lista vezet�s�t, k�pek oszt�lyoz�s�t �s hozz�sz�l�sok post�z�s�t stb.', 'allow_user_registration', '0'), //cpg1.3.0
  array('Hogyan regisztr�ljak?', 'Menj a &quot;Regisztr�ci�&quot; men�be �s t�ltsd ki a k�v�nt mez�ket (�s az opcion�lisakat ha akarod).<br />Ha az adminisztr�tor enged�lyezte az e-mail aktiv�l�st, akkor az inform�ci�k megad�sa ut�n egy e-mailben kapsz �rtes�t�st a regisztr�ci�r�l, valamint arr�l, hogy hogyan aktiv�lhatod a hozz�f�r�sedet, ami a bejelentkez�shez sz�ks�ges.', 'allow_user_registration', '1'), //cpg1.3.0
  array('Hogyan jelentkezhetek be?', 'Menj a &quot;Bejelentkez�s&quot; men�be, add meg a felhaszn�l�neved �s jelszavadat. Ha azt akarod, hogy a legk�zelebbi l�togat�sod alkalm�val automatikusan be legy�l jelentkezve, x-eld ki a &quot;Eml�kezz r�m&quot; n�gyzetet.<br /><b>FONTOS: &quot;Az Eml�kezz r�m&quot; csak akkor m�k�dik, ha a Cooky-kat enged�lyezted �s nem t�r�lted a webhelyeden!</b>', 'offline', 0), //cpg1.3.0
  array('Mi�rt nem tudok bejelentkezni?', 'Regisztr�lt�l, �s v�laszolt�l az e-mailben kapott linkre? Ez aktiv�lja a hozz�f�r�sed. Egy�b bejelentkez�si probl�ma eset�n fordulj a webhely adminisztr�tor�hoz!', 'offline', 0), //cpg1.3.0
  array('Mi t�rt�nik, ha elfelejtettem a jelszavam?', 'Ha l�tsz a webhelyen &quot;Elfelejtettem a jelszavam&quot; linket, haszn�ld! Egy�bk�nt k�rj a webhely adminisztr�tor�t�l �j jelsz�t!', 'offline', 0), //cpg1.3.0
  //array('Mi t�rt�nik, ha megv�ltozott az e-mail c�mem?', 'Egyszer�en l�pj be �s a &quot;Profilom&quot; men�ben v�ltoztasd meg az e-mail c�medet!', 'offline', 0), //cpg1.3.0
  array('Hogyan t�rolhatok egy f�jlt a &quot;Kedvencek&quot; k�z�tt?', 'Klikkelj a k�pre, ha a k�p alatt nem l�that� a &quot;F�jl inform�ci�&quot;, akkor klikkelj a f�jlinform�ci� ikonra (<img src="images/info.gif" width="16" height="16" border="0" alt="F�jl inform�ci�" />), g�rgess le a &quot;F�jl inform�ci�&quot;-hoz, majd klikkelj a &quot;Hozz�ad�s a kedvencekhez&quot; likre!<br /><br />FONTOS: A cooky-kat enged�lyezned kell �s nem t�r�lheted a webhelyeden!', 'offline', 0), //cpg1.3.0
  array('Hogyan oszt�lyozhatom a f�jlokat?', 'Klikkelj az ikoniz�lt k�pre, g�rgess az alj�ra, �s v�laszd a &quot;F�jl oszt�lyoz�sa&quot; r�szben klikkelj a megfelel� oszt�lyzatra!', 'offline', 0), //cpg1.3.0
  array('Hogyan post�zhatok hozz�sz�l�st egy f�jlhoz?', 'Klikkelj az ikoniz�lt k�pre, mej az alj�ra, �s post�zz hozz�sz�l�st!', 'offline', 0), //cpg1.3.0
  array('Hogyan t�lthetek fel f�jlokat?', 'Menj a &quot;Felt�lt�s&quot; men�be �s v�laszd ki az albumot, amelyikbe f�jlt akarsz felt�lteni! Klikkelj a &quot;Browse...&quot; gombra �s v�laszd ki a felt�ltend� f�jlt! Megadhatsz c�met �s k�pal��r�st is ig�ny szerint. V�g�l klikkelj a &quot;TOV�BB&quot; gombra.', 'allow_private_albums', 0), //cpg1.3.0
  array('Hova t�lthetek fel f�jlokat?', 'Az &quot;K�pt�ram&quot; valamelyik album�ba t�lthetsz fel f�jlokat. Az adminisztr�tor enged�lyezheti, hogy felt�lthess f�jlokat a f�k�pt�r egy vagy t�bb album�ba is.', 'allow_private_albums', 0), //cpg1.3.0
  array('Milyen t�pus� �s m�ret� f�jlt t�lthetek fel?', 'A m�retet �s t�pust (jpg,gif,..etc.) az adminisztr�tor d�ntheti el.', 'offline', 0), //cpg1.3.0
  array('Mi az &quot;K�pt�ram&quot;?', 'Az &quot;K�pt�ram&quot; egy szem�lyes k�pt�r, ahova a felhaszn�l� felt�lthet f�jlt, �s menedzselheti.', 'allow_private_albums', 0), //cpg1.3.0
  array('Hogyan hozhatok l�tre, nevezhetek �t, vagy t�r�lhetek albumot az &quot;K�pt�ram&quot;-ban?', '&quot;Admin m�d&quot;-ban kell, hogy legy�l.<br />Menj a &quot;Szem�lyes albumok szerkeszt�se 
 
&quot; men�be �s klikkelj a &quot;�j&quot; gombra. �rd �t az &quot;�j album&quot;-ot a k�v�nt n�vre.<br />A k�pt�rad b�rmelyik megl�v� album�t is �tnevezheted.<br />Klikkelj a &quot;M�dos�t�sok v�grehajt�sa&quot;-ra.', 'allow_private_albums', 0), //cpg1.3.0
  array('Hogyan szab�lyozhatom, hogy a felhaszn�l�k l�thass�k-e az albumomat?','&quot;Admin m�d&quot;-ban kell, hogy legy�l.<br />Menj a &quot;Szem�lyes albumom tulajdons�gai&quot;-ba. Az &quot;Album m�dos�t�sa&quot; leg�rd�l� men�b�l v�laszd ki a k�v�nt albumot.<br />Itt megv�ltoztathatod az album nev�t, le�r�s�t, ikoniz�lt k�p�t, �s korl�tozhatod az albumban l�v� f�jlok megtekint�s�t, oszt�lyoz�s�t, �s hozz�sz�l�sok post�z�s�t.<br />Klikkelj ezut�n az &quot;Album m�dos�t�sa&quot; gombra!.', 'allow_private_albums', 0), //cpg1.3.0
  array('Hogyan l�thatom m�s felhaszn�l� k�pt�r�t?', 'Menj az &quot;Albumlist�ra&quot; �s v�laszd ki a &quot;Felhaszn�l�i k�pt�rak&quot; linket.', 'allow_private_albums', 0), //cpg1.3.0
  array('Mik a Cooky-k?', 'A cooky-k sz�veges adat�llom�nyok, melyeket a webhely k�ld a sz�m�t�g�pedre.<br />A cooky-k �ltal�ban azt teszik lehet�v�, hogy a felhaszn�l� ism�telt bejelentkez�s n�lk�l is visszatal�ljon a webhelyre, �s egy�b hasonl� k�nyelmi lehet�s�geket biztos�t.', 'offline', 0), //cpg1.3.0
  array('Hol kaphatom meg ezt a programot a webhelyemre?', 'Coppermine egy ingyenes multim�di�s k�pt�r, GNU GPL licensszel. Tele van szolg�ltat�sokkal �s k�l�nb�z� platformokon m�k�dik. L�togass el a <a href="http://coppermine.sf.net/">Coppermine honlap</a>-ra tov�bbi inform�ci��rt �s a program let�lt�s��rt.', 'offline', 0), //cpg1.3.0

  'Navig�l�s a webhelyen', //cpg1.3.0
  array('Mi az &quot;Albumlista&quot;?', 'Ez megmutatja a teljes k�pt�rat a kateg�ri�kra mutat� linkeken kereszt�l. A kateg�ria linkje ikoniz�lt k�p is lehet.', 'offline', 0), //cpg1.3.0
  array('Mi az &quot;K�pt�ram&quot;?', 'Ennek a szolg�ltat�snak a seg�ts�g�vel a felhaszn�l�k saj�t k�pt�rt hozhatnak l�tre, ebben l�trehozhatnak, m�dos�thatnak �s t�r�lhetnek albumokat, valamint k�peket t�lthetnek fel ide.', 'allow_private_albums', 0), //cpg1.3.0
  array('Mi a k�l�nbs�g az &quot;Admin m�d&quot; �s a &quot;Felhaszn.m�d&quot; k�z�tt?', 'Adminisztr�tor m�dban a felhaszn�l� m�dos�thatja a k�pt�r�t (�s m�s�t, ha az adminisztr�tor ezt enged�lyezte).', 'allow_private_albums', 0), //cpg1.3.0
  array('Mi a &quot;Felt�lt�se&quot;?', 'Ez a szolg�ltat�s lehet�v� teszi a felhaszn�l�knak f�jlok felt�lt�s�t egy az �ltalad vagy az adminisztr�tor �ltal megadott k�pt�rba (m�retet �s t�pust az adminisztr�tor enged�lyez).', 'allow_private_albums', 0), //cpg1.3.0
  array('Mi a &quot;Friss felt�lt�sek&quot;?', 'Ez a szolg�ltat�s mutatja az utolj�ra felt�lt�tt f�jlokat.', 'offline', 0), //cpg1.3.0
  array('Mi a &quot;Friss hozz�sz�l�sok&quot;?', 'Ez a szolg�ltat�s mutatja az utolj�ra post�zott hozz�sz�l�sokat a f�jlokhoz.', 'offline', 0), //cpg1.3.0
  array('Mi a &quot;Legt�bbsz�r n�zett&quot;?', 'Ez a szolg�ltat�s mutatja az �sszes felhaszn�l� �ltal legt�bbsz�r n�zett f�jlokat, f�ggetlen�l att�l, hogy bejelentkeztek-e, vagy nem.', 'offline', 0), //cpg1.3.0
  array('Mi a &quot;Legt�bb szavazat&quot;?', 'Ez a szolg�ltat�s mutatja legt�bb szavazatot kapott f�jlokat, az �tlagoszt�lyzattal (p�ld�ul ha 5 felhaszn�l� mindegyike <img src="images/rating3.gif" width="65" height="14" border="0" alt="" />-t adott, akkor a k�p �tlagoszt�lyzata <img src="images/rating3.gif" width="65" height="14" border="0" alt="" />. Ha � felhaszn�l� 1-t�l 5-ig oszt�lyozott (1,2,3,4,5), akkor az �tlagoszt�lyzat <img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> lesz.)<br />Az oszt�lyzat <img src="images/rating5.gif" width="65" height="14" border="0" alt="best" />-t� (legjobb) megy <img src="images/rating0.gif" width="65" height="14" border="0" alt="worst" />-ig (legrosszabb).', 'offline', 0), //cpg1.3.0
  array('Mi a &quot;Kedvencek&quot;?', 'Ez a szolg�ltat�s a felhaszn�l� sz�m�ra lehet�v� teszi, hogy kedvenc k�peire cooky seg�ts�g�vel eml�kezzen a sz�m�t�g�p.', 'offline', 0), //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// File forgot_passwd.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FORGOT_PASSWD_PHP')) $lang_forgot_passwd_php = array(
  'forgot_passwd' => 'Jelsz� eml�keztet�', //cpg1.3.0
  'err_already_logged_in' => 'M�r bejelentkezt�l!', //cpg1.3.0
  'enter_username_email' => 'Add meg a felhaszn�l�neved �s e-mail c�medet!', //cpg1.3.0
  'submit' => 'mehet', //cpg1.3.0
  'failed_sending_email' => 'A jelsz�-eml�keztet� e-mail kik�ld�se nem siker�lt!', //cpg1.3.0
  'email_sent' => 'Egy e-mailt k�ldt�nk felhaszn�l�n�vvel �s jelsz�val %s-nek', //cpg1.3.0
  'err_unk_user' => 'A kiv�lasztott felhaszn�l� nem l�tezik!', //cpg1.3.0
  'passwd_reminder_subject' => '%s - Jelsz�-eml�keztet�', //cpg1.3.0
  'passwd_reminder_body' => 'K�rted, hogy eml�keztess�nk a bejelentkez�si adataidra:
Felhaszn�l�n�v: %s
Jelsz�: %s
Klikkelj %s -ra a bejelentkez�shez.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
        'group_name' => 'Csoport megnevez�se',
        'disk_quota' => 'Diszk kv�ta',
        'can_rate' => 'Oszt�lyozhat f�jlokat', //cpg1.3.0
        'can_send_ecards' => 'K�ldhet e-k�peslapot',
        'can_post_com' => 'Hozz�sz�l�st k�ldhet',
        'can_upload' => 'Felt�lthet f�jlokat', //cpg1.3.0
        'can_have_gallery' => 'Lehet szem�lyes k�pt�ra',
        'apply' => 'M�dos�t�sok v�grehajt�sa',
        'create_new_group' => '�j csoport l�trehoz�sa',
        'del_groups' => 'Kijel�lt csoport(ok) t�rl�se ',
        'confirm_del' => 'Figyelmeztet�s: ha t�r�lsz egy csoportot, a hozz� tartoz� felhaszn�l�k �thelyez�dnek a \'Regisztr�ltak\' csoportba !\n\nFolytatod ?', //js-alert //cpg1.3.0
        'title' => 'Felhaszn�l�csoportok menedzsel�se',
        'approval_1' => 'Nyilv�nos felt�lt�s j�v�hagy�s (1)',
        'approval_2' => 'Priv�t felt�lt�s j�v�hagy�s (2)',
		'upload_form_config' => 'Felt�lt�s a konfigur�ci�b�l', //cpg1.3.0
		'upload_form_config_values' => array( 'Csak egyenk�nti felt�lt�s', 'Csak csoportos felt�lt�s', 'Csak URI felt�lt�s', 'Csak ZIP felt�lt�s', 'F�jl-URI', 'F�jl-ZIP', 'URI-ZIP', 'F�jl-URI-ZIP'), //cpg1.3.0
		'custom_user_upload'=>'A felhaszn�l�k be�ll�thatj�k a felt�lt�s sorok sz�m�t?', //cpg1.3.0
		'num_file_upload'=>'F�jl felt�lt�s sorok maximum/pontos sz�ma', //cpg1.3.0
		'num_URI_upload'=>'URI felt�lt�s sorok maximum/pontos sz�ma', //cpg1.3.0
        'note1' => '<b>(1)</b> A nyilv�nos albumba t�rt�n� felt�lt�s adminisztr�tori j�v�hagy�st ig�nyel',
        'note2' => '<b>(2)</b> A felhaszn�l� album�ba t�rt�n� felt�lt�s adminisztr�tori j�v�hagy�st ig�nyel',
        'notes' => 'Megjegyz�sek',
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
        'welcome' => '�dv�z�llek!',
);

$lang_album_admin_menu = array(
        'confirm_delete' => 'Biztos t�r�lni akarod az albumot? \\nMinden f�jl �s hozz�sz�l�s is t�rl�dik!', //js-alert //cpg1.3.0
        'delete' => 'T�RL�S',
        'modify' => 'TULAJDONS�GOK',
        'edit_pics' => 'SZERKESZT�S',
);

$lang_list_categories = array(
        'home' => 'Home',
        'stat1' => '<b>[pictures]</b> f�jl <b>[albums]</b> albumban �s <b>[cat]</b> kateg�ri�ban <b>[comments]</b> hozz�sz�l�ssal, megtekint�sek sz�ma: <b>[views]</b>', //cpg1.3.0
        'stat2' => '<b>[pictures]</b> f�jl <b>[albums]</b> albumban, megtekint�sek sz�ma: <b>[views]</b>', //cpg1.3.0
        'xx_s_gallery' => '%s k�pt�ra',
        'stat3' => '<b>[pictures]</b> f�jl <b>[albums]</b> albumban <b>[comments]</b> hozz�sz�l�ssal, megtekint�sek sz�ma: <b>[views]</b>' //cpg1.3.0
);

$lang_list_users = array(
        'user_list' => 'Felhaszn�l�k list�ja',
        'no_user_gal' => 'Nincs felhaszn�l� a k�pt�rban',
        'n_albums' => '%s album(ok)',
        'n_pics' => '%s f�jl(ok)' //cpg1.3.0
);

$lang_list_albums = array(
        'n_pictures' => '%s f�jl', //cpg1.3.0
        'last_added' => ', utols� felt�lt�s: %s',
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
        'login' => 'Bejelentkez�s',
        'enter_login_pswd' => 'Adja meg felhaszn�l�nev�t �s jelszav�t a bejelentkez�shez',
        'username' => 'Felhaszn�l�n�v',
        'password' => 'Jelsz�',
        'remember_me' => 'Eml�kezz r�m',
        'welcome' => '�dv�z�llek %s ...',
        'err_login' => '*** A bejelentkez�s sikertelen, pr�b�ld �jra ***',
        'err_already_logged_in' => 'M�r bejelentkezt�l!',
		'forgot_password_link' => 'Elfelejtettem a jelszavam', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
        'logout' => 'Kijelentkez�s',
        'bye' => 'Viszontl�t�sra %s ...',
        'err_not_loged_in' => 'Nem vagy bejelentkezve!',
);

// ------------------------------------------------------------------------- //
// File phpinfo.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('PHPINFO_PHP')) $lang_phpinfo_php = array(
  'php_info' => 'PHP inf�', //cpg1.3.0
  'explanation' => 'Ezt az �zenetet a <a href="http://www.php.net/phpinfo">phpinfo()</a> PHP f�ggv�ny gener�lta a Copermine rendszerben (az �zenet jobb sarka lev�g�sra ker�lhet).', //cpg1.3.0
  'no_link' => 'Saj�t phpinf�d megmutat�sa m�soknak biztons�gi rizik�t jelenthet, ez�rt ez az oldal csak admin m�dban l�that�. Err�l az oldlr�l nem post�zhatsz linket m�soknak, ezekhez a hozz�f�r�s le lesz tiltva.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
        'upd_alb_n' => '%s album m�dos�t�sa ',
        'general_settings' => '�ltal�nos be�ll�t�sok',
        'alb_title' => 'Album c�m',
        'alb_cat' => 'Album kateg�ria',
        'alb_desc' => 'Album le�r�s',
        'alb_thumb' => 'Album ikon',
        'alb_perm' => 'Album jogosults�gok',
        'can_view' => 'Albumot l�thatja: ',
        'can_upload' => 'L�togat�k felt�lthetnek k�pet',
        'can_post_comments' => 'L�togat�k k�ldhetnek hozz�sz�l�sokat',
        'can_rate' => 'L�togat�k oszt�lyozhatj�k a k�peket',
        'user_gal' => 'Felhaszn�l�i k�pt�r',
        'no_cat' => '* Nincs kateg�ria *',
        'alb_empty' => 'Az album �res',
        'last_uploaded' => 'Utolj�ra felt�lt�tt',
        'public_alb' => 'Mindenki (nyilv�nos album)',
        'me_only' => 'Csak �n',
        'owner_only' => 'Csak a (%s) album tulajdonosa',
        'groupp_only' => 'Csak a \'%s\' csoport tagjai',
        'err_no_alb_to_modify' => 'Nincs m�dos�that� album az adatb�zisban.',
        'update' => 'Album m�dos�t�sa', //cpg1.3.0
		'notice1' => '(*) a %sgroups%s be�ll�t�sokt�l f�gg�en', //cpg1.3.0 (do not translate %s!)
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
        'already_rated' => 'Sajn�lom, de m�r oszt�lyoztad ezt a f�jlt', //cpg1.3.0
        'rate_ok' => 'Oszt�lyzatod elfogadtuk',
		'forbidden' => 'Nem oszt�lyozhatod a saj�t k�peidet.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
B�r a {SITE_NAME} adminisztr�tora mindent elk�vet, hogy amilyen gyorsan csak lehet, szerkesszen vagy t�r�lj�n minden kifog�solhat� dokumentumot, lehetetlen minden k�ldem�ny ellen�rz�se. K�rj�k ez�rt annak meg�rt�s�t, hogy minden erre a weblapra c�mzett k�ldem�ny annak szerz�je n�zet�t �s v�lem�ny�t fejezi ki, �s nem az adminisztr�tor�t, illetve webmester�t (kiv�ve az �ltaluk post�zott k�ldem�nyeket). Enn�l fogva nem tudunk �rt�k felel�ss�get v�llalni.<br />
<br />
Elfogadod, hogy nem post�zol semmilyen s�rt�, obszc�n, vulg�ris, r�galmaz�, gy�l�lk�d�, fenyeget�, szexu�lis tartalm�, vagy b�rmilyen m�s olyan tartalm� anyagot, amely �rv�nyes t�rv�nyt s�rt. Elfogadod, hogy a {SITE_NAME} webmester�nek, adminisztr�tor�nak, vagy moder�tor�nak b�rmikor jog�ban �ll b�rmilyen tartalmat sz�ks�g eset�n t�r�lni, vagy szerkeszteni. Mint felhaszn�l� egyet�rtesz a k�z�lt inform�ci�k adatb�zisban t�rt�n� t�rol�s�hoz. B�r a webmester, illetve adminisztr�tor nem adja ki harmadik feleknek ezeket az inform�ci�kat a hozz�j�rul�sod n�lk�l, nem tehet� felel�ss� semmilyen olyan hacker k�s�rlet�rt, melyek az adatok kompromitt�l�s�hoz vezet.<br />
<br />
Ez a weblap cooky form�j�ban inform�ci�t t�rol a sz�m�t�g�peden. Ezek a cooky-k csak azt a c�lt szolg�lj�k, hogy fokozz�k a n�zhet�s�gi �lm�nyt. Az email c�m csak a regisztr�ci�s adataidnak �s jelszavadnak nyugt�z�s�ra szolg�l.<br />
<br />
Az 'Egyet�rtek'-re klikkelve elfogadod ezeket a felt�teleket.
EOT;

$lang_register_php = array(
        'page_title' => 'Felhaszn�l� regisztr�ci�',
        'term_cond' => 'Regisztr�ci�s felt�telek',
        'i_agree' => 'Egyet�rtek',
        'submit' => 'Regisztr�l�s',
        'err_user_exists' => 'A megadott felhaszn�l�n�v m�r l�tezik, adjon meg m�sikat',
        'err_password_mismatch' => 'A k�t jelsz� nem egyezik, add meg �jra',
        'err_uname_short' => 'A felhaszn�l�n�v legal�bb 2 karakter hossz� kell, hogy legyen',
        'err_password_short' => 'A jelsz� legal�bb 2 karakter hossz� kell, hogy legyen',
        'err_uname_pass_diff' => 'A felhaszn�l�n�vnek �s a jelsz�nak k�l�nb�znie kell',
        'err_invalid_email' => '�rv�nytelen email c�m',
        'err_duplicate_email' => 'Egy m�sik felhaszn�l� m�r regisztr�lt ezzel az email c�mmel',
        'enter_info' => 'Regisztr�ci�s inform�ci�k megad�sa',
        'required_info' => 'K�telez� adat',
        'optional_info' => 'Opcion�lis adat',
        'username' => 'Felhaszn�l�n�v',
        'password' => 'Jelsz�',
        'password_again' => 'Jelsz� m�g egyszer',
        'email' => 'Email',
        'location' => 'Tart�zkod�si hely',
        'interests' => '�rdekl�d�si k�r',
        'website' => 'Honlap',
        'occupation' => 'Foglalkoz�s',
        'error' => 'HIBA',
        'confirm_email_subject' => '%s - Regisztr�ci� nyugt�z�sa',
        'information' => 'Inform�ci�',
        'failed_sending_email' => 'A regisztr�ci�s meger�s�t� emailt nem siker�lt elk�ldeni !',
        'thank_you' => 'K�sz�nj�k, hogy regisztr�lt�l.<br /><br />K�ldt�nk egy emailt a megadott email c�mre, amiben megadtuk, hogy hogyan aktiv�lhatod felhaszn�l�i hozz�f�r�sed.',
        'acct_created' => 'Felhaszn�l�i hozz�f�r�sed l�trehoztuk �s bejelentkezhetsz a felhaszn�l�neveddel �s jelszavaddal',
        'acct_active' => 'Felhaszn�l�i hozz�f�r�sed aktiv�ltuk �s bejelentkezhetsz a felhaszn�l�neveddel �s jelszavaddal',
        'acct_already_act' => 'Felhaszn�l�i hozz�f�r�sed m�r akt�v !',
        'acct_act_failed' => 'Ezt a felhaszn�l�i hozz�f�r�st nem lehet aktiv�lni !',
        'err_unk_user' => 'A kiv�lasztott felhaszn�l� nem l�tezik !',
        'x_s_profile' => '%s profilja',
        'group' => 'Csoport',
        'reg_date' => 'Csatlakoz�s ideje',
        'disk_usage' => 'T�rfelhaszn�l�s',
        'change_pass' => 'Jelsz� megv�ltoztat�sa',
        'current_pass' => 'Jelenlegi jelsz�',
        'new_pass' => '�j jelsz�',
        'new_pass_again' => '�j jelsz� m�g egyszer',
        'err_curr_pass' => 'A jelenlegi jelsz� hib�s',
        'apply_modif' => 'M�dos�t�sok v�grehajt�sa',
        'change_pass' => 'Jelsz� megv�ltoztat�sa',
        'update_success' => 'Profilod aktualiz�ltuk',
        'pass_chg_success' => 'Jelszavad megv�ltoztattuk',
        'pass_chg_error' => 'Jelszavad nem v�ltoztattuk meg',
		'notify_admin_email_subject' => '%s - regisztr�ci�s �rtes�t�s', //cpg1.3.0
		'notify_admin_email_body' => 'Egy �j felhaszn�l� "%s" n�vvel regisztr�lt a k�pt�radba', //cpg1.3.0
);

$lang_register_confirm_email = <<<EOT
K�sz�nj�k, hogy regisztr�lt�l '{SITE_NAME}' weblapunkon

Felhaszn�l�neved : "{USER_NAME}"
Jelszavad : "{PASSWORD}"

Felhazn�l�i hozz�f�r�sed aktiv�l�s�hoz az al�bbi linkre kell klikkelned.

{ACT_LINK}

�dv�zlettel,

A '{SITE_NAME}' adminisztr�tora

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
        'title' => 'Hozz�sz�l�sok megtekint�se',
        'no_comment' => 'Nincs hozz�sz�l�s',
        'n_comm_del' => '%s hozz�sz�l�s(ok) t�r�lve',
        'n_comm_disp' => 'Megjelen�tend� hozz�sz�l�sok sz�ma',
        'see_prev' => 'El�z�',
        'see_next' => 'K�vetkez�',
        'del_comm' => 'Kijel�lt hozz�sz�l�sok t�r�lve',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
        0 => 'Keres�s a k�pt�rban',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
        'page_title' => '�j f�jl keres�se', //cpg1.3.0
        'select_dir' => 'K�nyvt�r v�laszt�sa',
        'select_dir_msg' => 'Ez a funkci� lehet�v� teszi egy k�teg - FTP-vel a szerverre m�solt - f�jl hozz�ad�s�t a k�pt�rhoz.<br /><br />V�laszd ki a k�nyvt�rat, ahonnan hozz� akarsz adni a k�pt�rhoz f�jlokat', //cpg1.3.0
        'no_pic_to_add' => 'Nincs hozz�adhat� f�jl', //cpg1.3.0
        'need_one_album' => 'Ehhez a funkci�hoz legal�bb egy albumnak l�teznie kell',
        'warning' => 'Figyelmeztet�s',
        'change_perm' => 'a szkript nem tud �rni ebbe a k�nyvt�rba, 755-r�l 777-re kell cser�lned a jogosults�g�t miel�tt hozz�adsz f�jlokat!', //cpg1.3.0
        'target_album' => '<b>Adja hozz� a </b>"%s"<b> k�nyvt�rb�l a f�jlokat a </b>%s albumhoz', //cpg1.3.0
        'folder' => 'K�nyvt�r',
        'image' => 'K�p',
        'album' => 'Album',
        'result' => 'Eredm�ny',
        'dir_ro' => 'Nem �rhat�. ',
        'dir_cant_read' => 'Nem olvashat�. ',
        'insert' => '�j f�jlok hozz�ad�sa a k�pt�rhoz', //cpg1.3.0
        'list_new_pic' => '�j f�jlok felsorol�sa', //cpg1.3.0
        'insert_selected' => 'Kijel�lt f�jlok hozz�ad�sa', //cpg1.3.0
        'no_pic_found' => 'Nincs �j f�jl', //cpg1.3.0
        'be_patient' => 'L�gy t�relemmel, a szkriptnek id� kell a f�jlok hozz�ad�s�hoz', //cpg1.3.0
		'no_album' => 'nem v�lasztott�l albumot',  //cpg1.3.0
        'notes' =>  '<ul>'.
                                '<li><b>OK</b> : azt jelenti, hogy a f�jl hozz�ad�sa sikeres volt'. //cpg1.3.0
                                '<li><b>DP</b> : azt jelenti, hogy a f�jl m�r az adatb�zisban volt'. //cpg1.3.0
                                '<li><b>PB</b> : azt jelenti, hogy a f�jl nem volt hozz�adhat�, ellen�rizd a konfigur�ci�t �s a f�jlokat tartalmaz� k�nyvt�rak jogosults�gait '. //cpg1.3.0
		                        '<li><b>NA</b> : azt jelenti, hogy nem v�lasztottad ki az albumot, melybe a f�jlokat fel akarod t�lteni, �ss \'<a href="javascript:history.back(1)">back</a>\'-t �s v�lassz ki egy albumot. Ha nincs egy albumod se, akkor <a href="albmgr.php">el�sz�r gener�lj egyet</a></li>'.
                                '<li>Ha az OK, DP, PB \'jelek\' nem l�that�k, klikkelj a hib�s f�jlra a PHP hiba�zenet�nek megjelen�t�s�hez'. //cpg1.3.0
                                '<li>Ha a browser leid�z�tett, nyomja meg a friss�t�s gombot'.
                                '</ul>',
								'select_album' => 'album kiv�laszt�sa', //cpg1.3.0
								'check_all' => 'Mindet kijel�l', //cpg1.3.0
								'uncheck_all' => 'Mindet NEM kijel�l', //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //

// Void


// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
        'title' => 'F�jl felt�lt�se', //cpg1.3.0
		'custom_title' => 'Be�ll�tott lek�r�si �rlap', //cpg1.3.0
		'cust_instr_1' => 'Kiv�laszthatsz be�ll�tott sz�m� felt�lt�si sort. Azonban nem l�pheted t�l az al�bbi limitet.', //cpg1.3.0
		'cust_instr_2' => 'Sor sz�m lek�r�s', //cpg1.3.0
		'cust_instr_3' => 'F�jl felt�lt�si sok: %s', //cpg1.3.0
		'cust_instr_4' => 'URI/URL felt�lt�si sorok: %s', //cpg1.3.0
		'cust_instr_5' => 'URI/URL felt�lt�si sorok:', //cpg1.3.0
		'cust_instr_6' => 'F�jl felt�lt�si sorok:', //cpg1.3.0
		'cust_instr_7' => 'Add meg minden t�pusra a jelenleg tervezett felt�lt�si sorok sz�m�t.  Ut�na �ss \'Folytat�s\'-t. ', //cpg1.3.0
		'reg_instr_1' => '�rv�nytelen akci� ebben a gener�l�sban.', //cpg1.3.0
		'reg_instr_2' => 'Most felt�ltheted a f�jljaidat az al�bbi felt�lt�si sorok haszn�lat�val. A kliensr�l a szerverre felt�ltend� f�jlok m�rete egyenk�nt nem l�pheti t�l a %s KB hat�rt. A \'F�jl felt�lt�s\' �s \'URI/URL Felt�lt�s\' r�szben felt�lt�tt ZIP f�jlok t�m�r�tettek maradnak.', //cpg1.3.0
		'reg_instr_3' => 'Ha azt akarod, hogy a ZIP f�jlod kicsomagol�sra ker�lj�n, haszn�ld a \'Kit�m�r�t� ZIP felt�lt�s\' r�szben tal�lhat� sort.', //cpg1.3.0
		'reg_instr_4' => 'Az URI/URL felt�lt�si r�szben add meg a f�jl el�r�si �tvonalat a k�vetkez� m�don: http://www.mysite.com/images/example.jpg', //cpg1.3.0
		'reg_instr_5' => 'Ha kit�lt�tted az �rlapot, nyomj \'Folytat�s\'-t.', //cpg1.3.0
		'reg_instr_6' => 'Kit�m�r�t� ZIP felt�lt�s:', //cpg1.3.0
		'reg_instr_7' => 'F�jl felt�lt�s:', //cpg1.3.0
		'reg_instr_8' => 'URI/URL felt�lt�s:', //cpg1.3.0
		'error_report' => 'Hibajelent�s', //cpg1.3.0
		'error_instr' => 'A k�vetkez� felt�lt�sek hib�t eredm�nyeztek:', //cpg1.3.0
		'file_name_url' => 'F�jln�v/URL', //cpg1.3.0
		'error_message' => 'Hiba�zenet', //cpg1.3.0
		'no_post' => 'Nem ker�lt felt�lt�sre f�jl a post�z�ssal.', //cpg1.3.0
		'forb_ext' => 'Tiltott f�jlkiterjeszt�s.', //cpg1.3.0
		'exc_php_ini' => 'T�ll�pted a php.ini-ben megengedett f�jlm�retet.', //cpg1.3.0
		'exc_file_size' => 'T�ll�pted a CPG-ben megengedett f�jlm�retet.', //cpg1.3.0
		'partial_upload' => 'Csak r�szleges felt�lt�s.', //cpg1.3.0
		'no_upload' => 'Nem t�rt�nt felt�lt�s.', //cpg1.3.0
		'unknown_code' => 'Ismeretlen PHP felt�lt�si hibak�d.', //cpg1.3.0
		'no_temp_name' => 'Nincs felt�lt�s - Nincs temp n�v.', //cpg1.3.0
		'no_file_size' => 'Nem tartalmaz adatot / hib�s adat', //cpg1.3.0
		'impossible' => 'Nem lehet �tmozgatni.', //cpg1.3.0
		'not_image' => 'Nem / hib�s k�p', //cpg1.3.0
		'not_GD' => 'Nem GD kiterjeszt�s.', //cpg1.3.0
		'pixel_allowance' => 'Pixel hat�rt t�ll�pted.', //cpg1.3.0
		'incorrect_prefix' => 'Helytelen URI/URL prefix', //cpg1.3.0
		'could_not_open_URI' => 'Nem tudtam megnyitni az URI-t.', //cpg1.3.0
		'unsafe_URI' => 'Nem igazolhat� a biztons�g.', //cpg1.3.0
		'meta_data_failure' => 'Meta adat hiba', //cpg1.3.0
		'http_401' => '401 Jogosulatlan', //cpg1.3.0
		'http_402' => '402 fizet�si k�telezetts�g', //cpg1.3.0
		'http_403' => '403 tiltott', //cpg1.3.0
		'http_404' => '404 nem tal�lhat�', //cpg1.3.0
		'http_500' => '500 bels� szerver hiba', //cpg1.3.0
		'http_503' => '503 szerver nem el�rhet�', //cpg1.3.0
		'MIME_extraction_failure' => 'MIME nem volt meghat�rozhat�.', //cpg1.3.0
		'MIME_type_unknown' => 'Ismeretlen MIME tipus', //cpg1.3.0
		'cant_create_write' => 'Nem lehet �rhat� f�jlt l�trehozni.', //cpg1.3.0
		'not_writable' => 'Nem lehet �rni az �rhat� f�jlba.', //cpg1.3.0
		'cant_read_URI' => 'Nem olvashat� az URI/URL', //cpg1.3.0
		'cant_open_write_file' => 'Nem nyithat� meg az URI �rhat� f�jl.', //cpg1.3.0
		'cant_write_write_file' => 'Nem lehet �rni az URI �rhat� f�jlba.', //cpg1.3.0
		'cant_unzip' => 'Nem lehet kicsomagolni.', //cpg1.3.0
		'unknown' => 'Ismeretlen hiba', //cpg1.3.0
		'succ' => 'Sikeres felt�lt�sek', //cpg1.3.0
		'success' => '%s felt�lt�s sikeres volt.', //cpg1.3.0
		'add' => '�ss \'Folytat�s\'-t a f�jlok albumhoz t�rt�n� hozz�ad�s�hoz.', //cpg1.3.0
		'failure' => 'Felt�lt�s hiba', //cpg1.3.0
		'f_info' => 'F�jl inform�ci�', //cpg1.3.0
		'no_place' => 'Az el�z� f�jlt nem siker�lt elhelyezni.', //cpg1.3.0
		'yes_place' => 'Az el�z� f�jlt siker�lt elhelyezni.', //cpg1.3.0
        'max_fsize' => 'Maximum megengedett f�jlm�ret %s KB',
        'album' => 'Album',
        'picture' => 'F�jl', //cpg1.3.0
        'pic_title' => 'F�jl c�me', //cpg1.3.0
        'description' => 'F�jl le�r�sa', //cpg1.3.0
        'keywords' => 'Kulcsszavak (sz�k�z�kkel elv�lasztva)',
        'err_no_alb_uploadables' => 'Nincs album, ahova enged�lyezett a felt�lt�s',
		'place_instr_1' => 'Tedd a f�jlokat az albumba ez�ttal.  Most megadhatod a relev�ns inform�ci�kat minden f�jlhoz.', //cpg1.3.0
		'place_instr_2' => 'T�bb f�jlt kell elhelyezni. Nyomj \'Folytat�s\'-t.', //cpg1.3.0
		'process_complete' => 'Minden f�jlt sikeresen elhelyezt�l.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
        'title' => 'Felhaszn�l�k menedzsel�se',
        'name_a' => 'N�v n�vekv�',
        'name_d' => 'N�v cs�kken�',
        'group_a' => 'Csoport n�vekv�',
        'group_d' => 'Csoport cs�kken�',
        'reg_a' => 'Reg. d�tum n�vekv�',
        'reg_d' => 'Reg. d�tum cs�kken�',
        'pic_a' => 'K�psz�m n�vekv�',
        'pic_d' => 'K�psz�m cs�kken�',
        'disku_a' => 'Diszkfelhaszn�l�s n�vekv�',
        'disku_d' => 'Diszkfelhaszn�l�s cs�kken�',
		'lv_a' => 'Utols� l�togat�s n�vekv�', //cpg1.3.0
		'lv_d' => 'Utols� l�togat�s cs�kken�', //cpg1.3.0
        'sort_by' => 'Felhaszn�l�k sorrendez�se',
        'err_no_users' => 'Nincs felhaszn�l� !',
        'err_edit_self' => 'Nem szerkesztheted a saj�t profilod, haszn�ld az \'Profilom\' men�pontot',
        'edit' => 'SZERKESZT',
        'delete' => 'T�R�L',
        'name' => 'Felhaszn�l�n�v',
        'group' => 'Csoport',
        'inactive' => 'Inakt�v',
        'operations' => 'M�veletek',
        'pictures' => 'F�jlok', //cpg1.3.0
        'disk_space' => 'Felhaszn�lt t�rhely / kv�ta',
        'registered_on' => 'Regisztr�lva',
		'last_visit' => 'Utols� l�togat�s', //cpg1.3.0
        'u_user_on_p_pages' => '%d felhaszn�l� %d oldalon',
        'confirm_del' => 'Bizt�s t�r�lni k�v�nod a felhaszn�l�t? \\nMinden f�jlja �s albuma is t�rl�dni fog.', //js-alert //cpg1.3.0
        'mail' => 'MAIL',
        'err_unknown_user' => 'A kijel�lt felhaszn�l� nem l�tezik !',
        'modify_user' => 'Felhaszn�l� m�dos�t�sa',
        'notes' => 'Megjegyz�sek',
        'note_list' => '<li>Ha nem k�v�nod megv�ltoztatni az aktu�lis jelsz�t, hagyd �resen a "jelsz�" mez�t',
        'password' => 'Jelsz�',
        'user_active' => 'Felhaszn�l� akt�v',
        'user_group' => 'Felhaszn�l� csoport',
        'user_email' => 'Felhaszn�l� email c�me',
        'user_web_site' => 'Felhaszn�l� honlapja',
        'create_new_user' => '�j felhaszn�l� l�trehoz�sa',
        'user_location' => 'Felhaszn�l� lakhelye',
        'user_interests' => 'Felhaszn�l� �rdekl�d�si k�re',
        'user_occupation' => 'Felhaszn�l� foglalkoz�sa',
		'latest_upload' => 'Friss felt�lt�sek', //cpg1.3.0
		'never' => 'soha', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => 'F�jlok �tm�retez�se', //cpg1.3.0
        'what_it_does' => 'Mi t�rt�njen',
        'what_update_titles' => 'C�mek aktualiz�l�sa f�jlnevekb�l',
        'what_delete_title' => 'C�mek t�rl�se',
        'what_rebuild' => 'Ikonok �s �tm�retezett k�pek �jragener�l�sa',
        'what_delete_originals' => 'Eredeti k�pek fel�l�r�sa az �tm�retezettekkel',
        'file' => 'F�jl',
        'title_set_to' => 'c�m be�ll�t�sa ..',
        'submit_form' => '�rv�nyes�t�s',
        'updated_succesfully' => 'sikeres m�dos�t�s',
        'error_create' => 'HIBA a gener�l�s sor�n',
        'continue' => 'T�bb k�p feldolgoz�sa',
        'main_success' => 'A % f�jlok felhaszn�l�sa els�dleges f�jlk�nt sikeres volt', //cpg1.3.0
        'error_rename' => '%s %s -ra �tnevez�se sor�n HIBA',
        'error_not_found' => 'A % f�jlok nem tal�lhat�k',
        'back' => 'vissza a f�oldalra',
        'thumbs_wait' => 'Ikonok �s/vagy �tm�retezett k�pek aktualiz�l�sa, k�rlek v�rj...',
        'thumbs_continue_wait' => 'Ikonok �s/vagy �tm�retezett k�pek aktualiz�l�s�nak folytat�sa...',
        'titles_wait' => 'C�mek aktualiz�l�sa, k�rlek v�rj...',
        'delete_wait' => 'C�mek t�rl�se, k�rlek v�rj...',
        'replace_wait' => 'Eredeti k�pek fel�l�r�sa az �tm�retezettekkel, k�rlek v�rj...',
        'instruction' => 'Gyors �ttekint�s',
        'instruction_action' => 'M�velet kiv�laszt�sa',
        'instruction_parameter' => 'Param�terek be�ll�t�sa',
        'instruction_album' => 'Album kiv�laszt�sa',
        'instruction_press' => 'Nyomj &quot;%s&quot;-t',
        'update' => 'Ikonok �s/vagy �tm�retezett f�nyk�pek aktualiz�l�sa',
        'update_what' => 'Mit kell aktualiz�lni',
        'update_thumb' => 'Csak ikonokat',
        'update_pic' => 'Csak �tm�retezett k�peket',
        'update_both' => 'Ikonokat �s �tm�retezett k�peket is',
        'update_number' => 'Klikkel�senk�nt feldolgozand� k�pek sz�ma',
        'update_option' => '(Pr�b�ld cs�kkenteni ezt az �rt�ket, ha leid�z�t�si probl�m�t �szlelsz)',
        'filename_title' => 'F�jln�v &#8594; F�jl c�m', //cpg1.3.0
        'filename_how' => 'Hogy legyen m�dos�tva a f�jln�v',
        'filename_remove' => 'A jpg v�gz�d�s t�rl�se �s _ (alulvon�s) helyettes�t�se sz�k�zzel',
        'filename_euro' => '2003_11_23_13_20_20.jpg �tnevez�se 23/11/2003 13:20-ra',
        'filename_us' => '2003_11_23_13_20_20.jpg �tnevez�se 11/23/2003 13:20-ra',
        'filename_time' => '2003_11_23_13_20_20.jpg �tnevez�se 13:20ra',
        'delete' => 'K�p c�mek vagy eredeti m�ret� k�pek t�rl�se',
        'delete_title' => 'F�jl c�mek t�rl�se', //cpg1.3.0
        'delete_original' => 'Eredeti m�ret� f�jlok t�rl�se', //cpg1.3.0
        'delete_replace' => 'Eredeti k�pek fel�l�r�sa �tm�retezettel',
        'select_album' => 'Album kiv�laszt�sa',
		'delete_orphans' => '�rva hozz�sz�l�sok t�rl�se (minden albumon m�k�dik)', //cpg1.3.0
		'orphan_comment' => '�rva hozz�sz�l�st tal�ltam', //cpg1.3.0
		'delete' => 'T�rl�s', //cpg1.3.0
		'delete_all' => 'Mind t�rl�se', //cpg1.3.0
		'comment' => 'Hozz�sz�l�s: ', //cpg1.3.0
		'nonexist' => 'nem l�tez� f�jlhoz csatolva # ', //cpg1.3.0
		'phpinfo' => 'Phpinfo kijelz�se', //cpg1.3.0
		'update_db' => 'Adatb�zis aktualiz�l�sa', //cpg1.3.0
		'update_db_explanation' => 'Ha lecser�lt�l coppermine f�jlokat, m�dos�t�sokat v�gezt�l, vagy kor�bbi verzi�j� coppermine-r�l upgrade-elt�l, futtasd le az adatb�zis update-et. Ez l�trehozza a sz�ks�ges adatt�bl�kat �s / vagy konfigur�ci�s �rt�keket a coppermine adatb�zisodban.', //cpg1.3.0
);

?>
