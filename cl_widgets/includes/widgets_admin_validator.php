<?php
/*
 * Corllete Lab Widgets
 *
 * Copyright (C) 2006-2009 Corllete ltd (clabteam.com)
 * Support and updates at http://www.free-source.net/
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * CL Widgets - Validator
 *
 * $Id: widgets_admin_validator.php 666 2009-08-11 13:25:12Z secretr $
*/

if (!defined('e107_INIT')) { exit; }

require_once(CLW_COMPAT_PATH.'message_handler.php');

/**
 * Simple validator handler
 * @FIXME - make the required changes to pref validator
 *
 */
class clw_admin_validator 
{
	/**
	 * @var array
	 */
	var $data = array();
	
	/**
	 * @var array
	 */
	var $validation_riles;
	
	/**
	 * @var array
	 */
	var $new_data = array();
	
	function clw_admin_validator($default_data, $validation_riles = array(), $new_data = array())
	{
		$this->data = $default_data;
		$this->validation_riles = $validation_riles;
		$this->new_data = $new_data;
	}
	
	function setData($key = null, $value)
	{
		if(null === $key && is_array($value)) $this->data = $value;
		else $this->data[$key] = $value;
		return $this;
	}
	
	function getData($key, $default = null)
	{
		if(null === $key) return $this->data;
		return (isset($this->data[$key]) ? $this->data[$key] : $default);
	}
	
	function validate($session_errors = false)
	{
		global $tp;
		
		$emessage = eMessage::getInstance();
		if(empty($this->data))
		{
			$emessage->add('Unknown error! Operation failed!', E_MESSAGE_ERROR, $session_errors);
			return false;
		}
		
		$error = false;

		foreach (array_keys($this->data) as $prefname) 
		{
			$newval = isset($this->new_data[$prefname]) ? $this->new_data[$prefname] : '';
			if($this->isRequired($prefname) && !$this->validateData($prefname, $newval))
			{
				$error = true;
				$emessage->add(sprintf(CLW_LANPREFV_1, defset($this->requiredName($prefname), $this->requiredName($prefname)), defset($this->requiredHelp($prefname), $this->requiredHelp($prefname))), E_MESSAGE_ERROR, $session_errors);
				continue;
			}
			
			$this->setData($prefname, $tp->toDB($newval));
		}

		if(!$error)
		{
			return true;
		}
		$emessage->add(CLW_LANPREFV_3, E_MESSAGE_ERROR, $session_errors);
		return false;
	}
	
	function setNewData($new_data)
	{
		$this->new_data = $new_data;
	}
	
	function isRequired($name)
	{
		return isset($this->validation_riles[$name]);
	}
	
	function requiredHelp($name, $inline = false)
	{
		$h = varset($this->validation_riles[$name][3]);
		$def = $inline ? '' : 'Invalid value';
		return $h ? defset($h, $def) : $def;
	}
	
	function requiredName($name)
	{
		return varset($this->validation_riles[$name][2], implode(' ', array_map('ucfirst', explode('-', str_replace('_', '-', $name)))));
	}
	
	function validateData($name, $newval)
	{
		
		$type = $this->validation_riles[$name][0];
		$cond = $this->validation_riles[$name][1];
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
	
	function getPostedData($name, $default = null)
	{
		global $tp;
		if(null === $default)
		{
			$default = varset($this->data[$name], null);
		}
		
		return isset($_POST[$name]) ? $tp->post_toForm($_POST[$name]) : $default;
	}
}
?>