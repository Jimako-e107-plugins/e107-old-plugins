<?php
/*
+ ----------------------------------------------------------------------------+
|    e107 website system
|
|    ©Steve Dunstan 2001-2002
|    http://e107.org
|    jalist@e107.org
|
|    Released under the terms and conditions of the
|    GNU General Public License (http://gnu.org).
|
|    $Source: /cvsroot/e107/e107_0.7/e107_plugins/custom_theme/admin_custom_theme_config.php,v $
|    $Revision: 1.0 $
|    $Date: 2005/06/20 13:36:44 $
|    $Author: lisa_ $
+----------------------------------------------------------------------------+
*/

require_once("../../class2.php");
require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."form_handler.php");
$rs = new form;
require_once(e_HANDLER."file_class.php");
$fl = new e_file;
unset($text);

@include_once(e_PLUGIN.'custom_theme/languages/'.e_LANGUAGE.'.php');
@include_once(e_PLUGIN.'custom_theme/languages/English.php');

// ##### update data in database -----------------------------------------------------------------------------------------------------
if(isset($_POST['update_custom_theme'])){
	while(list($key, $value) = each($_POST)){
		if($key != "update_custom_theme"){
				$key = str_replace("_php", ".php", $key);

				//PLUGIN themes
				if($key != "custompages" && $key != "customthemes"){
					if($value && $value != "none"){
						$newpref[$key] = $value;
					}
				}

				//PAGENAME to set theme
				if($key == "custompages"){
					$array_custompages = $value;
				}
				//THEME for page name
				if($key == "customthemes"){
					$array_customthemes = $value;
				}

				if($array_custompages != "" && $array_customthemes != ""){
					if(count($array_custompages) == count($array_customthemes)){
						for($b=0;$b<count($array_custompages);$b++){
							$c=$b*2;
							$d=($b*2)+1;
							$custompages[$c] = $array_custompages[$b];
							$custompages[$d] = $array_customthemes[$b];
						}
					}
				}

				if(is_array($custompages)){
					$amount = count($custompages)/2;
					for($i=0;$i<$amount;$i++){						
						$k=$i*2;
						$m=($i*2)+1;
						if($custompages[$k] != CUSTOMTHEME_LAN_10){
							if($custompages[$m]!="" && $custompages[$m]!="none"){
								$newpref[$custompages[$k]] = $custompages[$m];
								
							}
						}
					}
				}
		}
		
	}
	$tmp = $eArrayStorage->WriteArray($newpref);
	$sql -> db_Update("core", "e107_value='$tmp' WHERE e107_name='custom_theme' ");

	$message = CUSTOMTHEME_LAN_9;
}
// ##### end -------------------------------------------------------------------------------------------------------------------------

// ##### check data from database ----------------------------------------------------------------------------------------------------
if(!is_object($sql)){ $sql = new db; }
$num_rows = $sql -> db_Select("core", "*", "e107_name='custom_theme' ");
if($num_rows == 0){
	$sql -> db_Insert("core", "'custom_theme', '' ");
	$sql -> db_Select("core", "*", "e107_name='custom_theme' ");
}
$row = $sql -> db_Fetch();
$customtheme_pref = $eArrayStorage->ReadArray($row['e107_value']);
// ##### end -------------------------------------------------------------------------------------------------------------------------

if(isset($message)){
	$caption = CUSTOMTHEME_LAN_12;
	$ns -> tablerender($caption, $message);
}

$rejectArray = array('templates','^\.$','^\.\.$','^\/$','^CVS$','thumbs\.db','.*\._$');
$dirlist = $fl -> get_dirs(e_THEME, $fmask = '', $rejectArray);

// ##### plugin theme ----------------------------------------------------------------------------------------------------------------
if(!is_object($sql)){ $sql = new db; }
if($numbers = $sql -> db_Select("plugin", "*", "plugin_installflag = '1' AND plugin_path != 'custom_theme' ORDER BY plugin_name ")){
	
	$text .= "
	<div style='text-align:center'>
	".$rs -> form_open("post", e_SELF, "custom_theme_form", "", "enctype='multipart/form-data'")."
	<table class='fborder' style='".ADMIN_WIDTH."'>
	<tr><td class='fcaption' colspan='2'>".CUSTOMTHEME_LAN_1." : ".CUSTOMTHEME_LAN_2."</td></tr>
	<tr>
		<td class='forumheader' style='white-space:nowrap;'>".CUSTOMTHEME_LAN_4."</td>
		<td class='forumheader' style='width:30%; text-align:center;'>".CUSTOMTHEME_LAN_6."</td>
	</tr>";

	while($row = $sql -> db_Fetch()){
		$plugin_path = $row['plugin_path'];
		$text .= "
		<tr>
		<td class='forumheader3' style='white-space:nowrap;'>".$row['plugin_name']." (".$row['plugin_version'].")</td>
		<td class='forumheader3' style='width:30%; text-align:center'>
		<select name='".$plugin_path."' class='tbox'>\n";
			$text .= $rs -> form_option("none", "1", "none")."\n";
			foreach($dirlist as $theme){
				$text .= $rs -> form_option($theme, ($customtheme_pref[$plugin_path] == $theme ? "1" : "0"), $theme)."\n";
			}
		$text .= "</select>
		</td>
		</tr>";
	}
	$text .= "</table>";
}

$text .= "<br />
<table class='fborder' style='".ADMIN_WIDTH."'>
<tr><td class='fcaption' colspan='2'>".CUSTOMTHEME_LAN_1." : ".CUSTOMTHEME_LAN_3."</td></tr>
<tr>
<td class='forumheader' style='white-space:nowrap;'>".CUSTOMTHEME_LAN_5."</td>
<td class='forumheader' style='width:30%; text-align:center;'>".CUSTOMTHEME_LAN_6."</td>
</tr>";

$text .= "
</table>
<div id='up_container' style='width:100%;'>
	<table class='fborder' style='".ADMIN_WIDTH."'>";
	foreach($customtheme_pref as $key => $value){
		if(strpos($key, ".php")){
			$text .= "	
			<tr>
				<td class='forumheader3' style='white-space:nowrap;'>".$key."</td>
				<td class='forumheader3' style='width:30%; white-space:nowrap; text-align:center;'>
					<select name='".$key."' id='".$key."' class='tbox'>\n";
					$text .= $rs -> form_option("none", "1", "none")."\n";
					foreach($dirlist as $theme){
						$text .= $rs -> form_option($theme, ($value == $theme ? "1" : "0"), $theme)."\n";
					}
					$text .= "</select>
				</td>
			</tr>";
		}
	}
	$text .= "
	</table>

	<div id='upline'>
	<table class='fborder' style='".ADMIN_WIDTH."'>
		<tr>
			<td class='forumheader3' style='white-space:nowrap;'>
				<input class='tbox' type='text' name='custompages[]' value='".CUSTOMTHEME_LAN_10."' size='30' maxlength='50' onfocus=\"if(this.value=='".CUSTOMTHEME_LAN_10."'){ this.value=''; }\" />
			</td>
			<td class='forumheader3' style='width:30%; white-space:nowrap; text-align:center;'>
				<select name='customthemes[]' class='tbox'>\n";
				$text .= $rs -> form_option("none", "1", "none")."\n";
				foreach($dirlist as $theme){
					$text .= $rs -> form_option($theme, "0", $theme)."\n";
				}
				$text .= "</select>
			</td>
		</tr>
	</table>
	</div>
</div><br />

<table class='fborder' style='".ADMIN_WIDTH."'><tr><td>
".$rs -> form_button("button", "add", CUSTOMTHEME_LAN_11, "onclick=\"duplicateHTML('upline','up_container');\"" )."
</td></tr></table>

<br />
<table class='fborder' style='".ADMIN_WIDTH."'>
<tr>
<td style='text-align:center' class='forumheader'>
".$rs -> form_button("submit", "update_custom_theme", CUSTOMTHEME_LAN_7)."
</td>
</tr>
</table>
".$rs -> form_close()."
</div>";

$ns -> tablerender(CUSTOMTHEME_LAN_8, $text);

// ##### end -------------------------------------------------------------------------------------------------------------------------

require_once(e_ADMIN."footer.php");

?>
