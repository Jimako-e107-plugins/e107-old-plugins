<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        Online Info Menu v3.0 for e107 v0.616 by TheMadMonk
|              TheMadMonk@GamingMad.com
|
|      Released under the terms and conditions of the
|      GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }
$text = '';

$text.="<script type='text/javascript' src='".e_PLUGIN."onlineinfo_menu/switchcontent.js'></script>";

$lan_file = e_PLUGIN."onlineinfo_menu/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."onlineinfo_menu/languages/English.php");

include_once(e_PLUGIN."onlineinfo_menu/functions.php");


$text.= '<style rel="stylesheet" type="text/css">

#onlineinfodhtmltooltip{
position: absolute;
width: 100px;
border: 2px solid '.$pref['onlineinfo_border'].';
padding: 2px;
background-color: '.$pref['onlineinfo_color'].';
visibility: hidden;
z-index: 100;
}

</style>
<div id="onlineinfodhtmltooltip"></div>
<script type="text/javascript" src="'.e_PLUGIN.'onlineinfo_menu/online.js"></script>';


$onlineinfomenuwidth=$pref['onlineinfo_width'];
$onlineinfomenucolour=$pref['onlineinfo_flashtext_colour'];
$onlineinfomenufsize=$pref['onlineinfo_fontsize'];

$text.='
<script type="text/javascript">
var flashlinks=new Array()
function changelinkcolor(){
for (i=0; i< flashlinks.length; i++){
var flashtype=document.getElementById? flashlinks[i].getAttribute("flashtype")*1 : flashlinks[i].flashtype*1
var flashcolor=document.getElementById? flashlinks[i].getAttribute("flashcolor") : flashlinks[i].flashcolor
if (flashtype==0){
if (flashlinks[i].style.color!=flashcolor)
flashlinks[i].style.color=flashcolor
else
flashlinks[i].style.color=""
}
else if (flashtype==1){
if (flashlinks[i].style.backgroundColor!=flashcolor)
flashlinks[i].style.backgroundColor=flashcolor
else
flashlinks[i].style.backgroundColor=""
}
}
}

function init(){
var i=0
if (document.all){
while (eval("document.all.flashlink"+i)!=null){
flashlinks[i]= eval("document.all.flashlink"+i)
i++
}
}
else if (document.getElementById){
while (document.getElementById("flashlink"+i)!=null){
flashlinks[i]= document.getElementById("flashlink"+i)
i++
}
}
setInterval("changelinkcolor()", 500)
}

if (window.addEventListener)
window.addEventListener("load", init, false)
else if (window.attachEvent)
window.attachEvent("onload", init)
else if (document.all)
window.onload=init

</script>
';

$n=0;
$suspended=0;



$script="SELECT * from ".MPREFIX."onlineinfo_suspend WHERE user_id=".USERID." ORDER BY user_name";
$data = $sql->db_Select_gen($script);
if ($data)
    {
	$text.='<script language="javascript" type="text/javascript"> window.location="'.e_BASE.'index.php?logout"; </script>';
	}


 $script="SELECT * from ".MPREFIX."onlineinfo_suspend WHERE ip='".$_SERVER['REMOTE_ADDR']."' ORDER BY user_name";
 $data = $sql->db_Select_gen($script);
 if ($data)
     {
    $caption = ONLINEINFO_LOGIN_MENU_L83;
	$text.="<div id='flashlink".$n."' flashtype=0 flashcolor='".$onlineinfomenucolour."' style='font-size: 14px; text-align:center; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;'><br />".ONLINEINFO_LOGIN_MENU_L83."<br /><br /></div>";
	$text.="<div style='font-size: 12px; text-align:left; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;'>".ONLINEINFO_LOGIN_MENU_L84."<br /><br /></div>";
	$suspended=1;
$n++;

 	}


if ($suspended==0){

global $eMenuActive, $e107, $tp, $use_imagecode;
require_once(e_PLUGIN."onlineinfo_menu/login_menu_shortcodes.php");
$ip = $e107->getip();

$bullet = (defined("BULLET") ? "<img src='".THEME_ABS."images/".BULLET."' alt='' style='vertical-align: middle;' />" : "<img src='".THEME_ABS."images/bullet2.gif' alt='bullet' style='vertical-align: middle;' />");

if (defined('CORRUPT_COOKIE') && CORRUPT_COOKIE == TRUE) {
	$text = "<div style='text-align:center'>".LOGIN_MENU_L7."<br /><br />
	".$bullet." <a href='".e_BASE."index.php?logout'>".LOGIN_MENU_L8."</a></div>";
	$ns->tablerender(LOGIN_MENU_L9, $text, 'login');
}
$use_imagecode = ($pref['logcode'] && extension_loaded('gd'));

if ($use_imagecode) {
	global $sec_img;
	include_once(e_HANDLER.'secure_img_handler.php');
	$sec_img = new secure_image;
}
$text .= "";

if ($pref['onlineinfo_caption'] == "[Welcome User]")
{
    $caption = ONLINEINFO_LOGIN_MENU_L5 . "&nbsp;".USERNAME;
}
else
{
    $caption = $pref['onlineinfo_caption'];
}



if (USER == true || ADMIN == true)

{

	if($pref['onlineinfo_ibfpm']==0){


		$sql=new db;
		$script="SELECT cache_userclass FROM ".MPREFIX."onlineinfo_cache Where type='order' and cache_name='ONLINEINFO_CACHEINFO_12'";		
		$onlineinfoorder = $sql->db_Select_gen($script);		
		while ($row = $sql->db_Fetch()){
		 $cacheuserclass=$row['cache_userclass'];
		 }

	if(check_class($cacheuserclass)){


	$pm_user = USERID;
	$unreadpms = $sql -> db_Count("private_msg", "(*)", "WHERE pm_to=$pm_user AND pm_read_del=0 and pm_read=0");

	$pmpath=e_PLUGIN."pm/pm.php?inbox";

	}
	}else{

	$onlineinfo_ipb_sql = new db;

	$script="SELECT * FROM ".$pref['onlineinfo_ibfprefix']."message_topics WHERE mt_read=0 AND mt_to_id = ".USERID;
	$onlineinfo_getipbinboxunread = $onlineinfo_ipb_sql->db_Select_gen($script);

	$unreadpms=$onlineinfo_getipbinboxunread;

	$pmpath=SITEURL.$pref['onlineinfo_ibflocation']."/index.php?act=Msg&CODE=01&VID=in";

	}



if($pref['onlineinfo_showpmmsg']==1){

	if($unreadpms<>0)
	{
if($pref['onlineinfo_sound']!="none" || $pref['onlineinfo_sound']!=""){
	
	$checkpath = explode("/pm/",e_SELF);
	
	if($checkpath[1] != "pm.php"){
		
		
		
	
	
	$text.="<embed src=\"".e_PLUGIN."onlineinfo_menu/sounds/".$pref['onlineinfo_sound']."\" autostart=\"true\" loop=\"0\" hidden=\"true\"></embed>";
	
		}
}
	$text.="<div style='font-size: 14px; text-align:center; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;'><br /><a id='flashlink".$n."' flashtype=0 flashcolor='".$onlineinfomenucolour."' href='".$pmpath."' title='".ONLINEINFO_LOGIN_MENU_L82."' style='text-decoration: none;'>".ONLINEINFO_LOGIN_MENU_L81."</a><br /><br /></div>";

	$n++;

	}

}

        list($uid, $upw) = ($_COOKIE[$pref['cookie_name']] ? explode(".", $_COOKIE[$pref['cookie_name']]) : explode(".", $_SESSION[$pref['cookie_name']]));



		$ordersql=new db;
		$script="SELECT * FROM ".MPREFIX."onlineinfo_cache Where type='order' ORDER BY type_order";		
		$onlineinfoorder = $ordersql->db_Select_gen($script);
		
		
		while ($orderrow = $ordersql->db_Fetch()){
		 
		 $orderhide=$orderrow['cache_hide'];
		 $orderclass=$orderrow['cache_userclass'];
		 		 
		 require_once(e_PLUGIN."onlineinfo_menu/".$orderrow['cache']);	
		 	 
		}


}
else
{

if ($pref['onlineinfo_logindiag']==0){

if (!$LOGIN_MENU_FORM) {
		if (file_exists(THEME."login_menu_template.php")){
	   		require_once(THEME."login_menu_template.php");
		}else{
			require_once(e_PLUGIN."onlineinfo_menu/login_menu_template.php");
		}
	}

	if (LOGINMESSAGE != '') {
		$text = '<div style="text-align: center;">'.LOGINMESSAGE.'</div>';
	}

	$text .= '<form method="post" action="'.e_SELF.(e_QUERY ? '?'.e_QUERY : '').'">';
	$text .= $tp->parseTemplate($LOGIN_MENU_FORM, true, $login_menu_shortcodes);
	$text .= '</form>';

	if (file_exists(THEME.'images/login_menu.png')) {
		$caption = '<img src="'.THEME_ABS.'images/login_menu.png" alt="" />'.LOGIN_MENU_L5;
	} else {
		$caption = LOGIN_MENU_L5;
	}

  
        }
        
        
        $caption = ONLINEINFO_LOGIN_MENU_L46;
        
        
      
        
        
        

        if ((MEMBERS_ONLINE + GUESTS_ONLINE) > ($pref['most_members_online'] + $pref['most_guests_online']))
        {
            $pref['most_members_online'] = MEMBERS_ONLINE;
            $pref['most_guests_online'] = GUESTS_ONLINE;
            $pref['most_online_datestamp'] = time();
			
			save_prefs();

        }


		$ordersql=new db;
		$script="SELECT * FROM ".MPREFIX."onlineinfo_cache Where type='order' ORDER BY type_order";		
		$onlineinfoorder = $ordersql->db_Select_gen($script);
		
		
		while ($orderrow = $ordersql->db_Fetch()){
		 
		 $orderhide=$orderrow['cache_hide'];
		 $orderclass=$orderrow['cache_userclass'];
		 		 
		 require_once(e_PLUGIN."onlineinfo_menu/".$orderrow['cache']);	
		 	 
		}


    }
    
   
 $text.=colourkey(1);   
    

$text.="
        <script type='text/javascript'>
		var showhide=new switchcontent('switchgroup1', 'div') //Limit scanning of switch contents to just div elements
		showhide.setStatus('<img src=\"".e_PLUGIN."onlineinfo_menu/images/minus.gif\" width=\"11px\" alt=\"\" /> ', '<img src=\"".e_PLUGIN."onlineinfo_menu/images/plus.gif\" width=\"11px\" alt=\"\" /> ')
		// showhide.setColor('#FFFFFF','#EAAE10')
		showhide.collapsePrevious(false) //Allow more than 1 content to be open simultanously
		showhide.setPersist(".$pref['onlineinfo_rememberbuttons'].")
		showhide.init()
</script>";

}


$ns->tablerender($caption, $text);


?>