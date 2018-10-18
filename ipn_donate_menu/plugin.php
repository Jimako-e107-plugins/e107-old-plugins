<?php

  /*---------------------------------------------------------------------------------------------------------\
  |                                                                                                          |
  |	                                  IPN DONATE PLUGIN FOR e107                                             |
  |                                                                                                          |
  |	                         + Lolo Irie     ( http://www.etalkers.org   )                                   |
  |                          + Cameron       ( http://www.e107coders.org )                                   |
  |                          + Barry Keal    ( http://www.keal.me.uk     )                                   |
  |                          + Richard Perry ( http://www.greycube.com   )                                   |
  |                          + Klutsh        ( http://www.x-projects.org )                                   |
  |                                                                                                          |
  |	        Released under the terms and conditions of the GNU General Public License (http://gnu.org)       |
  |                                                                                                          |
  \---------------------------------------------------------------------------------------------------------*/

//LOAD LANGUAGE FILE FOR SETTING DEFAULTS -------------------------------------------------------------------+

  @include_once e_PLUGIN."ipn_donate_menu/languages/".e_LANGUAGE.".php";
  @include_once e_PLUGIN."ipn_donate_menu/languages/English.php";

//PLUGIN INFO------------------------------------------------------------------------------------------------+

  $eplug_name        = "PayPal Donate With IPN";
  $eplug_version     = "1.0";
  $eplug_author      = "Cameron, Barry, Richard, Klutsh";
  $eplug_url         = "http://www.e107coders.com";
  $eplug_email       = "";
  $eplug_description = "This Plugin adds a PayPal Donate Menu with IPN support";
  $eplug_compatible  = "e107v0.7+";
  $eplug_readme      = "";
  $eplug_compliant   = TRUE;
  $eplug_module      = FALSE;

//PLUGIN FOLDER----------------------------------------------------------------------------------------------+

  $eplug_folder      = "ipn_donate_menu";

//PLUGIN MENU FILE-------------------------------------------------------------------------------------------+

  $eplug_menu_name   = "ipn_donate_menu.php";

//PLUGIN ADMIN AREA FILE-------------------------------------------------------------------------------------+
 
  $eplug_conffile    = "admin_ipn_donate.php";

//PLUGIN ICONS AND CAPTION-----------------------------------------------------------------------------------+

  $eplug_logo        = "icon_large.png";
  $eplug_icon        = "$eplug_folder/icon_large.png";
  $eplug_icon_small  = "$eplug_folder/icon_small.png";
  $eplug_caption     = 'Configure PayPal Donate With IPN';  
  
//DEFAULT PREFERENCES----------------------------------------------------------------------------------------+

  $eplug_prefs = array(

  "ipn_pal_sand"          => "0",
  "ipn_pal_sand_email"    => "",
  "ipn_pal_menu_caption"  => LAN_IPN_PAL_MENUCAPTION_DEFAULT,
  "ipn_pal_text"          => "",
  "ipn_pal_button_image"  => "donate.gif",
  "ipn_pal_button_popup"  => LAN_IPN_PAL_BUTTON_POPUP_DEFAULT,
  "ipn_pal_business"      => "",
  "ipn_pal_item_name"     => "",
  "ipn_pal_currency_code" => "GBP",
  "ipn_pal_no_protection" => "",
  "ipn_pal_key_private"   => "abc123",
  "ipn_pal_Show_Total"	  => "1",
  "ipn_pal_Show_Total_Text" => LAN_IPN_PAL_TOTAL_TEXT_DEFAULT,
  "ipn_pal_Show_Login_Warn" => "1",
  "ipn_pal_Show_Login_Warn_Text" => LAN_IPN_PAL_LOGIN_WARN_DEFAULT,

  "ipn_pal_no_shipping"   => "1",
  "ipn_pal_no_note"       => "1",
  "ipn_pal_cn"            => "",
  "ipn_pal_ipn_notif"	  => "",
  "ipn_pal_ipn_file"	  => SITEURL."e107_plugins/$eplug_folder/ipn_donate_validate.php",
  "ipn_pal_return"        => SITEURL."e107_plugins/$eplug_folder/ipn_return_thanks.php",
  "ipn_pal_cancel_return" => SITEURL."e107_plugins/$eplug_folder/ipn_return_cancel.php",
  "ipn_pal_page_style"    => "",

  "ipn_pal_lc"            => "GB",
  "ipn_pal_item_number"   => "",
  "ipn_pal_custom"        => "0",
  "ipn_pal_invoice"       => "",
  "ipn_pal_amount"        => "1.00",
  "ipn_pal_tax"           => "" 

  );

//MYSQL TABLES TO BE CREATED---------------------------------------------------------------------------------+

  $eplug_table_names = array("ipn_info");

//MYSQL TABLE STRUCTURE--------------------------------------------------------------------------------------+

  $eplug_tables = array("
	CREATE TABLE ".MPREFIX."ipn_info (
		ipn_id int(11) unsigned NOT NULL auto_increment,
	  	item_name varchar(255) default NULL,
  		payment_status varchar(15) NOT NULL default '',
		mc_gross varchar(6) NOT NULL default '',
		txn_id varchar(30) NOT NULL default '',
		user_id varchar(100) NOT NULL default '',
		buyer_email varchar(100) NOT NULL default '',
		payment_date varchar(50) NOT NULL default '',
		PRIMARY KEY  (ipn_id)
		) TYPE=MyISAM;"
);
  
//LINK TO BE CREATED ON SITE MENU--------------------------------------------------------------------------+

  $eplug_link      = FALSE;
  $eplug_link_name = "$eplug_name";
  $eplug_link_url  = e_PLUGIN."$eplug_folder/";

//MESSAGE WHEN PLUGIN IS INSTALLED-------------------------------------------------------------------------+

  $eplug_done = "Plugin is now Installed.";

//SAME AS ABOVE BUT ONLY RUN WHEN CHOOSING UPGRADE---------------------------------------------------------+

  $upgrade_add_prefs = "";
  
//---------------------------------------------------------------------------------------------------------+

?>
