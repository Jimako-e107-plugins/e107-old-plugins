<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Welcome Menu              #   
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/



if (!defined('e107_INIT')) { exit; }



//--------------------------------#Menu Title#---------------------------------------

$welcome_title .= "".$pref['welcomemenu_title']."";

//-----------------------------------------------------------------------------------


//--------------------------------#Theme#--------------------------------------------
if ($pref['wm_theme'] == "1"){
$themea = "fcaption";
$themeb = "indent";}
else
{$themea = "";
$themeb = "";}
//-----------------------------------------------------------------------------------


//--------------------------------#Clock#--------------------------------------------
if ($pref['welcomemenu_enable_clock'] == "1"){
$indexArray = array('clock_dateprefix','clock_format','clock_datesuffix1','clock_datesuffix2','clock_datesuffix3','clock_datesuffix4');
foreach($indexArray as $ind)
{if(!isset($menu_pref[$ind]))
{$menu_pref[$ind]='';}}
$ec_dir = e_PLUGIN."aacgc_welcome_menu/";
$lan_file = $ec_dir."languages/".e_LANGUAGE.".php";
e107_include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."aacgc_welcome_menu/languages/English.php");
?>
<script type="text/javascript">
<!--
var DayNam = new Array(
"<?php echo isset($LAN_407)?$LAN_407:"".CLOCK_MENU_L11; ?>","<?php echo isset($LAN_401)?$LAN_401:"".CLOCK_MENU_L5; ?>","<?php echo isset($LAN_402)?$LAN_402:"".CLOCK_MENU_L6; ?>","<?php echo isset($LAN_403)?$LAN_403:"".CLOCK_MENU_L7; ?>","<?php echo isset($LAN_404)?$LAN_404:"".CLOCK_MENU_L8; ?>","<?php echo isset($LAN_405)?$LAN_405:"".CLOCK_MENU_L9; ?>","<?php echo isset($LAN_406)?$LAN_406:"".CLOCK_MENU_L10; ?>");
var MnthNam = new Array(
"<?php echo isset($LAN_411)?$LAN_411:"".CLOCK_MENU_L12; ?>","<?php echo isset($LAN_412)?$LAN_412:"".CLOCK_MENU_L13; ?>","<?php echo isset($LAN_413)?$LAN_413:"".CLOCK_MENU_L14; ?>","<?php echo isset($LAN_414)?$LAN_414:"".CLOCK_MENU_L15; ?>","<?php echo isset($LAN_415)?$LAN_415:"".CLOCK_MENU_L16; ?>","<?php echo isset($LAN_416)?$LAN_416:"".CLOCK_MENU_L17; ?>","<?php echo isset($LAN_417)?$LAN_417:"".CLOCK_MENU_L18; ?>","<?php echo isset($LAN_418)?$LAN_418:"".CLOCK_MENU_L19; ?>","<?php echo isset($LAN_419)?$LAN_419:"".CLOCK_MENU_L20; ?>","<?php echo isset($LAN_420)?$LAN_420:"".CLOCK_MENU_L21; ?>","<?php echo isset($LAN_421)?$LAN_421:"".CLOCK_MENU_L22; ?>","<?php echo isset($LAN_422)?$LAN_422:"".CLOCK_MENU_L23; ?>");
//-->
</script>
<?php
echo "
<script type='text/javascript' src='".e_PLUGIN."aacgc_welcome_menu/clock.js'></script>
<script type=\"text/javascript\">\nwindow.setTimeout(\"tick('".$menu_pref['clock_dateprefix']."', '".$menu_pref['clock_format']."', '".$menu_pref['clock_datesuffix1']."', '".$menu_pref['clock_datesuffix2']."', '".$menu_pref['clock_datesuffix3']."', '".$menu_pref['clock_datesuffix4']."')\",150);\n</script>
<!-- ### end clock ### //-->\n\n";

$welcome_text .= "<table style='width:100%' class='".$themea."'><tr><td><center>
                  <div id='Clock'></div>
                  </center></td></tr></table>";
}
//------------------------------------------------------------------------------------



//--------------------------------#Main Info#----------------------------------------

$sql ->db_Select("user", "*", "WHERE user_id=".USERID."","");
$row = $sql ->db_Fetch();

$useravatar = $row[user_image];
require_once(e_HANDLER."avatar_handler.php");
$useravatar = avatar($useravatar);

$sql11 = new db;
$sql11->mySQLresult = @mysql_query("select *, count(download_request_userid) as dls from ".MPREFIX."download_requests where download_request_userid=".USERID.";");
$dl = $sql11->db_fetch();

$datea = date("M d, Y",$row['user_lastvisit']);
$dateb = date("M d, Y",$row['user_lastpost']);
$datec = date("M d, Y",$row['user_join']);

include_once(e_HANDLER."rate_class.php");
$rater = new rater;
$rate="";
if($rating = $rater->getrating('user', USERID))
{$rate = "Your Rating:";
$num = $rating[1];
$rate.=" (".$num."/10) ";
for($i=1; $i<= $num; $i++)
{$rate .= ' <img src='.e_IMAGE_ABS.'user_icons/user_star_'.IMODE.'.png> ';}}

$username = "".$row['user_name']."";
$usertitle = "".$row['user_customtitle']."";
$userid = "".$row['user_id']."";
$useridshow = "".$row['user_id']."";
$userjoin = "".$datec."";
$userlastvisit = "".$datea."";
$userlastpost = "".$dateb."";
$userip = "".$row['user_ip']."";
$userforums = "".$row['user_forums']."";
$uservisits = "".$row['user_visits']."";
//$userchats = "".$row['user_chats']."";
$usercoms = "".$row['user_comments']."";
$userdl = "".$dl['dls']."";

//--------------------------------#Krooze Arcade#------------------------------------
if ($pref['welcomemenu_enable_arcade'] == "1"){

require_once(e_PLUGIN."kroozearcade_menu/arcade_class.php");
global $arcade_prefs;

$sql3 = new db;
$sql3->mySQLresult = @mysql_query("select user_id, count(game_id) as trophies from ".MPREFIX."arcade_champs where user_id=".USERID.";");
$result = $sql3->db_fetch();

$sql5 = new db;
$sql5->mySQLresult = @mysql_query("select won, count(won) as challwins from ".MPREFIX."arcade_challenges where won=".USERID.";");
$challs = $sql5->db_fetch();

$sql6 = new db;
$sql6->mySQLresult = @mysql_query("select chalto, count(chalto) as challr from ".MPREFIX."arcade_challenges where chalto=".USERID.";");
$chr = $sql6->db_fetch();

$sql7 = new db;
$sql7->mySQLresult = @mysql_query("select chalby, count(chalby) as challs from ".MPREFIX."arcade_challenges where chalby=".USERID.";");
$chs = $sql7->db_fetch();


$userwins = "".$result['trophies']."";
$userchalls = "".$challs['challwins']."";
//$usertours = "";
$cs = "".$chs['challs']."";
$cr = "".$chr['challr']."";
}


//--------------------------------#AACGC R & M#--------------------------------------

if ($pref['welcomemenu_enable_aacgcrm'] == "1"){



$sql12 = new db;
$r = 0;
$sql12->db_Select("advmedsys_awarded2", "*", "WHERE awarded_user_id='".USERID."'", "");
	while($row12 = $sql12->db_Fetch())
        {$r++;}

$sql13 = new db;
$m = 0;
$sql13->db_Select("advmedsys_awarded", "*", "WHERE awarded_user_id='".USERID."'", "");
	while($row13 = $sql13->db_Fetch())
        {$m++;}

$userribs = "Ribbons: ".$r."";
$usermeds = "Medals: ".$m."";
}

//--------------------------------#AACGC Roster#------------------------------------
/*
if ($pref['wm_enable_aacgcroster'] == "1"){

        $sqlros = new db;
        $sqlros ->db_Select("aacgc_roster_members", "*", "WHERE user_id='".USERID."'","");
        while($rowros = $sqlros ->db_Fetch()){
        $sqlros2 = new db;
        $sqlros2 ->db_Select("aacgc_roster", "*", "WHERE rank_id=".$rowros['awarded_rank_id']." ORDER BY rank_id DESC","");
        while($rowros2 = $sqlros2 ->db_Fetch()){

$useraacgcranks = "<br><img width='".$pref['wm_rank_size']."px' src='".e_PLUGIN."aacgc_roster/ranks/".$rowros2['rank_pic']."'></img>";}}
}
*/

//--------------------------------#Gold System#--------------------------------------

if ($pref['welcomemenu_enable_gold'] == "1"){


$gold_obj = new gold();

include_lan(e_PLUGIN . 'gold_system/languages/' . e_LANGUAGE . '.php');
global $GOLD_PREF, $sql2, $gold_obj, $grpg_obj, $tp, $grpg_obj,$PLUGINS_DIRECTORY;
$gold_balance = $gold_obj->gold_balance(USERID);

$sql4 = new db;
$sql4->mySQLresult = @mysql_query("select gpresy_id, count(gpressy_present) as presents from ".MPREFIX."gold_present where gpressy_recipient_id=".USERID.";");
$present = $sql4->db_fetch();

$sql8 = new db;
$sql8->mySQLresult = @mysql_query("select gpresy_id, count(gpressy_present) as pressent from ".MPREFIX."gold_present where gpressy_sender_id=".USERID.";");
$presentsent = $sql8->db_fetch();

$sql9 = new db;
$sql9->mySQLresult = @mysql_query("select glotto_player_id, count(glotto_player_id) as lottos from ".MPREFIX."gold_lottery_plays where glotto_player_id=".USERID.";");
$lotto = $sql9->db_fetch();

$sql16 = new db;
$sql16->mySQLresult = @mysql_query("select gasset_user_id, count(gasset_asset) as assets from ".MPREFIX."gold_asset where gasset_user_id=".USERID.";");
$as = $sql16->db_fetch();



$assets = "".$as['assets']."";
$userorb = "".$gold_obj->show_orb($userid)."";
$usergoldb = "".$gold_obj->formation($gold_balance)."";
$usergolds = "".$gold_obj->formation($gold_obj->gold_spent(USERID))."";
$userps = "".$present['presents']."";
$userpsent = "".$presentsent['pressent']."";
$userlotto = "".$lotto['lottos']."";}

else

{$userorb = "".$row['user_name']."";}

//------------------------------#Gold RPG#-----------------------------------------------------



if ($pref['welcomemenu_enable_rpg'] == "1"){
$grpg_obj = new gold_rpg;
$rpgid = "".USERID."";
$userrpg = "".$grpg_obj->rpgx($row['user_join'], $row['user_forums'])."";}





//--------------------------------------------# Menu #--------------------------------------------------------------


$welcome_text .= "<table style='width:100%' class=''><tr>";


//----------Section #1-----------

if ($pref['wm_enable_col1'] == "1"){

$welcome_text .= "<td style='width:15%' class='".$themeb."'>";


$welcome_text .= "".$userorb."<br>";


if ($pref['welcomemenu_enable_avatar'] == "1"){
$welcome_text .= "
<img width='".$pref['welcomemenu_avatarsize']."' src='".$useravatar."'></img>
<br>";}

if ($pref['welcomemenu_enable_id'] == "1"){
$welcome_text .= "
ID #: ".$useridshow."
<br>";}

if ($pref['welcomemenu_enable_ip'] == "1"){
$welcome_text .= "
IP: ".$userip."<br><br>
";}

$welcome_text .= "</td>";
}

//----------Section #2-----------

if ($pref['wm_enable_col2'] == "1"){

$welcome_text .= "<td style='width:20%' class='".$themeb."'>";

if ($pref['welcomemenu_enable_datejoined'] == "1"){
$welcome_text .= "Member Since:<br>(".$userjoin.")<br>";}

if ($pref['welcomemenu_enable_lastvisit'] == "1"){
$welcome_text .= "Last Visit:<br>(".$userlastvisit.")<br>";}

if ($pref['welcomemenu_enable_totalvisits'] == "1"){
$welcome_text .= "Total Visits: ".$uservisits."<br>";}

if ($pref['welcomemenu_enable_gold'] == "1"){
if ($pref['welcomemenu_enable_goldbalance'] == "1"){
$welcome_text .= "Balance:".$usergoldb."<br>";}
if ($pref['welcomemenu_enable_goldspent'] == "1"){
$welcome_text .= "Spent: ".$usergolds."<br>";}}

if ($pref['welcomemenu_enable_downloads'] == "1"){
$welcome_text .= "Downloads: ".$userdl."<br>";}

if ($pref['welcomemenu_enable_aacgcrm'] == "1"){
if ($pref['welcomemenu_enable_ribbons'] == "1"){
$welcome_text .= "".$userribs."<br>";}
if ($pref['welcomemenu_enable_medals'] == "1"){
$welcome_text .= "".$usermeds."<br><br>";}}

$welcome_text .= "</td>";
}

//----------Section #3-----------

if ($pref['wm_enable_col3'] == "1"){

$welcome_text .= "<td style='width:20%' class='".$themeb."'>";

if ($pref['welcomemenu_enable_totalposts'] == "1"){
$welcome_text .= "Total Posts: ".$userforums."<br>";}

if ($pref['welcomemenu_enable_lastpost'] == "1"){
$welcome_text .= "Last Post:<br>(".$userlastpost.")";}

if ($pref['welcomemenu_enable_rpg'] == "1"){
$welcome_text .= "".$userrpg."";}

$welcome_text .= "</td>";
}

//----------Section #4-----------

if ($pref['wm_enable_col4'] == "1"){

$welcome_text .= "<td style='width:20%' class='".$themeb."'>";

if ($pref['welcomemenu_enable_arcade'] == "1"){
if ($pref['welcomemenu_enable_arcadewins'] == "1"){
$welcome_text .= "Arcade Wins: ".$userwins."<br>";}
if ($pref['welcomemenu_enable_arcadechalls'] == "1"){
$welcome_text .= "<a href='".e_PLUGIN."kroozearcade_menu/challenges.php'>Challenges:</a>(S:".$cs." R:".$cr." W:".$userchalls.")<br>";}}

if ($pref['welcomemenu_enable_gold'] == "1"){
if ($pref['welcomemenu_enable_goldlottery'] == "1"){
$welcome_text .= "<a href='".e_PLUGIN."gold_lottery/index.php'>Lottery Plays: ".$userlotto."</a><br>";}
if ($pref['welcomemenu_enable_presents'] == "1"){
$welcome_text .= "<a href='".e_PLUGIN."gold_present/index.php'>Presents:</a>(S:".$userpsent." <a href='".e_PLUGIN."gold_present/mypresents.php'>R:".$userps."</a>)<br>";}
if ($pref['welcomemenu_enable_assets'] == "1"){
$welcome_text .= "Assets: ".$assets."<br>";}}

if ($pref['wm_enable_aacgcroster'] == "1"){

        $sqlros = new db;
        $sqlros ->db_Select("aacgc_roster_members", "*", "WHERE user_id='".USERID."'","");
        while($rowros = $sqlros ->db_Fetch()){
        $sqlros2 = new db;
        $sqlros2 ->db_Select("aacgc_roster", "*", "WHERE rank_id=".$rowros['awarded_rank_id']." ORDER BY rank_id DESC","");
        while($rowros2 = $sqlros2 ->db_Fetch()){

$useraacgcranks = "<br><img width='".$pref['wm_rank_size']."px' src='".e_PLUGIN."aacgc_roster/ranks/".$rowros2['rank_pic']."'></img>";


$welcome_text .= "".$useraacgcranks."";}}
}
if ($pref['wm_enable_aacgcadvroster'] == "1"){

        $sqladvros = new db;
        $sqladvros ->db_Select("aacgc_roster_adv_members", "*", "WHERE user_id='".USERID."'","");
        while($rowadvros = $sqladvros ->db_Fetch()){
        $sqladvros2 = new db;
        $sqladvros2 ->db_Select("aacgc_roster_adv", "*", "WHERE rank_id=".$rowadvros['awarded_rank_id']." ORDER BY rank_id DESC","");
        while($rowadvros2 = $sqladvros2 ->db_Fetch()){

$useraacgcadvranks = "<br><img width='".$pref['wm_advrank_size']."px' src='".e_PLUGIN."aacgc_roster_adv/ranks/".$rowadvros2['rank_pic']."'></img>";


$welcome_text .= "".$useraacgcadvranks."";}}
}


if ($pref['wm_enable_aacgcbattle'] == "1"){

        $sqlbinfo = new db;
        $sqlbinfo ->db_Select("user_extended", "*", "WHERE user_extended_id='".USERID."'","");
        $rowbinfo = $sqlbinfo ->db_Fetch();
if ($rowbinfo['user_battleid'] == "")
{}
else
{$welcome_text .= "<br><form  method='POST' action='http://www.aacgc.com/SSGC/e107_plugins/aacgc_battle_addon/bsplayerstats.php?det.".$rowbinfo['user_battleid']."' target='_blank'>
<input style='background-color:green' type='submit' value='Battle Stats'>
</form>";}}


$welcome_text .= "</td>";

}

//----------Section #5-----------


if ($pref['wm_enable_col5'] == "1"){

$welcome_text .= "
<td style='width:20%' class='".$themeb."'>
<center><font size='4'>
Welcome Back
<br>
".$userorb."
<br>
<img width='101px' src='".e_PLUGIN."aacgc_welcome_menu/images/army.gif'></img>
</font></center>
</td>";
}


$welcome_text .= "</table>";



//------------------Bottom 2 Sections-------------

$welcome_text .= "<table style='width:100%' class=''><tr>";

$welcome_text .= "
</tr>
<tr>";

if ($pref['welcomemenu_enable_rating'] == "1"){
$welcome_text .= "
<td class=''>".$rate."</td>
";}


if($pref['welcomemenu_enable_links'] == "1"){

if(ADMIN){
$welcome_text .= "<td class='button'><center>[ <a href='".e_ADMIN."admin.php'>Admin Area</a> ]</td>";}

$welcome_text .= "
<td class='button'><center>[ <a href='".e_BASE."usersettings.php'>Settings</a> ]</td>
<td class='button'><center>[ <a href='".e_BASE."user.php?id.".USERID."'>Profile</a> ]</td>
<td class='button'><center>[ <a href='".e_BASE."index.php?logout'>Logout</a> ]</td>
</td>";}

$welcome_text .= "</table>";

//------------------------------------------------



//---------------------#who's Online------------------------------
if ($pref['welcome_enable_onlinelist'] == "1"){
$welcome_text .= "<table style='width:100%' class='".$themea."'><tr>
                  <td class=''><center><b><u>Who's Online</u></b></center></td>
                  </tr><tr><td class=''>";

//----#SQL#----
$script="SELECT ".MPREFIX."user.*,".MPREFIX."online.*  FROM ".MPREFIX."online LEFT JOIN ".MPREFIX."user ON ".MPREFIX."online.online_user_id= CONCAT(".MPREFIX."user.user_id,'.',".MPREFIX."user.user_name) WHERE ".MPREFIX."online.online_user_id!='0' GROUP BY ".MPREFIX."user.user_id ORDER BY ".MPREFIX."user.user_name ASC";
$sql->db_Select_gen($script);
while ($row = $sql->db_Fetch()){
extract($row);
$isadmin = $row['user_admin'];
$user_id = $row['user_id'];
$user_name = $row['user_name'];
$online_location = $row['online_location'];
$user_image = $row['user_image'];
//----#Username#----
if ($pref['welcomemenu_enable_gold'] == "1")
{$userorb = "<font color='#00FF00'>".$gold_obj->show_orb($user_id)."</font>";}
else
{$userorb = "".$user_name."";}
//----#Avatar#----
if ($user_image == ""){
$user_image =  e_PLUGIN.'aacgc_addons/images/default.png';
$AVATAR = "<img width='30px' src='".$user_image."'></img>";}
else
{$user_image = str_replace(" ", "%20", $user_image);
require_once(e_HANDLER."avatar_handler.php");  
$userimage = avatar($user_image);
$AVATAR = "<img width='25px' src='".$userimage."'></img>";}



$welcome_text .= "<a href='".e_BASE."user.php?id.".$user_id."'>".$AVATAR."".$userorb."</a> , ";}



$welcome_text .= "</tr></td></table>";
}




$ns -> tablerender($welcome_title, $welcome_text);




?>