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

$pageid = "admin_menu_02";

$sql->db_Select(DB_TABLE_ROSTER_PREFERENCES);
while($row = $sql->db_Fetch()) {
    $organization_name = $row['organization_name'];
    $organization_type = $row['organization_type'];
    $organization_designation = $row['organization_designation'];
    $organization_unit_designation = $row['organization_unit_designation'];
    $organization_logo = $row['organization_logo'];
    $organization_logo_alignment = $row['organization_logo_alignment'];
}

if ($_GET['delete_member'] == '1') {

    $text = "
    <center>
        <p>
            ".LAN_JBROSTER_GENERAL_MEMBER_DELETE_CONFIRM."
        </p>
        <p>
            ".LAN_JBROSTER_ADMIN_MEMBER_EDIT_DELETE_MEMBER_WARNING."
        </p>
        <p>
            <table width='100'>
                <tr>
                    <td>
                        <a href='admin_member_edit.php?delete_member=2&member_id=".$_GET['member_id']."&url=".$_GET['url']."'>".LAN_JBROSTER_GENERAL_YES."</a>
                    </td>
                    <td>
                        <a href='".$_GET['url']."'>".LAN_JBROSTER_GENERAL_NO."</a>
                    </td>
                </tr>
            </table>
        </p>
    </center>";

    $title = "<b>".LAN_JBROSTER_ADMIN_MEMBER_EDIT_DELETE_MEMBER."</b>";
    $ns->tablerender($title, $text);

} else if ($_GET['delete_member'] == '2') {


    $sql->db_Delete(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,    "member_id = ".intval($_GET['member_id']));

    $sql->db_Delete(DB_TABLE_ROSTER_MEMBERS,                    "member_id = ".intval($_GET['member_id']));

    $sql->db_Delete(DB_TABLE_ROSTER_TEAM_MEMBERS,               "member_id = ".intval($_GET['member_id']));

    header("Location: ".$_GET['url']);

} else if ($_POST['change_member_status'] == '1') {

    // Change member status

    for ($x = 0; $x < count($_POST['member_status']); $x++) {
		tokenizeArray($_POST['member_status'][$x]);
		$newMemberStatusArray[$x] = $tokens;
	}

	for ($x = 0; $x < count($newMemberStatusArray); $x++) {

        $num_rows = $sql->db_Count(DB_TABLE_ROSTER_MEMBERS, "(*)", "WHERE   member_id       = ".intval($newMemberStatusArray[$x][0])."
                                                                    AND     member_status   = '".$tp->toDB($newMemberStatusArray[$x][1])."'");

        if ($num_rows > 0) {
            // Do nothing
        } else {

            // Update members status

            $sql1 = new db;
            $sql1->db_Update(DB_TABLE_ROSTER_MEMBERS,
                "member_status  = '".$tp->toDB($newMemberStatusArray[$x][1])."'
                WHERE member_id = ".intval($newMemberStatusArray[$x][0]));

            $sql1->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
                "attribute_value        = '".$tp->toDB($newMemberStatusArray[$x][1])."'
				WHERE   member_id       = ".intval($newMemberStatusArray[$x][0])."
				AND     attribute_id    = 4");
        }
    }

    // Change leader status

    for ($x = 0; $x < count($_POST['leader_status']); $x++) {
		tokenizeArray($_POST['leader_status'][$x]);
		$newLeaderStatusArray[$x] = $tokens;
	}

	for ($x = 0; $x < count($newLeaderStatusArray); $x++) {

        $num_rows = $sql->db_Count(DB_TABLE_ROSTER_MEMBERS, "(*)", "WHERE   member_id       = ".intval($newLeaderStatusArray[$x][0])."
                                                                    AND     leader_status   = '".$tp->toDB($newLeaderStatusArray[$x][1])."'");

        if ($num_rows > 0) {
            // Do nothing
        } else {

            // Update members status

            $sql1 = new db;
            $sql1->db_Update(DB_TABLE_ROSTER_MEMBERS,
                "leader_status  = '".$tp->toDB($newLeaderStatusArray[$x][1])."'
                WHERE member_id = ".intval($newLeaderStatusArray[$x][0]));

            $sql1->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
                "attribute_value    = '".$tp->toDB($newLeaderStatusArray[$x][1])."'
				WHERE member_id     = ".intval($newLeaderStatusArray[$x][0])."
				AND  attribute_id   = 5");
        }
    }

    header("Location: ".$_POST['url']);
    exit;

} else if ($_POST['edit_member'] == 1) {

	$ageMonth = null;
	$ageDay = null;
	$ageYear = null;

	$dobMonth = null;
	$dobDay = null;
	$dobYear = null;

	$validAgeDate = null;
	$validDobDate = null;

	foreach($_POST as $key=>$val) {
		if(!is_numeric($key)) {
			//Don't do anything
		} else {

			if ($val == '') {
	        // Do nothing
		    } else {

	    		if ($key == 1) {

			        $sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
                        "attribute_value    = '".$tp->toDB($val)."'
                        WHERE member_id     = ".intval($_POST['member_id'])."
                        AND attribute_id    = ".intval($key));

			        $sql->db_Update(DB_TABLE_ROSTER_MEMBERS,
                        "nickname       = '".$tp->toDB($val)."'
                        WHERE member_id = ".intval($_POST['member_id']));

	    		} else if ($key == 2) {

			        $sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
                        "attribute_value    = '".$tp->toDB($val)."'
                        WHERE member_id     = ".intval($_POST['member_id'])."
                        AND attribute_id    = ".intval($key));

			        $sql->db_Update(DB_TABLE_ROSTER_MEMBERS,
                        "real_name      = '".$tp->toDB($val)."'
                        WHERE member_id = ".intval($_POST['member_id']));

	    		} else if ($key == 4) {

			        $sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
                        "attribute_value    = '".$tp->toDB($val)."'
                        WHERE member_id     = ".intval($_POST['member_id'])."
                        AND attribute_id    = ".intval($key));

			        $sql->db_Update(DB_TABLE_ROSTER_MEMBERS,
                        "member_status  = '".$tp->toDB($val)."'
                        WHERE member_id = ".intval($_POST['member_id']));

	    		} else if ($key == 5) {

			        $sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
                        "attribute_value    = '".$tp->toDB($val)."'
                        WHERE member_id     = ".intval($_POST['member_id'])."
                        AND attribute_id    = ".intval($key));

			        $sql->db_Update(DB_TABLE_ROSTER_MEMBERS,
                        "leader_status  = '".$tp->toDB($val)."'
                        WHERE member_id = ".intval($_POST['member_id']));

	    		} else {

			        $sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
                        "attribute_value    = '".$tp->toDB($val)."'
                        WHERE member_id     = ".intval($_POST['member_id'])."
                        AND attribute_id    = ".intval($key));
	    		}
	    	}
	    }
	}

	if ($_POST['15_month'] != '') {
		$ageMonth = $_POST['15_month'];
	} else {
		// Return error
	}

	if ($_POST['15_day'] != '') {
		$ageDay = $_POST['15_day'];
	} else {
		// Return error
	}

	if ($_POST['15_year'] != '') {
		$ageYear = $_POST['15_year'];
	} else {
	    // Return error
	}

	if ($_POST['49_month'] != '') {
		$dobMonth = $_POST['49_month'];
	} else {
		// Return error
	}

	if ($_POST['49_day'] != '') {
		$dobDay = $_POST['49_day'];
	} else {
		// Return error
	}

	if ($_POST['49_year'] != '') {
		$dobYear = $_POST['49_year'];
	} else {
		// Return error
	}

	if (($ageMonth != null) && ($ageDay != null) && ($ageYear != null)) {
		if(checkdate($ageMonth, $ageDay, $ageYear)) {
			$validAgeDate = mktime(0, 0, 0, $ageMonth, $ageDay, $ageYear);
		} else {
			// Return error
		}
	}

	if (($dobMonth != null) && ($dobDay != null) && ($dobYear != null)) {
		if(checkdate($dobMonth, $dobDay, $dobYear)) {
			$validDobDate = mktime(0, 0, 0, $dobMonth, $dobDay, $dobYear);
		} else {
			// give error
		}
	}

	if ($validAgeDate != null) {
		$sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
            "attribute_value    = '".$tp->toDB($validAgeDate)."'
            WHERE member_id     = ".intval($_POST['member_id'])."
            AND attribute_id    = 15");
	}

	if ($validDobDate != null) {
		$sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
            "attribute_value    = '".$tp->toDB($validDobDate)."'
            WHERE member_id     = ".intval($_POST['member_id'])."
            AND attribute_id    = 49");
	}

    header("Location: ".$_SERVER['PHP_SELF']."?member_id=".$_POST['member_id']);
    exit;

} else {

    $text ="
    <form action='".$_SERVER['PHP_SELF']."' method='POST'>
		<div style='width:100%'>
			<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
				<tr>
					<td style='width:33%' class='forumheader3'>&nbsp;</td>
					<td style='width:33%' class='forumheader3'><b>".LAN_JBROSTER_GENERAL_CURRENT_VALUE."</b></td>
					<td style='width:33%' class='forumheader3'><b>".LAN_JBROSTER_GENERAL_NEW_VALUE."</b></td>
				</tr>";

			    $sql->db_Select(DB_TABLE_ROSTER_MEMBERS, "*", "member_id = ".intval($_GET['member_id']));
			    while($row = $sql->db_Fetch()) {

			        $sql1 = new db;
			        $sql1->db_Select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES, "*", "profile_display = 2");
			    	while($row1 = $sql1->db_Fetch()) {

				        $sql2 = new db;
				        $sql2->db_Select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES, "*", "member_id           = ".intval($_GET['member_id'])."
				                                                                        AND attribute_id    = ".intval($row1['attribute_id']));
				    	while($row2 = $sql2->db_Fetch()) {
				    		$attribute_value = $row2['attribute_value'];
				    	}

				        $text .=
				        "<tr>";
				        	if ($row1['attribute_id'] == 3) {
				        		// Don't show 'Team Status'
				        	} else if($row1['attribute_id'] == 34) {
			        			$text .= "
				        		<td style='width:33%' class='forumheader3'><b>".$row1['attribute_name']." $organization_name</b></td>";
				        	} else {
				        		$text .= "
								<td style='width:33%' class='forumheader3'><b>".$row1['attribute_name']."</b></td>";
				        	}


				        	if ($row1['attribute_id'] == 3) {
				        		// Don't show 'Team Status'
				        	} else if ($attribute_value == '') {
				                $text .=
				                "<td style='width:33%' class='forumheader3'>&nbsp;</td>";
				            } else {
				            	if(($row1['attribute_id'] == 15) || ($row1['attribute_id'] == 49)) {
				            		if ($attribute_value == 0) {
				            			$text .=
					                	"<td style='width:33%' class='forumheader3'>&nbsp;</td>";
				            		} else {
					            		$text .=
						                "<td style='width:33%' class='forumheader3'>".date("m/d/Y", $attribute_value)."</td>";
				            		}
				            	} else {
				            	   if ($row1['attribute_id'] == 47) {
                                        $text .=
                                        "<td style='width:33%' class='forumheader3'>".nl2br($attribute_value)."</td>";
                                    } else {
                                        $text .=
                                        "<td style='width:33%' class='forumheader3'>$attribute_value</td>";
                                    }
				            	}
				            }

				            if ($row1['attribute_id'] == 3) {
				            	// Don't show 'Team Status'
				            } else if ($row1['attribute_id'] == 4) {
				            	$text .= "
						        <td style='width:33%' class='forumheader3'>
						            <select class='tbox' name='".$row1['attribute_id']."'>";

						            $sql3 = new db;
						            $sql3->db_Select(DB_TABLE_ROSTER_MEMBER_STATUS, "*", "ORDER BY status_order", "no-where");
						            while ($row3 = $sql3->db_Fetch()) {

						                if ($attribute_value == $row3['status_name']) {
						                    $text .= "
						                    <option value='".$row3['status_name']."' selected='selected'>".$row3['status_name']."</option>";
						                } else {
						                    $text .= "
						                    <option value='".$row3['status_name']."'>".$row3['status_name']."</option>";
						                }
						            }

						        	$text .= "
						            </select>
						        </td>";
				            } else if ($row1['attribute_id'] == 5) {
				            	$text .= "
						        <td style='width:33%' class='forumheader3'>
						            <select class='tbox' name='".$row1['attribute_id']."'>";

						            $sql3 = new db;
						            $sql3->db_Select(DB_TABLE_ROSTER_LEADER_STATUS, "*", "ORDER BY status_order", "no-where");
						            while ($row3 = $sql3->db_Fetch()) {

						                if ($attribute_value == $row3['status_name']) {
						                    $text .= "
						                    <option value='".$row3['status_name']."' selected='selected'>".$row3['status_name']."</option>";
						                } else {
						                    $text .= "
						                    <option value='".$row3['status_name']."'>".$row3['status_name']."</option>";
						                }
						            }

						        	$text .= "
						            </select>
						        </td>";
				            } else if ($row1['attribute_id'] == 15) {
				            	$text .= "
						        <td style='width:33%' class='forumheader3'>
						            <input class='tbox' type='text' name='".$row1['attribute_id'].".month' size='2' maxlength='2' /> /
									<input class='tbox' type='text' name='".$row1['attribute_id'].".day' size='2' maxlength='2' /> /
									<input class='tbox' type='text' name='".$row1['attribute_id'].".year' size='4' maxlength='4' /> (MM/DD/YYYY)
						        </td>";
				            } else if ($row1['attribute_id'] == 16) {
				            	$text .= "
						        <td style='width:33%' class='forumheader3'>
						            <select class='tbox' name='".$row1['attribute_id']."'>";
						            if (($attribute_value == 'None') || ($attribute_value == '')) {
						            	$text .= "
										<option value='None' selected='selected'>&nbsp</option>
										<option value='Male'>".LAN_JBROSTER_GENERAL_MALE."</option>
										<option value='Female'>".LAN_JBROSTER_GENERAL_FEMALE."</option>";
				            		} else if ($attribute_value == 'Male') {
						            	$text .= "
										<option value='None'>&nbsp</option>
										<option value='Male' selected='selected'>".LAN_JBROSTER_GENERAL_MALE."</option>
										<option value='Female'>".LAN_JBROSTER_GENERAL_FEMALE."</option>";
						            } else if ($attribute_value == 'Female') {
						            	$text .= "
										<option value='None'>&nbsp</option>
										<option value='Male'>".LAN_JBROSTER_GENERAL_MALE."</option>
										<option value='Female' selected='selected'>".LAN_JBROSTER_GENERAL_FEMALE."</option>";
						            }
						            $text .= "
									</select>
						        </td>";
				            } else if ($row1['attribute_id'] == 32) {
				            	$text .= "
						        <td style='width:33%' class='forumheader3'>
						            <select class='tbox' name='".$row1['attribute_id']."'>";
						            for ($x=1; $x < 11; $x++) {
						            	if ($attribute_value == $x) {
							            	$text .= "
											<option value='$x' selected='selected'>$x</option>";
						            	} else {
						            		$text .= "
											<option value='$x'>$x</option>";
						            	}
						            }

						            $text .= "
									</select>
						        </td>";
				            } else if ($row1['attribute_id'] == 47) {
				            	$text .= "
						        <td style='width:33%' class='forumheader3'>
						            <textarea class='tbox' name='".$row1['attribute_id']."'></textarea>
						        </td>";
				            } else if ($row1['attribute_id'] == 48) {
				            	$text .= "
						        <td style='width:33%' class='forumheader3'>
						            <textarea class='tbox' name='".$row1['attribute_id']."'></textarea>
						        </td>";
				            } else if ($row1['attribute_id'] == 49) {
				            	$text .= "
						        <td style='width:33%' class='forumheader3'>
						            <input class='tbox' type='text' name='".$row1['attribute_id'].".month' size='2' maxlength='2' /> /
									<input class='tbox' type='text' name='".$row1['attribute_id'].".day' size='2' maxlength='2' /> /
									<input class='tbox' type='text' name='".$row1['attribute_id'].".year' size='4' maxlength='4' /> (MM/DD/YYYY)
						        </td>";
				            } else {
					            $text .=
					            "<td style='width:33%' class='forumheader3'>
									<input class='tbox' type='text' name='".$row1['attribute_id']."' />
								</td>";
				            }
						$text .= "
						</tr>";
			    	}

                    $member_leader              = $row['member_leader'];
                    $member_leader_order        = $row['member_leader_order'];
                    $desired_status             = $row['desired_status'];
                    $other_games                = $row['other_games'];
                    $member_application_date    = $row['member_application_date'];

			    }

			    $text .="
				<tr>
					<td colspan='6' class='forumheader3'>
						<center>
						    <p>
								<input type='hidden' name='member_id' value='".$_GET['member_id']."' />
								<input type='hidden' name='url' value='".$_GET['url']."' />
								<input type='hidden' name='edit_member' value='1' />
								<input type='submit' class='button' value='".LAN_JBROSTER_GENERAL_EDIT_MEMBER."' />
                            </p>
						</center>
					</td>
				</tr>
			</table>
		</div>
	</form>
    <center>
        <p>
            <span class='smalltext'>[ <a href='admin_manage_roster.php'>".LAN_JBROSTER_GENERAL_RETURN_TO_ROSTER."</a> ]</span>
        <p>
    </center>";

    // Render the value of $text in a table.
    $title = "<b>".LAN_JBROSTER_GENERAL_EDIT_MEMBER."</b>";
    $ns->tablerender($title, $text);
}

require_once(e_ADMIN."footer.php");

?>
