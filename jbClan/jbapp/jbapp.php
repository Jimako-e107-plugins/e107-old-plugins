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
require_once(HEADERF);
if(file_exists(e_PLUGIN."jbapp/languages/".e_LANGUAGE.".php")) {
    include_lan(e_PLUGIN."jbapp/languages/".e_LANGUAGE.".php");
}

require_once("includes/config.constants.php");

if(USER) {
    if($_POST['submitApp'] == '1') {

        $sql->db_Select("plugin");
        while($row = $sql->db_Fetch()) {
            if (($row['plugin_name'] == "jbRoster") && ($row['plugin_installflag'] == 1)) {
                $installed_jbroster = 1;
            }
        }

        if ($installed_jbroster) {

        	// Get users email address from their site registration, so they don't have to enter one, and I don't have to verify it
        	$sql->db_Select("user", "*", "user_id = ".intval(USERID));
        	while ($row = $sql->db_Fetch()) {
        		$userEmail = $row['user_email'];
        	}

    		if ($sql->db_Count(DB_TABLE_ROSTER_MEMBERS, "(*)", "WHERE member_id = ".intval($_POST['member_id'])) > 0) {
    			// Don't insert this record
    		} else {
		        $sql1 = new db;
    			$sql1->db_Insert(DB_TABLE_ROSTER_MEMBERS,
    	            intval($_POST['member_id']).",
    	            '".$tp->toDB($_POST[1])."',
    	            '".$tp->toDB($_POST[2])."',
    				'',
    				'',
    				'Open Application',
    				'None',
    				1,
    				NOW()");
        	}

    		foreach($_POST as $key=>$val) {
    			if(!is_numeric($key)) {
    				//Don't do anything
    			} else {
    				if ($sql->db_Count(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES, "(*)",
    				    "WHERE  member_id    = ".intval($_POST['member_id'])."
    				     AND    attribute_id = ".intval($key)) > 0) {
    					// Don't insert this record
    				} else {
    					if ($key == 1) {
    					    $sql1 = new db;
    					    $sql1->db_Select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES, "*", "attribute_id = ".intval($key));
                            while ($row1 = $sql1->db_Fetch()) {
                                $sql2 = new db;
                                $sql2->db_Insert(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
    					            intval($_POST['member_id']).",
    								".intval($key).",
    								'".$tp->toDB($row1['attribute_name'])."',
    								'".$tp->toDB($val)."',
    								".intval($row1['organization_type']).",
    								1,
    								1,
                                    1");
    					    }

    					   $sql->db_Update(DB_TABLE_ROSTER_MEMBERS,
    						    "nickname         = '".$tp->toDB($val)."'
    						    WHERE member_id   = ".intval($_POST['member_id']));

    					} else if ($key == 2) {
    					    $sql->db_Select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES, "*", "attribute_id = ".intval($key));
                            while ($row = $sql->db_Fetch()) {
                                $sql1 = new db;
    					    	$sql1->db_Insert(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
    					            intval($_POST['member_id']).",
    								".intval($key).",
    								'".$tp->toDB($row['attribute_name'])."',
    								'".$tp->toDB($val)."',
    								".intval($row['organization_type']).",
    								1,
    								1,
                                    1");
    					    }

    					    $sql->db_Update(DB_TABLE_ROSTER_MEMBERS,
    						    "real_name        = '".$tp->toDB($val)."'
    						    WHERE member_id   = ".intval($_POST['member_id']));

    					} else {
    					    $sql->db_Select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES, "*", "attribute_id = ".intval($key));
                            while ($row = $sql->db_Fetch()) {
                                $sql1 = new db;
    					    	$sql1->db_Insert(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
    					            intval($_POST['member_id']).",
    								".intval($key).",
    								'".$tp->toDB($row['attribute_name'])."',
    								'".$tp->toDB($val)."',
    								".intval($row['organization_type']).",
    								1,
    								1,
                                    1");
    					    }
    				    }
    				}
    		    }
    		}

    		$sql->db_Select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES);
    		while ($row = $sql->db_Fetch()) {

    		    $sql1 = new db;
    	    	if ($sql1->db_Count(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES, "(*)",
    	    	  "WHERE  member_id       = ".intval($_POST['member_id'])."
    	    	  AND     attribute_id    = ".intval($row['attribute_id'])) > 0) {
    				// Don't insert this record
    			} else {
    			    $sql2 = new db;
    				$sql2->db_Insert(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
    		            intval($_POST['member_id']).",
    					".intval($row['attribute_id']).",
    					'".$tp->toDB($row['attribute_name'])."',
    					'',
    				    ".intval($row['organization_type']).",
    					1,
    					1,
                        1");
    	    	}
    	    }

    		$sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
                "attribute_value        = 'Open Application'
                WHERE   member_id       = ".intval($_POST['member_id'])."
                AND     attribute_id    = 4");

    		$sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
                "attribute_value        = 'None'
                WHERE   member_id       = ".intval($_POST['member_id'])."
                AND     attribute_id    = 5");

    		$sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
                "attribute_value        = '".time()."'
                WHERE   member_id       = ".intval($_POST['member_id'])."
                AND     attribute_id    = 49");

    		$sql->db_Update(DB_TABLE_ROSTER_MEMBERS,
                "member_application_date    = ".time()."
                WHERE member_id             = ".intval($_POST['member_id']));

    		$ageMonth = null;
    		$ageDay = null;
    		$ageYear = null;

    		$dobMonth = null;
    		$dobDay = null;
    		$dobYear = null;

    		$validAgeDate = null;
    		$validDobDate = null;

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
    				// Return error
    			}
    		}

    		if ($validAgeDate != null) {
    			$sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
                    "attribute_value        = '".$tp->toDB($validAgeDate)."'
                    WHERE   member_id       = ".intval($_POST['member_id'])."
                    AND     attribute_id    = 15");
    		}

    		if ($validDobDate != null) {
    			$sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
                    "attribute_value        = '".$tp->toDB($validDobDate)."'
                    WHERE   member_id       = ".intval($_POST['member_id'])."
                    AND     attribute_id    = 49");
    		}
        }

		// Email application to admin
        include("jbapp_calc.php");

        $text = "
        <center>
            <p>
                <b>".LAN_JBAPP_MAIN_PAGE_SUCCESS_1."</b>
            </p>
            <p>
                ".LAN_JBAPP_MAIN_PAGE_SUCCESS_2." <a href='".SITEURL."'>".LAN_JBAPP_MAIN_PAGE_SUCCESS_3."</a>
            </p>
        </center>";

        $title = "";
        $ns->tablerender($title, $text);

    } else {

    	$sql->db_Select(DB_TABLE_APP_INFO);
        while ($row = $sql->db_Fetch()) {
            $organization_disclaimer = $row['organization_disclaimer'];
        }

        $sql->db_Select(DB_TABLE_ROSTER_PREFERENCES);
        while ($row = $sql->db_Fetch()) {
            $organization_name              = $row['organization_name'];
            $organization_logo              = $row['organization_logo'];
            $organization_logo_alignment    = $row['organization_logo_alignment'];
        }

		if ($organization_logo == "") {
			// Don't display the logo
		} else {
	        $text = "
            <center>
                <p>
                    <img align='$organization_logo_alignment' src='".e_PLUGIN."jbroster_menu/images/$organization_logo'>
                <p>
			</center>";
		}

		$text .= "
        <center>
            <p>
                <b><font size='+1'>".LAN_JBAPP_MAIN_PAGE_I_WANT_TO_JOIN." $organization_name</font></b>
            </p>
        </center>
        <p style='padding-top: 2em; padding-bottom: 2em;padding-left: 2em; padding-right: 2em'>
            ".nl2br($organization_disclaimer)."
        <p>";

        $text .= "
        <form method='POST' action='" .$_SERVER['PHP_SELF']. "'>
            <table class='tborder' cellspacing='15'>";

                $sql->db_Select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES, "*", "application_display = 2 ORDER BY attribute_order");
                while($row = $sql->db_Fetch()) {

                	if ($row['attribute_id'] == 3) {
                		// Don't show 'Member Status'
                	} else if ($row['attribute_id'] == 4) {
                		// Don't show 'Leader Status'
                	} else if ($row['attribute_id'] == 5) {
                        // Don't show 'Leader Status'
                    } else if ($row['attribute_id'] == 49) {
                		// Don't show 'Leader Status'
                	} else {
	                	$text .= "
	                	<tr>";
	                	if ($row['attribute_id'] == 34) {
	                		$text .= "
		                    <td class='tborder' valign='top'>
		                        ".$row['attribute_name']." $organization_name:
							</td>";
	                	} else {
	                		$text .= "
		                    <td class='tborder' valign='top'>
		                        ".$row['attribute_name']."
							</td>";
	                	}
	                		$text .= "
		                    <td class='tborder'>";
		                    	if ($row['attribute_id'] == 15) {
		                    		$text .= "
						            <input class='tbox' type='text' name='".$row['attribute_id'].".month' size='2' maxlength='2'> /
									<input class='tbox' type='text' name='".$row['attribute_id'].".day' size='2' maxlength='2'> /
									<input class='tbox' type='text' name='".$row['attribute_id'].".year' size='4' maxlength='4'> (MM/DD/YYYY)";
		                    	} else if ($row['attribute_id'] == 16) {
		                    		$text .= "
						            <select class='tbox' name='".$row['attribute_id']."'>
										<option value=''>&nbsp;</option>
										<option value='male'>".LAN_JBAPP_MAIN_PAGE_MALE."</option>
										<option value='female'>".LAN_JBAPP_MAIN_PAGE_FEMALE."</option>
									</select>";
		                    	} else if ($row['attribute_id'] == 32) {
		                    		$text .= "
						            <select class='tbox' name='".$row['attribute_id']."'>
									   <option value=''>&nbsp;</option>";
    						            for ($x=1; $x < 11; $x++) {
    					            		$text .= "
    										<option value='$x'>$x</option>";
    						            }
						            $text .= "
									</select>";
		                    	} else if ($row['attribute_id'] == 47) {
		                    		$text .= "
						            <textarea class='tbox' name='".$row['attribute_id']."' cols='23' rows='4'></textarea>";
		                    	} else if ($row['attribute_id'] == 48) {
		                    		$text .= "
						            <textarea class='tbox' name='".$row['attribute_id']."' cols='23' rows='4'></textarea>";
		                    	} else {
		                    		$text .= "
		                        	<input class='tbox' name='".$row['attribute_id']."' type='text' value='' size='25'>";
		                    	}
	                    	$text .= "
		                    </td>
		                </tr>";
                	}

                }

                $text .= "
                <tr>
                    <td colspan='2' class='spacer' style='text-align:center;'>
						<input type='hidden' name='member_id' value='".USERID."'>
						<input type='hidden' name='submitApp' value='1'>
                        <input type='submit' class='button' name='submit' value='".LAN_JBAPP_MAIN_PAGE_SUBMIT_APP."'>
                        <input type='reset' class='button' name='reset' value='".LAN_JBAPP_MAIN_PAGE_RESET_APP."'>
                    </td>
                </tr>
            </table>
        </form>";

        $title = "";
        $ns->tablerender($title, $text);
    }

} else {

    $text = "
    <table width='100%'>
        <tr>
            <td>
                <center>
                    <p>
                        ".LAN_JBAPP_MAIN_PAGE_LOGIN_1." <a href='".e_LOGIN."'>".LAN_JBAPP_MAIN_PAGE_LOGIN_2."</a> ".LAN_JBAPP_MAIN_PAGE_LOGIN_3." <a href='".e_SIGNUP."'>".LAN_JBAPP_MAIN_PAGE_LOGIN_4."</a> ".LAN_JBAPP_MAIN_PAGE_LOGIN_5."
                    </p>
                </center>
            </td>
        </tr>
    </table>";

    $title = "";
    $ns->tablerender($title, $text);
}

require_once(FOOTERF);
?>
