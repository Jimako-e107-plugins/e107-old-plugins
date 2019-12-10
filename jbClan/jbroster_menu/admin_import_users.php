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

$pageid = "admin_menu_02";

$sql->db_Select(DB_TABLE_ROSTER_PREFERENCES, "*", "organization_id = 1");
while ($row = $sql->db_Fetch()) {
	$organizationType = $row['organization_type'];
}

$still_members_to_import = NULL;

if ($_POST['import_members'] == '1') {

    $sql->db_select("user", "*", "ORDER BY user_name", "no-where");
    while ($row = $sql->db_Fetch()) {
        $sql1 = new db;
        if(!$sql1->db_Count(DB_TABLE_ROSTER_MEMBERS, "(*)", "WHERE member_id = ".intval($row['user_id']))) {
            $still_members_to_import++;
        }
    }

    if ($still_members_to_import) {
    	// Let user choose what kind of import they want to do

    	$text = "
    	<center>
    	    <table style='width:50%' class='fborder' cellspacing='0' cellpadding='0'>
                <tr>
                    <td class='forumheader3'>
                        <center>
                            <form action='".$_SERVER['PHP_SELF']."' method='POST'>
                            	<p>
                            	  ".LAN_JBROSTER_ADMIN_IMPORT_USERS_IMPORT_MEMBERS_INDIVIDUAL."
                            	</p>
                            	<p>
                            		<select class='tbox' name='user_id[]' multiple>";

    	                            $sql2 = new db;
    	                            $sql2->db_select("user", "*", "ORDER BY user_name", "no-where");
                                    while ($row2 = $sql2->db_Fetch()) {
                                        $sql3 = new db;
                                        if($sql3->db_Count(DB_TABLE_ROSTER_MEMBERS, "(*)", "WHERE member_id = ".intval($row2['user_id']))) {
                                            // Do nothing
                                        } else {
                                            $text .= "
                                            <option value='".$row2['user_id']."'>".$row2['user_name']."</option>";
                                        }
                                    }

                            		$text .= "
                            		</p>
                            		</select>
                            	<p>
                            		<input type='hidden' name='import_members' value='2' />
                            		<input class='button' type='submit' value='".LAN_JBROSTER_GENERAL_IMPORT_MEMBERS."' />
                            	</p>
                            </form>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td class='forumheader3'>
                        <center>
        					<form action='".$_SERVER['PHP_SELF']."' method='POST'>
        						<p>
        						  ".LAN_JBROSTER_ADMIN_IMPORT_USERS_IMPORT_MEMBERS_CLASS."
        						</p>
        						<p>
            						<select class='tbox' name='user_class'>";

                        		    $sql2 = new db;
            						$sql2->db_select("userclass_classes");
            						while ($row2 = $sql2->db_Fetch()) {
            							$text .= "
            							<option value='".$row2['userclass_id']."'>".$row2['userclass_name']."</option>";
            						}

        						    $text .= "
                                    </select>
        						</p>
        						<p>
            						<input type='hidden' name='import_members' value='3' />
            						<input class='button' type='submit' value='".LAN_JBROSTER_GENERAL_IMPORT_MEMBERS."' />
        						</p>
        					</form>
    					</center>
                    </td>
                </tr>
                <tr>
                    <td class='forumheader3'>
                        <center>
        					<form action='".$_SERVER['PHP_SELF']."' method='POST'>
        						<p>
                                    ".LAN_JBROSTER_ADMIN_IMPORT_USERS_IMPORT_MEMBERS_ALL."
        						</p>
        						<p>
            						<input type='hidden' name='import_members' value='4' />
            						<input class='button' type='submit' value='".LAN_JBROSTER_GENERAL_IMPORT_MEMBERS."' />
        						</p>
        					 </form>
                        </center>
                    </td>
                </tr>
            </table>
    	</center>";
    } else {

        // Notify admin that there are no users to import

        $text = "
        <center>
            <table style='width:50%' class='fborder' cellspacing='0' cellpadding='0'>
                <tr>
                    <td class='forumheader3'>
                        <center>
                            <p>
                                <b>".LAN_JBROSTER_ADMIN_IMPORT_USERS_NO_USERS_TO_IMPORT."</b>
                            </p>
                            <p>
                                <a href='admin_manage_roster.php'>".LAN_JBROSTER_ADMIN_IMPORT_USERS_RETURN_TO_MANAGE_ROSTER."</a>
                            </p>
                        </center>
                    </td>
                </tr>
            </table>
        </center>";
    }

    $title = "<b>Import Members</b>";
    $ns->tablerender($title, $text);

} else if ($_POST['import_members'] == '2') {

    // Import individual members

    if (!isset($_POST["confirm"])) {

        $text = "
        <p>
            <center>
                <div style='width:100%'>
                    <table style='width:50%' class='fborder' cellspacing='0' cellpadding='0'>
                        <tr>
                            <td class='forumheader3'>
                                <center>
                                    <form action='admin_import_users.php' method='POST'>";
                                        if (!isset($_POST['user_id'])) {
                                            $text .= "
                                            <p>
                                                <table style='width:50%' class='fborder' cellspacing='0' cellpadding='0'>
                                                    <tr>
                                                        <td class='forumheader3'>
                                                            <center>
                                                                ".LAN_JBROSTER_ADMIN_IMPORT_USERS_NO_MEMBERS."
                                                            </center>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </p>";

                                            // Return to "Import Members" page
                                            $text .= "
                                            <p>
                                                <input type='hidden' name='import_members' value='1' />
                                                <input class='button' type='submit' value='".LAN_JBROSTER_ADMIN_IMPORT_USERS_RETURN_TO_IMPORT_MEMBERS."' />
                                            </p>";
                                        } else {
                                            $text .= "
                                        <p>
                                            Are you sure you want to Import these members?
                                        </p>
                                            <p>
                                                <table style='width:50%' class='fborder' cellspacing='0' cellpadding='0'>
                                                    <tr>
                                                        <td class='forumheader3'>
                                                            <center>";

                                                                for($i = 0; $i < count($_POST['user_id']); $i++) {

                                                                    if($sql->db_Count(DB_TABLE_ROSTER_MEMBERS, "(*)", "WHERE member_id = ".intval($_POST['user_id'][$i]))) {
                                                                        // Do nothing
                                                                    } else {
                                                                        $sql1 = new db;
                                                                        $sql1->db_Select("user", "*", "user_id = ".intval($_POST['user_id'][$i]));
                                                                        while ($row1 = $sql1->db_Fetch()) {
                                                                            $text .= $row1['user_name'] . "<br />";
                                                                        }
                                                                    }
                                                                }

                                                            $text .=
                                                            "</center>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </p>
                                            <p>";

                                                $postKeys1 = array_keys($_POST);
                                                $postValues1 = array_values($_POST);
                                                for ($i=0; $i < count($postKeys1); $i++) {
                                                    if (is_array($postValues1[$i])) {
                                                        $postKeys2 = array_keys($postValues1[$i]);
                                                        $postValues2 = array_values($postValues1[$i]);
                                                        for ($x=0; $x < count($postValues1[$i]); $x++) {
                                                            $text .= "<input type='hidden' name='" . $postKeys1[$i] . "[]' value='" . $postValues2[$x] . "' />";
                                                        }
                                                    } else {
                                                        $text .= "<input type='hidden' name='" . $postKeys1[$i] . "' value='" . $postValues1[$i] . "' />";
                                                    }
                                                }

                                                $text .= "
                                                <input type='hidden' name='confirm' value='yes' />
                                                <input type='hidden' name='import_members' value='2' />
                                                <input class='button' type='submit' value='".LAN_JBROSTER_GENERAL_YES."' />
                                            </p>
                                        </form>";

                                        // Don't import members, return to "Import Members" page
                                        $text .= "
                                        <form action='admin_import_users.php' method='POST'>
                                            <input type='hidden' name='import_members' value='1' />
                                            <input class='button' type='submit' value='".LAN_JBROSTER_GENERAL_NO."' />";
                                        }

                                     $text .=
                                    "</form>
                                </center>
                            </td>
                        </tr>
                    </table>
                </div>
            </center>
        </p>";

        $title = "<b>Manage Roster</b>";
        $ns->tablerender($title, $text);

    } else if ($_POST["confirm"] == "yes") {

        for($i = 0; $i < count($_POST['user_id']); $i++) {

            if($sql->db_Count(DB_TABLE_ROSTER_MEMBERS, "(*)", "WHERE member_id = ".intval($_POST['user_id'][$i]))) {
                // Do nothing
            } else {

                $sql1 = new db;
                $sql1->db_Select("user", "*", "user_id = ".intval($_POST['user_id'][$i]));
                while ($row1 = $sql1->db_Fetch()) {

                	$sql2 = new db;
    	            $sql2->db_Select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES);
    	            while ($row2 = $sql2->db_Fetch()) {

    	            	$sql3 = new db;
    					if ($sql3->db_Count(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES, "(*)", " WHERE member_id  = ".intval($row1['user_id'])."
    					                                                                      AND attribute_id = ".intval($row2['attribute_id'])) > 0) {
    						// Do Nothing
    					} else {

    						if ($row2['attribute_id'] == 1) {
    						    $sql4 = new db;
    							$sql4->db_Insert(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
        							intval($row1['user_id']).",
        							".intval($row2['attribute_id']).",
        							'".$tp->toDB($row2['attribute_name'])."',
        							'".$tp->toDB($row1['user_name'])."',
        							".intval($organizationType).",
        							1,
        							1,
                                    1");
    						} else if ($row2['attribute_id'] == 8) {
                                $sql4 = new db;
    							$sql4->db_Insert(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
        							intval($row1['user_id']).",
        							".intval($row2['attribute_id']).",
        							'".$tp->toDB($row2['attribute_name'])."',
        							'".$tp->toDB($row1['user_email'])."',
        							".intval($organizationType).",
        							1,
        							1,
                                    1");
    						} else if ($row2['attribute_id'] == 47) {
                                $sql4 = new db;
    							$sql4->db_Insert(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
        							intval($row1['user_id']).",
        							".intval($row2['attribute_id']).",
        							'".$tp->toDB($row2['attribute_name'])."',
        							'No Bio Available',
        							".intval($organizationType).",
        							1,
        							1,
                                    1");
    						}  else {
                                $sql4 = new db;
    							$sql4->db_Insert(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
        							intval($row1['user_id']).",
        							".intval($row2['attribute_id']).",
        							'".$tp->toDB($row2['attribute_name'])."',
        							'',
        							".intval($organizationType).",
        							1,
        							1,
                                    1");
    						}
    					}
    	            }
                }

                $sql1->db_Select("user", "*", "user_id = ".intval($_POST['user_id'][$i]));
                while ($row1 = $sql1->db_Fetch()) {
    				$sql2 = new db;
    				$sql2->db_Insert(DB_TABLE_ROSTER_MEMBERS,
        				intval($row1['user_id']).",
        				'".$tp->toDB($row1['user_name'])."',
        				'',
        				'',
        				'',
        				'Open Application',
        				'None',
        				1,
        				NOW()");
                }
            }
        }

        $text = "
        <p>
            <center>
                <div style='width:100%'>
                    <form action='admin_import_users.php' method='POST'>
                        <table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
                            <tr>
                                <td class='forumheader3'>
                                    <center>
                                        <p>
                                            ".LAN_JBROSTER_ADMIN_IMPORT_USERS_CONFIRM_UPDATED_ROSTER."
                                        </p>
                                        <p>
                                            <a href='admin_manage_roster.php'>".LAN_JBROSTER_ADMIN_IMPORT_USERS_RETURN_TO_MANAGE_ROSTER."</a>
                                        </p>
                                    </center>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </center>
        </p>";

        $title = "<b>".LAN_JBROSTER_GENERAL_MANAGE_ROSTER."</b>";
        $ns->tablerender($title, $text);
    }

} else if ($_POST['import_members'] == '3') {

	// Import members by class

    if (!isset($_POST["confirm"])) {

        $text = "
        <p>
            <center>
                <div style='width:100%'>
                    <table style='width:50%' class='fborder' cellspacing='0' cellpadding='0'>
                        <tr>
                            <td class='forumheader3'>
                                <center>";

                                    if(!$sql->db_Select("user", "*", "user_class REGEXP('.".$tp->toDB($_POST['user_class'])."') OR user_class REGEXP('".$tp->toDB($_POST['user_class'])."')")) {
                                        $text .=
                                        "<form action='admin_import_users.php' method='POST'>
                                        <p>
                                            <table style='width:50%' class='fborder' cellspacing='0' cellpadding='0'>
                                                <tr>
                                                    <td class='forumheader3'>
                                                        <center>
                                                            ".LAN_JBROSTER_ADMIN_IMPORT_USERS_NO_MEMBERS."
                                                        </center>
                                                    </td>
                                                </tr>
                                            </table>
                                        </p>
                                        <p>
                                            <input type='hidden' name='import_members' value='1' />
                                            <input class='button' type='submit' value='".LAN_JBROSTER_ADMIN_IMPORT_USERS_RETURN_TO_IMPORT_MEMBERS."' />
                                        </p>";

                                    } else {

                                        $text .=
                                        "<form action='admin_import_users.php' method='POST'>
                                            <p>
                                                ".LAN_JBROSTER_ADMIN_IMPORT_USERS_CONFIRM_IMPORT."
                                            </p>
                                            <p>
                                                <table style='width:50%' class='fborder' cellspacing='0' cellpadding='0'>
                                                    <tr>
                                                        <td class='forumheader3'>
                                                            <center>";

                                                                while ($row = $sql->db_Fetch()) {
                                                                    $sql1 = new db;
                                                                    if ($sql1->db_Count(DB_TABLE_ROSTER_MEMBERS, "(*)", "WHERE member_id = ".intval($row['user_id']))) {
                                                                        // Do nothing
                                                                    } else {
                                                                        $sql2 = new db;
                                                                        $sql2->db_Select("user", "*", "user_id = ".intval($row['user_id']));
                                                                        while ($row2 = $sql2->db_Fetch()) {
                                                                            $text .= $row2['user_name'] . "<br />";
                                                                        }
                                                                    }
                                                                }

                                                                $postKeys1 = array_keys($_POST);
                                                                $postValues1 = array_values($_POST);
                                                                for ($i=0; $i < count($postKeys1); $i++) {
                                                                    if (is_array($postValues1[$i])) {
                                                                        $postKeys2 = array_keys($postValues1[$i]);
                                                                        $postValues2 = array_values($postValues1[$i]);
                                                                        for ($x=0; $x < count($postValues1[$i]); $x++) {
                                                                            $text .= "<input type='hidden' name='" . $postKeys1[$i] . "[]' value='" . $postValues2[$x] . "' />";
                                                                        }
                                                                    } else {
                                                                        $text .= "<input type='hidden' name='" . $postKeys1[$i] . "' value='" . $postValues1[$i] . "' />";
                                                                    }
                                                                }

                                                                $text .= "
                                                            </center>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </p>
                                            <p>
                                                <input type='hidden' name='confirm' value='yes' />
                                                <input type='hidden' name='import_members' value='3' />
                                                <input class='button' type='submit' value='".LAN_JBROSTER_GENERAL_YES."' />
                                            </p>
                                        </form>";

                                        // Don't import members, return to "Import Members" page
                                        $text .= "
                                        <form action='admin_import_users.php' method='POST'>
                                            <input type='hidden' name='import_members' value='1' />
                                            <input class='button' type='submit' value='".LAN_JBROSTER_GENERAL_NO."' />";
                                    }

                                    $text .=
                                    "</form>
                                </center>
                            </td>
                        </tr>
                    </table>
                </div>
            </center>
        </p>";

        $title = "<b>".LAN_JBROSTER_GENERAL_MANAGE_ROSTER."</b>";
        $ns->tablerender($title, $text);

    } else if ($_POST["confirm"] == "yes") {

    	if($sql->db_Select("user", "*", "user_class REGEXP('.".$tp->toDB($_POST['user_class'])."') OR user_class REGEXP('".$tp->toDB($_POST['user_class'])."')")){

    		while ($row = $sql->db_Fetch()) {

    		    $sql1 = new db;
    			if ($sql1->db_Count(DB_TABLE_ROSTER_MEMBERS, "(*)", " WHERE nickname = '".$tp->toDB($row['user_name'])."'") > 0) {
    				// Do Nothing
    			} else {
    				$sql2 = new db;
    	            $sql2->db_Select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES);
    	            while ($row2 = $sql2->db_Fetch()) {

    	            	if ($row2['attribute_id'] == 1) {
    						$sql3 = new db;
    						$sql3->db_Insert(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
        						intval($row['user_id']).",
        						".intval($row2['attribute_id']).",
        						'".$tp->toDB($row2['attribute_name'])."',
        						'".$tp->toDB($row['user_name'])."',
        						".intval($organizationType).",
        						1,
        						1,
                                1");
    					} else if ($row2['attribute_id'] == 8) {
    						$sql3 = new db;
    						$sql3->db_Insert(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
        						intval($row['user_id']).",
        						".intval($row2['attribute_id']).",
        						'".$tp->toDB($row2['attribute_name'])."',
        						'".$tp->toDB($row['user_email'])."',
        						".intval($organizationType).",
        						1,
        						1,
                                1");
    					} else if ($row2['attribute_id'] == 47) {
    						$sql3 = new db;
    						$sql3->db_Insert(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
        						intval($row['user_id']).",
        						".intval($row2['attribute_id']).",
        						'".$tp->toDB($row2['attribute_name'])."',
        						'No Bio Available',
        						".intval($organizationType).",
        						1,
        						1,
                                1");
    					}  else {
    						$sql3 = new db;
    						$sql3->db_Insert(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
        						intval($row['user_id']).",
        						".intval($row2['attribute_id']).",
        						'".$tp->toDB($row2['attribute_name'])."',
        						'',
        						".intval($organizationType).",
        						1,
        						1,
                                1");
    					}
    	            }

    				$sql2->db_Insert(DB_TABLE_ROSTER_MEMBERS,
    				intval($row['user_id']).",
    				'".$tp->toDB($row['user_name'])."',
    				'',
    				'',
    				1,
    				'Open Application',
    				'None',
    				1,
    				''");
    			}
    		}
    	}

    	$text = "
    	<p>
    		<center>
    			<div style='width:100%'>
    				<form action='admin_import_users.php' method='POST'>
    					<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
    						<tr>
    							<td class='forumheader3'>
    								<center>
    									<p>
    									    ".LAN_JBROSTER_ADMIN_IMPORT_USERS_CONFIRM_UPDATED_ROSTER."
    									</p>
    									<p>
    									    <a href='admin_manage_roster.php'>".LAN_JBROSTER_ADMIN_IMPORT_USERS_RETURN_TO_MANAGE_ROSTER."</a>
    									</p>
    								</center>
    							</td>
    						</tr>
    					</table>
    				</form>
    			</div>
    		</center>
    	</p>";

    	$title = "<b>".LAN_JBROSTER_GENERAL_MANAGE_ROSTER."</b>";
    	$ns->tablerender($title, $text);

    }

} else if ($_POST['import_members'] == '4') {

	// Import all members

    if (!isset($_POST["confirm"])) {

        $text = "
        <p>
            <center>
                <div style='width:100%'>
                    <table style='width:50%' class='fborder' cellspacing='0' cellpadding='0'>
                        <tr>
                            <td class='forumheader3'>
                                <center>";

                                    if(!$sql->db_Select("user")){
                                        $text .=
                                        "<form action='admin_import_users.php' method='POST'>
                                        <p>
                                            <table style='width:50%' class='fborder' cellspacing='0' cellpadding='0'>
                                                <tr>
                                                    <td class='forumheader3'>
                                                        <center>
                                                            ".LAN_JBROSTER_ADMIN_IMPORT_USERS_NO_MEMBERS."
                                                        </center>
                                                    </td>
                                                </tr>
                                            </table>
                                        </p>
                                        <p>
                                            <input type='hidden' name='import_members' value='1' />
                                            <input class='button' type='submit' value='".LAN_JBROSTER_ADMIN_IMPORT_USERS_RETURN_TO_IMPORT_MEMBERS."' />
                                        </p>";

                                    } else {

                                        $text .=
                                        "<form action='admin_import_users.php' method='POST'>
                                            <p>
                                                ".LAN_JBROSTER_ADMIN_IMPORT_USERS_CONFIRM_IMPORT."
                                            </p>
                                            <p>
                                                <table style='width:50%' class='fborder' cellspacing='0' cellpadding='0'>
                                                    <tr>
                                                        <td class='forumheader3'>
                                                            <center>";

                                                                while ($row = $sql-> db_Fetch()) {
                                                                    $sql1 = new db;
                                                                    if ($sql1->db_Count(DB_TABLE_ROSTER_MEMBERS, "(*)", " WHERE nickname = '".$tp->toDB($row['user_name'])."'") > 0) {
                                                                        // Do Nothing
                                                                    } else {
                                                                        $text .= $row['user_name'] . "<br />";
                                                                    }
                                                                }

                                                                $postKeys1 = array_keys($_POST);
                                                                $postValues1 = array_values($_POST);
                                                                for ($i=0; $i < count($postKeys1); $i++) {
                                                                    if (is_array($postValues1[$i])) {
                                                                        echo "what's up";
                                                                        $postKeys2 = array_keys($postValues1[$i]);
                                                                        $postValues2 = array_values($postValues1[$i]);
                                                                        for ($x=0; $x < count($postValues1[$i]); $x++) {
                                                                            $text .= "<input type='hidden' name='" . $postKeys1[$i] . "[]' value='" . $postValues2[$x] . "' />";
                                                                        }
                                                                    } else {
                                                                        $text .= "<input type='hidden' name='" . $postKeys1[$i] . "' value='" . $postValues1[$i] . "' />";
                                                                    }
                                                                }

                                                                $text .= "
                                                            </center>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </p>
                                            <p>
                                                <input type='hidden' name='confirm' value='yes' />
                                                <input type='hidden' name='import_members' value='4' />
                                                <input class='button' type='submit' value='".LAN_JBROSTER_GENERAL_YES."' />
                                            </p>
                                        </form>";

                                        // Don't import members, return to "Import Members" page
                                        $text .= "
                                        <form action='admin_import_users.php' method='POST'>
                                            <input type='hidden' name='import_members' value='1' />
                                            <input class='button' type='submit' value='".LAN_JBROSTER_GENERAL_NO."' />";
                                    }
                                    $text .=
                                    "</form>
                                </center>
                            </td>
                        </tr>
                    </table>
                </div>
            </center>
        </p>";

        $title = "<b>".LAN_JBROSTER_GENERAL_MANAGE_ROSTER."</b>";
        $ns->tablerender($title, $text);

    } else if ($_POST["confirm"] == "yes") {

    	$sql->db_Select("user");
    	while ($row = $sql-> db_Fetch()) {

    		$sql1 = new db;
    		if ($sql1->db_Count(DB_TABLE_ROSTER_MEMBERS, "(*)", " WHERE nickname = '".$tp->toDB($row['user_name'])."'") > 0) {
    			// Do Nothing
    		} else {
                $sql2 = new db;
                $sql2->db_Select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES);
                while ($row2 = $sql2->db_Fetch()) {
                    $sql3 = new db;
    				if ($sql3->db_Count(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES, "(*)", " WHERE member_id       = ".intval($row['user_id'])."
    				                                                                      AND   attribute_id    = ".intval($row2['attribute_id'])) > 0) {
    					// Do Nothing
    				} else {
    					if ($row2['attribute_id'] == 1) {
    						$sql4 = new db;
    						$sql4->db_Insert(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
        						intval($row['user_id']).",
        						".intval($row2['attribute_id']).",
        						'".$tp->toDB($row2['attribute_name'])."',
        						'".$tp->toDB($row['user_name'])."',
        						".intval($organizationType)."',
        						1,
        						1,
                                1");
    					} else if ($row2['attribute_id'] == 8) {
    						$sql4 = new db;
    						$sql4->db_Insert(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
        						intval($row['user_id']).",
        						".intval($row2['attribute_id']).",
        						'".$tp->toDB($row2['attribute_name'])."',
        						'".$tp->toDB($row['user_email'])."',
        						".intval($organizationType).",
        						1,
        						1,
                                1");
    					} else if ($row2['attribute_id'] == 47) {
    						$sql4 = new db;
    						$sql4->db_Insert(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
        						intval($row['user_id']).",
        						".intval($row2['attribute_id']).",
        						'".$tp->toDB($row2['attribute_name'])."',
        						'No Bio Available',
        						".intval($organizationType)."',
        						1,
        						1,
                                1");
    					}  else {
    						$sql4 = new db;
    						$sql4->db_Insert(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
        						intval($row['user_id']).",
        						".intval($row2['attribute_id']).",
        						'".$tp->toDB($row2['attribute_name'])."',
        						'',
        						".intval($organizationType).",
        						1,
        						1,
                                1");
    					}
    				}
                }

    			$sql2->db_Insert(DB_TABLE_ROSTER_MEMBERS,
        			intval($row['user_id']).",
        			'".$tp->toDB($row['user_name'])."',
        			'',
        			'',
        			1,
        			'Open Application',
        			'None',
        			1,
        			''");
    		}
    	}

    	$text = "
		<p>
    		<center>
    			<div style='width:100%'>
    				<form action='admin_import_users.php' method='POST'>
    					<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
    						<tr>
    							<td class='forumheader3'>
    								<center>
    									<p>
    									   ".LAN_JBROSTER_ADMIN_IMPORT_USERS_CONFIRM_UPDATED_ROSTER."
    									</p>
    									<p>
    									   <a href='admin_manage_roster.php'>".LAN_JBROSTER_ADMIN_IMPORT_USERS_RETURN_TO_MANAGE_ROSTER."</a>
    									</p>
    								</center>
    							</td>
    						</tr>
    					</table>
    				</form>
    			</div>
    		</center>
		</p>";

    	$title = "<b>".LAN_JBROSTER_GENERAL_MANAGE_ROSTER."</b>";
    	$ns->tablerender($title, $text);

    }
}

require_once(e_ADMIN."footer.php");

?>
