<?php

//-----------------------------------------------------------------------------------------------------------+
/*
#######################################
#     e107 website system plguin      #
#     AACGC Payment Tracker           #
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/
//-----------------------------------------------------------------------------------------------------------+


require_once("../../class2.php");
if (!defined('e107_INIT'))
{exit;}
if (!getperms("P"))
{header("location:" . e_HTTP . "index.php");
exit;}
require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{define(ADMIN_WIDTH, "width:100%;");}

include_lan(e_PLUGIN."aacgc_paytrack/languages/".e_LANGUAGE.".php");

if (e_QUERY == "update")
{
 
   $pref['aacgcpt_pagetitle'] = $tp->toDB($_POST['aacgcpt_pagetitle']);
   $pref['aacgcpt_header'] = $tp->toDB($_POST['aacgcpt_header']);
   $pref['aacgcpt_intro'] = $tp->toDB($_POST['aacgcpt_intro']);
   $pref['aacgcpt_dformat'] = $tp->toDB($_POST['aacgcpt_dformat']);
   $pref['aacgcpt_toffset'] = $tp->toDB($_POST['aacgcpt_toffset']);
   $pref['aacgcpt_addclass'] = $tp->toDB($_POST['aacgcpt_addclass']);
   $pref['aacgcpt_viewclass'] = $tp->toDB($_POST['aacgcpt_viewclass']);
   $pref['aacgcpt_csymbol'] = $tp->toDB($_POST['aacgcpt_csymbol']);

if (isset($_POST['aacgcpt_enable_theme'])) 
{$pref['aacgcpt_enable_theme'] = 1;}
else
{$pref['aacgcpt_enable_theme'] = 0;}


    save_prefs();
    $text .= "<center><b>".APT_51."</b><br><br></center>";
}

$admin_title = "AACGC Payment Tracker (".APT_50.")";

//-------------------------# BB Code Support #----------------------------------------------

include(e_HANDLER."ren_help.php");

//------------------------------------------------------------------------------------------

$offset = $pref['aacgcpt_toffset'];
$time = time()  + ($offset * 60 * 60);
$dformat = $pref['aacgcpt_dformat'];
$date = date($dformat, $time);


$text .= "
<form method='post' action='" . e_SELF . "?update' id='paytrack'>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>


		<tr>
			<td colspan='3' class='fcaption'>".APT_70.":</td>
		</tr>

                <tr>
		        <td style='width:30%' class='forumheader3'>".APT_52.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['aacgcpt_enable_theme'] == 1 ? "<input type='checkbox' name='aacgcpt_enable_theme' value='1' checked='checked' />" : "<input type='checkbox' name='aacgcpt_enable_theme' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APT_02.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='5' name='aacgcpt_csymbol' value='" . $tp->toFORM($pref['aacgcpt_csymbol']) . "' /></td>
		</tr>";

//---------------------------# Userclass Allowed to Add / Edit Members #---------------------------+

	$sql = new db;
	$sql->db_Select("userclass_classes", "*", "userclass_id='".$pref['aacgcpt_addclass']."'");
        $row = $sql->db_Fetch();

	if ($pref['aacgcpt_addclass'] == "none")
	{$addclass = "".APT_81."";}
	else
	{$addclass = "".$row['userclass_name']."";}

$text .= "<tr>
          <td style='width:30%' class='forumheader3'>".APT_58.":</td>
          <td style='width:70%' class='forumheader3'>";
$text .= "<select name='aacgcpt_addclass' size='1' class='tbox' style='width:50%'>
          <option name='aacgcpt_addclass' value='".$pref['aacgcpt_addclass']."'>".$addclass."</option>
	  <option name='aacgcpt_addclass' value='none'>".APT_81."</option>";

	$sql2 = new db;
	$sql2->db_Select("userclass_classes", "*", "ORDER BY userclass_id ASC","");
        while($row2 = $sql2->db_Fetch()){

$text .= "<option name='aacgcpt_addclass' value='".$row2['userclass_id']."'>".$row2['userclass_name']."</option>";}

$text .= "</td></tr>";


//---------------------------# Userclass Allowed to View PayTracker #---------------------------+

	$sql3 = new db;
	$sql3->db_Select("userclass_classes", "*", "userclass_id='".$pref['aacgcpt_viewclass']."'");
        $row3 = $sql3->db_Fetch();

	if ($pref['aacgcpt_viewclass'] == "all")
	{$viewclass = "".APT_66."";}
	else if ($pref['aacgcpt_viewclass'] == "members")
	{$viewclass = "".APT_62."";}
	else
	{$viewclass = "".$row3['userclass_name']."";}

$text .= "<tr>
          <td style='width:30%' class='forumheader3'>".APT_63.":</td>
          <td style='width:70%' class='forumheader3'>";
$text .= "<select name='aacgcpt_viewclass' size='1' class='tbox' style='width:50%'>
          <option name='aacgcpt_viewclass' value='".$pref['aacgcpt_viewclass']."'>".$viewclass."</option>
	  <option name='aacgcpt_viewclass' value='all'>".APT_66."</option>";

	$sql4 = new db;
	$sql4->db_Select("userclass_classes", "*", "ORDER BY userclass_id ASC","");
        while($row4 = $sql4->db_Fetch()){

$text .= "<option name='aacgcpt_viewclass' value='".$row4['userclass_id']."'>".$row4['userclass_name']."</option>";}

//-------------------------

$text .= "</td></tr>



		<tr>
			<td colspan='3' class='fcaption'>".APT_71.":</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APT_56.":<br>(<a href='http://php.net/manual/en/function.date.php' target=_blank'>".APT_59."</a>)</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='25' name='aacgcpt_dformat' value='" . $tp->toFORM($pref['aacgcpt_dformat']) . "' /> (".APT_60." ".$date.")</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APT_61.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='aacgcpt_toffset' value='" . $tp->toFORM($pref['aacgcpt_toffset']) . "' /></td>
		</tr>






		<tr>
			<td colspan='3' class='fcaption'>".APT_72.":</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".APT_53.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='100' name='aacgcpt_pagetitle' value='" . $tp->toFORM($pref['aacgcpt_pagetitle']) . "' /></td>
		</tr>
        	<tr>
        		<td style='width:' class='forumheader3'>".APT_54.":</td>
        		<td style='width:' class='forumheader3' colspan=2>
	    		<textarea class='tbox' rows='5' cols='100' name='aacgcpt_header' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>".$pref['aacgcpt_header']."</textarea><br>";

$text .= display_help('helpb', 'forum');

$text .= "      </td> 
		</tr>
        	<tr>
        		<td style='width:' class='forumheader3'>".APT_55.":</td>
        		<td style='width:' class='forumheader3' colspan=2>
	    		<textarea class='tbox' rows='15' cols='100' name='aacgcpt_intro' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>".$pref['aacgcpt_intro']."</textarea><br>";

$text .= display_help('helpb', 'forum');

$text .= "      </td> 
		</tr>









";





$text .= "      <tr>
			<td colspan='3' class='fcaption' style='text-align: left;'><center><input type='submit' name='update' value='".APT_94."' class='button' /></center></td>
		</tr>



</table>
</form>";





$ns->tablerender($admin_title, $text);
require_once(e_ADMIN . "footer.php");
?>

