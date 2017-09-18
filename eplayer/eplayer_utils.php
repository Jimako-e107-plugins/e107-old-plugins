<?php
/**
 * Get a list of local media files
 */
function eplayerGetFiles($prefixdir, $pathdir, $sub=0){
   global $t_array, $FILES_DIRECTORY;
   if (substr($pathdir, strlen($pathdir)-1, 1) != "/") {
      $pathdir .= "/";
   }

   $dh = opendir($prefixdir.$pathdir);
   $size = 0;
   $search = array("../", str_replace("../","",$DOWNLOADS_DIRECTORY), $FILES_DIRECTORY, "downloads/", "downloadimages/", "downloadthumbs/");
   $replace = array("", "", "", "", "", "");
   while ($file = readdir($dh)) {
      if ($file != "." and $file != ".." && $file != "index.html" && $file != "null.txt"){
         if (is_file($prefixdir.$pathdir.$file)) {
            $t_array[] = $prefixdir.$pathdir.$file.":".str_replace($search, $replace, $pathdir.$file);;
         } else {
            if(!preg_match("#^CVS#", $prefixdir.$patchdir.$file)) {
               eplayerGetFiles($prefixdir, $pathdir.$file."/");
            }
         }
      }
   }
   closedir($dh);
   sort($t_array);
   for ($i=0; $i<count($t_array); $i++) {
      $csv .= $t_array[$i];
      if ($i<count($t_array)-1) {
         $csv .= ",";
      }
   }
   return $csv;
}

function eplayerPaging($from, $view, $total, $qs) {
   if ($total == 0) {
      return;
   }

   $text = "<table width='100%'><tr>";
   $text .= "<td style='width:25%;text-align:left' class='np'>";
   if ($from > 0) {
      $s = $from - $view;
      $text .= "<span class='smalltext'><a href='$PHP_SELF?$qs.$s.$view'>&lt;&nbsp;".EPLAYER_LAN_16."</a></span></div>";
   }

   $start  = $from + 1;
   $finish = $from + $view;

   if ($finish > $total) {
      $finish = $total;
   }

   $text .= "&nbsp;</td><td style='width:50%;text-align:center' class='np'>";
   $text .= "<span class='smallblacktext'>".EPLAYER_LAN_18." $start ".EPLAYER_LAN_19." $finish ".EPLAYER_LAN_20." $total</span></td>";

   $s = $from + $view;
   $text .= "<td style='width:25%;text-align:right' class='np'>&nbsp;";
   if ($s < $total) {
      $text .= "<span class='smalltext'><a href='$PHP_SELF?$qs.$s.$view'>".EPLAYER_LAN_17."&nbsp;&gt;</a>&nbsp;</span></td>";
   }

   $text .= "</tr></table>";
   return $text;
}

function eplayerGetMOV($url, $w, $h, $full=true) {
   // Add height to allow for controls area
   $h += 18;
   $text = "
      <object classid='clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B' codebase='http://www.apple.com/qtactivex/qtplugin.cab' width='$w' height='$h'>
         <param name='src' value='$url'>
         <param name='autoplay' value='true'>
         <param name='controller' value='true'>
         <embed src='$url' width='$w' height='$h' autoplay='true' controller='true' pluginspage='http://www.apple.com/quicktime/download/'>
         </embed>
      </object>
      ";
   return $text;
}

function eplayerGetSWF($url, $w, $h, $full=true) {
   global $pref;
   $size = getimagesize($url);
   $w = $size[0];
   $h = $size[1];
   if ($pref["eplayer_max_width"] != "") {
      $max = $pref["eplayer_max_width"];
      if ($w > $max) {
         $h = intval($h / ($w/$max));
         $w = $max;
      }
   }
   $text = "
      <object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0' width='$w' height='$h'>
         <param name=movie value='$url'>
         <param name=quality value=high>
         <embed src='$url' quality=high pluginspage='http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash' type='application/x-shockwave-flash' width='$w' height='$h'>
         </embed>
      </object>
      ";

   return $text;
}

function eplayerGetASX($url, $w, $h, $full=true) {
   $text = "
      <object id='MediaPlayer1' width='$w' height='$h'
         classid='CLSID:22D6F312-B0F6-11D0-94AB-0080C74C7E95'
         codebase='http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701'
         standby='Loading Microsoft® Windows® Media Player components...'
         type='application/x-oleobject' align='middle'>
         <param name='uiMode' value='full' />
         <param name='FileName' value='$url'>
         <param name='ShowStatusBar' value='True'>
         <param name='DefaultFrame' value='mainFrame'>
         <param name='URL' value='$url' />
         <param name='autoStart' value='true' />
         <embed type='application/x-mplayer2' src='$url' id='nolplayer1' name='nolplayer1' ShowControls=1 ShowDisplay=0 AutoStart=1 ShowStatusBar=1 width='$w' height='$h'></embed>
      </object>
      ";
   return $text;
}

function eplayerGetRM($url, $w, $h, $full=true) {
   return eplayerGetRAM($url, $w, $h, $full);
}

function eplayerGetRPM($url, $w, $h, $full=true) {
   return eplayerGetRAM($url, $w, $h, $full);
}

function eplayerGetRAM($url, $w, $h, $full=true) {
   $text = "
      <object id='nolplayer1' name='nolplayer1' classid='CLSID:CFCDAA03-8BE4-11CF-B84B-0020AFBBCCFA' width='$w' height='$h' border='0'>
         <param name='autostart' value='true'>
         <param name='src' value='$url'>
         <param name='controls' value='ImageWindow'>
         <param name='console' value='av'>
         <embed name='nolplayer' id='nolplayer' border='0' src='$url' width='$w' height='$h' autostart='true' controls='ImageWindow' console='av' type='audio/x-pn-realaudio-plugin'>
         </embed>
      </object>
      <br />
      <object id='nolplayer2' name='nolplayer2' classid='CLSID:CFCDAA03-8BE4-11CF-B84B-0020AFBBCCFA' width='$w' height='27' border='0'>
         <param name='autostart' value='true'>
         <param name='src' value='$url'>
         <param name='controls' value='StatusBar'>
         <param name='console' value='av'>
         <embed name='nolplayer2' id='nolplayer2' src='$url' width='$w' height='27' controls='StatusBar' console='av' type='audio/x-pn-realaudio-plugin'>
         </embed>
      </object>
      <br />
      <object id='nolplayer3' name='nolplayer3' classid='CLSID:CFCDAA03-8BE4-11CF-B84B-0020AFBBCCFA' width='$w' height='26' border='0'>
         <param name='autostart' value='true'>
         <param name='src' value='$url'>
         <param name='controls' value='ControlPanel'>
         <param name='console' value='av'>
         <embed name='nolplayer3' id='nolplayer3' src='$url' width='$w' height='26' controls='ControlPanel' console='av' type='audio/x-pn-realaudio-plugin'>
         </embed>
      </object>
      ";

   if ($full) {
      $text .= "<hr>
         <a href='$url'>".EPLAYER_LAN_33."</a>
      ";
   }

   return $text;
}

function eplayerGetJPG($url, $w, $h, $full=true) {
   return eplayerGetImage($url, $w, $h, $full);
}

function eplayerGetBMP($url, $w, $h, $full=true) {
   return eplayerGetImage($url, $w, $h, $full);
}

function eplayerGetJPEG($url, $w, $h, $full=true) {
   return eplayerGetImage($url, $w, $h, $full);
}

function eplayerGetPNG($url, $w, $h, $full=true) {
   return eplayerGetImage($url, $w, $h, $full);
}

function eplayerGetGIF($url, $w, $h, $full=true) {
   return eplayerGetImage($url, $w, $h, $full);
}

function eplayerGetImage($url, $w, $h, $full=true) {
   global $pref;
   $size = getimagesize($url);
   $w = $size[0];
   $h = $size[1];
   if ($pref["eplayer_max_width"] != "") {
      $max = $pref["eplayer_max_width"];
      if ($w > $max) {
         $h = intval($h / ($w/$max));
         $w = $max;
      }
   }
   $text = "<a href='$url' target='_new'><img src='$url' width='$w' height='$h' border='0' /><br />".EPLAYER_LAN_34."</a>";
   if ($full) {
      if (function_exists(exif_read_data)) {
         $exif = exif_read_data($url, 0, true);
         if ($exif) {
            $text .= "<div onclick='expandit(\"eplayer_exif_info\");' style='cursor:pointer;'>".EPLAYER_LAN_37;
            $text .= "<div id='eplayer_exif_info' class='forumheader3' style='display:none;'><table>";
            foreach ($exif as $key => $section) {
               //$text .= "<tr><th colspan='2'>$key</th></tr>";
               foreach ($section as $name => $val) {
                  if ($val != NULL && strlen(trim($val)) > 0 && strtolower(substr($name, 0, 12)) != "undefinedtag") {
                     //pick out some specific attributes that can be displayed better
                     switch (strtolower($name)) {
                        case "filedatetime" :
                           $tmp = date("r", $val);
                           break;
                        case "filesize" :
                           $tmp = round(($val/1024), 2)." Kb";
                           break;
                        case "sectionsfound" :
                           // Don't display
                           $tmp = "";
                           break;
                        case "bitspersample" :
                           $tmp = implode("," , $val);
                           break;
                        default :
                           $tmp = $val;
                     }
                     if (strlen($tmp) > 0) {
                        $text .= "<tr><td>$name</td><td>$tmp</td></tr>";
                     }
                  }
               }
            }
            $text .= "</table></div>";
         }
      }
   }
   return $text;
}

// Handles, amongst others, MPG, MPEG, WMV
function eplayerGetDefault($url, $w, $h, $full=true) {
   // Add height to allow for controls area
   $h += 69;
   $text = "
      <embed name='player' id='player'
         pluginspage='http://www.microsoft.com/windows/windowsmedia/download/'
         type='application/x-mplayer2'
         src='$url'
         width='$w'
         height='$h'
         ShowControls='1' ShowDisplay='0' ShowStatusBar='1' autostart='1' autorewind='0' ShowPositionControls='1' ShowTracker='1'>
      </embed>
   ";
   return $text;
}

function eplayerAdd($msg=false, $msgExtra=false) {
   global $pref, $sql, $sql2, $ns;

   $categorytable = "eplayer_category";

   extract($_POST);

   if (check_class($pref["eplayer_user_gallery_class"])) {
      $categories .= "0:".EPLAYER_LAN_54.",";
   }

   $sql->db_Select($categorytable, "*", "cat_parent_category=0 order by cat_name asc", true);
   while ($ep_row = $sql->db_Fetch()) {
      extract($ep_row);
      if (check_class($cat_uploaders)) {
         $parentid = $cat_id;
         $categories .= "$cat_id:$cat_name,";
         $sql2->db_Select($categorytable, "*", "cat_parent_category=$parentid order by cat_name asc", true);
         while ($ep_row = $sql2->db_Fetch()) {
            extract($ep_row);
            $categories .= "$cat_id:&nbsp;&nbsp;&nbsp;$cat_name,";
         }
      }
   }
   $categories = substr($categories, 0, strlen($categories)-1);

   require_once("form_handler.php");
   $rs = new oldform;

   $fieldcapt[] = EPLAYER_LAN_ADMIN_MEDIA_03_0;
   $fieldnote[] = EPLAYER_LAN_ADMIN_MEDIA_03_2;
   $fieldname[] = "eplayer_filename[]";
   $fieldtype[] = "file";
   $fieldvalu[] = ",40,255";
   $fieldmand[] = "*";

   $fieldcapt[] = EPLAYER_LAN_ADMIN_MEDIA_02_0;
   $fieldnote[] = EPLAYER_LAN_ADMIN_MEDIA_02_1;
   $fieldname[] = "category";
   $fieldtype[] = "dropdown2";
   $fieldvalu[] = $categories;
   $fieldmand[] = "*";

   $fieldcapt[] = EPLAYER_LAN_ADMIN_MEDIA_00_0;
   $fieldnote[] = EPLAYER_LAN_ADMIN_MEDIA_00_1;
   $fieldname[] = "title";
   $fieldtype[] = "text";
   $fieldvalu[] = ",40,100";
   $fieldmand[] = "*";

   $fieldcapt[] = EPLAYER_LAN_ADMIN_MEDIA_01_0;
   $fieldnote[] = EPLAYER_LAN_ADMIN_MEDIA_01_1;
   $fieldname[] = "description";
   $fieldtype[] = "textarea";
   $fieldvalu[] = ",90%,100px";
   $fieldmand[] = "";

   $fieldcapt[] = EPLAYER_LAN_ADMIN_MEDIA_08_0;
   $fieldnote[] = EPLAYER_LAN_ADMIN_MEDIA_08_1;
   $fieldname[] = "datestamp";
   $fieldtype[] = "datestamp";
   $fieldvalu[] = "2000";
   $fieldmand[] = "";

   $fieldcapt[] = EPLAYER_LAN_ADMIN_MEDIA_14_0;
   $fieldnote[] = EPLAYER_LAN_ADMIN_MEDIA_14_1;
   $fieldname[] = "mediatype";
   $fieldtype[] = "dropdown2";
   $fieldvalu[] = "0:".EPLAYER_LAN_ADMIN_MEDIA_14_2.",1:".EPLAYER_LAN_ADMIN_MEDIA_14_3.",2:".EPLAYER_LAN_ADMIN_MEDIA_14_4;
   $fieldmand[] = "";


   $text .= "<div><a href='eplayer.php'>&lt;&lt; ".EPLAYER_LAN_22." ".EPLAYER_LAN_01."</a></div>";
   $text .= "<form enctype='multipart/form-data' method='post' name='eplayer' action='".e_SELF."?submit'>";
   $text .= "<table class='fborder' style='width:100%'>";

   if (check_class($pref['eplayer_upload_class']) && count($categories) > 0) {
      $text .= "<tr><td class='forumheader' colspan='2'>".EPLAYER_LAN_46."</td></tr>";

      if ($msg) {
         if ($msgExtra) {
            $text .= "<tr><td class='fcaption' style='text-align:center;' colspan='2'><div onclick='expandit(\"eplayer_message\");' style='cursor:pointer'>$msg</div><div id='eplayer_message' style='display:none;'>$msgExtra</div></td></tr>";
         } else {
            $text .= "<tr><td class='fcaption' style='text-align:center;' colspan='2'>$msg</td></tr>";
         }
      }

      for ($i=0; $i<count($fieldcapt); $i++) {
         $form_send = $fieldcapt[$i] . "|" .$fieldtype[$i]."|".$fieldvalu[$i];
         if ($fieldtype[$i] != "hidden") {
            $text .="<tr>
               <td style='vertical-align:top' class='forumheader3'>".$fieldcapt[$i]." ".$fieldmand[$i]."<br><span class='smalltext'>".$fieldnote[$i]."</td>
               <td class='forumheader3'>";
         }
         $text .= $rs->user_extended_element_edit($form_send, $row[$fieldname[$i]], $fieldname[$i]);
         if ($fieldtype[$i] != "hidden") {
            $text .="</td></tr>";
         }
      }

      $text .= "<tr><td class='forumheader2' style='text-align:center' colspan='2'><button class='button' name='eplayersubmit' type='submit'>".EPLAYER_LAN_47."</button></td></tr>";
   } else {
      $text .= "<tr><td class='fcaption' style='text-align:center;' colspan='2'>".EPLAYER_LAN_60."</td></tr>";
   }

   $text .= "</table></form>";

   return $text;
}

function eplayerGetEMailLine($label, $text) {
   //print "age_GetEMailLine($label, $text)<br>";
   if (strlen($label) > 0 && strlen($text) > 0) {
      return "\n$label: $text";
   }
   return "";
}

function getUploadSearch($canupload=false) {
   global $pref;
   $text .= "<tr><td class='forumheader3' style='text-align:right' colspan='3'>";
   $text .= "<form method='post' action='eplayer.php?search'>";
   if ($canupload || check_class($pref['eplayer_upload_class'])) {
      $text .= "<div style='float:left;'><a href='".e_SELF."?upload'>[".EPLAYER_LAN_46."]</a></div>";
   }
   $text .= "<div style='float:right'><input class='tbox search' type='text' name='search' size='20' value='' maxlength='50' />&nbsp;";
   $text .= "<input class='button search' type='submit' name='s' value='".EPLAYER_LAN_44."' />";
   $text .= "</div></form>";
   $text .= "</td></tr>";
   return $text;
}

function eplayerAdminCategoriesItemList($row) {
   if ($row["cat_parent_category"]) {
      return "> ".$row["cat_name"];
   } else {
      return $row["cat_name"];
   }
}
function eplayerAdminParentCategoriesDropDown() {
   global $sql;
   $categorytable = "eplayer_category";
   $sql->select($categorytable, "*", "cat_parent_category=0 order by cat_name asc", "default" );
   $parents[] = array(0, EPLAYER_LAN_25);
   while ($ep_row = $sql->fetch()) {
      extract($ep_row);
      $parents[] = array($cat_id, $cat_name);
   }
   return $parents;
}

if (!function_exists("headerjs")) {
   function headerjs() {
      global $e107Helper;
      return $e107Helper->getHeaderFiles();
   }
}

?>