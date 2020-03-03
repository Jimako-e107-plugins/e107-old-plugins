<?php

if (!defined('e107_INIT')) { exit; }

 

class links_page_search extends e_search // include plugin-folder in the name.
{

	function __construct()
	{
		$this->plugPrefs = e107::getPlugConfig('links_page')->getPref();
	}
  		
	function config()
	{	
		$sql = e107::getDb();
					
		$catList = array();
		
		$catList[] = array('id' => 'all', 'title' => LAN_SEARCH_51);
 
		if ($sql ->gen("SELECT link_category_id, link_category_name FROM #links_page_cat  ")) 
		{
			while($row = $sql->fetch()) 
			{
				$catList[] = array('id' => $row['link_category_id'], 'title' => $row['link_category_name']);
			//	$advanced_caption['title'][$row['category_id']] = 'News -> '.$row['category_name'];
			}
		}			
				
				
		$search = array(
			'name'			=> LCLAN_ADMIN_14,
			'table'			=> 'links_page AS l LEFT JOIN #links_page_cat AS c ON l.link_category = c.link_category_id  ',

			'advanced' 		=> array(
								'cat'	=> array('type'	=> 'dropdown', 		'text' =>  LAN_SEARCH_63.':', 'list'=>$catList)
							),
			'return_fields'	=> array('l.link_id', 'l.link_name','l.link_description', 'l.link_url', 'l.link_category', 'l.link_class', 'c.link_category_name', 'c.link_category_sef', 'c.link_category_class'), 
			'search_fields'	=> array('l.link_name'=> '1.2', 'l.link_description' => '0.6'), // fields and weights. 
			
			'order'			=> array('l.link_name' => DESC),
			'refpage'		=> e_PLUGIN_ABS.'links_page/links.php'
		);
		return $search;
	}



	/* Compile Database data for output */
	function compile($row)
	{
		$res = array(); 
    $linkopen = $this->link_open($row);
  	//$res['link'] = e_PLUGIN."links_page/links.php?view.".$row['link_id'];
    $res['link'] = '';
  	$res['pre_title'] = $row['link_category_name']." | ";
  	$res['title'] = $row['link_name'];
  	$res['summary'] = $row['link_description'];
  	$res['detail'] = "<a href='".$row['link_url']."' ".$linkopen." >".$row['link_url']."</a>";

		return $res;
		
	}



	/**
	 * Optional - Advanced Where
	 * @param $parm - data returned from $_GET (ie. advanced fields included. in this case 'date' and 'author' )
	 */
	function where($parm='')
	{
		$tp = e107::getParser();   
		                         
		$qry = "l.link_active = 1 AND l.link_class IN (".USERCLASS_LIST.") AND ".$advanced_where;
    
		if (isset($parm['cat']) && is_numeric($parm['cat'])) 
		{
			$qry .=  " l.link_category='".$_GET['cat']."' AND";
		}
 		
		return $qry;
	}
	
	function link_open($row)
	{
    if($this->plugPrefs['link_open_all'] && $this->plugPrefs['link_open_all'] == "5"){
            $link_open_type = $this->var['link_open'];
    }else{
            $link_open_type = $this->plugPrefs['link_open_all'];
    }

		switch($link_open_type)
		{
      case 1:
      $lappend = "onclick=\"open_window('".e_PLUGIN_ABS."links_page/links.php?view.".$row['link_id']."','full');return false;\""; // Googlebot won't see it any other way.
      break;
      case 2:
      $lappend = "onclick=\"location.href='".e_PLUGIN_ABS."links_page/links.php?view.".$row['link_id']."';return false\"";  // Googlebot won't see it any other way.
      break;
      case 3:
      $lappend = "onclick=\"location.href='".e_PLUGIN_ABS."links_page/links.php?view.".$row['link_id']."';return false\"";  // Googlebot won't see it any other way.
      break;
      case 4:
      $lappend = "onclick=\"open_window('".e_PLUGIN_ABS."links_page/links.php?view.".$row['link_id']."');return false\""; // Googlebot won't see it any other way.
      break;
      default:
      $lappend = "onclick=\"location.href='".e_PLUGIN_ABS."links_page/links.php?view.".$row['link_id']."';return false\"";  // Googlebot won't see it any other way.
		}
		return $lappend;
	} 
}
 
?>