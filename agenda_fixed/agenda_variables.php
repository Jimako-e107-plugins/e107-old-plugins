<?php
/*
+---------------------------------------------------------------+
| Agenda by bugrain (www.bugrain.plus.com)
| see plugin.php for version information
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/agenda/agenda_variables.php,v $
| $Revision: 1.35 $
| $Date: 2006/11/29 01:17:02 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   if (!defined("AGENDA_LAN_NAME")) {
      define("AGENDA_LAN_NAME",  "Agenda");
      define("AGENDA_LAN_VER",   "1.7_b2");

      // Stuff to make it 0.617 compatible
      if (!defined("LAN_EXISTING"))         define("LAN_EXISTING",        "Existing");
      if (!defined("LAN_EDIT"))             define("LAN_EDIT",            "Edit");
      if (!defined("LAN_DELETE"))           define("LAN_DELETE",          "Delete");
      if (!defined("LAN_UPDATE"))           define("LAN_UPDATE",          "Update");
      if (!defined("LAN_CREATE"))           define("LAN_CREATE",          "Create");
      if (!defined("LAN_CREATED"))          define("LAN_CREATED",         "Created");
      if (!defined("LAN_CREATED_FAILED"))   define("LAN_CREATED_FAILED",  "Create failed");
      if (!defined("LAN_UPDATED"))          define("LAN_UPDATED",         "Updated");
      if (!defined("LAN_UPDATED_FAILED"))   define("LAN_UPDATED_FAILED",  "Update failed");
      if (!defined("LAN_DELETED"))          define("LAN_DELETED",         "Deleted");
      if (!defined("LAN_DELETED_FAILED"))   define("LAN_DELETED_FAILED",  "Delete failed");
      if (!defined("LAN_EMPTY"))            define("LAN_EMPTY",           "Empty");
      global $IMAGES_DIRECTORY;
      if (!defined("e_IMAGE_ABS"))          define("e_IMAGE_ABS",         e_HTTP.$IMAGES_DIRECTORY);
      if (!defined("e_PLUGIN_ABS"))         define("e_PLUGIN_ABS",        e_HTTP.$PLUGINS_DIRECTORY);
   }

   if (file_exists(e_PLUGIN."agenda/languages/".e_LANGUAGE.".php")) {
      require_once(e_PLUGIN."agenda/languages/".e_LANGUAGE.".php");
   } else {
      require_once(e_PLUGIN."agenda/languages/English.php");
   }

   // Include the e107 Helper class if not already available
   if (file_exists(e_PLUGIN."e107helpers/e107Helper.php")) {
      include(e_PLUGIN."e107helpers/e107Helper.php");
   } else {
      print "Fatal error in ".__FILE__.", cannot find e107Helper class<br>Agenda requires the e107 Helper Project plugin to be installed<pre>";
      if (strstr(e_SELF, "agenda/") != false) {
         debug_print_backtrace();
         print "</pre>";
         exit;
      }
      return;
   }

   require_once(e_PLUGIN."agenda/form_handler.php");

   // Objects
   $agn_sql1   = new e107HelperDB();
   $agn_sql2   = new e107HelperDB();

   // Include the Agenda class if not already available
   if (!class_exists("Agenda")) {
      if (file_exists(e_PLUGIN."agenda/agenda_class.php")) {
         include(e_PLUGIN."agenda/agenda_class.php");
         $GLOBALS['agenda'] = new Agenda();
         $GLOBALS['agendaFields'] = new AgendaFields();
         print "\n<script type='text/javascript' src='".e_PLUGIN_ABS."agenda/agenda.js'></script>\n";
      } else {
         print "Fatal error, cannot find Agenda class";
      }
   }
   global $agenda;

   // Form fields - navigation menu
   $agn_navformcapt[0]  = AGENDA_LAN_23;
   $agn_navformname[0]  = "agenda_view";
   $agn_navformtype[0]  = "dropdown2";
   $agn_navformvalu[0]  = $agenda->getViewsList();
   $agn_navformjs[0]    = "onchange='agendaChangeView(event);'";

   $agn_navformcapt[1]  = AGENDA_LAN_24;
   $agn_navformname[1]  = "agenda_date";
   $agn_navformtype[1]  = "calendar";
   $agn_navformvalu[1]  = date("d-m-Y");
   $agn_navformjs[1]    = "";

   $agn_navformcapt[2]  = AGENDA_LAN_25;
   $agn_navformname[2]  = "agenda_date_go";
   $agn_navformtype[2]  = "button";
   $agn_navformvalu[2]  = AGENDA_LAN_26;
   $agn_navformjs[2]    = "onclick='agendaChangeDate(event);'";

   $agn_navformcapt[3]  = AGENDA_LAN_31;
   $agn_navformname[3]  = "agenda_add";
   $agn_navformtype[3]  = "dropdown2";
   $agn_navformvalu[3]  = $agenda->getTypesList();
   $agn_navformjs[3]    = "onchange='agendaAddEntry(event);'";
   //dialog $agn_navformjs[3]    = "onchange='agendaHelper.addEntryForm(event);'";

//   $agn_navformcapt[4]  = AGENDA_LAN_40;
//   $agn_navformname[4]  = "agenda_filter";
//   $agn_navformtype[4]  = "radio2";
//   $agn_navformvalu[4]  = "1:".AGENDA_LAN_43.",0:".AGENDA_LAN_44."";
//   $agn_navformjs[4]    = "onchange='agendaHelper.addEntryForm(event);'";

   $agn_navformcapt[5]  = AGENDA_LAN_41;
   $agn_navformname[5]  = "agenda_filter_go";
   $agn_navformtype[5]  = "button";
   $agn_navformvalu[5]  = AGENDA_LAN_42;
   $agn_navformjs[5]    = "onclick='agendaSetFilter(event);'";

   $agn_navformcapt[6]  = AGENDA_LAN_92;
   $agn_navformname[6]  = "agenda_search_go";
   $agn_navformtype[6]  = "button";
   $agn_navformvalu[6]  = AGENDA_LAN_93;
   $agn_navformjs[6]    = "onclick='agendaSearchPage(event);'";

   $agn_navformcapt[7]  = AGENDA_LAN_102;
   $agn_navformname[7]  = "agenda_print_go";
   $agn_navformtype[7]  = "button";
   $agn_navformvalu[7]  = AGENDA_LAN_103;
   $agn_navformjs[7]    = "onclick='agendaPrintPage(event);'";

   // Form fields - all fields for an entry (i.e. those that cannot be hidden for a type)
   $agn_field[0]['capt'] = AGENDA_LAN_FIELD_00_0;
   $agn_field[0]['note'] = AGENDA_LAN_FIELD_00_1;
   $agn_field[0]['name'] = "agn_title";
   $agn_field[0]['type'] = "text";
   $agn_field[0]['valu'] = ",30,200";
   $agn_field[0]['mand'] = "*";

   $agn_field[1]['capt'] = AGENDA_LAN_FIELD_01_0;
   $agn_field[1]['note'] = AGENDA_LAN_FIELD_01_1;
   $agn_field[1]['name'] = "agn_start";
   $agn_field[1]['type'] = "calendar";
   $agn_field[1]['valu'] = $agenda->getDateNum()."-".$agenda->getMonthNum()."-".$agenda->getYearNum();
   $agn_field[1]['mand'] = "*";

   $agn_field[2]['capt'] = AGENDA_LAN_FIELD_02_0;
   $agn_field[2]['note'] = AGENDA_LAN_FIELD_02_1;
   $agn_field[2]['name'] = "agn_end";
   $agn_field[2]['type'] = "calendar";
   $agn_field[2]['valu'] = $agenda->getDateNum()."-".$agenda->getMonthNum()."-".$agenda->getYearNum();

   $agn_field[3]['capt'] = AGENDA_LAN_FIELD_03_0;
   $agn_field[3]['note'] = AGENDA_LAN_FIELD_03_1;
   $agn_field[3]['name'] = "agn_start";
   $agn_field[3]['type'] = "calendartime";
   $agn_field[3]['valu'] = $agenda->getDateNum()."-".$agenda->getMonthNum()."-".$agenda->getYearNum().",12.00";
   $agn_field[3]['mand'] = "*";

   $agn_field[4]['capt'] = AGENDA_LAN_FIELD_04_0;
   $agn_field[4]['note'] = AGENDA_LAN_FIELD_04_1;
   $agn_field[4]['name'] = "agn_end";
   $agn_field[4]['type'] = "calendartime";
   $agn_field[4]['valu'] = $agenda->getDateNum()."-".$agenda->getMonthNum()."-".$agenda->getYearNum().",12.00";

   $agn_field[5]['capt'] = AGENDA_LAN_FIELD_05_0;
   $agn_field[5]['note'] = AGENDA_LAN_FIELD_05_1;
   $agn_field[5]['name'] = "agn_category";
   $agn_field[5]['type'] = "dropdown2";
   $agn_field[5]['valu'] = $agenda->getCategoriesList();

   $agn_field[6]['capt'] = AGENDA_LAN_FIELD_06_0;
   $agn_field[6]['note'] = AGENDA_LAN_FIELD_06_1;
   $agn_field[6]['name'] = "agn_location";
   $agn_field[6]['type'] = "text";
   $agn_field[6]['valu'] = ",50,200";

   $agn_field[7]['capt'] = AGENDA_LAN_FIELD_07_0;
   $agn_field[7]['note'] = AGENDA_LAN_FIELD_07_1;
   $agn_field[7]['name'] = "agn_details";
   $agn_field[7]['type'] = "textarea";
   $agn_field[7]['valu'] = ",350px,60px";

   $agn_field[8]['capt'] = AGENDA_LAN_FIELD_08_0;
   $agn_field[8]['note'] = AGENDA_LAN_FIELD_08_1;
   $agn_field[8]['note'] = AGENDA_LAN_FIELD_08_1;
   $agn_field[8]['name'] = "agn_priority";
   $agn_field[8]['type'] = "radio";
   $agn_field[8]['valu'] = "0,1,2,3,4,5";
   $agn_field[8]['pres'] = "0";

   $agn_field[9]['capt'] = AGENDA_LAN_FIELD_09_0;
   $agn_field[9]['note'] = AGENDA_LAN_FIELD_09_1;
   $agn_field[9]['name'] = "agn_owner";
   $agn_field[9]['type'] = "text";
   $agn_field[9]['valu'] = USERNAME.",20,100";

   $agn_field[10]['capt'] = AGENDA_LAN_FIELD_10_0;
   $agn_field[10]['note'] = AGENDA_LAN_FIELD_10_1;
   $agn_field[10]['name'] = "agn_recurring";
   $agn_field[10]['type'] = "dropdown2";
   $agn_field[10]['valu'] = $agenda->getRecurCodesList();

   $agn_field[11]['capt'] = AGENDA_LAN_FIELD_11_0;
   $agn_field[11]['note'] = AGENDA_LAN_FIELD_11_1;
   $agn_field[11]['name'] = "agn_contact_email";
   $agn_field[11]['type'] = "text";
   $agn_field[11]['valu'] = ",50,200";

   $agn_field[12]['capt'] = AGENDA_LAN_FIELD_12_0;
   $agn_field[12]['note'] = AGENDA_LAN_FIELD_12_1;
   $agn_field[12]['name'] = "agn_private";
   $agn_field[12]['type'] = "checkbox2";
   $agn_field[12]['valu'] = "1:".AGENDA_LAN_FIELD_12_2;

   $agn_field[13]['capt'] = AGENDA_LAN_FIELD_13_0;
   $agn_field[13]['note'] = AGENDA_LAN_FIELD_13_1;
   $agn_field[13]['name'] = "agn_complete";
   $agn_field[13]['type'] = "checkbox2";
   $agn_field[13]['valu'] = "1:".AGENDA_LAN_FIELD_13_2;

   $agn_field[14]['capt'] = AGENDA_LAN_FIELD_14_0;
   $agn_field[14]['note'] = AGENDA_LAN_FIELD_14_1;
   $agn_field[14]['name'] = "agn_diary_code";
   $agn_field[14]['type'] = "diarycode";
   $agn_field[14]['valu'] = "";

   $agn_field[15]['capt'] = AGENDA_LAN_FIELD_15_0;
   $agn_field[15]['note'] = AGENDA_LAN_FIELD_15_1;
   $agn_field[15]['name'] = "agn_forum_thread";
   $agn_field[15]['type'] = "text";
   $agn_field[15]['valu'] = ",50,200";

   $agn_field[16]['capt'] = AGENDA_LAN_FIELD_16_0;
   $agn_field[16]['note'] = AGENDA_LAN_FIELD_16_1;
   $agn_field[16]['name'] = "agn_question";
   $agn_field[16]['type'] = "dropdown2";
   $agn_field[16]['valu'] = "0:".AGENDA_LAN_FIELD_16_3.",".$agenda->getRegQuestions();

   // Custom fields
//   $agn_field[1001]['capt'] = $pref["agenda_custom_field_1_name"];
//   $agn_field[1001]['note'] = "";
//   $agn_field[1001]['name'] = "agn_data1";
//   $agn_field[1001]['type'] = "text";
//   $agn_field[1001]['valu'] = ",20,200";
//
//   $agn_field[1002]['capt'] = $pref["agenda_custom_field_2_name"];
//   $agn_field[1002]['note'] = "";
//   $agn_field[1002]['name'] = "agn_data2";
//   $agn_field[1002]['type'] = "text";
//   $agn_field[1002]['valu'] = ",20,200";
//
//   $agn_field[1003]['capt'] = $pref["agenda_custom_field_3_name"];
//   $agn_field[1003]['note'] = "";
//   $agn_field[1003]['name'] = "agn_data3";
//   $agn_field[1003]['type'] = "text";
//   $agn_field[1003]['valu'] = ",20,200";
//
//   $agn_field[1004]['capt'] = $pref["agenda_custom_field_4_name"];
//   $agn_field[1004]['note'] = "";
//   $agn_field[1004]['name'] = "agn_data4";
//   $agn_field[1004]['type'] = "text";
//   $agn_field[1004]['valu'] = ",20,200";

   // Filter form fields
   $agn_field[50]['capt'] = AGENDA_LAN_FIELD_50_0;
   $agn_field[50]['note'] = AGENDA_LAN_FIELD_50_1;
   $agn_field[50]['name'] = "usr_filter_state";
   $agn_field[50]['type'] = "checkbox2";
   $agn_field[50]['valu'] = "1:".AGENDA_LAN_FIELD_50_2;

   $agn_field[51]['capt'] = AGENDA_LAN_FIELD_51_0;
   $agn_field[51]['note'] = AGENDA_LAN_FIELD_51_1;
   $agn_field[51]['name'] = "usr_type";
   $agn_field[51]['type'] = "multilist2";
   $agn_field[51]['valu'] = $agenda->getFilterTypesList();

   $agn_field[52]['capt'] = AGENDA_LAN_FIELD_52_0;
   $agn_field[52]['note'] = AGENDA_LAN_FIELD_52_1;
   $agn_field[52]['name'] = "usr_category";
   $agn_field[52]['type'] = "multilist2";
   $agn_field[52]['valu'] = $agenda->getCategoriesList();

   $agn_field[53]['capt'] = AGENDA_LAN_FIELD_53_0;
   $agn_field[53]['note'] = AGENDA_LAN_FIELD_53_1;
   $agn_field[53]['name'] = "usr_owner";
   $agn_field[53]['type'] = "multilist";
   $agn_field[53]['valu'] = $agenda->getOwnersList();

   $agn_field[54]['capt'] = AGENDA_LAN_FIELD_54_0;
   $agn_field[54]['note'] = AGENDA_LAN_FIELD_54_1;
   $agn_field[54]['name'] = "usr_complete";
   $agn_field[54]['type'] = "checkbox2";
   $agn_field[54]['valu'] = "1:".AGENDA_LAN_FIELD_54_2;

   // Search form fields
   $agn_field[70]['capt'] = AGENDA_LAN_FIELD_70_0;
   $agn_field[70]['note'] = AGENDA_LAN_FIELD_70_1;
   $agn_field[70]['name'] = "usr_title";
   $agn_field[70]['type'] = "text";
   $agn_field[70]['valu'] = ",50,200";

   $agn_field[71]['capt'] = AGENDA_LAN_FIELD_71_0;
   $agn_field[71]['note'] = AGENDA_LAN_FIELD_71_1;
   $agn_field[71]['name'] = "usr_category";
   $agn_field[71]['type'] = "dropdown2";
   $agn_field[71]['valu'] = ":,".$agenda->getCategoriesList();

   $agn_field[72]['capt'] = AGENDA_LAN_FIELD_72_0;
   $agn_field[72]['note'] = AGENDA_LAN_FIELD_72_1;
   $agn_field[72]['name'] = "usr_start";
   $agn_field[72]['type'] = "calendar";
   $agn_field[72]['valu'] = $agenda->getDateNum()."-".$agenda->getMonthNum()."-".$agenda->getYearNum();

   $agn_field[73]['capt'] = AGENDA_LAN_FIELD_73_0;
   $agn_field[73]['note'] = AGENDA_LAN_FIELD_73_1;
   $agn_field[73]['name'] = "usr_end";
   $agn_field[73]['type'] = "calendar";
   $agn_field[73]['valu'] = $agenda->getDateNum()."-".$agenda->getMonthNum()."-".$agenda->getYearNum();

   $agn_field[74]['capt'] = AGENDA_LAN_FIELD_74_0;
   $agn_field[74]['note'] = AGENDA_LAN_FIELD_74_1;
   $agn_field[74]['name'] = "usr_location";
   $agn_field[74]['type'] = "text";
   $agn_field[74]['valu'] = ",50,200";

   $agn_field[75]['capt'] = AGENDA_LAN_FIELD_75_0;
   $agn_field[75]['note'] = AGENDA_LAN_FIELD_75_1;
   $agn_field[75]['name'] = "usr_description";
   $agn_field[75]['type'] = "text";
   $agn_field[75]['valu'] = ",50,200";

   $agn_field[76]['capt'] = AGENDA_LAN_FIELD_76_0;
   $agn_field[76]['note'] = AGENDA_LAN_FIELD_76_1;
   $agn_field[76]['name'] = "usr_owner";
   $agn_field[76]['type'] = "text";
   $agn_field[76]['valu'] = ",50,200";

   // Fields that are present for all entry types in the order they appear on the page
   $agn_required_fields          = array(0,5);
   $agn_required_fields_timed    = array(array(1), array(3));
   $agn_filter_fields            = array(51,52,53,54);
   $agn_search_fields            = array(70,71,72,73,74,75,76);

   // Fields that can be selected to be displayed for different types (see agenda_types.php)
   $agn_optional_fields = array(2,4,14,6,7,8,9,11,12,13,15,16);

   $agn_tooltip_styles = array(
         "container-class"    => "ttContainer",
         "min-width"          => "100",
         "caption-class"      => "ttCaption",
         "content-class"      => "ttContent smalltext",
         "caption-style"      => "",
         "content-style"      => "",
      );

?>