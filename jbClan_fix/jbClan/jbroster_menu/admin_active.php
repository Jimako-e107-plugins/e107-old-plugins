<?php
/*
+--------------------------------------------------------------------------------+
|   jbRoster - by Jesse Burns aka jburns131 aka Jakle (jburns131@jbwebware.com)
|
|   Plugin Support Site: www.jbwebware.com
|
|   A plugin designed for the e107 Website System
|   http://e107.org
|
|   For more plugins visit:
|   http://plugins.e107.org
|   http://www.e107coders.org
|
|   Released under the terms and conditions of the
|   GNU General Public License (http://gnu.org).
|
+--------------------------------------------------------------------------------+
*/

require_once("../../class2.php");
require_once(e_HANDLER."userclass_class.php");
if(!getperms("P")) {
    header("location:".e_HTTP."index.php");
    exit;
}

require_once(e_ADMIN."auth.php");

if(file_exists(e_PLUGIN."jbroster_menu/languages/".e_LANGUAGE.".php")) {
    include_lan(e_PLUGIN."jbroster_menu/languages/".e_LANGUAGE.".php");
}

require_once("includes/config.constants.php");

$pageid = "admin_menu_06";

$text .= "
<div style='width:100%'>
    <form action='admin_member_edit.php' method='POST'>
        <table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
            <tr>
                <td class='forumheader3'><b>".LAN_JBROSTER_GENERAL_GAME_NAME."</b></td>
                <td class='forumheader3'><b>".LAN_JBROSTER_GENERAL_REAL_NAME."</b></td>
                <td class='forumheader3'><b>".LAN_JBROSTER_GENERAL_EMAIL."</b></td>
                <td class='forumheader3'><b>".LAN_JBROSTER_GENERAL_LEADER_STATUS."</b></td>
                <td class='forumheader3'><b>".LAN_JBROSTER_GENERAL_MEMBER_STATUS."</b></td>
                <td class='forumheader3' colspan='2'><center><b>".LAN_JBROSTER_GENERAL_EDIT."</b></center></td>
            </tr>";

            $sql->db_Select(DB_TABLE_ROSTER_MEMBER_STATUS, "*", "status_name     != 'Team Member'
                                                                 AND status_name != 'General Member'
                                                                 AND status_name != 'Cadet'
                                                                 AND status_name != 'Recruit'
                                                                 AND status_name != 'Inactive Member'
                                                                 AND status_name != 'Open Application'
                                                                 AND status_name != 'Closed Application'");

            while($row = $sql->db_Fetch()){
                $customArgs .= " OR member_status like '".$tp->toDB($row['status_name'])."%'";
            }

            $numRows = $sql->db_Count(DB_TABLE_ROSTER_MEMBERS, "(*)", "WHERE member_status like 'Team Member%'
                                                                       OR member_status    like 'General Member%'
                                                                       OR member_status    like 'Cadet%'
                                                                       OR member_status    like 'Recruit%'$customArgs");

            if ($numRows == 0) {
                $text .= "
                <tr>
                    <td colspan='10' class='forumheader3'>
                        <center>
                            <p>
                                ".LAN_JBROSTER_ADMIN_ACTIVE_NO_ACTIVE_MEMBERS."
                            </p>
                        </center>
                    </td>
                </tr>";
            } else {
                // Do Nothing
            }

            $sql->db_Select(DB_TABLE_ROSTER_MEMBER_STATUS, "*", "status_name     != 'Team Member'
                                                                 AND status_name != 'General Member'
                                                                 AND status_name != 'Cadet'
                                                                 AND status_name != 'Recruit'
                                                                 AND status_name != 'Inactive Member'
                                                                 AND status_name != 'Open Application'
                                                                 AND status_name != 'Closed Application'");

            while($row = $sql->db_Fetch()){
                $customArgs .= " OR member_status like '".$tp->toDB($row['status_name'])."%'";
            }

            $sql->db_Select(DB_TABLE_ROSTER_MEMBERS, "*", "member_status    like 'Team Member%'
                                                           OR member_status like 'General Member%'
                                                           OR member_status like 'Cadet%'
                                                           OR member_status like 'Recruit%'$customArgs
                                                           ORDER BY nickname");

            while($row = $sql->db_Fetch()){
                $sql1 = new db;
                $sql1->db_Select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES, "*", "member_id           = ".intval($row['member_id'])."
                                                                                AND attribute_id    = 8");
                while($row1 = $sql1->db_Fetch()){
                    $email = $row1['attribute_value'];
                }

                $text .="<tr>";

                if ($row['nickname'] == '') {
                    $text .="<td class='forumheader3'>&nbsp;</td>";
                } else {
                    $text .="<td class='forumheader3'>".$row['nickname']."</td>";
                }

                if ($row['real_name'] == '') {
                    $text .="<td class='forumheader3'>&nbsp;</td>";
                } else {
                    $text .="<td class='forumheader3'>".$row['real_name']."</td>";
                }

                if ($email == '') {
                    $text .="<td class='forumheader3'>&nbsp;</td>";
                } else {
                    $text .="<td class='forumheader3'><a href='mailto:$email'>".LAN_JBROSTER_GENERAL_EMAIL."</a></td>";
                }

                $text .= "
                <td class='forumheader3'>
                    <select class='tbox' name='leader_status[]'>";

                    $sql1->db_Select(DB_TABLE_ROSTER_LEADER_STATUS, "*", "ORDER BY status_order", $mode="no-where");
                    while ($row1 = $sql1->db_Fetch()) {
                        if ($row['leader_status'] == $row1['status_name']) {
                            $text .= "
                            <option value='".$row['member_id'].DELIMITER_1.$row1['status_name']."' selected='selected'>".$row1['status_name']."</option>";
                        } else {
                            $text .= "
                            <option value='".$row['member_id'].DELIMITER_1.$row1['status_name']."'>".$row1['status_name']."</option>";
                        }
                    }

                    $text .= "
                    </select>
                </td>
                <td class='forumheader3'>
                    <select class='tbox' name='member_status[]'>";

                    $sql1->db_Select(DB_TABLE_ROSTER_MEMBER_STATUS, "*", "ORDER BY status_order", $mode="no-where");
                    while ($row1 = $sql1->db_Fetch()) {
                        if ($row['member_status'] == $row1['status_name']) {
                            $text .= "
                            <option value='".$row['member_id'].DELIMITER_1.$row1['status_name']."' selected='selected'>".$row1['status_name']."</option>";
                        } else {
                            $text .= "
                            <option value='".$row['member_id'].DELIMITER_1.$row1['status_name']."'>".$row1['status_name']."</option>";
                        }
                    }

                    $text .= "
                    </select>
                </td>";
                $text .="<td class='forumheader3'><a href='admin_member_edit.php?member_id=".$row['member_id']."&url=".$_SERVER['PHP_SELF']."'>".ADMIN_EDIT_ICON."</a></td>";
                $text .="<td class='forumheader3'><a href='admin_member_edit.php?delete_member=1&member_id=".$row['member_id']."&url=".$_SERVER['PHP_SELF']."'><img src='".ADMIN_DELETE_ICON_PATH."' /></a></td>";
            }

            $text .= "
            </tr>
        </table>";

        if ($numRows == 0) {
            // Do Nothing
        } else {
            $text .= "
            <p>
                <input type='hidden' name='url' value='".$_SERVER['PHP_SELF']."' />
                <input type='hidden' name='change_member_status' value='1' />
                <center>
                    <input class='button' type='submit' value='".LAN_JBROSTER_GENERAL_CHANGE_MEMBER_STATUS."' />
                </center>
            </p>";
        }

    $text .= "
    </form>
</div>";

$title = "<b>".LAN_JBROSTER_GENERAL_ACTIVE_MEMBERS."</b>";
$ns->tablerender($title, $text);

require_once(e_ADMIN."footer.php");
?>
