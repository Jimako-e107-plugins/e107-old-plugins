<?
/*
 * e107Slider Plugin v0.1
 *
 * Copyright (C) 2007-2012 Xen Themes (xenthemes.com)
 *
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php) or 
 * GPL Version 2 (http://www.gnu.org/licenses/gpl-2.0.txt) licenses
 *
 * $Source: 
 * $Revision: 1 $
 * $Date: 25/05/2012 $
 * $Author: leonlloyd $
 *
*/


global $sql, $tp, $pref;

		$amount = $tp->toFORM( $pref['es_slider_number'] );
		
		$es_text = "
<div class='rslides_container'>
	<ul class='rslides rslides2'>
      	";

		$sql = new db;
		$qry = "SELECT * FROM #news WHERE news_render_type='0' ORDER BY news_datestamp DESC LIMIT 0,".$pref['es_slider_news_amount']."";
		if($sql->db_Select_gen($qry)){
			while ($row = $sql->db_Fetch()){
				$news_id = intval($row['news_id']);
				$image = $tp->toHTML($row['news_thumbnail']);
				$title = $tp->toHTML($row['news_title']);
		  
		$es_text .= "
        				<li>
        					<a href='".e_HTTP."news.php?extend.".$news_id."'><img src='".e_IMAGE."newspost_images/".$image."' alt=''/></a>
        					<p class='caption'>
        						".$title."
        					</p>
        					
        				</li>
        		";
			}    
		}

		$es_text .= "
					</ul>
					
      			</div>
      			";

$ns -> tablerender( $pref['es_slider_news_title'], $es_text, 'e107slider_news' );