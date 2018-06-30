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
  
	define("Path", e_PLUGIN."excel_reader/");
  @include_once(Path."languages/".e_LANGUAGE.".php");
  @include_once(Path."languages/English.php");
  
  if ($handle = opendir(Path.'excel_files/')) {
    while (false !== ($file = readdir($handle)))
    {
      if (($file != ".") & ($file != "..") & ($file != "index.html"))
      {
        $text .= "&bull;&nbsp<a href='".Path."excel_reader.php?filename=$file'>$file</a><br />";
      }
    }
    closedir($handle);
  }
  
  $ns->tablerender(excel_reader_L1.excel_reader_L12b, $text);

?>
