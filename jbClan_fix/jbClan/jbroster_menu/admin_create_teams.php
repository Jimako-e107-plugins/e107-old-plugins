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
if(!getperms("P")){
    header("location:".e_HTTP."index.php");
    exit;
}

require_once(e_ADMIN."auth.php");

if(file_exists(e_PLUGIN."jbroster_menu/languages/".e_LANGUAGE.".php")) {
    include_lan(e_PLUGIN."jbroster_menu/languages/".e_LANGUAGE.".php");
}

require_once("includes/config.constants.php");

$pageid = "admin_menu_04";

$sql->db_Select(DB_TABLE_ROSTER_PREFERENCES, "*", "organization_id = 1");
while ($row = $sql->db_Fetch()) {
	$organizationType = $row['organization_type'];
}

$text = "
<center>
    <p>
        <div style='width:90%'>
            <form method='POST' action='admin_create_teams_edit.php'>
                <table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
        			<tr>
                        <td colspan='6' class='forumheader'><b>".LAN_JBROSTER_GENERAL_CREATE_TEAM."</b></td>
                    </tr>";

        			if ($_GET['success_team'] == '2') {
        				$text .= "
        				<tr>
        					<td colspan='6' class='forumheader3'>
        						<center>
        							<p>
        						        <b>".LAN_JBROSTER_ADMIN_CREATE_TEAMS_SUCCESS_TEAM."</b>
                                    </p>
        						</center>
        					</td>
        				</tr>";
        			} else if ($_GET['success_team'] == '1') {
        				$text .= "
        				<tr>
        					<td colspan='6' class='forumheader3'>
        						<center>
                                    <p>
        						        <b>".LAN_JBROSTER_ADMIN_CREATE_TEAMS_TEAM_IN_SYSTEM."</b>
                                    </p>
        						</center>
        					</td>
        				</tr>";
        			} else if ($_GET['success_team'] == '0') {
        				$text .= "
        				<tr>
        					<td colspan='6' class='forumheader3'>
        						<center>
                                    <p>
        						        <b>".LAN_JBROSTER_ADMIN_CREATE_TEAMS_ENTER_TEAM_NAME."</b>
                                    </p>
        						</center>
        					</td>
        				</tr>";
        			}

        			$text .= "
                    <tr>
                        <td class='forumheader3'>
                            <center>
                                <b>".LAN_JBROSTER_ADMIN_CREATE_TEAMS_TEAM_NAME."</b>
                            </center>
                        </td>";

        				if ($organizationType == 6) {
        					//don't display game name
        				} else {
        					$text .= "
        	                <td class='forumheader3'>
        	                    <center>
        	                        <b>".LAN_JBROSTER_GENERAL_GAME_NAME."</b>
        	                    </center>
        	                </td>";
        				}

        				$text .= "
                        <td class='forumheader3'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_DISPLAY_COLOR."</b>
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td class='forumheader3'>
                            <center>
                                <input class='tbox' name='team_name' type='text' value='' maxlength='25' size='25' />
                            </center>
        				</td>";

        				if ($organizationType == 6) {
        					//don't display game name
        				} else {
        					$text .= "
        	                <td class='forumheader3'>
        	                    <center>
        	                        <select class='tbox' name='game_id'>";

        	                            $sql->db_Select(DB_TABLE_ROSTER_GAMES, "*", "ORDER BY game_order", "no-where");
        	                            while($row = $sql->db_Fetch()) {
        	                                $text .= "
        	                                <option value='".$row['game_id']."'>".$row['game_name']."</option>";
        	                            }
        	                        $text .= "
        	                        </select>
        	                    </center>
        	                </td>";
        				}

        				$text .= "
                        <td class='forumheader3'>
                            <center>
                                <select class='tbox' name='text_color'>";

                                    $sql->db_Select(DB_TABLE_ROSTER_TEXT_COLORS, "*", "ORDER BY color_order", "no-where");
                                    while ($row = $sql->db_Fetch()) {
                                        $text .= "
                                        <option style='background-color: ".$row['hex_code']."' value='".$row['hex_code']."'>".$row['color_name']."</option>";
                                    }

                                $text .= "
                                </select>
                            </center>
                        </td>
                    </tr>
                </table>
                <p>
                    <input type='hidden' name='create_team' value='1' />
                    <input class='button' type='submit' value='".LAN_JBROSTER_GENERAL_CREATE_TEAM."' />
                </p>
            </form>
        </div>
    </p>
</center>

<center>
    </p>
        <div style='width:90%'>
            <form method='POST' action='admin_create_teams_edit.php'>
                <table border='1' style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td colspan='6' class='forumheader'><b>".LAN_JBROSTER_ADMIN_CREATE_TEAMS_CURRENT_TEAMS."</b></td>
                    </tr>
                    <tr>
                        <td class='forumheader3' width='33%'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_TEAM."</b>
                            </center>
                        </td>";

        				if ($organizationType == 6) {
        					//don't display game name
        				} else {
        					$text .= "
        	                <td class='forumheader3' width='33%'>
        	                    <center>
        	                        <b>".LAN_JBROSTER_GENERAL_GAME."</b>
        	                    </center>
        	                </td>";
        				}

        				$text .= "
                        <td class='forumheader3' width='33%'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_DISPLAY_COLOR."</b>
                            </center>
                        </td>
                        <td class='forumheader3' width='33%'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_ORDER."</b>
                            </center>
                        </td>
                        <td class='forumheader3' width='33%'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_DELETE."</b>
                            </center>
                        </td>
                    </tr>";

        			$numRows = $sql->db_Count(DB_TABLE_ROSTER_TEAMS);
        			if ($numRows == 0) {
        				$text .= "
        				<tr>
        					<td colspan='10' class='forumheader3'>
        						<center>
        							<p>
        							    ".LAN_JBROSTER_GENERAL_NO_TEAMS_IN_SYSTEM."
                                    </p>
        						</center>
        					</td>
        				</tr>";
        			} else {
        				// Do Nothing
        			}

                    $sql->db_Select(DB_TABLE_ROSTER_TEAMS, "*", "ORDER BY team_order", "no-where");
                    while ($row = $sql->db_Fetch()) {
                        $text .= "
                        <tr>
                            <td class='forumheader3' width='33%'>
                                <center>
                                    ".$row['team_name']."
                                </center>
                            </td>";

        					if ($organizationType == 6) {
        						//don't display game name
        					} else {
        						if ($row['game_name'] == '') {
        							$text .= "
        		                    <td class='forumheader3' width='33%'>
        		                        <center>
        		                            &nbsp;
        		                        </center>
        		                    </td>";
        						} else {
        							$text .= "
        		                    <td class='forumheader3' width='33%'>
        		                        <center>
        		                            ".$row['game_name']."
        		                        </center>
        		                    </td>";
        						}
        					}

        					$text .= "
                            <td class='forumheader3'>
                                <center>
                                    <select class='tbox' name='text_color[]'>";

                                    $sql1 = new db;
                                    $sql1->db_Select(DB_TABLE_ROSTER_TEXT_COLORS, "*", "ORDER BY color_order", "no-where");
                                    while ($row1 = $sql1->db_Fetch()) {
                                        if ($row['text_color'] == $row1['hex_code']) {
                                            $text .= "
                                            <option style='background-color: ".$row1['hex_code'].";' value='".$row1['hex_code']."' selected='selected'>".$row1['color_name']."</option>";
                                        } else {
                                            $text .= "
                                            <option style='background-color: ".$row1['hex_code'].";' value='".$row1['hex_code']."'>".$row1['color_name']."</option>";
                                        }
                                    }

                                    $text .= "
                                    </select>
                                </center>
                            </td>
                            <td class='forumheader3' width='33%'>
                                <center>
                                    <select class='tbox' name='team_order[]'>";

                                    $num_rows = $sql1->db_Count(DB_TABLE_ROSTER_TEAMS);
                                    $count = 1;
                                    while ($count <= $num_rows) {
                                    	if ($organizationType == 6) {
                                    		if ($row['team_order'] == $count) {
        	                                    $text .= "
        	                                    <option value='".$row['team_id'].DELIMITER_1.$count."' selected='selected'>".$count."</option>";
        	                                } else {
        	                                    $text .= "
        	                                    <option value='".$row['team_id'].DELIMITER_1.$count."'>".$count."</option>";
        	                                }
                                    	} else {
        	                                if ($row['team_order'] == $count) {
        	                                    $text .= "
        	                                    <option value='".$row['team_id'].DELIMITER_1.$row['game_id'].DELIMITER_1.$count."' selected='selected'>".$count."</option>";
        	                                } else {
        	                                    $text .= "
        	                                    <option value='".$row['team_id'].DELIMITER_1.$row['game_id'].DELIMITER_1.$count."'>".$count."</option>";
        	                                }
                                    	}
                                        $count++;
                                    }

                                    $text .= "
                                    </select>
                                </center>
                            </td>
                            <td class='forumheader3' width='33%'>
                                <center>
                                    	<a href='admin_create_teams_edit.php?delete_team=1&team_id=".$row['team_id']."&game_id=".$row['game_id']."&url=".$_SERVER['PHP_SELF']."'><img src='".ADMIN_DELETE_ICON_PATH."' /></a>
                                </center>
                            </td>
                        </tr>";
                    }

                $text .= "
                </table>";

        		if ($numRows == 0) {
        			// Do Nothing
        		} else {
        			$text .= "
        			<p>
        			    <input type='hidden' name='change_team_order' value='1' />
        			    <input class='button' type='submit' value='".LAN_JBROSTER_ADMIN_CREATE_TEAMS_CHANGE_TEAM_SUBMIT."' />
        			</p>
        			<center>
                        <p>
            				".LAN_JBROSTER_ADMIN_CREATE_TEAMS_DISPLAY_WARNING_1."
                        </p>
                        <p>
            				".LAN_JBROSTER_ADMIN_CREATE_TEAMS_DISPLAY_WARNING_2."
                        </p>
        			</center>";
        		}
        		$text .= "
            </form>
        </div>
    </p>
</center>";

$title = "<b>".LAN_JBROSTER_GENERAL_CREATE_TEAMS."</b>";
$ns->tablerender($title, $text);

$text = "
<center>
    <p>
        <div style='width:90%'>
            <form method='POST' action='admin_create_teams_edit.php'>
                <table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td colspan='6' class='forumheader'><b>".LAN_JBROSTER_ADMIN_CREATE_TEAMS_CREATE_TEAM_STATUS."</b></td>
                    </tr>";

        			if ($_GET['success_status'] == '2') {
        				$text .= "
        				<tr>
        					<td colspan='6' class='forumheader3'>
        						<center>
        							<p>
        						        <b>".LAN_JBROSTER_ADMIN_CREATE_TEAMS_SUCCESS_STATUS."</b>
    						        </p>
        						</center>
        					</td>
        				</tr>";
        			} else if ($_GET['success_status'] == '1') {
        				$text .= "
        				<tr>
        					<td colspan='6' class='forumheader3'>
        						<center>
        							<p>
        							    <b>".LAN_JBROSTER_ADMIN_CREATE_TEAMS_STATUS_IN_SYSTEM."</b>
    							    </p>
        						</center>
        					</td>
        				</tr>";
        			} else if ($_GET['success_status'] == '0') {
        				$text .= "
        				<tr>
        					<td colspan='6' class='forumheader3'>
        						<center>
        							<p>
        							    <b>".LAN_JBROSTER_GENERAL_ENTER_STATUS_NAME."</b>
    							    </p>
        						</center>
        					</td>
        				</tr>";
        			}

        			$text .= "
                    <tr>
                    </tr>
                        <td class='forumheader3'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_STATUS_NAME."</b>
                            </center>
                        </td>
        				<td class='forumheader3'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_TEAM."</b>
                            </center>
                        </td>
                        <td class='forumheader3'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_DISPLAY_COLOR."</b>
                            </center>
                        </td>
                    <tr>
                        <td class='forumheader3'>
                            <center>
        					    <input class='tbox' name='status_name' type='text' value='' maxlength='25' size='25' />
                            </center>
        				</td>
        				<td class='forumheader3'>
                            <center>
                                <select class='tbox' name='team_id'>
                                    <option value='All Teams'>".LAN_JBROSTER_ADMIN_CREATE_TEAMS_ALL_TEAMS."</option> ";

                                    $sql->db_Select(DB_TABLE_ROSTER_TEAMS, "*", "ORDER BY team_order", "no-where");
                                    while($row = $sql->db_Fetch()) {
                                        $text .= "
                                        <option value='".$row['team_id']."'>".$row['team_name']."</option>";
                                    }

                                $text .= "
                                </select>
                            </center>
                        </td>
                        <td class='forumheader3'>
                            <center>
                                <select class='tbox' name='text_color'>";

                                    $sql->db_Select(DB_TABLE_ROSTER_TEXT_COLORS, "*", "ORDER BY color_order", "no-where");
                                    while ($row = $sql->db_Fetch()) {
                                        $text .= "
                                        <option style='background-color: ".$row['hex_code']."' value='".$row['hex_code']."'>".$row['color_name']."</option>";
                                    }

                                $text .= "
                                </select>
                            </center>
                        </td>
                    </tr>
                </table>
                <p>
                    <input type='hidden' name='add_team_status' value='1' />
                    <input class='button' type='submit' value='".LAN_JBROSTER_ADMIN_CREATE_TEAMS_CREATE_STATUS_SUBMIT."' />
                </p>
            </form>
        </div>
    </p>
</center>

<center>
    <p>
        <div style='width:90%'>
            <form method='POST' action='admin_create_teams_edit.php'>
                <table border='1' style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td colspan='6' class='forumheader'><b>".LAN_JBROSTER_ADMIN_CREATE_TEAMS_CURRENT_STATUSES."</b></td>
                    </tr>
                    <tr>
                        <td class='forumheader3'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_STATUS_NAME."</b>
                            </center>
                        </td>
        				<td class='forumheader3'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_TEAM."</b>
                            </center>
                        </td>";

        				if ($organizationType == 6) {
        					//don't display game name
        				} else {
        					$text .= "
        	                <td class='forumheader3'>
        	                    <center>
        	                        <b>".LAN_JBROSTER_GENERAL_GAME."</b>
        	                    </center>
        	                </td>";
        				}

        				$text .= "
                        <td class='forumheader3'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_DISPLAY_COLOR."</b>
                            </center>
                        </td>
                        <td class='forumheader3'>
                            <center>
                                <b>".LAN_JBROSTER_GENERAL_ORDER."</b>
                            </center>
                        </td>
                        <td class='forumheader3'>

                            <center>
                                <b>".LAN_JBROSTER_GENERAL_DELETE."</b>
                            </center>
                        </td>
                    </tr>";

        			$numRows = $sql->db_Count(DB_TABLE_ROSTER_TEAM_STATUS);
        			if ($numRows == 0) {
        				$text .= "
        				<tr>
        					<td colspan='10' class='forumheader3'>
        						<center>
        							<p>
        							    ".LAN_JBROSTER_GENERAL_NO_STATUSES_IN_SYSTEM."
                                    </p>
        						</center>
        					</td>
        				</tr>";
        			} else {
        				// Do Nothing
        			}

                    $sql->db_Select(DB_TABLE_ROSTER_TEAM_STATUS, "*", "ORDER BY team_name, status_order", "no-where");
                    while ($row = $sql->db_Fetch()) {
                        $text .= "
                        <tr>
                            <td class='forumheader3' style='width: 20%'>
                                <center>
                                    ".$row['status_name']."
                                </center>
                            </td>
        					<td class='forumheader3' style='width: 20%'>
                                <center>
        							".$row['team_name']."
                                </center>
                            </td>";

        					if ($organizationType == 6) {
        						//don't display game name
        					} else {
        						if ($row['game_name'] == '') {
        							$text .= "
        		                    <td class='forumheader3' style='width: 20%'>
        		                        <center>
        		                            &nbsp;
        		                        </center>
        		                    </td>";
        						} else {
        							$text .= "
        		                    <td class='forumheader3' style='width: 20%'>
        		                        <center>
        		                            ".$row['game_name']."
        		                        </center>
        		                    </td>";
        						}
        					}

        					$text .= "
                            <td class='forumheader3' style='width: 20%'>
                                <center>
                                    <select class='tbox' name='text_color[]'>";

        					        $sql1 = new db;
                                    $sql1->db_Select(DB_TABLE_ROSTER_TEXT_COLORS, "*", "ORDER BY color_order", "no-where");
                                    while ($row1 = $sql1->db_Fetch()) {
                                        if ($row['text_color'] == $row1['hex_code']) {
                                            $text .= "
                                            <option style='background-color: ".$row1['hex_code'].";' value='".$row1['hex_code']."' selected='selected'>".$row1['color_name']."</option>";
                                        } else {
                                            $text .= "
                                            <option style='background-color: ".$row1['hex_code'].";' value='".$row1['hex_code']."'>".$row1['color_name']."</option>";
                                        }
                                    }

                                    $text .= "
                                    </select>
                                </center>
                            </td>
                            <td class='forumheader3' style='width: 20%'>
                                <center>
                                    <select class='tbox' name='status_order[]'>";

                                    $num_rows = $sql1->db_Count(DB_TABLE_ROSTER_TEAM_STATUS, "(*)", "WHERE team_id = ".intval($row['team_id']));
                                    $count = 1;
                                    while ($count <= $num_rows) {
                                    	if ($organizationType == 6) {
                                    		if ($row['status_order'] == $count) {
        	                                    $text .= "
        	                                    <option value='".$row['status_id'].DELIMITER_1.$count."' selected='selected'>".$count."</option>";
        	                                } else {
        	                                    $text .= "
        	                                    <option value='".$row['status_id'].DELIMITER_1.$count."'>".$count."</option>";
        	                                }
                                    	} else {
        	                                if ($row['status_order'] == $count) {
        	                                    $text .= "
        	                                    <option value='".$row['status_id'].DELIMITER_1.$row['game_id'].DELIMITER_1.$count."' selected='selected'>".$count."</option>";
        	                                } else {
        	                                    $text .= "
        	                                    <option value='".$row['status_id'].DELIMITER_1.$row['game_id'].DELIMITER_1.$count."'>".$count."</option>";
        	                                }
                                    	}
                                        $count++;
                                    }

                                    $text .= "
                                    </select>
                                </center>
                            </td>
                            <td class='forumheader3' style='width: 20%'>
                                <center>";

                                if ($row['status_name'] != 'None') {
                                    $text .= "
                                    <a href='admin_create_teams_edit.php?delete_status=1&status_id=".$row['status_id']."&status_name=".$row['status_name']."&game_id=".$row['game_id']."'><img src='".ADMIN_DELETE_ICON_PATH."' /></a>";
                                } else {
                                    $text .= "
                                    &nbsp;";
                                }

                                $text .= "
                                </center>
                            </td>
                        </tr>";
                    }

                $text .= "
                </table>";

        		if ($numRows == 0) {
        			// Do Nothing
        		} else {
        			$text .= "
        			<p>
        			    <input type='hidden' name='change_status_order' value='1' />
        			    <input class='button' type='submit' value='".LAN_JBROSTER_ADMIN_CREATE_TEAMS_CHANGE_STATUS_SUBMIT."' />
    			    </p>";
        		}

        	$text .= "
            </form>
        </div>
    </p>
</center>";

$title = "<b>".LAN_JBROSTER_ADMIN_CREATE_TEAMS_TITLE_2."</b>";
$ns->tablerender($title, $text);

if ($organizationType == 6) {
    // Don't display Game Options
} else {
    $text = "
    <center>
        <p>
            <div style='width:80%'>
                <form method='POST' action='admin_create_teams_edit.php'>
                    <table border='1' style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
                        <tr>
                            <td colspan='6' class='forumheader'><b>".LAN_JBROSTER_GENERAL_ADD_GAME."</b></td>
                        </tr>";

                        if ($_GET['success_game'] == '2') {
                            $text .= "
                            <tr>
                                <td colspan='6' class='forumheader3'>
                                    <center>
                                        <p>
                                            <b>".LAN_JBROSTER_ADMIN_CREATE_TEAMS_SUCCESS_GAME."</b>
                                        </p>
                                    </center>
                                </td>
                            </tr>";
                        } else if ($_GET['success_game'] == '1') {
                            $text .= "
                            <tr>
                                <td colspan='6' class='forumheader3'>
                                    <center>
                                        <p>
                                            <b>".LAN_JBROSTER_ADMIN_CREATE_TEAMS_GAME_IN_SYTEM."</b>
                                        </p>
                                    </center>
                                </td>
                            </tr>";
                        } else if ($_GET['success_game'] == '0') {
                            $text .= "
                            <tr>
                                <td colspan='6' class='forumheader3'>
                                    <center>
                                        <p>
                                            <b>".LAN_JBROSTER_ADMIN_CREATE_TEAMS_ENTER_GAME_NAME."</b>
                                        <p>
                                    </center>
                                </td>
                            </tr>";
                        }

                        $text .= "
                        <tr>
                            <td width='20%' class='forumheader3'>
                                <center>
                                    <b>".LAN_JBROSTER_GENERAL_GAME_NAME."</b>
                                </center>
                            </td>
                            <td width='20%' class='forumheader3'>
                                <center>
                                    <b>".LAN_JBROSTER_GENERAL_DISPLAY_COLOR."</b>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td width='20%' class='forumheader3'>
                                <center>
                                    <input class='tbox' name='game_name' type='text' value='' maxlength='25' size='25' />
                                </center>
                            </td>
                            <td width='20%' class='forumheader3'>
                                <center>
                                    <select class='tbox' name='text_color'>";

                                        $sql->db_Select(DB_TABLE_ROSTER_TEXT_COLORS, "*", "ORDER BY color_order", "no-where");
                                        while ($row = $sql->db_Fetch()) {
                                            $text .= "
                                            <option style='background-color: ".$row['hex_code']."' value='".$row['hex_code']."'>".$row['color_name']."</option>";
                                        }

                                    $text .= "
                                    </select>
                                </center>
                            </td>
                        </tr>
                    </table>

                    <center>
                        <p>
                            <input type='hidden' name='add_game' value='1' />
                            <input class='button' type='submit' value='".LAN_JBROSTER_GENERAL_ADD_GAME."' />
                        <p>
                    </center>
                </form>
            </div>
        </p>
    </center>

    <center>
        <p>
            <div style='width:80%'>
                <form method='POST' action='admin_create_teams_edit.php'>
                    <table border='1' style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
                        <tr>
                            <td colspan='6' class='forumheader'><b>".LAN_JBROSTER_ADMIN_CREATE_TEAMS_CURRENT_GAMES."</b></td>
                        </tr>
                        <tr>
                            <td class='forumheader3' width='33%'>
                                <center>
                                    <b>".LAN_JBROSTER_GENERAL_GAME_NAME."</b>
                                </center>
                            </td>
                            <td class='forumheader3' width='33%'>
                                <center>
                                    <b>".LAN_JBROSTER_GENERAL_DISPLAY_COLOR."</b>
                                </center>
                            </td>
                            <td class='forumheader3' width='33%'>
                                <center>
                                    <b>".LAN_JBROSTER_GENERAL_ORDER."</b>
                                </center>
                            </td>
                            <td class='forumheader3' width='33%'>
                                <center>
                                    <b>".LAN_JBROSTER_GENERAL_DELETE."</b>
                                </center>
                            </td>
                        </tr>";

                        $numRows = $sql->db_Count(DB_TABLE_ROSTER_GAMES);
                        if ($numRows == 0) {
                            $text .= "
                            <tr>
                                <td colspan='10' class='forumheader3'>
                                    <center>
                                        <p>
                                            ".LAN_JBROSTER_ADMIN_CREATE_TEAMS_NO_GAMES."
                                        </p>
                                    </center>
                                </td>
                            </tr>";
                        } else {
                            // Do Nothing
                        }

                        $sql->db_Select(DB_TABLE_ROSTER_GAMES, "*", "ORDER BY game_order", "no-where");
                        while ($row = $sql->db_Fetch()) {
                            $text .= "
                            <tr>
                            <td width='20%' class='forumheader3' width='33%'>
                                <center>
                                    ".$row['game_name']."
                                </center>
                            </td>
                            <td width='20%' class='forumheader3'>
                                <center>
                                    <select class='tbox' name='text_color[]'>";

                                    $sql1 = new db;
                                    $sql1->db_Select(DB_TABLE_ROSTER_TEXT_COLORS, "*", "ORDER BY color_order", "no-where");
                                    while ($row1 = $sql1->db_Fetch()) {
                                        if ($row['text_color'] == $row1['hex_code']) {
                                            $text .= "
                                            <option style='background-color: ".$row1['hex_code'].";' value='".$row1['hex_code']."' selected='selected'>".$row1['color_name']."</option>";
                                        } else {
                                            $text .= "
                                            <option style='background-color: ".$row1['hex_code'].";' value='".$row1['hex_code']."'>".$row1['color_name']."</option>";
                                        }
                                    }

                                    $text .= "
                                    </select>
                                </center>
                            </td>
                            <td width='20%' class='forumheader3' width='33%'>
                                <center>
                                    <select class='tbox' name='game_order[]'>";

                                    $num_rows = $sql1->db_Count(DB_TABLE_ROSTER_GAMES);
                                    $count = 1;
                                    while ($count <= $num_rows) {
                                        if ($row['game_order'] == $count) {
                                            $text .= "
                                            <option value='".$row['game_id'].DELIMITER_1.$count."' selected='selected'>".$count."</option>";
                                        } else {
                                            $text .= "
                                            <option value='".$row['game_id'].DELIMITER_1.$count."'>".$count."</option>";
                                        }
                                        $count++;
                                    }

                                    $text .= "
                                    </select>
                                </center>
                            </td>
                            <td width='20%' class='forumheader3' width='33%'>
                                <center>
                                    <a href='admin_create_teams_edit.php?delete_game=1&game_id=".$row['game_id']."'><img src='".ADMIN_DELETE_ICON_PATH."' /></a>
                                </center>
                            </td>
                        </tr>";
                    }

                    $text .= "
                    </table>";

                    if ($numRows == 0) {
                        // Do Nothing
                    } else {
                        $text .= "
                        <p>
                            <input type='hidden' name='change_game_order' value='1' />
                            <input class='button' type='submit' value='".LAN_JBROSTER_ADMIN_CREATE_TEAMS_CHANGE_GAME_SUBMIT."' />
                        </p>";
                    }

                $text .= "
                </form>
            </div>
        </p>
    </center>";

    $title = "<b>Create Games</b>";
    $ns->tablerender($title, $text);
}

require_once(e_ADMIN."footer.php");
?>