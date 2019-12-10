<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2014 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 * 
 * blank e_search addon 
 */
 

if (!defined('e107_INIT')) { exit; }

// v2.x e_search addon.
e107::lan('creative_writer');

class creative_writer_search extends e_search // include plugin-folder in the name.
{
		
	function config()
	{	
	  $table = "cw_chapters as ch 
		left join #cw_book as b on ch.cw_chapter_book = b.cw_book_id ";
	  
    $creative_writer = e107::getSingleton('creative_writer',e_PLUGIN.'creative_writer/includes/creative_writer.class.php');
    $catList = $creative_writer->getCategory($type = 'array');
 
		$search = array(
			'name'			=> CWRITER_01,
			'table'			=> $table,

 		'advanced' 		=> array(
								'category'	=> array('type'	=> 'dropdown', 	'text' => LAN_SEARCH_63, 'list'=>$catList),
							//	'author'=> array('type'	=> 'author',	'text' => LAN_SEARCH_61)     
							),     
							
			'return_fields'	=> 
			array('ch.cw_chapter_id,
						 ch.cw_chapter_book,
			       ch.cw_chapter_number,
						 ch.cw_chapter_title,
						 ch.cw_chapter_body,
							b.cw_book_title,
							b.cw_book_summary,
							b.cw_book_created'),
			'search_fields'	=> array('ch.cw_chapter_title' => '1.5', 
			                         'ch.cw_chapter_body' => '1.5',
			                         'b.cw_book_title' => '1.5',															 
			                         'b.cw_book_summary' => '0.6' 															 															 
															 ), // fields and weights.
			
			'order'			=> array('ch.cw_chapter_title' => DESC),
			'refpage'		=> 'cwriter.php'
		);

 	
		return $search;
	}



	/* Compile Database data for output */
	function compile($row)
	{
		$tp = e107::getParser();
			/*
	  if ($row['cwriter_cpdate'] > 0)
    {
        $datestamp = e107::getDateConvert()->convert_date($row['cwriter_cpdate'], "short");
    }
    else
    {
        $datestamp = CWRITER_01;
    }    */
    $pretitle = $row['cw_book_title']; 
    $title =  LAN_CHAPTER_NAME . " : ".$row['cw_chapter_title'];
    $link_id = $row['cw_chapter_id'];
		$res = array();
	
		$res['link'] 		= e_PLUGIN . "creative_writer/cwriter.php?0.chapter." .$row['cw_chapter_book'].".". $row['cw_chapter_id'] ;
		$res['pre_title'] = CWRITER_320 . " : " .$pretitle. " ";
		$res['title'] 		= $title;
		$res['detail'] 	= LAN_BOOK_035. ": " . substr($row['cw_book_summary'], 0, 30);
		$res['summary'] 		=  CWRITER_312 . ": " . substr($row['cw_chapter_body'], 0, 200) . "<br  />" ;

		return $res;
		
		/*
		
		    global $con;
    if ($row['cwriter_cpdate'] > 0)
    {
        $datestamp = $con->convert_date($row['cwriter_cpdate'], "short");
    }
    else
    {
        $datestamp = ECLASSF_75;
    }
    $title = $row['cwriter_cname'];

    $link_id = $row['cwriter_cid'];
    // $dept = $row['dept_id'];
    $res['link'] = e_PLUGIN . "e_classifieds/classifieds.php?0.item.".$row['cwriter_ccatid'].".".$row['cwriter_subid']."." . $link_id . "";
    $res['pre_title'] = $title ?ECLASSF_69 . " " : "";
    $res['title'] = $title ? $title : LAN_SEARCH_9;
    $res['summary'] = ECLASSF_70 . ": " . substr($row['cwriter_catname'], 0, 30) . " &mdash; " . ECLASSF_73 . ": " . substr($row['cwriter_subname'], 0, 30) . "";
    $res['detail'] = ECLASSF_71 . ": " . substr($row['cwriter_cdesc'], 0, 60) . "<br  />" .
    ECLASSF_74 . ": " . $row['cwriter_price'] . "<br />" . ECLASSF_72 . ": " . $datestamp;
    return $res;
    
    */
		
	}



	/**
	 * Optional - Advanced Where     ???? 
	 * @param $parm - data returned from $_GET (ie. advanced fields included. in this case 'date' and 'author' )
	 */
	function where($parm='')
	{
		$tp = e107::getParser();

		$qry = "";
		$where = "find_in_set(cwriter_catclass,'" . USERCLASS_LIST . "') ".
		($pref['cwriter_approval']==1?" and cwriter_capproved > 0":"" )." and (cwriter_cpdate > " . $today . " or cwriter_cpdate=0 ) and ";
		
		
		if (vartrue($parm['time']) && is_numeric($parm['time'])) 
		{
			$qry .= " blank_datestamp ".($parm['on'] == 'new' ? '>=' : '<=')." '".(time() - $parm['time'])."' AND";
		}

		if (vartrue($parm['author'])) 
		{
			$qry .= " blank_nick LIKE '%".$tp -> toDB($parm['author'])."%' AND";
		}
		
		return $qry;
	}
	

}
 
 
 ?>