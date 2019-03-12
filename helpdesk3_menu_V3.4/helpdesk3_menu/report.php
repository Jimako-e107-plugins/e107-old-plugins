<?php
// ****************************************************************
// *
// * 	Print ticket to pdf
// *
// ****************************************************************
// USE GET method for form - get round bug in IE that forces download.  See docs
// in fpdf
require_once(e_HANDLER . "calendar/calendar_class.php");
$hdu_cal = new DHTML_Calendar(true);

$hdu_caltext .= $hdu_cal->load_files();
switch ($HELPDESK_PREF['hdu_dateformat'])
{
    case 1:
        $hdu_calformat = "m-d-Y";
        break;
    case 2:
        $hdu_calformat = "Y-m-d";
        break;
    case 0:
    default:
        $hdu_calformat = "d-m-Y";
}
if (!defined("USER_WIDTH"))
{
    define(USER_WIDTH, "width:100%");
}
$hdu_text .= "
<form method='get' action='pdfrep.php' id='repform' >
	<div>
		<input type='hidden' name='hdu_id' value='$id' />
	</div>
	<table style ='" . USER_WIDTH . "' class='fborder'>
		<tr>
			<td class='fcaption' colspan='2'>" . HDU_126 . "</td>
		</tr>
		<tr>
			<td style='vertical-align:top;' class='forumheader3' colspan = '2' ><a href='" . e_PLUGIN . "helpdesk3_menu/helpdesk.php?0.list.0'><img src='./images/updir.png' alt='" . HDU_73 . "' title='" . HDU_73 . "' style='border:0;' /></a></td>
		</tr>
		<tr>
			<td class='forumheader3' colspan='2'>" . HDU_127 . "</td>
		</tr>
    	<tr>
      		<td style='width=20%; vertical-align:top;' class='forumheader3' >" . HDU_128 . "</td>
      		<td  style='width=80%; vertical-align:top;' class='forumheader3' >
	  			<input type='radio' name='hdu_rep' id='hdu_rep1' value='1' style='border:0;' class='radio' checked='checked' /><label for='hdu_rep1'> " . HDU_129 . "</label><br />
	  			<input type='radio' name='hdu_rep' id='hdu_rep2' value='2' style='border:0;' class='radio' /><label for='hdu_rep2'> " . HDU_130 . "</label><br />
	  			<input type='radio' name='hdu_rep' id='hdu_rep3' value='3' style='border:0;' class='radio' /><label for='hdu_rep3'> " . HDU_131 . "</label><br />
	  			<input type='radio' name='hdu_rep' id='hdu_rep4' value='4' style='border:0;' class='radio' /><label for='hdu_rep4'> " . HDU_132 . "</label>
			</td>
		</tr>";
$hdu_reps = explode(",", HDU_REP);
$hdu_repsel = "<select name='hdu_repselection' class='tbox'>";
$hdu_repcount = 0;

foreach($hdu_reps as $hdu_reprow)
{
    $hdu_repsel .= "<option value='$hdu_repcount'>$hdu_reprow</option>";
    $hdu_repcount ++;
}
$hdu_repsel .= '</select>';
$hdu_text .= "
    	<tr>
      		<td style='width=20%; vertical-align:top;' class='forumheader3' >" . "Report" . "</td>
      		<td style='width=80%; vertical-align:top;' class='forumheader3' >$hdu_repsel</td>
    	</tr>";
$hdu_text .= "
    	<tr>
      		<td style='width=20%; vertical-align:top;' class='forumheader3' >" . "Date range" . "</td>
      		<td style='width=80%; vertical-align:top;' class='forumheader3' >From :
			  ";
// * Calendar bits
$hdu_text .= $hdu_caltext;
// calendar options
$hdu_dformat = str_replace("d", "%d", $hdu_calformat);
$hdu_dformat = str_replace("m", "%m", $hdu_dformat);
$hdu_dformat = str_replace("Y", "%Y", $hdu_dformat);
$hdu_cal_options['firstDay'] = 1;
$hdu_cal_options['showsTime'] = false;
$hdu_cal_options['showOthers'] = false;
$hdu_cal_options['weekNumbers'] = false;
$hdu_cal_options['ifFormat'] = $hdu_dformat;
$hdu_cal_attrib['class'] = "tbox";
$hdu_cal_attrib['name'] = "hdu_fromd";
$hdu_cal_attrib['value'] = "";
$hdu_text .= $hdu_cal->make_input_field($hdu_cal_options, $hdu_cal_attrib);
// *
$hdu_text .= "<br />To : ";
// * Calendar bits
// $hdu_text .= $hdu_caltext;
// calendar options
$hdu_dformat = str_replace("d", "%d", $hdu_calformat);
$hdu_dformat = str_replace("m", "%m", $hdu_dformat);
$hdu_dformat = str_replace("Y", "%Y", $hdu_dformat);
$hdu_cal_options['firstDay'] = 1;
$hdu_cal_options['showsTime'] = false;
$hdu_cal_options['showOthers'] = false;
$hdu_cal_options['weekNumbers'] = false;
$hdu_cal_options['ifFormat'] = $hdu_dformat;
$hdu_cal_attrib['class'] = "tbox";
$hdu_cal_attrib['name'] = "hdu_tod";
$hdu_cal_attrib['value'] = "";
$hdu_text .= $hdu_cal->make_input_field($hdu_cal_options, $hdu_cal_attrib);
// *
$hdu_text .= "
			</td>
		</tr>";

$hdu_text .= "
		<tr>
			<td style='width=20%; vertical-align:top;' class='forumheader3'> " . HDU_107 . " </td>
			<td style='width=80%; vertical-align:top;' class='forumheader3' >
				<input type='radio' name='hdu_pagesize' id='hdu_repA' style='border:0;' value='a4' class='radio' checked='checked' /><label for='hdu_repA'> &nbsp;" . HDU_108 . "</label> <br />
				<input type='radio' name='hdu_pagesize' id='hdu_repL' value='letter' style='border:0;' class='radio' /><label for='hdu_repL'> " . HDU_109 . "</label>
			</td >
		</tr>
		<tr>
			<td style='width=20%; vertical-align:top;' class='forumheader3' > " . HDU_112 . " </td>
			<td style='width=80%; vertical-align:top;' class='forumheader3' >
			<input type='radio' name='hdu_dest' value='i' id='hdu_repI'  style='border:0;' class='radio' checked='checked' /><label for='hdu_repI'>&nbsp;" . HDU_110 . " </label><br />
			<input type='radio' name='hdu_dest' id='hdu_repD' style='border:0;'  value='d' class='radio' /><label for='hdu_repD'> " . HDU_111 . "</label>
		</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='2' ><input type='submit' name='subit' value='" . HDU_196 . "' class='tbox' /></td>
		</tr>
	</table>
</form> ";

$helpdesk_obj->tablerender(HDU_195, $hdu_text);
require_once(FOOTERF);
