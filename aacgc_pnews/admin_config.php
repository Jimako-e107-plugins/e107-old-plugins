<?php


/*
##########################
# AACGC Public News      #
# M@CH!N3                #
# www.aacgc.com          #
# admin@aacgc.com        #
##########################
*/



require_once("../../class2.php");
if (!defined('e107_INIT'))
{exit;}
if (!getperms("P"))
{header("location:" . e_HTTP . "index.php");
exit;}
require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{define(ADMIN_WIDTH, "width:100%;");}

include_lan(e_PLUGIN."aacgc_pnews/languages/".e_LANGUAGE.".php");

if (e_QUERY == "update")
{
    $pref['pnews_cat_header'] = $_POST['pnews_cat_header'];
    $pref['pnews_cat_intro'] = $_POST['pnews_cat_intro'];
    $pref['pnews_cat_headerfsize'] = $_POST['pnews_cat_headerfsize'];
    $pref['pnews_cat_introfsize'] = $_POST['pnews_cat_introfsize'];
    $pref['pnews_cat_catfsize'] = $_POST['pnews_cat_catfsize'];
    $pref['pnews_cat_newstfsize'] = $_POST['pnews_cat_newstfsize'];
    $pref['pnews_cat_newsimgsize'] = $_POST['pnews_cat_newsimgsize'];
    $pref['pnews_cat_newsimgratio'] = $_POST['pnews_cat_newsimgratio'];
    $pref['pnews_cat_newsdesclimit'] = $_POST['pnews_cat_newsdesclimit'];
    $pref['pnews_cat_newscount'] = $_POST['pnews_cat_newscount'];
    $pref['pnews_cat_newssecheight'] = $_POST['pnews_cat_newssecheight'];
    $pref['pnews_cat_infochoice'] = $_POST['pnews_cat_infochoice'];

    $pref['pnews_catm_menutitle'] = $_POST['pnews_catm_menutitle'];
    $pref['pnews_catm_menuheight'] = $_POST['pnews_catm_menuheight'];
    $pref['pnews_catm_catfsize'] = $_POST['pnews_catm_catfsize'];
    $pref['pnews_catm_newstfsize'] = $_POST['pnews_catm_newstfsize'];
    $pref['pnews_catm_newsimgsize'] = $_POST['pnews_catm_newsimgsize'];
    $pref['pnews_catm_newsimgratio'] = $_POST['pnews_catm_newsimgratio'];
    $pref['pnews_catm_newscount'] = $_POST['pnews_catm_newscount'];

    $pref['pnews_scatm_menutitle'] = $_POST['pnews_scatm_menutitle'];
    $pref['pnews_scatm_menuheight'] = $_POST['pnews_scatm_menuheight'];
    $pref['pnews_scatm_catfsize'] = $_POST['pnews_scatm_catfsize'];
    $pref['pnews_scatm_newstfsize'] = $_POST['pnews_scatm_newstfsize'];
    $pref['pnews_scatm_newsimgsize'] = $_POST['pnews_scatm_newsimgsize'];
    $pref['pnews_scatm_newsimgratio'] = $_POST['pnews_scatm_newsimgratio'];
    $pref['pnews_scatm_newscount'] = $_POST['pnews_scatm_newscount'];
    $pref['pnews_scatm_newsdesclimit'] = $_POST['pnews_scatm_newsdesclimit'];
    $pref['pnews_scatm_infochoice'] = $_POST['pnews_scatm_infochoice'];
    $pref['pnews_scatm_catchoice'] = $_POST['pnews_scatm_catchoice'];

    $pref['pnews_news_catfsize'] = $_POST['pnews_news_catfsize'];
    $pref['pnews_news_newstfsize'] = $_POST['pnews_news_newstfsize'];
    $pref['pnews_news_newsimgsize'] = $_POST['pnews_news_newsimgsize'];
    $pref['pnews_news_newsimgratio'] = $_POST['pnews_news_newsimgratio'];
    $pref['pnews_news_newsdesclimit'] = $_POST['pnews_news_newsdesclimit'];
    $pref['pnews_news_infochoice'] = $_POST['pnews_news_infochoice'];

    $pref['pnews_newsm_menutitle'] = $_POST['pnews_newsm_menutitle'];
    $pref['pnews_newsm_menuheight'] = $_POST['pnews_newsm_menuheight'];
    $pref['pnews_newsm_newscount'] = $_POST['pnews_newsm_newscount'];
    $pref['pnews_newsm_newstfsize'] = $_POST['pnews_newsm_newstfsize'];
    $pref['pnews_newsm_newsimgsize'] = $_POST['pnews_newsm_newsimgsize'];
    $pref['pnews_newsm_newsimgratio'] = $_POST['pnews_newsm_newsimgratio'];
    $pref['pnews_newsm_newsdesclimit'] = $_POST['pnews_newsm_newsdesclimit'];
    $pref['pnews_newsm_infochoice'] = $_POST['pnews_newsm_infochoice'];

    $pref['pnews_archm_menutitle'] = $_POST['pnews_archm_menutitle'];
    $pref['pnews_archm_menuheight'] = $_POST['pnews_archm_menuheight'];
    $pref['pnews_archm_newstfsize'] = $_POST['pnews_archm_newstfsize'];
    $pref['pnews_archm_newsimgsize'] = $_POST['pnews_archm_newsimgsize'];
    $pref['pnews_archm_newscount'] = $_POST['pnews_archm_newscount'];

    $pref['pnews_det_newstfsize'] = $_POST['pnews_det_newstfsize'];
    $pref['pnews_det_newsimgsize'] = $_POST['pnews_det_newsimgsize'];

    $pref['pnews_filesize'] = $_POST['pnews_filesize'];
    $pref['pnews_userclass'] = $_POST['pnews_userclass'];
    $pref['pnews_moderators'] = $_POST['pnews_moderators'];
    $pref['pnews_autoapprove_userclass'] = $_POST['pnews_autoapprove_userclass'];
    $pref['pnews_pmuser'] = $_POST['pnews_pmuser'];
    $pref['pnews_sum_limit'] = $_POST['pnews_sum_limit'];
    $pref['pnews_com_limit'] = $_POST['pnews_com_limit'];
    $pref['pnews_dateformat'] = $_POST['pnews_dateformat'];
    $pref['pnews_dateoffset'] = $_POST['pnews_dateoffset'];

if (isset($_POST['pnews_com_enable'])) 
{$pref['pnews_com_enable'] = 1;}
else
{$pref['pnews_com_enable'] = 0;}

if (isset($_POST['pnews_showemptysum'])) 
{$pref['pnews_showemptysum'] = 1;}
else
{$pref['pnews_showemptysum'] = 0;}

if (isset($_POST['pnews_enable_pmnote'])) 
{$pref['pnews_enable_pmnote'] = 1;}
else
{$pref['pnews_enable_pmnote'] = 0;}

if (isset($_POST['pnews_catm_shownews'])) 
{$pref['pnews_catm_shownews'] = 1;}
else
{$pref['pnews_catm_shownews'] = 0;}

if (isset($_POST['pnews_shownewssec'])) 
{$pref['pnews_shownewssec'] = 1;}
else
{$pref['pnews_shownewssec'] = 0;}

if (isset($_POST['pnews_enable_theme'])) 
{$pref['pnews_enable_theme'] = 1;}
else
{$pref['pnews_enable_theme'] = 0;}

if (isset($_POST['pnews_enable_submit'])) 
{$pref['pnews_enable_submit'] = 1;}
else
{$pref['pnews_enable_submit'] = 0;}

if (isset($_POST['pnews_enable_useredit'])) 
{$pref['pnews_enable_useredit'] = 1;}
else
{$pref['pnews_enable_useredit'] = 0;}

if (isset($_POST['pnews_enable_bbcode'])) 
{$pref['pnews_enable_bbcode'] = 1;}
else
{$pref['pnews_enable_bbcode'] = 0;}

if (isset($_POST['pnews_com_bbcode'])) 
{$pref['pnews_com_bbcode'] = 1;}
else
{$pref['pnews_com_bbcode'] = 0;}

if (isset($_POST['pnews_archm_newsstart'])) 
{$pref['pnews_archm_newsstart'] = 1;}
else
{$pref['pnews_archm_newsstart'] = 0;}




    save_prefs();
    $led_msgtext = "Settings Saved";
}

$admin_title = "AACGC Public News (Settings)";
//--------------------------------------------------------------------


$offset = $pref['pnews_dateoffset'];
$time = time()  + ($offset * 60 * 60);
$ctime = $time;
$dformat = $pref['pnews_dateformat'];
$date = date($dformat, $ctime);


$text .= "
<form method='post' action='" . e_SELF . "?update' id='confadvmedsys'>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>


		<tr>
			<td colspan='3' class='fcaption'><font size='2'><b>".APNEWS_01.":</b></font></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".APNEWS_02.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['pnews_enable_theme'] == 1 ? "<input type='checkbox' name='pnews_enable_theme' value='1' checked='checked' />" : "<input type='checkbox' name='pnews_enable_theme' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_03.":<br>(<a href='http://php.net/manual/en/function.date.php' target=_blank'>".APNEWS_04."</a>)</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='pnews_dateformat' value='".$tp->toFORM($pref['pnews_dateformat' ])."' /> (".APNEWS_05." ".$date.")</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_06."</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='pnews_dateoffset' value='".$tp->toFORM($pref['pnews_dateoffset' ])."' /></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".APNEWS_07.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['pnews_enable_submit'] == 1 ? "<input type='checkbox' name='pnews_enable_submit' value='1' checked='checked' />" : "<input type='checkbox' name='pnews_enable_submit' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".APNEWS_08.":".APNEWS_09."</td>
		        <td colspan=2 class='forumheader3'>".($pref['pnews_enable_bbcode'] == 1 ? "<input type='checkbox' name='pnews_enable_bbcode' value='1' checked='checked' />" : "<input type='checkbox' name='pnews_enable_bbcode' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_10.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='pnews_sum_limit' value='".$tp->toFORM($pref['pnews_sum_limit' ])."' /></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".APNEWS_11.":".APNEWS_58."</td>
		        <td colspan=2 class='forumheader3'>".($pref['pnews_showemptysum'] == 1 ? "<input type='checkbox' name='pnews_showemptysum' value='1' checked='checked' />" : "<input type='checkbox' name='pnews_showemptysum' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".APNEWS_12.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['pnews_enable_useredit'] == 1 ? "<input type='checkbox' name='pnews_enable_useredit' value='1' checked='checked' />" : "<input type='checkbox' name='pnews_enable_useredit' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_13.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='pnews_filesize' value='".$tp->toFORM($pref['pnews_filesize' ])."' />Bytes (1,000B = 1KB)</td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".APNEWS_14.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['pnews_enable_pmnote'] == 1 ? "<input type='checkbox' name='pnews_enable_pmnote' value='1' checked='checked' />" : "<input type='checkbox' name='pnews_enable_pmnote' value='0' />")."</td>
	        </tr>

";


//---------------------------# Userclass Allowed to Submit #---------------------------

	$sql->db_Select("userclass_classes", "*", "WHERE userclass_id=".$pref['pnews_userclass']."","");
        $row = $sql->db_Fetch();
	if ($pref['pnews_userclass'] == "members")
	{$classnow = "Members";}
	else
	{$classnow = "".$row['userclass_name']."";}


$text .= "<tr>
          <td style='width:30%' class='forumheader3'>".APNEWS_15.":</td>
          <td style='width:70%' class='forumheader3'>";
$text .= "<select name='pnews_userclass' size='1' class='tbox' style='width:50%'>
          <option name='pnews_userclass' value='".$pref['pnews_userclass']."'>".$classnow."</option>
	  <option name='pnews_userclass' value='members'>".APNEWS_16."</option>";

	$sql2 = new db;
	$sql2->db_Select("userclass_classes", "*", "ORDER BY userclass_id ASC","");
        while($row2 = $sql2->db_Fetch()){
        $text .= "<option name='pnews_userclass' value='".$row2['userclass_id']."'>".$row2['userclass_name']."</option>";}

//---------------------------# Moderator Class #-----------------------------------------

	$sql3 = new db;
	$sql3->db_Select("userclass_classes", "*", "WHERE userclass_id=".$pref['pnews_moderators']."","");
        $row3 = $sql3->db_Fetch();
	if ($pref['pnews_moderators'] == "none")
	{$classmod = "None";}
	else
	{$classmod = "".$row3['userclass_name']."";}
        

$text .= "</td>
	  </tr>
	  <tr>
          <td style='width:30%' class='forumheader3'>".APNEWS_17.":</td>
          <td style='width:70%' class='forumheader3'>";
$text .= "<select name='pnews_moderators' size='1' class='tbox' style='width:50%'>
          <option name='pnews_moderators' value='".$pref['pnews_moderators']."'>".$classmod."</option>
          <option name='pnews_moderators' value='none'>".APNEWS_18."</option>";

	$sql4 = new db;
	$sql4->db_Select("userclass_classes", "*", "ORDER BY userclass_id ASC","");
        while($row4 = $sql4->db_Fetch()){
        $text .= "<option name='pnews_moderators' value='".$row4['userclass_id']."'>".$row4['userclass_name']."</option>";}


//---------------------------# Userclass Auto Approved #---------------------------

	$sql9 = new db;
	$sql9->db_Select("userclass_classes", "*", "WHERE userclass_id=".$pref['pnews_autoapprove_userclass']."","");
        $row9 = $sql9->db_Fetch();
	if ($pref['pnews_autoapprove_userclass'] == "none")
	{$classauto = "None";}
	else
	{$classauto = "".$row9['userclass_name']."";}


$text .= "<tr>
          <td style='width:30%' class='forumheader3'>".APNEWS_19.":</td>
          <td style='width:70%' class='forumheader3'>";
$text .= "<select name='pnews_autoapprove_userclass' size='1' class='tbox' style='width:50%'>
          <option name='pnews_autoapprove_userclass' value='".$pref['pnews_autoapprove_userclass']."'>".$classauto."</option>
	  <option name='pnews_autoapprove_userclass' value='none'>".APNEWS_20."</option>";

	$sql8 = new db;
	$sql8->db_Select("userclass_classes", "*", "ORDER BY userclass_id ASC","");
        while($row8 = $sql8->db_Fetch()){
        $text .= "<option name='pnews_autoapprove_userclass' value='".$row8['userclass_id']."'>".$row8['userclass_name']."</option>";}


//---------------------------# PM User #-------------------------------------------------

	$sql5 = new db;
	$sql5->db_Select("user", "*", "WHERE user_id=".$pref['pnews_pmuser']."","");
        $row5 = $sql5->db_Fetch();
        $pmuser = "".$row5['user_name']."";

$text .= "</td>
	  </tr>
	  <tr>
          <td style='width:30%' class='forumheader3'>".APNEWS_21.":</td>
          <td style='width:70%' class='forumheader3'>";
$text .= "<select name='pnews_pmuser' size='1' class='tbox' style='width:50%'>
          <option name='pnews_pmuser' value='".$pref['pnews_pmuser']."'>".$pmuser."</option>";

	$sql6 = new db;
	$sql6->db_Select("user", "*", "ORDER BY user_name ASC","");
        while($row6 = $sql6->db_Fetch()){
        $text .= "<option name='pnews_pmuser' value='".$row6['user_id']."'>".$row6['user_name']."</option>";}

//---------------------------

$text .= "	</td>
		</tr>
		<tr>
			<td colspan='3' class='fcaption'><font size='2'><b>".APNEWS_22.":</b></font></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_23.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='100' name='pnews_cat_header' value='".$tp->toFORM($pref['pnews_cat_header' ])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_24.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='pnews_cat_headerfsize' value='".$tp->toFORM($pref['pnews_cat_headerfsize' ])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_25.":</td>
			<td colspan='2'  class='forumheader3'><textarea class='tbox' rows='5' cols='100' name='pnews_cat_intro'>" . $tp->toFORM($pref['pnews_cat_intro']) . "</textarea></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_26.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='pnews_cat_introfsize' value='".$tp->toFORM($pref['pnews_cat_introfsize' ])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_27.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='pnews_cat_catfsize' value='".$tp->toFORM($pref['pnews_cat_catfsize' ])."' /></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".APNEWS_28.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['pnews_shownewssec'] == 1 ? "<input type='checkbox' name='pnews_shownewssec' value='1' checked='checked' />" : "<input type='checkbox' name='pnews_shownewssec' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_29.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='pnews_cat_newssecheight' value='".$tp->toFORM($pref['pnews_cat_newssecheight' ])."' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_30.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='pnews_cat_newscount' value='".$tp->toFORM($pref['pnews_cat_newscount' ])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_31.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='pnews_cat_newstfsize' value='".$tp->toFORM($pref['pnews_cat_newstfsize' ])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_32.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='pnews_cat_newsimgsize' value='".$tp->toFORM($pref['pnews_cat_newsimgsize' ])."' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_33.":</td>
			<td style='width:70%' class='forumheader3'>
		<input class='tbox' type='radio'  name='pnews_cat_newsimgratio' value='width' " . ($pref['pnews_cat_newsimgratio']=='width'?"checked='checked'":'') . " /> ".APNEWS_34."
		<br />
		<input class='tbox' type='radio'  name='pnews_cat_newsimgratio' value='auto' " . ($pref['pnews_cat_newsimgratio']=="auto"?"checked='checked'":'') . " /> ".APNEWS_35."
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_36.":</td>
			<td style='width:70%' class='forumheader3'>
		<input class='tbox' type='radio'  name='pnews_cat_infochoice' value='desc' " . ($pref['pnews_cat_infochoice']=='desc'?"checked='checked'":'') . " /> ".APNEWS_37."
		<br />
		<input class='tbox' type='radio'  name='pnews_cat_infochoice' value='summary' " . ($pref['pnews_cat_infochoice']=="summary"?"checked='checked'":'') . " /> ".APNEWS_38."
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_39.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='pnews_cat_newsdesclimit' value='".$tp->toFORM($pref['pnews_cat_newsdesclimit' ])."' /></td>
		</tr>





		<tr>
			<td colspan='3' class='fcaption'><font size='2'><b>".APNEWS_40.":</b></font></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_27.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='pnews_news_catfsize' value='".$tp->toFORM($pref['pnews_news_catfsize' ])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_31.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='pnews_news_newstfsize' value='".$tp->toFORM($pref['pnews_news_newstfsize' ])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_32.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='pnews_news_newsimgsize' value='".$tp->toFORM($pref['pnews_news_newsimgsize' ])."' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_33.":</td>
			<td style='width:70%' class='forumheader3'>
		<input class='tbox' type='radio'  name='pnews_news_newsimgratio' value='width' " . ($pref['pnews_news_newsimgratio']=='width'?"checked='checked'":'') . " /> ".APNEWS_34."
		<br />
		<input class='tbox' type='radio'  name='pnews_news_newsimgratio' value='auto' " . ($pref['pnews_news_newsimgratio']=="auto"?"checked='checked'":'') . " /> ".APNEWS_35."
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_36.":</td>
			<td style='width:70%' class='forumheader3'>
		<input class='tbox' type='radio'  name='pnews_news_infochoice' value='desc' " . ($pref['pnews_news_infochoice']=='desc'?"checked='checked'":'') . " /> ".APNEWS_37."
		<br />
		<input class='tbox' type='radio'  name='pnews_news_infochoice' value='summary' " . ($pref['pnews_news_infochoice']=="summary"?"checked='checked'":'') . " /> ".APNEWS_38."
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_39.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='pnews_news_newsdesclimit' value='".$tp->toFORM($pref['pnews_news_newsdesclimit' ])."' /></td>
		</tr>






		<tr>
			<td colspan='3' class='fcaption'><font size='2'><b>".APNEWS_41.":</b></font></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_31.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='pnews_det_newstfsize' value='".$tp->toFORM($pref['pnews_det_newstfsize' ])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_32.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='pnews_det_newsimgsize' value='".$tp->toFORM($pref['pnews_det_newsimgsize' ])."' />px</td>
		</tr>






		<tr>
			<td colspan='3' class='fcaption'><font size='2'><b>".APNEWS_42.":</b></font></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_43.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='100' name='pnews_catm_menutitle' value='".$tp->toFORM($pref['pnews_catm_menutitle' ])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_44.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='pnews_catm_menuheight' value='".$tp->toFORM($pref['pnews_catm_menuheight' ])."' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_27.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='pnews_catm_catfsize' value='".$tp->toFORM($pref['pnews_catm_catfsize' ])."' /></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".APNEWS_28.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['pnews_catm_shownews'] == 1 ? "<input type='checkbox' name='pnews_catm_shownews' value='1' checked='checked' />" : "<input type='checkbox' name='pnews_catm_shownews' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_30.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='pnews_catm_newscount' value='".$tp->toFORM($pref['pnews_catm_newscount' ])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_31.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='pnews_catm_newstfsize' value='".$tp->toFORM($pref['pnews_catm_newstfsize' ])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_32.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='pnews_catm_newsimgsize' value='".$tp->toFORM($pref['pnews_catm_newsimgsize' ])."' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_33.":</td>
			<td style='width:70%' class='forumheader3'>
		<input class='tbox' type='radio'  name='pnews_catm_newsimgratio' value='width' " . ($pref['pnews_catm_newsimgratio']=='width'?"checked='checked'":'') . " /> ".APNEWS_34."
		<br />
		<input class='tbox' type='radio'  name='pnews_catm_newsimgratio' value='auto' " . ($pref['pnews_catm_newsimgratio']=="auto"?"checked='checked'":'') . " /> ".APNEWS_35."
			</td>
		</tr>






		<tr>
			<td colspan='3' class='fcaption'><font size='2'><b>".APNEWS_45.":</b></font><br>".APNEWS_46."</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_43.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='100' name='pnews_scatm_menutitle' value='".$tp->toFORM($pref['pnews_scatm_menutitle' ])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_44.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='pnews_scatm_menuheight' value='".$tp->toFORM($pref['pnews_scatm_menuheight' ])."' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_27.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='pnews_scatm_catfsize' value='".$tp->toFORM($pref['pnews_scatm_catfsize' ])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_30.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='pnews_scatm_newscount' value='".$tp->toFORM($pref['pnews_scatm_newscount' ])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_31.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='pnews_scatm_newstfsize' value='".$tp->toFORM($pref['pnews_scatm_newstfsize' ])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_32.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='pnews_scatm_newsimgsize' value='".$tp->toFORM($pref['pnews_scatm_newsimgsize' ])."' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_33.":</td>
			<td style='width:70%' class='forumheader3'>
		<input class='tbox' type='radio'  name='pnews_scatm_newsimgratio' value='width' " . ($pref['pnews_scatm_newsimgratio']=='width'?"checked='checked'":'') . " /> ".APNEWS_34."
		<br />
		<input class='tbox' type='radio'  name='pnews_scatm_newsimgratio' value='auto' " . ($pref['pnews_scatm_newsimgratio']=="auto"?"checked='checked'":'') . " /> ".APNEWS_35."
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_36.":</td>
			<td style='width:70%' class='forumheader3'>
		<input class='tbox' type='radio'  name='pnews_scatm_infochoice' value='desc' " . ($pref['pnews_scatm_infochoice']=='desc'?"checked='checked'":'') . " /> ".APNEWS_37."
		<br />
		<input class='tbox' type='radio'  name='pnews_scatm_infochoice' value='summary' " . ($pref['pnews_scatm_infochoice']=="summary"?"checked='checked'":'') . " /> ".APNEWS_38."
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_39.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='pnews_scatm_newsdesclimit' value='".$tp->toFORM($pref['pnews_scatm_newsdesclimit' ])."' /></td>
		</tr>";

	$sql_cata = new db;
	$sql_cata->db_Select("aacgc_pnews_cat", "*", "WHERE news_cat_id=".$pref['pnews_scatm_catchoice']."","");
        $row_cata = $sql_cata->db_Fetch();
        $catnow = "".$row_cata['news_cat_title']."";

$text .= "  	<tr>
          		<td style='width:30%' class='forumheader3'>".APNEWS_47.":<br>".APNEWS_48."</td>
          		<td style='width:70%' class='forumheader3'>";
$text .= "	<select name='pnews_scatm_catchoice' size='1' class='tbox' style='width:50%'>
          	<option name='pnews_scatm_catchoice' value='".$pref['pnews_scatm_catchoice']."'>".$catnow."</option>";

	$sql_catb = new db;
	$sql_catb->db_Select("aacgc_pnews_cat", "*", "ORDER BY news_cat_title ASC","");
        while($row_catb = $sql_catb->db_Fetch()){

$text .= "	<option name='pnews_scatm_catchoice' value='".$row_catb['news_cat_id']."'>".$row_catb['news_cat_title']."</option>";}

$text .= "		</td>
		</tr>







		<tr>
			<td colspan='3' class='fcaption'><font size='2'><b>".APNEWS_49.":</b></font></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_43.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='100' name='pnews_newsm_menutitle' value='".$tp->toFORM($pref['pnews_newsm_menutitle' ])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_44.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='pnews_newsm_menuheight' value='".$tp->toFORM($pref['pnews_newsm_menuheight' ])."' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_30.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='pnews_newsm_newscount' value='".$tp->toFORM($pref['pnews_newsm_newscount' ])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_31.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='pnews_newsm_newstfsize' value='".$tp->toFORM($pref['pnews_newsm_newstfsize' ])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_32.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='pnews_newsm_newsimgsize' value='".$tp->toFORM($pref['pnews_newsm_newsimgsize' ])."' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_33.":</td>
			<td style='width:70%' class='forumheader3'>
		<input class='tbox' type='radio'  name='pnews_newsm_newsimgratio' value='width' " . ($pref['pnews_newsm_newsimgratio']=='width'?"checked='checked'":'') . " /> ".APNEWS_34."
		<br />
		<input class='tbox' type='radio'  name='pnews_newsm_newsimgratio' value='auto' " . ($pref['pnews_newsm_newsimgratio']=="auto"?"checked='checked'":'') . " /> ".APNEWS_35."
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_36.":</td>
			<td style='width:70%' class='forumheader3'>
		<input class='tbox' type='radio'  name='pnews_newsm_infochoice' value='desc' " . ($pref['pnews_newsm_infochoice']=='desc'?"checked='checked'":'') . " /> ".APNEWS_37."
		<br />
		<input class='tbox' type='radio'  name='pnews_newsm_infochoice' value='summary' " . ($pref['pnews_newsm_infochoice']=="summary"?"checked='checked'":'') . " /> ".APNEWS_38."
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_39.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='pnews_newsm_newsdesclimit' value='".$tp->toFORM($pref['pnews_newsm_newsdesclimit' ])."' /></td>
		</tr>







		<tr>
			<td colspan='3' class='fcaption'><font size='2'><b>".APNEWS_50.":</b></font></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_43.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='100' name='pnews_archm_menutitle' value='".$tp->toFORM($pref['pnews_archm_menutitle' ])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_44.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='pnews_archm_menuheight' value='".$tp->toFORM($pref['pnews_archm_menuheight' ])."' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_30.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='pnews_archm_newscount' value='".$tp->toFORM($pref['pnews_archm_newscount' ])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_31.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='pnews_archm_newstfsize' value='".$tp->toFORM($pref['pnews_archm_newstfsize' ])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_32.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='pnews_archm_newsimgsize' value='".$tp->toFORM($pref['pnews_archm_newsimgsize' ])."' />px</td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".APNEWS_51.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['pnews_archm_newsstart'] == 1 ? "<input type='checkbox' name='pnews_archm_newsstart' value='1' checked='checked' />" : "<input type='checkbox' name='pnews_archm_newsstart' value='0' />")." ".APNEWS_52."</td>
	        </tr>






		<tr>
			<td colspan='3' class='fcaption'><font size='2'><b>".APNEWS_53.":</b></font></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".APNEWS_54.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['pnews_com_enable'] == 1 ? "<input type='checkbox' name='pnews_com_enable' value='1' checked='checked' />" : "<input type='checkbox' name='pnews_com_enable' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".APNEWS_55.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['pnews_com_bbcode'] == 1 ? "<input type='checkbox' name='pnews_com_bbcode' value='1' checked='checked' />" : "<input type='checkbox' name='pnews_com_bbcode' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APNEWS_56.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='pnews_com_limit' value='".$tp->toFORM($pref['pnews_com_limit' ])."' /></td>
		</tr>




		</table>";





//--------------------------------------------------------------------


$text .= "<table style='" . ADMIN_WIDTH . "' class='fborder'>
          <tr>
	  <td colspan='3' class='fcaption' style='text-align: left;'><center><input type='submit' name='update' value='".APNEWS_57."' class='button' /></td>
	  </tr>
	  </table>
	  </form>";

//--------------------------------------------------------------------


$ns->tablerender($admin_title, $text);
require_once(e_ADMIN . "footer.php");
?>
