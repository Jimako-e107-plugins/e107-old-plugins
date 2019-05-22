<?php
/**
 * CLab Starter Classes Pack v.1.0.0
 * 
 * Copyright (C) 2006-2009 Corllete ltd (clabteam.com)
 * Support and updates at http://www.free-source.net/
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 * 
 * $Id: CLabClasses.php 1500 2011-03-01 12:00:00Z Berckoff $
 */

class CLabClass
{
	protected	$_data		= array();
	protected	$_caller	= null;
	
	public function __construct()	{ }
	
	/**
	 * Retrieves data info, or default if no data found
	 * If $key empty - returns all params as array
	 *
	 * @param	string	$key
	 * @param	mixed	$default
	 * @return	mixed
	 */
	public function getData($key='', $default='')
	{
		if (!isset($this->_data[$key])) $key = ($key && $this->_caller && $this->_caller.'_' != substr($key, 0, strlen($this->_caller)+1) ? $this->_caller.'_' : '').$key;
		
		return ($key ? (isset($this->_data[$key]) ? $this->_data[$key] : $default) : $this->_data);
	}
	
	/**
	 * Sets data pair $key->$value
	 * 
	 * If $key and $value given, $key=$value pair will be set.
	 * If $key and empty $value, $key='' pair will be set.
	 * If $key and null $value given, $key will be unset
	 * If empty $key with array $value given, all data set will be changed with the given array
	 * 
	 * @param	string	$key
	 * @param	str|arr	$value 
	 * @return	CLabClass
	 */
	public function setData($key='', $value='')
	{
		if ($key && $value)					$this->_data[$key]	= $value;
		if ($key && '' == $value)			$this->_data[$key]	= '';
		if ($key && null == $value)			unset($this->_data[$key]);
		if ('' == $key && is_array($value))	$this->_data = $value;
		
		return $this;
	}
	
	/**
	 * Retrieves DB params data info, or default if no data found
	 * If $key empty - returns all params as array
	 *
	 * @param	string	$key
	 * @param	mixed	$default
	 * @return	mixed
	 */
	public function getParam($key='', $default='')
	{
		return ($key ? (isset($this->_params[$key]) ? $this->_params[$key] : $default) : $this->_params);
	}
	
	/**
	 * Checks whether there are any DB params set
	 *
	 * @return	bool
	 */
	public function hasParams()
	{
		return (bool) $this->_params;
	}
	
	/**
	 * Sets params for DB queries
	 * 
	 * Param setting options same as setData()
	 *
	 * @param	string	$key
	 * @param	mixed	$value
	 * @return	CLabClass
	 */
	public function setParam($key='', $value='')
	{
		if ($key && $value)					$this->_params[$key]	= $value;
		if ($key && '' == $value)			$this->_params[$key]	= '';
		if ($key && null == $value)			unset($this->_params[$key]);
		if ('' == $key && is_array($value))	$this->_params = $value;
		
		return $this;
	}
	
	/**
	 * Loads template file and returns the templates as a variable
	 *
	 * @param	string	$tmpl	File name
	 * @param	string	$key	If you need exact part of the template
	 * @return	mixed
	 */
	public static function getTemplate($tmpl, $key='')
	{
		if (file_exists(THEME."{$tmpl}_template.php"))
		{
			include_once THEME."{$tmpl}_template.php";
		}
		else
		{
			include_once e_PLUGIN."top_downloads_menu/templates/{$tmpl}_template.php";
		}
		
		$tmpl = strtoupper($tmpl).'_TEMPLATE';
		
		return ($key ? varsettrue($$tmpl[$key]) : varsettrue($$tmpl, array()));
	}
	
	
	public static function parseTemplate($text, $model=null)
	{
		if (!$model) return $text;
		
		preg_match_all('#{[\w|=&:]+}#', $text, $matches);
		
		$matches = $matches[0];
		
		foreach ($matches as $match)
		{
			$parm = $mode = '';
			
			list($sc, $parm) = explode('=', str_replace(array('{', '}'), '', $match), 2);
			
			if (strpos($sc, '|'))			list($sc, $mode) = explode('|', $sc, 2);
			
			$sc = 'sc_'.strtolower($sc);
			
			if (method_exists($model, $sc))	$text = preg_replace("#$match#", $model->$sc($parm, $mode), $text);
			else							$text = preg_replace("#$match#", '', $text);
		}
		
		return $text;
	}
}

class CLabModel extends CLabClass
{
	protected	$_p_key;
	protected	$_table;
	
	public function __construct($data=array())
	{
		if ($data)	$this->setData('', $data);
		
		parent::__construct();
	}
	
	/**
	 * Default load method
	 * 
	 * To pass other than integer id in he query, use setParam('id', '...')
	 * To pass DB fields other than '*' in the query, use setParam('fields', '...')
	 *
	 * @param	integer	$id
	 * @return	CLabTree
	 */
	public function load($id='')
	{
		$id	= intval($id);
		
		if (!$id)	$id = $this->getParam($id);
		if (!$id || null == ($this->getIDField() || $this->getTable()))	return $this;
		
		$sql = new db();
		
		if ($this->hasParams())
		{
			// TO DO: When needed
		}
		else
		{
			if ($sql->db_Select($this->getTable(), $this->getParam('fields', '*'), "{$this->getIDField()} = '$id'"))
			{
				$this->setData('', $sql->db_Fetch(MYSQL_ASSOC));
			}
		}
		
		return $this;
	}
	
	public function getIDField()
	{
		return $this->_p_key;
	}
	
	public function getTable()
	{
		return $this->_table;
	}
	
}

class CLabTree extends CLabClass
{
	protected	$_model	= null;
	
	public function __construct()
	{
		if (null == $this->_model)	$this->_model = 'CLabModel';
		
		parent::__construct();
	}
	
	/**
	 * Default load method
	 *
	 * @return	CLabTree
	 */
	public function loadTree()
	{
		$sql = new db();
		
		if ($this->hasParams())
		{
			if ($this->getParam('query'))
			{
				if ($sql->db_Select_gen($this->getParam('query')))
				{
					while ($row = $sql->db_Fetch(MYSQL_ASSOC))
					{
						$model = new $this->_model($row);
					
						$this->setNode($row[$model->getIDField()], $model);
					}
				}
			}
			else
			{
				// TO DO: When needed
			}
		}
		else
		{
			$model = new $this->_model();
			
			if ($sql->db_Select($model->getTable(), '*'))
			{
				while ($row = $sql->db_Fetch(MYSQL_ASSOC))
				{
					$model = new $this->_model($row);
					
					$this->setNode($row[$model->getIDField()], $model);
				}
			}
		}
		
		return $this;
	}
	
	/**
	 * Returns tree node
	 *
	 * @param	string	$id		Node's id
	 * @return	CLabModel
	 */
	public function getNode($id)
	{
		return $this->_data['_tree'][$id];
	}
	
	/**
	 * Sets tree's node
	 *
	 * @param	string		$id
	 * @param	CLabModel	$model
	 * @return	CLabTree
	 */
	public function setNode($id, $model)
	{
		$this->_data['_tree'][$id] = $model;
		
		return $this;
	}
	
	/**
	 * Check if tree node exists
	 *
	 * @param	string	$id
	 * @return	bool
	 */
	public function hasNode($id)
	{
		return (bool) isset($this->_data['_tree'][$id]);
	}
	
	/**
	 * Returns all node IDs
	 *
	 * @return	array
	 */
	public function getNodeIDs()
	{
		return array_keys($this->_data['_tree']);
	}
	
	/**
	 * Returns all tree nodes as an array
	 *
	 * @return	array
	 */
	public function getTree()
	{
		return $this->_data['_tree'];
	}
	
	/**
	 * Check if there is any tree node
	 *
	 * @return	bool
	 */
	public function hasTree()
	{
		return ((bool) isset($this->_data['_tree']) && !empty($this->_data['_tree']));
	}
	
}