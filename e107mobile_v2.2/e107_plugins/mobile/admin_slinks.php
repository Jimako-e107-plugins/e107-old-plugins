<?php
/*
+------------------------------------------------------------------------------+
|     e107 Mobile  v2.2 by Martinj
|	November 2010
|	Visit www.martinj.co.uk for help and support
+------------------------------------------------------------------------------+
*/

require_once("../../class2.php");
require_once(e_ADMIN."auth.php");

if (!getperms("P")) {
	header("location:".e_BASE."index.php");
	exit;
}

// [multilanguage]
@include_once(e_PLUGIN."mobile/languages/".e_LANGUAGE.".php");
@include_once(e_PLUGIN."mobile/languages/English.php");

require_once(e_HANDLER."form_handler.php");
$rs = new form;
require_once(e_HANDLER."file_class.php");
$fl = new e_file;
unset($text);

function em_getVals() {
global $pref;
$e1=explode("|",$pref['mobile_linkStyle']);
return $e1;
}

function em_sendVals($vals) {
$store=implode($vals,"|");
return $store;
}

if (isset($_POST['update_prefs'])) {
	$regex1="/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/"; // HEX Colour
	if (preg_match($regex1,$_POST['settingsSL'][0]) || preg_match($regex1,$_POST['settingsSL'][1])) {

	$settings=em_sendVals($_POST['settingsSL']);
		$pref['mobile_linkStyle'] = $tp->toDB($settings);
		save_prefs();
		$message = "Settings saved";
	}
	else {
	$message = "The form contained an invalid value. Settings NOT saved!";
	}
}

$em_prefsSL=explode("|",$pref['mobile_linkStyle']);

// displays the update message to confirm data is stored in database
if (isset($message)) {
	$ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}

$filename=e_THEME."e107mobile/e107mobile_class.php";
	if(file_exists($filename)) {
	$mobileThemeok="<div></div>";
	}
		else {
		$mobileThemeok=false;
		}

$text .= '
<div style="text-align:center">
<form name="settings_form" action="'.e_SELF.'" method="post">
	<fieldset>
		<legend>
			'.LAN_EMP_SL_1.'
		</legend>
		<table border="0" class="tborder" style="width:100%;text-align:center;" cellspacing="10">';

		if($mobileThemeok) {

			$text .='
				<tr>
						<td class="tborder" style="width: 30%">
							<span class="smalltext" style="font-weight: bold">
								'.LAN_EMP_SL_2.'
							</span>
						</td>
						<td class="tborder" style="width: 40%">
						';

			$text .="
			<input class=\"tbox\" type=\"textbox\" name=\"settingsSL[0]\" value='".$em_prefsSL[0]."'>
			<a href=\"javascript:TCP.popup(document.forms['settings_form'].elements['settingsSL[0]'])\"><img width=\"15\" height=\"13\" border=\"0\" alt=\"Click Here to Pick up the color\" src=\"img/sel.gif\"></a>
			</td>";

			$text .='

				<td rowspan="4">
				'.LAN_EMP_19.'
				<div id="framearea" style="height:320px;width:240px">
				<div id="framecover" style="position:absolute; z-index:2; height:320px;width:240px"><img src="images/dot.gif" width="240px" height="320px" BORDER="1" onmousedown="this.oncontextmenu=new Function(\'return false\')" onmouseup="this.oncontextmenu=new Function(\'return false\')"></div>
				<iframe id="mainframe" scrolling="no" src="'.SITEURL.'news.php?e107mobile=temp" frameborder="1" STYLE="position:absolute; z-index:1; height:320px; width:240px"></iframe>
				</div>
				</td></tr>';

			$text .='
				<tr>
						<td class="tborder" style="width: 30%">
							<span class="smalltext" style="font-weight: bold">
								'.LAN_EMP_SL_3.'
							</span>
						</td>
						<td class="tborder" style="width: 40%">
						';

			$text .="
			<input class='tbox' type'textbox' name='settingsSL[1]' value='".$em_prefsSL[1]."'>
			<a href=\"javascript:TCP.popup(document.forms['settings_form'].elements['settingsSL[1]'])\"><img width=\"15\" height=\"13\" border=\"0\" alt=\"Click Here to Pick up the color\" src=\"img/sel.gif\"></a>
			</td></tr>";
			
			$text .="<tr>
				<td class=\"tborder\">
					<span class=\"smalltext\" style=\"font-weight: bold\">
						".LAN_EMP_SL_4."
					</span>
				</td>
				<td class=\"tborder\">
					<select name='settingsSL[2]' class='tbox'>";
					$i=0.1;
					while($i<2.1) {
					$val=$em_prefsSL[2]=="$i" ? "SELECTED" : "";
						$text .="<option value='$i' $val />$i";
						$i=$i+0.1;
					}
				$text .= "</select>em
				</td>

			</tr>";
			
			$text .="<tr>
				<td class=\"tborder\">
					<span class=\"smalltext\" style=\"font-weight: bold\">
						".LAN_EMP_SL_6."
					</span>
				</td>
				<td class=\"tborder\">
					<select name='settingsSL[3]' class='tbox'>";
					if(!$em_prefsSL[3]) {
						$em_prefsSL[3]="3";
					}
					$i=1;
					while($i<5) {
					$val=$em_prefsSL[3]==$i ? "SELECTED" : "";
						$text .="<option value='$i' $val />$i";
						$i++;
					}
				$text .= "</select>
				</td>

			</tr>";
		}
			else
					$text .="<h3>".LAN_EMP_8."</h3>";

		$text .='
		</table>
		<br/><br/>
	</fieldset>
	<br />
	<input class="button" type="submit" name="update_prefs" value="'.LAN_EMP_5.'">
	<br />
</form>
<br/><a href="http://www.martinj.co.uk">e107Mobile by Martinj</a>
</div>
';

$caption = LAN_EMP_5;
$ns->tablerender($caption, $text);

require_once(e_ADMIN."footer.php");
?>