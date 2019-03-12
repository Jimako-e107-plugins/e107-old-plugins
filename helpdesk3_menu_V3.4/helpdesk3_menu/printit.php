<?php
// require_once("../../class2.php");
// ****************************************************************
// *
// * 	Print ticket to pdf
// *
// ****************************************************************
// USE GET method for form - get round bug in IE that forces download.  See docs
// in fpdf
if (!defined("USER_WIDTH"))
{
    define(USER_WIDTH, "width:100%;");
}
$hdu_text .= "

<form method='get' action='pdfit.php' id='printform' >
	<div>
		<input type='hidden' name='hdu_id' value='$id' />
	</div>
	<table style='" . USER_WIDTH . "' class='fborder'>
		<tr>
			<td class='fcaption' colspan='2'>" . HDU_105 . " $id</td>
		</tr>
		<tr>
			<td style='vertical-align:top;' class='forumheader3' colspan = '2' >
				<a href='".e_PLUGIN."helpdesk3_menu/helpdesk.php?$from.show.$id'><img src='./images/updir.png' alt='" . HDU_73 . "' title='" . HDU_73 . "' style='border:0;' /></a>&nbsp;
			</td>
		</tr>
		<tr>
			<td class='forumheader3' colspan='2'>" . HDU_106 . "</td>
		</tr>
	    <tr>
    	  	<td style='width=20%; vertical-align:top;' class='forumheader3' >" . HDU_107 . "</td>
      		<td  style='width=80%; vertical-align:top;' class='forumheader3' >
	  			<input type='radio' name='hdu_pagesize' id='hdu_destA' value='a4' style='border:0;' class='radio' checked='checked' /><label for='hdu_destA'>&nbsp;" . HDU_108 . "</label><br />
	  			<input type='radio' name='hdu_pagesize' id='hdu_destL' value='letter' style='border:0;' class='radio' /><label for='hdu_destL'> " . HDU_109 . "</label>
			</td>
    	</tr>
    	<tr>
      		<td style='width=20%; vertical-align:top;' class='forumheader3' >" . HDU_112 . "</td>
      		<td style='width=80%; vertical-align:top;' class='forumheader3' >
	  			<input type='radio' name='hdu_dest' id='hdu_destI' value='i'  style='border:0;' class='radio' checked='checked' /><label for='hdu_destI'>&nbsp;" . HDU_110 . "</label><br />
	  			<input type='radio' name='hdu_dest' id='hdu_destD' value='d' style='border:0;' class='radio' /><label for='hdu_destD'> " . HDU_111 . "</label>
			</td>
    	</tr>
		<tr>
			<td class='fcaption' colspan='2'>
				<input type='submit' name='subit' value='" . HDU_196 . "' class='tbox' />
			</td>
		</tr>
	</table>
</form>";

$helpdesk_obj->tablerender(HDU_249 . " # " . $id, $hdu_text, 'hdu_pdfit');
require_once(FOOTERF);
