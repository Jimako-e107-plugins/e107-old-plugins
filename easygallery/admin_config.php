<?php
/*
+------------------------------------------------------------------------------+
|   EasyGallery - a plugin by nlstart
|
|	Plugin Support Site: e107.webstartinternet.com
|
|	For the e107 website system visit http://e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+------------------------------------------------------------------------------+
*/
$eplug_admin = true;
require_once('../../class2.php');
if ( ! getperms('P')) { header('location:'.e_BASE.'index.php'); exit(); }
require_once(e_ADMIN.'auth.php');
require_once(e_HANDLER."userclass_class.php");
include_lan(e_PLUGIN.'easygallery/languages/'.e_LANGUAGE.'.php');
// Set the active menu option for admin_menu.php
$pageid = 'admin_menu_01';

// If the submit button is hit; update the settings in table core, record SitePrefs
// Initial default values of the preferences are set by plugin.php at $eplug_prefs
if (isset($_POST['update_prefs'])) 
{
	$message = '';
	// Check incoming values
	if (intval($_POST['full_max_size']) == 0 || strlen(intval($_POST['full_max_size'])) == 0)
	{
		$message .= EG_CONF_40."<br />";
	}
	if (intval($_POST['size']) == 0 || strlen(intval($_POST['size'])) == 0)
	{
		$message .= EG_CONF_39."<br />";
	}
    // Add a trailing slash to the path in case there is none
    if (substr($_POST['fulls'],-1) != '/') 
	{
      $_POST['fulls'] = $_POST['fulls'].'/';
    }
	$pref['easygallery_settings']        = array(
		'full_max_size'		=> intval($_POST['full_max_size']),
		'size'				=> intval($_POST['size']),
		'universal'			=> intval($_POST['universal']),
		'borderR'			=> intval($_POST['borderR']),
		'borderG'			=> intval($_POST['borderG']),
		'borderB'			=> intval($_POST['borderB']),
		'albums'			=> intval($_POST['albums']),
		'imagequality'		=> intval($_POST['imagequality']),
		'fileName'			=> intval($_POST['fileName']),
		'internalDisplay'	=> intval($_POST['internalDisplay']),
		'sortOrder'			=> $tp->toDB($_POST['sortOrder']),
		'deleteThumbs'		=> intval($_POST['deleteThumbs']),
		'imagemethod'		=> $tp->toDB($_POST['imagemethod']),
		'convert'			=> $tp->toDB($_POST['convert']),
		'identify'			=> $tp->toDB($_POST['identify']),
		'fulls'				=> $tp->toDB($_POST['fulls']), 
		'show_comments'		=> intval($_POST['show_comments']), 
		'upload_class'		=> intval($_POST['upload_class']),
		'max_uploads'		=> intval($_POST['max_uploads'])
		);
	save_prefs(); // Function save_prefs (class2.php) automatically runs $tp -> toDB on every posted pref before saving 
	$message .= EG_CONF_11;
}
// Displays the update message to confirm data is stored in database
if (isset($message) && strlen($message) > 0) 
{
	$ns->tablerender('', "<div style='text-align:center;font-weight: bold;'>".$message."</div>");
}

extract($pref['easygallery_settings']);
if($imagequality < 0) {$imagequality = 0;}
if($imagequality > 100) {$imagequality = 100;}
$text = "
<div style='".ADMIN_WIDTH."'>
<form id='settings_form' action='".e_SELF."' method='post'>
	<fieldset>
		<legend>
			".EG_CONF_01."
		</legend>
		<table border='0' class='fborder' cellspacing='10'>
			<tr>
				<td class='fcaption' style='width:70%'>
					<span class='smalltext' style='font-weight: bold'>".EG_CONF_32." ".e_PLUGIN."easygallery/</span>
				</td>
				<td class='fcaption' style='width:30%'>
					<input class='tbox' size='25' type='text' name='fulls' value='".$fulls."' />
				</td>
			</tr>
			<tr>
				<td class='fcaption' style='width:70%'>
					<span class='smalltext' style='font-weight: bold'>".EG_CONF_37."</span>
				</td>
				<td class='fcaption' style='width:30%' valign='top'>
					<input class='tbox' size='3' type='text' name='full_max_size' value='".$full_max_size."' /> ".EG_CONF_38."
				</td>
			</tr>			
			<tr>
				<td class='fcaption' style='width:70%'>
					<span class='smalltext' style='font-weight: bold'>".EG_CONF_02."</span>
				</td>
				<td class='fcaption' style='width:30%'>
					<input class='tbox' size='3' type='text' name='size' value='".$size."' /> ".EG_CONF_38."
				</td>
			</tr>
			<tr>
				<td class='fcaption' style='width:70%'>
					<span class='smalltext' style='font-weight: bold'>".EG_CONF_03."</span>
				</td>
				<td class='fcaption' style='width:30%' valign='top'>
					<select class='tbox' name='universal'>
						<option value='1'".(($universal == '1' || $universal == '')? "selected='selected'":'').">".EG_CONF_05."</option>
						<option value='0'".(($universal == '0')? "selected='selected'":'').">".EG_CONF_06."</option>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan='2' class='fcaption' style='width:100%' valign='top'>
					<img src='".e_IMAGE."admin_images/docs_16.png' alt='' /> ".EG_CONF_04."
				</td>
			</tr>
			<tr>
				<td class='fcaption' style='width:70%'>
					<span class='smalltext' style='font-weight: bold'>".EG_CONF_07."</span>
				</td>
				<td class='fcaption' style='width:30%'>
					<input class='tbox' size='3' type='text' name='borderR' value='".$borderR."' />
					<input class='tbox' size='3' type='text' name='borderG' value='".$borderG."' />
					<input class='tbox' size='3' type='text' name='borderB' value='".$borderB."' />
				</td>
			</tr>
			<tr>
				<td colspan='2' class='fcaption' style='width:100%' valign='top'>
					<img src='".e_IMAGE."admin_images/docs_16.png' alt='' /> ".EG_CONF_08."
				</td>
			</tr>";

$text .= " 
			<input type='hidden' name='albums' value='1' />
			<tr>
				<td class='fcaption' style='width:70%'>
					<span class='smalltext' style='font-weight: bold'>
						".EG_CONF_12."
					</span>
				</td>
				<td class='fcaption' style='width:30%'>
					<input class='tbox' size='3' type='text' name='imagequality' value='".$imagequality."' />
				</td>
			</tr>
			<tr>
				<td class='fcaption' style='width:70%'>
					<span class='smalltext' style='font-weight: bold'>
						".EG_CONF_13."
					</span>
				</td>
				<td class='fcaption' style='width:30%' valign='top'>
					<select class='tbox' name='fileName'>
						<option value='1'".(($fileName == '1' || $fileName == '')? "selected='selected'":'').">".EG_CONF_05."</option>
						<option value='0'".(($fileName == '0')? "selected='selected'":'').">".EG_CONF_06."</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class='fcaption' style='width:70%'>
					<span class='smalltext' style='font-weight: bold'>".EG_CONF_14."</span>
				</td>
				<td class='fcaption' style='width:30%' valign='top'>
					<select class='tbox' name='internalDisplay'>
						<option value='1'".(($internalDisplay == '1' || $internalDisplay == '')? "selected='selected'":'').">".EG_CONF_05."</option>
						<option value='0'".(($internalDisplay == '0')? "selected='selected'":'').">".EG_CONF_06."</option>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan='2' class='fcaption' style='width:100%' valign='top'>
					<img src='".e_IMAGE."admin_images/docs_16.png' alt='' /> ".EG_CONF_15."
				</td>
			</tr>
			<tr>
				<td class='fcaption' style='width:70%'>
					<span class='smalltext' style='font-weight: bold'>
						".EG_CONF_16."
					</span>
				</td>
				<td class='fcaption' style='width:30%' valign='top'>
					<select class='tbox' name='sortOrder'>
						<option value='nameASC'".(($sortOrder == 'nameASC' || $sortOrder == '')? "selected='selected'":'').">".EG_CONF_17."</option>
						<option value='nameDESC'".(($sortOrder == 'nameDESC')? "selected='selected'":'').">".EG_CONF_18."</option>
						<option value='oldFIRST'".(($sortOrder == 'oldFIRST')? "selected='selected'":'').">".EG_CONF_19."</option>
						<option value='newFIRST'".(($sortOrder == 'newFIRST')? "selected='selected'":'').">".EG_CONF_20."</option>
					</select>
				</td>
			</tr>			
			<tr>
				<td class='fcaption' style='width:70%'>
					<span class='smalltext' style='font-weight: bold'>
						".EG_CONF_21."
					</span>
				</td>
				<td class='fcaption' style='width:30%' valign='top'>
					<select class='tbox' name='deleteThumbs'>
						<option value='0'".(($deleteThumbs == '0')? "selected='selected'":'').">".EG_CONF_22."</option>
						<option value='1'".(($deleteThumbs == '1')? "selected='selected'":'').">".EG_CONF_23."</option>
						<option value='2'".(($deleteThumbs == '2' || $deleteThumbs == '')? "selected='selected'":'').">".EG_CONF_24."</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class='fcaption' style='width:70%'>
					<span class='smalltext' style='font-weight: bold'>
						".EG_CONF_25."
					</span>
				</td>
				<td class='fcaption' style='width:30%' valign='top'>
					<select class='tbox' name='imagemethod'>
						<option value='gd2'".(($imagemethod == 'gd2' || $imagemethod == '')? "selected='selected'":'').">".EG_CONF_26."</option>
						<option value='imagemagick'".(($imagemethod == 'imagemagick')? "selected='selected'":'').">".EG_CONF_27."</option>
					</select>
				</td>
			</tr>";

if($imagemethod == 'imagemagick')
{
	$text .= "
			<tr>
				<td class='fcaption' style='width:70%'>
					<span class='smalltext' style='font-weight: bold'>
						".EG_CONF_28."
					</span>
				</td>
				<td class='fcaption' style='width:30%'>
					<input class='tbox' size='25' type='text' name='convert' value='".$convert."' />
				</td>
			</tr>
			<tr>
				<td colspan='2' class='fcaption' style='width:100%' valign='top'>
					<img src='".e_IMAGE."admin_images/docs_16.png' alt='' /> ".EG_CONF_29."
					<br />".EG_CONF_36.": ".$pref['im_path']."
				</td>
			</tr>
			<tr>
				<td class='fcaption' style='width:70%'>
					<span class='smalltext' style='font-weight: bold'>
						".EG_CONF_30."
					</span>
				</td>
				<td class='fcaption' style='width:30%'>
					<input class='tbox' size='25' type='text' name='identify' value='".$identify."' />
				</td>
			</tr>
			<tr>
				<td colspan='2' class='fcaption' style='width:100%' valign='top'>
					<img src='".e_IMAGE."admin_images/docs_16.png' alt='' /> ".EG_CONF_31."
					<br />".EG_CONF_36.": ".str_replace("convert", "identify", $pref['im_path'])."
				</td>
			</tr>";
}
			
$text .= "
			<tr>
				<td class='fcaption' style='width:70%'>
					<span class='smalltext' style='font-weight: bold'>
						".EG_CONF_33."
					</span>
				</td>
				<td class='fcaption' style='width:30%' valign='top'>
					<select class='tbox' name='show_comments'>
						<option value='1'".(($show_comments == '1')? "selected='selected'":'').">".EG_CONF_05."</option>
						<option value='0'".(($show_comments == '0' || $show_comments == '')? "selected='selected'":'')." />".EG_CONF_06."</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class='fcaption' style='width:70%'>
					<span class='smalltext' style='font-weight: bold'>
						".EG_CONF_34."
					</span>
				</td>
				<td class='fcaption' style='width:30%' valign='top'>
      					".r_userclass('upload_class', $upload_class, 'off', 'public,guest,member,nobody,main,admin,classes')."
				</td>
			</tr>
			<tr>
				<td class='fcaption' style='width:70%'>
					<span class='smalltext' style='font-weight: bold'>
						".EG_CONF_35."
					</span>
				</td>
				<td class='fcaption' style='width:30%' valign='top'>
					<select class='tbox' name='max_uploads'>";
	for($i=1; $i<=10; $i++)
	{
		$text .= "
					<option value='".$i."'".(($max_uploads == $i)? "selected='selected'":"").">".$i."</option>";
	}
	$text .= "
					</select>
				</td>
			</tr>			
		</table>
		<br />
		<div style='text-align:center;'><input class='button' type='submit' name='update_prefs' value='".EG_CONF_10."' /></div>
	</fieldset>
</form>
</div>
";
// Display the $text string into a rendered table with a caption from the language file
$caption = EG_CONF_00;
$ns->tablerender($caption, $text);
// Display the footer of the current website
require_once(e_ADMIN.'footer.php');
?>