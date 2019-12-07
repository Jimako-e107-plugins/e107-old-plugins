<?php


/*
#######################################
#     e107 website system plguin      #
#     AACGC Item List                 #    
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
 
    $pref['itemlist_catpagetitle'] = $_POST['itemlist_catpagetitle'];
    $pref['itemlist_catpageheader'] = $_POST['itemlist_catpageheader'];
    $pref['itemlist_catpageheaderfsize'] = $_POST['itemlist_catpageheaderfsize'];
    $pref['itemlist_catpageheaderfcolor'] = $_POST['itemlist_catpageheaderfcolor'];
    $pref['itemlist_catpageintro'] = $_POST['itemlist_catpageintro'];
    $pref['itemlist_catpageintrofsize'] = $_POST['itemlist_catpageintrofsize'];
    $pref['itemlist_catpageintrofcolor'] = $_POST['itemlist_catpageintrofcolor'];
    $pref['itemlist_catcols'] = $_POST['itemlist_catcols'];
    $pref['itemlist_catfsize'] = $_POST['itemlist_catfsize'];
    $pref['itemlist_catfcolor'] = $_POST['itemlist_catfcolor'];

    $pref['itemlist_subcatpagetitle'] = $_POST['itemlist_subcatpagetitle'];
    $pref['itemlist_subcatcols'] = $_POST['itemlist_subcatcols'];
    $pref['itemlist_subcatfsize'] = $_POST['itemlist_subcatfsize'];
    $pref['itemlist_subcatfcolor'] = $_POST['itemlist_subcatfcolor'];

    $pref['itemlist_pagetitle'] = $_POST['itemlist_pagetitle'];
    $pref['itemlist_itemcatfsize'] = $_POST['itemlist_itemcatfsize'];
    $pref['itemlist_itemcatfcolor'] = $_POST['itemlist_itemcatfcolor'];
    $pref['itemlist_itemnamefsize'] = $_POST['itemlist_itemnamefsize'];
    $pref['itemlist_itemnamefcolor'] = $_POST['itemlist_itemnamefcolor'];
    $pref['itemlist_itemdetailfsize'] = $_POST['itemlist_itemdetailfsize'];
    $pref['itemlist_itemdetailfcolor'] = $_POST['itemlist_itemdetailfcolor'];
    $pref['itemlist_itempricefsize'] = $_POST['itemlist_itempricefsize'];
    $pref['itemlist_itempricefcolor'] = $_POST['itemlist_itempricefcolor'];
    $pref['itemlist_itemimgsize'] = $_POST['itemlist_itemimgsize'];

    $pref['itemlist_recentmenuheight'] = $_POST['itemlist_recentmenuheight'];
    $pref['itemlist_recentmenucount'] = $_POST['itemlist_recentmenucount'];
    $pref['itemlist_recentmenuimgsize'] = $_POST['itemlist_recentmenuimgsize'];

    $pref['itemlist_randommenuimgsize'] = $_POST['itemlist_randommenuimgsize'];
    $pref['itemlist_randommenucat'] = $_POST['itemlist_randommenucat'];



if (isset($_POST['itemlist_enable_theme'])) 
{$pref['itemlist_enable_theme'] = 1;}
else
{$pref['itemlist_enable_theme'] = 0;}

if (isset($_POST['itemlist_enable_rating'])) 
{$pref['itemlist_enable_rating'] = 1;}
else
{$pref['itemlist_enable_rating'] = 0;}

if (isset($_POST['itemlist_enable_menupreview'])) 
{$pref['itemlist_enable_menupreview'] = 1;}
else
{$pref['itemlist_enable_menupreview'] = 0;}

if (isset($_POST['itemlist_enable_randmenupreview'])) 
{$pref['itemlist_enable_randmenupreview'] = 1;}
else
{$pref['itemlist_enable_randmenupreview'] = 0;}

    save_prefs();
    $led_msgtext = "Settings Saved";
}

$admin_title = "AACGC Item List (settings)";
//--------------------------------------------------------------------


$sql = new db;
$sql->db_Select("aacgc_itemlist_cat", "*", "ORDER BY item_cat_name ASC", "");
$rows = $sql->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql->db_Fetch();
$options .= "<option name='itemlist_randommenucat' value='".$option['item_cat_id']."'>".$option['item_cat_name']."</option>";}

$sql2 = new db;
$sql2->db_Select("aacgc_itemlist_cat", "*", "WHERE item_cat_id='".$pref['itemlist_randommenucat']."'", "");
$row2 = $sql2->db_Fetch();



$text .= "
<form method='post' action='" . e_SELF . "?update' id='confnwb'>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>

		<tr>
			<td colspan='3' class='fcaption'><b>Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Use Indent and Forumheader3 for Tables:</td>
		        <td colspan=2 class='forumheader3'>".($pref['itemlist_enable_theme'] == 1 ? "<input type='checkbox' name='itemlist_enable_theme' value='1' checked='checked' />" : "<input type='checkbox' name='itemlist_enable_theme' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Allow Rating:</td>
		        <td colspan=2 class='forumheader3'>".($pref['itemlist_enable_rating'] == 1 ? "<input type='checkbox' name='itemlist_enable_rating' value='1' checked='checked' />" : "<input type='checkbox' name='itemlist_enable_rating' value='0' />")."</td>
	        </tr>




		<tr>
			<td colspan='3' class='fcaption'><b>Category Page Settings:</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Item Category Page Title:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='100' name='itemlist_catpagetitle' value='" . $tp->toFORM($pref['itemlist_catpagetitle'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Item Category Page Header:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='100' name='itemlist_catpageheader' value='" . $tp->toFORM($pref['itemlist_catpageheader'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Item Category Page Header Font Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='itemlist_catpageheaderfsize' value='" . $tp->toFORM($pref['itemlist_catpageheaderfsize'])."' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Item Category Page Header Font Color:</td>
			<td colspan='2'  class='forumheader3'>#<input class='tbox' type='text' size='10' name='itemlist_catpageheaderfcolor' value='" . $tp->toFORM($pref['itemlist_catpageheaderfcolor'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Item Category Page Intro:</td>
			<td colspan='2'  class='forumheader3'>
                        <textarea class='tbox' rows='5' cols='100' name='itemlist_catpageintro'>" . $tp->toFORM($pref['itemlist_catpageintro']) . "</textarea>
                        </td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Item Category Page Intro Font Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='itemlist_catpageintrofsize' value='" . $tp->toFORM($pref['itemlist_catpageintrofsize'])."' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Item Category Page Intro Font Color:</td>
			<td colspan='2'  class='forumheader3'>#<input class='tbox' type='text' size='10' name='itemlist_catpageintrofcolor' value='" . $tp->toFORM($pref['itemlist_catpageintrofcolor'])."' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Item Category Font Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='itemlist_catfsize' value='" . $tp->toFORM($pref['itemlist_catfsize'])."' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Item Category Font Color:</td>
			<td colspan='2'  class='forumheader3'>#<input class='tbox' type='text' size='10' name='itemlist_catfcolor' value='" . $tp->toFORM($pref['itemlist_catfcolor'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Categories Per Row:</td>
                        <td style='width:70%' class='forumheader3'>
                        <input class='tbox' type='radio'  name='itemlist_catcols' value='1' ".($pref['itemlist_catcols']=='1'?"checked='checked'":'')." /> 1
                        <input class='tbox' type='radio'  name='itemlist_catcols' value='2' ".($pref['itemlist_catcols']=='2'?"checked='checked'":'')." /> 2
                        <input class='tbox' type='radio'  name='itemlist_catcols' value='3' ".($pref['itemlist_catcols']=='3'?"checked='checked'":'')." /> 3
                        <input class='tbox' type='radio'  name='itemlist_catcols' value='4' ".($pref['itemlist_catcols']=='4'?"checked='checked'":'')." /> 4
                        <input class='tbox' type='radio'  name='itemlist_catcols' value='5' ".($pref['itemlist_catcols']=='5'?"checked='checked'":'')." /> 5
                        </td>
		</tr>





		<tr>
			<td colspan='3' class='fcaption'><b>Sub-Category Page Settings:</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Item Sub-Category Page Title:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='100' name='itemlist_subcatpagetitle' value='" . $tp->toFORM($pref['itemlist_subcatpagetitle'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Item Sub-Category Font Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='itemlist_subcatfsize' value='" . $tp->toFORM($pref['itemlist_subcatfsize'])."' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Item Sub-Category Font Color:</td>
			<td colspan='2'  class='forumheader3'>#<input class='tbox' type='text' size='10' name='itemlist_subcatfcolor' value='" . $tp->toFORM($pref['itemlist_subcatfcolor'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Sub-Categories Per Row:</td>
                        <td style='width:70%' class='forumheader3'>
                        <input class='tbox' type='radio'  name='itemlist_subcatcols' value='1' ".($pref['itemlist_subcatcols']=='1'?"checked='checked'":'')." /> 1
                        <input class='tbox' type='radio'  name='itemlist_subcatcols' value='2' ".($pref['itemlist_subcatcols']=='2'?"checked='checked'":'')." /> 2
                        <input class='tbox' type='radio'  name='itemlist_subcatcols' value='3' ".($pref['itemlist_subcatcols']=='3'?"checked='checked'":'')." /> 3
                        <input class='tbox' type='radio'  name='itemlist_subcatcols' value='4' ".($pref['itemlist_subcatcols']=='4'?"checked='checked'":'')." /> 4
                        <input class='tbox' type='radio'  name='itemlist_subcatcols' value='5' ".($pref['itemlist_subcatcols']=='5'?"checked='checked'":'')." /> 5
                        </td>
		</tr>








		<tr>
			<td colspan='3' class='fcaption'><b>Item Page Settings:</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Item Page Title:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='100' name='itemlist_pagetitle' value='" . $tp->toFORM($pref['itemlist_pagetitle'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Item Category Font Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='itemlist_itemcatfsize' value='" . $tp->toFORM($pref['itemlist_itemcatfsize'])."' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Item Category Font Color:</td>
			<td colspan='2'  class='forumheader3'>#<input class='tbox' type='text' size='10' name='itemlist_itemcatfcolor' value='" . $tp->toFORM($pref['itemlist_itemcatfcolor'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Item Name Font Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='itemlist_itemnamefsize' value='" . $tp->toFORM($pref['itemlist_itemnamefsize'])."' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Item Name Font Color:</td>
			<td colspan='2'  class='forumheader3'>#<input class='tbox' type='text' size='10' name='itemlist_itemnamefcolor' value='" . $tp->toFORM($pref['itemlist_itemnamefcolor'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Item Image Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='itemlist_itemimgsize' value='" . $tp->toFORM($pref['itemlist_itemimgsize'])."' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Item Detail Font Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='itemlist_itemdetailfsize' value='" . $tp->toFORM($pref['itemlist_itemdetailfsize'])."' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Item Detail Font Color:</td>
			<td colspan='2'  class='forumheader3'>#<input class='tbox' type='text' size='10' name='itemlist_itemdetailfcolor' value='" . $tp->toFORM($pref['itemlist_itemdetailfcolor'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Item Price Font Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='itemlist_itempricefsize' value='" . $tp->toFORM($pref['itemlist_itempricefsize'])."' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Item Price Font Color:</td>
			<td colspan='2'  class='forumheader3'>#<input class='tbox' type='text' size='10' name='itemlist_itempricefcolor' value='" . $tp->toFORM($pref['itemlist_itempricefcolor'])."' /></td>
		</tr>






		<tr>
			<td colspan='3' class='fcaption'><b>Recent Item Menu Settings:</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Number of Items to Show:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='itemlist_recentmenucount' value='" . $tp->toFORM($pref['itemlist_recentmenucount'])."' /></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Image Preview:</td>
		        <td colspan=2 class='forumheader3'>".($pref['itemlist_enable_menupreview'] == 1 ? "<input type='checkbox' name='itemlist_enable_menupreview' value='1' checked='checked' />" : "<input type='checkbox' name='itemlist_enable_menupreview' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Item Image Preview Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='itemlist_recentmenuimgsize' value='" . $tp->toFORM($pref['itemlist_recentmenuimgsize'])."' />px (only if show image preview is checked)</td>
		</tr>





		<tr>
			<td colspan='3' class='fcaption'><b>Random Item Menu Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Image Preview:</td>
		        <td colspan=2 class='forumheader3'>".($pref['itemlist_enable_randmenupreview'] == 1 ? "<input type='checkbox' name='itemlist_enable_randmenupreview' value='1' checked='checked' />" : "<input type='checkbox' name='itemlist_enable_randmenupreview' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Item Image Preview Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='itemlist_randommenuimgsize' value='" . $tp->toFORM($pref['itemlist_randommenuimgsize'])."' />px (only if show image preview is checked)</td>
		</tr>
                <tr>
                        <td style='width:25%' class='forumheader3'>Only Show Items in Category:</td>
                        <td style='width:' class='forumheader3'>
		        <select name='itemlist_randommenucat' size='1' class='tbox' style='width:50%'>
                        <option name='itemlist_randommenucat' value='".$pref['itemlist_randommenucat']."'>".$row2['item_cat_name']."</option>
		        ".$options."
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
