<?php
// ------------------------------------------------------------------------- //
//  Coppermine Photo Gallery                                                 //
// ------------------------------------------------------------------------- //
//  Copyright (C) 2002,2003  Gr?gory DEMAR <gdemar@wanadoo.fr>               //
//  http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
//  Based on PHPhotoalbum by Henning St?verud <henning@stoverud.com>         //
//  http://www.stoverud.com/PHPhotoalbum/                                    //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
// ------------------------------------------------------------------------- //

// info about translators and translated language
$lang_translation_info = array(
'lang_name_english' => 'Hebrew',
'lang_name_native' => 'òáøéú',
'lang_country_code' => 'he',
'trans_name'=> 'Eyal Zvi',
'trans_email' => 'eyal @at@ zvi.org',
'trans_website' => 'http://zvi.org',
'trans_date' => '2003-10-04',
);

$lang_charset = 'iso-8859-8-i';
$lang_text_dir = 'RTL';

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array("à'", "á'", "â'", "ã'", "ä'", "å'", "ù'");
$lang_month = array("éðå'", "ôáø'", "îøõ", "àôø'", "îàé", "éåðé", "éåìé", "àåâ'", "ñôè'", "àå÷'", "ðåá'", "ãöî'");

// Some common strings
$lang_yes = 'ëï';
$lang_no  = 'ìà';
$lang_back = 'çæøä';
$lang_continue = 'äîùê';
$lang_info = 'îéãò';
$lang_error = 'ùâéàä';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%d %b %Y';
$lastcom_date_fmt =  '%d %b %Y, %H:%M';
$lastup_date_fmt = '%d %b %Y';
$register_date_fmt = '%d %b %Y';
$lasthit_date_fmt = '%d %b %Y, %H:%M';
$comment_date_fmt =  '%d %b %Y, %H:%M';

// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array(
	'random' => 'úîåðåú à÷øàéåú',
	'lastup' => 'úîåðåú àçøåðåú',
        'lastalb'=> 'àìáåí àçøåï ùòåãëï',
	'lastcom' => 'äòøåú àçøåðåú',
	'topn' => 'ðöôåú áéåúø',
	'toprated' => 'æëå ìãøåâéí äâáåäéí áéåúø',
	'lasthits' => 'ðöôå ìàçøåðä',
	'search' => 'úåöàåú çéôåù',
        'favpics'=> 'úîåðåú îåòãôåú'
);

$lang_errors = array(
	'access_denied' => 'àéï ìê äøùàä ìöôåú áòîåã æä.',
	'perm_denied' => 'àéï ìê äøùàä ìáöò ôòåìä æå.',
	'param_missing' => 'Script called without the required parameter(s).',
	'non_exist_ap' => 'äàìáåí àå äúîåðä ùáçøú àéðí ÷ééîéí!',
	'quota_exceeded' => 'çøéâä îä÷öàú ãéñ÷<br /><br />äå÷öå ìê [quota]K, îúåëí ðéöìú [space]K, ëê ùäåñôú äúîåðä âåøîú ìçøéâä îäðôç äîåúø.',
	'gd_file_type_err' => 'ñåâé ÷áöé äúîåðåú äîåúøéí äí Jpeg å- PNG.',
	'invalid_image' => '÷åáõ äúîåðä ùäòìéú îùåáù àå îñåâ ùàéðå ðúîê òì éãé äîòøëú.',
	'resize_failed' => 'ú÷ìä áéöéøú úîåðä îå÷èðú.',
	'no_img_to_display' => 'àéï úîåðä ìäöéâ.',
	'non_exist_cat' => 'ä÷èâåøéä ùáçøú àéðä ÷ééîú.',
	'orphan_cat' => '÷èâåøéä àéðä îñååâú ëøàåé. éù ìäôòéì àú úëðéú ðéäåì ä÷èâåøéåú.',
	'directory_ro' => 'ìà ðéúï ìëúåá/ìîçå÷ áîçéöä %s, ìëï ìà ðéúï ìîçå÷ àú äúîåðåú.',
	'non_exist_comment' => 'ääòøä ùðáçøä àéðä ÷ééîú.',
	'pic_in_invalid_album' => 'äúîåðä îùåééëú ìàìáåí ìà ÷ééí (%s) !?',
        'banned' => 'ðàñø òìéê ìäùúîù áàúø æä.',
        'not_with_udb' => 'ôòåìä æå çñåîä. äâìøéä äåâãøä ìôòåì áñðëøåï òí úëðéú àçøú (ìîùì ìåç îåãòåú). äôòåìä äîáå÷ùú àéðä ðúîëú áîöá æä àå ùàîåøä ìäúáöò òì éãé äúëðéú äàçøú.',
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => 'ãìâ ìøùéîú äàìáåîéí',
	'alb_list_lnk' => 'øùéîú àìáåîéí',
	'my_gal_title' => 'ãìâ ìâìøéä ùìé',
	'my_gal_lnk' => 'äâìøéä ùìé',
	'my_prof_lnk' => 'äôøåôéì ùìé',
	'adm_mode_title' => 'îòáø ìîöá îðäì',
	'adm_mode_lnk' => 'îöá îðäì',
	'usr_mode_title' => 'îòáø ìîöá îùúîù',
	'usr_mode_lnk' => 'îöá îùúîù',
	'upload_pic_title' => 'äåñôú úîåðä ìàìáåí',
	'upload_pic_lnk' => 'äåñôú úîåðä',
	'register_title' => 'ôúéçú çùáåï îùúîù',
	'register_lnk' => 'øéùåí',
	'login_lnk' => 'äúçáøåú',
	'logout_lnk' => 'äúðú÷åú',
	'lastup_lnk' => 'úîåðåú àçøåðåú',
	'lastcom_lnk' => 'äòøåú àçøåðåú',
	'topn_lnk' => 'ðöôåú áéåúø',
	'toprated_lnk' => 'æëå ìãøåâéí äâáåäéí áéåúø',
	'search_lnk' => 'çéôåù',
        'fav_lnk' => 'äîåòãôéí ùìé',
);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => 'àéùåø äåñôä',
	'config_lnk' => 'úöåøä',
	'albums_lnk' => 'àìáåîéí',
	'categories_lnk' => '÷èâåøéåú',
	'users_lnk' => 'îùúîùéí',
	'groups_lnk' => '÷áåöåú',
	'comments_lnk' => 'äòøåú',
	'searchnew_lnk' => 'äåñôú ñãøú úîåðåú',
        'util_lnk' => 'ùéðåé âåãì úîåðåú',
        'ban_lnk' => 'äøç÷ú îùúîùéí',
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => 'éöéøä / àøâåï àìáåîéí ùìé',
	'modifyalb_lnk' => 'ùéðåé àìáåîéí ùìé',
	'my_prof_lnk' => 'äôøåôéì ùìé',
);

$lang_cat_list = array(
	'category' => '÷èâåøéä',
	'albums' => 'àìáåîéí',
	'pictures' => 'úîåðåú',
);

$lang_album_list = array(
	'album_on_page' => '%d àìáåîéí á- %d ãôéí'
);

$lang_thumb_view = array(
	'date' => 'úàøéê',
	'name' => ' ùí ÷åáõ',
        'title' => 'ëåúøú',
	'sort_da' => 'îéåï ìôé úàøéê îçãù ìéùï',
	'sort_dd' => 'îéåï ìôé úàøéê îéùï ìçãù',
	'sort_na' => 'îéåï ìôé ùí ÷åáõ áñãø òåìä',
	'sort_nd' => 'îéåï ìôé ùí ÷åáõ áñãø éåøã',
        'sort_ta' => 'îéåï ìôé ëåúøú áñãø òåìä',
        'sort_td' => 'îéåï ìôé ëåúøú áñãø éåøã',
	'pic_on_page' => '%d úîåðåú á-%d ãôéí',
	'user_on_page' => '%d îùúîùéí á-%d ãôéí'
);

$lang_img_nav_bar = array(
	'thumb_title' => 'çæøä ìòîåã äãåâîéåú',
	'pic_info_title' => 'äöâú/äñúøú îéãò ùì äúîåðåú',
	'slideshow_title' => 'îöâú ù÷åôéåú',
	'ecard_title' => 'ùìéçú äúîåðä ëâìåéä åéøèåàìéú',
	'ecard_disabled' => 'âìåéåú åéøèåàìéåú àéðï îåúøåú',
	'ecard_disabled_msg' => 'àéï ìê äøùàä ìùìåç âìåéä åéøèåàìéú',
	'prev_title' => 'äöâú äúîåðä ä÷åãîú',
	'next_title' => 'äöâú äúîåðä äáàä',
	'pic_pos' => 'úîåðä %s îúåê %s',
);

$lang_rate_pic = array(
	'rate_this_pic' => 'ãøåâ äúîåðä ',
	'no_votes' => '(àéï ÷åìåú)',
	'rating' => '(ãøåâ: %s/5 òí %s ÷åìåú)',
	'rubbish' => 'âøåòä',
	'poor' => 'ìà îåöìçú',
	'fair' => 'ñáéøä',
	'good' => 'èåáä',
	'excellent' => 'îöåééðú',
	'great' => 'ðôìàä!',
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
	CRITICAL_ERROR => 'ú÷ìä ÷øéèéú',
	'file' => '÷åáõ: ',
	'line' => 'ùåøä: ',
);

$lang_display_thumbnails = array(
	'filename' => 'ùí: ',
	'filesize' => 'âåãì: ',
	'dimensions' => 'îéãåú: ',
	'date_added' => 'ðåñôä á: '
);

$lang_get_pic_data = array(
	'n_comments' => '%s äòøåú',
	'n_views' => '%s öôéåú',
	'n_votes' => '(%s ÷åìåú)'
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
	'Exclamation' => 'ñéîï ÷øéàä!',
	'Question' => 'ñéîï ùàìä?',
	'Very Happy' => 'îàåùø îàã',
	'Smile' => 'çéåê',
	'Sad' => 'òöåá',
	'Surprised' => 'îåôúò',
	'Shocked' => 'îæåòæò',
	'Confused' => 'îáåìáì',
	'Cool' => 'âæòé',
	'Laughing' => 'öåç÷',
	'Mad' => 'îùåâò',
	'Razz' => 'Razz',
	'Embarassed' => 'ðáåê',
	'Crying or Very sad' => 'òöåá åáåëä',
	'Evil or Very Mad' => 'øùò îèåøó',
	'Twisted Evil' => 'øùò ñåèä',
	'Rolling Eyes' => 'îâìâì òéðééí',
	'Wink' => '÷åøõ',
	'Idea' => 'øòéåï',
	'Arrow' => 'çõ',
	'Neutral' => 'ðééèøìé',
	'Mr. Green' => 'îéñèø éøå÷',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
	0 => 'éöéàä îîöá îðäì...',
	1 => 'ëðéñä ìîöá îðäì...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => 'çåáä ìúú ùí ìàìáåí!',
	'confirm_modifs' => 'äàí àú/ä áèåç/ä ùáøöåðê ìòùåú ùéðåééí àìä?',
	'no_change' => 'ìà áéöòú ëì ùéðåé!',
	'new_album' => 'àìáåí çãù',
	'confirm_delete1' => 'äàí àú/ä áèåç/ä ùáøöåðê ìîçå÷ àìáåí æä?',
	'confirm_delete2' => '\nëì äúîåðåú åääòøåú ùáå éàáãå!',
	'select_first' => '÷åãí òìéê ìáçåø àìáåí',
	'alb_mrg' => 'îðäì äàìáåîéí',
	'my_gallery' => '* äâìøéä ùìé *',
	'no_category' => '* ììà ÷èâåøéä *',
	'delete' => 'îçé÷ä',
	'new' => 'ôúéçú çãù',
	'apply_modifs' => 'áéöåò ùéðåééí',
	'select_category' => 'áçéøú ÷èâåøéä',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => 'çñøéí ôøîèøéí äãøåùéí ìôòåìä "%s"',
	'unknown_cat' => 'ä÷èâåøéä ùðáçøä àéðä ÷ééîú áîñ äðúåðéí (DB)',
	'usergal_cat_ro' => 'ìà ðéúï ìîçå÷ àú ä÷èâåøéä "âìøéåú îùúîùéí"!',
	'manage_cat' => 'ðéäåì ÷èâåøéåú',
	'confirm_delete' => 'äàí àú/ä áèåç/ä ùáøöåðê ìîçå÷ ÷èâåøéä æå?',
	'category' => '÷èâåøéä',
	'operations' => 'ôòåìåú',
	'move_into' => 'äòáø àì',
	'update_create' => 'éöéøä/òãëåï ÷èâåøéä',
	'parent_cat' => '÷èâåøééú òì',
	'cat_title' => 'ëåúøú ä÷èâåøéä',
	'cat_desc' => 'úàåø ä÷èâåøéä'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => 'úöåøä',
	'restore_cfg' => 'ùéçæåø áøéøåú îçãì',
	'save_cfg' => 'ùîéøú äúöåøä äçãùä',
	'notes' => 'äòøåú',
	'info' => 'îéãò',
	'upd_success' => 'äúöåøä òåãëðä',
	'restore_success' => 'äúöåøä ùåçæøä ìáøéøåú äîçãì',
	'name_a' => 'ùí òåìä',
	'name_d' => 'ùí éåøã',
        'title_a' => 'ëåúøú áñãø òåìä',
        'title_d' => 'ëåúøú áñãø éåøã',
	'date_a' => 'úàøéê òåìä',
	'date_d' => 'úàéøê éåøã',
        'th_any' => 'Max Aspect',
        'th_ht' => 'Height',
        'th_wd' => 'Width',
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'äâãøåú ëììéåú',
	array('ùí äâìøéä', 'gallery_name', 0),
	array('úàåø äâìøéä', 'gallery_description', 0),
	array('ëúåáú ãåà"ì ùì îðäì äâìøéä', 'gallery_admin_email', 0),
	array('ëúåáú (URL) ùúåôéò áâìåéåú á÷éùåø "See more pictures" ', 'ecards_more_pic_target', 0),
	array('ùôä', 'lang', 5),
	array('ñâðåï òéöåá', 'theme', 6),

	'äâãøåú ìøùéîú àìáåîéí',
	array('øåçá äèáìä äøàùéú (á-% àå áô÷éñìéí)', 'main_table_width', 0),
	array('îñôø øîåú ÷èâåøéä ìäöéâ', 'subcat_level', 0),
	array('îñôø àìáåîéí ìäöéâ', 'albums_per_page', 0),
	array('îñôø òîåãåú ìøùéîú äàìáåîéí', 'album_list_cols', 0),
	array('âåãì äãåâîéåú áôé÷ñìéí', 'alb_list_thumb_size', 0),
	array('úåëï äãó äøàùé', 'main_page_layout', 0),
        array('äöâ ãåâîéåú (îàìáåîéí áäéøøëéä äòìéåðä) áøùéîú ä÷èâåøéåú','first_level',1),
	'äâãøåú ìúöåâú ãåâîéåú',
	array('îñôø òîåãåú áãó ãåâîéåú', 'thumbcols', 0),
	array('îñôø ùåøåú áãó ãåâîéåú', 'thumbrows', 0),
	array('îñôø ìùåðéåú î÷ñéîìé ìäöéâ', 'max_tabs', 0),
	array('äöâú ëúåáéú (áðåñó ìëåúøú) îúçú ìãåâîéú', 'caption_in_thumbview', 1),
	array('äöâú îñôø ääòøåú îúçú ìãåâîéú', 'display_comment_count', 1),
	array('îéåï äúçìúé ùì äãåâîéåú', 'default_sort_order', 3),
	array('îñôø ÷åìåú îéðéîìé äðãøù ìúîåðä ëãé ùúåôéò áøùéîú äãøåâéí äâáåäéí áéåúø ', 'min_votes_for_rating', 0),

	'äâãøåú ìúöåâú úîåðä åäòøåú',
	array('øåçá äèáìä (á-% àå áôé÷ñìéí)', 'picture_table_width', 0),
	array('îéãò òì äúîåðä îåöâ ëáøéøú îçãì', 'display_pic_info', 1),
	array('äàí ìñðï ðéáåìé ìùåï îääòøåú', 'filter_bad_words', 1),
	array('äàí ìäøùåú ñîééìéí áäòøåú', 'enable_smilies', 1),
	array('àåøê î÷ñéîìé ùì úàåø úîåðä', 'max_img_desc_length', 0),
	array('àåøê îéìä î÷ñéîìé (ìîðéòú "÷éù÷åùéí")', 'max_com_wlength', 0),
	array('îñôø ùåøåú î÷ñéîìé áäòøä', 'max_com_lines', 0),
	array('î÷ñéîåí àåøê ääòøä', 'max_com_size', 0),
        array('äöâ øöåòú ñøè öéìåí', 'display_film_strip', 1),
        array('îñôø äôøéèéí áøöåòú ñøè öéìåí', 'max_film_strip_items', 0),
	'äâãøåú ìúîåðåú åìãåâîéåú',
	array('øîú àéëåú ì÷áöé JPEG', 'jpeg_qual', 0),
        array('îîãéí î÷ñéîìééí ùì ãåâîéú <b>*</b>', 'thumb_width', 0),
        array('ìäùúîù áîîãéí (øåçá àå âåáä àå î÷ñéîìé) ùì ãåâîéú <b>*</b>', 'thumb_use', 7),
	array('î÷ñéîåí âåáä àå øåçá ùì ãåâîéú <b>*</b>', 'thumb_width', 0),
	array('éöéøä/äöâä ùì úîåðåú áâåãì áéðééí','make_intermediate',1),
	array('î÷ñéîåí âåáä àå øåçá ùì úîåðä áâåãì áéðééí <b>*</b>', 'picture_width', 0),
	array('î÷ñéîåí âåãì ùì ÷åáõ úîåðä (KB)', 'max_upl_size', 0),
	array('î÷ñéîåí âåáä àå øåçá ùì úîåðä', 'max_upl_width_height', 0),

	'äâãøåú îùúîùéí',
	array('ìàôùø øéùåí ùì îùúîùéí çãùéí', 'allow_user_registration', 1),
	array('ìáöò áãé÷ú ãåà"ì ùì îùúîù çãù', 'reg_requires_valid_email', 1),
	array('ìäøùåú ëôéìåú ùì ëúåáåú ãåà"ì áéï îùúîùéí ùåðéí', 'allow_duplicate_emails_addr', 1),
	array('ìàôùø ìîùúîùéí ìéöåø àìáåîéí ôøèééí', 'allow_private_albums', 1),

	'ùãåú ðåñôéí ìúàåø úîåðä (ìäùàéø øé÷ àí àéï öåøê)',
	array('ùí ùãä 1', 'user_field1_name', 0),
	array('ùí ùãä 2', 'user_field2_name', 0),
	array('ùí ùãä 3', 'user_field3_name', 0),
	array('ùí ùãä 4', 'user_field4_name', 0),

	'äâãøåú îú÷ãîåú ìúîåðåú åãåâîéåú',
        array('ìäöéâ öìîéú àìáåí ôøèé ìîùúîù ùìà äúçáø','show_private',1),
	array('úåéí àñåøéí áùí ÷åáõ úîåðä', 'forbiden_fname_char',0),
	array('ñéåîåú îåúøåú ùì ÷áöé úîåðä', 'allowed_file_extensions',0),
	array('ùéèú ùéðåé âåãì äúîåðä','thumb_method',2),
	array('ðúéá ìúåëðéú Convert ùì çáéìú ImageMagick (ìîùì /usr/bin/X11/)', 'impath', 0),
	array('ñåâé ÷áöé úîåðä îåúøéí (ø÷ òáåø ImageMagick)', 'allowed_img_types',0),
	array('ôøîèøéí ìùåøú äô÷åãä ùì ImageMagick', 'im_options', 0),
	array('÷øéàú îéãò îåøçá (EXIF) î÷áöé JPEG', 'read_exif_data', 1),
	array('ðúéá ìîçéöú äàìáåîéí <b>*</b>', 'fullpath', 0),
	array('îçéöä ìúîåðåú îùúîùéí <b>*</b>', 'userpics', 0),
	array('÷éãåîú ìúîåðåú áâåãì áéðééí <b>*</b>', 'normal_pfx', 0),
	array('÷éãåîú ìãåâîéåú <b>*</b>', 'thumb_pfx', 0),
	array('áøéøú îçãì ìäøùàú îçéöåú', 'default_dir_mode', 0),
	array('áøéøú îçãì ìäøùàú ÷áöé úîåðä', 'default_file_mode', 0),

	'äâãøåú Cookies åùôä',
	array('ùí ä-Cookie ùì äâìøéä', 'cookie_name', 0),
	array('ðúéá ä-Cookie ùì äâìøéä', 'cookie_path', 0),
	array('÷éãåã úåéí (ùôä)', 'charset', 4),

	'äâãøåú ùåðåú',
	array('äôòìú îöá Debug', 'debug_mode', 1),

	'<br /><div align="center">(*) ùãåú äîñåîðéí á-* àñåø ìùðåú àí éù ëáø úîåðåú áâìøéä!</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => 'òìéê ìöééï àú ùîê åìëúåá äòøä',
	'com_added' => 'äòøúê ðåñôä',
	'alb_need_title' => 'òìéê ìúú ëåúøú ìàìáåí',
	'no_udp_needed' => 'ìà ðãøù òãëåï',
	'alb_updated' => 'äàìáåí òåãëï',
	'unknown_album' => 'äàìáåí ùáçøú àéðå ÷ééí àå ùàéï ìê äøùàä ìäåñéó ìå úîåðåú',
	'no_pic_uploaded' => 'ìà äòáøú ÷åáõ úîåðä!<br /><br />àí àëï áöòú àú ôòåìú ääòáøä, éúëï ùäùøú àéðå î÷áì ÷áöéí (Upload)...',
	'err_mkdir' => 'éöéøú îçéöä "%s" ðëùìä!',
	'dest_dir_ro' => 'îçéöú äéòã "%s" àéðä îàôùøú ìúåëðéú ìáöò ùéðåééí!',
	'err_move' => 'ìà ðéúï ìäòáéø àú "%s" àì "%s"!',
	'err_fsize_too_large' => 'äúîåðä ùäòáøú çåøâú îäîîãéí äî÷ñéîìééí äîåúøéí (%sx%s)!',
	'err_imgsize_too_large' => 'äúîåðä ùäòáøú çåøâú îâåãì ä÷åáõ äî÷ñéîìé äîåúø (%s)!',
	'err_invalid_img' => 'ä÷åáõ ùäòáøú àéðå îëéì úîåðä ú÷éðä!',
	'allowed_img_types' => 'áàôùøåúê ìäòáéø òã %s ÷áöé úîåðä.',
	'err_insert_pic' => 'ìà ðéúï ìäåñéó àú äúîåðä %s ìàìáåí ',
	'upload_success' => 'äúîåðä òáøä áäöìçä.<br /><br />äúîåðä úåôéò ìàçø àéùåø äîðäì.',
	'info' => 'îéãò',
	'com_added' => 'äòøä ðåñôä',
	'alb_updated' => 'àìáåí ðåñó',
	'err_comment_empty' => 'äòøúê øé÷ä!',
	'err_invalid_fext' => 'îú÷áìéí ÷áöéí ø÷ áòìé äñéåîåú: <br /><br />%s.',
	'no_flood' => 'ðøàä ëé ääòøä äàçøåðä ìúîåðä äéà ùìê.<br /><br />àí áøöåðê ìùðåú àú ääòøä áàôùøåúê ìòøåê àåúä ùåá.',
	'redirect_msg' => 'äôðéä àåèåîèéú ìãó àçø.<br /><br /><br />àí äãó àéðå îåôéò úåê îñôø ùðéåú, éù ììçåõ òì "äîùê".',
	'upl_success' => 'úîåðúê ðåñôä áäöìçä',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => 'ëúåáéú',
	'fs_pic' => 'úîåðä áâåãì îìà',
	'del_success' => 'äîçé÷ä äöìéçä',
	'ns_pic' => 'úîåðä áâåãì øâéì',
	'err_del' => 'ìà ðéúï ìîçå÷',
	'thumb_pic' => 'ãåâîéú',
	'comment' => 'äòøä',
	'im_in_alb' => 'úîåðä áàìáåí',
	'alb_del_success' => 'àìáåí "%s" ðîç÷',
	'alb_mgr' => 'ðéäåì àìáåîéí',
	'err_invalid_data' => 'îéãò ùâåé ð÷ìè á-%s',
	'create_alb' => 'éåöø àìáåí "%s"',
	'update_alb' => 'îòãëï àìáåí "%s" òí ëåúøú "%s" åàéðã÷ñ "%s"',
	'del_pic' => 'îçé÷ú úîåðä',
	'del_alb' => 'îçé÷ú àìáåí',
	'del_user' => 'îçé÷ú îùúîù',
	'err_unknown_user' => 'äîùúîù ùðáçø àéðå ÷ééí!',
	'comment_deleted' => 'äòøä ðîç÷ä áäöìçä',
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
	'confirm_del' => 'äàí àú/ä äèåç/ä ùáøöåðê ìîçå÷ àú äúîåðä? \\nâí ääòøåú éîç÷å.',
	'del_pic' => 'îçé÷ú úîåðä æå',
	'size' => '%sx%s ôé÷ñìéí',
	'views' => '%s ôòîéí',
	'slideshow' => 'îöâú ù÷åôéåú',
	'stop_slideshow' => 'äôñ÷ú äîöâú',
	'view_fs' => 'éù ìä÷ìé÷ ìöôéä áúîåðä áâåãì îìà',
);

$lang_picinfo = array(
	'title' =>'îéãò òì äúîåðä',
	'Filename' => 'ùí ä÷åáõ',
	'Album name' => 'ùí äàìáåí',
	'Rating' => 'ãøåâ (%s ÷åìåú)',
	'Keywords' => 'îéìåú îôúç',
	'File Size' => 'âåãì ÷åáõ',
	'Dimensions' => 'îîãéí',
	'Displayed' => 'äåöâä',
	'Camera' => 'îöìîä',
	'Date taken' => 'öåìîä áúàøéê',
	'Aperture' => 'öîöí',
	'Exposure time' => 'çùéôä',
	'Focal length' => 'àåøê îå÷ã',
	'Comment' => 'äòøä'
);

$lang_display_comments = array(
	'OK' => 'OK',
	'edit_title' => 'òøéëú äòøä æå',
	'confirm_delete' => 'äàí àú/ä áèåç/ä ùáøöåðê ìîçå÷ äåãòä æå?',
	'add_your_comment' => 'äåñôú äòøä',
	'your_name' => 'ùîê',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => 'ùìéçú âìåéä åéøèåàìéú',
	'invalid_email' => '<b>àæäøä</b>: ëúåáú ãåà"ì ùâåéä!',
	'ecard_title' => 'An e-card from %s',
	'view_ecard' => 'If the e-card does not display correctly, click this link',
	'view_more_pics' => 'Click this link to view more pictures !',
	'send_success' => 'äâìåéä ðùìçä',
	'send_failed' => 'ñìéçä àê äùøú àéðå éëåì ìùìåç àú äâìåéä...',
	'from' => 'îàú',
	'your_name' => 'ùîê',
	'your_email' => 'ëúåáú äãåà"ì ùìê',
	'to' => 'àì',
	'rcpt_name' => 'ùí äðîòï',
	'rcpt_email' => 'ëúåáú ãåà"ì äðîòï',
	'greetings' => 'áøëåú',
	'message' => 'äåãòä',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => 'îéãò òì äúîåðä',
	'album' => 'àìáåí',
	'title' => 'ëåúøú',
	'desc' => 'úàåø',
	'keywords' => 'îìåú îôúç',
	'pic_info_str' => '%sx%s - %sKB, òí %s öôéåú å- %s ÷åìåú',
	'approve' => 'àéùåø äúîåðä',
	'postpone_app' => 'ãçééú äàéùåø',
	'del_pic' => 'îçé÷ú äúîåðä',
	'reset_view_count' => 'àéôåñ îåðä öôéåú',
	'reset_votes' => 'àéôåñ ÷åìåú',
	'del_comm' => 'îçé÷ú äòøåú',
	'upl_approval' => 'àéùåø äòáøä',
	'edit_pics' => 'òøéëú úîåðåú',
	'see_next' => 'öôéä áúîåðåú äáàåú',
	'see_prev' => 'öôéä áúîåðåú ä÷åãîåú',
	'n_pic' => '%s úîåðåú',
	'n_of_pic_to_disp' => 'îñôø úîåðåú ìäöâä',
	'apply' => 'áéöåò äùéðåééí'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => 'ùí ä÷áåöä',
	'disk_quota' => 'ä÷öàú ðôç ãéñ÷',
	'can_rate' => 'äøùàä ìãøåâ úîåðåú',
	'can_send_ecards' => 'äøùàä ìùìåç âìåéåú',
	'can_post_com' => 'äøùàä ìëúåá äòøåú',
	'can_upload' => 'äøùàä ìäåñôú úîåðåú',
	'can_have_gallery' => 'äøùàä ìâìøéä àéùéú',
	'apply' => 'áéöåò äùéðåééí',
	'create_new_group' => 'éöéøú ÷áåöä çãùä',
	'del_groups' => 'îçé÷ú ä÷áåöåú äîñåîðåú',
	'confirm_del' => 'àæäøä: îçé÷ú ÷áåöä úâøåí ìäòáøú ëì äîùúîùéí á÷áåöä àì ÷áåöú "Registered" - äàí áøöåðê ìäîùéê?',
	'title' => 'ðéäåì ÷áåöåú îùúîùéí',
	'approval_1' => 'àéùåø äåñôåú öéáåøéåú (1)',
	'approval_2' => 'àéùåø äåñôåú ôøèéåú (2)',
	'note1' => '<b>(1)</b> äåñôú úîåðåú ìàìáåí öéáåøé ãåøùú àéùåø îðäì',
	'note2' => '<b>(2)</b> äåñôú úîåðåú ìàìáåí ôøèé ãåøùú àéùåø îðäì',
	'notes' => 'äòøåú'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
	'welcome' => 'áøåëéí äáàéí!'
);

$lang_album_admin_menu = array(
	'confirm_delete' => '?äàí àú/ä áèåç/ä ùáøöåðê ìîçå÷ àìáåí æä\n!ëì äúîåðåú åääòøåú ùáå éàáãå',
	'delete' => 'îçé÷ä',
	'modify' => 'îàôééðéí',
	'edit_pics' => 'òøéëú úîåðåú',
);

$lang_list_categories = array(
	'home' => 'ãó øàùé',
	'stat1' => '<b>[pictures]</b> úîåðåú á- <b>[albums]</b> àìáåîéí å- <b>[cat]</b> ÷èâåøéåú òí <b>[comments]</b> äòøåú, ùðöôå <b>[views]</b> ôòîéí',
	'stat2' => '<b>[pictures]</b> úîåðåú á- <b>[albums]</b> àìáåîéí, ùðöôå <b>[views]</b> ôòîéí',
	'xx_s_gallery' => 'äâìøéä ùì %s',
	'stat3' => '<b>[pictures]</b> úîåðåú á- <b>[albums]</b> àìáåîéí òí <b>[comments]</b> äòøåú, ùðöôå <b>[views]</b> ôòîéí'
);

$lang_list_users = array(
	'user_list' => 'øùéîú îùúîùéí',
	'no_user_gal' => 'àéï âìøéåú îùúîùéí',
	'n_albums' => '%s àìáåíîéí',
	'n_pics' => '%s úîåðåú'
);

$lang_list_albums = array(
	'n_pictures' => '%s úîåðåú',
	'last_added' => ', äàçøåðä ðåñôä áúàøéê- %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => 'äúçáøåú',
	'enter_login_pswd' => 'éù ìä÷éù ùí îùúîù/ú åñéñîä ëãé ìäúçáø',
	'username' => 'ùí îùúîù/ú',
	'password' => 'ñéñîä',
	'remember_me' => 'æëåø àåúé (çáø àåúé àåèåîèéú áôòîéí äáàåú)',
	'welcome' => 'áøåëéí äáàéí',
	'err_login' => '*** ääúçáøåú ðëùìä, ðà ìðñåú ùåá ***',
	'err_already_logged_in' => 'ëáø äúçáøú!',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => 'äúðú÷åú',
	'bye' => 'ìäúøàåú...',
	'err_not_loged_in' => 'òåã ìà äúçáøú!',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => 'òãëåï àìáåí %s',
	'general_settings' => 'äâãøåú ëììéåú',
	'alb_title' => 'ëåúøú äàìáåí',
	'alb_cat' => '÷èâåøéú äàìáåí',
	'alb_desc' => 'úàåø äàìáåí',
	'alb_thumb' => 'ãåâîéú îééöâú ìàìáåí',
	'alb_perm' => 'äøùàåú ìàìáåí',
	'can_view' => 'äøùàåú öôéä áàìáåí ì-',
	'can_upload' => 'àåøçéí éëåìéí ìäåñéó úîåðåú',
	'can_post_comments' => 'àåøçéí éëåìéí ìäåñéó äòøåú ìúîåðåú',
	'can_rate' => 'àåøçéí éëåìéí ìãøâ úîåðåú',
	'user_gal' => 'âìøééú îùúîù',
	'no_cat' => '* ììà ÷èâåøéä *',
	'alb_empty' => 'àìáåí øé÷',
	'last_uploaded' => 'úîåðä àçøåðä ùðåñôä',
	'public_alb' => 'ëåìí (àìáåí öéáåøé)',
	'me_only' => 'àðé áìáã',
	'owner_only' => 'áòì äàìáåí (%s) áìáã',
	'groupp_only' => 'ø÷ çáøéí á÷áåöä "%s"',
	'err_no_alb_to_modify' => 'ìà ðîöà àìáåí ùáàôùøåúê ìòãëï',
	'update' => 'òãëåï àìáåí'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => 'ëáø ãøâú àú äúîåðä áòáø',
	'rate_ok' => 'äöáòúê ð÷ìèä',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
îðäì äàúø éùúãì ìäñéø ëì çåîø ôåâò äîáéøåú äàôùøéú. òí æàú, éù ìæëåø ùìà ðéúï ìñøå÷ ëì ôéñú îéãò àå úîåðä. ëì äîéãò äîôåøñí áàúø îáèà àú äù÷ôåúéäí ùì äîùúîùéí åìà ùì îðäìé äàúø (îìáã îéãò ùäí òöîí ôøñîå). àé ìëê îðäìé äàúø àéðí àçøàéí ìëì ôâéòä àå ðæ÷ ëúåöàä îîòùéäí ùì äîùúîùéí áàúø.
<br />
<br />
àéï ìôøñí áàúø ëì çåîø äîåâãø ë: ôâéòä, äùîöä, òìáåï, äñúä, àéåí, úåòáä, àå ëì ñåâ àçø ùàéðå òåìä á÷ðä àçã òí äçå÷. àéï ìôøñí áàúø çåîø äîåâï áæëåéåú éåöøéí, ìîòè àí áòì äæëåéåú ðúï äøùàä îôåøùú ìôøñåí. îðäìé äàúø éñéøå àå éòøëå îéãò ìôé ùé÷åì ãòúí äáìòãé. ëì äîéãò áàúø ðùîø áîàâø îéãò. äàúø àéðå îéåòã ìùîù ëâéáåé ìîéãò ùì äîùúîùéí àìà ëìåç ôøñåí æîðé. îðäìé äàúø àéðí àçøàéí ìàåáãï àå âðéáä ùì îéãò.
<br />
<br />
àúø æä îùúîù á"òåâéåú" (Cookies) ìàçñåï îéãò áúåëðú äâìéùä ùìê. "òåâéåú" àìä ðåòãå ìä÷ì òì äùéîåù áàúø åàéðï âåøîåú ìëì ðæ÷ àå ôâéòä áôøèéåú. ëúåáú äãåàø äàì÷èøåðéú ùìê úùîù ø÷ ìùìéçú äåãòåú îäàúø.
<br />
<br />
ìçéöä òì "àðé îñëéî/ä" îäååä àéùåøê ìäáðä å÷áìä îìàä ùì ëì äàîåø ìòéì.
EOT;

$lang_register_php = array(
	'page_title' => 'øéùåí îùúîù/ú',
	'term_cond' => 'úðàé äùéîåù áàúø',
	'i_agree' => 'àðé îñëéî/ä',
	'submit' => 'ùìéçú á÷ùú ääøùîä',
	'err_user_exists' => 'ùí äîùúîù/ú ùáçøú ëáø úôåñ, éù ìáçåø ùí àçø',
	'err_password_mismatch' => 'äñéñîàåú àéðï úåàîåú, ðà ìä÷éùï ùåá',
	'err_uname_short' => ' ùí äîùúîù/ú çééá ìäëéì ìôçåú 2 àåúéåú (äîìöä: 4 úåéí ìôçåú)',
	'err_password_short' => 'äñéñîä çééáú ìäëéì ìôçåú 2 úåéí (äîìöä: 6 úåéí ìôçåú)',
	'err_uname_pass_diff' => 'äùí åäñéñîä àéðí éëåìéí ìäéåú æäéí',
	'err_invalid_email' => 'ëúåáú äãåàø äàì÷èøåðé àéðä ú÷éðä',
	'err_duplicate_email' => 'îéùäå àçø ëáø îùúîù áëúåáú äãåàø äàì÷èøåðé ùöééðú',
	'enter_info' => 'ðà ìîìà àú ôøèé äøéùåí',
	'required_info' => 'îéãò çåáä',
	'optional_info' => 'îéãò øùåú',
	'username' => 'ùí îùúîù/ú',
	'password' => 'ñéñîä',
	'password_again' => 'åéãåà ñéñîä',
	'email' => 'ãåàø àì÷èøåðé',
	'location' => 'î÷åí',
	'interests' => 'úçåîé òðéï',
	'website' => 'ëúåáú àúø',
	'occupation' => 'òéñå÷',
	'error' => 'ú÷ìä',
	'confirm_email_subject' => '%s - àéùåø øéùåí',
	'information' => 'îéãò',
	'failed_sending_email' => 'ìà ðéúï ìùìåç äåãòú àéùåø øéùåí',
	'thank_you' => 'úåãä ùðøùîú.<br /><br />ðùìçä äåãòä ìëúåáú äãåàø äàì÷èøåðé ùöééðú, òí äåøàåú ìäôòìú çùáåðê.',
	'acct_created' => 'çùáåðê ðôúç åáàôùøåúê ìäúçáø áàîöòåú äùí åäñéñîä ùáçøú',
	'acct_active' => 'çùáåðê äåôòì åáàôùøåúê ìäúçáø áàîöòåú äùí åäñéñîä ùáçøú',
	'acct_already_act' => 'çùáåðê ëáø ôòéì!',
	'acct_act_failed' => 'ìà ðéúï ìäôòéì çùáåï æä!',
	'err_unk_user' => 'äîùúîù ùðáçø àéðå ÷ééí!',
	'x_s_profile' => 'äôøåôéì ùì %s',
	'group' => '÷áåöä',
	'reg_date' => 'äöèøôåú',
	'disk_usage' => 'äôç ãéñ÷ áùéîåù',
	'change_pass' => 'ùéðåé ñéñîä',
	'current_pass' => 'ñéñîä ðåëçéú',
	'new_pass' => 'ñéñîä çãùä',
	'new_pass_again' => 'åéãåà ñéñîä çãùä',
	'err_curr_pass' => 'äñéñîä äðåëçéú ùâåéä',
	'apply_modif' => 'áéöåò äùéðåééí',
	'change_pass' => 'ùéðåé äñéñîä ùìé',
	'update_success' => 'äôøåôéì ùìê òåãëï',
	'pass_chg_success' => 'ñéñîúê òåãëðä',
	'pass_chg_error' => 'ñéñîúê ìà òåãëðä',
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
	'title' => 'ñ÷éøú äòøåú',
	'no_comment' => 'àéï äòøåú ìñ÷åø',
	'n_comm_del' => '%s äòøåú ðîç÷å',
	'n_comm_disp' => 'îñôø äòøåú ìäöâä',
	'see_prev' => 'ãó äáà',
	'see_next' => 'ãó ÷åãí',
	'del_comm' => 'îçé÷ú ääòøåú äîñåîðåú',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => 'çéôåù áîàâø äúîåðåú',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => 'çéôåù úîåðåú çãùåú',
	'select_dir' => 'áçéøú îçéöä',
	'select_dir_msg' => 'ôòåìä æå îàôùøú ìê ìäåñéó ñãøú úîåðåú ùëáø äòáøú àì äàúø á-FTP.<br /><br />òìéê ìáçåø àú äîçéöä áùøú ùáä ðîöàåú äúîåðåú',
	'no_pic_to_add' => 'àéï úîåðåú ìäåñéó',
	'need_one_album' => 'öøéê ìéöåø ìôçåú àìáåí àçã ëãé ìäùúîù áôòåìä æå',
	'warning' => 'àæäøä',
	'change_perm' => 'äúåëðéú àéðä éëåìä ìëúåá áîçéöä æå. òìéê ìùðåú àú ääøùàä ì- 755 àå 777 ëãé ìäåñéó úîåðåú!',
	'target_album' => '<b>äåñôú úîåðåú ùì "</b>%s<b>" àì </b>%s',
	'folder' => 'úé÷éä',
	'image' => 'úîåðä',
	'album' => 'àìáåí',
	'result' => 'úåöàä',
	'dir_ro' => 'ìà ðéúï ìëúéáä. ',
	'dir_cant_read' => 'ìà ðéúï ì÷øéàä. ',
	'insert' => 'äåñôú úîåðä çãùä ìâìøéä',
	'list_new_pic' => 'øùéîú úîåðåú çãùåú',
	'insert_selected' => 'äëðñú äúîåðåú äîñåîðåú',
	'no_pic_found' => 'ìà ðîöàä àó úîåðä çãùä',
	'be_patient' => 'ðà ìäîúéï áñáìðåú òã ùäúåëðéú úñééí ìäåñéó àú äúîåðåú',
	'notes' =>  'î÷øà<ul>'.
				'<li><b>OK</b> : äúîåðä ðåñôä áäöìçä'.
				'<li><b>DP</b> : äúîåðä (àå úîåðä æää) ëáø ðîöàú áîàâø'.
				'<li><b>PB</b> : äåñôú äúîåðä ðëùìä. éù ìáãå÷ àú äâãøåú äîòøëú åàú ääøùàåú ìîçéöåú'.
				'<li>àí ñéîï OK/DP/PB ìà äåôéò, éù ììçåõ òì îñâøú äúîåðä åìáãå÷ àú äåãòú äùâéàä îîðåò PHP'.
				'<li>àí úåëðú äâìéùä îåãéòä "Time out", éù ììçåõ òì ëôúåø Refresh/Reload'.
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
                'title' => 'äøç÷ú îùúîùéí',
                'user_name' => 'ùí îùúîù',
                'ip_address' => 'ëúåáú IP',
                'expiry' => 'áúå÷ó òã (òøê øé÷ = ÷áåò)',
                'edit_ban' => 'ùîéøú ùéðåééí',
                'delete_ban' => 'îçé÷ä',
                'add_new' => 'äåñôú äøç÷ä',
                'add_ban' => 'äåñôä',
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
	'title' => 'äåñôú úîåðä',
	'max_fsize' => 'âåãì ä÷åáõ äî÷ñéîìé äîåúø %s KB',
	'album' => 'àìáåí',
	'picture' => 'úîåðä',
	'pic_title' => 'ëåúøú äúîåðä',
	'description' => 'úàåø äúîåðä',
	'keywords' => 'îéìåú îôúç (îåôøãåú áøååçéí)',
	'err_no_alb_uploadables' => 'ìà ðîöà àìáåí ùàìéå îåúø ìê ìäåñéó úîåðåú',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => 'ðéäåì îùúîùéí',
	'name_a' => 'ùí, ñãø òåìä',
	'name_d' => 'ùí, ñãø éåøã',
	'group_a' => '÷áåöä, ñãø òåìä',
	'group_d' => '÷áåöä, ñãø éåøã',
	'reg_a' => 'úàøéê øéùåí, ñãø òåìä',
	'reg_d' => 'úàøéê øéùåí, ñãø éåøã',
	'pic_a' => 'îñôø úîåðåú, ñãø òåìä',
	'pic_d' => 'îñôø úîåðåú, ñãø éåøã',
	'disku_a' => 'ðéöåì ãéñ÷, ñãø òåìä',
	'disku_d' => 'ðéöåì ãéñ÷, ñãø éåøã',
	'sort_by' => 'îéåï îùúîùéí ìôé',
	'err_no_users' => 'èáìú äîùúîùéí øé÷ä!',
	'err_edit_self' => 'àéï áàôùøåúê ìòøåê ëàï àú äôøåôéì ùì òöîê, ìùí ëê éù ììçåõ òì ÷éùåø "äôøåôéì ùìé"',
	'edit' => 'òøéëä',
	'delete' => 'îçé÷ä',
	'name' => 'ùí îùúîù',
	'group' => '÷áåöä',
	'inactive' => 'ìà ôòéì',
	'operations' => 'ôòåìåú',
	'pictures' => 'úîåðåú',
	'disk_space' => 'ðôç îðåöì / äøùàä',
	'registered_on' => 'øéùåí îúàøéê',
	'u_user_on_p_pages' => '%d îùúîùéí á- %d ãôéí',
	'confirm_del' => 'äàí àú/ä áèåç/ä ùáøöåðê ìîçå÷ îùúîù æä?\\nëì äàìáåîéí åäúîåðåú ùìå éîç÷å.',
	'mail' => 'ãåà"ì',
	'err_unknown_user' => 'äîùúîù ùðáçø àéðå ÷ééí',
	'modify_user' => 'ùéðåé îùúîù',
	'notes' => 'äòøåú',
	'note_list' => '<li>àí àéðê øåöä ìùðåú àú äñéñîä, òìéê ìäùàéø àú ùãä äñéñîä øé÷',
	'password' => 'ñéñîä',
	'user_active' => 'îùúîù ôòéì',
	'user_group' => '÷áåöä',
	'user_email' => 'ãåà"ì',
	'user_web_site' => 'àúø àéðèøðè',
	'create_new_user' => 'äâãøú îùúîù çãù',
	'user_location' => 'î÷åí',
	'user_interests' => 'úçåîé òðéï',
	'user_occupation' => 'òéñå÷',
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => 'ùéðåé âåãì úîåðåú',
        'what_it_does' => 'îä æä òåùä',
        'what_update_titles' => 'îòãëï ëåúøåú îùîåú ä÷áöéí',
        'what_delete_title' => 'îåç÷ ëåúøåú',
        'what_rebuild' => 'áåðä îçãù ãåâîéåú åúîåðåú áâãåì îåâãø',
        'what_delete_originals' => 'îåç÷ úîåðåú áâåãì äî÷åøé åîçìéôï áúîåðåú áâåãì îåâãø',
        'file' => '÷åáõ',
        'title_set_to' => 'ëåúøú ùåðúä ì-',
        'submit_form' => 'àéùåø',
        'updated_succesfully' => 'òåãëï áäöìçä',
        'error_create' => 'ú÷ìä áéöéøú',
        'continue' => 'äîùê ìòáã úîåðåú ðåñôåú',
        'main_success' => 'ä÷åáõ %s ð÷ìè áöìçä ëúîåðä øàùéú',
        'error_rename' => 'ú÷ìä áùéðåé äùí %s ì- %s',
        'error_not_found' => 'ä÷åáõ %s ìà ðîöà',
        'back' => 'çæøä ìøàùé',
        'thumbs_wait' => 'îòãëðéí ãåâîéåú å/àå úîåðåú - ðà ìäîúéï...',
        'thumbs_continue_wait' => 'îîùéê ìòãëï ãâåîéåú å/àå úîåðåú...',
        'titles_wait' => 'îòãëï ëåúøåú, ðà ìäîúéï...',
        'delete_wait' => 'îåç÷ ëåúøåú, ðà ìäîúéï...',
        'replace_wait' => 'îåç÷ úîåðåú î÷åøéåú åîçìéó àåúï áúîåðåú áâãåì îåâãø, ðà ìäîúéï...',
        'instruction' => 'äåøàåú î÷åöøåú',
        'instruction_action' => 'áçéøú ôòåìä',
        'instruction_parameter' => '÷áéòú ôøîèøéí',
        'instruction_album' => 'áçéøú àìáåí',
        'instruction_press' => 'ðà ììçåõ òì %s',
        'update' => 'òãëåï ãåâîéåú å/àå úîåðåú áâåãì îåâãø',
        'update_what' => 'îä öøéê ìòãëï',
        'update_thumb' => 'ø÷ ãåâîéåú',
        'update_pic' => 'ø÷ úîåðåú áâåãì îåâãø',
        'update_both' => 'äï ãåâîéåú åäï úîåðåú áâåãì îåâãø',
        'update_number' => 'îñôø úîåðåú ìòéáåã áëì ÷ìé÷',
        'update_option' => '(éù ìáçåø áòøê ðîåê éåúø àí îåôéòåú ú÷ìåú àå äåãòåú Timeout)',
        'filename_title' => 'ùí ÷åáõ = ëåúøú',
        'filename_how' => 'ëéöã ìòáã àú ùí ä÷åáõ',
        'filename_remove' => 'äñøú äñéåîú (ëâåï JPG) åäçìôú ÷å-úçúåï __ áøååç.',
        'filename_euro' => '÷øà úàøéê úàøéê áîáðä àøåôàé - úøâí 20_20_13_23_11_2003 ì: 13:20 23/11/2003',
        'filename_us' => '÷øà úàøéê áîáðä àîøé÷àé - úøâí 20_20_13_23_11_2003 ì: 13:20 11/23/2003',
        'filename_time' => '÷øà æîï áìáã - úøâí 20_20_13_23_11_2003 ì: 13:20',
        'delete' => 'îçé÷ú ëåúøåú àå úîåðåú áâåãì î÷åøé',
        'delete_title' => 'îçé÷ú ëåúøåú',
        'delete_original' => 'îçé÷ú úîåðåú áâåãì î÷åøé',
        'delete_replace' => 'îçé÷ú úîåðåú áâãåì î÷åøé åäçìôúï áúîåðåú áâåãì îåâãø',
        'select_album' => 'áçéøú àìáåí',
);

?>
