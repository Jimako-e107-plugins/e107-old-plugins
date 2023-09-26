<?php


/*
#######################################
#     e107 website system plguin      #
#     AACGC Bracket Tracker           #    
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/



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
 
    $pref['aacgc_bt_pagetitle'] = $_POST['aacgc_bt_pagetitle'];
    $pref['aacgc_bt_header'] = $_POST['aacgc_bt_header'];
    $pref['aacgc_bt_headerfs'] = $_POST['aacgc_bt_headerfs'];
    $pref['aacgc_bt_intro'] = $_POST['aacgc_bt_intro'];
    $pref['aacgc_bt_introfs'] = $_POST['aacgc_bt_introfs'];
    $pref['aacgc_bt_catfs'] = $_POST['aacgc_bt_catfs'];
    $pref['aacgc_bt_barcolor'] = $_POST['aacgc_bt_barcolor'];


    save_prefs();
    $led_msgtext = "Settings Saved";

}

$admin_title = "AACGC Bracket Tracker (settings)";
//--------------------------------------------------------------------


$text .= "
<form method='post' action='" . e_SELF . "?update' id='confnwb'>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>


		<tr>
			<td colspan='3' class='fcaption'><b>Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Page Title:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='50' name='aacgc_bt_pagetitle' value='" . $tp->toFORM($pref['aacgc_bt_pagetitle']) . "' /></td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Header:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='50' name='aacgc_bt_header' value='" . $tp->toFORM($pref['aacgc_bt_header']) . "' /></td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Header Font Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='aacgc_bt_headerfs' value='" . $tp->toFORM($pref['aacgc_bt_headerfs']) . "' /></td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Intro:</td>
			<td colspan='2'  class='forumheader3'>
                        <textarea class='tbox' rows='5' cols='100' name='aacgc_bt_intro'>" . $tp->toFORM($pref['aacgc_bt_intro']) . "</textarea>
                        </td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Intro Font Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='aacgc_bt_introfs' value='" . $tp->toFORM($pref['aacgc_bt_introfs']) . "' /></td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Category Font Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='aacgc_bt_catfs' value='" . $tp->toFORM($pref['aacgc_bt_catfs']) . "' /></td>
	        </tr>

		<tr>
			<td style='width:30%' class='forumheader3'>Bracket Bar Color:</td>
                        <td style='width:' class=''>
                        <select name='aacgc_bt_barcolor' size='1' class='tbox' style='width:50%'>
                        <option name='aacgc_bt_barcolor' value='".$pref['aacgc_bt_barcolor']."'>".$pref['aacgc_bt_barcolor']."</option>
                        <option name='aacgc_bt_barcolor' value='black'>black</option>
                        <option name='aacgc_bt_barcolor' value='gray'>gray</option>
                        <option name='aacgc_bt_barcolor' value='white'>white</option>
                        </td>
		</tr>






                <tr>
			<td colspan='3' class='fcaption' style='text-align: left;'><input type='submit' name='update' value='Save Settings' class='button' /></td>
		</tr>





</table>
</form>";



$ns->tablerender($admin_title, $text);
require_once(e_ADMIN . "footer.php");
?>
