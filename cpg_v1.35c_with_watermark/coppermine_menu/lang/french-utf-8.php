<?php
// ------------------------------------------------------------------------- //
//  Coppermine Photo Gallery                                                 //
// ------------------------------------------------------------------------- //
//  Copyright (C) 2002,2003  Gregory DEMAR <gdemar@wanadoo.fr>               //
//  http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
//  Based on PHPhotoalbum by Henning Stoverud <henning@stoverud.com>         //
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
'lang_name_english' => 'French',  //the name of your language in English, e.g. 'Greek' or 'Spanish'
'lang_name_native' => 'Français', //the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol'
'lang_country_code' => 'fr', //the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
'trans_name'=> 'mels', //the name of the translator - can be a nickname
'trans_email' => 'mels@wanadoo.fr', //translator's email address (optional)
'trans_website' => 'http://www.everlasting-star.net/', //translator's website (optional)
'trans_date' => '2003-10-15', //the date the translation was created / last modified
);

$lang_charset = 'ISO-8859-1';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Octets', 'Ko', 'Mo');

// Day of weeks and months
$lang_day_of_week = array('Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam');
$lang_month = array('Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Aout', 'Sep', 'Oct', 'Nov', 'Dec');

// Some common strings
$lang_yes = 'Oui';
$lang_no  = 'Non';
$lang_back = 'Retour';
$lang_continue = 'CONTINUER';
$lang_info = 'Information';
$lang_error = 'Erreur';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%B %d, %Y';
$lastcom_date_fmt =  '%m/%d/%y à %H:%M';
$lastup_date_fmt = '%B %d, %Y';
$register_date_fmt = '%B %d, %Y';
$lasthit_date_fmt = '%B %d, %Y à %I:%M %p';
$comment_date_fmt =  '%B %d, %Y à %I:%M %p';

// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*', 'merde', 'putain', 'enculé*', 'salope', 'bite', 'cul', 'pute', 'pénis', 'clito', 'couille', 'pétasse', 'connard', 'salaud');

$lang_meta_album_names = array(
        'random' => 'Images au hasard',
        'lastup' => 'Derniers ajouts',
        'lastalb'=> 'Derniers albums mis en ligne', //new in cpg1.2.0
        'lastcom' => 'Derniers commentaires',
        'topn' => 'Les plus populaires',
        'toprated' => 'Les mieux notées',
        'lasthits' => 'Les dernières vues',
        'search' => 'Résultats de la recherche', //new in cpg1.2.0
        'favpics'=> 'Photos préférées' //new in cpg1.2.0
);

$lang_errors = array(
        'access_denied' => 'Vous n\'avez pas la permission d\'accéder à cette page.',
        'perm_denied' => 'Vous n\'avez pas la permission d\'effectuer cette opération.',
        'param_missing' => 'Script appelé sans les paramètres nécessaires.',
        'non_exist_ap' => 'L\'album/la photo demandé(e) n\'existe pas !',
        'quota_exceeded' => 'Espace disque dépassé<br /><br />Vous avez un quota d\'espace de [quota]K, vos photos utilisent [space]K, le fait d\'ajouter cette photo vous ferait dépasser votre quota.',
        'gd_file_type_err' => 'L\'utilisation de "GD image library" ne vous permet d\'utiliser que de images de type JPEG et PNG.',
        'invalid_image' => 'L\'image que vous avez uploadée est corrompue ou ne peut pas être prise en charge par GD library',
        'resize_failed' => 'Impossible de créer l\'vignette ou l\'image réduite.',
        'no_img_to_display' => 'Pas d\'image à afficher',
        'non_exist_cat' => 'La catégorie sélectionnée n\'existe pas',
        'orphan_cat' => 'Une catégorie a un parent inexistant, utilisez le gestionnaire de catégories afin de remédier au problème.',
        'directory_ro' => 'Le réperetoire \'%s\' n\'est pas inscriptible : les images ne peuvent être supprimées.',
        'non_exist_comment' => 'Le commentaire sélectionné n\'existe pas.',
        'pic_in_invalid_album' => 'L\'image se trouve dans un album qui n\'existe pas (%s)!?', //new in cpg1.2.0
        'banned' => 'Vous êtes pour l\'instant banni de ce site.', //new in cpg1.2.0
        'not_with_udb' => 'TCette fonction est désactivée dans Coppermine parce que la gallerie est intégrée à un forum. Soit l\'action que vous essayez d\'effectuer n\'est pas disponible dans cette configuration, soit vous devez l\'effectuer à partir du forum auquel vous avez intégré la galerie.', //new in cpg1.2.0
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
        'alb_list_title' => 'Aller à la liste des albums',
        'alb_list_lnk' => 'Liste des albums',
        'my_gal_title' => 'Aller dans ma galerie personnelle',
        'my_gal_lnk' => 'Ma galerie',
        'my_prof_lnk' => 'Mon profil',
        'adm_mode_title' => 'Passer en mode admin',
        'adm_mode_lnk' => 'Mode admin',
        'usr_mode_title' => 'Passer au mode utilisateur',
        'usr_mode_lnk' => 'Mode utilisateur',
        'upload_pic_title' => 'Uploader une image dans un album',
        'upload_pic_lnk' => 'Uploader une image',
        'register_title' => 'Créer un compte',
        'register_lnk' => 'Inscription',
        'login_lnk' => 'S\'identifier',
        'logout_lnk' => 'Quitter',
        'lastup_lnk' => 'Derniers ajouts',
        'lastcom_lnk' => 'Derniers commentaires',
        'topn_lnk' => 'Images les plus populaires',
        'toprated_lnk' => 'Images les mieux notées',
        'search_lnk' => 'Rechercher',
        'fav_lnk' => 'Mes favoris', //new in cpg1.2.0

);

$lang_gallery_admin_menu = array(
        'upl_app_lnk' => 'Fichiers en attente',
        'config_lnk' => 'Configuration',
        'albums_lnk' => 'Albums',
        'categories_lnk' => 'Categories',
        'users_lnk' => 'Utilisateurs',
        'groups_lnk' => 'Groupes',
        'comments_lnk' => 'Commentaires',
        'searchnew_lnk' => 'FTP =>',
        'util_lnk' => 'Redimensionner les images', //new in cpg1.2.0
        'ban_lnk' => 'Bannir des utilisateurs', //new in cpg1.2.0
);

$lang_user_admin_menu = array(
        'albmgr_lnk' => 'Créer / classer mes albums',
        'modifyalb_lnk' => 'Modifier mes albums',
        'my_prof_lnk' => 'Mon profil',
);

$lang_cat_list = array(
        'category' => 'Catégorie',
        'albums' => 'Albums',
        'pictures' => 'Photos',
);

$lang_album_list = array(
        'album_on_page' => '%d albums sur %d page(s)'
);

$lang_thumb_view = array(
        'date' => 'DATE',
        //Sort by filename and title
        'name' => 'NOM DU FICHIER', //new in cpg1.2.0
        'title' => 'TITRE', //new in cpg1.2.0
        'sort_da' => 'Classer par date ascendantes',
        'sort_dd' => 'Classer par date descendantes',
        'sort_na' => 'Classer par nom ascendants',
        'sort_nd' => 'Classer par nom descendants',
        'sort_ta' => 'Classer par titre ascendants', //new in cpg1.2.0
        'sort_td' => 'Classer par titre descendants', //new in cpg1.2.0
        'pic_on_page' => '%d photos sur %d page(s)',
        'user_on_page' => '%d utilisateurs sur %d page(s)'
);

$lang_img_nav_bar = array(
        'thumb_title' => 'Retourner à la page des vignettes',
        'pic_info_title' => 'Afficher / cacher les informations sur l\'image',
        'slideshow_title' => 'Diaporama',
        'ecard_title' => 'Envoyer cette image en tant que carte électronique',
        'ecard_disabled' => 'les cartes électroniques sont désactivées',
        'ecard_disabled_msg' => 'Vous n\'avez pas l\'autorisation d\'envoyer des cartes',
        'prev_title' => 'Voir l\'image précédente',
        'next_title' => 'Voir l\'image suivante',
        'pic_pos' => 'PHOTO %s/%s',
);

$lang_rate_pic = array(
        'rate_this_pic' => 'Noter cette image ',
        'no_votes' => '(Pas encore de vote)',
        'rating' => '(note actuelle : %s / 5 pour %s votes)',
        'rubbish' => 'Très mauvais',
        'poor' => 'Pauvre',
        'fair' => 'Moyen',
        'good' => 'Bon',
        'excellent' => 'Excellent',
        'great' => 'Superbe',
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
        CRITICAL_ERROR => 'Erreur critique',
        'file' => 'Fichier: ',
        'line' => 'Ligne: ',
);

$lang_display_thumbnails = array(
        'filename' => 'Nom du fichier : ',
        'filesize' => 'Poids du fichier : ',
        'dimensions' => 'Dimensions : ',
        'date_added' => 'Ajouté le : '
);

$lang_get_pic_data = array(
        'n_comments' => '%s commentaires',
        'n_views' => '%s téléchargements',
        'n_votes' => '(%s votes)'
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
        'Very Happy' => 'Très heureux',
        'Smile' => 'Sourire',
        'Sad' => 'Triste',
        'Surprised' => 'Surpris',
        'Shocked' => 'Choqué',
        'Confused' => 'Confus',
        'Cool' => 'Cool',
        'Laughing' => 'Rire',
        'Mad' => 'Fou',
        'Razz' => 'Razz',
        'Embarassed' => 'Embarassé',
        'Crying or Very sad' => 'Pleure ou très triste',
        'Evil or Very Mad' => 'Diabolique ou très en colère',
        'Twisted Evil' => 'Sadique',
        'Rolling Eyes' => 'Lève les yeux au ciel',
        'Wink' => 'Clin d\'oeil',
        'Idea' => 'Idée',
        'Arrow' => 'Flèche',
        'Neutral' => 'Neutre',
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
        0 => 'Déconnexion du mode administrateur...',
        1 => 'Passage au mode administrateur...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
        'alb_need_name' => 'Les albums doivent avoir un nom !',
        'confirm_modifs' => 'Voulez-vous vraiment effectuer ces modifications ?',
        'no_change' => 'Vous n\'avez effectué aucun changement !',
        'new_album' => 'Nouvel album',
        'confirm_delete1' => 'Voulez vous vraiment supprimer cet album ?',
        'confirm_delete2' => '\nToutes les images et tous les commentaires seront perdus !',
        'select_first' => 'Selectionnez d\'abord un album',
        'alb_mrg' => 'Gestionnaire d\'album',
        'my_gallery' => '* Ma galerie *',
        'no_category' => '* Pas de catégorie *',
        'delete' => 'Supprimer',
        'new' => 'Nouveau',
        'apply_modifs' => 'Appliquer les modifications',
        'select_category' => 'Sélectionner une categorie',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
        'miss_param' => 'Les paramètres requis pour l\'\'%s\'operation sont manquants !',
        'unknown_cat' => 'La catégorie sélectionnée n\'existe pas dans la base de données',
        'usergal_cat_ro' => 'La galerie des utilisateurs ne peut pas être supprimée!',
        'manage_cat' => 'Gérer les catégories',
        'confirm_delete' => 'Voulez vous vraiment SUPPRIMER cette catégorie ?',
        'category' => 'Categorie',
        'operations' => 'Opérations',
        'move_into' => 'Déplacer dans',
        'update_create' => 'Mettre à jour / créer la catégorie',
        'parent_cat' => 'Catégorie parente',
        'cat_title' => 'Titre de la catégorie',
        'cat_desc' => 'Description de la catégorie'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
        'title' => 'Configuration',
        'restore_cfg' => 'Restorer les paramètres d\'origine',
        'save_cfg' => 'Sauvergarder la nouvelle configuration',
        'notes' => 'Notes',
        'info' => 'Information',
        'upd_success' => 'La configuration de Coppermine a été mise à jour',
        'restore_success' => 'La configuration d\'origine de Coppermine a été restaurée',
        'name_a' => 'Nom ascendant',
        'name_d' => 'Nom descendant',
        'title_a' => 'Titre ascendand', //new in cpg1.2.0
        'title_d' => 'Titre descendant', //new in cpg1.2.0
        'date_a' => 'Date ascendante',
        'date_d' => 'Date descendante',
        'th_any' => 'Max Aspect',
        'th_ht' => 'Height',
        'th_wd' => 'Width',
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
        'Paramètres généraux',
        array('Nom de la galerie', 'gallery_name', 0),
        array('Description de la galerie', 'gallery_description', 0),
        array('Email de l\'administrateur de la galerie', 'gallery_admin_email', 0),
        array('Adresse sur laquelle le lien \'Voir plus de photos\' des e-cards doit pointer', 'ecards_more_pic_target', 0),
        array('Langage', 'lang', 5),
        array('Thème', 'theme', 6),

        'Affichage de la liste des albums',
        array('Largeur du tableau principal (pixels ou %)', 'main_table_width', 0),
        array('Nombre de niveaux de catégories à afficher', 'subcat_level', 0),
        array('Nombre d\'albums à afficher', 'albums_per_page', 0),
        array('Nombre de colonnes pour la liste des albums', 'album_list_cols', 0),
        array('Taille des vignettes en pixels', 'alb_list_thumb_size', 0),
        array('Le contenu de la page principale', 'main_page_layout', 0),
        array('Afficher les vignettes de l\'album du premier niveau avec la catégorie','first_level',1), //new in cpg1.2.0

        'Affichage des vignettes',
        array('Nombre de colonnes sur la page des vignettes', 'thumbcols', 0),
        array('Nombre de lignes sur la page des vignettes', 'thumbrows', 0),
        array('Nombre maximal d\'onglets à afficher', 'max_tabs', 0),
        array('Afficher la légende de l\'image (en plus de son titre) sous la vignette', 'caption_in_thumbview', 1),
        array('Afficher le nombre de commentaires sous les vignettes', 'display_comment_count', 1),
        array('Classement par défaut des images', 'default_sort_order', 3),
        array('Nombre minimum de votes nécessaires pour qu\'une image apparaisse dans la liste des images les mieux notées', 'min_votes_for_rating', 0),

        'Affichage des images &amp; paramètres des commentaires',
        array('Largeur du tableau pour l\'affichage des images (pixels ou %)', 'picture_table_width', 0),
        array('Les informations relatives à l\'image sont affichées par défaut', 'display_pic_info', 1),
        array('Filtrer les gros mots dans les commentaires', 'filter_bad_words', 1),
        array('Autoriser les smileys dans les commentaires', 'enable_smilies', 1),
        array('Longueur maximale pour la description des images', 'max_img_desc_length', 0),
        array('Nombre maximal de lettres pour un mot', 'max_com_wlength', 0),
        array('Nombre maximal de lignes pour un commentaire', 'max_com_lines', 0),
        array('Longueur maximale d\'un commentaire', 'max_com_size', 0),
        array('Afficher le négatif', 'display_film_strip', 1), //new in cpg1.2.0
        array('Nombre d\'images par négatif', 'max_film_strip_items', 0), //new in cpg1.2.0

        'Paramètres des images et vignettes',
        array('Qualité pour les fichiers JPG', 'jpeg_qual', 0),
        array('Dimension maximale pour les vignettes <b>*</b>', 'thumb_width', 0), //new in cpg1.2.0
        array('Utiliser la dimension ( largeur ou hauteur ou aspect max pour la vignette)<b>*</b>', 'thumb_use', 7), //new in cpg1.2.0
        array('Créer des images intermédiaires','make_intermediate',1),
        array('Largeur ou hauteur maximale pour une image intermédiaire <b>*</b>', 'picture_width', 0),
        array('Poids max des images à uploader (Ko)', 'max_upl_size', 0),
        array('Longueur ou hauteur maximale pour les images uploadées (en pixels)', 'max_upl_width_height', 0),

        'Paramètres Utilisateurs',
        array('Autoriser de nouvelles inscriptions', 'allow_user_registration', 1),
        array('L\'inscription d\'un nouvel utilisateur doit être validée', 'reg_requires_valid_email', 1),
        array('Autoriser deux utilisateurs à avoir le même e-mail', 'allow_duplicate_emails_addr', 1),
        array('Les utilisateurs peuvent avoir un album personnel', 'allow_private_albums', 1),

        'Champs libres pour les descriptions d\'images (à laisser tel quel si vous n\'utilisez pas cette fonction)',
        array('Nom du champ 1', 'user_field1_name', 0),
        array('Nom du champ 2', 'user_field2_name', 0),
        array('Nom du champ 3', 'user_field3_name', 0),
        array('Nom du champ 4', 'user_field4_name', 0),

        'Paramètres avancés des images et vignettes',
        array('Afficher l\'icône des albums privés aux utilisateurs non indentifiés','show_private',1), //new in cpg1.2.0
        array('Caratères interdits dans les noms de fichiers', 'forbiden_fname_char',0),
        array('Extensions de fichiers acceptées pour les images à uploader', 'allowed_file_extensions',0),
        array('Méthode utilisée pour redimensionner les images','thumb_method',2),
        array('Chemin vers l\'utilitaire de conversion ImageMagick (exemple : /usr/bin/X11/)', 'impath', 0),
        array('Type d\'images autorisées (valide seulement pour ImageMagick)', 'allowed_img_types',0),
        array('Options de ligne de commande pour ImageMagick', 'im_options', 0),
        array('Lire les informations EXIF dans les fichiers JPEG', 'read_exif_data', 1),
        array('Répertoire de stockage de l\'album <b>*</b>', 'fullpath', 0),
        array('Répertoire pour les images des utilisateurs <b>*</b>', 'userpics', 0),
        array('Préfixe des images intermédiares <b>*</b>', 'normal_pfx', 0),
        array('Préfixe pour les vignettes <b>*</b>', 'thumb_pfx', 0),
        array('Mode par défaut des répertoires', 'default_dir_mode', 0),
        array('Mode par défaut des images', 'default_file_mode', 0),

        'Cookies &amp; paramètres d\'encodage des caractères',
        array('Nom du cookie utilisé par le script', 'cookie_name', 0),
        array('Chemin du cookie utilisé par le script', 'cookie_path', 0),
        array('Encodage des caractères', 'charset', 4),

				'Divers',
				array('Activer le mode debug', 'debug_mode', 1),
	
	'<br /><div align="center">(*) Les champs marqués d\'un * ne doivent pas être modifiés si des images existent déjà !</div><br />'
);
// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
        'empty_name_or_com' => 'Vous devez taper votre nom et un commentaire',
        'com_added' => 'Votre commentaire a été ajouté',
        'alb_need_title' => 'Vous devez donner un titre à l\'album !',
        'no_udp_needed' => 'Aucune mise à jour n\'est nécessaire.',
        'alb_updated' => 'L\'album a été mis à jour',
        'unknown_album' => 'L\'album sélectionné n\'existe pas ou bien vous n\'avez pas la permission d\'uploader dans cet album',
        'no_pic_uploaded' => 'Aucune image n\'a été uploadée !<br /><br />Si vous avez vraiment sélectionné une image à uploader, vérifier que le serveur autorise l\'upload de fichiers...',
        'err_mkdir' => 'Impossible de créer le répertoire %s !',
        'dest_dir_ro' => 'Le répertoire de destination (%s) ne dispose pas des droits d\'écriture nécessaires pour le script!',
        'err_move' => 'Impossible de déplacer %s vers %s !',
        'err_fsize_too_large' => 'La taille de l\'image que vous avez uploadé est trop grande (le maximum autorisé est de %s x %s) !',
        'err_imgsize_too_large' => 'Le poids du fichier que vous avez uploadé est trop important (le maximum autorisé est de %s Ko) !',
        'err_invalid_img' => 'Le fichier que vous avez uploadé n\'est pas une image valide!',
        'allowed_img_types' => 'Vous ne pouvez uploader que %s images.',
        'err_insert_pic' => 'Les images \'%s\' ne peuvent pas être insérées dans l\'album ',
        'upload_success' => 'Votre image a été correctement uploadée<br /><br />Elle sera visible après validation de l\'administrateur.',
        'info' => 'Information',
        'com_added' => 'Commentaire ajouté',
        'alb_updated' => 'Album mis à jour',
        'err_comment_empty' => 'Votre commentaire est vide!',
        'err_invalid_fext' => 'Seuls les fichiers avec les extensions suivantes sont autorisés : <br /><br />%s.',
        'no_flood' => 'Nous sommes désolés, mais vous êtes déjà l\'auteur du dernier commentaire posté au sujet de cette image.<br /><br />Vous pouvez tout simplement éditer votre message précédent si vous souhaitez le modifier ou bien ajouter des informations.',
        'redirect_msg' => 'Redirection en cours.<br /><br /><br />Cliquez sur \'CONTINUER\' si la page ne se recharge pas automatiquement',
        'upl_success' => 'Votre image a été correctement ajoutée',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
        'caption' => 'Légende',
        'fs_pic' => 'image en taille réelle',
        'del_success' => 'suppression réussie',
        'ns_pic' => 'image en taille normale',
        'err_del' => 'ne peut pas être supprimé',
        'thumb_pic' => 'vignette',
        'comment' => 'commentaire',
        'im_in_alb' => 'image dans l\'album',
        'alb_del_success' => 'Album \'%s\' supprimés',
        'alb_mgr' => 'Gestionnaire d\'album',
        'err_invalid_data' => 'Données non valides reçues dans \'%s\'',
        'create_alb' => 'Création de l\'album \'%s\'',
        'update_alb' => 'Mise à jour de l\'album \'%s\' avec le titre \'%s\' et index \'%s\'',
        'del_pic' => 'Supprimer l\'image',
        'del_alb' => 'Supprimer l\'album',
        'del_user' => 'Supprimer l\'utilisateur',
        'err_unknown_user' => 'L\'utilisateur sélectionné n\'existe pas !',
        'comment_deleted' => 'Le commentaire a été supprimé avec succès',
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
        'confirm_del' => 'Voulez vous vraiment SUPPRIMER cette image?\\nLes commentaires seront également supprimés.',
        'del_pic' => 'SUPPRIMER CETTE IMAGE',
        'size' => '%s x %s pixels',
        'views' => '%s fois',
        'slideshow' => 'Diaporama',
        'stop_slideshow' => 'ARRETER LE DIAPORAMA',
        'view_fs' => 'Cliquez pour voir l\'image en taille réelle',
);

$lang_picinfo = array(
        'title' =>'Informations sur l\'image',
        'Filename' => 'Nom du fichier',
        'Album name' => 'Nom de l\'album',
        'Rating' => 'Note (%s votes)',
        'Keywords' => 'Mots clefs',
        'File Size' => 'Taille du fichier',
        'Dimensions' => 'Dimensions',
        'Displayed' => 'Affichées',
        'Camera' => 'Appareil photos',
        'Date taken' => 'Date de la prise de vue',
        'Aperture' => 'Ouverture',
        'Exposure time' => 'Temps d\'exposition',
        'Focal length' => 'Focale',
        'Comment' => 'Commentaires',
        'addFav'=>'Ajouter aux favoris', //new in cpg1.2.0
        'addFavPhrase'=>'Favoris', //new in cpg1.2.0
        'remFav'=>'Supprimer des favoris', //new in cpg1.2.0
);

$lang_display_comments = array(
        'OK' => 'OK',
        'edit_title' => 'Modifier ce commentaire',
        'confirm_delete' => 'Voulez vous vraiment supprimer ce commentaire?',
        'add_your_comment' => 'Ajoutez votre commentaire',
        'name'=>'Nom', //new in cpg1.2.0
        'comment'=>'Commentaire', //new in cpg1.2.0
        'your_name' => 'Anonyme', //new in cpg1.2.0
);

$lang_fullsize_popup = array(
        'click_to_close' => 'Cliquez sur l\'image pour fermer la fenêtre', //new in cpg1.2.0
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
        'title' => 'Envoyer en tant que e-card',
        'invalid_email' => '<b>Attention</b> : cette adresse e-mail n\'est pas valide !',
        'ecard_title' => 'Une e-card pour vous, de la part de %s',
        'view_ecard' => 'Si votre e-card ne s\'affiche pas correctement, cliquez ici',
        'view_more_pics' => 'Suivez ce lien pour découvrir davantage de photos !',
        'send_success' => 'Votre ecard a été envoyée',
        'send_failed' => 'Nous sommes désolés, mais le serveur n\'a pu envoyer votre e-card...',
        'from' => 'De la part de',
        'your_name' => 'Votre nom',
        'your_email' => 'Votre adresse e-mail',
        'to' => 'A',
        'rcpt_name' => 'Nom du destinataire',
        'rcpt_email' => 'Adresse e-mail du destinataire',
        'greetings' => 'Introduction',
        'message' => 'Message',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
        'pic_info' => 'Informations sur l\'image',
        'album' => 'Album',
        'title' => 'Titre',
        'desc' => 'Description',
        'keywords' => 'Mots clefs',
        'pic_info_str' => '%sx%s - %sKo - %s affichages - %s votes',
        'approve' => 'Approuver',
        'postpone_app' => 'Approuver plus tard',
        'del_pic' => 'Supprimer l\'image',
        'reset_view_count' => 'Remettre le compteur des téléchargements à zéro',
        'reset_votes' => 'Remettre le compteur de votes à zéro',
        'del_comm' => 'Supprimer les commentaires',
        'upl_approval' => 'Autorisation d\'upload',
        'edit_pics' => 'Modifier les images',
        'see_next' => 'Voir les images suivantes',
        'see_prev' => 'Voir les images précédentes',
        'n_pic' => '%s images',
        'n_of_pic_to_disp' => 'Numéro de l\'image à afficher',
        'apply' => 'Appliquer les modifications'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
        'group_name' => 'Nom du groupe',
        'disk_quota' => 'Quota disque',
        'can_rate' => 'Peut noter les images',
        'can_send_ecards' => 'Peut envoyer des ecards',
        'can_post_com' => 'Peut écrire des commentaires',
        'can_upload' => 'Peut mettre des photos en ligne',
        'can_have_gallery' => 'Peut avoir une galerie perso',
        'apply' => 'Appliquer les modifications',
        'create_new_group' => 'Créer un nouveau groupe',
        'del_groups' => 'Supprimer le(s) groupe(s) sélectionné(s)',
        'confirm_del' => 'Attention, lorsque vous supprimez un groupe, les utilisateurs de ce groupe seront transférés dans le groupe d\'utilisateurs \'Enregistré\'!\n\nSouhaitez-vous continuer?',
        'title' => 'Gérer les groupes d\'utilisateurs',
        'approval_1' => 'Autorisation d\'upload pub. (1)',
        'approval_2' => 'Autorisation d\'upload priv. (2)',
        'note1' => '<b>(1)</b> Les uploads dans un album public doivent être approuvés par un administrateur',
        'note2' => '<b>(2)</b> Les uploads dans un album qui appartient à l\'utilisateur doivent être approuvés par un admin',
        'notes' => 'Remarques'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
        'welcome' => 'Bienvenue!'
);

$lang_album_admin_menu = array(
        'confirm_delete' => 'Voulez-vous VRAIMENT supprimer cet album ? \\nToutes les photos et tous les commentaires seront perdus.',
        'delete' => 'SUPPRIMER',
        'modify' => 'PROPRIETES',
        'edit_pics' => 'MODIFIER LES PHOTOS',
);

$lang_list_categories = array(
        'home' => 'Accueil',
        'stat1' => '<b>[pictures]</b> photos dans <b>[albums]</b> albums et <b>[cat]</b> catégories avec <b>[comments]</b> commentaires affichées <b>[views]</b> fois',
        'stat2' => '<b>[pictures]</b> photos dans <b>[albums]</b> albums affichées <b>[views]</b> times',
        'xx_s_gallery' => '%s\'s Galerie',
        'stat3' => '<b>[pictures]</b> photos dans <b>[albums]</b> albums avec <b>[comments]</b> commentaires affichées <b>[views]</b> fois'
);

$lang_list_users = array(
        'user_list' => 'Liste d\'utilisateurs',
        'no_user_gal' => 'Il n\'y a pas de nouvelle galerie d\'utilisateurs',
        'n_albums' => '%s album(s)',
        'n_pics' => '%s photo(s)'
);

$lang_list_albums = array(
        'n_pictures' => '%s photos',
        'last_added' => ', la dernière a été ajoutée le %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
        'login' => 'Se connecter',
        'enter_login_pswd' => 'Entrez votre login et mot de passe pour vous connecter',
        'username' => 'Login',
        'password' => 'Mot de passe',
        'remember_me' => 'Se souvenir de moi',
        'welcome' => 'Bienvenue %s ...',
        'err_login' => '*** Impossible de se connecter. Essayez encore ***',
        'err_already_logged_in' => 'Vous êtes déjà connecté !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
        'logout' => 'S\'identifier',
        'bye' => 'Au revoir %s ...',
        'err_not_loged_in' => 'Vous n\'êtes pas identifé !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
        'upd_alb_n' => 'Mettre à jour l\'album %s',
        'general_settings' => 'Paramètres généraux',
        'alb_title' => 'Titre de l\'album',
        'alb_cat' => 'Catégorie de l\'album',
        'alb_desc' => 'Description de l\'album',
        'alb_thumb' => 'vignette de l\'album',
        'alb_perm' => 'Permissions pour cet album',
        'can_view' => 'Cet album peut être consulté par',
        'can_upload' => 'Les visiteurs peuvent mettre des photos en ligne',
        'can_post_comments' => 'Les visiteurs peuvent poster des commentaires',
        'can_rate' => 'Les visiteurs peuvent noter les photos',
        'user_gal' => 'Galerie de l\'utilisateur',
        'no_cat' => '* Pas de catégorie *',
        'alb_empty' => 'L\'album est vide',
        'last_uploaded' => 'Dernier upload',
        'public_alb' => 'Tout le monde (album public)',
        'me_only' => 'Moi seulement',
        'owner_only' => 'Le propriétaire de l\'album (%s) seulement',
        'groupp_only' => 'Membres du groupe \'%s\'',
        'err_no_alb_to_modify' => 'Il n\'y a pas d\'album modifiable dans la base.',
        'update' => 'Mettre l\'album à jour'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
        'already_rated' => 'Vous aviez déjà noté cette photo',
        'rate_ok' => 'Votre vote a été pris en compte',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
Bien que les administrateurs de {SITE_NAME} fassent en sortent de supprimer ou modifier toute donnée à caractère répréhensible le plus rapidement possible, il est impossible de scruter systématiquement l\'intégralité des posts. Vous êtes par conséquent conscient que tous les posts effectués sur ce site expriment les points de vue et opinions de leur auteur et non ceux des administrateurs ou du webmaster (sauf, évidemment dans le cas des posts effectués par ces derniers), qui ne pourront par conséquent pas être considérés comme responsables.
<br />
<br />
Vous acceptez de ne poster aucune donnée à caractère injurieux, obscène, vulgaire, diffamatoire, menaçant, sexuels ou tout autre contenu susceptible de violer la loi. Vous acceptez que le webmaster et les modérateurs de {SITE_NAME} aient le droit de supprimer ou modifier n\'importe quel contenu, si cela leur semble opportun. En tant qu\'utilisateur, vous acceptez que toutes les informations entrées plus haut soient stockées dans une base de données. Bien que ces informations ne soient pas communiquées à des tiers sans votre consentement, le webmaster et les administrateurs ne peuvent pas être tenus pour responsables dans le cas de tentatives de hack qui pourraient compromettre les données.<br />
<br />
Ce site utilise des cookies pour stocker des informations sur votre ordinateur. Ces cookies ne servent qu\'à améliorer votre navigation sur ce site. Votre adresse e-mail ne sera utilisée que pour confirmer les données de votre inscription ainsi que votre mot de passe.<br />
<br />
En cliquant sur 'J\'accepte' ci-dessous, vous acceptez de vous soumettre à ces conditions.
EOT;

$lang_register_php = array(
        'page_title' => 'inscription d\'utilisateur',
        'term_cond' => 'Conditions générales d\'inscription',
        'i_agree' => 'J\'accepte',
        'submit' => 'S\'inscrire',
        'err_user_exists' => 'Le nom d\'utilisateur que vous avez entré existe déjà, merci de bien vouloir en choisir un autre',
        'err_password_mismatch' => 'Les deux mots de passe ne correspondent pas, merci de les entrer à nouveau',
        'err_uname_short' => 'Le nom d\'utilisateur doit comprendre au moins 2 caractères',
        'err_password_short' => 'Le mot de passe doit comprendre au moins 2 caractères',
        'err_uname_pass_diff' => 'Le nom d\'utilisateur et le mot de passe doivent être différents',
        'err_invalid_email' => 'L\'adresse e-mail n\'est pas valide',
        'err_duplicate_email' => 'Un autre utilisateur s\'est déjà enregisté avec l\'adresse e-mail que vous avez entrée',
        'enter_info' => 'Entrez les informations relatives à votre inscription',
        'required_info' => 'Informations requises',
        'optional_info' => 'Informations optionnelles',
        'username' => 'Nom d\'utilisateur / login',
        'password' => 'Mot de passe',
        'password_again' => 'Entrez à nouveau le mot de passe',
        'email' => 'Email',
        'location' => 'Localisation',
        'interests' => 'Intérêts',
        'website' => 'Site web',
        'occupation' => 'Activité',
        'error' => 'ERREUR',
        'confirm_email_subject' => '%s - Confirmation d\'inscription',
        'information' => 'Informations',
        'failed_sending_email' => 'L\'e-mail de confirmation d\'inscription n\'a pu être envoyé!',
        'thank_you' => 'Merci pour votre inscription.<br /><br />Un e-mail contenant les informations sur l\'activation de votre compte vous a été envoyé à l\'adresse e-mail que vous nous avez communiquée.',
        'acct_created' => 'Votre compte a bien été crée. Vous pouvez maintenant vous identifier avec votre login et votre mot de passe',
        'acct_active' => 'Votre compte a bien été activé. Vous pouvez maintenant vous identifier avec votre login et votre mot de passe',
        'acct_already_act' => 'Votre compte est déjà actif!',
        'acct_act_failed' => 'Ce compte ne peut pas être activé!',
        'err_unk_user' => 'L\'utilisateur sélectionné n\'existe pas!',
        'x_s_profile' => 'Profil de %s',
        'group' => 'Groupe',
        'reg_date' => 'Date d\'inscription',
        'disk_usage' => 'Utilisation du disque',
        'change_pass' => 'Modifier le mot de passe',
        'current_pass' => 'Mot de passe actuel',
        'new_pass' => 'Nouveau mot de passe',
        'new_pass_again' => 'Nouveau mot de passe (à nouveau)',
        'err_curr_pass' => 'Le mot de passe actuel n\'est pas correct',
        'apply_modif' => 'Appliquer les modifications',
        'change_pass' => 'Changer mon mot de passe',
        'update_success' => 'Votre profil a été mis à jour',
        'pass_chg_success' => 'Votre mot de passe a été modifié',
        'pass_chg_error' => 'Votre mot de passe n\'a pas été modifié',
);

$lang_register_confirm_email = <<<EOT
Merci pour votre inscription sur {SITE_NAME}

Votre nom d\'utilisateur/login est : "{USER_NAME}"
Votre mot de passe est : "{PASSWORD}"

Afin d\'activer votre compte, vous devez cliquer sur le lien suivant, ou bien en faire un copier/coller dans la barre d\'adresse de votre navigateur.

{ACT_LINK}

Cordialement,

L'equipe de {SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
        'title' => 'Vérifier les commentaires',
        'no_comment' => 'Il n\'y a pas de commentaire à vérifier',
        'n_comm_del' => '%s commentaire(s) supprimé(s)',
        'n_comm_disp' => 'Nombre de commentaires à afficher',
        'see_prev' => 'Voir précédent(s)',
        'see_next' => 'Voir suivant(s)',
        'del_comm' => 'Supprimer les commentaires sélectionnés',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
        0 => 'Rechercher une image dans la galerie',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
        'page_title' => 'Rechercher les nouvelles photos',
        'select_dir' => 'Selectionnez le répertoire',
        'select_dir_msg' => 'Cette fonction vous permet d\'ajouter un groupe de photos que vous avez uploadé sur votre serveur FTP.<br /><br />Sélectionnez le répertoire où vous avez uploadé vos photos',
        'no_pic_to_add' => 'Il n\'y a pas de photo à ajouter',
        'need_one_album' => 'Vous avez besoin d\'au moins un album pour effectuer cette opération',
        'warning' => 'Avertissement',
        'change_perm' => 'le script ne peut pas écrire dans ce répertoire, vous devez changer ses permissions à 755 ou 777 avant d\'essayer d\'ajouter les photos !',
        'target_album' => '<b>Mettre les photos de &quot;</b>%s<b>&quot; dans </b>%s',
        'folder' => 'Répertoire',
        'image' => 'Image',
        'album' => 'Album',
        'result' => 'Résultat',
        'dir_ro' => 'Non inscriptible. ',
        'dir_cant_read' => 'Illisible. ',
        'insert' => 'Ajouter de nouvelles images à la galerie',
        'list_new_pic' => 'Liste des nouvelles images',
        'insert_selected' => 'Insérer les photos sélectionnées',
        'no_pic_found' => 'Aucune image n\'a été trouvée',
        'be_patient' => 'Soyez patient. Le script a besoin de temps pour mettre les photos en ligne',
        'notes' =>  '<ul>'.
                                '<li><b>OK</b> : signifie que l\'image a bien été mise en ligne'.
                                '<li><b>DP</b> : signifie que la photo existe déjà dans la base de données'.
                                '<li><b>PB</b> : signifie que la photo n\'a pas pu être ajoutée, vérifiez votre configuration et les permissions des répertoires dans lesquels les images se trouvent'.
                                '<li>Si les signes OK, DP, PB n\'apparaissent pas, cliquez sur l\'image cassée afin de voir le message d\'erreur généré par PHP'.
                                '<li>Si votre browser cesse d\'effectuer la tâche (timeout), cliquez sur le bouton actualiser'.
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
                'title' => 'Bannir des utilisateurs', //new in cpg1.2.0
                'user_name' => 'Nom d\'utilisateur', //new in cpg1.2.0
                'ip_address' => 'Adresse IP', //new in cpg1.2.0
                'expiry' => 'Expire (champs vide signifie que le ban est indéfini)', //new in cpg1.2.0
                'edit_ban' => 'Sauvegarder les changements', //new in cpg1.2.0
                'delete_ban' => 'Supprimer', //new in cpg1.2.0
                'add_new' => 'Ajouter un nouveau ban', //new in cpg1.2.0
                'add_ban' => 'Ajouter', //new in cpg1.2.0
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
        'title' => 'Mettre une photo en ligne',
        'max_fsize' => 'Le poids maximal autorisé pour une image est de %s Ko',
        'album' => 'Album',
        'picture' => 'Photo',
        'pic_title' => 'Titre de la photo',
        'description' => 'Description de la photo',
        'keywords' => 'Mots clefs (séparés par des espaces)',
        'err_no_alb_uploadables' => 'Nous sommes désolés, mais il n\'existe pas d\'album dans lequel vous ayiez le droit d\'uploader des photos',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
        'title' => 'Gérer les utilisateurs',
        'name_a' => 'Nom ascendant',
        'name_d' => 'Nom descendant',
        'group_a' => 'Groupe ascendant',
        'group_d' => 'Groupe descendant',
        'reg_a' => 'Date d\'inscription ascendante',
        'reg_d' => 'Date d\'inscription descendante',
        'pic_a' => 'Nombre de photos ascendant',
        'pic_d' => 'Nombre de photos descendant',
        'disku_a' => 'Utilisation espace disque ascendant',
        'disku_d' => 'Utilisatation espace disque descendant',
        'sort_by' => 'Classer les utilisateurs par',
        'err_no_users' => 'La table d\'utilisateurs est vide!',
        'err_edit_self' => 'Vous ne pouvez pas modifier votre propre profil, utilisez le lien \'Mon profil\' pour effectuer cette opération',
        'edit' => 'EDITER',
        'delete' => 'SUPPRIMER',
        'name' => 'Nom d\'utilisateur',
        'group' => 'Groupe',
        'inactive' => 'Inactif',
        'operations' => 'Opérations',
        'pictures' => 'Photos',
        'disk_space' => 'Espace utilisé / quota',
        'registered_on' => 'Enregistré le',
        'u_user_on_p_pages' => '%d utilisateur(s) sur %d page(s)',
        'confirm_del' => 'Voulez vous vraiment SUPPRIMER cet utilisateur?\\nToutes ses photos et albums seront également supprimés',
        'mail' => 'E-MAIL',
        'err_unknown_user' => 'L\'utilisateur sélectionné n\'existe pas!',
        'modify_user' => 'Modifier l\'utilisateur',
        'notes' => 'Commentaires',
        'note_list' => '<li>Si vous ne souhaitez pas modifier le mot de passe actuel, laisse le champs "mot de passe" vide.',
        'password' => 'Mot de passe',
        'user_active' => 'L\'utilisateur est actif',
        'user_group' => 'Groupe de l\'utilisateur',
        'user_email' => 'e-mail de l\'utilisateur',
        'user_web_site' => 'Site web de l\'utilisateur',
        'create_new_user' => 'Créer un nouvel utilisateur',
        'user_location' => 'Localisation de l\'utilisateur',
        'user_interests' => 'Centres d\'intérêt de l\'utilisateur',
        'user_occupation' => 'Activité de l\'utilisateur',
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => 'Redimensionner les photos', //new in cpg1.2.0
        'what_it_does' => 'Fonctionnalités', //new in cpg1.2.0
        'what_update_titles' => 'Met à jour les titres à partir des noms de fichier', //new in cpg1.2.0
        'what_delete_title' => 'Supprime les titres', //new in cpg1.2.0
        'what_rebuild' => 'Regénère les vignettes et les photos redimensionnées', //new in cpg1.2.0
        'what_delete_originals' => 'Supprime les photos originales et les remplace par leur version redimensionnée', //new in cpg1.2.0
        'file' => 'Fichier', //new in cpg1.2.0
        'title_set_to' => 'titre changé en', //new in cpg1.2.0
        'submit_form' => 'valider', //new in cpg1.2.0
        'updated_succesfully' => 'modifié avec succès', //new in cpg1.2.0
        'error_create' => 'ERREUR lors de la création', //new in cpg1.2.0
        'continue' => 'Continuer avec plus d\'images', //new in cpg1.2.0
        'main_success' => 'Le fichier %s est maintenant utilisé comme image principale', //new in cpg1.2.0
        'error_rename' => 'Erreur lors du changement du nom de %s à %s', //new in cpg1.2.0
        'error_not_found' => 'Le fichier %s n\'a pas été trouvé', //new in cpg1.2.0
        'back' => 'retour à la page principale', //new in cpg1.2.0
        'thumbs_wait' => 'Mise à jour des vignettes et/ou images redimensionnées, merci de patienter...', //new in cpg1.2.0
        'thumbs_continue_wait' => 'Continuer la mise à jour des vignettes et/ou des images redimensionnées...', //new in cpg1.2.0
        'titles_wait' => 'Mise à jour des titres, merci de patienter...', //new in cpg1.2.0
        'delete_wait' => 'Suppression des titres, merci de patienter...', //new in cpg1.2.0
        'replace_wait' => 'Suppression des originaux et remplacement de ces derniers par les images redimensionnées, merci de patienter...', //new in cpg1.2.0
        'instruction' => 'Instructions rapides', //new in cpg1.2.0
        'instruction_action' => 'Selectionnez une action', //new in cpg1.2.0
        'instruction_parameter' => 'Définissez les paramètres', //new in cpg1.2.0
        'instruction_album' => 'Sélectionnez un album', //new in cpg1.2.0
        'instruction_press' => 'Appuyez sur %s', //new in cpg1.2.0
        'update' => 'Mettre à jour les vignettes et/ou les photos redimensionnées', //new in cpg1.2.0
        'update_what' => 'Ce qui doit être mis à jour', //new in cpg1.2.0
        'update_thumb' => 'Seulement les vignettes', //new in cpg1.2.0
        'update_pic' => 'Seulement les photos redimensionnées', //new in cpg1.2.0
        'update_both' => 'Les vignettes et les images redimensionnées', //new in cpg1.2.0
        'update_number' => 'Nombre d\'images traitées par clic', //new in cpg1.2.0
        'update_option' => '(essayez de réduire cette valeur si vous avez des problèmes de timeout)', //new in cpg1.2.0
        'filename_title' => 'Nom du fichier / Titre de l\'image', //new in cpg1.2.0
        'filename_how' => 'Comment le nom du fichier doit-il être modifié ?', //new in cpg1.2.0
        'filename_remove' => 'Supprimer la fin .jpg et remplacer _ (underscore) par des espaces', //new in cpg1.2.0
        'filename_euro' => 'Changer 2003_11_23_13_20_20.jpg en 23/11/2003 13:20', //new in cpg1.2.0
        'filename_us' => 'Changer 2003_11_23_13_20_20.jpg en 11/23/2003 13:20', //new in cpg1.2.0
        'filename_time' => 'Changer 2003_11_23_13_20_20.jpg en 13:20', //new in cpg1.2.0
        'delete' => 'Supprimer le titre des photos ou les photos dans leur taille d\'origine', //new in cpg1.2.0
        'delete_title' => 'Supprimer le titre des photos', //new in cpg1.2.0
        'delete_original' => 'Supprimer les photos dans leur taille d\'origine', //new in cpg1.2.0
        'delete_replace' => 'Supprime les images originales en les remplaçant par les versions redimensionnées', //new in cpg1.2.0
        'select_album' => 'Selectionner un album', //new in cpg1.2.0
);
?>