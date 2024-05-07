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
// CVS version: $Id: turkish.php,v 1.8 2004/12/29 23:03:46 chtito Exp $
// ------------------------------------------------------------------------- //

// info about translators and translated language
$lang_translation_info = array(
  'lang_name_turkish' => 'Turkish',
  'lang_name_native' => 'T�rk�e',
  'lang_country_code' => 'tr',
  'trans_name'=> 'Ibrahim ALTINOK',
  'trans_email' => 'ibrahim@lavinya.net',
  'trans_website' => 'http://www.lavinya.net/',
  'trans_date' => '2004-09-01',
);

$lang_charset = 'iso-8859-9';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('Paz', 'Pzt', 'Sal', '�ar', 'Per', 'Cum', 'Cmt');
$lang_month = array('Ock', '�ub', 'Mrt', 'Nis', 'May', 'Haz', 'Tem', 'Agu', 'Eyl', 'Ekm', 'Kas', 'Arl');

// Some common strings
$lang_yes = 'Evet';
$lang_no  = 'Hay�r';
$lang_back = 'GER�';
$lang_continue = 'DEVAM ET';
$lang_info = 'Bilgi';
$lang_error = 'Hata';

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
  'random' => 'Rastgele Resim', //cpg1.3.0
  'lastup' => 'Son Eklenen',
  'lastalb'=> 'Son Yorum Yap�lanlar',
  'lastcom' => 'Son Yorumlar',
  'topn' => 'En Son Bak�nlan',
  'toprated' => 'En Be�enilen',
  'lasthits' => 'Son Bak�lan',
  'search' => 'Arama Sonu�lar�',
  'favpics'=> 'Favori Resimler', //cpg1.3.0
);

$lang_errors = array(
  'access_denied' => 'Bu Sayfaya eri�im hakk�n�z yok.',
  'perm_denied' => 'Bu i�lemi yapma hakk�n�z yok.',
  'param_missing' => 'Eksik parametre(ler)!',
  'non_exist_ap' => 'B�yle bir Album, Resim yok !',
  'quota_exceeded' => 'Diks alan� a��ld�<br /><br />[quota]K da bo� bir alan�n�z var, resimleriniz �uanda kullan�l�yor [space]K, bu resmi eklemek alan�n�z� a��racakt�r.', //cpg1.3.0
  'gd_file_type_err' => 'E�er GD image library kullan�l�yorsa sadece JPEG ve PNG formatlar� i�lenebilir.',
  'invalid_image' => 'Yollad���n�z resim hasarl� yada GD library taraf�ndan i�lenemiyor',
  'resize_failed' => 'Simge yada D���r�lm�� kalite resmi yarat�lmad�.',
  'no_img_to_display' => 'G�sterilebilcek resim yok',
  'non_exist_cat' => 'Se�ili Kategori yok',
  'orphan_cat' => 'Katagorinin �st katagorisi belli de�il, D�zeltmek i�in katagori y�nete gidiniz.', //cpg1.3.0
  'directory_ro' => ' \'%s\'  klas�r� yaz�labilir de�il, resimler silinemedi.', //cpg1.3.0
  'non_exist_comment' => 'Se�ili Yorum asl�nda yok.',
  'pic_in_invalid_album' => 'Se�ili resim ge�ersiz bir albumde (%s)!?', //cpg1.3.0
  'banned' => 'Kullan�lan bu siteden banland�n�z',
  'not_with_udb' => 'Bu fonksiyon Coppermine da kullan�lamaz ��nk� forum yaz�l�m� ile b�t�nle�tirildi. Yapmaya �al��t���n�z �ey b� �ekilde kald�r�lamad�, yada fonksiyon forum yazl�m� taraf�ndan elege�irildi.',
  'offline_title' => 'Kapal�', //cpg1.3.0
  'offline_text' => 'Galeri kapal�- ilerde tekrar deneyin', //cpg1.3.0
  'ecards_empty' => 'Ekart kay�t� bulunmamaktad�r. Coppermine se�eneklerindeki  ekart giri� imkan�n� kontrol edin!', //cpg1.3.0
  'action_failed' => '��lem olmad�.  Coppermine sizin talebinizi i�leyemedi.', //cpg1.3.0
  'no_zip' => 'ZIP resimleri i�in Gerekli librarilere ula��lamaz.  L�tfen Coppermine admininiz ile ileti�ime ge�in.', //cpg1.3.0
  'zip_type' => 'ZIP dosyalar�n� y�klemeye izniniz yok.', //cpg1.3.0
);

$lang_bbcode_help = 'Yap�lan kodlar yararl� olmal�d�r: <li>[b]<b>Kal�n</b>[/b]</li> <li>[i]<i>�talik</i>[/i]</li> <li>[url=http://yoursite.com/]Url Text[/url]</li> <li>[email]user@domain.com[/email]</li>'; //cpg1.3.0

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
  'alb_list_title' => 'Alb�m listesine git',
  'alb_list_lnk' => 'Alb�m Listesi',
  'my_gal_title' => 'Ki�isel galerime git',
  'my_gal_lnk' => 'Galerim',
  'my_prof_lnk' => 'Profilim',
  'adm_mode_title' => 'Y�netici moduna Ge�',
  'adm_mode_lnk' => 'Admin modu',
  'usr_mode_title' => 'Kullan�c� moduna Ge�',
  'usr_mode_lnk' => 'Kullan�c� modu',
  'upload_pic_title' => 'Bir Alb�me Resim Ekle', //cpg1.3.0
  'upload_pic_lnk' => 'Resim y�kle', //cpg1.3.0
  'register_title' => 'Alb�me resim ekle',
  'register_lnk' => 'Kay�t ol',
  'login_lnk' => 'Giri�',
  'logout_lnk' => '��k��',
  'lastup_lnk' => 'Son y�klenenler',
  'lastcom_lnk' => 'Son yorumlar',
  'topn_lnk' => 'En �ok Bak�lanlar',
  'toprated_lnk' => 'En be�enilenler',
  'search_lnk' => 'Ara',
  'fav_lnk' => 'Favorilerim',
  'memberlist_title' => '�ye listesini g�ster', //cpg1.3.0
  'memberlist_lnk' => '�ye listesi', //cpg1.3.0
  'faq_title' => 'Resim galerisi �zerindeki Sorulan Soru &quot;Coppermine&quot;', //cpg1.3.0
  'faq_lnk' => 'FAQ', //cpg1.3.0
);

$lang_gallery_admin_menu = array(
  'upl_app_lnk' => 'Resim y�kleme onaylar�',
  'config_lnk' => 'Se�enekler',
  'albums_lnk' => 'Alb�mler',
  'categories_lnk' => 'Kategoriler',
  'users_lnk' => 'Kullan�c�lar',
  'groups_lnk' => 'Gruplar',
  'comments_lnk' => 'Yorumlar', //cpg1.3.0
  'searchnew_lnk' => '�oklu resim ekleme', //cpg1.3.0
  'util_lnk' => 'Admin s�enekleri', //cpg1.3.0
  'ban_lnk' => 'Kullan�c�lar� Banla',
  'db_ecard_lnk' => 'Ekart g�sterimi', //cpg1.3.0
);

$lang_user_admin_menu = array(
  'albmgr_lnk' => 'Album YARAT / D�ZENLE',
  'modifyalb_lnk' => 'Alb�m Se�enekleri',
  'my_prof_lnk' => 'Ki�isel Profilim',
);

$lang_cat_list = array(
        'category' => 'Kategori',
        'albums' => 'Albumler',
  'pictures' => 'Resimler', //cpg1.3.0
);

$lang_album_list = array(
        'album_on_page' => '%d album var %d sayfada'
);

$lang_thumb_view = array(
  'date' => 'TAR�H',
  //Sort by filename and title
  'name' => 'Ad',
  'title' => 'Konu',
  'sort_da' => 'Tarihe g�re ARTAN S�rala',
  'sort_dd' => 'Tarihe g�re AZALAN S�rala',
  'sort_na' => 'Ada g�re ARTAN S�rala',
  'sort_nd' => 'Ada g�re AZALAN S�rala',
  'sort_ta' => 'Konuya g�re ARTAN S�rala',
  'sort_td' => 'Konuya g�re AZALAN S�rala',
  'download_zip' => 'Zip dosyas� olarak indir', //cpg1.3.0
  'pic_on_page' => '%d resim var %d sayfada',
  'user_on_page' => '%d kullan�c� var %d sayfada', //cpg1.3.0
);

$lang_img_nav_bar = array(
  'thumb_title' => 'K���k Resim Sayfas�na D�n',
  'pic_info_title' => 'Resim �zelliklerini G�ster/Sakla', //cpg1.3.0
  'slideshow_title' => 'Ard-arda G�sterim',
  'ecard_title' => 'Bu resmi bir e-kartpostal olrak yolla ', //cpg1.3.0
  'ecard_disabled' => 'e-kartpostal �zelli�i etkin de�il',
  'ecard_disabled_msg' => 'E-kartpostal yollama izniniz YOK', //js-alert //cpg1.3.0
  'prev_title' => '�nceki Resme Bak', //cpg1.3.0
  'next_title' => 'Sonraki Resme Bak', //cpg1.3.0
  'pic_pos' => 'RES�M %s/%s', //cpg1.3.0
);

$lang_rate_pic = array(
  'rate_this_pic' => 'Resimi Puanla', //cpg1.3.0
  'no_votes' => '(Puanlama henuz yok)',
  'rating' => '(G�ncel Be�eni Oran� : %s / 5 etkiyen %s oy',
  'rubbish' => 'Berbat',
  'poor' => 'De�ersiz',
  'fair' => '�dare Eder',
  'good' => '�yi',
  'excellent' => '�ok �yi',
  'great' => 'M�kemmel',
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
  CRITICAL_ERROR => 'Kritik Hata',
  'file' => 'Dosya: ',
  'line' => 'Sat�r: ',
);

$lang_display_thumbnails = array(
  'filename' => 'Dosya Ad� : ',
  'filesize' => 'Dosya B�y�kl���: ',
  'dimensions' => '�l��ler : ',
  'date_added' => 'Eklendi�i Tarih : '
);

$lang_get_pic_data = array(
  'n_comments' => '%s yorum yap�ld�',
  'n_views' => '%s kez bak�ld�',
  'n_votes' => '(%s oy verildi)'
);

$lang_cpg_debug_output = array(
  'debug_info' => 'Debug Info', //cpg1.3.0
  'select_all' => 'T�m�n� Se�', //cpg1.3.0
  'copy_and_paste_instructions' => 'Coppermine den yard�m talebinde bulunacaksan�z,debug ��k���n� yollad���n�za copyalay�p yap��t�r�n. Yollamadan �nce *** ile olan yerleri tekrar doldurun.', //cpg1.3.0
  'phpinfo' => 'phpbilgi g�sterimi', //cpg1.3.0
);

$lang_language_selection = array(
  'reset_language' => 'Ge�erli dil', //cpg1.3.0
  'choose_language' => 'Dilinizi se�in', //cpg1.3.0
);

$lang_theme_selection = array(
  'reset_theme' => 'Ge�erli konu', //cpg1.3.0
  'choose_theme' => 'Bir konu se�iniz', //cpg1.3.0
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
  'Exclamation' => '�nlem',
  'Question' => 'Soru',
  'Very Happy' => '�ok Mutlu',
  'Smile' => 'G�l�msiyen',
  'Sad' => '�zg�n',
  'Surprised' => '�a��rm��',
  'Shocked' => '�ok olmu�',
  'Confused' => 'Kafas� Kar���k',
  'Cool' => 'Cool',
  'Laughing' => 'G�len',
  'Mad' => 'Deli',
  'Razz' => 'Razz',
  'Embarassed' => 'Utanm��',
  'Crying or Very sad' => '�ok �zg�n veya a�lama',
  'Evil or Very Mad' => '�eytan veye manyak',
  'Twisted Evil' => 'Sap�tm�� Seytan',
  'Rolling Eyes' => 'G�z� d�nm��',
  'Wink' => 'G�zk�rpan',
  'Idea' => 'Amp�l Fikirli',
  'Arrow' => 'Ok',
  'Neutral' => 'Do�al',
  'Mr. Green' => 'Bay Ye�il',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
  0 => 'Y�netici modu terkediliyor...',
  1 => 'Y�netici moduna Ge�iliyor...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
  'alb_need_name' => 'Albumlerin ad� olmal�!', //js-alert
  'confirm_modifs' => 'Bu de�i�iklikleri Yapmak istedi�inizden eminmisiniz ?', //js-alert
  'no_change' => 'De�i�iklik yapmad�n�z ki !', //js-alert
  'new_album' => 'Yeni Alb�m',
  'confirm_delete1' => 'BU albumu silmek istedi�inizden eminmisiniz ?', //js-alert
  'confirm_delete2' => '\nB�t�n RES�MLER,YORUMLAR ve ��ER��� YOK OLACAK !', //js-alert
  'select_first' => '�lk �nce bir album se�iniz', //js-alert
  'alb_mrg' => 'Album Y�neticisi',
  'my_gallery' => '* Ki�isel Galerim *',
  'no_category' => '* Katagori Yok *',
  'delete' => 'Sil',
  'new' => 'Yeni',
  'apply_modifs' => 'De�i�iklikleri Yap',
  'select_category' => 'Katagori Se�',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
  'miss_param' => '\'%s\' i�lemi i�in gerekli parametreler eksik !',
  'unknown_cat' => 'Se�ili Katagaori Veritaban�nda yok',
  'usergal_cat_ro' => 'Kullan�c� Galerileri Katagorisi Silinemez!',
  'manage_cat' => 'Katagorileri Y�net',
  'confirm_delete' => 'BU katagoriyi silmek istedi�inizden eminmisiniz ?', //js-alert
  'category' => 'Katagori',
  'operations' => '��lemler',
  'move_into' => 'Ta��',
  'update_create' => 'Katagori G�ncelle/Ekle',
  'parent_cat' => '�ST Katagori',
  'cat_title' => 'Katagori ADI',
  'cat_desc' => 'Katagori Tan�m�'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
  'title' => 'Ayarlamalar',
  'restore_cfg' => 'Fabrika ayarlar�na GeriD�N',
  'save_cfg' => 'Yeni Ayarlar� kaydet',
  'notes' => 'Notlar',
  'info' => 'Bilgi',
  'upd_success' => 'Coppermine Galeri Ayarlar� G�ncellendi',
  'restore_success' => 'Coppermine Galeri Ayarlar� Varsay�lana D�nd�',
  'name_a' => 'Ada g�re ARTAN',
  'name_d' => 'Ada g�re AZALAN',
  'date_a' => 'Tarihe g�re ARTAN',
  'date_d' => 'Tarihe g�re AZALAN',
  'th_any' => 'Maksimum Aspect',
  'th_ht' => 'Y�kseklik',
  'th_wd' => 'Geni�lik',
  'label' => 'label', //cpg1.3.0
  'item' => 'item', //cpg1.3.0
  'debug_everyone' => 'Herkes', //cpg1.3.0
  'debug_admin' => 'Sadece Admin', //cpg1.3.0
        );

if (defined('CONFIG_PHP')) $lang_config_data = array(
  'General settings',
  array('Galeri ad�', 'gallery_name', 0),
  array('Galeri tan�t�m�', 'gallery_description', 0),
  array('Galeri admin emaili', 'gallery_admin_email', 0),
  array('E-kartpostallardaki linkin hedef adresi', 'ecards_more_pic_target', 0),
  array('Galeri kapal�', 'offline', 1), //cpg1.3.0
  array('Ekartlar� logla', 'log_ecards', 1), //cpg1.3.0
  array('Favori ZIP-indirmelerini takip et', 'enable_zipdownload', 1), //cpg1.3.0

  'Language, Themes &amp; Charset settings',
  array('Dil', 'lang', 5),
  array('Konu', 'theme', 6),
  array('Dil listesini g�ster', 'language_list', 1), //cpg1.3.0
  array('Dil bayraklar�n� g�ster', 'language_flags', 8), //cpg1.3.0
  array(' &quot;reset&quot; dil se�imlerinde g�ster', 'language_reset', 1), //cpg1.3.0
  array('Konu listesini g�ster', 'theme_list', 1), //cpg1.3.0
  array(' &quot;reset&quot; konu se�ene�inde g�ster', 'theme_reset', 1), //cpg1.3.0
  array('FAQ g�ster', 'display_faq', 1), //cpg1.3.0
  array('Bbcode yard�m� g�ster', 'show_bbcode_help', 1), //cpg1.3.0
  array('Karakter se�ene�i', 'charset', 4), //cpg1.3.0

  'Alb�m listesi G�sterimi',
  array('Ana Tablo Geni�li�i (pixel yada %)', 'main_table_width', 0),
  array('G�sterilecek Alt Katagori D�zeyi', 'subcat_level', 0),
  array('Bir Sayfada g�sterilecek Album say�s�', 'albums_per_page', 0),
  array('Album Listesinin S�t�n say�s�', 'album_list_cols', 0),
  array('K���k Resim(Pul) Boyutu (Pixel olarak)', 'alb_list_thumb_size', 0),
  array('Ana Sayfa ��eri�i', 'main_page_layout', 0),
  array('Kategorilerdeki k���k resimleri birinci seviye g�ster','first_level',1),

  'K���k resim (Pul)G�sterimi',
  array('K���k Resim(Pul) sayfas� s�t�n say�s�', 'thumbcols', 0),
  array('K���k Resim(Pul) sayfas� s�ra say�s�', 'thumbrows', 0),
  array('En fazla Pul', 'max_tabs', 0), //cpg1.3.0
  array('Pulun ad�n�n alt�nda tan�m�n�da g�ster', 'caption_in_thumbview', 1), //cpg1.3.0
  array('K���k resimleri bak�lma say�s�na g�re g�ster', 'views_in_thumbview', 1), //cpg1.3.0
  array('Pulun ad�n�n alt�nda yap�lan yorum say�s�n�da g�ster', 'display_comment_count', 1),
  array('K���k resimleri ada g�re g�ster', 'display_uploader', 1), //cpg1.3.0
  array('Ge�erli s�raya koy', 'default_sort_order', 3), //cpg1.3.0
  array('Pulun ad�n�n alt�nda yap�lan yorum say�s�n�da g�ster', 'display_comment_count', 1), //cpg1.3.0

  'Resim G�sterimi &amp; Yorum Se�enekleri',
  array('Resim Tablosu Geni�li�i (pixel yada %)', 'picture_table_width', 0), //cpg1.3.0
  array('Resim �zellikleri �ntan�ml� a��ls�n m�?', 'display_pic_info', 1), //cpg1.3.0
  array('Yorumlardaki k�t� kelimeleri sans�rle', 'filter_bad_words', 1),
  array('G�l�c�klere yorumlarda izin ver', 'enable_smilies', 1),
  array('Allow several consecutive comments on one file from the same user (disable flood protection)', 'disable_comment_flood_protect', 1), //cpg1.3.0
  array('Resim tan�m� uzunlu�u En-fazla?', 'max_img_desc_length', 0),
  array('Bir kelimeki karakter say�s� En-�ok?', 'max_com_wlength', 0),
  array('Bir Yorumdaki Sat�r say�s� En-�ok?', 'max_com_lines', 0),
  array('Bir Yorumun uzunlu�u En-fazla?', 'max_com_size', 0),
  array('Film �eridini g�ster', 'display_film_strip', 1),
  array('�eritdeki par�alar�n numaras�', 'max_film_strip_items', 0),
  array('Yorumlar� admine email arac�l��� ile haber ver', 'email_comment_notification', 1), //cpg1.3.0
  array('Ardarda g�sterimi aral�klar�n� milisaniyelerle yap (1 saniye = 1000 milisaniye)', 'slideshow_interval', 0), //cpg1.3.0

  'Resim ve Pul Se�enekleri', //cpg1.3.0
  array('JPEG dosyalar� i�in kalite ayar�', 'jpeg_qual', 0),
  array('K���k resim i�n maksimum boyut <a href="#notice2" class="clickable_option">**</a>', 'thumb_width', 0), //cpg1.3.0
  array('Boyut kullan ( geni�lik yaday�kseklik yada k���k resim i�in maksimum g�r�n�� )<b>**</b>', 'thumb_use', 7),
  array('Orta seviye resim olu�tur','make_intermediate',1),
  array('Orta seviye resim/video i�in maksimum geni�lik yada y�kseklik <a href="#notice2" class="clickable_option">**</a>', 'picture_width', 0), //cpg1.3.0
  array('Y�lenen resim i�in en b�y�k boyut (KB)', 'max_upl_size', 0), //cpg1.3.0
  array('Y�klene resimler/videolar i�in en b�y�k geni�lik ve boyut (pixels)', 'max_upl_width_height', 0), //cpg1.3.0

  'Resim ve Pul Geli�mi� Se�enekleri', //cpg1.3.0
  array('�zel alb�m ikonunu giri� yapmayan kullan�c�ya g�ster','show_private',1), //cpg1.3.0
  array('Dosya adlar�nda Yasaklanm�� Karakterler', 'forbiden_fname_char',0), //cpg1.3.0
  //array('Dosya adlar�nda Yasaklanm�� Karakterler', 'forbiden_fname_char',0), //cpg1.3.0
  array('�zin verilen imaj t�rleri', 'allowed_img_types',0), //cpg1.3.0
  array('�zin verilen movie t�rleri', 'allowed_mov_types',0), //cpg1.3.0
  array('�zin verilen audio t�rleri', 'allowed_snd_types',0), //cpg1.3.0
  array('�zin verilen d�k�man t�rleri', 'allowed_doc_types',0), //cpg1.3.0
  array('Resim boyutland�rmas� i�in kullan�lacak y�ntem','thumb_method',2), //cpg1.3.0
  array('ImageMagick \'d�n��t�r�c�\' program�n�n yolu (�rn /usr/bin/X11/)', 'impath', 0), //cpg1.3.0
  //array('�zinli Resim tipleri (sadece ImageMagick i�in ge�erli)', 'allowed_img_types',0), //cpg1.3.0
  array('ImageMagick i�in ek komut sat�r� se�enekleri', 'im_options', 0), //cpg1.3.0
  array('JPEG dosyalr�ndaki EXIF verisini oku', 'read_exif_data', 1), //cpg1.3.0
  array('JPEG dosyalar�ndaki IPTC verisini oku', 'read_iptc_data', 1), //cpg1.3.0
  array('Alb�m Klas�r� <a href="#notice1" class="clickable_option">*</a>', 'fullpath', 0), //cpg1.3.0
  array('Kullan�c� resimleri klas�r� <a href="#notice1" class="clickable_option">*</a>', 'userpics', 0), //cpg1.3.0
  array('Orta Seviye RES. i�in ad �n tak�s� <a href="#notice1" class="clickable_option">*</a>', 'normal_pfx', 0), //cpg1.3.0
  array('Pullar i�in ad �n tak�s� <a href="#notice1" class="clickable_option">*</a>', 'thumb_pfx', 0), //cpg1.3.0
  array('Klas�rler i�in ge�erli olan Cmode', 'default_dir_mode', 0), //cpg1.3.0
  array('Resimler i�in ge�erli olan Cmode', 'default_file_mode', 0), //cpg1.3.0

  'Kullan�c� Ayarlar�',
  array('Yeni Kullan�c� Kayd�na izin ver', 'allow_user_registration', 1),
  array('Kullan�c� Kayd�na email onay� gerektirir', 'reg_requires_valid_email', 1),
  array('Kullan�c� kay�tlar�n� email yoluyla admine haber ver', 'reg_notify_admin_email', 1), //cpg1.3.0
  array('Birden fazla kullan�c� ayn� email adresine sahip olabilir', 'allow_duplicate_emails_addr', 1),
  array('Kullan�c�lar �zel alb�me sahip olabilirler (Not:E�er \'evet\' i \'hay�r\' a �evirirseniz �zel alb�mler herkese a��k olmayacakt�r)', 'allow_private_albums', 1), //cpg1.3.0
  array('Kullan�c�lar�n bekleyen y�klemelerini admine haber ver', 'upl_notify_admin_email', 1), //cpg1.3.0
  array('Giri� yapan kullan�c�lar� �ye listesini g�stermeye izin ver', 'allow_memberlist', 1), //cpg1.3.0

  '�zel Tan�m Alanlar� (Kullan�m D���ysa Bo� B�rakabilirsiniz)',
  array('Alan 1 ad�', 'user_field1_name', 0),
  array('Alan 2 ad�', 'user_field2_name', 0),
  array('Alan 3 ad�', 'user_field3_name', 0),
  array('Alan 4 ad�', 'user_field4_name', 0),

  'Cookies Se�enekleri',
  array('Script taraf�ndan kullan�lan cookie nin ad�', 'cookie_name', 0),
  array('Script taraf�ndan cookie i�in ge�erli yol', 'cookie_path', 0),

  'Di�er Se�enekler',
  array('Debug moduna ula��lamaz', 'debug_mode', 9), //cpg1.3.0
  array('Debug modundaki notlar� g�ster', 'debug_notice', 1), //cpg1.3.0

  '<br /><div align="left"><a name="notice1"></a>(*) ile i�eretli alanlar e�er zaten galerilerinizde resim varsa de�i�tirilmemelidir<br />
  <a name="notice2"></a>(**) ile i�aretli yerleri de�i�tirdi�iniz zaman, sadece ekledi�iniz noktadaki dosyalar� etkiler, bundan dolay� galeride e�er resimler varsa ayarlar�n de�i�tirilmemesi daha mant�kl�. Siz, bununla birlikte, &quot mevcut olan dosyalar� da ; <a href="util.php">admin se�enekleri</a> le de�i�tirmi� olacaks�n�z (resimleri yeniden boyutland�r)&quot; admin men�s�nden faydalan�n.</div><br />', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File db_ecard.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('DB_ECARD_PHP')) $lang_db_ecard_php = array(
  'title' => 'Ekart yollama', //cpg1.3.0
  'ecard_sender' => 'G�nderen', //cpg1.3.0
  'ecard_recipient' => 'Recipient', //cpg1.3.0
  'ecard_date' => 'Tarih', //cpg1.3.0
  'ecard_display' => 'Ekart g�sterimi', //cpg1.3.0
  'ecard_name' => 'Ad', //cpg1.3.0
  'ecard_email' => 'Email', //cpg1.3.0
  'ecard_ip' => 'IP #', //cpg1.3.0
  'ecard_ascending' => 'y�kselim', //cpg1.3.0
  'ecard_descending' => 'al�al�m', //cpg1.3.0
  'ecard_sorted' => 'S�raland�', //cpg1.3.0
  'ecard_by_date' => 'tarihe g�re', //cpg1.3.0
  'ecard_by_sender_name' => 'by sender\'s name', //cpg1.3.0
  'ecard_by_sender_email' => 'by sender\'s email', //cpg1.3.0
  'ecard_by_sender_ip' => 'by sender\'s IP address', //cpg1.3.0
  'ecard_by_recipient_name' => 'by recipient\'s name', //cpg1.3.0
  'ecard_by_recipient_email' => 'by recipient\'s email', //cpg1.3.0
  'ecard_number' => 'g�sterim kay�t� %s to %s of %s', //cpg1.3.0
  'ecard_goto_page' => 'sayfaya git', //cpg1.3.0
  'ecard_records_per_page' => 'Sayfa ba��ndaki kay�tlar', //cpg1.3.0
  'check_all' => 'T�m�n� kontrol et', //cpg1.3.0
  'uncheck_all' => 'Hi�birini kontrol etme', //cpg1.3.0
  'ecards_delete_selected' => 'Se�ilen ekartlar� sil', //cpg1.3.0
  'ecards_delete_confirm' => 'Silmek istedi�inizden emin misiniz?Kontrol kutusunu i�aretleyin!', //cpg1.3.0
  'ecards_delete_sure' => 'Eminim', //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
  'empty_name_or_com' => ' Ad�n�z� ve bir yorum yazmal�s�n�z',
  'com_added' => 'Yorumunuz eklendi',
  'alb_need_title' => 'Alb�m i�in bir ba�l�k se�melisiniz !',
  'no_udp_needed' => 'G�ncellemeye gerek yok.',
  'alb_updated' => 'Alb�m g�ncelle�ti',
  'unknown_album' => 'Se�ilen alb�m bulunamad� yada bu alb�me y�kleme izniniz yok',
  'no_pic_uploaded' => 'Resim Y�klenmedi !<br /><br />E�er ger�ekten y�klemek i�in resim se�tiyseniz, sunucunun izin veridi�i resim y�klemelerini kontrol edin...', //cpg1.3.0
  'err_mkdir' => 'Yaratma klas�r� ba�ar�s�z %s !',
  'dest_dir_ro' => 'G�nderilen adres %s script taraf�ndan yaz�lamaz !',
  'err_move' => '%s ya %s ge�mek imkans�z!',
  'err_fsize_too_large' => 'Y�kledi�iniz resim �ok b�y�k(izin verilen maksimum b�ykl�k %s x %s) !', //cpg1.3.0
  'err_imgsize_too_large' => 'Y�kledi�iniz resim boyuttu �ok geni� (izin verilen maksimum geni�lik %s KB) !',
  'err_invalid_img' => 'Y�kledi�iniz resim ge�erli de�il !',
  'allowed_img_types' => 'sadece %s imajlar� y�kleyebilirsiniz.',
  'err_insert_pic' => ' \'%s\' resim alb�me yerle�medi ', //cpg1.3.0
  'upload_success' => 'Resminiz ba�ar� ile y�klendi.<br /><br />Admin onay�ndan sonra resminiz eklenecektir.', //cpg1.3.0
  'notify_admin_email_subject' => '%s - Y�kleme bildirisi', //cpg1.3.0
  'notify_admin_email_body' => ' %s taraf�ndan onay�n�z� bekleyen resim eklendi. %s bak', //cpg1.3.0
  'info' => 'Bilgi',
  'com_added' => 'Yorum eklendi',
  'alb_updated' => 'Album updated',
  'err_comment_empty' => 'Yorumunuz bo� !',
  'err_invalid_fext' => 'Sadece izin verilen resimler b�y�t�lebilir : <br /><br />%s.',
  'no_flood' => '�zg�m�n ama bu dosya i�in son yorumun yazar� sizsiniz<br /><br /> E�er istiyorsan�z yorumunuzu d�zeltin', //cpg1.3.0
  'redirect_msg' => 'Adresiniz de�i�tiriliyor.<br /><br /><br />Click \'DEVAM\' e�er sayfa otomatik olarak yenilenmezse',
  'upl_success' => 'Resminiz ba�ar�lyla eklendi', //cpg1.3.0
  'email_comment_subject' => 'Yorum �brahim ALTINOK Galeri de yoland�', //cpg1.3.0
  'email_comment_body' => 'Birisi galerinize bir yorum yollad�. Buradan bak�n', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
  'caption' => 'Ba�l�k',
  'fs_pic' => 'Tam boy g�r�nt�',
  'del_success' => 'Ba�ar�yla silindi',
  'ns_pic' => 'Normal boy g�r�nt�',
  'err_del' => 'silinemedi',
  'thumb_pic' => 'k���k resim',
  'comment' => 'yorum',
  'im_in_alb' => 'alb�mde g�r�nt�',
  'alb_del_success' => '\'%s\' alb�m silindi',
  'alb_mgr' => 'Alb�m Y�neticisi',
  'err_invalid_data' => '\'%s\' da Veri almada hata',
  'create_alb' => 'Alb�m olu�turma\'%s\'',
  'update_alb' => 'Alb�m g�ncelleme\'%s\' ba�l�kla \'%s\' ve index \'%s\'',
  'del_pic' => 'Resmi sil', //cpg1.3.0
  'del_alb' => 'Alb�m� sil',
  'del_user' => 'Kullan�c�y� sil',
  'err_unknown_user' => 'Se�ilen kullan�c� bulunamad� !',
  'comment_deleted' => 'Yorum ba�ar�yla silindi',
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
  'confirm_del' => 'Bu resmi S�LMEK istedi�inizden emin misiniz ? \\nYorum silinmi� olmal�.', //js-alert //cpg1.3.0
  'del_pic' => 'BU RESM� S�L', //cpg1.3.0
  'size' => '%s x %s pixels',
  'views' => '%s zamanlar',
  'slideshow' => 'Ardarda g�sterim',
  'stop_slideshow' => 'G�sterimi durdur',
  'view_fs' => 'Tam boy g�r�n�m i�in t�klay�n',
  'edit_pic' => 'A��klamay� d�zenle', //cpg1.3.0
  'crop_pic' => 'Kes ve yer de�i�tir', //cpg1.3.0
);

$lang_picinfo = array(
  'title' =>'Resim bilgisi', //cpg1.3.0
  'Filename' => 'Resim Ad�',
  'Album name' => 'Alb�m Ad�',
  'Rating' => 'Oylar (%s votes)',
  'Keywords' => 'Anahtar Kelimeler',
  'File Size' => 'Resim boyutu',
  'Dimensions' => 'Boyutlar',
  'Displayed' => 'G�sterilme',
  'Camera' => 'Kamera',
  'Date taken' => '�ekilen tarih',
  'ISO'=>'ISO',
  'Aperture' => 'Bo�luk',
  'Exposure time' => 'Ortaya ��kma zaman�',
  'Focal length' => 'Uzunluk',
  'Comment' => 'Yorum',
  'addFav'=>'Favorilere ekle', //cpg1.3.0
  'addFavPhrase'=>'Favoriler', //cpg1.3.0
  'remFav'=>'Favorilerden ayr�l', //cpg1.3.0
  'iptcTitle'=>'IPTC Ba�l�k', //cpg1.3.0
  'iptcCopyright'=>'IPTC Kopyalama', //cpg1.3.0
  'iptcKeywords'=>'IPTC Anahtar kelimeler', //cpg1.3.0
  'iptcCategory'=>'IPTC Kategori', //cpg1.3.0
  'iptcSubCategories'=>'IPTC Alt kategoriler', //cpg1.3.0
);

$lang_display_comments = array(
  'OK' => 'TAMAM',
  'edit_title' => 'Bu yorumu d�zenle',
  'confirm_delete' => 'Bu yorumu silmek istedi�inizden emin misiniz?', //js-alert
  'add_your_comment' => 'Yorumunuzu ekleyin',
  'name'=>'�sim',
  'comment'=>'Yorum',
  'your_name' => 'Anon',
);

$lang_fullsize_popup = array(
  'click_to_close' => 'Bu pencereyi kapatmak i�in g�t�nt�ye t�klay�n',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
  'title' => 'Ekart g�nder',
  'invalid_email' => '<b>Uyar�</b> : ge�ersiz email adres !',
  'ecard_title' => ' %s den sizin i�in bir ekart ',
  'error_not_image' => 'Sadece g�r�nt�ler ekart olarak g�nderilebilir', //cpg1.3.0
  'view_ecard' => 'E�er ekart tam olarak g�r�nmezse bu linki y�klay�n�z',
  'view_more_pics' => 'Daha fazla resim resim i�in bu linki t�klay�n�z !',
  'send_success' => 'Ekart�n�z yoland�',
  'send_failed' => '�zg�n�m ama sunucu ekart�n�z� yollayamad�...',
  'from' => 'Nereden',
  'your_name' => 'Ad�n�z',
  'your_email' => 'Email adresiniz',
  'to' => 'Kime',
  'rcpt_name' => 'Al�c�n�n Ad�',
  'rcpt_email' => 'Al�c�n�n email adresi',
  'greetings' => 'Ba�l�k',
  'message' => 'Mesaj�n�z',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
  'pic_info' => 'Rsim bilgisi', //cpg1.3.0
  'album' => 'Alb�m',
  'title' => 'Ba�l�k',
  'desc' => 'A��klama',
  'keywords' => 'Anahtar kelimeler',
  'pic_info_str' => '%s &times; %s - %s KB - %s views - %s votes',
  'approve' => 'Resmi onayla', //cpg1.3.0
  'postpone_app' => 'Onay� ertele',
  'del_pic' => 'Resmi sil', //cpg1.3.0
  'read_exif' => 'EXIF bilgisini tekrar okuyunuz', //cpg1.3.0
  'reset_view_count' => 'G�r�nt� sayac�n� yenile',
  'reset_votes' => 'Oylar� yenile',
  'del_comm' => 'Yorumlar� sil',
  'upl_approval' => 'Onay g�nder',
  'edit_pics' => 'Resimleri D�zenle', //cpg1.3.0
  'see_next' => 'Di�er resimlere bak', //cpg1.3.0
  'see_prev' => 'Gerideki resimlere bak', //cpg1.3.0
  'n_pic' => '%s resimler', //cpg1.3.0
  'n_of_pic_to_disp' => 'G�sterim i�in resimlerin numaralar�', //cpg1.3.0
  'apply' => 'De�i�iklikleri Kaydet', //cpg1.3.0
  'crop_title' => 'Coppermine Picture Editor', //cpg1.3.0
  'preview' => '�zel g�sterim', //cpg1.3.0
  'save' => 'Rsimleri kaydet', //cpg1.3.0
  'save_thumb' =>'K���k resim olarak kaydet', //cpg1.3.0
  'sel_on_img' =>'Se�im t�m�yle resimler �zerinde olmal�d�r!', //js-alert //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File faq.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FAQ_PHP')) $lang_faq_php = array(
  'faq' => 'S�k Sorulan Sorular', //cpg1.3.0
  'toc' => '��eriklerin �izelgesi', //cpg1.3.0
  'question' => 'Sorular: ', //cpg1.3.0
  'answer' => 'Cevap: ', //cpg1.3.0
);

if (defined('FAQ_PHP')) $lang_faq_data = array(
  'General FAQ', //cpg1.3.0
  array('Neden kay�t olmaya ihtiya� var?', 'Kay�t admin taraf�ndan onaylanabilir veya onaylanmaz. Kay�t i�lemi �yeye ek olarak resim y�kleme �zelli�i verir, favori listesine sahip olurlar, resimlere oy verebilir ve onlara yorum yazabilirler ve benzeri.', 'allow_user_registration', '1'), //cpg1.3.0
  array('Nas�l kay�t olabilirim?', '&quot;Register&quot; a gidin ve istenilen bo�luklar� doldurun (e�er isterseniz).<br />E�er admin If the Administrator has Email Activation enabled ,then after submitting your information you should recieve an email message at the address that you have submitted while registering, giving you instructions on how to activate your membership. Your membership must be activated in order for you to login.', 'allow_user_registration', '1'), //cpg1.3.0
  array('How Do I login?', 'Go to &quot;Login&quot;, submit your username and password and check &quot;Remember Me&quot; so you will be logged in on the site if you should leave it.<br /><b>IMPORTANT:Cookies must be enabled and the cookie from this site must not be deleted in order to use &quot;Remember Me&quot;.</b>', 'offline', 0), //cpg1.3.0
  array('Why can I not login?', 'Did you register and click the link that was sent to you via email?. The link will activate your account. For other login problems contact the site administrator.', 'offline', 0), //cpg1.3.0
  array('What if I forgot my password?', 'If this site has a &quot;Forgot password&quot; link then use it. Other than that contact the site administrator for a new password.', 'offline', 0), //cpg1.3.0
  //array('What if I changed my email address?', 'Just simply login and change your email address through &quot;Profile&quot;', 'offline', 0), //cpg1.3.0
  array('How do I save a picture to &quot;My Favorites&quot;?', 'Click on a picture and click on the &quot;picture info&quot; link (<img src="images/info.gif" width="16" height="16" border="0" alt="Picture information" />); scroll down to the picture information set and click &quot;Add to fav&quot;.<br />The administrator may have the &quot;picture information&quot; on by default.<br />IMPORTANT:Cookies must be enabled and the cookie from this site must not be deleted.', 'offline', 0), //cpg1.3.0
  array('How do I rate a file?', 'Click on a thumbnail and go to the bottom and choose a rating.', 'offline', 0), //cpg1.3.0
  array('How do I post a comment for a picture?', 'Click on a thumbnail and go to the bottom and post a comment.', 'offline', 0), //cpg1.3.0
array('How do I upload a file?', 'Go to &quot;Upload&quot;and select the album that you want to upload to, click &quot;Browse&quot; and find the file to upload and click &quot;open&quot; (add a title and description if you want to) and click &quot;Submit&quot;', 'allow_private_albums', 0), //cpg1.3.0
  array('Where do I upload a picture to?', 'You will be able to upload a file to one of your albums in &quot;My Gallery&quot;. The Administrator may also allow you to upload a file to one or more of the albums in the Main Gallery.', 'allow_private_albums', 0), //cpg1.3.0
  array('What type and size of a file can I upload?', 'The size and type (jpg, png, etc.) is up to the administrator.', 'offline', 0), //cpg1.3.0
  array('What is &quot;My Gallery&quot;?', '&quot;My Gallery&quot; is a personal gallery that the user can upload to and manage.', 'allow_private_albums', 0), //cpg1.3.0
  array('How do I create, rename or delete an album in &quot;My Gallery&quot;?', 'You should already be in &quot;Admin-Mode&quot;<br />Go to &quot;Create/Order My Albums&quot;and click &quot;New&quot;. Change &quot;New Album&quot; to your desired name.<br />You can also rename any of the albums in your gallery.<br />Click &quot;Apply Modifications&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('How can I modify and restrict users from viewing my albums?', 'You should already be in &quot;Admin Mode&quot;<br />Go to &quot;Modify My Albums. On the &quot;Update Album&quot; bar, select the album that you want to modify.<br />Here, you can change the name, description, thumbnail picture, restrict viewing and comment/rating permissions.<br />Click &quot;Update Album&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('How can I view other users\' galleries?', 'Go to &quot;Album List&quot; and select &quot;User Galleries&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('What are cookies?', 'Cookies are a plain text piece of data that is sent from a website and is put on to your computer.<br />Cookies usually allow a user to leave and return to the site without having to login again and other various chores.', 'offline', 0), //cpg1.3.0
  array('Where can I get this program for my site?', 'Coppermine is a free Multimedia Gallery, released under GNU GPL. It is full of features and has been ported to various platforms. Visit the <a href="http://coppermine.sf.net/">Coppermine Home Page</a> to find out more or download it.', 'offline', 0), //cpg1.3.0

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
  'forgot_passwd' => '�ifremi unuttum', //cpg1.3.0
  'err_already_logged_in' => 'Daha �nceden giri� yapm��s�n�z !', //cpg1.3.0
  'enter_username_email' => 'Kullan�c� ad�n�z� veya email adresinizi yaz�n', //cpg1.3.0
  'submit' => 'git', //cpg1.3.0
  'failed_sending_email' => '�ifreniz yollanamad� !', //cpg1.3.0
  'email_sent' => 'Kullan�c� ad�n�z ve �ifrenize mail yoluyla %s a yolland�', //cpg1.3.0
  'err_unk_user' => 'Se�ilen kullan�c� bulunamad�!', //cpg1.3.0
  'passwd_reminder_subject' => '%s - �ifremi unuttum', //cpg1.3.0
  'passwd_reminder_body' => 'Giri� verilerinizi ��renmek istemi�siniz:
Kullan�c� ad�: %s
�ifre: %s
Giri� i�in %s i t�klay�n.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
  'group_name' => 'Grup Ad�',
  'disk_quota' => 'Disk boyutu',
  'can_rate' => 'Resim oran�', //cpg1.3.0
  'can_send_ecards' => 'Ekart yollama',
  'can_post_com' => 'Yorum yolama',
  'can_upload' => 'Resim y�kleme', //cpg1.3.0
  'can_have_gallery' => 'Ki�isel galeri sahibi olma',
  'apply' => 'De�i�iklikleri kaydet',
  'create_new_group' => 'Yeni grup ',
  'del_groups' => 'Se�ilen grup (-lar�) sil',
  'confirm_del' => 'Uyar�, ne zaman bir grubu silerseniz, o gruba ait olan kullan�c�lar \'Registered\' grubuna transfar edilecektir !\n\nDevam etma istiyor musunuz?', //js-alert //cpg1.3.0
  'title' => 'Kullan�c� gruplar�n� y�net',
  'approval_1' => 'herkese a��k y�klemeyi onayla (1)',
  'approval_2' => '�zel y�klemeyi onayla (2)',
  'upload_form_config' => 'Y�kleme formu bi�imleri', //cpg1.3.0
  'upload_form_config_values' => array( 'Sadece tek resim y�klemeler', 'Sadece �oklu y�klemeler ', 'Sadece URI y�klemeler', 'Sadece ZIP Y�klemeler', 'resim-URI', 'resim-ZIP', 'URI-ZIP', 'resim-URI-ZIP'), //cpg1.3.0
  'custom_user_upload'=>'Kullan�c� y�kleme kutusunun numaras�n� d�zenleyebilir mi?', //cpg1.3.0
  'num_file_upload'=>'Y�kleme kutular�n�n maksimum resim numaras�', //cpg1.3.0
  'num_URI_upload'=>'Y�kleme kutular�n�n maksimum URI numaras�', //cpg1.3.0
  'note1' => '<b>(1)</b> Herkese a��k alb�mdeki y�klemelere admin onay� gerekmektedir',
  'note2' => '<b>(2)</b> Bir alb�me y�kleme yapmak i�in kullan�c� admin onay� almal�d�r',
  'notes' => 'Notlar',
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
  'welcome' => 'Ho�geldiniz !',
);

$lang_album_admin_menu = array(
  'confirm_delete' => 'Bu alb�m� S�LMEK istedi�inizden emin misiniz ? \\nB�t�n resimler ve yorumlar silinmi� olacakt�r.', //js-alert //cpg1.3.0
  'delete' => 'S�L',
  'modify' => '�ZELL�KLER',
  'edit_pics' => 'RES�MLER� D�ZENLE', //cpg1.3.0
);

$lang_list_categories = array(
  'home' => 'Ana sayfa',
  'stat1' => '<b>[pictures]</b> daki resimler <b>[albums]</b> alb�mler ve <b>[cat]</b> kategoriler <b>[comments]</b> yorumlar g�sterildi <b>[views]</b> zaman', //cpg1.3.0
  'stat2' => '<b>[pictures]</b> daki resimler <b>[albums]</b> alb�mler g�sterildi <b>[views]</b> zaman', //cpg1.3.0
  'xx_s_gallery' => '%s\'s Geleri',
  'stat3' => '<b>[pictures]</b> daki resimler <b>[albums]</b> alb�mler <b>[comments]</b> yorumlar g�sterildi <b>[views]</b> zaman', //cpg1.3.0
);

$lang_list_users = array(
  'user_list' => 'Kullan�c� listesi',
  'no_user_gal' => 'Kullan�c� galerisi yok',
  'n_albums' => '%s alb�m(-ler)',
  'n_pics' => '%s resim(-ler)', //cpg1.3.0
);

$lang_list_albums = array(
  'n_pictures' => '%s resimler', //cpg1.3.0
  'last_added' => ', sonuncusu %s a eklendi',
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
  'login' => 'Giri�',
  'enter_login_pswd' => 'Giri� yapmak i�in kullan�c� ad�n�z� ve �ifrenizi yaz�n',
  'username' => 'Kullan�c� ad�',
  'password' => '�ifre',
  'remember_me' => 'Beni hat�rla',
  'welcome' => 'Ho�geldin %s ...',
  'err_login' => '*** Giri� yap�lamad�! L�tfen tekrar deneyin ***',
  'err_already_logged_in' => 'Daha �nceden giri� yapm��s�n�z !',
  'forgot_password_link' => '�ifremi unuttum', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
  'logout' => '��k��',
  'bye' => 'Bye bye %s ...',
  'err_not_loged_in' => 'Giri� yapmam��s�n�z !',
);

// ------------------------------------------------------------------------- //
// File phpinfo.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('PHPINFO_PHP')) $lang_phpinfo_php = array(
  'php_info' => 'PHP bilgi', //cpg1.3.0
  'explanation' => 'This is the output generated by the PHP-function <a href="http://www.php.net/phpinfo">phpinfo()</a>, displayed within Copermine (trimming the output at the right corner).', //cpg1.3.0
  'no_link' => 'Having others see your phpinfo can be a security risk, that\'s why this page is only visible when you\'re logged in as admin. You can not post a link to this page for others, they will be denied access.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
  'upd_alb_n' => 'G�ncellenen alb�m %s',
  'general_settings' => 'Genel ayarlar',
  'alb_title' => 'Alb�m ba�l���',
  'alb_cat' => 'Alb�m kategorisi',
  'alb_desc' => 'Alb�m a��klamas�',
  'alb_thumb' => 'Alb�m k���k resmi',
  'alb_perm' => 'Bu alb�m i�in izinler',
  'can_view' => 'Alb�m taraf�ndan g�r�nt�lenebilir',
  'can_upload' => 'Ziyaret�iler resim y�kleyebilirler',
  'can_post_comments' => 'Ziyaret�iler yorum ekleyebilirler',
  'can_rate' => 'Ziyaret�iler oy verebilirler',
  'user_gal' => 'Kullan�c� galerisi',
  'no_cat' => '* Kategori yok *',
  'alb_empty' => 'Alb�m bo�',
  'last_uploaded' => 'Son y�klenenler',
  'public_alb' => 'Herkes (Herkese a��k alb�m)',
  'me_only' => 'Sadece ben',
  'owner_only' => 'Sadece (%s) alb�m sahibi',
  'groupp_only' => ' \'%s\' grubunun �yeleri',
  'err_no_alb_to_modify' => 'Veritaban�nda alb�m d�zenleyemazsiniz.',
  'update' => 'Alb�m� g�ncelle', //cpg1.3.0
  'notice1' => '(*)  %sgroups%s ayarlar', //cpg1.3.0 (do not translate %s!)
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
  'already_rated' => '�zg�n�m ama bu resme daha �nceden oy verdiniz', //cpg1.3.0
  'rate_ok' => 'Oyunuz kabul edildi',
  'forbidden' => 'Kendi resminize oy veremezsiniz.', //cpg1.3.0
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
  'page_title' => 'Kullan�c� kay�d�',
  'term_cond' => 'Durumlar ve s�reler',
  'i_agree' => 'Kat�l�yorum',
  'submit' => 'Anla�may� Yolla',
  'err_user_exists' => 'Yazd���n�z kullan�c� ad� bulunamad�, l�tfen ba�ka birtane se�in',
  'err_password_mismatch' => '�ki �ifre birbirine uymuyor, l�tfen tekrar yaz�n',
  'err_uname_short' => 'Kullan�c� d� en az 2 karakterden fazla olmal�d�r',
  'err_password_short' => '�ifre en az 2 karakterden fazla olmal�d�r',
  'err_uname_pass_diff' => 'Kullan�c� ad� ve �ifre birbirinden farkl� olmal�d�r',
  'err_invalid_email' => 'Email adresi ge�ersiz',
  'err_duplicate_email' => 'Ba�ka bir kullan�c� yazd���n�z e mail adresini yazm��t�r',
  'enter_info' => 'Kay�t bilgilerini girin',
  'required_info' => 'Talep bilgileri',
  'optional_info' => '�ste�e ba�l� bilgi',
  'username' => 'Kullan�c� ad�',
  'password' => '�ifre',
  'password_again' => '�ifreyi tekrar yaz�n',
  'email' => 'Email',
  'location' => 'Nereden',
  'interests' => 'Hobiler',
  'website' => 'Web sitesi',
  'occupation' => 'Meslek',
  'error' => 'HATA',
  'confirm_email_subject' => '%s - Kay�t Do�rulama',
  'information' => 'Bilgi',
  'failed_sending_email' => 'Kay�t do�rulama maili yollanamad� !',
  'thank_you' => 'Kay�t oldu�unuz i�in te�ekk�rler.<br /><br />Email adresinize �yeli�inizi aktif etmeniz i�in bir mail g�nderildi.',
  'acct_created' => '�yeli�iniz olu�turuldu ve �imdi siteye girip kullan�c� ad�n�z ve �ifrenizle giri� yapabilirsiniz',
  'acct_active' => '�yeli�iniz �u an aktif ve kullan�c� ad�n�zla ve �ifrenizle giri� yapabilirsiniz',
  'acct_already_act' => '�yeli�iniz daha �nceden aktif edilmi� !',
  'acct_act_failed' => 'Bu �yelik aktif edilemez !',
  'err_unk_user' => 'Se�ilen kullan�c� bulunamad� !',
  'x_s_profile' => '%s\'s profil',
  'group' => 'Grup',
  'reg_date' => 'Kat�ld�',
  'disk_usage' => 'Kullan�lan disk',
  'change_pass' => '�ifre de�i�',
  'current_pass' => '�imdiki �ifre',
  'new_pass' => 'Yeni �ifre',
  'new_pass_again' => 'Yeni �ifre tekrar�',
  'err_curr_pass' => '�imdiki �ifreniz yanl��',
  'apply_modif' => 'De�i�iklikleri kaydet',
  'change_pass' => '�ifremi de�i�',
  'update_success' => 'Profiliniz g�ncellendi',
  'pass_chg_success' => '�ifreniz de�i�ti',
  'pass_chg_error' => '�ifreniz de�i�medi',
  'notify_admin_email_subject' => '%s - Kay�t Bildirisi', //cpg1.3.0
  'notify_admin_email_body' => 'Yeni bi kullan�c� "%s" galerinize kay�t oldu', //cpg1.3.0
);

$lang_register_confirm_email = <<<EOT
{SITE_NAME}e kay�t oldu�unuz i�in te�ekk�rler.

Kullan�c� ad�n�z : "{USER_NAME}"
�ifreniz : "{PASSWORD}"

�yeli�inizi aktif etmek i�in, a�a��daki linki t�klamal�s�n�z
ya da web browser�n�za copyalay�p yap��t�r�n.

{ACT_LINK}

Te�ekk�rler,

{SITE_NAME} y�netimi

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
  'title' => 'Yorumlar� inceleme',
  'no_comment' => '�nceleme i�in bir yorum bulunamad�',
  'n_comm_del' => '%s yorum(-lar) silindi',
  'n_comm_disp' => 'G�sterim i�in yorumlar�n numaras�',
  'see_prev' => 'Geriye bak',
  'see_next' => '�leriye bak',
  'del_comm' => 'Se�ilen yorumlar� sil',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
  0 => 'Resim kolleksiyonunu ara',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
  'page_title' => 'Yeni resimler ara', //cpg1.3.0
  'select_dir' => 'Klas�r se�',
  'select_dir_msg' => 'Bu fonksiyon size FTP ile sunucunuza resim grubu eklemenize izin verir.<br /><br />Resimlerinizi ekledi�iniz kls�r� se�in', //cpg1.3.0
  'no_pic_to_add' => 'Eklemek i�in resim bulunamad�', //cpg1.3.0
  'need_one_album' => 'Son olarak Bu fonksiyonu kullanabilmek i�in bir alb�me ihtiyac�n�z var',
  'warning' => 'Uyar�',
  'change_perm' => 'Script bu klas�r� yazamaz , modunu resimleri eklemeden �nce 755 e vaya 777 ye �evirmeniz gerekir !', //cpg1.3.0
  'target_album' => '<b>Resimlerini koy &quot;</b>%s<b>&quot; i�ine </b>%s', //cpg1.3.0
  'folder' => 'Klas�r',
  'image' => 'Dosya',
  'album' => 'Alb�m',
  'result' => 'Sonu�',
  'dir_ro' => 'Yaz�lamaz. ',
  'dir_cant_read' => 'Okunamaz. ',
  'insert' => 'Galeriye yeni resimler ekleme', //cpg1.3.0
  'list_new_pic' => 'Yeni resimlerin listesi', //cpg1.3.0
  'insert_selected' => 'Se�ilen resimleri ekle', //cpg1.3.0
  'no_pic_found' => 'Yeni resim bulunamad�', //cpg1.3.0
  'be_patient' => 'L�tfen sab�rl� olun, scriptin resimleri eklemek i�in zamana ihtiyac� var', //cpg1.3.0
  'no_album' => 'Alb�m se�ilmedi',  //cpg1.3.0
  'notes' =>  '<ul>'.
                          '<li><b>OK</b> : anlam� resim ba�ar�yla eklendi'.
                          '<li><b>DP</b> : anlam� resim ayn� ve daha �neceden veri taban�n i�inde'.
                          '<li><b>PB</b> : anlam� resim eklanamedi, bi�iminizi ve resimlerin nerede kloas�r izninine sahip oldu�unuzu konyrol ediniz'.
                          '<li><b>NA</b> : anlam� resime gidebilmek i�in bir alb�m se�mediniz, \' <a href="javascript:history.back(1)">geriye gidin</a>\' ve bir alb�m se�in. E�er alb�m�n�z yoksa<a href="albmgr.php">birtane olu�turun</a></li>'.
                          '<li>E�er TAMAM, DP, PB \'signs\' g�z�km�yorsa hata g�rmemek i�in resme t�klay�n'.
                          '<li>E�er browser�n�z timeout ise, tekrar y�kle butonunu t�klay�n�z'.
                          '</ul>', //cpg1.3.0
  'select_album' => 'alb�m se�', //cpg1.3.0
  'check_all' => 'T�m�n� kontrol et', //cpg1.3.0
  'uncheck_all' => 'T�m�n� kontrol etme', //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //

// Void

// ------------------------------------------------------------------------- //
// File banning.php
// ------------------------------------------------------------------------- //

if (defined('BANNING_PHP')) $lang_banning_php = array(
  'title' => 'Kullan�c�lar� banla',
  'user_name' => 'Kullan�c� Ad�',
  'ip_address' => 'IP Adresi',
  'expiry' => 'S�resi dolanlar (S�rekli ise bo� b�rak)',
  'edit_ban' => 'De�i�iklikleri kaydet',
  'delete_ban' => 'Sil',
  'add_new' => 'Yeni ban ekle',
  'add_ban' => 'Ekle',
  'error_user' => 'Kullan�c� bulunamad�', //cpg1.3.0
  'error_specify' => 'Kullan�c� ad�n� veya IP edresini a��k�a belirtin', //cpg1.3.0
  'error_ban_id' => 'Ge�ersiz ID!', //cpg1.3.0
  'error_admin_ban' => 'Kendini banlayamazs�n!', //cpg1.3.0
  'error_server_ban' => 'Sunucunu banlayacaks�n? Tsk tsk, Bunu yapamazs�n...', //cpg1.3.0
  'error_ip_forbidden' => 'Bu IP adresini banlayamazs�n - Dokunulmazl��� var!', //cpg1.3.0
  'lookup_ip' => 'IP adresi bak', //cpg1.3.0
  'submit' => 'git!', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
  'title' => 'Upload file', //cpg1.3.0
  'custom_title' => 'Talep Formu D�zenleme', //cpg1.3.0
  'cust_instr_1' => 'Y�kleme kutular�n�n numaras�n� se�ebilirisin. Bununla birlikte, A�a��da listelenen limitin �st�nde se�im yapamzs�n�z.', //cpg1.3.0
  'cust_instr_2' => 'Kutu numaras� talebi', //cpg1.3.0
  'cust_instr_3' => 'Resim y�kleme kutular�: %s', //cpg1.3.0
  'cust_instr_4' => 'URI/URL y�kleme kutulr�: %s', //cpg1.3.0
  'cust_instr_5' => 'URI/URL y�kleme kutular�:', //cpg1.3.0
  'cust_instr_6' => 'Resim y�kleme kutular�:', //cpg1.3.0
  'cust_instr_7' => 'L�tfen istedi�iniz y�kleme kutusunun numaras�n� girin.  sonra t�klay�n \'Continue\'. ', //cpg1.3.0
  'reg_instr_1' => 'Forum alu�umunda ge�ersiz durum.', //cpg1.3.0
  'reg_instr_2' => '�idi a�a��da kullan�lan y�kleme kutular�ndan resimlerinizi y�kleyebilirsiniz. Sunucuya y�kledi�iniz resimler boyutu a�mamal�d�r ve herbiri i�in %s KB olmal�d�r. ZIP resimleri \'File Upload\' e y�klendi ve  \'URI/URL Upload\' b�l�mleri s�k��m�� olarak kalacakt�r.', //cpg1.3.0
  'reg_instr_3' => 'E�er s�k��t�r�lm�� resimleri a�mak istiyorsan�z, \'Decompressive ZIP Upload\' daki y�kleme kutusunu kullanmal�s�n�z.', //cpg1.3.0
  'reg_instr_4' => 'URI/URL y�kleme se�eneklerini kulland���n�z zaman, l�tfen �rnekteki gibi: http://www.mysite.com/images/example.jpg yol verin', //cpg1.3.0
  'reg_instr_5' => 'Formu tamamlad���n�zda, l�tfen t�klay�n \'Continue\'.', //cpg1.3.0
  'reg_instr_6' => 'Zipli dosyalar� a�ma:', //cpg1.3.0
  'reg_instr_7' => 'Resim y�klemeleri:', //cpg1.3.0
  'reg_instr_8' => 'URI/URL Y�klemeleri:', //cpg1.3.0
  'error_report' => 'Hata raporu', //cpg1.3.0
  'error_instr' => 'Takip edilen y�kleme kar��la�t�rma hatalar�:', //cpg1.3.0
  'file_name_url' => 'Resim Ad�/URL', //cpg1.3.0
  'error_message' => 'Hata Mesaj�', //cpg1.3.0
  'no_post' => 'Resim y�klenemedi.', //cpg1.3.0
  'forb_ext' => 'Resim b�y�tmek yasakt�r.', //cpg1.3.0
  'exc_php_ini' => 'php.ini de izinverilen dasya boyutu a��ld�.', //cpg1.3.0
  'exc_file_size' => 'CPG taraf�ndan izin verilen dosya boyutu a��ld�.', //cpg1.3.0
  'partial_upload' => 'Sadece k�smi y�kleme.', //cpg1.3.0
  'no_upload' => 'Y�kleme yok.', //cpg1.3.0
  'unknown_code' => 'Bilinmeyen PHP y�kleme hata kodu.', //cpg1.3.0
  'no_temp_name' => 'Y�kleme yok - Temp ad� yok.', //cpg1.3.0
  'no_file_size' => '��erilen veri bulunamad�/Bozulmu�', //cpg1.3.0
  'impossible' => 'Hareket etmek imkans�z.', //cpg1.3.0
  'not_image' => '�maj notu/bozma', //cpg1.3.0
  'not_GD' => 'GD geni�letme de�il.', //cpg1.3.0
  'pixel_allowance' => 'Piksel izini a��ld�.', //cpg1.3.0
  'incorrect_prefix' => 'Yanl�� URI/URL ', //cpg1.3.0
  'could_not_open_URI' => 'URI a��lamad�.', //cpg1.3.0
  'unsafe_URI' => 'G�venlik kan�tlanamad�.', //cpg1.3.0
  'meta_data_failure' => 'Meta verisi ba�ar�s�z', //cpg1.3.0
  'http_401' => '401 Yetkisiz', //cpg1.3.0
  'http_402' => '402 �deme gerekli', //cpg1.3.0
  'http_403' => '403 Yasak', //cpg1.3.0
  'http_404' => '404 Bulunamad�', //cpg1.3.0
  'http_500' => '500 Sunucu hatas�', //cpg1.3.0
  'http_503' => '503 Servis bulunamad�', //cpg1.3.0
  'MIME_extraction_failure' => 'MIME belirtilemedi.', //cpg1.3.0
  'MIME_type_unknown' => 'Bilinmeyen MIME t�r�', //cpg1.3.0
  'cant_create_write' => 'Yaz� dosyas� olu�turulamad�.', //cpg1.3.0
  'not_writable' => 'Yaz� dosyas� yazamazs�n�z.', //cpg1.3.0
  'cant_read_URI' => 'URI/URL okunamaz', //cpg1.3.0
  'cant_open_write_file' => 'URI yazma dosyas� a��lamad�.', //cpg1.3.0
  'cant_write_write_file' => 'URI yazma dosyas�na yazamazs�n�z.', //cpg1.3.0
  'cant_unzip' => 'Uzip yapamazs�n�z.', //cpg1.3.0
  'unknown' => 'Bilinmeyen hata', //cpg1.3.0
  'succ' => 'Ba�ar�l� Y�klemeler', //cpg1.3.0
  'success' => '%s y�klemesi ba�ar�l�.', //cpg1.3.0
  'add' => 'L�tfen alb�me resim eklemek i�in t�klay�n \'Continue\' .', //cpg1.3.0
  'failure' => 'Y�kleme ba�ar�s�z', //cpg1.3.0
  'f_info' => 'Resim bilgisi', //cpg1.3.0
  'no_place' => '�nceki resim yerle�tirilemedi.', //cpg1.3.0
  'yes_place' => '�nceki resim ba�ar�yla yerle�tirildi.', //cpg1.3.0
  'max_fsize' => 'Maksimum resim boyutu %s KB',
  'album' => 'Alb�m',
  'picture' => 'Resim', //cpg1.3.0
  'pic_title' => 'Resim ba�l���', //cpg1.3.0
  'description' => 'Resim a��klamas�', //cpg1.3.0
  'keywords' => 'Anahtar kelimeler (aralar�na boluk b�rak�n�z)',
  'err_no_alb_uploadables' => '�zg�n�m Yapt���n�z y�klemelerde alb�m bulunamad�', //cpg1.3.0
  'place_instr_1' => 'L�tfen resimleri yerle�tirin.  Her resim i�in gerekli bilgiyi girin.', //cpg1.3.0
  'place_instr_2' => 'Daha fazla resim alana ihtiya� duyar. L�tfen t�klay�n \'Continue\'.', //cpg1.3.0
  'process_complete' => 'Ba�ar�yla b�t�n resimleri yerle�tirdiniz.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
  'title' => 'Kullan�c�lar� y�net',
  'name_a' => 'Ada g�re artan',
  'name_d' => 'Ada g�re azalan',
  'group_a' => 'Gruba g�re artan',
  'group_d' => 'Gruba g�re azalan',
  'reg_a' => 'Rege g�re artan',
  'reg_d' => 'Rege g�re azalan',
  'pic_a' => 'Resim i�eri�ine g�re artan',
  'pic_d' => 'Resim i�eri�ine g�re azalan',
  'disku_a' => 'Disk kullan�m�na g�reartan',
  'disku_d' => 'Disk kullan�m�na g�re azalan',
  'lv_a' => 'Son ziyarete g�re artan', //cpg1.3.0
  'lv_d' => 'Son ziyarete g�reazalan', //cpg1.3.0
  'sort_by' => 'kullan�c�lar� s�rala',
  'err_no_users' => 'Kullan�c� �izelgesi bo� !',
  'err_edit_self' => 'Kendi profilinizi d�zeltemezsiniz,  \'My profile\' linkini kullan�n',
  'edit' => 'D�ZELT',
  'delete' => 'S�L',
  'name' => 'Kullan�c� ad�',
  'group' => 'Grup',
  'inactive' => 'Inaktif',
  'operations' => '��lemler',
  'pictures' => 'Resimler', //cpg1.3.0
  'disk_space' => 'Alan kulan�ld� / kontenjan',
  'registered_on' => 'Kay�t ol',
  'last_visit' => 'Son ziyaret edilen', //cpg1.3.0
  'u_user_on_p_pages' => '%d kullan�c�lar %d sayfa(-lar)da',
  'confirm_del' => 'Bu kullan�c�y� silmek istedi�inizden emin misiniz? \\nOnun b�y�nresimleri ve alb�mleri silinecek.', //js-alert //cpg1.3.0
  'mail' => 'MA�L',
  'err_unknown_user' => 'Se�ilen kullan�c� bulunamad� !',
  'modify_user' => 'Kullan�c�y� d�zenle',
  'notes' => 'Notlar',
  'note_list' => '<li>�imdiki �ifreni de�i�tirmek istemiyorsan, "�ifre" alan�n� bo� b�rak�n�z',
  'password' => '�ifre',
  'user_active' => 'Kullan�c� Aktif',
  'user_group' => 'Kullan�c� grubu',
  'user_email' => 'Kullan�c� emaili',
  'user_web_site' => 'Kullan�c� web sitesi',
  'create_new_user' => 'Yeni kullan�c� olu�tur',
  'user_location' => 'Kullan�c� yeri',
  'user_interests' => 'Kullan�c� hobileri',
  'user_occupation' => 'Kullan�c� mesle�i',
  'latest_upload' => 'Yak�nlardaki y�klemeler', //cpg1.3.0
  'never' => 'asla', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
  'title' => 'Admin ��levleri (Resimleri yeniden boyutland�r)', //cpg1.3.0
  'what_it_does' => 'Ne yapar',
  'what_update_titles' => 'Resim ad�ndan g�ncelleme ba�l�klar�',
  'what_delete_title' => 'Ba�l�klar� siler',
  'what_rebuild' => 'K���k resimleri ve yeniden boyutlanm�� foto�raflar� yeniden olu�turur',
  'what_delete_originals' => 'Yeniden boyutlanma versiyonu ile foto�raflar� orjinal boyutlar�n� siler',
  'file' => 'Resim',
  'title_set_to' => 'ayarlama i�in ba�l�k',
  'submit_form' => 'g�nder',
  'updated_succesfully' => 'G�ncelleme ba�ar�l�',
  'error_create' => 'Olu�turmada HATA',
  'continue' => 'daha fazla g�r�nt�',
  'main_success' => 'Resim %s ana dosyada kullan�l�yor', //cpg1.3.0
  'error_rename' => ' %s  %s ye yeni adland�rmada hata ',
  'error_not_found' => 'Resim %s bulunamad�',
  'back' => 'ana sayfaya d�n',
  'thumbs_wait' => 'K���k resimler ve/veya yeniden boyutlanan resimler G�ncelleniyor, l�tfen bekliyor...',
  'thumbs_continue_wait' => 'K���k resimleri ve/veya yeniden boyutlanan resimleri g�celleme devam ediyor...',
  'titles_wait' => 'Ba�l�klar g�ncelleniyor, L�tfen bekleyin...',
  'delete_wait' => 'Ba�l�lar siliniyor, l�tfen bekleiyin...',
  'replace_wait' => 'Orjinal resimler yeniden boyutlanana resimler ile orjinal halde siliniyor, l�tfen bekleyin..',
  'instruction' => 'H�zl� talimat',
  'instruction_action' => '��lem se�',
  'instruction_parameter' => 'Parametreleri ayarla',
  'instruction_album' => 'Alb�m se�',
  'instruction_press' => 'Bas %s',
  'update' => 'K���k resimleri ve/veya yeniden boyutland�r�lan resimler g�ncelleniyor',
  'update_what' => 'Ne g�ncellenmeli',
  'update_thumb' => 'Sadece k���k resimler',
  'update_pic' => 'Sadece yeniden boyutland�r�lan resimler',
  'update_both' => 'K���k resimler ve yeniden boyutland�r�lan reimler',
  'update_number' => 'Resimleri t�lama s�recini numaraland�r',
  'update_option' => '(Bu tecihi azaltma ayarlar�n� deneyin e�er timeout problemlerinde tecr�beliysen)',
  'filename_title' => 'Resim ad� &rArr; Resim ba�l���', //cpg1.3.0
  'filename_how' => 'Resim ad� nas�l d�zenlenmeli',
  'filename_remove' => ' .jpg sonland�rmas�ndan ayr�l ve bo�lulklarla yerine _ (alt tire) ekle ',
  'filename_euro' => '2003_11_23_13_20_20.jpg �i  23/11/2003 13:20 �e �evir',
  'filename_us' => '2003_11_23_13_20_20.jpg �i  23/11/2003 13:20 �e �evir',
  'filename_time' => '2003_11_23_13_20_20.jpg �i  13:20 e �evir',
  'delete' => 'Resim adlar�n� yada orjinal for�raf boyutlar�n� sil', //cpg1.3.0
  'delete_title' => 'Resim ba�l�klar�n� sil', //cpg1.3.0
  'delete_original' => 'Orjinal foro�raf boyutlar�n� sil',
  'delete_replace' => 'Yeniden boyutlanma versiyonu ile foto�raflar� orjinal boyutlar�n� siler',
  'select_album' => 'Alb�m se�',
  'delete_orphans' => 'Yorumlar� sil (b�t�n alb�mlerin �zerinde �al���r)', //cpg1.3.0
  'orphan_comment' => 'Yorumlar bulundu', //cpg1.3.0
  'delete' => 'Sil', //cpg1.3.0
  'delete_all' => 'T�m�n� sil', //cpg1.3.0
  'comment' => 'Yorum: ', //cpg1.3.0
  'nonexist' => 'attached to non existant file # ', //cpg1.3.0
  'phpinfo' => 'phpinfo g�sterimi', //cpg1.3.0
  'update_db' => 'Veritaban�n� g�ncelle', //cpg1.3.0
  'update_db_explanation' => 'E�er coppermine resimlerini tekrar yerle�tirmek istiyorsan, de�i�iklik eklendi yada copperminenin �nceki versiyonundan y�klendi�ini, veritaban�n g�ncellendi�inden emin ol. Bu gerekli �izelgeleri ve/veya se�enekleri coppermine veri taban�nda de�erlendirir.', //cpg1.3.0
);

?>
