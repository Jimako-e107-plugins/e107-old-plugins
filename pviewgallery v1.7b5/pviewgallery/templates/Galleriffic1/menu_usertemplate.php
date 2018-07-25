<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        http://e107.org
|
|        PView Gallery by R.F. Carter
|        ronald.fuchs@hhweb.de
+---------------------------------------------------------------+
*/

// Include pview.class
require_once(e_PLUGIN."pviewgallery/pview.class.php");

class UserMenu {

function getScroller($imgArray) {
// returns complete html for menu-scroller
    $PView = new PView;
	$pv_path = e_PLUGIN."pviewgallery/";

	$box_dir = $PView -> getPView_config("menu_dir");
	
	if ($PView -> getPView_config("img_Link_menu_extJS")) {
		$script = $PView -> getPView_config("img_Link_extJS");
	} else {
		$script = "noscript";
	}
	
//	$box_pics = intval($PView -> getPView_config("menu_pics"));
	$menuPics = array();
	$menuPics = explode(",",$PView -> getPView_config("menu_pics"));
	if ($menuPics[1] > count($imgArray) OR !$menuPics[1]){
		$menuPics[1] = count($imgArray);
	}
	if ($menuPics[1] <= $menuPics[0]){
		if ($menuPics[1] > 1){
			$menuPics[0] = $menuPics[1] - 1;
		} else {
			$menuPics[0] = 1;
		}
		
	}
	$scroll_speed = $PView -> getPView_config("scroll_speed");
	
	$imageCount = 0;
	if ($PView -> getPView_config("force_imageSize")){
		$hor_grid = intval($PView -> getPView_config("force_Height"));
		$vert_grid = intval($PView -> getPView_config("force_Width"));
	} else {
		if ($PView -> getPView_config("thumb_height")){
			$hor_grid = intval($PView -> getPView_config("thumb_height"));
		} else {
			$hor_grid = 150; // default
		}
		if ($PView -> getPView_config("thumb_width")){
			$vert_grid = intval($PView -> getPView_config("thumb_width"));
		} else {
			$vert_grid = 150; // default
		}
	}
	$hor_grid = $hor_grid + 10; // min. space between pics
	$vert_grid = $vert_grid + 10; // min. space between pics	
	
	// image area dimension
	if ($box_dir == "hor"){
		$box_height = $hor_grid + 10;
		$box_width = ($menuPics[0]) * $vert_grid;
	} else {
		$box_height = ($menuPics[0]) * $hor_grid;
		$box_width = $vert_grid + 10;
	}	

	$pv_text .= "<script type='text/javascript' src = '".$pv_path."pview.js'></script>";
	$pv_text .= "<br /><table align='center'><tr><td align='center'>";
	if ($scroll_speed) {
		$pv_text .= "<div  style='position:relative; width:".$box_width."px; height: ".$box_height."px; overflow: hidden;' onmouseover='pv_stop()' onmouseout='pv_start()'>";
	} else {
		$pv_text .= "<div  style='position:relative; width:".$box_width."px; height: ".$box_height."px; overflow: hidden;'>";
	}
	
	foreach($imgArray as $dataset){
		$thumb = $PView -> getThumbPath($dataset['imageId']);
		$resize = $PView -> getResizePath($dataset['imageId']);

        if ($PView -> getPView_config("force_imageSize")){
			$imgHeight = intval($PView -> getPView_config("force_Height"));
			$imgWidth = intval($PView -> getPView_config("force_Width"));
		} else {
			$ImageSize = getimagesize($PView -> getThumbPath($dataset['imageId'],"REL",1));
			$imgHeight = $ImageSize[1];
			$imgWidth = $ImageSize[0]; 
		}

		switch ($script) {
					case "noscript":
					// image will open in pviewgallery
					$pv_text.= "<a href='".e_PLUGIN."pviewgallery/pviewgallery.php?image=".$dataset['imageId']."'>";
					break;
					case "lightbox":
					// image will open in lightbox group	
					$pv_text.= "<a href='".$resize."' rel='lightbox[pview_scroller]' title='".$dataset['name']."'>";
					break;
					case "lightbox26":
					// image will open in lightbox group	
					$pv_text.= "<a href='".$resize."' rel='lightbox[pview_scroller]' title='".$dataset['name']."'>";
					break;					
					case "shadowbox":
					// image will open in shadowbox group	
					$pv_text.= "<a href='".$resize."' rel='shadowbox[pview_scroller]' title='".$dataset['name']."'>";
					break;
					case "highslide":
					// image will open in highslide group
					if ($PView->getPView_config("img_Link_extJS_pview"))	{
						$pv_text.= "<a href='".$resize."' class='highslide' onclick=\"return hs.expand(this,pview_scroller)\" title='".$dataset['name']."'>";
					} else {
						// ehighslide plugin compatible
						$pv_text.= "<a href='".$resize."' class='highslide' onclick='return hs.expand(this)' title='".$dataset['name']."'>";
					}
					
					break;																
					
		}
		
		if ($box_dir == "vert") {
			$pv_text .= "<img title='".$dataset['name']."' name='pv_menu' id='pv_menu' src='".$thumb."' width='".$imgWidth."' height='".$imgHeight."' style='position:absolute; top:".$imageCount * $hor_grid."px; left:".round(($box_width - $imgWidth) / 2) ."px; padding:2px; border: 1px solid #ccc;'>";
		} 
		if ($box_dir == "hor") {
			$pv_text .= "<img title='".$dataset['name']."' name='pv_menu' id='pv_menu' src='".$thumb."' width='".$imgWidth."' height='".$imgHeight."' style='position:absolute; left:".$imageCount * $vert_grid."px; top:".round(($box_height - $imgHeight) / 2) ."px; padding:2px; border: 1px solid #ccc;'>";
		}		
		
		$pv_text.= "</a>";			
		
		$imageCount++;
	}		
	$pv_text .= "</div></td></tr></table><br />";
	if ($scroll_speed) {
		$pv_text .= "<script type='text/javascript'>
					var pv_space_hor = ".$vert_grid.";
					var pv_space_vert = ".$hor_grid.";
					var pv_direction = '".$box_dir."';
					var pv_speed = ".$scroll_speed.";
					var pv_boxwidth = ".$box_width.";
					var pv_boxheight = ".$box_height.";
					var pv_img_count = ".intval($menuPics[1]).";
					var pv_img_view = ".intval($menuPics[0]).";		
					window.setTimeout('pv_start()',1000);		
					</script>";
	}
	return $pv_text;
}

function getMenuFeatureImg() {
// returns the full content of Featured Images Menu
// so it can used for template integration
	$PView = new PView;
	
	// get all featured images
	$allImages = $PView->getListImagesData("feature");
	
	if ($PView -> getPView_config("img_Link_menu_extJS")) {
		$script = $PView -> getPView_config("img_Link_extJS");
	} else {
		$script = "noscript";
	}
	
	// prepare menu direction
    $menudir = $PView -> getPView_config("feature_dir");
	if ($menudir == "vert") {
		$spacer = "<br />";
	} else {
		$spacer = "&nbsp;";
	}
	
	// here starts the HTML
	
	// list all images
	foreach($allImages as $dataset) {
		// check permission
		if($PView -> getPermission("image",$dataset['imageId'],"View")) {
			
			$thumb = $PView -> getThumbPath($dataset['imageId']);
			$resize = $PView -> getResizePath($dataset['imageId']);
			$name = $PView -> getImageName($dataset['imageId']);
    		if ($PView -> getPView_config("force_imageSize")){
    			$imgHeight = intval($PView -> getPView_config("force_Height"));
    			$imgWidth = intval($PView -> getPView_config("force_Width"));
                $imgdim = "width='".$imgWidth."' height='".$imgHeight."'";
            } else {
                $imgdim = "";
            }
			switch ($script) {
				case "noscript":
				// image will open in pviewgallery
				$fimg.= "<a href='".e_PLUGIN."pviewgallery/pviewgallery.php?image=".$dataset['imageId']."'>";
				break;
				case "lightbox":
				// image will open in lightbox group	
				$fimg.= "<a href='".$resize."' rel='lightbox[pview_feature]' title='".$name."'>";
				break;
				case "shadowbox":
				// image will open in shadowbox group	
				$fimg.= "<a href='".$resize."' rel='shadowbox[pview_feature]' title='".$name."'>";
				break;
				case "highslide":
				// image will open in highslide group
				if ($PView->getPView_config("img_Link_extJS_pview"))	{
					$fimg.= "<a href='".$resize."' class='highslide' onclick=\"return hs.expand(this,pview_featured)\" title='".$name."'>";
				} else {
					// ehighslide plugin compatible
					$fimg.= "<a href='".$resize."' class='highslide' onclick='return hs.expand(this)' title='".$name."'>";
				}
				
				break;																
						
			}
			$fimg .= "<img title='".$name."' src='".$thumb."' ".$imgdim." style='margin:5px; padding:2px; border: 1px solid #ccc;' />";
			$fimg .= "</a>";
			$fimg .= $spacer;
		}
	}
	return $fimg;
}

function getMenuFeatureAlbum() {
// returns the full content of Featured Albums Menu
// so it can used for template integration
	$PView = new PView;
    
	// get all featured images
	$allAlbums = $PView->getListAlbumsData("feature");
	
	// prepare menu direction
    $menudir = $PView -> getPView_config("feature_dir");
	if ($menudir == "vert") {
		$spacer = "<br />";
	} else {
		$spacer = "&nbsp;";
	}
	
	// here starts the HTML
	
	// list all images
	foreach($allAlbums as $dataset) {
		// check permission
		if($PView -> getPermission("album",$dataset['albumId'],"View")) {
			
			$thumb = $PView -> getAlbumImage($dataset['albumId']);
			$name = $PView -> getAlbumName($dataset['albumId']);
			
    		if ($PView -> getPView_config("force_imageSize")){
    			$imgHeight = intval($PView -> getPView_config("force_Height"));
    			$imgWidth = intval($PView -> getPView_config("force_Width"));
                $imgdim = "width='".$imgWidth."' height='".$imgHeight."'";
            } else {
                $imgdim = "";
            }

			$falbum.= "<a href='".e_PLUGIN."pviewgallery/pviewgallery.php?album=".$dataset['albumId']."'>";

			$falbum .= "<img title='".$name."' src='".$thumb."' ".$imgdim." style='margin:5px; padding:2px; border: 1px solid #ccc;' />";
			$falbum .= "</a>";
			$falbum .= $spacer;
		}
	}
	return $falbum;
}

function getMenuComments () {
//returns the full content of Comments menu
    $PView = new PView;
    global $sql;
    global $tp;
    $pv_path = e_PLUGIN."pviewgallery/";
    
    if ($PView -> getPView_config("img_Link_menu_extJS")) {
    	$script = $PView -> getPView_config("img_Link_extJS");
    } else {
    	$script = "noscript";
    }
    
    // Viewstyle: img,imgcomm,comm
    $view = $PView -> getPView_config("comViewMenu");
    
    // comment count (own comments)
    $commentArray = array();
    
    $sql->db_Select("pview_comment", "*", "ORDER BY commentDate DESC", "nowhere");
    while ($comment = $sql -> db_Fetch()) {
    	if ($PView->getPermission("image",$comment['commentImageId'],"View")) {
    		array_push($commentArray,$comment);
    	}
    }
    
    
    // here starts the html code
    // script for DIV opener
    $pv_text = "";
    $pv_text .= "<script type='text/javascript' src = '".$pv_path."pview.js'></script>";
    
    // buttons
    
    $pv_text .= "<center>";
    $pv_text .= "<input class='button' type='button' value='".LAN_MENU_23."' onclick='pv_NewComments()'> ";
    $pv_text .= "<input class='button' type='button' value='".LAN_MENU_24."' onclick='pv_OwnComments()'> ";
    $pv_text .= "</center>";
    
    
    $pv_text .= "<div name='pview_menu_NewComments' id='pview_menu_NewComments' style='display:block;'>";
    $pv_text .= "<br /><table width='95%'>";
    if (count($commentArray)) {
    	$comm_count = 1;
    	foreach($commentArray as $key => $dataset) {
    		$user = $PView ->getUserData($dataset['commente107userId']);
    		$resize = $PView -> getResizePath($dataset['commentImageId']);
            $thumb = $PView -> getThumbPath($dataset['commentImageId']);
    		$name = $PView -> getImageName($dataset['commentImageId']);
    		if ($PView -> getPView_config("force_imageSize")){
    			$imgHeight = intval($PView -> getPView_config("force_Height"));
    			$imgWidth = intval($PView -> getPView_config("force_Width"));
                $imgdim = "width='".$imgWidth."' height='".$imgHeight."'";
            } else {
                $imgdim = "";
            }
            
    			switch ($script) {
    						case "noscript":
    						// image will open in pviewgallery
    						$pv_Link = "<a href='".e_PLUGIN."pviewgallery/pviewgallery.php?image=".$dataset['commentImageId']."'>";
    						break;
    						case "lightbox":
    						// image will open in lightbox group	
    						$pv_Link = "<a href='".$resize."' rel='lightbox[pview_menu_coml]' title='".$name."'>";
    						break;
    						case "shadowbox":
    						// image will open in shadowbox group	
    						$pv_Link = "<a href='".$resize."' rel='shadowbox[pview_menu_coml]' title='".$name."'>";
    						break;
    						case "highslide":
    						// image will open in highslide group
    						if ($PView->getPView_config("img_Link_extJS_pview"))	{
    							$pv_Link = "<a href='".$resize."' class='highslide' onclick=\"return hs.expand(this,pview_menu_coml)\" title='".$name."'>";
    						} else {
    							// ehighslide plugin compatible
    							$pv_Link = "<a href='".$resize."' class='highslide' onclick='return hs.expand(this)' title='".$name."'>";
    						}
    						break;																	
    						
    			}		
    			// Preview text without html format (delete also [html] tags if WYSIWYG is used for write comment)	
    			$preview_Text = mb_substr(strip_tags($tp->toHTML($dataset['commentText'], TRUE)),0,$PView -> getPView_config('menu_comm_length'),'UTF-8');
    			
    			switch ($view) {
    			     case "img":
                     // image only
                        $pv_text .= "<tr><td style='padding-bottom:5px; text-align: center;'>".$pv_Link."<img src='".$thumb."' ".$imgdim." style='padding:2px; border: 1px solid #ccc;' /></a><br />".LAN_MENU_32.$user['user_name'].", ".date('d.m.Y',$dataset['commentDate'])."</td></tr>";
                     break;
                     case "imgcomm":
                     // image and comment
                        $pv_text .= "<tr><td style='padding-bottom:5px; text-align: center;'>".$pv_Link."<img src='".$thumb."' ".$imgdim." style='padding:2px; border: 1px solid #ccc;' /></a><br />".$user['user_name'].", ".date('d.m.Y',$dataset['commentDate']).":<br />";
                        $pv_text .= $preview_Text." ...</td></tr>";
                     break;
                     case "comm":
                     // comment text only
                        $pv_text .= "<tr><td style='padding-bottom:5px;'>".$user['user_name'].", ".date('d.m.Y',$dataset['commentDate']).":<br />".$pv_Link.$preview_Text." ...</a></td></tr>";
                     break; 
       			}
                
    			
                
                
    			if ($comm_count++ > $PView -> getPView_config('menu_comm_count')-1) { break; }
    	}
    	$pv_text .= "<tr><td><br />".LAN_MENU_25." ".$PView -> getPView_config('menu_comm_count')." ".LAN_MENU_26."</td></tr>";
    } else {
    	$pv_text .= "<tr><td>".LAN_IMAGE_28."</td></tr>";
    }
    $pv_text .= "</table></div>";
    
    
    $pv_text .= "<div name='pview_menu_OwnComments' id='pview_menu_OwnComments' style='display:none;'>";
    $pv_text .= "<br /><table width='95%'>";
    if (count($commentArray) AND USERID <> 0) {
    	$comm_count = 1;
    	foreach($commentArray as $key => $dataset) {
    		if (USERID == $dataset['commente107userId']){
    			$user = $PView ->getUserData($dataset['commente107userId']);
                $resize = $PView -> getResizePath($dataset['commentImageId']);
                $thumb = $PView -> getThumbPath($dataset['commentImageId']);
    			$name = $PView -> getImageName($dataset['commentImageId']);
        		if ($PView -> getPView_config("force_imageSize")){
        			$imgHeight = intval($PView -> getPView_config("force_Height"));
        			$imgWidth = intval($PView -> getPView_config("force_Width"));
                    $imgdim = "width='".$imgWidth."' height='".$imgHeight."'";
                } else {
                    $imgdim = "";
                }
    			switch ($script) {
    						case "noscript":
    						// image will open in pviewgallery
    						$pv_Link = "<a href='".e_PLUGIN."pviewgallery/pviewgallery.php?image=".$dataset['commentImageId']."'>";
    						break;
    						case "lightbox":
    						// image will open in lightbox group	
    						$pv_Link = "<a href='".$resize."' rel='lightbox[pview_menu_como]' title='".$name."'>";
    						break;
    						case "shadowbox":
    						// image will open in shadowbox group	
    						$pv_Link = "<a href='".$resize."' rel='shadowbox[pview_menu_como]' title='".$name."'>";
    						break;
    						case "highslide":
    						// image will open in highslide group
    						if ($PView->getPView_config("img_Link_extJS_pview"))	{
    							$pv_Link = "<a href='".$resize."' class='highslide' onclick=\"return hs.expand(this,pview_menu_como)\" title='".$name."'>";
    						} else {
    							// ehighslide plugin compatible
    							$pv_Link = "<a href='".$resize."' class='highslide' onclick='return hs.expand(this)' title='".$name."'>";
    						}
    						break;																	
    						
    			}
    
    			// Preview text without html format (delete also [html] tags if WYSIWYG is used for write comment)	
    			$preview_Text = mb_substr(strip_tags($tp->toHTML($dataset['commentText'], TRUE)),0,$PView -> getPView_config('menu_comm_length'),'UTF-8');

    			switch ($view) {
    			     case "img":
                     // image only
                        $pv_text .= "<tr><td style='padding-bottom:5px; text-align: center;'>".$pv_Link."<img src='".$thumb."' ".$imgdim." style='padding:2px; border: 1px solid #ccc;' /></a><br />".LAN_MENU_32.$user['user_name'].", ".date('d.m.Y',$dataset['commentDate'])."</td></tr>";
                     break;
                     case "imgcomm":
                     // image and comment
                        $pv_text .= "<tr><td style='padding-bottom:5px; text-align: center;'>".$pv_Link."<img src='".$thumb."' ".$imgdim." style='padding:2px; border: 1px solid #ccc;' /></a><br />".$user['user_name'].", ".date('d.m.Y',$dataset['commentDate']).":<br />";
                        $pv_text .= $preview_Text." ...</td></tr>";
                     break;
                     case "comm":
                     // comment text only
                        $pv_text .= "<tr><td style='padding-bottom:5px;'>".$user['user_name'].", ".date('d.m.Y',$dataset['commentDate']).":<br />".$pv_Link.$preview_Text." ...</a></td></tr>";
                     break; 
       			}
    			
    			if ($comm_count++ > $PView -> getPView_config('menu_comm_count')-1) { break; }
    		}
    	}
    	if ($comm_count == 1){
    		$pv_text .= "<tr><td>".LAN_IMAGE_28."</td></tr>";
    	} else {
    		$pv_text .= "<tr><td><br />".LAN_MENU_25." ".$PView -> getPView_config('menu_comm_count')." ".LAN_MENU_26."</td></tr>";
    	}
    } else {
    	$pv_text .= "<tr><td>".LAN_IMAGE_28."</td></tr>";
    }
    $pv_text .= "</table></div>";
    
    return $pv_text;
}

function getMenuPOTD () {
//returns the full content of 'Picture of the day' menu
    $PView = new PView;
    $menu_SQL =& new db;
    
    // read curr. image
    $menu_SQL->db_Select("pview_featured", "*", "WHERE calDay<>'0'", "nowhere");
    if ($findImage = $menu_SQL -> db_Fetch() ) {
        $indexPOTD =$findImage['imageId'];
        // Check that image is for this day
        $dayPOTD = $findImage['calDay'];
        $dayCurr = time();
        if (date("d.m.y",$dayPOTD) <> date("d.m.y",$dayCurr)) {
            $arg ="calDay=".time()." WHERE calday=$dayPOTD";
            $menu_SQL -> db_Update("pview_featured","$arg");
            $indexPOTD =0;      // reset Image
        }
    } else {
        $indexPOTD =0; 			// reset Image
        // first db entry... write db with defaults
        $arg ="0,0,".time().",0,0";
        $menu_SQL -> db_Insert("pview_featured","$arg");
    }
    
    // Check that curr. Image is viewable
    // if not: find a new image... goal is to find a image is viewable for ALL visitors
    if(!$PView -> getPermission("image",$indexPOTD,"View") OR !$PView -> getImageName($indexPOTD)) {
        $menu_SQL -> db_Select("pview_image", "*", "WHERE permView='ALL' ORDER BY RAND()", "nowhere");
        while($findImage = $menu_SQL -> db_Fetch() ) {
        	if($PView -> getPermission("image",$findImage['imageId'],"View")) {
        		$indexPOTD = $findImage['imageId'];
                // set new image
                $arg ="imageId=".$indexPOTD." WHERE calDay<>'0'";
                $menu_SQL -> db_Update("pview_featured","$arg");
        		break;
        	}
        }
    }
    
    // here starts the HTML
    if ($indexPOTD) {
    	$potd = "<center>";
    
    	if ($PView -> getPView_config("img_Link_menu_extJS")) {
    		$script = $PView -> getPView_config("img_Link_extJS");
    	} else {
    		$script = "noscript";
    	}
    	$thumb = $PView -> getThumbPath($indexPOTD);
    	$resize = $PView -> getResizePath($indexPOTD);
    	$name = $PView -> getImageName($indexPOTD);
		if ($PView -> getPView_config("force_imageSize")){
			$imgHeight = intval($PView -> getPView_config("force_Height"));
			$imgWidth = intval($PView -> getPView_config("force_Width"));
            $imgdim = "width='".$imgWidth."' height='".$imgHeight."'";
        } else {
            $imgdim = "";
        }
    	switch ($script) {
    		case "noscript":
    		// image will open in pviewgallery
    		$potd.= "<a href='".e_PLUGIN."pviewgallery/pviewgallery.php?image=".$indexPOTD."'>";
    		break;
    		case "lightbox":
    		// image will open in lightbox group	
    		$potd.= "<a href='".$resize."' rel='lightbox[pview_feature]' title='".$name."'>";
    		break;
    		case "shadowbox":
    		// image will open in shadowbox group	
    		$potd.= "<a href='".$resize."' rel='shadowbox[pview_feature]' title='".$name."'>";
    		break;
    		case "highslide":
    		// image will open in highslide group
    		if ($PView->getPView_config("img_Link_extJS_pview"))	{
    			//no special group for this one picture neccessary
    			$potd.= "<a href='".$resize."' class='highslide' onclick=\"return hs.expand(this)\" title='".$name."'>";
    		} else {
    			// ehighslide plugin compatible
    			$potd.= "<a href='".$resize."' class='highslide' onclick='return hs.expand(this)' title='".$name."'>";
    		}
    		
    		break;																
    				
    	}
    	$potd .= "<img title='".$name."' src='".$thumb."' ".$imgdim." style='margin:15px 0px; padding:2px; border: 1px solid #ccc;' />";
    	$potd .= "</a></center>";
    
    }
    return $potd;
}

function getMenuStats () {
//returns the full content of statistic menu
    $PView = new PView;
    global $sql;
    $pv_path = e_PLUGIN."pviewgallery/";
    
    if ($PView -> getPView_config("img_Link_menu_extJS")) {
    	$script = $PView -> getPView_config("img_Link_extJS");
    } else {
    	$script = "noscript";
    }
    
    // image count (own pics) + nonapproved images count + top uploader + top rating + view count
    $imgArray = array();
    $uploaderArray = array();
    $ratingArray = array();
    $viewArray = array();
    $imgArray['all'] = 0;
    $imgArray['mypics'] = 0;
    $imgArray['nonapproved'] = 0;
    $sql->db_Select("pview_image", "*", "", "nowhere");
    while ($image = $sql -> db_Fetch()) {
    	// PERMISSION!!!
    	if ($PView->getPermission("image",$image['imageId'],"View")) {
    		// all pics
    		$imgArray['all']++;
    		
    	 	// top uploader
    	 	$uploaderArray[$image['uploaderUserId']]++;
    	 	
    	 	// pics view count
    	 	$viewArray[$image['imageId']]['value'] = $image['views'];
    	 	$viewArray[$image['imageId']]['thumbnail'] = $image['thumbnail'];
    	 	$viewArray[$image['imageId']]['albumId'] = $image['albumId'];
    	 	$viewArray[$image['imageId']]['name'] = $image['name'];
    	 	
    	 	// top ratings
    	 	if ($PView -> getPView_config("Rating")) {
    		 	$ratings = $PView -> getRatingData($image['imageId']);
    		 	if ($ratings['count']){
    			    $ratingArray[$image['imageId']]['value'] = round($ratings['value'],2); 
    			    $ratingArray[$image['imageId']]['count'] = $ratings['count'];
    			    $ratingArray[$image['imageId']]['thumbnail'] = $image['thumbnail'];
    			    $ratingArray[$image['imageId']]['albumId'] = $image['albumId'];
    			    $ratingArray[$image['imageId']]['name'] = $image['name'];
    		    }
    	    }
        }
        if (!$image['approved']) {
    		// nonapproved pics
    	 	$imgArray['nonapproved']++;
    	}
    	if ($image['uploaderUserId'] == USERID) {
    		// my pics
    		$imgArray['mypics']++;
    	}
    }
    uasort($ratingArray, "pv_cmp"); // Rating
    arsort($uploaderArray); // Uploader
    uasort($viewArray, "pv_cmp"); // Views
    
    // album count
    $albumCount = 0;
    $sql->db_Select("pview_album", "albumId", "", "nowhere");
    while ($album = $sql -> db_Fetch()) {
    	if ($PView->getPermission("album",$album['albumId'],"View")) {
    		$albumCount++;
    	}
    }
    // usergallery count
    $galCount = 0;
    $sql->db_Select("pview_gallery", "galleryId", "WHERE galleryId <> 0", "nowhere");
    while ($gallery = $sql -> db_Fetch()) {
    	if ($PView->getPermission("gallery",$gallery['galleryId'],"View")) {
    		$galCount++;
    	}
    }
    // comment count (own comments)
    $commentArray = array();
    $commentArray['all'] = 0;
    $commentArray['mycomments'] = 0;
    
    $sql->db_Select("pview_comment", "commentImageId,commente107userId", "", "nowhere");
    while ($comment = $sql -> db_Fetch()) {
    	if ($PView->getPermission("image",$comment['commentImageId'],"View")) {
    		$commentArray['all']++;
    		if ($comment['commente107userId'] == USERID) {
    			$commentArray['mycomments']++;
    		}
    	}
    }
    // category count
    if (!$catCount = $sql->db_Count("pview_cat", "(*)")) {
    	$catCount = 0;
    }
    
    
    // here starts the html code
    // script for DIV opener
    $pv_text = "";
    $pv_text .= "<script type='text/javascript' src = '".$pv_path."pview.js'></script>";
    
    // basic stats
    $pv_text .= "<table width='95%'><tr><td>".LAN_MENU_5.":</td><td>".$imgArray['all']."</td></tr>";
    $pv_text .= "<tr><td>".LAN_MENU_6.":</td><td>".$imgArray['mypics']."</td></tr>";
    $pv_text .= "<tr><td>".LAN_MENU_7.":</td><td>".$albumCount."</td></tr>";
    $pv_text .= "<tr><td>".LAN_MENU_8.":</td><td>".$galCount."</td></tr>";
    $pv_text .= "<tr><td>".LAN_MENU_9.":</td><td>".$commentArray['all']."</td></tr>";
    $pv_text .= "<tr><td>".LAN_MENU_10.":</td><td>".$commentArray['mycomments']."</td></tr>";
    if ($imgArray['nonapproved'] && ADMIN) {
    	$pv_text .= "<tr><td><a href='".$pv_path."admin_activate.php'>
    				".LAN_MENU_11.":</a></td><td>".$imgArray['nonapproved']."</td></tr>";
    } else {
    	$pv_text .= "<tr><td>".LAN_MENU_11.":</td><td>".$imgArray['nonapproved']."</td></tr>";
    }
    $pv_text .= "<tr><td>".LAN_MENU_12.":</td><td>".$catCount."</td></tr>";
    $pv_text .= "</table><br /><center>";
    $pv_text .= "<input class='button' type='button' value='".LAN_MENU_13."' onclick='pv_uploader()'> ";
    if ($PView -> getPView_config("Rating")) {
    	$pv_text .= "<input class='button' type='button' value='".LAN_MENU_14."' onclick='pv_Rating()'> ";
    }
    $pv_text .= "<input class='button' type='button' value='".LAN_MENU_15."' onclick='pv_Views()'></center><br />";
    $pv_text .= "<div name='pview_menu_uploader' id='pview_menu_uploader' style='display:block;'>";
    $pv_text .= "<table width='95%'><tr><td colspan='2' height='30px' valign='middle'>".LAN_MENU_16.":</td></tr>";
    if (count($uploaderArray)) {
    	foreach($uploaderArray as $key => $dataset) {
    		$user = $PView ->getUserData($key);
    		$pv_text .= "<tr><td>".$user['user_name'] .":</td><td valign='top'>".$dataset."</td></tr>";
    		if ($u_count++ > 1) { break; }// shows the top 3
    	}
    } else {
    	$pv_text .= "<tr><td colspan='2'>".LAN_MENU_4."</td></tr>";
    }
    $pv_text .= "</table></div>";
    $pv_text .= "<div name='pview_menu_rating' id='pview_menu_rating' style='display:none;'>";
    $pv_text .= "<table width='95%'><tr><td colspan='2' height='30px' valign='middle'>".LAN_MENU_17.":</td></tr>";
    if (count($ratingArray)) {
    	foreach ($ratingArray as $key => $dataset) {
    		$thumb = $PView -> getThumbPath($key);
    		$resize = $PView -> getResizePath($key);
    		if ($PView -> getPView_config("force_imageSize")){
    			$imgHeight = intval($PView -> getPView_config("force_Height"));
    			$imgWidth = intval($PView -> getPView_config("force_Width"));
                $imgdim = "width='".$imgWidth."' height='".$imgHeight."'";
            } else {
                $imgdim = "";
            }
    		
    		switch ($script) {
    					case "noscript":
    					// image will open in pviewgallery
    					$pv_Link = "<a href='".e_PLUGIN."pviewgallery/pviewgallery.php?image=".$key."'>";
    					break;
    					case "lightbox":
    					// image will open in lightbox group	
    					$pv_Link = "<a href='".$resize."' rel='lightbox[pview_stats_rating]' title='".$dataset['name']."'>";
    					break;
    					case "shadowbox":
    					// image will open in shadowbox group	
    					$pv_Link = "<a href='".$resize."' rel='shadowbox[pview_stats_rating]' title='".$dataset['name']."'>";
    					break;
    					case "highslide":
    					// image will open in highslide group
    					if ($PView->getPView_config("img_Link_extJS_pview"))	{
    						$pv_Link = "<a href='".$resize."' class='highslide' onclick=\"return hs.expand(this,pview_stats_rating)\" title='".$dataset['name']."'>";
    					} else {
    						// ehighslide plugin compatible
    						$pv_Link = "<a href='".$resize."' class='highslide' onclick='return hs.expand(this)' title='".$dataset['name']."'>";
    					}
    					break;																	
    					
    		}		
    		
    		$pv_text .= "<tr><td colspan='2' style='text-align:center;'>".$pv_Link."<img src='".$thumb."' ".$imgdim." style='padding:2px; border: 1px solid #ccc;' /></a></td></tr>";
    		$pv_text .= "<tr><td height='40px' valign='top'>".LAN_MENU_19.": ".$dataset['value']."</td><td height='40px' valign='top'>(".$dataset['count'].LAN_MENU_20.")</td></tr>";
    		if ($r_count++ > 1) { break; }// shows the top 3
    	}
    } else {
    	$pv_text .= "<tr><td colspan='2'>".LAN_MENU_4."</td></tr>";
    }
    
    $pv_text .= "</table></div>";
    $pv_text .= "<div name='pview_menu_views' id='pview_menu_views' style='display:none;'>";
    $pv_text .= "<table width='95%'><tr><td colspan='2' height='30px' valign='middle'>".LAN_MENU_18.":</td></tr>";
    if (count($viewArray)) {
    	foreach ($viewArray as $key => $dataset) {
    		$thumb = $PView -> getThumbPath($key);
    		$resize = $PView -> getResizePath($key);
    		if ($PView -> getPView_config("force_imageSize")){
    			$imgHeight = intval($PView -> getPView_config("force_Height"));
    			$imgWidth = intval($PView -> getPView_config("force_Width"));
                $imgdim = "width='".$imgWidth."' height='".$imgHeight."'";
            } else {
                $imgdim = "";
            }
    		
    		switch ($script) {
    					case "noscript":
    					// image will open in pviewgallery
    					$pv_Link = "<a href='".e_PLUGIN."pviewgallery/pviewgallery.php?image=".$key."'>";
    					break;
    					case "lightbox":
    					// image will open in lightbox group	
    					$pv_Link = "<a href='".$resize."' rel='lightbox[pview_stats_views]' title='".$dataset['name']."'>";
    					break;
    					case "shadowbox":
    					// image will open in shadowbox group	
    					$pv_Link = "<a href='".$resize."' rel='shadowbox[pview_stats_views]' title='".$dataset['name']."'>";
    					break;
    					case "highslide":
    					// image will open in highslide group	
    					if ($PView->getPView_config("img_Link_extJS_pview"))	{
    						$pv_Link = "<a href='".$resize."' class='highslide' onclick=\"return hs.expand(this,pview_stats_views)\" title='".$dataset['name']."'>";
    					} else {
    						// ehighslide plugin compatible
    						$pv_Link = "<a href='".$resize."' class='highslide' onclick='return hs.expand(this)' title='".$dataset['name']."'>";
    					}
    					break;																	
    					
    		}
    			
    		$pv_text .= "<tr><td colspan='2' style='text-align:center;'>".$pv_Link."<img src='".$thumb."' ".$imgdim." style='padding:2px; border: 1px solid #ccc;' /></a></td></tr>";
    		$pv_text .= "<tr><td height='40px' valign='top'>".LAN_MENU_21.":</td><td height='40px' valign='top'>".$dataset['value'].LAN_MENU_22."</td></tr>";
    		if ($v_count++ > 1) { break; }// shows the top 3
    	}
    } else {
    	$pv_text .= "<tr><td colspan='2'>".LAN_MENU_4."</td></tr>";
    }
    
    $pv_text .= "</table></div>";
    
    return $pv_text;
}
	
}
//Class UserTemplate End

?>