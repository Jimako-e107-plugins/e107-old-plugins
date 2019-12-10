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

$pageid = "admin_menu_01";

$sql->db_Select(DB_TABLE_ROSTER_PREFERENCES);
while($row = $sql-> db_Fetch()){
    $organization_name = $row['organization_name'];
    $organization_type = $row['organization_type'];
    $organization_designation = $row['organization_designation'];
    $organization_unit_designation = $row['organization_unit_designation'];
    $organization_logo = $row['organization_logo'];
    $organization_logo_alignment = $row['organization_logo_alignment'];
}

$text .= "
<form method='POST' action='admin_config_edit.php'>
    <center>
        <p>
            <div style='width:80%'>
                <table border='0' style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td colspan='6' class='forumheader'>&nbsp;</td>
                    </tr>
        			<tr>
                        <td width='35%' style='border-right: 0px;' class='forumheader3'>
                            <p>
                                <b>".LAN_JBROSTER_ADMIN_CONFIG_ORG_NAME."</b>
                            </p>
                        </td>
                        <td width='65%' style='border-left: 0px;' class='forumheader3'>
                            <p>
                                <input class='tbox' name='organization_name' type='text' value='$organization_name' maxlength='25' size='25' />
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
        </p>
    </center>

    <center>
        <p>
            <div style='width:80%'>
                <table border='0' style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td colspan='6' class='forumheader'>&nbsp;</td>
                    </tr>
                    <tr>
        				<td width='35%' style='border-right: 0px;' class='forumheader3'>
                            <p>
    						    <b>".LAN_JBROSTER_ADMIN_CONFIG_ORG_LOGO."<b>
                            </p>
        				</td>
        				<td width='65%' style='border-left: 0px;' class='forumheader3'>
                            <p>
    						    ".e_PLUGIN."jbroster_menu/images/<input class='tbox' type='text' name='organization_logo' value='$organization_logo' size='10' />
    						</p>
        				</td>
        			</tr>
                </table>
            </div>
        </p>
    </center>

    <center>
        <p>
            <div style='width:80%'>
                <table border='0' style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td colspan='6' class='forumheader'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td width='35%' style='border-right: 0px;' class='forumheader3'>
                            <p>
                                <b>".LAN_JBROSTER_ADMIN_CONFIG_ORG_TYPE."</b>
                            </p>
                        </td>
                        <td width='65%' style='border-left: 0px;' class='forumheader3'>
                            <p>
                                <select class='tbox' name='organization_type'>";

                                $sql->db_Select(DB_TABLE_ROSTER_ORG_TYPES);
                                while ($row = $sql->db_Fetch()) {
                                    if ($organization_type == $row['organization_type']) {
                                        $text .= "
                                        <option value='".$row['organization_type']."' selected='selected'>".$row['organization_name']."</option>";
                                    } else {
                                        $text .= "
                                        <option value='".$row['organization_type']."'>".$row['organization_name']."</option>";
                                    }
                                }

                                $text .= "
                                </select>
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
        </p>
    </center>

	<center>
        <p>
            <div style='width:80%'>
                <table border='0' style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td colspan='6' class='forumheader'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td width='35%' style='border-right: 0px;' class='forumheader3'>
                            <p>
                                <b>".LAN_JBROSTER_ADMIN_CONFIG_ORG_DESIGNATION."</b>
                            </p>
                        </td>
                        <td width='65%' style='border-left: 0px;' class='forumheader3'>
                            <p>
                                <select class='tbox' name='organization_designation'>";

                                $sql->db_Select(DB_TABLE_ROSTER_ORG_DESIGNATIONS);
                                while ($row = $sql->db_Fetch()) {
                                    if ($organization_designation == $row['designation_id']) {
                                        $text .= "
                                        <option value='".$row['designation_id']."' selected='selected'>".$row['designation_name']."</option>";
                                    } else {
                                        $text .= "
                                        <option value='".$row['designation_id']."'>".$row['designation_name']."</option>";
                                    }
                                }

                                $text .= "
                                </select>
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
        </p>
    </center>

	<center>
        <p>
            <div style='width:80%'>
                <table border='0' style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td colspan='6' class='forumheader'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td width='35%' style='border-right: 0px;' class='forumheader3'>
                            <p>
                                <b>".LAN_JBROSTER_ADMIN_CONFIG_ORG_UNIT_DESIGNATION."</b>
                            </p>
                        </td>
                        <td width='65%' style='border-left: 0px;' class='forumheader3'>
                            <p>
                                <select class='tbox' name='organization_unit_designation'>";

                                $sql->db_Select(DB_TABLE_ROSTER_ORG_UNIT_DESIGNATIONS);
                                while ($row = $sql->db_Fetch()) {
                                    if ($organization_unit_designation == $row['designation_id']) {
                                        $text .= "
                                        <option value='".$row['designation_id']."' selected='selected'>".$row['designation_name']."</option>";
                                    } else {
                                        $text .= "
                                        <option value='".$row['designation_id']."'>".$row['designation_name']."</option>";
                                    }
                                }

                                $text .= "
                                </select>
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
        </p>
    </center>

    <center>
        <p>
            <input type='hidden' name='edit_preferences' value='1' />
            <input class='button' type='submit' value='".LAN_JBROSTER_GENERAL_APPLY_CHANGES."' />
        </p>
    </center>
</form>";

$title = "<b>".LAN_JBROSTER_GENERAL_ORG_PREFS."</b>";
$ns->tablerender($title, $text);

require_once(e_ADMIN."footer.php");
?>
