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
'lang_name_english' => 'Chinese Tranditional BIG5',  //the name of your language in English, e.g. 'Greek' or 'Spanish' 
'lang_name_native' => '中文繁體', //the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. 'Ελληνικ?' or 'Espanol' 
'lang_country_code' => 'cn', //the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es' 
'trans_name'=> 'Fatman', //the name of the translator - can be a nickname 
'trans_email' => 'fatman_li@yahoo.com.hk', //translator's email address (optional) 
'trans_website' => '', //translator's website (optional) 
'trans_date' => '2003-10-22', //the date the translation was created / last modified 
); 

$lang_charset = 'utf-8';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六');
$lang_month = array('一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月');

// Some common strings
$lang_yes = '是';
$lang_no  = '否';
$lang_back = '返回';
$lang_continue = '繼續';
$lang_info = '訊息';
$lang_error = '錯誤';

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
        'random' => '隨機圖片', 
        'lastup' => '最新上傳圖片', 
        'lastalb'=> '最近更新相簿', 
        'lastcom' => '最新意見', 
        'topn' => '熱門圖片', 
        'toprated' => '最高評分', 
        'lasthits' => '最近顯示', 
        'search' => '搜尋結果', 
        'favpics'=> '最愛圖片' 
); 

$lang_errors = array(
        'access_denied' => '你沒有使用本頁的權限.',
        'perm_denied' => 'Y你沒有權限執行此動作.',
        'param_missing' => '程式被呼叫而沒有需要的參數.',
        'non_exist_ap' => '所選擇的 相簿/圖片 不存在 !',
        'quota_exceeded' => '超過磁碟限額<br /><br />你的限額有 [quota]K, 已使用的有 [space]K, 加入此圖片會超過限額.',
        'gd_file_type_err' => '當使用 GD 圖像程式庫只容許 JPEG and PNG 圖檔.',
        'invalid_image' => '你上傳的檔案己經損壞, 或是 GD 圖像程式庫不能處理',
        'resize_failed' => '無法建立縮圖或縮小圖檔.',
        'no_img_to_display' => '未有圖片可以顯示.',
        'non_exist_cat' => '所選擇的類別並不存在.',
        'orphan_cat' => '這個子類別存於一個不存在的父類別, 請先至類別管理修正這個問題.',
        'directory_ro' => '目錄 \'%s\' 無法寫入, 導致圖片無法刪除',
        'non_exist_comment' => '所選擇的意見並不存在.',
        'pic_in_invalid_album' => '此圖片存於不存在的相簿 (%s)!?', //new in cpg1.2.0
        'banned' => '你被禁止使用本站.', //new in cpg1.2.0
        'not_with_udb' => '由於本相簿已和論壇程式整合, 此功能停止使用. 可能是現時設定不支援, 或已由論壇處理.', //new in cpg1.2.0
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
        'alb_list_title' => '返回相簿目錄',
        'alb_list_lnk' => '相簿目錄',
        'my_gal_title' => '返回我的相簿',
        'my_gal_lnk' => '我的相簿',
        'my_prof_lnk' => '我的個人資料',
        'adm_mode_title' => '轉為管理模式',
        'adm_mode_lnk' => '管理模式',
        'usr_mode_title' => '轉為用戶模式',
        'usr_mode_lnk' => '用戶模式',
        'upload_pic_title' => '上傳圖片至相簿',
        'upload_pic_lnk' => '上傳圖片',
        'register_title' => '建立帳號',
        'register_lnk' => '註冊',
        'login_lnk' => '登入',
        'logout_lnk' => '登出',
        'lastup_lnk' => '最新上傳',
        'lastcom_lnk' => '最新意見',
        'topn_lnk' => '熱門圖片',
        'toprated_lnk' => '最高評分',
        'search_lnk' => '搜尋',
        'fav_lnk' => '我的最愛', //new in cpg1.2.0

);

$lang_gallery_admin_menu = array(
        'upl_app_lnk' => '核准上傳',
        'config_lnk' => '設定',
        'albums_lnk' => '相簿',
        'categories_lnk' => '類別',
        'users_lnk' => '用戶',
        'groups_lnk' => '群組',
        'comments_lnk' => '意見',
        'searchnew_lnk' => '整批加入圖片',
        'util_lnk' => '調整圖片尺寸', //new in cpg1.2.0
        'ban_lnk' => '停權用戶', //new in cpg1.2.0
);

$lang_user_admin_menu = array(
        'albmgr_lnk' => '建立/排序 我的相簿',
        'modifyalb_lnk' => '編輯我的相簿',
        'my_prof_lnk' => '我的個人資料',
);

$lang_cat_list = array(
        'category' => '類別',
        'albums' => '相簿',
        'pictures' => '圖片',
);

$lang_album_list = array(
        'album_on_page' => '%d 相簿在 %d 頁'
);

$lang_thumb_view = array(
        'date' => '日期',
        //Sort by filename and title
        'name' => '檔名', //new in cpg1.2.0
        'title' => '標題', //new in cpg1.2.0
        'sort_da' => '排序依日期 由遠至近',
        'sort_dd' => '排序依日期 由近至遠',
        'sort_na' => '排序依名稱 由小至大',
        'sort_nd' => '排序依名稱 由大至小',
        'sort_ta' => '排序依標題 由小至大', //new in cpg1.2.0
        'sort_td' => '排序依標題 由大至小', //new in cpg1.2.0
        'pic_on_page' => '%d 圖片在 %d 頁',
        'user_on_page' => '%d 用戶在 %d 頁'
);

$lang_img_nav_bar = array(
        'thumb_title' => '返回縮圖頁',
        'pic_info_title' => '顯示/隱藏 圖片資訊',
        'slideshow_title' => '連續播放',
        'ecard_title' => '把圖片以 e-card 寄出',
        'ecard_disabled' => 'e-cards 功能停用',
        'ecard_disabled_msg' => '你無權使用 e-cards',
        'prev_title' => '觀看前一張圖片',
        'next_title' => '觀看下一張圖片',
        'pic_pos' => '圖片 %s/%s',
);

$lang_rate_pic = array(
        'rate_this_pic' => '投票 ',
        'no_votes' => '(尚未有投票)',
        'rating' => '(目前得分 : %s / 5 於 %s 個投票)',
        'rubbish' => '垃圾',
        'poor' => '差勁',
        'fair' => '一般',
        'good' => '滿意',
        'excellent' => '出色',
        'great' => '極好',
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
        CRITICAL_ERROR => '緊急錯誤',
        'file' => '檔案: ',
        'line' => '行數: ',
);

$lang_display_thumbnails = array(
        'filename' => '檔名 : ',
        'filesize' => '檔案大小 : ',
        'dimensions' => '尺寸 : ',
        'date_added' => '加入日期 : '
);

$lang_get_pic_data = array(
        'n_comments' => '%s 個意見',
        'n_views' => '%s 次觀看',
        'n_votes' => '(%s 個投票)'
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
        'Exclamation' => '感歎',
        'Question' => '疑問',
        'Very Happy' => '很高興',
        'Smile' => '微笑',
        'Sad' => '悲哀',
        'Surprised' => '驚訝',
        'Shocked' => '震驚',
        'Confused' => '混亂',
        'Cool' => '很棒',
        'Laughing' => '發笑',
        'Mad' => '發狂',
        'Razz' => '嘲笑',
        'Embarassed' => '尷尬',
        'Crying or Very sad' => '嚎哭',
        'Evil or Very Mad' => '惡毒',
        'Twisted Evil' => '古怪',
        'Rolling Eyes' => '旋轉的眼睛',
        'Wink' => '眨眼',
        'Idea' => '主意',
        'Arrow' => '箭頭',
        'Neutral' => '中立',
        'Mr. Green' => '格林先生',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
        0 => '正離開管理模式...',
        1 => '正進入管理模式...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
        'alb_need_name' => '您需要給相簿一個名稱 !',
        'confirm_modifs' => '確定要做這些修改嗎 ?',
        'no_change' => '您沒有做任何改變 !',
        'new_album' => '新相簿',
        'confirm_delete1' => '確定要刪除此相簿嗎 ?',
        'confirm_delete2' => '\n所有圖片及意見都會刪除 !',
        'select_first' => '請先選擇一個相簿',
        'alb_mrg' => '相簿管理員',
        'my_gallery' => '* 我的相簿 *',
        'no_category' => '* 沒有類別 *',
        'delete' => '刪除',
        'new' => '新增',
        'apply_modifs' => '修改',
        'select_category' => '選擇類別',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
        'miss_param' => '\'%s\'操作所需要的參數並未提供 !',
        'unknown_cat' => '所選擇的類別並不存在於資料庫',
        'usergal_cat_ro' => '用戶相簿類別不能刪除 !',
        'manage_cat' => '類別管理',
        'confirm_delete' => '確定要刪除此類別嗎',
        'category' => '類別',
        'operations' => '操作',
        'move_into' => '搬移至',
        'update_create' => '更新/建立 類別',
        'parent_cat' => '父類別',
        'cat_title' => '類別標題',
        'cat_desc' => '類別描述'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
        'title' => '設定',
        'restore_cfg' => '回復原始設定',
        'save_cfg' => '儲存新設定',
        'notes' => '注意',
        'info' => '訊息',
        'upd_success' => '設定已更新',
        'restore_success' => '原始設定已回復',
        'name_a' => '排序依名稱 由小至大',
        'name_d' => '排序依名稱 由大至小',
        'title_a' => '排序依標題 由小至大', //new in cpg1.2.0
        'title_d' => '排序依標題 由大至小', //new in cpg1.2.0
        'date_a' => '排序依日期 由遠至近',
        'date_d' => '排序依日期 由近至遠'
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
        '基本設定',
        array('相簿名稱', 'gallery_name', 0),
        array('相簿描述', 'gallery_description', 0),
        array('相簿管理員電郵', 'gallery_admin_email', 0),
        array('在e-cards內顯示\'觀看更多圖片\'的網址', 'ecards_more_pic_target', 0),
        array('語言', 'lang', 5),
        //array('enable language selection', 'lang_select_enable', 8 ), 
        array('佈景', 'theme', 6),
        //array('enable theme selection', 'theme_select_enable', 8),

        '相簿目錄顯示',
        array('主要表格寬度 (像素或 %)', 'main_table_width', 0),
        array('同一層次的子類別顯示個數', 'subcat_level', 0),
        array('相簿顯示個數', 'albums_per_page', 0),
        array('相簿目錄頁相簿欄數', 'album_list_cols', 0),
        array('縮圖像素', 'alb_list_thumb_size', 0),
        array('主頁的內容', 'main_page_layout', 0),
        array('顯示分類中第一層的相簿縮圖','first_level',1), //new in cpg1.2.0

        '縮圖顯示',
        array('縮圖頁欄數', 'thumbcols', 0),
        array('縮圖頁列數', 'thumbrows', 0),
        array('表格顯示最高個數', 'max_tabs', 0),
        array('顯示圖片說明於縮圖下方 (附加的標題)', 'caption_in_thumbview', 1),
        array('顯示意見數於縮圖下方', 'display_comment_count', 1),
        array('圖片的原始排序次序', 'default_sort_order', 3),
        array('\'熱門投票\'需要最少投票數', 'min_votes_for_rating', 0),

        '圖片顯示 &amp; 意見設定',
        array('圖片顯示的表格寬度 (像素或 %)', 'picture_table_width', 0),
        array('圖片資訊預設顯示', 'display_pic_info', 1),
        array('意見內過濾不良詞彙', 'filter_bad_words', 1),
        array('意見可以使用笑臉圖示', 'enable_smilies', 1),
        array('圖片描述內容的最大長度', 'max_img_desc_length', 0),
        array('描述內容的最大字數', 'max_com_wlength', 0),
        array('意見的最大行數', 'max_com_lines', 0),
        array('意見的最大長度', 'max_com_size', 0),
        array('顯示圖片預覽列', 'display_film_strip', 1), //new in cpg1.2.0
        array('圖片預覽列的圖片數', 'max_film_strip_items', 0), //new in cpg1.2.0

        '圖片及縮圖設定',
        array('JPEG 格式品質', 'jpeg_qual', 0),
        array('縮圖最大尺寸 <b>*</b>', 'thumb_width', 0), //new in cpg1.2.0
        array('使用尺寸 ( 寬、高或縮圖最大邊長 )<b>*</b>', 'thumb_use', 7),    //new in cpg1.2.0
        array('建立中級圖片','make_intermediate',1),
        array('中級圖片最大尺寸 <b>*</b>', 'picture_width', 0),
        array('上傳圖檔的最大限制 (KB)', 'max_upl_size', 0),
        array('上傳圖片最大尺寸 (像素)', 'max_upl_width_height', 0),

        '用戶設定',
        array('允許新用戶註冊', 'allow_user_registration', 1),
        array('註冊需要電郵驗證', 'reg_requires_valid_email', 1),
        array('允許不同用戶使用同一個電郵地址', 'allow_duplicate_emails_addr', 1),
        array('用戶可以有私人的相簿', 'allow_private_albums', 1),

        '圖片描述的自訂欄位 (如果不使用請留下空白)',
        array('欄位 1 名稱', 'user_field1_name', 0),
        array('欄位 2 名稱', 'user_field2_name', 0),
        array('欄位 3 名稱', 'user_field3_name', 0),
        array('欄位 4 名稱', 'user_field4_name', 0),

        '圖片和縮圖的進階設定',
        array('顯示私人相簿圖示給末登入用戶','show_private',1), //new in cpg1.2.0
        array('檔案名稱不接受的字符', 'forbiden_fname_char',0),
        array('上傳圖檔可接受的副檔名', 'allowed_file_extensions',0),
        array('建立縮圖的方法','thumb_method',2),
        array('ImageMagick \'convert\' 程式的路徑 (例如 /usr/bin/X11/)', 'impath', 0),
        array('可接受的圖檔類型(只對 ImageMagick 有效)', 'allowed_img_types',0),
        array('ImageMagick 的命令列選項', 'im_options', 0),
        array('讀取 JPEG 檔案的 EXIF 資料', 'read_exif_data', 1),
        array('相簿路徑 <b>*</b>', 'fullpath', 0),
        array('用戶圖檔路徑 <b>*</b>', 'userpics', 0),
        array('中級圖檔的前置字元 <b>*</b>', 'normal_pfx', 0),
        array('縮圖檔的前置字元 <b>*</b>', 'thumb_pfx', 0),
        array('放置圖檔目錄的預設權限', 'default_dir_mode', 0),
        array('上傳圖片的預設權限', 'default_file_mode', 0),
        array('防止在彈出視窗用滑鼠右鍵 (JavaScript - 簡單保護)', 'disable_popup_rightclick', 1), //new in cpg1.2.0
        array('防止在一般視窗用滑鼠右鍵 (JavaScript - 簡單保護)', 'disable_gallery_rightclick', 1), //new in cpg1.2.0

        'Cookies &amp; 編碼設定',
        array('使用的 cookie 名稱', 'cookie_name', 0),
        array('使用的 cookie 路徑', 'cookie_path', 0),
        array('編碼設定', 'charset', 4),

        '其他設定',
        array('啟動除錯模式', 'debug_mode', 1),

        '<br /><div align="center">(*) 若相簿內有圖片, 標示有 * 的欄位表示不可更改</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
        'empty_name_or_com' => '請輸入你的名字和意見',
        'com_added' => '您的意見已經加入',
        'alb_need_title' => '您必須為相簿提供一個標題!',
        'no_udp_needed' => '沒有更新的必要.',
        'alb_updated' => '相簿已經更新',
        'unknown_album' => '所選擇的相簿不存在或您沒有權限上傳圖片到此相簿',
        'no_pic_uploaded' => '沒有圖片被上傳 !<br /><br />如果您確定有選擇圖片上傳, 請檢查伺服器是否允許上傳檔案...',
        'err_mkdir' => '無法建立目錄 %s !',
        'dest_dir_ro' => '目錄 %s  無法寫入!',
        'err_move' => '無法搬移 %s 到 %s !',
        'err_fsize_too_large' => '您上傳的圖片太大 (不能超過 %s x %s) !',
        'err_imgsize_too_large' => '您上傳的圖檔太大 (不能超過 %s KB) !',
        'err_invalid_img' => '上傳的檔案並不是容許的圖片格式!',
        'allowed_img_types' => '您只可以上傳 %s 張圖片.',
        'err_insert_pic' => '圖片 \'%s\' 無法加入此相簿.',
        'upload_success' => '圖片上傳完成<br /><br />當管理者核准後就可以看到圖片.',
        'info' => '訊息',
        'com_added' => '意見已加入',
        'alb_updated' => '相簿已經更新',
        'err_comment_empty' => '意見是空的!',
        'err_invalid_fext' => '只有下列的副檔名才容許 : <br /><br />%s.',
        'no_flood' => '抱歉, 此圖片最後一個意見是您提供<br /><br />您可以修改您的意見',
        'redirect_msg' => '頁面轉移中.<br /><br /><br />按 \'繼續\' 如果頁面沒有自動刷新',
        'upl_success' => '已經加入您的圖片',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
        'caption' => '說明',
        'fs_pic' => '原大圖片',
        'del_success' => '完成刪除',
        'ns_pic' => '標準尺寸圖片',
        'err_del' => '無法刪除',
        'thumb_pic' => '縮圖',
        'comment' => '意見',
        'im_in_alb' => '相簿內圖片',
        'alb_del_success' => '相簿 \'%s\' 已刪除',
        'alb_mgr' => '相簿管理',
        'err_invalid_data' => '接收到不正確的資料於 \'%s\'',
        'create_alb' => '建立相簿 \'%s\'',
        'update_alb' => '更新相簿 \'%s\' 標題為 \'%s\' 索引為 \'%s\'',
        'del_pic' => '刪除圖片',
        'del_alb' => '刪除相簿',
        'del_user' => '刪除用戶',
        'err_unknown_user' => '所選擇的用戶不存在 !',
        'comment_deleted' => '意見已刪除',
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
        'confirm_del' => '確定要刪除此圖片嗎 ? \\n意見也會被刪除.',
        'del_pic' => '刪除此圖片',
        'size' => '%s x %s 像素',
        'views' => '%s 次',
        'slideshow' => '連續播放',
        'stop_slideshow' => '停止播放',
        'view_fs' => '點選圖片以觀看原本尺寸',
);

$lang_picinfo = array(
        'title' =>'圖片資訊',
        'Filename' => '檔案名稱',
        'Album name' => '相簿名稱',
        'Rating' => '評分 (%s 次投票)',
        'Keywords' => '關鍵字',
        'File Size' => '檔案大小',
        'Dimensions' => '尺寸',
        'Displayed' => '顯示',
        'Camera' => '相機',
        'Date taken' => '拍攝日期',
        'Aperture' => '光圈',
        'Exposure time' => '曝光時間',
        'Focal length' => '焦距',
        'Comment' => '意見',
        'addFav'=>'加到我的最愛', //new in cpg1.2.0
        'addFavPhrase'=>'我的最愛', //new in cpg1.2.0
        'remFav'=>'從我的最愛移除', //new in cpg1.2.0
);

$lang_display_comments = array(
        'OK' => 'OK',
        'edit_title' => '編輯此意見',
        'confirm_delete' => '確定要刪除此意見 ?',
        'add_your_comment' => '加入你的意見',
        'name'=>'名稱', //new in cpg1.2.0
        'comment'=>'意見', //new in cpg1.2.0
        'your_name' => '匿名', //new in cpg1.2.0
);

$lang_fullsize_popup = array(
        'click_to_close' => '點選圖片以關閉視窗', //new in cpg1.2.0
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
        'title' => '寄出 e-card',
        'invalid_email' => '<b>警告</b> : 不正確的電郵地址 !',
        'ecard_title' => '%s 寄來給你的 e-card',
        'view_ecard' => '如果 e-card 無法正確顯示, 請按此連結',
        'view_more_pics' => '按此連結看更多圖片 !',
        'send_success' => '你的 e-card 寄出',
        'send_failed' => '抱歉, 本伺服器無法為你寄出 e-card...',
        'from' => '由',
        'your_name' => '你的名稱',
        'your_email' => '你的電郵地址',
        'to' => '給',
        'rcpt_name' => '收件者名稱',
        'rcpt_email' => '收件者電郵地址',
        'greetings' => '問候',
        'message' => '訊息內容',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
        'pic_info' => '圖片資訊',
        'album' => '相簿',
        'title' => '標題',
        'desc' => '描述',
        'keywords' => '關鍵字',
        'pic_info_str' => '%sx%s - %sKB - %s 次觀看 - %s 次投票',
        'approve' => '核准圖片',
        'postpone_app' => '延遲核准',
        'del_pic' => '刪除圖片',
        'reset_view_count' => '重設觀看計數器',
        'reset_votes' => '重設投票',
        'del_comm' => '刪除意見',
        'upl_approval' => '核准上傳',
        'edit_pics' => '編輯圖片',
        'see_next' => '觀看下一張圖片',
        'see_prev' => '觀看前一張圖片',
        'n_pic' => '%s 張圖片',
        'n_of_pic_to_disp' => '圖片顯示數量',
        'apply' => '修改'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
        'group_name' => '群組名稱',
        'disk_quota' => '磁碟限額',
        'can_rate' => '容許為圖片評分',
        'can_send_ecards' => '容許寄出 ecards',
        'can_post_com' => '容許貼出意見',
        'can_upload' => '容許上傳圖片',
        'can_have_gallery' => '容許有個人相簿',
        'apply' => '修改',
        'create_new_group' => '建立新群組',
        'del_groups' => '刪除所選擇的群組',
        'confirm_del' => '警告, 當刪除了一個群組, 屬於該群組的用戶將被轉移至 \'Registered\' 群組中 !\n\nn確定要刪除 ?',
        'title' => '管理用戶群組',
        'approval_1' => '公開相簿上傳核准 (1)',
        'approval_2' => '私人相簿上傳核准 (2)',
        'note1' => '<b>(1)</b> 上傳圖片至公開相簿需管理員核准',
        'note2' => '<b>(2)</b> 上傳圖片至私人相簿需管理員核准',
        'notes' => '注意'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
        'welcome' => '歡迎 !'
);

$lang_album_admin_menu = array(
        'confirm_delete' => '確定要刪除這相簿 ? \\n所有圖片及意見都會刪除.',
        'delete' => '刪除',
        'modify' => '屬性',
        'edit_pics' => '編輯圖片',
);

$lang_list_categories = array(
        'home' => '主頁',
        'stat1' => '<b>[pictures]</b> 張圖片於 <b>[albums]</b> 個相簿及 <b>[cat]</b> 個類別, 有 <b>[comments]</b> 個意見, 被觀看 <b>[views]</b> 次',
        'stat2' => '<b>[pictures]</b> 張圖片於 <b>[albums]</b> 個相簿, 被觀看 <b>[views]</b> 次',
        'xx_s_gallery' => '%s\'s 相簿',
        'stat3' => '<b>[pictures]</b> 張圖片於 <b>[albums]</b> 個相簿, 有 <b>[comments]</b> 個意見, 被觀看 <b>[views]</b> 次'
);

$lang_list_users = array(
        'user_list' => '用戶列表',
        'no_user_gal' => '未有用戶相簿',
        'n_albums' => '%s 個相簿',
        'n_pics' => '%s 張圖片'
);

$lang_list_albums = array(
        'n_pictures' => '%s 張圖片',
        'last_added' => ', 最新圖片於 %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
        'login' => '登入',
        'enter_login_pswd' => '輸入用戶名稱和密碼',
        'username' => '用戶名稱',
        'password' => '密碼',
        'remember_me' => '記住密碼',
        'welcome' => '歡迎 %s ...',
        'err_login' => '*** 無法登入. 請重試 ***',
        'err_already_logged_in' => '您已經登入 !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
        'logout' => '登出',
        'bye' => '再見 %s ...',
        'err_not_loged_in' => '您尚未登入 !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
        'upd_alb_n' => '更新相簿 %s',
        'general_settings' => '一般設定',
        'alb_title' => '相簿標題',
        'alb_cat' => '相簿類別',
        'alb_desc' => '相簿描述',
        'alb_thumb' => '相簿縮圖',
        'alb_perm' => '相簿權限',
        'can_view' => '相簿可觀看',
        'can_upload' => '訪客可上傳圖片',
        'can_post_comments' => '訪客可貼出意見',
        'can_rate' => '訪客可為圖片評分',
        'user_gal' => '用戶相簿',
        'no_cat' => '* 沒有類別 *',
        'alb_empty' => '相簿是空的',
        'last_uploaded' => '最近上傳',
        'public_alb' => '任何人 (公開相簿)',
        'me_only' => '只有我',
        'owner_only' => '只有相簿擁有人 (%s)',
        'groupp_only' => '群組 \'%s\' 會員',
        'err_no_alb_to_modify' => '資料庫內沒有您可修改的相簿.',
        'update' => '更新相簿'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
        'already_rated' => '抱歉, 您已經為此圖片評分',
        'rate_ok' => '您的投票已經被接受',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
{SITE_NAME} 的管理員會儘快整理會引起反感的資料, 但我們不可能觀看每一份文件. 因此您必需同意所有文件只是代表作者的立場及意見, 不代表管理人員的立場 (除了由他們貼出) 並不負任何法律責任.<br />
<br />
您必需同意不可張貼任何色情, 暴力, 不良, 不正當, 不健康, 妨害國家安全, 或任何可能違法的文件.  {SITE_NAME} 人員在任何時候都有權過濾並編輯您張貼的內容. 並且用戶留在本站內的資料已存在資料庫中. 末經您的同意, 我們不會將您的資料轉給其他人使用, 不過我們不會為任何因駭客行為而外洩的資料負任何責任.<br />
<br />
本站使用 cookies 在您的電腦上來儲存資訊. 這樣是方便您更愉快瀏覽. 您的電郵地址只是讓我們認證您的資料而已.<br />
<br />
按下 '我同意' 代表您同意以上條款.
EOT;

$lang_register_php = array(
        'page_title' => '用戶註冊',
        'term_cond' => '條款與規則',
        'i_agree' => '我同意',
        'submit' => '提交註冊',
        'err_user_exists' => '您所填寫的用戶名稱已被人使用, 請重選一個',
        'err_password_mismatch' => '兩次密碼不合, 請重填一次',
        'err_uname_short' => '用戶名稱至少需 2 個字元',
        'err_password_short' => '密碼至少需 2 個字元',
        'err_uname_pass_diff' => '用戶名稱和密碼不可以相同',
        'err_invalid_email' => '電郵地址不正確',
        'err_duplicate_email' => '這個電郵地址已經被其他人使用過了',
        'enter_info' => '輸入註冊資料',
        'required_info' => '必要的資料',
        'optional_info' => '非必要的資料',
        'username' => '用戶名稱',
        'password' => '密碼',
        'password_again' => '確認密碼',
        'email' => '電郵地址',
        'location' => '地區',
        'interests' => '興趣',
        'website' => '網址',
        'occupation' => '職業',
        'error' => '錯娛',
        'confirm_email_subject' => '%s - 註冊認證',
        'information' => '訊息',
        'failed_sending_email' => '所註冊的電郵地址無法寄出!',
        'thank_you' => '感謝您的註冊.<br /><br />一封內含有如何啟用帳號的資訊電郵將被送到您所提供的信箱.',
        'acct_created' => '您的帳號已經建立, 現在您可以登入',
        'acct_active' => '您的帳號已經啟用, 現在您可以登入',
        'acct_already_act' => '您的帳號已經啟用 !',
        'acct_act_failed' => '此帳號無法啟用 !',
        'err_unk_user' => '所選擇的用戶並不存在 !',
        'x_s_profile' => '%s\'的個人資料',
        'group' => '群組',
        'reg_date' => '加入',
        'disk_usage' => '磁碟使用量',
        'change_pass' => '修改密碼',
        'current_pass' => '現行密碼',
        'new_pass' => '新密碼',
        'new_pass_again' => '確認新密碼',
        'err_curr_pass' => '現行密碼不正確',
        'apply_modif' => '修改',
        'change_pass' => '修改密碼',
        'update_success' => '你的個人資料已經更新',
        'pass_chg_success' => '你的密碼已經修改',
        'pass_chg_error' => '你的密碼沒有修改',
);

$lang_register_confirm_email = <<<EOT
感謝您在 {SITE_NAME} 的註冊

您的用戶名稱 is : "{USER_NAME}"
您的密碼 is : "{PASSWORD}"

請您按下面的連結以啟動您的帳號
或者把此連結貼上瀏覽器上.

{ACT_LINK}

致意,

{SITE_NAME} 敬上

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
        'title' => '觀看意見',
        'no_comment' => '尚未有意見可以觀看',
        'n_comm_del' => '%s 個意見已刪除',
        'n_comm_disp' => '顯示的意見數量',
        'see_prev' => '看前一個',
        'see_next' => '看下一個',
        'del_comm' => '刪除所選的意見',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
        0 => '搜尋圖片內容',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
        'page_title' => '搜尋新圖片',
        'select_dir' => '選擇目錄',
        'select_dir_msg' => '本功能可以讓你用 FTP 上傳整批圖片.<br /><br />請選擇你已上傳圖片的目錄',
        'no_pic_to_add' => '沒有圖片可以加入',
        'need_one_album' => '使用此功能必需少要有一個相簿',
        'warning' => '警告',
        'change_perm' => '程式無法寫入這個目錄, 請修改權限至 755 或r 777 後再試一次 !',
        'target_album' => '<b>把圖片由 &quot;</b>%s<b>&quot; 到 </b>%s',
        'folder' => '資料夾',
        'image' => '圖片',
        'album' => '相簿',
        'result' => '結果',
        'dir_ro' => '無法寫入. ',
        'dir_cant_read' => '無法讀取. ',
        'insert' => '新增圖片至相簿',
        'list_new_pic' => '列出新圖片',
        'insert_selected' => '加入所選擇的圖片',
        'no_pic_found' => '沒有找到新圖片',
        'be_patient' => '請耐心等候, 程式需要一點時間來加入所選圖片',
        'notes' =>  '<ul>'.
                                '<li><b>OK</b> : 表示圖片已成功被加入'.
                                '<li><b>DP</b> : 表示圖片重覆或已存在資料庫'.
                                '<li><b>PB</b> : 表示圖片無法加入, 請檢查設定或圖片存放目錄的權限'.
                                '<li>If the OK, DP, PB \'符號\' 沒有顯示請按壞掉的圖片查看 PHP 顯示的錯誤訊息'.
                                '<li>如果瀏覽器逾時, 請按重新整理'.
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
                'title' => '停權用戶', //new in cpg1.2.0
                'user_name' => '用戶名稱', //new in cpg1.2.0
                'ip_address' => 'IP位址', //new in cpg1.2.0
                'expiry' => '期限（空白代表永久停權）', //new in cpg1.2.0
                'edit_ban' => '儲存修改', //new in cpg1.2.0
                'delete_ban' => '刪除', //new in cpg1.2.0
                'add_new' => '新增停權用戶', //new in cpg1.2.0
                'add_ban' => '新增', //new in cpg1.2.0
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
        'title' => '上傳圖片',
        'max_fsize' => '可允許的檔案最大為 %s KB',
        'album' => '相簿',
        'picture' => '圖片',
        'pic_title' => '圖片標題',
        'description' => '圖片描述',
        'keywords' => '關鍵字 (以空格區隔)',
        'err_no_alb_uploadables' => '目前尚未有相簿可以上傳圖片',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
        'title' => '用戶管理',
        'name_a' => '名稱 由小至大',
        'name_d' => '名稱 由大至小',
        'group_a' => '群組 由小至大',
        'group_d' => '群組 由大至小',
        'reg_a' => '註冊日期 由遠至近',
        'reg_d' => '註冊日期 由近至遠',
        'pic_a' => '圖片數 由小至大',
        'pic_d' => '圖片數 由大至小',
        'disku_a' => '磁碟用量 由小至大',
        'disku_d' => '磁碟用量 由大至小',
        'sort_by' => '用戶排序依',
        'err_no_users' => '用戶資料表是空的 !',
        'err_edit_self' => '您無法編輯您的個人資料, 請利用 \'我的個人資料\' 來編輯',
        'edit' => '編輯',
        'delete' => '刪除',
        'name' => '用戶名稱',
        'group' => '群組',
        'inactive' => '未啟動',
        'operations' => '操作',
        'pictures' => '圖片',
        'disk_space' => '磁碟 用量 / 限額',
        'registered_on' => '註冊日',
        'u_user_on_p_pages' => '%d 個用戶於 %d 頁',
        'confirm_del' => '確定要刪除這個用戶嗎? \\n所有他的相簿及圖片都會被刪除.',
        'mail' => '電郵',
        'err_unknown_user' => '所選擇的用戶並不存在t !',
        'modify_user' => '編輯用戶',
        'notes' => '注意',
        'note_list' => '<li>如果不想改變現行密碼, 請將 "密碼" 位留下空白',
        'password' => '密碼',
        'user_active' => '用戶已啟動',
        'user_group' => '用戶群組',
        'user_email' => '用戶電郵',
        'user_web_site' => '用戶網址',
        'create_new_user' => '建立新用戶',
        'user_location' => '用戶地區',
        'user_interests' => '用戶興趣',
        'user_occupation' => '用戶職業',
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => '調整圖片尺寸', //new in cpg1.2.0
        'what_it_does' => '這是做甚麼', //new in cpg1.2.0
        'what_update_titles' => '以檔名更新標題', //new in cpg1.2.0
        'what_delete_title' => '刪除標題', //new in cpg1.2.0
        'what_rebuild' => '重新建立縮圖及調整尺寸', //new in cpg1.2.0
        'what_delete_originals' => '刪除原始尺寸的圖片並以調整過尺寸的取代', //new in cpg1.2.0
        'file' => '檔案', //new in cpg1.2.0
        'title_set_to' => '標題已設成', //new in cpg1.2.0
        'submit_form' => '送出', //new in cpg1.2.0
        'updated_succesfully' => '更新完成', //new in cpg1.2.0
        'error_create' => '新增錯誤中', //new in cpg1.2.0
        'continue' => '處理更多圖片', //new in cpg1.2.0
        'main_success' => '檔案 %s 已設為主圖', //new in cpg1.2.0
        'error_rename' => '錯誤 %s 改名為 %s', //new in cpg1.2.0
        'error_not_found' => '找不到檔案 %s ', //new in cpg1.2.0
        'back' => '回主頁', //new in cpg1.2.0
        'thumbs_wait' => '正在更新縮圖及(或)調整圖片尺寸, 請稍候...', //new in cpg1.2.0
        'thumbs_continue_wait' => '繼續更新縮圖及(或)調整圖片尺寸...', //new in cpg1.2.0
        'titles_wait' => '標題更新中, 請稍候...', //new in cpg1.2.0
        'delete_wait' => '刪除標題中, 請稍候...', //new in cpg1.2.0
        'replace_wait' => '正以調整尺寸的圖片取代原始尺寸圖片中, 請稍候..', //new in cpg1.2.0
        'instruction' => '簡易操作說明', //new in cpg1.2.0
        'instruction_action' => '請選擇操作', //new in cpg1.2.0
        'instruction_parameter' => '設定參數', //new in cpg1.2.0
        'instruction_album' => '選擇相簿', //new in cpg1.2.0
        'instruction_press' => '請按 %s', //new in cpg1.2.0
        'update' => '更新縮圖及(或)調整尺寸的圖片', //new in cpg1.2.0
        'update_what' => '甚麼要更新', //new in cpg1.2.0
        'update_thumb' => '只有縮圖', //new in cpg1.2.0
        'update_pic' => '只有調整尺寸的圖片', //new in cpg1.2.0
        'update_both' => '縮圖及調整尺寸的圖片', //new in cpg1.2.0
        'update_number' => '每點選一次要處理的圖片數目', //new in cpg1.2.0
        'update_option' => '(如果您遇到操作程序逾時的問題，請試著降低此設定)', //new in cpg1.2.0
        'filename_title' => '檔名 &rArr; 圖片標題', //new in cpg1.2.0
        'filename_how' => '如何修改檔名', //new in cpg1.2.0
        'filename_remove' => '刪除 .jpg 並將 _ (底線) 用空格取代', //new in cpg1.2.0
        'filename_euro' => '將 2003_11_23_13_20_20.jpg 改為 23/11/2003 13:20', //new in cpg1.2.0
        'filename_us' => '將 2003_11_23_13_20_20.jpg 改為 11/23/2003 13:20', //new in cpg1.2.0
        'filename_time' => '將 2003_11_23_13_20_20.jpg 改為 13:20', //new in cpg1.2.0
        'delete' => '刪除圖片標題或原始尺寸的圖片', //new in cpg1.2.0
        'delete_title' => '刪除圖片標題', //new in cpg1.2.0
        'delete_original' => '刪除原始尺寸的圖片', //new in cpg1.2.0
        'delete_replace' => '刪除原始尺寸的圖片並以調整尺寸的圖片取代', //new in cpg1.2.0
        'select_album' => '選擇相簿', //new in cpg1.2.0
);

?>