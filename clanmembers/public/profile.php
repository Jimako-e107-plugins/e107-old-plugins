<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Members 1.0                                           |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/

if (!defined('CM_PUB')) {
    die ("You can't access this file directly...");
}
if (!$conf['enableprofile']) {
    $text .= "<center><br />"._PROFILEDISABLED."<br /><br /></center>";
	require_once(FOOTERF);
	exit;
}
if(!$conf['profiletoguests'] && !USER && !ADMIN){
    $text .= "<center><br />"._RESTRICTEDGUESTS."<br /><br /></center>";
	header("Refresh:1;URL=modules.php?name=$module_name");
	require_once(FOOTERF);
	exit;
}
if($conf['userimgsrc'] == 2) include(e_HANDLER."avatar_handler.php");
$memberid = intval($_GET['memberid']);
?>
<link rel="StyleSheet" href="includes/jquery.fancybox.css" type="text/css" media="screen" />
<style type="text/css">
#awardstable td{
	text-align:center;
}
div.mainwrap{
	width:450px;
	display:block;
	margin-bottom:1px;
	text-align:left;
}
</style>
<script type="text/javascript" src="includes/jquery.fancybox.js"></script>
<script type="text/javascript"> 
	<?php
	if($conf['showuserimage']){
	?>
		clanm_jq(document).ready(function() {
			clanm_jq("a#avatar").fancybox();
		});
	<?php
	}
	?>
    </script>
    <script type="text/javascript">
var memberid = <?php echo intval($memberid);?>;
var userid = <?php echo intval(USERID);?>;
var username = "<?php echo USERNAME;?>";
var is_admin = <?php echo ((ADMIN && getperms("P")) ? "true" : "false" ). ";\n";?>
var is_user = <?php echo ((USER) ? "true" : "false" ). ";\n";?>
//LANG
var edittext = "<?php echo _EDIT;?>";
var deltext = "<?php echo _DEL;?>";
var savetext = "<?php echo _SAVE;?>";
var canceltext = "<?php echo _CANCEL;?>";
var writecomm = "<?php echo _WRITECOMM;?>";
var loginfirstt = "<?php echo _LOGINFIRSTT;?>";
var erroraddcomm = "<?php echo _ERRORADDCOMM;?>";
var suredelcomm = "<?php echo _SUREDELCOMM;?>";
var errordelcomm = "<?php echo _ERRORDELCOMM;?>";
var errorsavecomm = "<?php echo _ERRORSAVECOMM;?>";
//END LANG

</script>
<script type="text/javascript" src="includes/comments.js"></script>
<?php
if(!defined("USER_WIDTH")) { define("USER_WIDTH","width:100%"); }

if(USER or $conf['guestviewcontactinfo']){
	$showcontact = true;	
}else{
	$showcontact = false;	
}
//Profile
$text = "<table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td align='right'><a href='clanmembers.php'>"._RETURNTOLIST."</a></td>
  </tr>
</table>";
$text .= "<table style='".USER_WIDTH."'>
	<tr><td width='100%' valign='top'>
<table width='100%' class='fborder'>";

	$sql->db_Select("clan_members_info", "*", "userid='$memberid'");	
	$row = $sql->db_Fetch();
		$rid = $row['rank'];
		$joindate = $row['joindate'];
		$birthday = $row['birthday'];
		$avatar = $row['avatar'];
		$xfire = $row['xfire'];
		$steam = $row['steam'];
		$active = $row['active'];
		$realname = $row['realname'];
		$from = $row['location'];
		$country = $row['country'];
		$gender = $row['gender'];
		$tryout = $row['tryout'];
		$votedate = date("j M", $row['votedate']);		

	$sql->db_Select("user", "user_name, user_sess, user_image", "user_id='$memberid'");	
	$row2 = $sql->db_Fetch();
		$member = $row2['user_name'];
		$user_sess = $row2['user_sess'];
		$user_image = $row2['user_image'];

		if($country == "" or !file_exists(e_IMAGE."clan/flags/$country.png")){
			$country = "Unknown";
		}
//NEW

		if($conf['rank_per_game'] == 0){
			//get rank name out of db
			$sql->db_Select("clan_members_ranks", "*", "rid='$rid'");	
			$rrow = $sql->db_Fetch();
			$rank = $rrow['rank'];
			$rimage = $rrow['rimage'];
			if($rimage !="" && file_exists("images/Ranks/$rimage")){
				$rimage = "<img src='images/Ranks/$rimage' border='0' title='$rank' />";
			}else{
				$rimage = "";
			}
		}else{
			$rank = "";
			$rimage = "";
			$sql->db_Select_gen("SELECT r.rank, r.rimage FROM #clan_members_gamelink m, #clan_members_ranks r WHERE m.userid='$memberid' AND m.rank=r.rid GROUP BY m.rank ORDER BY r.rankorder ASC");
			$ranks = $sql->db_Rows();
				while($rrow = $sql->db_Fetch()){
					$rank = "$rank, ".$rrow['rank'];
					$rankimage = $rrow['rimage'];
					if($rankimage !="" && file_exists("images/Ranks/$rankimage")){
						$rimage = "$rimage<img src='images/Ranks/$rankimage' border='0' title='".$rrow['rank']."' />&nbsp;";
					}
				}
				$rank = substr($rank,2);
		}
		// calculate age
		if($birthday != 1){
			$age = date('Y') - date('Y',$birthday);
			if ((date('m') < date('m',$birthday)) || (date('m') == date('m',$birthday) && date('d') < date('d',$birthday))){ 
				$age--; 
			}
			$birthday = date($conf['birthformat'],$birthday);
		}else{
			$age='';
			$birthday = "";
		}		
		
		if($joindate != 1){
			$joindate = date($conf['joinformat'],$joindate);
		}else{
			$joindate = "";
		}
			 
	$firstarray = unserialize($conf['profileorder']);
	$secondarray = $firstarray['show'];
		foreach($secondarray as $infoname){
		$infos = "";
		if($conf['rank_per_game'] == 1 && $ranks > 1 && ($infoname == "Rank" or $infoname == "Rank Image")){
			$infoname .= "s";
		}
		
		$infotitle = $infolang[$infoname];
		
switch($infoname){
		case "Username":
			$infos =  $member;
		break;
		case "Games":			
			$sql->db_Select_gen("SELECT g.icon, g.gname, g.abbr FROM #clan_games g, #clan_members_gamelink m WHERE g.inmembers='1' and m.userid='$memberid' AND g.gid=m.gid ORDER BY g.position ASC");
			$games = "";
			while($grow = $sql->db_Fetch()){
				$icon = $grow['icon'];
				$abbr = $grow['abbr'];
				$gname = $grow['gname'];
				$abbr = ($abbr?$abbr:$gname);
				if($icon !="" && file_exists(e_IMAGE."clan/games/$icon")){
					$games .= "<img src='".e_IMAGE."clan/games/$icon' border='0' title='$gname' alt='$abbr' />&nbsp;";
				}else{
					$games .= "$abbr, ";
				}
			}
			if(substr($games,-2) == ", ") $games = substr($games,0,-2);
			$infos = $games;				
		break;
		case "Teams":			
			$sql->db_Select_gen("SELECT t.icon, t.team_tag, t.team_name FROM #clan_teams t, #clan_members_teamlink m WHERE t.inmembers='1' and m.userid='$memberid' AND t.tid=m.tid ORDER BY t.position ASC");
			$teams = "";
			while($grow = $sql->db_Fetch()){
				$icon = $grow['icon'];
				$team_tag = $grow['team_tag'];
				$team_name = $grow['team_name'];
				if($icon !="" && file_exists(e_IMAGE."clan/teams/$icon")){
					$teams .= "<img src='".e_IMAGE."clan/teams/$icon' border='0' title='$team_name' alt='$team_tag' />&nbsp;";
				}else{
					$teams .= "$team_tag, ";
				}
			}
			if(substr($teams,-2) == ", ") $teams = substr($teams,0,-2);
			$infos = $teams;				
		break;
		case "Join Date":
			$infos =  $joindate;
		break;
		case "Rank":
		case "Ranks":			
			$infos =  $rank;
		break;
		case "Rank Image":
		case "Rank Images":
			$infos =  $rimage;
		break;
		case "Realname":
			$infos =  $realname;
		break;
		case "Gender":
			if($gender !="")
			$infos =  "$gender <img src='images/Profile/$gender.png' align='absmiddle'>";
		break;
		case "Age":
			$infos =  $age;
		break;
		case "Birthday":
			$infos =  $birthday;
		break;
		case "Location":
			$infos =  $from;
		break;
		case "Country":
			$infos =  "<img src='".e_IMAGE."clan/flags/$country.png' border='0' alt='$country'> $country";
		break;
		case "Xfire":
			if($showcontact && $xfire !="")
			$infos =  "<a href='http://www.xfire.com/profile/$xfire' target='_blank'>$xfire&nbsp;</a>";
		break;
		case "Steam ID":
			if($showcontact && $steam !="")
			$infos =  "<a href='http://www.vacbanned.com/view/detail/id/$steam' target='_blank'>$steam</a>";
		break;
		case "MSN":
			if($showcontact && $msn !=""){
				if(!USER && $conf['changeatdot']){
					$msn = str_replace("@","[AT]",$msn);
					$msn = str_replace(".","[DOT]",$msn);
				}
				$infos =  $msn;
			}
		break;
		case "AIM":
			if($showcontact && $aim !="")
			$infos =  "<a href='aim:goim?screenname=$aim&message=Hello+Are+you+there?' target='_blank'>$aim</a>";			
		break;
		case "ICQ":
			if($showcontact && $icq !="")
			$infos =  "<a href='http://wwp.icq.com/scripts/search.dll?to=$icq' target='_blank'>$icq</a>";
		break;
		case "Yahoo":
			if($showcontact && $yim !="")
			$infos =  "<a href='http://edit.yahoo.com/config/send_webmesg?.target=$yim&.src=pg' target='_blank'>$yim</a>";
		break;
		case "Points":
			$infos =  "$points";
		break;
		case "Posts":
			$infos =  "$posts";
		break;
		case "Activity":			
			if($active == 1){
				$infos = "<font color='#008000'>"._ACTIVE."</font>";
			}else{
				$infos = "<font color='#FF0000'>"._INACTIVE."</font>";
			}
		break;
		case "Tryout":			
			if($tryout) $infos = $votedate;
		break;
		//Begin Wars
		case "Wars Played":
			if(isset($pref['plug_installed']['clanwars'])){
				$wars_played = $sql->db_Count("clan_wars_lineup", "(*)", "WHERE member='$memberid' AND available='2'");
				if($wars_played > 0)
				$infos = $wars_played;
			}
		break;
		case "Last War":
			if(isset($pref['plug_installed']['clanwars'])){
				$sql->db_Select_gen("SELECT w.opp_tag, w.wid FROM #clan_wars w, #clan_wars_lineup l WHERE w.wid = l.wid AND l.member='$memberid' AND l.available='2' ORDER BY wardate DESC LIMIT 1");
				$row5 = $sql->db_Fetch();
				$opp_tag = $row5['opp_tag'];
				$wid = $row5['wid'];
				if($opp_tag !="")
				$infos = "<a href='modules.php?name=Wars&op=Details&wid=$wid'>$opp_tag</a>";							
			}
		break;
		//End Wars
}
		//display info
		if($infos !=""){
			$text .= "<tr>
					<td class='forumheader2' style='text-align:".$conf['profilealign'].";' width='".$conf['leftsidewidth']."'><b>".$infolang[$infoname]."</b></td>
					<td class='forumheader3' align='left'>$infos</td>
				</tr>";	
		}
	}
	
$text .= "</table></td>";

$url = "";
if($conf['userimgsrc'] == 0){
	$url = "images/UserImages/$avatar";
}elseif($conf['userimgsrc'] == 1){
	$avatar = $user_sess;
	$url = e_FILE."public/avatars/".$avatar;
}elseif($conf['userimgsrc'] == 2){
	$avatar = $user_image;
	$url = avatar($avatar);
}
if(file_exists($url) && $avatar !="" && $conf['showuserimage']){
	$wihei = "";
	$size = getimagesize($url);
	if($size[0] > $conf['profileimgwidth'] && $conf['profileimgwidth'] > 0){
		$wihei = "width='".$conf['profileimgwidth']."'";
		$newh = $conf['profileimgwidth'] / $size[0] * $size[1];
		if($newh > $conf['profileimgheight'] && $conf['profileimgheight'] > 0){
			$wihei = "height='".$conf['profileimgheight']."'";
		}
	}elseif($size[1] > $conf['profileimgheight'] && $conf['profileimgheight'] > 0){
		$wihei = "height='".$conf['profileimgheight']."'";
	}
$text .= "<td class='forumheader2' valign='top' style='margin:2px;'><a href='$url' id='avatar'><img src='$url' $wihei border='0'></a></td>";
}
$text .= "</tr></table>";

$ns->tablerender(_MEMBERINFO, $text);

//Hardware
if($conf['enablehardware']){
	$components = array('manufacturer', 'cpu', 'mainboard', 'memory', 'hdd', 'vga', 'monitor', 'sound', 'speakers', 'keyboard', 'mouse', 'surface', 'os', 'pccase');
	
	$contents = "";
	for($i=0;$i<count($components);$i++){
		if($row[$components[$i]] !=""){
		$contents .= "<tr>
				<td class='forumheader2' style='text-align:".$conf['profilealign'].";' width='".$conf['leftsidewidth']."'><b>".$infolang[$components[$i]]."</b></td>
				<td class='forumheader3' align='left'>".$row[$components[$i]]."&nbsp;</td>
			</tr>";
		}
	}

	if($contents !=""){
		$text = "<table style='".USER_WIDTH."' class='fborder'>";
		$text .= $contents;
		$text .= "</table>";
		$ns->tablerender(_HARDWAREINFO, $text);
	}
}


//Gallery
if($conf['enablegallery']){
	?>
	<link rel="StyleSheet" href="includes/jquery.fancybox.css" type="text/css" media="screen">
	<script type="text/javascript" src="includes/jquery.fancybox.js"></script>
	<script type="text/javascript">
		clanm_jq(document).ready(function() {
			clanm_jq("a.gallery").fancybox();
		});
	</script>
	
	<?php
	$result = $sql->db_Select("clan_members_gallery", "*", "userid='$memberid'");
	$images = $sql->db_Rows();
	
	if($images > 0 or USERNAME == $member or ADMIN){
		$title = "<b>"._MEMBERSGALLERY."</b>";
		if(USERNAME == $member){
			$title .= "&nbsp;(<a href='clanmembers.php?gallery'>"._MANAGE."</a>)";
		}elseif(ADMIN){
			$title .= "&nbsp;(<a href='clanmembers.php?gallery&memberid=$memberid'>"._MANAGE."</a>)";
		}
		$text = "";
		if($images > 0){
			$text = "<table style='".USER_WIDTH."' class='fborder'>";
			$text .= "<tr bgcolor='$cmcolor2'>
					<td class='forumheader3' align='center'>";
					
					while($row = $sql->db_Fetch()){
						$url = "images/Gallery/".$row['url'];
						$width = "";
						if($url !="" && file_exists($url)){
							$size = getimagesize($url);
							if($size[0] > $conf['thumbwidth']){
								$width = "width='".$conf['thumbwidth']."'";
							}
							$text .= "<a class='gallery' rel='gallery' href='$url'><img src='$url' $width border='0'></a> ";
						}
					}
					
					$text .= "</td>
				</tr>
			</table>";
		}
	}
	$ns->tablerender($title, $text);
}

//Awards
$sql->db_Select_gen("SELECT a.title, a.description, a.image FROM #clan_members_awards a, #clan_members_awardlink l  WHERE a.rid=l.award AND l.userid='$memberid' ORDER BY position ASC");
if($sql->db_Rows() > 0 && $conf['showawards']){
	$text = "<table style='".USER_WIDTH."' class='fborder' id='awardstable'>";
	while($row = $sql->db_Fetch()){
		$title = $row['title'];
		$description = $row['description'];
		$image = $row['image'];
		
		$img = "";
		if(file_exists("images/Awards/$image") && $image !=""){
			$img = "<img src='images/Awards/$image' class='showpointer'>";
		}

	$text .= "<tr id='$rid'>
			<td class='forumheader3' align='center' valign='middle' width='15%'>$img</td>			
			<td class='forumheader3' align='center' valign='middle' width='15%'>$title</td>
			<td class='forumheader3' align='center' valign='middle'>$description</td>
		</tr>";
	}
	$text .= "</table>";
	$ns->tablerender(_MEMBERSAWARDS, $text);
}

//Comments

if(/*check_class($conf['commentsclass'])*/1==1){

$text = "<table width='100%' class='fborder'>
				<tr>
					<td align='left'><div id='commentsdiv'>";
	$sql->db_Select("clan_members_comments", "*", "userid='$memberid' order by postdate DESC, cid DESC");
		while ($row = $sql->db_Fetch()) {
			$cid = $row['cid'];
			$posterid = $row['posterid'];
			$poster = cm_getuser_name($posterid);
			$comment = $row['comment'];
			$postdate = $row['postdate'];
			
		$text .= "<div class='mainwrap forumheader3' id='comment$cid'>
				<table width='100%' cellpadding='2' cellspacing='0' border='0'>
					<tr>
						<td width='100%' align='left' valign='top'><b>$poster</b><br /><div id='commenttext$cid' style='padding-left:2px;'>".nl2br($comment)."</div></td>";
					$text .= "</tr>
				</table>
			</div>";
		}
	$text .= "</div>";

	
	$text .= "</td></tr></table>";
	$ns->tablerender(_COMMENTS, $text);
} 

if(USERID == $memberid){
	if($conf['allowchangeinfo']){
		echo "<br /><center><a href='clanmembers.php?editinfo'>"._CHANGEURINFO."</a><br /></center>";
	}elseif(VisibleInfo("User Image") && $conf['allowupimage']){			
		echo "<br /><center><a href='clanmembers.php?editinfo'>"._UPLOADURIMAGE."</a><br /></center>";
	}
}
if(ADMIN){
	echo "<br /><center><b>"._CMADMIN.":</b> <a href='admin.php?editmember&memberid=$memberid'>"._EDITMEMBER."</a><br /><br /></center>";
}

?>