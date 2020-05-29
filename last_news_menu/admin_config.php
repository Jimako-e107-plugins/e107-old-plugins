<?php
/*
+---------------------------------------------------------------+
|	For e107 website system
| 4xA-LNM (Last- News- Menu) version 0.5.1 from ***RuSsE*** http://www.e107.4xa.de
|	released 18.07.2011
|	sorce: ../../last_news_menu/admin_config.php
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
$eplug_admin = true;
require_once('../../class2.php');
if ( ! getperms('P')) { header('location:'.e_BASE.'index.php'); exit(); }
$pageid = "last_news_menu_config";
$eplug_css="";
require_once(e_ADMIN."auth.php");
// Set languages ---------------------------------------------+
include_lan(e_PLUGIN.'last_news_menu/languages/'.e_LANGUAGE.'.php');
require_once(e_HANDLER."form_handler.php");
$rs = new form;
require_once(e_HANDLER."upload_handler.php");
if(IsSet($_POST['back']))
{
 header("location:".e_SELF);
 exit();
}   
// Update settings ----------------------------------------+
if(IsSet($_POST['updatemain']))
{
	extract($_POST);
	$pref['last_news_title']	= $last_news_title;
	$pref['last_news_show']	= $last_news_show;
	$pref['last_news_chars'] = $last_news_chars;
	$pref['last_news_cols']	= $last_news_cols;
	save_prefs();
	$message = e4xA_LNM_003;
}
// Main --------------------------------------------------+
if($message)
{
	$ns -> tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}
// Main settings -----------------------------------------+
$text = "
	<div style='text-align:center'>
	".$rs -> form_open("post", e_SELF, "stylecss", "", "enctype='multipart/form-data'")."
	<table style='width:94%' class='fborder'>
		<tr>
			<td colspan='2' class='forumheader'>
				".e4xA_LNM_004."
			</td>
		</tr>
		 <tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".e4xA_LNM_005."<br/>".e4xA_LNM_006."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_text_fild("last_news_title")."</td>
 		</tr>
		<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".e4xA_LNM_007."<br/>".e4xA_LNM_008."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_cols2("last_news_show",20)."</td>
 		</tr>
     <tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".e4xA_LNM_009."<br/>".e4xA_LNM_010."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_text_fild("last_news_chars")."</td>
 		</tr>
 		<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".e4xA_LNM_011."<br/>".e4xA_LNM_012."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_cols2("last_news_cols",4)."</td>
 		</tr>	
		<tr style='vertical-align:top'>
			<td colspan='2' style='text-align:center' class='forumheader'>
			<input class='button' style='cursor:hand; cursor:pointer' type='submit' name='updatemain' value='".e4xA_LNM_013."' />
			</td>
		</tr>
	</table>
	<br />
	</div>
	<br />
	".$rs -> form_close()."";

$text .= "<br/><br/><div style='text-align:center;font-size:80%'>.:: powered by <a href='http://www.e107.4xa.de' title='besuche mich!'>4xA-LNM</a> v.".e4xA_LNM_VERS." ::.<br/></div>";
$ns -> tablerender(e4xA_LNM_014, $text);
require_once(e_ADMIN.'footer.php');
///////////////
function get_text_fild($fild_name)
{
global $pref;
if($pref[$fild_name]!=''){$value_text=$pref[$fild_name];}else{$value_text="";}
$ret ="<input class='tbox' type='text' name=$fild_name size='40' value='".$value_text."' maxlength='200' style='width:250px'/>
";
return $ret;
}
///////////////////////
function get_cols2($fieldname,$max)
{
global $pref;
$ret ="<select class='tbox' style='width:250px'  name='$fieldname'>";

for($i=0; $i< $max; $i++)
{
$checked = ($pref[$fieldname] == $i)? " selected='selected'" : "";	
$ret .="<option value='".$i."' $checked >".$i."</option>";
}
$ret .="</select>";
return $ret;
}
?>