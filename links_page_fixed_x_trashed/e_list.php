<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2009 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 */

if (!defined('e107_INIT')) { exit; }

class list_links_page
{
	function list_links_page($parent)
	{
		$this->parent = $parent;
	}

	function getListData()
	{
		$list_caption = $this->parent->settings['caption'];
		$list_display = ($this->parent->settings['open'] ? "" : "none");

		if($this->parent->mode == "new_page" || $this->parent->mode == "new_menu" )
		{
      $qry = " l.link_datestamp>".$this->parent->getlvisit()." AND ";
		}
		else
		{
			$qry = '';
		}

		$bullet = $this->parent->getBullet($this->parent->settings['icon']);

  	$qry = "
  	SELECT l.*, c.link_category_id, c.link_category_name
  	FROM #links_page AS l
  	LEFT JOIN #links_page_cat AS c ON c.link_category_id = l.link_category
  	WHERE ".$qry." l.link_class REGEXP '".e_CLASS_REGEXP."' AND c.link_category_class REGEXP '".e_CLASS_REGEXP."' AND l.link_active != '0'  
  	ORDER BY l.link_datestamp DESC LIMIT 0,".intval($this->parent->settings['amount'])." "; 
   
 

		$links_pages = $this->parent->e107->sql->gen($qry);
		if($links_pages == 0)
		{
			$list_data = LIST_LINKS_2;
		}
		else
		{
			$list_data = array();
			while($row = $this->parent->e107->sql->fetch())
			{
				$record = array();
				$rowheading = $this->parent->parse_heading($row['link_name']);
				$record['icon'] = $bullet;
				$record['heading'] = "<a href='".$row['link_url']."' rel='external' title='".$row['link_name']."'>".$rowheading."</a>";
				$record['author'] = "";
				$record['category'] = (vartrue($this->parent->settings['category']) ? "<a href='".e_PLUGIN."links_page/links.php?cat.".$row['link_category_id']."'>".$row['link_category_name']."</a>" : "");
				$record['date'] = (vartrue($this->parent->settings['date']) ? $this->parent->getListDate($row['link_datestamp']) : "");
				$record['info'] = "";
				$list_data[] = $record;
			}
		}
		//return array with 'records', (global)'caption', 'display'
		return array(
			'records'=>$list_data,
			'caption'=>$list_caption,
			'display'=>$list_display
		);
	}
}
?>