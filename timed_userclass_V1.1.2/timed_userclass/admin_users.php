<?php
/*
+---------------------------------------------------------------+
|	Timed Userclass Plugin for e107
|
|	Copyright (C) Father Barry Keal 2003 - 2008
|	http://www.keal.me.uk
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
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
require_once(e_HANDLER . "userclass_class.php");
require_once(e_HANDLER . "calendar/calendar_class.php");
$tclasscal = new DHTML_Calendar(true);

if (!is_object($tclass_gen))
{
    $tclass_gen = new convert;
}

require_once(e_ADMIN . "auth.php");
if (!defined("ADMIN_WIDTH"))
{
    define(ADMIN_WIDTH, "width:100%;");
}

if (e_QUERY)
{
    $tclass_tmp = explode(".", e_QUERY);
    $tclass_listfrom = intval($tclass_tmp[0]);
    $tclass_action = $tclass_tmp[1];
    $tclass_uid = intval($tclass_tmp[2]);
}
else
{
    $tclass_listfrom = intval($_POST['tclass_listfrom']);
    $tclass_action = $_POST['tclass_action'];
    $tclass_uid = intval($_POST['tclass_uid']);
}
require_once(e_PLUGIN . "timed_userclass/includes/timed_userclass_class.php");
if (!is_object($tclass_obj))
{
    $tclass_obj = new timed_userclass;
}

include_lan(e_PLUGIN . "timed_userclass/languages/admin/" . e_LANGUAGE . ".php");
// if adding then save or save if saving
if (isset($_POST['tclass_save']))
{
    // save

    $tclass_errorfields = false;
    $tclass_errorname = false;
    $tclass_errordate = false;
    $tclass_error = false;
    $tclass_start_tmp = explode("-", $_POST['tclass_start']);
    #print_a($tclass_start_tmp);
    if (intval($_POST['tclass_from']) == 255 && intval($_POST['tclass_to']) == 255 && intval($_POST['tclass_admin']) == 0)
    {
        $tclass_errorfields = true;
    }
    if ($sql->db_Select("user", "user_id", "where user_name='" . $tp->toDB(trim($_POST['tclass_user'])) . "'", "nowhere", false))
    {
        extract($sql->db_Fetch());
    }
    else
    {
        $tclass_errorname = true;
    }
    switch ($tclass_obj->tclass_dateform)
    {
        case "Y-m-d-H-M":
            $tclass_start = mktime($tclass_start_tmp[3], $tclass_start_tmp[4],0, $tclass_start_tmp[1], $tclass_start_tmp[2], $tclass_start_tmp[0]);

            break;
        case "m-d-Y-H-M":
            $tclass_start = mktime($tclass_start_tmp[3], $tclass_start_tmp[4],0, $tclass_start_tmp[0], $tclass_start_tmp[1], $tclass_start_tmp[2]);

            break;
        default :
            $tclass_start = mktime($tclass_start_tmp[3], $tclass_start_tmp[4],0, $tclass_start_tmp[1], $tclass_start_tmp[0], $tclass_start_tmp[2]);
    }

     if ($tclass_start==0 || ($tclass_end <= $tclass_start && $tclass_start > 0 && $tclass_end > 0) || ($tclass_start < 1 && $tclass_end < 1) || ($tclass_start > 0 && $tclass_start < time()) || ($tclass_end > 0 && $tclass_end < time()))
    {
        $tclass_errordate = true;
    }
    // // check if exact duplicate
    if (intval($tclass_uid) == 0 && $sql->db_Select("tclass", "tclass_id", "where 	tclass_userid='" . intval($user_id) . "' and
     tclass_from='" . intval($_POST['tclass_from']) . "' and
     tclass_to='" . intval($_POST['tclass_to']) . "' and
     tclass_start='" . $tclass_start . "' and
     tclass_admin='" . intval($_POST['tclass_admin']) . "' and
     tclass_notify='" . intval($_POST['tclass_notify']) . "'", "nowhere", false))
    {
        $tclass_msg .= TCLASS_A50;
        $tclass_error = true;
    }
    if (!$tclass_errordate && !$tclass_errorname && !$tclass_errorfields && !$tclass_error)
    {
        if (intval($tclass_uid) == 0)
        {
            // new
            if ($sql->db_Insert("tclass", "

		0,
		'" . intval($user_id) . "',
		'" . intval($_POST['tclass_from']) . "',
		'" . intval($_POST['tclass_to']) . "',
		'" . $tclass_start . "',
		'" . intval($_POST['tclass_admin']) . "',
		'" . intval($_POST['tclass_notify']) . "'," . time() . ",0", false))
            {
                $tclass_msg .= TCLASS_A44;
            }
            else
            {
                $tclass_msg .= TCLASS_A45;
            }
        }
        else
        {
            // existing
            if ($sql->db_Update("tclass", "
		tclass_userid='" . intval($user_id) . "',
		tclass_lastupdate='" . time() . "',
		tclass_from='" . intval($_POST['tclass_from']) . "',
		tclass_to='" . intval($_POST['tclass_to']) . "',
		tclass_start='" . $tclass_start . "',
		tclass_admin='" . intval($_POST['tclass_admin']) . "',
		tclass_donestart='0',
		tclass_notify='" . intval($_POST['tclass_notify']) . "' where tclass_id=$tclass_uid" , false))
            {
                $tclass_msg .= TCLASS_A46;
            }
            else
            {
                $tclass_msg .= TCLASS_A47;
            }
        }
    }
    else
    {
        if ($tclass_errorfields)
        {
            $tclass_msg .= TCLASS_U04 . " ";
        }
        if ($tclass_errorname)
        {
            $tclass_msg .= TCLASS_A48 . " ";
        }
        if ($tclass_errordate)
        {
            $tclass_msg .= TCLASS_A49 . " ";
        }
        $tclass_action = "reedit";
    }
}
if ($tclass_action == "delete")
{
    $sql->db_Delete("tclass", "tclass_id=$tclass_uid", false);
    $tclass_action = "";
}
if (isset($_POST['tclassaddnew']))
{
    $tclass_action = "new";
}
if ($tclass_action == "edit" || $tclass_action == "new" || $tclass_action == "reedit")
{
    if ($tclass_action == "reedit")
    {
        // print_a($_POST);
        $tclass_userid = $_POST['tclass_userid'];
        $user_name = $_POST['tclass_user'];
        $tclass_from = $_POST['tclass_from'];
        $tclass_to = $_POST['tclass_to'];
        $tclass_start = $_POST['tclass_start'];
        $tclass_admin = $_POST['tclass_admin'];
        $tclass_notify = $_POST['tclass_notify'];

        switch ($tclass_obj->tclass_dateform)
        {
            case "Y-m-d-I-M":
                $tclass_start = mktime($tclass_start_tmp[3], $tclass_start_tmp[4], 1, $tclass_start_tmp[1], $tclass_start_tmp[2], $tclass_start_tmp[0]);

                break;
            case "m-d-Y-I-M":
                $tclass_start = mktime($tclass_start_tmp[3], $tclass_start_tmp[4], 1, $tclass_start_tmp[0], $tclass_start_tmp[1], $tclass_start_tmp[2]);

                break;
            default :
                $tclass_start = mktime($tclass_start_tmp[3], $tclass_start_tmp[4], 1, $tclass_start_tmp[1], $tclass_start_tmp[0], $tclass_start_tmp[2]);

        }
    }
    if ($tclass_action == "edit")
    {
        $sql->db_Select_gen("
	select * from #tclass
	left join #user on tclass_userid=user_id
	where tclass_id=$tclass_uid", false);
        extract($sql->db_Fetch());
    }
    require_once(e_HANDLER . "user_select_class.php");
    $us = new user_select;
    $tclass_text .= "
<form method='post' action='" . e_SELF . "' id='tclassform' name='tclassform' >
	<div>
		<input type='hidden' name='tclass_uid' value='$tclass_uid' />
	</div>
	<table class='fborder' style='" . ADMIN_WIDTH . "'>
		<tr>
			<td class='fcaption' colspan='2'>" . TCLASS_A40 . "</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='2'><b>" . $tclass_msg . "</b>&nbsp;</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:30%;' >" . TCLASS_U01 . "</td>
			<td class='forumheader3' ><input type='text' id='tclass_user' name='tclass_user' class='tbox' value='" . $user_name . "' />&nbsp;&nbsp;<img src='".e_IMAGE."/generic/".IMODE."/user_select.png'
			style='width:16px;height:16px;; vertical-align:top;border:0px;' alt='" . TCLASS_A43 . "'
			title='" . TCLASS_A43 . "' onclick=\"window.open('" . e_HANDLER . "user_select_class.php?text.tclass_user','user_search', 'toolbar=no,location=no,status=yes,scrollbars=yes,resizable=yes,width=300,height=200,left=100,top=100'); return false;\" /></td>
		</tr>";
    // calendar options
    $tclasscal_val=($tclass_start > 0?date(str_replace("-H-M","-H-i",$tclass_obj->tclass_dateform), $tclass_start):"");
    $tclass_text .= $tclasscal->load_files();
    $tclasscal_options['firstDay'] = 1;
    $tclasscal_options['showsTime'] = true;
    $tclasscal_options['showOthers'] = false;
    $tclasscal_options['weekNumbers'] = false;
    $tclasscal_df = "%" . str_replace("-", "-%", $tclass_obj->tclass_dateform);
   # print $tclasscal_df;
    $tclasscal_options['ifFormat'] = $tclasscal_df;
    $tclasscal_attrib['class'] = "tbox";
    $tclasscal_attrib['style'] = "width:40%";
    $tclasscal_attrib['name'] = "tclass_start";
    $tclasscal_attrib['value'] = $tclasscal_val;
    $tclasssinput = $tclasscal->make_input_field($tclasscal_options, $tclasscal_attrib);
    $tclass_text .= "
		<tr>
			<td class='forumheader3' >" . TCLASS_U02 . "</td>
			<td class='forumheader3' >$tclasssinput</td>
		</tr>
		<tr>
			<td class='forumheader3' >" . TCLASS_U03 . "</td>
			<td class='forumheader3' >" . r_userclass("tclass_from", $tclass_from, "off", "nobody,classes") . "</td>
		</tr>
		<tr>
			<td class='forumheader3' >" . TCLASS_U05 . "</td>
			<td class='forumheader3' >" . r_userclass("tclass_to", $tclass_to, "off", "nobody,classes") . "</td>
		</tr>
		<tr>
			<td class='forumheader3' >" . TCLASS_U06 . "</td>
			<td class='forumheader3' >
				<select name='tclass_notify' class='tbox' >
					<option value='0' " . ($tclass_notify == 0?"selected='selected'":"") . ">" . TCLASS_A8 . "</option>
					<option value='1' " . ($tclass_notify == 1?"selected='selected'":"") . ">" . TCLASS_A26 . "</option>
					<option value='2' " . ($tclass_notify == 2?"selected='selected'":"") . ">" . TCLASS_A27 . "</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class='forumheader3' >" . TCLASS_A38 . "</td>
			<td class='forumheader3' ><input type='checkbox' class='tbox' name='tclass_admin' value='1' " . ($tclass_admin == 1?"checked='checked'":"") . " /></td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='2' style='text-align: left;'>
				<input type='submit' name='tclass_save' value='" . TCLASS_U07 . "' class='button' />
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='2' style='text-align: left;'>&nbsp;</td>
		</tr>
	</table>
</form>";
}
if ($tclass_action == "")
{
    $tclass_text .= "
<form method='post' action='" . e_SELF . "' id='tclass'>
	<table class='fborder' style='" . ADMIN_WIDTH . "'>
	<tr>
		<td class='forumheader' colspan='7'>" . TCLASS_A1 . "</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='7'><b>" . $tclass_msg . "</b>&nbsp;</td>
	</tr>
	<tr>
		<td style='width:20%' class='forumheader2'><strong>" . TCLASS_A3 . "</strong></td>
		<td style='width:19%' class='forumheader2'><strong>" . TCLASS_A6 . "</strong></td>
		<td style='width:17%' class='forumheader2'><strong>" . TCLASS_A4 . "</strong></td>
		<td style='width:17%' class='forumheader2'><strong>" . TCLASS_A5 . "</strong></td>
		<td style='width:8%' class='forumheader2'><strong>" . TCLASS_A51 . "</strong></td>
		<td style='width:8%' class='forumheader2'><strong>" . TCLASS_A2 . "</strong></td>
		<td style='text-align:center;' class='forumheader2'><strong>" . TCLASS_A39 . "</strong></td>
	</tr>";
    // Get the existing records
    if ($sql2->db_Select_gen("
select a.*,u.user_name as uname,t.userclass_name as class_to, f.userclass_name as class_from from #tclass as a
left join #user as u on tclass_userid = u.user_id
left join #userclass_classes as f on tclass_from = f.userclass_id
left join #userclass_classes as t on tclass_to = t.userclass_id
order by tclass_start,user_name asc
limit $tclass_listfrom,25
", false))
    {
        $tclass_notification = array(TCLASS_A8, TCLASS_A26, TCLASS_A27);
        while ($tclass_row = $sql2->db_Fetch())
        {
            extract($tclass_row);
            $tclass_text .= "
		<tr>
			<td class='forumheader3' >" . (empty($uname) || is_null($uname)?TCLASS_A42:$tp->toHTML($uname)) . "	</td>
			<td class='forumheader3' ><img src='images/" . ($tclass_donestart == 1?"green":"red") . ".png' /> &nbsp;" . ($tclass_start > 0?date(str_replace("-H-M"," H:i",$tclass_obj->tclass_dateform), $tclass_start):"") . "</td>
			<td class='forumheader3' >" . $tp->toHTML($class_from) . "</td>
			<td class='forumheader3' >" . $tp->toHTML($class_to) . "</td>

			<td class='forumheader3' >" . ($tclass_admin == 1?TCLASS_A52:"") . "</td>
			<td class='forumheader3' >" . $tclass_notification[$tclass_notify] . "</td>
			<td class='forumheader3' style='text-align:center;' >
				<a href='" . e_SELF . "?$tclass_listfrom.edit.$tclass_id' ><img src='" . e_IMAGE . "admin_images/edit_16.png' /></a>&nbsp;
				<a href='" . e_SELF . "?$tclass_listfrom.delete.$tclass_id' onclick=\"return jsconfirm('" . TCLASS_U08 . " " . $tclass_id . "')\"><img src='" . e_IMAGE . "admin_images/delete_16.png' /></a>
			</td>
		</tr>";
        }
        // } // while
    }
    else
    {
        $tclass_text .= "
		<tr>
			<td class='forumheader3' colspan='7' style='text-align: left;'>" . TCLASS_A14 . "</td>
		</tr>";
    }
    // Submit
    $tclass_text .= "
		<tr>
			<td class='forumheader2' colspan='7' style='text-align: left;'>
				<a href='" . e_SELF . "?$tclass_listfrom.new.0' />" . TCLASS_A11 . "</a>
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='7' style='text-align: left;'>&nbsp;</td>
		</tr>
	</table>
</form>";
}
$ns->tablerender(TCLASS_A1, $tclass_text);
require_once(e_ADMIN . "footer.php");

?>