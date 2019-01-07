<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Event Countdowns          #    
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/

require_once("../../class2.php");
if (!getperms("P"))
{
    header("location:" . e_HTTP . "index.php");
    exit;
} 
require_once(e_ADMIN . "auth.php");
require_once(e_HANDLER . "userclass_class.php");
include_lan(e_PLUGIN."aacgc_eventcountdowns/languages/".e_LANGUAGE.".php");

if (isset($_POST['update']))
{ 
    $pref['ecds_pagetitle'] = $tp->toDB($_POST['ecds_pagetitle']);
    $pref['ecds_menutitle'] = $tp->toDB($_POST['ecds_menutitle']);
    $pref['ecds_header'] = $tp->toDB($_POST['ecds_header']);
    $pref['ecds_menuheight'] = $tp->toDB($_POST['ecds_menuheight']);
    $pref['ecds_maxevents'] = $tp->toDB($_POST['ecds_maxevents']);
    $pref['ecds_dateoffset'] = $tp->toDB($_POST['ecds_dateoffset']);
    $pref['ecds_dateformat'] = $tp->toDB($_POST['ecds_dateformat']);
    $pref['ecds_countersize'] = $tp->toDB($_POST['ecds_countersize']);
    $pref['ecds_countercolor'] = $tp->toDB($_POST['ecds_countercolor']);


if (isset($_POST['ecds_theme'])) 
{$pref['ecds_theme'] = 1;}
else
{$pref['ecds_theme'] = 0;}

if (isset($_POST['ecds_showfuturemenu'])) 
{$pref['ecds_showfuturemenu'] = 1;}
else
{$pref['ecds_showfuturemenu'] = 0;}

if (isset($_POST['ecds_showfuturepage'])) 
{$pref['ecds_showfuturepage'] = 1;}
else
{$pref['ecds_showfuturepage'] = 0;}

    save_prefs();

$text .= "".ACR_14."";

}
//-------------------------# BB Code Support #----------------------------------------------
include(e_HANDLER."ren_help.php");
//------------------------------------------------------------------------------------------

$offset = $pref['ecds_dateoffset'];
$settime = time() + ($offset * 60);
$fixeddate = $settime;

$text .= "<form method='post' action='".e_SELF."' id='conslform'>
<table class='fborder' width='100%'>
<tr>
<td style='width:30%' class='forumheader3' colspan='2'><b>".ACR_02."</b></td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'><b>".ACR_18.":</b></td>
<td colspan=2 class='forumheader3'>".($pref['ecds_theme'] == 1 ? "<input type='checkbox' name='ecds_theme' value='1' checked='checked' />" : "<input type='checkbox' name='ecds_theme' value='0' />")."</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'><b>".ACR_20.":</b><br/><a href='http://php.net/manual/en/function.date.php' target='_blank'>".ACR_29."</a></td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='15' name='ecds_dateformat' value='" . $pref['ecds_dateformat'] . "' /> ".ACR_09.": ".date($pref['ecds_dateformat'], $fixeddate)."</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'><b>".ACR_19.":</b></td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='15' name='ecds_dateoffset' value='" . $pref['ecds_dateoffset'] . "' /> ".ACR_09.": ".date($pref['ecds_dateformat'], $fixeddate)."</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'><b>".ACR_32.":</b></td>
<td style='width:70%' class='forumheader3'>
<select name='ecds_countersize'>
<option name='ecds_countersize' value='".$pref['ecds_countersize']."' />".$pref['ecds_countersize']."</option>
<option name='ecds_countersize' value='10' />10</option>
<option name='ecds_countersize' value='11' />11</option>
<option name='ecds_countersize' value='12' />12</option>
<option name='ecds_countersize' value='13' />13</option>
<option name='ecds_countersize' value='14' />14</option>
<option name='ecds_countersize' value='15' />15</option>
</select>
</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'><b>".ACR_33.":</b></td>
<td style='width:70%' class='forumheader3'>
<select name='ecds_countercolor'>
<option name='ecds_countercolor' value='".$pref['ecds_countercolor']."' />".$pref['ecds_countercolor']."</option>
<option name='ecds_countercolor' value='white' />white</option>
<option name='ecds_countercolor' value='black' />black</option>
<option name='ecds_countercolor' value='red' />red</option>
<option name='ecds_countercolor' value='blue' />blue</option>
<option name='ecds_countercolor' value='yellow' />yellow</option>
<option name='ecds_countercolor' value='green' />green</option>
</select>
</td>
</tr>


<tr>
<td style='width:30%' class='forumheader3'><b>".ACR_15.":</b></td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='50' name='ecds_pagetitle' value='" . $pref['ecds_pagetitle'] . "' /></td>
</tr>
<tr>
        <td style='width:' class='forumheader3'>".ACR_17.":</td>
        <td style='width:' class='forumheader3'>
	    <textarea class='tbox' rows='5' cols='100' name='ecds_header' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>".$pref['ecds_header']."</textarea><br>";

$text .= display_help('helpb', 'forum');

$text .= "
		</td> 
</tr>
<tr>
<td style='width:30%' class='forumheader3'><b>".ACR_30.":</b></td>
<td colspan=2 class='forumheader3'>".($pref['ecds_showfuturepage'] == 1 ? "<input type='checkbox' name='ecds_showfuturepage' value='1' checked='checked' />" : "<input type='checkbox' name='ecds_showfuturepage' value='0' />")."</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'><b>".ACR_16.":</b></td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='50' name='ecds_menutitle' value='" . $pref['ecds_menutitle'] . "' /></td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'><b>".ACR_24.":</b></td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='15' name='ecds_menuheight' value='" . $pref['ecds_menuheight'] . "' /> (".ACR_25.")</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'><b>".ACR_31.":</b></td>
<td colspan=2 class='forumheader3'>".($pref['ecds_showfuturemenu'] == 1 ? "<input type='checkbox' name='ecds_showfuturemenu' value='1' checked='checked' />" : "<input type='checkbox' name='ecds_showfuturemenu' value='0' />")."</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'><b>".ACR_26.":</b></td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='5' name='ecds_maxevents' value='" . $pref['ecds_maxevents'] . "' /> (".ACR_27.")</td>
</tr>

	<tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='".$themea."'>
        <input type='submit' name='update' value='".ACR_21."' class='button' />
        </td>
    </tr>

</table></form>";

//------------------------------------------------------------------------------------

$ns->tablerender("AACGC Event Countdowns(".ACR_02.")", $text);
require_once(e_ADMIN . "footer.php");

?>