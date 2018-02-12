<?php
/*
+---------------------------------------------------------------+
|        Prune Inactive Users for e107 v7xx - by Father Barry
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
if (!ADMIN)
{
    print "You must be an admin";
    exit;
}
// ***********************************************************
// Get the necessary requires
// ***********************************************************
require_once(e_ADMIN . "auth.php");
require_once(e_HANDLER . "mail.php");
include_lan(e_PLUGIN . "prune_users/languages/admin/" . e_LANGUAGE . ".php");
require_once(e_HANDLER . "userclass_class.php");
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, "width:100%;");
}
if (e_QUERY)
{
    $prune_tmp = explode('.' , e_QUERY);
    $prune_from = intval($prune_tmp[0]);
    $prune_action = $prune_tmp[1];
} elseif (isset($_POST['prune_action']))
{
    $prune_from = intval($_POST['prune_from']);
    $prune_action = $_POST['prune_action'];
}
else
{
    $prune_from = 0;
    $prune_action = 'show';
}

$prune_time = time() + ($pref['time_offset'] * 3600);
// Find out when midnight was
$prune_today = mktime(0, 0, 0, date('n', $prune_time), date('d', $prune_time), date('Y', $prune_time));
$prune_joinbefore = ($pref['prune_days'] * 86400) + $prune_today;
// ***********************************************************
// Get the language file
// ***********************************************************
include_lan(e_PLUGIN . "prune_users/languages/admin/" . e_LANGUAGE . ".php");
// $_REQUEST['prune_action'] is what we are going to do
// $_REQUEST['prune_record'] is the records we are goint to work on
// ***********************************************************
// Create necessary objects
// ***********************************************************
$prune_convert = new convert;
$prune_obj = new e_userclass;
// ***********************************************************
// Do the appropriate actions
// ***********************************************************
if ($prune_action == "prune_dodel")
{
    // ***********************************************************
    // Do the deletion or emailing
    // ***********************************************************
    $prune_text .= "
<table class='fborder' style='" . ADMIN_WIDTH . "'>
	<tr>
		<td class='fcaption' colspan='2'>" . PRUNE_A1 . "</td>
	</tr>";
    $prune_class = intval($pref['prune_class']);
    if (isset($_REQUEST['prune_record']))
    {
        switch ($pref['prune_type'])
        {
            case 0:
                $prune_message = PRUNE_AMESSAGEL1 . "\n\n" . PRUNE_AMESSAGEL2 . "\n\n" . PRUNE_AMESSAGEL3;
                break;
            case 1:
                $prune_message = PRUNE_AMESSAGEF1 . "\n\n" . PRUNE_AMESSAGEF2 . "\n\n" . PRUNE_AMESSAGEF3;
                break;
            case 2:
                $prune_message = PRUNE_AMESSAGEFP1 . "\n\n" . PRUNE_AMESSAGEFP2 . "\n\n" . PRUNE_AMESSAGEFP3;
                break;
            case 3:
                $prune_message = PRUNE_AMESSAGECB1 . "\n\n" . PRUNE_AMESSAGECB2 . "\n\n" . PRUNE_AMESSAGECB3;
                break;
            case 4:
                $prune_message = PRUNE_AMESSAGEC1 . "\n\n" . PRUNE_AMESSAGEC2 . "\n\n" . PRUNE_AMESSAGEC3;
                break;
            case 5:
                $prune_message = PRUNE_AMESSAGEV1 . "\n\n" . PRUNE_AMESSAGEV2 . "\n\n" . PRUNE_AMESSAGEV3;
                break;
        }
        // ***********************************************************
        // If there are users selected then process each one
        // ***********************************************************
        foreach($_REQUEST['prune_record'] as $prune_array)
        {
            if ($prune_array > 0)
            {
                // ***********************************************************
                // the id is greater than 1 then do it
                // it cant be 0 or 1 (1 is normally main site admin)
                // ***********************************************************
                $sql->db_Select("user", "user_name,user_email, user_admin,user_class", "where user_id='$prune_array'", "nowhere", false);
                $prune_row = $sql->db_Fetch();
                $prune_user = $prune_array;
                extract($prune_row);
                if ($user_admin <> 1)
                {
                    // ***********************************************************
                    // Don't delete if user has admin status
                    // ***********************************************************
                    switch ($pref['prune_action'])
                    {
                        case 1:
                            // ***********************************************************
                            // We are deleting the users
                            // ***********************************************************
                            if ($sql->db_Delete("user", "user_id='$prune_user'"))
                            {
                                // Successful deletion
                                if ($pref['prune_notify'] == 0)
                                {
                                    $prune_emsg = PRUNE_Preamble . ' ' . $user_name . "\n\n" . PRUNE_AMESSAGED1 . "\n\n" . PRUNE_AMESSAGED2 . "\n\n" . PRUNE_AMESSAGED3;
                                    sendemail($user_email, PRUNE_ASUBJECT, $prune_emsg, $user_name, $pref['siteadminemail'], $pref['siteadmin']);
                                }
                                $prune_text .= "
	<tr>
		<td class='forumheader3' style='width:30%;'>$user_name</td><td class='forumheader3' style='width:60%;'>" . PRUNE_A8 . "</td>
	</tr>";
                            }
                            else
                            {
                                // failed to delete
                                $prune_text .= "
	<tr>
		<td class='forumheader3' style='width:30%;'>$user_name</td><td class='forumheader3' style='width:60%;'>" . PRUNE_A7 . "</td>
	</tr>";
                            } ;
                            break;
                        case 2:
                            // ***********************************************************
                            // We are Removing from class
                            // ***********************************************************
                            // Get the class list for this user
                            $prune_uclass = $sql->db_Select("user", "user_class", "where user_id=$prune_user", "nowhere", false);
                            $prune_urow = $sql->db_Fetch();
                            // explode it
                            $prune_classlist = explode(",", $prune_urow['user_class']);
                            // check each element to see if it needs removing
                            foreach($prune_classlist as $prune_key => $prune_item)
                            {
                                if ($prune_item == $prune_class || is_null($prune_item) || empty($prune_item))
                                {
                                    unset($prune_classlist[$prune_key]);
                                }
                            }
                            // make a new array
                            $prune_newlist = array_values($prune_classlist);
                            $prune_tmparray = array_unique($prune_newlist);
                            // implode it
                            $prune_newarray = implode(",", $prune_tmparray);
                            // write it back
                            $prune_uclass = $sql->db_Update("user", "user_class='$prune_newarray' where user_id=$prune_user", false);
                            if ($pref['prune_notify'] == 0)
                            {
                                $prune_emsg = PRUNE_Preamble . ' ' . $user_name . "\n\n" . PRUNE_AMESSAGEDM1 . "\n\n" . PRUNE_AMESSAGEDM2 . "\n\n" . PRUNE_AMESSAGEDM3;
                                sendemail($user_email, PRUNE_ASUBJECT, $prune_emsg, $user_name, $pref['siteadminemail'], $pref['siteadmin']);
                            }
                            $prune_text .= "
	<tr>
		<td class='forumheader3' style='width:30%;'>$user_name</td><td class='forumheader3' style='width:60%;'>" . PRUNE_A48 . "</td>
	</tr>";

                            break;
                        default:
                            // ***********************************************************
                            // We are emailing the users
                            // ***********************************************************
                            $prune_emsg = PRUNE_Preamble . ' ' . $user_name . "\n\n" . $prune_message;

                            if (sendemail($user_email, PRUNE_ASUBJECT, $prune_emsg, $user_name, $pref['siteadminemail'], $pref['siteadmin']))
                            {
                                // Sent email OK
                                $prune_text .= "
	<tr>
		<td class='forumheader3' style='width:30%;'>$user_name</td><td class='forumheader3' style='width:60%;'>" . PRUNE_A28 . "</td>
	</tr>";
                            }
                            else
                            {
                                // email sending failed
                                $prune_text .= "
	<tr>
		<td class='forumheader3' style='width:30%;'>$user_name</td><td class='forumheader3' style='width:60%;'>" . PRUNE_A29 . "</td>
	</tr>";
                            } ;
                    } // switch
                }
                else
                {
                    $prune_text .= "
	<tr>
		<td class='forumheader3' style='width:30%;'>$user_name</td><td class='forumheader3' style='width:60%;'>" . PRUNE_A35 . "</td>
	</tr>";
                }
            }
        }
    }
    else
    {
        $prune_text .= "
	<tr>
		<td class='forumheader3' colspan='2'>" . PRUNE_A15 . "</td>
	</tr>";
    }
    $prune_text .= "
	<tr>
		<td class='fcaption' colspan='2'>
			<a href='" . e_SELF . "'>" . PRUNE_A10 . "</a>
		</td>
	</tr>
</table>";
}
if ($prune_action == 'show')
{
    // ***********************************************************
    // No action specified so we start from scratch
    // ***********************************************************
    $prune_lastvisit = $pref['prune_days'];
    $prune_fromdate = $prune_today - ($pref['prune_threshold'] * 86400);
    $prune_text .= "
<table class='fborder' style='" . ADMIN_WIDTH . "'>
	<tr>
		<td class='fcaption' colspan='2'>" . PRUNE_A1 . "<input type='hidden' value='prune_docheck' name='prune_action' /></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:40%;'>" . PRUNE_A66 . "</td>
		<td class='forumheader3' style='width:60%;'><b>" . ($pref['prune_joinbefore'] > 0 ?date('Y-m-d', $pref['prune_joinbefore']):'&nbsp;') . "</b></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:40%;'>" . PRUNE_A39 . "</td>
		<td class='forumheader3' style='width:60%;'><b>" . ($pref['prune_days'] > 0?date('Y-m-d', $prune_lastvisit):"{$pref['prune_days']}&nbsp;") . "</b></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:40%;'>" . PRUNE_A67 . "</td>
		<td class='forumheader3' style='width:60%;'><b>" . ($pref['prune_exadmin'] == 1?PRUNE_A69:PRUNE_A68) . "</b></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:40%;'>" . PRUNE_A40 . "</td>
		<td class='forumheader3' style='width:60%;'><b>" ;
    switch ($pref['prune_type'])
    {
        case 0:
            $prunon_name = PRUNE_A17;
            break;
        case 1:
            $prunon_name = PRUNE_A18;
            break;
        case 2:
            $prunon_name = PRUNE_A52;
            break;
        case 3:
            $prunon_name = PRUNE_A53;
            break;
        case 4:
            $prunon_name = PRUNE_A54;
            break;
        case 5:
            $prunon_name = PRUNE_A61;
            break;
        case 6:
            $prunon_name = PRUNE_A71;
            break;
    }
    $prune_text .= $prunon_name . "</b></td>
	</tr>
		<tr>
		<td class='forumheader3' style='width:40%;'>" . PRUNE_A55 . "</td>
		<td class='forumheader3' style='width:60%;'><b>" . $pref['prune_threshold'] . "</b></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:40%;'>" . PRUNE_A41 . "</td>
		<td class='forumheader3' style='width:60%;'><b>";
    switch ($pref['prune_action'])
    {
        case 1:
            $prune_text .= PRUNE_A43;
            break;
        case 2:
            $prune_text .= PRUNE_A47 . " <b>" . r_userclass_name($pref['prune_class']) . "</b>";
            break;
        default:
            $prune_text .= PRUNE_A42;
    }
    $prune_text .= "</b>
		</td>
	</tr>
</table>";
    // ***********************************************************
    // Display the list of selected records so that you can pick which ones to do
    // ***********************************************************
    $prune_where = "where user_id>0 ";
    if ($pref['prune_class'] != 255)
    {
        $prune_where .= " and find_in_set('" . $pref['prune_class'] . "',user_class) ";
    }
    if ($pref['prune_exadmin'] == 1)
    {
        $prune_where .= " and user_admin !=1 ";
    }
    if ($pref['prune_joinbefore'] > 0)
    {
        $prune_where .= " and user_join < {$pref['prune_joinbefore']}";
    }
    if ($pref['prune_days'] > 0)
    {
        $prune_where .= " and user_currentvisit < {$prune_lastvisit}";
    }
    switch ($pref['prune_type'])
    {
        case 0:
            // Last Login date
            $prune_where .= " ";
            $prune_count = $sql->db_Count('user', '(*)', "$prune_where " , false);
            $prune_sql = "select * from #user as u
			$prune_where order by user_currentvisit limit $prune_from,{$pref['prune_perpage']}";
            break;
        case 1:
            // last forum post
            $prune_where .= " and (user_lastpost =0 or user_lastpost < {$prune_fromdate} )";
            $prune_count = $sql->db_Count('user', '(*)', "$prune_where " , false);
            $prune_sql = "select * from #user as u
			$prune_where order by user_lastpost limit $prune_from,{$pref['prune_perpage']}";
            break;
        case 2:
            // Minimum forum posts
            $prune_where .= " and user_forums < " . $pref['prune_threshold'];
            $prune_count = $sql->db_Count('user', '(*)', "$prune_where" , false);
            $prune_sql = "select * from #user as u
			$prune_where order by user_forums asc limit $prune_from,{$pref['prune_perpage']}";
            break;
        case 3:
            // Minimum chatbox
            $prune_where .= " and user_chats < " . $pref['prune_threshold'];
            $prune_count = $sql->db_Count('user', '(*)', "$prune_where" , false);
            $prune_sql = "select * from #user as u
			$prune_where order by user_chats asc limit $prune_from,{$pref['prune_perpage']}";

            break;
        case 4:
            // minimum comments
            $prune_where .= " and user_comments < " . $pref['prune_threshold'];
            $prune_count = $sql->db_Count('user', '(*)', "$prune_where" , false);
            $prune_sql = "select * from #user as u
			$prune_where order by user_comments asc limit $prune_from,{$pref['prune_perpage']}";
            break;
        case 5:
            // minimum visits
            $prune_where .= " and user_visits < " . $pref['prune_threshold'];
            $prune_count = $sql->db_Count('user', '(*)', "$prune_where" , false);
            $prune_sql = "select * from #user as u
			$prune_where order by user_visits asc limit $prune_from,{$pref['prune_perpage']}";
            break;
        case 6:
            // minimum visits
            $prune_where .= " and allsum < " . $pref['prune_threshold'];
            $prune_sql2 = "
            select * from
			(
				select baz.*,sum(user_forums)+sum(user_chats)+sum(user_comments) as allsum from #user as baz
				group by user_id) as u
				$prune_where ";
            $prune_sql = $prune_sql2 . " order by user_visits asc limit 0,{$pref['prune_perpage']}";

            $prune_count = $sql->db_Select_gen($prune_sql2 , false);
            break;
        default: ;
    } // switch
    // ***********************************************************
    // Select the users that are delinquent
    // ***********************************************************
    if ($sql->db_Select_gen($prune_sql, false))
    {
        $prune_text .= "
				<script type='text/javascript'>
				<!--
				function prunecheckAll(allbox)
{
for (var i=0; i < document.pruneform[\"prune_record[]\"].length; i++)
        document.pruneform[\"prune_record[]\"][i].checked=true ;
}

function pruneuncheckAll(allbox)
{
for (var i=0; i < document.pruneform[\"prune_record[]\"].length; i++)
        document.pruneform[\"prune_record[]\"][i].checked=false ;
}
-->
</script>

<form name='pruneform' id='pruneform' method='post' action='" . e_SELF . "'>
<div>
	<input type='hidden' name='prune_action' value='prune_dodel' />
</div>
	<table class='fborder' style='" . ADMIN_WIDTH . "'>
		<tr>
			<td class='forumheader' colspan='9'><b>" . PRUNE_A63 . " $prune_count</b>
				&nbsp;
			</td>
		</tr>
		<tr>
			<td class='forumheader' style='width:10%;'><b>" . PRUNE_A4 . "</b></td>
			<td class='forumheader' style='width:15%;'><b>" . PRUNE_A44 . "</b></td>
			<td class='forumheader' style='width:15%;'><b>" . PRUNE_A59 . "</b></td>
			<td class='forumheader' style='width:15%;'><b>" . PRUNE_A60 . "</b></td>
			<td class='forumheader' style='width:10%;text-align:right;'><b>" . PRUNE_A56 . "</b></td>
			<td class='forumheader' style='width:10%;text-align:right;'><b>" . PRUNE_A57 . "</b></td>
			<td class='forumheader' style='width:10%;text-align:right;'><b>" . PRUNE_A58 . "</b></td>
			<td class='forumheader' style='width:10%;text-align:right;'><b>" . PRUNE_A70 . "</b></td>
			<td class='forumheader' style='width:5%;text-align:center;'><b>" . PRUNE_A6 . "</b></td>
		</tr>";
        while ($prune_row = $sql->db_Fetch())
        {
            // ***********************************************************
            // for each user
            // ***********************************************************
            extract($prune_row);
            $prune_text .= "
		<tr>
			<td class='forumheader3' style='width:10%;'>" . $tp->toHTML($user_name) . "</td>
			<td class='forumheader3' style='width:15%;'>" . ($user_join > 0?$prune_convert->convert_date($user_join, "short"):'&nbsp;') . "</td>
			<td class='forumheader3' style='width:15%;'>" . ($user_lastvisit > 0?$prune_convert->convert_date($user_lastvisit, "short"):'&nbsp;') . "</td>
			<td class='forumheader3' style='width:15%;'>" . ($user_lastpost > 0?$prune_convert->convert_date($user_lastpost, "short"):'&nbsp;') . "</td>
			<td class='forumheader3' style='width:10%;text-align:right;'>" . $user_forums . "</td>
			<td class='forumheader3' style='width:10%;text-align:right;'>" . $user_chats . "</td>
			<td class='forumheader3' style='width:10%;text-align:right;'>" . $user_comments . "</td>
			<td class='forumheader3' style='width:10%;text-align:right;'>" . $user_visits . "</td>
			<td class='forumheader3' style='width:5%;text-align:center;'>" . ($user_admin == 1?"A":"<input type='checkbox' class='tbox' name='prune_record[]' value='$user_id' />") . "</td>
		</tr>";
        } // while
        $prune_action = 'show';
        $parms = $prune_count . ",{$pref['prune_perpage']}," . $prune_from . ',' . e_SELF . '?' . '[FROM].' . $prune_action;
        $prune_nextprev = $tp->parseTemplate("{NEXTPREV={$parms}}") . '';
        $prune_text .= "
		<tr>
			<td class='forumheader3' colspan='8' style='text-align:right;'>
				<input class='button' type='button' name='CheckAll' value='" . PRUNE_A36 . "' onclick='prunecheckAll(this);' />
				<input class='button' type='button' name='UnCheckAll' value='" . PRUNE_A37 . "' onclick='pruneuncheckAll(this);' />
			</td>
			<td  class='forumheader3'>&nbsp;</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='9'>$prune_nextprev&nbsp;</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='9'><input class='button' type='submit' name='subit' value='" . PRUNE_A3 . "' /></td>
		</tr>
	</table>
</form>";
    }
    else
    {
        // ***********************************************************
        // No users selected, they are all regular visitors or posters
        // ***********************************************************
        $prune_text .= "
<table class='fborder' style='" . ADMIN_WIDTH . "'>
	<tr>
		<td class='fcaption' >" . PRUNE_A1 . "</td>
	</tr>
	<tr>
		<td  class='forumheader3'>" . PRUNE_A9 . "</td>
	</tr>
</table>";
    }
}
// ***********************************************************
// Render the table to the screen
// ***********************************************************
$ns->tablerender(PRUNE_A1, $prune_text);
// and finish
require_once(e_ADMIN . "footer.php");

?>