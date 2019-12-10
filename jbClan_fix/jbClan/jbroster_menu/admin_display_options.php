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

$pageid = "admin_menu_10";

$sql->db_Select(DB_TABLE_ROSTER_PREFERENCES);
while($row = $sql-> db_Fetch()){
    $organization_name = $row['organization_name'];
    $organization_type = $row['organization_type'];
}

$text = "

<center>
    <p>
        <b>".LAN_JBROSTER_ADMIN_DISPLAY_OPTIONS_DISLAY_WARNING_1."</b>
    </p>
</center>

<form name='good' method='POST' action='admin_display_edit.php'>
    <center>
        <p>
            <div style='width:80%'>
                <table border='1' style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td colspan='6' class='forumheader'><b>".LAN_JBROSTER_ADMIN_DISPLAY_OPTIONS_DISPLAY_TEAMS."</b></td>
                    </tr>
                    <tr>
                        <td class='forumheader3' width='50%'>
                            <center>
                                <b>".LAN_JBROSTER_ADMIN_DISPLAY_OPTIONS_SQUAD_NAME."</b>
                            </center>
                        </td>
                        <td class='forumheader3' width='50%'>
                            <center>
                                <b>".LAN_JBROSTER_ADMIN_DISPLAY_OPTIONS_DISPLAY."</b>
                            </center>
                        </td>
                    </tr>";

                    $numRows = $sql->db_Count(DB_TABLE_ROSTER_TEAMS);
                    if ($numRows == 0) {
                        $text .= "
                        <tr>
                            <td colspan='10' class='forumheader3'>
                                <center>
                                    <p>
                                        ".LAN_JBROSTER_GENERAL_NO_TEAMS_IN_SYSTEM."
                                    </p>
                                </center>
                            </td>
                        </tr>";
                    } else {
                        // Do Nothing
                    }

                    $sql->db_Select(DB_TABLE_ROSTER_TEAMS, "*", "ORDER BY team_order", "no-where");
                    while ($row = $sql->db_Fetch()) {
                        $text .= "
                        <tr>
                            <td class='forumheader3' width='50%'>
                                <center>
                                    ".$row['team_name']."
                                </center>
                            </td>
                            <td class='forumheader3' width='50%'>
                                <center>";

                                if ($row['display'] == 2) {
                                    $text .= "
                                    <input type='checkbox' name='team_display[]' value='".$row['team_name'].DELIMITER_1.$row['game_name']."' checked='checked' />";
                                } else {
                                    $text .= "
                                    <input type='checkbox' name='team_display[]' value='".$row['team_name'].DELIMITER_1.$row['game_name']."' />";
                                }

                                $text .= "
                                </center>
                            </td>
                        </tr>";
                    }

                    $text .= "
                </table>
            </div>
        </p>
    </center>

    <center>
        <p>
            <div style='width:80%'>
                <table border='1' style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td colspan='6' class='forumheader'><b>".LAN_JBROSTER_ADMIN_DISPLAY_OPTIONS_DISPLAY_MEMBER_STATUSES."</b></td>
                    </tr>";

                    $numRows = $sql->db_Count(DB_TABLE_ROSTER_MEMBER_STATUS, "(*)", "WHERE status_id != 1");
                    if ($numRows == 0) {
                        $text .= "
                        <tr>
                            <td colspan='10' class='forumheader3'>
                                <center>
                                    <p>
                                        ".LAN_JBROSTER_GENERAL_NO_STATUSES_IN_SYSTEM."
                                    </p>
                                </center>
                            </td>
                        </tr>";
                    } else {
                        // Do Nothing
                    }

                    $text .= "
                    <tr>
                        <td class='forumheader3' width='50%'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_STATUS_NAME."</b>
                            </center>
                        </td>
                        <td class='forumheader3' width='50%'>
                            <center>
                                <b>".LAN_JBROSTER_ADMIN_DISPLAY_OPTIONS_DISPLAY."</b>
                            </center>
                        </td>
                    </tr>";

                    $sql->db_Select(DB_TABLE_ROSTER_MEMBER_STATUS, "*", "status_id != 1 ORDER BY status_order");
                    while ($row = $sql->db_Fetch()) {
                        $text .= "
                        <tr>
                            <td class='forumheader3' width='50%'>
                                <center>
                                    ".$row['status_name']."
                                </center>
                            </td>
                            <td class='forumheader3' width='50%'>
                                <center>";

                                if ($row['display'] == 2) {
                                    $text .= "
                                    <input type='checkbox' name='status_display[]' value='".$row['status_name']."' checked='checked' />";
                                } else {
                                    $text .= "
                                    <input type='checkbox' name='status_display[]' value='".$row['status_name']."' />";
                                }

                                $text .= "
                                </center>
                            </td>
                        </tr>";
                    }

                $text .= "
                </table>
            </div>
        </p>
    </center>

    <center>
        <p>
            <div style='width:80%'>
                <table border='1' style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td colspan='6' class='forumheader'><b>".LAN_JBROSTER_ADMIN_DISPLAY_OPTIONS_DISPLAY_MAIN_ROSTER_ATTRIBUTES."</b></td>
                    </tr>
                    <tr>
                        <td class='forumheader3' width='50%'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_ATTRIBUTE_NAME."</b>
                            </center>
                        </td>
                        <td class='forumheader3' width='50%'>
                            <center>
                                <b>".LAN_JBROSTER_ADMIN_DISPLAY_OPTIONS_DISPLAY."</b>
                            </center>
                        </td>
                    </tr>";

                    if (($organization_type != 5) && ($organization_type != 6)) {
                        $numRows = $sql->db_Count(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES, "(*)", " WHERE organization_type like 1 OR organization_type like 2 OR organization_type like ".intval($organization_type));
                    } else {
                        $numRows = $sql->db_Count(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES, "(*)", " WHERE organization_type like 1 OR organization_type like ".intval($organization_type));
                    }

                    if ($numRows == 0) {
                        $text .= "
                        <tr>
                            <td colspan='10' class='forumheader3'>
                                <center>
                                    <p>
                                        ".LAN_JBROSTER_ADMIN_DISPLAY_OPTIONS_NO_ATTRIBUTES_IN_SYSTEM."
                                    </p>
                                </center>
                            </td>
                        </tr>";
                    } else {
                        // Do Nothing
                    }

                    if (($organization_type != 5) && ($organization_type != 6)) {
                        $sql->db_Select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES, "*", "organization_type like 1 OR organization_type like 2 OR organization_type like ".intval($organization_type)." ORDER BY attribute_order");
                    } else {
                        $sql->db_Select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES, "*", "organization_type like 1 OR organization_type like ".intval($organization_type)." ORDER BY attribute_order");
                    }

                    while ($row = $sql->db_Fetch()) {
                        $text .= "
                        <tr>
                            <td class='forumheader3' width='50%'>
                                <center>
                                    ".$row['attribute_name']."
                                </center>
                            </td>
                            <td class='forumheader3' width='50%'>
                                <center>";

                                if ($row['main_display'] == 2) {
                                    $text .= "
                                    <input type='checkbox' name='attribute_main_display[]' value='".$row['attribute_id']."' checked='checked' />";
                                } else {
                                    $text .= "
                                    <input type='checkbox' name='attribute_main_display[]' value='".$row['attribute_id']."' />";
                                }

                                $text .= "
                                </center>
                            </td>
                        </tr>";
                    }

                    $text .= "
                </table>
            </div>
        </p>
    </center>

    <center>
        <p>
            <div style='width:80%'>
                <table border='1' style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td colspan='6' class='forumheader'><b>".LAN_JBROSTER_ADMIN_DISPLAY_OPTIONS_DISPLAY_PROFILE_ATTRIBUTES."</b></td>
                    </tr>
                    <tr>
                        <td class='forumheader3' width='50%'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_ATTRIBUTE_NAME."</b>
                            </center>
                        </td>
                        <td class='forumheader3' width='50%'>
                            <center>
                                <b>".LAN_JBROSTER_ADMIN_DISPLAY_OPTIONS_DISPLAY."</b>
                            </center>
                        </td>
                    </tr>";

                    if (($organization_type != 5) && ($organization_type != 6)) {
                        $numRows = $sql->db_Count(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES, "(*)", " WHERE organization_type like 1 OR organization_type like 2 OR organization_type like ".intval($organization_type));
                    } else {
                        $numRows = $sql->db_Count(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES, "(*)", " WHERE organization_type like 1 OR organization_type like ".intval($organization_type));
                    }

                    if ($numRows == 0) {
                        $text .= "
                        <tr>
                            <td colspan='10' class='forumheader3'>
                                <center>
                                    <p>
                                        ".LAN_JBROSTER_ADMIN_DISPLAY_OPTIONS_NO_ATTRIBUTES_IN_SYSTEM."
                                    </p>
                                </center>
                            </td>
                        </tr>";
                    } else {
                        // Do Nothing
                    }

                    if (($organization_type != 5) && ($organization_type != 6)) {
                        $sql->db_Select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES, "*", "organization_type like 1 OR organization_type like 2 OR organization_type like ".intval($organization_type)." ORDER BY attribute_order");
                    } else {
                        $sql->db_Select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES, "*", "organization_type like 1 OR organization_type like ".intval($organization_type)." ORDER BY attribute_order");
                    }

                    while ($row = $sql->db_Fetch()) {
                        $text .= "
                        <tr>
                            <td class='forumheader3' width='50%'>
                                <center>
                                    ".$row['attribute_name']."
                                </center>
                            </td>
                            <td class='forumheader3' width='50%'>
                                <center>";

                                if ($row['profile_display'] == 2) {
                                    $text .= "
                                    <input type='checkbox' name='attribute_display[]' value='".$row['attribute_id']."' checked='checked' />";
                                } else {
                                    $text .= "
                                    <input type='checkbox' name='attribute_display[]' value='".$row['attribute_id']."' />";
                                }

                                $text .= "
                                </center>
                            </td>
                        </tr>";
                    }

                $text .= "
                </table>
            </div>
        </p>
    </center>

    <center>
        <p>
            <input type='hidden' name='roster_display' value='1' />
            <input type='hidden' name='profile_display' value='1' />
            <input type='submit' class='button' value='".LAN_JBROSTER_GENERAL_APPLY_CHANGES."' />
        </p>
    </center>
</form>";

$title = "<b>".LAN_JBROSTER_GENERAL_DISPLAY_OPTIONS."</b>";
$ns->tablerender($title, $text);

require_once(e_ADMIN."footer.php");
?>
