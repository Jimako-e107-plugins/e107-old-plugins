<?php

if (!defined('e107_INIT')) { exit; }

 
class plugin_creative_writer_challenge_shortcodes extends e_shortcode
{
 	protected $cwpref = array();
  
  public function __construct()
	{
     $this->cwpref = e107::pref('creative_writer');	
	}
 
 
 
	
	/**
	* {CW_CHALLENGE_ID}
	*/
	public function sc_cw_challenge_id($parm=null)
	{
	
		return $this->var['cw_challenge_id'];
	}
	
	/**
	* {CW_CHALLENGE_DESC}
	*/
	public function sc_cw_challenge_desc($parm=null)
	{
	  return e107::getParser()->toHtml($this->var['cw_challenge_desc'], true,'BODY');
	}
  
	/**
	* {CW_CHALLENGE_ICON}
	*/
	public function sc_cw_challenge_icon($parm=null)
	{ 
     
  		$att['w'] = $att['aw'] =vartrue($parm['w']) ? $parm['w'] : e107::getParser()->thumbWidth(); // 190; // 160;
		  $att['h'] = $att['ah']= vartrue($parm['h']) ? $parm['h'] : e107::getParser()->thumbHeight(); // 130;
		  $att['alt'] = $this->var['cw_challenge_name'];
      $att['placeholder'] = true;
  		$text = e107::getParser()->toImage($this->var['cw_challenge_icon'], $att);
	    		 
    return $text;
	}
	
	/**
	* {CW_CHALLENGE_HOME}
	*/
	public function sc_cw_challenge_home($parm=null)
	{ 
    $url = e107::url('creative_writer','challenges');
    $options['class'] = vartrue($parm['class'],'btn btn-default btn-sm');
		$text = '<a class="'.$options['class'].'" href="'.$url.'">'.LAN_CHALLENGE_003.'</a>';   		 
    return $text;
	}	
  
	/**
	* {CW_CHALLENGE_LASTUPDATED}
	*/
	public function sc_cw_challenge_lastupdated($parm=null)
	{
	  return e107::getParser()->toDate($this->var['cw_challenge_lastupdated']);
	}
  
	/**
	* {CW_CHALLENGE_NAME}
	*/
	public function sc_cw_challenge_name($parm=null)
	{
		return $this->var['cw_challenge_name'];
	}
	
	/* {CW_CHALLENGE_PAGINATION} */
	function sc_cw_challenge_pagination($parm)
	{
 
		$cwriter_amount		 = $this->cwpref['cwriter_challengeperpage'];
		$cwriter_count		 = $this->var['cwriter_count'];
		$cwriter_from  		 = $this->var['cwriter_from']  ;
		$cwriter_npaction = "list";	
		
		$url = e107::url('creative_writer','challenges')."/[FROM]";
		// e107::url('creative_writer', 'challenge', $this->var)		   
 		$nextprev = array(
				'tmpl_prefix'	=>'default',
				'total'			=> $cwriter_count,
				'amount'		=> $cwriter_amount,
				'current'		=> $cwriter_from,
				//'url'			=> urldecode($url)
				'url'			=>  $url  
   
		);
       
		$nextprev_parms  = http_build_query($nextprev,false,'&');	
 
		$cwriter_nextprev = e107::getParser()->parseTemplate("{NEXTPREV={$nextprev_parms}}") . "";
 
		return $cwriter_nextprev;
	}
	

	/**
	* {CW_CHALLENGE_SUMMARY}
	*/
	public function sc_cw_challenge_summary($parm=null)
	{
	
		return $this->var['cw_challenge_summary'];
	}
 
  
	/**
	* {CW_CHALLENGE_STARTTIME}
	*/
	public function sc_cw_challenge_starttime($parm=null)
	{
	  return e107::getParser()->toDate($this->var['cw_challenge_starttime']);
	}

 
	/**
	* {CW_CHALLENGE_URL}
	*/
	public function sc_cw_challenge_url($parm=null)
	{
    return e107::url('creative_writer', 'challenge', $this->var); 
	}
  


  
 
}
?>