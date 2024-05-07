<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.3.0  //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002,2003 Gregory DEMAR    //
// http://www.chezgreg.net/coppermine/  //
// ------------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team  //
// (http://coppermine.sf.net/team/)   //
// see /docs/credits.html for details  //
// ------------------------------------------------------------------------- //
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 2 of the License, or  //
// (at your option) any later version.  //
// ------------------------------------------------------------------------- //
// $Id: polish.php,v 1.6 2004/12/29 23:03:51 chtito Exp $
// ------------------------------------------------------------------------- //

// info about translators and translated language
$lang_translation_info = array(
'lang_name_english' => 'Polish', 
'lang_name_native' => 'Polski',
'lang_country_code' => 'pl',
'trans_name'=> 'Jacek Domo�',
'trans_email' => 'plusz@plusz.net',
'trans_website' => 'http://www.plusz.net',
'trans_date' => '2004-05-16', 
);

$lang_charset = 'iso-8859-2';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bajt�w', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('Niedziela', 'Poniedzia�ek', 'Wtorek', '�roda', 'Czwartek', 'Pi�tek', 'Sobota');
$lang_month = array('Styczenia', 'Lutego', 'Marca', 'Kwietnia', 'Maja', 'Czerwca', 'Lipica', 'Sierpnia', 'Wrze�nia', 'Pa�dziernika', 'Listopada', 'Grudnia');

// Some common strings
$lang_yes = 'Tak';
$lang_no  = 'Nie';
$lang_back = 'Wstecz';
$lang_continue = 'Dalej';
$lang_info = 'Informacja';
$lang_error = 'B��d';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =   '%d %B %Y';
$lastcom_date_fmt =  '%d/%m/%y @ %H:%M';
$lastup_date_fmt = '%d %B %Y';
$register_date_fmt = '%d %B %Y';
$lasthit_date_fmt = '%B %d %Y at %I:%M %p'; //cpg1.3.0
$comment_date_fmt =  '%B %d %Y at %I:%M %p'; //cpg1.3.0

// For the word censor
$lang_bad_words = array('');

$lang_meta_album_names = array(
  'random' => 'Losowo wybrane pliki', //cpg1.3.0
  'lastup' => 'Ostatnie aktualizacje',
  'lastalb'=> 'Ostatnio aktualizacje album�w', 
  'lastcom' => 'Ostatnio dodane komentarze',
  'topn' => 'Najpopularniejsze',
  'toprated' => 'Najwy�ej oceniane',
  'lasthits' => 'Ostatnio ogl�dane',
  'search' => 'Wyniki wyszukiwania', 
  'favpics'=> 'Ulubione pliki' //cpg1.3.0
);

$lang_errors = array(
  'access_denied' => 'Nie masz uprawnie� aby ogl�da� t� stron�.',
  'perm_denied' => 'Nie masz uprawnie� aby wykona� t� operacj�.',
  'param_missing' => 'Skrypt zosta� wywo�any bez wymaganego parametru.',
  'non_exist_ap' => 'Wybrany plik lub album nie istnieje!',
  'quota_exceeded' => 'Przekroczono limit miejsca. <br /><br />Tw�j przydzia�: [quota]K, Twoje pliki u�ywaj� obecnie: [space]K. Dodanie wybranego pliku spowoduje przekroczenie limitu.', //cpg1.3.0
  'gd_file_type_err' => 'Je�li w u�yciu jest biblioteka GD, dozwolone formaty zdj�� to wy��cznie JPEG i PNG.',
  'invalid_image' => 'Zdj�cie kt�re przes�ano nie mo�e by� obs�u�one przez bibliotek� GD.',
  'resize_failed' => 'Nie mo�na stworzy� miniatury lub zdj�cia po�redniego.',  
  'no_img_to_display' => 'Brak pliku do wy�wietlenia',
  'non_exist_cat' => 'Wybrana kategoria nie istnieje',
  'orphan_cat' => 'Kategoria nie ma ga��zi nadrz�dnej, uruchom mened�era kategorii aby rozwi�za� ten problem.', //cpg1.3.0
  'directory_ro' => 'Katalog \'%s\' jest zabezpieczony przed zapisem. Pliki nie mog� by� skasowane.', //cpg1.3.0
  'non_exist_comment' => 'Wybrany komentarz nie istnieje.',
  'pic_in_invalid_album' => 'Plik znajduje si� w nieistniej�cym albumie (%s)!?', //cpg1.3.0
  'banned' => 'Obecnie Tw�j dost�p do strony zosta� zablokowany.',
  'not_with_udb' => 'Wybrana funkcja nie jest dost�pna, poniewa� jest zintegrowana z oprogramowniem forum. Czynno�� kt�r� chcesz wykona� nie jest wspierana w tej konfiguracji, b�d� powinna by� obs�u�ona przez oprogramowanie forum.',
  'offline_title' => 'Offline', //cpg1.3.0
  'offline_text' => 'Galeria jest obecnie wy��czona - spr�buj ponownie p�niej', //cpg1.3.0
  'ecards_empty' => 'Nie ma obecnie �adnych zapis�w dotycz�cych e-kartek. Sprawd�, czy w��czy�e� logowanie e-kartek w konfiguracji coppermine!', //cpg1.3.0
  'action_failed' => 'Dzia�anie nieudane. Coppermine nie mo�e przetworzy� Twojego ��dania.', //cpg1.3.0
  'no_zip' => 'Biblioteki do obs�ugi archiw�w ZIP nie s� obecnie dost�pne. Skontaktuj si� z administratorem Coppermine.', //cpg1.3.0
  'zip_type' => 'Nie masz uprawnie� by przesy�a� archiwa ZIP.', //cpg1.3.0
);

$lang_bbcode_help = 'Mo�esz u�y� nast�puj�cych kod�w: <li>[b]<b>Bold</b>[/b]</li> <li>[i]<i>Italic</i>[/i]</li> <li>[url=http://yoursite.com/]Url Text[/url]</li> <li>[email]user@domain.com[/email]</li>'; //cpg1.3.0

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //
$lang_main_menu = array(
  'alb_list_title' => 'Przejd� do listy album�w',
  'alb_list_lnk' => 'Albumy',
  'my_gal_title' => 'Do prywatnej galerii',
  'my_gal_lnk' => 'Moja galeria',
  'my_prof_lnk' => 'M�j profil',
  'adm_mode_title' => 'Prze��cz w tryb administratora',
  'adm_mode_lnk' => 'Tryb administratora',
  'usr_mode_title' => 'Prze��cz w tryb u�ytkownika',
  'usr_mode_lnk' => 'Tryb u�ytkownika',
  'upload_pic_title' => 'Przes�anie pliku do albumu', //cpg1.3.0
  'upload_pic_lnk' => 'Przes�anie pliku', //cpg1.3.0
  'register_title' => 'Utw�rz konto',
  'register_lnk' => 'Zarejestruj si�',
  'login_lnk' => 'Zaloguj',
  'logout_lnk' => 'Wyloguj',
  'lastup_lnk' => 'Ostatnio dodane',
  'lastcom_lnk' => 'Ostatnie komentarze',
  'topn_lnk' => 'Najpopularniejsze',
  'toprated_lnk' => 'Top Lista',
  'search_lnk' => 'Szukaj',
  'fav_lnk' => 'Ulubione',
  'memberlist_title' => 'Poka� u�ytkownik�w', //cpg1.3.0
  'memberlist_lnk' => 'U�ytkownicy', //cpg1.3.0
   'faq_title' => 'FAQ galerii &quot;Coppermine&quot;', //cpg1.3.0
  'faq_lnk' => 'FAQ', //cpg1.3.0
);
  
$lang_gallery_admin_menu = array(
  'upl_app_lnk' => 'Akceptacja plik�w',
  'config_lnk' => 'Konfiguracja',
  'albums_lnk' => 'Albumy',
  'categories_lnk' => 'Kategorie',
  'users_lnk' => 'U�ytkownicy',
  'groups_lnk' => 'Grupy',
  'comments_lnk' => 'Przejrzyj komentarze', //cpg1.3.0
  'searchnew_lnk' => 'Wsadowe dodawanie plik�w',  //cpg1.3.0
  'util_lnk' => 'Narz�dzia administracyjne',  //cpg1.3.0
  'ban_lnk' => 'Banowanie',
  'db_ecard_lnk' => 'Wy�wietl e-kartki', //cpg1.3.0 
);

$lang_user_admin_menu = array(
  'albmgr_lnk' => 'Tworzenie / porz�dkowanie album�w',
  'modifyalb_lnk' => 'Modyfikacja moich album�w',
  'my_prof_lnk' => 'M�j profil',
);

$lang_cat_list = array(
  'category' => 'Kategoria',
  'albums' => 'Albumy',
  'pictures' => 'Pliki', //cpg1.3.0
);

$lang_album_list = array(
  'album_on_page' => 'album�w: %d, stron: %d'
);

$lang_thumb_view = array(
  'date' => 'DATA',
  //Sort by filename and title
  'name' => 'NAZWA PLIKU', 
  'title' => 'TYTU�', 
  'sort_da' => 'Sortowanie wg daty rosn�co',
  'sort_dd' => 'Sortowanie wg daty malej�co',
  'sort_na' => 'Sortowanie wg nazwy rosn�co',
  'sort_nd' => 'Sortowanie wg nazwy malej�co',
  'sort_ta' => 'Sortowanie wg tytu�u rosn�co', 
  'sort_td' => 'Sortowanie wg tytu�u malej�co', 
  'pic_on_page' => 'plik�w: %d stron: %d',
  'user_on_page' => 'u�ytkownik�w: %d, stron: %d'
);

$lang_img_nav_bar = array(
  'thumb_title' => 'Wr�� do widoku miniatur',
  'pic_info_title' => 'Wy�wietl/ukryj info o pliku',
  'slideshow_title' => 'Pokaz slajd�w',
  'ecard_title' => 'Wy�lij jako e-kartk�',
  'ecard_disabled' => 'e-kartki s� wy��czone',
  'ecard_disabled_msg' => 'Nie masz uprawnie� do wysy�ania e-kartek', //js-alert //cpg1.3.0
  'prev_title' => 'Poprzedni plik', //cpg1.3.0
  'next_title' => 'Nast�pny plik', //cpg1.3.0
  'pic_pos' => 'PLIK %s/%s', //cpg1.3.0
);

$lang_rate_pic = array(
  'rate_this_pic' => 'Oce� ten plik ', //cpg1.3.0
  'no_votes' => '(Brak g�os�w)',
  'rating' => '(obecna ocena : %s / 5 g�os�w: %s)',
  'rubbish' => 'Do niczego',
  'poor' => 'S�abe',
  'fair' => 'Niez�e',
  'good' => 'Dobre',
  'excellent' => 'B. dobre',
  'great' => 'Doskona�e',
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
  CRITICAL_ERROR => 'B��d krytyczny',
  'file' => 'Plik: ',
  'line' => 'Linia: ',
);

$lang_display_thumbnails = array(
  'filename' => 'Nazwa pliku: ',
  'filesize' => 'Rozmiar pliku: ',
  'dimensions' => 'Wymiary: ',
  'date_added' => 'Data dodania: ',  //cpg1.3.0
);

$lang_get_pic_data = array(
  'n_comments' => 'komentarzy: %s ',
  'n_views' => 'ods�on: %s ',
  'n_votes' => '(g�os�w: %s)'
);

$lang_cpg_debug_output = array(
  'debug_info' => 'Informacje debuggera', //cpg1.3.0
  'select_all' => 'Wybierz wszystko', //cpg1.3.0
  'copy_and_paste_instructions' => 'Aby otrzyma� pomoc na forum wsparcia technicznego coppermine, skopiuj i wklej te informacje debuggera do swojego postu. Pami�taj aby zast�pi� wszelkie has�a ci�giem ***, przed zamieszczeniem postu.', //cpg1.3.0
  'phpinfo' => 'wy�wietl phpinfo', //cpg1.3.0
);

$lang_language_selection = array(
  'reset_language' => 'Domy�lny j�zyk', //cpg1.3.0
  'choose_language' => 'Wybierz sw�j j�zyk', //cpg1.3.0
);

$lang_theme_selection = array(
  'reset_theme' => 'Domy�lny styl', //cpg1.3.0
  'choose_theme' => 'Wybierz styl', //cpg1.3.0
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
  'Exclamation' => 'Wykrzyknik',
  'Question' => 'Pytanie',
  'Very Happy' => 'Bardzo zadowolony',
  'Smile' => 'U�miechni�ty',
  'Sad' => 'Smutny',
  'Surprised' => 'Zaskoczony',
  'Shocked' => 'Zszokowany',
  'Confused' => 'Zniesmaczony',
  'Cool' => 'Luzak',
  'Laughing' => '�mieje si�',
  'Mad' => 'W�ciek�y',
  'Razz' => 'J�zorek',
  'Embarassed' => 'Zawstydzony / gafa',
  'Crying or Very sad' => 'Zrozpaczony',
  'Evil or Very Mad' => 'W�ciek�y do kwadratu',
  'Twisted Evil' => 'Twisted Evil',
  'Rolling Eyes' => 'Przewraca oczami',
  'Wink' => 'Puszcza oczko',
  'Idea' => 'Pomys�',
  'Arrow' => 'Strza�ka',
  'Neutral' => 'Neutralny',
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
  0 => 'Zako�czono prac� administratora...',
  1 => 'Prze��czanie do trybu administratora...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //
if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
  'alb_need_name' => 'Albumy musz� mie� nazw� !', //js-alert
  'confirm_modifs' => 'Czy na pewno chcesz dokona� tych modyfikacji ?', //js-alert
  'no_change' => 'Nie dokona�e�/a� �adnej zmiany !', //js-alert
  'new_album' => 'Nowy album',
  'confirm_delete1' => 'Czy na pewno chcesz skasowa� ten album ?', //js-alert
  'confirm_delete2' => '\nWszystkie pliki i komentarze kt�re zawiera zostan� stracone !', //js-alert
  'select_first' => 'Wybierz najpierw album', //js-alert
  'alb_mrg' => 'Mened�er album�w',
  'my_gallery' => '* Moja galeria *',
  'no_category' => '* Bez kategorii *',
  'delete' => 'Kasuj',
  'new' => 'Nowy',
  'apply_modifs' => 'Wykonaj modyfikacje',
  'select_category' => 'Wybierz kategori�',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //
if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
  'miss_param' => 'Brak parametr�w do operacji \'%s\'!',
  'unknown_cat' => 'Wybrana kategoria nie istnieje w bazie danych',
  'usergal_cat_ro' => 'Galerie u�ytkownik�w nie mog� by� kasowane!',
  'manage_cat' => 'Zarz�dzaj kategoriami',
  'confirm_delete' => 'Czy jeste� pewny/a �e chcesz SKASOWA� t� kategori�',
  'category' => 'Kategoria',
  'operations' => 'Operacje',
  'move_into' => 'Przesu� do',
  'update_create' => 'Uaktualnij / stw�rz kategori�',
  'parent_cat' => 'Kategoria wy�szego rz�du',
  'cat_title' => 'Tytu� kategorii',
  'cat_thumb' => 'Miniatrury kategorii', //cpg1.3.0
  'cat_desc' => 'Opis kategorii'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
  'title' => 'Konfiguracja',
  'restore_cfg' => 'Przywr�� ustawienia domy�lne',
  'save_cfg' => 'Zachowaj now� konfiguracj�',
  'notes' => 'Notatki',
  'info' => 'Informacja',
  'upd_success' => 'Konfiguracja Coppermine zosta�a uaktualniona',
  'restore_success' => 'Konfiguracja Coppermine zosta�a przywr�cona',
  'name_a' => 'Nazwa rosn�co',
  'name_d' => 'Nazwa malej�co',
  'title_a' => 'Tytu� rosn�co', 
  'title_d' => 'Tytu� malej�co', 
  'date_a' => 'Data rosn�co',
  'date_d' => 'Data malej�co',
  'th_any' => 'Maksymalne rozmiary',
  'th_ht' => 'Wysoko��',
  'th_wd' => 'Szeroko��',
  'label' => 'etykieta', //cpg1.3.0
  'item' => 'element', //cpg1.3.0
  'debug_everyone' => 'Wszyscy', //cpg1.3.0
  'debug_admin' => 'Tylko administrator', //cpg1.3.0
  );

if (defined('CONFIG_PHP')) $lang_config_data = array(
  'Ustawienia g��wne',
  array('Nazwa galerii', 'gallery_name', 0),
  array('Opis galerii', 'gallery_description', 0),
  array('E-mail administratora galerii', 'gallery_admin_email', 0),
  array('Adresy docelowe dla linku \'Zobacz wi�cej\' w e-kartkach', 'ecards_more_pic_target', 0),
  array('Galeria jest wy��czona', 'offline', 1), //cpg1.3.0
  array('Logowanie e-kartek', 'log_ecards', 1), //cpg1.3.0
  array('Zezw�l na �ci�ganie Ulubionych w archiwum ZIP', 'enable_zipdownload', 1), //cpg1.3.0

  'Language, Themes &amp; Charset settings',
  array('J�zyk', 'lang', 5),
  array('Styl galerii', 'theme', 6),
  array('Pokazuj list� dost�pnych j�zyk�w', 'language_list', 8), //cpg1.3.0
  array('Pokazuj flagi j�zyk�w', 'language_flags', 8), //cpg1.3.0
  array('Pokazuj &quot;reset&quot; przy wyborze j�zyka', 'language_reset', 1), //cpg1.3.0
  array('Pokazuj list� styli', 'theme_list', 8), //cpg1.3.0
  array('Pokazuj &quot;reset&quot; przy wyborze stylu', 'theme_reset', 1), //cpg1.3.0
  array('Pokazuj FAQ', 'display_faq', 1), //cpg1.3.0
  array('Pokazuj pomoc bbcode', 'show_bbcode_help', 1), //cpg1.3.0
  array('Kodowanie znak�w', 'charset', 4), //cpg1.3.0

  'Przegl�danie listy album�w',
  array('Szeroko�� g��wnej galerii (piksele lub %)', 'main_table_width', 0),
  array('Ilo�� kategorii do wy�wietlenia', 'subcat_level', 0),
  array('Ilo�� album�w do wy�wietlenia', 'albums_per_page', 0),
  array('Ilo�� kolumn w li�cie album�w', 'album_list_cols', 0),
  array('Rozmiar miniatur w pikselach', 'alb_list_thumb_size', 0),
  array('Zawarto�� strony g��wnej', 'main_page_layout', 0),
  array('Poka� miniatur� pierwszego poziomu w miniaturach albumu','first_level',1),
 
  'Widok miniatur',
  array('Ilo�� kolumn na stronie miniatur', 'thumbcols', 0),
  array('Ilo�� wierszy na stronie miniatur', 'thumbrows', 0),
  array('Maksymalna ilo�� pask�w do wy�wietlenia', 'max_tabs', 10), //cpg1.3.0
  array('Wy�wietl opis pliku (opr�cz tytu�u) poni�ej miniatury', 'caption_in_thumbview', 1), //cpg1.3.0
  array('Wy�wietl ilo�� ods�on poni�ej miniatury', 'views_in_thumbview', 1), //cpg1.3.0
  array('Wy�wietl ilo�� komentarzy poni�ej miniatury', 'display_comment_count', 1),
  array('Wy�wietl przesy�aj�cego poni�ej miniatury', 'display_uploader', 1), //cpg1.3.0
  array('Domy�lny porz�dek sortowania plik�w', 'default_sort_order', 3), //cpg1.3.0
  array('Minimalna ilo�� g�os�w niezb�dna do umieszczenia pliku w kategorii \'Top Lista\'', 'min_votes_for_rating', 0), //cpg1.3.0

  'Przegl�danie obraz�w &amp; Ustawienia komentarzy',
  array('Szeroko�� tabeli wy�wietlaj�cej pliki (piksele lub %)', 'picture_table_width', 0), //cpg1.3.0
  array('Domy�lne pokazywanie informacji o pliku', 'display_pic_info', 1), //cpg1.3.0
  array('Blokowanie s��w z "listy zakazanych" w komentarzach', 'filter_bad_words', 1),
  array('Wy�wietlanie emotikon w komentarzach', 'enable_smilies', 1),
  array('Maksymalna d�ugo�� opisu pliku', 'max_img_desc_length', 0),
  array('Maksymalna ilo�� znak�w w s�owie', 'max_com_wlength', 0),
  array('Maksymalna ilo�� linii w komentarzu', 'max_com_lines', 0),
  array('Maksymalna d�ugo�� komentarza (znak�w)', 'max_com_size', 0),
  array('Poka� "pasek filmu" z miniaturami', 'display_film_strip', 1), 
  array('Ilo�� element�w wy�wietlanych w "pasku filmu" z miniaturami', 'max_film_strip_items', 0), 
  array('Powiadom administratora o komentarzu', 'email_comment_notification', 1), //cpg1.3.0
  array('Interwa� pokazu slajd�w (1 sekunda = 1000 milisekund)', 'slideshow_interval', 0), //cpg1.3.0

  'Ustawienia plik�w i miniatur', //cpg1.3.0
  array('Jako�� plik�w JPEG', 'jpeg_qual', 0),
  array('Maksymalny rozmiar miniatury <a href="#notice2" class="clickable_option">**</a>', 'thumb_width', 0), //cpg1.3.0
  array('U�yj wymiaru (szeroko��, wysoko�� lub maksymalny widok dla miniatury)<b>**</b>', 'thumb_use', 7),
  array('Tw�rz zdj�cia po�rednie','make_intermediate',1),
  array('Maksymalna szeroko�� po�redniego zdj�cia lub video <a href="#notice2" class="clickable_option">**</a>', 'picture_width', 0), //cpg1.3.0
  array('Maksymalny rozmiar przesy�anych plik�w (KB)', 'max_upl_size', 0), //cpg1.3.0
  array('Maksymana wysoko�� lub szeroko�� przesy�anych zdj�� (w pikselach)', 'max_upl_width_height', 0), //cpg1.3.0

  'Zaawansowane ustawienia plik�w i miniatur', //cpg1.3.0
  array('Wy�wietlanie ikon album�w prywatnych niezalogowanemu u�ytkownikowi','show_private',1), //cpg1.3.0
  array('Znaki zakazane w nazwach plik�w', 'forbiden_fname_char',0), //cpg1.3.0
  //array('Akceptowane rozszerzenia przesy�anych zdj��', 'allowed_file_extensions',0), //cpg1.3.0
  array('Akceptowalne typy obraz�w', 'allowed_img_types',0), //cpg1.3.0
  array('Akceptowalne typy plik�w wideo', 'allowed_mov_types',0), //cpg1.3.0
  array('Akceptowalne typy plik�w audio', 'allowed_snd_types',0), //cpg1.3.0
  array('Akceptowalne typy dokument�w', 'allowed_doc_types',0), //cpg1.3.0
  array('Metoda skalowania obraz�w','thumb_method',2), //cpg1.3.0
  array('�cie�ka dost�pu do oprogramowania \'konwertuj�cego\' ImageMagick (np /usr/bin/X11/)', 'impath', 0), //cpg1.3.0
  //array('Dozwolone nazwy plik�w (w�a�ciwe dla ImageMagick)', 'allowed_img_types',0), //cpg1.3.0
  array('Komendy linii polece� dla ImageMagick', 'im_options', 0), //cpg1.3.0
  array('Czytaj dane EXIF w plikach JPEG', 'read_exif_data', 1), //cpg1.3.0
  array('Czytaj dane IPTC w plikach JPEG', 'read_iptc_data', 1), //cpg1.3.0
  array('Katalog album�w <a href="#notice1" class="clickable_option">*</a>', 'fullpath', 0), //cpg1.3.0
  array('Nazwa katalogu na pliki u�ytkownik�w <a href="#notice1" class="clickable_option">*</a>', 'userpics', 0), //cpg1.3.0
  array('Prefix dla zdj�� po�rednich <a href="#notice1" class="clickable_option">*</a>', 'normal_pfx', 0), //cpg1.3.0
  array('Prefix dla miniatur <a href="#notice1" class="clickable_option">*</a>', 'thumb_pfx', 0), //cpg1.3.0
  array('Domy�lne uprawnienia katalog�w', 'default_dir_mode', 0), //cpg1.3.0
  array('Domy�lne uprawnienia plik�w', 'default_file_mode', 0), //cpg1.3.0

  'Ustawienia u�ytkownik�w',
  array('Zezwalanie na rejestracj� nowych u�ytkownik�w', 'allow_user_registration', 1),
  array('Rejestracja u�ytkownika wymaga potwierdzenia e-mail', 'reg_requires_valid_email', 1),
  array('Powiadom administratora o rejestracji e-mailem', 'reg_notify_admin_email', 1), //cpg1.3.0
  array('Zezwalanie posiadania tego samego adresu e-mail przez dw�ch u�ytkownik�w', 'allow_duplicate_emails_addr', 1),
  array('U�ytkownicy mog� tworzy� albumy prywatne', 'allow_private_albums', 1),
  array('Powiadom administratora o plikach oczekuj�cych na akceptacj�', 'upl_notify_admin_email', 1), //cpg1.3.0
  array('Zezw�l na ogl�danie listy u�ytkownik�w u�ytkownikom zarejestrowanym', 'allow_memberlist', 1), //cpg1.3.0
  
  'Nazwy dodatkowych p�l do opisu pliku (pozostaw je puste je�eli nie s� u�ywane)',
  array('Nazwa pola 1', 'user_field1_name', 0),
  array('Nazwa pola 2', 'user_field2_name', 0),
  array('Nazwa pola 3', 'user_field3_name', 0),
  array('Nazwa pola 4', 'user_field4_name', 0),

  'Ustawienia cookies',
  array('Nazwa plik�w cookie tworzonych przez skrypt (w przypadku integracji bbs, upewnij si�, �e nazwa r�ni si� od nazw plik�w generowanych przez bbs', 'cookie_name', 0),
  array('�cie�ka plik�w cookie tworzonych przez skrypt', 'cookie_path', 0),
  
  'R�ne ustawienia',
  array('W��cz tryb debugowania', 'debug_mode', 9), //cpg1.3.0
  array('Pokazuj powiadomienia w trybie debugowania', 'debug_notice', 1), //cpg1.3.0

  '<br /><div align="left"><a name="notice1"></a>(*) Pola oznaczone gwiazdk� nie mog� by� zmienione je�eli w bazie danych s� ju� pliki.<br />
  <a name="notice2"></a>(**) Zmiana tych ustawie� dotyczy jedynie nowych plik�w dodawanych do bazy, dlatego rekomenduje si� nie dokonywanie zmiany, je�eli w galerii znajduj� si� ju� jakie� pliki. Zmiana istniej�cych plik�w mo�e zosta� jednak dokonana przy pomocy &quot;<a href="util.php">narz�dzi administracyjnych (zmiana rozmiaru zdj��)</a>&quot; znajduj�cych si� w menu administratora.</div><br />', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File db_ecard.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('DB_ECARD_PHP')) $lang_db_ecard_php = array(
  'title' => 'Wy�lij e-kartk�', //cpg1.3.0
  'ecard_sender' => 'Nadawca', //cpg1.3.0
  'ecard_recipient' => 'Odbiorca', //cpg1.3.0
  'ecard_date' => 'Data', //cpg1.3.0
  'ecard_display' => 'Wy�wietl e-kartk�', //cpg1.3.0
  'ecard_name' => 'Imi�', //cpg1.3.0
  'ecard_email' => 'E-mail', //cpg1.3.0
  'ecard_ip' => 'IP #', //cpg1.3.0
  'ecard_ascending' => 'rosn�co', //cpg1.3.0
  'ecard_descending' => 'malej�co', //cpg1.3.0
  'ecard_sorted' => 'Sortowane', //cpg1.3.0
  'ecard_by_date' => 'wg daty', //cpg1.3.0
  'ecard_by_sender_name' => 'wg imienia nadawcy', //cpg1.3.0
  'ecard_by_sender_email' => 'wg e-maila nadawcy', //cpg1.3.0
  'ecard_by_sender_ip' => 'wg adresu IP nadawcy', //cpg1.3.0
  'ecard_by_recipient_name' => 'wg nazwy odbiorcy', //cpg1.3.0
  'ecard_by_recipient_email' => 'wg e-maila odbiorcy', //cpg1.3.0
  'ecard_number' => 'wy�wietlane rekordy: %s - %s z %s', //cpg1.3.0
  'ecard_goto_page' => 'do strony', //cpg1.3.0
  'ecard_records_per_page' => 'Rekord�w na stronie', //cpg1.3.0
  'check_all' => 'Wybierz wszystkie', //cpg1.3.0
  'uncheck_all' => 'Wyczy�� wszystkie', //cpg1.3.0
  'ecards_delete_selected' => 'Skasuj wybrane e-kartki', //cpg1.3.0
  'ecards_delete_confirm' => 'Czy na pewno chcesz skasowa� te rekodry? Zaznacz checkbox!', //cpg1.3.0
  'ecards_delete_sure' => 'Chc� skasowa�', //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
  'empty_name_or_com' => 'Musisz poda� swoje imi� i napisa� komentarz',
  'com_added' => 'Tw�j komentarz zosta� dodany',
  'alb_need_title' => 'Musisz poda� tytu� dla albumu!',
  'no_udp_needed' => 'Zmiana nie jest konieczna.',
  'alb_updated' => 'Album zosta� uaktualniony',
  'unknown_album' => 'Wybrany album nie istnieje, lub nie masz uprawnie� do przesy�ania',
  'no_pic_uploaded' => 'Plik nie zosta� dodany!<br /><br />Je�eli wybrano plik do przes�ania, sprawd� czy serwer na to zezwala...', //cpg1.3.0
  'err_mkdir' => 'Nie uda�o si� utworzy� katalogu %s !',
  'dest_dir_ro' => 'Katalog docelowy %s nie mo�e by� zapisany przez skrypt!',
  'err_move' => 'Nie mo�na przenie�� %s do %s !',
  'err_fsize_too_large' => 'Plik kt�ry przesy�asz ma zbyt du�y rozmiar (maksymalnie dozwolony: %s x %s) !',//cpg1.3.0
  'err_imgsize_too_large' => 'Plik kt�ry przesy�asz ma zbyt du�y rozmiar (maksymalnie dozwolony: to %s KB) !',
  'err_invalid_img' => 'Plik kt�ry przesy�asz jest w niedozwolonym formacie!',
  'allowed_img_types' => 'Mo�esz przes�a� tylko %s plik�w.',
  'err_insert_pic' => 'Plik \'%s\' nie mo�e zosta� wstawiony do albumu ', //cpg1.3.0
  'upload_success' => 'Plik zosta� przes�any <br /><br />B�dzie widoczny po akceptacji przez administratora.', //cpg1.3.0
  'notify_admin_email_subject' => '%s - powiadomienie o przes�aniu pliku', //cpg1.3.0
  'notify_admin_email_body' => 'U�ytkownik %s przes�a� plik, oczekuje on na Twoj� aprobat�. Odwied� %s', //cpg1.3.0
  'info' => 'Informacje',
  'com_added' => 'Dodano komentarz',
  'alb_updated' => 'Uaktualniono album',
  'err_comment_empty' => 'Tw�j komentarz jest pusty!',
  'err_invalid_fext' => 'Akceptowane s� jedynie pliki z nast�puj�cymi rozszerzeniami: <br /><br />%s.',
  'no_flood' => 'Przykro mi ale jeste�/a� autorem ostatniego dodanego komentarza<br /><br />Mo�esz go edytowa� aby zmieni� tre��',
  'redirect_msg' => 'Jeste� przekierowywany.<br /><br /><br />Kliknij \'DALEJ\' je�eli strona nie zmieni si� automatycznie',
  'upl_success' => 'Plik zosta� przes�any', //cpg1.3.0
  'email_comment_subject' => 'W galerii Coppermine dodano komentarz', //cpg1.3.0
  'email_comment_body' => 'Dodano komentarz do Twojej galerii zobacz go tutaj', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
  'caption' => 'Tytu�',
  'fs_pic' => 'pe�ny rozmiar',
  'del_success' => 'skasowano',
  'ns_pic' => 'normalny rozmiar',
  'err_del' => 'nie mo�e by� skasowane',
  'thumb_pic' => 'miniatura',
  'comment' => 'komentarz',
  'im_in_alb' => 'zdj�cie z albumu',
  'alb_del_success' => 'Skasowano album \'%s\' ',
  'alb_mgr' => 'Mened�er album�w',
  'err_invalid_data' => 'Otrzymano niew�a�ciwe dane \'%s\'',
  'create_alb' => 'Tworzenie albumu \'%s\'',
  'update_alb' => 'Uaktualnienie albumu: \'%s\' tytu�: \'%s\' index: \'%s\'',
  'del_pic' => 'Kasowanie pliku', //cpg1.3.0
  'del_alb' => 'Kasowanie albumu',
  'del_user' => 'Kasowanie u�ytkownika',
  'err_unknown_user' => 'Wybrany u�ytkownik nie istnieje!',
  'comment_deleted' => 'Komentarz zosta� dodany',
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
  'confirm_del' => 'Czy na pewno chcesz skasowa� ten plik? \\nZostan� skasowane r�wnie� komentarze do niego.', //js-alert //cpg1.3.0
  'del_pic' => 'SKASUJ TEN PLIK', //cpg1.3.0
  'size' => '%s x %s pikseli',
  'views' => '%s razy',
  'slideshow' => 'Pokaz slajd�w',
  'stop_slideshow' => 'ZATRZYMAJ POKAZ',
  'view_fs' => 'Kliknij aby zobaczy� pe�ny rozmiar',
  'edit_pic' => 'Edytowanie opisu', //cpg1.3.0
  'crop_pic' => 'Kadrowanie i obr�t', //cpg1.3.0
);

$lang_picinfo = array(
  'title' =>'Informacja o pliku', //cpg1.3.0
  'Filename' => 'Nazwa pliku',
  'Album name' => 'Nazwa albumu',
  'Rating' => 'Ocena (%s g�os�w)',
  'Keywords' => 'S�owa kluczowe',
  'File Size' => 'Rozmiar pliku',
  'Dimensions' => 'Wymiary',
  'Displayed' => 'Wy�wietle�',
  'Camera' => 'Aparat fotograficzny',
  'Date taken' => 'Data zrobienia zdj�cia',
  'Aperture' => 'Przes�ona',
  'Exposure time' => 'Czas ekspozycji',
  'Focal length' => 'Ogniskowa',
  'Comment' => 'Komentarz',
  'addFav'=>'Dodaj do Ulubionych', 
  'addFavPhrase'=>'Ulubione', 
  'remFav'=>'Usu� z Ulubionych',
  'iptcTitle'=>'Tytu� IPTC', //cpg1.3.0
  'iptcCopyright'=>'Copyright IPTC', //cpg1.3.0
  'iptcKeywords'=>'S�owa kluczowe IPTC', //cpg1.3.0
  'iptcCategory'=>'Kategoria IPTC', //cpg1.3.0
  'iptcSubCategories'=>'Podkategorie IPTC', //cpg1.3.0
);

$lang_display_comments = array(
  'OK' => 'OK',
  'edit_title' => 'Edytuj ten komentarz',
  'confirm_delete' => 'Czy na pewno chcesz skasowa� ten komentarz ?', //js-alert
   'add_your_comment' => 'Dodaj komentarz',
  'name'=>'Pseudonim', 
  'comment'=>'Komentarz', 
  'your_name' => 'Anonim', 
);

$lang_fullsize_popup = array(
  'click_to_close' => 'Kliknij zdj�cie aby zamkn�� okno', 
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
  'title' => 'Wy�lij e-kartk�',
  'invalid_email' => '<b>Uwaga!</b> : niepoprawny adres e-mail !',
  'ecard_title' => 'e-kartka od %s dla Ciebie',
  'view_ecard' => 'Je�eli e-kartka nie wy�wietla si� poprawnie, kliknij ten link',
  'view_more_pics' => 'Kliknij ten link aby zobaczy� wi�cej zdj��!',
  'send_success' => 'Twoja e-kartka zosta�a wys�ana',
  'send_failed' => 'Niestety, serwer nie mo�e wys�a� Twojej e-kartki...',
  'from' => 'Od',
  'your_name' => 'Twoje imi�',
  'your_email' => 'Tw�j adres e-mail',
  'to' => 'Do',
  'rcpt_name' => 'Nazwa odbiorcy',
  'rcpt_email' => 'Adres e-mail odbiorcy',
  'greetings' => 'Temat',
  'message' => 'Wiadomo��',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
  'pic_info' => 'Plik&nbsp;Info', //cpg1.3.0
  'album' => 'Album',
  'title' => 'Tytu�',
  'desc' => 'Opis',
  'keywords' => 'S�owa kluczowe',
  'pic_info_str' => '%s &razy; %s - %s KB - %s ods�on - %s g�os�w',
  'approve' => 'Akceptuj plik', //cpg1.3.0
  'postpone_app' => 'Odrocz akceptacj�',
  'del_pic' => 'Skasuj plik', //cpg1.3.0
  'reset_view_count' => 'Resetuj licznik ods�on',
  'reset_votes' => 'Resetuj g�osowania',
  'del_comm' => 'Skasuj komentarze',
  'upl_approval' => 'Akceptacja zdj��',
  'edit_pics' => 'Edytuj zdj�cia',
  'see_next' => 'Zobacz nast�pne zdj�cia',
  'see_prev' => 'Zobacz poprzednie zdj�cia',
  'n_pic' => 'zdj��: %s',
  'n_of_pic_to_disp' => 'Ilo�� zdj�� do wy�wietlenia',
  'apply' => 'Zastosuj zmiany'
);

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
  'pic_info' => 'Informacja&nbsp;o pliku', //cpg1.3.0
  'album' => 'Album',
  'title' => 'Tytu�',
  'desc' => 'Opis',
  'keywords' => 'S�owa kluczowe',
  'pic_info_str' => '%s &razy; %s - %s KB - %s ods�on - %s g�os�w',
  'approve' => 'Akceptuj plik', //cpg1.3.0
  'postpone_app' => 'Odrocz akceptacj�',
  'del_pic' => 'Kasuj plik', //cpg1.3.0
  'read_exif' => 'Odczytaj ponownie informacje EXIF', //cpg1.3.0
  'reset_view_count' => 'Kasuj licznik ods�on',
  'reset_votes' => 'Kasuj g�osowania',
  'del_comm' => 'Kasuj komentarze',
  'upl_approval' => 'Akceptacja plik�w',
  'edit_pics' => 'Edycja plik�w', //cpg1.3.0
  'see_next' => 'Zobacz nast�pne pliki', //cpg1.3.0
  'see_prev' => 'Zobacz poprzednie pliki', //cpg1.3.0
  'n_pic' => '%s plik�w', //cpg1.3.0
  'n_of_pic_to_disp' => 'Ilo�� plik�w do wy�wietlenia', //cpg1.3.0
  'apply' => 'Zastosuj zmiany', //cpg1.3.0
  'crop_title' => 'Edytor zdj�� Coppermine', //cpg1.3.0
  'preview' => 'Podgl�d', //cpg1.3.0
  'save' => 'Zapisz zdj�cie', //cpg1.3.0
  'save_thumb' =>'Zapisz jako miniatur�', //cpg1.3.0
  'sel_on_img' =>'Obszar wyboru musi mie�ci� si� na zdj�ciu!', //js-alert //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File faq.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FAQ_PHP')) $lang_faq_php = array(
  'faq' => 'Najcz�ciej zadawane pytania', //cpg1.3.0
  'toc' => 'Spis tre�ci', //cpg1.3.0
  'question' => 'Pytanie: ', //cpg1.3.0
  'answer' => 'Odpowied�: ', //cpg1.3.0
);

if (defined('FAQ_PHP')) $lang_faq_data = array(
  'Generalne FAQ', //cpg1.3.0
  array('Dlaczego warto si� zarejestrowa�?', 'Rejestracja mo�e by� wymagana przez administratora serwisu. Zarejestrowanie si� daje u�ytkownikowi dodatkowe mo�liwo�ci, takie jak przesy�anie w�asnych plik�w, tworzenie listy ulubionych, ocenianie zdj��, zamieszczanie komentarzy itp.', 'allow_user_registration', '0'), //cpg1.3.0
  array('Jak si� zarejestrowa�?', 'Przejd� do sekcji &quot;Rejestracja&quot; i wype�nij wymagane pola (ew. tak�e pola opcjonalne).<br />Je�eli Administrator w��czy� opcj� aktywacji przez e-mail, po wype�nieniu formularza rejestracji, na podany tam adres pocztowy otrzymasz e-mail zawieraj�cy instrukcje w jaki spos�b aktywowa� konto. Aktywacja jest wymagana przed pierwszym za�ogowaniem.', 'allow_user_registration', '1'), //cpg1.3.0
  array('Jak si� logowa�?', 'Przejd� do sekcji &quot;Logowanie&quot;, Wprowad� swoj� nazw� u�ytkownika i has�o. Mo�esz tak�e wybra� opcj� &quot;Pami�taj mnie&quot; aby� nie musia� logowa� si� przy ponownym wej�ciu na stron�.<br /><b>WA�NE: aby ta funkcja serwisu dzia�a�a nale�y w��czy� obs�ug� plik�w cookie i nie kasowa� plik�w cookie generowanych przez serwis.</b>', 'offline', 0), //cpg1.3.0
  array('Dlaczego nie mog� si� zalogowa�?', 'Czy zarejestrowa�e� si� ju� i klikn��e� na ��cze z wys�anego do Ciebie e-mail\'a? ��cze to pozwoli na aktywowanie Twojego konta. W przypadku innych k�opot�w skontaktuj si� z administratorem serwisu.', 'offline', 0), //cpg1.3.0
  array('Co mam zrobi� je�eli zapomn� has�a?', 'Je�eli serwis udost�pnia link &quot;Zapomnia�em has�a&quot;, u�yj go. W innym wypadku skontaktuj si� z administratorem i popro� go o nowe has�o.', 'offline', 0), //cpg1.3.0
  //array('Co mam zrobi�, je�eli zmieni� mi si� adres e-mail?', 'Zaloguj si� i zmie� sw�j e-mail w &quot;Profilu&quot;', 'offline', 0), //cpg1.3.0
  array('Jak zapisa� plik do &quot;Moich ulubionych&quot;?', 'Kliknij na pliku, a nast�pnie na ��czu &quot;informacji o zdj�ciu&quot; (<img src="images/info.gif" width="16" height="16" border="0" alt="Picture information" />); przejd� na d� i kliknij &quot;Dodaj do ulubionych&quot;.<br />Mo�liwe, �e administrator w��czy� opcj� domy�lnego pokazywania informacji o pliku.<br />WA�NE: Nale�y w��czy� obs�ug� plik�w cookie z tego serwisu i nie kasowa� ich.', 'offline', 0), //cpg1.3.0
  array('Jak oceni� plik?', 'Kliknij na miniaturze, przejd� na d� strony i wybierz odpowiedni� ocen�.', 'offline', 0), //cpg1.3.0
  array('Jak zamie�ci� komentarz do pliku?', 'Kliknij na miniaturze, przejd� na d� i w odpowiednim polu wpisz komentarz.', 'offline', 0), //cpg1.3.0
  array('Jak przes�a� plik?', 'Przejd� do &quot;Przesy�ania zdj��&quot; i wybierz album do kt�rego chcesz przes�a� plik, kliknij &quot;Przegl�daj&quot; znajd� plik kt�ry chcesz przes�a�, wybierz &quot;Otw�rz&quot; (dodaj opis, je�eli chcesz) i kliknij &quot;Prze�lij&quot;', 'allow_private_albums', 0), //cpg1.3.0
  array('Gdzie mog� przes�a� plik?', 'Pliki mo�na przesy�a� do jednego z album�w w Twojej Galerii. Administrator mo�e tak�e zezwoli� Ci na przesy�anie zdj�� do album�w w Galerii G��wnej.', 'allow_private_albums', 0), //cpg1.3.0
  array('Jakie pliki mo�na przesy�a�? W jakiej wielko�ci?', 'Typ i rodzaj przesy�anych plik�w (jpg, png, etc.) okre�la administrator serwisu.', 'offline', 0), //cpg1.3.0
  array('Co to jest &quot;Moja Galeria&quot;?', '&quot;Moja Galeria&quot; to prywatna galeria kt�r� mo�e zarz�dza� u�ytkownik. Mo�esz tam przesy�a� swoje pliki.', 'allow_private_albums', 0), //cpg1.3.0
  array('W jaki spos�b tworzy�, kasowa� i zmienia� nazwy album�w w &quot;Mojej Galerii&quot;?', 'Powiniene� przej�� do &quot;Trybu Administracyjnego&quot;<br />Przejd� do &quot;Tworzenie/Porz�dkowanie album�w&quot;i kliknij &quot;Nowy&quot;. Zmie� domy�ln� nazw� &quot;Nowy Album&quot; na wybran� przez siebie.<br />Mo�esz tak�e modyfikowa� dowolny album ze swojej galerii.<br />Nast�pnie kliknij &quot;Zastosuj zmiany&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('W jaki spos�b zezwala� i odbiera� zezwolenia na ogl�danie moich album�w?', 'Przejd� do &quot;Trybu Administracyjnego&quot;<br />i sekcji &quot;Modyfikuj moje albumy. Na pasku &quot;Aktualizuj Album&quot; wybierz album, kt�ry chcesz zmodyfikowa�. <br />Mo�esz zmieni� jego nazw�, opis, miniatur�, ustawi� zezwolenia na ogl�danie i komentowanie/ocenianie jego zawarto�ci.<br />Nast�pnie kliknij &quot;Aktualizuj album&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('Co zrobi� by m�c obejrze� galerie innych u�ytkownik�w?', 'Przejd� do &quot;Listy Album�w&quot; i wybierz &quot;Galerie u�ytkownik�w&quot;.', 'allow_private_albums', 0), //cpg1.3.0
  array('Co to s� pliki cookie?', 'Pliki cookie zawieraj� dane tekstowe zapisywane przez stron� internetow� na Twoim komputerze. <br />Zazwyczaj pozwalaj� u�ytkownikowi opu�ci� stron� i wej�� na ni� ponownie bez konieczno�ci ponownego logowania.', 'offline', 0), //cpg1.3.0
  array('Sk�d mog� pobra� ten program aby umie�ci� go we w�asnym serwisie?', 'Galeria Coppermine jest darmow� galeri� multimedi�w, rozpowszechnian� na licencji GNU GPL. Zawiera rozbudowan� funkcjonalno�� i zosta�a przygotowana na r�ne platformy. Odwied� <a href="http://coppermine.sf.net/">stron� domow� Coppermine</a> by dowiedzie� si� wi�cej i �ci�gn�� najnowsz� wersj� programu.', 'offline', 0), //cpg1.3.0

  'Nawigowanie po stronie', //cpg1.3.0
  array('Co to jest &quot;Lista album�w&quot;?', 'Lista album�w pokazuje ca�� kategori�, w kt�rej obecnie si� znajdujesz wraz z ��czami do ka�dego albumu. Je�eli nie znajdujesz si� obecnie w �adnej kategorii, lista album�w wy�wietli ca�� zawarto�� galerii wraz z ��czami do kategorii, kt�re zawiera. Miniatury mog� by� tak�e ��czami do kategorii..', 'offline', 0), //cpg1.3.0
  array('Czym jest &quot;Moja Galeria&quot;?', 'Opcja ta umo�liwia u�ytkownikowi serwisu tworzenie w�asnej galerii, dodawanie, kasowanie i modyfikowanie album�w, oraz przesy�anie do nich plik�w.', 'allow_private_albums', 0), //cpg1.3.0
  array('Czym r�ni si� &quot;Tryb Administracyjny&quot; od &quot;Trybu u�ytkownika&quot;?', 'Tryb administracyjny umo�liwia zarz�dzanie albumami znajduj�cymi si� w Twojej prywatnej galerii (a tak�e innymi albumami - je�eli zezwoli� na to administrator).', 'allow_private_albums', 0), //cpg1.3.0
  array('Co to jest &quot;Przes�anie pliku&quot;?', 'To mo�liwo�� przes�ania pliku (jego rodzaj i wielko�� s� okre�lone przez administratora) do wybranych album�w', 'allow_private_albums', 0), //cpg1.3.0
  array('Co to s� &quot;Ostatnie aktualizacje&quot;?', 'Umo�liwiaj� przejrzenie ostatnio dodanych do strony plik�w.', 'offline', 0), //cpg1.3.0
  array('Co to s� &quot;Ostatnie komentarze&quot;?', 'Ta opcja pokazuje ostatnio dodane przez u�ytkownik�w komentarze, oraz pliki kt�rych dotycz�.', 'offline', 0), //cpg1.3.0
  array('Czym jest opcja What\'s &quot;Najpopularniejsze&quot;?', 'Opcja ta pokazuje najcz�ciej ogl�dane pliki (dotyczy wszystkich u�ytkownik�w - zar�wno tych zalogowanych jak i niezalogowanych).', 'offline', 0), //cpg1.3.0
  array('Co to jest &quot;Top Lista&quot;?', 'Top lista zawiera list� najwy�ej ocenianych plik�w wraz z ich �redni� ocen� (np. pi�ciu u�ytkownik�w g�osuje z ocen� <img src="images/rating3.gif" width="65" height="14" border="0" alt="" />: plikowi zostanie przyznana ocena <img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> ;lub w�r�d pi�ciu innych u�ytkownik�w ka�dy daje plikowi ocen� od 1 do 5 (1,2,3,4,5) co spowoduje przyznanie plikowi �redniej oceny <img src="images/rating3.gif" width="65" height="14" border="0" alt="" /> .)<br />Klasyfikacja przedstawia si� nast�puj�co: od <img src="images/rating5.gif" width="65" height="14" border="0" alt="najlepsze" /> (najlepsze) do <img src="images/rating0.gif" width="65" height="14" border="0" alt="najgorsze" /> (najgorsze).', 'offline', 0), //cpg1.3.0
  array('Czym s� &quot;Ulubione&quot;?', 'Ta opcja pozwala u�ytkownikowi przechowywa� odno�niki do ulubionych plik�w z galerii w pliku cookie zapisywanym przez przegl�dark�.', 'offline', 0), //cpg1.3.0
);



// ------------------------------------------------------------------------- //
// File forgot_passwd.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('FORGOT_PASSWD_PHP')) $lang_forgot_passwd_php = array(
  'forgot_passwd' => 'Przypomnienie has�a', //cpg1.3.0
  'err_already_logged_in' => 'Jeste� ju� zalogowany!', //cpg1.3.0
  'enter_username_email' => 'Podaj nazw� u�ytkownika lub adres e-mail', //cpg1.3.0
  'submit' => 'dalej', //cpg1.3.0
  'failed_sending_email' => 'E-mail z przypomnieniem has�a nie mo�e zosta� wys�any!', //cpg1.3.0
  'email_sent' => 'E-mail z nazw� u�ytkownika i has�em zosta� wys�any na adres %s', //cpg1.3.0
  'err_unk_user' => 'Wybrany u�ytkownik nie istnieje!', //cpg1.3.0
  'passwd_reminder_subject' => '%s - Przypomnienie has�a', //cpg1.3.0
  'passwd_reminder_body' => 'Poprosi�e� o przes�anie Twoich danych u�ytkownika:
Nazwa u�ytkownika: %s
Has�o: %s
Kliknij %s aby si� zalogowa�.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
  'group_name' => 'Nazwa grupy',
  'disk_quota' => 'Miejsce na dane',
  'can_rate' => 'Mo�e ocenia� pliki', //cpg1.3.0
  'can_send_ecards' => 'Mo�e wysy�a� e-kartki',
  'can_post_com' => 'Mo�e zamieszcza� komentarze',
  'can_upload' => 'Mo�e przesy�a� pliki', //cpg1.3.0
  'can_have_gallery' => 'Mo�e mie� galeri� osobist�',
  'apply' => 'Zastosuj zmiany',
  'create_new_group' => 'Stw�rz now� grup�',
  'del_groups' => 'Skasuj zaznaczon� grup�/y',
  'confirm_del' => 'Uwaga: je�eli skasujesz t� grup� jej cz�onkowie zostan� przeniesieni do grupy \'Zarejestrowani\'!\n\nKontynuowa�?',
  'title' => 'Zarz�dzanie grupami',
  'approval_1' => 'Zgoda na pub. upl.(1)',
  'approval_2' => 'Zgoda na priv. upl.(2)',
  'upload_form_config' => 'Konfiguracja formularza przesy�ania', //cpg1.3.0
  'upload_form_config_values' => array( 'Przesy�anie pojedynczych plik�w', 'Przesy�anie wielu plik�w', 'Przesy�anie URI', 'Przesy�anie ZIP', 'Plik-URI', 'Plik-ZIP', 'URI-ZIP', 'Plik-URI-ZIP'), //cpg1.3.0
  'custom_user_upload'=>'U�ytkownik mo�e wybiera� ilo�� p�l do przesy�ania?', //cpg1.3.0
  'num_file_upload'=>'Maksymalna/dok�adna ilo�� p�l przesy�ania plik�w', //cpg1.3.0
  'num_URI_upload'=>'Maksymalna/dok�adna ilo�� p�l przesy�ania URI', //cpg1.3.0
  'note1' => '<b>(1)</b> Przesy�anie zdj�� do albumu publicznego wymaga zgody administratora',
  'note2' => '<b>(2)</b> Przesy�anie zdj�� do albumu u�ytkownika wymaga zgody administratora',
  'notes' => 'Uwagi'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
  'welcome' => 'Witaj !',
);

$lang_album_admin_menu = array(
  'confirm_delete' => 'Czy na pewno chcesz skasowa� ten album? \\nZostan� skasowane r�wnie� wszystkie pliki i komentarze.', //js-alert //cpg1.3.0
  'delete' => 'KASUJ',
  'modify' => 'W�A�CIWO�CI',
  'edit_pics' => 'EDYCJA PLIK�W', //cpg1.3.0
);

$lang_list_categories = array(
  'home' => 'Strona g��wna',
  'stat1' => 'pliki: <b>[pictures]</b>, albumy: <b>[albums]</b>, kategorie: <b>[cat]</b>, komentarze: <b>[comments]</b>, ods�ony: <b>[views]</b>', //cpg1.3.0
  'stat2' => 'pliki: <b>[pictures]</b>, albumy: <b>[albums]</b>, ods�ony: <b>[views]</b>', //cpg1.3.0
  'xx_s_gallery' => 'galeria %s', //cpg1.3.0
  'stat3' => 'pliki: <b>[pictures]</b>, albumy: <b>[albums]</b>, komentarze: <b>[comments]</b>, ods�ony: <b>[views]</b>', //cpg1.3.0
);

$lang_list_users = array(
  'user_list' => 'Lista u�ytkownik�w',
  'no_user_gal' => 'Galerie u�ytkownik�w nie istniej� lub nie masz do nich dost�pu',
  'n_albums' => 'album�w: %s',
  'n_pics' => 'plik�w: %s',  //cpg1.3.0
);

$lang_list_albums = array(
  'n_pictures' => 'plik�w: %s', //cpg1.3.0
  'last_added' => ', ostatnio dodany: %s',
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
  'login' => 'Logowanie',
  'enter_login_pswd' => 'Podaj nazw� u�ytkownika i has�o aby si� zalogowa�',
  'username' => 'Nazwa u�ytkownika',
  'password' => 'Has�o',
  'remember_me' => 'Pami�taj mnie',
  'welcome' => 'Witaj %s ...',
  'err_login' => '*** Logowanie nieudane, spr�buj ponownie ***',
  'err_already_logged_in' => 'Jeste� ju� zalogowany/a!',
  'forgot_password_link' => 'Zapomnia�em has�a', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
  'logout' => 'Wylogowywanie',
  'bye' => 'Pa pa %s ...',
  'err_not_loged_in' => 'Nie jeste� zalogowany/a!',
);

// ------------------------------------------------------------------------- //
// File phpinfo.php //cpg1.3.0
// ------------------------------------------------------------------------- //

if (defined('PHPINFO_PHP')) $lang_phpinfo_php = array(
  'php_info' => 'PHP info', //cpg1.3.0
  'explanation' => 'Dane generowane przez funkcj� <a href="http://www.php.net/phpinfo">phpinfo()</a>, wy�wietlane przez Coppermine (obcinanie wyj�cia przy prawym rogu).', //cpg1.3.0
  'no_link' => 'Ogl�danie tych informacji przez osoby nieuprawnione mo�e stanowi� zagro�enie bezpiecze�stwa, dlatego te� stron� t� mo�na ogl�da� tylko po zalogowaniu si� jako administrator. Nie mo�esz poda� ��cza do tej strony innym u�ytkownikom, nie uzyskaj� oni dost�pu do strony.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //
if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
  'upd_alb_n' => 'Uaktualnij album %s',
  'general_settings' => 'Ustawienia og�lne',
  'alb_title' => 'Tytu� albumu',
  'alb_cat' => 'Kategoria albumu',
  'alb_desc' => 'Opis albumu',
  'alb_thumb' => 'Miniatury',
  'alb_perm' => 'Uprawnienia albumu',
  'can_view' => 'Mo�e by� ogl�dany przez',
  'can_upload' => 'Go�cie mog� przesy�a� pliki',
  'can_post_comments' => 'Go�cie mog� dodawa� komentarze',
  'can_rate' => 'Go�cie mog� ocenia� pliki',
  'user_gal' => 'Galeria u�ytkownika',
  'no_cat' => '* Bez kategorii *',
  'alb_empty' => 'Album jest pusty',
  'last_uploaded' => 'Ostatnio przes�ane',
  'public_alb' => 'Wszyscy (album publiczny)',
  'me_only' => 'Tylko ja',
  'owner_only' => 'Tylko w�a�ciciel albumu: (%s)',
  'groupp_only' => 'Cz�onkowie grupy: \'%s\'',
  'err_no_alb_to_modify' => 'Nie mo�na modyfikowa� �adnego albumu w bazie.',
  'update' => 'Uaktualnij album', //cpg1.3.0
  'notice1' => '(*) w zale�no�ci od ustawie� %sgrupy%',
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
  'already_rated' => 'Niestety, ju� ocenia�e� ten plik', //cpg1.3.0
  'rate_ok' => 'Tw�j g�os zosta� zarejestrowany',
  'forbidden' => 'Nie mo�esz ocenia� swoich w�asnych plik�w.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
Administratorzy serwisu {SITE_NAME} dok�adaj� wszelkich stara� by usuwa� lub zmienia� publikowane przez u�ytkownik�w tre�ci og�lnie przyj�te za obra�liwe, �ami�ce prawo, lub obsceniczne, jest jednak niemo�liwe by przejrze� ka�dy post. Dlatego musisz zobowi�za� si�, �e wszelkie opinie, materia�y i komentarze jakie zamie�cisz na stronach serwisu reprezentuj� wy��cznie Twoje pogl�dy, a nie pogl�dy os�b zarz�dzaj�cych serwisem.<br />
<br />
Niniejszym zobowi�zujesz si�, by nie zamieszcza� na stronach serwisu {SITE_NAME} materia��w obra�liwych, obscenicznych, wulgarnych, pornograficznych, nawo�uj�cych do u�ycia przemocy, stanowi�cych zagro�enie dla bezpiecze�stwa publicznego, oraz innych materia��w, kt�rych przedstawienie na stronach serwisu mog�oby stanowi� z�amanie obowi�zuj�cego prawa. Przyjmujesz do wiadomo�ci, �e administrator lub moderatorzy serwisu {SITE_NAME} maj� prawo do edycji i usuwania dowolnych zamieszczonych przez Ciebie tre�ci niezgodnych z tym regulaminem. Jako u�ytkownik serwisu zgadzasz si� na przechowywanie informacji niezb�dnych do obs�ugi Twojego konta w bazie danych serwisu, oraz otrzymujesz prawo do ich modyfikacji oraz usuni�cia w dowolnej chwili. W tym celu nale�y skontaktowa� si� z administratorem serwisu. Informacje te nie b�d� przekazywane osobom trzecim bez Twojej zgody, jednak�e administratorzy serwisu nie mog� ponosz� odpowiedzialno�ci za kradzie� tych informacji w wypadku dzia�a� os�b nieuprawnionych.<br />
<br />
Serwis {SITE_NAME} u�ywa plik�w cookie do przechowywania informacji na Twoim komputerze. S�u�� one jedynie do poprawienia komfortu przegl�dania zawarto�ci serwisu. Tw�j adres e-mail jest u�ywany jedynie do wysy�ania potwierdze� dotycz�cych rejestracji w serwisie. <br />
<br />
Klikni�cie znajduj�cego si� poni�ej przycisku 'Zgadzam si�' oznacza zgod� na przedstawiony wy�ej regulamin serwisu.
EOT;


$lang_register_php = array(
  'page_title' => 'Rejestrowanie u�ytkownika',
  'term_cond' => 'Warunki korzystania z serwisu',
  'i_agree' => 'Zgadzam si�',
  'submit' => 'Wykonaj rejestracj�',
  'err_user_exists' => 'Nazwa u�ytkownika kt�r� wybra�e� ju� istnieje. Wybierz inn�',
  'err_password_mismatch' => 'Has�a nie pasuj� do siebie. Wpisz je ponownie',
  'err_uname_short' => 'Nazwa u�ytkownika musi mie� co najmniej 2 znaki',
  'err_password_short' => 'Has�o musi mie� co najmniej 2 znaki',
  'err_uname_pass_diff' => 'Nazwa u�ytkownika i has�o musz� si� od siebie r�ni�',
  'err_invalid_email' => 'Adres e-mail jest niepoprawny',
  'err_duplicate_email' => 'W bazie jest ju� u�ytkownik o podanym przez Ciebie adresie e-mail',
  'enter_info' => 'Wprowad� informacje potrzebne do rejestracji',
  'required_info' => 'Informacje wymagane',
  'optional_info' => 'Informacje opcjonalne',
  'username' => 'Nazwa u�ytkownika',
  'password' => 'Has�o',
  'password_again' => 'Wprowad� ponownie has�o',
  'email' => 'E-mail',
  'location' => 'Lokalizacja',
  'interests' => 'Zainteresowania',
  'website' => 'Strona domowa',
  'occupation' => 'Zaj�cie / zaw�d',
  'error' => 'B��D',
  'confirm_email_subject' => '%s - Informacja o rejestracji',
  'information' => 'Informacja',
  'failed_sending_email' => 'E-mail z potwierdzeniem nie mo�e by� wys�any!',
  'thank_you' => 'Dzi�kujemy za rejestracj�.<br /><br />Na podany przez Ciebie adres e-mail zosta� wys�any list z pro�b� o potwierdzenie.',
  'acct_created' => 'Konto zosta�o utworzone. Mo�esz ju� zalogowa� si� podaj�c wybran� wczesniej nazw� u�ytkownika, oraz has�o',
  'acct_active' => 'Konto jest ju� aktywne. Mo�esz ju� zalogowa� si� podaj�c wybran� wczesniej nazw� u�ytkownika, oraz has�o',
  'acct_already_act' => 'Twoje konto zosta�o ju� aktywowane!',
  'acct_act_failed' => 'Te konto nie mo�e by� aktywowane!',
  'err_unk_user' => 'Podany u�ytkownik nie istnieje!',
  'x_s_profile' => 'profil: %s',
  'group' => 'Grupa',
  'reg_date' => 'Do��czy�/a',
  'disk_usage' => 'U�yte miejsce',
  'change_pass' => 'Zmie� has�o',
  'current_pass' => 'Bie��ce has�o',
  'new_pass' => 'Nowe has�o',
  'new_pass_again' => 'Podaj ponownie nowe has�o',
  'err_curr_pass' => 'Bie��ce has�o jest niepoprawne',
  'apply_modif' => 'Zastosuj zmiany',
  'change_pass' => 'Zmia� moje has�o',
  'update_success' => 'Tw�j profil zosta� uaktualniony',
  'pass_chg_success' => 'Twoje has�o zosta�o zmienione',
  'pass_chg_error' => 'Twoje has�o nie zosta�o zmienione',
  'notify_admin_email_subject' => '%s - powiadomienie o rejestracji', //cpg1.3.0
  'notify_admin_email_body' => 'W galerii zarejestrowa� si� nowy u�ytkownik o nazwie "%s"', //cpg1.3.0
);

$lang_register_confirm_email = <<<EOT
Dzi�kujemy za rejestracj� w witrynie {SITE_NAME}

Twoja nazwa u�ytkownika to: "{USER_NAME}"
Twoje has�o to: "{PASSWORD}"

Aby aktywowa� konto kliknij na poni�szy link albo skopiuj go
i wklej do swojej przegl�darki internetowej.

{ACT_LINK}

Pozdrowienia,

Zesp� strony {SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
  'title' => 'Przegl�daj komentarze',
  'no_comment' => 'Nie ma komentarzy do przegl�dania',
  'n_comm_del' => 'Skasowano komentarzy: %s',
  'n_comm_disp' => 'Ilo�� komentarzy do wy�wietlenia',
  'see_prev' => 'Zobacz poprzednie',
  'see_next' => 'Zobacz nast�pne',
  'del_comm' => 'Skasuj wybrane komentarze',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
  0 => 'Wyszukiwarka zdj��',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
  'page_title' => 'Szukaj plik�w', //cpg1.3.0
  'select_dir' => 'Wybierz katalog',
  'select_dir_msg' => 'Wybrana funkcja umo�liwia wsadowe dodawanie do galerii zdj�� kt�re zosta�y przes�ane na serwer.<br /><br />Wybierz katalog do kt�rego zosta�y przes�ane wybrane pliki', //cpg1.3.0
  'no_pic_to_add' => 'Nie ma pliku do dodania', //cpg1.3.0
  'need_one_album' => 'U�ycie tej funckji wymaga istnienia przynajmniej jednego albumu do kt�rego masz uprawnienia',
  'warning' => 'Uwaga',
  'change_perm' => 'skrypt nie mo�e zapisywa� plik�w do wybranego katalogu. Zmie� ustawienia na 755 lub 777 zanim spr�bujesz doda� pliki!', //cpg1.3.0
  'target_album' => '<b>Zapisuje zdj�cia do katalogu &quot;</b>%s<b>&quot; </b>%s', //cpg1.3.0
  'folder' => 'Katalog',
  'image' => 'plik',
  'album' => 'Album',
  'result' => 'Wynik',
  'dir_ro' => 'Nie mo�na zapisa�. ',
  'dir_cant_read' => 'Nie mo�na odczyta�. ',
  'insert' => 'Dodawanie nowych plik�w do galerii', //cpg1.3.0
  'list_new_pic' => 'Lista nowych plik�w', //cpg1.3.0
  'insert_selected' => 'Wstaw wybrane pliki', //cpg1.3.0
  'no_pic_found' => 'Nie znaleziono nowych plik�w', //cpg1.3.0
  'be_patient' => 'Prosz� o cierpliwo��, skrypt potrzebuje czasu na dodanie zdj��', //cpg1.3.0
  'no_album' => 'nie wybrano albumu',  //cpg1.3.0
  'notes' =>  '<ul>'.
  '<li><b>OK</b> : oznacza, �e zdj�cie zosta�o dodane'.
  '<li><b>DP</b> : oznacza, �e zdj�cie jest zduplikowane i istnieje ju� w bazie'.
  '<li><b>PB</b> : oznacza brak mo�liwo�ci dodania pliku. Sprawd� swoje uprawnienia do zapisywania katalog�w i plik�w'.
  '<li><b>NA</b> : oznacza, �e nie wybra�e� albumu do kt�rego mia�yby trafi� pliki, kliknij \'<a href="javascript:history.back(1)">tutaj</a>\' i wybierz album. Je�eli nie masz jeszcze albumu, <a href="albmgr.php">utw�rz tutaj nowy</a></li>'.
  '<li>Je�eli \'znaki\' OK, DP, PB nie pojawiaj� si�, kliknij na pliku aby otrzyma� komunikat generowany przez PHP'.
  '<li>Je�eli przegl�darka nie za�adowa�a strony, wci�nij klawisz F5 aby j� od�wie�y�'.
  '</ul>', //cpg1.3.0
  'select_album' => 'wybierz album', //cpg1.3.0
  'check_all' => 'Zaznacz wszystkie', //cpg1.3.0
  'uncheck_all' => 'Odznacz wszystkie', //cpg1.3.0
);


// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //

// Void

// ------------------------------------------------------------------------- //
// File banning.php
// ------------------------------------------------------------------------- //

if (defined('BANNING_PHP')) $lang_banning_php = array(
  'title' => 'Banuj U�ytkownik�w', 
  'user_name' => 'Nazwa u�ytkownika', 
  'ip_address' => 'Adres IP', 
  'expiry' => 'Aktywny do daty<br>(pusta - na sta�e)', 
  'edit_ban' => 'Zapisz zmiany', 
  'delete_ban' => 'Kasuj', 
  'add_new' => 'Dodaj nowy ban', 
  'add_ban' => 'Dodaj', 
  'error_user' => 'Nie mo�na znale�� takiego u�ytkownika', //cpg1.3.0
  'error_specify' => 'Musisz okre�li� nazw� u�ytkownika lub address IP', //cpg1.3.0
  'error_ban_id' => 'Niew�a�ciwy ID!', //cpg1.3.0
  'error_admin_ban' => 'Nie mo�na banowa� samego siebie!', //cpg1.3.0
  'error_server_ban' => 'Chcia�e� zabanowa� sw�j w�asny serwer? Hehe, nie mo�na tego robi�...', //cpg1.3.0
  'error_ip_forbidden' => 'Nie mo�na banowa� tego adresu IP - jest nieroute\'owalny!', //cpg1.3.0
  'lookup_ip' => 'Sprawdz adres IP', //cpg1.3.0
  'submit' => 'dalej!', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
  'title' => 'Upload file', //cpg1.3.0
  'custom_title' => 'Spersonalizowany formularz przesy�ania', //cpg1.3.0
  'cust_instr_1' => 'Mo�esz wybra� w�asn� liczb� p�l s�u��cych do przesy�ania plik�w, jednak nie zostanie pokazane ich wi�cej ni� w limicie okre�lonym poni�ej.', //cpg1.3.0
  'cust_instr_2' => 'Personalizacja formularza', //cpg1.3.0
  'cust_instr_3' => 'Ilo�� p�l przesy�ania: %s', //cpg1.3.0
  'cust_instr_4' => 'Pola przesy�ania URI/URL: %s', //cpg1.3.0
  'cust_instr_5' => 'Pola przesy�ania URI/URL:', //cpg1.3.0
  'cust_instr_6' => 'Pola przesy�ania plik�w:', //cpg1.3.0
  'cust_instr_7' => 'Podaj liczb� ka�dego z rodzaj�w p�l przesy�ania plik�w, jakich potrzebujesz. Nast�pnie kliknij \'Dalej\'. ', //cpg1.3.0
  'reg_instr_1' => 'Nieudane tworzenie formularza.', //cpg1.3.0
  'reg_instr_2' => 'Mo�esz przesy�a� pliki przy pomocy poni�szych p�l. Rozmiar plik�w przesy�anych na serwer nie mo�e przekroczy� %s KB ka�dy. Pliki ZIP przes�ane w sekcjach \'Przes�anie pliku\' oraz \'Przes�anie URI/URL\' pozostan� skompresowane.', //cpg1.3.0
  'reg_instr_3' => 'Je�eli chcesz aby spakowane pliki zosta�y zdekompresowane, u�yj pola przesy�ania plik�w w sekcji \'Przesy�anie z rozpakowaniem ZIP\'', //cpg1.3.0
  'reg_instr_4' => 'Przy przesy�aniu plik�w w sekcji Przesy�ania URI/URL, podaj ca�� �cie�k� do pliku, np: http://www.mojastrona.com/images/foto.jpg', //cpg1.3.0
  'reg_instr_5' => 'Po uzupe�nieniu formularza, u�yj przycisku \'Dalej\'.', //cpg1.3.0
  'reg_instr_6' => 'Przesy�anie z rozpakowaniem ZIP:', //cpg1.3.0
  'reg_instr_7' => 'Przesy�anie plik�w:', //cpg1.3.0
  'reg_instr_8' => 'Przesy�anie URI/URL:', //cpg1.3.0
  'error_report' => 'Raport b��d�w', //cpg1.3.0
  'error_instr' => 'Wyst�pi�y b��dy przy nast�puj�cych plikach:', //cpg1.3.0
  'file_name_url' => 'Nazwa pliku/URL', //cpg1.3.0
  'error_message' => 'Wiadomo�� b��du', //cpg1.3.0
  'no_post' => 'Plik nie zosta� przes�any metod� POST.', //cpg1.3.0
  'forb_ext' => 'Zabronione rozszerzenie pliku.', //cpg1.3.0
  'exc_php_ini' => 'Przekroczono wielko�� plku okre�lon� w php.ini.', //cpg1.3.0
  'exc_file_size' => 'Przekroczono wielko�� plku okre�lon� w konfiguracji CPG.', //cpg1.3.0
  'partial_upload' => 'Uda�o si� tylko cz�ciowo przes�a� plik.', //cpg1.3.0
  'no_upload' => 'Nie dosz�o do przes�ania.', //cpg1.3.0
  'unknown_code' => 'Nieznany b��d przesy�ania PHP.', //cpg1.3.0
  'no_temp_name' => 'Nie uda�o si� przes�a� pliku ze wzgl�du na brak tymczasowej nazwy.', //cpg1.3.0
  'no_file_size' => 'Plik nie zawiera danych lub jest uszkodzony', //cpg1.3.0
  'impossible' => 'Nie mo�na przenie�� pliku.', //cpg1.3.0
  'not_image' => 'Plik nie jest obrazem lub jest uszkodzony', //cpg1.3.0
  'not_GD' => 'Brak rozszerzenia GD.', //cpg1.3.0
  'pixel_allowance' => 'Przekroczono rozmiar podany w pikselach.', //cpg1.3.0
  'incorrect_prefix' => 'Niew�a�ciwy prefiks URI/URL', //cpg1.3.0
  'could_not_open_URI' => 'Nie mo�na otworzy� URI.', //cpg1.3.0
  'unsafe_URI' => 'Nie mo�na potwierdzi� bezpiecze�stwa.', //cpg1.3.0
  'meta_data_failure' => 'B��d metadanych', //cpg1.3.0
  'http_401' => '401 - Brak dost�pu', //cpg1.3.0
  'http_402' => '402 - Wymagana op�ata', //cpg1.3.0
  'http_403' => '403 - Dost�p zabroniony', //cpg1.3.0
  'http_404' => '404 - Nie znaleziono', //cpg1.3.0
  'http_500' => '500 - Wewn�trzny b��d serwera', //cpg1.3.0
  'http_503' => '503 - Us�uga niedost�pna', //cpg1.3.0
  'MIME_extraction_failure' => 'nie mo�na okre�li� MIME.', //cpg1.3.0
  'MIME_type_unknown' => 'Nieznany typ MIME', //cpg1.3.0
  'cant_create_write' => 'Nie mo�na stworzy�/zapisa� pliku.', //cpg1.3.0
  'not_writable' => 'Nie mo�na zapisa� do pliku.', //cpg1.3.0
  'cant_read_URI' => 'Nie mo�na czyta� URI/URL', //cpg1.3.0
  'cant_open_write_file' => 'Nie mo�na otworzy� pliku URI do zapisu.', //cpg1.3.0
  'cant_write_write_file' => 'Nie mo�na zapisa� pliku zapisywalnego URI.', //cpg1.3.0
  'cant_unzip' => 'Nie mo�na zdekompresowa�.', //cpg1.3.0
  'unknown' => 'Nieznany b��d', //cpg1.3.0
  'succ' => 'Udane przes�anie', //cpg1.3.0
  'success' => 'Udane przes�anie plik�w: %s.', //cpg1.3.0
  'add' => 'Kliknij \'Continue\' by doda� pliki do album�w.', //cpg1.3.0
  'failure' => 'Nieudane przes�anie', //cpg1.3.0
  'f_info' => 'Informacja o pliku', //cpg1.3.0
  'no_place' => 'Poprzedni plik nie zosta� umieszczony w albumie.', //cpg1.3.0
  'yes_place' => 'Poprzedni plik zosta� umieszczony w albumie.', //cpg1.3.0
  'max_fsize' => 'Maksymalny rozmiar przesy�anego pliku to %s KB',
  'album' => 'Album',
  'picture' => 'Plik', //cpg1.3.0
  'pic_title' => 'Tytu� pliku', //cpg1.3.0
  'description' => 'Opis pliku', //cpg1.3.0
  'keywords' => 'S�owa kluczowe (oddzielone spacjami)',
  'err_no_alb_uploadables' => 'Niestety, nie ma albumu do kt�rego m�g�by� przes�a� pliki', //cpg1.3.0
  'place_instr_1' => 'Prosz� umie�ci� teraz pliki w albumach. Mo�esz teraz tak�e wprowadzi� stosowne informacje o ka�dym z plik�w.', //cpg1.3.0
  'place_instr_2' => 'S� jeszcze pliki wymagaj�ce umieszczenia. Prosz� klikn�� \'Dalej\'.', //cpg1.3.0
  'process_complete' => 'Wszystkie pliki umieszczono w albumach.', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
  'title' => 'Zarz�dzanie u�ytkownikami',
  'name_a' => 'Nazwa rosn�co',
  'name_d' => 'Nazwa malej�co',
  'group_a' => 'Grupa rosn�co',
  'group_d' => 'Grupa malej�co',
  'reg_a' => 'Data rej. rosn�co',
  'reg_d' => 'Data rej. malej�co',
  'pic_a' => 'Liczba plik�w rosn�co',
  'pic_d' => 'Liczba plik�w malej�co',
  'disku_a' => 'U�ycie dysku rosn�co',
  'disku_d' => 'U�ycie dysku malej�co',
  'lv_a' => 'Ostatnie wizyty rosn�co', //cpg1.3.0
  'lv_d' => 'Ostatnie wizyty malej�co', //cpg1.3.0
  'sort_by' => 'Posortuj u�ytkownik�w wg',
  'err_no_users' => 'Tabela u�ytkownik�w jest pusta!',
  'err_edit_self' => 'Nie mo�esz modyfikowa� teraz swojego profilu. Aby to zrobi� kliknij ��cze \'M�j profil\'',
  'edit' => 'EDYTUJ',
  'delete' => 'KASUJ',
  'name' => 'Nazwa u�ytkownika',
  'group' => 'Grupa',
  'inactive' => 'Nieaktywny',
  'operations' => 'Operacje',
  'pictures' => 'Pliki', //cpg1.3.0
   'disk_space' => 'U�yte miejsce / Quota',
  'registered_on' => 'Zerejestrowano',
  'last_visit' => 'Ostatnia wizyta', //cpg1.3.0
  'u_user_on_p_pages' => 'u�ytkownik�w: %d na stronach: %d',
  'confirm_del' => 'Czy na pewno chcesz skasowa� tego u�ytkownika? \\nWszystkie jego pliki i albumy zostan� automatycznie skasowane.', //js-alert //cpg1.3.0
  'mail' => 'E-MAIL',
  'err_unknown_user' => 'Selected user does not exist !',
  'modify_user' => 'Modyfikuj u�ytkownika',
  'notes' => 'Uwagi',
  'note_list' => '<li>Je�eli nie chcesz zmienia� swojego ulubionego has�a teraz, zostaw pole "has�o" puste',
  'password' => 'Has�o',
  'user_active' => 'U�ytkownik jest aktywny',
  'user_group' => 'Grupa u�ytkownik�w',
  'user_email' => 'Adres e-mail u�ytkownika',
  'user_web_site' => 'Strona sieci web u�ytkownika',
  'create_new_user' => 'Utw�rz nowego u�ytkownika',
  'user_location' => 'Lokacja u�ytkownika',
  'user_interests' => 'Zainteresowania',
  'user_occupation' => 'Zaj�cie',
  'latest_upload' => 'Ostatnio przes�ane', //cpg1.3.0
  'never' => 'brak', //cpg1.3.0
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
  'title' => 'Narz�dzia administracyjne (Zmie� rozmiar zdj��)', //cpg1.3.0
  'what_it_does' => 'Do czego to s�u�y', 
  'what_update_titles' => 'Uaktualnia tytu�y nazwami plik�w', 
  'what_delete_title' => 'Kasuje tytu�y', 
  'what_rebuild' => 'Odbudowuje miniatury i zdj�cia po�rednie', 
  'what_delete_originals' => 'Kasuje zdj�cia �r�d�owe, zast�puj�c je zdj�ciami o zmienionych wymiarach', 
  'file' => 'Plik', 
  'title_set_to' => 'tytu�', 
  'submit_form' => 'prze�lij', 
  'updated_succesfully' => 'zaktualizowano', 
  'error_create' => 'B��D tworzenia', 
  'continue' => 'Przetwarzaj wi�cej zdj��', 
  'main_success' => 'Plik %s zosta� ustawiony jako zdj�cie g��wne', //cpg1.3.0
  'error_rename' => 'B��d przy zmiany nazwy z %s na %s', 
  'error_not_found' => 'Plik %s nie zosta� znaleziony', 
  'back' => 'powr�t na stron� g��wn�', 
  'thumbs_wait' => 'Uaktualniam miniatury i/lub zdj�cia o zmienionych wymiarach, prosz� czeka�...', 
  'thumbs_continue_wait' => 'Trwa uaktualnianie miniatur i/lub zdj�� o zmienionych wymiarach...', 
  'titles_wait' => 'Uaktualnianie tytu��w, prosz� czeka�...', 
  'delete_wait' => 'Kasowanie tytu��w, prosz� czeka�...', 
  'replace_wait' => 'Kasowanie orygina��w i zamienianie ich na zdj�cia o zmienionych wymiarach..', 
  'instruction' => 'Szybkie instrukcje', 
  'instruction_action' => 'Wybierz akcj�', 
  'instruction_parameter' => 'Ustaw parametry', 
  'instruction_album' => 'Wybierz album', 
  'instruction_press' => 'Naci�nij %s', 
  'update' => 'Uaktualnij miniatury i/lub zdj�cia o zmienionych wymiarach', 
  'update_what' => 'Do uaktualnienia', 
  'update_thumb' => 'Tylko miniatury', 
  'update_pic' => 'Tylko zdj�cia o zmienionych wymiarach', 
  'update_both' => 'Zar�wno miniatury jak i zdj�cia o zmienionych rozmiarach', 
  'update_number' => 'Ilo�� przetworzonych zdj��/klikni�cie', 
  'update_option' => '(Spr�buj zmniejszy� t� ilo��, je�eli zaobserwujesz problem z timeoutem)',
  'filename_title' => 'Nazwa pliku &rArr; Tytu� pliku', //cpg1.3.0
  'filename_how' => 'Jak modyfikowa� nazw� pliku', 
  'filename_remove' => 'Usu� rozszerzenie .jpg i zamie� _ (podkre�lenie) na spacje', 
  'filename_euro' => 'Zmienia 2003_11_23_13_20_20.jpg na 23/11/2003 13:20', 
  'filename_us' => 'Zmienia 2003_11_23_13_20_20.jpg na 11/23/2003 13:20',
  'filename_time' => 'Zmienia 2003_11_23_13_20_20.jpg na 13:20',
  'delete' => 'Kasowanie tytu��w lub oryginalnych plik�w', //cpg1.3.0
  'delete_title' => 'Kasowanie tytu��w plik�w', //cpg1.3.0
  'delete_original' => 'Skasuj oryginalne zdj�cia', 
  'delete_replace' => 'Kasuje oryginalne zdj�cia zast�puj�c je zdj�ciami zrewymiarowanymi', 
  'select_album' => 'Wybierz album',
  'delete_orphans' => 'Kasuj komentarze do nieistniej�cych plik�w (dotyczy wszystkich album�w)', //cpg1.3.0
  'orphan_comment' => 'znalezionych komentarzy do nieistniej�cych plik�w', //cpg1.3.0
  'delete' => 'Kasuj', //cpg1.3.0
  'delete_all' => 'Kasuj wszystko', //cpg1.3.0
  'comment' => 'Komentarz: ', //cpg1.3.0
  'nonexist' => 'do��czony do nieistniej�cego pliku # ', //cpg1.3.0
  'phpinfo' => 'Wy�wietl phpinfo', //cpg1.3.0
  'update_db' => 'Aktualizacja bazy danych', //cpg1.3.0
  'update_db_explanation' => 'Je�eli usun��e� pliki coppermine, doda�e� jak�� modyfikacj�, lub dokona�e� aktualizacji poprzedniej wersji coppermine, uruchom jednorazowo aktualizacj� bazy danych. Stworzy ona niezb�dne tabele i/lub ustawienia konfiguracyjne w bazie danych coppermine.', //cpg1.3.0
);

?>