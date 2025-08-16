<?php
/*
+---------------------------------------------------------------+
|        Page Ear v1.1 - by Barry
|
|        v1.1
|
|        This module for the e107 .7+ website system
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

require_once("../../class2.php");
if (!getperms("P"))
{
    header("location:" . e_HTTP . "index.php");
    exit;
}
if (!defined('e107_INIT'))
{
    exit;
}
require_once(e_HANDLER . "date_handler.php");
$pageear_conv=new convert;
require_once(e_HANDLER . "calendar/calendar_class.php");
$pageear_cal = new DHTML_Calendar(true);
$pageear_text .= $pageear_cal->load_files();
require_once(e_ADMIN . "auth.php");
if (!defined("ADMIN_WIDTH"))
{
    define(ADMIN_WIDTH, "width:100%");
}
require_once(e_HANDLER . "userclass_class.php");
include_lan(e_PLUGIN . "pageear/languages/admin/" . e_LANGUAGE . ".php");
if (e_QUERY)
{
    $pageear_tmp = explode(".", e_QUERY);
    $pageear_from = intval($pageear_tmp[0]);
    $pageear_action = $pageear_tmp[1];
    $pageear_clickthru_id = intval($pageear_tmp[2]);
} elseif (isset($_POST['update']))
{
    $pageear_from = intval($_POST['pageear_from']);
    $pageear_action = $_POST['pageear_action'];
    $pageear_clickthru_id = intval($_POST['pageear_clickthru_id']);
}
if (isset($_POST['nodelete']))
{
    $pageear_action = "";
}
if (isset($_POST['godelete']))
{
    $pageear_action = "dodelete";
    $pageear_clickthru_id = intval($_POST['pageear_clickthru_id']);
}
if (isset($_POST['update']))
{
    $pageear_tmp = explode("-", $_POST['pageear_clickthru_purchasedate']);
    switch ($pref['pageear_dateform'])
    {
        case "Y-m-d":
            $pageear_clickthru_purchasedate = mktime(0, 0, 1, $pageear_tmp[1], $pageear_tmp[2], $pageear_tmp[0]);
            break;
        case "m-d-Y":
            $pageear_clickthru_purchasedate = mktime(0, 0, 1, $pageear_tmp[0], $pageear_tmp[1], $pageear_tmp[2]);
            break;
        default :
            $pageear_clickthru_purchasedate = mktime(0, 0, 1, $pageear_tmp[1], $pageear_tmp[0], $pageear_tmp[2]);
    }
        $pageear_tmp = explode("-", $_POST['pageear_clickthru_expires']);
    switch ($pref['pageear_dateform'])
    {
        case "Y-m-d":
            $pageear_clickthru_expires = mktime(0, 0, 1, $pageear_tmp[1], $pageear_tmp[2], $pageear_tmp[0]);
            break;
        case "m-d-Y":
            $pageear_clickthru_expires = mktime(0, 0, 1, $pageear_tmp[0], $pageear_tmp[1], $pageear_tmp[2]);
            break;
        default :
            $pageear_clickthru_expires = mktime(0, 0, 1, $pageear_tmp[1], $pageear_tmp[0], $pageear_tmp[2]);
    }
    // Update rest
    if ($pageear_clickthru_id == 0)
    {
        $sql->db_Insert("pageear_clickthru", "
	0,
	'" . $tp->toDB($_POST['pageear_clickthru_name']) . "',
	'" . $tp->toDB($_POST['pageear_clickthru_large']) . "',
	'" . $tp->toDB($_POST['pageear_clickthru_small']) . "',
	'" . $tp->toDB($_POST['pageear_clickthru_client']) . "',
	'" . intval($_POST['pageear_clickthru_active']) . "',
	'" . intval($_POST['pageear_clickthru_shows']) . "',
	'" . intval($_POST['pageear_clickthru_clicks']) . "',
	'" . intval($_POST['pageear_clickthru_purchased']) . "',
	'" . $pageear_clickthru_purchasedate . "',
	'" . $pageear_clickthru_expires . "',
	'" . $tp->toDB($_POST['pageear_clickthru_link']) . "',''", false);
    }
    else
    {
        $sql->db_Update("pageear_clickthru", "
	pageear_clickthru_name='" . $tp->toDB($_POST['pageear_clickthru_name']) . "',
	pageear_clickthru_large='" . $tp->toDB($_POST['pageear_clickthru_large']) . "',
	pageear_clickthru_small='" . $tp->toDB($_POST['pageear_clickthru_small']) . "',
	pageear_clickthru_client='" . $tp->toDB($_POST['pageear_clickthru_client']) . "',
	pageear_clickthru_active='" . intval($_POST['pageear_clickthru_active']) . "',
	pageear_clickthru_shows='" . intval($_POST['pageear_clickthru_shows']) . "',
	pageear_clickthru_clicks='" . intval($_POST['pageear_clickthru_clicks']) . "',
	pageear_clickthru_purchased='" . intval($_POST['pageear_clickthru_purchased']) . "',
	pageear_clickthru_purchasedate='" . $pageear_clickthru_purchasedate . "',
	pageear_clickthru_expires='" . $pageear_clickthru_expires . "',
	pageear_clickthru_link='" . $tp->toDB($_POST['pageear_clickthru_link']) . "'
	where pageear_clickthru_id = $pageear_clickthru_id", false);
    }

    $pageear_msgtext = "<tr><td class='forumheader3' colspan='2'><strong>" . PAGEEAR_A2 . "</strong></td></tr>";
}
if ($pageear_action == "delete")
{
    $sql->db_Select("pageear_clickthru", "*", "where pageear_clickthru_id=$pageear_clickthru_id", "nowhere", false);
    extract($sql->db_Fetch());
    $pageear_text .= "

<form method='post' action='" . e_SELF . "' id='pageearform'>
	<div>
		<input type='hidden' name='pageear_clickthru_id' value='$pageear_clickthru_id' />
	</div>

	<table class='fborder' style='".ADMIN_WIDTH."'>
		<tr>
			<td class='fcaption' ><strong>" . PAGEEAR_A45 . "</strong></td>
		</tr>
		<tr>
			<td class='forumheader3' style='text-align:center;'>" . PAGEEAR_A46 . "<br /><br />
			<strong>" . $tp->toHTML($pageear_clickthru_name) . "</strong><br /><br />
			<input type='submit' class='button' name='godelete' value='" . PAGEEAR_A47 . "' />&nbsp;&nbsp;
			<input type='submit' class='button' name='nodelete' value='" . PAGEEAR_A48 . "' />
			</td>
		</tr>
		<tr>
			<td class='fcaption' >&nbsp;</td>
		</tr>
	</table>
</form>";
}

if ($pageear_action == "dodelete")
{
    $sql->db_Delete("pageear_clickthru", "pageear_clickthru_id=$pageear_clickthru_id", false);
    $pageear_action = "";
}
if ($pageear_action == "")
{
    $pageear_text .= "
	<table class='fborder' style='".ADMIN_WIDTH."'>
		<tr>
			<td class='fcaption' colspan='9'><strong>" . PAGEEAR_A45 . "</strong></td>
		</tr>
$pageear_msgtext
		<tr>
			<td style='width:15%;text-align:left' class='forumheader2'>" . PAGEEAR_A24 . "</td>
			<td style='width:15%;text-align:left' class='forumheader2'>" . PAGEEAR_A25 . "</td>
			<td style='width:8%;text-align:center' class='forumheader2'>" . PAGEEAR_A26 . "</td>
			<td style='width:8%;text-align:right' class='forumheader2'>" . PAGEEAR_A28 . "</td>
			<td style='width:8%;text-align:right' class='forumheader2'>" . PAGEEAR_A27 . "</td>
			<td style='width:8%;text-align:right' class='forumheader2'>" . PAGEEAR_A29 . "</td>
			<td style='width:8%;text-align:right' class='forumheader2'>" . PAGEEAR_A40 . "</td>
			<td style='width:18%;text-align:left' class='forumheader2'>" . PAGEEAR_A31 . "</td>
			<td style='width:10%;text-align:center' class='forumheader2'  >" . PAGEEAR_A33 . "</td>

		</tr>
";
    if ($sql->db_Select("pageear_clickthru", "*", "order by pageear_clickthru_name", "nowhere", false))
    {
        while ($pageear_row = $sql->db_Fetch())
        {
            extract($pageear_row);
            $pageear_clickrate=($pageear_clickthru_clicks/$pageear_clickthru_shows)*100;
            $pageear_text .= "
		<tr>
			<td style='width:15%;text-align:left' class='forumheader3'>" . $tp->toHTML($pageear_clickthru_name) . "</td>
			<td style='width:15%;text-align:left' class='forumheader3'>" . $tp->toHTML($pageear_clickthru_client) . "</td>
			<td style='width:8%;text-align:center' class='forumheader3'>" . ($pageear_clickthru_active == 1?"<img src='./images/active.png' alt='active' />":"<img src='./images/inactive.png' alt='inactive' />") . "</td>
			<td style='width:8%;text-align:right' class='forumheader3'>" . $tp->toHTML($pageear_clickthru_purchased) . "</td>
			<td style='width:8%;text-align:right' class='forumheader3'>" . $tp->toHTML($pageear_clickthru_shows) . "</td>
			<td style='width:8%;text-align:right' class='forumheader3'>" . $tp->toHTML($pageear_clickthru_clicks) . "</td>
			<td style='width:8%;text-align:right' class='forumheader3'>" . number_format($pageear_clickrate,2 ) . "%</td>
			<td style='width:18%;text-align:left' class='forumheader3'>" .($pageear_clickthru_expires>0?date($pref['pageear_dateform'],$pageear_clickthru_expires):"") . "</td>
			<td style='width:10%;text-align:center' class='forumheader3'  >
				<a href='" . e_SELF . "?0.edit.$pageear_clickthru_id' ><img src='" . e_IMAGE . "admin_images/edit_16.png' style='border0px;' title='" . PAGEEAR_A43 . "' alt='" . PAGEEAR_A43 . "' /></a>&nbsp;&nbsp;
				<a href='" . e_SELF . "?0.delete.$pageear_clickthru_id' ><img src='" . e_IMAGE . "admin_images/delete_16.png' style='border0px;' title='" . PAGEEAR_A44 . "' alt='" . PAGEEAR_A44 . "' /></a>
			</td>
		</tr>";
        }
    }
    else
    {
        $pageear_text .= "
		<tr>
			<td class='forumheader3' colspan='9'><strong>" . PAGEEAR_A32 . "</strong></td>
		</tr>";
    }
    $pageear_text .= "
		<tr>
			<td class='fcaption' colspan='9'><a href='" . e_SELF . "?0.add' />" . PAGEEAR_A34 . "</a></td>
		</tr>
	</table>";
}
if ($pageear_action == "delete")
{
}
if ($pageear_action == "add" || $pageear_action == "edit")
{
    if ($pageear_action == "edit")
    {
        $sql->db_Select("pageear_clickthru", "*", "where pageear_clickthru_id=$pageear_clickthru_id", "nowhere", false);
        extract($sql->db_Fetch());
    }
    require_once(e_HANDLER . "file_class.php");
    $pageear_fl = new e_file;
    $pageear_list_large = $pageear_fl->get_files(e_PLUGIN . "pageear/large/", '');
    $pageear_list_small = $pageear_fl->get_files(e_PLUGIN . "pageear/small/", '');
    $pageear_text .= "
<form method='post' action='" . e_SELF . "' id='pageearform'>
	<div>
		<input type='hidden' name='pageear_clickthru_id' value='$pageear_clickthru_id' />
	</div>
	<table class='fborder' style='".ADMIN_WIDTH."'>
		<tr>
			<td class='fcaption' colspan='2'><strong>" . PAGEEAR_A45 . "</strong></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . PAGEEAR_A35 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input class='tbox' type='text' id='pageear_clickthru_name' name='pageear_clickthru_name' style='width:60%' value='" . $tp->toFORM($pageear_clickthru_name) . "' maxlength='50' />
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . PAGEEAR_A36 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input class='tbox' type='text' id='pageear_clickthru_client' name='pageear_clickthru_client' style='width:60%' value='" . $tp->toFORM($pageear_clickthru_client) . "' maxlength='50' />
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . PAGEEAR_A42 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input class='tbox' type='checkbox'  style='border:0;' name='pageear_clickthru_active' value='1' " . ($pageear_clickthru_active == 1?"checked=checked'":"") . "' />
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . PAGEEAR_A37 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input class='tbox' type='text' id='pageear_clickthru_shows' name='pageear_clickthru_shows' style='width:20%' value='" . $tp->toFORM($pageear_clickthru_shows) . "' maxlength='10' />
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . PAGEEAR_A38 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input class='tbox' type='text' id='pageear_clickthru_purchased' name='pageear_clickthru_purchased' style='width:20%' value='" . $tp->toFORM($pageear_clickthru_purchased) . "' maxlength='10' />
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . PAGEEAR_A39 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input class='tbox' type='text' id='pageear_clickthru_clicks' name='pageear_clickthru_clicks' style='width:20%' value='" . $tp->toFORM($pageear_clickthru_clicks) . "' maxlength='10' />
			</td>
		</tr>";
        // calendar options
        $pageear_cal_options['firstDay'] = 1;
        $pageear_cal_options['showsTime'] = false;
        $pageear_cal_options['showOthers'] = false;
        $pageear_cal_options['weekNumbers'] = false;
        $pageear_cal_df = "%" . str_replace("-", "-%", $pref['pageear_dateform']);
        $pageear_cal_options['ifFormat'] = $pageear_cal_df;
        $pageear_cal_attrib['class'] = "tbox";
        $pageear_cal_attrib['name'] = "pageear_clickthru_purchasedate";
        $pageear_cal_attrib['value'] = ($pageear_clickthru_purchasedate > 0?date($pref['pageear_dateform'], $pageear_clickthru_purchasedate):"");
        $pageear_desc = $pageear_cal->make_input_field($pageear_cal_options, $pageear_cal_attrib);
        $pageear_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;vertical-align:top;'>" . PAGEEAR_A50 . "</td>
			<td class='forumheader3' style='width:70%;vertical-align:top;'>
				$pageear_desc
			</td>
		</tr>";
        // calendar options

        $pageear_cal_options['firstDay'] = 1;
        $pageear_cal_options['showsTime'] = false;
        $pageear_cal_options['showOthers'] = false;
        $pageear_cal_options['weekNumbers'] = false;
        $pageear_cal_df = "%" . str_replace("-", "-%", $pref['pageear_dateform']);
        $pageear_cal_options['ifFormat'] = $pageear_cal_df;
        $pageear_cal_attrib['class'] = "tbox";
        $pageear_cal_attrib['name'] = "pageear_clickthru_expires";
        $pageear_cal_attrib['value'] = ($pageear_clickthru_expires > 0?date($pref['pageear_dateform'], $pageear_clickthru_expires):"");
        $pageear_desc = $pageear_cal->make_input_field($pageear_cal_options, $pageear_cal_attrib);
        $pageear_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;vertical-align:top;'>" . PAGEEAR_A51 . "</td>
			<td class='forumheader3' style='width:70%;vertical-align:top;'>
				$pageear_desc
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . PAGEEAR_A7 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input class='tbox' type='text'  size='80%' name='pageear_clickthru_link' value='" . $tp->toFORM($pageear_clickthru_link) . "' />
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . PAGEEAR_A4 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input class='tbox' type='text' id='pageear_large' name='pageear_clickthru_large' size='60' value='" . $tp->toFORM($pageear_clickthru_large) . "' maxlength='100' /><br />";
    foreach($pageear_list_large as $pageear_large)
    {
        $pageear_text .= "<a href=\"javascript:insertext('" . $pageear_large['fname'] . "','pageear_large','newsicn')\"><img src='" . $pageear_large['path'] . $pageear_large['fname'] . "' style='border:0;height:100px;width:100px;' alt='' /></a> ";
    }

    $pageear_text .= "
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . PAGEEAR_A5 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input class='tbox' type='text' id='pageear_small' name='pageear_clickthru_small' size='60' value='" . $tp->toFORM($pageear_clickthru_small) . "' maxlength='100' /><br />";
    foreach($pageear_list_small as $pageear_small)
    {
        $pageear_text .= "<a href=\"javascript:insertext('" . $pageear_small['fname'] . "','pageear_small','newsicn')\"><img src='" . $pageear_small['path'] . $pageear_small['fname'] . "' style='border:0;height:100px;width:100px;' alt='' /></a> ";
    }

    $pageear_text .= "
			</td>
		</tr>";
    $pageear_text .= "
		<tr>
			<td colspan='2' class='fcaption' style='text-align: left;'>
				<input type='submit' name='update' value='" . PAGEEAR_A17 . "' class='button' />
			</td>
		</tr>
	</table>
</form>";
}
$ns->tablerender(PAGEEAR_A1, $pageear_text);
require_once(e_ADMIN . "footer.php");
