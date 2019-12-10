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

$sql->db_Select("plugin", "*");
while($rows = $sql->db_Fetch()){
    if (($rows['plugin_name'] == "jbRoster") && ($rows['plugin_installflag'] == "1")) {
        $installed_jbroster = 1;
    }
}

if (!$installed_jbroster) {

    if(file_exists(e_PLUGIN."jbapp/languages/".e_LANGUAGE.".php")){
        include_lan(e_PLUGIN."jbapp/languages/".e_LANGUAGE.".php");
    }

    $pageid = "admin_menu_03";

    $text = "
    <center>
        <p>
            <div style='width:60%'>
                <form method='POST' action='admin_custom_content_edit.php'>
                    <table border='1' style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
                        <tr>
                            <td colspan='6' class='forumheader'>
                                <b>".LAN_JBAPP_ADMIN_CUSTOM_CONTENT_CREATE_MEMBER_ATTRIBUTE."</b>
                            </td>
                        </tr>";

                        if ($_GET['success_attribute'] == '2') {
                            $text .= "
                            <tr>
                                <td colspan='6' class='forumheader3'>
                                    <center>
                                        <p>
                                            <b>".LAN_JBAPP_ADMIN_CUSTOM_CONTENT_MEMBER_ATTRIBUTE_SUCCESS."</b>
                                        </p>
                                    </center>
                                </td>
                            </tr>";
                        } else if ($_GET['success_attribute'] == '1') {
                            $text .= "
                            <tr>
                                <td colspan='6' class='forumheader3'>
                                    <center>
                                        <p>
                                            <b>".LAN_JBAPP_ADMIN_CUSTOM_CONTENT_MEMBER_ATTRIBUTE_IN_SYSTEM."</b>
                                        </p>
                                    </center>
                                </td>
                            </tr>";
                        } else if ($_GET['success_attribute'] == '0') {
                            $text .= "
                            <tr>
                                <td colspan='6' class='forumheader3'>
                                    <center>
                                        <p>
                                            <b>".LAN_JBAPP_ADMIN_CUSTOM_CONTENT_ENTER_ATTRIBUTE_NAME."</b>
                                        </p>
                                    </center>
                                </td>
                            </tr>";
                        }

                        $text .= "
                        <tr>
                            <td width='20%' class='forumheader3'>
                                <center>
                                    <b>".LAN_JBAPP_GENERAL_ATTRIBUTE_NAME."</b>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td width='20%' class='forumheader3'>
                                <center>
                                    <input type='text' class='tbox' name='custom_attribute_name' value='' maxlength='25' size='25' />
                                </center>
                            </td>
                        </tr>
                    </table>
                    <center>
                        <p>
                            <input type='hidden' name='add_member_attribute' value='1' />
                            <input type='submit' class='button' value='".LAN_JBAPP_ADMIN_CUSTOM_CONTENT_ADD_ATTRIBUTE."' />
                        </p>
                    </center>
                </form>
            </div>
        </p>
    </center>

    <center>
        <p>
            <div style='width:60%'>
                <form method='POST' action='admin_custom_content_edit.php'>
                    <table border='1' style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
                        <tr>
                            <td colspan='3' class='forumheader'>
                                <b>".LAN_JBAPP_ADMIN_CUSTOM_CONTENT_CURRENT_MEMBER_ATTRIBUTES."</b>
                            </td>
                        </tr>
                        <tr>
                            <td class='forumheader3' width='25%'>
                                <center>
                                    <b>".LAN_JBAPP_GENERAL_ATTRIBUTE_NAME."</b>
                                </center>
                            </td>
                            <td class='forumheader3' width='25%'>
                                <center>
                                    <b>".LAN_JBAPP_GENERAL_ORDER."</b>
                                </center>
                            </td>
                            <td class='forumheader3' width='25%'>
                                <center>
                                    <b>".LAN_JBAPP_GENERAL_EDIT."</b>
                                </center>
                            </td>
                        </tr>";

                        $numRows = $sql->db_Count(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES);
                        if ($numRows == 0) {
                            $text .= "
                            <tr>
                                <td colspan='10' class='forumheader3'>
                                    <center>
                                        <p>
                                            ".LAN_JBAPP_ADMIN_CUSTOM_CONTENT_NO_MEMBER_ATTRIBUTES_IN_SYSTEM."
                                        </p>
                                    </center>
                                </td>
                            </tr>";
                        } else {
                            // Do Nothing
                        }

                        $sql->db_Select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES, "*", "ORDER BY attribute_order", "no-where");
                        while ($row = $sql->db_Fetch()) {
                            $text .= "
                            <tr>
                                <td class='forumheader3' width='25%'>
                                    <center>
                                        ".$row['attribute_name']."
                                    </center>
                                </td>
                                <td class='forumheader3' width='25%'>
                                    <center>
                                        <select class='tbox' name='attribute_order[]'>";

                                        $sql1 = new db;
                                        $num_rows = $sql1->db_Count(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES);
                                        $count = 1;
                                        while ($count <= $num_rows) {
                                            if ($row['attribute_order'] == $count) {
                                                $text .= "
                                                <option value='".$row['attribute_id'].DELIMITER_1.$count."' selected='selected'>".$count."</option>";
                                            } else {
                                                $text .= "
                                                <option value='".$row['attribute_id'].DELIMITER_1.$count."'>".$count."</option>";
                                            }
                                            $count++;
                                        }

                                        $text .= "
                                        </select>
                                    </center>
                                </td>
                                <td class='forumheader3' width='25%'>
                                    <center>";

                                    if ($row['attribute_id'] == 1) {
                                        $text .= "
                                        <a href='admin_custom_content_edit.php?rename_member_attribute=1&attribute_id=".$row['attribute_id']."&attribute_name=".$row['attribute_name']."'>".ADMIN_EDIT_ICON."</a>";
                                    } else {
                                        $text .= "
                                        &nbsp;";
                                    }

                                    if ($row['attribute_id'] > 49) {
                                        $text .= "
                                        <a href='admin_custom_content_edit.php?rename_member_attribute=1&attribute_id=".$row['attribute_id']."&attribute_name=".$row['attribute_name']."'>".ADMIN_EDIT_ICON."</a>
                                        <a href='admin_custom_content_edit.php?delete_member_attribute=1&attribute_id=".$row['attribute_id']."&attribute_name=".$row['attribute_name']."'><img src='".ADMIN_DELETE_ICON_PATH."' /></a>";
                                    } else {
                                        $text .= "
                                        &nbsp;";
                                    }

                                    $text .= "
                                    </center>
                                </td>
                            </tr>";
                        }

                    $text .= "
                    </table>";
                    if ($numRows == 0) {
                        // Do Nothing
                    } else {
                        $text .= "
                        <p>
                            <input type='hidden' name='change_member_attribute' value='1' />
                            <input type='submit' class='button' value='".LAN_JBAPP_ADMIN_CUSTOM_CONTENT_CHANGE_ATTRIBUTES."' />
                        </p>";
                    }

                $text .= "
                </form>
            </div>
        </p>
    </center>";

    $title = "<b>".LAN_JBAPP_ADMIN_CUSTOM_CONTENT_CUSTOM_MEMBER_ATTRIBUTES."</b>";
    $ns->tablerender($title, $text);
} else {
    header("Location: admin_config.php");
    exit;
}

require_once(e_ADMIN."footer.php");
?>