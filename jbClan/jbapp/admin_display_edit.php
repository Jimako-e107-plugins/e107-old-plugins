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

if(!getperms("P")){
    header("location:".e_HTTP."index.php");
    exit;
}

require_once(e_ADMIN."auth.php");
require_once("includes/config.functions.php");

if ($_POST['application_display'] == 1) {

    /**********************************************************************
    *
    * Choose which attributes are displayed on the application.
    *
    **********************************************************************/

    $sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES,
        "application_display = 1");

    for ($x = 0; $x < count($_POST['attribute_application_display']); $x++) {
        $sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES,
            "application_display    = 2
            WHERE attribute_id      = ".intval($_POST['attribute_application_display'][$x]));
    }
}

header("Location: admin_display_options.php");
exit;

require_once(e_ADMIN."footer.php");
?>
