<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Gallery front-end : e107_plugins/sgallery/gallery.php
|        Email: m.yovchev@clabteam.com
|        $Revision: 768 $
|        $Date: 2008-09-18 11:57:24 +0300 (Thu, 18 Sep 2008) $
|        $Author: secretr $
|	     Copyright Corllete Lab ( http://www.clabteam.com )
|        Free Support: http://dev.e107bg.org/
+----------------------------------------------------------------------------------------------------+
*/
require_once("../../class2.php");
require_once('init.php');

function headerjs()
{
    $txt = "
        <script type='text/javascript'>
        <!--
        //jump to page
        var jurlPost = '';
        function page_jump( jurl, pages, show_page, pmsg )
        {
          pmsg = pmsg + pages + ')';
        
          userPage = prompt( pmsg, show_page );
        
          if ( userPage > 0  )
          {
            if ( userPage < 1 )     {    userPage = 1;  }
            if ( userPage > pages ) { userPage = pages; }
            if ( userPage == show_page )    {     return false;    }
        
            window.location = jurl + userPage + jurlPost;
          }
        }
        // -->
        </script>
    ";
    return $txt;
}

if (e_QUERY) {
	$tmp = explode(".", e_QUERY);
	$action = varsettrue($tmp[0], 'glist');
	$id = varsettrue($tmp[1], 0);
	$cpage =  varsettrue($tmp[2], 1);
	$imgpage =  varsettrue($tmp[3], 1);
	$sgal_iframe =  varsettrue($tmp[4], 0);
} else {
    //default values
    $action = 'glist';
    $id = 0;
    $cpage = 1;
    $imgpage = 1;
	$sgal_iframe = 0;
}

if ($sgal_iframe) { $HEADER = ''; $FOOTER = ''; }

if($action == 'comment_reply' && $id && $sql->db_Select('sgallery', '*', "album_id='".intval($id)."'")) {
    $row = $sql->db_Fetch();
    if(!$row['sgal_user'])
        $act = 'view';
    else 
        $act = 'uview';
    header("Location:".SGAL_PATH_ABS."gallery.php?{$act}.{$id}");
    exit;
}

include_lan(SGAL_LAN.'.php'); 
if(!check_class($pref['sgal_active'])) {
    require_once(HEADERF);
    if($sgal_pref['sgal_tblrender']) 
        $ns->tablerender(SGAL_PAGE_NAME, SGAL_LAN_20, 'sgal_core');
    else
        echo $pagesrc;
    require_once(FOOTERF);
    exit;
}
require_once(SGAL_INCPATH."sgal_batch.php");


if(is_readable(THEME."sgallery_tmpl.php")) 
{
    require_once(THEME."sgallery_tmpl.php");
} 
else
{
	require_once(SGAL_PATH."templates/sgallery_tmpl.php");
}

require_once(SGAL_INCPATH."sgal_file_class.php");
$fl = new sgal_file;

include_once(SGAL_INCPATH.'pp.class.php');

require_once(e_HANDLER."comment_class.php");
$cobj = new comment;
$SGAL_NOCOMMENT = true;


$th = $sgalobj->loadObj('thumb_class');
$pp = new cl_pp;

require_once(e_HANDLER."rate_class.php");
if(!is_object($rater)){ $rater = new rater; }
				


//check actions
if($action != 'list' && $action != 'ulist' && $action != 'view' && $action != 'uview' && $action != 'glist' && $action != 'latest') {
    $action = 'glist';
}

$id = intval($id);
$cpage = intval($cpage);
$imgpage = intval($imgpage);

$title = SGAL_PAGE_NAME;
$pagesrc = '';
$bread_pre = defset('SGAL_BC_SITENAME', 0) ? "<a href='".e_HTTP."'>".SITENAME."</a>".SGAL_BREADC_CHAR : '';
$sql->db_Mark_Time('Start: CL Gallery');

//post comment
if(isset($_POST['commentsubmit'])){
	if(!check_class($sgal_pref['sgal_album_comments']) || !(ANON == TRUE || USER == TRUE)){ 
		header("location:".e_BASE."index.php"); exit;
	}else{

        $wh = '';


        if($action == 'view') {
            //mysql data - loop
            if(!check_class($sgal_pref['sgal_usermod_visible'])) {
            	$wh = " AND al.sgal_user=''";
            }
            
        	$qry = "
        	SELECT al.*, 
            alc.title AS ctitle
        	FROM #sgallery AS al
        	LEFT JOIN #sgallery_cats AS alc ON al.cat_id = alc.cat_id
        	WHERE al.active > 0  AND al.album_ustatus > 0 AND alc.active > 0 AND al.album_id={$id}{$wh}
        	GROUP by al.album_id 
        	";
    	} else {
    	    $where = " AND al.active>0  AND al.album_ustatus>0 ";
        	$qry = "
        	SELECT al.*,
        	alc.title AS ctitle
        	FROM #sgallery AS al
        	LEFT JOIN #sgallery_cats AS alc ON al.cat_id = alc.cat_id AND alc.active > 0
        	WHERE al.sgal_user!='' AND al.album_id={$id}{$where}
        	GROUP by al.album_id 
        	";
        }

        if($sql->db_Select_gen($qry)){
            $row = $sql -> db_Fetch();
			//enter_comment($author_name, $comment, $table, $id, $pid, $subject)
			$author = ($_POST['author_name'] ? $_POST['author_name'] : USERNAME);
			$pid = "0";
			//$rateme = check_class($sgal_pref['sgal_album_rating']);

			$cobj -> enter_comment($author, $_POST['comment'], 'sgallery', $id, $pid, $_POST['subject'], false);
    	}

	}
}

// Start Session if it's not already started
if ($pref['user_tracking'] != "session") {
	session_start();
}
//view tracking
if(!isset($_SESSION['cl_altrack'])) {
    $_SESSION['cl_altrack'] = array();
}
if(!isset($_SESSION['cl_galtrack'])) {
    $_SESSION['cl_galtrack'] = array();
}

//gallery list
if($action == 'glist') {
    $t_start = $SGALLERY_GAL_TABLE_START;
    $t_body_pre = $SGALLERY_GAL_TABLE_BODY_PRE;
    $t_body = $SGALLERY_GAL_TABLE_BODY;
    $t_body_empty = $SGALLERY_GAL_TABLE_EBODY;
    $t_body_post = $SGALLERY_GAL_TABLE_BODY_POST;
    $t_end = $SGALLERY_GAL_TABLE_END;
    $t_empty = $SGALLERY_GAL_TABLE_EMPTY;
    
    $parse_info = array();

	if($sgal_pref['sgal_galperrow']) {
        $parse_info['SGAL_GALROW_W'] = intval(100 / $sgal_pref['sgal_galperrow']).'%';
        $parse_info['SGAL_GAL_COLSPAN'] = $sgal_pref['sgal_galperrow'];
        $count_cols = true;
    } else {
        $count_cols = false;
    }
    
    //to do -  per Album/user latest pictures
    $parse_info['SGAL_LATEST_PICTURESLINK'] = check_class($sgal_pref['sgal_latest']) ? "<a href='".SGAL_PATH_ABS."gallery.php?latest'>".SGAL_LAN_25."</a>" : '';
    $sgal_param['sgal_latest_pictureslink'] = $parse_info['SGAL_LATEST_PICTURESLINK'];
    
    $sgal_param['sgal_breadc'] = $bread_pre."<a href='".SGAL_PATH."gallery.php'>".PAGE_BREADC_HOME."</a>";
    $pagesrc .= sgal_parse_template($parse_info, $t_start, true);

    define('e_PAGETITLE', $title);
    
    //param action
    $sgal_param['action'] = 'glist';
    $sgal_param['parse_images'] = false; //not really needed
    $sgal_param['cpage'] = $cpage; //current page
    $sgal_param['sgal_galrow_w'] = $parse_info['SGAL_GALROW_W'];
    $sgal_param['max_wh'] = $sgal_pref['sgal_thgal_w'] > $sgal_pref['sgal_thgal_h'] ? $sgal_pref['sgal_thgal_w'] : $sgal_pref['sgal_thgal_h'];
    
    $where = " AND al.album_ustatus>0";
    //all user albums list - check user visibility permissions only
    if(!check_class($sgal_pref['sgal_usermod_visible'])) {
        $where .= " AND al.sgal_user=''";
    }
    
    //mysql data - loop
	$qry = "
	SELECT alc.title AS ctitle, alc.cat_id AS cid, alc.cat_order, alc.active, alc.cat_description, alc.cat_viewed,
    COUNT(al.album_id) AS al_count
	FROM #sgallery_cats AS alc
	LEFT JOIN #sgallery AS al ON al.cat_id = alc.cat_id AND al.active > 0 AND al.album_ustatus > 0
	WHERE alc.active > 0 AND al.album_id > 0{$where}
	GROUP by alc.cat_id  ORDER by alc.cat_order ASC
	";
	
	$sql->db_Mark_Time('Start: Gallery List');
	
    $total_pic = 0;
	$total_al = 0;
	$total_gal = 0;
	if($sql->db_Select_gen($qry)) {
        $rows = $sql->db_getList();
        $total_gal = count($rows);
    	$br = 0;
    	foreach ($rows as $row) {
    	    $br++;
    	    
            $sql->db_Select('sgallery', 'album_id, dt, path, thsrc', "active>0 AND cat_id={$row['cid']} AND album_ustatus > 0 ORDER BY dt DESC");
            $album_stats = $sql->db_getList();
            $total_al += count($album_stats);

            $row['sgal_gal_piccnt'] = 0;
            $patharr = array();

            foreach ($album_stats as $album_stat) {
                if(!isset($asd)) {
                    $row['path'] = $album_stat['path'];
                    $row['thsrc'] = $album_stat['thsrc'];
                    $row['album_id'] = $album_stat['album_id'];
                    $row['dt'] = $album_stat['dt'];
                    $asd = 'set';
                }
                if($album_stat['path']) $patharr[] = $album_stat['path'];
            }
            unset($asd);
            
            foreach ($patharr as $alpath) {
                $imagepath = SGAL_ALBUMPATH.$alpath."/";
                $imagelist = $fl -> sgal_pics($imagepath, $sgal_pref);
            	$row['sgal_gal_piccnt'] += count($imagelist);
            }
            
            //new row
    	    if($count_cols && $br == 1){
                $pagesrc .= sgal_parse_template($parse_info, $t_body_pre);
            }
            
            $total_pic += $row['sgal_gal_piccnt'];
            $pagesrc .= sgal_parse_template($row, $t_body, true); 
            
    	    //end row
    	    if($count_cols && $br == ($sgal_pref['sgal_galperrow'])){
                $pagesrc .= sgal_parse_template($parse_info, $t_body_post);
                $br = 0;
            }	
        }
        
        //empty cells 
        if($br && $count_cols) {
            for ($a = $br; $a < $sgal_pref['sgal_galperrow']; $a++) {
            	$pagesrc .= sgal_parse_template($parse_info, $t_body_empty);
            	
            }
            $pagesrc .= sgal_parse_template($parse_info, $t_body_post);
        }
    } else {
        //No Galleries Yet
        $pagesrc .= $t_empty;
    }
    
    //footer stats
    $parse_info['SGAL_GAL_TALBUMS'] = $total_al;
    $parse_info['SGAL_GAL_TFILES'] = $total_pic;
    $parse_info['SGAL_GAL_TGALS'] = $total_gal;
    $pagesrc .= sgal_parse_template($parse_info, $t_end);
}

//album list
if($action == 'list' || $action == 'ulist') {   
    // gallery view tracking TO DO - Calculate it as a sum of corresponding album views?
    if($id && $action == 'list' && !in_array($id, $_SESSION['cl_galtrack'])) {
        $_SESSION['cl_galtrack'][] = $id;
        $sql->db_Update("sgallery_cats", "cat_viewed=cat_viewed+1 WHERE cat_id='{$id}' ");
    }
    
    $t_start = $SGALLERY_ALBUM_TABLE_START;
    $t_body_pre = $SGALLERY_ALBUM_TABLE_BODY_PRE;
    $t_body = $SGALLERY_ALBUM_TABLE_BODY;
    $t_body_post = $SGALLERY_ALBUM_TABLE_BODY_POST;
    $t_body_empty = $SGALLERY_ALBUM_TABLE_EBODY;
    $t_end = $SGALLERY_ALBUM_TABLE_END;
    $t_empty = $SGALLERY_ALBUM_TABLE_EMPTY;
    
    //custom nextprev configuration
    $perPage = $sgal_pref['sgal_albumperpage'] ? $sgal_pref['sgal_albumperpage'] : 9;
    $pageNum = $sgal_pref['sgal_pagenum'] ? $sgal_pref['sgal_pagenum'] : 5;
    
    //ordinary list
    $parse_info_st = array();
    if($action == 'list') {
        $sql->db_Mark_Time('Start: Album List');
        if( $sql->db_Select('sgallery_cats', 'title AS ctitle, cat_id AS cid, cat_order', "cat_id={$id}") ) {
            $catrow = $sql->db_Fetch(); 
        }

        $sgal_param['sgal_breadc'] = $bread_pre."<a href='".SGAL_PATH."gallery.php'>".PAGE_BREADC_HOME."</a>".SGAL_BREADC_CHAR."<a href='".SGAL_PATH_ABS."gallery.php?list.{$id}.1'>".$tp->toHTML($catrow['ctitle'], FALE, 'parse_sc,no_hook,emotes_off,no_make_clickable')."</a>";
    } else { //user album list
        $catrow = array('ctitle' => SGAL_LAN_16);
        $sgal_param['sgal_breadc'] = $bread_pre."<a href='".SGAL_PATH."gallery.php'>".PAGE_BREADC_HOME."</a>".SGAL_BREADC_CHAR."<a href='".SGAL_PATH_ABS."gallery.php?ulist.0.1'>".$tp->toHTML($catrow['ctitle'], FALE, 'TITLE')."</a>";
    }
    
    $parse_info = array();
	if($sgal_pref['sgal_albumperrow']) {
        $parse_info['SGAL_ALBUM_W'] = intval(100 / $sgal_pref['sgal_albumperrow']).'%';
        $parse_info['SGAL_ALBUM_COLSPAN'] = $sgal_pref['sgal_albumperrow'];
        $count_cols = true;
    } else {
        $count_cols = false;
    }
    
    //to do -  per Album/user latest pictures
    $parse_info['SGAL_LATEST_PICTURESLINK'] = check_class($sgal_pref['sgal_latest']) ? "<a href='".SGAL_PATH_ABS."gallery.php?latest'>".SGAL_LAN_25."</a>" : '';
    $sgal_param['sgal_latest_pictureslink'] = $parse_info['SGAL_LATEST_PICTURESLINK'];
    
    //param action
    $sgal_param['action'] = $action;
    $sgal_param['parse_images'] = false; //not really needed
    $sgal_param['cpage'] = $cpage; //current page
    $sgal_param['imgpage'] = $imgpage; //current album page
    $sgal_param['nopic_w'] = $sgal_pref['sgal_thumb_w'] ? $sgal_pref['sgal_thumb_w'] : 120; //no image width
    $sgal_param['nopic_h'] = $sgal_pref['sgal_thumb_h'] ? $sgal_pref['sgal_thumb_h'] : 90; //no image height
    $sgal_param['sgal_album_w'] = $parse_info['SGAL_ALBUM_W'];
    $sgal_param['max_wh'] = $sgal_pref['sgal_thumb_w'] > $sgal_pref['sgal_thumb_w'] ? $sgal_pref['sgal_thumb_w'] : $sgal_pref['sgal_thumb_w'];
    $sgal_param['sgal_album_colspan'] = $parse_info['SGAL_ALBUM_COLSPAN'];
    $pp->pp_Config($perPage, $pageNum);

    
    //ordinary list
    if($action == 'list') {
        $where = '';
        //all user albums list - check user visibility permissions only
        if(!check_class($sgal_pref['sgal_usermod_visible'])) {
            $where = " AND al.sgal_user=''";
        }
        
        //paginating - page limit
        $albums = $sql->db_Count(SGAL_MTABLE." AS al", "(*)", " WHERE al.active>0 AND al.cat_id={$id}{$where}");
        $limit = ' '.$pp -> pageLimit($albums, $cpage);
        
        //mysql data - loop
    	$qry = "
    	SELECT al.*, COUNT(al.album_id) AS al_count, alc.title AS ctitle, alc.cat_id AS cid, alc.cat_description, alc.cat_viewed
    	FROM #sgallery AS al
    	LEFT JOIN #sgallery_cats AS alc ON al.cat_id = alc.cat_id AND alc.active > 0
    	WHERE al.active > 0 AND al.album_ustatus > 0 AND alc.active > 0 AND al.cat_id = $id{$where}
    	GROUP by al.album_id
        ORDER by al.dt DESC
        $limit 
    	";
	} else {
        //permissions - check visibility if not album owner and management permissions if is the album owner
        $lj = '';
        $ljs = '';
        if(!$id) {
            //all user albums list - check user visibility permissions only
            if(!check_class($sgal_pref['sgal_usermod_visible'])) {
                require_once(HEADERF);
                if($sgal_pref['sgal_tblrender']) 
                    $ns->tablerender($title, SGAL_LAN_20, 'sgal_core');
                else
                    echo $pagesrc;
                require_once(FOOTERF);
                exit;
            }
            $where = "al.active > 0 AND al.album_ustatus > 0 AND al.sgal_user!='' ";
        } else {
            if(USER && $id == USERID) {
                //owner - check user management permissions
                if(!check_class($sgal_pref['sgal_usermod_allow'])) {
                    require_once(HEADERF);
                    if($sgal_pref['sgal_tblrender']) 
                        $ns->tablerender($title, SGAL_LAN_20, 'sgal_core');
                    else
                        echo $pagesrc;
                    require_once(FOOTERF);
                    exit;
                }
                $where = "al.sgal_user LIKE '{$id}.%' "; //manager view
            } else {
                //visitor - check user visibility permissions
                if(!check_class($sgal_pref['sgal_usermod_visible'])) {
                    require_once(HEADERF);
                    if($sgal_pref['sgal_tblrender']) 
                        $ns->tablerender($title, SGAL_LAN_20, 'sgal_core');
                    else
                        echo $pagesrc;
                    require_once(FOOTERF);
                    exit;
                }
                $where = "al.active > 0 AND al.album_ustatus > 0 AND al.sgal_user LIKE '{$id}.%' ";
            } 
        } 
        $albums = $sql->db_Count(SGAL_MTABLE." AS al", "(*)", " WHERE {$where}");
        
        $limit = ' '.$pp -> pageLimit($albums, $cpage);
        
        //mysql data - loop
    	$qry = "
    	SELECT al.*
    	FROM #sgallery AS al
    	WHERE {$where}
    	GROUP by al.album_id
        ORDER by al.dt DESC
        $limit 
    	";
    }
	$palbums = 0;
	$total_fl = 0;
	$ud = array();
	if($sql->db_Select_gen($qry)) {
        $rows = $sql->db_getList();
        $palbums = count($rows);
    	$br = 0;
    	//print_a($rows);\
		$uids = array();
		if($action == 'ulist')
		{
			foreach ($rows as $row) {
				if(!$row['sgal_user']) continue;
				$ud = explode('.', $row['sgal_user'], 2);
				if($ud[0]) $uids[] = $ud[0];
		
			}
		}
		$uids = array_unique($uids);
		if($uids && $sql->db_Select('user', '*', "user_id IN (".implode(',', $uids).")"))
		{
			while($urow = $sql->db_Fetch())
			{
				$uid = $urow['user_id'];
				cachevars("userdata_{$uid}", $urow);
			}
		}
		
		
    	foreach ($rows as $row) {
    	    $br++;
    	    
    	    if($action == 'list' && !isset($parse_info['sgal_galinfo'])) {
                $parse_info['sgal_galinfo'] = sgal_parse_template($row, $SGALLERY_ALBUM_GALINFO, true);
            }
			if($action == 'ulist')
			{
				$uid = $row['sgal_user'];
				cachevars("userdata_{$uid}", $row);
			}
    	    
            $imagepath = SGAL_ALBUMPATH.$row['path']."/";
            $imagelist = $fl -> sgal_pics($imagepath, $sgal_pref);
            $row['sgal_album_files'] = count($imagelist);
    	    $total_fl += $row['sgal_album_files'];
    	    
    	    if($id && !$ud && $action == 'ulist')  {
                $ud = explode('.', $row['sgal_user']);
                $sgal_param['sgal_breadc'] .= SGAL_BREADC_CHAR."<a href='".SGAL_PATH_ABS."gallery.php?ulist.".$ud[0].".{$cpage}'>".$ud[1]."</a>";
            }
    	    
    	    //new row
    	    if($count_cols && $br == 1){
                $pagesrc .= sgal_parse_template($parse_info, $t_body_pre);
            }
            
            $pagesrc .= sgal_parse_template($row, $t_body, true); 
            
    	    //end row
    	    if($count_cols && $br == ($sgal_pref['sgal_albumperrow'])){
                $pagesrc .= sgal_parse_template($parse_info, $t_body_post);
                $br = 0;
            }	
        }
        
        //empty cells 
        if($br && $count_cols) {
            for ($a = $br; $a < $sgal_pref['sgal_albumperrow']; $a++) {
            	$pagesrc .= sgal_parse_template($parse_info, $t_body_empty);
            	
            }
            $pagesrc .= sgal_parse_template($parse_info, $t_body_post);
        }
    } else {
        //No Albums - Old Bookmark?
        $pagesrc .= sgal_parse_template($parse_info, $t_empty);
    }

    $pagesrc = sgal_parse_template($parse_info, $t_start, true).$pagesrc; 
    //pages
    $pagenav = $pp -> pageNav($albums, $cpage, "{$action}.{$id}");
    $parse_info['SGAL_ALBUM_PAGES'] = $pagenav ? $pagenav : SGAL_LAN_52.' 1 '.SGAL_LAN_53.' 1';
    $parse_info['SGAL_ALBUM_TFILES'] = $total_fl;
    $parse_info['SGAL_ALBUM_TALBUMS'] = $palbums;
    $pagesrc .= sgal_parse_template($parse_info, $t_end);
    
    define('e_PAGETITLE', $title.': '.$catrow['ctitle']);
}

//album view
if($action == 'view' || $action == 'uview') {
    $SGAL_NOCOMMENT = false;
    
    // album view tracking
    if($id && !in_array($id, $_SESSION['cl_altrack'])) {
        $_SESSION['cl_altrack'][] = $id;
        $sql->db_Update("sgallery", "album_viewed=album_viewed+1 WHERE album_id='{$id}' ");
    }
    
    $t_start = $SGALLERY_VIEW_TABLE_START;
    $t_body_pre = $SGALLERY_VIEW_TABLE_BODY_PRE;
    $t_body = $SGALLERY_VIEW_TABLE_BODY;
    $t_body_post = $SGALLERY_VIEW_TABLE_BODY_POST;
    $t_body_empty = $SGALLERY_VIEW_TABLE_EBODY;
    $t_end = $SGALLERY_VIEW_TABLE_END;
    $t_empty = $SGALLERY_VIEW_TABLE_EMPTY;
    
    //custom nextprev configuration
    $perPage = $sgal_pref['sgal_picperpage'] ? $sgal_pref['sgal_picperpage'] : 9;
    $pageNum = $sgal_pref['sgal_pagenum'] ? $sgal_pref['sgal_pagenum'] : 5;
    
    $parse_info = array();
    $awaiting_pics = 0;
    
	if($sgal_pref['sgal_picperrow']) {
        $parse_info['SGAL_VIEW_W'] = intval(100 / $sgal_pref['sgal_picperrow']).'%';
        $count_cols = true;
    } else {
        $count_cols = false;
    }
    
    //to do -  per Album/user latest pictures
    $parse_info['SGAL_LATEST_PICTURESLINK'] = check_class($sgal_pref['sgal_latest']) ? "<a href='".SGAL_PATH_ABS."gallery.php?latest'>".SGAL_LAN_25."</a>" : '';
    $sgal_param['sgal_latest_pictureslink'] = $parse_info['SGAL_LATEST_PICTURESLINK'];
    
    //param action
    $sgal_param['action'] = $action;
    $sgal_param['parse_images'] = false; //not really needed
    $sgal_param['cpage'] = $cpage; //current page
    $sgal_param['imgpage'] = $imgpage; //current album page
    $sgal_param['nopic_w'] = $sgal_pref['sgal_thumb_w'] ? $sgal_pref['sgal_thumb_w'] : 120; //no image width
    $sgal_param['nopic_h'] = $sgal_pref['sgal_thumb_h'] ? $sgal_pref['sgal_thumb_h'] : 90; //no image height
    $sgal_param['sgal_view_w'] = $parse_info['SGAL_VIEW_W'];
    $sgal_param['max_wh'] = $sgal_pref['sgal_thumb_w'] > $sgal_pref['sgal_thumb_h'] ? $sgal_pref['sgal_thumb_w'] : $sgal_pref['sgal_thumb_h'];

    if($action == 'view') {
        //mysql data - loop
    	$qry = "
    	SELECT al.*, 
        alc.title AS ctitle
    	FROM #sgallery AS al
    	LEFT JOIN #sgallery_cats AS alc ON al.cat_id = alc.cat_id
    	WHERE al.active > 0  AND al.album_ustatus > 0 AND alc.active > 0 AND (al.album_id={$id})
    	GROUP by al.album_id 
    	";
	} else {
        //permissions - check visibility if not album owner and management permissions if is the album owner
        $where = " AND al.active > 0  AND al.album_ustatus > 0 ";
        $lj = '';
        $ljs = '';
        if(USER) {
            if($sql->db_Count("sgallery", "(*)", " WHERE sgal_user LIKE '".USERID.".%' AND album_id={$id}")) {
            
                $where = '';  
                //check user management permissions
                if(!check_class($sgal_pref['sgal_usermod_allow'])) {
                    require_once(HEADERF);
                    if($sgal_pref['sgal_tblrender']) 
                        $ns->tablerender($title, SGAL_LAN_20, 'sgal_core');
                    else
                        echo $pagesrc;
                    require_once(FOOTERF);
                    exit;
                }             
            } else {
                //check user visibility permissions
                if(!check_class($sgal_pref['sgal_usermod_visible'])) {
                    require_once(HEADERF);
                    if($sgal_pref['sgal_tblrender']) 
                        $ns->tablerender($title, SGAL_LAN_20, 'sgal_core');
                    else
                        echo $pagesrc;
                    require_once(FOOTERF);
                    exit;
                }
            }
        } else {
            //check user visibility permissions
            if(!check_class($sgal_pref['sgal_usermod_visible'])) {
                require_once(HEADERF);
                    if($sgal_pref['sgal_tblrender']) 
                        $ns->tablerender($title, SGAL_LAN_20, 'sgal_core');
                    else
                        echo $pagesrc;
                require_once(FOOTERF);
                exit;
            }
        }
        
    	$qry = "
    	SELECT al.*,
    	alc.title AS ctitle
    	FROM #sgallery AS al
    	LEFT JOIN #sgallery_cats AS alc ON al.cat_id = alc.cat_id AND alc.active > 0
    	WHERE al.sgal_user!='' AND al.album_id={$id}{$where}
    	GROUP by al.album_id 
    	";
    }
	if($sql->db_Select_gen($qry)) {
        $row = $sql->db_Fetch();
        //to do - count files instead db query
        if($row['spic_search']) $awaiting_pics = $sql->db_Count("sgallery_submit WHERE submit_album_id='{$id}'");
        
        $ud = $row['sgal_user'] ? explode('.', $row['sgal_user']) : array('0', 'n/a');       
        
        // gallery view tracking
        if($row['cat_id'] && !in_array($row['cat_id'], $_SESSION['cl_galtrack'])) {
            $_SESSION['cl_galtrack'][] = $row['cat_id'];
            $sql->db_Update("sgallery_cats", "cat_viewed=cat_viewed+1 WHERE cat_id='{$row['cat_id']}' ");
        }
        
        if($action == 'view') {
            $sgal_param['sgal_breadc'] = $bread_pre."<a href='".SGAL_PATH."gallery.php'>".PAGE_BREADC_HOME."</a>".SGAL_BREADC_CHAR."<a href='".SGAL_PATH_ABS."gallery.php?list.{$row['cat_id']}.{$cpage}'>".$tp->toHTML($row['ctitle'], FALE, 'parse_sc,no_hook,emotes_off,no_make_clickable')."</a>";
        } else {
            $sgal_param['sgal_breadc'] = $bread_pre."<a href='".SGAL_PATH."gallery.php'>".PAGE_BREADC_HOME."</a>".SGAL_BREADC_CHAR."<a href='".SGAL_PATH_ABS."gallery.php?ulist.0.{$cpage}'>".SGAL_LAN_16."</a>".SGAL_BREADC_CHAR."<a href='".SGAL_PATH_ABS."gallery.php?ulist.".$ud[0].".{$cpage}'>".($ud[1] ? $ud[1] : 'n/a')."</a>";        
        }
        
        $pagesrc .= sgal_parse_template($row, $t_start, true);       
        
        $imagepath = SGAL_ALBUMPATH.$row['path']."/";

        $imagelist = $fl -> sgal_pics($imagepath, $sgal_pref);
        $images = count($imagelist);
        
        $pp->pp_Config($perPage, $pageNum);
        $limit = $pp -> pageLimit($images, $imgpage, true);

        $br = 0;
        $from = 0;
        $num = 1;
        foreach ($imagelist as $image) {
            $br++;
    	    
    	    if($from < $limit['from']) {
                $br--;
                $from++;
                continue;
            }
            
            if($num > $limit['num']) {
                    $br--;
                    break;
            } else {
                $num++;
            }
            
            //new row
    	    if($count_cols && $br == 1){
                $pagesrc .= sgal_parse_template($parse_info, $t_body_pre);
            }
            cachevars('c_sgal_imgitem', $image);
        	$pagesrc .= sgal_parse_template($row, $t_body, true);
        	
    	    //end row
    	    if($count_cols && $br == ($sgal_pref['sgal_picperrow'])){
                $pagesrc .= sgal_parse_template($parse_info, $t_body_post);
                $br = 0;
            }
        }
        
        //empty cells 
        if($br && $count_cols) {
            for ($a = $br; $a < $sgal_pref['sgal_picperrow']; $a++) {
            	$pagesrc .= sgal_parse_template($parse_info, $t_body_empty);	
            }
            $pagesrc .= sgal_parse_template($parse_info, $t_body_post);
        }
        define('e_PAGETITLE', $title.': '.$row['ctitle'].': '. $row['title']);
    } else {
        //No Pics - Old Bookmark?
        $SGAL_NOCOMMENT = true;
        if($action == 'view') {
            $sgal_param['sgal_breadc'] = $bread_pre."<a href='".SGAL_PATH."gallery.php'>".PAGE_BREADC_HOME."</a>";
        } else {
            $sgal_param['sgal_breadc'] = $bread_pre."<a href='".SGAL_PATH."gallery.php'>".PAGE_BREADC_HOME."</a>".SGAL_BREADC_CHAR."<a href='".SGAL_PATH_ABS."gallery.php?ulist.0.{$cpage}'>".SGAL_LAN_16."</a>";
        }
        
        $pagesrc .= sgal_parse_template($parse_info, $t_empty, true);
    }
    
    //pages
    $pp->postQuery = $sgal_iframe ? 'if' : '';
    $pagenav = $pp -> pageNav($images, $imgpage, "{$action}.{$id}.{$cpage}");
    $parse_info['SGAL_IMG_PAGES'] = $pagenav ? $pagenav : SGAL_LAN_52.' 1 '.SGAL_LAN_53.' 1';
    $pagesrc .= sgal_parse_template($parse_info, $t_end);
    
}

if($action == 'latest') {
    
    $t_start = $SGALLERY_LATEST_TABLE_START;
    $t_body_pre = $SGALLERY_LATEST_TABLE_BODY_PRE;
    $t_body = $SGALLERY_LATEST_TABLE_BODY;
    $t_body_post = $SGALLERY_LATEST_TABLE_BODY_POST;
    $t_body_empty = $SGALLERY_LATEST_TABLE_EBODY;
    $t_end = $SGALLERY_LATEST_TABLE_END;
    $t_empty = $$SGALLERY_LATEST_TABLE_EMPTY;
    
	$qry = "
	SELECT al.*, COUNT(al.album_id) AS al_count, alc.title AS ctitle, alc.cat_id AS cid, alc.cat_description, alc.cat_viewed
	FROM #sgallery AS al
	LEFT JOIN #sgallery_cats AS alc ON al.cat_id = alc.cat_id AND alc.active > 0
	WHERE al.active > 0 AND al.album_ustatus > 0 AND alc.active > 0
	GROUP by al.album_id
    ORDER by al.dt DESC
	";
	
	if(check_class($sgal_pref['sgal_latest']) && $sql->db_Select_gen($qry)) {
        $rows = $sql->db_getList('ALL', FALSE, FALSE, 'path');
        $page = $id ? $id : 1;
        
        //custom nextprev configuration
        $perPage = $sgal_pref['sgal_picperpage_latest'] ? $sgal_pref['sgal_picperpage_latest'] : 9;
        $pageNum = $sgal_pref['sgal_pagenum'] ? $sgal_pref['sgal_pagenum'] : 5;
        
        $parse_info = array();
        $awaiting_pics = 0;
        
    	if($sgal_pref['sgal_picperrow_latest']) {
            $parse_info['SGAL_VIEW_W'] = intval(100 / $sgal_pref['sgal_picperrow_latest']).'%';
            $count_cols = true;
        } else {
            $count_cols = false;
        }
        
        //param action
        $sgal_param['action'] = 'view';
        $sgal_param['cpage'] = 1; //current page
        $sgal_param['imgpage'] = $page; //current album page
        $sgal_param['nopic_w'] = $sgal_pref['sgal_thumb_w'] ? $sgal_pref['sgal_thumb_w'] : 120; //no image width
        $sgal_param['nopic_h'] = $sgal_pref['sgal_thumb_h'] ? $sgal_pref['sgal_thumb_h'] : 90; //no image height
        $sgal_param['sgal_view_w'] = $parse_info['SGAL_VIEW_W'];
        $sgal_param['max_wh'] = $sgal_pref['sgal_thumb_w'] > $sgal_pref['sgal_thumb_h'] ? $sgal_pref['sgal_thumb_w'] : $sgal_pref['sgal_thumb_h'];
        
        $sgal_param['sgal_breadc'] = $bread_pre."<a href='".SGAL_PATH."gallery.php'>".PAGE_BREADC_HOME."</a>".SGAL_BREADC_CHAR."<a href='".SGAL_PATH_ABS."gallery.php?latest'>".SGAL_LAN_25."</a>";
        
        
        $dirmask = implode('|', array_keys($rows));
        $cnt = $fl -> sgal_count_allpics($dirmask);
        
        
        $pp->pp_Config($perPage, $pageNum);
        $limit = $pp -> pageLimit($cnt, $page, true);
        
        $allpics = $fl -> sgal_all_pics($limit['from'].','.$limit['num'], $dirmask);

        $pagesrc = sgal_parse_template($parse_info, $t_start, true);

        $br = 0;
        $from = 0;
        $num = 1;
        foreach ($allpics as $image) {
            $br++;
            //print_a($rows);
            $dir = basename($image['path']);
            if(!array_key_exists($dir, $rows)) continue;
            
            //new row
    	    if($count_cols && $br == 1){
                $pagesrc .= sgal_parse_template($parse_info, $t_body_pre);
            }
            cachevars('c_sgal_imgitem', $image);
        	$pagesrc .= sgal_parse_template($rows[$dir], $t_body, true);
        	
    	    //end row
    	    if($count_cols && $br == ($sgal_pref['sgal_picperrow_latest'])){
                $pagesrc .= sgal_parse_template($parse_info, $t_body_post);
                $br = 0;
            }
        }
        
        //empty cells 
        if($br && $count_cols) {
            for ($a = $br; $a < $sgal_pref['sgal_picperrow_latest']; $a++) {
            	$pagesrc .= sgal_parse_template($parse_info, $t_body_empty);	
            }
            $pagesrc .= sgal_parse_template($parse_info, $t_body_post);
        }
        
        //pages
        $pagenav = $pp -> pageNav($cnt, $page, "{$action}");
        $parse_info['SGAL_IMG_PAGES'] = $pagenav ? $pagenav : SGAL_LAN_52.' 1 '.SGAL_LAN_53.' 1';
        $pagesrc .= sgal_parse_template($parse_info, $t_end);
        
        define('e_PAGETITLE', $title.': '.SGAL_LAN_25);
    } else {
        $sgal_param['sgal_breadc'] = $bread_pre."<a href='".SGAL_PATH."gallery.php'>".PAGE_BREADC_HOME."</a>".SGAL_BREADC_CHAR."<a href='".SGAL_PATH_ABS."gallery.php?latest'>".SGAL_LAN_25."</a>";
        $pagesrc .= sgal_parse_template($parse_info, $t_empty, true);
        $parse_info['SGAL_IMG_PAGES'] = SGAL_LAN_54;
        $pagesrc .= sgal_parse_template($parse_info, $t_end);
        define('e_PAGETITLE', $title.': '.SGAL_LAN_25.'- '.SGAL_LAN_54);
    }
}

$sql->db_Mark_Time('End: CL Gallery');
require_once(HEADERF);

$pagesrc = "<div id='sgallery'>{$pagesrc}</div>";
if($sgal_pref['sgal_tblrender']) 
    $ns->tablerender($title, $pagesrc, 'sgal_core');
else
    echo $pagesrc;
if($SGAL_NOCOMMENT === FALSE && check_class($sgal_pref['sgal_album_comments']) && (ANON == TRUE || USER == TRUE) && !$sgal_iframe){
    echo '<br /><br />';
        $width = 0;
    //$showrate = check_class($sgal_pref['sgal_album_rating']);
    $cobj->compose_comment('sgallery', "comment", $id, $width, $row['title'], false);
}    
require_once(FOOTERF);
exit;

function sgal_parse_template($row, $template='', $batch=false) {
    global $tp, $sgal_shortcodes, $sgal_param;
    
    if(!$template) {
        return false;
    }
        
    if(!$batch) {
        extract($row);
        $pagesrc = preg_replace("/\{(.*?)\}/e", '$\1', $template);
    } else {
        cachevars('c_sgal_item', $row);
		cachevars('c_sgal_param', $sgal_param);
        $pagesrc = $tp->parseTemplate($template,TRUE,$sgal_shortcodes);
    }
    return $pagesrc;
}
?>