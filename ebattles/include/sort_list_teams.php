<?php
/*
* sort_list.php
*/

require_once("../../../class2.php");
require_once(e_PLUGIN."ebattles/include/main.php");
global $sql;


$team = $_POST['team'];
print_r($team);

for ($i = 0; $i < count($team); $i++) {
	if($team[$i] != 'none')
	{
		$q = "UPDATE ".TBL_TEAMS." SET Seed = '".($i+1)."' WHERE (TeamID = '".$team[$i]."')";
		$result = $sql->db_Query($q);
	}
}
	
?>