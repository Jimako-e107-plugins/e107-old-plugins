<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.3.4                                            //
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
// ENCODING CHECK; SHOULD BE YEN BETA MU: ¥ ß µ
// ------------------------------------------------------------------------- //
// $Id: portuguese.php,v 1.7 2005/09/19 08:42:15 gaugau Exp $
// ------------------------------------------------------------------------- //

// info about translators and translated language
$lang_translation_info = array(
  'lang_name_english' => 'Português',
  'lang_name_native' => 'Português',
  'lang_country_code' => 'pt',
  'trans_name'=> 'Portugal',
  'trans_email' => '',
  'trans_website' => '',
  'trans_date' => '2005/08/01',
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
$lang_no  = 'Não';
$lang_back = 'VOLTAR';
$lang_continue = 'CONTINUAR';
$lang_info = 'Informação';
$lang_error = 'Erro';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%d de %B, %Y';
$lastcom_date_fmt =  '%d/%m/%y as %H:%M'; //cpg1.3.0
$lastup_date_fmt = '%d de %B, %Y';
$register_date_fmt = '%d de %B, %Y';
$lasthit_date_fmt = '%d de %B, %Y as %I:%M %p'; //cpg1.3.0
$comment_date_fmt =  '%d de %B, %Y as %I:%M %p'; //cpg1.3.0

// For the word censor
$lang_bad_words = array('foda*', 'cu', 'otario', 'bicha', 'caralho', 'kct*', 'rola', 'porra', 'merda', 'idiota', 'otario', 'tabacudo', 'rola', 'buceta','tabacuda', 'fuck', 'lesbica', 'gay', 'bixa', 'frango', 'burro');

$lang_meta_album_names = array(
	'random' => 'Fotos Aleatórias',
	'lastup' => 'Últimas Fotos Adicionadas',
	'lastalb'=> 'Últimos Albuns Actualizados',
	'lastcom' => 'Últimos Comentários',
	'topn' => 'Fotos Mais Vistas',
	'toprated' => 'Fotos com mais Popularidade',
	'lasthits' => 'Últimas Fotos Vistas',
	'search' => 'Resultado da Pesquisa',
	'favpics'=> 'Fotos Favoritas', //cpg1.3.0
);

$lang_errors = array(
	'access_denied' => 'Não tem permissão para visualizar esta página.',
	'perm_denied' => 'Não tem permissão para executar esta operação.',
	'param_missing' => 'Script executado com falta de parâmentos.',
	'non_exist_ap' => 'O album ou foto que seleccionou não foi encontrado!',
	'quota_exceeded' => 'A quota de espaço para armazenamento excedeu o limite<br /><br />Possui [quota]KB de espaço e as suas fotos actualmente utilizam [space]KB, se adicionar este ficheiro irá ultrapassar o limite.',
	'gd_file_type_err' => 'Estamos a usar um sistema que só permite fotos JPEG e PNG.',
	'invalid_image' => 'A foto que enviou está corrompida ou não pode ser 
interpretada pela biblioteca GD',
	'resize_failed' => 'Não foi possível criar a miniatura ou redimensionar a foto.',
	'no_img_to_display' => 'Sem fotos para exibir',
	'non_exist_cat' => 'A categoria seleccionada não existe',
	'orphan_cat' => 'A categoria tem um parâmento que não existe, vá para ao gestor de categorias e corrija o problema.',
	'directory_ro' => 'O Diretório \'%s\' não é gravável, as fotos não podem ser apagadas',
	'non_exist_comment' => 'O comentário seleccionado não existe.',
	'pic_in_invalid_album' => 'Foto num album inexistente (%s)!?',
	'banned' => 'Esta banido deste site.',
	'not_with_udb' => 'Esta função esta desactivada na Galeria. O que está a tentar fazer não é suportado nesta configuração.',
	'offline_title' => 'Offline.', //cpg1.3.0
	'offline_text' => 'Estamos offline - tente novamente mais tarde', 
//cpg1.3.0
	'ecards_empty' => 'Não há nenhum registo de ecards para visualizar. Verifique se activou a opção de validar os Ecards na configuração!', //cpg1.3.0
	'action_failed' => 'Erro. Não foi possivel processar o seu pedido.', //cpg1.3.0
	'no_zip' => 'As bibliotecas necessárias para processar os arquivos em ZIP não estão disponiveis. Por favor contacte o Administrador.', //cpg1.3.0
	'zip_type' => 'Não tem permissão para enviar arquivos ZIP.', //cpg1.3.0
);


$lang_bbcode_help = 'Seguir estes codigos pode ser útil: 
<li>[b]<b>Negrito</b>[/b]</li> <li>[i]<i>Itálico</i>[/i]</li> 
<li>[url=http://www.oseusitio.pt/]Url Text[/url]</li> 
<li>[email]nome@isp.pt[/email]</li>'; //cpg1.3.0

// ------------------------------------------------------------------------- 
//
// File theme.php
// ------------------------------------------------------------------------- 
//

$lang_main_menu = array(
	'alb_list_title' => 'Ir para a lista de albums',
	'alb_list_lnk' => 'Albuns',
	'my_gal_title' => 'Ir para Minha Galeria Pessoal',
	'my_gal_lnk' => 'A Minha Galeria',
	'my_prof_lnk' => 'Os Meus Dados',
	'adm_mode_title' => 'Mudar para modo Admin',
	'adm_mode_lnk' => 'Modo Admin',
	'usr_mode_title' => 'Mudar para modo Utilizador',
	'usr_mode_lnk' => 'Modo Utilizador',
	'upload_pic_title' => 'Enviar foto para o album',
	'upload_pic_lnk' => 'Enviar foto',
	'register_title' => 'Criar uma conta',
	'register_lnk' => 'Clique aqui para se Registar',
	'login_lnk' => 'Login',
	'logout_lnk' => 'Logout',
	'lastup_lnk' => 'Últimas fotos',
	'lastcom_lnk' => 'Últimos comentários',
	'topn_lnk' => 'As Mais Visualizadas',
	'toprated_lnk' => 'Fotos mais Populares',
	'search_lnk' => 'Pesquisar',
	'fav_lnk' => 'Os Meus Favoritos',
	'memberlist_title' => 'Lista de Membros', //cpg1.3.0
	'memberlist_lnk' => 'Membros', //cpg1.3.0
	'faq_title' => 'Questões mais Frequentes sobre a Galeria', //cpg1.3.0
	'faq_lnk' => 'FAQ', //cpg1.3.0

);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => 'Aprovar Fotos Enviadas',
	'config_lnk' => 'Configurações',
	'albums_lnk' => 'Albuns',
	'categories_lnk' => 'Categorias',
	'users_lnk' => 'Utilizadores',
	'groups_lnk' => 'Grupos',
	'comments_lnk' => 'Ver Comentários',
	'searchnew_lnk' => 'Adicionar Fotos num Album',
	'util_lnk' => 'Ferramentas Administrativas', //cpg1.3.0
	'ban_lnk' => 'Utilizadores Banidos',
	'db_ecard_lnk' => 'Visualizar Ecards', //cpg1.3.0
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => 'Criar/ordenar os meus albums',
	'modifyalb_lnk' => 'Modificar os meus albums',
	'my_prof_lnk' => 'Os Meus Dados',
);

$lang_cat_list = array(
	'category' => 'Categoria',
	'albums' => 'Albuns',
	'pictures' => 'Fotos',
);

$lang_album_list = array(
	'album_on_page' => '%d album(s) na(s) %d página(s)'
);

$lang_thumb_view = array(
	'date' => 'DATA',
	//Ordenar por arquivo e titulo
	'name' => 'FICHEIRO',
	'title' => 'TÍTULO',
	'sort_da' => 'Ordenar por data crescente',
	'sort_dd' => 'Ordenar por data decrescente',
	'sort_na' => 'Ordenar por nome ascendente',
	'sort_nd' => 'Ordenar por nome descendente',
	'sort_ta' => 'Ordenar por título ascendente',
	'sort_td' => 'Ordenar por título descendente',
	'download_zip' => 'Fazer download do ficheiro ZIP com os seus favoritos', //cpg1.3.0
	'pic_on_page' => '%d foto(s) na(s) %d pagina(s)',
	'user_on_page' => '%d utilizador(es) na(s) %d página(s)'
);

$lang_img_nav_bar = array(
	'thumb_title' => 'Voltar para a página de miniaturas',
	'pic_info_title' => 'Mostrar/Esconder informações do ficheiro',
	'slideshow_title' => 'SlideShow',
	'ecard_title' => 'enviar esta foto como e-card',
	'ecard_disabled' => 'os e-cards estão desactivados',
	'ecard_disabled_msg' => 'Não tem permissão para enviar e-cards',
	'prev_title' => 'Ver foto anterior',
	'next_title' => 'Ver próxima foto',
	'pic_pos' => 'FOTO %s - TOTAL %s',
);

$lang_rate_pic = array(
	'rate_this_pic' => 'Classifique esta foto ',
	'no_votes' => '(Nenhum voto até o momento)',
	'rating' => '(Média de votos : %s / 5 dos %s votos)',
	'rubbish' => 'Péssima',
	'poor' => 'Pobre',
	'fair' => 'Satisfatória',
	'good' => 'Boa',
	'excellent' => 'Excelente',
	'great' => 'Espectacular',
);

// ------------------------------------------------------------------------- 
//
// File include/exif.inc.php
// ------------------------------------------------------------------------- 
//

// void

// ------------------------------------------------------------------------- 
//
// File include/functions.inc.php
// ------------------------------------------------------------------------- 
//

$lang_cpg_die = array(
	INFORMATION => $lang_info,
	ERROR => $lang_error,
	CRITICAL_ERROR => 'ERRO CRÍTICO',
	'file' => 'Ficheiro: ',
	'line' => 'Linha: ',
);

$lang_display_thumbnails = array(
	'filename' => 'Ficheiro : ',
	'filesize' => 'Tamanho : ',
	'dimensions' => 'Dimensões : ',
	'date_added' => 'Data de Envio : '
);

$lang_get_pic_data = array(
	'n_comments' => '%s comentários',
	'n_views' => '%s visualizações',
	'n_votes' => '(%s votos)'
);

$lang_cpg_debug_output = array(
  'debug_info' => 'Informações de Debug', //cpg1.3.0
  'select_all' => 'Seleccionar Tudo', //cpg1.3.0
  'copy_and_paste_instructions' => 'Se for pedir ajuda ao suporte do 
administrador, copie e cole isto no seu pedido de ajuda. Certifique-se de ter 
removido todas as senhas que aparecerem antes de enviar.', //cpg1.3.0
  'phpinfo' => 'mostrar phpinfo', //cpg1.3.0
);

$lang_language_selection = array(
  'reset_language' => 'Idioma Padrão', //cpg1.3.0
  'choose_language' => 'Escolha o seu idioma', //cpg1.3.0
);

$lang_theme_selection = array(
  'reset_theme' => 'Tema padrão', //cpg1.3.0
  'choose_theme' => 'Escolha um tema', //cpg1.3.0
);

// ------------------------------------------------------------------------- 
//
// File include/init.inc.php
// ------------------------------------------------------------------------- 
//

// void

// ------------------------------------------------------------------------- 
//
// File include/picmgmt.inc.php
// ------------------------------------------------------------------------- 
//

// void

// ------------------------------------------------------------------------- 
//
// File include/smilies.inc.php
// ------------------------------------------------------------------------- 
//

if (defined('SMILIES_PHP')) $lang_smilies_inc_php = array(
	'Exclamation' => 'Exclamação',
	'Question' => 'Questão',
	'Very Happy' => 'Muito Feliz',
	'Smile' => 'Sorriso',
	'Sad' => 'Triste',
	'Surprised' => 'Surpreendido',
	'Shocked' => 'Chocado',
	'Confused' => 'Confuso',
	'Cool' => 'Legal',
	'Laughing' => 'Risonho',
	'Mad' => 'Louco',
	'Razz' => 'Razz',
	'Embarassed' => 'Embaraçado',
	'Crying or Very sad' => 'Muito triste/Muito Doente',
	'Evil or Very Mad' => 'Muito máu',
	'Twisted Evil' => 'Demonio louco',
	'Rolling Eyes' => 'Rolando os olhos',
	'Wink' => 'Piscando',
	'Idea' => 'Ideia',
	'Arrow' => 'Seta',
	'Neutral' => 'Neutro',
	'Mr. Green' => 'Mr. Green',
);

// ------------------------------------------------------------------------- 
//
// File addpic.php
// ------------------------------------------------------------------------- 
//

// void

// ------------------------------------------------------------------------- 
//
// File admin.php
// ------------------------------------------------------------------------- 
//

if (defined('ADMIN_PHP')) $lang_admin_php = array(
	0 => 'A Sair da Administração...',
	1 => 'A Entrar na Administração...',
);

// ------------------------------------------------------------------------- 
//
// File albmgr.php
// ------------------------------------------------------------------------- 
//

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => 'Os Albuns precisam de ter um nome !',
	'confirm_modifs' => 'Tem certeza que deseja realizar as modificações ?',
	'no_change' => 'Não fez nenhuma mudança!',
	'new_album' => 'Novo album',
	'confirm_delete1' => 'Tem certeza que deseja remover este album ?',
	'confirm_delete2' => '\nTodas as fotos e comentários serão perdidos !',
	'select_first' => 'Primeiro seleccione um album',
	'alb_mrg' => 'Gestor de albums',
	'my_gallery' => '* A Minha Galeria *',
	'no_category' => '* Sem categoria *',
	'delete' => 'Apagar',
	'new' => 'Novo',
	'apply_modifs' => 'Aplicar modificações',
	'select_category' => 'Seleccione uma categoria',
);

// ------------------------------------------------------------------------- 
//
// File catmgr.php
// ------------------------------------------------------------------------- 
//

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => 'Faltam Parâmetros para operação \'%s\' !',
	'unknown_cat' => 'A categoria seleccionada não existe no nosso banco de 
dados',
	'usergal_cat_ro' => 'A categoria do utilizador não pode ser apagada !',
	'manage_cat' => 'Gerirr categorias',
	'confirm_delete' => 'Tem certeza que deseja APAGAR esta categoria ? 
',
	'category' => 'Categoria',
	'operations' => 'Operações',
	'move_into' => 'Mover para',
	'update_create' => 'Actualizar/Criar categoria',
	'parent_cat' => 'Sub-categoria',
	'cat_title' => 'Título da categoria',
	'cat_thumb' => 'Miniatura da categoria', //cpg1.3.0
	'cat_desc' => 'Descrição da categoria',
);

// ------------------------------------------------------------------------- 
//
// File config.php
// ------------------------------------------------------------------------- 
//

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => 'Configuração',
	'restore_cfg' => 'Restaurar configuração padrão',
	'save_cfg' => 'Guardar nova configuração',
	'notes' => 'Notas',
	'info' => 'Informação',
	'upd_success' => 'Configurações actualizadas!',
	'restore_success' => 'Configuração padrão restaurada',
	'name_a' => 'Nome ascendente',
	'name_d' => 'Nome descendente',
	'title_a' => 'Título ascendente',
	'title_d' => 'Título descendente',
	'date_a' => 'Data Crescente',
	'date_d' => 'Data Decrescente',
	'th_any' => 'Aspecto Máximo',
	'th_ht' => 'Altura',
	'th_wd' => 'Largura',
	'label' => 'etiqueta', //cpg1.3.0
	'item' => 'item', //cpg1.3.0
	'debug_everyone' => 'Todos', //cpg1.3.0
	'debug_admin' => 'Apenas o admin', //cpg1.3.0
        );


if (defined('CONFIG_PHP')) $lang_config_data = array(
	'Configurações Gerais',
	array('Nome da Galeria', 'gallery_name', 0),
	array('Descrição da Galeria', 'gallery_description', 0),
	array('Email do Administrador', 'gallery_admin_email', 0),
	array('URL da Galeria(para aparecer no ecard e no link direto para 
imagem)', 'ecards_more_pic_target', 0),
	array('Galeria Offline', 'offline', 1), //cpg1.3.0
	array('Validar ecards', 'log_ecards', 1), //cpg1.3.0
	array('Permitir download de ZIP dos favoritos', 'enable_zipdownload', 1), 
//cpg1.3.0

	'Idioma, Temas &amp; Configurações de Caractere',
	array('Idioma', 'lang', 5),
	array('Tema', 'theme', 6),
	array('Mostrar lista de idiomas', 'language_list', 1), //cpg1.3.0
	array('Mostrar bandeiras em vez dos nomes', 'language_flags', 8), 
//cpg1.3.0
	array('Mostrar &quot;fazer reset&quot; na selecção de idioma', 'language_reset', 
1), //cpg1.3.0
	array('Mostrar a lista de temas', 'theme_list', 1), //cpg1.3.0
	array('Mostrar &quot;fazer reset&quot; na selecção de tema', 'theme_reset', 1), 
//cpg1.3.0
	array('Mostrar FAQ', 'display_faq', 1), //cpg1.3.0
	array('Mostrar ajuda para o bbcode', 'show_bbcode_help', 1), //cpg1.3.0
	array('Codificação de Caracteres', 'charset', 4), //cpg1.3.0


	'Visualização da Lista de Albuns',
	array('Largura da tabela principal (em pixels ou %)', 'main_table_width', 
0),
	array('Número de Niveis de categorias para visualizar', 'subcat_level', 0),
	array('Número de albuns para visualizar', 'albums_per_page', 0),
	array('Número de colunas para a lista de albuns', 'album_list_cols', 0),
	array('Tamanho das miniaturas em pixels', 'alb_list_thumb_size', 0),
	array('Conteúdo da página principal', 'main_page_layout', 0),
	array('Mostrar o primeiro nível das miniaturas do album nas 
categorias','first_level',1),

	'Visualização das miniaturas',
	array('Número de colunas na página das miniaturas', 'thumbcols', 0),
	array('Número de linhas na página das miniaturas', 'thumbrows', 0),
	array('Número máximo de tabelas', 'max_tabs', 0),
	array('Subtítulo da foto (juntamente com o titulo) abaixo da miniatura', 
'caption_in_thumbview', 1),
	array('Mostrar o número de visualização em baixo da miniatura', 
'views_in_thumbview', 1), //cpg1.3.0
	array('Total de comentários em baixo da miniatura', 'display_comment_count', 
1),
	array('Mostrar o nome de quem enviou em baixo da miniatura', 
'display_uploader', 1), //cpg1.3.0
	array('Modo de organização das fotos', 'default_sort_order', 3),
	array('Número mínimo de votos para uma foto', 'min_votes_for_rating', 0),

	'Visualização das Fotos &amp; Configurações dos Comentários',
	array('Largura da Tabela para visualização das fotos (em pixels ou %)', 
'picture_table_width', 0),
	array('Mostrar informações da foto por padrão', 'display_pic_info', 1),
	array('Censurar palavrões nos comentários', 'filter_bad_words', 1),
	array('Activar smilles', 'enable_smilies', 1),
	array('Permitir comentários consecutivos vindo do mesmo utilizador (desactivar 
protecção de flood)', 'disable_comment_flood_protect', 1), //cpg1.3.0
	array('Tamanho máximo para a descrição de uma foto', 'max_img_desc_length', 
0),
	array('Número máximo de caracteres numa palavra', 'max_com_wlength', 0),
	array('Número máximo de linhas num comentário', 'max_com_lines', 0),
	array('Tamanho máximo de um comentário', 'max_com_size', 0),
	array('Mostrar tira de filme em baixo da foto', 'display_film_strip', 1),
	array('Número de itens na tira de filme', 'max_film_strip_items', 0),
	array('Notificar o admin sobre comentários por email', 
'email_comment_notification', 1), //cpg1.3.0
	array('Intervalo em milisegundos para o Slideshow (1 segundo = 1000 
milisegundos)', 'slideshow_interval', 0), //cpg1.3.0

	'Configurações de Fotos e Miniaturas',
	array('Qualidade das fotos em JPEG', 'jpeg_qual', 0),
	array('Tamanho máximo da dimensão das miniaturas <a href="#notice2" 
class="clickable_option">**</a>', 'thumb_width', 0),
	array('Usar dimensão ( largura ou altura ou Aspecto Máximo para miniaturas 
)<b>**</b>', 'thumb_use', 7),
	array('Fotos intermédias','make_intermediate',1),
	array('Largura ou altura máxima de uma foto intermédias <a 
href="#notice2" class="clickable_option">**</a>', 'picture_width', 0),
	array('Tamanho máximo de uma foto enviada por upload (KB)', 'max_upl_size', 
0),
	array('Largura ou altura máxima de uma foto enviada por upload (em 
pixels)', 'max_upl_width_height', 0),

	'Configurações avançadas das fotos e das miniaturas',
	array('Mostrar Ícone de album privado para um utilizador não 
validado','show_private',1), //cpg1.3.0
	array('Caracteres proibidos nos ficheiros', 'forbiden_fname_char',0),
	//array('Extensões permitidas para as fotos enviadas por upload', 'allowed_file_extensions',0),
	array('Tipos de imagens permitidas', 'allowed_img_types',0), //cpg1.3.0
	array('Tipos de videos permitidos', 'allowed_mov_types',0), //cpg1.3.0
	array('Tipos de audios permitidos', 'allowed_snd_types',0), //cpg1.3.0
	array('Tipos de documentos permitidos', 'allowed_doc_types',0), //cpg1.3.0
	array('Método para redimensionar as fotos','thumb_method',2),
	array('Directório do utilitário para \'converter\' fotos ImageMagick (exemplo /usr/bin/X11/)', 'impath', 0),
	//array('Tipos de fotos permitidas (valido apenas para ImageMagick)', 'allowed_img_types',0),
	array('Linha de comando para o ImageMagick', 'im_options', 0),
	array('Extrair a informação EXIF dos arquivos JPEG?', 'read_exif_data', 1),
	array('Extrair a informação IPTC dos arquivos JPEG?', 'read_iptc_data', 1), //cpg1.3.0
	array('Directório do album <a href="#notice1" class="clickable_option">*</a>', 'fullpath', 0),
	array('Directório para as fotos dos utilizadores <b>*</b>', 'userpics', 0),
	array('Prefixo para as fotos intermédias <b>*</b>', 'normal_pfx', 0),
	array('Prefixo para as miniaturas <b>*</b>', 'thumb_pfx', 0),
	array('Permissão padrão para os directórios', 'default_dir_mode', 0),
	array('Permissão padrão para as fotos', 'default_file_mode', 0),

	'Configurações de utilizadores',
	array('Permitir o registo de novos utilizadores?', 'allow_user_registration', 
1),
	array('O Registo de um utilizador requer a verificação por email?', 
'reg_requires_valid_email', 1),
	array('Notificar o administrador sobre os novos registos por email', 
'reg_notify_admin_email', 1), //cpg1.3.0
	array('Permitir que dois utilizadores tenham o mesmo email?', 
'allow_duplicate_emails_addr', 1),
	array('Utilizadores podem ter albums privados?', 'allow_private_albums', 1),
	array('Notificar por email o administrador sobre novos uploads para 
aprovação', 'upl_notify_admin_email', 1), //cpg1.3.0
	array('Permitir que utilizadores validados visualizem a lista de membros', 
'allow_memberlist', 1), //cpg1.3.0

	'Campos personalizaveis para descrição das fotos(deixe em branco se não for 
usar)',
	array('Nome do Campo 1', 'user_field1_name', 0),
	array('Nome do Campo 2', 'user_field2_name', 0),
	array('Nome do Campo 3', 'user_field3_name', 0),
	array('Nome do Campo 4', 'user_field4_name', 0),

	'Configurações de Cookies',
	array('Nome do cookie usado pelo script', 'cookie_name', 0),
	array('Directório do cookie usado pelo script', 'cookie_path', 0),

	'Ajustes variados',
	array('Ativar modo debug?', 'debug_mode', 1),
	array('Mostrar notices no modo debug', 'debug_notice', 1), //cpg1.3.0

  '<br /><div align="left"><a name="notice1"></a>(*) Estas configurações 
marcadas. não devem ser modificados se ja tiver adicionado alguma foto 
na galeria.<br />
  <a name="notice2"></a>(**) Quando modificar esta configuração, apenas os 
ficheiros adicionados a partir deste ponto terão efeito, então esta avisado 
que esta configuração não deve ser alterada se ja tiver adicionado 
algum arquivo na galeria. Entretando, pode aplicar modificações nos 
ficheiros existentes usando as &quot;<a href="util.php">Ferramentas 
Administrativas</a> (redimensionar fotos)&quot; do menu 
administrativo.</div><br />', //cpg1.3.0
);

// ------------------------------------------------------------------------- 
//
// File db_ecard.php //cpg1.3.0
// ------------------------------------------------------------------------- 
//

if (defined('DB_ECARD_PHP')) $lang_db_ecard_php = array(
  'title' => 'Ecards enviados', //cpg1.3.0
  'ecard_sender' => 'Remetente', //cpg1.3.0
  'ecard_recipient' => 'Destinatário', //cpg1.3.0
  'ecard_date' => 'Data', //cpg1.3.0
  'ecard_display' => 'Ver ecard', //cpg1.3.0
  'ecard_name' => 'Nome', //cpg1.3.0
  'ecard_email' => 'Email', //cpg1.3.0
  'ecard_ip' => 'IP #', //cpg1.3.0
  'ecard_ascending' => 'ascendente', //cpg1.3.0
  'ecard_descending' => 'descendente', //cpg1.3.0
  'ecard_sorted' => 'Classificado', //cpg1.3.0
  'ecard_by_date' => 'por data', //cpg1.3.0
  'ecard_by_sender_name' => 'pelo nome do remetente', //cpg1.3.0
  'ecard_by_sender_email' => 'pelo email do remetente', //cpg1.3.0
  'ecard_by_sender_ip' => 'pelo ip do remetente', //cpg1.3.0
  'ecard_by_recipient_name' => 'pelo nome do destinatário', //cpg1.3.0
  'ecard_by_recipient_email' => 'pelo email do destinatário', //cpg1.3.0
  'ecard_number' => 'a visualizar registo %s para %s de %s', //cpg1.3.0
  'ecard_goto_page' => 'ir para página', //cpg1.3.0
  'ecard_records_per_page' => 'Registos por página', //cpg1.3.0
  'check_all' => 'Marcar Todos', //cpg1.3.0
  'uncheck_all' => 'Desmarcar Todos', //cpg1.3.0
  'ecards_delete_selected' => 'Apagar os ecards seleccionados', //cpg1.3.0
  'ecards_delete_confirm' => 'Tem certeza que deseja apagar os ecard 
seleccionados? Marque a caixa de verificação!', //cpg1.3.0
  'ecards_delete_sure' => 'Tenho certeza', //cpg1.3.0
);


// ------------------------------------------------------------------------- 
//
// File db_input.php
// ------------------------------------------------------------------------- 
//

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => 'Deve preencher o nome e o comentário',
	'com_added' => 'O seu comentário foi adicionado',
	'alb_need_title' => 'Deve definir um nome para o album !',
	'no_udp_needed' => 'Actualização não necessária.',
	'alb_updated' => 'O album foi actualizado',
	'unknown_album' => 'O album seleccionado não existe ou não tem 
permissão para enviar fotos para ele',
	'no_pic_uploaded' => 'Nenhuma foto enviada !<br /><br />Sen realmente 
seleccionou uma foto para enviar, verifique se o servidor permite 
envios...',
	'err_mkdir' => 'Erro ao criar diretório %s !',
	'dest_dir_ro' => 'Directório de destino %s não pode ser gravado pelo script 
!',
	'err_move' => 'Impossível mover %s para %s !',
	'err_fsize_too_large' => 'A foto que está a tentar enviar é muito 
grande (máximo permitido %s x %s) !',
	'err_imgsize_too_large' => 'O tamanho da foto é maior que o permitido 
(máximo permitido %s KB) !',
	'err_invalid_img' => 'O ficheiro que está a tentar enviar não é um 
ficheiro de foto válido !',
	'allowed_img_types' => 'Só pode enviar %s fotos.',
	'err_insert_pic' => 'A foto \'%s\' não pode ser inserida no album ',
	'upload_success' => 'A sua foto foi enviada com sucesso<br /><br />Porém só 
será visível após a aprovação do Administrador.',
	'notify_admin_email_subject' => '%s - Notificação de Envio', //cpg1.3.0
	'notify_admin_email_body' => 'Uma foto foi enviada por %s e precisa da sua 
aprovação. Acesse %s', //cpg1.3.0
	'info' => 'Informação',
	'com_added' => 'Comentário adicionado',
	'alb_updated' => 'Album actualizado',
	'err_comment_empty' => 'O seu comentário está vazio !',
	'err_invalid_fext' => 'Somente os ficheiros com as seguines extenções são 
permitidos : <br /><br />%s.',
	'no_flood' => 'Desculpe mas é o último autor a enviar um comentário<br 
/><br />Edite o comentário se deseja alterá-lo',
	'redirect_msg' => 'Está a ser redireccionado.<br /><br /><br />Clique 
\'CONTINUE\' se a página não se actualizar automaticamente',
	'upl_success' => 'A sua foto foi adicionada com sucesso',
	'email_comment_subject' => 'Comentário postado', //cpg1.3.0
	'email_comment_body' => 'Alguem postou um comentário na sua galeria. Veja-o 
em', //cpg1.3.0
);

// ------------------------------------------------------------------------- 
//
// File delete.php
// ------------------------------------------------------------------------- 
//

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => 'Sub-Título',
	'fs_pic' => 'tamanho total da foto',
	'del_success' => 'apagado com sucesso',
	'ns_pic' => 'tamanho normal da foto',
	'err_del' => 'não pode ser apagado',
	'thumb_pic' => 'miniatura',
	'comment' => 'comentário',
	'im_in_alb' => 'foto no album',
	'alb_del_success' => 'Album \'%s\' APAGADO',
	'alb_mgr' => 'Gestor de albuns',
	'err_invalid_data' => 'Dados recebidos inválidos \'%s\'',
	'create_alb' => 'Criando album \'%s\'',
	'update_alb' => 'Actualizando album \'%s\' título \'%s\' índice \'%s\'',
	'del_pic' => 'Apagar ficheiro',
	'del_alb' => 'Apagar album',
	'del_user' => 'Apagar Utilizador',
	'err_unknown_user' => 'O utilizador seleccionado não existe !',
	'comment_deleted' => 'O comentário foi apagado com sucesso',
);

// ------------------------------------------------------------------------- 
//
// File displayecard.php
// ------------------------------------------------------------------------- 
//

// Void

// ------------------------------------------------------------------------- 
//
// File displayimage.php
// ------------------------------------------------------------------------- 
//

if (defined('DISPLAYIMAGE_PHP')){

$lang_display_image_php = array(
	'confirm_del' => 'Tem certeza que deseja APAGAR esta foto ? \\nComentários 
vinculados também serão apagados.',
	'del_pic' => 'APAGAR ESTA FOTO',
	'size' => '%s x %s pixels',
	'views' => '%s vezes',
	'slideshow' => 'Slideshow',
	'stop_slideshow' => 'PARAR SLIDESHOW',
	'view_fs' => 'Clique para ver a foto ampliada',
	'edit_pic' => 'Editar descrição', //cpg1.3.0
	'crop_pic' => 'Rodar', //cpg1.3.0
);

$lang_picinfo = array(
	'title' =>'INFORMAÇÕES DA FOTO',
	'Filename' => 'Ficheiro',
	'Album name' => 'Album',
	'Rating' => 'Classificação (%s voto(s))',
	'Keywords' => 'Palavras-chave',
	'File Size' => 'Tamanho do arquivo',
	'Dimensions' => 'Dimensões',
	'Displayed' => 'Visualizada',
	'Camera' => 'Câmera',
	'Date taken' => 'Foto tirada em',
	'Aperture' => 'Abertura',
	'Exposure time' => 'Tempo de exposição',
	'Focal length' => 'Largura focal',
	'Comment' => 'Comentário',
	'addFav'=>'Adicionar a favoritos', //cpg1.3.0
	'addFavPhrase'=>'Favoritos', //cpg1.3.0
	'remFav'=>'Remover dos Favoritos', //cpg1.3.0
	'iptcTitle'=>'Titulo IPTC', //cpg1.3.0
	'iptcCopyright'=>'Copyright IPTC', //cpg1.3.0
	'iptcKeywords'=>'Palavras-chave IPTC', //cpg1.3.0
	'iptcCategory'=>'Categoria IPTC', //cpg1.3.0
	'iptcSubCategories'=>'Sub-Categorias IPTC', //cpg1.3.0

);

$lang_display_comments = array(
	'OK' => 'OK',
	'edit_title' => 'Editar este comentário',
	'confirm_delete' => 'Tem certeza de REMOVER este comentário ?',
	'add_your_comment' => 'Adicione seu comentário',
	'name'=>'Nome',
	'comment'=>'Comentário',
	'your_name' => 'Nome',
);

$lang_fullsize_popup = array(
  'click_to_close' => 'Clique na imagem para fechar esta janela',
);

}

// ------------------------------------------------------------------------- 
//
// File ecard.php
// ------------------------------------------------------------------------- 
//

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php 
=array(
	'title' => 'Enviar um e-card',
	'invalid_email' => '<b>Aviso</b> : email inválido !',
	'ecard_title' => '%s enviou um e-card pra si!',
	'error_not_image' => 'Apenas imagens pode ser enviadas como ecard.', 
//cpg1.3.0
	'view_ecard' => 'Se não esta a conseguir visualizar nada clique aqui',
	'view_more_pics' => 'Clique aqui para ver mais fotos !',
	'send_success' => 'O seu e-card foi enviado!',
	'send_failed' => 'Desculpe, mas o servidor não pode enviar o seu e-card...',
	'from' => 'Remetente',
	'your_name' => 'O seu nome',
	'your_email' => 'O seu e-mail',
	'to' => 'Para',
	'rcpt_name' => 'Destinatário',
	'rcpt_email' => 'E-mail do destinatário',
	'greetings' => 'Saudações',
	'message' => 'Mensagem',
);

// ------------------------------------------------------------------------- 
//
// File editpics.php
// ------------------------------------------------------------------------- 
//

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => '&nbsp;Info da Foto',
	'album' => 'Album',
	'title' => 'Título',
	'desc' => 'Descrição',
	'keywords' => 'Palavras-chave',
	'pic_info_str' => '%sx%s - %sKB - %s visitas - %s votos',
	'approve' => 'Aprovar foto',
	'postpone_app' => 'Postpone approval',
	'del_pic' => 'Apagar foto',
	'read_exif' => 'Ler EXIF novamente', //cpg1.3.0
	'reset_view_count' => 'Fazer reset contador',
	'reset_votes' => 'Fazer reset votos',
	'del_comm' => 'Excluir comentários',
	'upl_approval' => 'Aprovar envio',
	'edit_pics' => 'Editar fotos',
	'see_next' => 'Ver próximas fotos',
	'see_prev' => 'Ver fotos anteriores',
	'n_pic' => '%s fotos',
	'n_of_pic_to_disp' => 'Número de fotos a mostrar',
	'apply' => 'Aplicar modificações',
	'crop_title' => 'Editor de Fotos', //cpg1.3.0
	'preview' => 'Pré-visualizar', //cpg1.3.0
	'save' => 'Gravar foto', //cpg1.3.0
	'save_thumb' =>'Gravar como miniatura', //cpg1.3.0
	'sel_on_img' =>'A selecção tem que ser na imagem inteira!', //js-alert 
//cpg1.3.0

);

// ------------------------------------------------------------------------- 
//
// File faq.php //cpg1.3.0
// Ainda não traduzi.
// ------------------------------------------------------------------------- 
//

if (defined('FAQ_PHP')) $lang_faq_php = array(
  'faq' => 'Perguntas mais frequentes', //cpg1.3.0
  'toc' => 'Conteúdo', //cpg1.3.0
  'question' => 'Pergunta: ', //cpg1.3.0
  'answer' => 'Resposta: ', //cpg1.3.0
);

if (defined('FAQ_PHP')) $lang_faq_data = array('Dúvidas Gerais', //cpg1.3.0
  array('Por que eu preciso me registrar?', 'Registração deve ou não deve ser requerida pelo administrador. O registro da ao usuário, características adicionais como envio de fotos, listas favoritas, votar e postar comentários.', 'allow_user_registration', '0'), //cpg1.3.0
  array('Como eu faço para me registrar?', 'Vá em &quot;Registrar-se&quot; e preencha os campos obrigatórios (e os opcionais também se você quiser).<br />Se o Administrador tiver a Ativação de Email ativada, então após o envio de suas informações você irá receber um email informando-o sobre o registro e, lhe dando instruções para a ativação da conta. Sua conta deve ser ativada antes de você tentar logar.', 'allow_user_registration', '1'), //cpg1.3.0
  array('Como eu faço para logar?', 'Vá em &quot;Login&quot;, insira seu usuário e senha (marque &quot;Salvar Senha&quot; caso você queira se logar automaticamente), após isto você estará logado.<br /><b>IMPORTANTE:Seu navegador deve esta habilitado para aceitar Cookies e ele não deve ser deletado se você quiser manter a funcionalidade da opção &quot;Salvar 
Senha&quot;.</b>', 'offline', 0), //cpg1.3.0
  array('Porque eu não consigo logar?', 'Você se registrou e ativou sua conta?. É necessario ativar a conta antes de acessa-lá. Para outros tipos de problema para acessar a conta entre em contato com o administrador do site.', 'offline', 0), //cpg1.3.0
  array('O que acontece se eu esquecer minha senha?', 'Se este site tiver o link &quot;Esqueci minha senha&quot;, use ele. Se não houver, contacte o administrador para pedir uma nova senha.', 'offline', 0), //cpg1.3.0
  //array('What if I changed my email address?', 'Just simply login and change yor email address through quot;Profile&quot;', 'offline', 0), //cpg1.3.0
  array('Como eu salvo uma imagem em &quot;Meus Favoritos&quot;?', 'Clique na figura e depois clique em &quot;informações da foto&quot; (<img src="images/info.gif" width="16" height="16" border="0" alt="Informações da Foto" />); procure um pouco mais abaixo e entao clique em &quot;Adicionar a favoritos&quot;.<br />O administrador deve ter a opção de &quot;Informações da Foto&quot; ativada por padrão.<br />IMPORTANT:Cookies must be enabled and the cookie from this site must not be deleted.', 'offline', 0), //cpg1.3.0
  array('Como eu voto numa foto?', 'Na página da foto abaixo dela tem 6 opções de voto.', 'offline', 0), //cpg1.3.0
  array('Como eu posto um comentário para uma foto?', 'Na página da foto tem um campo disponível para você postar seu comentário.', 'offline', 0), //cpg1.3.0
  array('Como eu envio uma foto?', 'Vá em &quot;Enviar foto&quot;e selecione o album para o qual você deseja enviar a foto, clique em &quot;Procurar&quot; e procure a foto para enviar entao clique em &quot;Abrir&quot; (adicione um titulo e uma descrição se você desejar) e clique em &quot;CONTINUAR&quot;', 'allow_private_albums', 0), //cpg1.3.0
  array('Para onde eu posso enviar a foto?', 'Você poderá enviar a foto para um dos albums que tiver em &quot;Minha Galeria&quot;. O administrador pode permitir que você envie uma foto para um ou mais albums da galeria Principal.', 'allow_private_albums', 0), //cpg1.3.0
  array('Qual tipo e qual tamanho de foto eu posso enviar?', 'O tamanho e o tipo da foto (jpg,gif,..etc.) depende do administrador.', 'offline', 0), //cpg1.3.0
  array('O que é &quot;Minha Galeria&quot;?', '&quot;Minha Galeria&quot; é uma galeria pessoal onde o usuário pode enviar suas fotos e gerencia-las.', 'allow_private_albums', 0), //cpg1.3.0
  array('Como eu crio,renomeio ou deleto um album na &quot;Minha Galeria&quot;?', 'Você deve estar no &quot;Modo-Admin&quot;<br />Vá em &quot;Criar/Ordenar Meus Albums&quot;e clicar em&quot;Novo&quot;. Altere o nome &quot;Novo Album&quot; para o nome que você desejar.<br />Você tambem pode renomear qualquer album na sua galeria.<br />Ao fim de tudo clique em &quot;Aplicar Modificações&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('Como eu posso restringir usuários de verem meus albums?', 'Você deve estar no &quot;Modo-Admin&quot;<br />Vá em &quot;Modificar Meus Albums. Na barra &quot;Actualizar Album&quot;, selecione o album que você deseja modificar.<br />Aqui você pode alterar o nome, a descrição, a figura da miniatura, restringir a visualização e/ou postar comentarios/votar.<br 
/>Click &quot;Update Album&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('Como eu posso ver outros usuários da galeria?', 'Vá em &quot;Albums&quot; e depois clique em Membros &quot;Membros&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('O que são cookies?', 'Cookies são partes de informações que ficam salvas em seu computador.<br />Cookies geralmente permitem ao usuário sair e quando voltar ao site ter varias informações salvas incluindo senha salva de login.', 'offline', 0), //cpg1.3.0
  //array('Aonde eu posso encontrar este programa para o meu site?', 'Coppermine is a free Multimedia Gallery, released under GNU GPL. It is full of features and has been ported to various platforms. Visit the <a href="http://coppermine.sf.net/">Coppermine Home Page</a> to find out more or download it.', 'offline', 0), //cpg1.3.0

  'Navegando no Site', //cpg1.3.0
  array('O que é o botão &quot;Albums&quot;?', 'Isto irá mostrar toda a galeria com o link de cada categoria. Miniatura podem ser um link para uma categoria.', 'offline', 0), //cpg1.3.0
  array('O que é o botão &quot;Minha Galeria&quot;?', 'Esta é uma caracteristica que permite ao usuário ter sua própria galeria, adicionar, deletar ou modificar albums bem como enviar fotos.', 'allow_private_albums', 0), //cpg1.3.0
  array('Qual é a diferença entre &quot;Modo Admin&quot; e &quot;Modo usuário&quot;?', 'Esta é uma caracterisca que permite ao usuário, quando em modo-admin, modificar suas galerias (e outras coisas se permitido pelo administrador).', 'allow_private_albums', 0), //cpg1.3.0
  array('O que é o botão &quot;Enviar foto&quot;?', 'Isto permite ao usuário enviar uma foto (tamanho e tipo são definidos pelo adminstrador do site) para a galeria selecionada por você ou pelo administrador.', 'allow_private_albums', 0), //cpg1.3.0
  array('O que é o botão &quot;Últimos envios&quot;?', 'Neste link você verá a listagem das ultimas foto adicionadas ao site.', 'offline', 0), //cpg1.3.0
  array('O que é o botão &quot;Últimos Comentários&quot;?', 'Aqui você verá os ultimos comentário juntamente com suas respectivas fotos em miniatura.', 'offline', 0), //cpg1.3.0
  array('O que é o botão &quot;Mais visualizadas&quot;?', 'Aqui você verá as fotos listadas por \'Mais Visualizadas\' (tanto por usuário cadastrados com não).', 'offline', 0), //cpg1.3.0
  array('O que é o botão &quot;Mais Popularidade&quot;?', 'Nesta parte você verá as fotos que estão com mais popularidade, incluindo os dados dessa popularidade (ex: 5 usuarios deram nota <img src="images/rating3.gif" width="65" height="14" border="0" alt="" />: qualificando-a como 1 para 5 (1,2,3,4,5) o que resultará numa média de <img src="images/rating3.gif" 
width="65" height="14" border="0" alt="" /> .)<br />As qualificações vão de <img src="images/rating5.gif" width="65" height="14" border="0" alt="best" /> (boa) até <img src="images/rating0.gif" width="65" height="14" border="0" 
alt="worst" /> (terrivel).', 'offline', 0), //cpg1.3.0
  array('O que é o botão &quot;Meus favoritos&quot;?', 'Neste area você poderá ver as fotos que você adicionou em seu favoritos. Esse favoritos será salvo como cookie e ficará salvo em seu computador.', 'offline', 0), //cpg1.3.0
);


// ------------------------------------------------------------------------- 
//
// File forgot_passwd.php //cpg1.3.0
// ------------------------------------------------------------------------- 
//

if (defined('FORGOT_PASSWD_PHP')) $lang_forgot_passwd_php = array(
  'forgot_passwd' => 'Lembrete de Senha', //cpg1.3.0
  'err_already_logged_in' => 'Já esta validado !', //cpg1.3.0
  'enter_username_email' => 'Introduza o seu login(utilizador) ou o seu email', //cpg1.3.0
  'submit' => 'Enviar', //cpg1.3.0
  'failed_sending_email' => 'O Lembrete da sua senha não pode ser enviado 
para seu email !', //cpg1.3.0
  'email_sent' => 'Um email com seu login e a sua senha foi enviado para 
%s', //cpg1.3.0
  'err_unk_user' => 'O utilizador seleccionado não existe!', //cpg1.3.0
  'passwd_reminder_subject' => '%s - Lembrete de Senha', //cpg1.3.0
  'passwd_reminder_body' => 'Solicitou o lembrete de sua senha:
UTilizador: %s
Senha: %s
Aceda %s para validar-se.', //cpg1.3.0
);

// ------------------------------------------------------------------------- 
//
// File groupmgr.php
// ------------------------------------------------------------------------- 
//

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => 'Nome do Grupo',
	'disk_quota' => 'Quota de disco',
	'can_rate' => 'Pode avaliar foto',
	'can_send_ecards' => 'Pode enviar e-cards',
	'can_post_com' => 'Pode enviar comentários',
	'can_upload' => 'Pode enviar fotos',
	'can_have_gallery' => 'Pode ter uma galeria pessoal',
	'apply' => 'Aplicar modificações',
	'create_new_group' => 'Criar novo grupo',
	'del_groups' => 'Apagar grupo(s) selecionado(s)',
	'confirm_del' => 'CUIDADO: Ao remover um grupo seu conteúdo será 
transferido para \'Registrado\' !\n\nquer continuar ?',
	'title' => 'Gerir grupos',
	'approval_1' => 'Aprovação pública (1)',
	'approval_2' => 'Aprovação privada (2)',
	'upload_form_config' => 'Formulário de configuração de upload', //cpg1.3.0
  	'upload_form_config_values' => array( 'Envio de um ficheiro', 'Envio de 
vários ficheiros', 'Envio de URI', 'Envio de ZIP', 'Ficheiros-URI', 
'Arquivo-ZIP', 'URI-ZIP', 'Arquivo-URI-ZIP'), //cpg1.3.0
	'custom_user_upload'=>'Utilizadores devem personalizar o número de caixas de 
envio?', //cpg1.3.0
	'num_file_upload'=>'Número máximo ou exacto de caixas de envio', //cpg1.3.0
	'num_URI_upload'=>'Número máximo ou exacto de caixas de envio URI', 
//cpg1.3.0
	'note1' => '<b>(1)</b> Envios para um album público requerem aprovação do 
administrador',
	'note2' => '<b>(2)</b> Envios requerem aprovação do administrador',
	'notes' => 'Notas'
);

// ------------------------------------------------------------------------- 
//
// File index.php
// ------------------------------------------------------------------------- 
//

if (defined('INDEX_PHP')){

$lang_index_php = array(
  'welcome' => 'Seja Bem Vindo!'
);

$lang_album_admin_menu = array(
	'confirm_delete' => 'Tem certeza que deseja APAGAR este album ? \\nTodas 
as fotos e comentários serão apagados.',
	'delete' => 'APAGAR',
	'modify' => 'MODIFICAR',
	'edit_pics' => 'EDITAR FOTOS',
);

$lang_list_categories = array(
	'home' => 'Início',
	'stat1' => '<b>[pictures]</b> fotos em <b>[albums]</b> albuns e 
<b>[cat]</b> categorias com <b>[comments]</b> comentários vistos 
<b>[views]</b> vezes',
	'stat2' => '<b>[pictures]</b> fotos em <b>[albums]</b> albuns visitadas 
<b>[views]</b> vezes',
	'xx_s_gallery' => '%s\'s Galeria',
	'stat3' => '<b>[pictures]</b> fotos em <b>[albums]</b> albuns com 
<b>[comments]</b> comentários, visitadas <b>[views]</b> vezes'
);

$lang_list_users = array(
	'user_list' => 'Lista de utilizadores',
	'no_user_gal' => 'Nenhum utilizadores é permitido ter albuns',
	'n_albums' => '%s album(s)',
	'n_pics' => '%s foto(s)'
);

$lang_list_albums = array(
	'n_pictures' => '%s foto(s)',
	'last_added' => ', última foto adicionada em %s'
);

}

// ------------------------------------------------------------------------- 
//
// File login.php
// ------------------------------------------------------------------------- 
//

if (defined('LOGIN_PHP')) $lang_login_php = array(
  'login' => 'Login',
  'enter_login_pswd' => 'Insira nome de utilizador e senha para entrar',
  'username' => 'Utilizador',
  'password' => 'Senha',
  'remember_me' => 'Gravar Senha',
  'welcome' => 'Seja Bem Vindo(a) %s ...',
  'err_login' => '*** Não foi possivel validar. Tente novamente ***',
  'err_already_logged_in' => 'Já esta validado !',
  'forgot_password_link' => 'Esqueci-me da senha', //cpg1.3.0
);

// ------------------------------------------------------------------------- 
//
// File logout.php
// ------------------------------------------------------------------------- 
//

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
  'logout' => 'Logout',
  'bye' => 'Volte Sempre %s ...',
  'err_not_loged_in' => 'Não esta validado !',
);

// ------------------------------------------------------------------------- 
//
// File phpinfo.php //cpg1.3.0
// ------------------------------------------------------------------------- 
//

if (defined('PHPINFO_PHP')) $lang_phpinfo_php = array(
  'php_info' => 'Info PHP', //cpg1.3.0
  'explanation' => 'Esta é a saida gerada pela função <a 
href="http://www.php.net/phpinfo">phpinfo()</a>, mostrada com as informações 
da galeria.', //cpg1.3.0
  'no_link' => 'Deixar que outras pessoas vejam sua saida phpinfo() pode ser 
um risco de segurança, este é o motivo desta página so ser mostrada quando 
você está logada como admin. Você não pode postar o link desta página para 
outros, eles terão acesso negado.', //cpg1.3.0
);

// ------------------------------------------------------------------------- 
//
// File modifyalb.php
// ------------------------------------------------------------------------- 
//

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => 'Actualizar album %s',
	'general_settings' => 'Configurações gerais',
	'alb_title' => 'Título do album',
	'alb_cat' => 'Categoria do album',
	'alb_desc' => 'Descrição do album',
	'alb_thumb' => 'Miniatura do album',
	'alb_perm' => 'Permissões para este album',
	'can_view' => 'Album pode ser visto por',
	'can_upload' => 'Visitantes podem enviar fotos',
	'can_post_comments' => 'Visitantes podem enviar comentários',
	'can_rate' => 'Visitantes podem votar nas fotos',
	'user_gal' => 'Galeria do Utilizador',
	'no_cat' => '* Sem categoria *',
	'alb_empty' => 'Album vazio',
	'last_uploaded' => 'Último envio',
	'public_alb' => 'Todos (album público)',
	'me_only' => 'Apenas eu',
	'owner_only' => 'Apenas o dono do album (%s)',
	'groupp_only' => 'Membros do grupo\'%s\' ',
	'err_no_alb_to_modify' => 'Não pode modificar nenhum album no banco de 
dados.',
	'update' => 'Actualizar album',
  	'notice1' => '(*) dependendo das configurações dos %sgrupos%s', 
//cpg1.3.0 (do not translate %s!)
);

// ------------------------------------------------------------------------- 
//
// File ratepic.php
// ------------------------------------------------------------------------- 
//

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => 'Desculpe, mas já avaliou esta foto',
	'rate_ok' => 'Voto aceite',
	'forbidden' => 'Não pode votar nas suas próprias fotos.', //cpg1.3.0
);

// ------------------------------------------------------------------------- 
//
// File register.php & profile.php
// ------------------------------------------------------------------------- 
//

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
Enquanto os administradores do site ( {SITE_NAME} ) irão tentar remover 
qualquer conteudo, em geral, indesejável.<br />
<br />
O Webmaster e o Administrador não se responsibilizarão por 
nenhuma acção hacker que possa comprometer os dados.<br />
<br />
Este site usa cookies para armazenar informações no seu computador. Este 
cookies servem apenas para prover maior tecnologia ao site. O seu email é 
usado apenas para confirmar os detalhes do seu registo e a sua senha.<br />
<br />
Clicando em 'Eu Aceito', concorda com todas estas condições.
EOT;

$lang_register_php = array(
	'page_title' => 'REGISTO DE UTILIZADOR',
	'term_cond' => 'Termos e condições',
	'i_agree' => 'Eu Aceito',
	'submit' => 'Enviar Registo',
	'err_user_exists' => 'Este nome de utilizador já existe, por favor tente 
outro',
	'err_password_mismatch' => 'As duas senhas digitadas não são iguais. Digite 
com cuidado novamente',
	'err_uname_short' => 'Nome de utilizador precisa ter no mínimo 2 caracteres',
	'err_password_short' => 'A sua senha tem que ter no mínimo 2 caracteres',
	'err_uname_pass_diff' => 'Nome de utilizador e senha devem ser diferentes',
	'err_invalid_email' => 'Endereço de e-mail inválido',
	'err_duplicate_email' => 'Já existe outro usuário registado com este 
e-mail',
	'enter_info' => 'Entre com as informações de registo',
	'required_info' => 'Informação Obrigatória',
	'optional_info' => 'Informação Opcional',
	'username' => 'Utilizador',
	'password' => 'Senha',
	'password_again' => 'Re-digite a senha',
	'email' => 'E-mail',
	'location' => 'Endereço',
	'interests' => 'Interesses',
	'website' => 'Home page',
	'occupation' => 'Profissão',
	'error' => 'ERRO',
	'confirm_email_subject' => '%s - CONFIRMAÇÃO DE REGISTO',
	'information' => 'Informação',
	'failed_sending_email' => 'O e-mail de confirmação de registo não pôde ser 
enviado !',
	'thank_you' => 'Obrigado por se registrar.<br /><br />As informações para 
finalizar seu registo foram enviadas para seu e-mail.',
	'acct_created' => 'A sua conta foi criada e agora pode validar-se com o seu 
login e a sua senha',
	'acct_active' => 'A sua conta já está activa. Entre com seu login(utilizador) e senha 
para se validar',
	'acct_already_act' => 'A sua conta já está activa !',
	'acct_act_failed' => 'Esta conta ainda não está activa  !',
	'err_unk_user' => 'Utilizador seleccionado não existe !',
	'x_s_profile' => 'Perfil de %s',
	'group' => 'Grupo',
	'reg_date' => 'Participante',
	'disk_usage' => 'Uso do disco',
	'change_pass' => 'Alterar senha',
	'current_pass' => 'Senha actual',
	'new_pass' => 'Nova senha',
	'new_pass_again' => 'Re-digite a nova senha',
	'err_curr_pass' => 'Senha actual INCORRECTA',
	'apply_modif' => 'Gravar modificações',
	'change_pass' => 'Alterar a minha senha',
	'update_success' => 'Os seus dados foram actualizados',
	'pass_chg_success' => 'A sua senha foi alterada',
	'pass_chg_error' => 'A sua senha não foi alterada',
	'notify_admin_email_subject' => '%s - Notificação de Registo', //cpg1.3.0
	'notify_admin_email_body' => 'O utilizador "%s" foi registado na sua 
galeria', //cpg1.3.0
);

$lang_register_confirm_email = <<<EOT
Obrigado por se registar no {SITE_NAME}

O seu login (utilizador) é : "{USER_NAME}"
A sua senha é : "{PASSWORD}"

Para activar a sua conta precisa de aceder ao link em baixo:
Clique ou copie e cole no seu Browser

{ACT_LINK}

Obrigado pelo registo,

Grato,
Administrador
{SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- 
//
// File reviewcom.php
// ------------------------------------------------------------------------- 
//

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => 'Ver Comentários',
	'no_comment' => 'Não há comentários para ver',
	'n_comm_del' => '%s comentário(s) apagados(s)',
	'n_comm_disp' => 'Número de comentários para visualizar',
	'see_prev' => 'Anterior',
	'see_next' => 'Próximo',
	'del_comm' => 'Apagar comentários seleccionados',
);


// ------------------------------------------------------------------------- 
//
// File search.php - OK
// ------------------------------------------------------------------------- 
//

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => 'Pesquisar na galeria de fotos',
);

// ------------------------------------------------------------------------- 
//
// File searchnew.php
// ------------------------------------------------------------------------- 
//

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => 'Pesquisar novas fotos',
	'select_dir' => 'Seleccionar directório',
	'select_dir_msg' => 'Esta função permite-lhe enviar diversas fotos ao mesmo 
tempo.<br /><br />Seleccione o directório das fotos',
	'no_pic_to_add' => 'Não há fotos para adicionar',
	'need_one_album' => 'Precisa ter pelo menos um album para usar esta 
função',
	'warning' => 'CUIDADO',
	'change_perm' => 'O script não pode gravar neste directório que deve possuir 
permissão 755 ou 777 !',
	'target_album' => '<b>Colocar fotos do &quot;</b>%s<b>&quot; em </b>%s',
	'folder' => 'Pasta',
	'image' => 'Foto',
	'album' => 'Album',
	'result' => 'Resultado',
	'dir_ro' => 'Não gravável. ',
	'dir_cant_read' => 'Não pode ser lido. ',
	'insert' => 'Adicionando novas fotos à galeria',
	'list_new_pic' => 'Lista das novas fotos',
	'insert_selected' => 'Inserir fotos selecionadas',
	'no_pic_found' => 'Nenhuma foto nova foi encontrada',
	'be_patient' => 'Por favor tenha paciência. O sistema nescessita de tempo 
para enviar as fotos',
	'notes' =>  '<ul>'.
				'<li><b>OK</b> : Significa que foi enviado com sucesso'.
				'<li><b>DP</b> : Significa que existe uma duplicado na base de dados'.
				'<li><b>PB</b> : Significa que não pôde ser enviado, verifique sua 
configuração e as permissões dos diretórios.'.
				'<li><b>NA</b> : Significa que não seleccionou nenhum album para 
adicionar as fotos, clique em \'<a 
href="javascript:history.back(1)">voltar</a>\' e seleccione um album. Se 
não tem um album <a href="albmgr.php">crie um primeiro</a></li>'.
				'<li>Se um dos \'simbolos\' OK, DP ou PB não aparecerem clique no 
simbolo com problema para receber a mensagem de erro'.
				'<li>Se o tempo expirar, tente novamente actualizando a página'.
				'</ul>', //cpg1.3.0
	'select_album' => 'seleccionar album', //cpg1.3.0
	'check_all' => 'Marcar Tudo', //cpg1.3.0
	'uncheck_all' => 'Desmarcar Tudo', //cpg1.3.0
);


// ------------------------------------------------------------------------- 
//
// File thumbnails.php
// ------------------------------------------------------------------------- 
//

// Void

// ------------------------------------------------------------------------- 
//
// File banning.php
// ------------------------------------------------------------------------- 
//

if (defined('BANNING_PHP')) $lang_banning_php = array(
	'title' => 'Banir Utilizadores',
	'user_name' => 'Nome do utilizadores',
	'ip_address' => 'IP',
	'expiry' => 'Expira em (em branco significa que é permanente)',
	'edit_ban' => 'Gravar Alterações',
	'delete_ban' => 'Apagar',
	'add_new' => 'Adicionar novo Ban',
	'add_ban' => 'Adicionar',
	'error_user' => 'Não foi possível encontrar o utilizador', //cpg1.3.0
	'error_specify' => 'Precisa especificar um utilizador ou IP', //cpg1.3.0
	'error_ban_id' => 'ID de ban inválido!', //cpg1.3.0
	'error_admin_ban' => 'Não se pode banir!', //cpg1.3.0
	'error_server_ban' => 'Vai banir o seu próprio servidor? Não pode 
fazer isso...', //cpg1.3.0
	'error_ip_forbidden' => 'Não pode banir este IP - este não é 
roteavel!', //cpg1.3.0
	'lookup_ip' => 'Olhe um IP acima', //cpg1.3.0
	'submit' => 'Enviar!', //cpg1.3.0
);

// ------------------------------------------------------------------------- 
//
// File upload.php
// ------------------------------------------------------------------------- 
//

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
  'title' => 'Envio de Foto', //cpg1.3.0
  'custom_title' => 'Formulário de Pedidos personalizável', //cpg1.3.0
  'cust_instr_1' => 'Deve selecionar um número personalizável de caixas 
de envio. Entretando não pode seleccionar mais do que os limites aplicados 
em baixo.', //cpg1.3.0
  'cust_instr_2' => 'Número de Caixas de Pedidos', //cpg1.3.0
  'cust_instr_3' => 'Caixas de envio de ficheiro: %s', //cpg1.3.0
  'cust_instr_4' => 'Caixas de envio de URI/URL: %s', //cpg1.3.0
  'cust_instr_5' => 'Caixas de envio de URI/URL:', //cpg1.3.0
  'cust_instr_6' => 'Caixas de envio de ficheiro:', //cpg1.3.0
  'cust_instr_7' => 'Por favor insira o numero de cada tipo de caixa de 
envio que deseja desta vez e clique em \'Continuar\'. ', //cpg1.3.0
  'reg_instr_1' => 'Acção inválida para o formulário de criação.', //cpg1.3.0
  'reg_instr_2' => 'Agora deve enviar seus ficheiros usando as caixas de 
envio em baixo. Os arquivos a serem enviados para o servidor não podem exceder 
o tamanho de %s KB cada. Ficheiros ZIP enviados pela secção de \'Envio de 
Ficheiro\' e \'Envio de URI/URL\' irão permanecer compactados.', //cpg1.3.0
  'reg_instr_3' => 'Se quiser o ficheiro zipado ou que o ficheiro seja 
descompactado, deve usar a caixa de envio especial para isto, area 
\'Envio de ZIP com descompactação\'.', //cpg1.3.0
  'reg_instr_4' => 'Quando usar a sceção de envio URI/URL, por favor insira o 
caminho para o arquivo. Ex: http://www.oseusitio.pt/imagens/foto.jpg', 
//cpg1.3.0
  'reg_instr_5' => 'Quando terminar de completar o formulário, por 
favor clique em \'Continuar\'.', //cpg1.3.0
  'reg_instr_6' => 'Envio de ZIP com descompactação:', //cpg1.3.0
  'reg_instr_7' => 'Envio de ficheiros:', //cpg1.3.0
  'reg_instr_8' => 'Envio de URI/URL:', //cpg1.3.0
  'error_report' => 'Relatório de Erro', //cpg1.3.0
  'error_instr' => 'Ocorreram erros nos seguintes envios:', //cpg1.3.0
  'file_name_url' => 'Arquivo/URL', //cpg1.3.0
  'error_message' => 'Mensagem de Erro', //cpg1.3.0
  'no_post' => 'Nenhum ficheiro selecionado.', //cpg1.3.0
  'forb_ext' => 'Extensão de arquivo proibida.', //cpg1.3.0
  'exc_php_ini' => 'Tamanho de ficheiro excedido permitido pelo php.ini.', 
//cpg1.3.0
  'exc_file_size' => 'Tamanho de ficheiro excedido permitido pela galeria.', 
//cpg1.3.0
  'partial_upload' => 'Apenas envio parcial.', //cpg1.3.0
  'no_upload' => 'Nenhum envio ocorrido.', //cpg1.3.0
  'unknown_code' => 'Codigo de erro PHP de envio, inválido.', //cpg1.3.0
  'no_temp_name' => 'Nenhum envio - Nenhum nome temporário.', //cpg1.3.0
  'no_file_size' => 'Esta em branco/Corrompido', //cpg1.3.0
  'impossible' => 'Impossivel mover.', //cpg1.3.0
  'not_image' => 'Não é uma imagem/corrompido', //cpg1.3.0
  'not_GD' => 'Não é uma extensão GD.', //cpg1.3.0
  'pixel_allowance' => 'Tamanho de pixel excedido.', //cpg1.3.0
  'incorrect_prefix' => 'Prefixo de URI/URL incorreto', //cpg1.3.0
  'could_not_open_URI' => 'Não foi possivel abrir a URI.', //cpg1.3.0
  'unsafe_URI' => 'Segurança não verificável.', //cpg1.3.0
  'meta_data_failure' => 'Falha da Meta data', //cpg1.3.0
  'http_401' => '401 Unauthorized', //cpg1.3.0
  'http_402' => '402 Payment Required', //cpg1.3.0
  'http_403' => '403 Forbidden', //cpg1.3.0
  'http_404' => '404 Not Found', //cpg1.3.0
  'http_500' => '500 Internal Server Error', //cpg1.3.0
  'http_503' => '503 Service Unavailable', //cpg1.3.0
  'MIME_extraction_failure' => 'MIME não pode ser determinado.', //cpg1.3.0
  'MIME_type_unknown' => 'Tipo de MIME inválido', //cpg1.3.0
  'cant_create_write' => 'Não foi possivel criar um ficheiro gravável.', 
//cpg1.3.0
  'not_writable' => 'Não foi possivel gravar num ficheiro gravável.', 
//cpg1.3.0
  'cant_read_URI' => 'Não foi possivel ler a URI/URL', //cpg1.3.0
  'cant_open_write_file' => 'Não foi possivel abrir o arquivo URI 
gravavel.', //cpg1.3.0
  'cant_write_write_file' => 'Não foi possivel gravar no ficheiro URI 
gravável.', //cpg1.3.0
  'cant_unzip' => 'Não foi possivel deszipar.', //cpg1.3.0
  'unknown' => 'Erro inválido', //cpg1.3.0
  'succ' => 'Envio realizado com sucesso', //cpg1.3.0
  'success' => '%s envios com sucesso.', //cpg1.3.0
  'add' => 'Por favor clique em \'Continuar\' para adicionar os arquivos nos 
albuns.', //cpg1.3.0
  'failure' => 'Falha de envio', //cpg1.3.0
  'f_info' => 'Informação do Ficheiro', //cpg1.3.0
  'no_place' => 'O ficheiro anterior não pode ser inserido.', //cpg1.3.0
  'yes_place' => 'O ficheiro anterior foi inserido com sucesso.', //cpg1.3.0
  'max_fsize' => 'O tamanho máximo permitido de arquivo é %s KB',
  'album' => 'Album',
  'picture' => 'Foto', //cpg1.3.0
  'pic_title' => 'Título da Foto', //cpg1.3.0
  'description' => 'Descrição da Foto', //cpg1.3.0
  'keywords' => 'Palavras-Chave (separado com espaços)',
  'err_no_alb_uploadables' => 'Desculpe, não esta autorizado a enviar 
ficheiros para nenhum album', //cpg1.3.0
  'place_instr_1' => 'Por favor insira os ficheiros no album agora. Deve 
também inserir informações sobre cada ficheiro agora.', //cpg1.3.0
  'place_instr_2' => 'Mais ficheiros precisam ser colocados. Por favor clique 
em \'Continuar\'.', //cpg1.3.0
  'process_complete' => 'Inseriu com sucesso todos os ficheiros.', 
//cpg1.3.0
);

// ------------------------------------------------------------------------- 
//
// File usermgr.php
// ------------------------------------------------------------------------- 
//

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => 'Gestor de Utilizadoress',
	'name_a' => 'Nome Ascendente',
	'name_d' => 'Nome Descendente',
	'group_a' => 'Grupo Ascendente',
	'group_d' => 'Grupo Descendente',
	'reg_a' => 'Data de registro Ascendente',
	'reg_d' => 'Data de registro Descendente',
	'pic_a' => 'Contagem de fotos ascendente',
	'pic_d' => 'Constagem de foto descendente',
	'disku_a' => 'Uso de disco ascendente',
	'disku_d' => 'Uso de disco descendente',
	'lv_a' => 'Última visita Ascendente', //cpg1.3.0
	'lv_d' => 'Última visita Descendente', //cpg1.3.0
	'sort_by' => 'Listar utilizadores por',
	'err_no_users' => 'A Tabela de utilizadores está vazia !',
	'err_edit_self' => 'Não pode alterar seu dados \'pessoais\', use o 
link \'Os meus dados\' para isso ',
	'edit' => 'EDITAR',
	'delete' => 'APAGAR',
	'name' => 'Utilizador',
	'group' => 'Grupo',
	'inactive' => 'Inactivo',
	'operations' => 'Operações',
	'pictures' => 'Fotos',
	'disk_space' => 'Espaço usado / Quota',
	'registered_on' => 'Registado em',
	'last_visit' => 'Última Visita', //cpg1.3.0
	'u_user_on_p_pages' => '%d utilizador(es) em %d página(s)',
	'confirm_del' => 'Tem certeza que quer APAGAR este utilizador ? \\nTodas as 
fotos e albuns dele serão removidos.',
	'mail' => 'EMAIL',
	'err_unknown_user' => 'Utilizador seleccionado não existe !',
	'modify_user' => 'Modificar utilizador',
	'notes' => 'Notas',
	'note_list' => '<li>Se não quer alterar sua senha, deixe o campo em 
branco',
	'password' => 'Senha',
	'user_active' => 'Utilizador activo',
	'user_group' => 'Grupo de utilizador',
	'user_email' => 'Email do Utilizador',
	'user_web_site' => 'Site do Utilizador',
	'create_new_user' => 'Criar novo utilizador',
	'user_location' => 'Endereço',
	'user_interests' => 'Interesses',
	'user_occupation' => 'Ocupação',
	'latest_upload' => 'Envios Recentes', //cpg1.3.0
	'never' => 'nunca', //cpg1.3.0
);

// ------------------------------------------------------------------------- 
//
// File util.php
// ------------------------------------------------------------------------- 
//

if (defined('UTIL_PHP')) $lang_util_php = array(
  'title' => 'Utilitarios para o Admin (Redimensionar)', //cpg1.3.0
  'what_it_does' => 'O que este utilitário pode fazer:',
  'what_update_titles' => 'Actualizar titulos do ficheiro',
  'what_delete_title' => 'Apagar títulos',
  'what_rebuild' => 'Refazer miniaturas e redimensionar fotos',
  'what_delete_originals' => 'Substituir foto por uma redimensionada',
  'file' => 'Ficheiro',
  'title_set_to' => 'título mudado para',
  'submit_form' => 'enviar',
  'updated_succesfully' => 'actualizado com sucesso',
  'error_create' => 'ERRO ao criar',
  'continue' => 'Processar mais imagens',
  'main_success' => 'O ficheiro %s foi como arquivo principal', //cpg1.3.0
  'error_rename' => 'Erro ao renomear %s para %s',
  'error_not_found' => 'O ficheiro %s não foi encontrado',
  'back' => 'voltar para página principal',
  'thumbs_wait' => 'Actualizando miniaturas e/ou imagens redimensionadas, por 
favor aguarde...',
  'thumbs_continue_wait' => 'Continuando a actualizar miniaturas e/ou imagens 
redimensionadas...',
  'titles_wait' => 'Actualizando titulos, por favor aguarde...',
  'delete_wait' => 'Apagando titulos, por favor aguarde...',
  'replace_wait' => 'Apagando originais e repondo-as com as imagens 
redimensionadas, por favor aguarde..',
  'instruction' => 'Instruções rápidas',
  'instruction_action' => 'Seleccione a acção',
  'instruction_parameter' => 'Ajuste os parâmentos',
  'instruction_album' => 'Seleccione o Album',
  'instruction_press' => 'Pressione %s',
  'update' => 'Actualizar miniaturas e/ou redimensionar fotos',
  'update_what' => 'O que deve ser actualizado',
  'update_thumb' => 'Apenas miniaturas',
  'update_pic' => 'Apenas imagens redimensionadas',
  'update_both' => 'Miniaturas e Imagens redimensionadas',
  'update_number' => 'Número de imagens processadas por clique',
  'update_option' => '(Tente um numero menor caso esteja tendo 
problemas com timeout)',
  'filename_title' => 'Ficheiro &rArr; Titulo do ficheiro', //cpg1.3.0
  'filename_how' => 'Como o ficheiro deve ser modificado',
  'filename_remove' => 'Remover o .jpg no final e colocar _ (underline) com 
espaços',
  'filename_euro' => 'Alterar 2003_11_23_13_20_20.jpg para 23/11/2003 
13:20',
  'filename_us' => 'Alterar 2003_11_23_13_20_20.jpg para 11/23/2003 13:20',
  'filename_time' => 'Alterar 2003_11_23_13_20_20.jpg para 13:20',
  'delete' => 'Apagar titulo de arquivos ou tamanhos originais de fotos', 
//cpg1.3.0
  'delete_title' => 'Apagar titulo de ficheiros', //cpg1.3.0
  'delete_original' => 'Apagar tamanho original de fotos',
  'delete_replace' => 'Apaga as imagens originais repondo-as com a versão 
redimensionada',
  'select_album' => 'Seleccione o album',
  'delete_orphans' => 'Apagar comentários orphaned (funciona em todos os 
albums)', //cpg1.3.0
  'orphan_comment' => 'Comentário orphan encontrados', //cpg1.3.0
  'delete' => 'Apagar', //cpg1.3.0
  'delete_all' => 'Apagar todos', //cpg1.3.0
  'comment' => 'Comentário: ', //cpg1.3.0
  'nonexist' => 'atached num arquivo que não existe # ', //cpg1.3.0
  'phpinfo' => 'Mostrar phpinfo', //cpg1.3.0
  'update_db' => 'Actualizar banco de dados', //cpg1.3.0
  'update_db_explanation' => 'Se substituiu arquivos da galeria, 
adicionou uma modificação ou actualizou de uma versão anterior da galeria, 
tenha certeza de ter rodado a actualização de banco de dados uma vez. Isto 
irá criar as tabelas necessárias e/ou valores de configuração no seu banco 
de dados.', //cpg1.3.0
);

?>