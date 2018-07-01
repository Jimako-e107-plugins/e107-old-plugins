global $sql,$sql2,$user; 

$suser = "";
$USER_ID = "";


$url = $_SERVER["REQUEST_URI"];
$suser = explode(".", $url);
	if ($suser[1] == 'php?id') {
	$suser = $suser[2];
	}
$SUSER_ID = $suser;

if (USER){
$c = 0;
$sql->db_Select("advmedsys_awarded", "*", "WHERE awarded_user_id='".$SUSER_ID."'", "");
	while($row = $sql->db_Fetch()){
	$c++;
	}

$medalnames = array();
$medalid = array();

$sql->db_Select("advmedsys_medals", "*", "ORDER BY medal_name", "");
	while($row = $sql->db_Fetch()){
	$medalnames[] = $row['medal_name'];
	$medalid[] = $row['medal_id'];
	$medalpic[] = $row['medal_pic'];
	}

if ($c==0){

} else {
	$medalsu = "
		<tr>

			<td style='width:30%' class='forumheader3'>".AMS_FORUM_S2.":</td>

			<td style='width:70%' class='forumheader3'>".$c."</td>

		</tr>

		<tr>
			<td style='width:30%' class='forumheader3'>".AMS_FORUM_S3.":</td>

			<td style='width:70%' class='forumheader3'>";

	$medalsu .= "
	        <table style='width:70%' class='fborder' cellspacing='0' cellpadding='0'>
	        <tr>
	        <td style='width:25%' class='forumheader3'>".AMS_MENU_S3."</td>
	        <td style='width:75%' class='forumheader3'>".AMS_MENU_S4."</td>
		</tr>";
	for($i=0; $i < count($medalnames); $i++)
		{
			$sql->db_Select("advmedsys_awarded", "*", "awarded_medal_id like ".$medalid[$i]." AND awarded_user_id like ".$SUSER_ID, true);
				$counter1 = 0;
				while($row = $sql->db_Fetch()){
				$counter1++;
				}
			if ($counter1 > 0) {
			$medalsu .= "
			<tr>
			<td style='width:25%' class='forumheader3'>".$counter1."x</td>
			<td style='width:75%' class='forumheader3'>
			<img src='" . e_PLUGIN . "advmedsys/medalimg/".$medalpic[$i]."' width='48' height='16' align='top' alt = ''>&nbsp</img> ".$medalnames[$i]."</td></tr>";
			}
		}
$medalsu .= "
		</table>
		</td>

		</tr>";
}
}

return $medalsu;
