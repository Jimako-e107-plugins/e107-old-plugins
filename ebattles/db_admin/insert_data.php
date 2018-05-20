<?php

function insert_eb_debug_data()
{
	global $sql;
	// Insert SC2 game
	$query =
	"INSERT INTO ".TBL_GAMES."(Name, ShortName, Icon, MatchTypes)
	VALUES ('Starcraft 2', 'sc2', 'http://media.xfire.com/xfire/xf/images/icons/sc2b.gif', '1v1,2v2,3v3,4v4,FFA')";
	$result = $sql->db_Query($query);
	$last_id = mysql_insert_id();


	// Add Factions
	$query =
	"INSERT INTO ".TBL_FACTIONS."(Game, Name, Icon)
	VALUES ($last_id, 'Protoss', 'sc2-Protoss.png')";
	$result = $sql->db_Query($query);
	$query =
	"INSERT INTO ".TBL_FACTIONS."(Game, Name, Icon)
	VALUES ($last_id, 'Terran', 'sc2-Terran.png')";
	$result = $sql->db_Query($query);
	$query =
	"INSERT INTO ".TBL_FACTIONS."(Game, Name, Icon)
	VALUES ($last_id, 'Zerg', 'sc2-Zerg.png')";
	$result = $sql->db_Query($query);
	$query =
	"INSERT INTO ".TBL_FACTIONS."(Game, Name, Icon)
	VALUES ($last_id, 'Random', 'sc2-Random.png')";
	$result = $sql->db_Query($query);

	// Add Maps
	$query =
	"INSERT INTO ".TBL_MAPS."(Game, Name, Image)
	VALUES ($last_id, 'Blistering Sands', 'sc2-BlisteringSands.jpg')";
	$result = $sql->db_Query($query);
	$query =
	"INSERT INTO ".TBL_MAPS."(Game, Name, Image)
	VALUES ($last_id, 'Kulas Ravine', 'sc2-KulasRavine.jpg')";
	$result = $sql->db_Query($query);
	$query =
	"INSERT INTO ".TBL_MAPS."(Game, Name, Image)
	VALUES ($last_id, 'Lost Temple', 'sc2-LostTemple.jpg')";
	$result = $sql->db_Query($query);
	$query =
	"INSERT INTO ".TBL_MAPS."(Game, Name, Image)
	VALUES ($last_id, 'Scrapyard', 'sc2-Scrapyard.jpg')";
	$result = $sql->db_Query($query);
	$query =
	"INSERT INTO ".TBL_MAPS."(Game, Name, Image)
	VALUES ($last_id, 'Steppes Of War', 'sc2-SteppesOfWar.jpg')";
	$result = $sql->db_Query($query);

	// Debug
	// Insert gamers
	$total_members = $sql->db_Count("user","(*)");
	$index = $total_members + 1;
	for($i = 1; $i < 50; $i++)
	{
		$sql -> db_Insert("user", "0, 'Player".$index."', 'Player".$index."',  '', '".md5("test")."', '$key', 'test@hotmail.com', 'mysig', '', '', '1', '".time()."', '".time()."', '".time()."', '0', '0', '0', '0', '0', '0', '0', '', '', '0', '0', 'Player".$index."', '', '', '', '".time()."', ''");
		$user_id = mysql_insert_id();

		$query =
		"INSERT INTO ".TBL_GAMERS."(User, Game, Name, UniqueGameID)
		VALUES ($user_id, $last_id, 'Player".$i."', 'Player#".$i."')";
		$result = $sql->db_Query($query) or die ('Error, adding gamer '.$user_id.' in game '.$last_id.'<br />'. mysql_error());
		$index++;
	}

}

?>
