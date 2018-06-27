<?php
/*
 * Corllete Lab Widgets
 *
 * Copyright (C) 2006-2009 Corllete ltd (clabteam.com)
 * Support and updates at http://www.free-source.net/
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * CL Widgets - Preferences Validation Helper
 *
 * $Id: widgets_admin_pref_helper.php 634 2009-07-15 08:00:02Z secretr $
*/

if (!defined('e107_INIT')) { exit; }

require_once(CLW_COMPAT_PATH.'message_handler.php');
require_once(CLW_HANDLER_PATH.'widgets_utils.php');

class clw_admin_pref_helper 
{
	/**
	 * @var clw_widget_abstract
	 */
	var $widget;
	
	/**
	 * @var array
	 */
	var $widget_data;
	
	/**
	 * @var array
	 */
	var $new_perfs = array();
	
	function clw_admin_pref_helper($widget, $new_prefs = array())
	{
		$this->widget = $widget;
		$this->setNewPrefs($new_prefs);
		$this->widget_data = clw_utils_get_wdata($this->widget->getName());
	}
	
	function validate($session_errors = false)
	{
		global $tp;
		
		$emessage = eMessage::getInstance();
		if(empty($this->widget_data['settings']))
		{
			$emessage->add('Unknown error! Operation failed!', E_MESSAGE_ERROR, $session_errors);
			return false;
		}
		
		$error = false;

		foreach (array_keys($this->widget_data['settings']) as $prefname) 
		{
			$newval = isset($this->new_perfs[$prefname]) ? $_POST[$prefname] : '';
			if($this->isRequiredPref($prefname) && !$this->validatePref($prefname, $newval))
			{
				$error = true;
				$emessage->add(sprintf(CLW_LANPREFV_1, defset($this->requiredPrefName($prefname), $this->requiredPrefName($prefname)), defset($this->requiredPrefHelp($prefname), $this->requiredPrefHelp($prefname))), E_MESSAGE_ERROR, $session_errors);
				continue;
			}
			
			$this->widget->addPref($prefname, $tp->toDB($newval));
		}

		if(!$error)
		{
			return true;
		}
		$emessage->add(CLW_LANPREFV_3, E_MESSAGE_ERROR, $session_errors);
		return false;
	}
	
	function restoreFactorySettings($add_message = true, $session = false)
	{
		if(!empty($this->widget_data['settings']))
		{
			$this->widget->setPrefs($this->widget_data['settings']);
			if($add_message)
			{
				$emessage = eMessage::getInstance();
				$emessage->add(CLW_LANPREFV_4, E_MESSAGE_SUCCESS, $session);
			}
			
			$this->save(false);
			return true;
		}
		if($add_message)
		{
			$emessage = eMessage::getInstance();
			$emessage->add('Unknown error! Operation failed!', E_MESSAGE_ERROR, $session);
		}
		return false;
	}
	
	function save($add_message = true, $session_success = false)
	{
		if($add_message)
		{
			$emessage = eMessage::getInstance();
			$emessage->add(CLW_LANPREFV_2, E_MESSAGE_SUCCESS, $session_success);
		}
		$this->widget->savePrefs($this->widget->getPrefs());
	}
	
	function setNewPrefs($new_prefs)
	{
		$this->new_perfs = $new_prefs;
	}
	
	function isRequiredPref($name)
	{
		return isset($this->widget_data['settings_required'][$name]);
	}
	
	function requiredPrefHelp($name)
	{
		return varset($this->widget_data['settings_required'][$name][3], 'Invalid value');
	}
	
	function requiredPrefName($name)
	{
		return varset($this->widget_data['settings_required'][$name][2], implode(' ', array_map('ucfirst', explode('-', str_replace('_', '-', $name)))));
	}
	
	function validatePref($name, $newval)
	{
		
		$type = $this->widget_data['settings_required'][$name][0];
		$cond = $this->widget_data['settings_required'][$name][1];
		switch ($type) 
		{
			case 'required':
				return !empty($newval);
			break;
			
			case 'regex':
				return preg_match($cond, $newval);
			break;
			
			case 'callback':
				return call_user_func($cond, $newval);
			break;
		
			case 'int':
			case 'integer':
				if(!preg_match('/[0-9]/', $newval)) return false;
				$tmp = explode('-', $cond);
				if(is_numeric($tmp[0]) && (integer) $tmp[0] > (integer) $newval) return false;
				if(is_numeric(varset($tmp[1])) && (integer) $tmp[1] < (integer) $newval) return false;
				return true;
			break;

			case 'float':
				if(!is_numeric($newval)) return false;
				$tmp = explode('-', $cond); 
				if(is_numeric($tmp[0]) && (float) $tmp[0] > (float) $newval) return false;
				if(is_numeric(varset($tmp[1])) && (float) $tmp[1] < (float) $newval) return false;
				return true;
			break;
			
			case 'str':
			case 'string':
				//TODO - utf8 aware
				$tmp = explode('-', $cond);
				if(is_numeric($tmp[0]) && (integer) $tmp[0] > strlen($newval)) return false;
				if(is_numeric(varset($tmp[1])) && (integer) $tmp[1] < strlen($newval)) return false;
				return true;
			break;
			
			case 'options':
				$tmp = explode(',', $cond);
				foreach ($cond as $opt) 
				{
					if((string) trim($opt) === (string) trim($newval))
					{
						return true;
					}
				}
				return false;
				
			break;

			
			default:
				return false;
			break;
		}
	}
	
	function getPostedPref($name, $default = null)
	{
		global $tp;
		if(null === $default)
		{
			$default = $this->widget->getPref($name);
		}
		return isset($_POST[$name]) ? $tp->post_toForm($_POST[$name]) : $default;
	}
}
?>