/*
+---------------------------------------------------------------+
|        Enhanced Custom Pages for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2009
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
global $pref,$cpage_obj,$sql,$PLUGINS_DIRECTORY;
if (!is_object($cpage_obj)) {
	require_once(e_PLUGIN."cpage/includes/cpage_class.php");
	$cpage_obj = new cpage;
}
$retval='';
if($sql->db_Select('cpage_page','cpage_id,cpage_link,cpage_title','where cpage_id='.$parm,'nowhere',false)){
extract($sql->db_Fetch());
$url=SITEURL.$cpage_obj->make_url($cpage_link,$cpage_id,0,$cpage_title);
$retval ="<a href='".$url."' >".$code_text_par."</a>";
}

return $retval;