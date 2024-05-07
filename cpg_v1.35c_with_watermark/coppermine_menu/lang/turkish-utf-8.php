<?php
// ------------------------------------------------------------------------- //
//  Coppermine Photo Gallery v1.1 Beta 2                                     //
// ------------------------------------------------------------------------- //
//  Copyright (C) 2002,2003  Gr&eacute;gory DEMAR <gdemar@wanadoo.fr>               //
//  http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
//  Based on PHPhotoalbum by Henning Støverud <henning@stoverud.com>         //
//  http://www.stoverud.com/PHPhotoalbum/                                    //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
// ------------------------------------------------------------------------- //
//  Translation by Mustafa Tolga YILMAZ <mtolgay@yahoo.com>                  //
//  http://deermaker.cjb.net/                                                //
//  Translation Version 1.0 Alpha 2                                          //
// ------------------------------------------------------------------------- //

// info about translators and translated language 
$lang_translation_info = array( 
'lang_name_english' => 'Turkish',  //the name of your language in English, e.g. 'Greek' or 'Spanish' 
'lang_name_native' => 'Türkçe', //the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Español' 
'lang_country_code' => 'tr', //the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es' 
'trans_name'=> 'Mustafa Tolga YILMAZ', //the name of the translator - can be a nickname 
'trans_email' => 'mtolgay@yahoo.com', //translator's email address (optional) 
'trans_website' => 'http://www.fiat.web.tr/', //translator's website (optional) 
'trans_date' => '2003-10-02', //the date the translation was created / last modified 
); 

$lang_charset = 'windows-1254';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bayt', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('Paz', 'Pzt', 'Sal', 'Çrþ', 'Prþ', 'Cum', 'Cmt');
$lang_month = array('Oca', 'Þub', 'Mar', 'Nis', 'May', 'Haz', 'Tem', 'Auð', 'Eyl', 'Eki', 'Kas', 'Ara');

// Some common strings
$lang_yes = 'Evet';
$lang_no  = 'Hayýr';
$lang_back = 'GERÝ';
$lang_continue = 'ÝLERÝ';
$lang_info = 'Bilgi';
$lang_error = 'Hata';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%d %B %Y';
$lastcom_date_fmt =  '%d/%m/%y saat %H:%M';
$lastup_date_fmt = '%d %B %Y';
$register_date_fmt = '%d %B %Y';
$lasthit_date_fmt = '%d %B %Y at %H:%M';
$comment_date_fmt =  '%d %B %Y at %H:%M';

// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*', '*sik*', 'am*', 'yarrak', 'yarak', 'orospu');

$lang_meta_album_names = array( 
        'random' => 'Rasgele resimler', 
        'lastup' => 'Son eklenenler', 
        'lastalb'=> 'Son güncellenen albümler', 
        'lastcom' => 'Son yorumlar', 
        'topn' => 'En çok izlenen', 
        'toprated' => 'En çok oylanan', 
        'lasthits' => 'En son izlenen', 
        'search' => 'Arama sonuçlarý', 
        'favpics'=> 'Sýk Kullanýlan Resimler' 
);

$lang_errors = array(
	'access_denied' => 'Bu sayfayý g&ouml;r&uuml;nt&uuml;lemeye izniniz yok.',
	'perm_denied' => 'Bu iþlemi y&uuml;r&uuml;tmeye izniniz yok.',
	'param_missing' => 'Programý çalýþtýrmak için yetersiz komut(lar).',
	'non_exist_ap' => 'Þeçilmiþ olan Alb&uuml;m/Resim yok !',
	'quota_exceeded' => 'Disk kotasý aþýldý<br /><br />Sizin þu an ki alanýnýz [quota]K, resimleriniz [space]K alan kaplýyor, bu resim eklenseydi kotanýzý aþmýþ olacaktýnýz.',
	'gd_file_type_err' => 'GD Resim K&uuml;t&uuml;phanesini kullanýrken geçerli olan resim tipleri JPG ve PNG.',
	'invalid_image' => 'Y&uuml;klediðiniz resim ya bozuk ya da GD K&uuml;t&uuml;phanesi tarafýndan tanýmlanamýyor.',
	'resize_failed' => 'K&uuml;ç&uuml;k resim veya d&uuml;þ&uuml;k boyutlu resim oluþturulamýyor.',
	'no_img_to_display' => 'G&ouml;sterilecek resim yok',
	'non_exist_cat' => 'Seçilmiþ olan kategori yok',
	'orphan_cat' => 'Bir kategorinin ana dalý yok, bu sorunu haletmek için Kategori Y&ouml;neticisini çalýþtýrýn.',
	'directory_ro' => 'Dizin \'%s\'  e yazýlabilir deðil, resimler silinemiyor',
	'non_exist_comment' => 'Þeçilmiþ olan yorum yok.',
        'pic_in_invalid_album' => 'Resim var olmayan bir albümde (%s)!?',
        'banned' => 'Bu siteyi þimdlik kullanmanýz yasaklanmýþtýr.', 
        'not_with_udb' => 'Bu fonksiyon Coppermine\'da iptal edilmiþtir çünkü forum yazýlýmý ile birleþtirilmiþtir. Denemek istediðiniz ya bu konfigurasyon ile desteklenmiyor veyahut bu fonksiyon forum yazýlýmý tarafýndan uygulanacak.', 
); 

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => 'Alb&uuml;m listesine git',
	'alb_list_lnk' => 'Alb&uuml;m listesi',
	'my_gal_title' => 'Kiþisel galerime git',
	'my_gal_lnk' => 'Kiþisel Galerim',
	'my_prof_lnk' => 'My profile',
	'adm_mode_title' => 'Y&ouml;netici konumuna geçiþ yap',
	'adm_mode_lnk' => 'Y&ouml;netici konumu',
	'usr_mode_title' => 'Kullanýcý konumuna geçiþ yap',
	'usr_mode_lnk' => 'Kullanýcý konumu',
	'upload_pic_title' => 'Bir resimi bir alb&uuml;me y&uuml;kle',
	'upload_pic_lnk' => 'Resim y&uuml;kle',
	'register_title' => 'Bir hesap oluþtur',
	'register_lnk' => 'Kayýt ol',
	'login_lnk' => 'Giriþ',
	'logout_lnk' => 'Çýkýþ',
	'lastup_lnk' => 'Son y&uuml;klenenler',
	'lastcom_lnk' => 'Son yorumlar',
	'topn_lnk' => 'En çok izlenenler',
	'toprated_lnk' => 'En çok oy alanlar',
	'search_lnk' => 'Ara',
        'fav_lnk' => 'Sýk Kullanýlanlar', 
);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => 'Y&uuml;kleme izini',
	'config_lnk' => 'Seçenekler',
	'albums_lnk' => 'Alb&uuml;mler',
	'categories_lnk' => 'Kategoriler',
	'users_lnk' => 'Kullanýcýlar',
	'groups_lnk' => 'Gruplar',
	'comments_lnk' => 'Yorumlar',
	'searchnew_lnk' => 'K&uuml;me resimleri ekle',
        'util_lnk' => 'Resimleri boyutlandýr', 
        'ban_lnk' => 'Kullanýcýlarý yasakla', 
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => 'Oluþtur veya alb&uuml;mleri iste',
	'modifyalb_lnk' => 'Alb&uuml;mlerde deðiþiklik yap',
	'my_prof_lnk' => 'Profilim',
);

$lang_cat_list = array(
	'category' => 'Kategori',
	'albums' => 'Alb&uuml;mler',
	'pictures' => 'Resimler',
);

$lang_album_list = array(
	'album_on_page' => '%d alb&uuml;m&uuml;n&uuml;z %d sayfadadýr'
);

$lang_thumb_view = array(
	'date' => 'TARÝH',
        //Sort by filename and title 
        'name' => 'DOSYA ADI', 
        'title' => 'BAÞLIK',
	'sort_da' => 'Tarihi k&uuml;ç&uuml;kten b&uuml;y&uuml;y&uuml;ðe sýrala',
	'sort_dd' => 'Tarihi b&uuml;y&uuml;kten k&uuml;ç&uuml;y&uuml;ðe sýrala',
	'sort_na' => 'Adý k&uuml;ç&uuml;kten b&uuml;y&uuml;y&uuml;ðe sýrala',
	'sort_nd' => 'Adý b&uuml;y&uuml;kten k&uuml;ç&uuml;y&uuml;ðe sýrala',
        'sort_ta' => 'Baþlýða göre küçükten büyüðe diz', 
        'sort_td' => 'Baþlýða göre büyükten küçüðe diz', 
	'pic_on_page' => '%d resim %d sayfadadýr',
	'user_on_page' => '%d kullanýcý %d sayfadadýr'
);

$lang_img_nav_bar = array(
	'thumb_title' => 'K&uuml;ç&uuml;k resim sayfasýna geri d&ouml;n',
	'pic_info_title' => 'Resmi bilgilerine g&ouml;ster/sakla',
	'slideshow_title' => 'G&ouml;steri',
	'ecard_title' => 'Bu resimi e-Kart olarak yolla',
	'ecard_disabled' => 'e-Kart iptal edilmiþtir',
	'ecard_disabled_msg' => 'e-Kart g&ouml;ndermeye izininiz yok',
	'prev_title' => '&Ouml;nceki resime bak',
	'next_title' => 'Bir sonraki resime bak',
	'pic_pos' => 'RESÝM %s/%s',
);

$lang_rate_pic = array(
	'rate_this_pic' => 'Bu resimi oylayýn ',
	'no_votes' => '(Oy yok þimdilik)',
	'rating' => '(Þu anki durum : %s / 5 ile %s oy)',
	'rubbish' => 'Saçma',
	'poor' => 'Yetersiz',
	'fair' => 'Orta',
	'good' => 'Ýyi',
	'excellent' => 'M&uuml;kemmel',
	'great' => 'Harikulade',
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
	CRITICAL_ERROR => 'Ciddi hata',
	'file' => 'Dosya: ',
	'line' => 'Satýr: ',
);

$lang_display_thumbnails = array(
	'filename' => 'Dosya adý : ',
	'filesize' => 'Dosya boyutu : ',
	'dimensions' => 'Boyutlarý : ',
	'date_added' => 'Eklenme tarihi : '
);

$lang_get_pic_data = array(
	'n_comments' => '%s yorum',
	'n_views' => '%s g&ouml;r&uuml;nt&uuml;leme',
	'n_votes' => '(%s oy)'
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
	'Exclamation' => '&Uuml;nlem',
	'Question' => 'Soru',
	'Very Happy' => 'Çok mutlu',
	'Smile' => 'G&uuml;l',
	'Sad' => 'Mutsuz',
	'Surprised' => 'Þaþýrmýþ',
	'Shocked' => 'Sarsýlmýþ',
	'Confused' => 'Confused',
	'Cool' => 'S&uuml;per',
	'Laughing' => 'G&uuml;lerek',
	'Mad' => 'Deli',
	'Razz' => 'Razz',
	'Embarassed' => 'Utanmýþ',
	'Crying or Very sad' => 'Aðlamak veya çok mutsuz',
	'Evil or Very Mad' => 'Bela veya çok deli',
	'Twisted Evil' => 'Cilveli Bela',
	'Rolling Eyes' => 'Yuvarlanan G&ouml;zler',
	'Wink' => 'G&ouml;z kýrpma',
	'Idea' => 'Fikir',
	'Arrow' => 'Ok',
	'Neutral' => 'Tarafsýz',
	'Mr. Green' => 'Bay Yeþil',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
	0 => 'Y&ouml;netici konumu kapatýlýyor...',
	1 => 'Y&ouml;netici konumu açýlýyor...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => 'Alb&uuml;mleri isim vermelisiniz !',
	'confirm_modifs' => 'Bu deðiþiklikleri uygulamak istediðinizden eminmisiniz ?',
	'no_change' => 'Herhangi bir deðiþklik yapýlmadý !',
	'new_album' => 'Yeni Alb&uuml;m',
	'confirm_delete1' => 'Bu alb&uuml;m&uuml; silmek istediðinizden emin misiniz ?',
	'confirm_delete2' => '\nÝçerdiði b&uuml;t&uuml;n resim ve yorumlar silinecektir !',
	'select_first' => '&Ouml;nce bir alb&uuml;m seçin',
	'alb_mrg' => 'Alb&uuml;m Y&ouml;neticisi',
	'my_gallery' => '* Benim Galerim *',
	'no_category' => '* Kategori Yok *',
	'delete' => 'Sil',
	'new' => 'Yeni',
	'apply_modifs' => 'Deðiþiklikleri uygula',
	'select_category' => 'Kategori seçin',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => '\'%s\' için komutlar gerekli iþlem yapýlamadý !',
	'unknown_cat' => 'Seçilmiþ olan kategori veritabanýnda bulunamadý',
	'usergal_cat_ro' => 'Kullanýcý galerileri silinemez !',
	'manage_cat' => 'Kategorileri d&uuml;zenle',
	'confirm_delete' => 'Bu kategoriyi SÝLMEK istediðinizden eminmisiniz ?',
	'category' => 'Kategori',
	'operations' => 'Ýþlemler',
	'move_into' => 'S&uuml;r&uuml;kle',
	'update_create' => 'Kategori oluþtur/g&uuml;ncelle',
	'parent_cat' => 'Ana kategori',
	'cat_title' => 'Kategori baþlýðý',
	'cat_desc' => 'Kategori açýklamasý'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => 'Seçenekler',
	'restore_cfg' => 'Ayarlarý sýfýrla',
	'save_cfg' => 'Yeni seçenekleri kaydet',
	'notes' => 'Notlar',
	'info' => 'Bilgi',
	'upd_success' => 'Coppermine seçenekleri g&uuml;ncellendi',
	'restore_success' => 'Coppermine ayarlarý sýfýrlandý',
	'name_a' => 'Ad k&uuml;ç&uuml;kten b&uuml;y&uuml;y&uuml;ðe',
	'name_d' => 'Ad b&uuml;y&uuml;kten k&uuml;ç&uuml;y&uuml;ðe',
	'date_a' => 'Tarih k&uuml;ç&uuml;kten b&uuml;y&uuml;y&uuml;ðe',
	'date_d' => 'Date b&uuml;y&uuml;kten k&uuml;ç&uuml;y&uuml;ðe',,
        'th_any' => 'Max Aspect',
        'th_ht' => 'Height',
        'th_wd' => 'Width',
        'title_a' => 'Baþlýk küçükten büyüðe', 
        'title_d' => 'Baþlýk büyükten küçüðe',
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'Genel Seçenekler',
	array('Galeri Ýsmi', 'gallery_name', 0),
	array('Galeri Açýklamasý', 'gallery_description', 0),
	array('Galeri Y&ouml;neticisi e-Posta', 'gallery_admin_email', 0),
	array('\'See more pictures\' hedef adres baðlantýsý e-Kartlar içinde', 'ecards_more_pic_target', 0),
	array('Dil', 'lang', 5),
	array('Aray&uuml;z', 'theme', 6),

	'Alb&uuml;m liste g&ouml;r&uuml;nt&uuml;s&uuml;',
	array('Ana tablonun geniþliði (piksel veya %)', 'main_table_width', 0),
	array('G&ouml;sterilecek olan kategori d&uuml;zeylerinin sayýsý', 'subcat_level', 0),
	array('G&ouml;sterilecek alb&uuml;mlerin sayýsý', 'albums_per_page', 0),
	array('Alb&uuml;m listesi için s&uuml;tun sayýsý', 'album_list_cols', 0),
	array('K&uuml;ç&uuml;k resimlerin boyutu piksel olarak', 'alb_list_thumb_size', 0),
	array('Ana sayfanýn içeriði', 'main_page_layout', 0),
        array('Birinci seviye albümlerin küçük resimlerini kategorilerde göster','first_level',1), 

	'K&uuml;ç&uuml;k resim g&ouml;r&uuml;nt&uuml;s&uuml;',
	array('K&uuml;ç&uuml;k resim sayfasýndaki s&uuml;tun sayýsý', 'thumbcols', 0),
	array('K&uuml;ç&uuml;k resim sayfasýndaki sýra sayýsý', 'thumbrows', 0),
	array('En çok g&ouml;sterilecek etiket sayýsý', 'max_tabs', 0),
	array('Resim manþet baþlýðýný k&uuml;ç&uuml;k resim sayfasýnda g&ouml;ster', 'caption_in_thumbview', 1),
	array('K&uuml;ç&uuml;k resimlerin altýnda yorum sayýsýný g&ouml;r&uuml;nt&uuml;le', 'display_comment_count', 1),
	array('Hazýr ayarlarý kullanarak resimleri sýrala', 'default_sort_order', 3),
	array('Bir resmin \'top-rated\' listesine g&ouml;z&uuml;kebilmesi için almasý gerekn azami oy sayýsý', 'min_votes_for_rating', 0),

	'Resim g&ouml;r&uuml;nt&uuml;leme &amp; Yorum seçenekleri',
	array('Resimlerin g&ouml;sterileceði tablonun geniþliði (piksel veya %)', 'picture_table_width', 0),
	array('Resim bilgilerine g&ouml;ster', 'display_pic_info', 1),
	array('K&uuml;f&uuml;rleri yorumlarda filtrele', 'filter_bad_words', 1),
	array('Yorumlar da smiley kullanýmýna izin ver', 'enable_smilies', 1),
	array('Bir resim açýklmasýnýn maksimum uzunluðu', 'max_img_desc_length', 0),
	array('Bir kelime içindeki maksimum harf sayýsý', 'max_com_wlength', 0),
	array('Bir yorum içindeki maksimum satýr sayýsý', 'max_com_lines', 0),
	array('Bir yorumun maksimum uzunluðu', 'max_com_size', 0),
        array('Film þeridi göster', 'display_film_strip', 1), 
        array('Film þeridindeki adet sayýsý', 'max_film_strip_items', 0), 

	'Resim ve k&uuml;ç&uuml;k resim seçenekleri',
	array('JPEG dosyalarý için kalite ayarý', 'jpeg_qual', 0),
        array('Küçük resmin en büyük boyutu <b>*</b>', 'thumb_width', 0), 
        array('Boyut kullan ( geniþlik veya yükseklik veya en büyük görünüþ küçük resimler için ) <b>*</b>', 'thumb_use', 7), 
	array('Ara resimleri yarat','make_intermediate',1),
	array('Bir ara resmin maksium geniþliði veya boyu <b>*</b>', 'picture_width', 0),
	array('Y&uuml;klenecek olan resimler için maksimum boyut (KB)', 'max_upl_size', 0),
	array('Y&uuml;klenecek olan resimler için makisum geniþlik veya boy (piksel)', 'max_upl_width_height', 0),

	'Kullanýcý seçenekleri',
	array('Yeni kullanýcý kaydýna izin ver', 'allow_user_registration', 1),
	array('Yeni kullanýcý kaydý için e-Posta onayýna ihtiyaç var', 'reg_requires_valid_email', 1),
	array('Ýki kullanýcý ayný e-Posta adresine sahip olmasýna izin ver', 'allow_duplicate_emails_addr', 1),
	array('Kullanýcýlarýn kiþisel galerileri olabilir', 'allow_private_albums', 1),

	'Resim açýklamalarý için &ouml;zel alanlar (eðer kullanýlmayacaksa boþ býrakýn)',
	array('Alan 1 adý', 'user_field1_name', 0),
	array('Alan 2 adý', 'user_field2_name', 0),
	array('Alan 3 adý', 'user_field3_name', 0),
	array('Alan 4 adý', 'user_field4_name', 0),

	'Resim ve k&uuml;ç&uuml;k resim geliþmiþ seçenekleri',
        array('Çýkýþ yapmamýþ kullanýcýya özel resim ikonunu göster','show_private',1), 
	array('Dosya isimlerinde karakterlere izin verme', 'forbiden_fname_char',0),
	array('Y&uuml;klenmiþ olan resimler için kabul edilen uzantýlar', 'allowed_file_extensions',0),
	array('Resimleri boyutlandýrmak için kullanýlan y&ouml;ntem','thumb_method',2),
	array('ImageMagick için yol (example /usr/bin/X11/)', 'impath', 0),
	array('Kabul edilen resim tipleri (sadece ImageMagick için geçerli)', 'allowed_img_types',0),
	array('Komut satýr seçenekleri ImageMagick için', 'im_options', 0),
	array('EXIF bilgisini oku JPEG dosyalarýnda', 'read_exif_data', 1),
	array('Alb&uuml;m dizini <b>*</b>', 'fullpath', 0),
	array('Kullanýcý resimleri için dizin <b>*</b>', 'userpics', 0),
	array('Ara resimler için &ouml;nek <b>*</b>', 'normal_pfx', 0),
	array('K&uuml;ç&uuml;k resimler için &ouml;nek <b>*</b>', 'thumb_pfx', 0),
	array('Dizinler için hazýr ayar', 'default_dir_mode', 0),
	array('Resimleri için hazýr ayar', 'default_file_mode', 0),

	'Cookie &amp; Charset ayarlarý',
	array('Program tarafýndan kullanýlan cookielerin adý', 'cookie_name', 0),
	array('Program tarafýndan kullanýlan cookielerin dizin yolu', 'cookie_path', 0),
	array('Karakter kodlama', 'charset', 4),

	'Diðer seçenekler',
	array('Hata ç&ouml;z&uuml;mleme seçeneði aç', 'debug_mode', 1),
	
	'<br /><div align="center">(*) * ile g&ouml;sterilmiþ olan alanlar, resim galerinizde resim bulunuyorsa deðiþtirilmemeli</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => 'Adýnýzý ve bir yorum yazmanýz gerek',
	'com_added' => 'Yorumunuz eklendi',
	'alb_need_title' => 'Alb&uuml;m için bir baþlýk vermeniz gerek !',
	'no_udp_needed' => 'G&uuml;ncellemeye gerek yok.',
	'alb_updated' => 'Alb&uuml;m g&uuml;ncellenmiþtir.',
	'unknown_album' => 'Alb&uuml;m yok veya sizin o alb&uuml;m&uuml; deðiþtirmeye izniniz yok',
	'no_pic_uploaded' => 'Hiçbir resim y&uuml;klenmedi !<br /><br />Eðer bir resim seçtiyseniz, ana makinanin resim y&uuml;klemeye izin verdiðinden emin olun...',
	'err_mkdir' => '%s dizini yaratýlamadý!',
	'dest_dir_ro' => '%s dizinine program tarafýndan yazýlamýyor !',
	'err_move' => '%s ý %s e s&uuml;r&uuml;klemek imkansýz!',
	'err_fsize_too_large' => 'Y&uuml;klemeye çalýþtýðýnýz resmin boyutu çok b&uuml;y&uuml;k (izin verilen %s x %s) !',
	'err_imgsize_too_large' => 'Y&uuml;klemeye çalýþtýðýnýz resmin boyutu çok b&uuml;y&uuml;k (izin verilen %s KB) !',
	'err_invalid_img' => 'Y&uuml;klemeye çalýþtýðýnýz resim geçersiz bir resim biçimidir !',
	'allowed_img_types' => 'Sadece %s resim y&uuml;kleyebilirsiniz.',
	'err_insert_pic' => '\'%s\' resmi alb&uuml;me eklenemiyor ',
	'upload_success' => 'Resiminiz baþarý ile y&uuml;klenmiþtir<br /><br />Y&ouml;netici onayýndan sonra yayýnlanacaktýr.',
	'info' => 'Bilgi',
	'com_added' => 'Yorum eklendi',
	'alb_updated' => 'Alb&uuml;m g&uuml;ncellendi',
	'err_comment_empty' => 'Yorumunuz boþ !',
	'err_invalid_fext' => 'Sadece bu uzantýlara sahip resimler kabul edilir : <br /><br />%s.',
	'no_flood' => 'Bu resim için son yorumu yollayan zaten sizsiniz<br /><br />Eðer baþka birþey eklemek istiyorsanýz kendi yorumunuzu g&uuml;ncelleyin',
	'redirect_msg' => 'Þu anda y&ouml;nlendiriliyorsunuz.<br /><br /><br />\'CONTINUE\' a basýn eðer sayfa kendiliðinden yenilenmezse',
	'upl_success' => 'Resminiz baþarý ile eklenmiþtir',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => 'Baþlýk',
	'fs_pic' => 'tam boy resim',
	'del_success' => 'baþarý ile silindi',
	'ns_pic' => 'normal boyut resim',
	'err_del' => 'silinemiyor',
	'thumb_pic' => 'k&uuml;ç&uuml;k resim',
	'comment' => 'yorum',
	'im_in_alb' => 'alb&uuml;mdeki resim',
	'alb_del_success' => 'Alb&uuml;m \'%s\' silindi',
	'alb_mgr' => 'Alb&uuml;m Y&ouml;neticisi',
	'err_invalid_data' => 'Geçersiz veri alýndý \'%s\' da',
	'create_alb' => 'Alb&uuml;m \'%s\' oluþturuluyor',
	'update_alb' => 'Alb&uuml;m \'%s\' g&uuml;ncelleniyor, \'%s\' baþlýðýdýr ve \'%s\' içeriði ile',
	'del_pic' => 'Resimi sil',
	'del_alb' => 'Alb&uuml;m&uuml; sil',
	'del_user' => 'Kullanýcý sil',
	'err_unknown_user' => 'Seçilen kullanýcý yok !',
	'comment_deleted' => 'Yorum baþarý ile silindi',
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
	'confirm_del' => 'Bu resmi sileceðinizden emin misiniz ? \\nYorumlar da silinecektir.',
	'del_pic' => 'BU RESMÝ SÝL',
	'size' => '%s x %s piksel',
	'views' => '%s kere',
	'slideshow' => 'G&ouml;steri',
	'stop_slideshow' => 'G&Ouml;STERÝYÝ DURDUR',
	'view_fs' => 'Tam boy resmi g&ouml;rebilmek için týklayýn',
);

$lang_picinfo = array(
	'title' =>'Resim bilgileri',
	'Filename' => 'Dosya adý',
	'Album name' => 'Alb&uuml;m adý',
	'Rating' => 'Beðenilme (%s oy)',
	'Keywords' => 'Anahtar kelime',
	'File Size' => 'Dosya boyutu',
	'Dimensions' => 'Boyutlar',
	'Displayed' => 'G&ouml;sterilen',
	'Camera' => 'Kamera',
	'Date taken' => 'Alýnan tarih',
	'Aperture' => 'Fotoðraf makinesi açýklýðý',
	'Exposure time' => 'Ýfþa zamaný',
	'Focal length' => 'Merkez uzunluðu',
	'Comment' => 'Yorum',
        'addFav'=>'Sýk Kullanýlana ekle', 
        'addFavPhrase'=>'Sýk Kullanýlanlar', 
        'remFav'=>'Sýk Kullanýlanlarda çýkar', 
);

$lang_display_comments = array(
	'OK' => 'TAMAM',
	'edit_title' => 'Bu yorumu g&uuml;ncelle',
	'confirm_delete' => 'Bu yorumu silmek istediðinizden emin misiniz ?',
	'add_your_comment' => 'Yorumunuzu ekleyin',
        'name'=>'Ýsim', 
        'comment'=>'Yorum', 
        'your_name' => 'Anonim', 
);

$lang_fullsize_popup = array( 
        'click_to_close' => 'Bu pencereyi kapatmak için resime klikleyin', 
); 

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => 'Bir e-Kart yollayýn',
	'invalid_email' => '<b>Dikkat</b> : yanlýþ e-Posta adresi !',
	'ecard_title' => 'Size %s tarafýndan bir e-Kart g&ouml;nderilmiþtir',
	'view_ecard' => 'Eðer e-Kartýnýzý doðru g&ouml;r&uuml;nt&uuml;leyemiyorsanýz buraya týklayýn',
	'view_more_pics' => 'Daha fazla resim g&ouml;rebilmek için bu baðlantýya týklayýn !',
	'send_success' => 'e-Kartýnýz g&ouml;nderilmiþtir',
	'send_failed' => 'Ana makina e-Kartýnýzý g&ouml;nderemiyor',
	'from' => 'Kimden',
	'your_name' => 'Sizin adýnýz',
	'your_email' => 'Sizin e-Posta adresiniz',
	'to' => 'Kime',
	'rcpt_name' => 'Alýcýnýn Ýsmi',
	'rcpt_email' => 'Alýcýnýn e-Posta adresi',
	'greetings' => 'Selamlar',
	'message' => 'Ýleti',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => 'Resim bilgileri',
	'album' => 'Alb&uuml;m',
	'title' => 'Baþlýk',
	'desc' => 'Açýklama',
	'keywords' => 'Anahta kelimeler',
	'pic_info_str' => '%sx%s - %sKB - %s g&ouml;r&uuml;nt&uuml;leme - %s oy',
	'approve' => 'Resimi onayla',
	'postpone_app' => 'Onaylamayý ertele',
	'del_pic' => 'Resimi sil',
	'reset_view_count' => 'G&ouml;r&uuml;nt&uuml;leme sayacýný sýfýrla',
	'reset_votes' => 'Oylamalarý sýfýrla',
	'del_comm' => 'Yorumlarý sil',
	'upl_approval' => 'Y&uuml;klemeyi onayla',
	'edit_pics' => 'Resimlerde deðiþiklik yap',
	'see_next' => 'Sonraki resimleri g&ouml;r',
	'see_prev' => '&Ouml;nceki resimleri g&ouml;r',
	'n_pic' => '%s resim',
	'n_of_pic_to_disp' => 'G&ouml;sterilecek olan resim sayýsý',
	'apply' => 'Deðiþiklikleri uygula'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => 'Grup adý',
	'disk_quota' => 'Disk kotasý',
	'can_rate' => 'Resimleri oylayabilir',
	'can_send_ecards' => 'e-Kart g&ouml;nderebilir',
	'can_post_com' => 'Yorum yazabilir',
	'can_upload' => 'Resim y&uuml;kleyebilir',
	'can_have_gallery' => 'Kiþisel galeri yapabilir',
	'apply' => 'Deðiþiklikleri uygula',
	'create_new_group' => 'Yeni grup yarat',
	'del_groups' => 'Seçilmiþ olan grup(larý) sil',
	'confirm_del' => 'Dikkat ! Eðer bu grubu silerseniz, gruptaki b&uuml;t&uuml;n kullanýcýlar \'Registered\' grubuna transfer edilecektir !\n\nDevam etmek istiyormusunuz ?',
	'title' => 'Kullanýcý gruplarýný d&uuml;zenle',
	'approval_1' => 'Herkese açýk y&uuml;kleme onayý (1)',
	'approval_2' => 'Kiþisel y&uuml;kleme onayý (2)',
	'note1' => '<b>(1)</b> Kiþisel galeriye y&uuml;klenecek olan resimler y&ouml;netici tarafýndan onaylanmalý',
	'note2' => '<b>(2)</b> Kullanýcýya ait galeriye y&uuml;kleme yapmak için y&ouml;netici onayýna gerek',
	'notes' => 'Notlar'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
	'welcome' => 'Hoþgeldiniz !'
);

$lang_album_admin_menu = array(
	'confirm_delete' => 'Bu alb&uuml;m&uuml; silmek istediðinizden emin misiniz ? \\nB&uuml;t&uuml;n resimler ve yorumlar da silinecektir.',
	'delete' => 'SÝL',
	'modify' => '&Ouml;ZELLÝKLER',
	'edit_pics' => 'RESÝMLERDE DEÐÝÞÝÝKLÝLK YAP',
);

$lang_list_categories = array(
	'home' => 'Ana',
	'stat1' => '<b>[pictures]</b> resimler <b>[albums]</b> alb&uuml;mde ve <b>[cat]</b> kategoride, <b>[comments]</b> yorum <b>[views]</b> kere g&ouml;r&uuml;nt&uuml;lenmiþtir',
	'stat2' => '<b>[pictures]</b> resim <b>[albums]</b> alb&uuml;mde <b>[views]</b> kere g&ouml;r&uuml;nt&uuml;lenmiþtir',
	'xx_s_gallery' => '%s\ in Galerisi',
	'stat3' => '<b>[pictures]</b> resim <b>[albums]</b> alb&uuml;mde <b>[comments]</b> yorum <b>[views]</b> kere g&ouml;r&uuml;nt&uuml;lenmiþtir'
);

$lang_list_users = array(
	'user_list' => 'Kullanýcý listesi',
	'no_user_gal' => 'Alb&uuml;m yaratma izni olan hiçbir kullanýcý yok',
	'n_albums' => '%s alb&uuml;m',
	'n_pics' => '%s resim'
);

$lang_list_albums = array(
	'n_pictures' => '%s resim',
	'last_added' => ', sonuncusu %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => 'Giriþ',
	'enter_login_pswd' => 'Giriþ yapabilmek için kullanýcý adýnýzý ve þifrenizi kullanýn',
	'username' => 'Kullanýcý adý',
	'password' => 'Þifre',
	'remember_me' => 'Beni hatýrla',
	'welcome' => 'Hoþgeldin %s ...',
	'err_login' => '*** Giriþ yapýlmadý tekrar deneyim ***',
	'err_already_logged_in' => 'Zaten Giriþ yapmýþsýnýz !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => 'Çýkýþ',
	'bye' => 'G&ouml;r&uuml;þmek &uuml;zere %s ...',
	'err_not_loged_in' => 'Giriþ yapmadýnýz ki !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => 'Alb&uuml;m&uuml; g&uuml;ncelle %s',
	'general_settings' => 'Genel seçenekler',
	'alb_title' => 'Alb&uuml;m baþlýðý',
	'alb_cat' => 'Alb&uuml;m kategorisi',
	'alb_desc' => 'Alb&uuml;m açýklamasý',
	'alb_thumb' => 'Alb&uuml;m k&uuml;ç&uuml;k resimler',
	'alb_perm' => 'Bu alb&uuml;m için izinler',
	'can_view' => 'Alb&uuml;m kimler tarafýndan g&ouml;r&uuml;nt&uuml;lenebilir',
	'can_upload' => 'Ziyaretçiler resim y&uuml;kleyebilir',
	'can_post_comments' => 'Ziyaretçiler yorum yollayabilir',
	'can_rate' => 'Ziyaretçiler resim oylayabilir',
	'user_gal' => 'Kullanýcý galerisi',
	'no_cat' => '* Kategori yok *',
	'alb_empty' => 'Alb&uuml;m boþ',
	'last_uploaded' => 'Son y&uuml;klenen',
	'public_alb' => 'Herkes (açýk alb&uuml;m)',
	'me_only' => 'Sadece ben',
	'owner_only' => 'Alb&uuml;m sahibi (%s) sadece',
	'groupp_only' => '\'%s\' grubunun &uuml;yesi',
	'err_no_alb_to_modify' => 'G&uuml;ncelleme yapabileceðiniz bir alb&uuml;m yok veritabanýnda.',
	'update' => 'Alb&uuml;m&uuml; g&uuml;ncelle'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => 'Bu resimi &ouml;nceden oyladýnýz',
	'rate_ok' => 'Oyunuz kabul edildi',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
{SITE_NAME} y&ouml;neticileri herhangi nahoþ malzemeleri en kýsa s&uuml;rede ortadan kaldýracaktýr, her iletiyi okumak imkansýzdýr. B&ouml;ylelikle g&ouml;nderilen b&uuml;t&uuml;n iletilerin y&ouml;neticilerin veya site sahibinin g&ouml;r&uuml;þlerini deðil, yazarýnýn g&ouml;r&uuml;þlerini yansýttýðýný kabul etmiþ oluyorsunuz (y&ouml;neticiler tarafýndan g&ouml;ndeirlenler hariç) bu nedenle y&ouml;neticiler veya site sahibi sorumlu tutulamaz. .<br />
<br />
B&ouml;ylelikle herhangi s&ouml;vg&uuml; dolu, m&uuml;stehcen, kaba, karalayýcý, nefret dolu, tehdit edici, cinsel içerikli ve uygulanabilir yasalarý çiðneyecek içerikli ileti yollamamayý kabul etmiþ oluyorsunuz. {SITE_NAME} in site sahibinin, y&ouml;neticilerinin ve moderat&ouml;rlerin uygun g&ouml;rd&uuml;kleri takdirde, içerikleri silebilme veya bunlarda deðiþiklikler yapabilme haklarýna her içerik için her zaman sahip olduklarýný da kabul etmiþ oluyorsunuz. Bir kullanýcý olarak veritabanýna eklenmiþ olan herhangi bir bilgiyi de kabul etmiþ oluyorsunuz. Bu bilgi sizin izniniz olmadan hiç birþekilde &uuml;ç&uuml;nç&uuml; kiþilere ulaþtýrýlmayacaktýr, fakat site sahibi ve y&ouml;neticileri hacklenme sonucu bu verilen kaybolmasý ve/veya kullanýlmasý sonucu ve/veya çalýnmasý durumunda sorumlu tutulamaz..<br />
<br />
Bu site bilgisayarýnýzda bilgi kaydetmek amacýyla cookie'ler kullanýyor. Bu cookie'ler sadece sizin g&ouml;r&uuml;nt&uuml;leme zevkinizi geliþtirmek amacýyla kullanýlýr. E-Posta adresiniz sadece kaydolma bilgilerinizi ve þifrenizi onaylama amacý ile kullanýlýr.<br />
<br />
'Kabul Ediyorum' a basarak bu koþullara baðlý kalmayý kabul etmiþ oluyorsunuz.
EOT;

$lang_register_php = array(
	'page_title' => 'Kullanýcý kaydý',
	'term_cond' => 'Þartlar ve durumlar',
	'i_agree' => 'Kabul Ediyorum',
	'submit' => 'Kaydý G&ouml;nder',
	'err_user_exists' => 'Yazdýðýnýz kullanýcý adý kullanýlmaktadýr, baþka bir kullanýcý adý deneyin',
	'err_password_mismatch' => 'Yazdýðýnýz þifreler tutmuyor l&uuml;tfen þifreleriniz tekrar girin',
	'err_uname_short' => 'Kullanýcý adý en az 2 karakterden oluþmalý',
	'err_password_short' => 'Þifre en az 2 karakterden oluþmalý',
	'err_uname_pass_diff' => 'Kullanýcý adý ve þifre farklý olmalý',
	'err_invalid_email' => 'E-Posta adresi geçersizdir',
	'err_duplicate_email' => 'Baþka bir kullanýcý bu E-Posta adresini kullanarak kaydolmuþtur',
	'enter_info' => 'Bilgilerinizi girin',
	'required_info' => 'Gerekli bilgiler',
	'optional_info' => 'Seçimlik bilgiler',
	'username' => 'Kullanýcý Adý',
	'password' => 'Þifre',
	'password_again' => 'Þifrenizi yeniden girin',
	'email' => 'E-Posta',
	'location' => 'Konum',
	'interests' => 'Ýlgi alanlarý',
	'website' => 'Kiþisel Sayfa',
	'occupation' => 'Meslek',
	'error' => 'HATA',
	'confirm_email_subject' => '%s - Kayýt onayý',
	'information' => 'Bilgi',
	'failed_sending_email' => 'Kayýt onayý e-Postasý yollanamýyor !',
	'thank_you' => 'Kaydolduðunuz için teþekk&uuml;r ederiz.<br /><br />Hesabýnýzý nasýl etkinleþtireceðinizi yazan bir E-Posta adersinize yollanmýþtýr.',
	'acct_created' => 'Hesabýnýz oluþturulmuþtur, þimdi kullanýcý adýnýzý ve þifrenizi kullanarak giriþ yapabilirsiniz',
	'acct_active' => 'Hesabýnýz etkinleþtirildi, þimdi sisteme giriþ yapabilirsiniz',
	'acct_already_act' => 'Bu hesap zaten etkin !',
	'acct_act_failed' => 'Bu hesab etkinleþtirilemiyor !',
	'err_unk_user' => 'Seçilen kullanýcý yok !',
	'x_s_profile' => '%s\'in profili',
	'group' => 'Grup',
	'reg_date' => 'Katýlma tarihi',
	'disk_usage' => 'Disk kullanýmý',
	'change_pass' => 'Þifre deðiþtir',
	'current_pass' => 'Þu anki þifre',
	'new_pass' => 'Yeni þifre',
	'new_pass_again' => 'Yeni þifre yeniden',
	'err_curr_pass' => 'Þu anki þifre yanlýþ',
	'apply_modif' => 'Deðiþiklikleri uygula',
	'change_pass' => 'Þifremi deðiþtir',
	'update_success' => 'Profiliniz g&uuml;ncelleþtirildi',
	'pass_chg_success' => 'Þifreniz deðiþtirildi',
	'pass_chg_error' => 'Þifreniz deðiþtirildi',
);

$lang_register_confirm_email = <<<EOT
{SITE_NAME} de kaydolduðunuz için teþekk&uuml;r ederiz

Kullanýcý adýnýz : "{USER_NAME}"
Þifreniz : "{PASSWORD}"

Hesabýnýzý etkinleþtirebilmek için aþaðýdaki baðlantýya týklayýn
Veya taraycýnýzýn adres çubuðuna kopyalayýn

{ACT_LINK}

Sayfýlarýmýzla,

{SITE_NAME} y&ouml;neticileri

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => 'Eleþtiri yorumlarý',
	'no_comment' => 'Eleþtirilecek yorum yok',
	'n_comm_del' => '%s yorum silindi',
	'n_comm_disp' => 'G&ouml;sterilecek yorum sayýsý',
	'see_prev' => '&Ouml;ncekini g&ouml;r',
	'see_next' => 'Sonrakini g&ouml;re',
	'del_comm' => 'Seçilmiþ yorumlarý sil',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => 'Resim arþivinde ara',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => 'Yeni resimler ara',
	'select_dir' => 'Dizin seç',
	'select_dir_msg' => 'Bu fonksiyon size FTP ile y&uuml;kledðiniz bir grup resmi eklemenizi saðlar.<br /><br />Y&uuml;klediðiniz resimlerin dizinini seçin',
	'no_pic_to_add' => 'Eklenecek resim yok',
	'need_one_album' => 'Bu fonksiyonu kullanabilmek için en az bir alb&uuml;me ihtiyacýnýz var',
	'warning' => 'Dikkat',
	'change_perm' => 'Program bu dizine yazamýyor, yazabilmek için CHMOD unu 755 veya 777 yapmanýz gerekiyor resimleri y&uuml;klemeden &ouml;nce !',
	'target_album' => '<b>Resimlerini &quot;</b>%s<b>&quot; e g&ouml;nder </b>%s',
	'folder' => 'Klas&ouml;r',
	'image' => 'Resim',
	'album' => 'Alb&uuml;m',
	'result' => 'Sonuç',
	'dir_ro' => 'Yazýlamaz. ',
	'dir_cant_read' => 'Okunamaz. ',
	'insert' => 'Galeriye yeni resim ekle',
	'list_new_pic' => 'Yeni resimlerin listesi',
	'insert_selected' => 'Seçilmiþ resimleri ekle',
	'no_pic_found' => 'Yeni resim bulunamadý',
	'be_patient' => 'L&uuml;tfen bekleyiniz, program iþleminiz yapmaktadýr',
	'notes' =>  '<ul>'.
				'<li><b>OK</b> : Resminiz baþarý ile eklenmiþtir.'.
				'<li><b>DP</b> : Resim bir kopya, baþka bir kopyasý veritabanýnda bulunmaktadýr'.
				'<li><b>PB</b> : Resim y&uuml;klenemedi, resimlerin bulunduðu dizinlerin doðru ayarlanmýþ olduðundan emin olun'.
				'<li>Eðer OK, DP, PB \'signs\' iþaretlerinden biri çýkmýyorsa, kýrýk resmin &uuml;zerine týklayýn PHP hata iletisini g&ouml;rebilmek için'.
				'<li>Eðer sunucu zaman baðlantý hatasý olursa, yenile tuþuna basýn'.
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
                'title' => 'Kullanýcýlarý Yasakla', 
                'user_name' => 'Kullanýcý Adý', 
                'ip_address' => 'IP Adresi', 
                'expiry' => 'Bitiþ süresi (boþ daimi anlamýnda)', 
                'edit_ban' => 'Deðiþiklikleri Kayýt Et', 
                'delete_ban' => 'Sil', 
                'add_new' => 'Yeni Yasaklý Ekle', 
                'add_ban' => 'Ekle', 
); 

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
	'title' => 'Resim y&uuml;kleme',
	'max_fsize' => 'En fazla izin verilen boyut %s KB',
	'album' => 'Alb&uuml;m',
	'picture' => 'Resim',
	'pic_title' => 'Resim Baþlýðý',
	'description' => 'Resim açýklamasý',
	'keywords' => 'Anahat kelimeler (her anahtar kelimesi arasýnda boþluk býrakýn)',
	'err_no_alb_uploadables' => 'Y&uuml;kleyebileceðiniz herhangi bir alb&uuml;m&uuml;n&uuml;z yok',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => 'Kullanýcýlar d&uuml;zenle',
	'name_a' => 'Ýsimler k&uuml;ç&uuml;kten b&uuml;y&uuml;ðe sýrala ',
	'name_d' => 'Ýsimler b&uuml;y&uuml;ktan k&uuml;ç&uuml;ðe sýrala',
	'group_a' => 'Gruplarý k&uuml;ç&uuml;kten b&uuml;y&uuml;ðe sýrala',
	'group_d' => 'Gruplarý b&uuml;y&uuml;ktan k&uuml;ç&uuml;ðe sýrala',
	'reg_a' => 'Kayýt olma tarihi k&uuml;ç&uuml;kten b&uuml;y&uuml;ðe sýrala',
	'reg_d' => 'Kayýt olma tarihi b&uuml;y&uuml;ktan k&uuml;ç&uuml;ðe sýrala',
	'pic_a' => 'Resim sayma k&uuml;ç&uuml;kten b&uuml;ð&uuml;ðe',
	'pic_d' => 'Resim sayma b&uuml;y&uuml;kten k&uuml;ç&uuml;ðe',
	'disku_a' => 'Disk kullanýmý k&uuml;ç&uuml;kten b&uuml;y&uuml;ðe',
	'disku_d' => 'Disk kullanýmý b&uuml;y&uuml;kten k&uuml;ç&uuml;ðe',
	'sort_by' => 'Kullanýcýlarý g&ouml;re sýrala',
	'err_no_users' => 'Kullanýcý tablosu boþ !',
	'err_edit_self' => 'Kendi profilinizi d&uuml;zenleyemezsiniz, bunun için \'My profile\' baðlantýsýný kullanýn',
	'edit' => 'D&Uuml;ZENLE',
	'delete' => 'SÝL',
	'name' => 'Kullanýcý ad',
	'group' => 'Grup',
	'inactive' => 'Pasif',
	'operations' => 'Ýþlemler',
	'pictures' => 'Resimler',
	'disk_space' => 'Kullanýlan alan / kota',
	'registered_on' => 'Kayýt olma tarihi',
	'u_user_on_p_pages' => '%d kullanýcý %d sayfada',
	'confirm_del' => 'Bu kullanýcýy SÝLMEK istediðinizden emin misiniz ? \\nB&uuml;t&uuml;n resim ve alb&uuml;mleri silinecektir.',
	'mail' => 'POSTA',
	'err_unknown_user' => 'Seçilen kullanýcý yok !',
	'modify_user' => 'Kullanýcýy D&uuml;zenle',
	'notes' => 'Notlar',
	'note_list' => '<li>Þu anki þifreyi deðiþtirmek istemiyorsanýz Þifre alanýný boþ býrakýnýz',
	'password' => 'Þifre',
	'user_active_cp' => 'Kulannýcý etkin',
	'user_group_cp' => 'Kullanýcý grubu',
	'user_email' => 'Kullanýcý e-Posta',
	'user_web_site' => 'Kullanýcý að sitesi',
	'create_new_user' => 'Yeni kullanýcý oluþtur',
	'user_from' => 'Kullanýcý konumu',
	'user_interests' => 'Kullanýcý Ýlgi alanlarý',
	'user_occ' => 'Kullanýcý Mesleði',
);

// ------------------------------------------------------------------------- // 
// File util.php 
// ------------------------------------------------------------------------- // 

if (defined('UTIL_PHP')) $lang_util_php = array( 
        'title' => 'Resimleri boyutlandýr', 
        'what_it_does' => 'Ne yapar', 
        'what_update_titles' => 'Dosya Adýndan baþlýklarý günceller', 
        'what_delete_title' => 'Baþlýklarý Siler', 
        'what_rebuild' => 'Küçük resimleri ve boyutlandýrýlmýþ resimleri yeniden yapýlandýrýr', 
        'what_delete_originals' => 'Gerçek boyuttaki resimleri siler ve onlarý boyutlandýrýlmýþla deðiþtirir', 
        'file' => 'Dosya', 
        'title_set_to' => 'baþlýk ayarlanmýþ', 
        'submit_form' => 'ilet', 
        'updated_succesfully' => 'güncelleme baþarýlý', 
        'error_create' => 'yaratýrken HATA', 
        'continue' => 'Daha fazla resim iþle', 
        'main_success' => ' %s dosyasý baþarýlý bir þekilde ana resim olarak kullanýldý', 
        'error_rename' => ' %s ye %s yeniden adlandýrýken hata oluþtu', 
        'error_not_found' => ' %s dosyasý bulunamadý', 
        'back' => 'anasyafa geri dön', 
        'thumbs_wait' => 'Küçük resimleri ve/veya boyutlandýrýlmýþ resimler güncelleniyor, lütfen bekleyiniz...', 
        'thumbs_continue_wait' => 'Küçük resimlerin ve/veya boyutlandýrýlmýþ resimlerin güncellenmesine devam ediliyor...', 
        'titles_wait' => 'Baþlýklar güncelleniyor, lütfen bekleyiniz...', 
        'delete_wait' => 'Baþlýklar siliniyor, lütfen bekleyiniz...', 
        'replace_wait' => 'Asýl resimler siliniyor ve/veya boyutlandýrýlmýþ resimleri ile deðiþtiriliyor, lütfen bekleyiniz...', 
        'instruction' => 'Hýzlý Talimat', 
        'instruction_action' => 'Hareket seç', 
        'instruction_parameter' => 'Parametreleri ayarlar', 
        'instruction_album' => 'Albüm seç', 
        'instruction_press' => ' %s bas', 
        'update' => 'Küçük resimleri ve/veya boyutlandýrýlmýþ resimleri güncelle', 
        'update_what' => 'Neler güncellenmeli', 
        'update_thumb' => 'Sadece küçük resimler', 
        'update_pic' => 'Sadece boyutlandýrýlmýþ resimler', 
        'update_both' => 'Her ikiside küçük resimler ve boyutlandýrýlmýþ resimler', 
        'update_number' => 'Klik baþýna iþlenmiþ resimlerin sayýsý', 
        'update_option' => '(Eðer timeout sorunlarý yaþýyorsanýz daha düþüðe getirmeyi deneyin)', 
        'filename_title' => 'Dosya Adý ? Resim baþlýðý', 
        'filename_how' => 'Dosya adý nasýl deðiþtirilsin', 
        'filename_remove' => '.jpg sonunu kaldýr ve _ (alt çizgi)yi boþlukla deðiþtir', 
        'filename_euro' => '2003_11_23_13_20_20.jpg yi 3/11/2003 13:20 ye deðiþtir', 
        'filename_us' => '2003_11_23_13_20_20.jpg yi 11/23/2003 13:20 ye deðiþtir', 
        'filename_time' => '2003_11_23_13_20_20.jpg yi 13:20 ye deðiþtir', 
        'delete' => 'Resim baþlýklarýný veya gerçek boyut resimlerini sil', 
        'delete_title' => 'Resim baþlýklarýný sil', 
        'delete_original' => 'Gerçek boy resimleri sil', 
        'delete_replace' => 'Asýl resimleri sil ve bunlarý boyutlandýrýlmýþlarla deðiþtir', 
        'select_album' => 'Albüm seç', 
); 

?>
