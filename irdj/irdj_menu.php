<?php

########################################
# DJ SCHEDULE BY MARTINJ  | VERSION 1.1 | December 2007	#
# For e107 website system - e107.org | http://www.martinj.co.uk	#
# email martinleeds AT googlemail.com					#
########################################

		if (file_exists(e_PLUGIN."irdj/languages/djschedule_".e_LANGUAGE.".php"))
		{
			include_once(e_PLUGIN."irdj/languages/djschedule_".e_LANGUAGE.".php");
		}
		else
		{
		include_once(e_PLUGIN."irdj/languages/djschedule_English.php");
		}
		
$text="";

// Find the date info
	$dowarr=getdate();
	$dow=$dowarr['wday'];
	
	if($dow=="0")
	$dow=7;


// get config
$result=mysql_query("SELECT * FROM e107_irdj_config");
	$config=mysql_fetch_array($result);
	$showlink=$config['show_links'];

$result = mysql_query("SELECT * FROM e107_irdj WHERE day=$dow ORDER BY time");
$ifblank=mysql_affected_rows();

	$text .= "<table width='100%'>";

	if ($ifblank=='0')
	$text .= "<tr><td class='center'>Todays Schedule<b></tr></td>";
	
while($row = mysql_fetch_array($result))
	{
  	if ($row['link']=="0" || $showlink<>"0")
		$djname=$row['dj_name'];
	else 
		$djname="<a href='".e_PLUGIN."irdj/profile.php?id=".$row['link']."'>".$row['dj_name']."</a>";
	
	$text .= "<tr><td class='center'>".$row['time']."<br /><b>".$djname."</b>";
	
	if ($config['show_genre']=="1")
		$text .= "<br /><i>".$row['genre']."</i>";
	
	$text .= "<br /><br /></td></tr>";
	}
	
	$text .= "</table>";

	$ns->tablerender("Todays Schedule",$text);
?>