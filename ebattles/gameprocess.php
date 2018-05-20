<?php
/**
* GameProcess.php
*
*/
require_once("../../class2.php");
require_once(e_PLUGIN."ebattles/include/main.php");

echo '
<html>
<head>
<style type="text/css">
<!--
.percents {
background: #FFF;
position:absolute;
text-align: center;
}
-->
</style>
</head>
<body>
';


$can_manage = 0;
if (check_class($pref['eb_mod_class'])) $can_manage = 1;
if ($can_manage == 0)
{
    header("location:".e_HTTP."index.php");
    exit();
}

$game_id = intval($_GET['gameid']);
if (!$game_id)
{
// [fm] gamecreate?
	header("location:".e_HTTP."index.php");
	exit();
}

// GameManage Process
if(isset($_POST['gamesettingssave']))
{
    /* Game Name */
    $new_gamename = $tp->toDB($_POST['gameName']);
    if ($new_gamename != '')
    {
        $q = "UPDATE ".TBL_GAMES." SET Name = '$new_gamename' WHERE (GameID = '$game_id')";
        $result = $sql->db_Query($q);
    }
    /* Game Icon */
    $new_gameicon = $tp->toDB($_POST['gameIcon']);
    if ($new_gameicon != '')
    {
        $q = "UPDATE ".TBL_GAMES." SET Icon = '$new_gameicon' WHERE (GameID = '$game_id')";
        $result = $sql->db_Query($q);
    }
    /* Game Short Name */
    $new_gameshortname = $tp->toDB($_POST['gameShortName']);
    $q = "UPDATE ".TBL_GAMES." SET ShortName = '$new_gameshortname' WHERE (GameID = '$game_id')";
    $result = $sql->db_Query($q);

    /* Game Match Types */
    $new_gamematchtypes = $tp->toDB($_POST['gameMatchTypes']);
    $q = "UPDATE ".TBL_GAMES." SET MatchTypes = '$new_gamematchtypes' WHERE (GameID = '$game_id')";
    $result = $sql->db_Query($q);

    header("Location: admin_config.php?eb_games&gameid=$game_id");
    exit();
}
if(isset($_POST['gamedelete']))
{
    deleteGame($game_id);

    header("Location: admin_config.php?eb_games");
    exit();
}
if (isset($_POST['gamecreate']))
{
    $q = "INSERT INTO ".TBL_GAMES."(Name,ShortName,Icon)"
    ." VALUES ('Game Name', 'shortname', 'unknown.gif')";
    $result = $sql->db_Query($q);
    $last_id = mysql_insert_id();

    $q = "UPDATE ".TBL_GAMES." SET Name = '".EB_GAME_L1." - $last_id' WHERE (GameID = '$last_id')";
    $result = $sql->db_Query($q);

    header("Location: admin_config.php?eb_games&gameid=".$last_id);
    exit();
}
// GamesManage Process
if(isset($_POST['delete_game']) && $_POST['delete_game']!="")
{
    $game_id = $_POST['delete_game'];
    deleteGame($game_id);
    header("Location: admin_config.php?eb_games");
    exit();
}

if(isset($_POST['delete_selected_games']))
{
    if (count($_POST['game_sel']) > 0)
    {
        $del_ids = $_POST['game_sel'];
        foreach($del_ids as $game_id)
        {
            deleteGame($game_id);
        }
    }
    header("Location: admin_config.php?eb_games");
    exit();
}

if(isset($_POST['delete_all_games']))
{
    $q = "SELECT ".TBL_GAMES.".*"
    ." FROM ".TBL_GAMES;
    $result = $sql->db_Query($q);
    $num_rows = mysql_numrows($result);
    for($i=0; $i<$num_rows; $i++)
    {
        $game_id  = mysql_result($result,$i, TBL_GAMES.".GameID");
        deleteGame($game_id);
    }
    header("Location: admin_config.php?eb_games");
    exit();
}

if(isset($_POST['update_selected_games']))
{
    if (count($_POST['game_sel']) > 0)
    {
        $del_ids = $_POST['game_sel'];
        foreach($del_ids as $game_id)
        {
            updateGame($game_id);
        }
    }
    header("Location: admin_config.php?eb_games");
    exit();
}

if(isset($_POST['update_all_games']))
{
    updateAllGames();
    //header("Location: {$_SERVER['HTTP_REFERER']}");
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin_config.php?eb_games">';
}

if(isset($_POST['add_games']))
{
    insertGames();
    header("Location: admin_config.php?eb_games");
    exit();
}
if (isset($_POST['addfaction']))
{
    $faction_name = $_POST['factionname'];
    $faction_icon = $_POST['factionicon'];

    if (($faction_icon != "")&&($faction_name != ""))
    {
        add_faction($game_id, $faction_icon, $faction_name);
    }

    //dbg: echo "Faction: $game_id, $faction_icon, $faction_name";

    header("Location: admin_config.php?eb_games&gameid=$game_id");
    exit();
}
if (isset($_POST['edit_faction']) && $_POST['edit_faction']!="")
{
    $faction = $_POST['edit_faction'];
    $faction_name = $_POST['factionname'.$faction];
    $faction_icon = $_POST['factionicon'.$faction];

    if (($faction_icon != "")&&($faction_name != ""))
    {
        update_faction($faction, $faction_icon, $faction_name);
    }

    //dbg: echo "Update Faction: $faction, $faction_icon, $faction_name";

    header("Location: admin_config.php?eb_games&gameid=$game_id");
    exit();
}
if (isset($_POST['del_faction']) && $_POST['del_faction']!="")
{
    $faction = $_POST['del_faction'];

    delete_faction($faction);

    header("Location: admin_config.php?eb_games&gameid=$game_id");
    exit();
}
if (isset($_POST['addmap']))
{
    $map_name = $_POST['mapname'];
    $map_image = $_POST['mapimage'];
    $map_description = $_POST['mapdescription'];

    if (($map_image != "")&&($map_name != ""))
    {
        add_map($game_id, $map_image, $map_name, $map_description);
    }

    //dbg: echo "Map: $game_id, $map_image, $map_name, $map_description";
    //exit();

    header("Location: admin_config.php?eb_games&gameid=$game_id");
    exit();
}
if (isset($_POST['edit_map']) && $_POST['edit_map']!="")
{
    $map = $_POST['edit_map'];
    $map_name = $_POST['mapname'.$map];
    $map_image = $_POST['mapimage'.$map];
    $map_description = $_POST['mapdescription'.$map];

    if (($map_image != "")&&($map_name != ""))
    {
        update_map($map, $map_image, $map_name, $map_description);
    }

    //dbg: echo "Update Map: $map, $map_image, $map_name, $map_description";

    header("Location: admin_config.php?eb_games&gameid=$game_id");
    exit();
}
if (isset($_POST['del_map']) && $_POST['del_map']!="")
{
    $map = $_POST['del_map'];
    
    delete_map($map);

    header("Location: admin_config.php?eb_games&gameid=$game_id");
    exit();
}
exit();

/***************************************************************************************
Functions
***************************************************************************************/
/**
* deleteGame - Delete a game from the database
*/
function deleteGame($game_id)
{
    global $sql;

    //fm: Should check if the game is used in a team or event?
    // Do not delete game 1 (unknown game)
    if ($game_id != 1)
    {
        $q = "DELETE FROM ".TBL_GAMES
        ." WHERE (".TBL_GAMES.".GameID = '$game_id')";
        $result = $sql->db_Query($q);
    }
}
/**
* updateGame - Update a game from the database, using info from Games List.csv
*/
function updateGame($game_id)
{
    global $sql;

    // Get info from database the game is already in database
    $query = "SELECT ".TBL_GAMES.".*"
    ." FROM ".TBL_GAMES
    ." WHERE (".TBL_GAMES.".GameID = '$game_id')";
    $result = $sql->db_Query($query);

    $gname  = mysql_result($result,0 , TBL_GAMES.".Name");

    if($file_handle = fopen(e_PLUGIN."ebattles/images/games_icons/Games List.csv", "r"))
    {
        $line_of_text = fgetcsv($file_handle, 1024); // header
        while (!feof($file_handle) ) {
            $line_of_text = fgetcsv($file_handle, 1024);

            $shortname = addslashes($line_of_text[0]);
            $longname  = addslashes($line_of_text[1]);
            $icon  = addslashes($line_of_text[2]);

            if ($gname==$longname)
            {
                $query =
                "UPDATE ".TBL_GAMES
                ." SET ShortName='$shortname', Icon='$icon'"
                ." WHERE (".TBL_GAMES.".GameID = '$game_id')";
                $result = $sql->db_Query($query);
                break;
            }
        }
        fclose($file_handle);
    }
    else
    {
    	echo "Error loading game file.";
    	exit();
    }
}
/**
* updateAllGames - Update all games in the database, using info from Games List.csv
*/
function updateAllGames()
{
    global $sql;

    // Output a 'waiting message'
    if (ob_get_level() == 0) {
        ob_start();
    }
    echo str_pad('Please wait while this task completes... ',4096)."<br />\n";

    $games_info = array();
    $index = 0;
    if($file_handle = fopen(e_PLUGIN."ebattles/images/games_icons/Games List.csv", "r"))
    {
        $line_of_text = fgetcsv($file_handle, 1024); // header
        while (!feof($file_handle) ) {
            $line_of_text = fgetcsv($file_handle, 1024);

            $games_info[$index] =array (
            'shortname' => addslashes($line_of_text[0]),
            'longname'  => addslashes($line_of_text[1]),
            'icon'      => addslashes($line_of_text[2])
            );
            $index ++;
        }
        fclose($file_handle);
    }
    else
    {
    	echo "Error loading game file.";
    	exit();
    }
    
    // Get info from database the game is already in database
    $query = "SELECT ".TBL_GAMES.".*"
    ." FROM ".TBL_GAMES;
    $result = $sql->db_Query($query);
    $num_rows = mysql_numrows($result);
    for ($i = 0; $i<$num_rows; $i++)
    {
        set_time_limit(10);
        $gname  = mysql_result($result,$i , TBL_GAMES.".Name");
        $gid  = mysql_result($result,$i , TBL_GAMES.".GameID");

        $search_game = array_searchRecursive( $gname, $games_info, true);

        if ($search_game)
        {
            $q_2 =
            "UPDATE ".TBL_GAMES
            ." SET ShortName='".$games_info[$search_game[0]]['shortname']."', Icon='".$games_info[$search_game[0]]['icon']."'"
            ." WHERE (".TBL_GAMES.".GameID = '$gid')";
            $result_2 = $sql->db_Query($q_2);
            //usleep(100);
        }
        echo '<div class="percents">' . number_format(100*$i/$num_rows, 0, '.', '') . '%&nbsp;complete</div>';
        echo str_pad('',4096)."\n";
        ob_flush();
    }
    echo "<br>Done.";
    ob_end_flush();
}

/**
* insertGames - Insert games in database, using info from Games List.csv
*/
function insertGames()
{
    global $sql;
    global $tp;
    
    // Insert Games in database
    if($file_handle = fopen(e_PLUGIN."ebattles/images/games_icons/Games List.csv", "r"))
    {
        $line_of_text = fgetcsv($file_handle, 1024); // header
        while (!feof($file_handle) ) {
            $line_of_text = fgetcsv($file_handle, 1024);

            $shortname = $tp->toDB($line_of_text[0]);
            $longname  = $tp->toDB($line_of_text[1]);
            $icon  = $tp->toDB($line_of_text[2]);

            // Check if the game is already in database
            $query = "SELECT ".TBL_GAMES.".*"
            ." FROM ".TBL_GAMES
            ." WHERE (".TBL_GAMES.".Name = '$longname')";
            $result = $sql->db_Query($query);
            $num_rows = mysql_numrows($result);
            if ($num_rows==0)
            {
                $query =
                "INSERT INTO ".TBL_GAMES."(Name, ShortName, Icon)
                VALUES ('$longname', '$shortname', '$icon')";
                $result = $sql->db_Query($query);
            }
        }
        fclose($file_handle);
    }
    else
    {
    	echo "Error loading game file.";
    	exit();
    }
}
function add_faction($game_id, $faction_icon, $faction_name)
{
    global $sql;
    global $tp;
    
    $faction_icon = $tp->toDB($faction_icon);
    $faction_name = $tp->toDB($faction_name);

    $q = "INSERT INTO ".TBL_FACTIONS."(Game,Icon,Name)
    VALUES ('$game_id','$faction_icon','$faction_name')";
    $sql->db_Query($q);
}

function update_faction($faction, $faction_icon, $faction_name)
{
    global $sql;
    global $tp;
    
    $faction_icon = $tp->toDB($faction_icon);
    $faction_name = $tp->toDB($faction_name);

    $q = "UPDATE ".TBL_FACTIONS
    ." SET Icon = '$faction_icon', Name = '$faction_name'"
    ." WHERE (FactionID = '$faction')";
    $sql->db_Query($q);
}

function delete_faction($faction)
{
    global $sql;

    $q = "DELETE FROM ".TBL_FACTIONS." WHERE (FactionID = '$faction')";
    $result = $sql->db_Query($q);
}
function add_map($game_id, $map_image, $map_name, $map_description)
{
    global $sql;
    global $tp;
    
    $map_image = $tp->toDB($map_image);
    $map_name = $tp->toDB($map_name);
    $map_description = $tp->toDB($map_description);

    $q = "INSERT INTO ".TBL_MAPS."(Game,Image,Name,Description)
    VALUES ('$game_id','$map_image','$map_name','$map_description')";
    $sql->db_Query($q);
}

function update_map($map, $map_image, $map_name, $map_description)
{
    global $sql;
    global $tp;
    
    $map_image = $tp->toDB($map_image);
    $map_name = $tp->toDB($map_name);
    $map_description = $tp->toDB($map_description);

    $q = "UPDATE ".TBL_MAPS
    ." SET Image = '$map_image', Name = '$map_name', Description = '$map_description'"
    ." WHERE (MapID = '$map')";
    $sql->db_Query($q);
}

function delete_map($map)
{
    global $sql;

    $q = "DELETE FROM ".TBL_MAPS." WHERE (MapID = '$map')";
    $result = $sql->db_Query($q);
}
?>
