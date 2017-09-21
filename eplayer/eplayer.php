<?php
/*
+---------------------------------------------------------------+
| ePlayer by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/eplayer/eplayer.php,v $
| $Revision: 1.44 $
| $Date: 2007/01/23 23:59:18 $
| $Author: Neil $
+---------------------------------------------------------------+
*/

if (!defined('e107_INIT'))
{
	require_once("../../class2.php");
}


   if (!check_class($pref['eplayer_view_class'])) {
      // No access for current user
      header("location:".e_BASE."index.php");
   }

   require_once(e_PLUGIN."eplayer/eplayer_variables.php");
   require_once(e_PLUGIN."eplayer/eplayer_utils.php");

   $eplayertable  = "eplayer";
   $categorytable = "eplayer_category";
   $sql3          = new db;
   $clipsPerPage  = $pref['eplayer_clips_per_page'];

   $footer_js[]   =  e_PLUGIN."eplayer/eplayer.js";

   if(!is_object($gen)){
      $gen = new convert;
   }

   $ep_text = "<table class='fborder' width='100%'>";

   // No query so display category list
   if (!e_QUERY) {
      $canupload = false;
      $sql2->db_Select($categorytable, "*", "cat_parent_category=0 and find_in_set(cat_visibility,'".$e107Helper->getUserClassList()."') order by cat_display_order asc");
      $ep_text .= "<tr><td colspan='4' class='forumheader'>".EPLAYER_LAN_01."</td></tr>";

      while (list($catid, $catname, $catdescription, $caticon, $catdisplay_order, $cat_parent, $cat_visibility, $cat_upload) = $sql2->db_Fetch()) {
         if (check_class($cat_upload)) {
            $canupload = true;
         }
         $qry = "select * from ".MPREFIX."$eplayertable as e
                  left join ".MPREFIX."$categorytable as c on e.category = c.cat_id
                  where (e.category=$catid
                     or (e.category=c.cat_id and c.cat_parent_category=$catid))
                     and e.approved='0'
                     and find_in_set(c.cat_visibility,'".$e107Helper->getUserClassList()."')
                     ";
         $count = $sql3->db_Select_gen($qry);
         $numsubcats = $sql3->db_Count($categorytable." where cat_parent_category='$catid'and find_in_set(cat_visibility,'".$e107Helper->getUserClassList()."')");
         $ep_text .= "<tr><td class='forumheader3' style='text-align:center'>";
         if ($count) {
            $ep_text .= "<a href='eplayer.php?cat.$catid.0.$clipsPerPage'><img src='$caticon' style='border:0px' /></a></td>
                     <td class='forumheader3'><a href='eplayer.php?cat.$catid.0.$clipsPerPage'>$catname</a>";
         } else if ($numsubcats) {
            $ep_text .= "<a href='eplayer.php?cat.$catid.0.$clipsPerPage'><img src='$caticon' style='border:0px' /></a></td>
                     <td class='forumheader3'><a href='eplayer.php?cat.$catid.0.$clipsPerPage'>$catname</a>";
         } else {
            $ep_text .= "<img src='$caticon' style='border:0px' /></td>
                     <td class='forumheader3'>$catname";
         }
         $sql3->db_Select($eplayertable, "timestamp", "category=$catid and approved='0' order by timestamp desc limit 0,1");
         list($timestamp) = $sql3->db_Fetch();

         $ts = $gen->convert_date($timestamp, "short");
         $ep_text .= "<br /><span class='smalltext'>$catdescription</span></td>
                  <td class='forumheader3' style='text-align:center'>$count ".EPLAYER_LAN_14.", $numsubcats ".EPLAYER_LAN_32."<br />".EPLAYER_LAN_23." $ts</td></tr>";
      }

      // Any user galleries?
      $count = $sql2->db_Select($eplayertable, "*", "category=0");
      if ($count) {
         $ep_text .= "<tr><td class='forumheader3' style='text-align:center'>";
         $ep_text .= "<a href='eplayer.php?usrl.0.$clipsPerPage'><img src='".$pref["eplayer_user_gallery_icon"]."' style='border:0px' /></a></td>
                     <td class='forumheader3'><a href='eplayer.php?usrl.0.$clipsPerPage'>".EPLAYER_LAN_55."</a>";
         $sql3->db_Select($eplayertable, "timestamp", "category=0 and approved='0' order by timestamp desc limit 0,1");
         list($timestamp) = $sql3->db_Fetch();
         $ucount = $sql3->db_Select_gen("SELECT distinct(owner) FROM ".MPREFIX."$eplayertable WHERE category=0");
         $ts = $gen->convert_date($timestamp, "short");
         $ep_text .= "<br /><span class='smalltext'>".EPLAYER_LAN_56."</span></td>
                  <td class='forumheader3' style='text-align:center'>$count ".EPLAYER_LAN_14.", $ucount ".EPLAYER_LAN_55."<br />".EPLAYER_LAN_23." $ts</td></tr>";
      }
      $ep_text .= getUploadSearch($canupload);
   }

   switch ($pref["eplayer_display_order"]) {
      case EPLAYER_LAN_ADMIN_PREF_04_3 : {
         $order = "datestamp asc, timestamp asc, id asc";
         break;
      }
      case EPLAYER_LAN_ADMIN_PREF_05_4 : {
         $order = "datestamp desc, timestamp desc, id desc";
         break;
      }
      case EPLAYER_LAN_ADMIN_PREF_06_5 : {
         $order = "timestamp asc, datestamp asc, id asc";
         break;
      }
      case EPLAYER_LAN_ADMIN_PREF_07_6 : {
         $order = "timestamp desc, datestamp desc, id desc";
         break;
      }
      default : {
         $order = "title ASC";
         break;
      }
   }

   // Check to see if we are requesting to upload a file
   //if (eregxi("upload", e_QUERY)) {
   if (preg_match("%upload%i", e_QUERY))  {
      $ep_text .= "<tr><td>";
      $ep_text .= eplayerAdd();
      $ep_text .= "</td></tr>";
   }

   // Check to see if we are uploading a file
   //if (eregxi("submit", e_QUERY)) {
   if (preg_match("%submit%i", e_QUERY))  {
      define("PAGE_NAME", $pref['eplayer_title']);
      // Check for mandatory fields
      $eplayer_filename = $_FILES["eplayer_filename"];
      if (strlen($eplayer_filename["name"][0]) == 0) {
         $message .= EPLAYER_LAN_ADMIN_MEDIA_03_0." ".EPLAYER_LAN_ADMIN_MEDIA_12;
      }
      if (strlen($_POST['title']) == 0) {
         $message .= EPLAYER_LAN_ADMIN_MEDIA_00_0." ".EPLAYER_LAN_ADMIN_MEDIA_12;
      }

      $filesize = $eplayer_filename['size'][0];
      if (strlen($message) > 0) {
         $ep_text .= "<tr><td>";
         $ep_text .= eplayerAdd($message);
         $ep_text .= "</td></tr>";
      } elseif (isset($pref['upload_maxfilesize']) && is_numeric($pref['upload_maxfilesize']) && $filesize > $pref['upload_maxfilesize']) {
         $ep_text .= "<tr><td>";
         $ep_text .= eplayerAdd(str_replace("{SIZELIMIT}", $pref['upload_maxfilesize'], EPLAYER_LAN_ADMIN_MEDIA_17));
         $ep_text .= "</td></tr>";
      } else {
         if (is_uploaded_file($eplayer_filename['tmp_name'][0])) {
            if ($_POST["mediatype"] == 0) {
               $eplayer_dir = $pref["eplayer_image_dir"];
            } else {
               $eplayer_dir = $pref["eplayer_media_dir"];
            }
            //$eplayer_file = e_xFILE.$eplayer_dir."/".eregx_replace("[^a-z0-9._]", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($eplayer_filename['name'][0]))));
            $eplayer_file = e_MEDIA.$eplayer_dir."/".preg_replace("%[^a-z0-9._]%", "", str_replace(" ", "_", str_replace("%20", "_", strtolower($eplayer_filename['name'][0]))));            
						 
						if (move_uploaded_file($eplayer_filename['tmp_name'][0], $eplayer_file)) {
               $datestamp = mktime (0,0,0,$_POST["datestamp_month"],$_POST["datestamp_day"],$_POST["datestamp_year"]);
               if ($datestamp == "") {
                  $datestamp = '0';
               }
               $approved = $_POST["category"] == 0 ? 0 : 1; // User gallery - auto approve
               $query = "0, ";                              // id
               $query .= "'".$eplayer_file."', ";           // filename
               $query .= "'".$e107Helper->tp_toDB($_POST["title"])."', ";         // title
               $query .= "'".$_POST["category"]."', ";      // category
               $query .= $datestamp.", ";                   // datestamp
               $query .= "'".$e107Helper->tp_toDB($_POST["description"])."', ";   // description
               $query .= "'', ";                            // icon
               $query .= "0, ";                             // width
               $query .= "0, ";                             // height
               $query .= USERID.", ";                       // owner
               $query .= "'".USERNAME."', ";                // author
               $query .= "1, ";                             // comment
               $query .= time().", ";                       // timestamp
               $query .= "0, ";                             // lastview
               $query .= "0, ";                             // viewcount
               $query .= "$approved ";                      // approved
               if ($sql3->db_Insert("eplayer", $query)) {
                  $ep_text .= "<tr><td>";
                  $ep_text .= eplayerAdd($_POST["category"]>0 ? EPLAYER_LAN_49 : EPLAYER_LAN_61);
                  $ep_text .= "</td></tr>";
                  if (strlen($pref["eplayer_email_notification"]) > 0) {
                     require_once(e_HANDLER."mail.php");
                     $sql3->db_Select($categorytable, "*", "cat_id='".$_POST["category"]."'");
                     list($catid, $catname) = $sql3->db_Fetch();

                     $msg = EPLAYER_LAN_52;
                     $msg .= eplayerGetEMailLine(EPLAYER_LAN_ADMIN_MEDIA_03_0, $eplayer_file);
                     $msg .= eplayerGetEMailLine(EPLAYER_LAN_ADMIN_MEDIA_00_0, $_POST["title"]);
                     $msg .= eplayerGetEMailLine(EPLAYER_LAN_ADMIN_MEDIA_02_0, $catname);
                     $msg .= eplayerGetEMailLine(EPLAYER_LAN_ADMIN_MEDIA_16_0, USERNAME);
                     sendemail($pref['eplayer_email_notification'],           // send to email
                               "[".$pref['eplayer_title']."]".EPLAYER_LAN_51, // subject
                               $msg,                                          // message
                               "",                                            // send to name
                               "",                                            // send from email
                               "",                                            // send from name
                               "",                                            // attachments
                               "",                                            // cc
                               "",                                            // bcc
                               $pref['siteadminemail'],                       // return path
                               ""                                             // return receipt
                               );
                  }
               } else {
                  $ep_text .= "<tr><td>";
                  $ep_text .= eplayerAdd(EPLAYER_LAN_48, mysql_error());
                  $ep_text .= "</td></tr>";
               }
            } else {
               $ep_text .= "<tr><td>";
               $ep_text .= eplayerAdd(EPLAYER_LAN_48, $eplayer_filename['tmp_name'][0]." .. ".$eplayer_file);
               $ep_text .= "</td></tr>";
            }
         } else {
            $ep_text .= "<tr><td>";
            $ep_text .= eplayerAdd(EPLAYER_LAN_48);
            $ep_text .= "</td></tr>";
         }
      }
   }

   // Check to see if we are searching
   //if (eregxi("search", e_QUERY)) {
   if (preg_match("%search%i", e_QUERY)) {
      define("PAGE_NAME", $pref['eplayer_title']);
      $ep_text .= "<tr><td colspan='3' class='np' style='text-align:left'><a href='eplayer.php'>&lt;&lt; ".EPLAYER_LAN_22." ".EPLAYER_LAN_01."</a></td></tr>";
      $ep_text .= "<tr><td colspan='2' class='forumheader' width='66%'>$catname<br /><span class='smalltext'>$catdescription</span></td>";
      $ep_text .= "<td class='forumheader' style='text-align:center'>";
      $ep_text .= "<span class='smallblacktext'>$count ".EPLAYER_LAN_14."</span>";
      $ep_text .= "</td></tr>";

      $search = $_POST["search"];
      $qry = "SELECT * from ".MPREFIX."$eplayertable as e
               left join ".MPREFIX."$categorytable as c on e.category = c.cat_id
               WHERE (
                  e.title like '%$search%'
                  OR e.description like '%$search%')
                  AND e.approved='0'
                  AND find_in_set(c.cat_visibility,'".$e107Helper->getUserClassList()."')
               ORDER BY $order
                  ";
      if ($sql2->db_Select_gen($qry)) {
         $ep_text .= "<tr><td colspan='4' class='forumheader2'>".EPLAYER_LAN_27."</td></tr>";
         while ($row = $sql2->db_Fetch()) {
            extract($row);
            $title         = $tp->toHTML($title);
            $description   = $tp->toHTML($description);

            $ep_text .= "<td class='forumheader3' style='text-align:center'><a href='eplayer.php?view.$id.0.$clipsPerPage'><img src='$icon' style='border:0px' /></a></td>
                     <td class='forumheader3'><a href='eplayer.php?view.$id.0.$clipsPerPage'>$title</a><br />$description</td>
                     <td class='forumheader3' style='text-align:center'>".EPLAYER_LAN_21."$author";
            if ($datestamp > 0) {
               $date = $gen->convert_date($datestamp, "short");
               $ep_text .= "<br />$date";
            }
            if ($timestamp > 0) {
               $date = $gen->convert_date($timestamp, "short");
               $ep_text .= "<br />".EPLAYER_LAN_24.": $date";
            }
               $ep_text .= "<br />".EPLAYER_LAN_41.": $viewcount";
            if ($lastview > 0) {
               $ep_text .= "<br />".EPLAYER_LAN_42.": ".$gen->convert_date($lastview, "short");
            } else {
               $ep_text .= "<br />".EPLAYER_LAN_43;
            }
            $ep_text .= "</td></tr>";
         }
      } else {
         $ep_text .= "<tr><td class='forumheader3' colspan='3'>".EPLAYER_LAN_45."</td></tr>";
      }

      $ep_text .= "<tr><td class='forumheader3' style='text-align:right' colspan='3'>";
      $ep_text .= "<form method='post' action='eplayer.php?search'>";
      $ep_text .= "<input class='tbox search' type='text' name='search' size='20' value='$search' maxlength='50' />&nbsp;";
      $ep_text .= "<input class='button search' type='submit' name='s' value='".EPLAYER_LAN_44."' />";
      $ep_text .= "</form>";
      $ep_text .= "</td></tr>";
   }

   // Check to see if we should be displaying clips in a category
   //if (eregxi("cat.", e_QUERY)) {
   if (preg_match("%cat.%i", e_QUERY)) {
      define("PAGE_NAME", $pref['eplayer_title']);
      $tmp     = explode(".", e_QUERY);
      $catid   = $tmp[1];
      $from    = $tmp[2];
      $view    = $tmp[3];

      $sql3->db_Select($categorytable, "*", "cat_id='$catid'");
      list($catid, $catname, $catdescription, $caticon, $catorder, $catparent) = $sql3->db_Fetch();
      $qry = "select * from ".MPREFIX."$eplayertable as e
               left join ".MPREFIX."$categorytable as c on e.category = c.cat_id
               where (e.category=$catid
                  or (e.category=c.cat_id and c.cat_parent_category=$catid))
                  and e.approved='0'
                  and find_in_set(c.cat_visibility,'".$e107Helper->getUserClassList()."')
                  ";
      $count = $sql3->db_Select_gen($qry);
      $numsubcats = $sql3->db_Count($categorytable." where cat_parent_category='$catid'and find_in_set(cat_visibility,'".$e107Helper->getUserClassList()."')");
      $ep_text .= "<tr><td colspan='3' class='np' style='text-align:left'><a href='eplayer.php'>&lt;&lt; ".EPLAYER_LAN_22." ".EPLAYER_LAN_01."</a></td></tr>";
      if ($catparent) {
         $sql3->db_Select($categorytable, "*", "cat_id='$catparent'");
         if ($tmp = $sql3->db_Fetch()) {
            $ep_text .= "<tr><td colspan='3' class='np' style='text-align:left'><a href='eplayer.php?cat.$catparent.0.$clipsPerPage'>&lt;&lt; ".EPLAYER_LAN_22." ".$tmp['cat_name']."</a></td></tr>";
         }
      }
      $ep_text .= "<tr><td colspan='2' class='forumheader' width='66%'>$catname<br /><span class='smalltext'>$catdescription</span></td>";
      $ep_text .= "<td class='forumheader' style='text-align:center'>";
      $ep_text .= "<span class='smallblacktext'>$count ".EPLAYER_LAN_14."</span>";
      $ep_text .= "</td></tr>";

      // Displaying a category - check for sub-categories first
      $sql2->db_Select($categorytable, "*", "cat_parent_category=$catid and find_in_set(cat_visibility,'".$e107Helper->getUserClassList()."') order by cat_display_order asc", true);

      if ($numsubcats > 0) {
         $ep_text .= "<tr><td colspan='4' class='forumheader2'>".EPLAYER_LAN_26."</td></tr>";
      }

      while (list($parentcatid, $catname, $catdescription, $caticon, $catdisplay_order) = $sql2->db_Fetch()) {
         $count = $sql3->db_Select($eplayertable, "*", "category=$parentcatid and approved='0' order by timestamp desc");

         $ep_text .= "<tr><td class='forumheader3' style='text-align:center'>";
         if ($count) {
            $ep_text .= "<a href='eplayer.php?cat.$catid.0.$clipsPerPage'><img src='$caticon' style='border:0px' /></a></td>
                     <td class='forumheader3'><a href='eplayer.php?cat.$parentcatid.0.$clipsPerPage'>$catname</a>";
         } else {
            $ep_text .= "<img src='$caticon' style='border:0px' /></td>
                     <td class='forumheader3'>$catname";
         }

         list($eid, $filename, $title, $category, $datestamp, $description, $icon, $width, $height, $author, $comment, $timestamp) = $sql3->db_Fetch();

         $ts = $gen->convert_date($timestamp, "short");
         $ep_text .= "<br /><span class='smalltext'>$catdescription</span></td>
                  <td class='forumheader3' style='text-align:center'>$count ".EPLAYER_LAN_14."<br />".EPLAYER_LAN_23." $ts</td></tr>";
      }

      $count = $sql2->db_Count($eplayertable." WHERE category='$catid' and approved='0'");
      if ($sql2->db_Select($eplayertable, "*", "category='$catid' and approved='0' ORDER BY $order LIMIT $from,$view", true)) {
         $ep_text .= "<tr><td colspan='4' class='forumheader2'>".EPLAYER_LAN_27."</td></tr>";
         while ($row = $sql2->db_Fetch()) {
            extract($row);
            $title         = $tp->toHTML($title);
            $description   = $tp->toHTML($description);

            $ep_text .= "<td class='forumheader3' style='text-align:center'><a href='eplayer.php?view.$id.0.$clipsPerPage'><img src='$icon' style='border:0px' /></a></td>
                     <td class='forumheader3'><a href='eplayer.php?view.$id.0.$clipsPerPage'>$title</a>";
            if (check_class($pref['eplayer_download_class'])) {
               $ep_text .= "&nbsp;<a href='".$e107->base_path."request.php?".str_replace("../../", $e107->base_path, $filename)."'>".EPLAYER_LAN_53."</a>";
            }
            $ep_text .= "<br />$description</td><td class='forumheader3' style='text-align:center'>".EPLAYER_LAN_21."$author";
            if ($datestamp > 0) {
               $date = $gen->convert_date($datestamp, "short");
               $ep_text .= "<br />$date";
            }
            if ($timestamp > 0) {
               $date = $gen->convert_date($timestamp, "short");
               $ep_text .= "<br />".EPLAYER_LAN_24.": $date";
            }
               $ep_text .= "<br />".EPLAYER_LAN_41.": $viewcount";
            if ($lastview > 0) {
               $ep_text .= "<br />".EPLAYER_LAN_42.": ".$gen->convert_date($lastview, "short");
            } else {
               $ep_text .= "<br />".EPLAYER_LAN_43;
            }
            $ep_text .= "</td></tr>";
         }
      }

      $ep_text .= "<tr><td colspan='3'>";
      $ep_text .= eplayerPaging($from, $view, $count, "cat.$catid");
      $ep_text .= "</tr>";
   }

   // Check to see if we should be displaying clips for a user
   //if (eregxi("usrg.", e_QUERY)) {
   if (preg_match("%usrg.%i", e_QUERY)) {
      define("PAGE_NAME", $pref['eplayer_title']);
      $tmp     = explode(".", e_QUERY);
      $owner   = $tmp[1];
      $from    = $tmp[2];
      $view    = $tmp[3];

      $user  = get_user_data($owner);
      $ep_text .= "<tr><td colspan='3' class='np' style='text-align:left'><a href='eplayer.php?usrl.$from.$view'>&lt;&lt; ".EPLAYER_LAN_22." ".EPLAYER_LAN_55."</a></td></tr>";

      if ($user["user_image"]) {
         $temp = "<img src='".e_IMAGE."avatars/".$user["user_image"]."' border='1' style='vertical-align:middle;'/>";
      } else {
         $temp = "<img src='".$pref["eplayer_user_gallery_icon"]."' style='border:0px' style='vertical-align:middle;'/>";
      }
      $temp .= "&nbsp;&nbsp;".EPLAYER_LAN_57.$user["user_name"];

      $ep_text .= "<tr><td colspan='2' class='forumheader' width='66%'>$temp</td>";

      $count = $sql2->db_Select($eplayertable, "*", "owner=$owner ORDER BY $order", true);
      $ep_text .= "<td class='forumheader' style='text-align:center'>";
      $ep_text .= "<span class='smallblacktext'>$count ".EPLAYER_LAN_14."</span>";
      $ep_text .= "</td></tr>";
      if ($count && $sql2->db_Select($eplayertable, "*", "owner=$owner ORDER BY $order LIMIT $from,$view", true)) {
         while ($row = $sql2->db_Fetch()) {
            extract($row);
            $title         = $tp->toHTML($title);
            $description   = $tp->toHTML($description);

            $ep_text .= "<td class='forumheader3' style='text-align:center'><a href='eplayer.php?usrv.$owner.$id.0.$clipsPerPage'><img src='".$pref["eplayer_user_gallery_icon"]."' style='border:0px' /></a></td>
                     <td class='forumheader3'><a href='eplayer.php?usrv.$owner.$id.0.$clipsPerPage'>$title</a>";
            if (check_class($pref['eplayer_download_class'])) {
               $ep_text .= "&nbsp;<a href='".$e107->base_path."request.php?".str_replace("../../", $e107->base_path, $filename)."'>".EPLAYER_LAN_53."</a>";
            }
            $ep_text .= "<br />$description</td><td class='forumheader3' style='text-align:center'>".EPLAYER_LAN_21."$author";
            if ($datestamp > 0) {
               $date = $gen->convert_date($datestamp, "short");
               $ep_text .= "<br />$date";
            }
            if ($timestamp > 0) {
               $date = $gen->convert_date($timestamp, "short");
               $ep_text .= "<br />".EPLAYER_LAN_24.": $date";
            }
               $ep_text .= "<br />".EPLAYER_LAN_41.": $viewcount";
            if ($lastview > 0) {
               $ep_text .= "<br />".EPLAYER_LAN_42.": ".$gen->convert_date($lastview, "short");
            } else {
               $ep_text .= "<br />".EPLAYER_LAN_43;
            }
            $ep_text .= "</td></tr>";
         }
      }

      $ep_text .= "<tr><td colspan='3'>";
      $ep_text .= eplayerPaging($from, $view, $count, "usrg.$owner");
      $ep_text .= "</tr>";
      $ep_text .= getUploadSearch(USERID==$owner);
   }

   // Check to see if we should be displaying user gallery list
   //if (eregxi("usrl", e_QUERY)) {
   if (preg_match("%usrl%i", e_QUERY)) {
      define("PAGE_NAME", $pref['eplayer_title']);
      $tmp     = explode(".", e_QUERY);
      $from    = $tmp[1];
      $view    = $tmp[2];

      $ep_text .= "<tr><td colspan='3' class='np' style='text-align:left'><a href='eplayer.php'>&lt;&lt; ".EPLAYER_LAN_22." ".EPLAYER_LAN_01."</a></td></tr>";
      $ep_text .= "<tr><td colspan='4' class='forumheader'>".EPLAYER_LAN_55."</td></tr>";
      $ucount = $sql2->db_Select_gen("SELECT distinct(owner) FROM ".MPREFIX."$eplayertable WHERE category=0 ORDER BY owner LIMIT $from,$view");
      while ($row = $sql2->db_Fetch()) {
         $user  = get_user_data($row["owner"]);
         $ep_text .= "<tr>";
         $ep_text .= "<td class='forumheader3' style='text-align:center;width:20%;'>";
         $ep_text .= "<a href='eplayer.php?usrg".$row["owner"].".0.$clipsPerPage'>";
         if ($user["user_image"]) {
            $ep_text .= "<img src='".e_IMAGE."avatars/".$user["user_image"]."' border='1'/>";
         } else {
            $ep_text .= "<img src='".$pref["eplayer_user_gallery_icon"]."' style='border:0px' />";
         }
         $ep_text .= "</a>";
         $ep_text .= "</td>";
         $ep_text .= "<td class='forumheader3' style='text-align:left;'>&nbsp;";
         $ep_text .= "<a href='eplayer.php?usrg.".$row["owner"].".0.$clipsPerPage'>".$user["user_name"]."</a>";
         $ep_text .= "</td>";
         $count = $sql3->db_Select($eplayertable, "timestamp", "category=0 and owner=".$row["owner"]." order by timestamp desc ");
         list($timestamp) = $sql3->db_Fetch();
         $ts = $gen->convert_date($timestamp, "short");
         $ep_text .= "<td class='forumheader3' style='text-align:center;width:40%;'>";
         $ep_text .= $count." ".EPLAYER_LAN_14."<br />".EPLAYER_LAN_23." $ts";
         $ep_text .= "</td>";
         $ep_text .= "</tr>";
      }

      $ucount = $sql2->db_Select_gen("SELECT distinct(owner) FROM ".MPREFIX."$eplayertable WHERE category=0");
      $ep_text .= "<tr><td colspan='3'>";
      $ep_text .= eplayerPaging($from, $view, $ucount, "usrl");
      $ep_text .= "</tr>";
      $ep_text .= getUploadSearch($canupload);
   }

   // Check to see if we are playing a clip
   //if (eregxi("view.", e_QUERY) || eregxi("usrv.", e_QUERY)) {
   if (preg_match("%view.%i", e_QUERY) || preg_match("%usrv.%i", e_QUERY) ) {
      $tmp  = explode(".", e_QUERY);
      //$ix = (eregxi("view.", e_QUERY)) ? 0 : 1;
      $ix = (preg_match("%view.%i", e_QUERY)) ? 0 : 1;
      
      $owner   = $tmp[$ix];
      $id      = $tmp[$ix+1];
      $from    = $tmp[$ix+2];
      $view    = $tmp[$ix+3];
      $user = get_user_data($owner);
      $sql2->db_Select($eplayertable, "*", "id='$id'");
      list($id, $filename, $title, $category, $datestamp, $description, $icon, $width, $height, $author, $comment, $timestamp, $lastview, $viewcount) = $sql2->db_Fetch();

      // Increment view count
      $sql2->db_Update($eplayertable, "lastview=".time().", viewcount=viewcount+1 WHERE id='$id'");

      $title       = $tp->toHTML($title);
      $description = $tp->toHTML($description);

      define("PAGE_NAME", $pref['eplayer_title'].": $title");

      $sql3->db_Select($categorytable, "*", "cat_id='$category'");
      list($catid, $catname) = $sql3->db_Fetch();

      $ep_text .= "<tr><td colspan='2' class='np' style='text-align:left'>";
      if ($owner) {
         $ep_text .= "<a href='eplayer.php?usrg.$owner.$from.$view'>&lt;&lt; ".EPLAYER_LAN_22." ".$user["user_name"]."</a>";
      } else {
         $ep_text .= "<a href='eplayer.php?cat.$catid.0.$clipsPerPage'>&lt;&lt; ".EPLAYER_LAN_22." $catname</a>";
      }
      $ep_text .= "</td></tr>";

      $ep_text2 .= "<tr><td class='forumheader3' width='66%'><img src='".e_IMAGE.$pref["eplayer_icon_dir"]."/$icon' style='border:0px' align='middle' />";
      $ep_text2 .= "&nbsp;$title";
      if (check_class($pref['eplayer_download_class'])) {
         $ep_text2 .= "&nbsp;<a href='".$e107->base_path."request.php?".str_replace("../../", $e107->base_path, $filename)."'>".EPLAYER_LAN_53."</a>";
      }
      $ep_text2 .= "<br />";
      $ep_text2 .= $e107Helper->getInlineEdit("description", $id, $description, "eplayer.updateField", "textarea", "smalltext");
      $ep_text2 .= "</td>";
      $ep_text2 .= "<td class='forumheader3'>$author";
      if ($datestamp > 0) {
         $date = $gen->convert_date($datestamp, "short");
         $ep_text2 .= "<br /><span class='smalltext'>$date</span>";
      }
      if ($timestamp > 0) {
         $date = $gen->convert_date($timestamp, "short");
         $ep_text2 .= "<br /><span class='smalltext'>".EPLAYER_LAN_24.": $date</span>";
      }
      $ep_text2 .= "</td></tr>";

      $ep_text2 .= "<tr><td class='forumheader3' colspan='2'>";
      $ep_text2 .= "<div id='permalink'>";
      $ep_text2 .= "<script>";
      $ep_text2 .= "   document.getElementById('permalink').innerHTML = document.URL;";
      $ep_text2 .= "</script>";
      $ep_text2 .= "</div></td></tr>";

      if ($pref['eplayer_show_clip_details'] == EPLAYER_LAN_ADMIN_PREF_06_3) {
         $ep_text .= $ep_text2;
      }

      $ep_text .= "<tr><td colspan='2' class='forumtable2' style='text-align:center;'>";
      $rawURL = strpos($filename, "?") ? substr($filename, 0, strpos($filename, "?")) : $filename;
      $mediaFunc = "eplayerGet".strtoupper(substr($rawURL, strrpos($rawURL, ".")+1));
//<embed style="width:400px; height:326px;" id="VideoPlayback" align="middle" type="application/x-shockwave-flash" src="http://video.google.com/googleplayer.swf?videoUrl=http%3A%2F%2Fvp.video.google.com%2Fvideodownload%3Fversion%3D0%26secureurl%3DmAAAAA_zQQWKPHxi0tigW2DmdY1pmBP8TJWunJascPgMDH5V4U35gzruCw3RwQRzb4_0vPzMedUc-bdfLWNL1BG7Zl1V-sPrhysYQhqYvk-CXdwJiOGU8a7FeKMoInGQ4rbPilAKmNMiINetroXKw4uQJzeOvy_OmAOp0-hIlRmTqg7sTJke8SiXgXAQxbbZRleEJmbWo9ZCcyWUPs91pPcerlA%26sigh%3DW_eMlH4SIyI6epztzKndIxpvG14%26begin%3D0%26len%3D17960%26docid%3D-6629926148313111278&thumbnailUrl=http%3A%2F%2Fvideo.google.com%2FThumbnailServer%3Fcontentid%3D64bbfa40c0c5d222%26second%3D5%26itag%3Dw320%26urlcreated%3D1142782104%26sigh%3DR0Chpn3eywWvayJxUgDZ18TqZOA&playerId=-6629926148313111278" allowScriptAccess="sameDomain" quality="best" bgcolor="#ffffff" scale="noScale" wmode="window" salign="TL"  FlashVars="playerMode=embedded"> </embed>
      if(!function_exists($mediaFunc)) {
         $mediaFunc = "eplayerGetDefault";
      }
      $ep_text .= call_user_func($mediaFunc, $filename, $width, $height);
      $ep_text .= "</td></tr>";

      if ($comment == "1" && !$e107Helper->isV07()) {
         $query = $pref['nested_comments'] ?
            "comment_item_id='$id' AND comment_type='$eplayertable' AND comment_pid='0' ORDER BY comment_datestamp" :
            "comment_item_id='$id' AND comment_type='$eplayertable' ORDER BY comment_datestamp";
         unset($ep_text3);
         $sql3 = new db;
         if ($comment_total = $sql3->db_Select("comments", "*",  $query)) {
            $width = 0;
            while($row = $sql3->db_Fetch()) {
               // ** Need to sort out how to do nested comments here, see "" ($action), and ratings (broken in e107 CVS?)
               if ($pref['nested_comments']) {
                  $ep_text3 .= $cobj->render_comment($row, $eplayertable, "comment", $id, $width, $subject, true);
               } else {
                  $ep_text3 .= $cobj->render_comment($row, $eplayertable, "comment", $id, $width, $subject, true);
               }
            }
            if (ADMIN && getperms("B")) {
               $ep_text3 .= "<div style='text-align:right'><a href='".e_ADMIN."modcomment.php?eplayer.$id'>".LAN_314."</a></div>";
            }
         }
      }

      $next = $prev = $lastid = 0;
      if ($owner) {
         $qry = "owner='$owner'";
      } else {
         $qry = "category='$catid' and approved='0'";
      }
      if ($sql2->db_Select($eplayertable, "*", "$qry ORDER BY $order", true)) {
         while ($row = $sql2->db_Fetch()) {
            if ($row['id'] == $id) {
               $prev = $lastid;
               break;
            }
            $lastid = $row['id'];
         }
         if ($row = $sql2->db_Fetch()) {
            $next = $row['id'];
         }
      }
      $ep_text .= "<tr><td colspan='2'>";

      if ($prev > 0) {
         if ($owner) {
            $ep_text .= "<div class='smalltext' style='float:left'><a href='".e_SELF."?usrv.$owner.$prev.$from.$view'>&lt;&lt; ".EPLAYER_LAN_38."</a></div>";
         } else {
            $ep_text .= "<div class='smalltext' style='float:left'><a href='".e_SELF."?view.$prev.$from.$view'>&lt;&lt; ".EPLAYER_LAN_38."</a></div>";
         }
      }
      if ($next > 0) {
         if ($owner) {
            $ep_text .= "<div class='smalltext' style='float:right'><a href='$PHP_SELF?usrv.$owner.$next.$from.$view'>".EPLAYER_LAN_39." &gt;&gt;</a></div>";
         } else {
            $ep_text .= "<div class='smalltext' style='float:right'><a href='$PHP_SELF?view.$next.$from.$view'>".EPLAYER_LAN_39." &gt;&gt;</a></div>";
         }
      }
      $ep_text .= "</td></tr>";

      if ($pref['eplayer_show_clip_details'] == EPLAYER_LAN_ADMIN_PREF_06_4) {
         $ep_text .= $ep_text2;
      }
      if ($pref['eplayer_allow_rating'] == 1) {
         require_once(e_HANDLER."rate_class.php");
         $rater = new rater;
         $ep_text .= "<tr><td colspan='2' style='text-align:right'>";
         if ($ratearray = $rater->getrating("eplayer", $id)) {
            for($c = 1; $c <= $ratearray[1]; $c++) {
               $ep_text .= "<img src='".e_IMAGE."rate/".IMODE."/star.png' alt='' />";
            }
            if ($ratearray[2]) {
               $ep_text .= "<img src='".e_IMAGE."rate/".IMODE."/".$ratearray[2].".png'  alt='' />";
            }
            if ($ratearray[2] == "") {
               $ratearray[2] = 0;
            }
            $ep_text .= "&nbsp;".$ratearray[1].".".$ratearray[2]." - ".$ratearray[0]."&nbsp;";
            $ep_text .= ($ratearray[0] == 1 ? RATELAN_0 : RATELAN_1);
         } else {
            $ep_text .= RATELAN_4;
         }

         if (!$rater->checkrated("eplayer", $id) && USER) {
            $ratetext = $rater->rateselect("&nbsp;&nbsp;&nbsp;&nbsp;<b>".RATELAN_2, "eplayer", $id)."</b>";
            if (!$e107Helper->isV07()) {
               $ratetext = str_replace("rate.php", "../../rate.php", $ratetext);
            }
            $ep_text .= $ratetext;
         } else if(!USER) {
            $ep_text .= "&nbsp;";
         } else {
            $ep_text .= "&nbsp;-&nbsp;".RATELAN_3;
         }
      }
      $ep_text .= "</td></tr>";

      require_once(e_HANDLER."comment_class.php");
      $cobj = new comment;

      // Check if we are posting comments
      if (isset($_POST['commentsubmit'])) {
         if (!$sql2->db_Select("eplayer", "comment", "id = '{$id}'")) {
            header("location:".e_BASE."index.php");
            exit;
         } else {
            $row = $sql2->db_Fetch();
            if ($row[0] && (ANON === TRUE || USER === TRUE)) {
               $cobj->enter_comment($_POST['author_name'], $_POST['comment'], "eplayer", $id, $pid, $_POST['subject']);
               if($pref['cachestatus']){
                  $e107cache->clear("comment.eplayer.{$sub_action}");
               }
            }
         }
      }
   }

   $ep_text .= "</table>";

   if (!defined("PAGE_NAME")) {
      define("PAGE_NAME", $pref['eplayer_title']);
   }
   require_once(HEADERF);

   $ns->tablerender($pref['eplayer_title'], $ep_text);
   //if ((eregxi("view.", e_QUERY)) && ($comment == "1")) {
    if ((preg_match("%view.%i", e_QUERY)) && ($comment == "1")) {
      $cobj = new comment;
      // e107 0.617
      if (!$e107Helper->isV07()) {
         if (strlen($ep_text3) > 0) {
            $ns->tablerender(LAN_5, $ep_text3);
         }
         $cobj->form_comment("comment", "eplayer", $id, $subject, $content_type);
      } else {
         // e107 0.7
         $cobj->compose_comment("eplayer", "comment", $id, $width, $subject, $showrate=false);
      }
   }

   require_once(FOOTERF);
   exit;

?>
