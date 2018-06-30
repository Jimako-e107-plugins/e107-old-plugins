<?php
/*
+---------------------------------------------------------------+
|	e107 website system
| http://e107.org
|	/image_gallery/myfuncs.php
|
| Revision: 0.9.6.2
| Date: 2008/02/15
| Author: Krassswr
|
|	krassswr@abv.bg
|
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
function show_menu($cpage) {

  $var['Config']['text'] = image_gallery_Lanadmin;
  $var['Config']['link'] = "admin_config.php";
  $var['addcat']['link'] = "admin_add_category.php";
  $var['addcat']['text'] = image_gallery_cat;
  $var['Prefs']['text'] = image_gallery_pref;
  $var['Prefs']['link'] = "admin_prefs.php";
  $var['Comment']['text'] = image_gallery_comm;
  $var['Comment']['link'] = "admin_comment_editor.php";
  $var['Readme']['text'] = image_gallery_readme;
  $var['Readme']['link'] = "admin_readme.php";

  show_admin_menu("Admin menu", $cpage, $var);
}

?>