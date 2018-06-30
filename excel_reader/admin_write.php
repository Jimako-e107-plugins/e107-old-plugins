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
  $filename = "excel_files/".$_GET[filename];
  $data->read($filename);
  $data->setOutputEncoding('CP1251');
  error_reporting(E_ALL ^ E_NOTICE);
  
  include_once "excel/Writer.php";
  $xls =& new Spreadsheet_Excel_Writer('excel_files/'.$_GET[filename]);
  $sheet =& $xls->addWorksheet($_GET[filename]);    	
	if($xls==false)
  	echo $xls->error;	
  for ($i = 0; $i < $data->sheets[0]['numRows']; $i++) {
   	for ($j = 0; $j < $data->sheets[0]['numCols']; $j++) {
    $sheet->write($i,$j,$_POST["R$i"."C$j"]);
    }
  }    
  $xls->close();
  
  $text = "<table cellspacing='4' style='width: 100%;' class='forumheader'><tr>";
	$text .= "<td><b>".$_GET[filename]."</b> ".excel_reader_L8;
	$text .= "<br />".excel_reader_L8b."<a href='excel_reader.php?filename=$_GET[filename]'>".$_GET[filename]."</a></td>";
	$text .= "</tr></table>";

	if(!is_writable($filename)){
		$fns = "<span style='color: rgb(255, 0, 0); font-weight: bold;'>".excel_reader_L13b.excel_reader_L14."</spam>";
	}
	if(!is_writable('temp')){
		$cns = "<span style='color: rgb(255, 0, 0); font-weight: bold;'>".excel_reader_L13.excel_reader_L14."</spam>";
	}	
		      
  $ns->tablerender(excel_reader_L1.excel_reader_L3." ".$_GET[filename].$fns.$cns, $text); 
  //$ns->tablerender(excel_reader_L1.excel_reader_L3, $text);  
  
	require_once(e_ADMIN."footer.php");  

?>
