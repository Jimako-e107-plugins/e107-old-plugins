<?php
require_once("../../class2.php");
if(!getperms("P")){ header("location:".e_HTTP."index.php"); exit; }
require_once(e_ADMIN."auth.php");

$pageid  = "changes";
$caption = "Changes File for Coppermine Gallery 1.3.5";


$text .= "
<br/>
11.4.05 Release CPG 1.3.5b<br/> 
<ui>
<li>Added support for CUSTOMPAGES/FOOTER</li>
<li>Fixed blank 'new album' names in PHP 4.3.x</li>
<li>Fixed bug in block: jump to album dropdown</li>
<li>Cleaned up admin interface</li>
<li>Added original readme to give credit where credit is due</li>
</ui>
<br/><br/>

10.17.05 Release CPG 1.3.5<br/>
<ui>
<li>Took the main e107 config from the previous version Coppermine for e107 - v1.3.2b by MrPete and applied it to Coppermine Gallery 1.3.5</li>
<li>Ported the block(menu) config to the Plugin Manager for e107 v0.7+</li>
</ui>

<br/><br/>

";

$ns->tablerender($caption,$text);

require_once(e_ADMIN."footer.php");
?>
