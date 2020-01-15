<?php
/*
* Copyright (c) e107 Inc e107.org, Licensed under GNU GPL (http://www.gnu.org/licenses/gpl.txt)
* $Id: e_shortcode.php 12438 2011-12-05 15:12:56Z secretr $
*
* Global plugin shortcode batch class - shortcodes available site-wide. ie. equivalent to multiple .sc files.
*/

if(!defined('e107_INIT'))
{
	exit;
}

 
include_lan(e_PLUGIN.'pagestat/languages/'.e_LANGUAGE.'.php');

/* it's global shortcode, if you need different markup, just override it in theme shortcodes */
/* removed <br>  from $PSTS, if you need it, add it in f.e. news template */

class pagestat_shortcodes extends e_shortcode
{
  /* this function count views, use it only in detail / extend news */
	function sc_pagestat($parm = '')
	{ 
   $pref = e107::pref('pagestat');
   require_once(e_PLUGIN.'pagestat/pagestat_class.php');
   $pagestat = new e107pagestat;
	 			    
   $PSTS =  $pagestat->page_stat() ; 
   return $PSTS;
	}
	/* this function is just for listing only, not count views f.e. in news list*/
  function sc_viewpagestat($parm = '')
	{ 
	  require_once(e_PLUGIN.'pagestat/pagestat_class.php');
		$pagestat = new e107pagestat;					
		$PSTS = $pagestat->viewpage_stat();		     
		return $PSTS;
	}
	
	/* this function is just for listing only, not count views f.e. in news list*/
  function sc_viewpagetitle($parm = '')
	{ 
		$pref = e107::pref('pagestat');
		return $pref['pst_title'];
	}	
}