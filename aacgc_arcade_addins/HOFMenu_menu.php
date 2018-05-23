<?php
if(file_exists(e_PLUGIN."kroozearcade_menu/language/".e_LANGUAGE.".php")){
	require_once(e_PLUGIN."kroozearcade_menu/language/".e_LANGUAGE.".php");
}
else{
	require_once(e_PLUGIN."kroozearcade_menu/language/English.php");
}

if ($pref['arcadeaddin_enable_gold'] == "1"){
$gold_obj = new gold();}

// GET CATEGORIES USER IS ALLOWED TO SEE
$sql->mySQLresult = @mysql_query("SELECT category_userclass, cat_id FROM ".MPREFIX."arcade_categories");
$catrows = $sql->db_Rows();

$rest = "";
for ($i = 0; $i < $catrows; $i++) {
	$row = $sql->db_Fetch();

	if ($row['category_userclass'] == e_UC_ADMIN) {
		if (!ADMIN) {
		$display = "NO"; // Not in userclass so dont display
		$rest1 = "g.game_category != ".$row['cat_id'];
		} else {
		$display = "YES";
		}
	} elseif ($row['category_userclass'] == e_UC_MEMBER) {
		if (!USER) {
		$display = "NO";
		$rest1 = "g.game_category != ".$row['cat_id'];
		} else {
		$display = "YES";
		}
	} elseif ($row['category_userclass'] == 255) {
		$display = "NO";
		$rest1 = "g.game_category != ".$row['cat_id'];
		} elseif ($row['category_userclass'] == '' || $row['category_userclass'] == 0) {
		$display = "YES";
	} else {
		$userc = @mysql_query("SELECT user_class FROM ".MPREFIX."user WHERE user_id='".USERID."'");
		$userc = mysql_fetch_array($userc);
		$break = explode(",", $userc['user_class']);

		if (!in_array($row['category_userclass'], $break)) {
		$display = "NO";
		$rest1 = "g.game_category != ".$row['cat_id'];
		} else {
		$display = "YES";
		}
	}

	if ($display != YES) {
	$rest .= " AND ".$rest1;
	}
}
$n = "0";
$sql->mySQLresult = @mysql_query("select user_id, count(game_id) as trophies from ".MPREFIX."arcade_champs group by user_id order by trophies desc;");
$rows = $sql->db_Rows();
if ($rows == 0) {
$hof_text = "<b>There are no scores in the database yet.</b>";
} else {


$hof_text .= "

<script type=\"text/javascript\">
function aaddonup(){aaddon.direction = \"up\";}
function aaddondown(){aaddon.direction = \"down\";}
function aaddonstop(){aaddon.stop();}
function aaddonstart(){aaddon.start();}
</script>

<marquee height='".$pref['arcadeaddonhof_height']."px' id='aaddon' scrollamount='".$pref['arcadeaddonhof_sscroll']."' onMouseover='this.scrollAmount=".$pref['arcadeaddonhof_onscroll']."' onMouseout='this.scrollAmount=".$pref['arcadeaddonhof_offscroll']."' direction='up' loop='true'>
<table width='100%' class=''>
";
	
	for ($i=0; $i < $rows; $i++) {
	$result = $sql->db_fetch();
        $user = @mysql_query("select user_name from ".MPREFIX."user where user_id='".$result['user_id']."'");
	$user = mysql_fetch_array($user);
$n++;
if ($pref['arcadeaddin_enable_gold'] == "1"){
$userorb = "".$gold_obj->show_orb($result['user_id'])."";}
else
{$userorb = "".$user['user_name']."";}  

        $hof_text .= "<tr><td class=''>".$n.".</td>";

        $hof_text .= "<td style='width:100%' class=''><a href='".e_BASE."user.php?id.".$result['user_id']."'>".$userorb."</a></td>";
	
	$hof_text .= "<td class=''>".$result['trophies']."</td></tr>";}
	
$hof_text .= "</table></marquee>

<br><br>
<table style='width:100%' class=''><tr><td>
<center>
<input class=\"button\" value=\"Start\" onClick=\"aaddonstart();\" type=\"button\">
<input class=\"button\" value=\"Stop\" onClick=\"aaddonstop();\" type=\"button\">
<input class=\"button\" value=\"Up\" onClick=\"aaddonup();\" type=\"button\">
<input class=\"button\" value=\"Down\" onClick=\"aaddondown();\" type=\"button\">
</center>
</td></tr></table>
<br>

";}


$hof_title .= "".$pref['arcadeaddonhof_title']."";





$ns -> tablerender($hof_title, $hof_text);

?>
