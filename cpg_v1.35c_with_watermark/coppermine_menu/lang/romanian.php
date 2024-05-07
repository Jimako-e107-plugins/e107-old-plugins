<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.4.0                                            //
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
// $Id: romanian.php,v 1.7 2004/12/29 23:03:46 chtito Exp $
// ------------------------------------------------------------------------- //

// informa�ii despre traducere �i traduc�tor
$lang_translation_info = array(
        'lang_name_english' => 'Romanian',
        'lang_name_native' => 'Rom�n�',
        'lang_country_code' => 'ro',
        'trans_name'=> 'Adrian Stan',
        'trans_email' => 'adi.stan@gmail.com',
        'trans_website' => '',
        'trans_date' => '2004-08-01',
);

$lang_charset = 'iso-8859-2';
$lang_text_dir = 'ltr'; // ('ltr' stanga la dreapta, 'rtl' dreapta la stanga)

// prescurt�ri pentru Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');

// zilele s�pt�m�nii �i ale lunii
$lang_day_of_week = array('Du', 'Lu', 'Ma', 'Mi', 'Joi', 'Vi', 'S�');
$lang_month = array('Ian', 'Feb', 'Mar', 'Apr', 'Mai', 'Iun', 'Iul', 'Aug', 'Sep', 'Oct', 'Noi', 'Dec');

// Comune
$lang_yes = 'Da';
$lang_no  = 'Nu';
$lang_back = '�napoi';
$lang_continue = 'Continu�';
$lang_info = 'Informa�ii';
$lang_error = 'Eroare';

// Data
$album_date_fmt =    '%d %B %Y';
$lastcom_date_fmt =  '%d/%m/%Y la %H:%M';
$lastup_date_fmt = '%d %B %Y';
$register_date_fmt = '%d %B %Y';
$lasthit_date_fmt = '%d %B %Y la %H:%M';
$comment_date_fmt =  '%d %B %Y la %H:%M';

// Cenzor cuvinte
$lang_bad_words = array('*fuck*', 't�mpit', 'tampit', 'cretin', 'idiot', 'muie',  'pizda', 'pizd�', 'pula', 'pul�', 'sugi', 'coaie', 'cur', 'buci', 'cacat', 'c�cat', 'caca', 'pewla', 'fut', 'futai', 'jepat');

$lang_meta_album_names = array(
        'random' => 'Imagini aleatoare',
        'lastup' => 'Ultimele ad�ugate',
        'lastalb'=> 'Ultimele albume modificate',
        'lastcom' => 'Ultimele comentarii',
        'topn' => 'Cele mai vizitate',
        'toprated' => 'Cele mai votate',
        'lasthits' => 'Ultimele vizitate',
        'search' => 'Rezultatele c�ut�rii',
        'favpics'=> 'Imaginile favorite'
);

$lang_errors = array(
        'access_denied' => 'Nu ave�i dreptul s� accesa�i aceasta pagin�.',
        'perm_denied' => 'Nu ave�i dreptul s� efectua�i aceast� opera�ie',
        'param_missing' => 'Scriptul a fost rulat f�r� parametrul/parametrii necesari.',
        'non_exist_ap' => 'Albumul/imaginea selectat� nu exist�!',
        'quota_exceeded' => 'Cota dumneavoastr� a fost depa�it�<br /><br />Ave�i o cot� pe disc de [quota]K, pozele dumneavoastr� ocup� acum [space]K, ad�ug�nd aceast� imagine ve�i dep�i aceast� cot�.',
        'gd_file_type_err' => 'C�nd folosi�i biblioteca GD tipurile de fi�iere ce le pute�i utiliza sunt doar JPEG �i PNG.',
        'invalid_image' => 'Imaginea �nregistrat� de dumneavoastr� este corupt� sau nu poate fi prelucrat� de biblioteca GD',
        'resize_failed' => 'Nu s-a putut crea pictograma sau imaginea redus�.',
        'no_img_to_display' => 'Nici o imagine �nc�rcat�',
        'non_exist_cat' => 'Categoria selectat� nu exist�',
        'orphan_cat' => 'O categorie are p�rintele inexistent, rula�i managerul de categorii pentru a corecta problema.',
        'directory_ro' => 'Directorul \'%s\' nu poate fi scris, imaginile nu pot fi �terse',
        'non_exist_comment' => 'Comentariul selectat nu exist�.',
        'pic_in_invalid_album' => 'Imaginea este �ntr-un album inexistent (%s)!?',
        'banned' => 'Sunte�i exclus de pe aceast� pagina web.',
        'not_with_udb' => 'Aceasta func�ie este blocat� deoarece este integrat� cu programul ce ruleaza forumul. Ce �ncerca�i s� face�i ori nu este suportat �n aceast� configura�ie, ori func�ia trebuie executat� de programul ce ruleaza forumul.',
        'offline_title' => 'Offline',
        'offline_text' => 'Galeria este oprit�, v� rug�m s� reveni�i peste c�teva minute.',
        'ecards_empty' => 'Nu sunt vederi electonice de vizualizat. Verifica�i dac� ave�i op�iunea pentru vederi electronice activat�.',
        'action_failed' => 'Ac�iune e�uat�. Nu se poate procesa cererea dumneavoastr�.',
        'no_zip' => 'Libr�ria pentru fi�iere ZIP nu exist�.',
        'zip_type' => 'Nu ave�i dreptul s� �nc�rca�i fi�iere ZIP.',
);

$lang_bbcode_help = 'Urm�toarele coduri v� pot fi utile: <li>[b]<b>Bold</b>[/b]</li> <li>[i]<i>Italic</i>[/i]</li> <li>[url=http://site.ro/]Url Text[/url]</li> <li>[email]user@site.ro[/email]</li>';

// ------------------------------------------------------------------------- //
// theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
        'alb_list_title' => 'Albume',
        'alb_list_lnk' => 'Albume',
        'my_gal_title' => 'Galeria mea',
        'my_gal_lnk' => 'Galeria mea',
        'my_prof_lnk' => 'Profilul meu',
        'adm_mode_title' => 'Schimba�i �n modul admin',
        'adm_mode_lnk' => 'Mod admin',
        'usr_mode_title' => 'Schimba�i �n modul utilizator',
        'usr_mode_lnk' => 'Mod utilizator',
        'upload_pic_title' => '�nc�rca�i imagine',
        'upload_pic_lnk' => '�nc�rca�i imagine',
        'register_title' => 'Crea�i un cont',
        'register_lnk' => '�nregistrare',
        'login_lnk' => 'Login',
        'logout_lnk' => 'Logout',
        'lastup_lnk' => 'Ultimele imagini',
        'lastcom_lnk' => 'Ultimele comentarii',
        'topn_lnk' => 'Top vizite',
        'toprated_lnk' => 'Top vot�ri',
        'search_lnk' => 'C�utare',
        'fav_lnk' => 'Favoritele mele',
        'memberlist_title' => 'Lista membrilor', //cpg1.3.0
        'memberlist_lnk' => 'Membrii', //cpg1.3.0
        'faq_title' => '�ntreb�ri frecvente', //cpg1.3.0
        'faq_lnk' => 'FAQ', //cpg1.3.0
);

$lang_gallery_admin_menu = array(
        'upl_app_lnk' => 'Aprobare �nregistr�ri',
        'config_lnk' => 'Configurare',
        'albums_lnk' => 'Albume',
        'categories_lnk' => 'Categorii',
        'users_lnk' => 'Utilizatori',
        'groups_lnk' => 'Grupuri',
        'comments_lnk' => 'Comentarii',
        'searchnew_lnk' => 'Ad�uga�i imagini FTP',
        'util_lnk' => 'Redimensiona�i imagini',
        'ban_lnk' => 'Bana�i utilizatori',
        'db_ecard_lnk' => 'Arat� vederi electronice', //cpg1.3.0
);

$lang_user_admin_menu = array(
        'albmgr_lnk' => 'Crea�i/ordona�i albumele mele',
        'modifyalb_lnk' => 'Modifica�i albumele mele',
        'my_prof_lnk' => 'Profilul meu',
);

$lang_cat_list = array(
        'category' => 'Categorie',
        'albums' => 'Albume',
        'pictures' => 'Imagini',
);

$lang_album_list = array(
        'album_on_page' => '%d albume pe %d pagini'
);

$lang_thumb_view = array(
        'date' => 'Data',
        //Sort by filename and title
        'name' => 'Numele fi�ierului',
        'title' => 'Titlul',
        'sort_da' => 'Sortare dupa dat�, ascendent',
        'sort_dd' => 'Sortare dupa dat�, descendent',
        'sort_na' => 'Sortare dupa nume, ascendent',
        'sort_nd' => 'Sortare dupa nume, ascendent',
        'sort_ta' => 'Sortare dupa titlu, ascendent',
        'sort_td' => 'Sortare dupa titlu, ascendent',
        'download_zip' => 'Descarc� ca fi�ier ZIP',
        'pic_on_page' => '%d imagini pe %d pagini',
        'user_on_page' => '%d utilizatori pe %d pagini'
);

$lang_img_nav_bar = array(
        'thumb_title' => '�napoi la pagina cu pictograme',
        'pic_info_title' => 'Afi�are/Ascundere informa�ii despre imagine',
        'slideshow_title' => 'Diaporama',
        'ecard_title' => 'Trimite�i aceast� imagine ca vedere electronic�',
        'ecard_disabled' => 'Vederile electronice sunt dezactivate',
        'ecard_disabled_msg' => 'Nu ave�i permisiunea s� trimite�i vederi electronice',
        'prev_title' => 'Vizualiza�i imaginea precedent�',
        'next_title' => 'Vizualiza�i imaginea urm�toare',
        'pic_pos' => 'Imaginea %s/%s',
);

$lang_rate_pic = array(
        'rate_this_pic' => 'Voteaz� aceast� imagine ',
        'no_votes' => '(Nici un vot �nc�)',
        'rating' => '(votarea curent� : %s / 5 cu %s voturi)',
        'rubbish' => 'Nereu�it�',
        'poor' => 'Slab�',
        'fair' => 'Acceptabil�',
        'good' => 'Bun�',
        'excellent' => 'Excelent�',
        'great' => 'Nemaipomenit�',
);

// ------------------------------------------------------------------------- //
// include/exif.inc.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// include/functions.inc.php
// ------------------------------------------------------------------------- //

$lang_cpg_die = array(
        INFORMATION => $lang_info,
        ERROR => $lang_error,
        CRITICAL_ERROR => 'Eroare critic�',
        'file' => 'Fi�ier: ',
        'line' => 'Linia: ',
);

$lang_display_thumbnails = array(
        'filename' => 'Nume fi�ier : ',
        'filesize' => 'M�rime fi�ier : ',
        'dimensions' => 'Dimensiuni : ',
        'date_added' => 'Data ad�ug�rii : ',
);

$lang_get_pic_data = array(
        'n_comments' => '%s comentarii',
        'n_views' => '%s vizit�ri',
        'n_votes' => '(%s voturi)'
);

$lang_cpg_debug_output = array(
  'debug_info' => 'Debug Info', //cpg1.3.0
  'select_all' => 'Selecteaz� tot', //cpg1.3.0
  'copy_and_paste_instructions' => 'Dac� dori�i s� ne cere�i ajutorul, copia�i �i trimite�i aceast� eroare �n comentariul dumneavostr�. Asigura�i-v� c� �nlocui�i orice parol� din mesajul dumneavostr� cu *** �nainte de a trimite.', //cpg1.3.0
  'phpinfo' => 'Arat� phpinfo', //cpg1.3.0
);

$lang_language_selection = array(
  'reset_language' => 'Limba predefinit�', //cpg1.3.0
  'choose_language' => 'Alege�i limba', //cpg1.3.0
);

$lang_theme_selection = array(
  'reset_theme' => 'Tema predefinit�', //cpg1.3.0
  'choose_theme' => 'Alege�i tema', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// include/init.inc.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// include/picmgmt.inc.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// include/smilies.inc.php
// ------------------------------------------------------------------------- //

if (defined('SMILIES_PHP')) $lang_smilies_inc_php = array(
        'Exclamation' => 'Exclamare',
        'Question' => '�ntrebare',
        'Very Happy' => 'Foarte bucuros',
        'Smile' => 'Z�mbe�te',
        'Sad' => 'Sup�rat',
        'Surprised' => 'Surprins',
        'Shocked' => '�ocat',
        'Confused' => 'Confuz',
        'Cool' => 'Cool',
        'Laughing' => 'R�z�nd',
        'Mad' => 'Nervos',
        'Razz' => 'Razz',
        'Embarassed' => 'St�njenit',
        'Crying or Very sad' => 'Pl�ng�nd sau foarte sup�rat',
        'Evil or Very Mad' => 'R�u sau foarte sup�rat',
        'Twisted Evil' => 'Foarte r�u',
        'Rolling Eyes' => 'Rostogolind ochii',
        'Wink' => 'Clipe�te',
        'Idea' => 'Idee',
        'Arrow' => 'S�geat�',
        'Neutral' => 'Neutru',
        'Mr. Green' => 'Dl. Verde',
);

// ------------------------------------------------------------------------- //
// addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
        0 => 'P�r�se�te modul administrator...',
        1 => 'Intr� �n modul administrator...',
);

// ------------------------------------------------------------------------- //
// albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
        'alb_need_name' => 'Albumele trebuie s� aib� un nume!',
        'confirm_modifs' => 'Sunte�i sigur c� vre�i s� face�i aceste modific�ri?',
        'no_change' => 'Nu a�i f�cut nici o modificare!',
        'new_album' => 'Album nou',
        'confirm_delete1' => 'Sunte�i sigur c� vre�i sa �terge�i acest album?',
        'confirm_delete2' => '\nToate imaginile �i comentariile con�inute vor fi pierdute!',
        'select_first' => 'Selecta�i un album �nainte',
        'alb_mrg' => 'Managerul de albume',
        'my_gallery' => '* Galeria mea *',
        'no_category' => '* Nici o categorie *',
        'delete' => '�terge',
        'new' => 'Nou',
        'apply_modifs' => 'Efectua�i modific�rile',
        'select_category' => 'Selecta�i o categorie',
);

// ------------------------------------------------------------------------- //
// catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
        'miss_param' => 'Parametrii necesari pentru opera�ia \'%s\' nu au fost stabili�i!',
        'unknown_cat' => 'Categoria selectat� nu exist� �n baza de date',
        'usergal_cat_ro' => 'Categoria Galeria Utilizatorului nu poate fi �tears�!',
        'manage_cat' => 'Administra�i categoriile',
        'confirm_delete' => 'Sunte�i sigur c� dori�i s� �terge�i aceast� categorie?',
        'category' => 'Categorie',
        'operations' => 'Opera�ii',
        'move_into' => 'Muta�i �n',
        'update_create' => 'Modifica�i/Crea�i o categorie',
        'parent_cat' => 'Categoria p�rinte',
        'cat_title' => 'Titlul categoriei',
        'cat_thumb' => 'Categoria pictogramei', //cpg1.3.0
        'cat_desc' => 'Descrierea categoriei'
);

// ------------------------------------------------------------------------- //
// config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
        'title' => 'Configurare',
        'restore_cfg' => 'Reveni�i la set�rile predefinite',
        'save_cfg' => 'Salva�i noua configura�ie',
        'notes' => 'Note',
        'info' => 'Informa�ii',
        'upd_success' => 'Configura�ia a fost modificat�',
        'restore_success' => 'Configura�ia predefinit� a fost restabilit�',
        'name_a' => 'Nume ascendent',
        'name_d' => 'Nume descendent',
        'title_a' => 'Titlu ascendent',
        'title_d' => 'Titlu descendent',
        'date_a' => 'Dat� ascendent�',
        'date_d' => 'Dat� descendent�',
        'th_any' => 'Aspect maxim',
        'th_ht' => '�n�l�ime',
        'th_wd' => 'L��ime',
        'label' => 'etichet�', //cpg1.3.0
        'item' => 'articol', //cpg1.3.0
        'debug_everyone' => 'Oricine', //cpg1.3.0
        'debug_admin' => 'Doar administratorul', //cpg1.3.0
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
        'Set�ri generale',
        array('Numele galeriei', 'gallery_name', 0),
        array('Descrierea galeriei', 'gallery_description', 0),
        array('Adresa e-mail a administratorului', 'gallery_admin_email', 0),
        array('Adresa pentru conexiunea \'Mai multe imagini la\' �n vederile electronice', 'ecards_more_pic_target', 0),
        array('Galerie oprit�', 'offline', 1), //cpg1.3.0
        array('Log vederi electronice', 'log_ecards', 1), //cpg1.3.0
        array('Permite desc�rcarea favoritelor ca fi�ier ZIP', 'enable_zipdownload', 1), //cpg1.3.0

        'Limba, Teme &amp; Set�ri caractere',
        array('Limba', 'lang', 5),
        array('Tema', 'theme', 6),
        array('Arat� lista limbilor', 'language_list', 1), //cpg1.3.0
        array('Arat� steagurile limbilor', 'language_flags', 8), //cpg1.3.0
        array('Arat� op�iunea &quot;reseteaz�&quot; �n sec�iunea limbilor', 'language_reset', 1), //cpg1.3.0
        array('Arat� lista temelor', 'theme_list', 1), //cpg1.3.0
        array('Arat� op�iunea &quot;reseteaz�&quot; �n sec�iunea temelor', 'theme_reset', 1), //cpg1.3.0
        array('Arat� FAQ', 'display_faq', 1), //cpg1.3.0
        array('Arat� ajutor bbcode', 'show_bbcode_help', 1), //cpg1.3.0
        array('Caracter', 'charset', 4), //cpg1.3.0

        'Lista cu albume',
        array('L��imea tabelului principal (pixeli sau %)', 'main_table_width', 0),
        array('Num�rul de nivele de categorii care s� fie afi�ate', 'subcat_level', 0),
        array('Num�rul albumelor ce vor fi afi�ate', 'albums_per_page', 0),
        array('Num�rul de coloane �n lista de albume', 'album_list_cols', 0),
        array('Dimensiunea pictogramelor �n pixeli', 'alb_list_thumb_size', 0),
        array('Con�inutul paginii principale', 'main_page_layout', 0),
        array('Afi�eaz� pictogramele albumelor din primul nivel �n categorii','first_level',1),

        'Pictograme',
        array('Num�rul de coloane pe pagina cu pictograme', 'thumbcols', 0),
        array('Num�rul de r�nduri pe pagina cu pictograme', 'thumbrows', 0),
        array('Numarul maxim de taburi ce vor fi afi�ate', 'max_tabs', 0),
        array('Afi�eaz� descrierea imaginii (pe l�ng� titlu) sub pictogram�', 'caption_in_thumbview', 1),
        array('Afi�eaz� num�rul de vizualizari sub pictogram�', 'views_in_thumbview', 1), //cpg1.3.0
        array('Afi�eaz� num�rul de comentarii sub pictogram�', 'display_comment_count', 1),
        array('Afi�eaz� numele utilizatorului sub pictogram�', 'display_uploader', 1), //cpg1.3.0
        array('Ordinea de sortare a imaginilor predefinit�', 'default_sort_order', 3),
        array('Num�rul minim de voturi pentru ca o imagine s� apar� �n lista \'Cele mai votate\' ', 'min_votes_for_rating', 0),

        'Afi�area imaginii &amp; set�rile comentariilor',
        array('L��imea tabelului pentru afi�area imaginii (pixeli sau %)', 'picture_table_width', 0),
        array('Informa�iile despre imagine sunt vizibile �n mod predefinit', 'display_pic_info', 1),
        array('Filtra�i cuvintele ur�te �n comentarii', 'filter_bad_words', 1),
        array('Activeaz� z�mbetele �n comentarii', 'enable_smilies', 1),
        array('Permite comentarii consecutive de la acela�i utilizator', 'disable_comment_flood_protect', 1), //cpg1.3.0
        array('Lungimea maxim� a descrierii imaginii', 'max_img_desc_length', 0),
        array('Num�rul maxim de caractere �ntr-un cuv�nt', 'max_com_wlength', 0),
        array('Num�rul maxim de linii �ntr-un comentariu', 'max_com_lines', 0),
        array('Lungimea maxim� a unui comentariu', 'max_com_size', 0),
        array('Afi�eaz� rama film', 'display_film_strip', 1),
        array('Num�rul de obiecte �n rama film', 'max_film_strip_items', 0),
        array('Notific� administratorul despre comentarii prin email', 'email_comment_notification', 1), //cpg1.3.0
        array('Intervalul diaporamei �n milisecunde (1 secund� = 1000 milisecunde)', 'slideshow_interval', 0), //cpg1.3.0

        'Set�ri pentru imagini �i pictograme',
        array('Calitatea fi�ierelor JPEG', 'jpeg_qual', 0),
        array('Dimensiunea maxim� a unei pictograme <a href="#notice2"  class="clickable_option">**</a>', 'thumb_width', 0), //cpg1.3.0
        array('Utiliza�i dimensiunea (l��ime sau �n�l�ime sau aspectul maxim pentru pictogram� )<b>**</b>', 'thumb_use', 7),
        array('Creaz� imagini intermediare','make_intermediate',1),
        array('L��imea sau �n�l�imea maxim� a unei imagini intermediare <a href="#notice2" class="clickable_option">**</a>', 'picture_width', 0), //cpg1.3.0
        array('Dimensiunea maxim� a unei imagini (KB)', 'max_upl_size', 0),
        array('L��ime� sau �n�l�imea maxim� a imaginilor �nc�rcate (pixeli)', 'max_upl_width_height', 0),

        'Set�ri avansate pentru imagini si pictograme', //cpg1.3.0
        array('Afi�eaz� icoana Privat utilizatorilor ne�nregistra�i','show_private',1), //cpg1.3.0
        array('Caractere interzise �n numele de fi�iere', 'forbiden_fname_char',0), //cpg1.3.0
        array('Extensii acceptate pentru fi�ierele �nc�rcate', 'allowed_file_extensions',0), //cpg1.3.0
        array('Tipuri de imagini permise', 'allowed_img_types',0), //cpg1.3.0
        array('Tipuri de video permise', 'allowed_mov_types',0), //cpg1.3.0
        array('Tipuri de audio permise', 'allowed_snd_types',0), //cpg1.3.0
        array('Tipuri de documente permise', 'allowed_doc_types',0), //cpg1.3.0
        array('Metoda de redimensionare a imaginilor','thumb_method',2), //cpg1.3.0
        array('Calea c�tre utilitarul \'convert\' al lui ImageMagick)', 'impath', 0), //cpg1.3.0
        array('Tipuri de imagini permise (valid doar pentru ImageMagick)', 'allowed_img_types',0), //cpg1.3.0
        array('Op�iuni �n linie de comand� pentru ImageMagick', 'im_options', 0), //cpg1.3.0
        array('Cite�te informa�iile EXIF din fi�ierele JPEG', 'read_exif_data', 1), //cpg1.3.0
        array('Cite�te informa�iile IPTC din fi�ierele JPEG', 'read_iptc_data', 1), //cpg1.3.0
        array('Directorul cu albume <a href="#notice1" class="clickable_option">*</a>', 'fullpath', 0), //cpg1.3.0
        array('Directorul pentru imaginile utilizatorilor <a href="#notice1" class="clickable_option">*</a>', 'userpics', 0), //cpg1.3.0
        array('Prefixul pentru imaginile intermediare <a href="#notice1" class="clickable_option">*</a>', 'normal_pfx', 0), //cpg1.3.0
        array('Prefixul pentru pictograme <a href="#notice1" class="clickable_option">*</a>', 'thumb_pfx', 0), //cpg1.3.0
        array('Modul predefinit al directoarelor', 'default_dir_mode', 0), //cpg1.3.0
        array('Modul predefinit al imaginilor', 'default_file_mode', 0), //cpg1.3.0

        'Set�ri pentru utilizatori',
        array('Permite�i �nregistrarea de noi utilizatori', 'allow_user_registration', 1),
        array('�nregistrarea utilizatorilor necesit� �nregistrarea prin e-mail', 'reg_requires_valid_email', 1),
        array('Notific� administratorul de �nregistrarea utilizatorilor prin email', 'reg_notify_admin_email', 1), //cpg1.3.0
        array('Permite ca doi utilizatori s� poat� avea aceea�i adresa e-mail', 'allow_duplicate_emails_addr', 1),
        array('Utilizatorii pot avea albume private (Not�: dac� trece�i de la \'da\' la \'nu\' toate albumele personale curente vor deveni publice)', 'allow_private_albums', 1), //cpg1.3.0
        array('Notific� administratorul de a�teptarea aprob�rii �ncarc�rii imaginilor', 'upl_notify_admin_email', 1), //cpg1.3.0
        array('Permite utilizatorilor �nregistra�i s� vad� lista membrilor', 'allow_memberlist', 1), //cpg1.3.0

        'Descrierea c�mpurilor adi�ionale (l�sa�i necompletat dac� nu le utiliza�i)',
        array('Numele c�mpului 1', 'user_field1_name', 0),
        array('Numele c�mpului 2', 'user_field2_name', 0),
        array('Numele c�mpului 3', 'user_field3_name', 0),
        array('Numele c�mpului 4', 'user_field4_name', 0),

        'Set�ri cookie-uri',
        array('Numele cookie-ului utilizat de script', 'cookie_name', 0),
        array('Calea cookie-ului utilizat de script', 'cookie_path', 0),

        'Set�ri',
        array('Activeaz� modul debug', 'debug_mode', 9), //cpg1.3.0
        array('Arat� note �n modul debug', 'debug_notice', 1), //cpg1.3.0
         '<br /><div align="left"><a name="notice1"></a>(*) C�mpurile marcate cu * nu trebuie modificate dac� ave�i deja imagini �n galeria dvs.<br />
        <a name="notice2"></a>(**) C�nd schimba�i setarea aceasta, doar fi�ierele introduse dup� acest moment vor fi afectate, �i de aceea nu este recomandat s� efectua�i aceste modific�ri dac� sunt imagini �n galerie. Pute�i efectua modific�rile �i asupra fi�ierelor existente cu &quot;<a href="util.php">utilitar administrator</a>&quot; utilitar din menu-ul administratorului.</div><br />', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// db_ecard.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('DB_ECARD_PHP')) $lang_db_ecard_php = array(
  'title' => 'Trimite vederea', //cpg1.3.0
  'ecard_sender' => 'Expeditor', //cpg1.3.0
  'ecard_recipient' => 'Destinatar', //cpg1.3.0
  'ecard_date' => 'Data', //cpg1.3.0
  'ecard_display' => 'Arat� vederea', //cpg1.3.0
  'ecard_name' => 'Nume', //cpg1.3.0
  'ecard_email' => 'email', //cpg1.3.0
  'ecard_ip' => 'IP #', //cpg1.3.0
  'ecard_ascending' => 'cresc�tor', //cpg1.3.0
  'ecard_descending' => 'descresc�tor', //cpg1.3.0
  'ecard_sorted' => 'Sortare', //cpg1.3.0
  'ecard_by_date' => 'dup� dat�', //cpg1.3.0
  'ecard_by_sender_name' => 'dup� numele expeditorului', //cpg1.3.0
  'ecard_by_sender_email' => 'dup� email-ul expeditorului', //cpg1.3.0
  'ecard_by_sender_ip' => 'dup� IP-ul expeditorului', //cpg1.3.0
  'ecard_by_recipient_name' => 'dup� numele destinatarului', //cpg1.3.0
  'ecard_by_recipient_email' => 'dup� email-ul destinatarului', //cpg1.3.0
  'ecard_number' => 'arat� �nregistr�ri %s to %s of %s', //cpg1.3.0
  'ecard_goto_page' => 'mergi la pagina', //cpg1.3.0
  'ecard_records_per_page' => '�nregistr�ri pe pagin�', //cpg1.3.0
  'check_all' => 'Selecteaz� tot', //cpg1.3.0
  'uncheck_all' => 'Deselecteaz� tot', //cpg1.3.0
  'ecards_delete_selected' => '�terge vederile selectate', //cpg1.3.0
  'ecards_delete_confirm' => 'Sunte�i sigur c� vre�i s� �terge�i �nregistr�rile? Marca�i �n casu��!', //cpg1.3.0
  'ecards_delete_sure' => 'Sunt sigur', //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
        'empty_name_or_com' => 'Trebuie s� introduce�i numele dvs. �i un comentariu',
        'com_added' => 'Comentariul dvs. a fost ad�ugat',
        'alb_need_title' => 'Trebuie s� furniza�i un titlu pentru album!',
        'no_udp_needed' => 'Nici o modificare necesar�.',
        'alb_updated' => 'Albumul a fost modificat',
        'unknown_album' => 'Albumul selectat nu exist� sau nu ave�i permisiunea s� �nc�rca�i �n acest album',
        'no_pic_uploaded' => 'Nici o imagine nu a fost �nc�rcat�!<br /><br />Dac� a�i selectat o imagine, verifica�i dac� serverul permite �nc�rc�ri.',
        'err_mkdir' => 'Eroare �n crearea directorului %s!',
        'dest_dir_ro' => 'Directorul destina�ie %s nu poate fi scris de c�tre script!',
        'err_move' => 'Imposibil de deplasat %s �n %s!',
        'err_fsize_too_large' => 'Dimensiunea imaginii este prea mare (maximul permis este %s x %s)!',
        'err_imgsize_too_large' => 'M�rimea fi�ierului �nc�rcat este prea mare (maximul permis este %s KB)!',
        'err_invalid_img' => 'Fi�erul �nc�rcat nu este o imagine valid�!',
        'allowed_img_types' => 'Pute�i �nc�rca doar %s imagini.',
        'err_insert_pic' => 'Imaginea \'%s\' nu poate fi inserat� �n album ',
        'upload_success' => 'Imaginea dvs. a fost �nc�rcat� cu succes<br /><br />Va fi vizibil� dup� aprobarea unui administrator.',
        'info' => 'Informa�ii',
        'com_added' => 'Comentariu ad�ugat',
        'alb_updated' => 'Album modificat',
        'err_comment_empty' => 'Comentariul dvs. este gol!',
        'err_invalid_fext' => 'Doar fi�ierele cu urm�toarele extensii sunt permise : <br /><br />%s.',
        'no_flood' => 'Ne pare r�u dar sunte�i deja autorul ultimului comentariu postat pentru aceast� imagine<br /><br />Edita�i comentariul postat dac� dori�i s�-l modifica�i',
        'redirect_msg' => 'Sunte�i redirectat.<br /><br /><br />Ap�sa�i pe \'Continuare\' dac� pagina nu se �ncarc� automat',
        'upl_success' => 'Imaginea dvs. a fost ad�ugat� cu succes',
        'email_comment_subject' => 'Comentariu din galeria foto', //cpg1.3.0
        'email_comment_body' => 'Cineva a postat un comentariu �n galeria foto. �l pute�i vedea la', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
        'caption' => 'Descriere',
        'fs_pic' => 'imaginea la dimensiuni maxime',
        'del_success' => '�tears� cu succes',
        'ns_pic' => 'imaginea de dimensiuni normale',
        'err_del' => 'nu poate fi �tears�',
        'thumb_pic' => 'pictograma',
        'comment' => 'comentariul',
        'im_in_alb' => 'imaginea �n album',
        'alb_del_success' => 'Albumul \'%s\' a fost �ters',
        'alb_mgr' => 'Managerul de albume',
        'err_invalid_data' => 'Date nevalide primite �n \'%s\'',
        'create_alb' => 'Creare album \'%s\'',
        'update_alb' => 'Modificare album \'%s\' cu titlul \'%s\' �i indexul \'%s\'',
        'del_pic' => '�terge imaginea',
        'del_alb' => '�terge albumul',
        'del_user' => '�terge utilizatorul',
        'err_unknown_user' => 'Utilizatorul selectat nu exist�!',
        'comment_deleted' => 'Comentariul a fost �ters cu succes',
);

// ------------------------------------------------------------------------- //
// displayecard.php
// ------------------------------------------------------------------------- //

// Void

// ------------------------------------------------------------------------- //
// displayimage.php
// ------------------------------------------------------------------------- //

if (defined('DISPLAYIMAGE_PHP')){

$lang_display_image_php = array(
        'confirm_del' => 'Sunte�i sigur c� dori�i s� �terge�i aceast� imagine? \\nComentariile vor fi de asemenea �terse.', //js-alert
        'del_pic' => '�terge aceast� imagine',
        'size' => '%s x %s pixeli',
        'views' => '%s ori',
        'slideshow' => 'Diaporama',
        'stop_slideshow' => 'Opre�te diaporama',
        'view_fs' => 'Ap�sa�i pentru a vedea imaginea la dimensiuni originale',
          'edit_pic' => 'Editeaz� descrierea', //cpg1.3.0
          'crop_pic' => 'Taie �i rote�te', //cpg1.3.0
);

$lang_picinfo = array(
        'title' =>'Informa�ii despre imagine',
        'Filename' => 'Nume fi�ier',
        'Album name' => 'Nume album',
        'Rating' => 'Votare (%s voturi)',
        'Keywords' => 'Cuvinte cheie',
        'File Size' => 'Dimensiune fi�ier',
        'Dimensions' => 'Dimensiune imagine',
        'Displayed' => 'Afi�at�',
        'Camera' => 'Camera',
        'Date taken' => 'Data fotografierii',
         'ISO'=>'ISO',
        'Aperture' => 'Apertura',
        'Exposure time' => 'Timp de expunere',
        'Focal length' => 'Focala',
        'Comment' => 'Comentariul',
        'addFav'=>'Adaug� �n Favorite',
        'addFavPhrase'=>'Favorite',
        'remFav'=>'�terge din Favorite',
        'iptcTitle'=>'IPTC Titlu', //cpg1.3.0
        'iptcCopyright'=>'IPTC Copyright', //cpg1.3.0
        'iptcKeywords'=>'IPTC Cuvinte cheie', //cpg1.3.0
        'iptcCategory'=>'IPTC Categorie', //cpg1.3.0
        'iptcSubCategories'=>'IPTC Subcategorie', //cpg1.3.0
);

$lang_display_comments = array(
        'OK' => 'OK',
        'edit_title' => 'Editeaz� acest comentariu',
        'confirm_delete' => 'Sunte�i sigur c� dori�i s� �terge�i acest comentariu?',
        'add_your_comment' => 'Ad�uga�i comentariul dvs.',
        'name'=>'Nume',
        'comment'=>'Comentariu',
        'your_name' => 'Numele dvs.',
);

$lang_fullsize_popup = array(
        'click_to_close' => 'Ap�sa�i pe imagine pentru a �nchide fereastra',
);

}

// ------------------------------------------------------------------------- //
// ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
        'title' => 'Trimite o vedere electronic�',
        'invalid_email' => '<b>Aten�ie</b> : adresa email este incorect�!',
        'ecard_title' => 'O vedere electronic� de la %s',
        'view_ecard' => 'Dac� vederea nu este afi�at� corect, ap�sa�i pe aceasta leg�tur�',
        'view_more_pics' => 'Ap�sa�i aici pentru a vedea mai multe imagini!',
        'send_success' => 'Vederea dvs. a fost trimis�',
        'send_failed' => 'Ne pare r�u dar serverul nu poate trimite vederea dvs...',
        'from' => 'De la',
        'your_name' => 'Numele dvs.',
        'your_email' => 'Adresa dvs. de email',
        'to' => 'C�tre',
        'rcpt_name' => 'Numele expeditorului',
        'rcpt_email' => 'Adresa de email a destinatarului',
        'greetings' => 'Salut�ri',
        'message' => 'Mesaj',
);

// ------------------------------------------------------------------------- //
// editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
        'pic_info' => 'Imagine&nbsp;info',
        'album' => 'Album',
        'title' => 'Titlu',
        'desc' => 'Descriere',
        'keywords' => 'Cuvinte cheie',
        'pic_info_str' => '%sx%s - %sKB - %s afisari - %s voturi',
        'approve' => 'Aprob� imaginea',
        'postpone_app' => 'Am�n� aprobarea',
        'del_pic' => '�terge imaginea',
        'read_exif' => 'Cite�te EXIF din nou', //cpg1.3.0
        'reset_view_count' => 'Reseteaz� contorul de afi��ri',
        'reset_votes' => 'Reseteaz� voturile',
        'del_comm' => '�terge comentariile',
        'upl_approval' => 'Aprobare �nc�rc�ri',
        'edit_pics' => 'Editeaz� imagini',
        'see_next' => 'Arat� imaginile urm�toare',
        'see_prev' => 'Arat� imaginile precedente',
        'n_pic' => '%s imagini',
        'n_of_pic_to_disp' => 'Num�rul de imagini care s� fie afi�ate',
        'apply' => 'Execut� modific�rile',
        'crop_title' => 'Editor imagini', //cpg1.3.0
        'preview' => 'Previzualizare', //cpg1.3.0
        'save' => 'Salvare imagine', //cpg1.3.0
        'save_thumb' =>'Salveaz� ca pictogram�', //cpg1.3.0
        'sel_on_img' =>'Selec�ia este c�t �ntreaga imagine!', //js-alert //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// faq.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FAQ_PHP')) $lang_faq_php = array(
  'faq' => '�ntreb�ri frecvente', //cpg1.3.0
  'toc' => 'Cuprins', //cpg1.3.0
  'question' => '�ntrebare: ', //cpg1.3.0
  'answer' => 'R�spuns: ', //cpg1.3.0
);

if (defined('FAQ_PHP')) $lang_faq_data = array(
  '�ntreb�ri frecvente', //cpg1.3.0
  array('De ce trebuie s� m� �nregistrez?', '�nregistrarea poate sau nu s� fie cerut� de c�tre administrator. �nregistrarea permite accesul la op�iuni suplimentare, cum ar fi �nc�rcarea de imagini, existen�a favoritelor, posibilitatea comentariilor sau a not�rii imaginilor.', 'allow_user_registration', '0'), //cpg1.3.0
  array('Cum m� pot �nregistra?', 'Ap�sa�i pe &quot;�nregistrare&quot; �i completa�i toate c�mpurile obligatorii (�i cele op�ionale dac� dori�i).<br />Dac� administratorul are activarea prin email selectat�, dup� ce a�i introdus datele trebuie s� primi�i un email la adresa specificat� de dv., �n care g�si�i detalii despre modul de activare al contului. Contul trebuie activat �nainte de a v� loga.', 'allow_user_registration', '1'), //cpg1.3.0
  array('Cum m� loghez?', 'Ap�sa�i &quot;Login&quot;, introduce�i numele �i parola �i selecta�i &quot;Memoreaz�-m�&quot; dac� dori�i s� intra�i pe pagin� �n viitor deja logat.<br /><b>IMPORTANT:Cooki-urile trebuie activate �i nu trebuie s� le �terge�i dac� dori�i activ� op�iunea &quot;Memoreaz�-m�&quot;.</b>', 'offline', 0), //cpg1.3.0
  array('De ce nu m� pot loga?', 'A�i ap�sat pe link-ul din email-ul de �nregistrare?. Acest link v� activeaz� contul. Pentru alte probleme legate de logare, v� rug�m s� contacta�i administratorul.', 'offline', 0), //cpg1.3.0
  array('Ce se �nt�mpl� dac� am uitat parola?', 'Dac� pagina are activat� &quot;Reamintirea parolei&quot; ap�sa�i pe link. Dac� acest link nu este disponibil, va trebui s� contacta�i administratorul.', 'offline', 0), //cpg1.3.0
  //array('Ce se �nt�mpl� dac� �mi schimb email-ul?', 'Loga�i-v� �i schimba�i adresa de email �n &quot;Profil&quot;', 'offline', 0), //cpg1.3.0
  array('Cum salvez imaginile din &quot;Favorite&quot;?', 'Ap�sa�i pe imagine �i apoi pe &quot;imagine info&quot; link (<img src="images/info.gif" width="16" height="16" border="0" alt="Informa�ii imagine" />); c�uta�i �n informa�ii �i ap�sa�i &quot;Pune �n favorite&quot;.<br />Administratorul trebuie s� lase &quot;informa�ii imagine&quot; active �n mod predefinit.<br />IMPORTANT:Cooki-urile trebuie activate �i nu trebuie s� le �terge�i.', 'offline', 0), //cpg1.3.0
  array('Cum notez o imagine?', 'Ap�sa�i pe pictogram� �i merge�i �n jos pentru a o putea nota.', 'offline', 0), //cpg1.3.0
  array('Cum comentez o imagine?', 'Ap�sa�i pe pictogram� �i merge�i �n jos pentru a o putea comenta.', 'offline', 0), //cpg1.3.0
array('Cum �ncarc o imagine?', 'Ap�sa�i &quot;�ncarc� imagine&quot; �i selecta�i albumul, ap�sa�i &quot;Browse&quot; �i g�si�i imaginea care dori�i s� o �nc�rca�i, ap�sa�i &quot;open&quot; (scrie�i un tilu �i o descriere dac� dori�i) �i ap�sa�i &quot;Submit&quot;', 'allow_private_albums', 0), //cpg1.3.0
  array('Unde pot �nc�rca o imagine?', 'Pute�i �nc�rca o imagine �n albumul/ele din &quot;Galeria mea&quot;. Administratorul poate permite sau nu s� �nc�rca�i imagini �i �n galeria principal�.', 'allow_private_albums', 0), //cpg1.3.0
  array('Ce tip �i ce m�rime pot s� aib� imaginile pe care pot s� le �ncarc?', 'Tipul �i m�rimea (jpg, png, etc.) sunt stabilite de administrator.', 'offline', 0), //cpg1.3.0
  array('Ce este &quot;Galeria mea&quot;?', '&quot;Galeria mea&quot; este o galerie personal� pe care pute�i s� o folosi�i �i administra�i.', 'allow_private_albums', 0), //cpg1.3.0
  array('Cum pot crea, redenumi sau �terge albume din &quot;galeria mea&quot;?', 'Trebuie s� fi�i �n modul &quot;Mod admin&quot;<br />Merge�i la &quot;Crea�i/ordona�i albumele mele&quot; �i ap�sa�i &quot;Nou&quot;. Schimba�i &quot;Album nou&quot; cu numele dorit.<br />Pute�i de asemenea s� redenumi�i orice album din galeria dvs.<br />Ap�sa�i &quot;Efectua�i modific�rile&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('Cum restric�ionez �i cum modific ce utilizatori pot vedea Galeria mea?', 'Trebuie s� fi�i �n modul &quot;Mod admin&quot;<br />Mergee�i la &quot;Modific� albumele mele&quot;. Merge�i la &quot;Modific� album&quot; �i selecta�i albumul dorit.<br />Aici pute�i schimba numele, descrierea, pictograma, restric�iona vederea imaginilor �i a not�rii/coment�rii acestora.<br />Ap�sa�i &quot;Modific� album&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('Cum pot vedea galeriile altor utilizatori?', 'Merge�i la &quot;Lista albumelor&quot; �i selecta�i &quot;galerii utilizatori&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('Ce sunt cooki-urile?', 'Cooki-urile sunt date �n mod text care sunt trimise de pagina web �i stocate pe calculator.<br />Cooki+urile �n mod normal permit utilizatorului s� ias� �i s� intre �n pagina f�r� a mai trebui s� se logheze.', 'offline', 0), //cpg1.3.0
  array('De unde pot desc�rca acest program pentru pagina mea?', 'Coppermine este o galerie multimedia, ap�rut� sub licen�a GNU GPL. Are o multitudine de op�iuni �i merge pe multe tipuri de sisteme. Visita�i <a href="http://coppermine.sf.net/">Coppermine Home Page</a> pentru a afla mai multe �i pentru a desc�rca.', 'offline', 0), //cpg1.3.0

  'Navigare prin site', //cpg1.3.0
  array('Ce este &quot;Lista albumelor&quot;?', 'Aceasta v� va ar�ta categoria unde v� afla�i, cu un link c�tre alte album. Dac� nu sunte�i �ntr-o categorie, v� va ar�ta �ntreaga galerie �i link+uri c�tre fiecare categorie. Pictogramele pot fi un link c�tre categorie.', 'offline', 0), //cpg1.3.0
  array('Ce este &quot;galeria mea&quot;?', 'Aceasta permite utilizatorului s� �i creeze propria galerie, s� pun�/�tearg�/modifice albumele.', 'allow_private_albums', 0), //cpg1.3.0
  array('Care este diferen�a �ntre &quot;Modul admin&quot; �i &quot;Modul utilizator&quot;?', 'Modul admin permite utilizatorului s� modifice galeria personal�.', 'allow_private_albums', 0), //cpg1.3.0
  array('Ce este &quot;�ncarc� imagine&quot;?', 'Permite utilizatorului s� �ncarce o imagine (dimensiunea �i tipul sunt setate de administrator) �n galerie.', 'allow_private_albums', 0), //cpg1.3.0
  array('Ce sunt &quot;Ultimele �nc�rc�ri&quot;?', 'V� arat� ultimele imagini �nc�rcate �n pagin�.', 'offline', 0), //cpg1.3.0
  array('Ce sunt &quot;Ultimele comentarii&quot;?', 'V� arat� ultimele comentarii �i pentru ce imagine din pagin�.', 'offline', 0), //cpg1.3.0
  array('Ce sunt &quot;Ultimele vizitate&quot;?', 'V� arat� ultimele imagini vizionate, indiferent dac� utilizatorul este logat sau nu.', 'offline', 0), //cpg1.3.0
  array('Ce sunt &quot;Cele mai votate&quot;?', 'V� arat� cele mai votate imagini (ex: cinci utilizatori voteaz� <img src="images/rating3.gif" width="65" height="14" border="0" alt="" />: imaginea trebuie s� aib� un vot de <img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> ;Cinci utilizatori voteaz�d de la 1 la 5 (1,2,3,4,5) �i rezultatul <img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> .)<br />votul poate fi de la <img src="images/rating5.gif" width="65" height="14" border="0" alt="best" /> (nemaipomenit) to <img src="images/rating0.gif" width="65" height="14" border="0" alt="worst" /> (prost).', 'offline', 0), //cpg1.3.0
  array('Ce sunt &quot;Favorite&quot;?', 'permite stocarea unei imagini favorite �ntr-un cookie ce este tirmis c�tre calculatorul dvs.', 'offline', 0), //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// forgot_passwd.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FORGOT_PASSWD_PHP')) $lang_forgot_passwd_php = array(
  'forgot_passwd' => 'Reamintirea parolei', //cpg1.3.0
  'err_already_logged_in' => 'Sunte�i deja logat!', //cpg1.3.0
  'enter_username_email' => 'Introduce�i numele sau adresa de email', //cpg1.3.0
  'submit' => 'go', //cpg1.3.0
  'failed_sending_email' => 'Email-ul cu parola nu poate fi trimis!', //cpg1.3.0
  'email_sent' => 'Un email cu numele �i parola a fost trimis la %s', //cpg1.3.0
  'err_unk_user' => 'Utilizator inexistent!', //cpg1.3.0
  'passwd_reminder_subject' => '%s - Reamintirea parolei', //cpg1.3.0
  'passwd_reminder_body' => 'A�i cerut s� v� fie reamintit� parola:
Utilizator: %s
Parol�: %s
Apasa�i %s pentru a intra.', //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
        'group_name' => 'Numele grupului',
        'disk_quota' => 'Cota pe disc',
        'can_rate' => 'Poate vota imaginile',
        'can_send_ecards' => 'Poate trimite vederi',
        'can_post_com' => 'Poate posta comentarii',
        'can_upload' => 'Poate �nc�rca imagini',
        'can_have_gallery' => 'Poate avea o galerie personal�',
        'apply' => 'Execut� modific�rile',
        'create_new_group' => 'Creaz� un grup nou',
        'del_groups' => '�terge grupul/grupurile selectat(e)',
        'confirm_del' => 'Aten�ie, c�nd �terge�i un grup, utilizatorii apar�in�nd acestui grup vor fi transfera�i �n grupul \'�nregistra�i\' !\n\nSunte�i sigur c� dori�i s� continua�i ?',
        'title' => 'Administreaz� grupurile de utilizatori',
        'approval_1' => 'Aprobare �nreg. Pub. (1)',
        'approval_2' => 'Aprobare �nreg. Priv. (2)',
        'upload_form_config' => '�ncarc� din configura�ie', //cpg1.3.0
        'upload_form_config_values' => array( 'Doar o imagine de �nc�rcat', 'Mai multe imagini de �nc�rcat', 'Doar URL de �nc�rcat', 'Doar ZIP de �nc�rcat', 'Imagine-URL', 'Imagine-ZIP', 'URL-ZIP', 'Imagine-URL-ZIP'), //cpg1.3.0
        'custom_user_upload'=>'Utilizatorul �i poate seta num�rul de c�su�e?', //cpg1.3.0
        'num_file_upload'=>'Maxim/exact num�r de imagini de �nc�rcat', //cpg1.3.0
        'num_URI_upload'=>'Maxim/exact num�r de URL de �nc�rcat', //cpg1.3.0
        'note1' => '<b>(1)</b> �nc�rcarea �ntr-un album public necesit� aprobarea administratorului',
        'note2' => '<b>(2)</b> �nc�rcarea �ntr-un album apar�in�nd utilizatorului necesit� aprobarea administratorului',
        'notes' => 'Note'
);

// ------------------------------------------------------------------------- //
// index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
        'welcome' => 'Bine a�i venit!'
);

$lang_album_admin_menu = array(
        'confirm_delete' => 'Sunte�i sigur c� dori�i s� �terge�i acest album? \\nToate imaginile �i comentariile con�inute vor fi de asemenea �terse.',
        'delete' => '�terge',
        'modify' => 'Propriet��i',
        'edit_pics' => 'Editare imagini',
);

$lang_list_categories = array(
        'home' => 'Pagina principal�',
        'stat1' => '<b>[pictures]</b> imagini �n <b>[albums]</b> albume �i <b>[cat]</b> categorii cu <b>[comments]</b> comentarii afi�ate de <b>[views]</b> ori',
        'stat2' => '<b>[pictures]</b> imagini �n <b>[albums]</b> albume afi�ate de <b>[views]</b> ori',
        'xx_s_gallery' => 'Galeria %s\'s',
        'stat3' => '<b>[pictures]</b> imagini �n <b>[albums]</b> albume cu <b>[comments]</b> comentarii afi�ate de <b>[views]</b> ori'
);

$lang_list_users = array(
        'user_list' => 'Lista utilizatorilor',
        'no_user_gal' => 'Nu exist� galerii utilizator',
        'n_albums' => '%s album(e)',
        'n_pics' => '%s imagini'
);

$lang_list_albums = array(
        'n_pictures' => '%s imagini',
        'last_added' => ', ultima ad�ugat� la %s'
);

}

// ------------------------------------------------------------------------- //
// login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
        'login' => 'Login',
        'enter_login_pswd' => 'Introduce�i contul �i parola pentru a v� loga',
        'username' => 'Utilizator',
        'password' => 'Parola',
        'remember_me' => 'Memoreaz�-m�',
        'welcome' => 'Bine a�i venit %s ...',
        'err_login' => '*** Nu a�i putut fi logat. �ncerca�i din nou ***',
        'err_already_logged_in' => 'Sunte�i deja logat !',
        'forgot_password_link' => 'Reamintirea parolei', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
        'logout' => 'Logout',
        'bye' => 'La revedere %s ...',
        'err_not_loged_in' => 'Nu sunte�i logat!',
);

// ------------------------------------------------------------------------- //
// phpinfo.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('PHPINFO_PHP')) $lang_phpinfo_php = array(
  'php_info' => 'PHP info', //cpg1.3.0
  'explanation' => 'Acesta este rezultatul generat de PHP <a href="http://www.php.net/phpinfo">phpinfo()</a>', //cpg1.3.0
  'no_link' => 'L�s�nd pe al�ii s� vad� php info nu este recomandat, de aceea aceast� pagin� este vizibil� doar pentru administrator. Nu pute�i posta o legatur� direct� c�tre aceast� pagina, accesul nu va fi permis.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
        'upd_alb_n' => 'Modific� album %s',
        'general_settings' => 'Set�ri generale',
        'alb_title' => 'Titlul albumului',
        'alb_cat' => 'Categoria albumului',
        'alb_desc' => 'Descrierea albumului',
        'alb_thumb' => 'Pictograma albumului',
        'alb_perm' => 'Permisiile acestui album',
        'can_view' => 'Albumul poate fi v�zut de',
        'can_upload' => 'Vizitatorii pot �nc�rca imagini',
        'can_post_comments' => 'Vizitatorii pot posta comentarii',
        'can_rate' => 'Vizitatorii pot nota imaginile',
        'user_gal' => 'Galeria utilizatorului',
        'no_cat' => '* Nici o categorie *',
        'alb_empty' => 'Albumul este gol',
        'last_uploaded' => 'Ultimele �nc�rcate',
        'public_alb' => 'Toat� lumea (album public)',
        'me_only' => 'Doar eu',
        'owner_only' => 'Proprietarul albumul doar (%s)',
        'groupp_only' => 'Membrii grupului \'%s\'',
        'err_no_alb_to_modify' => 'Nici un album pe care s� �l pute�i modifica �n baza de date.',
        'update' => 'Modifc� album',
        'notice1' => '(*) depinde de set�rile %sgroups%s', //cpg1.3.0 (do not translate %s!)
);

// ------------------------------------------------------------------------- //
// ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
        'already_rated' => 'Ne pare r�u, dar a�i votat deja aceast� imagine',
        'rate_ok' => 'Votul dvs. ',
        'forbidden' => 'Nu v� pute�i vota propria imagine.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
De�i administratorii paginii {SITE_NAME} vor �ncerca s� �tearg� sau s� editeze orice material nepermis sau obscen c�t de repede cu putin��, este imposibil s� fie verificat fiecare mesaj sau comentariu. De aceea sunte�i de acord ca toate mesajele postate pe aceast� pagin� exprim� opiniile autorului �i nu ale administratorilor (except�nd mesajele transmise de ei) �i deci nu pot fi tra�i la r�spundere.<br />
<br />
Sunte�i de acord s� nu posta�i nici o imagine sau un mesaj obscen, vulgar, amenin��tor, sau orice alt mesaj ce �ncalc� legile. Sunte�i de acord ca administratorul �i moderatorii paginii {SITE_NAME} au dreptul s� modifice sau s� �tearg� orice con�inut oric�nd consider� ei necesar. Ca utilizator sunte�i de acord ca orice informa�ie introdus� s� fie stocat� �ntr-o baz� de date. De�i aceast� informa�ie NU va fi oferit� unei ter�e p�r�i administratorii nu pot fi f�cu�i responsabili �n cazul unei acces�ri for�ate, ilegale a bazei de date ce ar duce la compromiterea acesteia. <br />
<br />
Acest� pagin� folose�te cookie-uri pentru a stoca informa�ie pe computerul dvs. Acestea servesc doar la buna func�ionare a paginii web. Adresa dvs. e-mail este folosit� doar pentru a verifica parola pentru procesul de �nregistrare �i pentru a primi informa�ii directe din pagin�. <br />
<br />
Drepturile de autor asupra imaginilor din galerie apar�in exclusiv autorilor. Orice modificare/copiere se va face doar av�nd consim��m�ntul acestora!<br /><br />
Ap�s�nd pe butonul 'Sunt de acord' de mai jos sunte�i de acord s� respecta�i �i accepta�i condi�iile de mai sus.
EOT;

$lang_register_php = array(
        'page_title' => '�nregistrare utilizator',
        'term_cond' => 'Termeni si condi�ii',
        'i_agree' => 'Sunt de acord',
        'submit' => 'Trimite �nregistrarea',
        'err_user_exists' => 'Numele utilizator ales exist� deja, v� rug�m s� alege�i alt nume',
        'err_password_mismatch' => 'Cele dou� parole nu sunt identice, v� rug�m s� le reintroduce�i',
        'err_uname_short' => 'Numele utilizator trebuie s� aib� minim 3 caractere',
        'err_password_short' => 'Parola trebuie s� aib� minim 5 caractere',
        'err_uname_pass_diff' => 'Numele utilizator �i parola trebuie s� fie diferite',
        'err_invalid_email' => 'Adresa e-mail este incorect�',
        'err_duplicate_email' => 'Alt utilizator este �nregistrat deja cu aceasta adres� e-mail',
        'enter_info' => 'Introduce�i datele pentru �nregistrare',
        'required_info' => 'Informa�ii necesare',
        'optional_info' => 'Informa�ii op�ionale',
        'username' => 'Utilizator',
        'password' => 'Parola',
        'password_again' => 'Confirma�i parola',
        'email' => 'Email',
        'location' => 'Loca�ie',
        'interests' => 'Interese',
        'website' => 'Pagina web',
        'occupation' => 'Ocupa�ie',
        'error' => 'Eroare',
        'confirm_email_subject' => '%s - Confirmarea �nregistr�rii',
        'information' => 'Informa�ii',
        'failed_sending_email' => 'Mesajul de confirmare a �nregistr�rii nu poate fi trimis!',
        'thank_you' => 'V� mul�umim pentru c� v-a�i �nregistrat.<br /><br />Un email con�in�nd informa�ii despre cum s� activa�i contul dvs. a fost trimis la adresa email specificat�.',
        'acct_created' => 'Contul dvs. a fost creat �i v� puteti loga introduc�nd user-ul �i parola dvs.',
        'acct_active' => 'Contul dvs. este acum activ �i va pute�i loga introduc�nd user-ul �i parola dvs.',
        'acct_already_act' => 'Contul dvs. este deja activ!',
        'acct_act_failed' => 'Acest cont nu poate fi activat!',
        'err_unk_user' => 'Utilizatorul selectat nu exist�!',
        'x_s_profile' => 'Profilul lui %s',
        'group' => 'Grup',
        'reg_date' => '�nregistrat la',
        'disk_usage' => 'Utilizare disc',
        'change_pass' => 'Schimbare parol�',
        'current_pass' => 'Parola curent�',
        'new_pass' => 'Parol� nou�',
        'new_pass_again' => 'Reintroduce�i parola nou�',
        'err_curr_pass' => 'Parola curent� este incorect�',
        'apply_modif' => 'Execut� modificarile',
        'change_pass' => 'Schimb� parola mea',
        'update_success' => 'Profilul dumneavoastra a fost modificat',
        'pass_chg_success' => 'Parola dumneavoastr� a fost schimbat�',
        'pass_chg_error' => 'Parola dumneavoastr� nu a fost schimbat�',
        'notify_admin_email_subject' => '%s - Notificare �nregistrare', //cpg1.3.0
        'notify_admin_email_body' => 'Un nou utilizator "%s" �n galerie', //cpg1.3.0
);

$lang_register_confirm_email = <<<EOT
V� mul�umim c� v-a�i �nregistrat la {SITE_NAME}

Contul dvs. este : "{USER_NAME}"
Parola dvs. este : "{PASSWORD}"

Pentru a activa contul dvs., v� rug�m s� ap�sa�i pe leg�tura de mai jos
sau s� o copia�i si duce�i �n navigatorul dvs. de internet.

{ACT_LINK}

Cu stim�,

{SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
        'title' => 'Revizuire comentarii',
        'no_comment' => 'Nu exist� comentarii care s� fie revizuite',
        'n_comm_del' => '%s comentarii �terse',
        'n_comm_disp' => 'Num�rul de comentarii de afi�at',
        'see_prev' => 'Afi�eaz� precedentul',
        'see_next' => 'Afi�eaz� urm�torul',
        'del_comm' => '�terge comentariile selectate',
);

// ------------------------------------------------------------------------- //
// search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
        0 => 'Caut� �n colec�ia de imagini',
);

// ------------------------------------------------------------------------- //
// searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
        'page_title' => 'Caut� imagini noi',
        'select_dir' => 'Selecteaz� directorul',
        'select_dir_msg' => 'Aceast� func�ie v� permite s� ad�uga�i mai multe imagini o dat�, imagini �nc�rcate de dvs. pe server prin FTP.<br /><br />Selecta�i directorul unde a�i �nc�rcat imaginile',
        'no_pic_to_add' => 'Nu exist� nici o imagine de ad�ugat',
        'need_one_album' => 'Ave�i nevoie de cel pu�in un album pentru a folosi aceast� func�ie',
        'warning' => 'Aten�ie',
        'change_perm' => 'scriptul nu poate scrie �n acest director, trebuie s� schimba�i modul la 755 sau 777 �nainte de a �ncerca s� ad�uga�i imaginile!',
        'target_album' => '<b>Pune imaginile din &quot;</b>%s<b>&quot; �n </b>%s',
        'folder' => 'Director',
        'image' => 'Imagine',
        'album' => 'Album',
        'result' => 'Rezultat',
        'dir_ro' => 'Nu poate fi scris. ',
        'dir_cant_read' => 'Nu poate fi citit. ',
        'insert' => 'Adaug� imagini noi �n galerie',
        'list_new_pic' => 'Lista noilor imagini',
        'insert_selected' => 'Insereaz� imaginile selectate',
        'no_pic_found' => 'Nu a fost gasit� nici o imagine nou�',
        'be_patient' => 'V� rugam a�tepta�i, scriptul necesit� timp pentru a procesa imaginile',
        'notes' =>  '<ul>'.
                                '<li><b>OK</b> : �nseamn� c� imaginea a fost adaugat� cu succes'.
                                '<li><b>DP</b> : �nseamn� c� imaginea este un duplicat �i exist� deja �n baza de date'.
                                '<li><b>PB</b> : �nseamn� c� imaginea nu a putut fi adaugat�, verifica�i configura�ia �i permisiile directoarelor unde imaginile sunt stocate'.
                                '<li><b>NA</b> : �nseamn� c� nu a�i selectat un album unde s� �nc�rca�i imaginile, ap�sa�i \'<a href="javascript:history.back(1)">�napoi</a>\' �i selecta�i un album. Dac� nu ave�i un album <a href="albmgr.php">crea�i unul �nt�i</a>'.
                                '<li>Dac� \'semnele\' OK, DP, PB nu apar, da�i click pe icoana de imagine defect� pentru a verifica mesajele de eroare produse de PHP'.
                                '<li>Dac� navigatorul dvs. raporteaz� \'timeout\', ap�sa�i butonul de re�nc�rcare a paginii'.
                                '</ul>',
                                'select_album' => 'Selecteaz� album', //cpg1.3.0
                                'check_all' => 'Selecteaz� tot', //cpg1.3.0
                                'uncheck_all' => 'Deselecteaz� tot', //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// thumbnails.php
// ------------------------------------------------------------------------- //

// Void

// ------------------------------------------------------------------------- //
// banning.php
// ------------------------------------------------------------------------- //

if (defined('BANNING_PHP')) $lang_banning_php = array(
                'title' => 'Bana�i utilizatori',
                'user_name' => 'Nume utilizator',
                'ip_address' => 'Adresa IP',
                'expiry' => 'Expir� (gol este permanent)',
                'edit_ban' => 'Salveaz� modificarile',
                'delete_ban' => '�terge',
                'add_new' => 'Adaug� un nou ban',
                'add_ban' => 'Adaug�',
                'error_user' => 'Nu g�sesc utilizatorul', //cpg1.3.0
                'error_specify' => 'Trebuie s� specifica�i un nume sau o adresa IP', //cpg1.3.0
                'error_ban_id' => 'Ban ID invalid!', //cpg1.3.0
                'error_admin_ban' => 'Nu pute�i bana propriul user!', //cpg1.3.0
                'error_server_ban' => 'Nu pute�i bana propriul server!', //cpg1.3.0
                'error_ip_forbidden' => 'Nu pute�i bana acest IP - nu este rutabil!', //cpg1.3.0
                'lookup_ip' => 'Lookup adresa IP', //cpg1.3.0
                'submit' => 'da!', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
  'title' => '�ncarc� o imagine', //cpg1.3.0
  'custom_title' => 'Forma cerere', //cpg1.3.0
  'cust_instr_1' => 'Trebuie s� selecta�i num�rul de c�su�e de �nc�rcare, nu mai multe dec�t num�rul de mai jos.', //cpg1.3.0
  'cust_instr_2' => 'Cerere num�r c�su�e', //cpg1.3.0
  'cust_instr_3' => 'c�su�e �nc�rcat imagini: %s', //cpg1.3.0
  'cust_instr_4' => 'c�su�e �nc�rcat URL: %s', //cpg1.3.0
  'cust_instr_5' => 'c�su�e �nc�rcat URL:', //cpg1.3.0
  'cust_instr_6' => 'c�su�e �nc�rcat imagini:', //cpg1.3.0
  'cust_instr_7' => 'V� rug�m introduce�i num�rul de c�su�e. Apoi ap�sa�i \'Continuare\'. ', //cpg1.3.0
  'reg_instr_1' => 'Ac�iune invalid� pentru crearea formei.', //cpg1.3.0
  'reg_instr_2' => 'Acum pute�i �nc�rca imaginile folosind c�su�ele de mai jos. M�rimea imaginilor trimise c�tre server nu trebuie s� dep�easc� %s KB fiecare. Fi�ierele ZIP �nc�rcate �n \'�nc�rcare imagini\' �i \'�nc�rcare URL\' vor ram�ne comprimate.', //cpg1.3.0
  'reg_instr_3' => 'Dac� dori�i ca fi�ierele arhivate s� fie dezarhivate, trebuie s� folosi�i c�su�a \'�nc�rca�i ZIP decompresate\'.', //cpg1.3.0
  'reg_instr_4' => 'C�nd folosi�i �nc�rcare URL, v� rug�m s� folosi�i �ntreaga cale: http://www.pagina.ro/imagini/exemplu.jpg', //cpg1.3.0
  'reg_instr_5' => 'C�nd a�i completat formularul, v� rug�m ap�sa�i \'Continuare\'.', //cpg1.3.0
  'reg_instr_6' => '�nc�rcare ZIP decompresat:', //cpg1.3.0
  'reg_instr_7' => '�nc�rcare imagini:', //cpg1.3.0
  'reg_instr_8' => '�nc�rcare URL:', //cpg1.3.0
  'error_report' => 'Raporteaz� eroare', //cpg1.3.0
  'error_instr' => 'Urm�toarele �nc�rc�ri au erori:', //cpg1.3.0
  'file_name_url' => 'Imagine(i)/URL', //cpg1.3.0
  'error_message' => 'Mesaj eroare', //cpg1.3.0
  'no_post' => 'Imaginea nu poate fi �nc�rcat� prin POST.', //cpg1.3.0
  'forb_ext' => 'Extensia fi�ierului nepermis�.', //cpg1.3.0
  'exc_php_ini' => 'M�rimea imaginii permis� �n php.ini.', //cpg1.3.0
  'exc_file_size' => 'M�rimea imaginii permis� de galerie.', //cpg1.3.0
  'partial_upload' => '�nc�rcare par�ial�.', //cpg1.3.0
  'no_upload' => 'F�r� �nc�rcare.', //cpg1.3.0
  'unknown_code' => 'Eroare PHP necunoscut�.', //cpg1.3.0
  'no_temp_name' => 'F�r� �nc�rcare - f�r� nume temporar.', //cpg1.3.0
  'no_file_size' => 'Nu con�ine date/corupt', //cpg1.3.0
  'impossible' => 'Imposibil de mutat.', //cpg1.3.0
  'not_image' => 'Nu este imagine/corupt', //cpg1.3.0
  'not_GD' => 'Nu are extensie corect�.', //cpg1.3.0
  'pixel_allowance' => 'Num�r mare de pixeli .', //cpg1.3.0
  'incorrect_prefix' => 'Prefix URL incorect', //cpg1.3.0
  'could_not_open_URI' => 'Nu pot deschide URL.', //cpg1.3.0
  'unsafe_URI' => 'URL neverificabil.', //cpg1.3.0
  'meta_data_failure' => 'Eroare Meta data', //cpg1.3.0
  'http_401' => '401 Neautorizat', //cpg1.3.0
  'http_402' => '402 Necesit� plata', //cpg1.3.0
  'http_403' => '403 Inaccesibil', //cpg1.3.0
  'http_404' => '404 Neg�sit', //cpg1.3.0
  'http_500' => '500 Eroare intern�', //cpg1.3.0
  'http_503' => '503 Serviciu indisponibil', //cpg1.3.0
  'MIME_extraction_failure' => 'MIME nu a putut fi extras.', //cpg1.3.0
  'MIME_type_unknown' => 'Tip MIME necunoscut', //cpg1.3.0
  'cant_create_write' => 'Nu pot s� scriu.', //cpg1.3.0
  'not_writable' => 'Nu pot s� scriu �n imagine.', //cpg1.3.0
  'cant_read_URI' => 'Nu pot s� citesc URL', //cpg1.3.0
  'cant_open_write_file' => 'Nu pot deschide URL.', //cpg1.3.0
  'cant_write_write_file' => 'Nu pot s� scriu URL.', //cpg1.3.0
  'cant_unzip' => 'Nu pot dezarhiva.', //cpg1.3.0
  'unknown' => 'Eroare necunoscut�', //cpg1.3.0
  'succ' => '�nc�rcare reu�it�', //cpg1.3.0
  'success' => '%s �nc�rc�ri reu�ite.', //cpg1.3.0
  'add' => 'V� rug�m ap�sa�i \'Continuare\' pentru a ad�uga imagini �n album.', //cpg1.3.0
  'failure' => '�nc�rcare e�uat�', //cpg1.3.0
  'f_info' => 'Informa�ii imagine', //cpg1.3.0
  'no_place' => 'Precedenta imagine nu a putut fi �nc�rcat�.', //cpg1.3.0
  'yes_place' => 'Precedenta imagine a putut fi �nc�rcat�.', //cpg1.3.0
  'max_fsize' => 'Dimensiunea maxim� a imaginii este de %s KB',
  'album' => 'Album',
  'picture' => 'Imagine', //cpg1.3.0
  'pic_title' => 'Titlul imaginii', //cpg1.3.0
  'description' => 'Descrierea imaginii', //cpg1.3.0
  'keywords' => 'Cuvinte cheie (separate cu spa�iu)',
  'err_no_alb_uploadables' => 'Ne pare r�u dar nu exist� un album unde s� �nc�rca�i imaginile', //cpg1.3.0
  'place_instr_1' => 'V� rug�m s� pune�i imaginile �n albume �n acest moment. Pute�i de asemenea ad�uga informa�ii despre fiecare imagine.', //cpg1.3.0
  'place_instr_2' => 'Mai multe imagini necesit� plasare, v� rug�m ap�sa�i \'Continuare\'.', //cpg1.3.0
  'process_complete' => 'A�i ad�ugat cu succes toate imaginile.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
        'title' => 'Administrare utilizatori',
        'name_a' => 'Nume ascendent',
        'name_d' => 'Nume descendent',
        'group_a' => 'Grup ascendent',
        'group_d' => 'Grup descendent',
        'reg_a' => 'Data �nregistr�rii ascendent',
        'reg_d' => 'Data �nregistr�rii descendent',
        'pic_a' => 'Num�r imagini ascendent',
        'pic_d' => 'Num�r imagini descendent',
        'disku_a' => 'Utilizare spa�iu ascendent',
        'disku_d' => 'Utilizare spa�iu descendent',
        'sort_by' => 'Sorteaz� utilizatorii dup�',
        'err_no_users' => 'Tabelul cu utilizatori este gol!',
        'err_edit_self' => 'Nu pute�i edita propriul profil. Folosi�i op�iunea \'Profilul meu\' pentru aceasta',
        'edit' => 'Editeaz�',
        'delete' => '�terge',
        'name' => 'Nume utilizator',
        'group' => 'Grup',
        'inactive' => 'Inactiv',
        'operations' => 'Opera�ii',
        'pictures' => 'Imagini',
        'disk_space' => 'Spa�iu utilizat/Cota',
        'registered_on' => '�nregistrat la',
        'last_visit' => 'Ultima vizit�', //cpg1.3.0
        'u_user_on_p_pages' => '%d utilizatori pe %d pagini',
        'confirm_del' => 'Sunte�i sigur c� dori�i s� �terge�i acest utilizator ? \\nToate imaginile �i albumele sale vor fi de asemenea �terse',
        'mail' => 'Po�ta',
        'err_unknown_user' => 'Utilizatorul selectat nu exist�!',
        'modify_user' => 'Modific� utilizatorul',
        'notes' => 'Note',
        'note_list' => '<li>Dac� nu dori�i s� schimba�i parola, l�sa�i c�mpurile "Parola" libere',
        'password' => 'Parola',
        'user_active' => 'Utilizatorul este activ',
        'user_group' => 'Grup utilizatori',
        'user_email' => 'E-mail',
        'user_web_site' => 'Pagina web',
        'create_new_user' => 'Creaza utilizator nou',
        'user_location' => 'Loca�ie',
        'user_interests' => 'Interese',
        'user_occupation' => 'Ocupa�ie',
        'latest_upload' => 'Ultima �nc�rcare', //cpg1.3.0
        'never' => 'niciodat�', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => 'Redimensioneaz� imagini',
        'what_it_does' => 'Ce face',
        'what_update_titles' => 'Modific� titlurile dup� numele fi�ierului',
        'what_delete_title' => '�terge titlurile',
        'what_rebuild' => 'Reconstruie�te pictogramele �i imaginile intermediare',
        'what_delete_originals' => '�terge imaginile dimensionate ini�ial, �nlocuindu-le cu versiunea dimensionat�',
        'file' => 'Fi�ier',
        'title_set_to' => 'titlu setat ca',
        'submit_form' => 'trimite',
        'updated_succesfully' => 'modificat� cu succes',
        'error_create' => 'Eroare creare',
        'continue' => 'Proceseaz� mai multe imagini',
        'main_success' => 'Fi�ierul %s a fost folosit cu succes ca imagine principal�',
        'error_rename' => 'Eroare redenumire %s cu %s',
        'error_not_found' => 'Fi�ierul %s nu a fost g�sit',
        'back' => '�napoi la principal',
        'thumbs_wait' => 'Modificare pictograme �i/sau imagini intermediare, v� rug�m astepta�i...',
        'thumbs_continue_wait' => 'Continuare modificare pictograme �i/sau imagini intermediare...',
        'titles_wait' => 'Modificare titluri, v� rug�m astepta�i...',
        'delete_wait' => '�tergere titluri, v� rug�m astepta�i...',
        'replace_wait' => '�tergere originale �i modificare cu versiunile redimensionate, v� rug�m astepta�i...',
        'instruction' => 'Instruc�iuni rapide',
        'instruction_action' => 'Selecteaz� o ac�iune',
        'instruction_parameter' => 'Seteaz� parametrii',
        'instruction_album' => 'Selecteaz� un album',
        'instruction_press' => 'Apas� %s',
        'update' => 'Modific� pictograme �i/sau imagini intermediare',
        'update_what' => 'Ce trebuie modificat',
        'update_thumb' => 'Doar pictograme',
        'update_pic' => 'Doar imaginile intermediare',
        'update_both' => 'Am�ndou�',
        'update_number' => 'Num�rul de imagini procesate pentru o ap�sare',
        'update_option' => '(�ncerca�i o setare mai mic� dac� primi�i timeout-uri)',
        'filename_title' => 'Nume fi�ier &rArr; Titlu imagine',
        'filename_how' => 'Cum trebuie modificat titlul',
        'filename_remove' => 'Elimin� .jpg din final �i �nlocuie�te _ (liniu�a de subliniere) cu spa�iu',
        'filename_euro' => 'Schimb� 2003_11_23_13_20_20.jpg cu 23/11/2003 13:20',
        'filename_us' => 'Schimb� 2003_11_23_13_20_20.jpg cu 11/23/2003 13:20',
        'filename_time' => 'Schimb� 2003_11_23_13_20_20.jpg cu 13:20',
        'delete' => '�terge titlurile sau imaginile originale',
        'delete_title' => '�terge titlurile imaginilor',
        'delete_original' => '�terge imaginile originale',
        'delete_replace' => '�terge originalele, �nlocuindu-le cu versiunile dimensionate',
        'select_album' => 'Selecteaz� album',
        'delete_orphans' => '�terge comentarii orfane (�n toate albumele)', //cpg1.3.0
        'orphan_comment' => 'Comentarii orfane', //cpg1.3.0
        'delete' => '�terge', //cpg1.3.0
        'delete_all' => '�terge tot', //cpg1.3.0
        'comment' => 'Comentariu: ', //cpg1.3.0
        'nonexist' => 'ata�at unei imagini inexistente # ', //cpg1.3.0
        'phpinfo' => 'Arat� phpinfo', //cpg1.3.0
        'update_db' => 'Actualizeaz� baza de date', //cpg1.3.0
        'update_db_explanation' => 'Dac� a�i modificat fi�ierele galeriei sau a�i f�cut up-grade, actualizea�i baza de date. Aceasta va salva tabelele necesare �i configur�rile �n baza de date a galeriei.', //cpg1.3.0
);

?>