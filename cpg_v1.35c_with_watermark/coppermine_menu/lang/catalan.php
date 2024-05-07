<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.3.2                                            //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002,2003 Gregory DEMAR                                     //
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
// ENCODING CHECK; SHOULD BE YEN BETA MU: � � �
// ------------------------------------------------------------------------- //
// CVS version: $Id: catalan.php,v 1.6 2004/12/29 23:03:48 chtito Exp $
// ------------------------------------------------------------------------- //




// info about translators and translated language
$lang_translation_info = array(
'lang_name_english' => 'Catalan',  
'lang_name_native' => 'Catal�',
'lang_country_code' => 'es', 
'trans_name'=> 'simkin', //the name of the translator - can be a nickname
'trans_email' => 'simkin@ono.com', //translator's email address (optional)
'trans_website' => 'http://simkin.now.nu/', //translator's website (optional)
'trans_date' => '2004-09-02', //the date the translation was created / last modified
);

$lang_charset = 'iso-8859-1';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Octets', 'Kb', 'Mb');

// Day of weeks and months
$lang_day_of_week = array('Dg', 'Dl', 'Dt', 'Dc', 'Dj', 'Dv', 'Ds');
$lang_month = array('Gen', 'Febr', 'Mar�', 'Abr', 'Maig', 'Juny', 'Jul', 'Ago', 'Set', 'Oct', 'Nov', 'Des');

// Some common strings
$lang_yes = 'Si';
$lang_no  = 'No';
$lang_back = 'ARRERE';
$lang_continue = 'CONTINUA';
$lang_info = 'Informaci�';
$lang_error = 'Error';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%d de %B de %Y';
$lastcom_date_fmt =  '%d/%m/%y a les %H:%M';
$lastup_date_fmt = '%d de %B de %Y';
$register_date_fmt = '%d de %B de %Y';
$lasthit_date_fmt = '%d de %B de %Y a les %I:%M %p';
$comment_date_fmt =  '%d de %B de %Y a les %I:%M %p';
$log_date_fmt = '%d %B, %Y a les %I:%M %p'; //cpg 1.4.0

// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array(
	'random' => 'Fitxers aleatoris',
	'lastup' => '�ltims fitxers',
    'lastalb'=> '�ltims �lbums modificats',
	'lastcom' => '�ltims comentaris',
	'topn' => 'M�s vists',
	'toprated' => 'M�s valorats',
	'lasthits' => '�ltims vists',
	'search' => 'Resultat de la recerca',
    'favpics'=> 'Favorits'
);

$lang_errors = array(
	'access_denied' => 'No teniu permisos per a accedir a aquesta p�gina.',
	'perm_denied' => 'No te permisos per a realitzar aquesta operaci�.',
	'param_missing' => 'Falten par�metres requerits.',
	'non_exist_ap' => 'L\'�lbum/fitxer seleccionat no existeix!',
	'quota_exceeded' => 'Quota de disc excedida<br /><br />Teniu una quota de disc de [quota]K, els seus fitxers ocupen actualment [space]K, i afegint aquest fitxer excedirieu la quota.',
	'gd_file_type_err' => 'Quan s\'usa la llibreria d\'imatge GD solament estan permesos els tipus JPEG i PNG.',
	'invalid_image' => 'La imatge que heu afegit est� corrupta o no pot ser tractada per la llibreria GD.',
	'resize_failed' => 'No es pot crear miniatura.',
	'no_img_to_display' => 'No hi ha cap imatge per mostrar.',
	'non_exist_cat' => 'La categoria seleccionada no existeix.',
	'orphan_cat' => 'Una categoria no t� pare, executeu el gestor de categories per a corregir el problema.',
	'directory_ro' => 'El directori \'%s\' no t� permisos d\'escriptura, el fitxers no poden ser esborrats.',
	'non_exist_comment' => 'El comentari seleccionat no existeix.',
	'pic_in_invalid_album' => 'El fitxer est� en un �lbum que no existeix (%s)!?',
    'banned' => 'Actualment est�s expulsat de l\'�s d\'aquesta web.',
    'not_with_udb' => 'Aquesta funci� est� desactivada en Coppermine perqu� est� integrada amb un programari de f�rums. El que sigui que est� intentant fer no est� suportat per aquesta configuraci�, o la funci� hauria de ser gestionada pel programari de f�rums.',
	'offline_title' => 'Fora de l�nia',
	'offline_text' => 'La galeria est� actualment fora de l�nia - torneu prompte!',
	'ecards_empty' => 'Actualment no hi ha cap registre de postals per a mostrar. Comproveu que heu activat el registre de postals en la configuraci� de coppermine!',
	'action_failed' => 'L\'acci� ha fallat. Coppermine no pot processar la vostra petici�.',
	'no_zip' => 'Les llibreries necess�ries per a processar fitxers ZIP no s�n disponibles. Per favor contacteu amb l\'administrador d\'aquesta galeria.',
	'zip_type' => 'No teniu perm�s per a penjar fitxers ZIP.',
);

$lang_bbcode_help = 'Els seg�ents codis poden ser-vos d\'utilitat:<li>[b]<b>Negreta</b>[/b]</li> <li>[i]<i>Cursiva</i>[/i]</li> <li>[url=http://lavostraweb.com/]Nom de la web[/url]</li> <li>[email]usuari@domini.com[/email]</li>'; 

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => 'V�s a la llista d\'�lbums',
	'alb_list_lnk' => 'Llista d\'�lbums',
	'my_gal_title' => 'V�s a la meva galeria personal',
	'my_gal_lnk' => 'La meva galeria',
	'my_prof_lnk' => 'El meu perfil d\'usuari',
	'adm_mode_title' => 'Canvia a mode administrador',
	'adm_mode_lnk' => 'Mode Admininstrador',
	'usr_mode_title' => 'Canvia a mode usuari',
	'usr_mode_lnk' => 'Mode Usuari',
	'upload_pic_title' => 'Insereix un fitxer a un �lbum',
	'upload_pic_lnk' => 'Insereix fitxer',
	'register_title' => 'Crea un compte',
	'register_lnk' => 'Registreu-vos',
	'login_lnk' => 'Entreu',
	'logout_lnk' => 'Sortiu',
	'lastup_lnk' => '�ltims fitxers',
	'lastcom_lnk' => '�ltims comentaris',
	'topn_lnk' => 'M�s vists',
	'toprated_lnk' => 'M�s valorats',
	'search_lnk' => 'Cercar',
	'fav_lnk' => 'Els meus Favorits',
	'memberlist_title' => 'Mostra llista d\'usuaris', 
	'memberlist_lnk' => 'Llista d\'usuaris', 
	'faq_title' => 'Preguntes m�s freq�ents sobre la galeria d\'imatges &quot;Coppermine&quot;',
	'faq_lnk' => 'PMF', 
);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => 'Aprova pujades',
	'config_lnk' => 'Configuraci�',
	'albums_lnk' => '�lbums',
	'categories_lnk' => 'Categories',
	'users_lnk' => 'Usuaris',
	'groups_lnk' => 'Grups',
	'comments_lnk' => 'Comentaris',
	'searchnew_lnk' => 'Afegeix fitxers (FTP)',
    'util_lnk' => 'Eines',
    'ban_lnk' => 'Expulsa Usuaris',
	'db_ecard_lnk' => 'Mostra postals', 
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => 'Crea / ordena �lbums',
	'modifyalb_lnk' => 'Modifica els meus �lbums',
	'my_prof_lnk' => 'El meu perfil',
);

$lang_cat_list = array(
	'category' => 'Categoria',
	'albums' => '�lbums',
	'pictures' => 'Fitxers',
);

$lang_album_list = array(
	'album_on_page' => '%d �lbums en %d p�gina(s)'
);

$lang_thumb_view = array(
	'date' => 'DATA',
        //Sort by filename and title
	'name' => 'NOM',
    'title' => 'T�TOL',
	'sort_da' => 'Ordenat per data ascendent',
	'sort_dd' => 'Ordenat per data descendent',
	'sort_na' => 'Ordenat per nom ascendent',
	'sort_nd' => 'Ordenat per nom descendent',
    'sort_ta' => 'Ordenat per t�tol ascendent',
    'sort_td' => 'Ordenat per t�tol descendent',
	'download_zip' => 'Descarrega com fitxer ZIP', 
	'pic_on_page' => '%d fitxers en %d p�gina(s)',
	'user_on_page' => '%d usuaris en %d p�gina(s)'
);

$lang_img_nav_bar = array(
	'thumb_title' => 'Torna a l\'�ndex de l\'�lbum',
	'pic_info_title' => 'Mostra/oculta informaci� del fitxer',
	'slideshow_title' => 'Projecci� de diapositives',
	'ecard_title' => 'Enviar aquesta fitxer a un amic/ga',
	'ecard_disabled' => 'Enviament de postals deshabilitat',
	'ecard_disabled_msg' => 'No teniu permisos per a enviar postals',
	'prev_title' => 'Veure fitxer anterior',
	'next_title' => 'Veure fitxer seg�ent',
	'pic_pos' => 'FITXER %s/%s',
);

$lang_rate_pic = array(
	'rate_this_pic' => 'Valora aquest fitxer ',
	'no_votes' => '(No hi ha vots)',
	'rating' => '(valoraci� actual : %s / 5 amb %s vots)',
	'rubbish' => 'Dolent',
	'poor' => 'Regular',
	'fair' => 'Normal',
	'good' => 'Bo',
	'excellent' => 'Excel�lent',
	'great' => 'Genial',
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
	CRITICAL_ERROR => 'Error cr�tic',
	'file' => 'Fitxer: ',
	'line' => 'L�nia: ',
);

$lang_display_thumbnails = array(
	'filename' => 'Fitxer: ',
	'filesize' => 'Mida: ',
	'dimensions' => 'Dimensions: ',
	'date_added' => 'Data d\'alta: '
);

$lang_get_pic_data = array(
	'n_comments' => '%s comentaris',
	'n_views' => 'vist %s vegades',
	'n_votes' => '(%s vots)'
);

$lang_cpg_debug_output = array(
  'debug_info' => 'Depuraci�', 
  'select_all' => 'Selecciona Tot', 
  'copy_and_paste_instructions' => 'Si aneu a demanar ajuda al f�rum de suport de coppermine, aleshores copieu i enganxeu la sortida de depuraci� al vostre missatge. Assegureu-vos de reempla�ar qualsevol contrasenya de la consulta amb *** abans de penjar el missatge.', 
  'phpinfo' => 'mostra phpinfo', 
);

$lang_language_selection = array(
  'reset_language' => 'Idioma per defecte', 
  'choose_language' => 'Trieu el vostre idioma', 
);

$lang_theme_selection = array(
  'reset_theme' => 'Aparen�a per defecte', 
  'choose_theme' => 'Trieu aparen�a', 
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
	'Exclamation' => 'Exclamaci�',
	'Question' => 'Pregunta',
	'Very Happy' => 'Molt Feli�',
	'Smile' => 'Somriure',
	'Sad' => 'Trist',
	'Surprised' => 'Sorpr�s',
	'Shocked' => 'Impressionat',
	'Confused' => 'Conf�s',
	'Cool' => 'Guai',
	'Laughing' => 'Rient',
	'Mad' => 'Furi�s',
	'Razz' => 'Razz',
	'Embarassed' => 'Avergonyit',
	'Crying or Very sad' => 'Plorant o molt trist',
	'Evil or Very Mad' => 'Dolent o molt boig',
	'Twisted Evil' => 'Dimoni malvat',
	'Rolling Eyes' => 'Ulls girant',
	'Wink' => 'Fent l\'ullet',
	'Idea' => 'Idea',
	'Arrow' => 'Fletxa',
	'Neutral' => 'Neutral',
	'Mr. Green' => 'Mr. Verd',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
	0 => 'Sortint del mode administrador...',
	1 => 'Entrant al mode administrador...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => 'Els �lbums han de tenir un nom!',
	'confirm_modifs' => 'Esteu segur d\\\'aplicar aquestes modificacions?',
	'no_change' => 'No s\\\'ha fet cap canvi!',
	'new_album' => 'Nou �lbum',
	'confirm_delete1' => 'Esteu segur de voler esborrar aquest �lbum?',
	'confirm_delete2' => '\nTots els fitxers i comentaris que cont� es perdran!',
	'select_first' => 'Seleccioneu un �lbum primer',
	'alb_mrg' => 'Gestor d\'�lbums',
	'my_gallery' => '* La meva galeria *',
	'no_category' => '* Sense categoria *',
	'delete' => 'Esborra',
	'new' => 'Nou',
	'apply_modifs' => 'Aplica modificacions',
	'select_category' => 'Selecciona categoria',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => 'Els par�metres requerits per a l\'operaci�: \'%s\' no han estat subministrats!',
	'unknown_cat' => 'La categoria seleccionada no existeix a la base de dades',
	'usergal_cat_ro' => 'La categoria de galeries d\'usuari no pot ser esborrada!',
	'manage_cat' => 'Gestiona les categories',
	'confirm_delete' => 'Esteu segur de voler ESBORRAR aquesta catagor�a',
	'category' => 'Categoria',
	'operations' => 'Operacions',
	'move_into' => 'Moure cap a',
	'update_create' => 'Modifica/Crea categoria',
	'parent_cat' => 'Categoria pare',
	'cat_title' => 'T�tol de la categoria',
	'cat_thumb' => 'Miniatura de la categoria',
	'cat_desc' => 'Descripci� de la categoria'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => 'Configuraci�',
	'restore_cfg' => 'Restaura valors per defecte',
	'save_cfg' => 'Desa la nova configuraci�',
	'notes' => 'Notes',
	'info' => 'Informaci�',
	'upd_success' => 'La configuraci� de Coppermine ha estat actualitzada',
	'restore_success' => 'Valors per defecte de Coppermine restaurats',
	'name_a' => 'Ascendent per nom',
	'name_d' => 'Descendent per nom',
    'title_a' => 'Ascendent per t�tol',
    'title_d' => 'Descendent per t�tol',
	'date_a' => 'Ascendent per data',
	'date_d' => 'Descendent per data',
    'th_any' => 'M�x. relaci� d\'aspecte',
    'th_ht' => 'Al�ada',
    'th_wd' => 'Amplada',
    'label' => 'etiqueta', 
	'item' => '�tem', 
	'debug_everyone' => 'Tothom', 
	'debug_admin' => 'Nom�s Admin', 
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'Par�metres Generals',
	array('Nom de la galeria', 'gallery_name', 0),
	array('Descripci� de la galeria', 'gallery_description', 0),
	array('Correu electr�nic de l\'administrador', 'gallery_admin_email', 0),
	array('Adre�a web associada a l\'enlla�  \'Veure m�s imatges\' de les postals', 'ecards_more_pic_target', 0),
	array('La galeria �s fora de l�nia', 'offline', 1), 
	array('Registre de postals', 'log_ecards', 1), 
	array('Permetre descarregues de favorits en format ZIP', 'enable_zipdownload', 1), 

	'Idioma, aparen�a i par�metres del joc de car�cters',
	array('Idioma', 'lang', 5),
	array('Aparen�a', 'theme', 6),
	array('Mostra llista d\'idiomes', 'language_list', 8), 
	array('Mostra banderes d\'idiomes', 'language_flags', 8), 
	array('Mostra &quot;reinicia&quot; en la selecci� d\'idiomes', 'language_reset', 1), 
	array('Mostra llista d\'aparences', 'theme_list', 8), 
	array('Mostra &quot;reinicia&quot; en la selecci� d\'aparences', 'theme_reset', 1), 
	array('Mostra PMF', 'display_faq', 1), 
	array('Mostra l\'ajuda per al bbcode', 'show_bbcode_help', 1), 
	array('Joc de car�cters', 'charset', 4), 

	'Aspecte de la llista d\'�lbums',
	array('Ampl�ria de la taula principal (p�xels o %)', 'main_table_width', 0),
	array('Nombre de nivells de categories a mostrar', 'subcat_level', 0),
	array('Nombre d\'�lbums a mostrar', 'albums_per_page', 0),
	array('Nombre de columnes a la llista d\'�lbums', 'album_list_cols', 0),
	array('Grand�ria de les miniatures en p�xels', 'alb_list_thumb_size', 0),
	array('Contingut de la p�gina principal', 'main_page_layout', 0),
    array('Mostra miniatures d\'�lbums de primer nivell en categories','first_level',1),

	'Aspecte de la visualitzaci� de miniatures',
	array('Nombre de columnes a la p�gina de miniatures', 'thumbcols', 0),
	array('Nombre de files a la p�gina de miniatures', 'thumbrows', 0),
	array('Nombre m�xim de pestanyes a mostrar', 'max_tabs', 0),
	array('Mostra peu del fitxer (a m�s del t�tol) sota la miniatura', 'caption_in_thumbview', 1),
	array('Mostra el nombre de vegades vist sota la miniatura', 'views_in_thumbview', 1),
	array('Mostra el nombre de comentaris sota la miniatura', 'display_comment_count', 1),
	array('Mostra el nom de l\'usuari que va afegir el fitxer sota la miniatura', 'display_uploader', 1),
	array('Ordre per defecte de les imatges', 'default_sort_order', 3),
	array('M�nim nombre de vots perqu� una imatge aparegui a la llista de  \'M�s Valorades\'', 'min_votes_for_rating', 0),

	'Visualitzaci� d\'imatges i par�metres dels comentaris',
	array('Ampl�ria de la taula on mostrar la imatge (p�xels o %)', 'picture_table_width', 0),
	array('Informaci� del fitxer visible per defecte', 'display_pic_info', 1),
	array('Filtra paraules malsonants als comentaris', 'filter_bad_words', 1),
	array('Permet emoticones als comentaris', 'enable_smilies', 1),
	array('Permet diversos comentaris consecutius sobre un fitxer per part del mateix usuari (inhabilita la protecci� d\'acumulaci�)', 'disable_comment_flood_protect', 1),
	array('M�xima longitud per a la descripci� d\'un fitxer', 'max_img_desc_length', 0),
	array('M�xim nombre de car�cters d\'una paraula', 'max_com_wlength', 0),
	array('M�xim nombre de l�nies d\'un comentari', 'max_com_lines', 0),
	array('M�xima longitud d\'un comentari', 'max_com_size', 0),
    array('Mostrar tira de pel�l�cula', 'display_film_strip', 1),
    array('Nombre d\'objectes de la tira de pel�l�cula', 'max_film_strip_items', 0),
    array('Notifica a l\'administrador sobre nous comentaris (per email)', 'email_comment_notification', 1),
    array('Interval (en milisegons) per a la projecci� de diapositives (1 segon = 1000 milisegons)', 'slideshow_interval', 0),

	'Par�metres dels fitxers i les miniatures',
	array('Qualitat per als fitxers JPEG', 'jpeg_qual', 0),
	array('Dimensi� m�xima d\'una miniatura <a href="#notice2" class="clickable_option">**</a>', 'thumb_width', 0),
    array('Usa dimensi� ( ampl�ria o al�ada o m�xima relaci� per a les miniatures )<a href="#notice2" class="clickable_option">**</a>', 'thumb_use', 7),
	array('Crea imatges de grand�ria interm�dia','make_intermediate',1),
	array('Ampl�ria o al�ada m�xima d\'una imatge/v�deo de grand�ria interm�dia <a href="#notice2" class="clickable_option">**</a>', 'picture_width', 0),
	array('Mida m�xima per a fitxers penjats (KB)', 'max_upl_size', 0),
	array('Ampl�ria o al�ada m�xima per a les imatges/v�deos penjats (p�xels)', 'max_upl_width_height', 0),

	'Par�metres avan�ats per a fitxers i miniatures', 
	array('Mostra icona d\'�lbum privat als usuaris no identificats','show_private',1), 
	array('Car�cters no permesos al nom dels fitxers', 'forbiden_fname_char',0), 
	//array('Extensions de fitxer permeses per a imatges penjades', 'allowed_file_extensions',0), 
	array('Tipus d\'imatge permeses', 'allowed_img_types',0), 
	array('Tipus de v�deo permesos', 'allowed_mov_types',0), 
	array('Tipus d\'�udio permesos', 'allowed_snd_types',0), 
	array('Tipus de documents permesos', 'allowed_doc_types',0), 
	array('M�tode per a redimensionar imatges','thumb_method',2), 
	array('Cam� a la utilitat \'convert\' de ImageMagick (p.ex. /usr/bin/X11/)', 'impath', 0), 
	//array('Tipus d\'imatge permeses (nom�s v�lid per a ImageMagick)', 'allowed_img_types',0), 
	array('Ordres de l�nia per a ImageMagick', 'im_options', 0), 
	array('Llegeix dades EXIF dels fitxers JPEG', 'read_exif_data', 1), 
	array('Llegeix dades IPTC dels fitxers JPEG', 'read_iptc_data', 1), 
	array('Directori dels �lbums <a href="#notice1" class="clickable_option">*</a>', 'fullpath', 0), 
	array('Directori per als fitxers dels usuaris <a href="#notice1" class="clickable_option">*</a>', 'userpics', 0), 
	array('Prefixe per a les imatges interm�dies <a href="#notice1" class="clickable_option">*</a>', 'normal_pfx', 0), 
	array('Prefixe per a les miniatures <a href="#notice1" class="clickable_option">*</a>', 'thumb_pfx', 0), 
	array('Mode per defecte per als directoris', 'default_dir_mode', 0), 
	array('Mode per defecte per als fitxers', 'default_file_mode', 0), 

	'Par�metres d\'usuari',
	array('Permetre el registre de nous usuaris', 'allow_user_registration', 1),
	array('Registre d\'usuaris requereix verificaci� per correu electr�nic', 'reg_requires_valid_email', 1),
	array('Notifica a l\'administrador del registre d\'usuaris per email', 'reg_notify_admin_email', 1),
	array('Permetre a dos usuaris tenir el mateix correu electr�nic', 'allow_duplicate_emails_addr', 1),
	array('Els usuaris poden tenir �lbums privats (Nota: si canvieu de \'si\' a \'no\' qualsevol �lbum privat actual esdevindr� p�blic)', 'allow_private_albums', 1),
	array('Notifica a l\'administrador de fitxers pujats esperant autoritzaci�', 'upl_notify_admin_email', 1),
	array('Permet als usuaris identificats veure la llista d\'usuaris', 'allow_memberlist', 1),

	'Camps extra per a descripci� d\'imatges (deixeu en blanc si no els useu)',
	array('Nom del camp 1', 'user_field1_name', 0),
	array('Nom del camp 2', 'user_field2_name', 0),
	array('Nom del camp 3', 'user_field3_name', 0),
	array('Nom del camp 4', 'user_field4_name', 0),

	'Configuraci� de galetes (cookies)',
	array('Nom de la galeta usada per coppermine (quan s\'usa la integraci� amb f�rums, assegureu-vos que el nom sigui diferent del de la galeta del f�rum)', 'cookie_name', 0),
	array('Cam� de la galeta usada per coppermine', 'cookie_path', 0),

	'Altres par�metres',
	array('Habilita mode de depuraci�', 'debug_mode', 9),
	array('Mostra avisos en mode de depuraci�', 'debug_notice', 1),

  '<br /><div align="left"><a name="notice1"></a>(*) Aquests par�metres no deuen ser canviats si ja teniu fitxers a la vostra base de dades.<br />
  <a name="notice2"></a>(**) Si es canvia aquest par�metre, nom�s afectar� als fitxers afegits d\'ara en avant, per tant si ja hi ha fitxers a la galeria �s recomanable que no es canvie aquest par�metre. Podeu, tanmateix, fer efectius els canvis sobre les imatges existents amb les &quot;<a href="util.php">eines</a>&quot; de redimensi� d\'imatges del men� d\'administraci�.</div><br />',
);

// ------------------------------------------------------------------------- //
// File db_ecard.php 
// ------------------------------------------------------------------------- //

if (defined('DB_ECARD_PHP')) $lang_db_ecard_php = array(
  'title' => 'Postals enviades', 
  'ecard_sender' => 'Remitent', 
  'ecard_recipient' => 'Destinatari', 
  'ecard_date' => 'Data', 
  'ecard_display' => 'Mostra postal', 
  'ecard_name' => 'Nom', 
  'ecard_email' => 'Correu electr�nic', 
  'ecard_ip' => 'IP #', 
  'ecard_ascending' => 'ascendent', 
  'ecard_descending' => 'descendent', 
  'ecard_sorted' => 'Ordre', 
  'ecard_by_date' => 'per data', 
  'ecard_by_sender_name' => 'per nom del remitent', 
  'ecard_by_sender_email' => 'per correu electr�nic del remitent', 
  'ecard_by_sender_ip' => 'per IP del remitent', 
  'ecard_by_recipient_name' => 'per nom del destinatari', 
  'ecard_by_recipient_email' => 'per correu electr�nic del destinatari', 
  'ecard_number' => 'mostrant registres %s al %s de %s', 
  'ecard_goto_page' => 'v�s a la p�gina', 
  'ecard_records_per_page' => 'Registres per p�gina', 
  'check_all' => 'Activar Tots', 
  'uncheck_all' => 'Desactivar Tots', 
  'ecards_delete_selected' => 'Esborra postals seleccionades', 
  'ecards_delete_confirm' => 'Esteu segur de voler esborrar els registres? Marqueu el quadre de verificaci�!', 
  'ecards_delete_sure' => 'Estic segur', 
);


// ------------------------------------------------------------------------- //
// File dbinput.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => 'Heu d\'introduir el vostre nom i un comentari',
	'com_added' => 'El vostre comentari ha estat afegit',
	'alb_need_title' => 'Heu d\'introduir un t�tol per a l\'�lbum!',
	'no_udp_needed' => 'No es requereix cap canvi.',
	'alb_updated' => 'L\'�lbum ha estat actualitzat',
	'unknown_album' => 'L\'�lbum seleccionat no existeix o no teniu permisos per a afegir fitxers en aquest �lbum',
	'no_pic_uploaded' => 'No s\'ha penjat cap fitxer!<br /><br />Si havieu seleccionat un fitxer per a afegir, comproveu que el servidor admet penjar fitxers...',
	'err_mkdir' => 'No s\'ha pogut crear el directori %s!',
	'dest_dir_ro' => 'El directori de dest� %s no t� permisos d\'escriptura!',
	'err_move' => 'Impossible moure %s a  %s !',
	'err_fsize_too_large' => 'La mida del fitxer que heu penjat �s massa gran (el m�xim perm�s �s de %s x %s)',
	'err_imgsize_too_large' => 'La mida del fitxer que heu penjat �s massa gran (el m�xim perm�s �s de %s KB)',
	'err_invalid_img' => 'El fitxer que heu penjat no �s una imatge v�lida',
	'allowed_img_types' => 'Nom�s podeu penjar %s imatges.',
	'err_insert_pic' => 'El fitxer \'%s\' no es pot inserir a l\'�lbum ',
	'upload_success' => 'El vostre fitxer ha estat penjat amb �xit<br /><br />Ser� visible despr�s de l\'aprovaci� dels administradors.',
	'notify_admin_email_subject' => '%s - Notificaci� de fitxer penjat',
	'notify_admin_email_body' => 'Una imatge que necessita la vostra aprovaci� ha estat penjada per %s. Visiteu %s',
	'info' => 'Informaci�',
	'com_added' => 'Comentari afegit',
	'alb_updated' => '�lbum actualitzat',
	'err_comment_empty' => 'El vostre comentari est� buit!',
	'err_invalid_fext' => 'Nom�s s�n admesos fitxers amb les seg�ents extensions : <br /><br />%s.',
	'no_flood' => 'Perdoneu per� sou l\'autor/a de l\'�ltim comentari introdu�t en aquest fitxer<br /><br />Podeu editar el comentari que heu posat si voleu modificar-lo',
	'redirect_msg' => 'Esteu sent redirigit.<br /><br /><br />Premeu \'CONTINUAR\' si la p�gina no es refresca autom�ticament',
	'upl_success' => 'El vostre fitxer ha estat afegit amb �xit',
	'email_comment_subject' => 'Comentari enviat a la Galeria Coppermine',
	'email_comment_body' => 'Alg� ha enviat un comentari a la vostra galeria. Vegeu-lo a',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => 'Peu',
	'fs_pic' => 'imatge mida completa',
	'del_success' => 'esborrat amb �xit',
	'ns_pic' => 'imatge mida normal',
	'err_del' => 'no pot ser esborrat',
	'thumb_pic' => 'miniatura',
	'comment' => 'comentari',
	'im_in_alb' => 'imatges a l\'�lbum',
	'alb_del_success' => '�lbum \'%s\' esborrat',
	'alb_mgr' => 'Gestor d\'�lbums',
	'err_invalid_data' => 'Dades inv�lides rebudes en \'%s\'',
	'create_alb' => 'Creant �lbum \'%s\'',
	'update_alb' => 'Actualitzant �lbum \'%s\' amb el t�tol \'%s\' i l\'�ndex \'%s\'',
	'del_pic' => 'Esborra imatge',
	'del_alb' => 'Esborra �lbum',
	'del_user' => 'Esborra usuari',
	'err_unknown_user' => 'L\'usuari seleccionat no existeix!',
	'comment_deleted' => 'El comentari ha estat esborrat',
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
	'confirm_del' => 'Esteu segur de voler ESBORRAR aquest fitxer? \\nEls comentaris tamb� seran esborrats.',
	'del_pic' => 'ESBORRA AQUESTA IMATGE',
	'size' => '%s x %s p�xels',
	'views' => '%s vegades',
	'slideshow' => 'Projecci� de diapositives',
	'stop_slideshow' => 'ATURA PROJECCI�',
	'view_fs' => 'Premeu aqu� per a veure la imatge a mida completa',
	'edit_pic' => 'Edita descripci�',
	'crop_pic' => 'Escap�a i gira',
);

$lang_picinfo = array(
	'title' =>'Informaci� del fitxer',
	'Filename' => 'Nom del fitxer',
	'Album name' => 'Nom de l\'�lbum',
	'Rating' => 'Valoraci� (%s vots)',
	'Keywords' => 'Paraules clau',
	'File Size' => 'Mida del fitxer',
	'Dimensions' => 'Dimensions',
	'Displayed' => 'S\'ha vist',
	'Camera' => 'C�mera',
	'Date taken' => 'Data de la captura',
	'Aperture' => 'Obertura',
	'Exposure time' => 'Temps d\'exposici�',
	'Focal length' => 'Longitud del focus',
	'Comment' => 'Comentari',
    'addFav' => 'Afegeix a Favorits',
    'addFavPhrase' => 'Favorits',
    'remFav' => 'Lleva de Favorits',
	'iptcTitle'=>'T�tol IPTC',
	'iptcCopyright'=>'Copyright IPTC',
	'iptcKeywords'=>'Paraules clau IPTC',
	'iptcCategory'=>'Categoria IPTC',
	'iptcSubCategories'=>'Sub Categories IPTC',
);

$lang_display_comments = array(
	'OK' => 'D\'acord',
	'edit_title' => 'Edita aquest comentari',
	'confirm_delete' => 'Esteu segur de voler esborrar aquest comentari?',
	'add_your_comment' => 'Afegiu el vostre comentari',
    'name'=>'Nom',
    'comment'=>'Comentari',
	'your_name' => 'An�nim',
);

$lang_fullsize_popup = array(
        'click_to_close' => 'Premeu la imatge per a tancar aquesta finestra',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => 'Envieu una postal',
	'invalid_email' => '<b>Atenci�</b>: adre�a electr�nica incorrecta!',
	'ecard_title' => 'Una postal de %s per a tu',
	'error_not_image' => 'Nom�s podeu enviar postals amb imatges.',
	'view_ecard' => 'Si la imatge no es veu correctament, premeu en aquest enlla�',
	'view_more_pics' => 'Premeu aquest enlla� per a veure m�s imatges!',
	'send_success' => 'La postal ha estat enviada',
	'send_failed' => 'Disculpeu per� el servidor no pot enviar la vostra postal...',
	'from' => 'De',
	'your_name' => 'El vostre nom',
	'your_email' => 'La vostra adre�a electr�nica',
	'to' => 'A',
	'rcpt_name' => 'Nom del destinatari',
	'rcpt_email' => 'Adre�a electr�nica del destinatari',
	'greetings' => 'T�tol del missatge',
	'message' => 'Missatge',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => 'Informaci�',
	'album' => '�lbum',
	'title' => 'T�tol',
	'desc' => 'Descripci�',
	'keywords' => 'Paraules Clau',
	'pic_info_str' => '%s &times; %s - %s KB - vist %s vegades - %s vots',
	'approve' => 'Aprova el fitxer',
	'postpone_app' => 'Posposa l\'aprovament',
	'del_pic' => 'Esborra fitxer',
	'read_exif' => 'Torna a llegir informaci� EXIF', 
	'reset_view_count' => 'Posa a zero el comptador de visualitzacions',
	'reset_votes' => 'Posar a zero els vots',
	'del_comm' => 'Esborra comentaris',
	'upl_approval' => 'Aprova fitxers penjats',
	'edit_pics' => 'Edita fitxers',
	'see_next' => 'Veure fitxers seg�ents',
	'see_prev' => 'Veure fitxers anteriors',
	'n_pic' => '%s fitxers',
	'n_of_pic_to_disp' => 'Nombre de fitxers a mostrar',
	'apply' => 'Aplica els canvis',
	'crop_title' => 'Editor d\'Imatges de Coppermine',
	'preview' => 'Visualitzaci� pr�via',
	'save' => 'Desa imatge',
	'save_thumb' =>'Desa com miniatura',
	'sel_on_img' =>'La selecci� ha d\\\'estar per complet en la imatge!', //js-alert 
);

// ------------------------------------------------------------------------- //
// File faq.php 
// ------------------------------------------------------------------------- //

if (defined('FAQ_PHP')) $lang_faq_php = array(
  'faq' => 'Preguntes M�s Freq�ents', 
  'toc' => 'Taula de continguts', 
  'question' => 'Pregunta: ', 
  'answer' => 'Resposta: ', 
);

if (defined('FAQ_PHP')) $lang_faq_data = array(
  'PMF General',
  array('Perqu� deuria registrar-me?', 'El registre pot o no ser requerit per l\'administrador. El registre facilita caracter�stiques addicionals tals com poder afegir fitxers, tenir una llista de favorits, puntuar imatges, afegir comentaris, enviar postals, etc.', 'allow_user_registration', '0'), 
  array('Com puc registrar-me?', 'Premeu en &quot;Registreu-vos&quot; i empleneu tots els camps requerits (i els opcionals si voleu tamb�).<br />Si l\'administrador t� activada la validaci� per correu electr�nic, despr�s de completar i enviar les dades rebreu un missatge en l\'adre�a que heu indicat durant el registre, en el qual s\'explica com activar el vostre compte (sols prement un enlla�). Fins que no activeu el compte no podreu validar-vos com usuari registrat.', 'allow_user_registration', '1'),
  array('Com puc entrar al sistema (fer login)?', 'Premeu en &quot;Entreu&quot;, empleneu el vostre nom d\'usuari i contrasenya, i marqueu &quot;Recordar-me&quot; amb aix� aconseguiu estar validat la pr�xima vegada que ens visiteu.<br /><b>IMPORTANT: Les galetes deuen estar activades en el navegador i la galeta d\'aquest lloc no deu ser esborrada si voleu que funcioni l\'opci� &quot;Recordar-me&quot;.</b>', 'offline', 0),
  array('Perqu� no puc entrar (fer login)?', 'Vos heu registrat i premut en l\'enlla� del correu electr�nic de confirmaci� que vos va ser enviat? Aix� deuria haver activat el vostre compte. Si no �s aix�, contacteu amb l\'administrador del sistema.', 'offline', 0), 
  array('Qu� passa si oblido la meva contrasenya?', 'Si aquesta web t� una opci� &quot;Heu oblidat la vostra contrasenya&quot;, useu-la. Haureu d\'accedir a la recuperaci� de la mateixa. Si no, haureu de contactar amb l\'administrador perqu� vos crei una nova contrasenya.', 'offline', 0), 
  //array('Qu� passa si he canviat la meva adre�a de correu electr�nic?', 'Simplement entreu al sistema (feu login) i canvieu la vostra adre�a de correu electr�nic des de &quot;El vostre Perfil&quot;', 'offline', 0),
  array('Com puc guardar una imatge en &quot;Els meus favorits&quot;?', 'Premeu primer en la imatge i despr�s la icona de &quot;Mostra informaci� del fitxer&quot; (<img src="images/info.gif" width="16" height="16" border="0" alt="Mostra informaci� del fitxer" />); baixeu fins on ha aparegut aquesta informaci� i premeu en &quot;Afegeix a Favorits&quot;.<br />L\'administrador podria tenir activada la opci� &quot;Mostra informaci� del fitxer&quot; per defecte.<br />IMPORTANT: Les galetes deuen estar activades en el navegador i la galeta d\'aquesta web no deu ser esborrada.', 'offline', 0), 
  array('Com puc valorar una imatge?', 'Premeu en la miniatura de la imatge, mireu sota ella i elegiu la puntuaci�.', 'offline', 0), 
  array('Com puc enviar un comentari d\'una imatge?', 'Premeu en la miniatura de la imatge i mireu sota ella. Aqu� podreu inserir el vostre comentari.', 'offline', 0), 
array('Com puc afegir una imatge?', 'Premeu en &quot;Insereix fitxer&quot; i elegiu l\'�lbum en el qual voleu afegir la imatge, premeu &quot;Navega&quot; i elegiu la imatge que voleu del vostre disc dur, premeu el bot� &quot;Obri&quot; (afegiu t�tol i descripci� si voleu), premeu finalment en &quot;Tramet&quot;', 'allow_private_albums', 0),
  array('On puc afegir una imatge?', 'Podeu afegir una imatge a un dels vostres �lbums en &quot;La meva galeria&quot;. L\'Administrador pot haver perm�s tamb� l\'afegir imatges en un o m�s dels �lbums de la Galeria principal.', 'allow_private_albums', 0),
  array('Quins tipus i grand�ries d\'imatges puc afegir?', 'Els tipus (jpg, png, etc.) i mides les decideix l\'administrador.', 'offline', 0), 
  array('Qu� �s &quot;La meva galeria&quot;?', '&quot;La meva galeria&quot; �s una galeria personal en la qual l\'usuari pot afegir nous fitxers, aix� com configurar-la.', 'allow_private_albums', 0), 
  array('Com puc crear, tornar a anomenar o esborrar un �lbum en &quot;La meva galeria&quot;?', 'Heu d\'entrar al &quot;Mode Administrador&quot;<br />Premeu en &quot;Crea/Ordena els meus �lbums&quot; i premeu &quot;Nou&quot;. Canvieu &quot;Nou �lbum&quot; pel nom que vulgueu.<br />Podeu tamb� tornar a anomenar qualsevol dels �lbums de la vostra galeria.<br />Premeu &quot;Aplica Modificacions&quot;.', 'allow_private_albums', 0), 
  array('Com puc modificar i restringir a altres usuaris de veure els meus �lbums?', 'Heu d\'entrar al &quot;Mode Administrador&quot;<br />Premeu en &quot;Modificar els meus �lbums&quot;. Premeu en la barra &quot;Actualitza �lbum&quot;, elegiu l\'�lbum que voleu canviar.<br />Des d\'aqu� podeu canviar el nom, descripci�, miniatures de les imatges, i restringir qui pot veure o posar comentaris en l\'�lbum.<br />Premeu &quot;Actualitza �lbum&quot;.', 'allow_private_albums', 0),
  array('Com puc veure galeries d\'altres usuaris?', 'Premeu en &quot;Llista d\'�lbums&quot; i seleccioneu &quot;Galeries dels Usuaris&quot;.', 'allow_private_albums', 0),
  array('Qu� s�n les galetes?', 'Les galetes (cookies) s�n uns petits textos que s\'envien des de la web i s\'emmagatzemen al vostre ordinador.<br />Normalment les galetes serveixen per a "recordar" a l\'usuari quan aquest torni de nou, i per a altres usos diversos.', 'offline', 0),
  array('On puc aconseguir aquest programa per a posar-lo en la meva web?', 'Coppermine �s una Galeria Multim�dia gratu�ta, publicada sota llic�ncia GNU GPL. Est� repleta de caracter�stiques i ha estat adaptada a distintes plataformes i sistemes de contingut. Visiteu la <a href="http://coppermine.sf.net/">p�gina de Coppermine</a> per a saber m�s i poder descarregar el programa.', 'offline', 0), 

  'Navegant per la galeria',
  array('Qu� �s la &quot;Llista d\'�lbums&quot;?', 'Des d\'aqu� podeu veure la galeria completa, amb un enlla� a cada categoria. Les miniatures poden ser enlla�os directes a les categories.', 'offline', 0), 
  array('Qu� �s &quot;La meva Galeria&quot;?', 'Aquesta caracter�stica permet a l\'usuari crear la seva pr�pia galeria i afegir, esborrar o modificar �lbums aix� com afegir nous fitxers en ells.', 'allow_private_albums', 0), 
  array('Quines s�n les difer�ncia entre &quot;Mode Administrador&quot; i &quot;Mode Usuari&quot;?', 'Quan s\'est� en mode administrador, l\'usuari pot modificar la seva galeria (aix� com unes altres si l\'hi ha perm�s l\'administrador).', 'allow_private_albums', 0), 
  array('Qu� �s &quot;Insereix Fitexer&quot;?', 'Aquesta caracter�stica permet a l\'usuari afegir una imatge (mida i tipus definits per l\'administrador) en una galeria seleccionada per l\'usuari o b� per l\'administrador.', 'allow_private_albums', 0), 
  array('Qu� �s &quot;�ltims fitexers&quot;?', 'Mostra els �ltims fitxers / imatges afegits a la galeria.', 'offline', 0), 
  array('Qu� �s &quot;�ltims comentaris&quot;?', 'Mostra els �ltims comentaris afegits pels usuaris, juntament amb les imatges comentades.', 'offline', 0),
  array('Qu� �s &quot;M�s vists&quot;?', 'Mostra els fitxers m�s vists per tots els usuaris (registrats i visitants).', 'offline', 0), 
  array('Qu� �s &quot;M�s valorats&quot;?', 'Mostra les imatges millor valorades pels usuaris, juntament amb la mitjana de puntuaci� (per exemple: cinc usuaris han donat un <img src="images/rating3.gif" width="65" height="14" border="0" alt="" />: el fitxer tindr� una puntuaci� mitja de <img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> ;si cinc usuaris han puntuat de 1 a 5 (1,2,3,4,5) la mitjana resultant ser� <img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> .)<br />Les puntuacions van des de <img src="images/rating5.gif" width="65" height="14" border="0" alt="Excel�lent" /> (excel�lent) fins a <img src="images/rating0.gif" width="65" height="14" border="0" alt="Dolent" /> (dolent).', 'offline', 0),
  array('Qu� �s &quot;Els meus favorits&quot;?', 'Aquesta caracter�stica permet a un usuari guardar una imatge favorita en la galeta que �s enviada al seu ordinador.', 'offline', 0),
);


// ------------------------------------------------------------------------- //
// File forgot_passwd.php 
// ------------------------------------------------------------------------- //

if (defined('FORGOT_PASSWD_PHP')) $lang_forgot_passwd_php = array(
  'forgot_passwd' => 'Recuperaci� de contrasenya',
  'err_already_logged_in' => 'Ja esteu identificat!',
  'enter_username_email' => 'Inseriu el vostre nom d\'usuari o adre�a de correu electr�nic',
  'submit' => 'endavant',
  'failed_sending_email' => 'El correu de recuperaci� de contrasenya no pot ser enviat!',
  'email_sent' => 'Un correu electr�nic amb el vostre nom d\'usuari i contrasenya ha estat enviat a %s',
  'err_unk_user' => 'L\'usuari seleccionat no existeix!', 
  'passwd_reminder_subject' => '%s - Recuperaci� de contrasenya',
  'passwd_reminder_body' => 'Heu demanat que se vos recordin les vostres dades d\'entrada:
Nom d\'usuari: %s
Contrasenya: %s
Premeu %s per a entrar (login).',
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => 'Nom del grup',
	'disk_quota' => 'Quota de disc',
	'can_rate' => 'Poden valorar fitxers',
	'can_send_ecards' => 'Poden enviar postals',
	'can_post_com' => 'Poden afegir comentaris',
	'can_upload' => 'Poden afegir fitxers',
	'can_have_gallery' => 'Poden tenir galeries personals',
	'apply' => 'Valida els canvis',
	'create_new_group' => 'Crea nou grup',
	'del_groups' => 'Esborra el(s) grup(s) seleccionat(s)',
	'confirm_del' => 'Atenci�, quan esborreu un grup, els usuaris que pertanyen a aquest grup s�n transferits al grup \'Registered\'!\n\nVoleu continuar?',
	'title' => 'Configura grups d\'usuaris',
	'approval_1' => 'Aprovaci� fitxers penjats p�blics (1)',
	'approval_2' => 'Aprovaci� fitxers penjats privats (2)',
	'upload_form_config' => 'Configuraci� del formulari de pujada', 
	'upload_form_config_values' => array( 'Nom�s pujades d\'un sol fitxer', 'Nom�s pujades de multiples fitxers', 'Nom�s pujades URI', 'Nom�s pujades ZIP', 'Fitxer-URI', 'Fitxer-ZIP', 'URI-ZIP', 'Fitxers-URI-ZIP'), 
	'custom_user_upload'=>'Pot l\'usuari personalitzar el nombre de caixes de pujada?', 
	'num_file_upload'=>'Nombre m�xim/exacte de caixes de pujada de fitxers', 
	'num_URI_upload'=>'Nombre m�xim/exacte de caixes de pujada URI', 
	'note1' => '<b>(1)</b> Afegir fitxers en un �lbum p�blic requerir� aprovaci� dels administradors',
	'note2' => '<b>(2)</b> Afegir fitxers en un �lbum que pertany a l\'usuari requerir� aprovaci� dels administradors',
	'notes' => 'Notes'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
	'welcome' => 'Benvingut/da!'
);

$lang_album_admin_menu = array(
	'confirm_delete' => 'Esteu segur de voler ESBORRAR aquest �lbum? \\nTotes les imatges i comentaris seran tamb� esborrats.',
	'delete' => 'ESBORRA',
	'modify' => 'MODIFICA',
	'edit_pics' => 'EDITA IMATGES',
);

$lang_list_categories = array(
	'home' => 'Inici',
	'stat1' => '<b>[pictures]</b> fitxers en <b>[albums]</b> �lbums i <b>[cat]</b> categories amb <b>[comments]</b> comentaris, vists <b>[views]</b> vegades',
	'stat2' => '<b>[pictures]</b> fitxers en <b>[albums]</b> �lbums, vists <b>[views]</b> vegades',
	'xx_s_gallery' => 'Galeria de %s',
	'stat3' => '<b>[pictures]</b> fitxers en <b>[albums]</b> �lbums amb <b>[comments]</b> comentaris, vists <b>[views]</b> vegades'
);

$lang_list_users = array(
	'user_list' => 'Llista d\'usuaris',
	'no_user_gal' => 'No existeixen usuaris amb permisos per a tenir �lbums',
	'n_albums' => '%s �lbum(s)',
	'n_pics' => '%s fitxer(s)'
);

$lang_list_albums = array(
	'n_pictures' => '%s fitxers',
	'last_added' => ', �ltim afegit el %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => 'Entreu',
	'enter_login_pswd' => 'Introduiu el vostre nom d\'usuari i contrasenya per a entrar',
	'username' => 'Nom d\'usuari',
	'password' => 'Contrasenya',
	'remember_me' => 'Recorda\'m',
	'welcome' => 'Benvingut/da %s ...',
	'err_login' => '*** Entrada incorrecta. Intenteu-ho de nou ***',
	'err_already_logged_in' => 'Ja esteu identificat!',
	'forgot_password_link' => 'He oblidat la meva contrasenya', 
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => 'Sortiu',
	'bye' => 'Fins un altra, %s ...',
	'err_not_loged_in' => 'No est�s validat al sistema!',
);

// ------------------------------------------------------------------------- //
// File phpinfo.php 
// ------------------------------------------------------------------------- //

if (defined('PHPINFO_PHP')) $lang_phpinfo_php = array(
  'php_info' => 'PHP info', 
  'explanation' => 'Aquesta �s la sortida generada per la funci� PHP <a href="http://www.php.net/phpinfo">phpinfo()</a>, mostrada dintre de Copermine (retallant la sortida).', 
  'no_link' => 'Deixar que altres vegin el vostre phpinfo pot ser arriscat, per aix� aquesta p�gina nom�s �s visible quan esteu identificat com a administrador. No podeu enviar un enlla� a aqueta p�gina per a terceres persones, se\'ls denegar� l\'acc�s.', 
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => 'Modifica �lbum %s',
	'general_settings' => 'Par�metres generals',
	'alb_title' => 'T�tol de l\'�lbum',
	'alb_cat' => 'Categor�a de l\'�lbum',
	'alb_desc' => 'Descripci� de l\'�lbum',
	'alb_thumb' => 'Miniatura de l\'�lbum',
	'alb_perm' => 'Permisos per a aquest �lbum',
	'can_view' => 'Aquest �lbum pot ser vist per',
	'can_upload' => 'Els visitants poden afegir imatges',
	'can_post_comments' => 'Els visitants poden afegir comentaris',
	'can_rate' => 'Els visitants poden valorar les imatges',
	'user_gal' => 'Galeria d\'usuari',
	'no_cat' => '* Sense categoria *',
	'alb_empty' => 'L\'�lbum est� buit',
	'last_uploaded' => '�ltim afegit',
	'public_alb' => 'Tothom (�lbum p�blic)',
	'me_only' => 'Nom�s jo',
	'owner_only' => 'Nom�s l\'amo de l\'�lbum (%s)',
	'groupp_only' => 'Membres del grup \'%s\'',
	'err_no_alb_to_modify' => 'No podeu modificar cap �lbum a la base de dades.',
	'update' => 'Actualitza �lbum',
	'notice1' => '(*) depenent dels par�metres de %sgrups%s',
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => 'Perdoneu per� ja heu votat anteriorment per aquest fitxer',
	'rate_ok' => 'El vostre vot ha estat comptabilitzat',
	'forbidden' => 'No podeu votar per els vostres propis fitxers.', 
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
A pesar que els administradors de {SITENAME} intentaran eliminar o editar qualsevol material desagradable tan aviat com puguin, resulta impossible revisar tots els enviaments que es realitzen. Per tant heu de tenir en compte que tots els enviaments fets a aquesta web expressen el punt de vista i opinions dels seus autors i no el dels administradors o webmasters (excepte els afegits per ells mateixos).<br />
<br />
Esteu d'acord en no afegir cap material abusiu, obsc�, vulgar, escandal�s, odi�s, amena�ador, d'orientaci� sexual, o cap altre que pugui violar qualsevol llei aplicable. Esteu d'acord amb que el webmaster, l'administrador i els assessors de { SITENAME } tenen el dret de llevar o de corregir qualsevol contingut en qualsevol moment si el consideren necessari. Com usuari, accediu a que qualsevol informaci� que afegiu sigui emmagatzemada en una base de dades. Tan mateix, aquesta informaci� no ser� divulgada a tercers sense el seu consentiment. El webmaster i l'administrador no es poden fer responsables de cap intent de destrucci� de la base de dades que pugui conduir a la p�rdua de la mateixa.<br />
<br />
Aquest lloc utilitza galetes per a emmagatzemar la informaci� al vostre ordinador. Aquestes galetes serveixen per a millorar la navegaci� d'aquest lloc. L'adre�a de correu electr�nic s'usa nom�s per a confirmar els seus detalls i contrasenya de registre.<br />
<br />
Prement <i>Estic d'acord</i> expresseu la vostra conformitat amb aquestes condicions.
EOT;

$lang_register_php = array(
	'page_title' => 'Registre de nou usuari',
	'term_cond' => 'Termes i condicions',
	'i_agree' => 'Estic d\'acord',
	'submit' => 'Enviar sol�licitud de registre',
	'err_user_exists' => 'El nom d\'usuari elegit ja existeix, per favor elegiu un altre diferent',
	'err_password_mismatch' => 'Les dues contrassenyes no s�n iguals, per favor torneu a introduir-les',
	'err_uname_short' => 'El nom d\'usuari deu ser de 2 car�cters de longitud com a m�nim',
	'err_password_short' => 'La contrassenya deu ser de 2 car�cters de longitud com a m�nim',
	'err_uname_pass_diff' => 'El nom d\'usuari i la contrassenya deuen ser diferents',
	'err_invalid_email' => 'L\'adre�a electr�nica no �s v�lida',
	'err_duplicate_email' => 'Un altre usuari s\'ha registrat anteriorment amb l\'adre�a de correu electr�nic subministrada',
	'enter_info' => 'Introduiu la informaci� de registre',
	'required_info' => 'Informaci� requerida',
	'optional_info' => 'Informaci� opcional',
	'username' => 'Nom d\'usuari',
	'password' => 'Contrasenya',
	'password_again' => 'Reescriure contrasenya',
	'email' => 'Correu electr�nic',
	'location' => 'Ubicaci�',
	'interests' => 'Interessos',
	'website' => 'P�gina web',
	'occupation' => 'Ocupaci�',
	'error' => 'ERROR',
	'confirm_email_subject' => '%s - Confirmaci� de registre',
	'information' => 'Informaci�',
	'failed_sending_email' => 'El correu electr�nic de confirmaci� de registre no pot ser enviat!',
	'thank_you' => 'Gr�cies per registrar-vos.<br /><br />Hem enviat un correu electr�nic amb informaci� sobre l\'activaci� del vostre compte a l\'adre�a de correu que ens heu facilitat.',
	'acct_created' => 'El vostre compte d\'usuari ha estat creat i ara podeu accedir al sistema amb el vostre nom d\'usuari i contrasenya',
	'acct_active' => 'El vostre compte d\'usuari ja est� activat i ara podeu accedir al sistema amb el vostre nom d\'usuari i contrasenya',
	'acct_already_act' => 'El vostre compte ja estava actiu!',
	'acct_act_failed' => 'Aquest compte no pot ser activat!',
	'err_unk_user' => 'L\'usuari seleccionat no existeix!',
	'x_s_profile' => 'Perfil de %s',
	'group' => 'Grup',
	'reg_date' => 'Data d\'alta',
	'disk_usage' => '�s de disc',
	'change_pass' => 'Canvia contrasenya',
	'current_pass' => 'Contrasenya actual',
	'new_pass' => 'Nova contrasenya',
	'new_pass_again' => 'Reescriure nova contrasenya',
	'err_curr_pass' => 'La contrasenya actual �s incorrecta',
	'apply_modif' => 'Desa els canvis',
	'change_pass' => 'Canvia la meva contrasenya',
	'update_success' => 'El vostre perfil ha estat actualitzat',
	'pass_chg_success' => 'La vostra contrasenya ha estat canviada',
	'pass_chg_error' => 'La vostra contrassenya no ha estat canviada',
	'notify_admin_email_subject' => '%s - Notificaci� de registre',
	'notify_admin_email_body' => 'Un nou usuari amb el nom "%s" s\'ha registrat en la vostra galeria',
);

$lang_register_confirm_email = <<<EOT
Gr�cies per registrar-vos a {SITE_NAME}

El vostre nom d'usuari �s: "{USER_NAME}"
La vostra contrassenya �s: "{PASSWORD}"

Per a acabar d'activar el vostre compte, heu de pr�mer sobre l'enlla� que
apareix sota o copiar-lo i pegar-lo al vostre navegador d'Internet.

{ACT_LINK}

Un salut,

Els administradors de {SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => 'Revisa comentaris',
	'no_comment' => 'No existeixen comentaris que mostrar',
	'n_comm_del' => '%s comentari(s) esborrat(s)',
	'n_comm_disp' => 'Nombre de comentaris a mostrar',
	'see_prev' => 'Veure l\'anterior',
	'see_next' => 'Veure el seg�ent',
	'del_comm' => 'Esborra comentaris seleccionats',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => 'Cercar en tota la galeria',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => 'Cerca nous fitxers',
	'select_dir' => 'Seleccioneu directori',
	'select_dir_msg' => 'Aquesta funci� vos permet afegir de forma autom�tica els fitxers que hageu pujat al vostre servidor mitjan�ant FTP.<br /><br />Seleccioneu el directori on heu pujat els vostres fitxers',
	'no_pic_to_add' => 'No hi ha cap fitxer per a afegir',
	'need_one_album' => 'Necessiteu almenys un �lbum per a utilitzar aquesta funci�',
	'warning' => 'Atenci�',
	'change_perm' => 'Coppermine no pot escriure en aquest directori, necessiteu canviar els permisos a modes 755 o 777 abans d\'intentar-ho de nou!',
	'target_album' => '<b>Col�loca els fitxers del dierctori &quot;</b>%s<b>&quot; a l\'�lbum </b>%s',
	'folder' => 'Carpeta',
	'image' => 'fitxer',
	'album' => '�lbum',
	'result' => 'Resultat',
	'dir_ro' => 'No es pot escriure. ',
	'dir_cant_read' => 'No es pot llegir. ',
	'insert' => 'Afegint noves fitxers a la galeria',
	'list_new_pic' => 'Llistat de nous fitxers',
	'insert_selected' => 'Afegeix els fitxers seleccionades',
	'no_pic_found' => 'No s\'ha trobat cap fitxer nou',
	'be_patient' => 'Per favor, sigueu pacient, Coppermine necessita temps per a afegir els fitxers',
	'no_album' => 'Cap �lbum seleccionat', 
	'notes' =>  '<ul>'.
				'<li><b>OK</b> : significa que el fitxer ha estat afegit sense problemes'.
				'<li><b>DP</b> : significa que el fitxer �s un duplicat i ja existeix a la base de dades'.
				'<li><b>PB</b> : significa que el fitxer no pot ser afegit, per favor comproveu la configaraci�n i els permisos dels directoris on estan els fitxers'.
				'<li><b>NA</b> : significa que no heu seleccionat un �lbum on posar els fitxers, premeu \'<a href="javascript:history.back(1)">arrere</a>\' i seleccioneu un �lbum. Si no teniu un �lbum <a href="albmgr.php">creeu-ne un primer</a></li>'.
				'<li>Si les icones OK, DP, PB no apareixen, premeu sobre la icona d\'imatge no carregada per a veure l\'error produ�t per PHP'.
				'<li>Si el navegador excedeix el temps d\'espera (timeout), premeu la icona d\'actualitzar'.
				'</ul>', 
	'select_album' => 'selecciona �lbum',
	'check_all' => 'Activa Tots',
	'uncheck_all' => 'Desactiva Tots',
);


// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //

// Void

// ------------------------------------------------------------------------- //
// File banning.php
// ------------------------------------------------------------------------- //

if (defined('BANNING_PHP')) $lang_banning_php = array(
	'title' => 'Expulsa Usuaris',
	'user_name' => 'Nom d\'Usuari',
	'ip_address' => 'Adre�a IP',
	'expiry' => 'Caduca (en blanc �s permanent)',
	'edit_ban' => 'Desa Canvis',
	'delete_ban' => 'Esborra',
	'add_new' => 'Afegeix Nova Expulsi�',
	'add_ban' => 'Afegeix',
	'error_user' => 'No es pot trobar l\'usuari',
	'error_specify' => 'Necessiteu especificar o un nom d\'usuari o una adre�a IP', 
	'error_ban_id' => 'ID d\'expulsi� invalida!', 
	'error_admin_ban' => 'No vos podeu expulsar a vosaltres mateixos!', 
	'error_server_ban' => 'An�veu a expulsar al vostre propi servidor? Tsk tsk, no podeu fer aix�...',
	'error_ip_forbidden' => 'No podeu expulsar aquesta IP - no �s pot encaminar (non-routable)!', 
	'lookup_ip' => 'Cerca una adre�a IP', 
	'submit' => 'endavant!',
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
	'title' => 'Penja fitxer',
	'custom_title' => 'Formulari de sol�licitud personalitzat', 
	'cust_instr_1' => 'Podeu seleccionar un nombre personalitzat de quadres de pujada. Tanmateix, no podeu seleccionar-ne m�s dels l�mits llistats a sota.', 
	'cust_instr_2' => 'Nombre de quadres de sol�licitud', 
	'cust_instr_3' => 'Quadres de pujada de fitxer: %s', 
	'cust_instr_4' => 'Quadres de pujada URI/URL: %s', 
	'cust_instr_5' => 'Quadres de pujada URI/URL:', 
	'cust_instr_6' => 'Quadres de pujada de fitxer:', 
	'cust_instr_7' => 'Per favor inseriu el nombre de quadres de pujada de cada tipus que voleu actualment. Aleshores premeu \'Continua\'. ', 
	'reg_instr_1' => 'Acci� invalida per a la creaci� del formulari.', 
	'reg_instr_2' => 'Ara podeu penjar els vostres fitxers fent servir els quadres de pujada de sota. La mida dels fitxers pujats al servidor no deuria excedir de %s KB cadascun. Els fitxers ZIP penjats en les seccions \'Pujades de fitxers\' i \'Pujades URI/URL\' restaran comprimits.', 
	'reg_instr_3' => 'Si voleu que el fitxer ZIP o arxiu sigui descomprimit, haureu d\'usar el quadre de pujada de fitxer prove�t en l\'�rea \'Pujada ZIP descomprimida\'.', 
	'reg_instr_4' => 'Quan useu la secci� de pujada URI/URL, per favor inseriu el cam� al fitxer d\'aquesta manera: http://www.paginaweb.com/imatges/exemple.jpg', 
	'reg_instr_5' => 'Quan hageu completat el formulari, per favor premeu \'Continua\'.', 
	'reg_instr_6' => 'Pujades ZIP descomprimides:', 
	'reg_instr_7' => 'Pujades de fitxers:', 
	'reg_instr_8' => 'Pujades URI/URL:', 
	'error_report' => 'Informe d\'Error', 
	'error_instr' => 'S\'han trobat erros a les seg�ents pujades:', 
	'file_name_url' => 'Nom/URL del fitxer', 
	'error_message' => 'Missatge d\'Error', 
	'no_post' => 'Fitxer no pujat per POST.', 
	'forb_ext' => 'Extensi� de fitxer no permesa.', 
	'exc_php_ini' => 'Excedida la mida de fitxer permesa a php.ini.', 
	'exc_file_size' => 'Excedida la mida de fitxer permesa per Coppermine.', 
	'partial_upload' => 'Nom�s una pujada parcial.', 
	'no_upload' => 'No s\'ha produ�t cap pujada.', 
	'unknown_code' => 'Codi d\'error de pujada de PHP desconegut.', 
	'no_temp_name' => 'Cap pujada - Cap nom temporal.', 
	'no_file_size' => 'No cont� dades/Corrupte', 
	'impossible' => 'Impossible moure.', 
	'not_image' => 'No �s una imatge/corrupte', 
	'not_GD' => 'Not �s una extensi� GD.', 
	'pixel_allowance' => 'Excedida assignaci� de p�xel.', 
	'incorrect_prefix' => 'Prefixe URI/URL incorrecte', 
	'could_not_open_URI' => 'No s\'ha pogut obrir URI.', 
	'unsafe_URI' => 'No es pot verificar la seguretat.', 
	'meta_data_failure' => 'Fallada de dades Meta', 
	'http_401' => '401 No autoritzat', 
	'http_402' => '402 Requereix Pagament', 
	'http_403' => '403 Acc�s Prohibit', 
	'http_404' => '404 No s\'ha trobat', 
	'http_500' => '500 Error Intern del Servidor', 
	'http_503' => '503 Servei No Disponible', 
	'MIME_extraction_failure' => 'No es pot determinar MIME.', 
	'MIME_type_unknown' => 'Tipus MIME desconegut', 
	'cant_create_write' => 'No es pot crear fitxer d\'escriptura.', 
	'not_writable' => 'No es pot escriure al fitxer d\'escriptura.', 
	'cant_read_URI' => 'No es pot llegir URI/URL', 
	'cant_open_write_file' => 'No es pot obrir el fitxer d\'escriptura URI.', 
	'cant_write_write_file' => 'No es pot escriure al fitxer d\'escriptura URI.', 
	'cant_unzip' => 'No es pot descomprimir.', 
	'unknown' => 'Error desconegut', 
	'succ' => 'Pujades amb �xit', 
	'success' => '%s pujades amb �xit.', 
	'add' => 'Per favor premeu \'Continua\' per a afegir els fitxers als �lbums.', 
	'failure' => 'Pujada Fallida', 
	'f_info' => 'Informaci� del Fitxer', 
	'no_place' => 'No s\'ha pogut col�locar el fitxer anterior.', 
	'yes_place' => 'S\'ha col�locat amb �xit el fitxer anterior.', 
	'max_fsize' => 'La m�xima mida de fitxer permesa �s de %s KB',
	'album' => '�lbum',
	'picture' => 'Fitxer',
	'pic_title' => 'T�tol del fitxer',
	'description' => 'Descripci� del fitxer',
	'keywords' => 'Paraules clau (separades per espais)',
	'err_no_alb_uploadables' => 'Perdoneu per� no hi ha cap �lbum on estigui perm�s inserir nous fitxers',
	'place_instr_1' => 'Per favor col�loqueu ara els fitxers als �lbums. Ara podeu inserir tamb� informaci� d\'import�ncia sobre cada fitxer.', 
	'place_instr_2' => 'Hi ha m�s fitxers per col�locar. Per favor premeu \'Continua\'.', 
	'process_complete' => 'Heu col�locat amb �xit tots els fitxers.', 
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => 'Administra usuaris',
	'name_a' => 'Ascendent per nom',
	'name_d' => 'Descendent per nom',
	'group_a' => 'Ascendent per grup',
	'group_d' => 'Descendent per grup',
	'reg_a' => 'Ascendent per data d\'alta',
	'reg_d' => 'Descendent per data d\'alta',
	'pic_a' => 'Ascendent per total de fitxers',
	'pic_d' => 'Descendent per total de fitxers',
	'disku_a' => 'Ascendent per �s de disc',
	'disku_d' => 'Descendent per �s de disc',
	'lv_a' => 'Ascendent per �ltima visita', 
	'lv_d' => 'Descendent per �ltima visita', 
	'sort_by' => 'Ordena usuaris per',
	'err_no_users' => 'La taula d\'usuaris est� buida!',
	'err_edit_self' => 'No podeu editar el vostre propi perfil, heu d\'usar l\'opci� \'El meu perfil d\'usuari\' per a aix�',
	'edit' => 'EDITA',
	'delete' => 'ESBORRA',
	'name' => 'Nom d\'usuari',
	'group' => 'Grup',
	'inactive' => 'Inactiu',
	'operations' => 'Operacions',
	'pictures' => 'Fitxers',
	'disk_space' => 'Espai usat / Quota',
	'registered_on' => 'Registrat el dia',
	'last_visit' => '�ltima Visita', 
	'u_user_on_p_pages' => '%d usuaris en %d p�gina(s)',
	'confirm_del' => 'Esteu segur de voler ESBORRAR aquest usuari? \\nTots els seus fitxers i �lbums seran esborrats tamb�.',
	'mail' => 'CORREU',
	'err_unknown_user' => 'L\'usuari seleccionat no existeix!',
	'modify_user' => 'Modifica usuari',
	'notes' => 'Notes',
	'note_list' => '<li>Si no voleu canviar la contrassenya actual, deixeu el camp "contrasenya" buit',
	'password' => 'Contrasenya',
	'user_active' => 'L\'usuari est� actiu',
	'user_group' => 'Grup d\'usuaris',
	'user_email' => 'Correu electr�nic de l\'usuari',
	'user_web_site' => 'P�gina web de l\'usuari',
	'create_new_user' => 'Crea nou usuari',
	'user_location' => 'Ubicaci� de l\'usuari',
	'user_interests' => 'Interessos de l\'usuari',
	'user_occupation' => 'Ocupaci� de l\'usuari',
	'latest_upload' => 'Pujades recents', 
	'never' => 'mai', 
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => 'Eines (redimensiona imatges)',
        'what_it_does' => 'Qu� fa',
        'what_update_titles' => 'Actualitza els noms de fitxer',
        'what_delete_title' => 'Esborra els t�tols',
        'what_rebuild' => 'Torna a crear les miniatures i imatges redimensionades',
        'what_delete_originals' => 'Esborra les imatges originals reempla�ant-les amb les versions redimensionades',
        'file' => 'Fitxer',
        'title_set_to' => 't�tol a posar',
        'submit_form' => 'envia',
        'updated_succesfully' => 'actualitzat amb �xit',
        'error_create' => 'ERROR al crear',
        'continue' => 'Processa m�s imatges',
        'main_success' => 'El fitxer %s ha estat usat com a fitxer principal amb �xit',
        'error_rename' => 'Error reanomenant %s a %s',
        'error_not_found' => 'No es troba el fitxer %s',
        'back' => 'torna a l\'inici',
        'thumbs_wait' => 'Actualitzant miniatures i/o imatges redimensionades, per favor espereu...',
        'thumbs_continue_wait' => 'Continuant l\'actualitzaci� de miniatures i/o imatges redimensionades...',
        'titles_wait' => 'Actualitzant t�tols, per favor espereu...',
        'delete_wait' => 'Esborrant t�tols, per favor espereu...',
        'replace_wait' => 'Esborrant originals i reempla�ant-los amb les imatges redimensionades, per favor espereu...',
        'instruction' => 'Instruccions r�pides',
        'instruction_action' => 'Seleciona acci�',
        'instruction_parameter' => 'Posa par�metres',
        'instruction_album' => 'Selecciona �lbum',
        'instruction_press' => 'Premeu %s',
        'update' => 'Actualitza miniatures i/o imatges redimensionades',
        'update_what' => 'Qu� deu ser actualitzat',
        'update_thumb' => 'Nom�s miniatures',
        'update_pic' => 'Nom�s imatges redimensionades',
        'update_both' => 'Miniatures i imatges redimensionades (ambd�s)',
        'update_number' => 'Nombre d\'imatges processades per cada clic',
        'update_option' => '(Si experimenteu problemes de temps d\'espera (timeout) proveu a posar un nombre menor)',
        'filename_title' => 'Fitxer &rArr; T�tol de fitxer',
        'filename_how' => 'Com s\'hauria de modificar el nom del fitxer',
        'filename_remove' => 'Lleva .jpg del final i reempla�a _ (barra baixa) amb espais',
        'filename_euro' => 'Canvia 2003_11_23_13_20_20.jpg a 23/11/2003 13:20',
        'filename_us' => 'Canvia 2003_11_23_13_20_20.jpg a 11/23/2003 13:20',
        'filename_time' => 'Canvia 2003_11_23_13_20_20.jpg a 13:20',
        'delete' => 'Esborra els t�tols de fitxer o imatges de grand�ria original',
        'delete_title' => 'Esborrar t�tols de fitxer',
        'delete_original' => 'Esborra imatges de grand�ria original',
        'delete_replace' => 'Esborra les imatges originals, reempla�ant-les amb unes altres de grand�ria nova',
        'select_album' => 'Selecciona �lbum',
		'delete_orphans' => 'Esborra els comentaris orfes (funciona en tots els �lbums)', 
		'orphan_comment' => 'Trobats comentaris orfes', 
		'delete' => 'Esborra', 
		'delete_all' => 'Esborra tot', 
		'comment' => 'Comentari: ', 
		'nonexist' => 'fitxer adjunt no existent # ', 
		'phpinfo' => 'Mostra phpinfo', 
		'update_db' => 'Actualitza base de dades', 
		'update_db_explanation' => 'Si heu reempla�at fitxers de coppermine, afegit una modificaci� o actualitzat des d\'una versi� anterior de coppermine, assegureu-vos d\'executar l\'actualitzaci� (update) de la base de dades un cop. Aix� crear� les taules necess�ries i/o valors de configuraci� a la vostra base de dades de coppermine.', 
);

?>