<?php
/*
+--------------------------------------------------------------------------------+
|   jbApp - by Jesse Burns aka jburns131 aka Jakle (jburns131@jbwebware.com)
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
require_once("includes/config.constants.php");

if(!getperms("P")){
    header("location:".e_HTTP."index.php");
    exit;
}

require_once(e_ADMIN."auth.php");

if(file_exists(e_PLUGIN."jbapp/languages/".e_LANGUAGE.".php")){
    include_lan(e_PLUGIN."jbapp/languages/".e_LANGUAGE.".php");
}

$pageid = "admin_menu_02";

$sql->db_Select(DB_TABLE_ROSTER_PREFERENCES);
while($row = $sql->db_Fetch()){
    $organization_name = $row['organization_name'];
    $organization_type = $row['organization_type'];
}

$text .= "
<form name='good' method='POST' action='admin_display_edit.php'>
    <center>
        <p>
            <div style='width:80%'>
                <table border='1' style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td colspan='6' class='forumheader'><b>".LAN_JBAPP_ADMIN_DISPLAY_OPTIONS_TABLE_CAPTION."</b></td>
                    </tr>
                    <tr>
                        <td class='forumheader3' width='50%'>
                            <center>
                                <b>".LAN_JBAPP_ADMIN_DISPLAY_OPTIONS_COLUMN_1."</b>
                            </center>
                        </td>
                        <td class='forumheader3' width='50%'>
                            <center>
                                <b>".LAN_JBAPP_ADMIN_DISPLAY_OPTIONS_COLUMN_2."</b>
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
                                        ".LAN_JBAPP_ADMIN_DISPLAY_OPTIONS_NO_ATTRIBUTES."
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
                        if ($row['attribute_id'] == 3) {
                            // Don't display attribue
                        } else if ($row['attribute_id'] == 4) {
                            // Don't display attribue
                        } else if ($row['attribute_id'] == 5) {
                            // Don't display attribue
                        } else if ($row['attribute_id'] == 49) {
                            // Don't display attribue
                        } else {

                            $text .= "
                            <tr>";

                                if ($row['attribute_id'] == 34) {
                                    $text .= "
                                    <td class='forumheader3' valign='top'>
                                        ".$row['attribute_name']." $organization_name:
                                    </td>";
                                } else {
                                    $text .= "
                                    <td class='forumheader3' valign='top'>
                                        ".$row['attribute_name']."
                                    </td>";
                                }

                                $text .= "
                                <td class='forumheader3' width='50%'>
                                    <center>";

                                    if ($row['application_display'] == 2) {
                                        $text .= "
                                        <input type='checkbox' name='attribute_application_display[]' value='".$row['attribute_id']."' checked='checked' />";
                                    } else {
                                        $text .= "
                                        <input type='checkbox' name='attribute_application_display[]' value='".$row['attribute_id']."' />";
                                    }

                                    $text .= "
                                    </center>
                                </td>
                            </tr>";
                        }
                    }

                    $text .= "
                </table>
            </div>
        </p>
    </center>

    <center>
        <p>
            <input type='hidden' name='application_display' value='1'>
            <input class='button' type='submit' value='".LAN_JBAPP_ADMIN_DISPLAY_OPTIONS_SUBMIT."'>
        </p>
    </center>
</form>";

$title = "<b>".LAN_JBAPP_ADMIN_DISPLAY_OPTIONS_TITLE."</b>";
$ns->tablerender($title, $text);

require_once(e_ADMIN."footer.php");
?>
