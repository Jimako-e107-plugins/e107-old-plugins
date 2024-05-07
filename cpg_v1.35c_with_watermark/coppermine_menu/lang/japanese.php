<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2005 Coppermine Dev Team
  v1.1 originaly written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.3.3
  $Source: /cvsroot/coppermine/stable/lang/japanese.php,v $
  $Revision: 1.10 $
  $Author: gaugau $
  $Date: 2005/06/13 06:11:36 $
**********************************************/

// info about translators and translated language
$lang_translation_info = array(
  'lang_name_english' => 'Japanese',
  'lang_name_native' => 'Japanese',
  'lang_country_code' => 'jp',
  'trans_name'=> 'Mitsuhiro Yoshida',
  'trans_email' => 'mits@mitstek.com',
  'trans_website' => 'http://mitstek.com/',
  'trans_date' => '2005-06-12',
);

$lang_charset = 'EUC-JP';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('�Х���', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('��', '��', '��', '��', '��', '��', '��');
$lang_month = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');

// Some common strings
$lang_yes = 'Yes';
$lang_no  = 'No';
$lang_back = '���';
$lang_continue = '³����';
$lang_info = '����';
$lang_error = '���顼';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%Yǯ%B��%d��';
$lastcom_date_fmt =  '%y/%m/%d/ %H:%M';
$lastup_date_fmt =   '%Yǯ%B��%d��';
$register_date_fmt = '%Yǯ%B��%d��';
$lasthit_date_fmt =  '%Yǯ%B��%d�� %I:%M %p';
$comment_date_fmt =  '%Yǯ%B��%d�� %I:%M %p';

// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array(
  'random' => '������ե�����',
  'lastup' => '����̿�',
  'lastalb'=> '�ǿ�����Х�',
  'lastcom' => '�ǿ�������',
  'topn' => '��¿����',
  'toprated' => '�ȥåץ졼��',
  'lasthits' => '�ǽ�����',
  'search' => '�������',
  'favpics'=> '����������'
);

$lang_errors = array(
  'access_denied' => '���Υڡ������Ф��륢��������������ޤ���',
  'perm_denied' => '��������Ԥ����¤�����ޤ���',
  'param_missing' => 'ɬ�פʥѥ�᡼��̵���ǥ�����ץȤ��¹Ԥ���ޤ�����',
  'non_exist_ap' => '���򤵤줿����Х��¸�ߤ��ޤ���!', 
  'quota_exceeded' => '�ǥ����������̥����С�<br /><br />���ʤ������ѤǤ���ǥ��������̤� [quota]K�Ǥ������� [space]K����Ѥ��Ƥ��ޤ������Υե�������ɲä���ȥǥ��������̤������С����ޤ���',
  'gd_file_type_err' => 'GD���᡼���饤�֥�꡼����Ѥ����硢JPEG��PNG�����Υե�����Τ߻��Ѳ�ǽ�Ǥ���',
  'invalid_image' => '���ʤ������åץ��ɤ�����������»��������GD�饤�֥�꡼�ǽ������뤳�Ȥ�����ޤ���',
  'resize_failed' => '���������������������ᡢ����ͥ�����������ޤ���',
  'no_img_to_display' => 'ɽ����������Ϥ���ޤ���',
  'non_exist_cat' => '���򤷤����ƥ����¸�ߤ��ޤ���',
  'orphan_cat' => '¸�ߤ��ʤ��ƥ��ƥ������äƤ��ޤ������ƥ���ޥ͡����㡼��Ȥä�������褷�Ƥ�������!',
  'directory_ro' => '�ǥ��쥯�ȥ� \'%s\' �˽���߸�������ޤ��󡣥ե�����κ���Ͻ���ޤ���',
  'non_exist_comment' => '���򤷤������Ȥ�¸�ߤ��ޤ���',
  'pic_in_invalid_album' => '¸�ߤ��ʤ�����Х�(%s)��˥ե����뤬����ޤ� !?',
  'banned' => '���ʤ��ϸ��ߤ��Υ����ȤؤΥ���������ػߤ���Ƥ��ޤ���',
  'not_with_udb' => '�ե�����ॽ�եȤ����礵�줿�١����ε�ǽ��Coppermine��̵���ˤ���Ƥ��ޤ����ե�����ॽ�եȤǴ��������١����ε�ǽ�˴ؤ�������ϡ������ǥ��ݡ��Ȥ���ޤ���',
  'offline_title' => '���ե饤��', 
  'offline_text' => '���ߥ����꡼�ϥ��ե饤��Ǥ� - �⤦�ä����Ԥ���������',
  'ecards_empty' => 'ɽ������e�����ɥ쥳���ɤ�����ޤ���e�����ɤ���ѲĤˤ��Ƥ��뤫������̤ǳ�ǧ���Ƥ�������!',
  'action_failed' => '���顼��ȯ�����ޤ�����Coppermine�Ͻ���������˽�λ����ޤ���Ǥ�����', 
  'no_zip' => 'ZIP�ե��������������饤�֥�꤬���ѽ���ޤ���Coppermine�����Ԥ�Ϣ���Ƥ���������', 
  'zip_type' => 'ZIP�ե�����򥢥åץ��ɤ��븢�¤�����ޤ���',
);

$lang_bbcode_help = 'bbcode������ˡ: <li>[b]<b>����</b>[/b]</li> <li>[i]<i>����</i>[/i]</li> <li>[url=http://yoursite.com/]Url Text[/url]</li> <li>[email]user@domain.com[/email]</li>';

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
  'alb_list_title' => '����Х�ꥹ�Ȥذ�ư',
  'alb_list_lnk' => '����Х�ꥹ��',
  'my_gal_title' => '�ѡ����ʥ륮���꡼�ذ�ư',
  'my_gal_lnk' => '�ޥ������꡼',
  'my_prof_lnk' => '�ޥ��ץ�ե�����',
  'adm_mode_title' => '�����ԥ⡼�ɤ��ѹ�',
  'adm_mode_lnk' => '�����ԥ⡼��',
  'usr_mode_title' => '�桼���⡼�ɤ��ѹ�',
  'usr_mode_lnk' => '�桼���⡼��',
  'upload_pic_title' => '����Х�˥ե�����򥢥åץ���', 
  'upload_pic_lnk' => '�ե�����Υ��åץ���',
  'register_title' => '��������Ȥκ���',
  'register_lnk' => '�桼����Ͽ',
  'login_lnk' => '������',
  'logout_lnk' => '��������',
  'lastup_lnk' => '�ǿ����åץ���',
  'lastcom_lnk' => '�ǿ�������',
  'topn_lnk' => '������¿',
  'toprated_lnk' => '�ȥåץ졼��',
  'search_lnk' => '����',
  'fav_lnk' => '����������',
  'memberlist_title' => '���С��ꥹ�Ȥ�ɽ��',
  'memberlist_lnk' => '���С��ꥹ��',
  'faq_title' => '�̿������꡼&quot;Coppermine&quot;�˴ؤ���褯������������', 
  'faq_lnk' => 'FAQ',
);

$lang_gallery_admin_menu = array(
  'upl_app_lnk' => '���åץ��ɾ�ǧ',
  'config_lnk' => '����',
  'albums_lnk' => '����Х�',
  'categories_lnk' => '���ƥ���',
  'users_lnk' => '�桼��',
  'groups_lnk' => '���롼��',
  'comments_lnk' => '�����ȤΥ�ӥ塼',
  'searchnew_lnk' => '�ե���������Ͽ',
  'util_lnk' => '�����ġ���',
  'ban_lnk' => '���������ػߥ桼��',
  'db_ecard_lnk' => 'e�����ɤ�ɽ��',
);

$lang_user_admin_menu = array(
  'albmgr_lnk' => '�ޥ�����Х�κ��� / ����',
  'modifyalb_lnk' => '�ޥ�����Х�ν���',
  'my_prof_lnk' => '�ޥ��ץ�ե�����',
);

$lang_cat_list = array(
  'category' => '���ƥ���',
  'albums' => '����Х�',
  'pictures' => '�ե�����',
);

$lang_album_list = array(
  'album_on_page' => '����Х�� %d / %d�ڡ�����'
);

$lang_thumb_view = array(
  'date' => 'DATE',
  //Sort by filename and title
  'name' => '�ե�����̾',
  'title' => '�����ȥ�',
  'sort_da' => '���դξ�����¤��ؤ�',
  'sort_dd' => '���դι߽���¤��ؤ�',
  'sort_na' => '�ե�����̾�ξ�����¤��ؤ�',
  'sort_nd' => '�ե�����̾�ι߽���¤��ؤ�',
  'sort_ta' => '�̿������ȥ�ξ�����¤��ؤ�',
  'sort_td' => '�̿������ȥ�ι߽���¤��ؤ�',
  'download_zip' => 'ZIP�ե�����Ȥ��ƥ�������ɤ���',
  'pic_on_page' => '�ե������ %d / %d�ڡ�����',
  'user_on_page' => '�桼���� %d / %d�ڡ�����'
);

$lang_img_nav_bar = array(
  'thumb_title' => '����ͥ���ڡ��������',
  'pic_info_title' => '�ե���������ɽ��/��ɽ��',
  'slideshow_title' => '���饤�ɥ��硼',
  'ecard_title' => '���μ̿���e�����ɤȤ�����������',
  'ecard_disabled' => 'e�����ɤ���������ޤ���',
  'ecard_disabled_msg' => 'e�����ɤ��������븢�¤�����ޤ���',
  'prev_title' => '����',
  'next_title' => '����',
  'pic_pos' => '�ե����� %s/%s',
);

$lang_rate_pic = array(
  'rate_this_pic' => '���Υե������ɾ������',
  'no_votes' => '(̤��ɼ)',
  'rating' => '(���ߤΥ졼�ƥ���: %s/5&nbsp;&nbsp;&nbsp;��ɼ�� %s��)',
  'rubbish' => '��',
  'poor' => '����',
  'fair' => '����',
  'good' => '�ɤ�',
  'excellent' => '�����餷��',
  'great' => '����',
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
  CRITICAL_ERROR => '��̿Ū�ʥ��顼',
  'file' => '�ե�����: ',
  'line' => '��: ',
);

$lang_display_thumbnails = array(
  'filename' => '�ե�����̾ : ',
  'filesize' => '�ե����륵���� : ',
  'dimensions' => '�礭�� : ',
  'date_added' => '��Ͽ�� : '
);

$lang_get_pic_data = array(
  'n_comments' => '�����ȿ� %s',
  'n_views' => '������� %s',
  'n_votes' => '(��ɼ�� %s)'
);

$lang_cpg_debug_output = array(
  'debug_info' => '�ǥХå�����',
  'select_all' => '���Ƥ�����',
  'copy_and_paste_instructions' => 'coppermine�Υ��ݡ��ȷǼ��Ĥ˥��ݡ��Ȥΰ������Ƥ�����ϡ����ΥǥХå�ɽ���򥳥ԡ�&�ڡ����Ȥ��Ƥ���������������˥ѥ���ɤ�***�˽񴹤��Ƥ���������',
  'phpinfo' => 'phpinfo��ɽ��',
);

$lang_language_selection = array(
  'reset_language' => '�ǥե���ȸ���',
  'choose_language' => '��������򤷤Ƥ�������',
);

$lang_theme_selection = array(
  'reset_theme' => '�ǥե���ȥơ���',
  'choose_theme' => '�ơ��ޤ����򤷤Ƥ�������',
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
  'Exclamation' => '�ӥå���',
  'Question' => '����',
  'Very Happy' => '�ȤƤ⹬��',
  'Smile' => '���ޥ���',
  'Sad' => '�ᤷ��',
  'Surprised' => '�ä�',
  'Shocked' => '����å�',
  'Confused' => '����',
  'Cool' => '������',
  'Laughing' => '�Ф�',
  'Mad' => '�ܤ�',
  'Razz' => '��Ф�',
  'Embarassed' => '�Ѥ�������',
  'Crying or Very sad' => '�㤯�ޤ��ϤȤƤ��ᤷ��',
  'Evil or Very Mad' => '�����ޤ��ϤȤƤ��ܤä�',
  'Twisted Evil' => '���ϰ���',
  'Rolling Eyes' => 'ž������',
  'Wink' => '������',
  'Idea' => '�����ǥ���',
  'Arrow' => '����',
  'Neutral' => '��Ω',
  'Mr. Green' => '�ߥ����������꡼��',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
  0 => '�����ԥ⡼�ɤ�λ�� ...',
  1 => '�����ԥ⡼�ɤ˰�ư�� ...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
  'alb_need_name' => '����Х�ˤϥ���Х�̾��ɬ�פǤ� !',
  'confirm_modifs' => '�����˹������Ƥ⵹�����Ǥ��� ?',
  'no_change' => '�����ѹ�����Ƥ��ޤ��� !',
  'new_album' => '����������Х�',
  'confirm_delete1' => '�����ˤ��Υ���Х�������Ƥ⵹�����Ǥ��� ?',
  'confirm_delete2' => '\n����Х�˴ޤޤ�����Ƥμ̿��ȥ����ȤϺ������ޤ� !',
  'select_first' => '�ǽ�˥���Х�����򤷤Ƥ���������',
  'alb_mrg' => '����Х����',
  'my_gallery' => '* �ޥ������꡼ *',
  'no_category' => '* ���ƥ���̵�� *',
  'delete' => '���',
  'new' => '��������',
  'apply_modifs' => '������Ŭ��',
  'select_category' => '���ƥ�������',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
  'miss_param' => '��%s�פ�����ɬ�פʥѥ�᡼�����Ϥ���Ƥ��ޤ��� !',
  'unknown_cat' => '���򤷤����ƥ���ϥǡ����١�����¸�ߤ��ޤ���',
  'usergal_cat_ro' => '�桼�������꡼�Υ��ƥ���Ϻ������ޤ��� !',
  'manage_cat' => '���ƥ���δ���',
  'confirm_delete' => '�����ˤ��Υ��ƥ���������Ƥ⵹�����Ǥ��� ?',
  'category' => '���ƥ���',
  'operations' => '���',
  'move_into' => '��ư��',
  'update_create' => '���ƥ���κ���/����',
  'parent_cat' => '�ƥ��ƥ���',
  'cat_title' => '���ƥ���̾',
  'cat_thumb' => '���ƥ��ꥵ��ͥ���',
  'cat_desc' => '���ƥ�������'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
  'title' => '����',
  'restore_cfg' => '���󥹥ȡ���ľ��ξ��֤��᤹',
  'save_cfg' => '�������������¸����',
  'notes' => 'Notes',
  'info' => '����',
  'upd_success' => 'Coppermine�����꤬��������ޤ�����',
  'restore_success' => 'Coppermine�ǥե���Ȥ�����˥ꥹ�ȥ�����ޤ�����',
  'name_a' => '�̿�̾�ξ���',
  'name_d' => '�̿�̾�ι߽�',
  'title_a' => '�����ȥ�ξ���',
  'title_d' => '�����ȥ�ι߽�',
  'date_a' => '���դξ���',
  'date_d' => '���դι߽�',
  'th_any' => '����ͥ���κ��祵����',
  'th_ht' => '�⤵',
  'th_wd' => '��',
  'label' => '��٥�',
  'item' => '����',
  'debug_everyone' => '����',
  'debug_admin' => '�����ԤΤ�',
        );

if (defined('CONFIG_PHP')) $lang_config_data = array(
  '��������',
  array('�����꡼̾', 'gallery_name', 0),
  array('�����꡼������', 'gallery_description', 0),
  array('�����ԤΥ᡼�륢�ɥ쥹', 'gallery_admin_email', 0),
  array('e�����ɤΡ֤�äȼ̿��򸫤�ץ�󥯤Υ������åȥ��ɥ쥹', 'ecards_more_pic_target', 0),
  array('�����꡼�򥪥ե饤��ˤ���', 'offline', 1), 
  array('e�����ɤ�Ͽ����', 'log_ecards', 1),
  array('�����������ZIP�ե�����Υ�������ɤ���Ĥ���', 'enable_zipdownload', 1),

  '���졢�ơ��� &amp; Charset����',
  array('����', 'lang', 5),
  array('�ơ���', 'theme', 6),
  array('����ꥹ�Ȥ�ɽ������', 'language_list', 1),
  array('�����ɽ������', 'language_flags', 8),
  array('���������&quot;�ꥻ�å�&quot;��ɽ������', 'language_reset', 1),
  array('�ơ��ޥꥹ�Ȥ�ɽ��', 'theme_list', 1),
  array('�ơ��������&quot;�ꥻ�å�&quot;��ɽ������', 'theme_reset', 1), 
  array('FAQ��ɽ������', 'display_faq', 1),
  array('bbcode�إ�פ�ɽ������', 'show_bbcode_help', 1),
  array('���󥳡���', 'charset', 4),

  '����Х�ꥹ��ɽ��',
  array('�ᥤ��ơ��֥���� (�ԥ�����ޤ���%)', 'main_table_width', 0),
  array('���ƥ��곬�ؤ�ɽ����', 'subcat_level', 0),
  array('����Х��ɽ����', 'albums_per_page', 0),
  array('����Х�ꥹ�Ȥ����', 'album_list_cols', 0),
  array('����ͥ���Υ����� (�ԥ�����)', 'alb_list_thumb_size', 0),
  array('�ᥤ��ڡ����Υ���ƥ��', 'main_page_layout', 0),
  array('���ƥ��������٥�Υ���ͥ����ɽ������','first_level',1),

  '����ͥ���ɽ��',
  array('����ͥ���ڡ��������', 'thumbcols', 0),
  array('����ͥ���ڡ����ιԿ�', 'thumbrows', 0),
  array('���֤κ���ɽ����', 'max_tabs', 10), 
  array('����ͥ���β��˥ե�����������ɽ������ (�̿�̾���ɲ�)', 'caption_in_thumbview', 1), 
  array('����ͥ���β��˱�������ɽ������', 'views_in_thumbview', 1), 
  array('����ͥ���β��˥����ȿ���ɽ������', 'display_comment_count', 1),
  array('����ͥ���β��˥��åץ��ɤ����ͤ�̾����ɽ������', 'display_uploader', 1),
  array('�ե�����Υǥե�����¤ӽ�', 'default_sort_order', 3),
  array('�֥ȥåץ졼�ȡץꥹ�Ȥ˥ե����뤬ɽ�������٤κǾ���ɼ��', 'min_votes_for_rating', 0),

  '����ɽ���ȥ���������',
  array('�̿�ɽ���Υơ��֥��� (�ԥ�����ޤ���%)', 'picture_table_width', 0),
  array('�̿������ǥե���Ȥ�ɽ������', 'display_pic_info', 1),
  array('��������λ��Ѷػ��Ѹ������', 'filter_bad_words', 1),
  array('��������Υ��ޥ��꡼���Ѥ���Ĥ���', 'enable_smilies', 1),
  array('1�Ĥμ̿����Ф���Ʊ��桼�����ʣ����Ϣ³���������ȵ��Ĥ��� (flood protection�������ߤˤ���)', 'disable_comment_flood_protect', 1),
  array('�̿������κ���Ĺ', 'max_img_desc_length', 0),
  array('1�줢����κ���ʸ���� (���: ���ܸ�ξ�硢�����Ȥκ���Ĺ��Ʊ��)', 'max_com_wlength', 0),
  array('�����Ȥκ���Կ�', 'max_com_lines', 0),
  array('�����Ȥκ���Ĺ (Ⱦ�Ѵ���)', 'max_com_size', 0),
  array('�ե���ॹ�ȥ�åפ�ɽ������', 'display_film_strip', 1),
  array('�ե���ॹ�ȥ�å���ι���ɽ����', 'max_film_strip_items', 0),
  array('��������ƻ��˴����Ԥ˥᡼�����Τ���', 'email_comment_notification', 1), 
  array('���饤�ɥ��硼�δֳ� (1/1000��ñ��)', 'slideshow_interval', 0), 

  'Files and thumbnails settings', //cpg1.3.0
  array('JPEG�ե�����Υ�����ƥ���', 'jpeg_qual', 0),
  array('����ͥ���κ������ޤ��Ϲ⤵ <a href="#notice2" class="clickable_option">**</a>', 'thumb_width', 0),
  array('���Ѥ�����ˡ ( �� �ޤ��� �⤵ �ޤ��� ����ͥ���κ��祵���� )<b>*</b>', 'thumb_use', 7),
  array('��ּ̿����������','make_intermediate',1),
  array('��ּ̿�/�ӥǥ��κ������ޤ��Ϲ⤵ <a href="#notice2" class="clickable_option">**</a>', 'picture_width', 0),
  array('���åץ��ɥե�����κ��祵���� (KB)', 'max_upl_size', 0),
  array('���åץ��ɼ̿�/�ӥǥ��κ������ޤ��Ϲ⤵ (�ԥ�����)', 'max_upl_width_height', 0),

  '�ե�����ȥ���ͥ�������ι��٤�����',
  array('�����󤷤Ƥ��ʤ��桼���˥ץ饤�١��ȥ���Хॢ�������ɽ������','show_private',1),
  array('�ե�����̾�λ��Ѷػ�ʸ��', 'forbiden_fname_char',0),
  //array('���åץ��ɤλ��Ѳ�ǽ��ĥ��', 'allowed_file_extensions',0),
  array('���Ѳ�ǽ���᡼��������', 'allowed_img_types',0),
  array('���Ѳ�ǽ�ࡼ�ӡ�������', 'allowed_mov_types',0),
  array('���Ѳ�ǽ�����ǥ���������', 'allowed_snd_types',0),
  array('���Ѳ�ǽ�ɥ�����ȥ�����', 'allowed_doc_types',0),
  array('���᡼���Υꥵ������ˡ','thumb_method',2),
  array('ImageMagick�Υѥ� (�� /usr/bin/X11/)', 'impath', 0),
  //array('���Ѳ�ǽ���᡼�������� (ImageMagick�Τ�)', 'allowed_img_types',0),
  array('ImageMagick�Υ��ޥ�ɥ饤�󥪥ץ����', 'im_options', 0),
  array('JPEG�ե������EXIF�ǡ������������', 'read_exif_data', 1),
  array('JPEG�ե������IPTC�ǡ������������', 'read_iptc_data', 1),
  array('����Х�ǥ��쥯�ȥ� <a href="#notice1" class="clickable_option">*</a>', 'fullpath', 0),
  array('�桼���ե�����ǥ��쥯�ȥ� <a href="#notice1" class="clickable_option">*</a>', 'userpics', 0),
  array('��ּ̿�����Ƭ�� <a href="#notice1" class="clickable_option">*</a>', 'normal_pfx', 0),
  array('����ͥ������Ƭ�� <a href="#notice1" class="clickable_option">*</a>', 'thumb_pfx', 0),
  array('�ǥ��쥯�ȥ�Υǥե���ȥѡ��ߥå����', 'default_dir_mode', 0),
  array('�ե�����Υǥե���ȥѡ��ߥå����', 'default_file_mode', 0),

  'User settings',
  array('�桼����Ͽ����Ĥ���', 'allow_user_registration', 1),
  array('�桼����Ͽ�˥᡼�뾵ǧ��ɬ�פȤ���', 'reg_requires_valid_email', 1),
  array('�����Ԥ˥桼����Ͽ��᡼�����Τ���', 'reg_notify_admin_email', 1),
  array('2�ͤΥ桼���ˤ��Ʊ��᡼�륢�ɥ쥹����Ͽ����Ĥ���', 'allow_duplicate_emails_addr', 1),
  array('�桼�����ץ饤�١��ȥ���Х����������', 'allow_private_albums', 1),
  array('�����Ԥ˥桼���Υ��åץ��ɾ�ǧ�Ԥ���᡼�����Τ���', 'upl_notify_admin_email', 1),
  array('������桼���˥��С��ꥹ�Ȥα�������Ĥ���', 'allow_memberlist', 1),

  '���������Τ���Υ�������ե������ (���Ѥ��ʤ����϶���)',
  array('�ե������̾ 1', 'user_field1_name', 0),
  array('�ե������̾ 2', 'user_field2_name', 0),
  array('�ե������̾ 3', 'user_field3_name', 0),
  array('�ե������̾ 4', 'user_field4_name', 0),

  '���å�������',
  array('������ץȤǻ��Ѥ��륯�å���̾ (����Ķ���BBS����Ѥ�����ϡ�bbs�Υ��å���̾�Ȱ㤦̾�Τ���Ѥ��Ƥ�������)', 'cookie_name', 0),
  array('������ץȤǻ��Ѥ��륯�å�������¸��', 'cookie_path', 0),

  '����¾������',
  array('�ǥХå��⡼�ɤ���Ѥ���', 'debug_mode', 9),
  array('�ǥХå��⡼�ɤǷٹ��ɽ������', 'debug_notice', 1),

        '<br /><div align="center">(*) ���˥����꡼�˼̿�����Ͽ����Ƥ�����ϡ�*�ޡ������դ��Ƥ���ե�����ɤ��ѹ����ʤ��Ǥ�������</div><br />
  <a name="notice2"></a>(**) ����������ѹ�������ϡ��ѹ�����ɲä����ե�����Τߤ��ƶ�������ޤ��������꡼��˥ե����뤬������ϡ�����������ѹ����ʤ����Ȥ򤪴��ᤷ�ޤ���������˥塼��&quot;<a href="util.php">�����ġ���</a>(�̿��Υꥵ����)&quot;����Ѥ��ơ���Ͽ�Ѥߥե�������ѹ���Ŭ�Ѥ��뤳�Ȥ����ޤ���</div><br />',
);

// ------------------------------------------------------------------------- //
// File db_ecard.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('DB_ECARD_PHP')) $lang_db_ecard_php = array(
  'title' => '�����Ѥ�e������',
  'ecard_sender' => '������',
  'ecard_recipient' => '�����',
  'ecard_date' => '��������',
  'ecard_display' => 'e�����ɤ�ɽ��',
  'ecard_name' => '̾��',
  'ecard_email' => '�᡼�륢�ɥ쥹',
  'ecard_ip' => 'IP #',
  'ecard_ascending' => '����',
  'ecard_descending' => '�߽�',
  'ecard_sorted' => '�¤��ؤ�:',
  'ecard_by_date' => '����',
  'ecard_by_sender_name' => '������̾',
  'ecard_by_sender_email' => '�����ԥ᡼�륢�ɥ쥹',
  'ecard_by_sender_ip' => '������IP���ɥ쥹',
  'ecard_by_recipient_name' => '�����̾',
  'ecard_by_recipient_email' => '����ͥ᡼�륢�ɥ쥹',
  'ecard_number' => 'ɽ���쥳���� %s - %s (%s ����)',
  'ecard_goto_page' => '�ڡ�����ư',
  'ecard_records_per_page' => '1�ڡ���������Υ쥳���ɿ�',
  'check_all' => '���Ƥ�����',
  'uncheck_all' => '���٤Ƥ�������� ',
  'ecards_delete_selected' => '���򤷤�e�����ɤ�������',
  'ecards_delete_confirm' => '�����˥쥳���ɤ������Ƥ⵹�����Ǥ���? �����å��ܥå���������å����Ƥ�������!',
  'ecards_delete_sure' => '�����ǧ',
);


// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
  'empty_name_or_com' => '��̾���ȥ����Ȥ����Ϥ��Ƥ���������',
  'com_added' => '���ʤ��Υ����Ȥ��ɲä���ޤ�����',
  'alb_need_title' => '����Х�̾�����Ϥ��Ƥ������� !',
  'no_udp_needed' => '������ɬ�פ���ޤ���',
  'alb_updated' => '����Хब��������ޤ�����',
  'unknown_album' => '���򤷤�����Хब¸�ߤ��ʤ����ޤ��Ϥ��Υ���Х�˥��åץ��ɤ��븢�¤�����ޤ���',
  'no_pic_uploaded' => '�ե�����ϥ��åץ��ɤ���ޤ���Ǥ��� !<br /><br />���åץ��ɤ���ե���������������򤷤Ƥ�����ϡ������Ф�</br>�ե�����Υ��åץ��ɤ���Ĥ��Ƥ��뤫��ǧ���Ƥ������� ...',
  'err_mkdir' => '�ǥ��쥯�ȥ� %s �κ����˼��Ԥ��ޤ��� !',
  'dest_dir_ro' => '�оݥǥ��쥯�ȥ� %s �ϥ�����ץȤˤ�����ߤ�����ޤ��� !',
  'err_move' => '%s �� %s �˰�ư�Ǥ��ޤ��� !',
  'err_fsize_too_large' => '���ʤ������åץ��ɤ����ե�����Υ��������礭�᤮�ޤ� (���祵������%sx%s�Ǥ�) !',
  'err_imgsize_too_large' => '���ʤ������åץ��ɤ����ե�����Υ��������礭�᤮�ޤ� (���祵������%sKB�Ǥ�) !',
  'err_invalid_img' => '���ʤ������åץ��ɤ����ե������ͭ���ʲ����ǤϤ���ޤ��� !',
  'allowed_img_types' => '%s �β����Τߥ��åץ��ɽ���ޤ���',
  'err_insert_pic' => '�ե������%s�פϥ���Х����Ͽ�Ǥ��ޤ��� ',
  'upload_success' => '���ʤ��Υե����������˥��åץ��ɤ���ޤ���<br /><br />�����Ԥξ�ǧ���ɽ������ޤ���',
  'notify_admin_email_subject' => '%s - Upload notification',
  'notify_admin_email_body' => '%s �ˤ�äƼ̿������åץ��ɤ���ޤ�����ǧ�ڤ�����ϡ����Υ�󥯤򥯥�å����Ƥ��������� %s',
  'info' => '����',
  'com_added' => '�����Ȥ��ɲä���ޤ�����',
  'alb_updated' => '����Хब��������ޤ�����',
  'err_comment_empty' => '�����Ȥ�����Ǥ� !',
  'err_invalid_fext' => '���γ�ĥ�ҤΥե�����Τ߻��ѤǤ��ޤ�: <br /><br />%s.',
  'no_flood' => '�������������ޤ��󡢤��ʤ��ϴ��ˤ��Υե�����˥����Ȥ���Ƥ��Ƥ��ޤ�<br /><br />�������������ϡ������Ȥ��Խ����Ƥ���������',
  'redirect_msg' => '������쥯�Ȥ���ޤ�����<br /><br /><br />�ڡ�������ưŪ�˹�������ʤ����ϡ���³���פ򥯥�å����Ƥ���������',
  'upl_success' => '���ʤ��Υե�������������Ͽ����ޤ�����',
  'email_comment_subject' => 'Comment posted on Coppermine Photo Gallery',
  'email_comment_body' => '�����꡼�˥����Ȥ���Ƥ���ޤ����������������������:',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
  'caption' => '����ץ����',
  'fs_pic' => '�ե륵��������',
  'del_success' => '�������',
  'ns_pic' => '�Ρ��ޥ륵��������',
  'err_del' => '����Բ�',
  'thumb_pic' => '����ͥ���',
  'comment' => '������',
  'im_in_alb' => '����Х���β���',
  'alb_del_success' => '����Х��%s�פ��������ޤ�����',
  'alb_mgr' => '����Х�ޥ͡����㡼',
  'err_invalid_data' => '��%s�פ������ʥǡ�����ȯ�����ޤ�����',
  'create_alb' => '����Х��%s�פκ�����',
  'update_alb' => '����Х��%s�� ����Х�̾��%s�� ����ǥå�����%s\�פ򹹿����Ƥ��ޤ���',
  'del_pic' => '�ե�����κ��',
  'del_alb' => '����Х�κ��',
  'del_user' => '�桼���κ��',
  'err_unknown_user' => '���򤷤��桼����¸�ߤ��Ƥ��ޤ��� !',
  'comment_deleted' => '�����Ȥ��������ޤ�����',
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
  'confirm_del' => '�����ˤ��Υե�����������Ƥ⵹�����Ǥ��� ? \\nƱ���˥����Ȥ�������ޤ���',
  'del_pic' => '���μ̿�����',
  'size' => '%s x %s �ԥ�����',
  'views' => '%s ��',
  'slideshow' => '���饤�ɥ��硼',
  'stop_slideshow' => '���饤�ɥ��硼�����',
  'view_fs' => '����å��ǥե륵�����β�����ɽ��',
  'edit_pic' => '�������Խ�',
  'crop_pic' => '����å׵ڤӲ�ž',
);

$lang_picinfo = array(
  'title' =>'�ե��������',
  'Filename' => '�ե�����̾',
  'Album name' => '����Х�̾',
  'Rating' => '�졼�ƥ��� (��ɼ�� %s��)',
  'Keywords' => '�������',
  'File Size' => '�ե����륵����',
  'Dimensions' => '�礭��',
  'Displayed' => 'ɽ��',
  'Camera' => '�����',
  'Date taken' => '������',
  'ISO'=>'ISO',
  'Aperture' => '���',
  'Exposure time' => 'Ϫ�л���',
  'Focal length' => '������Υ',
  'Comment' => '������',
  'addFav'=>'������������ɲ�',
  'addFavPhrase'=>'����������',
  'remFav'=>'���������꤫����',
  'iptcTitle'=>'IPTC�����ȥ�',
  'iptcCopyright'=>'IPTC���',
  'iptcKeywords'=>'IPTC�������',
  'iptcCategory'=>'IPTC���ƥ���',
  'iptcSubCategories'=>'IPTC���֥��ƥ���',
);

$lang_display_comments = array(
  'OK' => 'OK',
  'edit_title' => '���Υ����Ȥ��Խ�����',
  'confirm_delete' => '�����ˤ��Υ����Ȥ������Ƥ⵹�����Ǥ��� ?',
  'add_your_comment' => '�����Ȥ��ɲä���',
  'name'=>'̾��',
  'comment'=>'������',
  'your_name' => '��̾��',
);

$lang_fullsize_popup = array(
  'click_to_close' => '�����Υ���å��ǥ�����ɥ����Ĥ���',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
  'title' => 'e�����ɤ�����',
  'invalid_email' => '<b>�ٹ�</b> : �᡼�륢�ɥ쥹������������ޤ��� !',
  'ecard_title' => 'An e-card from %s for you',
  'error_not_image' => '�����ʳ���e�����ɤȤ�����������ޤ���',
  'view_ecard' => 'e�����ɤ������ɽ������ʤ����ϡ����Υ�󥯤򥯥�å����Ƥ���������',
  'view_more_pics' => '��äȼ̿��򸫤���ϡ����Υ�󥯤򥯥�å����Ƥ������� !',
  'send_success' => 'e�����ɤ���������ޤ�����',
  'send_failed' => '�������������ޤ���e�����ɤ���������ޤ���Ǥ��� ...',
  'from' => 'From',
  'your_name' => '��̾��',
  'your_email' => '�᡼�륢�ɥ쥹',
  'to' => 'To',
  'rcpt_name' => '����ͤΤ�̾��',
  'rcpt_email' => '����ͤΥ᡼�륢�ɥ쥹',
  'greetings' => '��������',
  'message' => '��å�����',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
  'pic_info' => '�ե��������',
  'album' => '����Х�',
  'title' => '�̿�̾',
  'desc' => '����',
  'keywords' => '�������',
  'pic_info_str' => '%s&times;%s - %sKB - ������� %s - ��ɼ�� %s',
  'approve' => '�ե�����ξ�ǧ',
  'postpone_app' => '��ǧ�α��',
  'del_pic' => '�ե�����κ��',
  'read_exif' => 'EXIF�������ټ�������',
  'reset_view_count' => '���������󥿤Υꥻ�å�',
  'reset_votes' => '��ɼ�Υꥻ�å�',
  'del_comm' => '�����Ȥκ��',
  'upl_approval' => '���åץ��ɾ�ǧ',
  'edit_pics' => '�ե�������Խ�',
  'see_next' => '����',
  'see_prev' => '����',
  'n_pic' => '�ե������ %s',
  'n_of_pic_to_disp' => '�ե�����ɽ����',
  'apply' => '������Ŭ��',
  'crop_title' => 'Coppermine�ԥ����㡼���ǥ���',
  'preview' => '�ץ�ӥ塼',
  'save' => '�̿�����¸',
  'save_thumb' =>'����ͥ���Ȥ�����¸',
  'sel_on_img' =>'����ϲ�����ǹԤäƤ�������!',
);

// ------------------------------------------------------------------------- //
// File faq.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FAQ_PHP')) $lang_faq_php = array(
  'faq' => '�褯������������ ',
  'toc' => '�ܼ�',
  'question' => '����: ',
  'answer' => '����: ', 
);

if (defined('FAQ_PHP')) $lang_faq_data = array(
  '����Ū��FAQ', //
  array('�ʤ��桼����Ͽ����ɬ�פ�����ޤ���?', '�桼����Ͽ�����ݤϴ����Ԥˤ�äƷ��ꤵ��ޤ����桼����Ͽ���뤳�Ȥǡ����С��ϥե�����Υ��åץ��ɡ�������������ɲá��̿���ɾ���������Ȥ�������ε�ǽ����Ѥ��뤳�Ȥ�����ޤ���', 'allow_user_registration', '0'),
  array('�桼����Ͽ��ˡ��?', '&quot;�桼����Ͽ&quot;�˥�����������ɬ�ܹ��ܥե�����ɤ�ɬ�׻�������Ϥ��Ƥ�������(ɬ�פǤ����Ǥ�չ��ܤ�)��<br />�����Ԥ��᡼�뾵ǧ�����ѲĤˤ��Ƥ�����ϸĿ;�������������塢��Ͽ�᡼�륢�ɥ쥹���˥�������Ȥγ������˴ؤ������������ܤ��줿�᡼�뤬��������ޤ��������󤹤�٤ˤϥ�������Ȥγ�������ԤäƤ���������', 'allow_user_registration', '1'),
  array('���������ˡ��?', '&quot;������&quot;���̤˥����������ƥ桼��̾�ȥѥ���ɤ����Ϥ��Ƥ���������&quot;�桼��̾���ѥ���ɤ򵭲�&quot;������å�����Ȱʸ弫ưŪ�˥����󤹤뤳�Ȥ�����ޤ��� <br /><b>����:���å��������ѲĤˤ��Ƥ���������&quot;�桼��̾���ѥ���ɤ򵭲�&quot;����Ѥ�����ϡ����Υ�����ȯ�ԤΥ��å����������ʤ��Ǥ���������</b>', 'offline', 0),
  array('�ʤ����������ʤ��ΤǤ���?', '�桼����Ͽ������������᡼��˵��ܤ���Ƥ�����󥯤򥯥�å����ޤ�����? ��󥯤򥯥�å����뤳�Ȥǥ�������Ȥ���������뤳�Ȥ�����ޤ���¾�Υ�����˴ؤ���ȥ�֥�ϴ����Ԥˤ���礻����������', 'offline', 0),
  array('�ѥ���ɤ�˺�줿��?', '���Υ����Ȥ�&quot;�ѥ���ɤ�˺��ޤ���&quot;��󥯤�������Ϥ��Ȥ���������������¾�ξ��ϥ����ȴ����Ԥ˿������ѥ���ɤ�ȯ�Ԥ���ꤷ�Ƥ���������', 'offline', 0),
  array('���ʻ��Ѥ��Ƥ���᡼�륢�ɥ쥹���ѹ�������?', '������塢&quot;�ޥ��ץ�ե�����&quot;���ѹ����Ƥ���������', 'offline', 0),
  array('&quot;����������&quot;�˼̿�����¸������ˡ��?', '�̿��򥯥�å������塢&quot;�̿�����&quot;���(<img src="images/info.gif" width="16" height="16" border="0" alt="Picture information" />)�򥯥�å����Ƥ����������̿�����β����ˤ���&quot;������������ɲ�&quot;�򥯥�å����Ƥ���������<br />�����Ԥˤ�&quot;�̿�����&quot;���ǥե���Ȥ�ɽ������Ƥ��ޤ���<br /><b>����:���å�������ѲĤˤ��ơ����Υ�����ȯ�ԤΥ��å����������ʤ��Ǥ���������', 'offline', 0),
  array('�̿���ɾ����ˡ��?', '�̿��Υ���ͥ���򥯥�å����ơ�������ɽ�������졼�ƥ��󥰤����򤷤Ƥ���������', 'offline', 0),
  array('�̿��ؤΥ����������ˡ��?', '�̿��Υ���ͥ���򥯥�å����ơ�������ɽ������륳���������Ƥ��Ƥ���������', 'offline', 0),
  array('�̿��Υ��åץ�����ˡ��?', '&quot;�ե�����Υ��åץ���&quot;�˥����������ơ��ե�����򥢥åץ��ɤ���������Х�����򤷤Ƥ���������&quot;����&quot;�򥯥�å������塢���åץ��ɤ������ե���������򤷤�&quot;����&quot;�򥯥�å����ޤ���(ɬ�פ˱����ƥ����ȥ롢����ʸ���ղä��Ƥ�������) �Ǹ��&quot;�ե�����Υ��åץ���&quot;�򥯥�å����Ƥ���������', 'allow_private_albums', 0),
  array('�ɤ��˼̿��򥢥åץ��ɤ�����ɤ��Ǥ���?', '&quot;�ޥ������꡼&quot;��Υ���Х�˼̿��򥢥åץ��ɤ��뤳�Ȥ�����ޤ��������Ԥ�����ˤ�ꡢ�ᥤ�󥮥��꡼��Υ���Х�˼̿��򥢥åץ��ɤ��뤳�Ȥ����ޤ���', 'allow_private_albums', 0),
  array('�ɤΤ褦�ʼ���ȥ������μ̿��򥢥åץ��ɽ���ޤ���?', '���åץ��ɽ���륵�����ȼ���(jpg,gif,��)�ϴ����Ԥˤ����ꤵ��ޤ���', 'offline', 0),
  array('&quot;�ޥ������꡼&quot;�Ȥ�?', '&quot;�ޥ������꡼&quot;�ϥ桼�����̿��򥢥åץ��ɵڤӴ������뤳�Ȥ������Ŀ��ѥ����꡼�Ǥ���', 'allow_private_albums', 0),
  array('&quot;�ޥ������꡼&quot;��Υ���Х��������͡��ࡦ�����ˡ��?', '�ޤ���&quot;�����ԥ⡼��&quot;�ˤ��Ƥ���������<br />&quot;����Х�&quot;�˥�����������&quot;��������&quot;�򥯥�å����Ƥ��������� &quot;����������Х�&quot;�򹥤���̾�Τ��ѹ����Ƥ���������<br />�����꡼������ƤΥ���Х��̾�Τ��ѹ����뤳�Ȥ�����ޤ���<br />&quot;������Ŭ��&quot;�򥯥�å����Ƥ���������', 'allow_private_albums', 0),
  array('�ޥ�����Х�ν����ڤӱ�����������ˡ��?', '�ޤ���&quot;�����ԥ⡼��&quot;�ˤ��Ƥ���������<br />&quot;����Х�ι���&quot;�С��ˤ���&quot;�ޥ�����Х�ν���&quot;�˥����������ơ���������������Х�����򤷤Ƥ���������<br />�����ǥ���Х�̾������������ͥ��롢�������¡�������/�졼�ƥ��󥰤Υѡ��ߥå������ѹ����뤳�Ȥ�����ޤ���<br />&quot;����Х�ι���&quot;�򥯥�å����Ƥ���������', 'allow_private_albums', 0),
  array('¾�Υ桼���Υ����꡼�����������ˡ��?', '&quot;����Х�ꥹ��&quot;�˥����������ơ�&quot;�桼�������꡼&quot;�����򤷤Ƥ���������', 'allow_private_albums', 0),
  array('���å����Ȥ�?', '���å����ϡ������֥����Ȥ��餢�ʤ��Υ���ԥ塼������¸�����ץ쥤��ƥ����ȤΥǡ����Ǥ���<br />�̾���å����ϥ桼���������Ȥ���ä��褿���ˡ����٥����󤷤ʤ��Ƥ�Ѥ�褦�����Ѥ���ޤ����ޤ���¾��¿����������äƤ��ޤ���', 'offline', 0),
  array('���Υץ�����������ˡ��?', 'Coppermine�ϡ�GNU GPL�ˤ���꡼�����줿�ե꡼�Υޥ����ǥ��������꡼�Ǥ���Coppermine�ϡ�¿��ǽ�ʥ����ƥ�Ǥ��ꡢ�͡��ʥץ�åȥե�����˰ܿ�����Ƥ��ޤ����ܺپ���α�������������ɤ�<a href="http://coppermine.sf.net/">Coppermine�ۡ���ڡ���</a>�˥����������ƹԤäƤ���������', 'offline', 0),

  '�����ȱ���',
  array('&quot;����Х�ꥹ��&quot;�Ȥ�?', '����Х�ꥹ�ȤǤϡ������꡼���Ƥ򤽤줾��Υ��ƥ���ؤΥ�󥯤ȶ���ɽ�����ޤ�������ͥ���ϡ����ƥ���إ�󥯤���Ƥ��ޤ���', 'offline', 0),
  array('&quot;�ޥ������꡼&quot;�Ȥ�?', '�ޥ������꡼�Ǥϡ��桼�������ȤΥ����꡼��������뤳�Ȥ�����ޤ����桼���ϡ��̿��Υ��åץ��ɤ�Ʊ�ͤˡ�����Х���ɲá������������Ԥ����Ȥ�����ޤ���', 'allow_private_albums', 0),
  array('&quot;�����ԥ⡼��&quot;��&quot;�桼���⡼��&quot;�ΰ㤤��?', '�����ԥ⡼�ɤǤϡ��桼������ʬ�Υ����꡼��(�����Ԥ����Ĥ��Ƥ������¾�οͤΥ����꡼��)�������뤳�Ȥ�����ޤ���', 'allow_private_albums', 0),
  array('&quot;�ե�����Υ��åץ���&quot;�Ȥ�?', '�桼���ϼ�ʬ�ޤ��ϴ����Ԥ����򤷤������꡼�˼̿��򥢥åץ��ɤ��뤳�Ȥ�����ޤ��� (�������ȼ���ϴ����Ԥˤ�����ꤵ��ޤ�)', 'allow_private_albums', 0),
  array('&quot;�ǿ����åץ���&quot;�Ȥ�?', '�ǿ����åץ��ɤǤϡ������Ȥ˥��åץ��ɤ��줿ľ��Υե����뤬ɽ������ޤ���', 'offline', 0),
  array('&quot;�ǿ�������&quot;�Ȥ�?', '�ǿ������ȤǤϡ��̿�����Ƥ��줿ľ��Υ����Ȥ�ɽ������ޤ���', 'offline', 0),
  array('&quot;������¿&quot;�Ȥ�?', '������¿�Ǥϡ��������̵ͭ�˷���餺���桼������Ǥ�������줿�̿���ɽ������ޤ���', 'offline', 0),
  array('&quot;�ȥåץ졼��&quot;�Ȥ�?', '�ȥåץ졼�ȤǤϡ��桼���ˤ��졼�ƥ��󥰤��줿�ȥåץ졼�Ȥμ̿�����ʿ�ѥ졼�ƥ��󥰤ȶ���ɽ������ޤ���(��: 5̾�Υ桼����<img src="images/rating3.gif" width="65" height="14" border="0" alt="" />�Υ졼�ƥ��󥰤�Ԥä���硢�̿���ʿ�ѥ졼�ƥ��󥰤�<img src="images/rating3.gif" width="65" height="14" border="0" alt="" />�Ȥʤ�ޤ���5̾�Υ桼����1����5�Υ졼�ƥ��󥰤�Ԥä����(1,2,3,4,5)��ʿ�ѥ졼�ƥ��󥰤�<img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> �ˤʤ�ޤ���)<br />�졼�ƥ��󥰤��ϰϤϡ�<img src="images/rating5.gif" width="65" height="14" border="0" alt="best" /> (�ǹ�) ���� <img src="images/rating0.gif" width="65" height="14" border="0" alt="worst" /> (����)�δ֤Ǥ���', 'offline', 0),
  array('&quot;����������&quot;�Ȥ�?', '����������Ǥϡ�����������μ̿�����򡢤��ʤ��Υ���ԥ塼���˥��å�������¸���ޤ���', 'offline', 0),
);


// ------------------------------------------------------------------------- //
// File forgot_passwd.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FORGOT_PASSWD_PHP')) $lang_forgot_passwd_php = array(
  'forgot_passwd' => '�ѥ���ɥ�ޥ����', 
  'err_already_logged_in' => '���˥����󤷤Ƥ��ޤ� !',
  'enter_username_email' => '�桼��̾�ޤ��ϥ᡼�륢�ɥ쥹�����Ϥ��Ƥ�������',
  'submit' => 'go',
  'failed_sending_email' => '�ѥ���ɥ�ޥ�����ˤ��᡼�����������ޤ���!',
  'email_sent' => '�桼��̾�ȥѥ���ɤ򵭺ܤ����᡼�뤬 %s ������������ޤ���',
  'err_unk_user' => '���򤷤��桼������Ͽ����Ƥ��ޤ���!',
  'passwd_reminder_subject' => '%s - Password reminder',
  'passwd_reminder_body' => '������ǡ��������ᤵ��ޤ���:
�桼��̾: %s
�ѥ����: %s
������Ϥ����� %s ',
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
  'group_name' => '���롼��̾',
  'disk_quota' => '�ǥ���������',
  'can_rate' => '�ե�����̿���ɾ����ǽ',
  'can_send_ecards' => 'e-�����ɤ�������ǽ',
  'can_post_com' => '�����Ȥ���Ʋ�ǽ',
  'can_upload' => '�ե�����򥢥åץ��ɲ�ǽ',
  'can_have_gallery' => '�ѡ����ʥ륮���꡼�������ǽ',
  'apply' => '������Ŭ��',
  'create_new_group' => '�������롼�פκ���',
  'del_groups' => '���򤷤����롼�פκ��',
  'confirm_del' => '�ٹ𡢥��롼�פ���������硢���롼�פ�°���Ƥ����桼����\'Registered\'���롼�פ˰�ư����ޤ� !\n\n������³���ޤ��� ?',
  'title' => '�桼�����롼�פδ���',
  'approval_1' => '�ѥ֥�å����åץ��ɾ�ǧ (1)',
  'approval_2' => '�ץ饤�١��ȥ��åץ��ɾ�ǧ (2)',
  'upload_form_config' => '���åץ��ɥե���������',
  'upload_form_config_values' => array( 'ñ��ե����륢�åץ��ɤΤ�', 'ʣ���ե����륢�åץ��ɤΤ�', 'URL���åץ��ɤΤ�', 'ZIP���åץ��ɤΤ�', '�ե�����-URL', '�ե�����-ZIP', 'URL-ZIP', '�ե�����-URL-ZIP'),
  'custom_user_upload'=>'�桼���ϥ��åץ��ɥܥå����ο����ѹ�����ޤ���?',
  'num_file_upload'=>'�ե����륢�åץ��ɥܥå����κ����',
  'num_URI_upload'=>'URL���åץ��ɥܥå����κ����',
  'note1' => '<b>(1)</b> �ѥ֥�å�����Х�إ��åץ��ɤ��줿�̿��ϴ����Ԥξ�ǧ��ɬ�פǤ���',
  'note2' => '<b>(2)</b> �桼���Υ���Х�إ��åץ��ɤ��줿�̿��ϴ����Ԥξ�ǧ��ɬ�פǤ���',
  'notes' => '���'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
  'welcome' => 'Welcome !',
);

$lang_album_admin_menu = array(
  'confirm_delete' => '�����ˤ��Υ���Х�������Ƥ⵹�����Ǥ��� ? \\nƱ�������Ƥμ̿��ȥ����ȤϺ������ޤ���',
  'delete' => '���',
  'modify' => '�ץ�ѥƥ�',
  'edit_pics' => '�ե�������Խ�',
);

$lang_list_categories = array(
  'home' => 'Home',
  'stat1' => '���ƥ����:<b>[cat]</b>&nbsp;&nbsp;&nbsp;����Х��:<b>[albums]</b>&nbsp;&nbsp;&nbsp;�̿����:<b>[pictures]</b>&nbsp;&nbsp;&nbsp;�����ȿ�:<b>[comments]</b>&nbsp;&nbsp;&nbsp;�������:<b>[views]</b>',
  'stat2' => '����Х��:<b>[albums]</b>&nbsp;&nbsp;&nbsp;�̿����:<b>[pictures]</b>&nbsp;&nbsp;&nbsp;�������:<b>[views]</b>',
  'xx_s_gallery' => '%s�Υ����꡼',
  'stat3' => '����Х��:<b>[albums]</b>&nbsp;&nbsp;&nbsp;�̿����:<b>[pictures]</b>&nbsp;&nbsp;&nbsp;�����ȿ�:<b>[comments]</b>&nbsp;&nbsp;&nbsp;�������:<b>[views]</b>'
);

$lang_list_users = array(
  'user_list' => '�桼���ꥹ��',
  'no_user_gal' => '�桼�������꡼�Ϥ���ޤ���',
  'n_albums' => '����Х�� %s',
  'n_pics' => '�ե������ %s'
);

$lang_list_albums = array(
  'n_pictures' => '�ե������ %s',
  'last_added' => '���ǽ��ɲ���:%s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
  'login' => '������',
  'enter_login_pswd' => '�桼��̾�ȥѥ���ɤ����Ϥ��Ƥ�������',
  'username' => '�桼��̾',
  'password' => '�ѥ����',
  'remember_me' => '�桼��̾���ѥ���ɤ򵭲�',
  'welcome' => '�褦���� %s����...',
  'err_login' => '*** ���������ޤ���Ǥ��������٥����󤷤Ƥ������� ***',
  'err_already_logged_in' => '���˥����󤷤Ƥ��ޤ� !',
  'forgot_password_link' => '�ѥ���ɤ�˺��ޤ���',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
  'logout' => '��������',
  'bye' => '%s���󡢤��褦�ʤ�...',
  'err_not_loged_in' => '�����󤷤Ƥ��ޤ��� !',
);

// ------------------------------------------------------------------------- //
// File phpinfo.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('PHPINFO_PHP')) $lang_phpinfo_php = array(
  'php_info' => 'PHP����',
  'explanation' => '�������Ƥ�PHP�ؿ�<a href="http://www.php.net/phpinfo">phpinfo()</a>�ˤ�ä��������졢Copermine���ɽ������Ƥ����ΤǤ��� (��¦��;���ȥ�ߥ󥰤��Ƥ��ޤ���)',
  'no_link' => '¾�οͤ�phpinfo�򸫤��뤳�Ȥǥ������ƥ���Υꥹ���������ޤ������Υڡ����ϴ����ԤȤ��ƥ����󤷤����Τ߱������뤳�Ȥ�����ޤ������Υڡ����ؤΥ�󥯤�¾�Υڡ�����ĥ�äƤ⡢�����ԤȤ��ƥ����󤷤ʤ��¤ꥢ�������ϵ��ݤ���ޤ���',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
  'upd_alb_n' => '����Х�ι��� %s',
  'general_settings' => '��������',
  'alb_title' => '����Х�̾',
  'alb_cat' => '���ƥ���',
  'alb_desc' => '����',
  'alb_thumb' => '����ͥ���',
  'alb_perm' => '���Υ���Х���Ф���ѡ��ߥå����',
  'can_view' => '����Х������ǽ',
  'can_upload' => '�ӥ������ϼ̿��򥢥åץ��ɽ����',
  'can_post_comments' => '�ӥ������ϥ����Ȥ���ƤǤ���',
  'can_rate' => '�ӥ������ϼ̿���ɾ�������',
  'user_gal' => '�桼�������꡼',
  'no_cat' => '* ���ƥ���̵�� *',
  'alb_empty' => '����Х�ˤϲ������äƤ��ޤ���',
  'last_uploaded' => '�ǿ����åץ���',
  'public_alb' => '���� (�ѥ֥�å�����Х�)',
  'me_only' => '��Τ�',
  'owner_only' => '����Х�ν�ͭ�� (%s) �Τ�',
  'groupp_only' => '%s���롼�ץ��С��Τ�',
  'err_no_alb_to_modify' => '�����Ǥ��륢��Хब�ǡ����١����ˤ���ޤ���',
  'update' => '����Х�ι���',
  'notice1' => '(*) %s���롼��%s ����ˤ��',
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
  'already_rated' => '�������������ޤ��󡢤��ʤ��ϴ��ˤ��Υե������ɾ�����Ƥ��ޤ���',
  'rate_ok' => '���ʤ�����ɼ�ϼ�������ޤ�����',
  'forbidden' => '��ʬ�μ̿���ɾ�����뤳�ȤϽ���ޤ���',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
{SITE_NAME}�δ����Ԥϡ�����Ū�˹��ޤ����ʤ���Ƥ��������®�䤫�˺������褦��ߤޤ��������Ƥ���Ƥ�������뤳�Ȥ��Բ�ǽ�Ǥ������äơ����Υ����Ȥ��Ф�������Ƥθ�����ƼԤˤ���ΤǤ��ꡢ�����Ԥ䥦���֥ޥ������Τ�Τ�̵��(�����ο͡�����ƤϽ���)�������Ԥ䥦���֥ޥ���������Ƥ���Ǥ��̵�����Ȥ򤢤ʤ���ǧ��ޤ���<br />
<br />
���ʤ��ϡ�������¯��ȿ������Ƥ䡢�Ŀͤؤ������������ơ���Ū����ơ�����¾ˡ��ȿ������Ƥ򤷤ʤ�����Ʊ�դ��ޤ������ʤ��ϡ�{SITE_NAME}�δ����ԡ������֥ޥ���������ǥ졼������ǡ���ʤ����������Ƥ��Խ���������븢����ͭ���뤳�Ȥ�Ʊ�դ��ޤ������ʤ��ϡ��桼���Ȥ��Ƥ��ʤ�����Ƥ������󤬥ǡ����١�������¸����뤳�Ȥ�Ʊ�դ��ޤ������ξ���ϡ����ʤ���Ʊ��̵���˴����ԡ������֥ޥ���������軰�Ԥ˳�������뤳�ȤϤ���ޤ��󤬡��ǡ�����ή�Ф��붲��Τ���ϥå������ι԰٤��Ф��ƴ����ԡ������֥ޥ���������Ǥ���餦���ȤϤ���ޤ���<br />
<br />
���Υ����ȤǤϡ����ʤ��Υ���ԥ塼���˾������¸���뤿��˥��å�������Ѥ��ޤ������å����Ϥ��ʤ��α������Ŭ�ˤ���٤����˻��Ѥ���ޤ����᡼�륢�ɥ쥹�ϡ����ʤ�����Ͽ�˴ؤ���ܺٵڤӥѥ���ɤ�ǧ�ڤΰ٤����˻��Ѥ���ޤ���<br />
<br />
��Ʊ�դ��ޤ��פ򥯥�å����뤳�Ȥǡ����ʤ��Ͼ嵭�����ѵ����Ʊ�դ��ޤ���
EOT;

$lang_register_php = array(
  'page_title' => '�桼����Ͽ',
  'term_cond' => '���ѵ���',
  'i_agree' => 'Ʊ�դ��ޤ�',
  'submit' => '��Ͽ�¹�',
  'err_user_exists' => '���Ϥ��줿�桼��̾�ϴ�����Ͽ����Ƥ��ޤ����̤Υ桼��̾�����Ϥ��Ƥ���������',
  'err_password_mismatch' => '�ѥ���ɤ����פ��ޤ��󡢺������Ϥ��Ƥ���������',
  'err_uname_short' => '�桼��̾��2ʸ���ʾ�ˤ��Ƥ���������',
  'err_password_short' => '�ѥ���ɤ�2ʸ���ʾ�ˤ��Ƥ���������',
  'err_uname_pass_diff' => '�桼��̾�ȥѥ���ɤϰۤʤ�ɬ�פ�����ޤ���',
  'err_invalid_email' => '�᡼�륢�ɥ쥹������������ޤ���',
  'err_duplicate_email' => '¾�Υ桼��������Ʊ���᡼�륢�ɥ쥹����Ͽ���Ƥ��ޤ���',
  'enter_info' => '��Ͽ��������Ϥ��Ƥ�������',
  'required_info' => 'ɬ�ܹ���',
  'optional_info' => 'Ǥ�չ���',
  'username' => '�桼��̾',
  'password' => '�ѥ����',
  'password_again' => '�ѥ���ɤ�⤦����',
  'email' => '�᡼�륢�ɥ쥹',
  'location' => '�ｻ��',
  'interests' => '��̣�Τ��뤳��',
  'website' => '�ۡ���ڡ���',
  'occupation' => '����',
  'error' => '���顼',
  'confirm_email_subject' => '%s - Registration confirmation',
  'information' => '����',
  'failed_sending_email' => '��Ͽ��ǧ�᡼�뤬�����Ǥ��ޤ��� !',
  'thank_you' => '����Ͽ���꤬�Ȥ��������ޤ���<br /><br />��������Ȥγ������˴ؤ��������Ͽ���줿�᡼�륢�ɥ쥹������������ޤ�����',
  'acct_created' => '���ʤ��Υ�������Ȥ���������ޤ������桼��̾�ȥѥ���ɤǥ��������ޤ���',
  'acct_active' => '���ʤ��Υ�������Ȥ�����������ޤ������桼��̾�ȥѥ���ɤǥ��������ޤ���',
  'acct_already_act' => '���ʤ��Υ�������Ȥϴ��˳���������Ƥ��ޤ� !',
  'acct_act_failed' => '���Υ�������Ȥϳ���������ޤ��� !',
  'err_unk_user' => '���򤷤��桼����¸�ߤ��ޤ��� !',
  'x_s_profile' => '%s �Υץ�ե�����',
  'group' => '���롼��',
  'reg_date' => '��Ͽǯ����',
  'disk_usage' => '�ǥ�����������',
  'change_pass' => '�ѥ���ɤ��ѹ�',
  'current_pass' => '���ߤΥѥ����',
  'new_pass' => '�������ѥ����',
  'new_pass_again' => '�������ѥ���ɤ�⤦����',
  'err_curr_pass' => '���ߤΥѥ���ɤ�����������ޤ���',
  'apply_modif' => '������Ŭ��',
  'change_pass' => '�ѥ���ɤ��ѹ�',
  'update_success' => '�ץ�ե����뤬��������ޤ�����',
  'pass_chg_success' => '�ѥ���ɤ��ѹ�����ޤ�����',
  'pass_chg_error' => '�ѥ���ɤ��ѹ�����ޤ���Ǥ�����',
  'notify_admin_email_subject' => '%s - Registration notification',
  'notify_admin_email_body' => '�����꡼�˥桼��̾ "%s" �ο������桼������Ͽ����ޤ���',
);

$lang_register_confirm_email = <<<EOT
{SITE_NAME} �ؤΤ���Ͽ���꤬�Ȥ��������ޤ���

���ʤ��Υ桼��̾�� "{USER_NAME}" �Ǥ���
���ʤ��Υѥ���ɤ� "{PASSWORD}" �Ǥ���

��������Ȥγ������򤹤�ˤϲ����Υ�󥯤򥯥�å��ޤ���
�֥饦���Υ��ɥ쥹��˥��ԡ����Ƥ���������

{ACT_LINK}

{SITE_NAME} ������

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
  'title' => '�����ȤΥ�ӥ塼',
  'no_comment' => '��ӥ塼���륳���ȤϤ���ޤ���',
  'n_comm_del' => '%s��Υ����Ȥ��������ޤ�����',
  'n_comm_disp' => 'ɽ�����륳���ȿ�',
  'see_prev' => '����',
  'see_next' => '����',
  'del_comm' => '���򤷤������Ȥ���',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
  0 => '�̿��θ���',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
  'page_title' => '�������ե�����θ���',
  'select_dir' => '�ǥ��쥯�ȥ�����',
  'select_dir_msg' => '�����Ǥ�FTP�ˤ�ꥵ���Ф˥��åץ��ɤ����ե�����򥢥�Х�˰����Ͽ���ޤ���<br /><br />�ե�����򥢥åץ��ɤ����ǥ��쥯�ȥ�����򤷤Ƥ���������',
  'no_pic_to_add' => '�ɲä���ե�����Ϥ���ޤ���',
  'need_one_album' => '���ε�ǽ��Ȥ�����ˤ�1�İʾ�Υ���Хबɬ�פǤ���',
  'warning' => '�ٹ�',
  'change_perm' => '������ץȤ����Υǥ��쥯�ȥ�˽����ޤ���Ǥ������ե�������ɲä������˥ǥ��쥯�ȥ�Υѡ��ߥå����⡼�ɤ�755����777���ѹ�����ɬ�פ�����ޤ� !',
  'target_album' => '<b>��</b>%s<b>����Υե������</b>%s<b>���ɲä���</b>',
  'folder' => '�ե����',
  'image' => '����',
  'album' => '����Х�',
  'result' => '���',
  'dir_ro' => '����߸�������ޤ���',
  'dir_cant_read' => '�ɼ�긢������ޤ���',
  'insert' => '�����ե�����Υ����꡼�ؤ��ɲ�',
  'list_new_pic' => '�����ե��������',
  'insert_selected' => '���򤷤��ե�������ɲ�',
  'no_pic_found' => '�������ե�����ϸ��Ĥ���ޤ���Ǥ�����',
  'be_patient' => '�ä����Ԥ�����������',
  'no_album' => '����Хब���򤵤�Ƥ��ޤ���',
  'notes' =>  '<ul>'.
                         '<li><b>OK</b> : ����˥ե����뤬�ɲä���ޤ�����'.
                         '<li><b>DP</b> : �ե����뤬��ʣ���ƴ��˥ǡ����١�������Ͽ����Ƥ��ޤ���'.
                         '<li><b>PB</b> : �ե�������ɲý���ޤ���Ǥ���������ڤӥե����뤬��Ͽ�����ǥ��쥯�ȥ�Υѡ��ߥå������ǧ���Ƥ���������'.
                         '<li><b>NA</b> : �ե�������ɲä��륢��Хब���򤵤�Ƥ��ޤ���\'<a href="javascript:history.back(1)">���</a>\'�򥯥�å����ƥ���Х�����򤷤Ƥ�������������Х��������Ƥ��ʤ����ϡ�<a href="albmgr.php">�ǽ�˺������Ƥ���������</a></li>'.
                          '<li>OK��DP��PB������Τ������ɽ������ʤ��ä����ϡ�PHP���顼��ɽ�����뤿�����»�����̿��򥯥�å����Ƥ���������'.
                         '<li>�����ॢ���Ȥ�ȯ��������硢�֥饦���ι����ܥ���򥯥�å����Ƥ���������'.
                         '</ul>',
  'select_album' => '����Х�����򤷤Ƥ�������',
  'check_all' => '���Ƥ�����',
  'uncheck_all' => '���Ƥ�������',
);


// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //

// Void

// ------------------------------------------------------------------------- //
// File banning.php
// ------------------------------------------------------------------------- //

if (defined('BANNING_PHP')) $lang_banning_php = array(
  'title' => '���������ػߥ桼��',
  'user_name' => '�桼��̾',
  'ip_address' => 'IP���ɥ쥹',
  'expiry' => '�ػ߽�λ (����ϱʵ�)',
  'edit_ban' => '�ѹ�����¸',
  'delete_ban' => '���',
  'add_new' => '�������ػߥ桼�����ɲ�',
  'add_ban' => '�ɲ�',
  'error_user' => '�桼�������Ĥ���ޤ���',
  'error_specify' => '�桼��̾����IP���ɥ쥹�����ꤷ�Ƥ�������',
  'error_ban_id' => '���������ػ�ID���㤤�ޤ�!',
  'error_admin_ban' => '��ʬ���Ȥ򥢥������ػߤ˽���ޤ���!',
  'error_server_ban' => '��ʬ���ȤΥ����Ф򥢥������ػߤˤ��ޤ���? ����Ͻ���ޤ���...',
  'error_ip_forbidden' => '����IP���ɥ쥹�򥢥������ػߤ˽���ޤ��� - �롼�ƥ��󥰽���ʤ�IP���ɥ쥹�Ǥ�!',
  'lookup_ip' => 'IP���ɥ쥹�Υ�å����å�',
  'submit' => 'go!',
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
  'title' => '�ե�����Υ��åץ���',
  'custom_title' => '�������ޥ������ꥯ�����ȥե�����',
  'cust_instr_1' => '���åץ��ɥܥå����������򤹤뤳�Ȥ�����ޤ��������������Ͱʾ�����򤹤뤳�ȤϽ���ޤ���',
  'cust_instr_2' => '�ܥå������ꥯ������',
  'cust_instr_3' => '�ե����륢�åץ��ɥܥå���: %s',
  'cust_instr_4' => 'URI/URL ���åץ��ɥܥå���: %s',
  'cust_instr_5' => 'URI/URL ���åץ��ɥܥå���:',
  'cust_instr_6' => '�ե����륢�åץ��ɥܥå���:',
  'cust_instr_7' => '�������������줾��μ���Υ��åץ��ɥܥå����������Ϥ��Ƥ������������θ��³���פ򥯥�å����Ƥ��������� ',
  'reg_instr_1' => '�ե�����κ����˴ְ㤤������ޤ���',
  'reg_instr_2' => '�����Υ��åץ��ɥܥå�������Ѥ��ƥե�����򥢥åץ��ɤ��뤳�Ȥ�����ޤ��������Ф˥��åץ��ɤ���ե�����Υ������ϡ�%s KB��Ķ���ʤ��褦�ˤ��Ƥ���������ZIP�ե�����ϡ֥ե�����Υ��åץ��ɡ׵ڤӡ�URI/URL�Υ��åץ��ɡץ���������갵�̤��줿�ޤޥ��åץ��ɤ���ޤ���',
  'reg_instr_3' => 'ZIP���̤��줿�ե��������ϰ��̤��줿���������֤�Ÿ�����������ϡ�ZIP�ե������Ÿ�����åץ��ɡפ���Ѥ��Ƥ���������',
  'reg_instr_4' => 'URI/URL���åץ��ɥ�����������Ѥ���Ȥ��ϡ�http://www.mysite.com/images/example.jpg �Τ褦�˥ե�����Υѥ������Ϥ��Ƥ���������',
  'reg_instr_5' => '�ե���������ϴ�λ�塢��³���פ򥯥�å����Ƥ���������',
  'reg_instr_6' => 'ZIP�ե������Ÿ�����åץ���:',
  'reg_instr_7' => '�ե�����Υ��åץ���:',
  'reg_instr_8' => 'URI/URL���åץ���:',
  'error_report' => '���顼��ݡ���',
  'error_instr' => '���Υ��åץ��ɥե�����˥��顼��ȯ�����ޤ���:',
  'file_name_url' => '�ե�����̾/URL',
  'error_message' => '���顼��å�����',
  'no_post' => '�ե��������ƤϤ���ޤ���',
  'forb_ext' => '���Ĥ���Ƥ��ʤ��ե������ĥ�ҤǤ���',
  'exc_php_ini' => 'php.ini�ǵ��Ĥ���Ƥ���ե����륵������Ķ���ޤ�����',
  'exc_file_size' => 'CPG�ǵ��Ĥ��줿�ե����륵������Ķ���ޤ�����', 
  'partial_upload' => '�����Τߥ��åץ��ɤ���ޤ�����',
  'no_upload' => '���åץ��ɤ���ޤ���Ǥ�����',
  'unknown_code' => '������PHP���åץ��ɥ��顼�����ɤǤ���',
  'no_temp_name' => '���åץ��ɤ���ޤ���Ǥ��� - �ƥ�ݥ��̾�Τ�����ޤ���',
  'no_file_size' => '�ǡ���������ޤ���',
  'impossible' => '��ư�Ǥ��ޤ���',
  'not_image' => '���᡼��������ޤ���',
  'not_GD' => 'GD extension�ǤϤ���ޤ���',
  'pixel_allowance' => '���Ĥ��줿�ԥ�������ϰϤ�Ķ���ޤ�����',
  'incorrect_prefix' => '�ְ�ä�URI/URL��Ƭ���Ǥ���',
  'could_not_open_URI' => 'URI�򥪡��ץ����ޤ���',
  'unsafe_URI' => '�����������ڽ���ޤ���',
  'meta_data_failure' => '�᥿�ǡ������顼',
  'http_401' => '401 Unauthorized',
  'http_402' => '402 Payment Required',
  'http_403' => '403 Forbidden',
  'http_404' => '404 Not Found',
  'http_500' => '500 Internal Server Error',
  'http_503' => '503 Service Unavailable',
  'MIME_extraction_failure' => 'MIME�����פ�������ޤ���',
  'MIME_type_unknown' => '������MIME�����פǤ���',
  'cant_create_write' => '����ߥե�������������ޤ���',
  'not_writable' => '����ߥե�����˽񤭹���ޤ���',
  'cant_read_URI' => 'URI/URL���ɤ߹���ޤ���',
  'cant_open_write_file' => 'URI����ߥե�����򥪡��ץ����ޤ���',
  'cant_write_write_file' => 'URI����ߥե�����˽񤭹���ޤ���',
  'cant_unzip' => 'ZIP�ե������Ÿ��������ޤ���',
  'unknown' => '�����ʥ��顼',
  'succ' => '���åץ��ɴ�λ',
  'success' => '%s �Υե����륢�åץ��ɤ�����˴�λ���ޤ�����',
  'add' => '����Х�˥ե�������ɲä�����ϡ���³���פ򥯥�å����Ƥ���������',
  'failure' => '���åץ��ɥ��顼',
  'f_info' => '�ե��������',
  'no_place' => '�ե�����ϥ��åץ��ɤ���ޤ���Ǥ�����',
  'yes_place' => '�ե����뤬����˥��åץ��ɤ���ޤ�����',
  'max_fsize' => '���åץ��ɲ�ǽ�ʺ���ե����륵������ %sKB �Ǥ���',
  'album' => '����Х�',
  'picture' => '�ե�����',
  'pic_title' => '�ե�����̾',
  'description' => '�ե����������',
  'keywords' => '������� (Ⱦ�ѥ��ڡ����Ƕ��ڤ�)',
  'err_no_alb_uploadables' => '�ե�����Υ��åץ��ɤ����Ĥ��줿����Х�Ϥ���ޤ���',
  'place_instr_1' => '����Х�˥ե�����򥢥åץ��ɤ��Ƥ����������ƥե�����˴�Ϣ��������Ϥ��뤳�Ȥ����ޤ���',
  'place_instr_2' => '���˥ե�����򥢥åץ��ɤ���ɬ�פ�����ޤ�����³���פ򥯥�å����Ƥ���������',
  'process_complete' => '���ƤΥե����뤬����˥��åץ��ɤ���ޤ�����',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
  'title' => '�桼���δ���',
  'name_a' => '�桼��̾�ξ���',
  'name_d' => '�桼��̾�ι߽�',
  'group_a' => '���롼��̾�ξ���',
  'group_d' => '���롼��̾�ι߽�',
  'reg_a' => '��Ͽ���ξ���',
  'reg_d' => '��Ͽ���ι߽�',
  'pic_a' => '�̿�����ξ���',
  'pic_d' => '�̿�����ι߽�',
  'disku_a' => '�ǥ����������̤ξ���',
  'disku_d' => '�ǥ����������̤ι߽�',
  'lv_a' => '�ǽ����������ξ���',
  'lv_d' => '�ǽ����������ι߽�',
  'sort_by' => '�桼�����¤��ؤ�',
  'err_no_users' => '�桼���ơ��֥뤬���Ǥ� !',
  'err_edit_self' => '��ʬ���ȤΥץ�ե�������Խ��Ǥ��ޤ��󡣡֥ޥ��ץ�ե�����פ���Ѥ��Ƥ���������',
  'edit' => '�Խ�',
  'delete' => '���',
  'name' => '�桼��̾',
  'group' => '���롼��',
  'inactive' => '�����',
  'operations' => '���',
  'pictures' => '�ե�����',
  'disk_space' => '���ѺѤ����� / ����',
  'registered_on' => '��Ͽǯ����',
  'last_visit' => '�ǽ���������',
  'u_user_on_p_pages' => '�桼���� %d / %d�ڡ�����',
  'confirm_del' => '�����ˤ��Υ桼���������Ƥ⵹�����Ǥ��� ? \\�桼����°�������ƤΥե�����ȥ���Х�Ϻ������ޤ���',
  'mail' => '�᡼��',
  'err_unknown_user' => '���򤷤��桼����¸�ߤ��ޤ��� !',
  'modify_user' => '�桼�����ѹ�',
  'notes' => '���',
  'note_list' => '<li>���ߤΥѥ���ɤ��ѹ��������ʤ����ϡ��֥ѥ���ɡץե�����ɤ����ˤ��Ƥ���������',
  'password' => '�ѥ����',
  'user_active' => '�桼�������������',
  'user_group' => '���롼��',
  'user_email' => '�᡼�륢�ɥ쥹',
  'user_web_site' => '�ۡ���ڡ���',
  'create_new_user' => '�����桼���κ���',
  'user_location' => '�ｻ��',
  'user_interests' => '��̣�Τ��뤳��',
  'user_occupation' => '����',
  'latest_upload' => '�ǿ����åץ���',
  'never' => '̵��',
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
  'title' => '�����ġ��� (�̿��Υꥵ����)',
  'what_it_does' => '��������',
  'what_update_titles' => '�����ȥ��ե�����̾�ǹ�������',
  'what_delete_title' => '�����ȥ�κ��',
  'what_rebuild' => '����ͥ���κƹ��۵ڤӼ̿��Υꥵ����',
  'what_delete_originals' => '���ꥸ�ʥ륵�����β����������ơ��������ѹ���β����������ؤ���',
  'file' => '�ե�����',
  'title_set_to' => '�����ȥ�����',
  'submit_form' => '����',
  'updated_succesfully' => '������λ',
  'error_create' => '������˥��顼��ȯ�����ޤ���',
  'continue' => '����˲������������',
  'main_success' => '�ե����� %s ���ᥤ��ե���������ꤵ��ޤ���',
  'error_rename' => '%s �� %s �˥�͡�����˥��顼��ȯ�����ޤ���',
  'error_not_found' => '�ե����� %s �����Ĥ���ޤ���Ǥ���',
  'back' => '�ᥤ������',
  'thumbs_wait' => '����ͥ���ι��� �ڤ�/���� �̿��Υꥵ������ԤäƤ��ޤ������Ԥ���������...',
  'thumbs_continue_wait' => '����ͥ���ι��� �ڤ�/���� �̿��Υꥵ������ԤäƤ��ޤ�...',
  'titles_wait' => '�����ȥ�ι�����ԤäƤ��ޤ������Ԥ���������...',
  'delete_wait' => '�����ȥ�������Ƥ��ޤ������Ԥ���������...',
  'replace_wait' => '���ꥸ�ʥ륵�����β������������ѹ���β����������ؤ���ԤäƤ��ޤ������Ԥ���������..',
  'instruction' => '�����å����󥹥ȥ饯�����',
  'instruction_action' => '��������������',
  'instruction_parameter' => '�ѥ�᡼��������',
  'instruction_album' => '����Х������',
  'instruction_press' => '%s �򲡤�',
  'update' => '����ͥ���ι��� �ڤ�/���� �̿��Υꥵ����',
  'update_what' => '�����о�',
  'update_thumb' => '����ͥ���κ����Τ�',
  'update_pic' => '�̿��Υꥵ�����Τ�',
  'update_both' => '����ͥ���κ����ڤӼ̿��Υꥵ����',
  'update_number' => '����å�������β���������',
  'update_option' => '(�����ॢ���Ȥ�����ϡ����ο��ͤ��������ꤷ�Ƥ�������)',
  'filename_title' => '�ե�����̾ &rArr; �ե����륿���ȥ�',
  'filename_how' => '�ե�����̾���ѹ���ˡ',
  'filename_remove' => '.jpg������դ��� _ (�������������)���ѹ�����',
  'filename_euro' => '2003_11_23_13_20_20.jpg �� 23/11/2003 13:20 ���ѹ�����',
  'filename_us' => '2003_11_23_13_20_20.jpg �� 11/23/2003 13:20 ���ѹ�����',
  'filename_time' => '2003_11_23_13_20_20.jpg �� 13:20 ���ѹ�����',
  'delete' => '�ե����륿���ȥ����ϥ��ꥸ�ʥ륵�����μ̿���������',
  'delete_title' => '�ե����륿���ȥ��������',
  'delete_original' => '���ꥸ�ʥ륵�����μ̿���������',
  'delete_replace' => '���ꥸ�ʥ륵�����β����������ơ��������ѹ���β����������ؤ���',
  'select_album' => '����Х������',
  'delete_orphans' => '�»ҥ����Ȥκ�� (������Х��о�)',
  'orphan_comment' => '����»ҥ����Ȥ����Ĥ���ޤ���',
  'delete' => '���',
  'delete_all' => '���Ƥ�������',
  'comment' => '������: ',
  'nonexist' => '¸�ߤ��ʤ��ե����� # �˳�����Ƥ��Ƥ��ޤ�',
  'phpinfo' => 'php�����ɽ��',
  'update_db' => '�ǡ����١����ι���',
  'update_db_explanation' => 'coppermine�������ؤ����������ɲá������ΥС�������ꥢ�åץ��졼�ɤ�Ԥä����ϡ��ǡ����١����ι�����ɬ��1�ټ¹Ԥ��Ƥ����������ǡ����١����ι����Ǥ�ɬ�פʥơ��֥���ɲõڤ�coppermine�ǡ����١����������Ԥ��ޤ���',
);

?>