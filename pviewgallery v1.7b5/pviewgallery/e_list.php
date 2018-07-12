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

if (!defined('e107_INIT')) { exit; }

// Make sure the plugin is installed
if (!$sql->db_Select("plugin", "*", 
                     "plugin_path = 'pviewgallery' AND plugin_installflag = '1'")) 
{
   // Plugin not installed
   return;
}

// Some globals we will need
global $pref;
$list_SQL =& new db;

// Include any required plugin files

require_once(e_PLUGIN."pviewgallery/pview.class.php");
$PView = new PView;

if ($PView -> getPView_config("img_Link_search_extJS")) {
	$script = $PView -> getPView_config("img_Link_extJS");
} else {
	$script = "noscript";
}

// Get some standard values from the global $arr
$LIST_CAPTION        = $PView -> getPView_config("pview_name");
$LIST_DISPLAYSTYLE   = ($arr[2] ? "" : "none");
$bullet = $this->getBullet($arr[6], $mode);

if ($mode == "new_page" || $mode == "new_menu" ) {
   // We only want to get data that is more recent than the users last visit
   $qry = "uploadDate>".$this->getlvisit();
} else {
   $qry = "imageId>0";
}

// The DB query to get the data, it is likely that the query will be more complex 
// than this simple example.
// for example, the "WHERE 1" is only there as we do not know if $qry is populated 
// but could be replaced by some SQL to ensure the user is allowed to view the data
$qry = "select * from #".pview_image." 
        where $qry
        order by uploadDate desc limit 0,".$arr[7]."
       ";

if (!$list_SQL->db_Select_gen($qry)) {
   // No data - ideally, text is obtained from a language file
   $LIST_DATA = LAN_IMAGE_50;
} else {
   // Got data, process each row
   while ($row = $list_SQL->db_Fetch()) {
      //Check permission
	  if ($PView -> getPermission("image",$row['imageId'],"View")) {
		  
		  // Get some data to be used later
	      $rowheading = $this->parse_heading($row['name'], $mode);
	      $user       = get_user_data($row['uploaderUserId']);
		  $image      = $PView -> getImageData($row['imageId']);

        	switch ($script) {
        				case "noscript":
        				// image will open in pviewgallery
        				$pv_Heading = "<a href='".e_PLUGIN."pviewgallery/pviewgallery.php?image=".$row["imageId"];
        				break;
        				case "lightbox":
        				// image will open in lightbox group
                        $pv_Heading = "<a href='".$PView -> getResizePath($row["imageId"]). "' rel='lightbox";	
        				break;
        				case "shadowbox":
        				// image will open in shadowbox group	
        				$pv_Heading = "<a href='".$PView -> getResizePath($row["imageId"]). "' rel='shadowbox";
        				break;
        				case "highslide":
        				// image will open in highslide group
                        $pv_Heading = "<a href='".$PView -> getResizePath($row["imageId"]). "' class='highslide' onclick='return hs.expand(this)'";
        				break;																	
        				
        	}


	      // Populate fields to be added to the List New array
	      $ICON = $bullet;
	      $HEADING = $pv_Heading;
	      $HEADING .= "' title='".$row['description']."'>";
	      $HEADING .= $rowheading."</a>";
	      $AUTHOR = "<a href='".e_BASE."user.php?id.";
	      $AUTHOR .= $row['uploaderUserId']."' title='".$row['uploaderUserId']."'>";
	      $AUTHOR .= $user["user_name"]."</a>";
		  $DATE = ($arr[5] ? ($row['uploadDate'] > 0 ? $this->getListDate($row['uploadDate'], $mode) : "") : "");
		  $CATEGORY = "<a href='".e_PLUGIN."pviewgallery/pviewgallery.php?album=".$row['albumId']."'>".$PView -> getAlbumName($row['albumId'])."</a>";
	      $CATEGORY .= " [ ".LIST_FORUM_3." ".$image['views']." ]";
		  $INFO = "";

	      // Finally, populate the List New data array
	      $LIST_DATA[$mode][] = array($ICON, $HEADING, $AUTHOR, $CATEGORY, $DATE, $INFO);
	  }
   }
}

?>