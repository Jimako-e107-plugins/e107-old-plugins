<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Members Basic 1.0                                     |
| =============================                                    |
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

$sql1 = new db;
$sql2 = new db;
//Check for dubbels in members table	
$result = $sql->db_Select("clan_members_gamelink", "*");
	while($row = $sql->db_Fetch()){
		$member = $row['userid'];
		$gid = $row['gid'];	
		$id = $row['id'];
		$match = $sql1->db_Count("clan_members_info", "(*)", "WHERE userid='$member'");
		if($match == 0){
			$sql1->db_Delete("clan_members_gamelink", "userid='$member'");			
		}else{
			$match = $sql1->db_Count("clan_members_gamelink", "(*)", "WHERE userid='$member' and gid='$gid'");
			if($match > 1){
				$sql1->db_Delete("clan_members_gamelink", "id='$id'");
			}
		}
	}
//Check for dubbels in teammlink table	
$result = $sql->db_Select("clan_members_teamlink", "*");
	while($row = $sql->db_Fetch()){
		$member = $row['userid'];
		$tid = $row['tid'];	
		$id = $row['id'];
		$match = $sql1->db_Count("clan_members_info", "(*)", "WHERE userid='$member'");
		if($match == 0){
			$sql1->db_Delete("clan_members_teamlink", "userid='$member'");			
		}else{
			$match = $sql1->db_Count("clan_members_teamlink", "(*)", "WHERE userid='$member' and tid='$tid'");
			if($match > 1){
				$sql1->db_Delete("clan_members_teamlink", "id='$id'");
			}
		}
	}

//END CHECKS
if($conf['gamesorteams'] == "Games"){
	$catstable = "clan_games";
	$linktable = "clan_members_gamelink";
}else{
	$catstable = "clan_teams";
	$linktable = "clan_members_teamlink";
}

$firstarray = unserialize($conf['listorder']);
$secondarray = $firstarray['show'];

$cats = $sql->db_Count($catstable, "(*)", "WHERE inmembers='1'");

if($conf['show_opened']){
	$showgame = "expanded";
}else{
	$showgame = "collapsed";
}

?>
<link rel="StyleSheet" href="includes/jquery.fancybox.css" type="text/css" media="screen">
<script type="text/javascript" src="includes/jquery.fancybox.js"></script>
<script type="text/javascript" src="includes/jquery.jcollapser.js"></script>
<?php if($cats > 0){?>
<script type="text/javascript">
    clanm_jq(function() {
		<?php for($i=1;$i<=$cats;$i++){?>
        	clanm_jq("#cat<?php echo $i;?>").jcollapser({target: '#jcollapse<?php echo $i;?>', state: '<?php echo $showgame;?>'});
		<?php }?>
    });
</script>
<?php } ?>
<style type="text/css">
.collapse{					
	padding:<?php echo  $conf['padding'];?>px;
	cursor:pointer;
}

.expand{
	display:none;
	padding:<?php echo  $conf['padding'];?>px;
	cursor:pointer;
}
</style>
<?php
$games = $sql->db_Count("clan_games", "(*)", "WHERE inmembers='1'");
$teams = $sql->db_Count("clan_teams", "(*)", "WHERE inmembers='1'");

$text = "<center><table width='".$conf['listwidth']."' border='0' cellpadding='0' cellspacing='0'><tr><td>";
$j=0;
$i=0;
$images = 0;
$sql->db_Select($catstable, "*", "inmembers='1' ORDER BY position ASC");

		while($row = $sql->db_Fetch()) {
			if($conf['gamesorteams'] == "Games"){
				$gtid = $row['gid'];
				$gname = $row['gname'];
				$whereid = "gid";
			}else{
				$gtid = $row['tid'];
				$gname = $row['team_name'];
				$whereid = "tid";
			}
			$banner = $row['banner'];
			$i++;	
			
			$bannerimg = "";
			if($banner !="" && file_exists(e_IMAGE."clan/".strtolower($conf['gamesorteams'])."/$banner")){
				$bannerimg = "<img src='".e_IMAGE."clan/".strtolower($conf['gamesorteams'])."/$banner' border='0' />";
			}
				
		$text .= "<div id='cat$i' class='fborder'>\n
				<div class='collapse'>\n
				<table border='0' cellpadding='0' cellspacing='0' width='100%'>\n
					<tr>\n
						<td width='5' align='left'>$bannerimg</td>\n";
						if($conf['show_gname']){$text .= "<td nowrap align='left' valign='middle'>&nbsp;&nbsp;<b>$gname</b>&nbsp;&nbsp;</td>\n";}
					$text .= "</tr>\n
				</table></div>\n
				
				<div class='expand'>\n
				<table border='0' cellpadding='0' cellspacing='0' width='100%'>\n
					<tr>\n
						<td width='5' align='left'>$bannerimg</td>\n";
						if($conf['show_gname']){$text .= "<td nowrap align='left' valign='middle'>&nbsp;&nbsp;<b>$gname</b>&nbsp;&nbsp;</td>\n";}
					$text .= "</tr>\n
				</table></div>\n
				
			</div>\n";
		$text .= "<div id='jcollapse".$i."'>\n
				<table width='100%' class='fborder' style='border-top:0;'>\n";

$gmembers = $sql1->db_Count($linktable, "(*)", "WHERE $whereid='$gtid'");

if(ADMIN or !USER && $conf['guestviewcontactinfo']){
	$showcontact = true;	
}else{
	$showcontact = false;	
}

if($gmembers == 0){
	$text .=  "<tr><td class='forumheader3' style='text-align:center;'><br />"._NOMEMBERS."<br /><br /></td></tr>\n";
}else{

	if($conf['style'] == 0){
		$text .=   "<tr class='forumheader3'>";
		foreach($secondarray as $infoname){
			if(!in_array($infoname,array("Xfire","Steam","MSN","AIM","ICQ","YIM")) or $showcontact){
				$infotitle = $infolang[$infoname];
				$text .=  "<td class='fcaption' style='text-align:".$conf['titlealign'].";'><b>".$infotitle."</b></td>";
			}
		}
		$text .=   "</tr>";
	}
//, u.user_msnm, u.user_icq, u.user_yim, u.user_aim, u.points, u.user_posts
	$orderby = "u.user_name";
	$sql1->db_Select_gen("SELECT l.userid, u.user_name, i.birthday, i.joindate, i.avatar, i.xfire, i.steam, i.active, i.realname, i.gender, i.location, i.country 
		FROM #".$linktable." l
		INNER JOIN #clan_members_info i ON l.userid=i.userid 
		INNER JOIN #user u ON i.userid=u.user_id 
		WHERE l.$whereid='$gtid' 
		ORDER BY $orderby");
		
	$t = 0;
	while($row2 = $sql1->db_Fetch()){
		$memberid = $row2['userid'];
		$member = $row2['user_name'];
		$joindate = $row2['joindate'];
		$birthday = $row2['birthday'];
		$xfire = $row2['xfire'];
		$steam = $row2['steam'];
		$active = $row2['active'];
		$realname = $row2['realname'];
		$gender = $row2['gender'];
		$msn = $row2['user_msnm'];
		$icq = $row2['user_icq'];
		$yim = $row2['user_yim'];
		$aim = $row2['user_aim'];
		$points = $row2['points'];
		$from = $row2['location'];
		$country = $row2['country'];
		$posts = $row2['user_posts'];
		$points = $row2['points'];
		$avatar = $row2['avatar'];
		
		if($sql2->db_Count("clan_members_info", "(*)", "WHERE userid='$memberid'")==0){
			$sql2->db_Delete($linktable, "userid='$memberid'");
		}
		if($country == "" or !file_exists(e_IMAGE."clan/flags/$country.png")){
			$country = "Unknown";
		}
		
		// calculate age
		$dot = explode("-",$birthday);
		if($dot[0] !="" && $dot[1] !="" && $dot[2] !=""){
			$birthday = mktime(0,0,0,$dot[0],$dot[1],$dot[2]);
		}else{
			$birthday = 1;
		}
		if($birthday != 1){
			$age = date('Y') - $dot[2];
			if ((date('m') < $dot[0]) || (date('m') == $dot[0] && date('d') < $dot[1])){ 
				$age--; 
			}
		}else{
			$age='';
		}

	$url = "images/UserImages/$avatar";
		
//List Style
if($conf['style'] == 0){
	$text .=   "<tr>";
}else{
//Block Style

$blockwidth = number_format(100 / $conf['membersperrow'], 1);
if($t == 0){
	$text .=   '<tr>
				<td valign="top" align="left" width="'.$blockwidth.'%" class="forumheader3">';
	}else{
		$text .=   '<td valign="top" align="left" width="'.$blockwidth.'%" class="forumheader3">';
	}
	
	$text .=  '<table cellpadding="0" cellspacing="3" border="0" width="100%">
			<tr>';
	if(VisibleInfo("User Image")){		
		if(file_exists($url) && $avatar !=""){
			$wihei = "";
			$size = getimagesize($url);
			if($size[0] > $conf['maxwidth']){
				$wihei = "width='".$conf['maxwidth']."'";
				$newh = $conf['maxwidth'] / $size[0] * $size[1];
				if($newh > $conf['maxheight']){
					$wihei = "height='".$conf['maxheight']."'";
				}
			}elseif($size[1] > $conf['maxheight']){
				$wihei = "height='".$conf['maxheight']."'";
			}
		
			$text .=  '<td width="'.$conf['maxwidth'].'" valign="top"><a id="userimage'.$images.'" href="'.$url.'"><img src="'.$url.'" border="0" '.$wihei.'/></a></td>';
			$images++;
		}else{
			$text .=  '<td width="'.$conf['maxwidth'].'" valign="top"><img src="images/Profile/noimage.jpg" border="0" width="100" /></td>';
		}
	}	
	$text .=  "<td align='left' valign='top' style='padding-left:3px;'>";
}


	foreach($secondarray as $infoname){
	
	$newcontent = "";
	$infotitle = $infolang[$infoname];
	
	switch($infoname){
		case "User Image":
			if($conf['style'] == 0){
				if(file_exists($url) && $avatar !=""){
					$wihei = "";
					$size = getimagesize($url);
					if($size[0] > $conf['maxwidth']){
						$wihei = "width='".$conf['maxwidth']."'";
						$newh = $conf['maxwidth'] / $size[0] * $size[1];
						if($newh > $conf['maxheight']){
							$wihei = "height='".$conf['maxheight']."'";
						}
					}elseif($size[1] > $conf['maxheight']){
						$wihei = "height='".$conf['maxheight']."'";
					}
					$newcontent .= "<a id='userimage$images' href='$url'><img src='$url' border='0' $wihei/></a>";
					$images++;
				}else{
					$newcontent .=  "&nbsp;";
				}
			}
		break;
		case "Username":
			$newcontent = "$member";
		break;
		case "Games":			
			$sql2->db_Select_gen("SELECT g.icon, g.gname, g.abbr FROM #clan_games g, #clan_members_gamelink m WHERE g.inmembers='1' and m.userid='$memberid' AND g.gid=m.gid ORDER BY g.position ASC");
			$games = "";
			while($grow = $sql2->db_Fetch()){
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
			$newcontent =  $games;				
		break;
		case "Teams":			
			$sql2->db_Select_gen("SELECT t.icon, t.team_tag, t.team_name FROM #clan_teams t, #clan_members_teamlink m WHERE t.inmembers='1' and m.userid='$memberid' AND t.tid=m.tid ORDER BY t.position ASC");
			$teams = "";
			while($grow = $sql2->db_Fetch()){
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
			$newcontent =   $teams;				
		break;
		case "Join Date":
			if($joindate != 1) $newcontent = date($conf['joinformat'],$joindate);
		break;
		case "Realname":
			$newcontent = $realname;			
		break;
		case "Gender":
			if($gender !="")
			$newcontent = "$gender <img src='images/Profile/$gender.png' align='absmiddle'>";
		break;
		case "Age":
			$newcontent = $age;			
		break;
		case "Birthday":
			if($birthday != 1) $newcontent = date($conf['birthformat'],$birthday);
		break;
		case "Location":
			$newcontent =  $from;			
		break;
		case "Country":
			$newcontent = "<img src='".e_IMAGE."clan/flags/$country.png' border='0' title='$country' align='absmiddle'>";			
		break;
		case "Xfire":
			if($showcontact && $xfire !="")
			$newcontent = "<a href='http://www.xfire.com/profile/$xfire' target='_blank'>$xfire</a>";			
		break;
		case "Steam ID":
			if($showcontact && $steam !="")
			$newcontent = "<a href='http://steamcommunity.com/id/$steam' target='_blank'>$steam</a>";			
		break;
		case "MSN":
			if($showcontact && $msn !=""){
				if(!USER && $conf['changeatdot']){
					$msn = str_replace("@","[AT]",$msn);
					$msn = str_replace(".","[DOT]",$msn);
				}
				$newcontent = $msn;
			}
		break;
		case "AIM":
			if($showcontact && $aim !="")
			$newcontent = "<a href='aim:goim?screenname=$aim&message=Hello+Are+you+there?' target='_blank'>$aim</a>";
		break;
		case "ICQ":
			if($showcontact && $icq !="")
			$newcontent = "<a href='http://wwp.icq.com/scripts/search.dll?to=$icq' target='_blank'>$icq</a>";
		break;
		case "Yahoo":
			if($showcontact && $yim !="")
			$newcontent = "<a href='http://edit.yahoo.com/config/send_webmesg?.target=$yim&.src=pg' target='_blank'>$yim</a>";
		break;
		case "Posts":
			$newcontent = $posts;			
		break;
	}
	
	if($conf['style'] == 0){
		$text .=  "<td class='forumheader3' style='text-align: ".($infoname == "Username"? "left" : "center")."' nowrap>$newcontent</td>\n";
	}else{
		if($infoname == "Username"){
			$text .=  "<b>".$newcontent."</b><br />\n";
		}elseif($infoname !="" && $newcontent !=""){
			$text .=  $infotitle.": ".$newcontent."<br />\n";
		}
	}
}	
	
	if($conf['style'] == 0){
		$text .=   "</tr>";
	}else{
		$text .=  "</td></tr></table>\n";
		if($t < $conf['membersperrow']-1){
			$text .=   "</td>";	
			$t++;
		}else{
			$text .=  "</td></tr>";
			$t=0;
		}
	}
}
	

	}
	
	if($t > 0 && $conf['style'] == 1){					
		for($x=$t;$t<$conf['membersperrow'];$t++){
			$text .=  "<td bgcolor='$cmcolor2' width='250'>&nbsp;</td>";
		}
		$text .=   "</tr>";
	}
	
	$text .=  "</table></div><br /><br />\n";
}
$text .=  "</td></tr></table></center>\n";

//END NEW

if($images > 0){
?>
<script type="text/javascript">
   clanm_jq(document).ready(function() {
	<?php
	$i = 0;
	for($i=0;$i<$images;$i++){
	?>
		clanm_jq("a#userimage<?php echo $i;?>").fancybox();	
	<?php
		}
	?>
	});
</script>
<?php
}

if(is_clanmember(USERID)){
	if($conf['allowchangeinfo']){
		$text .= "<center><a href='clanmembers.php?editinfo'>"._CHANGEURINFO."</a><br /><br /></center>";
	}elseif(VisibleInfo("User Image") && $conf['allowupimage']){			
		$text .= "<center><a href='clanmembers.php?editinfo'>"._UPLOADURIMAGE."</a><br /><br /></center>";
	}
}

$ns->tablerender(_CLANMEMBERS, $text);


?>