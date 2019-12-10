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

$pageid = "admin_menu_04";

$sql->db_Select(DB_TABLE_ROSTER_PREFERENCES, "*", "organization_id = 1");
while ($row = $sql->db_Fetch()) {
    $organizationType = $row['organization_type'];
}

if ($_POST['add_game'] == '1') {

    // Add game to db

    if ($_POST['game_name'] == '') {
    	// Send back error
        header("Location: admin_create_teams.php?success_game=0");
        exit;
    }

    if ($sql->db_Count(DB_TABLE_ROSTER_GAMES, "(*)", " WHERE game_name = '".$tp->toDB($_POST['game_name'])."'") > 0) {
        // Do Nothing
        header("Location: admin_create_teams.php?success_game=1");
        exit;
    } else {
        $sql1 = new db;
        $sql1->db_Insert(DB_TABLE_ROSTER_GAMES,
            "'',
            '".$tp->toDB($_POST['game_name'])."',
            '".$tp->toDB($_POST['text_color'])."',
            1");

        header("Location: admin_create_teams.php?success_game=2");
        exit;
    }

} else if ($_POST['change_game_order'] == '1') {

    // Change game order

    for ($x = 0; $x < count($_POST['game_order']); $x++) {
        tokenizeArray($_POST['game_order'][$x]);
        $newGameOrderArray[$x] = $tokens;
    }

    foreach ($_POST['text_color'] as $value) {
        $textColor[] = $value;
    }

    for ($x = 0; $x < count($_POST['game_order']); $x++) {
        tokenizeArray($_POST['game_order'][$x]);
        $newGameOrderArray[$x] = $tokens;
    }

    for ($x = 0; $x < count($newGameOrderArray); $x++) {

        $sql->db_Update(DB_TABLE_ROSTER_GAMES,
            "game_order     = ".intval($newGameOrderArray[$x][1]).",
            text_color      = '".$tp->toDB($textColor[$x])."'
            WHERE game_id   = ".intval($newGameOrderArray[$x][0]));
    }

    header("Location: admin_create_teams.php");
    exit;

} else if ($_GET['delete_game'] == '1') {

	// Verify deletion

    $text = "
    <center>
        <p>
            ".LAN_JBROSTER_ADMIN_CREATE_TEAMS_EDIT_CONFIRM_DELETE_GAME."
        </p>
        <p>
            <table width='100'>
                <tr>
                    <td>
                        <a href='admin_create_teams_edit.php?delete_game=2&game_id=".$_GET['game_id']."'>".LAN_JBROSTER_GENERAL_YES."</a>
                    </td>
                    <td>
                        <a href='admin_create_teams.php'>".LAN_JBROSTER_GENERAL_NO."</a>
                    </td>
                </tr>
            </table>
        </p>
    </center>";

    $title = "<b>".LAN_JBROSTER_ADMIN_CREATE_TEAMS_EDIT_TITLE_1."</b>";
    $ns->tablerender($title, $text);

} else if ($_GET['delete_game'] == '2') {

    // Delete game from db

	$gameId = mysql_real_escape_string($_GET['game_id']);

    $sql->db_Delete(DB_TABLE_ROSTER_GAMES,
        "game_id = ".intval($_GET['game_id']));

    $sql->db_Delete(DB_TABLE_ROSTER_TEAM_MEMBERS,
        "game_id = ".intval($_GET['game_id']));

    $sql->db_Delete(DB_TABLE_ROSTER_TEAM_STATUS,
        "game_id = ".intval($_GET['game_id']));

    $sql->db_Delete(DB_TABLE_ROSTER_TEAMS,
        "game_id = ".intval($_GET['game_id']));

    header("Location: admin_create_teams.php");
    exit;

} else if ($_POST['create_team'] == '1') {

    // Create team

    $sql->db_Select(DB_TABLE_ROSTER_PREFERENCES, "*", "organization_id = 1");
    while ($row = $sql->db_Fetch()) {
        $organizationType = $row['organization_type'];
    }

    if ($_POST['team_name'] == '') {
    	// Send back error
        header("Location: admin_create_teams.php?success_team=0");
        exit;
    }

	if ($organizationType == 6) {
	    if ($sql->db_Count(DB_TABLE_ROSTER_TEAMS, "(*)", " WHERE team_name = '".$tp->toDB($_POST['team_name'])."'") > 0) {
            // Do Nothing
	        header("Location: admin_create_teams.php?success_team=1");
	        exit;
	    } else {

            $sql1 = new db;
	        $sql1->db_Insert(DB_TABLE_ROSTER_TEAMS,
				"'',
				'".$tp->toDB($_POST['team_name'])."',
		        '',
		        '',
		        '".$tp->toDB($_POST['text_color'])."',
		        1,
		        1");

	        $sql1->db_Select(DB_TABLE_ROSTER_TEAMS, "*", "team_name = '".$tp->toDB($_POST['team_name'])."'");
	        while ($row1 = $sql1->db_Fetch()) {
	        	// Do Nothing
		        $team_id = $row1['team_id'];
		    }

	    	if ($sql1->db_Count(DB_TABLE_ROSTER_TEAM_STATUS, "(*)", " WHERE status_name = 'None' AND team_id = ".intval($team_id)) > 0) {
	    		// Do nothing
	    	} else {
                $sql2 = new db;
		        $sql2->db_Insert(DB_TABLE_ROSTER_TEAM_STATUS,
					"'',
					'None',
			        '".intval($team_id)."',
			        '".$tp->toDB($_POST['team_name'])."',
					'',
			        '',
			        'FFFFFF',
			        1");
	    	}

	        header("Location: admin_create_teams.php?success_team=2");
	        exit;
	    }

	} else {

		if ($sql->db_Count(DB_TABLE_ROSTER_TEAMS, "(*)", " WHERE team_name = '".$tp->toDB($_POST['team_name'])."'  AND game_id = ".intval($_POST['game_id'])) > 0) {
	        // Do Nothing
	        header("Location: admin_create_teams.php?success_team=1");
	        exit;
	    } else {
            $sql1 = new db;
	        $sql1->db_Select(DB_TABLE_ROSTER_GAMES, "*", "game_id = ".intval($_POST['game_id']));
	        while ($row1 = $sql1->db_Fetch()) {
                $gameName = $row1['game_name'];
	        }

	        $sql1->db_Insert(DB_TABLE_ROSTER_TEAMS,
				"'',
				'".$tp->toDB($_POST['team_name'])."',
		        ".intval($_POST['game_id']).",
		        '".$tp->toDB($gameName)."',
		        '".$tp->toDB($_POST['text_color'])."',
		        1,
		        1");

	        $sql1->db_Select(DB_TABLE_ROSTER_TEAMS, "*", "team_name = '".$tp->toDB($_POST['team_name'])."'");
	        while ($row1 = $sql1->db_Fetch()) {
		        // Do Nothing
		        $teamId = $row1['team_id'];
		    }

	    	if ($sql1->db_Count(DB_TABLE_ROSTER_TEAM_STATUS, "(*)", " WHERE   status_name = 'None'
	    	                                                          AND     team_id     = ".intval($teamId)) > 0) {
	    		// Do nothing
	    	} else {
	    	    $sql2 = new db;
		        $sql2->db_Insert(DB_TABLE_ROSTER_TEAM_STATUS,
					"'',
					'None',
			        ".intval($teamId).",
			        '".$tp->toDB($_POST['team_name'])."',
					".intval($_POST['game_id']).",
					'".$tp->toDB($gameName)."',
			        'FFFFFF',
			        '1'");
	    	}

	        header("Location: admin_create_teams.php?success_team=2");
	        exit;
	    }
	}

} else if ($_POST['change_team_order'] == '1') {

    // Change team order

    for ($x = 0; $x < count($_POST['team_order']); $x++) {
        tokenizeArray($_POST['team_order'][$x]);
        $newTeamOrderArray[$x] = $tokens;
    }

    foreach ($_POST['text_color'] as $value) {
        $textColor[] = $value;
    }

    for ($x = 0; $x < count($newTeamOrderArray); $x++) {

		if ($newTeamOrderArray[$x][2] == null) {
			$sql->db_Update(DB_TABLE_ROSTER_TEAMS,
	            "team_order    = ".intval($newTeamOrderArray[$x][1]).",
	            text_color     = '".$tp->toDB($textColor[$x])."'
	            WHERE team_id  = ".intval($newTeamOrderArray[$x][0]));
		} else {
	        $sql->db_Update(DB_TABLE_ROSTER_TEAMS,
	            "team_order    = ".intval($newTeamOrderArray[$x][2]).",
	            text_color     = '".$tp->toDB($textColor[$x])."'
	            WHERE team_id  = ".intval($newTeamOrderArray[$x][0])."
	            AND game_id    = ".intval($newTeamOrderArray[$x][1]));
		}
    }

    header("Location: admin_create_teams.php");
    exit;

} else if ($_GET['delete_team'] == '1') {

    // Verify deletion

	$sql->db_Select(DB_TABLE_ROSTER_PREFERENCES);
	while($row = $sql-> db_Fetch()){
	    $organization_name             = $row['organization_name'];
	    $organization_type             = $row['organization_type'];
	    $organization_designation      = $row['organization_designation'];
	    $organization_unit_designation = $row['organization_unit_designation'];
	    $organization_logo             = $row['organization_logo'];
	    $organization_logo_alignment   = $row['organization_logo_alignment'];
	}

	$sql->db_Select(DB_TABLE_ROSTER_ORG_UNIT_DESIGNATIONS, "*", "designation_id = ".intval($organization_unit_designation));
	while($row = $sql-> db_Fetch()){
	    $designation_name = $row['designation_name'];
	}

    $text = "
    <center>
        <p>
            ".LAN_JBROSTER_ADMIN_CREATE_TEAMS_EDIT_CONFIRM_DELETE_SQUAD." $designation_name?
        </p>
        <p>
            <table width='100'>
                <tr>
                    <td>
                        <a href='admin_create_teams_edit.php?delete_team=2&team_id=".$_GET['team_id']."&game_id=".$_GET['game_id']."&url=".$_GET['url']."'>".LAN_JBROSTER_GENERAL_YES."</a>
                    </td>
                    <td>
                        <a href='".$_GET['url']."'>".LAN_JBROSTER_GENERAL_NO."</a>
                    </td>
                </tr>
            </table>
        </p>
    </center>";

    $title = "<b>".LAN_JBROSTER_ADMIN_CREATE_TEAMS_EDIT_TITLE_2."</b>";
    $ns->tablerender($title, $text);

} else if ($_GET['delete_team'] == '2') {

    // Delete team

    $sql->db_Delete(DB_TABLE_ROSTER_TEAM_MEMBERS,   "team_id = ".intval($_GET['team_id']));

    $sql->db_Delete(DB_TABLE_ROSTER_TEAM_STATUS,    "team_id = ".intval($_GET['team_id']));

    $sql->db_Delete(DB_TABLE_ROSTER_TEAMS,          "team_id = ".intval($_GET['team_id']));

    header("Location: ".$_GET['url']);
    exit;

} else if ($_POST['add_team_status'] == '1') {

    // Add team status

    if ($_POST['status_name'] == '') {
    	// Send back error
        header("Location: admin_create_teams.php?success_status=0");
        exit;
    }

	if ($_POST['team_id'] == "All Teams") {
        // Insert status for all teams

        $sql->db_Select(DB_TABLE_ROSTER_TEAMS, "*");
        while ($row = $sql->db_Fetch()) {

            $sql1 = new db;
            if ($sql1->db_Count(DB_TABLE_ROSTER_TEAM_STATUS, "(*)", " WHERE  status_name = '".$tp->toDB($_POST['status_name'])."'
                                                                      AND    team_id     = ".intval($row['team_id'])) > 0) {
                // Do Nothing
                header("Location: admin_create_teams.php?success_status=1");
                exit;
            } else {
				if ($row['game_name'] == '') {
				    $sql1 = new db;
	                $sql1->db_Insert(DB_TABLE_ROSTER_TEAM_STATUS,
    	                "'',
    	                '".$tp->toDB($_POST['status_name'])."',
    					".intval($row['team_id']).",
    					'".$tp->toDB($row['team_name'])."',
    	                ".intval($row['game_id']).",
    	                '".$tp->toDB($row['game_name'])."',
    	                '".$tp->toDB($_POST['text_color'])."',
    	                1");
				} else {
				    $sql1 = new db;
	                $sql1->db_Insert(DB_TABLE_ROSTER_TEAM_STATUS,
    	                "'',
    	                '".$tp->toDB($_POST['status_name'])."',
    					".intval($row['team_id']).",
    					'".$tp->toDB($row['team_name'])."',
    	                ".intval($row['game_id']).",
    	                '".$tp->toDB($row['game_name'])."',
    	                '".$tp->toDB($_POST['text_color'])."',
    	                1");
				}
            }
        }

        header("Location: admin_create_teams.php?success_status=2");
        exit;

    } else {

        $sql->db_Select(DB_TABLE_ROSTER_TEAMS, "*", "team_id = ".intval($_POST['team_id']));
        while ($row = $sql->db_Fetch()) {
            $team_name  = $row['team_name'];
            $game_id    = $row['game_id'];
            $game_name  = $row['game_name'];
        }

        if ($sql->db_Count(DB_TABLE_ROSTER_TEAM_STATUS, "(*)", " WHERE  status_name = '".$tp->toDB($_POST['status_name'])."'
                                                                 AND    team_id     = ".intval($_POST['team_id'])) > 0) {
            // Do Nothing
            header("Location: admin_create_teams.php?success_status=1");
            exit;
        } else {

			if ($game_id != null) {
			    $sql1 = new db;
	            $sql1->db_Insert(DB_TABLE_ROSTER_TEAM_STATUS,
    	            "'',
    	            '".$tp->toDB($_POST['status_name'])."',
    				".intval($_POST['team_id']).",
    				'".$tp->toDB($team_name)."',
    	            ".intval($game_id).",
    	            '".$tp->toDB($game_name)."',
    	            '".$tp->toDB($_POST['text_color'])."',
    	            1");
			} else {
			    $sql1 = new db;
	            $sql1->db_Insert(DB_TABLE_ROSTER_TEAM_STATUS,
    	            "'',
    	            '".$tp->toDB($_POST['status_name'])."',
    				".intval($_POST['team_id']).",
    				'".$tp->toDB($team_name)."',
    	            '',
    	            '',
    	            '".$tp->toDB($_POST['text_color'])."',
    	            1");
			}

            header("Location: admin_create_teams.php?success_status=2");
            exit;
        }
    }

} else if ($_POST['change_status_order'] == '1') {

    // Change status order

    for ($x = 0; $x < count($_POST['status_order']); $x++) {
        tokenizeArray($_POST['status_order'][$x]);
        $newStatusOrderArray[$x] = $tokens;
    }

    foreach ($_POST['text_color'] as $value) {
        $textColor[] = $value;
    }

    for ($x = 0; $x < count($newStatusOrderArray); $x++) {
		if ($newStatusOrderArray[$x][2] == null) {
			$sql->db_Update(DB_TABLE_ROSTER_TEAM_STATUS,
	            "status_order      = '".$tp->toDB($newStatusOrderArray[$x][1])."',
	            text_color         = '".$tp->toDB($textColor[$x])."'
	            WHERE status_id    = ".intval($newStatusOrderArray[$x][0]));
		} else {
	        $sql->db_Update(DB_TABLE_ROSTER_TEAM_STATUS,
	            "status_order      = '".$tp->toDB($newStatusOrderArray[$x][2])."',
	            text_color         = '".$tp->toDB($textColor[$x])."'
	            WHERE status_id    = ".intval($newStatusOrderArray[$x][0])."
	            AND game_id        = ".intval($newStatusOrderArray[$x][1]));
		}
    }

    header("Location: admin_create_teams.php");
    exit;

} else if ($_GET['delete_status'] == '1') {

    // Verify deletion

    $text = "
    <center>
        <p>
            ".LAN_JBROSTER_ADMIN_CREATE_TEAMS_EDIT_CONFIRM_DELETE_STATUS."
        </p>
        <p>
            <table width='100'>
                <tr>
                    <td>
                        <a href='admin_create_teams_edit.php?delete_status=2&status_id=".$_GET['status_id']."&game_id=".$_GET['game_id']."'>".LAN_JBROSTER_GENERAL_YES."</a>
                    </td>
                    <td>
                        <a href='admin_create_teams.php'>".LAN_JBROSTER_GENERAL_NO."</a>
                    </td>
                </tr>
            </table>
        </p>
    </center>";

    $title = "<b>".LAN_JBROSTER_ADMIN_CREATE_TEAMS_EDIT_TITLE_3."</b>";
    $ns->tablerender($title, $text);

} else if ($_GET['delete_status'] == '2') {

    // Delete status from db

    $sql->db_Delete(DB_TABLE_ROSTER_TEAM_STATUS,
        "status_id = ".intval($_GET['status_id']));

    $sql->db_Update(DB_TABLE_ROSTER_TEAM_STATUS,
        "member_team_status         = 'None'
		WHERE member_team_status    = '".$tp->toDB($_GET['status_name'])."'");

    header("Location: admin_create_teams.php");
    exit;

} else {
    // Do nothing
    header("Location: admin_create_teams.php");
    exit;
}

require_once(e_ADMIN."footer.php");
?>