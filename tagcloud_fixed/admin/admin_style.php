<?php

   require_once("../../../class2.php");
   require_once(e_PLUGIN.'tagcloud/tagcloud_class.php');
   $tagcloud = new e107tagcloud;

   if (!getperms("P")) {
      header("location:".e_HTTP."index.php");
      exit;
   }


   require_once(e_ADMIN."auth.php");



//-------------------------------------------------------
//----------------  Handle form posting




if (isset($_POST['updatesettings'])) {


        $pref['tags_style_cloud'] = ($_POST['tags_style_cloud'] ? $_POST['tags_style_cloud'] : '' );
        $pref['tags_style_item'] = ($_POST['tags_style_item'] ? $_POST['tags_style_item'] : '' );
        $pref['tags_style_link'] = ($_POST['tags_style_link'] ? $_POST['tags_style_link'] : '' );
        $pref['tags_max_colour'] = ($_POST['tags_max_colour'] ? $_POST['tags_max_colour'] : '' );
        $pref['tags_min_colour'] = ($_POST['tags_min_colour'] ? $_POST['tags_min_colour'] : '' );
        $pref['tags_min_size'] = ($_POST['tags_min_size'] ? $_POST['tags_min_size'] : 100 );
        $pref['tags_max_size'] = ($_POST['tags_max_size'] ? $_POST['tags_max_size'] : 250 );

	save_prefs();
	$e107cache->clear("tagcloud");
	$message = 'Settings Saved!';
}


   // Display
   if (isset($message)) {
	$ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}

$tags_style_cloud = $pref['tags_style_cloud'];
$tags_style_item  = $pref['tags_style_item'];
$tags_style_link  = $pref['tags_style_link'];
$tags_min_size    = $pref['tags_min_size'];
$tags_max_size    = $pref['tags_max_size'];
$tags_max_colour  = $pref['tags_max_colour'];
$tags_min_colour  = $pref['tags_min_colour'];

$text = "<div style='text-align:center'>
	<form method='post' action='".e_SELF."' id='cfgform'>
	<table style='".ADMIN_WIDTH."' class='fborder'>

	<tr>
	<td class='forumheader3' style='width:40%'>Cloud CSS class:</td>
	<td class='forumheader3' style='width:60%'>
	<input  class='tbox' type='text' name='tags_style_cloud' value = '".$tags_style_cloud."' SIZE='20' MAXLENGTH='20'/>
	</td>
	</tr>

	<tr>
	<td class='forumheader3' style='width:40%'>Item Tags CSS class:</td>
	<td class='forumheader3' style='width:60%'>
	<input  class='tbox' type='text' name='tags_style_item' value = '".$tags_style_item."' SIZE='20' MAXLENGTH='20'/>
	</td>
	</tr>
	
	<tr>
	<td class='forumheader3' style='width:40%'>Tag link page CSS class:</td>
	<td class='forumheader3' style='width:60%'>
	<input  class='tbox' type='text' name='tags_style_link' value = '".$tags_style_link."' SIZE='20' MAXLENGTH='20'/>
	</td>
	</tr>

	<tr>
	<td class='forumheader3' style='width:40%'>Min Tag Size:</td>
	<td class='forumheader3' style='width:60%'>
	<input  class='tbox' type='text' name='tags_min_size' value = '".$tags_min_size."' SIZE='3' MAXLENGTH='3'/>
	</td>
	</tr>

        <tr>
	<td class='forumheader3' style='width:40%'>Max Tag Size:</td>
	<td class='forumheader3' style='width:60%'>
	<input  class='tbox' type='text' name='tags_max_size' value = '".$tags_max_size."' SIZE='3' MAXLENGTH='3'/>
	</td>
	</tr>
	
	<tr>
	<td class='forumheader3' style='width:40%'>Tag Colour Gradient Start:</td>
	<td class='forumheader3' style='width:60%'>
	<input  class='tbox' type='text' name='tags_min_colour' value = '".$tags_min_colour."' SIZE='20' MAXLENGTH='20'/>
	</td>
	</tr>
	
	<tr>
	<td class='forumheader3' style='width:40%'>Tag Colour Gradient End:</td>
	<td class='forumheader3' style='width:60%'>
	<input  class='tbox' type='text' name='tags_max_colour' value = '".$tags_max_colour."' SIZE='20' MAXLENGTH='20'/>
	</td>
	</tr>

	<tr>
	<td  class='forumheader' colspan='2' style='text-align:center'>
	<input class='button' type='submit' name='updatesettings' value='Save Settings' />
	</td>
	</tr>
	</table>
	</form>
	</div>";





   // The usual, tell e107 what to include on the page
   $ns->tablerender("Prefs", $text);

   require_once(e_ADMIN."footer.php");
?>

