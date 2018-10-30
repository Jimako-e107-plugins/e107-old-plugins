<?php
define('e_TOKEN_FREEZE', true); 
require_once('../../class2.php');
require_once('init.php');
global $sgal_shortcodes;

$query = array('action' => 'picture', 'album_id' => 0, 'id' => '');
parse_str(str_replace('&amp;', '&', e_QUERY), $tmp);

$query = array_merge($query, $tmp); 
unset($tmp);

include_lan(SGAL_LAN.'.php');
if(!check_class(e107::getPref('sgal_active'))) 
{
    require_once(HEADERF);
        e107::getRender()->tablerender(SGAL_PAGE_NAME, SGAL_LAN_20, 'sgal_core');
    require_once(FOOTERF);
    exit;
}

require_once(SGAL_INCPATH."sgal_batch.php");

$ret = '';

switch ($query['action']) 
{
	case 'picture': 
		if(empty($query['album_id']) || empty($query['id']))
		{
			return e107::getTemplate('sgallery', 'sgallery_ajax', varset($query['tkey_nop'], 'nopicture'));
			break; //nopic
		}
		
		$picture = array('fname' => preg_replace('#[^\w\.\-]#', '', $query['id']));
		$album_id = intval($query['album_id']);
		$tmpl = e107::getTemplate('sgallery', 'sgallery_ajax', varset($query['tkey'], 'picture'));
		
    	$qry = "
    	SELECT al.*, 
        alc.title AS ctitle
    	FROM #sgallery AS al
    	LEFT JOIN #sgallery_cats AS alc ON al.cat_id = alc.cat_id
    	WHERE al.album_id={$album_id} AND al.active > 0  AND al.album_ustatus > 0 AND alc.active > 0
    	GROUP by al.album_id 
    	";
    	
    	if(e107::getDb()->db_Select_gen($qry, false))
    	{
    		$row = e107::getDb()->db_Fetch();
    		
	        //param action
	        $sgal_param['action'] = 'view';
	        $sgal_param['cpage'] = 1; //current page
//	        $sgal_param['imgpage'] = 1; //not required here
//	        $sgal_param['nopic_w'] = $sgal_pref['sgal_thumb_w'] ? $sgal_pref['sgal_thumb_w'] : 120; //no image width
//	        $sgal_param['nopic_h'] = $sgal_pref['sgal_thumb_h'] ? $sgal_pref['sgal_thumb_h'] : 90; //no image height
//	        $sgal_param['sgal_view_w'] = $parse_info['SGAL_VIEW_W'];
	        //$sgal_param['max_wh'] = $sgal_pref['sgal_thumb_w'] > $sgal_pref['sgal_thumb_h'] ? $sgal_pref['sgal_thumb_w'] : $sgal_pref['sgal_thumb_h'];
	        
			cachevars('c_sgal_item', $row);
			cachevars('c_sgal_param', $sgal_param);
			cachevars('c_sgal_imgitem', $picture);
			
			$ret = e107::getParser()->parseTemplate($tmpl, true, $sgal_shortcodes);

    	}
    	else 
    	{
    		$ret = e107::getTemplate('sgallery', 'sgallery_ajax', varset($query['tkey_nop'], 'nopicture'));
    	}
	break;
}

e107::getJshelper()->sendTextResponse($ret);