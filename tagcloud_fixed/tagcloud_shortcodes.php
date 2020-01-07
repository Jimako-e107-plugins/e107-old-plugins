<?php
if (!defined('e107_INIT')) { exit; }
include_once(e_HANDLER.'shortcode_handler.php');
$tagcloud_shortcodes = $tp -> e_sc -> parse_scbatch(__FILE__);

/*

SC_BEGIN CURRENTTAG
global $CURRENTTAG;
 $ret = $CURRENTTAG;
return $ret;
SC_END

SC_BEGIN TITLE
global $TITLE;
 $ret = $TITLE;
return $ret;
SC_END

SC_BEGIN PRETITLE
global $PRETITLE;
 $ret = $PRETITLE;
return $ret;
SC_END

SC_BEGIN PRESUMMARY
global $PRESUMMARY;
 $ret = $PRESUMMARY;
return $ret;
SC_END

SC_BEGIN SUMMARY
global $SUMMARY;
 $ret = $SUMMARY;
return $ret;
SC_END

SC_BEGIN OTHERTAGS
global $TAGS;
 $ret = $TAGS;
return $ret;
SC_END

SC_BEGIN DETAIL
global $DETAIL;
 $ret = $DETAIL;
return $ret;
SC_END


*/
?>
