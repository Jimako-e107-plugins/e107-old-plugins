<?php

 
e107::lan('creative_writer');
/* shortcodes moved to separate file */

class chapter_writer
{

	private     $plugTemplates      = array();
	private     $sc      = array();
  protected 	$cwriter_from       = null; 
  protected 	$cwriter_chapterid       = null;	
  
  public function __construct()
	{
 
		$this->cwpref = e107::pref('creative_writer');
		$this->cwriter_from =  0;

		$this->get = $_GET;
		$this->post = $_POST;
    
    $this->sc = e107::getScBatch('chapter','creative_writer');    

		$this->plugTemplates   = e107::getTemplate('creative_writer', 'chapter');    
 
		if($this->get['p']) {
		  $this->cwriter_from = intval($this->get['p']);              
		}
    
    if($this->get['chapter_id']) {
      $this->cwriter_chapterid =  (int)$this->get['chapter_id'];
		}  
	}
	
	function init()
	{ 
    $this->process();		
	}
	
	private function process()
	{ 
     
     if(empty($this->get['chapter_id'])) {
  	    $this->setMode('list');
  	 }
     else { 
       $this->setMode('show');
     } 
     
	}
	
	public function render($action = NULL, $type = 'chapter_menu' )
	{
 
    if($action) { $this->setMode($action); }
 
    switch ($this->getMode()) {
    case 'show':           
        $text = $this->showChapter($this->cwriter_chapterid, 'chapter_view');
        e107::getRender()->tablerender('',  $text, 'chapter-view');      
        break;   
    case 'menu':
        $this->cwriter_from = 0;
        $text = $this->showList($type); 
        e107::getRender()->tablerender(LAN_CHAPTER_001,  $text, 'chapter-menu');
        break;
    case 'list':
        $text = $this->showList('chapter_list');
        e107::getRender()->tablerender(LAN_CHAPTER_003,  $text, 'chapter-list');
        break;
    default:
        $text = 'Something is broken';
		    e107::getRender()->tablerender('Caption',  $text, 'creative_writer');
    }   
     
	}
	
  private function getMode()
	{
		return vartrue($this->get['mode']);
	}
	
	function setMode($mode)
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
	
	function showChapter($cwriter_chapterid = NULL, $type = 'chapter_view') {
 
  	$sql = e107::getDB();
	  $tp  = e107::getParser();
	  $frm = e107::getForm();
 
    $cwriter_cwriter_from =  $this->cwriter_from;
    $action = $this->action;
    
		$tmpl = $this->plugTemplates;
 
    $cwriter_arg = "select c.*,b.* from #cw_chapters as c
    left join #cw_book as b on c.cw_chapter_book = b.cw_book_id
    where cw_chapter_id=$cwriter_chapterid";
                                                   
    if($allRows = $sql->retrieve($cwriter_arg, true))
    {
        $cwriter_text  .= $tp->parseTemplate($tmpl[$type]['start'], true, $this->sc); 
            
        foreach($allRows as $cwriter_row)
        {      
	        $cwriter_bookid =  $cwriter_row['cw_chapter_book'];
         
	        $sql->update("cw_chapters", "cw_chapter_views=cw_chapter_views+1 where cw_chapter_book=$cwriter_bookid and cw_chapter_id=$cwriter_chapterid", false);
          
          /* to solve pagination */
          $book_chapters_list = $this->getNextPrev($cwriter_row['cw_chapter_id'], $cwriter_bookid); 
           
          $cwriter_row['cw_chapter_prev'] = $book_chapters_list[0];
          $cwriter_row['cw_chapter_next'] = $book_chapters_list[1];  
 
					$this->sc->setVars($cwriter_row);
	        $this->sc->wrapper('creative_writer/chapter');  
	        $cwriter_text  .= $tp->parseTemplate($tmpl[$type]['body'], true, $this->sc); 
        }
      $cwriter_text  .= $tp->parseTemplate($tmpl[$type]['end'], true, $this->sc); 
 
    }
    else
    {
        $cwriter_text .= $tp->parseTemplate($tmpl[$type]['nochapter'], true, $this->sc);
    }
 
    return  $cwriter_text;
 
  }
  
	function showList($type = 'chapter-list') {
 
	    $sql = e107::getDB();
	    $tp  = e107::getParser();
	    $frm = e107::getForm();	

      $cwriter_from =  $this->cwriter_from;
      $limit = $this->getLimit();
      //print_a($type);
      /* todo put number of item on page to prefs */
      
		$cwriter_arg = "select ch.*,b.*, c.cw_category_name
		from #cw_chapters as ch
    left join #cw_book as b on ch.cw_chapter_book = b.cw_book_id
    left join #cw_category as c on cw_category_id=cw_book_category
		left join #cw_genre as g on cw_genre_id=cw_book_genre
    where cw_book_approved=1 and cw_book_visible=1 and find_in_set(cw_category_class,'" . USERCLASS_LIST . "')    
		order by cw_chapter_created";
      
			$cwriter_count = $sql->gen($cwriter_arg, false);
      
      if($limit) {
        $cwriter_arg .= " limit 0, ".$limit;
      }
      elseif($this->cwpref['cwriter_chapterperpage'] > 0) {
         $cwriter_arg .= " limit ".$cwriter_from;
         $cwriter_arg .= " ," . $this->cwpref['cwriter_chapterperpage'];
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
                	$this->sc->wrapper('chapter/'.$type);
                  $cwriter_text  .= $tp->parseTemplate($tmpl[$type]['item'], true,$this->sc);    
              	}
                $cwriter_text  .= $tp->parseTemplate($tmpl[$type]['end'], true, $this->sc); 
      }
      
      else {
       $cwriter_text  .= $tp->parseTemplate($tmpl[$type]['nobooks'], true, $this->sc); 
      }

    return  $cwriter_text;
  }  
  
  function getChaptersList($cwriter_bookid = NULL) {
	   
     $sql = e107::getDB();
     $cwriter_arg = "select cw_chapter_id, cw_chapter_number 
		 from #cw_chapters   
     where cw_chapter_book = ".$cwriter_bookid . " ORDER BY cw_chapter_number " ;
 
     if($allRows = e107::getDB()->retrieve($cwriter_arg, true ))
      { 
      	foreach($allRows as $row)
      	{ 
          $book_chapterslist[]= $row["cw_chapter_id"];
      	}
        $book_chapterslist = implode(",", $book_chapterslist);  
      }     
      else $book_chapterslist = '';
        
       
     return $book_chapterslist;
  }  
  
  function getNextPrev($cw_chapter_id = NULL, $cwriter_bookid = NULL) {
	   
    $book_chapters_list =  $this->getChaptersList($cwriter_bookid);
    
    $book_chapters = explode(",", $book_chapters_list);
    if($book_chapters)
    {  
      $index = array_search($cw_chapter_id, $book_chapters);
      if($index !== FALSE)
      {
          if(array_key_exists($index + 1, $book_chapters)) {
           $next = $book_chapters[$index + 1];
          }
          if(array_key_exists($index - 1, $book_chapters)) {
           $previous = $book_chapters[$index - 1];
          }
          
      }
    }
  
    $text[0] = $previous;
    $text[1] = $next;
    
    return $text; 
  } 	    
}
 