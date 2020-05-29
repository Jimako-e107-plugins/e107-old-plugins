<?php
/*
+---------------------------------------------------------------+
| JSHelper by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/jshelpers/admin_prefs.php,v $
| $Revision: 1.1 $
| $Date: 2008/03/26 22:24:27 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
if (!getperms("P")) {
   // No permissions set, redirect to site front page
   header("location:".e_BASE."index.php");
   exit;
}
require_once(e_ADMIN."auth.php");
require_once("constants.php");
require_once("admin_constants.php");

$pageid  = JSHELPER_LAN_ADMIN_01;
$title   = JSHELPER_LAN_ADMIN_01;

$jshelper_prefs = array();

if ($tmp = $sql->db_Select("core", "e107_value", "e107_name='jshelper_prefs'")) {
   $tmp = $sql->db_Fetch();
   $jshelper_prefs = unserialize($tmp["e107_value"]);
}

if ($_POST['jshelper_prefs']) {
	$jshelper_prefs['jshelper_file_serving'] = $_POST['jshelper_file_serving'];
	$tmp = serialize($jshelper_prefs);
	if (!($ret = $sql->db_Update("core", "e107_value='$tmp' WHERE e107_name='jshelper_prefs'"))) {
	   echo "<br/>";
	   if (!($ret = $sql->db_Insert("core", "'jshelper_prefs','$tmp'"))) {
	      $ns->tablerender("", "<div style='text-align:center'>".mysql_error()."</b></div>");
	   }
	}
	if ($ret) {
	   $ns->tablerender("", "<div style='text-align:center'><b>".LAN_SETSAVED."</b></div>");
	}
}


$text    = "
   <form id='jshelper_admin_page_form' action='admin_prefs.php' method='post'>
   <div id='jshelper_admin_page'>
      <input type='hidden' name='jshelper_prefs' value='1'/>
   ";

$style = e_QUERY == "" ? "" : " style='display:none;'";
$checked0 = !(isset($jshelper_prefs['jshelper_file_serving'])) || $jshelper_prefs['jshelper_file_serving'] == JSHELPER_FILE_SERVING_NORM ? " checked='checked'" : "";
$checked1 = $jshelper_prefs['jshelper_file_serving'] == JSHELPER_FILE_SERVING_GZIP ? " checked='checked'" : "";
$checked2 = $jshelper_prefs['jshelper_file_serving'] == JSHELPER_FILE_SERVING_CONC ? " checked='checked'" : "";
$checked3 = $jshelper_prefs['jshelper_file_serving'] == JSHELPER_FILE_SERVING_COMB ? " checked='checked'" : "";

$text   .= "
      <div class='fcaption accordion_title' id='".JSHELPER_ADMIN_PAGE_01_ID."'>".JSHELPER_LAN_ADMIN_PAGE_01."</div>
      <div class='accordion_content'{$style}>
         <p>".JSHELPER_LAN_ADMIN_PAGE_01_INTRO."</p>
         <p>
            <label for='jshelper_file_serving_norm'><input type='radio' name='jshelper_file_serving' value='".JSHELPER_FILE_SERVING_NORM."' id='jshelper_file_serving_norm'{$checked0}/>default</label>
            <label for='jshelper_file_serving_gzip'><input type='radio' name='jshelper_file_serving' value='".JSHELPER_FILE_SERVING_GZIP."' id='jshelper_file_serving_gzip'{$checked1}/>gzip/x_gzip</label>
            <label for='jshelper_file_serving_conc'><input type='radio' name='jshelper_file_serving' value='".JSHELPER_FILE_SERVING_CONC."' id='jshelper_file_serving_conc'{$checked2}/>concatenated</label>
            <label for='jshelper_file_serving_comb'><input type='radio' name='jshelper_file_serving' value='".JSHELPER_FILE_SERVING_COMB."' id='jshelper_file_serving_comb'{$checked3}/>combined</label>
         </p>
         <div>
            <p id='jshelper_file_serving_norm_info'>".JSHELPER_LAN_ADMIN_PAGE_01_NORM."</p>
            <p id='jshelper_file_serving_gzip_info' style='display:none;'>".JSHELPER_LAN_ADMIN_PAGE_01_GZIP."</p>
            <p id='jshelper_file_serving_conc_info' style='display:none;'>".JSHELPER_LAN_ADMIN_PAGE_01_CONC."</p>
            <p id='jshelper_file_serving_comb_info' style='display:none;'>".JSHELPER_LAN_ADMIN_PAGE_01_COMB."</p>
         </div>
      </div>
   ";

$style = e_QUERY == "98" ? "" : " style='display:none;'";
$text   .= "
      <div class='fcaption accordion_title' id='".JSHELPER_ADMIN_PAGE_98_ID."'>".JSHELPER_LAN_ADMIN_PAGE_98."</div>
      <div class='accordion_content'{$style}>
         <p>Includes JavaScript libraries and frameworks for use by e107 plugins.
         Use normal e107 plugin installtion procedures to install.</p>
         <p>Currently included are:</p>
         <ul>
            <li>Firebug Lite (<a href='http://www.getfirebug.com/' rel='external'>http://www.getfirebug.com/</a>)</li>
            <li>Prototip (<a href='http://www.nickstakenburg.com/projects/prototip/' rel='external'>http://www.nickstakenburg.com/projects/prototip/</a>)</li>
            <li>Prototype (<a href='http://www.prototypejs.org/' rel='external'>http://www.prototypejs.org/</a>)</li>
            <li>script.aculo.us (<a href='http://script.aculo.us/' rel='external'>http://script.aculo.us/</a>)</li>
            <li>Tablekit (<a href='http://www.millstream.com.au/view/code/tablekit/' rel='external'>http://www.millstream.com.au/view/code/tablekit/</a>)</li>
            <li>Extensions (extensions to script.aculo.us gathered from the web)</li>
         </ul>
         <p>For more details see <a href='http://wiki.e107.org/?title=JSHelper' rel='external'>the wiki page</a>.</p>
      </div>
   ";

$style = e_QUERY == "99" ? "" : " style='display:none;'";
$text   .= "
      <div class='fcaption accordion_title' id='".JSHELPER_ADMIN_PAGE_99_ID."'>".JSHELPER_LAN_ADMIN_PAGE_99."</div>
      <div class='accordion_content'{$style}>
         <table style='width:70%;'>
            <tr>
               <td class='forumheader2'>Fantabulous</td>
               <td class='forumheader3'>1.1</td>
            </tr>
            <tr>
               <td class='forumheader2'>Firebug Lite</td>
               <td class='forumheader3'>1.0</td>
            </tr>
            <tr>
               <td class='forumheader2'>Prototip</td>
               <td class='forumheader3'><script type='text/javascript'>document.write(Prototip.Version);</script></td>
            </tr>
            <tr>
               <td class='forumheader2'>Prototype JavaScript framework</td>
               <td class='forumheader3'><script type='text/javascript'>document.write(Prototype.Version);</script></td>
            </tr>
            <tr>
               <td class='forumheader2'>script.aculo.us</td>
               <td class='forumheader3'><script type='text/javascript'>document.write(Scriptaculous.Version);</script></td>
            </tr>
            <tr>
               <td class='forumheader2'>Tablekit</td>
               <td class='forumheader3'>1.2.1</td>
            </tr>
            <tr>
               <td class='forumheader2'>Extensions</td>
               <td class='forumheader3'>n/a</td>
            </tr>
         </table>
      </div>
   ";

$text .= "
   </div>
   </form>
   ";

$ns->tablerender($title, $text);

require_once(e_ADMIN."footer.php");
?>