<?php

   require_once("../../class2.php");
   require_once(e_PLUGIN.'tagcloud/tagcloud_class.php');
   $tagcloud = new e107tagcloud;

   if (!getperms("P")) {
      header("location:".e_HTTP."index.php");
      exit;
   }


   require_once(e_ADMIN."auth.php");
   require_once(e_HANDLER."userclass_class.php");
   //echo $pref['tags_adminmod'];

//-------------------------------------------------------
//----------------  Handle form posting



if (isset($_POST['updatesettings'])) {


        $pref['tags_cumwidth']       = ($_POST['tags_cumwidth']       ? $_POST['tags_cumwidth']       : 0);
        $pref['tags_cumheight']      = ($_POST['tags_cumheight']      ? $_POST['tags_cumheight']      : 0);
        $pref['tags_cumcolour']      = ($_POST['tags_cumcolour']      ? $_POST['tags_cumcolour']      : 0);
        $pref['tags_cumbackcolour']  = ($_POST['tags_cumbackcolour']  ? $_POST['tags_cumbackcolour']  : 0);
        $pref['tags_cumtransparent'] = ($_POST['tags_cumtransparent'] ? $_POST['tags_cumtransparent'] : 0);
        $pref['tags_cumspeed']       = ($_POST['tags_cumspeed']       ? $_POST['tags_cumspeed']       : 0);

        $pref['tags_usecumulus']    = ($_POST['tags_usecumulus']    ? $_POST['tags_usecumulus']    : 0);


	save_prefs();
	$e107cache->clear("tagcloud");
	$message = 'Settings Saved!';
}


   // Display
   if (isset($message)) {
	$ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}

$tags_cumwidth       = $pref['tags_cumwidth'];
$tags_cumheight      = $pref['tags_cumheight'];
$tags_cumcolour      = $pref['tags_cumcolour'];
$tags_cumbackcolour  = $pref['tags_cumbackcolour'];
$tags_cumtransparent = $pref['tags_cumtransparent'];
$tags_cumspeed       = $pref['tags_cumspeed'];

if ($pref['tags_cumtransparent'])             {$tags_cumtransparent     ='checked';}
if ($pref['tags_usecumulus'])            {$tags_usecumulus  ='checked';}

$text = "<div style='text-align:center'>
	<form method='post' action='".e_SELF."' id='cfgform'>
	<table style='".ADMIN_WIDTH."' class='fborder'>

      	<tr>
	<td class='forumheader3' style='width:40%'>Use the Cumulus Flash style cloud</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='checkbox' name='tags_usecumulus' ".$tags_usecumulus." />
	</td>
	</tr>

	<tr>
	<td class='forumheader3' style='width:40%'>Cumulus Cloud Width</td>
	<td class='forumheader3' style='width:60%'>
	<input  class='tbox' type='text' name='tags_cumwidth' value = '".$tags_cumwidth."' SIZE='4' MAXLENGTH='4'/>
	</td>
	</tr>

	<tr>
	<td class='forumheader3' style='width:40%'>Cumulus Cloud Height</td>
	<td class='forumheader3' style='width:60%'>
	<input  class='tbox' type='text' name='tags_cumheight' value = '".$tags_cumheight."' SIZE='4' MAXLENGTH='4'/>
	</td>
	</tr>

	<tr>
	<td class='forumheader3' style='width:40%'>Tag Colour:</td>
	<td class='forumheader3' style='width:60%'>
	<input  class='tbox' type='text' name='tags_cumcolour' value = '".$tags_cumcolour."' SIZE='10' MAXLENGTH='6'/>
	</td>
	</tr>

	<tr>
	<td class='forumheader3' style='width:40%'>Background Colour:</td>
	<td class='forumheader3' style='width:60%'>
	<input  class='tbox' type='text' name='tags_cumbackcolour' value = '".$tags_cumbackcolour."' SIZE='10' MAXLENGTH='6'/>
	</td>
	</tr>

      	<tr>
	<td class='forumheader3' style='width:40%'>Set Background transparent</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='checkbox' name='tags_cumtransparent' ".$tags_cumtransparent." />
	</td>
	</tr>

      	<tr>
	<td class='forumheader3' style='width:40%'>Rotation Speed</td>
	<td class='forumheader3' style='width:60%'>
        <input  class='tbox' type='text' name='tags_cumspeed' value = '".$tags_cumspeed."' SIZE='3' MAXLENGTH='3'/>
	</td>
	</tr>";


$text .= "
	<tr>
	<td  class='forumheader' colspan='2' style='text-align:center'>
	<input class='button' type='submit' name='updatesettings' value='Save Settings' />
	</td>
	</tr>
          </table>
	  </form>
	  </div>";

   $ns->tablerender("Prefs", $text);


   require_once(e_ADMIN."footer.php");
?>

