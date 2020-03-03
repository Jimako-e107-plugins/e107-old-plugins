<?php
/*
/**
 * Links Page plugin for e107 v2.
 *
 * @file
 * Custom install/uninstall/update routines.
 */
if (!defined('e107_INIT')) { exit; } 
class links_page_setup
{
	/**
	 * This function is called before plugin table has been created
	 * by the plugin_sql.php file.
	 *
	 * @param array $var
	 */
 	function install_pre($var)
	{
	
	}
	/**
	 * This function is called after plugin table has been created
	 * by the plugin_sql.php file.
	 *
	 * @param array $var
	 */
	function install_post($var)
	{

    $db = e107::getDb();
    $mes = e107::getMessage();
		$categories = array();
    /* TODO to add question if load demo content */
    if($db->count('links_page_cat') == 0) {
      $categories[] = array(
      			'link_category_id'     => 1,
      			'link_category_name'  => 'Default Link Category',
      			'link_category_description'   => 'Default category for demo purpose',
      			'link_category_icon' => '{e_PLUGIN}links_page/images/linkspage_32.png',
      			'link_category_order'    => '1',
      			'link_category_class'  => '0',
            'link_category_datestamp'  => time(),
      );  
      
     	foreach($categories as $category)
  		{
  			
        $status = ($db->insert('links_page_cat', $category)) ? E_MESSAGE_SUCCESS : E_MESSAGE_ERROR;
		    $mes->add("Adding Default table data to table: links_page_cat",$status);
  		}
 
      $links[] = array(
      			'link_id'     => NULL,
      			'link_name'  => 'Developer Reference Manual',
      			'link_url'   => 'http://e107.org/developer-manual',
      			'link_description' => 'e107 v2.x Plugin and Theme developer manual',
      			'link_button'    => '1',
      			'link_category'  => '1',
      			'link_order'  => '1',
      			'link_refer'  => '',
      			'link_open'  => '1',
      			'link_class'  => '0',
      			'link_datestamp'  => time(),                                                
            'link_author'  => '1',
            'link_active'  => '1',
      );     
      
     	foreach($links as $link)
  		{
  			
        $status = ($db->insert('links_page', $link)) ? E_MESSAGE_SUCCESS : E_MESSAGE_ERROR;
		    $mes->add("Adding Default table data to table: links_page",$status);
  		}    
      
    } 
    
    
    
	}
	
	function uninstall_options()
	{
	}
	
	function uninstall_post($var)
	{
	}
	function upgrade_post($var)
	{
		$db = e107::getDb();
		$currentVersion = $var->current_plug['plugin_version'];
 
		if($currentVersion == '1.0')
		{    
      /* to fill SEF URL FOR categories*/    
      $db = e107::getDb(); 
      if($allRows = $db->retrieve('SELECT * FROM #links_page_cat', TRUE)) {
      	foreach($allRows as $row)
      	{
            $id = $row["link_category_id"];
            $where = 'link_category_id = '.$id; 
            $update = array(
            'link_category_sef' => eHelper::title2sef($row['link_category_name']),
             'WHERE' => $where
            );       
            $db->update('links_page_cat', $update);   
        }      
      } 
      /* to set all existing links as active */
      $db = e107::getDb('links_page');
      $update = array(
      'link_active' => 1
      );
       
      $db->update('links_page', $update);           
		}		     
	}
	
}
?>