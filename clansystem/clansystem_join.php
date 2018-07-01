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

//Check if user is logged in
if(!USER)
{
	$clansys_text = "<div style='text-align: center'>";
	$clansys_text .= CS_JOIN_3;
	$clansys_text .= "</div>";

	$ns->tablerender(CS_JOIN_1, $clansys_text);
	require_once(FOOTERF);
	exit();
}

//Check if user has already submitted an application
$sql->db_Select("clansystem_join_request", "*", "e107_user_id=".USERID." ORDER BY join_request_date DESC LIMIT 0,1");

if($row = $sql->db_Fetch())
{
	extract($row);

	$clansys_text = "<div style='text-align: center'>";
	$clansys_text .= CS_JOIN_2. "<a href='clansystem_join_requests.php?$join_request_id'>$join_request_status";
	$clansys_text .= "</div>";

	$ns->tablerender(CS_JOIN_1, $clansys_text);
	require_once(FOOTERF);
	exit();
}

//Display clan application
function fn_create_application($join_reason="", $join_bio="", $join_referral_id=0)
{
	$sql = new db;
	$csfrm = new form;

	$clansys_text = "<div style='text-align: center'>";
	$clansys_text .= $csfrm->form_open("post", e_SELF, "newapp");
	$clansys_text .= "<table class='fborder' style='width: 90%'>
						<tr>
							<td colspan='2' class='fcaption' style='text-align: center'>".CS_JOIN_4."</td>
						</tr>
						<tr>
							<td class='forumheader3' style='width: 40%; vertical-align: top; text-align: right'>".CS_JOIN_13.":</td>
							<td class='forumheader3' style='width: 60%; vertical-align: top'>";
	$clansys_text .= $csfrm->form_select_open("join_request_referral_member_id");

	$sql->db_Select_gen("SELECT DISTINCT * FROM ".MPREFIX."clansystem_member, ".MPREFIX."user WHERE e107_user_id=user_id ORDER BY user_name");
//	$sql->db_Select("clansystem_member, ".MPREFIX."user", "*", "e107_user_id=user_id ORDER BY user_name");

	$clansys_selected = $join_referral_id ? false : true;
	$clansys_text .= $csfrm->form_option("N/A", $clansys_selected, 0);

	while($row = $sql->db_Fetch())
	{
		extract($row);

		$clansys_selected = ($e107_user_id==$join_referral_id) ? true : false;
		$clansys_text .= $csfrm->form_option($user_name, $clansys_selected, $member_id);
	}

	$clansys_text .= $csfrm->form_select_close();
	$clansys_text .= "		</td>
						</tr>
						<tr>
							<td class='forumheader3' style='width: 40%; vertical-align: top; text-align: right'>".CS_JOIN_5.":</td>
							<td class='forumheader3' style='width: 60%; vertical-align: top'>".$csfrm->form_text("join_reason", 50, $join_reason, 254)."</td>
						</tr>
						<tr>
							<td class='forumheader3' style='width: 40%; vertical-align: top; text-align: right'>".CS_JOIN_6.":</td>
							<td class='forumheader3' style='width: 60%; vertical-align: top'>".$csfrm->form_textarea("join_bio", 50, 10, $join_bio)."</td>
						</tr>
						<tr>
							<td class='fcaption' colspan='2' style='text-align: center'>".$csfrm->form_button("submit", "process_app", CS_JOIN_7)."</td>
						</tr>
					</table>";
	$clansys_text .= $csfrm->form_close();
	$clansys_text .= "</div>";

	return $clansys_text;
}

//Process Application if Submitted
if(IsSet($_POST["process_app"]))
{
	extract($_POST);

	$join_request_referral_member_id = $join_request_referral_member_id ? $join_request_referral_member_id : 0;

	$err_msg = "";

	if(!$join_reason || strlen($join_reason) < 1)
	{
		$err_msg .= CS_JOIN_10."<br>";
	}

	if(strlen($join_reason) > 254)
	{
		$err_msg .= CS_JOIN_12."<br>";
	}

	if(!$join_bio || strlen($join_bio) < 1)
	{
		$err_msg .= CS_JOIN_11."<br>";
	}

	if($err_msg != "")
	{
		$clansys_text = "<div style='text-align: center; color: red; font-weight: bold'>$err_msg</div>";

		$clansys_text .= fn_create_application($join_reason, $join_bio, $join_request_referral_member_id);

		$ns->tablerender(CS_JOIN_1, $clansys_text);
		require_once(FOOTERF);
		exit();
	}

	$clansys_text = "<br>";
	$clansys_text .= "<div style='text-align: center; font-weight: bold'>";

	if($sql->db_Insert("clansystem_join_request", "0, ".USERID.", $join_request_referral_member_id, '$join_reason', '$join_bio', '".date("Y-m-d")."', 'Queued', '".date("Y-m-d")."'"))
	{
		$clansys_text .= CS_JOIN_8;
	}
	else
	{
		$clansys_text .= CS_JOIN_9;
	}

	$clansys_text .= "</div>";

	$ns->tablerender(CS_JOIN_1, $clansys_text);
	require_once(FOOTERF);
	exit();
}

$clansys_text = fn_create_application();

$ns->tablerender(CS_JOIN_1, $clansys_text);
require_once(FOOTERF);
?>