<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     Copyright (C) 2001-2002 Steve Dunstan (jalist@e107.org)
|     Copyright (C) 2008-2010 e107 Inc (e107.org)
|
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $URL: http://www.dtilmeld.com $
|     
|     All Support entries should be asked directly to DTilmeld.com at our website: https://www.dtilmeld.com
|     All support questions will be answered within 24 hours.
|     
|     $Author: DTilmeld $
+----------------------------------------------------------------------------+
*/

require_once("../../class2.php");

$Method = $_SERVER['REQUEST_METHOD'];

if($_SERVER['REQUEST_METHOD']==='POST') {
  define('POSTURL', $_POST['RequestURL']);

  if(isset($_POST['PublicPage']) && $_POST['PublicPage'] == 1) {
	if($sql->db_Select("dte_events", "*", "LocalEventID=".$_POST['LocalEventID']))
	{
		$row = $sql->db_Fetch();
		extract($row);
	}

  $HeaderSource['api_key'] = $api_key;  
  $HeaderSource['mdkey'] = $md5key;
  $HeaderSource['DTEventID'] = $DTEventID;

  if(isset($_POST)) {
    foreach ($_POST as $key=>$value) {
      $HeaderSource[$key] = $value;
    }  
  }
    
  foreach($HeaderSource as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
  } else { 
    foreach ($_POST as $key=>$value) {
      $HeaderSource[$key] = $value;
    }
    foreach($HeaderSource as $key=>$value) { $fields_string .= $key.'='.$value.'&amp;'; }
  }

  rtrim($fields_string,'&amp;');
  
  //open connection
  $ch = curl_init();
  
  //set the url, number of POST vars, POST data
  curl_setopt($ch,CURLOPT_URL,POSTURL);
  curl_setopt($ch,CURLOPT_POST,count($_POST));
  curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
  
  //execute post
  $result = curl_exec($ch);
  
  //close connection
  curl_close($ch);
} else die('Error!');
 
exit;
?>