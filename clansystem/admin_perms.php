<?php
/*
--------------------------------------------------------------------------------

	Title: ClanSystem
	$Author: kamers $
	$Date: 2007-03-21 23:33:09 -0400 (Wed, 21 Mar 2007) $
	Version: 0.1
	$Revision: 7 $
	Description: Complete Clan Management Plugin

--------------------------------------------------------------------------------
*/

require_once("clansystem_def.php");
include(CS_DEF_LANFILE);

$pageid = "perms";  // unique name that matches the one used in admin_menu.php.

if(!getperms("P")){ header("location:".e_BASE."index.php");}
require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."form_handler.php");

$sql = new db;

if(isSet($_POST['load']))
{
	extract($_POST);

	$clansys_cur_classid = $clansys_userclass_id;
}
else
{
	$clansys_cur_classid = 0;
}

if(isSet($_POST['clansys_userclass_id']))
{
	extract($_POST);

	$clansys_cur_classid = $clansys_userclass_id;
}
else
{
	$clansys_cur_classid = 0;
}

if(isSet($_POST['update_perms']))
{
	extract($_POST);

	$role_member_admin ? $role_member_admin=1 : $role_member_admin=0;
	$role_member_rank ? $role_member_rank=1 : $role_member_rank=0;
	$role_member_rank_squad ? $role_member_rank_squad=1 : $role_member_rank_squad=0;
	$role_member_kick ? $role_member_kick=1 : $role_member_kick=0;
	$role_squads_admin_all ? $role_squads_admin_all=1 : $role_squads_admin_all=0;
	$role_admin_own ? $role_admin_own=1 : $role_admin_own=0;
	$role_roster_all ? $role_roster_all=1 : $role_roster_all=0;
	$role_roster_own ? $role_roster_own=1 : $role_roster_own=0;
	$role_join_requests_view ? $role_join_requests_view=1 : $role_join_requests_view=0;
	$role_join_requests_comment ? $role_join_requests_comment=1 : $role_join_requests_comment=0;
	$role_join_requests_decide ? $role_join_requests_decide=1 : $role_join_requests_decide=0;
	$role_awards_admin ? $role_awards_admin=1 : $role_awards_admin=0;
	$role_awards_create ? $role_awards_create=1 : $role_awards_create=0;
	$role_awards_edit ? $role_awards_edit=1 : $role_awards_edit=0;
	$role_clan_admin ? $role_clan_admin=1 : $role_clan_admin=0;
	$role_clan_admin_own ? $role_clan_admin_own=1 : $role_clan_admin_own=0;
	$role_challenge_admin ? $role_challenge_admin=1 : $role_challenge_admin=0;
	$role_challenge_reject ? $role_challenge_reject=1 : $role_challenge_reject=0;
	$role_challenge_comment ? $role_challenge_comment=1 : $role_challenge_comment=0;
	$role_challenge_delete ? $role_challenge_delete=1 : $role_challenge_delete=0;
	$role_challenge_edit_own ? $role_challenge_edit_own=1 : $role_challenge_edit_own=0;
	$role_games_admin ? $role_games_admin=1 : $role_games_admin=0;
	$role_game_modes_admin ? $role_game_modes_admin=1 : $role_game_modes_admin=0;

	$sql->db_Update("clansystem_role","role_member_admin=$role_member_admin,
					role_member_rank=$role_member_rank,
					role_member_rank_squad=$role_member_rank_squad,
					role_member_kick=$role_member_kick,
					role_squads_admin_all=$role_squads_admin_all,
					role_admin_own=$role_admin_own,
					role_roster_all=$role_roster_all,
					role_roster_own=$role_roster_own,
					role_join_requests_view=$role_join_requests_view,
					role_join_requests_comment=$role_join_requests_comment,
					role_join_requests_decide=$role_join_requests_decide,
					role_awards_admin=$role_awards_admin,
					role_awards_create=$role_awards_create,
					role_awards_edit=$role_awards_edit,
					role_clan_admin=$role_clan_admin,
					role_clan_admin_own=$role_clan_admin_own,
					role_challenge_admin=$role_challenge_admin,
					role_challenge_reject=$role_challenge_reject,
					role_challenge_comment=$role_challenge_comment,
					role_challenge_delete=$role_challenge_delete,
					role_challenge_edit_own=$role_challenge_edit_own,
					role_games_admin=$role_games_admin,
					role_game_modes_admin=$role_game_modes_admin
					 WHERE e107_userclass_id=$clansys_userclass_id");
//					 WHERE e107_userclass_id=$e107_userclass_id");

//	$clansys_cur_classid = $e107_userclass_id;
	$clansys_cur_classid = $clansys_userclass_id;
}


//Dispaly Drop-Down of Roles
$csfrm = new form;

$clansys_text = "<div style='text-align: center'>";
//$clansys_text .= $clansys_cur_classid;
$clansys_text .= $clansys_msg;
$clansys_text .= $csfrm->form_open("post", e_SELF, "classlist");
$clansys_text .= "<table class='fborder' style='width: 90%'>
					<tr>
						<td class='fcaption' style='width: 40%; text-align: center; vertical-align: top' colspan='2'>" .CS_ADM_PERM_2. ": ";
$clansys_text .= $csfrm->form_select_open("clansys_userclass_id","onChange='this.form.submit()'");

$sql->db_Select("userclass_classes", "*", "ORDER BY userclass_name", false);
while($row = $sql->db_Fetch())
{
	extract($row);

	$frm_selected = false;

	if($clansys_cur_classid == $userclass_id || $clansys_cur_classid == 0)
	{
		$frm_selected = true;
		$clansys_cur_classid = $userclass_id;
	}

	$clansys_text .= $csfrm->form_option($userclass_name, $frm_selected, $userclass_id);
}

$clansys_text .= $csfrm->form_select_close();
//$clansys_text .= $csfrm->form_button("submit", "load", CS_ADM_PERM_3);

$sql->db_Select("clansystem_role", "*", "e107_userclass_id=$clansys_cur_classid");
$row = $sql->db_Fetch();
extract($row);

$clansys_text .= "		</td>
					</tr>
					<tr>
						<td class='forumheader3' style='width: 50%; text-align: right; vertical-align: top'>".CS_ADM_PERM_4.":</td>
						<td class='forumheader3' style='width: 50%; text-align: left; vertical-align: top'><input type='checkbox' name='role_member_admin'".($role_member_admin ? " checked" : "")."></td>
					</tr>
					<tr>
						<td class='forumheader3' style='width: 50%; text-align: right; vertical-align: top'>".CS_ADM_PERM_5.":</td>
						<td class='forumheader3' style='width: 50%; text-align: left; vertical-align: top'><input type='checkbox' name='role_member_rank'".($role_member_rank ? " checked" : "")."></td>
					</tr>
					<tr>
						<td class='forumheader3' style='width: 50%; text-align: right; vertical-align: top'>".CS_ADM_PERM_7.":</td>
						<td class='forumheader3' style='width: 50%; text-align: left; vertical-align: top'><input type='checkbox' name='role_member_rank_squad'".($role_member_rank_squad ? " checked" : "")."></td>
					</tr>
					<tr>
						<td class='forumheader3' style='width: 50%; text-align: right; vertical-align: top'>".CS_ADM_PERM_8.":</td>
						<td class='forumheader3' style='width: 50%; text-align: left; vertical-align: top'><input type='checkbox' name='role_member_kick'".($role_member_kick ? " checked" : "")."></td>
					</tr>
					<tr>
						<td class='forumheader3' style='width: 50%; text-align: right; vertical-align: top'>".CS_ADM_PERM_9.":</td>
						<td class='forumheader3' style='width: 50%; text-align: left; vertical-align: top'><input type='checkbox' name='role_squads_admin_all'".($role_squads_admin_all ? " checked" : "")."></td>
					</tr>
					<tr>
						<td class='forumheader3' style='width: 50%; text-align: right; vertical-align: top'>".CS_ADM_PERM_10.":</td>
						<td class='forumheader3' style='width: 50%; text-align: left; vertical-align: top'><input type='checkbox' name='role_admin_own'".($role_admin_own ? " checked" : "")."></td>
					</tr>
					<tr>
						<td class='forumheader3' style='width: 50%; text-align: right; vertical-align: top'>".CS_ADM_PERM_11.":</td>
						<td class='forumheader3' style='width: 50%; text-align: left; vertical-align: top'><input type='checkbox' name='role_roster_all'".($role_roster_all ? " checked" : "")."></td>
					</tr>
					<tr>
						<td class='forumheader3' style='width: 50%; text-align: right; vertical-align: top'>".CS_ADM_PERM_12.":</td>
						<td class='forumheader3' style='width: 50%; text-align: left; vertical-align: top'><input type='checkbox' name='role_roster_own'".($role_roster_own ? " checked" : "")."></td>
					</tr>
					<tr>
						<td class='forumheader3' style='width: 50%; text-align: right; vertical-align: top'>".CS_ADM_PERM_13.":</td>
						<td class='forumheader3' style='width: 50%; text-align: left; vertical-align: top'><input type='checkbox' name='role_join_requests_view'".($role_join_requests_view ? " checked" : "")."></td>
					</tr>
					<tr>
						<td class='forumheader3' style='width: 50%; text-align: right; vertical-align: top'>".CS_ADM_PERM_14.":</td>
						<td class='forumheader3' style='width: 50%; text-align: left; vertical-align: top'><input type='checkbox' name='role_join_requests_comment'".($role_join_requests_comment ? " checked" : "")."></td>
					</tr>
					<tr>
						<td class='forumheader3' style='width: 50%; text-align: right; vertical-align: top'>".CS_ADM_PERM_15.":</td>
						<td class='forumheader3' style='width: 50%; text-align: left; vertical-align: top'><input type='checkbox' name='role_join_requests_decide'".($role_join_requests_decide ? " checked" : "")."></td>
					</tr>
					<tr>
						<td class='forumheader3' style='width: 50%; text-align: right; vertical-align: top'>".CS_ADM_PERM_16.":</td>
						<td class='forumheader3' style='width: 50%; text-align: left; vertical-align: top'><input type='checkbox' name='role_awards_admin'".($role_awards_admin ? " checked" : "")."></td>
					</tr>
					<tr>
						<td class='forumheader3' style='width: 50%; text-align: right; vertical-align: top'>".CS_ADM_PERM_17.":</td>
						<td class='forumheader3' style='width: 50%; text-align: left; vertical-align: top'><input type='checkbox' name='role_awards_create'".($role_awards_create ? " checked" : "")."></td>
					</tr>
					<tr>
						<td class='forumheader3' style='width: 50%; text-align: right; vertical-align: top'>".CS_ADM_PERM_18.":</td>
						<td class='forumheader3' style='width: 50%; text-align: left; vertical-align: top'><input type='checkbox' name='role_awards_edit'".($role_awards_edit ? " checked" : "")."></td>
					</tr>
					<tr>
						<td class='forumheader3' style='width: 50%; text-align: right; vertical-align: top'>".CS_ADM_PERM_19.":</td>
						<td class='forumheader3' style='width: 50%; text-align: left; vertical-align: top'><input type='checkbox' name='role_clan_admin'".($role_clan_admin ? " checked" : "")."></td>
					</tr>
					<tr>
						<td class='forumheader3' style='width: 50%; text-align: right; vertical-align: top'>".CS_ADM_PERM_20.":</td>
						<td class='forumheader3' style='width: 50%; text-align: left; vertical-align: top'><input type='checkbox' name='role_clan_admin_own'".($role_clan_admin_own ? " checked" : "")."></td>
					</tr>
					<tr>
						<td class='forumheader3' style='width: 50%; text-align: right; vertical-align: top'>".CS_ADM_PERM_21.":</td>
						<td class='forumheader3' style='width: 50%; text-align: left; vertical-align: top'><input type='checkbox' name='role_challenge_admin'".($role_challenge_admin ? " checked" : "")."></td>
					</tr>
					<tr>
						<td class='forumheader3' style='width: 50%; text-align: right; vertical-align: top'>".CS_ADM_PERM_22.":</td>
						<td class='forumheader3' style='width: 50%; text-align: left; vertical-align: top'><input type='checkbox' name='role_challenge_reject'".($role_challenge_reject ? " checked" : "")."></td>
					</tr>
					<tr>
						<td class='forumheader3' style='width: 50%; text-align: right; vertical-align: top'>".CS_ADM_PERM_23.":</td>
						<td class='forumheader3' style='width: 50%; text-align: left; vertical-align: top'><input type='checkbox' name='role_challenge_comment'".($role_challenge_comment ? " checked" : "")."></td>
					</tr>
					<tr>
						<td class='forumheader3' style='width: 50%; text-align: right; vertical-align: top'>".CS_ADM_PERM_24.":</td>
						<td class='forumheader3' style='width: 50%; text-align: left; vertical-align: top'><input type='checkbox' name='role_challenge_delete'".($role_challenge_delete ? " checked" : "")."></td>
					</tr>
					<tr>
						<td class='forumheader3' style='width: 50%; text-align: right; vertical-align: top'>".CS_ADM_PERM_25.":</td>
						<td class='forumheader3' style='width: 50%; text-align: left; vertical-align: top'><input type='checkbox' name='role_challenge_edit_own'".($role_challenge_edit_own ? " checked" : "")."></td>
					</tr>
					<tr>
						<td class='forumheader3' style='width: 50%; text-align: right; vertical-align: top'>".CS_ADM_PERM_26.":</td>
						<td class='forumheader3' style='width: 50%; text-align: left; vertical-align: top'><input type='checkbox' name='role_games_admin'".($role_games_admin ? " checked" : "")."></td>
					</tr>
					<tr>
						<td class='forumheader3' style='width: 50%; text-align: right; vertical-align: top'>".CS_ADM_PERM_27.":</td>
						<td class='forumheader3' style='width: 50%; text-align: left; vertical-align: top'><input type='checkbox' name='role_game_modes_admin'".($role_game_modes_admin ? " checked" : "")."></td>
					</tr>
					<tr>
						<td class='fcaption' colspan='2' style='text-align: center'>".$csfrm->form_button("submit", "update_perms", CS_ADM_PERM_6)."</td>
					</tr>
				</table>";
//$clansys_text .= $csfrm->form_hidden("e107_userclass_id", $clansys_cur_classid);
$clansys_text .= $csfrm->form_close();
$clansys_text .= "</div>";

$ns->tablerender(CS_ADM_PERM_1, $clansys_text);
require_once(e_ADMIN."footer.php");

?>