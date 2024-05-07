<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.3.0                                            //
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
// $Id: bulgarian.php,v 1.6 2004/12/29 23:06:37 chtito Exp $
// ------------------------------------------------------------------------- //

// info about translators and translated language
$lang_translation_info = array(
  'lang_name_english' => 'Bulgarian',
  'lang_name_native' => '���������',
  'lang_country_code' => 'bg',
  'trans_name'=> 'Mihail Tomoff',
  'trans_email' => 'gallery@starrydreams.com',
  'trans_website' => 'http://www.starrydreams.com/cpg/',
  'trans_date' => '2004-05-29',
);

$lang_charset = 'windows-1251';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('������', '����������', '�������', '�����', '���������', '�����', '������');
$lang_month = array('������', '��������', '����', '�����', '���', '���', '���', '������', '���������', '��������', '�������', '��������');

// Some common strings
$lang_yes = '��';
$lang_no  = '��';
$lang_back = '�����';
$lang_continue = '��������';
$lang_info = '����������';
$lang_error = '������';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%B %d %Y';
$lastcom_date_fmt =  '%d/%m/%y � %H:%M'; //cpg1.3.0
$lastup_date_fmt = '%d %B %Y';
$register_date_fmt = '%d %B %Y';
$lasthit_date_fmt = '%d %B %Y � %I:%M %p'; //cpg1.3.0
$comment_date_fmt =  '%d %B %Y � %I:%M %p'; //cpg1.3.0

// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array(
  'random' => '�������� ������', //cpg1.3.0
  'lastup' => '�������� ��������',
  'lastalb'=> '�������� ������������� ������',
  'lastcom' => '�������� ���������',
  'topn' => '���-�������',
  'toprated' => '���-������ �������',
  'lasthits' => '�������� ������',
  'search' => '��������� �� ���������',
  'favpics'=> '������ ������', //cpg1.3.0
);

$lang_errors = array(
  'access_denied' => '������ ������ �� ���� ��������.',
  'perm_denied' => '������ ���������� �� ���� ��������.',
  'param_missing' => '�������� � ������� ��� ������� ���������.',
  'non_exist_ap' => '��������� �����/���� �� ���������� !', //cpg1.3.0
  'quota_exceeded' => '���������� � ��������� �����<br /><br />����� ����� �� [quota]K, � ������� ��������� �� ��������� [space]K, ���������� �� ���� ���� �� ������� ������� ��.', //cpg1.3.0
  'gd_file_type_err' => '��� ������������ GD ������������ �� ������ �� ���������� ���� JPEG � PNG.',
  'invalid_image' => '������ ����� ������� � �������� � �� ���� �� ���� ��������� �� ������������ GD',
  'resize_failed' => '�� � �������� ����������� �� ������� �������� (thumnail) ��� ����� � ������� �������.',
  'no_img_to_display' => '���� ������ �� ���������',
  'non_exist_cat' => '��������� ��������� �� ����������',
  'orphan_cat' => '����������� ��� �������������� ���������� ���������, ������� ��������� �� ��������� �� �� ���������� ��������!', //cpg1.3.0
  'directory_ro' => '�� ���� �� �� ���� � ������������ \'%s\' , ��������� �� ����� �� ����� �������', //cpg1.3.0
  'non_exist_comment' => '��������� �������� �� ����������.',
  'pic_in_invalid_album' => '������ � � ������������� ����� (%s)!?', //cpg1.3.0
  'banned' => '� ������� �� � ��������� �� ���������� �����.',
  'not_with_udb' => '��������� � ��������� �� �������������� �� Coppermine, ������ � ����������� � �������� �� ������. ����, ����� �� ��������, ��� �� � ���������� � ���� ������������, ��� ��������� ������ �� �� �������� �� �������� �������.',
  'offline_title' => 'Offline', //cpg1.3.0
  'offline_text' => '��������� � offline - ��������� ��-�����', //cpg1.3.0
  'ecards_empty' => '� ������� ���� ������ �� ��������. ��������� ���� ��� ��������� ��������� �� ������������ �������� � �������������� �� coppermine!', //cpg1.3.0
  'action_failed' => '��������� �� �� ���������. Coppermine �� ���� �� � �������.', //cpg1.3.0
  'no_zip' => '������� ���������� �� ��������� �� ZIP ������� �� �� � ���������. �������� �� , ����, ��� �������������� �� Coppermine.', //cpg1.3.0
  'zip_type' => '�� �� � ��������� �� ������� ZIP �������.', //cpg1.3.0
);

$lang_bbcode_help = '�������� ������ ����� �� �� ����� �� �����: <li>[b]<b>Bold</b>[/b]</li> <li>[i]<i>Italic</i>[/i]</li> <li>[url=http://yoursite.com/]Url Text[/url]</li> <li>[email]user@domain.com[/email]</li>'; //cpg1.3.0

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
  'alb_list_title' => '������ � ������',
  'alb_list_lnk' => '������ � ������',
  'my_gal_title' => '����� � ������� �������',
  'my_gal_lnk' => '��������� ��',
  'my_prof_lnk' => '������',
  'adm_mode_title' => '����� �����',
  'adm_mode_lnk' => '����� �����',
  'usr_mode_title' => '������������� �����',
  'usr_mode_lnk' => '���� ����������',
  'upload_pic_title' => '���� ���� � ������', //cpg1.3.0
  'upload_pic_lnk' => '���� ����', //cpg1.3.0
  'register_title' => '������ ������',
  'register_lnk' => '�����������',
  'login_lnk' => '����',
  'logout_lnk' => '�����',
  'lastup_lnk' => '�������� ������',
  'lastcom_lnk' => '�������� ���������',
  'topn_lnk' => '���-�������',
  'toprated_lnk' => '���-������ �������',
  'search_lnk' => '�������',
  'fav_lnk' => '������ ������',
  'memberlist_title' => '������ ������� �� �����������', //cpg1.3.0
  'memberlist_lnk' => '������ � �����������', //cpg1.3.0
  'faq_title' => '����� �������� ������� �� ���������� ������� &quot;Coppermine&quot;', //cpg1.3.0
  'faq_lnk' => '���', //cpg1.3.0
);

$lang_gallery_admin_menu = array(
  'upl_app_lnk' => '���������',
  'config_lnk' => '������������',
  'albums_lnk' => '������',
  'categories_lnk' => '���������',
  'users_lnk' => '�����������',
  'groups_lnk' => '�����',
  'comments_lnk' => '���������', //cpg1.3.0
  'searchnew_lnk' => '������� �� ���', //cpg1.3.0
  'util_lnk' => '����� ��������', //cpg1.3.0
  'ban_lnk' => '��������� �����������',
  'db_ecard_lnk' => '��������', //cpg1.3.0
);

$lang_user_admin_menu = array(
  'albmgr_lnk' => '��������� / ���������� �� �������� ��',
  'modifyalb_lnk' => '������� �� �������� ��',
  'my_prof_lnk' => '������',
);

$lang_cat_list = array(
  'category' => '���������',
  'albums' => '������',
  'pictures' => '�������', //cpg1.3.0
);

$lang_album_list = array(
  'album_on_page' => '%d �����(�) �� %d ��������(�)',
);

$lang_thumb_view = array(
  'date' => '����',
  //��������� �� filename and title
  'name' => '��� �� �����',
  'title' => '��������',
  'sort_da' => '��������� �� ���� ���������',
  'sort_dd' => '��������� �� ���� ���������',
  'sort_na' => '��������� �� ��� ���������',
  'sort_nd' => '��������� �� ��� ���������',
  'sort_ta' => '��������� �� �������� ���������',
  'sort_td' => '��������� �� �������� ���������',
  'download_zip' => '����� ���� Zip ����', //cpg1.3.0
  'pic_on_page' => '%d ����(�) � %d ��������(�)',
  'user_on_page' => '%d ����������(�) �� %d ��������(�)', //cpg1.3.0
);

$lang_img_nav_bar = array(
  'thumb_title' => '������� � ���������� � ��������� ������',
  'pic_info_title' => '������/����� ���������� �� �����', //cpg1.3.0
  'slideshow_title' => 'Slideshow',
  'ecard_title' => '��������� ����� ���� ���������� ��������', //cpg1.3.0
  'ecard_disabled' => '������������ �������� �� ���������',
  'ecard_disabled_msg' => '������ ����� �� ��������� ��������', //js-alert //cpg1.3.0
  'prev_title' => '��. ��������� ����', //cpg1.3.0
  'next_title' => '��. ��������� ����', //cpg1.3.0
  'pic_pos' => '���� %s/%s', //cpg1.3.0
);

$lang_rate_pic = array(
  'rate_this_pic' => '����� ����� ', //cpg1.3.0
  'no_votes' => '(��� ��� �� � ���������)',
  'rating' => '(�������� ������ : %s / 5 �� %s �����)',
  'rubbish' => '�� �������',
  'poor' => '���',
  'fair' => '�����',
  'good' => '�����',
  'excellent' => '�������',
  'great' => '�����',
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
  CRITICAL_ERROR => '�������� ������',
  'file' => '����: ',
  'line' => '���: ',
);

$lang_display_thumbnails = array(
  'filename' => '��� : ',
  'filesize' => '�������� : ',
  'dimensions' => '������� : ',
  'date_added' => '���� �� �������� : ', //cpg1.3.0
);

$lang_get_pic_data = array(
  'n_comments' => '%s ���������',
  'n_views' => '%s ���� ������',
  'n_votes' => '(%s �����)',
);

$lang_cpg_debug_output = array(
  'debug_info' => 'Debug ����������', //cpg1.3.0
  'select_all' => '������ ������', //cpg1.3.0
  'copy_and_paste_instructions' => '��� �� ������� ����� �� ������ �� coppermine , ��������� ���� debug ���������� ��� ������ ���������. ������� ������ ������ �� �������� �  *** ����� �� ������� ����������� ��.', //cpg1.3.0
  'phpinfo' => 'display phpinfo', //cpg1.3.0
);

$lang_language_selection = array(
  'reset_language' => '�� ������������', //cpg1.3.0
  'choose_language' => '������ ����', //cpg1.3.0
);

$lang_theme_selection = array(
  'reset_theme' => '�� ������������', //cpg1.3.0
  'choose_theme' => '������ ����', //cpg1.3.0
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
  'Exclamation' => '�����������',
  'Question' => '������',
  'Very Happy' => '����� ��� �������',
  'Smile' => '�������',
  'Sad' => '����� ���',
  'Surprised' => '������ ���',
  'Shocked' => '������� ���',
  'Confused' => '������� ���',
  'Cool' => '��� �� �',
  'Laughing' => '���� ��',
  'Mad' => '�� �������',
  'Razz' => '����������',
  'Embarassed' => '�������� ���',
  'Crying or Very sad' => '������ ��� ����� �����',
  'Evil or Very Mad' => '��� ��� ����� ���',
  'Twisted Evil' => '��������� ���',
  'Rolling Eyes' => '������� �� ������',
  'Wink' => '�������',
  'Idea' => '���� ����',
  'Arrow' => '�������',
  'Neutral' => '��������� ���',
  'Mr. Green' => '�����-��������',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
  0 => '��������� �� ����� ����� ...',
  1 => '������� � ����� �����...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
  'alb_need_name' => '�������� �� ������� �� ��� !', //js-alert
  'confirm_modifs' => '������� �� ��� �� ������ ���� ������� ?', //js-alert
  'no_change' => '�� ��� ��������� ���� !', //js-alert
  'new_album' => '��� �����',
  'confirm_delete1' => '�������� �� ������ �� �������� ������ ?', //js-alert
  'confirm_delete2' => '\n������ ������� � ��������� �� ����� �������� ������������ !', //js-alert
  'select_first' => '����� �������� �����', //js-alert
  'alb_mrg' => '������� ��������',
  'my_gallery' => '* ��������� �� *',
  'no_category' => '* ��� ��������� *',
  'delete' => '��������',
  'new' => '���',
  'apply_modifs' => '�������',
  'select_category' => '�������� ���������',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
  'miss_param' => '����������� ��������� �� ���������� \'%s\' �� �� �������� !',
  'unknown_cat' => '��������� ��������� �� ���������� � ������ �����',
  'usergal_cat_ro' => '��������� �� ������������� �� ����� �� ����� ������� !',
  'manage_cat' => '���������� �� ���������',
  'confirm_delete' => '�������� �� ������ �� �������� �����������', //js-alert
  'category' => '���������',
  'operations' => '��������',
  'move_into' => '�������� �',
  'update_create' => '�������������/��������� �� ���������',
  'parent_cat' => '���������� ���������',
  'cat_title' => '�������� �� �����������',
  'cat_thumb' => '������� �������� �� �����������', //cpg1.3.0
  'cat_desc' => '�������� �� �����������',
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
  'title' => '������������',
  'restore_cfg' => '�������������� �� ���������� ���������',
  'save_cfg' => '����� �� ������ ������������',
  'notes' => '�������',
  'info' => '����������',
  'upd_success' => '�������������� �� Coppermine �� �������������',
  'restore_success' => '�������������� �� ������������ Coppermine �� ������������',
  'name_a' => '�� ��� ���������',
  'name_d' => '�� ��� ���������',
  'title_a' => '�� �������� ���������',
  'title_d' => '�� �������� ���������',
  'date_a' => '�� ���� ���������',
  'date_d' => '�� ���� ���������',
  'th_any' => '���������� ���������',
  'th_ht' => '��������',
  'th_wd' => '������',
  'label' => '������', //cpg1.3.0
  'item' => '����', //cpg1.3.0
  'debug_everyone' => '�����', //cpg1.3.0
  'debug_admin' => '���� ��������������', //cpg1.3.0
        );

if (defined('CONFIG_PHP')) $lang_config_data = array(
  '���� ���������',
  array('��� �� ���������', 'gallery_name', 0),
  array('�������� �� ���������', 'gallery_description', 0),
  array('Email �� �������������� �� ���������', 'gallery_admin_email', 0),
  array('������� �� ����� \'������ ������\' � ������������ ��������', 'ecards_more_pic_target', 0),
  array('��������� � offline', 'offline', 1), //cpg1.3.0
  array('������� �� ����������', 'log_ecards', 1), //cpg1.3.0
  array('����������� �� ZIP-������� �� ��������', 'enable_zipdownload', 1), //cpg1.3.0

  '����, ���� &amp; Charset',
  array('����', 'lang', 5),
  array('����', 'theme', 6),
  array('��������� �� ������� � �����', 'language_list', 1), //cpg1.3.0
  array('��������� �� ��������� ��������', 'language_flags', 8), //cpg1.3.0
  array('��������� �� &quot;��������&quot; � �������� �����', 'language_reset', 1), //cpg1.3.0
  array('��������� �� ������� � ����', 'theme_list', 1), //cpg1.3.0
  array('��������� �� &quot;��������&quot; � ������� � ����', 'theme_reset', 1), //cpg1.3.0
  array('��������� �� ���', 'display_faq', 1), //cpg1.3.0
  array('��������� �� bbcode �������', 'show_bbcode_help', 1), //cpg1.3.0
  array('Character encoding', 'charset', 4), //cpg1.3.0

  '������ �� ������� � ������',
  array('������ �� �������� ������� (������� ��� %)', 'main_table_width', 0),
  array('���� ���� �� ��������� �� ���������', 'subcat_level', 0),
  array('���� ������ �� ���������', 'albums_per_page', 0),
  array('���� ������ �� ������� �� ������', 'album_list_cols', 0),
  array('������ �� ��������� �������� � �������', 'alb_list_thumb_size', 0),
  array('���������� �� �������� ��������', 'main_page_layout', 0),
  array('��������� �� ������� ������� �������� �� ����� ���� � �����������','first_level',1),

  '������ �� ��������� ��������',
  array('���� ������ � �������� � ������� ��������', 'thumbcols', 0),
  array('���� ������ �� �������� � ������� ��������', 'thumbrows', 0),
  array('�������� ������� �������� �� ���������', 'max_tabs', 10), //cpg1.3.0
  array('��������� �� ��������� (� ���������� ��� ����������) ��� ��������� ��������', 'caption_in_thumbview', 1), //cpg1.3.0
  array('��������� �� ���� �������� ��� ��������� ��������', 'views_in_thumbview', 1), //cpg1.3.0
  array('��������� �� ���� ��������� ��� ��������� ��������', 'display_comment_count', 1),
  array('��������� �� ����������� ����� ����� ��� ��������� ��������', 'display_uploader', 1), //cpg1.3.0
  array('��� �� ������������ �� ��������� �� ���������', 'default_sort_order', 3), //cpg1.3.0
  array('��������� ���� ������� �� �� �� ����� ����� ���� � \'���-������ �������\'', 'min_votes_for_rating', 0), //cpg1.3.0

  '������ �� �������� &amp; ��������� �� �����������',
  array('������ �� ��������� �� ��������� �� ������� (������� ��� %)', 'picture_table_width', 0), //cpg1.3.0
  array('������������ �� ����� �� �� ����� �� ������������', 'display_pic_info', 1), //cpg1.3.0
  array('����������� �� �����������', 'filter_bad_words', 1),
  array('����������� �� ��������� � �����������', 'enable_smilies', 1),
  array('����������� �� ������� �������������� ��������� �� ���� � ��� ���������� (���������� �� flood protection)', 'disable_comment_flood_protect', 1), //cpg1.3.0
  array('���������� ������� �� ����������', 'max_img_desc_length', 0),
  array('���������� ���� ������� �� ����', 'max_com_wlength', 0),
  array('���������� ���� ������ �� ��������', 'max_com_lines', 0),
  array('���������� ������� �� ��������', 'max_com_size', 0),
  array('��������� �� ��������� �����', 'display_film_strip', 1),
  array('���� ������ ��� ��������� �����', 'max_film_strip_items', 0),
  array('����������� �� �������������� �� ��������� �� email', 'email_comment_notification', 1), //cpg1.3.0
  array('�������� �� Slideshow � ����������� (1 ������� = 1000 �����������)', 'slideshow_interval', 0), //cpg1.3.0

  '��������� �� ��������� � ��������� ��������', //cpg1.3.0
  array('�������� �� JPEG ���������', 'jpeg_qual', 0),
  array('���������� ������ �� ��������� �������� <a href="#notice2" class="clickable_option">**</a>', 'thumb_width', 0), //cpg1.3.0
  array('��������� ������ ( ������ ��� �������� ��� ���������� ��������� �� ��������� �������� )<b>**</b>', 'thumb_use', 7),
  array('��������� �� �������� ������','make_intermediate',1),
  array('���������� ������ ��� �������� �� ��������� �����/����� <a href="#notice2" class="clickable_option">**</a>', 'picture_width', 0), //cpg1.3.0
  array('���������� �������� �� ����� ���� (KB)', 'max_upl_size', 0), //cpg1.3.0
  array('���������� ������ ��� �������� �� �������� ������/����� (�������)', 'max_upl_width_height', 0), //cpg1.3.0

  '��������� �� ��������� � ��������� �������� �� ����������', //cpg1.3.0
  array('��������� �� ����� �� ������ ����� �� �������� ����������','show_private',1), //cpg1.3.0
  array('���������� ������� � ������� �� ���������', 'forbiden_fname_char',0), //cpg1.3.0
  //array('Accepted file extensions for uploaded pictures', 'allowed_file_extensions',0), //cpg1.3.0
  array('��������� ������ ������', 'allowed_img_types',0), //cpg1.3.0
  array('��������� ������ �����', 'allowed_mov_types',0), //cpg1.3.0
  array('��������� ������ �����', 'allowed_snd_types',0), //cpg1.3.0
  array('���������� ������ ���������', 'allowed_doc_types',0), //cpg1.3.0
  array('����� �� ��������� �� ������� �� ��������','thumb_method',2), //cpg1.3.0
  array('��� �� ���������� �� ImageMagick \'convert\' (������ /usr/bin/X11/)', 'impath', 0), //cpg1.3.0
  //array('Allowed image types (only valid for ImageMagick)', 'allowed_img_types',0), //cpg1.3.0
  array('����� ��� ImageMagick', 'im_options', 0), //cpg1.3.0
  array('������ �� EXIF ������� � JPEG ���������', 'read_exif_data', 1), //cpg1.3.0
  array('������ IPTC ������� � JPEG ���������', 'read_iptc_data', 1), //cpg1.3.0
  array('���������� � �������� <a href="#notice1" class="clickable_option">*</a>', 'fullpath', 0), //cpg1.3.0
  array('���������� �� ��������������� ������� <a href="#notice1" class="clickable_option">*</a>', 'userpics', 0), //cpg1.3.0
  array('���������� �� ���������� ������ <a href="#notice1" class="clickable_option">*</a>', 'normal_pfx', 0), //cpg1.3.0
  array('���������� �� ��������� �������� <a href="#notice1" class="clickable_option">*</a>', 'thumb_pfx', 0), //cpg1.3.0
  array('����� �� ������������ �� ������������', 'default_dir_mode', 0), //cpg1.3.0
  array('����� �� ������������ �� ���������', 'default_file_mode', 0), //cpg1.3.0

  '��������� �� �������������',
  array('����������� �� ����������� �� ���� �����������', 'allow_user_registration', 1),
  array('������������� �� ����������� ������� ������������ �� email', 'reg_requires_valid_email', 1),
  array('����������� �� �������������� �� email �� ����������� �� ����������', 'reg_notify_admin_email', 1), //cpg1.3.0
  array('����������� �� ����� ����������� �� ���� ���� � ��� email', 'allow_duplicate_emails_addr', 1),
  array('������������� ����� �� ���� ������ ������ (���.: ��� ����������� �� \'��\' �� \'��\' ������ ������� ������ ������ �� ������ ��������)', 'allow_private_albums', 1), //cpg1.3.0
  array('����������� �� �������������� �� ������ ������� ������ ����������', 'upl_notify_admin_email', 1), //cpg1.3.0
  array('����������� �� ��������� ����������� �� ������ �������������� ������', 'allow_memberlist', 1), //cpg1.3.0

  '������������ ������ �� �������� �� �������� (�������� ������ ��� ���� �� �� ����������)',
  array('���� 1', 'user_field1_name', 0),
  array('���� 2', 'user_field2_name', 0),
  array('���� 3', 'user_field3_name', 0),
  array('���� 4', 'user_field4_name', 0),

  '��������� �� Cookies',
  array('��� �� cookie-�� ���������� �� ������� (������ �� �������� bbs �����������, ���������� �� �� ��������� �� cookie-�� �� bbs-�)', 'cookie_name', 0),
  array('��� �� cookie-�� ���������� �� �������', 'cookie_path', 0),

  '����� ���������',
  array('����������� �� debug �����', 'debug_mode', 9), //cpg1.3.0
  array('��������� �� ��������� � debug �����', 'debug_notice', 1), //cpg1.3.0

  '<br /><div align="left"><a name="notice1"></a>(*) ���� ��������� �� ������ �� �� ������� ��� ���� ����� ������� � ������ �����.<br />
  <a name="notice2"></a>(**) ������ ��������� ���� ���������, ���� ���������, ����� �� �������� �� ���� ������ ������� �� ����� �������� �� ���, ���� �� � �������������� �� �� � ��������� ��� ���� ����� ������� � ���������. ��� ���, ��� ������� ���� �� ��������� ��������� � ����� ������� ������� ���� ����������  &quot;<a href="util.php">������������������ ��������</a> (��������� �� ������ �� ������)&quot; �� ������������������ ����.</div><br />', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File db_ecard.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('DB_ECARD_PHP')) $lang_db_ecard_php = array(
  'title' => '��������� �� ��������', //cpg1.3.0
  'ecard_sender' => '�������', //cpg1.3.0
  'ecard_recipient' => '���������', //cpg1.3.0
  'ecard_date' => '����', //cpg1.3.0
  'ecard_display' => '��������� �� ��������', //cpg1.3.0
  'ecard_name' => '���', //cpg1.3.0
  'ecard_email' => 'Email', //cpg1.3.0
  'ecard_ip' => 'IP #', //cpg1.3.0
  'ecard_���������' => '���������', //cpg1.3.0
  'ecard_���������' => '���������', //cpg1.3.0
  'ecard_sorted' => '���������', //cpg1.3.0
  'ecard_by_date' => '�� ����', //cpg1.3.0
  'ecard_by_sender_name' => '�� ��� �� �������', //cpg1.3.0
  'ecard_by_sender_email' => '�� ���������� email', //cpg1.3.0
  'ecard_by_sender_ip' => '�� ��� �� ���������� IP �����', //cpg1.3.0
  'ecard_by_recipient_name' => '�� ��� �� ���������', //cpg1.3.0
  'ecard_by_recipient_email' => '�� ������������ email', //cpg1.3.0
  'ecard_number' => '��������� �� ������ %s �� %s �� %s', //cpg1.3.0
  'ecard_goto_page' => '������� �� ��������', //cpg1.3.0
  'ecard_records_per_page' => '������ �� ��������', //cpg1.3.0
  'check_all' => '��������� �� ������', //cpg1.3.0
  'uncheck_all' => '�����������', //cpg1.3.0
  'ecards_delete_selected' => '��������� �� ��������� ��������', //cpg1.3.0
  'ecards_delete_confirm' => '������� �� ��� �� ������ �� �������� ��������? ���������� ���������!', //cpg1.3.0
  'ecards_delete_sure' => '������� ���', //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
  'empty_name_or_com' => '������ �� �������� ��� � ��������',
  'com_added' => '���������� �� �� �������',
  'alb_need_title' => '������ �� ������ �������� �� ������ !',
  'no_udp_needed' => '���� ����� �� ������������.',
  'alb_updated' => '������� �� ������������',
  'unknown_album' => '��������� ����� �� ���������� ��� ��� ������ ���������� �� ������� � ����',
  'no_pic_uploaded' => '�� �� ����� ���� ���� ���� !<br /><br />��� �������� ��� �������  ���� �� �������, ��������� ���� ������� ��������� ������� �� �������...', //cpg1.3.0
  'err_mkdir' => '����������� �� ���������� %s �� ���������  !',
  'dest_dir_ro' => '�������� ���������� %s �� ��������� ������ �� ������� !',
  'err_move' => '������������� �� %s � %s ���������� !',
  'err_fsize_too_large' => '�������� �� �����, ����� ������� � ������ ����� (�������� ��������� ������� %s x %s) !', //cpg1.3.0
  'err_imgsize_too_large' => '�������� �� �����, ����� ������� � ������ ����� (�������� ��������� ������ %s KB) !',
  'err_invalid_img' => '������, ����� ������� � � ��������� ������ !',
  'allowed_img_types' => '������ �� ������ ���� %s ������.',
  'err_insert_pic' => '������ \'%s\' �� ���� �� ���� ������� � ������ ', //cpg1.3.0
  'upload_success' => '������ �� �� ����� �������<br /><br />�� ����� ����� ���� ��������� �� ��������������.', //cpg1.3.0
  'notify_admin_email_subject' => '%s - Upload notification', //cpg1.3.0
  'notify_admin_email_body' => '������, ������ �� %s �� ������ �� ����������� ��. �������� %s', //cpg1.3.0
  'info' => '����������',
  'com_added' => '�� ������� ��������',
  'alb_updated' => '������� �� ������������',
  'err_comment_empty' => '���������� �� � ������ !',
  'err_invalid_fext' => '���� ������� ��� �������� ���������� �� ������� : <br /><br />%s.',
  'no_flood' => '���������� �� ��� ��� ����� ���� �� ��������� ����� ��������.<br /><br />������ ��� ������ �� ������������ ���� ������� ��������', //cpg1.3.0
  'redirect_msg' => '������������.<br /><br /><br />��������� \'����������\' ��� ���������� �� �� ��������� �����������',
  'upl_success' => '������ �� �� ������� �������', //cpg1.3.0
  'email_comment_subject' => 'Comment posted on Coppermine Photo Gallery', //cpg1.3.0
  'email_comment_body' => '����� � ������� �������� � ��������� ��. ����� �� ��', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
  'caption' => '���������',
  'fs_pic' => '����� � ��� ������',
  'del_success' => '������� ������',
  'ns_pic' => '����� � �������� ������',
  'err_del' => '�� ���� �� ���� ������',
  'thumb_pic' => '������� ��������',
  'comment' => '��������',
  'im_in_alb' => '����� � ������',
  'alb_del_success' => '������� \'%s\' �� ������',
  'alb_mgr' => '������� ��������',
  'err_invalid_data' => '��������� ���������� �� ������ � \'%s\'',
  'create_alb' => '��������� �� ����� \'%s\'',
  'update_alb' => '������������� �� ����� \'%s\' ��� �������� \'%s\' � ������ \'%s\'',
  'del_pic' => '��������� �� ����', //cpg1.3.0
  'del_alb' => '��������� �� �����',
  'del_user' => '��������� �� ����������',
  'err_unknown_user' => '��������� ���������� �� ���������� !',
  'comment_deleted' => '���������� ������� �� ������',
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
  'confirm_del' => '������� �� ��� �� ������ �� �������� ���� ���� ? \\n����������� ���� �� ����� �������.', //js-alert //cpg1.3.0
  'del_pic' => '��������� �� �����', //cpg1.3.0
  'size' => '%s x %s �������',
  'views' => '%s ����',
  'slideshow' => 'Slideshow',
  'stop_slideshow' => '���� �����',
  'view_fs' => '��������� �� �� ������ �������� ���������',
  'edit_pic' => '����������� �� ��������', //cpg1.3.0
  'crop_pic' => '��������� � ��������', //cpg1.3.0
);

$lang_picinfo = array(
  'title' =>'���������� �� �����', //cpg1.3.0
  'Filename' => '���',
  'Album name' => '�����',
  'Rating' => '������ ( %s ����(�) )',
  'Keywords' => '������� ����',
  'File Size' => '������ �� �����',
  'Dimensions' => '�������',
  'Displayed' => '�������',
  'Camera' => '������',
  'Date taken' => '���� �� ���������',
  'Aperture' => '��������',
  'Exposure time' => '������������� �����',
  'Focal length' => '������� ����������',
  'Comment' => '��������',
  'addFav'=>'������ ��� ������', //cpg1.3.0
  'addFavPhrase'=>'������', //cpg1.3.0
  'remFav'=>'����� �� ������ ������', //cpg1.3.0
  'iptcTitle'=>'IPTC ��������', //cpg1.3.0
  'iptcCopyright'=>'IPTC Copyright', //cpg1.3.0
  'iptcKeywords'=>'IPTC ������� ����', //cpg1.3.0
  'iptcCategory'=>'IPTC ���������', //cpg1.3.0
  'iptcSubCategories'=>'IPTC ������������', //cpg1.3.0
);

$lang_display_comments = array(
  'OK' => 'OK',
  'edit_title' => '������������ ���������',
  'confirm_delete' => '������� �� ��� �� ������ �� �������� ��������� ?', //js-alert
  'add_your_comment' => '�������� ��������',
  'name'=>'���',
  'comment'=>'��������',
  'your_name' => '��������',
);

$lang_fullsize_popup = array(
  'click_to_close' => '��������� ����� ������ �� �� ��������� ���������',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
  'title' => '��������� �� ���������� ��������',
  'invalid_email' => '<b>��������������</b> : ��������� email ����� !',
  'ecard_title' => '���������� �������� �� ��� �� %s',
  'error_not_image' => '���� ������ ����� �� ����� ������� ���� ��������.', //cpg1.3.0
  'view_ecard' => '��� ���������� �� �� ������� ��������, ��������� ����� ���� ����',
  'view_more_pics' => '��������� ����� ����� �� �� ������ ��� �������� !',
  'send_success' => '���������� �� �� �������',
  'send_failed' => '���������� �� �������� �� �� ���� �� ����� ���������� ��...',
  'from' => '��',
  'your_name' => '����� ��',
  'your_email' => 'Email ������� ��',
  'to' => 'To',
  'rcpt_name' => '��� �� ����������',
  'rcpt_email' => 'Email ����� �� ����������',
  'greetings' => '������������',
  'message' => '���������',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
  'pic_info' => '���������� ��&nbsp;�����', //cpg1.3.0
  'album' => '�����',
  'title' => '��������',
  'desc' => '��������',
  'keywords' => '������� ����',
  'pic_info_str' => '%s ����; %s - %s KB - %s ������������ - %s �����',
  'approve' => '��������� �� ����', //cpg1.3.0
  'postpone_app' => '�������� �� ������������',
  'del_pic' => '��������� �� �����', //cpg1.3.0
  'read_exif' => '��������� �� EXIF ������������ ������', //cpg1.3.0
  'reset_view_count' => '�������� �� ������ �� ��������������',
  'reset_votes' => '�������� �� ���������',
  'del_comm' => '��������� �� ���������',
  'upl_approval' => '��������� �� ������ �������',
  'edit_pics' => '����������� �� �������', //cpg1.3.0
  'see_next' => '����� ���������� �������', //cpg1.3.0
  'see_prev' => '����� ���������� �������', //cpg1.3.0
  'n_pic' => '%s �����', //cpg1.3.0
  'n_of_pic_to_disp' => '���� ������� �� ���������', //cpg1.3.0
  'apply' => '��������� �����������', //cpg1.3.0
  'crop_title' => 'Coppermine Picture Editor', //cpg1.3.0
  'preview' => '������������� �������', //cpg1.3.0
  'save' => '����� �� ������', //cpg1.3.0
  'save_thumb' =>'��������� ���� ������� ��������', //cpg1.3.0
  'sel_on_img' =>'���������� ������ �� ���� ������ ��� ������!', //js-alert //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File faq.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FAQ_PHP')) $lang_faq_php = array(
  'faq' => '����� �������� �������', //cpg1.3.0
  'toc' => 'Table of contents', //cpg1.3.0
  'question' => 'Question: ', //cpg1.3.0
  'answer' => 'Answer: ', //cpg1.3.0
);

if (defined('FAQ_PHP')) $lang_faq_data = array(
  'General FAQ', //cpg1.3.0
  array('Why do I need to register?', 'Registration may or may not be required by the administrator. Registration gives a member additional features such as uploading, having a favorite list, rating pictures and posting comments etc.', 'allow_user_registration', '0'), //cpg1.3.0
  array('How do I register?', 'Go to &quot;Register&quot; and fill out the required fields (and the optional ones if you want to).<br />If the Administrator has Email Activation enabled ,then after submitting your information you should recieve an email message at the address that you have submitted while registering, giving you instructions on how to activate your membership. Your membership must be activated in order for you to login.', 'allow_user_registration', '1'), //cpg1.3.0
  array('How Do I login?', 'Go to &quot;Login&quot;, submit your username and password and check &quot;Remember Me&quot; so you will be logged in on the site if you should leave it.<br /><b>IMPORTANT:Cookies must be enabled and the cookie from this site must not be deleted in order to use &quot;Remember Me&quot;.</b>', 'offline', 0), //cpg1.3.0
  array('Why can I not login?', 'Did you register and click the link that was sent to you via email?. The link will activate your account. For other login problems contact the site administrator.', 'offline', 0), //cpg1.3.0
  array('What if I forgot my password?', 'If this site has a &quot;Forgot password&quot; link then use it. Other than that contact the site administrator for a new password.', 'offline', 0), //cpg1.3.0
  //array('What if I changed my email address?', 'Just simply login and change your email address through &quot;Profile&quot;', 'offline', 0), //cpg1.3.0
  array('How do I save a picture to &quot;My Favorites&quot;?', 'Click on a picture and click on the &quot;picture info&quot; link (<img src="images/info.gif" width="16" height="16" border="0" alt="Picture information" />); scroll down to the picture information set and click &quot;Add to fav&quot;.<br />The administrator may have the &quot;picture information&quot; on by default.<br />IMPORTANT:Cookies must be enabled and the cookie from this site must not be deleted.', 'offline', 0), //cpg1.3.0
  array('How do I rate a file?', 'Click on a thumbnail and go to the bottom and choose a rating.', 'offline', 0), //cpg1.3.0
  array('How do I post a comment for a picture?', 'Click on a thumbnail and go to the bottom and post a comment.', 'offline', 0), //cpg1.3.0
array('How do I upload a file?', 'Go to &quot;Upload&quot;and select the album that you want to upload to, click &quot;Browse&quot; and find the file to upload and click &quot;open&quot; (add a title and description if you want to) and click &quot;Submit&quot;', 'allow_private_albums', 0), //cpg1.3.0
  array('Where do I upload a picture to?', 'You will be able to upload a file to one of your albums in &quot;My Gallery&quot;. The Administrator may also allow you to upload a file to one or more of the albums in the Main Gallery.', 'allow_private_albums', 0), //cpg1.3.0
  array('What type and size of a file can I upload?', 'The size and type (jpg, png, etc.) is up to the administrator.', 'offline', 0), //cpg1.3.0
  array('What is &quot;My Gallery&quot;?', '&quot;My Gallery&quot; is a personal gallery that the user can upload to and manage.', 'allow_private_albums', 0), //cpg1.3.0
  array('How do I create, rename or delete an album in &quot;My Gallery&quot;?', 'You should already be in &quot;Admin-Mode&quot;<br />Go to &quot;Create/Order My Albums&quot;and click &quot;New&quot;. Change &quot;New Album&quot; to your desired name.<br />You can also rename any of the albums in your gallery.<br />Click &quot;Apply Modifications&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('How can I modify and restrict users from viewing my albums?', 'You should already be in &quot;Admin Mode&quot;<br />Go to &quot;Modify My Albums. On the &quot;Update Album&quot; bar, select the album that you want to modify.<br />Here, you can change the name, description, thumbnail picture, restrict viewing and comment/rating permissions.<br />Click &quot;Update Album&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('How can I view other users\' galleries?', 'Go to &quot;Album List&quot; and select &quot;User Galleries&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('What are cookies?', 'Cookies are a plain text piece of data that is sent from a website and is put on to your computer.<br />Cookies usually allow a user to leave and return to the site without having to login again and other various chores.', 'offline', 0), //cpg1.3.0
  array('Where can I get this program for my site?', 'Coppermine is a free Multimedia Gallery, released under GNU GPL. It is full of features and has been ported to various platforms. Visit the <a href="http://coppermine.sf.net/">Coppermine Home Page</a> to find out more or download it.', 'offline', 0), //cpg1.3.0

  'Navigating the Site', //cpg1.3.0
  array('What\'s &quot;Album List&quot;?', 'This will show you the entire category you are currently in, with a link to each album. If you are not in a category, it will show you the entire gallery with a link to each category. Thumbnails may be a link to the category.', 'offline', 0), //cpg1.3.0
  array('What\'s &quot;My Gallery&quot;?', 'This feature lets a user create their own gallery and add,delete or modify albums as well as upload to them.', 'allow_private_albums', 0), //cpg1.3.0
  array('What\'s the difference between &quot;Admin Mode&quot; and &quot;User Mode&quot;?', 'This feature, when in admin-mode, allows a user to modify their gallery (as well as others if allowed by the administrator).', 'allow_private_albums', 0), //cpg1.3.0
  array('What\'s &quot;Upload Picture&quot;?', 'This feature allows a user to upload a file (size and type is set by the site administrator) to a gallery selected by either you or the administrator.', 'allow_private_albums', 0), //cpg1.3.0
  array('What\'s &quot;Last Uploads&quot;?', 'This feature shows the last uploads to the site.', 'offline', 0), //cpg1.3.0
  array('What\'s &quot;Last Comments&quot;?', 'This feature shows the last comments along with the files posted by users.', 'offline', 0), //cpg1.3.0
  array('What\'s &quot;Most Viewed&quot;?', 'This feature shows the most viewed files by all users (whether logged in or not).', 'offline', 0), //cpg1.3.0
  array('What\'s &quot;Top Rated&quot;?', 'This feature shows the top rated files rated by the users, showing the average rating (e.g: five users each gave a <img src="images/rating3.gif" width="65" height="14" border="0" alt="" />: the file would have an average rating of <img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> ;Five users rated the file from 1 to 5 (1,2,3,4,5) would result in an average <img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> .)<br />The ratings go from <img src="images/rating5.gif" width="65" height="14" border="0" alt="best" /> (best) to <img src="images/rating0.gif" width="65" height="14" border="0" alt="worst" /> (worst).', 'offline', 0), //cpg1.3.0
  array('What\'s &quot;My Favorites&quot;?', 'This feature will let a user store a favorite file in the cookie that was sent to your computer.', 'offline', 0), //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// File forgot_passwd.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FORGOT_PASSWD_PHP')) $lang_forgot_passwd_php = array(
  'forgot_passwd' => '��������� �� ������', //cpg1.3.0
  'err_already_logged_in' => '���� ��� ������ !', //cpg1.3.0
  'enter_username_email' => '�������� ��������������� �� ��� ��� email �����', //cpg1.3.0
  'submit' => '�����', //cpg1.3.0
  'failed_sending_email' => '������� � �������� �� ���� �� ���� ������� !', //cpg1.3.0
  'email_sent' => 'Email � ��������������� �� ��� � ������ �� ������ �� %s', //cpg1.3.0
  'err_unk_user' => '��������� ���������� �� ����������!', //cpg1.3.0
  'passwd_reminder_subject' => '%s - Password reminder', //cpg1.3.0
  'passwd_reminder_body' => '��������� �� �� ����� ��������� ������� �� �������:
���: %s
������: %s
��������� %s �� �� ��������.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
  'group_name' => '��� �� �����',
  'disk_quota' => '������� �����',
  'can_rate' => '���� �� ������� �������', //cpg1.3.0
  'can_send_ecards' => '���� �� ����� ��������',
  'can_post_com' => '���� �� ���� ���������',
  'can_upload' => '���� �� ����� �������', //cpg1.3.0
  'can_have_gallery' => '���� �� ��� ����� �������',
  'apply' => '��������� �����������',
  'create_new_group' => '��������� �� ���� �����',
  'del_groups' => '��������� �� ��������� �����',
  'confirm_del' => '��������������, ������ �������� �����, ������������� �� ��� �� ����� ���������� � �������  \'������������\' !\n\n������� �� �� ���������� ?', //js-alert //cpg1.3.0
  'title' => '���������� �� ��������������� �����',
  'approval_1' => '�����. �� ������� � ����. ������ (1)',
  'approval_2' => '�����. �� ������� � ������ ������ (2)',
  'upload_form_config' => '������������ �� ������� �� �������', //cpg1.3.0
  'upload_form_config_values' => array( '�������� ������� ����', '��������� ������� ����', 'URI ����', 'ZIP ����', '����-URI', '����-ZIP', 'URI-ZIP', '����-URI-ZIP'), //cpg1.3.0
  'custom_user_upload'=>'������������ ���� �� �������� ���� �� �������� �� �������?', //cpg1.3.0
  'num_file_upload'=>'��������/����� ���� �� �������� �� ������� �� �������', //cpg1.3.0
  'num_URI_upload'=>'��������/����� ���� �� �������� �� ������� �� URI', //cpg1.3.0
  'note1' => '<b>(1)</b> ��������� � �������� ����� ������� ��������� �� ��������������',
  'note2' => '<b>(2)</b> ��������� � ������, ����� ����������� �� ����������� ������� ��������� �� ��������������',
  'notes' => '�������',
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
  'welcome' => '����� ����� !',
);

$lang_album_admin_menu = array(
  'confirm_delete' => '������� �� ��� �� ������ �� �������� ���� ����� ? \\n������ ������� � ��������� �� ����� �������.', //js-alert //cpg1.3.0
  'delete' => '������',
  'modify' => '��������',
  'edit_pics' => '�������� �� ����', //cpg1.3.0
);

$lang_list_categories = array(
  'home' => '������',
  'stat1' => '<b>[pictures]</b> ����(�) � <b>[albums]</b> �����(�) � <b>[cat]</b> ���������(�) � <b>[comments]</b> ��������(�), �����(�) <b>[views]</b> ���(�)', //cpg1.3.0
  'stat2' => '<b>[pictures]</b> ����(�) � <b>[albums]</b> �����(�), �����(�) <b>[views]</b> ���(�)', //cpg1.3.0
  'xx_s_gallery' => '������� �� %s',
  'stat3' => '<b>[pictures]</b> ����(�) � <b>[albums]</b> �����(a) � <b>[comments]</b> ��������(�), �����(�) <b>[views]</b> ���(�)', //cpg1.3.0
);

$lang_list_users = array(
  'user_list' => '������ � �����������',
  'no_user_gal' => '���� ������������� �������',
  'n_albums' => '%s �����(�)',
  'n_pics' => '%s ����(�)', //cpg1.3.0
);

$lang_list_albums = array(
  'n_pictures' => '%s ����(�)', //cpg1.3.0
  'last_added' => ', ���������� ������� �� %s',
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
  'login' => '����',
  'enter_login_pswd' => '�������� ��� � ������ �� ����',
  'username' => '���',
  'password' => '������',
  'remember_me' => '����� ��',
  'welcome' => '����� ����� %s ...',
  'err_login' => '*** �� ������ �� ��������. �������� ���. ***',
  'err_already_logged_in' => '���� ��� ������ !',
  'forgot_password_link' => '�������� �� ��������', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
  'logout' => '�����',
  'bye' => '���, ��� %s ...',
  'err_not_loged_in' => '�� ��� ������ !',
);

// ------------------------------------------------------------------------- //
// File phpinfo.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('PHPINFO_PHP')) $lang_phpinfo_php = array(
  'php_info' => 'PHP info', //cpg1.3.0
  'explanation' => 'This is the output generated by the PHP-function <a href="http://www.php.net/phpinfo">phpinfo()</a>, displayed within Copermine (trimming the output at the right corner).', //cpg1.3.0
  'no_link' => 'Having others see your phpinfo can be a security risk, that\'s why this page is only visible when you\'re logged in as admin. You can not post a link to this page for others, they will be denied access.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
  'upd_alb_n' => '������������ �� ����� %s',
  'general_settings' => '���� ���������',
  'alb_title' => '�������� �� �����',
  'alb_cat' => '��������� �� �����',
  'alb_desc' => '�������� �� �����',
  'alb_thumb' => '������� �������� �� ������',
  'alb_perm' => '���������� �� ���� �����',
  'can_view' => '������� ���� �� ���� ���������� ���� ��',
  'can_upload' => '������������ ����� �� ������ �������',
  'can_post_comments' => '������������ ����� �� ����� ���������',
  'can_rate' => '������������ ����� �� �������� �������',
  'user_gal' => '������������� �������',
  'no_cat' => '* ��� ��������� *',
  'alb_empty' => '������ �����',
  'last_uploaded' => '�������� ������',
  'public_alb' => '����� (�������� �����)',
  'me_only' => '���� ���',
  'owner_only' => '���� ����������� �� ������ (%s) ',
  'groupp_only' => '��������� �� ������� \'%s\' ',
  'err_no_alb_to_modify' => '���� ���� ����� �� ������ �� ��������� � ������ �����.',
  'update' => '������������ �� �����', //cpg1.3.0
  'notice1' => '(*) ������ �� ����������� �� ������� %sgroups%s ', //cpg1.3.0 (do not translate %s!)
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
  'already_rated' => '���������� �� ���� ��� ������� ���� ����', //cpg1.3.0
  'rate_ok' => '������ �� �� �������',
  'forbidden' => '�� ������ �� ��������� ����������� �� �������.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
������� �� ���������������� �� {SITE_NAME} �� �� ������� �� ��������� ��� ���������� ����� ����������� �������� �������� ���-�����, �� � �������� �� �� ��������� ����� ����. ������ ������ �� �� ��������� � ���� �� ������ ������� � ���� ���� ��������� ���� ���������� ��� �������� �� �������� ��, � �� �� ���������������� ��� ���������� (����� ��������� �� ����������) � ������������ �� ����� �� ����� ��������� �� ���.<br />
<br />
����������� �� �� �� ������� ������, ��������, �������������, ������������� ������, ����������, ���������-����������� ��� ����� ���������, ����� ����� �� ��������� ����������� ������. ����������� �� � �� ����������, �������������� � ������������ �� {SITE_NAME} ���� ������� �� ��������� ��� ���������� ����� ���� �� ����� ����� ������ �� � ������. ���� ���������� ������ ���������� ����� ����������, ����� �������� �� ���� �������� � ���� �����. ������� �� ���� ���������� ���� �� ���� ��������� �� ����� ������ ��� ���������� ��, ����������� � ��������������� �� ����� �� ����� ���������� ��� ����������� �� �������� �����, ����� ����� �� ������������� ������� �� ������ �����.<br />
<br />
������ �������� cookies �� �� ��������� ���������� �� �������� �� ��������. ���� cookies ������ ���� �� �� �������� ������������ �� �� �������������. Email a������ �� �� �� �������� ���� �� ������������ �� ���������������� �� ������� � �� ��������.<br />
<br />
���� ��������� '�������� ���' ������ , �� ����������� � ���� �������.
EOT;

$lang_register_php = array(
  'page_title' => '����������� �� ����������',
  'term_cond' => '�������',
  'i_agree' => '�������� ���',
  'submit' => '��������� �� �����������',
  'err_user_exists' => '��������������� ���, ����� ��� ������ ���� ����������, ���� �������� �����',
  'err_password_mismatch' => '����� ������ �� ��������, �������� ��, ����, ������',
  'err_uname_short' => '��������������� ��� ������ �� � ���� 2 ������� �����',
  'err_password_short' => '�������� ������ �� � ���� 2 ������� �����',
  'err_uname_pass_diff' => '��������������� ��� � �������� ������ �� �� ��������',
  'err_invalid_email' => 'Email ������� � ���������',
  'err_duplicate_email' => '���� ����������� ���� ���������� ��� ����� email, ����� ���������',
  'enter_info' => '������ �������������� ����������',
  'required_info' => '������������ ����������',
  'optional_info' => '�������������� ����������',
  'username' => '������������� ���',
  'password' => '������',
  'password_again' => '�������� ������ ��������',
  'email' => 'Email',
  'location' => '�����',
  'interests' => '��������',
  'website' => '����� ��������',
  'occupation' => '��������/���������',
  'error' => '������',
  'confirm_email_subject' => '%s - Registration confirmation',
  'information' => '����������',
  'failed_sending_email' => '���������������� email �� ������������� �� ���� �� ���� �������� !',
  'thank_you' => '���������� �� �� �������������.<br /><br />Email � ���������� �� ���� ��� �� ���������� ������� �� �� ������ �� email �������, ����� �������.',
  'acct_created' => '�������� �� �� �������� � ���� ������ �� �������� � ������ ��� � ������',
  'acct_active' => '�������� �� ���� � ������� � ������ �� �������� � ����� � �������� ��',
  'acct_already_act' => '�������� �� ���� �� ��������� !',
  'acct_act_failed' => '���� ������ �� ���� �� ���� ��������� !',
  'err_unk_user' => '��������� ���������� �� ���������� !',
  'x_s_profile' => '������ �� %s\'',
  'group' => '�����',
  'reg_date' => '����������� �� ��:',
  'disk_usage' => '���������� ������������',
  'change_pass' => '����� �� ������',
  'current_pass' => '������� ������',
  'new_pass' => '���� ������',
  'new_pass_again' => '���� ������ ������',
  'err_curr_pass' => '���������� ������ � ��������',
  'apply_modif' => '�������',
  'change_pass' => '������� �� �������� ��',
  'update_success' => '�������� �� �� ������������',
  'pass_chg_success' => '�������� �� �� ���������',
  'pass_chg_error' => '�������� �� �� �� ���������',
  'notify_admin_email_subject' => '%s - Registration notification', //cpg1.3.0
  'notify_admin_email_body' => '��� ���������� � ��� "%s" �� ���������� � ��������� ��', //cpg1.3.0
);

$lang_register_confirm_email = <<<EOT
���������� �� �� ������������ � {SITE_NAME}

��������������� �� ��� � : "{USER_NAME}"
�������� �� : "{PASSWORD}"

�� �� ���������� ������� ��, ������ �� �������� ����� ������ ��� �� �� �������� � �������� �������� �� ��� �������� ��.

{ACT_LINK}

� ���-����� ���������,

������ �� {SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
  'title' => '����������� �� �����������',
  'no_comment' => '���� ��������� �� �����������',
  'n_comm_del' => '%s ��������(�) �������',
  'n_comm_disp' => '���� ��������� �� ���������',
  'see_prev' => '��. ����������',
  'see_next' => '��. ����������',
  'del_comm' => '������ ���������',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
  0 => '������� � ����������',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
  'page_title' => '������� �� ���� �������', //cpg1.3.0
  'select_dir' => '�������� ����������',
  'select_dir_msg' => 'This function allows you to add a batch of file that your have uploaded to your server by FTP.<br /><br />Select the directory where you have uploaded your files', //cpg1.3.0
  'no_pic_to_add' => '���� ������� �� ��������', //cpg1.3.0
  'need_one_album' => '������ �� ���� ���� ����� �� �� �������� ���������.',
  'warning' => '��������������',
  'change_perm' => '������� �� ���� �� ���� � ���� ����������, ������ �� ������� ������������ � �� 755 ��� 777 ����� �� �� �������� �� �������� ������� !', //cpg1.3.0
  'target_album' => '<b>������� ��������� �� &quot;</b>%s<b>&quot; � </b>%s', //cpg1.3.0
  'folder' => '�����',
  'image' => '����',
  'album' => '�����',
  'result' => '��������',
  'dir_ro' => '�� ���� �� �� ����. ',
  'dir_cant_read' => '�� ���� �� �� ������� ����� ����. ',
  'insert' => '�������� �� ������� � ���������', //cpg1.3.0
  'list_new_pic' => '������ �� ������ �������', //cpg1.3.0
  'insert_selected' => '�������� ��������� �������', //cpg1.3.0
  'no_pic_found' => '�� �� ������ ��� ����', //cpg1.3.0
  'be_patient' => '������ ���������, ������� ��� ����� �� ����� �� �� ������ ���������', //cpg1.3.0
  'no_album' => '���� ������� ������',  //cpg1.3.0
  '�������' =>  '<ul>'.
                          '<li><b>OK</b> : �������� �� ������ �� ������� �������'.
                          '<li><b>DP</b> : �������� �� ������ � �������� � ���� � � ������ �����'.
                          '<li><b>PB</b> : �������� �� ������ �� ���� �� ���� �������, ��������� �������������� � ������������ �� ������������ ������ �� ����������� ���������'.
                          '<li><b>NA</b> : �������� �� �� ��� ������� �����, � ����� �� ����� ������, ��������� \'<a href="javascript:history.back(1)">�����</a>\' � �������� �����. ��� ������ ����� <a href="albmgr.php">�������� �� �����</a></li>'.
                          '<li>��� ������ OK, DP, PB  �� �� �����, ��������� ����� ��������� ���� �� �� ������ ����������� �� ������ ������ �� PHP'.
                          '<li>��� ��������� �� ����: \' Timeout\', ��������� ������ �� ������������'.
                          '</ul>', //cpg1.3.0
  'select_album' => '�������� �����', //cpg1.3.0
  'check_all' => '�������� ������', //cpg1.3.0
  'uncheck_all' => '��������', //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //

// Void

// ------------------------------------------------------------------------- //
// File banning.php
// ------------------------------------------------------------------------- //

if (defined('BANNING_PHP')) $lang_banning_php = array(
  'title' => '������� �� �����������',
  'user_name' => '������������� ���',
  'ip_address' => 'IP �����',
  'expiry' => '������ ��: (������ � ����������� �� ��������� �������)',
  'edit_ban' => '����� �� ���������',
  'delete_ban' => '���������',
  'add_new' => '�������� �� ���� �������',
  'add_ban' => '��������',
  'error_user' => '�� ���� �� ���� ������ ����������', //cpg1.3.0
  'error_specify' => '������ �� ������ ��� ��� ��� IP �����', //cpg1.3.0
  'error_ban_id' => '��������� ID �� �������!', //cpg1.3.0
  'error_admin_ban' => '�� ������ �� ��������� ��� ���� ��!', //cpg1.3.0
  'error_server_ban' => '����� �� ��������� ���������� �� ������? ���, ���, �� ���� ...', //cpg1.3.0
  'error_ip_forbidden' => '�� ������ �� ��������� ���� IP - �� � routable!', //cpg1.3.0
  'lookup_ip' => '�������� �� IP �����', //cpg1.3.0
  'submit' => '�����!', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
  'title' => '������� �� ����', //cpg1.3.0
  'custom_title' => '����� �� �������', //cpg1.3.0
  'cust_instr_1' => '������ �� �������� �� ������� ���� �� ������ �� �������. �����, �� ���� �� �������� ������ �� �������� �������� ��-����.', //cpg1.3.0
  'cust_instr_2' => '����� ���� ������', //cpg1.3.0
  'cust_instr_3' => '������ �� ������� �� �������: %s', //cpg1.3.0
  'cust_instr_4' => '������ �� ������� �� URI/URL: %s', //cpg1.3.0
  'cust_instr_5' => '������ �� ������� �� URI/URL:', //cpg1.3.0
  'cust_instr_6' => '������ �� ������� �� �������:', //cpg1.3.0
  'cust_instr_7' => '���� �������� ���� ������ �� ����� ��� �� �������, ����� ������ ���� ���. ���� ���� ��������� \'����������\'. ', //cpg1.3.0
  'reg_instr_1' => '��������� �������� ��� ��������� �� �������.', //cpg1.3.0
  'reg_instr_2' => '���� ������ �� ������ ������� ���� ���������� �������� ��-����. �������� �� �������� ������� ������ �� ��� �� ������� �� ������ �� ��������� %s KB �����. ZIP ��������� ������ ���� \'������� �� ����\' � \'������� �� URI/URL\' �������� �� ������� ������������.', //cpg1.3.0
  'reg_instr_3' => '��� ������ zip ����� ��� ������ �� ���� �������������, ������ �� ���������� ������ �� ������� ������ �  \'�������������� ZIP �������\'.', //cpg1.3.0
  'reg_instr_4' => '������ ���������� �������� �� ������� �� URI/URL, ���� �������� ���� ��� ����� �� ���� �����: http://www.mysite.com/images/example.jpg', //cpg1.3.0
  'reg_instr_5' => '���� ���� ��������� �������, ��������� \'����������\'.', //cpg1.3.0
  'reg_instr_6' => '�������������� ZIP �������:', //cpg1.3.0
  'reg_instr_7' => '������� �� �������:', //cpg1.3.0
  'reg_instr_8' => '������� �� URI/URL:', //cpg1.3.0
  'error_report' => '��������� �� ������', //cpg1.3.0
  'error_instr' => '�������� �������� �� ��������� � ������:', //cpg1.3.0
  'file_name_url' => '��� �� ����/URL', //cpg1.3.0
  'error_message' => '��������� �� ������', //cpg1.3.0
  'no_post' => '������ �� �� ����� ���� POST.', //cpg1.3.0
  'forb_ext' => '��������� ������� ����������.', //cpg1.3.0
  'exc_php_ini' => '�������� ������ �� ����� �������� � php.ini.', //cpg1.3.0
  'exc_file_size' => '�������� ������ �� ����� �������� �� CPG.', //cpg1.3.0
  'partial_upload' => '���� �������� �������.', //cpg1.3.0
  'no_upload' => '������� �� �� ������.', //cpg1.3.0
  'unknown_code' => '���������� PHP ������ ��� �������.', //cpg1.3.0
  'no_temp_name' => 'No upload - No temp name.', //cpg1.3.0
  'no_file_size' => '�� ������� �����/��������', //cpg1.3.0
  'impossible' => '�� ���� �� ���� ���������.', //cpg1.3.0
  'not_image' => '�� � �����/��������', //cpg1.3.0
  'not_GD' => '�� � GD ����������.', //cpg1.3.0
  'pixel_allowance' => '�������� ��������� �� ��������� �������.', //cpg1.3.0
  'incorrect_prefix' => '��������� URI/URL ����������', //cpg1.3.0
  'could_not_open_URI' => '�� ���� �� ���� ������� URI.', //cpg1.3.0
  'unsafe_URI' => '�� ���� �� ���� ��������� �������������Safety not verifiable.', //cpg1.3.0
  'meta_data_failure' => 'Meta data failure', //cpg1.3.0
  'http_401' => '401 Unauthorized', //cpg1.3.0
  'http_402' => '402 Payment Required', //cpg1.3.0
  'http_403' => '403 Forbidden', //cpg1.3.0
  'http_404' => '404 Not Found', //cpg1.3.0
  'http_500' => '500 Internal Server Error', //cpg1.3.0
  'http_503' => '503 Service Unavailable', //cpg1.3.0
  'MIME_extraction_failure' => 'MIME could not be determined.', //cpg1.3.0
  'MIME_type_unknown' => 'Unknown MIME type', //cpg1.3.0
  'cant_create_write' => 'Cannot create write file.', //cpg1.3.0
  'not_writable' => 'Cannot write to write file.', //cpg1.3.0
  'cant_read_URI' => '�� ���� �� ���� �������� URI/URL', //cpg1.3.0
  'cant_open_write_file' => 'Cannot open URI write file.', //cpg1.3.0
  'cant_write_write_file' => 'Cannot write to URI write file.', //cpg1.3.0
  'cant_unzip' => '�� ���� �� ���� ������������ zip �����.', //cpg1.3.0
  'unknown' => '���������� ������', //cpg1.3.0
  'succ' => '������� ��������', //cpg1.3.0
  'success' => '%s �������� ���� �������.', //cpg1.3.0
  'add' => '�������� ���� \'����������\' �� �� �������� ��������� ��� ��������.', //cpg1.3.0
  'failure' => '������ ��� �������', //cpg1.3.0
  'f_info' => '���������� �� �����', //cpg1.3.0
  'no_place' => '���������� ���� �� ���� �� ���� ��������.', //cpg1.3.0
  'yes_place' => '���������� ���� ���� �������� �������.', //cpg1.3.0
  'max_fsize' => '���������� �������� �� �������� �� ����� � %s KB',
  'album' => '�����',
  'picture' => '����', //cpg1.3.0
  'pic_title' => '��������', //cpg1.3.0
  'description' => '�������� �� �����', //cpg1.3.0
  'keywords' => '������� ���� (�������� � ���������)',
  'err_no_alb_uploadables' => '����������, �� ���� ������ � ����� �� �� � ��������� �� ������� �������', //cpg1.3.0
  'place_instr_1' => '���� ��������� ��������� � ������. ���� ���� ���� �� ������ � ��������� ���������� �� ����� ���� �� ���.', //cpg1.3.0
  'place_instr_2' => '��� ������� ������ �� ����� ���������. ���� ��������� \'����������\'.', //cpg1.3.0
  'process_complete' => '������� ���������� ������ �������.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
  'title' => '���������� �� �����������',
  'name_a' => '�� ��� ���������',
  'name_d' => '�� ��� ���������',
  'group_a' => '�� ����� ���������',
  'group_d' => '�� ����� ���������',
  'reg_a' => '�� ���� �� ����������� ���������',
  'reg_d' => '�� ���� �� ����������� ���������',
  'pic_a' => '�� ���� ������� ���������',
  'pic_d' => '�� ���� ������� ���������',
  'disku_a' => '�� ���������� �� ����� ���������',
  'disku_d' => '�� ���������� �� ����� ���������',
  'lv_a' => '�� �������� ��������� ���������', //cpg1.3.0
  'lv_d' => '�� �������� ��������� ���������', //cpg1.3.0
  'sort_by' => '��������� �� ������������� ��',
  'err_no_users' => '��������� � ����������� � ������ !',
  'err_edit_self' => '�� ������ �� ����������� ���������� �� ������, ������ ���� ����������� ����� \'������\'',
  'edit' => '��������',
  'delete' => '������',
  'name' => '������������� ���',
  'group' => '�����',
  'inactive' => '���������',
  'operations' => '��������',
  'pictures' => '�������', //cpg1.3.0
  'disk_space' => '���������� ������������ / �����',
  'registered_on' => '����������� ��',
  'last_visit' => '�������� ���������', //cpg1.3.0
  'u_user_on_p_pages' => '%d ����������� �� %d ��������',
  'confirm_del' => '������� �� ��� �� ������ �� �������� ���� ���������� ? \\n������ ������ ������� � ������ �� ����� �������.', //js-alert //cpg1.3.0
  'mail' => '����',
  'err_unknown_user' => '��������� ���������� �� ���������� !',
  'modify_user' => '������� �� ����������',
  'notes' => '�������',
  'note_list' => '<li>��� �� ������ �� ��������� ��������� ������, �������� ������ � "������" ������',
  'password' => '������',
  'user_active' => '������������ � �������',
  'user_group' => '������������� �����',
  'user_email' => '������������� email',
  'user_web_site' => '������������� ��� ����',
  'create_new_user' => '��������� �� ��� ����������',
  'user_location' => '������������� ���������������',
  'user_interests' => '������������� ��������',
  'user_occupation' => '������������� ��������',
  'latest_upload' => '�������� ������ �������', //cpg1.3.0
  'never' => '������', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
  'title' => '���������������� �������� (������� �� ��������� �� ������)', //cpg1.3.0
  'what_it_does' => '����� �����',
  'what_update_titles' => '������� ���������� �� ������� �� ���������',
  'what_delete_title' => '������� ��������',
  'what_rebuild' => '���������� ��������� �������� � ������� ��������� �� ��������',
  'what_delete_originals' => '������� �������������� ������ � �� �������� ��� ������ � ����������� �������',
  'file' => '����',
  'title_set_to' => '�������� ������� ��',
  'submit_form' => '�����',
  'updated_succesfully' => '������������� �������',
  'error_create' => '������ ��� ���������',
  'continue' => '����������� �� ������ ������',
  'main_success' => '������ %s �� ������� ��������� ���� ������ ����', //cpg1.3.0
  'error_rename' => '������ ��� �������������� �� %s � %s',
  'error_not_found' => '������ %s �� �� ������',
  'back' => '������� � �������� ��������',
  'thumbs_wait' => '������������ �� ������� �������� �/��� ������ � ��������� �������, ���� ���������...',
  'thumbs_continue_wait' => '����������� �� �� ������������ ������� �������� �/��� ������ � ��������� �������...',
  'titles_wait' => '������������ �� �������, ���� ���������...',
  'delete_wait' => '������ �� ��������, ���� ���������...',
  'replace_wait' => '������ �� ��������� � ������������ �� � ������ � ��������� �������, ���� ���������...',
  'instruction' => '����� ����������',
  'instruction_action' => '�������� ��������',
  'instruction_parameter' => '��������� �����������',
  'instruction_album' => '�������� �����',
  'instruction_press' => '��������� %s',
  'update' => '������������ �� ������� �������� �/��� ������ � ��������� �������',
  'update_what' => '����� ������ �� ���� �������������',
  'update_thumb' => '���� ��������� ��������',
  'update_pic' => '���� ��������� � ��������� �������',
  'update_both' => '� ��������� �������� � ��������� � ��������� �������',
  'update_number' => '���� ����������� ������ ��� ���������',
  'update_option' => '(�������� �� ������� ��-����� ��������� �� ���� ����� ��� ���������� �������� � ������ �� ���� "�imeout" )',
  'filename_title' => '��� �� ���� &rArr; �������� �� ����', //cpg1.3.0
  'filename_how' => '��� �� ���� ��������� ����� �� �����',
  'filename_remove' => '���������� �� .jpg ������������ � ������ �� _ (����� �����) � ���������',
  'filename_euro' => '�� 2003_11_23_13_20_20.jpg � 23/11/2003 13:20',
  'filename_us' => '�� 2003_11_23_13_20_20.jpg � 11/23/2003 13:20',
  'filename_time' => '�� 2003_11_23_13_20_20.jpg � 13:20',
  'delete' => '��������� �� ���������� �� ������� ��� �������� � ������������� ������', //cpg1.3.0
  'delete_title' => '��������� �� ���������� �� �������', //cpg1.3.0
  'delete_original' => '��������� �� �������� � ������������� ������',
  'delete_replace' => '��������� �� �������� � ������������� ������ � �������� �� � ������ � ��������� �������',
  'select_album' => '����� �� �����',
  'delete_orphans' => '��������� �� "���������" ��������� (������� ����� ������ ������)', //cpg1.3.0
  'orphan_comment' => '�������� �������� �� ������', //cpg1.3.0
  'delete' => '���������', //cpg1.3.0
  'delete_all' => '��������� �� ������', //cpg1.3.0
  'comment' => '��������: ', //cpg1.3.0
  'nonexist' => '�������� ��� ������������� ���� # ', //cpg1.3.0
  'phpinfo' => '��������� �� phpinfo', //cpg1.3.0
  'update_db' => '������������ �� ������ �����', //cpg1.3.0
  'update_db_explanation' => '��� �� ��������� ��������� �� coppermine, ��� ��� ��������� ����������� ��� ��� ��������� ������� �� �������� ������ �� coppermine, ���������� ��������� ���������� ������������ �� ������ �����. ���� �� ������� ������������ ������� �/��� ��������������� ��������� � ������ �� �����.', //cpg1.3.0
);

?>