<?php
/*
+ ----------------------------------------------------------------------------------------------+
|     e107 website system  : http://e107.org.ru
|     Released under the terms and conditions of the GNU General Public License (http://gnu.org).
|
|     Plugin "my_gallery"
|     Author: Alex ANP alex-anp@ya.ru
+-----------------------------------------------------------------------------------------------+
*/

$lan_file = e_PLUGIN."my_gallery/languages/".e_LANGUAGE.".php";
include_once((file_exists($lan_file) ? $lan_file : e_PLUGIN."my_gallery/languages/English.php"));

$eplug_name = "my_gallery";
$eplug_version = "2.3";
$eplug_author = "Alex ANP";
$eplug_logo = "button.png";
$eplug_url = "http://e107.org.ru";
$eplug_email = "alex-anp@ya.ru";
$eplug_description = MYGAL_L0011."";
$eplug_compatible = "e107 v7.8+";
$eplug_readme = "readme.txt";
$eplug_folder = "my_gallery";
$eplug_menu_name = "my_gallery_menu";
$eplug_conffile = "admin_config.php";
$eplug_icon = $eplug_folder."/images/icon.png";
$eplug_icon_small = $eplug_folder."/images/icon_16.png";
$eplug_caption =  MYGAL_L001;

$eplug_prefs = array(
    "mygallery_folder" => "Gallery",
    "mygallery_foto_in_page" => "16",
    "mygallery_rows" => "4",
    "mygallery_columns" => "4",
    "mygallery_foto_icon_height" => "94",
    "mygallery_foto_icon_width" => "120",
    "mygallery_foto_view_height" => "480",
    "mygallery_foto_view_width" => "580",
    "mygallery_gallery_name" => MYGAL_L001,
    "mygallery_title_image" => "images/title_image.jpg",
    "mygallery_menu_caption" => MYGAL_L002,
    "mygallery_menu_img_size" => "140",
    "mygallery_nav_position" => "0",
    "mygallery_slide_show" => FALSE,
    "mygallery_memo_show" => "2",
    "mygallery_mine_page" => "1",
    "mygallery_mine_cikle" => 3,
    "mygallery_nav_show" => FALSE,
    "mygallery_comments" => FALSE,
    "mygallery_raters" => FALSE,
    "mygallery_hs_theme" => 0,
    "mygallery_img_quality" => 70,
    "mygallery_sort_type" => "NA"
    );


$eplug_table_names = array(
        "my_gallery"
        );

$eplug_tables = array("
CREATE TABLE ".MPREFIX."my_gallery (
img_id INT(9) NOT NULL auto_increment ,
img_name VARCHAR( 250 ) NULL ,
img_description TEXT NULL ,
PRIMARY KEY  (img_id)
) ENGINE = MYISAM ;
", "
ALTER TABLE ".MPREFIX."my_gallery ADD img_title VARCHAR( 250 ) NULL ;
", "
ALTER TABLE ".MPREFIX."my_gallery ADD img_status VARCHAR( 50 ) NULL ;
", "
ALTER TABLE ".MPREFIX."my_gallery ADD img_user VARCHAR( 250 ) NULL ;
");

$eplug_link = TRUE;
$eplug_link_name = MYGAL_L003;
$eplug_link_url = e_PLUGIN."my_gallery/my_gallery.php";

$eplug_done = "Installation Successful...";

$upgrade_add_prefs = "";

$upgrade_remove_prefs = "";

$upgrade_alter_tables = array("
CREATE TABLE ".MPREFIX."my_gallery (
img_id INT(9) NOT NULL auto_increment ,
img_name VARCHAR( 250 ) NULL ,
img_description TEXT NULL ,
PRIMARY KEY  (img_id)
) ENGINE = MYISAM ;
", "
ALTER TABLE ".MPREFIX."my_gallery ADD img_title VARCHAR( 250 ) NULL ;
", "
ALTER TABLE ".MPREFIX."my_gallery ADD img_status VARCHAR( 50 ) NULL ;
", "
ALTER TABLE ".MPREFIX."my_gallery ADD img_user VARCHAR( 250 ) NULL ;
");

$eplug_upgrade_done = "Upgrade Successful...";

?>                                