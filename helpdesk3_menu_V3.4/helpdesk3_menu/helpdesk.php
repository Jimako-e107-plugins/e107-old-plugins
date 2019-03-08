<?php
/*
+---------------------------------------------------------------+
|        Helpdesk for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2009
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

if (!is_object($helpdesk_obj))
{
    // check if helpdesk class loaded and running, if not create it.
    require_once(e_PLUGIN . "helpdesk3_menu/includes/helpdesk_class.php");
    $helpdesk_obj = new helpdesk;
}
// Check if the user is allowed to use the helpdesk system.  If not display an error message
// and exit.  helpdesk technicians, supervisors and admin automatically allowed in.
if (!$helpdesk_obj->hdu_read)
{
    // tell them they're not permitted to use the helpdesk
    require_once(HEADERF);
    $hdu_text = HDU_76;
    $helpdesk_obj->tablerender(HDU_21, $hdu_text, 'hdu_not');
    require_once(FOOTERF);
    exit();
}
// for tooltip popup
$eplug_js[] = e_PLUGIN . 'helpdesk3_menu/includes/plain/hdu_pop.js';
$eplug_css[] = e_PLUGIN . 'helpdesk3_menu/includes/plain/hdu_pop.css';
// get the template  from themes, if not then use default
if (is_readable(THEME . "helpdesk_template.php"))
{
    define(HDU_THEME, THEME . "helpdesk_template.php");
}
else
{
    define(HDU_THEME, e_PLUGIN . "helpdesk3_menu/templates/helpdesk_template.php");
}
// get logo from theme, if not see if there is a default, if not then not using logo
if (is_readable(THEME . "helpdesk.png"))
{
    define(HDU_LOGO, THEME . "helpdesk.png");
} elseif (is_readable(e_PLUGIN . "helpdesk3_menu/images/helpdesk.png"))
{
    define(HDU_LOGO, e_PLUGIN . "helpdesk3_menu/images/helpdesk.png");
}
require_once(e_PLUGIN . "helpdesk3_menu/includes/helpdesk_shortcodes.php");
$gen = new convert;
// *
// set show and id to 0
// *
$from = 0;
$id = 0;
// Get passed parameters
// get the filter
session_start();
$R1 = $_SESSION['R1'];
$hdu_goto = $_SESSION['hdu_goto'];
$hdu_savemsg = $_SESSION['hdu_savemsg'];
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $from = intval($_POST['from']);
    $hdu_aaction = $_POST['hdu_aaction'];
    $id = intval($_POST['id']);
    $R1 = $_POST['R1'];
    $hdu_goto = intval($_POST['goto']);
} elseif (e_QUERY)
{
    $tmp = explode('.', e_QUERY);
    $from = intval($tmp[0]);
    $hdu_aaction = $tmp[1];
    $id = intval($tmp[2]);
    // $R1 = $tmp[3];
}
if (intval($hdu_goto) == 0)
{
    $hdu_goto = '';
}
if (empty($R1))
{
    $R1 = 'all';
}
// save the filter
$_SESSION['R1'] = $R1;
$_SESSION['hdu_goto'] = $hdu_goto;
$_SESSION['hdu_savemsg'] = '';
$eplug_js[] = "includes/helpdesk.js";
// $eplug_css = "helpdesk.css";
if (!empty($_POST['hdu_confirm']))
{
    $hdu_aaction = "dodelete";
}
define("PAGE_NAME", HDU_175);
require_once(HEADERF);

switch ($hdu_aaction)
{
    // case "quick":
    // $hdu_action_quick = true;
    // // require_once("show.php");
    // exit();
    // break;
    case "delete":

        if ($helpdesk_obj->hdu_super)
        {
            // if we are a supervisor then we can show the confirm delete page
            $hdu_text = $helpdesk_obj->delete_ticket($id);
            $helpdesk_obj->tablerender($helpdesk_obj->hduprefs_title, $hdu_text);
            require_once(FOOTERF);
            exit();
        }
        else
        {
            $hdu_text = HDU_252;
            $helpdesk_obj->tablerender($helpdesk_obj->hduprefs_title, $hdu_text);
            require_once(FOOTERF);
            exit();
        }
        break;
    case "dodelete":
        // confirmed the delete and we are the supervisor
        if ($helpdesk_obj->hdu_super)
        {
            $sql->db_Delete("hdunit", "hdu_id=$id", false);
            $hdu_savemsg .= HDU_234;
            $hdu_aaction = "list";
        }
        else
        {
            $hdu_text = HDU_252;
            $helpdesk_obj->tablerender($helpdesk_obj->hduprefs_title, $hdu_text);
            require_once(FOOTERF);
            exit();
        }

        break;
    case "newticket":
        if ($helpdesk_obj->hdu_poster)
        {
            $helpdesk_obj->hdu_new = true;
            $hdu_text = $helpdesk_obj->show($id);
            $helpdesk_obj->tablerender($helpdesk_obj->hduprefs_title, $hdu_text);
            require_once(FOOTERF);
            exit();
        }
        else
        {
            $hdu_text = HDU_253;
            $helpdesk_obj->tablerender($helpdesk_obj->hduprefs_title, $hdu_text);
            require_once(FOOTERF);
            exit();
        }
        break;
    case "show":
        if ($helpdesk_obj->hdu_read)
        {
            $helpdesk_obj->hdu_new = false;
            $hdu_text = $helpdesk_obj->show($id);
            $helpdesk_obj->tablerender($helpdesk_obj->hduprefs_title, $hdu_text);
            require_once(FOOTERF);
            exit();
        }
        else
        {
            $hdu_text = HDU_254;
            $helpdesk_obj->tablerender($helpdesk_obj->hduprefs_title, $hdu_text);
            require_once(FOOTERF);
            exit();
        }
        break;
    case "print":
        require_once("printit.php");
        exit();
        break;
    case "updet":
        $hdu_result = $helpdesk_obj->update_ticket($id);
        switch ($hdu_result)
        {
            case -1:
                // error saving
                $hdu_savemsg .= HDU_51 . "<br />";
                break;
            case -2:
                // duplicate record
                $hdu_savemsg .= HDU_51 . " Duplicate record<br />";
                break;
            default:
                $hdu_savemsg .= HDU_50 . " $hdu_result<br />";
        } // switch
        $_SESSION['hdu_savemsg'] = $hdu_savemsg;
        $location = SITEURL . $PLUGINS_DIRECTORY . 'helpdesk3_menu/helpdesk.php';
        header('Location:' . $location);
        break;

    case "assign":
        require_once("assign.php");
        exit();
        break;

    case "repmenu":
        require_once("report.php");
        exit();
        break;

    default:
        break;
}
// *
// Are we deleting the current ticket?
// *
if (isset($_POST['hdu_delrec']))
{
    if (isset($_POST['hdu_delok']))
    {
        if ($hdu_super)
        {
            // only supervisor can delete tickets
            $sql->db_Delete("hdunit", "hdu_id='$id'");
            $sql->db_Delete("hdu_comments", "hduc_ticketid ='$id'");
            $sqlmsg .= HDU_160;
        }
        else
        {
            $sqlmsg .= HDU_124;
        }
    }
    else
    {
        // must confirm
        $sqlmsg .= HDU_161;
    }
    $hdu_aaction = "";
}
$helpdesk_obj->auto_close();
// *
// * Something in the filter
// *
// *
if ($helpdesk_obj->hduprefs_posteronly)
{
    // poster can only see their own tickets
    $filter = "where hdu_posterid ='" . USERID . "' ";
}
if (!$helpdesk_obj->hduprefs_posteronly || $helpdesk_obj->hdu_super || $helpdesk_obj->hdu_technician)
{
    // if tickets visible to all or supervisor or a technician
    $filter = "where hdu_id > 0";
}
// *
// * Filter records
switch ($R1)
{
    case "mine":
        $filter .= " and hdu_posterid=' " . USERID . "'" ;
        break;
    case "open":
        $filter .= " and hdu_closed ='0' ";
        break;
    case "closed":
        $filter .= " and hdu_closed > '0' ";
        break;
    case "allocated":
        $filter .= " and hdu_allocated > '0' and hdu_closed ='0'";
        break;
    case "unallocated":
        $filter .= " and hdu_allocated ='0' and hdu_closed ='0' ";
        break;
    case "escalate":
        $escalatedate = time() - ($helpdesk_obj->hduprefs_escalatedays * 3600 * 24);
        // $hduprefs_escalateon
        // print $helpdesk_obj->hduprefs_escalateon;
        if ($helpdesk_obj->hduprefs_escalateon == 2)
        {
            // escalate on last comment date unless no comment in which case use last activity
            $doiton = "hdu_lastcomment";
            $filter .= " and ((hdu_lastcomment > 0 and hdu_lastcomment < $escalatedate) or (hdu_lastcomment = 0 and hdu_datestamp <$escalatedate)) and hdu_closed = 0 ";
        }
        else
        {
            // escalate on posted date
            $filter .= " and hdu_datestamp < $escalatedate  and hdu_closed = 0 ";
        }
        break;
}

if ($hdu_goto > 0)
{
    $filter = "where hdu_id ='" . $hdu_goto . "' ";
}
$hdu_totalrecs = $sql->db_Count("hdunit", "(*)", $filter, false);
// *
// * Display table with tickets in
// *
$hdu_text .= "
<form method='post' action='" . e_SELF . "' id='viewopt'>
	<div>
		<input type='hidden' name='from' value='$from' />
	</div>";
$hdu_filtselect = "
	<select name ='R1' class ='tbox' onchange='this.form.from.value=0;this.form.submit()'>
		<option value='all'" . ($R1 == "all"?" selected ='selected'":"") . " >" . HDU_187 . "</option>
		<option value='open'" . ($R1 == "open"?" selected ='selected'":"") . " >" . HDU_182 . "</option>
		<option value='closed'" . ($R1 == "closed"?" selected ='selected'":"") . " >" . HDU_183 . "</option>
		<option value='allocated'" . ($R1 == "allocated"?" selected ='selected'":"") . " >" . HDU_184 . "</option>
		<option value='unallocated'" . ($R1 == "unallocated"?" selected ='selected'":"") . " >" . HDU_185 . "</option>
		<option value='escalate'" . ($R1 == "escalate"?" selected ='selected'":"") . " >" . HDU_186 . "</option>";
if (!$helpdesk_obj->hduprefs_posteronly || $helpdesk_obj->hdu_super || $helpdesk_obj->hdu_technician)
{
    $hdu_filtselect .= "<option value='mine'" . ($R1 == "mine"?" selected ='selected'":"") . " >" . HDU_208 . "</option>";
}
$hdu_filtselect .= "</select>";

require(HDU_THEME);
$hdu_text .= $tp->parseTemplate($HDU_LISTTICKETS_HEADER, false, $hdu_shortcodes);
// $hdu_colours = hdu_get_colours();
// print $filter;
if (!$hdu_totalrecs)
{
    $hdu_text .= $tp->parseTemplate($HDU_LISTTICKETS_NOTICKETS, false, $hdu_shortcodes);
}
else
{
    $hdu_args = "
		select hdu_id,hdu_datestamp,hdu_poster,hdu_posterid,hdu_summary,hdu_priority,hducat_category,hdures_resolution,hdudesk_name,hdures_help
			from #hdunit
			left join #hdu_categories on hdu_category =hducat_id
			left join #hdu_resolve on hdu_resolution =hdures_id
			left join #hdu_helpdesk on hdu_tech = hdudesk_id
			$filter ORDER BY hdu_id DESC LIMIT $from, " . $helpdesk_obj->hduprefs_rows ;
    $sql->db_Select_gen($hdu_args, false);
    while ($hdurow = $sql->db_Fetch())
    {
        extract($hdurow);
        // $hdu_postdate = $hdu_datestamp;
        // $hdu_datestamp = $gen->convert_date($hdu_datestamp, "short");
        $hdu_tmp = explode(".", $hdu_poster, 2);
        $post_author_id = $hdu_tmp[0];
        $post_author_name = $hdu_tmp[1];
        if (!empty($post_author_name))
        {
            $poster = $tp->toHTML($post_author_name, false);
        }
        else
        {
            $poster = HDU_170;
        }
        // make sure priority is 5 or less
        $hdu_priority = ($hdu_priority > 5?5:$hdu_priority);
        // calc the escalation period
        if ($helpdesk_obj->hduprefs_escalateon == 2)
        {
            // escalate on last comment date if there are any comments, else last u date
            if ($hdu_lastcomment > 0)
            {
                $hdu_fdat = $hdu_lastcomment;
            }
            else
            {
                $hdu_fdat = $hdu_datestamp;
            }
        }
        else
        {
            // escalate on posted date
            $hdu_fdat = $hdu_datestamp;
        }
        $hdu_datedif = floor(((time() - $hdu_fdat) / (3600 * 24)) / $helpdesk_obj->hduprefs_escalatedays);
        // Get the escalation icon
        // print $helpdesk_obj->hduprefs_escalatedays;
        switch ($hdu_datedif)
        {
            case 0 : $hdu_imgtag = "<img src ='./images/green.gif' alt ='" . HDU_83 . "' title ='" . HDU_83 . "' /> ";
                break;
            case 1 : $hdu_imgtag = "<img src ='./images/yellow.gif' alt ='" . HDU_84 . "' title ='" . HDU_84 . "' /> ";
                break;
            default : $hdu_imgtag = " <img src ='./images/red.gif' alt ='" . HDU_85 . "' title ='" . HDU_85 . "' / > ";
                break;
        }
        if ($hdu_closed > 0) $hdu_imgtag = "<img src ='./images/closed.gif' alt ='" . HDU_86 . "' title ='" . HDU_86 . "' /> ";
        $hdu_text .= $tp->parseTemplate($HDU_LISTTICKETS_DETAIL, false, $hdu_shortcodes);
    }
}
// *
// * Tell user if only their own tickets are displayed
if ($helpdesk_obj->hduprefs_posteronly && !$helpdesk_obj->hdu_super && !$helpdesk_obj->hdu_technician)
{
    $hdu_rights = " - " . HDU_89 . " - " ;
}
if (!$helpdesk_obj->hduprefs_posteronly || $helpdesk_obj->hdu_super || $helpdesk_obj->hdu_technician)
{
    $hdu_rights = " - " . HDU_206 . " - " ;
}

if ($hdu_user)
{
    $hdu_rights .= HDU_203 . " - " ;
}

if ($helpdesk_obj->hdu_technician)
{
    $hdu_rights .= HDU_204 . " - " ;
}
if ($helpdesk_obj->hdu_super)
{
    $hdu_rights .= HDU_205 . " - " ;
}
$hdu_npaction = "list.0." . $R1;

$hdu_npparms = $hdu_totalrecs . "," . $helpdesk_obj->hduprefs_rows . "," . $from . "," . e_SELF . '?' . "[FROM]." . $hdu_npaction;
$hdu_nextprev = $tp->parseTemplate("{NEXTPREV={$hdu_npparms}}");
$hdu_text .= $tp->parseTemplate($HDU_LISTTICKETS_FOOTER, false, $hdu_shortcodes);

$hdu_text .= $helpdesk_obj->display_priority($hdu_colours);
$hdu_text .= "
</form>";
$helpdesk_obj->tablerender($helpdesk_obj->hduprefs_title, $hdu_text, 'hdu_main');
require_once(FOOTERF);
