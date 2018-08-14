<?php

  /*---------------------------------------------------------------------------------------------------------\
  |                                                                                                          |
  |	                                    DONATE PLUGIN FOR e107                                               |
  |                                                                                                          |
  |	                         + Lolo Irie     ( http://www.etalkers.org   )                                   |
  |                          + Cameron       ( http://www.e107coders.org )                                   |
  |                          + Barry Keal    ( http://www.keal.me.uk     )                                   |
  |                          + Richard Perry ( http://www.greycube.com   )                                   |
  |                                                                                                          |
  |	        Released under the terms and conditions of the GNU General Public License (http://gnu.org)       |
  |                                                                                                          |
  \---------------------------------------------------------------------------------------------------------*/

//LOAD LANGUAGE FILE FOR SETTING DEFAULTS -------------------------------------------------------------------+

  @include_once e_PLUGIN."donate_menu/languages/".e_LANGUAGE.".php";
  @include_once e_PLUGIN."donate_menu/languages/English.php";

//PLUGIN INFO------------------------------------------------------------------------------------------------+

  $eplug_name        = "PayPal Donate";
  $eplug_version     = "1.3";
  $eplug_author      = "Cameron, Barry, Richard";
  $eplug_url         = "http://www.e107coders.com";
  $eplug_email       = "";
  $eplug_description = "Plugin";
  $eplug_compatible  = "e107v7";
  $eplug_readme      = "readme.txt";
  $eplug_compliant   = TRUE;
  $eplug_module      = FALSE;

//PLUGIN FOLDER----------------------------------------------------------------------------------------------+

  $eplug_folder      = "donate_menu";

//PLUGIN MENU FILE-------------------------------------------------------------------------------------------+

  $eplug_menu_name   = "donate_menu.php";

//PLUGIN ADMIN AREA FILE-------------------------------------------------------------------------------------+
 
  $eplug_conffile    = "donate_admin.php";

//PLUGIN ICONS AND CAPTION-----------------------------------------------------------------------------------+

  $eplug_logo        = "icon_large.png";
  $eplug_icon        = "$eplug_folder/icon_large.png";
  $eplug_icon_small  = "$eplug_folder/icon_small.png";
  $eplug_caption     = 'Configure';  
  
//DEFAULT PREFERENCES----------------------------------------------------------------------------------------+

  $eplug_prefs = array(

  "pal_menu_caption"  => LAN_PAL_MENUCAPTION_DEFAULT,
  "pal_text"          => "",
  "pal_button_image"  => "donate.gif",
  "pal_button_popup"  => LAN_PAL_BUTTON_POPUP_DEFAULT,
  "pal_business"      => "",
  "pal_item_name"     => "",
  "pal_currency_code" => "USD",
  "pal_no_protection" => "",
  "pal_key_private"   => "abc123",

  "pal_no_shipping"   => "1",
  "pal_no_note"       => "",
  "pal_cn"            => "",
  "pal_return"        => "",
  "pal_cancel_return" => "",
  "pal_page_style"    => "",

  "pal_lc"            => "",
  "pal_item_number"   => "",
  "pal_custom"        => "",
  "pal_invoice"       => "",
  "pal_amount"        => "",
  "pal_tax"           => "" 

  );

//MYSQL TABLES TO BE CREATED---------------------------------------------------------------------------------+

  $eplug_table_names = "";

//MYSQL TABLE STRUCTURE--------------------------------------------------------------------------------------+

  $eplug_tables = "";
  
//LINK TO BE CREATED ON SITE MENU--------------------------------------------------------------------------+

  $eplug_link      = FALSE;
  $eplug_link_name = "$eplug_name";
  $eplug_link_url  = e_PLUGIN."$eplug_folder/";

//MESSAGE WHEN PLUGIN IS INSTALLED-------------------------------------------------------------------------+

  $eplug_done = "Plugin is now Installed.";

//SAME AS ABOVE BUT ONLY RUN WHEN CHOOSING UPGRADE---------------------------------------------------------+

  $upgrade_add_prefs = array(

  "pal_button_popup"  => LAN_PAL_BUTTON_POPUP_DEFAULT,
  "pal_no_protection" => "",
  "pal_key_private"   => "abc123"
  
  );
  
  $upgrade_remove_prefs = "";
  $upgrade_alter_tables = ""; 
  $eplug_upgrade_done   = "Plugin is now Upgraded.";
  
//---------------------------------------------------------------------------------------------------------+

?>
