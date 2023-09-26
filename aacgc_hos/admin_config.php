<?php

//-----------------------------------------------------------------------------------------------------------+
/*
#######################################
#     AACGC HOS                       #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#######################################
*/
//-----------------------------------------------------------------------------------------------------------+


require_once("../../class2.php");
if (!defined('e107_INIT'))
{exit;}
if (!getperms("P"))
{header("location:" . e_HTTP . "index.php");
exit;}
require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{define(ADMIN_WIDTH, "width:100%;");}

if (e_QUERY == "update")
{
 
   $pref['hos_pagetitle'] = $_POST['hos_pagetitle'];
   $pref['hos_logosfcolor'] = $_POST['hos_logosfcolor'];
   $pref['hos_logofcolor'] = $_POST['hos_logofcolor'];
   $pref['hos_addclass'] = $_POST['hos_addclass'];
   $pref['hos_menutitle'] = $_POST['hos_menutitle'];
   $pref['hos_imgsize'] = $_POST['hos_imgsize'];
   $pref['hos_details'] = $_POST['hos_details'];
   $pref['hos_menuimgsize'] = $_POST['hos_menuimgsize'];
   $pref['hos_detfsize'] = $_POST['hos_detfsize'];
    $pref['hosmenu_height'] = $_POST['hosmenu_height'];
    $pref['hosmenu_speed'] = $_POST['hosmenu_speed'];
    $pref['hosmenu_mouseoverspeed'] = $_POST['hosmenu_mouseoverspeed'];
    $pref['hosmenu_mouseoutspeed'] = $_POST['hosmenu_mouseoutspeed'];


if (isset($_POST['hos_enable_image'])) 
{$pref['hos_enable_image'] = 1;}
else
{$pref['hos_enable_image'] = 0;}

if (isset($_POST['hos_enable_extlink'])) 
{$pref['hos_enable_extlink'] = 1;}
else
{$pref['hos_enable_extlink'] = 0;}

if (isset($_POST['hos_enable_imagesec'])) 
{$pref['hos_enable_imagesec'] = 1;}
else
{$pref['hos_enable_imagesec'] = 0;}

if (isset($_POST['hos_enable_last'])) 
{$pref['hos_enable_last'] = 1;}
else
{$pref['hos_enable_last'] = 0;}

    save_prefs();
    $led_msgtext = "Settings Saved";
}

$admin_title = "AACGC Hall of Shame (Settings)";
//--------------------------------------------------------------------




$text .= "
<form method='post' action='" . e_SELF . "?update' id='hos'>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>


		<tr>
			<td colspan='3' class='fcaption'>HOS Page Settings:</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>HOS Page Title:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='50' name='hos_pagetitle' value='" . $tp->toFORM($pref['hos_pagetitle']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>HOS Logo Color:</td>
			<td colspan='2'  class='forumheader3'>#<input class='tbox' type='text' size='15' name='hos_logofcolor' value='" . $tp->toFORM($pref['hos_logofcolor']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>HOS Logo Shadow Color:</td>
			<td colspan='2'  class='forumheader3'>#<input class='tbox' type='text' size='15' name='hos_logosfcolor' value='" . $tp->toFORM($pref['hos_logosfcolor']) . "' /> (ONLY WORKS IN IE)</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>HOS Page Info:</td>
			<td colspan='2'  class='forumheader3'>
                        <textarea class='tbox' rows='5' cols='75' name='hos_details'>" . $tp->toFORM($pref['hos_details']) . "</textarea>
                        </td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>HOS Info Font Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='hos_detfsize' value='" . $tp->toFORM($pref['hos_detfsize']) . "' />px</td>
		</tr>




		<tr>
			<td colspan='3' class='fcaption'>HOS Detail Page Settings:</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Enable External Link:</td>
		        <td colspan=2 class='forumheader3'>".($pref['hos_enable_extlink'] == 1 ? "<input type='checkbox' name='hos_enable_extlink' value='1' checked='checked' />" : "<input type='checkbox' name='hos_enable_extlink' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Enable Image Section:</td>
		        <td colspan=2 class='forumheader3'>".($pref['hos_enable_imagesec'] == 1 ? "<input type='checkbox' name='hos_enable_imagesec' value='1' checked='checked' />" : "<input type='checkbox' name='hos_enable_imagesec' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Show Images instead of Image Link:</td>
		        <td colspan=2 class='forumheader3'>".($pref['hos_enable_image'] == 1 ? "<input type='checkbox' name='hos_enable_image' value='1' checked='checked' />" : "<input type='checkbox' name='hos_enable_image' value='0' />")." (if enabled above)</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Image Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='hos_imgsize' value='" . $tp->toFORM($pref['hos_imgsize']) . "' />px (if enabled above)</td>
		</tr>





		<tr>
			<td colspan='3' class='fcaption'>HOS Menu Settings:</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>HOS Menu Title:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='50' name='hos_menutitle' value='" . $tp->toFORM($pref['hos_menutitle']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Menu Image Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='hos_menuimgsize' value='" . $tp->toFORM($pref['hos_menuimgsize']) . "' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Enable Scrolling List:</td>
		        <td colspan=2 class='forumheader3'>".($pref['hos_enable_last'] == 1 ? "<input type='checkbox' name='hos_enable_last' value='1' checked='checked' />" : "<input type='checkbox' name='hos_enable_last' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>HOS Scrolling List Height:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='hosmenu_height' value='" . $tp->toFORM($pref['hosmenu_height']) . "' />px  (pixles)</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Scroll Speed On Start:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='hosmenu_speed' value='" . $tp->toFORM($pref['hosmenu_speed']) . "' />  (1 for slow, 10 for fast)</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Scroll Speed On Mouseover:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='hosmenu_mouseoverspeed' value='" . $tp->toFORM($pref['hosmenu_mouseoverspeed']) . "' />  (1 for slow, 10 for fast, 0 for it to stop)</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Scroll Speed On Mouseout:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='hosmenu_mouseoutspeed' value='" . $tp->toFORM($pref['hosmenu_mouseoutspeed']) . "' />  (1 for slow, 10 for fast)</td>
		</tr>







";




$text .= "      <tr>
			<td colspan='3' class='fcaption'>Other Settings:</td>
		</tr>";

	$sql->db_Select("userclass_classes", "*", "WHERE userclass_id=".$pref['hos_addclass']."","");
        $row2 = $sql->db_Fetch();
        $classnow = "".$row2['userclass_name']."";

$text .= "<tr>
          <td style='width:30%' class='forumheader3'>Userclass allowed to add to HOS: (".$classnow."):</td>
          <td style='width:70%' class='forumheader3'>";
$text .= "<select name='hos_addclass' size='1' class='tbox' style='width:50%'>";
	  $sql->db_Select("userclass_classes", "*", "ORDER BY userclass_id ASC","");
        while($row = $sql->db_Fetch()){
        $text .= "<option name='hos_addclass' value='".$row['userclass_id']."'>".$row['userclass_name']."</option>";}
  

      

$text .= "      <tr>
			<td colspan='3' class='fcaption' style='text-align: left;'><input type='submit' name='update' value='Update Settings' class='button' /></td>
		</tr>



</table>
</form>";





$ns->tablerender($admin_title, $text);
require_once(e_ADMIN . "footer.php");
?>

