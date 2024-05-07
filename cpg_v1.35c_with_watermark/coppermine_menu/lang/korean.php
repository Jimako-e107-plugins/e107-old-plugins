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
'lang_name_native' => '한국어', //the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol'
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
$lang_yes = '예';
$lang_no  = '아니오';
$lang_back = '뒤로';
$lang_continue = '다음';
$lang_info = '안내';
$lang_error = '에러';

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
	'random' => '포토뉴스 갤러리',
        'lastup' => '최근 이미지',
        'lastalb'=> '최근 수정된 앨범', //new in cpg1.2.0
        'lastcom' => '최근 코멘트',
        'topn' => '최다 조회',
        'toprated' => '최고 평점',
        'lasthits' => '마지막 조회',
        'search' => '검색 결과', //new in cpg1.2.0
        'favpics'=> '선호 사진' //new in cpg1.2.0
);

$lang_errors = array(
        'access_denied' => '회원님의 권한으로 이페지를 보실 수 없습니다. 관리자에게 문의하세요.',
        'perm_denied' => '회원님의 권한으로 실행할 수 없는 명령입니다.',
        'param_missing' => '필수항목을 확인하세요.',
        'non_exist_ap' => '선택한 앨범이나 이미지가 존재하지 않습니다 !',
        'quota_exceeded' => '할당용량 초과,<br /><br />할당된 디스크[quota]K, 사용가능한 용량[space]K, 할당용량 초과로 업로드할 수 없음.',
        'gd_file_type_err' => 'JPEG와 PNG파일만 지원됨.',
        'invalid_image' => '비정상 파일 또는 갤러리에서 지원되지않는 파일입니다.',
        'resize_failed' => '썸네일이 생성되지 않았습니다.혹은 사진크기를 바꿀 수 없습니다.',
        'no_img_to_display' => '표시할 이미지가 없습니다.',
        'non_exist_cat' => '선택한 카테고리는 존재하지 않습니다.',
        'orphan_cat' => '상위 카테고리가 존재하지않습니다. 관리자에게 문의하세요.',
        'directory_ro' => '폴더 \'%s\' 에 쓰기를 할 수 없습니다. 사진을 지울 수 없습니다.',
        'non_exist_comment' => '선택한 코멘트는 존재하지 않습니다.',
        'pic_in_invalid_album' => '존재하지않는 앨범이미지(%s)!?', //new in cpg1.2.0
        'banned' => '귀하는 지금 이사이트의 사용금지자명단에 있습니다.', //new in cpg1.2.0
        'not_with_udb' => '이기능을 쿠퍼마인에서 사용할 수 없습니다. 이기능은 포럼소프트웨어에 포함이 되어 있기 때문입니다.', //new in cpg1.2.0
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
        'alb_list_title' => '앨범목록으로',
        'alb_list_lnk' => '앨범목록',
        'my_gal_title' => '개인갤러리로',
        'my_gal_lnk' => '개인갤러리',
        'my_prof_lnk' => '개인정보',
        'adm_mode_title' => '관리모드로 전환',
        'adm_mode_lnk' => '관리모드',
        'usr_mode_title' => '일반모드로 전환',
        'usr_mode_lnk' => '일반모드',
	'upload_pic_title' => '앨범에 이미지 업로드',
	'upload_pic_lnk' => '이미지업로드',
        'register_title' => '계정생성',
        'register_lnk' => '회원등록',
        'login_lnk' => '로그인',
        'logout_lnk' => '로그아웃',
	'lastup_lnk' => '최근이미지',
        'lastcom_lnk' => '최근코멘트',
        'topn_lnk' => '최다조회',
        'toprated_lnk' => '최고평점',
        'search_lnk' => '검색',
        'fav_lnk' => '즐겨찾기', //new in cpg1.2.0

);

$lang_gallery_admin_menu = array(
        'upl_app_lnk' => '업로드승인',
        'config_lnk' => '환경설정',
        'albums_lnk' => '앨범관리',
        'categories_lnk' => '카테고리관리',
        'users_lnk' => '회원관리',
        'groups_lnk' => '그룹관리',
        'comments_lnk' => '코멘트관리',
        'searchnew_lnk' => 'FTP업로드파일연결',
        'util_lnk' => '이미지크기 수정', //new in cpg1.2.0
        'ban_lnk' => '사용금지자', //new in cpg1.2.0
);

$lang_user_admin_menu = array(
        'albmgr_lnk' => '개인앨범 생성 및 관리',
        'modifyalb_lnk' => '개인앨범 수정',
        'my_prof_lnk' => '개인정보',
);

$lang_cat_list = array(
        'category' => '카테고리',
        'albums' => '앨범',
        'pictures' => '이미지',
);

$lang_album_list = array(
        'album_on_page' => '앨범 %d  페이지 %d'
);

$lang_thumb_view = array(
        'date' => '일자',
        //Sort by filename and title
        'name' => '파일이름', //new in cpg1.2.0
        'title' => '제목', //new in cpg1.2.0
        'sort_da' => '일자순 순차배열',
        'sort_dd' => '일자순 역차배열',
        'sort_na' => '이름순 순차배열',
        'sort_nd' => '이름순 역차배열',
        'sort_ta' => '제목순 순차배열', //new in cpg1.2.0
        'sort_td' => '제목순 역차배열', //new in cpg1.2.0
        'pic_on_page' => '사진: %d  페이지: %d',
        'user_on_page' => '사용자: %d  페이지: %d'
);

$lang_img_nav_bar = array(
        'thumb_title' => '목록으로 돌아가기',
	'pic_info_title' => '상세정보 보기/숨기기',
        'slideshow_title' => '슬라이드쇼',
        'ecard_title' => '이미지를 e-card로 보내기',
        'ecard_disabled' => 'e-card로 보내기 금지',
        'ecard_disabled_msg' => 'e-card 보내기 권한없슴',
        'prev_title' => '이전',
        'next_title' => '다음',
	'pic_pos' => '등록 이미지 %s/%s',
);

$lang_rate_pic = array(
        'rate_this_pic' => '평가',
        'no_votes' => '(평가없음)',
        'rating' => '(현재평점 : %s / 5 평가횟수 %s 회)',
        'rubbish' => '아주나쁨',
        'poor' => '나쁨',
        'fair' => '보통',
        'good' => '좋음',
        'excellent' => '아주좋음',
        'great' => '최상',
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
        CRITICAL_ERROR => '심각한 오류발생',
        'file' => '파일: ',
        'line' => '줄: ',
);

$lang_display_thumbnails = array(
        'filename' => '파일이름 : ',
        'filesize' => '파일크기 : ',
        'dimensions' => '가로,세로 : ',
        'date_added' => '등록일 : '
);

$lang_get_pic_data = array(
        'n_comments' => '%s 코멘트',
        'n_views' => '%s 조회',
        'n_votes' => '%s 평가'
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
        0 => '일반모드로 전환합니다...',
        1 => '관리모드로 전환합니다...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
        'alb_need_name' => '앨범이름이 필요합니다 !',
        'confirm_modifs' => '변경사항을 저장하시겠습니까 ?',
        'no_change' => '변경사항이 없습니다 !',
        'new_album' => '새 앨범',
        'confirm_delete1' => '앨범을 삭제하시겠습니까 ?',
	'confirm_delete2' => '\n앨범에 등록된 이미지와 코멘트를 모두 삭제합니다 !',
        'select_first' => '먼저 앨범을 선택하세요',
        'alb_mrg' => '앨범관리',
        'my_gallery' => '* 개인앨범 *',
        'no_category' => '* 최상위 카테고리(메인) *',
        'delete' => '삭제',
        'new' => '생성',
        'apply_modifs' => '변경등록',
        'select_category' => '카테고리 선택',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
        'miss_param' => 'Parameters required for \'%s\'operation not supplied !',
        'unknown_cat' => '선택한 카테고리는 존재하지 않습니다.',
        'usergal_cat_ro' => '회원 갤러리는 삭제할 수 없습니다 !',
        'manage_cat' => '카테고리관리',
        'confirm_delete' => '카테고리를 삭제하시겠습니까 ?',
        'category' => '카테고리',
        'operations' => '실행메뉴',
        'move_into' => '카테고리 변경',
        'update_create' => '카테고리 생성/변경',
        'parent_cat' => '상위 카테고리',
        'cat_title' => '카테고리 이름',
        'cat_desc' => '카테고리 설명'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
        'title' => '설정변경',
        'restore_cfg' => '기본설정으로',
        'save_cfg' => '변경사항저장',
        'notes' => '노트',
        'info' => '정보',
        'upd_success' => '변경사항이 적용되었습니다!',
        'restore_success' => '기본설정으로 변경되었습니다',
        'name_a' => '이름순 순차배열',
        'name_d' => '이름순 역차배열',
        'title_a' => '제목순 순차배열', //new in cpg1.2.0
        'title_d' => '제목순 역차배열', //new in cpg1.2.0
        'date_a' => '일자순 순차배열',
        'date_d' => '일자순 역차배열',
        'th_any' => 'Max Aspect',
        'th_ht' => 'Height',
        'th_wd' => 'Width',
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'기본설정',
        array('갤러리 이름', 'gallery_name', 0),
        array('갤러리 설명', 'gallery_description', 0),
        array('관리자 이메일', 'gallery_admin_email', 0),
        array('e-card의 상세정보에 링크될 URL', 'ecards_more_pic_target', 0),
        array('언어선택', 'lang', 5),
        array('테마선택', 'theme', 6),

        '앨범목록 설정',
        array('메인테이블의 폭 (pixels or %)', 'main_table_width', 0),
        array('표시할 카테고리 레벨수', 'subcat_level', 0),
        array('표시할 앨범 수', 'albums_per_page', 0),
        array('앨범의 세로 열', 'album_list_cols', 0),
        array('썸네일 크기(pixels)', 'alb_list_thumb_size', 0),
        array('메인페이지에 불러올 컨텐트', 'main_page_layout', 0),
        array('카테고리의 1차레벨 앨범썸네일 보기','first_level',1), //new in cpg1.2.0

        '썸네일목록 설정',
        array('썸네일 컬럼수', 'thumbcols', 0),
        array('썸네일 행수', 'thumbrows', 0),
        array('불러올 썸네일 총수', 'max_tabs', 0),
        array('썸네일과 함께 상세정보 출력', 'caption_in_thumbview', 1),
        array('썸네일과 함께 코멘트수를 출력', 'display_comment_count', 1),
        array('이미지 정렬방법', 'default_sort_order', 3),
        array('최고평점에 나타낼 최소 평가횟수', 'min_votes_for_rating', 0),

        '이미지보기메뉴 및 코멘트 설정',
	array('이미지보기 테이블의 폭(pixels or %)', 'picture_table_width', 0),
	array('이미지의 상세정보를 기본적으로 출력', 'display_pic_info', 1),
	array('사용금지어 필터링 사용', 'filter_bad_words', 1),
	array('코멘트에 스마일 아이콘 사용', 'enable_smilies', 1),
	array('이미지 설명 최대 문자수', 'max_img_desc_length', 0),
	array('단어문자 길이(띄워쓰기없이)', 'max_com_wlength', 0),
	array('코멘트 라인 제한', 'max_com_lines', 0),
	array('코멘트 초대 문자수', 'max_com_size', 0),
        array('필름스트립 보기', 'display_film_strip', 1), //new in cpg1.2.0
        array('필름스트립의 항목갯수', 'max_film_strip_items', 0), //new in cpg1.2.0

        '이미지 및 썸네일 설정',
        array('JPEG 퀄리티', 'jpeg_qual', 0),
        array('썸네일 가로,세로 최대<b>*</b>', 'thumb_width', 0), //new in cpg1.2.0
        array('디멘죤사용 (가로 혹은 세로 혹은 썸네일의 최대모양)<b>*</b>', 'thumb_use', 7), //new in cpg1.2.0
        array('이미지 보기에 새로운 파일생성','make_intermediate',1),
	array('새로 생성될 파일의 최대크기(폭)<b>*</b>', 'picture_width', 0),
        array('업로드 이미지 최대용량 (KB)', 'max_upl_size', 0),
	array('업로드 이미지 가로,세로 최대크기(pixels)', 'max_upl_width_height', 0),

	'사용사(회원)설정',
        array('회원가입 허용', 'allow_user_registration', 1),
	array('회원가입시 이메일 유효여부 검증', 'reg_requires_valid_email', 1),
	array('이메일 중복허용 여부', 'allow_duplicate_emails_addr', 1),
	array('사용자 개인앨범 생성 허용', 'allow_private_albums', 1),

        'Custom fields for image description (leave blank if unused)',
        array('Field 1 name', 'user_field1_name', 0),
        array('Field 2 name', 'user_field2_name', 0),
        array('Field 3 name', 'user_field3_name', 0),
        array('Field 4 name', 'user_field4_name', 0),

        '이미지와 썸네일 고급설정',
        array('로그인 되지 않은 사용자에게 개일앨범 아이콘 보여주기','show_private',1), //new in cpg1.2.0
        array('파일 이름에 사용금지할 문자', 'forbiden_fname_char',0),
        array('허용할 이미지파일 확장자', 'allowed_file_extensions',0),
        array('이미지 크기조절 방법','thumb_method',2),
        array('Path to ImageMagick \'convert\' utility (example /usr/bin/X11/)', 'impath', 0),
        array('Allowed image types (only valid for ImageMagick)', 'allowed_img_types',0),
        array('Command line options for ImageMagick', 'im_options', 0),
        array('Read EXIF data in JPEG files', 'read_exif_data', 1),
	array('앨범 디렉토리 경로 <b>*</b>', 'fullpath', 0),
	array('사용자(회원) 업로드 이미지 경로 <b>*</b>', 'userpics', 0),
	array('새로 생성될 이미지의 접두어 <b>*</b>', 'normal_pfx', 0),
	array('썸네일의 접두어 <b>*</b>', 'thumb_pfx', 0),
	array('디렉토리 기본 퍼미션', 'default_dir_mode', 0),
        array('이미지 기본 퍼미션', 'default_file_mode', 0),

        '쿠키 및 문서 인코딩 설정',
        array('쿠키이름', 'cookie_name', 0),
        array('쿠키경로', 'cookie_path', 0),
        array('인코딩', 'charset', 4),

        '기타설정',
        array('Enable debug mode', 'debug_mode', 1),

	'<br /><div align="center"> * 표시된 부분의 옵션은 이미지가 등록된 이후에 변경하지 마세요.</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => '이름을 입력하세요.',
        'com_added' => '코멘트가 등록되었습니다.',
	'alb_need_title' => '건전한 앨범 타이틀을 정하세요 !',
	'no_udp_needed' => '업데이트할 필요없슴.',
	'alb_updated' => 'The 업데이트 되었습니다.',
	'unknown_album' => '선택한 앨범이 없거나, 업로드할 권한이 관리자에 의해 제한되어있습니다.',
	'no_pic_uploaded' => '업로드 이미지 없습니다 !<br /><br />서버에서 허용되는 이미지 파일을 업로드하세요.',
	'err_mkdir' => '%s 디렉토리 생성실패 !',
	'dest_dir_ro' => '%s 디렉토리는 쓰기금지되어있습니다 !',
	'err_move' => '%s과 %s를 연결하지못했습니다  !',
	'err_fsize_too_large' => '사이즈초과(maximum %s x %s) !',
	'err_imgsize_too_large' => '용량초과 (maximum %s KB) !',
	'err_invalid_img' => '정당한 이미지만 업로드하십시오 !',
	'allowed_img_types' => '%s 이미지만 업로드할 수 있습니다.',
	'err_insert_pic' => '\'%s\' 이미지는 앨범에 등록할 수 없습니다. ',
	'upload_success' => '이미지가 성공적으로 업로드 되었습니다.<br /><br />관리자의 승인후 게시됩니다.',
        'info' => '안내',
        'com_added' => '코멘트 등록',
        'alb_updated' => '앨범 수정',
        'err_comment_empty' => '코멘트 비어있슴 !',
        'err_invalid_fext' => 'Only files with the following extensions are accepted : <br /><br />%s.',
	'no_flood' => '코멘트를 수정하거나 등록할 수 없습니다.',
	'redirect_msg' => '\'다음\' 버튼을 누르기 전에 브라우저의 새로고침 버튼을 사용하지 마세요.',
	'upl_success' => '이미지가 성공적으로 업로드되었습니다.',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => '캡션',
	'fs_pic' => '원본 이미지',
	'del_success' => '삭제되었습니다!',
	'ns_pic' => '전시를 위한 새이미지',
	'err_del' => '삭제되지 않았습니다!!',
	'thumb_pic' => '썸네일',
	'comment' => '코멘트',
	'im_in_alb' => '앨범 이미지',
	'alb_del_success' => '\'%s\' 앨범삭제',
	'alb_mgr' => '앨범관리',
	'err_invalid_data' => '\'%s\' 데이타 없습니다!',
	'create_alb' => '\'%s\' 앨범생성',
	'update_alb' => '\'%s\' 앨범 업데이트 \'%s\' 이미지 \'%s\' 인덱스',
	'del_pic' => '이미지삭제',
	'del_alb' => '앨범삭제',
	'del_user' => '사용자삭제',
	'err_unknown_user' => '선택한 사용자는 없습니다 !',
	'comment_deleted' => '코멘트가 성공적으로 삭제되었습니다.',
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
        'confirm_del' => '이미지를 삭제하시겠습니까 ? \\n코멘트도 함께 삭제됩니다.',
        'del_pic' => '이미지삭제',
        'size' => '%s x %s pixels',
        'views' => '%s times',
        'slideshow' => '슬라이드쇼',
        'stop_slideshow' => '슬라이드쇼-정지',
        'view_fs' => '원본 이미지 보기',
);

$lang_picinfo = array(
        'title' =>'사진 정보',
        'Filename' => '파일이름',
        'Album name' => '앨범이름',
        'Rating' => '평점 (%s 평가)',
        'Keywords' => '키워드',
        'File Size' => '파일 크기',
        'Dimensions' => 'Dimensions',
        'Displayed' => 'Displayed',
        'Camera' => '카메라',
        'Date taken' => '촬영일자',
        'Aperture' => 'Aperture',
        'Exposure time' => 'Exposure time',
        'Focal length' => 'Focal length',
        'Comment' => '코멘트',
        'addFav'=>'즐겨찾기에 추가', //new in cpg1.2.0
        'addFavPhrase'=>'즐겨찾기', //new in cpg1.2.0
        'remFav'=>'즐겨찾기에서 삭제', //new in cpg1.2.0
);

$lang_display_comments = array(
        'OK' => '등록',
        'edit_title' => '코멘트 수정',
        'confirm_delete' => '코멘트를 삭제하시겠습니까 ?',
        'add_your_comment' => '코멘트 등록',
        'name'=>'이름', //new in cpg1.2.0
        'comment'=>'코멘트', //new in cpg1.2.0
        'your_name' => '일지매', //new in cpg1.2.0
);

$lang_fullsize_popup = array(
        'click_to_close' => '화면닫기:이미지에 클릭', //new in cpg1.2.0
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => 'e-card 보내기',
	'invalid_email' => '<b>Warning</b> : 유효하지 않은 이메일입니다 !',
	'ecard_title' => '%s님께서 보내신 e-card 입니다!',
	'view_ecard' => '카드가 보이지않는 사용자께서는 이링크를 클릭하세요 !',
	'view_more_pics' => '더 많은 이미지를 감상하시려면 클릭하세요 !',
	'send_success' => 'e-card를 보냈습니다!',
	'send_failed' => '죄송합니다, e-card 발송에 실패하였습니다.',
	'from' => 'e-card 작성폼',
	'your_name' => '보내는 사람 이름',
        'your_email' => '보내는 사람 이메일',
        'to' => 'To',
        'rcpt_name' => '받는 사람 이름',
        'rcpt_email' => '받는 사람 이메일',
        'greetings' => '제목',
        'message' => '메세지',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
        'pic_info' => '이미지 상세정보',
        'album' => '앨범',
        'title' => '이미지 제목',
        'desc' => '이미지 설명',
        'keywords' => '검색 키워드',
        'pic_info_str' => '%sx%s - %sKB - %s views - %s votes',
        'approve' => '이미지 승인',
        'postpone_app' => '승인 보류',
        'del_pic' => '이미지 삭제',
        'reset_view_count' => '조회수 초기화',
        'reset_votes' => '평가 초기화',
        'del_comm' => '코멘트 삭제',
        'upl_approval' => '업로드 승인',
        'edit_pics' => '이미지 편집',
        'see_next' => '다음',
        'see_prev' => '이전',
        'n_pic' => '대기중인 이미지 (%s)',
        'n_of_pic_to_disp' => '페이지당 출력할 이미지',
        'apply' => '변경사항 적용'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
        'group_name' => '그룹이름',
        'disk_quota' => '디스크 할당',
        'can_rate' => '평가가능',
        'can_send_ecards' => 'e-card 발송가능',
        'can_post_com' => '코멘트 등록가능',
        'can_upload' => '이미지 업로드가능',
        'can_have_gallery' => '개인앨범 생성가능',
        'apply' => '변경사항 적용',
        'create_new_group' => '새그룹 생성',
        'del_groups' => '선택한 그룹삭제',
        'confirm_del' => 'Warning, when you delete a group, users that belong to this group will be transfered to the \'Registered\' group !\n\nDo you want to proceed ?',
        'title' => '사용자 그룹관리',
        'approval_1' => 'Pub. Upl. approval (1)',
        'approval_2' => 'Priv. Upl. approval (2)',
	'note1' => '<b>(1)</b> public album 에 업로드할 이미지는 관리자의 승인절차를 거쳐 게시됩니다.',
	'note2' => '<b>(2)</b> 사용자(회원)가 업로드한 이미지는 저작권법에 위배되지 않아야 게시됩니다. ',
        'notes' => 'Notes'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
        'welcome' => '환영합니다 !'
);

$lang_album_admin_menu = array(
	'confirm_delete' => '앨범을 삭제하시겠습니까 ? \\n모든 이미지와 코멘트도 함께 삭제됩니다.',
        'delete' => '삭제',
        'modify' => '앨범설정',
        'edit_pics' => '이미지별 정보수정 ',
);

$lang_list_categories = array(
        'home' => '갤러리 메인',
	'stat1' => '<b>카테고리:[cat] 앨범:[albums] 이미지:[pictures] 코멘트:[comments] 조회:[views]</b>',
	'stat2' => '<b>앨범:[albums] 이미지:[pictures] 조회:[views]</b>',
	'xx_s_gallery' => '%s\'갤러리',
	'stat3' => '<b>카테고리:[cat] 앨범:[albums] 이미지:[pictures] 코멘트:[comments] 조회:[views]</b>'
);

$lang_list_users = array(
        'user_list' => '사용자(회원)목록',
        'no_user_gal' => '사용자(회원) 갤러리가 없습니다.',
        'n_albums' => '%s 앨범',
        'n_pics' => '%s 이미지'
);

$lang_list_albums = array(
        'n_pictures' => '%s 이미지',
        'last_added' => ', last one added on %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => '로그인',
	'enter_login_pswd' => '아이디와 비밀번호를 입력하세요!',
        'username' => '아이디',
        'password' => '비밀번호',
        'remember_me' => '기억하기',
        'welcome' => '%s님 로그인 되었습니다 !!',
        'err_login' => '*** 로그인 되지 않았습니다 ***',
        'err_already_logged_in' => '이미 로그인 되었습니다 !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
        'logout' => '로그아웃',
        'bye' => '%s님 로그아웃 되었습니다 !!',
        'err_not_loged_in' => '로그인되지 않았습니다 !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => '%s님 앨범 업데이트',
	'general_settings' => '기본설정',
	'alb_title' => '앨범 제목',
	'alb_cat' => '앨범 카테고리',
	'alb_desc' => '앨범 설명',
	'alb_thumb' => '앨범 썸네일',
	'alb_perm' => '앨범 권한설정',
	'can_view' => '앨범 공개설정',
	'can_upload' => '방문자가 이미지를 업로드할수 있음',
	'can_post_comments' => '방문자가 코멘트를 쓸수 있음',
	'can_rate' => '방문자가 평가할 수 있음',
	'user_gal' => '사용자(회원) 갤러리',
	'no_cat' => '*최상위 카테고리(메인)',
	'alb_empty' => '앨범이 비어있습니다.',
	'last_uploaded' => '마지막 업로드',
	'public_alb' => '모두공개(public album)',
	'me_only' => '나만보기',
	'owner_only' => '(%s)만 보기',
	'groupp_only' => '\'%s\' 그룹',
	'err_no_alb_to_modify' => '수정할 수 없습니다.',
	'update' => '앨범 업데이트'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => '죄송합니다. 이미 평가하셨습니다.',
	'rate_ok' => '평가해 주셔서 감사합니다 !',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
{SITE_NAME}에 오신 것을 환영합니다.<br />
회원님의 개인앨범을 생성 관리할수 있는 시스템을 준비중에 있습니다.<br />
현재는 테스트중이므로, 회원가입이나 기타 갤러리 프로그램에서의 파일 유실등은 책임지지 않습니다.<br />
일단 회원등록한 분께는 정식 오픈시 이메일을 통해 알려드릴 것이며, 시험 기간동안 가입한 회원을 대상으로 특별한 이벤트를 준비하고 있습니다.<br />회원가입시 이메일의 유효성 체크를 통해 유효하지 않은 이메일은 등록되지 않는점 참고하세요.<br /><br />
다시한번 {SITE_NAME}를 방문해 주셔서 감사합니다.
EOT;

$lang_register_php = array(
	'page_title' => '회원등록',
	'term_cond' => '등록약관 및 이용안내',
	'i_agree' => '동의합니다!',
	'submit' => '회원등록',
	'err_user_exists' => '이미 사용중인 아이디입니다. 다른 아이디로 등록하세요.',
	'err_password_mismatch' => '두 비밀번호가 일치하지 않습니다.',
	'err_uname_short' => '아이디는 최소4~10자 이내로 작성해야 합니다.',
	'err_password_short' => '비밀번호는 최소4~12자 이내로 작성해야 합니다.',
	'err_uname_pass_diff' => '아이디와 비밀번호가 일치하지 않습니다.',
	'err_invalid_email' => '이메일을 입력하세요.',
	'err_duplicate_email' => '이미 등록된 이메일 주소입니다.',
	'enter_info' => '회원등록 폼',
	'required_info' => '필수입력 항목',
	'optional_info' => '추가정보',
	'username' => '아이디',
	'password' => '비밀번호',
	'password_again' => '비밀번호 재입력',
	'email' => '이메일',
	'location' => '지역',
	'interests' => '관심분야',
	'website' => '홈페이지',
	'occupation' => '하시는 일',
	'error' => '에러..',
	'confirm_email_subject' => '%s 회원등록',
	'information' => '안내',
	'failed_sending_email' => '등록정보 이메일 발송실패 !',
	'thank_you' => '등록해주셔서 감사합니다.<br />입력한 이메일 주소로 활성화 코드가 담긴 이메일을 보냈습니다.<br />등록절차를 완료하려면 이메일의 활성화 코드를 클릭해주십시오.',
	'acct_created' => '회원님의 등록절차가 정상적으로 완료되었습니다. 로그인후 개인정보를 수정해주십시오.',
	'acct_active' => '회원님의 계정이 정상적으로 활성화되었습니다. 로그인후 이용해주십시오.',
	'acct_already_act' => '회원님의 계정이 이미 활성화되었습니다 !',
	'acct_act_failed' => '이 계정은 활성화되지 않았습니다 !',
	'err_unk_user' => '선택한 사용자는 존재하지 않습니다 !',
	'x_s_profile' => '%s\'님의 개인정보',
	'group' => '그룹',
	'reg_date' => '회원가입',
	'disk_usage' => '디스크 사용량',
	'change_pass' => '비밀번호 변경',
	'current_pass' => '현재 비밀번호',
	'new_pass' => '새로운 비밀번호',
	'new_pass_again' => '비밀번호 재입력',
	'err_curr_pass' => '현재 비밀번호가 틀립니다.',
	'apply_modif' => '변경사항 저장',
	'change_pass' => '비밀번호 변경',
	'update_success' => '개인정보가 업데이트 되었습니다.',
	'pass_chg_success' => '비밀번호가 변경 되었습니다.',
	'pass_chg_error' => '비밀번호가 변경되지 않았습니다.',
);

$lang_register_confirm_email = <<<EOT
반갑습니다 !! 

이 메일은 '{SITE_NAME}' 회원등록 신청자에게 보내드리는 메일입니다.

아래 아이디와 비밀번호는 잊지않도록 메모해두시기 바랍니다.

아이디 : '{USER_NAME}'
비밀번호 : '{PASSWORD}'

추가로 아래 링크를 클릭해서 회원님의 계정을 활성화 시킨다음 로그인하세요. 

{ACT_LINK}

기타 문의사항은 운영자 메일 tmax@puchonphoto.com 로 주시기 바랍니다.

{SITE_NAME} 운영자

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => '코멘트 다시보기',
	'no_comment' => '코멘트 없습니다.',
        'n_comm_del' => '%s comment(s) deleted',
	'n_comm_disp' => '페이지당 출력글수',
	'see_prev' => '이전',
	'see_next' => '다음',
	'del_comm' => '선택한 코멘트 삭제',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => '이미지 갤러리 검색',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => '새 이미지 검색',
	'select_dir' => '업로드 디렉토리',
	'select_dir_msg' => 'FTP를 이용 정해진 폴더에 이미 업로드한 파일을 원하는 갤러리와 연결시켜 주는 작업을 하는 곳입니다. <br /><br />*이미지 파일을(public_html/gallery/Albums/userpics)폴더로 전송한 다음 아래 작업을 진행합니다.<br /><br />1) userpics 를 클릭하면 전체 리스트 가운데 새로 업로드된 파일만 체크되어 있습니다.<br />2) 원하는 갤러리를 선택한 다음 "선택한 이미지 연결" 버튼을 클릭 등록합니다.<br /><br />*하나의 파일을 두 곳의 갤러리에 링크할 수 없습니다. 해당 갤러리에서 삭제후 재등록 하세요.',
	'no_pic_to_add' => '연결된 이미지 없습니다.',
	'need_one_album' => '하나 이상의 앨범을 생성한 다음 이용하세요.',
	'warning' => '주의',
	'change_perm' => '이미지를 업로드하기 전에 해당 디렉토리의 퍼미션을 755 또는 777 로 변경해야 합니다 !',
	'target_album' => '<b>&quot; %s &quot; 폴더의 이미지를 연결할 갤러리 선택 </b>%s',
	'folder' => '업로드 폴더',
	'image' => '이미지',
	'album' => '갤러리',
	'result' => '결과',
	'dir_ro' => '쓰기 권한 없습니다. ',
	'dir_cant_read' => '읽기 권한 없습니다. ',
	'insert' => '갤러리에 새로운 이미지 연결',
	'list_new_pic' => '새 이미지 목록',
	'insert_selected' => '선택한 이미지 연결',
	'no_pic_found' => '새 이미지를 찾지 못하였습니다.',
	'be_patient' => '결과 아이콘을 참조하세요.',
        'notes' =>  '<ul>'.
				'<li><b>OK</b> : 연결성공'.
				'<li><b>DP</b> : 다른 갤러리에 이미 등록되어있음'.
				'<li><b>PB</b> : 실패, 업로드 디렉토리의 퍼미션등 추가작업 필요'.
				'<li>만약 결과창에 OK, DP, PB 등의 아이콘이 표시되지 않았다면 프로그램을 점검하세요.'.

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
                'title' => '사용금지자', //new in cpg1.2.0
                'user_name' => '사용자이름', //new in cpg1.2.0
                'ip_address' => 'IP 주소', //new in cpg1.2.0
                'expiry' => '유효기간 (빈칸은 영구)', //new in cpg1.2.0
                'edit_ban' => '변경사항 저장', //new in cpg1.2.0
                'delete_ban' => '삭제', //new in cpg1.2.0
                'add_new' => '사용금지자 추가', //new in cpg1.2.0
                'add_ban' => '추가', //new in cpg1.2.0
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
	'title' => '이미지 업로드',
	'max_fsize' => '업로드 허용 최대 파일크기 %s KB',
	'album' => '앨범',
	'picture' => '이미지',
	'pic_title' => '이미지 제목',
	'description' => '이미지 설명',
	'keywords' => '키워드 (검색어)',
	'err_no_alb_uploadables' => '해당 파일 없습니다.',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => '사용자(회원)관리',
	'name_a' => '이름 (a-z)',
	'name_d' => '이름 (z-a)',
	'group_a' => '그룹 (a-z)',
	'group_d' => '그룹 (z-a)',
	'reg_a' => '등록 (a-z)',
	'reg_d' => '등록 (z-a)',
	'pic_a' => '조회 (a-z)',
	'pic_d' => '조회 (z-a)',
	'disku_a' => '사용량 (a-z)',
	'disku_d' => '사용량 (z-a)',
	'sort_by' => '정렬순서',
	'err_no_users' => '사용자(회원) 테이블이 비어있습니다 !',
	'err_edit_self' => '수정할 수 없습니다. 개인정보 수정 페이지를 이용하세요.',
	'edit' => '편집',
	'delete' => '삭제',
	'name' => '사용자 이름',
	'group' => '그룹',
	'inactive' => '비활성',
	'operations' => '실행메뉴',
	'pictures' => '이미지',
	'disk_space' => '사용량/할당량',
	'registered_on' => '회원',
	'u_user_on_p_pages' => '%d 전체 %d 페이지',
	'confirm_del' => '삭제 하시겠습니까 ? \\n등록된 모든 파일이 삭제됩니다.',
	'mail' => '이메일',
	'err_unknown_user' => '선택한 회원이 존재하지 않습니다 !',
        'modify_user' => '회원정보 수정',
        'notes' => '메모',
	'note_list' => '<li>비밀번호를 수정하지 않을경우 비워두시면 됩니다.',
        'password' => '비밀번호',
        'user_active' => '활성화된 사용자',
        'user_group' => '사용자 그룹',
        'user_email' => '사용자 이메일',
        'user_web_site' => '사용자 홈페이지',
        'create_new_user' => '새로운 사용자 생성',
	'user_location' => '접속지',
	'user_interests' => '관심분야',
	'user_occupation' => '하시는 일',
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => '이미지크기수정', //new in cpg1.2.0
        'what_it_does' => 'What it does', //new in cpg1.2.0
        'what_update_titles' => '파일이름으로 제목수정', //new in cpg1.2.0
        'what_delete_title' => '제목삭제', //new in cpg1.2.0
        'what_rebuild' => '썸네일 재작성과 이미지크기변경', //new in cpg1.2.0
        'what_delete_originals' => 'Deletes original sized photos replacing them with the sized version', //new in cpg1.2.0
        'file' => '파일', //new in cpg1.2.0
        'title_set_to' => '제목을 ', //new in cpg1.2.0
        'submit_form' => '제출', //new in cpg1.2.0
        'updated_succesfully' => '변경 성공', //new in cpg1.2.0
        'error_create' => '오류발생', //new in cpg1.2.0
        'continue' => 'Process more images', //new in cpg1.2.0
        'main_success' => 'The file %s was successfully used as main picture', //new in cpg1.2.0
        'error_rename' => '%s 을 %s' 로 이름 변경중 오류발생', //new in cpg1.2.0
        'error_not_found' => '파일 %s 을 찾을수 없습니다.', //new in cpg1.2.0
        'back' => '메인으로', //new in cpg1.2.0
        'thumbs_wait' => '썸네일과 크기가 수정된 이미지를 변경하고 있습니다, 기다리세요...', //new in cpg1.2.0
        'thumbs_continue_wait' => '썸네일 혹은 리사이즈 이미지를 수정하고 있습니다...', //new in cpg1.2.0
        'titles_wait' => '제목수정중, 기다리세요...', //new in cpg1.2.0
        'delete_wait' => '제목삭제중, 기다리세요...', //new in cpg1.2.0
        'replace_wait' => '원래이미지 삭제후 리사이지된 이미지로 대체중, 기다리세요..', //new in cpg1.2.0
        'instruction' => 'Quick instructions', //new in cpg1.2.0
        'instruction_action' => 'Select action', //new in cpg1.2.0
        'instruction_parameter' => '변수 설정', //new in cpg1.2.0
        'instruction_album' => '앨범선택', //new in cpg1.2.0
        'instruction_press' => 'Press %s', //new in cpg1.2.0
        'update' => '썸네일 혹은 리사이즈된 이미지 수정', //new in cpg1.2.0
        'update_what' => 'What should be updated', //new in cpg1.2.0
        'update_thumb' => '썸네일만', //new in cpg1.2.0
        'update_pic' => '크기수정된 이미지만', //new in cpg1.2.0
        'update_both' => '썸네일과 크기수정된 이미지', //new in cpg1.2.0
        'update_number' => 'Number of processed images per click', //new in cpg1.2.0
        'update_option' => '(시간경과문제가 발생하면 이 옵션을 낮게 설정하세요)', //new in cpg1.2.0
        'filename_title' => '파일이름 &rArr; 이미지 제목', //new in cpg1.2.0
        'filename_how' => 'How should the filename be modified', //new in cpg1.2.0
        'filename_remove' => 'Remove the .jpg ending and replace _ (underscore) with spaces', //new in cpg1.2.0
        'filename_euro' => 'Change 2003_11_23_13_20_20.jpg to 23/11/2003 13:20', //new in cpg1.2.0
        'filename_us' => 'Change 2003_11_23_13_20_20.jpg to 11/23/2003 13:20', //new in cpg1.2.0
        'filename_time' => 'Change 2003_11_23_13_20_20.jpg to 13:20', //new in cpg1.2.0
        'delete' => '이미지제목 혹은 원래이미지 삭제', //new in cpg1.2.0
        'delete_title' => '이미지제목 삭제', //new in cpg1.2.0
        'delete_original' => '원래이미지 삭제', //new in cpg1.2.0
        'delete_replace' => '원래이미지 삭제후 리사이즈 이미지로 대체', //new in cpg1.2.0
        'select_album' => '앨범 선택', //new in cpg1.2.0
);

?>