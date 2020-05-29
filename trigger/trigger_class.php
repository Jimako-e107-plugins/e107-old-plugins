<?php
/*
+---------------------------------------------------------------+
| PSilo by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Copyright 2007, Neil Harrison (AKA bugrain)
|
| $Source: e:\_repository\e107_plugins/trigger/trigger_class.php,v $
| $Revision: 1.6 $
| $Date: 2008/06/28 09:40:30 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
include_lan(e_PLUGIN."trigger/languages/English.php", true);
include_lan(e_LANGUAGEDIR.e_LANGUAGE."/admin/lan_download.php", true);
include_lan(e_LANGUAGEDIR.e_LANGUAGE."/admin/lan_newspost.php", true);

require_once(e_HANDLER."cache_handler.php");
require_once(e_PLUGIN."trigger/constants.php");
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

global $e107Helper;

/**
 * Class used to control all page generation and workflow aspects of trigger
 */
class trigger {
   /**
    * Constructor
    */
   function trigger() {
      switch (e_QUERY) {
         case "newspost" : {
            $title = $_POST["title"];
            $text = $_POST["trigger_newspost"];
            $forum_id = intval($_POST["forum_id"]);
            $news_datestamp = intval($_POST["datestamp"]);
            $this->triggerNewspostPost($title, $text, $forum_id, $news_datestamp);
            header("location:".e_ADMIN."newspost.php");
            exit;
         }
      }
   }

   /**
    * triggerSubnews
    * @param   $data trigger data for a submit news (ref: http://wiki.e107.org/?title=Core_event_trigger#User_submits_a_news_item)
    */
   function triggerSubnews($data) {
      global $e_event, $pref, $ns, $sql, $tp, $e107Helper;
      if ($pref["trigger_naa_enabled"] == 1) {
         if (check_class($pref["trigger_naa_submit_class"])) {
            if ($sql->db_Select("submitnews", "*", "submitnews_name='".$data["user"]."' AND submitnews_title='".$data["itemtitle"]."' AND submitnews_category='".$data["catid"]."' AND submitnews_ip='".$data["ip"]."'", true)) {
               $subrow = $sql->db_Fetch();
      //         list($id, $submitnews_name, $submitnews_email, $_POST['news_title'], $submitnews_category, $_POST['data'], $submitnews_datestamp, $submitnews_ip, $submitnews_auth, $submitnews_file) = $row;
               if (varset($pref["trigger_naa_append_text"], false)) {
                  $data["item"] .= "\n".$pref["trigger_naa_append_text"];
               }
               if (varset($pref["trigger_naa_append_poster"], false)) {
                  $data["item"] .= "\n[[b]".NWSLAN_49." ".$data["user"]."[/b]]";
               }

               $data["itemtitle"] = $tp->toDB($data["itemtitle"]);
               $data["item"] = $tp->toDB($data["item"]);

               $allowcomments = varset($pref["trigger_naa_allow_comments"], 0);
               $timestamp = time();
               //                                                                                                                                                                                                               +-render type
               if ($id = $sql ->db_Insert('news', "0, '".$data["itemtitle"]."', '".$data["item"]."', '', ".$timestamp.", ".USERID.", '".intval($data["catid"])."', '$allowcomments', 0, 0, '".$pref["trigger_naa_view_class"]."',  '0', '0', '', '', '0'")) {
                  if (varset($pref["trigger_naa_delete_submitted"], false)) {
                     $sql->db_Delete("submitnews", "submitnews_id='".$subrow["submitnews_id"]."'");
                  } else {
                     $sql->db_Update("submitnews", "submitnews_auth='{USERID}' WHERE submitnews_id ='".$subrow["id"]."' ");
                  }
                  if (varset($pref["trigger_naa_autoapproved_message"], false)) {
                     $ns->tablerender(LAN_133, $pref["trigger_naa_autoapproved_message"]);
                  }
                  $triggerdata["cat_id"]              = intval($data["catid"]);
                  $triggerdata["news_title"]          = $data["itemtitle"];
                  $triggerdata["news_summary"]        = "";
                  $triggerdata["data"]                = $data["item"];
                  $triggerdata["news_body"]                = $data["item"];
                  //$triggerdata["helpb"]               = "";
                  //$triggerdata["fontcol"]             = "";
                  //$triggerdata["fontsiz"]             = "";
                  //$triggerdata["thumbps"]             = "";
                  //$triggerdata["imageps"]             = "";
                  //$triggerdata["fileps"]              = "";
                  $triggerdata["preimageselect"]      = "";
                  $triggerdata["prefileselect"]       = "";
                  $triggerdata["news_extended"]       = "";
                  $triggerdata["extended"]            = "";
                  $triggerdata["uploadtype"]          = "";
                  $triggerdata["resize_value"]        = "";
                  $triggerdata["news_allow_comments"] = $allowcomments;
                  $triggerdata["news_rendertype"]     = 0;
                  //$triggerdata["startday"]            = "";
                  //$triggerdata["startmonth"]          = "";
                  //$triggerdata["startyear"]           = "";
                  //$triggerdata["endday"]              = "";
                  //$triggerdata["endmonth"]            = "";
                  //$triggerdata["endyear"]             = "";
                  $triggerdata["news_start"]          = "";
                  $triggerdata["news_end"]            = "";
                  $triggerdata["news_userclass"]      = Array($pref["trigger_naa_view_class"]);
                  $triggerdata["news_class"]          = $pref["trigger_naa_view_class"];
                  //$triggerdata["submit"]              = "";
                  $triggerdata["submit_news"]         = "Post news to database";
                  $triggerdata["news_id"]             = $id;
                  $triggerdata["active_start"]        = "";
                  $triggerdata["active_end"]          = "";
                  $triggerdata["news_userid"]         = USERID;
                  $triggerdata["admin_id"]            = USERID;
                  $triggerdata["news_author"]         = USERID;
                  $triggerdata["news_sticky"]         = 0;
                  $triggerdata["admin_name"]          = USERNAME;
                  $triggerdata["news_datestamp"]      = $timestamp;
                  // TODO when executed from user paegs, trigger fails as it expects to be an admin submit
                  // maybe fire own trigger event - but need to consider added pref to turn this on/off as it may not be wanted
                  // for user submitted news
                  //$e_event -> trigger('newspost', $triggerdata);
                  $e107cache = new ecache();
	               $e107cache->clear("news.php");
	               $e107cache->clear("othernews");
   	            $e107cache->clear("othernews2");
               }
            }
         }
      }
   }

   /**
    * triggerNewspost
    * @param   $data trigger data for a newspost (ref: http://wiki.e107.org/?title=Core_event_trigger#News_item_posted)
    */
   function triggerNewspost($data) {
      global $pref, $tp, $e107Helper;
      if ($pref["trigger_n2f_enabled"] == 1) {
         if ($pref["trigger_n2f_autopost"]) {
            $this->triggerNewspostPost($data["news_title"], $this->triggerNewspostText($data), $pref["trigger_n2f_forum_id"], $data["news_datestamp"]);
         } else {
            // Form for post details
            global $rs;
            $text .= $rs->form_open("post", e_PLUGIN."trigger/trigger.php?newspost");
            $text .= "<table class='forumheader' style='margin:40px;width:100%'>";

            $text .= "<tr><td class='main_caption' colspan='2' style='text-align:center;'>";
            $text .= TRIGGER_LAN_N2F_03;
            $text .= "</td></tr>";

            $text .= "<tr><td>".TRIGGER_LAN_N2F_04."</td><td>";
            $text .= $rs->form_text("title", "50", $tp->post_toForm($data['news_title']), "", "tbox");
            $text .= "</td></tr>";

            $options = $this->triggerForums();
            $text .= "<tr><td>".TRIGGER_LAN_N2F_05."</td><td>";
            $text .= $rs->form_select_open("forum_id");
            foreach ($options as $option) {
               $selected = $option[0] == $pref["trigger_n2f_forum_id"] ? 1 : "";
               $text .= $rs->form_option($option[1], $selected, $option[0]);
            }
            $text .= $rs->form_select_close();
            $text .= "</td></tr>";

            $text .= "<tr><td>".TRIGGER_LAN_N2F_06."</td><td class='forumheader3'>";
            $newsposttext = $tp->post_toForm($this->triggerNewspostText($data));
            $text .= $e107Helper->getTextarea($newsposttext, "trigger_newspost", "tbox", "10", false, "100%", 2, true, false);

            $parms = "name=news_thumbnail";
            $parms .= "&path=".e_IMAGE."newspost_images/";
            $parms .= "&default=".$_POST['news_thumbnail'];
            $parms .= "&width=100px";
            $parms .= "&height=100px";
            $parms .= "&multiple=TRUE";
            $parms .= "&label=-- ".LAN_NEWS_48." --";
            $parms .= "&linkid=trigger_newspost";
            $text .= $tp->parseTemplate("{IMAGESELECTOR={$parms}}");
            $text .= "</td></tr>";

            $text .= "<tr><td colspan='2' style='text-align:center;'>";
            $text .= $rs->form_hidden("datestamp", $data["news_datestamp"]);
            $text .= $rs->form_button("submit", "newspost", TRIGGER_LAN_N2F_07);
            $text .= "</td></tr>";

            $text .= "</table>";
            $text .= $rs->form_close();
            echo $text;
         }
      }
   }

   function triggerNewspostText($data) {
      global $pref, $tp;
      // Admin specified pre-text
      $text = $pref["trigger_n2f_text"];
      // News summary text
      if ($pref["trigger_n2f_inc_summary"] == 1) {
         if (strlen($text) > 0) {
            $text .= "\n\n";
         }
         $text .= $data["news_summary"];
      }
      // Main news text
      if ($pref["trigger_n2f_inc_data"] == "") {
         if (strlen($text) > 0) {
            $text .= "\n\n";
         }
         $text .= $data["data"];
      } elseif ($pref["trigger_n2f_inc_data"] > 0) {
         if (strlen($text) > 0) {
            $text .= "\n\n";
         }
         $text .= $tp->html_truncate($data["data"], $pref["trigger_n2f_inc_data"], $pref["trigger_n2f_inc_data_more"]);
      }
      // Extended news text
      if ($pref["trigger_n2f_inc_extended"] == "") {
         if (strlen($text) > 0) {
            $text .= "\n\n";
         }
         $text .= $data["data"];
      } elseif ($pref["trigger_n2f_inc_extended"] > 0) {
         if (strlen($text) > 0) {
            $text .= "\n\n";
         }
         $text .= $tp->html_truncate($data["news_extended"], $pref["trigger_n2f_inc_extended"], $pref["trigger_n2f_inc_extended_more"]);
      }
      return $text;
   }

   function triggerNewspostPost($title, $text, $forum_id, $news_datestamp) {
      global $pref, $sql, $tp;

      // Create new thread
      if (!class_exists("e107forum")) {
         require_once(e_PLUGIN.'forum/forum_class.php');
      }
      $forum = new e107forum;

      $poster = array();
      $poster['post_userid'] = USERID;
      $poster['post_user_name'] = USERNAME;
      $title = $tp->toDB($title);
      $text = $tp->toDB($text);

      $thread_id = $forum->thread_insert(
         $title,
         $text,
         $forum_id,  // forum id,
         0,          // thread parent (0=this is parent),
         $poster,    // poster (=current user)
         1,          // thread active (1=yes),
         0,          // $thread_s (>>),
         0           // forum sub - need to be parent forum if this is a sub-forum
         );

      // Update news post
      if (strlen($pref["trigger_n2f_link"]) > 0) {
         if ($sql->db_Select("news", "*", "news_datestamp='$news_datestamp' limit 0,1", true)) {
            if ($row = $sql->db_Fetch()) {
               $newbody = $row["news_body"]."\n\n[link=".e_PLUGIN."forum/forum_viewtopic.php?$thread_id]";
               $newbody .= $pref["trigger_n2f_link"]."[/link]";
               $sql->db_Update("news", "news_body='$newbody' where news_datestamp='$news_datestamp'");
            }
         }
      }
   }

   /**
    * triggerFileUpload
    * @param   $data trigger data for a file upload (ref: http://wiki.e107.org/?title=Core_event_trigger#Uploads)
    */
   function triggerFileUpload($data) {
      global $pref, $sql, $e107Helper;

      if ($pref["trigger_fup_enabled"] == 1) {
         if (check_class($pref["trigger_fup_auto_approve"])) {
            if ($sql->db_Select("upload", "*", "upload_poster='".$data["upload_user"]."' AND upload_datestamp='".$data["upload_time"]."'")) {
               $row = $sql->db_Fetch();
               $download_category = $row['upload_category'];
               $download_name = $row['upload_name'].($row['upload_version'] ? " v" . $row['upload_version'] : "");
               $download_url = $row['upload_file'];
               $download_author_email = $row['upload_email'];
               $download_author_website = $row['upload_website'];
               $download_datestamp = $row['upload_datestamp'];
               $download_description = $row['upload_description'];
               $download_image = $row['upload_ss'];
               $download_filesize = $row['upload_filesize'];
               $image_array[] = array("path" => "", "fname" => $row['upload_ss']);
               $download_author = substr($row['upload_poster'], (strpos($row['upload_poster'], ".")+1));

               if ($download_id = $sql->db_Insert("download",
                  "0,
                  '".$download_name."',
                  '".$download_url."',
                  '".$download_author."',
                  '".$download_author_email."',
                  '".$download_author_website."',
                  '".$download_description."',
                  '".$download_filesize."',
                  '0',
                  '".$download_category."',
                  '".$pref['trigger_fup_download_active']."',
                  '".$download_datestamp."',
                  '',
                  '".$download_image."',
                  '".$pref['trigger_fup_comments']."',
                  '".$pref['trigger_fup_download_class']."',
                  '',
                  '0',
                  '".$pref['trigger_fup_download_visible']."' "))
               {
                  $sql->db_Write_log(TRIGGERC_NAME, TRIGGER_LAN_201, "download id=$download_id");
               } else {
                  $sql->db_Write_log(TRIGGERC_NAME, TRIGGER_LAN_202, "upload id=".$row['upload_id']." (".mysql_error().")");
               }
            } else {
               $sql->db_Write_log(TRIGGERC_NAME, TRIGGER_LAN_203, mysql_error());
            }

            if ($pref["trigger_fup_remove"] == 1) {
               $sql->db_Update("upload", "upload_active='1' WHERE upload_id='".$row['upload_id']."'");
            }
         }
      }
   }

   // *********************************************************************************************
   // Admin pages
   // *********************************************************************************************

   /**
    * Get the admin menu
    */
   function getAdminMenu() {
      global $trigger_adminmenu, $pageid;
      show_admin_menu(TRIGGERC_NAME, $pageid, $trigger_adminmenu);
   }

   /**
    * Generate the admin preferences page
    */
   function getAdminPage() {
      global $trigger_adminmenu, $pageid, $e107HelperForm, $pref;

      $pageid = e_QUERY ? e_QUERY : 10;
      $title  = TRIGGERC_NAME.$pref["trigger_separator"].$trigger_adminmenu["TRIGGERC_ADMIN_PAGE_".$pageid]["text"];
      if ($trigger_adminmenu["TRIGGERC_ADMIN_PAGE_".$pageid]["form"]) {
         // Create and process a form using the helper classes
         $e107HelperForm->createFormFromXML("forms/prefs_".$pageid);
         $e107HelperForm->processForm(true, true);
         $text = $e107HelperForm->getFormHTML();
      } else {
         include("admin_prefs_$pageid.php");
      }
      $pageid = e_QUERY ? "TRIGGERC_ADMIN_PAGE_".e_QUERY : "TRIGGERC_ADMIN_PAGE_10";
      return array($title, $text);
   }

   /**
    * Forum list
    */
   function triggerForums($params=false) {
      global $sql,$sql2;
      $forums = array();
      $forums[] = array(0, "");
      if ($sql->db_Select("forum", "*", "forum_parent='0' ORDER BY forum_order ASC")) {
         while ($row = $sql->db_Fetch()) {
            if ($sql2->db_Select("forum", "*", "forum_parent='".$row["forum_id"]."' ORDER BY forum_order ASC")) {
               while ($row2 = $sql2->db_Fetch()) {
                  $forums[] = array($row2["forum_id"], $row2["forum_name"]." ".TRIGGER_LAN_01." ".$row["forum_name"]);
               }
            }
         }
      }
      return $forums;
   }
}

function triggerDebug($prefix) {
   global $sql;
   $backtrace = debug_backtrace();
   //print "<pre>".$backtrace[0]["line"]." ".$backtrace[1]["function"]."() : ";
   $sql->db_Mark_Time($prefix.$backtrace[1]["function"]."(), ".$backtrace[2]["function"]."()");
}

// An global instance of the trigger class
global $trigger;
$trigger = new trigger();
?>