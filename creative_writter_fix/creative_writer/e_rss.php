<?php
// *
// e_rss for Creative Writer
// *
if (!defined('e107_INIT'))
{
    exit;
}

e107::lan('creative_writer');

// v2.x Standard

class creative_writer_rss // plugin-folder + '_rss'
{
	/**
	 * Admin RSS Configuration
	 */
	function config()
	{
		$config = array();

		$config[] = array(
			'name'			=> CWRITER_A1,
			'url'			=> 'creative_writer',
			'topic_id'		=> '',
			'path'		=> 'creative_writer',	
			'text'		=> CWRITER_A78,					
			'description'	=> CWRITER_A78, // that's 'description' not 'text'
			'class'			=> '0',
			'limit'			=> '9'
		);

		return $config;
	}
 
 
 

	/**
	 * Compile RSS Data
	 * @param array $parms
	 * @param string $parms['url']
	 * @param int $parms['limit']
	 * @param int $parms['id']
	 * @return array
	 */
	function data($parms=array())
	{
		$sql = e107::getDb();
    $tp  = e107::getParser();
		$rss = array();
		$i=0;
		$pref = e107::pref('creative_writer');
    $limit = vartrue($parms['limit'],10);
    
		if (check_class($pref['cwriter_read']))
		{
		// get bugs which are visible to this class
		    $cwriter_args = "
				select *
				from #cw_chapters as a
				left join #cw_book as b on cw_chapter_book=cw_book_id
				left join #cw_category as c on cw_category_id=cw_book_category
				left join #cw_genre as g on cw_book_genre=cw_genre_id
				where find_in_set(cw_category_class,'" . USERCLASS_LIST . "')
				and cw_book_visible>0
				and cw_book_approved > 0
				order by cw_book_lastupdate desc
				LIMIT 0," .$limit;
 
		    if ($items = $sql->db_Select_gen($cwriter_args))
		    {
		        $i = 0;
		        while ($rowrss = $sql->db_Fetch())
		        {
		            $tmp = explode(".", $rowrss['cw_book_author']);
		            $rss[$i]['author'] = "" . $tmp[1] ;
		            $rss[$i]['author_email'] = '';
		            $rss[$i]['link'] = $e107->base_path . $PLUGINS_DIRECTORY . "creative_writer/cwriter.php?0.chapter." .$rowrss['cw_chapter_book'].".". $rowrss['cw_chapter_id'] ;
		            $rss[$i]['linkid'] = $tp->toRss($rowrss['cw_chapter_id'],true);
		            $rss[$i]['title'] = $tp->toRss($rowrss['cw_chapter_title'],true);
		            $rss[$i]['description'] = "";
		               $urlparam= array(
                      'cw_book_id'			=> $rowrss['cw_category_id'],
                      );
                    $url = e107::url('creative_writer', 'book', $urlparam);
		                $rss[$i]['category_name'] = $tp->toRss($rowrss['cw_category_name'],true) ;   //  todo check this 
		               // $rss[$i]['category_link'] = $e107->base_path . $PLUGINS_DIRECTORY . "creative_writer/cwriter.php?0.precis." . $rowrss['cw_category_id']   ;
		                $rss[$i]['category_link'] = $url   ;		
		            $rss[$i]['datestamp'] = $rowrss['cw_chapter_lastupdate'];
		            $rss[$i]['enc_url'] = "";
		            $rss[$i]['enc_leng'] = "";
		            $rss[$i]['enc_type'] = "";
		            $i++;
		        }
		    }
		    else
		    {
		        $rss[$i]['author'] = "" . $tmp[1];
		        $rss[$i]['author_email'] = '';
		        $rss[$i]['link'] = $e107->base_path . $PLUGINS_DIRECTORY . "creative_writer/cwriter.php";
		        $rss[$i]['linkid'] = '';
		        $rss[$i]['title'] = CWRITER_A77;
		        $rss[$i]['description'] = "";
		        $rss[$i]['category_name'] = "";
		        $rss[$i]['category_link'] = '';
		        $rss[$i]['datestamp'] = "";
		        $rss[$i]['enc_url'] = "";
		        $rss[$i]['enc_leng'] = "";
		        $rss[$i]['enc_type'] = "";
		    }
		}
		else
		{
		    $rss[$i]['author'] = "" . $tmp[1];
		    $rss[$i]['author_email'] = '';
		    $rss[$i]['link'] = $e107->base_path . $PLUGINS_DIRECTORY . "creative_writer/cwriter.php";
		    $rss[$i]['linkid'] = '';
		    $rss[$i]['title'] = CWRITER_A77;
		    $rss[$i]['description'] = "";
		    $rss[$i]['category_name'] = "";
		    $rss[$i]['category_link'] = '';
		    $rss[$i]['datestamp'] = "";
		    $rss[$i]['enc_url'] = "";
		    $rss[$i]['enc_leng'] = "";
		    $rss[$i]['enc_type'] = "";
		}
 

		return $rss;
	}



}

 

?>