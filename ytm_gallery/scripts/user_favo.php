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

if (USER) {
      $query11   = "SELECT user_email from ".MPREFIX."user WHERE user_name = '" . USERNAME ."'";
      $result11  = mysql_query($query11);
      $row11     = mysql_fetch_array($result11,MYSQL_ASSOC);
      $user_mail = $row11['user_email'];
      $movie_author = (USERNAME);}
      
      
include "parse_xml.php";

      $query02             = "SELECT username from ".MPREFIX."er_ytm_gallery WHERE id = '1'";
      $result02            = mysql_query($query02);
      $row02               = mysql_fetch_array($result02,MYSQL_ASSOC);
      $yt_username         = $row02['username'];

if (!$yt_username) {$msgtext = LAN_YTM_IMPO_PREFS_55;
}else{
      
// Creating feed
$favo_feed       = "http://www.youtube.com/api2_rest?method=youtube.users.list_favorite_videos&dev_id=dyxxpOhQDf8&user=$yt_username";



// Test if feed contains information
$xml = file_get_contents("$favo_feed");
$parser = new XMLParser($xml);
$parser->Parse();
$favo_check =      ($parser->document->video_list[0]->video[0]->id[0]->tagData);
if ($favo_check == "") {
$check = "0";
}else{
$check = "1";
}

if ($check == "1") {

      $xml = file_get_contents("$favo_feed");
      $parser = new XMLParser($xml);
      $parser->Parse();



            $fa_i = 0;
            $doc = $parser->document->video_list[0]->video;
            foreach($doc as $video_list)
            {
            	$movie_code  = ($video_list->id[0]->tagData);
            	$movie_title = ($video_list->title[0]->tagData);
            	$movie_title = str_replace ("'","&#39;",$movie_title);
            	$movie_discr = ($video_list->description[0]->tagData);
           	      $movie_discr = str_replace ("'","&#39;",$movie_discr);

                  $query03             = "SELECT movie_id, movie_code from ".MPREFIX."er_ytm_gallery_movies WHERE movie_code = '$movie_code'";
                  $result03            = mysql_query($query03);
                  $row03               = mysql_fetch_array($result03,MYSQL_ASSOC);
                  $code_check          = $row03['movie_code'];



					if (!$movie_code == $code_check){

            				mysql_query("insert into ".MPREFIX."er_ytm_gallery_movies (movie_title, movie_code, active, input_email, input_comment, input_way, input_user, input_status) VALUES ('$movie_title', '$movie_code', '1', '$user_mail', '$movie_discr', '3', '$movie_author', '0');");
            				$fa_i++; $text .= mysql_error();}



		}

          if ($fa_i < 1){$noimportmsg = LAN_YTM_IMPO_PREFS_13;}
	    $msgtext = "<b>$fa_i</b> " . LAN_YTM_IMPO_PREFS_2 . "$noimportmsg";
	    
	    
}else{
$msgtext = LAN_YTM_IMPO_PREFS_1;}
}
?>
