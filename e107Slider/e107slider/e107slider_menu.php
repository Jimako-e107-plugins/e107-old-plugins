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

global $sql, $tp;

$i = 0;

$sql->db_Select( "e107slider", "*", "ORDER BY id desc", 'nowhere', false );
while ( $row = $sql->db_Fetch() ) {

    $id[$i] = $row['id'];
    $caption[$i] = $row['caption'];
    $image[$i] = $row['image'];
    $link[$i] = $row['link'];
    $i++;
    
}

$es_text = "
<div class='rslides_container'>
	<ul class='rslides rslides1'>
";

$maxitems = $i;

for( $i = 0;$i < $maxitems;$i++ ) {

	$es_text .= "<li>";

    if ( $link[$i] != "" ) {
    
        $pre_url = "<a href='".$link[$i]."'>";        
        $post_url = "</a>";
        
    } else {
    
        $pre_url = "";        
        $post_url = "";
    }
            
    $es_text .= $pre_url."<img src='".e_PLUGIN_ABS."e107slider/slides/".$image[$i]."' alt='' />".$post_url;
            
    if ( $caption[$i] != "" ) {
    
    	$es_text .= "<p class='caption'>" . $tp->toHTML( $caption[$i], true ) . "</p>";
    
    } else {
    
    	$es_text .= "";
    
    }
    
    $es_text .= "</li>";
    
}

$es_text .= "
	</ul>
</div>
";
			
$ns -> tablerender($pref['es_slider_title'], $es_text, "e107slider");