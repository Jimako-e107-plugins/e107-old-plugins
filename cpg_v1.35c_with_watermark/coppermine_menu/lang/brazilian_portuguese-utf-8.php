<?php
// ------------------------------------------------------------------------- //
//  Coppermine Photo Gallery v1.2                                            //
// ------------------------------------------------------------------------- //
//  Copyright (C) 2002,2003  Grégory DEMAR <gdemar@wanadoo.fr>               //
//  http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
//  Based on PHPhotoalbum by Henning Støverud <henning@stoverud.com>         //
//  http://www.stoverud.com/PHPhotoalbum/                                    //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
// ------------------------------------------------------------------------- //

// info about translators and translated language 
$lang_translation_info = array( 
'lang_name_english' => 'Portuguese (Brazilian)',  //the name of your language in English, e.g. 'Greek' or 'Spanish' 
'lang_name_native' => 'Portuguese (Brasilian)', //the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol' 
'lang_country_code' => 'br', //the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es' 
'trans_name'=> '?', //the name of the translator - can be a nickname 
'trans_email' => '', //translator's email address (optional) 
'trans_website' => '', //translator's website (optional) 
'trans_date' => '2003-10-07', //the date the translation was created / last modified 
); 

$lang_charset = 'iso-8859-1';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab');
$lang_month = array('Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez');

// Some common strings
$lang_yes = 'Sim';
$lang_no  = 'Nao';
$lang_back = 'VOLTAR';
$lang_continue = 'CONTINUAR';
$lang_info = 'Informação';
$lang_error = 'Erro';

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
	'random' => 'Imagens Randômicas',
	'lastup' => 'Últimas Adições',
	'lastcom' => 'Últimos Comentários',
	'topn' => 'Mais Visualizados',
	'toprated' => 'Topo de Linha',
	'lasthits' => 'Últimos Visualizados',
	'search' => 'Resultado da Pesquisa',
        'favpics'=> 'Favourite Pictures', //new in cpg1.2.0
);

$lang_errors = array(
	'access_denied' => 'Você não tem permissão para visualizar este recurso.',
	'perm_denied' => 'Você não tem permissão para executar esta operação.',
	'param_missing' => 'Script não consegue estabelecer um parâmetro estabelecido.',
	'non_exist_ap' => 'O álbum ou figura que voccê selecionau não foi encontrado !',
	'quota_exceeded' => 'A quota de espaço para armazenamento excedeu<br /><br />Você possui [quota]KB de espaço, suas imagens atualmente utilizam [space]KB, adicionar este arquivo irá estourar sua cota permitida.',
	'gd_file_type_err' => 'estamos usando uma sistema que só permite imagens JPEG e PNG.',
	'invalid_image' => 'A imagem que você enviou está corrompida ou não pode ser interpretada por GD library',
	'resize_failed' => 'Impossível criar miniatura ou redimensionar a imagem.',
	'no_img_to_display' => 'Sem imagens para mostrar',
	'non_exist_cat' => 'A categoria selecionada não existe',
	'orphan_cat' => 'A category has a non-existing parent, runs the category manager to correct the problem.',
	'directory_ro' => 'Directory \'%s\' is not writable, pictures can\'t be deleted',
	'non_exist_comment' => 'O comentário selecionado não existe.',
	'pic_in_invalid_album' => 'Imagem em um album inexistente (%s)!?',
        'banned' => 'You are currently banned from using this site.',  //new in cpg1.2.0
        'not_with_udb' => 'This function is disabled in Coppermine because it is integrated with forum software. Either what you are trying to do is not supported in this configuration, or the function should be handled by the forum software.',  //new in cpg1.2.0
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => 'Ir para a lista de álbus',
	'alb_list_lnk' => 'Lista de álbuns',
	'my_gal_title' => 'Ir para minha galeria pessoal',
	'my_gal_lnk' => 'Minha Galeria',
	'my_prof_lnk' => 'Meus dados',
	'adm_mode_title' => 'Alterar para o modo administrativo',
	'adm_mode_lnk' => 'Modo Administrativo',
	'usr_mode_title' => 'Alterar para modo Usuário',
	'usr_mode_lnk' => 'Modo Usuário',
	'upload_pic_title' => 'Enviar imagem para o álbum',
	'upload_pic_lnk' => 'Enviar imagem',
	'register_title' => 'Criar uma conta',
	'register_lnk' => 'Registar',
	'login_lnk' => 'Login',
	'logout_lnk' => 'Logout',
	'lastup_lnk' => 'Últimos envios',
	'lastcom_lnk' => 'Últimos comentários',
	'topn_lnk' => 'Mais Visualizados',
	'toprated_lnk' => 'Topo de linha',
	'search_lnk' => 'Pesquisar',
        'fav_lnk' => 'My Favorites', //new in cpg1.2.0
);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => 'Envio aprovado',
	'config_lnk' => 'Configuração',
	'albums_lnk' => 'Álbuns',
	'categories_lnk' => 'Categorias',
	'users_lnk' => 'Usuários',
	'groups_lnk' => 'Grupos',
	'comments_lnk' => 'Comentários',
	'searchnew_lnk' => 'Envio em massa',
        'util_lnk' => 'Resize pictures',  //new in cpg1.2.0
        'ban_lnk' => 'Ban Users',  //new in cpg1.2.0
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => 'Criar / ordnar meus álbuns',
	'modifyalb_lnk' => 'Modificar meus álbuns',
	'my_prof_lnk' => 'Meus Dados',
);

$lang_cat_list = array(
	'category' => 'Categoria',
	'albums' => 'Álbuns',
	'pictures' => 'Imagens',
);

$lang_album_list = array(
	'album_on_page' => '%d álbuns na(s) %d página(s)'
);

$lang_thumb_view = array(
	'date' => 'DATA',
        //Sort by filename and title
        'name' => 'NOME', //new in cpg1.2.0
        'title' => 'TITLE', //new in cpg1.2.0
	'sort_da' => 'Mostar por data ascendente',
	'sort_dd' => 'Mostar por data descendente',
	'sort_na' => 'Mostar por nome ascendente',
	'sort_nd' => 'Mostar por nome descendente',
        'sort_ta' => 'Sort by title ascending',  //new in cpg1.2.0
        'sort_td' => 'Sort by title descending',  //new in cpg1.2.0
	'pic_on_page' => '%d imagens na(s) %d pagina(s)',
	'user_on_page' => '%d usuários na(s) %d página(s)'
);

$lang_img_nav_bar = array(
	'thumb_title' => 'Retornar para a página de miniaturas',
	'pic_info_title' => 'Mostar/esconder informações da imagem',
	'slideshow_title' => 'Show de Slides',
	'ecard_title' => 'enviar esta imagem como e-card',
	'ecard_disabled' => 'e-cards estão desabilitados',
	'ecard_disabled_msg' => 'Você não possui permissão para enviar e-cards',
	'prev_title' => 'Ver imagem anterior',
	'next_title' => 'Ver próxima imagem',
	'pic_pos' => 'IMAGEM %s/%s',
);

$lang_rate_pic = array(
	'rate_this_pic' => 'Qualifique esta imagem ',
	'no_votes' => '(Nenhum voto)',
	'rating' => '(Corrente qualificação : %s / 5 dos %s votos)',
	'rubbish' => 'Ruim',
	'poor' => 'Pobre',
	'fair' => 'Justo',
	'good' => 'Bom',
	'excellent' => 'Excelente',
	'great' => 'Espetacular',
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
	CRITICAL_ERROR => 'ERRO CRÍTICO',
	'file' => 'Arquivo: ',
	'line' => 'Linha: ',
);

$lang_display_thumbnails = array(
	'filename' => 'Arquivo : ',
	'filesize' => 'Tamanho : ',
	'dimensions' => 'Dimensões : ',
	'date_added' => 'Data Envio : '
);

$lang_get_pic_data = array(
	'n_comments' => '%s comentários',
	'n_views' => '%s visualizações',
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
	'Exclamation' => 'Exclamação',
	'Question' => 'Questão',
	'Very Happy' => 'Muito Feliz',
	'Smile' => 'Sorriso',
	'Sad' => 'Triste',
	'Surprised' => 'Surpreso',
	'Shocked' => 'Chocado',
	'Confused' => 'Confuso',
	'Cool' => 'Cool',
	'Laughing' => 'Risonho',
	'Mad' => 'Louco',
	'Razz' => 'Razz',
	'Embarassed' => 'Embaraçado',
	'Crying or Very sad' => 'Muito triste',
	'Evil or Very Mad' => 'Muito máu',
	'Twisted Evil' => 'Twisted Evil',
	'Rolling Eyes' => 'Rolando os olhos',
	'Wink' => 'Piscando',
	'Idea' => 'Ideia',
	'Arrow' => 'Seta',
	'Neutral' => 'Neutro',
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
	0 => 'Deixando o modo administrativo...',
	1 => 'Entrando no modo administrativo...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => 'Álbuns precisam ter um nome !',
	'confirm_modifs' => 'Tem certeza que deseja realizar as modificaçõs ?',
	'no_change' => 'Você não fêz nenhuma mudança  !',
	'new_album' => 'Novo álbum',
	'confirm_delete1' => 'Tem certeza de querer remover este álbum ?',
	'confirm_delete2' => '\nTodas as imagens e comentários serão perdidos !',
	'select_first' => 'Primeiro selecione um álbum',
	'alb_mrg' => 'Gerenciador de álbuns',
	'my_gallery' => '* Minha Galeria *',
	'no_category' => '* Sem categoria *',
	'delete' => 'Apagar',
	'new' => 'Novo',
	'apply_modifs' => 'Aplicar modificações',
	'select_category' => 'Selecione uma categoria',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => 'Parametros requeridos para \'%s\'operação não fornecida !',
	'unknown_cat' => 'A ctegoria selecionada não existe em nossa base de dados',
	'usergal_cat_ro' => 'A categoria do usuário não pode ser excluída !',
	'manage_cat' => 'Gerenciar categorias',
	'confirm_delete' => 'Você tem certeza que deseja EXCLUIR  esta categoria ? ',
	'category' => 'Categoria',
	'operations' => 'Operações',
	'move_into' => 'Mover em',
	'update_create' => 'Atualizar/Criar categoria',
	'parent_cat' => 'Categoria parente',
	'cat_title' => 'Título da categoria',
	'cat_desc' => 'Descrição da categoria'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => 'Configuração',
	'restore_cfg' => 'Restaurar configuração de fábrica',
	'save_cfg' => 'Salvar nova configuração',
	'notes' => 'Notas',
	'info' => 'Informação',
	'upd_success' => 'Configuração do catálogo atualizada',
	'restore_success' => 'Configuração de fábrica restaurada',
	'name_a' => 'Nome ascendente',
	'name_d' => 'Nome descendente',
        'title_a' => 'Title ascending',  //new in cpg1.2.0
        'title_d' => 'Title descending',  //new in cpg1.2.0
	'date_a' => 'Data Ascendente',
	'date_d' => 'Data descendente',
        'th_any' => 'Max Aspect',
        'th_ht' => 'Height',
        'th_wd' => 'Width',
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'General settings',
	array('Gallery name', 'gallery_name', 0),
	array('Gallery description', 'gallery_description', 0),
	array('Gallery administrator email', 'gallery_admin_email', 0),
	array('Target address for the \'See more pictures\' link in e-cards', 'ecards_more_pic_target', 0),
	array('Language', 'lang', 5),
	array('Theme', 'theme', 6),

	'Album list view',
	array('Width of the main table (pixels or %)', 'main_table_width', 0),
	array('Number of levels of categories to display', 'subcat_level', 0),
	array('Number of albums to display', 'albums_per_page', 0),
	array('Number of columns for the album list', 'album_list_cols', 0),
	array('Size of thumbnails in pixels', 'alb_list_thumb_size', 0),
	array('The content of the main page', 'main_page_layout', 0),
        array('Show first level album thumbnails in categories','first_level',1),  //new in cpg1.2.0

	'Thumbnail view',
	array('Number of columns on thumbnail page', 'thumbcols', 0),
	array('Number of rows on thumbnail page', 'thumbrows', 0),
	array('Maximum number of tabs to display', 'max_tabs', 0),
	array('Display picture caption (in addition to title) below the thumbnail', 'caption_in_thumbview', 1),
	array('Display number of comments below the thumbnail', 'display_comment_count', 1),
	array('Default sort order for pictures', 'default_sort_order', 3),
	array('Minimum number of votes for a picture to appear in the \'top-rated\' list', 'min_votes_for_rating', 0),

	'Image view &amp; Comment settings',
	array('Width of the table for picture display (pixels or %)', 'picture_table_width', 0),
	array('Picture information are visible by default', 'display_pic_info', 1),
	array('Filter bad words in comments', 'filter_bad_words', 1),
	array('Allow smiles in comments', 'enable_smilies', 1),
	array('Max length for an image description', 'max_img_desc_length', 0),
	array('Max number of characters in a word', 'max_com_wlength', 0),
	array('Max number of lines in a comment', 'max_com_lines', 0),
	array('Maximum length of a comment', 'max_com_size', 0),
        array('Show film strip', 'display_film_strip', 1),  //new in cpg1.2.0
        array('Number of items in film strip', 'max_film_strip_items', 0), 

	'Pictures and thumbnails settings',
	array('Quality for JPEG files', 'jpeg_qual', 0),
        array('Max dimension of a thumbnail <b>*</b>', 'thumb_width', 0),  //new in cpg1.2.0
        array('Use dimension ( width or height or Max aspect for thumbnail )<b>*</b>', 'thumb_use', 7),  //new in cpg1.2.0
	array('Create intermediate pictures','make_intermediate',1),
	array('Max width or height of an intermediate picture <b>*</b>', 'picture_width', 0),
	array('Max size for uploaded pictures (KB)', 'max_upl_size', 0),
	array('Max width or height for uploaded pictures (pixels)', 'max_upl_width_height', 0),

	'User settings',
	array('Allow new user registrations', 'allow_user_registration', 1),
	array('User registration requires email verification', 'reg_requires_valid_email', 1),
	array('Allow two users to have the same email address', 'allow_duplicate_emails_addr', 1),
	array('Users can can have private albums', 'allow_private_albums', 1),

	'Custom fields for image description (leave blank if unused)',
	array('Field 1 name', 'user_field1_name', 0),
	array('Field 2 name', 'user_field2_name', 0),
	array('Field 3 name', 'user_field3_name', 0),
	array('Field 4 name', 'user_field4_name', 0),

	'Pictures and thumbnails advanced settings',
        array('Show private album Icon to unlogged user','show_private',1),  //new in cpg1.2.0
	array('Characters forbidden in filenames', 'forbiden_fname_char',0),
	array('Accepted file extensions for uploaded pictures', 'allowed_file_extensions',0),
	array('Method for resizing images','thumb_method',2),
	array('Path to ImageMagick \'convert\' utility (example /usr/bin/X11/)', 'impath', 0),
	array('Allowed image types (only valid for ImageMagick)', 'allowed_img_types',0),
	array('Command line options for ImageMagick', 'im_options', 0),
	array('Read EXIF data in JPEG files', 'read_exif_data', 1),
	array('The album directory <b>*</b>', 'fullpath', 0),
	array('The directory for user pictures <b>*</b>', 'userpics', 0),
	array('The prefix for intermediate pictures <b>*</b>', 'normal_pfx', 0),
	array('The prefix for thumbnails <b>*</b>', 'thumb_pfx', 0),
	array('Default mode for directories', 'default_dir_mode', 0),
	array('Default mode for pictures', 'default_file_mode', 0),

	'Cookies &amp; Charset settings',
	array('Name of the cookie used by the script', 'cookie_name', 0),
	array('Path of the cookie used by the script', 'cookie_path', 0),
	array('Character encoding', 'charset', 4),

	'Miscellaneous settings',
	array('Enable debug mode', 'debug_mode', 1),

	'<br /><div align="center">(*) Fields marked with * must not be changed if you already have pictures in your gallery</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => 'Você precisa definir um nome para o comentário',
	'com_added' => 'sua conta foi criada',
	'alb_need_title' => 'Você deve definir um nome para o álbum !',
	'no_udp_needed' => 'Atualização não necessária.',
	'alb_updated' => 'O álbum foi atualizado',
	'unknown_album' => 'O álbum selecionado não existe ou você não tem permissão para enviar imagens para ele',
	'no_pic_uploaded' => 'Nenhuma imagem enviada !<br /><br />Se você realmente selecionaou ima imagem para enviar, verifique se o servidor permite envios...',
	'err_mkdir' => 'Falha ao criar diretório %s !',
	'dest_dir_ro' => 'Diretório de destino %s não pode ser gravado pelo script !',
	'err_move' => 'Impossível mover %s para %s !',
	'err_fsize_too_large' => 'A imagem que você está tentando enviar é muito grande (máximo permitido %s x %s) !',
	'err_imgsize_too_large' => 'O tamanho da imagem é maior que o permitido (máximo permitido %s KB) !',
	'err_invalid_img' => 'O arquivo que você está tentando enviar não é um arquivo de imagem válido !',
	'allowed_img_types' => 'Você só pode enviar %s imagens.',
	'err_insert_pic' => 'A imagem \'%s\' não pode ser inserida no álbum ',
	'upload_success' => 'Sua imagem foi enviada com sucesso<br /><br />Porém só será visível após a aprovação do Administrador.',
	'info' => 'Informação',
	'com_added' => 'Comentário adicionado',
	'alb_updated' => 'Álbum atualizado',
	'err_comment_empty' => 'Seu comentário está vazio !',
	'err_invalid_fext' => 'Somente os arquivos com as seguines extenções são permitidos : <br /><br />%s.',
	'no_flood' => 'Desculpe mas você é o último autor a enviar um comentário<br /><br />Edite o comentário se deseja alterá-lo',
	'redirect_msg' => 'Você está sendo redirecionado.<br /><br /><br />Clique \'CONTINUE\' se a página não se atualizar automaticamente',
	'upl_success' => 'Sua imagem foi adicionada com sucesso',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => 'Sob-Título',
	'fs_pic' => 'tamanho total da imagem',
	'del_success' => 'removido com sucesso',
	'ns_pic' => 'tamanho normal da imagem',
	'err_del' => 'não pode ser escluído',
	'thumb_pic' => 'miniatura',
	'comment' => 'comentário',
	'im_in_alb' => 'imagem no álbum',
	'alb_del_success' => 'Álbum \'%s\' REMOVIDO',
	'alb_mgr' => 'Gerenciador de álbuns',
	'err_invalid_data' => 'Dados recebidos inválidos \'%s\'',
	'create_alb' => 'Criando álbuns \'%s\'',
	'update_alb' => 'Atualizando álbuns \'%s\' título \'%s\' índice \'%s\'',
	'del_pic' => 'Remover imagem',
	'del_alb' => 'Remover álbum',
	'del_user' => 'Remover usuário',
	'err_unknown_user' => 'O usuário selecionado não existe !',
	'comment_deleted' => 'O comentário foi removido com sucesso',
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
	'confirm_del' => 'Tem certeza de EXCLUIR  esta imagem ? \\nComentários vinculados também serão excluídos.',
	'del_pic' => 'DELETE THIS PICTURE',
	'size' => '%s x %s pixels',
	'views' => '%s vezes',
	'slideshow' => 'Slideshow',
	'stop_slideshow' => 'PARAR SLIDESHOW',
	'view_fs' => 'Clique para ver a ampliação da imagem',
);

$lang_picinfo = array(
	'title' =>'INFORMAÇÕES DA IMAGEM',
	'Filename' => 'Nome',
	'Album name' => 'Álbum',
	'Rating' => 'Classificação (%s votos)',
	'Keywords' => 'Palavras-chave',
	'File Size' => 'Tamanho do arquivo',
	'Dimensions' => 'Dimensões',
	'Displayed' => 'Mostrado',
	'Camera' => 'Camera',
	'Date taken' => 'Data',
	'Aperture' => 'Abertura',
	'Exposure time' => 'Tempo de exposição',
	'Focal length' => 'Largura focal',
	'Comment' => 'Comentário',
        'addFav' => 'Add to Fav',  //new in cpg1.2.0
        'addFavPhrase' => 'Favourites',  //new in cpg1.2.0
        'remFav' => 'Remove from Fav',  //new in cpg1.2.0
);

$lang_display_comments = array(
	'OK' => 'OK',
	'edit_title' => 'Editar este comentário',
	'confirm_delete' => 'Tem certeza de REMOVER este comentário ?',
	'add_your_comment' => 'Adicione seu comentário',
        'name'=>'Name',  //new in cpg1.2.0
        'comment'=>'Comment',  //new in cpg1.2.0
	'your_name' => 'Seu nome',
);

$lang_fullsize_popup = array( 
        'click_to_close' => 'Click image to close this window',  //new in cpg1.2.0
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => 'Send an e-card',
	'invalid_email' => '<b>Warning</b> : endereço eletrônico inválido !',
	'ecard_title' => 'Há um e-card %s para você',
	'view_ecard' => 'Se não estiver aparecendo normalmente clique neste link',
	'view_more_pics' => 'Clique aqui para ver mais imagens !',
	'send_success' => 'Seu e-card foi enviado',
	'send_failed' => 'Desculpe, mas o servidor não pode enviar seu e-card...',
	'from' => 'Remetente',
	'your_name' => 'Seu nome',
	'your_email' => 'Seu e-amil',
	'to' => 'Para',
	'rcpt_name' => 'Destinatário',
	'rcpt_email' => 'E-mail do destinatário',
	'greetings' => 'Saudações',
	'message' => 'Mensagem',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => 'Picture&nbsp;info',
	'album' => 'Álbum',
	'title' => 'Título',
	'desc' => 'Descrição',
	'keywords' => 'Palavras-chave',
	'pic_info_str' => '%sx%s - %sKB - %s views - %s votes',
	'approve' => 'Aprovar imagem',
	'postpone_app' => 'Postpone approval',
	'del_pic' => 'Apagar imagem',
	'reset_view_count' => 'Zerar contador',
	'reset_votes' => 'Zerar votos',
	'del_comm' => 'Excluir comentários',
	'upl_approval' => 'Aprovar envio',
	'edit_pics' => 'Editar imagens',
	'see_next' => 'Ver próximas imagens',
	'see_prev' => 'Ver imagens anteriores',
	'n_pic' => '%s imagens',
	'n_of_pic_to_disp' => 'Número de imagens a mostrar',
	'apply' => 'Aplicar modificações'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => 'Nome do Grupo',
	'disk_quota' => 'Quota de disco',
	'can_rate' => 'Pode avaliar imagens',
	'can_send_ecards' => 'Pode enviar e-cards',
	'can_post_com' => 'Pode enviar comentários',
	'can_upload' => 'Pode enviar imagens',
	'can_have_gallery' => 'Pode ter uma galeria pessoal',
	'apply' => 'Aplicar modificações',
	'create_new_group' => 'Criar novo grupo',
	'del_groups' => 'Apagar grupo(s) selecionado(s)',
	'confirm_del' => 'CUIDADO: Ao remover um grupo seu conteúdo será transferido para \'Registered\' !\n\nquer continuar ?',
	'title' => 'Gerenciar grupos',
	'approval_1' => 'Aprovação pública (1)',
	'approval_2' => 'Aaprovação privada (2)',
	'note1' => '<b>(1)</b> Envios para um álbum público requerem aprovação do administrador',
	'note2' => '<b>(2)</b> Envios requerem aprovação do administrador',
	'notes' => 'Notas'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
	'welcome' => 'Welcome !'
);

$lang_album_admin_menu = array(
	'confirm_delete' => 'Tem certeza que deseja EXCLUIR este álbum ? \\nTodas as imagens e comentários serão excluídos.',
	'delete' => 'EXCLUIR',
	'modify' => 'PROPRIEDADES',
	'edit_pics' => 'EDITAR IMAGENS',
);

$lang_list_categories = array(
	'home' => 'Home',
	'stat1' => '<b>[pictures]</b> imagens em <b>[albums]</b> álbuns e <b>[cat]</b> categorias com <b>[comments]</b> comentários vistos <b>[views]</b> vezes',
	'stat2' => '<b>[pictures]</b> imagens em <b>[albums]</b> álbuns vistos <b>[views]</b> vezes',
	'xx_s_gallery' => '%s\'s Galeria',
	'stat3' => '<b>[pictures]</b> imagens em <b>[albums]</b> álbuns com <b>[comments]</b> comentários vistos <b>[views]</b> vezes'
);

$lang_list_users = array(
	'user_list' => 'Lista de usuários',
	'no_user_gal' => 'Nenhum usuário permitido a ter álbuns',
	'n_albums' => '%s álbum(s)',
	'n_pics' => '%s imagem(s)'
);

$lang_list_albums = array(
	'n_pictures' => '%s imagem',
	'last_added' => ', último adicionado em %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => 'Login',
	'enter_login_pswd' => 'Insira seu nome de usuário e senha para entrar',
	'username' => 'Usuário',
	'password' => 'Senha',
	'remember_me' => 'Lembar',
	'welcome' => 'Bem Vindo(a) %s ...',
	'err_login' => '*** Impossível entar. Verifique os dados fornecidos e tente de novo ***',
	'err_already_logged_in' => 'Você está agora dentro de nosso sistema ! (Logged)',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => 'Logout',
	'bye' => 'Bye bye %s ...',
	'err_not_loged_in' => 'Você está fora de nosso sistema (logout) !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => 'Atualizar álbum %s',
	'general_settings' => 'Configurações gerais',
	'alb_title' => 'Título do álbum',
	'alb_cat' => 'Categoria do álbum',
	'alb_desc' => 'Descrição do álbum',
	'alb_thumb' => 'Miniatura do álbum',
	'alb_perm' => 'Permissões para este álbum',
	'can_view' => 'Álbum pode ser visto por',
	'can_upload' => 'Visitantes podem enviar imagens',
	'can_post_comments' => 'Visitantes podem enviar comentários',
	'can_rate' => 'Visitantes podem avaliar imagens',
	'user_gal' => 'Galeria do Usuário',
	'no_cat' => '* Sem categoria *',
	'alb_empty' => 'Álbum vazio',
	'last_uploaded' => 'Último envio',
	'public_alb' => 'Todos (album público)',
	'me_only' => 'Apenas eu',
	'owner_only' => 'Proprietário (%s) apenas',
	'groupp_only' => 'Membros do  grupo\'%s\' ',
	'err_no_alb_to_modify' => 'Nenhum album que você pode modificar na base de dados .',
	'update' => 'Atualizar álbum'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => 'Desculpe, mas você ja avaliou esta imagem',
	'rate_ok' => 'Seu voto foi aceito',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
While the administrators of {SITE_NAME} will attempt to remove or edit any generally objectionable material as quickly as possible, it is impossible to review every post. Therefore you acknowledge that all posts made to this site express the views and opinions of the author and not the administrators or webmaster (except for posts by these people) and hence will not be held liable.<br />
<br />
You agree not to post any abusive, obscene, vulgar, slanderous, hateful, threatening, sexually-orientated or any other material that may violate any applicable laws. You agree that the webmaster, administrator and moderators of {SITE_NAME} have the right to remove or edit any content at any time should they see fit. As a user you agree to any information you have entered above being stored in a database. While this information will not be disclosed to any third party without your consent the webmaster and administrator cannot be held responsible for any hacking attempt that may lead to the data being compromised.<br />
<br />
This site uses cookies to store information on your local computer. These cookies serve only to improve your viewing pleasure. The email address is used only for confirming your registration details and password.<br />
<br />
By clicking 'I agree' below you agree to be bound by these conditions.
EOT;

$lang_register_php = array(
	'page_title' => 'REGISTRO DE USUÁRIO',
	'term_cond' => 'Termos e condições',
	'i_agree' => 'Eu Aceito',
	'submit' => 'enviar registro',
	'err_user_exists' => 'Este nome de usuário já existe, por favor crie outro',
	'err_password_mismatch' => 'As duas senhas digitadas não conferem. Digite com cuidado novamente',
	'err_uname_short' => 'Nome de usuário precisa ter no mínimo 2 caracteres',
	'err_password_short' => 'sua senha tem que ter no mínimo 2 caracteres',
	'err_uname_pass_diff' => 'Nome de usuário e senha devem ser diferentes',
	'err_invalid_email' => 'Endereço de e-mail inválido',
	'err_duplicate_email' => 'Já existe outro usuário registrado com este e-mail',
	'enter_info' => 'Entre com as informações de registro',
	'required_info' => 'Informação requerida',
	'optional_info' => 'Informação opcional',
	'username' => 'Usuário',
	'password' => 'Senha',
	'password_again' => 'Repita a senha',
	'email' => 'E-mail',
	'location' => 'Endereço',
	'interests' => 'Interesses',
	'website' => 'Home page',
	'occupation' => 'Profissão',
	'error' => 'ERRO',
	'confirm_email_subject' => '%s - CONFIRMAÇÃO DE REGISTRO',
	'information' => 'Informação',
	'failed_sending_email' => 'O e-mail de confirmação de registro não pôde ser enviado !',
	'thank_you' => 'Obrigado pr se registrar.<br /><br />As informações para finalizar seu registro foram enviadas para seu e-mail. Verifique agora ou aguarde uns instantes.',
	'acct_created' => 'Sua conta foi criada. Para acessar o catálogo você deve fornecer seu nome de usuário e sua senha',
	'acct_active' => 'Sua conta já está ativa. Entre com seu nome de usuário e senha para acessar os dados do catálogo',
	'acct_already_act' => 'Sua conta já está ativa !',
	'acct_act_failed' => 'Esta conta não está ativa ainda !',
	'err_unk_user' => 'Usuário selecionado não existe !',
	'x_s_profile' => '%s\'s profile',
	'group' => 'Grupo',
	'reg_date' => 'PArticipante',
	'disk_usage' => 'Uso do disco',
	'change_pass' => 'Alterar senha',
	'current_pass' => 'Senha atual',
	'new_pass' => 'Nova senha',
	'new_pass_again' => 'Nova senha de novo',
	'err_curr_pass' => 'Senha atual INCORRETA',
	'apply_modif' => 'Aplicar modificações',
	'change_pass' => 'Alterar minha senha',
	'update_success' => 'Seus dados foram atualizadsos',
	'pass_chg_success' => 'Sua senha foi alterada',
	'pass_chg_error' => 'Sua senha não foi alterada',
);

$lang_register_confirm_email = <<<EOT
Thank you for registering at {SITE_NAME}

Seu nome de usuário é : "{USER_NAME}"
Sua senha é : "{PASSWORD}"

Clique no link abaixo ou copie e cole no seu Browser para acessar nosso catálogo

{ACT_LINK}

Obrigado pela inscrição,

O Administrador
{SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => 'Revisar comentários',
	'no_comment' => 'Não há comentários para revisar',
	'n_comm_del' => '%s comentário(s) removido',
	'n_comm_disp' => 'Número de comentários ',
	'see_prev' => 'Ver anterior',
	'see_next' => 'Ver próximo',
	'del_comm' => 'Excluir comentários selecionados',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => 'Pesquisar na coleção de imagens',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => 'Pesquisar novas imagens',
	'select_dir' => 'Selecionar diretório',
	'select_dir_msg' => 'Esta função lhe permite enviar diversas imagens ao mesmo tempo.<br /><br />Selecione o diretório das imagens',
	'no_pic_to_add' => 'Não há imagens para enviar',
	'need_one_album' => 'Você precisater pelo menus um álbum para usar esta função',
	'warning' => 'CUIDADO',
	'change_perm' => 'O script não pode gravar neste diretório que deve possuir permissão 755 ou 777 !',
	'target_album' => '<b>Colocar imagens do &quot;</b>%s<b>&quot; em </b>%s',
	'folder' => 'Pasta',
	'image' => 'Imagem',
	'album' => 'Álbum',
	'result' => 'Resultado',
	'dir_ro' => 'Não gravável. ',
	'dir_cant_read' => 'Não pode ser lido. ',
	'insert' => 'Adicionando novas imagens à galeria',
	'list_new_pic' => 'Lista das novas imagens',
	'insert_selected' => 'Inserir imagens selecionadas',
	'no_pic_found' => 'Não há imagens novas',
	'be_patient' => 'Por favoe tenha paciência. O sistema nescessita de tempo para enviar suas imagens',
	'notes' =>  '<ul>'.
				'<li><b>OK</b> : Significa que foi enviado com sucesso'.
				'<li><b>DP</b> : Significa que existe uma duplicata na base de datos'.
				'<li><b>PB</b> : significa que não pôde ser enviado. Verifique suas permissões e corretos endereços.'.
				'<li>Se o OK, DP, PB \'signs\' não aparecem, clique na imagem com problema para receber a mensagem do erro'.
				'<li>Se receber mensagem de expiração, acione reload'.
				'</ul>',
);


// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //

// Void


// ------------------------------------------------------------------------- // 
// File banning.php  //new in cpg1.2.0
// ------------------------------------------------------------------------- // 

if (defined('BANNING_PHP')) $lang_banning_php = array( 
                'title' => 'Ban Users', 
                'user_name' => 'User Name', 
                'ip_address' => 'IP Address', 
                'expiry' => 'Expires (blank is permanent)', 
                'edit_ban' => 'Save Changes', 
                'delete_ban' => 'Delete', 
                'add_new' => 'Add New Ban', 
                'add_ban' => 'Add', 
); 

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
	'title' => 'envio de imagem',
	'max_fsize' => 'Tamanho máximo permitido %s KB',
	'album' => 'Álbum',
	'picture' => 'Imagem',
	'pic_title' => 'Título',
	'description' => 'Descrição',
	'keywords' => 'Palavras-chave (separar somente com espaços)',
	'err_no_alb_uploadables' => 'desculpe. Você não está autorizado a enviar para este álbum',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => 'Gerenciar usuários',
	'name_a' => 'Nome Ascendente',
	'name_d' => 'Nome Descendente',
	'group_a' => 'Grupo Ascendente',
	'group_d' => 'Grupo Descendente',
	'reg_a' => 'Data de registro Ascendente',
	'reg_d' => 'Data de registro Descendente',
	'pic_a' => 'Contagem de imagens ascendente',
	'pic_d' => 'Constagem de imagem descendente',
	'disku_a' => 'Uso de disco ascendente',
	'disku_d' => 'Uso de disco descendente',
	'sort_by' => 'Listar usuários por',
	'err_no_users' => 'Tabela de usuários está vazia !',
	'err_edit_self' => 'Você não pode alterar os dados \'My profile\' ',
	'edit' => 'EDITAR',
	'delete' => 'EXCLUIR',
	'name' => 'Usuário',
	'group' => 'Grupo',
	'inactive' => 'Inativo',
	'operations' => 'Operações',
	'pictures' => 'Imagens',
	'disk_space' => 'Espaço usado / Quota',
	'registered_on' => 'Registrado on',
	'u_user_on_p_pages' => '%d usuários em %d página(s)',
	'confirm_del' => 'Tem certeza que quer EXCLUIR este usuário ? \\nTodas as imagens e álbuns dele serão removidas.',
	'mail' => 'MAIL',
	'err_unknown_user' => 'Usuário selecionado não existe !',
	'modify_user' => 'Modificar usuário',
	'notes' => 'Notas',
	'note_list' => '<li>Se você não quer alterar sua senha, deixe o campo em branco',
	'password' => 'Senha',
	'user_active' => 'Usuário é ativo',
	'user_group' => 'GBrupo de usuários',
	'user_email' => 'E-mail do usuário',
	'user_web_site' => 'Site do usuário',
	'create_new_user' => 'Criar novo usuário',
	'user_location' => 'Endereço',
	'user_interests' => 'Interesse',
	'user_occupation' => 'Ocupação',
);

// ------------------------------------------------------------------------- // 
// File util.php  //new in cpg1.2.0
// ------------------------------------------------------------------------- // 

if (defined('UTIL_PHP')) $lang_util_php = array( 
        'title' => 'Resize pictures', 
        'what_it_does' => 'What it does', 
        'what_update_titles' => 'Updates titles from filename', 
        'what_delete_title' => 'Deletes titles', 
        'what_rebuild' => 'Rebuilds thumbnails and resized photos', 
        'what_delete_originals' => 'Deletes original sized photos replacing them with the sized version', 
        'file' => 'File', 
        'title_set_to' => 'title set to', 
        'submit_form' => 'submit', 
        'updated_succesfully' => 'updated succesfully', 
        'error_create' => 'ERROR creating', 
        'continue' => 'Process more images', 
        'main_success' => 'The file %s was successfully used as main picture', 
        'error_rename' => 'Error renaming %s to %s', 
        'error_not_found' => 'The file %s was not found', 
        'back' => 'back to main', 
        'thumbs_wait' => 'Updating thumbnails and/or resized images, please wait...', 
        'thumbs_continue_wait' => 'Continuing to update thumbnails and/or resized images...', 
        'titles_wait' => 'Updating titles, please wait...', 
        'delete_wait' => 'Deleting titles, please wait...', 
        'replace_wait' => 'Deleting originals and replacing them with resized images, please wait..', 
        'instruction' => 'Quick instructions', 
        'instruction_action' => 'Select action', 
        'instruction_parameter' => 'Set parameters', 
        'instruction_album' => 'Select album', 
        'instruction_press' => 'Press %s', 
        'update' => 'Update thumbs and/or resized photos', 
        'update_what' => 'What should be updated', 
        'update_thumb' => 'Only thumbnails', 
        'update_pic' => 'Only resized pictures', 
        'update_both' => 'Both thumbnails and resized pictures', 
        'update_number' => 'Number of processed images per click', 
        'update_option' => '(Try setting this option lower if you experience timeout problems)', 
        'filename_title' => 'Filename ? Picture title', 
        'filename_how' => 'How should the filename be modified', 
        'filename_remove' => 'Remove the .jpg ending and replace _ (underscore) with spaces', 
        'filename_euro' => 'Change 2003_11_23_13_20_20.jpg to 23/11/2003 13:20', 
        'filename_us' => 'Change 2003_11_23_13_20_20.jpg to 11/23/2003 13:20', 
        'filename_time' => 'Change 2003_11_23_13_20_20.jpg to 13:20', 
        'delete' => 'Delete picture titles or original size photos', 
        'delete_title' => 'Delete picture titles', 
        'delete_original' => 'Delete original size photos', 
        'delete_replace' => 'Deletes the original images replacing them with the sized versions', 
        'select_album' => 'Select album', 
); 

?>