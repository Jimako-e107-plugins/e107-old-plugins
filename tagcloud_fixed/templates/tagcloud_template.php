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
 
 
/*
  $htmlout .= '<a href="'.$link.'" style="font-size: '.$size.'%;color:#'.$colour[$value].';"';
  $key      = preg_replace("#_#"," ",$key);
  $htmlout .=  'title="'.$value.' things tagged with '.$key.'"';
  $htmlout .=  '>'.$key.'</a>   ';
*/ 
 
/* NOTE:  tags_style_cloud - simpleParse, Uppercase f.e. {TAGLINK} - parseTemplate with batch shortcodes */
 
$TAGCLOUD_TEMPLATE['list']['header'] = "<div class='{tags_style_cloud}'>";
$TAGCLOUD_TEMPLATE['list']['item'] = '<a href="{TAGLINK}" style="font-size: {TAGSIZE}%;color:#{TAGCOLOR};"';
$TAGCLOUD_TEMPLATE['list']['item'] .=  'title="{TAGTITLE} things tagged with {TAGKEY}" >{TAGKEY}</a> ';
 
$TAGCLOUD_TEMPLATE['list']['footer'] = "</div>";

$TAGCLOUD_TEMPLATE['menu']['header'] =  "<div class='{tags_style_cloud}'>";
$TAGCLOUD_TEMPLATE['menu']['item'] = $TAGCLOUD_TEMPLATE['list']['item'] ; 
$TAGCLOUD_TEMPLATE['menu']['footer'] = "<div style='text-align:center;'><a href='{tag_main_page}'>".LAN_TG6."</a></div>";

?>