<?php

// Generated e107 Plugin Admin Area 

require_once('../../class2.php');
if (!getperms('P')) 
{
	header('location:'.e_BASE.'index.php');
	exit;
}

e107::lan('links_page',true,true);
//$lan_file = e_PLUGIN."links_page/languages/".e_LANGUAGE.".php";
include_lan($lan_file);

class links_page_adminArea extends e_admin_dispatcher
{

	protected $modes = array(	
	
		'cat'	=> array(
			'controller' 	=> 'links_page_cat_ui',
			'path' 			=> null,
			'ui' 			=> 'links_page_cat_form_ui',
			'uipath' 		=> null
		),
		

		'main'	=> array(
			'controller' 	=> 'links_page_ui',
			'path' 			=> null,
			'ui' 			=> 'links_page_form_ui',
			'uipath' 		=> null
		),
		
		'submitted'	=> array(
			'controller' 	=> 'links_submitted_ui',
			'path' 			=> null,
			'ui' 			=> 'links_submitted_form_ui',
			'uipath' 		=> null
		),
	);	
	
	
	protected $adminMenu = array(

		'main/list'			=> array('caption'=> LCLAN_ADMINMENU_4, 'perm' => 'P'),
		'main/create'		=> array('caption'=> LCLAN_ADMINMENU_5, 'perm' => 'P'),
		'cat/list'			=> array('caption'=> LCLAN_ADMINMENU_2, 'perm' => 'P'),
		'cat/create'		=> array('caption'=> LCLAN_ADMINMENU_3, 'perm' => 'P'),
		'submitted/list'		=> array('caption'=> LCLAN_ADMINMENU_7, 'perm' => 'P'),        
		'main/prefs' 		=> array('caption'=> LCLAN_ADMINMENU_6, 'perm' => 'P'),	
	);

	protected $adminMenuAliases = array(
		'main/edit'	=> 'main/list',
		'cat/edit'	=> 'cat/list',
	);	
	
	protected $menuTitle = LCLAN_PLUGIN_LAN_1;
}




				
class links_page_cat_ui extends e_admin_ui
{
			
		protected $pluginTitle		= LCLAN_PLUGIN_LAN_1;
		protected $pluginName		= 'links_page';
		protected $eventName		= 'links_page-links_page_cat'; // remove comment to enable event triggers in admin. 		
		protected $table			= 'links_page_cat';
		protected $pid				= 'link_category_id';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
	//	protected $batchCopy		= true;		
	 	protected $sortField		= 'link_category_order';
  	protected $orderStep		= 10;
	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= 'link_category_order DESC';
	
		protected $fields 		= array (  'checkboxes' =>   array ( 'title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => '1', 'class' => 'center', 'toggle' => 'e-multiselect',  ),
		  'link_category_id' =>   array ( 'title' => LAN_ID, 'data' => 'int', 'width' => '5%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'link_category_name' =>   array ( 'title' => LCLAN_CAT_13, 'type' => 'text', 'data' => 'str', 
        'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '', 
        'writeParms' => array('size'=>'block-level' ), 'class' => 'left', 'thclass' => 'left',  ),
		  'link_category_description' =>   array ( 'title' => LCLAN_CAT_14, 'type' => 'textarea', 'data' => 'str', 
        'width' => '40%', 'help' => '', 'readParms' => '', 
        'writeParms' => array('size'=>'block-level' ), 'class' => 'left', 'thclass' => 'left',  ),
		  'link_category_icon' =>   array ( 'title' => LCLAN_CAT_22, 'type' => 'icon', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'link_category_order' =>   array ( 'title' => LAN_ORDER, 'type' => 'number', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'link_category_class' =>   array ( 'title' => LCLAN_CAT_24, 'type' => 'userclass', 'data' => 'str', 'width' => 'auto', 'batch' => true, 'filter' => true, 'inline' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'link_category_datestamp' =>   array ( 'title' => LAN_DATESTAMP, 'type' => 'datestamp', 
        'data' => 'int', 'parms' => 'mask=%A %d %B %Y', 'width' => 'auto', 'filter' => true, 
        'help' => '', 'readParms' => '', 'writeParms' => 'type=datetime', 'class' => 'left', 'thclass' => 'left',  ),
      'link_category_sef' => array ( 'title' => LAN_SEFURL, 'type' => 'text', 'inline'=>true, 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left', ), 


		  'options' =>   array ( 'title' => LAN_OPTIONS, 'type' => null, 'data' => null, 'width' => '10%', 
      'thclass' => 'center last', 'class' => 'center last', 'forced' => '1', 'readParms'=>'sort=1' ),
		);		
		
		protected $fieldpref = array('link_category_name', 'link_category_class', 'link_category_sef', 'link_category_datestamp');
		
	
		public function init()
		{
			// Set drop-down values (if any). 
	
		}

		
		// ------- Customize Create --------
		
		public function beforeCreate($new_data)
		{

  		if(isset($new_data['link_category_datestamp']) && empty($new_data['link_category_datestamp']))
  		{
  			$new_data['link_category_datestamp'] = time();
  		}
      
      if(empty($new_data['link_category_sef']))
      {
          $new_data['link_category_sef'] = eHelper::title2sef($new_data['link_category_name']);
      }
      else 
      {
          $new_data['link_category_sef'] = eHelper::secureSef($new_data['link_category_sef']);
      }
      $sef = e107::getParser()->toDB($new_data['link_category_sef']);

      if(e107::getDb()->count('link_category', '(*)', "link_category_sef='{$sef}'"))
      {
          e107::getMessage()->addError(LCLAN_ADMINMENU_10);
          return false;
      }  
      			
      return $new_data;
		}
	
		public function afterCreate($new_data, $old_data, $id)
		{
			// do something
		}

		public function onCreateError($new_data, $old_data)
		{
			// do something		
		}		
		
		
		// ------- Customize Update --------
		
		public function beforeUpdate($new_data, $old_data, $id)
		{
  		if(isset($new_data['link_category_datestamp']) && empty($new_data['link_category_datestamp']))
  		{
  			$new_data['link_category_datestamp'] = time();
  		}
      
     if(empty($new_data['link_category_sef']))
      {
          $new_data['link_category_sef'] = eHelper::title2sef($new_data['link_category_name']);
      }
      $sef = e107::getParser()->toDB($new_data['link_category_sef']);
      if(e107::getDb()->count('link_category', '(*)', "link_category_sef='{$sef}' AND link_category_id!=".intval($id)))
      {
          e107::getMessage()->addError(LCLAN_ADMINMENU_10);
          return false;
      }

			return $new_data;
		}

		public function afterUpdate($new_data, $old_data, $id)
		{
			// do something	
		}
		
		public function onUpdateError($new_data, $old_data, $id)
		{
			// do something		
		}		
		
		
			
}
				


class links_page_cat_form_ui extends e_admin_form_ui
{

}		
		

				
class links_page_ui extends e_admin_ui
{
			
		protected $pluginTitle	= LCLAN_PLUGIN_LAN_1;
		protected $pluginName		= 'links_page';
		protected $eventName		= 'links_page-links_page'; // remove comment to enable event triggers in admin. 		
		protected $table			= 'links_page';
		protected $pid				= 'link_id';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
	 	protected $batchCopy		= true;		
	//	protected $sortField		= 'somefield_order';
	//	protected $orderStep		= 10;
	  protected $tabs				= array(LCLAN_ADMINMENU_5); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
  	protected $listQry      	= "SELECT * FROM `#links_page` WHERE link_active != '0' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= 'link_id DESC';
	
		protected $fields 		= array (  'checkboxes' =>   array ( 'title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => '1', 'class' => 'center', 'toggle' => 'e-multiselect',  ),
		  'link_id' =>   array ( 'title' => LAN_ID, 'data' => 'int', 'width' => '5%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'link_category' =>   array ( 'title' => LCLAN_ITEM_2, 'type' => 'dropdown', 'data' => 'int', 'width' => 'auto', 'batch' => true, 'filter' => true, 
         'inline' => true,   'help' => '', 'readParms' => '', 'writeParms' => array('size'=>'block-level', 'required'=>1), 'class' => 'left', 'thclass' => 'left',  ),
      

		  'link_name' =>   array ( 'title' => LCLAN_ITEM_4, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 
        'inline' => true, 'help' => '', 'readParms' => '', 'writeParms' => array('size'=>'block-level', 'required'=>1), 'class' => 'left', 'thclass' => 'left',  ),
		  'link_url' =>   array ( 'title' => LCLAN_ITEM_5, 'type' => 'url', 'data' => 'str', 'width' => 'auto', 'inline' => true,  
        'help' => '', 'readParms' => '', 'writeParms' => array('size'=>'block-level', 'required'=>1), 'class' => 'left', 'thclass' => 'left',  ),
		  'link_description' =>   array ( 'title' => LCLAN_ITEM_6, 'type' => 'textarea', 'data' => 'str', 'width' => '40%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'link_button' =>   array ( 'title' => LCLAN_ITEM_14, 'type' => 'icon', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),

		  'link_order' =>   array ( 'title' => LAN_ORDER, 'type' => 'number', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'link_refer' =>   array ( 'title' => LCLAN_REFERER, 'type' => 'boolean', 'data' => 'int', 
        'readonly' => 'true',
        'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'link_open' =>   array ( 'title' => LCLAN_ITEM_16, 'type' => 'dropdown', 'data' => 'int', 'width' => 'auto', 'help' => '', 
        'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'link_class' =>   array ( 'title' => LCLAN_ITEM_20, 'type' => 'userclass', 'data' => 'int', 'width' => 'auto', 
        'batch' => true, 'filter' => true, 'inline' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
     
		  'link_datestamp' =>   array ( 'title' => LCLAN_CREATED,  'type' => 'datestamp',   
          'data' => 'int', 'width' => 'auto', 'help' => '', 
          'readParms' => '',   /*'readonly' => true,  todo */
          'parms' => 'mask=%A %d %B %Y',
          'writeParms' => 'type=datetime', 'class' => 'left', 'thclass' => 'left',  ),
		  'link_author' =>   array ( 'title' => LAN_AUTHOR, 'type' => 'user', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'link_active' =>   array ( 'title' => LAN_STATUS, 'type' => 'boolean', 'data' => 'int', 'width' => '5%', 'thclass' => 'center',   
      'class' => 'center', 'batch' => true, 'filter' => true, 'writeParms' => array('default' => 1) ),
      'options' =>   array ( 'title' => LAN_OPTIONS, 'type' => null, 'data' => null, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center last', 'forced' => '1',  ),
		);		
		
		protected $fieldpref = array('link_name', 'link_category', 'link_class', 'link_active', 'link_datestamp');
		

	 	protected $preftabs        = array(LCLAN_OPT_MENU_1, LCLAN_OPT_MENU_8, LCLAN_OPT_MENU_2, LCLAN_OPT_MENU_3, LCLAN_OPT_MENU_4,LCLAN_OPT_MENU_5,LCLAN_OPT_MENU_6, LCLAN_OPT_MENU_7 );
		protected $prefs = array(
			'link_page_categories'		=> array('title'=> LCLAN_OPT_7, 'tab'=>0, 'type'=>'boolean', 'data' => 'str', 'help'=>'Help Text goes here'),
			'link_submit'		=> array('title'=> LCLAN_OPT_8, 'tab'=>0, 'type'=>'boolean', 'data' => 'str', 'help'=>'Help Text goes here'),
			'link_submit_class'		=> array('title'=> LCLAN_OPT_9, 'tab'=>0, 'type'=>'userclass', 'data' => 'str', 'help'=>'Help Text goes here'),
			'link_submit_directpost'		=> array('title'=> LCLAN_OPT_48, 'tab'=>0, 'type'=>'boolean', 'data' => 'str', 'help'=>'if enabled links are submitted directly, else a site admin needs to approve them'),
			//link_nextprev
      'link_nextprev'		=> array('title'=> LCLAN_OPT_10, 'tab'=>0, 'type'=>'boolean', 'data' => 'str', 'help'=>'Help Text goes here'),
			//link_nextprev_number
      'link_nextprev_number'		=> array('title'=> LCLAN_OPT_11, 'tab'=>0, 'type'=>'number', 'data' => 'str', 'help'=>'Help Text goes here'),
			//link_comment
      'link_comment'		=> array('title'=> LCLAN_OPT_55, 'tab'=>0, 'type'=>'boolean', 'data' => 'str', 'help'=>'Help Text goes here'),


			// checkbox doesn't work  
      'link_navigator_allcat'		=> array('title'=> LCLAN_DISP_CATNAV, 'tab'=>1, 'type'=>'boolean', 'data' => 'str', 'help'=>LCLAN_DISP_CATNAV_HELP),
      'link_display_navigator'		=> array('title'=> LCLAN_DISP_NAVPAG, 'tab'=>1, 'type'=>'boolean', 'data' => 'str', 'help'=>LCLAN_DISP_NAVPAG_HELP),      
      'link_navigator_frontpage'	=> array('title'=> LCLAN_OPT_60, 'tab'=>1, 'type'=>'boolean', 'data' => 'str', 'help'=>'Help Text goes here'),
      'link_navigator_submit'		  => array('title'=> LCLAN_OPT_58, 'tab'=>1, 'type'=>'boolean', 'data' => 'str', 'help'=>'Help Text goes here'),
      'link_navigator_manager'		=> array('title'=> LCLAN_OPT_59, 'tab'=>1, 'type'=>'boolean', 'data' => 'str', 'help'=>'Help Text goes here'),
      'link_navigator_refer'		=> array('title'=> LCLAN_OPT_20, 'tab'=>1, 'type'=>'boolean', 'data' => 'str', 'help'=>'Help Text goes here'),
      'link_navigator_rated'		=> array('title'=> LCLAN_OPT_21, 'tab'=>1, 'type'=>'boolean', 'data' => 'str', 'help'=>'Help Text goes here'),
      'link_navigator_links'		=> array('title'=> LCLAN_OPT_67, 'tab'=>1, 'type'=>'boolean', 'data' => 'str', 'help'=>'Help Text goes here'),
      'link_navigator_category'		=> array('title'=> LCLAN_OPT_61, 'tab'=>1, 'type'=>'boolean', 'data' => 'str', 'help'=>'Help Text goes here'),      

      
      'link_manager'		=> array('title'=> LCLAN_OPT_54, 'tab'=>2, 'type'=>'boolean', 'data' => 'str', 'help'=>'Help Text goes here'),        
      'link_manager_class'		=> array('title'=> LCLAN_OPT_46, 'tab'=>2, 'type'=>'userclass', 'data' => 'str', 'help'=>LCLAN_HELP_2),
      'link_directpost'		=> array('title'=> LCLAN_OPT_48, 'tab'=>2, 'type'=>'boolean', 'data' => 'str', 'help'=>LCLAN_HELP_3),
      'link_directdelete'		=> array('title'=> LCLAN_OPT_50, 'tab'=>2, 'type'=>'boolean', 'data' => 'str', 'help'=>LCLAN_HELP_4),
                        
      'link_cat_icon'		=> array('title'=> LCLAN_OPT_14, 'tab'=>3, 'type'=>'boolean', 'data' => 'str', 'help'=>'Help Text goes here'),        
      'link_cat_desc'		=> array('title'=> LCLAN_OPT_15, 'tab'=>3, 'type'=>'boolean', 'data' => 'str', 'help'=>'Help Text goes here'),        
      'link_cat_amount'		=> array('title'=> LCLAN_OPT_16, 'tab'=>3, 'type'=>'boolean', 'data' => 'str', 'help'=>'Help Text goes here'),        
      'link_cat_total'		=> array('title'=> LCLAN_OPT_19, 'tab'=>3, 'type'=>'boolean', 'data' => 'str', 'help'=>'Help Text goes here'),        
      'link_cat_empty'		=> array('title'=> LCLAN_OPT_65, 'tab'=>3, 'type'=>'boolean', 'data' => 'str', 'help'=>'Help Text goes here'),        
      'link_cat_icon_empty'		=> array('title'=> LCLAN_OPT_22, 'tab'=>3, 'type'=>'boolean', 'data' => 'str', 'help'=>'Help Text goes here'),        
      'link_cat_sortorder'		=> array('title'=> LCLAN_OPT_29, 'tab'=>3, 'type'=>'boolean', 'data' => 'str', 'help'=>'Help Text goes here'),        
      'link_cat_sort'		=> array('title'=> LCLAN_OPT_23, 'tab'=>3, 'type'=>'dropdown', 'data' => 'str', 'help'=>'Help Text goes here'),       
      'link_cat_order'		=> array('title'=> LCLAN_OPT_24, 'tab'=>3, 'type'=>'dropdown', 'data' => 'str', 'help'=>'Help Text goes here'),        
      'link_cat_resize_value'		=> array('title'=> LCLAN_OPT_25, 'tab'=>3, 'type'=>'text', 'data' => 'str', 'help'=>'Help Text goes here'),         
  
      'link_icon'		=> array('title'=> LCLAN_OPT_14, 'tab'=>4, 'type'=>'boolean', 'data' => 'str', 'help'=>'Help Text goes here'),
      'link_referal'		=> array('title'=> LCLAN_OPT_17, 'tab'=>4, 'type'=>'boolean', 'data' => 'str', 'help'=>'Help Text goes here'),
      'link_url'		=> array('title'=> LCLAN_OPT_18, 'tab'=>4, 'type'=>'boolean', 'data' => 'str', 'help'=>'Help Text goes here'),
      'link_desc'		=> array('title'=> LCLAN_OPT_15, 'tab'=>4, 'type'=>'boolean', 'data' => 'str', 'help'=>'Help Text goes here'),
      'link_sortorder'		=> array('title'=> LCLAN_OPT_29, 'tab'=>4, 'type'=>'boolean', 'data' => 'str', 'help'=>'Help Text goes here'),        
      'link_sort'		=> array('title'=> LCLAN_OPT_23, 'tab'=>4, 'type'=>'dropdown', 'data' => 'str', 'help'=>'Help Text goes here'),       
      'link_order'		=> array('title'=> LCLAN_OPT_23, 'tab'=>4, 'type'=>'dropdown', 'data' => 'str', 'help'=>'Help Text goes here'),
         //????  0=same window, 1=_blank, 2=_parent, 3=_top, 4=miniwindow
      'link_open_all'		=> array('title'=> LCLAN_OPT_32, 'tab'=>4, 'type'=>'dropdown', 'data' => 'str', 'help'=>'Help Text goes here'),
      'link_cat_resize_value'		=> array('title'=> LCLAN_OPT_33, 'tab'=>4, 'type'=>'text', 'data' => 'str', 'help'=>'Help Text goes here'),        
       

      'link_refer_minimum'		=> array('title'=> LCLAN_OPT_56, 'tab'=>5, 'type'=>'text', 'data' => 'str', 
        'help'=>'only links with a refer count larger then the given value are displayed (0 or empty = all)'),  
          
			'link_rating'		=> array('title'=> LCLAN_OPT_27, 'tab'=>6,'type'=>'boolean','data' => 'str', 'help'=>'Help Text goes here'),           
      'link_rating_minimum'		=> array('title'=> LCLAN_OPT_63, 'tab'=>6, 'type'=>'text', 'data' => 'str', 
        'help'=>LCLAN_HELP_5),         
 
      'link_menu_caption'		=> array('title'=> LCLAN_OPT_85, 'tab'=>7, 'type'=>'text', 'data' => 'str', 'help'=>'Help Text goes here'), 
      'link_menu_navigator_frontpage'		=> array('title'=> LCLAN_OPT_60, 'tab'=>7, 'type'=>'checkbox', 'data' => 'str', 'help'=>'Help Text goes here'),  
      'link_menu_navigator_submit'		=> array('title'=> LCLAN_OPT_58, 'tab'=>7, 'type'=>'checkbox', 'data' => 'str', 'help'=>'Help Text goes here'),  
      'link_menu_navigator_manager'		=> array('title'=> LCLAN_OPT_59, 'tab'=>7, 'type'=>'checkbox', 'data' => 'str', 'help'=>'Help Text goes here'), 
      'link_menu_navigator_refer'		=> array('title'=> LCLAN_OPT_20, 'tab'=>7, 'type'=>'checkbox', 'data' => 'str', 'help'=>'Help Text goes here'), 
      'link_menu_navigator_rated'		=> array('title'=> LCLAN_OPT_21, 'tab'=>7, 'type'=>'checkbox', 'data' => 'str', 'help'=>'Help Text goes here'),
      'link_menu_navigator_links'		=> array('title'=> LCLAN_OPT_67, 'tab'=>7, 'type'=>'checkbox', 'data' => 'str', 'help'=>'Help Text goes here'),
      'link_menu_navigator_category'		=> array('title'=> LCLAN_OPT_61, 'tab'=>7, 'type'=>'checkbox', 'data' => 'str', 'help'=>'Help Text goes here'),
      'link_menu_navigator_caption'		=> array('title'=> LCLAN_OPT_79, 'tab'=>7, 'type'=>'text', 'data' => 'str', 'help'=>'Help Text goes here'),      
      'link_menu_navigator_rendertype'		=> array('title'=> LCLAN_OPT_69, 'tab'=>7, 'type'=>'dropdown', 'data' => 'str', 'help'=>'Help Text goes here'),  
      'link_menu_category'		=> array('title'=> LCLAN_OPT_70, 'tab'=>7, 'type'=>'boolean', 'data' => 'str', 'help'=>'Help Text goes here'), 
      'link_menu_category_caption'		=> array('title'=> LCLAN_OPT_80, 'tab'=>7, 'type'=>'text', 
        'data' => 'str', 'help'=>'Help Text goes here'),
      'link_menu_category_amount'		=> array('title'=> LCLAN_OPT_87, 'tab'=>7, 'type'=>'boolean', 
        'data' => 'str', 'help'=>'Help Text goes here'),   
      'link_menu_category_rendertype'		=> array('title'=> LCLAN_OPT_71, 'tab'=>7, 'type'=>'dropdown', 
        'data' => 'str', 'help'=>'Help Text goes here'),
      'link_menu_recent'		=> array('title'=> LCLAN_OPT_72, 'tab'=>7, 'type'=>'boolean', 
        'data' => 'str', 'help'=>'Help Text goes here'),
      'link_menu_recent_category'		=> array('title'=> LCLAN_OPT_77, 'tab'=>7, 'type'=>'checkbox', 
        'data' => 'str', 'help'=>'Help Text goes here'),
      'link_menu_recent_description'		=> array('title'=> LCLAN_OPT_78, 'tab'=>7, 'type'=>'checkbox', 
        'data' => 'str', 'help'=>'Help Text goes here'),
      'link_menu_recent_caption'		=> array('title'=> LCLAN_OPT_81, 'tab'=>7, 'type'=>'text', 
          'data' => 'str', 'help'=>'Help Text goes here'),        
      'link_menu_recent_number'		=> array('title'=> LCLAN_OPT_74, 'tab'=>7, 'type'=>'text', 
          'data' => 'number', 'help'=>'Help Text goes here'),        
   		); 

	
		public function init()
		{
			// Set drop-down values (if any). 
 		$this->prefs['link_cat_sort']['writeParms']['optArray'] = array(
      'heading'=>LCLAN_OPT_40,
      'id'=>LCLAN_OPT_41, 
      'order'=>LCLAN_OPT_36); 
 		$this->prefs['link_cat_order']['writeParms']['optArray'] = array(
      'ASC'=>ASC,
      'DESC'=>DESC); 
 		$this->prefs['link_sort']['writeParms']['optArray'] = array(
      'heading'=>LCLAN_OPT_34,
      'url'=>LCLAN_OPT_35,
      'order'=>LCLAN_OPT_36,
      'refer'=>LCLAN_OPT_37, 
      'date'=>LCLAN_OPT_53
      );      
 		$this->prefs['link_order']['writeParms']['optArray'] = array(
      'ASC'=>ASC,
      'DESC'=>DESC);  	
 		$this->prefs['link_open_all']['writeParms']['optArray'] = array(
      '5'=>LCLAN_OPT_42,
      '0'=>LCLAN_OPT_43,
      '1'=>LCLAN_OPT_44,
      '4'=>LCLAN_OPT_45
      );
 		$this->prefs['link_menu_category_rendertype']['writeParms']['optArray'] = array(
      '1'=>LCLAN_OPT_76,
      '0'=>LCLAN_OPT_75);       
 		$this->prefs['link_menu_navigator_rendertype']['writeParms']['optArray'] = array(
      '1'=>LCLAN_OPT_76,
      '0'=>LCLAN_OPT_75); 
      
      
  	$db = e107::getDb();
    $this->link_category[] = LCLAN_ITEM_3 ;
  	if($db->select('links_page_cat', '*' )) { while ($row = $db->fetch()) { 
     $this->link_category[$row['link_category_id']] = $row['link_category_name']; } 	} 
     $this->fields['link_category']['writeParms']['optArray'] = $this->link_category;
	 
    
    
 		$this->fields['link_open']['writeParms']['optArray'] = array(
      '0'=>LCLAN_ITEM_17,
      '1'=>LCLAN_ITEM_18,
      '4'=>LCLAN_ITEM_19
      );
       
  	}
		// ------- Customize Create --------
		
		public function beforeCreate($new_data)
		{

  		if(isset($new_data['link_datestamp']) && empty($new_data['link_datestamp']))
  		{
  			$new_data['link_datestamp'] = time();
  		} 
      
			return $new_data;
		}
	
		public function afterCreate($new_data, $old_data, $id)
		{
			// do something
		}

		public function onCreateError($new_data, $old_data)
		{
			// do something		
		}		
		
		
		// ------- Customize Update --------
		
		public function beforeUpdate($new_data, $old_data, $id)
		{

  		if(isset($new_data['link_datestamp']) && empty($new_data['link_datestamp']))
  		{
  			$new_data['link_datestamp'] = time();
  		} 
      
			return $new_data;
		}

		public function afterUpdate($new_data, $old_data, $id)
		{
			// do something	
		}
		
		public function onUpdateError($new_data, $old_data, $id)
		{
			// do something		
		}		

    public function eversionPage()
    {
     
		 $mainadmin = e_SELF.'/../admin_vupdate.php';
     header("location:".$mainadmin); exit; 
    } 
}
				


class links_page_form_ui extends e_admin_form_ui
{

}		


				
class links_submitted_ui extends e_admin_ui
{
			
		protected $pluginTitle	= LCLAN_PLUGIN_LAN_1;
		protected $pluginName		= 'links_page';
		protected $eventName		= 'links_page-links_page_submitted'; // remove comment to enable event triggers in admin. 		
		protected $table			= 'links_page';
		protected $pid				= 'link_id';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
	 	protected $batchCopy		= true;		
	//	protected $sortField		= 'somefield_order';
	//	protected $orderStep		= 10;
	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
  	protected $listQry      	= "SELECT * FROM `#links_page` WHERE link_active = '0' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= 'link_id DESC';
	
		protected $fields 		= array (  'checkboxes' =>   array ( 'title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => '1', 'class' => 'center', 'toggle' => 'e-multiselect',  ),
		  'link_id' =>   array ( 'title' => LAN_ID, 'data' => 'int', 'width' => '5%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'link_category' =>   array ( 'title' => LCLAN_ITEM_2, 'type' => 'dropdown', 'data' => 'int', 'width' => 'auto', 'batch' => true, 'filter' => true, 'inline' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
      

		  'link_name' =>   array ( 'title' => LCLAN_ITEM_4, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 
        'inline' => true, 'help' => '', 'readParms' => '', 'writeParms' => array('size'=>'block-level' ), 'class' => 'left', 'thclass' => 'left',  ),
		  'link_url' =>   array ( 'title' => LCLAN_ITEM_5, 'type' => 'url', 'data' => 'str', 'width' => 'auto', 'inline' => true,  
        'help' => '', 'readParms' => '', 'writeParms' => array('size'=>'block-level' ), 'class' => 'left', 'thclass' => 'left',  ),
		  'link_description' =>   array ( 'title' => LCLAN_ITEM_6, 'type' => 'textarea', 'data' => 'str', 'width' => '40%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'link_button' =>   array ( 'title' => LCLAN_ITEM_14, 'type' => 'icon', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),

		  'link_order' =>   array ( 'title' => LAN_ORDER, 'type' => 'number', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'link_refer' =>   array ( 'title' => LCLAN_REFERER, 'type' => 'boolean', 'data' => 'int', 
        'readonly' => 'true',
        'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'link_open' =>   array ( 'title' => LCLAN_ITEM_16, 'type' => 'dropdown', 'data' => 'int', 'width' => 'auto', 'help' => '', 
        'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'link_class' =>   array ( 'title' => LCLAN_ITEM_20, 'type' => 'userclass', 'data' => 'int', 'width' => 'auto', 
        'batch' => true, 'filter' => true, 'inline' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
     
		  'link_datestamp' =>   array ( 'title' => LCLAN_CREATED,  'type' => 'datestamp',   
          'data' => 'int', 'width' => 'auto', 'help' => '', 
          'readParms' => '',   /*'readonly' => true,  todo */
          'parms' => 'mask=%A %d %B %Y',
          'writeParms' => 'type=datetime', 'class' => 'left', 'thclass' => 'left',  ),
		  'link_author' =>   array ( 'title' => LAN_AUTHOR, 'type' => 'user', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'link_active' =>   array ( 'title' => LAN_STATUS, 'type' => 'boolean', 'data' => 'int', 'width' => '5%', 'thclass' => 'center',   
      'class' => 'center', 'batch' => true, 'filter' => true),
      'options' =>   array ( 'title' => LAN_OPTIONS, 'type' => null, 'data' => null, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center last', 'forced' => '1',  ),
		);		
		
		protected $fieldpref = array('link_name', 'link_category', 'link_url', 'link_class', 'link_button', 'link_author', 'link_active', 'link_datestamp');
		

	 	protected $preftabs   = array();
		protected $prefs = array();
	
		public function init()
		{
			// Set drop-down values (if any). 
 		$this->prefs['link_cat_sort']['writeParms']['optArray'] = array(
      'heading'=>LCLAN_OPT_40,
      'id'=>LCLAN_OPT_41, 
      'order'=>LCLAN_OPT_36); 
 		$this->prefs['link_cat_order']['writeParms']['optArray'] = array(
      'ASC'=>ASC,
      'DESC'=>DESC); 
 		$this->prefs['link_sort']['writeParms']['optArray'] = array(
      'heading'=>LCLAN_OPT_34,
      'url'=>LCLAN_OPT_35,
      'order'=>LCLAN_OPT_36,
      'refer'=>LCLAN_OPT_37, 
      'date'=>LCLAN_OPT_53
      );      
 		$this->prefs['link_order']['writeParms']['optArray'] = array(
      'ASC'=>ASC,
      'DESC'=>DESC);  	
 		$this->prefs['link_open_all']['writeParms']['optArray'] = array(
      '5'=>LCLAN_OPT_42,
      '0'=>LCLAN_OPT_43,
      '1'=>LCLAN_OPT_44,
      '4'=>LCLAN_OPT_45
      );
 		$this->prefs['link_menu_category_rendertype']['writeParms']['optArray'] = array(
      '1'=>LCLAN_OPT_76,
      '0'=>LCLAN_OPT_75);       
 		$this->prefs['link_menu_navigator_rendertype']['writeParms']['optArray'] = array(
      '1'=>LCLAN_OPT_76,
      '0'=>LCLAN_OPT_75); 
      
      
  	$db = e107::getDb();
    $this->link_category[] = LCLAN_ITEM_3 ;
  	if($db->select('links_page_cat', '*' )) { while ($row = $db->fetch()) { 
     $this->link_category[$row['link_category_id']] = $row['link_category_name']; } 	} 
     $this->fields['link_category']['writeParms']['optArray'] = $this->link_category;
	 
    
    
 		$this->fields['link_open']['writeParms']['optArray'] = array(
      '0'=>LCLAN_ITEM_17,
      '1'=>LCLAN_ITEM_18,
      '4'=>LCLAN_ITEM_19
      );
  	}
		// ------- Customize Create --------
		
		public function beforeCreate($new_data)
		{

  		if(isset($new_data['link_datestamp']) && empty($new_data['link_datestamp']))
  		{
  			$new_data['link_datestamp'] = time();
  		} 
      
			return $new_data;
		}
	
		public function afterCreate($new_data, $old_data, $id)
		{
			// do something
		}

		public function onCreateError($new_data, $old_data)
		{
			// do something		
		}		
		
		
		// ------- Customize Update --------
		
		public function beforeUpdate($new_data, $old_data, $id)
		{

  		if(isset($new_data['link_datestamp']) && empty($new_data['link_datestamp']))
  		{
  			$new_data['link_datestamp'] = time();
  		} 
      
			return $new_data;
		}

		public function afterUpdate($new_data, $old_data, $id)
		{
			// do something	
		}
		
		public function onUpdateError($new_data, $old_data, $id)
		{
			// do something		
		}		
		
			
 
 
			
}
				


class links_submitted_form_ui extends e_admin_form_ui
{

}		
		
		
new links_page_adminArea();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");
exit;

?>
