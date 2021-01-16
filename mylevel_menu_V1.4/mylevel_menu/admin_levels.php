<?php
/*
+---------------------------------------------------------------+
|        MyLevel Menu for e107 v7xx - by Father Barry
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
    header("location:" . e_HTTP . "index.php");
    exit;
}
require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, "width:100%;");
}
require_once(e_PLUGIN . "mylevel_menu/includes/mylevel_class.php");
if (!is_object($mylevel_obj))
{
    $mylevel_obj = new mylevel;
}
include_lan(e_PLUGIN . 'mylevel_menu/languages/' . e_LANGUAGE . '.php');
require_once(e_HANDLER."userclass_class.php");
$mylevel_from = 0;
if (isset($_POST['mylevel_action']))
{
    $mylevel_from = intval($_POST['mylevel_from']);
    $mylevel_action = $_POST['mylevel_action'];
    $mylevel_id = intval($_POST['mylevel_id']);
}
else
{
    $mylevel_tmp = explode(".", e_QUERY);
    $mylevel_from = intval($mylevel_tmp[0]);
    $mylevel_action = $mylevel_tmp[1];
    $mylevel_id = intval($mylevel_tmp[2]);
}

if (!empty($_POST['cancel']))
{
    $mylevel_action = "";
}
switch ($MYLEVEL_PREF['mylevel_userate'])
{
    case 0:
        $mylevel_method = MYLEVEL_A46;
        break;
    case 1:
        $mylevel_method = MYLEVEL_A47;
        break;
    case 2:
        $mylevel_method = MYLEVEL_A48;
        break;
}
if ($mylevel_action == "delete")
{
    $mylevel_arg = "select * from #mylevel
left join #user on  mylevel_id=user_id
where mylevel_id=$mylevel_id ";
    $sql->db_Select_gen($mylevel_arg, true);
    extract($sql->db_Fetch());
    $mymenu_text .= "
<form method='post' action='" . e_SELF . "' id='mylevelform'>
	<div>
		<input type='hidden'  name='mylevel_action' value='dodelete' />
		<input type='hidden'  name='mylevel_id' value='$mylevel_id' />
	</div>
	<table class='fborder' style='" . ADMIN_WIDTH . "'>
		<tr>
			<td class='fcaption' >" . MYLEVEL_A16 . "</td>
		</tr>
		<tr>
			<td class='forumheader3' style='text-align:center;' >" . MYLEVEL_A29 . " <strong>" . $tp->toHTML($user_name) . "</strong> " . MYLEVEL_A30 . "<br /><br />
				<input type='submit' class='button' name='okdel' value='" . MYLEVEL_A31 . "' />&nbsp;&nbsp;&nbsp;
				<input type='submit' class='button' name='cancel' value='" . MYLEVEL_A32 . "' />
			</td>
		</tr>
				<tr>
			<td class='fcaption' >&nbsp;</td>
		</tr>
	</table>
</form>
";
}
if ($mylevel_action == "dodelete")
{
    $sql->db_Delete("mylevel", "mylevel_id={$mylevel_id}", false);
    $mylevel_msg = MYLEVEL_A26;
    $mylevel_action = "";
}
if ($mylevel_action == "save")
{
    $sql->db_Insert("mylevel", intval($_POST['mylevel_id']) . "," . intval($_POST['mylevel_level']) . ",'" . $tp->toDB($_POST['mylevel_comment']) . "'", false);
    $mylevel_msg = MYLEVEL_A27;
    $mylevel_action = "";
    $e107cache->clear("nq_mylevel_menu");
}
if ($mylevel_action == "update")
{
    $sql->db_Update("mylevel", "
	mylevel_level='" . intval($_POST['mylevel_level']) . "',
	mylevel_comment='" . $tp->toDB($_POST['mylevel_comment']) . "'
	where mylevel_id=" . $mylevel_id, false);
    $mylevel_action = "";
    $mylevel_msg = MYLEVEL_A28;
    $e107cache->clear("nq_mylevel_menu");
}
if ($mylevel_action == "add")
{
    $mylevel_obj->get_users();
    $mylevel_action = "";
    // $mymenu_text .= "
    // <form method='post' action='" . e_SELF . "' id='mylevelform'>
    // <div>
    // <input type='hidden'  name='mylevel_action' value='save' />
    // </div>
    // <table class='fborder' style='" . ADMIN_WIDTH . "'>
    // <tr>
    // <td class='fcaption' colspan='2'>" . MYLEVEL_A16 . "</td>
    // </tr>
    // <tr>
    // <td class='forumheader2' style='width:25%;'>" . MYLEVEL_A17 . "</td>
    // <td class='forumheader2' style='width:75%;'>
    // <select name='mylevel_id' class='tbox'>" ;
    // $mylevel_arg = "select user_id,user_name from #user
    // left join #mylevel on user_id=mylevel_id
    // where mylevel_id is null";
    // $sql->db_Select_gen($mylevel_arg, false);
    // while ($mylevel_row = $sql->db_Fetch())
    // {
    // $mymenu_text .= "<option value='" . $mylevel_row['user_id'] . "' >" . $tp->toFORM($mylevel_row['user_name']) . "</option>";
    // }
    // $mymenu_text .= "
    // </select>
    // </td>
    // </tr>
    // <tr>
    // <td class='forumheader2' style='width:25%;'>" . MYLEVEL_A18 . "</td>
    // <td class='forumheader2' style='width:75%;'>
    // <select name='mylevel_level' class='tbox' >
    // <option value='1' " . ($mylevel_level == 1?"selected='selected'":"") . ">1</option>
    // <option value='2' " . ($mylevel_level == 2?"selected='selected'":"") . ">2</option>
    // <option value='3' " . ($mylevel_level == 3?"selected='selected'":"") . ">3</option>
    // <option value='4' " . ($mylevel_level == 4?"selected='selected'":"") . ">4</option>
    // <option value='5' " . ($mylevel_level == 5?"selected='selected'":"") . ">5</option>
    // <option value='6' " . ($mylevel_level == 6?"selected='selected'":"") . ">6</option>
    // <option value='7' " . ($mylevel_level == 7?"selected='selected'":"") . ">7</option>
    // <option value='8' " . ($mylevel_level == 8?"selected='selected'":"") . ">8</option>
    // <option value='9' " . ($mylevel_level == 9?"selected='selected'":"") . ">9</option>
    // <option value='10' " . ($mylevel_level == 10?"selected='selected'":"") . ">10</option>
    // </select>
    // </td>
    // </tr>
    // <tr>
    // <td class='forumheader2' style='width:25%;'>" . MYLEVEL_A19 . "</td>
    // <td class='forumheader2' style='width:75%;'>
    // <input type='text' style='width:90%' name='mylevel_comment' value='' class='tbox' maxlength='149' />
    // </td>
    // </tr>
    // <tr>
    // <td class='fcaption' colspan='2'>
    // <input type='submit' class='button' name='subform' value='" . MYLEVEL_A10 . "' />
    // </td>
    // </tr>
    // </table>
    // </form>";
}
if ($mylevel_action == "edit")
{
    $mylevel_arg = "select * from #mylevel
left join #user on  mylevel_id=user_id
where mylevel_id=$mylevel_id";
    if ($sql->db_Select_gen($mylevel_arg, false))
    {
        extract($sql->db_Fetch());
        $mymenu_text .= "
<form method='post' action='" . e_SELF . "' id='mylevelform'>
	<div>
		<input type='hidden'  name='mylevel_id' value='" . $mylevel_id . "' />
		<input type='hidden'  name='mylevel_action' value='update' />
	</div>
	<table class='fborder' style='" . ADMIN_WIDTH . "'>
		<tr>
			<td class='fcaption' colspan='2'>" . MYLEVEL_A16 . "</td>
		</tr>
		<tr>
			<td class='forumheader2' style='width:25%;'>" . MYLEVEL_A17 . "</td>
			<td class='forumheader2' style='width:75%;'>" . $tp->toHTML($user_name, false) . "
			</td>
		</tr>";
        if ($mylevel_obj->mylevel_userate == 0)
        {
            $mymenu_text .= "
		<tr>
			<td class='forumheader2' style='width:25%;'>" . MYLEVEL_A18 . "</td>
			<td class='forumheader2' style='width:75%;'>
				<select name='mylevel_level' class='tbox' >
					<option value='1' " . ($mylevel_level == 1?"selected='selected'":"") . ">1</option>
					<option value='2' " . ($mylevel_level == 2?"selected='selected'":"") . ">2</option>
					<option value='3' " . ($mylevel_level == 3?"selected='selected'":"") . ">3</option>
					<option value='4' " . ($mylevel_level == 4?"selected='selected'":"") . ">4</option>
					<option value='5' " . ($mylevel_level == 5?"selected='selected'":"") . ">5</option>
					<option value='6' " . ($mylevel_level == 6?"selected='selected'":"") . ">6</option>
					<option value='7' " . ($mylevel_level == 7?"selected='selected'":"") . ">7</option>
					<option value='8' " . ($mylevel_level == 8?"selected='selected'":"") . ">8</option>
					<option value='9' " . ($mylevel_level == 9?"selected='selected'":"") . ">9</option>
					<option value='10' " . ($mylevel_level == 10?"selected='selected'":"") . ">10</option>
				</select>
			</td>
		</tr>";
        }
        $mymenu_text .= "
		<tr>
			<td class='forumheader2' style='width:25%;'>" . MYLEVEL_A19 . "</td>
			<td class='forumheader2' style='width:75%;'>
				<input type='text' style='width:90%' name='mylevel_comment' value='" . $tp->toFORM($mylevel_comment) . "' class='tbox' maxlength='149' />
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='2'>
				<input type='submit' class='button' name='subform' value='" . MYLEVEL_A10 . "' />
			</td>
		</tr>
	</table>
</form>";
    }
}
if (empty($mylevel_action) || $mylevel_action == "list")
{
    $mylevel_filterlevel = intval($_POST['mylevel_filterlevel']);
    if ($mylevel_obj->mylevel_excludeclass != 255)
    {
        $mylevel_sel = "and not find_in_set(" . $mylevel_obj->mylevel_excludeclass . ",user_class)";
    }
    if ($mylevel_filterlevel > 0)
    {
        $mylevel_sel .= " and mylevel_level = $mylevel_filterlevel";
    }

    $mymenu_text .= "
<form method='post' action='" . e_SELF . "' id='mylevel' >
<div>
	<input type='hidden' name='mylevel_id' value='{$mylevel_id}' />
</div>
<table class='fborder' style='" . ADMIN_WIDTH . "'>
	<tr>
		<td class='fcaption' colspan='5'>" . MYLEVEL_A16 . "</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='5'><strong>" . $mylevel_msg . "</strong>&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='5'>" . MYLEVEL_A45 . ": <b>$mylevel_method</b></td>
	</tr>
	<tr>
		<td class='forumheader2' >" . MYLEVEL_A50 . ": </td>
		<td class='forumheader2' style='text-align:right;'><b>" . $mylevel_obj->max . "</b></td>
		<td class='forumheader2' colspan='3'>&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader2' style='width:20%;'><strong>" . MYLEVEL_A17 . "</strong></td>
		<td class='forumheader2' style='width:10%;text-align:right'><strong>" . MYLEVEL_A49 . "</strong></td>
		<td class='forumheader2' style='width:10%;text-align:right'><strong>" . $mylevel_head . "</strong></td>
		<td class='forumheader2' style='width:50%;'><strong>" . MYLEVEL_A19 . "</strong></td>
		<td class='forumheader2'style='width:10%;text-align:center'><strong>" . MYLEVEL_A23 . "</strong></td>
	</tr>";
    // get list of users
    $mylevelcarg = "select count(*) as numrecs from #mylevel left join #user on  mylevel_id=user_id
	where user_name like '%" . $tp->toDB($_POST['lookname']) . "%' $mylevel_sel ";
    $sql->db_Select_gen($mylevelcarg, false);
    $mylevel_row = $sql->db_Fetch();
    $mylevel_count = $mylevel_row['numrecs'];

    $mylevel_arg = "select * from #mylevel
left join #user on  mylevel_id=user_id
where user_name like '%" . $tp->toDB($_POST['lookname']) . "%' $mylevel_sel
order by user_name limit $mylevel_from,15";
    $mylevel_loc = "normal";
    if ($sql->db_Select_gen($mylevel_arg, false))
    {
        while ($mylevel_row = $sql->db_Fetch())
        {
            extract($mylevel_row);

            $mymenu_text .= "
	<tr>
		<td class='forumheader3' >" . $tp->toHTML($user_name) . "</td>

		<td class='forumheader3' style='text-align:right'>$mylevel_contribution </td>
		<td class='forumheader3' style='text-align:right'>" . $tp->toHTML($mylevel_level) . "&nbsp;<img src='images/$mylevel_loc/{$mylevel_level}.png' alt='{$mylevel_level}' title='{$mylevel_level}' /></td>
		<td class='forumheader3' >" . $tp->toHTML($mylevel_comment) . "&nbsp;</td>
		<td class='forumheader3' style='text-align:center'>
		<a href='" . e_SELF . "?$mylevel_from.edit.$mylevel_id'><img src='" . e_IMAGE . "admin_images/edit_16.png' title='' alt='' /></a>";
            $mymenu_text .= "
		</td>
	</tr>";
        } // while
    }
    else
    {
        $mymenu_text .= "
	<tr>
		<td class='forumheader2' colspan='5'>" . MYLEVEL_A25 . "</td>
	</tr>";
    }

    $mylevel_action = "list";
    $parms = $mylevel_count . "," . 15 . "," . $mylevel_from . "," . e_SELF . '?' . "[FROM]." . $mylevel_action;
    $mylevel_np .= $tp->parseTemplate("{NEXTPREV={$parms}}");

    $mymenu_text .= "
    	<tr>
		<td class='forumheader2' style='text-align:center;' colspan='5'>" . MYLEVEL_A36 . "
		<select name='mylevel_filterlevel' class='tbox' onchange='this.form.submit()' >
					<option value='0' " . ($mylevel_filterlevel == 0?"selected='selected'":"") . ">" . MYLEVEL_A35 . "</option>
					<option value='1' " . ($mylevel_filterlevel == 1?"selected='selected'":"") . ">1</option>
					<option value='2' " . ($mylevel_filterlevel == 2?"selected='selected'":"") . ">2</option>
					<option value='3' " . ($mylevel_filterlevel == 3?"selected='selected'":"") . ">3</option>
					<option value='4' " . ($mylevel_filterlevel == 4?"selected='selected'":"") . ">4</option>
					<option value='5' " . ($mylevel_filterlevel == 5?"selected='selected'":"") . ">5</option>
					<option value='6' " . ($mylevel_filterlevel == 6?"selected='selected'":"") . ">6</option>
					<option value='7' " . ($mylevel_filterlevel == 7?"selected='selected'":"") . ">7</option>
					<option value='8' " . ($mylevel_filterlevel == 8?"selected='selected'":"") . ">8</option>
					<option value='9' " . ($mylevel_filterlevel == 9?"selected='selected'":"") . ">9</option>
					<option value='10' " . ($mylevel_filterlevel == 10?"selected='selected'":"") . ">10</option>
				</select>&nbsp;&nbsp;" . MYLEVEL_A33 . "
				<input type='text' class='tbox' name='lookname' value='" . $tp->toFORM($_POST['lookname']) . "' />
		<input type='submit' class='tbox' name='subname' value='" . MYLEVEL_A34 . "' /></td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='5'>{$mylevel_np}&nbsp;<a href='" . e_SELF . "?$mylevel_from.add'>" . MYLEVEL_A15 . "</a></td>
	</tr>
	<tr>
		<td class='fcaption' colspan='5'>&nbsp;</td>
	</tr>
</table>
</form>";
}
$ns->tablerender(MYLEVEL_A2, $mymenu_text);
require_once(e_ADMIN . "footer.php");

?>