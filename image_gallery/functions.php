<?php
/*
+---------------------------------------------------------------+
|	e107 website system
| http://e107.org
|	/image_gallery/functions.php
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
/*
	Upload an image and create the thumbnail. The thumbnail is stored
	under the thumbnail sub-directory of $uploadDir.

	Return the uploaded image name and the thumbnail also.
*/
   require_once("../../class2.php");

function uploadImage($inputName, $uploadDir, $widthpref)
{
	$image     = $_FILES[$inputName];
	$imagePath = '';
	$thumbnailPath = '';

	// if a file is given
	if (trim($image['tmp_name']) != '') {
		$ext = substr(strrchr($image['name'], "."), 1);

		// generate a random new file name to avoid name conflict
		// then save the image under the new file name
		$imagePath = md5(rand() * time()) . ".$ext";
		$result    = move_uploaded_file($image['tmp_name'], $uploadDir . $imagePath);

		if ($result) {
			// create thumbnail
			$thumbnailPath =  md5(rand() * time()) . ".$ext";

            $result = createThumbnail($uploadDir . $imagePath, $uploadDir . 'thumbnail/' . $thumbnailPath, $widthpref);
			// create thumbnail failed, delete the image
			if (!$result) {
				unlink($uploadDir . $imagePath);
				$imagePath = $thumbnailPath = '';
			} else {
				$thumbnailPath = $result;
			}
		} else {
			// the image cannot be uploaded
			$imagePath = $thumbnailPath = '';
		}

	}


	return array('image' => $imagePath, 'thumbnail' => $thumbnailPath);
}

/*
	Create a thumbnail of $srcFile and save it to $destFile.
	The thumbnail will be $width pixels.
*/
function createThumbnail($srcFile, $destFile, $width, $quality = 75)
{
	$thumbnail = '';
	if (file_exists($srcFile)  && isset($destFile))
	{
        $size        = getimagesize($srcFile);
		$w           = number_format($width, 0, ',', '');
		$h           = number_format(($size[1] / $size[0]) * $width, 0, ',', '');
		$thumbnail =  copyImage($srcFile, $destFile, $w, $h, $quality);
	}
	// return the thumbnail file name on sucess or blank on fail
	return basename($thumbnail);
}

/*
	Copy an image to a destination file. The destination
	image size will be $w X $h pixels
*/
function copyImage($srcFile, $destFile, $w, $h, $quality = 75)
{
    $tmpSrc     = pathinfo(strtolower($srcFile));
    $tmpDest    = pathinfo(strtolower($destFile));
    $size       = getimagesize($srcFile);

    if ($tmpDest['extension'] == "gif" || $tmpDest['extension'] == "jpg" || $tmpDest['extension'] == "jpeg")
    {
       if($tmpDest['extension'] == "jpeg")
       {
          $dest      = imagecreatetruecolor($w, $h);
       }elseif ($tmpDest['extension'] == "jpg"){
          $destFile  = substr_replace($destFile, 'jpg', -3);
          $dest      = imagecreatetruecolor($w, $h);
       }else{
          $dest      = imagecreatetruecolor($w, $h);
       }
    } elseif ($tmpDest['extension'] == "png") {
       $dest = imagecreatetruecolor($w, $h);
    } else {
      return false;
    }

    switch($size[2])
    {
       case 1:       //GIF
           $src = imagecreatefromgif($srcFile);
           break;
       case 2:       //JPEG
           $src = imagecreatefromjpeg($srcFile);
           break;
       case 3:       //PNG
           $src = imagecreatefrompng($srcFile);
           break;
       default:
           return false;
           break;
    }

    imagecopyresampled($dest, $src, 0, 0, 0, 0, $w, $h, $size[0], $size[1]);

    switch($size[2])
    {
       case 1:
           imagegif($dest,$destFile);
       case 2:
           imagejpeg($dest,$destFile, $quality);
           break;
       case 3:
           imagepng($dest,$destFile);
    }
    return $destFile;

}
/*
	Create the link for moving from one page to another
*/
function getPagingLink($totalResults, $pageNumber, $itemPerPage = 10, $strGet = '')
{
	$pagingLink    = '';
	$totalPages    = ceil($totalResults / $itemPerPage);
	
	// how many link pages to show
	$numLinks      = 10;

	// create the paging links only if we have more than one page of results
	if ($totalPages > 1) {
		$self = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] ;

		// show 'previous' link only if we're not
		// on page one
		if ($pageNumber > 1) {
			$page = $pageNumber - 1;
			if ($page > 1) {
				$prev = " <a href=\"$self?pageNum=$page&amp;$strGet\">[Prev]</a> ";
			} else {
				$prev = " <a href=\"$self?$strGet\">[Prev]</a> ";
			}

			$first = " <a href=\"$self?$strGet\">[First]</a> ";
		} else {
			$prev  = ''; // we're on page one, don't show 'previous' link
			$first = ''; // nor 'first page' link
		}
	
		// show 'next' link only if we're not
		// on the last page
		if ($pageNumber < $totalPages) {
			$page = $pageNumber + 1;
			$next = " <a href=\"$self?pageNum=$page&amp;$strGet\">[Next]</a> ";
			$last = " <a href=\"$self?pageNum=$totalPages&amp;$strGet\">[Last]</a> ";
		} else {
			$next = ''; // we're on the last page, don't show 'next' link
			$last = ''; // nor 'last page' link
		}

		$start = $pageNumber - ($pageNumber % $numLinks) + 1;
		//10 page bug
                if (($pageNumber % $numLinks) == 0 )
                  {
                      $start = 1;
                  }
                //show only 9 pages back.
                if ($start > 10){$start = $start - 9;}
		
		$end   = $start + $numLinks - 1;		
		
		$end   = min($totalPages, $end);

		$pagingLink = array();
		for($page = $start; $page <= $end; $page++)	{
			if ($page == $pageNumber) {
				$pagingLink[] = " $page ";   // no need to create a link to current page
			} else {
				if ($page == 1) {
					$pagingLink[] = " <a href=\"$self?$strGet\">$page</a> ";
				} else {	
					$pagingLink[] = " <a href=\"$self?pageNum=$page&amp;$strGet\">$page</a> ";
				}	
			}
	
		}

		$pagingLink = implode(' | ', $pagingLink);
		
		// return the page navigation link
		$pagingLink = $first . $prev . $pagingLink . $next . $last;
	}

	return $pagingLink;
}

/*
	Display the breadcrumb navigation on top of the gallery page
*/
/* Needs to work when chaning an image from 1 ablum to another */
 function showBreadcrumb()
{
	if (isset($_GET['album'])) {
		$album = (int)$_GET['album']; 

        $mydb = new db();
        $mydb->db_Connect($mySQLserver, $mySQLuser, $mySQLpassword, $mySQLdefaultdb);
        $mydb->db_Select("tbl_album", "al_name", "al_id = '$album'");

        //$result = $mydb->db_Fetch(MYSQL_ASSOC);
		//$result = mysql_query($query, $conn) or die('Error, get album name failed. ' . mysql_error());
		$row = $mydb->db_Fetch(MYSQL_ASSOC);
        $text .= ' &gt; <a href="image_gallery.php?page=list-image&amp;album=' . $album . '">' . $row['al_name'] . '</a>';
        if (!isset($_GET['image'])){return $text;}
		if (isset($_GET['image'])) {
			$image = (int)$_GET['image'];
            $mydb->db_Select("tbl_image", "im_title", "im_id = '$image'");
            //$query  = "SELECT im_title FROM ".MPREFIX."tbl_image WHERE im_id = '$image'";
			//$row = mysql_fetch_assoc($result);
            $row = $mydb->db_Fetch(MYSQL_ASSOC);
            $text .=  ' &gt; <a href="image_gallery.php?page=image-detail&amp;album=' . $album . '&amp;image=' . $image . '">' . $row['im_title'] . '</a>';
            return $text;
        }
	}

}

function listcategory($mydb, $highlight = 0)
{
	$mydb = new db();
    $mydb->db_Connect($mySQLserver, $mySQLuser, $mySQLpassword, $mySQLdefaultdb);
    $mydb->db_Select("tbl_category", "cat_id, cat_name, cat_description", "ORDER BY cat_id", "no-where");

    $categoryList = '';
    //while ($row = mysql_fetch_assoc($result)) {
    while ($row = $mydb->db_Fetch(MYSQL_ASSOC)) {
	    $categoryList .= '<option value="' . $row['cat_id'] . '"' ;

        if ($highlight != 0 AND $row['cat_id'] == $highlight)
        {
            $categoryList .= ' selected';
        }

	    $categoryList .= '>' . $row['cat_name'] . '</option>';
    }
    return $categoryList;
}

function rateimage($image_item)
{
global $globalmode, $style;

require_once(e_HANDLER."rate_class.php");
$rater = new rater;
$rate_text = "<div style='width:100%;'>";

$ratearray = $rater->getrating("image", $image_item);


if ($ratearray = $rater->getrating("image", $image_item))
{
	if ($ratearray[2] == "")
	{
		$ratearray[2] = 0;
	}
	$rate_text .= "<img src='".e_IMAGE."rate/lite/lev".$ratearray[1].".png' alt='' style='vertical-align:middle;' />\n";
	$rate_text .= "&nbsp;".$ratearray[1].".".$ratearray[2]." - ".$ratearray[0]."&nbsp;";
	$rate_text .= ($ratearray[0] == 1 ? "vote<br />" : "votes<br />");
}

if (!$rater->checkrated("image", $image_item) && USER)
{
	$rate_text .= $rater->rateselect("<b>"."Rate this"."</b>", "image", $image_item);
}
else if(!USER)
{
	$rate_text .= "&nbsp;&nbsp;log-in to rate this";
}
else
{
	$rate_text .= "&nbsp;&nbsp;Thanks for your vote";
}
$rate_text .= "</div>";

return $rate_text;

}

//Returns current date time in mysql format
function NOW()
{
  return date("Y-m-d H:i:s");
}

?>