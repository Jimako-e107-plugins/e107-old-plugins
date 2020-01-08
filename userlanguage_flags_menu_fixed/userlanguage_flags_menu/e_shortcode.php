<?php
/*
* Copyright (c) e107 Inc e107.org, Licensed under GNU GPL (http://www.gnu.org/licenses/gpl.txt)
* $Id: e_shortcode.php 12438 2011-12-05 15:12:56Z secretr $
*
* Featurebox shortcode batch class - shortcodes available site-wide. ie. equivalent to multiple .sc files.
* For using in theme. If you need to change markup, just override this sc in your theme_shortcodes.php
*/

if (!defined('e107_INIT')) { exit; }


class userlanguage_flags_menu_shortcodes  extends e_shortcode
{
		
	public $var;
  	
	/**
	 * Store  plugin preferences.
	 *
	 * @var array
	 */
	private $plugPrefs    = array();
  private $plugTemplate = array();
	/**
	 * Constructor.
	 */
	function __construct()
	{
		parent::__construct();
		// Get plugin preferences.
		$this->plugPrefs = e107::getPlugConfig('userlanguage_flags_menu')->getPref();
		$this->plugTemplates = e107::getTemplate('userlanguage_flags_menu', 'ulflags');
	}

	function sc_ulf_action($parm='') {
		$action = (e_QUERY && !$_GET['elan']) ? e_SELF."?".e_QUERY : e_SELF;
		return  $action;
	}

	function sc_ulf_langval($parm='') {
		return  $this->var['langval'];
	}

	function sc_ulf_flagsize($parm='') {
		return  $this->var['flagsize'];
	}

	function sc_ulf_flagtype($parm='') {
		return  $this->var['flagtype'];
	}
	
	function sc_ulf_langitem($parm='') {
		$parms 		= eHelper::scParams($parm);
		$sc = e107::getScBatch('userlanguage_flags_menu'); 
		
		$flagsize 	= vartrue($parms['flagsize']) ? $parms['flagsize'] : $this->plugPrefs['lanflags_size'];
		$flagtype 	= vartrue($parms['flagtype']) ? $parms['flagtype'] : $this->plugPrefs['lanflags_typ'];
		
		require_once(e_HANDLER."file_class.php");
		$fl = new e_file;   
		$languageList = explode(',', e_LANLIST);
		//$lanlist = (e107::getPref()['multilanguage']>0?$languageList:array());
		$lanlist = $fl->get_dirs(e_LANGUAGEDIR);
		sort($lanlist);  
		foreach($lanlist as $langval)	{
			$sc->setVars(array(
			'langval' => $langval,
			'flagsize' => $flagsize,
			'flagtype' => $flagtype,      
			));      
		$text   .= e107::getParser()->parseTemplate($this->plugTemplates['default']['item'], false, $sc);
		
		} 
		return $text;    
		}

	function sc_ulflags($parm='')
	{
		$parms 		= eHelper::scParams($parm); 
		$template 		  = varset($parms['template'],'default');
		$languageList = explode(',', e_LANLIST);
		sort($languageList);
		$sc = e107::getScBatch('userlanguage_flags_menu');    
		$text1   = e107::getParser()->parseTemplate($this->plugTemplates[$template ]['start'], false, $sc);
		$text2   = e107::getParser()->parseTemplate($this->plugTemplates[$template ]['body'], false, $sc);
		$text3   = e107::getParser()->parseTemplate($this->plugTemplates[$template ]['end'], false, $sc); 
		return $text1.$text2.$text3;
	}

	function sc_ulflags_old($parm='')
	{
		$pref = e107::pref('userlanguage_flags_menu');		
		if($pref['lanflags_title'] ==''){
		}    
		if(!$pref['user_lan_use']){
			$languageList = explode(',', e_LANLIST);   
			//$lanlist = (e107::getPref()['multilanguage']>0?$languageList:array());   /* rica-carv */
      $fl = new e_file;   
      $lanlist = $fl->get_dirs(e_LANGUAGEDIR);
			sort($lanlist);        
		  $action = e_REQUEST_URI;
			$text = "<div style='text-align:".$pref['lanflags_aling']."'>\n";
			if($pref['lanflags_render'] == '1'){
					$text .= "<form method='post' action='".$action."'><div class='lan_flag'><select name='sitelanguage' class='tbox' >";
				foreach($lanlist as $langval){
					unset($selected);
					if($langval == USERLAN || ($langval == $pref['sitelanguage'] && USERLAN == "")){
						$selected = "selected='selected'";}
					$text .= "<option value='".$langval."' $selected>".$langval."</option>\n ";
				}
				$text .= "</select>";
				$text .= "<br /><br /><input class='button' type='submit' name='setlanguage' value='".USLFM_P_5."' /></div></form>";
			}else{
				foreach($lanlist as $langval)
				{
				$text .= "<form method='post' action='".$action."' style='display:inline;' class='lan_flag'><p style='display:inline;'>
				<input type='hidden' name='setlanguage' value='".USLFM_P_5."' />
				<input type='hidden' name='sitelanguage' value='".$langval."' />
				<input type='image' style='display:inline' src='".e_PLUGIN_ABS."userlanguage_flags_menu/flags/".$pref['lanflags_typ']."/".$langval.".png' alt='".$langval."' title='".$langval."' width='".$pref['lanflags_size']."' /> </p>
				</form>\n";
				}
			}
			$text .= "</div>";
			return $text;
		} 
	}	 
}

?>