<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.3.3                                            //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002-2004 Gregory DenAR                                     //
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
// ENCODING CHECK; SHOULD BE YEN BETA MU: ¥ ß µ
// ------------------------------------------------------------------------- //
// $Id: albanian.php,v 1.2 2005/08/12 07:20:53 gaugau Exp $
// ------------------------------------------------------------------------- //

// info about translators and translated language
$lang_translation_info = array(
'lang_name_english' => 'Albanian',
'lang_name_native' => 'Albanian',
'lang_country_code' => 'al',
'trans_name'=> 'Ajet Nuro', //the name of the translator - can be a nickname
'trans_email' => 'admin@albemigrant.com', //translator's email address (optional)
'trans_website' => 'http://www.albemigrant.com/', //translator's website (optional)
'trans_date' => '2004-06-01', //the date the translation was created / last modified
);

$lang_charset = 'iso-8859-1';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('E dielë', 'E hënë', 'E martë', 'E mërkurë', 'E enjte', 'E premte', 'E shtunë');
$lang_month = array('Janar', 'Shkurt', 'Mars', 'Prill', 'Maj', 'Qershor', 'Korrik', 'Gusht', 'Shtator', 'Tetor', 'Nëntor', 'Dhjetor');

// Some common strings
$lang_yes = 'Po';
$lang_no  = 'Jo';
$lang_back = 'MBRAPA';
$lang_continue = 'VAZHDIM';
$lang_info = 'Informacion';
$lang_error = 'Gabim';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%d %B %Y';
$lastcom_date_fmt =  '%d/%m/%y @ %H:%M';
$lastup_date_fmt = '%d %B %Y';
$register_date_fmt = '%d %B %Y';
$lasthit_date_fmt = '%d %B %Y @ %I:%M %p';
$comment_date_fmt =  '%d %B %Y @ %I:%M %p';

// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array(
        'random' => 'Fotografi të rastësishme',
        'lastup' => 'Futjet më të fundit',
        'lastalb'=> 'Albumet më të fundit',
        'lastcom' => 'Komentet në të fundit',
        'topn' => 'Më të shikuarat',
        'toprated' => 'Më të vlerësuarat',
        'lasthits' => 'Të para së fundi',
        'search' => 'Rezultatet e kërkimit',
        'favpics'=> 'Fotografitë e preferuara'
);

$lang_errors = array(
        'access_denied' => 'Ju nuk u lejohet hyrja në këtë faqe.',
        'perm_denied' => 'Ju nuk u lejohet të kryeni këtë veprim.',
        'param_missing' => 'Skript i thirrur pa patur prametrat e nevojshëm.',
        'non_exist_ap' => 'Albumi/fotografia e zgjedhur nuk ekziston !',
        'quota_exceeded' => 'Hapësira në disk e tejkaluar<br /><br />Ju keni nje hapsirë prej [quota]K, fotografitë tuaja momentalisht zënë një hapsirë prej [space]K, nëse shtoni këtë fotografiJu tejkaloni hapsirën e lejuar.',
        'gd_file_type_err' => 'Kur përdorni librarinë e imazheve GD, lejohen vetëm imazhet e formatit JPEG dhe PNG.',
        'invalid_image' => 'Imazhi që ju keni ngarkuar është i prishur ose nuk njihet nga libraria GD',
        'resize_failed' => 'Krijimi i tablove apo reduktimi i përmasave të fotografisë i pamundur.',
        'no_img_to_display' => 'Nuk ka imazhe për tu afishuar',
        'non_exist_cat' => 'Kategoria e zgjedhur nuk ekziston',
        'orphan_cat' => 'Një kategori ka një prind (paraardhës) jo ekzistent, pëdorni administrimin e kategorisë për të rregulluar problemin.',
        'directory_ro' => 'Repertori \'%s\' nuk është i shkrueshëm, fotografitë nuk mund të fshihen',
        'non_exist_comment' => 'Komenti i zgjedhur nuk ekziston.',
        'pic_in_invalid_album' => 'Fotografia është në një album që nuk ekziston (%s)!?',
        'banned' => 'Ju jeni për momentin i përjashtuar nga ky web sit.',
        'not_with_udb' => 'Ky funksion është çaktivizuar në Coppermine sepse është integruar me një forum. Ose veprimi që ju doni të kryeni nuk është përfshirë në këtë konfiguracion , ose funksionin në fjalë duhet ta kryeni duke u nisur nga forumi në të cilin keni integruar albumin fotografik.',
                'offline_title' => 'Jashtë linje', //cpg1.3.0
        'offline_text' => 'Galeria është në këtë moment jashtë linje - rikthehuni së shpejti !', //cpg1.3.0
        'ecards_empty' => 'Nuk ka karta elektronike të regjistruara për tu shfaqur. Verifikoni në ju keni bërë të disponueshme këtë mundësi tek konfigurimi !', //cpg1.3.0
        'action_failed' => 'Veprim i dështuar.  Coppermine nuk është në gjendje të kryej veprimin që ju kërkuat.', //cpg1.3.0
        'no_zip' => 'Libraritë e nevojshme për të trajtuar proceset e zipimit nuk janë instaluar.  Luteni të kontaktoni administratorin tuaj Coppermine !', //cpg1.3.0
        'zip_type' => 'Ju nuk keni leje të ngarkoni skedare ZIP.', //cpg1.3.0
);
$lang_bbcode_help = 'Këto kode mund tu jenë të nevojëshme: <li>[b]<b>Bold</b>[/b]</li> <li>[i]<i>Italic</i>[/i]</li> <li>[url=http://yoursite.com/]Url Text[/url]</li> <li>[email]user@domain.com[/email]</li>'; //cpg1.3.0
// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
        'alb_list_title' => 'Shko tek lista e albumeve',
        'alb_list_lnk' => 'Lista e albumeve',
        'my_gal_title' => 'Shko tek galeria ime personale',
        'my_gal_lnk' => 'Galeria ime',
        'my_prof_lnk' => 'Profili im',
        'adm_mode_title' => 'Kalo në modë admin',
        'adm_mode_lnk' => 'Modë admin',
        'usr_mode_title' => 'Kalo në modë përdorues',
        'usr_mode_lnk' => 'Modë përdorues',
                'upload_pic_title' => 'Ngarko një foto në një album',
        'upload_pic_lnk' => 'Ngarko foto',
        'register_title' => 'Krijo një llogari',
        'register_lnk' => 'Regjistrohu',
        'login_lnk' => 'Identifikohu',
        'logout_lnk' => 'Çidentifikohu',
        'lastup_lnk' => 'Ngarkimet më të fundit',
        'lastcom_lnk' => 'Komentet më të fundit',
        'topn_lnk' => 'Më të shikuarat',
        'toprated_lnk' => 'Më të vlerësuarat',
        'search_lnk' => 'Kërko',
        'fav_lnk' => 'Favoritet e mia',
                'memberlist_title' => 'Shfaq Listën e anëtarëve', //cpg1.3.0
        'memberlist_lnk' => 'Lista e anëtarëve', //cpg1.3.0
        'faq_title' => 'Pyetje të shpeshta të bëra përsa i përketë foto gallerisë &quot;Coppermine&quot;', //cpg1.3.0
        'faq_lnk' => 'FAQ', //cpg1.3.0
);

$lang_gallery_admin_menu = array(
        'upl_app_lnk' => 'Aprovim i ngarkimeve',
        'config_lnk' => 'Konfigurimi',
        'albums_lnk' => 'Albume',
        'categories_lnk' => 'Kategoritë',
        'users_lnk' => 'Përdoruesit',
        'groups_lnk' => 'Grupe',
        'comments_lnk' => 'Komente',
        'searchnew_lnk' => 'grumbull fotografish të futura',
        'util_lnk' => 'Ridimensionim i fotografive',
        'ban_lnk' => 'Ndalo përdoruesit',
                'db_ecard_lnk' => 'Shfaq kartolinat', //cpg1.3.0
);

$lang_user_admin_menu = array(
        'albmgr_lnk' => 'Krijim / renditje e albumeve të mi',
        'modifyalb_lnk' => 'Modifikim i albumeve të mi',
        'my_prof_lnk' => 'Profili im',
);

$lang_cat_list = array(
        'category' => 'Kategori',
        'albums' => 'Albume',
        'pictures' => 'Fotografi',
);

$lang_album_list = array(
        'album_on_page' => '%d albume në %d faqe'
);

$lang_thumb_view = array(
        'date' => 'DATË',
        //Sort by filename and title
        'name' => 'EMRI I DOSJES',
        'title' => 'TITULLI',
        'sort_da' => 'Renditje sipas datës në ngjitje',
        'sort_dd' => 'Renditje sipas datës në zbritje',
        'sort_na' => 'Renditje sipas emrit në ngjitje',
        'sort_nd' => 'Renditje sipas emrit në zbritje',
        'sort_ta' => 'Renditje sipas titullit në ngjitje',
        'sort_td' => 'Renditje sipas titullit në zbritje',
                'download_zip' => 'Shkarkoje si dokument ZIP', //cpg1.3.0
        'pic_on_page' => '%d fotografi në %d faqe(s)',
        'user_on_page' => '%d përdorues në %d faqe(s)'
);

$lang_img_nav_bar = array(
        'thumb_title' => 'Kthehu tek faqja e tablove',
        'pic_info_title' => 'Afisho/fshi informacionet e fotografisë',
        'slideshow_title' => 'Slideshow',
        'ecard_title' => 'Dërgoje këtë foto si një kartolinë elektronike',
        'ecard_disabled' => 'Kartat elektronike nuk janë aktive',
        'ecard_disabled_msg' => 'Ju nuk kini të drejtë të dërgoni karta elektronike',
        'prev_title' => 'Shiko fotografinë paraardhëse',
        'next_title' => 'Shiko fotografinë pasardhësenext picture',
        'pic_pos' => 'Foto %s/%s',
);

$lang_rate_pic = array(
        'rate_this_pic' => 'Vlerësoni këtë fotografi ',
        'no_votes' => '(Ende nuk ka vota)',
        'rating' => '(Vlerësimi i tanishëm : %s / 5 në %s vota)',
        'rubbish' => 'Shumë keq',
        'poor' => 'Varfër',
        'fair' => 'Mesatar',
        'good' => 'Mirë',
        'excellent' => 'Shkëlqyer',
        'great' => 'Madhështore',
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
        CRITICAL_ERROR => 'Gabim kritik',
        'file' => 'Dokumenti: ',
        'line' => 'Rreshti: ',
);

$lang_display_thumbnails = array(
        'filename' => 'Emri i skedarit : ',
        'filesize' => 'Madhësia e skedarit : ',
        'dimensions' => 'Dimensions : ',
        'date_added' => 'Data e shtimit : '
);

$lang_get_pic_data = array(
        'n_comments' => '%s komente',
        'n_views' => '%s shikime',
        'n_votes' => '(%s vota)'
);
$lang_cpg_debug_output = array(
  'debug_info' => 'Debug Info', //cpg1.3.0
  'select_all' => 'Përzgjidh të gjitha', //cpg1.3.0
  'copy_and_paste_instructions' => 'Nëse ju jeni duke kërkuar ndihme nga teknikët e coppermine, kopjo e ngjit këtë difekt tek postimi juaj. Make sure to replace any passwords from the query with *** before posting.', //cpg1.3.0
  'phpinfo' => 'Shfaq phpinfo', //cpg1.3.0
);

$lang_language_selection = array(
  'reset_language' => 'Gjuha e albumit', //cpg1.3.0
  'choose_language' => 'Zgjidhni gjuhën tuaj', //cpg1.3.0
);

$lang_theme_selection = array(
  'reset_theme' => 'Tema e albumit', //cpg1.3.0
  'choose_theme' => 'Zgjidhni nje teme', //cpg1.3.0
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
        'Exclamation' => 'Habi',
        'Question' => 'Pyetje',
        'Very Happy' => 'Shumë i gëzuar',
        'Smile' => 'Buzëqeshje',
        'Sad' => 'Trishtim',
        'Surprised' => 'Surprizë',
        'Shocked' => 'I tronditur',
        'Confused' => 'Konfuz',
        'Cool' => 'I qetë',
        'Laughing' => 'I qeshur',
        'Mad' => 'Sëmurë',
        'Razz' => 'Ngacmoj',
        'Embarassed' => 'I shqetësuar',
        'Crying or Very sad' => 'Duke qarë ose shumë i trishtuar',
        'Evil or Very Mad' => 'Djallëzor ose shumë i zemëruar',
        'Twisted Evil' => 'Sadist',
        'Rolling Eyes' => 'Sy rrotullues',
        'Wink' => 'Shkel syrin',
        'Idea' => 'Ide',
        'Arrow' => 'Shigjetë',
        'Neutral' => 'Asnjëanës',
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
        0 => 'Shkëpudje nga modë admin...',
        1 => 'Hyrje në modë admin...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
        'alb_need_name' => 'Albumet duhet të kenë një emër !',
        'confirm_modifs' => 'Jeni i sigurt që doni të bëni këto modifikime ?',
        'no_change' => 'Ju nuk bëtë ndonjë ndryshim !',
        'new_album' => 'Album i ri',
        'confirm_delete1' => 'Jeni i sigurt që ju doni ta fshini këtë album ?',
        'confirm_delete2' => '\nGjithë fotografitë dhe komentet që përmban do humbasin !',
        'select_first' => 'Së pari duhet të zgjidhni një album',
        'alb_mrg' => 'Album Manager',
        'my_gallery' => '* Galeria ime *',
        'no_category' => '* Nuk ka kategori *',
        'delete' => 'Fshi',
        'new' => 'E re',
        'apply_modifs' => 'Zbato ndryshimet',
        'select_category' => 'Zgjidh kategorinë',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
        'miss_param' => 'Parameters required for \'%s\'operation not supplied !',
        'unknown_cat' => 'Kategoria e zgjedhur nuk ekziston në bazën e të dhënave',
        'usergal_cat_ro' => 'Kategoria e përdoruesve nuk mund të fshihet !',
        'manage_cat' => 'Mirëmbaj kategoritë',
        'confirm_delete' => 'Jeni i sigurtë që doni të fshini këtë kategori',
        'category' => 'Kategori',
        'operations' => 'Veprime',
        'move_into' => 'Zhvendos tek',
        'update_create' => 'Përditësim/Krijim kategorie',
        'parent_cat' => 'Kategoria rrënjë',
        'cat_title' => 'Titulli i kategorisë',
                'cat_thumb' => 'Kategori e tablove', //cpg1.3.0
        'cat_desc' => 'Përshkrimi i kategorisë'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
        'title' => 'Konfigurimi',
        'restore_cfg' => 'Rikthe konfigurimin origjinal',
        'save_cfg' => 'Ruaj një konfigurim të ri',
        'notes' => 'Shënime',
        'info' => 'Informacion',
        'upd_success' => 'Konfigurimi Coppermine u përditësua',
        'restore_success' => 'Konfigurimi Coppermine origjinal u rikthye',
        'name_a' => 'Emra në ngjitje',
        'name_d' => 'Emra në zbritje',
        'title_a' => 'Titujt në ngjitje',
        'title_d' => 'Titujt në zbritje',
        'date_a' => 'Data në ngjitje',
        'date_d' => 'Data në zbritje',
        'th_any' => 'Maksimumi i dukshëm',
        'th_ht' => 'Lartësia',
        'th_wd' => 'Gjerësia',
                'label' => 'emërtim', //cpg1.3.0
        'item' => 'listë', //cpg1.3.0
        'debug_everyone' => 'të gjithë', //cpg1.3.0
        'debug_admin' => 'Vetëm Administratorët', //cpg1.3.0
        );


if (defined('CONFIG_PHP')) $lang_config_data = array(
        'Parametra të përgjithëshme',
        array('Emri i galerisë', 'gallery_name', 0),
        array('Përshkrimi i galerisë', 'gallery_description', 0),
        array('E-maili i administratorit të galerisë', 'gallery_admin_email', 0),
        array('Adresa tek e cila lidhja \'Shikoni edhe më shumë foto\' tek e-karta', 'ecards_more_pic_target', 0),
        array('Galleria është jashtë linje', 'offline', 1), //cpg1.3.0
        array('Log ecards', 'log_ecards', 1), //cpg1.3.0
        array('Lejo ZIP-shkarkimin e favoriteve', 'enable_zipdownload', 1), //cpg1.3.0
                'Language, Themes &amp; Charset settings',
        array('Gjuha', 'lang', 5),
        array('Tema', 'theme', 6),
        array('Shfaq listën e gjuhëve', 'language_list', 1), //cpg1.3.0
        array('Shfaq flamurin e gjuhëve', 'language_flags', 8), //cpg1.3.0
        array('Shfaq &quot;anullo&quot; tek perzgjedhja e gjuhëve', 'language_reset', 1), //cpg1.3.0
        array('Shfaq listën e temave', 'theme_list', 1), //cpg1.3.0
        array('Shfaq &quot;anullo&quot; tek perzgjedhja e temave', 'theme_reset', 1), //cpg1.3.0
        array('Shfaq FAQ', 'display_faq', 1), //cpg1.3.0
        array('Shfaq ndihmë bbcode', 'show_bbcode_help', 1), //cpg1.3.0
        array('Kodimi i gërmave', 'charset', 4), //cpg1.3.0

        'Album list view',
        array('Madhësia e tablos kryesore (piksel ose %)', 'main_table_width', 0),
        array('Numri i niveleve apo kategorive që duhet të shfaqen', 'subcat_level', 0),
        array('Numri i albume për tu shfaqur', 'albums_per_page', 0),
        array('Numri i kolonave për listën e albumeve', 'album_list_cols', 0),
        array('Madhësia e tablove në piksel', 'alb_list_thumb_size', 0),
        array('Përmbajtja e faqes kryesore', 'main_page_layout', 0),
        array('Shfaqja e tablove të albumit të nivelit të parë me kategoritë','first_level',1),

        'Thumbnail view',
        array('Numri i kolonave ne faqen e tablove', 'thumbcols', 0),
        array('Numri rreshtave ne faqen e tablove', 'thumbrows', 0),
        array('Maksimumi i tablove për tu shfaqur', 'max_tabs', 10), //cpg1.3.0
        array('Shfaqni legjendën e fotografisë (përveç titullit)poshtë tablosë', 'caption_in_thumbview', 1), //cpg1.3.0
        array('Shfaqni numrin e shikimeve poshtë tablos', 'views_in_thumbview', 1), //cpg1.3.0
        array('Shfaqni numrin e komenteve poshtë tablos', 'display_comment_count', 1),
        array('Shfaqni emrin e ngarkimit poshtë tablos', 'display_uploader', 1), //cpg1.3.0
        array('Vendosje rastësore e fotografive', 'default_sort_order', 3), //cpg1.3.0
        array('Minimumi i numrit të votave pë një foto për tu shfaqur tek lista e\'më të vlerësuarave\'', 'min_votes_for_rating', 0), //cpg1.3.0

                'Image view &amp; Comment settings',
        array('Gjerësia e tabelës ku do të shfaqet fotografia (në piksel apo %)', 'picture_table_width', 0),
        array('Informacioni i fotografisë është i dukshëm me instalimin', 'display_pic_info', 1),
        array('Filtroni fjalët e këqia në komente', 'filter_bad_words', 1),
                array('Lejoni buzëqeshjet në komente', 'enable_smilies', 1),
                array('Lejo komente të njëpasnjëshme tek e njëjta fotografi nga i njëjti përdorues(disable flood protection)', 'disable_comment_flood_protect', 1), //cpg1.3.0
        array('Maksimumi i gjatësisë së përshkrimit të fotografisë', 'max_img_desc_length', 0),
        array('Maksimumi i gërmave në një fjalë', 'max_com_wlength', 0),
        array('Maksimumi i linjave të një komenti', 'max_com_lines', 0),
        array('Maksimumi i gjatësisë së një komenti', 'max_com_size', 0),
        array('Shfaqni negativin e filmit', 'display_film_strip', 1),
        array('Numri i pozave tek negativi', 'max_film_strip_items', 0),
                array('Njofto admin për komentet nëpërmjet e-mail', 'email_comment_notification', 1), //cpg1.3.0
        array('intervali i slideshow në milisekonda(1 second = 1000 milliseconds)', 'slideshow_interval', 0), //cpg1.3.0


        'Pictures and thumbnails settings',
        array('Cilësia për skedarët JPEG', 'jpeg_qual', 0),
        array('Përmasat maksimale të një tabloje <a href="#notice2" class="clickable_option">**</a>', 'thumb_width', 0), //cpg1.3.0
        array('Përdor përmasat ( gjerësi ose lartësi ose përmasat  maksimale për tablotë )<b>**</b>', 'thumb_use', 7),
        array('Krijoni fotografi ndërmjetëse','make_intermediate',1),
        array('Maksimumi i gjerësisë dhe lartësisë së një fotografie/video ndërmjetëse  <a href="#notice2" class="clickable_option">**</a>', 'picture_width', 0), //cpg1.3.0
        array('Maksimumi i skedarëve për tu ngarkuar (KB)', 'max_upl_size', 0), //cpg1.3.0
        array('Maksimumi i gjerësisë dhe lartësisë së fotove/videove për tu ngarkuar (piksels)', 'max_upl_width_height', 0), //cpg1.3.0

                'Files and thumbnails advanced settings', //cpg1.3.0
        array('Shfaq ikonat e albumeve private përdoruesve të paidentifikuar','show_private',1), //cpg1.3.0
        array('Karaktere/gërma të ndaluara në një emërtim skedari', 'forbiden_fname_char',0), //cpg1.3.0
        //array('Ekstensionet e lejuara për ngarkimin e fotografive', 'allowed_file_extensions',0), //cpg1.3.0
        array('Tip fotografish i lejuar', 'allowed_img_types',0), //cpg1.3.0
        array('Tip filmi i lejuar', 'allowed_mov_types',0), //cpg1.3.0
        array('Tip audio i lejuar', 'allowed_snd_types',0), //cpg1.3.0
        array('Tip dokumenti i lejuar', 'allowed_doc_types',0), //cpg1.3.0
        array('Metodë për ridimensionimin e fotografisë','thumb_method',2), //cpg1.3.0
        array('Rruga për tek programi ImageMagick \'convert\'  (shembull /usr/bin/X11/)', 'impath', 0), //cpg1.3.0
        //array('Tip imazhi i lejuar(i vlefshëm vetëm për ImageMagick)', 'allowed_img_types',0), //cpg1.3.0
        array('Linja komandash për ImageMagick', 'im_options', 0), //cpg1.3.0
        array('lexo formatet EXIF tek skedaret et formatit JPEG', 'read_exif_data', 1), //cpg1.3.0
        array('lexo formatet IPTC tek skedaret et formatit JPEG', 'read_iptc_data', 1), //cpg1.3.0
        array('Repertori i albumeve <a href="#notice1" class="clickable_option">*</a>', 'fullpath', 0), //cpg1.3.0
        array('Repertori për albumet e përdoruesve <a href="#notice1" class="clickable_option">*</a>', 'userpics', 0), //cpg1.3.0
        array('Prefiksi për fotografitë ndërmjetëse <a href="#notice1" class="clickable_option">*</a>', 'normal_pfx', 0), //cpg1.3.0
                  array('Prefiksi për tablotë <a href="#notice1" class="clickable_option">*</a>', 'thumb_pfx', 0), //cpg1.3.0
                  array('Modeli i repertuarve sipas instalimit', 'default_dir_mode', 0), //cpg1.3.0
                  array('Modeli i skedarëve sipas instalimit', 'default_file_mode', 0), //cpg1.3.0


        'User settings',
                  array('Lejo regjistrimin e përdoruesve të rinjë', 'allow_user_registration', 1),
                  array('Regjistrimi i përdoruesve nëpërmjet verifikim të e-mail', 'reg_requires_valid_email', 1),
                  array('Njoftim i admin për regjistrim përdoruesish nëpërmjet e-mail', 'reg_notify_admin_email', 1), //cpg1.3.0
                  array('Lejo dy përdorues të kenë të njëjtën adresë elektronike', 'allow_duplicate_emails_addr', 1),
                  array('Përdoruesit mund të kenë albume private(Kini parasysh: Nëse ndryshoni nga \'po\' në \'jo\' të gjithë albumet private bëhen publike)', 'allow_private_albums', 1), //cpg1.3.0
                  array('Njofto admin nëse ngarkime përdoruesish presin për miratim', 'upl_notify_admin_email', 1), //cpg1.3.0
                  array('Lejo përdoruesit e identifikuar të shikojnë listën e anëtarëve', 'allow_memberlist', 1), //cpg1.3.0

        'Custom fields for image description (leave blank if unused)',
        array('Emri i fushës 1', 'user_field1_name', 0),
        array('Emri i fushës 2', 'user_field2_name', 0),
        array('Emri i fushës 3', 'user_field3_name', 0),
        array('Emri i fushës 4', 'user_field4_name', 0),

        'Cookies &amp; Charset settings',
        array('Emri i cookie që përdor skripti', 'cookie_name', 0),
        array('Rruga e cookit që përdor skripti', 'cookie_path', 0),
        array('Kodimi i gërmave', 'charset', 4),

        'Miscellaneous settings',
                  array('Aktivizo modelin debug', 'debug_mode', 9), //cpg1.3.0
                  array('Shfaq njoftimet në modelin debug', 'debug_notice', 1), //cpg1.3.0

  '<br /><div align="left"><a name="notice1"></a>(*) Nuk duhet ti ndryshoni këto preferenca nëse keni materiale në bazën e të dhënave.<br />
  <a name="notice2"></a>(**) Kur ndryshoni këtë preferencë, vëtëm fotot e futura pas këtij këtij momenti preken nga ky ndryshim, pra është e këshillueshme të mos ndryshohet kjo preferencë nëse ju keni tashmë materiale në galeri. Sidoqoftë, ju mund ti aplikoni ndryshimet në dokumentat ekzistues nëpërmjet &quot;<a href="util.php">mjeteve që dispononi si admin</a> (resize pictures)&quot; në menun admin.</div><br />', //cpg1.3.0
);
// ------------------------------------------------------------------------- //
// File db_ecard.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('DB_ECARD_PHP')) $lang_db_ecard_php = array(
  'title' => 'Dërgo kartolina elektronike', //cpg1.3.0
  'ecard_sender' => 'Dërguesi', //cpg1.3.0
  'ecard_recipient' => 'Marrësi', //cpg1.3.0
  'ecard_date' => 'Datë', //cpg1.3.0
  'ecard_display' => 'Shfaq kartolinën', //cpg1.3.0
  'ecard_name' => 'Emri', //cpg1.3.0
  'ecard_email' => 'Emaili', //cpg1.3.0
  'ecard_ip' => 'IP #', //cpg1.3.0
  'ecard_ascending' => 'Duke u ngjitur', //cpg1.3.0
  'ecard_descending' => 'Duke zbritur', //cpg1.3.0
  'ecard_sorted' => 'Shpërndarë', //cpg1.3.0
  'ecard_by_date' => 'sipas datës', //cpg1.3.0
  'ecard_by_sender_name' => 'Sipas emrit të dërguesit', //cpg1.3.0
  'ecard_by_sender_email' => 'sipas emailit të dërguesit', //cpg1.3.0
  'ecard_by_sender_ip' => 'Sipas IP së dërguesit', //cpg1.3.0
  'ecard_by_recipient_name' => 'sipas emrit të marrësit', //cpg1.3.0
  'ecard_by_recipient_email' => 'sipas emailit të marrsit', //cpg1.3.0
  'ecard_number' => 'Shfaq regjistrimet %s deri në %s nga %s', //cpg1.3.0
  'ecard_goto_page' => 'shko tek faqja', //cpg1.3.0
  'ecard_records_per_page' => 'Regjistrime në faqe', //cpg1.3.0
  'check_all' => 'zgjidhi të gjitha', //cpg1.3.0
  'uncheck_all' => 'Anulloi të gjitha', //cpg1.3.0
  'ecards_delete_selected' => 'Fshi kartolinat e përzgjedhura', //cpg1.3.0
  'ecards_delete_confirm' => 'Jeni i sigurt që ju dëshironi ti fshini këto regjistrime ? Shënoni tek kutija e përzgjedhjes!', //cpg1.3.0
  'ecards_delete_sure' => 'Jam i sigurt', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
  'empty_name_or_com' => 'Ju duhet të shkruani emrin tuaj dhe një koment',
  'com_added' => 'Komenti juaj u regjistrua',
  'alb_need_title' => 'Ju duhet ti vini  një titull albumit !',
  'no_udp_needed' => 'Përditësimi është i panevojshëm.',
  'alb_updated' => 'Albumi u përditësua',
  'unknown_album' => 'Albumi i zgjedhur nuk ekziston ose juve nuk u lejohet të ngarkoni në të',
  'no_pic_uploaded' => 'Asnjë dokument nuk u ngarkua !<br /><br />Nëse ju keni zgjedhur një dokument për ta ngarkuar, verifiko nëse serverilejon ngarkimin e dokumentave...', //cpg1.3.0
  'err_mkdir' => 'E pamundur të krijohet repertori %s !',
  'dest_dir_ro' => 'Destinacioni i repertorit %s nuk është i shkrueshëm në skript !',
  'err_move' => 'E pamundur të lëvizet nga %s nga %s !',
  'err_fsize_too_large' => 'Madhësia e dokumentit që ju keni ngarkuar është shumë e madhe (maksimumi i lejuar është %s x %s) !', //cpg1.3.0
  'err_imgsize_too_large' => 'Madhësia e dokumentit që ju keni ngarkuar është shumë e madhe (maksimumi i lejuar është %s KB) !',
  'err_invalid_img' => 'Dokumenti që ju ngarkuat nuk ëshë një format i vlefshëm !',
  'allowed_img_types' => 'Ju mundeni  të ngarkoni vetëm  %s imazhe.',
  'err_insert_pic' => 'Dokumenti  \'%s\' nuk mund të futet në album ', //cpg1.3.0
  'upload_success' => 'Dokumenti juaj u ngarkua me sukses.<br /><br />Ai do të mundet të shihet vetëm pasi të aprovohet nga administratori.', //cpg1.3.0
  'notify_admin_email_subject' => '%s - Njoftim i ngarkimit', //cpg1.3.0
  'notify_admin_email_body' => 'Një fotografi është nga  %s e kërkon aprovimin tuaj. Vizitoni %s', //cpg1.3.0
  'info' => 'Informacion',
  'com_added' => 'Koment i shtuar',
  'alb_updated' => 'Album i përditësuar',
  'err_comment_empty' => 'Komenti juaj është bosh !',
  'err_invalid_fext' => 'Vetëm dokumentat që kanë ektensionet që vijojnë janë të lejuara : <br /><br />%s.',
  'no_flood' => 'Na vjenë keq por ju jeni tashme autori i komentit të fundit për këtë dokument.<br /><br />Editoni komentin që keni postuar nëse dëshironi ta modofikoni', //cpg1.3.0
  'redirect_msg' => 'Ju jeni duke u riorientuar.<br /><br /><br />Klikoni \'VAZHDONI\' nëse faqja nuk rifreskohet automatikisht ',
  'upl_success' => 'Dokumenti juaj u shtua me sukses', //cpg1.3.0
  'email_comment_subject' => 'Kement i postuar tek Coppermine Photo Gallery', //cpg1.3.0
  'email_comment_body' => 'Dikush ka postuar nje koment tek galleria juaj. Shikoje këtu', //cpg1.3.0
);
// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
        'caption' => 'Legjenda',
        'fs_pic' => 'Imazh me përnasat reale',
        'del_success' => 'I fshirë me sukses',
        'ns_pic' => 'Imazh me permasa normale',
        'err_del' => 'Nuk mund të fshihet',
        'thumb_pic' => 'tablo',
        'comment' => 'koment',
        'im_in_alb' => 'imazh në album',
        'alb_del_success' => 'Albumi \'%s\' u fshi',
        'alb_mgr' => ' Manazheri Album',
        'err_invalid_data' => 'Të dhëna jo te vlefshme të marra në \'%s\'',
        'create_alb' => 'Dukee krijuar albumin \'%s\'',
        'update_alb' => 'Duke përditësuar albumin \'%s\' me titull \'%s\' dhe indeks \'%s\'',
        'del_pic' => 'Fshi fotografinë',
        'del_alb' => 'Fshi albumin',
        'del_user' => 'Fshi përdorues',
        'err_unknown_user' => 'Përdoruesi i zgjedhur nuk ekziston !',
        'comment_deleted' => 'Komenti u fshi me sukses',
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
  'confirm_del' => 'Jeni i sigurtë që dëshironi të FSHINI këtë dokument ? \\nKomentet do të fshihen gjithashtu.', //js-alert //cpg1.3.0
  'del_pic' => 'FSHIJENI KËTË DOKUMENT', //cpg1.3.0
  'size' => '%s x %s piksele',
  'views' => '%s herë',
  'slideshow' => 'Slideshow',
  'stop_slideshow' => 'NDALO SLIDESHOW',
  'view_fs' => 'Kliko për të parë imezhin me permasa të plota',
  'edit_pic' => 'Editoni përshkrimin', //cpg1.3.0
  'crop_pic' => 'Retushoje', //cpg1.3.0
);
$lang_picinfo = array(
  'title' =>'Informacioni i dokumentit', //cpg1.3.0
  'Filename' => 'Emri i dokumentit',
  'Album name' => 'Emri i albumit',
  'Rating' => 'Vlerësimi (%s vota)',
  'Keywords' => 'Fjalë-kyç',
  'File Size' => 'Madhësia e dokumentit',
  'Dimensions' => 'Përmasat',
  'Displayed' => 'Displayed',
  'Camera' => 'Aparat fotografik',
  'Date taken' => 'Data e fotografimit',
  'ISO'=>'ISO',
  'Aperture' => 'Hapje',
  'Exposure time' => 'Koha e ekspozimit',
  'Focal length' => 'Focal length',
  'Comment' => 'Koment',
  'addFav'=>'Shtoje tek favoritet', //cpg1.3.0
  'addFavPhrase'=>'Favorite', //cpg1.3.0
  'remFav'=>'Hiqe nga Favoritet', //cpg1.3.0
  'iptcTitle'=>'Titulli IPTC', //cpg1.3.0
  'iptcCopyright'=>' Copyright IPTC', //cpg1.3.0
  'iptcKeywords'=>'Fjalë-kuç IPTC', //cpg1.3.0
  'iptcCategory'=>'Kategori IPTC', //cpg1.3.0
  'iptcSubCategories'=>'Nën kategori IPTC ', //cpg1.3.0
);

$lang_display_comments = array(
        'OK' => 'OK',
        'edit_title' => 'Edito këtë koment',
        'confirm_delete' => 'Jeni i sigurt që ju dëshironi të fshini këtë koment ?',
        'add_your_comment' => 'Shtoni komentin tuaj',
        'name'=>'Emri',
        'comment'=>'Koment',
        'your_name' => 'Anonim',
);

$lang_fullsize_popup = array(
        'click_to_close' => 'Klikoni tek imazhi për të mbyllur këtë dritare',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
        'title' => 'Dërgo një kartë elektronike',
        'invalid_email' => '<b>Kujdes</b> : Adresa e-mail e pavlefshme !',
        'ecard_title' => 'Një kartë elektronike nga %s për ju',
                'error_not_image' => 'Vetëm imazhet mund të nisen si kartolina elektronike.', //cpg1.3.0
        'view_ecard' => 'Nëse karta elektronike nuk afishohet korrektësisht, Klikoni këtë lidhje',
        'view_more_pics' => 'Klikoni këtë lidhje për të parë fotografi të tjera !',
        'send_success' => 'Karta juaj elektronike u dërgua',
        'send_failed' => 'Na vjenë keq por serveri nuk mundet ta dërgoj kartën tuaj elektronike...',
        'from' => 'Nga',
        'your_name' => 'Emri juaj',
        'your_email' => 'E-maili juaj',
        'to' => 'Për',
        'rcpt_name' => 'Emri i marrësit',
        'rcpt_email' => 'Adresa e-mail e marrësit',
        'greetings' => 'Urimet',
        'message' => 'Mesazh',
);
// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
  'pic_info' => 'Informacion i fotografisë', //cpg1.3.0
  'album' => 'Albumi',
  'title' => 'Titulli',
  'desc' => 'Përshkrimi',
  'keywords' => 'Fjalë-kyç',
  'pic_info_str' => '%s &herë; %s - %s KB - %s shikime - %s vota',
  'approve' => 'Aprovoni dokumentin', //cpg1.3.0
  'postpone_app' => 'Aprovojeni me mbrapa',
  'del_pic' => 'Fshijeni dokumentin', //cpg1.3.0
  'read_exif' => 'Rilexo informacionin EXIF përsëri', //cpg1.3.0
  'reset_view_count' => 'Rivendos numëruesin e shkarkimeve në zero',
  'reset_votes' => 'Rivendos numëruesin e votave në zero',
  'del_comm' => 'Fshi komentet',
  'upl_approval' => 'Autorizimi i "Upload"',
  'edit_pics' => 'Editoni dokumentin', //cpg1.3.0
  'see_next' => 'Shiko dokumentin pasardhës', //cpg1.3.0
  'see_prev' => 'Shiko dokumentin pasardhës', //cpg1.3.0
  'n_pic' => '%s dokumenta', //cpg1.3.0
  'n_of_pic_to_disp' => 'Numri i dokumentave për tu shfaqur', //cpg1.3.0
  'apply' => 'Apliko ndryshimet', //cpg1.3.0
  'crop_title' => 'Editori i fotove Coppermine ', //cpg1.3.0
  'preview' => 'Parashikoje', //cpg1.3.0
  'save' => 'Ruaje fotografinë', //cpg1.3.0
  'save_thumb' =>'Ruaje si tablo', //cpg1.3.0
  'sel_on_img' =>'Zona e përzgjedhur duhet të jetë e gjitha brenda imazhit!', //js-alert //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File faq.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FAQ_PHP')) $lang_faq_php = array(
  'faq' => 'Pyetjet e bëra më shpesh', //cpg1.3.0
  'toc' => 'Tabela e përmbajtjes', //cpg1.3.0
  'question' => 'Pyetje: ', //cpg1.3.0
  'answer' => 'Përgjigje: ', //cpg1.3.0
);

if (defined('FAQ_PHP')) $lang_faq_data = array(
  'FAQ të përgjithëshme', //cpg1.3.0
  array('Pse duhet të regjistrohem?', 'Registrimi mund të kërkohet ose jo, varësisht nga administratori. Registrimi u jep anëtarëve avantazhe përparësi shtesë si ngarkimi, të paturit e një liste favoritesh, mundësia për të vlerësuar fotografitë, postimi i komenteve etj.', 'allow_user_registration', '1'), //cpg1.3.0
  array('Si të regjistrohem?', 'Shko tek &quot;Registrohu&quot; dhe plotëso fushat e detyrueshme (dhe fushat në obsion nëse dëshironi).<br />Nëse Administratori ka kërkon aktivizimin e llogarisë me anë të e-mailit, atëherë pasi të fusni informacionin e kërkuar në formular, ju duhet të merrni një masazh në adresën e-mail që keni regjistruar ku u jepen instruksionet se si të aktivizoni llogarinë tuaj. Ju duhet të aktivizoni llogarinë tuaj me qëllim që të mundeni të identifikoheni.', 'allow_user_registration', '1'), //cpg1.3.0
  array('Si mund të identifikohem?', 'Go to &quot;Identifikohu&quot;, fut emrin e përdoruesit dhe fjalë-kalimin dhe kliko tek &quot;më Më mbaj mend&quot; dhe kështu ju nuk kini nevoj të identifikoheni përsëri kur riktheheni tek albumi.<br /><b>KUJDES:Cookit duhet të jetë i aktivizuar dhe cookit e këtij web siti nuk duhet të fshihen me qëllim që  &quot;Më mbaj mend &quot; të funksionoj.</b>', 'offline', 0), //cpg1.3.0
  array('Pse nuk mundem të identifikohem ?', 'Keni klikuar ju tek lidhja që u është dërguar me anë të e-mailit?. Ajo lidhje aktivizon llogarinë tuaj. Për probleme të tjera identifikimi kontaktoni administratorin e sitit.', 'offline', 0), //cpg1.3.0
  array('Çfarë ndodh nëse harroj fjalë-kalimin?', 'Nëse kjo faqe ka një lidhje &quot;Harrim i fjalë-kalimit&quot; kliko aty. Për më tepër kontakto administratorin e faqes për një fjalë-kalin të ri.', 'offline', 0), //cpg1.3.0
  //array('Çfarë ndodh nëse ndërroj adresën e-mail?', 'Thjesht identifikohu dhe ndërro adresën e-mail tek &quot;Profili im&quot;', 'offline', 0), //cpg1.3.0
  array('Si mund të ruaj një foto tek &quot;Favoritet e mia&quot;?', 'Kliko tek fotografia dhe pastaj kliko tek lidhja &quot;info e fotografisë&quot; (<img src="images/info.gif" width="16" height="16" border="0" alt="Picture information" />); lëviz nëpër info e fotografisë dhe kliko tek &quot;Shto tek favoritet&quot;.<br />Administratori mund ta ketë lënë të aktivisuar paraprakisht &quot;foto informacion&quot; .<br />KUJDES:Cookit duhet të jenë të aktivizuara dhe cookit e kësaj faqeje nuk duhet të fshihen.', 'offline', 0), //cpg1.3.0
  array('Si mund të vlerësoj një foto?', 'Kliko në një tablo dhe shko në fund e zgjidh një vlerësim.', 'offline', 0), //cpg1.3.0
  array('Si mund të postoj një koment për një fotografi?', 'Kliko në një tablo dhe shko në fund e shto një koment.', 'offline', 0), //cpg1.3.0
  array('Si mund të ngarkoj një foto?', 'Shko tek &quot;Ngarko foto &quot;dhe zgjidh albumin ku dëshiron të shtosh foton, kliko &quot;Browse&quot; dhe gjej foton që dëshiron të ngarkosh dhe klik  &quot;open&quot; (shto një titull dhe përshkrim  nëse dëshiron) dhe kliko &quot;VAZHDIM&quot;', 'allow_private_albums', 0), //cpg1.3.0
  array('Ku mund ta mgarkoj një fotografi?', 'Ju do të jeni në gjendje të ngarkoni një fotografi tek një nga albumet e &quot;Galleria ime&quot;. Administratori mund tu lejoj ju të ngarkoni në një ose në disa albume të Galerisë Kryesore .', 'allow_private_albums', 0), //cpg1.3.0
  array('Çfarë typi dhe çfarë madhësie fotografish mund të ngarkoj?', 'Madhësia dhe tipi i fotografisë (jpg, png, etc.) varet nga administratori.', 'offline', 0), //cpg1.3.0
  array('Çfarë është &quot;Galeria ime&quot;?', '&quot;Galleria ime&quot; është një galleri personale që përdoruesi mund të ngarkoj fotografi në të dhe ta mirëmbaj.', 'allow_private_albums', 0), //cpg1.3.0
  array('Si mund të krijoj, riemërtoj apo fshij një album tek "Galeria ime" ?', 'Ju duhet të jeni në "modë-admin";<br />Shko tek  &quot;Krijo / Rendit Albumet e mia&quot; dhe kliko tek &quot;i ri&quot;. Ndrysho &quot;Album i ri &quot; me emrin që ju dëshironi.<br />Ju gjithashtu mund të riemërtoni çdo album të galerisë suaj.<br />Kliko tek &quot;Zbato ndryshimet&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('Si mund të modifikoj dhe ndaloj përdoruesit të shikojnë albumet e mia?', 'Ju duhet të jeni në "modë-admin"<br />Shko tek &quot;Modifiko Albums. On the &quot;Update Album&quot; bar, select the album that you want to modify.<br />Here, you can change the name, description, thumbnail picture, restrict viewing and comment/rating permissions.<br />Click &quot;Update Album&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('Si mund të shikoj përdoruesit e tjerë të albumit?', 'Shko tek "Lista e Albumeve" dhe zgjidh "Përdoruesit e Albumit".', 'allow_private_albums', 0), //cpg1.3.0
  array('Çfarë janë cookies?', 'Cookies janë të dhëna në formë teksti që dërgohen nga serveri i një web siti në kompiuterin tuaj.<br />Cookies në përgjithësi lejojnë një përdorues që të lënë dhe rikthehen në web site pa patur nevojë të identifikohen përsëri.', 'offline', 0), //cpg1.3.0
  array('Ku mund ta gjej këtë program për web faqen time?', 'Coppermine është një Album Multimedia falas i shpërndar sipas  GNU GPL. Ky program ka shumë përparësi dhe është i përshtatshëm për shumë platforma. Vizitoni  <a href="http://coppermine.sf.net/">faqen kryesore të Coppermine</a> për të mësuar më shumë apo dhe për ta shkarkuar atë.', 'offline', 0), //cpg1.3.0

  'Vozitja në web site', //cpg1.3.0
  array('Çfarë është "Lista e Albumeve" ?', 'Kjo tregon gjithë kategorinë në cilën ju ndodheni me lidhjet drejt çdo albumi. Nëse ju nuk ndodheni në një galeri, kjo tregon galeinë komplet me lidhje për  çdo kategori.  Tablotë mund të jenë një lidhje drejt>e kategorive.', 'offline', 0), //cpg1.3.0
  array('Çfarë është "Galeria ime" ?', 'Ky funksion i jep mundësi përdoruesit të krijoi galerinë e vetë duke i dhënë mundësinë të shtoj, fshij apo modifikojë albume ashti sikurse mund të ngarkoj në to.', 'allow_private_albums', 0), //cpg1.3.0
  array('Cila është diferenca midis "Modë Admin" dhe "Modë Përdorues"?', 'Sipas kësaj karakteristike, në "Mode-Admin" e lejon përdoruesin të modifikoj albumet e vehta (por dhe të të tjerëve nëse administratori ia beson një gjë të tillë). ', 'allow_private_albums', 0), //cpg1.3.0
  array('Çfarë është "Ngarkim fotografish"?', 'Ky funksion lejon një përdorues të ngarkoj një dokument (madhësia dhe tipi përcaktohet nga administratori) tek një galery e zgjedhur nga ju apo nga administratori.', 'allow_private_albums', 0), //cpg1.3.0
  array('Çfarë është "Ngarkimet më të fundit"?', 'Ky funksion shfaq ngarkimet më të fundit në galeri.', 'offline', 0), //cpg1.3.0
  array('Çfarë është "Komentet e fundit"?', 'Ky funksion tregon komentet më të fundit të bëra nga përdoruesit.', 'offline', 0), //cpg1.3.0
  array('Çfarë është "Më të shikuarat"?', 'Ky funksion tregonë fotografitë më të shikuara nga përdoruesit (të regjistruar ose jo).', 'offline', 0), //cpg1.3.0
  array('Çfarë është " Më të vleresuarat"?', 'Ky funksion tregon fotografitë më të vlerësuara nga përdoruesit, duke treguar vlerësimin mesatar (p.sh: nëse 5 përdorues vlerësojnë një foto me 3 pikë çdonjëri <img src="images/rating3.gif" width="65" height="14" border="0" alt="" />: fotografia do të ketë mesataren 3 <img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> ; Nëse 5 përdorues vlerësojnë një foto nga 1 në 5 (1,2,3,4,5) rezultati do të jetë gjithashtu 3 <img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> .)<br />Vlerësimet shkajnë nga <img src="images/rating5.gif" width="65" height="14" border="0" alt="best" /> (madhështore) në <img src="images/rating0.gif" width="65" height="14" border="0" alt="worst" /> (shumë keq).', 'offline', 0), //cpg1.3.0
  array('Çfarë është "Favoritet e mia"?', 'Ky funksion ju lejon juve të vendosi një apo disa fotografi tek cookiet që ndodhen në kompiuterin tuaj.', 'offline', 0), //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File forgot_passwd.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FORGOT_PASSWD_PHP')) $lang_forgot_passwd_php = array(
  'forgot_passwd' => 'Kujtesë fjalë-kalimi', //cpg1.3.0
  'err_already_logged_in' => 'Ju jeni tashmë i identifikuar !', //cpg1.3.0
  'enter_username_email' => 'Fusni emrin e përdoruesit ose adresën e-mail', //cpg1.3.0
  'submit' => 'EC', //cpg1.3.0
  'failed_sending_email' => 'M-maili me kujtesën e fjalëkalimit nuk mundi të niset !', //cpg1.3.0
  'email_sent' => 'Një e-mail me emrin e përdoruesit dhe fjalë-kalimin u nis në adresën %s', //cpg1.3.0
  'err_unk_user' => 'Përdoruesi i zgjedhur nuk ekziston!', //cpg1.3.0
  'passwd_reminder_subject' => '%s - Kujtesë fjalë-kalimi', //cpg1.3.0
  'passwd_reminder_body' => 'Ju keni kërkuar tu rikujtohen të dhënat identifikuese për:
Emri i përdoruesit: %s
Fjalë-kalimi: %s
Klikoni %s për tu identifikuar.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
  'group_name' => 'Emri i grupit',
  'disk_quota' => 'Kuota e diskut',
  'can_rate' => 'Mund të vlerësoni dokumentat', //cpg1.3.0
  'can_send_ecards' => 'Mund të dërgoni kartolina elektronike',
  'can_post_com' => 'Mund të postoni komente',
  'can_upload' => 'Mund të ngarkoni dokumenta', //cpg1.3.0
  'can_have_gallery' => 'Mund të keni një galeri personale',
  'apply' => 'Zbato ndryshimet',
  'create_new_group' => 'Krijo një grup të ri',
  'del_groups' => 'Fshijeni grupin që zgjodhët',
  'confirm_del' => 'Kujdes, kur ju fshini një grup, përdoruesit e këtij grupi do të transferohen tek grupet e perdoruesve \'të regjistruer\' group !\n\nDëshironi të vazhdoni?', //js-alert //cpg1.3.0
  'title' => 'Administrim i grupeve të përdoruesve',
  'approval_1' => 'Aprovim i ngarkimeve publike (1)',
  'approval_2' => 'Aprovim Ngarkimeve private (2)',
  'upload_form_config' => 'Konfigurimi i formularit të ngarkimeve', //cpg1.3.0
  'upload_form_config_values' => array( 'Ngarkim i një vetëm një dokumenti', 'Ngarkim i vetëm shumë dokumentave', 'Vetëm ngarkimeURI', 'Vetëm dokumenta ZIP ', 'Dokumenta-URI', 'Dokumenta-ZIP', 'URI-ZIP', 'Dokumenta-URI-ZIP'), //cpg1.3.0
  'custom_user_upload'=>'Përdoruesit mund të ndryshojnë numrine e kutive të ngarkimit?', //cpg1.3.0
  'num_file_upload'=>'Numri maximum/ekzakt i kutive të ngarkimit të dokumentave', //cpg1.3.0
  'num_URI_upload'=>'Numri i maximum/ekzakt i kutive ngarkuese URI ', //cpg1.3.0
  'note1' => '<b>(1)</b> Ngarkimet në një album publik kërkojnë aprovimin e administratorit',
  'note2' => '<b>(2)</b> Ngarkimet në një album që i takon përdoruesit kërkon aprovimin e administratorit',
  'notes' => 'Shënime',
);
// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
  'welcome' => 'Mirësevini !',
);

$lang_album_admin_menu = array(
  'confirm_delete' => 'Jeni i sigurt që ju dëshironi ta FSHINI këtë album ? \\nGjithë dokumentat dhe komentet do fshihen gjithashtu.', //js-alert //cpg1.3.0
  'delete' => 'FSHI',
  'modify' => 'VETITË',
  'edit_pics' => 'EDITO DOKUMENTIN', //cpg1.3.0
);

$lang_list_categories = array(
  'home' => 'Pritja',
  'stat1' => '<b>[pictures]</b> fotografi në <b>[albums]</b> albume dhe <b>[cat]</b> kategori me <b>[comments]</b> komente të shikuara <b>[views]</b> herë', //cpg1.3.0
  'stat2' => '<b>[pictures]</b> fotografi në <b>[albums]</b> albume të shikuara<b>[views]</b> herë', //cpg1.3.0
  'xx_s_gallery' => '%s\'s Galeri',
  'stat3' => '<b>[pictures]</b> fotografi në <b>[albums]</b> albume me <b>[comments]</b> komente të shikuara <b>[views]</b> herë', //cpg1.3.0
);

$lang_list_users = array(
  'user_list' => 'Lista e përdoruesve',
  'no_user_gal' => 'Nuk ka galeri të përdoruesve',
  'n_albums' => '%s album(e)',
  'n_pics' => '%s fotografi', //cpg1.3.0
);

$lang_list_albums = array(
  'n_pictures' => '%s fotografi', //cpg1.3.0
  'last_added' => ', e fundit shtuar më %s',
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
        'login' => 'Identifikim',
        'enter_login_pswd' => 'Fusni emrin e përdoruesit dhe fjalë-kalimin',
        'username' => 'Emri i përdoruesit',
        'password' => 'Fjalëkalimi',
        'remember_me' => 'Më mbaj mend',
        'welcome' => 'Mirëseerdhe %s ...',
        'err_login' => '*** Nuk mundët të identifikoheni. Provoni përsëri ***',
        'err_already_logged_in' => 'Ju jeni tashmë i identifikuar !',
                'forgot_password_link' => 'Kam harruar fjalë-kalimin tim !', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
        'logout' => 'Çidentifikim',
        'bye' => 'Mirë u pafshim %s ...',
        'err_not_loged_in' => 'Ju nuk jeni identifikuar !',
);
// ------------------------------------------------------------------------- //
// File phpinfo.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('PHPINFO_PHP')) $lang_phpinfo_php = array(
  'php_info' => 'PHP informacion', //cpg1.3.0
  'explanation' => 'Ky është një funksion i prodhuar nga funksion PHP <a href="http://www.php.net/phpinfo">phpinfo()</a>, që shfaqet brenda Copermine .', //cpg1.3.0
  'no_link' => 'Lejimi i shikimit të info-PHP ka risqe të mëdhaja për albumin.është e këshillueshme që ky funksion të jetë i dukshëm vetëm për administratorët e albumit. ', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
        'upd_alb_n' => 'Përditësim i albumit %s',
        'general_settings' => 'Dekori i përgjithshëm',
        'alb_title' => 'Titulli i albumit',
        'alb_cat' => 'Kategoria e albumit ',
        'alb_desc' => 'Përshkrimi i albumit',
        'alb_thumb' => ' Tablotë e albumit',
        'alb_perm' => 'Lejimet për këtë album',
        'can_view' => 'Albumi mund të shihet nga',
        'can_upload' => 'Visitorët mund të ngarkojnë foto',
        'can_post_comments' => 'Visitorët mund të postojnë komente',
        'can_rate' => 'Visitorët mund të votojnë për fotografitë',
        'user_gal' => 'Galleria e anëtarit',
        'no_cat' => '* Jashtë kategorive *',
        'alb_empty' => 'Albumi është bosh',
        'last_uploaded' => 'Përditësimi i fundit',
        'public_alb' => 'Të gjithë (album publik)',
        'me_only' => 'Vetëm unë',
        'owner_only' => ' Vetëm pronari i (%s) ',
        'groupp_only' => 'Anëtarët e  grupit\'%s\'',
        'err_no_alb_to_modify' => 'Në bazën e të dhënave nuk ka albume që ju mund ti modifikoni.',
        'update' => 'Përditësoni albumin',
                'notice1' => '(*) varësisht nga configurimi i  %sgroups%s settings', //cpg1.3.0 (do not translate %s!)
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
        'already_rated' => 'Na vjenë keq por ju e keni vlerësuar këtë fotografi',
        'rate_ok' => 'Vota juaj u pranua',
                'forbidden' => 'Ju nuk mund të votoni për fotografinë tuaj.', //cpg1.3.0
);
// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
Edhe pse administratorët e {SITE_NAME} do të bëjnë të pamundurën të fshijnë ose modifikojnë sa më shpejtë që të jetë e mundur gjithë materialet të pamoralëshme apo fyese, është e pamundur të shihet vazhdimisht çdo postim. Kështu që ju duhet ta dini se të gjithë postimet e bëra në këtë sit shprehin pikëpamjet e opinionin e autorëve dhe jo atë të administratorëve apo webmasterit të këtij websiti(veç rasteve të postimeve nga këta të fundit) kështu që këta nuk mund të konsiderohen përgjegjës.<br />
<br />
Ju pranoni të mos postoni materiale abuzive, të pahijëshme, vulgare, shpifëse, të urrejtëshme, kërcënuese, me orientim seksual apo materiale të tjera që dhunojnë ligjet në fuqi. Ju pranoni që webmasteri, administratori dhe moderatorët e {SITE_NAME} kanë të drejtëtë fshijnë apo editojnë çdo material në çdo kohë që ata e gjykojnë të arsyeshme. Si përdorues ju pranoni që çdo informacion që keni futur më sipër ruhet në një bazë të dhënash. Megjithëse këto informacione nuk u transmetohen të tretëve pa miratimin tuaj, webmasteri ose administratori nuk mbajnë përgjegjësi për  tentativa piraterie kundrejt bazës së të
dhënave.<br />
<br />
Ky web site përdor cookies për të ruajtur informacione në kompiuterin tuaj. Këto cookies shërbejnë vetëm për t'jua bërë sa më të kënaqshëm shfletimin e këtij albumi. Adresa juaj e-mail do të përdoret vetëm për të konfirmuar të dhënat e regjistrimit tuaj si dhe fjalë-kalimin.<br />
<br />
Duke klikuar tek 'Pranoj' këtu më poshtë ju pranoni tu përmbaheni këtyre kushteve.
EOT;

$lang_register_php = array(
        'page_title' => 'Regjistrim i përdoruesit',
        'term_cond' => 'Marrveshje dhe kushte',
        'i_agree' => 'Pranoj',
        'submit' => 'Paraqit regjistrimin',
        'err_user_exists' => 'Ky emër përdoruesi që ju futët është i zënë, ju lutemi të zgjidhni një tjetër',
        'err_password_mismatch' => 'Dy fjalë-kalimet nuk korrespondojnë njëra me tjetrën, ju lutemi shkruajini përsëri',
        'err_uname_short' => 'Emri i përdoruesit duhet të ketë të paktën dy shkronja',
        'err_password_short' => 'Fjalë-kalimi duhet të ketë të paktën dy shkronja',
        'err_uname_pass_diff' => 'Emri i përdoruesit dhe fjalë-kalimi duhet të jenë të ndryshëm',
        'err_invalid_email' => 'Adresa e-mail nuk është e vlefshme',
        'err_duplicate_email' => 'Një tjetër përdorues është regjistruar adresën e-mail që ju futët',
        'enter_info' => 'Fusni informacionin e regjistrimit',
        'required_info' => 'Information i detyrueshëm',
        'optional_info' => 'Information i padetyrueshëm',
        'username' => 'Emri i përdoruesit',
        'password' => 'Fjalë-kalimi',
        'password_again' => 'Rishkruaj fjalë-kalimin',
        'email' => 'Email',
        'location' => 'Vendndodhja',
        'interests' => 'Interesat',
        'website' => 'Faqe interneti',
        'occupation' => 'Profesioni',
        'error' => 'GABIM',
        'confirm_email_subject' => '%s - Konfirmim i regjistrimit',
        'information' => 'Informacion',
        'failed_sending_email' => 'Konfirmimi i regjistrimit nuk mund të dërgohet !',
        'thank_you' => 'Faleminderit për regjistrimin.<br /><br />Një e-mail me informacionin se si të  aktivizoni llogarinë tuaj është nisur në adresën që ju na furnizuat.',
        'acct_created' => 'Llogaria juaj është krijuar dhe ju tani mund të identifikoheni me emrin e përdoruesit dhe fjalë-kalimin tuaj',
        'acct_active' => 'Llogaria juaj është tashmë aktive dhe ju mund të identifikoheni me emrin e përdoruesit dhe fjalë-kalimin tuaj',
        'acct_already_act' => 'Llogaria juaj është tashmë aktive !',
        'acct_act_failed' => 'Kjo llogari nuk mund të aktivizohet !',
        'err_unk_user' => 'Përdoruesi i zgjedhur nuk ekziston !',
        'x_s_profile' => '%s\ profili',
        'group' => 'Grupe',
        'reg_date' => 'Regjistruar më',
        'disk_usage' => 'Përdorimi i diskut',
        'change_pass' => 'Ndërro fjalë-kalimin',
        'current_pass' => 'Fjalëkalimi i tashëm',
        'new_pass' => 'Fjalë-kalimi i ri',
        'new_pass_again' => 'Fjalë-kalimi i ri përsëri',
        'err_curr_pass' => 'Fjalëkalimi i tashëm nuk është korrekt',
        'apply_modif' => 'Zbato ndryshimet',
        'change_pass' => 'Ndërro fjalë-kalimin tim',
        'update_success' => 'Profili juaj u përditësua',
        'pass_chg_success' => 'Fjalë-kalimi juaj u ndryshua',
        'pass_chg_error' => 'Fjalë-kalimi juaj nuk u ndryshua',
                'notify_admin_email_subject' => '%s - Njoftim regjistrimi', //cpg1.3.0
                'notify_admin_email_body' => 'Një përdorues i ri me emër përdoruesi "%s" është regjistruar tek galeria juaj', //cpg1.3.0
);

$lang_register_confirm_email = <<<EOT
Faleminderit që u regjistruat tek  {SITE_NAME}

Emri Juaj i përdorimit është : "{USER_NAME}"
Fjalë-kalimi juaj është : "{PASSWORD}"

Me qëllim që të aktivizoni llogarinë tuaj, ju duhet të klikoni në lidhjen e mëposhtëme
ose kopjojeni atë dhe ngjiteni tek web vozitësi juaj.

{ACT_LINK}

Përshëndetje,

Stafi i {SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
        'title' => 'Review comments',
        'no_comment' => 'Këtu nuk ka komente për të parë',
        'n_comm_del' => '%s Komente të fshira',
        'n_comm_disp' => 'Numri i komenteve për tu afishuar',
        'see_prev' => 'Shiko paraardhësen',
        'see_next' => 'Shiko pasardhësen',
        'del_comm' => 'Fshi komentet e zgjedhura',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
        0 => 'Kërko koleksionin fotografik',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
        'page_title' => 'Kërko fotografi të reja',
        'select_dir' => 'Zgjidh dosjen',
        'select_dir_msg' => 'Ky funksion ju lejon të shtoni një grumbull fotosh të ngarkuara në serverin tuajnëpërmjet FTP.<br /><br />Zgjidh dosjen ku janë ngarkuar fotografitë',
        'no_pic_to_add' => 'Këtu nuk ka fotografi për tu shtuar',
        'need_one_album' => 'Ju keni nevojë për të paktën një album për të përdorur këtë funksion',
        'warning' => 'Kujdes',
        'change_perm' => 'Skripti nuk mund të shkruaj në këtë dosje, ju duhet të ndryshoni lejimet në 755 apo 777 para se të provoni të shtoni fotografi !',
        'target_album' => '<b>Kalo fotografitë e &quot;</b>%s<b>&quot; tek </b>%s',
        'folder' => 'Dosje',
        'image' => 'Imazh',
        'album' => 'Album',
        'result' => 'Resultat',
        'dir_ro' => 'E pashkrueshme. ',
        'dir_cant_read' => 'E palexueshme. ',
        'insert' => 'Shto fotografi të reja tek galeria',
        'list_new_pic' => 'Lista e fotove të reja',
        'insert_selected' => 'Shto fotografitë e zgjedhura',
        'no_pic_found' => 'Asnjë fotografi e re nuk u gjend',
        'be_patient' => 'Ju lutemi jini i duruar, skripti do kohë për të shtuar fotografitë',
                'no_album' => 'asnjë album i zgjedhur',  //cpg1.3.0
        'notes' =>  '<ul>'.
                                '<li><b>OK</b> : do të thotë që fotografia u shtua me sukses'.
                                '<li><b>DP</b> : do të thotë që fotografia është një dublikatë dhe ekziston tashmë bazën e të dhënave'.
                                '<li><b>PB</b> : do të thotë që fotografia nuk mund të shtohet, shiko konfigurimin dhe lejimet në dosjen ku fotografitë janë vendosur'.
                                '<li>Nëse shenjat OK, DP, PB nuk duken kliko tek imazhi i prishur për të parë ndonjë mesazh gabimesh të dhëna nga PHP'.
                                '<li>Nëse vozitësi juaj pushon së funksionuari (timeout), kliko tek butoni i ringarkimit'.
                                '</ul>',
                'select_album' => 'Zgjidh albumin', //cpg1.3.0
        'check_all' => 'Shënoji të gjitha', //cpg1.3.0
        'uncheck_all' => 'Anulloji të gjitha', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //

// Void



// ------------------------------------------------------------------------- //
// File banning.php
// ------------------------------------------------------------------------- //

if (defined('BANNING_PHP')) $lang_banning_php = array(
                'title' => 'Përjashto përdoruesit',
                'user_name' => 'Emri i Përdoruesit',
                'ip_address' => 'Adresa IP',
                'expiry' => 'Afati (i bardhë nëse përgjithmonë)',
                'edit_ban' => 'Ruaj ndryshimet',
                'delete_ban' => 'Fshi',
                'add_new' => 'Shto një ndalim të ri',
                'add_ban' => 'Shto',
                                'error_user' => 'Përduruesi nuk mund gjendet', //cpg1.3.0
                                  'error_specify' => 'Ju duhet të specifikoni një përdorues ose adresë IP', //cpg1.3.0
                                  'error_ban_id' => 'ID e pavlefshme!', //cpg1.3.0
                                  'error_admin_ban' => 'Ju nuk mund të ndaloni vehten tuaj!', //cpg1.3.0
                                  'error_server_ban' => 'Ju jeni duke ndaluar serverint tuaj? hej, mos e bëjë një gjë të tillë...', //cpg1.3.0
                                  'error_ip_forbidden' => 'Ju nuk mund të ndaloni këtë adresë IP pasi ajo nuk është e specifikuar!', //cpg1.3.0
                                  'lookup_ip' => 'Kërko rrugën e një adrese IP', //cpg1.3.0
                             'submit' => 'ec!', //cpg1.3.0
);
// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
  'title' => 'Ngarkoni fotografi', //cpg1.3.0
  'custom_title' => 'Furmular i kërkuar i personalizuar', //cpg1.3.0
  'cust_instr_1' => 'Ju mund të zgjidhni numrin e dëshiruar të kutive të ngarkimit. Sidoqoftë ju nuk mund të zgjidhni më shumë kuti nga sa lejohet këtu më poshtë', //cpg1.3.0
  'cust_instr_2' => 'Numri i kutive të kërkuara', //cpg1.3.0
  'cust_instr_3' => 'Kutitë e ngarkimit të fotografive: %s', //cpg1.3.0
  'cust_instr_4' => 'Kuti ngarkimi URI/URL : %s', //cpg1.3.0
  'cust_instr_5' => 'Kuti ngarkimi URI/URL:', //cpg1.3.0
  'cust_instr_6' => 'Kutitë e  ngarkimit të fotografive:', //cpg1.3.0
  'cust_instr_7' => 'Luteni të zgjidhni një numër për çdo tip kutie ngarkimi për këtë moment.  Pastaj klikoni  \'Vazhdim\'. ', //cpg1.3.0
  'reg_instr_1' => 'Veprim i gabuar në krijimin e formularit.', //cpg1.3.0
  'reg_instr_2' => 'Tash ju mund të ngarkoni fotografi duke përdorur kutit e mëposhtëme të ngarkimit. Madhësia e faileve të ngarkuara në server nuk duhet të kaloj  %s KB secila. Faillet ZIP të ngarkuara tek \'Ngarkim fotografish\' dhe \' Ngarkime URI/URL \' do të ngelen të kompresuara.', //cpg1.3.0
  'reg_instr_3' => 'Nëse dëshironi që faillet ZIP ose të arkivuara të dekompresohen, ju duhet të përdorni kutin e ngarkimit tek zona \'Ngarkim ZIP të dekompresueshme\' .', //cpg1.3.0
  'reg_instr_4' => 'Kur përdor seksioni ngarkime URI/URL, luteni të fusni adresë ku ndodhet failli ose fotografia sipas formës : http://www.mysite.com/images/example.jpg', //cpg1.3.0
  'reg_instr_5' => 'Sapo të keni plotësuar formularin, klikoni \'VAZHDIM\'.', //cpg1.3.0
  'reg_instr_6' => 'Ngarkime ZIP të dekompresueshme:', //cpg1.3.0
  'reg_instr_7' => 'Ngarkim fotografish:', //cpg1.3.0
  'reg_instr_8' => 'Ngarkime URI/URL :', //cpg1.3.0
  'error_report' => 'Raport gabimi', //cpg1.3.0
  'error_instr' => 'Ngarki i radhës ka hasur në një gabim:', //cpg1.3.0
  'file_name_url' => 'Emri i faillit/URL', //cpg1.3.0
  'error_message' => 'Masazh gabimi', //cpg1.3.0
  'no_post' => 'Fotografie e pa ngarkuar nga POST.', //cpg1.3.0
  'forb_ext' => 'Ekstensioni i fotografisë nuk është i lejuar.', //cpg1.3.0
  'exc_php_ini' => 'Tejaklim i madhësisë së dokumentit të lejuar sipas php.ini.', //cpg1.3.0
  'exc_file_size' => 'Tejaklim i madhësisë së dokumentit të lejuar sipas CPG.', //cpg1.3.0
  'partial_upload' => 'Vetëm një ngarkim i pjesëshëm.', //cpg1.3.0
  'no_upload' => 'Ngarkimi nuk u krye.', //cpg1.3.0
  'unknown_code' => 'Kod i gabuar ngarkimi PHP i panjohur.', //cpg1.3.0
  'no_temp_name' => 'Nuk ka ngarkim - Nuk ekziston një dosje e përkohëshme.', //cpg1.3.0
  'no_file_size' => 'Nuk përmban të dhëna /E korruptuar', //cpg1.3.0
  'impossible' => 'E pamundur të zhvendoset.', //cpg1.3.0
  'not_image' => 'Nuk ka imazh/Korruptuar', //cpg1.3.0
  'not_GD' => 'Nuk është një ekstension GD.', //cpg1.3.0
  'pixel_allowance' => 'Tejkalim i pikseleve të lejueshme.', //cpg1.3.0
  'incorrect_prefix' => 'Prefiks URI/URL i gabuar', //cpg1.3.0
  'could_not_open_URI' => 'Adresa URI nuk hapet.', //cpg1.3.0
  'unsafe_URI' => 'Siguria e pavërtetueshme.', //cpg1.3.0
  'meta_data_failure' => 'Gabim i të dhëna Meta', //cpg1.3.0
  'http_401' => '401 I paautorizuar', //cpg1.3.0
  'http_402' => '402 duhet paguar', //cpg1.3.0
  'http_403' => '403 Ndalohet', //cpg1.3.0
  'http_404' => '404 Nuk gjendet', //cpg1.3.0
  'http_500' => '500 Gabim i brendëshëm i serverit', //cpg1.3.0
  'http_503' => '503 Servis i padisponueshëm', //cpg1.3.0
  'MIME_extraction_failure' => 'Tipi MIME i pavendosur.', //cpg1.3.0
  'MIME_type_unknown' => 'Tip MIME i panjohur', //cpg1.3.0
  'cant_create_write' => 'Nuk mund të krijohet fail e regjistrueshme.', //cpg1.3.0
  'not_writable' => 'Nuk mund të shkruhet në skedar.', //cpg1.3.0
  'cant_read_URI' => 'Nuk mund të lexohet adresa URI/URL', //cpg1.3.0
  'cant_open_write_file' => 'Nuk mund të hapet adresa URI.', //cpg1.3.0
  'cant_write_write_file' => 'Nuk mund të shkruaht tek adresa URI.', //cpg1.3.0
  'cant_unzip' => 'Dekompresion i pamundur .', //cpg1.3.0
  'unknown' => 'Gabim i panjohur', //cpg1.3.0
  'succ' => 'Ngarkim i suksesshëm', //cpg1.3.0
  'success' => '%s ngarkim(e) kanë qenë të suksesshme.', //cpg1.3.0
  'add' => 'Klikoni  \'VAZHDIM\' për të futur fotografitë në album.', //cpg1.3.0
  'failure' => 'Ngarkim i dështuar', //cpg1.3.0
  'f_info' => 'Indormacion i dokumentit ose fotos.', //cpg1.3.0
  'no_place' => 'Fotografia e mëparëshme nuk mund të vendoset.', //cpg1.3.0
  'yes_place' => 'Fotografia e mëparëshme u vendos me sukses.', //cpg1.3.0
  'max_fsize' => 'Maksimi i madhësisë së fotografive që lejohet është %s KB',
  'album' => 'Albumi',
  'picture' => 'Foto', //cpg1.3.0
  'pic_title' => 'Titulli i fotografisë', //cpg1.3.0
  'description' => 'Përshkrimi i fotografisë', //cpg1.3.0
  'keywords' => 'Fjalë kyç (të ndara me hapsira)',
  'err_no_alb_uploadables' => 'Na vjenë keq por nuk ka ndonjë album ku tu lejohet ngarkimi i fotografive', //cpg1.3.0
  'place_instr_1' => 'Tani, luteni ti vendosni fotografitë në albume. Ju mund të shtoni informacione të mëtejshme për çdonjë nga fotografitë.', //cpg1.3.0
  'place_instr_2' => 'Fotografi të tjera presin të vendosen në albume. Klikoni \'VAZHDIM\'.', //cpg1.3.0
  'process_complete' => 'Ju i keni vendosur me sukses të gjitha fotografitë.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
        'title' => 'Menaxhoni përdoruesit',
        'name_a' => 'Emrat në ngjitje',
        'name_d' => 'Emrat në zbritje',
        'group_a' => 'Grupe në ngjitje',
        'group_d' => 'Grupe në zbritje',
        'reg_a' => 'Data e regjistrimit në ngjitje',
        'reg_d' => 'Data e regjistrimit në zbritje',
        'pic_a' => 'Numri i fotove në ngjitje',
        'pic_d' => 'Numri i fotove në zbritje',
        'disku_a' => 'Harxhimi i diskut në ngjitje',
        'disku_d' => 'Harxhimi i diskut në zbritje',
                'lv_a' => 'Vizita e fundit në ngjitje', //cpg1.3.0
        'lv_d' => 'Vizita e funditnë zbritje', //cpg1.3.0
        'sort_by' => 'Renditi përdoruesit sipas',
        'err_no_users' => 'Tabela e përdoruesit është bosh !',
        'err_edit_self' => 'Ju nuk mund të editoni profilin tuaj, kliko tek lidhja \'Profili im\' për të bër ndryshime në të',
        'edit' => 'EDITO',
        'delete' => 'FSHI',
        'name' => 'Emri i përdoruesit',
        'group' => 'Grupi',
        'inactive' => 'Jo aktiv',
        'operations' => 'Veprime',
        'pictures' => 'Fotografi',
        'disk_space' => 'Hapsira e përdorur / Kuota',
        'registered_on' => 'Regjistruar më',
        'u_user_on_p_pages' => '%d përdorues në %d faqe',
        'confirm_del' => 'Jeni i sigurt që dëshironi të FSHINIkëtë përdorues ? \\nTë gjitha fotografitë dhe albumet do të jenë gjithashtu të fshira.',
        'mail' => 'E-MAIL',
        'err_unknown_user' => 'Përdoruesi i zgjedhur nuk ekziston !',
        'modify_user' => 'Modifiko përdoruesin',
        'notes' => 'Shënime',
        'note_list' => '<li>Nëse ju nuk dëshironi të ndryshoni fjalë-kalimin, lëreni fushën "fjalë-kalim" të bardhë.',
                'password' => 'Fjalë-kalimi',
        'user_active' => 'Përdoruesi është aktiv',
        'user_group' => 'Grup përdoruesash',
        'user_email' => 'E-maili i përdoruesit',
        'user_web_site' => 'Web siti i përdoruesit',
        'create_new_user' => 'Krijo një përdorues të ri',
        'user_location' => 'Vendndodhja e përdoruesit',
        'user_interests' => 'Interesate përdoruesit',
        'user_occupation' => 'Profesioni i përdoruesit',
                'latest_upload' => 'Ngarkimet më të fundit', //cpg1.3.0
        'never' => 'kurr', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => 'Ridimensiono fotografitë',
        'what_it_does' => 'Funksionet',
        'what_update_titles' => 'Përditëso titullin duke u nisur nga emri i dosjes',
        'what_delete_title' => 'Fshi titullin',
        'what_rebuild' => 'Rindërto tablotë dhe fotografitë e ridimensionuara',
        'what_delete_originals' => 'Fshi fotografitë me dimensione origjinale duke i zvendësuar ato me versionin e ridimensionuar',
        'file' => 'File',
        'title_set_to' => 'titulli i ndërruar në',
        'submit_form' => 'Paraqit',
        'updated_succesfully' => 'përditësuar me sukses',
        'error_create' => 'GABIM përgjatë krijimit',
        'continue' => 'Vazhdoni me më shumë imazhe',
        'main_success' => 'Ky dokument (imazh) %s është përdorur tash si imazhi kryesor',
        'error_rename' => 'Gabim gjatë ndryshimit të emrit të %s në %s',
        'error_not_found' => 'Dokumenti %s nuk u gjend',
        'back' => 'kthim tek faqja kryesore',
        'thumbs_wait' => 'Përditësim i tablove dhe/ose imazheve të ridemensionuara, ju lutemi prisni...',
        'thumbs_continue_wait' => 'Vazhdim i përditësimit tëbtablove dhe/ose imazheve të ridemensionuara ...',
        'titles_wait' => 'Përditësim i titujve, ju lutemi prisni...',
        'delete_wait' => 'Fshirje e titujve, ju lutemi prisni...',
        'replace_wait' => 'Fshirje e origjinalëve dhe zvendësim i tyre me imazhe të ridimensionuara, ju lutemi prisni..',
        'instruction' => 'Instrucsione të shpejta',
        'instruction_action' => 'Zgjidhni një veprim',
        'instruction_parameter' => 'Përkufizoni parametrat',
        'instruction_album' => 'Zgjidh albumin',
        'instruction_press' => 'Shtyp %s',
        'update' => 'Perditëso tablot dhe/ose fotografitë e ridimensionuara',
        'update_what' => 'Çfarë duhet të përditësohet',
        'update_thumb' => 'Vetëm tablot',
        'update_pic' => 'Vetëm fotografitë e ridimensionuara',
        'update_both' => 'Edhe tablotë edhe fotografitë e ridimensionuara',
        'update_number' => 'Numri i fotografive të trajtuara me nje klik',
        'update_option' => '(Mundohuni ta zvogëloni këtë vlerë nëse kini probleme me timeout)',
        'filename_title' => 'Emri i dokumentit / Titulli i fotografisë',
        'filename_how' => 'Si duhet modifikuar emri i dokumentit',
        'filename_remove' => 'Ndryshoni fundin .jpg duke e zvendësuar me _ (underscore) me hapsira',
        'filename_euro' => 'Ndërro 2003_11_23_13_20_20.jpg me 23/11/2003 13:20',
        'filename_us' => 'Ndërro 2003_11_23_13_20_20.jpg me 11/23/2003 13:20',
        'filename_time' => 'Ndërro 2003_11_23_13_20_20.jpg me 13:20',
        'delete' => 'Fshi titullin e fotografisë ose përmasat origjinale të saj',
        'delete_title' => 'Fshi titullin e fotografisë',
        'delete_original' => 'Fshi përmasat origjinale të fotografosë',
        'delete_replace' => 'Fshi imazhin origjinal duke e zvendësuar me versionin e ridimensionuar',
        'select_album' => 'Zgjidh albumin',
                'delete_orphans' => 'Fshi komentet jetimë (Kjo vlenë për të gjithë albumet)', //cpg1.3.0
                  'orphan_comment' => 'Komente jetim të gjetura', //cpg1.3.0
                  'delete' => 'Fshi', //cpg1.3.0
                  'delete_all' => 'Fshi të gjitha', //cpg1.3.0
                  'comment' => 'Koment: ', //cpg1.3.0
                  'nonexist' => 'Bashkuar në një dokument që nuk ekziston # ', //cpg1.3.0
                  'phpinfo' => 'Shfaq phpinfo', //cpg1.3.0
                  'update_db' => 'Përditëso bazën e të dhënave', //cpg1.3.0
                  'update_db_explanation' => 'Nëse ju keni zvendësuar skedaret copermine, nëse keni shtuar, modifikuar apo përditësuarnga versionet e mëparëshme të copermine, sigurohuni të instaloni versionin upgrade të bazës së të dhënave. Kjo krijon tabelat e nevojëshme dhe konfiguron bazën tuaj të të dhënave copermine.', //cpg1.3.0
);

?>
