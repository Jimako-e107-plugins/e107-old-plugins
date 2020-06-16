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

#-#############################################
# desc: prints out html for thumbnails of images in directory
function PrintThumbs()
{
	global $pref, $tp;
	global $config;
	global $html_out;
	global $sortOrd;
	global $IMperPage;
	global $imageFolder;
	global $tpt_position, $tpt_totalimages, $tpt_imagetable, $tpt_linknext, $tpt_linkprev, $tpt_firstdivide, $tpt_lastdivide, $tpt_pages, $tpt_sortorder, $tpt_imgperpage;
	global $imagelist;
	// Delete the previous linkback
	unset($_SESSION['linkback']);

	// Get the shortcodes that are used in the templates
	include(e_PLUGIN."easygallery/eg_shortcodes.php");
	// Determine the main category template
	if (file_exists(THEME."eg_template.php"))
	{
		require_once(THEME."eg_template.php");
	}
	else
	{
		require_once(e_PLUGIN."easygallery/templates/eg_template.php");
	}

	if (!file_exists($config['fulls'])) 
	{
		$oops_text = str_replace('[CONFIG_DIR]', '<b>'.$config['fulls'].'</b>', EG_CORE_05); 
		oops($oops_text);
		die;
	}
	// Thumb directory
	if (!file_exists($config['thumbs'])) 
	{ 
		if (!mkdir($config['thumbs'], 0755)) 
		{
			$oops_text = str_replace('[CONFIG_THUMBS]', '<b>'.$config['thumbs'].'</b>', EG_CORE_06); 
			oops($oops_text);
			die;
		}
	}
	// Check if thumbs need deletion
	ProcessThumbDelete();
	if ($config['albums'] == true)
	{
		$albumlist = GetAlbumList($config['fulls']);
	}
	if (!empty($sortOrd)) 
	{
		$config['sortOrder'] = $sortOrd;
	}
	if (!empty($IMperPage)) 
	{
		if($IMperPage == '9')
		{
			$config['rows'] = 3;
			$config['cols'] = 3;	
		}
		elseif($IMperPage == '15')
		{
			$config['rows'] = 5;
			$config['cols'] = 3;
		}
		elseif($IMperPage == '25')
		{
			$config['rows'] = 5;
			$config['cols'] = 5;
		}
		elseif($IMperPage == '50')
		{
			$config['rows'] = 10;
			$config['cols'] = 5;
		}
	}
	$config['columnsize']= 100/$config['cols']."%";
	if($config['albums'] == true)
	{ 	// If we are working with albums, then get the image list for the selected album
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
	// Processing for how many images to do on current page
	$config['start']	= ($config['page']*$config['cols']*$config['rows']);
	$config['max']		= ( ($config['page']*$config['cols']*$config['rows']) + ($config['cols']*$config['rows']) );
	if($config['max'] > count($imagelist)){$config['max']=count($imagelist);}
	// If there is 0 matches, show 0. otherwise show ($start+1)
	if ($config['max'] == '0'){$tpt_position = '0 - 0'; $tpt_totalimages = '0';}
	else{$tpt_position = ($config['start']+1).' - '.$config['max']; $tpt_totalimages = count($imagelist);}
	$temp = 1;
	// For all the images on the page
	for($i=$config['start']; $i<$config['max']; $i++)
	{
		if (preg_match("/\.(bmp)$/i", $imagelist[$i])) 
		{ 
			$thumb_image = $config['thumbs'].'/'.$config['album'].$imagelist[$i].'.jpg';
			$thumb_exists = file_exists($thumb_image);
		}
		else
		{
			$thumb_image = $config['thumbs'].'/'.$config['album'].$imagelist[$i];
			$thumb_exists = file_exists($thumb_image);
		}
		$desc_file = $imageFolder.$imagelist[$i].'.txt';
		$desc_exists = file_exists($desc_file);
		// Create thumb if not exist
		if(!$thumb_exists)
		{ 	// Check for safe mode
			if( !ini_get('safe_mode') )
			{
				set_time_limit(30);
			}
			$thumb_exists = ResizeImage($imageFolder.$imagelist[$i], $thumb_image, $config['size']);
		}
		else
		{ 	// If a thumbnail exists then check it's newer than the source.. otherwise, make a new thumb
			if(strftime(filemtime($thumb_image)) < strftime(filemtime($imageFolder.$imagelist[$i])))
			{	// Check for safe mode
				if( !ini_get('safe_mode') )
				{
					set_time_limit(30);
				}
				$thumb_exists = ResizeImage($imageFolder.$imagelist[$i], $thumb_image, $config['size']);
			}
		}
		$imagelist[$i] = rawurlencode($imagelist[$i]);
		if (preg_match("/\.(bmp)$/i",$imagelist[$i])) 
		{
			$thumb_image = $config['thumbs'].'/'.$config['album'].$imagelist[$i].'.jpg';
		}
		else
		{
			$thumb_image = $config['thumbs'].'/'.$config['album'].$imagelist[$i];
		}
		$tpt_imagetable .=  "<td valign='top' class='eg_border' width='".$config['columnsize']."'><div align='center'>";
		if($config['internalDisplay'] == true)
		{ 	// If we are displaying internally then point the link back to this program
			$tpt_imagetable .=  "<a href='".GetBaseURL()."?entry=".$imageFolder.$imagelist[$i]."' title='".$imagelist[$i]."'>"; 
		}
		else
		{ 	// Otherwise point it to the image file itself
			$tpt_imagetable .=  "<a href='".$imageFolder.$imagelist[$i]."' title='".$imagelist[$i]."' target='_blank'>";
		}
		if ($thumb_exists) 
		{
			$tpt_imagetable .=  "<img src='".$thumb_image."' border='0' alt='".$imagelist[$i]."'>";
		}
		else 
		{
			if($config['fileName'] == false)
			{ 	// We don't want to write out the Image Name if we are showing the filenames
				// otherwise we will end up with it twice!!
				$tpt_imagetable .=  $imagelist[$i];
			}
		}
		$pos = strrpos($imagelist[$i],'%7E');
		if($pos > 0)
		{	// Adjust file names of images uploaded by users
			$ext_pos = strrpos($imagelist[$i],'.');
			$imagelist[$i] = substr($imagelist[$i], 0, $pos).substr($imagelist[$i], $ext_pos);
			$user_id[$i] = substr($imagelist[$i], $pos, $ext_pos);
		}
		if(!$desc_exists)
		{ 	// Check if the file has a description txt file, and then display the description
			if($config['fileName'] == true)
			{ 	// If we are showing file names then add this under the image
				$tpt_imagetable .=  '<br />'.$imagelist[$i].'</a></div></td>';
			}
			else
			{
				$tpt_imagetable .=  '</a></div></td>';
			}
		}
		else
		{
			$handle = fopen($desc_file, 'r');
			if (!feof($handle)) 
			{
   				$desc_text = fgetss($handle, 1024);
  			}
			fclose($handle);
			if($config['fileName'] == true)
			{
				$tpt_imagetable .=  '<br />'.$imagelist[$i].'</a><br />'.$desc_text.'</div></td>';
			}
			else
			{
				$tpt_imagetable .=  '</a><br />'.$desc_text.'</div></td>';
			}
		}
		// If the max cols is reached, start new col
		if(($temp == $config['cols']) && ($i+1 != $config['max']))
		{
			$tpt_imagetable .=  "</tr><tr><td colspan='".$config['cols']."'>&nbsp;</td></tr><tr>";
			$temp=0;
		}
		$temp++;
	} // Foreach img
	// Check if there are no results
	if($config['start'] == $config['max'])
	{
		$tpt_imagetable = "<td style='align:center;' colspan='".$config['cols']."'>".EG_CORE_07."</td>";
	}
	// If there are empty "boxes" in the row (ie; last page)
	elseif($temp != $config['cols']+1)
	{
		$tpt_imagetable .=  "<td class='eg_border' align='center' colspan='".($config['cols']-$temp+1)."'>&nbsp;</td>";
	}
	$tpt_imagetable .= '</tr>';
	$tpt_imgperpage = "<select name='perPage' onChange='phpSG_Dropdown();'>";
	$tpt_imgperpage .= "<option value='9' ".(($IMperPage=='9')?'selected':'').">9</option>";
	$tpt_imgperpage .= "<option value='15' ".(($IMperPage=='15')?'selected':'').">15</option>";
	$tpt_imgperpage .= "<option value='25' ".(($IMperPage=='25')?'selected':'').">25</option>";
	$tpt_imgperpage .= "<option value='50' ".(($IMperPage=='50')?'selected':'').">50</option>";
	$tpt_imgperpage .= "</select>";

	$tpt_sortorder = "<select name='sortOrd' onChange='phpSG_Dropdown();'>";
	$tpt_sortorder .= "<option value='nameASC' ".(($config['sortOrder'] == 'nameASC')?'selected':'').">".EG_CORE_08."</option>";
	$tpt_sortorder .= "<option value='nameDESC' ".(($config['sortOrder'] == 'nameDESC')?'selected':'').">".EG_CORE_09."</option>";
	$tpt_sortorder .= "<option value='newFIRST' ".(($config['sortOrder'] == 'newFIRST')?'selected':'').">".EG_CORE_10."</option>";
	$tpt_sortorder .= "<option value='oldFIRST' ".(($config['sortOrder'] == 'oldFIRST')?'selected':'').">".EG_CORE_11."</option>";
	$tpt_sortorder .= "</select><input type='hidden' name='album' value='".$config['album']."'>";
	GetPageNumbers(count($imagelist));
	// Prepare album template replacements
	cachevars('eg_columns', $config['cols']);
	cachevars('eg_position', $tpt_position);
	cachevars('eg_max', $tpt_totalimages);
	cachevars('eg_total_pages', $config['totalPages']);
	cachevars('eg_link_prev', $tpt_linkprev);
	cachevars('eg_link_next', $tpt_linknext);
	cachevars('eg_first_divide', $tpt_firstdivide);
	cachevars('eg_last_divide', $tpt_lastdivide);
	cachevars('eg_pages', $tpt_pages);
	cachevars('eg_img_per_page', $tpt_imgperpage);
	cachevars('eg_sort_order', $tpt_sortorder);
	cachevars('eg_image_table', $tpt_imagetable);
	if ($config['albums'] == true)
	{
		cachevars('eg_album_list', BuildAlbumList($albumlist));
	}
	else
	{
		cachevars('eg_album_list', '');
	}
	cachevars('eg_version_footer', $config['version']);
	if (check_class($pref['easygallery_settings']['upload_class']))
	{
		$eg_upload = upload_images();
		cachevars('eg_upload', $eg_upload);
	}
	$_SESSION['linkback'] = e_SELF.(e_QUERY ? '?'.e_QUERY : '');
	$html_out = $tp->parseTemplate($EG_THUMBS, FALSE, $eg_shortcodes);
	return $html_out;
}#-#PrintThumbs()

function upload_images()
{
	global $pref;
	$upl_text = "
	<div onclick=\"expandit('add_images')\"><input class='button' type='submit' value='".EG_CORE_28."' /></div>
	<div id='add_images' style='padding-top:4px;display:none;text-align:center;margin-left:auto;margin-right:auto'>";
	$max_no_img=$pref['easygallery_settings']['max_uploads'];  // Maximum number of images (1-10) value to be set here, default set to 5
	$upl_text .=  "
		<form id='add_images' method='post' action='".e_SELF."' enctype='multipart/form-data'>
			<table border='0' width='90%' cellspacing='0' cellpadding='0' align='center'>";
	for($i=1; $i<=$max_no_img; $i++)
	{
		$upl_text .= "
				<tr>
					<td>".EG_CORE_29." ".$i."</td>
					<td>
						<input type=file name='images[]' class='button' style='color:black;' />
					</td>
				</tr>";
	}
	$upl_text .= "
				<tr>
					<td colspan='2' align='center'>
						<input type='hidden' name='e-token' value='".e_TOKEN."' />
						<input class='button' type='submit' name='add_images' value='".EG_CORE_28."' />
					</td>
				</tr>
			</table>
		</form>
	</div>";
	return $upl_text;
}

#-#############################################
# desc: ProcessThumbDelete()
# param: none
# returns: nothing
function ProcessThumbDelete()
{
	global $config;
	$totalImgCount	= 0;
	$totalThumbCount= 0;
	if(($config['deleteThumbs'] == 2) || ($config['deleteThumbs'] == 1 && date(j) == 1))
	{	// Let's count the total thumbnails we have
		$totalThumbCount = GetFileCount($config['thumbs']);
		// Now let's count the total images we have in all directories
		if ($config['albums'] == true)
		{	// Count the files in the root folder
			$totalImgCount	= GetFileCount($config['fulls']);
			$albumlist		= GetAlbumList($config['fulls']);
			// Loop through the album list counting the images in folders
			for($i=0; $i<count($albumlist) ; $i++)
			{
				$totalImgCount = $totalImgCount + GetFileCount($config['fulls'].$albumlist[$i].'/');
			}
			if($totalThumbCount > $totalImgCount)
			{
				$thumbFiles = GetFileList($config['thumbs'],1);
				for($i=0; $i<count($albumlist) ; $i++)
				{
					$imageFiles = GetFileList($config['fulls'].$albumlist[$i].'/',1);
					for($j=0; $j<count($imageFiles) ; $j++)
					{
						if (preg_match("/\.(bmp)$/i",$imageFiles[$j])) 
						{ 
							$imgFileName = $albumlist[$i].$imageFiles[$j].'.jpg';
						}
						else
						{
							$imgFileName = $albumlist[$i].$imageFiles[$j];
						}
						$key = array_search($imgFileName, $thumbFiles);
						if($key !== false)
						{
							$thumbFiles = array_trim($thumbFiles, $key);
						}
					}
				}
				// Now loop through our array of remaining items and kill off the files that are misfits
				for($i=0; $i<count($thumbFiles); $i++)
				{
					unlink($config['thumbs'].'/'.$thumbFiles[$i]);
				}
			}	
		}
		else
		{
			$totalImgCount = GetFileCount($config['fulls']);
			if($totalThumbCount > $totalImgCount)
			{
				$thumbFiles = GetFileList($config['thumbs'],1);
				$imageFiles = GetFileList($config['fulls'],1);
				for($i=0; $i<$totalImgCount ; $i++)
				{
					if (preg_match("/\.(bmp)$/i",$imageFiles[$i])) 
					{ 
						$imgFileName = $imageFiles[$i].'.jpg';
					}
					else
					{
						$imgFileName = $imageFiles[$i];
					}
					$key = array_search($imgFileName, $thumbFiles);
					if($key !== false)
					{
						$thumbFiles = array_trim($thumbFiles, $key);
					}
				}
				// Now loop through our array of remaining items and kill off the files that are misfits
				for($i=0; $i<count($thumbFiles); $i++)
				{
					unlink($config['thumbs'].'/'.$thumbFiles[$i]);
				}
			}
		}
	}
}#-#ProcessThumbDelete()

#-#############################################
# desc: BuildAlbumList($dirArr)
# param: dirArr - Array of folders to look at
# returns: html listing of folders
function BuildAlbumList($dirArr)
{
	global $config,$sortOrd,$IMperPage,$pref;
	$albumhtml = '';
	// If we have a 'root' image directory with files, then show a link back to it
	if(GetFileCount($config['fulls']) > 0)
	{
		if ($config['album'] == '')
		{
			$albumhtml .= "<div class='currentAlbum'>".EG_CORE_18."</div><br />";
		}
		else
		{
			$albumhtml .= "<a href='".GetBaseURL()."?page=&sort=".$sortOrd."&amp;perPage=".$IMperPage."&amp;album=' class='albums'>".EG_CORE_18."</a><br /><br />";
		}
	}
	$albumhtml .= '| '; // Start the album list with pipe separator
	for($i=0; $i<count($dirArr) ; $i++)
	{
		if($dirArr[$i] != $config['thumbs'])
		{ // Fix to not display the thumbs folder
			if(strstr($dirArr[$i],' '))
			{	// Replace directory with spaces to directory with underscores
				$old_dir_name = e_PLUGIN.'easygallery/'.$pref['easygallery_settings']['fulls'].$dirArr[$i];
				$new_dir_name = e_PLUGIN.'easygallery/'.$pref['easygallery_settings']['fulls'].str_replace(' ', '_', $dirArr[$i]);
				if (rename($old_dir_name, $new_dir_name))
				{
					$dirArr[$i] = str_replace(' ', '_', $dirArr[$i]);
				}
			}
			$index_file = e_PLUGIN.'easygallery/'.$pref['easygallery_settings']['fulls'].$dirArr[$i].'/index.html';
			if (!file_exists($index_file)) 
			{	// Create blank index.html if it does not exist yet; to protect folder from direct viewing
				$handle = fopen($index_file, 'w');
				fclose($handle);
			}
			if($dirArr[$i] == $config['album'])
			{	// Remove underscores from directory names for presentation purposes
				$albumhtml .= str_replace('_', ' ', $dirArr[$i]).' | ';
			}
			else
			{
				$albumhtml .= "<a href='".GetBaseURL()."?page=&amp;sort=".$sortOrd."&amp;perPage=".$IMperPage."&amp;album=".$dirArr[$i]."' class='albums'>".str_replace('_', ' ', $dirArr[$i]).'</a> | ';
			}
		}
	}
	$albumhtml .= '<br />'; // End the album list with an extra line break
	return $albumhtml;
}#-#BuildAlbumList()

#-#############################################
# desc: Adds form to add desription of image
# returns: html text
function add_description($description=NULL,$entry=NULL)
{
	if(ADMIN)
	{
		$f_text[0] = "
		<div onclick=\"expandit('add_description')\"><input class='button' type='submit' value='".EG_CORE_19."' /></div>";
		$f_text[1] = "
		<div id='add_description' style='padding-top:4px;display:none;text-align:center;margin-left:auto;margin-right:auto'>
			<form id='add_description' method='post' action='".e_SELF."'>
				<table class='forumheader3' style='width:95%'>
					<tr><td>
						<input class='tbox' size='100' type='text' name='description' value='".$description."' />
						<input type='hidden' name='return_url' value='".e_SELF."?entry=".$entry."' />
						<input type='hidden' name='entry' value='".$entry."' />
						<input type='hidden' name='e-token' value='".e_TOKEN."' />
						<div style='text-align:center;'><input class='button' type='submit' name='add_description' value='".EG_CORE_20."' /></div>
					</td></tr>
				</table>
			</form>
		</div>";
		return $f_text;
	}
}#-#add_description()

#-#############################################
# desc: Displays image passed from querystring
# returns: (bool) worked
function GetEntry()
{
	global $config,$imagelist,$tp,$cobj,$sql,$pref,$tp;
	// Get the shortcodes that are used in the templates
	include(e_PLUGIN."easygallery/eg_shortcodes.php");
	// Determine the main category template
	if (file_exists(THEME."eg_template.php"))
	{
		require_once(THEME."eg_template.php");
	}
	else
	{
		require_once(e_PLUGIN."easygallery/templates/eg_template.php");
	}
	$_GET['entry'] = $tp->toDB($_GET['entry']);
	if (!preg_match("/\.(jpe?g|gif|png|bmp)$/i",$_GET['entry']))
	{	// Check if the requested file is an image
		oops(EG_CORE_32);
		return false;
	}
	if(!file_exists($_GET['entry']))
	{	// Check if requested file exists
		oops(EG_CORE_21);
		return false;
	}
	$desc_file = $_GET['entry'].'.txt';
	$desc_exists = file_exists($desc_file);
	if ($desc_exists) 
	{
		$handle = fopen($desc_file, 'r');
		if (!feof($handle)) 
		{
			$desc = $description = fgetss($handle, 1024);
		}
		fclose($handle);
	}
	else
	{
		$desc = '-';
	}
	// Determine next/previous images
	$current_image_key	 = array_search(basename($_GET['entry']), $_SESSION['imagelist']);
	$prev_image_key 	 = $current_image_key - 1;
	$next_image_key 	 = $current_image_key + 1;
	$previous_image		 = $_SESSION['imagelist'][$prev_image_key];
	$next_image    		 = $_SESSION['imagelist'][$next_image_key];
	$current_url		 = e_SELF.(e_QUERY ? '?'.e_QUERY : '');
	$prev_image_url		 = str_replace(basename($_GET['entry']),$previous_image,urldecode($current_url)); 
	$next_image_url		 = str_replace(basename($_GET['entry']),$next_image,urldecode($current_url)); 
	if ($current_image_key <> '0') 
	{
		$previous_image_link = "<a href='".$prev_image_url."'>".EG_CORE_24."</a>";
	}
	else 
	{	// Do not show previous link at first image
		$previous_image_link = '&nbsp;'; // Return a HTML space for correct border behavior in IE		
	}
	if ($current_image_key+1 < count($_SESSION['imagelist'])) 
	{
		$next_image_link_start     = "<a href='".$next_image_url."'>";
		$next_image_link_middle    = EG_CORE_25;
		$next_image_link_end       = '</a>';
	} else 
	{ // Do not show next link at the last image
		$next_image_link_start = $next_image_link_middle = $next_image_link_end = '&nbsp;'; // Space for IE border
	}
	// Set the link back once at the first image
	if (!isset($_SESSION['linkback'])) 
	{
		$_SESSION['linkback'] = e_SELF.(e_QUERY ? '?'.e_QUERY : '');
	}
	
	$image_name = $image_name_incl_user = basename($_GET['entry']);
	
	// Resize the image if it is larger than the full_max_size setting
	if ($config['full_max_size'] < 30) { $config['full_max_size'] = 600; } // Protect against too small of a setting
	$new_name = str_replace(basename($_GET['entry']), 'tmp_'.basename($_GET['entry']), $_GET['entry']);
	$new_image = ResizeImage($_GET['entry'], $new_name, $config['full_max_size'], true);
	if ($new_image == true)
	{	// The uploaded image was larger than full_max_size
		unlink($_GET['entry']); // Delete original file
		rename($new_name, $_GET['entry']); // Give the resized image the original name
		chmod($_GET['entry'], 0777);
	}
	
	$pos = strrpos($image_name,'~');
	if($pos > 0)
	{	// Adjust file names of images uploaded by users
		$ext_pos = strrpos($image_name,'.');
		$user_id = substr($image_name, $pos+1, $ext_pos-$pos-1);
		$image_name = substr($image_name, 0, $pos).substr($image_name, $ext_pos);
		//if ($user = getx_user_data($user_id)) {
		if ($user = e107::user($user_id)) {
			$user_name = $user['user_name'];
		}
		$image_name_incl_user = $image_name." (".EG_CORE_31." <a href='".e_BASE."user.php?id.".$user_id."'>".$user_name."</a>)";
	}
	
	// Prepare image template replacements
	cachevars('eg_img_link_back', $_SESSION['linkback']);
	cachevars('eg_img_modified', filemtime($_GET['entry']));
	cachevars('eg_img_filename', $image_name_incl_user);
	cachevars('eg_img_description', $desc);
	cachevars('eg_img_image', array($next_image_link_start,$_GET['entry'],$next_image_link_end));
	cachevars('eg_version_footer', $config['version']);
	cachevars('eg_link_prev', $previous_image_link);
	cachevars('eg_link_next', $next_image_link_start.$next_image_link_middle.$next_image_link_end);
	$button = add_description($description,$tp->toDB($_GET['entry']));
	cachevars('eg_img_add_description', $button[0].$button[1]);
	if($pref['easygallery_settings']['show_comments'] == 1)
	{
		$image = substr($_GET['entry'], strrpos($_GET['entry'],'/')+1, (strlen($_GET['entry']) - strrpos($_GET['entry'],'/')));
		$path = substr($_GET['entry'], 0, (strrpos($_GET['entry'],'/')+1));
		if (isset($_POST['commentsubmit']))
		{
			$comment_to = $sql -> db_Select('eg_comment', '*', "path='".$path."' AND image='".$image."'");
			if($row = $sql->db_Fetch()) {
				$comment_to = $row['id'];
			}			
			if($comment_to == false)
			{
				$comment_to = $sql -> db_Insert('eg_comment', array('path' => $path, 'image' => $image));
			}
			$cobj->enter_comment($_POST['author_name'], $_POST['comment'], 'eg_comment', $comment_to, $pid, $_POST['subject']); // Comment_type is varchar(10)!
			$target=('gallery.php?entry='.$_GET['entry']);
			header('Location: '.$target);
		}
		// Show comments input section
		$comment_to = $sql -> db_Select('eg_comment', '*', "path='".$path."' AND image='".$image."'");
		if($row = $sql->db_Fetch()) 
		{
			$comment_to = $row['id'];
		}
		$comment_sub = 'Re: '.$tp->toFORM(str_replace(basename($_GET['entry']),$image_name, $_GET['entry']), false);
		$ret = $cobj->compose_comment('eg_comment', 'comment', $comment_to, $width, $comment_sub, $showrate=false, $return=true, $tablerender=false); // Comment_type is varchar(10)!
		$eg_img_comment = '<br />'.$ret['caption'];
		$eg_img_comment .= $ret['comment'];
		$eg_img_comment .= $ret['comment_form'];
		cachevars('eg_img_comment', $eg_img_comment);
	}
	if (check_class($pref['easygallery_settings']['upload_class']))
	{
		$eg_upload = upload_images();
		cachevars('eg_upload', $eg_upload);
	}
	$html_out = $tp->parseTemplate($EG_IMAGE, FALSE, $eg_shortcodes);
	return $html_out;
}#-#GetEntry()

#-#############################################
# desc: GetFileCount
# param: directory to look through
# returns: number of images in folder
function GetFileCount($dirname=".")
{
	$filecnt = 0;
	if ($handle = opendir($dirname)) 
	{
		while (false !== ($file = readdir($handle))) 
		{ 
			if (preg_match("/\.(jpe?g|gif|png|bmp)$/i",$file)) 
			{ 
				$filecnt++;
			} 
		}
		closedir($handle); 
	}
	return $filecnt;
}#-#GetFileCount()

#-#############################################
# desc: GetFileList
# param1: directory to look through
# param2: sorting
# returns: array with list of images
function GetFileList($dirname=".",$nosort=0)
{
	global $config;
	$list = array(); 
	if ($handle = opendir($dirname)) 
	{
		while (false !== ($file = readdir($handle))) 
		{ 
			if (preg_match("/\.(jpe?g|gif|png|bmp)$/i",$file)) 
			{
				$list[] = $file;
			}
		}
		closedir($handle); 
	}
	if($nosort == 0)
	{
		if($config['sortOrder'] == 'nameASC')
		{
			sort($list);
			reset($list);
		}
		elseif($config['sortOrder'] == 'nameDESC')
		{
			rsort($list);
			reset($list);
		}
		elseif($config['sortOrder'] == 'oldFIRST')
		{
			usort($list, 'sortOld');
			reset($list);
		}
		elseif($config['sortOrder'] == 'newFIRST'){
			usort($list, 'sortNew');
			reset($list);
		}
		else
		{
			sort($list);
			reset($list);
		}
	}
	return $list;
}#-#GetFileList()

#-#############################################
# desc: GetAlbumList
# param 1: StartFolder - Folder to look through
# returns: array with list of albums
function GetAlbumList($dirname,$exclude=NULL)
{
	global $config;
	$oldDir = getcwd();
	$list = array(); 
	if ($handle = opendir($dirname)) 
	{
		chdir($dirname);
		while (false !== ($file = readdir($handle))) 
		{ 
			if ((is_dir($file)) && ($file != '.') && ($file != '..')) 
			{ 
				if ($config['fulls'].$file <> $config['thumbs'] && $file <> 'thumbs')
				{
					$list[] = $file;
				}
			}
		}
		closedir($handle);
		chdir($oldDir);
	}
	sort($list);
	reset($list);
	return $list;
}#-#GetAlbumList()

#-#############################################
# desc: sorts an array of filenames based on file dates - Old to New
function sortOld($x, $y)
{
	global $config;
	global $imageFolder;

	if (strftime(filemtime($imageFolder.$x)) == strftime(filemtime($imageFolder.$y)))
		return 0;
	else if (strftime(filemtime($imageFolder.$x)) < strftime(filemtime($imageFolder.$y)))
		return -1;
	else
		return 1;
}

#-#############################################
# desc: sorts an array of filenames based on file dates - New to Old
function sortNew($x, $y)
{
	global $config;
	global $imageFolder;
	if (strftime(filemtime($imageFolder.$x)) == strftime(filemtime($imageFolder.$y)))
		return 0;
	else if (strftime(filemtime($imageFolder.$x)) > strftime(filemtime($imageFolder.$y)))
		return -1;
	else
		return 1;
}

#-#############################################
# desc: throw an error message
# param: [optional] any custom error to display
function oops($msg) 
{
	global $ns,$db;
	$back_text = str_replace('[BACK_BUTTON]', "<a href='javaScript:history.back();'><b>".EG_CORE_04."</b></a>", EG_CORE_03);
	$oops_text = "
	<table align='center'>
		<tr><td class='entry'>
			<br />".$msg."
			<br /><br />
			<hr size='1' noshade width='80%' class='desc'>
			<div style='text-align:center;'>".$back_text."</div>
			<br />
		</td></tr>
	</table>";
	$title = EG_CORE_02;
	$ns -> tablerender($title, $oops_text);
	require_once(FOOTERF);
}#-#oops()

#-#############################################
# desc: chooses method to resize image to correct ratio
# param: ($image) image reference of full size img to use ($newimage) what to save thumbnail as ($size) max width or height to resize to
# returns: (bool) if image was created
function ResizeImage($image, $newimage, $size, $full_max_size=NULL) 
{
	global $config;
	switch ($config['imagemethod']) 
	{
		case 'imagemagick':
		return ResizeImageUsingIM($image, $newimage, $size, $full_max_size);
			break;
		case 'gd1':
		case 'gd2':
			return ResizeImageUsingGD($image, $newimage, $size, $full_max_size);
			break;
		default:
			return false;
			break;
	}
}#-#ResizeImage()

#-#############################################
# desc: resizes image if GD was used
# param: ($image) image reference of full size img to use ($newimage) what to save thumbnail as ($size) max width or height to resize to
# returns: (bool) if image was created
function ResizeImageUsingGD($image, $newimage, $size, $full_max_size=NULL) 
{
	global $config; 
	list ($width,$height,$type) = GetImageSize($image);
	if($im = ReadImageFromFile($image,$type))
	{	// If image is smaller or equal than the $size, make it actual $size
		if($height <= $size && $width <= $size)
		{
			$newheight=$height;
			$newwidth=$width;
			if ($full_max_size == true)
			{	// EasyGallery fix to do nothing for full_max_size resize
				return false;
			}
		}
		// If image height is larger, height=$size, then calc width
		else if($height > $width)
		{
			$newheight=$size;
			$newwidth=($width / ($height/$size)); // Cast the resized width as int
		}
		else
		{ 	// If image width is larger, width=$size, then calc width
			$newwidth=$size;
			$newheight=($height / ($width/$size)); // Cast the resized height as int
		}
		if(!$config['universal'] || $full_max_size == true)
		{	// Overrule the configuration setting for full_max_size situations
			$im2=ImageCreateTrueColor($newwidth,$newheight);
			ImageCopyResampled($im2,$im,0,0,0,0,$newwidth,$newheight,$width,$height);
		} else
		{
			$im2=ImageCreateTrueColor($size,$size);
			$background = imagecolorallocate($im2, $config['borderR'], $config['borderG'], $config['borderB']);
			imagefilledrectangle($im2, 0, 0, $size - 1, $size - 1, $background);
			if($newwidth==$size)
			{
				ImageCopyResampled($im2,$im,0,(($size-$newheight)/2),0,0,$newwidth,$newheight,$width,$height);
			}
			else if($newheight==$size)
			{
				ImageCopyResampled($im2,$im,(($size-$newwidth)/2),0,0,0,$newwidth,$newheight,$width,$height);
			}
		}
		if(WriteImageToFile($im2,$newimage,$type))
		{
			return true;
		}
	}
	return false;
}#-#ResizeImageUsingGD()

#-#############################################
# desc: resizes image using imagemagick
# param: ($image) image reference of full size img to use ($newimage) what to save thumbnail as ($size) max width or height to resize to
# returns: (bool) if image was created
function ResizeImageUsingIM($image, $newimage, $size, $full_max_size=NULL) 
{
	global $config,$pref;
	if(!isset($pref['easygallery_settings']['identify']))
	{	// Use default e107 setting if no specific e107 setting is specified
		$config['identify'] = str_replace("convert", "identify", $pref['im_path']);
	}
	Exec($config['identify']." -ping -format \"%w %h\" \"$image\"", $sizeinfo);
	if (! $sizeinfo ) 
	{
		return false;
	}
	$size = explode(" ", $sizeinfo[0]);
	$width  = $size[0];
	$height = $size[1];
	if (!$width) 
	{
		return false;
	}
	if($height <= $size && $width <= $size)
	{ 	// If image is smaller or equal than the $size, make it actual $size
		$newheight=$height;
		$newwidth=$width;
		if ($full_max_size == true)
		{	// EasyGallery fix to do nothing for full_max_size resize
			return false;
		}
	}
	else if($height > $width)
	{	// If image height is larger, height=$size, then calc width
		$newheight=$size;
		$newwidth=($width / ($height/$size));//cast the resized width as int
	}
	else
	{ 	// If image width is larger, width=$size, then calc width
		$newwidth=$size;
		$newheight=($height / ($width/$size));//cast the resized height as int
	}
	if(!isset($pref['easygallery_settings']['convert']))
	{	// Use default e107 setting if no specific e107 setting is specified
		$config['convert'] = $pref['im_path'];
	}	
	Exec($config['convert']." -geometry \"$newwidth"."x"."$newheight\" -quality \"$config[imagequality]\" \"$image\" \"$newimage\"");
	return file_exists($newimage);
}#-#ResizeImageUsingIM()

#-#############################################
# desc: resizes image using imagemagick
# param: ($filename) filename of image to create ($type) int of type. 1=gif,2=jpeg,3=png,6=bmp
# returns: binary img
function ReadImageFromFile($filename, $type) 
{
	$imagetypes = ImageTypes();
	switch ($type) 
	{
		case 1 :
			if ($imagetypes & IMG_GIF)
			{
				return $im = ImageCreateFromGIF($filename);
			}
			break;
		case 2 :
			if ($imagetypes & IMG_JPEG)
			{
				return ImageCreateFromJPEG($filename);
			}
			break;
		case 3 :
			if ($imagetypes & IMG_PNG)
			{
				return ImageCreateFromPNG($filename);
			}
			break;
		case 6 :
			if (!include_once('phpthumbs.bmp.php')) 
			{
				oops(EG_CORE_27);
			}
			$phpThumbBMP = new phpthumb_bmp();
			return $phpThumbBMP->phpthumb_bmpfile2gd($filename);
			break;
		default:
			return 0;
	}
}#-#ReadImageFromFile()

#-#############################################
# desc: resizes image using imagemagick
# returns: binary img
function WriteImageToFile($im, $filename, $type) 
{
	global $config;
	switch ($type) {
		case 1 :
			return ImageGIF($im, $filename);
		case 2 :
			return ImageJpeg($im, $filename, $config['imagequality']);
		case 3 :
			return ImagePNG($im, $filename);
		case 6:
			return ImageJpeg($im, $filename, $config['imagequality']);
		default:
			return false;
	}
}#-#WriteImageToFile()

#-#############################################
# sub: GetPageNumbers
# desc: gets the pages in the list
function GetPageNumbers($entries) 
{
	global $config;
	global $sortOrd, $IMperPage;
	global $tpt_pages, $tpt_firstdivide, $tpt_lastdivide, $tpt_linknext, $tpt_linkprev;
	if (!empty($IMperPage))
	{
		$perPage = $IMperPage;
	} else
	{
		$perPage = '';
	}
	$config['totalPages']= ceil(($entries)/($config['cols']*$config['rows']));
	if( ($config['page']-1) >= 0)
	{ 	// echo out PREV
		$tpt_linkprev = "<a href='".GetBaseURL()."?page=".($config['page']-1)."&amp;sort=".$sortOrd."&amp;perPage=".$perPage."&amp;album=".$config['album']."' class='page' title='".EG_CORE_24."' alt='".EG_CORE_24."'><b>&laquo;</b></a>";
	}
	else
	{ 	// else no link
		$tpt_linkprev = '<b>&laquo;</b>';
	}
	// for each link, echo out page link
	$start=0; // starting image number
	$end=$config['totalPages']-1; // ending image number (total / number image on page)
	// cutoff size < page. or . page != last page (otherwise keep above values)
	if($config['maxShow'] < $config['page'] || (($config['cols']*$config['rows']*$config['maxShow'])< $entries) )
	{
		// if page >= cutoff size+1 -> start at page - cutoff size
		if($config['page'] >= ($config['maxShow']+1) && $config['page'] < $end-$config['maxShow']){ $start = $config['page']-$config['maxShow'];}
		elseif($end < $config['page']+$config['maxShow']+1 && $config['totalPages']-1 >= $config['maxShow']*2+1){$start = $config['totalPages']-1-$config['maxShow']*2;}
		else{$start=0;} // else start at 0
		// if page+cutoff+1 > number of pages total -> end= number of pages total
		if( $config['page']+$config['maxShow']+1 > $config['totalPages']-1 ){$end = $entries/($config['cols']*$config['rows']);}
		#&oops("$end,$config['maxShow']");
		elseif($start == 0 && $end > $config['maxShow']*2){$end = $config['maxShow']*2;}
		elseif($start == 0 && $config['totalPages'] <= $config['maxShow']*2){$end = $config['totalPages']-1;}
		else{$end = ($config['page']+$config['maxShow']);} //end = page+cutoff+1
	}
	// echo out divide marker
	if($start > 0){$tpt_firstdivide = '...';}
	else{$tpt_firstdivide = '-';}
	// echo out each of the numbers
	for($i=$start; $i<=$end ; $i++)
	{
		if($config['page']==$i){$tpt_pages = $tpt_pages . '<b>['.($i+1).']</b> ';}
		else{$tpt_pages = $tpt_pages . "<a href='".GetBaseURL()."?page=".$i."&amp;sort=".$sortOrd."&amp;perPage=".$perPage."&amp;album=".$config['album']."' class='page'><b>".($i+1)."</b></a> ";}
	}
	// echo out divide marker
	if(ceil($end) < $config['totalPages']-1){$tpt_lastdivide = '...';}
	else{$tpt_lastdivide = '-';}
	if( ($config['page']+1) <= $config['totalPages']-1)
	{ 	// echo out NEXT
		$tpt_linknext =  "<a href='".GetBaseURL()."?page=".($config['page']+1)."&amp;sort=".$sortOrd."&amp;perPage=".$perPage."&amp;album=".$config['album']."' class='page' title='".EG_CORE_25."' alt='".EG_CORE_25."'><b>&raquo;</b></a> ";
	}
	else
	{	// else no link
		$tpt_linknext = ' <b>&raquo;</b> ';
	}
}#-#end GetPageNumbers()

function GetBaseURL()
{
	$full_path = SITEURLBASE.e_PLUGIN_ABS.'easygallery/gallery.php';
	return $full_path;
}

function array_trim ( $array, $index ) 
{
	/* Usage:
	   $array : Array
	   $indey : Integer 
	   The value of $array at the index $index will be deleted by the function.
	*/
	if ( is_array ( $array ) ) 
	{
		unset ( $array[$index] );
		array_unshift ( $array, array_shift ( $array ) );
		return $array;
	}
	else 
	{
		return false;
	}
}
?>