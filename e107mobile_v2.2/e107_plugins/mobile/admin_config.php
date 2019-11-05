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

@include_once(e_PLUGIN."mobile/languages/".e_LANGUAGE.".php");
@include_once(e_PLUGIN."mobile/languages/English.php");

require_once(e_HANDLER."form_handler.php");
	$rs = new form;
require_once(e_HANDLER."file_class.php");
	$fl = new e_file;
unset($text);

if (isset($_POST['update_prefs'])) {

	$pref['mobile_active'] = $tp->toDB($_POST['active']);
	$pref['mobile_theme']  = $tp->toDB($_POST['theme']);
	$pref['mobile_menu']   = $tp->toDB($_POST['mobile_menu']);
	$pref['mobile_iphone'] = $tp->toDB($_POST['iphone']);
	save_prefs();
	$message = "Settings saved";
}

if($message2 !="") {
$text .="<fieldset>
		<legend>
			".EMP_WARN_0."
		</legend>
		<table border='0' class='tborder' cellspacing='10'><tr><td><B>".EMP_WARN_1."</B></td></tr>
		$message2</table>
		</fieldset><br/><br/>";
}

// displays the update message to confirm data is stored in database
if (isset($message)) {
	$ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}

$checked_active=($pref['mobile_active']=="true") ? 'checked' : '';

$filename=e_THEME."e107mobile/theme-css.php";
	if(file_exists($filename)) {
	$mobileThemeok=true;
	}
		else {
		$mobileThemeok=false;
		}

$text .= '
<div style="text-align:center">
<form name="settings_form" action="'.e_SELF.'" method="post">
	<fieldset>
		<legend>
			'.LAN_EMP_1.'
		</legend>
		<table border="0" class="tborder" cellspacing="10">

			<tr>
				<td class="tborder" style="width: 50%">
					<span class="smalltext" style="font-weight: bold">
						'.LAN_EMP_2.'
					</span>
				</td>
				<td class="tborder" style="width: 50%">
					<input type="checkbox" name="active" value="true" '.$checked_active.' />
				</td>
			</tr>

			<tr>
				<td class="tborder" style="width: 50%">
					<span class="smalltext" style="font-weight: bold">
						'.LAN_EMP_3.'
					</span>
				</td>
				<td class="tborder" style="width: 50%">';

				$rejectArray = array('templates','^\.$','^\.\.$','^\/$','^CVS$','thumbs\.db','.*\._$');
					$dirlist = $fl -> get_dirs(e_THEME, $fmask = '', $rejectArray);

					$text .="<select name='theme' id='theme' class='tbox'>";
					foreach($dirlist as $theme){
						$value=$pref['mobile_theme'];
						$text .= $rs -> form_option($theme, ($value == $theme ? "1" : "0"), $theme)."\n";
					}
					$text .= "</select></td></tr>

				<tr><td class='tborder' style='width: 50%'>
					<span class='smalltext' style='font-weight: bold'>
						".LAN_EMP_11."
					</span>
				</td>";

				$text .="<td><select name='iphone' id='iphone' class='tbox'>";
					foreach($dirlist as $theme){
						$value=$pref['mobile_iphone'];
						$text .= $rs -> form_option($theme, ($value == $theme ? "1" : "0"), $theme)."\n";
					}
					$text .= "</select></td></tr>";

					$text .= "<tr><td class='tborder' style='width: 50%'>
					<span class='smalltext' style='font-weight: bold'>
						".LAN_EMP_6."
					</span>
				</td>";

				$text .="<td><select name='mobile_menu' id='mobile_menu' class='tbox'>";
					$i=0;
					while($i<3) {
					$val=$pref['mobile_menu']==$i ? "SELECTED" : "";
						$text .="<option value='$i' $val />$i";
						$i++;
					}
					$text .= "</select> ".EMP_MENU_8."</td></tr>";
					
		$text .='
		</table>
	</fieldset>
	<br />
	<input class="button" type="submit" name="update_prefs" value="'.LAN_EMP_5.'">
	<br />
</form></div>
';

$text .="<fieldset>
		<legend>
			Support e107Mobile!
		</legend>
		<table border='0' class='tborder' cellspacing='10'><tr><td>
		<td><a href='http://www.martinj.co.uk/donate'><img src='".e_PLUGIN."mobile/images/paypalDonate.jpg' alt='Donate with Paypal' border='0'/></a></td>
		<td>e107Mobile is bought to you completely free of charge.
		Please consider making a donation towards the effort, time and commitment that has gone into making this widely used plugin.
		Your donations will ensure that we can continue to support e107mobile users and develop this plugin even further. Thank you.
		</td></tr></table>
		</fieldset><br/>";

$caption = LAN_EMP_5;
$ns->tablerender($caption, $text);

require_once(e_ADMIN."footer.php");
?>