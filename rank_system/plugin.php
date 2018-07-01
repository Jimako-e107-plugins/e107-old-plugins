<?php
/**
 * $Id: plugin.php,v 1.6 2010/01/29 23:39:58 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Revision: $Revision: 1.6 $
 * Last Modified: $Date: 2010/01/29 23:39:58 $
 *
 * Change Log:
 * $Log: plugin.php,v $
 * Revision 1.6  2010/01/29 23:39:58  michiel
 * RELEASE v1.5
 *
 * Revision 1.5  2009/10/22 21:56:11  michiel
 * Release v1.5
 *
 * Revision 1.4  2009/07/14 19:28:59  michiel
 * CVS Merge
 *
 * Revision 1.3.2.3  2009/07/14 16:42:14  michiel
 * Release v1.4
 *
 * Revision 1.3.2.2  2009/07/12 12:39:41  michiel
 * MERGE Maint1.3->Dev1.4
 *
 * Revision 1.3.4.2  2009/07/12 11:50:46  michiel
 * Release v1.3.1
 *
 * Revision 1.3.4.1  2009/06/30 20:10:19  michiel
 * Fixed weird apache/php (?) bug: white line after ?> mark (at end of file) could lead into not parsing the code
 *
 * Revision 1.3  2009/06/28 15:05:50  michiel
 * Merged from dev_01_03
 *
 * Revision 1.2.2.1  2009/06/28 13:16:35  michiel
 * Prepared for release 1.3
 *
 * Revision 1.2  2009/06/26 09:22:57  michiel
 * Merged from dev_01_01
 *
 * Revision 1.1.2.4  2009/06/19 13:47:18  michiel
 * Made XHTML compliant
 *
 * Revision 1.1.2.3  2009/06/12 15:12:51  michiel
 * RELEASE 1.2
 *
 * Revision 1.1.2.2  2009/05/20 18:40:57  michiel
 * Release Version 1.2
 *
 * Revision 1.1.2.1  2009/04/01 19:26:40  michiel
 * Medal goal automated using e_rank.php
 *
 * Revision 1.1  2009/03/28 13:01:45  michiel
 * Initial CVS revision
 *
 *  
 */
if (!defined('e107_INIT'))
{
    exit;
}

// ***************************************************************
// *
// *		Title		:	Rank System
// *
// *		Author		:	Michiel Horvers
// *
// *		Date		:	January 30th 2010
// *
// *		Version		:	1.5
// *
// *		Description	: 	Rank System
// *
// *		Revisions	:	16 December 2008 Initial release
// *						13 March 2009	Release 1.0
// *						28 March 2009	Medal Goal automated using e_rank.php
// *						12 June 2009	First official Public release (1.2)
// *						12 June 2009	Fixes and improvements (1.3)
// *						12 July 2009	Fixes and improvements (1.3.1)
// *						14 July 2009	Release v1.4
// *						22 October 2009	Beta Release v1.5
// *						30 January 2010	Release v1.5
// *
// *		Support at	:	http://www.mhcp-software.nl
// *						http://wiki.mhcp-software.nl
// *
// ***************************************************************
include_lan(e_PLUGIN . 'rank_system/languages/admin/' . e_LANGUAGE . '.php');
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = 'Rank System';
$eplug_version = '1.5';
$eplug_author = 'Michiel Horvers';
$eplug_url = 'http://www.mhcp-software.nl';
$eplug_email = 'michiel@mhcp-software.nl';
$eplug_description = ADLAN_RS_PM_02;
$eplug_compatible = 'e107v0.7.11+';
$eplug_readme = 'admin_readme.php';	// leave blank if no readme file
$eplug_compliant=true;


// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = 'rank_system';

// Name of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = 'Rank System';

// Name of the admin configuration file --------------------------------------------------------------------------
if (getPerms('0')) {
	$eplug_conffile = 'admin_config.php';
} else {
	$eplug_conffile = 'admin_curranks.php';
}

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder . '/images/ranks32.gif';
$eplug_icon_small = $eplug_folder . '/images/ranks16.gif';
$eplug_caption = ADLAN_RS_PM_01;

// prefs created in class

// create tables -----------------------------------------------------------------------------------------------
$eplug_sql = file_get_contents(e_PLUGIN . "{$eplug_folder}/rank_system_sql.php");
preg_match_all("/CREATE TABLE (.*?)\(/i", $eplug_sql, $matches);
$eplug_table_names = $matches[1];
// List of sql requests to create tables -----------------------------------------------------------------------------
// Apply create instructions for every table you defined in locator_sql.php --------------------------------------
// MPREFIX must be used because database prefix can be customized instead of default e107_
$eplug_tables = explode(';', str_replace('CREATE TABLE ', 'CREATE TABLE ' . MPREFIX, $eplug_sql));
for ($i = 0; $i < count($eplug_tables); $i++)
{
    $eplug_tables[$i] .= ';';
}
array_pop($eplug_tables); // Get rid of last (empty) entry


// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = TRUE;
$eplug_link_name = RANKS_LNK_01;
$eplug_link_url = e_PLUGIN.'rank_system/ranks.php';


// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = ADLAN_RS_PM_03;


// upgrading ... //

$upgrade_add_prefs = "";

$upgrade_remove_prefs = "";

$upgrade_alter_tables = "";

$eplug_upgrade_done = ADLAN_RS_PM_04;

if ($version = $pref['plug_installed']['rank_system']) {
	$rank_major = intval(substr($version, 0, strpos($version, ".")));
	$version = substr($version, strpos($version, ".")+1);
	if (strpos($version, ".")) {
		$rank_minor = intval(substr($version, 0, strpos($version, ".")));
		$rank_patch = substr($version, strpos($version, ".")+1);
	} else {
		$rank_minor = intval($version);
		$rank_patch = 0;
	}
} else {
	$rank_major = 0;
	$rank_minor = 0;
	$rank_patch = 0;
}

if ($pref['plug_installed']['rank_system'] == "1.2") {
    $upgrade_alter_tables = array (
        "ALTER TABLE " . MPREFIX . "rank_medals ADD medal_img2 varchar(50) NOT NULL AFTER medal_img;",
    	"UPDATE " . MPREFIX . "rank_medals set medal_img2 = medal_img;"
    );
}
if ($rank_major == 1 && $rank_minor < 4) {
    $upgrade_alter_tables = array (
        "ALTER TABLE " . MPREFIX . "rank_medals ADD medal_reward int(10) unsigned NOT NULL default '0' AFTER medal_bonus;",
    	"ALTER TABLE " . MPREFIX . "rank_users CHANGE user_rankid user_rankid int(5) unsigned NOT NULL default '0';",
    	"DELETE FROM " . MPREFIX . "rank_medal_users where med_user_medal not in (select medal_id from " . MPREFIX . "rank_medals);"
    );
}
if ($rank_major == 1 && $rank_minor < 5) {
    $upgrade_alter_tables = array (
    	"ALTER TABLE " . MPREFIX . "rank_medal_goal ADD med_goal_type varchar(10) NOT NULL default 'int' AFTER med_goal_target;",
    	"ALTER TABLE " . MPREFIX . "rank_ranks CHANGE rank_order rank_order int(5) unsigned NOT NULL;",
    	"ALTER TABLE " . MPREFIX . "rank_medals CHANGE medal_order medal_order int(5) unsigned NOT NULL;"
    );
}


// Deleting plugin ...//
if (!function_exists('rank_system_uninstall'))
{
    function rank_system_uninstall()
    {
        // get rid of the things we created
        global $sql;
        $sql->db_Delete('core', ' e107_name="ranks" ');
    }
}

// Upgrade plugin ...//
if (!function_exists('rank_system_upgrade'))
{
    function rank_system_upgrade() {
    	global $rank_major, $rank_minor, $rank_patch, $sql;
    	
    	if ($rank_major == 1 && $rank_minor < 5) {
    		/*
    		 * Convert old conditions system (fixed skill, teamplay, involvement, etc)
    		 * to new one.
    		 */
    		
    		//Create new table
    		$query = "
				CREATE TABLE " . MPREFIX . "rank_condition (
				  condit_id int(10) unsigned NOT NULL auto_increment,
				  condit_order int(5) unsigned NOT NULL,
				  condit_name varchar(50) NOT NULL,
				  condit_negative char(1) NOT NULL DEFAULT 'F',
				  condit_hastext char(1) NOT NULL DEFAULT 'F',
				  condit_maxval int(5) unsigned NOT NULL DEFAULT '0',
				  condit_factor varchar(50) NOT NULL default '',
				  condit_onbar varchar(255) NOT NULL,
				  condit_offbar varchar(255) NOT NULL,
				  condit_trigger varchar(100) NOT NULL,
				  condit_enabled char(1) NOT NULL DEFAULT 'F',
				  condit_descript text NOT NULL DEFAULT '',
				  PRIMARY KEY (condit_id),
				  UNIQUE KEY condit_order (condit_order),
				  KEY trigger_id (condit_trigger),
				  KEY enabled (condit_enabled)
  				) TYPE=MyISAM;
    		";
    		if (!$sql->db_Query($query)) {
    			//ABORT!!
    			echo "Unable to execute upgrade!<br>";
    			echo "Since this version's upgrade process is vital for maintaining the existing settings, the upgrade process has been killed!<br>";
    			exit;
    		}
    		
    		//creation successfull, proceed...
    		
    		//insert 'old' conditions
    		$sql->db_Insert("rank_condition", "1, 1, 'Skill', 'F', 'F', 40, '', 'skill_on.gif', 'skill_off.gif', 'trigger_manual', 'T', ''");
    		$sql->db_Insert("rank_condition", "2, 2, 'Teamplay', 'F', 'F', 40, '', 'teamplay_on.gif', 'teamplay_off.gif', 'trigger_manual', 'T', ''");
    		$sql->db_Insert("rank_condition", "3, 3, 'Involvement', 'F', 'F', 20, '', 'involvement_on.gif', 'involvement_off.gif', 'trigger_manual', 'T', ''");
    		$sql->db_Insert("rank_condition", "4, 4, 'Involvement (site)', 'F', 'F', 20, '', 'involvement_on.gif', 'involvement_off.gif', 'trigger_siteinv', 'T', ''");
    		$sql->db_Insert("rank_condition", "5, 5, 'Penalty (site)', 'T', 'F', 80, '', 'involvement_on.gif', 'involvement_off.gif', 'trigger_sitepen', 'T', ''");
    		$sql->db_Insert("rank_condition", "6, 6, 'Behaviour', 'T', 'T', 100, '', 'behave_on.gif', 'behave_off.gif', 'trigger_manual', 'T', ''");
    		
    		//create new user fields without dropping the old ones
    		$query = "ALTER TABLE " . MPREFIX . "rank_users ADD user_values text NOT NULL default '' AFTER user_rankid;";
    		if (!$sql->db_Query($query)) {
    			//ABORT!!
    			echo "Unable to execute upgrade!<br>";
    			echo "Since this version's upgrade process is vital for maintaining the existing settings, the upgrade process has been killed!<br>";
    			exit;
    		}
    		$query = "ALTER TABLE " . MPREFIX . "rank_users ADD rank_points int(10) NOT NULL default '0' AFTER user_values;";
    		if (!$sql->db_Query($query)) {
    			//ABORT!!
    			echo "Unable to execute upgrade!<br>";
    			echo "Since this version's upgrade process is vital for maintaining the existing settings, the upgrade process has been killed!<br>";
    			exit;
    		}
    		
    		
    		//convert all users
    		$sql->db_Select("rank_users", "user_userid, rank_skill, rank_teamplay, rank_involved, rank_site, rank_penalty, rank_behave, behave_comment");
    		$usrlist = $sql->db_getList();
    		foreach ($usrlist as $usr) {
    			extract($usr);
    			$values['1_value'] = $rank_skill;
    			$values['2_value'] = $rank_teamplay;
    			$values['3_value'] = $rank_involved;
    			$values['4_value'] = $rank_site;
    			$values['5_value'] = $rank_penalty;
    			$values['6_value'] = $rank_behave;
    			$values['6_text'] = $behave_comment;
    			
    			$points = $rank_skill + $rank_teamplay + $rank_involved + $rank_site - $rank_penalty - $rank_behave;
    			
    			$serVal = serialize($values);
    			$sql->db_update("rank_users", "user_values = '$serVal', rank_points = $points where user_userid = $user_userid");
    		}
    		
    		//drop old values
    		$sql->db_Query("ALTER TABLE " . MPREFIX . "rank_users DROP rank_skill;");
    		$sql->db_Query("ALTER TABLE " . MPREFIX . "rank_users DROP rank_teamplay;");
    		$sql->db_Query("ALTER TABLE " . MPREFIX . "rank_users DROP rank_involved;");
    		$sql->db_Query("ALTER TABLE " . MPREFIX . "rank_users DROP rank_site;");
    		$sql->db_Query("ALTER TABLE " . MPREFIX . "rank_users DROP rank_penalty;");
    		$sql->db_Query("ALTER TABLE " . MPREFIX . "rank_users DROP rank_behave;");
    		$sql->db_Query("ALTER TABLE " . MPREFIX . "rank_users DROP behave_comment;");
    	}
    }
}


?>