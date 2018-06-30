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
   
  $text = "<table cellspacing='4' style='width: 100%;' class='forumheader'>";
	$text .= exfile()."</table>";

	Function exfile()
	{ 
		global $handle,$file,$text,$ns;	
	  if ($handle = opendir('excel_files/')) {
	  	while (false !== ($file = readdir($handle)))
	    {
	    	if ($file != "." AND $file != ".." AND $file != "index.html" AND $file != "index.htm")
	    	{
	      $text .= "<tr><td>&bull;&nbsp<a href='admin_modify.php?filename=$file'>$file</a>";
				if(!is_writable('excel_files/'.$file)){
					$text .= "<span style='color: rgb(255, 0, 0); font-weight: bold;'>".excel_reader_L13b.excel_reader_L14b."</span></td></tr>";
				}else{
				}	      
	      }
	    }
	    closedir($handle);
	   }
  }

	if(!is_writable('temp')){
		$cns = "<span style='color: rgb(255, 0, 0); font-weight: bold;'>".excel_reader_L13.excel_reader_L14."</spam>";
	}
	  
	$ns->tablerender(excel_reader_L1.excel_reader_L3.$cns, $text);	  
  
	require_once(e_ADMIN."footer.php");

?>
