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
	$text .= "<div><b>".excel_reader_L6."</b></div>";
 	$path = str_replace("../", "", Path);
  $text .= "<input type='text' size='100' value='./".$path."excel_files.php"."'>";
  $text .= "<br /><br />";
  $text .= "<div><b>".excel_reader_L6c."</b></div>";
  if ($handle = opendir(Path.'excel_files/')) {
    while (false !== ($file = readdir($handle)))
    {
      if (($file != ".") AND ($file != "..") AND ($file != "index.html"))
      {
      	$path = str_replace("../", "", Path);
        $text .= "<div><input type='text' size='100' value='./".$path."excel_reader.php?filename=$file"."'></div>";
      }
    }
    closedir($handle);
  }
  $text .= "<br /><a href='".e_ADMIN."links.php?create'>".excel_reader_L6d."</a>";
	$text .= "</td></tr></table>";
	

  $ns->tablerender(excel_reader_L1.excel_reader_L2, $text);

  require_once(e_ADMIN."footer.php");

?>
