<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        e107 BLOG Engine by MacGuru
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

require_once("../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }
require_once(e_PLUGIN."macgurublog_menu/macgurublog_dt.php");
header('Content-type: application/force-download');
header('Content-Disposition: attachment; filename="dump'.time().'.php"');
// ------------------------------
echo('
<?php
/*------------------------*\
| Database restorer script |
|   for e107 BLOG Engine   |
|        by MacGuru        |
|--------------------------|
| Saved at:                |
| '.$mgb -> dt(1, time()).'   |
\*------------------------*/

$host = "'.$sql -> mySQLserver.'";
$user = "'.$sql -> mySQLuser.'";
');
if ($_POST['macgurublog_dbpass'] != 'true') {
	echo '$pass = "";  // please set it before run the script! --!--';
} else {
	echo '$pass = "'.$sql -> mySQLpassword.'";';
}
echo '
$dtdb = "'.$sql -> mySQLdefaultdb.'";
$prefix = "'.MPREFIX.'";


//==========================================
';
if ($_POST['macgurublog_dbdrop'] == 'true') {
	echo '$qs[] = "DROP TABLE IF EXISTS ${prefix}macgurublog_main;";
$qs[] = "DROP TABLE IF EXISTS ${prefix}macgurublog_rec;";
$qs[] = "DROP TABLE IF EXISTS ${prefix}macgurublog_com;";
$qs[] = "DROP TABLE IF EXISTS ${prefix}macgurublog_tag;";

';
	$q = "CREATE TABLE \${prefix}macgurublog_main (blog_uid int(10) unsigned NOT NULL default '0', blog_title varchar(100) NOT NULL default '', blog_enable tinyint(1), PRIMARY KEY  (blog_uid), UNIQUE KEY blog_uid (blog_uid)) TYPE=MyISAM;";
	echo "\$qs[] = \"$q\";\n";
	$q = "CREATE TABLE \${prefix}macgurublog_rec (blogrec_id int(10) unsigned NOT NULL auto_increment, blogrec_uid int(10) unsigned NOT NULL default '0', blogrec_date int(12) NOT NULL default '0', blogrec_title varchar(100) NOT NULL default '', blogrec_text longtext NOT NULL, blogrec_tag int(10) unsigned NOT NULL default '0', blogrec_rating tinyint(2), PRIMARY KEY  (blogrec_id), UNIQUE KEY blogrec_id (blogrec_id)) TYPE=MyISAM;";
	echo "\$qs[] = \"$q\";\n";
	$q = "CREATE TABLE \${prefix}macgurublog_com (blogcom_id int(10) unsigned NOT NULL auto_increment, blogcom_rid int(10) unsigned NOT NULL default '0', blogcom_date int(12) NOT NULL default '0', blogcom_uid int(10) NOT NULL default '0', blogcom_text longtext NOT NULL, PRIMARY KEY  (blogcom_id), UNIQUE KEY blogcom_id (blogcom_id)) TYPE=MyISAM;";
	echo "\$qs[] = \"$q\";\n";
	$q = "CREATE TABLE \${prefix}macgurublog_tag (blogtag_id int(10) unsigned NOT NULL auto_increment, blogtag_uid int(10) unsigned NOT NULL default '0', blogtag_text varchar(100) NOT NULL default '', PRIMARY KEY  (blogtag_id), UNIQUE KEY blogtag_id (blogtag_id)) TYPE=MyISAM;";
	echo "\$qs[] = \"$q\";\n\n//==========================================\n";
}

/////////////////Reading tables
$sql -> db_Select('macgurublog_main');
while($row = $sql-> db_Fetch()){
	$q = "INSERT INTO \${prefix}macgurublog_main VALUES (".$row['blog_uid'].", '".$row['blog_title']."', ".$row['blog_enable'].");";
	echo "\$qs[] = \"$q\";\n";
}
echo "\n";
$sql -> db_Select('macgurublog_rec');
while($row = $sql-> db_Fetch()){
	$q = "INSERT INTO \${prefix}macgurublog_rec VALUES (".$row['blogrec_id'].", ".$row['blogrec_uid'].", ".$row['blogrec_date'].", '".$row['blogrec_title']."', '".$row['blogrec_text']."', ".$row['blogrec_tag']."', ".$row['blogrec_rating'].");";
	echo "\$qs[] = \"$q\";\n";
}
echo "\n";
$sql -> db_Select('macgurublog_com');
while($row = $sql-> db_Fetch()){
	$q = "INSERT INTO \${prefix}macgurublog_com VALUES (".$row['blogcom_id'].", ".$row['blogcom_rid'].", ".$row['blogcom_date'].", ".$row['blogcom_uid'].", '".$row['blogcom_text']."');";
	echo "\$qs[] = \"$q\";\n";
}
echo "\n";
$sql -> db_Select('macgurublog_tag');
while($row = $sql-> db_Fetch()){
	$q = "INSERT INTO \${prefix}macgurublog_tag VALUES (".$row['blogtag_id'].", ".$row['blogtag_uid'].", '".$row['blogtag_text']."');";
	echo "\$qs[] = \"$q\";\n";
}
echo "\n";
echo '//==========================================
$link = @mysql_connect($host, $user, $pass)
	or die("The script can\'t connect to the MySQL server! If you haven\'t done yet, please set the password in the code.");
@mysql_select_db($dtdb, $link)
	or die("The script can\'t select the database named \'${dtdb}\'!");

foreach ($qs as $q) {
	mysql_query($q, $link);
}
mysql_close($link);
echo("The script has finished the restoring.");
?>
';

?>
