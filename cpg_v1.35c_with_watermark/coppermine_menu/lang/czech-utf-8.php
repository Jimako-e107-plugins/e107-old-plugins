<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.2.0                                            //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002,2003 Gregory DEMAR <gdemar@wanadoo.fr>                 //
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


// info about translators and translated language
$lang_translation_info = array(
'lang_name_english' => 'Czech',  //the name of your language in English, e.g. 'Greek' or 'Spanish'
'lang_name_native' => '&#x10C;esky', //the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espan~ol'
'lang_country_code' => 'cz', //the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
'trans_name'=> 'Michal Soukup aka migon', //the name of the translator - can be a nickname
'trans_email' => 'migon@boule.cz', //translator's email address (optional)
'trans_website' => 'http://www.boule.cz/', //translator's website (optional)
'trans_date' => '2003-10-02', //the date the translation was created / last modified
);


$lang_charset = 'iso-8859-2';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytù', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('Ne', 'Po', 'Út', 'St', 'Èt', 'Pá', 'So');
$lang_month = array('Leden', 'Únor', 'Bøezen', 'Duben', 'Kvìten', 'Èerven', 'Èervenec', 'Srpen', 'Záøí', 'Øíjen', 'Listopad', 'Prosinec');

// Some common strings
$lang_yes = 'Ano';
$lang_no  = 'Ne';
$lang_back = 'ZPÌT';
$lang_continue = 'POKRAÈOVAT';
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
$lang_bad_words = array('píèa', 'hovno', '*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array(
        'random' => 'Náhodné obrázky',
        'lastup' => 'Nejnovìj¹í',
        'lastalb'=> 'Naposledy aktualizovaná alba',
        'lastcom' => 'Nejnovìj¹í komentáøe',
        'topn' => 'Nejprohlí¾enìj¹í',
        'toprated' => 'Nejlépe hodnocené',
        'lasthits' => 'Naposledy zobrazené',
        'search' => 'Výsledky hledání',
        'favpics'=> 'Oblíbené obrázky',
);

$lang_errors = array(
    'access_denied' => 'Nemáte oprávnìní na tuto stránku',
    'perm_denied' => 'Nemáte dostateèná práva pro potvrzení této operace.',
    'param_missing' => 'Skriptu nebyly pøedány potøebné parametry',
    'non_exist_ap' => 'Vybrané album/obrázek neexistuje',
    'quota_exceeded' => 'Vyèerpal(a) jste místo na disku.<br /><br />Va¹e kvóta je[quota]K, Va¹e obrázky zbírají [space]K, pøidáním tohoto obrázku by jste svoji kvótu pøekroèil',
    'gd_file_type_err' => 'Pokud pou¾íváte GD knihovnu jsou podporovány jen obrázky JPG a PNG',
    'invalid_image' => 'Tento obrázek je po¹kozen/poru¹en GD knihovna s ním nemù¾e pracovat.',
    'resize_failed' => 'Nelze vytvoøit náhled èi zmen¹ený obrázek',
    'no_img_to_display' => 'Zde není obrázek který by jste si mohl(a) prohlédnout',
    'non_exist_cat' => 'Vybraná kategorie neexistuje',
    'orphan_cat' => 'Podkategorie nemá nadøízenou kategorii. Problém opravte pøes nastavení kategorií.',
    'directory_ro' => 'Do adresáøe \'%s\' nelze zapisovat (nedostateèná práva), obrázky nemohly být smazány.',
    'non_exist_comment' => 'Vybraný komentáø neexistuje',
    'pic_in_invalid_album' => 'Obrázek(y) je/jsou v neexitujícím albu (%s)!?',
    'banned' => 'Byl jse vykopnut z tìchto stránek, není Vám umo¾nìno je pou¾ívat.',
    'not_with_udb' => 'Tato funkce je vypnutá jeliko¾ je integrována ve fóru. Buï není po¾adovaná fukce dostupná na tomto systému, nebo tuto/tyto funci/e plní fórum.',
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
    'alb_list_title' => 'Pøejít na seznam galerií',
    'alb_list_lnk' => 'Seznam galerií',
    'my_gal_title' => 'Pøejít do mé osobní galerie',
    'my_gal_lnk' => 'Moje galerie',
    'my_prof_lnk' => 'Mùj Profil',
    'adm_mode_title' => 'Do Admin módu',
    'adm_mode_lnk' => 'Admin mód',
    'usr_mode_title' => 'Do U¾ivatelského módu',
    'usr_mode_lnk' => 'U¾ivatelský mód',
    'upload_pic_title' => 'Nahrát obrázek do gallerie',
    'upload_pic_lnk' => 'Upload obrázku',
    'register_title' => 'Vytvoøit úèet',
    'register_lnk' => 'Registrovat se',
    'login_lnk' => 'Pøihlásit',
    'logout_lnk' => 'Odhlásit',
    'lastup_lnk' => 'Nejnovìj¹í obrázky',
    'lastcom_lnk' => 'Poslední komentáøe',
    'topn_lnk' => 'Nejprohlí¾enìj¹í',
    'toprated_lnk' => 'Nejlépe hodnocené',
    'search_lnk' => 'Vyhledávání',
    'fav_lnk' => 'Oblíbené',
);

$lang_gallery_admin_menu = array(
    'upl_app_lnk' => 'Potvrzení uploadu',
    'config_lnk' => 'Nastavení',
    'albums_lnk' => 'Galerie',
    'categories_lnk' => 'Kategorie',
    'users_lnk' => 'U¾ivatelé',
    'groups_lnk' => 'U¾. skupiny',
    'comments_lnk' => 'Komentáøe',
    'searchnew_lnk' => 'Dávkové pøidání obrázkù',
    'util_lnk' => 'Zmìnit velikost obrázkù',
    'ban_lnk' => 'Vykopnout u¾ivatele',
);

$lang_user_admin_menu = array(
    'albmgr_lnk' => 'Vytvoøit / organizovat moje galerie',
    'modifyalb_lnk' => 'Zmìnit moje galerie',
    'my_prof_lnk' => 'Mùj profil',
);

$lang_cat_list = array(
    'category' => 'Kategorie',
    'albums' => 'Galerie',
    'pictures' => 'Obrázky',
);

$lang_album_list = array(
    'album_on_page' => '%d Galerií na %d stránkách'
);
           //ascending VZESTUPNE
$lang_thumb_view = array(
    'date' => 'DATUM',
    //Sort by filename and title
    'name' => 'JMÉNO SOUBORU',
    'title' => 'NADPIS',
    'sort_da' => 'Øadit vzestupnì podle data',
    'sort_dd' => 'Øadit sestupnì podle data',
    'sort_na' => 'Øadit vzestupnì podle jména',
    'sort_nd' => 'Øadit sestupnì podle jména',
    'sort_ta' => 'Øadit podle nadpisu vzestupnì',
    'sort_td' => 'Øadit podle nadpisu sestupnì',
    'pic_on_page' => '%d obrázkkù na %d stránkách',
    'user_on_page' => '%d u¾ivatelù na %d stránkách'
);

$lang_img_nav_bar = array(
    'thumb_title' => 'Zpìt na stránku s náhledy',
    'pic_info_title' => 'Zobraz/skryj informace o obrázku',
    'slideshow_title' => 'Slideshow',
    'ecard_title' => 'Poslat tento obrázek jako pohlednici',
    'ecard_disabled' => 'Pohlednice jsou vypnuté',
    'ecard_disabled_msg' => 'Nemáte dostateèná práva pro zaslání pohlednice',
    'prev_title' => 'Pøedchozí obrázek',
    'next_title' => 'Dal¹í obrázek',
    'pic_pos' => 'OBRÁZEK %s/%s',
);

$lang_rate_pic = array(
    'rate_this_pic' => 'Hodnotit tento obrázek ',
    'no_votes' => '(¾ádné hodnocení)',
    'rating' => '(Aktualní hodnocení : %s / z 5, hlasováno %s krát)',
    'rubbish' => 'Hnusný',
    'poor' => 'Mizerný',
    'fair' => 'Ujde to',
    'good' => 'Dobrý',
    'excellent' => 'Výborný',
    'great' => 'Dokonalý',
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
    CRITICAL_ERROR => 'Kritická chyba',
    'file' => 'Soubor: ',
    'line' => 'Øádka: ',
);

$lang_display_thumbnails = array(
    'filename' => 'Jméno souboru : ',
    'filesize' => 'Velikost souboru : ',
    'dimensions' => 'Rozmìry : ',
    'date_added' => 'Datum pøidání : '
);

$lang_get_pic_data = array(
    'n_comments' => '%s Komentáø(ù)',
    'n_views' => '%s zobrazení',
    'n_votes' => '(%s hlas(ù))'
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
    0 => 'Opou¹tím Admin Mód....:-(',
    1 => 'Vstupuji do Admin Módu....:-)',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
    'alb_need_name' => 'Galerie musí mít jméno',
    'confirm_modifs' => 'Ste si jist(a) tìmito zmìnami ?',
    'no_change' => 'Neudìlal(a) jste ¾ádné zmìny !',
    'new_album' => 'Nová galerie',
    'confirm_delete1' => 'Jste si jist(a), ¾e chcete smazat tuto galerii ?',
    'confirm_delete2' => '\nV¹echny obrázky a komentáøe budou smazány !',
    'select_first' => 'Nejprve vyberte galerii',
    'alb_mrg' => 'Správce galerií',
    'my_gallery' => '* Moje galerie *',
    'no_category' => '* Není kategorie *',
    'delete' => 'Smazat',
    'new' => 'Nový/á',
    'apply_modifs' => 'Potvrdit zmìny',
    'select_category' => 'Vybrat kategorii',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
    'miss_param' => 'Parametry potøebné pro \'%s\'operaci not supplied !',
    'unknown_cat' => 'Vybraná kategorie v databázi neexistuje',
    'usergal_cat_ro' => 'Nelze smazat u¾ivatelské galerie !',
    'manage_cat' => 'Spravovat kategorie',
    'confirm_delete' => 'Opravdu chcete SMAZAT tuto kategorii',
    'category' => 'Kategorie',
    'operations' => 'Operace',
    'move_into' => 'Pøesunout do',
    'update_create' => 'Aktualizovat/Vytvoøit kategorii',
    'parent_cat' => 'Nadøazená kategorie',
    'cat_title' => 'Nadpis kategorie',
    'cat_desc' => 'Popis kategorie'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
    'title' => 'Nastavení',
    'restore_cfg' => 'Nastavit výchozí',
    'save_cfg' => 'Ulo¾it konfiguraci',
    'notes' => 'Poznámky',
    'info' => 'Informace',
    'upd_success' => 'Konfigurace byla zmìnìna',
    'restore_success' => 'Konfigurace byla nastavena na výchozí nastavení',
    'name_a' => 'Jméno vzestupnì',
    'name_d' => 'Jméno sestupnì',
    'date_a' => 'Datum vzestupnì',
    'date_d' => 'Datum sestupnì',,
        'th_any' => 'Max Aspect',
        'th_ht' => 'Height',
        'th_wd' => 'Width',
    'title_a' => 'Nadpis vzestupnì',
    'title_d' => 'Nadpis sestupnì',
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
    'Základní nastavení',
    array('Jméno gallerie', 'gallery_name', 0),
    array('Popis Galerie', 'gallery_description', 0),
    array('Email administrátora galerie', 'gallery_admin_email', 0),
    array('Cílová adresa pro odkaz \'Zobrazit dal¹í obrázky\' v odkazu pohlednice', 'ecards_more_pic_target', 0),
    array('Jazyk', 'lang', 5),
    array('Témátko', 'theme', 6),

    'Nastavení zobrazení',
    array('©íøka hlavní tabulky v (pixelech nebo %)', 'main_table_width', 0),
    array('Poèet úrovní subkategorií', 'subcat_level', 0),
    array('Poèet galerií na stránku', 'albums_per_page', 0),
    array('Poèet sloupcù v pøehledu galerií', 'album_list_cols', 0),
    array('Velikost náhledù v pixelech', 'alb_list_thumb_size', 0),
    array('Obsah hlavní stránky', 'main_page_layout', 0),
    array('Ukazovat v kategoriích náhledy galerií první úrovnì','first_level',1),

    'Zobrazení náhledù',
    array('Poèet sloupcù na stránku', 'thumbcols', 0),
    array('Poèet øádkù na stránku', 'thumbrows', 0),
    array('Maximální mno¾ství zálo¾ek', 'max_tabs', 0),
    array('Zobrazit legendu obrázku pod náhledem', 'caption_in_thumbview', 1),
    array('Zobrazit poèet komentáøù pod náhldem', 'display_comment_count', 1),
    array('Základní øazení náhledù', 'default_sort_order', 3),
    array('Min. poèet hlasù potøebný k zaøazení do seznamu \'Nejlépe hodnocené\'', 'min_votes_for_rating', 0),

    'Zobrazení obrázkù &amp; Nastavení komentáøù',
    array('©íøka tabulky pro zobrazení obrázku (v pixelech nebo %)', 'picture_table_width', 0),
    array('V¾dy zobrazit podrobné info', 'display_pic_info', 1),
    array('CENZUROVAT slova v komentáøích', 'filter_bad_words', 1),
    array('Povilit smajlíky v komentáøích', 'enable_smilies', 1),
    array('Maximální dálka popisu obrázku', 'max_img_desc_length', 0),
    array('Maximální délka slova v komentáøi', 'max_com_wlength', 0),
    array('Maximální mno¾ství øádkù v komentáøi', 'max_com_lines', 0),
    array('Maximální délka komentáøe', 'max_com_size', 0),
    array('Ukázat filmový prou¾ek', 'display_film_strip', 1),
    array('Poèet polo¾ek ve filmovém prou¾ku', 'max_film_strip_items', 0),

    'Obrázky a nastavení náhledù',
    array('Kvalita souborù JPEG', 'jpeg_qual', 0),
    array('Maximální rozmìry náhledu <b>*</b>', 'thumb_width', 0),
    array('Pou¾ít rozmìr ( ¹íøka nebo vý¹ka nebo maximální rozmìr náhledu )<b>*</b>', 'thumb_use', 7),
    array('Vytvoøit støední obrázek','make_intermediate',1),
    array('Maximální ¹íøka nebo vý¹ka støeního obrázku <b>*</b>', 'picture_width', 0),
    array('Maximální velikost uploadovaných obrázkù (KB)', 'max_upl_size', 0),
    array('Maximální rozmìry uploadovaných obrázkù (v pixelech)', 'max_upl_width_height', 0),

    'Nastavení u¾ivatelù',
    array('Povolit registraci nových u¾ivatelù', 'allow_user_registration', 1),
    array('Pro registraci vy¾adovat potvrzení admina', 'reg_requires_valid_email', 1),
    array('Povolit pro dva u¾ivatele stejný email', 'allow_duplicate_emails_addr', 1),
    array('Mají mít u¾ivatelé vlastní galerii?', 'allow_private_albums', 1),

    'Custom fields for image description (Nechte prázné a nezobrazí se)',
    array('Jméno polo¾ky 1', 'user_field1_name', 0),
    array('Jméno polo¾ky 2', 'user_field2_name', 0),
    array('Jméno polo¾ky 3', 'user_field3_name', 0),
    array('Jméno polo¾ky 4', 'user_field4_name', 0),

    'Obrázky a náhledy roz¹íøené nastavení',
    array('Zobrazit ikonu zamknuté galerie nepøihlá¹enému u¾ivateli.','show_private',1),
    array('Znaky zakázané v názvech souborù', 'forbiden_fname_char',0),
    array('Povolené koncovky uploadovaných souborù', 'allowed_file_extensions',0),
    array('Metoda zmìny velikosti obrázkù','thumb_method',2),
    array('Cesta k ImageMagicu (pøíklad /usr/bin/X11/)', 'impath', 0),
    array('Povolené typy obrázkù (pouze pro ImageMagic)', 'allowed_img_types',0),
    array('Parametry pro ImageMagic', 'im_options', 0),
    array('Èíst EXIF data ze souborù JPEG', 'read_exif_data', 1),
    array('Adresáø pro galerie <b>*</b>', 'fullpath', 0),
    array('Adresáø pro galerie u¾ivatelù <b>*</b>', 'userpics', 0),
    array('Prefix pro støednì velké obrázky <b>*</b>', 'normal_pfx', 0),
    array('Prefix pro náhledy <b>*</b>', 'thumb_pfx', 0),
    array('Základní mód pro adresáøe', 'default_dir_mode', 0),
    array('Základní mód pro obrázky', 'default_file_mode', 0),

    'Cookies &amp; Kódová stráka',
    array('Jméno cookies u¾ívané programem (expertní volba)', 'cookie_name', 0),
    array('Cesta pro cookies u¾ívaná programem (expertní volba)', 'cookie_path', 0),
    array('Kódová stránka', 'charset', 4),

    'Dal¹í nastavení',
    array('Zapnour debug mód (jen pro testování)', 'debug_mode', 1),

    '<br /><div align="center">(*) Polo¾ky oznaèené * se NESMÍ zmìnit pokud ji¾ máte ve va¹í Galerii nahrané obrázky</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
    'empty_name_or_com' => 'Vlo¾te jméno a Vá¹ komentáø',
    'com_added' => 'Vá¹ komentáø byl pøidán',
    'alb_need_title' => 'Prosím, dejte galerii nadpis !',
    'no_udp_needed' => 'Aktualizace není tøeba.',
    'alb_updated' => 'Galerie byla pøidána',
    'unknown_album' => 'Vybrané album neexistuje nebo nemáte práva pro upload do tohoto alba',
    'no_pic_uploaded' => 'Obrázek nebyl uploadován!<br /><br />zkontrolujte zda server podporuje upload souborù, èi zda jste opravdu zadal(a) obrázek k uploadu...',
    'err_mkdir' => '  ERROR: Chyba pøi vytváøení adresáøe (nebyl vytvoøen) %s !',
    'dest_dir_ro' => 'Do cílového adresáøe %s nemù¾e skript zapisovat (zkontrolujte práva) !',
    'err_move' => 'Nelze pøesunout %s do %s !',
    'err_fsize_too_large' => 'Rozmìry obrázku, který se sna¾íte uploadovat, jsou pøíli¹ velké (max. velikost je %s x %s) !',
    'err_imgsize_too_large' => 'Velikost souboru, který se sna¾íte uploadovat, je pøíli¹ velká (max. velikost je %s KB) !',
    'err_invalid_img' => 'Soubor který jste nahrál(a) na server není validním obrázkem !',
    'allowed_img_types' => 'Mù¾ete uploadovat pouze obrázky %s .',
    'err_insert_pic' => 'Obrázek \'%s\' nelze vlo¾it do galerie ',
    'upload_success' => 'Vá¹ obrázek byl nahrán na server bez problémù<br /><br />Bude viditelný po schválení adminem.',
    'info' => 'Informace',
    'com_added' => 'Komentáøu pøidáno',
    'alb_updated' => 'Galerie aktualizována',
    'err_comment_empty' => 'Vá¹ komentáø je prázdný !',
    'err_invalid_fext' => 'Pouze soubory s následujícími koncovkami jsou podporované : <br /><br />%s.',
    'no_flood' => 'Jste autor posledního komentáøe k tomuto obrázku<br /><br />Pokud ho chcete zmìnit pou¾ijte volbu upravit ',
    'redirect_msg' => 'Právì jste pøesmìrováván(a).<br /><br /><br />Kliknìte na \'POKRAÈOVAT\' pokud se stránka nepøesmìruje sama',
    'upl_success' => 'Vá¹ obrázek byl v poøádku pøidán',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
    'caption' => 'Legenda(popisek)',
    'fs_pic' => 'pùvodní velikost obrázku',
    'del_success' => 'bezchybnì smazáno',
    'ns_pic' => 'normální velikost obrázku',
    'err_del' => 'nelze smazat',
    'thumb_pic' => 'náhled',
    'comment' => 'komentáø',
    'im_in_alb' => 'patøí do galerie',
    'alb_del_success' => 'Galerie \'%s\' smazána',
    'alb_mgr' => 'Správce galerií',
    'err_invalid_data' => 'Obdr¾ena chybná data \'%s\'',
    'create_alb' => 'Vytváøím galerii \'%s\'',
    'update_alb' => 'Aktualizuji galerii \'%s\' s nadpisem \'%s\' a seznamem \'%s\'',
    'del_pic' => 'Smazat obrázek',
    'del_alb' => 'Smazat galerii',
    'del_user' => 'Smazat u¾ivatele',
    'err_unknown_user' => 'Vybraný u¾ivatel neexistuje !',
    'comment_deleted' => 'Komentáø bezchybnì smazán ! ',
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
    'confirm_del' => 'Jste si jist, ¾e chcete smazat tento obrázek ? \\nPøilo¾ené komentáøe budou straceny.',
      'del_pic' => 'SMAZAT TENTO OBRÁZEK',
    'size' => '%s x %s pixelelù',
    'views' => '%s krát',
    'slideshow' => 'Slideshow',
    'stop_slideshow' => 'ZASTAVIT SLIDESHOW',
        'view_fs' => 'kliknìte pro zobrazení pùvodního obrázku',
);

$lang_picinfo = array(
    'title' =>'Informace o obrázku',
    'Filename' => 'Jméno souboru',
    'Album name' => 'Jméno galerie',
    'Rating' => 'Hodnocení (%s hlas(ù))',
    'Keywords' => 'Klíèová slova',
    'File Size' => 'Velikost souboru',
    'Dimensions' => 'Rozmìry',
    'Displayed' => 'Zobrazeno',
    'Camera' => 'Fotoaparát',
    'Date taken' => 'Datum poøízení snímku',
    'Aperture' => 'Clona',
    'Exposure time' => 'Expozièní èas',
    'Focal length' => 'Ohnisková vzdálenost',
    'Comment' => 'Komentáøe',
    'addFav' => 'Pøidat k oblíbeným',
    'addFavPhrase' => 'Oblíbené',
    'remFav' => 'Odstranit z oblíbených',
);

$lang_display_comments = array(
    'OK' => 'OK',
    'edit_title' => 'Upravit tento komentáø',
    'confirm_delete' => 'Jste si jist(a), ¾e chcete smazat tento komentáø ?',
    'add_your_comment' => 'Pøidat komentáø',
    'name'=>'Jméno',
    'comment'=>'Komentáø',
    'your_name' => 'Anonym',
);

$lang_fullsize_popup = array(
        'click_to_close' => 'Kliknutím na obrázek zavøete okno',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
    'title' => 'Poslat pohlednici',
    'invalid_email' => '<b>Varování</b> : neplatná emailová adresa !',
    'ecard_title' => 'Pohlednice ze serveru %s pro vás/tebe',
    'view_ecard' => 'Pokud se pohlednice nezobrazila klikni na link',
    'view_more_pics' => 'Klikni pro dal¹í obrázky !',
    'send_success' => 'Va¹e pohlednice byla odeslána',
    'send_failed' => 'Omlouváme se, ale server nebyl schopen odeslat Va¹í pohlednici zkuste
     to znovu za chvíli...',
    'from' => 'Od',
    'your_name' => 'Va¹e jméno',
    'your_email' => 'Vá¹ email',
    'to' => 'Komu',
    'rcpt_name' => 'Jméno pøíjemce',
    'rcpt_email' => 'Doruèit na email',
    'greetings' => 'Pozdrav/oslovení',
    'message' => 'Zpráva',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
    'pic_info' => 'Info&nbsp;o obrázku',
    'album' => 'Galerie',
    'title' => 'Nadpis',
    'desc' => 'Popis',
    'keywords' => 'Klíèová slova',
    'pic_info_str' => '%sx%s - %sKB - %s zobrazení - %s hlas(ù)',
    'approve' => 'Schválit obrázek',
    'postpone_app' => 'Odlo¾it schválení',
    'del_pic' => 'Smazat obrázek',
    'reset_view_count' => 'Vynulovat poèítadlo zobrazení',
    'reset_votes' => 'Vynulovat hlasy',
    'del_comm' => 'Smazat komentáøe',
    'upl_approval' => 'Potvrzení uploadu',
    'edit_pics' => 'Upravit obrázky',
    'see_next' => 'Zobrazit dal¹í obrázky',
    'see_prev' => 'Zobrazit pøedchozí obrázky',
    'n_pic' => '%s obrázkù',
    'n_of_pic_to_disp' => 'Poèet obrázku k zobrazení',
    'apply' => 'Ulo¾it zmìny'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
    'group_name' => 'Jméno skupiny',
    'disk_quota' => 'Disková kvóta',
    'can_rate' => 'Mohou hodnotit obrázky',
    'can_send_ecards' => 'mohou posílat pohlednice',
    'can_post_com' => 'Mohou posílat komentáøe',
    'can_upload' => 'Mohou nahrávat obrázky',
    'can_have_gallery' => 'Mohou mít osobní galerii',
    'apply' => 'Ulo¾it zmìny',
    'create_new_group' => 'Vytvoøit novou skupinu',
    'del_groups' => 'Smazat vybrané skupiny',
    'confirm_del' => 'Pokud sma¾ete tuto skupinu v¹ichni u¾ivatelé, patøící do této skupiny budou pøesunuti do skupiny \'Registered\' !\n\nPøejete si pokraèovat ?',
    'title' => 'Spravovat u¾ivatelské skupiny',
    'approval_1' => 'Potvrzení veøejného. Upl. (1)',
    'approval_2' => 'Potvrzení soukromého. Upl. (2)',
    'note1' => '<b>(1)</b> Upload do veøejných galerií vy¾aduje potvrzení adminem',
    'note2' => '<b>(2)</b> Upload do galerie patøící u¾ivateli vy¾aduje potvrzení adminem',
    'notes' => 'Poznámky'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
    'welcome' => 'Welcome !'
);

$lang_album_admin_menu = array(
    'confirm_delete' => 'Jste si jist(a), ¾e chcete smazat tuto galerii? \\nV¹echny obrázky a komentáøe pùjdou do pekla taky. Pøejete si pokraèovat.',
    'delete' => 'SMAZAT',
    'modify' => 'VLASTNOSTI',
    'edit_pics' => 'UPRAVIT OBR.',
);

$lang_list_categories = array(
    'home' => 'Domù',
    'stat1' => '<b>[pictures]</b> obrázky v <b>[albums]</b> glalerii <b>[cat]</b>v kategorii s <b>[comments]</b> komentáøi zobrazeno <b>[views]</b> krát',
    'stat2' => '<b>[pictures]</b> obrázky v <b>[albums]</b> galerii zobrazeno <b>[views]</b> krát',
    'xx_s_gallery' => '%s\' Galerie',
    'stat3' => '<b>[pictures]</b> obrázkù v <b>[albums]</b> galserii s <b>[comments]</b> komentáøi zobrazeno <b>[views]</b> krát'
);

$lang_list_users = array(
    'user_list' => 'Seznam u¾ivatelù',
    'no_user_gal' => 'Nejsou ¾ádné u¾ivatelské alerie',
    'n_albums' => '%s galerií',
    'n_pics' => '%s obrázkù'
);

$lang_list_albums = array(
    'n_pictures' => '%s obrázkù',
    'last_added' => ', poslední pøidán %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
    'login' => 'Pøihlá¹ení',
    'enter_login_pswd' => 'Zadejte Va¹e jméno a heslo pro pøihlá¹ení',
    'username' => 'Jméno',
    'password' => 'Heslo',
    'remember_me' => 'Pamatuj si mì',
    'welcome' => 'Vítej u nás %s ...',
    'err_login' => '*** Chyba pøi pøihlá¹ení skuste to znova ***',
    'err_already_logged_in' => 'Ji¾ jste pøihlá¹en !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
    'logout' => 'Odhlásit',
    'bye' => 'Tak si to u¾ij zase jinde %s ...',
    'err_not_loged_in' => 'Nejste pøihlá¹en !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
    'upd_alb_n' => 'Aktualizovat album %s',
    'general_settings' => 'Základní nastavení',
    'alb_title' => 'Nadpis galerie',
    'alb_cat' => 'Kategorie galerie',
    'alb_desc' => 'Popis galerie',
    'alb_thumb' => 'Náhled reprezentující album',
    'alb_perm' => 'Pøístupová práva pro tuto galerii',
    'can_view' => 'Album mù¾ou prohlí¾et',
    'can_upload' => 'Náv¹tìvníci smìjí pøidávat obrázky',
    'can_post_comments' => 'Povolit komentáøe',
    'can_rate' => 'Náv¹tìvníci mohou hlasovat',
    'user_gal' => 'User Gallery',
    'no_cat' => '* Není kategorie *',
    'alb_empty' => 'Galerie je prázdná',
    'last_uploaded' => 'Nejnovìj¹í obrázek',
    'public_alb' => 'kdokoliv (veøejná galerie)',
    'me_only' => 'Pouze já',
    'owner_only' => 'Pouze vlastník (%s)',
    'groupp_only' => 'Èlenové skupiny \'%s\'',
    'err_no_alb_to_modify' => 'Album nelze modifikovat v databázi.',
    'update' => 'Aktualizovat album'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
    'already_rated' => 'Tento obázek jste ji¾ hodnotil(a)',
    'rate_ok' => 'Vás hlas byl pøijat. Dìkujeme.',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
Administrátoøi serveru {SITE_NAME}, pota¾mo této galerie si vyhrazují právo zásahu do obsahu galerie napø. komentáøe, mazání obrázkù pøípadnì úprava (pokud poru¹ují pravidla galerie nebo dobré mravy).
Pokud budou obrázky nahrané u¾ivetelem poru¹ovat zákon(y) budou ihned po zji¹tìní jejich umístìní na serveru smazány. Administrátoøi/provozovatelé této galerie si distancují od
pøípadného závadného obsahu nahraného na server u¾ivateli. Vlastníkem dat v galerii jsou jejich autoøi. Administrátoøi pøedpokládají, ¾e na server jsou umís»ovaná u¾ivateli pouze obrázky k ním¾ vlastní u¾ivatel autorská práva.
<br />
Pokud souhlasíte, ¾e nebudete posílat jakýkoliv závadný materiál jako vulgární a obscéní obrázky/komentáøe, jakýkoliv materiál vzbuzující nenávist, rasismus, nebo jiný materiál poru¹ující zákony. Souhlasíte, ¾e administrátoøi, provozovatelé a moderátoøi  {SITE_NAME}   mají právo smazat pøípadnì upravit jakýkoliv materiál kdykoliv to uznají za vhodné. Vlo¾ené informace budou ulo¾ené na serveru a v databázi a nebudou poskytnuty ¾ádné tøetí stranì bez va¹eho souhlasu. Administátoøi/povozovatelé serveru  v¹ak nejsou ani nebudou ruèit za data na serveru ulo¾ená pokud dojde k jakémukoliv útoku na sever.
<br />
<br />
Tyto stránky vyu¾ívají k ulo¾ení u¾ivatelských dat cookies. Cookies slou¾í pouze pro zvý¹ení konfortu pøi pou¾ívání této aplikace. Emailová adresa slou¾í jen pro potvrzení va¹ich údajù a poslání hesla.<br />
<br />
Kliknutím na 'Souhlasím' souhlasíte z vý¹e uvedenými pravidly..
EOT;

$lang_register_php = array(
    'page_title' => 'Registrace nového u¾ivatele',
    'term_cond' => 'Podmínky a pravidla',
    'i_agree' => 'Souhlasím',
    'submit' => 'Poslat registraci',
    'err_user_exists' => 'Zadané u¾ivatelské jméno ji¾ existuje vyberte si prosím jiné',
    'err_password_mismatch' => 'Hesla se musí schodovat pokuste je obì zadat znovu',
    'err_uname_short' => 'Minimální délka u¾ivatelského jména je 2 znaky',
    'err_password_short' => 'Heslo musí být alespoò 2 znaky dlouhé',
    'err_uname_pass_diff' => 'Jméno a heslo se nesmí shodovat',
    'err_invalid_email' => 'Byla zadána neplatná emailová adresa',
    'err_duplicate_email' => 'Jiný u¾ivatel se zaregistroval se zadaným emailem. Email musí být jedineèný',
    'enter_info' => 'Zadané registraèní informace',
    'required_info' => 'Vy¾adované informace',
    'optional_info' => 'Volitelné informace',
    'username' => 'Jméno',
    'password' => 'Heslo',
    'password_again' => 'Heslo (potvrzení)',
    'email' => 'Email',
    'location' => 'Místo (napø. Brno apod.)',
    'interests' => 'Zájmy',
    'website' => 'Domácí stránka',
    'occupation' => 'Povolání',
    'error' => 'CHYBA',
    'confirm_email_subject' => '%s - Potvrzení registracce',
    'information' => 'Informace',
    'failed_sending_email' => 'Nelze odeslat potvrzení registace !',
    'thank_you' => 'Dìkujeme za registraci.<br /><br />Na adresu zadanou pøi registraci Vám budou doruèeny informace o aktivaci va¹eho úètu',
    'acct_created' => 'Vá¹ u¾ivatelský úèet byl bezchybnì vytvoøen. Nyní se pøihla¹te pomocí va¹eho jména a hesla',
    'acct_active' => 'Vá¹ úèet je nyní aktivní pøihla¹te se pomocí va¹eho jména a hesla.',
    'acct_already_act' => 'Vá¹ úèet je ji¾ aktivní !',
    'acct_act_failed' => 'Tento úèet nmù¾e být aktivován !',
    'err_unk_user' => 'Vybraný u¾ivatel neexistuje !',
    'x_s_profile' => '%s\' profil',
    'group' => 'Skupina',
    'reg_date' => 'Pøipojen',
    'disk_usage' => 'Vyu¾ití disku',
    'change_pass' => 'Zmìnit heslo',
    'current_pass' => 'Souèasné heslo',
    'new_pass' => 'Nové heslo',
    'new_pass_again' => 'Nové heslo (kontola)',
    'err_curr_pass' => 'Souèasné heslo zadáno nesprávnì',
    'apply_modif' => 'potvrdit zmìny',
    'change_pass' => 'Zmìnit heslo',
    'update_success' => 'Vá¹ profil byl aktualizován',
    'pass_chg_success' => 'Vy¹e heslo bylo zmìnìno',
    'pass_chg_error' => 'Va¹e heslo nebylo zmìnìno',
);

$lang_register_confirm_email = <<<EOT
Dìkujeme za registraci na {SITE_NAME}

Va¹e jméno je : "{USER_NAME}"
Va¹e heslo je: "{PASSWORD}"

Pro aktivaci va¹eho úètu je pøeba kliknout na odkaz ní¾e nebo ho zkopírovat
do adresního øádku va¹eho browseru a pøejít na tuto stránku


{ACT_LINK}

S Pozdravem,

Správa serveru {SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
    'title' => 'Kontrola komentáøù',
    'no_comment' => 'Zde nejsou komentáøe ke kontrole',
    'n_comm_del' => '%s komentáø(ù) smazán(o)',
    'n_comm_disp' => 'Poèet komentáøù k zobrazení',
    'see_prev' => 'Pøedchozí',
    'see_next' => 'Dal¹í',
    'del_comm' => 'Smazat vybrané komentáøe',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
    0 => 'Prohledávat obrázky',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
    'page_title' => 'Najít nové obrázky',
    'select_dir' => 'Vybrat adresáø',
    'select_dir_msg' => 'Tato funkce vám umo¾ní dávkovì zpracovat obrázky nahrané pøes FTP.<br /><br />Vyberte adresáø kde se nacházejí obrázky k spracování',
    'no_pic_to_add' => 'Nejsou zde ¾ádné obrázky k pøidání',
    'need_one_album' => 'Poøebujete mít vytvoøenu alespoò jednu galerii',
    'warning' => 'Varování',
    'change_perm' => 'Skript nemù¾e zapisovat do tohoto adresáøe, musíte ho nastavit na CHMOD 755 nebo 777 pøed pøidáním obrázkù !',
    'target_album' => '<b>Vlo¾it obrázky z &quot;</b>%s<b>&quot; do </b>%s',
    'folder' => 'Slo¾ka',
    'image' => 'Obrázek',
    'album' => 'Galerie',
    'result' => 'Výsledek',
    'dir_ro' => 'Nezapisovatelná. ',
    'dir_cant_read' => 'Neèitelná. ',
    'insert' => 'Pøidávám nové obrázky do galerie',
    'list_new_pic' => 'Seznam obrázkù',
    'insert_selected' => 'Vlo¾it vybrané obrázky',
    'no_pic_found' => 'Nové obrázky nenalezeny',
    'be_patient' => 'Prosím buïte trpìlivý(á), program potøebuje na zpracování obrázku nìjaý ten èas.',
    'notes' =>  '<ul>'.
                '<li><b>OK</b> : Tyto obrázky byly pøidány'.
                '<li><b>DP</b> : Zdvojení!, Tento obrázek ji existuje'.
                '<li><b>PB</b> : tento obrázek nelze pøidat, skontrolujte konfiguraci pøípadnì pøístupová práva'.
                '<li>Kdy¾ se neuká¾e \'oznaèení\' OK, DP, PB klepnìte na obrázek a uvidíte chybovou hlá¹ku generovanou PHP, která Vám pomù¾e zjistit pøíèinu problému'.
                '<li>Pokud dojde k timeoutu F5 nebo reload stránky by mìl pomoci'.
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
                'title' => 'Vykopnutí u¾ivatelé',
                'user_name' => 'U¾ivatelské jméno',
                'ip_address' => 'IP Adresa',
                'expiry' => 'Vypr¹í za (nevyplòovat pro stálé vykopnutí)',
                'edit_ban' => 'Ulo¾it zmìny',
                'delete_ban' => 'Smazat',
                'add_new' => 'Pøidat dal¹í vykopnutí',
                'add_ban' => 'Pøidat',
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
    'title' => 'Uploadnout obrázek',
    'max_fsize' => 'Max. velikost souboru je %s KB',
    'album' => 'Galerie',
    'picture' => 'Obrázek',
    'pic_title' => 'Nadpis obrázku',
    'description' => 'Popis obrázku',
    'keywords' => 'Klíèová slova (oddìlená mezerou)',
    'err_no_alb_uploadables' => 'Zde se nenalézá galerie do které je povolen upload.',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
    'title' => 'Spravovat u¾ivatele',
    'name_a' => 'Jméno vzestup.',
    'name_d' => 'Jméno sestup.',
    'group_a' => 'Skupina vzestup.',
    'group_d' => 'Skupina sestup.',
    'reg_a' => 'Datum registrace vzestup.',
    'reg_d' => 'Datum registrace sestup.',
    'pic_a' => 'Poèet obrázkù vzestup.',
    'pic_d' => 'Poèet obrázkù sestup.',
    'disku_a' => 'Vyu¾ití disku vzestup.',
    'disku_d' => 'Vyu¾ití disku sestup.',
    'sort_by' => 'Øadit u¾øivatele podle',
    'err_no_users' => 'Tabulka u¾ivatelù je prázdná!',
    'err_edit_self' => 'Zde nelze editovat vlastní profil pou¾ijte pøíslu¹nou volbu pracující s va¹ím profilem',
    'edit' => 'UPRAVIT',
    'delete' => 'SMAZAT',
    'name' => 'U¾iv. jméno',
    'group' => 'Skupina U¾iv.',
    'inactive' => 'Neaktivní',
    'operations' => 'Operace',
    'pictures' => 'Obrázky',
    'disk_space' => 'Místo vyu¾ité / kvóta',
    'registered_on' => 'Registrován',
    'u_user_on_p_pages' => '%d u¾ivatelù na %d stránkách',
    'confirm_del' => 'Jste si jist(a), ¾e chcete smazat tohoto u¾ivatele ? \\nV¹echny jeho obrázky, galerie a komentáøe budou smazány.',
    'mail' => 'MAIL',
    'err_unknown_user' => 'Vybraný u¾iv. neexistuje !',
    'modify_user' => 'Zmìnit u¾iv.',
    'notes' => 'Poznámky',
    'note_list' => '<li>Pokud nechcete zmìnit heslo ponechte políèko pro heslo prázdné',
    'password' => 'Heslo',
    'user_active' => 'U¾iv. je aktivní',
    'user_group' => 'U¾iv. Skupina',
    'user_email' => 'U¾iv. emaill',
    'user_web_site' => 'U¾iv. domácí stránka',
    'create_new_user' => 'Vytvoøit nového u¾ivatle.',
    'user_location' => 'Místo U¾iv. (napø. Praha apod.)',
    'user_interests' => 'U¾iv. zájmy',
    'user_occupation' => 'U¾iv. povolání',
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => 'Zmìnit velikost obrázku',
        'what_it_does' => 'Co to dìlá?',
        'what_update_titles' => 'Aktualizovat nadpisy podle jména souborù',
        'what_delete_title' => 'Smazat nadpisy',
        'what_rebuild' => 'Pøedìlat nahledy a zmìnìné obrázky',
        'what_delete_originals' => 'Smazat originály a nahradit je støedními obrázky',
        'file' => 'Soubor',
        'title_set_to' => 'Nastavit nadpis na',
        'submit_form' => 'odeslat',
        'updated_succesfully' => 'Aktualizace probìhla OK',
        'error_create' => 'CHYBA pøi vytváøení',
        'continue' => 'Zpracovatvíce obrázkù',
        'main_success' => 'Skoubor %s byl uspì¹nì pou¾it jako hlavní obrázek',
        'error_rename' => 'Chyba pøejmenování %s na %s',
        'error_not_found' => 'Soubor %s nebyl nalezen',
        'back' => 'zpìt na halvní',
        'thumbs_wait' => 'Aktualizuji náhledy a/nebo støední obrázky, prosím èekejte...',
        'thumbs_continue_wait' => 'Pokraèuji v aktualizaci náhledù a/nebo støedních obrázkù...',
        'titles_wait' => 'Aktualizuji nadpisy, prosím èekejte...',
        'delete_wait' => 'Ma¾u nadpisy, prosím èekejte...',
        'replace_wait' => 'Ma¾u originály a nahrazuji je støedními obrázky, prosím èekejte...',
        'instruction' => 'Rychlé instrukce',
        'instruction_action' => 'Vyberte akci',
        'instruction_parameter' => 'Nastavit parametry',
        'instruction_album' => 'Vybrat galerii',
        'instruction_press' => 'Stisknìte %s',
        'update' => 'Aktualizovat náhledy a/nebo støední obrázky',
        'update_what' => 'Co má být aktualizováno',
        'update_thumb' => 'Jen náhledy',
        'update_pic' => 'Pouze støední obrázky',
        'update_both' => 'Obojí náhledy i støední obrázky',
        'update_number' => 'Poèet obrázkù, které zpracovat na 1 kliknutí',
        'update_option' => '(Sni¾te èíslo pokud máte problémy s timeoutem)',
        'filename_title' => 'Jméno souboru ? Nadpis obrázku',
        'filename_how' => 'Jak se má zmìnit jméno obrázku?',
        'filename_remove' => 'Odstranit .jpg koncovku a pøepsat _ (podtr¾ítka mezerami)',
        'filename_euro' => 'Zmìnit 2003_11_23_13_20_20.jpg na 23/11/2003 13:20',
        'filename_us' => 'Zmìnit 2003_11_23_13_20_20.jpg na 11/23/2003 13:20',
        'filename_time' => 'Zmìnit 2003_11_23_13_20_20.jpg na 13:20',
        'delete' => 'Smazat nadpisy obrázkù nebo originální obrázky',
        'delete_title' => 'Smazat nadpisy obrázkù',
        'delete_original' => 'Smazat originální obrázky',
        'delete_replace' => 'Smazat originály a nahradit je støední verzí obrázkù',
        'select_album' => 'Vybrat galerii',
);
?>
