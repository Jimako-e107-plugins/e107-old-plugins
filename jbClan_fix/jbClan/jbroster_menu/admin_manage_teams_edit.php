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

require_once("includes/config.constants.php");
require_once("includes/config.functions.php");

$sql->db_Select(DB_TABLE_ROSTER_PREFERENCES, "*", "organization_id = 1");
while ($row = $sql->db_Fetch()) {
    $organizationType = $row['organization_type'];
}

if ($_POST['assign_team'] == '1') {

    /**********************************************************************
    *
    * Assign members to team
    *
    **********************************************************************/

	for ($x = 0; $x < count($_POST['team_assign_team']); $x++) {
		tokenizeArray($_POST['team_assign_team'][$x]);
		$newAssignTeamArray[$x] = $tokens;
	}

	for ($x = 0; $x < count($newAssignTeamArray); $x++) {

		if (!isset($newAssignTeamArray[$x][2])) {
			// Do nothing
		} else {

			if ($organizationType == 6) {
				if ($newAssignTeamArray[$x][1] == "None") {
					// Do Nothing
				} else {

					$numRows = $sql->db_Count(DB_TABLE_ROSTER_TEAM_MEMBERS, "(*)", "
						WHERE member_id   = ".intval($newAssignTeamArray[$x][0])."
						AND team_id       = ".intval($newAssignTeamArray[$x][1])."
						AND team_name     = '".$tp->toDB($newAssignTeamArray[$x][2])."'");

					if ($numRows > 0) {
						// Let them know that the member is already in that team
					} else {

						$sql->db_Select(DB_TABLE_ROSTER_MEMBERS, "*", "member_id = ".intval($newAssignTeamArray[$x][0]));

						while($row = $sql->db_Fetch()){ // start loop
							$nickname = $row['nickname'];
						}

						$sql->db_Insert(DB_TABLE_ROSTER_TEAM_MEMBERS,
							intval($newAssignTeamArray[$x][0]).",
							'".$tp->toDB($nickname)."',
							'".$tp->toDB($newAssignTeamArray[$x][1])."',
							'".$tp->toDB($newAssignTeamArray[$x][2])."',
							'',
							'',
							'None',
							'#FFFFFF',
							1");
					}
				}
			} else {
				if ($newAssignTeamArray[$x][1] == "None") {
					// Do Nothing
				} else {

					$numRows = $sql->db_Count(DB_TABLE_ROSTER_TEAM_MEMBERS, "(*)", "
						WHERE member_id   = ".intval($newAssignTeamArray[$x][0])."
						AND team_id       = ".intval($newAssignTeamArray[$x][1])."
						AND team_name     = '".$tp->toDB($newAssignTeamArray[$x][2])."'
						AND game_id       = ".intval($newAssignTeamArray[$x][3])."
						AND game_name     = '".$tp->toDB($newAssignTeamArray[$x][4])."'");

					if ($numRows > 0) {
						// Let them know that the member is already in that team
					} else {

						$sql->db_Select(DB_TABLE_ROSTER_MEMBERS, "*", "member_id = ".intval($newAssignTeamArray[$x][0]));

						while($row = $sql->db_Fetch()){ // start loop
							$nickname = $row['nickname'];
						}

						$sql->db_Insert(DB_TABLE_ROSTER_TEAM_MEMBERS,
							intval($newAssignTeamArray[$x][0]).",
							'".$tp->toDB($nickname)."',
							".intval($newAssignTeamArray[$x][1]).",
							'".$tp->toDB($newAssignTeamArray[$x][2])."',
							".intval($newAssignTeamArray[$x][3]).",
							'".$tp->toDB($newAssignTeamArray[$x][4])."',
							'None',
							'#FFFFFF',
							1");
					}
				}
			}
		}
	}

	header("Location: admin_manage_teams.php");
    exit;

} else if ($_POST['edit_team'] == '1') {

	/**********************************************************************
	*
	* Change Leader Status
	*
	**********************************************************************/

	for ($x = 0; $x < count($_POST['leader_status']); $x++) {
		tokenizeArray($_POST['leader_status'][$x]);
		$newLeaderStatusArray[$x] = $tokens;
	}

	for ($x = 0; $x < count($newLeaderStatusArray); $x++) {

        if ($sql->db_Count(DB_TABLE_ROSTER_MEMBERS, "(*)", " WHERE  member_id       = ".intval($newLeaderStatusArray[$x][0])."
                                                             AND    leader_status   =   '".$tp->toDB($newLeaderStatusArray[$x][1])."'") > 0) {
			// Do Nothing
		} else {

			$sql->db_Update(DB_TABLE_ROSTER_MEMBERS,
                "leader_status  = '".$tp->toDB($newLeaderStatusArray[$x][1])."'
				WHERE member_id = ".intval($newLeaderStatusArray[$x][0]));
		}

		if ($sql->db_Count(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES, "(*)", " WHERE    member_id       = ".intval($newLeaderStatusArray[$x][0])."
		                                                                     AND      attribute_value = '".$tp->toDB($newLeaderStatusArray[$x][1])."'") > 0) {
        	// Do Nothing
		} else {
			$sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_VALUES,
                "attribute_value    = '".$tp->toDB($newLeaderStatusArray[$x][1])."'
				WHERE member_id     = ".intval($newLeaderStatusArray[$x][0])."
				AND attribute_id    = 5");
		}

	}

	/**********************************************************************
	*
	* Change Leader Order
	*
	**********************************************************************/

	for ($x = 0; $x < count($_POST['leader_new_member_leader_order']); $x++) {
		tokenizeArray($_POST['leader_new_member_leader_order'][$x]);
		$newLeaderOrderArray[$x] = $tokens;
	}

	for ($x = 0; $x < count($newLeaderOrderArray); $x++) {

		$sql->db_Update(DB_TABLE_ROSTER_MEMBERS,
			"leader_order    = ".intval($newLeaderOrderArray[$x][2])."
			WHERE member_id  = ".intval($newLeaderOrderArray[$x][1]));

	}

	/**********************************************************************
	*
	* Change Teams
	*
	**********************************************************************/

	for ($x = 0; $x < count($_POST['team_new_member_team']); $x++) {
		tokenizeArray($_POST['team_new_member_team'][$x]);
		$newTeamArray[$x] = $tokens;
	}

	for ($x = 0; $x < count($newTeamArray); $x++) {

		if ($organizationType == 6) {
			if ($newTeamArray[$x][4] == "None") {

				// Delete record
				$sql->db_Delete(DB_TABLE_ROSTER_TEAM_MEMBERS, "
					member_id      = ".intval($newTeamArray[$x][0])."
					AND team_id    = ".intval($newTeamArray[$x][1]));

			} else {

				$numRows = $sql->db_Count(DB_TABLE_ROSTER_TEAM_MEMBERS, "(*)", "
					WHERE member_id    = ".intval($newTeamArray[$x][0])."
					AND team_id        = ".intval($newTeamArray[$x][3]));

				if ($numRows > 0) {
					// Let them know that the member is already in that team
				} else {

					$sql->db_Select(DB_TABLE_ROSTER_MEMBERS, "*", "member_id = ".intval($newTeamArray[$x][0]));
					while($row = $sql->db_Fetch()){ // start loop
						$nickname = $row['nickname'];
					}

					// Delete record
					$sql->db_Delete(DB_TABLE_ROSTER_TEAM_MEMBERS, "
						member_id     = ".intval($newTeamArray[$x][0])."
						AND team_id   = ".intval($newTeamArray[$x][1]));

					$sql->db_Insert(DB_TABLE_ROSTER_TEAM_MEMBERS,
						intval($newTeamArray[$x][0]).",
						'".$tp->toDB($nickname)."',
						'".$tp->toDB($newTeamArray[$x][3])."',
						'".$tp->toDB($newTeamArray[$x][4])."',
						'',
						'',
						'None',
						'FFFFFF',
						1");
				}
			}
		} else {
			if (!isset($newTeamArray[$x][4])) {
				// Don't edit this team
			} else {
				if ($newTeamArray[$x][3] == "None") {

					// Delete record
					$sql->db_Delete(DB_TABLE_ROSTER_TEAM_MEMBERS, "
						member_id     = ".intval($newTeamArray[$x][0])."
						AND team_id   = ".intval($newTeamArray[$x][1])."
						AND game_id   = ".intval($newTeamArray[$x][3]));

				} else {

					$numRows = $sql->db_Count(DB_TABLE_ROSTER_TEAM_MEMBERS, "(*)", "
						WHERE member_id   = ".intval($newTeamArray[$x][0])."
						AND   team_id     = ".intval($newTeamArray[$x][5])."
						AND   game_id     = ".intval($newTeamArray[$x][7]));

					if ($numRows > 0) {
						// Let them know that the member is already in that team
					} else {

						$sql->db_Select(DB_TABLE_ROSTER_MEMBERS, "*", "member_id = ".intval($newTeamArray[$x][0]));
						while($row = $sql->db_Fetch()){ // start loop
							$nickname = $row['nickname'];
						}

						// Delete record
						$sql->db_Delete(DB_TABLE_ROSTER_TEAM_MEMBERS, "
							member_id    = ".intval($newTeamArray[$x][0])."
							AND team_id  = ".intval($newTeamArray[$x][1]));

						$sql->db_Insert(DB_TABLE_ROSTER_TEAM_MEMBERS,
							intval($newTeamArray[$x][0]).",
							'".$tp->toDB($nickname)."',
							".intval($newTeamArray[$x][5]).",
							'".$tp->toDB($newTeamArray[$x][6])."',
							".intval($newTeamArray[$x][7]).",
							'".$tp->toDB($newTeamArray[$x][8])."',
							'None',
							'FFFFFF',
							1");
					}
				}
			}
		}
	}

	/**********************************************************************
	*
	* Change Team Status
	*
	**********************************************************************/

	for ($x = 0; $x < count($_POST['team_new_member_team_status']); $x++) {
		tokenizeArray($_POST['team_new_member_team_status'][$x]);
		$newTeamStatusArray[$x] = $tokens;
	}

	for ($x = 0; $x < count($newTeamStatusArray); $x++) {

		if ($organizationType == 6) {
			if ($newTeamStatusArray[$x][3] == "") {
				// Do Nothing
			} else {
				$sql->db_Update(DB_TABLE_ROSTER_TEAM_MEMBERS,
					"member_team_status    = '".$tp->toDB($newTeamStatusArray[$x][3])."'
					WHERE member_id        = ".intval($newTeamStatusArray[$x][0])."
					AND member_team_status = '".$tp->toDB($newTeamStatusArray[$x][2])."'
					AND team_id            = ".intval($newTeamStatusArray[$x][1]));

				$sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES,
					"attribute_value   = '".$tp->toDB($newTeamStatusArray[$x][3])."'
					WHERE member_id    = ".intval($newTeamStatusArray[$x][0])."
					AND attribute_id   = 3");
			}
		} else {
			if ($newTeamStatusArray[$x][4] == "") {
				// Do Nothing
			} else {

				$sql->db_Update(DB_TABLE_ROSTER_TEAM_MEMBERS,
					"member_team_status    = '".$tp->toDB($newTeamStatusArray[$x][4])."'
					WHERE member_id        = ".intval($newTeamStatusArray[$x][0])."
					AND member_team_status = '".$tp->toDB($newTeamStatusArray[$x][2])."'
					AND team_id            = ".intval($newTeamStatusArray[$x][1])."
					AND game_id            = ".intval($newTeamStatusArray[$x][3]));

				$sql->db_Update(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES,
					"attribute_value   = '".$tp->toDB($newTeamStatusArray[$x][4])."'
					WHERE member_id    = ".intval($newTeamStatusArray[$x][0])."
					AND attribute_id   = 3");
			}
		}
	}

	/**********************************************************************
	*
	* Change Team Order
	*
	**********************************************************************/

	for ($x = 0; $x < count($_POST['team_new_member_team_order']); $x++) {
		tokenizeArray($_POST['team_new_member_team_order'][$x]);
		$newTeamOrderArray[$x] = $tokens;
	}

	for ($x = 0; $x < count($newTeamOrderArray); $x++) {
		if ($organizationType == 6) {
			$numRows = $sql->db_Count(DB_TABLE_ROSTER_TEAM_MEMBERS, "(*)", "
				WHERE member_id         = ".intval($newTeamOrderArray[$x][0])."
				AND team_id             = ".intval($newTeamOrderArray[$x][2])."
				AND member_team_order   = ".intval($newTeamOrderArray[$x][3]));
			if ($numRows > 0) {
				// Do Nothing
			} else {
				$sql->db_Update(DB_TABLE_ROSTER_TEAM_MEMBERS,
					"member_team_order     = ".intval($newTeamOrderArray[$x][3])."
					WHERE member_id        = ".intval($newTeamOrderArray[$x][0])."
					AND member_team_order  = ".intval($newTeamOrderArray[$x][1])."
					AND team_id            = ".intval($newTeamOrderArray[$x][2]));
			}
		} else {
			$numRows = $sql->db_Count(DB_TABLE_ROSTER_TEAM_MEMBERS, "(*)", "
				WHERE member_id         = ".intval($newTeamOrderArray[$x][0])."
				AND team_id             = ".intval($newTeamOrderArray[$x][1])."
				AND game_id             = ".intval($newTeamOrderArray[$x][3])."
				AND member_team_order   = ".intval($newTeamOrderArray[$x][4]));
			if ($numRows > 0) {
				// Do Nothing
			} else {
				$sql->db_Update(DB_TABLE_ROSTER_TEAM_MEMBERS,
					"member_team_order     = ".intval($newTeamOrderArray[$x][4])."
					WHERE member_id        = ".intval($newTeamOrderArray[$x][0])."
					AND member_team_order  = ".intval($newTeamOrderArray[$x][2])."
					AND team_id            = ".intval($newTeamOrderArray[$x][1])."
					AND game_id            = ".intval($newTeamOrderArray[$x][3]));
			}
		}
	}

	header("Location: admin_manage_teams.php");
	exit;
} else {
	header("Location: admin_manage_teams.php");
	exit;
}

require_once(e_ADMIN."footer.php");

?>