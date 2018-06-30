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
  require_once(HEADERF);
  
  define("Path", e_PLUGIN."excel_reader/");
  @include_once(Path."languages/".e_LANGUAGE.".php");
  @include_once(Path."languages/English.php");

  if ($handle = opendir('excel_files/')) {
    $text = excel_reader_L11b;
    while (false !== ($file = readdir($handle)))
    {
      if ($file != "." AND $file != ".." AND $file != "index.html" AND $file != "index.htm")
      {
        $text .= "<div>&bull;&nbsp<a href='excel_reader.php?filename=$file'>$file</a></div>";
      }  
    }
    closedir($handle);
    $ns->tablerender(excel_reader_L1.excel_reader_L9, $text);
  }
  
	require_once(FOOTERF);
  
?>
