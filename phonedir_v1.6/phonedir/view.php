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

$pd_params = "$pdcat_id.$pd_optioncat.$pd_optionsite.$pd_project.$pd_job.$pd_office.$pd_name.$pd_id.$pd_site.$pd_dept";
$sqlstmt = "select *
		from #pd_directory
		left  join  #pd_department on pd_department = pd_dept_id
		left  join   #pd_sites  on pd_site = pd_site_id
		left  join   #pd_jobtitle  on pd_jobtitle = pd_job_id
		where pd_id = '".intval($pd_id)."'";

$sql->db_Select_gen($sqlstmt, false);
$sqlrow = $sql->db_Fetch();
extract($sqlrow);
$pd_text = "
	<table style = 'width:97%;' class='fborder'>
	<tr>
	<td colspan='2' class='fcaption'>" . LAN_phonedir_69 . "</td>
	</tr>
	<tr>
	<td colspan = '2' class = 'fcaption'><a href='?$pd_from.list.$pd_params'><img src='./images/back.png' style='border:0;' title='" . LAN_phonedir_22 . "' alt='" . LAN_phonedir_22 . "' /></a></td>
	</tr>";
if ($pref['phonedir_usephoto'] > 0)
{
    $pd_text .= "	<tr><td class='forumheader3' style = 'width:75%;'>
	<table style = 'width:100%;'>";
}
$pd_text .= "<tr>
	<td style='width:30%; text-align:left' class='forumheader3'>" . LAN_phonedir_9 . "</td>
	<td style='width:70%; text-align:left' class='forumheader3'>" . $tp->toHTML($pd_last_name, false, "no_make_clickable emotes_on") . ", " . $tp->toHTML($pd_first_name, false, "no_make_clickable emotes_on") . "</td>
	</tr>";


	if($pref['phonedir_usesite']!=1)
{
$pd_text .= "
	<tr>
	<td style='width:30%; text-align:left' class='forumheader3'>" . LAN_phonedir_106 . "</td>
	<td style='width:70%; text-align:left' class='forumheader3'>" . $tp->toHTML($pd_address1, false, "no_make_clickable emotes_on") . "&nbsp;</td>
	</tr>
	<tr>
	<td style='width:30%; text-align:left' class='forumheader3'>" . LAN_phonedir_107 . "</td>
	<td style='width:70%; text-align:left' class='forumheader3'>" . $tp->toHTML($pd_address2, false, "no_make_clickable emotes_on") . "&nbsp;</td>
	</tr>
	<tr>
	<td style='width:30%; text-align:left' class='forumheader3'>" . LAN_phonedir_108 . "</td>
	<td style='width:70%; text-align:left' class='forumheader3'>" . $tp->toHTML($pd_town, false, "no_make_clickable emotes_on") . "&nbsp;</td>
	</tr>
	<tr>
	<td style='width:30%; text-align:left' class='forumheader3'>" . LAN_phonedir_109 . "</td>
	<td style='width:70%; text-align:left' class='forumheader3'>" . $tp->toHTML($pd_county, false, "no_make_clickable emotes_on") . "&nbsp;</td>
	</tr>
	<tr>
	<td style='width:30%; text-align:left' class='forumheader3'>" . LAN_phonedir_110 . "</td>
	<td style='width:70%; text-align:left' class='forumheader3'><a href='http:// maps.google.com/?q=" .urlencode($pd_postcode) ."'>" . $tp->toHTML($pd_postcode, false, "no_make_clickable emotes_on") . "</a>" . $tp->toHTML($pd_postcode, false, "no_make_clickable emotes_on") . "&nbsp;</td>
	</tr>
	<tr>
	<td style='width:30%; text-align:left' class='forumheader3'>" . LAN_phonedir_111 . "</td>
	<td style='width:70%; text-align:left' class='forumheader3'>" . $tp->toHTML($pd_country, false, "no_make_clickable emotes_on") . "&nbsp;</td>
	</tr>	";
}
	$pd_text .= "
	<tr>
	<td style='width:30%; text-align:left' class='forumheader3'>" . LAN_phonedir_19 . "</td>
	<td style='width:70%; text-align:left' class='forumheader3'>" . $tp->toHTML($pd_work_phone, false, "no_make_clickable emotes_on") . "&nbsp;</td>
	</tr>
	<tr>
	<td style='width:30%; text-align:left' class='forumheader3'>" . LAN_phonedir_70 . "</td>
	<td style='width:70%; text-align:left' class='forumheader3'>" . $tp->toHTML($pd_fax, false, "no_make_clickable emotes_on") . "&nbsp;</td>
	</tr>
	<tr>
	<td style='width:30%; text-align:left' class='forumheader3'>" . LAN_phonedir_20 . " </td>
	<td style='width:70%; text-align:left' class='forumheader3'>" . $tp->toHTML($pd_centrex, false, "no_make_clickable emotes_on") . "&nbsp;</td>
	</tr>
	<tr>
	<td style='width:30%; text-align:left' class='forumheader3'>" . LAN_phonedir_4 . " </td>
	<td style='width:70%; text-align:left' class='forumheader3'>" . $tp->toHTML($pd_mobile, false, "no_make_clickable emotes_on") . "&nbsp;</td>
	</tr>
	<tr>
	<td style='width:30%; text-align:left' class='forumheader3'>" . LAN_phonedir_5 . " </td>
	<td style='width:70%; text-align:left' class='forumheader3'>";
if (!empty($pd_email))
{
    $emailaddr = explode("@", $tp->toFORM($pd_email));
    // A simple script to hide the email address to reduce risk of being picked up by spam bots
    $pd_text .= "
	<script type='text/javascript'>
  <!--
  var contact = '" . LAN_phonedir_16 . "'
  var esail = '" . $emailaddr[0] . "'
  var esailHost = '" . $emailaddr[1] . $subject . "'
  document.write(\"<a href=\" + \"mail\" + \"to:\" + esail + \"@\" + esailHost+ \">\" + esail + \" at \" + esailHost+ \"</a>\" + \"\")
  //-->
</script></td>";
}
else
{
    $pd_text .= "&nbsp;</td>";
}

$pd_text .= "</tr>
	<tr>
	<td style='width:30%; text-align:left' class='forumheader3'>" . LAN_phonedir_6 . " </td>
	<td style='width:70%; text-align:left' class='forumheader3'>" . $tp->toHTML($pd_comments, false, "no_make_clickable emotes_on") . "</td>
	</tr>
	<tr>
	<td style='width:30%; text-align:left' class='forumheader3'>" . LAN_phonedir_12 . " </td>
	<td style='width:70%; text-align:left' class='forumheader3'>";
if ($pd_officed == 1)
{
    $pd_text .= LAN_phonedir_10;
}
else
{
    $pd_text .= LAN_phonedir_11;
}

$pd_text .= "</td>
	</tr>
	<tr>
	<td style='width:30%; text-align:left' class='forumheader3'>" . LAN_phonedir_7 . " </td>
	<td style='width:70%; text-align:left' class='forumheader3'>" . $tp->toHTML($pd_dept_name, false, "no_make_clickable emotes_off") . "&nbsp;</td>
	</tr>
	<tr>
	<td style='width:30%; text-align:left' class='forumheader3'>" . LAN_phonedir_3 . " </td>
	<td style='width:70%; text-align:left' class='forumheader3'>" . $tp->toHTML($pd_site_name, false, "no_make_clickable emotes_off") . "&nbsp;</td>
	</tr>
	<tr>
	<td style='width:30%; text-align:left' class='forumheader3'>" . LAN_phonedir_8 . " </td>
	<td style='width:70%; text-align:left' class='forumheader3'>" . $tp->toHTML($pd_job_title, false, "no_make_clickable emotes_off") . "&nbsp;</td>
	</tr>";
if ($pref['phonedir_usephoto'] > 0)
{
    $pd_text .= "</table>
	</td>";

    if (!empty($pd_picture) && file_exists("./photos/" . $pd_picture))
    {
        $pd_text .= "<td class='forumheader3' style='vertical-align:top;text-align:center;'><img src='./photos/" . $tp->toFORM($pd_picture) . "' alt='' title='' style='height:".$pref['phonedir_photoh']."px;width:".$pref['phonedir_photow']."px;border:0;' /></td>";
    }
    else
    {
        $pd_text .= "<td class='forumheader3' style='vertical-align:top;text-align:center;'><img src='./photos/nophoto.png' alt='' title='' style='height:".$pref['phonedir_photoh'].";width:".$pref['phonedir_photow'].";border:0;' /></td>";
    }
    $pd_text .= "</tr>";
}
$pd_text .= "
	</table>";

define("e_PAGETITLE", LAN_phonedir_1." ".$tp->toFORM($pd_last_name).", ".$tp->toFORM($pd_first_name));
require_once(HEADERF);
$ns->tablerender(LAN_phonedir_1, $pd_text);
require_once(FOOTERF);
?>