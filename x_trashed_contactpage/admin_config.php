<?php

// Generated e107 Plugin Admin Area 

require_once('../../class2.php');
if (!getperms('P')) 
{
	e107::redirect('admin');
	exit;
}

// e107::lan('contactinfo',true);


class contactpage_adminArea extends e_admin_dispatcher
{

	protected $modes = array(	
	
		'main'	=> array(
			'controller' 	=> 'contactpage_ui',
			'path' 			=> null,
			'ui' 			=> 'contactpage_form_ui',
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
	
	protected $menuTitle = 'Contact Page';
}




				
class contactpage_ui extends e_admin_ui
{
			
		protected $pluginTitle		= 'Contact Page';
		protected $pluginName		= 'contactpage';
	//	protected $eventName		= 'contactpage-'; // remove comment to enable event triggers in admin. 		
		protected $table			= '';
		protected $pid				= '';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
		protected $batchExport     = true;
		protected $batchCopy		= true;
	//	protected $sortField		= 'somefield_order';
	//	protected $orderStep		= 10;
	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= ' DESC';
	
		protected $fields 		= NULL;		
		
		protected $fieldpref = array();
		

	//	protected $preftabs        = array('General', 'Other' );
		protected $prefs = array(
			'contact_name'		=> array('title'=> 'Company Name [contact_name]', 'tab'=>0, 'type'=>'text', 'data' => 'str', 
			'help'=>'', 'writeParms' => array('size'=>'block-level'), ),
			'contact_email'		=> array('title'=> 'Contact Email [contact_email]', 'tab'=>0, 'type'=>'text', 'data' => 'str', 
			'help'=>''),
			'contact_phone'		=> array('title'=> 'Contact Phone [contact_phone]', 'tab'=>0, 'type'=>'text', 'data' => 'str', 
			'help'=>''),
			'contact_mobile'		=> array('title'=> 'Contact Mobile [contact_mobile]', 'tab'=>0, 'type'=>'text', 'data' => 'str', 
			'help'=>''),
			'contact_fax'		=> array('title'=> 'Contact Fax [contact_fax]', 'tab'=>0, 'type'=>'text', 'data' => 'str', 
			'help'=>''),			
			'contact_address'		=> array('title'=> 'Contact Address [contact_address]', 'tab'=>0, 'type'=>'text', 'data' => 'str', 
			'help'=>'', 'writeParms' => array('size'=>'block-level'), ),

			'text_contact_info'		=> array('title'=> 'Text Contact Info [text_contact_info]', 'tab'=>0, 'type'=>'text', 'data' => 'str', 
			'help'=>''),
			'text_business_hours'		=> array('title'=> 'Business Hours [text_business_hours]', 'tab'=>0, 'type'=>'textarea', 'data' => 'str', 
			'help'=>''),
			'business_hours'		=> array('title'=> 'Business Hours [business_hours]', 'tab'=>0, 'type'=>'textarea', 'data' => 'str',
			'help'=>''),
			'text_contact_title'		=> array('title'=> 'Contact Title [text_contact_title]', 'tab'=>0, 'type'=>'text', 'data' => 'str', 
			'help'=>'', 'writeParms' => array('size'=>'block-level'), ),
		  'text_contact_subtitle'		=> array('title'=> 'Contact Subtitle [text_contact_subtitle]', 'tab'=>0, 'type'=>'textarea', 'data' => 'str', 
			'help'=>'', 'writeParms' => array('size'=>'block-level'), ),	
			'google_maps_embed'		=> array('title'=> 'Embed Google Map [google_maps_embed]', 'tab'=>0, 'type'=>'textarea', 'data' => 'str', 
			'help'=>''),	
			'googlemapsapikey'     => array('title' => 'Insert Google Maps API key', 'type'=>'text', 'writeParms'=>array('size'=>'block-level'),  'help'=>''),		
			'mapmarker'     => array('title' => 'Map Marker', 'type'=>'image', 'help'=>''),		
		); 

	
		public function init()
		{
			// Set drop-down values (if any). 
	
		}

		
		// ------- Customize Create --------
		
		public function beforeCreate($new_data,$old_data)
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
			$otherField  = $this->getController()->getFieldVar('other_field_name');
			return $text;
			
		}
	*/
			
}
				


class contactpage_form_ui extends e_admin_form_ui
{

}		
		

				
class mode extends e_admin_ui
{
			
		protected $pluginTitle		= 'Contact Page';
		protected $pluginName		= '';
	//	protected $eventName		= '-'; // remove comment to enable event triggers in admin. 		
		protected $table			= '';
		protected $pid				= '';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
		protected $batchExport     = true;
		protected $batchCopy		= true;
	//	protected $sortField		= 'somefield_order';
	//	protected $orderStep		= 10;
	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= ' DESC';
	
		protected $fields 		= NULL;		
		
		protected $fieldpref = array();
		
	
		public function init()
		{
			// Set drop-down values (if any). 
	
		}

		
		// ------- Customize Create --------
		
		public function beforeCreate($new_data,$old_data)
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
			$otherField  = $this->getController()->getFieldVar('other_field_name');
			return $text;
			
		}
	*/
			
}
				

 		
		
new contactpage_adminArea();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");
exit;

?>