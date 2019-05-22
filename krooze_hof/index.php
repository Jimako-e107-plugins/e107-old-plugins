<?php
/*
+---------------------------------------------------------------+
|        Krooze Hall Of Fame plugin for e107 v0.7
|
|        A plugin for the e107 website system
|        http://www.e107.org/
|
|        ©Stratos Geroulis
|        http://www.stratosector.net/
|        stratosg@stratosector.net
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

require_once("../../class2.php");
require_once(HEADERF);

if(file_exists(e_PLUGIN."krooze_hof/language/".e_LANGUAGE.".php")){
	require_once(e_PLUGIN."krooze_hof/language/".e_LANGUAGE.".php");
}
else{
	require_once(e_PLUGIN."krooze_hof/language/English.php");
}

if(!USER){
	echo "<br><br>";
	echo "<center><b>You must be logged in to view the Hall Of Fame.";
	echo "<br>Please either log in or if you are not registered click <a href='".e_BASE."signup.php'>here</a> to signup</center></b>";
	require_once(FOOTERF);
	exit;
}

if(isset($_GET['u'])){
	$text = '<center>
			<br>
			<table width=\'50%\'>
				<tr>
					<th>'.HOF_7.'</th>
					<th>'.HOF_8.'</th>
				</tr>';
	$sql->mySQLresult = @mysql_query('SELECT '.MPREFIX.'arcade_champs.score, '.MPREFIX.'arcade_games.game_title FROM '.MPREFIX.'arcade_champs, '.MPREFIX.'arcade_games WHERE '.MPREFIX.'arcade_champs.user_id='.$_GET['u'].' AND '.MPREFIX.'arcade_games.game_id='.MPREFIX.'arcade_champs.game_id;');
	while($row = $sql->db_Fetch()){
		$text .= '<tr>
					<td><center>'.$row['game_title'].'</center></td>
					<td><center>'.$row['score'].'</center></td>
				  </tr>';
	}
	$text .= '</table>
			  <br>
			  <a href=\''.$_SERVER['SCRIPT_NAME'].'\'>'.HOF_6.'</a>
			  </center>';
	$ns -> tablerender(HOF_5, $text);
	require_once(FOOTERF);
	exit;
}

$text = '<center>
		<br>
		<h1>'.HOF_1.'</h1>
		<br>
		<table width=\'70%\'>
			<tr>
				<th>'.HOF_2.'</th>
				<th>'.HOF_3.'</th>
				<th>'.HOF_4.'</th>
			</tr>';

$sql->mySQLresult = @mysql_query('SELECT COUNT('.MPREFIX.'arcade_champs.user_id) as total_victories, '.MPREFIX.'user.user_name, '.MPREFIX.'user.user_id FROM '.MPREFIX.'arcade_champs, '.MPREFIX.'user WHERE '.MPREFIX.'user.user_id = '.MPREFIX.'arcade_champs.user_id GROUP BY '.MPREFIX.'arcade_champs.user_id;');
$i = 0;
$results = array();
while($row = $sql->db_Fetch()){
	$results[$i]['user_name'] = $row['user_name'];
	$results[$i]['total_victories'] = $row['total_victories'];
	$results[$i]['user_id'] = $row['user_id'];
	$i++;
}
usort($results, total_victories_sort);

for($i=0; $i<count($results); $i++){
	if($i == 0){
		$text .= '<tr bgcolor=\'yellow\'>
					<td><center><img alt=\'first\' src=\''.e_PLUGIN.'krooze_hof/images/1st.gif\'></center></td>
					<td><center><a href=\''.$_SERVER['SCRIPT_NAME'].'?u='.$results[$i]['user_id'].'\'>'.$results[$i]['user_name'].'</a></a></center></td>
					<td><center>'.$results[$i]['total_victories'].'</center></td>
				  </tr>';
	}
	elseif($i == 1){
		$text .= '<tr bgcolor=\'yellow\'>
					<td><center><img alt=\'second\' src=\''.e_PLUGIN.'krooze_hof/images/2nd.gif\'></center></td>
					<td><center><a href=\''.$_SERVER['SCRIPT_NAME'].'?u='.$results[$i]['user_id'].'\'>'.$results[$i]['user_name'].'</a></center></td>
					<td><center>'.$results[$i]['total_victories'].'</center></td>
				  </tr>';
	}
	elseif($i == 2){
		$text .= '<tr bgcolor=\'yellow\'>
					<td><center><img alt=\'third\' src=\''.e_PLUGIN.'krooze_hof/images/3rd.gif\'></center></td>
					<td><center><a href=\''.$_SERVER['SCRIPT_NAME'].'?u='.$results[$i]['user_id'].'\'>'.$results[$i]['user_name'].'</a></center></td>
					<td><center>'.$results[$i]['total_victories'].'</center></td>
				  </tr>';
	}
	else{
		$text .= '<tr bgcolor=\'light gray\'>
					<td><center>'.($i+1).'</center></td>
					<td><center><a href=\''.$_SERVER['SCRIPT_NAME'].'?u='.$results[$i]['user_id'].'\'>'.$results[$i]['user_name'].'</a></center></td>
					<td><center>'.$results[$i]['total_victories'].'</center></td>
				  </tr>';
	}
}

$text .= '</table>';

$ns -> tablerender(HOF_1, $text);
require_once(FOOTERF);

function total_victories_sort($a, $b){
	if($a['total_victories'] > $b['total_victories']){
		return -1;
	}
	elseif($a['total_victories'] < $b['total_victories']){
		return 1;
	}
	else{
		return 0;
	}
}
?>