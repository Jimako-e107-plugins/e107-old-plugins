<?php
/*
* sort_list.php
*/

require_once("../../../class2.php");
require_once(e_PLUGIN."ebattles/include/main.php");
global $sql;


$player = $_POST['player'];
print_r($player);

for ($i = 0; $i < count($player); $i++) {
	if($player[$i] != 'none')
	{
		$q = "UPDATE ".TBL_PLAYERS." SET Seed = '".($i+1)."' WHERE (PlayerID = '".$player[$i]."')";
		$result = $sql->db_Query($q);
	}
}
	
?>