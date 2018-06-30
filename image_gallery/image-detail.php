<?php
/*
+---------------------------------------------------------------+
|	e107 website system
| http://e107.org
|	/image_gallery/image-detail.php
|
| Revision: 0.9.7
| Date: 2008/02/15
| Author: Krassswr
|
|	krassswr@abv.bg
|
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
   require_once("../../class2.php");

// make sure the image id is present
//-------------------------------------------

//code for image resise.
function image_gallery_GetImageDim($image, $img_path)
{
    $image = $img_path.($image);
	$image_stats = getimagesize($image);
    $imageSize['w'] = $image_stats[0];
	$imageSize['h'] = $image_stats[1];
    return $imageSize;
}

function image_resize($image_for_resize,$img_gallery_img_dir,$img_Wsize,$img_HSize)
		{
			$imageSize = image_gallery_GetImageDim($image_for_resize, $img_gallery_img_dir);
            $imageWidth = $imageSize['w'];
			$imageHeight = $imageSize['h'];

			$whRatio = ($imageSize['w'] / $imageSize['h']);
			$hwRatio = ($imageSize['h'] / $imageSize['w']);

			if ($imageWidth > $img_Wsize)
			{
				$imageWidth = $img_Wsize;
				$isLimited = 1;
			}

			if ($imageHeight > $img_HSize)
			{
				$imageHeight = $img_HSize;
				$isLimited = 1;
			}

			if ($isLimited)
			{
				if ($imageSize['w'] > $imageSize['h']){
					$imageHeight = round($imageWidth / $whRatio);
				}elseif ($imageSize['h'] > $imageSize['w']){
					$imageWidth = round($imageHeight / $hwRatio);
				}
			}

		    $imgDims = ($imageWidth > 0 && $imageHeight > 0 ? ' width="'.$imageWidth.'" height="'.$imageHeight.'" border="0"' : '');
            return $imgDims;
		}
//end image resise.
//del image
if (!defined('ADMIN_DELETE_ICON') AND !defined('ADMIN_EDIT_ICON'))
{
	define("ADMIN_DELETE_ICON", "<img src='".e_IMAGE_ABS."admin_images/delete_16.png' alt='' title='".LAN_DELETE."' style='border:0px; height:16px; width:16px' />");
	define("ADMIN_DELETE_ICON_PATH", e_IMAGE."admin_images/delete_16.png");
    define("ADMIN_EDIT_ICON", "<img src='".e_IMAGE_ABS."admin_images/edit_16.png' alt='' title='".LAN_EDIT."' style='border:0px; height:16px; width:16px' />");
	define("ADMIN_EDIT_ICON_PATH", e_IMAGE."admin_images/edit_16.png");
}
/* DA ot tuk po4vam az   DELL */

if(isset($_POST['delete']))
{
	$tmp = array_keys($_POST['delete']);
	list($delete, $del_id) = explode("_", $tmp[0]);
    $del_id = (INT) $del_id;
}

if ($delete == "comment" && $del_id && ADMIN)
{
    $mydb->db_Delete("tbl_comment", "index_comment = '$del_id'"); //vnimavai sas skobite.
    //$result = mysql_query("DELETE FROM ".MPREFIX."tbl_comment WHERE index_comment = '$del_id'", $conn); //vnimavai sas skobite.
    //if (!$result) { die('Invalid query: ' . mysql_error()); }
	unset($delete, $del_id);
}
/* DA DELL END*/



 // EDITING
/*EDIT NEW*/
if(isset($_POST['edit']))
{
  	$tmp = array_keys($_POST['edit']);
	list($edit, $edit_id) = explode("_", $tmp[0]);
    $edit_id = (INT) $edit_id;
}

if ($edit == "commentid" && $edit_id && ADMIN)
{
   if (isset($_POST['editcomment']) AND $_POST['editcomment'] != ''){
        $comment = htmlentities(mysql_real_escape_string(trim($_POST['editcomment'])),ENT_QUOTES);
    }
   $mydb->db_Update("tbl_comment", "im_id_comment = '$comment' WHERE index_comment = '$edit_id'");
   //$result = mysql_query("UPDATE ".MPREFIX."tbl_comment SET im_id_comment = '$comment' WHERE index_comment = '$edit_id'", $conn); //vnimavai sas skobite.
   //if (!$result) { die('Error, updating comment: ' . mysql_error()); }
	unset($edit, $edit_id, $comment);
}
/*EDIT*/






if (USER AND isset($_POST['just']) AND isset($_POST['ipu'])
     AND isset($_POST['userid']) AND isset($_POST['imageid']))
{

    //if (is_string($_POST['uname'])){$uname = $_POST['uname'];}
    if (is_string($_POST['ipu'])){$ipu = $_POST['ipu'];}
    if (isset($_POST['userid'])){$userid = (int)$_POST['userid'];}
    if (isset($_POST['imageid'])){$imageid = (int)$_POST['imageid'];}
    if (isset($_POST['formata']) AND $_POST['formata'] != ''){
        $comment = mysql_real_escape_string(trim($_POST['formata']));
    }
    $mydb->db_Select("user", "user_name", "user_id='$userid'");
    //$result = mysql_query("SELECT user_name FROM ".MPREFIX."user WHERE user_id='$userid'");
    $uname = $mydb->db_Fetch(MYSQL_ASSOC);
    //$uname = mysql_fetch_assoc($result);
    $uname = $uname['user_name'];

    if (!$comment == '')
    {
      $mydb->db_Insert("tbl_comment", array("index_comment" => "NULL", "im_id" => "$imageid", "im_id_comment" => "$comment", "im_author" => "$uname", "im_author_id" => "$userid", "im_author_ip" => "$ipu", "comment_datestamp" => "NOW()")); //AMA vsi4ki poleta trqbva da imat stoinost.
    //$result = mysql_query("INSERT INTO ".MPREFIX."tbl_comment (index_comment, im_id, im_id_comment, im_author, im_author_id, im_author_ip, comment_datestamp) VALUES( NULL, $imageid, '$comment', '$uname', $userid, '$ipu', NOW())", $conn);   //AMA vsi4ki poleta trqbva da imat stoinost.
    /*if (!$result) {
         die('Invalid query: ' . mysql_error());
      }*/
    }
}
//-------------------------------------------

if (!isset($_GET['image'])) {
	echo "Image id is not defined";
} else {

	// get the image id
	$imageId = (int)$_GET['image'];
    $mydb->db_Select_gen("SELECT im_id, im_album_id, im_title, im_description, im_image,
	           im_view, al_name
			 FROM `#tbl_image` AS im, `#tbl_album` AS al
			 WHERE im_id = '".$imageId."' AND im.im_album_id = al.al_id");
    $result = $mydb->db_Fetch(MYSQL_ASSOC);

	if ($mydb->mySQLrows == 0) {
		// can't find an image with that id

$text .= '<p align="center">Image not found. Click <a href="image_gallery.php?page=list-image">here</a>
    to go to the image list</p> ';

	} else {

        //get names of user classes
        //check class
    function printclasses($author_id, $mydb)
    {
        $classnames = '';
        $propperuser = FALSE;
        $mydb->db_Select("user", "user_class,user_perms", "user_id = '$author_id'");

        if ($mydb->mySQLrows > 0)
        {
            $row1 = $mydb->db_Fetch(MYSQL_ASSOC);
            $userclasses = $row1['user_class'];
        }
        if ($row1['user_perms'] == "0" OR $row['user_perms'] == "0."){$classnames = "Admin<br />"; return $classnames;}
        $arrayuserclasses = explode(",", $userclasses);
        foreach ($arrayuserclasses as $key => $value)
        {
            $mydb->db_Select("userclass_classes", "userclass_name", "userclass_id = '$value'");

            if ($mydb->mySQLrows > 0)
              { $row1 = $mydb->db_Fetch(MYSQL_ASSOC); }
            $classnames .= $row1['userclass_name']."<br />";
        }
        return $classnames;
        //check class
        //get names of user classes
    }

        $image = $result;
        //$image = mysql_fetch_assoc($result);

		// find the previous and next image in this album

		// set the initial value for previous and next image id
		$prev = $next = 0;
        //number of view counter and protection
        if (!isset($_COOKIE['e107_imageGallery']))
        {
            $value = $imageId;
            setcookie("e107_imageGallery", $value, time()+180);  /* expire in 3 minute */
            $mydb->db_Select("tbl_image", "im_view", "im_id = '$imageId'");
            $row = $mydb->db_Fetch(MYSQL_ASSOC);
            //$query = "SELECT im_view FROM ".MPREFIX."tbl_image WHERE im_id = '$imageId'";
            //$result = mysql_query($query, $conn);
            //$row = mysql_fetch_assoc($result);

            $view_count = $row['im_view']+1;
            $mydb->db_Update("tbl_image", "im_view='$view_count' WHERE im_id='$imageId'");
            //$query = "update ".MPREFIX."tbl_image set im_view='$view_count' where im_id='$imageId'";
            //$result = mysql_query($query, $conn);
        }
        else
        {
            if (isset($_COOKIE['e107_imageGallery'])) {
               if ($_COOKIE['e107_imageGallery'] != $imageId)
               {
                  $mydb->db_Select("tbl_image", "im_view", "im_id = '$imageId'");
                  $row = $mydb->db_Fetch(MYSQL_ASSOC);
                  //$query = "SELECT im_view FROM ".MPREFIX."tbl_image WHERE im_id = '$imageId'";
                  //$result = mysql_query($query, $conn);
                  //$row = mysql_fetch_assoc($result);
                  $view_count = $row['im_view']+1;
                  $mydb->db_Update("tbl_image", "im_view='$view_count' WHERE im_id='$imageId'");
                  //$query = "update ".MPREFIX."tbl_image set im_view='$view_count' where im_id='$imageId'";
                  //$result = mysql_query($query, $conn);
               }
            }
        }
        //END number of view counter and protection
		// get the previous image
        $mydb->db_Select("tbl_image", "im_id", "im_id < '$imageId' AND im_album_id = {$image['im_album_id']}
				 ORDER BY im_id DESC
				 LIMIT 0, 1");
        $result = $mydb->db_Fetch(MYSQL_ASSOC);

       /* $query  = "SELECT im_id
				 FROM ".MPREFIX."tbl_image
				 WHERE im_id < '$imageId' AND im_album_id = {$image['im_album_id']}
				 ORDER BY im_id DESC LIMIT 0, 1";  */
		//$result = mysql_query($query, $conn) or die('Error, get image info failed. ' . mysql_error());

		if ($result->mySQLrows > 0) {
			$row = $result;
			$prev = $row['im_id'];
		}

        // get the next image
        $mydb->db_Select("tbl_image", "im_id", "im_id > '$imageId' AND im_album_id = {$image['im_album_id']}
				 ORDER BY im_id ASC
				 LIMIT 0, 1");
        $result = $mydb->db_Fetch(MYSQL_ASSOC);
		/*$query  = "SELECT im_id
				 FROM ".MPREFIX."tbl_image
				 WHERE im_id > '$imageId' AND im_album_id = {$image['im_album_id']}
				 ORDER BY im_id ASC LIMIT 0, 1"; */
		//$result = mysql_query($query, $conn) or die('Error, get image info failed. ' . mysql_error());

		if ($result->mySQLrows > 0) {
			$row = $result;
			$next = $row['im_id'];
		}
//fix bbcodes
//$text = $tp->toHTML($text,TRUE,"emotes_on");
$image['im_description'] = $tp->toHTML($image['im_description'],TRUE,"emotes_on");

//Rate images
$rate_sc = rateimage($image['im_id']);
  $re1='(image)';	# Word 1
  $re2='(_)';	# Single Character 1
  $re3='(gallery)';	# Word 2
  $re4='(\\.)';	# Single Character 2
  $re5='(php)';	# Word 3
  $re6='(\\?)';	# Single Character 3
  $re7='(page)';	# Word 4
  $re8='(=)';	# Single Character 4
  $re9='(image)';	# Word 5
  $re10='(-)';	# Single Character 5
  $re11='(detail)';	# Word 6
  $re12='(&)';	# Single Character 6
  $re13='(amp)';	# Word 7
  $re14='(;)';	# Single Character 7
  $re15='(album)';	# Word 8
  $re16='(=)';	# Single Character 8
  $re17='([-+]?\\d+)';	# Integer Number 1
  $re18='(&)';	# Single Character 9
  $re19='(amp)';	# Word 9
  $re20='(;)';	# Single Character 10
  $re21='(image)';	# Word 10
  $re22='(=)';	# Single Character 11
  $re23='([-+]?\\d+)';	# Integer Number 2

  if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5.$re6.$re7.$re8.$re9.$re10.$re11.$re12.$re13.$re14.$re15.$re16.$re17.$re18.$re19.$re20.$re21.$re22.$re23."/is", $rate_sc, $matches))
  {
      $rate_sc = preg_replace("/".$re1.$re2.$re3.$re4.$re5.$re6.$re7.$re8.$re9.$re10.$re11.$re12.$re13.$re14.$re15.$re16.$re17.$re18.$re19.$re20.$re21.$re22.$re23."/is",'image_gallery.php?page=rated',$rate_sc);
  }

//END Rate images

$text .='


    <tr>'.
        //<td class="forumheader3" style="text-align:center;"><a href="viewImage.php?type=glimage&name='.
        //$image['im_image'].'&amp;ingal=1" target="_blank"><img src="viewImage.php?type=glimage&name='.
        '<td class="forumheader3" style="text-align:center;"><a href="viewImage.php?type=glimage&name='.
        $image['im_image'].'&amp;ingal=1" target="_blank"><img src="images/gallery/'.
        $image['im_image'].'"';
$text .=image_resize($image['im_image'],$pref['img_GALLERY_IMG_DIR'],$pref['img_MAXIMG_WIDTH'],$pref['img_MAXIMG_HIGHT']).
        ' alt="'.$image['im_description'].'" /></a></td>
  </tr>
    <tr>
		<td class="forumheader2" style="text-align:left">'.$image['im_description']
            ."<br />".image_gallery_CONFIG_L70.' : '.$image['im_view']."<br />".$rate_sc.
            '</td>
    </tr>
    <tr>
        <td class="fcaption"><p align="center"><b> ';

if ($prev > 0) {

    $text.='<a href="image_gallery.php?page=image-detail&amp;album='.$image['im_album_id'].'&amp;image='.$prev.'">&lt;
            '.image_gallery_CONFIG_Lprev.'</a>';

}

            $text .="|";

if ($next > 0) {

    $text.='<a href="image_gallery.php?page=image-detail&amp;album='.$image['im_album_id'].'&amp;image='.$next.'">'.image_gallery_CONFIG_Lnext.'
            &gt;</a> ';

}

    $text.="</b></p>";
   if ($pref['img_enablecomments'])
   {
    $mydb->db_Select("tbl_comment", "index_comment, im_author, im_id_comment, comment_datestamp, im_author_ip, im_author_id", "im_id = '$imageId' ORDER BY index_comment DESC");
    //$result = mysql_query("SELECT index_comment, im_author, im_id_comment, comment_datestamp, im_author_ip, im_author_id FROM ".MPREFIX."tbl_comment WHERE im_id = '$imageId' ORDER BY index_comment DESC", $conn);
    if (!$mydb) {
         die('Invalid query: ' . mysql_error());
      }

          $i = 0;
          $num_rows = $mydb->mySQLrows;
       if ($num_rows !== 0)
       {
         if(ADMIN){
             $text .= "<table class='fborder' style='margin-top:7px;' width='100%' cellspacing='0' cellpadding='0'><tr>
                       <td class='fcaption' style='vertical-align:top'>".image_gallery_Lanauthor."</td>
                       <td class='fcaption' style='vertical-align:top'>".image_gallery_Lancomments."</td>
                       <td class='fcaption' style='vertical-align:top'>".image_gallery_Lanadmin."</td></tr>";
         }
          else
          {
             $text .= "<table style='margin-top:7px;' class='fborder' width='100%'><tr><td class='forumheader' style='vertical-align:top'>"
                        .image_gallery_Lanauthor."</td><td class='forumheader' style='vertical-align:top'>".image_gallery_Lancomments."</td></tr>";
          }

         $mydb2 = new db();
         $mydb2->db_Connect($mySQLserver, $mySQLuser, $mySQLpassword, $mySQLdefaultdb);

         while ($myrow = $mydb->db_Fetch(MYSQL_ASSOC)) {
                $text.="<tr><td width='100' class='forumheader3' style='vertical-align:top'><b>"
                        .$myrow[1]."</b><br />". printclasses($myrow[5], $mydb2).
                        "<br />".image_gallery_CONFIG_L23. ":".$myrow[3].
                        "</td><td class='forumheader3' style='vertical-align:top'>";



          //fix bbcodes
          $myrow[2] = $tp->toHTML($myrow[2],TRUE,"emotes_on");

          if(ADMIN){
             $text .= $myrow[2]."<DIV id=\"e".$myrow[0]."\" style=\"DISPLAY: none\">
                                <form action=".e_SELF."?".e_QUERY." id='image_gallery' method='post'><br /><center>
                                <table><tr><td>
                                <textarea name=\"editcomment\" rows=\"10\" cols=\"56\">".$myrow[2]."</textarea>
                                </td></tr><tr><td>
                                <input type=\"submit\" name='edit[commentid_{$myrow[0]}]' value=".image_gallery_CONFIG_L20." class='button' />
                                </td></tr></table></center></form></div>";
         }
          else
          {
          $text .= $myrow[2];
          }




                if (ADMIN){$text.="</td><td class='forumheader3' style='vertical-align:top' width='100'>".image_gallery_LanIp.": ".$myrow[4]."<br /><center>
                                   <form action=".e_SELF."?".e_QUERY." id='image_gallery' method='post'>
                                   <input type='image' title='".image_gallery_CONFIG_LCOMMDel."' name='delete[comment_{$myrow[0]}]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".image_gallery_Landelete."?')\" />
                                   <IMG alt=\"".image_gallery_CONFIG_LCOMMEdit."\"onclick=\"show_hide_field('e".$myrow[0]."');\" height=16 src='".ADMIN_EDIT_ICON_PATH."' width=\"16\" /></form></center></td>";}
                $text.="</tr>";
         }

         $mydb2->db_Close();

         $text .="</Table>";
       }
     if ( USER )
     {
        $text .="<form action=".e_SELF."?".e_QUERY." id=\"comments\" method=\"post\">
        <center><b>".image_gallery_LAN_SUBMCOME."</b>:<br />
        <input TYPE=\"hidden\" VALUE=".getip()." NAME=\"ipu\" />
        <input TYPE=\"hidden\" VALUE=".USERID." NAME=\"userid\" />
        <input TYPE=\"hidden\" VALUE=".$imageId." NAME=\"imageid\" />
        <textarea name=\"formata\" rows=\"10\" cols=\"56\"></textarea><br /><input type=\"submit\" name=\"just\" value='".image_gallery_LAN_SUBMCOME."' class='button' /></center></form>";
    }
    else {
        $test .="
         </td></table>";
    }
   }

 }
}

?>