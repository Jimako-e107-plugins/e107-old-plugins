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
'lang_name_english' => 'Korean',  //the name of your language in English, e.g. 'Greek' or 'Spanish'
'lang_name_native' => '�ѱ���', //the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol'
'lang_country_code' => 'kr', //the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
'trans_name'=> 'mle21', //the name of the translator - can be a nickname
'trans_email' => 'mle21@netian.com', //translator's email address (optional)
'trans_website' => '', //translator's website (optional)
'trans_date' => '2003-10-09', //the date the translation was created / last modified
);

$lang_charset = 'euc-kr';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
$lang_month = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');

// Some common strings
$lang_yes = '��';
$lang_no  = '�ƴϿ�';
$lang_back = '�ڷ�';
$lang_continue = '����';
$lang_info = '�ȳ�';
$lang_error = '����';

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
	'random' => '���䴺�� ������',
        'lastup' => '�ֱ� �̹���',
        'lastalb'=> '�ֱ� ������ �ٹ�', //new in cpg1.2.0
        'lastcom' => '�ֱ� �ڸ�Ʈ',
        'topn' => '�ִ� ��ȸ',
        'toprated' => '�ְ� ����',
        'lasthits' => '������ ��ȸ',
        'search' => '�˻� ���', //new in cpg1.2.0
        'favpics'=> '��ȣ ����' //new in cpg1.2.0
);

$lang_errors = array(
        'access_denied' => 'ȸ������ �������� �������� ���� �� �����ϴ�. �����ڿ��� �����ϼ���.',
        'perm_denied' => 'ȸ������ �������� ������ �� ���� ����Դϴ�.',
        'param_missing' => '�ʼ��׸��� Ȯ���ϼ���.',
        'non_exist_ap' => '������ �ٹ��̳� �̹����� �������� �ʽ��ϴ� !',
        'quota_exceeded' => '�Ҵ�뷮 �ʰ�,<br /><br />�Ҵ�� ��ũ[quota]K, ��밡���� �뷮[space]K, �Ҵ�뷮 �ʰ��� ���ε��� �� ����.',
        'gd_file_type_err' => 'JPEG�� PNG���ϸ� ������.',
        'invalid_image' => '������ ���� �Ǵ� ���������� ���������ʴ� �����Դϴ�.',
        'resize_failed' => '������� �������� �ʾҽ��ϴ�.Ȥ�� ����ũ�⸦ �ٲ� �� �����ϴ�.',
        'no_img_to_display' => 'ǥ���� �̹����� �����ϴ�.',
        'non_exist_cat' => '������ ī�װ��� �������� �ʽ��ϴ�.',
        'orphan_cat' => '���� ī�װ��� ���������ʽ��ϴ�. �����ڿ��� �����ϼ���.',
        'directory_ro' => '���� \'%s\' �� ���⸦ �� �� �����ϴ�. ������ ���� �� �����ϴ�.',
        'non_exist_comment' => '������ �ڸ�Ʈ�� �������� �ʽ��ϴ�.',
        'pic_in_invalid_album' => '���������ʴ� �ٹ��̹���(%s)!?', //new in cpg1.2.0
        'banned' => '���ϴ� ���� �̻���Ʈ�� �������ڸ�ܿ� �ֽ��ϴ�.', //new in cpg1.2.0
        'not_with_udb' => '�̱���� ���۸��ο��� ����� �� �����ϴ�. �̱���� ��������Ʈ��� ������ �Ǿ� �ֱ� �����Դϴ�.', //new in cpg1.2.0
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
        'alb_list_title' => '�ٹ��������',
        'alb_list_lnk' => '�ٹ����',
        'my_gal_title' => '���ΰ�������',
        'my_gal_lnk' => '���ΰ�����',
        'my_prof_lnk' => '��������',
        'adm_mode_title' => '�������� ��ȯ',
        'adm_mode_lnk' => '�������',
        'usr_mode_title' => '�Ϲݸ��� ��ȯ',
        'usr_mode_lnk' => '�Ϲݸ��',
	'upload_pic_title' => '�ٹ��� �̹��� ���ε�',
	'upload_pic_lnk' => '�̹������ε�',
        'register_title' => '��������',
        'register_lnk' => 'ȸ�����',
        'login_lnk' => '�α���',
        'logout_lnk' => '�α׾ƿ�',
	'lastup_lnk' => '�ֱ��̹���',
        'lastcom_lnk' => '�ֱ��ڸ�Ʈ',
        'topn_lnk' => '�ִ���ȸ',
        'toprated_lnk' => '�ְ�����',
        'search_lnk' => '�˻�',
        'fav_lnk' => '���ã��', //new in cpg1.2.0

);

$lang_gallery_admin_menu = array(
        'upl_app_lnk' => '���ε����',
        'config_lnk' => 'ȯ�漳��',
        'albums_lnk' => '�ٹ�����',
        'categories_lnk' => 'ī�װ�����',
        'users_lnk' => 'ȸ������',
        'groups_lnk' => '�׷����',
        'comments_lnk' => '�ڸ�Ʈ����',
        'searchnew_lnk' => 'FTP���ε����Ͽ���',
        'util_lnk' => '�̹���ũ�� ����', //new in cpg1.2.0
        'ban_lnk' => '��������', //new in cpg1.2.0
);

$lang_user_admin_menu = array(
        'albmgr_lnk' => '���ξٹ� ���� �� ����',
        'modifyalb_lnk' => '���ξٹ� ����',
        'my_prof_lnk' => '��������',
);

$lang_cat_list = array(
        'category' => 'ī�װ�',
        'albums' => '�ٹ�',
        'pictures' => '�̹���',
);

$lang_album_list = array(
        'album_on_page' => '�ٹ� %d  ������ %d'
);

$lang_thumb_view = array(
        'date' => '����',
        //Sort by filename and title
        'name' => '�����̸�', //new in cpg1.2.0
        'title' => '����', //new in cpg1.2.0
        'sort_da' => '���ڼ� �����迭',
        'sort_dd' => '���ڼ� �����迭',
        'sort_na' => '�̸��� �����迭',
        'sort_nd' => '�̸��� �����迭',
        'sort_ta' => '����� �����迭', //new in cpg1.2.0
        'sort_td' => '����� �����迭', //new in cpg1.2.0
        'pic_on_page' => '����: %d  ������: %d',
        'user_on_page' => '�����: %d  ������: %d'
);

$lang_img_nav_bar = array(
        'thumb_title' => '������� ���ư���',
	'pic_info_title' => '������ ����/�����',
        'slideshow_title' => '�����̵��',
        'ecard_title' => '�̹����� e-card�� ������',
        'ecard_disabled' => 'e-card�� ������ ����',
        'ecard_disabled_msg' => 'e-card ������ ���Ѿ���',
        'prev_title' => '����',
        'next_title' => '����',
	'pic_pos' => '��� �̹��� %s/%s',
);

$lang_rate_pic = array(
        'rate_this_pic' => '��',
        'no_votes' => '(�򰡾���)',
        'rating' => '(�������� : %s / 5 ��Ƚ�� %s ȸ)',
        'rubbish' => '���ֳ���',
        'poor' => '����',
        'fair' => '����',
        'good' => '����',
        'excellent' => '��������',
        'great' => '�ֻ�',
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
        CRITICAL_ERROR => '�ɰ��� �����߻�',
        'file' => '����: ',
        'line' => '��: ',
);

$lang_display_thumbnails = array(
        'filename' => '�����̸� : ',
        'filesize' => '����ũ�� : ',
        'dimensions' => '����,���� : ',
        'date_added' => '����� : '
);

$lang_get_pic_data = array(
        'n_comments' => '%s �ڸ�Ʈ',
        'n_views' => '%s ��ȸ',
        'n_votes' => '%s ��'
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
        0 => '�Ϲݸ��� ��ȯ�մϴ�...',
        1 => '�������� ��ȯ�մϴ�...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
        'alb_need_name' => '�ٹ��̸��� �ʿ��մϴ� !',
        'confirm_modifs' => '��������� �����Ͻðڽ��ϱ� ?',
        'no_change' => '��������� �����ϴ� !',
        'new_album' => '�� �ٹ�',
        'confirm_delete1' => '�ٹ��� �����Ͻðڽ��ϱ� ?',
	'confirm_delete2' => '\n�ٹ��� ��ϵ� �̹����� �ڸ�Ʈ�� ��� �����մϴ� !',
        'select_first' => '���� �ٹ��� �����ϼ���',
        'alb_mrg' => '�ٹ�����',
        'my_gallery' => '* ���ξٹ� *',
        'no_category' => '* �ֻ��� ī�װ�(����) *',
        'delete' => '����',
        'new' => '����',
        'apply_modifs' => '������',
        'select_category' => 'ī�װ� ����',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
        'miss_param' => 'Parameters required for \'%s\'operation not supplied !',
        'unknown_cat' => '������ ī�װ��� �������� �ʽ��ϴ�.',
        'usergal_cat_ro' => 'ȸ�� �������� ������ �� �����ϴ� !',
        'manage_cat' => 'ī�װ�����',
        'confirm_delete' => 'ī�װ��� �����Ͻðڽ��ϱ� ?',
        'category' => 'ī�װ�',
        'operations' => '����޴�',
        'move_into' => 'ī�װ� ����',
        'update_create' => 'ī�װ� ����/����',
        'parent_cat' => '���� ī�װ�',
        'cat_title' => 'ī�װ� �̸�',
        'cat_desc' => 'ī�װ� ����'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
        'title' => '��������',
        'restore_cfg' => '�⺻��������',
        'save_cfg' => '�����������',
        'notes' => '��Ʈ',
        'info' => '����',
        'upd_success' => '��������� ����Ǿ����ϴ�!',
        'restore_success' => '�⺻�������� ����Ǿ����ϴ�',
        'name_a' => '�̸��� �����迭',
        'name_d' => '�̸��� �����迭',
        'title_a' => '����� �����迭', //new in cpg1.2.0
        'title_d' => '����� �����迭', //new in cpg1.2.0
        'date_a' => '���ڼ� �����迭',
        'date_d' => '���ڼ� �����迭',
        'th_any' => 'Max Aspect',
        'th_ht' => 'Height',
        'th_wd' => 'Width',
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'�⺻����',
        array('������ �̸�', 'gallery_name', 0),
        array('������ ����', 'gallery_description', 0),
        array('������ �̸���', 'gallery_admin_email', 0),
        array('e-card�� �������� ��ũ�� URL', 'ecards_more_pic_target', 0),
        array('����', 'lang', 5),
        array('�׸�����', 'theme', 6),

        '�ٹ���� ����',
        array('�������̺��� �� (pixels or %)', 'main_table_width', 0),
        array('ǥ���� ī�װ� ������', 'subcat_level', 0),
        array('ǥ���� �ٹ� ��', 'albums_per_page', 0),
        array('�ٹ��� ���� ��', 'album_list_cols', 0),
        array('����� ũ��(pixels)', 'alb_list_thumb_size', 0),
        array('������������ �ҷ��� ����Ʈ', 'main_page_layout', 0),
        array('ī�װ��� 1������ �ٹ������ ����','first_level',1), //new in cpg1.2.0

        '����ϸ�� ����',
        array('����� �÷���', 'thumbcols', 0),
        array('����� ���', 'thumbrows', 0),
        array('�ҷ��� ����� �Ѽ�', 'max_tabs', 0),
        array('����ϰ� �Բ� ������ ���', 'caption_in_thumbview', 1),
        array('����ϰ� �Բ� �ڸ�Ʈ���� ���', 'display_comment_count', 1),
        array('�̹��� ���Ĺ��', 'default_sort_order', 3),
        array('�ְ������� ��Ÿ�� �ּ� ��Ƚ��', 'min_votes_for_rating', 0),

        '�̹�������޴� �� �ڸ�Ʈ ����',
	array('�̹������� ���̺��� ��(pixels or %)', 'picture_table_width', 0),
	array('�̹����� �������� �⺻������ ���', 'display_pic_info', 1),
	array('�������� ���͸� ���', 'filter_bad_words', 1),
	array('�ڸ�Ʈ�� ������ ������ ���', 'enable_smilies', 1),
	array('�̹��� ���� �ִ� ���ڼ�', 'max_img_desc_length', 0),
	array('�ܾ�� ����(����������)', 'max_com_wlength', 0),
	array('�ڸ�Ʈ ���� ����', 'max_com_lines', 0),
	array('�ڸ�Ʈ �ʴ� ���ڼ�', 'max_com_size', 0),
        array('�ʸ���Ʈ�� ����', 'display_film_strip', 1), //new in cpg1.2.0
        array('�ʸ���Ʈ���� �׸񰹼�', 'max_film_strip_items', 0), //new in cpg1.2.0

        '�̹��� �� ����� ����',
        array('JPEG ����Ƽ', 'jpeg_qual', 0),
        array('����� ����,���� �ִ�<b>*</b>', 'thumb_width', 0), //new in cpg1.2.0
        array('����Ի�� (���� Ȥ�� ���� Ȥ�� ������� �ִ���)<b>*</b>', 'thumb_use', 7), //new in cpg1.2.0
        array('�̹��� ���⿡ ���ο� ���ϻ���','make_intermediate',1),
	array('���� ������ ������ �ִ�ũ��(��)<b>*</b>', 'picture_width', 0),
        array('���ε� �̹��� �ִ�뷮 (KB)', 'max_upl_size', 0),
	array('���ε� �̹��� ����,���� �ִ�ũ��(pixels)', 'max_upl_width_height', 0),

	'����(ȸ��)����',
        array('ȸ������ ���', 'allow_user_registration', 1),
	array('ȸ�����Խ� �̸��� ��ȿ���� ����', 'reg_requires_valid_email', 1),
	array('�̸��� �ߺ���� ����', 'allow_duplicate_emails_addr', 1),
	array('����� ���ξٹ� ���� ���', 'allow_private_albums', 1),

        'Custom fields for image description (leave blank if unused)',
        array('Field 1 name', 'user_field1_name', 0),
        array('Field 2 name', 'user_field2_name', 0),
        array('Field 3 name', 'user_field3_name', 0),
        array('Field 4 name', 'user_field4_name', 0),

        '�̹����� ����� ��޼���',
        array('�α��� ���� ���� ����ڿ��� ���Ͼٹ� ������ �����ֱ�','show_private',1), //new in cpg1.2.0
        array('���� �̸��� �������� ����', 'forbiden_fname_char',0),
        array('����� �̹������� Ȯ����', 'allowed_file_extensions',0),
        array('�̹��� ũ������ ���','thumb_method',2),
        array('Path to ImageMagick \'convert\' utility (example /usr/bin/X11/)', 'impath', 0),
        array('Allowed image types (only valid for ImageMagick)', 'allowed_img_types',0),
        array('Command line options for ImageMagick', 'im_options', 0),
        array('Read EXIF data in JPEG files', 'read_exif_data', 1),
	array('�ٹ� ���丮 ��� <b>*</b>', 'fullpath', 0),
	array('�����(ȸ��) ���ε� �̹��� ��� <b>*</b>', 'userpics', 0),
	array('���� ������ �̹����� ���ξ� <b>*</b>', 'normal_pfx', 0),
	array('������� ���ξ� <b>*</b>', 'thumb_pfx', 0),
	array('���丮 �⺻ �۹̼�', 'default_dir_mode', 0),
        array('�̹��� �⺻ �۹̼�', 'default_file_mode', 0),

        '��Ű �� ���� ���ڵ� ����',
        array('��Ű�̸�', 'cookie_name', 0),
        array('��Ű���', 'cookie_path', 0),
        array('���ڵ�', 'charset', 4),

        '��Ÿ����',
        array('Enable debug mode', 'debug_mode', 1),

	'<br /><div align="center"> * ǥ�õ� �κ��� �ɼ��� �̹����� ��ϵ� ���Ŀ� �������� ������.</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => '�̸��� �Է��ϼ���.',
        'com_added' => '�ڸ�Ʈ�� ��ϵǾ����ϴ�.',
	'alb_need_title' => '������ �ٹ� Ÿ��Ʋ�� ���ϼ��� !',
	'no_udp_needed' => '������Ʈ�� �ʿ����.',
	'alb_updated' => 'The ������Ʈ �Ǿ����ϴ�.',
	'unknown_album' => '������ �ٹ��� ���ų�, ���ε��� ������ �����ڿ� ���� ���ѵǾ��ֽ��ϴ�.',
	'no_pic_uploaded' => '���ε� �̹��� �����ϴ� !<br /><br />�������� ���Ǵ� �̹��� ������ ���ε��ϼ���.',
	'err_mkdir' => '%s ���丮 �������� !',
	'dest_dir_ro' => '%s ���丮�� ��������Ǿ��ֽ��ϴ� !',
	'err_move' => '%s�� %s�� �����������߽��ϴ�  !',
	'err_fsize_too_large' => '�������ʰ�(maximum %s x %s) !',
	'err_imgsize_too_large' => '�뷮�ʰ� (maximum %s KB) !',
	'err_invalid_img' => '������ �̹����� ���ε��Ͻʽÿ� !',
	'allowed_img_types' => '%s �̹����� ���ε��� �� �ֽ��ϴ�.',
	'err_insert_pic' => '\'%s\' �̹����� �ٹ��� ����� �� �����ϴ�. ',
	'upload_success' => '�̹����� ���������� ���ε� �Ǿ����ϴ�.<br /><br />�������� ������ �Խõ˴ϴ�.',
        'info' => '�ȳ�',
        'com_added' => '�ڸ�Ʈ ���',
        'alb_updated' => '�ٹ� ����',
        'err_comment_empty' => '�ڸ�Ʈ ����ֽ� !',
        'err_invalid_fext' => 'Only files with the following extensions are accepted : <br /><br />%s.',
	'no_flood' => '�ڸ�Ʈ�� �����ϰų� ����� �� �����ϴ�.',
	'redirect_msg' => '\'����\' ��ư�� ������ ���� �������� ���ΰ�ħ ��ư�� ������� ������.',
	'upl_success' => '�̹����� ���������� ���ε�Ǿ����ϴ�.',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => 'ĸ��',
	'fs_pic' => '���� �̹���',
	'del_success' => '�����Ǿ����ϴ�!',
	'ns_pic' => '���ø� ���� ���̹���',
	'err_del' => '�������� �ʾҽ��ϴ�!!',
	'thumb_pic' => '�����',
	'comment' => '�ڸ�Ʈ',
	'im_in_alb' => '�ٹ� �̹���',
	'alb_del_success' => '\'%s\' �ٹ�����',
	'alb_mgr' => '�ٹ�����',
	'err_invalid_data' => '\'%s\' ����Ÿ �����ϴ�!',
	'create_alb' => '\'%s\' �ٹ�����',
	'update_alb' => '\'%s\' �ٹ� ������Ʈ \'%s\' �̹��� \'%s\' �ε���',
	'del_pic' => '�̹�������',
	'del_alb' => '�ٹ�����',
	'del_user' => '����ڻ���',
	'err_unknown_user' => '������ ����ڴ� �����ϴ� !',
	'comment_deleted' => '�ڸ�Ʈ�� ���������� �����Ǿ����ϴ�.',
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
        'confirm_del' => '�̹����� �����Ͻðڽ��ϱ� ? \\n�ڸ�Ʈ�� �Բ� �����˴ϴ�.',
        'del_pic' => '�̹�������',
        'size' => '%s x %s pixels',
        'views' => '%s times',
        'slideshow' => '�����̵��',
        'stop_slideshow' => '�����̵��-����',
        'view_fs' => '���� �̹��� ����',
);

$lang_picinfo = array(
        'title' =>'���� ����',
        'Filename' => '�����̸�',
        'Album name' => '�ٹ��̸�',
        'Rating' => '���� (%s ��)',
        'Keywords' => 'Ű����',
        'File Size' => '���� ũ��',
        'Dimensions' => 'Dimensions',
        'Displayed' => 'Displayed',
        'Camera' => 'ī�޶�',
        'Date taken' => '�Կ�����',
        'Aperture' => 'Aperture',
        'Exposure time' => 'Exposure time',
        'Focal length' => 'Focal length',
        'Comment' => '�ڸ�Ʈ',
        'addFav'=>'���ã�⿡ �߰�', //new in cpg1.2.0
        'addFavPhrase'=>'���ã��', //new in cpg1.2.0
        'remFav'=>'���ã�⿡�� ����', //new in cpg1.2.0
);

$lang_display_comments = array(
        'OK' => '���',
        'edit_title' => '�ڸ�Ʈ ����',
        'confirm_delete' => '�ڸ�Ʈ�� �����Ͻðڽ��ϱ� ?',
        'add_your_comment' => '�ڸ�Ʈ ���',
        'name'=>'�̸�', //new in cpg1.2.0
        'comment'=>'�ڸ�Ʈ', //new in cpg1.2.0
        'your_name' => '������', //new in cpg1.2.0
);

$lang_fullsize_popup = array(
        'click_to_close' => 'ȭ��ݱ�:�̹����� Ŭ��', //new in cpg1.2.0
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => 'e-card ������',
	'invalid_email' => '<b>Warning</b> : ��ȿ���� ���� �̸����Դϴ� !',
	'ecard_title' => '%s�Բ��� ������ e-card �Դϴ�!',
	'view_ecard' => 'ī�尡 �������ʴ� ����ڲ����� �̸�ũ�� Ŭ���ϼ��� !',
	'view_more_pics' => '�� ���� �̹����� �����Ͻ÷��� Ŭ���ϼ��� !',
	'send_success' => 'e-card�� ���½��ϴ�!',
	'send_failed' => '�˼��մϴ�, e-card �߼ۿ� �����Ͽ����ϴ�.',
	'from' => 'e-card �ۼ���',
	'your_name' => '������ ��� �̸�',
        'your_email' => '������ ��� �̸���',
        'to' => 'To',
        'rcpt_name' => '�޴� ��� �̸�',
        'rcpt_email' => '�޴� ��� �̸���',
        'greetings' => '����',
        'message' => '�޼���',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
        'pic_info' => '�̹��� ������',
        'album' => '�ٹ�',
        'title' => '�̹��� ����',
        'desc' => '�̹��� ����',
        'keywords' => '�˻� Ű����',
        'pic_info_str' => '%sx%s - %sKB - %s views - %s votes',
        'approve' => '�̹��� ����',
        'postpone_app' => '���� ����',
        'del_pic' => '�̹��� ����',
        'reset_view_count' => '��ȸ�� �ʱ�ȭ',
        'reset_votes' => '�� �ʱ�ȭ',
        'del_comm' => '�ڸ�Ʈ ����',
        'upl_approval' => '���ε� ����',
        'edit_pics' => '�̹��� ����',
        'see_next' => '����',
        'see_prev' => '����',
        'n_pic' => '������� �̹��� (%s)',
        'n_of_pic_to_disp' => '�������� ����� �̹���',
        'apply' => '������� ����'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
        'group_name' => '�׷��̸�',
        'disk_quota' => '��ũ �Ҵ�',
        'can_rate' => '�򰡰���',
        'can_send_ecards' => 'e-card �߼۰���',
        'can_post_com' => '�ڸ�Ʈ ��ϰ���',
        'can_upload' => '�̹��� ���ε尡��',
        'can_have_gallery' => '���ξٹ� ��������',
        'apply' => '������� ����',
        'create_new_group' => '���׷� ����',
        'del_groups' => '������ �׷����',
        'confirm_del' => 'Warning, when you delete a group, users that belong to this group will be transfered to the \'Registered\' group !\n\nDo you want to proceed ?',
        'title' => '����� �׷����',
        'approval_1' => 'Pub. Upl. approval (1)',
        'approval_2' => 'Priv. Upl. approval (2)',
	'note1' => '<b>(1)</b> public album �� ���ε��� �̹����� �������� ���������� ���� �Խõ˴ϴ�.',
	'note2' => '<b>(2)</b> �����(ȸ��)�� ���ε��� �̹����� ���۱ǹ��� ������� �ʾƾ� �Խõ˴ϴ�. ',
        'notes' => 'Notes'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
        'welcome' => 'ȯ���մϴ� !'
);

$lang_album_admin_menu = array(
	'confirm_delete' => '�ٹ��� �����Ͻðڽ��ϱ� ? \\n��� �̹����� �ڸ�Ʈ�� �Բ� �����˴ϴ�.',
        'delete' => '����',
        'modify' => '�ٹ�����',
        'edit_pics' => '�̹����� �������� ',
);

$lang_list_categories = array(
        'home' => '������ ����',
	'stat1' => '<b>ī�װ�:[cat] �ٹ�:[albums] �̹���:[pictures] �ڸ�Ʈ:[comments] ��ȸ:[views]</b>',
	'stat2' => '<b>�ٹ�:[albums] �̹���:[pictures] ��ȸ:[views]</b>',
	'xx_s_gallery' => '%s\'������',
	'stat3' => '<b>ī�װ�:[cat] �ٹ�:[albums] �̹���:[pictures] �ڸ�Ʈ:[comments] ��ȸ:[views]</b>'
);

$lang_list_users = array(
        'user_list' => '�����(ȸ��)���',
        'no_user_gal' => '�����(ȸ��) �������� �����ϴ�.',
        'n_albums' => '%s �ٹ�',
        'n_pics' => '%s �̹���'
);

$lang_list_albums = array(
        'n_pictures' => '%s �̹���',
        'last_added' => ', last one added on %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => '�α���',
	'enter_login_pswd' => '���̵�� ��й�ȣ�� �Է��ϼ���!',
        'username' => '���̵�',
        'password' => '��й�ȣ',
        'remember_me' => '����ϱ�',
        'welcome' => '%s�� �α��� �Ǿ����ϴ� !!',
        'err_login' => '*** �α��� ���� �ʾҽ��ϴ� ***',
        'err_already_logged_in' => '�̹� �α��� �Ǿ����ϴ� !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
        'logout' => '�α׾ƿ�',
        'bye' => '%s�� �α׾ƿ� �Ǿ����ϴ� !!',
        'err_not_loged_in' => '�α��ε��� �ʾҽ��ϴ� !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => '%s�� �ٹ� ������Ʈ',
	'general_settings' => '�⺻����',
	'alb_title' => '�ٹ� ����',
	'alb_cat' => '�ٹ� ī�װ�',
	'alb_desc' => '�ٹ� ����',
	'alb_thumb' => '�ٹ� �����',
	'alb_perm' => '�ٹ� ���Ѽ���',
	'can_view' => '�ٹ� ��������',
	'can_upload' => '�湮�ڰ� �̹����� ���ε��Ҽ� ����',
	'can_post_comments' => '�湮�ڰ� �ڸ�Ʈ�� ���� ����',
	'can_rate' => '�湮�ڰ� ���� �� ����',
	'user_gal' => '�����(ȸ��) ������',
	'no_cat' => '*�ֻ��� ī�װ�(����)',
	'alb_empty' => '�ٹ��� ����ֽ��ϴ�.',
	'last_uploaded' => '������ ���ε�',
	'public_alb' => '��ΰ���(public album)',
	'me_only' => '��������',
	'owner_only' => '(%s)�� ����',
	'groupp_only' => '\'%s\' �׷�',
	'err_no_alb_to_modify' => '������ �� �����ϴ�.',
	'update' => '�ٹ� ������Ʈ'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => '�˼��մϴ�. �̹� ���ϼ̽��ϴ�.',
	'rate_ok' => '���� �ּż� �����մϴ� !',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
{SITE_NAME}�� ���� ���� ȯ���մϴ�.<br />
ȸ������ ���ξٹ��� ���� �����Ҽ� �ִ� �ý����� �غ��߿� �ֽ��ϴ�.<br />
����� �׽�Ʈ���̹Ƿ�, ȸ�������̳� ��Ÿ ������ ���α׷������� ���� ���ǵ��� å������ �ʽ��ϴ�.<br />
�ϴ� ȸ������� �в��� ���� ���½� �̸����� ���� �˷��帱 ���̸�, ���� �Ⱓ���� ������ ȸ���� ������� Ư���� �̺�Ʈ�� �غ��ϰ� �ֽ��ϴ�.<br />ȸ�����Խ� �̸����� ��ȿ�� üũ�� ���� ��ȿ���� ���� �̸����� ��ϵ��� �ʴ��� �����ϼ���.<br /><br />
�ٽ��ѹ� {SITE_NAME}�� �湮�� �ּż� �����մϴ�.
EOT;

$lang_register_php = array(
	'page_title' => 'ȸ�����',
	'term_cond' => '��Ͼ�� �� �̿�ȳ�',
	'i_agree' => '�����մϴ�!',
	'submit' => 'ȸ�����',
	'err_user_exists' => '�̹� ������� ���̵��Դϴ�. �ٸ� ���̵�� ����ϼ���.',
	'err_password_mismatch' => '�� ��й�ȣ�� ��ġ���� �ʽ��ϴ�.',
	'err_uname_short' => '���̵�� �ּ�4~10�� �̳��� �ۼ��ؾ� �մϴ�.',
	'err_password_short' => '��й�ȣ�� �ּ�4~12�� �̳��� �ۼ��ؾ� �մϴ�.',
	'err_uname_pass_diff' => '���̵�� ��й�ȣ�� ��ġ���� �ʽ��ϴ�.',
	'err_invalid_email' => '�̸����� �Է��ϼ���.',
	'err_duplicate_email' => '�̹� ��ϵ� �̸��� �ּ��Դϴ�.',
	'enter_info' => 'ȸ����� ��',
	'required_info' => '�ʼ��Է� �׸�',
	'optional_info' => '�߰�����',
	'username' => '���̵�',
	'password' => '��й�ȣ',
	'password_again' => '��й�ȣ ���Է�',
	'email' => '�̸���',
	'location' => '����',
	'interests' => '���ɺо�',
	'website' => 'Ȩ������',
	'occupation' => '�Ͻô� ��',
	'error' => '����..',
	'confirm_email_subject' => '%s ȸ�����',
	'information' => '�ȳ�',
	'failed_sending_email' => '������� �̸��� �߼۽��� !',
	'thank_you' => '������ּż� �����մϴ�.<br />�Է��� �̸��� �ּҷ� Ȱ��ȭ �ڵ尡 ��� �̸����� ���½��ϴ�.<br />��������� �Ϸ��Ϸ��� �̸����� Ȱ��ȭ �ڵ带 Ŭ�����ֽʽÿ�.',
	'acct_created' => 'ȸ������ ��������� ���������� �Ϸ�Ǿ����ϴ�. �α����� ���������� �������ֽʽÿ�.',
	'acct_active' => 'ȸ������ ������ ���������� Ȱ��ȭ�Ǿ����ϴ�. �α����� �̿����ֽʽÿ�.',
	'acct_already_act' => 'ȸ������ ������ �̹� Ȱ��ȭ�Ǿ����ϴ� !',
	'acct_act_failed' => '�� ������ Ȱ��ȭ���� �ʾҽ��ϴ� !',
	'err_unk_user' => '������ ����ڴ� �������� �ʽ��ϴ� !',
	'x_s_profile' => '%s\'���� ��������',
	'group' => '�׷�',
	'reg_date' => 'ȸ������',
	'disk_usage' => '��ũ ��뷮',
	'change_pass' => '��й�ȣ ����',
	'current_pass' => '���� ��й�ȣ',
	'new_pass' => '���ο� ��й�ȣ',
	'new_pass_again' => '��й�ȣ ���Է�',
	'err_curr_pass' => '���� ��й�ȣ�� Ʋ���ϴ�.',
	'apply_modif' => '������� ����',
	'change_pass' => '��й�ȣ ����',
	'update_success' => '���������� ������Ʈ �Ǿ����ϴ�.',
	'pass_chg_success' => '��й�ȣ�� ���� �Ǿ����ϴ�.',
	'pass_chg_error' => '��й�ȣ�� ������� �ʾҽ��ϴ�.',
);

$lang_register_confirm_email = <<<EOT
�ݰ����ϴ� !! 

�� ������ '{SITE_NAME}' ȸ����� ��û�ڿ��� �����帮�� �����Դϴ�.

�Ʒ� ���̵�� ��й�ȣ�� �����ʵ��� �޸��صνñ� �ٶ��ϴ�.

���̵� : '{USER_NAME}'
��й�ȣ : '{PASSWORD}'

�߰��� �Ʒ� ��ũ�� Ŭ���ؼ� ȸ������ ������ Ȱ��ȭ ��Ų���� �α����ϼ���. 

{ACT_LINK}

��Ÿ ���ǻ����� ��� ���� tmax@puchonphoto.com �� �ֽñ� �ٶ��ϴ�.

{SITE_NAME} ���

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => '�ڸ�Ʈ �ٽú���',
	'no_comment' => '�ڸ�Ʈ �����ϴ�.',
        'n_comm_del' => '%s comment(s) deleted',
	'n_comm_disp' => '�������� ��±ۼ�',
	'see_prev' => '����',
	'see_next' => '����',
	'del_comm' => '������ �ڸ�Ʈ ����',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => '�̹��� ������ �˻�',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => '�� �̹��� �˻�',
	'select_dir' => '���ε� ���丮',
	'select_dir_msg' => 'FTP�� �̿� ������ ������ �̹� ���ε��� ������ ���ϴ� �������� ������� �ִ� �۾��� �ϴ� ���Դϴ�. <br /><br />*�̹��� ������(public_html/gallery/Albums/userpics)������ ������ ���� �Ʒ� �۾��� �����մϴ�.<br /><br />1) userpics �� Ŭ���ϸ� ��ü ����Ʈ ��� ���� ���ε�� ���ϸ� üũ�Ǿ� �ֽ��ϴ�.<br />2) ���ϴ� �������� ������ ���� "������ �̹��� ����" ��ư�� Ŭ�� ����մϴ�.<br /><br />*�ϳ��� ������ �� ���� �������� ��ũ�� �� �����ϴ�. �ش� ���������� ������ ���� �ϼ���.',
	'no_pic_to_add' => '����� �̹��� �����ϴ�.',
	'need_one_album' => '�ϳ� �̻��� �ٹ��� ������ ���� �̿��ϼ���.',
	'warning' => '����',
	'change_perm' => '�̹����� ���ε��ϱ� ���� �ش� ���丮�� �۹̼��� 755 �Ǵ� 777 �� �����ؾ� �մϴ� !',
	'target_album' => '<b>&quot; %s &quot; ������ �̹����� ������ ������ ���� </b>%s',
	'folder' => '���ε� ����',
	'image' => '�̹���',
	'album' => '������',
	'result' => '���',
	'dir_ro' => '���� ���� �����ϴ�. ',
	'dir_cant_read' => '�б� ���� �����ϴ�. ',
	'insert' => '�������� ���ο� �̹��� ����',
	'list_new_pic' => '�� �̹��� ���',
	'insert_selected' => '������ �̹��� ����',
	'no_pic_found' => '�� �̹����� ã�� ���Ͽ����ϴ�.',
	'be_patient' => '��� �������� �����ϼ���.',
        'notes' =>  '<ul>'.
				'<li><b>OK</b> : ���Ἲ��'.
				'<li><b>DP</b> : �ٸ� �������� �̹� ��ϵǾ�����'.
				'<li><b>PB</b> : ����, ���ε� ���丮�� �۹̼ǵ� �߰��۾� �ʿ�'.
				'<li>���� ���â�� OK, DP, PB ���� �������� ǥ�õ��� �ʾҴٸ� ���α׷��� �����ϼ���.'.

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
                'title' => '��������', //new in cpg1.2.0
                'user_name' => '������̸�', //new in cpg1.2.0
                'ip_address' => 'IP �ּ�', //new in cpg1.2.0
                'expiry' => '��ȿ�Ⱓ (��ĭ�� ����)', //new in cpg1.2.0
                'edit_ban' => '������� ����', //new in cpg1.2.0
                'delete_ban' => '����', //new in cpg1.2.0
                'add_new' => '�������� �߰�', //new in cpg1.2.0
                'add_ban' => '�߰�', //new in cpg1.2.0
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
	'title' => '�̹��� ���ε�',
	'max_fsize' => '���ε� ��� �ִ� ����ũ�� %s KB',
	'album' => '�ٹ�',
	'picture' => '�̹���',
	'pic_title' => '�̹��� ����',
	'description' => '�̹��� ����',
	'keywords' => 'Ű���� (�˻���)',
	'err_no_alb_uploadables' => '�ش� ���� �����ϴ�.',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => '�����(ȸ��)����',
	'name_a' => '�̸� (a-z)',
	'name_d' => '�̸� (z-a)',
	'group_a' => '�׷� (a-z)',
	'group_d' => '�׷� (z-a)',
	'reg_a' => '��� (a-z)',
	'reg_d' => '��� (z-a)',
	'pic_a' => '��ȸ (a-z)',
	'pic_d' => '��ȸ (z-a)',
	'disku_a' => '��뷮 (a-z)',
	'disku_d' => '��뷮 (z-a)',
	'sort_by' => '���ļ���',
	'err_no_users' => '�����(ȸ��) ���̺��� ����ֽ��ϴ� !',
	'err_edit_self' => '������ �� �����ϴ�. �������� ���� �������� �̿��ϼ���.',
	'edit' => '����',
	'delete' => '����',
	'name' => '����� �̸�',
	'group' => '�׷�',
	'inactive' => '��Ȱ��',
	'operations' => '����޴�',
	'pictures' => '�̹���',
	'disk_space' => '��뷮/�Ҵ緮',
	'registered_on' => 'ȸ��',
	'u_user_on_p_pages' => '%d ��ü %d ������',
	'confirm_del' => '���� �Ͻðڽ��ϱ� ? \\n��ϵ� ��� ������ �����˴ϴ�.',
	'mail' => '�̸���',
	'err_unknown_user' => '������ ȸ���� �������� �ʽ��ϴ� !',
        'modify_user' => 'ȸ������ ����',
        'notes' => '�޸�',
	'note_list' => '<li>��й�ȣ�� �������� ������� ����νø� �˴ϴ�.',
        'password' => '��й�ȣ',
        'user_active' => 'Ȱ��ȭ�� �����',
        'user_group' => '����� �׷�',
        'user_email' => '����� �̸���',
        'user_web_site' => '����� Ȩ������',
        'create_new_user' => '���ο� ����� ����',
	'user_location' => '������',
	'user_interests' => '���ɺо�',
	'user_occupation' => '�Ͻô� ��',
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => '�̹���ũ�����', //new in cpg1.2.0
        'what_it_does' => 'What it does', //new in cpg1.2.0
        'what_update_titles' => '�����̸����� �������', //new in cpg1.2.0
        'what_delete_title' => '�������', //new in cpg1.2.0
        'what_rebuild' => '����� ���ۼ��� �̹���ũ�⺯��', //new in cpg1.2.0
        'what_delete_originals' => 'Deletes original sized photos replacing them with the sized version', //new in cpg1.2.0
        'file' => '����', //new in cpg1.2.0
        'title_set_to' => '������ ', //new in cpg1.2.0
        'submit_form' => '����', //new in cpg1.2.0
        'updated_succesfully' => '���� ����', //new in cpg1.2.0
        'error_create' => '�����߻�', //new in cpg1.2.0
        'continue' => 'Process more images', //new in cpg1.2.0
        'main_success' => 'The file %s was successfully used as main picture', //new in cpg1.2.0
        'error_rename' => '%s �� %s' �� �̸� ������ �����߻�', //new in cpg1.2.0
        'error_not_found' => '���� %s �� ã���� �����ϴ�.', //new in cpg1.2.0
        'back' => '��������', //new in cpg1.2.0
        'thumbs_wait' => '����ϰ� ũ�Ⱑ ������ �̹����� �����ϰ� �ֽ��ϴ�, ��ٸ�����...', //new in cpg1.2.0
        'thumbs_continue_wait' => '����� Ȥ�� �������� �̹����� �����ϰ� �ֽ��ϴ�...', //new in cpg1.2.0
        'titles_wait' => '���������, ��ٸ�����...', //new in cpg1.2.0
        'delete_wait' => '���������, ��ٸ�����...', //new in cpg1.2.0
        'replace_wait' => '�����̹��� ������ ���������� �̹����� ��ü��, ��ٸ�����..', //new in cpg1.2.0
        'instruction' => 'Quick instructions', //new in cpg1.2.0
        'instruction_action' => 'Select action', //new in cpg1.2.0
        'instruction_parameter' => '���� ����', //new in cpg1.2.0
        'instruction_album' => '�ٹ�����', //new in cpg1.2.0
        'instruction_press' => 'Press %s', //new in cpg1.2.0
        'update' => '����� Ȥ�� ��������� �̹��� ����', //new in cpg1.2.0
        'update_what' => 'What should be updated', //new in cpg1.2.0
        'update_thumb' => '����ϸ�', //new in cpg1.2.0
        'update_pic' => 'ũ������� �̹�����', //new in cpg1.2.0
        'update_both' => '����ϰ� ũ������� �̹���', //new in cpg1.2.0
        'update_number' => 'Number of processed images per click', //new in cpg1.2.0
        'update_option' => '(�ð���������� �߻��ϸ� �� �ɼ��� ���� �����ϼ���)', //new in cpg1.2.0
        'filename_title' => '�����̸� &rArr; �̹��� ����', //new in cpg1.2.0
        'filename_how' => 'How should the filename be modified', //new in cpg1.2.0
        'filename_remove' => 'Remove the .jpg ending and replace _ (underscore) with spaces', //new in cpg1.2.0
        'filename_euro' => 'Change 2003_11_23_13_20_20.jpg to 23/11/2003 13:20', //new in cpg1.2.0
        'filename_us' => 'Change 2003_11_23_13_20_20.jpg to 11/23/2003 13:20', //new in cpg1.2.0
        'filename_time' => 'Change 2003_11_23_13_20_20.jpg to 13:20', //new in cpg1.2.0
        'delete' => '�̹������� Ȥ�� �����̹��� ����', //new in cpg1.2.0
        'delete_title' => '�̹������� ����', //new in cpg1.2.0
        'delete_original' => '�����̹��� ����', //new in cpg1.2.0
        'delete_replace' => '�����̹��� ������ �������� �̹����� ��ü', //new in cpg1.2.0
        'select_album' => '�ٹ� ����', //new in cpg1.2.0
);

?>