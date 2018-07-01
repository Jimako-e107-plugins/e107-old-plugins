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

require_once("../../class2.php");

$clansys_lan_file = e_PLUGIN. "clansystem/languages/".e_LANGUAGE.".php";
include(file_exists($clansys_lan_file) ? $clansys_lan_file : e_PLUGIN. "clansystem/languages/English.php");

//------------------------------------------------------------------------------
// Define ClanSystem Globals
//------------------------------------------------------------------------------
define(CS_DEF_PLUGDIR, e_PLUGIN. "clansystem/");
define(CS_DEF_LANFILE, $clansys_lan_file);

// Synchronize Roles and Userclass Tables
ClanSys_SyncRoles();
// Set Globals for Site Clan Info
ClanSys_GetSiteClanInfo();

//------------------------------------------------------------------------------
// Determine if Logged in user has requested ClanSystem permission
//------------------------------------------------------------------------------
function ClanSys_UserHasPerm($clansys_req_perm)
{
	$sql = new db;

	$clansys_userclass = explode(",", USERCLASS);
	$clansys_hasperm = false;

	$sql->db_Select("clansystem_role", "*", "$clansys_req_perm=1", true);

	while($row = $sql->db_Fetch())
	{
		if(in_array($row['e107_userclass_id'], $clansys_userclass))
		{
			$clansys_hasperm = true;
		}
	}

	if(ADMIN)
	{
		$clansys_hasperm = true;
	}

	return $clansys_hasperm;
}

//------------------------------------------------------------------------------
// Syncronize e107's UserClasses with ClanSystem's Roles
//------------------------------------------------------------------------------
function ClanSys_SyncRoles()
{
	$sql_userclass = new db;
	$sql_role = new db;
	$sql_action = new db;

	$sql_userclass->db_Select("userclass_classes","userclass_id");

	// Add UserClasses to Roles that don't exist
	while($clansys_userclass = $sql_userclass->db_Fetch())
	{
		$clansys_userclass_id = $clansys_userclass['userclass_id'];

		$sql_role->db_Select("clansystem_role", "*", "e107_userclass_id=$clansys_userclass_id");

		if(!$sql_role->db_Fetch())
		{
			$sql_action->db_Insert("clansystem_role", array("e107_userclass_id" => $clansys_userclass_id));
		}
	}

	// Delete Roles that are linked to inexistant UserClasses
	$sql_role->db_Select("clansystem_role", "role_id, e107_userclass_id");

	while($clansys_role = $sql_role->db_Fetch())
	{
		$clansys_role_id = $clansys_role['role_id'];
		$clansys_userclass_id = $clansys_role['e107_userclass_id'];

		$sql_userclass->db_Select("userclass_classes", "userclass_id", "userclass_id=$clansys_userclass_id");

		if(!$sql_userclass->db_Fetch())
		{
			$sql_action->db_Delete("clansystem_role", "role_id=$clansys_role_id");
		}
	}
}

//------------------------------------------------------------------------------
// Sets Globals for Clan who owns the site
//------------------------------------------------------------------------------
function ClanSys_GetSiteClanInfo()
{
	$sql = new db;

	$sql->db_Select("clansystem_clan","*", "clan_site_owner=1");
	$row = $sql->db_Fetch();

	define(CS_SITECLAN_ID, $row['clan_id']);
	define(CS_SITECLAN_NAME, $row['clan_name']);
	define(CS_SITECLAN_DESC, $row['clan_description']);
	define(CS_SITECLAN_IMAGE, $row['clan_image']);
	define(CS_SITECLAN_URL, $row['clan_url']);
	define(CS_SITECLAN_TAG, $row['clan_tag']);
}

//------------------------------------------------------------------------------
// Function to return the e107 User's Name
//------------------------------------------------------------------------------
function ClanSys_GetUserName($e107_user_id)
{
	$sql = new db;

	$sql->db_Select("user", "*", "user_id=$e107_user_id");
	$row = $sql->db_Fetch();

	extract($row);

	return $user_name;
}

//------------------------------------------------------------------------------
// Function to return the e107 User's Name from the Member's ID
//------------------------------------------------------------------------------
function ClanSys_GetMemberName($member_id)
{
	$sql = new db;
	$sql2 = new db;

	$sql->db_Select("clansystem_member", "*", "member_id=$member_id");
	$row = $sql->db_Fetch();

	extract($row);

	$sql2->db_Select("user", "*", "user_id=$e107_user_id");
	$row2 = $sql2->db_Fetch();

	extract($row2);

	return $user_name;
}

//------------------------------------------------------------------------------
// Return the Clan Member ID using the e107 User ID
//------------------------------------------------------------------------------
function ClanSys_GetMemberId($e107_user_id=USERID)
{
	$sql = new db;

	$sql->db_Select("clansystem_member", "*", "e107_user_id=$e107_user_id");
	$row = $sql->db_Fetch();

	extract($row);

	return $member_id;
}

//------------------------------------------------------------------------------
// Return the e107 User ID using the ClanSys Member ID
//------------------------------------------------------------------------------
function ClanSys_GetUserId($clansys_member_id)
{
	$sql = new db;

	$sql->db_Select("clansystem_member", "*", "member_id=$clansys_member_id");
	$row = $sql->db_Fetch();

	extract($row);

	return $e107_user_id;
}

//------------------------------------------------------------------------------
// Determine if User is Clan Member
//------------------------------------------------------------------------------
function ClanSys_IsClanMember($clansys_user_id=USERID)
{
	$sql = new db;

	$sql->db_Select("clansystem_member", "*", "e107_user_id=$clansys_user_id");

	if($sql->db_Fetch())
	{
		return true;
	}
	else
	{
		return false;
	}
}
?>