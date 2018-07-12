<?php
/*
+ ----------------------------------------------------------------------------------------------+
|     e107 website system  : http://e107.org.ru
|     Released under the terms and conditions of the GNU General Public License (http://gnu.org).
|
|     Plugin "my_gallery"
|     Author: Alex ANP alex-anp@ya.ru
+-----------------------------------------------------------------------------------------------+
*/

require_once("../../class2.php");
if (!getperms("P")) {
      header("location:".e_HTTP."index.php");
      exit;
    }

require_once(e_ADMIN."auth.php");

$mydb = new db();

$lan_file = e_PLUGIN."my_gallery/languages/".e_LANGUAGE.".php";
include_once((file_exists($lan_file) ? $lan_file : e_PLUGIN."my_gallery/languages/English.php"));

if (!defined("USER_WIDTH")){ define("USER_WIDTH","width:95%;"); }

if(e_QUERY)
{
  $mygall_qs = explode(":", e_QUERY);
  if (!isset($mygall_qs[0])) $mygall_qs[0] = 'options';
  $action = $mygall_qs[0];
//  $id = $mygall_qs[1];
}
if (!isset($action)) $action = 'options';

// =============== TN_ TV_ Create Script ==============
if(IsSet($_POST['tn_create'])) {

  $folder = $pref['mygallery_folder'];
  $message = "";
  $foto_icon_height = $pref['mygallery_foto_icon_height'];
  $foto_icon_width = $pref['mygallery_foto_icon_width'];
  $foto_view_height = $pref['mygallery_foto_view_height'];
  $foto_view_width = $pref['mygallery_foto_view_width'];
  $img_quality = $pref['mygallery_img_quality'];

  $pref['mygallery_img_quality'] = $_POST['mygallery_img_quality'];
  $pref['mg_icon_create'] = $_POST['mg_icon_create'];
  $pref['mg_view_create'] = $_POST['mg_view_create'];

    save_prefs();

  if ($handle = opendir($folder))
  {
    while (false !== ($folder_a = readdir($handle)))
    {
     if ($folder_a != "." && $folder_a != ".." && $folder_a != "index.php")  { $nav_a[] = $folder_a; }
    }
  closedir($handle);
  }

  foreach ($nav_a as $folder_a) {
          $nav_b = "";
          if ($handle = opendir("$folder/$folder_a"))
              {
              while (false !== ($folder_b = readdir($handle)))
                  {
                   if ($folder_b != "." && $folder_b != ".." && $folder_b != "index.php")  { $nav_b[]= $folder_b; }
                  }
              closedir($handle);
              }


          foreach ($nav_b as $folder_b) {
                  if ($handle = opendir("$folder/$folder_a/$folder_b")) {
                    while (false !== ($img_file = readdir($handle))) {
                        $str_tn = substr_count("$img_file", "tn_") + substr_count("$img_file", "tv_");
                        $str_type = substr_count("$img_file", ".jpg") + substr_count("$img_file", ".JPG") + substr_count("$img_file", ".jpeg") + substr_count("$img_file", ".JPEG");
                        if (($str_type!="0")&&($str_tn!="1")) {

                           If ((!file_exists("$folder/$folder_a/$folder_b/tn_$img_file") or $_POST['mg_file_rewrite']) and $_POST['mg_icon_create']) {

                              $sourse_file = "$folder/$folder_a/$folder_b/$img_file";
                              $dist_file = "$folder/$folder_a/$folder_b/tn_$img_file";


                              $height = $foto_icon_height;
                              $width= $foto_icon_width;

                            if ($pref['mygallery_slide_show']) {
                              //======= Create icon in Slide TN_ =====================
                              $blank_tn = "images/tn_blank.jpg";

                              list($width_blank, $height_blank) = getimagesize($blank_tn);
                              list($width_orig, $height_orig) = getimagesize($sourse_file);

                              if ($width>$width_orig) { $width=$width_orig; }
                              if ($height>$height_orig) { $height=$height_orig; }
                              if (($height_orig/$width_orig)<=($height/$width)) { $height=$width*$height_orig/$width_orig; }
                              if (($height_orig/$width_orig)>($height/$width)) { $width=$height*$width_orig/$height_orig; }

                              // Resample
                              $dist_x = ($width_blank - $width)/2;
                              $dist_y = ($height_blank*0.9 - $height)/2;

                              $image_p = imagecreatefromjpeg($blank_tn);

                              // Print Image size
                              $color = imagecolorallocate($image_p, 90, 90, 90);
                              $string = "".$width_orig."x".$height_orig."";
                              imagestring($image_p, 1, 11, $height_blank - 14, $string, $color);

                              $image = imagecreatefromjpeg($sourse_file);
                              imagecopyresampled($image_p, $image, $dist_x, $dist_y, 0, 0, $width, $height, $width_orig, $height_orig);

                              $message .= "$folder_a/$folder_b/$img_file  - tn_$img_file (In Slide) ";

                            } else {

                              //=========== Create normal icon ==============================
                              list($width_orig, $height_orig) = getimagesize($sourse_file);
                              if ($width>$width_orig) { $width=$width_orig; }
                              if ($height>$height_orig) { $height=$height_orig; }
                              if (($height_orig/$width_orig)<=($height/$width)) { $height=$width*$height_orig/$width_orig; }
                              if (($height_orig/$width_orig)>($height/$width)) { $width=$height*$width_orig/$height_orig; }
                              // Resample

                              $image_p = imagecreatetruecolor($width, $height);
                              $image = imagecreatefromjpeg($sourse_file);
                              imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

                              $message .= "$folder_a/$folder_b/$img_file  - tn_$img_file ";

                            }

                            // Output
                            imagejpeg($image_p, $dist_file, $img_quality);
                            imagedestroy($image_p);
                            imagedestroy($image);

                            $message .= " created <br>";


                           }

                           If ((!file_exists("$folder/$folder_a/$folder_b/tv_$img_file") or $_POST['mg_file_rewrite']) and $_POST['mg_view_create']) {

                            //=========== Create views ==============================
                            $sourse_file = "$folder/$folder_a/$folder_b/$img_file";
                            $dist_file = "$folder/$folder_a/$folder_b/tv_$img_file";

                            $height = $foto_view_height;
                            $width= $foto_view_width;

                            list($width_orig, $height_orig) = getimagesize($sourse_file);
                            if ($width>$width_orig) { $width=$width_orig; }
                            if ($height>$height_orig) { $height=$height_orig; }
                            if (($height_orig/$width_orig)<=($height/$width)) { $height=$width*$height_orig/$width_orig; }
                            if (($height_orig/$width_orig)>($height/$width)) { $width=$height*$width_orig/$height_orig; }
                            // Resample

                            $image_p = imagecreatetruecolor($width, $height);
                            $image = imagecreatefromjpeg($sourse_file);
                            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

                            // Output
                            imagejpeg($image_p, $dist_file, $img_quality);
                            imagedestroy($image_p);
                            imagedestroy($image);

                            $message .= "$folder_a/$folder_b/$img_file  - tv_$img_file created<br>";


                           }

                        }
                    }
                  }
           }
   }





    $ns->tablerender(MYGAL_L049, $message);

}

//=========== Update settings script =================
if(IsSet($_POST['updatesettings'])) {

    $pref['mygallery_folder'] = $_POST['mygallery_folder'];
    $pref['mygallery_rows'] = $_POST['mygallery_rows'];
    $pref['mygallery_columns'] = $_POST['mygallery_columns'];
    $pref['mygallery_foto_in_page'] = $pref['mygallery_rows'] * $pref['mygallery_columns'];
    $pref['mygallery_foto_icon_height'] = $_POST['mygallery_foto_icon_height'];
    $pref['mygallery_foto_icon_width'] = $_POST['mygallery_foto_icon_width'];
    $pref['mygallery_foto_view_height'] = $_POST['mygallery_foto_view_height'];
    $pref['mygallery_foto_view_width'] = $_POST['mygallery_foto_view_width'];
    $pref['mygallery_title_image'] = $_POST['mygallery_title_image'];
    $pref['mygallery_gallery_name'] = $_POST['mygallery_gallery_name'];
    $pref['mygallery_nav_position'] = $_POST['mygallery_nav_position'];
    $pref['mygallery_menu_caption'] = $_POST['mygallery_menu_caption'];
    $pref['mygallery_menu_img_size'] = $_POST['mygallery_menu_img_size'];
    $pref['mygallery_slide_show'] = $_POST['mygallery_slide_show'];
    $pref['mygallery_memo_show'] = $_POST['mygallery_memo_show'];
    $pref['mygallery_mine_cikle'] = $_POST['mygallery_mine_cikle'];
    $pref['mygallery_nav_show'] = $_POST['mygallery_nav_show'];
    $pref['mygallery_comments'] = $_POST['mygallery_comments'];
    $pref['mygallery_raters'] = $_POST['mygallery_raters'];
    $pref['mygallery_hs_theme'] = $_POST['mygallery_hs_theme'];
    $pref['mygallery_img_quality'] = $_POST['mygallery_img_quality'];
    $pref['mygallery_sort_type'] = $_POST['mygallery_sort_type'];
    $pref['mg_icon_create'] = $_POST['mg_icon_create'];
    $pref['mg_view_create'] = $_POST['mg_view_create'];
    $pref['mg_minepage_logo'] = $_POST['mg_minepage_logo'];
    $pref['mg_minepage_random'] = $_POST['mg_minepage_random'];
    $pref['mg_minepage_upload'] = $_POST['mg_minepage_upload'];
    $pref['mg_minepage_comment'] = $_POST['mg_minepage_comment'];

    save_prefs();

    $message = MYGAL_L004;
    $ns->tablerender("", "<div style='text-align:center'><b>$message</b></div>");
}

//============ GD test ==================
$array = gd_info ();
  $message =  "GD Version - ".$array['GD Version']." ";

  if ($array['JPG Support']===true) {
    $message .=  "JPG Support - Enabled ";
  } else { $message .=  "JPG Support - Disabled "; }

$ns->tablerender("GD Version", "<div style='text-align:center'><b>$message</b></div>");


//============ Delete image ===============
if(IsSet($_POST['delete'])) {

    foreach(array_keys($_POST['checked']) as $img_name) {

		$file_del_msg = unlink($img_name);

        if ($mydb->db_Select("my_gallery", "*", "img_name = '".$img_name."'")) {
          while($row = $mydb->db_Fetch()) {
              $db_del_msg = $mydb->db_Delete("my_gallery", "img_id = '".$row['img_id']."'");
              $db_comm_del_msg = $mydb->db_Delete("comments", "comment_item_id = '".$row['img_id']."' AND comment_type = 'my_gallery'");
          }
        }

        $message .= ($file_del_msg ? "File: ".$img_name." - deleted" : "")
        .($db_del_msg ? ", DB line - deleted" : "")
        .($db_comm_del_msg ? ", Comments - deleted" : "")
        ."<br>";

    }

    if ($message == "")    $message = "Select any line!!!";


    $ns->tablerender("", "<div style='text-align:center'><b>$message</b></div>");

}

//============ Move image script ===============
if(IsSet($_POST['move'])) {

    list($url_str, $guery) = explode("?manage:", $_POST['move_gallery']);
    list($move_folder_a, $move_folder_b) = explode(":", $guery);

    $move_folder = "".$pref['mygallery_folder']."/".$move_folder_a."/".$move_folder_b."";

    foreach(array_keys($_POST['checked']) as $img_name) {

        list($folder, $folder_a, $folder_b, $img_file) = explode("/", $img_name);

		$file_move_msg = rename($img_name, $move_folder."/".$img_file);
		$tn_file_move_msg = rename($folder."/".$folder_a."/".$folder_b."/tn_".$img_file, $move_folder."/tn_".$img_file);
		$tv_file_move_msg = rename($folder."/".$folder_a."/".$folder_b."/tv_".$img_file, $move_folder."/tv_".$img_file);
        $db_file_move_msg = $mydb->db_Update("my_gallery", "img_name='".$move_folder."/".$img_file."' WHERE img_name='".$img_name."'");

        $message .= ($file_move_msg ? "".$img_file."" : "")
        .($tn_file_move_msg ? ", tn_".$img_file."" : "")
        .($tv_file_move_msg ? ", tv_".$img_file."" : "")
        ." move to ".$move_folder
        .($db_file_move_msg ? ", DB Line update" : "")."<br>";



    }

//    $message = "".$pref['mygallery_folder']."/".$move_folder_a."/".$move_folder_b."";
    if ($message == "")    $message = "Select any line!!!";


    $ns->tablerender("", "<div style='text-align:center'><b>$message</b></div>");

}

//============ Update image script ===============
if(IsSet($_POST['update'])) {

    foreach(array_keys($_POST['checked']) as $img_name) {

      if ( $mydb->db_Count("my_gallery", "(*)", "WHERE img_name = '".$img_name."'") > 0 ) {

        $mydb->db_Update("my_gallery", "img_title='".$_POST['img_title'][$img_name]."', img_description='".$_POST['img_description'][$img_name]."' WHERE img_name='$img_name'");
        $message .= "Image: ".$img_name." - DB line updated<br>";

      } else {

        $sql_text = array(
              "img_name" =>           $tp -> toDB($img_name),
              "img_title" =>          $tp -> toDB($_POST['img_title'][$img_name]),
              "img_description" =>    $tp -> toDB($_POST['img_description'][$img_name])
              );

        $mydb->db_Insert("my_gallery", $sql_text);
        $message .= "Image: ".$img_name." - DB line insert<br>";

      }
    }
    //--------- Update gallery name A ----------
    if ($_POST['folder_a_name'] != $_POST['folder_a_name_def']) {

        if ( $mydb->db_Count("my_gallery", "(*)", "WHERE img_name = '".$pref['mygallery_folder']."/".urldecode($mygall_qs[1])."' and img_status = 'menu'") > 0 ) {

        $mydb->db_Update("my_gallery", "img_title='".$tp -> toDB($_POST['folder_a_name'])."' WHERE img_name = '".$pref['mygallery_folder']."/".urldecode($mygall_qs[1])."' and img_status = 'menu'");
        $message .= "Gallery: ".$mygall_qs[1]." - DB line updated<br>";

        } else {

        $sql_text = array(
              "img_name" =>           $tp -> toDB($pref['mygallery_folder']."/".urldecode($mygall_qs[1])),
              "img_title" =>          $tp -> toDB($_POST['folder_a_name']),
              "img_status" =>         $tp -> toDB("menu")
              );

        $mydb->db_Insert("my_gallery", $sql_text);
        $message .= "Gallery: ".$mygall_qs[1]." - DB line insert<br>";

        }
    }

    //--------- Update gallery name B ----------
    if ($_POST['folder_b_name'] != $_POST['folder_b_name_def']) {

        if ( $mydb->db_Count("my_gallery", "(*)", "WHERE img_name='".$pref['mygallery_folder']."/".urldecode($mygall_qs[1]."/".$mygall_qs[2])."' and img_status = 'menu'") > 0 )
        {
        $mydb->db_Update("my_gallery", "img_title='".$tp -> toDB($_POST['folder_b_name'])."' WHERE img_name='".$pref['mygallery_folder']."/".urldecode($mygall_qs[1]."/".$mygall_qs[2])."' and img_status = 'menu'");
        $message .= "Gallery: ".$mygall_qs[2]." - DB line updated<br>";
        } else {
        $sql_text = array(
              "img_name" =>           $tp -> toDB($pref['mygallery_folder']."/".urldecode($mygall_qs[1]."/".$mygall_qs[2])),
              "img_title" =>          $tp -> toDB($_POST['folder_b_name']),
              "img_status" =>         $tp -> toDB("menu")
              );

        $mydb->db_Insert("my_gallery", $sql_text);
        $message .= "Gallery: ".$mygall_qs[2]." - DB line insert<br>";
        }
    }

    if ($message == "")    $message = "Select any line!!!";

    $ns->tablerender("", "<div style='text-align:center'><b>$message</b></div>");

}

//============ Public image script ===============
if(IsSet($_POST['public'])) {

  $pref['mygallery_img_quality'] = $_POST['mygallery_img_quality'];
  $pref['mg_icon_create'] = $_POST['mg_icon_create'];
  $pref['mg_view_create'] = $_POST['mg_view_create'];
  $pref['mg_original_change'] = $_POST['mg_original_change'];
  $pref['mg_original_size'] = $_POST['mg_original_size'];

    save_prefs();

    foreach(array_keys($_POST['checked']) as $img_name) {

    $img_title = $_POST['img_title'][$img_name];
    $img_description = $_POST['img_description'][$img_name];

    $mydb->db_Update("my_gallery", "img_status='public', img_title='$img_title', img_description='$img_description' WHERE img_name='$img_name'");

    $message .= "$img_title - $img_description - public<br>";

    //------------- Create views -------------------
    if ($_POST['mg_view_create']) {

        $sourse_file = $img_name;
        list($folder, $folder_a, $folder_b, $img_file) = explode("/", $img_name);
        $dist_file = "$folder/$folder_a/$folder_b/tv_$img_file";

        $height = $pref['mygallery_foto_view_height'];
        $width= $pref['mygallery_foto_view_width'];

        list($width_orig, $height_orig) = getimagesize($sourse_file);
        if ($width>$width_orig) { $width=$width_orig; }
        if ($height>$height_orig) { $height=$height_orig; }
        if (($height_orig/$width_orig)<=($height/$width)) { $height=$width*$height_orig/$width_orig; }
        if (($height_orig/$width_orig)>($height/$width)) { $width=$height*$width_orig/$height_orig; }
        // Resample

        $image_p = imagecreatetruecolor($width, $height);
        $image = imagecreatefromjpeg($sourse_file);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

        // Output
        imagejpeg($image_p, $dist_file, $pref['mygallery_img_quality']);
        imagedestroy($image_p);
        imagedestroy($image);

        $message .= "$folder_a/$folder_b/$img_file  - tv_$img_file created<br>";

    }

    //------------- ReCreate Original  -------------------
    if ($_POST['mg_original_change']) {

        $sourse_file = $img_name;
        $dist_file = $img_name;

        $height = $pref['mg_original_size'];
        $width = $pref['mg_original_size'];

        list($width_orig, $height_orig) = getimagesize($sourse_file);

        if ($width_orig > $width or $height_orig > $height) {

          if ($width>$width_orig) { $width=$width_orig; }
          if ($height>$height_orig) { $height=$height_orig; }
          if (($height_orig/$width_orig)<=($height/$width)) { $height=$width*$height_orig/$width_orig; }
          if (($height_orig/$width_orig)>($height/$width)) { $width=$height*$width_orig/$height_orig; }
          //------------- Resample -----------

          $image_p = imagecreatetruecolor($width, $height);
          $image = imagecreatefromjpeg($sourse_file);
          imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

          //-------- Output -------------
          imagejpeg($image_p, $dist_file, $pref['mygallery_img_quality']);
          imagedestroy($image_p);
          imagedestroy($image);

          $message .= "".$img_name." - Original recreated<br>";

        }
    }

   //------------- Create icon -----------------------
     If ($_POST['mg_icon_create']) {

        $sourse_file = $img_name;
        list($folder, $folder_a, $folder_b, $img_file) = explode("/", $img_name);
        $dist_file = "$folder/$folder_a/$folder_b/tn_$img_file";

        $height = $pref['mygallery_foto_icon_height'];
        $width= $pref['mygallery_foto_icon_width'];

   //------------- Create icon in Slide --------------------
      if ($pref['mygallery_slide_show']) {

        $blank_tn = "images/tn_blank.jpg";

        list($width_blank, $height_blank) = getimagesize($blank_tn);
        list($width_orig, $height_orig) = getimagesize($sourse_file);

        if ($width>$width_orig) { $width=$width_orig; }
        if ($height>$height_orig) { $height=$height_orig; }
        if (($height_orig/$width_orig)<=($height/$width)) { $height=$width*$height_orig/$width_orig; }
        if (($height_orig/$width_orig)>($height/$width)) { $width=$height*$width_orig/$height_orig; }

        // Resample
        $dist_x = ($width_blank - $width)/2;
        $dist_y = ($height_blank*0.9 - $height)/2;

        $image_p = imagecreatefromjpeg($blank_tn);

        // Print Image size
        $color = imagecolorallocate($image_p, 90, 90, 90);
        $string = "".$width_orig."x".$height_orig."";
        imagestring($image_p, 1, 11, $height_blank - 14, $string, $color);

        $image = imagecreatefromjpeg($sourse_file);
        imagecopyresampled($image_p, $image, $dist_x, $dist_y, 0, 0, $width, $height, $width_orig, $height_orig);

        $message .= "$folder_a/$folder_b/$img_file  - tn_$img_file (In Slide) ";

      } else {

        //-------------- Create normal icon ---------------------------
        list($width_orig, $height_orig) = getimagesize($sourse_file);
        if ($width>$width_orig) { $width=$width_orig; }
        if ($height>$height_orig) { $height=$height_orig; }
        if (($height_orig/$width_orig)<=($height/$width)) { $height=$width*$height_orig/$width_orig; }
        if (($height_orig/$width_orig)>($height/$width)) { $width=$height*$width_orig/$height_orig; }
        // Resample

        $image_p = imagecreatetruecolor($width, $height);
        $image = imagecreatefromjpeg($sourse_file);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

        $message .= "$folder_a/$folder_b/$img_file  - tn_$img_file ";

      }

      //----------- Output ----------------
      imagejpeg($image_p, $dist_file, $pref['mygallery_img_quality']);
      imagedestroy($image_p);
      imagedestroy($image);

      $message .= " created <br>";

     }

    }

    if ($message == "")    $message = "Select any line!!!";

    $ns->tablerender("", "<div style='text-align:center'><b>$message</b></div>");

}

//================= Options form ===============
if ($action == 'options') {
$text = "
<form name='setings' action='".e_SELF."' method='post'>
<table style='width:85%' class='fborder'>
<tr>
<td class='forumheader3' colspan='2'><b>".MYGAL_L005."</b></td>
</tr>
<tr>
<td class='forumheader3'>".MYGAL_L006."</td>
<td class='forumheader3'><input class='tbox' type='text' name='mygallery_folder' size='60' value='".$pref['mygallery_folder']."' ></td>
</tr>
<tr>
<td class='forumheader3'>".MYGAL_L007."</td>
<td class='forumheader3'>
<input class='tbox' type='text' name='mygallery_columns' size='5' value='".$pref['mygallery_columns']."'> *
<input class='tbox' type='text' name='mygallery_rows' size='5' value='".$pref['mygallery_rows']."'> =
".$pref['mygallery_foto_in_page']."
</td>
</tr>
<tr>
<td class='forumheader3'>".MYGAL_L008."</td>
<td class='forumheader3'><input class='tbox' type='text' name='mygallery_foto_icon_height' size='10' value='".$pref['mygallery_foto_icon_height']."'></td>
</tr>
<tr>
<td class='forumheader3'>".MYGAL_L009."</td>
<td class='forumheader3'><input class='tbox' type='text' name='mygallery_foto_icon_width' size='10' value='".$pref['mygallery_foto_icon_width']."'></td>
</tr>
<tr>
<td class='forumheader3'>".MYGAL_L010."</td>
<td class='forumheader3'><input class='tbox' type='text' name='mygallery_foto_view_height' size='10' value='".$pref['mygallery_foto_view_height']."'></td>
</tr>
<tr>
<td class='forumheader3'>".MYGAL_L011."</td>
<td class='forumheader3'><input class='tbox' type='text' name='mygallery_foto_view_width' size='10' value='".$pref['mygallery_foto_view_width']."'></td>
</tr>
<tr>
<td class='forumheader3'>".MYGAL_L028." </td>
<td class='forumheader3'>". ($pref['mygallery_slide_show']
? "<input type='checkbox' name='mygallery_slide_show' value='1' checked='checked' /> ".MYGAL_L029.""
: "<input type='checkbox' name='mygallery_slide_show' value='1' /> ".MYGAL_L029."")."
</td>
</tr>
<tr>
<td class='forumheader3'>".MYGAL_L049."</td>
<td class='forumheader3'>
<input type='checkbox' name='mg_icon_create' value='1' ".($pref['mg_icon_create'] ? "checked='checked'" : "")." /> ".MYGAL_L050."
<input type='checkbox' name='mg_view_create' value='1' ".($pref['mg_view_create'] ? "checked='checked'" : "")." /> ".MYGAL_L051."
<input class='tbox' type='text' name='mygallery_img_quality' size='5' value='".$pref['mygallery_img_quality']."'> ".MYGAL_L054."
<br><input type='checkbox' name='mg_file_rewrite' value='1' /> ".MYGAL_L052."
<input class='button' type='submit' name='tn_create' value='".MYGAL_L053."'></td>
</tr>
";

$text .= "
<tr>
<td class='forumheader3'>".MYGAL_L039."</td>
<td class='forumheader3'>
    <input type='checkbox' name='mg_minepage_logo' value='1' ".($pref['mg_minepage_logo'] ? "checked='checked'" : "")." /> ".MYGAL_L040."
    <input type='checkbox' name='mg_minepage_upload' value='1' ".($pref['mg_minepage_upload'] ? "checked='checked'" : "")." /> ".MYGAL_L068."
    <br>
    <input type='checkbox' name='mg_minepage_comment' value='1' ".($pref['mg_minepage_comment'] ? "checked='checked'" : "")." /> ".MYGAL_L069."
    <input type='checkbox' name='mg_minepage_random' value='1' ".($pref['mg_minepage_random'] ? "checked='checked'" : "")." /> ".MYGAL_L041."
</td>
</tr>
<tr>
<td class='forumheader3'>".MYGAL_L012."</td>
<td class='forumheader3'><input class='tbox' type='text' name='mygallery_title_image' size='60' value='".$pref['mygallery_title_image']."'></td>
</tr>
<tr>
<td class='forumheader3'>".MYGAL_L013."</td>
<td class='forumheader3'><input class='tbox' type='text' name='mygallery_gallery_name' size='60' value='".$pref['mygallery_gallery_name']."'></td>
</tr>
<tr>
<td class='forumheader3'>".MYGAL_L023."</td>
<td class='forumheader3'>"
    . ($pref['mygallery_nav_show'] ? "<input type='checkbox' name='mygallery_nav_show' value='1' checked='checked' /> ".MYGAL_L031."" : "<input type='checkbox' name='mygallery_nav_show' value='1' /> ".MYGAL_L031."").
    "<br><select class='tbox' name='mygallery_nav_position'>" 
    .($pref['mygallery_nav_position'] == "0" ? "<option value='0' selected='selected'>".MYGAL_L024."</option>" 
    : "<option value='0'>".MYGAL_L024."</option>")
    .($pref['mygallery_nav_position'] == "1" ? "<option value='1' selected='selected'>".MYGAL_L025."</option>" 
    : "<option value='1'>".MYGAL_L025."</option>")
    ."</select>
</td>
</tr>
<tr>
<td class='forumheader3'>".MYGAL_L048."</td>
<td class='forumheader3'>
    <select class='tbox' name='mygallery_hs_theme'>" 
    .($pref['mygallery_hs_theme'] == "0" ? "<option value='0' selected='selected'>White 10px border and drop shadow</option>" 
    : "<option value='0'>White 10px border and drop shadow</option>")
    .($pref['mygallery_hs_theme'] == "1" ? "<option value='1' selected='selected'>Drop shadow and no border</option>" 
    : "<option value='1'>Drop shadow and no border</option>")
    .($pref['mygallery_hs_theme'] == "2" ? "<option value='2' selected='selected'>Dark design with outer glow</option>" 
    : "<option value='2'>Dark design with outer glow</option>")
    .($pref['mygallery_hs_theme'] == "3" ? "<option value='3' selected='selected'>White outline with rounded corners</option>" 
    : "<option value='3'>White outline with rounded corners</option>")
    .($pref['mygallery_hs_theme'] == "4" ? "<option value='4' selected='selected'>No graphic outline</option>" 
    : "<option value='4'>No graphic outline</option>")
    .($pref['mygallery_hs_theme'] == "5" ? "<option value='5' selected='selected'>Slideshow with a controlbar</option>" 
    : "<option value='5'>Slideshow with a controlbar</option>")
    ."</select>
</td>
</tr>
<tr>
<td class='forumheader3'>".MYGAL_L030."</td>
<td class='forumheader3'>
    <select class='tbox' name='mygallery_memo_show'>"
    .($pref['mygallery_memo_show'] == "0" ? "<option value='0' selected='selected'>".MYGAL_L031."</option>" 
    : "<option value='0'>".MYGAL_L031."</option>")
    .($pref['mygallery_memo_show'] == "1" ? "<option value='1' selected='selected'>".MYGAL_L032."</option>" 
    : "<option value='1'>".MYGAL_L032."</option>")
    .($pref['mygallery_memo_show'] == "2" ? "<option value='2' selected='selected'>".MYGAL_L033."</option>" 
    : "<option value='2'>".MYGAL_L033."</option>")
    ."</select>
</td>
</tr>
<tr>
	<td class='forumheader3'>".MYGAL_L044." </td>
	<td class='forumheader3'>".($pref['mygallery_comments'] ? "<input type='checkbox' name='mygallery_comments' value='1' checked='checked' /> " : "<input type='checkbox' name='mygallery_comments' value='1' /> ")."
</td>
</tr>
<tr>
	<td class='forumheader3'>".MYGAL_L047." </td>
	<td class='forumheader3'>".($pref['mygallery_raters'] ? "<input type='checkbox' name='mygallery_raters' value='1' checked='checked' /> " : "<input type='checkbox' name='mygallery_raters' value='1' /> ")."
</td>
</tr>
<tr>
<td class='forumheader3'>".MYGAL_L055."</td>
<td class='forumheader3'><input class='tbox' type='text' name='mygallery_sort_type' size='5' value='".$pref['mygallery_sort_type']."'>
<br><b>NA</b> - Name ASC, <b>ND</b> - Name DESC,<br><b>DA</b> - Date ASC, <b>DD</b> - Date DESC.
</td>
</tr>
<tr>
<td class='forumheader3' colspan='2'><b>".MYGAL_L014."</b></td>
</tr>
<tr>
<td class='forumheader3'>".MYGAL_L015."</td>
<td class='forumheader3'><input class='tbox' type='text' name='mygallery_menu_caption' value='".$pref['mygallery_menu_caption']."'></td>
</tr>
<tr>
<td class='forumheader3'>".MYGAL_L017."</td>
<td class='forumheader3'><input class='tbox' type='text' name='mygallery_menu_img_size' size='10' value='".$pref['mygallery_menu_img_size']."'></td>
</tr>
<tr>
<td class='forumheader3'>".MYGAL_L042."</td>
<td class='forumheader3'><input class='tbox' type='text' name='mygallery_mine_cikle' size='5' value='".$pref['mygallery_mine_cikle']."'></td>
</tr>
<tr>
<td class='forumheader3' colspan='2'><div align='center'><input class='button' type='submit' name='updatesettings' value='".MYGAL_L018."'></div></td>
</tr>
</table>
</form>";

$captions = MYGAL_L019;
$ns -> tablerender($captions, $text);

}

//================= Manage form ===============
if ($action == 'manage') {

if ($mydb->db_Select("my_gallery", "*", "img_status = 'menu'")) {
      while($row = $mydb->db_Fetch()) {
        $folder_name[$row['img_name']] = $row['img_title'];
      }
}

$text = "<div style='text-align:center'>
	<table style='".USER_WIDTH."' class='fborder'>
	<tr>
	<td style='width:20%' class='forumheader3'>".MYGAL_L046."</td>
	<td style='width:80%' class='forumheader3'>";

    //---- Select folders list ----------
$folder = $pref['mygallery_folder'];
$text .= "<select name='gallery_sections' class='tbox' onchange=\"if(this.options[this.selectedIndex].value.indexOf('-') &amp;&amp; this.options[this.selectedIndex].value != '' &amp;&amp; this.options[this.selectedIndex].value != '&nbsp;'){ return document.location=this.options[this.selectedIndex].value; }\"><option value=''>".
($mygall_qs[2] !="" ? "".
($folder_name[$folder."/".urldecode($mygall_qs[1])."/".urldecode($mygall_qs[2])] != ""
? $folder_name[$folder."/".urldecode($mygall_qs[1])."/".urldecode($mygall_qs[2])]
: urldecode($mygall_qs[2]))
."" : "")
."</option>";

if ($handle = opendir($folder))
{
  while (false !== ($folder_a = readdir($handle)))
  {
   if ($folder_a != "." && $folder_a != ".." && $folder_a != "index.php")  { $nav_a[] = $folder_a; }
  }
closedir($handle);
}
sort($nav_a);
foreach ($nav_a as $folder_a)
        {
        $selector_text .= "<optgroup label='".
        ($folder_name[$folder."/".$folder_a] != "" ? $folder_name[$folder."/".$folder_a] : $folder_a."")
        ."'>";
        $nav_b = "";
        if ($handle = opendir("$folder/$folder_a"))
            {
            while (false !== ($folder_b = readdir($handle)))
                {
                 if ($folder_b != "." && $folder_b != ".." && $folder_b != "index.php")  { $nav_b[]= $folder_b; }
                }
            closedir($handle);
            }
        sort($nav_b);

        foreach ($nav_b as $folder_b)
                {
                $selector_text .= "<option value='".e_SELF."?manage:".$folder_a.":".$folder_b."'>".
                ($folder_name[$folder."/".$folder_a."/".$folder_b] != "" ? $folder_name[$folder."/".$folder_a."/".$folder_b] : $folder_b)
                ."</option>";
                }
        $selector_text .= "</optgroup>";
        }
$text .= $selector_text;
$text .= "</select></td></tr></table>";

    //---------- Select images -------------------

if ($mygall_qs[2] != "") { $gallery = urldecode ("".$folder."/".$mygall_qs[1]."/".$mygall_qs[2].""); }
else { $gallery = urldecode ("".$folder."/".$folder_a."/".$folder_b.""); }

$a = array();
$b = array();
$hdl=opendir($gallery);

if ($mydb->db_Select("my_gallery", "*", "img_status = 'upload'")) {
    $post_upload_list = "";
    while($row = $mydb->db_Fetch()) {

            $post_upload_list .= $row['img_name'];

        }

    }


if ($mydb->db_Select("my_gallery", "*", "img_id > 0")) {
    $db_img = array();
    while($row = $mydb->db_Fetch()) {

       $db_img[$row['img_name']][img_id] = $row['img_id'];
       $db_img[$row['img_name']][img_name] = $row['img_name'];
       $db_img[$row['img_name']][img_title] = $row['img_title'];
       $db_img[$row['img_name']][img_description] = $row['img_description'];
       $db_img[$row['img_name']][img_user] = $row['img_user'];

    }
}

while ($file = readdir($hdl)) {
    $str_tn = substr_count("$file", "tn_") + substr_count("$file", "tv_");

	$str_type = substr_count("$file", ".jpg") + substr_count("$file", ".JPG") + substr_count("$file", ".jpeg") + substr_count("$file", ".JPEG");

    $post_upload = substr_count("$post_upload_list", "$file");


//	if ($str_type!="0" and $str_tn!="1" and $post_upload != "1" and (USER or $post_members != "1")) {
  	if ($str_type!="0" and $str_tn!="1" and $post_upload != "1" ) {
        $a[] = $file;
        $b[] = date("Y-m-d_H-i-s", filemtime("$gallery/$file"));
        }
	}
closedir($hdl);

    // ------------ Sort images ----------------
switch ($pref['mygallery_sort_type']) {
case "NA":
    sort($a);
    break;
case "ND":
    rsort($a);
    break;
case "DA":
    array_multisort($b, SORT_ASC, $a);
    break;
case "DD":
    array_multisort($b, SORT_DESC, $a);
    break;
}

$l=sizeof($a);

$button_text = "
    <tr>
      <td class='forumheader4' style='text-align:center;'>
        <input class='button' type='submit' name='update' value='".MYGAL_L035."' />
        <input class='button' type='submit' name='delete' value='".MYGAL_L065."' />
        <select name='move_gallery' class='tbox' >".$selector_text."</select>
        <input class='button' type='submit' name='move' value='".MYGAL_L072."' />
      </td>
    </tr>
";

if ($mygall_qs[2] != "") { $gallery = urldecode ("".$folder."/".$mygall_qs[1]."/".$mygall_qs[2].""); }
else { $gallery = urldecode ("".$folder."/".$folder_a."/".$folder_b.""); }

$text .= "<form enctype='multipart/form-data' method='post'
          action='".e_SELF."?manage".($mygall_qs[2] != "" ? ":".$mygall_qs[1].":".$mygall_qs[2]."" : ":".$folder_a.":".$folder_b."")."'>
          <table style='".USER_WIDTH."' class='fborder'>
          ".$button_text."
          <tr><td class='forumheader4'>".$folder.
          "/ <input class='tbox' type='text' name='folder_a_name' size='30' value='"
          .($folder_name[urldecode($folder."/".$mygall_qs[1])] != ""
          ? $folder_name[urldecode($folder."/".$mygall_qs[1])]
          : urldecode($mygall_qs[1])).
          "'> /
          <input class='tbox' type='text' name='folder_b_name' size='30' value='"
          .($folder_name[urldecode($folder."/".$mygall_qs[1]."/".$mygall_qs[2])] != ""
          ? $folder_name[urldecode($folder."/".$mygall_qs[1]."/".$mygall_qs[2])]
          : urldecode($mygall_qs[2])).
          "' />
          <input type='hidden' name='folder_a_name_def' value='".
          ($folder_name[urldecode($folder."/".$mygall_qs[1])] != ""
          ? $folder_name[urldecode($folder."/".$mygall_qs[1])]
          : urldecode($mygall_qs[1])).
          "' />
          <input type='hidden' name='folder_b_name_def' value='".
          ($folder_name[urldecode($folder."/".$mygall_qs[1]."/".$mygall_qs[2])] != ""
          ? $folder_name[urldecode($folder."/".$mygall_qs[1]."/".$mygall_qs[2])]
          : urldecode($mygall_qs[2]))
          ."' />
          </td></tr>";

$text .= "<tr><td class='forumheader3'><div style='height:500px; overflow-y: auto;'><table class='fborder'  style='width:99%'>";
for ($k=0; $k<$l; $k++) {

$c_count = $mydb->db_Count("comments", "(*)", "WHERE comment_item_id = '".$db_img[$gallery."/".$a[$k]][img_id]."' AND comment_type = 'my_gallery'");

$text .="
<tr>
    <td class='forumheader3' style='width:30px' >
      <input type='checkbox' name='checked[".$gallery."/".$a[$k]."]' value='1' />
      <input type='hidden' name='img_name[".$gallery."/".$a[$k]."]' value='".$gallery."/".$a[$k]."' />
    </td>

    <td class='forumheader3'  style='width:130px; text-align:center;'>
        <a id='thumb_".$gallery."/".$a[$k]."'
        ".(file_exists($gallery."/tv_".$a[$k])
        ? "href='image.php?file=".$gallery."/tv_".$a[$k]."'"
        : "href='foto.php?img=".$gallery."/".$a[$k]."&h=".$pref['mygallery_foto_view_height']."&w=".$pref['mygallery_foto_view_width']."'")."
        class='highslide'
        onclick=\"return hs.expand(this, { captionId: 'caption_".$gallery."/".$a[$k]."' } )\">
        ".(file_exists($gallery."/tn_".$a[$k])
        ? "<img src='image.php?file=".$gallery."/tn_".$a[$k]."' />"
        : "<img src='foto.php?img=".$gallery."/".$a[$k]."&h=90&w=120' />")."
        </a>
        <div class='highslide-caption' id='caption_".$gallery."/".$a[$k]."'>".$tp->toHTML($gallery."/".$a[$k], true)."</div>
    </td>

    <td class='forumheader3'>
      <b>".MYGAL_L027."</b> ".$gallery."/".$a[$k]."
      ".($db_img[$gallery."/".$a[$k]][img_user] !="" ? "<b>".MYGAL_L067.":</b> ".$db_img[$gallery."/".$a[$k]][img_user]."" : "")."

      ".($c_count > 0
      ? "<a href='".e_PLUGIN."my_gallery/comments.php?comm_id=".$db_img[$gallery."/".$a[$k]][img_id]."'
      onclick=\"return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 700, objectHeight: 500} )\"
      class='highslide'>".MYGAL_L045." ".$c_count."</a>

      <div class='highslide-html-content' id='highslide-html' style='width: 700px'>
      	<div class='highslide-move' style='border: 0; height: 18px; padding: 2px; cursor: default'>
      	    <a href='#' onclick='return hs.close(this)' class='control'>".MYGAL_L057."</a>
              <a href='#' onclick='return false' class='highslide-move control'>".MYGAL_L056."</a>
      	</div>

      	<div class='highslide-body'></div>

      	<div style='text-align: center; border-top: 1px solid silver; padding: 5px 0'>
      		<small>
      	    	<i>".$_SERVER["HTTP_HOST"]."</i>
              </small>
      	</div>
      </div>"
      : "")."

      <br>".MYGAL_L036.":
      <br><input class='tbox' type='text' name='img_title[".$gallery."/".$a[$k]."]' size='50' value='".$db_img[$gallery."/".$a[$k]][img_title]."'>
      <br>".MYGAL_L037.":
      <br><textarea class='tbox' name='img_description[".$gallery."/".$a[$k]."]' rows='3' style='width: 90%'>".$db_img[$gallery."/".$a[$k]][img_description]."</textarea>
    </td>

</tr>
";
}

$text .= "</table></td></tr></div>";
//$text .= $button_text;
$text .= "</table></form>";



$captions = "Manage";
$ns -> tablerender($captions, $text);

}

//================= Upload form ===============
if ($action == 'upload') {
require_once(e_HANDLER."ren_help.php");

$mydb->db_Select("my_gallery", "*", "img_id > 0 AND img_status = 'upload' ORDER BY img_id");

$text = "<div style='text-align:center'>
	<form enctype='multipart/form-data' method='post' action='".e_SELF."?upload'>
	<table style='".USER_WIDTH."' class='fborder'>";

while($row = $mydb->db_Fetch()) {
    $info = getimagesize($row['img_name']);
    $text_rows .= "<tr>

    <td class='forumheader3' style='width:30px' >
      <input type='checkbox' name='checked[".$row['img_name']."]' value='1' />
      <input type='hidden' name='img_name[]' value='".$row['img_name']."' />
    </td>

    <td class='forumheader3'  style='width:130px; text-align:center;'>
        <a id='thumb_".$row['img_name']."'
        href='foto.php?img=".$row['img_name']."&h=".$pref['mygallery_foto_view_height']."&w=".$pref['mygallery_foto_view_width']."'
        class='highslide'
        onclick=\"return hs.expand(this, { captionId: 'caption_".$row['img_name']."' } )\">
        <img src='foto.php?img=".$row['img_name']."&h=90&w=120' />
        </a>
        <div class='highslide-caption' id='caption_".$row['img_name']."'>".$tp->toHTML($row['img_name'], true)."</div>
        <br>".MYGAL_L026." $info[0]x$info[1]
    </td>

    <td class='forumheader3'>
      <b>".MYGAL_L027."</b> ".$row['img_name']." <b>".MYGAL_L067.":</b> ".$row['img_user']."
      <br>".MYGAL_L036.":
      <br><input class='tbox' type='text' name='img_title[".$row['img_name']."]' size='50' value='".$row['img_title']."'>
      <br>".MYGAL_L037.":
      <br><textarea onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);' class='tbox' name='img_description[".$row['img_name']."]' rows='3' style='width: 90%'>".$row['img_description']."</textarea>
    </td>

    </tr>";
    }
if ($text_rows !="") {
    $text .= $text_rows;
    } else {
        $text .= "
            <tr>
            <td class='forumheader3' colspan='3' style='text-align:center;'>
            No upload images!!!
            </td>
            </tr>";
        }

$text .= "
    <tr>
      <td class='forumheader3' colspan='3' style='text-align:center;'>
        ".display_help()."
      </td>
    </tr>

    <tr>
      <td class='forumheader4' colspan='3' style='text-align:center;'>
        <input type='checkbox' name='mg_icon_create' value='1' ".($pref['mg_icon_create'] ? "checked='checked'" : "")." /> ".MYGAL_L050."
        <input type='checkbox' name='mg_view_create' value='1' ".($pref['mg_view_create'] ? "checked='checked'" : "")." /> ".MYGAL_L051."
        <input type='checkbox' name='mg_original_change' value='1' ".($pref['mg_original_change'] ? "checked='checked'" : "")." /> ".MYGAL_L071."
        &lt; <input class='tbox' type='text' name='mg_original_size' size='5' value='".($pref['mg_original_size'] != "" ? "".$pref['mg_original_size']."" : "1024")."' />
        ".MYGAL_L054." <input class='tbox' type='text' name='mygallery_img_quality' size='5' value='".$pref['mygallery_img_quality']."' />
      </td>
    </tr>

    <tr>
      <td class='forumheader3' colspan='3' style='text-align:center;'>
        <input class='button' type='submit' name='public' value='".MYGAL_L066."' />
        <input class='button' type='submit' name='delete' value='".MYGAL_L065."' />
      </td>
    </tr>

    </table></form>
    ";

$captions = "Upload";
$ns -> tablerender($captions, $text);

}


function admin_config_adminmenu()
{
  if (e_QUERY)
  {
	$tmp = explode(".", e_QUERY);
	$action = $tmp[0];
  }
  if (!isset($action) || ($action == ""))
  {
	$action = "options";
  }

  $mydb = new db();

  $var['options']['text'] = MYGAL_L005;
  $var['options']['link'] = "".e_SELF."";

  $var['img_upload']['text'] = MYGAL_L058;
  $var['img_upload']['link'] = "upload.php";

  $var['upload']['text'] = "".MYGAL_L074." (".$mydb->db_Count("my_gallery", "(*)", "WHERE img_status = 'upload'").")";
  $var['upload']['link'] ="".e_SELF."?upload";

  $var['manage']['text'] = MYGAL_L073;
  $var['manage']['link'] ="".e_SELF."?manage";

  show_admin_menu("Admin menu", $action, $var);
}

require_once(e_ADMIN."footer.php");

?>