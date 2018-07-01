<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        ../plugins/Messenger_Status_Menu/Messenger_Status_Menu.php
|
|        Origional script by ©Steve Dunstan 2001-2002
|
|        http://e107.org
|        jalist@e107.org
|
|        11/08/05: Modified by Dave Toombs (Taffman) to revise server url's
|        as origional URL's no longer valid.
|        Added Jabber IM link
|
|        25/12/06: Modified by Lars Langenbach (Jedi) to get a real plugin
|        where preferences can be set in admin area.
|        Added Skype IM link
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+



*/

$text = "";

if ($menu_pref['messenger_status_yahoo'] != "")
{
    $text .= "<a href='ymsgr:sendIM?".$menu_pref['messenger_status_yahoo']."'><img src='".$menu_pref['messenger_status_server']."yahoo/".$menu_pref['messenger_status_yahoo']."' align='absmiddle' border='0' ALT='Yahoo Online Status Indicator'></a> Yahoo 
<br>";
}

if ($menu_pref['messenger_status_msn'] != "")
{
    $text .= "<A HREF='msnim:chat?contact=".$menu_pref['messenger_status_msn']."'><IMG SRC='".$menu_pref['messenger_status_server']."msn/".$menu_pref['messenger_status_msn']."' align='absmiddle' border='0' ALT='MSN Online Status Indicator'></a> MSN
<br>";
}

if ($menu_pref['messenger_status_icq'] != "")
{
    $text .= "<A target='_blank' HREF='http://public.icq.com/public/panels/respondpanel/links/message.html?".$menu_pref['messenger_status_icq']."'><IMG SRC='".$menu_pref['messenger_status_server']."icq/".$menu_pref['messenger_status_icq']."' align='absmiddle' border='0' ALT='ICQ Online Status Indicator'></a> ICQ
<br>";
}

if ($menu_pref['messenger_status_aim'] != "")
{
    $text .= "<A HREF='aim:goim?screenname=".$menu_pref['messenger_status_aim']."'><IMG SRC='".$menu_pref['messenger_status_server']."aim/".$menu_pref['messenger_status_aim']."' align='absmiddle' border='0' ALT='AIM Online Status Indicator'></a> AIM
<br>";
}

if ($menu_pref['messenger_status_skype'] != "")
{
    $text .= "<A HREF='skype:".$menu_pref['messenger_status_skype']."?chat'><IMG SRC='".$menu_pref['messenger_status_server']."skype/".$menu_pref['messenger_status_skype']."' align='absmiddle' border='0' ALT='Skype Online Status Indicator'></a> Skype
<br>";
}

if ($menu_pref['messenger_status_jabber'] != "")
{
    $text .= "<A HREF='xmpp:".$menu_pref['messenger_status_jabber']."'><IMG SRC='".$menu_pref['messenger_status_server']."jabber/".$menu_pref['messenger_status_jabber']."' align='absmiddle' border='0' ALT='Jabber Online Status Indicator'></a> Jabber
";
}

$aj = new textparse;
$caption = $aj -> tpa($caption, "on");
$text = $aj -> tpa($text, "on","admin");
$ns->tablerender($menu_pref['messenger_status_caption'], $text);
?>
