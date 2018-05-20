<?php
// Remember that we must include class2.php
require_once("../../class2.php");
require_once(e_PLUGIN."ebattles/include/main.php");
// Include page header stuff for admin pages
$eplug_css = array(
"css/paginate.css",
"css/ebattles.css",
"css/custom-theme/jquery-ui-1.8.16.custom.css"
);
require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."userclass_class.php");
require_once(e_PLUGIN."ebattles/include/paginator.class.php");

// Check current user is an admin, redirect to main site if not
if (!getperms("P")) {
	header("location:".e_HTTP."index.php");
	exit;
}

if (isset($_POST['updatesettings'])) {
	unset($_POST['updatesettings']);
	foreach($_POST as $key => $value)
	{
	    $_POST[$key] = $tp->toDB($value);
	}
	$pref['eb_events_update_delay'] = $_POST['eb_events_update_delay'];
	$pref['eb_events_update_delay_enable'] = $_POST['eb_events_update_delay_enable'];
	$pref['eb_events_create_class'] = $_POST['eb_events_create_class'];
	$pref['eb_events_create_class'] = $_POST['eb_events_create_class'];
	$pref['eb_teams_create_class'] = $_POST['eb_teams_create_class'];
	$pref['eb_media_submit_class'] = $_POST['eb_media_submit_class'];
	$pref['eb_mod_class'] = $_POST['eb_mod_class'];
	$pref['eb_tab_theme'] = $_POST['eb_tab_theme'];
	$pref['eb_max_image_size_check'] = $_POST['eb_max_image_size_check'];
	$pref['eb_max_image_size'] = $_POST['eb_max_image_size'];
	$pref['eb_max_map_image_size_check'] = $_POST['eb_max_map_image_size_check'];
	$pref['eb_max_map_image_size'] = $_POST['eb_max_map_image_size'];
	$pref['eb_default_items_per_page'] = $_POST['eb_default_items_per_page'];
	$pref['eb_max_avatar_size'] = $_POST['eb_max_avatar_size'];
	$pref['eb_avatar_enable_playersstandings'] = $_POST['eb_avatar_enable_playersstandings'];
	$pref['eb_avatar_default_image'] = $_POST['eb_avatar_default_image'];
	$pref['eb_avatar_enable_teamsstandings'] = $_POST['eb_avatar_enable_teamsstandings'];
	$pref['eb_avatar_enable_teamslist'] = $_POST['eb_avatar_enable_teamslist'];
	$pref['eb_avatar_default_team_image'] = $_POST['eb_avatar_default_team_image'];
	$pref['eb_disclaimer'] = $_POST['eb_disclaimer'];
	$pref['eb_pm_notifications_class'] = $_POST['eb_pm_notifications_class'];
	$pref['eb_email_notifications_class'] = $_POST['eb_email_notifications_class'];
	save_prefs();
	$message = EB_ADMIN_L1;
}
if (isset($_POST['updatelinks'])) {
	unset($_POST['updatelinks']);
	foreach($_POST as $key => $value)
	{
	    $_POST[$key] = $tp->toDB($value);
	}
	$pref['eb_links_menuheading'] = $_POST['eb_links_menuheading'];
	$pref['eb_links_showcreateevent'] = $_POST['eb_links_showcreateevent'];
	$pref['eb_links_showcreateevent'] = $_POST['eb_links_showcreateevent'];
	$pref['eb_links_showcreateteam'] = $_POST['eb_links_showcreateteam'];
	$pref['eb_links_showmatchsplayed'] = $_POST['eb_links_showmatchsplayed'];
	$pref['eb_links_showmatchstoapprove'] = $_POST['eb_links_showmatchstoapprove'];
	$pref['eb_links_showmatchspending'] = $_POST['eb_links_showmatchspending'];
	$pref['eb_links_showmatchesscheduled'] = $_POST['eb_links_showmatchesscheduled'];
	$pref['eb_links_showchallengesrequested'] = $_POST['eb_links_showchallengesrequested'];
	$pref['eb_links_showchallengesunconfirmed'] = $_POST['eb_links_showchallengesunconfirmed'];

	save_prefs();
	$message = EB_ADMIN_L1;
}
if (isset($_POST['update_activity'])) {
	unset($_POST['update_activity']);
	foreach($_POST as $key => $value)
	{
	    $_POST[$key] = $tp->toDB($value);
	}
	$pref['eb_activity_menuheading'] = $_POST['eb_activity_menuheading'];
	$pref['eb_activity_number_of_items'] = $_POST['eb_activity_number_of_items'];
	$pref['eb_activity_max_image_size_check'] = $_POST['eb_activity_max_image_size_check'];
	$pref['eb_activity_max_image_size'] = $_POST['eb_activity_max_image_size'];
	save_prefs();
	$message = EB_ADMIN_L1;
}
if (e_QUERY)
{
	$qs = explode(".", e_QUERY);
}
if (isset($_POST['eb_events_insert_data']))
{
	@require_once(e_PLUGIN."ebattles/db_admin/insert_data.php");
	insert_eb_debug_data();
	$message .= EB_ADMIN_L11;
}

if (isset($message)) {
	$ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}

// ========================================================
//				LINKS OPTIONS MENU
// ========================================================
if((isset($qs[0]) && $qs[0] == "eb_links"))
{
	$text .= "<div style='text-align:center'>
	<form id='adminform' method='post' action='".e_SELF."?eb_links'>
	<table style='".ADMIN_WIDTH."' class='fborder'>
	<tbody>
	";

	$text .= "<tr>
	<td class='forumheader3' style='width:40%'>".EB_ADMIN_L27.":</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='text' name='eb_links_menuheading' size='20' value='".$pref['eb_links_menuheading']."'/>
	</td>
	</tr>
	";

	$text .= "<tr>
	<td class='forumheader3' style='width:40%'>".EB_ADMIN_L46.":</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='checkbox' name='eb_links_showcreateevent' value='1' ".($pref['eb_links_showcreateevent'] == 1 ? "checked='checked'" :"")."/>
	</td>
	</tr>
	";

	$text .= "<tr>
	<td class='forumheader3' style='width:40%'>".EB_ADMIN_L47.":</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='checkbox' name='eb_links_showcreateteam' value='1' ".($pref['eb_links_showcreateteam'] == 1 ? "checked='checked'" :"")."/>
	</td>
	</tr>
	";

	$text .= "<tr>
	<td class='forumheader3' style='width:40%'>".EB_ADMIN_L48.":</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='checkbox' name='eb_links_showmatchsplayed' value='1' ".($pref['eb_links_showmatchsplayed'] == 1 ? "checked='checked'" :"")."/>
	</td>
	</tr>
	";

	$text .= "<tr>
	<td class='forumheader3' style='width:40%'>".EB_ADMIN_L49.":</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='checkbox' name='eb_links_showmatchstoapprove' value='1' ".($pref['eb_links_showmatchstoapprove'] == 1 ? "checked='checked'" :"")."/>
	</td>
	</tr>
	";

	$text .= "<tr>
	<td class='forumheader3' style='width:40%'>".EB_ADMIN_L50.":</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='checkbox' name='eb_links_showmatchspending' value='1' ".($pref['eb_links_showmatchspending'] == 1 ? "checked='checked'" :"")."/>
	</td>
	</tr>
	";

	$text .= "<tr>
	<td class='forumheader3' style='width:40%'>".EB_ADMIN_L51.":</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='checkbox' name='eb_links_showmatchesscheduled' value='1' ".($pref['eb_links_showmatchesscheduled'] == 1 ? "checked='checked'" :"")."/>
	</td>
	</tr>
	";

	$text .= "<tr>
	<td class='forumheader3' style='width:40%'>".EB_ADMIN_L52.":</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='checkbox' name='eb_links_showchallengesrequested' value='1' ".($pref['eb_links_showchallengesrequested'] == 1 ? "checked='checked'" :"")."/>
	</td>
	</tr>
	";

	$text .= "<tr>
	<td class='forumheader3' style='width:40%'>".EB_ADMIN_L53.":</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='checkbox' name='eb_links_showchallengesunconfirmed' value='1' ".($pref['eb_links_showchallengesunconfirmed'] == 1 ? "checked='checked'" :"")."/>
	</td>
	</tr>
	";

	$text .= "<tr>
	<td  class='eb_td2' colspan='3' style='text-align:center'>
	<input class='button' type='submit' name='updatelinks' value='".EB_ADMIN_L28."' />
	</td>
	</tr>
	</tbody>
	</table>
	</form>
	</div>";

	// The usual, tell e107 what to include on the page
	$ns->tablerender(EB_ADMIN_L10, $text);
}

// ========================================================
//				GAMES OPTIONS MENU
// ========================================================
if((isset($qs[0]) && ((preg_match("/eb_games/",$qs[0])||(isset($_GET['gameid']))))))
{
	require_once(e_PLUGIN."ebattles/include/ebattles_header.php");
	$text .= "
	<script type='text/javascript'>
	<!--//
	function changeTextGameIcon(v)
	{
	document.getElementById('gameIcon').value=v;
	}
	function changeTextGameMap(v,n)
	{
	document.getElementById('mapname').value=n;
	document.getElementById('mapimage').value=v;
	}
	function changeTextGameFaction(v,n)
	{
	document.getElementById('factionname').value=n;
	document.getElementById('factionicon').value=v;
	}
	//-->
	</script>
	<script type='text/javascript'>
	<!--//
	function selectAll(x) {
	for(var i=0,l=x.form.length; i<l; i++)
	if(x.form[i].type == 'checkbox' && x.form[i].name != 'sAll')
	x.form[i].checked=x.form[i].checked?false:true
	}
	//-->
	<!--//
	function buttonval(v)
	{
	document.getElementById('delete_game').value=v;
	document.getElementById('gamesform').submit();
	}
	//-->
	</script>
	<script type='text/javascript'>
	<!--//
	function del_faction(v)
	{
	document.getElementById('del_faction').value=v;
	document.getElementById('gamefactionsform').submit();
	}
	//-->
	</script>
	<script type='text/javascript'>
	<!--//
	function edit_faction(v)
	{
	document.getElementById('edit_faction').value=v;
	document.getElementById('gamefactionsform').submit();
	}
	//-->
	</script>
	<script type='text/javascript'>
	<!--//
	function del_map(v)
	{
	document.getElementById('del_map').value=v;
	document.getElementById('gamemapsform').submit();
	}
	//-->
	</script>
	<script type='text/javascript'>
	<!--//
	function edit_map(v)
	{
	document.getElementById('edit_map').value=v;
	document.getElementById('gamemapsform').submit();
	}
	//-->
	</script>
	";

	$text .= '
	<form action="'.htmlspecialchars($_SERVER['PHP_SELF']).'" method="get">
	<table>
	<tbody>
	';
	//<!-- Game Select -->
	// Drop down list to select Games to display
	$q = "SELECT ".TBL_GAMES.".*"
	." FROM ".TBL_GAMES
	." ORDER BY Name";
	$result = $sql->db_Query($q);
	$numGames = mysql_numrows($result);

	if (!isset($_GET['gameid'])) $_GET['gameid'] = mysql_result($result,0 , TBL_GAMES.".GameID");
	$game_id = intval($_GET['gameid']);

	$q2 = "SELECT ".TBL_GAMES.".*"
	." FROM ".TBL_GAMES
	." WHERE (".TBL_GAMES.".GameID = '$game_id')";

	$result2 = $sql->db_Query($q2);
	$game_name  = mysql_result($result2,0 , TBL_GAMES.".Name");
	$game_shortname  = mysql_result($result2,0 , TBL_GAMES.".ShortName");
	$game_matchtypes  = mysql_result($result2,0 , TBL_GAMES.".MatchTypes");
	$game_icon  = mysql_result($result2,0 , TBL_GAMES.".Icon");

	$text .= '
	<tr>
	<td>'.EB_GAME_L3.'</td>
	<td>
	<select class="tbox" name="gameid" onchange="this.form.submit()">';
	for($i=0; $i<$numGames; $i++)
	{
		$gname  = mysql_result($result,$i, TBL_GAMES.".Name");
		$gid    = mysql_result($result,$i, TBL_GAMES.".GameID");

		if ($game_id == $gid)
		{
			$text .= '<option value="'.$gid.'" selected="selected">'.htmlspecialchars($gname).'</option>';
		}
		else
		{
			$text .= '<option value="'.$gid.'">'.htmlspecialchars($gname).'</option>';
		}
	}
	$text .= '</select>';
	$text .= '</td>';
	$text .= '</tr>';
	$text .= '</tbody>';
	$text .= '</table>';
	$text .= '</form>';

	// ============================================
	$text .= '<div id="tabs">';
	$text .= '<ul>';
	$text .= '<li><a href="#tabs-1">'.EB_GAME_L11.'</a></li>';
	$text .= '<li><a href="#tabs-2">'.EB_GAME_L12.'</a></li>';
	$text .= '<li><a href="#tabs-3">'.EB_GAME_L13.'</a></li>';
	$text .= '</ul>';

	/**
	* Display Game Info
	*/
	$text .= '<div id="tabs-1">';

	$text .= '<form id="gameform" action="'.e_PLUGIN.'ebattles/gameprocess.php?gameid='.$game_id.'" method="post">';
	$text .= '<table class="fborder" style="width:95%">';
	$text .= '<tbody>';
	//<!-- Game Name -->
	$text .= '
	<tr>
	<td class="forumheader3">'.EB_GAME_L4.'</td>
	<td class="forumheader3">
	<input class="tbox" type="text" name="gameName" value="'.$game_name.'"/>
	</td>
	</tr>
	';

	//<!-- Game Short Name -->
	$text .= '
	<tr>
	<td class="forumheader3">'.EB_GAME_L32.'</td>
	<td class="forumheader3">
	<input class="tbox" type="text" name="gameShortName" value="'.$game_shortname.'"/>
	</td>
	</tr>
	';

	//<!-- Match types -->
	$text .= '
	<tr>
	<td class="forumheader3">'.EB_GAME_L33.'</td>
	<td class="forumheader3">
	<input class="tbox" type="text" name="gameMatchTypes" value="'.$game_matchtypes.'"/>
	<div class="smalltext">'.EB_GAME_L34.'</div>
	</td>
	</tr>
	';

	//<!-- Game Icon -->
	$text .= '
	<tr>
	<td class="forumheader3">'.EB_GAME_L5.'</td>
	<td class="forumheader3">
	<img '.getGameIconResize($game_icon).'/>
	<input class="tbox" type="text" id="gameIcon" name="gameIcon" value="'.$game_icon.'"/>
	<div class="smalltext">'.EB_GAME_L6.'</div>';

	$text .= '<div>';
	$avatarlist[0] = "";
	$handle = opendir(e_PLUGIN."ebattles/images/games_icons/");
	while ($file = readdir($handle))
	{
		if ($file != "." && $file != ".." && $file != "index.html" && $file != ".svn" && $file != "Games List.csv")
		{
			$gameiconslist[] = $file;
		}
	}
	closedir($handle);

	for($c = 1; $c <= (count($gameiconslist)-1); $c++)
	{
		$text .= '<a href="javascript:changeTextGameIcon(\''.$gameiconslist[$c].'\')"><img src="'.e_PLUGIN.'ebattles/images/games_icons/'.$gameiconslist[$c].'" style="border:0" alt="" /></a> ';
	}
	$text .= '
	</div>
	';

	$text .= '
	</td>
	</tr>
	</tbody>
	</table>
	';

	//<!-- Save, Add new Game, Delete Game Button -->
	$text .= '
	<table><tr>
	<td>
	<input class="eb_button" type="submit" name="gamesettingssave" value="'.EB_GAME_L7.'"/>
	</td>
	<td>
	<input class="eb_button" type="submit" name="gamecreate" value="'.EB_GAME_L8.'"/>
	</td>
	<td>
	<input class="eb_button" type="submit" name="gamedelete" value="'.EB_GAME_L9.'" onclick="return confirm(\''.EB_GAME_L10.'\');"/>
	</td>
	</tr>
	</table>
	</form>
	';
	$text .= '</div>';  // Games Info tab-page

	$text .= '<div id="tabs-2">';
	//<!-- Game Factions -->
	// List of all Factions
	$q_Factions = "SELECT ".TBL_FACTIONS.".*"
	." FROM ".TBL_FACTIONS
	." WHERE (".TBL_FACTIONS.".Game = '$game_id')";
	$result_Factions = $sql->db_Query($q_Factions);
	$numFactions = mysql_numrows($result_Factions);
	//dbg: echo "numFactions $numFactions<br>";

	$text .= '<table class="fborder" style="width:95%"><tbody>';
	$text .= '<form id="gamefactionsform" action="'.e_PLUGIN.'ebattles/gameprocess.php?gameid='.$game_id.'" method="post">';
	$text .= '<input type="hidden" id="edit_faction" name="edit_faction" value=""/>';
	$text .= '<input type="hidden" id="del_faction" name="del_faction" value=""/>';
	$text .= '<tr>';
	$text .= '<td class="forumheader3">'.EB_GAME_L14.'</td>';
	$text .= '<td class="forumheader3">'.EB_GAME_L15.'</td>';
	$text .= '<td class="forumheader3">'.EB_GAME_L16.'</td>';
	$text .= '<td class="forumheader3">'.EB_GAME_L17.'</td>';
	$text .= '</tr>';

	for ($faction = 0; $faction < $numFactions; $faction++)
	{
		$fID = mysql_result($result_Factions,$faction , TBL_FACTIONS.".FactionID");
		$fIcon = mysql_result($result_Factions,$faction , TBL_FACTIONS.".Icon");
		$fName = mysql_result($result_Factions,$faction , TBL_FACTIONS.".Name");

		$text .= '<tr>';
		$text .= '<td class="forumheader3"><img '.getFactionIconResize($fIcon).'/></td>';
		$text .= '<td class="forumheader3"><input class="tbox" type="text" name="factionname'.$fID.'" size="20" value="'.$fName.'" maxlength="32"/></td>';
		$text .= '<td class="forumheader3"><input class="tbox" type="text" name="factionicon'.$fID.'" size="40" value="'.$fIcon.'" maxlength="64"/></td>';
		$text .= '<td class="forumheader3">';
		$text .= '<a href="javascript:edit_faction(\''.$fID.'\');" title="'.EB_GAME_L31.'"><img src="'.e_PLUGIN.'ebattles/images/page_white_edit.png" alt="'.EB_GAME_L31.'"/></a>';
		$text .= '<a href="javascript:del_faction(\''.$fID.'\');" title="'.EB_GAME_L20.'" onclick="return confirm(\''.EB_GAME_L21.'\')"><img src="'.e_PLUGIN.'ebattles/images/cross.png" alt="'.EB_GAME_L20.'"/></a>';
		$text .= '</td>';
		$text .= '</tr>';
	}
	$text .= '<tr>';
	$text .= '<td class="forumheader3"></td>';
	$text .= '<td class="forumheader3"><input class="tbox" type="text" id="factionname" name="factionname" size="20" value="" maxlength="32"/></td>';
	$text .= '<td class="forumheader3"><input class="tbox" type="text" id="factionicon" name="factionicon" size="40" value="" maxlength="64" title="'.EB_GAME_L18.'"/></td>';
	$text .= '<td class="forumheader3"><input class="eb_button" type="submit" name="addfaction" value="'.EB_GAME_L19.'"/></td>';
	$text .= '</tr>';
	$text .= '</form>';
	$text .= '</tbody></table>';

	$text .= EB_GAME_L18.'<br />';
	$text .= '<div>';
	$gamefactionslist[0] = "";
	$handle = opendir(e_PLUGIN."ebattles/images/games_factions/");
	while ($file = readdir($handle))
	{
		if ($file != "." && $file != ".." && $file != "index.html" && $file != ".svn" && $game_shortname != "" && preg_match("/".$game_shortname."-/", $file))
		{
			$gamefactionslist[] = $file;
		}
	}
	closedir($handle);

	for($c = 1; $c <= (count($gamefactionslist)-1); $c++)
	{
		$FactionIcon = $gamefactionslist[$c];
		$FactionName = preg_replace("/$game_shortname-/","",$FactionIcon);
		$FactionName = preg_replace("/\..*$/", "", $FactionName);
		$text .= '<a href="javascript:changeTextGameFaction(\''.$FactionIcon.'\', \''.$FactionName.'\')"><img '.getFactionIconResize($FactionIcon).' title="'.$FactionIcon.'"/></a> ';
	}
	$text .= '
	</div>
	';

	$text .= '</div>';  // Games Factions tab-page

	$text .= '<div id="tabs-3">';
	//<!-- Game Maps -->
	// List of all Maps
	$q_Maps = "SELECT ".TBL_MAPS.".*"
	." FROM ".TBL_MAPS
	." WHERE (".TBL_MAPS.".Game = '$game_id')";
	$result_Maps = $sql->db_Query($q_Maps);
	$numMaps = mysql_numrows($result_Maps);
	//dbg: echo "numMaps $numMaps<br>";

	$text .= '<table class="fborder" style="width:95%"><tbody>';
	$text .= '<form id="gamemapsform" action="'.e_PLUGIN.'ebattles/gameprocess.php?gameid='.$game_id.'" method="post">';
	$text .= '<input type="hidden" id="edit_map" name="edit_map" value=""/>';
	$text .= '<input type="hidden" id="del_map" name="del_map" value=""/>';
	$text .= '<tr>';
	$text .= '<td class="forumheader3">'.EB_GAME_L22.'</td>';
	$text .= '<td class="forumheader3">'.EB_GAME_L23.'</td>';
	$text .= '<td class="forumheader3">'.EB_GAME_L24.'</td>';
	$text .= '<td class="forumheader3">'.EB_GAME_L25.'</td>';
	$text .= '<td class="forumheader3">'.EB_GAME_L26.'</td>';
	$text .= '</tr>';

	for ($map = 0; $map < $numMaps; $map++)
	{
		$mID = mysql_result($result_Maps,$map , TBL_MAPS.".MapID");
		$mImage = mysql_result($result_Maps,$map , TBL_MAPS.".Image");
		$mName = mysql_result($result_Maps,$map , TBL_MAPS.".Name");
		$mDescrition = mysql_result($result_Maps,$map , TBL_MAPS.".Description");

		$text .= '<tr>';
		$text .= '<td class="forumheader3"><img '.getMapImageResize($mImage).'/></td>';
		$text .= '<td class="forumheader3"><input class="tbox" type="text" name="mapname'.$mID.'" size="20" value="'.$mName.'" maxlength="32"/></td>';
		$text .= '<td class="forumheader3"><input class="tbox" type="text" name="mapimage'.$mID.'" size="40" value="'.$mImage.'" maxlength="64" title="'.EB_GAME_L27.'"/></td>';
		$text .= '<td class="forumheader3"><input class="tbox" type="text" name="mapdescription'.$mID.'" size="40" value="'.$mDescrition.'" maxlength="63"/></td>';
		$text .= '<td class="forumheader3">';
		$text .= '<a href="javascript:edit_map(\''.$mID.'\');" title="'.EB_GAME_L31.'"><img src="'.e_PLUGIN.'ebattles/images/page_white_edit.png" alt="'.EB_GAME_L31.'"/></a>';
		$text .= '<a href="javascript:del_map(\''.$mID.'\');" title="'.EB_GAME_L29.'" onclick="return confirm(\''.EB_GAME_L30.'\')"><img src="'.e_PLUGIN.'ebattles/images/cross.png" alt="'.EB_GAME_L29.'"/></a>';
		$text .= '</td>';
		$text .= '</tr>';
	}
	$text .= '<tr>';
	$text .= '<td class="forumheader3"></td>';
	$text .= '<td class="forumheader3"><input class="tbox" type="text" id="mapname" name="mapname" size="20" value="" maxlength="64"/></td>';
	$text .= '<td class="forumheader3"><input class="tbox" type="text" id="mapimage" name="mapimage" size="40" value="" maxlength="255" title="'.EB_GAME_L27.'"/></td>';
	$text .= '<td class="forumheader3"><input class="tbox" type="text" name="mapdescription" size="40" value="" maxlength="63"/></td>';
	$text .= '<td class="forumheader3"><input class="eb_button" type="submit" name="addmap" value="'.EB_GAME_L28.'"/></td>';
	$text .= '</tr>';
	$text .= '</form>';
	$text .= '</tbody></table>';

	$text .= EB_GAME_L27.'<br />';
	$text .= '<div>';
	$gamemapslist[0] = "";
	$handle = opendir(e_PLUGIN."ebattles/images/games_maps/");
	while ($file = readdir($handle))
	{
		if ($file != "." && $file != ".." && $file != "index.html" && $file != ".svn" && $game_shortname != "" && preg_match("/".$game_shortname."-/", $file))
		{
			$gamemapslist[] = $file;
		}
	}
	closedir($handle);

	for($c = 1; $c <= (count($gamemapslist)-1); $c++)
	{
		$MapImage = $gamemapslist[$c];
		$MapName = preg_replace("/$game_shortname-/","",$MapImage);
		$MapName = preg_replace("/\..*$/", "", $MapName);
		$text .= '<a href="javascript:changeTextGameMap(\''.$MapImage.'\', \''.$MapName.'\')"><img '.getMapImageResize($MapImage).' title="'.$MapImage.'"/></a> ';
	}
	$text .= '
	</div>
	';

	$text .= '</div>';  // Games Maps tab-page

	$text .= '</div>';  // Games tab-pane

	displayGames();


	// The usual, tell e107 what to include on the page
	$ns->tablerender(EB_ADMIN_L10, $text);
}

// ========================================================
//				RECENT ACTIVITY OPTIONS MENU
// ========================================================
if((isset($qs[0]) && $qs[0] == "eb_activity"))
{
	$text .= "<div style='text-align:center'>
	<form id='adminform' method='post' action='".e_SELF."?eb_activity'>
	<table style='".ADMIN_WIDTH."' class='fborder'>
	<tbody>
	";

	$text .= "<tr>
	<td class='forumheader3' style='width:40%'>".EB_ADMIN_L27.":</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='text' name='eb_activity_menuheading' size='20' value='".$pref['eb_activity_menuheading']."'/>
	</td>
	</tr>
	";

	$items = '';
	$ipp_array = array(5,10,25,50,100);
	foreach($ipp_array as $ipp_opt)
	$items .= ($ipp_opt == $pref['eb_activity_number_of_items']) ? "<option selected=\"selected\" value=\"$ipp_opt\">$ipp_opt</option>\n":"<option value=\"$ipp_opt\">$ipp_opt</option>\n";
	$text .= "<tr>
	<td class='forumheader3' style='width:40%'>".EB_ADMIN_L30.":</td>
	<td class='forumheader3' style='width:60%'>
	<select class='tbox' name='eb_activity_number_of_items'>".$items."</select>
	</td>
	</tr>
	";

	$text .= "<tr>
	<td class='forumheader3' style='width:40%'>".EB_ADMIN_L15.":  <div class='smalltext'>".EB_ADMIN_L16."</div></td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='text' name='eb_activity_max_image_size' size='8' value='".$pref['eb_activity_max_image_size']."' maxlength='3' /> px<br />
	<input class='tbox' type='checkbox' name='eb_activity_max_image_size_check' value='1' ".($pref['eb_activity_max_image_size_check'] == 1 ? "checked='checked'" :"")."/>".EB_ADMIN_L17."
	</td>
	</tr>
	";

	$text .= "<tr>
	<td  class='eb_td2' colspan='3' style='text-align:center'>
	<input class='button' type='submit' name='update_activity' value='".EB_ADMIN_L28."' />
	</td>
	</tr>
	</tbody>
	</table>
	</form>
	</div>";

	// The usual, tell e107 what to include on the page
	$ns->tablerender(EB_ADMIN_L10, $text);
}


// ========================================================
//				MAIN OPTIONS MENU
// ========================================================
if(!isset($qs[0]) || (isset($qs[0]) && $qs[0] == "config")){
	$text = "
	<script type='text/javascript'>
	<!--//
	function changeTextAvatar(v)
	{
	document.getElementById('eb_avatar_default_image').value=v;
	}
	function changeteamtext(v)
	{
	document.getElementById('eb_avatar_default_team_image').value=v;
	}
	//-->
	</script>
	";

	$text .= "<div style='text-align:center'>
	<form id='adminform' method='post' action='".e_SELF."?config'>
	<table style='".ADMIN_WIDTH."' class='fborder'>
	<tbody>
	";

	$text .= "<tr>
	<td class='forumheader3' style='width:40%'>".EB_ADMIN_L2.": </td>
	<td class='forumheader3' style='width:60%'>". r_userclass("eb_mod_class", $pref['eb_mod_class'], 'off', "admin, classes")."
	</td>
	</tr>
	";

	$text .= "<tr>
	<td class='forumheader3' style='width:40%'>".EB_ADMIN_L12.": </td>
	<td class='forumheader3' style='width:60%'>". r_userclass("eb_events_create_class", $pref['eb_events_create_class'], 'off', "public, member, admin, classes")."
	</td>
	</tr>
	";

	$text .= "<tr>
	<td class='forumheader3' style='width:40%'>".EB_ADMIN_L13.": </td>
	<td class='forumheader3' style='width:60%'>". r_userclass("eb_teams_create_class", $pref['eb_teams_create_class'], 'off', "public, member, admin, classes")."
	</td>
	</tr>
	";

	$text .= "<tr>
	<td class='forumheader3' style='width:40%'>".EB_ADMIN_L43.": </td>
	<td class='forumheader3' style='width:60%'>". r_userclass("eb_media_submit_class", $pref['eb_media_submit_class'], 'off', "public, member, admin, classes")."
	</td>
	</tr>
	";

	$text .= "<tr>
	<td class='forumheader3' style='width:40%'>".EB_ADMIN_L44.": </td>
	<td class='forumheader3' style='width:60%'>". r_userclass("eb_pm_notifications_class", $pref['eb_pm_notifications_class'], 'off', "public, member, admin, classes, nobody")."
	</td>
	</tr>
	";

	$text .= "<tr>
	<td class='forumheader3' style='width:40%'>".EB_ADMIN_L45.": </td>
	<td class='forumheader3' style='width:60%'>". r_userclass("eb_email_notifications_class", $pref['eb_email_notifications_class'], 'off', "public, member, admin, classes, nobody")."
	</td>
	</tr>
	";

	$text .= "<tr>
	<td class='forumheader3' style='width:40%'>".EB_ADMIN_L3.":  <div class='smalltext'>".EB_ADMIN_L4."</div></td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='text' name='eb_events_update_delay' size='8' value='".$pref['eb_events_update_delay']."' maxlength='3' /> ".EB_ADMIN_L5."<br />

	<input class='tbox' type='checkbox' name='eb_events_update_delay_enable' value='1' ".($pref['eb_events_update_delay_enable'] == 1 ? "checked='checked'" :"")."/>".EB_ADMIN_L6."
	</td>
	</tr>
	";

	$text .= "<tr>
	<td class='forumheader3' style='width:40%'>".EB_ADMIN_L14.": </td>
	<td class='forumheader3' style='width:60%'>
	<input type='radio' size='40' name='eb_tab_theme' ".($pref['eb_tab_theme'] == 'default' ? "checked='checked'" :"")." value='default' />Default
	<input type='radio' size='40' name='eb_tab_theme' ".($pref['eb_tab_theme'] == 'ebattles' ? "checked='checked'" :"")." value='ebattles' />eBattles
	<input type='radio' size='40' name='eb_tab_theme' ".($pref['eb_tab_theme'] == 'ui-lightness' ? "checked='checked'" :"")." value='ui-lightness' />Light
	<input type='radio' size='40' name='eb_tab_theme' ".($pref['eb_tab_theme'] == 'ui-darkness' ? "checked='checked'" :"")." value='ui-darkness' />Dark
	</td>
	</tr>
	";

	$text .= "<tr>
	<td class='forumheader3' style='width:40%'>".EB_ADMIN_L15.":  <div class='smalltext'>".EB_ADMIN_L16."</div></td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='text' name='eb_max_image_size' size='8' value='".$pref['eb_max_image_size']."' maxlength='3' /> px<br />
	<input class='tbox' type='checkbox' name='eb_max_image_size_check' value='1' ".($pref['eb_max_image_size_check'] == 1 ? "checked='checked'" :"")."/>".EB_ADMIN_L17."
	</td>
	</tr>
	";

	$text .= "<tr>
	<td class='forumheader3' style='width:40%'>".EB_ADMIN_L40.":  <div class='smalltext'>".EB_ADMIN_L41."</div></td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='text' name='eb_max_map_image_size' size='8' value='".$pref['eb_max_map_image_size']."' maxlength='3' /> px<br />
	<input class='tbox' type='checkbox' name='eb_max_map_image_size_check' value='1' ".($pref['eb_max_map_image_size_check'] == 1 ? "checked='checked'" :"")."/>".EB_ADMIN_L42."
	</td>
	</tr>
	";

	$text .= "<tr>
	<td class='forumheader3' style='width:40%'>".EB_ADMIN_L19.":  <div class='smalltext'>".EB_ADMIN_L20."</div></td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='text' name='eb_max_avatar_size' size='8' value='".$pref['eb_max_avatar_size']."' maxlength='3' /> px<br />
	<input class='tbox' type='checkbox' name='eb_avatar_enable_playersstandings' value='1' ".($pref['eb_avatar_enable_playersstandings'] == 1 ? "checked='checked'" :"")."/>".EB_ADMIN_L21."
	<input class='tbox' type='checkbox' name='eb_avatar_enable_teamsstandings' value='1' ".($pref['eb_avatar_enable_teamsstandings'] == 1 ? "checked='checked'" :"")."/>".EB_ADMIN_L33."
	<input class='tbox' type='checkbox' name='eb_avatar_enable_teamslist' value='1' ".($pref['eb_avatar_enable_teamslist'] == 1 ? "checked='checked'" :"")."/>".EB_ADMIN_L36."
	</td>
	</tr>
	";

	$text .= "<tr>
	<td class='forumheader3' style='width:40%'>".EB_ADMIN_L22.":  <div class='smalltext'>".EB_ADMIN_L23."</div></td>
	<td class='forumheader3' style='width:60%'>
	";
	if ($pref['eb_avatar_default_image'] != '')
	{
		$text .= '<img '.getAvatarResize(getImagePath($pref['eb_avatar_default_image'], 'avatars')).'/>&nbsp;';
	}
	$text .= "<input class='tbox' type='text' id='eb_avatar_default_image' name='eb_avatar_default_image' size='20' value='".$pref['eb_avatar_default_image']."'/>";

	$text .= "<div><br />";
	$avatarlist = array();
	$avatarlist[0] = "";
	$handle = opendir(e_PLUGIN."ebattles/images/avatars/");
	while ($file = readdir($handle))
	{
		if ($file != "." && $file != ".." && $file != "index.html" && $file != ".svn" && $file != "Thumbs.db")
		{
			$avatarlist[] = $file;
		}
	}
	closedir($handle);

	for($c = 1; $c <= (count($avatarlist)-1); $c++)
	{
		$text .= '<a href="javascript:changeTextAvatar(\''.$avatarlist[$c].'\')"><img src="'.e_PLUGIN.'ebattles/images/avatars/'.$avatarlist[$c].'" alt="'.$avatarlist[$c].'" style="border:0"/></a> ';
	}
	$text .= "
	</div>
	";

	$text .= "</td>
	</tr>
	";

	$text .= "<tr>
	<td class='forumheader3' style='width:40%'>".EB_ADMIN_L34.":  <div class='smalltext'>".EB_ADMIN_L35."</div></td>
	<td class='forumheader3' style='width:60%'>
	";
	if ($pref['eb_avatar_default_team_image'] != '')
	{
		$text .= '<img '.getAvatarResize(getImagePath($pref['eb_avatar_default_team_image'], 'team_avatars')).'/>&nbsp;';
	}
	$text .= "<input class='tbox' type='text' id='eb_avatar_default_team_image' name='eb_avatar_default_team_image' size='20' value='".$pref['eb_avatar_default_team_image']."'/>";

	$text .= "<div><br />";
	$avatarlist = array();
	$avatarlist[0] = "";
	$handle = opendir(e_PLUGIN."ebattles/images/team_avatars/");
	while ($file = readdir($handle))
	{
		if ($file != "." && $file != ".." && $file != "index.html" && $file != ".svn" && $file != "Thumbs.db")
		{
			$avatarlist[] = $file;
		}
	}
	closedir($handle);

	for($c = 1; $c <= (count($avatarlist)-1); $c++)
	{
		$text .= '<a href="javascript:changeteamtext(\''.$avatarlist[$c].'\')"><img src="'.e_PLUGIN.'ebattles/images/team_avatars/'.$avatarlist[$c].'" alt="'.$avatarlist[$c].'" style="border:0"/></a> ';
	}
	$text .= "
	</div>
	";

	$text .= "</td>
	</tr>
	";

	$items = '';
	$ipp_array = array(5,10,25,50,100,'All');
	foreach($ipp_array as $ipp_opt)
	$items .= ($ipp_opt == $pref['eb_default_items_per_page']) ? "<option selected=\"selected\" value=\"$ipp_opt\">$ipp_opt</option>\n":"<option value=\"$ipp_opt\">$ipp_opt</option>\n";
	$text .= "<tr>
	<td class='forumheader3' style='width:40%'>".EB_ADMIN_L18.":</td>
	<td class='forumheader3' style='width:60%'>
	<select class='tbox' name='eb_default_items_per_page'>".$items."</select>
	</td>
	</tr>
	";

	$text .= "<tr>
	<td class='forumheader3' style='width:40%'>".EB_ADMIN_L7.": </td>
	<td class='forumheader3' style='width:60%'>
	<input class='button' type='submit' name='eb_events_insert_data' value='".EB_ADMIN_L8."'/>
	</td>
	</tr>
	";

	$text .= "<tr>
	<td class='forumheader3' style='width:40%'>".EB_ADMIN_L38.":</td>
	<td class='forumheader3' style='width:60%'>
	<textarea class='tbox' name='eb_disclaimer' cols='60' rows='2'>".$pref['eb_disclaimer']."</textarea>
	</td>
	</tr>
	";

	$text .= "<tr>
	<td  class='eb_td2' colspan='3' style='text-align:center'>
	<input class='button' type='submit' name='updatesettings' value='".EB_ADMIN_L9."' />
	</td>
	</tr>
	</tbody>
	</table>
	</form>
	</div>";

	// The usual, tell e107 what to include on the page
	$ns->tablerender(EB_ADMIN_L10, $text);
}

require_once(e_ADMIN."footer.php");

function admin_config_adminmenu()
{
	if (e_QUERY) {
		$tmp = explode(".", e_QUERY);
		$action = $tmp[0];
	}
	if (!isset($action) || ($action == ""))
	{
		$action = "config";
	}
	$var['config']['text'] = EB_ADMIN_L24;
	$var['config']['link'] = "admin_config.php";

	$var['eb_games']['text'] = EB_ADMIN_L39;
	$var['eb_games']['link'] ="admin_config.php?eb_games";

	$var['eb_links']['text'] = EB_ADMIN_L25;
	$var['eb_links']['link'] ="admin_config.php?eb_links";

	$var['eb_activity']['text'] = EB_ADMIN_L26;
	$var['eb_activity']['link'] ="admin_config.php?eb_activity";

	$var['eb_vupdate']['text'] = EB_ADMIN_L32;
	$var['eb_vupdate']['link'] ="admin_vupdate.php";

	show_admin_menu(EB_L1, $action, $var);
}

/***************************************************************************************
Functions
***************************************************************************************/
/**
* displayGames - Displays the games database table
*/
function displayGames(){
	global $pref;
	global $sql;
	global $text;
	global $session;
	$pages = new Paginator;

	$array = array(
	'id'   => array(EB_GAMES_L3, TBL_GAMES.'.GameID'),
	'icon'   => array(EB_GAMES_L4, TBL_GAMES.'.Icon'),
	'game'   => array(EB_GAMES_L5, TBL_GAMES.'.Name')
	);

	if (!isset($_GET['orderby'])) $_GET['orderby'] = 'game';
	$orderby= eb_sanitize($_GET['orderby']);

	$sort = "ASC";
	if(isset($_GET["sort"]) && !empty($_GET["sort"]))
	{
		$sort = ($_GET["sort"]=="ASC") ? "DESC" : "ASC";
	}

	$q = "SELECT count(*) "
	." FROM ".TBL_GAMES;
	$result = $sql->db_Query($q);

	$numGames = mysql_result($result, 0);
	$totalItems = $numGames;
	$pages->items_total = $totalItems;
	$pages->mid_range = eb_PAGINATION_MIDRANGE;
	$pages->paginate();

	$text .= '<div class="spacer">';
	$text .= '<p>';
	$text .= $numGames.' '.EB_GAMES_L6.'<br />';
	$text .= '</p>';
	$text .= '</div>';

	$orderby_array = $array["$orderby"];
	$q = "SELECT ".TBL_GAMES.".*"
	." FROM ".TBL_GAMES
	." ORDER BY $orderby_array[1] $sort"
	." $pages->limit";
	$result = $sql->db_Query($q);
	$num_rows = mysql_numrows($result);
	if(!$result || ($num_rows < 0)){
		$text .= EB_GAMES_L7;
		return;
	}
	if($num_rows == 0){
		$text .= EB_GAMES_L8;
	}
	else
	{
		// Paginate
		$text .= '<br />';
		$text .= '<span class="paginate" style="float:left;">'.$pages->display_pages().'</span>';
		$text .= '<span style="float:right">';
		// Go To Page
		$text .= $pages->display_jump_menu();
		$text .= '&nbsp;&nbsp;&nbsp;';
		// Items per page
		$text .= $pages->display_items_per_page();
		$text .= '</span><br /><br />';

		/* Display table contents */
		$text .= '<form id="gamesform" action="'.e_PLUGIN.'ebattles/gameprocess.php" method="post">';
		$text .= '<table class="fborder" style="width:95%"><tbody>';
		$text .= '<tr>';
		$text .= '<td class="eb_td2"><input class="tbox" type="checkbox" name="sAll" onclick="selectAll(this)" /> ('.EB_GAMES_L9.')</td>';
		foreach($array as $opt=>$opt_array)
		$text .= '<td class="eb_td2"><a href="'.e_PLUGIN.'ebattles/admin_config.php?eb_games&orderby='.$opt.'&amp;sort='.$sort.'">'.$opt_array[0].'</a></td>';
		$text .= '<td class="eb_td2">'.EB_GAMES_L10;
		$text .= '<input type="hidden" id="delete_game" name="delete_game" value=""/></td></tr>';
		for($i=0; $i<$num_rows; $i++){
			$gid  = mysql_result($result,$i, TBL_GAMES.".GameID");
			$gname  = mysql_result($result,$i, TBL_GAMES.".Name");
			$gicon  = mysql_result($result,$i, TBL_GAMES.".Icon");

			$text .= '<tr>';
			$text .= '<td class="forumheader3"><input class="tbox" type="checkbox" name="game_sel[]" value="'.$gid.'" /></td>';
			$text .= '<td class="forumheader3">'.$gid.'</td>';
			$text .= '<td class="forumheader3"><img '.getGameIconResize($gicon).' title="'.$gicon.'"/></td>';
			$text .= '<td class="forumheader3"><a href="'.e_PLUGIN.'ebattles/admin_config.php?eb_games&gameid='.$gid.'">'.$gname.'</a></td>';
			$text .= '<td class="forumheader3"><a href="'.e_PLUGIN.'ebattles/admin_config.php?eb_games&gameid='.$gid.'"><img src="'.e_PLUGIN.'ebattles/images/page_white_edit.png" alt="'.EB_GAMES_L11.'" title="'.EB_GAMES_L11.'"/></a>';
			$text .= '<a href="javascript:buttonval(\''.$gid.'\');" title="'.EB_GAMES_L12.'" onclick="return confirm(\''.EB_GAMES_L13.'\')"><img src="'.e_PLUGIN.'ebattles/images/cross.png" alt="'.EB_GAMES_L12.'"/></a>';
			$text .= '</td>';
			$text .= '</tr>';
		}
		$text .= '</tbody></table>';

		$text .= '<table><tr>
		<td>
		<input class="eb_button" type="submit" name="delete_selected_games" value="'.EB_GAMES_L14.'" onclick="return confirm(\''.EB_GAMES_L15.'\')"/>
		</td>
		<td>
		<input class="eb_button" type="submit" name="delete_all_games" value="'.EB_GAMES_L16.'" onclick="return confirm(\''.EB_GAMES_L17.'\')"/>
		</td>
		<td>
		<input class="eb_button" type="submit" name="update_selected_games" value="'.EB_GAMES_L18.'"/>
		</td>
		<td>
		<input class="eb_button" type="submit" name="update_all_games" value="'.EB_GAMES_L19.'"/>
		</td>
		<td>
		<input class="eb_button" type="submit" name="add_games" value="'.EB_GAMES_L20.'"/>
		</td>
		</tr>
		</table>
		';

		$text .= '</form>';
	}
}

?>

