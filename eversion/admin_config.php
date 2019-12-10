<?php

require_once('../../class2.php');
if (!getperms('P')) 
{
	e107::redirect('admin');
	exit;
}

e107::lan('eversion',true);   
 

class eversion_adminArea extends e_admin_dispatcher
{

	protected $modes = array(	
	
		'main'	=> array(
			'controller' 	=> 'eversion_ui',
			'path' 			=> null,
			'ui' 			=> 'eversion_form_ui',
			'uipath' 		=> null
		),
		

	);	
	
	
	protected $adminMenu = array(
 
	 'main/prefs'	=> array('caption'=> EVERSION_A21, 'perm' => 'P'), 
     'main/list'	=> array('caption'=> EVERSION_A22, 'perm' => 'P'),
	 'main/create'	=> array('caption'=> EVERSION_A24, 'perm' => 'P'),	 
	 'main/getall' 	=> array('caption'=> EVERSION_A25, 'perm' => 'P'),
	 'main/vupdate' => array('caption'=> EVERSION_A23, 'perm' => 'P'),	 

	);

	protected $adminMenuAliases = array(
		'main/edit'	=> 'main/list'				
	);	
	
	protected $menuTitle = EVERSION_A1;
}
				
class eversion_ui extends e_admin_ui
{
			
		protected $pluginTitle		= EVERSION_A1;
		protected $pluginName		= 'eversion';
		protected $table			= 'eversion';
		protected $pid				= 'eversion_id';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
		protected $listOrder		= 'eversion_id DESC';	
		protected $fields 		= array (  'checkboxes' =>   array ( 'title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => '1', 'class' => 'center', 'toggle' => 'e-multiselect',  ),
		  'eversion_id' =>   array ( 'title' => LAN_ID, 'data' => 'int', 'width' => '5%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'eversion_title' =>   array ( 'title' => EVERSION_A41, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 
			'readParms' => '', 'writeParms' => array ( 'size' =>  'block-level'   ), 'class' => 'left', 'thclass' => 'left',  ),		  
		  'eversion_name' =>   array ( 'title' => EVERSION_A40, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 
			'readParms' => '', 'writeParms' => array ( 'size' =>  'block-level'   ), 'class' => 'left', 'thclass' => 'left',  ),
		  'eversion_major' =>   array ( 'title' => EVERSION_A42, 'type' => 'number', 'data' => 'int', 'width' => 'auto', 'help' => '', 
			'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'eversion_minor' =>   array ( 'title' => EVERSION_A43, 'type' => 'number', 'data' => 'int', 'width' => 'auto', 'help' => '', 
			'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'eversion_beta' =>   array ( 'title' => EVERSION_A44, 'type' => 'number', 'data' => 'int', 'width' => 'auto', 'help' => '', 
			'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'eversion_date' =>   array ( 'title' => EVERSION_A45, 'type' => 'datestamp', 'data' => 'int', 'width' => 'auto', 'filter' => true, 'help' => '', 
			'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'eversion_author' =>   array ( 'title' => EVERSION_A46, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'help' => '', 
			'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'eversion_icon' =>   array ( 'title' => EVERSION_A67, 'type' => 'icon', 'data' => 'str', 'width' => 'auto', 'help' => '', 
			'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),		  
		  'eversion_revisions' =>   array ( 'title' => EVERSION_A47, 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 
			'readParms' => '', 'writeParms' => array ( 'size' =>  'block-level'   ), 'class' => 'left', 'thclass' => 'left',  ),
		  'eversion_comments' =>   array ( 'title' => EVERSION_A48, 'type' => 'textarea', 'data' => 'str', 'width' => '40%', 'help' => '', 
			'readParms' => '', 'writeParms' => array ( 'size' =>  'block-level'   ), 'class' => 'left', 'thclass' => 'left',  ),
		  'eversion_dlpath' =>   array ( 'title' => EVERSION_A49, 'type' => 'dropdown', 'data' => 'str', 'width' => 'auto', 'help' => '', 
			'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'eversion_support' =>   array ( 'title' => EVERSION_A59, 'type' => 'dropdown', 'data' => 'str', 'width' => 'auto', 'help' => '', 
			'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'eversion_bugtrack' =>   array ( 'title' => EVERSION_A60, 'type' => 'dropdown', 'data' => 'str', 'width' => 'auto', 'help' => '', 
			'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),		
		  'eversion_updated' =>   array ( 'title' => EVERSION_A79, 'type' => 'datestamp', 'data' => 'int', 'width' => 'auto', 'help' => '', 
			'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'options' =>   array ( 'title' => LAN_OPTIONS, 'type' => null, 'data' => null, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center last', 'forced' => '1',  ),
		);		
		
		protected $fieldpref = array('eversion_name', 'eversion_title', 'eversion_date', 'eversion_category');
		

		protected $prefs = array(
			'eversion_read'		=> array('title'=> EVERSION_A3, 'tab'=>0, 'type'=>'userclass', 'data' => 'str', 'help'=>''),
			'eversion_noplug'		=> array('title'=> EVERSION_A56, 'tab'=>0, 'type'=>'text', 'data' => 'str', 'help'=>''),
			'eversion_dformat'		=> array('title'=> EVERSION_A58, 'tab'=>0, 'type'=>'dropdown', 'data' => 'str', 'help'=>''),
			'eversion_usedownloads'		=> array('title'=> EVERSION_A61, 'tab'=>0, 'type'=>'boolean', 'data' => 'str', 'help'=>''),			
			'eversion_useforums'		=> array('title'=> EVERSION_A62, 'tab'=>0, 'type'=>'boolean', 'data' => 'str', 'help'=>''),	
			'eversion_usebugs'		=> array('title'=> EVERSION_A63, 'tab'=>0, 'type'=>'boolean', 'data' => 'str', 'help'=>''),					
		); 

	
		public function init()
		{
		$sql = e107::getDb();
 
		$this->eversion_dlpath[0] = EVERSION_A68;
		if($sql->select("download", "download_id,download_name", "order by download_name", "nowhere", false)) 
		{
			while ($row = $sql->fetch())
			{
				$this->eversion_dlpath[$row['download_id']] = $row['download_name'];
			}
		}
		$this->fields['eversion_dlpath']['writeParms'] = $this->eversion_dlpath;
		
 
		$this->eversion_support[0] = EVERSION_A69;
		if($sql->select("forum", "forum_id,forum_name", "order by forum_name", "nowhere", false))
		{
			while ($row = $sql->fetch())
			{
				$this->eversion_support[$row['forum_id']] = $row['forum_name'];
			}
		}
		$this->fields['eversion_support']['writeParms'] = $this->eversion_support;		
		
 
		$this->eversion_bugtrack[0] = EVERSION_A70;
		if($sql->select("bugtrack_apps", "bugtrack_app_id,bugtrack_app_name", "order by bugtrack_app_name", "nowhere", false))
		{
			while ($row = $sql->fetch())
			{
				$this->debtor[$row['bugtrack_app_id']] = $row['bugtrack_app_name'];
			}
		}
		$this->fields['eversion_bugtrack']['writeParms'] = $this->eversion_bugtrack;		
 
		$this->prefs['eversion_dformat']['writeParms']['optArray'] 	= array('d-m-Y','m-d-Y', 'Y-m-d');
		$this->prefs['eversion_dformat']['readParms']['optArray'] 	= array('d-m-Y','m-d-Y', 'Y-m-d');
		
		}

		
		// ------- Customize Create --------
		
		public function beforeCreate($new_data,$old_data)
		{
			return $new_data;
		}
	
		public function afterCreate($new_data, $old_data, $id)
		{
			$this->gen_file();
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
			$this->gen_file();	
		}
		
		public function onUpdateError($new_data, $old_data, $id)
		{
			// do something		
		}		
		
			
 	
		// optional - a custom page.
		public function oldconfigPage()
		{
		 $mainadmin = e_SELF.'/../admin_configold.php';
     header("location:".$mainadmin); exit;
		}	
				
		public function pluginPage()
		{
		 $mainadmin = e_SELF.'/../admin_plugin.php';
     header("location:".$mainadmin); exit;
		}		
		  
		public function getallPage()
		{
		 $mainadmin = e_SELF.'/../admin_getall.php';
     header("location:".$mainadmin); exit;
		}
 
		public function vupdatePage()
		{
		 $mainadmin = e_SELF.'/../admin_vupdate.php';
     header("location:".$mainadmin); exit;
			
		}			
		
		function gen_file()
		{
		    global $e107, $PLUGINS_DIRECTORY;
		    // Generate the file containing version info
		    $evrsn_db = new DB;
		    // $evrsn_array = array();
		    // Retrieve all plugins
		    $evrsn_db->db_Select("eversion", "*");
		    $xmlout = "<?xml version=\"1.0\" ?>
			<plugins>";
		    while ($evrsn_row = $evrsn_db->db_Fetch())
		    {
		        extract($evrsn_row);
		        // used for text version
		        $evrsn_array[] = array("plugin" => $eversion_name, "version" => $eversion_major . "." . $eversion_minor . "." . $eversion_beta, "date" => "111", "URL" => $e107->base_path . $PLUGINS_DIRECTORY . "eversion/eversion.php?0.view." . $eversion_id);
		        // used for xml version
		        $xmlout .= "<plugin>" . $eversion_name . " </plugin>";
		        $xmlout .= "<version>" . $eversion_major . "." . $eversion_minor . "." . $eversion_beta . "</version>";
		        $xmlout .= "<date>" . $eversion_updated . " </date>";
		        $xmlout .= "<author>" . $eversion_author . " </author>";
		        $xmlout .= "<title>" . $eversion_title . " </title>";
		        $xmlout .= "<URL>" . $e107->base_path . $PLUGINS_DIRECTORY . "eversion/eversion.php?0.view." . $eversion_id . "</URL>";
		        $xmlout .= "<dlpath>" . (empty($eversion_dlpath)?" ":$eversion_dlpath) . "</dlpath>";
		    } // while
		    $xmlout .= "</plugins>";
		    $evrsn_ser = serialize($evrsn_array);
		    $evrsn_fp = fopen("./xml/eversion.txt", "w");
		    fwrite($evrsn_fp, $evrsn_ser);
		    fclose($evrsn_fp);
		    $evrsn_fp = fopen("./xml/eversion.xml", "w");
		    fwrite($evrsn_fp, $xmlout);
		    fclose($evrsn_fp);
		}
}
				


class eversion_form_ui extends e_admin_form_ui
{

}		
		
		
new eversion_adminArea();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");
exit;

?>