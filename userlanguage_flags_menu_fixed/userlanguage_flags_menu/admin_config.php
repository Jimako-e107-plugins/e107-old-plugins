<?php

// Generated e107 Plugin Admin Area 

require_once('../../class2.php');
if (!getperms('P')) 
{
	e107::redirect('admin');
	exit;
}



class userlanguage_flags_menu_adminArea extends e_admin_dispatcher
{

	protected $modes = array(	
	
		'main'	=> array(
			'controller' 	=> 'userlanguage_flags_menu_ui',
			'path' 			=> null,
			'ui' 			=> 'userlanguage_flags_menu_form_ui',
			'uipath' 		=> null
		),
		

	);	
	
	
	protected $adminMenu = array(
			
		'main/prefs' 		=> array('caption'=> LAN_PREFS, 'perm' => 'P'),	

		// 'main/custom'		=> array('caption'=> 'Custom Page', 'perm' => 'P')
	);

	protected $adminMenuAliases = array(
		'main/edit'	=> 'main/list'				
	);	
	
	protected $menuTitle = USLFM_P_1;
}
				
class userlanguage_flags_menu_ui extends e_admin_ui
{
			
		protected $pluginTitle		= USLFM_P_1;
		protected $pluginName		= 'userlanguage_flags_menu';
	//	protected $eventName		= 'userlanguage_flags_menu-'; // remove comment to enable event triggers in admin. 		
		protected $table			= '';
		protected $pid				= '';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
	//	protected $batchCopy		= true;		
	//	protected $sortField		= 'somefield_order';
	//	protected $orderStep		= 10;
	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= ' DESC';
	
		protected $fields 		= NULL;		
		
		protected $fieldpref = array();
		

	//	protected $preftabs        = array('General', 'Other' );
		protected $prefs = array(
			'lanflags_title_on'		=> array('title'=> USLFM_A_L5, 'tab'=>0, 'type'=>'boolean', 'data' => 'str', 'help'=>USLFM_A_L6),
			'lanflags_render'		=> array('title'=> USLFM_A_L10, 'tab'=>0, 'type'=>'boolean', 'data' => 'str', 'help'=>USLFM_A_L11),
			'lanflags_typ'		=> array(
        'title'=> USLFM_A_L7, 
        'tab'=>0, 
        'type' => 'method',
        'data' => 'str', 
      ),
			'lanflags_size'		=> array(
        'title'=> USLFM_A_L8, 
        'tab'=>0, 
        'type'=>'text', 
        'data' => 'int',
        'writeParms' => array(
          'maxlength' => '2'
        ), 
        'help'=>USLFM_A_L9
      ),
  		'lanflags_aling'        => array(
  			'title'      => USLFM_A_L13,
  			'type'       => 'dropdown',
  			'width'      => 'auto',
  			'readonly'   => false,
  			'inline'     => true,
  			'filter'     => true,
  			'thclass'    => 'center',
  			'class'      => 'center',
  			'writeParms' => array(
  				'optArray' => array(
  					'left' => USLFM_A_L14,
  					'center' => USLFM_A_L15,
  					'right' => USLFM_A_L16,            
  				),
  			),
  			'readParms'  => array(
  				'optArray' => array(
  					'left' => USLFM_A_L14,
  					'center' => USLFM_A_L15,
  					'right' => USLFM_A_L16, 
  				),
  			),
 
		),
		); 

	
		public function init()
		{
			// Set drop-down values (if any). 
	
		}

		
		// ------- Customize Create --------
		
		public function beforeCreate($new_data)
		{
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
		
			
	/*	
		// optional - a custom page.  
		public function customPage()
		{
			$text = 'Hello World!';
			return $text;
			
		}
	*/
			
}
				


class userlanguage_flags_menu_form_ui extends e_admin_form_ui
{
	// Custom Method/Function 
	function lanflags_typ($curVal,$mode)
	{
		$frm = e107::getForm();	
    $size = e107::pref('userlanguage_flags_menu', 'lanflags_size');	    
		switch($mode)
		{

    	case 'read': // List Page
				return $curVal;
			break;
			
			case 'write': // Edit Page
 			
      $text ="</div><div class='col-md-3 text-center'>
        <img src='".e_PLUGIN_ABS."userlanguage_flags_menu/flags/0/English.png' style='border: 0px;' width='".$size."' /><br />";
     
      $text .= $frm->radio('lanflags_typ', 0, ($curVal == 0));
      $text .="</div><div class='col-md-3 text-center'>
        <img src='".e_PLUGIN_ABS."userlanguage_flags_menu/flags/1/English.png' style='border: 0px;' width='".$size."' /><br />";
      
      $text .= $frm->radio('lanflags_typ', 1, ($curVal == 1));  
      $text .="</div><div class='col-md-3 text-center'>
        <img src='".e_PLUGIN_ABS."userlanguage_flags_menu/flags/2/English.png' style='border: 0px;' width='".$size."' /><br />";
          
      $text .= $frm->radio('lanflags_typ', 2, ($curVal == 2)); 
      $text .="</div><div class='col-md-3 text-center'>
        <img src='".e_PLUGIN_ABS."userlanguage_flags_menu/flags/3/English.png' style='border: 0px;' width='".$size."' /><br />";
      $text .= $frm->radio('lanflags_typ', 3, ($curVal == 3));
      $text .= '</div>';          
      return $text;  	
			break;
			
			case 'filter':
			case 'batch':
 
			break;
		}
	}
}		
		
		
new userlanguage_flags_menu_adminArea();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");
exit;

?>