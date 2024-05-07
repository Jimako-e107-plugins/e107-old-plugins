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
// CVS version: $Id: chinese_gb.php,v 1.11 2004/12/29 23:06:33 chtito Exp $
// ------------------------------------------------------------------------- //

// info about translators and translated language
$lang_translation_info = array(
  'lang_name_english' => 'Chinese',
  'lang_name_native' => '��������(GB2312)',
  'lang_country_code' => 'zh',
  'trans_name'=> 'Cheng Dong',
  'trans_email' => 'ccdong@gmail.com',
  'trans_website' => 'http://www.thirdclassroom.com/',
  'trans_date' => '2004-11-14',
);

$lang_charset = 'gb-2312';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('������', '����һ', '���ڶ�', '������', '������', '������', '������');
$lang_month = array('һ��', '����', '����', '����', '����', '����', '����', '����', '����', 'ʮ��', 'ʮһ��', 'ʮ����');

// Some common strings
$lang_yes = '��';
$lang_no  = '��';
$lang_back = '����';
$lang_continue = '����';
$lang_info = 'ѶϢ';
$lang_error = '����';

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
  'random' => '���ͼƬ', //cpg1.3.0
  'lastup' => '�����ϴ�',
  'lastalb'=> '�������',
  'lastcom' => '��������',
  'topn' => '����ͼƬ',
  'toprated' => '�������',
  'lasthits' => '�����ʾ',
  'search' => '��Ѱ���',
  'favpics'=> '�ͼƬ', //cpg1.3.0
);

$lang_errors = array(
  'access_denied' => '��û��ʹ�ñ�ҳ��Ȩ��.',
  'perm_denied' => '��û��Ȩ��ִ�д˶���.',
  'param_missing' => '���򱻺��ж�û����Ҫ�Ĳ���.',
  'non_exist_ap' => '��ѡ��� �ಾ/ͼƬ ������ !', //cpg1.3.0
  'quota_exceeded' => '�����ռ����<br /><br />�������� [quota]K, ��ʹ�õ��� [space]K, �����ͼƬ�ᳬ�����.', //cpg1.3.0
  'gd_file_type_err' => '��ʹ�� GD ͼ������ֻ���� JPEG / PNG ͼ��.',
  'invalid_image' => '���ϴ����ĵ�������, ���� GD ͼ�����ⲻ�ܴ���',
  'resize_failed' => '�޷�������ͼ����ͼ���ߴ�.',
  'no_img_to_display' => 'û��ͼƬ������ʾ.',
  'non_exist_cat' => '��ѡ�����𲢲�����.',
  'orphan_cat' => '�����������һ�������ڵĸ����, �����������������������.', //cpg1.3.0
  'directory_ro' => 'Ŀ¼ \'%s\' �޷�д��, ����ͼƬ�޷�ɾ��', //cpg1.3.0
  'non_exist_comment' => '��ѡ������Բ�������.',
  'pic_in_invalid_album' => '��ͼƬ���ڲ����ڵ��ಾ (%s)!?', //cpg1.3.0
  'banned' => '��Ŀǰ����ֹʹ�ñ�վ.',

  'not_with_udb' => '���ڱ��ಾ�Ѻ���̳��������, �˹���ֹͣʹ��. ������Ŀǰ�趨��֧Ԯ, ��������̳����.', 
  'offline_title' => '����', //cpg1.3.0
  'offline_text' => '�ಾĿǰ����- ���Ժ�����', //cpg1.3.0
  'ecards_empty' => 'Ŀǰû�е��ӿ�Ƭ�ļ�¼����ʾ. �����ಾ�趨���Ƿ����õ��ӿ�Ƭ��־!', //cpg1.3.0
  'action_failed' => '����ʧ��.  Coppermine �޷�ִ�����Ҫ��.', //cpg1.3.0
  'no_zip' => '�޷�ִ��ZIPѹ���ļ�.  ����������ಾ����Ա.', //cpg1.3.0
  'zip_type' => '��û��Ȩ���ϴ�ZIPѹ���ļ�.', //cpg1.3.0
);

$lang_bbcode_help = '�ο�����: <li>[b]<b>Bold</b>[/b]</li> <li>[i]<i>Italic</i>[/i]</li> <li>[url=http://yoursite.com/]Url Text[/url]</li> <li>[email]user@domain.com[/email]</li>'; //cpg1.3.0

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
  'alb_list_title' => '�����ಾĿ¼',
  'alb_list_lnk' => '�ಾĿ¼',
  'my_gal_title' => '�����ҵ��ಾ',
  'my_gal_lnk' => '�ҵ��ಾ',
  'my_prof_lnk' => '�ҵĸ�������',
  'adm_mode_title' => 'תΪ����ģʽ',
  'adm_mode_lnk' => '����ģʽ',
  'usr_mode_title' => 'תΪ��Աģʽ',
  'usr_mode_lnk' => '��Աģʽ',
  'upload_pic_title' => '�ϴ�ͼƬ���ಾ', //cpg1.3.0
  'upload_pic_lnk' => '�ϴ�ͼƬ', //cpg1.3.0
  'register_title' => '������Ա�ʺ�',
  'register_lnk' => 'ע��',
  'login_lnk' => '����',
  'logout_lnk' => '�ǳ�',
  'lastup_lnk' => '�����ϴ�',
  'lastcom_lnk' => '��������',
  'topn_lnk' => '����ͼƬ',
  'toprated_lnk' => '�������',
  'search_lnk' => '��Ѱ',
  'fav_lnk' => '�ҵ��',
  'memberlist_title' => '��ʾ��Ա�б�', //cpg1.3.0
  'memberlist_lnk' => '��Ա�б�', //cpg1.3.0
  'faq_title' => '�ಾ�ĳ��������� &quot;Coppermine&quot;', //cpg1.3.0
  'faq_lnk' => '����������', //cpg1.3.0
);

$lang_gallery_admin_menu = array(
  'upl_app_lnk' => '��׼�ϴ�',
  'config_lnk' => '�趨',
  'albums_lnk' => '�ಾ',
  'categories_lnk' => '���',
  'users_lnk' => '��Ա',
  'groups_lnk' => 'Ⱥ��',
  'comments_lnk' => '�ۿ�����', //cpg1.3.0
  'searchnew_lnk' => '��������ͼƬ', //cpg1.3.0
  'util_lnk' => '����Ա������', //cpg1.3.0
  'ban_lnk' => 'ͣȨ��Ա',
  'db_ecard_lnk' => '��ʾ���ӿ�Ƭ', //cpg1.3.0
);

$lang_user_admin_menu = array(
  'albmgr_lnk' => '����/���� �ҵ��ಾ',
  'modifyalb_lnk' => '�༭�ҵ��ಾ',
  'my_prof_lnk' => '�ҵĸ�������',
);

$lang_cat_list = array(
  'category' => '���',
  'albums' => '�ಾ',
  'pictures' => 'ͼƬ', //cpg1.3.0
);

$lang_album_list = array(
  'album_on_page' => '%d �ಾ�� %d ҳ',
);

$lang_thumb_view = array(
  'date' => '����',
  //Sort by filename and title
  'name' => '����',
  'title' => '����',
  'sort_da' => '���������� ��Զ����',
  'sort_dd' => '���������� �ɽ���Զ',
  'sort_na' => '���������� ��С����',
  'sort_nd' => '���������� �ɴ���С',
  'sort_ta' => '���������� ��С����',
  'sort_td' => '���������� �ɴ���С',
  'download_zip' => '���س� Zip ��', //cpg1.3.0
  'pic_on_page' => '%d ͼƬ�� %d ҳ',
  'user_on_page' => '%d ��Ա�� %d ҳ', //cpg1.3.0
);

$lang_img_nav_bar = array(
  'thumb_title' => '������ͼҳ',
  'pic_info_title' => '��ʾ/���� ͼƬ��Ѷ', //cpg1.3.0
  'slideshow_title' => '��������',
  'ecard_title' => '��ͼƬ�Ե��ӿ�Ƭ�ĳ�', //cpg1.3.0
  'ecard_disabled' => '���ӿ�Ƭ����Ŀǰͣ��',
  'ecard_disabled_msg' => '��û��Ȩ�޼ĵ��ӿ�Ƭ', //js-alert //cpg1.3.0
  'prev_title' => '�ۿ�ǰһ��ͼƬ', //cpg1.3.0
  'next_title' => '�ۿ���һ��ͼƬ', //cpg1.3.0
  'pic_pos' => 'ͼƬ %s/%s', //cpg1.3.0
);

$lang_rate_pic = array(
  'rate_this_pic' => '��ͼƬ����', //cpg1.3.0
  'no_votes' => '(��û��������)',
  'rating' => '(Ŀǰ�÷� : %s / 5 �� %s ������)',
  'rubbish' => '�赹 ����Ҳ��',
  'poor' => '�е�',
  'fair' => '����ͨͨ',
  'good' => '�ܺ�',
  'excellent' => '�ǳ���ɫ',
  'great' => '���ͼƬ',
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
  CRITICAL_ERROR => '��������',
  'file' => '�ĵ�: ',
  'line' => '����: ',
);

$lang_display_thumbnails = array(
  'filename' => '�ĵ����� : ',
  'filesize' => '�ĵ���С : ',
  'dimensions' => 'Ӱ��ߴ� : ',
  'date_added' => '�������� : ', //cpg1.3.0
);

$lang_get_pic_data = array(
  'n_comments' => '%s ������',
  'n_views' => '%s �ιۿ�',
  'n_votes' => '(%s ������)',
);

$lang_cpg_debug_output = array(
  'debug_info' => '����ѶϢ', //cpg1.3.0
  'select_all' => 'ȫѡ', //cpg1.3.0
  'copy_and_paste_instructions' => '�����Ҫ��Coppermine֧Ԯ��̳��Ҫ��Э��, ���Ʋ����� �������ѶϢ����ķ���������. ��������ǰ��ȷ����***ȡ���������.', //cpg1.3.0
  'phpinfo' => '��ʾphpѶϢ', //cpg1.3.0
);

$lang_language_selection = array(
  'reset_language' => 'Ԥ������', //cpg1.3.0
  'choose_language' => 'ѡ���������', //cpg1.3.0
);

$lang_theme_selection = array(
  'reset_theme' => 'Ԥ�貼������', //cpg1.3.0
  'choose_theme' => 'ѡ�񲼾�����', //cpg1.3.0
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
  'Exclamation' => '��̾',
  'Question' => '����',
  'Very Happy' => '�ܸ���',
  'Smile' => '΢Ц',
  'Sad' => '����',
  'Surprised' => '����',
  'Shocked' => '��',
  'Confused' => '�赹',
  'Cool' => '�ܰ�',
  'Laughing' => '��Ц',
  'Mad' => '����',
  'Razz' => '��Ц',
  'Embarassed' => '����',
  'Crying or Very sad' => '����',
  'Evil or Very Mad' => '��',
  'Twisted Evil' => '�Ź�',
  'Rolling Eyes' => '��ת���۾�',
  'Wink' => 'գ��',
  'Idea' => '����',
  'Arrow' => '��ͷ',
  'Neutral' => '����',
  'Mr. Green' => '��������',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
  0 => '���뿪����ģʽ...',
  1 => '���������ģʽ...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
  'alb_need_name' => '����Ҫ���ಾһ������ !', //js-alert
  'confirm_modifs' => 'ȷ��Ҫ����Щ�޸��� ?', //js-alert
  'no_change' => '��û�����κθı� !', //js-alert
  'new_album' => '���ಾ',
  'confirm_delete1' => 'ȷ��Ҫɾ�����ಾ�� ?', //js-alert
  'confirm_delete2' => '\n����ͼƬ�����Զ���ɾ�� !', //js-alert
  'select_first' => '����ѡ��һ���ಾ', //js-alert
  'alb_mrg' => '�ಾ����Ա',
  'my_gallery' => '* �ҵ��ಾ *',
  'no_category' => '* û����� *',
  'delete' => 'ɾ��',
  'new' => '����',
  'apply_modifs' => '�޸�',
  'select_category' => 'ѡ�����',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
  'miss_param' => '\'%s\'��������Ҫ�Ĳ�����δ�ṩ !',
  'unknown_cat' => '��ѡ�����𲢲����������Ͽ�',
  'usergal_cat_ro' => '��Ա�ಾ�����ɾ�� !',
  'manage_cat' => '������',
  'confirm_delete' => 'ȷ��Ҫɾ���������', //js-alert
  'category' => '���',
  'operations' => '����',
  'move_into' => '������',
  'update_create' => '����/���� ���',
  'parent_cat' => '�����',
  'cat_title' => '������',
  'cat_thumb' => '�����ͼ', //cpg1.3.0
  'cat_desc' => '�������',
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
  'title' => '�趨',
  'restore_cfg' => '�ظ�ԭʼ�趨',
  'save_cfg' => '�������趨',

  'notes' => 'ע��',
  'info' => 'ѶϢ',
  'upd_success' => '�趨�Ѹ���',
  'restore_success' => 'ԭʼ�趨�ѻظ�',
  'name_a' => '���������� ��С����',
  'name_d' => '���������� �ɴ���С',
  'title_a' => '���������� ��С����',
  'title_d' => '���������� �ɴ���С',
  'date_a' => '���������� ��Զ����',
  'date_d' => '���������� �ɽ���Զ',
  'th_any' => '������',
  'th_ht' => '�߶�',
  'th_wd' => '���',
  'label' => '��ǩ', //cpg1.3.0
  'item' => '��Ŀ', //cpg1.3.0
  'debug_everyone' => '�κ���', //cpg1.3.0
  'debug_admin' => '����Աר��', //cpg1.3.0
        );

if (defined('CONFIG_PHP')) $lang_config_data = array(
  '�����趨',
  array('�ಾ����', 'gallery_name', 0),
  array('�ಾ����', 'gallery_description', 0),
  array('�ಾ����Ա�����ʼ�', 'gallery_admin_email', 0),
  array('�ڵ��ӿ�Ƭ����ʾ\'�ۿ�����ͼƬ\'����ַ', 'ecards_more_pic_target', 0),
  array('�ಾĿǰ������', 'offline', 1), //cpg1.3.0
  array('���ӿ�Ƭ��־', 'log_ecards', 1), //cpg1.3.0
  array('�������ͼƬ���س�ZIP��', 'enable_zipdownload', 1), //cpg1.3.0

  '��ϵ, ���� &amp; ���ֱ����趨',
  array('����', 'lang', 5),
  array('����', 'theme', 6),
  array('��ʾ�����б�', 'language_list', 1), //cpg1.3.0
  array('��ʾ���Թ���', 'language_flags', 8), //cpg1.3.0
  array('��ʾ &quot;����&quot; ������ѡ��', 'language_reset', 1), //cpg1.3.0
  array('��ʾ�����б�', 'theme_list', 1), //cpg1.3.0
  array('��ʾ &quot;����&quot; �ڲ���ѡ��', 'theme_reset', 1), //cpg1.3.0
  array('��ʾ FAQ', 'display_faq', 1), //cpg1.3.0
  array('��ʾ bbcode help', 'show_bbcode_help', 1), //cpg1.3.0
  array('���ֱ���', 'charset', 4), //cpg1.3.0

  '�ಾĿ¼��ʾ',
  array('��Ҫ����� (���ػ� %)', 'main_table_width', 0),
  array('ͬһ��ε��������ʾ����', 'subcat_level', 0),
  array('�ಾ��ʾ����', 'albums_per_page', 0),
  array('�ಾĿ¼ҳ�ಾ����', 'album_list_cols', 0),
  array('��ͼ����', 'alb_list_thumb_size', 0),
  array('��ҳ������', 'main_page_layout', 0),
  array('��ʾ�����е�һ����ಾ��ͼ','first_level',1),

  '��ͼ��ʾ',
  array('��ͼҳ����', 'thumbcols', 0),
  array('��ͼҳ����', 'thumbrows', 0),
  array('�����ʾ��߸���', 'max_tabs', 10), //cpg1.3.0
  array('��ʾͼƬ˵������ͼ�·� (���ӵı���)', 'caption_in_thumbview', 1), //cpg1.3.0
  array('��ʾ�ۿ���������ͼ�·�', 'views_in_thumbview', 1), //cpg1.3.0
  array('��ʾ����������ͼ�·�', 'display_comment_count', 1),
  array('��ʾ�ϴ�����������ͼ�·�', 'display_uploader', 1), //cpg1.3.0
  array('ͼƬ��ԭʼ�������', 'default_sort_order', 3), //cpg1.3.0
  array('\'����ͶƱ\'��Ҫ����ͶƱ��', 'min_votes_for_rating', 0), //cpg1.3.0

  'ͼƬ��ʾ &amp; �����趨',
  array('ͼƬ��ʾ�ı���� (���ػ� %)', 'picture_table_width', 0), //cpg1.3.0
  array('ͼƬ��ѶԤ����ʾ', 'display_pic_info', 1), //cpg1.3.0
  array('�����ڹ��˲�������', 'filter_bad_words', 1),
  array('���Կ���ʹ��Ц��ͼʾ', 'enable_smilies', 1),
  array('�����Ա��ͬһ��ͼƬ ������������(�رչ�ˮ����)', 'disable_comment_flood_protect', 1), //cpg1.3.0
  array('ͼƬ�������ݵ���󳤶�', 'max_img_desc_length', 0),
  array('�������ݵ��������', 'max_com_wlength', 0),
  array('���Ե��������', 'max_com_lines', 0),
  array('���Ե���󳤶�', 'max_com_size', 0),
  array('��ʾͼƬԤ����', 'display_film_strip', 1),
  array('ͼƬԤ���е�ͼƬ��', 'max_film_strip_items', 0),
  array('������ʱ �õ����ʼ�֪ͨ����Ա', 'email_comment_notification', 1), //cpg1.3.0
  array('�������ż���� ����(1 �� = 1000 ����)', 'slideshow_interval', 0), //cpg1.3.0

  'ͼƬ����ͼ�趨', //cpg1.3.0
  array('JPEG ��ʽƷ��', 'jpeg_qual', 0),
  array('��ͼ���ߴ� <a href="#notice2" class="clickable_option">**</a>', 'thumb_width', 0), //cpg1.3.0
  array('ʹ�óߴ� ( ���߻���ͼ���߳� )<b>**</b>', 'thumb_use', 7),
  array('�����м�ͼƬ','make_intermediate',1),
  array('�м�ͼƬ/ӰƬ���ߴ� <a href="#notice2" class="clickable_option">**</a>', 'picture_width', 0), //cpg1.3.0
  array('�ϴ�ͼ����������� (KB)', 'max_upl_size', 0), //cpg1.3.0
  array('�ϴ�ͼƬ/ӰƬ�����߳ߴ� (����)', 'max_upl_width_height', 0), //cpg1.3.0

  'ͼƬ����ͼ�Ľ����趨', //cpg1.3.0
  array('��ʾ˽���ಾͼƬ��δ�����Ա','show_private',1), //cpg1.3.0
  array('�ĵ����Ʋ����ܵ��ַ�', 'forbiden_fname_char',0), //cpg1.3.0
  //array('�ϴ�ͼ���ɽ��ܵ���չ��', 'allowed_file_extensions',0), //cpg1.3.0
  array('�ɽ��ܵ�ͼƬ������', 'allowed_img_types',0), //cpg1.3.0
  array('�ɽ��ܵ�ӰƬ������', 'allowed_mov_types',0), //cpg1.3.0
  array('�ɽ��ܵ�����������', 'allowed_snd_types',0), //cpg1.3.0
  array('�ɽ��ܵ��ļ�������', 'allowed_doc_types',0), //cpg1.3.0
  array('������ͼ�ķ���','thumb_method',2), //cpg1.3.0
  array('ImageMagick \'convert\' �����·�� (���� /usr/bin/X11/)', 'impath', 0), //cpg1.3.0
  //array('�ɽ��ܵ�ͼ������(ֻ�� ImageMagick ��Ч)', 'allowed_img_types',0), //cpg1.3.0
  array('ImageMagick ��������ѡ��', 'im_options', 0), //cpg1.3.0
  array('��ȡ JPEG �ĵ��� EXIF ����', 'read_exif_data', 1), //cpg1.3.0
  array('��ȡ JPEG �ĵ��� IPTC ����', 'read_iptc_data', 1), //cpg1.3.0
  array('�ಾ·�� <a href="#notice1" class="clickable_option">*</a>', 'fullpath', 0), //cpg1.3.0
  array('��Աͼ��·�� <a href="#notice1" class="clickable_option">*</a>', 'userpics', 0), //cpg1.3.0
  array('�м�ͼ����ǰ����Ԫ <a href="#notice1" class="clickable_option">*</a>', 'normal_pfx', 0), //cpg1.3.0
  array('��ͼ����ǰ����Ԫ <a href="#notice1" class="clickable_option">*</a>', 'thumb_pfx', 0), //cpg1.3.0
  array('����ͼ��Ŀ¼��Ԥ��Ȩ��', 'default_dir_mode', 0), //cpg1.3.0
  array('�ϴ�ͼƬ��Ԥ��Ȩ��', 'default_file_mode', 0), //cpg1.3.0

  '��Ա�趨',
  array('�����»�Աע��', 'allow_user_registration', 1),
  array('ע����Ҫ�����ʼ���֤', 'reg_requires_valid_email', 1),
  array('��ʹ����ע��ʱ �õ����ʼ�֪ͨ����Ա', 'reg_notify_admin_email', 1), //cpg1.3.0
  array('����������Աʹ��ͬһ�������ʼ���ַ', 'allow_duplicate_emails_addr', 1),
  array('��Ա������˽�˵��ಾ (ע��: ������л� �ǵ��� �κ�Ŀǰ˽���ಾ����ɹ����ಾ)', 'allow_private_albums', 1), //cpg1.3.0
  array('�л�Ա�ϴ��ĵ��ȴ���׼ʱ ֪ͨ����Ա', 'upl_notify_admin_email', 1), //cpg1.3.0
  array('�������Ļ�Ա�鿴��Ա�б�', 'allow_memberlist', 1), //cpg1.3.0

  'Ӱ���������Զ���λ (�����ʹ�������¿հ�)',
  array('��λ 1 ����', 'user_field1_name', 0),
  array('��λ 2 ����', 'user_field2_name', 0),
  array('��λ 3 ����', 'user_field3_name', 0),
  array('��λ 4 ����', 'user_field4_name', 0),

  'Cookies settings',
  array('ʹ�õ� cookie ���� (����̳��������ʱ, ȷ��������̳��cookie��ͬ)', 'cookie_name', 0),
  array('ʹ�õ� cookie ·��', 'cookie_path', 0),

  '�����趨',
  array('��������ģʽ', 'debug_mode', 9), //cpg1.3.0
  array('�ڳ���ģʽʱ��ʾ��ʾ', 'debug_notice', 1), //cpg1.3.0

  '<br /><div align="left"><a name="notice1"></a>(*) ���ಾ����ͼƬ, ��ʾ�� * ����λ��ʾ���ɸ���.<br />
  <a name="notice2"></a>(**) �ı�����趨ֻӰ���Ѿ�������ĵ�, �����Щ�ĵ��Ѿ����ಾ����,����趨���ظı�. �������,����Դ� ����Ա����ѡ���� �������е��ĵ�,�� &quot;<a href="util.php">����Ա������</a> (����ͼƬ�ߴ�)&quot; </div><br />', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File db_ecard.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('DB_ECARD_PHP')) $lang_db_ecard_php = array(
  'title' => '�ĳ����ӿ�Ƭ', //cpg1.3.0
  'ecard_sender' => '������', //cpg1.3.0
  'ecard_recipient' => '������', //cpg1.3.0
  'ecard_date' => '����', //cpg1.3.0
  'ecard_display' => '��ʾ���ӿ�Ƭ', //cpg1.3.0
  'ecard_name' => '����', //cpg1.3.0
  'ecard_email' => '�����ʼ���ַ', //cpg1.3.0
  'ecard_ip' => 'IP #', //cpg1.3.0
  'ecard_ascending' => '����', //cpg1.3.0
  'ecard_descending' => '����', //cpg1.3.0
  'ecard_sorted' => '����', //cpg1.3.0
  'ecard_by_date' => '������', //cpg1.3.0
  'ecard_by_sender_name' => '������������', //cpg1.3.0
  'ecard_by_sender_email' => '���������ʼ�', //cpg1.3.0
  'ecard_by_sender_ip' => '�������˵� IP λַ', //cpg1.3.0
  'ecard_by_recipient_name' => '������������', //cpg1.3.0
  'ecard_by_recipient_email' => '���������ʼ�', //cpg1.3.0
  'ecard_number' => '��ʾ��¼ %s �� %s �� %s', //cpg1.3.0
  'ecard_goto_page' => '��ҳ��', //cpg1.3.0
  'ecard_records_per_page' => 'ҳ�μ�¼', //cpg1.3.0
  'check_all' => 'ȫѡ', //cpg1.3.0
  'uncheck_all' => '����ѡ', //cpg1.3.0
  'ecards_delete_selected' => 'ɾ���Ѿ�ѡ��Ŀ�Ƭ', //cpg1.3.0
  'ecards_delete_confirm' => '��ȷ��Ҫɾ����¼? ���ѡ!', //cpg1.3.0
  'ecards_delete_sure' => '��ȷ��', //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
  'empty_name_or_com' => '������������ֺ�����',
  'com_added' => '���������Ѿ�����',
  'alb_need_title' => '������Ϊ�ಾ�ṩһ������ !',
  'no_udp_needed' => 'û�и��µı�Ҫ',
  'alb_updated' => '�ಾ�Ѿ�����',
  'unknown_album' => '��ѡ����ಾ�����ڻ���û��Ȩ���ϴ��ĵ������ಾ',
  'no_pic_uploaded' => 'û���ĵ����ϴ� !<br /><br />�����ȷ����ѡ���ĵ��ϴ�, ����������Ƿ������ϴ��ĵ�...', //cpg1.3.0
  'err_mkdir' => '�޷�����Ŀ¼ %s !',
  'dest_dir_ro' => 'Ŀ¼ %s �޷�д�� !',
  'err_move' => '�޷����� %s �� %s !',
  'err_fsize_too_large' => '���ϴ���ͼƬ̫�� (���ܳ��� %s x %s) !', //cpg1.3.0
  'err_imgsize_too_large' => '���ϴ���ͼ��̫�� (���ܳ��� %s KB) !',
  'err_invalid_img' => '�ϴ����ĵ������������ͼƬ��ʽ !',
  'allowed_img_types' => '��ֻ�����ϴ� %s ��ͼƬ.',
  'err_insert_pic' => '�ĵ� \'%s\' �޷�������ಾ ', //cpg1.3.0
  'upload_success' => '�ĵ��ϴ����!<br /><br />�������ߺ�׼��Ϳ��Կ����ĵ���.', //cpg1.3.0
  'notify_admin_email_subject' => '%s - �ϴ��ĵ�֪ͨ', //cpg1.3.0
  'notify_admin_email_body' => '%s���ϴ��ĵ� ��Ҫ��ĺ�׼. ����� %s', //cpg1.3.0
  'info' => 'ѶϢ',
  'com_added' => '�����Ѽ���',
  'alb_updated' => '�ಾ�Ѿ�����',
  'err_comment_empty' => '�����ǿյ� !',
  'err_invalid_fext' => 'ֻ�����е���չ�������� : <br /><br />%s.',
  'no_flood' => '��Ǹ, ��ͼƬ���һ�����������ṩ<br /><br />�������޸���������', //cpg1.3.0
  'redirect_msg' => 'ҳ��ת����.<br /><br /><br />�� \'����\' ���ҳ��û���Զ�ˢ��',
  'upl_success' => '�Ѿ���������ͼƬ', //cpg1.3.0
  'email_comment_subject' => '�Ѿ������Է�������·�ಾ', //cpg1.3.0
  'email_comment_body' => '�Ѿ������Է����������ಾ.�����', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
  'caption' => '˵��',
  'fs_pic' => 'ԭͼ',
  'del_success' => '���ɾ��',
  'ns_pic' => '��׼�ߴ�ͼƬ',
  'err_del' => '�޷�ɾ��',
  'thumb_pic' => '��ͼ',
  'comment' => '����',
  'im_in_alb' => '�ಾ��ͼƬ',
  'alb_del_success' => '�ಾ \'%s\' ��ɾ��',
  'alb_mgr' => '�ಾ����',
  'err_invalid_data' => '���յ�����ȷ�������� \'%s\'',
  'create_alb' => '�����ಾ \'%s\'',
  'update_alb' => '�����ಾ \'%s\' ����Ϊ \'%s\' ����Ϊ \'%s\'',
  'del_pic' => 'ɾ��ͼƬ', //cpg1.3.0
  'del_alb' => 'ɾ���ಾ',
  'del_user' => 'ɾ����Ա',
  'err_unknown_user' => '��ѡ��Ļ�Ա������ !',
  'comment_deleted' => '������ɾ��',
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
  'confirm_del' => 'ȷ��Ҫɾ����ͼƬ�� ? \\n����Ҳ�ᱻɾ��.', //js-alert //cpg1.3.0
  'del_pic' => 'ɾ����ͼƬ', //cpg1.3.0
  'size' => '%s x %s ����',
  'views' => '%s ��',
  'slideshow' => '��������',
  'stop_slideshow' => 'ֹͣ����',
  'view_fs' => '��ѡͼƬ�Թۿ�ԭͼ',
  'edit_pic' => '�༭˵��', //cpg1.3.0
  'crop_pic' => '�ü�����ת', //cpg1.3.0
);

$lang_picinfo = array(
  'title' =>'ͼƬ��Ѷ', //cpg1.3.0
  'Filename' => '�ĵ�����',
  'Album name' => '�ಾ����',
  'Rating' => '���� (%s ��ͶƱ)',
  'Keywords' => '�ؼ���',
  'File Size' => '�ĵ���С',
  'Dimensions' => '�ߴ�',
  'Displayed' => '��ʾ',
  'Camera' => '���',
  'Date taken' => '��������',
  'Aperture' => '��Ȧ',
  'Exposure time' => '�ع�ʱ��',
  'Focal length' => '����',
  'Comment' => '����',
  'addFav'=>'�ӵ��ҵ��', //cpg1.3.0
  'addFavPhrase'=>'�ҵ��', //cpg1.3.0
  'remFav'=>'���ҵ���Ƴ�', //cpg1.3.0
  'iptcTitle'=>'IPTC ����', //cpg1.3.0
  'iptcCopyright'=>'IPTC ��Ȩ', //cpg1.3.0
  'iptcKeywords'=>'IPTC �ؼ���', //cpg1.3.0
  'iptcCategory'=>'IPTC ���', //cpg1.3.0
  'iptcSubCategories'=>'IPTC �����', //cpg1.3.0
);

$lang_display_comments = array(
  'OK' => 'OK',
  'edit_title' => '�༭������',
  'confirm_delete' => 'ȷ��Ҫɾ�������� ?', //js-alert
  'add_your_comment' => '�����������',
  'name'=>'����',
  'comment'=>'����',
  'your_name' => '����',
);

$lang_fullsize_popup = array(
  'click_to_close' => '��ѡͼƬ�Թر��Ӵ�',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
  'title' => '�ĳ� ���ӿ�Ƭ',
  'invalid_email' => '<b>����</b> : ����ȷ�ĵ����ʼ���ַ !',
  'ecard_title' => '%s ��������� ���ӿ�Ƭ',
  'error_not_image' => '���ӿ�Ƭֻ�ܼĳ�ͼƬ.', //cpg1.3.0
  'view_ecard' => '��� ���ӿ�Ƭ �޷���ȷ��ʾ, �밴������',
  'view_more_pics' => '�������ῴ����ͼƬ !',
  'send_success' => '��� ���ӿ�Ƭ �ĳ�',
  'send_failed' => '��Ǹ, ���������޷�Ϊ��ĳ� ���ӿ�Ƭ...',
  'from' => '��',
  'your_name' => '�������',
  'your_email' => '��ĵ����ʼ���ַ',
  'to' => '��',
  'rcpt_name' => '����������',
  'rcpt_email' => '�����˵����ʼ���ַ',
  'greetings' => '�ʺ���',
  'message' => 'ѶϢ����',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
  'pic_info' => 'File&nbsp;info', //cpg1.3.0
  'album' => '�ಾ',
  'title' => '����',
  'desc' => '����',
  'keywords' => '�ؼ���',
  'pic_info_str' => '%s &times; %s - %s KB - %s �ιۿ� - %s ������',
  'approve' => '��׼ͼƬ', //cpg1.3.0
  'postpone_app' => '�ӳٺ�׼',
  'del_pic' => 'ɾ��ͼƬ', //cpg1.3.0
  'read_exif' => '�ٴζ�ȡEXIF ѶϢ', //cpg1.3.0
  'reset_view_count' => '����ۿ�������',
  'reset_votes' => '��������',
  'del_comm' => 'ɾ������',
  'upl_approval' => '��׼�ϴ�',
  'edit_pics' => '�༭ͼƬ', //cpg1.3.0
  'see_next' => '�ۿ���һ��ͼƬ', //cpg1.3.0
  'see_prev' => '�ۿ�ǰһ��ͼƬ', //cpg1.3.0
  'n_pic' => '%s ��ͼƬ', //cpg1.3.0
  'n_of_pic_to_disp' => 'ͼƬ��ʾ����', //cpg1.3.0
  'apply' => '�޸�', //cpg1.3.0
  'crop_title' => 'Coppermine ͼƬ�༭��', //cpg1.3.0
  'preview' => 'Ԥ��', //cpg1.3.0
  'save' => '�浵', //cpg1.3.0
  'save_thumb' =>'�����ͼ', //cpg1.3.0
  'sel_on_img' =>'�����Ѿ����!', //js-alert //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File faq.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FAQ_PHP')) $lang_faq_php = array(
  'faq' => '����������', //cpg1.3.0
  'toc' => 'Ŀ¼', //cpg1.3.0
  'question' => '����: ', //cpg1.3.0
  'answer' => '���: ', //cpg1.3.0
);

if (defined('FAQ_PHP')) $lang_faq_data = array(
  'һ������������', //cpg1.3.0
  array('ΪʲôҪע��?', '����Ա����ʹ�����Ƿ���Ҫע��. ע���Ϊ��Ա�ɻ�ö���Ĺ���,�� �ϴ��ĵ�,�� �ҵ���б�, ��Ӱ�����ּ��������� �ȵ�.', 'allow_user_registration', '0'), //cpg1.3.0
  array('���ע��?', '�� &quot;ע��&quot; ȥ��д��λ�ڵ����� (������λ��ѡ���).<br />�������Ա����Email ���ù��� ,����ȷ���ͳ�ע�����Ϻ� ����յ�һ����֤�� �ĵ�������д��������, �����˵�����������Ļ�Ա�ʸ�. ��Ա����ǰ ������������ö���.', 'allow_user_registration', '1'), //cpg1.3.0
  array('��ε���?', '�� &quot;����&quot;, ������Ļ�Ա���Ƽ����� �ҹ�ѡ &quot;��ס��&quot; �´���������ʱ��ͻ��Զ�������.<br /><b>ע��:������ѡ &quot;��ס�� Me&quot; ,Cookies ���ܱ��뿪��,�ұ�վ��cookie������ĵ�����..</b>', 'offline', 0), //cpg1.3.0
  array('Ϊ���޷�����?', '���Ѿ�ע��K�����ʺ�����(�ظ���֤�ʼ�������)?. �Ǹ����Ὣ����������ʺ�. ������������ ��������վ����Ա.', 'offline', 0), //cpg1.3.0
  array('������������ô�� ?', '��������վ�� &quot;����������&quot; ������,�Ͱ���. ��Ȼ��������վ����Ա ��������һ���µ�����.', 'offline', 0), //cpg1.3.0
  array('�ҵ�email�������ô�� ?', 'ֻҪ���� �K�ҵ� &quot;�ҵĸ�������&quot; �����ĵ����ʼ���ַ�Ϳ�����', 'offline', 0), //cpg1.3.0
  array('��ΰ�ͼƬ�浽  &quot;�ҵ�� &quot;?', '��ѡͼƬ���ҵ㰴 &quot;Ӱ����Ѷ&quot; ���� (<img src="images/info.gif" width="16" height="16" border="0" alt="Picture information" />); ��Ӱ����Ѷ�趨���水 &quot;�����ҵ��&quot;.<br />����Ա������Ԥ��&quot;Ӱ����Ѷ; .<br />ע��:Cookies ���ܱ��뿪��,�ұ�վ��cookie������ĵ�����.', 'offline', 0), //cpg1.3.0
  array('��ζ�ͼƬ���� ?', '�㰴��Ӱ����ͼ,��Ӱ����¿��Ե�ѡ�������.', 'offline', 0), //cpg1.3.0
  array('��η������� ?', '�㰴��Ӱ����ͼ,��Ӱ����¿��Է�������.', 'offline', 0), //cpg1.3.0
  array('����ϴ�ͼƬ ?', '�� &quot;�ϴ�ͼƬ&quot;��ѡ����Ҫ�ϴ�����һ���ಾ,�� &quot;���&quot; �ҵ�ѡҪ�ϴ���ͼƬ �� &quot;����&quot; (����Լ���Ӱ����⼰����) Ȼ�� &quot;ȷ��&quot;', 'allow_private_albums', 0), //cpg1.3.0
  array('Ҫ�������ϴ�ͼƬ ?', '������ϴ�ͼƬ�� &quot;�ҵ��ಾ&quot;. ����Ա�����������ϴ�ͼƬ�����ಾ��.', 'allow_private_albums', 0), //cpg1.3.0
  array('���ָ�ʽ���С��Ӱ������ϴ�?', '��ʽ����С (jpg,gif,..etc.) ���ݹ���Ա���趨.', 'offline', 0), //cpg1.3.0
  array('ʲô�� &quot;�ҵ��ಾ&quot;?', '&quot;�ҵ��ಾ&quot; �Ǹ��˵��ಾ,�û�Ա�����ϴ�������Ӱ��.', 'allow_private_albums', 0), //cpg1.3.0
  array('�������,�޸� ��ɾ���ಾ �� &quot;�ҵ��ಾ&quot;?', '������� &quot;����ģʽ&quot;<br />�� &quot;����/���� �ҵ��ಾ&quot;�� &quot;����New&quot;. ��� &quot;���ಾ&quot; ����Ҫ������.<br />����Զ����ÿһ���ಾ��������.<br />�� &quot;�޸�;.', 'allow_private_albums', 0), //cpg1.3.0
  array('��Ҫ��ν�ֹ������Ա���ҵ��ಾ?', '������� &quot;����ģʽ&quot;<br />�� &quot;����ҵ��ಾ. �� &quot;�����ಾ&quot; ��λ, ѡ����Ҫ������ಾ.<br />������, ����Ա���ಾ���� ���� ��ͼ ,�����ƹۿ� ���� ���� ��Ȩ��.<br />�� &quot;�����ಾ&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('��ιۿ�������Ա���ಾ?', '�� &quot;�ಾĿ¼&quot; ѡ�� &quot;��Ա�ಾ&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('ʲô�� cookies?', 'Cookies ����վ����������е���������.<br />Cookies ͨ����ʹ�����ٴλص���վʱ�Զ����� �K��¼�����趨����.', 'offline', 0), //cpg1.3.0
  array('���������ȡ������ಾ����?', 'Coppermine �ǻ���GNU GPL����Ѷ�ý���ಾ. ����ȫ���ܵ� ��֧Ԯ��ͬ��ƽ̨. �뵽<a href="http://coppermine.sf.net/">Coppermine ����վ</a> ȡ�ø������Ѷ ����������.', 'offline', 0), //cpg1.3.0

  '��վ����', //cpg1.3.0
  array('ʲô�� &quot;�ಾĿ¼ &quot;?', '�⽫��ʾ�����ಾ ����ÿһ������. ��ͼ�������ᵽ�����.', 'offline', 0), //cpg1.3.0
  array('ʲô�� &quot;�ҵ��ಾ &quot;?', '������û�Ա�����Լ����ಾ,������,ɾ��,�޸��ಾ. �K�ҿ��ϴ��ĵ����ಾ��.', 'allow_private_albums', 0), //cpg1.3.0
  array('��ʲô������ &quot;����ģʽ&quot; �� &quot;��Աģʽ&quot;?', '�����, �ڹ���ģʽʱ, �����Ա�޸������Լ����ಾ (�������Ա����Ļ�).', 'allow_private_albums', 0), //cpg1.3.0
  array('ʲô�� &quot;�ϴ�ͼƬ &quot;?', '����������Ա�ϴ�Ӱ��(�ĵ���С����ʽ������Ա�趨) ��ָ�����ಾ.', 'allow_private_albums', 0), //cpg1.3.0
  array('ʲô�� &quot;�����ϴ� &quot;?', '�������ʾ�����ϴ����ಾ���ĵ�.', 'offline', 0), //cpg1.3.0
  array('ʲô�� &quot;�������� &quot;?', '����ܻ�Ա��Ӱ�񷢱����������.', 'offline', 0), //cpg1.3.0
  array('ʲô�� &quot;����ͼƬ &quot;?', '�������ʾ���ۿ����ε�Ӱ��,�����ǻ�Ա��ÿ�.', 'offline', 0), //cpg1.3.0
  array('ʲô�� &quot;������� &quot;?', '�������ʾ��Ա������ߵ�Ӱ��, ��ʾƽ������(����: �����Ա����һ������ <img src="images/rating3.gif" width="65" height="14" border="0" alt="" />: Ӱ����ƽ������ <img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> ;�����Ա���ִ� 1 �� 5 (1,2,3,4,5) ƽ��������� <img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> .)<br />���ִ� <img src="images/rating5.gif" width="65" height="14" border="0" alt="best" /> (���) �� <img src="images/rating0.gif" width="65" height="14" border="0" alt="worst" /> (���).', 'offline', 0), //cpg1.3.0
  array('ʲô�� &quot;�ҵ�� &quot;?', '������û�Ա����ϲ����Ӱ��,��Ҫ��cookie��Ѷ.', 'offline', 0), //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// File forgot_passwd.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FORGOT_PASSWD_PHP')) $lang_forgot_passwd_php = array(
  'forgot_passwd' => '����������', //cpg1.3.0
  'err_already_logged_in' => '���Ѿ�������!', //cpg1.3.0
  'enter_username_email' => '������Ļ�Ա���ƻ� email ', //cpg1.3.0
  'submit' => 'ȷ��', //cpg1.3.0
  'failed_sending_email' => '�޷��ĳ����������ʼ� !', //cpg1.3.0
  'email_sent' => '�Ѿ�����Ļ�Ա����������ĵ� %s', //cpg1.3.0
  'err_unk_user' => 'û�������Ա!', //cpg1.3.0
  'passwd_reminder_subject' => '%s - ��������', //cpg1.3.0
  'passwd_reminder_body' => '���ĵ�����������:
Username: %s
Password: %s
�� %s ����.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
  'group_name' => 'Ⱥ������',
  'disk_quota' => '�ռ����',
  'can_rate' => '����ΪͼƬ����', //cpg1.3.0
  'can_send_ecards' => '����ĳ���Ƭ',
  'can_post_com' => '������������',
  'can_upload' => '�����ϴ��ĵ�', //cpg1.3.0
  'can_have_gallery' => '�����и����ಾ',
  'apply' => '�޸�',
  'create_new_group' => '������Ⱥ��',
  'del_groups' => 'ɾ����ѡ���Ⱥ��',
  'confirm_del' => '����, ��ɾ����һ��Ⱥ��, ���ڸ�Ⱥ����û�����ת���� \'Registered\' Ⱥ���� !\n\nnȷ��Ҫɾ�� ?', //js-alert //cpg1.3.0
  'title' => '�����ԱȺ��',
  'approval_1' => '�����ಾ�ϴ���׼ (1)',
  'approval_2' => '˽���ಾ�ϴ���׼ (2)',
  'upload_form_config' => '�ϴ���ʽ�趨', //cpg1.3.0
  'upload_form_config_values' => array( '�ϴ�һ���ĵ�', '�൵�ϴ�', 'ֻ�ϴ�URI ', 'ֻ�ϴ�ZIP ', 'File-URI', 'File-ZIP', 'URI-ZIP', 'File-URI-ZIP'), //cpg1.3.0
  'custom_user_upload'=>'��Ա���õ��ϴ�������?', //cpg1.3.0
  'num_file_upload'=>'���/ʵ�� �ĵ� �ϴ�������', //cpg1.3.0
  'num_URI_upload'=>'���/ʵ�� URI �ϴ�������', //cpg1.3.0
  'note1' => '<b>(1)</b> �ϴ�ͼƬ�������ಾ�����Ա��׼',
  'note2' => '<b>(2)</b> �ϴ�ͼƬ��˽���ಾ�����Ա��׼',
  'notes' => 'ע��',
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
  'welcome' => '�� ӭ !',
);

$lang_album_admin_menu = array(
  'confirm_delete' => 'ȷ��Ҫɾ�����ಾ ? \\n����ͼƬ�����Զ���ɾ��.', //js-alert //cpg1.3.0
  'delete' => 'ɾ��',
  'modify' => '����',
  'edit_pics' => '�༭', //cpg1.3.0
);

$lang_list_categories = array(
  'home' => '�ಾ��ҳ',
  'stat1' => '<b>[pictures]</b> ��Ӱ���� <b>[albums]</b> ���ಾ�� <b>[cat]</b> �����, �� <b>[comments]</b> ������, ���ۿ� <b>[views]</b> ��', //cpg1.3.0
  'stat2' => '<b>[pictures]</b> ��Ӱ���� <b>[albums]</b> ���ಾ, ���ۿ� <b>[views]</b> ��', //cpg1.3.0
  'xx_s_gallery' => '%s\'s �ಾ',
  'stat3' => '<b>[pictures]</b> ��Ӱ���� <b>[albums]</b> ���ಾ, �� <b>[comments]</b> ������, ���ۿ� <b>[views]</b> ��', //cpg1.3.0
);

$lang_list_users = array(
  'user_list' => '��Ա�б�',
  'no_user_gal' => '��û�л�Ա�ಾ',
  'n_albums' => '%s ���ಾ',
  'n_pics' => '%s ��Ӱ��', //cpg1.3.0
);

$lang_list_albums = array(
  'n_pictures' => '%s ��Ӱ��', //cpg1.3.0
  'last_added' => ', ����Ӱ���� %s',
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
  'login' => '����',
  'enter_login_pswd' => '�����Ա���ƺ�����',
  'username' => '��Ա����',
  'password' => '����',
  'remember_me' => '��ס��',
  'welcome' => '��ӭ %s ...',
  'err_login' => '*** �޷�����. ������ ***',
  'err_already_logged_in' => '���Ѿ����� !',
  'forgot_password_link' => '����������', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
  'logout' => '�ǳ�',
  'bye' => '�ټ� %s ...',
  'err_not_loged_in' => '����û�е��� !',
);

// ------------------------------------------------------------------------- //
// File phpinfo.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('PHPINFO_PHP')) $lang_phpinfo_php = array(
  'php_info' => 'PHP ��Ѷ', //cpg1.3.0
  'explanation' => '������PHP-function ���� <a href="http://www.php.net/phpinfo">phpinfo()</a>, Copermine ��ȡ����������ʾ.', //cpg1.3.0
  'no_link' => '�����˿������ phpinfo ���а�ȫ�ϵķ���, �����Ϊ�� �����Թ���Ա��ֵ���ʱ�Żῴ����ҳ��ԭ��. �㲻�ܽ���ҳ�������������, ��Ϊ���ǽ���������ȡ����.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
  'upd_alb_n' => '�����ಾ %s',
  'general_settings' => 'һ���趨',
  'alb_title' => '�ಾ����',
  'alb_cat' => '�ಾ���',
  'alb_desc' => '�ಾ����',
  'alb_thumb' => '�ಾ��ͼ',
  'alb_perm' => '�ಾȨ��',
  'can_view' => '�ಾ�ɹۿ�',
  'can_upload' => '�ÿͿ��ϴ�ͼƬ',
  'can_post_comments' => '�ÿͿɷ�������',
  'can_rate' => '�ÿͿ�ΪͼƬ����',
  'user_gal' => '��Ա�ಾ',
  'no_cat' => '* û����� *',
  'alb_empty' => '�ಾ�ǿյ�',
  'last_uploaded' => '����ϴ�',
  'public_alb' => '�κ��� (�����ಾ)',
  'me_only' => 'ֻ����',
  'owner_only' => 'ֻ���ಾӵ���� (%s) ',
  'groupp_only' => 'Ⱥ�� \'%s\' ��Ա',
  'err_no_alb_to_modify' => '���Ͽ���û�������޸ĵ��ಾ.',
  'update' => '�����ಾ', //cpg1.3.0
  'notice1' => '(*) ���� %sȺ��%s �趨', //cpg1.3.0 (do not translate %s!)
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
  'already_rated' => '��Ǹ, ���Ѿ�Ϊ��ͼƬ����', //cpg1.3.0
  'rate_ok' => '���������Ѿ�������',
  'forbidden' => '�㲻�ܶ����Լ���ͼƬ����.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
 {SITE_NAME} �Ĺ���Ա�ᾡ����������𷴸е�����, �����ǲ��������ÿһ���ļ�. ���������ͬ�������ļ�ֻ�Ǵ������ߵ����������, �����������Ա������ (��������������) �K�����κη�������.<br />
<br />
������ͬ�ⲻ�������κ�ɫ��, ����, ����, ������, ������, �������Ұ�ȫ, ���κο���Υ�����ļ�.  {SITE_NAME} ��Ա���κ�ʱ����Ȩ���ˁK�༭������������. �K�һ�Ա���ڱ�վ�ڵ������Ѵ������Ͽ���. ĩ������ͬ��, ���ǲ��Ὣ��������ת��������ʹ��, �������ǲ���Ϊ�κ��򺧿���Ϊ���⛪�����ϸ��κ�����.<br />
<br />
��վʹ�� cookies �����ĵ�������������Ѷ. �����Ƿ�������������. ���ĵ����ʼ���ַֻ����������֤�������϶���.<br />
<br />
���� '��ͬ��' ������ͬ����������.
EOT;

$lang_register_php = array(
  'page_title' => '��Աע��',
  'term_cond' => '���������',
  'i_agree' => '��ͬ��',
  'submit' => 'ȷ��ע��',
  'err_user_exists' => '������д�Ļ�Ա�����ѱ���ʹ��, ����ѡһ��',
  'err_password_mismatch' => '�������벻��, ������һ��',
  'err_uname_short' => '��Ա���������� 2 ���ֽ�',
  'err_password_short' => '���������� 2 ���ֽ�',
  'err_uname_pass_diff' => '��Ա���ƺ����벻������ͬ',
  'err_invalid_email' => '�����ʼ���ַ����ȷ',
  'err_duplicate_email' => '��������ʼ���ַ�Ѿ���������ʹ�ù���',
  'enter_info' => '����ע������',
  'required_info' => '���������',
  'optional_info' => 'ѡ�������',
  'username' => '��Ա����',
  'password' => '����',
  'password_again' => 'ȷ������',
  'email' => '�����ʼ���ַ',
  'location' => '���ڵ���',
  'interests' => '��Ȥ',
  'website' => '������վ',
  'occupation' => 'ְҵ',
  'error' => '����',
  'confirm_email_subject' => '%s - ע����֤',
  'information' => 'ѶϢ',
  'failed_sending_email' => '��ע��ĵ����ʼ���ַ�޷��ĳ� !',
  'thank_you' => '��л����ע��.<br /><br />һ���ں�����������ʺŵ���Ѷ�����ʼ������͵������ṩ������.',
  'acct_created' => '�����ʺ��Ѿ�����, ���������Ե���',
  'acct_active' => '�����ʺ��Ѿ�����, ���������Ե���',
  'acct_already_act' => '�����ʺ��Ѿ����� !',
  'acct_act_failed' => '���ʺ��޷����� !',
  'err_unk_user' => '��ѡ��Ļ�Ա�������� !',
  'x_s_profile' => '%s\'�ĸ�������',
  'group' => 'Ⱥ��',
  'reg_date' => '����',
  'disk_usage' => '�ռ�ʹ����',
  'change_pass' => '�޸�����',
  'current_pass' => '��������',
  'new_pass' => '������',
  'new_pass_again' => 'ȷ��������',
  'err_curr_pass' => '�������벻��ȷ',
  'apply_modif' => '�޸�',
  'change_pass' => '�޸�����',
  'update_success' => '��ĸ��������Ѿ�����',
  'pass_chg_success' => '��������Ѿ��޸�',
  'pass_chg_error' => '�������û���޸�',
  'notify_admin_email_subject' => '%s - ע��֪ͨ', //cpg1.3.0
  'notify_admin_email_body' => '��һ���»�Ա���� "%s" �Ѿ�������ಾע��', //cpg1.3.0
);

$lang_register_confirm_email = <<<EOT
��л���� {SITE_NAME} ��ע��

���Ļ�Ա���� : "{USER_NAME}"
�������� : "{PASSWORD}"

��������������������������ʺ�
���߰Ѵ����������������.

{ACT_LINK}

��ӭ��(��),

{SITE_NAME} ����

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
  'title' => '�ۿ�����',
  'no_comment' => '��û�����Կ��Թۿ�',
  'n_comm_del' => '%s ��������ɾ��',
  'n_comm_disp' => '��ʾ����������',
  'see_prev' => '��ǰһ��',
  'see_next' => '����һ��',
  'del_comm' => 'ɾ����ѡ������',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
  0 => '��ѰͼƬ����',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
  'page_title' => '��Ѱ��ͼƬ', //cpg1.3.0
  'select_dir' => 'ѡ��Ŀ¼',
  'select_dir_msg' => '�����ܿ��������� FTP �ϴ�����ͼƬ.<br /><br />��ѡ�������ϴ�ͼƬ��Ŀ¼', //cpg1.3.0
  'no_pic_to_add' => 'û��ͼƬ���Լ���', //cpg1.3.0
  'need_one_album' => 'ʹ�ô˹��ܱ�����Ҫ��һ���ಾ',
  'warning' => '����',
  'change_perm' => '�����޷�д�����Ŀ¼, ���޸�Ȩ���� 755 ��r 777 ������һ�� !', //cpg1.3.0
  'target_album' => '<b>��ͼƬ�� &quot;</b>%s<b>&quot; �� </b>%s', //cpg1.3.0
  'folder' => '���ϼ�',
  'image' => 'ͼƬ',
  'album' => '�ಾ',
  'result' => '���',
  'dir_ro' => '�޷�д��. ',
  'dir_cant_read' => '�޷���ȡ. ',
  'insert' => '����ͼƬ���ಾ', //cpg1.3.0
  'list_new_pic' => '�г���ͼƬ', //cpg1.3.0
  'insert_selected' => '������ѡ���ͼƬ', //cpg1.3.0
  'no_pic_found' => 'û���ҵ���ͼƬ', //cpg1.3.0
  'be_patient' => '�����ĵȺ�, ������Ҫһ��ʱ����������ѡͼƬ', //cpg1.3.0
  'no_album' => 'û���ಾ��ѡ��',  //cpg1.3.0
  'notes' =>  '<ul>'.
                          '<li><b>OK</b> : ��ʾͼƬ�ѳɹ�������'.
                          '<li><b>DP</b> : ��ʾͼƬ�ظ����Ѵ������Ͽ�'.
                          '<li><b>PB</b> : ��ʾͼƬ�޷�����, �����趨��ͼƬ���Ŀ¼��Ȩ��'.
                          '<li><b>NA</b> : ��ʾ�㻹û��ѡ��ͼƬ���ಾ, �� \'<a href="javascript:history.back(1)">����</a>\' ��ѡ���ಾ. �����û���ಾ <a href="albmgr.php">���Ƚ���һ��</a></li>'.
                          '<li>��� OK, DP, PB \'����\' û����ʾ�밴������ͼƬ�鿴 PHP ��ʾ�Ĵ���ѶϢ'.
                          '<li>����������ʱ, �밴��������'.
                          '</ul>', //cpg1.3.0
  'select_album' => 'ѡ���ಾ', //cpg1.3.0
  'check_all' => 'ȫѡ', //cpg1.3.0
  'uncheck_all' => '����ѡ', //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //

// Void

// ------------------------------------------------------------------------- //
// File banning.php
// ------------------------------------------------------------------------- //

if (defined('BANNING_PHP')) $lang_banning_php = array(
  'title' => 'ͣȨ��Ա',
  'user_name' => '��Ա����',
  'ip_address' => 'IPλַ',
  'expiry' => '����(�հ״�������ͣȨ)',
  'edit_ban' => '�����޸�',
  'delete_ban' => 'ɾ��',
  'add_new' => '����ͣȨ��Ա',
  'add_ban' => '����',
  'error_user' => '�Ҳ�����ʹ��������!��û����.. ', //cpg1.3.0
  'error_specify' => '����Ҫ����ָ��ʹ�������ƻ�IPλַ', //cpg1.3.0
  'error_ban_id' => '��Ч�� ID!', //cpg1.3.0
  'error_admin_ban' => '������ ���޷����Լ�ͣȨ!', //cpg1.3.0
  'error_server_ban' => '��Ҫ���Լ��ķ�����ͣȨ? ��..��Ҫ�ٿ���Ц��...', //cpg1.3.0
  'error_ip_forbidden' => '���޷���ֹ��� IP - ���� non-routable!', //cpg1.3.0
  'lookup_ip' => '�鿴IP λַ', //cpg1.3.0
  'submit' => 'ִ��!', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
  'title' => '�ϴ��ĵ�', //cpg1.3.0
  'custom_title' => '�ϴ�ѡ���', //cpg1.3.0
  'cust_instr_1' => '����Դ����� ѡ��һ���ϴ��� �����ϴ�.', //cpg1.3.0
  'cust_instr_2' => 'ѡ���ϴ����', //cpg1.3.0
  'cust_instr_3' => '�ĵ��ϴ���: %s', //cpg1.3.0
  'cust_instr_4' => 'URI/URL �ϴ���: %s', //cpg1.3.0
  'cust_instr_5' => 'URI/URL �ϴ���:', //cpg1.3.0
  'cust_instr_6' => '�ĵ��ϴ���:', //cpg1.3.0
  'cust_instr_7' => '��������Ŀǰ��Ҫ�� ÿһ���ϴ��������. Ȼ�� \'����\'. ', //cpg1.3.0
  'reg_instr_1' => '��Ч��ѡ�����.', //cpg1.3.0
  'reg_instr_2' => '���� ����������µ��ϴ��� �ϴ�����ĵ�. ÿһ���ϴ��ĵ��Ĵ�С�����Գ��� %s KB . ZIP �ĵ��ϴ��� \'�ĵ��ϴ�\' and \'URI/URL �ϴ�\' �� .', //cpg1.3.0
  'reg_instr_3' => '�����Ҫ�ϴ�ѹ���ļ���Ҫ��ѹ��, ����ʹ���ĵ��ϴ��� \'��ѹ��ZIP �ϴ�\' ��.', //cpg1.3.0
  'reg_instr_4' => '���ѡ���� URI/URL �ϴ�, �������ĵ�����·�� ��: http://www.mysite.com/images/example.jpg', //cpg1.3.0
  'reg_instr_5' => '���ѡ����,�밴 \'����\'.', //cpg1.3.0
  'reg_instr_6' => '��ѹ��ZIP �ϴ�:', //cpg1.3.0
  'reg_instr_7' => '�ĵ� �ϴ�:', //cpg1.3.0
  'reg_instr_8' => 'URI/URL �ϴ�:', //cpg1.3.0
  'error_report' => '���󱨸�', //cpg1.3.0
  'error_instr' => '�����ϴ���������:', //cpg1.3.0
  'file_name_url' => '�ĵ� ����/URL', //cpg1.3.0
  'error_message' => '����ѶϢ', //cpg1.3.0
  'no_post' => '�ĵ�û�б��ϴ�.', //cpg1.3.0
  'forb_ext' => '���������չ��.', //cpg1.3.0
  'exc_php_ini' => '�ĵ�����php.ini����Ĵ�С.', //cpg1.3.0
  'exc_file_size' => '�ĵ�����CPG����Ĵ�С.', //cpg1.3.0
  'partial_upload' => 'ֻ�в����ϴ�.', //cpg1.3.0
  'no_upload' => 'û���ϴ�.', //cpg1.3.0
  'unknown_code' => 'δ֪�� PHP �ϴ�������.', //cpg1.3.0
  'no_temp_name' => 'û���ϴ� - ���ݴ浵��.', //cpg1.3.0
  'no_file_size' => 'û������', //cpg1.3.0
  'impossible' => '�޷�����.', //cpg1.3.0
  'not_image' => '�ⲻ�Ǳ�׼Ӱ���ļ�', //cpg1.3.0
  'not_GD' => '�ⲻ�� GD ��չ��.', //cpg1.3.0
  'pixel_allowance' => 'Ӱ��ߴ�̫����.', //cpg1.3.0
  'incorrect_prefix' => '����ȷ�� URI/URL ǰ׺', //cpg1.3.0
  'could_not_open_URI' => '�޷�����URI.', //cpg1.3.0
  'unsafe_URI' => '��ȫ��δ����֤.', //cpg1.3.0
  'meta_data_failure' => 'ת������ʧ��', //cpg1.3.0
  'http_401' => '401 δ����Ȩ���', //cpg1.3.0
  'http_402' => '402 �˴��踶�����', //cpg1.3.0
  'http_403' => '403 Ŀǰ�˴��رս�ֹ���', //cpg1.3.0
  'http_404' => '404 ������û�л�Ӧ', //cpg1.3.0
  'http_500' => '500 �ڲ�����������', //cpg1.3.0
  'http_503' => '503 �������ȴ����� ֹͣ����', //cpg1.3.0
  'MIME_extraction_failure' => 'MIME �޷����ⶨ.', //cpg1.3.0
  'MIME_type_unknown' => 'δ֪�� MIME type', //cpg1.3.0
  'cant_create_write' => '�޷�����д���ĵ�.', //cpg1.3.0
  'not_writable' => '�޷�д��.', //cpg1.3.0
  'cant_read_URI' => '�޷���ȡ URI/URL', //cpg1.3.0
  'cant_open_write_file' => '�޷�����URI .', //cpg1.3.0
  'cant_write_write_file' => '�޷�д��URI .', //cpg1.3.0
  'cant_unzip' => '�޷� unzip.', //cpg1.3.0
  'unknown' => 'δ֪�Ĵ���', //cpg1.3.0
  'succ' => '�ɹ��ϴ�', //cpg1.3.0
  'success' => '%s �ϴ��Ѿ��ɹ�.', //cpg1.3.0
  'add' => '�밴 \'����\' �����ĵ����ಾ.', //cpg1.3.0
  'failure' => '�ϴ�ʧ��', //cpg1.3.0
  'f_info' => '�ĵ���Ѷ', //cpg1.3.0
  'no_place' => '��ǰ���ĵ��޷�������.', //cpg1.3.0
  'yes_place' => '��ǰ���ĵ��Ѿ����óɹ�.', //cpg1.3.0
  'max_fsize' => '��������ĵ���С�� %s KB',
  'album' => '�ಾ',
  'picture' => 'ͼƬ', //cpg1.3.0
  'pic_title' => 'ͼƬ����', //cpg1.3.0
  'description' => 'ͼƬ����', //cpg1.3.0
  'keywords' => '�ؼ��� (�Կո�����)',
  'err_no_alb_uploadables' => 'Ŀǰ��δ���ಾ�����ϴ�ͼƬ', //cpg1.3.0
  'place_instr_1' => '���� �뽫ͼƬ�ŵ��ಾ.  �����ڿ�����������ĵ��������Ѷ.', //cpg1.3.0
  'place_instr_2' => '�����ͼƬ��Ҫ����. �밴 \'����\'.', //cpg1.3.0
  'process_complete' => '��ϲ  ���Ѿ���ȫ���ĳɹ��ĵ��ϴ���.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
  'title' => '��Ա����',
  'name_a' => '���� ��С����',
  'name_d' => '���� �ɴ���С',
  'group_a' => 'Ⱥ�� ��С����',
  'group_d' => 'Ⱥ�� �ɴ���С',
  'reg_a' => 'ע������ ��Զ����',
  'reg_d' => 'ע������ �ɽ���Զ',
  'pic_a' => 'ͼƬ�� ��С����',
  'pic_d' => 'ͼƬ�� �ɴ���С',
  'disku_a' => '������� ��С����',
  'disku_d' => '������� �ɴ���С',
  'lv_a' => '������� �ɽ���Զ', //cpg1.3.0
  'lv_d' => '������� ��Զ����', //cpg1.3.0
  'sort_by' => '��Ա������',
  'err_no_users' => '��Ա���ϱ��ǿյ� !',
  'err_edit_self' => '���޷��༭���ĸ�������, ������ \'�ҵĸ�������\' ���༭',
  'edit' => '�༭',
  'delete' => 'ɾ��',
  'name' => '��Ա����',
  'group' => 'Ⱥ��',
  'inactive' => 'δ����',
  'operations' => '����',
  'pictures' => 'ͼƬ', //cpg1.3.0
  'disk_space' => '�ŵ� ���� / �޶�',
  'registered_on' => 'ע����',
  'last_visit' => '�������', //cpg1.3.0
  'u_user_on_p_pages' => '%d ����Ա�� %d ҳ',
  'confirm_del' => 'ȷ��Ҫɾ�������Ա��? \\n���������ಾ��ͼƬ���ᱻɾ��.', //js-alert //cpg1.3.0
  'mail' => '�����ʼ�',
  'err_unknown_user' => '��ѡ��Ļ�Ա�������� !',
  'modify_user' => '�༭��Ա',
  'notes' => 'ע��',
  'note_list' => '<li>�������ı���������, �뽫 "����" λ���¿հ�',
  'password' => '����',
  'user_active' => '��Ա������',
  'user_group' => '��ԱȺ��',
  'user_email' => '��Ա�����ʼ�',
  'user_web_site' => '��Ա��ַ',
  'create_new_user' => '�����»�Ա',
  'user_location' => '��Ա����',
  'user_interests' => '��Ա��Ȥ',
  'user_occupation' => '��Աְҵ',
  'latest_upload' => '�����ϴ�', //cpg1.3.0
  'never' => '��δ��', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
  'title' => '����Ա���� (����ͼƬ��С)', //cpg1.3.0
  'what_it_does' => '����',
  'what_update_titles' => '���ĵ����Ƹ���ͼƬ����',
  'what_delete_title' => 'ɾ������',
  'what_rebuild' => '�ؽ���ͼ������ͼƬ��С',
  'what_delete_originals' => '���µ������ͼƬ�� ȡ��ԭ�е�ͼƬ',
  'file' => '�ĵ�',
  'title_set_to' => '������Ϊ',
  'submit_form' => 'ȷ��',
  'updated_succesfully' => '���� �Ѿ��ɹ�',
  'error_create' => '��������',
  'continue' => '����ִ��������Ӱ��',
  'main_success' => '�ĵ� %s ����Ϊ��ͼ',  //cpg1.3.0
  'error_rename' => '���� %s ����Ϊ %s', 
  'error_not_found' => '�Ҳ����ĵ� %s ',
  'back' => '����ҳ',
  'thumbs_wait' => '������ͼ ��/�� ����Ӱ��ߴ�, ���Ժ�...',
  'thumbs_continue_wait' => '���� ������ͼ ��/�� ����Ӱ��ߴ�...',
  'titles_wait' => '���±���, ���Ժ�...',
  'delete_wait' => 'ɾ������, ���Ժ�...',
  'replace_wait' => '���µ������ͼƬ�� ȡ��ԭ�е�ͼƬ��, ���Ժ�...',
  'instruction' => '���ײ���˵��',
  'instruction_action' => '��ѡ�����',
  'instruction_parameter' => '�趨����',
  'instruction_album' => 'ѡ���ಾ',
  'instruction_press' => '�밴 %s',
  'update' => '������ͼ ��/�� ����ͼƬ��С',
  'update_what' => 'Ҫ����ʲô',
  'update_thumb' => 'ֻ����ͼ',
  'update_pic' => 'ֻ����ͼƬ��С',
  'update_both' => '������ͼ�ҵ���ͼƬ�ߴ�',
  'update_number' => 'ÿ��ѡһ��Ҫ�����ͼƬ��Ŀ',
  'update_option' => '(�������������������ʱ������,�����Ž��ʹ��趨)',
  'filename_title' => '�ĵ����� &rArr; ͼƬ����', //cpg1.3.0
  'filename_how' => '����޸ĵ���', 
  'filename_remove' => 'ɾ�� .jpg ���� _ (����) �ÿո�ȡ��', 
  'filename_euro' => '�� 2003_11_23_13_20_20.jpg ��Ϊ 23/11/2003 13:20', 
  'filename_us' => '�� 2003_11_23_13_20_20.jpg ��Ϊ 11/23/2003 13:20', 
  'filename_time' => '�� 2003_11_23_13_20_20.jpg ��Ϊ 13:20', 
  'delete' => 'ɾ��ͼƬ�����ԭʼ�ߴ��ͼƬ', //cpg1.3.0
  'delete_title' => 'ɾ��ͼƬ����', //cpg1.3.0
  'delete_original' => 'ɾ��ԭʼ�ߴ��ͼƬ',
  'delete_replace' => 'ɾ��ԭʼ�ߴ��ͼƬ�K�Ե����ߴ��ͼƬȡ��',
  'select_album' => 'ѡ���ಾ',
  'delete_orphans' => 'ɾ����ɢ������(��ȫ�����ಾ)', //cpg1.3.0
  'orphan_comment' => '������ɢ������', //cpg1.3.0
  'delete' => 'ɾ��', //cpg1.3.0
  'delete_all' => 'ȫ��ɾ��', //cpg1.3.0
  'comment' => '����: ', //cpg1.3.0
  'nonexist' => 'Ҫ���ӵ��ĵ������� # ', //cpg1.3.0
  'phpinfo' => '��ʾphp��Ѷ', //cpg1.3.0
  'update_db' => '�������Ͽ�', //cpg1.3.0
  'update_db_explanation' => '������и��� coppermine �ĵ�, �����޸Ļ�����ǰ�İ汾����, ��ȷ��ִ��һ�����Ͽ����. �⽫����coppermine���Ͽ�������Ҫ�����ϱ� ��/�� �趨ֵ.', //cpg1.3.0
);

?>
