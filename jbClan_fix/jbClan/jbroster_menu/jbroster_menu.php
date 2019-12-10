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

if(file_exists(e_PLUGIN."jbroster_menu/languages/".e_LANGUAGE.".php")) {
    include_lan(e_PLUGIN."jbroster_menu/languages/".e_LANGUAGE.".php");
}

require_once("includes/config.constants.php");

$sql->db_Select(DB_TABLE_ROSTER_PREFERENCES);
while($row = $sql->db_Fetch()){
    $organization_name              = $row['organization_name'];
    $organization_type              = $row['organization_type'];
    $organization_designation       = $row['organization_designation'];
    $organization_unit_designation  = $row['organization_unit_designation'];
    $organization_logo              = $row['organization_logo'];
}

$sql->db_Select(DB_TABLE_ROSTER_LEADER_STATUS, "*", "status_name != 'None' AND status_name != 'Organization Leader' AND status_name != 'Organization Captain' AND status_name != 'Web Admin'");
while($row = $sql->db_Fetch()){ // start loop
	$customArgs .= " OR leader_status like '".$tp->toDB($row['status_name'])."%'";
}

$sql->db_Select(DB_TABLE_ROSTER_LEADER_STATUS, "*", "status_name != 'None' AND status_name != 'Organization Leader' AND status_name != 'Organization Captain' AND status_name != 'Web Admin'");
while($row = $sql->db_Fetch()){ // start loop
	$customArgsNot .= " AND leader_status != '".$tp->toDB($row['status_name'])."'";
}

$sql->db_Select(DB_TABLE_ROSTER_ORG_UNIT_DESIGNATIONS, "*", "designation_id = ".intval($organization_unit_designation));
while($row = $sql->db_Fetch()){
    $unit_designation_name = $row['designation_name'];
}

$text = "
<div style='width:100%'>
	<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
		<tr>
			<td class='forumheader3'>
				<span class='smalltext'>
					<b>".LAN_JBROSTER_GENERAL_GAME_NAME."</b>
				</span>
			</td>
			<td class='forumheader3'>
				<span class='smalltext'>
					<b>".LAN_JBROSTER_GENERAL_MEMBER_STATUS."</b>
				</span>
			</td>
		</tr>";

		$numRows = $sql->db_Count(DB_TABLE_ROSTER_MEMBERS);

		if ($numRows == 0) {
			$text .= "
			<tr>
				<td colspan=10 class='forumheader3'>
					<center>
						<p>
						    ".LAN_JBROSTER_GENERAL_NO_MEMBERS_IN_SYSTEM."
						</p>
					</center>
				</td>
			</tr>";
		} else {
			// Do Nothing
		}

		$sql->db_Select(DB_TABLE_ROSTER_MEMBERS, "*", "leader_status like 'Organization Leader%' OR leader_status like 'Organization Captain%' OR leader_status like 'Web Admin%'$customArgs ORDER BY leader_order");
		while($row = $sql->db_Fetch()){ // start loop
			$text .="<tr>";

			if ($row['nickname'] == '') {
				$text .="<td class='forumheader3'>&nbsp;</td>";
			} else {
				$text .="
				<td class='forumheader3'>
					<span class='smalltext'>
						<a href='".e_PLUGIN."jbroster_menu/member_profile.php?member_id=".$row['member_id']."'>".$row['nickname']."</a>
					</span>
				</td>";
			}

			if ($row['leader_status'] == '') {
				$text .="<td class='forumheader3'>&nbsp;</td>";
			} else {
				$text .="
					<td class='forumheader3'>
						<span class='smalltext'>
							".$row['leader_status']."
						</span>
					</td>";
			}

			$text .="</tr>";
		}

		$sql->db_Select(DB_TABLE_ROSTER_MEMBER_STATUS, "*", "display = 2 ORDER BY status_order");
		while ($row = $sql->db_Fetch()) {

			$sql1 = new db;
			$numRows = $sql1->db_Count(DB_TABLE_ROSTER_MEMBERS, "(*)", "WHERE    member_status  = '".$tp->toDB($row['status_name'])."'
			                                                            AND      leader_status != 'Organization Leader'
			                                                            AND      leader_status != 'Organization Captain'
			                                                            AND      leader_status != 'Web Admin'$customArgsNot");
			if ($numRows > 0) {
				$text .= "
				<tr>
					<td class='forumheader3'>
						&nbsp;
					</td>
					<td class='forumheader3'>
						&nbsp;
					</td>
				</tr>";
			}

			$sql1->db_Select(DB_TABLE_ROSTER_MEMBERS, "*", "member_status      = '".$tp->toDB($row['status_name'])."'
			                                                AND leader_status != 'Organization Leader'
			                                                AND leader_status != 'Organization Captain'
			                                                AND leader_status != 'Web Admin'$customArgsNot
			                                                ORDER BY nickname");
			while($row1 = $sql1->db_Fetch()){ // start loop
				$text .="<tr>";

				if ($row1['nickname'] == '') {
					$text .="<td class='forumheader3'>&nbsp;</td>";
				} else {
					$text .="
						<td class='forumheader3'>
							<span class='smalltext'>
								<a href='".e_PLUGIN."jbroster_menu/member_profile.php?member_id=".$row1['member_id']."'>".$row1['nickname']."</a>
							</span>
						</td>";
				}

				if ($row1['member_status'] == '') {
					$text .="<td class='forumheader3'>&nbsp;</td>";
				} else {
					$text .="
						<td class='forumheader3'>
							<span class='smalltext'>
								".$row1['member_status']."
							</span>
						</td>";
				}
			}

			$text .= "
			</tr>";

		}

    $text .= "
	</table>
</div>";


$title = "<b>".LAN_JBROSTER_MENU_TITLE."</b>";
$ns->tablerender($title, $text);
?>