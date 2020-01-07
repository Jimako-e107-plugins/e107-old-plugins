<?php
/*
* Copyright (c) e107 Inc e107.org, Licensed under GNU GPL (http://www.gnu.org/licenses/gpl.txt)
* $Id: e_shortcode.php 12438 2011-12-05 15:12:56Z secretr $
*
* Tag shortcode - shortcodes available site-wide. ie. equivalent to multiple .sc files.
*/

if(!defined('e107_INIT'))
{
	exit;
}

class tagcloud_shortcodes extends e_shortcode
{
 
	function sc_tags($parm = '')
	{
 
    require_once('tags_sc.php');
    return $text; 
	}
	
	function sc_tagcloud($parm = '')
	{

    require_once('tagcloud_sc.php');
    return $text;
	}
}