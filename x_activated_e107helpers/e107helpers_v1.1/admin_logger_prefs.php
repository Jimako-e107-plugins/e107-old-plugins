<?php
/**
 * e107plugin_template by bugrain (www.bugrain.plus.com)
 *
 * A plugin for the e107 Website System (http://e107.org)
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * $Source: E:/cvs/cvsrepo/e107helpers/admin_logger_prefs.php,v $
 * $Revision: 1.3 $
 * $Date: 2006/03/07 23:30:42 $
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
      header("location:".e_BASE."index.php");
      exit;
   }

   // Include auth.php rather than header.php ensures an admin user is logged in
   require_once(e_ADMIN."auth.php");

   // Include the class file for this plugin, includes all other required includes
   require(e_PLUGIN."e107helpers/e107Helper.php");

   require_once(e_ADMIN."header.php");

   $title   = HELPER_LAN_01." - ".HELPER_LAN_ADMIN_PAGE_1_NAME;
   $pageid  = HELPER_LAN_ADMIN_PAGE_1_ID;

   // Create and process a form using the helper classes
   $e107HelperForm->createFormFromXML("forms/logger_prefs");
   $e107HelperForm->processForm(true, true);
   $text .= $e107HelperForm->getFormHTML();

   $ns->tablerender($title, $text);

   require_once(e_ADMIN."footer.php");

?>