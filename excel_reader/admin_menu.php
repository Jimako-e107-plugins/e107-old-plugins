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

  $menutitle  = excel_reader_L1.excel_reader_L1b;
  $butname[]  = excel_reader_L2;
  $butlink[]  = "admin_config.php";
  $butid[]    = excel_reader_L2b;
  $butname[]  = excel_reader_L5c;
  $butlink[]  = "excel_files.php";
  $butid[]    = excel_reader_L5d;
  $butname[]  = excel_reader_L3;
  $butlink[]  = "admin_file.php";
  $butid[]    = excel_reader_L3b;
  $butname[]  = excel_reader_L4;
  $butlink[]  = "admin_permission.php";
  $butid[]    = excel_reader_L4b;
	$butname[]  = excel_reader_L15;
  $butlink[]  = "admin_custompage.php";
  $butid[]    = excel_reader_L15b;  
  $butname[]  = excel_reader_L5;
  $butlink[]  = "admin_readme.php";
  $butid[]    = excel_reader_L5b;

  global $pageid;
  for ($i=0; $i<count($butname); $i++) {
  	$var[$butid[$i]]['text'] = $butname[$i];
    $var[$butid[$i]]['link'] = $butlink[$i];
  };
  show_admin_menu($menutitle, $pageid, $var);
   
?>
