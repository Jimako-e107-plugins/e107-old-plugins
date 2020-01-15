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
 
if (isset($_POST['updatesettings'])) {

	$plugPrefs['tags_number']        = ($_POST['tags_number']        ? $_POST['tags_number']        : 20 );
	$plugPrefs['tags_preview']       = ($_POST['tags_preview']       ? $_POST['tags_preview']       : 200 );
	$plugPrefs['tags_errortag']      = ($_POST['tags_errortag']      ? $_POST['tags_errortag']      : 500 );
 
        $plugPrefs['tags_adminmod']      = ($_POST['tags_adminmod']      ? $_POST['tags_adminmod']      : 0);
        $plugPrefs['tags_usermod']       = ($_POST['tags_usermod']       ? $_POST['tags_usermod']       : 0);
 
 
 
        $plugPrefs['tags_autogen']       = ($_POST['tags_autogen']       ? $_POST['tags_autogen']       : 0);
        $plugPrefs['tags_menuname']      = ($_POST['tags_menuname']      ? $_POST['tags_menuname']      : '');

        //echo "ORDER".$_POST['order'];
        if     ($_POST['order'] =='alpha'){$plugPrefs['tags_order']   = 'alpha';}
        elseif ($_POST['order'] =='date') {$plugPrefs['tags_order']   = 'date';}
        else   {$plugPrefs['tags_order']   = 'random';}
        //echo "<p>pref:".$plugPrefs['tags_order'];
	//savex_prefs();
	e107::getPlugConfig('tagcloud')->setPref($plugPrefs) -> save(false, true); 
	$e107cache->clear("tagcloud");
	$message = 'Settings Saved!';
}


   // Display
   if (isset($message)) {
	$ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}

$tags_number   = $plugPrefs['tags_number'];
$tags_preview  = $plugPrefs['tags_preview'];
$tags_menuname = $plugPrefs['tags_menuname'];
$tags_adminmod = $plugPrefs['tags_adminmod'];
$tags_usermod  = $plugPrefs['tags_usermod'];
$tags_errortag = $plugPrefs['tags_errortag'];

 
if ($plugPrefs['tags_autogen'])            {$tags_autogen        ='checked';}
if ($plugPrefs['tags_order']=='random')     {$tags_orderrandom    ='checked';}
if ($plugPrefs['tags_order']=='alpha')      {$tags_orderalpha     ='checked';}
if ($plugPrefs['tags_order']=='date')       {$tags_orderdate      ='checked';}



$text = "<div style='text-align:center'>
	<form method='post' action='".e_SELF."' id='cfgform'>
	<table style='".ADMIN_WIDTH."' class='fborder'>

	<tr>
	<td class='forumheader3' style='width:40%'>Default no. Tags shown in cloud:</td>
	<td class='forumheader3' style='width:60%'>
	<input  class='tbox' type='text' name='tags_number' value = '".$tags_number."' SIZE='2' MAXLENGTH='2'/>
	</td>
	</tr>

	<tr>
	<td class='forumheader3' style='width:40%'>Tag cloud menu title:</td>
	<td class='forumheader3' style='width:60%'>
	<input  class='tbox' type='text' name='tags_menuname' value = '".$tags_menuname."' SIZE='40' MAXLENGTH='40'/>
	</td>
	</tr>

	<tr>
	<td class='forumheader3' style='width:40%'>Length of item preview:</td>
	<td class='forumheader3' style='width:60%'>
	<input  class='tbox' type='text' name='tags_preview' value = '".$tags_preview."' SIZE='4' MAXLENGTH='4'/>
	</td>
	</tr>

     	<tr>
	<td class='forumheader3' style='width:40%'>Allow Site wide Tag edits:</td>
	<td class='forumheader3' style='width:60%'>
      	".r_userclass('tags_adminmod', $tags_adminmod, 'off', 'main,admin,nobody')."
	</td>
	</tr>

     	<tr>
	<td class='forumheader3' style='width:40%'>Allow users to mod their own tags where appropriate:</td>
	<td class='forumheader3' style='width:60%'>
      	".r_userclass('tags_usermod', $tags_usermod, 'off', 'member,classes,nobody')."
	</td>
	</tr>
 	 
      	<tr>
	<td class='forumheader3' style='width:40%'>Auto generate tags when none are found for content being displayed (news only atm)</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='checkbox' name='tags_autogen' ".$tags_autogen." />
	</td>
	</tr>

      	<tr>
	<td class='forumheader3' style='width:40%'>Number of tags to show on the tagcloud page.  This is shown if no tags are found!</td>
	<td class='forumheader3' style='width:60%'>
        <input  class='tbox' type='text' name='tags_errortag' value = '".$tags_errortag."' SIZE='4' MAXLENGTH='4'/>
	</td>
	</tr>

     	<tr>
	<td class='forumheader3' style='width:40%'>Order of tags</td>
	<td class='forumheader3' style='width:60%'>
	Random: <input type='radio' name='order' value='random' $tags_orderrandom>
	Alphabetical: <input type='radio' name='order' value='alpha' $tags_orderalpha>
        Date: <input type='radio' name='order' value='date' $tags_orderdate>
	</td>
	</tr>
 
        ";


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

