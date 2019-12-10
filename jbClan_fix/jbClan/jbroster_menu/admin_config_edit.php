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

require_once("includes/config.constants.php");
require_once("includes/config.functions.php");

$sql->db_Select(DB_TABLE_ROSTER_PREFERENCES);
while($row = $sql-> db_Fetch()){
    $organization_name              = $row['organization_name'];
    $organization_type              = $row['organization_type'];
    $organization_designation       = $row['organization_designation'];
    $organization_unit_designation  = $row['organization_unit_designation'];
    $organization_logo              = $row['organization_logo'];
}


if ($_POST['edit_preferences'] == '1') {

    /**********************************************************************
    *
    * Change Orginizations Name
    *
    **********************************************************************/

    if ($_POST['organization_name'] == $organization_name) {
        // Do nothing
    } else {
        // Change organization name
        $sql->db_Update(DB_TABLE_ROSTER_PREFERENCES,
            "organization_name      = '".$tp->toDB($_POST['organization_name'])."'
            WHERE organization_id   = 1");
    }

    /**********************************************************************
    *
    * Change Orginizations Logo
    *
    **********************************************************************/

    if ($_POST['organization_logo'] == $organization_logo) {
        // Do nothing
    } else {
        // Change organization logo
        $sql->db_Update(DB_TABLE_ROSTER_PREFERENCES,
            "organization_logo      = '".$tp->toDB($_POST['organization_logo'])."'
            WHERE organization_id   = 1");
    }

    /**********************************************************************
    *
    * Change Orginizations Logo Alignment
    *
    **********************************************************************/

    if ($_POST['organization_logo_alignment'] == $organization_logo_alignment) {
        // Do nothing
    } else {
        // Change organization logo alignment
        $sql->db_Update(DB_TABLE_ROSTER_PREFERENCES,
            "organization_logo_alignment    = '".$tp->toDB($_POST['organization_logo_alignment'])."'
            WHERE organization_id           = 1");
    }

    /**********************************************************************
    *
    * Change Orginizations Type
    *
    **********************************************************************/

    if ($_POST['organization_type'] == $organization_type) {
        // Do nothing
    } else {
        // Change organization type

        $sql->db_Update(DB_TABLE_ROSTER_PREFERENCES,
            "organization_type      = ".intval($_POST['organization_type'])."
            WHERE organization_id   = 1");

		$sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES,
            "main_display   = 1,
            profile_display = 1");

		$sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
            "main_display   = 1,
            profile_display = 1");
    }

    /**********************************************************************
    *
    * Change Orginizations Designation
    *
    **********************************************************************/

    if ($_POST['organization_designation'] == $organization_designation) {
        // Do nothing
    } else {
        // Change organization designation
        $sql->db_Update(DB_TABLE_ROSTER_PREFERENCES,
            "organization_designation   = ".intval($_POST['organization_designation'])."
            WHERE organization_id       = 1");
    }

    /**********************************************************************
    *
    * Change Orginizations Unit Designation
    *
    **********************************************************************/

    if ($_POST['organization_unit_designation'] == $organization_unit_designation) {
        // Do nothing
    } else {
        // Change unit designation
        $sql->db_Update(DB_TABLE_ROSTER_PREFERENCES,
            "organization_unit_designation  = ".intval($_POST['organization_unit_designation'])."
            WHERE organization_id           = 1");
    }

    header("Location: admin_config.php");
    exit;
} else {
    header("Location: admin_config.php");
    exit;
}

require_once(e_ADMIN."footer.php");
?>