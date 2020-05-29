<?php
/*
+---------------------------------------------------------------+
|       	4xA-Sporttipps  v.0.9.5 - by ***RuSsE*** (www.e107.4xA.de)
|	released 14.07.2011
|	sorce: ../../4xa_wm/admin/admin_prefsconfig.php
|	
|        	For the e107 website system
|        	Steve Dunstan
|        	http://e107.org
|        	jalist@e107.org
|
|        	Released under the terms and conditions of the
|        	GNU General Public License (http://gnu.org).
|				
+---------------------------------------------------------------+
*/
require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit;}
//require_once("../settings/settings_admen.php");
require_once(e_ADMIN."auth.php");
$lan_file=e_PLUGIN."4xa_wm/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."4xa_wm/languages/German.php");

$ImageDELETE['PFAD']=e_PLUGIN."4xa_wm/images/banlist_16.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_4xA_SPORTTIPPS_025."' src='".$ImageDELETE['PFAD']."'>";

$ImageEDIT['PFAD']=e_PLUGIN."4xa_wm/images/edit_16.png";
$ImageEDIT['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_4xA_SPORTTIPPS_024."' src='".$ImageEDIT['PFAD']."'>";
// ------------------------------
// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $configtitle = LAN_4xA_SPORTTIPPS_074;
    $pageid = "prefs";
	$show_preset = FALSE;

//////////////////////////////////////////////////////////////////////
require_once(e_ADMIN."auth.php");
//////////////////////////////////////////////////////////////77
/////////////////////////////////////////////////////
if (isset($_POST['updatepagesets'])) 
{
$pref['4xa_wm_cap'] = $_POST['4xa_wm_cap'];	
$pref['4xa_wm_acces_class'] = $_POST['4xa_wm_acces_class'];
$pref['4xa_wm_top_points'] = $_POST['4xa_wm_top_points'];
$pref['4xa_wm_div_points'] = $_POST['4xa_wm_div_points'];
$pref['4xa_wm_tendenz_points'] = $_POST['4xa_wm_tendenz_points'];
$pref['4xa_wm_niete_points'] = $_POST['4xa_wm_niete_points'];
$pref['4xa_wm_games_count'] = $_POST['4xa_wm_games_count'];
$pref['4xa_wm_sportart'] = $_POST['4xa_wm_sportart'];
$pref['4xa_wm_gametime'] = $_POST['4xa_wm_gametime'];
$pref['4xa_wm_timer'] = $_POST['4xa_wm_timer'];
$pref['4xa_wm_top_points_color'] = $_POST['4xa_wm_top_points_color'];
$pref['4xa_wm_div_points_color'] = $_POST['4xa_wm_div_points_color'];
$pref['4xa_wm_tendenz_color'] = $_POST['4xa_wm_tendenz_color'];
$pref['4xa_wm_niete_points_color'] = $_POST['4xa_wm_niete_points_color'];
$pref['4xa_wm_kA_field_color'] = $_POST['4xa_wm_kA_field_color'];
$pref['4xa_wm_xx_field_color'] = $_POST['4xa_wm_xx_field_color'];
$pref['4xa_wm_verdeckt_field_color'] = $_POST['4xa_wm_verdeckt_field_color'];
$pref['4xa_wm_menu_timer'] = $_POST['4xa_wm_menu_timer'];
$pref['4xa_wm_menu_timer_value'] = $_POST['4xa_wm_menu_timer_value'];
$pref['4xa_wm_user_scype_field'] = $_POST['4xa_wm_user_scype_field'];
$pref['4xa_wm_regeln'] = $_POST['4xa_wm_regeln'];
$pref['4xa_wm_tablestyle1'] = $_POST['4xa_wm_tablestyle1'];
$pref['4xa_wm_tablestyle2'] = $_POST['4xa_wm_tablestyle2'];
$pref['4xa_wm_tablestyle3'] = $_POST['4xa_wm_tablestyle3'];
$pref['4xa_wm_tablestyle4'] = $_POST['4xa_wm_tablestyle4'];
$pref['4xa_wm_tablestyle5'] = $_POST['4xa_wm_tablestyle5'];
$pref['4xa_wm_tablestyle6'] = $_POST['4xa_wm_tablestyle6'];
$pref['4xa_wm_tablestyle7'] = $_POST['4xa_wm_tablestyle7'];
$pref['4xa_wm_tablestyle8'] = $_POST['4xa_wm_tablestyle8'];
$pref['4xa_wm_tablestyle9'] = $_POST['4xa_wm_tablestyle9'];

$pref['4xa_wm_tablestyle10'] = $_POST['4xa_wm_tablestyle10'];
$pref['4xa_wm_tablestyle11'] = $_POST['4xa_wm_tablestyle11'];
$pref['4xa_wm_tablestyle12'] = $_POST['4xa_wm_tablestyle12'];
$pref['4xa_wm_tablestyle13'] = $_POST['4xa_wm_tablestyle13'];
$pref['4xa_wm_tablestyle14'] = $_POST['4xa_wm_tablestyle14'];
$pref['4xa_wm_tablestyle15'] = $_POST['4xa_wm_tablestyle15'];
$pref['4xa_wm_tablestyle16'] = $_POST['4xa_wm_tablestyle16'];
save_prefs();
$message = LAN_4xA_SPORTTIPPS_047;	
}
//////////////////////////  Voreinstellungen ////////////////////////////////////////////////////
$text="<br/><br/>
<form method='post' action='".e_SELF."'>
	<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>
		<tr>
			<td style='vertical-align:top;' colspan='2' class='fcaption'>".LAN_4xA_SPORTTIPPS_061."</td>
       </tr>
     <tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".LAN_4xA_SPORTTIPPS_062."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_text_fild("4xa_wm_cap")."</td>
 		</tr>
 		 <tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".LAN_4xA_SPORTART."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_text_fild("4xa_wm_sportart")."</td>
 		</tr>
 		<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".LAN_4xA_SPIELDAUER."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_text_fild("4xa_wm_gametime")."</td>
 		</tr>
       <tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".LAN_4xA_SPORTTIPPS_063."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_useracces_dd()."</td>
 		</tr>
 		<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".ANZAHL_DER_SPIELE_PRO_SEITE."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_cols2("4xa_wm_games_count",30)."</td>
 		</tr>
 		<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".LAN_4xA_TIMER."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_text_fild("4xa_wm_timer")."</td>
 		</tr>
 		<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".LAN_4xA_MENU_TIMER."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_text_fild("4xa_wm_menu_timer")." | ".get_cols3("4xa_wm_menu_timer_value")."</td>
 		</tr>
 		<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".LAN_4xA_REGELN."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_text_area("4xa_wm_regeln")."</td>
 		</tr>";
$text.="
			<tr>
			<td style='vertical-align:top;' colspan='2' class='fcaption'>".LAN_4xA_SPORTTIPPS_064."</td>
       </tr>
			<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".LAN_4xA_SPORTTIPPS_065."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_cols("4xa_wm_top_points")." |  ".Farbe_Select("4xa_wm_top_points_color",$pref['4xa_wm_top_points_color'])."</td>
 		</tr>
 		<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".LAN_4xA_SPORTTIPPS_066." </td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_cols("4xa_wm_div_points")." |  ".Farbe_Select("4xa_wm_div_points_color",$pref['4xa_wm_div_points_color'])."</td>
 		</tr>
 		<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".LAN_4xA_SPORTTIPPS_067."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_cols("4xa_wm_tendenz_points")." |  ".Farbe_Select("4xa_wm_tendenz_color",$pref['4xa_wm_tendenz_color'])." </td>
 		</tr>
  	<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".LAN_4xA_SPORTTIPPS_068."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_cols("4xa_wm_niete_points")."  |  ".Farbe_Select("4xa_wm_niete_points_color",$pref['4xa_wm_niete_points_color'])."</td>
 		</tr>
 	  <tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".LAN_4xA_SPORTTIPPS_007."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".Farbe_Select("4xa_wm_kA_field_color",$pref['4xa_wm_kA_field_color'])."</td>
 		</tr>
 		 <tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".LAN_4xA_SPORTTIPPS_009."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".Farbe_Select("4xa_wm_xx_field_color",$pref['4xa_wm_xx_field_color'])."</td>
 		</tr>
 		 <tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".LAN_4xA_SPORTTIPPS_008."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".Farbe_Select("4xa_wm_verdeckt_field_color",$pref['4xa_wm_verdeckt_field_color'])."</td>
 		</tr>
 		<tr>
			<td style='vertical-align:top;' colspan='2' class='fcaption'>---</td>
       </tr>
 		<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>4xa_wm_user_scype_field</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".field_Select("4xa_wm_user_scype_field")."</td>
 		</tr>
 		<tr>
			<td style='vertical-align:top;' colspan='2' class='fcaption'>".LAN_4xA_SPORTTIPPS_199."</td>
    </tr>
 		<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".LAN_4xA_SPORTTIPPS_200."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_css_class("4xa_wm_tablestyle1")."</td>
 		</tr>		
 		<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".LAN_4xA_SPORTTIPPS_201."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_css_class("4xa_wm_tablestyle2")."</td>
 		</tr>
 		<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".LAN_4xA_SPORTTIPPS_202."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_css_class("4xa_wm_tablestyle6")."</td>
 		</tr>
 		<tr>
			<td style='vertical-align:top;' colspan='2' class='fcaption'>".LAN_4xA_SPORTTIPPS_203."</td>
    </tr>
 		<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".LAN_4xA_SPORTTIPPS_204."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_css_class("4xa_wm_tablestyle3")."</td>
 		</tr>
 		<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".LAN_4xA_SPORTTIPPS_205."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_css_class("4xa_wm_tablestyle4")."</td>
 		</tr>
 		<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".LAN_4xA_SPORTTIPPS_206."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_css_class("4xa_wm_tablestyle5")."</td>
 		</tr>
 	 	<tr>
			<td style='vertical-align:top;' colspan='2' class='fcaption'>".LAN_4xA_SPORTTIPPS_207."</td>
    </tr>
 		<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".LAN_4xA_SPORTTIPPS_208."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_css_class("4xa_wm_tablestyle7")."</td>
 		</tr>
 		<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".LAN_4xA_SPORTTIPPS_209."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_css_class("4xa_wm_tablestyle8")."</td>
 		</tr>
 		<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".LAN_4xA_SPORTTIPPS_210."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_css_class("4xa_wm_tablestyle9")."</td>
 		</tr>
 	 	 	<tr>
			<td style='vertical-align:top;' colspan='2' class='fcaption'>".LAN_4xA_SPORTTIPPS_211."</td>
    </tr>
 		<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".LAN_4xA_SPORTTIPPS_212."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_css_class("4xa_wm_tablestyle10")."</td>
 		</tr>
 		<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".LAN_4xA_SPORTTIPPS_213."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_css_class("4xa_wm_tablestyle11")."</td>
 		</tr>
 		<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".LAN_4xA_SPORTTIPPS_214."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_css_class("4xa_wm_tablestyle12")."</td>
 		</tr>
 	 	<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".LAN_4xA_SPORTTIPPS_215."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_css_class("4xa_wm_tablestyle13")."</td>
 		</tr>
 	 	<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".LAN_4xA_SPORTTIPPS_216."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_css_class("4xa_wm_tablestyle14")."</td>
 		</tr>
 	 	<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".LAN_4xA_SPORTTIPPS_217."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_css_class("4xa_wm_tablestyle15")."</td>
 		</tr>
 	 	<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".LAN_4xA_SPORTTIPPS_218."</td>
			<td style='width:60%;vertical-align:top;' class='forumheader3'>".get_css_class("4xa_wm_tablestyle16")."</td>
 		</tr>
 		";
$text.="<td colspan='2' class='fcaption'><div align='center'><input class='button' name='updatepagesets' type='submit' value='".LAN_4xA_SPORTTIPPS_069."' /></div></td>
     	</tr>
	</table>
</form></div>";

/// Respektiere die Arbeit von den Anderen und lasse diesen Text mit dem Link auf die Seite der Entwickler.
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt.
/// Nur so kann eine vernünftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!
$text.="<br/><br/><font style='font-size:60%;'>.:: powered by <a href='http://www.e107.4xa.de' target='blank' title='".BESUCHE_MICH."'>".LAN_4xA_SPORTTIPPS_NAME."</a> v.".LAN_4xA_SPORTTIPPS_VERS." ::.</font></div>";if (isset($message))
	{
	$ns->tablerender("", "<div style='text-align:center'><b>$message</b></div>");
	}
$ns->tablerender($configtitle, $text);
require_once(e_ADMIN."footer.php");
//////////////////////  Functionen //////////////////////////////////////////////////
//////////////////////////
function get_useracces_dd()
{
global $sql,$pref;
$ret ="<select class='tbox' style='width:250px'  name='4xa_wm_acces_class'><option></option>";
$checked = ($pref['4xa_wm_acces_class'] == 0)? " selected='selected'" : "";
$ret .="<option value='0' $checked >".LAN_4xA_SPORTTIPPS_070."</option>"; 							//Jeder
$checked = ($pref['4xa_wm_acces_class'] == 252)? " selected='selected'" : "";
$ret .="<option value='252' $checked >".LAN_4xA_SPORTTIPPS_071."</option>"; 						//Nur Mitglieder
$checked = ($pref['4xa_wm_acces_class'] == 254)? " selected='selected'" : "";
$ret .="<option value='254' $checked >".LAN_4xA_SPORTTIPPS_072."</option>";							//Nur Admins
$checked = ($pref['4xa_wm_acces_class'] == 255)? " selected='selected'" : "";
$ret .="<option value='255' $checked >".LAN_4xA_SPORTTIPPS_073."</option>";							//keiner (inaktiv)
$sql -> db_Select('userclass_classes',"userclass_id, userclass_name"," ORDER BY userclass_name", "no_where");
while($row = $sql-> db_Fetch())
	{
	extract($row);
	$checked = ($userclass_id == $pref['4xa_wm_acces_class'])? " selected='selected' " : "";
    $ret .="<option value='".$userclass_id."' $checked > $userclass_name </option>";
    }
$ret .="</select>";
return $ret;
}
////////////////////
function get_css_class($field_name)
{
global $pref;
$ret ="<select class='tbox' style='width:250px'  name='".$field_name."'><option></option>";
$checked = ($pref[$field_name] == "fcaption")? " selected='selected'" : "";
$ret .="<option value='fcaption' $checked >fcaption</option>";
$checked = ($pref[$field_name] == "forumheader")? " selected='selected'" : "";
$ret .="<option value='forumheader' $checked >forumheader</option>";
$checked = ($pref[$field_name] == "forumheader2")? " selected='selected'" : "";
$ret .="<option value='forumheader2' $checked >forumheader2</option>";
$checked = ($pref[$field_name] == "forumheader3")? " selected='selected'" : "";
$ret .="<option value='forumheader3' $checked >forumheader3</option>";
$ret .="</select>";
return $ret;
}
/////////////////////////
function get_cols($fieldname)
{
global $pref;
$ret ="<select class='tbox' style='width:100px'  name='$fieldname'>";
$checked = ($pref[$fieldname] == 0)? " selected='selected'" : "";
$ret .="<option value='0' $checked >0</option>";
$checked = ($pref[$fieldname] == 1)? " selected='selected'" : "";
$ret .="<option value='1' $checked >1</option>";
$checked = ($pref[$fieldname] == 2)? " selected='selected'" : "";
$ret .="<option value='2' $checked >2</option>";
$checked = ($pref[$fieldname] == 3)? " selected='selected'" : "";
$ret .="<option value='3' $checked >3</option>";
$ret .="</select>";
return $ret;
}
/////////////////////////
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
/////////////////////////
function get_cols3($fieldname)
{
global $pref;
$ret ="<select class='tbox' style='width:100px'  name='$fieldname'>";
$checked = ($pref[$fieldname] == 1)? " selected='selected'" : "";
$ret .="<option value='1' $checked >Stunden</option>";
$checked = ($pref[$fieldname] == 2)? " selected='selected'" : "";
$ret .="<option value='2' $checked >Tagen</option>";
$checked = ($pref[$fieldname] == 3)? " selected='selected'" : "";
$ret .="<option value='3' $checked >Wochen</option>";
$ret .="</select>";
return $ret;
}
/////////////////////////
function get_img_size()
{
global $pref;
$ret ="<input class='tbox' type='text' name='my_videogallery_img_size' size='40' value='".$pref['my_videogallery_img_size']."' maxlength='200' style='width:250px'/>
";
return $ret;
}
/////////////////////////
function get_katimg_size()
{
global $pref;
$ret ="<input class='tbox' type='text' name='my_videogallery_katimg_size' size='40' value='".$pref['my_videogallery_katimg_size']."' maxlength='200' style='width:250px'/>
";
return $ret;
}
/////////////////////////
function get_text_fild($fild_name)
{
global $pref;
if($pref[$fild_name]!=''){$value_text=$pref[$fild_name];}else{$value_text="";}
$ret ="<input class='tbox' type='text' name=$fild_name size='40' value='".$value_text."' maxlength='200' style='width:250px'/>
";
return $ret;
}
/////////////////////////////
function field_Select($fieldname)
{
global $pref,$sql;
$ret ="<select class='tbox' style='width:200px'  name='$fieldname'>";
$sql -> db_Select("user_extended_struct", "*", "user_extended_struct_type='1' AND user_extended_struct_name!=''");
while($row = $sql-> db_Fetch())
		{
		$checked = ($pref[$fieldname] == $row['user_extended_struct_name'])? " selected='selected'" : "";
		$ret .="<option value='".$row['user_extended_struct_name']."' $checked >".$row['user_extended_struct_name']."</option>";
		}
$ret .="</select>";
return $ret;
}
/////////////////////////
function get_text_area($fild_name)
{
global $pref,$tp;
//$ret ="<textarea name='".$fild_name."' rows='15' cols='100%'  />".$pref[$fild_name]."</textarea />";
require_once(e_HANDLER."ren_help.php");

$valuehere = $pref[$fild_name];
$insertjs = (!e_WYSIWYG) ? "rows='15' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'": "rows='25' ";
$_POST['data'] = $tp->toForm($_POST['data']);
$ret .= "<textarea class='tbox' id='".$fild_name."' name='".$fild_name."'  cols='80'  style='width:98%;height:200px' $insertjs>".(strstr($tp->post_toForm($valuehere), "[img]http") ? $valuehere : str_replace("[img]../", "[img]", $tp->post_toForm($valuehere)))."</textarea>
";
$ret .= display_help("helpb", 'news');
return $ret;
}








// Color-Code Selector v1.1 for e107 by Cameron.
// Adapted from Htmlarea v3.0

echo "<script type=\"text/javascript\">
// <![CDATA[


    function View(field,color) {
    var fieldname = 'ColorPreview_' + field;                 // preview color
        if(ValidateColor(color)){
            document.getElementById(fieldname).style.backgroundColor = '#' + color;
            document.getElementById(field).value = color;
        }else{
            alert('Your color-code is not valid');
            document.getElementById(field).focus();
        }
    }

    function Set(field,string) {                   // select color
        var color = ValidateColor(string);
        if (color == null) { alert('Invalid color code: ' + string); }        // invalid color
        else {                                            // valid color
            View(field,color);                          // show selected color
            document.getElementById(field).value = color;
        }
    }

    function ValidateColor(string) {                // return valid color code
      string = string || '';
      string = string + \"\";
      string = string.toUpperCase();
      var chars = '0123456789ABCDEF';
      var out   = '';

      for (var i=0; i<string.length; i++) {             // remove invalid color chars
        var schar = string.charAt(i);
        if (chars.indexOf(schar) != -1) { out += schar; }
      }

      if (out.length != 6) { return null; }            // check length
      return out;
    }
// ]]>
</script>";

function Farbe_Select($field,$dbvalue){
  $dbvalue = $dbvalue == "" ? "000000" : $dbvalue;
  $bgcolor = "#".$dbvalue;

  $text .= "<span style=\"background-color: $bgcolor; border:1px solid black; height: 25px\">";
  $text .= "<span id=\"ColorPreview_".$field."\" style=\"border:1px;height: 100%; width: 28px\">&nbsp;&nbsp;&nbsp;&nbsp;</span></span>";
  $text .= "&nbsp;#<input class='tbox' type=\"text\" name=\"".$field."\" id=\"".$field."\" value=\"".$dbvalue."\" size='15' onblur=\"View('".$field."',this.value)\" />
      &nbsp;<input class='button' type='button' value='".LAN_4xA_SPORTTIPPS_183."' onclick='expandit(this)' />";

  $text .="
     <div style='display: none;' id='button' onclick=\"this.style.display='none'\">
    <table cellspacing=\"1px\" cellpadding=\"0px\" width=\"100%\"  style=\"background-color:#000000;border:0px;cursor: pointer;\">
    <tr>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#003300' onmouseover=\"View('".$field."','003300')\" onclick=\"Set('".$field."','003300')\" ></td>
    <td style='width:10px;height:10px;background-color:#006600' onmouseover=\"View('".$field."','006600')\" onclick=\"Set('".$field."','006600')\" ></td>
    <td style='width:10px;height:10px;background-color:#009900' onmouseover=\"View('".$field."','009900')\" onclick=\"Set('".$field."','009900')\" ></td>
    <td style='width:10px;height:10px;background-color:#00CC00' onmouseover=\"View('".$field."','00CC00')\" onclick=\"Set('".$field."','00CC00')\" ></td>
    <td style='width:10px;height:10px;background-color:#00FF00' onmouseover=\"View('".$field."','00FF00')\" onclick=\"Set('".$field."','00FF00')\" ></td>
    <td style='width:10px;height:10px;background-color:#330000' onmouseover=\"View('".$field."','330000')\" onclick=\"Set('".$field."','330000')\" ></td>
    <td style='width:10px;height:10px;background-color:#333300' onmouseover=\"View('".$field."','333300')\" onclick=\"Set('".$field."','333300')\" ></td>
    <td style='width:10px;height:10px;background-color:#336600' onmouseover=\"View('".$field."','336600')\" onclick=\"Set('".$field."','336600')\" ></td>
    <td style='width:10px;height:10px;background-color:#339900' onmouseover=\"View('".$field."','339900')\" onclick=\"Set('".$field."','339900')\" ></td>
    <td style='width:10px;height:10px;background-color:#33CC00' onmouseover=\"View('".$field."','33CC00')\" onclick=\"Set('".$field."','33CC00')\" ></td>
    <td style='width:10px;height:10px;background-color:#33FF00' onmouseover=\"View('".$field."','33FF00')\" onclick=\"Set('".$field."','33FF00')\" ></td>
    <td style='width:10px;height:10px;background-color:#660000' onmouseover=\"View('".$field."','660000')\" onclick=\"Set('".$field."','660000')\" ></td>
    <td style='width:10px;height:10px;background-color:#663300' onmouseover=\"View('".$field."','663300')\" onclick=\"Set('".$field."','663300')\" ></td>
    <td style='width:10px;height:10px;background-color:#666600' onmouseover=\"View('".$field."','666600')\" onclick=\"Set('".$field."','666600')\" ></td>
    <td style='width:10px;height:10px;background-color:#669900' onmouseover=\"View('".$field."','669900')\" onclick=\"Set('".$field."','669900')\" ></td>
    <td style='width:10px;height:10px;background-color:#66CC00' onmouseover=\"View('".$field."','66CC00')\" onclick=\"Set('".$field."','66CC00')\" ></td>
    <td style='width:10px;height:10px;background-color:#66FF00' onmouseover=\"View('".$field."','66FF00')\" onclick=\"Set('".$field."','66FF00')\" ></td>
    </tr>
    <tr>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#333333' onmouseover=\"View('".$field."','333333')\" onclick=\"Set('".$field."','333333')\" ></td>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#000033' onmouseover=\"View('".$field."','000033')\" onclick=\"Set('".$field."','000033')\" ></td>
    <td style='width:10px;height:10px;background-color:#003333' onmouseover=\"View('".$field."','003333')\" onclick=\"Set('".$field."','003333')\" ></td>
    <td style='width:10px;height:10px;background-color:#006633' onmouseover=\"View('".$field."','006633')\" onclick=\"Set('".$field."','006633')\" ></td>
    <td style='width:10px;height:10px;background-color:#009933' onmouseover=\"View('".$field."','009933')\" onclick=\"Set('".$field."','009933')\" ></td>
    <td style='width:10px;height:10px;background-color:#00CC33' onmouseover=\"View('".$field."','00CC33')\" onclick=\"Set('".$field."','00CC33')\" ></td>
    <td style='width:10px;height:10px;background-color:#00FF33' onmouseover=\"View('".$field."','00FF33')\" onclick=\"Set('".$field."','00FF33')\" ></td>
    <td style='width:10px;height:10px;background-color:#330033' onmouseover=\"View('".$field."','330033')\" onclick=\"Set('".$field."','330033')\" ></td>
    <td style='width:10px;height:10px;background-color:#333333' onmouseover=\"View('".$field."','333333')\" onclick=\"Set('".$field."','333333')\" ></td>
    <td style='width:10px;height:10px;background-color:#336633' onmouseover=\"View('".$field."','336633')\" onclick=\"Set('".$field."','336633')\" ></td>
    <td style='width:10px;height:10px;background-color:#339933' onmouseover=\"View('".$field."','339933')\" onclick=\"Set('".$field."','339933')\" ></td>
    <td style='width:10px;height:10px;background-color:#33CC33' onmouseover=\"View('".$field."','33CC33')\" onclick=\"Set('".$field."','33CC33')\" ></td>
    <td style='width:10px;height:10px;background-color:#33FF33' onmouseover=\"View('".$field."','33FF33')\" onclick=\"Set('".$field."','33FF33')\" ></td>
    <td style='width:10px;height:10px;background-color:#660033' onmouseover=\"View('".$field."','660033')\" onclick=\"Set('".$field."','660033')\" ></td>
    <td style='width:10px;height:10px;background-color:#663333' onmouseover=\"View('".$field."','663333')\" onclick=\"Set('".$field."','663333')\" ></td>
    <td style='width:10px;height:10px;background-color:#666633' onmouseover=\"View('".$field."','666633')\" onclick=\"Set('".$field."','666633')\" ></td>
    <td style='width:10px;height:10px;background-color:#669933' onmouseover=\"View('".$field."','669933')\" onclick=\"Set('".$field."','669933')\" ></td>
    <td style='width:10px;height:10px;background-color:#66CC33' onmouseover=\"View('".$field."','66CC33')\" onclick=\"Set('".$field."','66CC33')\" ></td>
    <td style='width:10px;height:10px;background-color:#66FF33' onmouseover=\"View('".$field."','66FF33')\" onclick=\"Set('".$field."','66FF33')\" ></td>
    </tr>
    <tr>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#666666' onmouseover=\"View('".$field."','666666')\" onclick=\"Set('".$field."','666666')\" ></td>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#000066' onmouseover=\"View('".$field."','000066')\" onclick=\"Set('".$field."','000066')\" ></td>
    <td style='width:10px;height:10px;background-color:#003366' onmouseover=\"View('".$field."','003366')\" onclick=\"Set('".$field."','003366')\" ></td>
    <td style='width:10px;height:10px;background-color:#006666' onmouseover=\"View('".$field."','006666')\" onclick=\"Set('".$field."','006666')\" ></td>
    <td style='width:10px;height:10px;background-color:#009966' onmouseover=\"View('".$field."','009966')\" onclick=\"Set('".$field."','009966')\" ></td>
    <td style='width:10px;height:10px;background-color:#00CC66' onmouseover=\"View('".$field."','00CC66')\" onclick=\"Set('".$field."','00CC66')\" ></td>
    <td style='width:10px;height:10px;background-color:#00FF66' onmouseover=\"View('".$field."','00FF66')\" onclick=\"Set('".$field."','00FF66')\" ></td>
    <td style='width:10px;height:10px;background-color:#330066' onmouseover=\"View('".$field."','330066')\" onclick=\"Set('".$field."','330066')\" ></td>
    <td style='width:10px;height:10px;background-color:#333366' onmouseover=\"View('".$field."','333366')\" onclick=\"Set('".$field."','333366')\" ></td>
    <td style='width:10px;height:10px;background-color:#336666' onmouseover=\"View('".$field."','336666')\" onclick=\"Set('".$field."','336666')\" ></td>
    <td style='width:10px;height:10px;background-color:#339966' onmouseover=\"View('".$field."','339966')\" onclick=\"Set('".$field."','339966')\" ></td>
    <td style='width:10px;height:10px;background-color:#33CC66' onmouseover=\"View('".$field."','33CC66')\" onclick=\"Set('".$field."','33CC66')\" ></td>
    <td style='width:10px;height:10px;background-color:#33FF66' onmouseover=\"View('".$field."','33FF66')\" onclick=\"Set('".$field."','33FF66')\" ></td>
    <td style='width:10px;height:10px;background-color:#660066' onmouseover=\"View('".$field."','660066')\" onclick=\"Set('".$field."','660066')\" ></td>
    <td style='width:10px;height:10px;background-color:#663366' onmouseover=\"View('".$field."','663366')\" onclick=\"Set('".$field."','663366')\" ></td>
    <td style='width:10px;height:10px;background-color:#666666' onmouseover=\"View('".$field."','666666')\" onclick=\"Set('".$field."','666666')\" ></td>
    <td style='width:10px;height:10px;background-color:#669966' onmouseover=\"View('".$field."','669966')\" onclick=\"Set('".$field."','669966')\" ></td>
    <td style='width:10px;height:10px;background-color:#66CC66' onmouseover=\"View('".$field."','66CC66')\" onclick=\"Set('".$field."','66CC66')\" ></td>
    <td style='width:10px;height:10px;background-color:#66FF66' onmouseover=\"View('".$field."','66FF66')\" onclick=\"Set('".$field."','66FF66')\" ></td>
    </tr>
    <tr>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#999999' onmouseover=\"View('".$field."','999999')\" onclick=\"Set('".$field."','999999')\" ></td>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#000099' onmouseover=\"View('".$field."','000099')\" onclick=\"Set('".$field."','000099')\" ></td>
    <td style='width:10px;height:10px;background-color:#003399' onmouseover=\"View('".$field."','003399')\" onclick=\"Set('".$field."','003399')\" ></td>
    <td style='width:10px;height:10px;background-color:#006699' onmouseover=\"View('".$field."','006699')\" onclick=\"Set('".$field."','006699')\" ></td>
    <td style='width:10px;height:10px;background-color:#009999' onmouseover=\"View('".$field."','009999')\" onclick=\"Set('".$field."','009999')\" ></td>
    <td style='width:10px;height:10px;background-color:#00CC99' onmouseover=\"View('".$field."','00CC99')\" onclick=\"Set('".$field."','00CC99')\" ></td>
    <td style='width:10px;height:10px;background-color:#00FF99' onmouseover=\"View('".$field."','00FF99')\" onclick=\"Set('".$field."','00FF99')\" ></td>
    <td style='width:10px;height:10px;background-color:#330099' onmouseover=\"View('".$field."','330099')\" onclick=\"Set('".$field."','330099')\" ></td>
    <td style='width:10px;height:10px;background-color:#333399' onmouseover=\"View('".$field."','333399')\" onclick=\"Set('".$field."','333399')\" ></td>
    <td style='width:10px;height:10px;background-color:#336699' onmouseover=\"View('".$field."','336699')\" onclick=\"Set('".$field."','336699')\" ></td>
    <td style='width:10px;height:10px;background-color:#339999' onmouseover=\"View('".$field."','339999')\" onclick=\"Set('".$field."','339999')\" ></td>
    <td style='width:10px;height:10px;background-color:#33CC99' onmouseover=\"View('".$field."','33CC99')\" onclick=\"Set('".$field."','33CC99')\" ></td>
    <td style='width:10px;height:10px;background-color:#33FF99' onmouseover=\"View('".$field."','33FF99')\" onclick=\"Set('".$field."','33FF99')\" ></td>
    <td style='width:10px;height:10px;background-color:#660099' onmouseover=\"View('".$field."','660099')\" onclick=\"Set('".$field."','660099')\" ></td>
    <td style='width:10px;height:10px;background-color:#663399' onmouseover=\"View('".$field."','663399')\" onclick=\"Set('".$field."','663399')\" ></td>
    <td style='width:10px;height:10px;background-color:#666699' onmouseover=\"View('".$field."','666699')\" onclick=\"Set('".$field."','666699')\" ></td>
    <td style='width:10px;height:10px;background-color:#669999' onmouseover=\"View('".$field."','669999')\" onclick=\"Set('".$field."','669999')\" ></td>
    <td style='width:10px;height:10px;background-color:#66CC99' onmouseover=\"View('".$field."','66CC99')\" onclick=\"Set('".$field."','66CC99')\" ></td>
    <td style='width:10px;height:10px;background-color:#66FF99' onmouseover=\"View('".$field."','66FF99')\" onclick=\"Set('".$field."','66FF99')\" ></td>
    </tr>
    <tr>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#CCCCCC' onmouseover=\"View('".$field."','CCCCCC')\" onclick=\"Set('".$field."','CCCCCC')\" ></td>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#0000CC' onmouseover=\"View('".$field."','0000CC')\" onclick=\"Set('".$field."','0000CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#0033CC' onmouseover=\"View('".$field."','0033CC')\" onclick=\"Set('".$field."','0033CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#0066CC' onmouseover=\"View('".$field."','0066CC')\" onclick=\"Set('".$field."','0066CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#0099CC' onmouseover=\"View('".$field."','0099CC')\" onclick=\"Set('".$field."','0099CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#00CCCC' onmouseover=\"View('".$field."','00CCCC')\" onclick=\"Set('".$field."','00CCCC')\" ></td>
    <td style='width:10px;height:10px;background-color:#00FFCC' onmouseover=\"View('".$field."','00FFCC')\" onclick=\"Set('".$field."','00FFCC')\" ></td>
    <td style='width:10px;height:10px;background-color:#3300CC' onmouseover=\"View('".$field."','3300CC')\" onclick=\"Set('".$field."','3300CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#3333CC' onmouseover=\"View('".$field."','3333CC')\" onclick=\"Set('".$field."','3333CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#3366CC' onmouseover=\"View('".$field."','3366CC')\" onclick=\"Set('".$field."','3366CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#3399CC' onmouseover=\"View('".$field."','3399CC')\" onclick=\"Set('".$field."','3399CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#33CCCC' onmouseover=\"View('".$field."','33CCCC')\" onclick=\"Set('".$field."','33CCCC')\" ></td>
    <td style='width:10px;height:10px;background-color:#33FFCC' onmouseover=\"View('".$field."','33FFCC')\" onclick=\"Set('".$field."','33FFCC')\" ></td>
    <td style='width:10px;height:10px;background-color:#6600CC' onmouseover=\"View('".$field."','6600CC')\" onclick=\"Set('".$field."','6600CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#6633CC' onmouseover=\"View('".$field."','6633CC')\" onclick=\"Set('".$field."','6633CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#6666CC' onmouseover=\"View('".$field."','6666CC')\" onclick=\"Set('".$field."','6666CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#6699CC' onmouseover=\"View('".$field."','6699CC')\" onclick=\"Set('".$field."','6699CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#66CCCC' onmouseover=\"View('".$field."','66CCCC')\" onclick=\"Set('".$field."','66CCCC')\" ></td>
    <td style='width:10px;height:10px;background-color:#66FFCC' onmouseover=\"View('".$field."','66FFCC')\" onclick=\"Set('".$field."','66FFCC')\" ></td>
    </tr>
    <tr>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#FFFFFF' onmouseover=\"View('".$field."','FFFFFF')\" onclick=\"Set('".$field."','FFFFFF')\" ></td>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#0000FF' onmouseover=\"View('".$field."','0000FF')\" onclick=\"Set('".$field."','0000FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#0033FF' onmouseover=\"View('".$field."','0033FF')\" onclick=\"Set('".$field."','0033FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#0066FF' onmouseover=\"View('".$field."','0066FF')\" onclick=\"Set('".$field."','0066FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#0099FF' onmouseover=\"View('".$field."','0099FF')\" onclick=\"Set('".$field."','0099FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#00CCFF' onmouseover=\"View('".$field."','00CCFF')\" onclick=\"Set('".$field."','00CCFF')\" ></td>
    <td style='width:10px;height:10px;background-color:#00FFFF' onmouseover=\"View('".$field."','00FFFF')\" onclick=\"Set('".$field."','00FFFF')\" ></td>
    <td style='width:10px;height:10px;background-color:#3300FF' onmouseover=\"View('".$field."','3300FF')\" onclick=\"Set('".$field."','3300FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#3333FF' onmouseover=\"View('".$field."','3333FF')\" onclick=\"Set('".$field."','3333FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#3366FF' onmouseover=\"View('".$field."','3366FF')\" onclick=\"Set('".$field."','3366FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#3399FF' onmouseover=\"View('".$field."','3399FF')\" onclick=\"Set('".$field."','3399FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#33CCFF' onmouseover=\"View('".$field."','33CCFF')\" onclick=\"Set('".$field."','33CCFF')\" ></td>
    <td style='width:10px;height:10px;background-color:#33FFFF' onmouseover=\"View('".$field."','33FFFF')\" onclick=\"Set('".$field."','33FFFF')\" ></td>
    <td style='width:10px;height:10px;background-color:#6600FF' onmouseover=\"View('".$field."','6600FF')\" onclick=\"Set('".$field."','6600FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#6633FF' onmouseover=\"View('".$field."','6633FF')\" onclick=\"Set('".$field."','6633FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#6666FF' onmouseover=\"View('".$field."','6666FF')\" onclick=\"Set('".$field."','6666FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#6699FF' onmouseover=\"View('".$field."','6699FF')\" onclick=\"Set('".$field."','6699FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#66CCFF' onmouseover=\"View('".$field."','66CCFF')\" onclick=\"Set('".$field."','66CCFF')\" ></td>
    <td style='width:10px;height:10px;background-color:#66FFFF' onmouseover=\"View('".$field."','66FFFF')\" onclick=\"Set('".$field."','66FFFF')\" ></td>
    </tr>
    <tr>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF0000' onmouseover=\"View('".$field."','FF0000')\" onclick=\"Set('".$field."','FF0000')\" ></td>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#990000' onmouseover=\"View('".$field."','990000')\" onclick=\"Set('".$field."','990000')\" ></td>
    <td style='width:10px;height:10px;background-color:#993300' onmouseover=\"View('".$field."','993300')\" onclick=\"Set('".$field."','993300')\" ></td>
    <td style='width:10px;height:10px;background-color:#996600' onmouseover=\"View('".$field."','996600')\" onclick=\"Set('".$field."','996600')\" ></td>
    <td style='width:10px;height:10px;background-color:#999900' onmouseover=\"View('".$field."','999900')\" onclick=\"Set('".$field."','999900')\" ></td>
    <td style='width:10px;height:10px;background-color:#99CC00' onmouseover=\"View('".$field."','99CC00')\" onclick=\"Set('".$field."','99CC00')\" ></td>
    <td style='width:10px;height:10px;background-color:#99FF00' onmouseover=\"View('".$field."','99FF00')\" onclick=\"Set('".$field."','99FF00')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC0000' onmouseover=\"View('".$field."','CC0000')\" onclick=\"Set('".$field."','CC0000')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC3300' onmouseover=\"View('".$field."','CC3300')\" onclick=\"Set('".$field."','CC3300')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC6600' onmouseover=\"View('".$field."','CC6600')\" onclick=\"Set('".$field."','CC6600')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC9900' onmouseover=\"View('".$field."','CC9900')\" onclick=\"Set('".$field."','CC9900')\" ></td>
    <td style='width:10px;height:10px;background-color:#CCCC00' onmouseover=\"View('".$field."','CCCC00')\" onclick=\"Set('".$field."','CCCC00')\" ></td>
    <td style='width:10px;height:10px;background-color:#CCFF00' onmouseover=\"View('".$field."','CCFF00')\" onclick=\"Set('".$field."','CCFF00')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF0000' onmouseover=\"View('".$field."','FF0000')\" onclick=\"Set('".$field."','FF0000')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF3300' onmouseover=\"View('".$field."','FF3300')\" onclick=\"Set('".$field."','FF3300')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF6600' onmouseover=\"View('".$field."','FF6600')\" onclick=\"Set('".$field."','FF6600')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF9900' onmouseover=\"View('".$field."','FF9900')\" onclick=\"Set('".$field."','FF9900')\" ></td>
    <td style='width:10px;height:10px;background-color:#FFCC00' onmouseover=\"View('".$field."','FFCC00')\" onclick=\"Set('".$field."','FFCC00')\" ></td>
    <td style='width:10px;height:10px;background-color:#FFFF00' onmouseover=\"View('".$field."','FFFF00')\" onclick=\"Set('".$field."','FFFF00')\" ></td>
    </tr>
    <tr>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#00FF00' onmouseover=\"View('".$field."','00FF00')\" onclick=\"Set('".$field."','00FF00')\" ></td>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#990033' onmouseover=\"View('".$field."','990033')\" onclick=\"Set('".$field."','990033')\" ></td>
    <td style='width:10px;height:10px;background-color:#993333' onmouseover=\"View('".$field."','993333')\" onclick=\"Set('".$field."','993333')\" ></td>
    <td style='width:10px;height:10px;background-color:#996633' onmouseover=\"View('".$field."','996633')\" onclick=\"Set('".$field."','996633')\" ></td>
    <td style='width:10px;height:10px;background-color:#999933' onmouseover=\"View('".$field."','999933')\" onclick=\"Set('".$field."','999933')\" ></td>
    <td style='width:10px;height:10px;background-color:#99CC33' onmouseover=\"View('".$field."','99CC33')\" onclick=\"Set('".$field."','99CC33')\" ></td>
    <td style='width:10px;height:10px;background-color:#99FF33' onmouseover=\"View('".$field."','99FF33')\" onclick=\"Set('".$field."','99FF33')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC0033' onmouseover=\"View('".$field."','CC0033')\" onclick=\"Set('".$field."','CC0033')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC3333' onmouseover=\"View('".$field."','CC3333')\" onclick=\"Set('".$field."','CC3333')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC6633' onmouseover=\"View('".$field."','CC6633')\" onclick=\"Set('".$field."','CC6633')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC9933' onmouseover=\"View('".$field."','CC9933')\" onclick=\"Set('".$field."','CC9933')\" ></td>
    <td style='width:10px;height:10px;background-color:#CCCC33' onmouseover=\"View('".$field."','CCCC33')\" onclick=\"Set('".$field."','CCCC33')\" ></td>
    <td style='width:10px;height:10px;background-color:#CCFF33' onmouseover=\"View('".$field."','CCFF33')\" onclick=\"Set('".$field."','CCFF33')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF0033' onmouseover=\"View('".$field."','FF0033')\" onclick=\"Set('".$field."','FF0033')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF3333' onmouseover=\"View('".$field."','FF3333')\" onclick=\"Set('".$field."','FF3333')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF6633' onmouseover=\"View('".$field."','FF6633')\" onclick=\"Set('".$field."','FF6633')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF9933' onmouseover=\"View('".$field."','FF9933')\" onclick=\"Set('".$field."','FF9933')\" ></td>
    <td style='width:10px;height:10px;background-color:#FFCC33' onmouseover=\"View('".$field."','FFCC33')\" onclick=\"Set('".$field."','FFCC33')\" ></td>
    <td style='width:10px;height:10px;background-color:#FFFF33' onmouseover=\"View('".$field."','FFFF33')\" onclick=\"Set('".$field."','FFFF33')\" ></td>
    </tr>
    <tr>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#0000FF' onmouseover=\"View('".$field."','0000FF')\" onclick=\"Set('".$field."','0000FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#990066' onmouseover=\"View('".$field."','990066')\" onclick=\"Set('".$field."','990066')\" ></td>
    <td style='width:10px;height:10px;background-color:#993366' onmouseover=\"View('".$field."','993366')\" onclick=\"Set('".$field."','993366')\" ></td>
    <td style='width:10px;height:10px;background-color:#996666' onmouseover=\"View('".$field."','996666')\" onclick=\"Set('".$field."','996666')\" ></td>
    <td style='width:10px;height:10px;background-color:#999966' onmouseover=\"View('".$field."','999966')\" onclick=\"Set('".$field."','999966')\" ></td>
    <td style='width:10px;height:10px;background-color:#99CC66' onmouseover=\"View('".$field."','99CC66')\" onclick=\"Set('".$field."','99CC66')\" ></td>
    <td style='width:10px;height:10px;background-color:#99FF66' onmouseover=\"View('".$field."','99FF66')\" onclick=\"Set('".$field."','99FF66')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC0066' onmouseover=\"View('".$field."','CC0066')\" onclick=\"Set('".$field."','CC0066')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC3366' onmouseover=\"View('".$field."','CC3366')\" onclick=\"Set('".$field."','CC3366')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC6666' onmouseover=\"View('".$field."','CC6666')\" onclick=\"Set('".$field."','CC6666')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC9966' onmouseover=\"View('".$field."','CC9966')\" onclick=\"Set('".$field."','CC9966')\" ></td>
    <td style='width:10px;height:10px;background-color:#CCCC66' onmouseover=\"View('".$field."','CCCC66')\" onclick=\"Set('".$field."','CCCC66')\" ></td>
    <td style='width:10px;height:10px;background-color:#CCFF66' onmouseover=\"View('".$field."','CCFF66')\" onclick=\"Set('".$field."','CCFF66')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF0066' onmouseover=\"View('".$field."','FF0066')\" onclick=\"Set('".$field."','FF0066')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF3366' onmouseover=\"View('".$field."','FF3366')\" onclick=\"Set('".$field."','FF3366')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF6666' onmouseover=\"View('".$field."','FF6666')\" onclick=\"Set('".$field."','FF6666')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF9966' onmouseover=\"View('".$field."','FF9966')\" onclick=\"Set('".$field."','FF9966')\" ></td>
    <td style='width:10px;height:10px;background-color:#FFCC66' onmouseover=\"View('".$field."','FFCC66')\" onclick=\"Set('".$field."','FFCC66')\" ></td>
    <td style='width:10px;height:10px;background-color:#FFFF66' onmouseover=\"View('".$field."','FFFF66')\" onclick=\"Set('".$field."','FFFF66')\" ></td>
    </tr>
    <tr>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#FFFF00' onmouseover=\"View('".$field."','FFFF00')\" onclick=\"Set('".$field."','FFFF00')\" ></td>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#990099' onmouseover=\"View('".$field."','990099')\" onclick=\"Set('".$field."','990099')\" ></td>
    <td style='width:10px;height:10px;background-color:#993399' onmouseover=\"View('".$field."','993399')\" onclick=\"Set('".$field."','993399')\" ></td>
    <td style='width:10px;height:10px;background-color:#996699' onmouseover=\"View('".$field."','996699')\" onclick=\"Set('".$field."','996699')\" ></td>
    <td style='width:10px;height:10px;background-color:#999999' onmouseover=\"View('".$field."','999999')\" onclick=\"Set('".$field."','999999')\" ></td>
    <td style='width:10px;height:10px;background-color:#99CC99' onmouseover=\"View('".$field."','99CC99')\" onclick=\"Set('".$field."','99CC99')\" ></td>
    <td style='width:10px;height:10px;background-color:#99FF99' onmouseover=\"View('".$field."','99FF99')\" onclick=\"Set('".$field."','99FF99')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC0099' onmouseover=\"View('".$field."','CC0099')\" onclick=\"Set('".$field."','CC0099')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC3399' onmouseover=\"View('".$field."','CC3399')\" onclick=\"Set('".$field."','CC3399')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC6699' onmouseover=\"View('".$field."','CC6699')\" onclick=\"Set('".$field."','CC6699')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC9999' onmouseover=\"View('".$field."','CC9999')\" onclick=\"Set('".$field."','CC9999')\" ></td>
    <td style='width:10px;height:10px;background-color:#CCCC99' onmouseover=\"View('".$field."','CCCC99')\" onclick=\"Set('".$field."','CCCC99')\" ></td>
    <td style='width:10px;height:10px;background-color:#CCFF99' onmouseover=\"View('".$field."','CCFF99')\" onclick=\"Set('".$field."','CCFF99')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF0099' onmouseover=\"View('".$field."','FF0099')\" onclick=\"Set('".$field."','FF0099')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF3399' onmouseover=\"View('".$field."','FF3399')\" onclick=\"Set('".$field."','FF3399')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF6699' onmouseover=\"View('".$field."','FF6699')\" onclick=\"Set('".$field."','FF6699')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF9999' onmouseover=\"View('".$field."','FF9999')\" onclick=\"Set('".$field."','FF9999')\" ></td>
    <td style='width:10px;height:10px;background-color:#FFCC99' onmouseover=\"View('".$field."','FFCC99')\" onclick=\"Set('".$field."','FFCC99')\" ></td>
    <td style='width:10px;height:10px;background-color:#FFFF99' onmouseover=\"View('".$field."','FFFF99')\" onclick=\"Set('".$field."','FFFF99')\" ></td>
    </tr>
    <tr>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#00FFFF' onmouseover=\"View('".$field."','00FFFF')\" onclick=\"Set('".$field."','00FFFF')\" ></td>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#9900CC' onmouseover=\"View('".$field."','9900CC')\" onclick=\"Set('".$field."','9900CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#9933CC' onmouseover=\"View('".$field."','9933CC')\" onclick=\"Set('".$field."','9933CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#9966CC' onmouseover=\"View('".$field."','9966CC')\" onclick=\"Set('".$field."','9966CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#9999CC' onmouseover=\"View('".$field."','9999CC')\" onclick=\"Set('".$field."','9999CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#99CCCC' onmouseover=\"View('".$field."','99CCCC')\" onclick=\"Set('".$field."','99CCCC')\" ></td>
    <td style='width:10px;height:10px;background-color:#99FFCC' onmouseover=\"View('".$field."','99FFCC')\" onclick=\"Set('".$field."','99FFCC')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC00CC' onmouseover=\"View('".$field."','CC00CC')\" onclick=\"Set('".$field."','CC00CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC33CC' onmouseover=\"View('".$field."','CC33CC')\" onclick=\"Set('".$field."','CC33CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC66CC' onmouseover=\"View('".$field."','CC66CC')\" onclick=\"Set('".$field."','CC66CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC99CC' onmouseover=\"View('".$field."','CC99CC')\" onclick=\"Set('".$field."','CC99CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#CCCCCC' onmouseover=\"View('".$field."','CCCCCC')\" onclick=\"Set('".$field."','CCCCCC')\" ></td>
    <td style='width:10px;height:10px;background-color:#CCFFCC' onmouseover=\"View('".$field."','CCFFCC')\" onclick=\"Set('".$field."','CCFFCC')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF00CC' onmouseover=\"View('".$field."','FF00CC')\" onclick=\"Set('".$field."','FF00CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF33CC' onmouseover=\"View('".$field."','FF33CC')\" onclick=\"Set('".$field."','FF33CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF66CC' onmouseover=\"View('".$field."','FF66CC')\" onclick=\"Set('".$field."','FF66CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF99CC' onmouseover=\"View('".$field."','FF99CC')\" onclick=\"Set('".$field."','FF99CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#FFCCCC' onmouseover=\"View('".$field."','FFCCCC')\" onclick=\"Set('".$field."','FFCCCC')\" ></td>
    <td style='width:10px;height:10px;background-color:#FFFFCC' onmouseover=\"View('".$field."','FFFFCC')\" onclick=\"Set('".$field."','FFFFCC')\" ></td>
    </tr>
    <tr>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF00FF' onmouseover=\"View('".$field."','FF00FF')\" onclick=\"Set('".$field."','FF00FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#9900FF' onmouseover=\"View('".$field."','9900FF')\" onclick=\"Set('".$field."','9900FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#9933FF' onmouseover=\"View('".$field."','9933FF')\" onclick=\"Set('".$field."','9933FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#9966FF' onmouseover=\"View('".$field."','9966FF')\" onclick=\"Set('".$field."','9966FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#9999FF' onmouseover=\"View('".$field."','9999FF')\" onclick=\"Set('".$field."','9999FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#99CCFF' onmouseover=\"View('".$field."','99CCFF')\" onclick=\"Set('".$field."','99CCFF')\" ></td>
    <td style='width:10px;height:10px;background-color:#99FFFF' onmouseover=\"View('".$field."','99FFFF')\" onclick=\"Set('".$field."','99FFFF')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC00FF' onmouseover=\"View('".$field."','CC00FF')\" onclick=\"Set('".$field."','CC00FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC33FF' onmouseover=\"View('".$field."','CC33FF')\" onclick=\"Set('".$field."','CC33FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC66FF' onmouseover=\"View('".$field."','CC66FF')\" onclick=\"Set('".$field."','CC66FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC99FF' onmouseover=\"View('".$field."','CC99FF')\" onclick=\"Set('".$field."','CC99FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#CCCCFF' onmouseover=\"View('".$field."','CCCCFF')\" onclick=\"Set('".$field."','CCCCFF')\" ></td>
    <td style='width:10px;height:10px;background-color:#CCFFFF' onmouseover=\"View('".$field."','CCFFFF')\" onclick=\"Set('".$field."','CCFFFF')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF00FF' onmouseover=\"View('".$field."','FF00FF')\" onclick=\"Set('".$field."','FF00FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF33FF' onmouseover=\"View('".$field."','FF33FF')\" onclick=\"Set('".$field."','FF33FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF66FF' onmouseover=\"View('".$field."','FF66FF')\" onclick=\"Set('".$field."','FF66FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF99FF' onmouseover=\"View('".$field."','FF99FF')\" onclick=\"Set('".$field."','FF99FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#FFCCFF' onmouseover=\"View('".$field."','FFCCFF')\" onclick=\"Set('".$field."','FFCCFF')\" ></td>
    <td style='width:10px;height:10px;background-color:#FFFFFF' onmouseover=\"View('".$field."','FFFFFF')\" onclick=\"Set('".$field."','FFFFFF')\" ></td>
    </tr>
    </table>
    </div>
    \n";

return $text;
}


?>