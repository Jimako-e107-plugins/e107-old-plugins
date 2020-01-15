<?php

require_once("admin_leftblock.php");

if (!getperms("P")) {
	header("location:".e_HTTP."index.php");
	exit;
}
 
class currentplugin_adminArea extends leftblock_adminArea
{
       
}

new currentplugin_adminArea();
 
require_once(e_PLUGIN.'tagcloud/tagcloud_class.php');
$tagcloud = new e107tagcloud;


$plugPrefs = e107::getPlugConfig('tagcloud')->getPref();
 
require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."userclass_class.php");
   //echo $plugPrefs['tags_adminmod'];

//-------------------------------------------------------
//----------------  Handle form posting
 
if (isset($_POST['updateseosettings'])) {
        $plugPrefs['tags_tagspace']   = ($_POST['tags_tagspace']   ? $_POST['tags_tagspace']   : '-');
        $plugPrefs['tags_useseo']     = ($_POST['tags_useseo']     ? $_POST['tags_useseo']     : 0);
        $plugPrefs['tags_seolink']    = ($_POST['tags_seolink']    ? $_POST['tags_seolink']    : '');
        $plugPrefs['tags_fileext']    = ($_POST['tags_fileext']    ? $_POST['tags_fileext']    : '');
	//savex_prefs();
	e107::getPlugConfig('tagcloud')->setPref($plugPrefs) -> save(false, true); 
	$e107cache->clear("tagcloud");
	$message = 'Settings Saved!';
}
 
// Display
if (isset($message)) {
$ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}

$tags_seolink  = $plugPrefs['tags_seolink'];
$tags_tagspace = $plugPrefs['tags_tagspace'];
$tags_fileext  = $plugPrefs['tags_fileext'];
 
if ($plugPrefs['tags_useseo']) {$tags_useseo ='checked';}

//---------------------------------------------
   $text=" <div style='text-align:center'>
	<form method='post' action='".e_SELF."' id='cfgform'>
	<table style='".ADMIN_WIDTH."' class='fborder'>

	<tr>
	<td class='forumheader3' style='width:40%'>Use SEO Links:</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='checkbox' name='tags_useseo' ".$tags_useseo." />
	</td>
	</tr>

	<tr>
	<td class='forumheader3' style='width:40%'>SEO Link structure: <div style='text-align:right'>".SITEURLBASE.e_HTTP."</div></td>
	<td class='forumheader3' style='width:60%'>
	<input  class='tbox' type='text' name='tags_seolink' value = '".$tags_seolink."' SIZE='50' MAXLENGTH='50'/>
	</td>
	</tr>

	<tr>
	<td class='forumheader3' style='width:40%'>File extension:</td>
	<td class='forumheader3' style='width:60%'>
	<input  class='tbox' type='text' name='tags_fileext' value = '".$tags_fileext."' SIZE='6' MAXLENGTH='6'/>
	</td>
	</tr>
	
	<tr>
	<td class='forumheader3' style='width:40%'>Replace space with:</td>
	<td class='forumheader3' style='width:60%'>
	<input  class='tbox' type='text' name='tags_tagspace' value = '".$tags_tagspace."' SIZE='1' MAXLENGTH='1'/>
	</td>
	</tr>

	<tr>
	<td  class='forumheader' colspan='2' style='text-align:center'>
	<input class='button' type='submit' name='updateseosettings' value='Save Settings' />
	</td>
	</tr>
	

        </table>
	</form>
	</div>";

   $ns->tablerender("SEO Prefs", $text);

   require_once(e_ADMIN."footer.php");
?>

