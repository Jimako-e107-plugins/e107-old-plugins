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
if(file_exists(e_PLUGIN."jbroster_menu/languages/".e_LANGUAGE.".php")) {
    include_lan(e_PLUGIN."jbroster_menu/languages/".e_LANGUAGE.".php");
}

require_once("includes/config.constants.php");
require_once("includes/config.functions.php");

$debug = FALSE;
$sql = e107::getDb();
$sql->select(DB_TABLE_ROSTER_PREFERENCES);
while($row = $sql->fetch()) {
    $organization_name              = $row['organization_name'];
    $organization_type              = $row['organization_type'];
    $organization_designation       = $row['organization_designation'];
    $organization_unit_designation  = $row['organization_unit_designation'];
    $organization_logo              = $row['organization_logo'];
    $organization_logo_alignment    = $row['organization_logo_alignment'];
}

$sql->select(DB_TABLE_ROSTER_ORG_DESIGNATIONS, "*", "designation_id = ".intval($organization_designation));
while($row = $sql->fetch()) {
    $organization_designation_name = $row['designation_name'];
}

$sql->select(DB_TABLE_ROSTER_ORG_UNIT_DESIGNATIONS, "*", "designation_id = ".intval($organization_unit_designation));
while($row = $sql->fetch()) {
    $organization_unit_designation_name = $row['designation_name'];
}

$sql->select(DB_TABLE_ROSTER_LEADER_STATUS, "*", "status_name != 'None'
                                                 AND status_name != 'Organization Leader'
                                                 AND status_name != 'Organization Captain'
                                                 AND status_name != 'Web Admin'");
while($row = $sql->fetch()) {
	$customArgs .= " OR leader_status like '".$tp->toDB($row['status_name'])."%'";
}

/************************************************************
 *
 * Display Organization Logo
 *
 ************************************************************/

if ($organization_logo == "") {
	// Don't display the logo
} else {
    echo "
    <center>
        <p style='margin-top: 2em; margin-bottom: 2em'>
    	   <img align='$organization_logo_alignment' src='".e_PLUGIN."jbroster_menu/images/$organization_logo'>
        </p>
    </center>";
}

$numRows = $sql->count(DB_TABLE_ROSTER_MEMBERS);  

if($debug){ echo "<br />roster members= ".$numRows; }
 
if ($numRows == 0) {
    $text_1 .= "
    <center>
        <p>
            <div class='table-responsive'>
                <table class='table table-bordered' id='table_01'>
                    <tr>
                        <td class='forumheader3'>
                            <center>
                                <p style='margin-top: 2em; margin-bottom: 2em'>
                                    ".LAN_JBROSTER_GENERAL_NO_MEMBERS_IN_SYSTEM."
                                </p>
                            </center>
                        </td>
                    </tr>
                </table>
            </div>
        </p>
    </center>";

    $title = "";
    $ns->tablerender($title, $text_1);
}

/************************************************************
 *
 * Display Organization Leaders
 *
 ************************************************************/


if (($sql->count(DB_TABLE_ROSTER_MEMBERS, "(*)", "WHERE leader_status like 'Organization Leader%' OR leader_status like 'Organization Captain%' OR leader_status like 'Web Admin%'$customArgs") == 0) ||
	($sql->count(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES, "(*)", "WHERE main_display= 2") == 0)) {
	// Don't display leader block
	if($debug){ 
	  $count1 = ($sql->count(DB_TABLE_ROSTER_MEMBERS, "(*)", "WHERE leader_status like 'Organization Leader%' OR leader_status like 'Organization Captain%' OR leader_status like 'Web Admin%'$customArgs") == 0);
	  $count2 = ($sql->count(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES, "(*)", "WHERE main_display= 2") == 0);
		echo "<br />Organization leaders ".$count1;
	  echo "<br />Main display = 2  ".$count2;
	  echo "<br />- don't display leader block";
		  }
} else {    
	$text_1 .= "
	<center>
        <p>
            <div class='table-responsive'>
                <table class='table table-bordered' id='table_02'>
            		<tr>
                        <th colspan='20' class='forumheader'>
                            <span class='smalltext'>";

	                            if(file_exists(e_LANGUAGE == "English")) {
                                    $text_1 .= "
                                    <b>$organization_designation_name ".LAN_JBROSTER_MAIN_PAGE_LEADER_HEADER."s</b>";
	                            } else {
	                                $text_1 .= "
                                    <b>$organization_designation_name ".LAN_JBROSTER_MAIN_PAGE_LEADER_HEADER."</b>";
	                            }

	                        $text_1 .= "
                            </span>
                        </th>
                    </tr>
                    <tr>
                        <th class='forumheader3'>
                            <span class='smalltext'>
                                <b>".LAN_JBROSTER_GENERAL_LEADER_STATUS."</b>
                            </span>
                        </th>";

                        $sql1 = e107::getDb('sql1'); 
                        $sql1->select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES, "*", "main_display = 2 ORDER BY attribute_order");
                		while ($row1 = $sql1->fetch()) {
                			if ($row1['attribute_id'] == 3) {
                                // Don't display 'Team Status'
                            } else {
                				if ($row1['attribute_id'] == 34) {
                					$text_1 .= "
                					<th class='forumheader3'>
                		                <span class='smalltext'>
                		                    <b>".$row1['attribute_name']." $organization_name</b>
                		                </span>
                		            </th>";
                				} else {
                					$text_1 .= "
                					<th class='forumheader3'>
                		                <span class='smalltext'>
                		                    <b>".$row1['attribute_name']."</b>
                		                </span>
                		            </th>";
                				}
                            }
                		}

            		$text_1 .= "
            		</tr>";

            		if($sql1->count(DB_TABLE_ROSTER_MEMBERS, "(*)", "WHERE leader_status like 'Organization Leader%'
            		                                                    OR    leader_status like 'Organization Captain%'
            		                                                    OR    leader_status like 'Web Admin%'$customArgs") > 0) {

            		  $sql2 = e107::getDb('sql2');   
            			$sql2->select(DB_TABLE_ROSTER_MEMBERS, "*", "leader_status like 'Organization Leader%'
            			                                             OR leader_status like 'Organization Captain%'
            			                                             OR leader_status like 'Web Admin%'$customArgs
            			                                             ORDER BY leader_order");
                        while($row2 = $sql2->fetch()) {

                        		$sql3 = e107::getDb('sql2');  
                            $sql3->select(DB_TABLE_ROSTER_MEMBERS, "*", "member_id = ".intval($row2['member_id']));
                            while ($row3 = $sql3->fetch()) {
                                $leaderStatusLeader = $row3['leader_status'];

                                $sql4 = e107::getDb('sql4');  
                                $sql4->select(DB_TABLE_ROSTER_LEADER_STATUS, "*", "status_name = '".$tp->toDB($leaderStatusLeader)."'");
                                while ($row4 = $sql4->fetch()) {
                                    $textColorLeader = $row4['text_color'];
                                }
                            }

                            $text_1 .="
                            <tr>
                                <td class='forumheader3'>
                                    <span style='color: $textColorLeader' class='smalltext'>
                                        <b>$leaderStatusLeader</b>
                                    </span>
                                </td>";

            			    $sql3->select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES, "*", "main_display = 2 ORDER BY attribute_order");
            				while ($row3 = $sql3->fetch()) {


            					$sql4 = e107::getDb('sql4');  
            				  $sql4->select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES, "*", "member_id           = ".intval($row2['member_id'])."
            				                                                                    AND attribute_id    = ".intval($row3['attribute_id']));
            					while ($row4 = $sql4->fetch()) {
            						$member_id = $row4['member_id'];
            						$attributeValue = $row4['attribute_value'];
            					}

            					if ($row3['attribute_id'] == 1) {

            						if ($attributeValue == '') {
            							$text_1 .= "
            							<td class='forumheader3'>
            				                <span class='smalltext'>
            				                    &nbsp;   
            				                </span>
            				            </td>";
            						} else {
            							$text_1 .= "
            							<td class='forumheader3'>
            				                <span class='smalltext'>
            				                    <a href='member_profile.php?member_id=$member_id&url=".$_SERVER['PHP_SELF']."'>$attributeValue</a>
            				                </span>
            				            </td>";
            						}

            					} else if ($row3['attribute_id'] == 2) {

            						if ($attributeValue == '') {
            							$text_1 .= "
            							<td class='forumheader3'>
            				                <span class='smalltext'>
            				                    &nbsp;
            				                </span>
            				            </td>";
            						} else {
            							$text_1 .= "
            							<td class='forumheader3'>
            				                <span class='smalltext'>
            				                    <a href='member_profile.php?member_id=$member_id'>$attributeValue</a>
            				                </span>
            				            </td>";
            						}

            					} else if ($row3['attribute_id'] == 3) {
                                    // Don't display 'Team Status'
                                } else if ($row3['attribute_id'] == 4) {

            										$sql4 = e107::getDb('sql4');  
            	                	$sql4->select(DB_TABLE_ROSTER_MEMBER_STATUS, "*", "status_name = '".$tp->toDB($attributeValue)."'");
            	                	while ($row4 = $sql4->fetch()) {
            	                		$textColor = $row4['text_color'];
            	                	}

            						if ($attributeValue == '') {
            							$text_1 .= "
            							<td class='forumheader3'>
            				                <span class='smalltext'>
            				                    &nbsp;
            				                </span>
            				            </td>";
            						} else {
            							$text_1 .= "
            							<td class='forumheader3'>
            				                <span style='color: $textColor' class='smalltext'>
            				                    $attributeValue
            				                </span>
            				            </td>";
            						}

            					} else if ($row3['attribute_id'] == 5) {

            										$sql4 = e107::getDb('sql4');  
            	                	$sql4->select(DB_TABLE_ROSTER_LEADER_STATUS, "*", "status_name = '".$tp->toDB($attributeValue)."'");
            	                	while ($row4 = $sql4->fetch()) {
            	                		$textColor = $row4['text_color'];
            	                	}

            						if ($attributeValue == '') {
            							$text_1 .= "
            							<td class='forumheader3'>
            				                <span class='smalltext'>
            				                    &nbsp;
            				                </span>
            				            </td>";
            						} else {
            							$text_1 .= "
            							<td class='forumheader3'>
            				                <span style='color: $textColor' class='smalltext'>
            				                    <b>$attributeValue</b>
            				                </span>
            				            </td>";
            						}

            					} else if ($row3['attribute_id'] == 8) {

            						if ($attributeValue == '') {
            							$text_1 .= "
            							<td class='forumheader3'>
            				                <span class='smalltext'>
            				                    &nbsp;
            				                </span>
            				            </td>";
            						} else {
            							$text_1 .= "
            							<td class='forumheader3'>
            				                <span class='smalltext'>
            				                    <a href='mailto:$attributeValue'>".LAN_JBROSTER_GENERAL_EMAIL."</a>
            				                </span>
            				            </td>";
            						}

            					} else if ($row3['attribute_id'] == 9) {

            						if ($attributeValue == '') {
            							$text_1 .= "
            							<td class='forumheader3'>
            				                <span class='smalltext'>
            				                    &nbsp;
            				                </span>
            				            </td>";
            						} else {
            							$text_1 .= "
            							<td class='forumheader3'>
            				                <span class='smalltext'>
            				                    <a href='http://profile.xfire.com/$attributeValue' target='_blank'>$attributeValue</a>
            				                </span>
            				            </td>";
            						}

            					} else if ($row3['attribute_id'] == 15) {

            						if ($attributeValue == '') {
            							$text_1 .= "
            							<td class='forumheader3'>
            				                <span class='smalltext'>
            				                    &nbsp;
            				                </span>
            				            </td>";
            						} else {

            							$calcAge = calc_age($attributeValue);

            							$text_1 .= "
            							<td class='forumheader3'>
            				                <span class='smalltext'>
            									<center>
            										<b>$calcAge</b>
            									</center>
            				                </span>
            				            </td>";
            						}

            					} else if ($row3['attribute_id'] == 49) {

            						if ($attributeValue == '') {
            							$text_1 .= "
            							<td class='forumheader3'>
            				                <span class='smalltext'>
            				                    &nbsp;
            				                </span>
            				            </td>";
            						} else {
            							$text_1 .= "
            							<td class='forumheader3'>
            				                <span class='smalltext'>
            									<b>";
            									if($attributeValue == 0) {
            										$text_1 .= "
            										&nbsp;";
            									} else {
            										$text_1 .=
            										date("m/d/Y", $attributeValue);
            									}
            								$text_1 .= "
            									</b>
            				                </span>
            				            </td>";
            						}

            					} else {

            						if ($attributeValue == '') {

            							$text_1 .= "
            							<td class='forumheader3'>
            				                <span class='smalltext'>
            				                    &nbsp;
            				                </span>
            				            </td>";
            						} else {

            							$text_1 .= "
            							<td class='forumheader3'>
            				                <span class='smalltext'>
            				                    <b>$attributeValue</b>
            				                </span>
            				            </td>";
            						}
            					}
            				}

            				$text_1 .= "</tr>";
                        }

            		} else {

            			$text_1 .= "
            			<tr>
                            <td colspan=20 class='forumheader3'>
                                <span class='smalltext'>
            						<center>
            						    <p>
            						        ".LAN_JBROSTER_MAIN_PAGE_NO_LEADERS."
                                        </p>
            						</center>
                                </span>
                            </td>
                        </tr>";
            		}

                    $text_1 .= "
                    </tr>
                </table>
            </div>
       </p>
	</center>";

    // Render the value of $text_1 in a table.
    $title = $organization_name." ".LAN_JBROSTER_MAIN_PAGE_LEADERSHIP_HEADER;
    $ns->tablerender($title, $text_1);
}

/************************************************************
 *
 * Display Organization Teams
 *
 ************************************************************/

if (($sql->count(DB_TABLE_ROSTER_TEAMS, "(*)", "WHERE display = 2") == 0) ||
	($sql->count(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES, "(*)", "WHERE main_display = 2") == 0)) {
	// Don't display teams block
} else {    
  $sql1 = e107::getDb('sql1');   
	$sql1->select(DB_TABLE_ROSTER_TEAMS, "*", "display = 2 ORDER BY team_order");
	while($row1 = $sql1->fetch()) {

	    $text_2 .= "
	    <center>
	        <p>
    	        <div class='table-responsive'>
    	            <table class='table table-bordered' id='table_03'>
    	                <tr>
    	                    <td colspan=20>
    	                        <table width='100%' cellspacing='0' cellpadding='0'>
    	                            <tr>";
    	                                if ($row1['team_name'] == '') {
    	                                    $text_2 .= "
    	                                    <td colspan=2 style='border-right: 0px;' width='50%' class='forumheader3'>&nbsp;</td>";
    	                                } else {
    	                                    $text_2 .= "
    	                                        <td colspan=2 style='border-right: 0px;' width='50%' class='forumheader' align=right width='50%'>
    	                                            <span style='color: ".$row1['text_color'].";' class='smalltext'>
    	                                                <b>".$row1['team_name']."</b>
    	                                            </span>
    	                                        </td>";
    	                                }
    	                                if ($row1['game_name'] == '') {
    	                                    $text_2 .= "
    	                                    <td colspan=2 style='border-left: 0px;' width='50%' class='forumheader3'>&nbsp;</td>";
    	                                } else {
    	                                    $sql2 = e107::getDb('sql2');  
    	                                    $sql2->select(DB_TABLE_ROSTER_GAMES, "*", "game_name = '".$tp->toDB($row1['game_name'])."'");
    	                                    while ($row2 = $sql2->fetch()) {
    	                                        $text_2 .= "
    	                                        <td colspan=2 style='border-left: 0px;' width='50%' class='forumheader' align=right>
    	                                            <span class='smalltext'>
    	                                                <b>".LAN_JBROSTER_GENERAL_GAME.": </b>
    	                                                <span style='color: ".$row2['text_color'].";'>
    	                                                    <b>".$row1['game_name']."</b>
    	                                                </span>
    	                                            </span>
    	                                        </td>";
    	                                    }
    	                                }
    	                            $text_2 .= "
    	                            </tr>
    	                        </table>
    	                    </td>
    	                </tr>";

    	                $text_2 .= "<tr>";

    			        $sql2 = e107::getDb('sql2');  
    			        $sql2->select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES, "*", "main_display = 2 ORDER BY attribute_order");
    					while ($row2 = $sql2->fetch()) {

    						if ($row2['attribute_id'] == 34) {
    							$text_2 .= "
    							<td class='forumheader3'>
    				                <span class='smalltext'>
    				                    <b>".$row2['attribute_name']." $organization_name</b>
    				                </span>
    				            </td>";
    						} else {
    							$text_2 .= "
    							<td class='forumheader3'>
    				                <span class='smalltext'>
    				                    <b>".$row2['attribute_name']."</b>
    				                </span>
    				            </td>";
    						}
    					}
    					$text_2 .= "</tr>";

    	                if($sql2->count(DB_TABLE_ROSTER_TEAM_MEMBERS, "(*)", "WHERE team_id = ".intval($row1['team_id'])) > 0) {

    											$sql3 = e107::getDb('sql3');  
    	                    $sql3->select(DB_TABLE_ROSTER_TEAM_MEMBERS, "*", "team_id = ".intval($row1['team_id'])." ORDER BY member_team_order");
    	                    while($row3 = $sql3->fetch()) {

    	                        $text_2 .="<tr>";

    							  $sql4 = e107::getDb('sql4');  
    						    $sql4->select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES, "*", "main_display=2 ORDER BY attribute_order");
    							while ($row4 = $sql4->fetch()) {

    								$sql5 = e107::getDb('sql5');  
    							  $sql5->select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES, "*", "member_id        = ".intval($row3['member_id'])."
    							                                                                    AND attribute_id = ".intval($row4['attribute_id']));
    								while ($row5 = $sql5->fetch()) {
    									$member_id = $row5['member_id'];
    									$attributeValue = $row5['attribute_value'];
    								}

    								if ($row4['attribute_id'] == 1) {

    									if ($attributeValue == '') {
    										$text_2 .= "
    										<td class='forumheader3'>
    							                <span class='smalltext'>
    							                    &nbsp;
    							                </span>
    							            </td>";
    									} else {
    										$text_2 .= "
    										<td class='forumheader3'>
    							                <span class='smalltext'>
    							                    <a href='member_profile.php?member_id=$member_id'>$attributeValue</a>
    							                </span>
    							            </td>";
    									}

    								} else if ($row4['attribute_id'] == 2) {

    									if ($attributeValue == '') {
    										$text_2 .= "
    										<td class='forumheader3'>
    							                <span class='smalltext'>
    							                    &nbsp;
    							                </span>
    							            </td>";
    									} else {
    										$text_2 .= "
    										<td class='forumheader3'>
    							                <span class='smalltext'>
    							                    <a href='member_profile.php?member_id=$member_id'>$attributeValue</a>
    							                </span>
    							            </td>";
    									}

    								} else if ($row4['attribute_id'] == 4) {

    													$sql5 = e107::getDb('sql5'); 
    				                	$sql5->select(DB_TABLE_ROSTER_MEMBER_STATUS, "*", "status_name = '".$tp->toDB($attributeValue)."'");
    				                	while ($row5 = $sql5->fetch()) {
    				                		$textColor = $row5['text_color'];
    				                	}

    									if ($attributeValue == '') {
    										$text_2 .= "
    										<td class='forumheader3'>
    							                <span class='smalltext'>
    							                    &nbsp;
    							                </span>
    							            </td>";
    									} else {
    										$text_2 .= "
    										<td class='forumheader3'>
    							                <span style='color: $textColor' class='smalltext'>
    							                    <b>$attributeValue</b>
    							                </span>
    							            </td>";
    									}

    								} else if ($row4['attribute_id'] == 5) {

    													$sql5 = e107::getDb('sql5');  
    				                	$sql5->select(DB_TABLE_ROSTER_LEADER_STATUS, "*", "status_name = '".$tp->toDB($attributeValue)."'");
    				                	while ($row5 = $sql5->fetch()) {
    				                		$textColor = $row5['text_color'];
    				                	}

    									if ($attributeValue == '') {
    										$text_2 .= "
    										<td class='forumheader3'>
    							                <span class='smalltext'>
    							                    &nbsp;
    							                </span>
    							            </td>";
    									} else {
    										$text_2 .= "
    										<td class='forumheader3'>
    							                <span style='color: $textColor' class='smalltext'>
    							                    <b>$attributeValue</b>
    							                </span>
    							            </td>";
    									}

    								} else if ($row4['attribute_id'] == 8) {

    									if ($attributeValue == '') {
    										$text_2 .= "
    										<td class='forumheader3'>
    							                <span class='smalltext'>
    							                    &nbsp;
    							                </span>
    							            </td>";
    									} else {
    										$text_2 .= "
    										<td class='forumheader3'>
    							                <span class='smalltext'>
    							                    <a href='mailto:$attributeValue'>".LAN_JBROSTER_GENERAL_EMAIL."</a>
    							                </span>
    							            </td>";
    									}

    								} else if ($row4['attribute_id'] == 9) {

    									if ($attributeValue == '') {
    										$text_2 .= "
    										<td class='forumheader3'>
    							                <span class='smalltext'>
    							                    &nbsp;
    							                </span>
    							            </td>";
    									} else {
    										$text_2 .= "
    										<td class='forumheader3'>
    							                <span class='smalltext'>
    							                    <a href='http://profile.xfire.com/$attributeValue' target='_blank'>$attributeValue</a>
    							                </span>
    							            </td>";
    									}

    								} else if ($row4['attribute_id'] == 15) {

    									if ($attributeValue == '') {
    										$text_2 .= "
    										<td class='forumheader3'>
    							                <span class='smalltext'>
    							                    &nbsp;
    							                </span>
    							            </td>";
    									} else {

    										$calcAge = calc_age($attributeValue);

    										$text_2 .= "
    										<td class='forumheader3'>
    							                <span class='smalltext'>
    												<center>
    													<b>$calcAge</b>
    												</center>
    							                </span>
    							            </td>";
    									}

    								} else if ($row4['attribute_id'] == 49) {

    									if ($attributeValue == '') {
    										$text_2 .= "
    										<td class='forumheader3'>
    							                <span class='smalltext'>
    							                    &nbsp;
    							                </span>
    							            </td>";
    									} else {

    										$text_2 .= "
    										<td class='forumheader3'>
    							                <span class='smalltext'>
    												<b>";
    												if($attributeValue == 0) {
    													$text_2 .= "
    													&nbsp;";
    												} else {
    													$text_2 .=
    													date("m/d/Y", $attributeValue);
    												}
    											$text_2 .= "
    												</b>
    							                </span>
    							            </td>";
    									}

    								} else if ($row4['attribute_id'] == 3) {

                                        $sql5 = e107::getDb('sql5');  
                                        $sql5->select(DB_TABLE_ROSTER_TEAM_STATUS, "*", "status_name     = '".$tp->toDB($row3['member_team_status'])."'
                                                                                            AND game_name   = '".$tp->toDB($row3['game_name'])."'");
                                        while ($row5 = $sql5->fetch()) {
                                            $text_color = $row5['text_color'];
                                        }

                                        $text_2 .= "
                                            <td width='33%' class='forumheader3'>
                                                <span style='color: $text_color;' class='smalltext'>
                                                    <center>
                                                        <b>".$row3['member_team_status']."</b>
                                                    </center>
                                                </span>
                                            </td>";

                                    } else {

    									if ($attributeValue == '') {

    										$text_2 .= "
    										<td class='forumheader3'>
    							                <span class='smalltext'>
    							                    &nbsp;
    							                </span>
    							            </td>";
    									} else {

    										$text_2 .= "
    										<td class='forumheader3'>
    							                <span class='smalltext'>
    							                    <b>$attributeValue</b>
    							                </span>
    							            </td>";
    									}
    								}
    							}
    	                    }

    	                } else {
    						$text_2 .= "<tr>
    			                <td colspan=20 class='forumheader3'>
    			                    <span class='smalltext'>
    									<center>
    									    <p>
    									        ".LAN_JBROSTER_MAIN_PAGE_NO_MEMBERS_UNIT." $organization_unit_designation_name
                                            </p>
    									</center>
    			                    </span>
    			                </td>";
    					}

    	                $text_2 .= "
    	                </tr>
    	            </table>
    	        </div>
	        </p>
	    <center>";
	}

	if(file_exists(e_LANGUAGE == "English")) {
	   $title = "$organization_name ".$organization_unit_designation_name."s";
	} else {
	    $title = "$organization_name ".$organization_unit_designation_name;
	}
	$ns->tablerender($title, $text_2);
}

/************************************************************
 *
 * Display Organization Members By Status
 *
 ************************************************************/

if (($sql->count(DB_TABLE_ROSTER_MEMBER_STATUS, "(*)", "WHERE display = 2") == 0) ||
	($sql->count(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES, "(*)", "WHERE main_display = 2") == 0)) {
	// Don't display teams block
} else {
  $sql1 = e107::getDb('sql1');  
	$sql1->select(DB_TABLE_ROSTER_MEMBER_STATUS, "*", "display = 2 ORDER BY status_order");
	while($row1 = $sql1->fetch()) {

        $text_3 .= "
        <center>
            <p>
                <div class='table-responsive'>
                    <table class='table table-bordered' id='table_04'>
                        <tr id='row_01'>
                            <td colspan=20>
                                <table width='100%' cellspacing='0' cellpadding='0'>
                                    <tr>
                                        <td colspan=20 width='100%' class='forumheader'>
                                            <span class='smalltext'>
                                                <center>";

                                                    if(file_exists(e_LANGUAGE == "English")) {
                                                        $text_3 .= "
                                                        <b>".$row1['status_name']."s</b>";
                                                    } else {
                                                        $text_3 .= "
                                                        <b>".$row1['status_name']."</b>";
                                                    }

                                                $text_3 .= "
                                                </center>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>";
                       
							        $sql2 = e107::getDb('sql2');
							        $sql2->select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES, "*", "main_display = 2 ORDER BY attribute_order");
									while ($row2 = $sql2->fetch()) {

                                        if ($row2['attribute_id'] == 3) {
                                            // Don't display 'Team Status'
                                        } else {

											if ($row2['attribute_id'] == 34) {
												$text_3 .= "
												<td class='forumheader3'>
									                <span class='smalltext'>
									                    <b>".$row2['attribute_name']." $organization_name</b>
									                </span>
									            </td>";
											} else {
												$text_3 .= "
												<td class='forumheader3'>
									                <span class='smalltext'>
									                    <b>".$row2['attribute_name']."</b>
									                </span>
									            </td>";
											}
                                        }
									}

									$text_3 .= "</tr>";

		                    		if(($sql2->count(DB_TABLE_ROSTER_MEMBERS, "(*)", "WHERE  member_status = '".$tp->toDB($row1['status_name'])."'")) > 0) {

			                            $sql3 = e107::getDb('sql3');
			                            $sql3->select(DB_TABLE_ROSTER_MEMBERS, "*", "member_status = '".$tp->toDB($row1['status_name'])."' ORDER BY nickname");
			                            while($row3 = $sql3->fetch()) {

			                            	$text_3 .="<tr id='row_02'>";

											$sql4 = e107::getDb('sql4');
										  $sql4->select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES, "*", "main_display = 2 ORDER BY attribute_order");
											while ($row4 = $sql4->fetch()) {


												$sql5 = e107::getDb('sql5');
											    $sql5->select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES, "*", "member_id        = ".intval($row3['member_id'])."
											                                                                AND attribute_id = ".intval($row4['attribute_id']));
												while ($row5 = $sql5->fetch()) {
													$member_id = $row5['member_id'];
													$attributeValue = $row5['attribute_value'];
												}

												if ($row4['attribute_id'] == 1) {

													if ($attributeValue == '') {
														$text_3 .= "
														<td id='cell_01' class='forumheader3'>
											                <span class='smalltext'>
											                    ".intval($row3['member_id'])." - ".intval($row4['attribute_id'])."
											                </span>
											            </td>";
													} else {
														$text_3 .= "
														<td id='cell_02' class='forumheader3'>
											                <span class='smalltext'>
											                    <a href='member_profile.php?member_id=$member_id'>$attributeValue</a>
											                </span>
											            </td>";
													}

												} else if ($row4['attribute_id'] == 2) {

													if ($attributeValue == '') {
														$text_3 .= "
														<td id='cell_03' class='forumheader3'>
											                <span class='smalltext'>
											                    &nbsp;
											                </span>
											            </td>";
													} else {
														$text_3 .= "
														<td id='cell_04' class='forumheader3'>
											                <span class='smalltext'>
											                    <a href='member_profile.php?member_id=$member_id'>$attributeValue</a>
											                </span>
											            </td>";
													}

												} else if ($row4['attribute_id'] == 3) {
                                                    // Don't display 'Team Status'
                                                } else if ($row4['attribute_id'] == 4) {

													$sql5 = e107::getDb('sql5');
								                	$sql5->select(DB_TABLE_ROSTER_MEMBER_STATUS, "*", "status_name = '".$tp->toDB($attributeValue)."'");
								                	while ($row5 = $sql5->fetch()) {
								                		$textColor = $row5['text_color'];
								                	}

													if ($attributeValue == '') {
														$text_3 .= "
														<td id='cell_05' class='forumheader3'>
											                <span class='smalltext'>
											                    &nbsp;
											                </span>
											            </td>";
													} else {
														$text_3 .= "
														<td id='cell_06' class='forumheader3'>
											                <span style='color: $textColor' class='smalltext'>
											                    <b>$attributeValue</b>
											                </span>
											            </td>";
													}

												} else if ($row4['attribute_id'] == 5) {

													$sql5 = e107::getDb('sql5');
								                	$sql5->select(DB_TABLE_ROSTER_LEADER_STATUS, "*", "status_name = '".$tp->toDB($attributeValue)."'");
								                	while ($row5 = $sql5->fetch()) {
								                		$textColor = $row5['text_color'];
								                	}

													if ($attributeValue == '') {
														$text_3 .= "
														<td id='cell_07' class='forumheader3'>
											                <span class='smalltext'>
											                    &nbsp;
											                </span>
											            </td>";
													} else {
														$text_3 .= "
														<td id='cell_08' class='forumheader3'>
											                <span style='color: $textColor' class='smalltext'>
											                    <b>$attributeValue</b>
											                </span>
											            </td>";
													}

												} else if ($row4['attribute_id'] == 8) {

													if ($attributeValue == '') {
														$text_3 .= "
														<td id='cell_09' class='forumheader3'>
											                <span class='smalltext'>
											                    &nbsp;
											                </span>
											            </td>";
													} else {
														$text_3 .= "
														<td id='cell_10' class='forumheader3'>
											                <span class='smalltext'>
											                    <a href='mailto:$attributeValue'>".LAN_JBROSTER_GENERAL_EMAIL."</a>
											                </span>
											            </td>";
													}

												} else if ($row4['attribute_id'] == 9) {

													if ($attributeValue == '') {
														$text_3 .= "
														<td id='cell_11' class='forumheader3'>
											                <span class='smalltext'>
											                    &nbsp;
											                </span>
											            </td>";
													} else {
														$text_3 .= "
														<td id='cell_12' class='forumheader3'>
											                <span class='smalltext'>
											                    <a href='http://profile.xfire.com/$attributeValue' target='_blank'>$attributeValue</a>
											                </span>
											            </td>";
													}

												} else if ($row4['attribute_id'] == 15) {

													if ($attributeValue == '') {
														$text_3 .= "
														<td id='cell_13' class='forumheader3'>
											                <span class='smalltext'>
											                    &nbsp;
											                </span>
											            </td>";
													} else {

														$calcAge = calc_age($attributeValue);

														$text_3 .= "
														<td id='cell_14' class='forumheader3'>
											                <span class='smalltext'>
																<center>
																	<b>$calcAge</b>
																</center>
											                </span>
											            </td>";
													}

												} else if ($row4['attribute_id'] == 49) {

													if ($attributeValue == '') {
														$text_3 .= "
														<td id='cell_15' class='forumheader3'>
											                <span class='smalltext'>
											                    &nbsp;
											                </span>
											            </td>";
													} else {
														$text_3 .= "
														<td id='cell_16' class='forumheader3'>
											                <span class='smalltext'>
																<b>";
																if($attributeValue == 0) {
																	$text_3 .= "
																	&nbsp;";
																} else {
																	$text_3 .=
																	date("m/d/Y", $attributeValue);
																}
															$text_3 .= "
																</b>
											                </span>
											            </td>";
													}

												} else {

													if ($attributeValue == '') {

														$text_3 .= "
														<td id='cell_17' class='forumheader3'>
											                <span class='smalltext'>
											                    &nbsp;
											                </span>
											            </td>";
													} else {

														$text_3 .= "
														<td id='cell_18' class='forumheader3'>
											                <span class='smalltext'>
											                    <b>$attributeValue</b>
											                </span>
											            </td>";
													}
												}
											}
			                            }

				                    } else {

										$text_3 .= "
										<tr id='row_03'>
							                <td colspan=20 class='forumheader3'>
							                    <span class='smalltext'>
													<center>
													    <p>
													        ".LAN_JBROSTER_MAIN_PAGE_NO_MEMBERS_STATUS."
                                                        </p>
													</center>
							                    </span>
							                </td>
							            </tr>";
									}

                                    $text_3 .= "
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </p>
        </center>";

        $count++;
	}

	$title = "";
	$ns->tablerender($title, $text_3);
}
		 
require_once(FOOTERF);
?>
