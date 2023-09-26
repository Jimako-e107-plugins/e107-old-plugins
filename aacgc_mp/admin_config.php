<?php

//-----------------------------------------------------------------------------------------------------------+
/*
#######################################
#     AACGC Meeting Planner           #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
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

include_lan(e_PLUGIN."aacgc_mp/languages/".e_LANGUAGE.".php");

if (e_QUERY == "update")
{
 
   $pref['aacgcmp_pagetitle'] = $tp->toDB($_POST['aacgcmp_pagetitle']);
   $pref['aacgcmp_header'] = $tp->toDB($_POST['aacgcmp_header']);
   $pref['aacgcmp_intro'] = $tp->toDB($_POST['aacgcmp_intro']);
   $pref['aacgcmp_dformat'] = $tp->toDB($_POST['aacgcmp_dformat']);
   $pref['aacgcmp_toffset'] = $tp->toDB($_POST['aacgcmp_toffset']);
   $pref['aacgcmp_addclass'] = $tp->toDB($_POST['aacgcmp_addclass']);
   $pref['aacgcmp_closetime'] = $tp->toDB($_POST['aacgcmp_closetime']);
   $pref['aacgcmp_hoursperweek'] = $tp->toDB($_POST['aacgcmp_hoursperweek']);
   $pref['aacgcmp_hourspermonth'] = $tp->toDB($_POST['aacgcmp_hourspermonth']);

   $pref['aacgcmp_menutitle'] = $tp->toDB($_POST['aacgcmp_menutitle']);
   $pref['aacgcmp_menulimit'] = $tp->toDB($_POST['aacgcmp_menulimit']);
   $pref['aacgcmp_menuheight'] = $tp->toDB($_POST['aacgcmp_menuheight']);

if (isset($_POST['aacgcmp_enable_theme'])) 
{$pref['aacgcmp_enable_theme'] = 1;}
else
{$pref['aacgcmp_enable_theme'] = 0;}

if (isset($_POST['aacgcmp_enable_staticon'])) 
{$pref['aacgcmp_enable_staticon'] = 1;}
else
{$pref['aacgcmp_enable_staticon'] = 0;}

if (isset($_POST['aacgcmp_enable_menustats'])) 
{$pref['aacgcmp_enable_menustats'] = 1;}
else
{$pref['aacgcmp_enable_menustats'] = 0;}

if (isset($_POST['aacgcmp_enable_gold'])) 
{$pref['aacgcmp_enable_gold'] = 1;}
else
{$pref['aacgcmp_enable_gold'] = 0;}

    save_prefs();
    $text .= "<center><b>".AMP_51."</b><br><br></center>";
}

$admin_title = "AACGC Meeting Planner(".AMP_50.")";

//-------------------------# BB Code Support #----------------------------------------------

include(e_HANDLER."ren_help.php");

//------------------------------------------------------------------------------------------

$offset = $pref['aacgcmp_toffset'];
$time = time()  + ($offset * 60 * 60);
$dformat = $pref['aacgcmp_dformat'];
$date = date($dformat, $time);


$text .= "
<form method='post' action='" . e_SELF . "?update' id='arcadeaddins'>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>


		<tr>
			<td colspan='3' class='fcaption'>".AMP_70.":</td>
		</tr>

                <tr>
		        <td style='width:30%' class='forumheader3'>".AMP_52.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['aacgcmp_enable_theme'] == 1 ? "<input type='checkbox' name='aacgcmp_enable_theme' value='1' checked='checked' />" : "<input type='checkbox' name='aacgcmp_enable_theme' value='0' />")."</td>
	        </tr>";

//---------------------------# Userclass Allowed to Add Meetings #---------------------------+

	$sql = new db;
	$sql->db_Select("userclass_classes", "*", "userclass_id='".$pref['aacgcmp_addclass']."'");
        $row = $sql->db_Fetch();

	if ($pref['aacgcmp_addclass'] == "none")
	{$addclass = "".AMP_62."";}
	else
	{$addclass = "".$row['userclass_name']."";}

$text .= "<tr>
          <td style='width:30%' class='forumheader3'>".AMP_58.":</td>
          <td style='width:70%' class='forumheader3'>";
$text .= "<select name='aacgcmp_addclass' size='1' class='tbox' style='width:50%'>
          <option name='aacgcmp_addclass' value='".$pref['aacgcmp_addclass']."'>".$addclass."</option>
	  <option name='aacgcmp_addclass' value='none'>".AMP_62."</option>";

	$sql2 = new db;
	$sql2->db_Select("userclass_classes", "*", "ORDER BY userclass_id ASC","");
        while($row2 = $sql2->db_Fetch()){

$text .= "<option name='aacgcmp_addclass' value='".$row2['userclass_id']."'>".$row2['userclass_name']."</option>";}

//------------------

$text .= "</td></tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AMP_63.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='aacgcmp_closetime' value='" . $tp->toFORM($pref['aacgcmp_closetime']) . "' /> ".AMP_64."</td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".AMP_76.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['aacgcmp_enable_staticon'] == 1 ? "<input type='checkbox' name='aacgcmp_enable_staticon' value='1' checked='checked' />" : "<input type='checkbox' name='aacgcmp_enable_staticon' value='0' />")." ".AMP_77."</td>
	        </tr>








		<tr>
			<td colspan='3' class='fcaption'>".AMP_71.": ".AMP_75."</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AMP_56.":<br>(<a href='http://php.net/manual/en/function.date.php' target=_blank'>".AMP_59."</a>)</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='25' name='aacgcmp_dformat' value='" . $tp->toFORM($pref['aacgcmp_dformat']) . "' /> (".AMP_60." ".$date.")</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AMP_61.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='aacgcmp_toffset' value='" . $tp->toFORM($pref['aacgcmp_toffset']) . "' /> ".AMP_74."</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AMP_66.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='aacgcmp_hoursperweek' value='" . $tp->toFORM($pref['aacgcmp_hoursperweek']) . "' /> ".AMP_68." <a href='http://www.timeanddate.com/time/dst/' target='_blank'>".AMP_98."</a></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AMP_67.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='aacgcmp_hourspermonth' value='" . $tp->toFORM($pref['aacgcmp_hourspermonth']) . "' /> ".AMP_69." <a href='http://www.timeanddate.com/time/dst/' target='_blank'>".AMP_98."</a></td>
		</tr>






		<tr>
			<td colspan='3' class='fcaption'>".AMP_72.":</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AMP_53.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='100' name='aacgcmp_pagetitle' value='" . $tp->toFORM($pref['aacgcmp_pagetitle']) . "' /></td>
		</tr>
        	<tr>
        		<td style='width:' class='forumheader3'>".AMP_54.":</td>
        		<td style='width:' class='forumheader3' colspan=2>
	    		<textarea class='tbox' rows='5' cols='100' name='aacgcmp_header' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>".$pref['aacgcmp_header']."</textarea><br>";

$text .= display_help('helpb', 'forum');

$text .= "      </td> 
		</tr>
        	<tr>
        		<td style='width:' class='forumheader3'>".AMP_55.":</td>
        		<td style='width:' class='forumheader3' colspan=2>
	    		<textarea class='tbox' rows='15' cols='100' name='aacgcmp_intro' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>".$pref['aacgcmp_intro']."</textarea><br>";

$text .= display_help('helpb', 'forum');

$text .= "      </td> 
		</tr>





		<tr>
			<td colspan='3' class='fcaption'>".AMP_91.":</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AMP_92.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='100' name='aacgcmp_menutitle' value='" . $tp->toFORM($pref['aacgcmp_menutitle']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AMP_93.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='aacgcmp_menulimit' value='" . $tp->toFORM($pref['aacgcmp_menulimit']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".AMP_95.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='aacgcmp_menuheight' value='" . $tp->toFORM($pref['aacgcmp_menuheight']) . "' />px</td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".AMP_94.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['aacgcmp_enable_menustats'] == 1 ? "<input type='checkbox' name='aacgcmp_enable_menustats' value='1' checked='checked' />" : "<input type='checkbox' name='aacgcmp_enable_menustats' value='0' />")."</td>
	        </tr>





		<tr>
			<td colspan='3' class='fcaption'>".AMP_99.":</td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".AMP_100.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['aacgcmp_enable_gold'] == 1 ? "<input type='checkbox' name='aacgcmp_enable_gold' value='1' checked='checked' />" : "<input type='checkbox' name='aacgcmp_enable_gold' value='0' />")."</td>
	        </tr>


";




$text .= "      <tr>
			<td colspan='3' class='fcaption' style='text-align: left;'><center><input type='submit' name='update' value='Update Settings' class='button' /></center></td>
		</tr>



</table>
</form>";





$ns->tablerender($admin_title, $text);
require_once(e_ADMIN . "footer.php");
?>

