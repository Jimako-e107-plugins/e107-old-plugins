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
$e1=explode("|",$pref['mobile_colourScheme']);
return $e1;
}

function em_sendVals($vals) {
$store=implode($vals,"|");
return $store;
}

if (isset($_POST['update_prefs'])) {

// checkbox for no images
if(!$_POST['settings'][7]) {
$_POST['settings'][7]='off';
}

// remove pipes from name
$_POST['settings'][0]=str_replace("|","&#124;",$_POST['settings'][0]);

$settings=em_sendVals($_POST['settings']);

	// Validation
	$regex1="/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/"; // HEX Colour

	if (preg_match($regex1,$_POST['settings'][1]) || preg_match($regex1,$_POST['settings'][2])) {
	$pref['mobile_colourScheme'] = $tp->toDB($settings);
	save_prefs();
	$message = "Settings saved";
	}
	else {
	$message = "The form contained an invalid value. Settings NOT saved!";
	}
}

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

// Colour Scheme list
$cols=array("#808080","#000000","#f0f0f0","#ffffff");
$em_prefs=em_getVals();

// checkbox for no images
$imgch=$em_prefs[7]=='on' ? 'checked':'';

$text .= '
<div style="text-align:center">
<form name="settings_form" action="'.e_SELF.'" method="post">
	<fieldset>
		<legend>
			'.LAN_EMP_1.'
		</legend>
		<table border="0" class="tborder" style="width:100%;text-align:center;" cellspacing="10">';

		if($mobileThemeok) {

			$text .='<tr>
				<td class="tborder" style="width: 30%">
					<span class="smalltext" style="font-weight: bold">
						'.LAN_EMP_15.'
					</span>
				</td>
				<td class="tborder" style="width: 40%">
					<input class="tbox" type="textbox" name="settings[0]" value="'.$em_prefs[0].'" size="20" />
				</td>

				<td rowspan="8">
				'.LAN_EMP_19.'
				<div id="framearea" style="height:320px;width:240px">
				<div id="framecover" style="position:absolute; z-index:2; height:320px;width:240px"><img src="images/dot.gif" width="240px" height="320px" BORDER="1" onmousedown="this.oncontextmenu=new Function(\'return false\')" onmouseup="this.oncontextmenu=new Function(\'return false\')"></div>
				<iframe id="mainframe" scrolling="no" src="'.SITEURL.'news.php?e107mobile=temp" frameborder="1" STYLE="position:absolute; z-index:1; height:320px; width:240px"></iframe>
				</div>
				</td>
			</tr>';

					$text .='<tr>
						<td class="tborder" style="width: 30%">
							<span class="smalltext" style="font-weight: bold">
								'.LAN_EMP_ST_1.'
							</span>
						</td>
						<td class="tborder" style="width: 40%">
						';

			$text .="
			<input class=\"tbox\" type=\"textbox\" name=\"settings[1]\" value='".$em_prefs[1]."' >
			<a href=\"javascript:TCP.popup(document.forms['settings_form'].elements['settings[1]'])\"><img width=\"15\" height=\"13\" border=\"0\" alt=\"Click Here to Pick up the color\" src=\"img/sel.gif\"></a>
			";

			$text .='</td>
				</tr>

				<tr>
						<td class="tborder" style="width: 30%">
							<span class="smalltext" style="font-weight: bold">
								'.LAN_EMP_ST_2.'
							</span>
						</td>
						<td class="tborder" style="width: 40%">
						';

			$text .="
			<input class=\"tbox\" type=\"textbox\" name=\"settings[2]\" value='".$em_prefs[2]."'>
			<a href=\"javascript:TCP.popup(document.forms['settings_form'].elements['settings[2]'])\"><img width=\"15\" height=\"13\" border=\"0\" alt=\"Click Here to Pick up the color\" src=\"img/sel.gif\"></a>
			";

			$text .='</td>
					</tr>

			<tr>
				<td class="tborder" style="width: 30%">
					<span class="smalltext" style="font-weight: bold">
						'.LAN_EMP_14.'
					</span>
				</td>
				<td class="tborder" style="width: 40%">
					<input class="tbox" type="textbox" name="settings[]" value="'.$em_prefs[3].'" size="3" />em
				</td>

			</tr>

			<tr>
				<td class="tborder" style="width: 30%">
					<span class="smalltext" style="font-weight: bold">
						'.LAN_EMP_16.'
					</span>
				</td>
				<td class="tborder" style="width: 40%">
					<input class="tbox" type="textbox" name="settings[4]" value="'.$em_prefs[4].'" size="3" />em

				</td>
			</tr>

			<tr>
				<td class="tborder" style="width: 30%">
					<span class="smalltext" style="font-weight: bold">
						'.LAN_EMP_13.'
					</span>
				</td>
				<td class="tborder" style="width: 40%">
					<input class="tbox" type="textbox" name="settings[5]" value="'.$em_prefs[5].'" size="3" />px
				</td>

			</tr>

			<tr>
				<td class="tborder" style="width: 30%">
					<span class="smalltext" style="font-weight: bold">
						'.LAN_EMP_18.'
					</span>
				</td>
				<td class="tborder" style="width: 40%">
					<input class="tbox" type="textbox" name="settings[6]" value="'.$em_prefs[6].'" size="3" />px
				</td>

			</tr>

			<tr>
				<td class="tborder" style="width: 30%">
					<span class="smalltext" style="font-weight: bold">
						'.LAN_EMP_17.'
					</span>
				</td>
				<td class="tborder" style="width: 40%">
					<input type="checkbox" name="settings[7]" '.$imgch.'/>
				</td>

			</tr>
			';

		}



				else {
					$text .="<h3>".LAN_EMP_8."</h3>";
				}

		$text .='
		</table>
	</fieldset>
	<br />
	<input class="button" type="submit" name="update_prefs" value="'.LAN_EMP_5.'">
	<br />
</form>
<br /><a href="http://www.martinj.co.uk">e107Mobile by Martinj</a>
</div>
';

$caption = LAN_EMP_5;
$ns->tablerender($caption, $text);

require_once(e_ADMIN."footer.php");
?>