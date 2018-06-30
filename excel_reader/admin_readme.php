<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system http://www.e107italia.org
|
|     Daniele Feola
|     http://www.metacom-tm.com
|     daniele.feola@metacom-tm.com
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     
|     $Revision: 2.2$
|     $Date: 04/01/2007 13:00:00$
|     $Author: Daniele Feola$
+----------------------------------------------------------------------------+
*/

  require_once("../../class2.php");

  if (!getperms("P")) {
  header("location:".e_HTTP."index.php");
  exit;
  }
  
  require_once(e_ADMIN."auth.php");

  define("Path", e_PLUGIN."excel_reader/");
  @include_once(Path."languages/".e_LANGUAGE.".php");
  @include_once(Path."languages/English.php");
  
  $text = "<table cellspacing='4' style='width: 100%;' class='forumheader'><tr><td>";
  $text .= "<div>
	/*<br />
	+ ----------------------------------------------------------------------------+<br />
	|     e107 website system http://www.e107italia.org<br />
	|<br />
	|     Daniel Feola<br />
	|     <a href='http://www.metacom-tm.com'>http://www.metacom-tm.com</a><br />
	|     <a href='mailto:daniele.feola@metacom-tm.com'>daniele.feola@metacom-tm.com</a><br />
	|<br />
	|     Released under the terms and conditions of the<br />
	|     Gnu General Public License (http://gnu.org).<br />
	|<br />
	|<br />     
	|     \$Revision: 2.2$<br />
	|     \$Dates: 04/01/2007 13:00:00$<br />
	|     \$Author: Daniel Feola$<br />
	+----------------------------------------------------------------------------+<br />
	*/<br />
	</div>";
	$text .= "</td></tr></table>";
  
  $ns->tablerender(excel_reader_L1.excel_reader_L5, $text);

  require_once(e_ADMIN."footer.php");
   
?>
