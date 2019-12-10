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

if(file_exists(e_PLUGIN."jbapp/languages/".e_LANGUAGE.".php")) {
    include_lan(e_PLUGIN."jbapp/languages/".e_LANGUAGE.".php");
}

require_once("includes/config.constants.php");
require_once("includes/config.functions.php");

$pageid = "admin_menu_03";

if ($_POST['add_member_attribute'] == '1') {

    // Add Member Attribute

    if ($_POST['custom_attribute_name'] == '') {
        // Send back error
        header("Location: admin_custom_content.php?success_attribute=0");
        exit;
    }

    if ($sql->db_Count(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES, "(*)",
        "WHERE attribute_name = '".$tp->toDB($_POST['custom_attribute_name'])."'") > 0) {
        // Do Nothing

        header("Location: admin_custom_content.php?success_attribute=1");
        exit;

    } else {

        $sql->db_Insert(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES,
            "'',
            '".$tp->toDB($_POST['custom_attribute_name'])."',
            1,
            1,
            1,
            1,
            1,
            '".$tp->toDB($_POST['text_color'])."'");

        $sql->db_Select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES);
        while ($row = $sql->db_Fetch()) {
            $attributeId = $row['attribute_id'];
        }

        $sql->db_Insert(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES,
            intval($attributeId).",
            '".$tp->toDB($_POST['custom_attribute_name'])."',
            1,
            1,
            1,
            1,
            1,
            '".$tp->toDB($_POST['text_color'])."'");

        header("Location: admin_custom_content.php?success_attribute=2");
        exit;
    }

} else if ($_POST['change_member_attribute'] == '1') {

    foreach ($_POST['text_color'] as $value) {
        $textColor[] = $value;
    }

    // Change Member Attribute order

    for ($x = 0; $x < count($_POST['attribute_order']); $x++) {
        tokenizeArray($_POST['attribute_order'][$x]);
        $newMemberAttributeOrderArray[$x] = $tokens;
    }

    for ($x = 0; $x < count($newMemberAttributeOrderArray); $x++) {

        $sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES,
            "attribute_order    = ".intval($newMemberAttributeOrderArray[$x][1]).",
            text_color          = '".$tp->toDB($textColor)."'
            WHERE attribute_id  = ".intval($newMemberAttributeOrderArray[$x][0]));

        $sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES,
            "attribute_order    = ".intval($newMemberAttributeOrderArray[$x][1]).",
            text_color          = '".$tp->toDB($textColor)."'
            WHERE attribute_id  = ".intval($newMemberAttributeOrderArray[$x][0]));
    }

    header("Location: admin_custom_content.php");
    exit;

} else if ($_GET['delete_member_attribute'] == '1') {

    // Verify deletion

    $text = "
    <center>
        <p>
            ".LAN_JBAPP_ADMIN_CUSTOM_CONTENT_EDIT_DELETE_MEMBER_ATTRIBUTE_CONFIRM."
        </p>
        <p>
            <table width='100'>
                <tr>
                    <td>
                        <a href='admin_custom_content_edit.php?delete_member_attribute=2&attribute_id=".$_GET['attribute_id']."&attribute_name=".$_GET['attribute_name']."'>".LAN_JBAPP_GENERAL_YES."</a>
                    </td>
                    <td>
                        <a href='admin_custom_content.php'>".LAN_JBAPP_GENERAL_NO."</a>
                    </td>
                </tr>
            </table>
        </p>
    </center>";

    $title = "<b>".LAN_JBAPP_ADMIN_CUSTOM_CONTENT_EDIT_DELETE_MEMBER_ATTRIBUTE."</b>";
    $ns->tablerender($title, $text);

} else if ($_GET['delete_member_attribute'] == '2') {

    // Delete Member Attribute from tables

    $sql->db_Delete(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES,
        "attribute_id = ".intval($_GET['attribute_id']));

    $sql->db_Delete(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
        "attribute_id = ".intval($_GET['attribute_id']));

    $sql->db_Delete(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES,
        "attribute_id = ".intval($_GET['attribute_id']));

    header("Location: admin_custom_content.php");
    exit;

} else if ($_GET['rename_member_attribute'] == '1') {

    $sql->db_Select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES, "*", "attribute_id = ".intval($_GET['attribute_id']));
    while ($row = $sql->db_Fetch()) {
        $attributeID = $row['attribute_id'];
        $currentName = $row['attribute_name'];
    }

    // Enter New Attribute Name

    $text = "
    <form action='admin_custom_content_edit.php' method='POST'>
        <center>
            <p>
                <table width='60%' cellspacing='15'>
                    <tr>
                        <td>
                            <b>".LAN_JBAPP_ADMIN_CUSTOM_CONTENT_EDIT_CURRENT_NAME.":</b>
                        </td>
                        <td>
                            $currentName
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>".LAN_JBAPP_ADMIN_CUSTOM_CONTENT_EDIT_NEW_NAME.":</b>
                        </td>
                        <td>
                            <input type='hidden' class='tbox' name='rename_member_attribute' value='2' />
                            <input type='hidden' class='tbox' name='attribute_id' value='$attributeID' />
                            <input type='text' class='tbox' name='attribute_name' value='' maxlength='25' size='25' />
                        </td>
                    </tr>
                </table>
            </p>
            <p>
                <input type='submit' class='button' value='".LAN_JBAPP_ADMIN_CUSTOM_CONTENT_EDIT_RENAME_ATTRIBUTE."' />
            <p>
        </center>
    </form>";

    $title = "<b>".LAN_JBAPP_ADMIN_CUSTOM_CONTENT_EDIT_RENAME_ATTRIBUTE."</b>";
    $ns->tablerender($title, $text);

} else if ($_POST['rename_member_attribute'] == '2') {

    // Rename Member Attribute

    $sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES,
        "attribute_name     = '".$tp->toDB($_POST['attribute_name'])."'
        WHERE attribute_id  = ".intval($_POST['attribute_id']));

    $sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES,
        "attribute_name     = '".$tp->toDB($_POST['attribute_name'])."'
        WHERE attribute_id  = ".intval($_POST['attribute_id']));

    $sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
        "attribute_name     = '".$tp->toDB($_POST['attribute_name'])."'
        WHERE attribute_id  = ".intval($_POST['attribute_id']));

    header("Location: admin_custom_content.php");
    exit;

}
?>