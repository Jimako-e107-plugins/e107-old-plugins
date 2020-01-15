<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2009 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 *	Tagcloud plugin - shortcodes
 *
 * $URL$
 * $Id$
 */
 
/**
 * Class plugin_tagcloud_tagcloud_shortcodes
 * Local shortcodes
 */
 


 
 
class plugin_tagcloud_tagcloud_shortcodes extends e_shortcode
{
 
		/* SC_BEGIN CURRENTTAG
		global $CURRENTTAG;
			$ret = $CURRENTTAG;
		return $ret;
		SC_END */
			
		function sc_currenttag($parm='') {
		global $CURRENTTAG;
		 $ret = $CURRENTTAG;
		return $ret;
		}
		
		/*	SC_BEGIN TITLE
		global $TITLE;
		 $ret = $TITLE;
		return $ret;
		SC_END
		*/ 
		function sc_title($parm='') {
		global $TITLE;
		 $ret = $TITLE;
		return $ret;
		}
		
		/*	SC_BEGIN PRETITLE
		global $PRETITLE;
		 $ret = $PRETITLE;
		return $ret;
		SC_END	*/
		
		function sc_pretitle($parm='') {
		global $PRETITLE;
		 $ret = $PRETITLE;
		return $ret;
		}
		
		/*	SC_BEGIN PRESUMMARY
		global $PRESUMMARY;
		 $ret = $PRESUMMARY;
		return $ret;
		SC_END		*/ 
		function sc_presummary($parm='') {
		global $PRESUMMARY;
		 $ret = $PRESUMMARY;
		return $ret;
		}
		
		/*SC_BEGIN SUMMARY
		global $SUMMARY;
		 $ret = $SUMMARY;
		return $ret;
		SC_END */
		function sc_summary($parm='') {
		global $SUMMARY;
		 $ret = $SUMMARY;
		return $ret;
		}
		
		/* SC_BEGIN OTHERTAGS
		global $TAGS;
		 $ret = $TAGS;
		return $ret;
		SC_END  */
		function sc_othertags($parm='') {
		global $TAGS;
		 $ret = $TAGS;
		return $ret;
		}
		
		/*SC_BEGIN DETAIL
		global $DETAIL;
		 $ret = $DETAIL;
		return $ret;
		SC_END */
		function sc_detail($parm='') {
		global $DETAIL;
		 $ret = $DETAIL;
		return $ret;
		}
		

		
		/* {TAGSIZE} */
		function sc_tagsize($parm='') {      
	   return  $this->var['size'];
	  }

	  /* {TAGKEY} */	  
		function sc_tagkey($parm='') {
	   return  $this->var['key'];
	  }
	  
	  /* {TAGTITLE} */
		function sc_tagtitle($parm='') {   
		 if($this->var['value']) return 'title="'.$this->var['value'].' things tagged with '.$this->var['key'].'"';
	   return  '';
	  }  
	  
	  /* {TAGCOLOR} */
		function sc_tagcolor($parm='') {
		 if($this->var['color']) return 'color:#'.$this->var['color'].';';
	   return  '';
	  }  
	  
	  /* {TAGLINK} */
		function sc_taglink($parm='') {
	   return  $this->var['link'];
	  }
 
}
 
?>
