<?php
//ADD: function that renders a list or item info box.  this can then be called at top of edit or item entry
//     and at top of show just item or list page

if (!defined('e107_INIT')) { exit; }

class e107pagestat
{
  /* this function count views, use it only in detail / extend news */
	function page_stat()
	{
		global $sql;
		$url = e_PAGE."-".e_QUERY;  // left for double check
 
		//detect news page:
		if($news_item = getcachedvars('current_news_item'))
		{$PS_Item_ID = $news_item['news_id'];
		$PS_Type    = 'news'; 
		}
		// prepared for page, content...
		
		
		$where = " item_type ='".$PS_Type."' and item_id = ".$PS_Item_ID." " ;	  
		$string = $sql->retrieve('pagestat', '*', $where);
 
		if ($string = $sql->retrieve('pagestat', '*', $where)) {
		 $sql->db_Update("pagestat","cnt=cnt+1 WHERE page='".$url."'"); 
		}
		else {
		  $insert = array(
					'item_id' => $PS_Item_ID ,
					'item_type' => $PS_Type,
					'page' => $url
				);
				$sql->insert('pagestat', $insert);
		}
 
		if ($string = $sql->retrieve('pagestat', '*', $where))
		{			 
			return $string["cnt"];
		}
		else  
		return 0;
	}	
	
	/* this function is just for listing only, not count views */
	function viewpage_stat()
	{
			global $sql;
			$url = e_PAGE."-".e_QUERY;
	 
			//detect news page:
			if($news_item = getcachedvars('current_news_item'))
			{$PS_Item_ID = $news_item['news_id'];
				$PS_Type    = 'news'; 
			}
			// prepared for page, content...

			$where = " item_type ='".$PS_Type."' and item_id = ".$PS_Item_ID." " ;	  		  
 
			if ($string = $sql->retrieve('pagestat', '*', $where))
			{			 
				return $string["cnt"];
			}
			else  
			return 0;
	}	
}

?>
