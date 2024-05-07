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
'lang_name_native' => 'ÇÑ±¹¾î', //the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol'
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
$lang_yes = '¿¹';
$lang_no  = '¾Æ´Ï¿À';
$lang_back = 'µÚ·Î';
$lang_continue = '´ÙÀ½';
$lang_info = '¾È³»';
$lang_error = '¿¡·¯';

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
	'random' => 'Æ÷Åä´º½º °¶·¯¸®',
        'lastup' => 'ÃÖ±Ù ÀÌ¹ÌÁö',
        'lastalb'=> 'ÃÖ±Ù ¼öÁ¤µÈ ¾Ù¹ü', //new in cpg1.2.0
        'lastcom' => 'ÃÖ±Ù ÄÚ¸àÆ®',
        'topn' => 'ÃÖ´Ù Á¶È¸',
        'toprated' => 'ÃÖ°í ÆòÁ¡',
        'lasthits' => '¸¶Áö¸· Á¶È¸',
        'search' => '°Ë»ö °á°ú', //new in cpg1.2.0
        'favpics'=> '¼±È£ »çÁø' //new in cpg1.2.0
);

$lang_errors = array(
        'access_denied' => 'È¸¿ø´ÔÀÇ ±ÇÇÑÀ¸·Î ÀÌÆäÁö¸¦ º¸½Ç ¼ö ¾ø½À´Ï´Ù. °ü¸®ÀÚ¿¡°Ô ¹®ÀÇÇÏ¼¼¿ä.',
        'perm_denied' => 'È¸¿ø´ÔÀÇ ±ÇÇÑÀ¸·Î ½ÇÇàÇÒ ¼ö ¾ø´Â ¸í·ÉÀÔ´Ï´Ù.',
        'param_missing' => 'ÇÊ¼öÇ×¸ñÀ» È®ÀÎÇÏ¼¼¿ä.',
        'non_exist_ap' => '¼±ÅÃÇÑ ¾Ù¹üÀÌ³ª ÀÌ¹ÌÁö°¡ Á¸ÀçÇÏÁö ¾Ê½À´Ï´Ù !',
        'quota_exceeded' => 'ÇÒ´ç¿ë·® ÃÊ°ú,<br /><br />ÇÒ´çµÈ µð½ºÅ©[quota]K, »ç¿ë°¡´ÉÇÑ ¿ë·®[space]K, ÇÒ´ç¿ë·® ÃÊ°ú·Î ¾÷·ÎµåÇÒ ¼ö ¾øÀ½.',
        'gd_file_type_err' => 'JPEG¿Í PNGÆÄÀÏ¸¸ Áö¿øµÊ.',
        'invalid_image' => 'ºñÁ¤»ó ÆÄÀÏ ¶Ç´Â °¶·¯¸®¿¡¼­ Áö¿øµÇÁö¾Ê´Â ÆÄÀÏÀÔ´Ï´Ù.',
        'resize_failed' => '½æ³×ÀÏÀÌ »ý¼ºµÇÁö ¾Ê¾Ò½À´Ï´Ù.È¤Àº »çÁøÅ©±â¸¦ ¹Ù²Ü ¼ö ¾ø½À´Ï´Ù.',
        'no_img_to_display' => 'Ç¥½ÃÇÒ ÀÌ¹ÌÁö°¡ ¾ø½À´Ï´Ù.',
        'non_exist_cat' => '¼±ÅÃÇÑ Ä«Å×°í¸®´Â Á¸ÀçÇÏÁö ¾Ê½À´Ï´Ù.',
        'orphan_cat' => '»óÀ§ Ä«Å×°í¸®°¡ Á¸ÀçÇÏÁö¾Ê½À´Ï´Ù. °ü¸®ÀÚ¿¡°Ô ¹®ÀÇÇÏ¼¼¿ä.',
        'directory_ro' => 'Æú´õ \'%s\' ¿¡ ¾²±â¸¦ ÇÒ ¼ö ¾ø½À´Ï´Ù. »çÁøÀ» Áö¿ï ¼ö ¾ø½À´Ï´Ù.',
        'non_exist_comment' => '¼±ÅÃÇÑ ÄÚ¸àÆ®´Â Á¸ÀçÇÏÁö ¾Ê½À´Ï´Ù.',
        'pic_in_invalid_album' => 'Á¸ÀçÇÏÁö¾Ê´Â ¾Ù¹üÀÌ¹ÌÁö(%s)!?', //new in cpg1.2.0
        'banned' => '±ÍÇÏ´Â Áö±Ý ÀÌ»çÀÌÆ®ÀÇ »ç¿ë±ÝÁöÀÚ¸í´Ü¿¡ ÀÖ½À´Ï´Ù.', //new in cpg1.2.0
        'not_with_udb' => 'ÀÌ±â´ÉÀ» ÄíÆÛ¸¶ÀÎ¿¡¼­ »ç¿ëÇÒ ¼ö ¾ø½À´Ï´Ù. ÀÌ±â´ÉÀº Æ÷·³¼ÒÇÁÆ®¿þ¾î¿¡ Æ÷ÇÔÀÌ µÇ¾î ÀÖ±â ¶§¹®ÀÔ´Ï´Ù.', //new in cpg1.2.0
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
        'alb_list_title' => '¾Ù¹ü¸ñ·ÏÀ¸·Î',
        'alb_list_lnk' => '¾Ù¹ü¸ñ·Ï',
        'my_gal_title' => '°³ÀÎ°¶·¯¸®·Î',
        'my_gal_lnk' => '°³ÀÎ°¶·¯¸®',
        'my_prof_lnk' => '°³ÀÎÁ¤º¸',
        'adm_mode_title' => '°ü¸®¸ðµå·Î ÀüÈ¯',
        'adm_mode_lnk' => '°ü¸®¸ðµå',
        'usr_mode_title' => 'ÀÏ¹Ý¸ðµå·Î ÀüÈ¯',
        'usr_mode_lnk' => 'ÀÏ¹Ý¸ðµå',
	'upload_pic_title' => '¾Ù¹ü¿¡ ÀÌ¹ÌÁö ¾÷·Îµå',
	'upload_pic_lnk' => 'ÀÌ¹ÌÁö¾÷·Îµå',
        'register_title' => '°èÁ¤»ý¼º',
        'register_lnk' => 'È¸¿øµî·Ï',
        'login_lnk' => '·Î±×ÀÎ',
        'logout_lnk' => '·Î±×¾Æ¿ô',
	'lastup_lnk' => 'ÃÖ±ÙÀÌ¹ÌÁö',
        'lastcom_lnk' => 'ÃÖ±ÙÄÚ¸àÆ®',
        'topn_lnk' => 'ÃÖ´ÙÁ¶È¸',
        'toprated_lnk' => 'ÃÖ°íÆòÁ¡',
        'search_lnk' => '°Ë»ö',
        'fav_lnk' => 'Áñ°ÜÃ£±â', //new in cpg1.2.0

);

$lang_gallery_admin_menu = array(
        'upl_app_lnk' => '¾÷·Îµå½ÂÀÎ',
        'config_lnk' => 'È¯°æ¼³Á¤',
        'albums_lnk' => '¾Ù¹ü°ü¸®',
        'categories_lnk' => 'Ä«Å×°í¸®°ü¸®',
        'users_lnk' => 'È¸¿ø°ü¸®',
        'groups_lnk' => '±×·ì°ü¸®',
        'comments_lnk' => 'ÄÚ¸àÆ®°ü¸®',
        'searchnew_lnk' => 'FTP¾÷·ÎµåÆÄÀÏ¿¬°á',
        'util_lnk' => 'ÀÌ¹ÌÁöÅ©±â ¼öÁ¤', //new in cpg1.2.0
        'ban_lnk' => '»ç¿ë±ÝÁöÀÚ', //new in cpg1.2.0
);

$lang_user_admin_menu = array(
        'albmgr_lnk' => '°³ÀÎ¾Ù¹ü »ý¼º ¹× °ü¸®',
        'modifyalb_lnk' => '°³ÀÎ¾Ù¹ü ¼öÁ¤',
        'my_prof_lnk' => '°³ÀÎÁ¤º¸',
);

$lang_cat_list = array(
        'category' => 'Ä«Å×°í¸®',
        'albums' => '¾Ù¹ü',
        'pictures' => 'ÀÌ¹ÌÁö',
);

$lang_album_list = array(
        'album_on_page' => '¾Ù¹ü %d  ÆäÀÌÁö %d'
);

$lang_thumb_view = array(
        'date' => 'ÀÏÀÚ',
        //Sort by filename and title
        'name' => 'ÆÄÀÏÀÌ¸§', //new in cpg1.2.0
        'title' => 'Á¦¸ñ', //new in cpg1.2.0
        'sort_da' => 'ÀÏÀÚ¼ø ¼øÂ÷¹è¿­',
        'sort_dd' => 'ÀÏÀÚ¼ø ¿ªÂ÷¹è¿­',
        'sort_na' => 'ÀÌ¸§¼ø ¼øÂ÷¹è¿­',
        'sort_nd' => 'ÀÌ¸§¼ø ¿ªÂ÷¹è¿­',
        'sort_ta' => 'Á¦¸ñ¼ø ¼øÂ÷¹è¿­', //new in cpg1.2.0
        'sort_td' => 'Á¦¸ñ¼ø ¿ªÂ÷¹è¿­', //new in cpg1.2.0
        'pic_on_page' => '»çÁø: %d  ÆäÀÌÁö: %d',
        'user_on_page' => '»ç¿ëÀÚ: %d  ÆäÀÌÁö: %d'
);

$lang_img_nav_bar = array(
        'thumb_title' => '¸ñ·ÏÀ¸·Î µ¹¾Æ°¡±â',
	'pic_info_title' => '»ó¼¼Á¤º¸ º¸±â/¼û±â±â',
        'slideshow_title' => '½½¶óÀÌµå¼î',
        'ecard_title' => 'ÀÌ¹ÌÁö¸¦ e-card·Î º¸³»±â',
        'ecard_disabled' => 'e-card·Î º¸³»±â ±ÝÁö',
        'ecard_disabled_msg' => 'e-card º¸³»±â ±ÇÇÑ¾ø½¿',
        'prev_title' => 'ÀÌÀü',
        'next_title' => '´ÙÀ½',
	'pic_pos' => 'µî·Ï ÀÌ¹ÌÁö %s/%s',
);

$lang_rate_pic = array(
        'rate_this_pic' => 'Æò°¡',
        'no_votes' => '(Æò°¡¾øÀ½)',
        'rating' => '(ÇöÀçÆòÁ¡ : %s / 5 Æò°¡È½¼ö %s È¸)',
        'rubbish' => '¾ÆÁÖ³ª»Ý',
        'poor' => '³ª»Ý',
        'fair' => 'º¸Åë',
        'good' => 'ÁÁÀ½',
        'excellent' => '¾ÆÁÖÁÁÀ½',
        'great' => 'ÃÖ»ó',
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
        CRITICAL_ERROR => '½É°¢ÇÑ ¿À·ù¹ß»ý',
        'file' => 'ÆÄÀÏ: ',
        'line' => 'ÁÙ: ',
);

$lang_display_thumbnails = array(
        'filename' => 'ÆÄÀÏÀÌ¸§ : ',
        'filesize' => 'ÆÄÀÏÅ©±â : ',
        'dimensions' => '°¡·Î,¼¼·Î : ',
        'date_added' => 'µî·ÏÀÏ : '
);

$lang_get_pic_data = array(
        'n_comments' => '%s ÄÚ¸àÆ®',
        'n_views' => '%s Á¶È¸',
        'n_votes' => '%s Æò°¡'
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
        0 => 'ÀÏ¹Ý¸ðµå·Î ÀüÈ¯ÇÕ´Ï´Ù...',
        1 => '°ü¸®¸ðµå·Î ÀüÈ¯ÇÕ´Ï´Ù...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
        'alb_need_name' => '¾Ù¹üÀÌ¸§ÀÌ ÇÊ¿äÇÕ´Ï´Ù !',
        'confirm_modifs' => 'º¯°æ»çÇ×À» ÀúÀåÇÏ½Ã°Ú½À´Ï±î ?',
        'no_change' => 'º¯°æ»çÇ×ÀÌ ¾ø½À´Ï´Ù !',
        'new_album' => '»õ ¾Ù¹ü',
        'confirm_delete1' => '¾Ù¹üÀ» »èÁ¦ÇÏ½Ã°Ú½À´Ï±î ?',
	'confirm_delete2' => '\n¾Ù¹ü¿¡ µî·ÏµÈ ÀÌ¹ÌÁö¿Í ÄÚ¸àÆ®¸¦ ¸ðµÎ »èÁ¦ÇÕ´Ï´Ù !',
        'select_first' => '¸ÕÀú ¾Ù¹üÀ» ¼±ÅÃÇÏ¼¼¿ä',
        'alb_mrg' => '¾Ù¹ü°ü¸®',
        'my_gallery' => '* °³ÀÎ¾Ù¹ü *',
        'no_category' => '* ÃÖ»óÀ§ Ä«Å×°í¸®(¸ÞÀÎ) *',
        'delete' => '»èÁ¦',
        'new' => '»ý¼º',
        'apply_modifs' => 'º¯°æµî·Ï',
        'select_category' => 'Ä«Å×°í¸® ¼±ÅÃ',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
        'miss_param' => 'Parameters required for \'%s\'operation not supplied !',
        'unknown_cat' => '¼±ÅÃÇÑ Ä«Å×°í¸®´Â Á¸ÀçÇÏÁö ¾Ê½À´Ï´Ù.',
        'usergal_cat_ro' => 'È¸¿ø °¶·¯¸®´Â »èÁ¦ÇÒ ¼ö ¾ø½À´Ï´Ù !',
        'manage_cat' => 'Ä«Å×°í¸®°ü¸®',
        'confirm_delete' => 'Ä«Å×°í¸®¸¦ »èÁ¦ÇÏ½Ã°Ú½À´Ï±î ?',
        'category' => 'Ä«Å×°í¸®',
        'operations' => '½ÇÇà¸Þ´º',
        'move_into' => 'Ä«Å×°í¸® º¯°æ',
        'update_create' => 'Ä«Å×°í¸® »ý¼º/º¯°æ',
        'parent_cat' => '»óÀ§ Ä«Å×°í¸®',
        'cat_title' => 'Ä«Å×°í¸® ÀÌ¸§',
        'cat_desc' => 'Ä«Å×°í¸® ¼³¸í'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
        'title' => '¼³Á¤º¯°æ',
        'restore_cfg' => '±âº»¼³Á¤À¸·Î',
        'save_cfg' => 'º¯°æ»çÇ×ÀúÀå',
        'notes' => '³ëÆ®',
        'info' => 'Á¤º¸',
        'upd_success' => 'º¯°æ»çÇ×ÀÌ Àû¿ëµÇ¾ú½À´Ï´Ù!',
        'restore_success' => '±âº»¼³Á¤À¸·Î º¯°æµÇ¾ú½À´Ï´Ù',
        'name_a' => 'ÀÌ¸§¼ø ¼øÂ÷¹è¿­',
        'name_d' => 'ÀÌ¸§¼ø ¿ªÂ÷¹è¿­',
        'title_a' => 'Á¦¸ñ¼ø ¼øÂ÷¹è¿­', //new in cpg1.2.0
        'title_d' => 'Á¦¸ñ¼ø ¿ªÂ÷¹è¿­', //new in cpg1.2.0
        'date_a' => 'ÀÏÀÚ¼ø ¼øÂ÷¹è¿­',
        'date_d' => 'ÀÏÀÚ¼ø ¿ªÂ÷¹è¿­',
        'th_any' => 'Max Aspect',
        'th_ht' => 'Height',
        'th_wd' => 'Width',
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'±âº»¼³Á¤',
        array('°¶·¯¸® ÀÌ¸§', 'gallery_name', 0),
        array('°¶·¯¸® ¼³¸í', 'gallery_description', 0),
        array('°ü¸®ÀÚ ÀÌ¸ÞÀÏ', 'gallery_admin_email', 0),
        array('e-cardÀÇ »ó¼¼Á¤º¸¿¡ ¸µÅ©µÉ URL', 'ecards_more_pic_target', 0),
        array('¾ð¾î¼±ÅÃ', 'lang', 5),
        array('Å×¸¶¼±ÅÃ', 'theme', 6),

        '¾Ù¹ü¸ñ·Ï ¼³Á¤',
        array('¸ÞÀÎÅ×ÀÌºíÀÇ Æø (pixels or %)', 'main_table_width', 0),
        array('Ç¥½ÃÇÒ Ä«Å×°í¸® ·¹º§¼ö', 'subcat_level', 0),
        array('Ç¥½ÃÇÒ ¾Ù¹ü ¼ö', 'albums_per_page', 0),
        array('¾Ù¹üÀÇ ¼¼·Î ¿­', 'album_list_cols', 0),
        array('½æ³×ÀÏ Å©±â(pixels)', 'alb_list_thumb_size', 0),
        array('¸ÞÀÎÆäÀÌÁö¿¡ ºÒ·¯¿Ã ÄÁÅÙÆ®', 'main_page_layout', 0),
        array('Ä«Å×°í¸®ÀÇ 1Â÷·¹º§ ¾Ù¹ü½æ³×ÀÏ º¸±â','first_level',1), //new in cpg1.2.0

        '½æ³×ÀÏ¸ñ·Ï ¼³Á¤',
        array('½æ³×ÀÏ ÄÃ·³¼ö', 'thumbcols', 0),
        array('½æ³×ÀÏ Çà¼ö', 'thumbrows', 0),
        array('ºÒ·¯¿Ã ½æ³×ÀÏ ÃÑ¼ö', 'max_tabs', 0),
        array('½æ³×ÀÏ°ú ÇÔ²² »ó¼¼Á¤º¸ Ãâ·Â', 'caption_in_thumbview', 1),
        array('½æ³×ÀÏ°ú ÇÔ²² ÄÚ¸àÆ®¼ö¸¦ Ãâ·Â', 'display_comment_count', 1),
        array('ÀÌ¹ÌÁö Á¤·Ä¹æ¹ý', 'default_sort_order', 3),
        array('ÃÖ°íÆòÁ¡¿¡ ³ªÅ¸³¾ ÃÖ¼Ò Æò°¡È½¼ö', 'min_votes_for_rating', 0),

        'ÀÌ¹ÌÁöº¸±â¸Þ´º ¹× ÄÚ¸àÆ® ¼³Á¤',
	array('ÀÌ¹ÌÁöº¸±â Å×ÀÌºíÀÇ Æø(pixels or %)', 'picture_table_width', 0),
	array('ÀÌ¹ÌÁöÀÇ »ó¼¼Á¤º¸¸¦ ±âº»ÀûÀ¸·Î Ãâ·Â', 'display_pic_info', 1),
	array('»ç¿ë±ÝÁö¾î ÇÊÅÍ¸µ »ç¿ë', 'filter_bad_words', 1),
	array('ÄÚ¸àÆ®¿¡ ½º¸¶ÀÏ ¾ÆÀÌÄÜ »ç¿ë', 'enable_smilies', 1),
	array('ÀÌ¹ÌÁö ¼³¸í ÃÖ´ë ¹®ÀÚ¼ö', 'max_img_desc_length', 0),
	array('´Ü¾î¹®ÀÚ ±æÀÌ(¶ç¿ö¾²±â¾øÀÌ)', 'max_com_wlength', 0),
	array('ÄÚ¸àÆ® ¶óÀÎ Á¦ÇÑ', 'max_com_lines', 0),
	array('ÄÚ¸àÆ® ÃÊ´ë ¹®ÀÚ¼ö', 'max_com_size', 0),
        array('ÇÊ¸§½ºÆ®¸³ º¸±â', 'display_film_strip', 1), //new in cpg1.2.0
        array('ÇÊ¸§½ºÆ®¸³ÀÇ Ç×¸ñ°¹¼ö', 'max_film_strip_items', 0), //new in cpg1.2.0

        'ÀÌ¹ÌÁö ¹× ½æ³×ÀÏ ¼³Á¤',
        array('JPEG Ä÷¸®Æ¼', 'jpeg_qual', 0),
        array('½æ³×ÀÏ °¡·Î,¼¼·Î ÃÖ´ë<b>*</b>', 'thumb_width', 0), //new in cpg1.2.0
        array('µð¸àÁÔ»ç¿ë (°¡·Î È¤Àº ¼¼·Î È¤Àº ½æ³×ÀÏÀÇ ÃÖ´ë¸ð¾ç)<b>*</b>', 'thumb_use', 7), //new in cpg1.2.0
        array('ÀÌ¹ÌÁö º¸±â¿¡ »õ·Î¿î ÆÄÀÏ»ý¼º','make_intermediate',1),
	array('»õ·Î »ý¼ºµÉ ÆÄÀÏÀÇ ÃÖ´ëÅ©±â(Æø)<b>*</b>', 'picture_width', 0),
        array('¾÷·Îµå ÀÌ¹ÌÁö ÃÖ´ë¿ë·® (KB)', 'max_upl_size', 0),
	array('¾÷·Îµå ÀÌ¹ÌÁö °¡·Î,¼¼·Î ÃÖ´ëÅ©±â(pixels)', 'max_upl_width_height', 0),

	'»ç¿ë»ç(È¸¿ø)¼³Á¤',
        array('È¸¿ø°¡ÀÔ Çã¿ë', 'allow_user_registration', 1),
	array('È¸¿ø°¡ÀÔ½Ã ÀÌ¸ÞÀÏ À¯È¿¿©ºÎ °ËÁõ', 'reg_requires_valid_email', 1),
	array('ÀÌ¸ÞÀÏ Áßº¹Çã¿ë ¿©ºÎ', 'allow_duplicate_emails_addr', 1),
	array('»ç¿ëÀÚ °³ÀÎ¾Ù¹ü »ý¼º Çã¿ë', 'allow_private_albums', 1),

        'Custom fields for image description (leave blank if unused)',
        array('Field 1 name', 'user_field1_name', 0),
        array('Field 2 name', 'user_field2_name', 0),
        array('Field 3 name', 'user_field3_name', 0),
        array('Field 4 name', 'user_field4_name', 0),

        'ÀÌ¹ÌÁö¿Í ½æ³×ÀÏ °í±Þ¼³Á¤',
        array('·Î±×ÀÎ µÇÁö ¾ÊÀº »ç¿ëÀÚ¿¡°Ô °³ÀÏ¾Ù¹ü ¾ÆÀÌÄÜ º¸¿©ÁÖ±â','show_private',1), //new in cpg1.2.0
        array('ÆÄÀÏ ÀÌ¸§¿¡ »ç¿ë±ÝÁöÇÒ ¹®ÀÚ', 'forbiden_fname_char',0),
        array('Çã¿ëÇÒ ÀÌ¹ÌÁöÆÄÀÏ È®ÀåÀÚ', 'allowed_file_extensions',0),
        array('ÀÌ¹ÌÁö Å©±âÁ¶Àý ¹æ¹ý','thumb_method',2),
        array('Path to ImageMagick \'convert\' utility (example /usr/bin/X11/)', 'impath', 0),
        array('Allowed image types (only valid for ImageMagick)', 'allowed_img_types',0),
        array('Command line options for ImageMagick', 'im_options', 0),
        array('Read EXIF data in JPEG files', 'read_exif_data', 1),
	array('¾Ù¹ü µð·ºÅä¸® °æ·Î <b>*</b>', 'fullpath', 0),
	array('»ç¿ëÀÚ(È¸¿ø) ¾÷·Îµå ÀÌ¹ÌÁö °æ·Î <b>*</b>', 'userpics', 0),
	array('»õ·Î »ý¼ºµÉ ÀÌ¹ÌÁöÀÇ Á¢µÎ¾î <b>*</b>', 'normal_pfx', 0),
	array('½æ³×ÀÏÀÇ Á¢µÎ¾î <b>*</b>', 'thumb_pfx', 0),
	array('µð·ºÅä¸® ±âº» ÆÛ¹Ì¼Ç', 'default_dir_mode', 0),
        array('ÀÌ¹ÌÁö ±âº» ÆÛ¹Ì¼Ç', 'default_file_mode', 0),

        'ÄíÅ° ¹× ¹®¼­ ÀÎÄÚµù ¼³Á¤',
        array('ÄíÅ°ÀÌ¸§', 'cookie_name', 0),
        array('ÄíÅ°°æ·Î', 'cookie_path', 0),
        array('ÀÎÄÚµù', 'charset', 4),

        '±âÅ¸¼³Á¤',
        array('Enable debug mode', 'debug_mode', 1),

	'<br /><div align="center"> * Ç¥½ÃµÈ ºÎºÐÀÇ ¿É¼ÇÀº ÀÌ¹ÌÁö°¡ µî·ÏµÈ ÀÌÈÄ¿¡ º¯°æÇÏÁö ¸¶¼¼¿ä.</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => 'ÀÌ¸§À» ÀÔ·ÂÇÏ¼¼¿ä.',
        'com_added' => 'ÄÚ¸àÆ®°¡ µî·ÏµÇ¾ú½À´Ï´Ù.',
	'alb_need_title' => '°ÇÀüÇÑ ¾Ù¹ü Å¸ÀÌÆ²À» Á¤ÇÏ¼¼¿ä !',
	'no_udp_needed' => '¾÷µ¥ÀÌÆ®ÇÒ ÇÊ¿ä¾ø½¿.',
	'alb_updated' => 'The ¾÷µ¥ÀÌÆ® µÇ¾ú½À´Ï´Ù.',
	'unknown_album' => '¼±ÅÃÇÑ ¾Ù¹üÀÌ ¾ø°Å³ª, ¾÷·ÎµåÇÒ ±ÇÇÑÀÌ °ü¸®ÀÚ¿¡ ÀÇÇØ Á¦ÇÑµÇ¾îÀÖ½À´Ï´Ù.',
	'no_pic_uploaded' => '¾÷·Îµå ÀÌ¹ÌÁö ¾ø½À´Ï´Ù !<br /><br />¼­¹ö¿¡¼­ Çã¿ëµÇ´Â ÀÌ¹ÌÁö ÆÄÀÏÀ» ¾÷·ÎµåÇÏ¼¼¿ä.',
	'err_mkdir' => '%s µð·ºÅä¸® »ý¼º½ÇÆÐ !',
	'dest_dir_ro' => '%s µð·ºÅä¸®´Â ¾²±â±ÝÁöµÇ¾îÀÖ½À´Ï´Ù !',
	'err_move' => '%s°ú %s¸¦ ¿¬°áÇÏÁö¸øÇß½À´Ï´Ù  !',
	'err_fsize_too_large' => '»çÀÌÁîÃÊ°ú(maximum %s x %s) !',
	'err_imgsize_too_large' => '¿ë·®ÃÊ°ú (maximum %s KB) !',
	'err_invalid_img' => 'Á¤´çÇÑ ÀÌ¹ÌÁö¸¸ ¾÷·ÎµåÇÏ½Ê½Ã¿À !',
	'allowed_img_types' => '%s ÀÌ¹ÌÁö¸¸ ¾÷·ÎµåÇÒ ¼ö ÀÖ½À´Ï´Ù.',
	'err_insert_pic' => '\'%s\' ÀÌ¹ÌÁö´Â ¾Ù¹ü¿¡ µî·ÏÇÒ ¼ö ¾ø½À´Ï´Ù. ',
	'upload_success' => 'ÀÌ¹ÌÁö°¡ ¼º°øÀûÀ¸·Î ¾÷·Îµå µÇ¾ú½À´Ï´Ù.<br /><br />°ü¸®ÀÚÀÇ ½ÂÀÎÈÄ °Ô½ÃµË´Ï´Ù.',
        'info' => '¾È³»',
        'com_added' => 'ÄÚ¸àÆ® µî·Ï',
        'alb_updated' => '¾Ù¹ü ¼öÁ¤',
        'err_comment_empty' => 'ÄÚ¸àÆ® ºñ¾îÀÖ½¿ !',
        'err_invalid_fext' => 'Only files with the following extensions are accepted : <br /><br />%s.',
	'no_flood' => 'ÄÚ¸àÆ®¸¦ ¼öÁ¤ÇÏ°Å³ª µî·ÏÇÒ ¼ö ¾ø½À´Ï´Ù.',
	'redirect_msg' => '\'´ÙÀ½\' ¹öÆ°À» ´©¸£±â Àü¿¡ ºê¶ó¿ìÀúÀÇ »õ·Î°íÄ§ ¹öÆ°À» »ç¿ëÇÏÁö ¸¶¼¼¿ä.',
	'upl_success' => 'ÀÌ¹ÌÁö°¡ ¼º°øÀûÀ¸·Î ¾÷·ÎµåµÇ¾ú½À´Ï´Ù.',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => 'Ä¸¼Ç',
	'fs_pic' => '¿øº» ÀÌ¹ÌÁö',
	'del_success' => '»èÁ¦µÇ¾ú½À´Ï´Ù!',
	'ns_pic' => 'Àü½Ã¸¦ À§ÇÑ »õÀÌ¹ÌÁö',
	'err_del' => '»èÁ¦µÇÁö ¾Ê¾Ò½À´Ï´Ù!!',
	'thumb_pic' => '½æ³×ÀÏ',
	'comment' => 'ÄÚ¸àÆ®',
	'im_in_alb' => '¾Ù¹ü ÀÌ¹ÌÁö',
	'alb_del_success' => '\'%s\' ¾Ù¹ü»èÁ¦',
	'alb_mgr' => '¾Ù¹ü°ü¸®',
	'err_invalid_data' => '\'%s\' µ¥ÀÌÅ¸ ¾ø½À´Ï´Ù!',
	'create_alb' => '\'%s\' ¾Ù¹ü»ý¼º',
	'update_alb' => '\'%s\' ¾Ù¹ü ¾÷µ¥ÀÌÆ® \'%s\' ÀÌ¹ÌÁö \'%s\' ÀÎµ¦½º',
	'del_pic' => 'ÀÌ¹ÌÁö»èÁ¦',
	'del_alb' => '¾Ù¹ü»èÁ¦',
	'del_user' => '»ç¿ëÀÚ»èÁ¦',
	'err_unknown_user' => '¼±ÅÃÇÑ »ç¿ëÀÚ´Â ¾ø½À´Ï´Ù !',
	'comment_deleted' => 'ÄÚ¸àÆ®°¡ ¼º°øÀûÀ¸·Î »èÁ¦µÇ¾ú½À´Ï´Ù.',
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
        'confirm_del' => 'ÀÌ¹ÌÁö¸¦ »èÁ¦ÇÏ½Ã°Ú½À´Ï±î ? \\nÄÚ¸àÆ®µµ ÇÔ²² »èÁ¦µË´Ï´Ù.',
        'del_pic' => 'ÀÌ¹ÌÁö»èÁ¦',
        'size' => '%s x %s pixels',
        'views' => '%s times',
        'slideshow' => '½½¶óÀÌµå¼î',
        'stop_slideshow' => '½½¶óÀÌµå¼î-Á¤Áö',
        'view_fs' => '¿øº» ÀÌ¹ÌÁö º¸±â',
);

$lang_picinfo = array(
        'title' =>'»çÁø Á¤º¸',
        'Filename' => 'ÆÄÀÏÀÌ¸§',
        'Album name' => '¾Ù¹üÀÌ¸§',
        'Rating' => 'ÆòÁ¡ (%s Æò°¡)',
        'Keywords' => 'Å°¿öµå',
        'File Size' => 'ÆÄÀÏ Å©±â',
        'Dimensions' => 'Dimensions',
        'Displayed' => 'Displayed',
        'Camera' => 'Ä«¸Þ¶ó',
        'Date taken' => 'ÃÔ¿µÀÏÀÚ',
        'Aperture' => 'Aperture',
        'Exposure time' => 'Exposure time',
        'Focal length' => 'Focal length',
        'Comment' => 'ÄÚ¸àÆ®',
        'addFav'=>'Áñ°ÜÃ£±â¿¡ Ãß°¡', //new in cpg1.2.0
        'addFavPhrase'=>'Áñ°ÜÃ£±â', //new in cpg1.2.0
        'remFav'=>'Áñ°ÜÃ£±â¿¡¼­ »èÁ¦', //new in cpg1.2.0
);

$lang_display_comments = array(
        'OK' => 'µî·Ï',
        'edit_title' => 'ÄÚ¸àÆ® ¼öÁ¤',
        'confirm_delete' => 'ÄÚ¸àÆ®¸¦ »èÁ¦ÇÏ½Ã°Ú½À´Ï±î ?',
        'add_your_comment' => 'ÄÚ¸àÆ® µî·Ï',
        'name'=>'ÀÌ¸§', //new in cpg1.2.0
        'comment'=>'ÄÚ¸àÆ®', //new in cpg1.2.0
        'your_name' => 'ÀÏÁö¸Å', //new in cpg1.2.0
);

$lang_fullsize_popup = array(
        'click_to_close' => 'È­¸é´Ý±â:ÀÌ¹ÌÁö¿¡ Å¬¸¯', //new in cpg1.2.0
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => 'e-card º¸³»±â',
	'invalid_email' => '<b>Warning</b> : À¯È¿ÇÏÁö ¾ÊÀº ÀÌ¸ÞÀÏÀÔ´Ï´Ù !',
	'ecard_title' => '%s´Ô²²¼­ º¸³»½Å e-card ÀÔ´Ï´Ù!',
	'view_ecard' => 'Ä«µå°¡ º¸ÀÌÁö¾Ê´Â »ç¿ëÀÚ²²¼­´Â ÀÌ¸µÅ©¸¦ Å¬¸¯ÇÏ¼¼¿ä !',
	'view_more_pics' => '´õ ¸¹Àº ÀÌ¹ÌÁö¸¦ °¨»óÇÏ½Ã·Á¸é Å¬¸¯ÇÏ¼¼¿ä !',
	'send_success' => 'e-card¸¦ º¸³Â½À´Ï´Ù!',
	'send_failed' => 'ÁË¼ÛÇÕ´Ï´Ù, e-card ¹ß¼Û¿¡ ½ÇÆÐÇÏ¿´½À´Ï´Ù.',
	'from' => 'e-card ÀÛ¼ºÆû',
	'your_name' => 'º¸³»´Â »ç¶÷ ÀÌ¸§',
        'your_email' => 'º¸³»´Â »ç¶÷ ÀÌ¸ÞÀÏ',
        'to' => 'To',
        'rcpt_name' => '¹Þ´Â »ç¶÷ ÀÌ¸§',
        'rcpt_email' => '¹Þ´Â »ç¶÷ ÀÌ¸ÞÀÏ',
        'greetings' => 'Á¦¸ñ',
        'message' => '¸Þ¼¼Áö',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
        'pic_info' => 'ÀÌ¹ÌÁö »ó¼¼Á¤º¸',
        'album' => '¾Ù¹ü',
        'title' => 'ÀÌ¹ÌÁö Á¦¸ñ',
        'desc' => 'ÀÌ¹ÌÁö ¼³¸í',
        'keywords' => '°Ë»ö Å°¿öµå',
        'pic_info_str' => '%sx%s - %sKB - %s views - %s votes',
        'approve' => 'ÀÌ¹ÌÁö ½ÂÀÎ',
        'postpone_app' => '½ÂÀÎ º¸·ù',
        'del_pic' => 'ÀÌ¹ÌÁö »èÁ¦',
        'reset_view_count' => 'Á¶È¸¼ö ÃÊ±âÈ­',
        'reset_votes' => 'Æò°¡ ÃÊ±âÈ­',
        'del_comm' => 'ÄÚ¸àÆ® »èÁ¦',
        'upl_approval' => '¾÷·Îµå ½ÂÀÎ',
        'edit_pics' => 'ÀÌ¹ÌÁö ÆíÁý',
        'see_next' => '´ÙÀ½',
        'see_prev' => 'ÀÌÀü',
        'n_pic' => '´ë±âÁßÀÎ ÀÌ¹ÌÁö (%s)',
        'n_of_pic_to_disp' => 'ÆäÀÌÁö´ç Ãâ·ÂÇÒ ÀÌ¹ÌÁö',
        'apply' => 'º¯°æ»çÇ× Àû¿ë'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
        'group_name' => '±×·ìÀÌ¸§',
        'disk_quota' => 'µð½ºÅ© ÇÒ´ç',
        'can_rate' => 'Æò°¡°¡´É',
        'can_send_ecards' => 'e-card ¹ß¼Û°¡´É',
        'can_post_com' => 'ÄÚ¸àÆ® µî·Ï°¡´É',
        'can_upload' => 'ÀÌ¹ÌÁö ¾÷·Îµå°¡´É',
        'can_have_gallery' => '°³ÀÎ¾Ù¹ü »ý¼º°¡´É',
        'apply' => 'º¯°æ»çÇ× Àû¿ë',
        'create_new_group' => '»õ±×·ì »ý¼º',
        'del_groups' => '¼±ÅÃÇÑ ±×·ì»èÁ¦',
        'confirm_del' => 'Warning, when you delete a group, users that belong to this group will be transfered to the \'Registered\' group !\n\nDo you want to proceed ?',
        'title' => '»ç¿ëÀÚ ±×·ì°ü¸®',
        'approval_1' => 'Pub. Upl. approval (1)',
        'approval_2' => 'Priv. Upl. approval (2)',
	'note1' => '<b>(1)</b> public album ¿¡ ¾÷·ÎµåÇÒ ÀÌ¹ÌÁö´Â °ü¸®ÀÚÀÇ ½ÂÀÎÀýÂ÷¸¦ °ÅÃÄ °Ô½ÃµË´Ï´Ù.',
	'note2' => '<b>(2)</b> »ç¿ëÀÚ(È¸¿ø)°¡ ¾÷·ÎµåÇÑ ÀÌ¹ÌÁö´Â ÀúÀÛ±Ç¹ý¿¡ À§¹èµÇÁö ¾Ê¾Æ¾ß °Ô½ÃµË´Ï´Ù. ',
        'notes' => 'Notes'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
        'welcome' => 'È¯¿µÇÕ´Ï´Ù !'
);

$lang_album_admin_menu = array(
	'confirm_delete' => '¾Ù¹üÀ» »èÁ¦ÇÏ½Ã°Ú½À´Ï±î ? \\n¸ðµç ÀÌ¹ÌÁö¿Í ÄÚ¸àÆ®µµ ÇÔ²² »èÁ¦µË´Ï´Ù.',
        'delete' => '»èÁ¦',
        'modify' => '¾Ù¹ü¼³Á¤',
        'edit_pics' => 'ÀÌ¹ÌÁöº° Á¤º¸¼öÁ¤ ',
);

$lang_list_categories = array(
        'home' => '°¶·¯¸® ¸ÞÀÎ',
	'stat1' => '<b>Ä«Å×°í¸®:[cat] ¾Ù¹ü:[albums] ÀÌ¹ÌÁö:[pictures] ÄÚ¸àÆ®:[comments] Á¶È¸:[views]</b>',
	'stat2' => '<b>¾Ù¹ü:[albums] ÀÌ¹ÌÁö:[pictures] Á¶È¸:[views]</b>',
	'xx_s_gallery' => '%s\'°¶·¯¸®',
	'stat3' => '<b>Ä«Å×°í¸®:[cat] ¾Ù¹ü:[albums] ÀÌ¹ÌÁö:[pictures] ÄÚ¸àÆ®:[comments] Á¶È¸:[views]</b>'
);

$lang_list_users = array(
        'user_list' => '»ç¿ëÀÚ(È¸¿ø)¸ñ·Ï',
        'no_user_gal' => '»ç¿ëÀÚ(È¸¿ø) °¶·¯¸®°¡ ¾ø½À´Ï´Ù.',
        'n_albums' => '%s ¾Ù¹ü',
        'n_pics' => '%s ÀÌ¹ÌÁö'
);

$lang_list_albums = array(
        'n_pictures' => '%s ÀÌ¹ÌÁö',
        'last_added' => ', last one added on %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => '·Î±×ÀÎ',
	'enter_login_pswd' => '¾ÆÀÌµð¿Í ºñ¹Ð¹øÈ£¸¦ ÀÔ·ÂÇÏ¼¼¿ä!',
        'username' => '¾ÆÀÌµð',
        'password' => 'ºñ¹Ð¹øÈ£',
        'remember_me' => '±â¾ïÇÏ±â',
        'welcome' => '%s´Ô ·Î±×ÀÎ µÇ¾ú½À´Ï´Ù !!',
        'err_login' => '*** ·Î±×ÀÎ µÇÁö ¾Ê¾Ò½À´Ï´Ù ***',
        'err_already_logged_in' => 'ÀÌ¹Ì ·Î±×ÀÎ µÇ¾ú½À´Ï´Ù !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
        'logout' => '·Î±×¾Æ¿ô',
        'bye' => '%s´Ô ·Î±×¾Æ¿ô µÇ¾ú½À´Ï´Ù !!',
        'err_not_loged_in' => '·Î±×ÀÎµÇÁö ¾Ê¾Ò½À´Ï´Ù !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => '%s´Ô ¾Ù¹ü ¾÷µ¥ÀÌÆ®',
	'general_settings' => '±âº»¼³Á¤',
	'alb_title' => '¾Ù¹ü Á¦¸ñ',
	'alb_cat' => '¾Ù¹ü Ä«Å×°í¸®',
	'alb_desc' => '¾Ù¹ü ¼³¸í',
	'alb_thumb' => '¾Ù¹ü ½æ³×ÀÏ',
	'alb_perm' => '¾Ù¹ü ±ÇÇÑ¼³Á¤',
	'can_view' => '¾Ù¹ü °ø°³¼³Á¤',
	'can_upload' => '¹æ¹®ÀÚ°¡ ÀÌ¹ÌÁö¸¦ ¾÷·ÎµåÇÒ¼ö ÀÖÀ½',
	'can_post_comments' => '¹æ¹®ÀÚ°¡ ÄÚ¸àÆ®¸¦ ¾µ¼ö ÀÖÀ½',
	'can_rate' => '¹æ¹®ÀÚ°¡ Æò°¡ÇÒ ¼ö ÀÖÀ½',
	'user_gal' => '»ç¿ëÀÚ(È¸¿ø) °¶·¯¸®',
	'no_cat' => '*ÃÖ»óÀ§ Ä«Å×°í¸®(¸ÞÀÎ)',
	'alb_empty' => '¾Ù¹üÀÌ ºñ¾îÀÖ½À´Ï´Ù.',
	'last_uploaded' => '¸¶Áö¸· ¾÷·Îµå',
	'public_alb' => '¸ðµÎ°ø°³(public album)',
	'me_only' => '³ª¸¸º¸±â',
	'owner_only' => '(%s)¸¸ º¸±â',
	'groupp_only' => '\'%s\' ±×·ì',
	'err_no_alb_to_modify' => '¼öÁ¤ÇÒ ¼ö ¾ø½À´Ï´Ù.',
	'update' => '¾Ù¹ü ¾÷µ¥ÀÌÆ®'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => 'ÁË¼ÛÇÕ´Ï´Ù. ÀÌ¹Ì Æò°¡ÇÏ¼Ì½À´Ï´Ù.',
	'rate_ok' => 'Æò°¡ÇØ ÁÖ¼Å¼­ °¨»çÇÕ´Ï´Ù !',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
{SITE_NAME}¿¡ ¿À½Å °ÍÀ» È¯¿µÇÕ´Ï´Ù.<br />
È¸¿ø´ÔÀÇ °³ÀÎ¾Ù¹üÀ» »ý¼º °ü¸®ÇÒ¼ö ÀÖ´Â ½Ã½ºÅÛÀ» ÁØºñÁß¿¡ ÀÖ½À´Ï´Ù.<br />
ÇöÀç´Â Å×½ºÆ®ÁßÀÌ¹Ç·Î, È¸¿ø°¡ÀÔÀÌ³ª ±âÅ¸ °¶·¯¸® ÇÁ·Î±×·¥¿¡¼­ÀÇ ÆÄÀÏ À¯½ÇµîÀº Ã¥ÀÓÁöÁö ¾Ê½À´Ï´Ù.<br />
ÀÏ´Ü È¸¿øµî·ÏÇÑ ºÐ²²´Â Á¤½Ä ¿ÀÇÂ½Ã ÀÌ¸ÞÀÏÀ» ÅëÇØ ¾Ë·Áµå¸± °ÍÀÌ¸ç, ½ÃÇè ±â°£µ¿¾È °¡ÀÔÇÑ È¸¿øÀ» ´ë»óÀ¸·Î Æ¯º°ÇÑ ÀÌº¥Æ®¸¦ ÁØºñÇÏ°í ÀÖ½À´Ï´Ù.<br />È¸¿ø°¡ÀÔ½Ã ÀÌ¸ÞÀÏÀÇ À¯È¿¼º Ã¼Å©¸¦ ÅëÇØ À¯È¿ÇÏÁö ¾ÊÀº ÀÌ¸ÞÀÏÀº µî·ÏµÇÁö ¾Ê´ÂÁ¡ Âü°íÇÏ¼¼¿ä.<br /><br />
´Ù½ÃÇÑ¹ø {SITE_NAME}¸¦ ¹æ¹®ÇØ ÁÖ¼Å¼­ °¨»çÇÕ´Ï´Ù.
EOT;

$lang_register_php = array(
	'page_title' => 'È¸¿øµî·Ï',
	'term_cond' => 'µî·Ï¾à°ü ¹× ÀÌ¿ë¾È³»',
	'i_agree' => 'µ¿ÀÇÇÕ´Ï´Ù!',
	'submit' => 'È¸¿øµî·Ï',
	'err_user_exists' => 'ÀÌ¹Ì »ç¿ëÁßÀÎ ¾ÆÀÌµðÀÔ´Ï´Ù. ´Ù¸¥ ¾ÆÀÌµð·Î µî·ÏÇÏ¼¼¿ä.',
	'err_password_mismatch' => 'µÎ ºñ¹Ð¹øÈ£°¡ ÀÏÄ¡ÇÏÁö ¾Ê½À´Ï´Ù.',
	'err_uname_short' => '¾ÆÀÌµð´Â ÃÖ¼Ò4~10ÀÚ ÀÌ³»·Î ÀÛ¼ºÇØ¾ß ÇÕ´Ï´Ù.',
	'err_password_short' => 'ºñ¹Ð¹øÈ£´Â ÃÖ¼Ò4~12ÀÚ ÀÌ³»·Î ÀÛ¼ºÇØ¾ß ÇÕ´Ï´Ù.',
	'err_uname_pass_diff' => '¾ÆÀÌµð¿Í ºñ¹Ð¹øÈ£°¡ ÀÏÄ¡ÇÏÁö ¾Ê½À´Ï´Ù.',
	'err_invalid_email' => 'ÀÌ¸ÞÀÏÀ» ÀÔ·ÂÇÏ¼¼¿ä.',
	'err_duplicate_email' => 'ÀÌ¹Ì µî·ÏµÈ ÀÌ¸ÞÀÏ ÁÖ¼ÒÀÔ´Ï´Ù.',
	'enter_info' => 'È¸¿øµî·Ï Æû',
	'required_info' => 'ÇÊ¼öÀÔ·Â Ç×¸ñ',
	'optional_info' => 'Ãß°¡Á¤º¸',
	'username' => '¾ÆÀÌµð',
	'password' => 'ºñ¹Ð¹øÈ£',
	'password_again' => 'ºñ¹Ð¹øÈ£ ÀçÀÔ·Â',
	'email' => 'ÀÌ¸ÞÀÏ',
	'location' => 'Áö¿ª',
	'interests' => '°ü½ÉºÐ¾ß',
	'website' => 'È¨ÆäÀÌÁö',
	'occupation' => 'ÇÏ½Ã´Â ÀÏ',
	'error' => '¿¡·¯..',
	'confirm_email_subject' => '%s È¸¿øµî·Ï',
	'information' => '¾È³»',
	'failed_sending_email' => 'µî·ÏÁ¤º¸ ÀÌ¸ÞÀÏ ¹ß¼Û½ÇÆÐ !',
	'thank_you' => 'µî·ÏÇØÁÖ¼Å¼­ °¨»çÇÕ´Ï´Ù.<br />ÀÔ·ÂÇÑ ÀÌ¸ÞÀÏ ÁÖ¼Ò·Î È°¼ºÈ­ ÄÚµå°¡ ´ã±ä ÀÌ¸ÞÀÏÀ» º¸³Â½À´Ï´Ù.<br />µî·ÏÀýÂ÷¸¦ ¿Ï·áÇÏ·Á¸é ÀÌ¸ÞÀÏÀÇ È°¼ºÈ­ ÄÚµå¸¦ Å¬¸¯ÇØÁÖ½Ê½Ã¿À.',
	'acct_created' => 'È¸¿ø´ÔÀÇ µî·ÏÀýÂ÷°¡ Á¤»óÀûÀ¸·Î ¿Ï·áµÇ¾ú½À´Ï´Ù. ·Î±×ÀÎÈÄ °³ÀÎÁ¤º¸¸¦ ¼öÁ¤ÇØÁÖ½Ê½Ã¿À.',
	'acct_active' => 'È¸¿ø´ÔÀÇ °èÁ¤ÀÌ Á¤»óÀûÀ¸·Î È°¼ºÈ­µÇ¾ú½À´Ï´Ù. ·Î±×ÀÎÈÄ ÀÌ¿ëÇØÁÖ½Ê½Ã¿À.',
	'acct_already_act' => 'È¸¿ø´ÔÀÇ °èÁ¤ÀÌ ÀÌ¹Ì È°¼ºÈ­µÇ¾ú½À´Ï´Ù !',
	'acct_act_failed' => 'ÀÌ °èÁ¤Àº È°¼ºÈ­µÇÁö ¾Ê¾Ò½À´Ï´Ù !',
	'err_unk_user' => '¼±ÅÃÇÑ »ç¿ëÀÚ´Â Á¸ÀçÇÏÁö ¾Ê½À´Ï´Ù !',
	'x_s_profile' => '%s\'´ÔÀÇ °³ÀÎÁ¤º¸',
	'group' => '±×·ì',
	'reg_date' => 'È¸¿ø°¡ÀÔ',
	'disk_usage' => 'µð½ºÅ© »ç¿ë·®',
	'change_pass' => 'ºñ¹Ð¹øÈ£ º¯°æ',
	'current_pass' => 'ÇöÀç ºñ¹Ð¹øÈ£',
	'new_pass' => '»õ·Î¿î ºñ¹Ð¹øÈ£',
	'new_pass_again' => 'ºñ¹Ð¹øÈ£ ÀçÀÔ·Â',
	'err_curr_pass' => 'ÇöÀç ºñ¹Ð¹øÈ£°¡ Æ²¸³´Ï´Ù.',
	'apply_modif' => 'º¯°æ»çÇ× ÀúÀå',
	'change_pass' => 'ºñ¹Ð¹øÈ£ º¯°æ',
	'update_success' => '°³ÀÎÁ¤º¸°¡ ¾÷µ¥ÀÌÆ® µÇ¾ú½À´Ï´Ù.',
	'pass_chg_success' => 'ºñ¹Ð¹øÈ£°¡ º¯°æ µÇ¾ú½À´Ï´Ù.',
	'pass_chg_error' => 'ºñ¹Ð¹øÈ£°¡ º¯°æµÇÁö ¾Ê¾Ò½À´Ï´Ù.',
);

$lang_register_confirm_email = <<<EOT
¹Ý°©½À´Ï´Ù !! 

ÀÌ ¸ÞÀÏÀº '{SITE_NAME}' È¸¿øµî·Ï ½ÅÃ»ÀÚ¿¡°Ô º¸³»µå¸®´Â ¸ÞÀÏÀÔ´Ï´Ù.

¾Æ·¡ ¾ÆÀÌµð¿Í ºñ¹Ð¹øÈ£´Â ÀØÁö¾Êµµ·Ï ¸Þ¸ðÇØµÎ½Ã±â ¹Ù¶ø´Ï´Ù.

¾ÆÀÌµð : '{USER_NAME}'
ºñ¹Ð¹øÈ£ : '{PASSWORD}'

Ãß°¡·Î ¾Æ·¡ ¸µÅ©¸¦ Å¬¸¯ÇØ¼­ È¸¿ø´ÔÀÇ °èÁ¤À» È°¼ºÈ­ ½ÃÅ²´ÙÀ½ ·Î±×ÀÎÇÏ¼¼¿ä. 

{ACT_LINK}

±âÅ¸ ¹®ÀÇ»çÇ×Àº ¿î¿µÀÚ ¸ÞÀÏ tmax@puchonphoto.com ·Î ÁÖ½Ã±â ¹Ù¶ø´Ï´Ù.

{SITE_NAME} ¿î¿µÀÚ

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => 'ÄÚ¸àÆ® ´Ù½Ãº¸±â',
	'no_comment' => 'ÄÚ¸àÆ® ¾ø½À´Ï´Ù.',
        'n_comm_del' => '%s comment(s) deleted',
	'n_comm_disp' => 'ÆäÀÌÁö´ç Ãâ·Â±Û¼ö',
	'see_prev' => 'ÀÌÀü',
	'see_next' => '´ÙÀ½',
	'del_comm' => '¼±ÅÃÇÑ ÄÚ¸àÆ® »èÁ¦',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => 'ÀÌ¹ÌÁö °¶·¯¸® °Ë»ö',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => '»õ ÀÌ¹ÌÁö °Ë»ö',
	'select_dir' => '¾÷·Îµå µð·ºÅä¸®',
	'select_dir_msg' => 'FTP¸¦ ÀÌ¿ë Á¤ÇØÁø Æú´õ¿¡ ÀÌ¹Ì ¾÷·ÎµåÇÑ ÆÄÀÏÀ» ¿øÇÏ´Â °¶·¯¸®¿Í ¿¬°á½ÃÄÑ ÁÖ´Â ÀÛ¾÷À» ÇÏ´Â °÷ÀÔ´Ï´Ù. <br /><br />*ÀÌ¹ÌÁö ÆÄÀÏÀ»(public_html/gallery/Albums/userpics)Æú´õ·Î Àü¼ÛÇÑ ´ÙÀ½ ¾Æ·¡ ÀÛ¾÷À» ÁøÇàÇÕ´Ï´Ù.<br /><br />1) userpics ¸¦ Å¬¸¯ÇÏ¸é ÀüÃ¼ ¸®½ºÆ® °¡¿îµ¥ »õ·Î ¾÷·ÎµåµÈ ÆÄÀÏ¸¸ Ã¼Å©µÇ¾î ÀÖ½À´Ï´Ù.<br />2) ¿øÇÏ´Â °¶·¯¸®¸¦ ¼±ÅÃÇÑ ´ÙÀ½ "¼±ÅÃÇÑ ÀÌ¹ÌÁö ¿¬°á" ¹öÆ°À» Å¬¸¯ µî·ÏÇÕ´Ï´Ù.<br /><br />*ÇÏ³ªÀÇ ÆÄÀÏÀ» µÎ °÷ÀÇ °¶·¯¸®¿¡ ¸µÅ©ÇÒ ¼ö ¾ø½À´Ï´Ù. ÇØ´ç °¶·¯¸®¿¡¼­ »èÁ¦ÈÄ Àçµî·Ï ÇÏ¼¼¿ä.',
	'no_pic_to_add' => '¿¬°áµÈ ÀÌ¹ÌÁö ¾ø½À´Ï´Ù.',
	'need_one_album' => 'ÇÏ³ª ÀÌ»óÀÇ ¾Ù¹üÀ» »ý¼ºÇÑ ´ÙÀ½ ÀÌ¿ëÇÏ¼¼¿ä.',
	'warning' => 'ÁÖÀÇ',
	'change_perm' => 'ÀÌ¹ÌÁö¸¦ ¾÷·ÎµåÇÏ±â Àü¿¡ ÇØ´ç µð·ºÅä¸®ÀÇ ÆÛ¹Ì¼ÇÀ» 755 ¶Ç´Â 777 ·Î º¯°æÇØ¾ß ÇÕ´Ï´Ù !',
	'target_album' => '<b>&quot; %s &quot; Æú´õÀÇ ÀÌ¹ÌÁö¸¦ ¿¬°áÇÒ °¶·¯¸® ¼±ÅÃ </b>%s',
	'folder' => '¾÷·Îµå Æú´õ',
	'image' => 'ÀÌ¹ÌÁö',
	'album' => '°¶·¯¸®',
	'result' => '°á°ú',
	'dir_ro' => '¾²±â ±ÇÇÑ ¾ø½À´Ï´Ù. ',
	'dir_cant_read' => 'ÀÐ±â ±ÇÇÑ ¾ø½À´Ï´Ù. ',
	'insert' => '°¶·¯¸®¿¡ »õ·Î¿î ÀÌ¹ÌÁö ¿¬°á',
	'list_new_pic' => '»õ ÀÌ¹ÌÁö ¸ñ·Ï',
	'insert_selected' => '¼±ÅÃÇÑ ÀÌ¹ÌÁö ¿¬°á',
	'no_pic_found' => '»õ ÀÌ¹ÌÁö¸¦ Ã£Áö ¸øÇÏ¿´½À´Ï´Ù.',
	'be_patient' => '°á°ú ¾ÆÀÌÄÜÀ» ÂüÁ¶ÇÏ¼¼¿ä.',
        'notes' =>  '<ul>'.
				'<li><b>OK</b> : ¿¬°á¼º°ø'.
				'<li><b>DP</b> : ´Ù¸¥ °¶·¯¸®¿¡ ÀÌ¹Ì µî·ÏµÇ¾îÀÖÀ½'.
				'<li><b>PB</b> : ½ÇÆÐ, ¾÷·Îµå µð·ºÅä¸®ÀÇ ÆÛ¹Ì¼Çµî Ãß°¡ÀÛ¾÷ ÇÊ¿ä'.
				'<li>¸¸¾à °á°úÃ¢¿¡ OK, DP, PB µîÀÇ ¾ÆÀÌÄÜÀÌ Ç¥½ÃµÇÁö ¾Ê¾Ò´Ù¸é ÇÁ·Î±×·¥À» Á¡°ËÇÏ¼¼¿ä.'.

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
                'title' => '»ç¿ë±ÝÁöÀÚ', //new in cpg1.2.0
                'user_name' => '»ç¿ëÀÚÀÌ¸§', //new in cpg1.2.0
                'ip_address' => 'IP ÁÖ¼Ò', //new in cpg1.2.0
                'expiry' => 'À¯È¿±â°£ (ºóÄ­Àº ¿µ±¸)', //new in cpg1.2.0
                'edit_ban' => 'º¯°æ»çÇ× ÀúÀå', //new in cpg1.2.0
                'delete_ban' => '»èÁ¦', //new in cpg1.2.0
                'add_new' => '»ç¿ë±ÝÁöÀÚ Ãß°¡', //new in cpg1.2.0
                'add_ban' => 'Ãß°¡', //new in cpg1.2.0
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
	'title' => 'ÀÌ¹ÌÁö ¾÷·Îµå',
	'max_fsize' => '¾÷·Îµå Çã¿ë ÃÖ´ë ÆÄÀÏÅ©±â %s KB',
	'album' => '¾Ù¹ü',
	'picture' => 'ÀÌ¹ÌÁö',
	'pic_title' => 'ÀÌ¹ÌÁö Á¦¸ñ',
	'description' => 'ÀÌ¹ÌÁö ¼³¸í',
	'keywords' => 'Å°¿öµå (°Ë»ö¾î)',
	'err_no_alb_uploadables' => 'ÇØ´ç ÆÄÀÏ ¾ø½À´Ï´Ù.',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => '»ç¿ëÀÚ(È¸¿ø)°ü¸®',
	'name_a' => 'ÀÌ¸§ (a-z)',
	'name_d' => 'ÀÌ¸§ (z-a)',
	'group_a' => '±×·ì (a-z)',
	'group_d' => '±×·ì (z-a)',
	'reg_a' => 'µî·Ï (a-z)',
	'reg_d' => 'µî·Ï (z-a)',
	'pic_a' => 'Á¶È¸ (a-z)',
	'pic_d' => 'Á¶È¸ (z-a)',
	'disku_a' => '»ç¿ë·® (a-z)',
	'disku_d' => '»ç¿ë·® (z-a)',
	'sort_by' => 'Á¤·Ä¼ø¼­',
	'err_no_users' => '»ç¿ëÀÚ(È¸¿ø) Å×ÀÌºíÀÌ ºñ¾îÀÖ½À´Ï´Ù !',
	'err_edit_self' => '¼öÁ¤ÇÒ ¼ö ¾ø½À´Ï´Ù. °³ÀÎÁ¤º¸ ¼öÁ¤ ÆäÀÌÁö¸¦ ÀÌ¿ëÇÏ¼¼¿ä.',
	'edit' => 'ÆíÁý',
	'delete' => '»èÁ¦',
	'name' => '»ç¿ëÀÚ ÀÌ¸§',
	'group' => '±×·ì',
	'inactive' => 'ºñÈ°¼º',
	'operations' => '½ÇÇà¸Þ´º',
	'pictures' => 'ÀÌ¹ÌÁö',
	'disk_space' => '»ç¿ë·®/ÇÒ´ç·®',
	'registered_on' => 'È¸¿ø',
	'u_user_on_p_pages' => '%d ÀüÃ¼ %d ÆäÀÌÁö',
	'confirm_del' => '»èÁ¦ ÇÏ½Ã°Ú½À´Ï±î ? \\nµî·ÏµÈ ¸ðµç ÆÄÀÏÀÌ »èÁ¦µË´Ï´Ù.',
	'mail' => 'ÀÌ¸ÞÀÏ',
	'err_unknown_user' => '¼±ÅÃÇÑ È¸¿øÀÌ Á¸ÀçÇÏÁö ¾Ê½À´Ï´Ù !',
        'modify_user' => 'È¸¿øÁ¤º¸ ¼öÁ¤',
        'notes' => '¸Þ¸ð',
	'note_list' => '<li>ºñ¹Ð¹øÈ£¸¦ ¼öÁ¤ÇÏÁö ¾ÊÀ»°æ¿ì ºñ¿öµÎ½Ã¸é µË´Ï´Ù.',
        'password' => 'ºñ¹Ð¹øÈ£',
        'user_active' => 'È°¼ºÈ­µÈ »ç¿ëÀÚ',
        'user_group' => '»ç¿ëÀÚ ±×·ì',
        'user_email' => '»ç¿ëÀÚ ÀÌ¸ÞÀÏ',
        'user_web_site' => '»ç¿ëÀÚ È¨ÆäÀÌÁö',
        'create_new_user' => '»õ·Î¿î »ç¿ëÀÚ »ý¼º',
	'user_location' => 'Á¢¼ÓÁö',
	'user_interests' => '°ü½ÉºÐ¾ß',
	'user_occupation' => 'ÇÏ½Ã´Â ÀÏ',
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => 'ÀÌ¹ÌÁöÅ©±â¼öÁ¤', //new in cpg1.2.0
        'what_it_does' => 'What it does', //new in cpg1.2.0
        'what_update_titles' => 'ÆÄÀÏÀÌ¸§À¸·Î Á¦¸ñ¼öÁ¤', //new in cpg1.2.0
        'what_delete_title' => 'Á¦¸ñ»èÁ¦', //new in cpg1.2.0
        'what_rebuild' => '½æ³×ÀÏ ÀçÀÛ¼º°ú ÀÌ¹ÌÁöÅ©±âº¯°æ', //new in cpg1.2.0
        'what_delete_originals' => 'Deletes original sized photos replacing them with the sized version', //new in cpg1.2.0
        'file' => 'ÆÄÀÏ', //new in cpg1.2.0
        'title_set_to' => 'Á¦¸ñÀ» ', //new in cpg1.2.0
        'submit_form' => 'Á¦Ãâ', //new in cpg1.2.0
        'updated_succesfully' => 'º¯°æ ¼º°ø', //new in cpg1.2.0
        'error_create' => '¿À·ù¹ß»ý', //new in cpg1.2.0
        'continue' => 'Process more images', //new in cpg1.2.0
        'main_success' => 'The file %s was successfully used as main picture', //new in cpg1.2.0
        'error_rename' => '%s À» %s' ·Î ÀÌ¸§ º¯°æÁß ¿À·ù¹ß»ý', //new in cpg1.2.0
        'error_not_found' => 'ÆÄÀÏ %s À» Ã£À»¼ö ¾ø½À´Ï´Ù.', //new in cpg1.2.0
        'back' => '¸ÞÀÎÀ¸·Î', //new in cpg1.2.0
        'thumbs_wait' => '½æ³×ÀÏ°ú Å©±â°¡ ¼öÁ¤µÈ ÀÌ¹ÌÁö¸¦ º¯°æÇÏ°í ÀÖ½À´Ï´Ù, ±â´Ù¸®¼¼¿ä...', //new in cpg1.2.0
        'thumbs_continue_wait' => '½æ³×ÀÏ È¤Àº ¸®»çÀÌÁî ÀÌ¹ÌÁö¸¦ ¼öÁ¤ÇÏ°í ÀÖ½À´Ï´Ù...', //new in cpg1.2.0
        'titles_wait' => 'Á¦¸ñ¼öÁ¤Áß, ±â´Ù¸®¼¼¿ä...', //new in cpg1.2.0
        'delete_wait' => 'Á¦¸ñ»èÁ¦Áß, ±â´Ù¸®¼¼¿ä...', //new in cpg1.2.0
        'replace_wait' => '¿ø·¡ÀÌ¹ÌÁö »èÁ¦ÈÄ ¸®»çÀÌÁöµÈ ÀÌ¹ÌÁö·Î ´ëÃ¼Áß, ±â´Ù¸®¼¼¿ä..', //new in cpg1.2.0
        'instruction' => 'Quick instructions', //new in cpg1.2.0
        'instruction_action' => 'Select action', //new in cpg1.2.0
        'instruction_parameter' => 'º¯¼ö ¼³Á¤', //new in cpg1.2.0
        'instruction_album' => '¾Ù¹ü¼±ÅÃ', //new in cpg1.2.0
        'instruction_press' => 'Press %s', //new in cpg1.2.0
        'update' => '½æ³×ÀÏ È¤Àº ¸®»çÀÌÁîµÈ ÀÌ¹ÌÁö ¼öÁ¤', //new in cpg1.2.0
        'update_what' => 'What should be updated', //new in cpg1.2.0
        'update_thumb' => '½æ³×ÀÏ¸¸', //new in cpg1.2.0
        'update_pic' => 'Å©±â¼öÁ¤µÈ ÀÌ¹ÌÁö¸¸', //new in cpg1.2.0
        'update_both' => '½æ³×ÀÏ°ú Å©±â¼öÁ¤µÈ ÀÌ¹ÌÁö', //new in cpg1.2.0
        'update_number' => 'Number of processed images per click', //new in cpg1.2.0
        'update_option' => '(½Ã°£°æ°ú¹®Á¦°¡ ¹ß»ýÇÏ¸é ÀÌ ¿É¼ÇÀ» ³·°Ô ¼³Á¤ÇÏ¼¼¿ä)', //new in cpg1.2.0
        'filename_title' => 'ÆÄÀÏÀÌ¸§ &rArr; ÀÌ¹ÌÁö Á¦¸ñ', //new in cpg1.2.0
        'filename_how' => 'How should the filename be modified', //new in cpg1.2.0
        'filename_remove' => 'Remove the .jpg ending and replace _ (underscore) with spaces', //new in cpg1.2.0
        'filename_euro' => 'Change 2003_11_23_13_20_20.jpg to 23/11/2003 13:20', //new in cpg1.2.0
        'filename_us' => 'Change 2003_11_23_13_20_20.jpg to 11/23/2003 13:20', //new in cpg1.2.0
        'filename_time' => 'Change 2003_11_23_13_20_20.jpg to 13:20', //new in cpg1.2.0
        'delete' => 'ÀÌ¹ÌÁöÁ¦¸ñ È¤Àº ¿ø·¡ÀÌ¹ÌÁö »èÁ¦', //new in cpg1.2.0
        'delete_title' => 'ÀÌ¹ÌÁöÁ¦¸ñ »èÁ¦', //new in cpg1.2.0
        'delete_original' => '¿ø·¡ÀÌ¹ÌÁö »èÁ¦', //new in cpg1.2.0
        'delete_replace' => '¿ø·¡ÀÌ¹ÌÁö »èÁ¦ÈÄ ¸®»çÀÌÁî ÀÌ¹ÌÁö·Î ´ëÃ¼', //new in cpg1.2.0
        'select_album' => '¾Ù¹ü ¼±ÅÃ', //new in cpg1.2.0
);

?>