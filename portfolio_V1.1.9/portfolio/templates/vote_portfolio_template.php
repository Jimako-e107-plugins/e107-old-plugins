<?php
if (!defined("USER_WIDTH"))
{
    define(USER_WIDTH, "width:100%");
}
// *
// * Portfolio list. This part is the front opening screen of the portfolio directory
// *
if (!isset($PORTFOLIO_LIST_HEADER))
{
    // Start of Person list
    // This is sent first
    $PORTFOLIO_LIST_HEADER .= "
<table style='" . USER_WIDTH . "' class='fborder'>
	<tr>
		<td class='fcaption' colspan='3'>&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='3'><b>{PORTFOLIO_CAPTION}</b></td>
	</tr>";
}
if (!isset($PORTFOLIO_LIST_PROJECT_HEADER))
{
    $PORTFOLIO_LIST_PROJECT_HEADER .= "
	<tr>
		<td style='width:20%;' class='forumheader'><b>".PORTFOLIO_49."</b></td>
		<td style='width:50%;' class='forumheader'><b>".PORTFOLIO_50."</b></td>
		<td style='width:10%;' class='forumheader'><b>".PORTFOLIO_52."</b></td>
	</tr>";
}
if (!isset($PORTFOLIO_LIST_PROJECT_DETAIL))
{
    $PORTFOLIO_LIST_PROJECT_DETAIL .= "
	<tr>
		<td style='width:20%;' class='forumheader2'>{PORTFOLIO_LIST_PROJECT}&nbsp;</td>
		<td style='width:50%;' class='forumheader2'>{PORTFOLIO_LIST_SHORTDESC}&nbsp;</td>
		<td style='width:10%;' class='forumheader2'>&nbsp;</td>
	</tr>";
}

if (!isset($PORTFOLIO_LIST_SUB_DETAIL))
{
    $PORTFOLIO_LIST_SUB_DETAIL .= "
	<tr>
		<td class='forumheader3' >&nbsp;&gt;&nbsp;{PORTFOLIO_SUB_PROJECT}&nbsp;</td>
		<td class='forumheader3' >{PORTFOLIO_SUB_SHORTDESC}&nbsp;</td>
		<td style='width:10%;text-align:right;'class='forumheader3' >{PORTFOLIO_SUB_STAFF}&nbsp;</td>
	</tr>";
}
if (!isset($PORTFOLIO_LIST_NOITEM))
{
    $PORTFOLIO_LIST_NOITEM .= "
	<tr>
		<td colspan='3' class='forumheader3' >" . PORTFOLIO_26 . "</td>
	</tr>";
}
if (!isset($PORTFOLIO_LIST_FOOTER))
{
    $PORTFOLIO_LIST_FOOTER .= "
	<tr>
		<td colspan='3' class='forumheader3' >{PORTFOLIO_NEW}&nbsp;</td>
	</tr>
	<tr>
		<td colspan='3' class='fcaption' >&nbsp;</td>
	</tr>
</table>";
}

if (!isset($PORTFOLIO_DEPT_PROJ))
{
    $PORTFOLIO_DEPT_PROJ .= "
<table style='" . USER_WIDTH . "' class='fborder'>
	<tr>
		<td class='fcaption' colspan='2' style='vertical-align:top;'>{PORTFOLIO_DEPT_NAME}</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='2' style='vertical-align:top;'>{PORTFOLIO_PROJ_UPDIR}</td>
	</tr>
	<tr>
		<td colspan='2' class='forumheader2'><p style='text-align:center;font-weight:bold;font-size:16pt;'>{PORTFOLIO_DEPT_NAME}</p></td>
	</tr>";
        $PORTFOLIO_DEPT_PROJ .= "
	<tr>
		<td style='width:70%;vertical-align:top;' class='forumheader3' >{PORTFOLIO_DEPT_DESCRIPTION}</td>
		<td class='forumheader3' style='vertical-align:top;'><b>" . PORTFOLIO_27 . "</b><br />$portfolio_slist</td>
	</tr>";
    $PORTFOLIO_DEPT_PROJ .= "
	<tr>
		<td class='forumheader3' colspan='2'><span class='smalltext'>" . PORTFOLIO_7 . " {DEPT_DEPT_LASTUPDATED}</span></td>
	</tr>
		<tr>
		<td class='fcaption' colspan='2'>&nbsp;</td>
	</tr>
</table>";
}
// *
// * Deptdir Show the portfolio
// *
if (!isset($PORTFOLIO_DEPT_DEPT))
{
    $PORTFOLIO_DEPT_DEPT .= "
<table style='" . USER_WIDTH . "' class='fborder'>
	<tr>
		<td class='fcaption' colspan='2' style='vertical-align:top;'>{PORTFOLIO_DEPT_UPDIR}</td>
	</tr>
	<tr>
		<td colspan='2' class='forumheader2'><p style='text-align:center;font-weight:bold;font-size:16pt;'>{PORTFOLIO_DEPT_NAME}</p></td>
	</tr>";
    if (!empty($portfoliocat_imageurl))
    {
        $PORTFOLIO_DEPT_DEPT .= "
	<tr>
		<td colspan='2' class='forumheader3'><p style='text-align:center;'>{PORTFOLIO_DEPT_PICTURE}</p></td>
	</tr>";
    }
    if (!empty($portfoliocat_desctoptitle))
    {
        $PORTFOLIO_DEPT_DEPT .= "
	<tr>
		<td colspan='2' class='forumheader3' style='vertical-align:top;'><p style='text-align:center;'><b>{PORTFOLIO_DEPT_TOPTITLE}</b></p></td>
	</tr>";
    }
    if (!empty($portfoliocat_desctop))
    {
        $PORTFOLIO_DEPT_DEPT .= "
	<tr>
		<td colspan='2' class='forumheader3' style='vertical-align:top;'>{PORTFOLIO_DEPT_TOPDESC}</td>
	</tr>";
    }
    $PORTFOLIO_DEPT_DEPT .= "
	<tr>
		<td style='width:70%;vertical-align:top;' class='forumheader3' ><b>{PORTFOLIO_DEPT_LEFTTITLE}</b><br />{PORTFOLIO_DEPT_LEFTDESC}</td>
		<td class='forumheader3' style='vertical-align:top;'><b>" . PORTFOLIO_27 . "</b><br />$portfolio_slist</td>
	</tr>";

    if (!empty($portfoliocat_phone))
        $PORTFOLIO_DEPT_DEPT .= "
	<tr>
		<td colspan='2' class='forumheader3' style='vertical-align:top;'>" . PORTFOLIO_9 . "{PORTFOLIO_DEPT_PHONE}</td>
	</tr>";
    if (!empty($portfoliocat_email))
    {
        $PORTFOLIO_DEPT_DEPT .= "
	<tr>
		<td class='forumheader3' colspan='2'>" . PORTFOLIO_10 . "{DEPT_DEPT_EMAIL}</td>
	</tr>";
    }

    $PORTFOLIO_DEPT_DEPT .= "
	<tr>
		<td class='forumheader3' colspan='2'><span class='tinytext'>" . PORTFOLIO_7 . " {DEPT_DEPT_LASTUPDATED}</span></td>
	</tr>
		<tr>
		<td class='fcaption' colspan='2'>&nbsp;</td>
	</tr>
</table>";
}

if (!isset($PORTFOLIO_DEPT_STAFF))
{
    $PORTFOLIO_DEPT_STAFF .= "
<table style='" . USER_WIDTH . "' class='fborder'>
	<tr>
		<td class='fcaption' colspan='2' style='vertical-align:top;'>{PORTFOLIO_DEPT_NAME}</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='2' style='vertical-align:top;'>{PORTFOLIO_DEPT_STAFF_UPDIR}</td>
	</tr>
	<tr>
		<td colspan='2' class='forumheader2'><p style='text-align:center;font-weight:bold;font-size:16pt;'>{PORTFOLIO_DEPT_NAME}</p></td>
	</tr>";

    $PORTFOLIO_DEPT_STAFF .= "
	<tr>
		<td style='width:70%;vertical-align:top;' class='forumheader3' >{PORTFOLIO_DEPT_DESCRIPTION}</td>
		<td class='forumheader3' style='vertical-align:top;'><b>" . PORTFOLIO_6 . "</b><br />$portfolio_slist</td>
	</tr>";

    $PORTFOLIO_DEPT_STAFF .= "
	<tr>
		<td class='forumheader3' colspan='2'><span class='smalltext'>" . PORTFOLIO_7 . " {DEPT_DEPT_LASTUPDATED}</span></td>
	</tr>
		<tr>
		<td class='fcaption' colspan='2'>&nbsp;</td>
	</tr>
</table>";
}

if (!function_exists(PORTFOLIO_SHOW_HEADER))
{
    function PORTFOLIO_SHOW_HEADER($portfolio_id = 0, $portfolio_name = "")
    {
        global $portfolio_obj;
        $retval = "
<table style='" . USER_WIDTH . "' class='fborder'>
	<tr>
		<td class='fcaption' colspan='3' style='vertical-align:top;'>" . PORTFOLIO_40 . "{PORTFOLIO_STAFF_NAME}</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='3' style='vertical-align:top;'>{PORTFOLIO_STAFF_UPDIR} {PORTFOLIO_DEPT_PRINT} {PORTFOLIO_DEPT_EMAIL} {PORTFOLIO_DEPT_EDIT} {PORTFOLIO_DEPT_DELETE}</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='3'><p style='text-align:center;font-weight:bold;font-size:16pt;'>{PORTFOLIO_STAFF_NAME}</p></td>
	</tr>";
        if ($portfolio_obj->portfolio_rate)
        {
            $retval .= "
	<tr>
		<td class='forumheader3' colspan='3' style='vertical-align:top;text-align:center;'>{PORTFOLIO_STAFF_RATING}</td>
	</tr>";
        }
        $retval .= "
	<tr>
		<td class='forumheader3' colspan='1'>" . PORTFOLIO_9 . "  {PORTFOLIO_STAFF_PHONE} </td>
		<td class='forumheader3' colspan='2' rowspan='3' style='vertical-align:top;text-align:left;'>" . PORTFOLIO_34 . "<br />{PORTFOLIO_STAFF_CONTACT} </td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='3'>" . PORTFOLIO_10 . " {PORTFOLIO_STAFF_EMAIL}</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='3'>" . PORTFOLIO_32 . " {PORTFOLIO_STAFF_WEBSITE}</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='3' style='vertical-align:top;text-align:center;'><b>" . PORTFOLIO_CON_42 . "</b></td>
	</tr>
	<tr>
		<td class='forumheader3'  colspan='1' style='vertical-align:top;text-align:left;'>{PORTFOLIO_STAFF_AFFILIATE1}</td>
		<td class='forumheader3'  colspan='1' style='vertical-align:top;text-align:left;'>{PORTFOLIO_STAFF_AFFILIATE2}</td>
		<td class='forumheader3'  colspan='1' style='vertical-align:top;text-align:left;'>{PORTFOLIO_STAFF_AFFILIATE3}</td>
	</tr>
	<tr>
		<td class='forumheader2'  colspan='2' style='widvertical-align:top;text-align:center;'><b>" . PORTFOLIO_CON_43 . "</b></td>
		<td class='forumheader3'  colspan='1' style='vertical-align:top;text-align:center;'><b>" . PORTFOLIO_CON_44 . "</b></td>
	</tr>
	<tr>
		<td class='forumheader3'  colspan='2' style='vertical-align:top;text-align:left;'>{PORTFOLIO_STAFF_DETAILS}</td>
		<td class='forumheader3'  colspan='1' style='vertical-align:top;text-align:center;'>{PORTFOLIO_STAFF_PORTRAIT1}</td>
	</tr>
	<tr>
		<td class='forumheader3'  colspan='2' style='vertical-align:top;text-align:left;'>{PORTFOLIO_STAFF_ADDITIONAL}</td>
		<td class='forumheader3'  colspan='1' style='vertical-align:top;text-align:center;'>{PORTFOLIO_STAFF_PORTRAIT2}</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='3' style='vertical-align:top;text-align:center;'><b>" . PORTFOLIO_33 . "</b></td>
	</tr>
	<tr>
		<td class='forumheader3'   style='width:16%;vertical-align:top;text-align:center;'>{PORTFOLIO_STAFF_GALLERY1}</td>
		<td class='forumheader3'   style='width:16%;vertical-align:top;text-align:center;'>{PORTFOLIO_STAFF_GALLERY2}</td>
		<td class='forumheader3'   style='width:16%;vertical-align:top;text-align:center;'>{PORTFOLIO_STAFF_GALLERY3}</td>
	</tr>
	<tr>
		<td class='forumheader3'   style='width:16%;vertical-align:top;text-align:center;'>{PORTFOLIO_STAFF_GALLERY4}</td>
		<td class='forumheader3'   style='width:16%;vertical-align:top;text-align:center;'>{PORTFOLIO_STAFF_GALLERY5}</td>
		<td class='forumheader3'   style='width:16%;vertical-align:top;text-align:center;'>{PORTFOLIO_STAFF_GALLERY6}</td>
	</tr>
		<tr>
		<td class='forumheader3' colspan='3'><span class='smalltext'>" . PORTFOLIO_CON_45 . " {PORTFOLIO_STAFF_VIEWS} (" . PORTFOLIO_CON_46 . " {PORTFOLIO_STAFF_UNIQUE}) " . PORTFOLIO_7 . " {DEPT_DEPT_LASTUPDATED}</span></td>
	</tr>";
        if ($portfolio_obj->portfolio_comments)
        {
            $retval .= "
	<tr>
		<td class='forumheader3' colspan='3' >{PORTFOLIO_STAFF_COMMENTS}</td>
	</tr>";
        }
        $retval .= "

	<tr>
		<td class='fcaption' colspan='3'>&nbsp;</td>
	</tr>
</table>";
        return $retval;
    }
}
if (!function_exists(PORTFOLIO_PRINT_HEADER))
{
    function PORTFOLIO_PRINT_HEADER($portfolio_id = 0, $portfolio_name = "")
    {
        global $portfolio_obj;
        $retval = "
<table style='" . USER_WIDTH . "' class='fborder'>
	<tr>
		<td class='fcaption' colspan='6' style='vertical-align:top;'>" . PORTFOLIO_40 . "{PORTFOLIO_STAFF_NAME}</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='6'><p style='text-align:center;font-weight:bold;font-size:16pt;'>{PORTFOLIO_STAFF_NAME}</p></td>
	</tr>";
        if ($portfolio_obj->portfolio_rate)
        {
            $retval .= "
	<tr>
		<td class='forumheader3' colspan='3' style='vertical-align:top;text-align:center;'>{PORTFOLIO_STAFF_RATING}</td>
	</tr>";
        }
        $retval .= "
	<tr>
		<td class='forumheader3' colspan='1'>" . PORTFOLIO_9 . "  {PORTFOLIO_STAFF_PHONE} </td>
		<td class='forumheader3' colspan='1' rowspan='3' style='vertical-align:top;text-align:left;'>" . PORTFOLIO_34 . "<br />{PORTFOLIO_STAFF_CONTACT} </td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='1'>" . PORTFOLIO_10 . " {PORTFOLIO_STAFF_EMAIL}</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='1'>" . PORTFOLIO_32 . " {PORTFOLIO_STAFF_WEBSITE}</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='1' style='vertical-align:top;text-align:center;'><b>" . PORTFOLIO_CON_42 . "</b></td>
	</tr>
	<tr>
		<td class='forumheader3'  colspan='1' style='vertical-align:top;text-align:left;'>{PORTFOLIO_STAFF_AFFILIATE1}</td>
		<td class='forumheader3'  colspan='1' style='vertical-align:top;text-align:left;'>{PORTFOLIO_STAFF_AFFILIATE2}</td>
		<td class='forumheader3'  colspan='1' style='vertical-align:top;text-align:left;'>{PORTFOLIO_STAFF_AFFILIATE3}</td>
	</tr>
	<tr>
		<td class='forumheader2'  colspan='2' style='widvertical-align:top;text-align:center;'><b>" . PORTFOLIO_CON_43 . "</b></td>
		<td class='forumheader3'  colspan='1' style='vertical-align:top;text-align:center;'><b>" . PORTFOLIO_CON_44 . "</b></td>
	</tr>
	<tr>
		<td class='forumheader3'  colspan='2' style='vertical-align:top;text-align:left;'>{PORTFOLIO_STAFF_DETAILS}</td>
		<td class='forumheader3'  colspan='1' style='vertical-align:top;text-align:center;'>{PORTFOLIO_STAFF_PORTRAIT1=nolink}</td>
	</tr>
	<tr>
		<td class='forumheader3'  colspan='2' style='vertical-align:top;text-align:left;'>{PORTFOLIO_STAFF_ADDITIONAL}</td>
		<td class='forumheader3'  colspan='1' style='vertical-align:top;text-align:center;'>{PORTFOLIO_STAFF_PORTRAIT2=nolink}</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='3' style='vertical-align:top;text-align:center;'><b>" . PORTFOLIO_33 . "</b></td>
	</tr>
	<tr>
		<td class='forumheader3'   style='width:33%;vertical-align:top;text-align:center;'>{PORTFOLIO_STAFF_GALLERY1=nolink}</td>
		<td class='forumheader3'   style='width:33%;vertical-align:top;text-align:center;'>{PORTFOLIO_STAFF_GALLERY2=nolink}</td>
		<td class='forumheader3'   style='width:33%;vertical-align:top;text-align:center;'>{PORTFOLIO_STAFF_GALLERY3=nolink}</td>
	</tr>
	<tr>
		<td class='forumheader3'   style='width:33%;vertical-align:top;text-align:center;'>{PORTFOLIO_STAFF_GALLERY4=nolink}</td>
		<td class='forumheader3'   style='width:33%;vertical-align:top;text-align:center;'>{PORTFOLIO_STAFF_GALLERY5=nolink}</td>
		<td class='forumheader3'   style='width:33%;vertical-align:top;text-align:center;'>{PORTFOLIO_STAFF_GALLERY6=nolink}</td>
	</tr>
		<tr>
		<td class='forumheader3' colspan='3'><span class='smalltext'>" . PORTFOLIO_CON_45 . " {PORTFOLIO_STAFF_VIEWS} (" . PORTFOLIO_CON_46 . " {PORTFOLIO_STAFF_UNIQUE}) " . PORTFOLIO_7 . " {DEPT_DEPT_LASTUPDATED}</span></td>
	</tr>
	<tr>
		<td class='fcaption' colspan='3'>&nbsp;</td>
	</tr>
</table>";
        return $retval;
    }
}

if (!isset($PORTFOLIO_EDIT_PERSON))
{
    $PORTFOLIO_EDIT_PERSON = "
<table style='" . USER_WIDTH . "' class='fborder'>
		<tr>
			<td colspan='2' class='fcaption'>{PORTFOLIO_EDIT_CAPTION}</td>
		</tr>
		<tr>
			<td colspan='2' class='forumheader2'>{PORTFOLIO_EDIT_MAIN} {PORTFOLIO_EDIT_IMAGES} </td>
		</tr>
		<tr>
			<td id='portfolio_detailtab' style='display:block;'>
				<table style='width:100%;'>
					<tr>
						<td style='width:20%;vertical-align:top;' class='forumheader2'>" . PORTFOLIO_ED_013 . "</td>
						<td style='vertical-align:top;' class='forumheader2'>" . PORTFOLIO_ED_014 . "</td>
					</tr>
					<tr>
						<td style='vertical-align:top;' class='forumheader3'>" . PORTFOLIO_ED_035 . "</td>
						<td style='vertical-align:top;' class='forumheader3'>{PORTFOLIO_EDIT_NAME}</td>
					</tr>
					<tr>
						<td  style='vertical-align:top;' class='forumheader3'>" . PORTFOLIO_ED_032 . "</td>
						<td  style='vertical-align:top;' class='forumheader3'>{PORTFOLIO_EDIT_CATEGORY}
						</td>
					</tr>
					<tr>
						<td style='vertical-align:top;' class='forumheader3'>" . PORTFOLIO_ED_037 . "</td>
						<td style='vertical-align:top;' class='forumheader3'>{PORTFOLIO_EDIT_CONTACT}</td>
					</tr>
					<tr>
						<td  style='vertical-align:top;' class='forumheader3'>" . PORTFOLIO_ED_033 . "</td>
						<td style='vertical-align:top;' class='forumheader3'>{PORTFOLIO_EDIT_PHONE} " . PORTFOLIO_ED_038 . " {PORTFOLIO_EDIT_SHOWPHONE}</td>
					</tr>

					<tr>
						<td  style='vertical-align:top;' class='forumheader3'>" . PORTFOLIO_ED_034 . "</td>
						<td  style='vertical-align:top;' class='forumheader3'>{PORTFOLIO_EDIT_EMAIL} " . PORTFOLIO_ED_039 . " {PORTFOLIO_EDIT_SHOWEMAIL}</td>
					</tr>
					<tr>
						<td  style='vertical-align:top;' class='forumheader3'>" . PORTFOLIO_ED_005 . "</td>
						<td  style='vertical-align:top;' class='forumheader3'>{PORTFOLIO_EDIT_WEBSITE}
						</td>
					</tr>
					<tr>
						<td  style='vertical-align:top;' class='forumheader3'>" . PORTFOLIO_ED_006 . "</td>
						<td  style='vertical-align:top;' class='forumheader3'>{PORTFOLIO_EDIT_WEBURL}
						</td>
					</tr>
					<tr>
						<td  style='vertical-align:top;' class='forumheader3'>" . PORTFOLIO_ED_003 . "</td>
						<td  style='vertical-align:top;' class='forumheader3'>{PORTFOLIO_EDIT_AFFILIATE1}
						</td>
					</tr>
					<tr>
						<td  style='vertical-align:top;' class='forumheader3'>" . PORTFOLIO_ED_004 . "</td>
						<td  style='vertical-align:top;' class='forumheader3'>{PORTFOLIO_EDIT_AFFILIATE2}
						</td>
					</tr>
					<tr>
						<td  style='vertical-align:top;' class='forumheader3'>" . PORTFOLIO_ED_007 . "</td>
						<td  style='vertical-align:top;' class='forumheader3'>{PORTFOLIO_EDIT_AFFILIATE3}
						</td>
					</tr>
					<tr>
						<td  style='vertical-align:top;' class='forumheader3'>" . PORTFOLIO_ED_010 . "</td>
						<td  style='vertical-align:top;' class='forumheader3'>{PORTFOLIO_EDIT_VIDEO}
						</td>
					</tr>
					<tr>
						<td  style='vertical-align:top;' class='forumheader3'>" . PORTFOLIO_ED_011 . "</td>
						<td  style='vertical-align:top;' class='forumheader3'>{PORTFOLIO_EDIT_ATTACHMENT}<br /><i>" . PORTFOLIO_ED_012 . "</i>
						</td>
					</tr>
					<tr>
						<td  style='vertical-align:top;' class='forumheader3'>" . PORTFOLIO_ED_008 . "</td>
									<td  style='vertical-align:top;' class='forumheader3'>
							<textarea rows='8' cols='60' style='width:95%;' class='tbox' name='portfolio_person_biography' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>" . $tp->toFORM($portfolio_person_biography) . "</textarea><br />
									<input id='helpb' class='helpbox' type='text' name='helpb' size='100' style='width:97%'/><br />" . display_help("helpb") . "
						</td>
					</tr>
					<tr>
						<td  style='vertical-align:top;' class='forumheader3'>" . PORTFOLIO_ED_009 . "</td>
						<td  style='vertical-align:top;' class='forumheader3'>
							<textarea rows='8' cols='60' style='width:95%;' class='tbox' name='portfolio_person_additional' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>$portfolio_person_additional</textarea><br />
								<div style='text-align:left'>
            						<input id='helpc' class='helpbox' type='text' name='helpc' size='100' style='width:97%'/><br />" . display_help("helpc") . "
             					</div>
						</td>
					</tr>
				</table>
			</td>
			<td id='portfolio_imagetab' style='display:none;'>
				<table style='width:100%;'>
					<tr>
						<td class='forumheader2' colspan='2'>" . PORTFOLIO_ED_029 . " " . PORTFOLIO_ED_030 . " " . PORTFOLIO_ED_031 . "</td>
					</tr>
					<tr>
						<td class='forumheader' colspan='2'>" . PORTFOLIO_ED_017 . "</td>
					</tr>
					<tr>
						<td class='forumheader3' style='width:25%;' >" . PORTFOLIO_ED_018 . "</td>
						<td class='forumheader3'>{PORTFOLIO_EDIT_PORTRAIT1}<br /><br />{PORTFOLIO_EDIT_PORTRAIT_TEXT1}</td>
					</tr>
					<tr>
						<td class='forumheader3' style='width:25%;' >" . PORTFOLIO_ED_019 . "</td>
						<td class='forumheader3'>{PORTFOLIO_EDIT_PORTRAIT2}<br /><br />{PORTFOLIO_EDIT_PORTRAIT_TEXT2}</td>
					</tr>
					<tr>
						<td class='forumheader' colspan='2'>" . PORTFOLIO_ED_020 . "</td>
					</tr>
					<tr>
						<td class='forumheader3' >" . PORTFOLIO_ED_021 . "</td>
						<td class='forumheader3' >{PORTFOLIO_EDIT_GALLERY1}<br /><br />{PORTFOLIO_EDIT_GALLERY_TEXT1}</td>
					</tr>
					<tr>
						<td class='forumheader3' >" . PORTFOLIO_ED_022 . "</td>
						<td class='forumheader3' >{PORTFOLIO_EDIT_GALLERY2}<br /><br />{PORTFOLIO_EDIT_GALLERY_TEXT2}</td>
					</tr>
					<tr>
						<td class='forumheader3' >" . PORTFOLIO_ED_023 . "</td>
						<td class='forumheader3' >{PORTFOLIO_EDIT_GALLERY3}<br /><br />{PORTFOLIO_EDIT_GALLERY_TEXT3}</td>
					</tr>
					<tr>
						<td class='forumheader3' >" . PORTFOLIO_ED_024 . "</td>
						<td class='forumheader3' >{PORTFOLIO_EDIT_GALLERY4}<br /><br />{PORTFOLIO_EDIT_GALLERY_TEXT4}</td>
					</tr>
					<tr>
						<td class='forumheader3' >" . PORTFOLIO_ED_025 . "</td>
						<td class='forumheader3' >{PORTFOLIO_EDIT_GALLERY5}<br /><br />{PORTFOLIO_EDIT_GALLERY_TEXT5}</td>
					</tr>
					<tr>
						<td class='forumheader3' >" . PORTFOLIO_ED_026 . "</td>
						<td class='forumheader3' >{PORTFOLIO_EDIT_GALLERY6}<br /><br />{PORTFOLIO_EDIT_GALLERY_TEXT6}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan='3' class='fcaption'><input type='submit' name='portfolio_submit' value='" . PORTFOLIO_ED_036 . "' class='tbox' /></td>
		</tr>
	</table>";
}

if (!isset($PORTFOLIO_DELETE))
{
    $PORTFOLIO_DELETE="

<table style='" . USER_WIDTH . "' class='fborder'>
	<tr>
		<td class='fcaption' style='vertical-align:top;'>" . PORTFOLIO_40 . "{PORTFOLIO_STAFF_NAME}</td>
	</tr>

	<tr>
		<td class='forumheader3' style='text-align:center;'>".PORTFOLIO_44." {PORTFOLIO_STAFF_NAME}<br /><br />{PORTFOLIO_STAFF_DELETE} &nbsp;&nbsp;{PORTFOLIO_STAFF_CANCEL}</td>
	</tr>
	<tr>
		<td class='fcaption'  style='vertical-align:top;'>&nbsp;</td>
	</tr>
</table>";
}
if (!isset($PORTFOLIO_NODELETE))
{
    $PORTFOLIO_NODELETE="

<table style='" . USER_WIDTH . "' class='fborder'>
	<tr>
		<td class='fcaption' style='vertical-align:top;'>" . PORTFOLIO_46 . "</td>
	</tr>

	<tr>
		<td class='forumheader3' style='text-align:center;'>".PORTFOLIO_45." </td>
	</tr>
	<tr>
		<td class='fcaption'  style='vertical-align:top;'>&nbsp;</td>
	</tr>
</table>";
}
?>