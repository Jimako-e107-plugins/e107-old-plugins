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

if (!defined('e107_INIT'))
{
    exit;
}

include(CS_DEF_LANFILE);

require_once(HEADERF);
require_once(e_HANDLER."form_handler.php");

$clansys_usercanview = CLANSYS_USERHASPERM("role_join_requests_view");
$clansys_usercandecide = CLANSYS_USERHASPERM("role_join_requests_decide");
$clansys_usercancomment = CLANSYS_USERHASPERM("role_join_requests_comment");

$sql = new db;
$csfrm = new form;

if(e_QUERY)
{
	$sql->db_Select("clansystem_join_request", "*", "join_request_id=" .e_QUERY);
	$row = $sql->db_Fetch();

	extract($row);

	$clansys_query_id = e_QUERY;
	$clansys_query_userid = $e107_user_id;
}

$clansys_userviewingown = ($clansys_query_userid == USERID && !ADMIN);
$clansys_text = "";







if(isset($_POST['update_app']))
{
	extract($_POST);

	if(!$clansys_usercandecide)
	{
		$clansys_text .= "<div style='text-align: center; font-weight: bold'>".CS_REQ_2."</div>";
	}
	else
	{
		if($join_request_status!=$join_request_status_prev)
		{
			$join_request_status_date = date("Y-m-d");
		}
		else
		{
			$join_request_status_date = $join_request_status_date_prev;
		}

		if(!$join_request_status)
		{
			$join_request_status = $join_request_status_prev;
		}

		if($sql->db_Update("clansystem_join_request",
							"join_request_status='$join_request_status', join_request_status_date='$join_request_status_date'
							WHERE join_request_id=$join_request_id"))
		{
			$clansys_text .= "<div style='text-align: center; font-weight: bold'>".CS_REQ_15."</div>";
		}
		else
		{
			$clansys_text .= "<div style='text-align: center; font-weight: bold; color: red'>".CS_REQ_16."</div>";
		}

		if($join_request_status=="Accepted" && $join_request_status_prev!="Accepted")
		{
			if($sql->db_Insert("clansystem_member", array("member_join_date"=>date("Y-m-d"), "e107_user_id"=>$e107_user_id)))
			{
				$clansys_text .= "<div style='text-align: center; font-weight: bold'>".CS_REQ_18."</div>";
			}
			else
			{
				$clansys_text .= "<div style='text-align: center; font-weight: bold; color: red'>".CS_REQ_19."</div>";
			}
		}
	}
}

if(isset($_POST['leave_comment']))
{
	extract($_POST);

	if(!$clansys_usercancomment)
	{
		$clansys_text .= "<div style='text-align: center; font-weight: bold'>".CS_REQ_2."</div>";
	}
	else
	{
		if(strlen($join_request_comment_text)<1 || !$join_request_comment_text)
		{
			$clansys_err .=  CS_REQ_23;
		}

		if($clansys_err)
		{
			$clansys_text .= "<div style='text-align: center; font-weight: bold; color: red'>$clansys_err</div>";
			$clansys_comment_text = $join_request_comment_text;
		}
		else
		{
			if($sql->db_Insert("clansystem_join_request_comment",
								array("join_request_id"=>"$join_request_id",
									"join_request_comment_date"=>date("Y-m-d"),
									"join_request_member_id"=>ClanSys_GetMemberId(),
									"join_request_comment_text"=>"$join_request_comment_text",
									"join_request_comment_public"=>$join_request_comment_public)))
			{
				$clansys_text .= "<div style='text-align: center; font-weight: bold'>".CS_REQ_24."</div>";
			}
			else
			{
				$clansys_text .= "<div style='text-align: center; font-weight: bold; color: red'>".CS_REQ_25."</div>";
				$clansys_comment_text = $join_request_comment_text;
			}
		}
	}
}




// If Query for Specific User, then Display User's Application
if($clansys_query_id)
{
	if((!$clansys_usercanview || !USER) && !$clansys_userviewingown)
	{
		$clansys_text .= "<div style='text-align: center; font-weight: bold'>".CS_REQ_2."</div>";

		$ns->tablerender(CS_REQ_1, $clansys_text);
		require_once(FOOTERF);
		exit();
	}

	$sql->db_Select("clansystem_join_request", "*", "join_request_id=$clansys_query_id");
	if(!$row = $sql->db_Fetch())
	{
		$clansys_text .= "<div style='text-align: center; font-weight: bold'>".CS_REQ_11."</div>";

		$ns->tablerender(CS_REQ_1, $clansys_text);
		require_once(FOOTERF);
		exit();
	}

	extract($row);

	$clansys_text .= "<div style='text-align: center'>";
	$clansys_text .= $csfrm->form_open("post", e_SELF."?".e_QUERY, "update");
	$clansys_text .= "<table class='fborder' style='width: 90%'>
						<tr>
							<td class='fcaption' colspan='2' style='text-align: center'>".CS_REQ_10."</td>
						</tr>
						<tr>
							<td class='forumheader3' style='width: 40%; vertical-align: top; text-align: right'>".CS_REQ_3.":</td>
							<td class='forumheader3' style='width: 60%; vertical-align: top'><a href='".SITEURL."user.php?id.$e107_user_id'>".ClanSys_GetUserName($e107_user_id)."</td>
						</tr>
						<tr>
							<td class='forumheader3' style='width: 40%; vertical-align: top; text-align: right'>".CS_REQ_7.":</td>
							<td class='forumheader3' style='width: 60%; vertical-align: top'>$join_request_date</td>
						</tr>";

	// If user has correct permissions, give them the ability to change the status
	if($clansys_usercandecide && !$clansys_userviewingown && $join_request_status!="Accepted")
	{
		$clansys_text .= "	<tr>
								<td class='forumheader3' style='width: 40%; vertical-align: top; text-align: right'>".CS_REQ_8.":</td>
								<td class='forumheader3' style='width: 60%; vertical-align: top'>";
		$clansys_text .= $csfrm->form_select_open("join_request_status");
		$clansys_text .= $csfrm->form_option("Accepted", ($join_request_status=="Accepted"), "Accepted");
		$clansys_text .= $csfrm->form_option("Queued", ($join_request_status=="Queued"), "Queued");
		$clansys_text .= $csfrm->form_option("Rejected", ($join_request_status=="Rejected"), "Rejected");
		$clansys_text .= $csfrm->form_select_close();
		$clansys_text .= "	</tr>";

	}
	else
	{
		$clansys_text .= "	<tr>
								<td class='forumheader3' style='width: 40%; vertical-align: top; text-align: right'>".CS_REQ_8.":</td>
								<td class='forumheader3' style='width: 60%; vertical-align: top'>$join_request_status</td>
							</tr>";
	}

	$clansys_text .= "	<tr>
							<td class='forumheader3' style='width: 40%; vertical-align: top; text-align: right'>".CS_REQ_9.":</td>
							<td class='forumheader3' style='width: 60%; vertical-align: top'>$join_request_status_date</td>
						</tr>
						<tr>
							<td class='forumheader3' style='width: 40%; vertical-align: top; text-align: right'>".CS_REQ_5.":</td>
							<td class='forumheader3' style='width: 60%; vertical-align: top'><a href='clansystem_roster.php?$join_request_referral_member_id'>".ClanSys_GetMemberName($join_request_referral_member_id)."</td>
						</tr>
						<tr>
							<td class='forumheader3' style='width: 40%; vertical-align: top; text-align: right'>".CS_REQ_12.":</td>
							<td class='forumheader3' style='width: 60%; vertical-align: top'>$join_request_reason</td>
						</tr>
						<tr>
							<td class='forumheader3' style='width: 40%; vertical-align: top; text-align: right'>".CS_REQ_13.":</td>
							<td class='forumheader3' style='width: 60%; vertical-align: top'>$join_request_bio</td>
						</tr>";

	// If user has correct permissions, give them the ability to Update the Application
	if($clansys_usercandecide && !$clansys_userviewingown && $join_request_status!="Accepted")
	{
		$clansys_text .= "	<tr>
								<td class='fcaption' colspan='2' style='text-align: center'>";
		$clansys_text .= $csfrm->form_button("submit", "update_app", CS_REQ_14);
		$clansys_text .= "		</td>
							</tr>";

	}
	else
	{
		$clansys_text .= "	<tr>
								<td class='fcaption' colspan='2' style='text-align: center'></td>
							</tr>";
	}

	$clansys_text .= "</table>";
	$clansys_text .= $csfrm->form_hidden("join_request_id", $join_request_id);
	$clansys_text .= $csfrm->form_hidden("e107_user_id", $e107_user_id);
	$clansys_text .= $csfrm->form_hidden("join_request_status_prev", $join_request_status);
	$clansys_text .= $csfrm->form_hidden("join_request_status_date_prev", $join_request_status_date);

	$clansys_text .= "<br />";
	$clansys_text .= "<table class='fborder' style='width: 90%'>
						<tr>
							<td class='fcaption' colspan='3' style='text-align: center'>".CS_REQ_17."</td>
						</tr>";

	$sql->db_Select("clansystem_join_request_comment", "*", "join_request_id=$join_request_id ORDER BY join_request_comment_date");
	while($row = $sql->db_Fetch())
	{
		extract($row);

		if($join_request_comment_public || !$clansys_userviewingown)
		{
			$clansys_text .= "	<tr>
									<td class='forumheader3' style='width: 20%; text-align: center; vertical-align: top'>$join_request_comment_date</td>
									<td class='forumheader3' style='width: 20%; text-align: center; vertical-align: top'><a href='clansystem_roster.php?$join_request_member_id'>".ClanSys_GetMemberName($join_request_member_id)."</td>
									<td class='forumheader3' style='width: 60%; text-align: left; vertical-align: top'>$join_request_comment_text</td>
								</tr>";
		}
	}

	if($join_request_status!="Accepted" && $clansys_usercancomment && !$clansys_userviewingown)
	{
		$clansys_text .= "	<tr>
								<td class='fcaption' colspan='3' style='text-align: center; vertical-align: top'>";
		$clansys_text .= $csfrm->form_textarea("join_request_comment_text", 100, 5, $clansys_comment_text) . "<br />";
		$clansys_text .= CS_REQ_21.$csfrm->form_radio("join_request_comment_public", 1, 1)."&nbsp;&nbsp;";
		$clansys_text .= CS_REQ_22.$csfrm->form_radio("join_request_comment_public", 0)."<br />";
		$clansys_text .= $csfrm->form_button("submit", "leave_comment", CS_REQ_20);
		$clansys_text .= "		</td>
							</tr>";
	}
	else
	{
		$clansys_text .= "	<tr>
								<td class='fcaption' colspan='3' style='text-align: center; vertical-align: top'></td>
							</tr>";
	}

	$clansys_text .= "</table>";
	$clansys_text .= $csfrm->form_close();
	$clansys_text .= "</div>";
}

// If no Query for Specific User, Then Display List
else
{
	if(!$clansys_usercanview || !USER)
	{
		$clansys_text .= "<div style='text-align: center; font-weight: bold'>".CS_REQ_2."</div>";

		$ns->tablerender(CS_REQ_1, $clansys_text);
		require_once(FOOTERF);
		exit();
	}

	$clansys_text .= "<div style='text-align: center'>";

	$clansys_app_count = $sql->db_Count("clansystem_join_request", "(*)", "WHERE join_request_status!='Accepted'");

	if($clansys_app_count > 0)
	{
		$clansys_text .= $csfrm->form_open("post", e_SELF, "update");
		$clansys_text .= "<table class='fborder' style='width: 90%'>
							<tr>
								<td class='fcaption'>".CS_REQ_3."</td>
								<td class='fcaption'>".CS_REQ_5."</td>
								<td class='fcaption'>".CS_REQ_6."</td>
								<td class='fcaption'>".CS_REQ_7."</td>
								<td class='fcaption'>".CS_REQ_8."</td>
								<td class='fcaption'>".CS_REQ_9."</td>
							</tr>";

		// Display all users with Queued or Rejected Applications
		$sql->db_Select("clansystem_join_request", "*", "join_request_status!='Accepted' ORDER BY join_request_status, join_request_date DESC");

		while($row = $sql->db_Fetch())
		{
			extract($row);

			$clansys_text .= "	<tr>
									<td class='forumheader3'><a href='".SITEURL."user.php?id.$e107_user_id'>".ClanSys_GetUserName($e107_user_id)."</td>
									<td class='forumheader3'><a href='".SITEURL."user.php?id.$join_request_referral_member_id'>".ClanSys_GetUserName($join_request_referral_member_id)."</td>
									<td class='forumheader3'><a href='clansystem_join_requests.php?$join_request_id'>".CS_REQ_6."</td>
									<td class='forumheader3'>$join_request_date</td>";
			$clansys_text .= "		<td class='forumheader3'>$join_request_status</td>
									<td class='forumheader3'>$join_request_status_date</td>
								</tr>";
		}

		$clansys_text .= "</table>";
		$clansys_text .= $csfrm->form_close();

	}
	else
	{
		$clansys_text .= "<b>".CS_REQ_4."</b>";
	}

	$clansys_text .= "</div>";
}

$ns->tablerender(CS_REQ_1, $clansys_text);
require_once(FOOTERF);
?>