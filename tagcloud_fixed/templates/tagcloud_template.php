<?php


if (!defined('e107_INIT')) { exit; }




$header   ="
        <div style='text-align:center'>
	<div class='spacer'>
        
";

$TAGCLOUD_TEMPLATE['default']['header'] = $header;


//{CURRENTTAG}

$bodyt     = "
<table style='".USER_WIDTH."' class='fborder' >
<tr> <td class='forumheader'> {TITLE} {PRETITLE} {PRESUMMARY}</td> </tr>


<tr> <td class='forumheader3'> {SUMMARY} </td> </tr>

<tr> <td class='forumheader3'> {OTHERTAGS} </td> </tr>

<tr> <td class='forumheader3'> {DETAIL} </td> </tr>
</table>  <br>
";

$TAGCLOUD_TEMPLATE['default']['body'] = $bodyt;

$footer ="

</div> </div>
";
//
//add google search, eg click button google returns results + ads.

$TAGCLOUD_TEMPLATE['default']['footer'] = $footer;
?>