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

  require_once ("excel/Reader.php");
  $data = new Spreadsheet_Excel_Reader();
  $data->setOutputEncoding('CP1251');

  $filename = "excel_files/".$_GET[filename];
  $data->read($filename);
 
    $text .= "<table cellspacing='4' style='width: 100%;' class='forumheader'>";
    $text .= "<form action='admin_write.php?filename=".$_GET[filename]."' method='post'>";
    $text .= "<tr><td><input type='submit' name='submit' value='Salva'></td></tr>";
    for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
    $text .= "<tr>";
   	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
    if (($i % 2) == 0) {
          $text .= "<td>";
      		$text .= "<input type='text' size='10' value='".$data->sheets[0]['cells'][$i][$j]."' name='".R.($i-1).C.($j-1)."'>";
          $text .= "</td>";
    }
    else {
          $text .= "<td>";
      		$text .= "<input type='text' size='10' value='".$data->sheets[0]['cells'][$i][$j]."' name='".R.($i-1).C.($j-1)."'>";
          $text .= "</td>";
    }
    }
    $text .= "</tr>";
    $text .= "\n";
    
    }
    $text .= "<tr><td><input type='submit' name='submit' value='Salva'></td></tr>";
    $text .= "</form></table>";

		if(!is_writable($filename)){
			$fns = "<span style='color: rgb(255, 0, 0); font-weight: bold;'>".excel_reader_L13b.excel_reader_L14b."</spam>";
		}
		if(!is_writable('temp')){
			$cns = "<span style='color: rgb(255, 0, 0); font-weight: bold;'>".excel_reader_L13.excel_reader_L14."</spam>";
		}
				      
    $ns->tablerender(excel_reader_L1.excel_reader_L3." ".$_GET[filename].$fns.$cns, $text);

  require_once(e_ADMIN."footer.php");

?>
