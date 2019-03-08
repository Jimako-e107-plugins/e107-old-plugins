<?php
//***************************************************************
//*
//*		Title		:	Helpdesk Ticketing
//*
//*		Author		:	Barry Keal
//*
//*		Date		:	10 November 2003
//*
//*		Version		:	3.4
//*
//*		Description	: 	helpdesk ticketing system
//*
//*
//***************************************************************
//**************************************************************************
//*
//*  Helpdesk Ticketing configuration for e107 v711
//*
//**************************************************************************
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = 'Help Desk';
$eplug_version = '3.4';
$eplug_author = 'Father Barry';
$eplug_url = 'http://www.keal.me.uk';
$eplug_email = '';
$eplug_description = 'Helpdesk plugin allows users of your system to post help requests and track their progress.';
$eplug_compatible = 'e107v7+';
$eplug_readme = 'admin_readme.php';	// leave blank if no readme file
$eplug_compliant=true;
$eplug_latest = TRUE;
$eplug_status = TRUE;

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = 'helpdesk3_menu';

// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = '';

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = 'admin_config.php';

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder.'/images/hdu_32.png';
$eplug_icon_small = $eplug_folder.'/images/hdu_16.png';
$eplug_caption =  'Helpdesk 3.2';

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = '';

// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_sql = file_get_contents(e_PLUGIN . $eplug_folder."/helpdesk_sql.php");
preg_match_all("/CREATE TABLE (.*?)\(/i", $eplug_sql, $matches);
$eplug_table_names = $matches[1];
// create tables -----------------------------------------------------------------------------------------------
$eplug_tables = explode(';', str_replace('CREATE TABLE ', 'CREATE TABLE ' . MPREFIX, $eplug_sql));
for ($i = 0; $i < count($eplug_tables); $i++)
{
    $eplug_tables[$i] .= ';';
}
array_pop($eplug_tables); // Get rid of last (empty) entry

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = TRUE;
$eplug_link_name = 'Helpdesk';
$eplug_link_url = e_PLUGIN.'helpdesk3_menu/helpdesk.php';


// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = 'A link in your main navigation menu has been created to the main Help Desk screen.';

// upgrading ... //

$upgrade_add_prefs = '';
$upgrade_remove_prefs = '';
$upgrade_alter_tables = array(
'ALTER TABLE #hdunit ADD INDEX hdu_closed (hdu_closed);',
'ALTER TABLE #hdunit ADD INDEX hdu_allocated (hdu_allocated);',
'ALTER TABLE #hdunit ADD INDEX hdu_category (hdu_category);',
'ALTER TABLE #hdunit ADD INDEX hdu_resolution (hdu_resolution);',
'ALTER TABLE #hdunit ADD INDEX hdu_tech (hdu_tech);',
'ALTER TABLE #hdu_helpdesk ADD INDEX helpdesk_name (hdudesk_name);',
);

$eplug_upgrade_done = '';
if (!function_exists('helpdesk3_menu_uninstall'))
{
    function helpdesk3_menu_uninstall()
    {
        global $sql;
        $sql->db_Delete('core', ' e107_name="helpdesk" ');
    }
}
?>