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
require_once(HEADERF);
if(file_exists(e_PLUGIN."jbroster_menu/languages/".e_LANGUAGE.".php")){
    include_lan(e_PLUGIN."jbroster_menu/languages/".e_LANGUAGE.".php");
}

require_once("includes/config.constants.php");
require_once("includes/config.functions.php");

/************************************************************
 *
 * Display Member Info
 *
 ************************************************************/

$sql->db_Select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES, "*", "member_id        = ".intval($_GET['member_id'])."
                                                               AND attribute_id = 47");
while ($row = $sql->db_Fetch()) {
	$memberBio = $row['attribute_value'];
}

$sql->db_Select(DB_TABLE_ROSTER_PREFERENCES);
while($row = $sql-> db_Fetch()){
    $organization_name              = $row['organization_name'];
    $organization_type              = $row['organization_type'];
    $organization_designation       = $row['organization_designation'];
    $organization_unit_designation  = $row['organization_unit_designation'];
    $organization_logo              = $row['organization_logo'];
    $organization_logo_alignment    = $row['organization_logo_alignment'];
}



$text_1 = "
<p>
    <div style='width:100%'>
    	<table border='1' style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
    		<tr>
    			<td colspan=6 class='forumheader'>
    				<span class='smalltext'>
    					<b>".LAN_JBROSTER_MEMBER_PROFILE_MEMBER_INFO."</b>
    				</span>
    			</td>
    		</tr>";

    		$sql->db_Select(DB_TABLE_ROSTER_MEMBERS, "*", "member_id = ".intval($_GET['member_id']));
    		while ($row = $sql->db_Fetch()) {

    			$text_1 .= "
    			<tr>
    				<td valign='top' width='60%' style='border-right: 0px;' class='forumheader3'>
    					<p>
        					<table border='0' cellspacing='15' style='width:100%' cellspacing='0' cellpadding='0'>";

                                $sql1 = new db;
                                $sql1->db_Select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES, "*", "profile_display    = 2
                                                                                             AND attribute_id       < 35
                                                                                              OR profile_display    = 2
                                                                                             AND attribute_id       > 47
                                                                                             ORDER BY attribute_order");
                                while($row1 = $sql1->db_Fetch()) {

                                	$sql2 = new db;
                                    $sql2->db_Select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES, "*", "member_id       = ".intval($row['member_id'])."
                                                                                                AND attribute_id    = ".intval($row1['attribute_id']));
                                    while($row2 = $sql2->db_Fetch()) {

                                    	$text_1 .= "<tr>";

                                        	if ($row2['attribute_id'] == 34) {
        	                                	$text_1 .= "
        	                                    <td style='border: 0px' valign='top' width='40%'>
        	                                        <span class='smalltext'>
        	                                            <p>
        	                                                <b>".$row2['attribute_name']." $organization_name:</b>
        	                                            </p>
        	                                        </span>
        	                                    </td>";
                                        	} else {
                                        		$text_1 .= "
        	                                    <td style='border: 0px' valign='top' width='40%'>
        	                                        <span class='smalltext'>
                                                        <p>
        	                                                <b>".$row2['attribute_name']."</b>
                                                        </p>
        	                                        </span>
        	                                    </td>";
                                        	}

                                            if ($row1['attribute_id'] == 4) {

                                            	$sql3 = new db;
        					                	$sql3->db_Select(DB_TABLE_ROSTER_MEMBER_STATUS, "*", "status_name = '".$tp->toDB($row2['attribute_value'])."'");
        					                	while ($row3 = $sql3->db_Fetch()) {
        					                		$textColor = $row3['text_color'];
        					                	}

        					                	if ($row2['attribute_value'] == '') {
        		                                    $text_1 .= "
        		                                    <td style='border: 0px' valign='top' width='60%'>
        		                                        <span class='smalltext'>
                                                            <p>
        		                                                &nbsp;
                                                            </p>
        		                                        </span>
        		                                    </td>";
                                        		} else {
                                        			$text_1 .= "
        		                                    <td style='border: 0px' valign='top' width='60%'>
        		                                        <span style='color: $textColor' class='smalltext'>
                                                            <p>
        		                                                <b>".$row2['attribute_value']."</b>
                                                            </p>
        		                                        </span>
        		                                    </td>";
                                        		}
                                            }  else if ($row1['attribute_id'] == 5) {

                                            	$sql3 = new db;
        					                	$sql3->db_Select(DB_TABLE_ROSTER_LEADER_STATUS, "*", "status_name='".$tp->toDB($row2['attribute_value'])."'");
        					                	while ($row3 = $sql3->db_Fetch()) {
        					                		$textColor = $row3['text_color'];
        					                	}

        					                	if ($row2['attribute_value'] == '') {
        		                                    $text_1 .= "
        		                                    <td style='border: 0px' valign='top' width='60%'>
        		                                        <span class='smalltext'>
                                                            <p>
        		                                                &nbsp;
                                                            </p>
        		                                        </span>
        		                                    </td>";
                                        		} else {
                                        			$text_1 .= "
        		                                    <td style='border: 0px' valign='top' width='60%'>
        		                                        <span style='color: $textColor' class='smalltext'>
                                                            <p>
        		                                                <b>".$row2['attribute_value']."</b>
                                                            </p>
        		                                        </span>
        		                                    </td>";
                                        		}
                                            } else if ($row2['attribute_id'] == 8) {
                                        		if ($row2['attribute_value'] == '') {
        		                                    $text_1 .= "
        		                                    <td style='border: 0px' valign='top' width='60%'>
        		                                        <span class='smalltext'>
                                                            <p>
        		                                                &nbsp;
                                                            </p>
        		                                        </span>
        		                                    </td>";
                                        		} else {
                                        			$text_1 .= "
        		                                    <td style='border: 0px' valign='top' width='60%'>
        		                                        <span class='smalltext'>
                                                            <p>
        		                                                <a href='mailto:".$row2['attribute_value']."'>".LAN_JBROSTER_GENERAL_EMAIL."</a>
        		                                            </p>
        		                                        </span>
        		                                    </td>";
                                        		}
                                            } else if ($row2['attribute_id'] == 9) {
                                        		if ($row2['attribute_value'] == '') {
        		                                    $text_1 .= "
        		                                    <td style='border: 0px' valign='top' width='60%'>
        		                                        <span class='smalltext'>
                                                            <p>
        		                                                &nbsp;
                                                            </p>
        		                                        </span>
        		                                    </td>";
                                        		} else {
                                        			$text_1 .= "
        		                                    <td style='border: 0px' valign='top' width='60%'>
        		                                        <span class='smalltext'>
                                                            <p>
        		                                                <a href='http://profile.xfire.com/".$row2['attribute_value']."' target='_blank'>".$row2['attribute_value']."</a>
        		                                            </p>
        		                                        </span>
        		                                    </td>";
                                        		}
                                            } else if ($row2['attribute_id'] == 15) {
                                        		if ($row2['attribute_value'] == '') {
        		                                    $text_1 .= "
        		                                    <td style='border: 0px' valign='top' width='60%'>
        		                                        <span class='smalltext'>
                                                            <p>
        		                                                &nbsp;
                                                            </p>
        		                                        </span>
        		                                    </td>";
                                        		} else {
                                        			$calcAge = calc_age($row2['attribute_value']);

                                        			$text_1 .= "
        		                                    <td style='border: 0px' valign='top' width='60%'>
        		                                        <span class='smalltext'>
                                                            <p>
        		                                                <b>$calcAge</b>
                                                            </p>
        		                                        </span>
        		                                    </td>";
                                        		}
                                            } else if ($row2['attribute_id'] == 49) {
                                        		if ($row2['attribute_value'] == '') {
                                        			$text_1 .= "
        		                                    <td style='border: 0px' valign='top' width='60%'>
        		                                        <span class='smalltext'>
                                                            <p>
        		                                                &nbsp;
                                                            </p>
        		                                        </span>
        		                                    </td>";
                                        		} else {
                                        			$text_1 .= "
        		                                    <td style='border: 0px' valign='top' width='60%'>
        		                                        <span class='smalltext'>
                                                            <p>
            													<b>";
            			                                        if ($row2['attribute_value'] == 0) {
            			                                        	$text_1 .= "
            			                                            &nbsp;";
            			                                        } else {
            			                                        	$text_1 .=
            			                                            date("m/d/Y", $row2['attribute_value']);
            			                                        }
            			                                        	$text_1 .= "
            													<b>
                                                            </p>
        		                                        </span>
        		                                    </td>";
                                        		}
                                            } else {
                                            	if ($row2['attribute_value'] == '') {
        		                                    $text_1 .= "
        		                                    <td style='border: 0px' valign='top' width='60%'>
        		                                        <span class='smalltext'>
                                                            <p>
        		                                                &nbsp;
                                                            </p>
        		                                        </span>
        		                                    </td>";
                                        		} else {
                                        			$text_1 .= "
        		                                    <td style='border: 0px' valign='top' width='60%'>
        		                                        <span class='smalltext'>
                                                            <p>
        		                                                ".$row2['attribute_value']."
                                                            </p>
        		                                        </span>
        		                                    </td>";
                                        		}
                                            }

                                        $text_1 .= "
                                        </tr>";
                                    }
                                }

                            $text_1 .= "
        					</table>
    					</p>
    				</td>
    				<td width='60%' style='border-left: 0px; vertical-align: top;' class='forumheader3'>
    					<center>
    					    <p>";

                                $sql1 = new db;
        						$sql1->db_Select(DB_TABLE_ROSTER_MEMBERS, "*", "member_id = ".intval($_GET['member_id']));
        						while ($row1 = $sql1->db_Fetch()) {
        							$external_image = $row1['external_image'];
        							$active_external_image = $row1['active_external_image'];
        						}

                                if ($active_external_image == 2) {
                                	// Display external image
                                	$text_1 .= "
        							<img src='$external_image' alt='' />";

        							$sql1->db_Select("user", "*", "user_id = ".intval($_GET['member_id']));
        							while ($row1 = $sql1->db_Fetch()) {
        								$user_sess = $row1['user_sess'];
        								$user_id = $row1['user_id'];
        							}

        							if(USERID == $user_id || (ADMIN && getperms("P"))){
        								$text_1 .= "
        								<p>
        								    <a href='member_profile_edit.php?alter_image=1&member_id=".$_GET['member_id']."'>".LAN_JBROSTER_GENERAL_EDIT_IMAGE."</a>
                                        </p>";
        							}

                                } else {
                                	// Display website profile image
        							$sql1->db_Select("user", "*", "user_id = ".intval($_GET['member_id']));
        							while ($row1 = $sql1->db_Fetch()) {
        								$user_sess = $row1['user_sess'];
        								$user_id = $row1['user_id'];
        							}

        							if($user_sess && file_exists(e_FILE."public/avatars/".$user_sess)){
        								$text_1 .= "<img src='".e_FILE."public/avatars/".$user_sess."' alt='' />";

        								if(ADMIN && getperms("P")){
        									$text_1 .= "
                                            <p>
                                                <span class='smalltext'>".$user_sess."</span>
                                            </p>";
        								}

        								if(USERID == $user_id || (ADMIN && getperms("P"))){
        									$text_1 .= "
                                            <p>
                                                <a href='member_profile_edit.php?alter_image=1&member_id=".$_GET['member_id']."'>".LAN_JBROSTER_GENERAL_EDIT_IMAGE."</a>
                                            </p>
                                            <p>
                                                <span class='smalltext'>[ <a href='../../user.php?delp.$user_id'>delete photo</a> ]</span>
                                            </p>";
        								}

        							} else {

        								$text_1 .= "<img src='images/blank_face_1.gif'>";

        								if(USERID == $user_id || (ADMIN && getperms("P"))){
        									$text_1 .= "
                                            <p>
                                                <a href='member_profile_edit.php?alter_image=1&member_id=".$_GET['member_id']."'>".LAN_JBROSTER_GENERAL_EDIT_IMAGE."</a>
                                            </p>";
        								}
        							}
                                }

        					$text_1 .= "
                            </p>
    					</center>
    				</td>
    			</tr>";

        		if ($sql->db_Count(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES, "(*)", "WHERE    profile_display = 2
        		                                                                     AND      attribute_id = 47") == 0) {
                    // Don't display Member Bio
                } else {
    				$text_1 .= "
        			<tr>
        				<td colspan=6 class='forumheader'>
        					<span class='smalltext'>
        						<b>".LAN_JBROSTER_MEMBER_PROFILE_MEMBER_BIO_HEADER."</b>
        					</span>
        				</td>
        			</tr>
        			<tr>
        				<td colspan=6 class='forumheader3'>
                            <p>
        				        <table border='0' cellspacing='15' style='width:95%' cellspacing='0' cellpadding='0'>
        							<p style='padding-top: 2em; padding-bottom: 2em;padding-left: 2em; padding-right: 2em'>
            							<span class='smalltext'>
            								".nl2br($memberBio)."
            							</span>
                                    </p>
        						</table>
                            </p>
        				</td>
        			</tr>";
                }
    		}

        	/************************************************************
        	 *
        	 * Display PC Specs
        	 *
        	 ************************************************************/

        	if ($sql->db_Count(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES, "(*)", "WHERE     profile_display = 2
        	                                                                     AND       attribute_id    > 34
        	                                                                     AND       attribute_id    < 47
        	                                                                     ORDER BY attribute_order") == 0) {
        		// Don't display PC Specs
        	} else {
        		$text_1 .= "
        		<tr>
        			<td colspan=6 class='forumheader'>
        				<span class='smalltext'>
        					<b>".LAN_JBROSTER_MEMBER_PROFILE_PC_SPECS_HEADER."</b>
        				</span>
        			</td>
        		</tr>
        		<tr>
        			<td colspan=6 class='forumheader3'>
        				<table border='0' cellspacing='0' style='width:95%;' cellspacing='0' cellpadding='0'>";

        					$sql1 = new db;
        		            $sql1->db_Select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES, "*", "profile_display  = 2
        		                                                                         AND attribute_id     > 34
        		                                                                         AND attribute_id     < 47
        		                                                                         ORDER BY attribute_order");
        		            while($row1 = $sql1->db_Fetch()) {

        		        		$sql2 = new db;
        		                $sql2->db_Select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES, "*", "member_id     =".intval($_GET['member_id'])."
        		                                                                            AND attribute_id  =".intval($row1['attribute_id']));
        		                while($row2 = $sql2->db_Fetch()) {

        		                	$text_1 .= "
        		                    <tr>
        		                        <td style='border: 0px' valign='top' width='33%'>
        									<span class='smalltext'>
                                                <p>
        		                                    <b>".$row2['attribute_name']."<b>
                                                </p>
        		                            </span>
        		                        </td>
        		                        <td style='border: 0px' valign='top' width='33%'>
        		                            <span class='smalltext'>
                                                <p>
        		                                    ".$row2['attribute_value']."
                                                <p>
        		                            </span>
        		                        </td>
        								<td style='border: 0px' valign='top' width='33%'>
        									&nbsp;
        								</td>
        		                    </tr>";
        		                }
        		            }

    		            $text_1 .= "
                        </table>
                    </td>
                </tr>";
        	}

        $text_1 .= "
    	</table>
    </div>
</p>

<center>
	<div style='width:100%'>
		<table style='width:100%; border: 0px' cellspacing='0' cellpadding='0'>
			<tr>
				<td>
                    <center>
                        <p>
                            <span class='smalltext'>[ <a href='jbroster.php'>".LAN_JBROSTER_GENERAL_RETURN_TO_ROSTER."</a> ]</span>
                        <p>
                    </center>
					<center>";

						if(USERID == $_GET['member_id'] || (ADMIN && getperms("P"))){
							$text_1 .= "
                            <p>
                                <span class='smalltext'>[ <a href='member_profile_edit.php?member_id=".$_GET['member_id']."&url=".$_SERVER['PHP_SELF']."'>".LAN_JBROSTER_MEMBER_PROFILE_EDIT_PROFILE."</a> ]</span>
                            </p>";
						}

					$text_1 .= "
					</center>
				</td>
			</tr>
		</table>
	</div>
</center>";

$title = LAN_JBROSTER_MEMBER_PROFILE_TITLE;
$ns->tablerender($title, $text_1);

require_once(FOOTERF);
?>
