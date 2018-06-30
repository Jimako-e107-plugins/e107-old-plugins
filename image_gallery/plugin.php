<?php
/*
+---------------------------------------------------------------+
|	e107 website system
| http://e107.org
|	/image_gallery/plugin.php
|
| Revision: 0.9.7
| Date: 2008/02/15
| Author: Krassswr and Sanata Vopilif
|
|	krassswr@abv.bg
|
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

$eplug_name = "Image Gallery";
$eplug_version = "0.9.7.1";
$eplug_author = "Krassswr";
$eplug_folder = "image_gallery";
$eplug_icon = $eplug_folder."/images/icon_32.png";
$eplug_icon_small = $eplug_folder."/images/icon_16.png";
$eplug_url = "http://ustrem-bg.com";
$eplug_email = "krassswr@gmail.com";
$eplug_description = "Image Gallery for your pictures. Authors Krassswr, Sanata Vopilif, Akira";
$eplug_compatible = "e107v0.7+";
$eplug_readme = "admin_readme.php";
$eplug_compliant = FALSE;
$eplug_menu_name = "image_gallery_menu";
$eplug_conffile = "admin_config.php";
$eplug_caption = "Configure Image Gallery Form";
$eplug_done = "Installation Successful...";
$eplug_upgrade_done = "Upgrade successful...";
$eplug_link = TRUE;
$eplug_link_name = "Image Gallery";
$eplug_link_url = "e107_plugins/image_gallery/image_gallery.php";

if (!function_exists('image_gallery_install')) {
    function image_gallery_install()
    {
        $script 	= "plugin.php";
        if (strpos( PHP_OS, 'WIN' ) === 0)
        {
          $t1 = $_SERVER["DOCUMENT_ROOT"];
          $t1 .= $_SERVER["PHP_SELF"];
          $t1 = ereg_replace("plugin.php", '', "$t1");
          $t1 = str_replace("e107_admin", "e107_plugins", $t1);
          //$url_base = $t1;
          return $t1;
        }
        else
        { $url_base = ereg_replace("$script", '', "$_SERVER[SCRIPT_FILENAME]");
          $url_base = str_replace("e107_admin", "e107_plugins", $url_base);
          $url_base = ereg_replace("plugin.php", '', "$url_base");
          return $url_base;}
    }
}
if (!function_exists('image_gallery_upgrade')) {
    function image_gallery_upgrade()
    {
        $script 	= "plugin.php";
        if (strpos( PHP_OS, 'WIN' ) === 0)
        {
          $t1 = $_SERVER["DOCUMENT_ROOT"];
          $t1 .= $_SERVER["PHP_SELF"];
          $t1 = ereg_replace("plugin.php", '', "$t1");
          $t1 = str_replace("e107_admin", "e107_plugins", $t1);
          //$url_base = $t1;
          return $t1;
        }
        else
        { $url_base = ereg_replace("$script", '', "$_SERVER[SCRIPT_FILENAME]");
          $url_base = str_replace("e107_admin", "e107_plugins", $url_base);
          $url_base = ereg_replace("plugin.php", '', "$url_base");
          return $url_base;}
    }
}

if(function_exists('image_gallery_install'))
{
    $url_base = image_gallery_install();
}
elseif(function_exists('image_gallery_upgrade'))
{
    $url_base = image_gallery_upgrade();
}

$eplug_prefs = array(
	"img_ALBUM_IMG_DIR" => $url_base.'image_gallery/images/album/',
	"img_GALLERY_IMG_DIR" => $url_base.'image_gallery/images/gallery/',
	"img_THUMBNAIL_WIDTH" => "100",
    "img_MAXIMG_WIDTH" => "400",
    "img_MAXIMG_HIGHT" => "400",
    "img_albumPerPage" => "12",
    "img_imagePerPage" => "12",
    "img_colsPerRow" => "4",
    "img_commentsPerPage" => "12",
    "img_userclass" =>"",
    "img_enablecomments" => "1"
 );


$upgrade_add_prefs = array (
    "img_ALBUM_IMG_DIR" => $url_base.'image_gallery/images/album/',
    "img_GALLERY_IMG_DIR" => $url_base.'image_gallery/images/gallery/',
    "img_THUMBNAIL_WIDTH" => "100",
    "img_MAXIMG_WIDTH" => "400",
    "img_MAXIMG_HIGHT" => "400",
    "img_albumPerPage" => "12",
    "img_imagePerPage" => "12",
    "img_colsPerRow" => "4",
    "img_commentsPerPage" => "12",
    "img_userclass" =>"",
    "img_enablecomments" => "1"
);

// List of sql requests to create tables -----------------------------------------------------------------------------

$eplug_table_names = array(
    "tbl_album",
	"tbl_image",
    "tbl_comment",
    "tbl_category"
    );

$eplug_tables = array(
"CREATE TABLE ".MPREFIX."tbl_album (
al_id INT NOT NULL AUTO_INCREMENT,
al_name VARCHAR(64) NOT NULL,
al_description TEXT NOT NULL,
al_image VARCHAR(64) NOT NULL,
al_date DATETIME NOT NULL,
al_author varchar(64) NOT NULL default '',
al_cat_id int(11) NOT NULL default '1',
PRIMARY KEY(al_id)
)TYPE=MyISAM;",

"CREATE TABLE ".MPREFIX."tbl_image (
  im_id int(11) NOT NULL auto_increment,
  im_album_id int(11) NOT NULL default '0',
  im_title varchar(64) NOT NULL default '',
  im_description text NOT NULL,
  im_view int(11) NOT NULL default '0',
  im_image varchar(60) NOT NULL default '',
  im_thumbnail varchar(60) NOT NULL default '',
  im_date datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (im_id)
) TYPE=MyISAM;",

"CREATE TABLE ".MPREFIX."tbl_comment (
  index_comment INT NOT NULL AUTO_INCREMENT,
  im_id INT NOT NULL default '0',
  im_id_comment TEXT NOT NULL,
  im_author varchar(64) NOT NULL default '',
  im_author_id INT unsigned NOT NULL default '0',
  im_author_ip varchar(20) NOT NULL default '',
  comment_datestamp datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (index_comment)
)TYPE=MyISAM;",

"CREATE TABLE ".MPREFIX."tbl_category (
  cat_id int(11) NOT NULL auto_increment,
  cat_name char(255) default NULL,
  cat_description char(255) default NULL,
  PRIMARY KEY  (cat_id)
)TYPE=MyISAM;"
);

$upgrade_alter_tables = array(
"INSERT INTO ".MPREFIX."tbl_category SET cat_name='default', cat_description='default'",
);
?>
