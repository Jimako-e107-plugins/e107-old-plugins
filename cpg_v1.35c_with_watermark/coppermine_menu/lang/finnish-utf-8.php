<?php
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
'lang_name_english' => 'Finnish',  //the name of your language in English, e.g. 'Greek' or 'Spanish' 
'lang_name_native' => 'Suomea', //the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Español' 
'lang_country_code' => 'fi', //the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es' 
'trans_name'=> 'V.Taavila', //the name of the translator - can be a nickname 
'trans_email' => 'quandox@kastema.to', //translator's email address (optional) 
'trans_website' => 'http://', //translator's website (optional) 
'trans_date' => '2003-10-14', //the date the translation was created / last modified 
); 

$lang_charset = 'iso-8859-15';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('Su', 'Ma', 'Ti', 'Ke', 'To', 'Pe', 'La');
$lang_month = array('Tammikuu', 'Helmikuu', 'Maaliskuu', 'Huhtikuu', 'Toukokuu', 'Kesäkuu', 'Heinäkuu', 'Elokuu', 'Syyskuu', 'Lokakuu', 'Marraskuu', 'Joulukuu');

// Some common strings
$lang_yes = 'Kyllä';
$lang_no  = 'Ei';
$lang_back = 'TAKAISIN';
$lang_continue = 'JATKA';
$lang_info = 'Info';
$lang_error = 'Virhe';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%B %d, %Y';
$lastcom_date_fmt =  '%m/%d/%y at %H:%M';
$lastup_date_fmt = '%B %d, %Y';
$register_date_fmt = '%B %d, %Y';
$lasthit_date_fmt = '%B %d, %Y at %I:%M %p';
$comment_date_fmt =  '%B %d, %Y at %I:%M %p';

// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array( 
        'random' => 'Satunaiset kuvat', 
        'lastup' => 'Uusimmat kuvat', 
        'lastalb'=> 'Viimeksi päivitetyt albumit', 
        'lastcom' => 'Uusimmat komentit', 
        'topn' => 'Katsotuimmat', 
        'toprated' => 'Suosituimmat', 
        'lasthits' => 'Viimeksi tarkasteltu', 
        'search' => 'Haun tulokset', 
        'favpics'=> 'Suosikkikini' 
); 

$lang_errors = array(
	'access_denied' => 'Ei oikeuksia tälle sivulle.',
	'perm_denied' => 'Ei oikeuksia kyseisen toiminnon suorittamiseen.',
	'param_missing' => 'Scriptiä kutsuttu ilman vaadittavia parametrejä.',
	'non_exist_ap' => 'Valittua albumia/kuvaa ei löydy !',
	'quota_exceeded' => 'Levytilasi on täynnä<br /><br />Levytilasi on täynnä [quota]K, kuviesi vievä tila [space]K, lisäämällä tämän kuvan tilasi koko ylittyisi.',
	'gd_file_type_err' => 'Kun käytät GD:tä sallitut tiedostomuodot ovat JPEG ja PNG.',
	'invalid_image' => 'Kuva on korruptoitunut eikä sitä voi käsitellä GD:llä',
	'resize_failed' => 'Ongelma thumbnailien luomisessa.',
	'no_img_to_display' => 'Ei näyttettäviä kuvia',
	'non_exist_cat' => 'Valittua kategoriaa ei löydy',
	'orphan_cat' => 'Ongelmia kategoriassa, aja kategoria manageri selvitääksesi ongelma.',
	'directory_ro' => 'Hakemistoon \'%s\' ei ole määritelty kirjoitusoikeuksia. Kuvia ei voi poistaa',
	'non_exist_comment' => 'Valittua kommenttia ei löydy.',
	'pic_in_invalid_album' => 'Kuvaa ei ole albumissa (%s)!?',
	'banned' => 'Sinulta on evätty pääsy tälle sivulle.', 
    'not_with_udb' => 'Tämä toiminto on poistettu käytöstä Coppermine gallerissa koska tämä on integroitu foorumi ohjelmistoon. Toiminto jota eritit tehdä ei ole tuettuna tässä kokoonpanossa, toiminto löytyy mahdollisesti foorumi ohjelmistosta.', 
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => 'Mene albumi listaan',
	'alb_list_lnk' => 'Albumi lista',
	'my_gal_title' => 'Mene omaan galleriaan',
	'my_gal_lnk' => 'Oma galleria',
	'my_prof_lnk' => 'Omat asetukset',
	'adm_mode_title' => 'Vaihda ylläpitotilaan',
	'adm_mode_lnk' => 'Ylläpitotila',
	'usr_mode_title' => 'Vaihda käyttäjätilaan',
	'usr_mode_lnk' => 'Käyttäjätila',
	'upload_pic_title' => 'Lisää kuva albumiin',
	'upload_pic_lnk' => 'Lisää kuva',
	'register_title' => 'Luo uusi tili',
	'register_lnk' => 'Rekisteröidy',
	'login_lnk' => 'Kirjaudu',
	'logout_lnk' => 'Poistu',
	'lastup_lnk' => 'Viimeksi lisätty',
	'lastcom_lnk' => 'Uusimmat kommentit',
	'topn_lnk' => 'Katsotuimmat',
	'toprated_lnk' => 'Suosituimmat',
	'search_lnk' => 'Haku',
	'fav_lnk' => 'Suosikkini',
	
);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => 'Tarkistettavat',
	'config_lnk' => 'Asetukset',
	'albums_lnk' => 'Albumit',
	'categories_lnk' => 'Kategoriat',
	'users_lnk' => 'Käyttäjät',
	'groups_lnk' => 'Ryhmät',
	'comments_lnk' => 'Kommentit',
	'searchnew_lnk' => 'Lisää "FTP" kuvat',
	'util_lnk' => 'Käsittele Kuvia',
	'ban_lnk' => 'Kiellä Käyttäjiä',
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => 'Luo / muokkaa albumeita',
	'modifyalb_lnk' => 'Muokkaa omaa albumia',
	'my_prof_lnk' => 'Omat asetukset',
);

$lang_cat_list = array(
	'category' => 'Kategoria',
	'albums' => 'Albumit',
	'pictures' => 'Kuvat',
);

$lang_album_list = array(
	'album_on_page' => '%d albumia %d sivu(a)'
);

$lang_thumb_view = array(
	'date' => 'PVM',
	//Sort by filename and title 
    'name' => 'NIMI', 
    'title' => 'OTSIKKO', 
	'sort_da' => 'Järjestä päivämäärittäin nousevasti',
	'sort_dd' => 'Järjestä päivämäärittäin laskevasti',
	'sort_na' => 'Järjestä nimellä nousevasti',
	'sort_nd' => 'Järjestä nimellä laskevasti',
	'sort_ta' => 'Järjestä otsikolla nousevasti', 
    'sort_td' => 'Järjestä otsikolla laskevasti',
	'pic_on_page' => '%d kuvaa %d sivu(a)',
	'user_on_page' => '%d käyttäjää %d sivu(a)'
);

$lang_img_nav_bar = array(
	'thumb_title' => 'Takaisin thumbnail sivulle',
	'pic_info_title' => 'Näytä/piilota kuvan tiedot',
	'slideshow_title' => 'diashow',
	'ecard_title' => 'Lähetä tämä kuva e-korttina',
	'ecard_disabled' => 'e-kortit pois päältä',
	'ecard_disabled_msg' => 'Sinulla ei ole oikeuksia lähettää e-kortteja',
	'prev_title' => 'Näytä edellinen kuva',
	'next_title' => 'Näytä seuraava kuva',
	'pic_pos' => 'KUVA %s/%s',
);

$lang_rate_pic = array(
	'rate_this_pic' => 'Äänestä tätä kuvaa ',
	'no_votes' => '(ei ääniä vielä)',
	'rating' => '(nykyinen taso : %s / 5 ja %s ääntä)',
	'rubbish' => 'Roskaa',
	'poor' => 'Tylsää',
	'fair' => 'Keskinkertainen',
	'good' => 'Hyvä',
	'excellent' => 'Loistava',
	'great' => 'Mahtava',
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
	CRITICAL_ERROR => 'Kriittinen Virhe',
	'file' => 'Tiedosto: ',
	'line' => 'Rivi: ',
);

$lang_display_thumbnails = array(
	'filename' => 'Tiedostonimi : ',
	'filesize' => 'Tiedostokoko : ',
	'dimensions' => 'Tarkkuus : ',
	'date_added' => 'Lisätty : '
);

$lang_get_pic_data = array(
	'n_comments' => '%s kommenttia',
	'n_views' => '%s tarkastelua',
	'n_votes' => '(%s ääntä)'
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
	'Exclamation' => 'Huuto',
	'Question' => 'Kysymys',
	'Very Happy' => 'Erittäin Iloinen',
	'Smile' => 'Hymy',
	'Sad' => 'Suru',
	'Surprised' => 'Yllättynyt',
	'Shocked' => 'Järkyttynyt',
	'Confused' => 'Häkeltynyt',
	'Cool' => 'Cool',
	'Laughing' => 'Nauru',
	'Mad' => 'Hullu',
	'Razz' => 'Razz',
	'Embarassed' => 'Embarassed',
	'Crying or Very sad' => 'Itkeä',
	'Evil or Very Mad' => 'Erittäin Hullu',
	'Twisted Evil' => 'Kieroutunut Hullu',
	'Rolling Eyes' => 'Pyörivät silmät',
	'Wink' => 'Vink',
	'Idea' => 'Idea',
	'Arrow' => 'Nuoli',
	'Neutral' => 'Neutraali',
	'Mr. Green' => 'Mr. Vihreä',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
	0 => 'Poistuu ylläpitotilasta...',
	1 => 'Sisään ylläpitotilaan...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => 'Albumi tarvitsee nimen !',
	'confirm_modifs' => 'Haluatko varmasti tehdä nämä muutokset ?',
	'no_change' => 'Et tehnyt yhtään muutosta !',
	'new_album' => 'Uusi albumi',
	'confirm_delete1' => 'Haluatko varmasti poistaa tämän albumin albumin ?',
	'confirm_delete2' => '\nKaikki kuvat ja kommentit tulevat poistumaan !',
	'select_first' => 'Valitse albumi ensin',
	'alb_mrg' => 'Albumi Manageri',
	'my_gallery' => '* Oma galleria *',
	'no_category' => '* Ei kategoriaa *',
	'delete' => 'Poista',
	'new' => 'Uusi',
	'apply_modifs' => 'Hyväksy muutokset',
	'select_category' => 'Valitse Kategoria',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => 'Toimintoa \'%s\'ei voitu suorittaa !',
	'unknown_cat' => 'Valittua kategoriaa ei ole enää tietokannassa',
	'usergal_cat_ro' => 'Käyttäjien gallerioiden kategorioita ei voi poistaa !',
	'manage_cat' => 'Hallitse kategorioita',
	'confirm_delete' => 'Haluatko varmasti POISTAA tämän kategorian',
	'category' => 'Kategoria',
	'operations' => 'Toiminnot',
	'move_into' => 'Siirrä',
	'update_create' => 'Päivitä/Luo kategoria',
	'parent_cat' => 'Pääkategoria',
	'cat_title' => 'Kategorian otsikko',
	'cat_desc' => 'Kategorian tarkenne'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => 'Asetukset',
	'restore_cfg' => 'Palauta oletukset',
	'save_cfg' => 'Tallenna muutokset',
	'notes' => 'Huomio',
	'info' => 'Info',
	'upd_success' => 'Coppermine asetukset päivitetty',
	'restore_success' => 'Coppermine oletusasetukset palautettu',
	'name_a' => 'Nimi nousevasti',
	'name_d' => 'Nimi laskevasti',
	'title_a' => 'Otsikko nousevasti', 
    'title_d' => 'Otsikko laskevasti',
	'date_a' => 'Päivä nousevasti',
	'date_d' => 'Päivä laskevasti',
        'th_any' => 'Max Aspect',
        'th_ht' => 'Height',
        'th_wd' => 'Width',
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'Yleiset asetukset',
	array('Gallerian nimi', 'gallery_name', 0),
	array('Gallerian tarkenne', 'gallery_description', 0),
	array('Gallerian ylläpitäjän sähköposti', 'gallery_admin_email', 0),
	array('Kohde osoite \'Näytä enemmän kuvia\' linkki e-korteissa', 'ecards_more_pic_target', 0),
	array('Kieli', 'lang', 5),
	array('Teema', 'theme', 6),

	'Albumin "näyttö" asetukset',
	array('Päätaulukon leveys (pikseleissä tai %)', 'main_table_width', 0),
	array('Kuinka monta kategoriaa näytetään tasolla', 'subcat_level', 0),
	array('Kuinka monta albumia näytetään sivulla', 'albums_per_page', 0),
	array('Kuinka monta saraketta näytetään albumi listassa', 'album_list_cols', 0),
	array('Thumbnailien koko pikseleissä', 'alb_list_thumb_size', 0),
	array('Mitä tietoja etusivulla näytetään', 'main_page_layout', 0),
	array('Näytä ensimmäisen tason albumin thumbnailit kategoriassa','first_level',1),

	'Thumbnailien näyttö',
	array('Sarakkeita thumbnail sivulla', 'thumbcols', 0),
	array('Rivejä thumbnail sivulla', 'thumbrows', 0),
	array('Kaistaleiden maksimi määrä', 'max_tabs', 0),
	array('Näytä kuvateksti thumbnaileissa', 'caption_in_thumbview', 1),
	array('Näytä kommenttien määrä thumbnaileissa', 'display_comment_count', 1),
	array('Kuvien oletus järjestys', 'default_sort_order', 3),
	array('Tarvittavien äänien määrä ennen \'suosituimmat\' listalle pääsyä', 'min_votes_for_rating', 0),

	'Kuvien näyttö &amp; Kommentti asetukset',
	array('Kuvan näyttö taulukon leveys (pikseleinä tai %)', 'picture_table_width', 0),
	array('Kuvan info oletuksena piilotettu', 'display_pic_info', 1),
	array('Rumasana filtteri', 'filter_bad_words', 1),
	array('Hyväksy hymiöt kommentissa', 'enable_smilies', 1),
	array('Kuvatekstin maksimi pituus', 'max_img_desc_length', 0),
	array('Maksimi määrä merkkejä sanassa', 'max_com_wlength', 0),
	array('Kommentti rivien maksimi määrä', 'max_com_lines', 0),
	array('Kommentin maksimi pituus', 'max_com_size', 0),
	array('Näytä thumbnaileja kuva sivulla', 'display_film_strip', 1), 
    array('Thumbnaileja kuva sivulla', 'max_film_strip_items', 0), 

	'Kuvien ja thumbnailien asetukset',
	array('Tarkkuus JPEG tiedostoilla', 'jpeg_qual', 0),
	array('Thumbnail maksimi leveys tai korkeus <b>*</b>', 'thumb_width', 0),
    array('Käytä mittaa ( leveys tai korkeus tai Maksimi mitta thumbnaileissa )<b>*</b>', 'thumb_use', 7), 
	array('Luo väliaikaiset kuvat','make_intermediate',1),
	array('Väliaikaiset kuvien maksimi leveys tai korkeus <b>*</b>', 'picture_width', 0),
	array('Ladattavien kuvien maksimi koko (KB)', 'max_upl_size', 0),
	array('Ladattavien kuvien maksimi leveys (pikseleinä)', 'max_upl_width_height', 0),

	'Käyttäjä asetukset',
	array('Salli uusien käyttäjien rekisteröityä', 'allow_user_registration', 1),
	array('Rekisteröinti vaatii sähköposti varmistuksen', 'reg_requires_valid_email', 1),
	array('Salli kahdelle käyttäjälle sama sähköposti osoite', 'allow_duplicate_emails_addr', 1),
	array('Käyttäjät saavat yksityiset albumit', 'allow_private_albums', 1),

	'Valinnaiset kentät kuvan näytössä (jätä tyhjäksi jos et halua käyttää)',
	array('Kenttä 1 nimi', 'user_field1_name', 0),
	array('Kenttä 2 nimi', 'user_field2_name', 0),
	array('Kenttä 3 nimi', 'user_field3_name', 0),
	array('Kenttä 4 nimi', 'user_field4_name', 0),

	'Kuvien ja thumbnailien lisä asetukset',
	array('Näytä yksityisessa albumissa Ikoni kirjautumattomalle käyttäjälle','show_private',1),
	array('Kielletyt merkit tiedostonimissä', 'forbiden_fname_char',0),
	array('Hyväksytyt tiedotopäätteet', 'allowed_file_extensions',0),
	array('Kuvien koot muutetaan käyttämällä','thumb_method',2),
	array('Täydellinen ImageMagick polku \'konventteri\' (esimerkiksi /usr/bin/X11/)', 'impath', 0),
	array('Kyväksytyt kuva tyypit (kelpaa vain ImageMagickia käytettäessä)', 'allowed_img_types',0),
	array('ImageMagick komentorivin asetukset', 'im_options', 0),
	array('Lue EXIF tiedot JPEG kuvista', 'read_exif_data', 1),
	array('Albumi hakemisto <b>*</b>', 'fullpath', 0),
	array('Käyttäjien kuvien hakemisto <b>*</b>', 'userpics', 0),
	array('Väliaikaisten kuvien etuliite <b>*</b>', 'normal_pfx', 0),
	array('Thumbnailien etuliite <b>*</b>', 'thumb_pfx', 0),
	array('Hakemistojen oletus oikeudet', 'default_dir_mode', 0),
	array('Kuvien oletus oikeudet', 'default_file_mode', 0),

	'Eväste &amp; koodaus asetukset',
	array('Evästeen nimi', 'cookie_name', 0),
	array('Evästeen polku', 'cookie_path', 0),
	array('Käytettävä koodaus', 'charset', 4),

	'Muut asetukset',
	array('Näytä palvelimen virheilmoitukset', 'debug_mode', 1),
	
	'<br /><div align="center">(*) Kentät joissa on * merkki ei saa muuttaa jos galleriassa on jo kuvia.</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => 'Sinun on kirjoitettava nimesi kommenttiin',
	'com_added' => 'Kommenttisi on lisätty',
	'alb_need_title' => 'Albumin otsikko puuttuu !',
	'no_udp_needed' => 'Päivitysta ei tarvita.',
	'alb_updated' => 'Albumi päivitetty',
	'unknown_album' => 'Valittua albumia ei löydy tai sinulla ei ole oikeuksia siihen',
	'no_pic_uploaded' => 'Ei lisättyä kuvaa !<br /><br />Jos todella valitsit lisättävän kuvan pyydä ylläpitäjää tarkistamaan palvelimen asetukset...',
	'err_mkdir' => 'Virhe hakemiston luomisessa %s !',
	'dest_dir_ro' => 'Lähde hakemisto %s ei ole luettavissa !',
	'err_move' => 'Mahdotonta siirtää %s - %s !',
	'err_fsize_too_large' => 'Tiedosto jota yritit lisätä oli liian suuri (suurin sallittu koko %s x %s) !',
	'err_imgsize_too_large' => 'Tiedosto jota yritit lisätä oli liian suuri (suurin sallittu koko on %s KB) !',
	'err_invalid_img' => 'Tiedosto jota yritit lisätä ei hyväksytä !',
	'allowed_img_types' => 'Voit lisätä ainostaan %s kuvia.',
	'err_insert_pic' => 'Kuvaa \'%s\' ei voi liittää albumiin ',
	'upload_success' => 'Kuva lisätty onnistuneesti<br /><br />Se tulee julkiseksi jos ylläpitäjä hyväksyy sen.',
	'info' => 'Info',
	'com_added' => 'Kommentti lisätty',
	'alb_updated' => 'Albumi päivitetty',
	'err_comment_empty' => 'Kommenttisi oli tyhjä !',
	'err_invalid_fext' => 'Vain seuraavat tiedostopäätteet ovat sallittuja : <br /><br />%s.',
	'no_flood' => 'Viimeinen kommentti on jo lisätty<br /><br />Muokkaa kommenttia jos haluat muuttaa sitä',
	'redirect_msg' => 'Sinut siirretään.<br /><br /><br />Klikkaa \'JATKA\' jos sivu ei päivity automaattisesti',
	'upl_success' => 'Kuvasi lisätty onnistuneesti',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => 'Kuvateksti',
	'fs_pic' => 'täysikokoinen kuva',
	'del_success' => 'onnistuneesti poistettu',
	'ns_pic' => 'normaali kokoinen kuva',
	'err_del' => 'ei voi poistaa',
	'thumb_pic' => 'thumbnaili',
	'comment' => 'kommentti',
	'im_in_alb' => 'kuva albumissa',
	'alb_del_success' => 'Albumi \'%s\' poistettu',
	'alb_mgr' => 'Albumin Hallinta',
	'err_invalid_data' => 'Virhellistä dataa välitetty \'%s\'',
	'create_alb' => 'Luodaan albumia \'%s\'',
	'update_alb' => 'Päivitetään albumia \'%s\' otsikko \'%s\' ja indeksi \'%s\'',
	'del_pic' => 'Poista kuva',
	'del_alb' => 'Poista albumi',
	'del_user' => 'Poista käyttäjä',
	'err_unknown_user' => 'Valittua käyttäjää ei löydy !',
	'comment_deleted' => 'Komentti poistettu onnistuneesti',
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
	'confirm_del' => 'Haluatko varmasti POISTAA tämän kuvan ? \\nKommentit poistetaan samalla.',
	'del_pic' => 'POISTA TÄMÄ KUVA',
	'size' => '%s x %s pikseliä',
	'views' => '%s kertaa',
	'slideshow' => 'Diashow',
	'stop_slideshow' => 'PYSÄYTÄ DIASHOW',
	'view_fs' => 'Klikkaamalla kuvaa voit tarkastella sitä täysikokoisena',
);

$lang_picinfo = array(
	'title' =>'Kuvan tiedot',
	'Filename' => 'Tiedostonimi',
	'Album name' => 'Albumin nimi',
	'Rating' => 'Arvo (%s ääntä)',
	'Keywords' => 'Hakusanat',
	'File Size' => 'Tiedostokoko',
	'Dimensions' => 'Tarkkuus',
	'Displayed' => 'Tarkasteltu',
	'Camera' => 'Kamera',
	'Date taken' => 'Kuva otettu',
	'Aperture' => 'Aukko',
	'Exposure time' => 'Valotusaika',
	'Focal length' => 'Polttoväli',
	'Comment' => 'Kommentti',
	'addFav'=>'Lisää suosikkeihin', 
    'addFavPhrase'=>'Suosikit', 
    'remFav'=>'Poista suosikeista',
);

$lang_display_comments = array(
	'OK' => 'OK',
	'edit_title' => 'Muokkaa kommenttia',
	'confirm_delete' => 'Haluatko varmasti poistaa tämän kommentin ?',
	'add_your_comment' => 'Lisää kommenttisi',
	'name'=>'Nimi', 
    'comment'=>'Komenti', 
	'your_name' => 'Nimesi',
);

$lang_fullsize_popup = array( 
        'click_to_close' => 'Klikkaa kuvaa sulkeaksesi tämä ikkuna', 
); 

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => 'lähetä e-kortti',
	'invalid_email' => '<b>Varoitus</b> : virheellinen sähköposti osoite!',
	'ecard_title' => 'E-kortti %s sinulle',
	'view_ecard' => 'Jos e-kortti näkyy virheellisesti klikkaa tästä',
	'view_more_pics' => 'Klikkaa tästa nähdäksesi lisää kuvia !',
	'send_success' => 'E-kortti lähetetty',
	'send_failed' => 'Palvelin ei salli e-korttien lähetystä...',
	'from' => 'Lähettäjä',
	'your_name' => 'Nimesi',
	'your_email' => 'Sähköposti',
	'to' => 'Vastaanottaja',
	'rcpt_name' => 'Vastaanottajan nimi',
	'rcpt_email' => 'Vastaanottaja sähköposti',
	'greetings' => 'Terveiset',
	'message' => 'Viesti',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => 'Kuvan&nbsp;tiedot',
	'album' => 'Albumi',
	'title' => 'Otsikko',
	'desc' => 'Tarkenne',
	'keywords' => 'Hakusanat',
	'pic_info_str' => '%sx%s - %sKB - %s tarkastelua - %s ääntä',
	'approve' => 'Hyväksy kuva',
	'postpone_app' => 'Lykkää vahvistamista',
	'del_pic' => 'Poista kuva',
	'reset_view_count' => 'Nollaa laskuri',
	'reset_votes' => 'Nollaa äänet',
	'del_comm' => 'Poista kommentit',
	'upl_approval' => 'Lisätyt hyväksyttävät',
	'edit_pics' => 'Muokkaa kuvia',
	'see_next' => 'Näytä seuraavat kuvat',
	'see_prev' => 'Näytä edelliset kuvat',
	'n_pic' => '%s kuvat',
	'n_of_pic_to_disp' => 'Kuinka monta kuvaa näytetään',
	'apply' => 'Hyväksy muutokset'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => 'Ryhmän nimi',
	'disk_quota' => 'Levytila',
	'can_rate' => 'Voi äänestää kuvia',
	'can_send_ecards' => 'Voi lähettää e-kortteja',
	'can_post_com' => 'Voi kommentoida',
	'can_upload' => 'Voi lisätä kuvia',
	'can_have_gallery' => 'Voi saada oman gallerian',
	'apply' => 'Hyväksy muutokset',
	'create_new_group' => 'Luo uusi ryhmä',
	'del_groups' => 'Poista valitut ryhmät',
	'confirm_del' => 'Varoitus, kun poistat ryhmän, käyttäjät ketkä kuuluvat ryhmään siirretään \'Rekisteröidyt\' ryhmään !\n\nHaluatko jatkaa ?',
	'title' => 'Muokkaa käyttäjä ryhmiä',
	'approval_1' => 'Hyväksyntä asetus (1)',
	'approval_2' => 'Hyväksyntä asetus (2)',
	'note1' => '<b>(1)</b> Lisäykset julkiseen albumiin tarvitsevat ylläpidon hyväksynnän',
	'note2' => '<b>(2)</b> Lisäykset käyttäjän albumiin tarvitsevat ylläpidon hyväksynnän',
	'notes' => 'Huomio'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
	'welcome' => 'Tervetuloa !'
);

$lang_album_admin_menu = array(
	'confirm_delete' => 'Haluatko varmasti POISTAA tämän albumin ? \\nKaikki kuvat ja kommentit poistetaan myös.',
	'delete' => 'POISTA',
	'modify' => 'MUOKKAA',
	'edit_pics' => 'MUOKKAA KUVIA',
);

$lang_list_categories = array(
	'home' => 'Etusivu',
	'stat1' => '<b>[pictures]</b> kuvaa <b>[albums]</b> albumia ja <b>[cat]</b> kategoriaa sekä <b>[comments]</b> kommentia. Kuvia tarkasteltu <b>[views]</b> kertaa',
	'stat2' => '<b>[pictures]</b> kuvaa <b>[albums]</b> albumia tarkasteltu <b>[views]</b> kertaa',
	'xx_s_gallery' => '%s\'s Galleria',
	'stat3' => '<b>[pictures]</b> kuvaa <b>[albums]</b> albumia jossa <b>[comments]</b> kommenttia. Kuvia tarkasteltu <b>[views]</b> kertaa'
);

$lang_list_users = array(
	'user_list' => 'Käyttäjä lista',
	'no_user_gal' => 'Ei ole käyttäjiä joilla oikeus albumiin',
	'n_albums' => '%s albumi(t)',
	'n_pics' => '%s kuva(a)'
);

$lang_list_albums = array(
	'n_pictures' => '%s kuvaa',
	'last_added' => ', viimeisin lisätty %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => 'Sisään',
	'enter_login_pswd' => 'Kirjoita tunnus ja salasana kirjautuaksesi',
	'username' => 'Tunnus',
	'password' => 'Salasana',
	'remember_me' => 'Muista minut',
	'welcome' => 'Tervetuloa %s ...',
	'err_login' => '*** Virhe kirjautuessa - yritä uudelleen ***',
	'err_already_logged_in' => 'Olet jo kirjautunut !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => 'Poistu',
	'bye' => 'Näkemiin %s ...',
	'err_not_loged_in' => 'Et ole kirjautuneena !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => 'Päivitä albumi %s',
	'general_settings' => 'Yleiset asetukset',
	'alb_title' => 'Albumin otsikko',
	'alb_cat' => 'Albumin kategoria',
	'alb_desc' => 'Albumin tarkenne',
	'alb_thumb' => 'Albumi thumbnailit',
	'alb_perm' => 'Albumin oikeudet',
	'can_view' => 'Albumia voi tarkastella',
	'can_upload' => 'Vierailijat voivat lisätä kuvia',
	'can_post_comments' => 'Vierailijat voivat kommentoida',
	'can_rate' => 'Vieräilijat voivat arvostella',
	'user_gal' => 'Käyttäjän Galleria',
	'no_cat' => '* Ei kategoriaa *',
	'alb_empty' => 'Albumi on tyhja',
	'last_uploaded' => 'Viimeksi lisätty',
	'public_alb' => 'Kaikki (julkinen albumi)',
	'me_only' => 'Minä ainoastaan',
	'owner_only' => 'Albumin omistaja (%s) ainoastaan',
	'groupp_only' => 'Jäsenet ryhmästä \'%s\' ',
	'err_no_alb_to_modify' => 'Ei muokattavia albumeita tietokannassa.',
	'update' => 'Päivitä albumi'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => 'Olet jo arvostellut tämän kuvan',
	'rate_ok' => 'Äänesi hyväksytty',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
Sivuston {SITE_NAME} ylläpitäjät poistavat kaiken sopimattoman materiaalin niin nopeasti kuin mahdollista. Sähköposti osoitteen on oltava toimiva koska asetuksista riippuen saatat joutua aktivoimaan tilisi sähköpostin välityksellä.<br />
<br />
Hyväksymällä tämän sopimuksen sitoudut olemaan lähettämättä laitonta, seksuaalista tai muuten sopimatonta materiaalia muuten {SITE_NAME} ylläpitäjät ovat tapauksen sattuessa oikeutettu poistamaan kuvat sekä tunnuksesi varoituksetta.<br />
<br />
Sivu käyttää evästeitä tallentamaa informaatiota. Evästeiden tarkoitus on ainoastaa helpottaa sivun käyttöä. Sähköposti osoitetta ei luovuteta ulkopuolisten tietoon tarkoituksellisesti.<br />
<br />
Klikkaamalla 'Hyväksyn' hyväksyt nämä säännöt.
EOT;

$lang_register_php = array(
	'page_title' => 'Rekisteröinti',
	'term_cond' => 'Käyttösopimus',
	'i_agree' => 'Hyväksyn',
	'submit' => 'Lähetä rekisteröinti',
	'err_user_exists' => 'Tunnus on jo käytössä, ole hyvä ja valitse toinen',
	'err_password_mismatch' => 'Salasanat eivät täsmää',
	'err_uname_short' => 'Tunnuksen on oltava vähintään 2 merkkiä pitkä',
	'err_password_short' => 'Salasanan on oltava vähintään 2 merkkiä pitkä',
	'err_uname_pass_diff' => 'Tunnuksen ja salasanan on oltava eri',
	'err_invalid_email' => 'Sähköposti osoite on virhellinen',
	'err_duplicate_email' => 'Joku on jo rekisteröitynyt samalla sähköposti osoitteella',
	'enter_info' => 'Lisää rekisteröinti tiedot',
	'required_info' => 'Pakolliset tiedot',
	'optional_info' => 'Vapaaehtoiset tiedot',
	'username' => 'Käyttäjänimi',
	'password' => 'Salasana',
	'password_again' => 'Salasana uudestaan',
	'email' => 'Sähköposti',
	'location' => 'Sijainti',
	'interests' => 'Kiinnostukset',
	'website' => 'Kotisivu',
	'occupation' => 'Koulutus',
	'error' => 'VIRHE',
	'confirm_email_subject' => '%s - Rekisteröinti tiedot',
	'information' => 'Info',
	'failed_sending_email' => 'Rekisteröinnin varmistavaa sähköpostia ei voi lähettää!',
	'thank_you' => 'Kiitos rekisteröitymisestä.<br /><br />Tilisi täytyy vielä aktivoida. Valitsemaasi sähköposti osoitteeseen on lähetty ohjeet käyttäjätilisi aktivointiin.',
	'acct_created' => 'Käyttäjätilisi on nyt luotu. Voit kirjautua sisään käyttämällä tunnustasi sekä salasanaasi',
	'acct_active' => 'Käyttäjätilisi on nyt aktivoitu. Voit kirjautua sisään käyttämällä tunnustasi sekä salasanaasi',
	'acct_already_act' => 'Tilisi on jo aktiivinen !',
	'acct_act_failed' => 'Tiliäsi ei voi aktivoida !',
	'err_unk_user' => 'Valittua käyttäjää ei löydy !',
	'x_s_profile' => '%s\' asetukset',
	'group' => 'Ryhmä',
	'reg_date' => 'Liittynyt',
	'disk_usage' => 'Levyn käyttö',
	'change_pass' => 'Vaihda salasana',
	'current_pass' => 'Nykyinen salasana',
	'new_pass' => 'uusi salasana',
	'new_pass_again' => 'Uusi salasana uudestaan',
	'err_curr_pass' => 'Nykyinen salasana väärin',
	'apply_modif' => 'Hyväksy muutokset',
	'change_pass' => 'Vaihda salasana',
	'update_success' => 'Profiilisi päivitetty',
	'pass_chg_success' => 'Salasanasi vaihdettu',
	'pass_chg_error' => 'Salasanaasi ei vaihdettu',
);

$lang_register_confirm_email = <<<EOT
Kiitos rekisteröitymisestä {SITE_NAME} sivulle.

Tunnus : "{USER_NAME}"
Salasana : "{PASSWORD}"

Sinun on aktivoitava tilisi, tarvitsee vain klikata alla olevaa linkkiä
tai leikkaa/liitä (copy/paste) se www selaimeesi.

{ACT_LINK}

Terveisin,

Sivun {SITE_NAME} ylläpitäjä.

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => 'Näytä kommentit',
	'no_comment' => 'Ei kommentteja',
	'n_comm_del' => '%s kommentti poistettu',
	'n_comm_disp' => 'Kuinka monta kommenttia näytetään',
	'see_prev' => 'Edellinen',
	'see_next' => 'Seuraava',
	'del_comm' => 'Poista valitut kommentit',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => 'Hae kuva',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => 'Etsi uusia kuvia',
	'select_dir' => 'Valitse hakemisto',
	'select_dir_msg' => 'Voit lisätä FTP:llä lisätyt kuvat hakemistoihin<br /><br />Valitse hakemisto johon laitoit kuvat',
	'no_pic_to_add' => 'Ei lisättäviä kuvia',
	'need_one_album' => 'Tarvitset vähintään yhden albumin voidaksesi käyttää toimintoa',
	'warning' => 'Varoitus',
	'change_perm' => 'scripti ei voi kirjoittaa tähän hakemistoon. Oikeuksien täytyy olla 755 tai 777 ennen kuin yrität lisätä kuvia !',
	'target_album' => '<b>Laita kuvat hakemistosta &quot;</b>%s<b>&quot;</b>%s albumiin',
	'folder' => 'Hakemisto',
	'image' => 'Kuva',
	'album' => 'Albumi',
	'result' => 'Tulos',
	'dir_ro' => 'Ei kirjoitettavissa. ',
	'dir_cant_read' => 'Ei luettavissa. ',
	'insert' => 'Lisätään uusia kuvia galleriaan',
	'list_new_pic' => 'Lista uusista kuvista',
	'insert_selected' => 'Lisää valitut kuvat',
	'no_pic_found' => 'Uusia kuvia ei löytynyt',
	'be_patient' => 'Odota hetki. Menee pikkuisen aikaa kuvien käsittelyssä',
	'notes' =>  '<ul>'.
				'<li><b>OK</b> : tarkoittaa kuva lisätty onnistuneesti'.
				'<li><b>DP</b> : tarkoittaa kuva on jo aiemmin lisätty'.
				'<li><b>PB</b> : tarkoittaa kuvaa ei voitu lisätä, tarkista asetukset ja oikeudet'.
				'<li>Jos OK, DP, PB \'merkit\' eivät ilmesty klikkaa rikkinäistä kuvaa nähdäksesi PHP: virheilmoituksen'.
				'<li>Jos selaimesi menee timeouttiin, lataa sivu uudestaan'.
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
                'title' => 'Kiellä Kättäjiä', 
                'user_name' => 'Käyttäjänimi', 
                'ip_address' => 'IP Osoite', 
                'expiry' => 'Päättyy (tyhjä jos pysyvä)', 
                'edit_ban' => 'Tallenna Muutokset', 
                'delete_ban' => 'Poista', 
                'add_new' => 'Lisää uusi esto', 
                'add_ban' => 'Lisää', 
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
	'title' => 'Lisää kuva',
	'max_fsize' => 'Suurin sallittu tiedostokoko %s KB',
	'album' => 'Albumi',
	'picture' => 'Kuva',
	'pic_title' => 'Kuvan otsikko',
	'description' => 'Kuvan tarkenne',
	'keywords' => 'Hakusana (erota välilyönnillä)',
	'err_no_alb_uploadables' => 'Ei albumeita joille oikeus lisätä kuvia',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => 'Muokkaa käyttäjiä',
	'name_a' => 'Nimellä nousevasti',
	'name_d' => 'Nimellä laskevasti',
	'group_a' => 'Ryhmittäin nousevasti',
	'group_d' => 'Ryhmittäin laskevasti',
	'reg_a' => 'Rekisteröinti päivällä nousevasti',
	'reg_d' => 'Rekisteröinti päivällä laskevasti',
	'pic_a' => 'Kuvien määrällä nousevasti',
	'pic_d' => 'Kuvien määrällä laskevasti',
	'disku_a' => 'Levyn käyttö nousevasti',
	'disku_d' => 'Levyn käyttö laskevasti',
	'sort_by' => 'Järjestä käyttäjät',
	'err_no_users' => 'Käyttäjätaulu on tyhjä !',
	'err_edit_self' => 'Et voi muokata profiiliasi täältä \'Omat asetukset\' linkistä pääset tekemään sen',
	'edit' => 'MUOKKAA',
	'delete' => 'POISTA',
	'name' => 'Tunnus',
	'group' => 'Ryhmä',
	'inactive' => 'Passiivinen',
	'operations' => 'Toiminto',
	'pictures' => 'Kuvat',
	'disk_space' => 'Tilaa käytetty / Maksimi',
	'registered_on' => 'Rekisteröitynyt',
	'u_user_on_p_pages' => '%d käyttäjää %d sivu(a)',
	'confirm_del' => 'Haluatko varmasti POISTAA tämän käyttäjän ? \\nKaikki albumit ja kuvat poistuvat myös.',
	'mail' => 'POSTI',
	'err_unknown_user' => 'Valittua käyttäjää ei löydy !',
	'modify_user' => 'Muokkaa käyttäjää',
	'notes' => 'Huomio',
	'note_list' => '<li>Jos et halua vaihtaa salasanaa, jätä "salasana" kenttä tyhjäksi',
	'password' => 'Salasana',
	'user_active' => 'Käyttäjä aktiivinen',
	'user_group' => 'Käyttäjän ryhmä',
	'user_email' => 'Käyttäjän sähköposti',
	'user_web_site' => 'Käyttäjän kotisivu',
	'create_new_user' => 'Luo uusi käyttäjä',
	'user_location' => 'Käyttäjän sijainti',
	'user_interests' => 'Käyttäjän kiinnostukset',
	'user_occupation' => 'Käyttäjän koulutus',
);

// ------------------------------------------------------------------------- // 
// File util.php 
// ------------------------------------------------------------------------- // 

if (defined('UTIL_PHP')) $lang_util_php = array( 
        'title' => 'Pienennä kuvia', 
        'what_it_does' => 'Ominaisuudet', 
        'what_update_titles' => 'Päivittää otsikot tiedostonimiin', 
        'what_delete_title' => 'Poistaa otsikot', 
        'what_rebuild' => 'Tekee uudet thumbnailit ja pienentää kuvat', 
        'what_delete_originals' => 'Poistaa alkuperäisen kokoiset kuvat ja korvaa ne pienennetyillä versioilla', 
        'file' => 'Tiedosto', 
        'title_set_to' => 'otsikon asetti', 
        'submit_form' => 'lähetä', 
        'updated_succesfully' => 'päivitetty onnistuneesti', 
        'error_create' => 'VIRHE tapahtumassa', 
        'continue' => 'Käsittele lisää kuvia', 
        'main_success' => 'Tiedostoa %s on onnistuneesti käytetty pääkuvana', 
        'error_rename' => 'Virhe uudelleen nimeämisessä %s ei voitu nimetä %s', 
        'error_not_found' => 'Tiedostoa %s ei löydy', 
        'back' => 'takaisin', 
        'thumbs_wait' => 'Päivitää thumbnaileja ja/tai pienentää kuvia, odota hetki...', 
        'thumbs_continue_wait' => 'Jatkaa thumbnailien päivittämistä ja/tai kuvien pienentämistä...', 
        'titles_wait' => 'Päivittää otsikoita, odota hetki...', 
        'delete_wait' => 'Poistaa otsikoita, odota hetki...', 
        'replace_wait' => 'Poistaa alkuperäisia kuvia ja korvaa ne pienennetyillä, odota hetki..', 
        'instruction' => 'Pikaohje', 
        'instruction_action' => 'Valitse toiminto', 
        'instruction_parameter' => 'Aseta arvot', 
        'instruction_album' => 'Valitse albumi', 
        'instruction_press' => 'Paina %s', 
        'update' => 'Päivitä thumbnailit ja/tai pienennä kuvat', 
        'update_what' => 'Mitä päivitetään', 
        'update_thumb' => 'Ainoastaan thumbnailit', 
        'update_pic' => 'Pienennetään pelkät kuvat', 
        'update_both' => 'Pienennetään kuvat ja päivitetään thumbnailit', 
        'update_number' => 'Kuinka monta kuvaa käsitellään joka klikkauksella', 
        'update_option' => '(Kokeile säätää toimintoa pienemmälle jos tulee timeout ongelmia)', 
        'filename_title' => 'Tiedostonimi ? Kuvan otsikko', 
        'filename_how' => 'Kuinka tiedostonimet muokatann', 
        'filename_remove' => 'Poista .jpg pääte ja korvaa välit _ (alleviivaus)', 
        'filename_euro' => 'Muuta 2003_11_23_13_20_20.jpg tämmöiseksi 23/11/2003 13:20', 
        'filename_us' => 'Muuta 2003_11_23_13_20_20.jpg tämmöiseksi 11/23/2003 13:20', 
        'filename_time' => 'Muuta 2003_11_23_13_20_20.jpg tämmöiseksi 13:20', 
        'delete' => 'Poista otsikot tai alkuperäisen kokoiset kuvat', 
        'delete_title' => 'Poista kuvien otsikot', 
        'delete_original' => 'Poista alkuperäisen kokoiset kuvat', 
        'delete_replace' => 'Poistaa alkuperäiset kuvat ja korvaa ne pienennetyillä versioilla', 
        'select_album' => 'Valitse albumi', 
); 

?>