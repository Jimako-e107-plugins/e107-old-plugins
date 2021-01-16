global $tp;

/*
+---------------------------------------------------------------+
|   googletranslate _menu
|	Copyright Father Barry 2006 - 2008
|   Released under the terms and conditions of the
|   GNU General Public License (http://gnu.org).
|   Suitable for e107 v76+
+---------------------------------------------------------------+
*/
require_once(e_PLUGIN.'googletranslate_menu/includes/google_trans_class.php');
include_lan(e_PLUGIN . "googletranslate_menu/languages/" . e_LANGUAGE . ".php");
if (!is_object($gtrans_obj)) {
	$gtrans_obj=new google_translate;
}
$res = $gtrans_obj->show_flags();
return $res;
include_lan(e_PLUGIN . "googletranslate_menu/languages/" . e_LANGUAGE . ".php");
