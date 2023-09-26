<?php

//-----------------------------------------------------------------------------------------------------------+
/*
#######################################
#     AACGC Arcade Addins V1.0        #
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
 
   $pref['el_pagetitle'] = $_POST['el_pagetitle'];
   $pref['el_eventtitlefsize'] = $_POST['el_eventtitlefsize'];
   $pref['el_eventdetfsize'] = $_POST['el_eventdetfsize'];
   $pref['el_autoaddclass'] = $_POST['el_autoaddclass'];
   $pref['elmenu_title'] = $_POST['elmenu_title'];
   $pref['elmenu_height'] = $_POST['elmenu_height'];
   $pref['elmenu_speed'] = $_POST['elmenu_speed'];
   $pref['elmenu_mouseoverspeed'] = $_POST['elmenu_mouseoverspeed'];
   $pref['elmenu_mouseoutspeed'] = $_POST['elmenu_mouseoutspeed'];
   $pref['elmenu_eventfsize'] = $_POST['elmenu_eventfsize'];
   $pref['el_event_order'] = $_POST['el_event_order'];
   $pref['el_addclass'] = $_POST['el_addclass'];



if (isset($_POST['el_autoaddadmins'])) 
{$pref['el_autoaddadmins'] = 1;}
else
{$pref['el_autoaddadmins'] = 0;}


if (isset($_POST['el_enable_scroll'])) 
{$pref['el_enable_scroll'] = 1;}
else
{$pref['el_enable_scroll'] = 0;}



    save_prefs();
    $led_msgtext = "Settings Saved";
}

$admin_title = "AACGC Event Listing(Settings)";
//--------------------------------------------------------------------




$text .= "
<form method='post' action='" . e_SELF . "?update' id='arcadeaddins'>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>


		<tr>
			<td colspan='3' class='fcaption'>Events Page Settings:</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Event Page Title:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='50' name='el_pagetitle' value='" . $tp->toFORM($pref['el_pagetitle']) . "' /></td>
		</tr>




		<tr>
			<td colspan='3' class='fcaption'>Events Detail Page Settings:</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Event Name Font Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='el_eventtitlefsize' value='" . $tp->toFORM($pref['el_eventtitlefsize']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Event Information Font Size:</td>
			<td colspan='2'  class='forumheader3'> <input class='tbox' type='text' size='10' name='el_eventdetfsize' value='" . $tp->toFORM($pref['el_eventdetfsize']) . "' /></td>
		</tr>





		<tr>
			<td colspan='3' class='fcaption'>Events Menu Settings:</td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Scrolling:</td>
		        <td colspan=2 class='forumheader3'>".($pref['el_enable_scroll'] == 1 ? "<input type='checkbox' name='el_enable_scroll' value='1' checked='checked' />" : "<input type='checkbox' name='el_enable_scroll' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Scrolling Height:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='elmenu_height' value='" . $tp->toFORM($pref['elmenu_height']) . "' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Event Menu Title:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='50' name='elmenu_title' value='" . $tp->toFORM($pref['elmenu_title']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Event Name Font Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='elmenu_eventfsize' value='" . $tp->toFORM($pref['elmenu_eventfsize']) . "' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Order Events By:</td>
                        <td style='width:' class=''>
                        <select name='el_event_order' size='1' class='tbox' style='width:50%'>
                        <option name='el_event_order' value='".$pref['el_event_order']."'>".$pref['el_event_order']."</option>
                        <option name='el_event_order' value='event_id'>ID</option>
                        <option name='el_event_order' value='event_name'>Name</option>
                        <option name='el_event_order' value='event_date'>Date</option>
                        </td>
		<tr>
			<td style='width:30%' class='forumheader3'>Scroll Speed On Start:</td>
			<td colspan='2'  class='forumheader3'> <input class='tbox' type='text' size='10' name='elmenu_speed' value='" . $tp->toFORM($pref['elmenu_speed']). "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Scroll Speed On Mouse-over:</td>
			<td colspan='2'  class='forumheader3'> <input class='tbox' type='text' size='10' name='elmenu_mouseoverspeed' value='" . $tp->toFORM($pref['elmenu_mouseoverspeed']). "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Scroll Speed On Mouse-out:</td>
			<td colspan='2'  class='forumheader3'> <input class='tbox' type='text' size='10' name='elmenu_mouseoutspeed' value='" . $tp->toFORM($pref['elmenu_mouseoutspeed']). "' /></td>
		</tr>


		<tr>
			<td colspan='3' class='fcaption'>Event Join Settings:</td>
		</tr>

";

	$sql->db_Select("userclass_classes", "*", "WHERE userclass_id=".$pref['el_autoaddclass']."","");
        $row2 = $sql->db_Fetch();
        $classnow = "".$row2['userclass_name']."";

$text .= "<tr>
          <td style='width:30%' class='forumheader3'>Auto Allow Userclass:</td>
          <td style='width:70%' class='forumheader3'>";
$text .= "<select name='el_autoaddclass' size='1' class='tbox' style='width:50%'>
          <option name='el_addclass' value='".$pref['el_autoaddclass']."'>".$classnow."</option>";

	  $sql->db_Select("userclass_classes", "*", "ORDER BY userclass_id ASC","");
        while($row = $sql->db_Fetch()){
        $text .= "<option name='el_autoaddclass' value='".$row['userclass_id']."'>".$row['userclass_name']."</option>";}
  

      

$text .= "<tr>
	<td style='width:30%' class='forumheader3'>Auto Allow Admins:</td>
	<td colspan=2 class='forumheader3'>".($pref['el_autoaddadmins'] == 1 ? "<input type='checkbox' name='el_autoaddadmins' value='1' checked='checked' />" : "<input type='checkbox' name='el_autoaddadmins' value='0' />")."</td>
	</tr>";


        $sql3 = new db;
	$sql3->db_Select("userclass_classes", "*", "WHERE userclass_id=".$pref['el_addclass']."","");
        $row3 = $sql3->db_Fetch();
        $classadd = "".$row3['userclass_name']."";

$text .= "<tr>
          <td style='width:30%' class='forumheader3'>Userclass Allowed to add Events:</td>
          <td style='width:70%' class='forumheader3'>";

$text .= "<select name='el_addclass' size='1' class='tbox' style='width:50%'>
          <option name='el_addclass' value='".$pref['el_addclass']."'>".$classadd."</option>";
          $sql4 = new db;
	  $sql4->db_Select("userclass_classes", "*", "ORDER BY userclass_id ASC","");
          while($row4 = $sql4->db_Fetch()){

$text .= "<option name='el_addclass' value='".$row4['userclass_id']."'>".$row4['userclass_name']."</option>";}



/*

$text .= "<tr>
<td colspan='3' class='fcaption'>Gold System Support:</td>
</tr><tr>
<td style='width:30%' class='forumheader3'>Enable Gold Orbs:</td>
<td colspan=2 class='forumheader3'>".($pref['arcadeaddin_enable_gold'] == 1 ? "<input type='checkbox' name='arcadeaddin_enable_gold' value='1' checked='checked' />" : "<input type='checkbox' name='arcadeaddin_enable_gold' value='0' />")."(All Menus)</td>
</tr>";
*/





$text .= "      <tr>
			<td colspan='3' class='fcaption' style='text-align: left;'><input type='submit' name='update' value='Update Settings' class='button' /></td>
		</tr>



</table>
</form>";





$ns->tablerender($admin_title, $text);
require_once(e_ADMIN . "footer.php");
?>

