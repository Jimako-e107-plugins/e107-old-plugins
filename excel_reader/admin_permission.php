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
  
	require_once(e_HANDLER . "userclass_class.php");
	if (e_QUERY == "update")
	{
	    $pref['excel_readclass'] = $_POST['excel_readclass'];
	    save_prefs();
	    $text = "<b>".excel_reader_L12."<br /><br /></b>";
	}
	$text .= "<form method='post' action='".e_SELF."?update'>
	<table cellspacing='4' style='width: 100%;' class='forumheader'>
	<tr>
	<td>".r_userclass("excel_readclass", $pref['excel_readclass'], "off", 'public, nobody, member, admin, classes')."</td>
	</tr>
	<tr>
	<td><input type='submit' name='update' value='".excel_reader_L11."' class='button' />\n</td>
	</tr>
	</table></form>";
	
	$ns->tablerender(excel_reader_L1.excel_reader_L4.excel_reader_L4c, $text);
	
	require_once(e_ADMIN."footer.php");
   
?>
