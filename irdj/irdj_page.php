<?php

########################################
# IRDJ (e107) BY MARTINJ  | VERSION 1.2 | January 2008		#
# For e107 website system - e107.org | http://www.irdj.co.uk		#
# email martinleeds AT googlemail.com					#
########################################

require_once("../../class2.php");
define("PAGE_NAME", "DJ Schedule");
require_once(HEADERF);

if (!defined('e107_INIT')) { exit; }

		if (file_exists(e_PLUGIN."irdj/languages/irdj_".e_LANGUAGE.".php"))
		{
			include_once(e_PLUGIN."irdj/languages/irdj_".e_LANGUAGE.".php");
		}
		else
		{
		include_once(e_PLUGIN."irdj/languages/irdj_English.php");
		}

$result=mysql_query("SELECT * FROM ".$mySQLprefix."irdj_config");
$config=mysql_fetch_array($result);

$showlink=$config['show_links'];

if ($config['show_border']=="1")
	$border="border='1'";
	else $border="";

$dow=1;
$days=array(DJS_0, DJS_1, DJS_2, DJS_3, DJS_4, DJS_5, DJS_6);


echo "<table width='100%'><tr><td>".$config['page_text']."</td></tr></table>";

while ($dow<8)
	{
	$result = mysql_query("SELECT * FROM ".$mySQLprefix."irdj WHERE day=$dow ORDER BY time");
	$sets=mysql_affected_rows();
		
		echo "<table $border width='100%'>";
		echo "<tr><td class='center' style='width:20%'><b>".$days[$dow-1]."</b></td>";
	
	if ($sets=='0')
	echo "<td class='center'><i>".DJS_8."</i></td>";
		
		while($row = mysql_fetch_array($result))
		{
			if ($row['link']=="0"  || $showlink<>"0")
				$djname=$row['dj_name'];
		else 
			$djname="<a href='profile.php?id=".$row['link']."'>".$row['dj_name']."</a>";
		
		echo "<td class='center'>".$row['time']."<br /><b>".$djname."</b>";

			if ($config['show_genre']=="1")
				echo "<br /><i>".$row['genre']."</i>";
	
		echo "<br /></td>";
		}
	
	echo "</tr></table>";

	$dow++;
	}

echo "<br /><div class='center'><a href='http://www.irdj.net'>IRDJ Schedule System</a> by <a href='http://www.martinj.co.uk'>Martinj</a></div><br />";
require_once(FOOTERF);

?>