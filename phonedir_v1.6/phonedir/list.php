<?php
// ***************************************************************
// *
// *		Title		:	Corporate Phone Directory
// *
// *		Author		:	Barry Keal
// *
// ***************************************************************
if (!defined('e107_INIT'))
{
    exit;
}
if (!check_class($pref['phonedir_userclass']))
{
    print LAN_phonedir_82;
    require_once(FOOTERF);
    exit();
}
if (!isset($pd_office))
{
    $pd_office = 2;
}
$pd_text = "
<script type='text/javascript'>
<!--
function blanket()
{
	var obj=\"pd_namez\";
	document.getElementById(obj).value=\"\";
}
-->
</script>
	<form method='post' action='" . e_SELF . "' id='phonedir'>

	<table class='fborder' style='width:97%;'>
	<tr>
	<td  colspan='2' class='fcaption'>
	<input type='hidden' name='pd_action' value='list' />
	<input type='hidden' name='pd_from' value='$pd_from' />
	<input type='hidden' name='pdcat_id' value='$pdcat_id' />
	<input type='hidden' name='pd_optioncat' value='$pd_optioncat' />
	<input type='hidden' name='pd_optionsite' value='$pd_optionsite' />
	<input type='hidden' name='pd_project' value='$pd_project' />
	<input type='hidden' name='pd_job' value='$pd_job' />
	<input type='hidden' name='pd_office' value='$pd_office' />
	<input type='hidden' name='pd_name' value='$pd_name' />
	<input type='hidden' name='pd_id' value='$pd_id' />
	<input type='hidden' name='pd_site' value='$pd_site' />
	<input type='hidden' name='pd_dept' value='$pd_dept' />	" . LAN_phonedir_1 . "</td></tr>
    ";
if (file_exists("./images/phone.gif"))
{
    $pd_text .= "<tr><td class='forumheader3' colspan='2' style='text-align:center;'><img src='./images/phone.gif' alt='' title='' /></td></tr>";
}
$pd_text .= "<tr>
	<td  colspan='2' class='forumheader2'>" . LAN_phonedir_71 . "</td></tr>
    <tr>
    <td style='width:30%;' valign='top' class='forumheader3'>" . LAN_phonedir_2 . "</td>
    <td style='width:70%;' valign='top' class='forumheader3'>
	<span title='" . LAN_phonedir_73 . "'>
	<select class='tbox' size='1' name='pd_optioncat' onchange='this.form.submit()' >";

$pd_args = "find_in_set(pd_cat_viewclass,'" . USERCLASS_LIST . "') order by pd_cat_order";
$pd_num = $sql->db_Select("pd_categories", "*", $pd_args);
if ($pd_num < 1)
{
    $pd_text .= "<option  value='$pd_cat_id'>" . LAN_phonedir_93 . "</option>";
}
else
{
    while ($catrow = $sql->db_Fetch())
    {
        extract($catrow);
        $pd_text .= "<option  value='$pd_cat_id'";
        $pd_text .= ($pd_cat_id == $pd_optioncat?" selected='selected' ":"");
        $pd_text .= ">" . $tp->toFORM($pd_cat_desc) . "</option>
		";
    }
}
if (!$pd_optioncat > 0)
{
    $sql->db_Select("pd_categories", "*", "$pd_args order by pd_cat_order");
    $catrow = $sql->db_Fetch();
    extract($catrow);
    $pd_optioncat = $pd_cat_id;
}
$pd_text .= "
	  </select></span>
	  </td>
	  </tr>";
if ($pref['phonedir_usesite'] == 1)
{
    $pd_text .= "<tr>
    <td valign='top' class='forumheader3'>" . LAN_phonedir_3 . "</td>
    <td valign='top' class='forumheader3' >
	<span title='" . LAN_phonedir_74 . "'><select  class='tbox' size='1' name='pd_optionsite' onchange='this.form.submit()' >";
    $sql->db_Select("pd_sites", "pd_site_id,pd_site_name", " order by pd_site_name", "nowhere", false);
    $pd_text .= "<option  value='0'>" . LAN_phonedir_21 . "</option>
	";
    while ($siterow = $sql->db_Fetch())
    {
        extract($siterow);
        $pd_text .= "<option  value='$pd_site_id'";
        $pd_text .= ($pd_site_id == $pd_optionsite?" selected='selected'":"");
        $pd_text .= ">" . $tp->toFORM($pd_site_name) . "</option>
		";
    }

    $pd_text .= "
	</select></span>
	</td>
	</tr>";
}
$pd_colspan =3;
if ($pref['phonedir_usedept'] == 1)
{
    $pd_text .= "<tr>
    <td valign='top' class='forumheader3'>" . LAN_phonedir_7 . "</td>
    <td valign='top' class='forumheader3'>
	<span title='" . LAN_phonedir_75 . "'>
	<select  class='tbox' size='1' name='pd_project' onchange='this.form.submit()' >";
    $sql->db_Select("pd_department", "pd_dept_id,pd_dept_name", " order by pd_dept_name", "nowhere", false);
    $pd_text .= "<option  value='0'>" . LAN_phonedir_21 . "</option>
	";

    while ($deptrow = $sql->db_Fetch())
    {
        extract($deptrow);
        $pd_text .= "<option  value='$pd_dept_id'";
        $pd_text .= ($pd_dept_id == $pd_project?" selected='selected' ":"");
        $pd_text .= ">" . $tp->toFORM($pd_dept_name) . "</option>
		";
    }
    $pd_colspan = 4;
    $pd_text .= "</select></span>
	  </td>
	  </tr>";
}

if ($pref['phonedir_usejob'] == 1)
{
    $pd_text .= "<tr>
      <td valign='top' class='forumheader3'>" . LAN_phonedir_8 . "</td>
      <td valign='top' class='forumheader3'><span title='" . LAN_phonedir_77 . "'><select  class='tbox' size='1' name='pd_job' onchange='this.form.submit()'>";
    $pd_text .= "<option  value='0'>" . LAN_phonedir_21 . "</option>";
    $sql->db_Select("pd_jobtitle", "pd_job_id,pd_job_title", " order by pd_job_title", "nowhere");

    while ($jobrow = $sql->db_Fetch())
    {
        extract($jobrow);
        $pd_text .= "<option  value='$pd_job_id'";
        $pd_text .= ($pd_job_id == $pd_job?" selected ='selected'":"");
        $pd_text .= ">" . $tp->toFORM($pd_job_title) . "</option>
		";
    }

    $pd_text .= "</select></span></td></tr>";
}

$pd_text .= "<tr>
      <td valign='top' class='forumheader3'>" . LAN_phonedir_9 . "</td>
      <td valign='top' class='forumheader3'><span title='" . LAN_phonedir_76 . "'>
	  <input class='tbox' type='text' id='pd_namez' name='pd_name' size='20' value='$pd_name' /></span>&nbsp;
	  <input type='button' class='button' name='clearit' value='clear' onclick='blanket()' /></td></tr>";

if ($pref['phonedir_useoffice'] == 1)
{
    $pd_text .= "<tr>
      <td valign='top' class='forumheader3'>" . LAN_phonedir_12 . "</td>
      <td valign='top' class='forumheader3'>[<span title='" . LAN_phonedir_78 . "'>
	  <input type='radio' class='tbox' style='border:0;' name='pd_office' value='1' onclick='this.form.submit()'";
    $pd_text .= ($pd_office == 1?" checked='checked' ":"");
    $pd_text .= " />" . LAN_phonedir_10 . "]</span>&nbsp;&nbsp;&nbsp;[
	  <span title='" . LAN_phonedir_79 . "'><input type='radio' class='tbox' style='border:0;' name='pd_office' value='0' onclick='this.form.submit()'";
    $pd_text .= ($pd_office == 0?" checked='checked' ":"");
    $pd_text .= " />" . LAN_phonedir_11 . "]</span>&nbsp;&nbsp;&nbsp;[<span title='" . LAN_phonedir_80 . "'>
	<input type='radio' style='border:0;' class='tbox' name='pd_office' value='2'  onclick='this.form.submit()'";
    $pd_text .= ($pd_office == 2?" checked='checked' ":"");
    $pd_text .= " />" . LAN_phonedir_45 . "]</span></td>
      </tr>";
}

$pd_text .= "<tr><td valign='top' colspan='2' class='forumheader'><input type='submit' class='button' name='pd_search' value='" . LAN_phonedir_13 . "' />";
// A simple script to hide the email address to reduce risk of being picked up by spam bots
$pd_params = "$pd_cat_id.$pd_optioncat.$pd_optionsite.$pd_project.$pd_job.$pd_office.$pd_name.$pd_id.$pd_site.$pd_dept";

$pd_text .= "&nbsp; &nbsp;
	<input class='button' type='submit' name='printable' value='" . LAN_phonedir_15 . "' />&nbsp;&nbsp;
<input type='submit' class='tbox' name='donotify' value='" . LAN_phonedir_16 . "' />      </td>
</tr>
  </table>
</form>
 <table class='fborder' width='97%'>
  <tr>
  <td colspan='{$pd_colspan}' class='forumheader2'>" . LAN_phonedir_72 . "</td></tr>
    <tr>
      <td class='forumheader' style='text-align:center;width:20%;vertical-align:top;'>" . LAN_phonedir_9 . "</td>
      <td class='forumheader' style='text-align:center;width:25%;vertical-align:top;'>" . LAN_phonedir_19 . "</td>
      <td class='forumheader' style='text-align:center;width:25%;vertical-align:top;'>" . LAN_phonedir_3 . "</td>";
if ($pref['phonedir_usedept'] == 1)
{
    $pd_text .= "      <td class='forumheader' style='text-align:center;width:30%;vertical-align:top;'>" . LAN_phonedir_7 . "</td>";
}

$pd_text .= "</tr>";

$sqlsyn = "select *
from #pd_directory
left  join  #pd_department on pd_department=pd_dept_id
left  join   #pd_sites  on pd_site=pd_site_id
where (pd_first_name like '%" . $tp->toFORM($pd_name) . "%' or pd_last_name like '%" . $tp->toFORM($pd_name) . "%') and pd_dir_cat='" . $pd_optioncat . "'";

if ($pd_optionsite > 0)
{
    $sqlsyn .= " and pd_site='{$pd_optionsite}' ";
}

if ($pd_project > 0)
{
    $sqlsyn .= " and pd_department='{$pd_project}' ";
}

if ($pd_job > 0)
{
    $sqlsyn .= " and pd_jobtitle='{$pd_job}' ";
}

if (($pref['phonedir_useoffice'] == 1))
{
    if ($pd_office == 1 || $pd_office == 0)
    {
        $sqlsyn .= " and pd_officed='{$pd_office}' ";
    }
}

$sqlsyn2 = $sqlsyn . " order by pd_last_name limit {$pd_from},{$pd_perpage} ";

$pd_count = $sql->db_Select_gen($sqlsyn, false);
$sql->db_Select_gen($sqlsyn2, false);

while ($dirrow = $sql->db_Fetch())
{
    extract($dirrow);
    $pd_id = $pd_id;
    $pd_site = $pd_site;
    $pd_dept = $pd_department;
    $pd_params2 = "$pd_cat_id.$pd_optioncat.$pd_optionsite.$pd_project.$pd_job.$pd_office.$pd_name.$pd_id.$pd_site.$pd_dept";
    $pd_text .= "
	<tr>
		<td style='text-align:left;width:20%;vertical-align:top;' class='forumheader3'><a href='?$pd_from.view." . $pd_params2 . "'>" . $tp->toFORM($pd_last_name) . ", " . $tp->toFORM($pd_first_name) . "</a>&nbsp;</td>
		<td style='text-align:left;width:25%;vertical-align:top;' class='forumheader3'>" . $tp->toFORM($pd_work_phone) . "&nbsp;</td>";
    if ($pref['phonedir_usesite'] != 1)
    {
        $pd_text .= "<td style='text-align:left;width:25%;vertical-align:top;' class='forumheader3'>" . $tp->toFORM($pd_town) . "&nbsp;</td>";
    }
    else
    {
        $pd_text .= "<td style='text-align:left;width:25%;vertical-align:top;' class='forumheader3'>" . (!empty($pd_site_name)?"<a href='?$pd_from.site." . $pd_params2 . "'>" . $tp->toFORM($pd_site_name) . "</a>":"") . "&nbsp;</td>";
    }
    if ($pref['phonedir_usedept'] == 1)
    {
        $pd_text .= "
		<td style='text-align:left;width:30%;vertical-align:top;' class='forumheader3'>" . (!empty($pd_dept_name)?"<a href='?$pd_from.dept." . $pd_params2 . "'>" . $tp->toFORM($pd_dept_name) . "</a>":"") . "&nbsp;</td>";
    }
    $pd_text .= "</tr>";
}
// parameter order $pd_from $pd_action $pdcat_id $pd_optioncat $pd_optionsite $pd_project $pd_job $pd_office $pd_name $pd_id $pd_site $pd_dept
$pd_params = "$pdcat_id.$pd_optioncat.$pd_optionsite.$pd_project.$pd_job.$pd_office.$pd_name.$pd_id.$pd_site.$pd_dept";
$pd_arg = "list." . $pd_params;
// $ix = new nextprev2;
// $tx = $ix->nextprev3(e_SELF, $pd_from, $pd_perpage, $pd_count, LAN_phonedir_92, $pd_arg);
$action = "list.$pdcat_id.$pd_optioncat.$pd_optionsite.$pd_project.$pd_job.$pd_office.$pd_name.$pd_id.$pd_site.$pd_dept";
$parms = "$pd_count," . $pd_perpage . "," . $pd_from . "," . e_SELF . '?' . "[FROM]." . $action;

$projdir_nextprev = $tp->parseTemplate("{NEXTPREV={$parms}}") . "";
if (!empty($projdir_nextprev))
{
    $pd_text .= "<tr><td class='fcaption' colspan='{$pd_colspan}'>" . $projdir_nextprev . "</td></tr>";
}
$pd_text .= "</table>";
define("e_PAGETITLE", LAN_phonedir_1);
require_once(HEADERF);
$ns->tablerender(LAN_phonedir_1, $pd_text);
require_once(FOOTERF);

?>