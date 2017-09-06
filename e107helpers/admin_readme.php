<?php
/**
 * e107plugin_template by bugrain (www.bugrain.plus.com)
 *
 * A plugin for the e107 Website System (http://e107.org)
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * $Source: e:\_repository\e107_plugins/e107helpers/admin_readme.php,v $
 * $Revision: 1.3 $
 * $Date: 2007/08/01 23:36:32 $
 * $Author: Neil $
 * @package e107HelperAdmin
 * @access private
 */

   /**
    * @package e107HelperAdmin
    * @access private
    */
   // class2.php is the heart of e107, always include it first to give access to e107 constants and variables
   require_once("../../class2.php");

   // Check to see if the current user has admin permissions for this plugin
   if (!getperms("P")) {
      // No permissions set, redirect to site front page
      //headerx("location:".e_BASE."index.php");
      e107::redirect();
      exit;
   }

   // Include auth.php rather than header.php ensures an admin user is logged in
   require_once(e_ADMIN."auth.php");

   // Include the class file for this plugin, includes all other required includes
   require(e_PLUGIN."e107helpers/e107Helper.php");

   require_once(e_ADMIN."header.php");

   $title   = HELPER_LAN_01." - ".HELPER_LAN_ADMIN_PAGE_0_NAME;
   $pageid  = HELPER_LAN_ADMIN_PAGE_0_ID;

   $text  = "<div style='padding:5px;'>
      ".HELPER_LAN_01." v".HELPER_VER." by bugrain (agenda@bugrain.plus.com)<br>
      <br>
      A plugin for the e107 Website System (http://e107.org)<br>
      <br>
      Released under the terms and conditions of the<br>
      GNU General Public License (http://gnu.org).<br>
      <hr>
      <p>The e107 Plugin Project is a collection of PHP include files and JavaScript aimed at making plugin writing easier.
      Use normal e107 plugin installtion procedures to install.</p>
      <p><a href='http://wiki.e107.org/?title=E107_Helper_Project' target='_blank'>".HELPER_LAN_08."</a></p>
      </div>";

   $ns->tablerender($title, $text);

   require_once(e_ADMIN."footer.php");
?>