<?php
require_once("../../class2.php"); 
if(e_LANGUAGE != "English"){
	include_once(e_PLUGIN."./mrbs/languages/admin/".e_LANGUAGE.".php");
}
else
{
	include_once(e_PLUGIN."./mrbs/languages/admin/English.php");
}
require_once(HEADERF);
$mrbs_text .=  "<div style=\"align:center\">
<iframe src=\"../web/index.php\" width=\"100%\" height=\"".$pref['mrbs_frameheight']."\" frameborder=\"0\" marginheight=\"0\" marginwidth=\"0\">
<br />Your browser is not compatible with the frames used on this page, to view this page please click<a href=\"$page\">here</a>.<br /></iframe>
</div>";
$ns -> tablerender(MRBS_A1, $mrbs_text);
require_once(FOOTERF);

?>