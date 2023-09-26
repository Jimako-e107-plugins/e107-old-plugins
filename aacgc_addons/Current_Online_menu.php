<?php
 
/*
##########################
# AACGC Addons           #
# M@CH!N3                #
# www.aacgc.com          #
# admin@aacgc.com        #
##########################
*/

global $tp, $e107cache, $e_event, $e107, $pref, $footer_js, $PLUGINS_DIRECTORY;

if ($pref['forumaddon_enable_gold'] == "1")
{$gold_obj = new gold();}





//--------------------------------------------------------------------------------------------------+


$onnow_title .= "".$pref['onlineaddon_title']."";

if ($pref['onlineaddon_enable_wide'] == "1"){
$onnow_text .= "<table style='width:100%' class='fcaption'><tr><td>";}

else

{$onnow_text .= "<table style='width:100%' class=''>
                  <tr><td colspan='2' class='fcaption'><center>Members: ".MEMBERS_ONLINE."</td></tr>
                  <tr>
                  <td style='width:50%' class='forumheader3'><u>User</u></td>
                  <td style='width:50%' class='forumheader3'><u>Location</u></td>";}


//--------------------------------------------------------------------------------------------------+



$script="SELECT ".MPREFIX."user.*,".MPREFIX."online.*  FROM ".MPREFIX."online LEFT JOIN ".MPREFIX."user ON ".MPREFIX."online.online_user_id= CONCAT(".MPREFIX."user.user_id,'.',".MPREFIX."user.user_name) WHERE ".MPREFIX."online.online_user_id!='0' GROUP BY ".MPREFIX."user.user_id ORDER BY ".MPREFIX."user.user_name ASC";
$sql->db_Select_gen($script);
while ($row = $sql->db_Fetch()){
extract($row);

$isadmin = $row['user_admin'];
$user_id = $row['user_id'];
$user_name = $row['user_name'];
$online_location = $row['online_location'];
$user_image = $row['user_image'];
$user_chats = $row['user_chats'];
$user_visits = $row['user_visits'];
$user_comments = $row['user_comments'];
$user_forums = $row['user_forums'];
$user_customtitle = $row['user_customtitle'];


//--------------------------------------#NAME#----------------------------------------------------------

if ($pref['forumaddon_enable_gold'] == "1")
{$userorb = "<font color='#00FF00'>".$gold_obj->show_orb($user_id)."</font>";}
else
{$userorb = "".$user_name."";}

//--------------------------------------#AVATAR#-----------------------------------------------------------

if ($pref['onlineaddon_enable_avatar'] == "1"){
if ($user_image == ""){
$user_image =  e_PLUGIN.'aacgc_addons/images/default.png';
$AVATAR = "<img width='30px' src='".$user_image."'></img>";}

else

{$user_image = str_replace(" ", "%20", $user_image);
require_once(e_HANDLER."avatar_handler.php");  
$userimage = avatar($user_image);

$AVATAR = "<img width='30px' src='".$userimage."'></img>";}}

else
{$AVATAR = "";}




//-------------------------------------#LOCATION#-------------------------------------------------------------

if ($pref['onlineaddon_enable_location'] == "1"){


                
                $online_page = eregi_replace(".php", "", substr(strrchr($online_location, "/"), 1));
                if ($online_page == "log" || $online_location_page == "error")
                {$online_location = "news.php";
                 $online_page = "News";}

                
                 $forumlocation= explode(".",$online_location_page);
		 $online_location = eregi_replace("forum_viewtopic.php.", "forum_viewtopic.php?", $online_location);
		 $online_location = eregi_replace("forum_viewforum.php.", "forum_viewforum.php?", $online_location);



                if ($online_location == "http://www.aacgc.com/SSGC/e107_plugins/chatbox2_menu/chatbox2_control.php")
                {$online_location = "news.php";
                 $online_page = "News";}

                if ($online_location == "http://www.aacgc.com/SSGC/e107_plugins/gold_system/index.php")
                {$online_page = "Gold Centre";}

                if ($online_location == "http://www.aacgc.com/SSGC/e107_plugins/gold_shop/index.php")
                {$online_page = "Gold Shop";}

                if ($online_location == "http://www.aacgc.com/SSGC/e107_plugins/gold_orb/index.php")
                {$online_page = "Gold Orbs";}

                if ($online_location == "http://www.aacgc.com/SSGC/e107_plugins/gold_asset/index.php")
                {$online_page = "Gold Assets";}

                if ($online_location == "http://www.aacgc.com/SSGC/e107_plugins/gold_present/index.php")
                {$online_page = "Gold Presents";}

                if ($online_location == "http://www.aacgc.com/SSGC/e107_plugins/gold_lottery/index.php")
                {$online_page = "Lottery";}

                if ($online_location == "http://www.aacgc.com/SSGC/e107_plugins/gold_pdice/index.php")
                {$online_page = "Poker Dice";}

                if ($online_location == "http://www.aacgc.com/SSGC/e107_plugins/gold_hilo/index.php")
                {$online_page = "Hi / Lo";}

                if ($online_location == "http://www.aacgc.com/SSGC/e107_plugins/quiztopia/main.php")
                {$online_page = "Quiztopia";}

                if ($online_location == "http://www.aacgc.com/SSGC/e107_plugins/knp/knp.php")
                {$online_page = "R.P.S.";}

                if ($online_location == "http://www.aacgc.com/SSGC/e107_plugins/gold_td/index.php")
                {$online_page = "C.T.P.";}

                if ($online_location == "http://www.aacgc.com/SSGC/e107_plugins/advmedsys/advmedsys_view.php")
                {$online_page = "Ribbons & Medals";}

                if ($online_location == "http://www.aacgc.com/SSGC/e107_plugins/kroozearcade_menu/games/newwindow.php")
                {$online_page = "InGame";}

                if ($online_location == "http://www.aacgc.com/SSGC/e107_plugins/kroozearcade_menu/games/index.php")
                {$online_page = "Submit Score";}

                if ($online_location == "http://www.aacgc.com/SSGC/e107_plugins/gold_settings/index.php")
                {$online_page = "Gold Settings";}

                if ($online_location == "http://www.aacgc.com/SSGC/e107_plugins/alternate_profiles/usersettingshandler.php")
                {$online_page = "User Settings";}

                if ($online_location == "http://www.aacgc.com/SSGC/e107_plugins/alternate_profiles/newuser.php")
                {$online_page = "Profile";}

                if ($online_location == "http://www.aacgc.com/SSGC/e107_plugins/wrap/wrap.php")
                {$online_page = "Battle";}

                if ($isadmin){
                $online_location = "news.php" ;
                $online_page = "<marquee direction='left' width='10%'><<</marquee><img src='".e_PLUGIN."aacgc_addons/images/admin.png'></img><marquee direction='right' width='10%'>>></marquee>";}



                
}

else

{$online_page = "";}







//-----------------------------------#DISPLAY#---------------------------------------------------------------+

if ($pref['addon_enable_pmicon'] == "1")
{$pmicons = "<a href='".e_PLUGIN."pm/pm.php?send.$user_id'><img src='".e_PLUGIN."aacgc_addons/images/icon_pm.png'  alt='PM This User'></img></a>";}

if ($pref['addon_enable_friendicon'] == "1")
{$friendicon = "<a href='".e_PLUGIN."alternate_profiles/newuser.php?id=".$user_id."&add'><img src='".e_PLUGIN."aacgc_addons/images/friend.png'  alt='Add User To Friends'></img></a>";}

if ($pref['onlineaddon_enable_wide'] == "1"){

$onnow_text .= "<a href='".e_BASE."user.php?id.".$user_id."'>".$AVATAR."".$userorb."</a>  ".$pmicons."".$friendicon."  ".$online_location_page." , ";}

else

{$onnow_text .= "<tr>
                 <td class='indent'><a href='".e_BASE."user.php?id.".$user_id."'>".$AVATAR."".$userorb."</a>  ".$pmicons." ".$friendicon."</td>
                 <td class='indent'><a href='".$online_location."'>".$online_page."</a></td>
                 </tr>";}}





if ($pref['onlineaddon_enable_wide'] == "1"){
$onnow_text .= "</td></tr></table>";}

else

{$onnow_text .= "</table>";}




//----------------------------------------------#Guests#---------------------------------------------------------------


if ($pref['onlineaddon_enable_guests'] == "1"){



$onnow_text .= "<table style='width:100%' class=''><tr>
                 <td class='fcaption' colspan=2><center>Guests: ".GUESTS_ONLINE."</td>
                 </tr>";

if (GUESTS_ONLINE == "0")
{$onnow_text .= "";}

else

{$onnow_text .= "<tr>
                 <td style='width:50%' class='forumheader3'><u>Guest</u></td>
                 <td style='width:50%' class='forumheader3'><u>Location</u></td>
                 </tr>";


                $sql->db_Select("online", "*", "online_user_id='0' ORDER BY online_user_id ASC ");
                while ($row = $sql->db_Fetch())
                {extract($row);


if (ADMIN)
{$guestip = $online_ip;

if ($pref['onlineaddon_enable_webbot'] == "1"){

$host = $e107->get_host_name($guestip);
$getbot= explode(".",$host);

	if ($getbot[1]=="inktomisearch"){$webbot="Inktomi/Yahoo";$boticon="robot_yahoo.png";}
	if ($getbot[2]=="Yahoo"){$webbot="Yahoo";$boticon="robot_yahoo.png";}
	if ($getbot[1]=="msn"){$webbot="MSN";$boticon="robot_msn.png";}
	if ($getbot[1]=="gigablast"){$webbot="Gigablast";$boticon="robot_gigablast.png";}
	if ($getbot[1]=="googlebot"){$webbot="Google";$boticon="robot_google.png";}
	if ($getbot[1]=="lycos"){$webbot="Lycos";$boticon="robot_lycos.png";}
	if ($getbot[2]=="lycos"){$webbot="Lycos";$boticon="robot_lycos.png";}
	if ($getbot[1]=="t-online"){$webbot="Infoseek";$boticon="robot_infoseek.png";}
	if ($getbot[1]=="askj"){$webbot="Teoma/Ask";$boticon="robot_askjeeves.png";}
	if ($getbot[1]=="ask"){$webbot="Teoma/Ask";$boticon="robot_askjeeves.png";}
	if ($getbot[2]=="ask"){$webbot="Teoma/Ask";$boticon="robot_askjeeves.png";}
	if ($getbot[1]=="looksmart"){$webbot="Looksmart";$boticon="robot_looksmart.png";}
	if ($getbot[1]=="cosmixcorp"){$webbot="Kosmix";$boticon="robot_kosmix.png";}
	if ($getbot[1]=="goo"){$webbot="Goo";$boticon="robot_goo.png";}
	if ($getbot[1]=="exabot"){$webbot="Exalead";$boticon="robot_exalead.png";}
	if ($getbot[4]=="become"){$webbot="Become";$boticon="robot_become.png";}
	if ($getbot[1]=="search" && $getbot[2]=="live"){$webbot="Windows Live";$boticon="robot_windows_live_search.png";}
	if ($getbot[1]=="browster"){$webbot="Browster";$boticon="robot_browster.png";}
	if ($getbot[1]=="attentio.com"){$webbot="Attentio";$boticon="robot_attentio.png";}
	if ($getbot[2]=="yahoo"){$webbot="Yahoo";$boticon="robot_yahoo.png";}
	if(ip2long($oname)>=ip2long("65.214.36.0") && ip2long($oname)<=ip2long("65.214.39.255")){$webbot="Teoma/Ask";$boticon="robot_askjeeves.png";}
	if(ip2long($oname)>=ip2long("220.181.0.0") && ip2long($oname)<=ip2long("220.181.255.255")){$webbot="SoGou";$boticon="robot_sogou.png";}
	if(ip2long($oname)>=ip2long("66.151.181.0") && ip2long($oname)<=ip2long("66.151.181.255")){$webbot="Fast Search";$boticon="robot_fastsearch.png";}
	if(ip2long($oname)>=ip2long("70.42.51.0") && ip2long($oname)<=ip2long("70.42.51.0")){$webbot="Fast Search";$boticon="robot_fastsearch.png";}
	if(ip2long($oname)>=ip2long("69.25.71.0") && ip2long($oname)<=ip2long("69.25.71.255")){$webbot="Fast Search";$boticon="robot_fastsearch.png";}
	if(ip2long($oname)>=ip2long("209.59.128.0") && ip2long($oname)<=ip2long("209.59.191.255")){$webbot="AbiLogic";$boticon="robot_abilogic.png";}
	if(ip2long($oname)>=ip2long("69.25.71.0") && ip2long($oname)<=ip2long("69.25.71.255")){$webbot="Accoona";$boticon="robot_accoona.png";}
	if(ip2long($oname)>=ip2long("81.205.0.0") && ip2long($oname)<=ip2long("81.205.255.255")){$webbot="Walhello";$boticon="robot_walhello.png";}
	if(ip2long($oname)>=ip2long("202.106.0.0") && ip2long($oname)<=ip2long("202.106.255.255")){$webbot="Baidu";$boticon="robot_baidu.png";}
	if(ip2long($oname)>=ip2long("202.108.0.0") && ip2long($oname)<=ip2long("202.108.255.255")){$webbot="Baidu";$boticon="robot_baidu.png";}
	if(ip2long($oname)>=ip2long("216.148.252.96") && ip2long($oname)<=ip2long("216.148.252.111")){$webbot="Bloglines";$boticon="robot_bloglines.png";}
	if(ip2long($oname)>=ip2long("64.152.0.0") && ip2long($oname)<=ip2long("64.159.255.255")){$webbot="BlogPulse";$boticon="robot_blogpulse.png";}
	if(ip2long($oname)>=ip2long("84.136.0.0") && ip2long($oname)<=ip2long("84.191.25.255")){$webbot="BtBot";$boticon="robot_robot.png";}
	if(ip2long($oname)>=ip2long("88.104.0.0") && ip2long($oname)<=ip2long("88.107.255.255")){$webbot="Burf";$boticon="robot_burf.png";}
	if(ip2long($oname)>=ip2long("70.84.0.0") && ip2long($oname)<=ip2long("70.87.127.255")){$webbot="CamCrawler";$boticon="robot_camcrawler.png";}
	if(ip2long($oname)>=ip2long("212.27.33.0") && ip2long($oname)<=ip2long("212.27.33.255")){$webbot="Pompos";$boticon="robot_pompos.png";}
	if(ip2long($oname)>=ip2long("133.9.0.0") && ip2long($oname)<=ip2long("133.9.255.255")){$webbot="e-Society";$boticon="robot_robot.png";}
	if(ip2long($oname)>=ip2long("64.29.176.0") && ip2long($oname)<=ip2long("64.29.191.255")){$webbot="Filangy";$boticon="robot_filangy.png";}
	if(ip2long($oname)>=ip2long("80.239.38.0") && ip2long($oname)<=ip2long("80.239.38.255")){$webbot="Findexa";$boticon="robot_findexa.png";}
	if(ip2long($oname)>=ip2long("64.210.192.0") && ip2long($oname)<=ip2long("64.210.255.255")){$webbot="Girafa";$boticon="robot_girafa.png";}
	if(ip2long($oname)>=ip2long("209.237.237.0") && ip2long($oname)<=ip2long("209.237.238.255")){$webbot="Alexa";$boticon="robot_alexa.png";}
	if(ip2long($oname)>=ip2long("87.218.0.0") && ip2long($oname)<=ip2long("87.218.255.254")){$webbot="Ipselon";$boticon="robot_ipselon.png";}
	if(ip2long($oname)>=ip2long("128.194.0.0") && ip2long($oname)<=ip2long("128.194.255.255")){$webbot="IRL crawler";$boticon="robot_robot.png";}
	if(ip2long($oname)>=ip2long("64.71.128.0") && ip2long($oname)<=ip2long("64.71.191.255")){$webbot="IRL crawler";$boticon="robot_krugle.png";}
	if(ip2long($oname)>=ip2long("82.131.195.0") && ip2long($oname)<=ip2long("82.131.195.255")){$webbot="Lapozz";$boticon="robot_lapozz.png";}
	if(ip2long($oname)>=ip2long("216.52.252.192") && ip2long($oname)<=ip2long("216.52.252.255")){$webbot="Local";$boticon="robot_local.png";}
	if(ip2long($oname)>=ip2long("64.242.88.0") && ip2long($oname)<=ip2long("64.242.88.255")){$webbot="Look Smart";$boticon="robot_looksmart.png";}
	if(ip2long($oname)>=ip2long("217.154.244.0") && ip2long($oname)<=ip2long("217.154.245.255")){$webbot="LOOP Improvements";$boticon="robot_mirago.png";}
	if(ip2long($oname)>=ip2long("213.251.136.0") && ip2long($oname)<=ip2long("213.251.143.255")){$webbot="Misterbot";$boticon="robot_misterbot.png";}
	if(ip2long($oname)>=ip2long("217.155.192.0") && ip2long($oname)<=ip2long("217.155.207.255")){$webbot="Mojeek";$boticon="robot_mojeek.png";}
	if(ip2long($oname)>=ip2long("220.72.0.0") && ip2long($oname)<=ip2long("220.87.255.255")){$webbot="Naver";$boticon="robot_naver.png";}
	if(ip2long($oname)>=ip2long("222.96.0.0") && ip2long($oname)<=ip2long("222.122.255.255")){$webbot="Naver";$boticon="robot_naver.png";}
	if(ip2long($oname)>=ip2long("67.104.0.0") && ip2long($oname)<=ip2long("67.111.255.255")){$webbot="Zoominfo";$boticon="robot_zoominfo.png";}
	if(ip2long($oname)>=ip2long("72.5.115.0") && ip2long($oname)<=ip2long("72.5.115.127")){$webbot="NimbleCrawler";$boticon="robot_nimblecrawler.png";}
	if(ip2long($oname)>=ip2long("194.224.199.0") && ip2long($oname)<=ip2long("194.224.199.25")){$webbot="noXtrum";$boticon="robot_noxtrum.png";}
	if(ip2long($oname)>=ip2long("84.9.136.0") && ip2long($oname)<=ip2long("84.9.139.255")){$webbot="Nusearch";$boticon="robot_nusearch.png";}
	if(ip2long($oname)>=ip2long("64.127.124.0") && ip2long($oname)<=ip2long("64.127.124.255")){$webbot="Omni-Explorer";$boticon="robot_robot.png";}
	if(ip2long($oname)>=ip2long("213.180.128.0") && ip2long($oname)<=ip2long("213.180.131.255")){$webbot="OnetSzukaj";$boticon="robot_onetszukaj.png";}
	if(ip2long($oname)>=ip2long("217.208.0.0") && ip2long($oname)<=ip2long("217.215.255.255")){$webbot="Picsearch";$boticon="robot_picsearch.png";}
	if(ip2long($oname)>=ip2long("81.19.64.0") && ip2long($oname)<=ip2long("81.19.66.255")){$webbot="StackRambler";$boticon="robot_stackrambler.png";}
	if(ip2long($oname)>=ip2long("66.151.181.0") && ip2long($oname)<=ip2long("66.151.181.255")){$webbot="Scirus";$boticon="robot_scirus.png";}
	if(ip2long($oname)>=ip2long("195.27.215.64") && ip2long($oname)<=ip2long("195.27.215.95")){$webbot="Seekport";$boticon="robot_robot.png";}
	if(ip2long($oname)>=ip2long("70.42.51.0") && ip2long($oname)<=ip2long("70.42.51.127")){$webbot="Sensis";$boticon="robot_sensis.png";}
	if(ip2long($oname)>=ip2long("38.0.0.0") && ip2long($oname)<=ip2long("38.255.255.255")){$webbot="Snap";$boticon="robot_snap.png";}
	if(ip2long($oname)>=ip2long("66.234.128.0") && ip2long($oname)<=ip2long("66.234.159.255")){$webbot="Snap";$boticon="robot_snap.png";}
	if(ip2long($oname)>=ip2long("81.208.26.0") && ip2long($oname)<=ip2long("81.208.26.63")){$webbot="Sygo";$boticon="robot_sygo.png";}
	if(ip2long($oname)>=ip2long("217.113.244.112") && ip2long($oname)<=ip2long("217.113.244.127")){$webbot="Ulysseek";$boticon="robot_ulysseek.png";}
	if(ip2long($oname)>=ip2long("193.252.148.0") && ip2long($oname)<=ip2long("193.252.148.255")){$webbot="Voila";$boticon="robot_voila.png";}
	if(ip2long($oname)>=ip2long("202.51.8.0") && ip2long($oname)<=ip2long("202.51.15.255")){$webbot="Wadaino";$boticon="robot_wadaino.png";}
	if(ip2long($oname)>=ip2long("64.13.128.0") && ip2long($oname)<=ip2long("64.13.191.255")){$webbot="Wink";$boticon="robot_wink.png";}
        if(ip2long($oname)>=ip2long("66.231.188.186") && ip2long($oname)<=ip2long("66.231.188.186")){$webbot="Gigablast";$boticon="robot_gigablast.png";}
        if(ip2long($oname)>=ip2long("62.113.137.5") && ip2long($oname)<=ip2long("62.113.137.5")){$webbot="Fast Search";$boticon="robot_fastsearch.png";}
        if(ip2long($oname)>=ip2long("65.214.44.29") && ip2long($oname)<=ip2long("65.214.44.29")){$webbot="Bloglines";$boticon="robot_bloglines.png";}
        if(ip2long($oname)>=ip2long("195.113.214.201") && ip2long($oname)<=ip2long("195.113.214.201")){$webbot="CESNET";$boticon="robot_robot.png";}

$guest = "<img src='".e_PLUGIN."aacgc_addons/images/robots/".$boticon."' alt='".$host."'></img>".$webbot."";

if($webbot == ""){
$ogimg = "<img src='".e_PLUGIN."aacgc_addons/images/guest.png' alt='".$host."'></img>".$guestip."";}
else
{$ogimg = "".$guest."";}

}
else
{$ogimg = "<img src='".e_PLUGIN."aacgc_addons/images/guest.png'></img>".$host."";}}


else{


if ($pref['onlineaddon_enable_webbot'] == "1"){
$guestip = $online_ip;
$host = $e107->get_host_name($guestip);
$getbot= explode(".",$host);

	if ($getbot[1]=="inktomisearch"){$webbot="Inktomi/Yahoo";$boticon="robot_yahoo.png";}
	if ($getbot[2]=="Yahoo"){$webbot="Yahoo";$boticon="robot_yahoo.png";}
	if ($getbot[1]=="msn"){$webbot="MSN";$boticon="robot_msn.png";}
	if ($getbot[1]=="gigablast"){$webbot="Gigablast";$boticon="robot_gigablast.png";}
	if ($getbot[1]=="googlebot"){$webbot="Google";$boticon="robot_google.png";}
	if ($getbot[1]=="lycos"){$webbot="Lycos";$boticon="robot_lycos.png";}
	if ($getbot[2]=="lycos"){$webbot="Lycos";$boticon="robot_lycos.png";}
	if ($getbot[1]=="t-online"){$webbot="Infoseek";$boticon="robot_infoseek.png";}
	if ($getbot[1]=="askj"){$webbot="Teoma/Ask";$boticon="robot_askjeeves.png";}
	if ($getbot[1]=="ask"){$webbot="Teoma/Ask";$boticon="robot_askjeeves.png";}
	if ($getbot[2]=="ask"){$webbot="Teoma/Ask";$boticon="robot_askjeeves.png";}
	if ($getbot[1]=="looksmart"){$webbot="Looksmart";$boticon="robot_looksmart.png";}
	if ($getbot[1]=="cosmixcorp"){$webbot="Kosmix";$boticon="robot_kosmix.png";}
	if ($getbot[1]=="goo"){$webbot="Goo";$boticon="robot_goo.png";}
	if ($getbot[1]=="exabot"){$webbot="Exalead";$boticon="robot_exalead.png";}
	if ($getbot[4]=="become"){$webbot="Become";$boticon="robot_become.png";}
	if ($getbot[1]=="search" && $getbot[2]=="live"){$webbot="Windows Live";$boticon="robot_windows_live_search.png";}
	if ($getbot[1]=="browster"){$webbot="Browster";$boticon="robot_browster.png";}
	if ($getbot[1]=="attentio.com"){$webbot="Attentio";$boticon="robot_attentio.png";}
	if ($getbot[2]=="yahoo"){$webbot="Yahoo";$boticon="robot_yahoo.png";}
	if(ip2long($oname)>=ip2long("65.214.36.0") && ip2long($oname)<=ip2long("65.214.39.255")){$webbot="Teoma/Ask";$boticon="robot_askjeeves.png";}
	if(ip2long($oname)>=ip2long("220.181.0.0") && ip2long($oname)<=ip2long("220.181.255.255")){$webbot="SoGou";$boticon="robot_sogou.png";}
	if(ip2long($oname)>=ip2long("66.151.181.0") && ip2long($oname)<=ip2long("66.151.181.255")){$webbot="Fast Search";$boticon="robot_fastsearch.png";}
	if(ip2long($oname)>=ip2long("70.42.51.0") && ip2long($oname)<=ip2long("70.42.51.0")){$webbot="Fast Search";$boticon="robot_fastsearch.png";}
	if(ip2long($oname)>=ip2long("69.25.71.0") && ip2long($oname)<=ip2long("69.25.71.255")){$webbot="Fast Search";$boticon="robot_fastsearch.png";}
	if(ip2long($oname)>=ip2long("209.59.128.0") && ip2long($oname)<=ip2long("209.59.191.255")){$webbot="AbiLogic";$boticon="robot_abilogic.png";}
	if(ip2long($oname)>=ip2long("69.25.71.0") && ip2long($oname)<=ip2long("69.25.71.255")){$webbot="Accoona";$boticon="robot_accoona.png";}
	if(ip2long($oname)>=ip2long("81.205.0.0") && ip2long($oname)<=ip2long("81.205.255.255")){$webbot="Walhello";$boticon="robot_walhello.png";}
	if(ip2long($oname)>=ip2long("202.106.0.0") && ip2long($oname)<=ip2long("202.106.255.255")){$webbot="Baidu";$boticon="robot_baidu.png";}
	if(ip2long($oname)>=ip2long("202.108.0.0") && ip2long($oname)<=ip2long("202.108.255.255")){$webbot="Baidu";$boticon="robot_baidu.png";}
	if(ip2long($oname)>=ip2long("216.148.252.96") && ip2long($oname)<=ip2long("216.148.252.111")){$webbot="Bloglines";$boticon="robot_bloglines.png";}
	if(ip2long($oname)>=ip2long("64.152.0.0") && ip2long($oname)<=ip2long("64.159.255.255")){$webbot="BlogPulse";$boticon="robot_blogpulse.png";}
	if(ip2long($oname)>=ip2long("84.136.0.0") && ip2long($oname)<=ip2long("84.191.25.255")){$webbot="BtBot";$boticon="robot_robot.png";}
	if(ip2long($oname)>=ip2long("88.104.0.0") && ip2long($oname)<=ip2long("88.107.255.255")){$webbot="Burf";$boticon="robot_burf.png";}
	if(ip2long($oname)>=ip2long("70.84.0.0") && ip2long($oname)<=ip2long("70.87.127.255")){$webbot="CamCrawler";$boticon="robot_camcrawler.png";}
	if(ip2long($oname)>=ip2long("212.27.33.0") && ip2long($oname)<=ip2long("212.27.33.255")){$webbot="Pompos";$boticon="robot_pompos.png";}
	if(ip2long($oname)>=ip2long("133.9.0.0") && ip2long($oname)<=ip2long("133.9.255.255")){$webbot="e-Society";$boticon="robot_robot.png";}
	if(ip2long($oname)>=ip2long("64.29.176.0") && ip2long($oname)<=ip2long("64.29.191.255")){$webbot="Filangy";$boticon="robot_filangy.png";}
	if(ip2long($oname)>=ip2long("80.239.38.0") && ip2long($oname)<=ip2long("80.239.38.255")){$webbot="Findexa";$boticon="robot_findexa.png";}
	if(ip2long($oname)>=ip2long("64.210.192.0") && ip2long($oname)<=ip2long("64.210.255.255")){$webbot="Girafa";$boticon="robot_girafa.png";}
	if(ip2long($oname)>=ip2long("209.237.237.0") && ip2long($oname)<=ip2long("209.237.238.255")){$webbot="Alexa";$boticon="robot_alexa.png";}
	if(ip2long($oname)>=ip2long("87.218.0.0") && ip2long($oname)<=ip2long("87.218.255.254")){$webbot="Ipselon";$boticon="robot_ipselon.png";}
	if(ip2long($oname)>=ip2long("128.194.0.0") && ip2long($oname)<=ip2long("128.194.255.255")){$webbot="IRL crawler";$boticon="robot_robot.png";}
	if(ip2long($oname)>=ip2long("64.71.128.0") && ip2long($oname)<=ip2long("64.71.191.255")){$webbot="IRL crawler";$boticon="robot_krugle.png";}
	if(ip2long($oname)>=ip2long("82.131.195.0") && ip2long($oname)<=ip2long("82.131.195.255")){$webbot="Lapozz";$boticon="robot_lapozz.png";}
	if(ip2long($oname)>=ip2long("216.52.252.192") && ip2long($oname)<=ip2long("216.52.252.255")){$webbot="Local";$boticon="robot_local.png";}
	if(ip2long($oname)>=ip2long("64.242.88.0") && ip2long($oname)<=ip2long("64.242.88.255")){$webbot="Look Smart";$boticon="robot_looksmart.png";}
	if(ip2long($oname)>=ip2long("217.154.244.0") && ip2long($oname)<=ip2long("217.154.245.255")){$webbot="LOOP Improvements";$boticon="robot_mirago.png";}
	if(ip2long($oname)>=ip2long("213.251.136.0") && ip2long($oname)<=ip2long("213.251.143.255")){$webbot="Misterbot";$boticon="robot_misterbot.png";}
	if(ip2long($oname)>=ip2long("217.155.192.0") && ip2long($oname)<=ip2long("217.155.207.255")){$webbot="Mojeek";$boticon="robot_mojeek.png";}
	if(ip2long($oname)>=ip2long("220.72.0.0") && ip2long($oname)<=ip2long("220.87.255.255")){$webbot="Naver";$boticon="robot_naver.png";}
	if(ip2long($oname)>=ip2long("222.96.0.0") && ip2long($oname)<=ip2long("222.122.255.255")){$webbot="Naver";$boticon="robot_naver.png";}
	if(ip2long($oname)>=ip2long("67.104.0.0") && ip2long($oname)<=ip2long("67.111.255.255")){$webbot="Zoominfo";$boticon="robot_zoominfo.png";}
	if(ip2long($oname)>=ip2long("72.5.115.0") && ip2long($oname)<=ip2long("72.5.115.127")){$webbot="NimbleCrawler";$boticon="robot_nimblecrawler.png";}
	if(ip2long($oname)>=ip2long("194.224.199.0") && ip2long($oname)<=ip2long("194.224.199.25")){$webbot="noXtrum";$boticon="robot_noxtrum.png";}
	if(ip2long($oname)>=ip2long("84.9.136.0") && ip2long($oname)<=ip2long("84.9.139.255")){$webbot="Nusearch";$boticon="robot_nusearch.png";}
	if(ip2long($oname)>=ip2long("64.127.124.0") && ip2long($oname)<=ip2long("64.127.124.255")){$webbot="Omni-Explorer";$boticon="robot_robot.png";}
	if(ip2long($oname)>=ip2long("213.180.128.0") && ip2long($oname)<=ip2long("213.180.131.255")){$webbot="OnetSzukaj";$boticon="robot_onetszukaj.png";}
	if(ip2long($oname)>=ip2long("217.208.0.0") && ip2long($oname)<=ip2long("217.215.255.255")){$webbot="Picsearch";$boticon="robot_picsearch.png";}
	if(ip2long($oname)>=ip2long("81.19.64.0") && ip2long($oname)<=ip2long("81.19.66.255")){$webbot="StackRambler";$boticon="robot_stackrambler.png";}
	if(ip2long($oname)>=ip2long("66.151.181.0") && ip2long($oname)<=ip2long("66.151.181.255")){$webbot="Scirus";$boticon="robot_scirus.png";}
	if(ip2long($oname)>=ip2long("195.27.215.64") && ip2long($oname)<=ip2long("195.27.215.95")){$webbot="Seekport";$boticon="robot_robot.png";}
	if(ip2long($oname)>=ip2long("70.42.51.0") && ip2long($oname)<=ip2long("70.42.51.127")){$webbot="Sensis";$boticon="robot_sensis.png";}
	if(ip2long($oname)>=ip2long("38.0.0.0") && ip2long($oname)<=ip2long("38.255.255.255")){$webbot="Snap";$boticon="robot_snap.png";}
	if(ip2long($oname)>=ip2long("66.234.128.0") && ip2long($oname)<=ip2long("66.234.159.255")){$webbot="Snap";$boticon="robot_snap.png";}
	if(ip2long($oname)>=ip2long("81.208.26.0") && ip2long($oname)<=ip2long("81.208.26.63")){$webbot="Sygo";$boticon="robot_sygo.png";}
	if(ip2long($oname)>=ip2long("217.113.244.112") && ip2long($oname)<=ip2long("217.113.244.127")){$webbot="Ulysseek";$boticon="robot_ulysseek.png";}
	if(ip2long($oname)>=ip2long("193.252.148.0") && ip2long($oname)<=ip2long("193.252.148.255")){$webbot="Voila";$boticon="robot_voila.png";}
	if(ip2long($oname)>=ip2long("202.51.8.0") && ip2long($oname)<=ip2long("202.51.15.255")){$webbot="Wadaino";$boticon="robot_wadaino.png";}
	if(ip2long($oname)>=ip2long("64.13.128.0") && ip2long($oname)<=ip2long("64.13.191.255")){$webbot="Wink";$boticon="robot_wink.png";}
        if(ip2long($oname)>=ip2long("66.231.188.186") && ip2long($oname)<=ip2long("66.231.188.186")){$webbot="Gigablast";$boticon="robot_gigablast.png";}
        if(ip2long($oname)>=ip2long("62.113.137.5") && ip2long($oname)<=ip2long("62.113.137.5")){$webbot="Fast Search";$boticon="robot_fastsearch.png";}
        if(ip2long($oname)>=ip2long("65.214.44.29") && ip2long($oname)<=ip2long("65.214.44.29")){$webbot="Bloglines";$boticon="robot_bloglines.png";}
        if(ip2long($oname)>=ip2long("195.113.214.201") && ip2long($oname)<=ip2long("195.113.214.201")){$webbot="CESNET";$boticon="robot_robot.png";}

$guest = "<img src='".e_PLUGIN."aacgc_addons/images/robots/".$boticon."' alt='".$host."'></img>".$webbot."";

if($webbot == ""){
                    $guestip = $online_ip;
                    $tmp = explode(".", $guestip);
                    $guestip = $tmp[0].".".$tmp[1].".xx.xx";
$ogimg = "<img src='".e_PLUGIN."aacgc_addons/images/guest.png'></img>".$guestip."";}
else
{$ogimg = "".$guest."";}}
}






$online_location_page = eregi_replace(".php", "", substr(strrchr($online_location, "/"), 1));
                    if ($online_location_page == "log" || $online_location_page == "error")
                    {$online_location = "news.php";
                     $online_location_page = "news";} 
                    if ($online_location_page == "request")
                    {$online_location = "download.php";} 
                    if (strstr($online_location_page, "forum"))
                    {$online_location = "forum.php";
                     $online_location_page = "forum";} 


if ($pref['onlineaddon_enable_wide'] == "1"){

$onnow_text .= "".$oname." - <a href='".$online_location."'>".$online_location_page."</a> , ";}

else

{$onnow_text .= "<tr>
                 <td class='indent'>".$ogimg."</td>
                 <td class='indent'><a href='".$online_location."'>".$online_location_page."</a></td>
                 </tr>";}}}

if ($pref['onlineaddon_enable_wide'] == "1"){
$onnow_text .= "</td></tr></table>";}

else

{$onnow_text .= "</table>";}}




//-----------------------------------#Last Seen#-------------------------------------------------------------+


if ($pref['onlineaddon_enable_lastseen'] == "1"){

$onnow_text .= "<table style='width:100%' class=''><tr>";

$onnow_text .= "<tr><td class='fcaption' colspan=2 onclick='memlist' style='cursor:hand'><center>Last ".$pref['onlineaddon_lastseencount']." Seen:</center></td></tr>";

$sql -> db_Select("user", "*", "ORDER BY user_currentvisit DESC LIMIT 0,".$pref['onlineaddon_lastseencount']."", "nowhere");
$userArray = $sql -> db_getList();
$gen = new convert;
foreach($userArray as $user)
{
if ($pref['forumaddon_enable_gold'] == "1"){
$userorblast = "<font color='#00FF00'>".$gold_obj->show_orb($user['user_id'])."</font>";}
else
{$userorblast = "".$user['user_name']."";}

if ($pref['onlineaddon_enable_avatar'] == "1"){
if ($user['user_image'] == "")
//{$lastavatar = "<img src='".e_PLUGIN."aacgc_addons/images/default.png' width='30px'></img>";}
{$lastavatar = "";}
else
{$useravatar = $user[user_image];
require_once(e_HANDLER."avatar_handler.php");
$useravatar = avatar($useravatar);
$lastavatar = "<img src='".$useravatar."' width='30px'></img>";}}



//extract($user);
$seen_ago = $gen -> computeLapse($user['user_currentvisit'], false, false, true, 'short');
$lastseen = ($seen_ago ? $seen_ago : "1 ".LANDT_09)." ".LANDT_AGO; 



$onnow_text .= "<tr><td style='width:50%' class='indent'><a href='".e_BASE."user.php?id.".$user['user_id']."'>".$lastavatar." ".$userorblast." </a></td>
                  <td style='width:50%' class='indent'>[".$lastseen."]</td></tr>";}


$onnow_text .= "</tr></table>";

}




//-----------------------------------#Total Logged In Today#-------------------------------------------------+

if ($pref['onlineaddon_memberstoday'] == "1"){

$membersfound="";
$c = 0;
$script="SELECT user_id, user_name, user_currentvisit,user_class,user_admin FROM ".MPREFIX."user WHERE DATEDIFF(FROM_UNIXTIME(user_currentvisit),CURRENT_TIMESTAMP()) = 0 ORDER BY user_currentvisit DESC";
$sql -> db_Select_gen($script);
$userArray = $sql -> db_getList();
$gen = new convert;	
foreach($userArray as $user)
{$seen_ago = $gen -> computeLapse($user['user_currentvisit'], false, false, true, 'short');
$c++;}
$memberstoday= $c;
for ($a = 0; $a <= ($c-1); $a++)
{$membersfound.=$u[$a];
$membersfound.= ($a < $c-1 ) ? "" : "";
$memberstoday .= "".$membersfound."";}
}


$onnow_text .= "<table style='width:100%' class=''><tr>";


if ($pref['onlineaddon_memberstoday'] == "1"){
$onnow_text .= "<tr><td class='fcaption' colspan=2><center>Members On Today: ".$memberstoday."</center></td></tr>";}


if ($pref['onlineaddon_memberlist'] == "1"){

$lastseen_admincolour=$pref['onlineinfo_admincolour'];
$lastseen_memcolour= "#00FF00";
$lastseen_modcolour=$pref['onlineinfo_modcolour'];
$admincol=$pref['onlineinfo_admincolour'];
$modcol=$pref['onlineinfo_modcolour'];
$memcol=$pref['onlineinfo_memcolour'];
$membersfound="";
$c = 0;
$script="SELECT user_id, user_name, user_currentvisit,user_class,user_admin FROM ".MPREFIX."user WHERE DATEDIFF(FROM_UNIXTIME(user_currentvisit),CURRENT_TIMESTAMP()) = 0 ORDER BY user_currentvisit DESC";
$sql -> db_Select_gen($script);
$userArray = $sql -> db_getList();
$gen = new convert;	
foreach($userArray as $user)
{
//USER_LASTVISIT_LAPSE
$seen_ago = $gen -> computeLapse($user['user_currentvisit'], false, false, true, 'short');
//$seen_ago = explode("days, ",$seen_ago);
$usermodr=0;
unset($userc);
$userc= explode(",",$user['user_class']);	
$user_id=$user['user_id'];
$user_name=$user['user_name'];
$user_admin=$user['user_admin'];	
for($z = 0; $z<=count($userc); $z++ ) {
$script="SELECT forum_moderators FROM ".MPREFIX."forum WHERE forum_parent <> '0' GROUP BY forum_moderators";
$fmod_sql = new db;
$fmod = $fmod_sql->db_Select_gen($script);
while ($row2 = $fmod_sql->db_Fetch())
{if($userc[$z]==$row2[0]){$usermodr=1;}}}		


if ($pref['forumaddon_enable_gold'] == "1"){
$gold_obj = new gold();
$gold_obj->show_orb($user['user_id']);
$username = "".$gold_obj->show_orb($user['user_id'])."";}
else
{$username = "".$user_name."";}

if($user_admin==1){$u[$c]="<b><a href='".e_BASE."user.php?id.".$user_id."' style='color:".$lastseen_admincolour.";' title='".$seen_ago."'>".$username." </a></b>";}
if($usermodr==1 && $user_admin<>1){$u[$c]="<b><a href='".e_BASE."user.php?id.".$user_id."' style='color:".$lastseen_modcolour.";' title='".$seen_ago."'>".$username." </a></b>";}
if($usermodr==0 && $user_admin<>1){$u[$c]="<a href='".e_BASE."user.php?id.".$user_id."' style='color:".$lastseen_memcolour.";' title='".$seen_ago."'>".$username." </a>";}
$usermodr=0;
$c++;}
$memberstoday= $c;
for ($a = 0; $a <= ($c-1); $a++)
{$membersfound.=$u[$a];
$membersfound.= ($a < $c-1 ) ? "    ,     " : "";}




if ($pref['onlineaddon_enable_globe'] == "1"){
$col = "1";
$globecode = "".$pref['onlineaddon_globe_code']."";

if ($pref['onlineaddon_globesize'] == "100"){
$dmap = "
<script type='text/javascript' src='http://www.revolvermaps.com/re/js.php?m=7&amp;s=100&amp;i=".$globecode."&amp;col=ff0000&amp;wid=rm0'></script>
";
}
else if ($pref['onlineaddon_globesize'] == "150"){
$dmap = "
<script type='text/javascript' src='http://www.revolvermaps.com/re/js.php?m=7&amp;s=150&amp;i=".$globecode."&amp;col=ff0000&amp;wid=rm0'></script>
";
}
else if ($pref['onlineaddon_globesize'] == "200"){
$dmap = "
<script type='text/javascript' src='http://www.revolvermaps.com/re/js.php?m=7&amp;s=200&amp;i=".$globecode."&amp;col=ff0000&amp;wid=rm0'></script>
";
}
else if ($pref['onlineaddon_globesize'] == "250"){
$dmap = "
<script type='text/javascript' src='http://www.revolvermaps.com/re/js.php?m=7&amp;s=250&amp;i=".$globecode."&amp;col=ff0000&amp;wid=rm0'></script>
";
}
else if ($pref['onlineaddon_globesize'] == "300"){
$dmap = "
<script type='text/javascript' src='http://www.revolvermaps.com/re/js.php?m=7&amp;s=300&amp;i=".$globecode."&amp;col=ff0000&amp;wid=rm0'></script>
";
}
else if ($pref['onlineaddon_globesize'] == "180s"){
$dmap = "
<script type='text/javascript' src='http://www.revolvermaps.com/re/rm.js'></script>
<script type='text/javascript'>rm_f1st('7','180','true','false','000000','".$globecode."','true','true','ff0000');</script>
<noscript><applet codebase='http://www.revolvermaps.com/re' code='core.RevolverEngine' width='180' height='180' archive='re.jar'>
<param name='cabbase' value='re.cab' />
<param name='recenthits' value='true' />
<param name='nostars' value='false' />
<param name='i' value='".$globecode."' />
<param name='m' value='7' />
<param name='size' value='180' />
<param name='color' value='ff0000' />
<param name='counter' value='true' />
<param name='bg' value='000000' />
<param name='flags' value='true' />
</applet></noscript>";
}
else if ($pref['onlineaddon_globesize'] == "200s"){
$dmap = "
<script type='text/javascript' src='http://www.revolvermaps.com/re/rm.js'></script>
<script type='text/javascript'>rm_f1st('0','200','true','false','000000','".$globecode."','true','true','ff0000');</script>
<noscript><applet codebase='http://www.revolvermaps.com/re' code='core.RevolverEngine' width='200' height='200' archive='re.jar'>
<param name='cabbase' value='re.cab' />
<param name='recenthits' value='true' />
<param name='nostars' value='false' />
<param name='i' value='".$globecode."' />
<param name='m' value='0' />
<param name='size' value='200' />
<param name='color' value='ff0000' />
<param name='counter' value='true' />
<param name='bg' value='000000' />
<param name='flags' value='true' />
</applet></noscript>
";}
}
else
{
$col = "2";
$dmap = "";
}


$onnow_text .= "<td colspan=".$col." class='indent' style='width:100%'>
               ".$membersfound."
               </td>";

if ($pref['onlineaddon_enable_globe'] == "1"){
$onnow_text .= "<td class='indent'>".$dmap."</td>";}

$onnow_text .= "</tr>";}



//-----------------------------------#Total Members#---------------------------------------------------------+
if ($pref['onlineaddon_totalmembers'] == "1"){

$members = $sql -> db_Count("user");

$onnow_text .= "<tr><td class='fcaption' colspan=2><center>Total Members: ".$members."</center></td></tr>";}


$onnow_text .= "</table>";


//-----------------------------------#Newest Members#--------------------------------------------------------+

if ($pref['onlineaddon_enable_newest'] == "1"){

$onnow_text .= "<table style='width:100%' class=''><tr>
                <td class='fcaption' colspan=".$pref['onlineaddon_newmembercolcount']."><center>".$pref['onlineaddon_newmembercount']." Newest Members:</td>
                </tr>
                <tr>";



                $sqlnewm = new db;
                $sqlnewm->db_Select("user", "*", "ORDER BY user_id DESC LIMIT 0,".$pref['onlineaddon_newmembercount']."", "");
$rows = $sqlnewm->db_Rows();
$pcol = 1;
for ($i = 0; $i < $rows; $i++){
                while($new = $sqlnewm->db_Fetch()){



if ($pref['forumaddon_enable_gold'] == "1")
{$newuserorb = "<font color='#00FF00'>".$gold_obj->show_orb($new['user_id'])."</font>";}
else
{$newuserorb = "".$new['user_name']."";}


$onnow_text .= "<td style='width:20%' class='indent'><a href='".e_BASE."user.php?id.".$new['user_id']."'>".$newuserorb."</a></td>";

if ($pcol == $pref['onlineaddon_newmembercolcount']) 
{$onnow_text .= "</tr><tr>";
$pcol = 1;}
else
{$pcol++;}}}



$onnow_text .= "</tr>";}


$onnow_text .= "</table>";

//--------------------------------------------------------------------------------------------------+

$ns->tablerender($onnow_title, $onnow_text);




?>

