<?php
/*
+---------------------------------------------------------------+
|        Reviewer Plugin for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}
if (!getperms("P"))
{
    header("location:" . e_BASE . "index.php");
    exit;
}

require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, "width:100%;");
}
include_lan(e_PLUGIN . "reviewer/languages/" . e_LANGUAGE . ".php");
e107_require_once(e_PLUGIN . "reviewer/includes/reviewer_class.php");
if (!is_object($reviewer_obj))
{
    $reviewer_obj = new reviewer;
}
$reviewer_action = $_POST['reviewer_action'];
$reviewer_edit = false;
// * If we are updating then update or insert the record
if ($reviewer_action == 'update')
{
    $reviewer_id = $_POST['reviewer_menu_id'];
    if ($reviewer_id == 0)
    {
        // New record so add it
        if ($sql->db_Select("reviewer_category", "reviewer_category_id", "where reviewer_category_name='" . $tp->toDB($_POST['reviewer_category_name']) . "' ", "nowhere", false))
        {
            $reviewer_msg .= REVIEWER_AC025 ;
        }
        else
        {
            $reviewer_args = "
		'0',
		'" . $tp->toDB($_POST['reviewer_category_name']) . "',
		'" . $tp->toDB($_POST['reviewer_category_description']) . "'," . time() . ",
		'" . $tp->toDB($_POST['reviewer_category_icon']) . "',
		'" . intval($_POST['reviewer_category_use1']) . "',
		'" . intval($_POST['reviewer_category_use2']) . "',
		'" . intval($_POST['reviewer_category_use3']) . "',
		'" . intval($_POST['reviewer_category_use4']) . "',
		'" . intval($_POST['reviewer_category_use5']) . "',
		'" . intval($_POST['reviewer_category_use6']) . "',
		'" . intval($_POST['reviewer_category_use7']) . "',
		'" . intval($_POST['reviewer_category_use8']) . "',
		'" . intval($_POST['reviewer_category_use9']) . "',
		'" . intval($_POST['reviewer_category_use10']) . "',
		'" . (empty($_POST['reviewer_category_rate1'])?"{REVIEWER_RATE1}":$tp->toDB($_POST['reviewer_category_rate1'])) . "',
		'" . (empty($_POST['reviewer_category_rate2'])?"{REVIEWER_RATE2}":$tp->toDB($_POST['reviewer_category_rate2'])) . "',
		'" . (empty($_POST['reviewer_category_rate3'])?"{REVIEWER_RATE3}":$tp->toDB($_POST['reviewer_category_rate3'])) . "',
		'" . (empty($_POST['reviewer_category_rate4'])?"{REVIEWER_RATE4}":$tp->toDB($_POST['reviewer_category_rate4'])) . "',
		'" . (empty($_POST['reviewer_category_rate5'])?"{REVIEWER_RATE5}":$tp->toDB($_POST['reviewer_category_rate5'])) . "',
		'" . (empty($_POST['reviewer_category_rate6'])?"{REVIEWER_RATE6}":$tp->toDB($_POST['reviewer_category_rate6'])) . "',
		'" . (empty($_POST['reviewer_category_rate7'])?"{REVIEWER_RATE7}":$tp->toDB($_POST['reviewer_category_rate7'])) . "',
		'" . (empty($_POST['reviewer_category_rate8'])?"{REVIEWER_RATE8}":$tp->toDB($_POST['reviewer_category_rate8'])) . "',
		'" . (empty($_POST['reviewer_category_rate9'])?"{REVIEWER_RATE9}":$tp->toDB($_POST['reviewer_category_rate9'])) . "',
		'" . (empty($_POST['reviewer_category_rate10'])?"{REVIEWER_RATE10}":$tp->toDB($_POST['reviewer_category_rate10'])) . "',
		'" . $tp->toDB($_POST['reviewer_category_linkicon']) . "'";
            if ($sql->db_Insert("reviewer_category", $reviewer_args,false))
            {
                $reviewer_msg .= REVIEWER_AC015 ;
            }
            else
            {
                $reviewer_msg .= REVIEWER_AC016 ;
            }
        }
    }
    else
    {
        // Update existing
        $reviewer_args = "
		reviewer_category_name='" . $tp->toDB($_POST['reviewer_category_name']) . "',
		reviewer_category_description='" . $tp->toDB($_POST['reviewer_category_description']) . "',
		reviewer_category_icon='" . $tp->toDB($_POST['reviewer_category_icon']) . "',
		reviewer_category_use1='" . intval($_POST['reviewer_category_use1']) . "',
		reviewer_category_use2='" . intval($_POST['reviewer_category_use2']) . "',
		reviewer_category_use3='" . intval($_POST['reviewer_category_use3']) . "',
		reviewer_category_use4='" . intval($_POST['reviewer_category_use4']) . "',
		reviewer_category_use5='" . intval($_POST['reviewer_category_use5']) . "',
		reviewer_category_use6='" . intval($_POST['reviewer_category_use6']) . "',
		reviewer_category_use7='" . intval($_POST['reviewer_category_use7']) . "',
		reviewer_category_use8='" . intval($_POST['reviewer_category_use8']) . "',
		reviewer_category_use9='" . intval($_POST['reviewer_category_use9']) . "',
		reviewer_category_use10='" . intval($_POST['reviewer_category_use10']) . "',
		reviewer_category_rate1='" . (empty($_POST['reviewer_category_rate1'])?"{REVIEWER_RATE1}":$tp->toDB($_POST['reviewer_category_rate1'])) . "',
		reviewer_category_rate2='" . (empty($_POST['reviewer_category_rate2'])?"{REVIEWER_RATE2}":$tp->toDB($_POST['reviewer_category_rate2'])) . "',
		reviewer_category_rate3='" . (empty($_POST['reviewer_category_rate3'])?"{REVIEWER_RATE3}":$tp->toDB($_POST['reviewer_category_rate3'])) . "',
		reviewer_category_rate4='" . (empty($_POST['reviewer_category_rate4'])?"{REVIEWER_RATE4}":$tp->toDB($_POST['reviewer_category_rate4'])) . "',
		reviewer_category_rate5='" . (empty($_POST['reviewer_category_rate5'])?"{REVIEWER_RATE5}":$tp->toDB($_POST['reviewer_category_rate5'])) . "',
		reviewer_category_rate6='" . (empty($_POST['reviewer_category_rate6'])?"{REVIEWER_RATE6}":$tp->toDB($_POST['reviewer_category_rate6'])) . "',
		reviewer_category_rate7='" . (empty($_POST['reviewer_category_rate7'])?"{REVIEWER_RATE7}":$tp->toDB($_POST['reviewer_category_rate7'])) . "',
		reviewer_category_rate8='" . (empty($_POST['reviewer_category_rate8'])?"{REVIEWER_RATE8}":$tp->toDB($_POST['reviewer_category_rate8'])) . "',
		reviewer_category_rate9='" . (empty($_POST['reviewer_category_rate9'])?"{REVIEWER_RATE9}":$tp->toDB($_POST['reviewer_category_rate9'])) . "',
		reviewer_category_rate10='" . (empty($_POST['reviewer_category_rate10'])?"{REVIEWER_RATE10}":$tp->toDB($_POST['reviewer_category_rate10'])) . "',
		reviewer_category_linkicon='" . $tp->toDB($_POST['reviewer_category_linkicon']) . "',
		reviewer_category_updated='" . time() . "'
		where reviewer_category_id='$reviewer_id'";
        if ($sql->db_Update("reviewer_category", $reviewer_args))
        {
            // Changes saved
            $reviewer_msg .= REVIEWER_AC017 ;
        }
        else
        {
            $reviewer_msg .= REVIEWER_AC018 ;
        }
    }

    $reviewer_obj->clear_cache();
}
// We are creating, editing or deleting a record
if ($reviewer_action == 'dothings')
{
    $reviewer_id = $_POST['reviewer_menu_selcat'];
    $reviewer_do = $_POST['reviewer_menu_recdel'];
    $reviewer_dodel = false;
    switch ($reviewer_do)
    {
        case '1': // Edit existing record
            {
                // We edit the record
                $sql->db_Select("reviewer_category", "*", "reviewer_category_id='$reviewer_id'");
                $reviewer_row = $sql->db_Fetch() ;
                extract($reviewer_row);
                $reviewer_cap1 = REVIEWER_AC019;
                $reviewer_edit = true;
                break;
            }
        case '2': // New category
            {
                // Create new record
                $reviewer_id = 0;
                // set all fields to zero/blank
                $reviewer_category_name = "";
                $reviewer_category_description = "";
                $reviewer_cap1 = REVIEWER_AC020;
                $reviewer_edit = true;
                break;
            }
        case '3':
            {
                // delete the record
                if ($_POST['reviewer_menu_okdel'] == '1')
                {
                    if ($sql->db_Select("reviewer_items", "reviewer_items_id", " where reviewer_items_catid='$reviewer_id'", "nowhere"))
                    {
                        $reviewer_msg .= REVIEWER_AC024 ;
                    }
                    else
                    {
                        if ($sql->db_Delete("reviewer_category", " reviewer_category_id='$reviewer_id'"))
                        {
                            $reviewer_msg .= REVIEWER_AC022 ;
                        }
                        else
                        {
                            $reviewer_msg .= REVIEWER_AC023;
                        }
                    }
                }
                else
                {
                    $reviewer_msg .= REVIEWER_AC021 ;
                }

                $reviewer_dodel = true;
                $reviewer_edit = false;
            }
    }

    if (!$reviewer_dodel)
    {
        // get file list
        require_once(e_HANDLER . "file_class.php");
        // print $pref['snow_fall'] ;
        $reviewer_fl = new e_file;
        $thumblist = $reviewer_fl->get_files(e_PLUGIN . "reviewer/images/caticons/", '');
        $catsmall = $reviewer_fl->get_files(e_PLUGIN . "reviewer/images/small/", '');

        $reviewer_text .= "
<form id='recipeupdate' method='post' action='" . e_SELF . "'>
	<div>
		<input type='hidden' value='$reviewer_id' name='reviewer_menu_id' />
		<input type='hidden' value='update' name='reviewer_action' />
	</div>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>
		<tr><td colspan='2' class='fcaption'>$reviewer_cap1&nbsp;</td></tr>
		<tr><td style='width:20%;vertical-align:top;' class='forumheader3'>" . REVIEWER_AC011 . "</td><td  class='forumheader3'><input type='text' class='tbox' name='reviewer_category_name' value='" . $tp->toFORM($reviewer_category_name) . "' /></td></tr>
		<tr><td style='width:20%;vertical-align:top;' class='forumheader3'>" . REVIEWER_AC012 . "</td><td  class='forumheader3'><textarea rows='6' cols='50' style='width:80%;' class='tbox' name='reviewer_category_description' >" . $tp->toFORM($reviewer_category_description) . "</textarea><br /></td></tr>";
        // category rating rate item 1
        $reviewer_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . REVIEWER_A015 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input class='tbox' type='checkbox' name='reviewer_category_use1' value='1' " . ($reviewer_category_use1 > 0?"checked='checked'":"") . " />
	" . REVIEWER_A028 . " <input class='tbox' type='text' style='width:30%' maxlength='20' name='reviewer_category_rate1' value='" . $tp->toFORM($reviewer_category_rate1) . "' />
			</td>
		</tr>";
        // category rating rate item 2
        $reviewer_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . REVIEWER_A016 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input class='tbox' type='checkbox' name='reviewer_category_use2' value='1' " . ($reviewer_category_use2 > 0?"checked='checked'":"") . " />
	" . REVIEWER_A028 . " <input class='tbox' type='text' style='width:30%' maxlength='20' name='reviewer_category_rate2' value='" . $tp->toFORM($reviewer_category_rate2) . "' />
			</td>
		</tr>";
        // category rating rate item 3
        $reviewer_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . REVIEWER_A017 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input class='tbox' type='checkbox' name='reviewer_category_use3' value='1' " . ($reviewer_category_use3 > 0?"checked='checked'":"") . " />
	" . REVIEWER_A028 . " <input class='tbox' type='text' style='width:30%' maxlength='20' name='reviewer_category_rate3' value='" . $tp->toFORM($reviewer_category_rate3) . "' />
			</td>
		</tr>";
        // category rating rate item 4
        $reviewer_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . REVIEWER_A018 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input class='tbox' type='checkbox' name='reviewer_category_use4' value='1' " . ($reviewer_category_use4 > 0?"checked='checked'":"") . " />
	" . REVIEWER_A028 . " <input class='tbox' type='text' style='width:30%' maxlength='20' name='reviewer_category_rate4' value='" . $tp->toFORM($reviewer_category_rate4) . "' />
			</td>
		</tr>";
        // category rating rate item 5
        $reviewer_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . REVIEWER_A019 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input class='tbox' type='checkbox' name='reviewer_category_use5' value='1' " . ($reviewer_category_use5 > 0?"checked='checked'":"") . " />
	" . REVIEWER_A028 . " <input class='tbox' type='text' style='width:30%' maxlength='20' name='reviewer_category_rate5' value='" . $tp->toFORM($reviewer_category_rate5) . "' />
			</td>
		</tr>";
        // category rating rate item 6
        $reviewer_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . REVIEWER_A029 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input class='tbox' type='checkbox' name='reviewer_category_use6' value='1' " . ($reviewer_category_use6 > 0?"checked='checked'":"") . " />
	" . REVIEWER_A028 . " <input class='tbox' type='text' style='width:30%' maxlength='20' name='reviewer_category_rate6' value='" . $tp->toFORM($reviewer_category_rate6) . "' />
			</td>
		</tr>";
        // category rating rate item 7
        $reviewer_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . REVIEWER_A030 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input class='tbox' type='checkbox' name='reviewer_category_use7' value='1' " . ($reviewer_category_use7 > 0?"checked='checked'":"") . " />
	" . REVIEWER_A028 . " <input class='tbox' type='text' style='width:30%' maxlength='20' name='reviewer_category_rate7' value='" . $tp->toFORM($reviewer_category_rate7) . "' />
			</td>
		</tr>";
        // category rating rate item 8
        $reviewer_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . REVIEWER_A031 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input class='tbox' type='checkbox' name='reviewer_category_use8' value='1' " . ($reviewer_category_use8 > 0?"checked='checked'":"") . " />
	" . REVIEWER_A028 . " <input class='tbox' type='text' style='width:30%' maxlength='20' name='reviewer_category_rate8' value='" . $tp->toFORM($reviewer_category_rate8) . "' />
			</td>
		</tr>";
        // category rating rate item 9
        $reviewer_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . REVIEWER_A032 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input class='tbox' type='checkbox' name='reviewer_category_use9' value='1' " . ($reviewer_category_use9 > 0?"checked='checked'":"") . " />
	" . REVIEWER_A028 . " <input class='tbox' type='text' style='width:30%' maxlength='20' name='reviewer_category_rate9' value='" . $tp->toFORM($reviewer_category_rate9) . "' />
			</td>
		</tr>";
        // category rating rate item 10

        $reviewer_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . REVIEWER_A033 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input class='tbox' type='checkbox' name='reviewer_category_use10' value='1' " . ($reviewer_category_use10 > 0?"checked='checked'":"") . " />
	" . REVIEWER_A028 . " <input class='tbox' type='text' style='width:30%' maxlength='20' name='reviewer_category_rate10' value='" . $tp->toFORM($reviewer_category_rate10) . "' />
			</td>
		</tr>";
	        $reviewer_text .= "
		<tr><td style='width:20%;vertical-align:top;' class='forumheader3'>" . REVIEWER_AC030 . "</td>
		<td  class='forumheader3'>
		<input type='text' class='tbox' id='reviewer_category_linkicon' name='reviewer_category_linkicon' value='" . $tp->toFORM($reviewer_category_linkicon) . "' /><br />";
        foreach($catsmall as $smallicon)
        {
            $reviewer_text .= "<a href=\"javascript:insertext('" . $smallicon['fname'] . "','reviewer_category_linkicon','newsicn')\"><img src='" . $smallicon['path'] . $smallicon['fname'] . "' style='border:0' alt='' /></a><br />";
        }



        $reviewer_text .= "
		<tr><td style='width:20%;vertical-align:top;' class='forumheader3'>" . REVIEWER_AC013 . "</td><td  class='forumheader3'><input type='text' class='tbox' id='reviewer_category_icon' name='reviewer_category_icon' value='" . $tp->toFORM($reviewer_category_icon) . "' /><br />";
        foreach($thumblist as $icon)
        {
            $reviewer_text .= "<a href=\"javascript:insertext('" . $icon['fname'] . "','reviewer_category_icon','newsicn')\"><img src='" . $icon['path'] . $icon['fname'] . "' style='border:0' alt='' /></a><br />";
        }
        $reviewer_text .= "</td></tr>
		<tr><td colspan='2' class='fcaption'><input type='submit' name='submits' value='" . REVIEWER_AC014 . "' class='tbox' /></td></tr>
	</table>
</form>";
    }
}
if (!$reviewer_edit)
{
    // Get the category names to display in combo box
    // then display actions available
    $reviewermenu2_yes = false;
    if ($sql->db_Select("reviewer_category", "reviewer_category_id,reviewer_category_name", " order by reviewer_category_name", "nowhere"))
    {
        $reviewermenu2_yes = true;
        while ($reviewer_row = $sql->db_Fetch())
        {
            extract($reviewer_row);
            $reviewer_catopt .= "<option value='$reviewer_category_id'" .
            ($reviewer_id == $reviewer_category_id?" selected='selected'":"") . ">" . $tp->toFORM($reviewer_category_name) . "</option>";
        }
    }
    else
    {
        $reviewer_catopt .= "<option value='0'>" . REVIEWER_AC010 . "</option>";
    }

    $reviewer_text .= "
<form id='recipeform' method='post' action='" . e_SELF . "'>
	<div>
		<input type='hidden' value='dothings' name='reviewer_action' />
	</div>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>
		<tr><td colspan='2' class='fcaption'>" . REVIEWER_AC002 . "</td></tr>
		<tr><td colspan='2' class='forumheader2'><b>$reviewer_msg</b>&nbsp;</td></tr>
		<tr><td style='width:20%;' class='forumheader3'>" . REVIEWER_AC003 . "</td><td  class='forumheader3'><select name='reviewer_menu_selcat' class='tbox'>$reviewer_catopt</select></td></tr>
		<tr>
			<td style='width:20%;' class='forumheader3'>" . REVIEWER_AC004 . "</td><td  class='forumheader3'>
				<input type='radio' name='reviewer_menu_recdel' value='1'  " . ($reviewermenu2_yes?"checked='checked'":"disabled='disabled'") . " /> " . REVIEWER_AC005 . "<br />
				<input type='radio' name='reviewer_menu_recdel' value='2' " . (!$reviewermenu2_yes?"checked='checked'":"") . " /> " . REVIEWER_AC006 . "<br />
				<input type='radio' name='reviewer_menu_recdel' value='3' /> " . REVIEWER_AC007 . "
				<input type='checkbox' name='reviewer_menu_okdel' value='1' />" . REVIEWER_AC008 . "
			</td>
		</tr>
		<tr>
			<td colspan='2' class='fcaption'><input type='submit' name='submits' value='" . REVIEWER_AC009 . "' class='tbox' /></td>
		</tr>
	</table>
</form>";
}

$ns->tablerender(REVIEWER_AC001, $reviewer_text);
require_once(e_ADMIN . "footer.php");

?>