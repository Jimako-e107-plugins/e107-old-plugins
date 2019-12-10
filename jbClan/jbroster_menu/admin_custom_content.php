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

$pageid = "admin_menu_09";

$sql->db_Select(DB_TABLE_ROSTER_PREFERENCES, "*", "organization_id = 1");
while ($row = $sql->db_Fetch()) {
	$organizationType = $row['organization_type'];
}

$text = "
<center>
    <p>
        <div style='width:90%'>
            <form method='POST' action='admin_custom_content_edit.php'>
                <table border='1' style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td colspan='6' class='forumheader'>
                            <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_CREATE_LEADER_STATUS."</b>
                        </td>
                    </tr>";

        			if ($_GET['success_leader'] == '2') {
        				$text .= "
        				<tr>
        					<td colspan='6' class='forumheader3'>
        						<center>
            						<p>
            						    <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_LEADER_STATUS_SUCCESS."</b>
                                    </p>
        						</center>
        					</td>
        				</tr>";
        			} else if ($_GET['success_leader'] == '1') {
        				$text .= "
        				<tr>
        					<td colspan='6' class='forumheader3'>
        						<center>
            						<p>
            						    <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_LEADER_STATUS_IN_SYSTEM."</b>
                                    </p>
        						</center>
        					</td>
        				</tr>";
        			} else if ($_GET['success_leader'] == '0') {
        				$text .= "
        				<tr>
        					<td colspan='6' class='forumheader3'>
        						<center>
            						<p>
            						    <b>".LAN_JBROSTER_GENERAL_ENTER_STATUS_NAME."</b>
                                    </p>
        						</center>
        					</td>
        				</tr>";
        			}

        			$text .= "
                    <tr>
                        <td width='20%' class='forumheader3'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_STATUS_NAME."</b>
                            </center>
                        </td>
                        <td width='20%' class='forumheader3'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_DISPLAY_COLOR."</b>
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td width='20%' class='forumheader3'>
                            <center>
                                <input class='tbox' name='leader_status_name' type='text' value='' maxlength='25' size='25' />
                            </center>
                        </td>
                        <td width='20%' class='forumheader3'>
                            <center>
                                <select class='tbox' name='text_color'>";

                                    $sql->db_Select(DB_TABLE_ROSTER_TEXT_COLORS, "*", "ORDER BY color_order", "no-where");
                                    while ($row = $sql->db_Fetch()) {
                                        $text .= "
                                        <option style='background-color: ".$row['hex_code']."' value='".$row['hex_code']."'>".$row['color_name']."</option>";
                                    }

                                $text .= "
                                </select>
                            </center>
                        </td>
                    </tr>
                </table>
                <center>
                    <p>
                        <input type='hidden' name='add_leader_status' value='1' />
                        <input class='button' type='submit' value='".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_ADD_STATUS."' />
                    </p>
                </center>
            </form>
        </div>
    </p>
</center>

<center>
    <p>
        <div style='width:90%'>
            <form method='POST' action='admin_custom_content_edit.php'>
                <table border='1' style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td colspan='6' class='forumheader'>
                            <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_CURRENT_LEADER_STATUSES."</b>
                        </td>
                    </tr>
                    <tr>
                        <td class='forumheader3' width='25%'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_STATUS_NAME."</b>
                            </center>
                        </td>
                        <td class='forumheader3' width='25%'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_DISPLAY_COLOR."</b>
                            </center>
                        </td>
                        <td class='forumheader3' width='25%'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_ORDER."</b>
                            </center>
                        </td>
                        <td class='forumheader3' width='25%'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_DELETE."</b>
                            </center>
                        </td>
                    </tr>";

        			$numRows = $sql->db_Count(DB_TABLE_ROSTER_LEADER_STATUS);
        			if ($numRows == 0) {
        			    $text .= "
        				<tr>
        					<td colspan='10' class='forumheader3'>
        						<center>
        							<p>
        							    ".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_NO_LEADER_STATUS_IN_SYSTEM."
        							</p>
        						</center>
        					</td>
        				</tr>";
        			} else {
        				// Do Nothing
        			}

                    $sql->db_Select(DB_TABLE_ROSTER_LEADER_STATUS, "*", "ORDER BY status_order", "no-where");
                    while ($row = $sql->db_Fetch()) {
                        $text .= "
                        <tr>
                        <td class='forumheader3' width='25%'>
                            <center>
                                ".$row['status_name']."
                            </center>
                        </td>
                        <td class='forumheader3' width='25%'>
                            <center>
                                <select class='tbox' name='text_color[]'>";

                                $sql1 = new db;
                                $sql1->db_Select(DB_TABLE_ROSTER_TEXT_COLORS, "*", "ORDER BY color_order", "no-where");
                                while ($row1 = $sql1->db_Fetch()) {
                                    if ($row['text_color'] == $row1['hex_code']) {
                                        $text .= "
                                        <option style='background-color: ".$row1['hex_code'].";' value='".$row1['hex_code']."' selected='selected'>".$row1['color_name']."</option>";
                                    } else {
                                        $text .= "
                                        <option style='background-color: ".$row1['hex_code'].";' value='".$row1['hex_code']."'>".$row1['color_name']."</option>";
                                    }
                                }

                                $text .= "
                                </select>
                            </center>
                        </td>
                        <td class='forumheader3' width='25%'>
                            <center>
                                <select class='tbox' name='status_order[]'>";

                                $num_rows = $sql1->db_Count(DB_TABLE_ROSTER_LEADER_STATUS);
                                $count = 1;
                                while ($count <= $num_rows) {
                                    if ($row['status_order'] == $count) {
                                        $text .= "
                                        <option value='".$row['status_id'].DELIMITER_1.$count."' selected='selected'>".$count."</option>";
                                    } else {
                                        $text .= "
                                        <option value='".$row['status_id'].DELIMITER_1.$count."'>".$count."</option>";
                                    }
                                    $count++;
                                }

                                $text .= "
                                </select>
                            </center>
                        </td>
                        <td class='forumheader3' width='25%'>
                            <center>";

                            if ($row['status_id'] > 4) {
                            	$text .= "
                                <a href='admin_custom_content_edit.php?delete_leader_status=1&status_id=".$row['status_id']."&status_name=".$row['status_name']."'><img src='".ADMIN_DELETE_ICON_PATH."' /></a>";
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
            			<input type='hidden' name='change_leader_status' value='1' />
            			<input class='button' type='submit' value='".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_CHANGE_ATTRIBUTES."' />
        			</p>";
        		}

            $text .= "
            </form>
        </div>
    </p>
</center>";

$title = "<b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_LEADER_STATUSES."</b>";
$ns->tablerender($title, $text);

// NEW SECTION, NEW SECTION, NEW SECTION, NEW SECTION, NEW SECTION
// NEW SECTION, NEW SECTION, NEW SECTION, NEW SECTION, NEW SECTION

$text = "
<center>
    <p>
        <div style='width:90%'>
            <form method='POST' action='admin_custom_content_edit.php'>
                <table border='1' style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td colspan='6' class='forumheader'>
                            <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_CREATE_MEMBER_STATUS."</b>
                        </td>
                    </tr>";

        			if ($_GET['success_member'] == '2') {
        				$text .= "
        				<tr>
        					<td colspan='6' class='forumheader3'>
        						<center>
            						<p>
            						    <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_MEMBER_STATUS_SUCCESS."</b>
                                    </p>
        						</center>
        					</td>
        				</tr>";
        			} else if ($_GET['success_member'] == '1') {
        				$text .= "
        				<tr>
        					<td colspan='6' class='forumheader3'>
        						<center>
                                    <p>
        						        <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_MEMBER_STATUS_IN_SYSTEM."</b>
                                    </p>
        						</center>
        					</td>
        				</tr>";
        			} else if ($_GET['success_member'] == '0') {
        				$text .= "
        				<tr>
        					<td colspan='6' class='forumheader3'>
        						<center>
                                    <p>
        						        <b>".LAN_JBROSTER_GENERAL_ENTER_STATUS_NAME."</b>
                                    <p>
        						</center>
        					</td>
        				</tr>";
        			}

        			$text .= "
                    <tr>
                        <td width='20%' class='forumheader3'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_STATUS_NAME."</b>
                            </center>
                        </td>
                        <td width='20%' class='forumheader3'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_DISPLAY_COLOR."</b>
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td width='20%' class='forumheader3'>
                            <center>
                                <input class='tbox' name='member_status_name' type='text' value='' maxlength='25' size='25' />
                            </center>
                        </td>
                        <td width='20%' class='forumheader3'>
                            <center>
                                <select class='tbox' name='text_color'>";

                                    $sql->db_Select(DB_TABLE_ROSTER_TEXT_COLORS, "*", "ORDER BY color_order", "no-where");
                                    while ($row = $sql->db_Fetch()) {
                                        $text .= "
                                        <option style='background-color: ".$row['hex_code']."' value='".$row['hex_code']."'>".$row['color_name']."</option>";
                                    }

                                    $text .= "
                                </select>
                            </center>
                        </td>
                    </tr>
                </table>
                <center>
                    <p>
                        <input type='hidden' name='add_member_status' value='1' />
                        <input type='submit' class='button' value='".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_ADD_STATUS."' />
                    </p>
                </center>
            </form>
        </div>
    </p>
</center>

<center>
    <p>
        <div style='width:90%'>
            <form method='POST' action='admin_custom_content_edit.php'>
                <table border='1' style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td colspan='6' class='forumheader'>
                            <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_CURRENT_MEMBER_STATUSES."</b>
                        </td>
                    </tr>
                    <tr>
                        <td class='forumheader3' width='25%'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_STATUS_NAME."</b>
                            </center>
                        </td>
                        <td class='forumheader3' width='25%'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_DISPLAY_COLOR."</b>
                            </center>
                        </td>
                        <td class='forumheader3' width='25%'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_ORDER."</b>
                            </center>
                        </td>
                        <td class='forumheader3' width='25%'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_DELETE."</b>
                            </center>
                        </td>
                    </tr>";

        			$numRows = $sql->db_Count(DB_TABLE_ROSTER_MEMBER_STATUS);
        			if ($numRows == 0) {
        				$text .= "
        				<tr>
        					<td colspan='10' class='forumheader3'>
        						<center>
        							<p>
        							    ".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_NO_MEMBER_STATUS_IN_SYSTEM."
                                    </p>
        						</center>
        					</td>
        				</tr>";
        			} else {
        				// Do Nothing
        			}

                    $sql->db_Select(DB_TABLE_ROSTER_MEMBER_STATUS, "*", "ORDER BY status_order", "no-where");
                    while ($row = $sql->db_Fetch()) {
                        $text .= "
                        <tr>
                            <td class='forumheader3' width='25%'>
                                <center>
                                    ".$row['status_name']."
                                </center>
                            </td>
                            <td class='forumheader3' width='25%'>
                                <center>
                                    <select class='tbox' name='text_color[]'>";

                                    $sql1 = new db;
                                    $sql1->db_Select(DB_TABLE_ROSTER_TEXT_COLORS, "*", "ORDER BY color_order", "no-where");
                                    while ($row1 = $sql1->db_Fetch()) {
                                        if ($row['text_color'] == $row1['hex_code']) {
                                            $text .= "
                                            <option style='background-color: ".$row1['hex_code'].";' value='".$row1['hex_code']."' selected='selected'>".$row1['color_name']."</option>";
                                        } else {
                                            $text .= "
                                            <option style='background-color: ".$row1['hex_code'].";' value='".$row1['hex_code']."'>".$row1['color_name']."</option>";
                                        }
                                    }

                                    $text .= "
                                    </select>
                                </center>
                            </td>
                            <td class='forumheader3' width='25%'>
                                <center>
                                    <select class='tbox' name='status_order[]'>";

                                    $num_rows = $sql1->db_Count(DB_TABLE_ROSTER_MEMBER_STATUS);
                                    $count = 1;
                                    while ($count <= $num_rows) {
                                        if ($row['status_order'] == $count) {
                                            $text .= "
                                            <option value='".$row['status_id'].DELIMITER_1.$count."' selected='selected'>".$count."</option>";
                                        } else {
                                            $text .= "
                                            <option value='".$row['status_id'].DELIMITER_1.$count."'>".$count."</option>";
                                        }
                                        $count++;
                                    }

                                    $text .= "
                                    </select>
                                </center>
                            </td>
                            <td class='forumheader3' width='25%'>
                                <center>";

                                if ($row['status_id'] > 8) {
                                	$text .= "
                                    <a href='admin_custom_content_edit.php?delete_member_status=1&status_id=".$row['status_id']."&status_name=".$row['status_name']."'><img src='".ADMIN_DELETE_ICON_PATH."' /></a>";
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
            			<input type='hidden' name='change_member_status' value='1' />
            			<input class='button' type='submit' value='".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_CHANGE_ATTRIBUTES."' />
        			</p>";
        		}

            $text .= "
            </form>
        </div>
    </p>
</center>";

$title = "<b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_MEMBER_STATUSES."</b>";
$ns->tablerender($title, $text);

// NEW SECTION, NEW SECTION, NEW SECTION, NEW SECTION, NEW SECTION
// NEW SECTION, NEW SECTION, NEW SECTION, NEW SECTION, NEW SECTION

$text = "
<center>
    <p>
        <div style='width:60%'>
            <form method='POST' action='admin_custom_content_edit.php'>
                <table border='1' style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td colspan='6' class='forumheader'>
                            <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_CREATE_MEMBER_ATTRIBUTE."</b>
                        </td>
                    </tr>";

        			if ($_GET['success_attribute'] == '2') {
        				$text .= "
        				<tr>
        					<td colspan='6' class='forumheader3'>
        						<center>
            						<p>
            						    <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_MEMBER_ATTRIBUTE_SUCCESS."</b>
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
            						    <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_MEMBER_ATTRIBUTE_IN_SYSTEM."</b>
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
        						        <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_ENTER_ATTRIBUTE_NAME."</b>
                                    </p>
        						</center>
        					</td>
        				</tr>";
        			}

        			$text .= "
                    <tr>
                        <td width='20%' class='forumheader3'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_ATTRIBUTE_NAME."</b>
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
                        <input type='submit' class='button' value='".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_ADD_ATTRIBUTE."' />
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
                            <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_CURRENT_MEMBER_ATTRIBUTES."</b>
                        </td>
                    </tr>
                    <tr>
                        <td class='forumheader3' width='25%'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_ATTRIBUTE_NAME."</b>
                            </center>
                        </td>
                        <td class='forumheader3' width='25%'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_ORDER."</b>
                            </center>
                        </td>
                        <td class='forumheader3' width='25%'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_EDIT."</b>
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
        							    ".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_NO_MEMBER_ATTRIBUTES_IN_SYSTEM."
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
            			<input type='submit' class='button' value='".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_CHANGE_ATTRIBUTES."' />
                    </p>";
        		}

            $text .= "
            </form>
        </div>
    </p>
</center>";

$title = "<b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_CUSTOM_MEMBER_ATTRIBUTES."</b>";
$ns->tablerender($title, $text);

// NEW SECTION, NEW SECTION, NEW SECTION, NEW SECTION, NEW SECTION
// NEW SECTION, NEW SECTION, NEW SECTION, NEW SECTION, NEW SECTION

$text = "
<center>
    <p>
        <div style='width:60%'>
            <form method='POST' action='admin_custom_content_edit.php'>
                <table border='1' style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td colspan='6' class='forumheader'>
                            <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_CREATE_ORG_DESIGNATION."</b>
                        </td>
                    </tr>";

        			if ($_GET['success_designation'] == '2') {
        				$text .= "
        				<tr>
        					<td colspan='6' class='forumheader3'>
        						<center>
        						    <p>
        						        <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_ORG_DESIGNATION_SUCCESS."</b>
                                    </p>
        						</center>
        					</td>
        				</tr>";
        			} else if ($_GET['success_designation'] == '1') {
        				$text .= "
        				<tr>
        					<td colspan='6' class='forumheader3'>
        						<center>
        						    <p>
        						        <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_ORG_DESIGNATION_IN_SYSTEM."</b>
        					        </p>
        						</center>
        					</td>
        				</tr>";
        			} else if ($_GET['success_designation'] == '0') {
        				$text .= "
        				<tr>
        					<td colspan='6' class='forumheader3'>
        						<center>
        						    <p>
        						        <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_ENTER_ORG_DESIGNATION."</b>
        					        </p>
        						</center>
        					</td>
        				</tr>";
        			}

        			$text .= "
                    <tr>
                        <td width='20%' class='forumheader3'>
                            <center>
                                <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_DESIGNATION_NAME."</b>
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td width='20%' class='forumheader3'>
                            <center>
                                <input type='text' class='tbox' name='custom_organization_designation' type='text' value='' maxlength='25' size='25' />
                            </center>
                        </td>
                    </tr>
                </table>
                <center>
                    <p>
                        <input type='hidden' name='add_organization_designation' value='1' />
                        <input type='submit' class='button' value='".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_ADD_DESIGNATION."' />
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
                        <td colspan='6' class='forumheader'>
                            <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_CURRENT_ORG_DESIGNATION."</b>
                        </td>
                    </tr>
                    <tr>
                        <td class='forumheader3' width='25%'>
                            <center>
                                <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_DESIGNATION_NAME."</b>
                            </center>
                        </td>
                        <td class='forumheader3' width='25%'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_ORDER."</b>
                            </center>
                        </td>
                        <td class='forumheader3' width='25%'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_DELETE."</b>
                            </center>
                        </td>
                    </tr>";

        			$numRows = $sql->db_Count(DB_TABLE_ROSTER_ORG_DESIGNATIONS);
        			if ($numRows == 0) {
        				$text .= "
        				<tr>
        					<td colspan='10' class='forumheader3'>
        						<center>
        							<p>
        							    ".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_NO_ORG_DESIGNATION_IN_SYSTEM."
        							</p>
        						</center>
        					</td>
        				</tr>";
        			} else {
        				// Do Nothing
        			}

                    $sql->db_Select(DB_TABLE_ROSTER_ORG_DESIGNATIONS, "*", "ORDER BY designation_order", "no-where");
                    while ($row = $sql->db_Fetch()) {
                        $text .= "
                        <tr>
                        <td class='forumheader3' width='25%'>
                            <center>
                                ".$row['designation_name']."
                            </center>
                        </td>
                        <td class='forumheader3' width='25%'>
                            <center>
                                <select class='tbox' name='designation_order[]'>";

                                $num_rows = $sql1->db_Count(DB_TABLE_ROSTER_ORG_DESIGNATIONS);
                                $count = 1;
                                while ($count <= $num_rows) {
                                    if ($row['designation_order'] == $count) {
                                        $text .= "
                                        <option value='".$row['designation_id'].DELIMITER_1.$count."' selected='selected'>".$count."</option>";
                                    } else {
                                        $text .= "
                                        <option value='".$row['designation_id'].DELIMITER_1.$count."'>".$count."</option>";
                                    }
                                    $count++;
                                }

                                $text .= "
                                </select>
                            </center>
                        </td>
                        <td class='forumheader3' width='25%'>
                            <center>";

                            if ($row['designation_id'] > 5) {
                            	$text .= "
                                <a href='admin_custom_content_edit.php?delete_organization_designation=1&designation_id=".$row['designation_id']."&designation_name=".$row['designation_name']."'><img src='".ADMIN_DELETE_ICON_PATH."' /></a>";
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
            			<input type='hidden' name='change_organization_designation' value='1' />
            			<input type='submit' class='button' value='".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_CHANGE_DESIGNATIONS."' />
        			</p>";
        		}

        	$text .= "
            </form>
        </div>
    </p>
</center>";

$title = "<b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_CUSTOM_ORG_DESIGNATIONS."</b>";
$ns->tablerender($title, $text);

// NEW SECTION, NEW SECTION, NEW SECTION, NEW SECTION, NEW SECTION
// NEW SECTION, NEW SECTION, NEW SECTION, NEW SECTION, NEW SECTION

$text = "
<center>
    <p>
        <div style='width:60%'>
            <form method='POST' action='admin_custom_content_edit.php'>
                <table border='1' style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td colspan='6' class='forumheader'>
                            <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_CREATE_UNIT_DESIGNATIONS."</b>
                        </td>
                    </tr>";

        			if ($_GET['success_designation'] == '2') {
        				$text .= "
        				<tr>
        					<td colspan='6' class='forumheader3'>
        						<center>
        						    <p>
        						        <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_UNIT_DESIGNATION_SUCCESS."</b>
        						    </p>
        						</center>
        					</td>
        				</tr>";
        			} else if ($_GET['success_designation'] == '1') {
        				$text .= "
        				<tr>
        					<td colspan='6' class='forumheader3'>
        						<center>
                                    <p>
        						        <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_UNIT_DESIGNATION_IN_SYSTEM."</b>
                                    </p>
        						</center>
        					</td>
        				</tr>";
        			} else if ($_GET['success_designation'] == '0') {
        				$text .= "
        				<tr>
        					<td colspan='6' class='forumheader3'>
        						<center>
                                    <p>
        						        <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_ENTER_UNIT_DESIGNATION."</b>
                                    <p>
        						</center>
        					</td>
        				</tr>";
        			}

        			$text .= "
                    <tr>
                        <td width='20%' class='forumheader3'>
                            <center>
                                <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_DESIGNATION_NAME."</b>
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td width='20%' class='forumheader3'>
                            <center>
                                <input type='text' class='tbox' name='custom_unit_designation_name' value='' maxlength='25' size='25' />
                            </center>
                        </td>
                    </tr>
                </table>
                <center>
                    <p>
                        <input type='hidden' name='add_unit_designation' value='1' />
                        <input type='submit' class='button' value='".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_ADD_DESIGNATION."' />
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
                        <td colspan='6' class='forumheader'>
                            <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_CURRENT_UNIT_ORG_DESIGNATION."</b>
                        </td>
                    </tr>
                    <tr>
                        <td class='forumheader3' width='25%'>
                            <center>
                                <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_DESIGNATION_NAME."</b>
                            </center>
                        </td>
                        <td class='forumheader3' width='25%'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_ORDER."</b>
                            </center>
                        </td>
                        <td class='forumheader3' width='25%'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_DELETE."</b>
                            </center>
                        </td>
                    </tr>";

        			$numRows = $sql->db_Count(DB_TABLE_ROSTER_ORG_UNIT_DESIGNATIONS);
        			if ($numRows == 0) {
        				$text .= "
        				<tr>
        					<td colspan='10' class='forumheader3'>
        						<center>
        							<p>
        							    ".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_NO_UNIT_DESIGNATION_IN_SYSTEM."
        							</p>
        						</center>
        					</td>
        				</tr>";
        			} else {
        				// Do Nothing
        			}

                    $sql->db_Select(DB_TABLE_ROSTER_ORG_UNIT_DESIGNATIONS, "*", "ORDER BY designation_order", "no-where");
                    while ($row = $sql->db_Fetch()) {
                        $text .= "
                        <tr>
                            <td class='forumheader3' width='25%'>
                                <center>
                                    ".$row['designation_name']."
                                </center>
                            </td>
                            <td class='forumheader3' width='25%'>
                                <center>
                                    <select class='tbox' name='designation_order[]'>";

                                    $num_rows = $sql1->db_Count(DB_TABLE_ROSTER_ORG_UNIT_DESIGNATIONS);
                                    $count = 1;
                                    while ($count <= $num_rows) {
                                        if ($row['designation_order'] == $count) {
                                            $text .= "
                                            <option value='".$row['designation_id'].DELIMITER_1.$count."' selected='selected'>".$count."</option>";
                                        } else {
                                            $text .= "
                                            <option value='".$row['designation_id'].DELIMITER_1.$count."'>".$count."</option>";
                                        }
                                        $count++;
                                    }

                                    $text .= "
                                    </select>
                                </center>
                            </td>
                            <td class='forumheader3' width='25%'>
                                <center>";

                                if ($row['designation_id'] > 6) {
                                	$text .= "
                                    <a href='admin_custom_content_edit.php?delete_unit_designation=1&designation_id=".$row['designation_id']."&designation_name=".$row['designation_name']."'><img src='".ADMIN_DELETE_ICON_PATH."' /></a>";
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
            			<input type='hidden' name='change_unit_designation' value='1' />
            			<input type='submit' class='button' type='submit' value='".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_CHANGE_DESIGNATIONS."' />
        			</p>";
        		}

        	$text .= "
            </form>
        </div>
    </p>
</center>";

$title = "<b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_CUSTOM_UNIT_DESIGNATIONS."</b>";
$ns->tablerender($title, $text);

// NEW SECTION, NEW SECTION, NEW SECTION, NEW SECTION, NEW SECTION
// NEW SECTION, NEW SECTION, NEW SECTION, NEW SECTION, NEW SECTION

$text = "
<center>
    <p>
        <div style='width:80%'>
            <form method='POST' action='admin_custom_content_edit.php'>
                <table border='1' style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td colspan='6' class='forumheader'>
                            <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_ADD_COLOR."</b>
                        </td>
                    </tr>";

        			if ($_GET['success_color'] == '3') {
        				$text .= "
        				<tr>
        					<td colspan='6' class='forumheader3'>
        						<center>
        						    <p>
        						        <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_NEW_COLOR_SUCCESS."</b>
        						    </p>
        						</center>
        					</td>
        				</tr>";
        			} else if ($_GET['success_color'] == '2') {
        				$text .= "
        				<tr>
        					<td colspan='6' class='forumheader3'>
        						<center>
        						    <p>
        						        <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_COLOR_IN_SYSTEM."</b>
    						        </p>
        						</center>
        					</td>
        				</tr>";
        			} else if ($_GET['success_color'] == '1') {
        				$text .= "
        				<tr>
        					<td colspan='6' class='forumheader3'>
        						<center>
        						    <p>
        						        <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_ENTER_HEX_CODE."</b>
                                    </p>
        						</center>
        					</td>
        				</tr>";
        			} else if ($_GET['success_color'] == '0') {
        				$text .= "
        				<tr>
        					<td colspan='6' class='forumheader3'>
        						<center>
        						    <p>
        						        <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_ENTER_COLOR_NAME."</b>
                                    </p>
        						</center>
        					</td>
        				</tr>";
        			}

        			$text .= "
                    <tr>
                        <td width='50%' class='forumheader3'>
                            <center>
                                <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_COLOR_NAME."</b>
                            </center>
                        </td>
                        <td width='50%' class='forumheader3'>
                            <center>
                                <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_COLOR_HEX_CODE."</b>
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td width='50%' class='forumheader3'>
                            <center>
                                <input type='text' class='tbox' name='new_color_name' value='' maxlength='25' size='25' />
                            </center>
                        </td>
        				<td width='50%' class='forumheader3'>
                            <center>
                                <input type='text' class='tbox' name='new_hex_code' value='' maxlength='25' size='25' />
                            </center>
                        </td>
                    </tr>
                </table>
                <center>
                    <p>
                        <input type='hidden' name='add_color' value='1' />
                        <input class='button' type='submit' value='".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_ADD_COLOR."' />
                    </p>
                </center>
            </form>
        </div>
    </p>
</center>

<center>
    <p>
        <div style='width:80%'>
            <form method='POST' action='admin_custom_content_edit.php'>
                <table border='1' style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td colspan='6' class='forumheader'>
                            <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_CURRENT_COLORS."</b>
                        </td>
                    </tr>
                    <tr>
                        <td class='forumheader3' width='25%'>
                            <center>
                                <b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_COLOR_NAME."</b>
                            </center>
                        </td>
                        <td class='forumheader3' width='25%'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_DISPLAY_COLOR."</b>
                            </center>
                        </td>
                        <td class='forumheader3' width='25%'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_ORDER."</b>
                            </center>
                        </td>
                        <td class='forumheader3' width='25%'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_DELETE."</b>
                            </center>
                        </td>
                    </tr>";

        			$numRows = $sql->db_Count(DB_TABLE_ROSTER_TEXT_COLORS);
        			if ($numRows == 0) {
        				$text .= "
        				<tr>
        					<td colspan='10' class='forumheader3'>
        						<center>
        							<p>
        							    ".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_NO_COLORS_IN_SYSTEM."
        							</p>
        						</center>
        					</td>
        				</tr>";
        			} else {
        				// Do Nothing
        			}

                    $sql->db_Select(DB_TABLE_ROSTER_TEXT_COLORS, "*", "ORDER BY color_order", "no-where");
                    while ($row = $sql->db_Fetch()) {
                        $text .= "
                        <tr>
                            <td class='forumheader3' width='25%'>
                                <center>
                                    ".$row['color_name']."
                                </center>
                            </td>
                            <td class='forumheader3' width='25%'>
                                <center>
            						<div style='color: ".$row['hex_code']."; font-weight: bold'>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_DISPLAY_TEXT."</div>
                                </center>
                            </td>
                            <td class='forumheader3' width='25%'>
                                <center>
                                    <select class='tbox' name='color_order[]'>";

                                    $num_rows = $sql1->db_Count(DB_TABLE_ROSTER_TEXT_COLORS);
                                    $count = 1;
                                    while ($count <= $num_rows) {
                                        if ($row['color_order'] == $count) {
                                            $text .= "
                                            <option value='".$row['color_id'].DELIMITER_1.$count."' selected='selected'>".$count."</option>";
                                        } else {
                                            $text .= "
                                            <option value='".$row['color_id'].DELIMITER_1.$count."'>".$count."</option>";
                                        }
                                        $count++;
                                    }

                                    $text .= "
                                    </select>
                                </center>
                            </td>
                            <td class='forumheader3' width='25%'>
                                <center>";

                                if ($row['color_id'] > 11) {
                                	$text .= "
                                    <a href='admin_custom_content_edit.php?delete_color=1&color_id=".$row['color_id']."&color_hex_code=".$row['color_hex_code']."'><img src='".ADMIN_DELETE_ICON_PATH."' /></a>";
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
        			    <input type='hidden' name='change_colors' value='1' />
        			    <input class='button' type='submit' value='".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_CHANGE_COLORS."' />
        			</p>";
        		}

            $text .= "
            </form>
        </div>
    </p>
</center>";

$title = "<b>".LAN_JBROSTER_ADMIN_CUSTOM_CONTENT_DISPLAY_COLORS."</b>";
$ns->tablerender($title, $text);

require_once(e_ADMIN."footer.php");
?>