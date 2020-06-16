<?php
if (!class_exists("UserJournals")) {
   include_lan(e_PLUGIN."userjournals_menu/languages/English.php");
   include_lan(e_LANGUAGEDIR."English/lan_user.php");

   require_once(e_PLUGIN."userjournals_menu/userjournals_shortcodes.php");
   global $pref;
   if (file_exists($pref["userjournals_template"])) {
      require_once($pref["userjournals_template"]);
   } else {
      require_once(e_PLUGIN."userjournals_menu/templates/default.php");
   }

   class UserJournals {

      var $cats;
      var $mood;
      var $user;

      function UserJournals($mainpage=false) {
         global $sql;
         $this->mood = array(
            //''           => UJ68,
            'happy'      => UJ69,
            'sad'        => UJ70,
            'alienated'  => UJ71,
            'beat_up'    => UJ72,
            'angry'      => UJ73,
            'annoyed'    => UJ74,
            'chicken'    => UJ75,
            'confused'   => UJ76,
            'crying'     => UJ77,
            'doh'        => UJ78,
            'evil'       => UJ79,
            'funny'      => UJ80,
            'greedy'     => UJ81,
            'hungry'     => UJ82,
            'puzzled'    => UJ83,
            'innocent'   => UJ84,
            'shocked'    => UJ85,
            'sick'       => UJ86,
            'sleepy'     => UJ87,
            'very_happy' => UJ88,
         );

         $this->user = false;

         // Get all categories - we need these all ove rthe place
         if ($sql->db_Select("userjournals_categories", "*", "ORDER BY userjournals_cat_name ASC", false)) {
            while ($row = $sql->db_Fetch()) {
               $this->cats[$row["userjournals_cat_id"]] = $row;
            }
         }

         // Only process URL parameters if this is a main page (i.e. not a menu)
         if ($mainpage) {
            $qs   = explode(".", urldecode($_SERVER['QUERY_STRING']));
            if (is_numeric($qs[0])) {
               // Switch params round if 1st is numeric - e107 Next/Prev class inisists on "page number" as 1st URL parameter
               $temp = array_shift($qs);
               array_push($qs, $temp);
            }

            $ujop = varset($qs[0], "bloggers");
            $ujp1 = varset(intval($qs[1]), 0);
            $ujp2 = varset(intval($qs[2]), 0);

            switch ($ujop) {
               case "blogger" : {
                  //$user = getx_user_data($ujp1);
                  $user = e107::user($ujp1); 
                  $page = $this->BloggerPage($ujp1, $user["user_name"], $ujp2);
                  break;
               }
               case "blog" : {
                  $page = $this->BlogPage($ujp1);
                  break;
               }
               case "allblogs" : {
                  $page = $this->AllBlogsPage($ujp1);
                  break;
               }
               case "add" : {
                  $page = $this->BlogAddEdit();
                  break;
               }
               case "edit" : {
                  $page = $this->BlogAddEdit($ujp1);
                  break;
               }
               case "save" : {
                  $page = $this->BlogSave();
                  break;
               }
               case "update" : {
                  $page = $this->BlogUpdate($ujp1);
                  break;
               }
               case "delete" : {
                  $page = $this->BlogDelete($ujp1);
                  break;
               }
               case "synopsis" : {
                  $page = $this->BlogSynopsis();
                  break;
               }
               case "synopsissave" : {
                  $page = $this->BlogSynopsisSave();
                  break;
               }
               case "synopsisupdate" : {
                  $page = $this->BlogSynopsisUpdate();
                  break;
               }
               case "cat" : {
                  $page = $this->CategoryPage($ujp1);
                  break;
               }
               case "allcats" : {
                  $page = $this->AllCategoriesPage();
                  break;
               }
               case "report" : {
                  $page = $this->ReportPage($ujp1);
                  break;
               }
               case "reportit" : {
                  $page = $this->ReportItPage($ujp1);
                  break;
               }
               case "bloggers" : {
                  $page = $this->DefaultPage($ujp1);
                  break;
               }
               default : {
                  $page = $this->DefaultPage(1);
                  break;
               }
            }

            $ns = new e107table();
            $ns->tablerender($page[0], $page[1]);
         }
      }

      function DefaultPage($start=0) {
         global $pref, $tp, $uj_blog, $userjournals_shortcodes, $UJ_BLOGGERS_LIST;

         $sql = new db();
         $text = "";
         if ($pref["userjournals_bloggers_per_page"]) {
            $limit = " limit $start,".$pref["userjournals_bloggers_per_page"];
         }
         $qry = "userjournals_is_comment=0 AND userjournals_is_blog_desc=0 AND userjournals_is_published=0 group by userjournals_userid order by userjournals_timestamp desc";
         if ($count = $sql->db_Select("userjournals", "distinct(userjournals_userid) as userjournals_userid, max(userjournals_timestamp) as userjournals_timestamp", $qry.$limit)) {
            while($uj_blog = $sql->db_Fetch()) {
               $text .= $tp->parseTemplate($UJ_BLOGGERS_LIST, FALSE, $userjournals_shortcodes);
            }
         } else {
            $text = UJ44;
         }

         if ($pref["userjournals_bloggers_per_page"]) {
            $count = $sql->db_Select("userjournals", "distinct(userjournals_userid) as id, max(userjournals_timestamp) as ts", $qry);
            include_once(e_HANDLER."np_class.php");
            $np = new nextprev();
            $text .= $np->nextprev(e_SELF, $start, $pref["userjournals_bloggers_per_page"], $count, "", "bloggers", true);
         }
         return array(UJ43, $text);
      }

      function BloggerPage($bloggerid, $bloggername, $start=0, $msg=false) {
         global $e107Helper, $pref, $sql, $tp, $uj_message, $uj_synopsis, $userjournals_shortcodes, $UJ_MESSAGE, $UJ_BLOGGER_SYNOPSIS;

         $caption = $pref["userjournals_page_title"].UJ25.$bloggername;
         $text = "";
         if ($sql->db_Select("userjournals", "userjournals_userid, userjournals_entry", "userjournals_is_blog_desc=1 AND userjournals_userid=".$bloggerid)) {
            if ($uj_synopsis = $sql->db_Fetch()) {
               //$user = getx_user_data($bloggerid);
               $user = e107::user($bloggerid);
               $text .= $tp->parseTemplate($UJ_BLOGGER_SYNOPSIS, TRUE, $userjournals_shortcodes);
            }
         }

         $start = $start ? $start : 0;
         if ($pref["userjournals_blogs_per_page"]) {
            $limit = " limit $start,".$pref["userjournals_blogs_per_page"];
         }
         $qry = "userjournals_is_comment=0 AND userjournals_is_blog_desc=0 AND userjournals_is_published=0 AND userjournals_userid=$bloggerid order by userjournals_timestamp DESC";
         if ($sql->db_Select("userjournals", "*", $qry.$limit)){
            while ($row = $sql->db_Fetch()){
               $text .= $this->GetBlog($row, $pref["userjournals_len_preview"]);
            }
         } else {
            $text = $this->Message(UJ28);
         }

         if ($msg) {
            $text = $msg.$text;
         }

         if ($pref["userjournals_blogs_per_page"]) {
            $count = $sql->db_Select("userjournals", "*", $qry);
            include_once(e_HANDLER."np_class.php");
            $np = new nextprev();
            $text .= $np->nextprev(e_SELF, $start, $pref["userjournals_blogs_per_page"], $count, "", "blogger.$bloggerid", true);
         }
         return array($caption, $text);
      }

      function BlogPage($blogid) {
         global $pref, $sql;

         if ($sql->db_Select("userjournals", "*", "userjournals_id=$blogid")){
            $text = "";
            if ($row = $sql->db_Fetch()){
               $text .= $this->GetBlog($row);
            } else {
               $text = $this->Message(UJ28);
            }
         } else {
            $text = $this->Message(UJ28);
         }

         //$user = getx_user_data($row["userjournals_userid"]);
         $user = e107::user($row["userjournals_userid"]);
         $caption = $pref["userjournals_page_title"].UJ25.$user["user_name"];
         return array($caption, $text);
      }

      function AllBlogsPage($start) {
         global $pref, $sql;
         $caption = $pref["userjournals_page_title"];

         if ($pref["userjournals_blogs_per_page"]) {
            $limit = " limit $start,".$pref["userjournals_blogs_per_page"];
         }
         $qry = "userjournals_is_blog_desc=0 AND userjournals_is_published=0 ORDER BY userjournals_timestamp DESC";
         if ($sql->db_Select("userjournals", "*", $qry.$limit, true)){
            $text = "";
            if ($row = $sql->db_Fetch()){
               do {
                  $text .= $this->GetBlog($row, $pref["userjournals_len_preview"])."<br/>";
               } while ($row = $sql->db_Fetch());
            } else {
               $text = $this->Message(UJ28);
            }
         } else {
            $text = $this->Message(UJ28);
         }

         if ($pref["userjournals_blogs_per_page"]) {
            $count = $sql->db_Select("userjournals", "*", $qry);
            include_once(e_HANDLER."np_class.php");
            $np = new nextprev();
            $text .= $np->nextprev(e_SELF, $start, $pref["userjournals_blogs_per_page"], $count, "", "allblogs", true);
         }
         return array($caption, $text);
      }

      function GetBlog($blog, $limit=false) {
         global $e107Helper, $pref, $tp, $uj_blog, $uj_categories, $userjournals_shortcodes, $UJ_BLOG, $UJ_BLOG_SHORT;

         $uj_blog = $blog;
         $uj_categories = $this->cats;
         if ($limit) {
            $text = $tp->parseTemplate($UJ_BLOG_SHORT, FALSE, $userjournals_shortcodes);
         } else {
            $text = $tp->parseTemplate($UJ_BLOG, FALSE, $userjournals_shortcodes);
         }
         return $text;
      }

      function BlogAddEdit($blogid=false) {
         global $e107Helper, $pref, $sql;

         if (check_class($pref["userjournals_writers"])) {
            $text = "<form action='".e_SELF."?save' method='post'>";
            if ($blogid) {
               if ($sql->db_Select("userjournals", "*", "userjournals_id=$blogid")){
                  if ($result = $sql->db_Fetch()){
                     extract($result);
                     $text = "<form action='".e_SELF."?update.$blogid' method='post'>";
                  }
               }
            } else {
               $userjournals_subject = "";
               $userjournals_is_published = "";
               $userjournals_categories = "";
               $userjournals_playing = "";
               $userjournals_mood = "";
               $userjournals_entry = "";
            }

            $text .= "<table border='0'>";
            $text .= "<tr><td class='forumheader3' style='width:20%'>".UJ6."</td>";
            $text .= "<td class='forumheader3'><input type='text' class='tbox' name='journal_title' size='42' value='$userjournals_subject'/></td></tr>";
            $checked = $userjournals_is_published==0 ? "checked='checked'" : "";
            $text .= "<tr><td class='forumheader3'>".UJ62."</td>";
            $text .= "<td class='forumheader3'><input type='checkbox' class='tbox' name='journal_published' value='0' $checked/><span class='smalltext'>".UJ63."</span></td></tr>";
            if ($pref["userjournals_show_cats"] != 0) {
               $userjournals_categories = explode(",", $userjournals_categories);
               $text .= "<tr><td class='forumheader3'>".UJ91."</td>";
               $text .= "<td class='forumheader3'><div class='search-checkboxes'>";
               if ($sql->db_Select("userjournals_categories", "*", "ORDER BY userjournals_cat_name ASC", false)) {
                  while ($row = $sql->db_Fetch()) {
                     extract($row);
                     $checked = in_array($userjournals_cat_id, $userjournals_categories) ? " checked='checked'" : "";
                     $text .= "<span class='search-checkbox'><input type='checkbox' class='tbox' name='journal_cat[$userjournals_cat_id]' value='$userjournals_cat_id'$checked/>$userjournals_cat_name</span>";
                  }
               }
               $text .= "</div></td></tr>";
            }
            if ($pref["userjournals_show_playing"] == 1) {
               $text .= "<tr><td class='forumheader3'>".UJ41."</td>";
               $text .= "<td class='forumheader3'><input type='text' class='tbox' name='journal_playing' size='42' value='$userjournals_playing'/><br/><span class='smalltext'>".UJ64."</span></td></tr>";
            }
            if ($pref["userjournals_show_mood"] == 1) {
               $text .= "<tr><td class='forumheader3'>".UJ42."</td><td class='forumheader3'><select class='tbox' name='journal_mood' size='1'>";
               $keys = array_keys($this->mood);
               $selected = $userjournals_mood == "" ? " selected='selected'" : "";
               $text .= "<option value=''$selected></option>";
               foreach ($keys as $key) {
                  $selected = $userjournals_mood == $key ? " selected='selected'" : "";
                  $text .= "<option value='$key'$selected>".$this->mood[$key]."</option>";
               }
               $text .= "</select><br/><span class='smalltext'>".UJ65."</span></td></tr>";
            }
            $text .= "<tr><td class='forumheader3'>".UJ7."</td><td class='forumheader3'>";
            $text .= $e107Helper->getTextarea($userjournals_entry, "journal_entry", "tbox", 15, false, "98%", 2, $pref["smiley_activate"]);
            $text .= "</td></tr>";
            if ($blogid) {
               $text .= "<tr><td class='forumheader3'>".UJ96."</td><td class='forumheader3'>";
               $text .= "<input type='checkbox' class='tbox' name='journal_update_date' value='1' checked='checked'/><span class='smalltext'>".UJ97."</span>";
               $text .= "</td></tr>";
            }
            $text .= "<tr><td colspan='2' class='forumheader3' style='text-align:center;'>";
            if ($blogid) {
               $text .= "<input type='submit' class='button' value='".UJ51."' name='update'/> ";
            } else {
               $text .= "<input type='submit' class='button' value='".UJ2."' name='save'/> ";
            }
            $text .= "<input type='button' class='button' value='".UJ3."' name='cancel' onclick='window.history.back()'/>";
            $text .= "</td></tr></table></form>";
         } else {
            $text = $this->Message(UJ17);
         }

         return array($pref["userjournals_page_title"], $text);
      }

      function BlogSave() {
         global $pref, $sql;
         // Only allow blog writers to save entries
         if (check_class($pref["userjournals_writers"])) {
            if ($_POST["journal_title"] != "" and $_POST["journal_entry"] != "") {
               $parse = new textparse();
               $journal_title       = $parse->formtpa($_POST['journal_title']);
               $journal_published   = isset($_POST['journal_published']) ? 0 : 1;
               $journal_playing     = $parse->formtpa($_POST['journal_playing']);
               $journal_mood        = $parse->formtpa($_POST['journal_mood']);
               $journal_entry       = $parse->formtpa($_POST['journal_entry']);
               $journal_cats        = $_POST["journal_cat"];
               $journal_cats        = implode(",", $journal_cats);

               $thetime = time();
               $gen2 = new convert();
               $thedate = $gen2->convert_date($thetime, "forum");

               $the_sql = "0, '".USERID."','$journal_title','$journal_cats','$journal_playing','$journal_mood','$journal_entry','$thedate','$thetime','0','0','0', $journal_published";
               if ($sql->db_Insert('userjournals', $the_sql)){
                  $text = $this->Message(UJ13);
               } else {
                  $text = $this->Message(UJE02, "SQL ($the_sql) ".@mysql_error());
               }
            } else {
               $text = $this->Message(UJ23.' '.UJ21);
            }
         } else {
            $text = $this->Message(UJ17);
         }

         return $this->BloggerPage(USERID, USERNAME, 0, $text);
      }

      function BlogUpdate($blogid) {
         global $pref, $sql;

         // Only allow blog writers to update entries
         if (check_class($pref["userjournals_writers"])) {
            // Make sure user is only updating their own entries
            if ($sql->db_Select("userjournals", "*", "userjournals_id=$blogid")){
               if ($result = $sql->db_Fetch()){
                  extract($result);
                  if ($userjournals_userid != USERID) {
                     return $this->BloggerPage(USERID, USERNAME, 0, $this->Message(UJ17));
                  }
               }
            }

            if ($_POST["journal_title"] != "" and $_POST["journal_entry"] != "") {
               $parse = new textparse;
               $journal_title    = $parse->formtpa($_POST['journal_title']);
               $journal_published = isset($_POST['journal_published']) ? 0 : 1;
               $journal_playing  = $parse->formtpa($_POST['journal_playing']);
               $journal_mood     = $parse->formtpa($_POST['journal_mood']);
               $journal_entry    = $parse->formtpa($_POST['journal_entry']);
               $journal_cats     = $_POST["journal_cat"];
               $journal_cats     = implode(",", $journal_cats);

               if ($_POST["journal_update_date"]) {
                  $thetime = time();
                  $gen2 = new convert;
                  $thedate = $gen2->convert_date($thetime, "forum");
                  $datesql = ", userjournals_timestamp='$thetime$'";
               } else {
                  $datesql = "";
               }

               $the_sql = "userjournals_subject='$journal_title', userjournals_categories='$journal_cats', userjournals_playing='$journal_playing', userjournals_mood='$journal_mood', userjournals_entry='$journal_entry', userjournals_is_published='$journal_published' $datesql where userjournals_id=$blogid";
               if ($sql->db_Update('userjournals', $the_sql)){
                  $text = $this->Message(UJ13);
               } else {
                  $text = $this->Message(UJE02, "SQL ($the_sql) ".@mysql_error());
               }
            } else {
               $text = $this->Message(UJ23.' '.UJ21);
            }
         } else {
            $text = $this->Message(UJ17);
         }

         return $this->BloggerPage(USERID, USERNAME, 0, $text);
      }

      function BlogDelete($blogid) {
         global $sql,$pref;
         // Only allow blog writers to delete entries
         if (check_class($pref["userjournals_writers"]) || ADMIN) {
            // Make sure user is only deleting their own entries
            if ($sql->db_Select("userjournals", "*", "userjournals_id=$blogid")){
               if ($result = $sql->db_Fetch()){
                  extract($result);
                  if ($userjournals_userid != USERID && !ADMIN) {
                     return $this->BloggerPage(USERID, USERNAME, 0, $this->Message(UJ17));
                  }
               }
            }

            // Do the delete
            if (!$sql->db_Delete("userjournals", "userjournals_id='$blogid' OR userjournals_comment_parent='$blogid'")){
               $text = $this->Message("SQL ".UJ23.@mysql_error());
            }
            // Delete any comments for this entry
            $sql->db_Delete("comments", "comment_item_id='$blogid' and comment_type='userjourna'");
         } else {
            $text = $this->Message(UJ17);
         }

         return $this->BloggerPage(USERID, USERNAME, 0, $text);
      }

      function BlogSynopsis() {
         global $e107Helper, $pref, $sql;

         if (check_class($pref["userjournals_writers"])) {
            $text = "<form action='".e_SELF."?synopsissave' method='post'>";

            if ($sql->db_Select("userjournals", "*", "userjournals_userid=".USERID." and userjournals_is_blog_desc='1'")){
               if ($row = $sql->db_Fetch()){
                  extract($row);
                  $text = "<form action='".e_SELF."?synopsisupdate.".USERID."' method='post'>";
               }
            } else {
               $userjournals_entry = "";
            }

            $text .= "<table border='0'>";
            $text .= "<tr><td class='forumheader3' colspan='2'>".UJ55."</td>";
            $text .= "<tr><td class='forumheader3'>".UJ52."</td><td class='forumheader3'>";
            $text .= $e107Helper->getTextarea($userjournals_entry, "journal_synopsis", "tbox", 10, false, "98%", 2, $pref["smiley_activate"]);
            $text .= "</td></tr><tr><td colspan='2' class='forumheader3' style='text-align:center;'>";
            if (isset($blogid)) {
               $text .= "<input type='submit' class='button' value='".UJ51."' name='synopsisupdate'/> ";
            } else {
               $text .= "<input type='submit' class='button' value='".UJ2."' name='synopsissave'/> ";
            }
            $text .= "<input type='button' class='button' value='".UJ3."' name='cancel' onclick='window.history.back()'/>";
            $text .= "</td></tr></table></form>";
         } else {
            $text = $this->Message(UJ17);
         }

         return array($pref["userjournals_page_title"]." : ".UJ52.UJ53.USERNAME, $text);
      }

      function BlogSynopsisSave() {
         global $pref, $sql;

         // Only allow blog writers to save a synopsis
         if (check_class($pref["userjournals_writers"])) {
            if ($_POST["journal_synopsis"] != "") {
               $parse = new textparse;
               $journal_synopsis = $parse->formtpa($_POST['journal_synopsis']);

               $thetime = time();
               $gen2 = new convert;
               $thedate = $gen2->convert_date($thetime, "forum");

               $the_sql = "0,".USERID.",'".USERNAME."','','','','$journal_synopsis','$thedate','$thetime','0','0','1','0'";
               if ($sql->db_Insert('userjournals', $the_sql)){
                  $text = $this->Message(UJ54);
               } else {
                  $text = $this->Message(UJE01, @mysql_error());
               }
            } else {
               return $this->BlogSynopsisDelete();
            }
         } else {
            $text = $this->Message(UJ17);
         }

         return $this->BloggerPage(USERID, USERNAME, 0, $text);
      }

      function BlogSynopsisUpdate() {
         global $pref, $sql;

         // Only allow blog writers to update a synopsis
         if (check_class($pref["userjournals_writers"])) {

            if ($_POST["journal_synopsis"]) {

               $parse = new textparse;
               $journal_synopsis = $parse->formtpa($_POST['journal_synopsis']);

               $thetime = time();
               $gen2 = new convert;
               $thedate = $gen2->convert_date($thetime, "forum");

               $the_sql = "userjournals_entry='$journal_synopsis', userjournals_date='$thedate', userjournals_timestamp='$thetime' where userjournals_userid=".USERID." and userjournals_is_blog_desc=1";
               if ($sql->db_Update('userjournals', $the_sql)){
                  $text = $this->Message(UJ54);
               } else {
                  $text = $this->Message("SQL ".UJ23.@mysql_error());
               }
            } else {
               return $this->BlogSynopsisDelete();
            }
         } else {
            $text = $this->Message(UJ17);
         }

         return $this->BloggerPage(USERID, USERNAME, 0, $text);
      }

      function BlogSynopsisDelete() {
         global $sql;

         // Only allow blog writers to delete entries
         if (check_class($pref["userjournals_writers"])) {

            // Do the delete
            if ($sql->db_Delete("userjournals", "userjournals_userid='".USERID."' and userjournals_is_blog_desc='1'")){
               $text = $this->Message(UJ89);
            } else {
               $text = $this->Message("SQL ".UJ23.@mysql_error());
            }
         } else {
            $text = $this->Message(UJ17);
         }

         return $this->BloggerPage(USERID, USERNAME, 0, $text);
      }

      function ReportPage($blogid, $msg=false) {
         global $e107Helper, $pref, $sql;

         if (USERID && $pref['userjournals_report_blog']) {
            $text = "<form action='".e_SELF."?reportit.$blogid' method='post'>";
            $text .= "<table class='forumheader' border='0' style='width:100%;'>";
            $text .= "<tr><td class='forumheader2' style='text-align:center;'>".UJ101."</td></tr>";
            if ($msg) {
               $text .= "<tr><td class='forumheader3' style='text-align:center;'>$msg</td></tr>";
            }
            $text .= "<tr><td class='forumheader3'><p>".UJ102."</p>";
            $text .= "<p>".UJ103." ".UJ104." </strong>".$_SERVER['REMOTE_ADDR']."</strong>, ".UJ105." <strong>".gethostbyaddr($_SERVER['REMOTE_ADDR'])."</strong>.</p>";
            $text .= "</td></tr>";
            $text .= "<tr><td class='forumheader3'>".UJ106." ".USERNAME."<br/>";
            $text .= $e107Helper->getTextarea($_POST['journal_report'], "journal_report", "tbox", 15, false, "100%", 0);
            $text .= "</td></tr>";
            $text .= "<tr><td class='forumheader3' style='text-align:center;'>";
            $text .= "<input type='submit' class='button' value='".UJ101."' name='report_blog'/> ";
            $text .= "</td></tr>";
            $text .= "</table>";
            $text .= "</form>";
         } else {
            $text = $this->Message(UJ17);
         }

         return array($pref["userjournals_page_title"], $text);
      }

      function ReportItPage($blogid) {
         global $e107Helper, $pref, $sql, $tp;

         if (USERID && $pref['userjournals_report_blog']) {
	         if (isset($_POST['journal_report']) && strlen($_POST['journal_report']) > 0) {
	            $subject = "UserJournals ".UJ101;
               $message = UJ107." ".e_SELF."?blog$blogid ID=$blogid.<br/>";
               $message .= UJ106;
               $message .= " ".USERNAME.".";
               $message .= " ".UJ104." ".$_SERVER['REMOTE_ADDR'].".";
               $message .= " ".UJ105." ".gethostbyaddr($_SERVER['REMOTE_ADDR']).".<br/>";
               $message .= UJ101.": ".$tp->toDB($_POST['journal_report']);
               if ($pref['userjournals_report_blog'] == 1 || $pref['userjournals_report_blog'] == 3) {
                  $sql->db_Write_log("UserJournals", $message, "UserJournals");
               }
               if ($pref['userjournals_report_blog'] == 2 || $pref['userjournals_report_blog'] == 3) {
         			require_once(e_HANDLER."mail.php");
			         sendemail(SITEADMINEMAIL, $subject, $message);
		         }
            } else {
               return $this->ReportPage($blogid, UJ108);
            }

            $text .= "<table class='forumheader' border='0' style='width:100%;'>";
            $text .= "<tr><td class='forumheader2' style='text-align:center;'>".UJ101."</td></tr>";
            $text .= "<tr><td class='forumheader3' style='text-align:center;'>";
            $text .= UJ109."<br/><a href='".e_SELF."?blog.$blogid'>".UJ110."</a>.<br/>";
            $text .= "</td></tr>";
            $text .= "</table>";
         } else {
            $text = $this->Message(UJ17);
         }

         return array($pref["userjournals_page_title"], $text);
      }

      function GetReaderMenu($ns) {
         global $e107Helper, $pref, $sql, $tp, $uj_categories, $userjournals_shortcodes, $UJ_MENU_READER, $UJ_RSS;

            $uj_categories = $this->cats;
            $text = $tp->parseTemplate($UJ_MENU_READER, FALSE, $userjournals_shortcodes);

            if (strlen($text) > 0) {
               $ns->tablerender($pref["userjournals_menu_title"], $text);
            } else {
               $ns->tablerender($pref["userjournals_menu_title"], UJ44);
            }
      }

      /**
       * Display a menu for users that are allowed to write blogs
       * @param  class an instance of the e107table class
       */
      function GetWriterMenu($ns) {
         global $e107Helper, $pref, $sql, $tp, $userjournals_shortcodes, $UJ_MENU_WRITER;

         // Check if user is a UJ writer
         if (check_class($pref["userjournals_writers"])) {
            $gen2 = new convert;

            $text = $tp->parseTemplate($UJ_MENU_WRITER, FALSE, $userjournals_shortcodes);

            $ns->tablerender(UJ39.$pref["userjournals_menu_title"], $text);
         }
      }

      function GetCategoriesMenu($ns) {
         global $pref, $e107Helper, $tp, $uj_category, $userjournals_shortcodes;

         // Check if user is a UJ reader
         if (check_class($pref["userjournals_readers"]) || check_class($pref["userjournals_writers"])) {
            if ($pref["userjournals_show_cats"] == 2) {
               if (count($this->cats) > 0) {
                  $text = "<a href='".e_PLUGIN."userjournals_menu/userjournals.php?allcats'>".UJ92."</a><br/><br/>";
                  $text .= "<strong>".UJ91."</strong>";
                  $keys = array_keys($this->cats);
                  foreach ($keys as $key) {
                     $text .= "<br/>&bull;";
                     $uj_category = $this->cats[$key];
                     $text .= $tp->parseTemplate("{UJ_CATEGORY_LINK}", FALSE, $userjournals_shortcodes);
                  }
                  $ns->tablerender($pref["userjournals_cat_menu_title"], $text);
               } else {
                  $ns->tablerender($pref["userjournals_cat_menu_title"], UJ93);
               }
            }
         }
      }

      function CategoryPage($catid, $msg=false) {
         global $e107Helper, $pref, $sql;

         $caption = $pref["userjournals_page_title"].UJ95.$this->cats[$catid]["userjournals_cat_name"];
         $cats_sql = "AND userjournals_categories='$catid' or userjournals_categories regexp '^$catid,' or userjournals_categories regexp ',$catid,' or userjournals_categories regexp ',$catid'";

         if ($sql->db_Select("userjournals", "*", "userjournals_is_comment=0 AND userjournals_is_blog_desc=0 AND userjournals_is_published=0 $cats_sql ORDER BY userjournals_timestamp DESC")){
            $text = "";
            while ($row = $sql->db_Fetch()){
               $text .= $this->GetBlog($row, $pref["userjournals_len_preview"])."<br/>";
            }
         } else {
            $text = $this->Message(UJ28);
         }

         if ($msg) {
            $uj_message = $msg;
            $text = $tp->parseTemplate($UJ_MESSAGE, TRUE, $userjournals_shortcodes).$text;
         }

         return array($caption, $text);
      }

      function AllCategoriesPage() {
         global $pref, $sql, $tp, $uj_categories, $uj_category, $userjournals_shortcodes, $UJ_CATEGORY, $UJ_CATEGORY_LIST;


         $caption = $pref["userjournals_page_title"]." : ".UJ91;
         $keys = array_keys($this->cats);
         $uj_categories = "";
         foreach ($keys as $key) {
            $uj_category = $this->cats[$key];
            $uj_categories .= $tp->parseTemplate($UJ_CATEGORY, FALSE, $userjournals_shortcodes);
         }

         $text = $tp->parseTemplate($UJ_CATEGORY_LIST, FALSE, $userjournals_shortcodes);
         return array($caption, $text);
      }

      function Message($msg, $moretext=false) {
         global $tp, $uj_message, $uj_message2, $userjournals_shortcodes, $UJ_MESSAGE, $UJ_MESSAGE_EXTRA;
         $uj_message = $msg;
         $uj_message2 = $moretext;
         $text = "";
         $text = $tp->parseTemplate($UJ_MESSAGE, TRUE, $userjournals_shortcodes);
         $text .= $tp->parseTemplate($UJ_MESSAGE_EXTRA, TRUE, $userjournals_shortcodes);
         return $text;
      }

      function getTemplates() {
         global $pref;

         function getTemplatesFromDir($folder, $suffix) {
            $templates = array();
            $handle = opendir($folder);
            while ($file = readdir($handle)) {
               $pathinfo = pathinfo($file);
               if ($pathinfo["extension"] == "php") {
                  unset($userjournals_template_name);
                  include($folder.$file);
                  if (isset($userjournals_template_name)) {
                     $templates[] = array($folder.$file, $userjournals_template_name.$suffix);
                  } else {
                     $templates[] = array($folder.$file, $file.$suffix);
                  }
               }
            }
            closedir($handle);
            return $templates;
         }

         $templates = array_merge(
            getTemplatesFromDir(e_PLUGIN."userjournals_menu/templates/", UJ99),
            getTemplatesFromDir(e_THEME.$pref["sitetheme"]."/userjournals_menu/", UJ100)
         );
         asort($templates);
         return $templates;
      }
   }

   $GLOBALS['userJournals'] = new UserJournals();
}
?>