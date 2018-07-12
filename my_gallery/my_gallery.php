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

$lan_file = e_PLUGIN."my_gallery/languages/".e_LANGUAGE.".php";
include_once((file_exists($lan_file) ? $lan_file : e_PLUGIN."my_gallery/languages/English.php"));

$mydb = new db();

// ============ Comments Add/Read Begin ==============
if ($_GET['comm_id'] && $pref['mygallery_comments']) {
$comm_id = $_GET['comm_id'];

if ($comm_id == "add") {
   	$img = $_GET['img'];

    $values = array("img_name" => $img);
    $mydb->db_Insert("my_gallery", $values);
    $comm_id = "";
    $mydb->db_Select("my_gallery", "img_id", "img_name = '".$img."'");
    while($row = $mydb->db_Fetch()) {
        $comm_id = $row['img_id'];
        }
    header("location:".e_SELF."?comm_id=".$comm_id."");
    exit;
    }

$mydb->db_Select("my_gallery", "*", "img_id = '".$comm_id."'");
    while($row = $mydb->db_Fetch()) {
        $img = $row['img_name'];
        $img_title = $row['img_title'];
        $img_text = $row['img_description'];
        }

    $info = getimagesize("$img");
  	$a_img = array();
    $a_img = explode("/", $img);

    $img_h = $pref['mygallery_foto_view_height'];
    $img_w = $pref['mygallery_foto_view_width'];

$img_title = $tp->toHTML($img_title, true);
$img_text = $tp->toHTML($img_text, true);

$comm_text = "
<br>
<div class='my_gall_comm_img'><img src='foto.php?img=".$img."&h=".$img_h."&w=".$img_w."'></div>
<br>
".($img_title != "" ? "<div class='my_gall_img_title'>".$img_title."</div>" : "" )."<div class='my_gall_img_text'>".$img_text."</div>
".(getperms("P") ? "<div class='memo_edit_buton'><a href='memo_edit.php?comm_id=".$comm_id."'>".MYGAL_L038."</a></div>" : "")."
<br><br><b>".MYGAL_L027." ".$a_img[3]."</b>
<br>".MYGAL_L026." ".$info[0]."x".$info[1]."
<br>".MYGAL_L046." <a href='http://".$_SERVER["HTTP_HOST"].e_HTTP.$PLUGINS_DIRECTORY."my_gallery/my_gallery.php?gallery=".$a_img[0]."/".$a_img[1]."/".$a_img[2]."'>".$a_img[1]."/".$a_img[2]."</a>
<br><a href='http://".$_SERVER["HTTP_HOST"].e_HTTP.$PLUGINS_DIRECTORY."my_gallery/".$img."' target='blank'>".MYGAL_L022."</a><br>
";

require_once(e_HANDLER."comment_class.php");
$cobj = new comment;

function pageRating($page_rating_flag, $comm_id)
	{
	  $rate_text = '';      // Notice removal
		if($page_rating_flag)
		{
			require_once(e_HANDLER."rate_class.php");
			$rater = new rater;
			$rate_text = "<br /><table style='width:100%'><tr><td style='width:50%'>";

			if ($ratearray = $rater->getrating("my_gallery", $comm_id))
			{
				if ($ratearray[2] == "")
				{
					$ratearray[2] = 0;
				}
				$rate_text .= "<img src='".e_IMAGE."rate/box/box".$ratearray[1].".png' alt='' style='vertical-align:middle;' />\n";
				$rate_text .= "&nbsp;".$ratearray[1].".".$ratearray[2]." - ".$ratearray[0]."&nbsp;";
				$rate_text .= ($ratearray[0] == 1 ? "vote" : "votes");
			}
			else
			{
				$rating .= LAN_PAGE_dl_13;
			}
			$rate_text .= "</td><td style='width:50%; text-align:right'>";

			if (!$rater->checkrated("my_gallery", $comm_id) && USER)
			{
				$rate_text .= $rater->rateselect("", "my_gallery", $comm_id);
			}
			else if(!USER)
			{
				$rate_text .= "&nbsp;";
			}
			else
			{
				$rate_text .= "";
			}
			$rate_text .= "</td></tr></table>";
		}
		return $rate_text;
	}



if (isset($_POST['commentsubmit']) && $pref['mygallery_comments'])
	{
	$cobj->enter_comment($_POST['author_name'], $_POST['comment'], 'my_gallery', $comm_id, $pid, $_POST['subject']);
	}

$action = "comments";
}
// ============ Comments Add/Read End ==============


// Config -------------------------------
$folder = $pref['mygallery_folder'];
$foto_in_page = $pref['mygallery_foto_in_page'];
$foto_rows = $pref['mygallery_rows'];
$foto_columns = $pref['mygallery_columns'];
$foto_icon_height = $pref['mygallery_foto_icon_height'];
$foto_icon_width = $pref['mygallery_foto_icon_width'];
$foto_view_height = $pref['mygallery_foto_view_height'];
$foto_view_width = $pref['mygallery_foto_view_width'];
$gallery_name = $pref['mygallery_gallery_name'];
$title_image = $pref['mygallery_title_image'];
$n_position = $pref['mygallery_nav_position'];
$tn_scr = "foto.php";
if ($pref['mygallery_slide_show']) $tn_scr = "tn_foto.php";
$caption_nav = MYGAL_L021;
$m_position = $pref['mygallery_memo_show'];
$n_show = $pref['mygallery_nav_show'];
$sort_type = $pref['mygallery_sort_type'];
// --------------------------------------

$gallery = $folder;
$page = 1;

if ($mydb->db_Select("my_gallery", "*", "img_status = 'menu'")) {
      while($row = $mydb->db_Fetch()) {
        $folder_name[$row['img_name']] = $row['img_title'];
      }
}

$text_nav = "<!-- #### TextNav #### -->";
if ($_GET['gallery']) $gallery = $_GET['gallery'];
if ($_GET['page']) $page = $_GET['page'];

// ================ Navigation =================
if (!$n_show) {
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
          $text_nav .= "<div class='mygall_folder_a'>".
          ($folder_name[$folder."/".$folder_a] != "" ? $folder_name[$folder."/".$folder_a] : $folder_a)
          ."</div>";
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
          $text_nav .= "<div class='mygall_folder_b'>";
          foreach ($nav_b as $folder_b) {
                  $text_nav .= "".
                  ($gallery != "$folder/$folder_a/$folder_b"
                  ? "<a href='".e_SELF."?gallery=$folder/$folder_a/$folder_b'>".
                  ($folder_name[$folder."/".$folder_a."/".$folder_b] != "" ? $folder_name[$folder."/".$folder_a."/".$folder_b] : $folder_b)
                  ."</a>  "
                  : ($folder_name[$folder."/".$folder_a."/".$folder_b] != "" ? $folder_name[$folder."/".$folder_a."/".$folder_b] : $folder_b)
                  )." ";
          }
          $text_nav .= "</div>";
  }
}

// ================= Gallery =========================
$text_gall = "\n <!-- #### Text Gall #### --> \n <div class='my_gall_page'>";

    // ========== Gallery Title Image ==================
if ($gallery == $folder and $pref['mg_minepage_logo']) {

  if ($title_image != "") $text_gall .= "<div align='center'><img src='$title_image'></div>";

}
//============= Last uploads gallery ======================
if ($gallery == $folder and $pref['mg_minepage_upload']) {

    $img_count = $mydb->db_Count("my_gallery", "(*)", "WHERE img_status = 'public'");

    if ($img_count >= $foto_columns) {

    $text_gall .= "<table>";
    $text_gall .= "<tr><th colspan='".$foto_columns."'>".MYGAL_L068."</th></tr>";
    $text_gall .= "<tr>";

    $img_id = array();
    $img_name = array();
    $img_title = array();
    $img_description = array();
    $img_user = array();


      $mydb->db_Select("my_gallery", "*", "img_status = 'public' ORDER BY img_id DESC");
      while($row = $mydb->db_Fetch()) {

            $img_id[] = $row['img_id'];
            $img_name[] = $row['img_name'];
            $img_title[] = $row['img_title'];
            $img_description[] = $row['img_description'];
            $img_user[] = $row['img_user'];

      }
      for ($i=0; $i<$foto_columns; $i++) {

            list($img_user_id, $img_user_name, $img_user_mail) = explode(".", $img_user[$i]);
            if ($img_user_mail !="") $img_user_mail = explode("@", $img_user_mail);
            if ($img_user_name == "") $img_user_name = MYGAL_L070;

        list($folder_0, $folder_a, $folder_b, $img_file) = explode("/", $img_name[$i]);
        $info = getimagesize("".$folder_0."/".$folder_a."/".$folder_b."/".$img_file."");

        $text_gall .= "<td width='". 100/$foto_columns ."%'>
        <a id='thumb_".$img_file."'
        ".(file_exists("".$folder_0."/".$folder_a."/".$folder_b."/tv_".$img_file."")
        ? "href='image.php?file=".$folder_0."/".$folder_a."/".$folder_b."/tv_".$img_file."'"
        : "href='foto.php?img=".$folder_0."/".$folder_a."/".$folder_b."/".$img_file."&h=$foto_view_height&w=$foto_view_width'")."
        class='highslide' onclick=\"return hs.expand(this, { captionId: 'caption_".$img_file."' } )\">
        ".(file_exists("".$folder_0."/".$folder_a."/".$folder_b."/tn_".$img_file."")
        ? "<img src='image.php?file=".$folder_0."/".$folder_a."/".$folder_b."/tn_".$img_file."' />"
        : "<img src='$tn_scr?img=".$folder_0."/".$folder_a."/".$folder_b."/".$img_file."&h=".$foto_icon_height."&w=".$foto_icon_width."' />")."
        </a>
        <div class='highslide-caption' id='caption_".$img_file."'>
        ".(($img_user_id != "" and $img_user_id != "0") ? "".MYGAL_L067.": <a href='".e_HTTP."user.php?id.".$img_user_id."'>".$img_user_name."</a>" : "")."
        ".(($img_user_id != "" and $img_user_id == "0") ? "".MYGAL_L067.": <a href='javascript:window.location=\"mai\"+\"lto:\"+\"$img_user_mail[0]\"+\"@\"+\"$img_user_mail[1]\";self.close();'>".$img_user_name."</a>" : "")."
        ".($img_title[$i] != "" ? "".MYGAL_L036.": ".$tp->toHTML($img_title[$i])."" : "".MYGAL_L027." ".$img_file."" )."
        ".($img_description[$i] !="" ? "<br>".MYGAL_L037.": ".$tp->toHTML($img_description[$i], true)."" : "")."
        <br>".MYGAL_L026." ".$info[0]."x".$info[1]."
        <a href='dload.php?file=".$folder_0."/".$folder_a."/".$folder_b."/".$img_file."'>".MYGAL_L022."</a> \n
        </div> \n
        <br>".($img_title[$i] != "" ? "".$tp->toHTML($img_title[$i])."" : "".$img_file."" )."
        <br>".(($img_user_id != "" and $img_user_id != "0") ? "".MYGAL_L067.": <a href='".e_HTTP."user.php?id.".$img_user_id."'>".$img_user_name."</a>" : "")."
        ".(($img_user_id != "" and $img_user_id == "0") ? "".MYGAL_L067.": <a href='javascript:window.location=\"mai\"+\"lto:\"+\"$img_user_mail[0]\"+\"@\"+\"$img_user_mail[1]\";self.close();'>".$img_user_name."</a>" : "")."
        ";


        //============ Comment slide ===================
        if ($pref['mygallery_comments']) {
           $c_count = $mydb->db_Count("comments", "(*)", "WHERE comment_item_id = '".$img_id[$i]."' AND comment_type = 'my_gallery'");
           $text_gall .= "<br>
            <a href='".e_PLUGIN."my_gallery/comments.php?comm_id=".$img_id[$i]."' onclick=\"return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 700, objectHeight: 500} )\" class='highslide'>".MYGAL_L045." ".$c_count."</a>

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
            </div>
            ";
            }

       $text_gall .= "</td>";

      }
 $text_gall .= "</tr></table>";
 }
}


//============= Last comments gallery ======================
if ($gallery == $folder and $pref['mg_minepage_comment']) {

    $img_count = $mydb->db_Count("comments", "(*)", "WHERE comment_type = 'my_gallery'");

    if ($img_count >= $foto_columns) {

    $text_gall .= "<table>";
    $text_gall .= "<tr><th colspan='".$foto_columns."'>".MYGAL_L069."</th></tr>";
    $text_gall .= "<tr>";

    $img_id = array();
    $img_name = array();
    $img_title = array();
    $img_description = array();
    $img_user = array();


      $qry = "SELECT c.*, m.*
            FROM #comments AS c, #my_gallery  AS m
            WHERE c.comment_type = 'my_gallery' and c.comment_item_id = m.img_id
            ORDER BY c.comment_id DESC";

      $mydb->db_Select_gen($qry);
      while($row = $mydb->db_Fetch()) {

            $img_id[] = $row['img_id'];
            $img_name[] = $row['img_name'];
            $img_title[] = $row['img_title'];
            $img_description[] = $row['img_description'];
            $img_user[] = $row['img_user'];
            $comments[] = $row['comment_comment'];

      }
      for ($i=0; $i<$foto_columns; $i++) {

            list($img_user_id, $img_user_name, $img_user_mail) = explode(".", $img_user[$i]);
            if ($img_user_mail !="") $img_user_mail = explode("@", $img_user_mail);
            if ($img_user_name == "") $img_user_name = MYGAL_L070;

        list($folder_0, $folder_a, $folder_b, $img_file) = explode("/", $img_name[$i]);
        $info = getimagesize("".$folder_0."/".$folder_a."/".$folder_b."/".$img_file."");

        $text_gall .= "<td width='". 100/$foto_columns ."%'>
        <a id='thumb_".$img_file."'
        ".(file_exists("".$folder_0."/".$folder_a."/".$folder_b."/tv_".$img_file."")
        ? "href='image.php?file=".$folder_0."/".$folder_a."/".$folder_b."/tv_".$img_file."'"
        : "href='foto.php?img=".$folder_0."/".$folder_a."/".$folder_b."/".$img_file."&h=".$foto_view_height."&w=".$foto_view_width."'")."
        class='highslide' onclick=\"return hs.expand(this, { captionId: 'caption_".$img_file."' } )\">
        ".(file_exists("".$folder_0."/".$folder_a."/".$folder_b."/tn_".$img_file."")
        ? "<img src='image.php?file=".$folder_0."/".$folder_a."/".$folder_b."/tn_".$img_file."' />"
        : "<img src='$tn_scr?img=".$folder_0."/".$folder_a."/".$folder_b."/".$img_file."&h=$foto_icon_height&w=$foto_icon_width' />")."
        </a>
        <div class='highslide-caption' id='caption_".$img_file."'>
            ".(($img_user_id != "" and $img_user_id != "0") ? "".MYGAL_L067.": <a href='".e_HTTP."user.php?id.".$img_user_id."'>".$img_user_name."</a>" : "")."
            ".(($img_user_id != "" and $img_user_id == "0") ? "".MYGAL_L067.": <a href='javascript:window.location=\"mai\"+\"lto:\"+\"$img_user_mail[0]\"+\"@\"+\"$img_user_mail[1]\";self.close();'>".$img_user_name."</a>" : "")."
            ".($img_title[$i] != "" ? "".MYGAL_L036.": ".$tp->toHTML($img_title[$i])."" : "".MYGAL_L027." ".$img_file."" )."
            ".($img_description[$i] !="" ? "<br>".MYGAL_L037.": ".$tp->toHTML($img_description[$i])."" : "")."
            <br>".MYGAL_L026." ".$info[0]."x".$info[1]."
        <a href='dload.php?file=".$folder_0."/".$folder_a."/".$folder_b."/".$img_file."'>".MYGAL_L022."</a> \n
        </div> \n
        <br>".($img_title[$i] != "" ? "".$tp->toHTML($img_title[$i])."" : "".$img_file."" )."
        <br>&laquo;".$tp->toHTML($comments[$i], true)."&raquo;
        ";


        //============ Comment slide ===================
        if ($pref['mygallery_comments']) {
           $c_count = $mydb->db_Count("comments", "(*)", "WHERE comment_item_id = '".$img_id[$i]."' AND comment_type = 'my_gallery'");
           $text_gall .= "<br>
            <a href='".e_PLUGIN."my_gallery/comments.php?comm_id=".$img_id[$i]."' onclick=\"return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 700, objectHeight: 500} )\" class='highslide'>".MYGAL_L045." ".$c_count."</a>

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
            </div>
            ";
            }

       $text_gall .= "</td>";

      }
 $text_gall .= "</tr></table>";
 }
}



// ================= Gallery Random Image ================
if ($gallery == $folder and $pref['mg_minepage_random']) {

    $text_gall .= "<table>";
    $text_gall .= "<tr><th colspan='".$foto_columns."'>".MYGAL_L041."</th></tr>";
    $text_gall .= "<tr>";
    for ($j=0; $j<$foto_columns; $j++) {

        $dir_s = e_PLUGIN."my_gallery/$folder";
        $a = array();
        if ($handle = opendir($dir_s))
        {
          while (false !== ($file = readdir($handle)))
          {
           if ($file != "." && $file != ".." && $file != "index.php")  $a[] = $file;
          }
        closedir($handle);
        }
        $count = sizeof($a);
        $r = rand(0,$count-1);
        $folder_a = $a[$r];

        $dir_s .= "/$folder_a";
        $a = array();
        if ($handle = opendir($dir_s))
        {
          while (false !== ($file = readdir($handle)))
          {
           if ($file != "." && $file != ".." && $file != "index.php")  $a[] = $file;
          }
        closedir($handle);
        }
        $count = sizeof($a);
        $r = rand(0,$count-1);
        $folder_b = $a[$r];

        $dir_s .= "/$folder_b";
        $a = array();
        if ($handle = opendir($dir_s))
        {
          while (false !== ($file = readdir($handle)))
          {
           $str_tn = substr_count("$file", "tn_") + substr_count("$file", "tv_");
        	$str_type = substr_count("$file", ".jpg") + substr_count("$file", ".JPG") + substr_count("$file", ".jpeg") + substr_count("$file", ".JPEG");
        	if (($str_type!="0")&&($str_tn!="1"))
        	   {
        	   $a[]=$file;
               }
          }
        closedir($handle);
        }
        $count = sizeof($a);
        $r = rand(0,$count-1);
        $file = $a[$r];
        $img_url = "$gallery/$folder_a/$folder_b/$file";

        $text_gall .= "<td width='". 100/$foto_columns ."%'>";

        $info = getimagesize("$img_url");

        $img_title = "";
        $img_description = "";
        $img_user_id = "";
        $img_user = "";
        $img_user_mail = "";
        $comm_id = "add";
        $c_count = 0;

        	if ($mydb->db_Select("my_gallery", "*", "img_name = '".$img_url."'")) {
                while($row = $mydb->db_Fetch()) {
                    $comm_id = $row['img_id'];
                    $img_title = $tp->toHTML($row['img_title'], true);
                    $img_description = $tp->toHTML($row['img_description'], true);
                    list($img_user_id, $img_user, $img_user_mail) = explode(".", $row['img_user']);
                    if ($img_user_mail != "") $img_user_mail = explode("@", $img_user_mail);
                    if ($img_user_name == "") $img_user_name = MYGAL_L070;

                }

                $c_count = $mydb->db_Count("comments", "(*)", "WHERE comment_item_id = '".$comm_id."' AND comment_type = 'my_gallery'");
            }

        //============== Icon and image slide =============
        $text_gall .= "
        <a id='thumb_".$file."'
        ".(file_exists("".$gallery."/".$folder_a."/".$folder_b."/tv_".$file."")
        ? "href='image.php?file=".$gallery."/".$folder_a."/".$folder_b."/tv_".$file."'"
        : "href='foto.php?img=".$gallery."/".$folder_a."/".$folder_b."/".$file."&h=".$foto_view_height."&w=".$foto_view_width."'")."
        class='highslide' onclick=\"return hs.expand(this, { captionId: 'caption_".$file."' } )\">
        ".(file_exists("".$gallery."/".$folder_a."/".$folder_b."/tn_".$file."")
        ? "<img src='image.php?file=".$gallery."/".$folder_a."/".$folder_b."/tn_".$file."' />"
        : "<img src='$tn_scr?img=".$gallery."/".$folder_a."/".$folder_b."/".$file."&h=".$foto_icon_height."&w=".$foto_icon_width."' />")."
        </a>
        <div class='highslide-caption' id='caption_".$file."'>
        ".(($img_user_id != "" and $img_user_id != "0") ? "".MYGAL_L067.": <a href='".e_HTTP."user.php?id.".$img_user_id."'>".$img_user."</a>" : "")."
        ".(($img_user_id != "" and $img_user_id == "0") ? "".MYGAL_L067.": <a href='javascript:window.location=\"mai\"+\"lto:\"+\"$img_user_mail[0]\"+\"@\"+\"$img_user_mail[1]\";self.close();'>".$img_user."</a>" : "")."
        ".($img_title != "" ? "".MYGAL_L036.": ".$img_title."" : "".MYGAL_L027." ".$file."" )."
        ".($img_description !="" ? "<br>".MYGAL_L037.": ".$img_description."" : "")."
        <br><a href='".e_SELF."?gallery=".$gallery."/".$folder_a."/".$folder_b."'>".
        ($folder_name[$gallery."/".$folder_a] !="" ? $folder_name[$gallery."/".$folder_a] : $folder_a)
        ."/".
        ($folder_name[$gallery."/".$folder_a."/".$folder_b] !="" ? $folder_name[$gallery."/".$folder_a."/".$folder_b] : $folder_b)
        ."</a>
        <br>".MYGAL_L026." $info[0]x$info[1]
        <a href='dload.php?file=".$gallery."/".$folder_a."/".$folder_b."/".$file."'>".MYGAL_L022."</a> \n
        </div> \n
        <br>".($img_title != "" ? "".$img_title."" : "".$file."" )."
        <br><a href='".e_SELF."?gallery=".$gallery."/".$folder_a."/".$folder_b."'>".
        ($folder_name[$gallery."/".$folder_a] !="" ? $folder_name[$gallery."/".$folder_a] : $folder_a)
        ."/".
        ($folder_name[$gallery."/".$folder_a."/".$folder_b] !="" ? $folder_name[$gallery."/".$folder_a."/".$folder_b] : $folder_b)
        ."</a>
        ";


        //============ Comment slide ===================
        if ($pref['mygallery_comments']) {
            $text_gall .= "<br>
            <a href='".e_PLUGIN."my_gallery/comments.php?comm_id=".$comm_id."".($comm_id=="add" ? "&img=".$gallery."/".$gallery."/".$folder_a."/".$folder_b."/".$file."" : "")."' onclick=\"return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 700, objectHeight: 500} )\" class='highslide'>".MYGAL_L045." ".$c_count."</a>

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
            </div>
            ";
         }

        $text_gall .= "</td>";
    }
    $text_gall .= "</tr>";
    $text_gall .= "</table>";
    $text_gall .= "
    <div id=\"controlbar\" class=\"highslide-overlay controlbar\">
    	<a href='#' class='previous' onclick='return hs.previous(this)' title='Previous (left arrow key)'></a>
    	<a href='#' class='next' onclick='return hs.next(this)' title='Next (right arrow key)'></a>
        <a href='#' class='highslide-move' onclick='return false' title='Click and drag to move'></a>
        <a href='#' class='close' onclick='return hs.close(this)' title='Close'></a>
    </div>
    ";
}


// ============ Select Gallery Images ===============
if ($gallery != $folder) {

$text_gall .= " \n ";
$a = array();
$b = array();
$hdl=opendir($gallery);

if ($mydb->db_Select("my_gallery", "*", "img_status = 'upload'")) {
    $post_upload_list = "";
    while($row = $mydb->db_Fetch()) {

            $post_upload_list .= $row['img_name'];

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

// ============= Sort images ===============
switch ($sort_type) {
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

$k_in_page = $page*$foto_in_page;
if ($k_in_page>$l) $k_in_page = $l;
$k_start = ($page-1)*$foto_in_page;

$a_b = array();
for ($k=$k_start; $k<$k_in_page; $k++) {   $a_b[] = $a[$k]; }

$l_b=sizeof($a_b);

if ($foto_rows > ($l_b/$foto_columns)) $foto_rows = $l_b/$foto_columns;

$column_wight = "width='". 100/$foto_columns ."%'";

$text_gall .= "<table>";
list($folder_0, $folder_a, $folder_b) = explode("/", $gallery);
$text_gall .= "<th colspan='".$foto_columns."'>".
($folder_name[$folder_0."/".$folder_a] != "" ? $folder_name[$folder_0."/".$folder_a] : $folder_a)
."/".
($folder_name[$folder_0."/".$folder_a."/".$folder_b] != "" ? $folder_name[$folder_0."/".$folder_a."/".$folder_b] : $folder_b)
."</th>";
for ($i=0; $i<$foto_rows; $i++) {
$text_gall .= "<tr>";
for ($j=0; $j<$foto_columns; $j++) {
$text_gall .= "<td ".$column_wight.">";
$k = $i*$foto_columns+$j;

if ($k<$l_b) {
    $value=$a_b[$k];
    $c_count = 0;
	$comm_id = "add";
    $img_title = "";
    $img_description = "";

	if ($mydb->db_Select("my_gallery", "*", "img_name = '".$gallery."/".$value."'")) {
        while($row = $mydb->db_Fetch()) {
            $comm_id = $row['img_id'];
            $img_title = $row['img_title'];
            $img_description = $row['img_description'];
            list($img_user_id, $img_user_name, $img_user_mail) = explode(".", $row['img_user']);
            if ($img_user_mail !="") $img_user_mail = explode("@", $img_user_mail);
            if ($img_user_name == "") $img_user_name = MYGAL_L070;

        }
        $img_title = $tp->toHTML($img_title, true);
        $img_description = $tp->toHTML($img_description, true);
    }

    $info = getimagesize("$gallery/$value");
//============== Icon and image slide =============
$text_gall .= "
<a id='thumb_$value'
".(file_exists("".$gallery."/tv_".$value."")
? "href='image.php?file=$gallery/tv_$value'"
: "href='foto.php?img=$gallery/$value&h=$foto_view_height&w=$foto_view_width'")."
class='highslide' onclick=\"return hs.expand(this, { captionId: 'caption_$value' } )\">
".(file_exists("".$gallery."/tn_".$value."")
? "<img src='image.php?file=".$gallery."/tn_".$value."' />"
: "<img src='$tn_scr?img=$gallery/$value&h=$foto_icon_height&w=$foto_icon_width' />")."
</a>
<div class='highslide-caption' id='caption_$value'>
    ".(($img_user_id != "" and $img_user_id != "0") ? "".MYGAL_L067.": <a href='".e_HTTP."user.php?id.".$img_user_id."'>".$img_user_name."</a>" : "")."
    ".(($img_user_id != "" and $img_user_id == "0") ? "".MYGAL_L067.": <a href='javascript:window.location=\"mai\"+\"lto:\"+\"$img_user_mail[0]\"+\"@\"+\"$img_user_mail[1]\";self.close();'>".$img_user_name."</a>" : "")."
    ".($img_title != "" ? "".MYGAL_L036.": ".$img_title."" : "".MYGAL_L027." ".$value."" )."
    ".($img_description !="" ? "<br>".MYGAL_L037.": ".$img_description."" : "")."
    <br>".MYGAL_L026." $info[0]x$info[1]
<a href='dload.php?file=$gallery/$value'>".MYGAL_L022."</a> \n
</div> \n
<br>".($img_title != "" ? "".$img_title."" : "".$value."" )."
";


//============ Comment slide ===================
if ($pref['mygallery_comments']) {

    $c_count = $mydb->db_Count("comments", "(*)", "WHERE comment_item_id = '".$comm_id."' AND comment_type = 'my_gallery'");

    $text_gall .= "<br>
    <a href='".e_PLUGIN."my_gallery/comments.php?comm_id=".$comm_id."".($comm_id=="add" ? "&img=".$gallery."/".$value."" : "")."' onclick=\"return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 700, objectHeight: 500} )\" class='highslide'>".MYGAL_L045." ".$c_count."</a>

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
    </div>
    ";
    }
}

$text_gall .= "</td>";
}
$text_gall .= "</tr>";
}
$text_gall .= "</table></div>";

$text_gall .= "
<div id=\"controlbar\" class=\"highslide-overlay controlbar\">
	<a href='#' class='previous' onclick='return hs.previous(this)' title='Previous (left arrow key)'></a>
	<a href='#' class='next' onclick='return hs.next(this)' title='Next (right arrow key)'></a>
    <a href='#' class='highslide-move' onclick='return false' title='Click and drag to move'></a>
    <a href='#' class='close' onclick='return hs.close(this)' title='Close'></a>
</div>
";

//========= Page navigation =======================
$text_gall .= "<div class='mygall_page_nav'> ";

    if ($page > 1) {
        $backe = $page - 1;
        $text_gall .= "<a href='".e_SELF."?gallery=$gallery&page=$backe'>&lt;&lt;&lt;</a> ";
         }
    for ($page_list=1; $page_list<(($l/$foto_in_page)+1); $page_list++) {
        if ($page != $page_list) {
        $text_gall .= "<a href='".e_SELF."?gallery=$gallery&page=$page_list'>|$page_list|</a>";
        } else {
         $text_gall .= "[$page_list]";
        }
     }
     $text_gall .= "".$k_start+1 ."-". $k_in_page ."/". $l;

    if ($page < ($page_list-1)) {
    $next = $page+1;
    $text_gall .= " <a href='".e_SELF."?gallery=$gallery&page=$next'>&gt;&gt;&gt;</a>";
    }

}


$text_gall .= "</div>";

// =========== my_gallery rendering ==============
$caption = "";
$text = "";

if ($m_position != "0") {
    if (file_exists("$gallery/index.php")) {
        include_once("$gallery/index.php");
        }
    }

$memo = $tp->toHTML($memo, true);

if (getperms("P") && $m_position != "0" && $gallery != $folder) $memo .= "<div class='memo_edit_buton'><a href='memo_edit.php?gallery=$gallery'>".MYGAL_L038."</a></div>";

$caption_n0 = $caption_nav;
$text_n0 = $text_nav; 
$caption_m1 = "";
$text_m1 = "";
$caption_m2 = $name;
$text_m2 = $memo;
$caption_n1 = "";  
$text_n1 = ""; 

if ($n_position == "1") { 
    $caption_n1 = $caption_nav;  
    $text_n1 = $text_nav; 
    $caption_n0 = "";  
    $text_n0 = ""; 
    }

if ($m_position == "1") { 
    $caption_m1 = $name;  
    $text_m1 = $memo; 
    $caption_m2 = "";  
    $text_m2 = ""; 
    }

if ($n_show) {
    $text_n0 = "";
    $text_n1 = "";
    }

require_once(HEADERF);

if ($text_n0 != "") $ns -> tablerender($caption_n0, $text_n0);
if ($text_m1 != "") $ns -> tablerender($caption_m1, $text_m1);

if ($action == "comments") {
    $comm_text .= pageRating($pref['mygallery_raters'], $comm_id);
    $ns -> tablerender($pref['mygallery_gallery_name'], $comm_text);
    $cobj -> compose_comment("my_gallery", "comment", $comm_id, "", $img, $showrate=FALSE);
    } else {
        $ns -> tablerender($gallery_name, $text_gall);
        }

if ($text_m2 != "") $ns -> tablerender($caption_m2, $text_m2);
if ($text_n1 != "") $ns -> tablerender($caption_n1, $text_n1);

require_once(FOOTERF);

?>