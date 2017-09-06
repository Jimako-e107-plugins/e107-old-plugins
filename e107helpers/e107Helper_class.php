<?php
/**
 * e107 Helper class
 * <b>CVS Details:</b>
 * <ul>
 * <li>$Source: e:\_repository\e107_plugins/e107helpers/e107Helper_class.php,v $</li>
 * <li>$Date: 2008/05/29 22:01:34 $</li>
 * </ul>
 * @author     $Author: Neil $
 * @version    $Revision: 1.10.2.4 $
 * @copyright  Released under the terms and conditions of the GNU General Public License (http://gnu.org).
 * @package e107Helper
 */

/**
 * A Helper class for the e107 CMS system.
 * Aimed at providing seemless integration for plugins to e107 v0.617 and v0.7.
 * Where there are differences, the standard function names, data formats, etc. from v0.7 are used.
 * @package e107Helper
 */
class e107Helper {
   /**#@+
    * @access private
    */
   var $e107v7;         // Boolean flag indicating e107 v0.7 (true) or not (false)

   var $textparser;     // A Text parser object
   var $userclasslist;  // A comma separated list of classes available to the current user

   var $_xml;
   /**#@-*/

   /**
    * Constructor
    */
   function __construct() {
      // OK, this is not ideal but I need to read this file without including it so it doesn't screw
      // up version reporting in e107 admin area (when file is required once by admin_siteinfo.sc).
      $content = file_get_contents(e_ADMIN."ver.php");
      $start = strpos($content, "e107info")-1;
      $content = substr($content, $start, strpos($content, ";", $start)-$start+1);
      eval($content);

      // Use a regular expression here?
      $this->e107v7 = true;

      // Set some initial values
      $this->_xml = "";
   }

   // ************************************************
   // Miscellaneous Helper Functions
   // ************************************************

   /**
    * @return true if current version of e107 is v0.7, otherwise false
    */
   function isV07() {
      return $this->e107v7;
   }

   /**
    * Get a comma separated list of classes available to the current user
    * @return a comma separated string of classes available to the current user
    */
   function getUserClassList() {
      if (!isset($this->userclasslist)) {
         // Initialize value first time in
         if ($this->isV07()) {
            $this->userclasslist = USERCLASS_LIST;
         } else {
            // For 0.617 we have to append standard classes the user has to the list of user classes they have
            $this->userclasslist = strtr(USERCLASS, ".", ",");
            $this->userclasslist .= check_class(e_UC_MEMBER  ) ? ",".e_UC_MEMBER   : "";
            $this->userclasslist .= check_class(e_UC_GUEST   ) ? ",".e_UC_GUEST    : "";
            $this->userclasslist .= check_class(e_UC_PUBLIC  ) ? ",".e_UC_PUBLIC   : "";
            $this->userclasslist .= check_class(e_UC_NOBODY  ) ? ",".e_UC_NOBODY   : "";
            $this->userclasslist .= check_class(e_UC_ADMIN   ) ? ",".e_UC_ADMIN    : "";
            $this->userclasslist .= check_class(e_UC_READONLY) ? ",".e_UC_READONLY : "";
         }
      }
      return $this->userclasslist;
   }

   /**
    * Get a list of all directories in a directory/folder
    * @param   string   name of directory/folder to get directory list For
    * @return  array    list of directories
    */
   function getDirList($dir) {
      $handle = opendir($dir);
      while ($file = readdir($handle)) {
         if (is_dir($dir.$file) && $file !='CVS' && $file != "." && $file != ".." && $file != "/" ) {
            $dirs[] = $file;
         }
      }
      closedir($handle);
      sort($dirs);
      return $dirs;
   }

   /**
    * Get a list of all files in a directory/folder
    * @param   string   name of directory/folder to get file list For
    * @return  array    list of filenames
    */
   function getFileList($dir) {
      if (substr(strrev($dir), 0, 1) != "/") {
         $dir .= "/";
      }
      $handle = opendir($dir);
      while ($file = readdir($handle)) {
         if (is_file($dir.$file) && (preg_match("%".".jpg"."%i",$file) || preg_match("%".".gif"."%i",$file) || preg_match("%".".png"."%i",$file))) {
            $files[] = $file;
         }
      }
      closedir($handle);
      sort($files);
      return $files;
   }

   // ************************************************
   // Text Parser Class Helper Functions
   // ************************************************

   /** @access private */
   function _initTextParser() {
      if (!isset($this->textparser)) {
         // Initialize value first time in
         if ($this->isV07()) {
            $this->textparser = new e_parse();
         } else {
            $this->textparser = new textparse();
         }
      }
   }

   /**
    * Convert to something suitable for storing in the database
    * @param $txt the text to convert
    * @return the converted text as a string
    */
   function tp_toDB($txt) {
      $this->_initTextParser();
      if ($this->isV07()) {
         return $this->textparser->toDB($txt);
      } else {
         return $this->textparser->formtpa($txt);
      }
   }

   /**
    * Convert to something suitable for displaying on a page as static text
    * @param string  the text to convert
    * @param boolean true if text to parse contains BB codes
    * @param integer truncate length, 0 means no truncation
    * @param string  text to be appended if original text is trncated to $len
    * @return the converted text as a string
    */
   function tp_toHTML($txt, $parseBB=false, $len=0, $more="[more]") {
      $this->_initTextParser();
      if ($this->isV07()) {
          $ret = $this->textparser->toHTML($txt, $parseBB);
      } else {
         $ret = $this->textparser->tpa($txt);
      }
      if ($len > 0) {
         $ret = $this->textparser->html_truncate($ret, $len, $more);
      }
      return $ret;
   }

   /**
    * Convert to something suitable for displaying in an HTML form (i.e. editable text)
    * @param $txt the text to convert
    * @return the converted text as a string
    */
   function tp_toForm($txt) {
      $this->_initTextParser();
      if ($this->isV07()) {
         return $this->textparser->toForm($txt);
      } else {
         return $this->textparser->formtparev($txt);
      }
   }

   /**
    * Convert to plain text
    * @param $txt the text to convert
    * @return the converted text as a string
    */
   function tp_toText($txt) {
      $this->_initTextParser();
      if ($this->isV07()) {
         return $this->textparser->toText($txt);
      } else {
         return $this->textparser->formtparev($txt);
      }
   }

   // ************************************************
   // Comment Helper Functions
   // ************************************************

   /**
    * Get number of comments for an item.
    * <p>This method returns the number of comments for the supplied plugin/item id.</p>
    * @param   string   a unique ID for this plugin, maximum of 10 character
    * @param   int      id of the item comments are allowed for
    * @return  int      number of comments for the supplied parameters
    */
   function getCommentTotal($pluginid, $id) {
      global $pref, $e107cache, $tp;
      $query = "where comment_item_id='$id' AND comment_type='$pluginid'";
      $mysql = new db();
      return $mysql->db_Count("comments", "(*)", $query);
   }

   /**
    * Add comments to a plugins
    * <p>This method returns the HTML for a comment form. In addition, it will post comments to the e107v7
    * comments database and get any existing comments for the current item.</p>
    * @param   string   a unique ID for this plugin, maximum of 10 character
    * @param   int      id of the item comments are allowed for
    * @return  string   HTML for existing comments for an item and the comments form to allow new comments to be posted
    */
   function getComment($pluginid, $id) {
      global $pref, $e107cache, $tp;

      // Include the comment class. Normally, this file is included at a global level, so we need to make the variable
      // it decalares global so it is available inside the comment class
      require_once(e_HANDLER."comment_class.php");
      //require(e_CORE."shortcodes/batch/comment_shortcodes.php");
      $GLOBALS["comment_shortcodes"] = $comment_shortcodes;

      $pid = 0; // What is this w.r.t. comment table? Parent ID?

      // Define a comment object
      $cobj = new comment();

      // See if we need to post a comment to the database
      if (isset($_POST['commentsubmit'])) {
         $cobj->enter_comment($_POST['author_name'], $_POST['comment'], $pluginid, $id, $pid, $_POST['subject']);
         if ($pref['cachestatus']){
            $e107cache->clear("comment.$pluginid.{$sub_action}");
         }
      }

      // Specific e107 0.617 processing to render existing comments
      if (!$this->isV07()) {
         $query = $pref['nested_comments'] ?
            "comment_item_id='$id' AND comment_type='$pluginid' AND comment_pid='0' ORDER BY comment_datestamp" :
            "comment_item_id='$id' AND comment_type='$pluginid' ORDER BY comment_datestamp";
         unset($text);
         $mysql = new db();
         if ($comment_total = $mysql->db_Select("comments", "*", $query)) {
            $width = 0;
            while ($row = $mysql->db_Fetch()) {
               // ** Need to sort out how to do nested comments here
               if ($pref['nested_comments']) {
                  $text .= $cobj->render_comment($row, $pluginid, "comment", $id, $width, $subject, true);
               } else {
                  $text .= $cobj->render_comment($row, $pluginid, "comment", $id, $width, $subject, true);
               }
            }
            if (ADMIN && getperms("B")) {
               $text .= "<div style='text-align:right'><a href='".e_ADMIN."modcomment.php?$pluginid.$id'>".LAN_314."</a></div>";
            }
         }
      }

      // Get comment form - e107 sends this to the output buffer so we must grab it and assign to our return string
      ob_start();
      if ($this->isV07()) {
         // e107 0.7
         $cobj->compose_comment($pluginid, "comment", $id, $width, $subject, false);
      } else {
         // e107 0.617
         if (strlen($text) > 0) {
            $ns = new e107table();
            $ns->tablerender(LAN_5, $text);
         }
         $cobj->form_comment("comment", $pluginid, $id, $subject, $content_type);
      }
      $text = ob_get_contents();
      ob_end_clean();

      return $text;
   }

   /**
    * Add ratings to a plugins
    * <p>This method returns the HTML for a ratings form. In addition, it will post ratings to the e107v7
    * ratings database and get any existing ratings for the current item.</p>
    * @param   string   a unique ID for this plugin, maximum of 10 character
    * @param   int      id of the item comments are allowed for
    * @param   boolean  true to show the rating selection drop down if user not already rated this item
    * @return  string   HTML for existing comments for an item and the comments form to allow new comments to be posted
    */
   function getRating($pluginid, $id, $allowrating=true, $notext=false) {
      $rater = new rater();

      $text = "";
      if ($ratearray = $rater->getrating($pluginid, $id)) {
         for ($c=1; $c<=$ratearray[1]; $c++) {
            $text .= "<img src='".e_IMAGE."rate/".IMODE."/star.png' alt='' />";
         }
         if ($ratearray[2]) {
            $text .= "<img src='".e_IMAGE."rate/".IMODE."/".$ratearray[2].".png'  alt='' />";
         }
         if ($ratearray[2] == "") {
            $ratearray[2] = 0;
         }
         if (!$notext) {
            $text .= "&nbsp;".$ratearray[1].".".$ratearray[2]." - ".$ratearray[0]."&nbsp;";
            $text .= ($ratearray[0] == 1 ? HELPER_RATELAN_0 : HELPER_RATELAN_1);
         }
      } else {
         $text .= HELPER_RATELAN_4;
      }

      if ($allowrating) {
         if (!$rater->checkrated($pluginid, $id) && USER) {
            $ratetext = $rater->rateselect("&nbsp;&nbsp;&nbsp;&nbsp;<b>".HELPER_RATELAN_2, $pluginid, $id)."</b>";
            if (!$this->isV07()) {
               $ratetext = str_replace("rate.php", "../../rate.php", $ratetext);
            }
            $text .= $ratetext;
         } else if (!USER) {
            $text .= "&nbsp;";
         } else {
            $text .= "&nbsp;-&nbsp;".HELPER_RATELAN_3;
         }
      }

      return $text;
   }


   /**
    * Add ratings to a plugins
    * <p>This method returns the HTML for a ratings form. In addition, it will post ratings to the e107v7
    * ratings database and get any existing ratings for the current item.</p>
    * @param   string   a unique ID for this plugin, maximum of 10 character
    * @param   int      id of the item comments are allowed for
    * @param   boolean  true to show the rating selection drop down if user not already rated this item
    * @param   boolean  true to show all 10 stars for the rating value, false only shows as many stars as the rating score
    * @param   integer  width of 'star' image
    * @param   integer  height of 'star' image
    * @return  string   HTML for existing comments for an item and the comments form to allow new comments to be posted
    */
   function getRating2($pluginid, $id, $allowrating=true, $notext=false, $allstars=false, $width=21, $height=20) {
      $rater = new rater();
      $ratearray = $rater->getrating($pluginid, $id);
      $starwidth = $width;
      $starheight = $height;
      $divid = "ratediv{$id}";
      $notrated = true;

      $text .= "<div id='$divid' style='vertical-align:bottom;'>";
      if ($ratearray = $rater->getrating($pluginid, $id)) {
         $text .= "<table cellpadding='0' cellspacing='0' style='display:inline'><tr>";
         for ($i=1; $i<11; $i++) {
            if ($i <= $ratearray[1]) {
               $text .= "<td><img src='".THEME."images/star_rating_selected.gif' alt='Rate star $i'/></td>";
            } elseif ($i <= $ratearray[1]+1 && $ratearray[2]) {
               $divwidth = ceil($starwidth * ($ratearray[2]/10));
               $text .= "<td><div style='width:{$divwidth}px;overflow:hidden'><img src='".THEME."images/star_rating_selected.gif' alt='Rate star $i.".$ratearray[2]."'/></div></td>";
            } elseif ($allstars) {
               $text .= "<td><img src='".THEME."images/star_rating.gif' alt='Rate star $i'/></td>";
            }
         }
         if (!$notext) {
            $text .= "<td style='vertical-align:top;'>&nbsp;".$ratearray[1].".".$ratearray[2]." - ".$ratearray[0]."&nbsp;";
            $text .= ($ratearray[0] == 1 ? HELPER_RATELAN_0 : HELPER_RATELAN_1);
            $text .= "</td>";
         }
         $text .= "</tr></table><br/>";
         $notrated = false;
      }
      if ($allowrating) {
         if (!$rater->checkrated($pluginid, $id) && USER) {
            $self = varset($_SERVER['PHP_SELF'], $_SERVER['SCRIPT_FILENAME']);
            $url = "{$pluginid}^{$id}^".$self."?".e_QUERY."";
            $style .= "height:{$starheight}px;";
            $style .= "width:{$starwidth}px;";
            $style .= "cursor:pointer;";
            if (strlen($rated) > 0) {
               $text .= "<br/>";
            }
            $text .= "<strong>".HELPER_RATELAN_2."</strong>";
            $prefix = $pluginid.$id."_";
            for ($i=1; $i<11; $i++) {
               $events = " onmouseout='e107Helper.rateStars(\"".THEME."images\", \"$prefix\", $i, 0);'";
               $events .= " onmouseover='e107Helper.rateStars(\"".THEME."images\", \"$prefix\", $i, 1);'";
               $events .= " onclick='e107HelperAjax.rate(\"".e_PLUGIN."e107helpers/e107HelperAjax.php\", \"{$url}^{$i}\", \"$divid\", \"$pluginid\", \"$id\", \"$allowrating\", \"$notext\", \"$allstars\", {$i})'";
               $text .= "<img src='".THEME."images/star_rating.gif' id='$prefix{$i}' $onclick $events style='$style' alt='Rate this $i' title='Rate this $i'/>";
            }
         } elseif (USER && !$notext) {
            $text .= HELPER_RATELAN_3;
         } elseif (!$notext) {
            $text .= HELPER_RATELAN_6;
         }
      } elseif (!$notext && $notrated) {
         $text .= HELPER_RATELAN_4;
      }

      $text .= "</div>";
      return $text;
   }

   /**
    *
    * @param
    * @param
    * @param
    * @param
    * @return  string   the HTML
    */
   function getInlineEdit($fieldname, $fieldid, $fieldtext, $jsfunc, $type="text", $class=false, $originaltext=false, $prefix="", $postfix="") {
      $text = "";
      $text .= "<span id='e107helper_{$fieldname}'";
      if ($class) {
         $text.= " class='$class'";
      }
      $text .= ">";
      $text .= "<a id='e107helper_{$fieldname}_a' href='#' onclick='e107Helper.editInline(\"{$type}\", \"{$fieldid}\", \"{$fieldname}\", \"{$jsfunc}\", \"{$prefix}\", \"{$postfix}\");return false;'>";
      $text .= "<img src='".e_IMAGE."admin_images/edit_16.png' alt='*' title='Click to edit' style='cursor:pointer;vertical-align:middle;'/>";
      $text .= "</a>&nbsp;";
      $text .= "<span id='e107helper_{$fieldname}_text'>";
      $text .= (strlen($fieldtext) > 0) ? $fieldtext : HELPER_LAN_18;
      $text .= "</span>";
      if (false != $originaltext) {
         $text .= "<span id='e107helper_{$fieldname}_hiddentext' style='display:none;'>";
         $text .= $originaltext;
         $text .= "</span>";
      }
      $text .= "</span>";
      return $text;
   }

   /**
    * Add an image that toggles the actual picture on each mouse click
    * <p>This method returns the HTML for a toggle image.</p>
    * @param   int      id to be used for the containing DIV
    * @param   img1     valid path to the main image
    * @param   img1     valid path to the image to be toggled to
    * @return  string   HTML for the images, with appropriate JavaScript calls
    */
   function getToggleImage($id, $img1, $img2) {
      return "<div id='$id'><img src='$img1' border='0' alt='*' onclick='e107HelperAjax.toggleImage(\"".e_PLUGIN."e107helpers/e107HelperAjax.php\", \"$id\", \"$img1\", \"$img2\")'/></div>";
   }

   /**
    * Generate HTML for a textarea
    * <p>Allows control of various display options including BB helper toolbar and emote icon helper toobar.</p>
    * @param   text        the text to be displayed in the textarea
    * @param   name        name attribute for the textarea (defaults to e107heleprTA)
    * @param   class       style class attribute value (defaults to tbox)
    * @param   rows        number of row to be displayed (defaults to 15)
    * @param   cols        number of columns to be displayed (defaults to false, meaning no cols attribute required)
    * @param   width       width of the textarea (e.g. 98%, 400px) (defaults to false, meaning no width required)
    * @param   showBBCodes display textarea BB code toolbar 1=yes, 2=yes with help (defaults to false, meaning no toolbar)
    * @param   showEmotes  display emote icon toobar (true) or not (false, the default)
    * @param   resize      should the textarea resize to fit content (true) or not (false)
    * @return  string      the HTML for the textarea
    */
   function getTextarea($tatext="", $name="e107heleprTA", $class="tbox", $rows="15", $cols=false, $width=false, $showBBCodes=false, $showEmotes=false, $resize=false) {
      $text = "";
      $id = preg_replace("/[\s !\"£$%^&*\(\)-=+{}\[\]:@~;'#<>?,\.\/]/i", "_", html_entity_decode(strtolower($name), ENT_QUOTES)); 
      $text .= "<textarea name='$name' id='$id' class='$class' rows='$rows' cols='$cols' onselect='storeCaret(this);' onclick='storeCaret(this);'";
      if ($width) {
         $text .= " style='width:$width;'";
      }
      //$text .= " onkeydown='resizeTextArea(\"$name\");'";
      $resize = $resize ? "resizeTextArea(this);" : "";
      $text .= " onkeyup='{$resize}storeCaret(this);'";
      $text .= ">$tatext</textarea>";

      if ($showBBCodes!=false) {
         if ($this->isV07()) {
            preg_match_all("/^.*\.(.*)$/", microtime(true), $helpid);
            $helpid = "help".$helpid[1][0];
            if ($showBBCodes==2) {
               global $bbcode_shortcodes, $tp;
               include(e_FILE."shortcode/batch/bbcode_shortcodes.php");
               $text .= $tp->parseTemplate("{BB_HELP=$helpid}", false, $bbcode_shortcodes)."<br/>";
               $text .= display_help($helpid, "e107helper");
            } else {
               $text .= display_help($helpid, 2);
            }
         } else {
            $text .= ren_help($showBBCodes);
         }
      }
      if ($showEmotes) {
         $text .= r_emote();
      }
      return $text;
   }

   /**
    * Send a notification to one or more users.
    * <p>Current implementation just sends a Private Message, so the PM plugin must be enabled.</p>
    * @param   sendto      an array of userid(s) or a sinle userclass (not array) to send notifications to
    * @param   subject     the subject of the message
    * @param   message     the message itself
    * @param   fromid      id of user sending PM (they will get a copy in theor outbox), defaults to 0 (no user)
    * @return  TBC
    * @TODO add option to PM multiple users
    * @TODO add option to PM a userclass
    * @TODO proper return values
    * @TODO localization
    */
   function sendNotification($sendto, $subject, $message, $fromid=0) {
      global $pm_prefs, $pm, $pref, $sysprefs, $tp;

      // Include Private Message class if not already defined
      if (!class_exists("private_message")) {
         if (file_exists(e_PLUGIN."pm/pm_class.php")) {
            require_once(e_PLUGIN."pm/pm_class.php");
            include_lan(e_PLUGIN.'pm/languages/'.e_LANGUAGE.'.php');
         } else {
            return;
         }
      }

      // Check user is allowed to send PMs
      $pm_prefs = $sysprefs->getArray("pm_prefs");
      if (!check_class($pm_prefs['pm_class'])) {
         return NOT_AUTHORIZED;
      }

      // Annotate message with senders details
      if (USERID !== false) {
         $message = "Notification from ".USERNAME."\n\n".$message;
      } else {
         $message = "Notification from Guest\n\n".$message;
      }

      $pm = new private_message();
      if (is_array($sendto)) {
         // Array of userids to PM
         $mysql = new e107helperDB();
         if (!$mysql->db_Select("user", "user_id, user_name, user_class, user_email", "user_id=$sendto")) {
            return USER_NOT_FOUND;
         }
         $touser = $mysql->db_Fetch();

         $vars = array(
            "pm_subject"      => $subject,
            "pm_message"      => $message,
            "from_id"         => $fromid,
            "to_info"         => array(
               "user_id"      => $touser["user_id"],
               "user_name"    => $touser["user_name"],
               "user_email"   => $touser["user_email"]
            )
         );
      } else {
         // It's a userclass to notify
         $vars = array(
            "pm_subject"      => $subject,
            "pm_message"      => $message,
            "from_id"         => $fromid,
            "to_userclass"    => 1,
            "pm_userclass"    => $sendto
         );
      }
      return $pm->add($vars);
   }

   /**
    * @deprecated e107Helper now uses e_meta.php and requires jshelpers plugin
    */
   function getHeaderFiles() {
      //global $e107Helper, $e107HelperForm, $footer_js, $incDHTMLCalendarJS;
      //
      //$text = "";
      //if (strpos(e_SELF, "admin_") > 0) {
      //   // For admin pages
      //   print "\n<script type='text/javascript' src='".e_PLUGIN_ABS.'e107helpers/e_ajax.js'></script>";
      //   print "\n<script type='text/javascript' src='".e_PLUGIN_ABS."e107helpers/firebug/firebugx.js'></script>";
      //   print "\n<script type='text/javascript' src='".e_PLUGIN_ABS."e107helpers/prototype/prototype.js'></script>";
      //   print "\n<script type='text/javascript' src='".e_PLUGIN_ABS."e107helpers/scriptaculous-js/scriptaculous.js'></script>\n";
      //} else {
      //   // For main site pages
      //   $footer_js[] = e_PLUGIN_ABS.'e107helpers/e_ajax.js';
      //   $footer_js[] = e_PLUGIN_ABS."e107helpers/firebug/firebugx.js";
      //   $footer_js[] = e_PLUGIN_ABS."e107helpers/prototype/prototype.js";
      //   $footer_js[] = e_PLUGIN_ABS."e107helpers/scriptaculous-js/scriptaculous.js";
      //}
      //$text .= "\n<script type='text/javascript' src='".e_PLUGIN_ABS."e107helpers/e107helper.js'></script>\n";
      //
      //if (class_exists("DHTML_Calendar") && $incDHTMLCalendarJS == true) {
      //   $temp = new DHTML_Calendar(true);
      //   //$footer_js[] = $temp->load_files();
      //   $text .= $temp->load_files();
      //}
      //return $text;
   }

   /**
    * Experimental, subject to change
    */
   function getChart($xmlFile, $w=400, $h=250) {
      $url = e_PLUGIN."e107helpers/charts.swf?library_path=".e_PLUGIN."e107helpers/charts_library&xml_source=".$xmlFile."?uniqueID=".uniqid(rand(),true);
      $id = "chart".time();
      $text .= "<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000'";
      $text .= " codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0'";
      $text .= " width='$w'";
      $text .= " height='$h'";
      $text .= " id='$id'";
      $text .= " align=''>";
      $text .= "<param name=movie value='".$url."'>";
      $text .= "<param name=quality value=high>";
      $text .= "<param name=bgcolor value=#666666>";
      $text .= "<embed src='".$url."'";
      $text .= " quality=high";
      $text .= " bgcolor=#666666";
      $text .= " width='$w'";
      $text .= " height='$h'";
      $text .= " name='$id'";
      $text .= " align=''";
      $text .= " swLiveConnect='true'";
      $text .= " type='application/x-shockwave-flash'";
      $text .= " pluginspage='http://www.macromedia.com/go/getflashplayer'>";
      $text .= "</embed>";
      $text .= "</object>";
      return $text;
   }

   // experimental - subject to change
   function getTooltip($content, $caption=false, $style=false, $id="e107helper_tooltip") {
      global $tp;

      $container_class  = varset($style["container-class"], "forumheader ttContainer");
      $container_style  = varset($style["container-style"], ""); // TODO how can this be passed to the JavaScript
      $caption_class    = varset($style["caption-class"],   "forumheader2 ttCaption");
      $caption_style    = varset($style["caption-style"],   "");
      $content_class    = varset($style["content-class"],   "forumheader3 ttContent");
      $content_style    = varset($style["content-style"],   "");
      $display_events   = varset($style["display_events"],  "onmouseover");
      $destroy_events   = varset($style["destroy_events"],  "onmouseout");
      $min_width        = varset($style["min-width"], 0);
      $max_width        = varset($style["max-width"], 0);
      $content_style .= ";overflow:hidden;";

      if ($caption) {
         $content = "<div class='$caption_class' style='$caption_style'>$caption</div><div class='$content_class' style='$content_style'>$content</div>";
      } else {
         $content = "<div class='$content_class' style='$content_style'>$content</div>";
      }
      $content = $tp->toHTML($content, true);
      $content = str_replace("\r\n", "<br/>", $content);
      $content = rawurlencode($content);
      $text = " onmouseover='e107Helper.tooltipDisplay(event, this, \"$id\", \"$content\", \"$container_class\", $min_width, $max_width);'";
      $text .= " onmouseout='e107Helper.tooltipDestroy(event, \"$id\");'";
      return $text;
   }

   /**
    * Get the name of a template
    * Looks in the following places:
    * <ul>
    * <li>theme/plugin_name/ (useful for keeping custom templates for 3rd party plugins separate)</li>
    * <li>theme/templates/ (theme specific versions of core templates?)</li>
    * <li>theme/ (don't like this, maybe only for backward compatibility if essential )</li>
    * <li>current_plugin_dir/templates/</li>
    * <li>current_plugin_dir/</li>
    * <li>e107_theme/templates</li>
    * </ul>
    * @param $name         the name of the template to find (without the '.php' extension)
    * @param $pluginname   the name of the plugin folder to search
    * @param $default      the name of the default template
    * @return              path to the template if found, otherwise the supplied default value
    */
   function getTemplate($name, $pluginname="", $default="") {
      global $pref;

      $name .= ".php";
      $locations = array (
         THEME."$pluginname/$name",
         THEME."templates/$name",
         THEME."$name",
         e_PLUGIN."$pluginname/templates/$name",
         e_PLUGIN."$pluginname/$name",
         e_THEME."templates/$name"
      );

      foreach($locations as $location) {
         if (file_exists($location)) {
            return $location;
         }
      }

      return $default;
   }

   /**
    * Gets a list of templates the following places:
    * <ul>
    * <li>theme/plugin_name/ (useful for keeping custom templates for 3rd party plugins separate)</li>
    * <li>theme/templates/ (theme specific versions of core templates?)</li>
    * <li>theme/ (don't like this, maybe only for backward compatibility if essential )</li>
    * <li>current_plugin_dir/templates/</li>
    * <li>current_plugin_dir/</li>
    * <li>e107_theme/templates</li>
    * </ul>
    * @param $prefix       template prefix, teamplate names are assumed to be [prefix]_*_template.php
    * @param $pluginname   plugin directory to search
    * @param $ignore       text to be ignored if found in template name (between prefix and _template
    * @return              an array of templates, each is an array with elements 'path' and 'name'
    */
   function getTemplateList($prefix, $pluginname="wontfindanythinghere:)", $ignore="\*") {
      global $pref;

      $locations = array (
         e_THEME.$pref["sitetheme"]."/$pluginname/",
         e_THEME.$pref["sitetheme"]."/templates/",
         e_THEME.$pref["sitetheme"]."/",
         e_PLUGIN."$pluginname/templates/",
         e_PLUGIN."$pluginname/",
         e_THEME."templates/"
      );

      $templates = array();
      foreach ($locations as $location) {
         $handle = opendir($location);
         while ($file = readdir($handle)) {
            if (preg_match_all("/^".$prefix."_(.*[^".$ignore."])_template\.php$/", $file, $match, PREG_PATTERN_ORDER) != false) {
               unset($template_name);
               $template = $location.$prefix."_".$match[1][0]."_template.php";
               include($template);
               if (isset($template_name)) {
                  $templates[$match[1][0]] = array($template, $template_name);
               } else {
                  $templates[$match[1][0]] = array($template, $match[1][0]);
               }
            }
         }
         closedir($handle);
      }
      // Sort?
      return $templates;
   }

   /**
    * Add a user class to a user
    * @param   $userid     user ID to be affected
    * @param   $userclass  user class to be added
    * @return  0 - all OK
    *          1 - trying to set a 'standard/core' userclass
    *          2 - $userid not found in user table
    *          3 - user already has the class
    *          4 - specified userclass does not exist in userclass_classes table
    */
   function addUserClass($userid, $userclass, $ignoreEdit=false) {
      global $sql;

      if ($userclass == e_UC_PUBLIC || $userclass >= e_UC_MAINADMIN) {
         // Disallow setting of 'standard' classes
         return 1;
      }

		$qry = "SELECT user_class FROM #user AS u WHERE u.user_id='{$userid}'";
		if (!$sql->db_Select_gen($qry)) {
		   return 2;
	   }
   	$row = $sql->db_Fetch();
      $userClassRegEx = "/(^|,)(".str_replace(",", "|", $row['user_class']).")(,|$)/";
      if (preg_match($userClassRegEx, $userclass) > 0) {
         // Already has class
         return 3;
      }

   	if (!$sql->db_Select("userclass_classes", "*", "userclass_id = {$userclass}")) {
   	   // Class does not exist
   	   return 4;
   	}

      $arr = strlen($row["user_class"]) > 0 ? explode(",", $row['user_class']) : array();
      $arr[count($arr)] = $userclass;
      sort($arr);
      $newclasses = implode(",", $arr);
   	$res = $sql->db_Update("user", "user_class='$newclasses' WHERE user_id='$userid'");
   	return 0;
   }

   /**
    * Remove a user class from a user
    * @param   $userid     user ID to be affected
    * @param   $userclass  user class to be removed
    * @return  0 - all OK
    *          1 - $userid not found in user table
    *          2 - user does not have the class
    */
   function removeUserClass($userid, $userclass) {
      global $sql;
		$qry = "SELECT user_class FROM #user AS u WHERE u.user_id='{$userid}'";
		if (!$sql->db_Select_gen($qry)) {
		   return 1;
	   }
   	$row = $sql->db_Fetch();
      $userClassRegEx = "/(^|,)(".str_replace(",", "|", $row['user_class']).")(,|$)/";
      if (preg_match($userClassRegEx, $userclass) == 0) {
         // Doesn't have class
         return 2;
      }

      $arr = explode(",", $row['user_class']);
      for ($i=0; $i<count($arr); $i++) {
         if ($arr[$i] == $userclass) {
            unset($arr[$i]);
            break;
         }
      }
      $newclasses = implode(",", $arr);
   	$res = $sql->db_Update("user", "user_class='$newclasses' WHERE user_id='$userid'");
   	return 0;
   }

   /*
    * Helper functions for formatting and sending Ajax messages
    */
   // TODO remove deprecated functions once removed from calling plugins
   /**
    * @deprecated - use ajaxAdd*()/ajaxSend() instead
    */
   function ajaxBegin() {
      return HELPER_AJAX_MSG_BEGIN;
   }
   /**
    * @deprecated - use ajaxAdd*()/ajaxSend() instead
    */
   function ajaxEnd() {
      return HELPER_AJAX_MSG_END;
   }
   /**
    * @deprecated - use ajaxAdd*()/ajaxSend() instead
    */
   function ajaxAlert($message) {
      return "<response type='alert'><![CDATA[$message]]></response>";
   }
   /**
    * @deprecated - use ajaxAdd*()/ajaxSend() instead
    */
   function ajaxInnerHTML($id, $html, $effect="none", $id2="") {
      // TODO - better parameter handling - use array of options?
      return "<response type='innerhtml' id='$id' effect='$effect' duration='0.5' id2='$id2'><![CDATA[$html]]></response>";
   }
   /**
    * @deprecated - use ajaxAdd*()/ajaxSend() instead
    */
   function ajaxKillMessage($id) {
      return "<response type='killmessage' id='$id'></response>";
   }

   /**
    * Add a response to (re-)populate part of a pages
    * @param $html the HTML
    */
   function ajaxAddInnerHTML($html, $id="leagman_content", $effect="none", $id2="") {
      $this->_xml .= "<response type='innerhtml' id='$id' effect='$effect' duration='0.5' id2='$id2'><![CDATA[$html]]></response>";
   }

   /**
    *
    * @param
    */
   function ajaxAddAlert($text) {
      $this->_xml .= "<response type='alert'>$text</response>";
   }

   /**
    *
    * @param
    */
   function ajaxAddDialog($html, $id) {
      $this->_xml .= "<response type='dialog' id='$id' effect='$effect' duration='0.5' id2='$id2'><![CDATA[$html]]></response>";
   }

   /**
    *
    * @param
    */
   function ajaxAddJavaScript($text) {
      $this->_xml .= "<response type='js'>$text</response>";
   }

   /**
    *
    * @param
    */
   function ajaxAddKillMessage($id) {
      $this->_xml .= "<response type='killmessage' id='$id'></response>";
   }

   /**
    *
    */
   function ajaxReset() {
      $this->_xml = "";
   }

   /**
    *
    */
   function ajaxSend() {
      header('Content-type: text/xml');
      echo HELPER_AJAX_MSG_BEGIN;
      echo $this->_xml;
      echo HELPER_AJAX_MSG_END;
   }
}
?>