<?php
// ------------------------------------------------------------------------- //
//  Coppermine Photo Gallery                                                 //
// ------------------------------------------------------------------------- //
//  Copyright (C) 2002,2003  Grégory DEMAR <gdemar@wanadoo.fr>               //
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

// info about translators and translated language 
$lang_translation_info = array( 
'lang_name_english' => 'Croatian',  //the name of your language in English, e.g. 'Greek' or 'Spanish' 
'lang_name_native' => 'Hrvatski', //the name of your language in your mother tongue
'lang_country_code' => 'hr', //the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es' 
'trans_name'=> 'Webfrater', //the name of the translator - can be a nickname 
'trans_email' => 'veritas@veritas.com.hr', //translator's email address (optional) 
'trans_website' => 'http://www.veritas.com.hr/', //translator's website (optional) 
'trans_date' => '2003-10-12', //the date the translation was created / last modified 
); 

$lang_charset = 'iso-8859-2';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('ned', 'pon', 'uto', 'sri', 'èet', 'pet', 'sub');
$lang_month = array('sij', 'velj', 'oµu', 'tra', 'svi', 'lip', 'srp', 'kol', 'ruj', 'lis', 'stu', 'pro');

// Some common strings
$lang_yes = 'Da';
$lang_no  = 'Ne';
$lang_back = 'NATRAG';
$lang_continue = 'NAPRIJED';
$lang_info = 'Informacija';
$lang_error = 'Pogreška';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%B %d, %Y';
$lastcom_date_fmt =  '%d/%m/%y at %H:%M';
$lastup_date_fmt = '%B %d, %Y';
$register_date_fmt = '%B %d, %Y';
$lasthit_date_fmt = '%B %d, %Y at %I:%M %p';
$comment_date_fmt =  '%B %d, %Y at %I:%M %p';

// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array( 
        'random' => 'Sluèajno odabrana slika', 
        'lastup' => 'Posljednje dodano', 
        'lastalb'=> 'Posljednji obnovljeni album', 
        'lastcom' => 'Posljednji komentari', 
        'topn' => 'Najgledanije', 
        'toprated' => 'Najbolje ocijenjeno', 
        'lasthits' => 'Posljednje pogledano', 
        'search' => 'Rezultati pretraživanja', 
        'favpics'=> 'Omiljene slike', 
);

$lang_errors = array(
	'access_denied' => 'Ne možete pristupiti ovoj stranici.',
	'perm_denied' => 'Nemate dopuštenje izvršiti tu operaciju.',
	'param_missing' => 'Skripta je pozvana bez obveznih parametara.',
	'non_exist_ap' => 'Izabrani album/slika više ne postoji !',
	'quota_exceeded' => 'Disk kvota prekoraèena<br /><br />Imate dozvoljenu kvotu od [quota]K, vaše slike zauzimaju [space]K, dodavanjem ove slike prelazite dozvoljenu kvotu.',
	'gd_file_type_err' => 'Ukoliko kotristite GD, dopušteni formati slika su samo JPG i PNG.',
	'invalid_image' => 'Slika koju ste uploadali nije u redu, ili se ne može obraditi u GD-u',
	'resize_failed' => 'Nije moguæe napraviti manju slièicu.',
	'no_img_to_display' => 'Nema slike za prikaz',
	'non_exist_cat' => 'Izabrana kategorija ne postoji',
	'orphan_cat' => 'Kategorija ne postoji, pokrenite organizator kategorija da bi riješili problem.',
	'directory_ro' => 'Direktoriju \'%s\' nije dodjeljen writable status, slike se ne mogu izbrisati',
	'non_exist_comment' => 'Odabrani komentar ne postoji.',
	'pic_in_invalid_album' => 'Slika je u nepostojeæem albumu (%s)!?',
        'banned' => 'Vama je zabranjeno koristiti ovaj site.', 
        'not_with_udb' => 'Ova funkcija nije omoguæena u galeriji Coppermine jer se nalazi integrirana u software za forum. To što pokušavate napraviti nije podržano u ovoj konfiguraciji, ili se može jedino napraviti koristeæi software za forum.', 
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => 'Idi na popis albuma',
	'alb_list_lnk' => 'Popis albuma',
	'my_gal_title' => 'Idi na moju osobnu galeriju',
	'my_gal_lnk' => 'Moja galerija',
	'my_prof_lnk' => 'Moj profil',
	'adm_mode_title' => 'Prebaci na admin mod',
	'adm_mode_lnk' => 'Admin mod',
	'usr_mode_title' => 'Prebaci na korisnièki mod',
	'usr_mode_lnk' => 'Korisnièki mod',
	'upload_pic_title' => 'Uploadaj sliku u album',
	'upload_pic_lnk' => 'Upload sliku',
	'register_title' => 'Kreiraj account',
	'register_lnk' => 'Registracija',
	'login_lnk' => 'Ulaz',
	'logout_lnk' => 'Izlaz',
	'lastup_lnk' => 'Posljednje dodano',
	'lastcom_lnk' => 'Posljednji komentari',
	'topn_lnk' => 'Najgledanije',
	'toprated_lnk' => 'Visoko rangirano',
	'search_lnk' => 'Pretraživanje',
        'fav_lnk' => 'Moje omiljene slike', 
);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => 'Dopuštenje uploada',
	'config_lnk' => 'Konfiguracija',
	'albums_lnk' => 'Albumi',
	'categories_lnk' => 'Kategorije',
	'users_lnk' => 'Korisnici',
	'groups_lnk' => 'Grupe',
	'comments_lnk' => 'Komentari',
	'searchnew_lnk' => 'Prebacivanje',
        'util_lnk' => 'Promijeni velièinu slike', 
        'ban_lnk' => 'Zabrani pristup korisnicima', 
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => 'Kreiraj / poredaj moje albume',
	'modifyalb_lnk' => 'Prepravi moje albume',
	'my_prof_lnk' => 'Moj profil',
);

$lang_cat_list = array(
	'category' => 'Kategorija',
	'albums' => 'Albumi',
	'pictures' => 'Slike',
);

$lang_album_list = array(
	'album_on_page' => '%d albuma na %d stranici'
);

$lang_thumb_view = array(
	'date' => 'DATUM',
        //Sort by filename and title 
        'name' => 'NAZIV DOKUMENTA', 
        'title' => 'NASLOV', 
	'sort_da' => 'Poredaj po datumu novije',
	'sort_dd' => 'Poredaj po datumu starije',
	'sort_na' => 'Poredaj po nazivu novije',
	'sort_nd' => 'Poredaj po nazivu starije',
        'sort_ta' => 'Razvrstaj prema nazivu poèevši od poèetka', 
        'sort_td' => 'Razvrstaj prema nazivu poèevši od kraja', 
	'pic_on_page' => '%d slika na %d stranici',
	'user_on_page' => '%d korisnika na %d stranici'
);

$lang_img_nav_bar = array(
	'thumb_title' => 'Povratak na slièice',
	'pic_info_title' => 'Pokaži/sakrij info o fotografiji',
	'slideshow_title' => 'Slideshow',
	'ecard_title' => 'Pošaljite ovu sliku kao razglednicu',
	'ecard_disabled' => 'Razglednica je iskljuèena',
	'ecard_disabled_msg' => 'Ne možete poslati razglednicu',
	'prev_title' => 'Pogledajte prethodnu sliku',
	'next_title' => 'Pogledajte slijedeæu sliku',
	'pic_pos' => 'SLIKA %s/%s',
);

$lang_rate_pic = array(
	'rate_this_pic' => 'Ocijenite ovu fotografiju ',
	'no_votes' => '(Još nema ocjena)',
	'rating' => '(trenute ocjene : %s / 5 sa %s glasova)',
	'rubbish' => 'Jako loše',
	'poor' => 'Slabo',
	'fair' => 'Prosjeèno',
	'good' => 'Dobro',
	'excellent' => 'Odlièno',
	'great' => 'Prekrasno',
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
	CRITICAL_ERROR => 'Kritièna pogreška',
	'file' => 'Datoteka: ',
	'line' => 'Linija: ',
);

$lang_display_thumbnails = array(
	'filename' => 'Naziv datoteke : ',
	'filesize' => 'Velièina : ',
	'dimensions' => 'Dimenzije : ',
	'date_added' => 'Dodano : '
);

$lang_get_pic_data = array(
	'n_comments' => '%s komentara',
	'n_views' => '%s pregleda',
	'n_votes' => '(%s glasova)'
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
	'Exclamation' => 'Uzvik',
	'Question' => 'Pitanje',
	'Very Happy' => 'Jako sretan',
	'Smile' => 'Osmjeh',
	'Sad' => 'Tužan',
	'Surprised' => 'Iznenaðen',
	'Shocked' => 'Šokiran',
	'Confused' => 'Zbunjen',
	'Cool' => 'Cool',
	'Laughing' => 'Smijeh',
	'Mad' => 'Bijesan',
	'Razz' => 'Važan',
	'Embarassed' => 'Postiðen',
	'Crying or Very sad' => 'Jako tužan',
	'Evil or Very Mad' => 'Zao',
	'Twisted Evil' => 'Izopaèen',
	'Rolling Eyes' => 'Kotrljajuæe oèi',
	'Wink' => 'Mig',
	'Idea' => 'Ideja',
	'Arrow' => 'Strjelica',
	'Neutral' => 'Neutralan',
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
	0 => 'Napuštanje administratorskog moda...',
	1 => 'Ulaz u administratorski mod...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => 'Morate upisati ime albuma !',
	'confirm_modifs' => 'Da li ste sigurni da želite napraviti izmjene ?',
	'no_change' => 'Niste napravili nikakvu promjenu !',
	'new_album' => 'Novi album',
	'confirm_delete1' => 'Da li ste sigurni da želite izbrisati ovaj album ?',
	'confirm_delete2' => '\nSve slike i komentari koji su tu biti æe izbrisani !',
	'select_first' => 'Prvo izaberite album',
	'alb_mrg' => 'Organizacija albuma',
	'my_gallery' => '* Moja galerija *',
	'no_category' => '* Nema kategorija *',
	'delete' => 'Izbriši',
	'new' => 'Novo',
	'apply_modifs' => 'Napravi promjene',
	'select_category' => 'Izaberi kategoriju',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => 'Parametri obavezni za \'%s\'naredba nije izvr±ena !',
	'unknown_cat' => 'Izabrana kategorija ne postoji u bazi podataka',
	'usergal_cat_ro' => 'Korisnièka kategorija se ne može brisati !',
	'manage_cat' => 'Organiziraj kategorije',
	'confirm_delete' => 'Da li ste sigurni da želite IZBRISATI ovu kategoriju',
	'category' => 'Kategorija',
	'operations' => 'Naredbe',
	'move_into' => 'Prebaci u',
	'update_create' => 'Osvježi/Napravi kategoriju',
	'parent_cat' => 'Osnovna kategorija',
	'cat_title' => 'Naziv kategorije',
	'cat_desc' => 'Opis kategorije'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => 'Konfiguracija',
	'restore_cfg' => 'Vrati na osnovnu konfiguraciju',
	'save_cfg' => 'Snimi novu konfiguraciju',
	'notes' => 'Napomena',
	'info' => 'Informacija',
	'upd_success' => 'Konfiguracija je osvježena',
	'restore_success' => 'Osnova konfiguracija je vraæena',
	'name_a' => 'Naziv novije',
	'name_d' => 'Naziv starije',
        'title_a' => 'Naslov razvrstan ascending', 
        'title_d' => 'Naslov razvrstan descending', 
	'date_a' => 'Datum novije',
	'date_d' => 'Datum starije',
        'th_any' => 'Max Aspect',
        'th_ht' => 'Height',
        'th_wd' => 'Width',
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'Osnovno podešavanje',
	array('Naziv galerije', 'gallery_name', 0),
	array('Opis galerije', 'gallery_description', 0),
	array('E-Mail administratora galerije', 'gallery_admin_email', 0),
	array('Krajnja adresa za \'See more pictures\' link u razglednicama', 'ecards_more_pic_target', 0),
	array('Jezik', 'lang', 5),
	array('Predložak', 'theme', 6),

	'Album list view',
	array('Širina glavne tablice (pikseli ili %)', 'main_table_width', 0),
	array('Broj nivoa kategorija za prikaz', 'subcat_level', 0),
	array('Broj albuma za prikaz', 'albums_per_page', 0),
	array('Broj stupaca za listu albuma', 'album_list_cols', 0),
	array('Velièina slièice u pikselima', 'alb_list_thumb_size', 0),
	array('Sadržaj naslovne stranice', 'main_page_layout', 0),
        array('Show first level album thumbnails in categories','first_level',1),  //new in cpg1.2.0

	'Thumbnail view',
	array('Broj stupaca na stranici sa slièicama', 'thumbcols', 0),
	array('Broj redova na stranici sa slièicama', 'thumbrows', 0),
	array('Maximum number of tabs to display', 'max_tabs', 0),
	array('Display picture caption (in addition to title) below the thumbnail', 'caption_in_thumbview', 1),
	array('Pokaži broj komentara ispod slièice', 'display_comment_count', 1),
	array('Default sort order for pictures', 'default_sort_order', 3),
	array('Minimum number of votes for a picture to appear in the \'top-rated\' list', 'min_votes_for_rating', 0),

	'Image view &amp; Comment settings',
	array('Širina tablice za prikaz slike (pixels or %)', 'picture_table_width', 0),
	array('Informacije o slici se vide po dafaultu', 'display_pic_info', 1),
	array('Izbaci ružne rijeèi u komentarima', 'filter_bad_words', 1),
	array('Omoguæi smješke u komentarima', 'enable_smilies', 1),
	array('Max dužina za opis slike', 'max_img_desc_length', 0),
	array('Max broj znakova u rijeèi', 'max_com_wlength', 0),
	array('Max broj linija u komentaru', 'max_com_lines', 0),
	array('Max dužina komentara', 'max_com_size', 0),
        array('Pokaži film strip', 'display_film_strip', 1), 
        array('Broj slièica u film stripu', 'max_film_strip_items', 0), 

	'Pictures and thumbnails settings',
	array('Kvalitet za JPEG slike', 'jpeg_qual', 0),
        array('Max dimenzija slièice <b>*</b>', 'thumb_width', 0), 
        array('Korištena velièina ( width or height or Max aspect for thumbnail )<b>*</b>', 'thumb_use', 7), 
	array('Napravi srednje-velike slike','make_intermediate',1),
	array('Max širina ili visina srednje-velike slike <b>*</b>', 'picture_width', 0),
	array('Max velièina za uploadane slike (KB)', 'max_upl_size', 0),
	array('Max širina ili visina za uploadane slike (pixels)', 'max_upl_width_height', 0),

	'User settings',
	array('Želite li dopustiti registraciju novih korisnika', 'allow_user_registration', 1),
	array('Za registraciju novih korisnika potrebna je e-mail potvrda', 'reg_requires_valid_email', 1),
	array('Želite li dopustiti da dva korisnika imaju istu email adresu', 'allow_duplicate_emails_addr', 1),
	array('Mogu li korisnici imati osobne albume', 'allow_private_albums', 1),

	'Custom fields for image description (leave blank if unused)',
	array('Field 1 name', 'user_field1_name', 0),
	array('Field 2 name', 'user_field2_name', 0),
	array('Field 3 name', 'user_field3_name', 0),
	array('Field 4 name', 'user_field4_name', 0),

	'Pictures and thumbnails advanced settings',
        array('Pokaži ikonu osobnih albuma nelogiranom korisniku','show_private',1), 
	array('Znakovi zabranjeni u imenima dokumenata', 'forbiden_fname_char',0),
	array('Dopušteni doèeci dokumenata za upload slike', 'allowed_file_extensions',0),
	array('Metoda za mijenjanje velièine slike','thumb_method',2),
	array('Put do ImageMagick \'convert\' programa (example /usr/bin/X11/)', 'impath', 0),
	array('Dopuštene vrste slika (vrijedi samo za ImageMagick)', 'allowed_img_types',0),
	array('Opcije komandne linije za ImageMagick', 'im_options', 0),
	array('Proèitaj EXIF podatke u JPEG dokumentima', 'read_exif_data', 1),
	array('Album direktorij <b>*</b>', 'fullpath', 0),
	array('Direktorij za korisnièke slike <b>*</b>', 'userpics', 0),
	array('Prefix za srednje-velike slike <b>*</b>', 'normal_pfx', 0),
	array('Prefix za slièice <b>*</b>', 'thumb_pfx', 0),
	array('Default mode za direktorije', 'default_dir_mode', 0),
	array('Default mode za slike', 'default_file_mode', 0),

	'Cookies &amp; Charset settings',
	array('Naziv cookie-ja korištenog u skripti', 'cookie_name', 0),
	array('Put cookie-ja korištenog u skripti', 'cookie_path', 0),
	array('Character encoding', 'charset', 4),

	'Miscellaneous settings',
	array('Enable debug mode', 'debug_mode', 1),

	'<br /><div align="center">(*) Fields marked with * must not be changed if you already have pictures in your gallery</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => 'Trebate upisati svoje ime i komentar',
	'com_added' => 'Vaš komentar je dodan',
	'alb_need_title' => 'Morate upisati naziv za album !',
	'no_udp_needed' => 'Nije potrebno osvježavanje.',
	'alb_updated' => 'Album je osvježen',
	'unknown_album' => 'Izabrani album ne postoji ili nemate dopuštenje za upload u ovaj album',
	'no_pic_uploaded' => 'Slika nije dodana !<br /><br />Ako ste zaista izabrali sliku za upload, onda je došlo do greške...',
	'err_mkdir' => 'Nije moguæe napraviti direktorij %s !',
	'dest_dir_ro' => 'Odabrani direktorij nije writable po skripti !',
	'err_move' => 'Ne može se prebaciti %s u %s !',
	'err_fsize_too_large' => 'Dimenzije slike koju uploadate je prevelika (maksimalno dozvoljeno je %s x %s) !',
	'err_imgsize_too_large' => 'Velièina koju uploadate je prevelika (maksimalno dozvoljeno je %s KB) !',
	'err_invalid_img' => 'Datoteka koju uploadate nije  u dopu±tenom formatu slike !',
	'allowed_img_types' => 'Možete uploadati samo %s slika.',
	'err_insert_pic' => 'Slika \'%s\' (ne)može biti dodana u album ',
	'upload_success' => 'Vaša slika je uploadana uspješno<br /><br />Slika æe biti vidljiva nakon administratovog dopuštenja.',
	'info' => 'Informacija',
	'com_added' => 'Komentar dodan',
	'alb_updated' => 'Album osvježen',
	'err_comment_empty' => 'Prostor za komentar je prazan !',
	'err_invalid_fext' => 'Samo datoteke sa slijedeæim ekstenzijama su prihvatljive : <br /><br />%s.',
	'no_flood' => 'Žao nam je, vi ste veæ autor posljednjeg komentara upisanog za ovu sliku<br /><br />Izmijenite komentar koji ste poslali ako želite promijeniti komentar o slici',
	'redirect_msg' => 'Biti æete prebaèeni.<br /><br /><br />Klinki \'CONTINUE\' ako se stranica ne osvježi automatski',
	'upl_success' => 'Slika uspješno dodana',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => 'Naziv',
	'fs_pic' => 'Puna velièina slike',
	'del_success' => 'Uspješno',
	'ns_pic' => 'Normalna velièina slike',
	'err_del' => 'Ne može biti izbrisano',
	'thumb_pic' => 'Slièica',
	'comment' => 'Komentar',
	'im_in_alb' => 'Slika u albumu',
	'alb_del_success' => 'Album \'%s\' izbrisan',
	'alb_mgr' => 'Organizator albuma',
	'err_invalid_data' => 'Netoèni podaci primljeni u \'%s\'',
	'create_alb' => 'Kreiranje albuma \'%s\'',
	'update_alb' => 'Osvježavanje albuma \'%s\' sa malo \'%s\' i index \'%s\'',
	'del_pic' => 'Izbriši sliku',
	'del_alb' => 'Izbriši album',
	'del_user' => 'Izbriši korisnika',
	'err_unknown_user' => 'Izabrani korisnik ne postoji !',
	'comment_deleted' => 'Komentar uspješno izbrisan',
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
	'confirm_del' => 'Da li sigurno želite IZBRISATI ovu sliku ? \\nKomentari æe takoðer biti izbrisani.',
	'del_pic' => 'IZBRIŠI OVU SLIKU',
	'size' => '%s x %s pixela',
	'views' => '%s puta',
	'slideshow' => 'Slideshow',
	'stop_slideshow' => 'ZAUSTAVI SLIDESHOW',
	'view_fs' => 'Kliknite da vidite u punoj velièini',
);

$lang_picinfo = array(
	'title' =>'Informacije o slici',
	'Filename' => 'Ime datoteke',
	'Album name' => 'Ime albuma',
	'Rating' => 'Ocjena (%s glasova)',
	'Keywords' => 'Kljuène rijeèi',
	'File Size' => 'Velièina datoteke',
	'Dimensions' => 'Dimenzije',
	'Displayed' => 'Prikazano',
	'Camera' => 'Kamera',
	'Date taken' => 'Datum snimanja',
	'Aperture' => 'Otvor',
	'Exposure time' => 'Vrijeme izlaganja',
	'Focal length' => 'Udaljenost od centra',
        'Comment' => 'Komentar', 
        'addFav'=>'Dodaj u omiljene slike', 
        'addFavPhrase'=>'Omiljene slike', 
        'remFav'=>'Odstrani iz omiljenih slika', 
);

$lang_display_comments = array(
	'OK' => 'OK',
	'edit_title' => 'Izmijeni ovaj komentar',
	'confirm_delete' => 'Jeste li sigurni da želite izbrisati ovaj komentar ?',
	'add_your_comment' => 'Dodajte svoj komentar',
        'name'=>'Ime', 
        'comment'=>'Komentar', 
        'your_name' => 'Vaše ime', 
);

$lang_fullsize_popup = array( 
        'click_to_close' => 'Kliknite sliku kako biste zatvorili prozor', 
); 

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => 'Pošaljite ovu e-razglednicu',
	'invalid_email' => '<b>Ops</b> : Neispravna email adresa !',
	'ecard_title' => 'Razglednica od %s za Vas',
	'view_ecard' => 'Ako razglednica nije prikazana ispravno, kliknite na ovaj link',
	'view_more_pics' => 'Kliknite na ovaj link da vidite vi±e slika !',
	'send_success' => 'Vaša razglednica je poslana',
	'send_failed' => 'Žao nam je, ali server ne može poslati vašu razglednicu...',
	'from' => 'Od',
	'your_name' => 'Vaše ime',
	'your_email' => 'Vaša email adresa',
	'to' => 'Za',
	'rcpt_name' => 'Ime primatelja',
	'rcpt_email' => 'Email adresa primatelja',
	'greetings' => 'Naslov',
	'message' => 'Poruka',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => 'Slika&nbsp;info',
	'album' => 'Album',
	'title' => 'Naslov',
	'desc' => 'Opis',
	'keywords' => 'Kljuène rijeèi',
	'pic_info_str' => '%sx%s - %sKB - %s pregleda - %s glasova',
	'approve' => 'Odobrite sliku',
	'postpone_app' => 'Odgodi odobrenje',
	'del_pic' => 'Izbrišite sliku',
	'reset_view_count' => 'Osvježite brojaè pregleda',
	'reset_votes' => 'Osvježite glasove',
	'del_comm' => 'Izbrišite komentare',
	'upl_approval' => 'Odobrite upload',
	'edit_pics' => 'Prepravite slike',
	'see_next' => 'Pogledajte slijedeæe slike',
	'see_prev' => 'Pogledajte prethodne slike',
	'n_pic' => '%s slike',
	'n_of_pic_to_disp' => 'Broj slika za prikazivanje',
	'apply' => 'Napravite promjene'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => 'Naziv grupe',
	'disk_quota' => 'Kvota diska',
	'can_rate' => 'Može ocijeniti sliku',
	'can_send_ecards' => 'Može poslati razglednicu',
	'can_post_com' => 'Može komentirati',
	'can_upload' => 'Moµe uploadati sliku',
	'can_have_gallery' => 'Može imati osobnu galeriju',
	'apply' => 'Napravite izmjene',
	'create_new_group' => 'Kreirajte novu grupu',
	'del_groups' => 'Izbrižite izabrane grupe',
	'confirm_del' => 'Upozorenje, kada izbrišete grupu, korisnici koji pripadaju toj grupi biti æe prebaèeni u \'Registered\' grupu !\n\n Želite li nastaviti ?',
	'title' => 'Organizirajte korisnièke grupe',
	'approval_1' => 'Pub. Upl. approval (1)',
	'approval_2' => 'Priv. Upl. approval (2)',
	'note1' => '<b>(1)</b> Za upload u javni album potrebno dopuštenje administratora',
	'note2' => '<b>(2)</b> Za upload u album koji pripada korisniku potrebno dopuštenje administratora',
	'notes' => 'Napomena'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
	'welcome' => 'Dobro došli !'
);

$lang_album_admin_menu = array(
	'confirm_delete' => 'Da li ste sigurni da želite IZBRISATI ovaj album ? \\nSve slike i komentari æe takoðer biti izbrisani.',
	'delete' => 'IZBRIŠI',
	'modify' => 'KARAKTERISTIKE',
	'edit_pics' => 'ISPRAVKA',
);

$lang_list_categories = array(
	'home' => 'Poèetna stranica',
	'stat1' => '<b>[pictures]</b> slika u <b>[albums]</b> albuma i <b>[cat]</b> kategorije sa <b>[comments]</b> komentara pogledane <b>[views]</b> puta',
	'stat2' => '<b>[pictures]</b> slike u <b>[albums]</b> albuma pogledane <b>[views]</b> puta',
	'xx_s_gallery' => '%s\'s Galerija',
	'stat3' => '<b>[pictures]</b> slike u <b>[albums]</b> albuma sa <b>[comments]</b> komentara pogledane <b>[views]</b> puta'
);

$lang_list_users = array(
	'user_list' => 'Popis korisnika',
	'no_user_gal' => 'Nema korisnièkih galerija',
	'n_albums' => '%s album(a)',
	'n_pics' => '%s slika'
);

$lang_list_albums = array(
	'n_pictures' => '%s slika',
	'last_added' => ', posljednja dodana %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => 'Ulaz',
	'enter_login_pswd' => 'Upišite korisnièko ime i zaporku za ulaz',
	'username' => 'Korisnièko ime',
	'password' => 'Zaporka',
	'remember_me' => 'Zapamti me',
	'welcome' => 'Lijep pozdrav %s ...',
	'err_login' => '*** Nešto nije u redu. Probajte ponovno ***',
	'err_already_logged_in' => 'Veæ ste logirani !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => 'Izlaz',
	'bye' => 'Do viðenja %s ...',
	'err_not_loged_in' => 'Niste logirani !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => 'Osvježi album %s',
	'general_settings' => 'Osnovno štimanje',
	'alb_title' => 'Naziv albuma',
	'alb_cat' => 'Kategorija albuma',
	'alb_desc' => 'Opis albuma',
	'alb_thumb' => 'Slièice albuma',
	'alb_perm' => 'Dozvole za ovaj album',
	'can_view' => 'Album moµe biti vidljiv',
	'can_upload' => 'Posjetioci mogu uploadati slike',
	'can_post_comments' => 'Posjetioci mogu pisati komentare',
	'can_rate' => 'Posjetioci mogu ocjenjivati slike',
	'user_gal' => 'Korisnikova galerija',
	'no_cat' => '* Nema kategorije *',
	'alb_empty' => 'Album je prazan',
	'last_uploaded' => 'Posljednje uploadano',
	'public_alb' => 'Svi (javni album)',
	'me_only' => 'Samo ja',
	'owner_only' => 'Vlasnik albuma (%s) samo',
	'groupp_only' => 'Èlanovi \'%s\' grupe',
	'err_no_alb_to_modify' => 'U bazi podataka nema albuma koji možete prepraviti.',
	'update' => 'Osvježi album'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => 'Žao mi je, veæ ste ocijenili ovu sliku',
	'rate_ok' => 'Glas upisan',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
Za postavljanje vlastitih fotografija u galeriju potrebno se registrirati. Prilikom registracije obavezno morate upisati vašu toènu, postojeæu E-Mail adresu, na koju æe vam biti poslana poruka sa linkom kojim æete potvrditi vašu registraciju.<br />
<br /> 
Slažem se da neæu postavljati bilo kakve uznemirujuæe, pornografske, vulgarne fotografije, kao i fotografije koje potièu na bilo kakav oblik mržnje. Slažem se takoðe da Administratorima pravo izbrisati sve fotografije koje nisu prihvatljive, odnosno nabrojane kategorije fotografija. Slaµem se da Administrator moµe izbrisati svaki moj komentar ukoliko ocijeni da nije prikladan. Kao korisnik ove foto galerije slaµem se da svi moji podaci koje upišem u registracijski obrazac budu pohranjeni u bazu podataka. Ukoliko na bilo kakav naèin uznemiravam foto galeriju slažem se da Administator zabrani pristup mojoj IP adresi, odnosno da mi do daljnjeg zabrani pristup ovim stranicama.<br />
<br />
Ova stranica koristi cookie-je za pohranu podataka na va±em raèunaru. Email adresa se koristi samo za potvrdu vaše registracije.<br />
<br />
Klikom na 'Slažem se' prihvaæate uvjete korištenja i nadamo se da ih neæete prekršiti.
EOT;

$lang_register_php = array(
	'page_title' => 'Registracija',
	'term_cond' => 'Pravila i uvjeti',
	'i_agree' => 'Slažem se',
	'submit' => 'Pošaljite registraciju',
	'err_user_exists' => 'Izabrano korisnièko ime veæ je registrirano, probajte neko drugo',
	'err_password_mismatch' => 'Nedostaju dvije zaporke, upišite ponovno',
	'err_uname_short' => 'Korisnièko ime mora imati najmanje 2 znaka',
	'err_password_short' => 'Zaporka mora imati najmanje 2 znaka',
	'err_uname_pass_diff' => 'Korisnièko ime i zaporka ne mogu biti isti',
	'err_invalid_email' => 'Neispravna email adresa',
	'err_duplicate_email' => 'Veæ je netko registriran sa istom email adresom koju ste upisali',
	'enter_info' => 'Upišite registracijske podatke',
	'required_info' => 'Obvezni podaci',
	'optional_info' => 'Dodatni podaci',
	'username' => 'Korisnièko ime',
	'password' => 'Zaporka',
	'password_again' => 'Zaporka ponovno',
	'email' => 'Email',
	'location' => 'Lokacija',
	'interests' => 'Hobiji',
	'website' => 'Web stranica',
	'occupation' => 'Zanimanje',
	'error' => 'POGREŠKA',
	'confirm_email_subject' => '%s - Potvrdite registraciju',
	'information' => 'Informacija',
	'failed_sending_email' => 'Registracijsku potvrdu nije moguæe poslati !',
	'thank_you' => 'Hvala na registraciji.<br /><br />Email sa informacijama kako aktivirati vaš korisnièki raèun poslan je na email adresu koju ste upisali prilikom registracije.',
	'acct_created' => 'Vaš korisnièki raèun je otvoren i sada možete pristupiti stranici sa vašim korisnièkim imenom i zaporkom',
	'acct_active' => 'Vaš korisnièki raèun od sada je aktivan i možete stranici pristupiti sa vašim korisnièim imenom i zaporkom',
	'acct_already_act' => 'Vaš korisnièki raèun je veæ aktivan !',
	'acct_act_failed' => 'Ovaj korisnièki raèun ne može biti aktivan !',
	'err_unk_user' => 'Izabrani korisnik ne postoji !',
	'x_s_profile' => '%s\'s profil',
	'group' => 'Grupa',
	'reg_date' => 'Registriran(a)',
	'disk_usage' => 'Iskorištenost disk prostora',
	'change_pass' => 'Promijeni zaporku',
	'current_pass' => 'Trenutna zaporka',
	'new_pass' => 'Nova zaporka',
	'new_pass_again' => 'Nova zaporka ponovno',
	'err_curr_pass' => 'Trenutna zaporka nije ispravna',
	'apply_modif' => 'Izvrši promjene',
	'change_pass' => 'Promijeni moju zaporku',
	'update_success' => 'Vaš profil je osvjeµen',
	'pass_chg_success' => 'Vaša zaporka je promijenjena',
	'pass_chg_error' => 'Vaša zaporka nije promijenjena',
);

$lang_register_confirm_email = <<<EOT
Hvala na registraciji na {SITE_NAME}

Vaše korisnièko ime : "{USER_NAME}"
Vaša  zaporka : "{PASSWORD}"

Da biste aktivirali vaš korisnièki raèun potrebno je kliknuti na link ispod ili ako želite kopirajte link i nalijepite u vaš web browser.

{ACT_LINK}

Srdaèan pozdrav,

Team {SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => 'Proèitajte komentare',
	'no_comment' => 'Nema komentara za èitanje',
	'n_comm_del' => '%s komentari su izbrisani',
	'n_comm_disp' => 'Broj komentara za prikaz',
	'see_prev' => 'Pogledaj prethodne',
	'see_next' => 'Pogledaj slijedeæe',
	'del_comm' => 'Izbriši izabrane komentare',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => 'Pretražite kolekciju slika',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => 'Pretraga novih slika',
	'select_dir' => 'Izaberi tedirektorij',
	'select_dir_msg' => 'Ova funkcija dozvoljava vam da napravite put do slike koju imate na svom serveru.<br /><br />Izaberite direktorij gdje ste uploadali svoje slike',
	'no_pic_to_add' => 'Nema slike za dodati',
	'need_one_album' => 'Morate imati najmanje jedan album da bi koristili ovu funkciju',
	'warning' => 'Upozorenje',
	'change_perm' => 'Skripta ne može upisivati u ovaj direktorij, morate promijeniti CHMOD na 755 ili 777 prije nego što dodate slike !',
	'target_album' => '<b>Prebaci sliku iz &quot;</b>%s<b>&quot; u </b>%s',
	'folder' => 'Folder',
	'image' => 'Slika',
	'album' => 'Album',
	'result' => 'Rezultat',
	'dir_ro' => 'Nije writable. ',
	'dir_cant_read' => 'Nije readable. ',
	'insert' => 'Dodavanje novih slika u galeriju',
	'list_new_pic' => 'Lista novih slika',
	'insert_selected' => 'Ubacite izabrane slike',
	'no_pic_found' => 'Nije pronaðema nova slika',
	'be_patient' => 'Molimo budite strpljivi, skripti treba vremena da doda slike',
	'notes' =>  '<ul>'.
				'<li><b>OK</b> : znaèi da je slika uspješno dodana'.
				'<li><b>DP</b> : znaèi da je slika duplikat i da je veæ u bazi podataka'.
				'<li><b>PB</b> : znaèi da sliku nije moguæe dodati, provjerite vlastitu konfiguraciju i dozvolu direktorija gdje su slike smještene'.
				'<li>Ako OK, DP, PB \'signs\' se ne pojave kliknite na puknutu sliku da vidite koju je grešku napravio PHP'.
				'<li>Ako je vrijeme isteklo, pritisnite refresh'.
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
                'title' => 'Zabrani pristup korisnicima', 
                'user_name' => 'Korisnièko ime', 
                'ip_address' => 'IP adresa', 
                'expiry' => 'Istièe (blank is permanent)', 
                'edit_ban' => 'Saèuvaj promjene', 
                'delete_ban' => 'Izbriši', 
                'add_new' => 'Dodaj novu zabranu pristupa', 
                'add_ban' => 'Dodaj', 
); 


// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
	'title' => 'Upload slika',
	'max_fsize' => 'Maksimalno dozvoljena velièina je %s KB',
	'album' => 'Album',
	'picture' => 'Slika',
	'pic_title' => 'Naslov slike',
	'description' => 'Opis slike',
	'keywords' => 'Kljuène rijeèi (odvojiti praznim mjestom)',
	'err_no_alb_uploadables' => 'Žao nam je, ovdje nema albuma gdje biste mogli dodati sliku.',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => 'Organizirajte korisnike',
	'name_a' => 'Ime ascending',
	'name_d' => 'Ime descending',
	'group_a' => 'Grupa ascending',
	'group_d' => 'Grupa descending',
	'reg_a' => 'Datum registracije ascending',
	'reg_d' => 'Datum registracije descending',
	'pic_a' => 'Broj slika ascending',
	'pic_d' => 'Broj slika descending',
	'disku_a' => 'Iskorištenost diska ascending',
	'disku_d' => 'Iskorištenost diska descending',
	'sort_by' => 'Poredajte korisnike po',
	'err_no_users' => 'Korisnièka tabla je prazna !',
	'err_edit_self' => 'Ne možete promijeniti svoj profil, koristite \'My profile\' link za to',
	'edit' => 'PREPRAVI',
	'delete' => 'IZBRIŠI',
	'name' => 'Korisnièko ime',
	'group' => 'Grupa',
	'inactive' => 'Neaktivno',
	'operations' => 'Operacije',
	'pictures' => 'Slike',
	'disk_space' => 'Iskorišteno prostora / Kvota',
	'registered_on' => 'Registriran',
	'u_user_on_p_pages' => '%d korisnika na %d stranica',
	'confirm_del' => 'Da li ste sigurni da  želite IZBRISATI korisnika ? \\nSve njegove slike i albumi æe biti izbrisani.',
	'mail' => 'MAIL',
	'err_unknown_user' => 'Izabrani korisnik ne postoji !',
	'modify_user' => 'Modificiraj korisnika',
	'notes' => 'Napomena',
	'note_list' => '<li>Ako ne želite promijeniti trenutnu šifru, ostavite polje "zaporka" prazno',
	'password' => 'Zaporka',
	'user_active' => 'Korisnik je aktivan',
	'user_group' => 'Grupa',
	'user_email' => 'Email',
	'user_web_site' => 'Web stranica',
	'create_new_user' => 'Kreiraj novog korisnika',
	'user_location' => 'Mjesto',
	'user_interests' => 'Hobiji',
	'user_occupation' => 'Zanimanje',
);

// ------------------------------------------------------------------------- // 
// File util.php 
// ------------------------------------------------------------------------- // 

if (defined('UTIL_PHP')) $lang_util_php = array( 
        'title' => 'Promijeni velièinu slike', 
        'what_it_does' => 'Što èini', 
        'what_update_titles' => 'Osvježava naslove iz imena dokumenata', 
        'what_delete_title' => 'Briše naslove', 
        'what_rebuild' => 'Obnavlja slièice i smanjene slike', 
        'what_delete_originals' => 'Briše originalne slike zamjenjujuæi ih smanjenom verzijom', 
        'file' => 'File', 
        'title_set_to' => 'naslov postavljen na', 
        'submit_form' => 'pošalji', 
        'updated_succesfully' => 'uspješno osvježeno', 
        'error_create' => 'POGREŠKA kod postavljanja', 
        'continue' => 'Obradi više slika', 
        'main_success' => 'Dokument je uspješno upotrijebljen kao glavna slika', 
        'error_rename' => 'Pogreška kod mijenjanja imena %s u %s', 
        'error_not_found' => 'Dokument nije pronaðen', 
        'back' => 'natrag na glavnu', 
        'thumbs_wait' => 'Osvježavaju se slièice i/ili se mijenja njihova velièina, molimo Vas da se strpite...', 
        'thumbs_continue_wait' => 'Nastavlja se osvježavanje slièica i/ili mijenjanja velièine slika...', 
        'titles_wait' => 'Osvježavaju se naslovi slika, molimo Vas da se strpite...', 
        'delete_wait' => 'Briše nazive, molimo Vas da se strpite...', 
        'replace_wait' => 'Briše originale i mijenja ih slikama manje velièine, molimo Vas da se strpite..', 
        'instruction' => 'Brza uputstva', 
        'instruction_action' => 'Odaberite radnju', 
        'instruction_parameter' => 'Postavite parametre', 
        'instruction_album' => 'Odaberite album', 
        'instruction_press' => 'Pritisnite %s', 
        'update' => 'Osvježite slièice i/ili slike izmijenjene velièine', 
        'update_what' => 'Što treba osvježiti', 
        'update_thumb' => 'Samo slièice', 
        'update_pic' => 'Samo slike izmijenje velièine', 
        'update_both' => 'I slièice i slike izmijenjene velièine', 
        'update_number' => 'Broj procesuiranih slika po kliku', 
        'update_option' => '(Nastojte postaviti ovu opciju nižom ako imate problema s prekidima)', 
        'filename_title' => 'Naziv dokumenta ? Naziv slike title', 
        'filename_how' => 'Kako treba izmijeniti ime dokumenta', 
        'filename_remove' => 'Izbrišite .jpg nastavak i zamijenite ga _ (crtom) i praznim prostorom', 
        'filename_euro' => 'Promijeni 2003_11_23_13_20_20.jpg u 23/11/2003 13:20', 
        'filename_us' => 'Promijeni 2003_11_23_13_20_20.jpg u 11/23/2003 13:20', 
        'filename_time' => 'Promijeni 2003_11_23_13_20_20.jpg u 13:20', 
        'delete' => 'Izbriši nazive slika ili originalnu velièina slika', 
        'delete_title' => 'Izbriši nazive slika', 
        'delete_original' => 'Izbriši originalnu velièinu slika', 
        'delete_replace' => 'Izbriši originalne slike zamjenjujuæi ih manjim verzijama', 
        'select_album' => 'Odaberi album', 
); 
?>