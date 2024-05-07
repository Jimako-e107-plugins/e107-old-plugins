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
'lang_name_english' => 'Spanish',  //the name of your language in English, e.g. 'Greek' or 'Spanish'
'lang_name_native' => 'Espa&ntilde;ol', //the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol'
'lang_country_code' => 'es', //the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
'trans_name'=> 'Daniel Villoldo (Grumpywolf)', //the name of the translator - can be a nickname
'trans_email' => 'dvp@arrakis.es', //translator's email address (optional)
'trans_website' => 'http://grumpywolf.net/', //translator's website (optional)
'trans_date' => '2003-10-03', //the date the translation was created / last modified
);

$lang_charset = 'iso-8859-1';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab');
$lang_month = array('Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic');

// Some common strings
$lang_yes = 'Si';
$lang_no  = 'No';
$lang_back = 'ATRAS';
$lang_continue = 'CONTINUAR';
$lang_info = 'Información';
$lang_error = 'Error';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%d de %B de %Y';
$lastcom_date_fmt =  '%d/%m/%y a las %H:%M';
$lastup_date_fmt = '%d de %B de %Y';
$register_date_fmt = '%d de %B de %Y';
$lasthit_date_fmt = '%d de %B de %Y a las %I:%M %p';
$comment_date_fmt =  '%d de %B de %Y a las %I:%M %p';

// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array(
	'random' => 'Fotos al azar',
	'lastup' => 'Últimas fotos',
        'lastalb'=> 'Últimos albums modificados',
	'lastcom' => 'Últimos comentarios',
	'topn' => 'Más vistas',
	'toprated' => 'Más valoradas',
	'lasthits' => 'Últimas vistas',
	'search' => 'Resultado de la búsqueda',
        'favpics'=> 'Fotos favoritas'
);

$lang_errors = array(
	'access_denied' => 'No tienes permisos para acceder a esta página.',
	'perm_denied' => 'No tienes permisos para realizar esta operación.',
	'param_missing' => 'Llamada a Script sin los parámetros requeridos.',
	'non_exist_ap' => '¡El album/foto seleccionado no existe!',
	'quota_exceeded' => 'Cuota de disco excedida<br /><br />Tienes una cuota de disco de [quota]K, tus fotos actualmente ocupan [space]K, y añadiendo esta foto excederías la cuota.',
	'gd_file_type_err' => 'Cuando se usa la librería de imagen GD solamente están permitidos los tipos JPEG y PNG.',
	'invalid_image' => 'La imagen que has añadido está corrupta o no puede ser tratada por la librería GD.',
	'resize_failed' => 'Incapaz de crear thumbnail o imagen de tamaño reducido.',
	'no_img_to_display' => 'Ninguna imagen que enseñar.',
	'non_exist_cat' => 'La categoría seleccionada no existe.',
	'orphan_cat' => 'Una categoría no tiene padre, ejecuta la utilidad de categorías para corregir el problema.',
	'directory_ro' => 'El directorio \'%s\' no tiene permisos de escritura, las fotos no pueden ser borradas.',
	'non_exist_comment' => 'El comentario seleccionado no existe.',
	'pic_in_invalid_album' => '¿¡La foto está en un album que no existe (%s)!?',
        'banned' => 'Actualmente estás expulsado respecto al uso de esta web.',
        'not_with_udb' => 'Esta función está desactivada en Coppermine porque está integrada con un software de foros. Lo que fuese que estás intentando hacer no está soportado en esta configuración, o la función debe ser manejada por el software de foros.',
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => 'Ir a la lista de albums',
	'alb_list_lnk' => 'Lista de Albums',
	'my_gal_title' => 'Ir a mi galería personal',
	'my_gal_lnk' => 'Mi galería',
	'my_prof_lnk' => 'Mi perfil de usuario',
	'adm_mode_title' => 'Ir a modo administrador',
	'adm_mode_lnk' => 'Modo Admininstrador',
	'usr_mode_title' => 'Ir a modo usuario',
	'usr_mode_lnk' => 'Modo Usuario',
	'upload_pic_title' => 'Insertar foto en un album',
	'upload_pic_lnk' => 'Insertar foto',
	'register_title' => 'Crear un usuario',
	'register_lnk' => 'Registrarse',
	'login_lnk' => 'Login',
	'logout_lnk' => 'Logout',
	'lastup_lnk' => 'Últimas fotos',
	'lastcom_lnk' => 'Últimos comentarios',
	'topn_lnk' => 'Más vistas',
	'toprated_lnk' => 'Más valoradas',
	'search_lnk' => 'Buscar',
	'fav_lnk' => 'Mis Favoritos',
        'ban_lnk' => 'Ban usuarios', //new in cpg1.2.0
	
);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => 'Aprobar Uploads',
	'config_lnk' => 'Configuración',
	'albums_lnk' => 'Albums',
	'categories_lnk' => 'Categorías',
	'users_lnk' => 'Usuarios',
	'groups_lnk' => 'Grupos',
	'comments_lnk' => 'Comentarios',
	'searchnew_lnk' => 'Añadir fotos (Batch)',
        'util_lnk' => 'Cambiar tamaño de las fotos',
        'ban_lnk' => 'Expulsar a Usuarios',

);

$lang_user_admin_menu = array(
	'albmgr_lnk' => 'Crear / ordenar albums',
	'modifyalb_lnk' => 'Modificar mis albums',
	'my_prof_lnk' => 'Mi perfil de usuario',
);

$lang_cat_list = array(
	'category' => 'Categoría',
	'albums' => 'Albums',
	'pictures' => 'Fotos',
);

$lang_album_list = array(
	'album_on_page' => '%d albums en %d página(s)'
);

$lang_thumb_view = array(
	'date' => 'FECHA',
        //Sort by filename and title
	'name' => 'NOMBRE',
        'title' => 'TITULO',
	'sort_da' => 'Ordenado por fecha ascendente',
	'sort_dd' => 'Ordenado por fecha descendente',
	'sort_na' => 'Ordenado por nombre ascendente',
	'sort_nd' => 'Ordenado por nombre descendente',
        'sort_ta' => 'Ordenado por título ascendente',
        'sort_td' => 'Ordenado por título descendente',
	'pic_on_page' => '%d fotos en %d página(s)',
	'user_on_page' => '%d usuarios en %d página(s)'
);

$lang_img_nav_bar = array(
	'thumb_title' => 'Volver al índice del album',
	'pic_info_title' => 'Mostrar/ocultar información de la foto',
	'slideshow_title' => 'Slideshow',
	'ecard_title' => 'Enviar esta foto a un amigo',
	'ecard_disabled' => 'Envio de fotos deshabilitado',
	'ecard_disabled_msg' => 'No tienes permisos para enviar fotos',
	'prev_title' => 'Ver foto anterior',
	'next_title' => 'Ver foto siguiente',
	'pic_pos' => 'FOTO %s/%s',
);

$lang_rate_pic = array(
	'rate_this_pic' => 'Valorar esta foto ',
	'no_votes' => '(No hay votos)',
	'rating' => '(valoración actual : %s / 5 con %s votos)',
	'rubbish' => 'Mala',
	'poor' => 'Regular',
	'fair' => 'Normal',
	'good' => 'Buena',
	'excellent' => 'Excelente',
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
	CRITICAL_ERROR => 'Error crítico',
	'file' => 'Fichero: ',
	'line' => 'Linea: ',
);

$lang_display_thumbnails = array(
	'filename' => 'Fichero: ',
	'filesize' => 'Tamaño: ',
	'dimensions' => 'Dimensiones: ',
	'date_added' => 'Fecha de alta: '
);

$lang_get_pic_data = array(
	'n_comments' => '%s comentarios',
	'n_views' => '%s veces vista',
	'n_votes' => '(%s votos)'
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
	0 => 'Saliendo de modo administrador...',
	1 => 'Entrando en modo administrador...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => '¡Los albums deben tener un nombre!',
	'confirm_modifs' => '¿Estás seguro de aplicar estas modificaciones?',
	'no_change' => '¡No se hizo ningún cambio!',
	'new_album' => 'Nuevo album',
	'confirm_delete1' => '¿Estás seguro de querer borrar este album?',
	'confirm_delete2' => '\nTodas las fotos y comentarios que contiene se perderán!',
	'select_first' => 'Selecciona un album primero',
	'alb_mrg' => 'Administrador de Albums',
	'my_gallery' => '* Mi galería *',
	'no_category' => '* Sin categoría *',
	'delete' => 'Borrar',
	'new' => 'Nuevo',
	'apply_modifs' => 'Aplicar modificaciones',
	'select_category' => 'Seleccionar categoría',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => '¡Los parámetros requeridos para la operación: \'%s\' no han sido suministrados!',
	'unknown_cat' => 'La categoría seleccionada no existe en la base da datos',
	'usergal_cat_ro' => '¡Las categorías de galerías de usuario no pueden ser borradas!',
	'manage_cat' => 'Organizador de categorías',
	'confirm_delete' => 'Estás seguro de querer BORRAR esta catagoría',
	'category' => 'Categoría',
	'operations' => 'Operaciones',
	'move_into' => 'Mover hacia',
	'update_create' => 'Modificar/Crear categoría',
	'parent_cat' => 'Categoría padre',
	'cat_title' => 'Título de la categoría',
	'cat_desc' => 'Descripción de la categoría'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => 'Configuración',
	'restore_cfg' => 'Restaurar valores por defecto',
	'save_cfg' => 'Guardar la nueva configuración',
	'notes' => 'Notas',
	'info' => 'Información',
	'upd_success' => 'La configuración de Coppermine ha sido actualizada',
	'restore_success' => 'Valores por defecto de Coppermine restaurados',
	'name_a' => 'Ascendente por nombre',
	'name_d' => 'Descendente por nombre',
        'title_a' => 'Ascendente por título',
        'title_d' => 'Descendente por título',
	'date_a' => 'Ascendente por fecha',
	'date_d' => 'Descendente por fecha',
        'th_any' => 'Max Aspect',
        'th_ht' => 'Height',
        'th_wd' => 'Width',
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'Parámetros Generales',
	array('Nombre de la galería', 'gallery_name', 0),
	array('Descripción de la galería', 'gallery_description', 0),
	array('Correo electrónico del administrador', 'gallery_admin_email', 0),
	array('Dirección web asociada a \'Ver más fotos\' en las e-cards', 'ecards_more_pic_target', 0),
	array('Lenguaje', 'lang', 5),
	array('Tema (aspecto)', 'theme', 6),

	'Aspecto de la lista de albums',
	array('Anchura de la tabla principal (pixels o %)', 'main_table_width', 0),
	array('Número de niveles de categorías a mostrar', 'subcat_level', 0),
	array('Número de albums a mostrar', 'albums_per_page', 0),
	array('Número de columnas en la lista de albums', 'album_list_cols', 0),
	array('Tamaño de los thumbnails en pixels', 'alb_list_thumb_size', 0),
	array('Contenido de la página principal', 'main_page_layout', 0),
            array('Mostrar thumbnails de albums de primer nivel en categorías','first_level',1),

	'Aspecto de la vista de Thumbnails',
	array('Número de columnas en la página de thumbnails', 'thumbcols', 0),
	array('Número de filas en la página de thumbnails', 'thumbrows', 0),
	array('Máximo número de tabs a mostrar', 'max_tabs', 0),
	array('Mostrar picture caption (además del título) debajo del thumbnail', 'caption_in_thumbview', 1),
	array('Mostrar el número de comentarios debajo del thumbnail', 'display_comment_count', 1),
	array('Orden por defecto de las fotos', 'default_sort_order', 3),
	array('Minimo número de votos para que una foto aparezca el la lista de \'Más Valoradas\' list', 'min_votes_for_rating', 0),

	'Vista de foto y Configuración de comentarios',
	array('Anchura de la tabla donde mostrar la foto (pixels o %)', 'picture_table_width', 0),
	array('Información de la foto visible por defecto', 'display_pic_info', 1),
	array('Filtrar palabras malsonantes en los comentarios', 'filter_bad_words', 1),
	array('Permitir Emoticons en los comentarios', 'enable_smilies', 1),
	array('Máxima longitud para la descripción de una foto', 'max_img_desc_length', 0),
	array('Máximo número de caracteres en una palabra', 'max_com_wlength', 0),
	array('Máximo número de lineas en un comentario', 'max_com_lines', 0),
	array('Máxima longitud de un comentario', 'max_com_size', 0),
        array('Mostrar tira de película', 'display_film_strip', 1),
        array('Número de objetos en tira de película', 'max_film_strip_items', 0),

	'Configuración de las fotos y thumbnails',
	array('Calidad para los ficheros JPEG', 'jpeg_qual', 0),
	array('Máxima anchura o altura de los thumbnail <b>*</b>', 'thumb_width', 0),
        array('Usar dimensión ( anchura o altura o Máximo para los thumbnail )<b>*</b>', 'thumb_use', 7),
	array('Crear fotos de tamaño intermedio','make_intermediate',1),
	array('Máxima anchura o altura de las fotos de tamaño intermedio <b>*</b>', 'picture_width', 0),
	array('Máximo tamaño de los fotos de usuarios por upload (KB)', 'max_upl_size', 0),
	array('Máxima anchura o altura de las fotos de usuarios por upload (pixels)', 'max_upl_width_height', 0),

	'Configuración de usuarios',
	array('Permitir el registro de nuevos usuarios', 'allow_user_registration', 1),
	array('Registro de usuarios requiere verificación de email', 'reg_requires_valid_email', 1),
	array('Permitir a dos usuarios tener el mismo email', 'allow_duplicate_emails_addr', 1),
	array('Los usuarios pueden tener albums privados', 'allow_private_albums', 1),

	'Campos extra para descripción de fotos (dejar en blanco si no los usas)',
	array('Nombre del campo 1', 'user_field1_name', 0),
	array('Nombre del campo 2', 'user_field2_name', 0),
	array('Nombre del campo 3', 'user_field3_name', 0),
	array('Nombre del campo 4', 'user_field4_name', 0),

	'Configuración avanzada de fotos y thumbnails',
        array('Mostrar icono de album privado a usuarios no registrados','show_private',1),
	array('Caracteres prohibidos en los nombres de las fotos', 'forbiden_fname_char',0),
	array('Extensiones de fichero admitidos en los uploads', 'allowed_file_extensions',0),
	array('Método para el reescalado de fotos','thumb_method',2),
	array('Path de la utilidad ImageMagick (por ejemplo /usr/bin/X11/)', 'impath', 0),
	array('Tipos de ficheros admitidos (solo válidos con ImageMagick)', 'allowed_img_types',0),
	array('Comandos de linea para ImageMagick', 'im_options', 0),
	array('Leer datos EXIF en ficheros de tipo JPEG', 'read_exif_data', 1),
	array('Directorio base de los albums <b>*</b>', 'fullpath', 0),
	array('Dierctorio para las fotos subidas por los usuarios <b>*</b>', 'userpics', 0),
	array('Prefijo para las fotos de tamaño intermedio <b>*</b>', 'normal_pfx', 0),
	array('Prefijo para los thumbnails <b>*</b>', 'thumb_pfx', 0),
	array('Modo por defecto de los directorios', 'default_dir_mode', 0),
	array('Modo por defecto para las fotos', 'default_file_mode', 0),

	'Configuración de cookies y Juego de Caracteres',
	array('Nombre de la cookie usada por el script', 'cookie_name', 0),
	array('Path de la cookie usada por el script', 'cookie_path', 0),
	array('Juego de caracteres', 'charset', 4),

	'Configuraciones de otros aspectos',
	array('Activar modo debug', 'debug_mode', 1),

	'<br /><div align="center">(*) Los campos marcados con * no deben ser cambiados si ya se tienen fotos en las galerías</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => 'Debes introducir tu nombre y un comentario',
	'com_added' => 'Tu comentario ha sido añadido',
	'alb_need_title' => '¡Debes de introducir un título para el album!',
	'no_udp_needed' => 'No se requiere ningún cambio',
	'alb_updated' => 'El album ha sido actualizado',
	'unknown_album' => 'El album seleccionado no existe o no tienes permisos para añadir fotos en este album',
	'no_pic_uploaded' => '¡Ninguna foto fue añadida!<br /><br />Si habías seleccionado una foto para añadir, comprueba que el servidor admite subir ficheros...',
	'err_mkdir' => '¡Fallo al crear el directorio %s!',
	'dest_dir_ro' => '¡El directorio destino %s no tiene permisos de escritura!',
	'err_move' => '¡Imposible mover %s a %s !',
	'err_fsize_too_large' => 'El tamaño de la foto que quieres insertar es demasiago grande (el máximo permitido es de %s x %s)',
	'err_imgsize_too_large' => 'El tamaño del fichero de la foto que quieres insertar es demasiado grande (el máximo permitido es de %s KB)',
	'err_invalid_img' => 'El fichero que quieres insertar no es una imagen válida',
	'allowed_img_types' => 'Puedes insertar solamente %s fotos.',
	'err_insert_pic' => 'La foto \'%s\' no puede ser dada de alta en el album ',
	'upload_success' => 'La foto ha sido insertada correctamente<br /><br />Será visible tras la aprobación de los administradores.',
	'info' => 'Información',
	'com_added' => 'Comentario añadido',
	'alb_updated' => 'Album actualizado',
	'err_comment_empty' => '¡El comentario está vacio!',
	'err_invalid_fext' => 'Solamente están admitidas fotos con las siguientes extensiones : <br /><br />%s.',
	'no_flood' => 'Perdona pero eres el autor/a del último comentario introducido para esta foto<br /><br />Puedes editar el comentario que has puesto si es que quieres modificarlo',
	'redirect_msg' => 'Estás siendo redirigido.<br /><br /><br />Pulsa \'CONTINUAR\' si la página no se refresca automáticamente',
	'upl_success' => 'La foto se ha añadido correctamente',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => 'Caption',
	'fs_pic' => 'imagen tamaño completo',
	'del_success' => 'borrado correctamente',
	'ns_pic' => 'imagen tamaño normal',
	'err_del' => 'no puede ser borrado',
	'thumb_pic' => 'thumbnail',
	'comment' => 'comentario',
	'im_in_alb' => 'fotos en el album',
	'alb_del_success' => 'Album \'%s\' borrado',
	'alb_mgr' => 'Organizador de albums',
	'err_invalid_data' => 'Datos inválidos recibidos en \'%s\'',
	'create_alb' => 'Creando el album \'%s\'',
	'update_alb' => 'Actualizando album \'%s\' con el título \'%s\' y el índice \'%s\'',
	'del_pic' => 'Borrar foto',
	'del_alb' => 'Borrar album',
	'del_user' => 'Borrar usuario',
	'err_unknown_user' => '¡El usuario seleccionado no existe!',
	'comment_deleted' => 'El comentario ha sido borrado',
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
	'confirm_del' => '¿Estás seguro de querer BORRAR esta foto? \\nLos comentarios serán también borrados.',
	'del_pic' => 'BORRAR ESTA FOTO',
	'size' => '%s x %s pixels',
	'views' => '%s veces',
	'slideshow' => 'Slideshow',
	'stop_slideshow' => 'DETENER SLIDESHOW',
	'view_fs' => 'Pulsa aqui para ver la imagen a tamaño completo',
);

$lang_picinfo = array(
	'title' =>'Información de la foto',
	'Filename' => 'Nombre del fichero',
	'Album name' => 'Nombre del album',
	'Rating' => 'Valoración (%s votos)',
	'Keywords' => 'Palabras clave',
	'File Size' => 'Tamaño del fichero',
	'Dimensions' => 'Dimensiones',
	'Displayed' => 'Se ha visto',
	'Camera' => 'Cámara',
	'Date taken' => 'Fecha de la foto',
	'Aperture' => 'Apertura',
	'Exposure time' => 'Tiempo de exposición',
	'Focal length' => 'Longitud del foco',
	'Comment' => 'Comentario',
        'addFav'=>'Añadir a Favoritos',
        'addFavPhrase'=>'Favoritos',
        'remFav'=>'Quitar de Favoritos',
);

$lang_display_comments = array(
	'OK' => 'OK',
	'edit_title' => 'Editar el comentario',
	'confirm_delete' => '¿Estás seguro de querer borrar el comentario?',
	'add_your_comment' => 'Añadir un comentario',
        'name'=>'Nombre',
        'comment'=>'Comentario',
	'your_name' => 'Anónimo',
);

$lang_fullsize_popup = array(
        'click_to_close' => 'Pulsa en la imagen para cerrar esta ventana',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => 'Enviar foto a un amigo',
	'invalid_email' => '<b>Atención</b> : ¡dirección e-mail incorrecta!',
	'ecard_title' => 'Una foto de %s para ti',
	'view_ecard' => 'Si la foto no se ve correctamente, pulsa en este link',
	'view_more_pics' => '¡Pulsa aqui para ver más fotos!',
	'send_success' => 'La foto ha sido enviada',
	'send_failed' => 'Disculpa, pero el servidor no puede enviar la foto...',
	'from' => 'De',
	'your_name' => 'Tu nombre',
	'your_email' => 'Tu dirección de e-mail',
	'to' => 'A',
	'rcpt_name' => 'Nombre de tu amigo',
	'rcpt_email' => 'Dirección e-mail de tu amigo',
	'greetings' => 'Título del mensaje',
	'message' => 'Mensaje',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => 'Información',
	'album' => 'Album',
	'title' => 'Título',
	'desc' => 'Descripción',
	'keywords' => 'Keywords',
	'pic_info_str' => '%sx%s - %sKB - %s veces vista - %s votos',
	'approve' => 'Aprobar la foto',
	'postpone_app' => 'Postponer aprobado de foto',
	'del_pic' => 'Borrar foto',
	'reset_view_count' => 'Poner a cero el contador de veces que se ha visto',
	'reset_votes' => 'Poner a cero los votos',
	'del_comm' => 'Borrar comentarios',
	'upl_approval' => 'Aprobar uploads',
	'edit_pics' => 'Editar fotos',
	'see_next' => 'Ir a las siguientes fotos',
	'see_prev' => 'If a las fotos anteriores',
	'n_pic' => '%s foto/s',
	'n_of_pic_to_disp' => 'Número de fotos a mostrar',
	'apply' => 'Validar los cambios'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => 'Nombre del grupo',
	'disk_quota' => 'Cuota de disco',
	'can_rate' => 'Pueden valorar fotos',
	'can_send_ecards' => 'Pueden enviar ecards',
	'can_post_com' => 'Pueden añadir comentarios',
	'can_upload' => 'Pueden añadir fotos',
	'can_have_gallery' => 'Pueden tener galerías personales',
	'apply' => 'Validar los cambios',
	'create_new_group' => 'Crear nuevo grupo',
	'del_groups' => 'Borrar el/los grupo(s) seleccionados',
	'confirm_del' => '¡Atención, cuando borras un grupo, los usuarios que pertenecen a ese grupo serán transferidos al grupo \'Registered\'!\n\n¿Deseas continuar?',
	'title' => 'Configurar grupos de usuarios',
	'approval_1' => 'Aprobación album público (1)',
	'approval_2' => 'Aprobación album privado (2)',
	'note1' => '<b>(1)</b> Añadir fotos en un album público requerirá aprobación de los administradores',
	'note2' => '<b>(2)</b> Añadir fotos en un album que pertenece al asuario requerirá aprobación de los administradores',
	'notes' => 'Notas'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
	'welcome' => '¡Bienvenido!'
);

$lang_album_admin_menu = array(
	'confirm_delete' => '¿Estás seguro de querer BORRAR este album ? \\nTodas las fotos y comentarios serán también borrados.',
	'delete' => 'BORRAR',
	'modify' => 'MODIFICAR',
	'edit_pics' => 'EDITAR FOTOS',
);

$lang_list_categories = array(
	'home' => 'Home',
	'stat1' => '<b>[pictures]</b> fotos en <b>[albums]</b> albums y <b>[cat]</b> categorías con <b>[comments]</b> comentarios, vistas <b>[views]</b> veces',
	'stat2' => '<b>[pictures]</b> fotos en <b>[albums]</b> albums, vistas <b>[views]</b> veces',
	'xx_s_gallery' => 'Galería de %s',
	'stat3' => '<b>[pictures]</b> fotos en <b>[albums]</b> albums con <b>[comments]</b> comentarios, vistas <b>[views]</b> veces'
);

$lang_list_users = array(
	'user_list' => 'Lista de usuarios',
	'no_user_gal' => 'No existen usuarios con permisos para tener albums',
	'n_albums' => '%s album(s)',
	'n_pics' => '%s foto(s)'
);

$lang_list_albums = array(
	'n_pictures' => '%s fotos',
	'last_added' => ', última añadida el %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => 'Login',
	'enter_login_pswd' => 'Introduce tu nombre de usuario y contraseña para entrar',
	'username' => 'Nombre de usuario',
	'password' => 'Contraseña',
	'remember_me' => 'Recordarme',
	'welcome' => 'Bienvenido %s ...',
	'err_login' => '*** Login incorrecto. Inténtalo de nuevo ***',
	'err_already_logged_in' => '¡Ya estabas validado en el sistema!',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => 'Salir',
	'bye' => 'Hasta otra, %s ...',
	'err_not_loged_in' => '¡No estás validado en el sistema!',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => 'Modificar album %s',
	'general_settings' => 'Configuración general',
	'alb_title' => 'Título del album',
	'alb_cat' => 'Categoría del album',
	'alb_desc' => 'Descripción del album',
	'alb_thumb' => 'Thumbnail del album',
	'alb_perm' => 'Permisos para este album',
	'can_view' => 'Este album puede ser visto por',
	'can_upload' => 'Los visitantes pueden añadir fotos',
	'can_post_comments' => 'Los visitantes pueden añadir comentarios',
	'can_rate' => 'Los visitantes pueden valorar las fotos',
	'user_gal' => 'Galería de usuario',
	'no_cat' => '* Sin categoría *',
	'alb_empty' => 'El album está vacío',
	'last_uploaded' => 'Ultima foto añadida',
	'public_alb' => 'Todo el mundo (album público)',
	'me_only' => 'Solamente yo',
	'owner_only' => 'Solamente el dueño del album (%s)',
	'groupp_only' => 'Miembros del grupo \'%s\'',
	'err_no_alb_to_modify' => 'No puedes modificar ningún album en la base de datos.',
	'update' => 'Modificar album'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => 'Perdona pero ya has votado anteriormente a esta foto',
	'rate_ok' => 'Tu voto ha sido contabilizado',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
A pesar de que los administradores de {SITE_NAME} intentarán eliminar o editar cualquier material desagradable tan pronto como puedan, resulta imposible revisar todos los envíos que se realizan. Por lo tanto debes tener en cuenta que todos los envíos hechos hacia esta web expresan el punto de vista y opiniones de sus autores y no los de los administradores o webmasters (excepto los añadidos por ellos mismos).<br />
<br />
Usted acuerda no añadir ningún material abusivo, obsceno, vulgar, escandaloso, odioso, amenazador, de orientación sexual, o ningún otro que pueda violar cualquier ley aplicable. Usted está de acuerdo con que el webmaster, el administrador y los asesores de { SITE_NAME } tienen el derecho de quitar o de corregir cualquier contenido en cualquier momento si lo consideran necesario. Como usuario, accede a que cualquier información añadida será almacenada en una base de datos. Asi mismo, esta información no será divulgada a terceros sin su consentimiento. El webmaster y el administrador no se pueden hacer responsables de ningún intento de destrucción de la base de datos que pueda conducir a la pérdida de la misma.<br />
<br />
Este sitio utiliza cookies para almacenar la información en su ordenador. Estas cookies sirven para mejorar la navegación en este sitio. La dirección de email se utiliza solamente para confirmar sus detalles y contraseña del registro.<br />
<br />
Pulsando 'estoy de acuerdo' expresas tu conformidad con estas condiciones.
EOT;

$lang_register_php = array(
	'page_title' => 'Registro de nuevo usuario',
	'term_cond' => 'Términos y condiciones',
	'i_agree' => 'Estoy de acuerdo',
	'submit' => 'Enviar solicitud de registro',
	'err_user_exists' => 'El nombre de usuario elegido ya existe, por favor elige otro diferente',
	'err_password_mismatch' => 'Las dos contraseñas no son iguales, por favor vuelve a introducirlas',
	'err_uname_short' => 'El nombre de usuario debe ser de 2 caracteres de longitud como mínimo',
	'err_password_short' => 'La contraseña debe ser de 2 caracteres de longitud como mínimo',
	'err_uname_pass_diff' => 'El nombre de usuario y la contraseña deben ser diferentes',
	'err_invalid_email' => 'La dirección de email no es válida',
	'err_duplicate_email' => 'Otro usuario se ha registrado anteriormente con la dirección de email suministrada',
	'enter_info' => 'Introduce la información de registro',
	'required_info' => 'Información requerida',
	'optional_info' => 'Información opcional',
	'username' => 'Nombre de usuario',
	'password' => 'Contraseña',
	'password_again' => 'Reescribir contraseña',
	'email' => 'Email',
	'location' => 'Localidad',
	'interests' => 'Intereses',
	'website' => 'Página web',
	'occupation' => 'Ocupación',
	'error' => 'ERROR',
	'confirm_email_subject' => '%s - Confirmación de registro',
	'information' => 'Información',
	'failed_sending_email' => '¡El email de confirmación de registro no ha podido ser enviado!',
	'thank_you' => 'Gracias por registrarte.<br /><br />Hemos enviado un email con información sobre la activación de tu cuenta a la dirección de email que nos has facilitado.',
	'acct_created' => 'Tu cuenta de usuario ha sido creada y ahora puedes acceder al sistema con tu nombre de usuario y contraseña',
	'acct_active' => 'Tu cuenta de usuario está ya activa y ahora puedes acceder al sistema con tu nombre de usuario y contraseña',
	'acct_already_act' => '¡Tu cuenta ya estaba activa!',
	'acct_act_failed' => '¡Esta cuenta no puede ser activada!',
	'err_unk_user' => '¡El usuario seleccionado no existe!',
	'x_s_profile' => 'Perfil de %s',
	'group' => 'Grupo',
	'reg_date' => 'Fecha de alta',
	'disk_usage' => 'Uso de disco',
	'change_pass' => 'Cambiar contraseña',
	'current_pass' => 'Contraseña actual',
	'new_pass' => 'Nueva contraseña',
	'new_pass_again' => 'Reescribir nueva contraseña',
	'err_curr_pass' => 'La contraseña actual es incorrecta',
	'apply_modif' => 'Guardar los cambios',
	'change_pass' => 'Cambiar mi contraseña',
	'update_success' => 'Tu perfil ha sido actualizado',
	'pass_chg_success' => 'Tu contraseña ha sido cambiada',
	'pass_chg_error' => 'Tu contraseña no ha sido cambiada',
);

$lang_register_confirm_email = <<<EOT
Gracias por registrarte en {SITE_NAME}

Tu nombre de usuario es: "{USER_NAME}"
Tu contraseña es: "{PASSWORD}"

Para terminar de activar tu cuenta, debes pulsar sobre el enlace que
aparece debajo o copiarlo y pegarlo en tu navegador de InterNet.

{ACT_LINK}

Saludos.

Los administradores de {SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => 'Revisar comentarios',
	'no_comment' => 'No existen comentarios que mostrar',
	'n_comm_del' => '%s comentario(s) borrado(s)',
	'n_comm_disp' => 'Número de comentarios a mostrar',
	'see_prev' => 'Ver el anterior',
	'see_next' => 'Ver el siguiente',
	'del_comm' => 'Borrar comentarios seleccionados',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => 'Buscar entre todas las fotos',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => 'Buscar nuevas fotos',
	'select_dir' => 'Selecciona directorio',
	'select_dir_msg' => 'Esta función te permite añadir de forma automática las fotos que hayas subido a tu servidor mediante FTP.<br /><br />Selecciona el directorio donde has subido tus fotos',
	'no_pic_to_add' => 'No hay ninguna foto para añadir',
	'need_one_album' => 'Necesitas al menos un album para utilizar esta función',
	'warning' => 'Atención',
	'change_perm' => '¡El script no puede escribir en este directorio, necesitas cambiar sus permisos a modo 755 o 777 antes de intentarlo de nuevo!',
	'target_album' => '<b>Colocar las fotos del dierctorio &quot;</b>%s<b>&quot; en el album </b>%s',
	'folder' => 'Carpeta',
	'image' => 'Foto',
	'album' => 'Album',
	'result' => 'Resultado',
	'dir_ro' => 'No se puede escribir. ',
	'dir_cant_read' => 'No se puede leer. ',
	'insert' => 'Añadiendo nuevas fotos a la galería',
	'list_new_pic' => 'Listado de nuevas fotos',
	'insert_selected' => 'Añadir las fotos seleccionadas',
	'no_pic_found' => 'No se encontró ninguna foto nueva',
	'be_patient' => 'Por favor, se paciente, el script necesita tiempo para añadir las fotos',
	'notes' =>  '<ul>'.
				'<li><b>OK</b> : significa que la foto fue añadida sin problemas'.
				'<li><b>DP</b> : significa que la foto es un duplicado y ya existe en la base de datos'.
				'<li><b>PB</b> : significa que la foto no puede ser añadida, por favor comprueba la configaración y los permisos de los directorios donde están las fotos'.
				'<li>Si los iconos OK, DP, PB no aparecen, pulsa sobre el icono de imagen no cargada para ver el error producido por PHP'.
				'<li>Si el navegador produce un timeout, pulsa el icono de Actualizar'.
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
                'title' => 'Expulsar Usuarios',
                'user_name' => 'Nombre de Usuario',
                'ip_address' => 'Dirección IP',
                'expiry' => 'Caduca (en blanco es permanente)',
                'edit_ban' => 'Guardar Cambios',
                'delete_ban' => 'Borrar',
                'add_new' => 'Añadir Nueva Expulsión',
                'add_ban' => 'Añadir',
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
	'title' => 'Insertar nueva foto',
	'max_fsize' => 'El tamaño máximo de fichero admitido es de %s KB',
	'album' => 'Album',
	'picture' => 'Foto',
	'pic_title' => 'Título de la foto',
	'description' => 'Descripción de la foto',
	'keywords' => 'Palabras clave (separadas por espacios)',
	'err_no_alb_uploadables' => 'Perdona pero no hay ningún album donde esté permitido insertar nuevas fotos',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => 'Administrar usuarios',
	'name_a' => 'Ascendente por nombre',
	'name_d' => 'Descendente por nombre',
	'group_a' => 'Ascendente por grupo',
	'group_d' => 'Descendente por grupo',
	'reg_a' => 'Ascendente por fecha de alta',
	'reg_d' => 'Descendente por fecha de alta',
	'pic_a' => 'Ascendente por total de fotos',
	'pic_d' => 'Descendente por total de fotos',
	'disku_a' => 'Ascendente por uso de disco',
	'disku_d' => 'Descendente por uso de disco',
	'sort_by' => 'Ordenar usuarios por',
	'err_no_users' => '¡La tabla de usuarios está vacía!',
	'err_edit_self' => 'No puedes editar tu propio perfil, usa la opción \'Mi perfil de usuario\' para eso',
	'edit' => 'EDITAR',
	'delete' => 'BORRAR',
	'name' => 'Nombre de usuario',
	'group' => 'Grupo',
	'inactive' => 'Inactivo',
	'operations' => 'Operaciones',
	'pictures' => 'Fotos',
	'disk_space' => 'Espacio usado / Cuota',
	'registered_on' => 'Registrado el día',
	'u_user_on_p_pages' => '%d usuarios en %d página(s)',
	'confirm_del' => '¿Estás seguro de querer BORRAR este usuario? \\nTodas sus fotos y albums serán también borrados.',
	'mail' => 'MAIL',
	'err_unknown_user' => '¡El usuario seleccionado no existe!',
	'modify_user' => 'Modificar usuario',
	'notes' => 'Notas',
	'note_list' => '<li>Si no quieres cambiar la contraseña actual, deja el campo "contraseña" vacío',
	'password' => 'Contraseña',
	'user_active' => 'El usuario está activo',
	'user_group' => 'Grupo de usuarios',
	'user_email' => 'Email del usuario',
	'user_web_site' => 'Página web del usuario',
	'create_new_user' => 'Crear nuevo usuario',
	'user_location' => 'Localidad del usuario',
	'user_interests' => 'Intereses del usuario',
	'user_occupation' => 'Ocupación del usuario',
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => 'Cambiar tamaño a las fotos',
        'what_it_does' => 'Qué hace',
        'what_update_titles' => 'Actualiza los nombres de fichero',
        'what_delete_title' => 'Borra los títulos',
        'what_rebuild' => 'Vuelve a crear los thumbnails y otros tamaños de las fotos',
        'what_delete_originals' => 'Borra las fotos originales reemplazándolas con versiones de nuevo tamaño',
        'file' => 'Fichero',
        'title_set_to' => 'título a poner',
        'submit_form' => 'enviar',
        'updated_succesfully' => 'actualizado con éxito',
        'error_create' => 'ERROR al crear',
        'continue' => 'Procesar más imágnes',
        'main_success' => 'El fichero %s ha sido usado como foto principal con éxito',
        'error_rename' => 'Error renombrando %s a %s',
        'error_not_found' => 'No se encuentra el fichero %s',
        'back' => 'volver al inicio',
        'thumbs_wait' => 'Actualizando thumbnails y/o tamaños de fotos, por favor espere...',
        'thumbs_continue_wait' => 'Continuando la actualización de thumbnails y/o tamaños de fotos...',
        'titles_wait' => 'Actualizando títulos, por favor espere...',
        'delete_wait' => 'Borrando títulos, por favor espere...',
        'replace_wait' => 'Borrando originales y reemplazándolos con las fotos de nuevo tamaño, por favor espere...',
        'instruction' => 'Instrucciones rápidas',
        'instruction_action' => 'Selecionar acción',
        'instruction_parameter' => 'Poner parámetros',
        'instruction_album' => 'Seleccionar album',
        'instruction_press' => 'Pulsar %s',
        'update' => 'Actualizar thumbs y/o tamaños de fotos',
        'update_what' => 'Qué debe ser actualizado',
        'update_thumb' => 'Solo thumbnails',
        'update_pic' => 'Solo tamaños de fotos',
        'update_both' => 'Thumbnails y tamaños de fotos (ambos)',
        'update_number' => 'Número de imágenes procesadas por cada click',
        'update_option' => '(Prueba a poner un número menor si experimentas problemas de timeout)',
        'filename_title' => 'Fichero &rArr; Título de la foto',
        'filename_how' => 'Cómo debe ser el fichero modificado',
        'filename_remove' => 'Quitar .jpg del final y reemplazar _ (underscore) con espacios',
        'filename_euro' => 'Cambiar 2003_11_23_13_20_20.jpg a 23/11/2003 13:20',
        'filename_us' => 'Cambiar 2003_11_23_13_20_20.jpg a 11/23/2003 13:20',
        'filename_time' => 'Cambiar 2003_11_23_13_20_20.jpg a 13:20',
        'delete' => 'Borrar títulos de fotos o fotos de tamaño original',
        'delete_title' => 'Borrar títulos de fotos',
        'delete_original' => 'Borrar fotos de tamaño original',
        'delete_replace' => 'Borra las imágenes originales, reemplazándolas con otras de tamaño nuevo',
        'select_album' => 'Selecciona album',
);

?>