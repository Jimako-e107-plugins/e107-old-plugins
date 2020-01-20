<?php
/*
+---------------------------------------------------------------+
|        YouTube Gallery v4.01 - by Erich Radstake
|        http://www.erichradstake.nl
|        info@erichradstake.nl
|
|        This is a module for the e107 .7+ website system
|        Copyright Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

include "parse_xml.php";

// Creating feed
$news_feed       = "http://www.radstake.deds.nl/pluginsite/e107_plugins/rss_menu/rss.php?news.4";


// Test if feed contains information
$xml = file_get_contents("$news_feed");
$parser = new XMLParser($xml);
$parser->Parse();
$up_check =      ($parser->document->id[0]->tagData);
if ($up_check == "") {
$check = "0";
}else{
$check = "1";
}

$text .= "<br />";

if ($check == "1") {

      $xml = file_get_contents("$news_feed");
      $parser = new XMLParser($xml);
      $parser->Parse();

       $ne_i = 0;

            $doc = $parser->document->entry;
            foreach($doc as $entry)
            {

                  if ($ne_i > 5) {break;}

                  $title   = ($entry->title[0]->tagData);
            	$date    = ($entry->updated[0]->tagData);
            	$summary = ($entry->summary[0]->tagData);
                  $link    = ($entry->id[0]->tagData);

                  $summary = str_replace ("<?","...",$summary);
                  $date    = explode("T",$date);
                  $date    = $date[0];
                  $date    = explode("-",$date);
                  $year    = $date[0];
                  $month   = $date[1];
                  $day     = $date[2];
                  $date    = "$day-$month-$year";
                  

            $text .= "<b><a href='$link' target='_blank'>$date: $title</a></b>";
            $text .= "<br />";
            $text .= $summary;
            $text .= "<br /><br />";

            $ne_i++;
            
            }

	    
}else{
$text .= LAN_YTM_NEWS_PREFS_0;}
?>
