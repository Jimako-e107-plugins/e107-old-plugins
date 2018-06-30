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
	
  if (!getperms("P")) {
  header("location:".e_HTTP."index.php");
  exit;
  }
  
  require_once(e_ADMIN."auth.php");

  define("Path", e_PLUGIN."excel_reader/");
  @include_once(Path."languages/".e_LANGUAGE.".php");
  @include_once(Path."languages/English.php");
  
	if (e_QUERY == "attiva")
	{
		$var_cp=fopen('custom_page.php','w+');
		fwrite($var_cp, '<?php
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
	
	$CUSTOMPAGES = "excel_reader.php ";
	
?>');
	  save_prefs();
	  $text = "<b>".excel_reader_L12."<br /><br /></b><meta http-equiv=\"refresh\" content=\"1; url=admin_custompage.php\">";
	}
	
	if (e_QUERY == "disattiva")
	{
		$var_cp=fopen('custom_page.php','w+');
		fwrite($var_cp, '<?php
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
	
	$CUSTOMPAGES = " ";
	
?>');
	  save_prefs();
	  $text = "<b>".excel_reader_L12."<br /><br /></b><meta http-equiv=\"refresh\" content=\"1; url=admin_custompage.php\">";
	}
	if(!is_writable('custom_page.php')){
		$text .= "<span style='color: rgb(255, 0, 0); font-weight: bold;'>custom_page.php".excel_reader_L13b.excel_reader_L14b."</span>";
	}		
	$text .= "<table cellspacing='4' style='width: 100%;' class='forumheader'>
	<tr>
	<td>".excel_reader_L15c."</td>
	</tr>
	<tr>
	<td><b>".excel_reader_L15d."</b>$CUSTOMPAGES<br /><br /></td>
	</tr>
	<tr>
	<form method='post' action='".e_SELF."?attiva'>
	<td>Attiva:	<input type='submit' name='attiva' value='".excel_reader_L11."' class='button' />\n</td>
	</form>
	</tr>
	<tr>
	<form method='post' action='".e_SELF."?disattiva'>
	<td>Disattiva: <input type='submit' name='disattiva' value='".excel_reader_L11."' class='button' />\n</td>
	</form>
	</tr>
	</table>";
	
	$ns->tablerender(excel_reader_L1.excel_reader_L15.excel_reader_L15b, $text);
	
	require_once(e_ADMIN."footer.php");
   
?>
