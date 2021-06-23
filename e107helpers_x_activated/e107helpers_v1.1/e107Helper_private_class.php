<?php
/**
 * e107 Helper Private class
 * <b>CVS Details:</b>
 * <ul>
 * <li>$Source: e:\_repository\e107_plugins/e107helpers/e107Helper_private_class.php,v $</li>
 * <li>$Date: 2006/08/29 22:56:37 $</li>
 * </ul>
 * @author     $Author: Neil $
 * @version    $Revision: 1.2 $
 * @copyright  Released under the terms and conditions of the GNU General Public License (http://gnu.org).
 * @package e107HelperAdmin
 * @access private
 */

   /**
    * A Private Helper class for the e107 CMS system.
    * For use by the e107Helper classes only, should not be called directly by other plugin code
    * @package e107HelperAdmin
    * @access private
    */
   class e107HelperPrivate {
      function e107HelperPrivate () {
      }

      function getAdminHelp() {
         global $pageid;

         $ns = new e107table();
   	   $helptitle = HELPER_LAN_ADMIN_HELP_TITLE;
         $ns->tablerender($helptitle, $pageid.HELPER_LAN_ADMIN_HELP_TEXT);
      }

      function getAdminMenu() {
         global $pageid;

   	   $menutitle  = HELPER_LAN_ADMIN_MENU_TITLE;

         $i = 0;
         while (defined("HELPER_LAN_ADMIN_PAGE_".$i."_NAME")) {
            $var[constant("HELPER_LAN_ADMIN_PAGE_".$i."_ID")]['text'] = constant("HELPER_LAN_ADMIN_PAGE_".$i."_NAME");
   	   	$var[constant("HELPER_LAN_ADMIN_PAGE_".$i."_ID")]['link'] = constant("HELPER_LAN_ADMIN_PAGE_".$i."_LINK");
   	   	$i++;
   	   }

         show_admin_menu($menutitle, $pageid, $var);
      }
   }

   // Declare a single global instance of the plugin class
   $GLOBALS["e107HelperPrivate"] = new e107HelperPrivate();

?>