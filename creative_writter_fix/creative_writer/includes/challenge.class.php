<?php

 
e107::lan('creative_writer');
/* shortcodes moved to separate file */

class challenge_writer
{

	private     $plugTemplates      = array();
	private     $sc      = array();
  protected 	$cwriter_from       = null; 
	
  
  public function __construct()
	{
 
		$this->cwpref = e107::pref('creative_writer');
		$this->cwriter_from =  0;

		$this->get = $_GET;
		$this->post = $_POST;
    
    $this->setMode($this->action);
    
    $this->sc = e107::getScBatch('challenge','creative_writer');    

		$this->plugTemplates   = e107::getTemplate('creative_writer', 'challenge');    
		
		if($this->get['p']) {
		  $this->cwriter_from = intval($this->get['p']);              
		}
		 
	}
	
	function init()
	{ 
		$this->process();	
	}
	
	private function process()
	{    
   if(empty($this->get['challenge_id'])) {
	    $this->setMode('list');
	 }
   else { 
     
     $this->setMode('show');
   }
	}
	
	public function render($action = NULL, $type = 'challenge_menu' )
	{
 
    if($action) { $this->setMode($action); }
 		$ns = e107::getRender();
    
    if($this->getMode() == 'show') {
		   	$text = $this->viewChallenge();
				$ns->tablerender($text[0],  $text[1], 'challenge-view');
		}
    else if($this->getMode() == 'menu') {
        $this->cwriter_from = 0;
		   	$text = $this->showList($type); 	
				$ns->tablerender(LAN_CHALLENGE_001,  $text, 'challenge-menu');
		}
    elseif($this->getMode() == 'list') {
		   	$text = $this->showList('challenge_list');
				$ns->tablerender(LAN_CHALLENGE_003,  $text, 'challenge-list');
		}
		else
		{
		$text = 'Something is broken';
		$ns->tablerender('Caption',  $text, 'creative_writer-view');
		}
	}
	
  private function getMode()
	{
		return vartrue($this->get['mode']);
	}
	
	private function setMode($mode)
	{
		$this->get['mode'] = $mode;
	}
  
  private function getLimit()
	{
		return vartrue($this->get['limit']);
	}
	
	 function setLimit($limit)
	{
		$this->get['limit'] = $limit;
	}
	
	function viewChallenge() {
	    $sql = e107::getDB();
	    $tp  = e107::getParser();
	    $frm = e107::getForm();	
      $cwriter_where = "WHERE cw_challenge_id =". (int)$this->get['challenge_id'];
      $cwriter_arg = "select ch.*	from #cw_challenge AS ch ".$cwriter_where." LIMIT 1"; 
      
      $tmpl = $this->plugTemplates; 
      
      if($allRows = $sql->retrieve($cwriter_arg, true))
      {       
              	$cwriter_text  .= $tp->parseTemplate($tmpl['challenge_view']['start'], true, $this->sc); 
                foreach($allRows as $cwriter_row)
              	{
        		      $this->sc->setVars($cwriter_row);
                   
                	$this->sc->wrapper('challenge/challenge_view');
                  if(ADMIN AND $cwriter_row['cw_challenge_starttime'] > time() ) {
                    $cwriter_text  .= $tp->parseTemplate($tmpl['challenge_view']['futureitem'], true,$this->sc); 
                  }
                  else $cwriter_text  .= $tp->parseTemplate($tmpl['challenge_view']['item'], true,$this->sc);    
              	}
                $cwriter_text  .= $tp->parseTemplate($tmpl['challenge_view']['end'], true, $this->sc); 
      }
      
      else {
       $cwriter_text  .= $tp->parseTemplate($tmpl['challenge_view']['nobooks'], true, $this->sc); 
      }

      $caption = $tp->parseTemplate($tmpl['challenge_view']['caption'], true, $this->sc);
      
    return  array($caption, $cwriter_text);
  }
  
	function showList($type = 'challenge-list') {
 
	    $sql = e107::getDB();
	    $tp  = e107::getParser();
	    $frm = e107::getForm();	

      $cwriter_from =  $this->cwriter_from;
      $limit = $this->getLimit();
      
      e107::getSession()->set('cwriter_challenge', $this->get['challenge_id']); 
      
      if(ADMIN) { $cwriter_where = ""; }
      else {
        $cwriter_where = "WHERE cw_challenge_starttime = '' OR cw_challenge_starttime < ".time();
      }
 
      /* todo put number of item on page to prefs */
      
      $cwriter_arg = "select ch.*	from #cw_challenge AS ch ".$cwriter_where."
      order by cw_challenge_starttime DESC ";  
      
			$cwriter_count = $sql->gen($cwriter_arg, false);
      
      if($limit) {
        $cwriter_arg .= " limit 0, ".$limit;
      }
      elseif($this->cwpref['cwriter_challengeperpage'] > 0) {
         $cwriter_arg .= " limit ".$cwriter_from;
         $cwriter_arg .= " ," . $this->cwpref['cwriter_challengeperpage'];
      }
 
      $tmpl = $this->plugTemplates; 
 
      if($allRows = $sql->retrieve($cwriter_arg, true))
      {       
              	$cwriter_text  .= $tp->parseTemplate($tmpl[$type]['start'], true, $this->sc); 
                foreach($allRows as $cwriter_row)
              	{
        		      $cwriter_row['cwriter_from'] = $cwriter_from;
        		      $cwriter_row['cwriter_count'] = $cwriter_count;
									$this->sc->setVars($cwriter_row);                   
                	$this->sc->wrapper('challenge/'.$type);
                  if($cwriter_row['cw_challenge_starttime'] > time() ) {
                    $cwriter_text  .= $tp->parseTemplate($tmpl[$type]['futureitem'], true,$this->sc); 
                  }
                  else $cwriter_text  .= $tp->parseTemplate($tmpl[$type]['item'], true,$this->sc);    
              	}
                $cwriter_text  .= $tp->parseTemplate($tmpl[$type]['end'], true, $this->sc); 
      }
      
      else {
       $cwriter_text  .= $tp->parseTemplate($tmpl[$type]['nobooks'], true, $this->sc); 
      }
 
    return  $cwriter_text;
  }  
  
	    
}
 