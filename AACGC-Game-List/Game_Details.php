<?php

/*
#######################################
#     AACGC Game List                 #                
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/
global $tp;

                                     ##################
//-----------------------------------#Main Page Config#------------------------------------------------------
                                     ##################


require_once("../../class2.php");
require_once(HEADERF);
if (e_QUERY) {
        $tmp = explode('.', e_QUERY);
        $action = $tmp[0];
        $sub_action = $tmp[1];
        $id = $tmp[2];
        unset($tmp);
}

if ($pref['gamelist_enable_theme'] == "1")
{$themea = "forumheader3";
$themeb = "indent";}
else
{$themea = "";
$themeb = "";}


if ($pref['gamelist_enable_gold'] == "1")
{$gold_obj = new gold();}

        if ($_POST['main_delete']) {
        $delete_id = array_keys($_POST['main_delete']);
        $sql2 = new db;
        $sql2->db_Delete("aacgc_gamelist_members", "chosen_id='".$delete_id[0]."'");
        $ns->tablerender("", "<center><b>Removed From Game List.</b><br><br>[<a href='".e_PLUGIN."aacgc_gamelist/Game_List.php'> Return To Game List </a>]</center>");
        require_once(FOOTERF);}
//------------------------------------------------------------------------------------------------------------

$text .= "<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js'></script>
<script type='text/javascript' src='gamelist.js'></script>
<script type='text/javascript'>
animatedcollapse.addDiv('video', 'fade=1,group=gamelist,persist=1,height=auto')
animatedcollapse.addDiv('cmms', 'fade=1,group=gamelist,persist=1,height=auto')
animatedcollapse.addDiv('clans', 'fade=1,group=gamelist,persist=1,height=auto')
animatedcollapse.addDiv('servers', 'fade=1,group=gamelist,height=auto')
animatedcollapse.addDiv('users', 'fade=1,group=gamelist,height=auto')
animatedcollapse.ontoggle=function($, divobj, state){}
animatedcollapse.init()
</script>";

//------------------------------------------------------------------------------------------------------------


$sql->db_Select("aacgc_gamelist", "*", "game_id = '".intval($sub_action)."' ");
$row = $sql->db_Fetch();


$text .= "<center><table style='width:75%' class='' cellspacing='' cellpadding=''><tr>
          <td style='width:50%; text-align:left'>[<a href='".e_PLUGIN."aacgc_gamelist/Game_List.php?det.".$row['game_cat']."'> Back To Game List </a>]</td>
          <td style='width:50%; text-align:right'>[<a href='".e_PLUGIN."aacgc_gamelist/Game_Categories.php'> Back To Category List </a>]</td>
          </tr></table></center><br>";




$text .= "<table style='width:100%' class='' cellspacing='' cellpadding=''>";



$text .= "<tr>
          <td class='".$themea."'><center><font size='".$pref['gamelistdet_namefs']."'>".$tp->toHTML($row['game_name'], TRUE)."</font></td>
          </tr>";

$text .= "<tr><td class='".$themeb."'>";

        $sql8 = new db;
        $sql8 ->db_Select("aacgc_gamelist_markedgames", "*", "game='".intval($row['game_id'])."'");
        while($row8 = $sql8 ->db_Fetch()){
        $sql10 = new db;
        $sql10 ->db_Select("aacgc_gamelist_marks", "*", "mark_id='".intval($row8['mark'])."'");
        $row10 = $sql10 ->db_Fetch();

$text .= "<img src='".e_PLUGIN."aacgc_gamelist/marks/".$row10['mark_img']."' alt='".$row10['mark_name']."'></img> = ".$row10['mark_name']."<br>";}


//-----------# Icon Path #---------------+
if($pref['gamelist_detailpageiconpath'] == "")
{$deticonpath = "icons";}
else
{$deticonpath = "".$pref['gamelist_detailpageiconpath']."";}
//---------------------------------------+

$text .= "<center><img src='".e_PLUGIN."aacgc_gamelist/".$deticonpath."/".$row['game_pic']."'></img>
          </td></tr>";


$text .= "<tr><td class='".$themea."'>";

if ($row['video'] == ""){}
else
{$text .= "
<div id='video' style='display:none'><center>".$tp->toHTML($row['video'], TRUE)."</center></div>
<br>";}


$text .= "<font size='".$pref['gamelistdet_detfs']."'>".$tp->toHTML($row['game_text'], TRUE)."</font>";


$text .= "</td></tr>";




//-----------------------# Game Rating #--------------------------
if ($pref['gamelist_enable_rating'] == "1"){
$text .= "<tr><td class='".$themeb."'>";
include_once(e_HANDLER."rate_class.php");
$rater = new rater;
$text .= "<span>";
if($rating = $rater->getrating('aacgc_gamelist', $row['game_id'])){
$text .= "".$row['game_name']." Rating: ";
$text .= $rating[2] ? "{$rating[1]}.{$rating[2]}/{$rating[0]}" : "{$rating[1]}/{$rating[0]}";
$text .= "<br>";
$num = $rating[1];
for($i=1; $i<= $num; $i++){
$text .= "<img src='".e_IMAGE_ABS."user_icons/user_star_".IMODE.".png' style='border:0' alt='' />";}}
if(USER){
if(!$rater->checkrated('aacgc_gamelist', $row['game_id'])){
$text .= " &nbsp; &nbsp;".$rater->rateselect('', 'aacgc_gamelist', $row['game_id']);}}
$text .= "</span>";
$text .= "</td></tr>";}
//----------------------------------------------------------------


$text .= "</table>";


//-------------------------------------------------# Links #-------------------------------------------------+


$text .= "<br><br><center><table style='width:' class='".$themeb."' cellspacing='5' cellpadding='5'><tr>";

if ($row['linka'] == ""){}
else
{$text .= "<td style='width:25%' class='".$themea."'><center>[ <a href='".$row['linka']."' target='_blank'>".$row['linkaname']."</a> ]</center></td>";}
if ($row['linkb'] == ""){}
else
{$text .= "<td style='width:25%' class='".$themea."'><center>[ <a href='".$row['linkb']."' target='_blank'>".$row['linkbname']."</a> ]</center></td>";}
if ($row['linkc'] == ""){}
else
{$text .= "<td style='width:25%' class='".$themea."'><center>[ <a href='".$row['linkc']."' target='_blank'>".$row['linkcname']."</a> ]</center></td>";}
if ($row['video'] == ""){}
else
{$text .= "<td style='width:25%' class='".$themea."'><center>[ <a href='#' rel='toggle[video]'>View Video</a> ]</center></td>";}

if($pref['gamelist_enable_product'] == "1"){
        $sql64 = new db;
        $sql64 ->db_Select("aacgc_gamelist_products", "*", "game='".intval($row['game_id'])."'");
        $row64 = $sql64 ->db_Fetch();
if ($row64['game'] == "".$row['game_id'].""){
$text .= "<td style='width:25%' class='".$themea."'><center>[ <a href='".e_PLUGIN."product_listing/Products.php?det.".$row64['productcat']."' target='_blank'>Purchase</a> ]</center></td>";
}}

$text .= "</tr></table></center>";


//-----------------------------# CMMS #----------------------+

if($pref['gamelist_enable_cmmsgamepage'] == "1"){

$text .= "<br><br>";

        $sql67 = new db;
        $sql67 ->db_Select("aacgc_gamelist_cmms", "*", "game='".intval($row['game_id'])."'");
        $row67 = $sql67 ->db_Fetch();

if ($row67['game'] == "".$row['game_id'].""){

$text .= "<table style='width:100%' class='' cellspacing='' cellpadding=''>
          <tr><td class='".$themea."'><center><b>".$row['game_name']." CMMS Clans:</b></td></tr>";

if(USER){
$text .= "<tr><td class='".$themea."'><center>[ <a href='".e_PLUGIN."aacgc_cmms/Clan_Submit_Form.php'>Submit My Clan</font></a> ]</center></td></tr>";}

$text .= "<tr>
          <td class='".$themea."'><center>
          <a href='#' rel='toggle[cmms]' data-openimage='".e_PLUGIN."aacgc_gamelist/images/hide.jpg' data-closedimage='".e_PLUGIN."aacgc_gamelist/images/show.jpg'><img src='".e_PLUGIN."aacgc_gamelist/images/hide.gif'></img></a>
          </center></td>
          </tr>
          </table>";

$text .= "<div id='cmms' style='display:none'><center>";

$text .= "<table style='width:100%' class='' cellspacing='' cellpadding=''>";
$text .= "<tr>
          <td style='width:50%' class='".$themea."'>Clan Name</td>
          <td style='width:0%' class='".$themea."'>Wins</td>
          <td style='width:0%' class='".$themea."'>Losses</td>
          <td style='width:0%' class='".$themea."'>Pending</td>
          <td style='width:0%' class='".$themea."'>Total</td>";
$text .= "</tr>";

        $n = "0";
        $sql11 = new db;
        $sql11 ->db_Select("aacgc_gamelist_cmms", "*", "game='".intval($row['game_id'])."'");
        while($row11 = $sql11 ->db_Fetch()){
        $sql12 = new db;
        $sql12->db_Select("aacgc_cmms_clans", "*", "clan_game='".intval($row11['cmmscat'])."'");
        while($clan = $sql12->db_Fetch()){
        $n++;


$sql3 = new db;
$sql3->mySQLresult = @mysql_query("select *, count(match_id) as totalwins from ".MPREFIX."aacgc_cmms_matches where match_winner='".intval($clan['clan_id'])."';");
$totals = $sql3->db_fetch();
$wins = "".$totals['totalwins']."";
$clanwins = $wins;

$sql4 = new db;
$sql4->mySQLresult = @mysql_query("select *, count(match_id) as totalloss from ".MPREFIX."aacgc_cmms_matches where match_looser='".intval($clan['clan_id'])."';");
$ltotals = $sql4->db_fetch();
$loss = "".$ltotals['totalloss']."";
$clanloss = $loss;

$sql5 = new db;
$sql5->mySQLresult = @mysql_query("select *, count(match_id) as dtotals from ".MPREFIX."aacgc_cmms_matches where clan_defence='".intval($clan['clan_id'])."';");
$dtotal = $sql5->db_fetch();
$clantotald = "".$dtotal['dtotals']."";

$sql9 = new db;
$sql9->mySQLresult = @mysql_query("select *, count(match_id) as totaldpend from ".MPREFIX."aacgc_cmms_matches where clan_defence='".intval($clan['clan_id'])."' AND match_status='1';");
$pdtotals = $sql9->db_fetch();
$sql8 = new db;
$sql8->mySQLresult = @mysql_query("select *, count(match_id) as totalopend from ".MPREFIX."aacgc_cmms_matches where clan_offence='".intval($clan['clan_id'])."' AND match_status='1';");
$pototals = $sql8->db_fetch();

$clandpend = "".$pdtotals['totaldpend']."";
$clanopend = "".$pototals['totalopend']."";
$clanpend = $clandpend + $clanopend;

$sql6 = new db;
$sql6->mySQLresult = @mysql_query("select *, count(match_id) as ototals from ".MPREFIX."aacgc_cmms_matches where clan_offence='".intval($clan['clan_id'])."';");
$ototal = $sql6->db_fetch();
$clantotalo = "".$ototal['ototals']."";
$clantotal = $clantotald + $clantotalo;


$text .= "<tr>
          <td style='width:50%; text-align:left' class='".$themeb."'><a href='".e_PLUGIN."aacgc_cmms/CMMS_Clan_Stats.php?det.".$clan['clan_id']."'>".$clan['clan_name']."</a></td>
          <td style='width:0%' class='".$themeb."'>".$clanwins."</td>
          <td style='width:0%' class='".$themeb."'>".$clanloss."</td>
          <td style='width:0%' class='".$themeb."'>".$clanpend."</td>
          <td style='width:0%' class='".$themeb."'>".$clantotal."</td>";
$text .= "</tr>";}}


$text .= "</table></center></div>";
}}


//-------------------------------------------------# Clan Listing #-------------------------------------------------+
if($pref['gamelist_enable_clanlistdet'] == "1"){
$text .= "<br><br>";

        $sql67 = new db;
        $sql67 ->db_Select("aacgc_gamelist_clanlist", "*", "game='".intval($row['game_id'])."'");
        $row67 = $sql67 ->db_Fetch();

if ($row67['game'] == "".$row['game_id'].""){

$text .= "<table style='width:100%' class='' cellspacing='' cellpadding=''>
          <tr><td class='".$themea."'><center><b>".$row['game_name']." Clans:</b></td></tr>";

if(USER){
if ($pref['clanlist_enable_clansubmit'] == "1"){
$text .= "<tr><td class='".$themea."'><center>[ <a href='".e_PLUGIN."clan_listing/Clan_Submit_Form.php'>Submit My Clan</font></a> ]</center></td></tr>";}}

$text .= "<tr>
          <td class='".$themea."'><center>
          <a href='#' rel='toggle[clans]' data-openimage='".e_PLUGIN."aacgc_gamelist/images/hide.jpg' data-closedimage='".e_PLUGIN."aacgc_gamelist/images/show.jpg'><img src='".e_PLUGIN."aacgc_gamelist/images/hide.gif'></img></a>
          </center></td>
          </tr>
          </table>";

$text .= "<div id='clans' style='display:none'><center>";

$text .= "<table style='width:100%' class='' cellspacing='' cellpadding=''>";


        $n = "0";
        $sql11 = new db;
        $sql11 ->db_Select("aacgc_gamelist_clanlist", "*", "game='".intval($row['game_id'])."'");
        while($row11 = $sql11 ->db_Fetch()){
        $sql12 = new db;
        $sql12->db_Select("clan_listing", "*", "clan_cat='".intval($row11['clancat'])."'");
        while($clan = $sql12->db_Fetch()){
        $n++;



$text .= "<tr>
          <td class='' style='width:0%'>".$n.".</td>
          <td style='width:' class='indent'>".$clan['clan_name']."</td>
          <td style='width:' class='indent'><a href='".$clan['clan_website']."' target=new>".$clan['clan_website']."</a></td>
          </tr>";}}


$text .= "</table></center></div>";
}}

//------------------------------------------------------------------------------------------------------------------+

//-------------------------------------------------# Server Listing #-------------------------------------------------+
if($pref['gamelist_enable_serverlistdet'] == "1"){
$text .= "<br><br>";

        $sql68 = new db;
        $sql68 ->db_Select("aacgc_gamelist_gameservers", "*", "game='".intval($row['game_id'])."'");
        $row68 = $sql68 ->db_Fetch();

if ($row68['game'] == "".$row['game_id'].""){


$text .= "<table style='width:100%' class='' cellspacing='' cellpadding=''>
          <tr><td class='".$themea."'><center><b>".$row['game_name']." Servers:</b></td></tr>";

if(USER){
if ($pref['gsl_enable_submit'] == "1"){
$text .= "<tr><td class='".$themea."'><center>
[ <a href='".e_PLUGIN."aacgc_serverlist/Server_Submit_Form.php'> Add My Game Server</a> ]
</center></td></tr>";}}

$text .= "<tr>
          <td class='".$themea."'><center>
          <a href='#' rel='toggle[servers]' data-openimage='".e_PLUGIN."aacgc_gamelist/images/hide.jpg' data-closedimage='".e_PLUGIN."aacgc_gamelist/images/show.jpg'><img src='".e_PLUGIN."aacgc_gamelist/images/hide.gif'></img></a>
          </center></td>
          </tr>
          </table>";

$text .= "<div id='servers' style='display:none'><center>";

$text .= "<table style='width:100%' class='' cellspacing='' cellpadding=''>";

        $n = "0";
        $sql14 = new db;
        $sql14 ->db_Select("aacgc_gamelist_gameservers", "*", "game='".intval($row['game_id'])."'");
        while($row14 = $sql14 ->db_Fetch()){
        $sql15 = new db;
        $sql15->db_Select("aacgc_serverlist", "*", "server_cat='".intval($row14['servercat'])."'");
        while($server = $sql15->db_Fetch()){
        $n++;



$text .= "<tr>
          <td class='' style='width:0%'>".$n.".</td>
          <td class='indent' style='width:'><center>
          <a href='".e_PLUGIN."aacgc_serverlist/Server_Details.php?det.".$server['server_id']."'>
          <img src='http://cache.www.gametracker.com/server_info/".$server['server_ip']."/b_350x20_C323957-202743-F19A15-111111.png' border='0' width='350' height='20'></img>
          </a>
          </td>
          </tr>";}}


$text .= "</table></center></div>";
}}

//------------------------------------------------------------------------------------------------------------------+

//--------------------------------------------------#Users#---------------------------------------------------------+
if ($pref['gamelist_enable_userjoin'] == "1"){

$text .= "
        <br></br>
        <table style='width:100%' class='' cellspacing='' cellpadding=''>
        <tr>
        <td class='".$themea."'><center><b>".$row['game_name']." Gamers:</b></td></tr>";

if (USER){
$text .= "<tr><td class='".$themea."'>
          <center>
          [ <a href='".e_PLUGIN."aacgc_gamelist/AddMe.php?det.".$row['game_id']."'>Join ".$row['game_name']." List</a> ]
          </td></tr>";}

$text .= "<tr>
          <td class='".$themea."'><center>
          <a href='#' rel='toggle[users]' data-openimage='".e_PLUGIN."aacgc_gamelist/images/hide.jpg' data-closedimage='".e_PLUGIN."aacgc_gamelist/images/show.jpg'><img src='".e_PLUGIN."aacgc_gamelist/images/hide.gif'></img></a>
          </center></td>
          </tr>
          </table>";

$text .= "<div id='users' style='display:none'><center>";

$text .= "<table style='width:100%' class='' cellspacing='' cellpadding=''>";


        $n = "0";
        $sql2 = new db;
        $sql2->db_Select("aacgc_gamelist_members", "*", "chosen_game_id='".intval($row['game_id'])."'");
        while($row2 = $sql2->db_Fetch()){
        $sql3 = new db;
        $sql3->db_Select("user", "*", "user_id='".intval($row2['user_id'])."'");
        $row3 = $sql3->db_Fetch();
        $sql77 = new db;
        $sql77 ->db_Select("user_extended", "*", "user_extended_id='".intval($row2['user_id'])."'");
        $row77 = $sql77->db_Fetch();

if(USER){
//-----------# User GameTracker #-----------
if($pref['gamelist_enable_playergt'] == "1"){
        if ($row77['user_gtn'] == "")
        {$playergt = "";}         
        else
        {$playergt = "<a href='http://www.gametracker.com/".$row77['user_gtn']."' target='_blank'><img src='http://www.gametracker.com/profile/".$row77['user_gtn']."/b_460x42_C000000-323957-202743-FFFFFF-F19A15-FFCC00.png' border='0' /></a>";}}       
//------------------------------------------
//-----------# User Xfire #-----------------
if($pref['gamelist_enable_xfire'] == "1"){
if($row77['user_xfire'] == ""){$xfireskin = "";}
else{
if ($pref['xf_skin'] == "Xfire Default"){
$xfireskin = "<a href='".e_PLUGIN."aacgc_xfirestats/Xfire_History.php?det.".$row2['user_id']."'><img src='http://miniprofile.xfire.com/bg/bg/type/3/".$row77['user_xfire'].".png' width='149' height='29' /></a>";}
if ($pref['xf_skin'] == "Sci-fi"){
$xfireskin = "<a href='".e_PLUGIN."aacgc_xfirestats/Xfire_History.php?det.".$row2['user_id']."'><img src='http://miniprofile.xfire.com/bg/sf/type/3/".$row77['user_xfire'].".png' width='149' height='29' /></a>";}
if ($pref['xf_skin'] == "Shadow"){
$xfireskin = "<a href='".e_PLUGIN."aacgc_xfirestats/Xfire_History.php?det.".$row2['user_id']."'><img src='http://miniprofile.xfire.com/bg/sh/type/3/".$row77['user_xfire'].".png' width='149' height='29' /></a>";}
if ($pref['xf_skin'] == "Combat"){
$xfireskin = "<a href='".e_PLUGIN."aacgc_xfirestats/Xfire_History.php?det.".$row2['user_id']."'><img src='http://miniprofile.xfire.com/bg/co/type/3/".$row77['user_xfire'].".png' width='149' height='29' /></a>";}
if ($pref['xf_skin'] == "Fantasy"){
$xfireskin = "<a href='".e_PLUGIN."aacgc_xfirestats/Xfire_History.php?det.".$row2['user_id']."'><img src='http://miniprofile.xfire.com/bg/os/type/3/".$row77['user_xfire'].".png' width='149' height='29'  /></a>";}}}
//------------------------------------------
//-----------# User GSC #-----------
if($pref['gamelist_enable_playergscdet'] == "1"){
        if ($row77['user_gsc'] == "")
        {$playergsc = "";}         
        else
        {$playergsc = "<a href='http://www.getgsc.com/' target='_blank'>
<img src='http://www.getgsc.com/images/status/xsmall/000000/D6E2F0/".$row77['user_gsc'].".png' alt='GSC' />";}}       
//------------------------------------------

}

$n++;

if ($pref['gamelist_enable_avatar'] == "1"){
if ($row3['user_image'] == "")
{$avatar = "<img src='".e_PLUGIN."aacgc_gamelist/images/default.png' width=".$pref['gamelist_avatar_size']."px></img>";}
else
{$useravatar = $row3[user_image];
require_once(e_HANDLER."avatar_handler.php");
$useravatar = avatar($useravatar);
$avatar = "<img src='".$useravatar."' width=".$pref['gamelist_avatar_size']."px></img>";}}

if ($pref['gamelist_enable_gold'] == "1")
{$userorb = "<a href='".e_BASE."user.php?id.".$row2['user_id']."'>".$gold_obj->show_orb($row2['user_id'])."</a>";}
else
{$userorb = "<a href='".e_BASE."user.php?id.".$row2['user_id']."'>".$row3['user_name']."</a>";}

if ($pref['gamelist_enable_friends'] == "1"){
if (USER){
$addfriend = "<a href='http://www.aacgc.com/SSGC/e107_plugins/alternate_profiles/newuser.php?id=".$row2['user_id']."&add'><img width='16px' src='".e_PLUGIN."aacgc_gamelist/images/add.png'></img></a>";}}


        $userid = $row2['user_id'];
        $member = $row2['chosen_id'];
        if ($userid == "".USERID.""){
        $del = "
        <form method='POST' action='".e_PLUGIN."aacgc_gamelist/Game_Details.php?det.".$row['game_id']."'>
        <input type='image' value='Delete' name='main_delete[{$member}]' src='".e_PLUGIN."aacgc_gamelist/images/Delete.png' alt='Delete Entry' onclick=\"return jsconfirm('Are you sure you want to remove yourself from the game list?')\"'>
        </form>";}
        else if (ADMIN){
        $del = "
        <form method='POST' action='".e_PLUGIN."aacgc_gamelist/Game_Details.php?det.".$row['game_id']."'>
        <input type='image' value='Delete' name='main_delete[{$member}]' src='".e_PLUGIN."aacgc_gamelist/images/Delete.png' alt='Delete Entry' onclick=\"return jsconfirm('Are you sure you want to remove ".$row3['user_name']." from the game list?')\"'>
        </form>";}
        else
        {$del = "";}


        $text .= "<tr>
                 <td class='' style='width:0%'>".$n.".</td>
                 <td class='".$themeb."' style='width:100%; text-align:left'>".$addfriend." ".$avatar." ".$userorb."</td>";
if(USER){
if($pref['gamelist_enable_xfire'] == "1"){
        $text .= "<td class='".$themeb."' style='width:0%'>".$xfireskin."</td>";}

if($pref['gamelist_enable_playergscdet'] == "1"){
        $text .= "<td class='".$themeb."' style='width:0%'>".$playergsc."</td>";}

if($pref['gamelist_enable_playergt'] == "1"){
        $text .= "<td class='".$themeb."' style='width:0%'>".$playergt."</td>";}

        $text .= "<td class='' style='width:0%'>".$del."</td>";
}
        $text .= "</tr>";}


       $text .= "</table></center></div>";}

//--------------------------------------------------#Comment#---------------------------------------------------------+

if ($pref['gamelist_enable_comments'] == "1"){

if ($_POST['add_comment'] == '1') {
$newgamecom = $_POST['com_game_id'];
$newuser = $_POST['user_id'];
$newcom = $_POST['user_com'];
$sql->db_Insert("aacgc_gamelist_comments", "NULL, '".$newgamecom."', '".$newuser."', '".$newcom."'") or die(mysql_error());
$ns->tablerender("", "<center><b>Comment Added.</b><br>[<a href='".e_PLUGIN."aacgc_gamelist/Game_Details.php?det.".$row['game_id']."'> Return To ".$row['game_name']." List </a>]</center>");
require_once(FOOTERF);}


$text .= "<br><br><center><table style='width:100%' class=''>
<tr><td class='".$themea."'><center><b>Game Comments:</b></center></td></tr>
</table>";

        $sql4 = new db;
        $sql4->db_Select("aacgc_gamelist_comments", "*", "com_game_id='".intval($row['game_id'])."'");
        while($row4 = $sql4->db_Fetch()){
        $sql5 = new db;
        $sql5->db_Select("user", "*", "user_id='".intval($row4['user_id'])."'");
        $row5 = $sql5->db_Fetch();
        $usercomid = "".$row4['user_id']."";
        $comid = $row4['com_id'];

        if ($usercomid == "".USERID.""){
        if ($_POST['com_delete']) {
        $deletecom_id = array_keys($_POST['com_delete']);
        $sql6 = new db;
        $sql6->db_Delete("aacgc_gamelist_comments", "com_id='".$deletecom_id[0]."'");
        $ns->tablerender("", "<center><b>Removed Comment.</b><br><br>[<a href='".e_PLUGIN."aacgc_gamelist/Game_Details.php?det.".$row['game_id']."'> Return To ".$row['game_name']." List </a>]</center>");
        require_once(FOOTERF);}

        $text .= "
        <form method='POST' action='".e_SELF."?det.".$row['game_id']."'>
        <input type='image' value='Delete' name='com_delete[{$comid}]' src='".e_PLUGIN."aacgc_gamelist/images/Delete.png' alt='Delete Entry' onclick=\"return jsconfirm('Are you sure you want to delete comment [ID: {$comid} ]')\"'> Delete Comment
        </form>";}

        else if (ADMIN){
        if ($_POST['com_delete']) {
        $deletecom_id = array_keys($_POST['com_delete']);
        $sql6 = new db;
        $sql6->db_Delete("aacgc_gamelist_comments", "com_id='".$deletecom_id[0]."'");
        $ns->tablerender("", "<center><b>Removed Comment.</b><br><br>[<a href='".e_PLUGIN."aacgc_gamelist/Game_Details.php?det.".$row['game_id']."'> Return To ".$row['game_name']." List </a>]</center>");
        require_once(FOOTERF);}

        $text .= "
        <form method='POST' action='".e_SELF."?det.".$row['game_id']."'>
        <input type='image' value='Delete' name='com_delete[{$comid}]' src='".e_PLUGIN."aacgc_gamelist/images/Delete.png' alt='Delete Entry' onclick=\"return jsconfirm('Are you sure you want to delete comment [ID: {$comid} ]')\"'> Delete Comment
        </form>";}
        else

        {$text .= "";}


if ($pref['gamelist_enable_avatar'] == "1"){
if ($row5['user_image'] == "")
{$avatar = "";}
else
{$useravatar = $row5[user_image];
require_once(e_HANDLER."avatar_handler.php");
$useravatar = avatar($useravatar);
$avatar = "<img src='".$useravatar."' width=".$pref['gamelist_avatar_size']."px></img>";}}
if ($pref['gamelist_enable_gold'] == "1")
{$userorb = "<font color='#00FF00'>".$gold_obj->show_orb($row4['user_id'])."</font>";}
else
{$userorb = "".$row5['user_name']."";}


$text .= "<table class='indent' style='width:100%'><tr>
<td class='".$themea."' style='width:'>".$avatar." ".$userorb."</td>
<td class='' style='width:80%'>".$row4['user_com']."</td>
</tr>
</table>";}



if (USER){
$text .= "<br><br><center>
<form method='POST' action='".e_SELF."?det.".$row['game_id']."'>
<table style='width:100%' class=''><tr>
<td>
<input type='hidden' name='user_id' value='".USERID."'>
</td>
</tr>
<tr>
<td>
<input type='hidden' name='com_game_id' value='".$row['game_id']."'>
</td>
</tr>
<tr>
<td style='width:60%' class=''>
<center><textarea class='tbox' rows='".$pref['gamelist_comheight']."' cols='".$pref['gamelist_comwidth']."' name='user_com'></textarea></center>
</td>";

$text .= "		
<tr style='vertical-align:top'>
<td style='text-align:center' class=''>
<input type='hidden' name='add_comment' value='1'>
<input class='button' type='submit' value='Add Comment'>
</td>
</tr></table>
</form>";}
/*
else
{$text .= "<center><br><br><br><i>You must Login or Register to Make Comments!</i></center>";}
*/
}



     
  $ns -> tablerender("Game Details", $text);


  require_once(FOOTERF);



?>