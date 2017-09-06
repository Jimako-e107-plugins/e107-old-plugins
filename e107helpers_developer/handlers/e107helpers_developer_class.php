<?php
/*
+---------------------------------------------------------------+
| Election by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/e107helpers_developer/handlers/e107helpers_developer_class.php,v $
| $Revision: 1.1 $
| $Date: 2007/01/10 23:59:07 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Include e107helpers_developer handlers
require_once(e_PLUGIN."e107helpers_developer/handlers/e107helpers_developer_constants.php");

// Data Access Objects
require_once(EHDC_HANDLERS_DIR."e107helpers_developer_DAO.php");

// Model objects
require_once(EHDC_HANDLERS_DIR."e107helpers_developer_model.php");

// Warning and error handling
require_once(EHDC_HANDLERS_DIR."e107helpers_developer_status_info.php");

// Include the e107 Helper classes
if (file_exists(e_PLUGIN."e107helpers/e107Helper.php")) {
   $e107HelperIncludeJS = false;
   $incDHTMLCalendarJS = true;
   require_once(e_PLUGIN."e107helpers/e107Helper.php");
} else {
   print "<h1>Fatal error, cannot find e107Helper class.</h1>";
   print "<p>This plugin requires <b>The e107 Helper Project</b> plugin to be installed.</p>";
   print "<p>Please download it from <a href='http://e107coders.org'>http://e107coders.org</a> and try this plugin again.</p>";
   exit;
}

// Load the shortcodes file - template will be loaded when we know which template to load
require_once(EHDC_PLUGIN_DIR."e107helpers_developer_shortcodes.php");

/**
 * Class used to control all page generation and workflow aspects of e107helpers_developer
 */
class e107helpers_developer {
   // URL parameters (array)
   var $url;
   // Main data Access Object
   var $dao;

   /**
    * Constructor
    */
   function e107helpers_developer() {
   }

   /**
    * Get a reference to the DAO object
    */
   function getDAO() {
      if (!isset($this->dao)) {
         $this->dao = new e107helpers_developerDAO();
      }
      return $this->dao;
   }

   // *********************************************************************************************
   // Main pages
   // *********************************************************************************************

   /**
    * Get the main page
    */
   function getMainPage() {
      $page = e_QUERY ? e_QUERY : "10";
      $func = "getPage".$page;

      $text = "";
      for ($i=1; $i<100; $i=$i+1) {
         if (constant("EHD_LAN_PAGE_{$page}_P{$i}")) {
            $text .= "<p>".constant("EHD_LAN_PAGE_{$page}_P{$i}")."</p>";
         }
      }

      $text .= $this->$func();

      if ($page != 10) {
         $text .= "<p><a href='".e_SELF."'>".EHD_LAN_BACK_TO_MAIN."</a></p>";
      }
      return array(EHD_LAN_E107HELPER_DEVELOPER." - ".constant("EHD_LAN_PAGE_".$page), $text);
   }

   /**
    * Introduction page
    */
   function getPage10() {
      $text = "";

      $text .= "<ul>";
      for ($i=20; $i<100; $i++) {
         if (constant("EHD_LAN_PAGE_{$i}")) {
            $text .= "<li><a href='".e_SELF."?$i'>".constant("EHD_LAN_PAGE_{$i}")."</a></li>";
         }
      }
      $text .= "</ul>";
      // ************************************************************************************************************************
      $text .= "<hr/>";
      return $text;
   }

   /**
    * Ajax page
    */
   function getPage20() {
      $text = "";

      $text .= "<h3>".EHD_LAN_PAGE_20_H1."</h3>";
      $text .= "<p>".EHD_LAN_PAGE_20_H1_1."</p>";
      $text .= "<p>".EHD_LAN_PAGE_20_H1_2."</p>";

      // ************************************************************************************************************************
      // Populate page from Ajax request
      // ************************************************************************************************************************

      $text .= "<hr/>";
      $text .= "<h3>".EHD_LAN_PAGE_20_H2."</h3>";
      $text .= "<p>".EHD_LAN_PAGE_20_H2_1."</p>";
      $text .= "<div class='forumheader3' style='width:50%;float:right;' id='e107helpers_developer_class_div1'>&nbsp;</div>";
      $text .= "<input class='button' type='button' onclick='e107helpers_developerHelper.getTime(\"e107helpers_developer_class_div1\");' value='".EHD_LAN_PAGE_20_H2_2."'/>";

      // ************************************************************************************************************************
      // JavaScript alert
      // ************************************************************************************************************************

      $text .= "<hr/>";
      $text .= "<h3>".EHD_LAN_PAGE_20_H3."</h3>";
      $text .= "<p>".EHD_LAN_PAGE_20_H3_1."</p>";
      $text .= "<input class='button' type='button' onclick='e107helpers_developerHelper.getAlert();' value='".EHD_LAN_PAGE_20_H3_2."'/>";

      // ************************************************************************************************************************
      // Popup message
      // ************************************************************************************************************************

      $text .= "<hr/>";
      $text .= "<h3>".EHD_LAN_PAGE_20_H4."</h3>";
      $text .= "<p>".EHD_LAN_PAGE_20_H4_1."</p>";
      $text .= "<div class='forumheader3' style='width:50%;float:right;' id='e107helpers_developer_class_div2'>&nbsp;</div>";
      $text .= "<input class='button' type='button' onclick='e107helpers_developerHelper.getPopup(\"e107helpers_developer_class_div2\");' value='".EHD_LAN_PAGE_20_H4_2."'/>";

      // ************************************************************************************************************************
      $text .= "<hr/>";
      return $text;
   }

   /**
    * Comments page
    */
   function getPage30() {
      global $e107Helper;
      $text = "";

      $text .= "<h3>".EHD_LAN_PAGE_30_H1."</h3>";
      $text .= "<p>".EHD_LAN_PAGE_30_H1_1."</p>";

      // ************************************************************************************************************************
      // Comments
      // ************************************************************************************************************************
      $text .= "<hr/>";
      $text .= "<h3>".EHD_LAN_PAGE_30_H2."</h3>";
      $text .= "<p>".EHD_LAN_PAGE_30_H2_1."</p>";
      $text .= $e107Helper->getComment("ehddevelop", 1);

      // ************************************************************************************************************************
      // Comment total
      // ************************************************************************************************************************
      $text .= "<hr/>";
      $text .= "<h3>".EHD_LAN_PAGE_30_H5."</h3>";
      $text .= "<p>".EHD_LAN_PAGE_30_H5_1."</p>";
      $text .= $e107Helper->getCommentTotal("ehddevelop", 1);

      // ************************************************************************************************************************
      $text .= "<hr/>";
      return $text;
   }

   /**
    * Ratings page
    */
   function getPage35() {
      global $e107Helper;
      $text = "";

      $text .= "<h3>".EHD_LAN_PAGE_30_H1."</h3>";
      $text .= "<p>".EHD_LAN_PAGE_30_H1_1."</p>";

      // ************************************************************************************************************************
      // Ratings with text
      // ************************************************************************************************************************
      $text .= "<hr/>";
      $text .= "<h3>".EHD_LAN_PAGE_30_H3."</h3>";
      $text .= "<p>".EHD_LAN_PAGE_30_H3_1."</p>";
      $text .= $e107Helper->getRating("ehddevelop", 1);

      // ************************************************************************************************************************
      // Ratings, graphics display only
      // ************************************************************************************************************************
      $text .= "<hr/>";
      $text .= "<h3>".EHD_LAN_PAGE_30_H4."</h3>";
      $text .= "<p>".EHD_LAN_PAGE_30_H4_1."</p>";
      $text .= $e107Helper->getRating("ehddevelop", 1, false, true);

      // ************************************************************************************************************************
      $text .= "<hr/>";
      return $text;
   }

   /**
    * Textareas page
    */
   function getPage40() {
      global $e107Helper;
      $text = "";

      $text .= "<h3>".EHD_LAN_PAGE_40_H1."</h3>";
      $text .= "<p>".EHD_LAN_PAGE_40_H1_1."</p>";

      // ************************************************************************************************************************
      // Default
      // ************************************************************************************************************************
      $text .= "<hr/>";
      $text .= "<h3>".EHD_LAN_PAGE_40_H2."</h3>";
      $text .= "<p>".EHD_LAN_PAGE_40_H2_1."</p>";
      $text .= $e107Helper->getTextarea();

      // ************************************************************************************************************************
      // Content, Width and BBCodes
      // ************************************************************************************************************************
      $text .= "<hr/>";
      $text .= "<h3>".EHD_LAN_PAGE_40_H3."</h3>";
      $text .= "<p>".EHD_LAN_PAGE_40_H3_1."</p>";
      $text .= $e107Helper->getTextarea($tatext="Some content", $name="e107heleprTA1", $class="tbox", $rows="3", $cols="30", $width=false, $showBBCodes=true, $showEmotes=false);

      // ************************************************************************************************************************
      // Width, BBCodes and Emoticons
      // ************************************************************************************************************************
      $text .= "<hr/>";
      $text .= "<h3>".EHD_LAN_PAGE_40_H4."</h3>";
      $text .= "<p>".EHD_LAN_PAGE_40_H4_1."</p>";
      $text .= $e107Helper->getTextarea($tatext="", $name="e107heleprTA2", $class="tbox", $rows="3", $cols=false, $width="75%", $showBBCodes=true, $showEmotes=true);

      // ************************************************************************************************************************
      $text .= "<hr/>";
      return $text;
   }

   /**
    * Notifications page
    */
   function getPage50() {
      global $e107Helper;
      $text = "Under construction";

      // ************************************************************************************************************************
      $text .= "<hr/>";
      return $text;
   }

   /**
    * Charts page
    */
   function getPage60() {
      global $e107Helper;
      $text = "";

      $text .= "<h3>".EHD_LAN_PAGE_60_H1."</h3>";
      $text .= "<p>".EHD_LAN_PAGE_60_H1_1."</p>";
      $text .= "<p>".EHD_LAN_PAGE_60_H1_2."</p>";

      // ************************************************************************************************************************
      // Chart from an XML file
      // ************************************************************************************************************************
      $text .= "<hr/>";
      $text .= "<h3>".EHD_LAN_PAGE_60_H2."</h3>";
      $text .= "<p>".EHD_LAN_PAGE_60_H2_1."</p>";
      $text .= $e107Helper->getChart("xml/chart1.xml");

      // ************************************************************************************************************************
      // Chart from PHP script
      // ************************************************************************************************************************
      $text .= "<hr/>";
      $text .= "<h3>".EHD_LAN_PAGE_60_H3."</h3>";
      $text .= "<p>".EHD_LAN_PAGE_60_H3_1."</p>";
      $text .= $e107Helper->getChart("e107helpers_developer_chart.php", 300, 400);

      // ************************************************************************************************************************
      $text .= "<hr/>";
      return $text;
   }

   /**
    * Tooltips page
    */
   function getPage70() {
      global $e107Helper;
      $text = "";

      // ************************************************************************************************************************
      // Tooltip for a link
      // ************************************************************************************************************************

      $text .= "<hr/>";
      $text .= "<h3>".EHD_LAN_PAGE_70_H1."</h3>";
      $text .= "<p>".EHD_LAN_PAGE_70_H1_1."</p>";
      $text .= "<a href='www.google.co.uk' ";
      $text .= $e107Helper->getTooltip(EHD_LAN_PAGE_70_T1_1);
      $text .= ">Google";
      $text .= "</a>";

      // ************************************************************************************************************************
      // Tooltip for an image
      // ************************************************************************************************************************
      // We can use an array to pass styyle information for the tooltip
      $styles = array(
         "caption-style"   => "",               // Extra styles for the caption
         "min-width"       => "100",            // The minimum width for the tooltip
         "max-width"       => "300",            // The maximum width for the tooltip
         "container-class" => "forumheader",    // CSS class(es) for the tooltip container (outer box)
         "container-style" => "",               // Extra styles for the container
         "caption-class"   => "forumheader2",   // CSS class(es) for the tooltip caption (title)
         "caption-style"   => "",               // Extra styles for the caption
         "content-class"   => "forumheader3",   // CSS class(es) for the tooltip content
         "content-style"   => ""                // Extra styles for the content
      );

      $text .= "<hr/>";
      $text .= "<h3>".EHD_LAN_PAGE_70_H2."</h3>";
      $text .= "<p>".EHD_LAN_PAGE_70_H2_1."</p>";
      $text .= "<img src='".e_IMAGE."newspost_images/welcome.png' title='welcome.png' alt='welcome.png'";
      $text .= $e107Helper->getTooltip(EHD_LAN_PAGE_70_T2_1, EHD_LAN_PAGE_70_T2_2, $styles);
      $text .= "/>";

      // ************************************************************************************************************************
      // Tooltip for some (span) text
      // ************************************************************************************************************************
      $styles = array(
         "caption-style"   => "font-weight:bold;text-align:center;", // Extra styles for the caption
         "min-width"       => "100",                                 // The minimum width for the tooltip
         "max-width"       => "450",                                 // The maximum width for the tooltip
      );

      // We're going to use this tooltip a couple of times, so store it in a variable first
      $tt = "<span style='cursor:pointer;border-top:1px solid;border-bottom:1px solid;' ";
      $tt .= $e107Helper->getTooltip(EHD_LAN_PAGE_70_T3_1, EHD_LAN_PAGE_70_T3_2, $styles);
      $tt .= ">".EHD_LAN_PAGE_70_H3_1."</span>";
      $text .= "<hr/>";
      $text .= "<h3>".EHD_LAN_PAGE_70_H3."</h3>";
      $text .= "<p>".EHD_LAN_PAGE_70_H3_2."</p>";
      $text .= str_replace(EHD_LAN_PAGE_70_H3_1, $tt, EHD_LAN_PAGE_70_H3_3);

      // ************************************************************************************************************************
      $text .= "<hr/>";
      return $text;
   }

   /**
    * Miscellaneous page
    */
   function getPage80() {
      global $e107Helper;
      $text = "";

      $text .= "<h3>".EHD_LAN_PAGE_80_H1."</h3>";
      $text .= "<p>".EHD_LAN_PAGE_80_H1_1."</p>";

      // ************************************************************************************************************************
      // Image toggle
      // ************************************************************************************************************************
      $text .= "<hr/>";
      $text .= "<h3>".EHD_LAN_PAGE_80_H2."</h3>";
      $text .= "<p>".EHD_LAN_PAGE_80_H2_1."</p>";
      $text .= $e107Helper->getToggleImage("ehddevelop_image_toggle", e_IMAGE."newspost_images/logo.png", e_IMAGE."newspost_images/welcome.png");

      // ************************************************************************************************************************
      $text .= "<hr/>";
      return $text;
   }

   // *********************************************************************************************
   // Admin pages
   // *********************************************************************************************

   /**
    * Get the admin menu
    */
   function getAdminMenu() {
      global $e107helpers_developer_adminmenu, $pageid;
      show_admin_menu(EHD_LAN_E107HELPER_DEVELOPER, $pageid, $e107helpers_developer_adminmenu);
   }

   /**
    * Generate the admin preferences page
    */
   function getAdminPage() {
      global $e107helpers_developer_adminmenu, $pageid, $e107HelperForm;

      $pageid = e_QUERY ? e_QUERY : 10;
      $title  = EHD_LAN_E107HELPER_DEVELOPER." :: ".$e107helpers_developer_adminmenu["EHDC_ADMIN_PAGE_".$pageid]["text"];
      if ($e107helpers_developer_adminmenu["EHDC_ADMIN_PAGE_".$pageid]["form"]) {
         // Create and process a form using the helper classes
         $e107HelperForm->createFormFromXML("forms/prefs_".$pageid);
         $e107HelperForm->processForm(true, true);
         $text = $e107HelperForm->getFormHTML();
      } else {
         include("admin_prefs_$pageid.php");
      }
      $pageid = e_QUERY ? "EHDC_ADMIN_PAGE_".e_QUERY : "EHDC_ADMIN_PAGE_10";
      return array($title, $text);
   }

   /**
    * Get context sensitive help for the admin pages
    */
   function getAdminHelp() {
      global $ns, $pageid;
   	$qs = explode(".", e_QUERY);
   	$text = "";
   	$text .= constant("EHD_LAN_ADMIN_HELP_".$qs[0]);
      $ns->tablerender(constant("EHD_LAN_ADMIN_MENU_".$qs[0]), $text);
   }

   /**
    * Load the appropriate template
    */
   function getTemplate($e107helpers_developer=false) {
      global $pref;

      // Default
      $template = EHDC_PLUGIN_DIR."templates/e107helpers_developer_default_template.php";

      // Global
      if (file_exists(EHDC_PLUGIN_DIR."/templates/e107helpers_developer_".$pref["e107helpers_developer_global_template"]."_template.php")){
         $template = EHDC_PLUGIN_DIR."templates/e107helpers_developer_".$pref["e107helpers_developer_global_template"]."_template.php";
      }

      // Election specific
      if (false != $e107helpers_developer && file_exists(EHDC_PLUGIN_DIR."/templates/e107helpers_developer_".$e107helpers_developer->getTemplate()."_template.php")){
         $template = EHDC_PLUGIN_DIR."templates/e107helpers_developer_".$e107helpers_developer->getTemplate()."_template.php";
      }

      return $template;
   }

   function getTooltip($tttext, $caption="", $image=false) {
      global $e107Helper, $pref;
      $tt = "";
      if ($pref["e107helpers_developer_tooltips"]) {
         $tt = $e107Helper->getTooltip($tttext, $caption, $this->getTooltipStyles(), EHDC_TT);
         if ($image) {
            $tt = "<img align='top' style='cursor:pointer' src='".e_IMAGE."admin_images/polls_16.png'$tt/>";
         }
      }
      return $tt;
   }
   function getTooltipStyles() {
      return array(
         "caption-style"   => "font-weight:bold;text-align:center;",
         "min-width"       => "150",
         "max-width"       => "300",
      );
   }
}

// An global instance of the e107helpers_developer class
global $helperdev;
$helperdev = new e107helpers_developer();
?>