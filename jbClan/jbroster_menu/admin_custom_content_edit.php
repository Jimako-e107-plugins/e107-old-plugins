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
require_once("includes/config.functions.php");

$pageid = "admin_menu_09";

$sql->db_Select(DB_TABLE_ROSTER_PREFERENCES, "*", "organization_id = 1");
while ($row = $sql->db_Fetch()) {
    $organizationType = $row['organization_type'];
}

if ($_POST['add_leader_status'] == '1') {

    // Add Leader Status

    if ($_POST['leader_status_name'] == '') {
    	// Send back error
        header("Location: admin_custom_content.php?success_leader=0");
        exit;
    }

    if ($sql->db_Count(DB_TABLE_ROSTER_LEADER_STATUS, "(*)", " WHERE status_name = '".$tp->toDB($_POST['leader_status_name'])."'") > 0) {
        // Do Nothing
        header("Location: admin_custom_content.php?success_leader=1");
        exit;
    } else {
        $sql->db_Insert(DB_TABLE_ROSTER_LEADER_STATUS,
            "'',
            '".$tp->toDB($_POST['leader_status_name'])."',
            '".$tp->toDB($_POST['text_color'])."',
            1,
    		1");

        header("Location: admin_custom_content.php?success_leader=2");
        exit;
    }

} else if ($_POST['change_leader_status'] == '1') {

    // Change Leader Status

    foreach ($_POST['text_color'] as $value) {
        $textColor[] = $value;
    }

    // Change Leader Status order

    for ($x = 0; $x < count($_POST['status_order']); $x++) {
        tokenizeArray($_POST['status_order'][$x]);
        $newLeaderStatusOrderArray[$x] = $tokens;
    }

    for ($x = 0; $x < count($newLeaderStatusOrderArray); $x++) {

        $sql->db_Update(DB_TABLE_ROSTER_LEADER_STATUS,
            "status_order   = ".intval($newLeaderStatusOrderArray[$x][1]).",
            text_color      = '".$tp->toDB($textColor[$x])."'
            WHERE status_id = ".intval($newLeaderStatusOrderArray[$x][0]));
    }

    header("Location: admin_custom_content.php");
    exit;

} else if ($_GET['delete_leader_status'] == '1') {

    // Verify Leader Status deletion

    $text = "
    <center>
        <p>
            ".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_EDIT_DELETE_LEADER_STATUS_CONFIRM."
        </p>
        <p>
            <table width='100'>
                <tr>
                    <td>
                        <a href='admin_custom_content_edit.php?delete_leader_status=2&status_id=".$_GET['status_id']."&status_name=".$_GET['status_name']."'>".LAN_JBROSTER_GENERAL_YES."</a>
                    </td>
                    <td>
                        <a href='admin_custom_content.php'>".LAN_JBROSTER_GENERAL_NO."</a>
                    </td>
                </tr>
            </table>
        </p>
    </center>";

    $title = "<b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_EDIT_DELETE_LEADER_STATUS."</b>";
    $ns->tablerender($title, $text);

} else if ($_GET['delete_leader_status'] == '2') {

    // Delete Leader Status from db

    $sql->db_Delete(DB_TABLE_ROSTER_LEADER_STATUS,
        "status_id = ".intval($_GET['status_id']));

    // Change Leader Status to 'None'
    $sql->db_Update(DB_TABLE_ROSTER_MEMBERS,
    	"leader_status         = 'None'
    	WHERE leader_status    = '".$tp->toDB($_GET['status_name'])."'");

	// Change Leader Status to 'None'
    $sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
    	"attribute_value   = 'None'
    	WHERE attribute_id = 4");

    header("Location: admin_custom_content.php");
    exit;

} else if ($_POST['add_member_status'] == '1') {

    // Add Member Status

    if ($_POST['member_status_name'] == '') {
    	// Send back error
        header("Location: admin_custom_content.php?success_member=0");
        exit;
    }

    if ($sql->db_Count(DB_TABLE_ROSTER_MEMBER_STATUS, "(*)", " WHERE status_name = '".$tp->toDB($_POST['member_status_name'])."'") > 0) {
        // Do Nothing
        header("Location: admin_custom_content.php?success_member=1");
        exit;
    } else {
        $sql->db_Insert(DB_TABLE_ROSTER_MEMBER_STATUS,
            "'',
            '".$tp->toDB($_POST['member_status_name'])."',
            '".$tp->toDB($_POST['text_color'])."',
            1,
    		1");

        header("Location: admin_custom_content.php?success_member=2");
        exit;
    }

} else if ($_POST['change_member_status'] == '1') {

    // Change Member Status

    foreach ($_POST['text_color'] as $value) {
        $textColor[] = $value;
    }

    // Change Member Status order

    for ($x = 0; $x < count($_POST['status_order']); $x++) {
        tokenizeArray($_POST['status_order'][$x]);
        $newMemberStatusOrderArray[$x] = $tokens;
    }

    for ($x = 0; $x < count($newMemberStatusOrderArray); $x++) {

        $sql->db_Update(DB_TABLE_ROSTER_MEMBER_STATUS,
            "status_order   = ".intval($newMemberStatusOrderArray[$x][1]).",
            text_color      = '".$tp->toDB($textColor[$x])."'
            WHERE status_id = ".intval($newMemberStatusOrderArray[$x][0]));

    }

    header("Location: admin_custom_content.php");
    exit;

} else if ($_GET['delete_member_status'] == '1') {

    // Verify deletion

    $text = "
    <center>
        <p>
            ".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_EDIT_DELETE_MEMBER_STATUS_CONFIRM."
        </p>
        <p>
            <table width='100'>
                <tr>
                    <td>
                        <a href='admin_custom_content_edit.php?delete_member_status=2&status_id=".$_GET['status_id']."&status_name=".$_GET['status_name']."'>".LAN_JBROSTER_GENERAL_YES."</a>
                    </td>
                    <td>
                        <a href='admin_custom_content.php'>".LAN_JBROSTER_GENERAL_NO."</a>
                    </td>
                </tr>
            </table>
        </p>
    </center>";

    $title = "<b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_EDIT_DELETE_MEMBER_STATUS."</b>";
    $ns->tablerender($title, $text);

} else if ($_GET['delete_member_status'] == '2') {

    // Delete Leader Status

	$sql->db_Delete(DB_TABLE_ROSTER_MEMBER_STATUS,
        "status_id = ".intval($_GET['status_id']));

    // Change Member Status to 'None'
    $sql->db_Update(DB_TABLE_ROSTER_MEMBERS,
    	"member_status         = 'None'
    	WHERE member_status    = '".$tp->toDB($_GET['status_name'])."'");

	// Change Lead Status to 'None'
    $sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
    	"attribute_value   = 'None'
    	WHERE attribute_id = 3");

    header("Location: admin_custom_content.php");
    exit;

} else if ($_POST['add_member_attribute'] == '1') {

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

        $sql->db_Select(DB_TABLE_ROSTER_MEMBERS);
        while ($row = $sql->db_Fetch()) {
			$sql1 = new db;
	        $sql1->db_Insert(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
    	        intval($row['member_id']).",
    			".intval($attributeId).",
    	        '".$tp->toDB($_POST['custom_attribute_name'])."',
    			'',
    			1,
    	        1,
    			1,
                1");
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
            ".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_EDIT_DELETE_MEMBER_ATTRIBUTE_CONFIRM."
        </p>
        <p>
            <table width='100'>
                <tr>
                    <td>
                        <a href='admin_custom_content_edit.php?delete_member_attribute=2&attribute_id=".$_GET['attribute_id']."&attribute_name=".$_GET['attribute_name']."'>".LAN_JBROSTER_GENERAL_YES."</a>
                    </td>
                    <td>
                        <a href='admin_custom_content.php'>".LAN_JBROSTER_GENERAL_NO."</a>
                    </td>
                </tr>
            </table>
        </p>
    </center>";

    $title = "<b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_EDIT_DELETE_MEMBER_ATTRIBUTE."</b>";
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
    	                    <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_EDIT_CURRENT_NAME.":</b>
    	                </td>
    	                <td>
    	                    $currentName
    	                </td>
    	            </tr>
    	            <tr>
    	                <td>
    						<b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_EDIT_NEW_NAME.":</b>
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
			    <input type='submit' class='button' value='".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_EDIT_RENAME_ATTRIBUTE."' />
            <p>
	    </center>
	</form>";

    $title = "<b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_EDIT_RENAME_ATTRIBUTE."</b>";
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

} else if ($_POST['add_organization_designation'] == '1') {

    // Add Organization Designation to db

    if ($_POST['custom_organization_designation'] == '') {
    	// Send back error
        header("Location: admin_custom_content.php?success_designation=0");
        exit;
    }

    if ($sql->db_Count(DB_TABLE_ROSTER_ORG_DESIGNATIONS, "(*)",
		"WHERE designation_name = '".$tp->toDB($_POST['custom_organization_designation'])."'") > 0) {
        // Do Nothing
        header("Location: admin_custom_content.php?success_designation=1");
        exit;
    } else {
        $sql->db_Insert(DB_TABLE_ROSTER_ORG_DESIGNATIONS,
            "'',
            '".$tp->toDB($_POST['custom_organization_designation'])."',
    		1");

        header("Location: admin_custom_content.php?success_designation=2");
        exit;
    }

} else if ($_POST['change_organization_designation'] == '1') {

    // Change Organization Designation order

    for ($x = 0; $x < count($_POST['designation_order']); $x++) {
        tokenizeArray($_POST['designation_order'][$x]);
        $newOrganizationDesignationOrderArray[$x] = $tokens;
    }

    for ($x = 0; $x < count($newOrganizationDesignationOrderArray); $x++) {

        $sql->db_Update(DB_TABLE_ROSTER_ORG_DESIGNATIONS,
            "designation_order      = ".intval($newOrganizationDesignationOrderArray[$x][1])."
            WHERE designation_id    = ".intval($newOrganizationDesignationOrderArray[$x][0]));

    }

    header("Location: admin_custom_content.php");
    exit;

} else if ($_GET['delete_organization_designation'] == '1') {

    // Verify deletion

    $text = "
    <center>
        <p>
            ".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_EDIT_DELETE_ORG_DESIGNATION_CONFIRM."
        </p>
        <p>
            <table width='100'>
                <tr>
                    <td>
                        <a href='admin_custom_content_edit.php?delete_organization_designation=2&designation_id=".$_GET['designation_id']."&designation_name=".$_GET['designation_name']."'>".LAN_JBROSTER_GENERAL_YES."</a>
                    </td>
                    <td>
                        <a href='admin_custom_content.php'>".LAN_JBROSTER_GENERAL_NO."</a>
                    </td>
                </tr>
            </table>
        </p>
    </center>";

    $title = "<b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_EDIT_DELETE_ORG_DESIGNATION."</b>";
    $ns->tablerender($title, $text);

} else if ($_GET['delete_organization_designation'] == '2') {

	// Delete Organization Designation from tables

    $sql->db_Delete(DB_TABLE_ROSTER_ORG_DESIGNATIONS,
        "designation_id = ".intval($_GET['designation_id']));

    header("Location: admin_custom_content.php");
    exit;

} else if ($_POST['add_unit_designation'] == '1') {

    // Add Organization Unit Designation to db

    if ($_POST['custom_unit_designation_name'] == '') {
    	// Send back error
        header("Location: admin_custom_content.php?success_designation=0");
        exit;
    }

    if ($sql->db_Count(DB_TABLE_ROSTER_ORG_UNIT_DESIGNATIONS, "(*)",
		"WHERE designation_name = '".$tp->toDB($_POST['custom_unit_designation_name'])."'") > 0) {
        // Do Nothing

        header("Location: admin_custom_content.php?success_designation=1");
        exit;

    } else {

        $sql->db_Insert(DB_TABLE_ROSTER_ORG_UNIT_DESIGNATIONS,
            "'',
            '".$tp->toDB($_POST['custom_unit_designation_name'])."',
    		1");

        header("Location: admin_custom_content.php?success_designation=2");
        exit;
    }

} else if ($_POST['change_unit_designation'] == '1') {

    // Change Organization Unit Designation order

    for ($x = 0; $x < count($_POST['designation_order']); $x++) {
        tokenizeArray($_POST['designation_order'][$x]);
        $newUnitDesignationOrderArray[$x] = $tokens;
    }

    for ($x = 0; $x < count($newUnitDesignationOrderArray); $x++) {

        $sql->db_Update(DB_TABLE_ROSTER_ORG_UNIT_DESIGNATIONS,
            "designation_order      = ".intval($newUnitDesignationOrderArray[$x][1])."
            WHERE designation_id    = ".intval($newUnitDesignationOrderArray[$x][0]));

    }

    header("Location: admin_custom_content.php");
    exit;

} else if ($_GET['delete_unit_designation'] == '1') {

    // Verify deletion

    $text = "
    <center>
        <p>
            ".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_EDIT_DELETE_UNIT_DESIGNATION_CONFIRM."
        </p>
        <p>
            <table width='100'>
                <tr>
                    <td>
                        <a href='admin_custom_content_edit.php?delete_unit_designation=2&designation_id=".$_GET['designation_id']."&designation_name=".$_GET['designation_name']."'>".LAN_JBROSTER_GENERAL_YES."</a>
                    </td>
                    <td>
                        <a href='admin_custom_content.php'>".LAN_JBROSTER_GENERAL_NO."</a>
                    </td>
                </tr>
            </table>
        </p>
    </center>";

    $title = "<b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_EDIT_DELETE_UNIT_DESIGNATION."</b>";
    $ns->tablerender($title, $text);

} else if ($_GET['delete_unit_designation'] == '2') {

    // Delete Organization Unit Designation from tables

    $sql->db_Delete(DB_TABLE_ROSTER_ORG_UNIT_DESIGNATIONS,
        "designation_id = ".intval($_GET['designation_id']));

    header("Location: admin_custom_content.php");
    exit;

} else if ($_POST['add_color'] == '1') {

    // Add Color to db

    if ($_POST['new_color_name'] == '') {
    	// Send back error
        header("Location: admin_custom_content.php?success_color=0");
        exit;
    }

    if ($_POST['new_hex_code'] == '') {
    	// Send back error
        header("Location: admin_custom_content.php?success_color=1");
        exit;
    }

    if ($sql->db_Count(DB_TABLE_ROSTER_TEXT_COLORS, "(*)",
	   "WHERE  hex_code = '".$tp->toDB($_POST['new_hex_code'])."'") > 0) {
        // Do Nothing

        header("Location: admin_custom_content.php?success_color=2");
        exit;

    } else {

        $sql->db_Insert(DB_TABLE_ROSTER_TEXT_COLORS,
            "'',
            '".$tp->toDB($_POST['new_color_name'])."',
            '".$tp->toDB($_POST['new_hex_code'])."',
            1");

        header("Location: admin_custom_content.php?success_color=3");
        exit;
    }

} else if ($_POST['change_colors'] == '1') {

    // Change Color order

    for ($x = 0; $x < count($_POST['color_order']); $x++) {
        tokenizeArray($_POST['color_order'][$x]);
        $newColorOrderArray[$x] = $tokens;
    }

    for ($x = 0; $x < count($newColorOrderArray); $x++) {

        $sql->db_Update(DB_TABLE_ROSTER_TEXT_COLORS,
            "color_order    = ".intval($newColorOrderArray[$x][1])."
            WHERE color_id  = ".intval($newColorOrderArray[$x][0]));

    }

    header("Location: admin_custom_content.php");
    exit;

} else if ($_GET['delete_color'] == '1') {

    // Verify deletion

    $text = "
    <center>
        <p>
            ".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_EDIT_DELETE_COLOR_CONFIRM."
        </p>
        <p>
            <table width='100'>
                <tr>
                    <td>
                        <a href='admin_custom_content_edit.php?delete_color=2&color_id=".$_GET['color_id']."&color_hex_code=".$row2['color_hex_code']."'>".LAN_JBROSTER_GENERAL_YES."</a>
                    </td>
                    <td>
                        <a href='admin_custom_content.php'>".LAN_JBROSTER_GENERAL_NO."</a>
                    </td>
                </tr>
            </table>
        </p>
    </center>";

    $title = "<b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_EDIT_DELETE_COLOR."</b>";
    $ns->tablerender($title, $text);

} else if ($_GET['delete_color'] == '2') {

	// Delete Color from tables

    $sql->db_Delete(DB_TABLE_ROSTER_TEXT_COLORS,
        "color_id = ".intval($_GET['color_id']));

    $sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES,
        "text_color         = '#FFFFFF'
        WHERE text_color    = '".$tp->toDB($_GET['color_hex_code'])."'
        OR  text_color      = '#".$tp->toDB($_GET['color_hex_code'])."'");

    $sql->db_Update(DB_TABLE_ROSTER_GAMES,
        "text_color         = '#FFFFFF'
        WHERE text_color    = '".$tp->toDB($_GET['color_hex_code'])."'
        OR  text_color      = '#".$tp->toDB($_GET['color_hex_code'])."'");

    $sql->db_Update(DB_TABLE_ROSTER_LEADER_STATUS,
        "text_color         = '#FFFFFF'
        WHERE text_color    = '".$tp->toDB($_GET['color_hex_code'])."'
        OR  text_color      = '#".$tp->toDB($_GET['color_hex_code'])."'");

    $sql->db_Update(DB_TABLE_ROSTER_MEMBER_STATUS,
        "text_color         = '#FFFFFF'
        WHERE text_color    = '".$tp->toDB($_GET['color_hex_code'])."'
        OR  text_color      = '#".$tp->toDB($_GET['color_hex_code'])."'");

    $sql->db_Update(DB_TABLE_ROSTER_TEAM_MEMBERS,
        "text_color         = '#FFFFFF'
        WHERE text_color    = '".$tp->toDB($_GET['color_hex_code'])."'
        OR  text_color      = '#".$tp->toDB($_GET['color_hex_code'])."'");

    $sql->db_Update(DB_TABLE_ROSTER_TEAM_STATUS,
        "text_color         = '#FFFFFF'
        WHERE text_color    = '".$tp->toDB($_GET['color_hex_code'])."'
        OR  text_color      = '#".$tp->toDB($_GET['color_hex_code'])."'");

    $sql->db_Update(DB_TABLE_ROSTER_TEAMS,
        "text_color         = '#FFFFFF'
        WHERE text_color    = '".$tp->toDB($_GET['color_hex_code'])."'
        OR  text_color      = '#".$tp->toDB($_GET['color_hex_code'])."'");

    header("Location: admin_custom_content.php");
    exit;
}

require_once(e_ADMIN."footer.php");

?>