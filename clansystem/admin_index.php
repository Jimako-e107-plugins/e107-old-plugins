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

$pageid = "index";  // unique name that matches the one used in admin_menu.php.

if(!getperms("P")){ header("location:".e_BASE."index.php");}
require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."form_handler.php");

//Display Clan Information
function fn_display_clan_form($clan_id, $clan_name, $clan_tag, $clan_desc)
{
	$csfrm = new form;

	$clansys_text = "<div style='text-align: center'>";
	$clansys_text .= $csfrm->form_open("post", e_SELF, "update");
	$clansys_text .= $csfrm->form_hidden("clan_id", $clan_id);
	$clansys_text .= "<table class='fborder' style='width: 90%'>
						<tr>
							<td colspan='2' class='fcaption' style='text-align: center; vertical-align: top'>".CS_ADM_INFO_1."</td>
						</tr>
						<tr>
							<td class='forumheader3' style='width: 40%; vertical-align: top'>".CS_ADM_INFO_2.":</td>
							<td class='forumheader3' style='width: 60%; vertical-align: top'>".$csfrm->form_text("clan_name", 50, $clan_name, 50)."</td>
						</tr>
						<tr>
							<td class='forumheader3' style='width: 40%; vertical-align: top'>".CS_ADM_INFO_4.":</td>
							<td class='forumheader3' style='width: 60%; vertical-align: top'>".$csfrm->form_text("clan_tag", 30, $clan_tag, 50)."</td>
						</tr>
						<tr>
							<td class='forumheader3' style='width: 40%; vertical-align: top'>".CS_ADM_INFO_3.":</td>
							<td class='forumheader3' style='width: 60%; vertical-align: top'>".$csfrm->form_textarea("clan_description", 50, 10, $clan_desc)."</td>
						</tr>
						<tr>
							<td colspan='2' class='fcaption' style='text-align: center'>".$csfrm->form_button("submit", "update_info", CS_ADM_INFO_5)."</td>
						</tr>
					</table>";
	$clansys_text .= $csfrm->form_close();
	$clansys_text .= "</div>";

	return $clansys_text;
}

//Update Information
if(IsSet($_POST["update_info"]))
{
	extract($_POST);

	$err_msg = "";

	if(!$clan_name || strlen($clan_name) < 1)
	{
		$err_msg .= CS_ADM_INFO_6."<br>";
	}

	if(!$clan_tag || strlen($clan_tag) < 1)
	{
		$err_msg .= CS_ADM_INFO_8."<br>";
	}

	if(strlen($clan_tag) > 50)
	{
		$err_msg .= CS_ADM_INFO_7."<br>";
	}

	if($err_msg != "")
	{
		$clansys_text = "<div style='text-align: center'>";
		$clansys_text .= "<font style='color: red'><b>".$err_msg."</b></font>";
		$clansys_text .= "</div>";

		$clansys_text .= fn_display_clan_form($clan_id, $clan_name, $clan_tag, $clan_description);

		$ns->tablerender(CS_ADM_INFO_1, $clansys_text);
		require_once(e_ADMIN."footer.php");
		exit();
	}

	$clansys_text = "<div style='text-align: center'><b>";

	if(CS_SITECLAN_ID)
	{
		$clansys_result = $sql->db_Update("clansystem_clan", "clan_name='$clan_name', clan_tag='$clan_tag', clan_description='$clan_description' WHERE clan_id=".CS_SITECLAN_ID);
	}
	else
	{
		$clansys_result = $sql->db_Insert("clansystem_clan", "0, '$clan_name', '$clan_description', '', '', 1, '$clan_tag'");
	}

	if($clansys_result)
	{
		$clansys_text .= CS_ADM_INFO_9;
	}
	else
	{
		$clansys_text .= CS_ADM_INFO_10;
	}

	$clansys_text .= "</b></div>";

	$clansys_text .= fn_display_clan_form(CS_SITECLAN_ID, $clan_name, $clan_tag, $clan_description);

	$ns->tablerender(CS_ADM_INFO_1, $clansys_text);
	require_once(e_ADMIN."footer.php");
	exit();
}

$clansys_text = fn_display_clan_form(CS_SITECLAN_ID, CS_SITECLAN_NAME, CS_SITECLAN_TAG, CS_SITECLAN_DESC);

$ns->tablerender(CS_ADM_INFO_1, $clansys_text);
require_once(e_ADMIN."footer.php");

?>