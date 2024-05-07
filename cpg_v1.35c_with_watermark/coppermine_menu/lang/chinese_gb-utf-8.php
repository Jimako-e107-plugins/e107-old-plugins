<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.2.0                                            //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002,2003 Gregory DEMAR <gdemar@wanadoo.fr>                 //
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
// to all devs: stop overwriting this file!

// info about translators and translated language
$lang_translation_info = array(
'lang_name_english' => 'Chinese(GB2312)',  //the name of your language in English, e.g. 'Greek' or 'Spanish'
'lang_name_native' => 'ÖÐÎÄ(¼òÌå)', //the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '¦¥¦Ë¦Ë¦Ç¦Í¦É¦Ê?' or 'Espanol'
'lang_country_code' => 'cn', //the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
'trans_name'=> 'hotsnow', //the name of the translator - can be a nickname
'trans_email' => 'webmaster@qilu.tv', //translator's email address (optional)
'trans_website' => 'http://bbs.qilu.tv/', //translator's website (optional)
'trans_date' => '2003-10-16', //the date the translation was created / last modified
);

$lang_charset = 'GB2312';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('ÖÜÈÕ', 'ÖÜÒ»', 'ÖÜ¶þ', 'ÖÜÈý', 'ÖÜËÄ', 'ÖÜÎå', 'ÖÜÁù');
$lang_month = array('Ò»ÔÂ', '¶þÔÂ', 'ÈýÔÂ', 'ËÄÔÂ', 'ÎåÔÂ', 'ÁùÔÂ', 'ÆßÔÂ', '°ËÔÂ', '¾ÅÔÂ', 'Ê®ÔÂ', 'Ê®Ò»ÔÂ', 'Ê®¶þÔÂ');

// Some common strings
$lang_yes = 'ÊÇ';
$lang_no  = '·ñ';
$lang_back = '·µ»Ø';
$lang_continue = '¼ÌÐø';
$lang_info = 'ÐÅÏ¢';
$lang_error = '´íÎó';

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
	'random' => 'Ëæ»úÍ¼Æ¬',
	'lastup' => '×îÐÂÌí¼Ó',
	'lastalb'=> '×îÐÂ¸üÐÂÍ¼¼¯',
	'lastcom' => '×îÐÂÆÀÂÛ',
	'topn' => 'ÈÈÃÅÍ¼Æ¬',
	'toprated' => 'ÈÈÃÅÍ¶Æ±',
	'lasthits' => '×îÐÂä¯ÀÀ',
	'search' => 'ËÑË÷½á¹û',
	'favpics'=> 'ÎÒµÄÊÕ²Ø',
);

$lang_errors = array(
	'access_denied' => 'ÄúÃ»ÓÐÈ¨ÏÞ·ÃÎÊ¸ÃÒ³.',
	'perm_denied' => 'ÄúÃ»ÓÐÈ¨ÏÞÖ´ÐÐ¸Ã²Ù×÷.',
	'param_missing' => '³ÌÐòµ÷ÓÃÈ±ÉÙ²ÎÊý.',
	'non_exist_ap' => 'ËùÑ¡ÔñµÄÍ¼¼¯/Í¼Æ¬²»´æÔÚ!',
	'quota_exceeded' => '¿Õ¼äÊ¹ÓÃÒÑ³¬¹ýÏÞ¶î<br><br>ÄúµÄ¿Õ¼äÏÞ¶îÎª [quota]K, Ä¿Ç°ÒÑÊ¹ÓÃ [space]K, ¼ÓÈë¸ÃÍ¼Æ¬¿ÉÄÜ»á³¬¹ýÄúµÄ¿Õ¼äÏÞ¶î.',
	'gd_file_type_err' => 'µ±Ç°Ê¹ÓÃ GD Í¼ÐÎ¿â,¿ÉÓÃµÄÍ¼Æ¬¸ñÊ½Îª JPEG ºÍ PNG.',
	'invalid_image' => 'ÄúÉÏ´«µÄÍ¼Æ¬ÒÑËð»µ»òÎÞ·¨±» GD Í¼ÐÎ¿â´¦Àí',
	'resize_failed' => 'ÎÞ·¨Éú³ÉËõÍ¼»ò´óÐ¡ºÏÊÊµÄÍ¼Æ¬.',
	'no_img_to_display' => 'Ä¿Ç°ÉÐÎÞÍ¼Æ¬',
	'non_exist_cat' => 'ËùÑ¡ÔñµÄ·ÖÀà²»´æÔÚ',
	'orphan_cat' => '¸Ã×ÓÀà±ðµÄ¸¸Àà±ð²»´æÔÚ,Çë½øÈëÀà±ð¹ÜÀíÐÞÕý.',
	'directory_ro' => 'Ä¿Â¼ \'%s\' ²»¿ÉÐ´, Í¼Æ¬ÎÞ·¨É¾³ý',
	'non_exist_comment' => 'ËùÑ¡ÔñµÄÆÀÂÛ²»´æÔÚ.',
	'pic_in_invalid_album' => '¸ÃÍ¼Æ¬Î»ÓÚ²»´æÔÚµÄÍ¼¼¯ (%s)!?',
	'banned' => 'ÄúÄ¿Ç°±»½ûÖ¹ä¯ÀÀ¸ÃÕ¾µã.',
	'not_with_udb' => 'ÓÉÓÚÍ¼¼¯Ä¿Ç°ÓëÂÛÌ³³ÌÐò½áºÏ,Òò´Ë¸Ã¹¦ÄÜÎÞ·¨Ê¹ÓÃ.ÔÚÕâÖÖÉè¶¨Ä£Ê½ÏÂ²»Ö§³Ö¸Ã¹¦ÄÜ,»òÊÇ¸Ã¹¦ÄÜÓÉÂÛÌ³³ÌÐò´¦Àí.',
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => '·µ»ØÍ¼¼¯ÁÐ±í',
	'alb_list_lnk' => 'Í¼¼¯ÁÐ±í',
	'my_gal_title' => '·µ»Ø¸öÈËÍ¼¼¯',
	'my_gal_lnk' => '¸öÈËÍ¼¼¯',
	'my_prof_lnk' => 'ÎÒµÄ¸öÈË×ÊÁÏ',
	'adm_mode_title' => '½øÈë¹ÜÀíÄ£Ê½',
	'adm_mode_lnk' => '¹ÜÀíÄ£Ê½',
	'usr_mode_title' => '½øÈëÓÃ»§Ä£Ê½',
	'usr_mode_lnk' => 'ÓÃ»§Ä£Ê½',
	'upload_pic_title' => 'ÉÏ´«Í¼Æ¬ÖÁÍ¼¼¯',
	'upload_pic_lnk' => 'ÉÏ´«Í¼Æ¬',
	'register_title' => '×¢²áÕÊºÅ',
	'register_lnk' => '×¢²á',
	'login_lnk' => 'µÇÂ¼',
	'logout_lnk' => 'ÍË³ö',
	'lastup_lnk' => '×îÐÂÉÏ´«',
	'lastcom_lnk' => '×îÐÂÆÀÂÛ',
	'topn_lnk' => 'ÈÈÃÅÍ¼Æ¬',
	'toprated_lnk' => 'ÈÈÃÅÍ¶Æ±',
	'search_lnk' => 'ËÑË÷',
	'fav_lnk' => 'ÎÒµÄÊÕ²Ø',

);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => 'ÉóºËÉÏ´«',
	'config_lnk' => 'ÉèÖÃ',
	'albums_lnk' => 'Í¼¼¯',
	'categories_lnk' => 'Àà±ð',
	'users_lnk' => 'ÓÃ»§',
	'groups_lnk' => 'Èº×é',
	'comments_lnk' => 'ÆÀÂÛ',
	'searchnew_lnk' => 'ÅúÁ¿Ìí¼ÓÍ¼Æ¬',
	'util_lnk' => 'µ÷ÕûÍ¼Æ¬´óÐ¡',
	'ban_lnk' => 'ÆÁ±ÎÓÃ»§',
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => 'Éú³É/ÖØÕû Í¼¼¯',
	'modifyalb_lnk' => '±à¼­ÎÒµÄÍ¼¼¯',
	'my_prof_lnk' => 'ÎÒµÄ¸öÈË×ÊÁÏ',
);

$lang_cat_list = array(
	'category' => 'Àà±ð',
	'albums' => 'Í¼¼¯',
	'pictures' => 'Í¼Æ¬',
);

$lang_album_list = array(
	'album_on_page' => '%d ¸öÍ¼¼¯ÓÚ %d Ò³'
);

$lang_thumb_view = array(
	'date' => 'ÈÕÆÚ',
	//Sort by filename and title
	'name' => 'ÎÄ¼þÃû',
	'title' => '±êÌâ',
	'sort_da' => '°´ÈÕÆÚÉýÐòÅÅÐò',
	'sort_dd' => '°´ÈÕÆÚ½µÐòÅÅÐò',
	'sort_na' => '°´Ãû³ÆÉýÐòÅÅÐò',
	'sort_nd' => '°´Ãû³Æ½µÐòÅÅÐò',
	'sort_ta' => '°´±êÌâÉýÐòÅÅÐò',
	'sort_td' => '°´±êÌâ½µÐòÅÅÐò',
	'pic_on_page' => '%d ÕÅÍ¼Æ¬ÓÚ %d Ò³',
	'user_on_page' => '%d Î»ÓÃ»§ÓÚ %d Ò³'
);

$lang_img_nav_bar = array(
	'thumb_title' => '·µ»ØËõÍ¼Ò³Ãæ',
	'pic_info_title' => 'ÏÔÊ¾/Òþ²Ø Í¼Æ¬ÐÅÏ¢',
	'slideshow_title' => 'Á¬Ðø²¥·Å',
	'ecard_title' => '·¢ËÍµç×ÓºØ¿¨',
	'ecard_disabled' => 'µç×ÓºØ¿¨ÔÝ²»¿ÉÓÃ',
	'ecard_disabled_msg' => 'ÄúÎÞÈ¨·¢ËÍµç×ÓºØ¿¨',
	'prev_title' => 'Ç°Ò»ÕÅÍ¼Æ¬',
	'next_title' => 'ºóÒ»ÕÅÍ¼Æ¬',
	'pic_pos' => 'Í¼Æ¬ %s/%s',
);

$lang_rate_pic = array(
	'rate_this_pic' => 'Í¶Æ± ',
	'no_votes' => '(ÉÐÎÞÍ¶Æ±)',
	'rating' => '(Ä¿Ç°µÃ·Ö : %s / 5 ÓÚ %s ¸öÍ¶Æ±)',
	'rubbish' => '¼«²î',
	'poor' => '½Ï²î',
	'fair' => 'Ò»°ã',
	'good' => 'ºÜºÃ',
	'excellent' => '¼«¼Ñ',
	'great' => 'Ì«°ôÁË',
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
	CRITICAL_ERROR => 'ÏµÍ³´íÎó',
	'file' => 'ÎÄ¼þ: ',
	'line' => 'ÐÐÊý: ',
);

$lang_display_thumbnails = array(
	'filename' => 'ÎÄ¼þÃû : ',
	'filesize' => 'ÎÄ¼þ´óÐ¡ : ',
	'dimensions' => '³ß´ç : ',
	'date_added' => '¼ÓÈëÈÕÆÚ : '
);

$lang_get_pic_data = array(
	'n_comments' => '%s ¸öÆÀÂÛ',
	'n_views' => '%s ´Îä¯ÀÀ',
	'n_votes' => '(%s ¸öÍ¶Æ±)'
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
	'Exclamation' => '¾ªÌ¾',
	'Question' => 'ÒÉÎÊ',
	'Very Happy' => '¸ßÐË',
	'Smile' => 'Î¢Ð¦',
	'Sad' => '±¯ÉË',
	'Surprised' => '¾ªÑÈ',
	'Shocked' => 'Õð¾ª',
	'Confused' => 'ÒÉ»ó',
	'Cool' => '¿á',
	'Laughing' => '´óÐ¦',
	'Mad' => '·è',
	'Razz' => 'ÀäÐ¦',
	'Embarassed' => 'Embarassed',
	'Crying or Very sad' => '´ó¿Þ»ò·Ç³£ÉËÐÄ',
	'Evil or Very Mad' => 'Ð°¶ñµÄ»ò·è¿ñµÄ',
	'Twisted Evil' => 'Twisted Evil',
	'Rolling Eyes' => '×ªÑÛÖé',
	'Wink' => 'Õ£ÑÛ',
	'Idea' => 'Idea',
	'Arrow' => '¼ý',
	'Neutral' => 'ÖÐÁ¢',
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
	0 => 'ÕýÀë¿ª¹ÜÀíÄ£Ê½...',
	1 => 'Õý½øÈë¹ÜÀíÄ£Ê½...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => 'ÄúÐèÒª¸øÍ¼¼¯Ò»¸öÃû³Æ !',
	'confirm_modifs' => 'ÄúÈ·¶¨Òª×öÕâÐ©ÐÞ¸ÄÂð ?',
	'no_change' => 'ÄúÃ»ÓÐ×öÈÎºÎÐÞ¸Ä !',
	'new_album' => 'ÐÂÍ¼¼¯',
	'confirm_delete1' => 'ÄúÈ·¶¨ÒªÉ¾³ý´ËÍ¼¼¯Âð ?',
	'confirm_delete2' => '\n´ËÍ¼¼¯ÄÚµÄËùÓÐÍ¼Æ¬¼°ÆÀÂÛ¶¼»á±»É¾³ý !',
	'select_first' => 'ÇëÏÈÑ¡ÔñÒ»¸öÍ¼¼¯',
	'alb_mrg' => 'Í¼¼¯¹ÜÀí',
	'my_gallery' => '* ÎÒµÄÍ¼¼¯ *',
	'no_category' => '* Ã»ÓÐÀà±ð *',
	'delete' => 'É¾³ý',
	'new' => 'Ìí¼Ó',
	'apply_modifs' => 'Ìá½»ÐÞ¸Ä',
	'select_category' => 'Ñ¡ÔñÀà±ð',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => '\'%s\'²Ù×÷È±ÉÙ±ØÒªµÄ²ÎÊý !',
	'unknown_cat' => 'ËùÑ¡ÔñµÄÀà±ð²»´æÔÚ',
	'usergal_cat_ro' => 'ÓÃ»§Í¼¼¯Àà±ðÎÞ·¨É¾³ý !',
	'manage_cat' => 'Àà±ð¹ÜÀí',
	'confirm_delete' => 'ÄúÈ·¶¨ÒªÉ¾³ý´ËÀà±ðÂð ?',
	'category' => 'Àà±ð',
	'operations' => '²Ù×÷',
	'move_into' => 'ÒÆ¶¯µ½',
	'update_create' => '¸üÐÂ/´´½¨ Àà±ð',
	'parent_cat' => '¸¸Àà±ð',
	'cat_title' => 'Àà±ðÃû³Æ',
	'cat_desc' => 'Àà±ðÃèÊö'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => 'ÏµÍ³ÉèÖÃ',
	'restore_cfg' => '»Ö¸´Ô­Ê¼ÉèÖÃ',
	'save_cfg' => '±£´æÐÂÉèÖÃ',
	'notes' => '×¢Òâ',
	'info' => 'ÐÅÏ¢',
	'upd_success' => 'ÉèÖÃÒÑ¸üÐÂ',
	'restore_success' => 'Ô­Ê¼ÉèÖÃÒÑ»Ö¸´',
	'name_a' => 'Ãû³ÆµÝÔö',
	'name_d' => 'Ãû³ÆµÝ¼õ',
	'title_a' => '±êÌâµÝÔö',
	'title_d' => '±êÌâµÝ¼õ',
	'date_a' => 'ÈÕÆÚµÝÔö',
	'date_d' => 'ÈÕÆÚµÝ¼õ',
        'th_any' => 'Max Aspect',
        'th_ht' => 'Height',
        'th_wd' => 'Width',

);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'»ù±¾Éè¶¨',
	array('Í¼¼¯Ãû³Æ', 'gallery_name', 0),
	array('Í¼¼¯ÃèÊö', 'gallery_description', 0),
	array('¹ÜÀíÔ±µç×ÓÓÊ¼þ', 'gallery_admin_email', 0),
	array('ÔÚ·¢ËÍµÄµç×ÓºØ¿¨ÄÚÏÔÊ¾ \'ÐÀÉÍ¸ü¶àÍ¼Æ¬\' µÄÁ´½ÓÍøÖ·', 'ecards_more_pic_target', 0),
	array('ÓïÑÔ', 'lang', 5),
	//array('ÆôÓÃÓïÑÔÑ¡Ôñ', 'lang_select_enable', 8 ),
	array('Ö÷Ìâ', 'theme', 6),
	//array('ÆôÓÃÖ÷ÌâÑ¡Ôñ', 'theme_select_enable', 8),

	'Í¼¼¯ÁÐ±íÏÔÊ¾Éè¶¨',
	array('Ö÷±í¸ñ¿í¶È (pixels or %)', 'main_table_width', 0),
	array('Í¬Ò»Àà±ðµÄ×ÓÀà±ðÏÔÊ¾¸öÊý', 'subcat_level', 0),
	array('Í¼¼¯ÏÔÊ¾¸öÊý', 'albums_per_page', 0),
	array('Í¼¼¯ÁÐ±íµÄÁÐÊý', 'album_list_cols', 0),
	array('ÏÔÊ¾ËõÍ¼µÄ´óÐ¡(pixels)', 'alb_list_thumb_size', 0),
	array('Ö÷Ò³ÄÚÈÝ', 'main_page_layout', 0),
	array('ÔÚÀà±ðÖÐÏÔÊ¾µÚÒ»²ãÍ¼¼¯µÄËõÍ¼','first_level',1), //new in cpg1.2.0

	'ËõÍ¼Éè¶¨',
	array('ËõÍ¼Ò³ÁÐÊý', 'thumbcols', 0),
	array('ËõÍ¼Ò³ÐÐÊý', 'thumbrows', 0),
	array('ÏÔÊ¾µÄ×î´ó tab Êý', 'max_tabs', 0),
	array('ÏÔÊ¾Í¼Æ¬±êÌâ (¸½¼ÓµÄ±êÌâ) ÓÚËõÍ¼ÏÂ·½', 'caption_in_thumbview', 1),
	array('ÏÔÊ¾ÆÀÂÛÊýÓÚËõÍ¼ÏÂ·½', 'display_comment_count', 1),
	array('Í¼Æ¬µÄÄ¬ÈÏÅÅÁÐ´ÎÐò', 'default_sort_order', 3),
	array('ÒªÏÔÊ¾ÔÚ \'ÈÈÃÅÍ¶Æ±\' ÄÚµÄÍ¼Æ¬×îÉÙÐèÍ¶¼¸Æ±', 'min_votes_for_rating', 0),

	'Í¼Æ¬ÏÔÊ¾ &amp; ÆÀÂÛÉè¶¨',
	array('Í¼Æ¬ÏÔÊ¾µÄ±í¸ñ¿í¶È (pixels or %)', 'picture_table_width', 0),
	array('Ä¬ÈÏÏÔÊ¾Í¼Æ¬ÐÅÏ¢', 'display_pic_info', 1),
	array('¹ýÂËÆÀÂÛÖÐµÄ²»Á¼×Ö·û', 'filter_bad_words', 1),
	array('ÆÀÂÛÖÐ¿ÉÒÔÊ¹ÓÃÐ¦Á³Í¼Ê¾', 'enable_smilies', 1),
	array('Í¼Æ¬ÃèÊöÄÚÈÝµÄ×î´ó³¤¶È', 'max_img_desc_length', 0),
	array('Ã¿¸öµ¥´ÊµÄ×î´ó×Ö·ûÊý', 'max_com_wlength', 0),
	array('ÆÀÂÛÖÐÃ¿ÐÐÔÊÐíµÄ×î´ó×Ö·ûÊý', 'max_com_lines', 0),
	array('ÆÀÂÛÄÚÈÝµÄ×î´ó³¤¶È', 'max_com_size', 0),
	array('ÏÔÊ¾Í¼Æ¬Ô¤ÀÀÁÐ', 'display_film_strip', 1),
	array('Í¼Æ¬Ô¤ÀÀÁÐµÄÍ¼Æ¬Êý', 'max_film_strip_items', 0),

	'Í¼Æ¬¼°ËõÍ¼Éè¶¨',
	array('JPEG ¸ñÊ½Æ·ÖÊ', 'jpeg_qual', 0),
	array('ËõÍ¼µÄ×î´ó¿í¶È¼°¸ß¶È <b>*</b>', 'thumb_width', 0),
	array('Ê¹ÓÃ³ß´ç£¨¿í¡¢¸ß»òËõÍ¼×î´ó³ß´ç£©<b>*</b>', 'thumb_use', 7),
	array('Éú³ÉÊÊÖÐ´óÐ¡µÄÍ¼Æ¬','make_intermediate',1),
	array('ÊÊÖÐ´óÐ¡Í¼Æ¬µÄ¿í¶È»ò¸ß¶È <b>*</b>', 'picture_width', 0),
	array('ÉÏ´«Í¼Æ¬µÄ×î´óÏÞÖÆ (KB)', 'max_upl_size', 0),
	array('ÉÏ´«Í¼Æ¬µÄ¿í¶È»ò¸ß¶È×î´óÏÞÖÆ (pixels)', 'max_upl_width_height', 0),

	'ÓÃ»§Éè¶¨',
	array('ÔÊÐíÐÂÓÃ»§×¢²á', 'allow_user_registration', 1),
	array('ÓÃ»§×¢²áÐèÒª Email ÑéÖ¤', 'reg_requires_valid_email', 1),
	array('ÔÊÐí²»Í¬ÓÃ»§Ê¹ÓÃÍ¬Ò»¸ö Email', 'allow_duplicate_emails_addr', 1),
	array('ÔÊÐíÓÃ»§´´½¨Ë½ÈËÍ¼¼¯', 'allow_private_albums', 1),

	'×Ô¶¨ÒåµÄÍ¼Æ¬ÃèÊö (Èç¹û²»ÓÃÇëÁô¿Õ)',
	array('Í¼Æ¬ÃèÊö1', 'user_field1_name', 0),
	array('Í¼Æ¬ÃèÊö2', 'user_field2_name', 0),
	array('Í¼Æ¬ÃèÊö3', 'user_field3_name', 0),
	array('Í¼Æ¬ÃèÊö4', 'user_field4_name', 0),

	'Í¼Æ¬ºÍËõÍ¼µÄ¸ß¼¶Éè¶¨',
	array('½«¸öÈËÍ¼¼¯Í¼±êÏÔÊ¾¸øÎ´µÇÂ¼µÄÓÃ»§','show_private',1),
	array('ÎÄ¼þÃû½ûÓÃµÄ×Ö·û', 'forbiden_fname_char',0),
	array('ÉÏ´«Í¼Æ¬ÔÊÐíµÄÀ©Õ¹Ãû', 'allowed_file_extensions',0),
	array('Éú³ÉËõÍ¼µÄ·½·¨','thumb_method',2),
	array('ImageMagick \'convert\' ³ÌÐòµÄÂ·¾¶ (ÀýÈç /usr/bin/X11/)', 'impath', 0),
	array('ÔÊÐíÍ¼Æ¬µÄÀàÐÍ (½ö¶Ô ImageMagick ÓÐÐ§)', 'allowed_img_types',0),
	array('ImageMagick µÄÃüÁîÐÐÑ¡Ïî', 'im_options', 0),
	array('¶ÁÈ¡ JPEG Í¼Æ¬µÄ EXIF ÐÅÏ¢', 'read_exif_data', 1),
	array('Í¼¼¯Ä¿Â¼ <b>*</b>', 'fullpath', 0),
	array('ÓÃ»§Í¼Æ¬Ä¿Â¼ <b>*</b>', 'userpics', 0),
	array('Éú³ÉÊÊÖÐÍ¼Æ¬µÄÇ°ÖÃ×Ö·û <b>*</b>', 'normal_pfx', 0),
	array('Éú³ÉËõÍ¼µÄÇ°ÖÃ×Ö·û <b>*</b>', 'thumb_pfx', 0),
	array('Ä¿Â¼µÄÈ±Ê¡ CHMOD', 'default_dir_mode', 0),
	array('Í¼Æ¬ÎÄ¼þµÄÈ±Ê¡ CHMOD', 'default_file_mode', 0),
	


	'Cookies &amp; ×Ö·û¼¯ Éè¶¨',
	array('±¾³ÌÐòËùÊ¹ÓÃµÄ cookie Ãû³Æ', 'cookie_name', 0),
	array('±¾³ÌÐòËùÊ¹ÓÃµÄ cookie Â·¾¶', 'cookie_path', 0),
	array('×Ö·û¼¯±àÂë', 'charset', 4),

	'ÆäËûÉèÖÃ',
	array('ÆôÓÃµ÷ÊÔÄ£Ê½', 'debug_mode', 1),

	'<br><div align="center">(*) Èç¹ûÍ¼¼¯ÖÐÒÑÓÐÍ¼Æ¬,Ôò±êÓÐ * ºÅµÄÏî²»ÔÊÐíÐÞ¸Ä</div><br>'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => 'ÇëÊäÈëÄúµÄÃû×ÖºÍÆÀÂÛ',
	'com_added' => 'ÄúµÄÆÀÂÛÒÑ¼ÓÈë',
	'alb_need_title' => 'Äú±ØÐëÎªÍ¼¼¯Ìá¹©Ò»¸ö±êÌâ !',
	'no_udp_needed' => 'Ã»ÓÐ±ØÒª¸üÐÂ.',
	'alb_updated' => 'Í¼¼¯ÒÑ¸üÐÂ',
	'unknown_album' => 'ËùÑ¡ÔñµÄÍ¼¼¯²»´æÔÚ»òÄúÃ»ÓÐÈ¨ÏÞÉÏ´«Í¼Æ¬µ½´ËÍ¼¼¯',
	'no_pic_uploaded' => 'Í¼Æ¬Ã»ÓÐ±»ÉÏ´« !<br><br>Èç¹ûÄúÈ·ÊµÑ¡ÔñÁËÉÏ´«Í¼Æ¬, Çë¼ì²é·þÎñÆ÷ÊÇ»òÔÊÐíÉÏ´«ÎÄ¼þ...',
	'err_mkdir' => 'ÎÞ·¨´´½¨Ä¿Â¼ %s !',
	'dest_dir_ro' => 'Ä¿±êÄ¿Â¼ %s ÎÞ·¨Ð´Èë !',
	'err_move' => 'ÎÞ·¨ÒÆ¶¯ %s µ½ %s !',
	'err_fsize_too_large' => 'ÄúÉÏ´«µÄÍ¼Æ¬Ì«´ó (²»ÄÜ³¬¹ý %s x %s) !',
	'err_imgsize_too_large' => 'ÄúÉÏ´«µÄÎÄ¼þÌ«´ó (²»ÄÜ³¬¹ý %s KB) !',
	'err_invalid_img' => 'ÉÏ´«µÄÎÄ¼þ²»ÊÇÓÐÐ§µÄÍ¼Æ¬¸ñÊ½ !',
	'allowed_img_types' => 'Äú½ö¿ÉÒÔÉÏ´« %s ÕÅÍ¼Æ¬.',
	'err_insert_pic' => 'Í¼Æ¬ \'%s\' ÎÞ·¨¼ÓÈë´ËÍ¼¼¯ ',
	'upload_success' => 'Í¼Æ¬ÉÏ´«Íê³É<br><br>¹ÜÀíÔ±ÉóºËºó²Å¿ÉÒÔÏÔÊ¾.',
	'info' => 'ÐÅÏ¢',
	'com_added' => 'ÆÀÂÛÒÑ¼ÓÈë',
	'alb_updated' => 'Í¼¼¯ÒÑ¸üÐÂ',
	'err_comment_empty' => 'ÆÀÂÛÊÇ¿ÕµÄ !',
	'err_invalid_fext' => 'Ö»ÔÊÐí¾ßÓÐÏÂÁÐÀ©Õ¹ÃûµÄÎÄ¼þ : <br><br>%s.',
	'no_flood' => '±§Ç¸,¸ÃÍ¼Æ¬µÄµ±Ç°×îºóÒ»¸öÆÀÂÛÊÇÄú·¢±íµÄ<br><br>Äú¿ÉÒÔÐÞ¸Ä·¢±í¹ýµÄÆÀÂÛ',
	'redirect_msg' => 'ÕýÔÚ×ªÏò.<br><br><br>Èç¹ûÒ³ÃæÃ»ÓÐ×Ô¶¯Ë¢ÐÂ,Çë°´ \'¼ÌÐø\'',
	'upl_success' => 'ÄúµÄÍ¼Æ¬ÒÑ³É¹¦¼ÓÈë',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => '±êÌâ',
	'fs_pic' => 'Êµ¼Ê´óÐ¡Í¼Æ¬',
	'del_success' => '³É¹¦É¾³ý',
	'ns_pic' => '±ê×¼´óÐ¡Í¼Æ¬',
	'err_del' => 'ÎÞ·¨É¾³ý',
	'thumb_pic' => 'ËõÍ¼',
	'comment' => 'ÆÀÂÛ',
	'im_in_alb' => 'Í¼Æ¬ÓÚÍ¼¼¯',
	'alb_del_success' => 'Í¼¼¯ \'%s\' ÒÑÉ¾³ý',
	'alb_mgr' => 'Í¼¼¯¹ÜÀí',
	'err_invalid_data' => '½ÓÊÕµ½²»ÕýÈ·µÄ×ÊÁÏÓÚ \'%s\'',
	'create_alb' => '´´½¨Í¼¼¯ \'%s\'',
	'update_alb' => '¸üÐÂÍ¼¼¯ \'%s\' ±êÌâÎª \'%s\' Ë÷ÒýÖµÎª \'%s\'',
	'del_pic' => 'É¾³ýÍ¼Æ¬',
	'del_alb' => 'É¾³ýÍ¼¼¯',
	'del_user' => 'É¾³ýÓÃ»§',
	'err_unknown_user' => 'ËùÑ¡ÔñµÄÓÃ»§²»´æÔÚ !',
	'comment_deleted' => 'ÆÀÂÛÒÑÉ¾³ý',
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
	'confirm_del' => 'È·¶¨ÒªÉ¾³ý´ËÍ¼Æ¬Âð ? \\nÁ¬Í¬ÆÀÂÛÒ²»á±»Ò»ÆðÉ¾³ý.',
	'del_pic' => 'É¾³ý´ËÍ¼Æ¬',
	'size' => '%s x %s ÏñËØ',
	'views' => '%s ´Î',
	'slideshow' => 'Á¬Ðø²¥·Å',
	'stop_slideshow' => 'Í£Ö¹Á¬Ðø²¥·Å',
	'view_fs' => 'µã»÷¹Û¿´ÕûÕÅÍ¼Æ¬',
);

$lang_picinfo = array(
	'title' =>'Í¼Æ¬ÐÅÏ¢',
	'Filename' => 'ÎÄ¼þÃû',
	'Album name' => 'Í¼¼¯Ãû³Æ',
	'Rating' => 'ÆÀ·Ö (%s ´ÎÍ¶Æ±)',
	'Keywords' => '¹Ø¼ü×Ö',
	'File Size' => 'ÎÄ¼þ´óÐ¡',
	'Dimensions' => '³ß´ç',
	'Displayed' => 'ÏÔÊ¾',
	'Camera' => 'Ïà»úÐÍºÅ',
	'Date taken' => 'ÅÄÉãÊ±¼ä',
	'Aperture' => '¹âÈ¦',
	'Exposure time' => 'ÆØ¹âÊ±¼ä',
	'Focal length' => '½¹¾à',
	'Comment' => '×¢ÊÍ',
	'addFav'=>'Ìí¼Óµ½ÎÒµÄÊÕ²Ø',
	'addFavPhrase'=>'ÎÒµÄÊÕ²Ø',
	'remFav'=>'´ÓÎÒµÄÊÕ²ØÉ¾³ý',
);

$lang_display_comments = array(
	'OK' => 'OK',
	'edit_title' => '±à¼­ÆÀÂÛ',
	'confirm_delete' => 'È·¶¨É¾³ý´ËÆÀÂÛ ?',
	'add_your_comment' => '·¢±íÆÀÂÛ',
	'name'=>'êÇ³Æ',
	'comment'=>'ÆÀÂÛ',
	'your_name' => 'ÄúµÄÃû×Ö',
);

$lang_fullsize_popup = array(
	'click_to_close' => 'Çëµã»÷Í¼Æ¬¹Ø±Õ´°¿Ú',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => '·¢ËÍµç×ÓºØ¿¨',
	'invalid_email' => '<b>¾¯¸æ</b> : ÎÞÐ§µÄ Email µØÖ·!',
	'ecard_title' => 'Çë²éÊÕ %s ¸øÄú¼ÄÀ´µÄµç×ÓºØ¿¨',
	'view_ecard' => 'Èç¹ûµç×ÓºØ¿¨ÎÞ·¨ÕýÈ·ÏÔÊ¾, Çëµã»÷Õâ¸öÁ´½Ó',
	'view_more_pics' => 'µã»÷ÕâÀïÐÀÉÍ¸ü¶àÍ¼Æ¬ !',
	'send_success' => 'ÄúµÄµç×ÓºØ¿¨ÒÑ·¢ËÍ',
	'send_failed' => '±§Ç¸,µ±Ç°ÎÞ·¨ÎªÄú·¢ËÍµç×ÓºØ¿¨...',
	'from' => '·¢ËÍÕß',
	'your_name' => 'ÄúµÄÃû×Ö',
	'your_email' => 'ÄúµÄ Email',
	'to' => '½ÓÊÕÕß',
	'rcpt_name' => 'ÊÕ¼þÈËÐÕÃû',
	'rcpt_email' => 'ÊÕ¼þÈË Email',
	'greetings' => '×£¸£Óï',
	'message' => 'ÐÅÏ¢ÄÚÈÝ',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => 'Í¼Æ¬&nbsp;ÐÅÏ¢',
	'album' => 'Í¼¼¯',
	'title' => '±êÌâ',
	'desc' => 'ÃèÊö',
	'keywords' => '¹Ø¼ü×Ö',
	'pic_info_str' => '%sx%s - %sKB - %s ´Îµã»÷ - %s ´ÎÍ¶Æ±',
	'approve' => 'ÉóºËÍ¼Æ¬',
	'postpone_app' => 'ÔÝ²»Åú×¼',
	'del_pic' => 'É¾³ýÍ¼Æ¬',
	'reset_view_count' => 'ÖØÖÃµã»÷´ÎÊý',
	'reset_votes' => 'ÖØÖÃÍ¶Æ±',
	'del_comm' => 'É¾³ýÆÀÂÛ',
	'upl_approval' => 'Åú×¼ÉÏ´«',
	'edit_pics' => '±à¼­Í¼Æ¬',
	'see_next' => 'ÏÂÒ»ÕÅÍ¼Æ¬',
	'see_prev' => 'ÉÏÒ»ÕÅÍ¼Æ¬',
	'n_pic' => '%s ÕÅÍ¼Æ¬',
	'n_of_pic_to_disp' => 'Í¼Æ¬ÏÔÊ¾ÊýÁ¿',
	'apply' => 'Ìá½»ÐÞ¸Ä'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => 'Èº×éÃû³Æ',
	'disk_quota' => '´ÅÅÌÏÞ¶î',
	'can_rate' => 'ÔÊÐíÎªÍ¼Æ¬ÆÀ·Ö',
	'can_send_ecards' => 'ÔÊÐí·¢ËÍµç×ÓºØ¿¨',
	'can_post_com' => 'ÔÊÐí·¢±íÆÀÂÛ',
	'can_upload' => 'ÔÊÐíÉÏ´«Í¼Æ¬',
	'can_have_gallery' => 'ÔÊÐí¸öÈËÍ¼¼¯',
	'apply' => 'Ìá½»ÐÞ¸Ä',
	'create_new_group' => '´´½¨ÐÂÈº×é',
	'del_groups' => 'É¾³ýËùÑ¡ÔñµÄÈº×é',
	'confirm_del' => '¾¯¸æ, Èç¹ûÉ¾³ýÒ»¸öÈº×é, ÔòÊôÓÚ¸ÃÈº×éµÄÓÃ»§½«±»×ªÒÆÖÁ \'Registered\' Èº×éÖÐ !Ò²¾ÍÊÇËµ,ËûÃÇ½«Ê§È¥²¿·ÝÈ¨ÏÞ\n\nÈ·¶¨ÒªÉ¾³ýÂð ?',
	'title' => '¹ÜÀíÓÃ»§Èº×é',
	'approval_1' => '¹«ÓÃÍ¼¼¯ÉÏ´«ÉóºË (1)',
	'approval_2' => '¸öÈËÍ¼¼¯ÉÏ´«ÉóºË (2)',
	'note1' => '<b>(1)</b> ÉÏ´«ÖÁ¹«ÓÃÍ¼¼¯µÄÍ¼Æ¬Ðè¹ÜÀíÕßÉóºË',
	'note2' => '<b>(2)</b> ÉÏ´«ÖÁ¸öÈËÍ¼¼¯µÄÍ¼Æ¬Ðè¹ÜÀíÕßÉóºË',
	'notes' => '×¢Òâ'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
	'welcome' => '»¶Ó­!'
);

$lang_album_admin_menu = array(
	'confirm_delete' => 'È·¶¨ÒªÉ¾³ý¸ÃÍ¼¼¯Âð ? \\n¸ÃÍ¼¼¯ÄÚËùÓÐÍ¼Æ¬ºÍÆÀÂÛ½«»áÍ¬Ê±±»É¾³ý.',
	'delete' => 'É¾³ý',
	'modify' => 'ÊôÐÔ',
	'edit_pics' => '±à¼­Í¼Æ¬',
);

$lang_list_categories = array(
	'home' => 'Ö÷Ò³',
	'stat1' => '<b>[pictures]</b> ÕÅÍ¼Æ¬ÓÚ <b>[albums]</b> ¸öÍ¼¼¯,<b>[cat]</b> ¸öÀà±ð,<b>[comments]</b> ¸öÆÀÂÛ,µã»÷ <b>[views]</b> ´Î',
	'stat2' => '<b>[pictures]</b> ÕÅÍ¼Æ¬ÓÚ <b>[albums]</b> ¸öÍ¼¼¯,µã»÷ <b>[views]</b> ´Î',
	'xx_s_gallery' => '%s µÄÍ¼¼¯',
	'stat3' => '<b>[pictures]</b> ÕÅÍ¼Æ¬ÓÚ <b>[albums]</b> ¸öÍ¼¼¯,<b>[comments]</b> ¸öÆÀÂÛ,µã»÷ <b>[views]</b> ´Î'
);

$lang_list_users = array(
	'user_list' => 'ÓÃ»§ÁÐ±í',
	'no_user_gal' => 'ÉÐÎ´ÓÐÓÃ»§Í¼¼¯',
	'n_albums' => '%s ¸öÍ¼¼¯',
	'n_pics' => '%s ÕÅÍ¼Æ¬'
);

$lang_list_albums = array(
	'n_pictures' => '%s ÕÅÍ¼Æ¬',
	'last_added' => ', ×îÐÂÌí¼ÓÓÚ %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => 'µÇÂ½',
	'enter_login_pswd' => 'ÇëÊäÈëÓÃ»§ÃûºÍÃÜÂëµÇÂ½',
	'username' => 'ÓÃ»§Ãû',
	'password' => 'ÃÜÂë',
	'remember_me' => '¼Ç×¡ÃÜÂë',
	'welcome' => '»¶Ó­ %s ...',
	'err_login' => '*** ÎÞ·¨µÇÂ½. ÇëÖØÊÔ ***',
	'err_already_logged_in' => 'ÄúÒÑ¾­µÇÂ½ !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => 'ÍË³ö',
	'bye' => 'ÔÙ¼û,%s ...',
	'err_not_loged_in' => 'ÄúÉÐÎ´µÇÂ½ !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => '¸üÐÂÍ¼¼¯ %s',
	'general_settings' => 'Ò»°ãÉèÖÃ',
	'alb_title' => 'Í¼¼¯±êÌâ',
	'alb_cat' => 'Í¼¼¯Àà±ð',
	'alb_desc' => 'Í¼¼¯ÃèÊö',
	'alb_thumb' => 'Í¼¼¯ËõÍ¼',
	'alb_perm' => 'Í¼¼¯Ðí¿ÉÈ¨ÏÞ',
	'can_view' => 'Í¼¼¯ÔÊÐí¹Û¿´±»',
	'can_upload' => '·Ã¿Í¿ÉÒÔÉÏ´«Í¼Æ¬',
	'can_post_comments' => '·Ã¿Í¿ÉÒÔ·¢±íÆÀÂÛ',
	'can_rate' => '·Ã¿Í¿ÉÒÔÎªÍ¼Æ¬ÆÀ·Ö',
	'user_gal' => 'ÓÃ»§Í¼¼¯',
	'no_cat' => '* Ã»ÓÐÀà±ð *',
	'alb_empty' => 'Í¼¼¯Îª¿Õ',
	'last_uploaded' => '×îÐÂÉÏ´«',
	'public_alb' => 'ÈÎºÎÈË (¹«ÓÃÍ¼¼¯)',
	'me_only' => 'Ö»ÓÐÎÒ',
	'owner_only' => 'Ö»ÓÐÍ¼¼¯ÓµÓÐÈË (%s)',
	'groupp_only' => 'Ö»ÓÐÈº×é»áÔ± \'%s\'',
	'err_no_alb_to_modify' => 'Êý¾Ý¿âÄÚÃ»ÓÐ¿ÉÒÔ±à¼­µÄÍ¼¼¯.',
	'update' => '¸üÐÂÍ¼¼¯'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => '±§Ç¸,ÄúÒÑ¾­Îª´ËÍ¼Æ¬ÆÀ¹ý·ÖÁË',
	'rate_ok' => 'ÄúµÄÍ¶Æ±ÒÑ¾­±»½ÓÊÜ',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
¹ÜÀíÔ±»á¾¡¿ìÕûÀíÄúµÄ×ÊÁÏ,µ«ÎÒÃÇ²»¿ÉÄÜËæÊ±ÏêÏ¸²ì¿´Ã¿Ò»¸öÎÄ¼þ. ±¾Õ¾ÓÐÈ¨ÀûÔÚÈÎºÎÊ±ºò¶ÔÄúÕÅÌùµÄÎÄ¼þ×öÊÊµ±µÄµ÷Õû.<br>
<br>
Äú±ØÐëÍ¬Òâ²»ÄÜÕÅÌùÈÎºÎÉ«Çé¡¢±©Á¦¡¢²»Á¼¡¢²»Õýµ±¡¢²»½¡¿µ¡¢·Áº¦¹ú¼Ò°²È«¡¢»òÆäËû·ÇÕýµ±È¡µÃµÄÎÄ¼þ.±¾Õ¾ÔÚÈÎºÎÊ±ºò¶¼ÓÐÈ¨Àû¹ýÂË²¢±à¼­ÄúÕÅÌùµÄÄÚÈÝ,
<br>
²¢ÓÐÈ¨ÐÞ¸ÄÄúÔÚ±¾Õ¾ÄÚµÄ×ÊÁÏ.µ«Çë·ÅÐÄ,ÎÒÃÇ²»»á½«ÄúµÄÈÎºÎ×ÊÁÏÍ¸Â©¸øÈÎºÎµÚÈý·½.³ý´ËÖ®Íâ,ÄúÔÚ±¾Õ¾ÕÅÌùµÄÄÚÈÝ±¾Õ¾¶¼²»¸ºÈÎºÎÔðÈÎ.<br>
<br>
±¾Õ¾Ê¹ÓÃCOOKIESÀ´´¢´æÐÅÏ¢.·½±ãÄú¸ü¿ìËÙÔÄ¶Á±¾Õ¾ÐÅÏ¢. ÄúµÄ Email Ö»ÊÇÓÃÀ´ÈÏÖ¤ÄúµÄ×ÊÁÏ,ÎÒÃÇ¾ø²»»áÍâÐ¹.<br>
<br>
°´ÏÂ 'ÎÒÍ¬Òâ' ¼ÌÐø.
EOT;

$lang_register_php = array(
	'page_title' => 'ÓÃ»§×¢²á',
	'term_cond' => 'Ìõ¼þÓë¹æÔò',
	'i_agree' => 'ÎÒÍ¬Òâ',
	'submit' => 'Ìá½»×¢²á',
	'err_user_exists' => '¸ÃÓÃ»§ÃûÒÑ´æÔÚ,ÇëÖØÌî',
	'err_password_mismatch' => 'Á½´ÎÃÜÂë²»Ò»ÖÂ,ÇëÖØÌî',
	'err_uname_short' => 'ÓÃ»§ÃûÖÁÉÙÐèÒª 2 ¸ö×Ö·û',
	'err_password_short' => 'ÃÜÂëÖÁÉÙÐèÒª 2 ¸ö×Ö·û',
	'err_uname_pass_diff' => 'ÓÃ»§ÃûºÍÃÜÂë²»¿ÉÒÔÏàÍ¬',
	'err_invalid_email' => 'Email ²»ÕýÈ·',
	'err_duplicate_email' => 'Õâ¸ö Email ÒÑ¾­±»ÆäËûÈËÊ¹ÓÃ¹ýÁË',
	'enter_info' => 'ÊäÈë×¢²áÕßÐÅÏ¢',
	'required_info' => '±ØÐèµÄ×ÊÁÏ',
	'optional_info' => '¿ÉÑ¡µÄ×ÊÁÏ',
	'username' => 'ÓÃ»§Ãû',
	'password' => 'ÃÜÂë',
	'password_again' => 'È·ÈÏÃÜÂë',
	'email' => 'Email',
	'location' => 'Î»ÖÃ',
	'interests' => 'ÐËÈ¤',
	'website' => 'Ö÷Ò³',
	'occupation' => 'Ö°Òµ',
	'error' => '´íÎó',
	'confirm_email_subject' => '%s - ×¢²áÈ·ÈÏ',
	'information' => 'ÐÅÏ¢',
	'failed_sending_email' => 'ÎÞ·¨·¢ËÍ×¢²áÈ·ÈÏ Email !',
	'thank_you' => '¸ÐÐ»ÄúµÄ×¢²á.<br><br>Ò»·âÄÚº¬ÈçºÎ¼¤»îÕÊºÅµÈÐÅÏ¢µÄ Email ÒÑ±»·¢ËÍµ½ÄúµÄÐÅÏä.',
	'acct_created' => 'ÄúµÄÕÊºÅÒÑÉú³É,ÏÖÔÚÄú¿ÉÒÔµÇÂ½',
	'acct_active' => 'ÄúµÄÕÊºÅÒÑ¼¤»î,ÏÖÔÚÄú¿ÉÒÔµÇÂ½',
	'acct_already_act' => 'ÄúµÄÕÊºÅÒÑ¾­¼¤»î !',
	'acct_act_failed' => '¸ÃÕÊºÅÎÞ·¨¼¤»î !',
	'err_unk_user' => 'ËùÑ¡ÔñµÄÓÃ»§²»´æÔÚ !',
	'x_s_profile' => '%s µÄ¸öÈË×ÊÁÏ',
	'group' => 'Èº×é',
	'reg_date' => '¼ÓÈë',
	'disk_usage' => '¿Õ¼äÊ¹ÓÃÁ¿',
	'change_pass' => 'ÐÞ¸ÄÃÜÂë',
	'current_pass' => '¾ÉÃÜÂë',
	'new_pass' => 'ÐÂÃÜÂë',
	'new_pass_again' => 'È·ÈÏÃÜÂë',
	'err_curr_pass' => '¾ÉÃÜÂë²»ÕýÈ·',
	'apply_modif' => 'Ìá½»ÐÞ¸Ä',
	'change_pass' => 'ÐÞ¸ÄÃÜÂë',
	'update_success' => 'ÄúµÄ¸öÈË×ÊÁÏÒÑ¸üÐÂ',
	'pass_chg_success' => 'ÄúµÄÃÜÂëÒÑÐÞ¸Ä',
	'pass_chg_error' => 'ÄúµÄÃÜÂëÃ»ÓÐÐÞ¸Ä',
);

$lang_register_confirm_email = <<<EOT
¸ÐÐ»Äú×¢²á {SITE_NAME}

ÄúµÄÕÊºÅ : "{USER_NAME}"
ÄúµÄÃÜÂë : "{PASSWORD}"

ÎªÁË¼¤»îÄúµÄÕÊºÅ,Äú±ØÐëµã»÷Ò»ÏÂÏÂÃæµÄÁ´½Ó
»òÕßÏÈ½«Õâ¸öÁ´½Ó´æÆðÀ´.ÒÔºóÔÙ¼¤»î.

{ACT_LINK}

¸ÐÐ»Äú,

 {SITE_NAME} ¾´ÉÏ

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => '²é¿´ÆÀÂÛ',
	'no_comment' => 'ÉÐÎÞÆÀÂÛ¿ÉÒÔ²é¿´',
	'n_comm_del' => '%s ¸öÆÀÂÛÒÑÉ¾³ý',
	'n_comm_disp' => 'ÒªÏÔÊ¾µÄÆÀÂÛÊýÁ¿',
	'see_prev' => '¿´ÉÏÒ»¸ö',
	'see_next' => '¿´ÏÂÒ»¸ö',
	'del_comm' => 'É¾³ýËùÑ¡µÄÆÀÂÛ',
);

// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => 'ËÑË÷Í¼Æ¬',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => 'ËÑË÷ÐÂÍ¼Æ¬',
	'select_dir' => 'Ñ¡ÔñÄ¿Â¼',
	'select_dir_msg' => '±¾¹¦ÄÜ¿ÉÒÔÈÃÄúÅúÁ¿¼ÓÈëÄúÓÃ FTP ÉÏ´«µÄÍ¼Æ¬.<br><br>ÇëÑ¡ÔñÄúËùÉÏ´«µÄÍ¼Æ¬Ä¿Â¼',
	'no_pic_to_add' => 'Ã»ÓÐÍ¼Æ¬¿ÉÒÔ¼ÓÈë',
	'need_one_album' => 'ÒªÊ¹ÓÃ´Ë¹¦ÄÜ±ØÐèÖÁÉÙÓÐÒ»¸öÍ¼¼¯',
	'warning' => '¾¯¸æ',
	'change_perm' => 'ÎÞ·¨Ð´ÈëÕâ¸öÄ¿Â¼, ÇëÐÞ¸Ä CHMOD Îª 755 »ò 777 ºóÔÙÊÔÒ»´Î!',
	'target_album' => '<b>¼ÓÈëÍ¼Æ¬ &quot;</b>%s<b>&quot; µ½ </b>%s',
	'folder' => 'ÎÄ¼þ¼Ð',
	'image' => 'Í¼Æ¬',
	'album' => 'Í¼¼¯',
	'result' => '½á¹û',
	'dir_ro' => 'ÎÞ·¨Ð´Èë. ',
	'dir_cant_read' => 'ÎÞ·¨¶ÁÈ¡. ',
	'insert' => 'ÐÂÔöÍ¼Æ¬ÖÁÍ¼¼¯',
	'list_new_pic' => 'ÁÐ³öÐÂÍ¼Æ¬',
	'insert_selected' => '¼ÓÈëËùÑ¡ÔñµÄÍ¼Æ¬',
	'no_pic_found' => 'Ã»ÓÐÕÒµ½ÐÂÍ¼Æ¬',
	'be_patient' => 'ÇëÉÔºò,³ÌÐòÐèÒªÒ»Ð©Ê±¼äÀ´¼ÓÈëËùÑ¡Í¼Æ¬',
	'notes' =>  '<ul>'.
				'<li><b>OK</b> : ±íÊ¾Í¼Æ¬ÒÑ³É¹¦¼ÓÈë'.
				'<li><b>DP</b> : ±íÊ¾Í¼Æ¬ÖØ¸´»òÒÑ´æÔÚ'.
				'<li><b>PB</b> : ±íÊ¾Í¼Æ¬ÎÞ·¨¼ÓÈë, Çë¼ì²éÏµÍ³ÉèÖÃ»òÍ¼Æ¬´æ·ÅÄ¿Â¼µÄ·ÃÎÊÈ¨ÏÞ'.
				'<li>Èç¹û OK, DP, PB \'·ûºÅ\' Ã»ÓÐÏÔÊ¾,Çëµã»÷Ëð»µµÄÍ¼Æ¬²é¿´ PHP ÏÔÊ¾µÄ´íÎóÐÅÏ¢'.
				'<li>Èç¹ûä¯ÀÀÆ÷³¬Ê±, ÇëµãË¢ÐÂ°´Å¥'.
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
                'title' => 'ÆÁ±ÎÓÃ»§',
                'user_name' => 'ÓÃ»§Ãû',
                'ip_address' => 'IPµØÖ·',
                'expiry' => 'ÆÚÏÞ£¨¿Õ±íÊ¾ÓÀ¾Ã£©',
                'edit_ban' => '±£´æÉèÖÃ',
                'delete_ban' => 'É¾³ý',
                'add_new' => 'Ìí¼ÓÆÁ±ÎÓÃ»§',
                'add_ban' => 'Ìí¼Ó',
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
	'title' => 'ÉÏ´«Í¼Æ¬',
	'max_fsize' => '¿ÉÔÊÐíµÄÎÄ¼þ×î´óÎª %s KB',
	'album' => 'Í¼¼¯',
	'picture' => 'Í¼Æ¬',
	'pic_title' => 'Í¼Æ¬±êÌâ',
	'description' => 'Í¼Æ¬ÃèÊö',
	'keywords' => '¹Ø¼ü×Ö (ÇëÒÔ¿Õ¸ñ·Ö¸ô)',
	'err_no_alb_uploadables' => 'Ä¿Ç°ÉÐÎÞÍ¼¼¯ÔÊÐíÄúÉÏ´«Í¼Æ¬',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => 'ÓÃ»§¹ÜÀí',
	'name_a' => 'Ãû³ÆÉý´ÎÅÅÐò',
	'name_d' => 'Ãû³Æ½µ´ÎÅÅÐò',
	'group_a' => 'Èº×éÉý´ÎÅÅÐò',
	'group_d' => 'Èº×é½µ´ÎÅÅÐò',
	'reg_a' => '×¢²áÈÕÆÚÉý´ÎÅÅÐò',
	'reg_d' => '×¢²áÈÕÆÚ½µ´ÎÅÅÐò',
	'pic_a' => 'Í¼Æ¬ÊýÉý´ÎÅÅÐò',
	'pic_d' => 'Í¼Æ¬Êý½µ´ÎÅÅÐò',
	'disku_a' => '¿Õ¼äÊ¹ÓÃÉý´ÎÅÅÐò',
	'disku_d' => '¿Õ¼äÊ¹ÓÃ½µ´ÎÅÅÐò',
	'sort_by' => 'ÓÃ»§ÅÅÐòÒÀ',
	'err_no_users' => 'ÓÃ»§×ÊÁÏ±íÊÇ¿ÕµÄ !',
	'err_edit_self' => 'ÄúÎÞ·¨±à¼­¸öÈË×ÊÁÏ, ÇëÊ¹ÓÃ \'ÎÒµÄ¸öÈË×ÊÁÏ\' À´±à¼­',
	'edit' => '±à¼­',
	'delete' => 'É¾³ý',
	'name' => 'ÓÃ»§Ãû',
	'group' => 'Èº×é',
	'inactive' => 'Î´¼¤»î',
	'operations' => '²Ù×÷',
	'pictures' => 'Í¼Æ¬',
	'disk_space' => '¿Õ¼ä Ê¹ÓÃÁ¿/×ÜÁ¿',
	'registered_on' => '×¢²áÈÕÆÚ',
	'u_user_on_p_pages' => '%d ¸öÓÃ»§ÓÚ %d Ò³',
	'confirm_del' => 'È·¶¨ÒªÉ¾³ýÕâ¸öÓÃ»§Âð ? \\nÁ¬Í¬ËûµÄÍ¼¼¯¼°Í¼Æ¬¶¼»á±»É¾³ý.',
	'mail' => 'MAIL',
	'err_unknown_user' => 'ËùÑ¡ÔñµÄÓÃ»§²»´æÔÚ !',
	'modify_user' => '±à¼­ÓÃ»§',
	'notes' => '×¢Òâ',
	'note_list' => '<li>Èç¹ûÄú²»ÏëÐÞ¸Äµ±Ç°ÃÜÂë, Çë½« "ÃÜÂë" À¸Áô¿Õ',
	'password' => 'ÃÜÂë',
	'user_active' => 'ÓÃ»§¼¤»î',
	'user_group' => 'ÓÃ»§Èº×é',
	'user_email' => 'ÓÃ»§ Email',
	'user_web_site' => 'ÓÃ»§Ö÷Ò³',
	'create_new_user' => '´´½¨ÐÂÓÃ»§',
	'user_location' => 'ÓÃ»§Î»ÖÃ',
	'user_interests' => 'ÓÃ»§ÐËÈ¤',
	'user_occupation' => 'ÓÃ»§Ö°Òµ',
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => 'µ÷ÕûÍ¼Æ¬´óÐ¡',
        'what_it_does' => 'ÕâÊÇ×öÊ²Ã´ÓÃµÄ',
        'what_update_titles' => '´ÓÎÄ¼þÃûÈ¡µÃ±êÌâ',
        'what_delete_title' => 'É¾³ý±êÌâ',
        'what_rebuild' => 'ÖØÉèËõÍ¼¼°µ÷Õû¹ý´óÐ¡µÄÍ¼Æ¬',
        'what_delete_originals' => 'É¾³ýÔ­Ê¼´óÐ¡µÄÍ¼Æ¬²¢ÒÔµ÷Õû¹ý´óÐ¡µÄÈ¡´ú',
        'file' => 'ÎÄ¼þ',
        'title_set_to' => '±êÌâÒÑÉè³É',
       'submit_form' => 'Ìá½»',
        'updated_succesfully' => '¸üÐÂ³É¹¦',
        'error_create' => 'ÐÂÔö´íÎó',
        'continue' => '¼ÌÐø´¦ÀíÍ¼Æ¬',
        'main_success' => 'Í¼Æ¬ %s ÒÑ³É¹¦ÉèÎªÖ÷ÒªÍ¼Æ¬',
        'error_rename' => 'ÎÞ·¨½« %s ¸üÃû³É %s',
        'error_not_found' => 'ÎÄ¼þ %s ²»´æÔÚ',
        'back' => '·µ»ØÖ÷½çÃæ',
        'thumbs_wait' => 'ÕýÔÚ¸üÐÂËõÍ¼¼°(»ò)µ÷Õû¹ý´óÐ¡µÄÍ¼Æ¬,ÇëÉÔºò...',
        'thumbs_continue_wait' => '¼ÌÐø¸üÐÂËõÍ¼¼°(»ò)µ÷Õû¹ý´óÐ¡µÄÍ¼Æ¬...',
        'titles_wait' => '±êÌâ¸üÐÂÖÐ,ÇëÉÔºò...',
        'delete_wait' => 'ÕýÔÚÉ¾³ý±êÌâ,ÇëÉÔºò...',
        'replace_wait' => 'ÕýÔÚÒÔµ÷Õû¹ý´óÐ¡µÄÍ¼Æ¬È¡´úÔ­Ê¼´óÐ¡Í¼Æ¬,ÇëÉÔºò...',
        'instruction' => '¼òÒ×²Ù×÷ËµÃ÷',
        'instruction_action' => 'ÇëÑ¡Ôñ²Ù×÷',
        'instruction_parameter' => 'Éè¶¨²ÎÊý',
        'instruction_album' => 'Ñ¡ÔñÍ¼¼¯',
        'instruction_press' => 'Çë°´ %s',
        'update' => '¸üÐÂËõÍ¼¼°(»ò)µ÷Õû¹ý´óÐ¡µÄÍ¼Æ¬',
        'update_what' => 'Òª¸üÐÂÊ²Ã´',
        'update_thumb' => 'Ö»ÓÐËõÍ¼',
        'update_pic' => 'Ö»ÓÐµ÷Õû¹ý´óÐ¡µÄÍ¼Æ¬',
        'update_both' => 'ËõÍ¼¼°µ÷Õû¹ý´óÐ¡µÄÍ¼Æ¬',
        'update_number' => 'Ã¿µãÑ¡Ò»´ÎÒª´¦ÀíµÄÍ¼Æ¬ÊýÄ¿',
        'update_option' => '(Èç¹ûÄúÓöµ½²Ù×÷³ÌÐò³¬Ê±µÄÎÊÌâ,ÇëÊÔ×Å¼õÐ¡´ËÉè¶¨)',
        'filename_title' => 'ÎÄ¼þÃûÍ¼Æ¬±êÌâ',
        'filename_how' => 'ÈçºÎÐÞ¸ÄÎÄ¼þÃû',
        'filename_remove' => 'É¾³ý .jpg ²¢½« _ (ÏÂ»®Ïß) ÓÃ¿Õ¸ñÈ¡´ú',
        'filename_euro' => '½« 2003_11_23_13_20_20.jpg ¸Ä³É 23/11/2003 13:20',
        'filename_us' => '½« 2003_11_23_13_20_20.jpg ¸Ä³É 11/23/2003 13:20',
        'filename_time' => '½« 2003_11_23_13_20_20.jpg ¸Ä³É 13:20',
        'delete' => 'É¾³ýÍ¼Æ¬±êÌâ»òÔ­Ê¼³ß´çµÄÍ¼Æ¬',
        'delete_title' => 'É¾³ýÍ¼Æ¬±êÌâ',
        'delete_original' => 'É¾³ýÔ­Ê¼³ß´çµÄÍ¼Æ¬',
        'delete_replace' => 'É¾³ýÔ­Ê¼³ß´çµÄÍ¼Æ¬²¢ÒÔµ÷Õû¹ý´óÐ¡µÄÍ¼Æ¬È¡´ú',
        'select_album' => 'Ñ¡ÔñÍ¼¼¯',
);

?>