<?php

if (!defined('e107_INIT'))
{
    exit;
}
if (!defined('USER_WIDTH'))
{
    define(USER_WIDTH, "width:100%;");
}
global $otd_shortcodes;
// ********************************************************************************************
// *
// * Template area for showing an days events
// *
// ********************************************************************************************
if ($OTD_PREF['otd_showall'] == 1)
{
    // showall on so we have a calenday
    if (!isset($OTD_DAY_HEAD))
    {
        $OTD_DAY_HEAD = '
<table class="fborder" style="' . USER_WIDTH . '">
   	<tr>
   		<td class="fcaption" >{OTD_DAY_TITLE}</td>
	</tr>';

        if (defined('OTD_LOGO'))
        {
            $OTD_DAY_HEAD .= '
	   	<tr>
   		<td class="forumheader2"  style="text-align:center;"  ><img src="' . OTD_LOGO . '" alt="logo" title="logo" style="border:0px" /></td>
	</tr>';
        }
    }
    if (!isset($OTD_DAY_DETAIL))
    {
        $OTD_DAY_DETAIL = '
	<tr>
		<td class="forumheader3">{OTD_YEAR} - <b>{OTD_TITLE}</b><br />{OTD_BODY}</td>
	</tr>';
    }
    if (!isset($OTD_DAY_FOOTER))
    {
        $OTD_DAY_FOOTER = '
	<tr>
		<td class="forumheader3" style="width:100%;text-align:center;margin-left:auto;margin-right:auto;" >{OTD_CALENDAR}</td>
	</tr>
    <tr>
		<td class="forumheader3">{OTD_MANAGE}</td>
	</tr>
	<tr>
		<td class="fcaption">&nbsp;</td>
	</tr>
</table>';
    }

    if (!isset($OTD_DAY_NOREC))
    {
        $OTD_DAY_NOREC = '
<table class="fborder" style="' . USER_WIDTH . '">
   	<tr>
   		<td class="fcaption">{OTD_DAY_TITLE}</td>
	</tr>
	<tr>
		<td class="forumheader3">' . OTDLAN_DEFAULT . '</td>
	</tr>
		<tr>
		<td class="forumheader3">{OTD_CALENDAR}</td>
	</tr>
    <tr>
		<td class="forumheader3">{OTD_MANAGE}</td>
	</tr>
	<tr>
		<td class="fcaption">&nbsp;</td>
	</tr>
</table>';
    }
    if (!isset($OTD_DAY_NOTPERMITTED))
    {
        $OTD_DAY_NOTPERMITTED = '
<table class="fborder" style="' . USER_WIDTH . '">
   	<tr>
   		<td class="fcaption">{OTD_DAY_TITLE}</td>
	</tr>
	<tr>
		<td class="forumheader3">' . OTD_01 . '</td>
	</tr>
	<tr>
		<td class="fcaption">&nbsp;</td>
	</tr>
</table>';
    }
}
else
{
    if (!isset($OTD_DAY_HEAD))
    {
        $OTD_DAY_HEAD = '
<table class="fborder" style="' . USER_WIDTH . '">
   	<tr>
   		<td class="fcaption">{OTD_DAY_TITLE}</td>
	</tr>';
        if (defined('OTD_LOGO'))
        {
            $OTD_DAY_HEAD .= '
	   	<tr>
   		<td class="forumheader2"  style="text-align:center;"  ><img src="' . OTD_LOGO . '" alt="logo" title="logo" style="border:0px" /></td>
	</tr>';
        }
    }
    if (!isset($OTD_DAY_DETAIL))
    {
        $OTD_DAY_DETAIL = '
	<tr>
		<td class="forumheader3">{OTD_YEAR} - <b>{OTD_TITLE}</b><br />{OTD_BODY}</td>
	</tr>';
    }
    if (!isset($OTD_DAY_FOOTER))
    {
        $OTD_DAY_FOOTER = '
    	<tr>
		<td class="forumheader3" style="width:100%;text-align:center;" >{OTD_MANAGE}</td>
	</tr>
	<tr>
		<td class="fcaption">&nbsp;</td>
	</tr>
</table>';
    }

    if (!isset($OTD_DAY_NOREC))
    {
        $OTD_DAY_NOREC = '
<table class="fborder" style="' . USER_WIDTH . '">
   	<tr>
   		<td class="fcaption">{OTD_DAY_TITLE}</td>
	</tr>
	<tr>
		<td class="forumheader3">' . OTDLAN_DEFAULT . '</td>
	</tr>
	<tr>
		<td class="fcaption">&nbsp;</td>
	</tr>
</table>';
    }
    if (!isset($OTD_DAY_NOTPERMITTED))
    {
        $OTD_DAY_NOTPERMITTED = '
<table class="fborder" style="' . USER_WIDTH . '">
   	<tr>
   		<td class="fcaption">{OTD_DAY_TITLE}</td>
	</tr>
	<tr>
		<td class="forumheader3">' . OTD_01 . '</td>
	</tr>
	<tr>
		<td class="fcaption">&nbsp;</td>
	</tr>
</table>';
    }
}
