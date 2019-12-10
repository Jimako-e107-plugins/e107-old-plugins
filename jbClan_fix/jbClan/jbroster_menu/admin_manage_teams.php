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

$pageid = "admin_menu_03";

$sql->db_Select(DB_TABLE_ROSTER_PREFERENCES, "*", "organization_id = 1");
while ($row = $sql->db_Fetch()) {
    $organizationType = $row['organization_type'];
}

$sql->db_Select(DB_TABLE_ROSTER_LEADER_STATUS, "*", "status_name != 'None' AND status_name != 'Organization Leader' AND status_name != 'Organization Captain' AND status_name != 'Web Admin'");
while($row = $sql->db_Fetch()) {
	$customArgs .= " OR leader_status like '".$tp->toDB($row['status_name'])."%'";
}

if ($sql->db_Count(DB_TABLE_ROSTER_MEMBERS, "(*)", "WHERE leader_status like 'Organization Leader%' OR leader_status like 'Organization Captain%' OR leader_status like 'Web Admin%'$customArgs") == 0) {
	// Don't display leader block
} else {
	$text_1 = "
	<form action='admin_manage_teams_edit.php' method='POST'>
    	<center>
        	<div style='width:70%'>
        	    <table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
        	        <tr>
        	            <td colspan='6' class='forumheader'><b>".LAN_JBROSTER_ADMIN_MANAGE_TEAMS_ORG_LEADERS_CAPTION."</b></td>
        	        </tr>
        	        <tr>
        	            <td class='forumheader3'><b>".LAN_JBROSTER_ADMIN_MANAGE_TEAMS_NAME."</b></td>
        				<td class='forumheader3'><b>".LAN_JBROSTER_GENERAL_EMAIL."</b></td>
        	            <td class='forumheader3'><b><center>".LAN_JBROSTER_ADMIN_MANAGE_TEAMS_ORG_LEADER."</center></b></td>
        	            <td class='forumheader3'><b><center>".LAN_JBROSTER_ADMIN_MANAGE_TEAMS_CHANGE_ORDER."</center></b></td>
        	        </tr>";

	                $sql1 = new db;
        	        $sql1->db_Select(DB_TABLE_ROSTER_MEMBERS, "*", "leader_status like 'Organization Leader%'
    	                                                         OR leader_status like 'Organization Captain%'
                                                                 OR leader_status like 'Web Admin%'$customArgs
                                                                 ORDER BY leader_order");
        	        while($row1 = $sql1->db_Fetch()) {
        	        	$sql2 = new db;
        				$sql2->db_Select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES, "*", "member_id           = ".intval($row1['member_id'])."
        				                                                                AND attribute_id    = 5");
        				while($row2 = $sql2->db_Fetch()) {
        					$leaderStatus = $row2['attribute_value'];
        				}

        				$sql2->db_Select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES, "*", "member_id           = ".intval($row1['member_id'])."
        				                                                                AND attribute_id    = 8");
        				while($row2 = $sql2->db_Fetch()) {
        					$email = $row2['attribute_value'];
        				}

        				$sql2->db_Select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES, "*", "member_id           = ".intval($row1['member_id'])."
        				                                                                AND attribute_id    = 9");
        				while($row2 = $sql2->db_Fetch()) {
        					$xfire = $row2['attribute_value'];
        				}

        	            $text_1 .="<tr>";
        	            if ($row1['nickname'] == '') {
        	                $text_1 .= "
        	                <td class='forumheader3'>&nbsp;</td>";
        	            } else {
        	                $text_1 .= "
        	                <td class='forumheader3'>".$row1['nickname']."</td>";
        	            }

        	            if ($email == '') {
        	                $text_1 .= "
        	                <td class='forumheader3'>&nbsp;</td>";
        	            } else {
        	                $text_1 .= "
        	                <td class='forumheader3'><a href='mailto:$email'>".LAN_JBROSTER_GENERAL_EMAIL."</a></td>";
        	            }

        	            $text_1 .= "
        		        <td class='forumheader3'>
        		            <select class='tbox' name='leader_status[]'>";

        		            $sql2->db_Select(DB_TABLE_ROSTER_LEADER_STATUS, "*", "ORDER BY status_order", "no-where");
        		            while ($row2 = $sql2->db_Fetch()) {
        		                if ($row1['leader_status'] == $row2['status_name']) {
        		                    $text_1 .= "
        		                    <option value='".$row1['member_id'].DELIMITER_1.$row2['status_name']."' selected='selected'>".$row2['status_name']."</option>";
        		                } else {
        		                    $text_1 .= "
        		                    <option value='".$row1['member_id'].DELIMITER_1.$row2['status_name']."'>".$row2['status_name']."</option>";
        		                }
        		            }

        		            $text_1 .= "
        		            </select>
        		        </td>
        	            <td class='forumheader3'>
        	                <center>
        	                    <select class='tbox' name='leader_new_member_leader_order[]'>";

        		                $sql3 = new db;
        	                    $num_rows = $sql3->db_Count(DB_TABLE_ROSTER_MEMBERS, "(*)", " WHERE leader_status like 'Organization Leader%'
        	                                                                                  OR    leader_status like 'Organization Captain%'
        	                                                                                  OR leader_status like 'Web Admin%'$customArgs ");
        	                    $count = 1;
        	                    while ($count <= $num_rows) {
        	                        if ($row1['leader_order'] == $count) {
        	                            $text_1 .= "
        	                            <option value='leader".DELIMITER_1.$row1['member_id'].DELIMITER_1.$count."' selected='selected'>".$count."</option>";
        	                        } else {
        	                            $text_1 .= "
        	                            <option value='leader".DELIMITER_1.$row1['member_id'].DELIMITER_1.$count."'>".$count."</option>";
        	                        }
        	                        $count++;
        	                    }

        	                    $text_1 .= "
        	                    </select>
        	                </center>
        	            </td>";
        	        }

        	        $text_1 .= "
        	        </tr>
        	    </table>
        	</div>
    	</center>";
}

$sql->db_Select(DB_TABLE_ROSTER_TEAMS, "*", "ORDER BY team_order", "no_where");
while($row = $sql->db_Fetch()) {

    $text_1 .= "
    <center>
        <p>
            <div style='width:80%'>
                <table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
                    <tr>";

                    if($organizationType == 6) {
                        if ($row['team_name'] == '') {
                            $text_1 .= "
                            <td class='forumheader3' colspan='2'>&nbsp;</td>";
                        } else {
                            $text_1 .= "
                            <td class='forumheader' colspan='2'>
                                <b>".LAN_JBROSTER_GENERAL_TEAM.": ".$row['team_name']."</b>
                            </td>";
                        }
                    } else {
                        if ($row['game_name'] == '') {
                        	if ($row['team_name'] == '') {
                                $text_1 .= "
                                <td class='forumheader3' colspan='2'>&nbsp;</td>";
                            } else {
                                $text_1 .= "
                                <td class='forumheader' colspan='2'>
                                    <b>".LAN_JBROSTER_GENERAL_TEAM.": ".$row['team_name']."</b>
                                </td>";
                            }
                        } else {
                            if ($row['team_name'] == '') {
                                $text_1 .= "
                                <td class='forumheader3' colspan='2' style='border-right: 0px;'>&nbsp;</td>";
                            } else {
                                $text_1 .= "
                                <td class='forumheader' colspan='2' style='border-right: 0px;'>
                                    <b>".LAN_JBROSTER_GENERAL_TEAM.": ".$row['team_name']."</b>
                                </td>";
                            }

                            $text_1 .= "
                            <td class='forumheader' colspan='2' style='border-left: 0px;border-right: 0px;'>
                                <b>".LAN_JBROSTER_GENERAL_GAME.": ".$row['game_name']."</b>
                            </td>";
                        }
                    }

                        $text_1 .= "
                        <td class='forumheader' colspan='2' style='border-left: 0px;text-align: right;'>
                            <a href='admin_create_teams_edit.php?delete_team=1&team_id=".$row['team_id']."&url=".$_SERVER['PHP_SELF']."&game_id=".$row['game_id']."'><b>".LAN_JBROSTER_ADMIN_MANAGE_TEAMS_DELETE_TEAM."</b></a>
                        </td>
                    </tr>
                    <tr>
                        <td class='forumheader3'><b><center>".LAN_JBROSTER_ADMIN_MANAGE_TEAMS_CURRENT_ORDER."</center></b></td>
                        <td class='forumheader3'><b><center>".LAN_JBROSTER_ADMIN_MANAGE_TEAMS_NAME."</center></b></td>
                        <td class='forumheader3'><b><center>".LAN_JBROSTER_ADMIN_MANAGE_TEAMS_CURRENT_STATUS."</center></b></td>
                        <td class='forumheader3'><b><center>".LAN_JBROSTER_ADMIN_MANAGE_TEAMS_CHANGE_TEAM."</center></b></td>
                        <td class='forumheader3'><b><center>".LAN_JBROSTER_ADMIN_MANAGE_TEAMS_CHANGE_STATUS."</center></b></td>
                        <td class='forumheader3'><b><center>".LAN_JBROSTER_ADMIN_MANAGE_TEAMS_CHANGE_ORDER."</center></b></td>
                    </tr>";

                    $sql1 = new db;
                    $sql1->db_Select(DB_TABLE_ROSTER_TEAM_MEMBERS, "*", "team_id = ".intval($row['team_id'])."
                                                                        ORDER BY member_team_order");
                    while($row1 = $sql1->db_Fetch()) {
                        $text_1 .="
                            <tr>";

                            if ($row1['member_team_order'] == '') {
                                $text_1 .= "
                                <td class='forumheader3'>&nbsp;</td>";
                            } else {
                                $text_1 .= "
                                <td class='forumheader3'><center>".$row1['member_team_order']."</center></td>";
                            }

                            if ($row1['member_name'] == '') {
                                $text_1 .= "
                                <td class='forumheader3'>&nbsp;</td>";
                            } else {
                                $text_1 .= "
                                <td class='forumheader3'>".$row1['member_name']."</td>";
                            }

                            if ($row1['member_team_status'] == '') {
                                $text_1 .= "
                                <td class='forumheader3'>&nbsp;</td>";
                            } else {
                                $text_1 .= "
                                <td class='forumheader3'>".$row1['member_team_status']."</td>";
                            }

                            $text_1 .= "
                            <td class='forumheader3'>
                                <center>
                                    <select class='tbox' name='team_new_member_team[]'>";

                                    if ($organizationType == 6) {
                                    	if ($row1['team_name'] == "None") {
        	                                $text_1 .= "
        	                                <option value='".$row1['member_id'].DELIMITER_1.$row1['team_id'].DELIMITER_1.$row1['team_name'].DELIMITER_1.$row1['team_id'].DELIMITER_1."None' selected='selected'>".LAN_JBROSTER_ADMIN_MANAGE_TEAMS_REMOVE."</option>";
        	                            } else {
        	                                $text_1 .= "
        	                                <option value='".$row1['member_id'].DELIMITER_1.$row1['team_id'].DELIMITER_1.$row1['team_name'].DELIMITER_1.$row1['team_id'].DELIMITER_1."None'>".LAN_JBROSTER_ADMIN_MANAGE_TEAMS_REMOVE."</option>";
        	                            }
                                    } else {
        	                            if ($row1['team_name'] == "None") {
        	                                $text_1 .= "
        	                                <option value='".$row1['member_id'].DELIMITER_1.$row1['team_id'].DELIMITER_1.$row1['team_name'].DELIMITER_1.$row1['game_id'].DELIMITER_1.$row1['game_name'].DELIMITER_1."None' selected='selected'>".LAN_JBROSTER_ADMIN_MANAGE_TEAMS_REMOVE."</option>";
        	                            } else {
        	                                $text_1 .= "
        	                                <option value='".$row1['member_id'].DELIMITER_1.$row1['team_id'].DELIMITER_1.$row1['team_name'].DELIMITER_1.$row1['game_id'].DELIMITER_1.$row1['game_name'].DELIMITER_1."None'>".LAN_JBROSTER_ADMIN_MANAGE_TEAMS_REMOVE."</option>";
        	                            }
                                    }

                                    $sql2 = new db;
                                    $sql2->db_Select(DB_TABLE_ROSTER_TEAMS, "*", "ORDER BY team_order", "no-where");
                                    while($row2 = $sql2->db_Fetch()) {
                                    	if ($organizationType == 6) {
                                    		if ($row1['team_id'] == $row2['team_id']) {
                                        		$text_1 .= "
        		                                <option value='".$row1['member_id'].DELIMITER_1.$row1['team_id'].DELIMITER_1.$row1['team_name'].DELIMITER_1.$row2['team_id'].DELIMITER_1.$row2['team_name']."' selected='selected'>".$row2['team_name']."</option>";
        	                                } else {
        	                                	$text_1 .= "
        	                                    <option value='".$row1['member_id'].DELIMITER_1.$row1['team_id'].DELIMITER_1.$row1['team_name'].DELIMITER_1.$row2['team_id'].DELIMITER_1.$row2['team_name']."'>".$row2['team_name']."</option>";
        	                                }
                                    	} else {
        	                                if ($row1['team_id'] == $row2['team_id']) {
        	                                	if ($row2['game_name'] == '') {
        			                                $text_1 .= "
        			                                <option value='".$row1['member_id'].DELIMITER_1.$row1['team_id'].DELIMITER_1.$row1['team_name'].DELIMITER_1.$row1['game_id'].DELIMITER_1.$row1['game_name'].DELIMITER_1.$row2['team_id'].DELIMITER_1.$row2['team_name'].DELIMITER_1.$row2['game_id'].DELIMITER_1.$row2['game_name']."' selected='selected'>".$row2['team_name']."</option>";
        	                                	} else {
        	                                		$text_1 .= "
        			                                <option value='".$row1['member_id'].DELIMITER_1.$row1['team_id'].DELIMITER_1.$row1['team_name'].DELIMITER_1.$row1['game_id'].DELIMITER_1.$row1['game_name'].DELIMITER_1.$row2['team_id'].DELIMITER_1.$row2['team_name'].DELIMITER_1.$row2['game_id'].DELIMITER_1.$row2['game_name']."' selected='selected'>".$row2['team_name']." (".$row2['game_name'].")</option>";
        	                                	}
        	                                } else {
        	                                	if ($row2['game_name'] == '') {

        	                                    $text_1 .= "
        	                                    <option value='".$row1['member_id'].DELIMITER_1.$row1['team_id'].DELIMITER_1.$row1['team_name'].DELIMITER_1.$row1['game_id'].DELIMITER_1.$row1['game_name'].DELIMITER_1.$row2['team_id'].DELIMITER_1.$row2['team_name'].DELIMITER_1.$row2['game_id'].DELIMITER_1.$row2['game_name']."'>".$row2['team_name']."</option>";
        	                                	} else {
        	                                		$text_1 .= "
        	                                    <option value='".$row1['member_id'].DELIMITER_1.$row1['team_id'].DELIMITER_1.$row1['team_name'].DELIMITER_1.$row1['game_id'].DELIMITER_1.$row1['game_name'].DELIMITER_1.$row2['team_id'].DELIMITER_1.$row2['team_name'].DELIMITER_1.$row2['game_id'].DELIMITER_1.$row2['game_name']."'>".$row2['team_name']." (".$row2['game_name'].")</option>";
        	                                	}
        	                                }
                                    	}
                                    }

                                    $text_1 .= "
                                    </select>
                                </center>
                            </td>
                            <td class='forumheader3'>
                                <center>
                                    <select class='tbox' name='team_new_member_team_status[]'>";

                                    $sql2->db_Select(DB_TABLE_ROSTER_TEAM_STATUS, "*", "team_id = ".intval($row['team_id'])."
                                                                                        ORDER BY status_order");
                                    while($row2 = $sql2->db_Fetch()) {
                                    	if ($organizationType == 6) {
                                    		if ($row1['member_team_status'] == $row2['status_name']) {
        	                                    $text_1 .= "
        	                                    <option value='".$row1['member_id'].DELIMITER_1.$row1['team_id'].DELIMITER_1.$row1['member_team_status'].DELIMITER_1.$row2['status_name']."' selected='selected'>".$row2['status_name']."</option>";
        	                                } else {
        	                                    $text_1 .= "
        	                                    <option value='".$row1['member_id'].DELIMITER_1.$row1['team_id'].DELIMITER_1.$row1['member_team_status'].DELIMITER_1.$row2['status_name']."'>".$row2['status_name']."</option>";
        	                                }
                                    	} else {
        	                                if ($row1['member_team_status'] == $row2['status_name']) {
        	                                    $text_1 .= "
        	                                    <option value='".$row1['member_id'].DELIMITER_1.$row1['team_id'].DELIMITER_1.$row1['member_team_status'].DELIMITER_1.$row1['game_id'].DELIMITER_1.$row2['status_name']."' selected='selected'>".$row2['status_name']."</option>";
        	                                } else {
        	                                    $text_1 .= "
        	                                    <option value='".$row1['member_id'].DELIMITER_1.$row1['team_id'].DELIMITER_1.$row1['member_team_status'].DELIMITER_1.$row1['game_id'].DELIMITER_1.$row2['status_name']."'>".$row2['status_name']."</option>";
        	                                }
                                    	}
                                    }

                                    $text_1 .= "
                                    </select>
                                </center>
                            </td>
                            <td class='forumheader3'>
                                <center>
                                    <select class='tbox' name='team_new_member_team_order[]'>";

                                    $sql3 = new db;
                                    $num_rows = $sql3->db_Count(DB_TABLE_ROSTER_TEAM_MEMBERS, "(*)", " WHERE team_name = '".$tp->toDB($row['team_name'])."'
                                                                                                       AND   game_name = '".$tp->toDB($row['game_name'])."' ");
                                    $count = 1;
                                    while ($count <= $num_rows) {
                                    	if ($organizationType == 6) {
                                    		if ($row1['member_team_order'] == $count) {
    	                                        $text_1 .= "
    	                                        <option value='".$row1['member_id'].DELIMITER_1.$row1['member_team_order'].DELIMITER_1.$row1['team_id'].DELIMITER_1.$count."' selected='selected'>".$count."</option>";
    	                                    } else {
    	                                        $text_1 .= "
    	                                        <option value='".$row1['member_id'].DELIMITER_1.$row1['member_team_order'].DELIMITER_1.$row1['team_id'].DELIMITER_1.$count."'>".$count."</option>";
    	                                    }
                                    	} else {
    	                                    if ($row1['member_team_order'] == $count) {
    	                                        $text_1 .= "
    	                                        <option value='".$row1['member_id'].DELIMITER_1.$row1['team_id'].DELIMITER_1.$row1['member_team_order'].DELIMITER_1.$row1['game_id'].DELIMITER_1.$count."' selected='selected'>".$count."</option>";
    	                                    } else {
    	                                        $text_1 .= "
    	                                        <option value='".$row1['member_id'].DELIMITER_1.$row1['team_id'].DELIMITER_1.$row1['member_team_order'].DELIMITER_1.$row1['game_id'].DELIMITER_1.$count."'>".$count."</option>";
    	                                    }
                                    	}
                                        $count++;
                                    }

                                    $text_1 .= "
                                    </select>
                                </center>
                            </td>";
                    }

                    $text_1 .= "
                    </tr>
                </table>
            </div>
        </p>
    </center>";
}

    $text_1 .= "
    <input type='hidden' name='edit_team' value='1' />
    <center>
        <p>
            <input class='button' type='submit' value='".LAN_JBROSTER_ADMIN_MANAGE_TEAMS_TITLE_1."' />
        </p>
    </center>
</form>";

$title = "<b>Current Teams</b>";
$ns->tablerender($title, $text_1);

$text_2 = "
<form action='admin_manage_teams_edit.php' method='POST'>
    <p>
        <center>
            <div style='width:60%'>
                <table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td colspan='6' class='forumheader'><b>".LAN_JBROSTER_ADMIN_MANAGE_TEAMS_ASSIGN_MEMBER."</b></td>
                    <tr>
                        <td width='50%' class='forumheader3'><b><center>".LAN_JBROSTER_ADMIN_MANAGE_TEAMS_NAME."</center></b></td>
                        <td width='50%' class='forumheader3'><b><center>".LAN_JBROSTER_ADMIN_MANAGE_TEAMS_ASSIGN_TEAM."</center></b></td>
                    </tr>";

            		$sql->db_Select(DB_TABLE_ROSTER_MEMBER_STATUS, "*", "status_name != 'Team Member' AND status_name != 'General Member' AND status_name != 'Cadet' AND status_name != 'Recruit' AND status_name != 'Inactive Member' AND status_name != 'Open Application' AND status_name != 'Closed Application'");
            		while($row = $sql->db_Fetch()) {
            			$customArgs .= " OR member_status like '".$tp->toDB($row['status_name'])."%'";
            		}

                    $sql->db_Select(DB_TABLE_ROSTER_MEMBERS, "*", "member_status like 'Team Member%'
                                                                OR member_status like 'Cadet%'
                                                                OR member_status like 'Recruit%'$customArgs
                                                                ORDER BY nickname");
                    while($row = $sql->db_Fetch()) {
                        $text_2 .="
                            <tr>";
                            if ($row['nickname'] == '') {
                                $text_2 .= "
                                <td width='50%' class='forumheader3'>&nbsp;</td>";
                            } else {
                                $text_2 .= "
                                <td width='50%' class='forumheader3'><center>".$row['nickname']."</center></td>";
                            }

                            $text_2 .= "
                            <td width='50%' class='forumheader3'>
                                <center>
                                    <select class='tbox' name='team_assign_team[]'>
                                        <option value='".$row['member_id'].".None' selected='selected'></option>";
                                        $sql1 = new db;
                                        $sql1->db_Select(DB_TABLE_ROSTER_TEAMS, "*", "ORDER BY team_order", "no_where");
                                        while($row1 = $sql1->db_Fetch()){ // start loop
                                        	if ($row1['game_name'] == '') {
                                        		$text_2 .= "
            	                                <option value='".$row['member_id'].DELIMITER_1.$row1['team_id'].DELIMITER_1.$row1['team_name'].DELIMITER_1.$row1['game_id'].DELIMITER_1.$row1['game_name']."'>".$row1['team_name']."</option>";
                                        	} else {
            	                                $text_2 .= "
            	                                <option value='".$row['member_id'].DELIMITER_1.$row1['team_id'].DELIMITER_1.$row1['team_name'].DELIMITER_1.$row1['game_id'].DELIMITER_1.$row1['game_name']."'>".$row1['team_name']." (".$row1['game_name'].")</option>";
                                        	}
                                        }

                                    $text_2 .= "
                                    </select>
                                </center>
                            </td>";
                        }

                    $text_2 .= "
                    </tr>
                </table>
            </div>
        </center>
    </p>";

    $text_2 .= "
    <input type='hidden' name='assign_team' value='1' />
    <center>
        <p>
            <input class='button' type='submit' value='".LAN_JBROSTER_ADMIN_MANAGE_TEAMS_ASSIGN_TEAM."' />
        </p>
    </center>
</form>";

$title = "<b>".LAN_JBROSTER_ADMIN_MANAGE_TEAMS_TITLE_2."</b>";
$ns->tablerender($title, $text_2);

require_once(e_ADMIN."footer.php");
?>
