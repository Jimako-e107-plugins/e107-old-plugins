<?php
// ***************************************************************
// *
// *		Revisions	:	19 November 2004 	Initial design
// *					:	24 December 2004 	Fixed a couple bugs and
// *											made xhtml compliant
// *                    :   25 September 2005   Version .7 compatible
// *					:	14 November 2005    Assorted fixes by foodisfunagain
// *					:	10 July 2006 		Fixed a couple of bugs and added default sort order and optional banner
// *
// ***************************************************************
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "recipe_menu/languages/admin/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "recipe_menu/languages/admin/" . e_LANGUAGE . ".php");
}
else
{
    include_once(e_PLUGIN . "recipe_menu/languages/admin/English.php");
}
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = "Recipe Menu";
$eplug_version = "2.10";
$eplug_author = "Barry";
$eplug_logo = "/images/recipe_32.gif";
$eplug_url = "http://keal.me.uk";
$eplug_email = "";
$eplug_description = RCPEMENU_A80;
$eplug_compatible = "e107 v7+";
$eplug_readme = "readme.pdf"; // leave blank if no readme file
$eplug_compliant = true;
$eplug_status = true;
$eplug_latest = true;
// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "recipe_menu";
// Name of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = RCPEMENU_A2;
// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";
// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder . "/images/recipe_32.gif";
$eplug_icon_small = $eplug_folder . "/images/recipe_16.gif";
$eplug_caption = RCPEMENU_A81;
// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
    "recipe_menu_menutitle" => "Recipe Menu",
    "recipe_menu_inmenu" => "5",
    "recipe_menu_perpage" => "5",
    "recipe_menu_readclass" => "0",
    "recipe_menu_recent" => "5",
    "recipe_menu_submitclass" => "0",
    "recipe_menu_adminclass" => "0",
    "recipe_menu_autoclass" => "0",
    "recipe_menu_email" => "1",
    "recipe_menu_print" => "5",
    "recipe_menu_credit" => "1",
    "recipe_menu_preptime" => "1",
    "recipe_menu_servings" => "1",
    "recipe_menu_nutrition" => "1",
    "recipe_menu_mailfrom" => "recipe",
    "recipe_menu_mailsubject" => "Here is a recipe somebody thought you would like",
    "recipe_menu_mailaddress" => "recipe@example.com",
    "recipe_menu_width" => "200",
    "recipe_menu_height" => "200",
    "recipe_topno" => 5,
    "recipe_menu_deforder" => 0,
    "recipe_rating" => 1,
    "recipe_comments" => 1,
    "recipe_round" => 2,
    "recipe_stats" => 0,
    );
// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array("recipemenu_recipes", "recipemenu_category"
    );
// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array("CREATE TABLE " . MPREFIX . "recipemenu_recipes (
  recipe_id int(10) unsigned NOT NULL auto_increment,
  recipe_name VARCHAR(50) NULL default '',
  recipe_author VARCHAR(100) NULL default '',
  recipe_servings VARCHAR(100) NULL default '',
  recipe_preptime VARCHAR(100) NULL default '',
  recipe_ingredients text NULL,
  recipe_body text NULL,
  recipe_source text NULL,
  recipe_nutrition text NULL,
  recipe_category int(10)unsigned NOT NULL default '0',
  recipe_approved int(10) unsigned NOT NULL default '0',
  recipe_posted int(10) unsigned NOT NULL default'0',
  recipe_picture varchar(200) NULL default '',
  recipe_views int(10)unsigned NOT NULL default '0',
  recipe_viewers text null,
  PRIMARY KEY  (recipe_id)
  ) TYPE=MyISAM;",

    "CREATE TABLE " . MPREFIX . "recipemenu_category (
  recipe_category_id int(10) NOT NULL auto_increment,
  recipe_category_name VARCHAR(50) default NULL,
  recipe_category_description VARCHAR(250) default NULL,
  recipe_category_updated int(10) unsigned default '0' NOT NULL,
  recipe_category_icon VARCHAR(50) default NULL,
  PRIMARY KEY  (recipe_category_id)
  ) TYPE=MyISAM;"
    );
// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = true;
$eplug_link_name = RCPEMENU_A82;
$eplug_link_url = e_PLUGIN . "recipe_menu/recipes.php";
// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = RCPEMENU_A83;
// upgrading ... //
$upgrade_add_prefs = "";

$upgrade_remove_prefs = "";

$upgrade_alter_tables = array("ALTER TABLE #recipemenu_recipes
  ADD COLUMN recipe_views int(10)unsigned NOT NULL default '0'",
    "ALTER TABLE #recipemenu_recipes
  ADD COLUMN recipe_viewers text null"
    );

$eplug_upgrade_done = "Check that the database is correct by doing a check database validity";
if (!function_exists("recipe_menu_uninstall"))
{
    function recipe_menu_uninstall()
    {
        global $sql;
        $sql->db_Delete("rate", " rate_table='recipe' ");
        $sql->db_Delete("comments", " comment_type='recipe' ");
    }
}

?>

