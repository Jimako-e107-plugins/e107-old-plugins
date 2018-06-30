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
  require_once("custom_page.php");
  require_once(HEADERF);
  
  define("Path", e_PLUGIN."excel_reader/");
  @include_once(Path."languages/".e_LANGUAGE.".php");
  @include_once(Path."languages/English.php");
  
	require_once ("excel/Reader.php");
  $data = new Spreadsheet_Excel_Reader();
  $filename = "excel_files/".$_GET[filename];
  $data->read($filename);
  $data->setOutputEncoding('CP1251');
  error_reporting(E_ALL ^ E_NOTICE); 
	
	require_once ("check_class.php");
  function stampa()
  {
    global $i,$j,$data,$text,$ns,$PT;
    $PT = "<a href='admin_modify.php?filename=$_GET[filename]'>".excel_reader_L3." ".$_GET[filename]."</a>";    
    if (!getperms("P")) {}else{$text .= "$PT";}
		$text .= " - <a href='excel_files.php'>".excel_reader_L6b."</a>";
    $text .= "<table cellspacing='4' class='forumheader'>";
    for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
    $text .= "<tr>";
   	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
    if (($i % 2) == 0) {
          $text .= "<td class='forumheader4'>";
      		$text .= "".$data->sheets[0]['cells'][$i][$j]."";
          $text .= "</td>";
    }
    else {
          $text .= "<td class='forumheader4'>";
      		$text .= "".$data->sheets[0]['cells'][$i][$j]."";
          $text .= "</td>";
    }
    }
    $text .= "</tr>";
    $text .= "\n";
    
    }
    $text .= "</table>";
    if (!getperms("P")) {}else{$text .= "$PT";}
		$text .= " - <a href='excel_files.php'>".excel_reader_L6b."</a>";    
    $ns->tablerender(excel_reader_L1.excel_reader_L9, $text);
	}
  function no_permesso()
  {
    global $text,$ns;
    $text = excel_reader_L9b.excel_reader_L10;
  	$ns->tablerender(excel_reader_L1.excel_reader_L10b, $text);
  }
  
  require_once(FOOTERF);  
	    
?>
