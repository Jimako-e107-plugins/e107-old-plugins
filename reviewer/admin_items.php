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
include_lan(e_PLUGIN . "reviewer/languages/" . e_LANGUAGE . ".php");
e107_require_once(e_PLUGIN . "reviewer/includes/reviewer_class.php");
if (!is_object($reviewer_obj))
{
    $reviewer_obj = new reviewer;
}
require_once(e_HANDLER . "ren_help.php");
require_once(e_ADMIN . "auth.php");
if (!defined("ADMIN_WIDTH"))
{
    define(ADMIN_WIDTH, "width:100%;");
}
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $reviewer_action = $_POST['reviewer_action'];
    $reviewer_itemid = intval($_POST['reviewer_itemid']);
    $reviewer_current = intval($_POST['reviewer_current']);
} elseif (e_QUERY)
{
    $tmp = explode(".", e_QUERY);
    $reviewer_action = $tmp[0];
    $reviewer_itemid = intval($tmp[1]);
}
if (empty($reviewer_action))
{
    $reviewer_action = "list";
}
$reviewer_current = intval($_POST['reviewer_current']);

if (isset($_POST['reviewer_change']))
{
    // we are changing the displayed order
    foreach($_POST['reviewer_items_order'] as $key => $row)
    {
        $sql->db_Update("reviewer_items", "
	     reviewer_items_order = '" . intval($_POST['reviewer_items_order'][$key]) . "'
	    where reviewer_items_id=" . intval($key), false) ;
    }
    $reviewer_msg .= REVIEWER_AI019 . "<br />";
    $reviewer_obj->clear_cache();
}

if (isset($_POST['reviewer_dodel']))
{
    // do deletion
    $sql->db_Select_gen("
	select reviewer_reviewer_id from #reviewer_reviewer
	left join #reviewer_items on reviewer_reviewer_itemid = reviewer_items_id
	where reviewer_reviewer_itemid=$reviewer_itemid", false);
    while ($reviewer_row = $sql->db_Fetch())
    {
        extract($reviewer_row);
        $sql2->db_Delete("comments", "comment_type='reviewer' and comment_item_id=$reviewer_reviewer_id", false);
    }
    $sql->db_Delete("reviewer_reviewer", "reviewer_reviewer_itemid=$reviewer_itemid", false);
    $sql->db_Delete("reviewer_items", "reviewer_items_id=$reviewer_itemid", false);
    $reviewer_obj->recalc_all();
    $reviewer_obj->clear_cache();
    $reviewer_action = "list";
    $reviewer_msg .= REVIEWER_AI027 . "<br />";
}
if (isset($_POST['reviewer_notdel']))
{
    // do not do deletion
    $reviewer_action = "list";
}
if ($reviewer_action == "delete")
{
    $reviewer_text .= "
	<form id='dataform' method='post' action='" . e_SELF . "?update'>
<div>
	<input type='hidden' name='reviewer_action' value='$reviewer_action' />
	<input type='hidden' name='reviewer_itemid' value='$reviewer_itemid' />
	<input type='hidden' name='reviewer_current' value='$reviewer_current' />
</div>
	<table class='fborder' style='" . ADMIN_WIDTH . "'>
		<tr>
			<td class='fcaption' style='text-align:left'>" . REVIEWER_AI023 . "</td>
		</tr>
		<tr>
			<td class='forumheader3' style='text-align:center'>" . REVIEWER_AI022 . " $reviewer_itemid " . REVIEWER_AI026 . "<br />
				<input type='submit' class='button' name='reviewer_dodel' value='" . REVIEWER_AI024 . "' />&nbsp;&nbsp;&nbsp;
				<input type='submit' class='button' name='reviewer_notdel' value='" . REVIEWER_AI025 . "' />
			</td>
		</tr>
		<tr>
			<td class='fcaption' style='text-align:left'>&nbsp;</td>
		</tr>
	</table>
</form>";
}
if ($reviewer_action == "duplicate")
{
    $reviewer_action = "list";
    $reviewer_arg = "insert into #reviewer_items
select  NULL,concat(reviewer_items_name,' (Copy)'),reviewer_items_description,reviewer_items_updated,
reviewer_items_catid,reviewer_items_url,0,0,0,0,0,0,0,0,0,0,0,0,0,reviewer_items_picture,0 from #reviewer_items
where reviewer_items_id = $reviewer_itemid";

    $reviewer_insertid = $sql->db_Select_gen($reviewer_arg, false);
}
if (isset($_POST['reviewer_duplicate']))
{
    $reviewer_newcat = intval($_POST['reviewer_destination']);
    $reviewer_arg = "
insert into #reviewer_items (reviewer_items_name,reviewer_items_description,reviewer_items_updated,reviewer_items_catid,reviewer_items_url,reviewer_items_order,reviewer_items_picture)
 select reviewer_items_name,reviewer_items_description," . time() . ",$reviewer_newcat,reviewer_items_url,reviewer_items_order,reviewer_items_picture,0
from #reviewer_items
where reviewer_items_catid=" . intval($_POST['reviewer_saved']);
    $sql->db_Select_gen($reviewer_arg, false);
    $reviewer_current = $reviewer_newcat;
}
if (isset($_POST['reviewer_save']))
{
    if ($reviewer_action == "add")
    {
        // if we are adding a record then check if same name exists
        if ($sql->db_Select("reviewer_items", "reviewer_items_name", "where reviewer_items_name='" . $tp->toDB($_POST['newitem']) . "'", "nowhere", false))
        {
            // yes so don't add just give error message
            $reviewer_msg .= REVIEWER_AI017 . "<br />";
        }
        else
        {
            // no so add it
            $sql->db_Insert("reviewer_items", "0,'" . $tp->toDB($_POST['newitem']) . "','',0," . $reviewer_current . ",'',0,0,0,0,0,0,0,0", false);
            $reviewer_msg .= REVIEWER_AI016 . "<br />";
            $sql->db_Insert("reviewer_items", "
		0,
		'" . $tp->toDB($_POST['reviewer_items_name']) . "',
		'" . $tp->toDB($_POST['reviewer_items_description']) . "',
		'" . time() . "',
		'" . intval($_POST['reviewer_items_catid']) . "',
		'" . $tp->toDB($_POST['reviewer_items_url']) . "',
		0,0,0,0,0,0,0,0,0,0,0,0,0,
		'" . $tp->toDB($_POST['reviewer_items_picture']) . "',".intval($_POST['reviewer_items_approved']).",".USERID, false);
        }
    }
    else
    {
        // do an update
        $sql->db_Update("reviewer_items", "
		reviewer_items_name='" . $tp->toDB($_POST['reviewer_items_name']) . "',
		reviewer_items_description='" . $tp->toDB($_POST['reviewer_items_description']) . "',
		reviewer_items_updated=" . time() . ",
		reviewer_items_catid=" . intval($_POST['reviewer_items_catid']) . ",
		reviewer_items_url='" . $tp->toDB($_POST['reviewer_items_url']) . "',
		reviewer_items_approved='" . intval($_POST['reviewer_items_approved']) . "',
		reviewer_items_picture='" . $tp->toDB($_POST['reviewer_items_picture']) . "' where reviewer_items_id=$reviewer_itemid");
        $reviewer_msg .= REVIEWER_AI019;
    }
    $reviewer_obj->clear_cache();
    $reviewer_action = "list";
}
if ($reviewer_action == "edit" || $reviewer_action == "add")
{
    if ($reviewer_itemid > 0)
    {
        $sql->db_Select("reviewer_items", "*", "where reviewer_items_id=$reviewer_itemid", "nowhere", false);
        extract($sql->db_Fetch());
    }
    $reviewer_catlist = "<select class='tbox' name='reviewer_items_catid' >";
    $sql->db_Select("reviewer_category", "reviewer_category_id,reviewer_category_name", "order by reviewer_category_name", "nowhere", false);
    while ($reviewer_row = $sql->db_Fetch())
    {
        $reviewer_catlist .= "<option value='" . $reviewer_row['reviewer_category_id'] . "' " . ($reviewer_row['reviewer_category_id'] == $reviewer_items_catid?"selected='selected'":"") . ">" . $tp->toFORM($reviewer_row['reviewer_category_name']) . "</option>";
    }
    $reviewer_catlist .= "</select>";
    $reviewer_piclist = "<select class='tbox' name='reviewer_items_picture'>";
    $reviewer_piclist .= "<option value=''>" . REVIEWER_AI021 . "</option>";
    foreach (glob("./images/itempics/*.*") as $filename)
    {
        $filename = basename($filename);
        $reviewer_piclist .= "<option value='" . $filename . "' " . ($reviewer_items_picture == $filename?"selected='selected'":"") . " >$filename</option>";
    }
    $reviewer_piclist .= "</select>";
    $reviewer_text .= "
	<form id='dataform' method='post' action='" . e_SELF . "'>
<div>
	<input type='hidden' name='reviewer_action' value='$reviewer_action' />
	<input type='hidden' name='reviewer_itemid' value='$reviewer_itemid' />
	<input type='hidden' name='reviewer_current' value='$reviewer_current' />
</div>
	<table class='fborder' style='" . ADMIN_WIDTH . "'>
		<tr>
			<td class='fcaption' colspan='2' style='text-align:left'>" . REVIEWER_AI002 . "</td>
		</tr>
		<tr>
			<td class='forumheader3' style='text-align:left'>" . REVIEWER_AI004 . "</td>
			<td class='forumheader3' style='text-align:left'>
				$reviewer_catlist
			</td>
		</tr>
		<tr>
			<td class='forumheader3' style='text-align:left'>" . REVIEWER_AI007 . "</td>
			<td class='forumheader3' style='text-align:left'>
				<input class='tbox' style='width:50%' type='text' name='reviewer_items_name' value='" . $tp->toFORM($reviewer_items_name) . "' />
			</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:30%;text-align:left'>" . REVIEWER_AI008 . "</td>
			<td class='forumheader3' style='text-align:left;'>
				<textarea name='reviewer_items_description'  class='tbox' rows='5' cols='50' style='width:75%' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>" . $tp->toFORM($reviewer_items_description) . "</textarea>
				<br /><input type='text' style='width:85%;border:0;' class='tbox' id='helpb' /><br />" . display_help("helpb") . "
			</td>
		</tr>
		<tr>
			<td class='forumheader3' style='text-align:left'>" . REVIEWER_AI009 . "</td>
			<td class='forumheader3' style='text-align:left'>
				<input class='tbox' style='width:60%' type='text' name='reviewer_items_url' value='" . $tp->toFORM($reviewer_items_url) . "' />
			</td>
		</tr>
		<tr>
			<td class='forumheader3' style='text-align:left'>" . REVIEWER_AI020 . "</td>
			<td class='forumheader3' style='text-align:left'>
				$reviewer_piclist
			</td>
		</tr>
		<tr>
			<td class='forumheader3' style='text-align:left'>" . REVIEWER_H022 . "</td>
			<td class='forumheader3' style='text-align:left'><input type='checkbox' name='reviewer_items_approved' class='tbox' value='1' ".($reviewer_items_approved==1?"checked='checked'":"")." /></td>
		</tr>
		<tr>
			<td class='forumheader3' colspan='2' style='text-align:left'>
				<input type='submit' class='button' name='reviewer_save' value='" . REVIEWER_AI012 . "' />
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='2' style='text-align:left'>&nbsp;</td>
		</tr>
	</table>
</form>";
}
if ($reviewer_action == "list")
{
    // get list of categories
    $reviewer_selector = "<select class='tbox' name='reviewer_current' onchange=\"this.form.submit()\">";
    $reviewer_destination = "<select class='tbox' name='reviewer_destination' >";
    $sql->db_Select("reviewer_category", "*", "order by reviewer_category_name", "nowhere", false);
    while ($reviewer_row = $sql->db_Fetch())
    {
        if ($reviewer_current == 0)
        {
            $reviewer_current = $reviewer_row['reviewer_category_id'];
        }
        $reviewer_selector .= "<option value='" . $reviewer_row['reviewer_category_id'] . "' " . ($reviewer_row['reviewer_category_id'] == $reviewer_current?"selected='selected'":"") . ">" . $reviewer_row['reviewer_category_name'] . "</option>";
        $reviewer_destination .= ($reviewer_row['reviewer_category_id'] != $reviewer_current?"<option value='" . $reviewer_row['reviewer_category_id'] . "' >" . $reviewer_row['reviewer_category_name'] . "</option>":"") ;
    }
    $reviewer_selector .= "</select>";
    $reviewer_destination .= "</select>";
    $reviewer_text .= "
<form id='dataform' method='post' action='" . e_SELF . "'>
<div>
	<input type='hidden' name='reviewer_saved' value='$reviewer_current' />
</div>
	<table class='fborder' style='" . ADMIN_WIDTH . "'>
		<tr>
			<td class='fcaption' colspan='5' style='text-align:left'>" . REVIEWER_AI002 . "</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='5' style='text-align:left'><b>" . $reviewer_msg . "</b>&nbsp;</td>
		</tr>

		<tr>
			<td class='forumheader2' colspan='5' style='text-align:left'>" . REVIEWER_AI004 . " " . $reviewer_selector . "
			<input type='submit' class='button' name='reviewer_filter' value='" . REVIEWER_AI005 . "' /></td>
		</tr>


		<tr>
			<td class='fcaption' colspan='5' style='text-align:left'><b>" . REVIEWER_AI013 . "</b>&nbsp;</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='5' style='text-align:left'>
				<a href='" . e_SELF . "?add' >" . REVIEWER_AI015 . "</a>
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='5' style='text-align:left'><b>" . REVIEWER_A036 . "</b>&nbsp;</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='5' style='text-align:left'>" . REVIEWER_A034 . " $reviewer_destination
				<input type='submit' class='button' name='reviewer_duplicate' value='" . REVIEWER_A035 . "' />
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='5' style='text-align:left'><b>" . REVIEWER_AI003 . "</b>&nbsp;</td>
		</tr>";
    $reviewer_text .= "

		<tr>
			<td class='forumheader2'  style='text-align:left;width:40%;'>" . REVIEWER_AI007 . "</td>
			<td class='forumheader2'  style='text-align:left;width:20%;'>" . REVIEWER_AI032 . "</td>
			<td class='forumheader2'  style='text-align:center;width:10%;'>" . REVIEWER_AI030 . "</td>
			<td class='forumheader2'  style='text-align:right;width:10%;'>" . REVIEWER_AI018 . "</td>
			<td class='forumheader2'  style='text-align:center;width:20%;'>" . REVIEWER_AI010 . "</td>
		</tr>";
    $sql->db_Select("reviewer_items", "*", "where reviewer_items_catid=$reviewer_current", "nowhere", false);
    $reviewer_lrow = $sql->db_Fetch();
    extract($reviewer_lrow);
    $sql->db_Select_gen("select a.*,b.user_name from #reviewer_items as a  left join #user as b on user_id= reviewer_items_posterid where reviewer_items_catid=$reviewer_current order by reviewer_items_order,reviewer_items_name ",  false);
    while ($reviewer_row = $sql->db_Fetch())
    {
        extract($reviewer_row);
        $reviewer_text .= "
		<tr>
			<td class='forumheader3' style='text-align:left'>
				" . $tp->toHTML($reviewer_items_name) . "
			</td>
			<td class='forumheader3' style='text-align:left'>
				" . $tp->toHTML($user_name) . "
			</td>
			<td class='forumheader3' style='text-align:center'>
				".($reviewer_items_approved==1?"&nbsp;":"<img src='images/notapproved.png' alt='' title='' style='border:0px' />")."
			</td>
			<td class='forumheader3' style='text-align:right'>
				<input class='tbox' style='width:40px;text-align:right;' type='text' name='reviewer_items_order[$reviewer_items_id]' value='$reviewer_items_order' />
			</td>
			<td class='forumheader3' style='text-align:center'>
				<a href='" . e_SELF . "?edit.$reviewer_items_id' ><img src='" . e_IMAGE . "admin_images/edit_16.png' alt='edit' /></a>&nbsp;
				<a href='" . e_SELF . "?delete.$reviewer_items_id' ><img src='" . e_IMAGE . "admin_images/delete_16.png' alt='delete' /></a>&nbsp;
				<a href='" . e_SELF . "?duplicate.$reviewer_items_id' ><img src='images/duplicate_16.png' alt='Duplicate' /></a>
			</td>
		</tr>";
    } // while
    $reviewer_text .= "
		<tr>
			<td class='fcaption' colspan='5' style='text-align:left'>&nbsp;</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='5' style='text-align:left'>
				<input type='submit' class='button' name='reviewer_change' value='" . REVIEWER_AI012 . "'  />
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='5' style='text-align:left'>&nbsp;</td>
		</tr>
	</table>
</form>";
}
$ns->tablerender(REVIEWER_AI001, $reviewer_text);
require_once(e_ADMIN . "footer.php");

?>