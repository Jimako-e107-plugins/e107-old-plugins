<?php

 
e107::lan('creative_writer');
/* shortcodes moved to separate file */

class book_writer
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
    
    $this->sc = e107::getScBatch('book','creative_writer');    

		$this->plugTemplates   = e107::getTemplate('creative_writer', 'book');    
 
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
   if(empty($this->get['book_id'])) {
	    $this->setMode('list');
	 }
   else { 
     $this->setMode('show');
   }
	}
	
	public function render($action = NULL, $type = 'book_menu' )
	{
 
    if($action) { $this->setMode($action); }
 		$ns = e107::getRender();
    
    if($this->getMode() == 'show') {
		   	$text = $this->showBook();
				$ns->tablerender('',  $text, 'book-show');
		}
    else if($this->getMode() == 'menu') {
        $this->cwriter_from = 0;
		   	$text = $this->showList($type); 	
				$ns->tablerender(LAN_BOOK_001,  $text, 'book-menu');
		}
    elseif($this->getMode() == 'list') {
		   	$text = $this->showList('book_list');
				$ns->tablerender(LAN_CHAPTER_003,  $text, 'book-list');
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
	
	function showBook() {
 
  	$sql = e107::getDB();
	  $tp  = e107::getParser();
	  $frm = e107::getForm();
      
    $cwriter_bookid =  (int)$this->get['book_id'];
    $cwriter_cwriter_from =  $this->cwriter_from;
    $action = $this->action;
    
		$tmpl = $this->plugTemplates;
 
    $sql->update("cw_book", "cw_book_views=cw_book_views+1 where cw_book_id=$cwriter_bookid", false);
    
    if (USER)
    {
        $cwriter_vlist = USERID ;
    }
    else
    {
        $cwriter_vlist = e107::getIPHandler()->getip(TRUE) ;
    }
 
    $cwriter_vlisting = $cwriter_vlist . ",";
    $sql->update("cw_book", "cw_book_unique=cw_book_unique+1,
		cw_book_viewers=if(cw_book_viewers,concat(cw_book_viewers,'{$cwriter_vlisting}'),'{$cwriter_vlisting}')
		where (isnull(cw_book_viewers) or not find_in_set('{$cwriter_vlist}',cw_book_viewers))  and cw_book_id=$cwriter_bookid", false);
	    $cwriter_arg = "select *,count(cw_review_id) as numreviews from #cw_book as b
		left join #cw_category as c on b.cw_book_category=c.cw_category_id
		left join #cw_genre as g on b.cw_book_genre=g.cw_genre_id
		left join #cw_review as r on r.cw_review_book=b.cw_book_id
		where cw_book_id='$cwriter_bookid'
		group by b.cw_book_id";
 
    
    if($allRows = $sql->retrieve($cwriter_arg, true))
    {
        $cwriter_text  .= $tp->parseTemplate($tmpl['bookview']['start'], true, $this->sc); 
        
        foreach($allRows as $cwriter_row)
        {      
	        $cwriter_bookid =  $cwriter_row['cw_book_book'];

					$this->sc->setVars($cwriter_row);
	        $this->sc->wrapper('book/book');  
	        $cwriter_text  .= $tp->parseTemplate($tmpl['book_view']['body'], true, $this->sc); 
        }
      $cwriter_text  .= $tp->parseTemplate($tmpl['book_view']['end'], true, $this->sc); 
 
    }
    else
    {
        $cwriter_text .= $tp->parseTemplate($tmpl['book_view']['nochapter'], true, $this->sc);
    }
    return  $cwriter_text;
    return  $cwriter_text;
 
  }
  
	function showList($type = 'book-list') {


    return  $cwriter_text;
  }  
  
	    
}
 