<?php
// ------------------------------------------------------------------------- //
//  Coppermine Photo Gallery                                                 //
// ------------------------------------------------------------------------- //
//  Copyright (C) 2002,2003  Grégory DEMAR <gdemar@wanadoo.fr>               //
//  http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
//  Based on PHPhotoalbum by Henning Stoverud <henning@stoverud.com>         //
//  http://www.stoverud.com/PHPhotoalbum/                                    //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
// ------------------------------------------------------------------------- //

// info about translators and translated language
$lang_translation_info = array(
'lang_name_english' => 'Hungarian',  //the name of your language in English, e.g. 'Greek' or 'Spanish'
'lang_name_native' => 'Magyar', //the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '????????' or 'Español'
'lang_country_code' => 'hu', //the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
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
$lang_month = array('Jan', 'Feb', 'Már', 'Ápr', 'Máj', 'Jún', 'Júl', 'Aug', 'Szept', 'Okt', 'Nov', 'Dec');

// Some common strings
$lang_yes = 'Igen';
$lang_no  = 'Nem';
$lang_back = 'VISSZA';
$lang_continue = 'TOVÁBB';
$lang_info = 'Információ';
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
        'random' => 'Véletlen képlista',
        'lastup' => 'Friss feltöltések',
        'lastalb'=> 'Utoljára módosított albumok',
        'lastcom' => 'Friss hozzászólások',
        'topn' => 'Legtöbbször nézett',
        'toprated' => 'Legtöbb szavazat',
        'lasthits' => 'Utoljára nézett',
        'search' => 'Keresés eredménye',
        'favpics'=> 'Kedvenc képeim'
);

$lang_errors = array(
        'access_denied' => 'Nincs jogosultságod ennek az oldalnak a megtekintéséhez.',
        'perm_denied' => 'Nincs jogosultságod ennek a mûveletnek az elvégzéséhez.',
        'param_missing' => 'Szkript hívás a szüksége paraméter(ek) megadása nélkül.',
        'non_exist_ap' => 'A kijelölt album / kép nem található!',
        'quota_exceeded' => 'Diszk kvóta túllépve<br /><br />A beállított diszkkvóta [quota]K, a képeid által jelenleg elfoglalt tárhely [space]K, ennek a képnek a feltöltésével túllépnéd a kvótáját.',
        'gd_file_type_err' => 'GD könyvtár használata esetén csak JPEG és PNG típusok megengedettek.',
        'invalid_image' => 'A feltöltött kép sérült, vagy a GD könyvtár által nem kezelhetõ',
        'resize_failed' => 'Nem sikerült az ikonizált vagy átméretezett képek generálása.',
        'no_img_to_display' => 'Nincs megjeleníthetõ kép',
        'non_exist_cat' => 'A kijelölt kategória nem létezik',
        'orphan_cat' => 'A kategória szülõkategóriája nem létezik, futtasd a kategóriamenedzsert a probléma kiküszöbölésére.',
        'directory_ro' => 'A \'%s\' könyvtár nem írható, a képeket nem lehet törölni',
        'non_exist_comment' => 'A kijelölt hozzászólás nem létezik.',
        'pic_in_invalid_album' => 'Kép nem létezõ albumban (%s)!?',
        'banned' => 'Jelenleg ki vagy tiltva a weblap használatából.',
        'not_with_udb' => 'Ez a funkció le van tiltva a Coppermine-ban, mivel a fórum sw része. A kért funkciót vagy nem támogatja a jelen konfiguráció, vagy a fórum sw kezeli.',
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
        'alb_list_title' => 'Ugrás az albumlistára',
        'alb_list_lnk' => 'Albumlista',
        'my_gal_title' => 'Ugrás a személyes képtárra',
        'my_gal_lnk' => 'Én képtáram',
        'my_prof_lnk' => 'Én profilom',
        'adm_mode_title' => 'Váltás adminisztrátor módra',
        'adm_mode_lnk' => 'Adminisztrátor mód',
        'usr_mode_title' => 'Váltás felhasználó módra',
        'usr_mode_lnk' => 'Felhasználó mód',
        'upload_pic_title' => 'Kép feltöltés az albumba',
        'upload_pic_lnk' => 'Kép feltöltése',
        'register_title' => 'Felhasználó hozzáadása',
        'register_lnk' => 'Regisztráció',
        'login_lnk' => 'Bejelentkezés',
        'logout_lnk' => 'Kijelentkezés',
        'lastup_lnk' => 'Friss feltöltések',
        'lastcom_lnk' => 'Friss hozzászólások',
        'topn_lnk' => 'Legtöbbször nézett',
        'toprated_lnk' => 'Legtöbb szavazat',
        'search_lnk' => 'Keresés',
        'fav_lnk' => 'Kedvencek',
);


$lang_gallery_admin_menu = array(
        'upl_app_lnk' => 'Feltöltés jóváhagyás',
        'config_lnk' => 'Konfiguráció',
        'albums_lnk' => 'Albumok',
        'categories_lnk' => 'Kategóriák',
        'users_lnk' => 'Felhasználók',
        'groups_lnk' => 'Csoportok',
        'comments_lnk' => 'Hozzászólások',
        'searchnew_lnk' => 'Kötegelt feltöltés',
        'util_lnk' => 'Képek átméretezése',
        'ban_lnk' => 'Felhasználók kitiltása',
);

$lang_user_admin_menu = array(
        'albmgr_lnk' => 'Személyes albumok szerkesztése',
        'modifyalb_lnk' => 'Személyes albumok tulajdonságai',
        'my_prof_lnk' => 'Én profilom',
);

$lang_cat_list = array(
        'category' => 'Kategória',
        'albums' => 'Albumok',
        'pictures' => 'Képek',
);

$lang_album_list = array(
        'album_on_page' => '%d album %d oldalon'
);

$lang_thumb_view = array(
        'date' => 'DÁTUM',
        'name' => 'NÉV',
        'title' => 'Kép cím',
        'sort_da' => 'Dátum szerinti sorrendezés, növekvõ',
        'sort_dd' => 'Dátum szerinti sorrendezés, csökkenõ',
        'sort_na' => 'Név szerinti sorrendezés, növekvõ',
        'sort_nd' => 'Név szerinti sorrendezés, csökkenõ',
        'sort_ta' => 'Sorrendezés cím szerint - növekvõ',
        'sort_td' => 'Sorrendezés cím szerint - csökkenõ',
        'pic_on_page' => '%d kép %d oldalon',
        'user_on_page' => '%d felhasználó %d oldalon'
);

$lang_img_nav_bar = array(
        'thumb_title' => 'Vissza az ikonos elrendezésre',
        'pic_info_title' => 'Kép információ megtekintése / elrejtése',
        'slideshow_title' => 'Diavetítés',
        'ecard_title' => 'Kép elküldése e-képeslapként',
        'ecard_disabled' => 'e-képeslapok küldése nem engedélyezett',
        'ecard_disabled_msg' => 'Nincs jogosultságod e-képeslap küldésére',
        'prev_title' => 'Elõzõ kép',
        'next_title' => 'Következõ kép',
        'pic_pos' => 'KÉP %s/%s',
);

$lang_rate_pic = array(
        'rate_this_pic' => 'Kép osztályozása ',
        'no_votes' => '(Még nincs osztályozva)',
        'rating' => '(jelenlegi osztályzat: %s, %s szavazattal)',
        'rubbish' => 'Vacak',
        'poor' => 'Gyenge',
        'fair' => 'Megfelelõ',
        'good' => 'Jó',
        'excellent' => 'Kitûnõ',
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
                'title' => 'Tiltott felhasználók',
                'user_name' => 'Felhasználónév',
                'ip_address' => 'IP cím',
                'expiry' => 'Lejárat (állandó esetén üres marad)',
                'edit_ban' => 'Módosítások tárolása',
                'delete_ban' => 'Törlés',
                'add_new' => 'Új tiltás hozzáadása',
                'add_ban' => 'Hozzáadás',
);

// ------------------------------------------------------------------------- //
// File include/functions.inc.php
// ------------------------------------------------------------------------- //

$lang_cpg_die = array(
        INFORMATION => $lang_info,
        ERROR => $lang_error,
        CRITICAL_ERROR => 'Kritikus hiba',
        'file' => 'Fájl: ',
        'line' => 'Sor: ',
);

$lang_display_thumbnails = array(
        'filename' => 'Fájlnév : ',
        'filesize' => 'Fájlméret : ',
        'dimensions' => 'Méretek : ',
        'date_added' => 'Feltöltés dátuma : '
);

$lang_get_pic_data = array(
        'n_comments' => '%s kommentár',
        'n_views' => '%s megtekintés',
        'n_votes' => '(%s szavazat)'
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
        'Exclamation' => 'Felkiáltás',
        'Question' => 'Kérdés',
        'Very Happy' => 'Nagyon boldog',
        'Smile' => 'Mosolyog',
        'Sad' => 'Szomorú',
        'Surprised' => 'Meglepett',
        'Shocked' => 'Sokkolt',
        'Confused' => 'Zavarodott',
        'Cool' => 'Higgadt',
        'Laughing' => 'Nevet',
        'Mad' => 'Õrült',
        'Razz' => 'Gúnyos',
        'Embarassed' => 'Kínos',
        'Crying or Very sad' => 'Sír / nagyon szomorú',
        'Evil or Very Mad' => 'Gonosz vagy õrült',
        'Twisted Evil' => 'Torz gonosz',
        'Rolling Eyes' => 'Guruló szemek',
        'Wink' => 'Kacsint',
        'Idea' => 'Ötlet',
        'Arrow' => 'Nyíl',
        'Neutral' => 'Semleges',
        'Mr. Green' => 'Mr. Zöld',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
        0 => 'Kilépés adminisztrátor módból...',
        1 => 'Váltás adminisztrátor módra...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
        'alb_need_name' => 'Az albumokat el kell nevezni!',
        'confirm_modifs' => 'Biztos végre akarod hajtani ezt a módosítást?',
        'no_change' => 'Semmit nem változtattál!',
        'new_album' => 'Új album',
        'confirm_delete1' => 'Biztos törlöd az albumot?',
        'confirm_delete2' => '\nA tartalmazott összes kép és hozzászólás törlõdik!',
        'select_first' => 'Elõször válassz albumot',
        'alb_mrg' => 'Albummenedzser',
        'my_gallery' => '* Az én képtáram *',
        'no_category' => '* Nincs kategória *',
        'delete' => 'Törlés',
        'new' => 'Új',
        'apply_modifs' => 'Módosítások végrehajtása',
        'select_category' => 'Válassz kategóriát',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
        'miss_param' => 'A \'%s\' mûvelethez szükséges paraméterek hiányoznak!',
        'unknown_cat' => 'Nincs az adatbázisban a kijelölt kategória ',
        'usergal_cat_ro' => 'A személyes képtárak nem törölhetõk!',
        'manage_cat' => 'Kategóriák menedzselése',
        'confirm_delete' => 'Biztosan törlöd ezt a kategóriát?',
        'category' => 'Kategória',
        'operations' => 'Mûveletek',
        'move_into' => 'Mozgatás a következõbe',
        'update_create' => 'Kategória létrehozás / módosítás',
        'parent_cat' => 'Szülõ kategória',
        'cat_title' => 'Kategória megnevezés',
        'cat_desc' => 'Kategória leírása'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
        'title' => 'Konfiguráció',
        'restore_cfg' => 'Gyári beállítások',
        'save_cfg' => 'Konfiguráció tárolása',
        'notes' => 'Megjegyzések',
        'info' => 'Információ',
        'upd_success' => 'Coppermine konfiguráció frissítve',
        'restore_success' => 'Coppermine gyári beállítás visszaállítva',
        'name_a' => 'Név - növekvõ',
        'name_d' => 'Név - csökkenõ',
        'title_a' => 'Cím szerint - növekvõ',
        'title_d' => 'Cím szerint - csökkenõ',
        'date_a' => 'Dátum növekvõ',
        'date_d' => 'Dátum csökkenõ'
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
        'Általános beállítások',
        array('Képtár neve', 'gallery_name', 0),
        array('Képtár leírása', 'gallery_description', 0),
        array('Képtár adminisztrátor email címe', 'gallery_admin_email', 0),
        array('Az e-képeslapok  \'További képek\' linkjéhez tartozó webcím', 'ecards_more_pic_target', 0),
        array('Nyelv megadása', 'lang', 5),
        array('Megjelenítési téma', 'theme', 6),


        'Albumlista nézet',
        array('Fõtáblázat szélessége (pixel vagy %)', 'main_table_width', 0),
        array('Kategóriák megjelenítendõ száma', 'subcat_level', 0),
        array('Oldalanként megjelenítendõ albumok száma', 'albums_per_page', 0),
        array('Albumlista oszlopainak száma', 'album_list_cols', 0),
        array('Ikonok mérete pixelben', 'alb_list_thumb_size', 0),
        array('A fõoldal tartalma', 'main_page_layout', 0),
        array('Elsõ szintû albumok ikonok megjelenítése a kategóriákban','first_level',1),

        'Ikonlista nézet',
        array('Oszlopok száma az ikonlistában', 'thumbcols', 0),
        array('Sorok száma az ikonlistában', 'thumbrows', 0),
        array('Megjelenítendõ tab- fülek maximális száma', 'max_tabs', 0),
        array('Kép leírás megjelenítés (a kép címén felül) az ikonok alatt', 'caption_in_thumbview', 1),
        array('Az ikon alatt megjelenjen -e a hozzászólások száma', 'display_comment_count', 1),
        array('Képek alapértelmezett sorrendje', 'default_sort_order', 3),
        array('Szavazatok minimuma a \'legtöbbször nézett\' listára való felkerüléshez', 'min_votes_for_rating', 0),

        'Kép-nézet és hozzászólás beállítások',
        array('A kép-nézethez tartozó táblázat szélessége (pixel vagy %)', 'picture_table_width', 0),
        array('Képinformációk láthatók alapértelmezésben', 'display_pic_info', 1),
        array('Trágár szavak kiszûrése a hozzászólásokból', 'filter_bad_words', 1),
        array('Hangulatkarakterek engedélyezése a hozzászólásokban', 'enable_smilies', 1),
        array('A képleírás maximális hossza', 'max_img_desc_length', 0),
        array('Maximális karakterszám szavanként', 'max_com_wlength', 0),
        array('Sorok maximális száma hozzászólásonként', 'max_com_lines', 0),
        array('Hozzászólások maximális hossza', 'max_com_size', 0),
        array('Filmcsík megjelenítése', 'display_film_strip', 1),
        array('Képkockák száma a filmcsíkban', 'max_film_strip_items', 0),

        'Kép- és ikonbeállítások',
        array('JPEG fájlok minõsége', 'jpeg_qual', 0),
        array('Ikonok maximális mérete <b>*</b>', 'thumb_width', 0),
        array('Méretek használata (ikonok szélessége, magassága, vagy maximális mérete)<b>*</b>', 'thumb_use', 7),
        array('Közbensõ méretû kép generálása','make_intermediate',1),
        array('Közbensõ méretû képmaximális szélessége ésmagassága <b>*</b>', 'picture_width', 0),
        array('Feltöltött képfájlok maximális mérete (KB)', 'max_upl_size', 0),
        array('Feltöltött képek maximális szélessége és magassága (pixel)', 'max_upl_width_height', 0),

         'Felhasználó beállítások',
        array('Új felhasználók regisztrálhatnak', 'allow_user_registration', 1),
        array('Regisztráció email megerõsítéshez kötött', 'reg_requires_valid_email', 1),
        array('Két felhasználónak lehet azonos email címe', 'allow_duplicate_emails_addr', 1),
        array('Felhasználóknak lehetnek privát albumai', 'allow_private_albums', 1),

        'Saját mezõk a képek leírásához (hagyd üresen, ha nem használod)',
        array('1. mezõnév', 'user_field1_name', 0),
        array('2. mezõnév', 'user_field2_name', 0),
        array('3. mezõnév', 'user_field3_name', 0),
        array('4. mezõnév', 'user_field4_name', 0),

        'Képek és ikonok különleges beállításai',
        array('Privát album ikon megjelenítése be nem jelentkezett felhasználó esetén','show_private',1),
        array('Fájlnévben tiltott karakterek', 'forbiden_fname_char',0),
        array('Fájlnevek megengedett kiterjesztései', 'allowed_file_extensions',0),
        array('Képek átméretezéséhez használt módszer','thumb_method',2),
        array('ImageMagick \'convert\' programjához vezetõ útvonal  (pld. /usr/bin/X11/)', 'impath', 0),
        array('Megengedett képfajták (csak ImageMagick esetében)', 'allowed_img_types',0),
        array('Parancssor opciók ImageMagick-hoz', 'im_options', 0),
        array('EXIF adatok olvasása  JPEG fájlokban', 'read_exif_data', 1),
        array('Album elérési útvonala <b>*</b>', 'fullpath', 0),
        array('Felhasználói képek elérési útvonala <b>*</b>', 'userpics', 0),
        array('Középméretezett képek elõtagja <b>*</b>', 'normal_pfx', 0),
        array('Ikonfájlok elõtagja <b>*</b>', 'thumb_pfx', 0),
        array('Könyvtárak alapértelmezett jogosultság beállítása', 'default_dir_mode', 0),
        array('Képek alapértelmezett jogosultság beállítása', 'default_file_mode', 0),

        'Cooky és karakterkészlet beállítások',
        array('A szkript által használt cookynév', 'cookie_name', 0),
        array('A szkript által használt cooky útvonala', 'cookie_path', 0),
        array('Karakter kódolás', 'charset', 4),

        'Egyéb beállítások',
        array('Debug mód engedélyezése', 'debug_mode', 1),

        '<br /><div align="center">(*) * -gal jelölt mezõket nem szabad megváltoztatni, ha már nem üres a képtár</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
        'empty_name_or_com' => 'Meg kell adnod a neved és egy hozzászólást',
        'com_added' => 'Hozzászólásod rögzítettük',
        'alb_need_title' => 'Adj nevet az albumnak!',
        'no_udp_needed' => 'Nincs mit módosítani.',
        'alb_updated' => 'Az album módosítása megtörtént',
        'unknown_album' => 'A kiválasztott album nem létezik, vagy nincs feltöltési jogosultságod az albumhoz',
        'no_pic_uploaded' => 'Nem történt feltöltés!<br /><br />Ha tényleg kijelöltél feltöltésre képet, ellenõrizd, hogy a szerveren megengedett-e a feltöltés...',
        'err_mkdir' => 'Nem sikerült a %s könyvtár létrehozása !',
        'dest_dir_ro' => 'A szkript nem írhat a %s célkönyvtárba!',
        'err_move' => 'Nem mozgatható %s %s -be!',
        'err_fsize_too_large' => 'A feltöltött kép mérete túl nagy (maximum megengedett: %s x %s)!',
        'err_imgsize_too_large' => 'A feltöltött fájl mérete túl nagy (maximum megengedett: %s KB) !',
        'err_invalid_img' => 'A feltöltött fájl nem egy érvényes képformátum !',
        'allowed_img_types' => 'Csak %s kép feltöltése megengedett.',
        'err_insert_pic' => 'A \'%s\' kép nem adható hozzá az albumhoz ',
        'upload_success' => 'A kép feltöltése sikeres volt<br /><br />Jóváhagyás után látható lesz.',
        'info' => 'Információ',
        'com_added' => 'Kommentár hozzáadása megtörtént',
        'alb_updated' => 'Album módosítva',
        'err_comment_empty' => 'Nem adott meg kommentárt !',
        'err_invalid_fext' => 'Csak a következõ kiterjesztésû fájlok megengedettek: <br /><br />%s.',
        'no_flood' => 'Már hozzászóltál a képhez.<br /><br />Szerkeszd az elõzõ hozzászólásod, ha szükséges',
        'redirect_msg' => 'Átirányítás folyamatban.<br /><br /><br />Nyomd meg a \'CONTINUE\'-t, ha a kép nem frissül automatikusan',
        'upl_success' => 'A kép sikeresen hozzáadásra került',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
        'caption' => 'Képaláírás',
        'fs_pic' => 'teljes méretû kép',
        'del_success' => 'törlés sikeres',
        'ns_pic' => 'normál méretû kép',
        'err_del' => 'nem lehet törölni',
        'thumb_pic' => 'ikon',
        'comment' => 'megjegyzés',
        'im_in_alb' => 'kép az albumban',
        'alb_del_success' => ' \'%s\' album törölve',
        'alb_mgr' => 'Albummenedzser',
        'err_invalid_data' => 'Érvénytelen adat a következõben \'%s\'',
        'create_alb' => 'Album generálása \'%s\'',
        'update_alb' => 'Album módosítás \'%s\' név: \'%s\' index: \'%s\'',
        'del_pic' => 'Kép törlése',
        'del_alb' => 'Album törlése',
        'del_user' => 'Felhasználó törlése',
        'err_unknown_user' => 'A kijelölt felhasználó nem létezik !',
        'comment_deleted' => 'A megjegyzést sikeresen töröltük',
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
        'confirm_del' => 'Biztosan törölni akarod ezt a képet? \\nA hozzászólások is törlõdnek.',
        'del_pic' => 'A KÉP TÖRLÉSE',
        'size' => '%s x %s pixel',
        'views' => '%s',
        'slideshow' => 'Diavetítés',
        'stop_slideshow' => 'DIAVETíTÉS VÉGE',
        'view_fs' => 'Teljes méretû kép megtekintése',
);

$lang_picinfo = array(
        'title' =>'Kép információ',
        'Filename' => 'Fájlnév',
        'Album name' => 'Album név',
        'Rating' => 'Osztályozás (%s szavazat)',
        'Keywords' => 'Kulcsszavak',
        'File Size' => 'Fájlméret',
        'Dimensions' => 'Méretek',
        'Displayed' => 'Megtekintések száma',
        'Camera' => 'Kamera',
        'Date taken' => 'Felvétel dátuma',
        'Aperture' => 'Apertúra',
        'Exposure time' => 'Expozíció idõpontja',
        'Focal length' => 'Fókusztávolság',
        'Comment' => 'Megjegyzés',
        'addFav'=>'Hozzáadás a kedvencekhez',
        'addFavPhrase'=>'Kedvencek',
        'remFav'=>'Kivétel kedvencekbõl',
);

$lang_display_comments = array(
        'OK' => 'OK',
        'edit_title' => 'Hozzászólás szerkesztése',
        'confirm_delete' => 'Biztos törölni kívánod a hozzászólást?',
        'add_your_comment' => 'Hozzászólás hozzáfûzése',
        'name'=>'Név',
        'comment'=>'Megjegyzés',
        'your_name' => 'Anon',
);

$lang_fullsize_popup = array(
        'click_to_close' => 'Klikkelj a képre az ablak bezárásához',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
        'title' => 'E-képeslap küldése',
        'invalid_email' => '<b>Figyelmeztetés</b> : érvénytelen e-mail cím!',
        'ecard_title' => 'Egy e-képeslap %s -tól neked',
        'view_ecard' => 'Ha az e-képeslap nem jelenik meg helyesen, klikkelj a következõ linkre',
        'view_more_pics' => 'Klikkelj erre a linkre további képek megtekintéséhez!',
        'send_success' => 'E-képeslapod továbbítottuk',
        'send_failed' => 'Sajnálom, de a szerver nem tud e-képeslapot küldeni...',
        'from' => 'Feladó',
        'your_name' => 'Neved',
        'your_email' => 'E-mail címed',
        'to' => 'Címzett',
        'rcpt_name' => 'Címzett neve',
        'rcpt_email' => 'Címzett e-mail címe',
        'greetings' => 'Üdvözlet',
        'message' => 'Üzenet',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
        'pic_info' => 'Kép információ',
        'album' => 'Album',
        'title' => 'Cím',
        'desc' => 'Leírás',
        'keywords' => 'Kulcsszavak',
        'pic_info_str' => '%sx%s - %sKB - %s megtekintés - %s szavazat',
        'approve' => 'Kép jóváhagyása',
        'postpone_app' => 'Jóváhagyás késõbb',
        'del_pic' => 'Kép törlés',
        'reset_view_count' => 'Nézettségszámláló nullázása',
        'reset_votes' => 'Szavazatszámláló alaphelyzetbe',
        'del_comm' => 'Hozzászólások törlése',
        'upl_approval' => 'Feltöltés jóváhagyás',
        'edit_pics' => 'Képek rendezése',
        'see_next' => 'Következõ kép',
        'see_prev' => 'Elõzõ kép',
        'n_pic' => '%s kép',
        'n_of_pic_to_disp' => 'Kép / oldal',
        'apply' => 'Módosítások végrehajtása'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
        'group_name' => 'Csoport megnevezése',
        'disk_quota' => 'Diszk kvóta',
        'can_rate' => 'Osztályozhat képeket',
        'can_send_ecards' => 'Küldhet e-képeslapot',
        'can_post_com' => 'Hozzászólást küldhet',
        'can_upload' => 'Feltölthet képeket',
        'can_have_gallery' => 'Lehet személyes képtára',
        'apply' => 'Módosítások végrehajtása',
        'create_new_group' => 'Új csoport létrehozása',
        'del_groups' => 'Kijelölt csoport(ok) törlése ',
        'confirm_del' => 'Figyelmeztetés: ha törölsz egy csoportot, a hozzá tartozó felhasználók áthelyezõdnek a \'Registered\' csoportba !\n\nFolytatod ?',
        'title' => 'Felhasználócsoportok menedzselése',
        'approval_1' => 'Nyilvános feltöltés jóváhagyás (1)',
        'approval_2' => 'Privát feltöltés jóváhagyás (2)',
        'note1' => '<b>(1)</b> A nyilvános albumba történõ feltöltés adminisztrátori jóváhagyást igényel',
        'note2' => '<b>(2)</b> A felhasználó albumába történõ feltöltés adminisztrátori jóváhagyást igényel',
        'notes' => 'Megjegyzések'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
        'welcome' => 'Üdvözöllek!'
);

$lang_album_admin_menu = array(
        'confirm_delete' => 'Biztos törölni akarod az albumot? \\nMinden kép és hozzászólás is törlõdik!',
        'delete' => 'TÖRLÉS',
        'modify' => 'TULAJDONSÁGOK',
        'edit_pics' => 'SZERKESZTÉS',
);

$lang_list_categories = array(
        'home' => 'Home',
        'stat1' => '<b>[pictures]</b> kép <b>[albums]</b> albumban és <b>[cat]</b> kategóriában <b>[comments]</b> hozzászólással, megtekintések száma: <b>[views]</b>',
        'stat2' => '<b>[pictures]</b> kép <b>[albums]</b> albumban, megtekintések száma: <b>[views]</b>',
        'xx_s_gallery' => '%s képtára',
        'stat3' => '<b>[pictures]</b> kép <b>[albums]</b> albumban <b>[comments]</b> hozzászólással, megtekintések száma: <b>[views]</b>'
);

$lang_list_users = array(
        'user_list' => 'Felhasználók listája',
        'no_user_gal' => 'Nincs felhasználó a képtárban',
        'n_albums' => '%s album(ok)',
        'n_pics' => '%s kép(ek)'
);

$lang_list_albums = array(
        'n_pictures' => '%s kép',
        'last_added' => ', utolsó feltöltés: %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
        'login' => 'Bejelentkezés',
        'enter_login_pswd' => 'Adja meg felhasználónevét és jelszavát a bejelentkezéshez',
        'username' => 'Felhasználónév',
        'password' => 'Jelszó',
        'remember_me' => 'Jelszó tárolása',
        'welcome' => 'Üdvözöllek %s ...',
        'err_login' => '*** A bejelentkezés sikertelen, próbáld újra ***',
        'err_already_logged_in' => 'Már bejelentkeztél!',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
        'logout' => 'Kijelentkezés',
        'bye' => 'Viszontlátásra %s ...',
        'err_not_loged_in' => 'Nem vagy bejelentkezve!',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
        'upd_alb_n' => '%s album módosítása ',
        'general_settings' => 'Általános beállítások',
        'alb_title' => 'Album cím',
        'alb_cat' => 'Album kategória',
        'alb_desc' => 'Album leírás',
        'alb_thumb' => 'Album ikon',
        'alb_perm' => 'Album jogosultságok',
        'can_view' => 'Albumot láthatja: ',
        'can_upload' => 'Látogatók feltölthetnek képet',
        'can_post_comments' => 'Látogatók küldhetnek hozzászólásokat',
        'can_rate' => 'Látogatók osztályozhatják a képeket',
        'user_gal' => 'Felhasználói képtár',
        'no_cat' => '* Nincs kategória *',
        'alb_empty' => 'Az album üres',
        'last_uploaded' => 'Utoljára feltöltött',
        'public_alb' => 'Mindenki (nyilvános album)',
        'me_only' => 'Csak én',
        'owner_only' => 'Csak a (%s) album tulajdonosa',
        'groupp_only' => 'Csak a \'%s\' csoport tagjai',
        'err_no_alb_to_modify' => 'Nincs módosítható album az adatbázisban.',
        'update' => 'Album módosítása'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
        'already_rated' => 'Sajnálom, de már osztályoztad ezt a képet',
        'rate_ok' => 'Osztályzatod elfogadtuk',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
Bár a {SITE_NAME} adminisztrátora mindent elkövet, hogy amilyen gyorsan csak lehet, szerkesszen vagy töröljön minden kifogásolható dokumentumot, lehetetlen minden küldemény ellenõrzése. Kérjük ezért annak megértését, hogy minden erre a weblapra címzett küldemény annak szerzõje nézetét és véleményét fejezi ki, és nem az adminisztrátorét, illetve webmesterét (kivéve az általuk postázott küldeményeket). Ennél fogva nem tudunk értük felelõsséget vállalni.<br />
<br />
Elfogadod, hogy nem postázol semmilyen sértõ, obszcén, vulgáris, rágalmazó, gyûlölködõ, fenyegetõ, szexuális tartalmú, vagy bármilyen más olyan tartalmú anyagot, amely érvényes törvényt sért. Elfogadod, hogy a {SITE_NAME} webmesterének, adminisztrátorának, vagy moderátorának bármikor jogában áll bármilyen tartalmat szükség esetén törölni, vagy szerkeszteni. Mint felhasználó egyetértesz a közölt információk adatbázisban történõ tárolásához. Bár a webmester, illetve adminisztrátor nem adja ki harmadik feleknek ezeket az információkat a hozzájárulásod nélkül, nem tehetõ felelõssé semmilyen olyan hacker kísérletért, melyek az adatok kompromittálásához vezet.<br />
<br />
Ez a weblap cookie formájában információt tárol a számítógépeden. Ezek a cookie-k csak azt a célt szolgálják, hogy fokozzák a nézhetõségi élményt. Az email cím csak a regisztrációs adataidnak és jelszavadnak nyugtázására szolgál.<br />
<br />
Az 'Egyetértek'-re klikkelve elfogadod ezeket a feltételeket.
EOT;

$lang_register_php = array(
        'page_title' => 'Felhasználó regisztráció',
        'term_cond' => 'Regisztrációs feltételek',
        'i_agree' => 'Egyetértek',
        'submit' => 'Regisztrálás',
        'err_user_exists' => 'A megadott felhasználónév már létezik, adjon meg másikat',
        'err_password_mismatch' => 'A két jelszó nem egyezik, add meg újra',
        'err_uname_short' => 'A felhasználónév legalább 2 karakter hosszú kell, hogy legyen',
        'err_password_short' => 'A jelszó legalább 2 karakter hosszú kell, hogy legyen',
        'err_uname_pass_diff' => 'A felhasználónévnek és a jelszónak különböznie kell',
        'err_invalid_email' => 'Érvénytelen email cím',
        'err_duplicate_email' => 'Egy másik felhasználó már regisztrált ezzel az email címmel',
        'enter_info' => 'Regisztrációs információk megadása',
        'required_info' => 'Kötelezõ adat',
        'optional_info' => 'Opcionális adat',
        'username' => 'Felhasználónév',
        'password' => 'Jelszó',
        'password_again' => 'Jelszó még egyszer',
        'email' => 'Email',
        'location' => 'Tartózkodási hely',
        'interests' => 'Érdeklõdési kör',
        'website' => 'Honlap',
        'occupation' => 'Foglalkozás',
        'error' => 'HIBA',
        'confirm_email_subject' => '%s - Regisztráció nyugtázása',
        'information' => 'Információ',
        'failed_sending_email' => 'A regisztrációs megerõsítõ emailt nem sikerült elküldeni !',
        'thank_you' => 'Köszönjük, hogy regisztráltál.<br /><br />Küldtünk egy emailt a megadott email címre, amiben megadtuk, hogy hogyan aktiválhatod felhasználói hozzáférésed.',
        'acct_created' => 'Felhasználói hozzáférésed létrehoztuk és bejelentkezhetsz a felhasználóneveddel és jelszavaddal',
        'acct_active' => 'Felhasználói hozzáférésed aktiváltuk és bejelentkezhetsz a felhasználóneveddel és jelszavaddal',
        'acct_already_act' => 'Felhasználói hozzáférésed már aktív !',
        'acct_act_failed' => 'Ezt a felhasználói hozzáférést nem lehet aktiválni !',
        'err_unk_user' => 'A kiválasztott felhasználó nem létezik !',
        'x_s_profile' => '%s profilja',
        'group' => 'Csoport',
        'reg_date' => 'Csatlakozás ideje',
        'disk_usage' => 'Tárfelhasználás',
        'change_pass' => 'Jelszó megváltoztatása',
        'current_pass' => 'Jelenlegi jelszó',
        'new_pass' => 'Új jelszó',
        'new_pass_again' => 'Új jelszó még egyszer',
        'err_curr_pass' => 'A jelenlegi jelszó hibás',
        'apply_modif' => 'Módosítások végrehajtása',
        'change_pass' => 'Jelszó megváltoztatása',
        'update_success' => 'Profilod aktualizáltuk',
        'pass_chg_success' => 'Jelszavad megváltoztattuk',
        'pass_chg_error' => 'Jelszavad nem változtattuk meg',
);

$lang_register_confirm_email = <<<EOT
Köszönjük, hogy regisztráltál '{SITE_NAME}' weblapunkon

Felhasználóneved : "{USER_NAME}"
Jelszavad : "{PASSWORD}"

Felhaználói hozzáférésed aktiválásához az alábbi linkre kell klikkelned.

{ACT_LINK}

Üdvözlettel,

A '{SITE_NAME}' adminisztrátora

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
        'title' => 'Hozzászólások megtekintése',
        'no_comment' => 'Nincs hozzászólás',
        'n_comm_del' => '%s hozzászólás(ok) törölve',
        'n_comm_disp' => 'Megjelenítendõ hozzászólások száma',
        'see_prev' => 'Elõzõ',
        'see_next' => 'Következõ',
        'del_comm' => 'Kijelölt hozzászólások törölve',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
        0 => 'Keresés a képtárban',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
        'page_title' => 'Új kép keresése',
        'select_dir' => 'Könyvtár választása',
        'select_dir_msg' => 'Ez a funkció lehetõvé teszi egy köteg - FTP-vel a szerverre másolt - kép hozzáadását a képtárhoz.<br /><br />Válaszd ki a könyvtárat, ahonnan hozzá akarsz adni a képtárhoz képeket',
        'no_pic_to_add' => 'Nincs hozzáadható kép',
        'need_one_album' => 'Ehhez a funkcióhoz legalább egy albumnak léteznie kell',
        'warning' => 'Figyelmeztetés',
        'change_perm' => 'a szkript nem tud írni ebbe a könyvtárba, 755-rõl 777-re kell cserélned a jogosultságát mielõtt hozzáadsz képeket !',
        'target_album' => '<b>Adja hozzá a </b>"%s"<b> könyvtárból a képeket a </b>%s albumhoz',
        'folder' => 'Könyvtár',
        'image' => 'Kép',
        'album' => 'Album',
        'result' => 'Eredmény',
        'dir_ro' => 'Nem írható. ',
        'dir_cant_read' => 'Nem olvasható. ',
        'insert' => 'Új képek hozzáadása a képtárhoz',
        'list_new_pic' => 'Új képek felsorolása',
        'insert_selected' => 'Kijelölt képek hozzáadása',
        'no_pic_found' => 'Nincs új kép',
        'be_patient' => 'Légy türelemmel, a szkriptnek idõ kell a képek hozzáadásához',
        'notes' =>  '<ul>'.
                                '<li><b>OK</b> : azt jelenti, hogy a kép hozzáadása sikeres volt'.
                                '<li><b>DP</b> : azt jelenti, hogy a kép már az adatbázisban volt'.
                                '<li><b>PB</b> : azt jelenti, hogy a kép nem volt hozzáadható, ellenõrizd a konfigurációt és a képeket tartalmazó könyvtárak jogosultságait '.
                                '<li>Ha az OK, DP, PB \'jelek\' nem láthatók, klikkelj a hibás képre a PHP hibaüzenetének megjelenítéséhez'.
                                '<li>Ha a browser leidõzített, nyomja meg a frissítés gombot'.
                                '</ul>',
);


// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //

// Void


// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
        'title' => 'Kép feltöltése',
        'max_fsize' => 'Maximum megengedett fájlméret %s KB',
        'album' => 'Album',
        'picture' => 'Kép',
        'pic_title' => 'Kép címe',
        'description' => 'Kép leírása',
        'keywords' => 'Kulcsszavak (szóközökkel elválasztva)',
        'err_no_alb_uploadables' => 'Nincs album, ahova engedélyezett a feltöltés',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
        'title' => 'Felhasználók menedzselése',
        'name_a' => 'Név növekvõ',
        'name_d' => 'Név csökkenõ',
        'group_a' => 'Csoport növekvõ',
        'group_d' => 'Csoport csökkenõ',
        'reg_a' => 'Reg. dátum növekvõ',
        'reg_d' => 'Reg. dátum csökkenõ',
        'pic_a' => 'Képszám növekvõ',
        'pic_d' => 'Képszám csökkenõ',
        'disku_a' => 'Diszkfelhasználás növekvõ',
        'disku_d' => 'Diszkfelhasználás csökkenõ',
        'sort_by' => 'Felhasználók sorrendezése',
        'err_no_users' => 'Nincs felhasználó !',
        'err_edit_self' => 'Nem szerkesztheted a saját profilod, használd az \'Én profilom\' menüpontot',
        'edit' => 'SZERKESZT',
        'delete' => 'TÖRÖL',
        'name' => 'Felhasználónév',
        'group' => 'Csoport',
        'inactive' => 'Inaktív',
        'operations' => 'Mûveletek',
        'pictures' => 'Képek',
        'disk_space' => 'Felhasznált tárhely / kvóta',
        'registered_on' => 'Regisztrálva',
        'u_user_on_p_pages' => '%d felhasználó %d oldalon',
        'confirm_del' => 'Biztös törölni kívánod a felhasználót? \\nMinden képe és albuma is törlõdni fog.',
        'mail' => 'MAIL',
        'err_unknown_user' => 'A kijelölt felhasználó nem létezik !',
        'modify_user' => 'Felhasználó módosítása',
        'notes' => 'Megjegyzések',
        'note_list' => '<li>Ha nem kívánod megváltoztatni az aktuális jelszót, hagyd üresen a "jelszó" mezõt',
        'password' => 'Jelszó',
        'user_active' => 'Felhasználó aktív',
        'user_group' => 'Felhasználó csoport',
        'user_email' => 'Felhasználó email címe',
        'user_web_site' => 'Felhasználó honlapja',
        'create_new_user' => 'Új felhasználó létrehozása',
        'user_location' => 'Felhasználó lakhelye',
        'user_interests' => 'Felhasználó érdeklõdési köre',
        'user_occupation' => 'Felhasználó foglalkozása',
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => 'Képek átméretezése',
        'what_it_does' => 'Mi történjen',
        'what_update_titles' => 'Címek aktualizálása fájlnevekbõl',
        'what_delete_title' => 'Címek törlése',
        'what_rebuild' => 'Ikonok és átméretezett képek újragenerálása',
        'what_delete_originals' => 'Eredeti képek felülírása az átméretezettekkel',
        'file' => 'Fájl',
        'title_set_to' => 'cím beállítása ..',
        'submit_form' => 'érvényesítés',
        'updated_succesfully' => 'sikeres módosítás',
        'error_create' => 'HIBA a generálás során',
        'continue' => 'Több kép feldolgozása',
        'main_success' => 'A % fájlok felhasználása elsõdleges képként sikeres volt',
        'error_rename' => '%s %s -ra átnevezése során HIBA',
        'error_not_found' => 'A % fájlok nem találhatók',
        'back' => 'vissza a fõoldalra',
        'thumbs_wait' => 'Ikonok és/vagy átméretezett képek aktualizálása, kérlek várj...',
        'thumbs_continue_wait' => 'Ikonok és/vagy átméretezett képek aktualizálásának folytatása...',
        'titles_wait' => 'Címek aktualizálása, kérlek várj...',
        'delete_wait' => 'Címek törlése, kérlek várj...',
        'replace_wait' => 'Eredeti képek felülírása az átméretezettekkel, kérlek várj...',
        'instruction' => 'Gyors utasítások',
        'instruction_action' => 'Mûvelet kiválasztása',
        'instruction_parameter' => 'Paraméterek beállítása',
        'instruction_album' => 'Album kiválasztása',
        'instruction_press' => 'Nyomj %-t',
        'update' => 'Ikonok és/vagy átméretezett fényképek aktualizálása',
        'update_what' => 'Mit kell aktualizálni',
        'update_thumb' => 'Csak ikonokat',
        'update_pic' => 'Csak átméretezett képeket',
        'update_both' => 'Ikonokat és átméretezett képeket is',
        'update_number' => 'Klikkelésenként feldolgozandó képek száma',
        'update_option' => '(Próbáld csökkenteni ezt az értéket, ha leidõzítési problémát észlelsz)',
        'filename_title' => 'Fájlnév &#8594; Kép cím',
        'filename_how' => 'Hogy legyen módosítva a fájlnév',
        'filename_remove' => 'A jpg végzõdés törlése és _ (alulvonás) helyettesítése szóközzel',
        'filename_euro' => '2003_11_23_13_20_20.jpg átnevezése 23/11/2003 13:20-ra',
        'filename_us' => '2003_11_23_13_20_20.jpg átnevezése 11/23/2003 13:20-ra',
        'filename_time' => '2003_11_23_13_20_20.jpg átnevezése 13:20ra',
        'delete' => 'Kép címek vagy eredeti méretû képek törlése',
        'delete_title' => 'Kép címek törlése',
        'delete_original' => 'Eredeti méretû képek törlése',
        'delete_replace' => 'Eredeti képek felülírása átméretezettel',
        'select_album' => 'Album kiválasztása',
);

?>
