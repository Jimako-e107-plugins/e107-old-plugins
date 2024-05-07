<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.3.2                                            //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002,2003 Gregory DEMAR                                     //
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
// $Id: chinese_big5.php,v 1.11 2004/12/29 23:03:46 chtito Exp $
// ------------------------------------------------------------------------- //

// info about translators and translated language
$lang_translation_info = array(
  'lang_name_english' => 'Chinese Tranditional BIG5',
  'lang_name_native' => '�����c��BIG5',
  'lang_country_code' => 'tw',
  'trans_name'=> 'CapriSkye and monkey',
  'trans_email' => 'admin@capriskye.com',
  'trans_website' => 'http://open.38.com/',
  'trans_date' => '2004-09-28',
);

$lang_charset = 'BIG5';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('�P����', '�P���@', '�P���G', '�P���T', '�P���|', '�P����', '�P����');
$lang_month = array('�@��', '�G��', '�T��', '�|��', '����', '����', '�C��', '�K��', '�E��', '�Q��', '�Q�@��', '�Q�G��');

// Some common strings
$lang_yes = '�O';
$lang_no  = '�_';
$lang_back = '��^';
$lang_continue = '�~��';
$lang_info = '�T��';
$lang_error = '���~';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%B %d, %Y';
$lastcom_date_fmt =  '%m/%d/%y at %H:%M'; //cpg1.3.0
$lastup_date_fmt = '%B %d, %Y';
$register_date_fmt = '%B %d, %Y';
$lasthit_date_fmt = '%B %d, %Y at %I:%M %p'; //cpg1.3.0
$comment_date_fmt =  '%B %d, %Y at %I:%M %p'; //cpg1.3.0

// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array(
  'random' => '�H���Ϥ�', //cpg1.3.0
  'lastup' => '�̷s�W��',
  'lastalb'=> '�̪��s',
  'lastcom' => '�̷s�d��',
  'topn' => '�����Ϥ�',
  'toprated' => '�̰�����',
  'lasthits' => '�̪����',
  'search' => '�j�M���G',
  'favpics'=> '�̷R�Ϥ�', //cpg1.3.0
);

$lang_errors = array(
  'access_denied' => '�A�S���ϥΥ������v��.',
  'perm_denied' => '�A�S���v�����榹�ʧ@.',
  'param_missing' => '�{���Q�I�s�ӨS���ݭn���Ѽ�.',
  'non_exist_ap' => '�ҿ�ܪ� ��ï/�Ϥ� ���s�b !', //cpg1.3.0
  'quota_exceeded' => '�W�L�Ϻаt�B<br /><br />�A���t�B�� [quota]K, �w�ϥΪ��� [space]K, �[�J���Ϥ��|�W�L�֦����t�B.', //cpg1.3.0
  'gd_file_type_err' => '��ϥ� GD �Ϲ��{���w�u�e�\ JPEG / PNG ����.',
  'invalid_image' => '�A�W�Ǫ��ɮפv�g�l�a, �άO GD �Ϲ��{���w����B�z',
  'resize_failed' => '�L�k�إ��Y�ϩ��ܧ���ɤؤo.',
  'no_img_to_display' => '�S���Ϥ��i�H���.',
  'non_exist_cat' => '�ҿ�ܪ����O�ä��s�b.',
  'orphan_cat' => '�o�Ӥl���O�s��@�Ӥ��s�b�������O, �Х������O�޲z�ץ��o�Ӱ��D.', //cpg1.3.0
  'directory_ro' => '�ؿ� \'%s\' �L�k�g�J, �ɭP�L�k�R���Ϥ�', //cpg1.3.0
  'non_exist_comment' => '�ҿ�ܪ��d���ä��s�b.',
  'pic_in_invalid_album' => '���Ϥ��s�󤣦s�b����ï (%s)!?', //cpg1.3.0
  'banned' => '�z�ثe�Q�T��ϥΥ���.',
  'not_with_udb' => '�ѩ󥻬�ï�w�M�׾µ{����X, ���\��w����ϥ�. �i��O�ثe�]�w���䴩���\��, �Τw�ѽ׾³B�z.', 
  'offline_title' => '���u', //cpg1.3.0
  'offline_text' => '��ï�ثe�O���u���A - �еy��A��', //cpg1.3.0
  'ecards_empty' => '�ثe�S���q�l�d���������i���. ���ˬd��ï�]�w���O�_�ҥά����q�l�d���\��!', //cpg1.3.0
  'action_failed' => '�ʧ@����.  Coppermine �L�k����z���n�D.', //cpg1.3.0
  'no_zip' => '�L�k����ZIP���Y��.  ���p���z����ï�޲z��.', //cpg1.3.0
  'zip_type' => '�z�S���W��ZIP���Y�ɪ��v��.', //cpg1.3.0
);

$lang_bbcode_help = '�Ѧҽs�X: <li>[b]<b>Bold</b>[/b]</li> <li>[i]<i>Italic</i>[/i]</li> <li>[url=http://yoursite.com/]Url Text[/url]</li> <li>[email]user@domain.com[/email]</li>'; //cpg1.3.0

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //
//
$lang_main_menu = array(
  'alb_list_title' => '��^��ï�ؿ�',
  'alb_list_lnk' => '��ï�ؿ�',
  'my_gal_title' => '��^�ڪ���ï',
  'my_gal_lnk' => '�ڪ���ï',
  'my_prof_lnk' => '�ڪ��ӤH���',
  'adm_mode_title' => '�ର�޲z�Ҧ�',
  'adm_mode_lnk' => '�޲z�Ҧ�',
  'usr_mode_title' => '�ର�|���Ҧ�',
  'usr_mode_lnk' => '�|���Ҧ�',
  'upload_pic_title' => '�W�ǹϤ��ܬ�ï', //cpg1.3.0
  'upload_pic_lnk' => '�W�ǹϤ�', //cpg1.3.0
  'register_title' => '�إ߷|���b��',
  'register_lnk' => '���U',
  'login_lnk' => '�n�J',
  'logout_lnk' => '�n�X',
  'lastup_lnk' => '�̷s�W��',
  'lastcom_lnk' => '�̷s�d��',
  'topn_lnk' => '�����Ϥ�',
  'toprated_lnk' => '�̰�����',
  'search_lnk' => '�j�M',
  'fav_lnk' => '�ڪ��̷R',
  'memberlist_title' => '��ܷ|���W��', //cpg1.3.0
  'memberlist_lnk' => '�|���W��', //cpg1.3.0
  'faq_title' => '&quot;Coppermine&quot; ��ï���`�����D�ѵ�', //cpg1.3.0
  'faq_lnk' => '�`�����D�ѵ�', //cpg1.3.0
);

$lang_gallery_admin_menu = array(
  'upl_app_lnk' => '�֭�W��',
  'config_lnk' => '�]�w',
  'albums_lnk' => '��ï',
  'categories_lnk' => '���O',
  'users_lnk' => '�|��',
  'groups_lnk' => '�s��',
  'comments_lnk' => '�[�ݯd��', //cpg1.3.0
  'searchnew_lnk' => '���[�J�Ϥ�', //cpg1.3.0
  'util_lnk' => '�޲z�u��', //cpg1.3.0
  'ban_lnk' => '���׷|��',
  'db_ecard_lnk' => '��ܹq�l�d��', //cpg1.3.0
);

$lang_user_admin_menu = array(
  'albmgr_lnk' => '�إ�/�Ƨ� �ڪ���ï',
  'modifyalb_lnk' => '�s��ڪ���ï',
  'my_prof_lnk' => '�ڪ��ӤH���',
);

$lang_cat_list = array(
  'category' => '���O',
  'albums' => '��ï',
  'pictures' => '�Ϥ�', //cpg1.3.0
);

$lang_album_list = array(
  'album_on_page' => '%d �Ӭ�ï�b %d ��',
);

$lang_thumb_view = array(
  'date' => '���',
  //Sort by filename and title
  'name' => '�ɦW',
  'title' => '���D',
  'sort_da' => '�̤���Ƨ� �ѻ��ܪ�',
  'sort_dd' => '�̤���Ƨ� �Ѫ�ܻ�',
  'sort_na' => '�̦W�ٱƧ� �Ѥp�ܤj',
  'sort_nd' => '�̦W�ٱƧ� �Ѥj�ܤp',
  'sort_ta' => '�̼��D�Ƨ� �Ѥp�ܤj',
  'sort_td' => '�̼��D�Ƨ� �Ѥj�ܤp',
  'download_zip' => '�U���� Zip ��', //cpg1.3.0
  'pic_on_page' => '%d �i�Ϥ��b %d ��',
  'user_on_page' => '%d �W�|���b %d ��', //cpg1.3.0
);

$lang_img_nav_bar = array(
  'thumb_title' => '��^�Y�ϭ�',
  'pic_info_title' => '���/���� �Ϥ���T', //cpg1.3.0
  'slideshow_title' => '�s�򼽩�',
  'ecard_title' => '��Ϥ��H�q�l�d���H�X', //cpg1.3.0
  'ecard_disabled' => '�q�l�d���\��ثe����',
  'ecard_disabled_msg' => '�z�S���H�q�l�d�����v��', //js-alert //cpg1.3.0
  'prev_title' => '��ܫe�@�i�Ϥ�', //cpg1.3.0
  'next_title' => '��ܤU�@�i�Ϥ�', //cpg1.3.0
  'pic_pos' => '�Ϥ� %s/%s', //cpg1.3.0
);

$lang_rate_pic = array(
  'rate_this_pic' => '��Ϥ�����', //cpg1.3.0
  'no_votes' => '(�٨S���H����)',
  'rating' => '(�ثe�o�� : %s / 5 �� %s �ӵ���)',
  'rubbish' => '���� ���ݤ]�}',
  'poor' => '���I�t�l',
  'fair' => '�����q�q',
  'good' => '�ܦn',
  'excellent' => '�D�`�X��',
  'great' => '�s�ڲĤ@�W',
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
  CRITICAL_ERROR => '�����~',
  'file' => '�ɮ�: ',
  'line' => '���: ',
);

$lang_display_thumbnails = array(
  'filename' => '�ɮצW��: ',
  'filesize' => '�ɮפj�p: ',
  'dimensions' => '�Ϥ��ؤo: ',
  'date_added' => '�[�J���: ', //cpg1.3.0
);

$lang_get_pic_data = array(
  'n_comments' => '%s �ӯd��',
  'n_views' => '%s ���[��',
  'n_votes' => '(%s �ӵ���)',
);

$lang_cpg_debug_output = array(
  'debug_info' => '�����T��', //cpg1.3.0
  'select_all' => '����', //cpg1.3.0
  'copy_and_paste_instructions' => '�p�G�A�n�bCoppermine�䴩�׾¤W�n�D��U, �ƻs�öK�W�o�Ӱ����T����A���o��峹��. �o��峹�e�Ъ`�N��***�Ө��N�z���K�X.', //cpg1.3.0
  'phpinfo' => '���PHP�T�� (phpinfo)', //cpg1.3.0
);

$lang_language_selection = array(
  'reset_language' => '�w�]�y�t', //cpg1.3.0
  'choose_language' => '��ܧA���y�t', //cpg1.3.0
);

$lang_theme_selection = array(
  'reset_theme' => '�w�]�G��', //cpg1.3.0
  'choose_theme' => '��ܧG��', //cpg1.3.0
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
  'Exclamation' => '�P��',
  'Question' => '�ð�',
  'Very Happy' => '�ܰ���',
  'Smile' => '�L��',
  'Sad' => '�d�s',
  'Surprised' => '��Y',
  'Shocked' => '�_��',
  'Confused' => '����',
  'Cool' => '�ܴ�',
  'Laughing' => '�o��',
  'Mad' => '�o�g',
  'Razz' => '�J��',
  'Embarassed' => '����',
  'Crying or Very sad' => '�z��',
  'Evil or Very Mad' => '�c�r',
  'Twisted Evil' => '�j��',
  'Rolling Eyes' => '���઺����',
  'Wink' => '�w��',
  'Idea' => '�D�N',
  'Arrow' => '�b�Y',
  'Neutral' => '����',
  'Mr. Green' => '��L����',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
  0 => '�����}�޲z�Ҧ�...',
  1 => '���i�J�޲z�Ҧ�...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
  'alb_need_name' => '�z�ݭn����ï�@�ӦW�� !', //js-alert
  'confirm_modifs' => '�T�w�n���o�ǭק�� ?', //js-alert
  'no_change' => '�z�S����������� !', //js-alert
  'new_album' => '�s��ï',
  'confirm_delete1' => '�T�w�n�R������ï�� ?', //js-alert
  'confirm_delete2' => '\n�Ҧ��Ϥ��ίd�����|�R�� !', //js-alert
  'select_first' => '�Х���ܤ@�Ӭ�ï', //js-alert
  'alb_mrg' => '��ï�޲z��',
  'my_gallery' => '* �ڪ���ï *',
  'no_category' => '* �S�����O *',
  'delete' => '�R��',
  'new' => '�s�W',
  'apply_modifs' => '�ק�',
  'select_category' => '������O',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
  'miss_param' => '\'%s\'�ާ@�һݭn���Ѽƨå����� !',
  'unknown_cat' => '��Ʈw�̨S���z�ҿ諸���O',
  'usergal_cat_ro' => '�|����ï���O����R�� !',
  'manage_cat' => '���O�޲z',
  'confirm_delete' => '�T�w�n�R�������O��', //js-alert
  'category' => '���O',
  'operations' => '�ާ@',
  'move_into' => '���ʨ�',
  'update_create' => '��s/�إ� ���O',
  'parent_cat' => '�����O',
  'cat_title' => '���O���D',
  'cat_thumb' => '���O�Y��', //cpg1.3.0
  'cat_desc' => '���O²��',
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
  'title' => '�]�w',
  'restore_cfg' => '�^�_��l�]�w',
  'save_cfg' => '�x�s�s�]�w',
  'notes' => '�`�N',
  'info' => '�T��',
  'upd_success' => '�]�w�w��s',
  'restore_success' => '��l�]�w�w�^�_',
  'name_a' => '�ƧǨ̦W�� �Ѥp�ܤj',
  'name_d' => '�ƧǨ̦W�� �Ѥj�ܤp',
  'title_a' => '�ƧǨ̼��D �Ѥp�ܤj',
  'title_d' => '�ƧǨ̼��D �Ѥj�ܤp',
  'date_a' => '�ƧǨ̤�� �ѻ��ܪ�',
  'date_d' => '�ƧǨ̤�� �Ѫ�ܻ�',
  'th_any' => '�̤j�~�[',
  'th_ht' => '����',
  'th_wd' => '�e��',
  'label' => '����', //cpg1.3.0
  'item' => '����', //cpg1.3.0
  'debug_everyone' => '����H', //cpg1.3.0
  'debug_admin' => '�޲z���M��', //cpg1.3.0
        );

if (defined('CONFIG_PHP')) $lang_config_data = array(
  '�򥻳]�w',
  array('��ï�W��', 'gallery_name', 0),
  array('��ï�y�z', 'gallery_description', 0),
  array('��ï�޲z�����q�l�l��', 'gallery_admin_email', 0),
  array('�b�q�l�d�������\'�[�ݧ�h�Ϥ�\'���s��', 'ecards_more_pic_target', 0),
  array('��ï�ثe���u��', 'offline', 1), //cpg1.3.0
  array('�����q�l�d��', 'log_ecards', 1), //cpg1.3.0
  array('���\�N�̷R���Ϥ��U����ZIP��', 'enable_zipdownload', 1), //cpg1.3.0

  '�y�t, �G�� &amp; ��r�s�X�]�w',
  array('�y�t', 'lang', 5),
  array('�G��', 'theme', 6),
  array('��ܻy�t�C��', 'language_list', 8), //cpg1.3.0
  array('��ܻy�t��X', 'language_flags', 8), //cpg1.3.0
  array('�b�y�t�C����� &quot;���]&quot;', 'language_reset', 1), //cpg1.3.0
  array('��ܧG���C��', 'theme_list', 8), //cpg1.3.0
  array('�b�G���C����� &quot;���]&quot;', 'theme_reset', 1), //cpg1.3.0
  array('��� FAQ', 'display_faq', 1), //cpg1.3.0
  array('��� bbcode ²��', 'show_bbcode_help', 1), //cpg1.3.0
  array('��r�s�X', 'charset', 4), //cpg1.3.0

  '��ï�ؿ����',
  array('�D�n���e�� (������ %)', 'main_table_width', 0),
  array('�P�@�h�����l���O��ܼƶq', 'subcat_level', 0),
  array('��ï��ܼƶq', 'albums_per_page', 0),
  array('��ï�ؿ�������ï���', 'album_list_cols', 0),
  array('�Y�Ϲ���', 'alb_list_thumb_size', 0),
  array('�D�������e', 'main_page_layout', 0),
  array('��ܤ������Ĥ@�h����ï�Y��','first_level',1),

  '�Y�����',
  array('�Y�ϭ����', 'thumbcols', 0),
  array('�Y�ϭ��C��', 'thumbrows', 0),
  array('�����̰ܳ��Ӽ�', 'max_tabs', 10), //cpg1.3.0
  array('��ܹϤ��������Y�ϤU�� (�s���D)', 'caption_in_thumbview', 1), //cpg1.3.0
  array('����[�ݦ��Ʃ��Y�ϤU��', 'views_in_thumbview', 1), //cpg1.3.0
  array('��ܯd���Ʃ��Y�ϤU��', 'display_comment_count', 1),
  array('��ܤW�Ǫ̦W�٩��Y�ϤU��', 'display_uploader', 1), //cpg1.3.0
  array('�Ϥ����w�]�Ƨ�', 'default_sort_order', 3), //cpg1.3.0
  array('\'�����벼\'�ݭn���̤֧벼��', 'min_votes_for_rating', 0), //cpg1.3.0

  '�Ϥ���� &amp; �d���]�w',
  array('�Ϥ���ܪ����e�� (������ %)', 'picture_table_width', 0), //cpg1.3.0
  array('�Ϥ���T���w�]�����', 'display_pic_info', 1), //cpg1.3.0
  array('�d�����L�o���}���J', 'filter_bad_words', 1),
  array('�d���i�H�ϥί��y�ϥ�', 'enable_smilies', 1),
  array('���\�|���b�P�@�i�Ϥ� �s��o��d��(��������O�@)', 'disable_comment_flood_protect', 1), //cpg1.3.0
  array('�Ϥ�²�����̤j����', 'max_img_desc_length', 0),
  array('��r���̤j�r��', 'max_com_wlength', 0),
  array('�d�����̤j���', 'max_com_lines', 0),
  array('�d�����̤j����', 'max_com_size', 0),
  array('��ܹϤ��w���C', 'display_film_strip', 1),
  array('�Ϥ��w���C���Ϥ���', 'max_film_strip_items', 0),
  array('���d���ɥιq�l�l��q���޲z��', 'email_comment_notification', 1), //cpg1.3.0
  array('�s�򼷩񶡹j�ɶ� (�@��). 1 �� = 1000 �@��', 'slideshow_interval', 0), //cpg1.3.0

  '�Ϥ����Y�ϳ]�w', //cpg1.3.0
  array('JPEG �榡�~��', 'jpeg_qual', 0),
  array('�Y�ϳ̤j�ؤo <a href="#notice2" class="clickable_option">**</a>', 'thumb_width', 0), //cpg1.3.0
  array('�ϥΤؤo ( �e�B�����Y�ϳ̤j��� )<b>**</b>', 'thumb_use', 7),
  array('�إߤ��ŹϤ�','make_intermediate',1),
  array('���ŹϤ�/�v���̤j�ؤo <a href="#notice2" class="clickable_option">**</a>', 'picture_width', 0), //cpg1.3.0
  array('�W�ǹ��ɪ��̤j���� (KB)', 'max_upl_size', 0), //cpg1.3.0
  array('�W�ǹϤ�/�v�����̤j�e�שγ̰��ؤo (����)', 'max_upl_width_height', 0), //cpg1.3.0

  '�Ϥ��M�Y�Ϫ��i���]�w', //cpg1.3.0
  array('��ܨp�H��ï�Ϥ������n�J�|��','show_private',1), //cpg1.3.0
  array('�ɮצW�٤��������r��', 'forbiden_fname_char',0), //cpg1.3.0
  //array('�W�ǹ��ɥi���������ɦW', 'allowed_file_extensions',0), //cpg1.3.0
  array('���\���Ϥ�������', 'allowed_img_types',0), //cpg1.3.0
  array('���\���v��������', 'allowed_mov_types',0), //cpg1.3.0
  array('���\���n��������', 'allowed_snd_types',0), //cpg1.3.0
  array('���\�����������', 'allowed_doc_types',0), //cpg1.3.0
  array('�إ��Y�Ϫ���k','thumb_method',2), //cpg1.3.0
  array('ImageMagick \'convert\' �{�������| (�Ҧp /usr/bin/X11/)', 'impath', 0), //cpg1.3.0
  //array('�i��������������(�u�� ImageMagick ����)', 'allowed_img_types',0), //cpg1.3.0
  array('ImageMagick ���R�O�C�ﶵ', 'im_options', 0), //cpg1.3.0
  array('Ū�� JPEG �ɮת� EXIF ���', 'read_exif_data', 1), //cpg1.3.0
  array('Ū�� JPEG �ɮת� IPTC ���', 'read_iptc_data', 1), //cpg1.3.0
  array('��ï���| <a href="#notice1" class="clickable_option">*</a>', 'fullpath', 0), //cpg1.3.0
  array('�|�����ɸ��| <a href="#notice1" class="clickable_option">*</a>', 'userpics', 0), //cpg1.3.0
  array('���Ź��ɪ��e�m�r�� <a href="#notice1" class="clickable_option">*</a>', 'normal_pfx', 0), //cpg1.3.0
  array('�Y���ɪ��e�m�r�� <a href="#notice1" class="clickable_option">*</a>', 'thumb_pfx', 0), //cpg1.3.0
  array('��m���ɥؿ����w�]�v��', 'default_dir_mode', 0), //cpg1.3.0
  array('�W�ǹϤ����w�]�v��', 'default_file_mode', 0), //cpg1.3.0

  '�|���]�w',
  array('���\�s�|�����U', 'allow_user_registration', 1),
  array('���U�ݭn�q�l�l������', 'reg_requires_valid_email', 1),
  array('���ϥΪ̵��U�ɥιq�l�l��q���޲z��', 'reg_notify_admin_email', 1), //cpg1.3.0
  array('���\��ӷ|���ϥΦP�@�ӹq�l�l��', 'allow_duplicate_emails_addr', 1),
  array('�|���i�H���p�H����ï (�`�N: �p�G�A���� �O��_ ����ثe�p�H��ï�N�ܦ����}��ï)', 'allow_private_albums', 1), //cpg1.3.0
  array('���|���W���ɮ׵��ݮ֭�ɳq���޲z��', 'upl_notify_admin_email', 1), //cpg1.3.0
  array('���\�n�J���|���d�ݷ|���W��', 'allow_memberlist', 1), //cpg1.3.0

  '�v��²�����ۭq��� (�p�G���ϥνЯd�U�ť�)',
  array('��� 1 ���W��', 'user_field1_name', 0),
  array('��� 2 ���W��', 'user_field2_name', 0),
  array('��� 3 ���W��', 'user_field3_name', 0),
  array('��� 4 ���W��', 'user_field4_name', 0),

  'Cookies �]�w',
  array('�ϥΪ� cookie �W�� (�P�׾µ{����X��, �T�w���M�׾ª�cookie���P)', 'cookie_name', 0),
  array('�ϥΪ� cookie ���|', 'cookie_path', 0),

  '��L�]�w',
  array('�Ұʰ����Ҧ�', 'debug_mode', 9), //cpg1.3.0
  array('�b�����Ҧ�����ܴ���', 'debug_notice', 1), //cpg1.3.0

  '<br /><div align="left"><a name="notice1"></a>(*) �Y��ï�����Ϥ�, �Хܦ� * ������ܤ��i���.<br />
  <a name="notice2"></a>(**) ���ܳo�ӳ]�w�u�v�T�w�g�[�J���ɮ�, �p�G�����ɮפw�g�b��ï���F,�o�ӳ]�w��������. �L�צp��,�A�i�H�q �޲z���\����� �վ�J�����ɮ�,�q &quot;<a href="util.php">�޲z�u��</a> (�վ�Ϥ��ؤo)&quot; </div><br />', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File db_ecard.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('DB_ECARD_PHP')) $lang_db_ecard_php = array(
  'title' => '�H�X�q�l�d��', //cpg1.3.0
  'ecard_sender' => '�H���', //cpg1.3.0
  'ecard_recipient' => '�����', //cpg1.3.0
  'ecard_date' => '���', //cpg1.3.0
  'ecard_display' => '��ܹq�l�d��', //cpg1.3.0
  'ecard_name' => '�W��', //cpg1.3.0
  'ecard_email' => '�q�l�l��', //cpg1.3.0
  'ecard_ip' => 'IP #', //cpg1.3.0
  'ecard_ascending' => '�ɾ�', //cpg1.3.0
  'ecard_descending' => '����', //cpg1.3.0
  'ecard_sorted' => '�Ƨ�', //cpg1.3.0
  'ecard_by_date' => '�̤��', //cpg1.3.0
  'ecard_by_sender_name' => '�̱H��̦W��', //cpg1.3.0
  'ecard_by_sender_email' => '�̱H��̶l��', //cpg1.3.0
  'ecard_by_sender_ip' => '�̱H��̪� IP ��}', //cpg1.3.0
  'ecard_by_recipient_name' => '�̦���̦W��', //cpg1.3.0
  'ecard_by_recipient_email' => '�̦���̶l��', //cpg1.3.0
  'ecard_number' => '��ܬ��� %s �� %s �b %s', //cpg1.3.0
  'ecard_goto_page' => '�쭶��', //cpg1.3.0
  'ecard_records_per_page' => '��������', //cpg1.3.0
  'check_all' => '����', //cpg1.3.0
  'uncheck_all' => '������', //cpg1.3.0
  'ecards_delete_selected' => '�R��������d��', //cpg1.3.0
  'ecards_delete_confirm' => '�A�T�w�n�R������? ���I��!', //cpg1.3.0
  'ecards_delete_sure' => '�ڽT�w', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
  'empty_name_or_com' => '�п�J�z���W�r�M�d��',
  'com_added' => '�z���d���w�g�[�J',
  'alb_need_title' => '�z��������ï���Ѥ@�Ӽ��D !',
  'no_udp_needed' => '�S����s�����n',
  'alb_updated' => '��ï�w�g��s',
  'unknown_album' => '�ҿ�ܪ���ï���s�b�αz�S���v���W���ɮר즹��ï',
  'no_pic_uploaded' => '�S���ɮ׳Q�W�� !<br /><br />�p�G�z�T�w������ɮפW��, ���ˬd���A���O�_���\�W���ɮ�...', //cpg1.3.0
  'err_mkdir' => '�L�k�إߥؿ� %s !',
  'dest_dir_ro' => '�ؿ� %s �L�k�g�J !',
  'err_move' => '�L�k���� %s �� %s !',
  'err_fsize_too_large' => '�z�W�Ǫ��Ϥ��Ӥj (����W�L %s x %s) !', //cpg1.3.0
  'err_imgsize_too_large' => '�z�W�Ǫ����ɤӤj (����W�L %s KB) !',
  'err_invalid_img' => '�W�Ǫ��ɮרä��O�e�\���Ϥ��榡 !',
  'allowed_img_types' => '�z�u�i�H�W�� %s �i�Ϥ�.',
  'err_insert_pic' => '�ɮ� \'%s\' �L�k�[�J����ï ', //cpg1.3.0
  'upload_success' => '�ɮפW�ǧ���!<br /><br />��޲z�̮֭��N�i�H�ݨ��ɮפF.', //cpg1.3.0
  'notify_admin_email_subject' => '%s - �W���ɮ׳q��', //cpg1.3.0
  'notify_admin_email_body' => '%s���W���ɮ� �ݭn�A���֭�. �Ьd�\ %s', //cpg1.3.0
  'info' => '�T��',
  'com_added' => '�d���w�[�J',
  'alb_updated' => '��ï�w�g��s',
  'err_comment_empty' => '�d���O�Ū� !',
  'err_invalid_fext' => '�u���U�C�����ɦW�~���\�W�� : <br /><br />%s.',
  'no_flood' => '��p, ���Ϥ��̫�@�ӯd���O�z����<br /><br />�z�u�i�H�ק�z���d��', //cpg1.3.0
  'redirect_msg' => '�����ಾ��.<br /><br /><br />�� \'�~��\' �p�G�����S���۰ʨ�s',
  'upl_success' => '�w�g�[�J�z���Ϥ�', //cpg1.3.0
  'email_comment_subject' => '�w�g���d���o��b������ï', //cpg1.3.0
  'email_comment_body' => '�w�g���d���o��b�z����ï. �Ьd�\'', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
  'caption' => '����',
  'fs_pic' => '���',
  'del_success' => '�����R��',
  'ns_pic' => '�зǤؤo�Ϥ�',
  'err_del' => '�L�k�R��',
  'thumb_pic' => '�Y��',
  'comment' => '�d��',
  'im_in_alb' => '��ï���Ϥ�',
  'alb_del_success' => '��ï \'%s\' �w�R��',
  'alb_mgr' => '��ï�޲z',
  'err_invalid_data' => '�����줣���T����Ʃ� \'%s\'',
  'create_alb' => '�إ߬�ï \'%s\'',
  'update_alb' => '��s��ï \'%s\' ���D�� \'%s\' ���ެ� \'%s\'',
  'del_pic' => '�R���Ϥ�', //cpg1.3.0
  'del_alb' => '�R����ï',
  'del_user' => '�R���|��',
  'err_unknown_user' => '�ҿ�ܪ��|�����s�b !',
  'comment_deleted' => '�d���w�R��',
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
  'confirm_del' => '�T�w�n�R�����Ϥ��� ? \\n�d���]�|�Q�R��.', //js-alert //cpg1.3.0
  'del_pic' => '�R�����Ϥ�', //cpg1.3.0
  'size' => '%s x %s ����',
  'views' => '%s ��',
  'slideshow' => '�s�򼽩�',
  'stop_slideshow' => '�����',
  'view_fs' => '�I��Ϥ��H�[�ݭ��',
  'edit_pic' => '�s�軡��', //cpg1.3.0
  'crop_pic' => '���ŻP����', //cpg1.3.0
);

$lang_picinfo = array(
  'title' =>'�Ϥ���T', //cpg1.3.0
  'Filename' => '�ɮצW��',
  'Album name' => '��ï�W��',
  'Rating' => '���� (%s ���벼)',
  'Keywords' => '����r',
  'File Size' => '�ɮפj�p',
  'Dimensions' => '�ؤo',
  'Displayed' => '���',
  'Camera' => '�۾�',
  'Date taken' => '������',
  'Aperture' => '����',
  'Exposure time' => '�n���ɶ�',
  'Focal length' => '�J�Z',
  'Comment' => '�d��',
  'addFav'=>'�[��ڪ��̷R', //cpg1.3.0
  'addFavPhrase'=>'�ڪ��̷R', //cpg1.3.0
  'remFav'=>'�q�ڪ��̷R����', //cpg1.3.0
  'iptcTitle'=>'IPTC ���D', //cpg1.3.0
  'iptcCopyright'=>'IPTC ���v', //cpg1.3.0
  'iptcKeywords'=>'IPTC ����r', //cpg1.3.0
  'iptcCategory'=>'IPTC ���O', //cpg1.3.0
  'iptcSubCategories'=>'IPTC �l���O', //cpg1.3.0
);

$lang_display_comments = array(
  'OK' => 'OK',
  'edit_title' => '�s�覹�d��',
  'confirm_delete' => '�T�w�n�R�����d�� ?', //js-alert
  'add_your_comment' => '�[�J�A���d��',
  'name'=>'�W��',
  'comment'=>'�d��',
  'your_name' => '�L�W��',
);

$lang_fullsize_popup = array(
  'click_to_close' => '�I��Ϥ�����������',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
  'title' => '�H�X �q�l�d��',
  'invalid_email' => '<b>ĵ�i</b> : �����T���q�l�l��a�} !',
  'ecard_title' => '%s �H���A�@�i�q�l�d��',
  'error_not_image' => '�q�l�d���u��H�X�Ϥ�.', //cpg1.3.0
  'view_ecard' => '�p�G �q�l�d�� �L�k���T���, �Ы����s��',
  'view_more_pics' => '�����s���ݧ�h�Ϥ� !',
  'send_success' => '�A�� �q�l�d�� �w�H�X',
  'send_failed' => '��p, �����A���L�k���A�H�X �q�l�d��...',
  'from' => '��',
  'your_name' => '�A���W��',
  'your_email' => '�A���q�l�l��',
  'to' => '��',
  'rcpt_name' => '����̦W��',
  'rcpt_email' => '����̹q�l�l��',
  'greetings' => '���D',
  'message' => '�T�����e',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
  'pic_info' => '�ɮ׸��', //cpg1.3.0
  'album' => '��ï',
  'title' => '���D',
  'desc' => '�y�z',
  'keywords' => '����r',
  'pic_info_str' => '%s &times; %s - %s KB - %s ���[�� - %s ������',
  'approve' => '�֭�Ϥ�', //cpg1.3.0
  'postpone_app' => '����֭�',
  'del_pic' => '�R���Ϥ�', //cpg1.3.0
  'read_exif' => '�A��Ū�� EXIF ���', //cpg1.3.0
  'reset_view_count' => '���]�[�ݭp�ƾ�',
  'reset_votes' => '���]����',
  'del_comm' => '�R���d��',
  'upl_approval' => '�֭�W��',
  'edit_pics' => '�s��Ϥ�', //cpg1.3.0
  'see_next' => '�[�ݤU�@�i�Ϥ�', //cpg1.3.0
  'see_prev' => '�[�ݫe�@�i�Ϥ�', //cpg1.3.0
  'n_pic' => '%s �i�Ϥ�', //cpg1.3.0
  'n_of_pic_to_disp' => '�Ϥ���ܼƶq', //cpg1.3.0
  'apply' => '�ק�', //cpg1.3.0
  'crop_title' => 'CPG �Ϥ��s�边', //cpg1.3.0
  'preview' => '�w��', //cpg1.3.0
  'save' => '�s��', //cpg1.3.0
  'save_thumb' =>'�s���Y��', //cpg1.3.0
  'sel_on_img' =>'��ܪ��ϰ쥲���b�Ϥ��d��!', //js-alert //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File faq.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FAQ_PHP')) $lang_faq_php = array(
  'faq' => '�`�����D�ѵ�', //cpg1.3.0
  'toc' => '�ؿ�', //cpg1.3.0
  'question' => '���D: ', //cpg1.3.0
  'answer' => '�ѵ�: ', //cpg1.3.0
);

if (defined('FAQ_PHP')) $lang_faq_data = array(
  '�@��ʰ��D�P�ѵ�', //cpg1.3.0
  array('������n���U?', '�޲z���M�w�ϥΪ̬O�_�ݭn���U. ���U�����|���i��o�B�~���\��,�p �W���ɮ�,�� �ڪ��̷R�C��, ��v�������εo��d�� ����.', 'allow_user_registration', '0'), //cpg1.3.0
  array('�p����U?', '�� &quot;���U&quot; �h��g��줺����� (�������O���).<br />�p�G�޲z���}��Email �ҥΥ\�� ,�b�A�T�{�e�X���U��ƫ� �A�|����@�ʻ{�ҫH �H��A�Ҷ�g���H�c��, �̭��|�����p��ҥΧA���|�����. �|���n�J�e �����������ҥΰʧ@.', 'allow_user_registration', '1'), //cpg1.3.0
  array('�p��n�J?', '�� &quot;�n�J&quot;, ��J�A���|���W�٤αK�X �B�Ŀ� &quot;�O���&quot; �U���A�A�Ӫ��ɭԴN�|�۰ʵn�J�F.<br /><b>�`�N:�p�G�A�I�� &quot;�O��� Me&quot; ,Cookies �\�ॲ���}��,�B������cookie�s�b�A���q����..</b>', 'offline', 0), //cpg1.3.0
  array('����L�k�n�J?', '�A�w�g���U�ñҥαb���F��(�^�л{�Ҷl�󪺳s��)?. ���ӳs���N�|�ҥΧA���b��. ��L�n�J���D ���p�������޲z��.', 'offline', 0), //cpg1.3.0
  array('�ѰO�K�X�F���� ?', '�p�G�o�Ӻ����� &quot;�ѰO�K�X�F&quot; ���s��,�N����. ���M�N�p�������޲z�� �ХL���A�@�ӷs���K�X.', 'offline', 0), //cpg1.3.0
  array('�ڪ�email�ܧ�F���� ?', '�u�n�n�J �åB�� &quot;�ڪ��ӤH���&quot; �ܧ�A���q�l�l��a�}�N�i�H�F', 'offline', 0), //cpg1.3.0
  array('�p���Ϥ��s��  &quot;�ڪ��̷R &quot;?', '�I��Ϥ��åB�I�� &quot;�v����T&quot; �s�� (<img src="images/info.gif" width="16" height="16" border="0" alt="Picture information" />); �b�v����T�]�w�̭��� &quot;�[�J�ڪ��̷R&quot;.<br />�޲z���i�঳�w�]&quot;�v����T; .<br />�`�N:Cookies �\�ॲ���}��,�B������cookie�s�b�A���q����.', 'offline', 0), //cpg1.3.0
  array('�p���Ϥ����� ?', '�I���Ӽv���Y��,�b�v�����U�i�H�I��A������.', 'offline', 0), //cpg1.3.0
  array('�p��o��d�� ?', '�I���Ӽv���Y��,�b�v�����U�i�H�o��d��.', 'offline', 0), //cpg1.3.0
  array('�p��W�ǹϤ� ?', '�� &quot;�W�ǹϤ�&quot;�ÿ�ܧA�n�W�Ǩ���@�Ӭ�ï,�� &quot;�s��&quot; �B�I��n�W�Ǫ��Ϥ� �� &quot;�}��&quot; (�A�i�H�[�J�v�����D�δy�z) �M��� &quot;�T�{&quot;', 'allow_private_albums', 0), //cpg1.3.0
  array('�n�q���̤W�ǹϤ� ?', '�A�i�H�W�ǹϤ��b &quot;�ڪ���ï&quot;. �޲z���i�ह�\�A�W�ǹϤ���D��ï��.', 'allow_private_albums', 0), //cpg1.3.0
  array('���خ榡�Τj�p���v���i�H�W��?', '�榡��j�p (jpg,gif,..etc.) �ھں޲z�����]�w.', 'offline', 0), //cpg1.3.0
  array('����O &quot;�ڪ���ï&quot;?', '&quot;�ڪ���ï&quot; �O�ӤH����ï,���|���i�H�W�Ǥκ޸̼v��.', 'allow_private_albums', 0), //cpg1.3.0
  array('�p��s�W,�ק� �ΧR����ï �q &quot;�ڪ���ï&quot;?', '�A�����b &quot;�޲z�Ҧ�&quot;<br />�� &quot;�s�W/�Ƨ� �ڪ���ï&quot;�� &quot;�s�WNew&quot;. �ܧ� &quot;�s��ï&quot; ��A�n���W��.<br />�A�i�H��A���C�@�Ӭ�ï���s�R�W.<br />�� &quot;�ק�;.', 'allow_private_albums', 0), //cpg1.3.0
  array('�ڭn�p��T���L�|���ݧڪ���ï?', '�A�����b &quot;�޲z�Ҧ�&quot;<br />�� &quot;�ܧ�ڪ���ï. �b &quot;��s��ï&quot; ���, ��ܧA�n�ܧ󪺬�ï.<br />�b�o��, �A�i�H�ܧ��ï�W�� �y�z �Y�� ,�έ����[�� �d�� ���� ���v��.<br />�� &quot;��s��ï&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('�p���[�ݨ�L�|������ï?', '�� &quot;��ï�ؿ�&quot; ��� &quot;�|����ï&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('����O cookies?', 'Cookies �O������b�A�q��������r���.<br />Cookies �q�`���ϥΪ̦A���^������ɦ۰ʵn�J �ðO����L�]�w���.', 'offline', 0), //cpg1.3.0
  array('�b���̥i�H���o�o�Ӭ�ï�{��?', 'Coppermine �O���GNU GPL���K�O�h�C���ï. ���O���\�઺ �B�䴩���P�����x. �Ш�<a href="http://coppermine.sf.net/">Coppermine ������</a> ���o��h����T �άO�U����.', 'offline', 0), //cpg1.3.0

  '�����ɤ�', //cpg1.3.0
  array('����O &quot;��ï�ؿ� &quot;?', '�o�N��ܾ�Ӭ�ï �]�t�C�@�Ӥ���. �Y�ϥi�H�s�������O��.', 'offline', 0), //cpg1.3.0
  array('����O &quot;�ڪ���ï &quot;?', '�o���\�����|���إߦۤv����ï,�i�W�[,�R��,�ק��ï. �åB�i�W���ɮר��ï��.', 'allow_private_albums', 0), //cpg1.3.0
  array('������t���b &quot;�޲z�Ҧ�&quot; �M &quot;�|���Ҧ�&quot;?', '�o���\��, �b�޲z�Ҧ���, ���\�|���ק�L�̦ۤv����ï (�p�G�޲z�����\����).', 'allow_private_albums', 0), //cpg1.3.0
  array('����O &quot;�W�ǹϤ� &quot;?', '�o���\�ह�\�|���W�Ǽv��(�ɮפj�p�ή榡�̺޲z���]�w) ����w����ï.', 'allow_private_albums', 0), //cpg1.3.0
  array('����O &quot;�̷s�W�� &quot;?', '�o���\����̷ܳs�W�Ǩ��ï���ɮ�.', 'offline', 0), //cpg1.3.0
  array('����O &quot;�̷s�d�� &quot;?', '�o���\��|����v���o���̷s�d��.', 'offline', 0), //cpg1.3.0
  array('����O &quot;�����Ϥ� &quot;?', '�o���\����ܳQ�[�ݳ̦h�����v��,���׬O�|���γX��.', 'offline', 0), //cpg1.3.0
  array('����O &quot;�̰����� &quot;?', '�o���\����ܷ|�������̰����v��, ��ܥ�������(�Ҧp: ���ӷ|���U���@�ӵ��� <img src="images/rating3.gif" width="65" height="14" border="0" alt="" />: �v���N���������� <img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> ;���ӷ|�������q 1 �� 5 (1,2,3,4,5) �������G�N�O <img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> .)<br />�����q <img src="images/rating5.gif" width="65" height="14" border="0" alt="best" /> (�̨�) �� <img src="images/rating0.gif" width="65" height="14" border="0" alt="worst" /> (�̮t).', 'offline', 0), //cpg1.3.0
  array('����O &quot;�ڪ��̷R &quot;?', '�o���\�����|���x�s�߷R���v��,�ݭn��cookie��T.', 'offline', 0), //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// File forgot_passwd.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FORGOT_PASSWD_PHP')) $lang_forgot_passwd_php = array(
  'forgot_passwd' => '�ѰO�K�X', //cpg1.3.0
  'err_already_logged_in' => '�A�w�g�n�J�F!', //cpg1.3.0
  'enter_username_email' => '��J�A���|���W�٩� email ', //cpg1.3.0
  'submit' => '�~��', //cpg1.3.0
  'failed_sending_email' => '�L�k�H�X�K�X�����l�� !', //cpg1.3.0
  'email_sent' => '�w�g�N�A���|���W�ٻP�K�X�H�� %s', //cpg1.3.0
  'err_unk_user' => '�S���o�ӷ|��!', //cpg1.3.0
  'passwd_reminder_subject' => '%s - �K�X����', //cpg1.3.0
  'passwd_reminder_body' => '�z���n�J��Ʀp�U:
Username: %s
Password: %s
�� %s �n�J.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
  'group_name' => '�s�զW��',
  'disk_quota' => '�Ϻаt�B',
  'can_rate' => '���\�Ϥ�����', //cpg1.3.0
  'can_send_ecards' => '���\�H�X�d��',
  'can_post_com' => '���\�K�X�d��',
  'can_upload' => '���\�W���ɮ�', //cpg1.3.0
  'can_have_gallery' => '���\�p�H��ï',
  'apply' => '�ק�',
  'create_new_group' => '�إ߷s�s��',
  'del_groups' => '�R���ҿ�ܪ��s��',
  'confirm_del' => 'ĵ�i, ��R���F�@�Ӹs��, �ݩ�Ӹs�ժ��Τ�N�Q�ಾ�� \'Registered\' �s�դ� !\n\nn�T�w�n�R���� ?', //js-alert //cpg1.3.0
  'title' => '�޲z�|���s��',
  'approval_1' => '���}��ï�W�Ǯ֭� (1)',
  'approval_2' => '�p�H��ï�W�Ǯ֭� (2)',
  'upload_form_config' => '�W�Ǯ榡�]�w', //cpg1.3.0
  'upload_form_config_values' => array( '�W�Ǥ@���ɮ�', '�h�ɤW��', '�u�W��URI ', '�u�W��ZIP ', 'File-URI', 'File-ZIP', 'URI-ZIP', 'File-URI-ZIP'), //cpg1.3.0
  'custom_user_upload'=>'�|���i�Ϊ��W�Ǯؼƶq?', //cpg1.3.0
  'num_file_upload'=>'�̤j/��� �ɮ� �W�Ǯؼƶq', //cpg1.3.0
  'num_URI_upload'=>'�̤j/��� URI �W�Ǯؼƶq', //cpg1.3.0
  'note1' => '<b>(1)</b> �W�ǹϤ��ܤ��}��ï�ݺ޲z���֭�',
  'note2' => '<b>(2)</b> �W�ǹϤ��ܨp�H��ï�ݺ޲z���֭�',
  'notes' => '�`�N',
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
  'welcome' => '�w�� !',
);

$lang_album_admin_menu = array(
  'confirm_delete' => '�T�w�n�R���o��ï ? \\n�Ҧ��Ϥ��ίd�����|�Q�R��.', //js-alert //cpg1.3.0
  'delete' => '�R��',
  'modify' => '�ݩ�',
  'edit_pics' => '�s��', //cpg1.3.0
);

$lang_list_categories = array(
  'home' => '��ï����',
  'stat1' => '<b>[pictures]</b> �i�v���� <b>[albums]</b> �Ӭ�ï�� <b>[cat]</b> �����O, �� <b>[comments]</b> �ӯd��, �Q�[�� <b>[views]</b> ��', //cpg1.3.0
  'stat2' => '<b>[pictures]</b> �i�v���� <b>[albums]</b> �Ӭ�ï, �Q�[�� <b>[views]</b> ��', //cpg1.3.0
  'xx_s_gallery' => '%s\'s ��ï',
  'stat3' => '<b>[pictures]</b> �i�v���� <b>[albums]</b> �Ӭ�ï, �� <b>[comments]</b> �ӯd��, �Q�[�� <b>[views]</b> ��', //cpg1.3.0
);

$lang_list_users = array(
  'user_list' => '�|���C��',
  'no_user_gal' => '�٨S���|����ï',
  'n_albums' => '%s �Ӭ�ï',
  'n_pics' => '%s �i�v��', //cpg1.3.0
);

$lang_list_albums = array(
  'n_pictures' => '%s �i�v��', //cpg1.3.0
  'last_added' => ', �̷s�v���� %s',
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
  'login' => '�n�J',
  'enter_login_pswd' => '��J�|���W�٩M�K�X',
  'username' => '�|���W��',
  'password' => '�K�X',
  'remember_me' => '�O���',
  'welcome' => '�w�� %s ...',
  'err_login' => '*** �L�k�n�J. �Э��� ***',
  'err_already_logged_in' => '�z�w�g�n�J !',
  'forgot_password_link' => '�ѰO�K�X�F', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
  'logout' => '�n�X',
  'bye' => '�A�� %s ...',
  'err_not_loged_in' => '�z�٨S���n�J !',
);

// ------------------------------------------------------------------------- //
// File phpinfo.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('PHPINFO_PHP')) $lang_phpinfo_php = array(
  'php_info' => 'PHP ���', //cpg1.3.0
  'explanation' => '�o�O�� PHP-function ���� <a href="http://www.php.net/phpinfo">phpinfo()</a>, Copermine �I���������e���.', //cpg1.3.0
  'no_link' => '����L�H�ݨ�A�� phpinfo �|���w���W�����I, �o�N�O���� ��A�H�޲z�������n�J�ɤ~�|�ݨ즹������]. �A����N�������s������L�H�]���|��ܦs�����~.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
  'upd_alb_n' => '��s��ï %s',
  'general_settings' => '�@��]�w',
  'alb_title' => '��ï���D',
  'alb_cat' => '��ï���O',
  'alb_desc' => '��ï�y�z',
  'alb_thumb' => '��ï�Y��',
  'alb_perm' => '��ï�v��',
  'can_view' => '���\�[�ݬ�ï���|��',
  'can_upload' => '�X�ȥi�W�ǹϤ�',
  'can_post_comments' => '�X�ȥi�o��d��',
  'can_rate' => '�X�ȥi���Ϥ�����',
  'user_gal' => '�|����ï',
  'no_cat' => '* �S�����O *',
  'alb_empty' => '��ï�O�Ū�',
  'last_uploaded' => '�̪�W��',
  'public_alb' => '����H (���}��ï)',
  'me_only' => '�u����',
  'owner_only' => '�u����ï�֦��H (%s) ',
  'groupp_only' => ' \'%s\' �s�ժ��|��',
  'err_no_alb_to_modify' => '��Ʈw���S���z�i�ק諸��ï.',
  'update' => '��s��ï', //cpg1.3.0
  'notice1' => '(*) �ھ� %s�s��%s �]�w', //cpg1.3.0 (do not translate %s!)
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
  'already_rated' => '��p, �z�w�g�����Ϥ�����', //cpg1.3.0
  'rate_ok' => '�z�������w�g�Q����',
  'forbidden' => '�A�����A�ۤv���Ϥ�����.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
 {SITE_NAME} ���޲z���|���־�z�|�ް_�ϷP�����, ���ڭ̤��i��f�d�C�@�����. �]���z���ݦP�N�Ҧ����u�O�N��@�̪��߳��ηN��, ���N��޲z�H�����߳� (���F�ѥL�̶K�X) �ä��t����k�߳d��.<br />
<br />
�z���ݦP�N���i�i�K����ⱡ, �ɤO, ���}, ������, �����d, ���`��a�w��, �Υ���i��H�k�����.  {SITE_NAME} �H���b����ɭԳ����v�L�o�ýs��z�i�K�����e. �åB�|���d�b����������Ƥw�s�b��Ʈw��. ���g�z���P�N, �ڭ̤��|�N�z������൹��L�H�ϥ�, ���L�ڭ̤��|������]�b�Ȧ欰�ӥ~������ƭt����d��.<br />
<br />
�����ϥ� cookies �b�z���q���W���x�s��T. �o�ˬO��K�z��r���s��. �z���q�l�l��a�}�u�O���ڭ̻{�ұz����ƦӤw.<br />
<br />
���U '�ڦP�N' �N��z�P�N�H�W����.
EOT;

$lang_register_php = array(
  'page_title' => '�|�����U',
  'term_cond' => '���ڻP�W�h',
  'i_agree' => '�ڦP�N',
  'submit' => '�T�{���U',
  'err_user_exists' => '�z�Ҷ�g���|���W�٤w�Q��L�|���ϥ�, �Э���@��',
  'err_password_mismatch' => '��ӱK�X���X, �Э���@��',
  'err_uname_short' => '�|���W�٦ܤֻ� 2 �Ӧr��',
  'err_password_short' => '�K�X�ܤֻ� 2 �Ӧr��',
  'err_uname_pass_diff' => '�|���W�٩M�K�X���i�H�ۦP',
  'err_invalid_email' => '�q�l�l�󤣥��T',
  'err_duplicate_email' => '�o�ӹq�l�l��w�g�Q��L�|���ϥ�',
  'enter_info' => '��J���U���',
  'required_info' => '���񪺸��',
  'optional_info' => '��񪺸��',
  'username' => '�|���W��',
  'password' => '�|���K�X',
  'password_again' => '�T�{�K�X',
  'email' => '�q�l�l��',
  'location' => '�~��a��',
  'interests' => '����',
  'website' => '�ӤH����',
  'occupation' => '¾�~',
  'error' => '���~',
  'confirm_email_subject' => '%s - ���U�{��',
  'information' => '�T��',
  'failed_sending_email' => '�ҵ��U���q�l�l��L�k�H�X !',
  'thank_you' => '�P�±z�����U.<br /><br />�@�ʧt���p��ҥαb�����q�l�l��N�|�e��z�Ҵ��Ѫ��H�c.',
  'acct_created' => '�z���b���w�g�إ�, �{�b�z�i�H�n�J',
  'acct_active' => '�z���b���w�g�ҥ�, �{�b�z�i�H�n�J',
  'acct_already_act' => '�z���b���w�g�ҥ� !',
  'acct_act_failed' => '���b���L�k�ҥ� !',
  'err_unk_user' => '�ҿ�ܪ��|���ä��s�b !',
  'x_s_profile' => '%s\'���ӤH���',
  'group' => '�s��',
  'reg_date' => '�[�J���',
  'disk_usage' => '�ϺШϥζq',
  'change_pass' => '�ק�K�X',
  'current_pass' => '�ثe���K�X',
  'new_pass' => '�s�K�X',
  'new_pass_again' => '�T�{�s�K�X',
  'err_curr_pass' => '�ثe���K�X�����T',
  'apply_modif' => '�ק�',
  'change_pass' => '�ק�K�X',
  'update_success' => '�A���ӤH��Ƥw�g��s',
  'pass_chg_success' => '�A���K�X�w�g�ק�',
  'pass_chg_error' => '�A���K�X�S���ק�',
  'notify_admin_email_subject' => '%s - ���U�q��', //cpg1.3.0
  'notify_admin_email_body' => '���@�ӷs�|���W�� "%s" �w�g�b�A����ï���U', //cpg1.3.0
);

$lang_register_confirm_email = <<<EOT
�P�±z�b {SITE_NAME} �����U

�z���|���W�� : "{USER_NAME}"
�z���K�X : "{PASSWORD}"

�бz���U�����s���H�Ұʱz���b��
�Ϊ̧⦹�s���K���s�����W.

{ACT_LINK}

�w��A(�p),

{SITE_NAME} �޲z�p��

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
  'title' => '�[�ݯd��',
  'no_comment' => '�٨S���d���i�H�[��',
  'n_comm_del' => '%s �ӯd���w�R��',
  'n_comm_disp' => '��ܪ��d���ƶq',
  'see_prev' => '�ݫe�@��',
  'see_next' => '�ݤU�@��',
  'del_comm' => '�R���ҿ諸�d��',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
  0 => '�j�M�Ϥ����e',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
  'page_title' => '�j�M�s�Ϥ�', //cpg1.3.0
  'select_dir' => '��ܥؿ�',
  'select_dir_msg' => '���\��i�H���A�� FTP �W�Ǿ��Ϥ�.<br /><br />�п�ܧA�w�W�ǹϤ����ؿ�', //cpg1.3.0
  'no_pic_to_add' => '�S���Ϥ��i�H�[�J', //cpg1.3.0
  'need_one_album' => '�ϥΦ��\�ॲ�ݦܤ֭n���@�Ӭ�ï',
  'warning' => 'ĵ�i',
  'change_perm' => '�{���L�k�g�J�o�ӥؿ�, �Эק��v���� 755 �� 777 ��A�դ@�� !', //cpg1.3.0
  'target_album' => '<b>��Ϥ��� &quot;</b>%s<b>&quot; ��� </b>%s', //cpg1.3.0
  'folder' => '��Ƨ�',
  'image' => '�Ϥ�',
  'album' => '��ï',
  'result' => '���G',
  'dir_ro' => '�L�k�g�J. ',
  'dir_cant_read' => '�L�kŪ��. ',
  'insert' => '�s�W�Ϥ��ܬ�ï', //cpg1.3.0
  'list_new_pic' => '�s�Ϥ��C��', //cpg1.3.0
  'insert_selected' => '�[�J�ҿ�ܪ��Ϥ�', //cpg1.3.0
  'no_pic_found' => '�S�����s�Ϥ�', //cpg1.3.0
  'be_patient' => '�Э@�ߵ���, �{���ݭn�@�I�ɶ��ӥ[�J�ҿ�Ϥ�', //cpg1.3.0
  'no_album' => '�S����ܪ���ï',  //cpg1.3.0
  'notes' =>  '<ul>'.
                          '<li><b>OK</b> : ��ܹϤ��w���\�Q�[�J'.
                          '<li><b>DP</b> : ��ܹϤ����ЩΤw�s�b��Ʈw'.
                          '<li><b>PB</b> : ��ܹϤ��L�k�[�J, ���ˬd�]�w�ιϤ��s��ؿ����v��'.
                          '<li><b>NA</b> : ��ܧA�٨S����ܹϤ�����ï, �� \'<a href="javascript:history.back(1)">��^</a>\' �ÿ�ܬ�ï. �p�G�A�S����ï <a href="albmgr.php">�Х��إߤ@��</a></li>'.
                          '<li>�p�G OK, DP, PB \'�Ÿ�\' �S����ܽЫ��a�����Ϥ��d�� PHP ��ܪ����~�T��'.
                          '<li>�p�G�s�����O��, �Ы����s��z'.
                          '</ul>', //cpg1.3.0
  'select_album' => '��ܬ�ï', //cpg1.3.0
  'check_all' => '����', //cpg1.3.0
  'uncheck_all' => '������', //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //

// Void

// ------------------------------------------------------------------------- //
// File banning.php
// ------------------------------------------------------------------------- //

if (defined('BANNING_PHP')) $lang_banning_php = array(
  'title' => '���׷|��',
  'user_name' => '�|���W��',
  'ip_address' => 'IP��}',
  'expiry' => '�����]�ťեN��ä[���v�^',
  'edit_ban' => '�x�s�ק�',
  'delete_ban' => '�R��',
  'add_new' => '�s�W���׷|��',
  'add_ban' => '�s�W',
  'error_user' => '�䤣��ӷ|�����W��!�A�S�����a.. ', //cpg1.3.0
  'error_specify' => '�A�ݭn��������|���W�٩�IP��}', //cpg1.3.0
  'error_ban_id' => '�L�Ī� ID!', //cpg1.3.0
  'error_admin_ban' => '�O�x�F �A�L�k�N�ۤv���v!', //cpg1.3.0
  'error_server_ban' => '�A�n�N�ۤv�����A�����v? �u..���n�A�A�_�F...', //cpg1.3.0
  'error_ip_forbidden' => '�A�L�k�T��o�� IP - ���O non-routable!', //cpg1.3.0
  'lookup_ip' => '�d�� IP ��}', //cpg1.3.0
  'submit' => '����!', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
  'title' => '�W���ɮ�', //cpg1.3.0
  'custom_title' => '�W�ǿﶵ��', //cpg1.3.0
  'cust_instr_1' => '�A�i�H�q�U�C ��ܤ@�ӤW�Ǯ� �i��W��.', //cpg1.3.0
  'cust_instr_2' => '��ܤW�Ǯظ�', //cpg1.3.0
  'cust_instr_3' => '�ɮפW�Ǯ�: %s', //cpg1.3.0
  'cust_instr_4' => 'URI/URL �W�Ǯ�: %s', //cpg1.3.0
  'cust_instr_5' => 'URI/URL �W�Ǯ�:', //cpg1.3.0
  'cust_instr_6' => '�ɮפW�Ǯ�:', //cpg1.3.0
  'cust_instr_7' => '�п�J�z�ثe�ݭn�� �C�@�ؤW�Ǯت��ƶq. �M��� \'�~��\'. ', //cpg1.3.0
  'reg_instr_1' => '�L�Ī��ﶵ��ʧ@.', //cpg1.3.0
  'reg_instr_2' => '�{�b �A�i�H�ΥH�U���W�Ǯ� �W�ǧA���ɮ�. �C�@�ӤW���ɮת��j�p���i�H�W�L %s KB . ZIP �ɮפW�Ǧb \'�ɮפW��\' and \'URI/URL �W��\' �� .', //cpg1.3.0
  'reg_instr_3' => '�p�G�A�n�W�����Y�ɩέn�����Y, �����ϥ��ɮפW�Ǯ� \'�����YZIP �W��\' ��.', //cpg1.3.0
  'reg_instr_4' => '�p�G��ܥH URI/URL �W��, �п�J�ɮ׳s�����| �p: http://www.mysite.com/images/example.jpg', //cpg1.3.0
  'reg_instr_5' => '�����ﶵ���,�Ы� \'�~��\'.', //cpg1.3.0
  'reg_instr_6' => '�����YZIP �W��:', //cpg1.3.0
  'reg_instr_7' => '�ɮ� �W��:', //cpg1.3.0
  'reg_instr_8' => 'URI/URL �W��:', //cpg1.3.0
  'error_report' => '���~���i', //cpg1.3.0
  'error_instr' => '�U�C�W�ǹJ����~:', //cpg1.3.0
  'file_name_url' => '�ɮ� �W��/URL', //cpg1.3.0
  'error_message' => '���~�T��', //cpg1.3.0
  'no_post' => '�ɮרS���Q�W��.', //cpg1.3.0
  'forb_ext' => '�����\�����ɦW.', //cpg1.3.0
  'exc_php_ini' => '�ɮ׶W�Lphp.ini���\���j�p.', //cpg1.3.0
  'exc_file_size' => '�ɮ׶W�LCPG���\���j�p.', //cpg1.3.0
  'partial_upload' => '�u�������W��.', //cpg1.3.0
  'no_upload' => '�S���W��.', //cpg1.3.0
  'unknown_code' => '������ PHP �W�ǿ��~�X.', //cpg1.3.0
  'no_temp_name' => '�S���W�� - �L�Ȧs�ɦW.', //cpg1.3.0
  'no_file_size' => '�S�����e', //cpg1.3.0
  'impossible' => '�L�k����.', //cpg1.3.0
  'not_image' => '�o���O�зǼv����', //cpg1.3.0
  'not_GD' => '�o���O GD ���ɦW.', //cpg1.3.0
  'pixel_allowance' => '�v���ؤo�Ӥj�F.', //cpg1.3.0
  'incorrect_prefix' => '�����T�� URI/URL �e��', //cpg1.3.0
  'could_not_open_URI' => '�L�k�}��URI.', //cpg1.3.0
  'unsafe_URI' => '�w���ʥ��Q�{��.', //cpg1.3.0
  'meta_data_failure' => '�ഫ��ƥ���', //cpg1.3.0
  'http_401' => '401 ���Q���v�s��', //cpg1.3.0
  'http_402' => '402 ���B�ݥI�O�s��', //cpg1.3.0
  'http_403' => '403 �ثe���B�����T���s��', //cpg1.3.0
  'http_404' => '404 ���A���S���^��', //cpg1.3.0
  'http_500' => '500 �������A�����~', //cpg1.3.0
  'http_503' => '503 ���A�����ݹL�[ ����A��', //cpg1.3.0
  'MIME_extraction_failure' => '�L�k�T�{ MIME.', //cpg1.3.0
  'MIME_type_unknown' => '������ MIME type', //cpg1.3.0
  'cant_create_write' => '�L�k�s�W�g�J�ɮ�.', //cpg1.3.0
  'not_writable' => '�L�k�g�J.', //cpg1.3.0
  'cant_read_URI' => '�L�kŪ�� URI/URL', //cpg1.3.0
  'cant_open_write_file' => '�L�k�}��URI .', //cpg1.3.0
  'cant_write_write_file' => '�L�k�g�JURI .', //cpg1.3.0
  'cant_unzip' => '�L�k�����Y.', //cpg1.3.0
  'unknown' => '���������~', //cpg1.3.0
  'succ' => '���\�W��', //cpg1.3.0
  'success' => '%s �W�Ǥw�g����.', //cpg1.3.0
  'add' => '�Ы� \'�~��\' �W�[�ɮר��ï.', //cpg1.3.0
  'failure' => '�W�ǥ���', //cpg1.3.0
  'f_info' => '�ɮ׸�T', //cpg1.3.0
  'no_place' => '���e���ɮ׵L�k�Q�t�m.', //cpg1.3.0
  'yes_place' => '���e���ɮפw�g�t�m����.', //cpg1.3.0
  'max_fsize' => '�̤j���\�ɮפj�p�O %s KB',
  'album' => '��ï',
  'picture' => '�Ϥ�', //cpg1.3.0
  'pic_title' => '�Ϥ����D', //cpg1.3.0
  'description' => '�Ϥ��y�z', //cpg1.3.0
  'keywords' => '����r (�H�Ů�Ϲj)',
  'err_no_alb_uploadables' => '�ثe�|������ï�i�H�W�ǹϤ�', //cpg1.3.0
  'place_instr_1' => '�{�b �бN�Ϥ�����ï.  �A�{�b�i�H��J�o���ɮת�������T.', //cpg1.3.0
  'place_instr_2' => '��h���Ϥ��ݭn�t�m. �Ы� \'�~��\'.', //cpg1.3.0
  'process_complete' => '����  �A�w�g���\���N�����ɮפW�ǤF.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
  'title' => '�|���޲z',
  'name_a' => '�W�� �Ѥp�ܤj',
  'name_d' => '�W�� �Ѥj�ܤp',
  'group_a' => '�s�� �Ѥp�ܤj',
  'group_d' => '�s�� �Ѥj�ܤp',
  'reg_a' => '���U��� �ѻ��ܪ�',
  'reg_d' => '���U��� �Ѫ�ܻ�',
  'pic_a' => '�Ϥ��� �Ѥp�ܤj',
  'pic_d' => '�Ϥ��� �Ѥj�ܤp',
  'disku_a' => '�ϺХζq �Ѥp�ܤj',
  'disku_d' => '�ϺХζq �Ѥj�ܤp',
  'lv_a' => '�̪�ӳX �Ѫ�ܻ�', //cpg1.3.0
  'lv_d' => '�̪�ӳX �ѻ��ܪ�', //cpg1.3.0
  'sort_by' => '�|���ƧǨ�',
  'err_no_users' => '�|����ƪ�O�Ū� !',
  'err_edit_self' => '�z�L�k�s��z���ӤH���, �ЧQ�� \'�ڪ��ӤH���\' �ӽs��',
  'edit' => '�s��',
  'delete' => '�R��',
  'name' => '�|���W��',
  'group' => '�s��',
  'inactive' => '���Ұ�',
  'operations' => '�ާ@',
  'pictures' => '�Ϥ�', //cpg1.3.0
  'disk_space' => '�Ϻ� �ζq / ���B',
  'registered_on' => '���U��',
  'last_visit' => '�̪�ӳX', //cpg1.3.0
  'u_user_on_p_pages' => '%d �ӷ|���� %d ��',
  'confirm_del' => '�T�w�n�R���o�ӷ|����? \\n�Ҧ��L����ï�ιϤ����|�Q�R��.', //js-alert //cpg1.3.0
  'mail' => '�q�l�l��',
  'err_unknown_user' => '�ҿ�ܪ��|���ä��s�b !',
  'modify_user' => '�s��|��',
  'notes' => '�`�N',
  'note_list' => '<li>�p�G���Q���ܥثe���K�X, �бN "�K�X" ��d�U�ť�',
  'password' => '�K�X',
  'user_active' => '�|���w�Ұ�',
  'user_group' => '�|���s��',
  'user_email' => '�|���q�l�l��',
  'user_web_site' => '�|�����}',
  'create_new_user' => '�إ߷s�|��',
  'user_location' => '�|���a��',
  'user_interests' => '�|������',
  'user_occupation' => '�|��¾�~',
  'latest_upload' => '�̷s�W��', //cpg1.3.0
  'never' => '�q����', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
  'title' => '�޲z���u�� (�վ�Ϥ��j�p)', //cpg1.3.0
  'what_it_does' => '�\��',
  'what_update_titles' => '�q�ɮצW�٧�s�Ϥ����D',
  'what_delete_title' => '�R�����D',
  'what_rebuild' => '�����Y�Ϥνվ�Ϥ��j�p',
  'what_delete_originals' => '���s�վ�᪺�Ϥ��N ���N�즳���Ϥ�',
  'file' => '�ɮ�',
  'title_set_to' => '���D�ܧ�',
  'submit_form' => '�T�{',
  'updated_succesfully' => '��s �w�g����',
  'error_create' => '���Ϳ��~',
  'continue' => '�~������L���v��',
  'main_success' => '�ɮ� %s �w�]���D��',  //cpg1.3.0
  'error_rename' => '���~ %s ��W�� %s', 
  'error_not_found' => '�䤣���ɮ� %s ',
  'back' => '�^�D��',
  'thumbs_wait' => '��s�Y�� �B/�� �վ�v���ؤo, �еy��...',
  'thumbs_continue_wait' => '�~�� ��s�Y�� �B/�� �վ�v���ؤo...',
  'titles_wait' => '��s���D, �еy��...',
  'delete_wait' => '�R�����D, �еy��...',
  'replace_wait' => '���s�վ�᪺�Ϥ��N ���N�즳���Ϥ���, �еy��...',
  'instruction' => '²���ާ@����',
  'instruction_action' => '�п�ܾާ@',
  'instruction_parameter' => '�]�w�Ѽ�',
  'instruction_album' => '��ܬ�ï',
  'instruction_press' => '�Ы� %s',
  'update' => '��s�Y�� �B/�� �վ�Ϥ��j�p',
  'update_what' => '�n��s����',
  'update_thumb' => '�u���Y��',
  'update_pic' => '�u�վ�Ϥ��j�p',
  'update_both' => '��s�Y�ϥB�վ�Ϥ��ؤo',
  'update_number' => '�C�I��@���n�B�z���Ϥ��ƥ�',
  'update_option' => '(�p�G�z�J��ާ@�{�ǹO�ɪ����D�A�иյۭ��C���]�w)',
  'filename_title' => '�ɮצW�� &rArr; �Ϥ����D', //cpg1.3.0
  'filename_how' => '�p��ק��ɦW', 
  'filename_remove' => '�R�� .jpg �ñN _ (���u) �ΪŮ���N', 
  'filename_euro' => '�N 2003_11_23_13_20_20.jpg �אּ 23/11/2003 13:20', 
  'filename_us' => '�N 2003_11_23_13_20_20.jpg �אּ 11/23/2003 13:20', 
  'filename_time' => '�N 2003_11_23_13_20_20.jpg �אּ 13:20', 
  'delete' => '�R���Ϥ����D�έ�l�ؤo���Ϥ�', //cpg1.3.0
  'delete_title' => '�R���Ϥ����D', //cpg1.3.0
  'delete_original' => '�R����l�ؤo���Ϥ�',
  'delete_replace' => '�R����l�ؤo���Ϥ��åH�վ�ؤo���Ϥ����N',
  'select_album' => '��ܬ�ï',
  'delete_orphans' => '�R���s�����d��(���������ï)', //cpg1.3.0
  'orphan_comment' => '�o�{�s�����d��', //cpg1.3.0
  'delete' => '�R��', //cpg1.3.0
  'delete_all' => '�����R��', //cpg1.3.0
  'comment' => '�d��: ', //cpg1.3.0
  'nonexist' => '�n���[���ɮפ��s�b # ', //cpg1.3.0
  'phpinfo' => '��� phpinfo ���', //cpg1.3.0
  'update_db' => '��s��Ʈw', //cpg1.3.0
  'update_db_explanation' => '�p�G�p����s CPG �ɮ�, �[�J�ק�ΥѥH�e�������ɯ�, �нT�w����@����Ʈw��s. �o�N�|�b CPG ��Ʈw�s�W���n����ƪ� ��/�� �]�w��.', //cpg1.3.0
);

?>