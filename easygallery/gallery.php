<?php
/*
+------------------------------------------------------------------------------+
|   EasyGallery - a plugin by nlstart
|
|	Plugin Support Site: e107.webstartinternet.com
|
|	For the e107 website system visit http://e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+------------------------------------------------------------------------------+
*/
require_once('../../class2.php');
if (!defined('e107_INIT')) { exit(); }
require_once(HEADERF);
include_lan(e_PLUGIN.'easygallery/languages/'.e_LANGUAGE.'.php');
require_once('eg_class.php');
require_once(e_HANDLER.'comment_class.php');
$cobj = new comment;

// +++++++++++++++E107 UPDATABLE VARIABLES BELOW:
// Stop caching for all browsers
session_cache_limiter('nocache');
// Start a session to catch the image list
session_start();

// Receive the easygallery settings from the preferences
$config = $pref['easygallery_settings'];

// Template path (relative to this script)
$config['template'] = e_PLUGIN.'easygallery/templates/eg_template.php';
if (file_exists(THEME.'eg_template.php'))
{
	$config['template'] = THEME.'eg_template.php';
}

if (isset($_GET['comment']))
{	// Redirect from comment
	$comment_to = $sql -> db_Select('eg_comment', '*', "id ='".$_GET['comment']."'");
	if($row = $sql->db_Fetch()) 
	{
		$headerurl='?entry='.$row['path'].$row['image'];
	}
	header('Location: '. e_PLUGIN.'easygallery/gallery.php'.$headerurl);
	exit();	
}

// Settings juggling
if($config['imagemethod'] == 'imagemagick')
{
	if(strlen($config['convert']) == 0)
	{	// Apply default e107 core ImageMagick setting if override not specified
		$config['convert'] = $pref['im_path'];
	}
	if(strlen($config['identify']) == 0)
	{	// Apply default e107 core ImageMagick setting if override not specified
		$config['identify'] = str_replace('convert', 'identify', $pref['im_path']);
	}	
}

// rows of images per page
$config['rows'] = 3; // always start with default 3 (9 images with 3x3 grid)
// columns of images per page
$config['cols'] = 3; // always start with default 3 (9 images with 3x3 grid)
// max page numbers to show at once
$config['maxShow'] = 10;
// name of subfolder where thumbnails are to be created
$config['thumbs'] = $config['fulls'].'thumbs';

// EasyGallery core start
// Add a description
if (isset($_POST['add_description']) && ADMIN)
{	// Only administators may add or edit an image description
	$desc_file = $_POST['entry'].'.txt';
	if (strlen(trim($_POST['description'])) > 0)
	{	// create new or overwrite existing file
		$handle = fopen($desc_file, 'w');
		fwrite($handle, $tp->toDB($_POST['description']));
		fclose($handle);
	}
	else
	{	// delete existing file
		unlink($desc_file);
	}
	header('Location: '.$_POST['return_url']);
	exit();	
}

if (isset($_POST['add_images']) && check_class($pref['easygallery_settings']['upload_class']))
{
	$count_uploads = 0;
	while((list($key,$value) = each($_FILES['images']['name'])) && $pref['easygallery_settings']['max_uploads'] >= $count_uploads)
	{	// Check if the user is not going over the maximum number of upload limit	
		if(!empty($value))
		{	// Only upload if the user specified something to upload
			if (preg_match("/\.(jpe?g|gif|png|bmp)$/i",$value))
			{	// Check if the requested file has an image extension
				$filename = $value;
				$pos = strrpos($filename,'.');
				$filename1 = substr($filename, 0, $pos); 			// part of filename before file extension
				$filename2 = substr($filename,$pos); 				// file extension part of filename
				$filename3 = $filename1.'~'.USERID.$filename2;		// Add user id to file name before file extension
				$save_filename=str_replace(' ','_',$filename3);		// Replaces blank space by a underscore in file name
				$add = 'upload/'.$save_filename;
				copy($_FILES['images']['tmp_name'][$key], $add);
				chmod($add, 0777);
				$new_add = 'upload/tmp_'.$save_filename;
				$new_image = ResizeImage($add, $new_add, $config['full_max_size'], true);
				if ($new_image == true)
				{	// The uploaded image was larger than full_max_size
					unlink($add); // Delete original uploaded file
					rename($new_add, $add); // Give the resized image the original name
					chmod($add, 0777);
				}

	/*
	// START BEING INSPIRED BY SUBMITNEWS.PHP
	require_once(e_HANDLER.'upload_handler.php');		
	$uploaded = process_uploaded_files('upload/', FALSE, array('file_mask' => 'jpg,gif,png,bmp', 'max_file_count' => $pref['easygallery_settings']['max_uploads']));
	if (($uploaded === FALSE) || !is_array($uploaded))
	{	// Non-specific error
		$submitnews_error = TRUE;
		$message = SUBNEWSLAN_8;
	}
	elseif (varset($uploaded[$count_uploads]['error'],0) != 0)
	{
		$submitnews_error = TRUE;
		$message = handle_upload_messages($uploaded);
	}
	else
	{
		$filename = $uploaded[$count_uploads]['name'];
		$filetype = $uploaded[$count_uploads]['type'];
		$filesize = $uploaded[$count_uploads]['size'];
		$fileext  = substr(strrchr($filename, "."), 1);
		$today = getdate();
		$submitnews_file = USERID."_".$today[0]."_".str_replace(" ", "_", substr($submitnews_title, 0, 6)).".".$fileext;
		if (is_numeric($pref['subnews_resize']) && ($pref['subnews_resize'] > 30)  && ($pref['subnews_resize'] < 5000))
		{
			require_once(e_HANDLER.'resize_handler.php');
	
			if (!resize_image('uploads/'.$filename, 'uploads/'.$submitnews_file, $pref['subnews_resize']))
			{
			  rename('uploads/'.$filename, 'uploads/'.$submitnews_file);
			}
		}
		elseif ($filename)
		{
			rename('uploads/'.$filename, 'uploads/'.$submitnews_file);
		}
	}
	echo $message; // keeps giving SUBNEWSLAN_8

	if ($filename && !file_exists('uploads/'.$submitnews_file))
	{
		$submitnews_file = '';
	}
	// END BEING INSPIRED BY SUBMITNEWS.PHP	
	*/
				
				$upl_text .= "<img src='".e_PLUGIN."easygallery/images/check.gif' alt='' /> ".EG_CORE_30.": ".$filename."<br />";
			}
			else
			{	// Inform the user that the upload failed
				$upl_text .= "<img src='".e_PLUGIN."easygallery/images/failed.gif' alt='' /> ".$value." ".EG_CORE_33;
			}
		}
		$count_uploads++;
		unset($type, $new_add, $new_image);
	}
	if(isset($upl_text))
	{
		$upl_text .= "<br /><br /><div style='text-align:center;font-weight:bold;'>".EG_CORE_34."</div>";
		$ns -> tablerender(EG_CORE_28, $upl_text);
	}
}

$config['start']	= 0;
$config['max']		= 0;
$config['page']		= isset($_GET['page'])?intval($_GET['page']):'0';
$config['version']	= '';

$sortOrd			= isset($_GET['sort'])?$tp->toDB($_GET['sort']):'';
$IMperPage			= isset($_GET['perPage'])?$tp->toDB($_GET['perPage']):'';
$config['album']	= isset($_GET['album'])?$tp->toDB($_GET['album']):'';

$tpt_position		= '0';
$tpt_totalimages	= '0';
$tpt_imagetable		= '';
$tpt_linknext		= '';
$tpt_linkprev		= '';
$tpt_firstdivide	= '-';
$tpt_lastdivide		= '-';
$tpt_pages			= '';
$tpt_sortorder		= '';
$tpt_imgperpage		= '';
$imageFolder		= '';

if (!file_exists($config['template'])) 
{
	$oops_text = str_replace('[TEMPLATE_FILE]', '<b>'.$config['template'].'</b>', EG_CORE_01);
	oops($oops_text);
	die;
}

// Set the totals to zero if there is no session variable
if(!isset($_SESSION['imagelist'])) 
{	// Set the $imagelist for GetEntry and PrintThumbs if there is no session variable
	//if ($imagelist='' ||!isset($imagelist)){ // Performace: only build list if we do not have it
	if($config['albums'] == true)
	{
		$albumlist = GetAlbumList($config['fulls']);
		// If we are working with albums, then get the image list for the selected album
		if (empty($config['album']))
		{
			$imageFolder = $config['fulls'];
		}
		else
		{
			$imageFolder = $config['fulls'].$config['album'].'/';	
		}	
		if ((GetFileCount($imageFolder) == 0) && (empty($config['album'])) && (count($albumlist) > 0))
		{
			$config['album'] = $albumlist[0];
			$imageFolder = $config['fulls'].$config['album'].'/';
		}
		$imagelist = GetFileList($imageFolder,0);
	}
	else
	{
		$imageFolder = $config['fulls'];
		$imagelist = GetFileList($imageFolder,0);
	}
	$_SESSION['imagelist'] = $imagelist;
}

#######################################################################
// see if we have been given an image to view.
// if so, open it up (if viewing internal)
if((isset($_GET['entry'])) && ($config['internalDisplay'] == true))
{
	$text = GetEntry();
}
else
{
	$text = PrintThumbs();
}
#######################################################################
// Render the value of $text in a table.
$title = EG_CORE_00;
$ns -> tablerender($title, $text);

// === End of BODY ===
// use FOOTERF for USER PAGES and e_ADMIN.'footer.php' for admin pages
require_once(FOOTERF);
?>