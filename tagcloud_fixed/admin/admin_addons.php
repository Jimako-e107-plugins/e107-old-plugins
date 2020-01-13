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

if (isset($_POST['updateonoff'])) {
        if($sql->select("tag_config","*"))
          { $cnt = 0;
            $cnt++;
            while ($config = $sql->fetch())
                 {
                  $tagid = $config['Tag_Config_ID'];
                  if($_POST['tags_cloud'.$tagid]){$flag1=1;}else{$flag1=0;}
                  if($_POST['tags_onoff'.$tagid]){$flag2=1;}else{$flag2=0;}
                  $sql2->db_update("tag_config","Tag_Config_CloudFlag =".$flag1.",Tag_Config_OnOffFlag =".$flag2." WHERE Tag_Config_ID =".$tagid);
                 }
           }
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

 
//---------------------------------------------------------------------
//  ON OFF
 

if($sql->select("tag_config","*"))
          { $cnt = 0;
            $cnt++;
$text = "<div style='text-align:center'>
	<form method='post' action='".e_SELF."' id='cfgform'>
	<table style='".ADMIN_WIDTH."' class='fborder'>
	<tr>
	  <td></td>
	  <td class='forumheader3'>Include in Cloud</td>
	  <td class='forumheader3'>Global on/off (will also switch off in cloud)</td>
	</tr>
";
            while ($config = $sql->fetch())
                 {
                 //build up existing form rows
                 if ($config['Tag_Config_CloudFlag'] == 1)  {$check1 = 'checked';} else {$check1='';}
                 if ($config['Tag_Config_OnOffFlag'] == 1)  {$check2 = 'checked';} else {$check2='';}
                 $text .= "
                       	<tr>
	                <td class='forumheader3' style='width:40%'>".$config['Tag_Config_Type']."</td>
	                <td class='forumheader3' style='width:30%'>
	                <input class='tbox' type='checkbox' name='tags_cloud".$config['Tag_Config_ID']."' ".$check1." />
	                </td>
	                <td class='forumheader3' style='width:30%'>
	                <input class='tbox' type='checkbox' name='tags_onoff".$config['Tag_Config_ID']."' ".$check2." />
	                </td>
	                </tr>
                        ";
            }
$text .= "
	<tr>
	<td  class='forumheader' colspan='3' style='text-align:center'>
	<input class='button' type='submit' name='updateonoff' value='Save Settings' />
	</td>
	</tr>
          </table>
	  </form>
	  </div>";
   $ns->tablerender("Tag Content areas On/Off control", $text);

}

   require_once(e_ADMIN."footer.php");
?>

