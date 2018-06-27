<?php
/*
 * e107 website system
 *
 * Copyright (C) 2001-2008 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Javascript Helper
 *
 * $Source: /cvsroot/e107/e107_0.8/e107_handlers/js_helper.php,v $
 * $Revision: 1.6 $
 * $Date: 2009/01/18 19:02:07 $
 * $Author: secretr $
 *
*/

if (!defined('e107_INIT')) { exit; }

//PHP < 5.2 compatibility
if (!function_exists('json_encode'))
{
    require_once(CLW_COMPAT_PATH.'json_compat_handler.php');
    function json_encode($array)
    {
        $json = new Services_JSON();
        return $json->encode($array);
    }

    function json_decode($json_obj)
    {
        $json = new Services_JSON();
        return $json->decode($json_obj);
    }
}

class e_jshelper
{
    /**
     * Respons actions array
     *
     * @var array
     */
    var $_response_actions = array();

    /**
     * Add response action & action instructions
     * 'action' equals to e107Ajax JS method (see JS API)
     *
     * @param string $action
     * @param array $data_array item data for the action
     * @return object e_jshelper
     */
    function addResponseAction($action, $data_array)
    {
        if(!isset($this->_response_actions[$action]))
        {
            $this->_response_actions[$action] = array();
        }
        $this->_response_actions[$action] = array_merge($this->_response_actions[$action], $data_array);

        return $this;
    }

    /**
     * Attach response Items array to an action
     * Example: addResponseItem('element-invoke-by-id', 'show', array('category-clear','update-category'));
     * will add  array('category-clear','update-category') to ['element-invoke-by-id']['show'] stack
     *
     * @param string $action
     * @param array $data_array item data for the action
     * @return object e_jshelper
     */
    function addResponseItem($action, $subaction, $data)
    {
        if(!isset($this->_response_actions[$action]))
        {
            $this->_response_actions[$action] = array();
        }
        if(!isset($this->_response_actions[$action][$subaction]))
        {
            $this->_response_actions[$action][$subaction] = array();
        }

        if(is_array($data))
        {
        	$this->_response_actions[$action][$subaction] = array_merge($this->_response_actions[$action][$subaction], $data);
        }
        else
        {
        	$this->_response_actions[$action][$subaction][] = $data;
        }


        return $this;
    }

    /**
     * Response array getter
     *
     * @param bool $reset clear current response actions
     * @return array response actions
     */
    function getResponseActions($reset = false) {
        if($reset)
        {
            $ret = $this->_response_actions;
            $this->_reset();
            return $ret;
        }
        return $this->_response_actions;
    }

    /**
     * Buld XML response parsed by the JS API
     * Quick & dirty, this will be extended to
     * e107 web service standard (communication protocol).
     *
     * @return string XML response
     */
    function buildXMLResponse()
    {
        $action_array = $this->getResponseActions(true);
        $ret = '<?xml version="1.0"  encoding="'.CHARSET.'" ?>';
        $ret .= "\n<e107response>\n";
        foreach ($action_array as $action => $field_array)
        {
	        $ret .= "\t<e107action name='{$action}'>\n";
            foreach ($field_array as $field => $value)
	        {
	            //associative arrays only - no numeric keys!
	            //to speed this up use $sql->db_Fetch(MYSQL_ASSOC);
	            //when passing large data from the DB
	            if (is_numeric($field) || empty($field)) continue;

	            switch (gettype($value)) {
	            	case 'array':
	            		foreach ($value as $v)
	            		{
	            			if(is_string($v)) { $v = "<![CDATA[{$v}]]>"; }
	            			$ret .= "\t\t<item type='".gettype($v)."' name='{$field}'>{$v}</item>\n";;
	            		}
	            	break;

	            	case 'string':
	            		$value = "<![CDATA[{$value}]]>";
	            		$ret .= "\t\t<item type='".gettype($value)."' name='{$field}'>{$value}</item>\n";
	            	break;

	            	case 'boolean':
	            	case 'numeric':
	            		$ret .= "\t\t<item type='".gettype($value)."' name='{$field}'>{$value}</item>\n";
	            	break;
	            }
	        }
	        $ret .= "\t</e107action>\n";
        }
        $ret .= '</e107response>';
        return $ret;
    }

    /**
     * Convert (optional) and send array as XML response string
     *
     * @param string $action optional
     * @param array $data_array optional
     */
    function sendXMLResponse($action = '', $data_array = array())
    {
        header('Content-type: application/xml; charset='.CHARSET, true);
        if($action)
    	{
    	    $this->addResponseAction($action, $data_array);
    	}

    	echo $this->buildXmlResponse();
    }

    /**
     * Build JSON response string
     *
     * @return string JSON response
     */
    function buildJSONResponse()
    {
        return "/*-secure-\n".json_encode($this->getResponseActions(true))."\n*/";
    }

    /**
     * Convert (optional) and send array as JSON response string
     *
     * @param string $action optional
     * @param array $data_array optional
     */
    function sendJSONResponse($action = '', $data_array = array())
    {
    	header('Content-type: application/json; charset='.CHARSET, true);
        if($action)
    	{
    	    $this->addResponseAction($action, $data_array);
    	}
    	echo $this->buildJSONResponse();
    }

    /**
     * Send Server Response
     * Sends the response based on the system
     * prefered response type (could be system preference in the future)
     * It also sends proper respnse headers and cleans up the output buffer (opened previously 
     * in class2.php)
     *
     * @param string $action optional Action
     * @param array $data_array optional action array
     * @return void
     */
    function sendResponse($response_type='XML', $data_array = array(), $action = '')
    {
    	$prefered_response_type = $response_type ? $response_type : 'XML'; //TODO - pref?
    	$method = "send{$prefered_response_type}Response";
    	if(!method_exists($this, $method))
    	{
			$method = 'sendTextResponse';
    	}
    	
    	if($prefered_response_type != 'Text')
   			$this->$method($action, $data_array);
   		else 
   			$this->$method($data_array);
	    $page = ob_get_clean();
		$etag = md5($page);
		header("Cache-Control: must-revalidate");
		header("ETag: {$etag}");
		header("Content-Length: ".strlen($page), true);
		echo $page;
    	exit;
    }

    /**
     * Reset response action array to prevent duplicates
     *
     * @access private
     * @return void
     */
    function _reset()
    {
        $this->_response_actions = array();
    }

    /**
     * Send array as JSON response string
     *
     * @param string $action optional
     * @param array $data_array optional
     */
    function sendTextResponse($data_text)
    {
    	header('Content-type: text/html; charset='.CHARSET, true);
    	echo $data_text;
    }

    /**
     * Send error to the JS Ajax.response object
     *
     * @param integer $errcode
     * @param string $errmessage
     * @param string $errextended
     * @param bool $exit
     * @access public static
     */
    function sendAjaxError($errcode, $errmessage, $errextended = '', $exit = true)
    {
        header('Content-type: text/html; charset='.CHARSET, true);
        header("HTTP/1.0 {$errcode} {$errmessage}", true);
        header("e107ErrorMessage: {$errmessage}", true);
        header("e107ErrorCode: {$errcode}", true);

        //Safari expects some kind of output, even empty
        echo ($errextended ? $errextended : ' ');

        if($exit) exit;
    }

    /**
     * Clean string to be used as JS string
     * Should be used for passing strings to e107 JS API - e.g Languages,Templates etc.
     *
     * @param string $string
     * @return string
     * @access public static
     */
    function toString($string)
    {
        return "'".str_replace(array("\\", "'"), array("", "\\'"), $string)."'";
    }
}
?>