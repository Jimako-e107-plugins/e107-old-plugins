<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.3.2                                            //
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
// CVS version: $Id: estonian.php,v 1.10 2004/12/29 23:03:46 chtito Exp $
// ------------------------------------------------------------------------- //

// info about translators and translated language
$lang_translation_info = array(
  'lang_name_english' => 'Estonian',
  'lang_name_native' => 'Eesti',
  'lang_country_code' => 'ee',
  'trans_name'=> 'Meelis Ristj�e',
  'trans_email' => 'meelis@hullumajand.com',
  'trans_website' => 'http://hullumajand.com',
  'trans_date' => '2004-09-06',
);

$lang_charset = 'iso-8859-4';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Baiti', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('P�hap�ev', 'Esmasp�ev', 'Teisip�ev', 'Kolmap�ev', 'Neljap�ev', 'Reede', 'Laup�ev');
$lang_month = array('Jaanuar', 'Veebruar', 'M�rts', 'Aprill', 'Mai', 'Juuni', 'Juuli', 'August', 'September', 'Oktoober', 'November', 'Detsember');


// Some common strings
$lang_yes = 'Jah';
$lang_no  = 'Ei';
$lang_back = 'TAGASI';
$lang_continue = 'J�TKA';
$lang_info = 'Informatsioon';
$lang_error = 'Viga';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%B %d, %Y';
$lastcom_date_fmt =  '%m/%d/%y kell %H:%M'; //cpg1.3.0
$lastup_date_fmt = '%B %d, %Y';
$register_date_fmt = '%B %d, %Y';
$lasthit_date_fmt = '%B %d, %Y kell %I:%M'; //cpg1.3.0
$comment_date_fmt =  '%B %d, %Y kell %I:%M'; //cpg1.3.0

// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array(
  'random' => 'Juhuslikud pildid', //cpg1.3.0
  'lastup' => 'Viimati lisatud',
  'lastalb'=> 'Viimati lisatud album',
  'lastcom' => 'Viimane kommentaar',
  'topn' => 'Enim vaadatud',
  'toprated' => 'Edetabel',
  'lasthits' => 'Viimati vaadatud',
  'search' => 'Otsingu tulemused',
  'favpics'=> 'Eelistatud pildid', //cpg1.3.0
);

$lang_errors = array(
  'access_denied' => 'Teil pole �igusi sellele lehele p��suks',
  'perm_denied' => 'Teil pole �igust toimingu tegemiseks',
  'param_missing' => 'Skripti k�ivitamiseks puuduvad vajalikud parameetrid.',
  'non_exist_ap' => 'Valitud pilt v�i album puudub!', //cpg1.3.0
  'quota_exceeded' => 'Lubatud kettakasutus �letatud<br /><br />Teil on lubatud kasutada [quota]K kettaruumi, Teie pildid v�tavad hetkel [space]K  ruumi, selle pildi lisamisel v�ib lubatud maht olla �letatud.', //cpg1.3.0
  'gd_file_type_err' => 'GD teegi puhul on lubatud ainult JPEG ja PNG t��pi pildid.',
  'invalid_image' => 'Pilt on vigane v�i seda pole v�imalik k�sitleda GD teegi poolt.',
  'resize_failed' => 'Ei suuda luua pisipilti v�i v�hendada pildi suurust.',
  'no_img_to_display' => 'Pole �htegi pilti.',
  'non_exist_cat' => 'Valitud kategooria puudub.',
  'orphan_cat' => 'Kategoorial puudub vanem, kasuta kategooria-haldurit probleemi lahendamiseks.', //cpg1.3.0
  'directory_ro' => 'Kataloogil \'%s\' puudub kirjutamis�igus, �ilte ei saa kustutada.', //cpg1.3.0
  'non_exist_comment' => 'Valitud kommentaar puudub.',
  'pic_in_invalid_album' => 'Pilt asub olematus albumis (%s)!?', //cpg1.3.0
  'banned' => 'Sul on hetkel keelatud selle albumi kasutamine.',
  'not_with_udb' => 'See funktsioon on keelatud, kuna album on integreeritud foorumiga. Ehk tegevus mida Sa �ritad ei ole toetatud antud konfiguratsioonis v�i tuleks teha kasutades foorumi tarkvara.',
  'offline_title' => 'Mitte aktiivne', //cpg1.3.0
  'offline_text' => 'Album ei ole hetkel aktiivne - vaata hiljem uuesti', //cpg1.3.0
  'ecards_empty' => 'Ei ole postkaartide koopiaid mida n�idata. Kontrolli gonfiguratsiooni!', //cpg1.3.0
  'action_failed' => 'K�suviga.  Pildialbum ei saa teostada antud k�sku.', //cpg1.3.0
  'no_zip' => 'ZIP failid pole saadaval.  Palun v�ta �hendust oma Pildialbumi administraatoriga.', //cpg1.3.0
  'zip_type' => 'Sul puudub �igus ZIP failide �lesse laadimiseks.', //cpg1.3.0
);

$lang_bbcode_help = 'J�rgnevad koodid v�ivad olla vajalikud: <li>[b]<b>Bold</b>[/b]</li> <li>[i]<i>Italic</i>[/i]</li> <li>[url=http://www.sinuaadress.ee/]Url Text[/url]</li> <li>[email]sinunimi@kuskohas.ee[/email]</li>'; //cpg1.3.0

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
  'alb_list_title' => 'Mine albumite loetellu',
  'alb_list_lnk' => 'Albumite loetelu',
  'my_gal_title' => 'Mine minu personaalsesse galeriisse',
  'my_gal_lnk' => 'Minu galerii',
  'my_prof_lnk' => 'Minu Profiil',
  'adm_mode_title' => 'L�litu admin olekusse',
  'adm_mode_lnk' => 'Admin olek',
  'usr_mode_title' => 'L�litu kasutaja olekusse',
  'usr_mode_lnk' => 'Kasutaja olek',
  'upload_pic_title' => 'Lisa fail/e albumisse',
  'upload_pic_lnk' => 'Lisa fail/e albumisse',
  'register_title' => 'Registreeru',
  'register_lnk' => 'Registreeri',
  'login_lnk' => 'Sisene',
  'logout_lnk' => 'V�lju',
  'lastup_lnk' => 'Viimati lisatud',
  'lastcom_lnk' => 'Viimased kommentaarid',
  'topn_lnk' => 'Enim vaadatud',
  'toprated_lnk' => 'Edetabel',
  'search_lnk' => 'Otsing',
  'fav_lnk' => 'Minu eelistused',
  'memberlist_title' => 'N�ita kasutajate lehte', //cpg1.3.0
  'memberlist_lnk' => 'Kasutajate leht', //cpg1.3.0
  'faq_title' => 'Korduma kippuvad k�simused &quot;Pildialbum&quot;', //cpg1.3.0
  'faq_lnk' => 'KKK', //cpg1.3.0
);

$lang_gallery_admin_menu = array(
  'upl_app_lnk' => 'Lisamise kinnitus',
  'config_lnk' => 'Konfiguratsioon',
  'albums_lnk' => 'Albumid',
  'categories_lnk' => 'Kategooriad',
  'users_lnk' => 'Kasutajad',
  'groups_lnk' => 'Grupid',
  'comments_lnk' => 'Kommentaarid',
  'searchnew_lnk' => 'Lisa �leslaetud pilte',
  'util_lnk' => 'Failide suuruse muutmine',
  'ban_lnk' => 'Blokeeri kasutajaid',
  'db_ecard_lnk' => 'N�ita postkaarte', //cpg1.3.0
);

$lang_user_admin_menu = array(
  'albmgr_lnk' => 'Loo / telli albumeid',
  'modifyalb_lnk' => 'Redigeeri albumeid',
  'my_prof_lnk' => 'Minu profiil',
);

$lang_cat_list = array(
  'category' => 'Kategooria',
  'albums' => 'Albumid',
  'pictures' => 'Pildid', //cpg1.3.0
);

$lang_album_list = array(
  'album_on_page' => '%d albumit %d lehel',
);

$lang_thumb_view = array(
  'date' => 'KUUP�EV',
  //Sort by filename and title
  'name' => 'FAILI NIMI',
  'title' => 'PEALKIRI',
  'sort_da' => 'J�rjesta kuup�eva j�rgi kasvavalt',
  'sort_dd' => 'J�rjesta kuup�eva j�rgi kahanevalt',
  'sort_na' => 'J�rjesta nime j�rgi kasvavalt',
  'sort_nd' => 'J�rjesta nime j�rgi kahanevalt',
  'sort_ta' => 'J�rjesta pealkirja j�rgi kasvavalt',
  'sort_td' => 'J�rjesta pealkirja j�rgi kahanevalt',
  'download_zip' => 'Lae alla ZIP failina', //cpg1.3.0
  'pic_on_page' => '%d pilti on %d-el lehel',
  'user_on_page' => '%d kasutajat on %d-el lehel', //cpg1.3.0
);

$lang_img_nav_bar = array(
  'thumb_title' => 'Tagasi pisipiltide lehele',
  'pic_info_title' => 'N�ita/peida pildi info', //cpg1.3.0
  'slideshow_title' => 'Slaidiesitus',
  'ecard_title' => 'Saada see pilt e-kaardina', //cpg1.3.0
  'ecard_disabled' => 'e-kaartid on keelatud',
  'ecard_disabled_msg' => 'Teil pole �igust saata e-kaarte', //js-alert //cpg1.3.0
  'prev_title' => 'Vaata eelmist pilti', //cpg1.3.0
  'next_title' => 'Vaata j�rgmist pilti', //cpg1.3.0
  'pic_pos' => 'FAIL %s/%s', //cpg1.3.0
);

$lang_rate_pic = array(
  'rate_this_pic' => 'Hinda seda pilti ', //cpg1.3.0
  'no_votes' => '(Veel hindamata)',
  'rating' => '(Hetke hinne : %s / 5-st %s h��lega)',
  'rubbish' => 'K�lbmatu',
  'poor' => 'Kasin',
  'fair' => 'Keskmine',
  'good' => 'Hea',
  'excellent' => 'Suurep�rane',
  'great' => 'Fantastiline',
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
  CRITICAL_ERROR => 'Kriitiline viga',
  'file' => 'Fail: ',
  'line' => 'Rida: ',
);

$lang_display_thumbnails = array(
  'filename' => 'Failinimi : ',
  'filesize' => 'Failisuurus : ',
  'dimensions' => 'M��tmed : ',
  'date_added' => 'Lisamise kuup�ev : ', //cpg1.3.0
);

$lang_get_pic_data = array(
  'n_comments' => '%s kommentaari',
  'n_views' => '%s kord(a)',
  'n_votes' => '(%s h��l(t))',
);

$lang_cpg_debug_output = array(
  'debug_info' => 'Parandusmoodi info', //cpg1.3.0
  'select_all' => 'M�rgi k�ik', //cpg1.3.0
  'copy_and_paste_instructions' => 'Kui kasutad pildialbumi abi siis kopeeri veateade postitusesse. Paroolid asenda kindlasti postituses (***) ennem postitamist.', //cpg1.3.0
  'phpinfo' => 'n�ita php infot', //cpg1.3.0
);

$lang_language_selection = array(
  'reset_language' => 'Taasta algkeel', //cpg1.3.0
  'choose_language' => 'Vali oma keel', //cpg1.3.0
);

$lang_theme_selection = array(
  'reset_theme' => 'Algeline tagataust', //cpg1.3.0
  'choose_theme' => 'Vali tagataust', //cpg1.3.0
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
  'Exclamation' => 'H��atus',
  'Question' => 'K�simus',
  'Very Happy' => 'V�ga �nnelik',
  'Smile' => 'R��mus',
  'Sad' => 'Kurb',
  'Surprised' => '�llatunud',
  'Shocked' => 'Vapustaud',
  'Confused' => 'Hammeldunud',
  'Cool' => 'Lahe',
  'Laughing' => 'Naerev',
  'Mad' => 'Hull',
  'Razz' => 'Razz',
  'Embarassed' => 'H�bistatud',
  'Crying or Very sad' => 'Nuttev v�i v�ga kurb',
  'Evil or Very Mad' => '�el v�i P�ris hull',
  'Twisted Evil' => 'Eelarvamuslik �el',
  'Rolling Eyes' => 'Silmi p��ritav',
  'Wink' => 'Silmapilgutus',
  'Idea' => 'Idee',
  'Arrow' => 'Nool',
  'Neutral' => 'Neutraalne',
  'Mr. Green' => 'Mr. Roheline',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
  0 => 'Lahkumine admin olekust...',
  1 => 'Sisenemine admin olekusse...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
  'alb_need_name' => 'Albumitel peab olema nimi !', //js-alert
  'confirm_modifs' => 'Oled kindel, et tahad teha neid muudatusi ?', //js-alert
  'no_change' => 'Sa ei muutnud midagi !', //js-alert
  'new_album' => 'Uus album',
  'confirm_delete1' => 'Kindel, et tahad albumit kustutada ?', //js-alert
  'confirm_delete2' => '\nK�ik siin sisalduvad pildid ja kommentaarid l�hevad kaduma !', //js-alert
  'select_first' => 'Vali enne album', //js-alert
  'alb_mrg' => 'Albumi-haldur',
  'my_gallery' => '* Minu galerii *',
  'no_category' => '* Kategooriata *',
  'delete' => 'Kustuta',
  'new' => 'Uus',
  'apply_modifs' => 'Omista muudatused',
  'select_category' => 'Vali kategooria',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
  'miss_param' => 'Puuduvad parameetrid \'%s\'tooimingut ei tehtud !',
  'unknown_cat' => 'Valitud kategooria puudub andmebaasis',
  'usergal_cat_ro' => 'Kasutaja galeriisid ei saa kustutada !',
  'manage_cat' => 'Halda kategooriaid',
  'confirm_delete' => 'Oled kindel, et tahad KUSTUTADA seda kategooriat', //js-alert
  'category' => 'Kategooria',
  'operations' => 'Toimingud',
  'move_into' => 'Liigu',
  'update_create' => 'Uuenda/Loo Kategooria',
  'parent_cat' => 'Juurkategooria',
  'cat_title' => 'Kategooria tiitel',
  'cat_thumb' => 'Kategooria pilt', //cpg1.3.0
  'cat_desc' => 'Kategooria kirjeldus',
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
  'title' => 'Konfiguratsioon',
  'restore_cfg' => 'Taasta tehase vaikeseaded',
  'save_cfg' => 'Salvesta uus konfiguratsioon',
  'notes' => 'M�rkused',
  'info' => 'Informatsioon',
  'upd_success' => 'Konfiguratsioon uuendatud',
  'restore_success' => 'Vaikekonfiguratsioon taastatud',
  'name_a' => 'Nimed kasvavalt',
  'name_d' => 'Nimed kahanevalt',
  'title_a' => 'Pealkirjad kasvavalt',
  'title_d' => 'Pealkirjad kahanevalt',
  'date_a' => 'Kuup�ev kasvavalt',
  'date_d' => 'Kuup�ev kahanevalt',
  'th_any' => 'Max Aspect',
  'th_ht' => 'Height',
  'th_wd' => 'Width',
  'label' => 'kiri', //cpg1.3.0
  'item' => 'lipp', //cpg1.3.0
  'debug_everyone' => 'Iga�ks', //cpg1.3.0
  'debug_admin' => 'Administraator ainult', //cpg1.3.0
        );

if (defined('CONFIG_PHP')) $lang_config_data = array(
  '�ldised seaded',
  array('Galerii nimi', 'gallery_name', 0),
  array('Galerii kirjeldus', 'gallery_description', 0),
  array('Galerii administraatori e-post',  'gallery_admin_email', 0),
  array('Sihtaadress \'Vaata veel pilte\' link e-kaartidel', 'ecards_more_pic_target', 0),
  array('Galerii aktiivsus', 'offline', 1), //cpg1.3.0
  array('Salvesta postkaarte', 'log_ecards', 1), //cpg1.3.0
  array('Aktsepteeri ZIP failide allalaadimine minu eelistustesse', 'enable_zipdownload', 1), //cpg1.3.0

  'Keelte, taustade ja m�rgistiku seaded',
  array('Keel', 'lang', 5),
  array('Taust', 'theme', 6),
  array('N�ita keelte men��d', 'language_list', 1), //cpg1.3.0
  array('N�ita lippe', 'language_flags', 8), //cpg1.3.0
  array('N�ita &quot;Taasta algkeel&quot; nuppu lippude juures', 'language_reset', 1), //cpg1.3.0
  array('N�ita taustade men��d', 'theme_list', 1), //cpg1.3.0
  array('N�ita &quot;Algeline tagataust&quot; kirja tagataustade men��s', 'theme_reset', 1), //cpg1.3.0
  array('N�ita KKK', 'display_faq', 1), //cpg1.3.0
  array('N�ita bbkoodi abi', 'show_bbcode_help', 1), //cpg1.3.0
  array('T�hekodeering', 'charset', 4), //cpg1.3.0

  'Albumite loetelu vaade ',
  array('Peatabeli laius (pikslites v�i %)', 'main_table_width', 0),
  array('Number kategooria tasandeid kuvamiseks ', 'subcat_level', 0),
  array('Number albumeid kuvamiseks', 'albums_per_page', 0),
  array('Number veergusid albumi loeteluks', 'album_list_cols', 0),
  array('Pisipiltide suurus pikslites', 'alb_list_thumb_size', 0),
  array('Pealehe sisu', 'main_page_layout', 0),
  array('N�ita esimese taseme albumite pisipilte kategooriates ','first_level',1),

  'Pisipiltide vaade',
  array('Veergude arv pisipiltide lehel ', 'thumbcols', 0),
  array('Ridade arv pisipiltide lehel ', 'thumbrows', 0),
  array('Maksimaalne lahtrite arv kuvamiseks ', 'max_tabs', 10), //cpg1.3.0
  array('Kuva pildi selgitus (lisaks tiitlile) pisipildi all ', 'caption_in_thumbview', 1), //cpg1.3.0
  array('Kuva vaatamiste arv pisipildi all ', 'views_in_thumbview', 1), //cpg1.3.0
  array('Kuva kommentaaraide arv pisipildi all ', 'display_comment_count', 1),
  array('Kuva pildi lisaja nimi pildi juures', 'display_uploader', 1), //cpg1.3.0
  array('J�rjesta pildid', 'default_sort_order', 3), //cpg1.3.0
  array('Minimaalne h��lte arv pildi sattumiseks  \'Edetabel\' lehele', 'min_votes_for_rating', 0), //cpg1.3.0

  'Pildivaate ja kommentaaride seaded',
  array('Tabeli laius pildi kuvamiseks (pikslites v�i %) ', 'picture_table_width', 0), //cpg1.3.0
  array('Pildi info on vaikimisi n�htav', 'display_pic_info', 1), //cpg1.3.0
  array('Filtreeri pahad s�nad kommentaarides ', 'filter_bad_words', 1),
  array('Luba kasutada smaile kommentaarides ', 'enable_smilies', 1),
  array('Luba �hel ja samal kasutajal mitu korda j�rjest kommenteerida �hte ja sama pilti', 'disable_comment_flood_protect', 1), //cpg1.3.0
  array('Maksimaalne pildikirjelduse pikkus ', 'max_img_desc_length', 0),
  array('Maksimaalne t�htede arv s�nas', 'max_com_wlength', 0),
  array('Maksimaalne ridade arv kommentaaris ', 'max_com_lines', 0),
  array('Maksimaalne kommentaari pikkus ', 'max_com_size', 0),
  array('N�ita filmilinti', 'display_film_strip', 1),
  array('Kaadrite arv filmilindil', 'max_film_strip_items', 0),
  array('Teavita administraatorit kommentaaridest e-maili teel', 'email_comment_notification', 1), //cpg1.3.0
  array('Slaidesituse interval millisekundites (1 sekund = 1000 millisekundit)', 'slideshow_interval', 0), //cpg1.3.0

  'Failide ja pisipiltide seaded', //cpg1.3.0
  array('JPEG failide kvaliteet', 'jpeg_qual', 0),
  array('Pisipildi max laius v�i k�rgus <a href="#notice2" class="clickable_option">**</a>', 'thumb_width', 0), //cpg1.3.0
  array('Kasuta m��te (k�rgus v�i laius v�i maksimum pisipiltide jaoks ) <b>**</b>', 'thumb_use', 7),
  array('Loo keskmised pildid ','make_intermediate',1),
  array('Maksimaalne k�rgus v�i laius keskmiste suurusega piltidele/videodele <a href="#notice2" class="clickable_option">**</a>', 'picture_width', 0), //cpg1.3.0
  array('�leslaetavate failide maksimaalne suurus (KB)', 'max_upl_size', 0), //cpg1.3.0
  array('Maksimaalne k�rgus v�i laius �leslaetavate piltide/videode puhul pikslites', 'max_upl_width_height', 0), //cpg1.3.0

  'Failide ja pisipiltide t�psemad seaded', //cpg1.3.0
  array('Kuva privaatalbumi ikooni mitte sisseloginud kasutaja juures','show_private',1), //cpg1.3.0
  array('Faili nimes keelatud t�hem�rgid ', 'forbiden_fname_char',0), //cpg1.3.0
  //array('Accepted file extensions for uploaded pictures', 'allowed_file_extensions',0), //cpg1.3.0
  array('Aktsepteeritavad piltide failide t��bid', 'allowed_img_types',0), //cpg1.3.0
  array('Aktsepteeritavad videode failide t��bid', 'allowed_mov_types',0), //cpg1.3.0
  array('Aktsepteeritavad audio failide t��bid', 'allowed_snd_types',0), //cpg1.3.0
  array('Aktsepteeritavad dokumentide failide t��bid', 'allowed_doc_types',0), //cpg1.3.0
  array('Piltide suurusemuutmise meetod','thumb_method',2), //cpg1.3.0
  array('ImageMagick\'u \'konvertimise\' abiprogrammi tee (n�iteks /usr/bin/X11/)', 'impath', 0), //cpg1.3.0
  //array('Allowed image types (only valid for ImageMagick)', 'allowed_img_types',0), //cpg1.3.0
  array('K�surea parameetrid ImageMagick', 'im_options', 0), //cpg1.3.0
  array('Lugeda EXIF andmed JPEG failides ', 'read_exif_data', 1), //cpg1.3.0
  array('Lugeda IPTC andmed JPEG failides', 'read_iptc_data', 1), //cpg1.3.0
  array('Albumi kataloog <a href="#notice1" class="clickable_option">*</a>', 'fullpath', 0), //cpg1.3.0
  array('Kasutajapiltide kataloog <a href="#notice1" class="clickable_option">*</a>', 'userpics', 0), //cpg1.3.0
  array('Eesliide keskmistele piltidele <a href="#notice1" class="clickable_option">*</a>', 'normal_pfx', 0), //cpg1.3.0
  array('Eesliide pisipiltidele <a href="#notice1" class="clickable_option">*</a>', 'thumb_pfx', 0), //cpg1.3.0
  array('Vaikemood kataloogidele', 'default_dir_mode', 0), //cpg1.3.0
  array('Vaikemood piltidele', 'default_file_mode', 0), //cpg1.3.0

  'Kasutaja seaded',
  array('Aktsepteeri uute kasutajate registreerimist', 'allow_user_registration', 1),
  array('Kasutaja registreerimine n�uab e-posti-kinnitust', 'reg_requires_valid_email', 1),
  array('Teavita administraatorit uue kasutaja registreerimisest e-maili teel', 'reg_notify_admin_email', 1), //cpg1.3.0
  array('Luba kahel kasutajal �hte-sama e-posti aadressi ', 'allow_duplicate_emails_addr', 1),
  array('Kasutajatel v�ib olla privaat-albumid  (PS: Kui l�litad \'Jah\' pealt \'Ei\' peale siis privaat albumid muutuvad avalikuks)', 'allow_private_albums', 1), //cpg1.3.0
  array('Teavita administraatorit kasutajatepoolt �leslaetud piltide lisamise kinnituse ootamisest', 'upl_notify_admin_email', 1), //cpg1.3.0
  array('Luba sisseloginud kasutajatel n�ha kasutajate nimekirja', 'allow_memberlist', 1), //cpg1.3.0

  'Kohandatavad v�ljad pildi kirjelduseks (j�ta t�hjaks kui ei kasuta)',
  array('V�lja 1 nimi', 'user_field1_name', 0),
  array('V�lja 2 nimi', 'user_field2_name', 0),
  array('V�lja 3 nimi', 'user_field3_name', 0),
  array('V�lja 4 nimi', 'user_field4_name', 0),

  'Pr��nikute seaded',
  array('Skripti poolt kasutatava pr��niku nimi', 'cookie_name', 0),
  array('Skripti poolt kasutatava pr��niku failitee ', 'cookie_path', 0),

  'Muud seaded',
  array('V�imalda parandusmoodulit', 'debug_mode', 9), //cpg1.3.0
  array('T�helepanekud parandusmoodulis', 'debug_notice', 1), //cpg1.3.0

  '<br /><div align="left"><a name="notice1"></a>(*) Neid seadeid ei tohi muuta kui sul on juba failid andmebaasis.<br />
  <a name="notice2"></a>(**) Kui muudad neid seadeid siis muudatused tulevad ainult nende failidega mis sa p�rast selle seade muutmist lisad. �ra muuda neid seadeid kui albumis on juba faile. Sa saad muuta olemasolevaid faile &quot;<a href="util.php">Failide suuruse muutmine</a> &quot; administraatori men��st.</div><br />', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File db_ecard.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('DB_ECARD_PHP')) $lang_db_ecard_php = array(
  'title' => 'Saadetud e-kaardid', //cpg1.3.0
  'ecard_sender' => 'Saatja', //cpg1.3.0
  'ecard_recipient' => 'Saaja', //cpg1.3.0
  'ecard_date' => 'Kuup�ev', //cpg1.3.0
  'ecard_display' => 'N�ita postkaarti', //cpg1.3.0
  'ecard_name' => 'Nimi', //cpg1.3.0
  'ecard_email' => 'E-mail', //cpg1.3.0
  'ecard_ip' => 'IP #', //cpg1.3.0
  'ecard_ascending' => '�lalt-alla j�rjekorras', //cpg1.3.0
  'ecard_descending' => 'alt-�les j�rjekorras', //cpg1.3.0
  'ecard_sorted' => 'Sorteeritud', //cpg1.3.0
  'ecard_by_date' => 'kuup�eva j�rgi', //cpg1.3.0
  'ecard_by_sender_name' => 'saatja nime j�rgi', //cpg1.3.0
  'ecard_by_sender_email' => 'saatja e-maili j�rgi', //cpg1.3.0
  'ecard_by_sender_ip' => 'saatja IP aadressi j�rgi', //cpg1.3.0
  'ecard_by_recipient_name' => 'saaja nime j�rgi', //cpg1.3.0
  'ecard_by_recipient_email' => 'saaja e-maili j�rgi', //cpg1.3.0
  'ecard_number' => 'Salvestatuid postkaarte %s lk. %s -st %s', //cpg1.3.0
  'ecard_goto_page' => 'mine lehele', //cpg1.3.0
  'ecard_records_per_page' => 'Kuva salvestusi lehek�ljel', //cpg1.3.0
  'check_all' => 'M�rgista k�ik', //cpg1.3.0
  'uncheck_all' => 'Eemalda m�rgistused', //cpg1.3.0
  'ecards_delete_selected' => 'Kustuta m�rgistatud postkaardid', //cpg1.3.0
  'ecards_delete_confirm' => 'Kas oled kindel et tahad kustutada salvestatud postkaardid? Tick the checkbox!', //cpg1.3.0
  'ecards_delete_sure' => 'Olen kindel', //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
  'empty_name_or_com' => 'Sa pead kirjutama oma nime ja kommentaari',
  'com_added' => 'Sinu kommentaar on lisatud',
  'alb_need_title' => 'Sinult oodatakse pealkirja albumile !',
  'no_udp_needed' => 'Uuendust pole vaja.',
  'alb_updated' => 'Album on uuendatud',
  'unknown_album' => 'Valitud album puudub v�i sul pole �igusi salvestada sellesse albumisse',
  'no_pic_uploaded' => 'Ei ole m�rgitud faili �lesselaadimiseks !<br /><br />Kui sa t�esti m�rkisid faili �lesselaadimiseks, siis kontrolli kas server lubab faile �lesse laadida...', //cpg1.3.0
  'err_mkdir' => 'Viga kataloogi %s loomisel !',
  'dest_dir_ro' => 'Sihtkataloog %s pole skripti poolt kirjutamis�iguslik !',
  'err_move' => 'V�imatu liigutada %s -> %s !',
  'err_fsize_too_large' => 'Sinu poolt salvestatava pildi suurus liiga suur (maksimum lubatud %s x %s) !', //cpg1.3.0
  'err_imgsize_too_large' => 'Sinu poolt salvestatava faili suurus liiga suur (maksimum lubatud %s KB) !',
  'err_invalid_img' => '�leslaetav fail pole kehtiv pildifail !',
  'allowed_img_types' => 'Sa v�id salvestada ainult %s pilti.',
  'err_insert_pic' => 'Pilti  \'%s\' ei saa lisada albumisse ', //cpg1.3.0
  'upload_success' => 'Sinu pilt salvestati edukalt<br /><br />See saab n�htavaks p�rast admini heakskiitu.', //cpg1.3.0
  'notify_admin_email_subject' => '%s - Salvestatud fail', //cpg1.3.0
  'notify_admin_email_body' => 'Pilt on �leslaetud %s see vajab sinu heakskiitu. Vaata %s', //cpg1.3.0
  'info' => 'Informatsioon',
  'com_added' => 'Kommentaar lisatud',
  'alb_updated' => 'Album uuendatud',
  'err_comment_empty' => 'Sinu kommentaar on t�hi !',
  'err_invalid_fext' => 'Ainult j�rgmised failit��bid aksepteeritakse : <br /><br />%s.',
  'no_flood' => 'Vabandust, aga sa oled juba selle pildile viimati lisatud kommentaari autor<br /><br />Paranda oma lisatud kommentaari kui soovid seda muuta', //cpg1.3.0
  'redirect_msg' => 'Sind suunatakse �mber.<br /><br /><br />Klikka \'J�TKA\' kui lehek�lg automaatselt ei uuene',
  'upl_success' => 'Sinu pilt edukalt lisatud', //cpg1.3.0
  'email_comment_subject' => 'Kommentaar lisatud pildialbumis', //cpg1.3.0
  'email_comment_body' => 'Keegi lisas kommentaari pildialbumis. Vaata seda', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
  'caption' => 'Selgitus',
  'fs_pic' => 'T�is suuruses pilt',
  'del_success' => 'edukalt kustutatud',
  'ns_pic' => 'normaal suuruses pilt',
  'err_del' => 'ei saa kustutada',
  'thumb_pic' => 'pisipilt',
  'comment' => 'kommentaar',
  'im_in_alb' => 'pilt albumis',
  'alb_del_success' => 'Album \'%s\' kustutatud',
  'alb_mgr' => 'Albumi Haldur',
  'err_invalid_data' => 'Vigased andmed laekunud \'%s\'',
  'create_alb' => 'Loon albumit \'%s\'',
  'update_alb' => 'Uuendan albumit \'%s\' pealkirjaga \'%s\' ja indeksiga \'%s\'',
  'del_pic' => 'Kustuta fail', //cpg1.3.0
  'del_alb' => 'Kustuta album',
  'del_user' => 'Kustuta kasutaja',
  'err_unknown_user' => 'Valitud kasutajat pole olemas !',
  'comment_deleted' => 'Kommentaar edukalt kustutatud',
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
  'confirm_del' => 'Oled kindel, et tahad seda pilti KUSTUTADA ? \\nKommentaarid kustutatakse samuti.', //js-alert //cpg1.3.0
  'del_pic' => 'KUSTUTA SEE FAIL', //cpg1.3.0
  'size' => '%s x %s pikslit',
  'views' => '%s korda',
  'slideshow' => 'Slaidivaade',
  'stop_slideshow' => 'PEATA SLAIDIVAADE',
  'view_fs' => 'Klikka vaatamaks t�issuuruses pilti',
  'edit_pic' => 'MUUDA KIRJELDUST', //cpg1.3.0
  'crop_pic' => 'REDIGEERI', //cpg1.3.0
);

$lang_picinfo = array(
  'title' =>'Pildi Informatsioon', //cpg1.3.0
  'Filename' => 'Faili nimi',
  'Album name' => 'Albumi nimi',
  'Rating' => 'Reiting (%s votes)',
  'Keywords' => 'M�rks�nad',
  'File Size' => 'Faili suurus',
  'Dimensions' => 'M��dud',
  'Displayed' => 'Kuvatud',
  'Camera' => 'Kaamera',
  'Date taken' => '�lesv�tte kuup�ev',
  'ISO'=>'ISO',
  'Aperture' => 'Ava',
  'Exposure time' => 'S�riaeg',
  'Focal length' => 'Fookus kaugus',
  'Comment' => 'Kommentaar',
  'addFav'=>'Lisa eelistustesse', //cpg1.3.0
  'addFavPhrase'=>'Minu eelistused', //cpg1.3.0
  'remFav'=>'Eemalda eelistustest', //cpg1.3.0
  'iptcTitle'=>'IPTC Pealkiri', //cpg1.3.0
  'iptcCopyright'=>'IPTC Copyright', //cpg1.3.0
  'iptcKeywords'=>'IPTC V�tmes�nad', //cpg1.3.0
  'iptcCategory'=>'IPTC Kategooria', //cpg1.3.0
  'iptcSubCategories'=>'IPTC Alam Kategooriad', //cpg1.3.0
);

$lang_display_comments = array(
  'OK' => 'Valmis',
  'edit_title' => 'Muuda komentaari',
  'confirm_delete' => 'Oled kindel, et tahad seda kommentaari kustutada ?', //js-alert
  'add_your_comment' => 'Lisa komentaar',
  'name'=>'Nimi',
  'comment'=>'Kommentaar',
  'your_name' => 'Sinu nimi',
);

$lang_fullsize_popup = array(
  'click_to_close' => 'Akna sulgemiseks kl�psa pildil',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
  'title' => 'Saada e-kaart',
  'invalid_email' => '<b>Hoiatus</b> : Vigane e-posti aadress !',
  'ecard_title' => 'Sulle on e-kaart %s\' lt',
  'error_not_image' => 'Ainult pilte saab saata e-kaardina.', //cpg1.3.0
  'view_ecard' => 'Kui e-kaarti ei kuvata korrektselt, kl�psake lingil',
  'view_more_pics' => 'Rohkemate piltide vaatamiseks kl�psake lingil !',
  'send_success' => 'Sinu e-kaart on saadetud',
  'send_failed' => 'Vabandust, kuid serveril ei �nnestu Sinu e-kaardi saatmine...',
  'from' => 'Kellelt',
  'your_name' => 'Sinu Nimi',
  'your_email' => 'Sinu e-posti aadress',
  'to' => 'Kellele',
  'rcpt_name' => 'Aadressaadi nimi',
  'rcpt_email' => 'Aadressaadi e-posti aadress',
  'greetings' => 'Tervitused',
  'message' => 'S�num',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
  'pic_info' => 'Pildi&nbsp;info', //cpg1.3.0
  'album' => 'Album',
  'title' => 'Pealkiri',
  'desc' => 'Kirjeldus',
  'keywords' => 'M�rks�nad',
  'pic_info_str' => '%sx%s - %sKB - %s vaadet - %s h��lt',
  'approve' => 'Kinnita pilt', //cpg1.3.0
  'postpone_app' => 'L�kka kinnitus edasi',
  'del_pic' => 'Kustuta pilt', //cpg1.3.0
  'read_exif' => 'Loe EXIF infot uuesti', //cpg1.3.0
  'reset_view_count' => 'Nulli vaadete loendur',
  'reset_votes' => 'Nulli h��led',
  'del_comm' => 'Kustuta kommendaarid',
  'upl_approval' => 'Salvestuse kinnitus',
  'edit_pics' => 'Redigeeri faile', //cpg1.3.0
  'see_next' => 'Vaata j�rgmist faili', //cpg1.3.0
  'see_prev' => 'Vaata eelmist faili', //cpg1.3.0
  'n_pic' => '%s faile', //cpg1.3.0
  'n_of_pic_to_disp' => 'Failide arv kuvamiseks', //cpg1.3.0
  'apply' => 'Omista muudatused', //cpg1.3.0
  'crop_title' => 'Pildialbumi redigeerimise programm', //cpg1.3.0
  'preview' => 'Eelvaade', //cpg1.3.0
  'save' => 'Salvesta pilt', //cpg1.3.0
  'save_thumb' =>'Salvesta pisipildina', //cpg1.3.0
  'sel_on_img' =>'Valida saab ainult pildi peal olevat ala!', //js-alert //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File faq.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FAQ_PHP')) $lang_faq_php = array(
  'faq' => 'Korduma kippuvad k�simused', //cpg1.3.0
  'toc' => 'K�simuste tabel', //cpg1.3.0
  'question' => 'K�simus: ', //cpg1.3.0
  'answer' => 'Vastus: ', //cpg1.3.0
);

if (defined('FAQ_PHP')) $lang_faq_data = array(
  'Peamised k�simused', //cpg1.3.0
  array('Milleks on vajalik registreerimine?', 'Registreerimine v�ib olla vajalik ja samas mitte, k�ik oleneb administraatorist et mis ta lubab lehel teha. Registreerimine annab kasutajale v�imaluse faile �lesse laadida, omada privaat albumeid, omada eelistuste lehte, hinnata pilte, n�eb teisi kasutajaid ja saab saata postkaarte.', 'offline', '1'), //cpg1.3.0
  array('Kuidas registreeruda?', 'Vajuta &quot;Registreeri&quot; ja t�ida vajalikud v�ljad (kui soovid siis ka mitte vajalikud info v�ljad).<br />Kui administraator n�uab registreerumisel e-posti kinnitust siis peale v�ljade t�itmist saadetakse sulle e-maili sinupoolt kirjutatud aadressile mille sa registreerimisel sisestasid. Sealt leiad edasised juhendid kuidas aktiveerida oma konto. Konto tuleb aktiveerida selleks et saaksid sisse logida. J�lgi et meili aadress oleks �ige! Mitte @hotmail.ee ja @hot.com', 'offline', '1'), //cpg1.3.0
  array('Kuidas sisse logida?', 'Vajuta &quot;Sisene&quot;, sisesta oma kasutajanimi ja parool ja soovikorral pane linnuke kasti  &quot;J�ta mind meelde&quot; ja oledki sees.<br /><b>NB!: Pr��nikud peavad olema teie arvutis lubatud ja neid ei tohi �ra kustutada kui tahate kasutada &quot;J�ta mind meelde&quot; kastikest.</b>', 'offline', 0), //cpg1.3.0
  array('Miks ma sisse ei saa?', 'Kas sa sisestasid �ige e-maili aadressi? Kas sa registreerusid ja klikkisid sellele lingile mis sulle e-mailiga tuli? See link aktiveerib sinu konto. Teiste probleemidega p��rdu administraatori poole.', 'offline', 0), //cpg1.3.0
  array('Kaotasin oma parooli?', 'Vajuta &quot;Sisene&quot; ja kui n�ed seal linki &quot;Unustasin parooli&quot; siis kasuta seda. Teiste probleemidega p��rdu administraatori poole uue parooli saamiseks.', 'offline', 0), //cpg1.3.0
  array('Kuidas muuta e-maili aadressi?', 'Seda ei saa kahjuks ise muuta. Meili aadressi saab muuta ainult administraator. ', 'offline', 0), //cpg1.3.0
  array('Kuidas salvestada pilte &quot;Minu eelistused&quot; alla?', 'Vajuta pisipildile ning siis vajuta &quot;N�ita/peida pildi info&quot; (<img src="images/info.gif" width="16" height="16" border="0" alt="N�ita/peida pildi info" />); ja siis liigu lehel alla kuni n�ed pildi infot. Vajuta &quot;Lisa eelistustesse&quot;.<br />V�imalik et administraator pole andnud luba piltide lisamiseks &quot;Minu eelistused&quot; alla.<br /><b>NB!: Pr��nikud peavad olema teie arvutis lubatud ja neid ei tohi �ra kustutada kui tahate kasutada &quot;Minu eelistused&quot; .', 'offline', 0), //cpg1.3.0
  array('Kuidas hinnata pilti / faili?', 'Vajuta pisipildile, liigu alla ja hinda pilti / faili.', 'offline', 0), //cpg1.3.0
  array('Kuidas kommenteerida pilti?', 'Vajuta pisipildile, liigu alla ja sealt sisesta oma kommentaar.', 'offline', 0), //cpg1.3.0
  array('Kuidas lisada faile?', 'Faile saavad lisada registreeritud kasutajad kui administraator on selleks loa andnud. Alustuseks sisene lehele oma kasutajanime ja parooliga. Vajuta &quot;Lisa fail/e albumisse&quot; sealt vali album millesse tahad oma pilte panna, edasi vajuta &quot;Browse&quot; ning vali oma arvutist v�lja failid mida tahad saata ja vajuta &quot;open&quot; (v�id lisada pealkirja ja kirjelduse juurde kui soovid) ja vajuta &quot;Submit&quot;. ', 'offline', 0), //cpg1.3.0
  array('Kuhu mu lisatud pildid l�hevad?', 'Sul on v�imalik lisada oma pilte oma albumisse &quot;Minu galerii&quot;. Administraator v�ib sulle ka anda loa piltide lisamiseks pea albumisse.', 'offline', 0), //cpg1.3.0
  array('Mis t��pi ja kui suuri faile saan ma �lesse laadida?', 'Faili suurus / t��p (jpg, png, etc.) s�ltub administraatori seadetest.', 'offline', 0), //cpg1.3.0
  array('Mis on &quot;Minu galerii&quot;?', '&quot;Minu galerii&quot; on sinu isiklik galerii kuhu saad pilte ja faile �lesse laadida ja mida sa saad redigeerida.', 'offline', 0), //cpg1.3.0
  array('Kuidas teha, �mbernimetada v�i kustutada albumit &quot;Minu galerii&quot; alt?', 'Sa pead olema admin olekus sees &quot;Admin olek&quot;<br />Vajuta &quot;Loo / telli albumeid&quot;. Uue tegemiseks vajuta &quot;Uus&quot;. Muutmiseks vajuta olemasolevale albumile ja muuda nimi. Kustutamiseks vali album ja vajuta &quot;Kustuta&quot;. Muudastute salvestamiseks vajuta nupule &quot;Omista muudatused&quot;.', 'offline', 0), //cpg1.3.0
  array('Kuidas ma saan muuta oma albumit avalikuks ja privaatseks?', 'Sa pead olema admin olekus sees &quot;Admin olek&quot;.<br />Vajuta &quot;Redigeeri albumeid&quot; ja sealt vali kes v�ivad sinu albumeid vaadata. Siin saad sa ka muuta teisi oma albumi seadeid.', 'offline', 0), //cpg1.3.0
  array('Kuidas / kuskohast ma saan vaadata teiste kasutajate galeriisid?', 'Mine pealehele ja sealt vaata &quot;Kasutajaate galeriid&quot;.', 'offline', 0), //cpg1.3.0
  array('Mis on pr��nikud?', 'Pr��nikud on v�iksed tekstifailid mis sisaldavad veebilehelt saadetud infot sinu arvutis.<br />Pr��nikud lubavad tavaliselt veebilehele sisseloginul kasutajal hiljem ilma sisselogimatta veebilehele tagasi tulla.', 'offline', 0), //cpg1.3.0
  array('Kuskohast ma saaksin selle programmi oma lehele?', 'Coppermine on tasuta Multimeedia Galerii, k�lasta nende kodulehek�lge <a href="http://coppermine.sf.net/">Coppermine Home Page</a>', 'offline', 0), //cpg1.3.0

  'Navigeerimis nupud', //cpg1.3.0
  array('Mis on &quot;Albumite loetelu&quot;?', 'Sealt leiad k�ik pildid.', 'offline', 0), //cpg1.3.0
  array('Mis on &quot;Minu galerii&quot;?', 'Sealt leiad oma lisatud pildid / failid.', 'allow_private_albums', 0), //cpg1.3.0
  array('Mis neil vahet on kas &quot;Admin olek&quot; v�i &quot;Kasutaja olek&quot;?', 'Admin olekus saad muuta albumi seadeid ja kasutaja olekus n�ed lehte nii nagu n�evad seda lehe mitte registreeritud k�lastajad.', 'allow_private_albums', 0), //cpg1.3.0
  array('Mis on &quot;Lisa fail/e albumisse&quot;?', 'Siit saad oma albumisse lisada faile ja pilte.', 'allow_private_albums', 0), //cpg1.3.0
  array('Mis on &quot;Viimati lisatud&quot;?', 'N�ed viimati lisatuid pilte.', 'offline', 0), //cpg1.3.0
  array('Mis on &quot;Viimased kommentaarid&quot;?', 'N�ed viimati lisatuid kommentaare.', 'offline', 0), //cpg1.3.0
  array('Mis on &quot;Enim vaadatud&quot;?', 'N�ed enimvaadatuid pilte / faile.', 'offline', 0), //cpg1.3.0
  array('Mis on &quot;Edetabel&quot;?', 'Siit n�ed kasutajatepoolt enim hinnatuid pilte / faile.', 'offline', 0), //cpg1.3.0
  array('Mis on &quot;Minu eelistused&quot;?', 'Sinna saad paigutada oma lemmik pildid / failid.', 'offline', 0), //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// File forgot_passwd.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FORGOT_PASSWD_PHP')) $lang_forgot_passwd_php = array(
  'forgot_passwd' => 'Unustasin parooli', //cpg1.3.0
  'err_already_logged_in' => 'Sa oled juba sisse logitud !', //cpg1.3.0
  'enter_username_email' => 'Sisesta oma kasutajanimi v�i e-maili aadress', //cpg1.3.0
  'submit' => 'Valmis', //cpg1.3.0
  'failed_sending_email' => 'Unustatud parooli ei saadetud !', //cpg1.3.0
  'email_sent' => 'E-mail sinu kasutajanime ja parooliga on saadetud %s', //cpg1.3.0
  'err_unk_user' => 'Puudub selline kasutaja / e-mail!', //cpg1.3.0
  'passwd_reminder_subject' => '%s - Sinu ununenud parool', //cpg1.3.0
  'passwd_reminder_body' => 'Palusid ennast teavitada oma ununenud paroolist ja kasutajanimest:
Kasutajanimi: %s
Parool: %s
Vajuta %s sisenemiseks.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
  'group_name' => 'Grupi nimi',
  'disk_quota' => 'Ketta kvoot',
  'can_rate' => 'V�ib hinnata pilte', //cpg1.3.0
  'can_send_ecards' => 'V�ib saata e-kaarte',
  'can_post_com' => 'V�ib kommenteerida',
  'can_upload' => 'V�ib �les laadida faile', //cpg1.3.0
  'can_have_gallery' => 'V�ib luua isikliku galerii',
  'apply' => 'Omista muudatused',
  'create_new_group' => 'Loo uus grupp',
  'del_groups' => 'Kustuta m�rgitud grupp(id)',
  'confirm_del' => 'Hoiatus, kui sa kustutad grupi, siis kustutava grupi kasutajad kantakse \'Registereeritud\' gruppi !\n\nTahad sa j�tkata ?', //js-alert //cpg1.3.0
  'title' => 'Manage user groups',
  'approval_1' => 'Av. salv. kinnitus (1)',
  'approval_2' => 'Isik. salv. kinnitus (2)',
  'upload_form_config' => '�leslaadimise v�imalised', //cpg1.3.0
  'upload_form_config_values' => array( 'Single file uploads only', 'Multiple file uploads only', 'URI uploads only', 'ZIP upload only', 'File-URI', 'File-ZIP', 'URI-ZIP', 'File-URI-ZIP'), //cpg1.3.0
  'custom_user_upload'=>'V�ib muuta �leslaadimis kastikeste arvu?', //cpg1.3.0
  'num_file_upload'=>'T�pne �leslaadimis kastikeste arv', //cpg1.3.0
  'num_URI_upload'=>'T�pne �leslaadimis (ridade) kastikeste arv', //cpg1.3.0
  'note1' => '<b>(1)</b> Salvestused avalikku albumisse vajavad admini kinnitust',
  'note2' => '<b>(2)</b> Salvestused kasutaja albumisse vajavad admini kinnitust ',
  'notes' => 'M�rkused',
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
  'welcome' => 'Tere tulemast !',
);

$lang_album_admin_menu = array(
  'confirm_delete' => 'Oled kindel, et tahad seda albumit KUSTUDADA ? \\nK�ik pildid ja kommentaarid kustutakse samuti.', //js-alert //cpg1.3.0
  'delete' => 'KUSTUTA',
  'modify' => 'OMADUSED',
  'edit_pics' => 'REDIGEERI PILTE', //cpg1.3.0
);

$lang_list_categories = array(
  'home' => 'Avaleht',
  'stat1' => '<b>[pictures]</b> pilti <b>[albums]</b> albumit ja <b>[cat]</b> kategooriat koos <b>[comments]</b> kommentaariga vaadatud <b>[views]</b> korda',  //cpg1.3.0
  'stat2' => '<b>[pictures]</b> pilti <b>[albums]</b> albumit vaadatud <b>[views]</b> korda',  //cpg1.3.0
  'xx_s_gallery' => '%s\' Galerii',
  'stat3' => '<b>[pictures]</b> pilti <b>[albums]</b> albumit koos <b>[comments]</b> kommentaariga vaadatud <b>[views]</b> korda' //cpg1.3.0
);

$lang_list_users = array(
  'user_list' => 'Kasutajate loetelu',
  'no_user_gal' => 'Siin pole kasutajate galeriisid',
  'n_albums' => '%s album(it)',
  'n_pics' => '%s faili(i)', //cpg1.3.0
);

$lang_list_albums = array(
  'n_pictures' => '%s faili(i)', //cpg1.3.0
  'last_added' => ', viimane lisati %s',
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
  'login' => 'Sisene',
  'enter_login_pswd' => 'Sisenemiseks sisesta kasutajanimi ja parool',
  'username' => 'Kasutajanimi',
  'password' => 'Parool',
  'remember_me' => 'J�ta mind meelde',
  'welcome' => 'Teretulemast %s ...',
  'err_login' => '*** Ei saanud sisse logida. Proovi uuesti ***',
  'err_already_logged_in' => 'Sa oled juba sisse logitud !',
  'forgot_password_link' => 'Unustasid parooli', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
  'logout' => 'V�lju',
  'bye' => 'Head aega, %s ...',
  'err_not_loged_in' => 'Sa pole sisse logitud !',
);

// ------------------------------------------------------------------------- //
// File phpinfo.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('PHPINFO_PHP')) $lang_phpinfo_php = array(
  'php_info' => 'PHP info', //cpg1.3.0
  'explanation' => 'See on genereeritud PHP-funktsioon <a href="http://www.php.net/phpinfo">phpinfo()</a>', //cpg1.3.0
  'no_link' => 'Kui teised n�evad seda on turvaauk. Sa n�ed seda ainult siis kui oled administraatorina sisse loginud. Sellele lehele ei p��se ligi lingina.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
  'upd_alb_n' => 'Uuenda album %s',
  'general_settings' => '�ldised seaded',
  'alb_title' => 'Albumi pealkiri',
  'alb_cat' => 'Albumi kategooria',
  'alb_desc' => 'Albumi kirjeldus',
  'alb_thumb' => 'Albumi pisipilt',
  'alb_perm' => '�igused sellele albumile',
  'can_view' => 'Albumit v�ivad vaadata',
  'can_upload' => 'K�lastajad v�ivad salvestada pilte',
  'can_post_comments' => 'K�lastajad v�ivad kommenteerida',
  'can_rate' => 'K�lastajad v�ivad hinnata pilte',
  'user_gal' => 'Kasutaja Galerii',
  'no_cat' => '* Kategooriata *',
  'alb_empty' => 'Album on t�hi',
  'last_uploaded' => 'Viimati lisatud',
  'public_alb' => 'Iga�ks (avalik album)',
  'me_only' => 'Ainult mina',
  'owner_only' => 'Albumi omanik (%s) ainult',
  'groupp_only' => 'Grupi \'%s\' liikmed',
  'err_no_alb_to_modify' => '�htegi albumit sa ei saa muuta andmebaasis.',
  'update' => 'Uuenda album', //cpg1.3.0
  'notice1' => '(*) olenevalt %sgruppide%s seadetest', //cpg1.3.0 (do not translate %s!)
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
  'already_rated' => 'Vabandust, aga sa oled juba seda faili hinnanud', //cpg1.3.0
  'rate_ok' => 'Sinu h��l on vastu v�etud',
  'forbidden' => 'Sa ei saa hinnata oma faile.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
Kuigi saidi {SITE_NAME} administraatorid p��avad eemaldada v�i muuta mistahes �ldiselt pahaks-pandavad materjalid niipea kui v�imalik, pole v�imalik nendegi poolt kohe n�ha iga postitust. Seet�ttu pead tunnistama, et k�ik postitused, mis siia kiirv�ljaandesse tehakse (pildid, kommentaarid, arvamused) teiste autorite poolt, nende eest administraatorid ja webmasterid ei saa vastutada (v�ljaarvatud nende endi postitused).<br />
<br />
Sa n�ustud mitte postitama s�imu, roppusi, r�vedusi, laimu, solvanguid, �hvardusi, soolisi- ega muid m�rkusi ja kommentaare ning materjale, mis oleksid vastuolus kehtivate seadustega. Sa n�ustud et webmaster, administraator ja saidi {SITE_NAME} vahekohtunikud omavad �igust kustutada v�i parandada mistahes sisu kuidas ja millal neile sobib. Kasutajana sa n�ustud, et kogu sinu �lal sisestatud info salvestatakse andmebaasi. Kuigi seda infot ei avaldata kolmandatele isikutele ilma sinu n�usolekuta, ei saa webmaster ja administraator v�tta endale vastutust  h�kkimiskatsete eest, mis v�ivad andmed ohtu seada.<br />
<br />
See sait kasutab pr��nikuid slavestamaks infot sinu lokaalses arvutis. Need pr��nikud on m�eldud ainult t�stmaks sinu vaatamise r��mu. Eposti aadressi kasutatakse ainult kinnitamaks sinu registreerumise detaile ja parooli.<br />
<br />
Kilkates 'Olen n�us' allpool, n�ustud sa nende n�uete ja tingimustega.
EOT;

$lang_register_php = array(
  'page_title' => 'User registration',
  'term_cond' => 'Terms and conditions',
  'i_agree' => 'Olen n�us',
  'submit' => 'Saada registreerimine',
  'err_user_exists' => 'Sinu siseatud kasutajanimi juba olemas, palun vali muu',
  'err_password_mismatch' => 'Kaks parooli ei lange kokku, palun sisesta nad uuesti',
  'err_uname_short' => 'Kasutajanimi peab olema v�hemalt 2 t�hem�rki',
  'err_password_short' => 'Parool peab olema v�hemalt 2 t�hem�rki',
  'err_uname_pass_diff' => 'Kasutajanimi peab paroolist erinema',
  'err_invalid_email' => 'Vigane e-posti aadress',
  'err_duplicate_email' => 'Keegi on juba registreerunud sinu sisestatud e-posti aadressiga',
  'enter_info' => 'Sisesta registreerimisinfo',
  'required_info' => 'Vajalik info',
  'optional_info' => 'Soovitatav info',
  'username' => 'Kasutajanimi',
  'password' => 'Parool',
  'password_again' => 'Parool uuesti',
  'email' => 'E-post',
  'location' => 'Elukoht',
  'interests' => 'Rate.ee aadress',
  'website' => 'Koduleht',
  'occupation' => 'Kuidas sattusid siia',
  'error' => 'VIGA',
  'confirm_email_subject' => '%s - Registreerumise kinnitus.',
  'information' => 'Informatsioon',
  'failed_sending_email' => 'Registreerumise kinnitust ei �nnestunud saata !',
  'thank_you' => 'T�name Teid registreerumast.<br /><br />E-post infoga, kuidas oma kontot aktiveerida, saadeti sinu antud e-posti aadressile.',
  'acct_created' => 'Sinu konto on loodud ja n��d sa v�id sisse logida oma kasutajanime ja parooliga',
  'acct_active' => 'Sinu konto on n��d aktiveeritud ja sa v�id sisse logida oma kasutajanime ja parooliga',
  'acct_already_act' => 'Sinu konto on juba aktiivne !',
  'acct_act_failed' => 'Seda kontot ei saa aktiveerida !',
  'err_unk_user' => 'Valitud kasutaja puudub !',
  'x_s_profile' => '%s\'i profiil',
  'group' => 'Grupp',
  'reg_date' => 'Liitutud',
  'disk_usage' => 'Ketta kasutus',
  'change_pass' => 'Muuda parooli',
  'current_pass' => 'Kehtiv parool',
  'new_pass' => 'Uus parool',
  'new_pass_again' => 'Uus parool veelkord',
  'err_curr_pass' => 'Praegune parool on vale',
  'apply_modif' => 'Omista muudatused',
  'change_pass' => 'Muuda minu parool',
  'update_success' => 'Sinu profiil on uuendatud',
  'pass_chg_success' => 'Sinu parool on muudetud',
  'pass_chg_error' => 'Sinu parooli ei muudetud',
  'notify_admin_email_subject' => '%s - Uus kasutaja on registreerunud', //cpg1.3.0
  'notify_admin_email_body' => 'Kasutaja nimega "%s" registreerus sinu pildialbumis.', //cpg1.3.0
);

$lang_register_confirm_email = <<<EOT
T�name et registreerusid {SITE_NAME}

Sinu kasutajanimi on : "{USER_NAME}"
Sinu parool on : "{PASSWORD}"

Konto aktiveerimiseks vajuta all olevale lingile
v�i kopeeri ja kleebi see oma browseri aadressi reale.

{ACT_LINK}

Tervitades!

 {SITE_NAME} Administraator

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
  'title' => 'Kommentaaride �levaade',
  'no_comment' => 'Siin pole �htegi kommentaari �le vaadata',
  'n_comm_del' => '%s kommentaar(i) kustutatud',
  'n_comm_disp' => 'Kommentaaride arv kuvamiseks',
  'see_prev' => 'Vaata eelmist',
  'see_next' => 'Vaata j�rgmist',
  'del_comm' => 'Kustuta valitud kommentaarid',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
  0 => 'Otsi failikogumikku',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
  'page_title' => 'Otsi uusi pilte', //cpg1.3.0
  'select_dir' => 'Vali kataloog',
  'select_dir_msg' => 'See funktsioon lubab sul lisada kogumiku faile, mis sa oled salvestanud oma serverisse FTP\'ga.<br /><br />Vali kataloog kuhu sa oma failid oled salvestanud', //cpg1.3.0
  'no_pic_to_add' => 'Siin pole faile lisamiseks', //cpg1.3.0
  'need_one_album' => 'Sa vajad v�hemalt �hte albumit selle funktsiooni kasutamiseks',
  'warning' => 'Hoiatus',
  'change_perm' => 'see skript ei saa kirjutada sellesse kataloogi, sa pead muutma selle �igusi (mood 755 v�i 777) enne kui �ritad uuesti lisada faile !', //cpg1.3.0
  'target_album' => '<b>Pane &quot;</b>%s<b>&quot; failid albumisse </b>%s', //cpg1.3.0
  'folder' => 'Kaust',
  'image' => 'fail',
  'album' => 'Album',
  'result' => 'Tulemus',
  'dir_ro' => 'Pole kirjutatav. ',
  'dir_cant_read' => 'Pole loetav. ',
  'insert' => 'Lisan uued failid galeriisse', //cpg1.3.0
  'list_new_pic' => 'Uute failide loetelu', //cpg1.3.0
  'insert_selected' => 'Lisa valitud failid', //cpg1.3.0
  'no_pic_found' => 'Ei leitud uusi faile', //cpg1.3.0
  'be_patient' => 'Palun ole kannatlik, skript vajab failide lisamiseks aega', //cpg1.3.0
  'no_album' => 'Pole albumit valitud',  //cpg1.3.0
  'notes' =>  '<ul>'.
                          '<li><b>OK</b> : t�hendab, et fail lisati edukalt'.
                          '<li><b>DP</b> : t�hendab, et fail on dublikaat ja sisaldub juba andmebaasis'.
                          '<li><b>PB</b> : t�hendab, et faili ei saa lisada, kontrolli oma seadeid ja kataloogi �igusi kus su failid asuvad'.
                          '<li><b>NA</b> : t�hendab, et sa ei oma valitud albumit kuhu su failid peaksid minema, vajuta \'<a href="javascript:history.back(1)">tagasi</a>\' ja vali m�ni album. Kui sa ei oma / pole albumit siis <a href="albmgr.php">tekita omale album</a></li>'.
                          '<li>Kui OK, DP, PB \'ei ilmu, klikka katkenud failil n�gemaks mistahes PHP poolt antud veateadet'.
                          '<li>Kui su sirvijal on \'timeout\', vajuta Refresh nuppu'.
                          '</ul>', //cpg1.3.0
  'select_album' => 'vali album', //cpg1.3.0
  'check_all' => 'M�rgi k�ik', //cpg1.3.0
  'uncheck_all' => 'Eemalda m�rgistused', //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //

// Void

// ------------------------------------------------------------------------- //
// File banning.php
// ------------------------------------------------------------------------- //

if (defined('BANNING_PHP')) $lang_banning_php = array(
  'title' => 'Kasutajate Blokeerimine',
  'user_name' => 'Kasutaja nimi',
  'ip_address' => 'IP Aadress',
  'expiry' => 'Blokeeritud kuni (vajuta t�hjale kastile)',
  'edit_ban' => 'Salvesta muudatus',
  'delete_ban' => 'Kustuta',
  'add_new' => 'Blokeeri uus kasutaja',
  'add_ban' => 'lisa',
  'error_user' => 'Ei leia kasutajat', //cpg1.3.0
  'error_specify' => 'Pead sisestama kasutajanime v�i IP aadressi', //cpg1.3.0
  'error_ban_id' => 'Vigane ID!', //cpg1.3.0
  'error_admin_ban' => 'Sa ei saa ennast blokeerida!', //cpg1.3.0
  'error_server_ban' => 'Mis sa teed? Tahad blokeerida oma serverit? Sa ei saa seda kahjuks teha...', //cpg1.3.0
  'error_ip_forbidden' => 'Sa ei saa blokeerida seda IP-d See pole k�ttesaadav!', //cpg1.3.0
  'lookup_ip' => 'Vaata j�rgi IP aadress', //cpg1.3.0
  'submit' => 'Vaata!', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
  'title' => 'Salvesta faile', //cpg1.3.0
  'custom_title' => 'Sisesta fail/e ', //cpg1.3.0
  'cust_instr_1' => 'Sa v�id sisestada lahtritesse numbreid 1-10 Olenevalt sellest mitu faili tahad korraga �lesse saata. Maksimum on 10. �ks rida on �he faili lisamiseks.', //cpg1.3.0
  'cust_instr_2' => 'Sisesta number', //cpg1.3.0
  'cust_instr_3' => 'Faili saatmise lahtreid: %s', //cpg1.3.0
  'cust_instr_4' => 'URI/URL saatmise lahtreid: %s', //cpg1.3.0
  'cust_instr_5' => 'URI/URL �leslaadimise v�ljad:', //cpg1.3.0
  'cust_instr_6' => 'Faili �leslaadimise v�ljad:', //cpg1.3.0
  'cust_instr_7' => 'Sisesta soovitud arv lahtrisse.  Ja siis vaajuta \'J�TKA\'. ', //cpg1.3.0
  'reg_instr_1' => 'Vigane tegevus.', //cpg1.3.0
  'reg_instr_2' => 'N��d saad �les laadida faile, kasutades allolevaid v�lju. Faili suurus ei tohi �letada %s KB. ', //cpg1.3.0
  'reg_instr_3' => 'Kokkupakitud failide �leslaadimiseks kasuta selleks etten�htud v�lju.', //cpg1.3.0
  'reg_instr_4' => 'Kui kasutad URI/URL �leslaadimise v�lju, sisesta aadress sellisel kujul: http://www.mysite.com/images/example.jpg', //cpg1.3.0
  'reg_instr_5' => 'Kui oled v�ljad t�itnud vajuta \'J�TKA\'.', //cpg1.3.0
  'reg_instr_6' => 'Kokkupakitud failide �leslaadimine:', //cpg1.3.0
  'reg_instr_7' => 'Failide �leslaadimine:', //cpg1.3.0
  'reg_instr_8' => 'URI/URL �leslaadimine:', //cpg1.3.0
  'error_report' => 'Vigade raport', //cpg1.3.0
  'error_instr' => 'J�rgnevad �leslaadimised olid vigased:', //cpg1.3.0
  'file_name_url' => 'Faili Nimi/URL', //cpg1.3.0
  'error_message' => 'Vea tekst', //cpg1.3.0
  'no_post' => 'File pole �leslaetud POST meetodiga.', //cpg1.3.0
  'forb_ext' => 'keelatud faililaiend.', //cpg1.3.0
  'exc_php_ini' => 'Faili suurus suurem kui lubatud php.ini-s.', //cpg1.3.0
  'exc_file_size' => 'Faili suurus suurem kui galerii konfiguratsioonis lubatud!.', //cpg1.3.0
  'partial_upload' => 'Ainult poolikult �leslaetud', //cpg1.3.0
  'no_upload' => 'Midagi ei laetud �lesse', //cpg1.3.0
  'unknown_code' => 'Arusaamatu PHP viga.', //cpg1.3.0
  'no_temp_name' => '�leslaadimist ei toimu - pole ajutist nime.', //cpg1.3.0
  'no_file_size' => 'Pole andmeid/vigased failid', //cpg1.3.0
  'impossible' => 'Ei saa liigutada.', //cpg1.3.0
  'not_image' => 'Pole pildiformaat/vigased failid', //cpg1.3.0
  'not_GD' => 'Pole GD faililaiend.', //cpg1.3.0
  'pixel_allowance' => 'Pikslite arv liiga suur.', //cpg1.3.0
  'incorrect_prefix' => 'ViganeURI/URL algus', //cpg1.3.0
  'could_not_open_URI' => 'ei saa avada URI-i.', //cpg1.3.0
  'unsafe_URI' => 'Ebaturvaline aadress.', //cpg1.3.0
  'meta_data_failure' => 'Andmete viga', //cpg1.3.0
  'http_401' => '401 Autoriseerimata', //cpg1.3.0
  'http_402' => '402 Tasuline weeb', //cpg1.3.0
  'http_403' => '403 Keelatud', //cpg1.3.0
  'http_404' => '404 Saiti ei leitud', //cpg1.3.0
  'http_500' => '500 Serveri sisene viga', //cpg1.3.0
  'http_503' => '503 Teenus k�ttesaadamatu', //cpg1.3.0
  'MIME_extraction_failure' => 'MIME t��pi ei suudeta tuvastada.', //cpg1.3.0
  'MIME_type_unknown' => 'Tundmatu MIME t��p', //cpg1.3.0
  'cant_create_write' => 'Ei saa faili serverisse kirjutada.', //cpg1.3.0
  'not_writable' => 'Ei saa faili serverisse kirjutada.', //cpg1.3.0
  'cant_read_URI' => 'Ei suuda URI/URL-i lugeda', //cpg1.3.0
  'cant_open_write_file' => 'Ei saa avada URI-i faili kirjutamiseks.', //cpg1.3.0
  'cant_write_write_file' => 'Ei saa avada URI-i faili kirjutamiseks.', //cpg1.3.0
  'cant_unzip' => 'Ei saa lahti pakkida.', //cpg1.3.0
  'unknown' => 'Tundmatu viga', //cpg1.3.0
  'succ' => '�nnestunud �leslaadimised', //cpg1.3.0
  'success' => '%s Fail/li edukalt �leslaetud.', //cpg1.3.0
  'add' => 'Vajuta \'J�TKA\' et lisada faile albumitesse.', //cpg1.3.0
  'failure' => '�lessaatmine eba�nnestus', //cpg1.3.0
  'f_info' => 'Faili informatsioon', //cpg1.3.0
  'no_place' => 'Eelnevat faili ei saa albumisse lisada.', //cpg1.3.0
  'yes_place' => 'J�rgev fail edukalt lisatud albumisse.', //cpg1.3.0
  'max_fsize' => 'maksimaalne lubatud failisuurus on %s KB',
  'album' => 'Album',
  'picture' => 'File', //cpg1.3.0
  'pic_title' => 'File pealkiri', //cpg1.3.0
  'description' => 'Filei kirjeldus', //cpg1.3.0
  'keywords' => 'T�hemargid (eralda komadega)',
  'err_no_alb_uploadables' => 'Puudub album, kuhu sul on lubatud �leslaadida', //cpg1.3.0
  'place_instr_1' => 'Lisa failid albumitesse. Sa saad lisada informatsiooni failide kohta praegu.', //cpg1.3.0
  'place_instr_2' => 'Veel faile on vaja lisada albumitesse. Palun vajuta \'J�TKA\'.', //cpg1.3.0
  'process_complete' => 'K�ik failid edukalt lisatud.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
  'title' => 'Halda kasutajaid',
  'name_a' => 'Nimed kasvavalt',
  'name_d' => 'Nimed kahanevalt',
  'group_a' => 'Grupid kasvavalt',
  'group_d' => 'Grupid kahanevalt',
  'reg_a' => 'Reg kuup�ev kasvavalt',
  'reg_d' => 'Reg kuup�ev kahanevalt',
  'pic_a' => 'Failide arv kasvavalt',
  'pic_d' => 'Failide arv kahanevalt',
  'disku_a' => 'Kvoodi ruum kasvavalt',
  'disku_d' => 'Kvoodi ruum kahanevalt',
  'lv_a' => 'Viimane visiit kasvavalt', //cpg1.3.0
  'lv_d' => 'Viimane visiit kahanevalt', //cpg1.3.0
  'sort_by' => 'Sordi kasutajaid',
  'err_no_users' => 'Kasutajate tabel t�hi !',
  'err_edit_self' => 'Sa v�id muuta oma profiili, kasuta \'Minu profiil\' linki selleks',
  'edit' => 'MUUDA',
  'delete' => 'KUSTUTA',
  'name' => 'Kasutajanimi',
  'group' => 'Grupp',
  'inactive' => 'Aktiivne',
  'operations' => 'Toimingud',
  'pictures' => 'Failid', //cpg1.3.0
  'disk_space' => 'Kasutatud ketta kvooti',
  'registered_on' => 'Registreerus',
  'last_visit' => 'Viimati k�lastas', //cpg1.3.0
  'u_user_on_p_pages' => '%d kasutajat %d-el lehel',
  'confirm_del' => 'Oled kindel, et tahad selle kasutaja KUSTUTADA ? \\nK�ik tema pildid ja albumid kustutatakse samuti.', //js-alert //cpg1.3.0
  'mail' => 'POST',
  'err_unknown_user' => 'Valitud kasutajat pole !',
  'modify_user' => 'Muuda kasutaja',
  'notes' => 'M�rkused',
  'note_list' => '<li>Kui sa ei taha muuta kasutuselolevat parooli, j�ta "parool" v�li t�hjaks',
  'password' => 'Parool',
  'user_active' => 'Kasutaja aktiivne',
  'user_group' => 'Kasutaja grupp',
  'user_email' => 'Kasutaja e-post',
  'user_web_site' => 'Kasutaja kodulehek�lg',
  'create_new_user' => 'Loo uus kasutaja',
  'user_location' => 'Kasutaja elukoht',
  'user_interests' => 'Kasutaja Rate.ee aadress',
  'user_occupation' => 'Kasutaja sattus siia',
  'latest_upload' => 'Viimane piltide lisaja', //cpg1.3.0
  'never' => 'kunagi', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
  'title' => 'Administraatori lisaseaded (Muuda piltide suurust)', //cpg1.3.0
  'what_it_does' => 'Mis see teeb',
  'what_update_titles' => 'Uuendab pealkirju failinimest',
  'what_delete_title' => 'Kustutab pealkirjad',
  'what_rebuild' => 'Loob uued pisipildid ja muudetud suurusega pildid',
  'what_delete_originals' => 'Kustutab originaalsuurusega pildid ja asendab need muudetus suurusega piltidega',
  'file' => 'Fail',
  'title_set_to' => 'pealkiri muudetud',
  'submit_form' => 'OK',
  'updated_succesfully' => 'uuendatud edukalt',
  'error_create' => 'VIGA',
  'continue' => 'Veel pilte?',
  'main_success' => '%i edukalt muudetud', //cpg1.3.0
  'error_rename' => 'EI saanud muuta %t faili %st',
  'error_not_found' => '% faili ei leitud',
  'back' => 'tagasi',
  'thumbs_wait' => 'Pisipiltide ja uue suurusega piltide uuendamine, palun oota...',
  'thumbs_continue_wait' => 'Pisipiltide ja uue suurusega piltide uuendamise j�tkamine',
  'titles_wait' => 'Uuendan pealkirju, palun oota...',
  'delete_wait' => 'Kustutan pealkirju, palun oota...',
  'replace_wait' => 'Kustutan originaalpilte ja asendan neid uue suurusega piltidega, palun oota..',
  'instruction' => 'Kiired kasutusjuhendid',
  'instruction_action' => 'Vali tegevus',
  'instruction_parameter' => 'Pane parameetrid paika',
  'instruction_album' => 'Vali album',
  'instruction_press' => 'Vajuta %',
  'update' => 'Uuenda Pisipilte ja/v�i uue suurusega pilte',
  'update_what' => 'Mida peaks uuendama',
  'update_thumb' => 'ainult pisipildid',
  'update_pic' => 'ainult uue suurusega failid',
  'update_both' => 'm�lemad',
  'update_number' => '�he klikiga uuendatud piltide arv',
  'update_option' => '(Pane see number v�iksemaks, kui sul saad timeouti)',
  'filename_title' => 'Failinimi &rArr; Faili nimi', //cpg1.3.0
  'filename_how' => 'Kuidas peaks failinime muutma',
  'filename_remove' => 'Eemalda .jpg l�pust ja asenda _ (alakriips) t�hikuga',
  'filename_euro' => 'Muuda 2003_11_23_13_20_20.jpg to 23/11/2003 13:20',
  'filename_us' => 'Muuda 2003_11_23_13_20_20.jpg to 11/23/2003 13:20',
  'filename_time' => 'Muuda 2003_11_23_13_20_20.jpg to 13:20',
  'delete' => 'Kustuta pealkirjad originaalsurusega failidelt', //cpg1.3.0
  'delete_title' => 'Kustuta faili nimed', //cpg1.3.0
  'delete_original' => 'Kustuta originaalsuurusega failid',
  'delete_replace' => 'Kustutab originaalfailid ja asendab need muudetus suurusega failidega',
  'select_album' => 'Vali album',
  'delete_orphans' => 'Kustuta mingid kommentaarid (toimib k�ikides albumites)', //cpg1.3.0
  'orphan_comment' => 'Leitud imelikud kommentaarid', //cpg1.3.0
  'delete' => 'Kustuta', //cpg1.3.0
  'delete_all' => 'Kustuta k�ik', //cpg1.3.0
  'comment' => 'Kommentaar: ', //cpg1.3.0
  'nonexist' => 'Lisa mitteeksisteerivale failile # ', //cpg1.3.0
  'phpinfo' => 'N�ita phpinfo-t', //cpg1.3.0
  'update_db' => 'Uuenda andmebaasi', //cpg1.3.0
  'update_db_explanation' => 'Kui sa midagi uuendad, siis uuenda andmebaasi, muidu asi ei toimi.', //cpg1.3.0
);

?>