<?php

if (!defined('e107_INIT')) { exit; }

global $tp;
$gen = new convert;


$max_age = varset($menu_pref['newforumposts_maxage'],0);
$max_age = $max_age == 0 ? '' : "(t.thread_datestamp > ".intval(time()-$max_age*86400).") AND ";
$query2 = "
SELECT tp.thread_name AS parent_name, 
t.thread_datestamp , t.thread_thread, t.thread_name, t.thread_id, t.thread_user, 
f.forum_id, f.forum_name, f.forum_class, u.user_name, u.user_id, u.user_image,  fp.forum_class FROM #forum_t AS t 
LEFT JOIN #user AS u ON t.thread_user = u.user_id
LEFT JOIN #forum_t AS tp ON t.thread_parent = tp.thread_id
LEFT JOIN #forum AS f ON (f.forum_id = t.thread_forum_id AND f.forum_class IN (".USERCLASS_LIST."))
LEFT JOIN #forum AS fp ON f.forum_parent = fp.forum_id
WHERE {$max_age} fp.forum_class IN (".USERCLASS_LIST.")
ORDER BY t.thread_datestamp DESC LIMIT 0,".$pref['lfpmenu_count']."";

$results = $sql->db_Select_gen($query2);



$lfp_text .= "

<script type=\"text/javascript\">
function faddonup(){faddon.direction = \"up\";}
function faddondown(){faddon.direction = \"down\";}
function faddonstop(){faddon.stop();}
function faddonstart(){faddon.start();}
</script>

<marquee height='".$pref['lfpmenu_height']."px' id='faddon' scrollamount='".$pref['lfpmenu_speedstart']."' onMouseover='this.scrollAmount=".$pref['lfpmenu_speedon']."' onMouseout='this.scrollAmount=".$pref['lfpmenu_speedoff']."' direction='up' loop='true'>
<table style='width:100%' class='fcaption' cellspacing='1' cellpadding='1'>
";



	$forumArray = $sql->db_getList();
	foreach($forumArray as $fi)
	{
	$datestamp = $gen->convert_date($fi['thread_datestamp'], "short");
	$topic = ($fi['parent_name'] ? "Re: <i>{$fi['parent_name']}</i>" : "<i>{$fi['thread_name']}</i>");
	$topic = strip_tags($tp->toHTML($topic, TRUE, "emotes_off, no_make_clickable, parse_bb", "", $pref['menu_wordwrap']));
	$id = $fi['thread_id'];
	if($fi['user_name'])
       {

if ($pref['addon_enable_avatar'] == "1"){
if ($fi['user_image'] == "")
{$avatar = "";}
else
{$useravatar = $fi[user_image];
require_once(e_HANDLER."avatar_handler.php");
$useravatar = avatar($useravatar);
$avatar = "<img src='".$useravatar."' width=".$pref['addon_avatar_size']."px></img>";}}

if ($pref['forumaddon_enable_gold'] == "1"){
$gold_obj = new gold();
$posterorb = "<font color='#00FF00'>".$gold_obj->show_orb($fi['user_id'])."</font>";}
else
{$posterorb = $fi['user_name'];}

        $fi['thread_thread'] = strip_tags($tp->toHTML($fi['thread_thread'], TRUE, "", "emotes_off, no_make_clickable", $pref['menu_wordwrap']));
	$fi['thread_thread'] = $tp->text_truncate($fi['thread_thread'], $menu_pref['newforumposts_characters'], $menu_pref['newforumposts_postfix']);


$lfp_text .= "<tr>
              <td style='width:20%' class='indent'>
              ".$avatar." ".$posterorb." (<font color='#".$pref['forumaddon_fdatecolor']."'>".$datestamp."</font>) <a href='".e_PLUGIN."forum/forum_viewtopic.php?{$id}.post'><font color='#".$pref['forumaddon_fthreadcolor']."' size='2'>".$topic."</font></a><br>
              <font color='#".$pref['forumaddon_fpostcolor']."'>".$fi['thread_thread']."</td>
              </tr>";}}


$lfp_text .= "</table></marquee>

<br><br>
<table style='width:100%' class=''><tr><td>
<center>
<input class=\"button\" value=\"Start\" onClick=\"faddonstart();\" type=\"button\">
<input class=\"button\" value=\"Stop\" onClick=\"faddonstop();\" type=\"button\">
<input class=\"button\" value=\"Up\" onClick=\"faddonup();\" type=\"button\">
<input class=\"button\" value=\"Down\" onClick=\"faddondown();\" type=\"button\">
</center>
</td></tr></table>
<br>
";



$lfp_title = "Last ".$pref['lfpmenu_count']." Forum Posts";



$ns->tablerender($lfp_title, $lfp_text);

?>
