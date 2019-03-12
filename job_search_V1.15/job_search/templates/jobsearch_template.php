<?php

if (!defined('e107_INIT'))
{
    exit;
}
if (!defined("USER_WIDTH"))
{
    define("USER_WIDTH", "width:100%");
}
global $jobsearch_shortcodes;
// **********************************************************************************************************
if (!isset($JOBSCH_NCAT_HEADER))
{
    $JOBSCH_NCAT_HEADER = "
	<table style='" . USER_WIDTH . ";' class='fborder'>
    	<tr>
    		<td class='fcaption' colspan='5'>" . JOBSCH_137 . "</td>
    	</tr>
";
    if (defined("JOBSCH_LOGO"))
    {
        $JOBSCH_NCAT_HEADER .= "
		<tr>
			<td class='forumheader2' colspan='5' ><div style='text-align:center;'>{JOBLOGO}</div></td>
		</tr>";
    }
    $JOBSCH_NCAT_HEADER .= "
		<tr>
			<td class='forumheader2'  colspan='5' style='width:30%;text-align:left;' ><img src='./images/blank.png' alt='' />&nbsp;</td>
		</tr>";
    if ($jobsch_obj->jobsch_topmessage)
    {
        $JOBSCH_NCAT_HEADER .= "
		<tr>
			<td class='forumheader2' colspan='5' ><div style='text-align:left;'>{JOBTOPMESSAGE}</div></td>
		</tr>";
    }
    $JOBSCH_NCAT_HEADER .= "
		<tr>
			<td class='forumheader2' colspan='5' ><div style='text-align:left;'>" . JOBSCH_100 . " {JOBLOCALSELECTOR}</div></td>
		</tr>
    	<tr>
    		<td class='forumheader2'  >" . JOBSCH_6 . "</td>
    		<td class='forumheader2'  >" . JOBSCH_60 . "</td>
    		<td class='forumheader2'  >" . JOBSCH_71 . "</td>
    		<td class='forumheader2'  >" . JOBSCH_116 . "</td>
    		<td class='forumheader2'  >" . JOBSCH_16 . "</td>
    	</tr>";
}
if (!isset($JOBSCH_NCAT_DETAIL))
{
    $JOBSCH_NCAT_DETAIL = "
    	<tr>
    		<td class='forumheader3'  ><div style='text-align:left;'>{JOBTITLE=item}</div></td>
    		<td class='forumheader3'  ><div style='text-align:left;'>{JOBSALARY}</div></td>
    		<td class='forumheader3'  ><div style='text-align:left;'>{JOBCOMPANY}</div></td>
    		<td class='forumheader3'  ><div style='text-align:left;'>{JOBEXPIRES}</div></td>
    		<td class='forumheader3'  ><div style='text-align:left;'>{JOBEXPIRES}</div></td>
    	</tr>
";
}
if (!isset($JOBSCH_NCAT_FOOTER))
{
    $JOBSCH_NCAT_FOOTER = "
    	<tr>
    		<td class='forumheader2' colspan='5'>{JOB_NEXTPREV}&nbsp;{JOBMANAGE=button}&nbsp;{JOBTC=button}&nbsp;{JOBSUBSCRIBE=button}</td>
    	</tr>
    	<tr>
    		<td class='fcaption' colspan='5'>&nbsp;</td>
    	</tr>
	</table>";
}
// **********************************************************************************************************
if (!isset($JOBSCH_CAT_HEADER))
{
    $JOBSCH_CAT_HEADER = "
	<table style='" . USER_WIDTH . ";' class='fborder'>
    	<tr>
    		<td class='fcaption' colspan='3'>" . JOBSCH_137 . "</td>
    	</tr>
";
    if (defined("JOBSCH_LOGO"))
    {
        $JOBSCH_CAT_HEADER .= "
		<tr>
			<td class='forumheader2' colspan='3' ><div style='text-align:center;'>{JOBLOGO}</div></td>
		</tr>";
    }
    $JOBSCH_CAT_HEADER .= "
		<tr>
			<td class='forumheader2'  colspan='3' style='width:30%;text-align:left;' ><img src='./images/blank.png' alt='' />&nbsp;</td>
		</tr>";
    if ($jobsch_obj->jobsch_topmessage)
    {
        $JOBSCH_CAT_HEADER .= "
		<tr>
			<td class='forumheader2' colspan='3' ><div style='text-align:left;'>{JOBTOPMESSAGE}</div></td>
		</tr>";
    }
    $JOBSCH_CAT_HEADER .= "
		<tr>
			<td class='forumheader2' colspan='3' ><div style='text-align:left;'>" . JOBSCH_100 . " {JOBLOCALSELECTOR}</div></td>
		</tr>
		<tr>
			<td class='forumheader2' style='width:10%;'>&nbsp;</td>
			<td class='forumheader2' style='width:60%;'><strong>" . JOBSCH_2 . "</strong></td>
			<td class='forumheader2' style='text-align:right;width:30%;'><strong>{JOB_SUBCATHEAD}</strong></td>
		</tr>";
}
if (!isset($JOBSCH_CAT_DETAIL))
{
    $JOBSCH_CAT_DETAIL = "
		<tr>
			<td class='forumheader3' style='width:10%;text-align:center;vertical-align:top;'>{JOBCATICON}</td>
			<td class='forumheader3' style='width:60%;text-align:left;vertical-align:top;'>{JOBCATNAME}<br /><em>{JOBCATDESC}</em></td>
			<td class='forumheader3' style='width:30%;text-align:right;vertical-align:top;'>{JOBSUBLIST}</td>
		</tr>";
}
if (!isset($JOBSCH_CAT_FOOTER))
{
    $JOBSCH_CAT_FOOTER = "
    	<tr>
    		<td class='forumheader2' colspan='3'>{JOB_NEXTPREV}&nbsp;{JOBMANAGE=button}&nbsp;{JOBTC=button}&nbsp;{JOBSUBSCRIBE=button}</td>
    	</tr>
    	<tr>
    		<td class='fcaption' colspan='3'>&nbsp;</td>
    	</tr>
	</table>";
}
// not using icons
if (!isset($JOBSCH_CATNOICON_HEADER))
{
    $JOBSCH_CATNOICON_HEADER = "
	<table class='fborder' style='" . USER_WIDTH . ";'>
	    <tr>
    		<td class='fcaption' colspan='2'>" . JOBSCH_137 . "</td>
    	</tr>";
    if (defined("JOBSCH_LOGO"))
    {
        $JOBSCH_CATNOICON_HEADER .= "
		<tr>
			<td class='forumheader2' colspan='2' ><div style='text-align:center;'>{JOBLOGO}</div></td>
		</tr>";
    }
    $JOBSCH_CATNOICON_HEADER .= "
		<tr>
			<td class='forumheader2'  colspan='2' style='width:30%;text-align:left;' ><img src='./images/blank.png' alt='' />&nbsp;</td>
		</tr>";
    if ($jobsch_obj->jobsch_topmessage)
    {
        $JOBSCH_CATNOICON_HEADER .= "
		<tr>
			<td class='forumheader2' colspan='2' ><div style='text-align:left;'>{JOBTOPMESSAGE}</div></td>
		</tr>";
    }
    $JOBSCH_CATNOICON_HEADER .= "
		<tr>
			<td class='forumheader2' colspan='2' ><div style='text-align:left;'>" . JOBSCH_100 . " {JOBLOCALSELECTOR}</div></td>
		</tr>

		<tr>
			<td class='forumheader2' style='width:60%;'><strong>" . JOBSCH_2 . "</strong></td>
			<td class='forumheader2' style='text-align:right;width:30%;'><strong>{JOB_SUBCATHEAD}</strong></td>
		</tr>";
}
if (!isset($JOBSCH_CATNOICON_DETAIL))
{
    $JOBSCH_CATNOICON_DETAIL = "
		<tr>
			<td class='forumheader3' style='width:60%;text-align:left;vertical-align:top;'>{JOBCATNAME}<br /><em>{JOBCATDESC}</em></td>
			<td class='forumheader3' style='width:30%;text-align:right;vertical-align:top;'>{JOBSUBLIST}</td>
		</tr>";
}
if (!isset($JOBSCH_CATNOICON_FOOTER))
{
    $JOBSCH_CATNOICON_FOOTER = "
    	<tr>
    		<td class='forumheader2' colspan='2'>{JOB_NEXTPREV}&nbsp;{JOBMANAGE=button}&nbsp;{JOBTC=button}&nbsp;{JOBSUBSCRIBE=button}</td>
    	</tr>
    	<tr>
    		<td class='fcaption' colspan='2'>&nbsp;</td>
    	</tr>
	</table>";
}
// Sub Category Display
// template if using icons
if (!isset($JOBSCH_SUB_HEADER))
{
    $JOBSCH_SUB_HEADER = "
	<table class='fborder' style='" . USER_WIDTH . ";'>
		<tr>
			<td class='fcaption' colspan='3' >" . JOBSCH_136 . "</td>
		</tr>
		";
    if (defined("JOBSCH_LOGO"))
    {
        $JOBSCH_SUB_HEADER .= "
		<tr>
			<td class='forumheader2' colspan='3' ><div style='text-align:center;'>{JOBLOGO}</div></td>
		</tr>";
    }
    $JOBSCH_SUB_HEADER .= "
		<tr>
			<td class='forumheader2'  colspan='3' style='width:30%;text-align:left;' >{JOBUPPAGE=icon}&nbsp;&nbsp;{JOBCATNAME=nolink}</td>
		</tr>";
    if ($jobsch_obj->jobsch_topmessage)
    {
        $JOBSCH_SUB_HEADER .= "
		<tr>
			<td class='forumheader2' colspan='3' ><div style='text-align:left;'>{JOBTOPMESSAGE}</div></td>
		</tr>";
    }
    $JOBSCH_SUB_HEADER .= "
		<tr>
			<td class='forumheader2' colspan='3' ><div style='text-align:left;'>" . JOBSCH_100 . " {JOBLOCALSELECTOR}</div></td>
		</tr>

		<tr>
			<td class='forumheader2' style='width:10%;'>&nbsp;</td>
			<td class='forumheader2' style='width:60%;'><strong>" . JOBSCH_5 . "</strong></td>
			<td class='forumheader2' style='width:30%;text-align:right;'><strong>" . JOBSCH_6 . "</strong></td>
		</tr>";
}
if (!isset($JOBSCH_SUB_DETAIL))
{
    $JOBSCH_SUB_DETAIL = "
		<tr>
			<td class='forumheader3' style='width:10%;text-align:left;'>{JOBSUBICON}</td>
			<td class='forumheader3' style='width:60%;text-align:left;'>{JOBSUBNAME}</td>
			<td class='forumheader3' style='width:30%;text-align:right;'>{JOBSUBJOBCOUNT}</td>
		</tr>";
}
if (!isset($JOBSCH_SUB_FOOTER))
{
    $JOBSCH_SUB_FOOTER = "
		<tr>
			<td class='forumheader2' colspan='3'>{JOB_NEXTPREV}&nbsp;{JOBMANAGE=button}&nbsp;{JOBTC=button}&nbsp;&nbsp;{JOBSUBSCRIBE=button}</td>
		</tr>
    	<tr>
    		<td class='fcaption' colspan='3'>&nbsp;</td>
    	</tr>
		</table>";
}

if (!isset($JOBSCH_SUBNOICON_HEADER))
{
    $JOBSCH_SUBNOICON_HEADER = "
	<table class='fborder' style='" . USER_WIDTH . ";'>
			<tr>
			<td class='fcaption' colspan='2' >" . JOBSCH_136 . "</td>
		</tr>
";
    if (defined("JOBSCH_LOGO"))
    {
        $JOBSCH_SUBNOICON_HEADER .= "
		<tr>
			<td class='forumheader2' colspan='2' ><div style='text-align:center;'>{JOBLOGO}</div></td>
		</tr>";
    }
    $JOBSCH_SUBNOICON_HEADER .= "
		<tr>
			<td class='forumheader2'  colspan='2' style='width:30%;text-align:left;' >{JOBUPPAGE=icon}&nbsp;&nbsp;{JOBCATNAME=nolink}</td>
		</tr>";
    if ($jobsch_obj->jobsch_topmessage)
    {
        $JOBSCH_SUBNOICON_HEADER .= "
		<tr>
			<td class='forumheader2' colspan='2' ><div style='text-align:left;'>{JOBTOPMESSAGE}</div></td>
		</tr>";
    }
    $JOBSCH_SUBNOICON_HEADER .= "
		<tr>
			<td class='forumheader2' colspan='2' ><div style='text-align:left;'>" . JOBSCH_100 . " {JOBLOCALSELECTOR}</div></td>
		</tr>

		<tr>

			<td class='forumheader2' style='width:60%;'><strong>" . JOBSCH_5 . "</strong></td>
			<td class='forumheader2' style='width:30%;text-align:right;'><strong>" . JOBSCH_6 . "</strong></td>
		</tr>";
}
if (!isset($JOBSCH_SUBNOICON_DETAIL))
{
    $JOBSCH_SUBNOICON_DETAIL = "
		<tr>
			<td class='forumheader3' style='width:60%;text-align:left;'>{JOBSUBNAME}</td>
			<td class='forumheader3' style='width:30%;text-align:right;'>{JOBSUBJOBCOUNT}</td>
		</tr>";
}
if (!isset($JOBSCH_SUBNOICON_FOOTER))
{
    $JOBSCH_SUBNOICON_FOOTER = "
		<tr>
			<td class='forumheader2' colspan='2'>{JOB_NEXTPREV}&nbsp;{JOBMANAGE=button}&nbsp;{JOBTC=button}&nbsp;&nbsp;{JOBSUBSCRIBE=button}</td>
		</tr>
    	<tr>
    		<td class='fcaption' colspan='2'>&nbsp;</td>
    	</tr>
		</table>";
}

if (!isset($JOBSCH_LIST_HEADER))
{
    $JOBSCH_LIST_HEADER = "
	<table class='fborder' style='" . USER_WIDTH . ";'>
    	<tr>
    		<td class='fcaption' colspan='5'>" . JOBSCH_135 . "</td>
    	</tr>
";
    if (defined("JOBSCH_LOGO"))
    {
        $JOBSCH_LIST_HEADER .= "
		<tr>
			<td class='forumheader2' colspan='5' ><div style='text-align:center;'>{JOBLOGO}</div></td>
		</tr>";
    }
    $JOBSCH_LIST_HEADER .= "
		<tr>
			<td class='forumheader2'  colspan='5' style='width:30%;text-align:left;' >{JOBUPPAGE=icon}&nbsp;&nbsp;{JOBCATNAME=nolink}&nbsp;-&nbsp;{JOBSUBNAME=nolink}</td>
		</tr>";
    if ($jobsch_obj->jobsch_topmessage)
    {
        $JOBSCH_LIST_HEADER .= "
		<tr>
			<td class='forumheader2' colspan='5' ><div style='text-align:left;'>{JOBTOPMESSAGE}</div></td>
		</tr>";
    }
    $JOBSCH_LIST_HEADER .= "
		<tr>
			<td class='forumheader2' colspan='5' ><div style='text-align:left;'>" . JOBSCH_100 . " {JOBLOCALSELECTOR}</div></td>
		</tr>

		<tr>
			<td class='forumheader2' style='width:40%;'><strong>" . JOBSCH_15 . "</strong></td>
			<td class='forumheader2' style='width:10%;text-align:right;'><strong>" . JOBSCH_60 . " {CURRENCY_SYMBOL}</strong></td>
			<td class='forumheader2' style='width:30%;text-align:left;'><strong>" . JOBSCH_28 . "</strong></td>
			<td class='forumheader2' style='width:10%;'><strong>" . JOBSCH_116 . "</strong></td>
			<td class='forumheader2' style='width:10%;'><strong>" . JOBSCH_16 . "</strong></td>
		</tr>";
}
if (!function_exists("JOBSCH_LIST_DETAIL"))
{
    function JOBSCH_LIST_DETAIL($jobsch_cid = 0, $jobsch_name = "")
    {
        $retval = "
		<tr>
			<td class='forumheader3' style='width:40%;text-align:left;'>{JOBTITLE=item}</td>
			<td class='forumheader3' style='width:10%;text-align:right;'>{JOBSALARY}</td>
			<td class='forumheader3' style='width:30%;text-align:left;'>{JOBCOMPANY}</td>
			<td class='forumheader3' style='width:10%;text-align:left;'><span class='smallblacktext'>{JOBPOSTDATE=j M Y}</span></td>
			<td class='forumheader3' style='width:10%;text-align:left;'><span class='smallblacktext'>{JOBEXPIRES=j M Y}</span></td>
		</tr>";
        return $retval;
    }
}
if (!isset($JOBSCH_LIST_FOOTER))
{
    $JOBSCH_LIST_FOOTER = "
		<tr>
			<td class='forumheader2' colspan='5'>{JOB_NEXTPREV}&nbsp;{JOBMANAGE=button}&nbsp;{JOBTC=button}&nbsp;{JOBSUBSCRIBE=button}</td>
		</tr>
    	<tr>
    		<td class='fcaption' colspan='5'>&nbsp;</td>
    	</tr>
	</table>";
}

if (!isset($JOBSCH_ITEM_HEADER))
{
    // global $jobsch_catid,$jobsch_subid,$jobsch_itemid,$jobsch_tmp,$jobsch_local;
    $JOBSCH_ITEM_HEADER = "
	<div class='fborder' style='" . USER_WIDTH . ";' >
	<table style='" . USER_WIDTH . ";'>
		<tr>
			<td class='fcaption' colspan='2'>" . JOBSCH_45 . " - <strong>{JOBCATNAME=nolink}</strong>: " . JOBSCH_91 . "<strong>{JOBSUBNAME=nolink}</strong></td>
		</tr>
";
    if (defined("JOBSCH_LOGO"))
    {
        $JOBSCH_ITEM_HEADER .= "
		<tr>
			<td class='forumheader2' colspan='2' ><div style='text-align:center;'>{JOBLOGO}</div></td>
		</tr>";
    }
    $JOBSCH_ITEM_HEADER .= "
		<tr>
			<td class='forumheader2'  colspan='2' style='width:30%;text-align:left;' >{JOBUPPAGE=icon}&nbsp;&nbsp;{JOBEMAILLINK=icon}&nbsp;&nbsp;{JOBPRINT=icon}&nbsp;&nbsp;{JOB_PM=icon}</td>
		</tr>";
    if ($jobsch_obj->jobsch_topmessage)
    {
        $JOBSCH_ITEM_HEADER .= "
		<tr>
			<td class='forumheader2' colspan='2' ><div style='text-align:left;'>{JOBTOPMESSAGE}</div></td>
		</tr>";
    }
}
if (!function_exists("JOBSCH_ITEM_DETAIL"))
{
    function JOBSCH_ITEM_DETAIL($jobsch_cid = 0, $jobsch_name = "")
    {
        $retval = "
		<tr>
			<td class='forumheader3' style='width:20%;'>" . JOBSCH_7 . "</td>
			<td class='forumheader3'>{JOBTITLE}</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:20%;'>" . JOBSCH_118 . "</td>
			<td class='forumheader3'>{JOBREFERENCE}</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:20%;'>" . JOBSCH_8 . "</td>
			<td class='forumheader3'>{JOBCOMPANY}</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:20%;'>" . JOBSCH_119 . "</td>
			<td class='forumheader3'>{JOBEMPREF}</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:20%;'>" . JOBSCH_10 . "</td>
			<td class='forumheader3'>{JOBDETAILS}</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:20%;'>" . JOBSCH_100 . "</td>
			<td class='forumheader3'>{JOBLOCALITY}</td>
		</tr>

		<tr>
			<td class='forumheader3' style='width:20%;'>" . JOBSCH_60 . "</td>
			<td class='forumheader3'>{JOBSALARY}</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:30%;'>" . JOBSCH_12 . "</td>
			<td class='forumheader3'>{JOBPHONE}</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:30%;'>" . JOBSCH_13 . "</td>
			<td class='forumheader3'>{JOBEMAIL}</td>
		</tr>

		<tr>
			<td class='forumheader3' style='width:20%;'>" . JOBSCH_102 . "</td>
			<td class='forumheader3'>{JOBEMPLOYERDETAILS}</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:20%;'>" . JOBSCH_9 . "</td>
			<td class='forumheader3'>{JOBDOWNLOAD}</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:20%;'>" . JOBSCH_120 . "</td>
			<td class='forumheader3'>{JOBEXPIRES=D jS F Y}</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:20%;'>" . JOBSCH_115 . "</td>
			<td class='forumheader3'>{JOBPOSTDATE=D jS F Y}</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:20%;'>" . JOBSCH_132 . "</td>
			<td class='forumheader3'>{JOBPOSTER=link}</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:20%;'>" . JOBSCH_86 . "</td>
			<td class='forumheader3'>{JOBVIEWS}</td>
		</tr>";
        return $retval;
    }
}
if (!isset($JOBSCH_ITEM_FOOTER))
{
    $JOBSCH_ITEM_FOOTER = "
    	<tr>
			<td class='forumheader2' colspan='2'>{JOBMANAGE=button}&nbsp;{JOBTC=button}&nbsp;{JOBSUBSCRIBE=button}</td>
		</tr>
		<tr>
				<td class='fcaption' colspan='2'>&nbsp;</td>
		</tr>
		</table>
	</div>";
}

if (!isset($JOBSCH_TC_HEADER))
{
    $JOBSCH_TC_HEADER = "
	<div class='fborder' style='" . USER_WIDTH . ";' >
	<table style='" . USER_WIDTH . ";'>
	<tr>
		<td class='fcaption'>" . JOBSCH_41 . "</td>
	</tr>
	<tr>
		<td class='forumheader2' style='width:30%;text-align:left;' >{JOBUPPAGE=icon}</td>
	</tr>
";
    if (defined("JOBSCH_LOGO"))
    {
        $JOBSCH_TC_HEADER .= "
		<tr>
			<td class='forumheader2'  ><div style='text-align:center;'>{JOBLOGO}</div></td>
		</tr>";
    }
}
if (!isset($JOBSCH_TC_DETAIL))
{
    $JOBSCH_TC_DETAIL = "
	<tr>
		<td class='forumheader2' style='width:70%;'><strong>" . JOBSCH_41 . "</strong></td>
	</tr>
	<tr>
		<td class='forumheader3'>{JOBTERMS}</td>
	</tr>";
}
if (!isset($JOBSCH_TC_FOOTER))
{
    $JOBSCH_TC_FOOTER = "
	</table>
	</div>";
}

if (!isset($JOBSCH_SUBS_HEADER))
{
    $JOBSCH_SUBS_HEADER = "
	<div class='fborder' style='" . USER_WIDTH . ";' >
	<table style='" . USER_WIDTH . ";'>
	<tr>
		<td class='fcaption'>" . JOBSCH_106 . "</td>
	</tr>
	<tr>
		<td class='forumheader2' style='width:30%;text-align:left;' >{JOBUPPAGE=icon}</td>
	</tr>
";
    if (defined("JOBSCH_LOGO"))
    {
        $JOBSCH_SUBS_HEADER .= "
		<tr>
			<td class='forumheader2' ><div style='text-align:center;'>{JOBLOGO}</div></td>
		</tr>";
    }
    $JOBSCH_SUBS_HEADER .= "
	<tr>
		<td class='forumheader3'><div style='text-align:left;'>{JOBSUBNOTE}</div></td>
	</tr>
	";
}
if (!isset($JOBSCH_SUBS_DETAIL))
{
    $JOBSCH_SUBS_DETAIL = "
	<tr>
		<td class='forumheader3'>{JOBSUBME}</td>
	</tr>";
}
if (!isset($JOBSCH_SUBS_FOOTER))
{
    $JOBSCH_SUBS_FOOTER = "
    <tr>
		<td class='forumheader2' style='width:30%;text-align:left;' >{JUBSUBOK}</td>
	</tr>
	</table>
	</div>";
}
if (!isset($JOBSCH_SUBS_UNSUB))
{
    $JOBSCH_SUBS_UNSUB = "
<table class='fborder' style='" . USER_WIDTH . "' >
    <tr>
		<td class='fcaption' >" . JOBSCH_141 . "</td>
	</tr>

    <tr>
		<td class='forumheader2' style='width:30%;text-align:left;' >{JOBSUB_UNSUB}</td>
	</tr>
    <tr>
		<td class='fcaption' >&nbsp;</td>
	</tr>
</table>";
}

$sc_style['JOBSCH_ATTACHMENT']['pre'] = "
<tr>
	<td class='forumheader3'>".JOBSCH_PM09.": </td>
	<td class='forumheader3'>
";
$sc_style['JOBSCH_ATTACHMENT']['post'] = "</td></tr>";

if (!isset($JOBSCH_PM_HEADER))
{
    $JOBSCH_PM_HEADER = "
<table class='fborder' style='" . USER_WIDTH . "' >
    <tr>
		<td class='fcaption' colspan='2'  >" . JOBSCH_PM01 . "</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='2' >{JOBPM_UPDIR}&nbsp;</td>
	</tr>
    <tr>
		<td class='forumheader3' style='width:30%;text-align:left;' >".JOBSCH_PM02."</td>
		<td class='forumheader3' style='text-align:left;' >{JOBPM_TO}</td>
	</tr>
    <tr>
		<td class='forumheader3' style='width:30%;text-align:left;' >".JOBSCH_PM03."</td>
		<td class='forumheader3' style='text-align:left;' >{JOBPM_SUBJECT}</td>
	</tr>
    <tr>
		<td class='forumheader3' style='width:30%;text-align:left;' >".JOBSCH_PM04."</td>
		<td class='forumheader3' style='text-align:left;' >{JOBPM_MESSAGE}</td>
	</tr>
{JOBSCH_ATTACHMENT}
    <tr>
		<td class='forumheader2' colspan='2' >{JOBPM_SEND}</td>
	</tr>
    <tr>
		<td class='fcaption' colspan='2' >&nbsp;</td>
	</tr>
</table>";
}
