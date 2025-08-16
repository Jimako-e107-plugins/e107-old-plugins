<?php
/*
+ -----------------------------------------------------------------+
| e107: Challenge Us 1.0                                           |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/
if (!(defined('CHAL_ADMIN') && preg_match("/admin.php\?Challenge/i", $_SERVER['REQUEST_URI']))
	 && 
	!(defined('CHAL_MOD') && preg_match("/challengeus.php\?Challenge/i", $_SERVER['REQUEST_URI']) && in_array(USERNAME, $conf['specialprivs']) && USER)) {
    die ("Access denied.");
}
?>
<style type="text/css">
.chaltitle{
	font-size:1.1em;
	font-weight: bold;
}
#challengetable td{
	padding: 1px;
}
</style>
<script type="text/javascript">
	var incfile = "<?php echo ($incfile !=""?$incfile:"admin");?>";
	var suredelchal = "<?php echo _SUREDELCHAL;?>";
	var errordelchal = "<?php echo _ERRORDELCHAL;?>";
</script>
<script type="text/javascript" src="includes/challenge.js"></script>
<?php
$cid = intval($_GET['cid']);
$sql->db_Select("clan_challenges", "*", "cid='$cid'");
$row = $sql->db_Fetch();
	$username = $row['username'];
	$email = $row['email'];
	$msn = $row['msn'];
	$xfire = $row['xfire'];
	$clantag = $row['clantag'];
	$clanname = $row['clanname'];
	$clansite = $row['clansite'];
	$country = $row['country'];
	$chdate = $row['chdate'];
	$game = $row['game'];
	$teams = explode(",",$row['teams']);
	$map = $row['map'];
	$players = $row['players'];
	$serverip = $row['ip'];
	$serverpw = $row['pw'];
	$extrainfo = $row['extra'];
	$challdate = $row['date'];
	
	$teamnames = "";
	foreach($teams as $team){
		if(intval($team) > 0){
			$sql->db_Select("clan_teams", "team_name", "tid='$team'");
			$row = $sql->db_Fetch();
			$team_name = $row['team_name'];
			$teamnames .= ", ".$team_name;
		}
	}
	$teamnames = substr($teamnames, 2);

$text = "<center><font class='chaltitle'><b>"._CHAON." ".date("j M Y", $challdate)."</b></font><br><br>
    <table id='challengetable' width='200'>
	<tr><td colspan='2'><font class='chaltitle'><b>"._URINFO."</b></font><br></td></tr>
    <tr><td><b>"._NAME.": </b></td><td nowrap>$username</td></tr>
    <tr><td><b>"._EMAIL.": </b></td><td nowrap><a href='mailto:$email'>$email</a></td></tr>
    <tr><td><b>"._MSN.": </b></td><td nowrap>$msn</td></tr>
	<tr><td><b>"._XFIRE.": </b></td><td>$xfire</td></tr>
	
	<tr><td colspan='2'><br><font class='chaltitle'><b>"._CLANINFO."</b></font></td></tr>
    <tr><td><b>"._TAG.": </b></td><td nowrap>$clantag</td></tr>
    <tr><td><b>"._NAME.": </b></td><td nowrap>$clanname</td></tr>
	<tr><td><b>"._SITE.": </b></td><td nowrap><a href='$clansite' target='_blank'>$clansite</a></td></tr>
	<tr><td><b>"._COUNTRY.": </b></td><td nowrap>$country <img src='".e_IMAGE."clan/flags/$country.png' /></td></tr>	
	
	<tr><td colspan='2'><br><font class='chaltitle'><b>"._MTCHINFO."</b></font></td></tr>
   <tr><td> <b>"._DATE.": </b></td><td nowrap>".date("j M Y H:i", $chdate)."</td></tr>
    <tr><td><b>"._GAME.": </b></td><td nowrap>";
	if(intval($game) > 0 && $conf['linkwars']){
		$sql->db_Select("clan_games", "gname", "gid='$game'");
		$row = $sql->db_Fetch();
		$text .= $row['gname'];
	}else{
		$text .= $game;
	}
	$text .= "</td></tr>
    <tr><td><b>"._TEAMS.": </b></td><td nowrap>$teamnames</td></tr>
    <tr><td><b>"._MAP.": </b></td><td nowrap>$map</td></tr>
    <tr><td><b>"._PLAYERS.": </b></td><td nowrap>$players"."on"."$players</td></tr>

	<tr><td colspan='2'><br><font class='chaltitle'><b>"._SRVRINFO."</b></font></td></tr>
    <tr><td><b>"._IP.": </b></td><td>$serverip</td></tr>
    <tr><td><b>"._PW.": </b></td><td>$serverpw</td></tr>";
	
	if($extrainfo !=""){
		$text .= "<tr><td colspan='2'><br><font class='chaltitle'><b>"._OTHERINFO."</b></font></td></tr>
		<tr><td colspan='2'>$extrainfo</td></tr>";
	}
	
$text .= "</table><br /><br />";
if($conf['linkwars']){
	$text .= "<form action='".($incfile !=""?$incfile:"admin").".php?AddWar' method='post'>
	<input type='hidden' value='$clantag' name='clantag' />
	<input type='hidden' value='$clanname' name='clanname' />
	<input type='hidden' value='$clansite' name='clansite' />
	<input type='hidden' value='$country' name='country' />
	<input type='hidden' value='$chdate' name='chdate' />
	<input type='hidden' value='$game' name='game' />
	<input type='hidden' value='$map' name='map' />
	<input type='hidden' value='$players' name='players' />
	<input type='hidden' value='$serverip' name='serverip' />
	<input type='hidden' value='$serverpw' name='serverpw' />
	<input type='hidden' name='e-token' value='".e_TOKEN."' />
	<input type='submit' class='button' value='"._ADDTOWARS."' />&nbsp;";
}
$text .= "<input type='button' class='button' value='"._DELLCHA."' onclick=\"DelChallenge($cid);\" />&nbsp;<input type='button' class='button' value='"._JUGOBACK."' onclick=\"window.location='".($incfile !=""?$incfile:"admin").".php'\" />";
if($conf['linkwars']) $text .= "</form>";
$text .= "</center>";

$ns->tablerender(_CHALLENGE,$text);
?>