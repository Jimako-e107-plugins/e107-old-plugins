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
// ENCODING CHECK; SHOULD BE YEN BETA MU: � � �
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
$lang_day_of_week = array('E diel�', 'E h�n�', 'E mart�', 'E m�rkur�', 'E enjte', 'E premte', 'E shtun�');
$lang_month = array('Janar', 'Shkurt', 'Mars', 'Prill', 'Maj', 'Qershor', 'Korrik', 'Gusht', 'Shtator', 'Tetor', 'N�ntor', 'Dhjetor');

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
        'random' => 'Fotografi t� rast�sishme',
        'lastup' => 'Futjet m� t� fundit',
        'lastalb'=> 'Albumet m� t� fundit',
        'lastcom' => 'Komentet n� t� fundit',
        'topn' => 'M� t� shikuarat',
        'toprated' => 'M� t� vler�suarat',
        'lasthits' => 'T� para s� fundi',
        'search' => 'Rezultatet e k�rkimit',
        'favpics'=> 'Fotografit� e preferuara'
);

$lang_errors = array(
        'access_denied' => 'Ju nuk u lejohet hyrja n� k�t� faqe.',
        'perm_denied' => 'Ju nuk u lejohet t� kryeni k�t� veprim.',
        'param_missing' => 'Skript i thirrur pa patur prametrat e nevojsh�m.',
        'non_exist_ap' => 'Albumi/fotografia e zgjedhur nuk ekziston !',
        'quota_exceeded' => 'Hap�sira n� disk e tejkaluar<br /><br />Ju keni nje hapsir� prej [quota]K, fotografit� tuaja momentalisht z�n� nj� hapsir� prej [space]K, n�se shtoni k�t� fotografiJu tejkaloni hapsir�n e lejuar.',
        'gd_file_type_err' => 'Kur p�rdorni librarin� e imazheve GD, lejohen vet�m imazhet e formatit JPEG dhe PNG.',
        'invalid_image' => 'Imazhi q� ju keni ngarkuar �sht� i prishur ose nuk njihet nga libraria GD',
        'resize_failed' => 'Krijimi i tablove apo reduktimi i p�rmasave t� fotografis� i pamundur.',
        'no_img_to_display' => 'Nuk ka imazhe p�r tu afishuar',
        'non_exist_cat' => 'Kategoria e zgjedhur nuk ekziston',
        'orphan_cat' => 'Nj� kategori ka nj� prind (paraardh�s) jo ekzistent, p�dorni administrimin e kategoris� p�r t� rregulluar problemin.',
        'directory_ro' => 'Repertori \'%s\' nuk �sht� i shkruesh�m, fotografit� nuk mund t� fshihen',
        'non_exist_comment' => 'Komenti i zgjedhur nuk ekziston.',
        'pic_in_invalid_album' => 'Fotografia �sht� n� nj� album q� nuk ekziston (%s)!?',
        'banned' => 'Ju jeni p�r momentin i p�rjashtuar nga ky web sit.',
        'not_with_udb' => 'Ky funksion �sht� �aktivizuar n� Coppermine sepse �sht� integruar me nj� forum. Ose veprimi q� ju doni t� kryeni nuk �sht� p�rfshir� n� k�t� konfiguracion , ose funksionin n� fjal� duhet ta kryeni duke u nisur nga forumi n� t� cilin keni integruar albumin fotografik.',
                'offline_title' => 'Jasht� linje', //cpg1.3.0
        'offline_text' => 'Galeria �sht� n� k�t� moment jasht� linje - rikthehuni s� shpejti !', //cpg1.3.0
        'ecards_empty' => 'Nuk ka karta elektronike t� regjistruara p�r tu shfaqur. Verifikoni n� ju keni b�r� t� disponueshme k�t� mund�si tek konfigurimi !', //cpg1.3.0
        'action_failed' => 'Veprim i d�shtuar.  Coppermine nuk �sht� n� gjendje t� kryej veprimin q� ju k�rkuat.', //cpg1.3.0
        'no_zip' => 'Librarit� e nevojshme p�r t� trajtuar proceset e zipimit nuk jan� instaluar.  Luteni t� kontaktoni administratorin tuaj Coppermine !', //cpg1.3.0
        'zip_type' => 'Ju nuk keni leje t� ngarkoni skedare ZIP.', //cpg1.3.0
);
$lang_bbcode_help = 'K�to kode mund tu jen� t� nevoj�shme: <li>[b]<b>Bold</b>[/b]</li> <li>[i]<i>Italic</i>[/i]</li> <li>[url=http://yoursite.com/]Url Text[/url]</li> <li>[email]user@domain.com[/email]</li>'; //cpg1.3.0
// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
        'alb_list_title' => 'Shko tek lista e albumeve',
        'alb_list_lnk' => 'Lista e albumeve',
        'my_gal_title' => 'Shko tek galeria ime personale',
        'my_gal_lnk' => 'Galeria ime',
        'my_prof_lnk' => 'Profili im',
        'adm_mode_title' => 'Kalo n� mod� admin',
        'adm_mode_lnk' => 'Mod� admin',
        'usr_mode_title' => 'Kalo n� mod� p�rdorues',
        'usr_mode_lnk' => 'Mod� p�rdorues',
                'upload_pic_title' => 'Ngarko nj� foto n� nj� album',
        'upload_pic_lnk' => 'Ngarko foto',
        'register_title' => 'Krijo nj� llogari',
        'register_lnk' => 'Regjistrohu',
        'login_lnk' => 'Identifikohu',
        'logout_lnk' => '�identifikohu',
        'lastup_lnk' => 'Ngarkimet m� t� fundit',
        'lastcom_lnk' => 'Komentet m� t� fundit',
        'topn_lnk' => 'M� t� shikuarat',
        'toprated_lnk' => 'M� t� vler�suarat',
        'search_lnk' => 'K�rko',
        'fav_lnk' => 'Favoritet e mia',
                'memberlist_title' => 'Shfaq List�n e an�tar�ve', //cpg1.3.0
        'memberlist_lnk' => 'Lista e an�tar�ve', //cpg1.3.0
        'faq_title' => 'Pyetje t� shpeshta t� b�ra p�rsa i p�rket� foto galleris� &quot;Coppermine&quot;', //cpg1.3.0
        'faq_lnk' => 'FAQ', //cpg1.3.0
);

$lang_gallery_admin_menu = array(
        'upl_app_lnk' => 'Aprovim i ngarkimeve',
        'config_lnk' => 'Konfigurimi',
        'albums_lnk' => 'Albume',
        'categories_lnk' => 'Kategorit�',
        'users_lnk' => 'P�rdoruesit',
        'groups_lnk' => 'Grupe',
        'comments_lnk' => 'Komente',
        'searchnew_lnk' => 'grumbull fotografish t� futura',
        'util_lnk' => 'Ridimensionim i fotografive',
        'ban_lnk' => 'Ndalo p�rdoruesit',
                'db_ecard_lnk' => 'Shfaq kartolinat', //cpg1.3.0
);

$lang_user_admin_menu = array(
        'albmgr_lnk' => 'Krijim / renditje e albumeve t� mi',
        'modifyalb_lnk' => 'Modifikim i albumeve t� mi',
        'my_prof_lnk' => 'Profili im',
);

$lang_cat_list = array(
        'category' => 'Kategori',
        'albums' => 'Albume',
        'pictures' => 'Fotografi',
);

$lang_album_list = array(
        'album_on_page' => '%d albume n� %d faqe'
);

$lang_thumb_view = array(
        'date' => 'DAT�',
        //Sort by filename and title
        'name' => 'EMRI I DOSJES',
        'title' => 'TITULLI',
        'sort_da' => 'Renditje sipas dat�s n� ngjitje',
        'sort_dd' => 'Renditje sipas dat�s n� zbritje',
        'sort_na' => 'Renditje sipas emrit n� ngjitje',
        'sort_nd' => 'Renditje sipas emrit n� zbritje',
        'sort_ta' => 'Renditje sipas titullit n� ngjitje',
        'sort_td' => 'Renditje sipas titullit n� zbritje',
                'download_zip' => 'Shkarkoje si dokument ZIP', //cpg1.3.0
        'pic_on_page' => '%d fotografi n� %d faqe(s)',
        'user_on_page' => '%d p�rdorues n� %d faqe(s)'
);

$lang_img_nav_bar = array(
        'thumb_title' => 'Kthehu tek faqja e tablove',
        'pic_info_title' => 'Afisho/fshi informacionet e fotografis�',
        'slideshow_title' => 'Slideshow',
        'ecard_title' => 'D�rgoje k�t� foto si nj� kartolin� elektronike',
        'ecard_disabled' => 'Kartat elektronike nuk jan� aktive',
        'ecard_disabled_msg' => 'Ju nuk kini t� drejt� t� d�rgoni karta elektronike',
        'prev_title' => 'Shiko fotografin� paraardh�se',
        'next_title' => 'Shiko fotografin� pasardh�senext picture',
        'pic_pos' => 'Foto %s/%s',
);

$lang_rate_pic = array(
        'rate_this_pic' => 'Vler�soni k�t� fotografi ',
        'no_votes' => '(Ende nuk ka vota)',
        'rating' => '(Vler�simi i tanish�m : %s / 5 n� %s vota)',
        'rubbish' => 'Shum� keq',
        'poor' => 'Varf�r',
        'fair' => 'Mesatar',
        'good' => 'Mir�',
        'excellent' => 'Shk�lqyer',
        'great' => 'Madh�shtore',
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
        'filesize' => 'Madh�sia e skedarit : ',
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
  'select_all' => 'P�rzgjidh t� gjitha', //cpg1.3.0
  'copy_and_paste_instructions' => 'N�se ju jeni duke k�rkuar ndihme nga teknik�t e coppermine, kopjo e ngjit k�t� difekt tek postimi juaj. Make sure to replace any passwords from the query with *** before posting.', //cpg1.3.0
  'phpinfo' => 'Shfaq phpinfo', //cpg1.3.0
);

$lang_language_selection = array(
  'reset_language' => 'Gjuha e albumit', //cpg1.3.0
  'choose_language' => 'Zgjidhni gjuh�n tuaj', //cpg1.3.0
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
        'Very Happy' => 'Shum� i g�zuar',
        'Smile' => 'Buz�qeshje',
        'Sad' => 'Trishtim',
        'Surprised' => 'Surpriz�',
        'Shocked' => 'I tronditur',
        'Confused' => 'Konfuz',
        'Cool' => 'I qet�',
        'Laughing' => 'I qeshur',
        'Mad' => 'S�mur�',
        'Razz' => 'Ngacmoj',
        'Embarassed' => 'I shqet�suar',
        'Crying or Very sad' => 'Duke qar� ose shum� i trishtuar',
        'Evil or Very Mad' => 'Djall�zor ose shum� i zem�ruar',
        'Twisted Evil' => 'Sadist',
        'Rolling Eyes' => 'Sy rrotullues',
        'Wink' => 'Shkel syrin',
        'Idea' => 'Ide',
        'Arrow' => 'Shigjet�',
        'Neutral' => 'Asnj�an�s',
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
        0 => 'Shk�pudje nga mod� admin...',
        1 => 'Hyrje n� mod� admin...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
        'alb_need_name' => 'Albumet duhet t� ken� nj� em�r !',
        'confirm_modifs' => 'Jeni i sigurt q� doni t� b�ni k�to modifikime ?',
        'no_change' => 'Ju nuk b�t� ndonj� ndryshim !',
        'new_album' => 'Album i ri',
        'confirm_delete1' => 'Jeni i sigurt q� ju doni ta fshini k�t� album ?',
        'confirm_delete2' => '\nGjith� fotografit� dhe komentet q� p�rmban do humbasin !',
        'select_first' => 'S� pari duhet t� zgjidhni nj� album',
        'alb_mrg' => 'Album Manager',
        'my_gallery' => '* Galeria ime *',
        'no_category' => '* Nuk ka kategori *',
        'delete' => 'Fshi',
        'new' => 'E re',
        'apply_modifs' => 'Zbato ndryshimet',
        'select_category' => 'Zgjidh kategorin�',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
        'miss_param' => 'Parameters required for \'%s\'operation not supplied !',
        'unknown_cat' => 'Kategoria e zgjedhur nuk ekziston n� baz�n e t� dh�nave',
        'usergal_cat_ro' => 'Kategoria e p�rdoruesve nuk mund t� fshihet !',
        'manage_cat' => 'Mir�mbaj kategorit�',
        'confirm_delete' => 'Jeni i sigurt� q� doni t� fshini k�t� kategori',
        'category' => 'Kategori',
        'operations' => 'Veprime',
        'move_into' => 'Zhvendos tek',
        'update_create' => 'P�rdit�sim/Krijim kategorie',
        'parent_cat' => 'Kategoria rr�nj�',
        'cat_title' => 'Titulli i kategoris�',
                'cat_thumb' => 'Kategori e tablove', //cpg1.3.0
        'cat_desc' => 'P�rshkrimi i kategoris�'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
        'title' => 'Konfigurimi',
        'restore_cfg' => 'Rikthe konfigurimin origjinal',
        'save_cfg' => 'Ruaj nj� konfigurim t� ri',
        'notes' => 'Sh�nime',
        'info' => 'Informacion',
        'upd_success' => 'Konfigurimi Coppermine u p�rdit�sua',
        'restore_success' => 'Konfigurimi Coppermine origjinal u rikthye',
        'name_a' => 'Emra n� ngjitje',
        'name_d' => 'Emra n� zbritje',
        'title_a' => 'Titujt n� ngjitje',
        'title_d' => 'Titujt n� zbritje',
        'date_a' => 'Data n� ngjitje',
        'date_d' => 'Data n� zbritje',
        'th_any' => 'Maksimumi i duksh�m',
        'th_ht' => 'Lart�sia',
        'th_wd' => 'Gjer�sia',
                'label' => 'em�rtim', //cpg1.3.0
        'item' => 'list�', //cpg1.3.0
        'debug_everyone' => 't� gjith�', //cpg1.3.0
        'debug_admin' => 'Vet�m Administrator�t', //cpg1.3.0
        );


if (defined('CONFIG_PHP')) $lang_config_data = array(
        'Parametra t� p�rgjith�shme',
        array('Emri i galeris�', 'gallery_name', 0),
        array('P�rshkrimi i galeris�', 'gallery_description', 0),
        array('E-maili i administratorit t� galeris�', 'gallery_admin_email', 0),
        array('Adresa tek e cila lidhja \'Shikoni edhe m� shum� foto\' tek e-karta', 'ecards_more_pic_target', 0),
        array('Galleria �sht� jasht� linje', 'offline', 1), //cpg1.3.0
        array('Log ecards', 'log_ecards', 1), //cpg1.3.0
        array('Lejo ZIP-shkarkimin e favoriteve', 'enable_zipdownload', 1), //cpg1.3.0
                'Language, Themes &amp; Charset settings',
        array('Gjuha', 'lang', 5),
        array('Tema', 'theme', 6),
        array('Shfaq list�n e gjuh�ve', 'language_list', 1), //cpg1.3.0
        array('Shfaq flamurin e gjuh�ve', 'language_flags', 8), //cpg1.3.0
        array('Shfaq &quot;anullo&quot; tek perzgjedhja e gjuh�ve', 'language_reset', 1), //cpg1.3.0
        array('Shfaq list�n e temave', 'theme_list', 1), //cpg1.3.0
        array('Shfaq &quot;anullo&quot; tek perzgjedhja e temave', 'theme_reset', 1), //cpg1.3.0
        array('Shfaq FAQ', 'display_faq', 1), //cpg1.3.0
        array('Shfaq ndihm� bbcode', 'show_bbcode_help', 1), //cpg1.3.0
        array('Kodimi i g�rmave', 'charset', 4), //cpg1.3.0

        'Album list view',
        array('Madh�sia e tablos kryesore (piksel ose %)', 'main_table_width', 0),
        array('Numri i niveleve apo kategorive q� duhet t� shfaqen', 'subcat_level', 0),
        array('Numri i albume p�r tu shfaqur', 'albums_per_page', 0),
        array('Numri i kolonave p�r list�n e albumeve', 'album_list_cols', 0),
        array('Madh�sia e tablove n� piksel', 'alb_list_thumb_size', 0),
        array('P�rmbajtja e faqes kryesore', 'main_page_layout', 0),
        array('Shfaqja e tablove t� albumit t� nivelit t� par� me kategorit�','first_level',1),

        'Thumbnail view',
        array('Numri i kolonave ne faqen e tablove', 'thumbcols', 0),
        array('Numri rreshtave ne faqen e tablove', 'thumbrows', 0),
        array('Maksimumi i tablove p�r tu shfaqur', 'max_tabs', 10), //cpg1.3.0
        array('Shfaqni legjend�n e fotografis� (p�rve� titullit)posht� tablos�', 'caption_in_thumbview', 1), //cpg1.3.0
        array('Shfaqni numrin e shikimeve posht� tablos', 'views_in_thumbview', 1), //cpg1.3.0
        array('Shfaqni numrin e komenteve posht� tablos', 'display_comment_count', 1),
        array('Shfaqni emrin e ngarkimit posht� tablos', 'display_uploader', 1), //cpg1.3.0
        array('Vendosje rast�sore e fotografive', 'default_sort_order', 3), //cpg1.3.0
        array('Minimumi i numrit t� votave p� nj� foto p�r tu shfaqur tek lista e\'m� t� vler�suarave\'', 'min_votes_for_rating', 0), //cpg1.3.0

                'Image view &amp; Comment settings',
        array('Gjer�sia e tabel�s ku do t� shfaqet fotografia (n� piksel apo %)', 'picture_table_width', 0),
        array('Informacioni i fotografis� �sht� i duksh�m me instalimin', 'display_pic_info', 1),
        array('Filtroni fjal�t e k�qia n� komente', 'filter_bad_words', 1),
                array('Lejoni buz�qeshjet n� komente', 'enable_smilies', 1),
                array('Lejo komente t� nj�pasnj�shme tek e nj�jta fotografi nga i nj�jti p�rdorues(disable flood protection)', 'disable_comment_flood_protect', 1), //cpg1.3.0
        array('Maksimumi i gjat�sis� s� p�rshkrimit t� fotografis�', 'max_img_desc_length', 0),
        array('Maksimumi i g�rmave n� nj� fjal�', 'max_com_wlength', 0),
        array('Maksimumi i linjave t� nj� komenti', 'max_com_lines', 0),
        array('Maksimumi i gjat�sis� s� nj� komenti', 'max_com_size', 0),
        array('Shfaqni negativin e filmit', 'display_film_strip', 1),
        array('Numri i pozave tek negativi', 'max_film_strip_items', 0),
                array('Njofto admin p�r komentet n�p�rmjet e-mail', 'email_comment_notification', 1), //cpg1.3.0
        array('intervali i slideshow n� milisekonda(1 second = 1000 milliseconds)', 'slideshow_interval', 0), //cpg1.3.0


        'Pictures and thumbnails settings',
        array('Cil�sia p�r skedar�t JPEG', 'jpeg_qual', 0),
        array('P�rmasat maksimale t� nj� tabloje <a href="#notice2" class="clickable_option">**</a>', 'thumb_width', 0), //cpg1.3.0
        array('P�rdor p�rmasat ( gjer�si ose lart�si ose p�rmasat  maksimale p�r tablot� )<b>**</b>', 'thumb_use', 7),
        array('Krijoni fotografi nd�rmjet�se','make_intermediate',1),
        array('Maksimumi i gjer�sis� dhe lart�sis� s� nj� fotografie/video nd�rmjet�se  <a href="#notice2" class="clickable_option">**</a>', 'picture_width', 0), //cpg1.3.0
        array('Maksimumi i skedar�ve p�r tu ngarkuar (KB)', 'max_upl_size', 0), //cpg1.3.0
        array('Maksimumi i gjer�sis� dhe lart�sis� s� fotove/videove p�r tu ngarkuar (piksels)', 'max_upl_width_height', 0), //cpg1.3.0

                'Files and thumbnails advanced settings', //cpg1.3.0
        array('Shfaq ikonat e albumeve private p�rdoruesve t� paidentifikuar','show_private',1), //cpg1.3.0
        array('Karaktere/g�rma t� ndaluara n� nj� em�rtim skedari', 'forbiden_fname_char',0), //cpg1.3.0
        //array('Ekstensionet e lejuara p�r ngarkimin e fotografive', 'allowed_file_extensions',0), //cpg1.3.0
        array('Tip fotografish i lejuar', 'allowed_img_types',0), //cpg1.3.0
        array('Tip filmi i lejuar', 'allowed_mov_types',0), //cpg1.3.0
        array('Tip audio i lejuar', 'allowed_snd_types',0), //cpg1.3.0
        array('Tip dokumenti i lejuar', 'allowed_doc_types',0), //cpg1.3.0
        array('Metod� p�r ridimensionimin e fotografis�','thumb_method',2), //cpg1.3.0
        array('Rruga p�r tek programi ImageMagick \'convert\'  (shembull /usr/bin/X11/)', 'impath', 0), //cpg1.3.0
        //array('Tip imazhi i lejuar(i vlefsh�m vet�m p�r ImageMagick)', 'allowed_img_types',0), //cpg1.3.0
        array('Linja komandash p�r ImageMagick', 'im_options', 0), //cpg1.3.0
        array('lexo formatet EXIF tek skedaret et formatit JPEG', 'read_exif_data', 1), //cpg1.3.0
        array('lexo formatet IPTC tek skedaret et formatit JPEG', 'read_iptc_data', 1), //cpg1.3.0
        array('Repertori i albumeve <a href="#notice1" class="clickable_option">*</a>', 'fullpath', 0), //cpg1.3.0
        array('Repertori p�r albumet e p�rdoruesve <a href="#notice1" class="clickable_option">*</a>', 'userpics', 0), //cpg1.3.0
        array('Prefiksi p�r fotografit� nd�rmjet�se <a href="#notice1" class="clickable_option">*</a>', 'normal_pfx', 0), //cpg1.3.0
                  array('Prefiksi p�r tablot� <a href="#notice1" class="clickable_option">*</a>', 'thumb_pfx', 0), //cpg1.3.0
                  array('Modeli i repertuarve sipas instalimit', 'default_dir_mode', 0), //cpg1.3.0
                  array('Modeli i skedar�ve sipas instalimit', 'default_file_mode', 0), //cpg1.3.0


        'User settings',
                  array('Lejo regjistrimin e p�rdoruesve t� rinj�', 'allow_user_registration', 1),
                  array('Regjistrimi i p�rdoruesve n�p�rmjet verifikim t� e-mail', 'reg_requires_valid_email', 1),
                  array('Njoftim i admin p�r regjistrim p�rdoruesish n�p�rmjet e-mail', 'reg_notify_admin_email', 1), //cpg1.3.0
                  array('Lejo dy p�rdorues t� ken� t� nj�jt�n adres� elektronike', 'allow_duplicate_emails_addr', 1),
                  array('P�rdoruesit mund t� ken� albume private(Kini parasysh: N�se ndryshoni nga \'po\' n� \'jo\' t� gjith� albumet private b�hen publike)', 'allow_private_albums', 1), //cpg1.3.0
                  array('Njofto admin n�se ngarkime p�rdoruesish presin p�r miratim', 'upl_notify_admin_email', 1), //cpg1.3.0
                  array('Lejo p�rdoruesit e identifikuar t� shikojn� list�n e an�tar�ve', 'allow_memberlist', 1), //cpg1.3.0

        'Custom fields for image description (leave blank if unused)',
        array('Emri i fush�s 1', 'user_field1_name', 0),
        array('Emri i fush�s 2', 'user_field2_name', 0),
        array('Emri i fush�s 3', 'user_field3_name', 0),
        array('Emri i fush�s 4', 'user_field4_name', 0),

        'Cookies &amp; Charset settings',
        array('Emri i cookie q� p�rdor skripti', 'cookie_name', 0),
        array('Rruga e cookit q� p�rdor skripti', 'cookie_path', 0),
        array('Kodimi i g�rmave', 'charset', 4),

        'Miscellaneous settings',
                  array('Aktivizo modelin debug', 'debug_mode', 9), //cpg1.3.0
                  array('Shfaq njoftimet n� modelin debug', 'debug_notice', 1), //cpg1.3.0

  '<br /><div align="left"><a name="notice1"></a>(*) Nuk duhet ti ndryshoni k�to preferenca n�se keni materiale n� baz�n e t� dh�nave.<br />
  <a name="notice2"></a>(**) Kur ndryshoni k�t� preferenc�, v�t�m fotot e futura pas k�tij k�tij momenti preken nga ky ndryshim, pra �sht� e k�shillueshme t� mos ndryshohet kjo preferenc� n�se ju keni tashm� materiale n� galeri. Sidoqoft�, ju mund ti aplikoni ndryshimet n� dokumentat ekzistues n�p�rmjet &quot;<a href="util.php">mjeteve q� dispononi si admin</a> (resize pictures)&quot; n� menun admin.</div><br />', //cpg1.3.0
);
// ------------------------------------------------------------------------- //
// File db_ecard.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('DB_ECARD_PHP')) $lang_db_ecard_php = array(
  'title' => 'D�rgo kartolina elektronike', //cpg1.3.0
  'ecard_sender' => 'D�rguesi', //cpg1.3.0
  'ecard_recipient' => 'Marr�si', //cpg1.3.0
  'ecard_date' => 'Dat�', //cpg1.3.0
  'ecard_display' => 'Shfaq kartolin�n', //cpg1.3.0
  'ecard_name' => 'Emri', //cpg1.3.0
  'ecard_email' => 'Emaili', //cpg1.3.0
  'ecard_ip' => 'IP #', //cpg1.3.0
  'ecard_ascending' => 'Duke u ngjitur', //cpg1.3.0
  'ecard_descending' => 'Duke zbritur', //cpg1.3.0
  'ecard_sorted' => 'Shp�rndar�', //cpg1.3.0
  'ecard_by_date' => 'sipas dat�s', //cpg1.3.0
  'ecard_by_sender_name' => 'Sipas emrit t� d�rguesit', //cpg1.3.0
  'ecard_by_sender_email' => 'sipas emailit t� d�rguesit', //cpg1.3.0
  'ecard_by_sender_ip' => 'Sipas IP s� d�rguesit', //cpg1.3.0
  'ecard_by_recipient_name' => 'sipas emrit t� marr�sit', //cpg1.3.0
  'ecard_by_recipient_email' => 'sipas emailit t� marrsit', //cpg1.3.0
  'ecard_number' => 'Shfaq regjistrimet %s deri n� %s nga %s', //cpg1.3.0
  'ecard_goto_page' => 'shko tek faqja', //cpg1.3.0
  'ecard_records_per_page' => 'Regjistrime n� faqe', //cpg1.3.0
  'check_all' => 'zgjidhi t� gjitha', //cpg1.3.0
  'uncheck_all' => 'Anulloi t� gjitha', //cpg1.3.0
  'ecards_delete_selected' => 'Fshi kartolinat e p�rzgjedhura', //cpg1.3.0
  'ecards_delete_confirm' => 'Jeni i sigurt q� ju d�shironi ti fshini k�to regjistrime ? Sh�noni tek kutija e p�rzgjedhjes!', //cpg1.3.0
  'ecards_delete_sure' => 'Jam i sigurt', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
  'empty_name_or_com' => 'Ju duhet t� shkruani emrin tuaj dhe nj� koment',
  'com_added' => 'Komenti juaj u regjistrua',
  'alb_need_title' => 'Ju duhet ti vini  nj� titull albumit !',
  'no_udp_needed' => 'P�rdit�simi �sht� i panevojsh�m.',
  'alb_updated' => 'Albumi u p�rdit�sua',
  'unknown_album' => 'Albumi i zgjedhur nuk ekziston ose juve nuk u lejohet t� ngarkoni n� t�',
  'no_pic_uploaded' => 'Asnj� dokument nuk u ngarkua !<br /><br />N�se ju keni zgjedhur nj� dokument p�r ta ngarkuar, verifiko n�se serverilejon ngarkimin e dokumentave...', //cpg1.3.0
  'err_mkdir' => 'E pamundur t� krijohet repertori %s !',
  'dest_dir_ro' => 'Destinacioni i repertorit %s nuk �sht� i shkruesh�m n� skript !',
  'err_move' => 'E pamundur t� l�vizet nga %s nga %s !',
  'err_fsize_too_large' => 'Madh�sia e dokumentit q� ju keni ngarkuar �sht� shum� e madhe (maksimumi i lejuar �sht� %s x %s) !', //cpg1.3.0
  'err_imgsize_too_large' => 'Madh�sia e dokumentit q� ju keni ngarkuar �sht� shum� e madhe (maksimumi i lejuar �sht� %s KB) !',
  'err_invalid_img' => 'Dokumenti q� ju ngarkuat nuk �sh� nj� format i vlefsh�m !',
  'allowed_img_types' => 'Ju mundeni  t� ngarkoni vet�m  %s imazhe.',
  'err_insert_pic' => 'Dokumenti  \'%s\' nuk mund t� futet n� album ', //cpg1.3.0
  'upload_success' => 'Dokumenti juaj u ngarkua me sukses.<br /><br />Ai do t� mundet t� shihet vet�m pasi t� aprovohet nga administratori.', //cpg1.3.0
  'notify_admin_email_subject' => '%s - Njoftim i ngarkimit', //cpg1.3.0
  'notify_admin_email_body' => 'Nj� fotografi �sht� nga  %s e k�rkon aprovimin tuaj. Vizitoni %s', //cpg1.3.0
  'info' => 'Informacion',
  'com_added' => 'Koment i shtuar',
  'alb_updated' => 'Album i p�rdit�suar',
  'err_comment_empty' => 'Komenti juaj �sht� bosh !',
  'err_invalid_fext' => 'Vet�m dokumentat q� kan� ektensionet q� vijojn� jan� t� lejuara : <br /><br />%s.',
  'no_flood' => 'Na vjen� keq por ju jeni tashme autori i komentit t� fundit p�r k�t� dokument.<br /><br />Editoni komentin q� keni postuar n�se d�shironi ta modofikoni', //cpg1.3.0
  'redirect_msg' => 'Ju jeni duke u riorientuar.<br /><br /><br />Klikoni \'VAZHDONI\' n�se faqja nuk rifreskohet automatikisht ',
  'upl_success' => 'Dokumenti juaj u shtua me sukses', //cpg1.3.0
  'email_comment_subject' => 'Kement i postuar tek Coppermine Photo Gallery', //cpg1.3.0
  'email_comment_body' => 'Dikush ka postuar nje koment tek galleria juaj. Shikoje k�tu', //cpg1.3.0
);
// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
        'caption' => 'Legjenda',
        'fs_pic' => 'Imazh me p�rnasat reale',
        'del_success' => 'I fshir� me sukses',
        'ns_pic' => 'Imazh me permasa normale',
        'err_del' => 'Nuk mund t� fshihet',
        'thumb_pic' => 'tablo',
        'comment' => 'koment',
        'im_in_alb' => 'imazh n� album',
        'alb_del_success' => 'Albumi \'%s\' u fshi',
        'alb_mgr' => ' Manazheri Album',
        'err_invalid_data' => 'T� dh�na jo te vlefshme t� marra n� \'%s\'',
        'create_alb' => 'Dukee krijuar albumin \'%s\'',
        'update_alb' => 'Duke p�rdit�suar albumin \'%s\' me titull \'%s\' dhe indeks \'%s\'',
        'del_pic' => 'Fshi fotografin�',
        'del_alb' => 'Fshi albumin',
        'del_user' => 'Fshi p�rdorues',
        'err_unknown_user' => 'P�rdoruesi i zgjedhur nuk ekziston !',
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
  'confirm_del' => 'Jeni i sigurt� q� d�shironi t� FSHINI k�t� dokument ? \\nKomentet do t� fshihen gjithashtu.', //js-alert //cpg1.3.0
  'del_pic' => 'FSHIJENI K�T� DOKUMENT', //cpg1.3.0
  'size' => '%s x %s piksele',
  'views' => '%s her�',
  'slideshow' => 'Slideshow',
  'stop_slideshow' => 'NDALO SLIDESHOW',
  'view_fs' => 'Kliko p�r t� par� imezhin me permasa t� plota',
  'edit_pic' => 'Editoni p�rshkrimin', //cpg1.3.0
  'crop_pic' => 'Retushoje', //cpg1.3.0
);
$lang_picinfo = array(
  'title' =>'Informacioni i dokumentit', //cpg1.3.0
  'Filename' => 'Emri i dokumentit',
  'Album name' => 'Emri i albumit',
  'Rating' => 'Vler�simi (%s vota)',
  'Keywords' => 'Fjal�-ky�',
  'File Size' => 'Madh�sia e dokumentit',
  'Dimensions' => 'P�rmasat',
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
  'iptcKeywords'=>'Fjal�-ku� IPTC', //cpg1.3.0
  'iptcCategory'=>'Kategori IPTC', //cpg1.3.0
  'iptcSubCategories'=>'N�n kategori IPTC ', //cpg1.3.0
);

$lang_display_comments = array(
        'OK' => 'OK',
        'edit_title' => 'Edito k�t� koment',
        'confirm_delete' => 'Jeni i sigurt q� ju d�shironi t� fshini k�t� koment ?',
        'add_your_comment' => 'Shtoni komentin tuaj',
        'name'=>'Emri',
        'comment'=>'Koment',
        'your_name' => 'Anonim',
);

$lang_fullsize_popup = array(
        'click_to_close' => 'Klikoni tek imazhi p�r t� mbyllur k�t� dritare',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
        'title' => 'D�rgo nj� kart� elektronike',
        'invalid_email' => '<b>Kujdes</b> : Adresa e-mail e pavlefshme !',
        'ecard_title' => 'Nj� kart� elektronike nga %s p�r ju',
                'error_not_image' => 'Vet�m imazhet mund t� nisen si kartolina elektronike.', //cpg1.3.0
        'view_ecard' => 'N�se karta elektronike nuk afishohet korrekt�sisht, Klikoni k�t� lidhje',
        'view_more_pics' => 'Klikoni k�t� lidhje p�r t� par� fotografi t� tjera !',
        'send_success' => 'Karta juaj elektronike u d�rgua',
        'send_failed' => 'Na vjen� keq por serveri nuk mundet ta d�rgoj kart�n tuaj elektronike...',
        'from' => 'Nga',
        'your_name' => 'Emri juaj',
        'your_email' => 'E-maili juaj',
        'to' => 'P�r',
        'rcpt_name' => 'Emri i marr�sit',
        'rcpt_email' => 'Adresa e-mail e marr�sit',
        'greetings' => 'Urimet',
        'message' => 'Mesazh',
);
// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
  'pic_info' => 'Informacion i fotografis�', //cpg1.3.0
  'album' => 'Albumi',
  'title' => 'Titulli',
  'desc' => 'P�rshkrimi',
  'keywords' => 'Fjal�-ky�',
  'pic_info_str' => '%s &her�; %s - %s KB - %s shikime - %s vota',
  'approve' => 'Aprovoni dokumentin', //cpg1.3.0
  'postpone_app' => 'Aprovojeni me mbrapa',
  'del_pic' => 'Fshijeni dokumentin', //cpg1.3.0
  'read_exif' => 'Rilexo informacionin EXIF p�rs�ri', //cpg1.3.0
  'reset_view_count' => 'Rivendos num�ruesin e shkarkimeve n� zero',
  'reset_votes' => 'Rivendos num�ruesin e votave n� zero',
  'del_comm' => 'Fshi komentet',
  'upl_approval' => 'Autorizimi i "Upload"',
  'edit_pics' => 'Editoni dokumentin', //cpg1.3.0
  'see_next' => 'Shiko dokumentin pasardh�s', //cpg1.3.0
  'see_prev' => 'Shiko dokumentin pasardh�s', //cpg1.3.0
  'n_pic' => '%s dokumenta', //cpg1.3.0
  'n_of_pic_to_disp' => 'Numri i dokumentave p�r tu shfaqur', //cpg1.3.0
  'apply' => 'Apliko ndryshimet', //cpg1.3.0
  'crop_title' => 'Editori i fotove Coppermine ', //cpg1.3.0
  'preview' => 'Parashikoje', //cpg1.3.0
  'save' => 'Ruaje fotografin�', //cpg1.3.0
  'save_thumb' =>'Ruaje si tablo', //cpg1.3.0
  'sel_on_img' =>'Zona e p�rzgjedhur duhet t� jet� e gjitha brenda imazhit!', //js-alert //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File faq.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FAQ_PHP')) $lang_faq_php = array(
  'faq' => 'Pyetjet e b�ra m� shpesh', //cpg1.3.0
  'toc' => 'Tabela e p�rmbajtjes', //cpg1.3.0
  'question' => 'Pyetje: ', //cpg1.3.0
  'answer' => 'P�rgjigje: ', //cpg1.3.0
);

if (defined('FAQ_PHP')) $lang_faq_data = array(
  'FAQ t� p�rgjith�shme', //cpg1.3.0
  array('Pse duhet t� regjistrohem?', 'Registrimi mund t� k�rkohet ose jo, var�sisht nga administratori. Registrimi u jep an�tar�ve avantazhe p�rpar�si shtes� si ngarkimi, t� paturit e nj� liste favoritesh, mund�sia p�r t� vler�suar fotografit�, postimi i komenteve etj.', 'allow_user_registration', '1'), //cpg1.3.0
  array('Si t� regjistrohem?', 'Shko tek &quot;Registrohu&quot; dhe plot�so fushat e detyrueshme (dhe fushat n� obsion n�se d�shironi).<br />N�se Administratori ka k�rkon aktivizimin e llogaris� me an� t� e-mailit, at�her� pasi t� fusni informacionin e k�rkuar n� formular, ju duhet t� merrni nj� masazh n� adres�n e-mail q� keni regjistruar ku u jepen instruksionet se si t� aktivizoni llogarin� tuaj. Ju duhet t� aktivizoni llogarin� tuaj me q�llim q� t� mundeni t� identifikoheni.', 'allow_user_registration', '1'), //cpg1.3.0
  array('Si mund t� identifikohem?', 'Go to &quot;Identifikohu&quot;, fut emrin e p�rdoruesit dhe fjal�-kalimin dhe kliko tek &quot;m� M� mbaj mend&quot; dhe k�shtu ju nuk kini nevoj t� identifikoheni p�rs�ri kur riktheheni tek albumi.<br /><b>KUJDES:Cookit duhet t� jet� i aktivizuar dhe cookit e k�tij web siti nuk duhet t� fshihen me q�llim q�  &quot;M� mbaj mend &quot; t� funksionoj.</b>', 'offline', 0), //cpg1.3.0
  array('Pse nuk mundem t� identifikohem ?', 'Keni klikuar ju tek lidhja q� u �sht� d�rguar me an� t� e-mailit?. Ajo lidhje aktivizon llogarin� tuaj. P�r probleme t� tjera identifikimi kontaktoni administratorin e sitit.', 'offline', 0), //cpg1.3.0
  array('�far� ndodh n�se harroj fjal�-kalimin?', 'N�se kjo faqe ka nj� lidhje &quot;Harrim i fjal�-kalimit&quot; kliko aty. P�r m� tep�r kontakto administratorin e faqes p�r nj� fjal�-kalin t� ri.', 'offline', 0), //cpg1.3.0
  //array('�far� ndodh n�se nd�rroj adres�n e-mail?', 'Thjesht identifikohu dhe nd�rro adres�n e-mail tek &quot;Profili im&quot;', 'offline', 0), //cpg1.3.0
  array('Si mund t� ruaj nj� foto tek &quot;Favoritet e mia&quot;?', 'Kliko tek fotografia dhe pastaj kliko tek lidhja &quot;info e fotografis�&quot; (<img src="images/info.gif" width="16" height="16" border="0" alt="Picture information" />); l�viz n�p�r info e fotografis� dhe kliko tek &quot;Shto tek favoritet&quot;.<br />Administratori mund ta ket� l�n� t� aktivisuar paraprakisht &quot;foto informacion&quot; .<br />KUJDES:Cookit duhet t� jen� t� aktivizuara dhe cookit e k�saj faqeje nuk duhet t� fshihen.', 'offline', 0), //cpg1.3.0
  array('Si mund t� vler�soj nj� foto?', 'Kliko n� nj� tablo dhe shko n� fund e zgjidh nj� vler�sim.', 'offline', 0), //cpg1.3.0
  array('Si mund t� postoj nj� koment p�r nj� fotografi?', 'Kliko n� nj� tablo dhe shko n� fund e shto nj� koment.', 'offline', 0), //cpg1.3.0
  array('Si mund t� ngarkoj nj� foto?', 'Shko tek &quot;Ngarko foto &quot;dhe zgjidh albumin ku d�shiron t� shtosh foton, kliko &quot;Browse&quot; dhe gjej foton q� d�shiron t� ngarkosh dhe klik  &quot;open&quot; (shto nj� titull dhe p�rshkrim  n�se d�shiron) dhe kliko &quot;VAZHDIM&quot;', 'allow_private_albums', 0), //cpg1.3.0
  array('Ku mund ta mgarkoj nj� fotografi?', 'Ju do t� jeni n� gjendje t� ngarkoni nj� fotografi tek nj� nga albumet e &quot;Galleria ime&quot;. Administratori mund tu lejoj ju t� ngarkoni n� nj� ose n� disa albume t� Galeris� Kryesore .', 'allow_private_albums', 0), //cpg1.3.0
  array('�far� typi dhe �far� madh�sie fotografish mund t� ngarkoj?', 'Madh�sia dhe tipi i fotografis� (jpg, png, etc.) varet nga administratori.', 'offline', 0), //cpg1.3.0
  array('�far� �sht� &quot;Galeria ime&quot;?', '&quot;Galleria ime&quot; �sht� nj� galleri personale q� p�rdoruesi mund t� ngarkoj fotografi n� t� dhe ta mir�mbaj.', 'allow_private_albums', 0), //cpg1.3.0
  array('Si mund t� krijoj, riem�rtoj apo fshij nj� album tek "Galeria ime" ?', 'Ju duhet t� jeni n� "mod�-admin";<br />Shko tek  &quot;Krijo / Rendit Albumet e mia&quot; dhe kliko tek &quot;i ri&quot;. Ndrysho &quot;Album i ri &quot; me emrin q� ju d�shironi.<br />Ju gjithashtu mund t� riem�rtoni �do album t� galeris� suaj.<br />Kliko tek &quot;Zbato ndryshimet&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('Si mund t� modifikoj dhe ndaloj p�rdoruesit t� shikojn� albumet e mia?', 'Ju duhet t� jeni n� "mod�-admin"<br />Shko tek &quot;Modifiko Albums. On the &quot;Update Album&quot; bar, select the album that you want to modify.<br />Here, you can change the name, description, thumbnail picture, restrict viewing and comment/rating permissions.<br />Click &quot;Update Album&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('Si mund t� shikoj p�rdoruesit e tjer� t� albumit?', 'Shko tek "Lista e Albumeve" dhe zgjidh "P�rdoruesit e Albumit".', 'allow_private_albums', 0), //cpg1.3.0
  array('�far� jan� cookies?', 'Cookies jan� t� dh�na n� form� teksti q� d�rgohen nga serveri i nj� web siti n� kompiuterin tuaj.<br />Cookies n� p�rgjith�si lejojn� nj� p�rdorues q� t� l�n� dhe rikthehen n� web site pa patur nevoj� t� identifikohen p�rs�ri.', 'offline', 0), //cpg1.3.0
  array('Ku mund ta gjej k�t� program p�r web faqen time?', 'Coppermine �sht� nj� Album Multimedia falas i shp�rndar sipas  GNU GPL. Ky program ka shum� p�rpar�si dhe �sht� i p�rshtatsh�m p�r shum� platforma. Vizitoni  <a href="http://coppermine.sf.net/">faqen kryesore t� Coppermine</a> p�r t� m�suar m� shum� apo dhe p�r ta shkarkuar at�.', 'offline', 0), //cpg1.3.0

  'Vozitja n� web site', //cpg1.3.0
  array('�far� �sht� "Lista e Albumeve" ?', 'Kjo tregon gjith� kategorin� n� cil�n ju ndodheni me lidhjet drejt �do albumi. N�se ju nuk ndodheni n� nj� galeri, kjo tregon galein� komplet me lidhje p�r  �do kategori.  Tablot� mund t� jen� nj� lidhje drejt>e kategorive.', 'offline', 0), //cpg1.3.0
  array('�far� �sht� "Galeria ime" ?', 'Ky funksion i jep mund�si p�rdoruesit t� krijoi galerin� e vet� duke i dh�n� mund�sin� t� shtoj, fshij apo modifikoj� albume ashti sikurse mund t� ngarkoj n� to.', 'allow_private_albums', 0), //cpg1.3.0
  array('Cila �sht� diferenca midis "Mod� Admin" dhe "Mod� P�rdorues"?', 'Sipas k�saj karakteristike, n� "Mode-Admin" e lejon p�rdoruesin t� modifikoj albumet e vehta (por dhe t� t� tjer�ve n�se administratori ia beson nj� gj� t� till�). ', 'allow_private_albums', 0), //cpg1.3.0
  array('�far� �sht� "Ngarkim fotografish"?', 'Ky funksion lejon nj� p�rdorues t� ngarkoj nj� dokument (madh�sia dhe tipi p�rcaktohet nga administratori) tek nj� galery e zgjedhur nga ju apo nga administratori.', 'allow_private_albums', 0), //cpg1.3.0
  array('�far� �sht� "Ngarkimet m� t� fundit"?', 'Ky funksion shfaq ngarkimet m� t� fundit n� galeri.', 'offline', 0), //cpg1.3.0
  array('�far� �sht� "Komentet e fundit"?', 'Ky funksion tregon komentet m� t� fundit t� b�ra nga p�rdoruesit.', 'offline', 0), //cpg1.3.0
  array('�far� �sht� "M� t� shikuarat"?', 'Ky funksion tregon� fotografit� m� t� shikuara nga p�rdoruesit (t� regjistruar ose jo).', 'offline', 0), //cpg1.3.0
  array('�far� �sht� " M� t� vleresuarat"?', 'Ky funksion tregon fotografit� m� t� vler�suara nga p�rdoruesit, duke treguar vler�simin mesatar (p.sh: n�se 5 p�rdorues vler�sojn� nj� foto me 3 pik� �donj�ri <img src="images/rating3.gif" width="65" height="14" border="0" alt="" />: fotografia do t� ket� mesataren 3 <img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> ; N�se 5 p�rdorues vler�sojn� nj� foto nga 1 n� 5 (1,2,3,4,5) rezultati do t� jet� gjithashtu 3 <img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> .)<br />Vler�simet shkajn� nga <img src="images/rating5.gif" width="65" height="14" border="0" alt="best" /> (madh�shtore) n� <img src="images/rating0.gif" width="65" height="14" border="0" alt="worst" /> (shum� keq).', 'offline', 0), //cpg1.3.0
  array('�far� �sht� "Favoritet e mia"?', 'Ky funksion ju lejon juve t� vendosi nj� apo disa fotografi tek cookiet q� ndodhen n� kompiuterin tuaj.', 'offline', 0), //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File forgot_passwd.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FORGOT_PASSWD_PHP')) $lang_forgot_passwd_php = array(
  'forgot_passwd' => 'Kujtes� fjal�-kalimi', //cpg1.3.0
  'err_already_logged_in' => 'Ju jeni tashm� i identifikuar !', //cpg1.3.0
  'enter_username_email' => 'Fusni emrin e p�rdoruesit ose adres�n e-mail', //cpg1.3.0
  'submit' => 'EC', //cpg1.3.0
  'failed_sending_email' => 'M-maili me kujtes�n e fjal�kalimit nuk mundi t� niset !', //cpg1.3.0
  'email_sent' => 'Nj� e-mail me emrin e p�rdoruesit dhe fjal�-kalimin u nis n� adres�n %s', //cpg1.3.0
  'err_unk_user' => 'P�rdoruesi i zgjedhur nuk ekziston!', //cpg1.3.0
  'passwd_reminder_subject' => '%s - Kujtes� fjal�-kalimi', //cpg1.3.0
  'passwd_reminder_body' => 'Ju keni k�rkuar tu rikujtohen t� dh�nat identifikuese p�r:
Emri i p�rdoruesit: %s
Fjal�-kalimi: %s
Klikoni %s p�r tu identifikuar.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
  'group_name' => 'Emri i grupit',
  'disk_quota' => 'Kuota e diskut',
  'can_rate' => 'Mund t� vler�soni dokumentat', //cpg1.3.0
  'can_send_ecards' => 'Mund t� d�rgoni kartolina elektronike',
  'can_post_com' => 'Mund t� postoni komente',
  'can_upload' => 'Mund t� ngarkoni dokumenta', //cpg1.3.0
  'can_have_gallery' => 'Mund t� keni nj� galeri personale',
  'apply' => 'Zbato ndryshimet',
  'create_new_group' => 'Krijo nj� grup t� ri',
  'del_groups' => 'Fshijeni grupin q� zgjodh�t',
  'confirm_del' => 'Kujdes, kur ju fshini nj� grup, p�rdoruesit e k�tij grupi do t� transferohen tek grupet e perdoruesve \'t� regjistruer\' group !\n\nD�shironi t� vazhdoni?', //js-alert //cpg1.3.0
  'title' => 'Administrim i grupeve t� p�rdoruesve',
  'approval_1' => 'Aprovim i ngarkimeve publike (1)',
  'approval_2' => 'Aprovim Ngarkimeve private (2)',
  'upload_form_config' => 'Konfigurimi i formularit t� ngarkimeve', //cpg1.3.0
  'upload_form_config_values' => array( 'Ngarkim i nj� vet�m nj� dokumenti', 'Ngarkim i vet�m shum� dokumentave', 'Vet�m ngarkimeURI', 'Vet�m dokumenta ZIP ', 'Dokumenta-URI', 'Dokumenta-ZIP', 'URI-ZIP', 'Dokumenta-URI-ZIP'), //cpg1.3.0
  'custom_user_upload'=>'P�rdoruesit mund t� ndryshojn� numrine e kutive t� ngarkimit?', //cpg1.3.0
  'num_file_upload'=>'Numri maximum/ekzakt i kutive t� ngarkimit t� dokumentave', //cpg1.3.0
  'num_URI_upload'=>'Numri i maximum/ekzakt i kutive ngarkuese URI ', //cpg1.3.0
  'note1' => '<b>(1)</b> Ngarkimet n� nj� album publik k�rkojn� aprovimin e administratorit',
  'note2' => '<b>(2)</b> Ngarkimet n� nj� album q� i takon p�rdoruesit k�rkon aprovimin e administratorit',
  'notes' => 'Sh�nime',
);
// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
  'welcome' => 'Mir�sevini !',
);

$lang_album_admin_menu = array(
  'confirm_delete' => 'Jeni i sigurt q� ju d�shironi ta FSHINI k�t� album ? \\nGjith� dokumentat dhe komentet do fshihen gjithashtu.', //js-alert //cpg1.3.0
  'delete' => 'FSHI',
  'modify' => 'VETIT�',
  'edit_pics' => 'EDITO DOKUMENTIN', //cpg1.3.0
);

$lang_list_categories = array(
  'home' => 'Pritja',
  'stat1' => '<b>[pictures]</b> fotografi n� <b>[albums]</b> albume dhe <b>[cat]</b> kategori me <b>[comments]</b> komente t� shikuara <b>[views]</b> her�', //cpg1.3.0
  'stat2' => '<b>[pictures]</b> fotografi n� <b>[albums]</b> albume t� shikuara<b>[views]</b> her�', //cpg1.3.0
  'xx_s_gallery' => '%s\'s Galeri',
  'stat3' => '<b>[pictures]</b> fotografi n� <b>[albums]</b> albume me <b>[comments]</b> komente t� shikuara <b>[views]</b> her�', //cpg1.3.0
);

$lang_list_users = array(
  'user_list' => 'Lista e p�rdoruesve',
  'no_user_gal' => 'Nuk ka galeri t� p�rdoruesve',
  'n_albums' => '%s album(e)',
  'n_pics' => '%s fotografi', //cpg1.3.0
);

$lang_list_albums = array(
  'n_pictures' => '%s fotografi', //cpg1.3.0
  'last_added' => ', e fundit shtuar m� %s',
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
        'login' => 'Identifikim',
        'enter_login_pswd' => 'Fusni emrin e p�rdoruesit dhe fjal�-kalimin',
        'username' => 'Emri i p�rdoruesit',
        'password' => 'Fjal�kalimi',
        'remember_me' => 'M� mbaj mend',
        'welcome' => 'Mir�seerdhe %s ...',
        'err_login' => '*** Nuk mund�t t� identifikoheni. Provoni p�rs�ri ***',
        'err_already_logged_in' => 'Ju jeni tashm� i identifikuar !',
                'forgot_password_link' => 'Kam harruar fjal�-kalimin tim !', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
        'logout' => '�identifikim',
        'bye' => 'Mir� u pafshim %s ...',
        'err_not_loged_in' => 'Ju nuk jeni identifikuar !',
);
// ------------------------------------------------------------------------- //
// File phpinfo.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('PHPINFO_PHP')) $lang_phpinfo_php = array(
  'php_info' => 'PHP informacion', //cpg1.3.0
  'explanation' => 'Ky �sht� nj� funksion i prodhuar nga funksion PHP <a href="http://www.php.net/phpinfo">phpinfo()</a>, q� shfaqet brenda Copermine .', //cpg1.3.0
  'no_link' => 'Lejimi i shikimit t� info-PHP ka risqe t� m�dhaja p�r albumin.�sht� e k�shillueshme q� ky funksion t� jet� i duksh�m vet�m p�r administrator�t e albumit. ', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
        'upd_alb_n' => 'P�rdit�sim i albumit %s',
        'general_settings' => 'Dekori i p�rgjithsh�m',
        'alb_title' => 'Titulli i albumit',
        'alb_cat' => 'Kategoria e albumit ',
        'alb_desc' => 'P�rshkrimi i albumit',
        'alb_thumb' => ' Tablot� e albumit',
        'alb_perm' => 'Lejimet p�r k�t� album',
        'can_view' => 'Albumi mund t� shihet nga',
        'can_upload' => 'Visitor�t mund t� ngarkojn� foto',
        'can_post_comments' => 'Visitor�t mund t� postojn� komente',
        'can_rate' => 'Visitor�t mund t� votojn� p�r fotografit�',
        'user_gal' => 'Galleria e an�tarit',
        'no_cat' => '* Jasht� kategorive *',
        'alb_empty' => 'Albumi �sht� bosh',
        'last_uploaded' => 'P�rdit�simi i fundit',
        'public_alb' => 'T� gjith� (album publik)',
        'me_only' => 'Vet�m un�',
        'owner_only' => ' Vet�m pronari i (%s) ',
        'groupp_only' => 'An�tar�t e  grupit\'%s\'',
        'err_no_alb_to_modify' => 'N� baz�n e t� dh�nave nuk ka albume q� ju mund ti modifikoni.',
        'update' => 'P�rdit�soni albumin',
                'notice1' => '(*) var�sisht nga configurimi i  %sgroups%s settings', //cpg1.3.0 (do not translate %s!)
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
        'already_rated' => 'Na vjen� keq por ju e keni vler�suar k�t� fotografi',
        'rate_ok' => 'Vota juaj u pranua',
                'forbidden' => 'Ju nuk mund t� votoni p�r fotografin� tuaj.', //cpg1.3.0
);
// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
Edhe pse administrator�t e {SITE_NAME} do t� b�jn� t� pamundur�n t� fshijn� ose modifikojn� sa m� shpejt� q� t� jet� e mundur gjith� materialet t� pamoral�shme apo fyese, �sht� e pamundur t� shihet vazhdimisht �do postim. K�shtu q� ju duhet ta dini se t� gjith� postimet e b�ra n� k�t� sit shprehin pik�pamjet e opinionin e autor�ve dhe jo at� t� administrator�ve apo webmasterit t� k�tij websiti(ve� rasteve t� postimeve nga k�ta t� fundit) k�shtu q� k�ta nuk mund t� konsiderohen p�rgjegj�s.<br />
<br />
Ju pranoni t� mos postoni materiale abuzive, t� pahij�shme, vulgare, shpif�se, t� urrejt�shme, k�rc�nuese, me orientim seksual apo materiale t� tjera q� dhunojn� ligjet n� fuqi. Ju pranoni q� webmasteri, administratori dhe moderator�t e {SITE_NAME} kan� t� drejt�t� fshijn� apo editojn� �do material n� �do koh� q� ata e gjykojn� t� arsyeshme. Si p�rdorues ju pranoni q� �do informacion q� keni futur m� sip�r ruhet n� nj� baz� t� dh�nash. Megjith�se k�to informacione nuk u transmetohen t� tret�ve pa miratimin tuaj, webmasteri ose administratori nuk mbajn� p�rgjegj�si p�r  tentativa piraterie kundrejt baz�s s� t�
dh�nave.<br />
<br />
Ky web site p�rdor cookies p�r t� ruajtur informacione n� kompiuterin tuaj. K�to cookies sh�rbejn� vet�m p�r t'jua b�r� sa m� t� k�naqsh�m shfletimin e k�tij albumi. Adresa juaj e-mail do t� p�rdoret vet�m p�r t� konfirmuar t� dh�nat e regjistrimit tuaj si dhe fjal�-kalimin.<br />
<br />
Duke klikuar tek 'Pranoj' k�tu m� posht� ju pranoni tu p�rmbaheni k�tyre kushteve.
EOT;

$lang_register_php = array(
        'page_title' => 'Regjistrim i p�rdoruesit',
        'term_cond' => 'Marrveshje dhe kushte',
        'i_agree' => 'Pranoj',
        'submit' => 'Paraqit regjistrimin',
        'err_user_exists' => 'Ky em�r p�rdoruesi q� ju fut�t �sht� i z�n�, ju lutemi t� zgjidhni nj� tjet�r',
        'err_password_mismatch' => 'Dy fjal�-kalimet nuk korrespondojn� nj�ra me tjetr�n, ju lutemi shkruajini p�rs�ri',
        'err_uname_short' => 'Emri i p�rdoruesit duhet t� ket� t� pakt�n dy shkronja',
        'err_password_short' => 'Fjal�-kalimi duhet t� ket� t� pakt�n dy shkronja',
        'err_uname_pass_diff' => 'Emri i p�rdoruesit dhe fjal�-kalimi duhet t� jen� t� ndrysh�m',
        'err_invalid_email' => 'Adresa e-mail nuk �sht� e vlefshme',
        'err_duplicate_email' => 'Nj� tjet�r p�rdorues �sht� regjistruar adres�n e-mail q� ju fut�t',
        'enter_info' => 'Fusni informacionin e regjistrimit',
        'required_info' => 'Information i detyruesh�m',
        'optional_info' => 'Information i padetyruesh�m',
        'username' => 'Emri i p�rdoruesit',
        'password' => 'Fjal�-kalimi',
        'password_again' => 'Rishkruaj fjal�-kalimin',
        'email' => 'Email',
        'location' => 'Vendndodhja',
        'interests' => 'Interesat',
        'website' => 'Faqe interneti',
        'occupation' => 'Profesioni',
        'error' => 'GABIM',
        'confirm_email_subject' => '%s - Konfirmim i regjistrimit',
        'information' => 'Informacion',
        'failed_sending_email' => 'Konfirmimi i regjistrimit nuk mund t� d�rgohet !',
        'thank_you' => 'Faleminderit p�r regjistrimin.<br /><br />Nj� e-mail me informacionin se si t�  aktivizoni llogarin� tuaj �sht� nisur n� adres�n q� ju na furnizuat.',
        'acct_created' => 'Llogaria juaj �sht� krijuar dhe ju tani mund t� identifikoheni me emrin e p�rdoruesit dhe fjal�-kalimin tuaj',
        'acct_active' => 'Llogaria juaj �sht� tashm� aktive dhe ju mund t� identifikoheni me emrin e p�rdoruesit dhe fjal�-kalimin tuaj',
        'acct_already_act' => 'Llogaria juaj �sht� tashm� aktive !',
        'acct_act_failed' => 'Kjo llogari nuk mund t� aktivizohet !',
        'err_unk_user' => 'P�rdoruesi i zgjedhur nuk ekziston !',
        'x_s_profile' => '%s\ profili',
        'group' => 'Grupe',
        'reg_date' => 'Regjistruar m�',
        'disk_usage' => 'P�rdorimi i diskut',
        'change_pass' => 'Nd�rro fjal�-kalimin',
        'current_pass' => 'Fjal�kalimi i tash�m',
        'new_pass' => 'Fjal�-kalimi i ri',
        'new_pass_again' => 'Fjal�-kalimi i ri p�rs�ri',
        'err_curr_pass' => 'Fjal�kalimi i tash�m nuk �sht� korrekt',
        'apply_modif' => 'Zbato ndryshimet',
        'change_pass' => 'Nd�rro fjal�-kalimin tim',
        'update_success' => 'Profili juaj u p�rdit�sua',
        'pass_chg_success' => 'Fjal�-kalimi juaj u ndryshua',
        'pass_chg_error' => 'Fjal�-kalimi juaj nuk u ndryshua',
                'notify_admin_email_subject' => '%s - Njoftim regjistrimi', //cpg1.3.0
                'notify_admin_email_body' => 'Nj� p�rdorues i ri me em�r p�rdoruesi "%s" �sht� regjistruar tek galeria juaj', //cpg1.3.0
);

$lang_register_confirm_email = <<<EOT
Faleminderit q� u regjistruat tek  {SITE_NAME}

Emri Juaj i p�rdorimit �sht� : "{USER_NAME}"
Fjal�-kalimi juaj �sht� : "{PASSWORD}"

Me q�llim q� t� aktivizoni llogarin� tuaj, ju duhet t� klikoni n� lidhjen e m�posht�me
ose kopjojeni at� dhe ngjiteni tek web vozit�si juaj.

{ACT_LINK}

P�rsh�ndetje,

Stafi i {SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
        'title' => 'Review comments',
        'no_comment' => 'K�tu nuk ka komente p�r t� par�',
        'n_comm_del' => '%s Komente t� fshira',
        'n_comm_disp' => 'Numri i komenteve p�r tu afishuar',
        'see_prev' => 'Shiko paraardh�sen',
        'see_next' => 'Shiko pasardh�sen',
        'del_comm' => 'Fshi komentet e zgjedhura',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
        0 => 'K�rko koleksionin fotografik',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
        'page_title' => 'K�rko fotografi t� reja',
        'select_dir' => 'Zgjidh dosjen',
        'select_dir_msg' => 'Ky funksion ju lejon t� shtoni nj� grumbull fotosh t� ngarkuara n� serverin tuajn�p�rmjet FTP.<br /><br />Zgjidh dosjen ku jan� ngarkuar fotografit�',
        'no_pic_to_add' => 'K�tu nuk ka fotografi p�r tu shtuar',
        'need_one_album' => 'Ju keni nevoj� p�r t� pakt�n nj� album p�r t� p�rdorur k�t� funksion',
        'warning' => 'Kujdes',
        'change_perm' => 'Skripti nuk mund t� shkruaj n� k�t� dosje, ju duhet t� ndryshoni lejimet n� 755 apo 777 para se t� provoni t� shtoni fotografi !',
        'target_album' => '<b>Kalo fotografit� e &quot;</b>%s<b>&quot; tek </b>%s',
        'folder' => 'Dosje',
        'image' => 'Imazh',
        'album' => 'Album',
        'result' => 'Resultat',
        'dir_ro' => 'E pashkrueshme. ',
        'dir_cant_read' => 'E palexueshme. ',
        'insert' => 'Shto fotografi t� reja tek galeria',
        'list_new_pic' => 'Lista e fotove t� reja',
        'insert_selected' => 'Shto fotografit� e zgjedhura',
        'no_pic_found' => 'Asnj� fotografi e re nuk u gjend',
        'be_patient' => 'Ju lutemi jini i duruar, skripti do koh� p�r t� shtuar fotografit�',
                'no_album' => 'asnj� album i zgjedhur',  //cpg1.3.0
        'notes' =>  '<ul>'.
                                '<li><b>OK</b> : do t� thot� q� fotografia u shtua me sukses'.
                                '<li><b>DP</b> : do t� thot� q� fotografia �sht� nj� dublikat� dhe ekziston tashm� baz�n e t� dh�nave'.
                                '<li><b>PB</b> : do t� thot� q� fotografia nuk mund t� shtohet, shiko konfigurimin dhe lejimet n� dosjen ku fotografit� jan� vendosur'.
                                '<li>N�se shenjat OK, DP, PB nuk duken kliko tek imazhi i prishur p�r t� par� ndonj� mesazh gabimesh t� dh�na nga PHP'.
                                '<li>N�se vozit�si juaj pushon s� funksionuari (timeout), kliko tek butoni i ringarkimit'.
                                '</ul>',
                'select_album' => 'Zgjidh albumin', //cpg1.3.0
        'check_all' => 'Sh�noji t� gjitha', //cpg1.3.0
        'uncheck_all' => 'Anulloji t� gjitha', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //

// Void



// ------------------------------------------------------------------------- //
// File banning.php
// ------------------------------------------------------------------------- //

if (defined('BANNING_PHP')) $lang_banning_php = array(
                'title' => 'P�rjashto p�rdoruesit',
                'user_name' => 'Emri i P�rdoruesit',
                'ip_address' => 'Adresa IP',
                'expiry' => 'Afati (i bardh� n�se p�rgjithmon�)',
                'edit_ban' => 'Ruaj ndryshimet',
                'delete_ban' => 'Fshi',
                'add_new' => 'Shto nj� ndalim t� ri',
                'add_ban' => 'Shto',
                                'error_user' => 'P�rduruesi nuk mund gjendet', //cpg1.3.0
                                  'error_specify' => 'Ju duhet t� specifikoni nj� p�rdorues ose adres� IP', //cpg1.3.0
                                  'error_ban_id' => 'ID e pavlefshme!', //cpg1.3.0
                                  'error_admin_ban' => 'Ju nuk mund t� ndaloni vehten tuaj!', //cpg1.3.0
                                  'error_server_ban' => 'Ju jeni duke ndaluar serverint tuaj? hej, mos e b�j� nj� gj� t� till�...', //cpg1.3.0
                                  'error_ip_forbidden' => 'Ju nuk mund t� ndaloni k�t� adres� IP pasi ajo nuk �sht� e specifikuar!', //cpg1.3.0
                                  'lookup_ip' => 'K�rko rrug�n e nj� adrese IP', //cpg1.3.0
                             'submit' => 'ec!', //cpg1.3.0
);
// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
  'title' => 'Ngarkoni fotografi', //cpg1.3.0
  'custom_title' => 'Furmular i k�rkuar i personalizuar', //cpg1.3.0
  'cust_instr_1' => 'Ju mund t� zgjidhni numrin e d�shiruar t� kutive t� ngarkimit. Sidoqoft� ju nuk mund t� zgjidhni m� shum� kuti nga sa lejohet k�tu m� posht�', //cpg1.3.0
  'cust_instr_2' => 'Numri i kutive t� k�rkuara', //cpg1.3.0
  'cust_instr_3' => 'Kutit� e ngarkimit t� fotografive: %s', //cpg1.3.0
  'cust_instr_4' => 'Kuti ngarkimi URI/URL : %s', //cpg1.3.0
  'cust_instr_5' => 'Kuti ngarkimi URI/URL:', //cpg1.3.0
  'cust_instr_6' => 'Kutit� e  ngarkimit t� fotografive:', //cpg1.3.0
  'cust_instr_7' => 'Luteni t� zgjidhni nj� num�r p�r �do tip kutie ngarkimi p�r k�t� moment.  Pastaj klikoni  \'Vazhdim\'. ', //cpg1.3.0
  'reg_instr_1' => 'Veprim i gabuar n� krijimin e formularit.', //cpg1.3.0
  'reg_instr_2' => 'Tash ju mund t� ngarkoni fotografi duke p�rdorur kutit e m�posht�me t� ngarkimit. Madh�sia e faileve t� ngarkuara n� server nuk duhet t� kaloj  %s KB secila. Faillet ZIP t� ngarkuara tek \'Ngarkim fotografish\' dhe \' Ngarkime URI/URL \' do t� ngelen t� kompresuara.', //cpg1.3.0
  'reg_instr_3' => 'N�se d�shironi q� faillet ZIP ose t� arkivuara t� dekompresohen, ju duhet t� p�rdorni kutin e ngarkimit tek zona \'Ngarkim ZIP t� dekompresueshme\' .', //cpg1.3.0
  'reg_instr_4' => 'Kur p�rdor seksioni ngarkime URI/URL, luteni t� fusni adres� ku ndodhet failli ose fotografia sipas form�s : http://www.mysite.com/images/example.jpg', //cpg1.3.0
  'reg_instr_5' => 'Sapo t� keni plot�suar formularin, klikoni \'VAZHDIM\'.', //cpg1.3.0
  'reg_instr_6' => 'Ngarkime ZIP t� dekompresueshme:', //cpg1.3.0
  'reg_instr_7' => 'Ngarkim fotografish:', //cpg1.3.0
  'reg_instr_8' => 'Ngarkime URI/URL :', //cpg1.3.0
  'error_report' => 'Raport gabimi', //cpg1.3.0
  'error_instr' => 'Ngarki i radh�s ka hasur n� nj� gabim:', //cpg1.3.0
  'file_name_url' => 'Emri i faillit/URL', //cpg1.3.0
  'error_message' => 'Masazh gabimi', //cpg1.3.0
  'no_post' => 'Fotografie e pa ngarkuar nga POST.', //cpg1.3.0
  'forb_ext' => 'Ekstensioni i fotografis� nuk �sht� i lejuar.', //cpg1.3.0
  'exc_php_ini' => 'Tejaklim i madh�sis� s� dokumentit t� lejuar sipas php.ini.', //cpg1.3.0
  'exc_file_size' => 'Tejaklim i madh�sis� s� dokumentit t� lejuar sipas CPG.', //cpg1.3.0
  'partial_upload' => 'Vet�m nj� ngarkim i pjes�sh�m.', //cpg1.3.0
  'no_upload' => 'Ngarkimi nuk u krye.', //cpg1.3.0
  'unknown_code' => 'Kod i gabuar ngarkimi PHP i panjohur.', //cpg1.3.0
  'no_temp_name' => 'Nuk ka ngarkim - Nuk ekziston nj� dosje e p�rkoh�shme.', //cpg1.3.0
  'no_file_size' => 'Nuk p�rmban t� dh�na /E korruptuar', //cpg1.3.0
  'impossible' => 'E pamundur t� zhvendoset.', //cpg1.3.0
  'not_image' => 'Nuk ka imazh/Korruptuar', //cpg1.3.0
  'not_GD' => 'Nuk �sht� nj� ekstension GD.', //cpg1.3.0
  'pixel_allowance' => 'Tejkalim i pikseleve t� lejueshme.', //cpg1.3.0
  'incorrect_prefix' => 'Prefiks URI/URL i gabuar', //cpg1.3.0
  'could_not_open_URI' => 'Adresa URI nuk hapet.', //cpg1.3.0
  'unsafe_URI' => 'Siguria e pav�rtetueshme.', //cpg1.3.0
  'meta_data_failure' => 'Gabim i t� dh�na Meta', //cpg1.3.0
  'http_401' => '401 I paautorizuar', //cpg1.3.0
  'http_402' => '402 duhet paguar', //cpg1.3.0
  'http_403' => '403 Ndalohet', //cpg1.3.0
  'http_404' => '404 Nuk gjendet', //cpg1.3.0
  'http_500' => '500 Gabim i brend�sh�m i serverit', //cpg1.3.0
  'http_503' => '503 Servis i padisponuesh�m', //cpg1.3.0
  'MIME_extraction_failure' => 'Tipi MIME i pavendosur.', //cpg1.3.0
  'MIME_type_unknown' => 'Tip MIME i panjohur', //cpg1.3.0
  'cant_create_write' => 'Nuk mund t� krijohet fail e regjistrueshme.', //cpg1.3.0
  'not_writable' => 'Nuk mund t� shkruhet n� skedar.', //cpg1.3.0
  'cant_read_URI' => 'Nuk mund t� lexohet adresa URI/URL', //cpg1.3.0
  'cant_open_write_file' => 'Nuk mund t� hapet adresa URI.', //cpg1.3.0
  'cant_write_write_file' => 'Nuk mund t� shkruaht tek adresa URI.', //cpg1.3.0
  'cant_unzip' => 'Dekompresion i pamundur .', //cpg1.3.0
  'unknown' => 'Gabim i panjohur', //cpg1.3.0
  'succ' => 'Ngarkim i suksessh�m', //cpg1.3.0
  'success' => '%s ngarkim(e) kan� qen� t� suksesshme.', //cpg1.3.0
  'add' => 'Klikoni  \'VAZHDIM\' p�r t� futur fotografit� n� album.', //cpg1.3.0
  'failure' => 'Ngarkim i d�shtuar', //cpg1.3.0
  'f_info' => 'Indormacion i dokumentit ose fotos.', //cpg1.3.0
  'no_place' => 'Fotografia e m�par�shme nuk mund t� vendoset.', //cpg1.3.0
  'yes_place' => 'Fotografia e m�par�shme u vendos me sukses.', //cpg1.3.0
  'max_fsize' => 'Maksimi i madh�sis� s� fotografive q� lejohet �sht� %s KB',
  'album' => 'Albumi',
  'picture' => 'Foto', //cpg1.3.0
  'pic_title' => 'Titulli i fotografis�', //cpg1.3.0
  'description' => 'P�rshkrimi i fotografis�', //cpg1.3.0
  'keywords' => 'Fjal� ky� (t� ndara me hapsira)',
  'err_no_alb_uploadables' => 'Na vjen� keq por nuk ka ndonj� album ku tu lejohet ngarkimi i fotografive', //cpg1.3.0
  'place_instr_1' => 'Tani, luteni ti vendosni fotografit� n� albume. Ju mund t� shtoni informacione t� m�tejshme p�r �donj� nga fotografit�.', //cpg1.3.0
  'place_instr_2' => 'Fotografi t� tjera presin t� vendosen n� albume. Klikoni \'VAZHDIM\'.', //cpg1.3.0
  'process_complete' => 'Ju i keni vendosur me sukses t� gjitha fotografit�.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
        'title' => 'Menaxhoni p�rdoruesit',
        'name_a' => 'Emrat n� ngjitje',
        'name_d' => 'Emrat n� zbritje',
        'group_a' => 'Grupe n� ngjitje',
        'group_d' => 'Grupe n� zbritje',
        'reg_a' => 'Data e regjistrimit n� ngjitje',
        'reg_d' => 'Data e regjistrimit n� zbritje',
        'pic_a' => 'Numri i fotove n� ngjitje',
        'pic_d' => 'Numri i fotove n� zbritje',
        'disku_a' => 'Harxhimi i diskut n� ngjitje',
        'disku_d' => 'Harxhimi i diskut n� zbritje',
                'lv_a' => 'Vizita e fundit n� ngjitje', //cpg1.3.0
        'lv_d' => 'Vizita e funditn� zbritje', //cpg1.3.0
        'sort_by' => 'Renditi p�rdoruesit sipas',
        'err_no_users' => 'Tabela e p�rdoruesit �sht� bosh !',
        'err_edit_self' => 'Ju nuk mund t� editoni profilin tuaj, kliko tek lidhja \'Profili im\' p�r t� b�r ndryshime n� t�',
        'edit' => 'EDITO',
        'delete' => 'FSHI',
        'name' => 'Emri i p�rdoruesit',
        'group' => 'Grupi',
        'inactive' => 'Jo aktiv',
        'operations' => 'Veprime',
        'pictures' => 'Fotografi',
        'disk_space' => 'Hapsira e p�rdorur / Kuota',
        'registered_on' => 'Regjistruar m�',
        'u_user_on_p_pages' => '%d p�rdorues n� %d faqe',
        'confirm_del' => 'Jeni i sigurt q� d�shironi t� FSHINIk�t� p�rdorues ? \\nT� gjitha fotografit� dhe albumet do t� jen� gjithashtu t� fshira.',
        'mail' => 'E-MAIL',
        'err_unknown_user' => 'P�rdoruesi i zgjedhur nuk ekziston !',
        'modify_user' => 'Modifiko p�rdoruesin',
        'notes' => 'Sh�nime',
        'note_list' => '<li>N�se ju nuk d�shironi t� ndryshoni fjal�-kalimin, l�reni fush�n "fjal�-kalim" t� bardh�.',
                'password' => 'Fjal�-kalimi',
        'user_active' => 'P�rdoruesi �sht� aktiv',
        'user_group' => 'Grup p�rdoruesash',
        'user_email' => 'E-maili i p�rdoruesit',
        'user_web_site' => 'Web siti i p�rdoruesit',
        'create_new_user' => 'Krijo nj� p�rdorues t� ri',
        'user_location' => 'Vendndodhja e p�rdoruesit',
        'user_interests' => 'Interesate p�rdoruesit',
        'user_occupation' => 'Profesioni i p�rdoruesit',
                'latest_upload' => 'Ngarkimet m� t� fundit', //cpg1.3.0
        'never' => 'kurr', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => 'Ridimensiono fotografit�',
        'what_it_does' => 'Funksionet',
        'what_update_titles' => 'P�rdit�so titullin duke u nisur nga emri i dosjes',
        'what_delete_title' => 'Fshi titullin',
        'what_rebuild' => 'Rind�rto tablot� dhe fotografit� e ridimensionuara',
        'what_delete_originals' => 'Fshi fotografit� me dimensione origjinale duke i zvend�suar ato me versionin e ridimensionuar',
        'file' => 'File',
        'title_set_to' => 'titulli i nd�rruar n�',
        'submit_form' => 'Paraqit',
        'updated_succesfully' => 'p�rdit�suar me sukses',
        'error_create' => 'GABIM p�rgjat� krijimit',
        'continue' => 'Vazhdoni me m� shum� imazhe',
        'main_success' => 'Ky dokument (imazh) %s �sht� p�rdorur tash si imazhi kryesor',
        'error_rename' => 'Gabim gjat� ndryshimit t� emrit t� %s n� %s',
        'error_not_found' => 'Dokumenti %s nuk u gjend',
        'back' => 'kthim tek faqja kryesore',
        'thumbs_wait' => 'P�rdit�sim i tablove dhe/ose imazheve t� ridemensionuara, ju lutemi prisni...',
        'thumbs_continue_wait' => 'Vazhdim i p�rdit�simit t�btablove dhe/ose imazheve t� ridemensionuara ...',
        'titles_wait' => 'P�rdit�sim i titujve, ju lutemi prisni...',
        'delete_wait' => 'Fshirje e titujve, ju lutemi prisni...',
        'replace_wait' => 'Fshirje e origjinal�ve dhe zvend�sim i tyre me imazhe t� ridimensionuara, ju lutemi prisni..',
        'instruction' => 'Instrucsione t� shpejta',
        'instruction_action' => 'Zgjidhni nj� veprim',
        'instruction_parameter' => 'P�rkufizoni parametrat',
        'instruction_album' => 'Zgjidh albumin',
        'instruction_press' => 'Shtyp %s',
        'update' => 'Perdit�so tablot dhe/ose fotografit� e ridimensionuara',
        'update_what' => '�far� duhet t� p�rdit�sohet',
        'update_thumb' => 'Vet�m tablot',
        'update_pic' => 'Vet�m fotografit� e ridimensionuara',
        'update_both' => 'Edhe tablot� edhe fotografit� e ridimensionuara',
        'update_number' => 'Numri i fotografive t� trajtuara me nje klik',
        'update_option' => '(Mundohuni ta zvog�loni k�t� vler� n�se kini probleme me timeout)',
        'filename_title' => 'Emri i dokumentit / Titulli i fotografis�',
        'filename_how' => 'Si duhet modifikuar emri i dokumentit',
        'filename_remove' => 'Ndryshoni fundin .jpg duke e zvend�suar me _ (underscore) me hapsira',
        'filename_euro' => 'Nd�rro 2003_11_23_13_20_20.jpg me 23/11/2003 13:20',
        'filename_us' => 'Nd�rro 2003_11_23_13_20_20.jpg me 11/23/2003 13:20',
        'filename_time' => 'Nd�rro 2003_11_23_13_20_20.jpg me 13:20',
        'delete' => 'Fshi titullin e fotografis� ose p�rmasat origjinale t� saj',
        'delete_title' => 'Fshi titullin e fotografis�',
        'delete_original' => 'Fshi p�rmasat origjinale t� fotografos�',
        'delete_replace' => 'Fshi imazhin origjinal duke e zvend�suar me versionin e ridimensionuar',
        'select_album' => 'Zgjidh albumin',
                'delete_orphans' => 'Fshi komentet jetim� (Kjo vlen� p�r t� gjith� albumet)', //cpg1.3.0
                  'orphan_comment' => 'Komente jetim t� gjetura', //cpg1.3.0
                  'delete' => 'Fshi', //cpg1.3.0
                  'delete_all' => 'Fshi t� gjitha', //cpg1.3.0
                  'comment' => 'Koment: ', //cpg1.3.0
                  'nonexist' => 'Bashkuar n� nj� dokument q� nuk ekziston # ', //cpg1.3.0
                  'phpinfo' => 'Shfaq phpinfo', //cpg1.3.0
                  'update_db' => 'P�rdit�so baz�n e t� dh�nave', //cpg1.3.0
                  'update_db_explanation' => 'N�se ju keni zvend�suar skedaret copermine, n�se keni shtuar, modifikuar apo p�rdit�suarnga versionet e m�par�shme t� copermine, sigurohuni t� instaloni versionin upgrade t� baz�s s� t� dh�nave. Kjo krijon tabelat e nevoj�shme dhe konfiguron baz�n tuaj t� t� dh�nave copermine.', //cpg1.3.0
);

?>
