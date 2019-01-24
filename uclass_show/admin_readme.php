<?php
/*
+---------------------------------------------------------------+
|	e107 website system
|
|	©Steve Dunstan 2001-2005
|	http://e107.org
|	jalist@e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
|
|
|   uclass_show plugin  1.02 - 20 nov 2012
|   by Alf - http://www.e107works.org
|   Released under the terms and conditions of the
|   Creative Commons "Attribution-Noncommercial-Share Alike 3.0"
|   http://creativecommons.org/licenses/by-nc-sa/3.0/
+---------------------------------------------------------------+
*/

require_once("../../class2.php");

if (!getperms("P")) {
	header("location:".e_HTTP."index.php");
exit;
}

require_once(e_ADMIN."auth.php");

include_lan(e_PLUGIN."uclass_show/languages/".e_LANGUAGE.".php");

$readme_title = "

<span style='font-weight:bold;font-size:16px;'>uclass_show read Me</span>

";


$text = "
<div style='font-size:16px'>

  ".UC_SHOW_README_01."
  <br />
  <br />
  ".UC_SHOW_README_02."
  <br />
  <br />
  ".UC_SHOW_README_03."  
  <br />
  <br />  
  ".UC_SHOW_README_04."
  <br />
  <br />  
  enjoy!
  <br />
  Alf  
  
</div>
";

$ns->tablerender($readme_title, $text);

require_once(e_ADMIN."footer.php");
?>

