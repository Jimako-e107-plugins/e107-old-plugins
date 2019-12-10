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

if ($_POST['roster_display'] == 1) {

    /******************************************************************************************
    *
    * Choose which teams are displayed on the roster.
    * Reset all display values to 1 (off) then set diplay to 2 (on) only for what has been checked.
    *
    ******************************************************************************************/

    for ($x = 0; $x < count($_POST['team_display']); $x++) {
        tokenizeArray($_POST['team_display'][$x]);
        $newteamDisplayArray[$x] = $tokens;
    }

    $sql->db_Update(DB_TABLE_ROSTER_TEAMS,
        "display = 1");

    for ($x = 0; $x < count($newteamDisplayArray); $x++) {

        $sql->db_Update(DB_TABLE_ROSTER_TEAMS,
            "display        = 2
            WHERE team_name = '".$tp->toDB($newteamDisplayArray[$x][0])."'
            AND game_name   = '".$tp->toDB($newteamDisplayArray[$x][1])."'");

    }

    /******************************************************************************************
    *
    * Choose which member statuses are displayed on the roster.
    * Reset all display values to 1 (off) then set diplay to 2 (on) only for what has been checked.
    *
    ******************************************************************************************/

    foreach ($_POST['status_display'] as $value) {
        //tokenizeArray($_POST['team_display'][$x]);
        $newStatusDisplayArray[] = mysql_real_escape_string($value);
    }

    $sql->db_Update(DB_TABLE_ROSTER_MEMBER_STATUS,
        "display = 1");

    for ($x = 0; $x < count($newStatusDisplayArray); $x++) {

        $sql->db_Update(DB_TABLE_ROSTER_MEMBER_STATUS,
            "display            = 2
            WHERE status_name   = '".$tp->toDB($newStatusDisplayArray[$x])."'");
    }

    /**********************************************************************
    *
    * Choose which attributes are displayed on the main roster page.
    *
    **********************************************************************/

    foreach ($_POST['attribute_main_display'] as $value) {
        $newRosterAttributeDisplayArray[] = $value;
    }

    $sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES,
        "main_display = 1");

    $sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
        "main_display = 1");

    for ($x = 0; $x < count($newRosterAttributeDisplayArray); $x++) {

        $sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES,
            "main_display       = 2
            WHERE attribute_id  = ".intval($newRosterAttributeDisplayArray[$x]));

        $sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
            "main_display       = 2
            WHERE attribute_id  = ".intval($newRosterAttributeDisplayArray[$x]));
    }

    /**********************************************************************
    *
    * Choose which attributes are displayed on the profile page.
    *
    **********************************************************************/

    foreach ($_POST['attribute_display'] as $value) {
        $newProfileAttributeDisplayArray[] = mysql_real_escape_string($value);
    }

    $sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES,
        "profile_display = 1");

    $sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
        "profile_display = 1");

    for ($x = 0; $x < count($newProfileAttributeDisplayArray); $x++) {

        $sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES,
            "profile_display    = 2
            WHERE attribute_id  = ".intval($newProfileAttributeDisplayArray[$x]));

        $sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
            "profile_display    = 2
            WHERE attribute_id  = ".intval($newProfileAttributeDisplayArray[$x]));
    }
}

header("Location: admin_display_options.php");
exit;

require_once(e_ADMIN."footer.php");

?>
