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

if(file_exists(e_PLUGIN."jbapp/languages/".e_LANGUAGE.".php")){
	include_lan(e_PLUGIN."jbapp/languages/".e_LANGUAGE.".php");
}

require_once("includes/config.constants.php");

$pageid = "admin_menu_01";

$sql->db_Select("plugin", "*");
while($rows = $sql->db_Fetch()){
    if (($rows['plugin_name'] == "jbRoster") && ($rows['plugin_installflag'] == "1")) {
        $installed_jbroster = 1;
    }
}

if ($_POST['enter_data'] == 1) {
    $sql->db_Update(DB_TABLE_APP_INFO,
                      "organization_email       = '".$tp->toDB($_POST['organization_email'])."',
                       organization_disclaimer  = '".$tp->toDB($_POST['organization_disclaimer'])."'
                       WHERE organization_id    = 1");


    $sql->db_Update(DB_TABLE_ROSTER_PREFERENCES,
                      "organization_name        = '".$tp->toDB($_POST['organization_name'])."'
                       WHERE organization_id    = 1");

    header("Location: ".e_PAGE);
    exit;
} else {
    $sql->db_Select(DB_TABLE_ROSTER_PREFERENCES);
    while($row = $sql-> db_Fetch()){
        $organization_name = $row['organization_name'];
    }

    $sql->db_Select(DB_TABLE_APP_INFO);
    while ($row = $sql->db_Fetch()) {
        $organization_email         = $row['organization_email'];
        $organization_disclaimer    = $row['organization_disclaimer'];
    }

    $text = "
    <div style='width:100%'>
        <form action='".e_PAGE."' method='POST'>
            <table style='width:100%' cellspacing='0' cellpadding='0'>
                <tr>
                    <td>
                        <center>
    							<b>
    								* * * * * * * * * * * * * *
                                    <p>
    								    ".LAN_JBAPP_ADMIN_CONFIG_NOTICE_1."
    								</p>
    								<p>
    								    ".LAN_JBAPP_ADMIN_CONFIG_NOTICE_2."
                                    </p>
    								* * * * * * * * * * * * * *
    							</b>
							</p>";

                            if (!$installed_jbroster) {
                                $text .= "
                                <p>
                                    <b>".LAN_JBAPP_ADMIN_CONFIG_ORG_NAME."</b>
                                </p>
                                <p>
                                    <input class='tbox' type='text' name='organization_name' size='35' value='".$organization_name."'>
                                </p>";
                            }

                            $text .= "
                            <p>
                                <b>".LAN_JBAPP_ADMIN_CONFIG_INPUT_NAME_1."</b>
                            </p>
                            <p>
                                (".LAN_JBAPP_ADMIN_CONFIG_INPUT_CAPTION.")
                            </p>
                            <p>
                                <input class='tbox' type='text' name='organization_email' size='35' value='".$organization_email."'>
                            </p>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td>
                        <center>
                            <p>
                                <b>".LAN_JBAPP_ADMIN_CONFIG_INPUT_NAME_2."</b>
                            </p>
                            <p>
                                <textarea class='tbox' name='organization_disclaimer' rows='30' cols='80'>".$organization_disclaimer."</textarea>
                            </p>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td>
                        <center>
                            <p>
                                <input type='hidden' name='enter_data' value='1'>
                                <input class='button' type='submit' value='".LAN_JBAPP_ADMIN_CONFIG_INPUT_SUBMIT."'>
                            </p>
                        </center>
                    </td>
                </tr>
            </table>
        </form>
    <div>";

    $title = "<b>".LAN_JBAPP_ADMIN_CONFIG_TITLE."</b>";
    $ns->tablerender($title, $text);
}

require_once(e_ADMIN."footer.php");
?>
