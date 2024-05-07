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
// ENCODING CHECK; SHOULD BE YEN BETA MU: � � �
// ------------------------------------------------------------------------- //
// $Id: french.php,v 1.16 2005/07/04 05:56:11 gaugau Exp $
// ------------------------------------------------------------------------- //

// info about translators and translated language
$lang_translation_info = array(
'lang_name_english' => 'French',
'lang_name_native' => 'Fran�ais',
'lang_country_code' => 'fr',
'trans_name'=> 'jdbaranger - modified by JDBaranger, edited by sbourdon, corrected by Olivier Verdier',
'trans_email' => '',
'trans_website' => 'http://www.everlasting-star.net/',
'trans_date' => '2004-09-28',
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
$album_date_fmt =  '%e %B %Y';
$lastcom_date_fmt =  '%d/%m/%y � %H:%M';
$lastup_date_fmt = '%e %B %Y';
$register_date_fmt = '%e %B %Y';
$lasthit_date_fmt = ' %a %e %B %Y � %H:%M';
$comment_date_fmt =  '%a %e %B %Y � %H:%M';

// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*', 'merde', 'putain', 'encul�*', 'salope', 'bite', 'cul', 'pute', 'p�nis', 'clito', 'couille', 'p�tasse', 'connard', 'salaud');

$lang_meta_album_names = array(
  'random' => 'Photos al�atoires',
  'lastup' => 'Derniers ajouts',
  'lastalb'=> 'Derniers albums mis en ligne',
  'lastcom' => 'Derniers commentaires',
  'topn' => 'Les plus populaires',
  'toprated' => 'Les mieux not�es',
  'lasthits' => 'Les derni�res vues',
  'search' => 'R�sultats de la recherche',
  'favpics'=> 'Photos pr�f�r�es'
);

$lang_errors = array(
  'access_denied' => 'Vous n\'avez pas la permission d\'acc�der � cette page.',
  'perm_denied' => 'Vous n\'avez pas la permission d\'effectuer cette op�ration.',
  'param_missing' => 'Script appel� sans les param�tres n�cessaires.',
  'non_exist_ap' => 'L\'album/la photo demand�(e) n\'existe pas !',
  'quota_exceeded' => 'Espace disque d�pass�<br /><br />Vous avez un quota d\'espace de [quota]K, vos photos utilisent [space]K, le fait d\'ajouter cette photo vous ferait d�passer votre quota.',
  'gd_file_type_err' => 'L\'utilisation de "GD image library" ne vous permet d\'utiliser que de images de type JPEG et PNG.',
  'invalid_image' => 'L\'image que vous avez upload�e est corrompue ou ne peut pas �tre prise en charge par GD library',
  'resize_failed' => 'Impossible de cr�er la vignette ou l\'image r�duite.',
  'no_img_to_display' => 'Pas d\'image � afficher',
  'non_exist_cat' => 'La cat�gorie s�lectionn�e n\'existe pas',
  'orphan_cat' => 'Une cat�gorie a un parent inexistant, utilisez le gestionnaire de cat�gories afin de rem�dier au probl�me.',
  'directory_ro' => 'Le r�pertoire \'%s\' n\'est pas inscriptible : les images ne peuvent �tre supprim�es.',
  'non_exist_comment' => 'Le commentaire s�lectionn� n\'existe pas.',
  'pic_in_invalid_album' => 'L\'image se trouve dans un album qui n\'existe pas (%s)!?',
  'banned' => 'Vous �tes pour l\'instant banni de ce site.',
  'not_with_udb' => 'Cette fonction est d�sactiv�e dans Coppermine parce que la galerie est int�gr�e � un forum. Soit l\'action que vous essayez d\'effectuer n\'est pas disponible dans cette configuration, soit vous devez l\'effectuer � partir du forum auquel vous avez int�gr� la galerie.',
  'offline_title' => 'Hors Ligne',
  'offline_text' => 'Cette gallerie n\'est pas en ligne actuellement. Revenez la voir tr�s bient�t !',
  'ecards_empty' => 'Il n\'y a pas encore de logs enregistr�s. V�rifiez que vous avez activ� l\'option correspondante dans la configuration de Coppermine.',
  'action_failed' => 'Erreur ! Coppermine ne peut pas traiter cette requ�te.',
  'no_zip' => 'Les librairies n�cessaires au traitement des fichiers ZIP ne sont pas install�es. Contactez l\'Administrateur du site.',
  'zip_type' => 'Vous n\'avez pas l\'autorisation de t�l�charger des fichiers ZIP.',
);

$lang_bbcode_help = 'Ces codes peuvent vous �tre utiles: <li>[b]<b>Gras</b>[/b]</li> <li>[i]<i>Italique</i>[/i]</li> <li>[url=http://votre-site.com/]Texte de l\'URL[/url]</li> <li>[email]adresse@domaine.com[/email]</li>'; //cpg1.3.0

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
  'alb_list_title' => 'Aller � la liste des albums',
  'alb_list_lnk' => 'Albums',
  'my_gal_title' => 'Aller dans ma galerie personnelle',
  'my_gal_lnk' => 'Ma galerie',
  'my_prof_lnk' => 'Mon profil',
  'adm_mode_title' => 'Passer en mode admin',
  'adm_mode_lnk' => 'Mode admin',
  'usr_mode_title' => 'Passer au mode utilisateur',
  'usr_mode_lnk' => 'Mode utilisateur',
  'upload_pic_title' => 'Uploader une image dans un album',
  'upload_pic_lnk' => 'Uploader une image',
  'register_title' => 'Cr�er un compte',
  'register_lnk' => 'Inscription',
  'login_lnk' => 'S\'identifier',
  'logout_lnk' => 'Quitter',
  'lastup_lnk' => 'Derniers ajouts',
  'lastcom_lnk' => 'Commentaires',
  'topn_lnk' => 'Les plus populaires',
  'toprated_lnk' => 'Les mieux not�es',
  'search_lnk' => 'Rechercher',
  'fav_lnk' => 'Mes favoris',
  'memberlist_title' => 'Afficher la liste des membres',
  'memberlist_lnk' => 'Liste des membres',
  'faq_title' => 'Questions fr�quemment pos�es � propos de &quot;Coppermine&quot;',
  'faq_lnk' => 'FAQ',
);

$lang_gallery_admin_menu = array(
  'upl_app_lnk' => 'Fichiers � valider',
  'config_lnk' => 'Configuration',
  'albums_lnk' => 'Albums',
  'categories_lnk' => 'Cat�gories',
  'users_lnk' => 'Utilisateurs',
  'groups_lnk' => 'Groupes',
  'comments_lnk' => 'Commentaires',
  'searchnew_lnk' => 'FTP =>',
  'util_lnk' => 'Utilitaires',
  'ban_lnk' => 'Bannir des utilisateurs',
  'db_ecard_lnk' => 'Cartes envoy�es',
);

$lang_user_admin_menu = array(
  'albmgr_lnk' => 'Cr�er / classer mes albums',
  'modifyalb_lnk' => 'Modifier mes albums',
  'my_prof_lnk' => 'Mon profil',
);

$lang_cat_list = array(
  'category' => 'Cat�gorie',
  'albums' => 'Albums',
  'pictures' => 'Photos',
);

$lang_album_list = array(
  'album_on_page' => '%d albums sur %d page(s)'
);

$lang_thumb_view = array(
  'date' => 'DATE',
  //Sort by filename and title
  'name' => 'NOM DU FICHIER',
  'title' => 'TITRE',
  'sort_da' => 'Classement ascendant par date',
  'sort_dd' => 'Classement descendant par date',
  'sort_na' => 'Classement ascendant par nom',
  'sort_nd' => 'Classement descendant par nom',
  'sort_ta' => 'Classement ascendant par titre',
  'sort_td' => 'Classement descendant par titre',
  'download_zip' => 'T�l�charger un fichier ZIP',
  'pic_on_page' => '%d photos sur %d page(s)',
  'user_on_page' => '%d utilisateurs sur %d page(s)'
);

$lang_img_nav_bar = array(
  'thumb_title' => 'Retourner � la page des vignettes',
  'pic_info_title' => 'Afficher / cacher les informations sur l\'image',
  'slideshow_title' => 'Diaporama',
  'ecard_title' => 'Envoyer cette image en tant que carte �lectronique',
  'ecard_disabled' => 'Les cartes �lectroniques sont d�sactiv�es',
  'ecard_disabled_msg' => 'Vous n\'avez pas l\'autorisation d\'envoyer des cartes',
  'prev_title' => 'Voir l\'image pr�c�dente',
  'next_title' => 'Voir l\'image suivante',
  'pic_pos' => 'PHOTO %s/%s',
);

$lang_rate_pic = array(
  'rate_this_pic' => 'Noter cette image ',
  'no_votes' => '(Pas encore de note)',
  'rating' => '(note actuelle : %s / 5 pour %s votes)',
  'rubbish' => 'Tr�s mauvais',
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
  'date_added' => 'Ajout� le : '
);

$lang_get_pic_data = array(
  'n_comments' => '%s commentaires',
  'n_views' => 'vu %s fois',
  'n_votes' => '(%s votes)'
);

$lang_cpg_debug_output = array(
  'debug_info' => 'Infos de d�buggage',
  'select_all' => 'Tout s�lectionner',
  'copy_and_paste_instructions' => 'Si vous souhaitez soumettre une demande d\'assistance dans le forum de support de Coppermine, copier/collez ces informations de d�buggage dans avec votre message. Assuez-vous de remplacer tous les mots de passe, m�me cod�s, par \'***\' avant de poster votre message.',
  'phpinfo' => 'display phpinfo',
);

$lang_language_selection = array(
  'reset_language' => '- Par d�faut -',
  'choose_language' => 'Langue :',
);

$lang_theme_selection = array(
  'reset_theme' => '- Par d�faut -',
  'choose_theme' => 'Th�me :',
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
  'Very Happy' => 'Tr�s heureux',
  'Smile' => 'Sourire',
  'Sad' => 'Triste',
  'Surprised' => 'Surpris',
  'Shocked' => 'Choqu�',
  'Confused' => 'Confus',
  'Cool' => 'Cool',
  'Laughing' => 'Rire',
  'Mad' => 'Fou',
  'Razz' => 'Razz',
  'Embarassed' => 'Embarass�',
  'Crying or Very sad' => 'Pleure ou tr�s triste',
  'Evil or Very Mad' => 'Diabolique ou tr�s en col�re',
  'Twisted Evil' => 'Sadique',
  'Rolling Eyes' => 'L�ve les yeux au ciel',
  'Wink' => 'Clin d\'oeil',
  'Idea' => 'Id�e',
  'Arrow' => 'Fl�che',
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
  0 => 'D�connexion du mode administrateur...',
  1 => 'Passage au mode administrateur...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
  'alb_need_name' => 'Les albums doivent avoir un nom !',
  'confirm_modifs' => 'Voulez-vous vraiment effectuer ces modifications ?',
  'no_change' => 'Vous n\\\'avez effectu� aucun changement !',
  'new_album' => 'Nouvel album',
  'confirm_delete1' => 'Voulez vous vraiment supprimer cet album ?',
  'confirm_delete2' => '\nToutes les images et tous les commentaires seront perdus !',
  'select_first' => 'S�lectionnez d\\\'abord un album',
  'alb_mrg' => 'Gestionnaire d\'album',
  'my_gallery' => '* Ma galerie *',
  'no_category' => '* Pas de cat�gorie *',
  'delete' => 'Supprimer',
  'new' => 'Nouveau',
  'apply_modifs' => 'Appliquer les modifications',
  'select_category' => 'S�lectionner une categorie',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
  'miss_param' => 'Les param�tres requis pour l\'\'%s\'operation sont manquants !',
  'unknown_cat' => 'La cat�gorie s�lectionn�e n\'existe pas dans la base de donn�es',
  'usergal_cat_ro' => 'La galerie des utilisateurs ne peut pas �tre supprim�e!',
  'manage_cat' => 'G�rer les cat�gories',
  'confirm_delete' => 'Voulez vous vraiment SUPPRIMER cette cat�gorie ?',
  'category' => 'Categorie',
  'operations' => 'Op�rations',
  'move_into' => 'D�placer dans',
  'update_create' => 'Mettre � jour / cr�er la cat�gorie',
  'parent_cat' => 'Cat�gorie parente',
  'cat_title' => 'Titre de la cat�gorie',
  'cat_thumb' => 'Vignette de la cat�gorie',
  'cat_desc' => 'Description de la cat�gorie'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
  'title' => 'Configuration',
  'restore_cfg' => 'Restaurer les param�tres d\'origine',
  'save_cfg' => 'Sauvegarder la nouvelle configuration',
  'notes' => 'Notes',
  'info' => 'Information',
  'upd_success' => 'La configuration de Coppermine a �t� mise � jour',
  'restore_success' => 'La configuration d\'origine de Coppermine a �t� restaur�e',
  'name_a' => 'Ascendant par nom',
  'name_d' => 'Descendantpar nom',
  'title_a' => 'Ascendant par titre',
  'title_d' => 'Descendant par titre',
  'date_a' => 'Ascendant par date',
  'date_d' => 'Descendant par date',
  'th_any' => 'Aspect max',
  'th_ht' => 'Hauteur',
  'th_wd' => 'Largeur',
  'label' => 'Libell�',
  'item' => 'Liste',
  'debug_everyone' => 'Tout le monde',
  'debug_admin' => 'Administrateurs uniquement' //cpg1.3.0
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
  'Param�tres g�n�raux',
  array('Nom de la galerie', 'gallery_name', 0),
  array('Description de la galerie', 'gallery_description', 0),
  array('Email de l\'administrateur de la galerie', 'gallery_admin_email', 0),
  array('Adresse sur laquelle le lien \'Voir plus de photos\' des cartes �lectroniques doit pointer', 'ecards_more_pic_target', 0),
  array('La galerie n\'est pas publi�e', 'offline', 1),
  array('Loguer les envois de cartes �lectroniques', 'log_ecards', 1),
  array('Autoriser le t�l�chargement ZIP des photos dans les Favoris', 'enable_zipdownload', 1),

  'Param�tres de langues, themes &amp; caract�res',
  array('Langue par d�faut', 'lang', 5),
  array('Theme par d�faut', 'theme', 6),
  array('Afficher la liste des langues', 'language_list', 1),
  array('Afficher le drapeau des langues', 'language_flags', 8),
  array('Afficher &quot;- Par d�faut -&quot; dans la s�lection des langues', 'language_reset', 1),
  array('Afficher la liste des th�mes', 'theme_list', 1),
  array('Afficher &quot;- Par d�faut -&quot; dans la liste des th�mes', 'theme_reset', 1),
  array('Afficher les FAQ', 'display_faq', 1),
  array('Afficher l\'aide bbcode', 'show_bbcode_help', 1),
  array('Encodage des caract�res', 'charset', 4),

  'Affichage de la liste des albums',
  array('Largeur du tableau principal (pixels ou %)', 'main_table_width', 0),
  array('Nombre de niveaux de cat�gories � afficher', 'subcat_level', 0),
  array('Nombre d\'albums � afficher', 'albums_per_page', 0),
  array('Nombre de colonnes pour la liste des albums', 'album_list_cols', 0),
  array('Taille des vignettes en pixels', 'alb_list_thumb_size', 0),
  array('Le contenu de la page principale', 'main_page_layout', 0),
  array('Afficher les vignettes de l\'album du premier niveau avec la cat�gorie','first_level',1),

  'Affichage des vignettes',
  array('Nombre de colonnes sur la page des vignettes', 'thumbcols', 0),
  array('Nombre de lignes sur la page des vignettes', 'thumbrows', 0),
  array('Nombre maximal d\'onglets � afficher', 'max_tabs', 0),
  array('Afficher la l�gende de l\'image (en plus de son titre) sous la vignette', 'caption_in_thumbview', 1),
  array('Afficher le nombre de commentaires sous les vignettes', 'display_comment_count', 1),
  array('Afficher le nom de l\'utilisateur sous la vignette', 'display_uploader', 1),
  array('Classement par d�faut des images', 'default_sort_order', 3),
  array('Nombre minimum de votes n�cessaires pour qu\'une image apparaisse dans la liste des images les mieux not�es', 'min_votes_for_rating', 0),

  'Affichage des images &amp; param�tres des commentaires',
  array('Largeur du tableau pour l\'affichage des images (pixels ou %)', 'picture_table_width', 0),
  array('Les informations relatives � l\'image sont affich�es par d�faut', 'display_pic_info', 1),
  array('Filtrer les gros mots dans les commentaires', 'filter_bad_words', 1),
  array('Autoriser les smileys dans les commentaires', 'enable_smilies', 1),
  array('Autoriser plusieurs messages successifs du m�me utilisateur (D�sactive la protection contre le flood)', 'disable_comment_flood_protect', 1),
  array('Longueur maximale pour la description des images', 'max_img_desc_length', 0),
  array('Nombre maximal de lettres pour un mot', 'max_com_wlength', 0),
  array('Nombre maximal de lignes pour un commentaire', 'max_com_lines', 0),
  array('Longueur maximale d\'un commentaire', 'max_com_size', 0),
  array('Afficher le n�gatif', 'display_film_strip', 1),
  array('Nombre d\'images par n�gatif', 'max_film_strip_items', 0),
  array('Pr�venir l\'administrateur lorsque des commentaires sont post�s', 'email_comment_notification', 1),
  array('Intervalle d\'affichage des photos dans les diaporamas, en millisecondes (1 seconde = 1000 millisecondes)', 'slideshow_interval', 0),

  'Param�tres des images et vignettes',
  array('Qualit� pour les fichiers JPG', 'jpeg_qual', 0),
  array('Dimension maximale pour les vignettes <b>*</b>', 'thumb_width', 0),
  array('Utiliser la dimension (largeur ou hauteur ou aspect max pour la vignette)<b>**</b>', 'thumb_use', 7),
  array('Cr�er des images interm�diaires','make_intermediate',1),
  array('Largeur ou hauteur maximale pour une image interm�diaire <a href="#notice2" class="clickable_option">**</a>', 'picture_width', 0),
  array('Poids maximal des images � uploader (Ko)', 'max_upl_size', 0),
  array('Longueur ou hauteur maximale pour les images upload�es (en pixels)', 'max_upl_width_height', 0),

  'Param�tres avanc�s',
  array('Montrer les vignettes des albums priv�s aux utilisateurs anonymes','show_private',1),
  array('Caract�res interdits dans les noms de fichiers', 'forbiden_fname_char',0),
  //array('Extensions de fichiers accept�es pour l\'upload de fichiers', 'allowed_file_extensions',0),
  array('Types d\'images autoris�s', 'allowed_img_types',0),
  array('Types de films autoris�s', 'allowed_mov_types',0),
  array('Types de fichiers sons autoris�s', 'allowed_snd_types',0),
  array('Types de fichiers textes autoris�s', 'allowed_doc_types',0),
  array('M�thode de redimensionnement des images','thumb_method',2),
  array('Chemin vers l\'utilitaire \'convert\' d\'ImageMagick (exemple /usr/bin/X11/)', 'impath', 0),
  //array('Types d\'images autoris�s (seulement pour ImageMagick)', 'allowed_img_types',0),
  array('Options de ligne de commande pour ImageMagick', 'im_options', 0),
  array('Lire les informations EXIF dans les fichiers JPEG', 'read_exif_data', 1),
  array('Lire les informations IPTC dans les fichiers JPEG', 'read_iptc_data', 1),
  array('R�pertoire pour les albums des utilisateurs <a href="#notice1" class="clickable_option">*</a>', 'fullpath', 0),
  array('R�pertoire pour les images des utilisateurs <a href="#notice1" class="clickable_option">*</a>', 'userpics', 0),
  array('Pr�fixe pour les images interm�diaires <a href="#notice1" class="clickable_option">*</a>', 'normal_pfx', 0),
  array('Pr�fixe pour les vignettes <a href="#notice1" class="clickable_option">*</a>', 'thumb_pfx', 0),
  array('Mode par d�faut des r�pertoires', 'default_dir_mode', 0),
  array('Mode par d�faut des fichiers', 'default_file_mode', 0),

  'Param�tres Utilisateurs',
  array('Autoriser de nouvelles inscriptions', 'allow_user_registration', 1),
  array('L\'inscription d\'un nouvel utilisateur doit �tre valid�e', 'reg_requires_valid_email', 1),
  array('Notifier l\'administrateur des nouvelles inscriptions', 'reg_notify_admin_email', 1),
  array('Autoriser deux utilisateurs � avoir le m�me e-mail', 'allow_duplicate_emails_addr', 1),
  array('Les utilisateurs peuvent avoir des albums personnels (Note: si vous passez de "oui" � "non", tous les albums priv�s deviendront public).', 'allow_private_albums', 1),
  array('Notifier l\'administrateur lorsque des uploads n�cessitent son approbation', 'upl_notify_admin_email', 1),
  array('Autoriser les utilisateurs authentifi�s � visualiser la Liste des membres', 'allow_memberlist', 1),

  'Champs libres pour les descriptions d\'images (� laisser tel quel si vous n\'utilisez pas cette fonction)',
  array('Nom du champ 1', 'user_field1_name', 0),
  array('Nom du champ 2', 'user_field2_name', 0),
  array('Nom du champ 3', 'user_field3_name', 0),
  array('Nom du champ 4', 'user_field4_name', 0),

  'Cookies &amp; param�tres d\'encodage des caract�res',
  array('Nom du cookie utilis� par le script (si vous utilisez l\'int�gration avec un forum, v�rifiez que les cookies sont diff�rents)', 'cookie_name', 0),
  array('Chemin du cookie utilis� par le script', 'cookie_path', 0),

  'Divers',
  array('Activer le mode debug', 'debug_mode', 1),
  array('Afficher les notices dans le mode debug', 'debug_notice', 1),


  '<br /><div align="left"><a name="notice1"></a>(*) Ce param�tre ne doit pas �tre modifi� si des images sont d�j� pr�sentes dans la Base de donn�es.<br />
  <a name="notice2"></a>(**) Lorsque vous modifiez ce param�tre, seuls les nouveaux fichiers seront affect�s. Il est donc conseill� de ne pas modifier ce param�tre si des images sont d�j� pr�sentes dans la Base de donn�es. Vous pouvez toutefois appliquer ce param�tre aux fichiers existants avec <a href="util.php">l\'utilitaire appropri�</a> (option Redimensionner les images) accessible depuis le menu d\'administration.</div><br />',
);

// -------------------------------------------------------------------------
//
// File db_ecard.php //cpg1.3.0
// -------------------------------------------------------------------------
//

if (defined('DB_ECARD_PHP')) $lang_db_ecard_php = array(
  'title' => 'Cartes envoy�es',
  'ecard_sender' => 'Exp�diteur',
  'ecard_recipient' => 'Destinataire',
  'ecard_date' => 'Date',
  'ecard_display' => 'Afficher les cartes',
  'ecard_name' => 'Nom',
  'ecard_email' => 'E-mail',
  'ecard_ip' => 'IP #',
  'ecard_ascending' => 'ascendant',
  'ecard_descending' => 'descendant',
  'ecard_sorted' => 'tri�es',
  'ecard_by_date' => 'par date',
  'ecard_by_sender_name' => 'par nom d\'exp�diteur',
  'ecard_by_sender_email' => 'par adresse d\'exp�diteur',
  'ecard_by_sender_ip' => 'par adresse IP d\'exp�diteur',
  'ecard_by_recipient_name' => 'par nom de destinataire',
  'ecard_by_recipient_email' => 'par adresse de destinataire',
  'ecard_number' => 'Affichage des enregistrements %s � %s parmi %s',
  'ecard_goto_page' => 'Aller � la page',
  'ecard_records_per_page' => 'enregistrements par page',
  'check_all' => 'Tout cocher',
  'uncheck_all' => 'Tout d�cocher',
  'ecards_delete_selected' => 'Supprimer les cartes s�lectionn�es',
  'ecards_delete_confirm' => 'Etes-vous certain de vouloir supprimer ces enregistrements ? Merci de cocher la case !',
  'ecards_delete_sure' => 'Je suis certain',
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
  'empty_name_or_com' => 'Vous devez taper votre nom et un commentaire',
  'com_added' => 'Votre commentaire a �t� ajout�',
  'alb_need_title' => 'Vous devez donner un titre � l\'album !',
  'no_udp_needed' => 'Aucune mise � jour n\'est n�cessaire.',
  'alb_updated' => 'L\'album a �t� mis � jour',
  'unknown_album' => 'L\'album s�lectionn� n\'existe pas ou bien vous n\'avez pas la permission d\'uploader dans cet album',
  'no_pic_uploaded' => 'Aucune image n\'a �t� upload�e !<br /><br />Si vous avez vraiment s�lectionn� une image � uploader, v�rifier que le serveur autorise l\'upload de fichiers...',
  'err_mkdir' => 'Impossible de cr�er le r�pertoire %s !',
  'dest_dir_ro' => 'Le r�pertoire de destination (%s) ne dispose pas des droits d\'�criture n�cessaires pour le script!',
  'err_move' => 'Impossible de d�placer %s vers %s !',
  'err_fsize_too_large' => 'La taille de l\'image que vous avez upload� est trop grande (le maximum autoris� est de %s x %s) !',
  'err_imgsize_too_large' => 'Le poids du fichier que vous avez upload� est trop important (le maximum autoris� est de %s Ko) !',
  'err_invalid_img' => 'Le fichier que vous avez upload� n\'est pas une image valide!',
  'allowed_img_types' => 'Vous ne pouvez uploader que %s images.',
  'err_insert_pic' => 'Les images \'%s\' ne peuvent pas �tre ins�r�es dans l\'album ',
  'upload_success' => 'Votre image a �t� correctement upload�e<br /><br />Elle sera visible apr�s validation de l\'administrateur.',
  'notify_admin_email_subject' => '%s - Notification d\'upload',
  'notify_admin_email_body' => 'Une image a �t� upload�e par %s. Cela n�cessite votre approbation. Connectez-vous � %s',
  'info' => 'Information',
  'com_added' => 'Commentaire ajout�',
  'alb_updated' => 'Album mis � jour',
  'err_comment_empty' => 'Votre commentaire est vide!',
  'err_invalid_fext' => 'Seuls les fichiers avec les extensions suivantes sont autoris�s : <br /><br />%s.',
  'no_flood' => 'Nous sommes d�sol�s, mais vous �tes d�j� l\'auteur du dernier commentaire post� au sujet de cette image.<br /><br />Vous pouvez tout simplement �diter votre message pr�c�dent si vous souhaitez le modifier ou bien ajouter des informations.',
  'redirect_msg' => 'Redirection en cours.<br /><br /><br />Cliquez sur \'CONTINUER\' si la page ne se recharge pas automatiquement',
  'upl_success' => 'Votre image a �t� correctement ajout�e',
  'email_comment_subject' => 'Commentaire post� sur Coppermine Photo Gallery',
  'email_comment_body' => 'Quelqu\'un a post� un commentaire dans votre galerie. Voyez-le �',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
  'caption' => 'L�gende',
  'fs_pic' => 'image en taille r�elle',
  'del_success' => 'suppression r�ussie',
  'ns_pic' => 'image en taille normale',
  'err_del' => 'ne peut pas �tre supprim�',
  'thumb_pic' => 'vignette',
  'comment' => 'commentaire',
  'im_in_alb' => 'image dans l\'album',
  'alb_del_success' => 'Album \'%s\' supprim�',
  'alb_mgr' => 'Gestionnaire d\'album',
  'err_invalid_data' => 'Donn�es non valides re�ues dans \'%s\'',
  'create_alb' => 'Cr�ation de l\'album \'%s\'',
  'update_alb' => 'Mise � jour de l\'album \'%s\' avec le titre \'%s\' et index \'%s\'',
  'del_pic' => 'Supprimer l\'image',
  'del_alb' => 'Supprimer l\'album',
  'del_user' => 'Supprimer l\'utilisateur',
  'err_unknown_user' => 'L\'utilisateur s�lectionn� n\'existe pas !',
  'comment_deleted' => 'Le commentaire a �t� supprim� avec succ�s',
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
  'confirm_del' => 'Voulez vous vraiment SUPPRIMER cette image?\\nLes commentaires seront �galement supprim�s.',
  'del_pic' => 'SUPPRIMER CETTE IMAGE',
  'size' => '%s x %s pixels',
  'views' => '%s fois',
  'slideshow' => 'Diaporama',
  'stop_slideshow' => 'ARRETER LE DIAPORAMA',
  'view_fs' => 'Cliquez pour voir l\'image en taille r�elle',
  'edit_pic' => 'Modifier la description',
  'crop_pic' => 'Retoucher',
);

$lang_picinfo = array(
  'title' =>'Informations sur l\'image',
  'Filename' => 'Nom du fichier',
  'Album name' => 'Nom de l\'album',
  'Rating' => 'Note (%s votes)',
  'Keywords' => 'Mots clefs',
  'File Size' => 'Taille du fichier',
  'Dimensions' => 'Dimensions',
  'Displayed' => 'Affich�es',
  'Camera' => 'Appareil photos',
  'Date taken' => 'Date de la prise de vue',
  'ISO'=>'ISO',
  'Aperture' => 'Ouverture',
  'Exposure time' => 'Temps d\'exposition',
  'Focal length' => 'Focale',
  'Comment' => 'Commentaires',
  'addFav'=>'Ajouter aux favoris',
  'addFavPhrase'=>'Favoris',
  'remFav'=>'Supprimer des favoris',
  'iptcTitle'=>'Titre IPTC',
  'iptcCopyright'=>'Copyright IPTC',
  'iptcKeywords'=>'Mots cl�s IPTC',
  'iptcCategory'=>'Cat�gorie IPTC',
  'iptcSubCategories'=>'Sous-sat�gorie IPTC',
);

$lang_display_comments = array(
  'OK' => 'OK',
  'edit_title' => 'Modifier ce commentaire',
  'confirm_delete' => 'Voulez vous vraiment supprimer ce commentaire?',
  'add_your_comment' => 'Ajoutez votre commentaire',
  'name'=>'Nom',
  'comment'=>'Commentaire',
  'your_name' => 'Anonyme',
);

$lang_fullsize_popup = array(
  'click_to_close' => 'Cliquez sur l\'image pour fermer la fen�tre',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
  'title' => 'Envoyer en tant que carte �lectronique',
  'invalid_email' => '<b>Attention</b> : cette adresse e-mail n\'est pas valide !',
  'ecard_title' => 'Une carte �lectronique pour vous, de la part de %s',
  'error_not_image' => 'Seules les images peuvent �tre envoy�es sous forme de cartes �lectroniques.',
  'view_ecard' => 'Si votre carte �lectronique ne s\'affiche pas correctement, cliquez ici',
  'view_more_pics' => 'Suivez ce lien pour d�couvrir davantage de photos !',
  'send_success' => 'Votre carte �lectronique a �t� envoy�e',
  'send_failed' => 'Nous sommes d�sol�s, mais le serveur n\'a pu envoyer votre carte �lectronique...',
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
  'read_exif' => 'Relire les informations EXIF',
  'reset_view_count' => 'Remettre le compteur des t�l�chargements � z�ro',
  'reset_votes' => 'Remettre le compteur de votes � z�ro',
  'del_comm' => 'Supprimer les commentaires',
  'upl_approval' => 'Autorisation d\'upload',
  'edit_pics' => 'Modifier les images',
  'see_next' => 'Voir les images suivantes',
  'see_prev' => 'Voir les images pr�c�dentes',
  'n_pic' => '%s images',
  'n_of_pic_to_disp' => 'Nombre d\'images � afficher',
  'apply' => 'Appliquer les modifications',
  'crop_title' => 'Editeur Photo de Coppermine',
  'preview' => 'Pr�visualiser',
  'save' => 'Sauvegarder la photo',
  'save_thumb' =>'Sauvegarder en tant que vignette',
  'sel_on_img' =>'La s�lection doit �tre enti�rement sur l\'image', //js-alert //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File faq.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FAQ_PHP')) $lang_faq_php = array(
  'faq' => 'Questions fr�quemment pos�es',
  'toc' => 'Table des mati�res',
  'question' => 'Question : ',
  'answer' => 'R�ponse : ',
);

if (defined('FAQ_PHP')) $lang_faq_data = array(
  '<br>FAQ g�n�rales<br>',
  array('Pourquoi dois-je m\'inscrire ?', 'L\'inscription peut �tre impos�e ou non par l\'administrateur. Elle offre des fonctionnalit�s suppl�mentaires telles que la possibilit� d\'uploader des images, d\'avoir une liste de Favoris, de noter les images, de poster des commentaires etc...', 'allow_user_registration', '0'),
  array('Comment puis-je m\'inscrire ?', 'Allez sur &quot;Inscription&quot; et renseignez les informations requises (�ventuellement les informations optionnelles, si vous le souhaitez).<br />Si l\'administrateur a demand� une confirmation par mail, vous recevrez un message � l\'adresse que vous aurez renseign�e dans le formulaire d\'inscription. Ce message vous induiqera la marche � suivre pour valider votre inscription. Votre inscription doit �tre valid�e avant que vous ne puissiez vous indentifier.', 'allow_user_registration', '1'),
  array('Comment m\'identifier ?', 'Allez sur &quot;S\'identifier&quot;, saisissez votre pseudo et votre mot de passe. Cochez &quot;Se souvenir de moi&quot; afin d\'�tre automatiquement reconnect� lorsque vous reviendrez sur le site.<br /><b>IMPORTANT : Vous devez autoriser les cookies et le cookie ne doit pas �tre effac� pour que cette option fonctionne.</b>', 'offline', 0),
  array('Pourquoi ne puis-je pas m\'identifier ?', 'V�rifiez que vous vous �tes bien inscrit et que vous avez cliqu� sur le lien de validation indiqu� dans le mail de confirmation que vous devez avoir re�u. Pour tout autre probl�me, contactez l\'administrateur du site.', 'offline', 0),
  array('Et si j\'oublie mon mot de passe ?', 'Si le site poss�de un lien &quot;J\'ai oubli� mon mot de passe !&quot;, utilisez-le. Dans le cas contraire, contactez l\'administrateur qui vous cr�era un nouveau mot de passe.', 'offline', 0),
  //array('Que dois-je faire si je change d\'adresse e-mail ?', 'Identifiez-vous et changez votre adresse de messagerie dans le menu &quot;Mon profil&quot;', 'offline', 0),
  array('Comment sauvegarder une photo dans &quot;Mes Favoris&quot; ?', 'Cliquez sur une image. Si les informations de cette image ne sont pas indiqu�es au bas de celle-ci, cliquez sur le lien &quot;Afficher/cacher les informations de l\'image&quot; (<img src="images/info.gif" width="16" height="16" border="0" alt="Afficher/cacher les informations de l\'image" />); Cliquez ensuite sur le lien &quot;Ajouter aux favoris&quot;.<br /><br />IMPORTANT : Vous devez autoriser les cookies et le cookie ne doit pas �tre effac� pour que cette option fonctionne.', 'offline', 0),
  array('Comment noter une photo ?', 'Cliquez sur une image et cliquez sur la note que vous souhaitez lui attribuer, au-dessous de l\'image', 'offline', 0),
  array('Comment poster un commentaire sur une photo ?', 'Cliquez sur une image et tapez votre commentaire au-dessous de l\'image, sous la ligne &quot;Ajoutez votre commentaire&quot;.', 'offline', 0),
  array('Comment uploader une photo ?', 'Cliquez sur &quot;Uploader une image&quot; et s�lectionnez l\'album dans lequel vous souhaitez qu\'elle apparaisse. Cliquez sur &quot;Parcourir&quot; pour s�lectionner le fichier � transf�rer. Compl�tez ensuite les champs facultatifs si vous le d�sirez. Enfin, validez par &quot;Mettre une photo en ligne&quot;', 'allow_private_albums', 0),
  array('O� puis-je uploader mes photos ?', 'Vous pourrez uploader vos photos dans l\'un de vos albums dans &quot;Ma galerie&quot;. L\'administrateur peut aussi vous avoir autoris� � uploader des photos dans un ou plusieurs albums dans la galerie principale.', 'allow_private_albums', 0),
  array('Quels types et tailles d\'images puis-je uploader ?', 'La taille et le type (jpg,gif,..etc.) est d�fini par l\'administrateur. Vous pouvez lui en demander la liste.', 'offline', 0),
  array('Que signifie &quot;Ma galerie&quot; ?', '&quot;Ma galerie&quot; est une galerie personnelle dans laquelle les utilisateurs peuvent uploader et organiser leurs photos.', 'allow_private_albums', 0),
  array('Comment puis-je cr�er, renommer ou supprimer des albums dans &quot;Ma Galerie&quot; ?', 'Vous devez auparavant entrer dans le &quot;Mode admin.&quot;<br/>Cliquez ensuite sur &quot;Cr�er / classer mes Albums&quot;puis cliquez sur &quot;Nouveau&quot;. Remplacez &quot;New Album&quot; � votre convenance.<br />Vous pouvez aussi renommer vos albums dans votre galerie.<br />Cliquez ensuite sur &quot;Appliquer les Modifications&quot;.', 'allow_private_albums', 0),
  array('Comment puis-je modifier ou restreindre l\'acc�s � mes albums ?', 'Vous devez auparavant entrer dans le &quot;Mode admin.&quot;<br />Cliquez ensuite sur &quot;Modifier mes albums&quot;. Dans la zone &quot;Mettre l\'album � jour&quot; s�lectionnez l\'album que vous souhaitez modifier.<br />Vous pouvez modifier le nom, la description, la vignette, restreindre l\'acc�s, les options concernant les notes et les commentaires.<br />Cliquez sur &quot;Mettre l\'album � jour&quot;. pour valider', 'allow_private_albums', 0),
  array('Comment puis-je voir les albums des autres utilisateurs ?', 'Allez sur &quot;Liste des albums&quot; et choisissez &quot;Galeries utilisateurs&quot;.', 'allow_private_albums', 0),
  array('Que sont les cookies ?', 'Les cookies sont des fichiers texte contenant des param�tres du site et de votre pseudo. Ces cookies sont stock�es dans votre ordinateur.<br />Ils vous apportent la possibilit� d\'entrer et sortir du site sans avoir � vous identifier, ainsi que d\'autres facilit�s.', 'offline', 0),
  array('O� puis-je me procurer cette galerie pour mon site ?', 'Coppermine est une Galerie multim�dia gratuite, sous licence GNU GPL. Elle comprend de nombreuses fonctions avanc�es et est port�e sur plusieurs plateformes. Visitez le site <a href="http://coppermine.sf.net/" target="_blank">Page principale Coppermine</a> pour en savoir plus et proc�der � son t�l�chargement.', 'offline', 0),

  '<br>Navigation dans le site<br>',
  array('Qu\'est-ce-que &quot;Liste des albums&quot; ?', 'Cela vous redirigera vers la galerie principale avec un lien vers chaque cat�gorie. Ces liens peuvent �tre sous forme de vignettes.', 'offline', 0),
  array('Qu\'est-ce-que &quot;Ma galerie&quot; ?', 'Cette fonctionnalit� vous permet de cr�er vos propres albums et d\'y uploader et g�rer vos photos.', 'allow_private_albums', 0),
  array('Quelle est la diff�rence entre le &quot;Mode admin.&quot; et le &quot;Mode utilisateur&quot; ?', 'Le &quot;Mode admin.&quot; vous permet de modifier vos albums ainsi que tous les albums pour lesquels vous aurez �t� habilit� par l\'administrateur.', 'allow_private_albums', 0),
  array('Qu\'est-ce-que &quot;Uploader une image&quot; ?', 'Cette fonctionnalit� vous permet d\'uploader des photos (dont la taille et le type sont d�finis par l\'administrateur) dans les galeries et albums pour lesquels vous aurez �t� habilit� par l\'administrateur.', 'allow_private_albums', 0),
  array('Qu\'est-ce-que &quot;Derniers ajouts&quot; ?', 'Cette fonctionnalit� vous montre les derni�res photos upload�es sur le site.', 'offline', 0),
  array('Qu\'est-ce-que &quot;Commentaires&quot; ?', 'Cette fonctionnalit� vous montre les derniers commentaires post�s par les utilisateurs du site.', 'offline', 0),
  array('Qu\'est-ce-que &quot;Les plus populaires&quot; ?', 'Cette fonctionnalit� vous montre les photos les plus vues par les visiteurs, identifi�s ou anonymes.', 'offline', 0),
  array('Qu\'est-ce-que &quot;Les mieux not�es&quot; ?', 'Cette fonctionnalit� vous montre les photos, tri�es par leur note moyenne. Par exemples : <br />- Si 5 utilisateurs donnent chacun la note 3 (<img src="images/rating3.gif" width="65" height="14" border="0" alt="" />), la photo obtient la note moyenne de 3 (<img src="images/rating3.gif" width="65" height="14" border="0" alt="" />).<br />- Si 5 utilisateurs donnent les notes 1, 2, 3, 4 et 5, la photo obtient une moyenne de 3 �galement (<img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> ).<br />Les notes vont de <img src="images/rating5.gif" width="65" height="14" border="0"/> (meilleure) to <img src="images/rating0.gif" width="65" height="14" border="0" /> (moins bonne).', 'offline', 0),
  array('Qu\'est-ce-que &quot;Mes favoris&quot; ?', 'Cette fonctionnalit� vous permet de stocker une ou plusieurs photos dans le cookie qui est stock� dans votre ordinateur.', 'offline', 0),
);

// ------------------------------------------------------------------------- //
// File forgot_passwd.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FORGOT_PASSWD_PHP')) $lang_forgot_passwd_php = array(
  'forgot_passwd' => 'Rappel de Mot de passe',
  'err_already_logged_in' => 'Vous �tes d�j� identifi� !',
  'enter_username_email' => 'Saisissez votre pseudo ou votre adresse de messagerie',
  'submit' => 'Envoyer',
  'failed_sending_email' => 'Le mot de passe n\'a pas pu �tre envoy� !',
  'email_sent' => 'Un message a �t� envoy� avec votre mot de passe � l\'adresse %s',
  'err_unk_user' => 'L\'utilisateur indiqu� n\'existe pas !',
  'passwd_reminder_subject' => '%s - Rappel de Mot de passe',
  'passwd_reminder_body' => 'Vous avez demand� que votre mot de passe vous soit rappel�. Voici donc vos donn�es de connexion :
Utilisateur: %s
Mot de passe : %s
Cliquez sur %s pour vous identifier.',
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
  'group_name' => 'Nom du groupe',
  'disk_quota' => 'Quota disque',
  'can_rate' => 'Peut noter les images',
  'can_send_ecards' => 'Peut envoyer des cartes �lectroniques',
  'can_post_com' => 'Peut �crire des commentaires',
  'can_upload' => 'Peut mettre des photos en ligne',
  'can_have_gallery' => 'Peut avoir une galerie perso',
  'apply' => 'Appliquer les modifications',
  'create_new_group' => 'Cr�er un nouveau groupe',
  'del_groups' => 'Supprimer le(s) groupe(s) s�lectionn�(s)',
  'confirm_del' => 'Attention, lorsque vous supprimez un groupe, les utilisateurs de ce groupe seront transf�r�s dans le groupe d\'utilisateurs \'Enregistr�\'!\n\nSouhaitez-vous continuer?',
  'title' => 'G�rer les groupes d\'utilisateurs',
  'approval_1' => 'Autorisation d\'upload pub. (1)',
  'approval_2' => 'Autorisation d\'upload priv. (2)',
  'upload_form_config' => 'Formulaire de configuration d\'upload',
  'upload_form_config_values' => array( 'Un seul fichier uniquement', 'Plusieurs fichiers uniquement', 'Uploads URI seulement', 'Uploads ZIP seulement', 'Fichier-URI', 'Fichier-ZIP', 'Fichier-ZIP', 'Fichier-URI-ZIP'),
  'custom_user_upload'=>'Les utilisateurs peuvent-ils modifier le nombre de t�l�chargements ?',
  'num_file_upload'=>'Nombre Maximum/exact de t�l�chargement de fichiers',
  'num_URI_upload'=>'Nombre Maximum/exact de t�l�chargements de URI',
  'note1' => '<b>(1)</b> Les uploads dans un album public doivent �tre approuv�s par un administrateur',
  'note2' => '<b>(2)</b> Les uploads dans un album qui appartient � l\'utilisateur doivent �tre approuv�s par un admin',
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
  'stat1' => '<b>[pictures]</b> photos dans <b>[albums]</b> albums et <b>[cat]</b> cat�gories avec <b>[comments]</b> commentaires affich�es <b>[views]</b> fois',
  'stat2' => '<b>[pictures]</b> photos dans <b>[albums]</b> albums affich�es <b>[views]</b> fois',
  'xx_s_gallery' => '%s\'s Galerie',
  'stat3' => '<b>[pictures]</b> photos dans <b>[albums]</b> albums avec <b>[comments]</b> commentaires affich�es <b>[views]</b> fois'
);

$lang_list_users = array(
  'user_list' => 'Liste d\'utilisateurs',
  'no_user_gal' => 'Il n\'y a pas de nouvelle galerie d\'utilisateurs',
  'n_albums' => '%s album(s)',
  'n_pics' => '%s photo(s)'
);

$lang_list_albums = array(
  'n_pictures' => '%s photos',
  'last_added' => ', la derni�re a �t� ajout�e le %s'
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
  'err_already_logged_in' => 'Vous �tes d�j� connect� !',
  'forgot_password_link' => 'J\'ai oubli� mon mot de passe !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
  'logout' => 'D�connexion',
  'bye' => 'Au revoir %s ...',
  'err_not_loged_in' => 'Vous n\'�tes pas identif� !',
);

// ------------------------------------------------------------------------- //
// File phpinfo.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('PHPINFO_PHP')) $lang_phpinfo_php = array(
  'php_info' => 'Infos PHP',
  'explanation' => 'Ceci est le r�sultat g�n�r� par la fonction PHP <a href="http://www.php.net/phpinfo">phpinfo()</a>, affich�e dans Coppermine.',
  'no_link' => 'Permettre � tous de voir vos informations PHP peut �tre un risque important, c\'est pourquoi cette page n\'est accessible qu\'aux administrateurs. Vous ne pouvez pas poster de liens vers cette page � d\'autres utilisateurs, ils se verraient l\'acc�s refus�.',
);


// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
  'upd_alb_n' => 'Mettre � jour l\'album %s',
  'general_settings' => 'Param�tres g�n�raux',
  'alb_title' => 'Titre de l\'album',
  'alb_cat' => 'Cat�gorie de l\'album',
  'alb_desc' => 'Description de l\'album',
  'alb_thumb' => 'vignette de l\'album',
  'alb_perm' => 'Permissions pour cet album',
  'can_view' => 'Cet album peut �tre consult� par',
  'can_upload' => 'Les visiteurs peuvent mettre des photos en ligne',
  'can_post_comments' => 'Les visiteurs peuvent poster des commentaires',
  'can_rate' => 'Les visiteurs peuvent noter les photos',
  'user_gal' => 'Galerie de l\'utilisateur',
  'no_cat' => '* Pas de cat�gorie *',
  'alb_empty' => 'L\'album est vide',
  'last_uploaded' => 'Dernier upload',
  'public_alb' => 'Tout le monde (album public)',
  'me_only' => 'Moi seulement',
  'owner_only' => 'Le propri�taire de l\'album (%s) seulement',
  'groupp_only' => 'Membres du groupe \'%s\'',
  'err_no_alb_to_modify' => 'Il n\'y a pas d\'album modifiable dans la base.',
  'update' => 'Mettre l\'album � jour',
  'notice1' => '(*) en fonction de la configuration des %sgroupes%s', //(do not translate %s!)
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
  'already_rated' => 'Vous aviez d�j� not� cette photo',
  'rate_ok' => 'Votre vote a �t� pris en compte',
  'forbidden' => 'Vous ne pouvez pas noter vos propres photos.',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Bien que les administrateurs de {SITE_NAME} fassent en sorte de supprimer ou modifier toute donn�e � caract�re r�pr�hensible le plus rapidement possible, il est impossible de scruter syst�matiquement l'int�gralit� des contenus. Vous �tes par cons�quent conscient que tous les posts effectu�s sur ce site expriment les points de vue et opinions de leurs auteurs et non ceux des administrateurs ou du webmaster (sauf, �videmment dans le cas des posts effectu�s par ces derniers), qui ne pourront par cons�quent pas �tre consid�r�s comme responsables.
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Vous acceptez de ne poster aucune donn�e � caract�re injurieux, obsc�ne, vulgaire, diffamatoire, mena�ant, sexuel ou tout autre contenu susceptible de violer la loi. Vous acceptez que le webmaster et les mod�rateurs de {SITE_NAME} aient le droit de supprimer ou modifier n'importe quel contenu, si cela leur semble opportun.
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Le droit � l'image est la pr�rogative reconnue � toute personne de s'opposer, � certaines conditions, � ce que des tiers non autoris�s reproduisent et, a fortiori, diffusent son image. Ainsi, pour toute publication de photos montrant des personnes reconnaissables, vous devez, en tant qu'exposant, �tre en possession d'une autorisation de publication. L'autorisation doit �tre expresse et suffisamment pr�cise quant aux modalit�s de diffusion. Vous devez, en tant qu'exposant, pouvoir rapporter la preuve de cet accord expr�s � toute personne qui en ferait la demande. L'absence d'autorisation engage directement votre unique responsabilit�.
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Les droits d'auteur permettent � leur titulaire d'�tre le seul � produire ou reproduire son oeuvre, � la pr�senter au public, � la publier ou � pouvoir octroyer ce droit � quelqu'un d'autre. Ainsi, pour publier des photos, vous devez en �tre l'auteur ou �tre en possession d'une autorisation de publication fournie par l'auteur. Vous devez, en tant qu'exposant, pouvoir rapporter la preuve de cette autorisation � toute personne qui en ferait la demande. L'absence d'autorisation engage directement votre unique responsabilit�.
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Selon le Code de la Propri�t� Intellectuelle du 1er juillet 1992 qui regroupe les lois relatives � la propri�t� intellectuelle, notamment la loi du 11 mars 1957 et la loi du 3 juillet 1985, le droit d'auteur prot�ge les oeuvres sans l'accomplissement de formalit�s. D'autre part, afin d'�viter que d'�ventuels liens puissent �tre faits vers vos photos � partir de sites dont nous ne pouvons contr�ler le contenu, les noms de fichiers de vos photos pourront �tre modifi�s � tout instant et sans pr�avis.
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  En tant qu'utilisateur, vous acceptez que toutes les informations entr�es plus haut et toutes les photographies que vous publiez soient stock�es dans une base de donn�es. Bien que ces informations et photographies ne soient pas communiqu�es � des tiers sans votre consentement, le webmaster et les administrateurs ne peuvent en aucun cas �tre tenus pour responsables dans le cas de tentatives de hack qui pourraient compromettre les donn�es ou permettre l'acc�s ou l'utilisation illicite de vos photographies.
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Ce site utilise des cookies pour stocker des informations sur votre ordinateur. Ces cookies ne servent qu'� am�liorer votre navigation sur ce site. Votre adresse e-mail ne sera utilis�e que pour confirmer les donn�es de votre inscription ainsi que votre mot de passe.<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  En cliquant sur 'J'accepte' ci-dessous, vous acceptez de vous soumettre � ces conditions ainsi qu'� toutes leurs �ventuelles mises � jour.
EOT;

$lang_register_php = array(
  'page_title' => 'inscription d\'utilisateur',
  'term_cond' => 'Conditions g�n�rales d\'inscription',
  'i_agree' => 'J\'accepte',
  'submit' => 'S\'inscrire',
  'err_user_exists' => 'Le nom d\'utilisateur que vous avez entr� existe d�j�, merci de bien vouloir en choisir un autre',
  'err_password_mismatch' => 'Les deux mots de passe ne correspondent pas, merci de les entrer � nouveau',
  'err_uname_short' => 'Le nom d\'utilisateur doit comprendre au moins 2 caract�res',
  'err_password_short' => 'Le mot de passe doit comprendre au moins 2 caract�res',
  'err_uname_pass_diff' => 'Le nom d\'utilisateur et le mot de passe doivent �tre diff�rents',
  'err_invalid_email' => 'L\'adresse e-mail n\'est pas valide',
  'err_duplicate_email' => 'Un autre utilisateur s\'est d�j� enregist� avec l\'adresse e-mail que vous avez entr�e',
  'enter_info' => 'Entrez les informations relatives � votre inscription',
  'required_info' => 'Informations requises',
  'optional_info' => 'Informations optionnelles',
  'username' => 'Nom d\'utilisateur / login',
  'password' => 'Mot de passe',
  'password_again' => 'Entrez � nouveau le mot de passe',
  'email' => 'Email',
  'location' => 'Localisation',
  'interests' => 'Int�r�ts',
  'website' => 'Site web',
  'occupation' => 'Activit�',
  'error' => 'ERREUR',
  'confirm_email_subject' => '%s - Confirmation d\'inscription',
  'information' => 'Informations',
  'failed_sending_email' => 'L\'e-mail de confirmation d\'inscription n\'a pu �tre envoy�!',
  'thank_you' => 'Merci pour votre inscription.<br /><br />Un e-mail contenant les informations sur l\'activation de votre compte vous a �t� envoy� � l\'adresse e-mail que vous nous avez communiqu�e.',
  'acct_created' => 'Votre compte a bien �t� cr�e. Vous pouvez maintenant vous identifier avec votre login et votre mot de passe',
  'acct_active' => 'Votre compte a bien �t� activ�. Vous pouvez maintenant vous identifier avec votre login et votre mot de passe',
  'acct_already_act' => 'Votre compte est d�j� actif!',
  'acct_act_failed' => 'Ce compte ne peut pas �tre activ�!',
  'err_unk_user' => 'L\'utilisateur s�lectionn� n\'existe pas!',
  'x_s_profile' => 'Profil de %s',
  'group' => 'Groupe',
  'reg_date' => 'Date d\'inscription',
  'disk_usage' => 'Utilisation du disque',
  'change_pass' => 'Modifier le mot de passe',
  'current_pass' => 'Mot de passe actuel',
  'new_pass' => 'Nouveau mot de passe',
  'new_pass_again' => 'Nouveau mot de passe (� nouveau)',
  'err_curr_pass' => 'Le mot de passe actuel n\'est pas correct',
  'apply_modif' => 'Appliquer les modifications',
  'change_pass' => 'Changer mon mot de passe',
  'update_success' => 'Votre profil a �t� mis � jour',
  'pass_chg_success' => 'Votre mot de passe a �t� modifi�',
  'pass_chg_error' => 'Votre mot de passe n\'a pas �t� modifi�',
  'notify_admin_email_subject' => '%s - notification d\'inscription',
  'notify_admin_email_body' => 'Un nouvel utilisateur s\'est inscrit dans votre galerie, sous le nom "%s"',
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
  'title' => 'V�rifier les commentaires',
  'no_comment' => 'Il n\'y a pas de commentaire � v�rifier',
  'n_comm_del' => '%s commentaire(s) supprim�(s)',
  'n_comm_disp' => 'Nombre de commentaires � afficher',
  'see_prev' => 'Voir pr�c�dent(s)',
  'see_next' => 'Voir suivant(s)',
  'del_comm' => 'Supprimer les commentaires s�lectionn�s',
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
  'select_dir' => 'S�lectionnez le r�pertoire',
  'select_dir_msg' => 'Cette fonction vous permet d\'ajouter un groupe de photos que vous avez upload� sur votre serveur FTP.<br /><br />S�lectionnez le r�pertoire o� vous avez upload� vos photos',
  'no_pic_to_add' => 'Il n\'y a pas de photo � ajouter',
  'need_one_album' => 'Vous avez besoin d\'au moins un album pour effectuer cette op�ration',
  'warning' => 'Avertissement',
  'change_perm' => 'le script ne peut pas �crire dans ce r�pertoire, vous devez changer ses permissions � 755 ou 777 avant d\'essayer d\'ajouter les photos !',
  'target_album' => '<b>Mettre les photos de &quot;</b>%s<b>&quot; dans </b>%s',
  'folder' => 'R�pertoire',
  'image' => 'Image',
  'album' => 'Album',
  'result' => 'R�sultat',
  'dir_ro' => 'Non inscriptible. ',
  'dir_cant_read' => 'Illisible. ',
  'insert' => 'Ajouter de nouvelles images � la galerie',
  'list_new_pic' => 'Liste des nouvelles images',
  'insert_selected' => 'Ins�rer les photos s�lectionn�es',
  'no_pic_found' => 'Aucune image n\'a �t� trouv�e',
  'be_patient' => 'Soyez patient. Le script a besoin de temps pour mettre les photos en ligne',
  'no_album' => 'Aucun album s�lectionn�',  //cpg1.3.0
  'notes' =>  '<ul>'.
        '<li><b>OK</b> : signifie que l\'image a bien �t� mise en ligne'.
        '<li><b>DP</b> : signifie que la photo existe d�j� dans la base de donn�es'.
        '<li><b>PB</b> : signifie que la photo n\'a pas pu �tre ajout�e, v�rifiez votre configuration et les permissions des r�pertoires dans lesquels les images se trouvent'.
        '<li>Si les signes OK, DP, PB n\'apparaissent pas, cliquez sur l\'image cass�e afin de voir le message d\'erreur g�n�r� par PHP'.
        '<li>Si votre navigateur cesse d\'effectuer la t�che (timeout), cliquez sur le bouton actualiser'.
        '</ul>',
  'select_album' => 'Choisissez un album',
  'check_all' => 'Tout cocher',
  'uncheck_all' => 'Tout d�cocher',
);


// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //

// Void

// ------------------------------------------------------------------------- //
// File banning.php
// ------------------------------------------------------------------------- //

if (defined('BANNING_PHP')) $lang_banning_php = array(
  'title' => 'Bannir des utilisateurs',
  'user_name' => 'Nom d\'utilisateur',
  'ip_address' => 'Adresse IP',
  'expiry' => 'Expire (champs vide signifie que le ban est ind�fini)',
  'edit_ban' => 'Sauvegarder les changements',
  'delete_ban' => 'Supprimer',
  'add_new' => 'Ajouter un nouveau ban',
  'add_ban' => 'Ajouter',
  'error_user' => 'Utilisateur introuvable',
  'error_specify' => 'Vous devez sp�cifier un nom d\'utilisateur ou une adresse IP',
  'error_ban_id' => 'ID Invalide !',
  'error_admin_ban' => 'Vous ne pouvez pas vous bannir !',
  'error_server_ban' => 'Vous ne pouvez pas bannir votre propre serveur...',
  'error_ip_forbidden' => 'Vous ne pouvez pas bannir cette adresse, elle est non routable !',
  'lookup_ip' => 'Traduire cette adresse IP',
  'submit' => 'Envoyer !',
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
  'title' => 'Mettre une photo en ligne',
  'custom_title' => 'Formulaire de requ�te personnalis�e',
  'cust_instr_1' => 'Vous pouvez s�lectionner un nombre personnalis� de boxes d\'uploads, dans la limite list�e ci-dessous.',
  'cust_instr_2' => 'Requ�te de nombre de Boxes',
  'cust_instr_3' => 'Boxes d\'uploads de fichier : %s',
  'cust_instr_4' => 'Boxes d\'uploads URI/URL : %s',
  'cust_instr_5' => 'Boxes d\'uploads URI/URL :',
  'cust_instr_6' => 'Boxes d\'uploads de fichier :',
  'cust_instr_7' => 'Merci de saisir le nombre de chaque type de boxes d\'uploads d�sir�s. Ensuite cliquez sur \'Continuer\'. ',
  'reg_instr_1' => 'Action invalide dans la cr�ation du formulaire.',
  'reg_instr_2' => 'Vous pouvez maintenant uploader vos fichiers en utilisant les cases d\'upload ci-dessous. Le poids des fichiers upload�s de votre fichier vers le serveur ne peut exc�der %s Ko chacun. Les fichiers ZIP upload�s dans les sections \'Upload de fichier\' et \'Upload URI/URL\' resteront compress�s.',
  'reg_instr_3' => 'Si vous souhaitez que le fichier soit d�compress�, vous devez utiliser la case de t�l�chargement fournie dans la zone \'Upload de ZIP d�compressible\'',
  'reg_instr_4' => 'Si vous utilisez la section d\'upload URI/URL, saisissez l\'adresse du fichier de la forme http://www.votre-site.com/images/exemple.jpg',
  'reg_instr_5' => 'Lorsque le formulaire est compl�t�, cliquez sur \'Continuer\'.',
  'reg_instr_6' => 'Upload de ZIP d�compressible :',
  'reg_instr_7' => 'Uploads de fichier :',
  'reg_instr_8' => 'Uploads URI/URL :',
  'error_report' => 'Rapport d\'erreur',
  'error_instr' => 'Le t�l�chargement suivant a g�n�r� des erreurs :',
  'file_name_url' => 'Nom de fichier / URL',
  'error_message' => 'Message d\'erreur',
  'no_post' => 'Fichier non upload� par POST.',
  'forb_ext' => 'Extension de fichier incorrect.',
  'exc_php_ini' => 'Le poids exc�de celui permis par le fichier php.ini.',
   'exc_file_size' => 'Le poids exc�de celui permis par Coppermine.',
  'partial_upload' => 'Upload partiel uniquement.',
  'no_upload' => 'L\'upload ne s\'est pas effectu�.',
  'unknown_code' => 'Code d\'erreur d\'upload PHP inconnu.',
   'no_temp_name' => 'Pas d\'upload - Pas de dossier temporaire.',
  'no_file_size' => 'Pas de donn�es ou donn�es endommag�es',
  'impossible' => 'Impossible � d�placer.',
  'not_image' => 'Pas une image ou image endommag�e',
  'not_GD' => 'Pas une extension GD.',
  'pixel_allowance' => 'Allocation de pixel exc�d�e.',
  'incorrect_prefix' => 'Pr�fixe URI/URL incorrect',
  'could_not_open_URI' => 'Ouverture d\'URI impossible.',
  'unsafe_URI' => 'S�ret� non v�rifiable.',
  'meta_data_failure' => 'Erreur de Meta-donn�es',
  'http_401' => '401 Refus�',
  'http_402' => '402 Paiement requis',
  'http_403' => '403 Interdit',
  'http_404' => '404 Non trouv�',
  'http_500' => '500 Erreur interne au serveur',
  'http_503' => '503 Service indisponible',
  'MIME_extraction_failure' => 'Type MIME ind�termin�.',
  'MIME_type_unknown' => 'Type MIME inconnu',
  'cant_create_write' => 'Cr�ature du fichier impossible.',
  'not_writable' => 'Ecriture dans le fichier impossible.',
  'cant_read_URI' => 'Lecture de l\'URI/URL impossible',
  'cant_open_write_file' => 'Ouverture du fichier de l\'URI impossible.',
  'cant_write_write_file' => 'Ecriture dans le fichier de l\'URI impossible.',
  'cant_unzip' => 'D�zippage impossible.',
  'unknown' => 'Erreur inconnue.',
  'succ' => 'Uploads effectu�s avec succ�s',
  'success' => '%s uploads effectu�s avec succ�s.',
  'add' => 'Cliquez sur \'Continuer\' pour ajouter les fichiers aux albums.',
  'failure' => 'Erreur d\'upload',
  'f_info' => 'Information du fichier',
  'no_place' => 'Le fichier pr�c�dent n\'a pas pu �tre plac�.',
  'yes_place' => 'Le fichier pr�c�dent a �t� plac� avec succ�s',
  'max_fsize' => 'Le poids maximal autoris� pour une image est de %s Ko',
  'album' => 'Album',
  'picture' => 'Photo',
  'pic_title' => 'Titre de la photo',
  'description' => 'Description de la photo',
  'keywords' => 'Mots clefs (s�par�s par des espaces)',
  'err_no_alb_uploadables' => 'Nous sommes d�sol�s, mais il n\'existe pas d\'album dans lequel vous avez le droit d\'uploader des photos',
  'place_instr_1' => 'Merci de placer les fichiers dans les albums maintenant.  Vous pouvez aussi saisir les informations de chaque fichier.',
  'place_instr_2' => 'Plus de fichiers ont besoin d\'�tre plac�s.  Merci de cliquer sur \'Continuer\'.',
  'process_complete' => 'Vous avez plac� tous les fichiers avec succ�s.',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
  'title' => 'G�rer les utilisateurs',
  'name_a' => 'Nom ascendant',
  'name_d' => 'Nom descendant',
  'group_a' => 'Groupe ascendant',
  'group_d' => 'Groupe descendant',
  'reg_a' => 'Date d\'inscription ascendante',
  'reg_d' => 'Date d\'inscription descendante',
  'pic_a' => 'Nombre de photos ascendant',
  'pic_d' => 'Nombre de photos descendant',
  'disku_a' => 'Utilisation espace disque ascendant',
  'disku_d' => 'Utilisation espace disque descendant',
  'lv_a' => 'Derni�re visite ascendante',
  'lv_d' => 'Derni�re visite descendante',
  'sort_by' => 'Classer les utilisateurs par',
  'err_no_users' => 'La table d\'utilisateurs est vide!',
  'err_edit_self' => 'Vous ne pouvez pas modifier votre propre profil, utilisez le lien \'Mon profil\' pour effectuer cette op�ration',
  'edit' => 'EDITER',
  'delete' => 'SUPPRIMER',
  'name' => 'Nom d\'utilisateur',
  'group' => 'Groupe',
  'inactive' => 'Inactif',
  'operations' => 'Op�rations',
  'pictures' => 'Photos',
  'disk_space' => 'Espace utilis� / quota',
  'registered_on' => 'Enregistr� le',
  'last_visit' => 'Derni�re visite',
  'u_user_on_p_pages' => '%d utilisateur(s) sur %d page(s)',
  'confirm_del' => 'Voulez vous vraiment SUPPRIMER cet utilisateur?\\nToutes ses photos et albums seront �galement supprim�s',
  'mail' => 'E-MAIL',
  'err_unknown_user' => 'L\'utilisateur s�lectionn� n\'existe pas!',
  'modify_user' => 'Modifier l\'utilisateur',
  'notes' => 'Commentaires',
  'note_list' => '<li>Si vous ne souhaitez pas modifier le mot de passe actuel, laisse le champs "mot de passe" vide.',
  'password' => 'Mot de passe',
  'user_active' => 'L\'utilisateur est actif',
  'user_group' => 'Groupe de l\'utilisateur',
  'user_email' => 'e-mail de l\'utilisateur',
  'user_web_site' => 'Site web de l\'utilisateur',
  'create_new_user' => 'Cr�er un nouvel utilisateur',
  'user_location' => 'Localisation de l\'utilisateur',
  'user_interests' => 'Centres d\'int�r�t de l\'utilisateur',
  'user_occupation' => 'Activit� de l\'utilisateur',
  'latest_upload' => 'Derniers uploads',
  'never' => 'Jamais',
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
  'title' => 'Redimensionner les photos',
  'what_it_does' => 'Fonctionnalit�s',
  'what_update_titles' => 'Met � jour les titres � partir des noms de fichier',
  'what_delete_title' => 'Supprime les titres',
  'what_rebuild' => 'Reg�n�re les vignettes et les photos redimensionn�es',
  'what_delete_originals' => 'Supprime les photos originales et les remplace par leur version redimensionn�e',
  'file' => 'Fichier',
  'title_set_to' => 'titre chang� en',
  'submit_form' => 'valider',
  'updated_succesfully' => 'modifi� avec succ�s',
  'error_create' => 'ERREUR lors de la cr�ation',
  'continue' => 'Continuer avec plus d\'images',
  'main_success' => 'Le fichier %s est maintenant utilis� comme image principale',
  'error_rename' => 'Erreur lors du changement du nom de %s � %s',
  'error_not_found' => 'Le fichier %s n\'a pas �t� trouv�',
  'back' => 'retour � la page principale',
  'thumbs_wait' => 'Mise � jour des vignettes et/ou images redimensionn�es, merci de patienter...',
  'thumbs_continue_wait' => 'Continuer la mise � jour des vignettes et/ou des images redimensionn�es...',
  'titles_wait' => 'Mise � jour des titres, merci de patienter...',
  'delete_wait' => 'Suppression des titres, merci de patienter...',
  'replace_wait' => 'Suppression des originaux et remplacement de ces derniers par les images redimensionn�es, merci de patienter...',
  'instruction' => 'Instructions rapides',
  'instruction_action' => 'S�lectionnez une action',
  'instruction_parameter' => 'D�finissez les param�tres',
  'instruction_album' => 'S�lectionnez un album',
  'instruction_press' => 'Appuyez sur %s',
  'update' => 'Mettre � jour les vignettes et/ou les photos redimensionn�es',
  'update_what' => 'Ce qui doit �tre mis � jour',
  'update_thumb' => 'Seulement les vignettes',
  'update_pic' => 'Seulement les photos redimensionn�es',
  'update_both' => 'Les vignettes et les images redimensionn�es',
  'update_number' => 'Nombre d\'images trait�es par clic',
  'update_option' => '(essayez de r�duire cette valeur si vous avez des probl�mes de timeout)',
  'filename_title' => 'Nom du fichier / Titre de l\'image',
  'filename_how' => 'Comment le nom du fichier doit-il �tre modifi� ?',
  'filename_remove' => 'Supprimer la fin .jpg et remplacer _ (underscore) par des espaces',
  'filename_euro' => 'Changer 2003_11_23_13_20_20.jpg en 23/11/2003 13:20',
  'filename_us' => 'Changer 2003_11_23_13_20_20.jpg en 11/23/2003 13:20',
  'filename_time' => 'Changer 2003_11_23_13_20_20.jpg en 13:20',
  'delete' => 'Supprimer le titre des photos ou les photos dans leur taille d\'origine',
  'delete_title' => 'Supprimer le titre des photos',
  'delete_original' => 'Supprimer les photos dans leur taille d\'origine',
  'delete_replace' => 'Supprime les images originales en les rempla�ant par les versions redimensionn�es',
  'select_album' => 'S�lectionner un album',
  'delete_orphans' => 'Supprimer les commentaires orphelins (fonctionne pour tous les albums)',
  'orphan_comment' => 'Pas de commentaire ophelin trouv�',
  'delete' => 'Supprimer',
  'delete_all' => 'Supprimer tout',
  'comment' => 'Commentaire : ',
  'nonexist' => 'Li� au fichier non existant # ',
  'phpinfo' => 'Afficher phpinfo',
  'update_db' => 'Mise � jour de la base de donn�es',
  'update_db_explanation' => 'Si vous avez remplac� des fichiers Coppermine, effectu� des modifications ou upgrad� � partir de versions pr�c�dentes de Coppermine, assurez-vous d\'ex�cuter la mise � jour de base de donn�es une fois. Cela cr�era les tables et/ou valeurs de configuration n�cessaires dans la base de donn�es.',
);
?>