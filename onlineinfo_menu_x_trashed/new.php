<?php
/*
+---------------------------------------------------------------+
|	e107 website system
|
|	©Steve Dunstan 2001-2003
|	http://e107.org
|	jalist@e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/



require_once('../../class2.php');

if(!USER){
	header("location:".e_BASE."index.php");
	exit;
}
include_once(e_PLUGIN.'onlineinfo_menu/functions.php');


require_once(HEADERF);

$lan_file = e_PLUGIN.'onlineinfo_menu/languages/'.e_LANGUAGE.'.php';
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN.'onlineinfo_menu/languages/English.php');



$sql2 = new db;
$lvisit = USERLV;
$singleread= explode('.', e_QUERY);
$bullet = '<img src="'.THEME.'images/bullet2.gif" alt="bullet" /> ';


$userfound = $sql -> db_Select('onlineinfo_read','*','user_id='.USERID.'');


if ($userfound==0){

	$sql->db_Insert(onlineinfo_read,"".USERID.",'','','','','','','','','','','','','','','','','','','','',''","user_id=".USERID."");

}


while($row = $sql -> db_Fetch()){
	extract($row);

$newsread = cleanup($news);
$chatboxread = cleanup($chatbox);
$commentsread = cleanup($comments);
$contentsread = cleanup($contents);
$downloadsread = cleanup($downloads);
$guestbookread = cleanup($guestbook);
$picturesread = cleanup($pictures);
$moviesread = cleanup($movies);
$linksread = cleanup($links);
$sitemembersread = cleanup($sitemembers);
$gamesread = cleanup($games);
$gametopread = cleanup($game_top);
$galleryread = cleanup($gallery);
$ibfread = cleanup($ibf);
$smfread = cleanup($smf);
$bugread = cleanup($bug);
$chatbox2read = cleanup($chatbox2);
$copperread = cleanup($copper);
$jokesread = cleanup($jokes);
$blogsread = cleanup($blogs);
$suggestionsread = cleanup($suggestions);
}


if ($singleread[0] == 'marknewbugsasread')
{
	unset ($u_new);

	$bugtracker3_bugs_id = intval($singleread[1]);

	if (!$bugread){
				$u_new .= $bugtracker3_bugs_id;
				}else{
				$u_new .= $bugread.','.$bugtracker3_bugs_id;
				}


	$sql->db_Update("onlineinfo_read", "bug='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;
}


if (e_QUERY == 'mark_all_newbugs_as_read')
{
unset ($u_new);
	$u_new = $bugread;

	if($u_new){$qy=' AND bugtracker3_bugs_id NOT IN('.$u_new.')';}

	$qry = 'bugtracker3_bugs_update_timestamp > '.USERLV.$qy;
		if ($sql->db_Select('bugtracker3_bugs', 'bugtracker3_bugs_id', $qry)) {
			while ($row = $sql->db_Fetch()) {

				if (!$u_new){
				$u_new .= $row['bugtracker3_bugs_id'];
				}else{
				$u_new .= ','.$row['bugtracker3_bugs_id'];
				}

			}

			$sql->db_Update("onlineinfo_read", "bug='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;

	}

}







if ($singleread[0] == 'markcontentsasread')
{
	unset ($u_new);

	$id = intval($singleread[1]);

	if (!$contentsread){
				$u_new .= $id;
				}else{
				$u_new .= $contentsread.",".$id;
				}


	$sql->db_Update("onlineinfo_read", "contents='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;
}


if (e_QUERY == 'mark_all_newcontents_as_read')
{
unset ($u_new);
	$u_new = $contentsread;

	if($u_new){$qy=' AND content_id NOT IN('.$u_new.')';}

	$qry = 'content_datestamp > '.USERLV.$qy;
		if ($sql->db_Select('pcontent', 'content_id', $qry)) {
			while ($row = $sql->db_Fetch()) {

				if (!$u_new){
				$u_new .= $row['content_id'];
				}else{
				$u_new .= ','.$row['content_id'];
				}

			}

			$sql->db_Update("onlineinfo_read", "contents='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;

	}

}


if ($singleread[0] == 'marknewsmfasread')
{
	unset ($u_new);

	$topic_id = intval($singleread[1]);

	if (!$ibfread){
				$u_new .= $topic_id;
				}else{
				$u_new .= $smfread.','.$topic_id;
				}


	$sql->db_Update("onlineinfo_read", "smf='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;
}


if (e_QUERY == 'mark_all_newsmf_as_read')
{
unset ($u_new);
	$u_new = $smfread;

		if($u_new){$qy=' AND ID_MSG NOT IN('.$u_new.')';}

	$qry = 'posterTime > '.USERLV.$qy;
	$sqlqry='SELECT ID_MSG FROM '.$pref['onlineinfo_smfprefix'].'messages WHERE '.$qry;

		if ($sql->db_Select_gen($sqlqry)) {
			while ($row = $sql->db_Fetch()) {

				if (!$u_new){
				$u_new .= $row['ID_MSG'];
				}else{
				$u_new .= ','.$row['ID_MSG'];
				}

			}

			$sql->db_Update("onlineinfo_read", "smf='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;

	}

}

// COMMENTS POSTING

$splitcomments= explode('|',$commentsread);

if ($singleread[0] == 'markcommentasread')
{
	unset ($u_new);

	$comment_id = intval($singleread[1]);

	if (!$splitcomments[0]){
				$u_new .= $comment_id;
				}else{
				$u_new .= $splitcomments[0].','.$comment_id;
				}


	$sql->db_Update("onlineinfo_read", "comments='".$u_new."|".$splitcomments[1]."|".$splitcomments[2]."|".$splitcomments[3]."|".$splitcomments[4]."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;
}

if ($singleread[0] == 'markccommentasread')
{
	unset ($u_new);

	$msg_id = intval($singleread[1]);

	if (!$splitcomments[1]){
				$u_new .= $msg_id;
				}else{
				$u_new .= $splitcomments[1].','.$msg_id;
				}


	$sql->db_Update("onlineinfo_read", "comments='".$splitcomments[0]."|".$u_new."|".$splitcomments[2]."|".$splitcomments[3]."|".$splitcomments[4]."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;
}

if ($singleread[0] == 'markgcommentasread')
{
	unset ($u_new);

	$g_id = intval($singleread[1]);

	if (!$splitcomments[2]){
				$u_new .= $g_id;
				}else{
				$u_new .= $splitcomments[2].','.$g_id;
				}


	$sql->db_Update("onlineinfo_read", "comments='".$splitcomments[0]."|".$splitcomments[1]."|".$u_new."|".$splitcomments[3]."|".$splitcomments[4]."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;
}


if ($singleread[0] == 'markbtcommentasread')
{
	unset ($u_new);

	$g_id = intval($singleread[1]);

	if (!$splitcomments[3]){
				$u_new .= $g_id;
				}else{
				$u_new .= $splitcomments[3].','.$g_id;
				}


	$sql->db_Update("onlineinfo_read", "comments='".$splitcomments[0]."|".$splitcomments[1]."|".$splitcomments[2]."|".$u_new."|".$splitcomments[4]."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;
}

if ($singleread[0] == 'markcpgcommentasread')
{
	unset ($u_new);

	$msg_id = intval($singleread[1]);

	if (!$splitcomments[4]){
				$u_new .= $msg_id;
				}else{
				$u_new .= $splitcomments[4].','.$msg_id;
				}


	$sql->db_Update("onlineinfo_read", "comments='".$splitcomments[0]."|".$splitcomments[1]."|".$splitcomments[2]."|".$splitcomments[3]."|".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;
}



if (e_QUERY == 'mark_all_comments_as_read')
{
unset ($partone);
	$partone = $splitcomments[0];

	if($partone){$qy=' AND comment_id NOT IN('.$splitcomments[0].')';}

	$qry='comment_datestamp > '.USERLV.$qy;
if ($sql->db_Select('comments', 'comment_id', $qry)) {
			while ($row = $sql->db_Fetch()) {

				if (!$partone){
				$partone .= $row['comment_id'];
				}else{
				$partone .= ','.$row['comment_id'];
				}
			}

}

unset ($parttwo);
	$parttwo = $splitcomments[1];

	if($parttwo){$qy=' AND msg_id NOT IN('.$splitcomments[1].')';}

	$qry='UNIX_TIMESTAMP(msg_date) > '.USERLV.$qy;
	if ($sql->db_Select('CPG_comments', 'msg_id', $qry)) {
			while ($row = $sql->db_Fetch()) {

				if (!$parttwo){
				$parttwo .= $row['msg_id'];
				}else{
				$parttwo .= ','.$row['msg_id'];
				}
			}

}


unset ($partthree);
	$partthree = $splitcomments[2];

	if($partthree){$qy=' AND g_id NOT IN('.$splitcomments[2].')';}

	$sqlqry='SELECT g_id FROM '.$pref['onlineinfo_gallery2prefix'].'Comment WHERE g_date > '.USERLV.$qy;

		if ($sql->db_Select_gen($sqlqry)) {
			while ($row = $sql->db_Fetch()) {

				if (!$partthree){
				$partthree .= $row['g_id'];
				}else{
				$partthree .= ','.$row['g_id'];
				}

			}

	}


	unset ($partfour);
	$partfour = $splitcomments[3];

	if($partfour){$qy=' AND bugtracker3_devc_timestamp NOT IN('.$splitcomments[3].')';}

	$sqlqry='SELECT bugtracker3_devc_timestamp FROM '.MPREFIX.'bugtracker3_developer_comments WHERE bugtracker3_devc_timestamp > '.USERLV.$qy;

		if ($sql->db_Select_gen($sqlqry)) {
			while ($row = $sql->db_Fetch()) {

				if (!$partfour){
				$partfour .= $row['bugtracker3_devc_timestamp'];
				}else{
				$partfour .= ','.$row['bugtracker3_devc_timestamp'];
				}

			}

	}


	unset ($partfive);
	$partfive = $splitcomments[4];

	if($partfive){$qy=' AND msg_id NOT IN('.$splitcomments[4].')';}

	$sqlqry='SELECT msg_id FROM '.$pref['onlineinfo_sa_copperminelocation'].'comments WHERE msg_date > '.USERLV.$qy;

		if ($sql->db_Select_gen($sqlqry)) {
			while ($row = $sql->db_Fetch()) {

				if (!$partfive){
				$partfive .= $row['msg_id'];
				}else{
				$partfive .= ','.$row['msg_id'];
				}

			}

	}



			$sql->db_Update("onlineinfo_read", "comments='".$partone."|".$parttwo."|".$partthree."|".$partfour."|".$partfive."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;

}


// END COMMENTS POSTING



if ($singleread[0] == 'marknewibfasread')
{
	unset ($u_new);

	$topic_id = intval($singleread[1]);

	if (!$ibfread){
				$u_new .= $topic_id;
				}else{
				$u_new .= $ibfread.','.$topic_id;
				}


	$sql->db_Update("onlineinfo_read", "ibf='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;
}


if (e_QUERY == 'mark_all_newibf_as_read')
{
unset ($u_new);
	$u_new = $ibfread;

		if($u_new){$qy=' AND topic_id NOT IN('.$u_new.')';}

	$qry = 'post_date > '.USERLV.$qy;
	$sqlqry='SELECT topic_id FROM '.$pref['onlineinfo_ibfprefix'].'topics WHERE '.$qry;

		if ($sql->db_Select_gen($sqlqry)) {
			while ($row = $sql->db_Fetch()) {

				if (!$u_new){
				$u_new .= $row['topic_id'];
				}else{
				$u_new .= ','.$row['topic_id'];
				}

			}

			$sql->db_Update("onlineinfo_read", "ibf='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;

	}

}

if ($singleread[0] == 'marknewgallerypostsasread')
{
	unset ($u_new);

	$g_id = intval($singleread[1]);

	if (!$galleryread){
				$u_new .= $g_id;
				}else{
				$u_new .= $galleryread.','.$g_id;
				}


	$sql->db_Update("onlineinfo_read", "gallery='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;
}


if (e_QUERY == 'mark_all_newgalleryposts_as_read')
{
unset ($u_new);
	$u_new = $galleryread;

	if($u_new){$qy=' AND g_id NOT IN('.$u_new.')';}

	$qry = 'g_viewedSinceTimestamp > '.USERLV.$qy;
	$sqlqry='SELECT g_id FROM '.$pref['onlineinfo_gallery2prefix'].'Item WHERE '.$qry;

		if ($sql->db_Select_gen($sqlqry)) {
			while ($row = $sql->db_Fetch()) {

				if (!$u_new){
				$u_new .= $row['g_id'];
				}else{
				$u_new .= ','.$row['g_id'];
				}

			}

			$sql->db_Update("onlineinfo_read", "gallery='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;

	}

}


if ($singleread[0] == 'marknewguestbookpostsasread')
{
	unset ($u_new);

	$id = intval($singleread[1]);

	if (!$guestbookread){
				$u_new .= $id;
				}else{
				$u_new .= $guestbookread.','.$id;
				}


	$sql->db_Update("onlineinfo_read", "guestbook='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;
}


if (e_QUERY == 'mark_all_newguestbookposts_as_read')
{
unset ($u_new);
	$u_new = $guestbookread;

	if($u_new){$qy=' AND id NOT IN('.$u_new.')';}

	$qry = 'date > '.USERLV.$qy;
		if ($sql->db_Select('guestbook', 'id', $qry)) {
			while ($row = $sql->db_Fetch()) {

				if (!$u_new){
				$u_new .= $row['id'];
				}else{
				$u_new .= ','.$row['id'];
				}

			}

			$sql->db_Update("onlineinfo_read", "guestbook='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;

	}

}

if ($singleread[0] == 'marknewjokepostsasread')
{
	unset ($u_new);

	$id = intval($singleread[1]);

	if (!$jokesread){
				$u_new .= $id;
				}else{
				$u_new .= $jokesread.','.$id;
				}


	$sql->db_Update("onlineinfo_read", "jokes='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;
}


if (e_QUERY == 'mark_all_newjokeposts_as_read')
{
unset ($u_new);
	$u_new = $jokesread;

	if($u_new){$qy=' AND joke_id NOT IN('.$u_new.')';}

	$qry = 'joke_approved=1 AND joke_posted > '.USERLV.$qy;
		if ($sql->db_Select('jokemenu_jokes', 'joke_id', $qry)) {
			while ($row = $sql->db_Fetch()) {

				if (!$u_new){
				$u_new .= $row['joke_id'];
				}else{
				$u_new .= ','.$row['joke_id'];
				}

			}

			$sql->db_Update("onlineinfo_read", "jokes='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;

	}

}

if ($singleread[0] == 'marksuggestionsasread')
{
	unset ($u_new);

	$id = intval($singleread[1]);

	if (!$suggestionsread){
				$u_new .= $id;
				}else{
				$u_new .= $suggestionsread.','.$id;
				}


	$sql->db_Update("onlineinfo_read", "suggestions='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;
}


if (e_QUERY == 'mark_all_suggestions_as_read')
{
unset ($u_new);
	$u_new = $suggestionsread;

	if($u_new){$qy=' AND suggestion_id NOT IN('.$u_new.')';}

	$qry = 'suggestion_approved=1 AND suggestion_posted > '.USERLV.$qy;
		if ($sql->db_Select('sugg_suggs', 'suggestion_id', $qry)) {
			while ($row = $sql->db_Fetch()) {

				if (!$u_new){
				$u_new .= $row['suggestion_id'];
				}else{
				$u_new .= ','.$row['suggestion_id'];
				}

			}

			$sql->db_Update("onlineinfo_read", "suggestions='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;

	}

}


if ($singleread[0] == 'marknewblogasread')
{
	unset ($u_new);

	$id = intval($singleread[1]);

	if (!$blogsread){
				$u_new .= $id;
				}else{
				$u_new .= $blogsread.','.$id;
				}


	$sql->db_Update("onlineinfo_read", "blogs='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;
}


if (e_QUERY == 'mark_allnewblog_as_read')
{
unset ($u_new);
	$u_new = $blogsread;

	if($u_new){$qy=' AND userjournals_id NOT IN('.$u_new.')';}

	$qry = 'userjournals_timestamp > '.USERLV.$qy;
		if ($sql->db_Select('userjournals', 'userjournals_id', $qry)) {
			while ($row = $sql->db_Fetch()) {

				if (!$u_new){
				$u_new .= $row['userjournals_id'];
				}else{
				$u_new .= ','.$row['userjournals_id'];
				}

			}

			$sql->db_Update("onlineinfo_read", "blogs='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;

	}

}



if ($singleread[0] == 'marknewpicturesasread')
{
	unset ($u_new);

	$pid = intval($singleread[1]);

	if (!$picturesread){
				$u_new .= $pid;
				}else{
				$u_new .= $picturesread.','.$pid;
				}


	$sql->db_Update("onlineinfo_read", "pictures='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;
}


if (e_QUERY == 'mark_all_newpictures_as_read')
{
unset ($u_new);
	$u_new = $picturesread;
	if($u_new){$qy=' AND pid NOT IN('.$u_new.')';}
	$qry = 'ctime > '.USERLV.$qy;
		if ($sql->db_Select('CPG_pictures', 'pid', $qry)) {
			while ($row = $sql->db_Fetch()) {

				if (!$u_new){
				$u_new .= $row['pid'];
				}else{
				$u_new .= ','.$row['pid'];
				}

			}

			$sql->db_Update("onlineinfo_read", "pictures='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;

	}

}

if ($singleread[0] == 'marknewcopperasread')
{
	unset ($u_new);

	$pid = intval($singleread[1]);

	if (!$copperread){
				$u_new .= $pid;
				}else{
				$u_new .= $copperread.','.$pid;
				}


	$sql->db_Update("onlineinfo_read", "copper='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;
}


if (e_QUERY == 'mark_all_newcopper_as_read')
{
unset ($u_new);
unset($qy);
	$u_new = $copperread;
	if($u_new){$qy=' AND pid NOT IN('.$u_new.')';}
	$qry = 'ctime > '.USERLV.$qy;
	$sqlqry='SELECT pid FROM '.$pref['onlineinfo_sa_coppermineprefix'].'pictures WHERE '.$qry;

		if ($sql->db_Select_gen($sqlqry)) {
			while ($row = $sql->db_Fetch()) {

				if (!$u_new){
				$u_new .= $row['pid'];
				}else{
				$u_new .= ','.$row['pid'];
				}

			}


			$sql->db_Update("onlineinfo_read", "copper='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;

	}

}





if ($singleread[0] == 'marknewmovieasread')
{
	unset ($u_new);

	$movie_id = intval($singleread[1]);

	if (!$moviesread){
				$u_new .= $movie_id;
				}else{
				$u_new .= $moviesread.','.$movie_id;
				}


	$sql->db_Update("onlineinfo_read", "movies='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;
}


if (e_QUERY == 'mark_all_newmovies_as_read')
{
unset ($u_new);
	$u_new = $moviesread;
	if($u_new){$qy=' AND movie_id NOT IN('.$u_new.')';}
	$qry = 'UNIX_TIMESTAMP(timestamp) > '.USERLV.$qy;
		if ($sql->db_Select('er_ytm_gallery_movies', 'movie_id', $qry)) {
			while ($row = $sql->db_Fetch()) {

				if (!$u_new){
				$u_new .= $row['movie_id'];
				}else{
				$u_new .= ','.$row['movie_id'];
				}

			}

			$sql->db_Update("onlineinfo_read", "movies='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;

	}

}



if ($singleread[0] == 'marknewgamesasread')
{
	unset ($u_new);

	$game_id = intval($singleread[1]);

	if (!$gamesread){
				$u_new .= $game_id;
				}else{
				$u_new .= $gamesread.','.$game_id;
				}


	$sql->db_Update("onlineinfo_read", "games='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;
}


if (e_QUERY == 'mark_all_newgames_as_read')
{
unset ($u_new);
	$u_new = $gamesread;
	if($u_new){$qy=' AND game_id NOT IN('.$u_new.')';}
	$qry = 'date_added > '.USERLV.$qy;
		if ($sql->db_Select('arcade_games', 'game_id', $qry)) {
			while ($row = $sql->db_Fetch()) {

				if (!$u_new){
				$u_new .= $row['game_id'];
				}else{
				$u_new .= ','.$row['game_id'];
				}

			}

			$sql->db_Update("onlineinfo_read", "games='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;

	}

}



if ($singleread[0] == 'marknewtopscoresasread')
{
	unset ($u_new);

	$champ_id = intval($singleread[1]);

	if (!$gametopread){
				$u_new .= $champ_id;
				}else{
				$u_new .= $gametopread.','.$champ_id;
				}


	$sql->db_Update("onlineinfo_read", "game_top='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;
}


if (e_QUERY == 'mark_all_newtopscores_as_read')
{
unset ($u_new);
	$u_new = $gametopread;
	if($u_new){$qy=' AND champ_id NOT IN('.$u_new.')';}
	$qry = 'date_scored > '.USERLV.$qy;
		if ($sql->db_Select('arcade_champs', 'champ_id', $qry)) {
			while ($row = $sql->db_Fetch()) {

				if (!$u_new){
				$u_new .= $row['champ_id'];
				}else{
				$u_new .= ','.$row['champ_id'];
				}

			}

			$sql->db_Update("onlineinfo_read", "game_top='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;

	}

}



if ($singleread[0] == 'marknewlinksasread')
{
	unset ($u_new);

	$link_id = intval($singleread[1]);

	if (!$linksread){
				$u_new .= $link_id;
				}else{
				$u_new .= $linksread.','.$link_id;
				}


	$sql->db_Update("onlineinfo_read", "links='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;
}


if (e_QUERY == 'mark_all_newlinks_as_read')
{
unset ($u_new);
	$u_new = $linksread;
	if($u_new){$qy=' AND link_id NOT IN('.$u_new.')';}
	$qry = 'link_datestamp > '.USERLV.$qy;
		if ($sql->db_Select('links_page', 'link_id', $qry)) {
			while ($row = $sql->db_Fetch()) {

				if (!$u_new){
				$u_new .= $row['link_id'];
				}else{
				$u_new .= ','.$row['link_id'];
				}

			}

			$sql->db_Update("onlineinfo_read", "links='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;

	}

}


if ($singleread[0] == 'marknewmemberasread')
{
	unset ($u_new);

	$user_id = intval($singleread[1]);

		if (!$sitemembersread){
				$u_new .= $user_id;
				}else{
				$u_new .= $sitemembersread.','.$user_id;
				}


	$sql->db_Update("onlineinfo_read", "sitemembers='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;
}


if (e_QUERY == 'mark_all_newmember_as_read')
{
unset ($u_new);
	$u_new = $sitemembersread;
	if($u_new){$qy=' AND user_id NOT IN('.$u_new.')';}
	$qry = 'user_join > '.USERLV.$qy;
		if ($sql->db_Select('user', 'user_id', $qry)) {
			while ($row = $sql->db_Fetch()) {

				if (!$u_new){
				$u_new .= $row['user_id'];
				}else{
				$u_new .= ','.$row['user_id'];
				}

			}

			$sql->db_Update("onlineinfo_read", "sitemembers='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;

	}

}



if ($singleread[0] == 'markdownloadsasread')
{
	unset ($u_new);

	$download_id = intval($singleread[1]);

			if (!$downloadsread){
				$u_new .= $download_id;
				}else{
				$u_new .= $downloadsread.','.$download_id;
				}


	$sql->db_Update("onlineinfo_read", "downloads='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;
}


if (e_QUERY == 'mark_all_downloads_as_read')
{
unset ($u_new);
	$u_new = $downloadsread;
	if($u_new){$qy=' AND download_id NOT IN('.$u_new.')';}
	$qry = 'download_datestamp > '.USERLV.$qy;
		if ($sql->db_Select('download', 'download_id', $qry)) {
			while ($row = $sql->db_Fetch()) {
				if (!$u_new){
				$u_new .= $row['download_id'];
				}else{
				$u_new .= ','.$row['download_id'];
				}
			}

			$sql->db_Update("onlineinfo_read", "downloads='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;

	}

}




if ($singleread[0] == 'marknewsasread')
{
	unset ($u_new);

	$news_id = intval($singleread[1]);

		if (!$newsread){
				$u_new .= $news_id;
				}else{
				$u_new .= $newsread.','.$news_id;
				}

	$sql->db_Update("onlineinfo_read", "news='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;
}

//Mark all News as read
if (e_QUERY == 'mark_all_news_as_read')
{
unset ($u_new);

$u_new = $newsread;
	if($u_new){$qy=' AND news_id NOT IN('.$u_new.')';}
	$qry = 'news_datestamp > '.USERLV.$qy;
		if ($sql->db_Select('news', 'news_id', $qry)) {
			while ($row = $sql->db_Fetch()) {
				if (!$u_new){
				$u_new .= $row['news_id'];
				}else{
				$u_new .= ','.$row['news_id'];
				}
			}

			$sql->db_Update("onlineinfo_read", "news='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;

	}

}

if ($singleread[0] == 'markchatboxasread')
{
	unset ($u_new);

	$cb_id = intval($singleread[1]);


	if (!$chatboxread){
				$u_new .= $cb_id;
				}else{
				$u_new .= $chatboxread.','.$cb_id;
				}


	$sql->db_Update("onlineinfo_read", "chatbox='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;
}

if (e_QUERY == 'mark_all_chatbox_as_read')
{
	unset ($u_new);
	$u_new = $newsread;
	if($u_new){$qy=' AND cb_id NOT IN('.$u_new.')';}
		$qry = 'cb_datestamp > '.USERLV.$qy;
		if ($sql->db_Select('chatbox', 'cb_id', $qry)) {
			while ($row = $sql->db_Fetch()) {
				if (!$u_new){
				$u_new .= $row['cb_id'];
				}else{
				$u_new .= ','.$row['cb_id'];
				}
			}

			$sql->db_Update("onlineinfo_read", "chatbox='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;
}
}


if ($singleread[0] == 'markchatbox2asread')
{
	unset ($u_new);

	$cb2_id = intval($singleread[1]);


	if (!$chatbox2read){
				$u_new .= $cb2_id;
				}else{
				$u_new .= $chatbox2read.','.$cb2_id;
				}


	$sql->db_Update("onlineinfo_read", "chatbox2='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;
}

if (e_QUERY == 'mark_all_chatbox2_as_read')
{
	unset ($u_new);
	$u_new = $newsread;
	if($u_new){$qy=' AND cb2_id NOT IN('.$u_new.')';}
		$qry = 'cb2_datestamp > '.USERLV.$qy;
		if ($sql->db_Select('chatbox2', 'cb2_id', $qry)) {
			while ($row = $sql->db_Fetch()) {
				if (!$u_new){
				$u_new .= $row['cb2_id'];
				}else{
				$u_new .= ','.$row['cb2_id'];
				}
			}

			$sql->db_Update("onlineinfo_read", "chatbox2='".$u_new."' WHERE user_id='".USERID."'");

	header("location:".e_SELF);
	exit;
}
}


$text = '<div style="text-align:center">
<table style="width:95%" class="fborder">';


// ************************************************************
// ******                  New News                      ******
// ************************************************************
if($pref['onlineinfo_shownews']==1){
	if($newsread != '')
		{
			$news_read = 'AND news_id NOT IN ('.$newsread.')';
		}


$script='SELECT '.MPREFIX.'news.*, '.MPREFIX.'user.user_name FROM '.MPREFIX.'news LEFT JOIN '.MPREFIX.'user ON '.MPREFIX.'news.news_author = '.MPREFIX.'user.user_id WHERE news_datestamp>'.$lvisit.' and news_class IN ('.USERCLASS_LIST.') '.$news_read.' ORDER BY news_datestamp DESC LIMIT 0,' . $pref['onlineinfo_newsnum'];


if($news_items = $sql->db_Select_gen($script)){

while ($row = $sql->db_Fetch()){
        extract($row);

	if(check_class($news_class)){
		$str .= '<a href="'.e_SELF.'?marknewsasread.'.$news_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  <a href="'.e_BASE.'news.php?item.'.$news_id.'">'.$news_title.'</a> <i>'.ONLINEINFO_LOGIN_MENU_L90.'</i> <a href="'.e_BASE.'user.php?id.'.$news_author.'" '.getuserclassinfo($news_author).'>'.$user_name.'</a><br />';
	}else{
		$news_items = $news_items - 1;
	}
}
}else{
    $str = ONLINEINFO_LIST_4;
}


$notnewsallread='';
if($news_items !=0){

	$notnewsallread='  <i><a href="'.e_SELF.'?mark_all_news_as_read">['.ONLINEINFO_LOGIN_MENU_L91.']</a></i>';
}

if (!$news_items){$news_items=0;}

$text .= '<tr>
<td class="fcaption">'.ONLINEINFO_LIST_1.' ('.$news_items.')'.$notnewsallread.'</td>
</tr><tr>
<td class="forumheader3">'.$str.'</td>
</tr>';
}

// ************************************************************
// ******                  New Content                   ******
// ************************************************************

if($pref['onlineinfo_content']==1){
// content
unset($str);

if($contentsread != '')
		{
			$contents_read = 'AND content_id NOT IN ('.$contentsread.')';
		}

$content_items = $sql -> db_Select("pcontent", "*", "content_datestamp>$lvisit AND content_parent!='0' and content_class IN (".USERCLASS_LIST.") ".$contents_read." ORDER BY content_datestamp DESC LIMIT 0," . $pref['onlineinfo_contentsnum'] . "");
while($row = $sql -> db_Fetch()){
	extract($row);


				$str .= '<a href="'.e_SELF.'?markcontentsasread.'.$content_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  <a href="'.e_PLUGIN.'content/content.php?content.'.$content_id.'">'.$content_heading.'</a><br />';


}
if(!$content_items){
	$str = ONLINEINFO_LIST_4;
}

$notnewcontentsallread='';
if($content_items !=0){

	$notnewcontentsallread='  <i><a href="'.e_SELF.'?mark_all_newcontents_as_read">['.ONLINEINFO_LOGIN_MENU_L91.']</a></i>';
}

$text .= '<tr>
<td class="fcaption">'.ONLINEINFO_LIST_21.' ('.$content_items.') '.$notnewcontentsallread.'</td>
</tr><tr>
<td class="forumheader3">'.$str.'</td>
</tr>';

}

// ************************************************************
// ******                New Comments                    ******
// ************************************************************
if ($pref['onlineinfo_showcomments'] == 1)
    {


$splitcomments= explode('|',$commentsread);

	if($splitcomments[0] != '')
		{

			$ecomments = 'AND comment_id NOT IN ('.$splitcomments[0].')';
		}


unset($str);
$comment_count=0;

$str = '';

if($comments = $sql -> db_Select("comments", "*", "comment_datestamp>$lvisit ".$ecomments." ORDER BY comment_datestamp DESC LIMIT 0," . $pref['onlineinfo_commentsnum'] . "")){
	while($row = $sql -> db_Fetch()){
		extract($row);


$author= explode('.',$comment_author);


if($author[0]==0){
	$astr=$author[1];
	}else{
	$astr='<a href="'.e_BASE.'user.php?id.'.$author[0].'" '.getuserclassinfo($author[0]).'>'.$author[1].'</a>';
		}

		if ($comment_type=='profile'){$comment_type=999;}
		if ($comment_type=='links_page'){$comment_type=998;}
		if ($comment_type=='pcontent'){$comment_type=997;}
		if ($comment_type=='bugtrack3'){$comment_type=996;}
		if ($comment_type=='jokemenu'){$comment_type=995;}
		if ($comment_type=='userjourna'){$comment_type=994;}
		if ($comment_type=='sugg_suggs'){$comment_type=993;}
		if ($comment_type=='page'){$comment_type=992;}
		if ($comment_type=='krooze'){$comment_type=991;}
		if ($comment_type=='agenda'){$comment_type=990;}

		switch($comment_type){

			case 0:	// news
				$sql2 -> db_Select("news", "*", "news_id=$comment_item_id ");
				$row = $sql2 -> db_Fetch(); extract($row);
				if(check_class($news_class)){

					$str .= '<div><span><a href="'.e_SELF.'?markcommentasread.'.$comment_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  </span><span>[ '.ONLINEINFO_LIST_1.' ]&nbsp;</span><span><a href="'.e_BASE.'comment.php?comment.news.'.$comment_item_id.'">'.$news_title.'</a></span><span>'.ONLINEINFO_LIST_41.$astr.'</span></div>';
					$comment_count++;
				}
			break;

			case 1:	//	article, review or content page
				//	find out whether article, review or content page ...
				$sql2 -> db_Select("pcontent", "content_heading, content_type, content_class", "content_id=$comment_item_id ");
				$row = $sql2 -> db_Fetch();
				extract($row);

							$str .= '<div><span><a href="'.e_SELF.'?markcommentasread.'.$comment_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  </span><span>[ '.ONLINEINFO_LIST_15.' ]&nbsp;</span><span><a href="'.e_PLUGIN.'content/content.php?content.'.$content_id.'">'.$content_heading.'</a></span><span>'.ONLINEINFO_LIST_41.$astr.'</span></div>';

			break;

			case 2: //	downloads
				$mp = MPREFIX;
				$qry = "SELECT download_name, {$mp}download_category.download_category_class FROM {$mp}download LEFT JOIN {$mp}download_category ON {$mp}download.download_category={$mp}download_category.download_category_id WHERE {$mp}download.download_id={$comment_item_id}";
				$sql2 -> db_Select_gen($qry);
				$row = $sql2 -> db_Fetch();
				extract($row);
				if(check_class($download_category_class)){
					$str .= '<div><span><a href="'.e_SELF.'?markcommentasread.'.$comment_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  </span><span>[ '.ONLINEINFO_LIST_17.' ]&nbsp;</span><span><a href="'.e_BASE.'download.php?view.'.$comment_item_id.'">'.$download_name.'</a></span><span>'.ONLINEINFO_LIST_41.$astr.'</span></div>';
					$comment_count++;
				}
			break;

			case 3: //	faq
				$sql2 -> db_Select("faq", "faq_question", "faq_id=$comment_item_id ");
				$row = $sql2 -> db_Fetch(); extract($row);
				$str .= '<div><span><a href="'.e_SELF.'?markcommentasread.'.$comment_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  </span><span>[ '.ONLINEINFO_LIST_18.' ]&nbsp;</span><span><a href="'.e_PLUGIN.'faq/faq.php?view.'.$comment_item_id.'">'.$faq_question.'</a></span><span>'.ONLINEINFO_LIST_41.$astr.'</span></div>';
					$comment_count++;
			break;

			case 4:	//	poll comment
				$sql2 -> db_Select("polls", "*", "poll_id=$comment_item_id ");
				$row = $sql2 -> db_Fetch(); extract($row);
				$str .= '<div><span><a href="'.e_SELF.'?markcommentasread.'.$comment_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  </span><span>[ '.ONLINEINFO_LIST_19.' ]&nbsp;</span><span><a href="'.e_BASE.'comment.php?comment.poll.'.$comment_item_id.'">'.$poll_title.'</a></span><span>'.ONLINEINFO_LIST_41.$astr.'</span></div>';
					$comment_count++;
			break;

			case 6:	//	bugtracker (old version))
				$sql2 -> db_Select("bugtrack", "bugtrack_summary", "bugtrack_id=$comment_item_id ");
				$row = $sql2 -> db_Fetch(); extract($row);
				$str .= '<div><span><a href="'.e_SELF.'?markcommentasread.'.$comment_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  </span><span>[ '.ONLINEINFO_LIST_20.' ]&nbsp;</span><span><a href="'.e_PLUGIN.'bugtracker/bugtracker.php?show.'.$comment_item_id.'">'.$bugtrack_summary.'</a></span><span>'.ONLINEINFO_LIST_41.$astr.'</span></div>';
					$comment_count++;
			break;





		case 990:	//	agenda

				$sql2 -> db_Select("agenda", "agn_title, agn_start", "agn_id=$comment_item_id ");
				$row = $sql2 -> db_Fetch(); extract($row);
				$str .= '<div><span><a href="'.e_SELF.'?markcommentasread.'.$comment_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  </span><span>[ '.ONLINEINFO_LIST_62.' ]&nbsp;</span><span><a href="'.e_PLUGIN.'agenda/agenda.php?viewitem.1.'.$comment_item_id.'.'.$agn_start.'">'.$agn_title.'</a></span><span>'.ONLINEINFO_LIST_41.$astr.'</span></div>';


		$comment_count++;
	break;





		case 991:	//	krooze

				$sql2 -> db_Select("arcade_games", "game_title", "game_id=$comment_item_id ");
				$row = $sql2 -> db_Fetch(); extract($row);
				$str .= '<div><span><a href="'.e_SELF.'?markcommentasread.'.$comment_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  </span><span>[ '.ONLINEINFO_LIST_61.' ]&nbsp;</span><span><a href="'.e_PLUGIN.'kroozearcade_menu/play.php?gameid='.$comment_item_id.'">'.$game_title.'</a></span><span>'.ONLINEINFO_LIST_41.$astr.'</span></div>';


		$comment_count++;
	break;





	case 992:	//	pages

				$sql2 -> db_Select("page", "page_title", "page_id=$comment_item_id ");
				$row = $sql2 -> db_Fetch(); extract($row);
				$str .= '<div><span><a href="'.e_SELF.'?markcommentasread.'.$comment_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  </span><span>[ '.ONLINEINFO_LIST_60.' ]&nbsp;</span><span><a href="'.e_BASE.'page.php?'.$comment_item_id.'">'.$page_title.'</a></span><span>'.ONLINEINFO_LIST_41.$astr.'</span></div>';


		$comment_count++;
	break;


	case 993:	//	Suggestions

				$sql2 -> db_Select("sugg_suggs", "suggestion_name", "suggestion_id=$comment_item_id ");
				$row = $sql2 -> db_Fetch(); extract($row);
				$str .= '<div><span><a href="'.e_SELF.'?markcommentasread.'.$comment_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  </span><span>[ '.ONLINEINFO_LIST_59.' ]&nbsp;</span><span><a href="'.e_PLUGIN.'suggestions_menu/suggestions.php?0.view.'.$comment_item_id.'">'.$suggestion_name.'</a></span><span>'.ONLINEINFO_LIST_41.$astr.'</span></div>';
		$comment_count++;

	break;




	case 994:	//	blog user journal

				$sql2 -> db_Select("userjournals", "userjournals_subject", "userjournals_id=$comment_item_id ");
				$row = $sql2 -> db_Fetch(); extract($row);
				$str .= '<div><span><a href="'.e_SELF.'?markcommentasread.'.$comment_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  </span><span>[ '.ONLINEINFO_LIST_58.' ]&nbsp;</span><span><a href="'.e_PLUGIN.'userjournals_menu/userjournals.php?blog.'.$comment_item_id.'">'.$userjournals_subject.'</a></span><span>'.ONLINEINFO_LIST_41.$astr.'</span></div>';
		$comment_count++;

	break;

	case 995:	//	jokes

				$sql2 -> db_Select("jokemenu_jokes", "joke_name", "joke_id=$comment_item_id ");
				$row = $sql2 -> db_Fetch(); extract($row);
				$str .= '<div><span><a href="'.e_SELF.'?markcommentasread.'.$comment_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  </span><span>[ '.ONLINEINFO_LIST_57.' ]&nbsp;</span><span><a href="'.e_PLUGIN.'jokes_menu/jokes.php?0.view.'.$comment_item_id.'">'.$joke_name.'</a></span><span>'.ONLINEINFO_LIST_41.$astr.'</span></div>';
		$comment_count++;

	break;

			case 996:	//	bugtracker 3

			$qry='SELECT '.MPREFIX.'bugtracker3_bugs.bugtracker3_bugs_summary,'.MPREFIX.'bugtracker3_bugs.bugtracker3_bugs_application_id, '.MPREFIX.'bugtracker3_apps.bugtracker3_apps_name FROM '.MPREFIX.'bugtracker3_bugs LEFT JOIN '.MPREFIX.'bugtracker3_apps ON '.MPREFIX.'bugtracker3_bugs.bugtracker3_bugs_application_id = '.MPREFIX.'bugtracker3_apps.bugtracker3_apps_id WHERE '.MPREFIX.'bugtracker3_bugs.bugtracker3_bugs_id='.$comment_item_id;



				$sql2 -> db_Select_gen($qry);
				$row = $sql2 -> db_Fetch(); extract($row);
				$str .= '<div><span><a href="'.e_SELF.'?markcommentasread.'.$comment_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  </span><span>[ '.ONLINEINFO_LIST_20.' ]&nbsp;</span><span>'.ONLINEINFO_LOGIN_MENU_L106.'<a href="'.e_PLUGIN.'bugtracker3/bugtracker3.php?1.'.$bugtracker3_bugs_application_id.'">'.$bugtracker3_apps_name.'</a> '.ONLINEINFO_LOGIN_MENU_L107.'<a href="'.e_PLUGIN.'bugtracker3/bugtracker3.php?2.'.$comment_item_id.'">'.$bugtracker3_bugs_summary.'</a></span><span>'.ONLINEINFO_LIST_41.$astr.'</span></div>';
					$comment_count++;
			break;


			case 997: // pcontent pages

							$sql2 -> db_Select("pcontent", "content_heading", "content_id=$comment_item_id ");
							$row = $sql2 -> db_Fetch(); extract($row);
							$str .= '<div><span><a href="'.e_SELF.'?markcommentasread.'.$comment_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  </span><span>[ '.ONLINEINFO_LIST_33.' ]&nbsp;</span><span><a href="'.e_PLUGIN.'content/content.php?content.'.$comment_item_id.'">'.$content_heading.'</a></span><span>'.ONLINEINFO_LIST_41.$astr.'</span></div>';
					$comment_count++;

			break;


			case 998: // link pages

							$sql2 -> db_Select("links_page", "link_name", "link_id=$comment_item_id ");
							$row = $sql2 -> db_Fetch(); extract($row);
							$str .= '<div><span><a href="'.e_SELF.'?markcommentasread.'.$comment_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  </span><span>[ '.ONLINEINFO_LIST_32.' ]&nbsp;</span><span><a href="'.e_PLUGIN.'links_page/links.php?comment.'.$comment_item_id.'">'.$link_name.'</a></span><span>'.ONLINEINFO_LIST_41.$astr.'</span></div>';
					$comment_count++;

			break;


			case 999:	//	profile
							$sql2 -> db_Select("user", "*", "user_id=$comment_item_id ");
							$row = $sql2 -> db_Fetch(); extract($row);
							$str .= '<div><span><a href="'.e_SELF.'?markcommentasread.'.$comment_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  </span><span>[ '.ONLINEINFO_LIST_24.' ]&nbsp;</span><span><a href="'.e_BASE.'user.php?id.'.$comment_item_id.'" '.getuserclassinfo($comment_item_id).'>'.$user_name.'</a></span><span>'.ONLINEINFO_LIST_41.$astr.'</span></div>';
								$comment_count++;
			break;

		}

	}
}




if ($pref['onlineinfo_bugtracker3'] == 1)
{
	if($splitcomments[3] != '')
		{
			$btcomments = 'AND bugtracker3_devc_timestamp NOT IN ('.$splitcomments[3].')';
		}


$query='SELECT '.MPREFIX.'bugtracker3_developer_comments.*, '.MPREFIX.'user.user_name FROM '.MPREFIX.'bugtracker3_developer_comments LEFT JOIN '.MPREFIX.'user ON '.MPREFIX.'bugtracker3_developer_comments.bugtracker3_devc_poster = '.MPREFIX.'user.user_id WHERE bugtracker3_devc_timestamp >'.$lvisit.' '.$btcomments.' ORDER BY bugtracker3_devc_timestamp DESC LIMIT 0 , '.$pref['onlineinfo_bugtracker3commentsnum'];


$astr="";

	if($new_bugtracker3_comments = $sql -> db_Select_gen($query)){

		while($row = $sql -> db_Fetch()){
			extract($row);
			$astr='<a href="'.e_BASE.'user.php?id.'.$bugtracker3_devc_poster.'" '.getuserclassinfo($bugtracker3_devc_poster).'>'.$user_name.'</a>';

			   $str .= '<div><span><a href="'.e_SELF.'?markbtcommentasread.'.$row['bugtracker3_devc_timestamp'].'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  </span><span>[ '.ONLINEINFO_LIST_43.' ]&nbsp;</span><span><a href="'.e_PLUGIN.'bugtracker3/bugtracker3.php?2.'.$bugtracker3_devc_bugid.'">'.$bugtracker3_devc_comment.'</a></span><span>'.ONLINEINFO_LIST_41.$astr.'</span></div>';
			   $comment_count++;


			}
	}


}





if ($pref['onlineinfo_coppermine'] == 1)
{

	if($splitcomments[1] != '')
		{
			$ccomments = 'AND msg_id NOT IN ('.$splitcomments[1].')';
		}


$query='SELECT * FROM '.MPREFIX.'CPG_comments WHERE UNIX_TIMESTAMP( msg_date ) >'.$lvisit.' '.$ccomments.' ORDER BY msg_date DESC LIMIT 0 , '.$pref['onlineinfo_copperminecommentsnum'];

	if($new_pic_comments = $sql -> db_Select_gen($query)){

		while($row = $sql -> db_Fetch()){
					extract($row);

if($author_id==0){
	$astr=$msg_author;
	}else{
	$astr='<a href="'.e_BASE.'user.php?id.'.$author_id.'" '.getuserclassinfo($author_id).'>'.$msg_author.'</a>';
		}

			$qry='SELECT title FROM '.MPREFIX.'CPG_pictures WHERE pid='.$row['pid'];

			if ($sql->db_Select_gen($qry)) {
			while ($row2 = $sql->db_Fetch()) {

			$pictitle=$row2['title'];
											}
											}


			   $str .= '<div><span><a href="'.e_SELF.'?markccommentasread.'.$row['msg_id'].'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  </span><span>[ '.ONLINEINFO_LIST_29.' ]&nbsp;</span><span><a href="'.e_PLUGIN.'coppermine_menu/displayimage.php?pos=-'.$row['pid'].'">'.$pictitle.'</a></span><span>'.ONLINEINFO_LIST_41.$astr.'</span></div>';
			   $comment_count++;


			}
	}


}

if ($pref['onlineinfo_sa_coppermineuse'] == 1)
{

	if($splitcomments[4] != '')
		{
			$cpgcomments = 'AND msg_id NOT IN ('.$splitcomments[4].')';
		}


$query='SELECT '.$pref['onlineinfo_sa_coppermineprefix'].'comments.*, '.$pref['onlineinfo_sa_coppermineprefix'].'users.user_name FROM '.$pref['onlineinfo_sa_coppermineprefix'].'comments
LEFT JOIN '.$pref['onlineinfo_sa_coppermineprefix'].'users ON '.$pref['onlineinfo_sa_coppermineprefix'].'comments.author_id = '.$pref['onlineinfo_sa_coppermineprefix'].'users.user_id
WHERE UNIX_TIMESTAMP( msg_date ) >'.$lvisit.' '.$cpgcomments.' ORDER BY msg_date DESC LIMIT 0 , '.$pref['onlineinfo_sa_coppermineshownum'];

	if($new_cpg_comments = $sql -> db_Select_gen($query)){

		while($row = $sql -> db_Fetch()){
					extract($row);

			$qry='SELECT title FROM '.$pref['onlineinfo_sa_coppermineprefix'].'pictures WHERE pid='.$row['pid'];

			if ($sql->db_Select_gen($qry)) {
			while ($row2 = $sql->db_Fetch()) {

			$pictitle=$row2['title'];
											}
											}


			   $str .= '<div><span><a href="'.e_SELF.'?markcpgcommentasread.'.$row['msg_id'].'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  </span><span>[ '.ONLINEINFO_LIST_56.' ]&nbsp;</span><span><a href="'.SITEURL.$pref['onlineinfo_sa_copperminelocation'].'/displayimage.php?pos=-'.$row['pid'].'">'.$pictitle.'</a></span><span>'.ONLINEINFO_LIST_41.' '.$user_name.'</span></div>';
			   $comment_count++;


			}
	}


}




if ($pref['onlineinfo_gallery2use'] == 1)
    {
		$whereto = $pref['onlineinfo_gallery2window'];

		if($splitcomments[2] != "")
		{
			$gcomments = 'AND g_id NOT IN ('.$splitcomments[2].')';
		}

		$query='SELECT com . *, usr.g_userName, it.g_title, it.g_id AS imageid FROM '.$pref['onlineinfo_gallery2prefix'].'Comment as com
				LEFT JOIN '.$pref['onlineinfo_gallery2prefix'].'ChildEntity as cd ON com.g_id = cd.g_id
				LEFT JOIN '.$pref['onlineinfo_gallery2prefix'].'User as usr ON com.g_commenterId = usr.g_id
				LEFT JOIN '.$pref['onlineinfo_gallery2prefix'].'Item as it ON cd.g_parentId = it.g_id
				WHERE g_date >'.$lvisit.' '.$gcomments.' ORDER BY g_date DESC';


	if($new_gallery_comments = $sql -> db_Select_gen($query)){

		while($row = $sql -> db_Fetch()){
					extract($row);


		if($whereto=='e107'){


					   $str .= '<div><span><a href="'.e_SELF.'?markgcommentasread.'.$g_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  </span><span>[ '.ONLINEINFO_LIST_34.' ]&nbsp;</span><span><a href="'.e_PLUGIN.'onlineinfo_menu/gallery2.php?id.'.$imageid.'">'.$g_title.'</a></span><span>'.ONLINEINFO_LIST_41.$g_userName.'</span></div>';


		}else{

							   $str .= '<div><span><a href="'.e_SELF.'?markgcommentasread.'.$g_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  </span><span>[ '.ONLINEINFO_LIST_34.' ]&nbsp;</span><span><a href="'.SITEURL.$pref['onlineinfo_gallery2location'].'/main.php?g2_itemId='.$imageid.'">'.$g_title.'</a></span><span>'.ONLINEINFO_LIST_41.$g_userName.'</span></div>';

	}
	 $comment_count++;

		}
		}
	}



if($comment_count==0){
	$str = ONLINEINFO_LIST_4;
}else{

$str .='';

}

$notcommentsallread='';
if($comment_count !=0){

	$notcommentsallread='  <i><a href="'.e_SELF.'?mark_all_comments_as_read">['.ONLINEINFO_LOGIN_MENU_L91.']</a></i>';
}


$text .= '<tr>
<td class="fcaption">'.ONLINEINFO_LIST_2.' ('.$comment_count.') '.$notcommentsallread.'</td>
</tr><tr>
<td class="forumheader3">'.$str.'</td>
</tr>';

}

// ************************************************************
// ******                  New Chatbox                   ******
// ************************************************************

if ($pref['onlineinfo_chatbox'] == 1)
    {

    		if($chatboxread != '')
		{
			$chatbox_read = 'AND cb_id NOT IN ('.$chatboxread.')';
		}


unset($str);


$str = '<table width="100%">';

if($chatbox_posts = $sql -> db_Select("chatbox", "*", "cb_datestamp>".$lvisit." ".$chatbox_read." ORDER BY cb_datestamp DESC LIMIT 0," . $pref['onlineinfo_chatnum'] . "")){
	while($row = $sql -> db_Fetch()){
		extract($row);
		$cb_nickid = substr($cb_nick , 0, strpos($cb_nick , '.'));
		$cb_nick = substr($cb_nick , (strpos($cb_nick , '.')+1));

		$str .='<tr><td width="18px"><a href="'.e_SELF.'?markchatboxasread.'.$cb_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  </td><td width="10%" nowrap>[ <a href="'.e_BASE.'user.php?id.'.$cb_nickid.'" '.getuserclassinfo($cb_nickid).'>'.$cb_nick.'</a> ] </td><td> '.$cb_message.'</td></tr>';
	}
}

if($chatbox_posts==0){
	$str = ONLINEINFO_LIST_4;
}else{

$str .='</table>';
}

$notchatboxallread='';
if($chatbox_posts !=0){

	$notchatboxallread='  <i><a href="'.e_SELF.'?mark_all_chatbox_as_read">['.ONLINEINFO_LOGIN_MENU_L91.']</a></i>';
}



$text .= '<tr>
<td class="fcaption">'.ONLINEINFO_LIST_5.' ('.$chatbox_posts.') '.$notchatboxallread.'</td>
</tr><tr>
<td class="forumheader3">'.$str.'</td>
</tr>';

}




// ************************************************************
// ******                  New Chatbox II                ******
// ************************************************************

if ($pref['onlineinfo_chatboxII'] == 1)
    {

    		if($chatbox2read != '')
		{
			$chatbox2_read = 'AND cb2_id NOT IN ('.$chatbox2read.')';
		}


unset($str);

$str = '<table width="100%">';

if($chatbox2_posts = $sql -> db_Select("chatbox2", "*", "cb2_datestamp>".$lvisit." ".$chatbox2_read." ORDER BY cb2_datestamp DESC LIMIT 0," . $pref['onlineinfo_chatIInum'] . "")){
	while($row = $sql -> db_Fetch()){
		extract($row);
		$cb2_nickid = substr($cb2_nick , 0, strpos($cb2_nick , '.'));
		$cb2_nick = substr($cb2_nick , (strpos($cb2_nick , '.')+1));

		$str .='<tr><td width="18px"><a href="'.e_SELF.'?markchatbox2asread.'.$cb2_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  </td><td width="10%" nowrap>[ <a href="'.e_BASE.'user.php?id.'.$cb2_nickid.'" '.getuserclassinfo($cb2_nickid).'>'.$cb2_nick.'</a> ] </td>';

	if($cb2_color==''){
		$str.='<td>'.$cb2_message.'</td></tr>';
		}else{
		$str.='<td style="color: #'.$cb2_color.';"> '.$cb2_message.'</td></tr>';
		}




	}
}

if($chatbox2_posts==0){
	$str = ONLINEINFO_LIST_4;
}else{

$str .='</table>';
}

$notchatbox2allread='';
if($chatbox2_posts !=0){

	$notchatbox2allread='  <i><a href="'.e_SELF.'?mark_all_chatbox2_as_read">['.ONLINEINFO_LOGIN_MENU_L91.']</a></i>';
}




$text .= '<tr>
<td class="fcaption">'.ONLINEINFO_LIST_54.' ('.$chatbox2_posts.') '.$notchatbox2allread.'</td>
</tr><tr>
<td class="forumheader3">'.$str.'</td>
</tr>';

}




// ************************************************************
// ******           New Forum Post (Summary)             ******
// ************************************************************

// FORUM
 if ($pref['onlineinfo_forum'] == 1)
    {



require_once(e_PLUGIN.'forum/forum_class.php');
$forum = new e107forum;



if ($singleread[0] == 'markasread')
{
	$splitoutthreads = str_replace(',','.',$singleread[1]);


	unset ($u_new);
		$u_new = USERVIEWED.'.'.$splitoutthreads;
		$sql->db_Update("user", "user_viewed='$u_new' WHERE user_id=".USERID);


	header("location:".e_SELF);
	exit;
}

//Mark all threads as read
if (e_QUERY == 'mark_all_as_read')
{

unset ($u_new);

	$qry = 'thread_lastpost > '.USERLV;
		if ($sql->db_Select('forum_t', 'thread_id', $qry)) {
			while ($row = $sql->db_Fetch()) {
				$u_new .= '.'.$row['thread_id'].'.';
			}
		$u_new .= USERVIEWED;
			$sql->db_Update("user", "user_viewed='".$u_new."' WHERE user_id='".USERID."' ");


	header("location:".e_SELF);
	exit;
	}
}



unset($str);

$userviewed = USERVIEWED;

$viewed = '';
		if($userviewed)
		{
			$viewed = cleanup($userviewed);
		}
		if($viewed != '')
		{
			$viewed = ' AND ft.thread_id NOT IN ('.$viewed.')';
		}

	$oloop=0;

if($pref['onlineinfo_forum_summary']==1){




// check for new Threads
$qry="SELECT ft.*, fp.thread_name as post_subject, fp.thread_total_replies as replies, u.user_id, f.forum_name,f.forum_id, u.user_name, f.forum_class
		FROM #forum_t AS ft
		LEFT JOIN #forum_t as fp ON fp.thread_id = ft.thread_parent
		LEFT JOIN #user as u ON u.user_id = SUBSTRING_INDEX(ft.thread_user,'.',1)
		LEFT JOIN #forum as f ON f.forum_id = ft.thread_forum_id
		WHERE ft.thread_datestamp > ".$lvisit. "
		AND f.forum_class IN (".USERCLASS_LIST.")
		AND ft.thread_parent = 0
		".$viewed."
		ORDER BY ft.thread_datestamp DESC LIMIT 0, ".$pref['onlineinfo_forumnum'];



$forum_posts_sql = new db;
$forum_posts = $forum_posts_sql->db_Select_gen($qry);
$newthreads = $forum_posts;

unset($replies);

while ($row = $forum_posts_sql->db_Fetch())
	{
		extract($row);
		$userinfostarter = explode('.',$thread_user);
		$lastposter = explode('.',$thread_lastuser);
		$foundnewthread=$thread_id;

$str.='<tr><td width="18px"><a href="'.e_SELF.'?markasread.'.$thread_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a></td><td style="text-align:left;">[ <a href="'.e_PLUGIN.'forum/forum_viewforum.php?$forum_id">'.$forum_name.'</a> ] <b>'.ONLINEINFO_LOGIN_MENU_L95.'</b> <a href="'.e_PLUGIN.'forum/forum_viewtopic.php?'.$thread_id.'.post">'.$thread_name.'</a></td><td style="text-align:center;"><a href="'.e_BASE.'user.php?id.'.$userinfostarter[0].'" '.getuserclassinfo($userinfostarter[0]).'>'.$userinfostarter[1].'</a></td><td style="text-align:center; font-weight: bold;">';


//check for new replies on New Thread

		$qry="SELECT ft.*, fp.thread_name as post_subject, fp.thread_total_replies as replies, u.user_id, f.forum_name,f.forum_id, u.user_name, f.forum_class
		FROM #forum_t AS ft
		LEFT JOIN #forum_t as fp ON fp.thread_id = ft.thread_parent
		LEFT JOIN #user as u ON u.user_id = SUBSTRING_INDEX(ft.thread_user,'.',1)
		LEFT JOIN #forum as f ON f.forum_id = ft.thread_forum_id
		WHERE ft.thread_datestamp > ".$lvisit. "
		AND f.forum_class IN (".USERCLASS_LIST.")
		AND ft.thread_parent = ".$foundnewthread."
		".$viewed."
		ORDER BY ft.thread_datestamp DESC LIMIT 0, ".$pref['onlineinfo_forumnum'];



		$forum_replies_sql = new db;
		$forum_replies = $forum_replies_sql->db_Select_gen($qry);

		if (!$forum_replies){$forum_replies=0;}

		$str.=$forum_replies.'</td><td style="text-align:center;"><a href="'.e_BASE.'user.php?id.'.$lastposter[0].'" '.getuserclassinfo($lastposter[0]).'>'.$lastposter[1].'</a></td></tr>';

		while ($row2 = $forum_replies_sql->db_Fetch())
		{
		extract($row2);

			if ($oloop==0){
				$preplies .=$row2['thread_id'];
				$oloop=1;
			}else{
				$preplies .=','.$row2['thread_id'];

			}

		$forum_posts++;

		}

	}


		if($preplies != '')
		{
			$replied = ' AND ft.thread_id NOT IN('.$preplies.')';
		}



$qry="SELECT ft.thread_parent, Count( ft.thread_parent ) AS countedreplies
		FROM #forum_t AS ft
		LEFT JOIN #forum_t as fp ON fp.thread_id = ft.thread_parent
		LEFT JOIN #user as u ON u.user_id = SUBSTRING_INDEX(ft.thread_user,'.',1)
		LEFT JOIN #forum as f ON f.forum_id = ft.thread_forum_id
		WHERE ft.thread_datestamp > ".$lvisit. "
		AND f.forum_class IN (".USERCLASS_LIST.")
		AND ft.thread_parent <> 0
		".$replied."
		".$viewed."
		GROUP BY ft.thread_parent
		ORDER BY ft.thread_datestamp DESC LIMIT 0, ".$pref['onlineinfo_forumnum'];

$forum_otherreplies_sql = new db;
$forum_replies = $forum_otherreplies_sql->db_Select_gen($qry);
while ($row = $forum_otherreplies_sql->db_Fetch())
	{
		extract($row);
		$threadparent=$thread_parent;
		$countedreplies=$countedreplies;
		$forum_posts = $forum_posts + $countedreplies;



$qry="SELECT ft.*,fp.thread_name as post_subject, f.forum_name,f.forum_id, tf.thread_user as thread_poster
FROM #forum_t AS ft
LEFT JOIN #forum_t as fp ON fp.thread_id = ft.thread_parent
LEFT JOIN #forum as f ON f.forum_id = ft.thread_forum_id
LEFT JOIN #forum_t as tf ON ft.thread_parent = tf.thread_id
WHERE ft.thread_datestamp > ".$lvisit. "
AND f.forum_class IN (".USERCLASS_LIST.")
AND ft.thread_parent = ".$threadparent."
".$viewed."
ORDER BY ft.thread_datestamp DESC LIMIT 0,1";

$qury="SELECT ft.thread_id as tid
FROM #forum_t AS ft
LEFT JOIN #forum_t as fp ON fp.thread_id = ft.thread_parent
LEFT JOIN #forum as f ON f.forum_id = ft.thread_forum_id
LEFT JOIN #forum_t as tf ON ft.thread_parent = tf.thread_id
WHERE ft.thread_datestamp > ".$lvisit. "
AND f.forum_class IN (".USERCLASS_LIST.")
AND ft.thread_parent = ".$threadparent."
".$viewed."
ORDER BY ft.thread_datestamp";

unset($getallthreadids);

	$sql2->db_Select_gen($qury);
		while ($row3 = $sql2->db_Fetch())
	{
		extract($row3);
		if(!$getallthreadids){
		$getallthreadids =$row3['tid'];
		}else{
		$getallthreadids .=','.$row3['tid'];
		}
	}

$forum_otherreplied_sql = new db;
$forum_replies = $forum_otherreplied_sql->db_Select_gen($qry);
while ($row2 = $forum_otherreplied_sql->db_Fetch())
	{
		extract($row2);

		$thread_poster = explode('.',$row2['thread_poster']);
		$thread_user  = explode('.',$row2['thread_user']);

$str.='<tr><td width="18px"><a href="'.e_SELF.'?markasread.'.$getallthreadids.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a></td><td style="text-align:left;">[ <a href="'.e_PLUGIN.'forum/forum_viewforum.php?'.$forum_id.'">'.$forum_name.'</a> ] <a href="'.e_PLUGIN.'forum/forum_viewtopic.php?'.$thread_id.'.post">'.$post_subject.'</a></td><td style="text-align:center;"><a href="'.e_BASE.'user.php?id.'.$thread_poster[0].'" '.getuserclassinfo($thread_poster[0]).'>'.$thread_poster[1].'</a></td><td style="text-align:center; font-weight: bold;">'.$countedreplies.'</td><td style="text-align:center;"><a href="'.e_BASE.'user.php?id.'.$thread_user[0].'" '.getuserclassinfo($thread_user[0]).'>'.$thread_user[1].'</a></td></tr>';


}
}


if(!$forum_posts){
	$str = ONLINEINFO_LIST_4;
}else{

$str ='<table width="100%"><tr><td width="18px"></td><td style="text-align:left; font-weight: bold;">'.ONLINEINFO_LOGIN_MENU_L99.'</td><td style="text-align:center; font-weight: bold;" width="10%" nowrap>'.ONLINEINFO_LOGIN_MENU_L90.'</td><td style="text-align:center; font-weight: bold;" width="10%" nowrap>'.ONLINEINFO_LOGIN_MENU_L96.'</td><td style="text-align:center; font-weight: bold;" width="10%" nowrap>'.ONLINEINFO_LOGIN_MENU_L94.'</td></tr>'.$str.'</table>';

}

$notallread='';
if($forum_posts !=0){

	$notallread='  <i><a href="'.e_SELF.'?mark_all_as_read">['.ONLINEINFO_LOGIN_MENU_L91.']</a></i>';
}

$reps = $forum_posts - $newthreads;

$text .= '<tr>
<td class="fcaption">'.ONLINEINFO_LIST_6.' ('.$newthreads.' '.ONLINEINFO_LOGIN_MENU_L97.', '.$reps.' '.ONLINEINFO_LOGIN_MENU_L98.')  '.$notallread.'</td>
</tr>
<tr>
<td class="forumheader3">'.$str.'</td>
</tr>';



}else{

// ************************************************************
// ******          New Forum Post (Detailed)             ******
// ************************************************************

// Old Style

$qry = "SELECT ft.*, fp.thread_name as post_subject, fp.thread_total_replies as replies, u.user_id, f.forum_name,f.forum_id, u.user_name, f.forum_class
		FROM #forum_t AS ft
		LEFT JOIN #forum_t as fp ON fp.thread_id = ft.thread_parent
		LEFT JOIN #user as u ON u.user_id = SUBSTRING_INDEX(ft.thread_user,'.',1)
		LEFT JOIN #forum as f ON f.forum_id = ft.thread_forum_id
		WHERE ft.thread_datestamp > ".$lvisit. "
		AND f.forum_class IN (".USERCLASS_LIST.")
		".$viewed."
		ORDER BY ft.thread_datestamp DESC LIMIT 0, ".$pref['onlineinfo_forumnum'];


$forum_posts_sql = new db;
$forum_posts = $forum_posts_sql->db_Select_gen($qry);

while ($row = $forum_posts_sql->db_Fetch())
	{
		extract($row);
		$userinfo = explode('.',$thread_user);

		if($thread_parent){
			$ttemp = $thread_id;

			$str .= '<a href="'.e_SELF.'?markasread.'.$thread_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  [ <a href="'.e_PLUGIN.'forum/forum_viewforum.php?'.$forum_id.'">'.$forum_name.'</a> ] Re: <a href="'.e_PLUGIN.'forum/forum_viewtopic.php?'.$ttemp.'.post">'.$post_subject.'</a> <i>'.ONLINEINFO_LOGIN_MENU_L90.'</i> <a href="'.e_BASE.'user.php?id.'.$userinfo[0].'" '.getuserclassinfo($userinfo[0]).'>'.$userinfo[1].'</a><br />';
			}else{
				$str .= '<a href="'.e_SELF.'?markasread.'.$thread_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  [ <a href="'.e_PLUGIN.'forum/forum_viewforum.php?'.$forum_id.'">'.$forum_name.'</a> ] <a href="'.e_PLUGIN.'forum/forum_viewtopic.php?'.$thread_id.'.post">'.$thread_name.'</a> <i>'.ONLINEINFO_LOGIN_MENU_L90.'</i> <a href="'.e_BASE.'user.php?id.'.$userinfo[0].'" '.getuserclassinfo($userinfo[0]).'>'.$userinfo[1].'</a><br/>';
			}
}


$notallread='';
if($forum_posts !=0){

	$notallread='  <i><a href="'.e_SELF.'?mark_all_as_read">['.ONLINEINFO_LOGIN_MENU_L91.']</a></i>';
}

if(!$forum_posts){
	$str = ONLINEINFO_LIST_4;
}



$text .= '<tr>
<td class="fcaption">'.ONLINEINFO_LIST_6.' ('.$forum_posts.') '.$notallread.'</td>
</tr>
<td class="forumheader3">'.$str.'</td>
</tr>';

}

}


// ************************************************************
// ******                New Download                    ******
// ************************************************************

if ($pref['onlineinfo_downloads'] == 1)
{
unset($str);

	if($downloadsread != '')
		{
			$downloads_read = 'AND download_id NOT IN ('.$downloadsread.')';
		}

if($new_downloads = $sql -> db_Select("download", "*", "download_datestamp>$lvisit and download_visible IN (".USERCLASS_LIST.") ".$downloads_read." ORDER BY download_datestamp DESC LIMIT 0," . $pref['onlineinfo_downloadnum'] . "")){
	while($row = $sql -> db_Fetch()){
		extract($row);
		$str .= '<a href="'.e_SELF.'?markdownloadsasread.'.$download_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  <a href="'.e_BASE.'download.php?view.'.$download_id.'">'.$download_name.'</a><br />';
	}
}else{
	$str = ONLINEINFO_LIST_4;
}


$notdownloadsallread='';
if($new_downloads !=0){

	$notdownloadsallread='  <i><a href="'.e_SELF.'?mark_all_downloads_as_read">['.ONLINEINFO_LOGIN_MENU_L91.']</a></i>';
}

if (!$new_downloads){$new_downloads=0;}

$text .= '<tr>
<td class="fcaption">'.ONLINEINFO_LIST_17.' ('.$new_downloads.')'.$notdownloadsallread.'</td>
</tr><tr>
<td class="forumheader3">'.$str.'</td>
</tr>';

}


// ************************************************************
// ******                  New SMF Post                  ******
// ************************************************************
if ($pref['onlineinfo_smfuse'] == 1)
    {

    	if($smfread != '')
		{
			$smfread = 'AND ID_MSG NOT IN ('.$smfread.')';
		}

unset($str);

$whereto = $pref['onlineinfo_smfwindow'];

$script="SELECT * FROM ".$pref['onlineinfo_smfprefix']."messages WHERE posterTime >='". $lvisit ."' ".$smfread." ORDER BY posterTime DESC LIMIT 0," . $pref['onlineinfo_smfshownum'];
$onlineinfo_smf_sql = new db;
$onlineinfo_getsmfinfo = $onlineinfo_smf_sql->db_Select_gen($script);

while ($row = $onlineinfo_smf_sql->db_Fetch())
	{


		if($whereto=='e107'){

				$str .= '<a href="'.e_SELF.'?marknewsmfasread.'.$row['ID_MSG'].'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  [ <a href="'.e_PLUGIN.'onlineinfo_menu/smf.php?u.'.$row['ID_MEMBER'].'">'.$row['posterName'].'</a> ]&nbsp;&nbsp;<a href="'.e_PLUGIN.'onlineinfo_menu/smf.php?id.'.$row['ID_TOPIC'].'-'.$row['ID_MSG'].'">'.$row['subject'].'</a><br />';

		}else{

		$str .= '<a href="'.e_SELF.'?marknewsmfasread.'.$row['ID_MSG'].'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  [ <a href="'.SITEURL.$pref['onlineinfo_smflocation'].'/index.php?action=profile;u='.$row['ID_MEMBER'].'" target="blank">'.$row['posterName'].'</a> ]&nbsp;&nbsp;<a href="'.SITEURL.$pref['onlineinfo_smflocation'].'/index.php?topic='.$row['ID_TOPIC'].'.msg'.$row['ID_MSG'].'#msg'.$row['ID_MSG'].'" target="blank">'.$row['subject'].'</a><br />';

		}

}

if($onlineinfo_getsmfinfo==0){$str = ONLINEINFO_LIST_4;}


$notnewsmfallread='';
if($onlineinfo_getsmfinfo !=0){

	$notnewsmfallread='  <i><a href="'.e_SELF.'?mark_all_newsmf_as_read">['.ONLINEINFO_LOGIN_MENU_L91.']</a></i>';
}


$text .='<tr>
<td class="fcaption">'.ONLINEINFO_LIST_42.' ('.$onlineinfo_getsmfinfo.')'.$notnewsmfallread.'</td>
</tr><tr>
<td class="forumheader3">'.$str.'</td>
</tr>';

}



// ************************************************************
// ******                  New IBF Post                  ******
// ************************************************************

if ($pref['onlineinfo_ibfuse'] == 1)
    {

    	if($ibfread != '')
		{
			$ibfread = 'AND topic_id NOT IN ('.$ibfread.')';
		}

unset($str);

$script="SELECT ibf_posts.*, ibf_topics.title FROM ".$pref['onlineinfo_ibfprefix']."topics JOIN ".$pref['onlineinfo_ibfprefix']."posts ON tid = topic_id WHERE post_date >='". $lvisit ."' ".$ibfread." ORDER BY post_date DESC LIMIT 0," . $pref['onlineinfo_ibfshownum'];
$onlineinfo_ipb_sql = new db;
$onlineinfo_getipbinfo = $onlineinfo_ipb_sql->db_Select_gen($script);

while ($row = $onlineinfo_ipb_sql->db_Fetch())
	{
	if($row['author_id']=='0'){
		$str .= '<a href="'.e_SELF.'?marknewibfasread.'.$pid.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  [ '.$row['author_name'].' ]&nbsp;&nbsp;<a href="'.SITEURL.$pref['onlineinfo_ibflocation'].'/index.php?showtopic='.$row['topic_id'].'">'.$row['title'].'</a><br />';
	}else
	{
		$str .= '<a href="'.e_SELF.'?marknewibfasread.'.$pid.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  [ <a href="'.SITEURL.$pref['onlineinfo_ibflocation'].'/index.php?showuser='.$row['author_id'].'">'.$row['author_name'].'</a> ]&nbsp;&nbsp;<a href="'.SITEURL.$pref['onlineinfo_ibflocation'].'/index.php?showtopic='.$row['topic_id'].'">'.$row['title'].'</a><br />';
	}

}

if($onlineinfo_getipbinfo==0){$str = ONLINEINFO_LIST_4;}


$notnewibfallread='';
if($onlineinfo_getipbinfo !=0){

	$notnewibfallread='  <i><a href="'.e_SELF.'?mark_all_newibf_as_read">['.ONLINEINFO_LOGIN_MENU_L91.']</a></i>';
}


$text .='<tr>
<td class="fcaption">'.ONLINEINFO_LIST_31.' ('.$onlineinfo_getipbinfo.')'.$notnewibfallread.'</td>
</tr><tr>
<td class="forumheader3">'.$str.'</td>
</tr>';

}


// ************************************************************
// ******             New Galery 2 Image                 ******
// ************************************************************

if ($pref['onlineinfo_gallery2use'] == 1)
    {


     	if($galleryread != '')
		{
			$galleryread = 'AND g_id NOT IN ('.$galleryread.')';
		}


    $whereto = $pref['onlineinfo_gallery2window'];

unset($str);

$script="SELECT * FROM ".$pref['onlineinfo_gallery2prefix']."Item WHERE g_canContainChildren='0' AND g_viewedSinceTimestamp >='". $lvisit ."' ".$galleryread." ORDER BY g_viewedSinceTimestamp DESC LIMIT 0," . $pref['onlineinfo_gallery2shownum'];
$onlineinfo_gallery2_sql = new db;
$onlineinfo_getgallery2info = $onlineinfo_gallery2_sql->db_Select_gen($script);

while ($row = $onlineinfo_gallery2_sql->db_Fetch())
	{

if($whereto=='e107'){

		$str .= '<a href="'.e_SELF.'?marknewgallerypostsasread.'.$pid.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  '.ONLINEINFO_LIST_27.'<a href="'.e_PLUGIN.'onlineinfo_menu/gallery2.php?id.'.$row['g_id'].'">'.$row['g_title'].'</a>'.ONLINEINFO_LIST_28.'<a href="'.e_PLUGIN.'onlineinfo_menu/gallery2.php?id.'.$row['g_id'].'">'.$row['g_description'].'</a><br />';

}else{
		$str .= '<a href="'.e_SELF.'?marknewgallerypostsasread.'.$pid.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  '.ONLINEINFO_LIST_27.'<a href="'.SITEURL.$pref['onlineinfo_gallery2location'].'/main.php?g2_itemId='.$row['g_id'].'" target="_blank">'.$row['g_title'].'</a>'.ONLINEINFO_LIST_28.'<a href="'.SITEURL.$pref['onlineinfo_gallery2location'].'/main.php?g2_itemId='.$row['g_id'].'"  target="_blank">'.$row['g_description'].'</a><br />';

	}


}

if($onlineinfo_getgallery2info==0){$str = ONLINEINFO_LIST_4;}


$notnewgalleryallread='';
if($onlineinfo_getgallery2info !=0){

	$notnewgalleryallread='  <i><a href="'.e_SELF.'?mark_all_newgalleryposts_as_read">['.ONLINEINFO_LOGIN_MENU_L91.']</a></i>';
}



$text .='<tr>
<td class="fcaption">'.ONLINEINFO_LIST_34.' ('.$onlineinfo_getgallery2info.')'.$notnewgalleryallread.'</td>
</tr><tr>
<td class="forumheader3">'.$str.'</td>
</tr>';

}


// ************************************************************
// ******             New Guestbook Entry                ******
// ************************************************************

if ($pref['onlineinfo_guestbook'] == 1)
    {


		if($guestbookread != '')
		{
			$guestbookread = 'AND id NOT IN ('.$guestbookread.')';
		}


unset($str);
if($new_guestbook = $sql -> db_Select("guestbook", "*", "date>$lvisit ".$guestbookread." ORDER BY date DESC LIMIT 0," . $pref['onlineinfo_guestbooknum'] . "")){
	while($row = $sql -> db_Fetch()){
		extract($row);
		$str .= '<a href="'.e_SELF.'?marknewguestbookpostsasread.'.$pid.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  '.$comment.' - '.$name.'<br />';
	}
}else{
	$str = ONLINEINFO_LIST_4;
}

$notnewguestbookallread='';
if($new_guestbook !=0){

	$notnewguestbookallread='  <i><a href="'.e_SELF.'?mark_all_newguestbookposts_as_read">['.ONLINEINFO_LOGIN_MENU_L91.']</a></i>';
}


$text .='<tr>
<td class="fcaption">'.ONLINEINFO_LIST_23.' ('.$new_guestbook.')'.$notnewguestbookallread.'</td>
</tr><tr>
<td class="forumheader3">'.$str.'</td>
</tr>';

}

// ************************************************************
// ******             New jokes                          ******
// ************************************************************

if ($pref['onlineinfo_joke'] == 1)
    {


		if($jokesread != '')
		{
			$jokesread = 'AND joke_id NOT IN ('.$jokesread.')';
		}


unset($str);
if($new_joke = $sql -> db_Select("jokemenu_jokes", "*", "joke_posted>$lvisit ".$jokesread." AND joke_approved=1 ORDER BY joke_posted DESC LIMIT 0," . $pref['onlineinfo_jokenum'] . "")){
	while($row = $sql -> db_Fetch()){
		extract($row);

		$userinfo = explode('.',$joke_author);

		$str .= '<a href="'.e_SELF.'?marknewjokepostsasread.'.$joke_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  '.ONLINEINFO_LOGIN_MENU_L116.' <a href="'.e_PLUGIN.'jokes_menu/jokes.php?0.view.'.$joke_id.'.0.0">'.$joke_name.'</a> <i>'.ONLINEINFO_LOGIN_MENU_L90.'</i> <a href="'.e_BASE.'user.php?id.'.$userinfo[0].'" '.getuserclassinfo($userinfo[0]).'>'.$userinfo[1].'</a><br />';
	}
}else{
	$str = ONLINEINFO_LIST_4;
}

$notnewjokeallread='';
if($new_joke !=0){

	$notnewjokeallread='  <i><a href="'.e_SELF.'?mark_all_newjokeposts_as_read">['.ONLINEINFO_LOGIN_MENU_L91.']</a></i>';
}


$text .='<tr>
<td class="fcaption">'.ONLINEINFO_LIST_57.' ('.$new_joke.')'.$notnewjokeallread.'</td>
</tr><tr>
<td class="forumheader3">'.$str.'</td>
</tr>';

}



// ************************************************************
// ******           New CopperMine Picture    (PLUGIN)   ******
// ************************************************************

if ($pref['onlineinfo_coppermine'] == 1)
{

		if($picturesread != '')
		{
			$picturesread = 'AND pid NOT IN ('.$picturesread.')';
		}

unset($str);
if($new_pictures = $sql -> db_Select("CPG_pictures", "*",
"ctime>$lvisit ".$picturesread." ORDER BY ctime DESC LIMIT 0," . $pref['onlineinfo_copperminenum'] . "")){
    while($row = $sql -> db_Fetch()){
        extract($row);
        if (strlen($title)< 1) $title = ONLINEINFO_LIST_25;

        if (strlen($caption)< 1) $caption = ONLINEINFO_LIST_25;

   $str .= '<a href="'.e_SELF.'?marknewpicturesasread.'.$pid.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  '.$owner_name.ONLINEINFO_LIST_26.'<a href="'.e_PLUGIN.'coppermine_menu/displayimage.php?pos=-'.$pid.'">'.$filename.'</a>'.ONLINEINFO_LIST_27.$title.ONLINEINFO_LIST_28.$caption.'<br />';
    }
}else{
    $str = ONLINEINFO_LIST_4;
}


$notnewpicturesallread='';
if($new_pictures !=0){

	$notnewpicturesallread='  <i><a href="'.e_SELF.'?mark_all_newpictures_as_read">['.ONLINEINFO_LOGIN_MENU_L91.']</a></i>';
}


$text .='<tr>
<td class="fcaption">'.ONLINEINFO_LIST_22.' ('.$new_pictures.')'.$notnewpicturesallread.'</td>
</tr><tr>
<td class="forumheader3">'.$str.'</td>
</tr>';


}


// ************************************************************
// ******           New CopperMine Picture Gallery       ******
// ************************************************************

if ($pref['onlineinfo_sa_coppermineuse'] == 1)
{

		if($copperread != '')
		{
			$copperread = 'AND pid NOT IN ('.$copperread.')';
		}

	 unset($whereto);

    $whereto = $pref['onlineinfo_sa_copperminewindow'];

unset($str);

$script="SELECT * FROM ".$pref['onlineinfo_sa_coppermineprefix']."pictures WHERE ctime >='". $lvisit ."' ".$copperread." ORDER BY ctime DESC LIMIT 0," . $pref['onlineinfo_sa_coppermineshownum'];
$onlineinfo_copper_sql = new db;
$onlineinfo_getcopperinfo = $onlineinfo_copper_sql->db_Select_gen($script);

while ($row = $onlineinfo_copper_sql->db_Fetch())
	{

        if (strlen($row['title'])< 1) $row['title'] = ONLINEINFO_LIST_25;

        if (strlen($row['caption'])< 1) $row['caption'] = ONLINEINFO_LIST_25;


if($whereto=='e107'){

   $str .= '<a href="'.e_SELF.'?marknewcopperasread.'.$row['pid'].'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  '.$owner_name.ONLINEINFO_LIST_26.'<a href="'.e_PLUGIN.'onlineinfo_menu/coppermine.php?id.'.$row['pid'].'">'.$row['filename'].'</a>&nbsp;&nbsp;&nbsp;&nbsp;'.ONLINEINFO_LIST_27.$row['title'].'&nbsp;&nbsp;&nbsp;&nbsp;'.ONLINEINFO_LIST_28.$row['caption'].'<br />';


}else{

	$str .= '<a href="'.e_SELF.'?marknewcopperasread.'.$row['pid'].'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  '.$row['owner_name'].ONLINEINFO_LIST_26.'<a href="'.SITEURL.$pref['onlineinfo_sa_copperminelocation'].'/displayimage.php?pos=-'.$row['pid'].'" target="_blank">'.$row['filename'].'</a>&nbsp;&nbsp;&nbsp;&nbsp;'.ONLINEINFO_LIST_27.$row['title'].'&nbsp;&nbsp;&nbsp;&nbsp;'.ONLINEINFO_LIST_28.$row['caption'].'<br />';

	}

	}

if($onlineinfo_getcopperinfo==0){$str = ONLINEINFO_LIST_4;}

$notnewcopperallread='';
if($onlineinfo_getcopperinfo !=0){

	$notnewcopperallread='  <i><a href="'.e_SELF.'?mark_all_newcopper_as_read">['.ONLINEINFO_LOGIN_MENU_L91.']</a></i>';
}


$text .='<tr>
<td class="fcaption">'.ONLINEINFO_LIST_56.' ('.$onlineinfo_getcopperinfo.')'.$notnewcopperallread.'</td>
</tr><tr>
<td class="forumheader3">'.$str.'</td>
</tr>';


}



// ************************************************************
// ******                 New You Tube Movie             ******
// ************************************************************

if ($pref['onlineinfo_youtube'] == 1)
{

	if($moviesread != '')
		{
			$moviesread = 'AND movie_id NOT IN ('.$moviesread.')';
		}

unset($str);
if($new_tube = $sql -> db_Select("er_ytm_gallery_movies", "*","UNIX_TIMESTAMP(timestamp) > ".$lvisit." ".$moviesread." ORDER BY timestamp DESC LIMIT 0," . $pref['onlineinfo_youtubenum'] . "")){
    while($row = $sql -> db_Fetch()){
        extract($row);
        if (strlen($movie_title)< 1) $movie_title = ONLINEINFO_LIST_25;


   $str .= '<a href="'.e_SELF.'?marknewmovieasread.'.$movie_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  '.$input_user.ONLINEINFO_LIST_26.'<a href="'.e_PLUGIN.'ytm_gallery/ytm.php?view='.$movie_code.'&p=1">'.$movie_title.'</a><br />';
    }
}else{
    $str = ONLINEINFO_LIST_4;
}

$notnewmovieallread='';
if($new_tube !=0){

	$notnewmovieallread='  <i><a href="'.e_SELF.'?mark_all_newmovies_as_read">['.ONLINEINFO_LOGIN_MENU_L91.']</a></i>';
}

$text .='<tr>
<td class="fcaption">'.ONLINEINFO_LIST_35.' ('.$new_tube.')'.$notnewmovieallread.'</td>
</tr><tr>
<td class="forumheader3">'.$str.'</td>
</tr>';

}


// ************************************************************
// ******              New Krooze Arcade Games           ******
// ************************************************************

if ($pref['onlineinfo_kroozearcade'] == 1)
{

	if($gamesread != '')
		{
			$gamesread = 'AND game_id NOT IN ('.$gamesread.')';
		}

unset($str);
if($new_game = $sql -> db_Select("arcade_games", "*","date_added > ".$lvisit." ".$gamesread." ORDER BY date_added DESC LIMIT 0,".$pref['onlineinfo_kroozearcadenum']."")){
    while($row = $sql -> db_Fetch()){
        extract($row);

   $str .= '<a href="'.e_SELF.'?marknewgamesasread.'.$game_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  '.ONLINEINFO_LIST_36.'<a href="'.e_PLUGIN.'kroozearcade_menu/play.php?gameid='.$game_id.'">'.$game_title.'</a><br />';
    }
}else{
    $str = ONLINEINFO_LIST_4;
}

$notnewgamesallread='';
if($new_game !=0){

	$notnewgamesallread='  <i><a href="'.e_SELF.'?mark_all_newgames_as_read">['.ONLINEINFO_LOGIN_MENU_L91.']</a></i>';
}

$text .='<tr>
<td class="fcaption">'.ONLINEINFO_LIST_37.' ('.$new_game.')'.$notnewgamesallread.'</td>
</tr><tr>
<td class="forumheader3">'.$str.'</td>
</tr>';

}


// ************************************************************
// ******          New Krooze Arcade Top Score           ******
// ************************************************************

if ($pref['onlineinfo_kroozearcadetop'] == 1)
{

unset($str);

if($gametopread != '')
		{
			$gametopread = 'AND champ_id NOT IN ('.$gametopread.')';
		}


$script='SELECT '.MPREFIX.'arcade_champs.*, '.MPREFIX.'arcade_games.game_title, '.MPREFIX.'user.user_name
FROM '.MPREFIX.'arcade_champs
LEFT JOIN '.MPREFIX.'arcade_games ON '.MPREFIX.'arcade_games.game_id = '.MPREFIX.'arcade_champs.game_id
LEFT JOIN '.MPREFIX.'user ON '.MPREFIX.'user.user_id = '.MPREFIX.'arcade_champs.user_id
WHERE '.MPREFIX.'arcade_champs.date_scored > '.$lvisit.' '.$gametopread.'
ORDER BY '.MPREFIX.'arcade_champs.date_scored DESC LIMIT 0,'.$pref['onlineinfo_kroozearcadetopnum'];


if($new_gametop = $sql->db_Select_gen($script)){

while ($row = $sql->db_Fetch()){
        extract($row);

   $str .= '<a href="'.e_SELF.'?marknewtopscoresasread.'.$champ_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  <a href="'.e_BASE.'user.php?id.'.$user_id.'" '.getuserclassinfo($user_id).'>'.$user_name.'</a>'.ONLINEINFO_LIST_38.'<a href="'.e_PLUGIN.'kroozearcade_menu/play.php?gameid='.$game_id.'">'.$game_title.'</a>'.ONLINEINFO_LIST_40.$score.'<br />';
    }
}else{
    $str = ONLINEINFO_LIST_4;
}

$notnewtopscoresallread='';
if($new_gametop !=0){

	$notnewtopscoresallread='  <i><a href="'.e_SELF.'?mark_all_newtopscores_as_read">['.ONLINEINFO_LOGIN_MENU_L91.']</a></i>';
}


$text .='<tr>
<td class="fcaption">'.ONLINEINFO_LIST_39.' ('.$new_gametop.')'.$notnewtopscoresallread.'</td>
</tr><tr>
<td class="forumheader3">'.$str.'</td>
</tr>';

}



// ************************************************************
// ******                  New Link Page                 ******
// ************************************************************

if ($pref['onlineinfo_links'] == 1)
    {
unset($str);

if($linksread != '')
		{
			$linksread = 'AND link_id NOT IN ('.$linksread.')';
		}

if($new_link = $sql -> db_Select("links_page", "*", "link_datestamp>$lvisit ".$linksread." ORDER BY link_datestamp DESC LIMIT 0," . $pref['onlineinfo_linksnum'] . "")){
	while($row = $sql -> db_Fetch()){
		extract($row);
		$str .= '<a href="'.e_SELF.'?marknewlinksasread.'.$link_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  <a href="'.$link_url.'">'.$link_name.'</a><br />';
	}
}else{
	$str = ONLINEINFO_LIST_4;
}


$notnewlinksallread='';
if($new_link !=0){

	$notnewlinksallread='  <i><a href="'.e_SELF.'?mark_all_newlinks_as_read">['.ONLINEINFO_LOGIN_MENU_L91.']</a></i>';
}


$text .='<tr>
<td class="fcaption">'.ONLINEINFO_LIST_30.' ('.$new_link.')'.$notnewlinksallread.'</td>
</tr><tr>
<td class="forumheader3">'.$str.'</td>
</tr>';
}

// ************************************************************
// ******                  Bugtracker3                   ******
// ************************************************************


if ($pref['onlineinfo_bugtracker3'] == 1)
    {
unset($str);

if($bugread != '')
		{
			$bugread = 'AND '.MPREFIX.'bugtracker3_bugs.bugtracker3_bugs_id NOT IN ('.$bugread.')';
		}


$script='SELECT '.MPREFIX.'bugtracker3_bugs.*, '.MPREFIX.'bugtracker3_categories.bugtracker3_category_name, '.MPREFIX.'bugtracker3_priorities.bugtracker3_priority_name,'.MPREFIX.'bugtracker3_priorities.bugtracker3_priority_color, '.MPREFIX.'bugtracker3_resolutions.bugtracker3_resolution_name, '.MPREFIX.'bugtracker3_statuses.bugtracker3_status_name, '.MPREFIX.'user.user_name, '.MPREFIX.'bugtracker3_apps.bugtracker3_apps_name
FROM '.MPREFIX.'bugtracker3_bugs
LEFT JOIN '.MPREFIX.'bugtracker3_categories ON '.MPREFIX.'bugtracker3_bugs.bugtracker3_bugs_category = '.MPREFIX.'bugtracker3_categories.bugtracker3_category_id
LEFT JOIN '.MPREFIX.'bugtracker3_priorities ON '.MPREFIX.'bugtracker3_bugs.bugtracker3_bugs_priority = '.MPREFIX.'bugtracker3_priorities.bugtracker3_priority_id
LEFT JOIN '.MPREFIX.'bugtracker3_resolutions ON '.MPREFIX.'bugtracker3_bugs.bugtracker3_bugs_resolution = '.MPREFIX.'bugtracker3_resolutions.bugtracker3_resolution_id
LEFT JOIN '.MPREFIX.'bugtracker3_statuses ON '.MPREFIX.'bugtracker3_bugs.bugtracker3_bugs_status = '.MPREFIX.'bugtracker3_statuses.bugtracker3_status_id
LEFT JOIN '.MPREFIX.'user ON '.MPREFIX.'bugtracker3_bugs.bugtracker3_bugs_last_update_poster = '.MPREFIX.'user.user_id
LEFT JOIN '.MPREFIX.'bugtracker3_apps ON '.MPREFIX.'bugtracker3_bugs.bugtracker3_bugs_application_id = '.MPREFIX.'bugtracker3_apps.bugtracker3_apps_id
WHERE '.MPREFIX.'bugtracker3_bugs.bugtracker3_bugs_update_timestamp>'.$lvisit.' '.$bugread.'
ORDER BY '.MPREFIX.'bugtracker3_bugs.bugtracker3_bugs_update_timestamp DESC LIMIT 0,'.$pref['onlineinfo_bugtracker3commentsnum'];


$str .='<table width="100%" cellspacing="0" cellpadding="0"><tr><td></td><td style="text-align:center; font-weight: bold;" nowrap>'.ONLINEINFO_LIST_46.'</td><td style="text-align:left; font-weight: bold;" nowrap>'.ONLINEINFO_LIST_53.'</td><td style="text-align:left; font-weight: bold;" nowrap>'.ONLINEINFO_LIST_51.'</td><td style="text-align:center; font-weight: bold;" nowrap>'.ONLINEINFO_LIST_47.'</td><td style="text-align:center; font-weight: bold;" nowrap>'.ONLINEINFO_LIST_48.'</td><td style="text-align:center; font-weight: bold;" nowrap>'.ONLINEINFO_LIST_49.'</td><td style="text-align:center; font-weight: bold;" nowrap>'.ONLINEINFO_LIST_50.'</td><td style="text-align:center; font-weight: bold;" nowrap>'.ONLINEINFO_LIST_52.'</td></tr>';


$noofnew=0;
$noofupdated=0;

if($new_bug = $sql->db_Select_gen($script)){

while ($row = $sql->db_Fetch()){
        extract($row);


        if($bugtracker3_bugs_timestamp == $bugtracker3_bugs_update_timestamp){
        	// New
        	$noofnew++;
			$str .= '<tr style="background-color:#'.$bugtracker3_priority_color.';"><td><a href="'.e_SELF.'?marknewbugsasread.'.$bugtracker3_bugs_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a></td><td style="text-align:center; font-weight: bold;" nowrap>'.ONLINEINFO_LIST_44.'</td><td style="text-align:left;" nowrap><a href="'.e_PLUGIN.'bugtracker3/bugtracker3.php?1.'.$bugtracker3_bugs_application_id.'">'.$bugtracker3_apps_name.'</a></td><td style="text-align:left;" nowrap><a href="'.e_PLUGIN.'bugtracker3/bugtracker3.php?2.'.$bugtracker3_bugs_id.'">'.$bugtracker3_bugs_summary.'</a></td><td style="text-align:center;" nowrap>'.$bugtracker3_category_name.'</td><td style="text-align:center;" nowrap>'.$bugtracker3_priority_name.'</td><td style="text-align:center;" nowrap>'.$bugtracker3_resolution_name.'</td><td style="text-align:center;" nowrap>'.$bugtracker3_status_name.'</td><td style="text-align:center;" nowrap><a href="'.e_BASE.'user.php?id.'.$bugtracker3_bugs_poster.'" '.getuserclassinfo($bugtracker3_bugs_poster).'>'.$user_name.'</a></td></tr>';

		}else{
			// Updated
			$noofupdated++;
           $str .= '<tr style="background-color:#'.$bugtracker3_priority_color.';"><td><a href="'.e_SELF.'?marknewbugsasread.'.$bugtracker3_bugs_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a></td><td style="text-align:center; font-weight: bold;" nowrap>'.ONLINEINFO_LIST_45.'</td><td style="text-align:left;" nowrap><a href="'.e_PLUGIN.'bugtracker3/bugtracker3.php?1.'.$bugtracker3_bugs_application_id.'">'.$bugtracker3_apps_name.'</a></td><td style="text-align:left;" nowrap><a href="'.e_PLUGIN.'bugtracker3/bugtracker3.php?2.'.$bugtracker3_bugs_id.'">'.$bugtracker3_bugs_summary.'</a></td><td style="text-align:center;" nowrap>'.$bugtracker3_category_name.'</td><td style="text-align:center;" nowrap>'.$bugtracker3_priority_name.'</td><td style="text-align:center;" nowrap>'.$bugtracker3_resolution_name.'</td><td style="text-align:center;" nowrap>'.$bugtracker3_status_name.'</td><td style="text-align:center;" nowrap><a href="'.e_BASE.'user.php?id.'.$bugtracker3_bugs_poster.'" '.getuserclassinfo($bugtracker3_bugs_poster).'>'.$user_name.'</a></td></tr>';
   }
    }
}else{
    $str = '<table width="100%"><tr><td>'.ONLINEINFO_LIST_4.'</td></tr>';
}

$str=$str.'</table>';


$notnewbugsallread='';
if($new_bug !=0){

	$notnewbugsallread='  <i><a href="'.e_SELF.'?mark_all_newbugs_as_read">['.ONLINEINFO_LOGIN_MENU_L91.']</a></i>';
}


$text .='<tr>
<td class="fcaption">'.ONLINEINFO_LOGIN_MENU_L108.' ('.$noofnew.' '.ONLINEINFO_LIST_44.', '.$noofupdated.' '.ONLINEINFO_LIST_45.')'.$notnewbugsallread.'</td>
</tr><tr>
<td class="forumheader3">'.$str.'</td>
</tr>';
}


// ************************************************************
// ******                  New blogs                     ******
// ************************************************************
if ($pref['onlineinfo_blog'] == 1)
    {
unset($str);

if($blogsread != '')
		{
			$blogs_read = 'AND userjournals_id NOT IN ('.$blogsread.')';
		}


$script='SELECT '.MPREFIX.'userjournals.*, '.MPREFIX.'user.user_name FROM '.MPREFIX.'userjournals LEFT JOIN '.MPREFIX.'user ON '.MPREFIX.'userjournals.userjournals_userid = '.MPREFIX.'user.user_id WHERE userjournals_timestamp>'.$lvisit.' '.$blogs_read.' ORDER BY userjournals_timestamp DESC LIMIT 0,' . $pref['onlineinfo_blognum'];


if($new_blogs = $sql->db_Select_gen($script)){

while ($row = $sql->db_Fetch()){
        extract($row);

		$str .= '<a href="'.e_SELF.'?marknewblogasread.'.$userjournals_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  <a href="'.e_PLUGIN.'userjournals_menu/userjournals.php?blog.'.$userjournals_id.'">'.$userjournals_subject.'</a> <i>'.ONLINEINFO_LOGIN_MENU_L90.'</i> <a href="'.e_BASE.'user.php?id.'.$userjournals_userid.'" '.getuserclassinfo($userjournals_userid).'>'.$user_name.'</a><br />';
	}
}else{
	$str = ONLINEINFO_LIST_4;
}


$notnewblogallread='';
if($new_blogs !=0){

	$notnewblogallread='  <i><a href="'.e_SELF.'?mark_allnewblog_as_read">['.ONLINEINFO_LOGIN_MENU_L91.']</a></i>';
}

if (!$new_blogs){$new_blogs=0;}

$text .= '<tr>
<td class="fcaption">'.ONLINEINFO_LIST_58.' ('.$new_blogs.')'.$notnewblogallread.'</td>
</tr><tr>
<td class="forumheader3">'.$str.'</td>
</tr>';

}

// ************************************************************
// ******                  New Suggestions               ******
// ************************************************************

if ($pref['onlineinfo_suggestions'] == 1)
    {

    		if($suggestionsread != '')
		{
			$suggestions_read = 'AND suggestion_id NOT IN ('.$suggestionsread.')';
		}


unset($str);

if($suggestions_posts = $sql -> db_Select("sugg_suggs", "*", "suggestion_posted>".$lvisit." AND suggestion_approved=1 ".$suggestions_read." ORDER BY suggestion_posted DESC LIMIT 0," . $pref['onlineinfo_suggestionsnum'] . "")){
	while($row = $sql -> db_Fetch()){
		extract($row);
		$author = explode('.',$suggestion_author);

		$str .= '<a href="'.e_SELF.'?marksuggestionsasread.'.$suggestion_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  <a href="'.e_PLUGIN.'suggestions_menu/suggestions.php?0.view.'.$suggestion_id.'">'.$suggestion_name.'</a> <i>'.ONLINEINFO_LOGIN_MENU_L90.'</i> <a href="'.e_BASE.'user.php?id.'.$author[0].'" '.getuserclassinfo($author[0]).'>'.$author[1].'</a><br />';



	}
}

if($suggestions_posts==0){
	$str = ONLINEINFO_LIST_4;
}

$notsuggestionsallread='';
if($suggestions_posts !=0){

	$notsuggestionsallread='  <i><a href="'.e_SELF.'?mark_all_suggestions_as_read">['.ONLINEINFO_LOGIN_MENU_L91.']</a></i>';
}



$text .= '<tr>
<td class="fcaption">'.ONLINEINFO_LIST_59.' ('.$suggestions_posts.') '.$notsuggestionsallread.'</td>
</tr><tr>
<td class="forumheader3">'.$str.'</td>
</tr>';

}







// ************************************************************
// ******                  New Member                    ******
// ************************************************************
if ($pref['onlineinfo_members'] == 1)
    {
unset($str);

if($sitemembersread != '')
		{
			$sitemembers_read = 'AND user_id NOT IN ('.$sitemembersread.')';
		}


if($new_members = $sql -> db_Select("user", "*", "user_join>$lvisit ".$sitemembers_read." ORDER BY user_join DESC LIMIT 0," . $pref['onlineinfo_usersnum'] . "")){
	while($row = $sql -> db_Fetch()){
		extract($row);
		$str .= '<a href="'.e_SELF.'?marknewmemberasread.'.$user_id.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/read.png" border="0" alt="'.ONLINEINFO_LOGIN_MENU_L92.'"></a>  <a href="'.e_BASE.'user.php?id.'.$user_id.'" '.getuserclassinfo($user_id).'>'.$user_name.'</a><br />';
	}
}else{
	$str = ONLINEINFO_LIST_4;
}


$notnewmemberallread='';
if($new_members !=0){

	$notnewmemberallread='  <i><a href="'.e_SELF.'?mark_all_newmember_as_read">['.ONLINEINFO_LOGIN_MENU_L91.']</a></i>';
}

if (!$new_members){$new_members=0;}

$text .= '<tr>
<td class="fcaption">'.ONLINEINFO_LIST_7.' ('.$new_members.')'.$notnewmemberallread.'</td>
</tr><tr>
<td class="forumheader3">'.$str.'</td>
</tr>';

}
// ************************************************************

$text.='<tr>
<td class="fcaption">&nbsp;</td>
</tr><tr>
<td class="forumheader3">'.colourkey(0).'</td>
</tr>';


$text .= '</table></div>';



$text = $tp->toHTML($text, true, 'emotes_on');



$ns -> tablerender(ONLINEINFO_LIST_3, $text);


require_once(FOOTERF);
?>