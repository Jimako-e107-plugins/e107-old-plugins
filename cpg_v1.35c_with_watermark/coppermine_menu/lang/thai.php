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
// CVS version: $Id: thai.php,v 1.3 2005/03/22 07:24:31 gaugau Exp $
// ------------------------------------------------------------------------- //

// info about translators and translated language
$lang_translation_info = array(
  'lang_name_english' => 'Thailand',
  'lang_name_native' => 'Thailand',
  'lang_country_code' => 'th',
  'trans_name'=> 'Thanit T.',
  'trans_email' => 'webmaster@thaioffroader.net',
  'trans_website' => 'http://www.thaioffroader.net/',
  'trans_date' => '2005-03-18',
);

$lang_charset = 'Tis-620';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('�ҷԵ���', '�ѹ���', '�ѧ���', '�ظ', '����ʺ��', '�ء��', '�����t');
$lang_month = array('�.�.', '�.�.', '��.�.', '��.�.', '�.�.', '��.�.', '�.�.', '�.�.', '�.�.', '�.�.', '�.�.', '�.�.');

// Some common strings
$lang_yes = '��';
$lang_no  = '�����';
$lang_back = '��͹��Ѻ';
$lang_continue = '����';
$lang_info = '�ô��Һ';
$lang_error = '�Դ�����Դ��Ҵ';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%B %d, %Y';
$lastcom_date_fmt =  '%m/%d/%y at %H:%M'; //cpg1.3.0
$lastup_date_fmt = '%B %d, %Y';
$register_date_fmt = '%B %d, %Y';
$lasthit_date_fmt = '%B %d, %Y at %I:%M %p'; //cpg1.3.0
$comment_date_fmt =  '%B %d, %Y at %I:%M %p'; //cpg1.3.0

// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*', '���', '��', '���', 'ᵴ');

$lang_meta_album_names = array(
  'random' => '�����Ҿ', //cpg1.3.0
  'lastup' => '��������ش',
  'lastalb'=> '�������ش',
  'lastcom' => '�����������ش',
  'topn' => '��Ҫ��ҡ�ش',
  'toprated' => '��ṹ�٧�ش',
  'lasthits' => '�ʴ�����ش',
  'search' => '�š�ä���',
  'favpics'=> '�ٻ����蹪ͺ', //cpg1.3.0
);

$lang_errors = array(
  'access_denied' => '�س������Ѻ͹حҵ�����ҹ�˹�����',
  'perm_denied' => '�س������Ѻ͹حҵ�����ҹ',
  'param_missing' => 'ʤ�Ի��١���¡������վ���������',
  'non_exist_ap' => '������ٻ/��ź������س���͡', //cpg1.3.0
  'quota_exceeded' => '��Ҵ��ʤ���͹حҵ����<br /><br />�س���Ѻ��Ҵ���͹حҵ [quota]K, �Ҿ�ͧ�س�բ�Ҵ [space]K, ��������Ҿ���з���颹Ҵ��ʤ������Ѻ͹حҵ����', //cpg1.3.0
  'gd_file_type_err' => '������� GD image library ��͹حҵ੾�� JPEG ��� PNG.',
  'invalid_image' => '�ٻ������� �����������ö��Ѻ GD library',
  'resize_failed' => '�������ö�ʴ��Ҿ��� ������͢�Ҵ�Ҿ',
  'no_img_to_display' => '������Ҿ�����ʴ�',
  'non_exist_cat' => '�������Ǵ������س���͡',
  'orphan_cat' => '�������Ǵ������ѡ, ��س�����ǹ�Ѵ�����Ǵ�����������', //cpg1.3.0
  'directory_ro' => '��ä����� \'%s\' �������ö��¹�Ҿ��, �Ҿ�������öź��', //cpg1.3.0
  'non_exist_comment' => '����դ�����繷��س���͡',
  'pic_in_invalid_album' => '�Ҿ������������ź����� (%s)!?', //cpg1.3.0
  'banned' => '�س��зӡ�á�͡ǹ������ҧ������������繼�����֧���ʧ�� �ҡ�����ش��зӡ����Ҩ��駤������ʹ��Թ���',
  'not_with_udb' => '��ǹ���١¡��ԡ �����Ҩ������Դ����������¡Ѻ��������',
  'offline_title' => '����Դ��ҹ', //cpg1.3.0
  'offline_text' => '����������ش��ҹ���Ǥ��� - ��سҡ�Ѻ�������ա����', //cpg1.3.0
  'ecards_empty' => '����� ecard �����ʴ� ��سҵ�Ǩ�ͺ��ҡ���ʴ� ecard � config', //cpg1.3.0
  'action_failed' => '�������ö��з���', //cpg1.3.0
  'no_zip' => '��辺�ź�������Ѵ��� �Ҿ ZIP ��سҵԴ��ͼ������к�', //cpg1.3.0
  'zip_type' => '�س������Ѻ͹حҵ����Ѿ��Ŵ�Ҿ ZIP', //cpg1.3.0
);

$lang_bbcode_help = '������ҹ���Ҩ�������س�дǡ���: <li>[b]<b>���˹�</b>[/b]</li> <li>[i]<i>������§</i>[/i]</li> <li>[url=http://yoursite.com/]Url Text[/url]</li> <li>[email]user@domain.com[/email]</li>'; //cpg1.3.0

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
  'alb_list_title' => '价����¡����ź���',
  'alb_list_lnk' => '��¡����ź���',
  'my_gal_title' => '价����ź�����ǹ��Ǣͧ�ѹ',
  'my_gal_lnk' => '��������ͧ�ѹ',
  'my_prof_lnk' => '��������ǹ��Ǣͧ�ѹ',
  'adm_mode_title' => '����¹���к��������к�',
  'adm_mode_lnk' => '�к��������к�',
  'usr_mode_title' => '����¹���к������',
  'usr_mode_lnk' => '�к������',
  'upload_pic_title' => '�Ѿ��Ŵ�Ҿ价����ź���', //cpg1.3.0
  'upload_pic_lnk' => '�Ѿ��Ŵ�Ҿ', //cpg1.3.0
  'register_title' => '���ҧ����¹�����',
  'register_lnk' => '��Ѥ���Ҫԡ',
  'login_lnk' => 'Login',
  'logout_lnk' => 'Logout',
  'lastup_lnk' => '�Ѿ��Ŵ����ش ',
  'lastcom_lnk' => '�����������ش ',
  'topn_lnk' => '�ʴ��ҡ�ش ',
  'toprated_lnk' => '��ṹ�٧�ش ',
  'search_lnk' => '����',
  'fav_lnk' => 'My Favorites',
  'memberlist_title' => '��ª�����Ҫԡ', //cpg1.3.0
  'memberlist_lnk' => '�ʴ���ª�����Ҫԡ', //cpg1.3.0
  'faq_title' => '�Ӷ������������ &quot;Coppermine&quot;', //cpg1.3.0
  'faq_lnk' => 'FAQ', //cpg1.3.0
);

$lang_gallery_admin_menu = array(
  'upl_app_lnk' => '��Ǩ�ͺ����Ѿ��Ŵ',
  'config_lnk' => '�Ѵ����к�',
  'albums_lnk' => '��ź���',
  'categories_lnk' => '��Ǵ����',
  'users_lnk' => '�����',
  'groups_lnk' => '�����',
  'comments_lnk' => '�ʴ��������', //cpg1.3.0
  'searchnew_lnk' => '�����Ҿ������ͧ', //cpg1.3.0
  'util_lnk' => '����ͧ��ͼ������к�', //cpg1.3.0
  'ban_lnk' => '���������',
  'db_ecard_lnk' => '�ʴ� Ecards', //cpg1.3.0
);

$lang_user_admin_menu = array(
  'albmgr_lnk' => '���ҧ/ ��� ��ź����ͧ�ѹ',
  'modifyalb_lnk' => '�����ź����ͧ�ѹ',
  'my_prof_lnk' => '��������ǹ���',
);

$lang_cat_list = array(
  'category' => '��Ǵ����',
  'albums' => '��ź���',
  'pictures' => '�Ҿ', //cpg1.3.0
);

$lang_album_list = array(
  'album_on_page' => '%d ��ź��� � %d ˹��',
);

$lang_thumb_view = array(
  'date' => '�ѹ���',
  //Sort by filename and title
  'name' => '�����Ҿ',
  'title' => '��������ͧ',
  'sort_da' => '���§�ѹ��� ������ҡ',
  'sort_dd' => '���§�ѹ��� �ҡ仹���',
  'sort_na' => '���§���� ������ҡ',
  'sort_nd' => '���§���� �ҡ仹���',
  'sort_ta' => '���§��������ͧ ������ҡ',
  'sort_td' => '���§��������ͧ �ҡ仹���',
  'download_zip' => '��ǹ���Ŵ�Ҿ Zip', //cpg1.3.0
  'pic_on_page' => '%d �Ҿ � %d ˹��',
  'user_on_page' => '%d ����� � %d ˹��', //cpg1.3.0
);

$lang_img_nav_bar = array(
  'thumb_title' => '��Ѻ�˹���ʴ��Ҿ���',
  'pic_info_title' => '�ʴ�/��͹ ���������´�Ҿ', //cpg1.3.0
  'slideshow_title' => '��Ŵ�',
  'ecard_title' => '���� e-card', //cpg1.3.0
  'ecard_disabled' => 'e-cards ��ҹ�����',
  'ecard_disabled_msg' => '�س������Ѻ͹حҵ����� ecards', //js-alert //cpg1.3.0
  'prev_title' => '���Ҿ��͹˹��', //cpg1.3.0
  'next_title' => '���Ҿ�Ѵ�', //cpg1.3.0
  'pic_pos' => '�Ҿ %s/%s', //cpg1.3.0
);

$lang_rate_pic = array(
  'rate_this_pic' => '����ṹ�Ҿ��� ', //cpg1.3.0
  'no_votes' => '(�ѧ�������ṹ)',
  'rating' => '(��ṹ�͹��� : %s / 5 with %s votes)',
  'rubbish' => '����ҡ',
  'poor' => '��ͧ��Ѻ��ا',
  'fair' => '����',
  'good' => '��',
  'excellent' => '���ҡ',
  'great' => '����..�����Ҩ���!!  �ѹ�ʹ�ҡ...',
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
  CRITICAL_ERROR => '�Դ�����Դ��Ҵ�����ç',
  'file' => '�Ҿ: ',
  'line' => '��÷Ѵ���: ',
);

$lang_display_thumbnails = array(
  'filename' => '�����Ҿ : ',
  'filesize' => '��Ҵ�Ҿ : ',
  'dimensions' => '��Ҵ�Ҿ : ',
  'date_added' => '�ѹ������� : ', //cpg1.3.0
);

$lang_get_pic_data = array(
  'n_comments' => '%s �������',
  'n_views' => '%s �ʴ�',
  'n_votes' => '(%s ��ǵ)',
);

$lang_cpg_debug_output = array(
  'debug_info' => 'Debug Info', //cpg1.3.0
  'select_all' => '���͡������', //cpg1.3.0
  'copy_and_paste_instructions' => '�ҡ�س��ͧ��ä�����������ͺ� coppermine support board, ��ͻ��� debug output ��ҧ���ǹ�ͧ�Ӣͧ͢�س ��������������¹ password �� *** ��͹�ʵ��ͤ���', //cpg1.3.0
  'phpinfo' => '�ʴ� phpinfo', //cpg1.3.0
);

$lang_language_selection = array(
  'reset_language' => '������ѡ', //cpg1.3.0
  'choose_language' => '��س����͡����', //cpg1.3.0
);

$lang_theme_selection = array(
  'reset_theme' => '�����ѡ', //cpg1.3.0
  'choose_theme' => '��س����͡���', //cpg1.3.0
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
  0 => '�͡�ҡ�������к�...',
  1 => '������������к�...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
  'alb_need_name' => '��سҵ�駪�����ź��� !', //js-alert
  'confirm_modifs' => '�س��㨷�������¹��ҵ����� ?', //js-alert
  'no_change' => '�س���������¹���� !', //js-alert
  'new_album' => '���ҧ��ź�������',
  'confirm_delete1' => '�س��㨷���ź��ź������ ?', //js-alert
  'confirm_delete2' => '\n �Ҿ��Ф�����繨ж١ź !', //js-alert
  'select_first' => '��س����͡��ź�����͹', //js-alert
  'alb_mrg' => '�Ѵ�����ź���',
  'my_gallery' => '* ��������ͧ�ѹ *',
  'no_category' => '* �������Ǵ���� *',
  'delete' => 'ź',
  'new' => '����',
  'apply_modifs' => '�ѹ�֡�������¹�ŧ',
  'select_category' => '���͡��Ǵ����',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
  'miss_param' => '��������������Ѻ \'%s\' �������ö�觤������ !',
  'unknown_cat' => '��Ǵ���������͡�����㹰ҹ������',
  'usergal_cat_ro' => '��ź����Ҿ��Ҫԡ�������öź�� !',
  'manage_cat' => '�Ѵ�����Ǵ����',
  'confirm_delete' => '�س��㨷���ź��Ǵ������ ?', //js-alert
  'category' => '��Ǵ����',
  'operations' => '�Ѵ���',
  'move_into' => '�����',
  'update_create' => '��Ѻ��ا/���ҧ ��Ǵ����',
  'parent_cat' => '��Ǵ������ѡ',
  'cat_title' => '��͸Ժ����Ǵ����',
  'cat_thumb' => '�ҾẺ��ͧ͢��Ǵ����', //cpg1.3.0
  'cat_desc' => '��������´�ͧ��Ǵ����',
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
  'title' => '��˹����',
  'restore_cfg' => '��Ѻ�������ѡ�ͧ�к�',
  'save_cfg' => '�ѹ�֡�������',
  'notes' => '�ѹ�֡�������',
  'info' => '���й�',
  'upd_success' => '��õ�駤�� Coppermine �١�ѹ�֡����',
  'restore_success' => '��õ�駤����ѡ�ͧ�к� Coppermine �١���¡�׹����',
  'name_a' => '���� ������ҡ',
  'name_d' => '���� �ҡ仹���',
  'title_a' => '��͸Ժ�� ������ҡ',
  'title_d' => '��͸Ժ�� �ҡ仹���',
  'date_a' => '�ѹ��� ������ҡ',
  'date_d' => '�ѹ��� �ҡ仹���',
  'th_any' => '�Ѵ��ǹ�ѵ��ѵ�',
  'th_ht' => '��ǹ�٧',
  'th_wd' => '�������ҧ',
  'label' => '����', //cpg1.3.0
  'item' => '��������´', //cpg1.3.0
  'debug_everyone' => '�ء��', //cpg1.3.0
  'debug_admin' => '੾�м������к�', //cpg1.3.0
        );

if (defined('CONFIG_PHP')) $lang_config_data = array(
  'General settings',
  array('Gallery name', 'gallery_name', 0),
  array('Gallery description', 'gallery_description', 0),
  array('Gallery administrator email', 'gallery_admin_email', 0),
  array('Target address for the \'See more pictures\' link in e-cards', 'ecards_more_pic_target', 0),
  array('Gallery is offline', 'offline', 1), //cpg1.3.0
  array('Log ecards', 'log_ecards', 1), //cpg1.3.0
  array('Allow ZIP-download of favorites', 'enable_zipdownload', 1), //cpg1.3.0

  'Language, Themes &amp; Charset settings',
  array('Language', 'lang', 5),
  array('Theme', 'theme', 6),
  array('Display language list', 'language_list', 1), //cpg1.3.0
  array('Display language flags', 'language_flags', 8), //cpg1.3.0
  array('Display &quot;reset&quot; in language selection', 'language_reset', 1), //cpg1.3.0
  array('Display theme list', 'theme_list', 1), //cpg1.3.0
  array('Display &quot;reset&quot; in theme selection', 'theme_reset', 1), //cpg1.3.0
  array('Display FAQ', 'display_faq', 1), //cpg1.3.0
  array('Display bbcode help', 'show_bbcode_help', 1), //cpg1.3.0
  array('Character encoding', 'charset', 4), //cpg1.3.0

  'Album list view',
  array('Width of the main table (pixels or %)', 'main_table_width', 0),
  array('Number of levels of categories to display', 'subcat_level', 0),
  array('Number of albums to display', 'albums_per_page', 0),
  array('Number of columns for the album list', 'album_list_cols', 0),
  array('Size of thumbnails in pixels', 'alb_list_thumb_size', 0),
  array('The content of the main page', 'main_page_layout', 0),
  array('Show first level album thumbnails in categories','first_level',1),

  'Thumbnail view',
  array('Number of columns on thumbnail page', 'thumbcols', 0),
  array('Number of rows on thumbnail page', 'thumbrows', 0),
  array('Maximum number of tabs to display', 'max_tabs', 10), //cpg1.3.0
  array('Display file caption (in addition to title) below the thumbnail', 'caption_in_thumbview', 1), //cpg1.3.0
  array('Display number of views below the thumbnail', 'views_in_thumbview', 1), //cpg1.3.0
  array('Display number of comments below the thumbnail', 'display_comment_count', 1),
  array('Display uploader name below the thumbnail', 'display_uploader', 1), //cpg1.3.0
  array('Default sort order for files', 'default_sort_order', 3), //cpg1.3.0
  array('Minimum number of votes for a file to appear in the \'top-rated\' list', 'min_votes_for_rating', 0), //cpg1.3.0

  'Image view &amp; Comment settings',
  array('Width of the table for file display (pixels or %)', 'picture_table_width', 0), //cpg1.3.0
  array('File information is visible by default', 'display_pic_info', 1), //cpg1.3.0
  array('Filter bad words in comments', 'filter_bad_words', 1),
  array('Allow smiles in comments', 'enable_smilies', 1),
  array('Allow several consecutive comments on one file from the same user (disable flood protection)', 'disable_comment_flood_protect', 1), //cpg1.3.0
  array('Max length for an image description', 'max_img_desc_length', 0),
  array('Max number of characters in a word', 'max_com_wlength', 0),
  array('Max number of lines in a comment', 'max_com_lines', 0),
  array('Maximum length of a comment', 'max_com_size', 0),
  array('Show film strip', 'display_film_strip', 1),
  array('Number of items in film strip', 'max_film_strip_items', 0),
  array('Notify admin of comments by email', 'email_comment_notification', 1), //cpg1.3.0
  array('Slideshow interval in milliseconds (1 second = 1000 milliseconds)', 'slideshow_interval', 0), //cpg1.3.0

  'Files and thumbnails settings', //cpg1.3.0
  array('Quality for JPEG files', 'jpeg_qual', 0),
  array('Max dimension of a thumbnail <a href="#notice2" class="clickable_option">**</a>', 'thumb_width', 0), //cpg1.3.0
  array('Use dimension ( width or height or Max aspect for thumbnail )<b>**</b>', 'thumb_use', 7),
  array('Create intermediate pictures','make_intermediate',1),
  array('Max width or height of an intermediate picture/video <a href="#notice2" class="clickable_option">**</a>', 'picture_width', 0), //cpg1.3.0
  array('Max size for uploaded files (KB)', 'max_upl_size', 0), //cpg1.3.0
  array('Max width or height for uploaded pictures/videos (pixels)', 'max_upl_width_height', 0), //cpg1.3.0

  'Files and thumbnails advanced settings', //cpg1.3.0
  array('Show private album Icon to unlogged user','show_private',1), //cpg1.3.0
  array('Characters forbidden in filenames', 'forbiden_fname_char',0), //cpg1.3.0
  //array('Accepted file extensions for uploaded pictures', 'allowed_file_extensions',0), //cpg1.3.0
  array('Allowed image types', 'allowed_img_types',0), //cpg1.3.0
  array('Allowed movie types', 'allowed_mov_types',0), //cpg1.3.0
  array('Allowed audio types', 'allowed_snd_types',0), //cpg1.3.0
  array('Allowed document types', 'allowed_doc_types',0), //cpg1.3.0
  array('Method for resizing images','thumb_method',2), //cpg1.3.0
  array('Path to ImageMagick \'convert\' utility (example /usr/bin/X11/)', 'impath', 0), //cpg1.3.0
  //array('Allowed image types (only valid for ImageMagick)', 'allowed_img_types',0), //cpg1.3.0
  array('Command line options for ImageMagick', 'im_options', 0), //cpg1.3.0
  array('Read EXIF data in JPEG files', 'read_exif_data', 1), //cpg1.3.0
  array('Read IPTC data in JPEG files', 'read_iptc_data', 1), //cpg1.3.0
  array('The album directory <a href="#notice1" class="clickable_option">*</a>', 'fullpath', 0), //cpg1.3.0
  array('The directory for user files <a href="#notice1" class="clickable_option">*</a>', 'userpics', 0), //cpg1.3.0
  array('The prefix for intermediate pictures <a href="#notice1" class="clickable_option">*</a>', 'normal_pfx', 0), //cpg1.3.0
  array('The prefix for thumbnails <a href="#notice1" class="clickable_option">*</a>', 'thumb_pfx', 0), //cpg1.3.0
  array('Default mode for directories', 'default_dir_mode', 0), //cpg1.3.0
  array('Default mode for files', 'default_file_mode', 0), //cpg1.3.0

  'User settings',
  array('Allow new user registrations', 'allow_user_registration', 1),
  array('User registration requires email verification', 'reg_requires_valid_email', 1),
  array('Notify admin of user registration by email', 'reg_notify_admin_email', 1), //cpg1.3.0
  array('Allow two users to have the same email address', 'allow_duplicate_emails_addr', 1),
  array('Users can have private albums (Note: if you switch from \'yes\' to \'no\' any current private albums will become public)', 'allow_private_albums', 1), //cpg1.3.0
  array('Notify admin of user upload awaiting approval', 'upl_notify_admin_email', 1), //cpg1.3.0
  array('Allow logged in users to view memberlist', 'allow_memberlist', 1), //cpg1.3.0

  'Custom fields for image description (leave blank if unused)',
  array('Field 1 name', 'user_field1_name', 0),
  array('Field 2 name', 'user_field2_name', 0),
  array('Field 3 name', 'user_field3_name', 0),
  array('Field 4 name', 'user_field4_name', 0),

  'Cookies settings',
  array('Name of the cookie used by the script (when using bbs integration, make sure it differs from the bbs\'s cookie name)', 'cookie_name', 0),
  array('Path of the cookie used by the script', 'cookie_path', 0),

  'Miscellaneous settings',
  array('Enable debug mode', 'debug_mode', 9), //cpg1.3.0
  array('Display notices in debug mode', 'debug_notice', 1), //cpg1.3.0

  '<br /><div align="left"><a name="notice1"></a>(*) This settings mustn\'t be changed if you already have files in your database.<br />
  <a name="notice2"></a>(**) When changing this setting, only the files that are added from that point on are affected, so it is advisable that this setting must not be changed if there are already files in the gallery. You can, however, apply the changes to the existing files with the &quot;<a href="util.php">admin tools</a> (resize pictures)&quot; utility from the admin menu.</div><br />', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File db_ecard.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('DB_ECARD_PHP')) $lang_db_ecard_php = array(
  'title' => '�� ecards', //cpg1.3.0
  'ecard_sender' => '�����', //cpg1.3.0
  'ecard_recipient' => '����Ѻ', //cpg1.3.0
  'ecard_date' => '�ѹ���', //cpg1.3.0
  'ecard_display' => '�ʴ� ecard', //cpg1.3.0
  'ecard_name' => '����', //cpg1.3.0
  'ecard_email' => 'Email', //cpg1.3.0
  'ecard_ip' => 'IP #', //cpg1.3.0
  'ecard_ascending' => '������ҡ', //cpg1.3.0
  'ecard_descending' => '�ҡ仹���', //cpg1.3.0
  'ecard_sorted' => '���§', //cpg1.3.0
  'ecard_by_date' => 'by date', //cpg1.3.0
  'ecard_by_sender_name' => '�¼���� ����', //cpg1.3.0
  'ecard_by_sender_email' => '�¼���� ������', //cpg1.3.0
  'ecard_by_sender_ip' => '�¼���� IP address', //cpg1.3.0
  'ecard_by_recipient_name' => '�¼���Ѻ����', //cpg1.3.0
  'ecard_by_recipient_email' => '�¼���Ѻ ������', //cpg1.3.0
  'ecard_number' => '�ʴ��ä���촷�� %s �֧ %s �ҡ %s', //cpg1.3.0
  'ecard_goto_page' => '价��˹��', //cpg1.3.0
  'ecard_records_per_page' => '�ä���촵��˹��', //cpg1.3.0
  'check_all' => '���͡������', //cpg1.3.0
  'uncheck_all' => '������͡', //cpg1.3.0
  'ecards_delete_selected' => 'ź ecards ������͡', //cpg1.3.0
  'ecards_delete_confirm' => '�س��㨷���ź? ���͡����示�͡��!', //cpg1.3.0
  'ecards_delete_sure' => '�ѹ���', //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
  'empty_name_or_com' => '�س��ͧ����������Ф������',
  'com_added' => '������繤س�١�ѹ�֡����',
  'alb_need_title' => '�س��è�͸Ժ�¤��йӢͧ��ź��� !',
  'no_udp_needed' => '�����繵�ͧ�Ѿവ',
  'alb_updated' => '��ź����Ѿവ����',
  'unknown_album' => '�������ź������س���͡ ���ͤس������Է��������������ź������',
  'no_pic_uploaded' => '������Ҿ�����Ѿ��Ŵ !<br /><br />�ҡ�س�����͡�Ҿ�����Ѿ��Ŵ �ô��Ǩ�ͺ����Ѿ��Ŵ�ҡ���������...', //cpg1.3.0
  'err_mkdir' => '�������ö���ҧ ��ä����� %s !',
  'dest_dir_ro' => '��ä����� %s �������ö��¹����ʤ�Ի���� !',
  'err_move' => '�������ö���� %s � %s !',
  'err_fsize_too_large' => '��Ҵ�Ҿ�ͧ�س�˭��Թ� (��Ҵ�٧�ش���͹حҵ��� %s x %s) !', //cpg1.3.0
  'err_imgsize_too_large' => '��Ҵ�Ҿ�ͧ�س�˭��Թ� (��Ҵ�٧�ش���͹حҵ��� %s KB) !',
  'err_invalid_img' => '�Ҿ���س�Ѿ��Ŵ������ҾẺ���͹حҵ !',
  'allowed_img_types' => '�س�ѧ�Ѿ��Ŵ�� %s �Ҿ.',
  'err_insert_pic' => '�Ҿ�ͧ�س \'%s\' �������ö�������ź����� ', //cpg1.3.0
  'upload_success' => '�Ѿ��Ŵ�Ҿ����<br /><br />�Ҿ���ʴ���ѧ�ҡ��Ǩ�ͺ�¼������к�', //cpg1.3.0
  'notify_admin_email_subject' => '%s - �Ҿ�������', //cpg1.3.0
  'notify_admin_email_body' => '�ٻ����Ѿ��Ŵ����� %s ����͡�õ�Ǩ�ͺ. �ռ����Ҫ� %s', //cpg1.3.0
  'info' => '��������´',
  'com_added' => '������繶١�ѹ�֡',
  'alb_updated' => '��ź����١��Ѻ��ا',
  'err_comment_empty' => '�س��������������� !',
  'err_invalid_fext' => '�ҾẺ�����ҹ�鹷��͹حҵ : <br /><br />%s.',
  'no_flood' => '�س���ʴ������������ش�����<br /><br />�س��䢤�����繢ͧ�س���ҵ�ͧ���', //cpg1.3.0
  'redirect_msg' => '��ҡ��ѧ�Ҥس价��<br /><br /><br />���� \'CONTINUE\' �ҡ�к����������ѵ��ѵ�',
  'upl_success' => '�����Ҿ�����', //cpg1.3.0
  'email_comment_subject' => '������繷���ʵ�� Coppermine Photo Gallery', //cpg1.3.0
  'email_comment_body' => '�ռ���ʴ�����������������ͧ�س ��������', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
  'caption' => '��͸Ժ��',
  'fs_pic' => '�Ҿ����',
  'del_success' => 'ź����',
  'ns_pic' => '�Ҿ��Ҵ����',
  'err_del' => '�������öź��',
  'thumb_pic' => '�Ҿ���',
  'comment' => '�������',
  'im_in_alb' => '�Ҿ���ź���',
  'alb_del_success' => '��ź��� \'%s\' ź',
  'alb_mgr' => '�Ѵ�����ź���',
  'err_invalid_data' => '�������ö�Ѻ�����Ũҡ \'%s\'',
  'create_alb' => '���ҧ��ź��� \'%s\'',
  'update_alb' => '��Ѻ��ا��ź��� \'%s\' ��Ф�͸Ժ�� \'%s\' ��ШѴ���§ \'%s\'',
  'del_pic' => 'ź�Ҿ', //cpg1.3.0
  'del_alb' => 'ź��ź���',
  'del_user' => 'ź�����',
  'err_unknown_user' => '����ժ��ͼ������س���͡',
  'comment_deleted' => 'ź�����������',
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
  'confirm_del' => '�س��㨷���ź�Ҿ��� ? \\n ������繨ж�١ź仴���', //js-alert //cpg1.3.0
  'del_pic' => 'ź�Ҿ���', //cpg1.3.0
  'size' => '%s x %s pixels',
  'views' => '%s ����',
  'slideshow' => '��Ŵ�',
  'stop_slideshow' => '��ش�ʴ���Ŵ�',
  'view_fs' => '���Ҿ����',
  'edit_pic' => '�����������´', //cpg1.3.0
  'crop_pic' => 'Crop and Rotate', //cpg1.3.0
);

$lang_picinfo = array(
  'title' =>'��������´�ͧ�Ҿ', //cpg1.3.0
  'Filename' => '�����Ҿ',
  'Album name' => '������ź���',
  'Rating' => '��ṹ (%s ��ǵ)',
  'Keywords' => '�Ӥ�',
  'File Size' => '��Ҵ�Ҿ',
  'Dimensions' => '��Ҵ�Ҿ',
  'Displayed' => '�ʴ�',
  'Camera' => '���ͧ',
  'Date taken' => '�ѹ�������Ҿ',
  'ISO'=>'ISO',
  'Aperture' => 'Aperture',
  'Exposure time' => 'Exposure time',
  'Focal length' => 'Focal length',
  'Comment' => '�������',
  'addFav'=>'�������ǹ���ͺ', //cpg1.3.0
  'addFavPhrase'=>'��ǹ���ͺ', //cpg1.3.0
  'remFav'=>'ź�ҡ��ǹ���ͺ', //cpg1.3.0
  'iptcTitle'=>'IPTC Title', //cpg1.3.0
  'iptcCopyright'=>'IPTC Copyright', //cpg1.3.0
  'iptcKeywords'=>'IPTC Keywords', //cpg1.3.0
  'iptcCategory'=>'IPTC Category', //cpg1.3.0
  'iptcSubCategories'=>'IPTC Sub Categories', //cpg1.3.0
);

$lang_display_comments = array(
  'OK' => 'OK',
  'edit_title' => '�������繹��',
  'confirm_delete' => '�س��㨷���ź������繹�� ?', //js-alert
  'add_your_comment' => '�����������',
  'name'=>'����',
  'comment'=>'�������',
  'your_name' => 'someone',
);

$lang_fullsize_popup = array(
  'click_to_close' => '���꡷���Ҿ�����͡',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
  'title' => '��-card',
  'invalid_email' => '<b>����͹</b> : �ٻẺ�ͧ���������١��ͧ !',
  'ecard_title' => 'e-card �ҡ %s �֧�س',
  'error_not_image' => '�Ҿ��ҹ�鹷������� e-card ��', //cpg1.3.0
  'view_ecard' => '�ҡ e-card ����ʴ�, ��سҤ��꡷����',
  'view_more_pics' => '����꡷�������ʹ��Ҿ������� !',
  'send_success' => 'ecard �١������',
  'send_failed' => '����������������ö�� e-card...',
  'from' => '�ҡ',
  'your_name' => '���ͤس',
  'your_email' => '������ͧ�س',
  'to' => 'To',
  'rcpt_name' => '���ͼ���Ѻ',
  'rcpt_email' => '���������Ѻ',
  'greetings' => '����¾�',
  'message' => '��ͤ���',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
  'pic_info' => '��������´�Ҿ', //cpg1.3.0
  'album' => '��ź���',
  'title' => '��͸Ժ��',
  'desc' => '��������´',
  'keywords' => '�Ӥ�',
  'pic_info_str' => '%s &times; %s - %s KB - %s ���� - %s ��ǵ',
  'approve' => '��Ǩ�ͺ�Ҿ', //cpg1.3.0
  'postpone_app' => '���������ҧ��Ǩ�ͺ',
  'del_pic' => 'ź�Ҿ', //cpg1.3.0
  'read_exif' => '��ҹ��� EXIF �ա����', //cpg1.3.0
  'reset_view_count' => '��駤�ҵ�ǹѺ����',
  'reset_votes' => '��駤����ǵ����',
  'del_comm' => 'ź�������',
  'upl_approval' => '�͡�õ�Ǩ�ͺ',
  'edit_pics' => '����Ҿ', //cpg1.3.0
  'see_next' => '�ʴ��Ҿ����', //cpg1.3.0
  'see_prev' => '�ʴ��Ҿ��͹˹��', //cpg1.3.0
  'n_pic' => '%s �Ҿ', //cpg1.3.0
  'n_of_pic_to_disp' => '�ӹǹ����ʴ�', //cpg1.3.0
  'apply' => '�ѹ�֡���', //cpg1.3.0
  'crop_title' => 'Coppermine Picture Editor', //cpg1.3.0
  'preview' => '�ʴ�������ҧ', //cpg1.3.0
  'save' => '�ѹ�֡', //cpg1.3.0
  'save_thumb' =>'�ѹ�֡���Ҿ���', //cpg1.3.0
  'sel_on_img' =>'����ö���͡��੾�к��Ҿ��ҹ��!', //js-alert //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File faq.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FAQ_PHP')) $lang_faq_php = array(
  'faq' => '�Ӷ�����������', //cpg1.3.0
  'toc' => '������', //cpg1.3.0
  'question' => '�Ӷ��: ', //cpg1.3.0
  'answer' => '�ӵͺ: ', //cpg1.3.0
);

if (defined('FAQ_PHP')) $lang_faq_data = array(
  'General FAQ', //cpg1.3.0
  array('������ͧ��Ѥ���Ҫԡ?', 'Registration may or may not be required by the administrator. Registration gives a member additional features such as uploading, having a favorite list, rating pictures and posting comments etc.', 'allow_user_registration', '1'), //cpg1.3.0
  array('��Ѥ���Ҫԡ���ҧ��?', 'Go to &quot;Register&quot; and fill out the required fields (and the optional ones if you want to).<br />If the Administrator has Email Activation enabled ,then after submitting your information you should recieve an email message at the address that you have submitted while registering, giving you instructions on how to activate your membership. Your membership must be activated in order for you to login.', 'allow_user_registration', '1'), //cpg1.3.0
  array('����к����ҧ��?', 'Go to &quot;Login&quot;, submit your username and password and check &quot;Remember Me&quot; so you will be logged in on the site if you should leave it.<br /><b>IMPORTANT:Cookies must be enabled and the cookie from this site must not be deleted in order to use &quot;Remember Me&quot;.</b>', 'offline', 0), //cpg1.3.0
  array('�����ѹ����к������?', 'Did you register and click the link that was sent to you via email?. The link will activate your account. For other login problems contact the site administrator.', 'offline', 0), //cpg1.3.0
  array('�ѹ��� password?', 'If this site has a &quot;Forgot password&quot; link then use it. Other than that contact the site administrator for a new password.', 'offline', 0), //cpg1.3.0
  //array('What if I changed my email address?', 'Just simply login and change your email address through &quot;Profile&quot;', 'offline', 0), //cpg1.3.0
  array('�ѹ�����Ҿ�����ǹ &quot;�Ҿ���ѹ�ͺ&quot; �����ҧ��?', 'Click on a picture and click on the &quot;picture info&quot; link (<img src="images/info.gif" width="16" height="16" border="0" alt="Picture information" />); scroll down to the picture information set and click &quot;Add to fav&quot;.<br />The administrator may have the &quot;picture information&quot; on by default.<br />IMPORTANT:Cookies must be enabled and the cookie from this site must not be deleted.', 'offline', 0), //cpg1.3.0
  array('�ѹ������ṹ���ҧ��?', 'Click on a thumbnail and go to the bottom and choose a rating.', 'offline', 0), //cpg1.3.0
  array('�ѹ���ʴ�����������ҧ��?', 'Click on a thumbnail and go to the bottom and post a comment.', 'offline', 0), //cpg1.3.0
array('�ѹ�����Ҿ�����ź������ҧ��?', 'Go to &quot;Upload&quot;and select the album that you want to upload to, click &quot;Browse&quot; and find the file to upload and click &quot;open&quot; (add a title and description if you want to) and click &quot;Submit&quot;', 'allow_private_albums', 0), //cpg1.3.0
  array('�Ҿ�ͧ�ѹ���Ѿ��Ŵ价���˹?', 'You will be able to upload a file to one of your albums in &quot;My Gallery&quot;. The Administrator may also allow you to upload a file to one or more of the albums in the Main Gallery.', 'allow_private_albums', 0), //cpg1.3.0
  array('��Ҵ�Ҿ���ѹ���Ѻ͹حҵ����Ѿ��Ŵ?', 'The size and type (jpg, png, etc.) is up to the administrator.', 'offline', 0), //cpg1.3.0
  array('���ä�� &quot;��������ͧ�ѹ&quot;?', '&quot;My Gallery&quot; is a personal gallery that the user can upload to and manage.', 'allow_private_albums', 0), //cpg1.3.0
  array('��䧩ѹ�����ҧ, ����¹���� ����ź ��ź����ҡ &quot;My Gallery&quot;?', 'You should already be in &quot;Admin-Mode&quot;<br />Go to &quot;Create/Order My Albums&quot;and click &quot;New&quot;. Change &quot;New Album&quot; to your desired name.<br />You can also rename any of the albums in your gallery.<br />Click &quot;Apply Modifications&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('��䧩ѹ�֧������¹��Ҽ����Ҫ���ź����ͧ�ѹ?', 'You should already be in &quot;Admin Mode&quot;<br />Go to &quot;Modify My Albums. On the &quot;Update Album&quot; bar, select the album that you want to modify.<br />Here, you can change the name, description, thumbnail picture, restrict viewing and comment/rating permissions.<br />Click &quot;Update Album&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('��䧶֧�д� ��������ͧ����餹�����?', 'Go to &quot;Album List&quot; and select &quot;User Galleries&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('���ä�ͤ�ꡡ�� �������?', 'Cookies are a plain text piece of data that is sent from a website and is put on to your computer.<br />Cookies usually allow a user to leave and return to the site without having to login again and other various chores.', 'offline', 0), //cpg1.3.0
  array('�ѹ��ҡ��������������Ѻ৻�ͧ�ѹ��ҧ?', 'Coppermine is a free Multimedia Gallery, released under GNU GPL. It is full of features and has been ported to various platforms. Visit the <a href="http://coppermine.sf.net/">Coppermine Home Page</a> to find out more or download it.', 'offline', 0), //cpg1.3.0

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
  'forgot_passwd' => '�к���͹���������ʼ�ҹ', //cpg1.3.0
  'err_already_logged_in' => '�س����к����� !', //cpg1.3.0
  'enter_username_email' => '��س������ͼ�������������ͧ�س', //cpg1.3.0
  'submit' => 'go', //cpg1.3.0
  'failed_sending_email' => '��������͹���������ʼ�ҹ �������ö���� !', //cpg1.3.0
  'email_sent' => '�к����������� username ��� password ��ѧ %s', //cpg1.3.0
  'err_unk_user' => '����ժ��ͼ������!', //cpg1.3.0
  'passwd_reminder_subject' => '%s - �к���͹���������ʼ�ҹ', //cpg1.3.0
  'passwd_reminder_body' => '�س�������к���͹���������ʼ�ҹ����Ѻ���ͼ����:
Username: %s
Password: %s
Click %s to log in.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
  'group_name' => '���͡����',
  'disk_quota' => '��Ҵ��ʤ���͹حҵ',
  'can_rate' => '����ö����ṹ�Ҿ', //cpg1.3.0
  'can_send_ecards' => '����ö�� ecards',
  'can_post_com' => '����ö�ʴ��������',
  'can_upload' => '����ö�Ѿ��Ŵ�Ҿ', //cpg1.3.0
  'can_have_gallery' => '����ö�������������ǹ���',
  'apply' => '�ѹ�֡���',
  'create_new_group' => '���ҧ���������',
  'del_groups' => 'ź�����������͡',
  'confirm_del' => '����͹ .. ����ͤسź����� �����㹡������鹨�����¹���� \'Registered\' group !\n\n ���Թ��õ��������� ?', //js-alert //cpg1.3.0
  'title' => '�Ѵ��á���������',
  'approval_1' => '����ö�Ѿ��Ŵ�¼�������� (1)',
  'approval_2' => '����ö�Ѿ��Ŵ������ǹ��� (2)',
  'upload_form_config' => '�Ѿ��ŵ�ҡ��ҡ�˹�', //cpg1.3.0
  'upload_form_config_values' => array( '�Ѿ��ŵ�����Ҿ', '�Ѿ��ŵ����������Ҿ', 'URI ��ҹ��', 'ZIP ��ҹ��', 'File-URI', 'File-ZIP', 'URI-ZIP', 'File-URI-ZIP'), //cpg1.3.0
  'custom_user_upload'=>'���������ö��˹��ӹǹ����Ѿ��Ŵ?', //cpg1.3.0
  'num_file_upload'=>'�ӹǹ�ҡ�ش�ͧ�Ҿ����Ѿ��Ŵ', //cpg1.3.0
  'num_URI_upload'=>'�ӹǹ�ҡ�ش�ͧ URI upload boxes', //cpg1.3.0
  'note1' => '<b>(1)</b> �Ѿ��Ŵ�����ź����Ҹ�óе�ͧ�͡�õ�Ǩ�ͺ',
  'note2' => '<b>(2)</b> �Ѿ��Ŵ�����ź���������ͧ�͡�õ�Ǩ�ͺ',
  'notes' => '�����˵�',
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
  'welcome' => '�Թ�յ�͹�Ѻ !',
);

$lang_album_admin_menu = array(
  'confirm_delete' => '�س��㨷���ź��ź������ ? \\n �Ҿ��Ф�����繨ж١ź仴���', //js-alert //cpg1.3.0
  'delete' => 'ź',
  'modify' => '��˹����',
  'edit_pics' => '���', //cpg1.3.0
);

$lang_list_categories = array(
  'home' => '˹����ѡ',
  'stat1' => '<b>[pictures]</b> �Ҿ� <b>[albums]</b> ��ź��� ��� <b>[cat]</b> ��Ǵ���� �Ѻ <b>[comments]</b> ������� �ռ����Ҫ� <b>[views]</b> ����', //cpg1.3.0
  'stat2' => '<b>[pictures]</b> �Ҿ� <b>[albums]</b> ��ź�������ʴ� <b>[views]</b> ����', //cpg1.3.0
  'xx_s_gallery' => '%s\'s ��������',
  'stat3' => '<b>[pictures]</b> �Ҿ� <b>[albums]</b> ��ź��� ��� <b>[comments]</b> ������� <b>[views]</b> ����', //cpg1.3.0
);

$lang_list_users = array(
  'user_list' => '��ª��ͼ����',
  'no_user_gal' => '�����������������',
  'n_albums' => '%s ��ź���',
  'n_pics' => '%s �Ҿ', //cpg1.3.0
);

$lang_list_albums = array(
  'n_pictures' => '%s �Ҿ', //cpg1.3.0
  'last_added' => ', �ش������������� %s',
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
  'login' => '����к�',
  'enter_login_pswd' => '��͡���ͼ����������ʼ�ҹ',
  'username' => '���ͼ����',
  'password' => '���ʼ�ҹ',
  'remember_me' => '�Ӥ�ҹ�����',
  'welcome' => '�Թ�յ�͹�Ѻ %s ...',
  'err_login' => '*** �������ö���س����к��� - �ͧ�����ա���� ***',
  'err_already_logged_in' => '�س����к����� !',
  'forgot_password_link' => '�ѹ������ʼ�ҹ', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
  'logout' => '�͡�ҡ�к�',
  'bye' => '���º��  �������ա�� %s ...',
  'err_not_loged_in' => '�س���������к� !',
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
  'upd_alb_n' => '��Ѻ��ا��ź��� %s',
  'general_settings' => '��ҷ����',
  'alb_title' => '��͸Ժ��',
  'alb_cat' => '��Ǵ����',
  'alb_desc' => '��������´',
  'alb_thumb' => '�Ҿ���',
  'alb_perm' => 'Permissions ����Ѻ��ź���',
  'can_view' => '��ź�������ö�ʴ���',
  'can_upload' => '��������͹����ö���Ҿ',
  'can_post_comments' => '��������͹����ö�ʴ��������',
  'can_rate' => '��������͹����ö����ṹ',
  'user_gal' => '��ź�����ǹ���',
  'no_cat' => '* �������Ǵ���� *',
  'alb_empty' => '�������ź���',
  'last_uploaded' => '�Ѿ��Ŵ����ش',
  'public_alb' => '�ء�� (��ź����Ҹ�ó�)',
  'me_only' => '੾�Щѹ��ҹ��',
  'owner_only' => '��Ңͧ��ź��� (%s) ��ҹ��',
  'groupp_only' => '��Ҫԡ�ͧ \'%s\' ',
  'err_no_alb_to_modify' => '�������ź����١��Ѻ��ا㹰ҹ������',
  'update' => '��Ѻ��ا��ź���', //cpg1.3.0
  'notice1' => '(*) �������Ѻ %sgroups%s settings', //cpg1.3.0 (do not translate %s!)
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
  'already_rated' => '�س����ṹ�Ҿ�������', //cpg1.3.0
  'rate_ok' => '��ṹ�ѹ�֡����',
  'forbidden' => '�س�������ö����ṹ�Ҿ�ͧ����ͧ', //cpg1.3.0
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
  'page_title' => 'ŧ����¹�����',
  'term_cond' => '��͵�ŧ',
  'i_agree' => '�ѹ����',
  'submit' => '��ŧ',
  'err_user_exists' => '�դ��� username �������, �س��ͧ��������',
  'err_password_mismatch' => '���ʼ�ҹ��� 2 �������ç�ѹ, ��سҡ�͡����',
  'err_uname_short' => '���ͼ�����ͧ�����ҧ���� 2 ����ѡ��',
  'err_password_short' => '���ʼ�ҹ��ͧ�����ҧ���� 2 ����ѡ��',
  'err_uname_pass_diff' => '���ͼ����������ʼ�ҹ���������͹�ѹ���ͤ�����ʹ���',
  'err_invalid_email' => '�ٻẺ�ͧ���������١��ͧ',
  'err_duplicate_email' => '�ռ�����ҹ���ŧ����¹����������������',
  'enter_info' => '��͡��������´���ŧ����¹',
  'required_info' => '��ͧ��͡���',
  'optional_info' => '��������´�������',
  'username' => '���ͼ����',
  'password' => '���ʼ�ҹ',
  'password_again' => '��سҡ�͡���ʼ�ҹ�ա����',
  'email' => '������',
  'location' => '��ѡ����',
  'interests' => '��觷��ͺ',
  'website' => '�ǻ䫵�',
  'occupation' => '�Ҫվ',
  'error' => '�Դ�����Դ��Ҵ',
  'confirm_email_subject' => '%s - �׹�ѹ���ŧ����¹',
  'information' => '��������´',
  'failed_sending_email' => '�������׹�ѹ���ŧ����¹�������ö���� !',
  'thank_you' => '�ͺ�س���ŧ����¹<br /><br />�к���������������Ѻ����������ҹ��ѧ��������س��ŧ����¹�������...',
  'acct_created' => '�к��ѹ�֡�����Ţͧ�س���º�������� �س����ö����к����� ��͡�Թ ���� ���ͼ���� ��� ���ʼ�ҹ�ͧ�س',
  'acct_active' => '�ѭ�ռ����ͧ�س�ӧҹ���� �س����ö����к����� ��͡�Թ ���� ���ͼ���� ��� ���ʼ�ҹ�ͧ�س',
  'acct_already_act' => '�ѭ�ռ����ͧ�س�ӧҹ !',
  'acct_act_failed' => '���ͼ�������������ö��ҹ�� !',
  'err_unk_user' => '����ժ��ͼ������ !',
  'x_s_profile' => '%s\'s ��������ǹ���',
  'group' => '�����',
  'reg_date' => '�������',
  'disk_usage' => '���鹷��',
  'change_pass' => '����¹���ʼ�ҹ',
  'current_pass' => '���ʼ�ҹ�Ѩ�غѹ',
  'new_pass' => '���ʼ�ҹ����',
  'new_pass_again' => '���ʼ�ҹ�����ա����',
  'err_curr_pass' => '��˼�ҹ�Ѩ�غѹ���١��ͧ',
  'apply_modif' => '����Ѻ��ҷ������¹�ŧ',
  'change_pass' => '����¹���ʼ�ҹ�ͧ�ѹ',
  'update_success' => '��������ǹ��Ǣͧ�س�١����¹�ŧ����',
  'pass_chg_success' => '���ʼ�ҹ�ͧ�س�١����¹�ŧ����',
  'pass_chg_error' => '���ʼ�ҹ�ͧ�س�������¹�ŧ',
  'notify_admin_email_subject' => '%s - �駼������к�', //cpg1.3.0
  'notify_admin_email_body' => '��������� ���� "%s" ŧ����¹�������������ͧ�س', //cpg1.3.0
);

$lang_register_confirm_email = <<<EOT
Thank you for registering at {SITE_NAME}

Your username is : "{USER_NAME}"
Your password is : "{PASSWORD}"

In order to activate your account, you need to click on the link below
or copy and paste it in your web browser.

{ACT_LINK}

Regards,

The management of {SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
  'title' => '�ʴ��������',
  'no_comment' => '����դ�����繷����ʴ�',
  'n_comm_del' => '%s ������繶١ź',
  'n_comm_disp' => '�ӹǹ������繷���ʴ�',
  'see_prev' => '��͹˹��',
  'see_next' => '�Ѵ�',
  'del_comm' => 'ź������繹��',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
  0 => '����',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
  'page_title' => '�����Ҿ����', //cpg1.3.0
  'select_dir' => '���͡���',
  'select_dir_msg' => '����觹��������س�������ӹǹ�ҡ� �������������ҹ FTP.<br /><br />���͡��ä���������Ѿ��Ŵ���', //cpg1.3.0
  'no_pic_to_add' => '������Ҿ�١����', //cpg1.3.0
  'need_one_album' => '�س��ͧ����ź�����͹�������觹��',
  'warning' => '����͹',
  'change_perm' => 'ʤ�Ի�� �������ö��Ѻ ��ä������� �س��ͧ����¹������  755 ���� 777 ��͹ !', //cpg1.3.0
  'target_album' => '<b>�������ҡ &quot;</b>%s<b>&quot; ���� </b>%s', //cpg1.3.0
  'folder' => '���',
  'image' => '�Ҿ',
  'album' => '��ź���',
  'result' => '���Ѿ��',
  'dir_ro' => '�������ö�ѹ�֡�� ',
  'dir_cant_read' => '�������ö��ҹ��. ',
  'insert' => '�����Ҿ�����ź���', //cpg1.3.0
  'list_new_pic' => '��ª����Ҿ������', //cpg1.3.0
  'insert_selected' => '�����Ҿ������͡', //cpg1.3.0
  'no_pic_found' => '������Ҿ������', //cpg1.3.0
  'be_patient' => '�ô���ѡ����, ���ѧ�ӧҹ....', //cpg1.3.0
  'no_album' => '�������ź����١���͡',  //cpg1.3.0
  'notes' =>  '<ul>'.
                          '<li><b>OK</b> : ���������'.
                          '<li><b>DP</b> : �����ū��'.
                          '<li><b>PB</b> : �������ö������, �ô��Ǩ�ͺ��Ңͧ�к���С��͹حҵ�ͧ���������'.
                          '<li><b>NA</b> : �س��������͡��ź����������Ҿ�, ���͡ \'<a href="javascript:history.back(1)">��͹��Ѻ</a>\' ������͡��ź��� �ҡ���ѧ�������ź��� <a href="albmgr.php">������ҧ��͹</a></li>'.
                          '<li>�ҡ OK, DP, PB \'signs\' ����ʴ� ������ �Ҿ���Դ��Ҵ ���ʹ٢�ͤ����ҡ���������'.
                          '<li>�����Թ����˹�, ���꡷�� reload'.
                          '</ul>', //cpg1.3.0
  'select_album' => '���͡��ź���', //cpg1.3.0
  'check_all' => '���͡������', //cpg1.3.0
  'uncheck_all' => '¡��ԡ������͡', //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //

// Void

// ------------------------------------------------------------------------- //
// File banning.php
// ------------------------------------------------------------------------- //

if (defined('BANNING_PHP')) $lang_banning_php = array(
  'title' => '���������',
  'user_name' => '����',
  'ip_address' => 'IP Address',
  'expiry' => '������� (�����ҧ�������ա�˹�)',
  'edit_ban' => '�ѹ�֡���',
  'delete_ban' => 'ź',
  'add_new' => '��������������',
  'add_ban' => '����',
  'error_user' => '��辺�������', //cpg1.3.0
  'error_specify' => '�س��ͧ��˹���駪������ IP address', //cpg1.3.0
  'error_ban_id' => '����� ban ID!', //cpg1.3.0
  'error_admin_ban' => '�س����������ͧ�����??', //cpg1.3.0
  'error_server_ban' => '�س���������������ͧ�س ...�ԡ�ԡ..��ҧ���������...', //cpg1.3.0
  'error_ip_forbidden' => '�س�������ö���� IP - �����ѹ�����!', //cpg1.3.0
  'lookup_ip' => '��Ǩ�ͺ IP address', //cpg1.3.0
  'submit' => '�!', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
  'title' => '�Ѿ��Ŵ', //cpg1.3.0
  'custom_title' => '����¹��ҡ�˹�', //cpg1.3.0
  'cust_instr_1' => '�س��ͧ���͡�����Ţ�ͧ���ͧ�Ѿ��Ŵ ��е�ͧ������͡�ҡ���Ҩӹǹ����˹����.', //cpg1.3.0
  'cust_instr_2' => '���ͧ�Ѿ��Ŵ���١���͡', //cpg1.3.0
  'cust_instr_3' => '����Ѿ��Ŵ: %s', //cpg1.3.0
  'cust_instr_4' => 'URI/URL upload boxes: %s', //cpg1.3.0
  'cust_instr_5' => 'URI/URL upload boxes:', //cpg1.3.0
  'cust_instr_6' => '����Ѿ��Ŵ:', //cpg1.3.0
  'cust_instr_7' => '��͡�ӹǹ �����Ẻ�ͧ���ͧ�Ѿ��Ŵ �ҡ��鹤��ա ���� ', //cpg1.3.0
  'reg_instr_1' => '����ա�á�з����Դ���.', //cpg1.3.0
  'reg_instr_2' => '�س���ö�Ѿ��Ŵ��� ���¡��ͧ�Ѿ��Ŵ��ҧ��ҧ���. ��Ҵ�ͧ������� ��ͧ����Թ %s KB  ��� ZIP ��ͧ�Ѿ��Ŵ�  \'File Upload\' ���� \'URI/URL Upload\' .', //cpg1.3.0
  'reg_instr_3' =>  '��ҵ�ͧ���ºպ������ͤ����͡, �س��ͧ����ͧ�Ѿ��Ŵ \'Decompressive ZIP Upload\' ', //cpg1.3.0
  'reg_instr_4' => '���������ǹ�Ѿ��Ŵ URI/URL , ��ͧ���͡ �ҷ �ͧ������ (�������ҧ) http://www.mysite.com/images/example.jpg', //cpg1.3.0
  'reg_instr_5' => '����͡�͡���� ���꡷�� ���� ', //cpg1.3.0
  'reg_instr_6' => 'Decompressive ZIP Uploads:', //cpg1.3.0
  'reg_instr_7' => 'File Uploads:', //cpg1.3.0
  'reg_instr_8' => 'URI/URL Uploads:', //cpg1.3.0
  'error_report' => '��§ҹ�����Դ��Ҵ', //cpg1.3.0
  'error_instr' => '�Դ�����Դ��Ҵ��鹴ѧ���仹��:', //cpg1.3.0
  'file_name_url' => 'File Name/URL', //cpg1.3.0
  'error_message' => '��ͤ���', //cpg1.3.0
  'no_post' => 'File not uploaded by POST.', //cpg1.3.0
  'forb_ext' => '����չ��ʡ�Ź��.', //cpg1.3.0
  'exc_php_ini' => '�Թ��Ҵ���͹حҵ� php.ini.', //cpg1.3.0
  'exc_file_size' => '�Թ��Ҵ���͹حҵ� CPG.', //cpg1.3.0
  'partial_upload' => '����Ѻ����Ѿ��Ŵ����������ó�.', //cpg1.3.0
  'no_upload' => '����ա���Ѿ��Ŵ.', //cpg1.3.0
  'unknown_code' => 'Unknown PHP �Դ�����Դ��Ҵ����Ѿ��Ŵ.', //cpg1.3.0
  'no_temp_name' => '����ա���Ѿ��Ŵ - ����� temp name.', //cpg1.3.0
  'no_file_size' => '����բ�����', //cpg1.3.0
  'impossible' => '�������ö������.', //cpg1.3.0
  'not_image' => '������ٻ�Ҿ', //cpg1.3.0
  'not_GD' => 'Not a GD extension.', //cpg1.3.0
  'pixel_allowance' => '�Ҿ�˭��Թ�.', //cpg1.3.0
  'incorrect_prefix' => 'Incorrect URI/URL prefix', //cpg1.3.0
  'could_not_open_URI' => 'Could not open URI.', //cpg1.3.0
  'unsafe_URI' => '����ҹ��õ�Ǩ�ͺ������ʹ���.', //cpg1.3.0
  'meta_data_failure' => 'Meta data failure', //cpg1.3.0
  'http_401' => '401 ������Ѻ͹حҵ', //cpg1.3.0
  'http_402' => '402 ��ͧ�����Թ', //cpg1.3.0
  'http_403' => '403 ��辺', //cpg1.3.0
  'http_404' => '404 �����', //cpg1.3.0
  'http_500' => '500 ���������Դ��Ҵ', //cpg1.3.0
  'http_503' => '503 ����պ�ԡ�ù��', //cpg1.3.0
  'MIME_extraction_failure' => 'MIME could not be determined.', //cpg1.3.0
  'MIME_type_unknown' => 'Unknown MIME type', //cpg1.3.0
  'cant_create_write' => '���ҧ�����������.', //cpg1.3.0
  'not_writable' => '�ѹ�֡�����������.', //cpg1.3.0
  'cant_read_URI' => '�������ö��ҹ URI/URL', //cpg1.3.0
  'cant_open_write_file' => '�������ö�Դ URI write file.', //cpg1.3.0
  'cant_write_write_file' => '�������ö��¹ URI write file.', //cpg1.3.0
  'cant_unzip' => '�������ö unzip.', //cpg1.3.0
  'unknown' => '�Դ�����Դ��Ҵ', //cpg1.3.0
  'succ' => '�Ѿ��Ŵ�����', //cpg1.3.0
  'success' => '%s ����Ѿ��Ŵ�����.', //cpg1.3.0
  'add' => '���� ���� ���������Ҿ�����ź���', //cpg1.3.0
  'failure' => '�Ѿ��Ŵ�����', //cpg1.3.0
  'f_info' => '��������´', //cpg1.3.0
  'no_place' => '᷹��������.', //cpg1.3.0
  'yes_place' => '᷹��������.', //cpg1.3.0
  'max_fsize' => '��Ҵ�٧�ش���͹حҵ��� %s KB',
  'album' => '��ź���',
  'picture' => '�Ҿ', //cpg1.3.0
  'pic_title' => '�����Ҿ', //cpg1.3.0
  'description' => '��������´', //cpg1.3.0
  'keywords' => '�Ӥ� (�¡���¡�������ä)',
  'err_no_alb_uploadables' => '�������ź������͹حҵ����Ѿ��Ŵ���', //cpg1.3.0
  'place_instr_1' => '�ͧ���͡�Ҿ��������ź���.  ��觤س�������������´��ҧ�.', //cpg1.3.0
  'place_instr_2' => '�ա��������ͧ�ա������¹��ҵ�ҧ� �ô���꡷�� ����', //cpg1.3.0
  'process_complete' => '�س��᷹����ҵ�ҧ����º��������.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
  'title' => '�Ѵ��ü����',
  'name_a' => '���� �ҡ������ҡ',
  'name_d' => '���� �ҡ�ҡ仹���',
  'group_a' => '����� �ҡ������ҡ',
  'group_d' => '����� �ҡ�ҡ仹���',
  'reg_a' => '�ѹŧ����¹ �ҡ������ҡ',
  'reg_d' => '�ѹŧ����¹ �ҡ�ҡ仹���',
  'pic_a' => '�ӹǹ�Ҿ ������ҡ',
  'pic_d' => '�ӹǹ�Ҿ �ҡ仹���',
  'disku_a' => '��Ҵ�Ԥ������ ������ҡ',
  'disku_d' => '��Ҵ�Ԥ������ �ҡ仹���',
  'lv_a' => '�ӹǹ��Ҫ�  ������ҡ', //cpg1.3.0
  'lv_d' => '�ӹǹ��Ҫ�  �ҡ仹��¡', //cpg1.3.0
  'sort_by' => '���§��',
  'err_no_users' => '�����ż������ҧ���� !',
  'err_edit_self' => '�س�������ö��䢢�������ǹ�����, �س��ͧ���͡���꡷�� ��������ǹ��� ',
  'edit' => '���',
  'delete' => 'ź',
  'name' => '���ͼ����',
  'group' => '�����',
  'inactive' => '����������',
  'operations' => '�Ѵ���',
  'pictures' => '�Ҿ', //cpg1.3.0
  'disk_space' => '��Ҵ��鹷���ʤ�',
  'registered_on' => 'ŧ����¹�����',
  'last_visit' => '�����Ҫ�', //cpg1.3.0
  'u_user_on_p_pages' => '%d ����� � %d ˹��',
  'confirm_del' => '�����Ҩ�ź������� ? \\n  �Ҿ�����ź����ж١ź仴���.', //js-alert //cpg1.3.0
  'mail' => '������',
  'err_unknown_user' => '��辺���ͷ�����͡ !',
  'modify_user' => '��䢼����',
  'notes' => '�ѹ�֡��ͤ���',
  'note_list' => '<li>�������ͧ�������¹���ʼ�ҹ �����������ҧ���',
  'password' => '���ʼ�ҹ',
  'user_active' => '�����',
  'user_group' => '�����',
  'user_email' => '����������',
  'user_web_site' => '�ǻ䫵�����',
  'create_new_user' => '���ҧ���������',
  'user_location' => '��ѡ���觼����',
  'user_interests' => '��觷��ͺ�ͧ�����',
  'user_occupation' => '�Ҫվ�ͧ�����',
  'latest_upload' => '�ӹǹ����Ѿ��Ŵ', //cpg1.3.0
  'never' => '�����', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
  'title' => '����ͧ��ͼ������к� (��Ѻ��Ҵ�Ҿ)', //cpg1.3.0  ** This module doesn't work on some server!! Check your php.ini before use.
  'what_it_does' => ',�ѹ������',
  'what_update_titles' => '����¹�����ٻ�ҡ�Ҿ',
  'what_delete_title' => 'ź�����ٻ',
  'what_rebuild' => '���ҧ�Ҿ��������͢�Ҵ�Ҿ',
  'what_delete_originals' => '᷹�Ҿ�����͢�Ҵ����᷹�鹩�Ѻ',
  'file' => '�Ҿ',
  'title_set_to' => '����¹������',
  'submit_form' => '��ŧ',
  'updated_succesfully' => '�Ѿവ����º����',
  'error_create' => '���ҧ�����',
  'continue' => '����ա �',
  'main_success' => '��� %s �١�������鹩�Ѻ', //cpg1.3.0
  'error_rename' => '�������ö����¹���� %s �� %s',
  'error_not_found' => '��辺��� %s ',
  'back' => '��Ѻ����������',
  'thumbs_wait' => '���ѧ�ѹ�֡�������¹�ŧ�Ҿ�������Ŵ��Ҵ�Ҿ...',
  'thumbs_continue_wait' => '���ѧ����¹�ŧ�Ҿ�������Ŵ��Ҵ�Ҿ...',
  'titles_wait' => '���ѧ����¹�����Ҿ...',
  'delete_wait' => '���ѧź�����Ҿ...',
  'replace_wait' => 'ź�Ҿ�鹩�Ѻ���᷹�������Ҿ�������¹��Ҵ����...',
  'instruction' => '��������ҧ�Ǵ����',
  'instruction_action' => '���͡��÷ӧҹ',
  'instruction_parameter' => '���͡ ����������',
  'instruction_album' => '���͡��ź���',
  'instruction_press' => '�� %s',
  'update' => '�ѹ�֡�������¹�ŧ�Ҿ�������Ŵ��Ҵ�Ҿ',
  'update_what' => '��觨��������¹�ŧ',
  'update_thumb' => '੾���Ҿ���',
  'update_pic' => '੾���ҾŴ��Ҵ',
  'update_both' => '����Ҿ�������Ҿ���Ŵ��Ҵ����',
  'update_number' => '�ӹǹ�Ҿ� 1 ����',
  'update_option' => '(�ͧŴ�س���ѵԹ��ŧ �ҡ�Դ�ѭ�� timeout)',
  'filename_title' => '������� &rArr; �����Ҿ', //cpg1.3.0
  'filename_how' => '����¹����������ҧ��',
  'filename_remove' => 'ź .jpg ���᷹����� _ (underscore)',
  'filename_euro' => '����¹ 2003_11_23_13_20_20.jpg �� 23/11/2003 13:20',
  'filename_us' => '����¹ 2003_11_23_13_20_20.jpg ��o 11/23/2003 13:20',
  'filename_time' => '����¹ 2003_11_23_13_20_20.jpg �� 13:20',
  'delete' => 'ź�����Ҿ��Т�Ҵ�ٻ', //cpg1.3.0
  'delete_title' => 'ź�����Ҿ', //cpg1.3.0
  'delete_original' => 'ź��Ҵ�ٻ',
  'delete_replace' => 'ź�Ҿ�鹩�Ѻ���᷹�����¢�Ҵ�������¹�ŧ����',
  'select_album' => '���͡��ź���',
  'delete_orphans' => 'ź������繷��Դ��Ҵ (��ء��ź���)', //cpg1.3.0
  'orphan_comment' => '��������繷��Դ��Ҵ', //cpg1.3.0
  'delete' => 'ź', //cpg1.3.0
  'delete_all' => 'ź������', //cpg1.3.0
  'comment' => '�������: ', //cpg1.3.0
  'nonexist' => '�����Ṻ�Դ��Ҵ # ', //cpg1.3.0
  'phpinfo' => '�ʴ� phpinfo', //cpg1.3.0
  'update_db' => '�ѹ�֡������', //cpg1.3.0
  'update_db_explanation' => 'If you have replaced coppermine files, added a modification or upgraded from a previous version of coppermine, make sure to run the database update once. This will create the necessary tables and/or config values in your coppermine database.', //cpg1.3.0
);

?>
