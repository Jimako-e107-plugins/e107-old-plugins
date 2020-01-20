<?php
/*
+---------------------------------------------------------------+
|        YouTube Gallery v4.01 - by Erich Radstake
|        http://www.erichradstake.nl
|        info@erichradstake.nl
|
|        This is a module for the e107 .7+ website system
|        Copyright Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
|
|        In this page I included a rating script from:
|        ryan masuga, masugadesign.com
|        ryan@masugadesign.com
|        Licensed under a Creative Commons Attribution 3.0 License.
|        http://creativecommons.org/licenses/by/3.0/
|        See readme.txt for full credit details.
|
+---------------------------------------------------------------+
*/

header("Cache-Control: no-cache");
header("Pragma: nocache");
require_once("../../class2.php");
require_once("./ytm_rating_conf.php");

//getting the values
$vote_sent = preg_replace("/[^0-9]/","",$_REQUEST['j']);
$id_sent = $_REQUEST['q'];
$ip_num = preg_replace("/[^0-9\.]/","",$_REQUEST['t']);
$units = preg_replace("/[^0-9]/","",$_REQUEST['c']);
$ip = $_SERVER['REMOTE_ADDR'];
$referer  = $_SERVER['HTTP_REFERER'];

if ($vote_sent > $units) die("" . LAN_YTM_RATE_4 . ""); // kill the script because normal users will never see this.

//connecting to the database to get some information
$query = mysql_query("SELECT total_votes, total_value, used_ips FROM $rating_dbname.$rating_tableName WHERE id='$id_sent' ")or die(" Error: ".mysql_error());
$numbers = mysql_fetch_assoc($query);
$checkIP = unserialize($numbers['used_ips']);
$count = $numbers['total_votes']; //how many votes total
$current_rating = $numbers['total_value']; //total number of rating added together and stored
$sum = $vote_sent+$current_rating; // add together the current vote value and the total vote value
$tense = ($count==1) ? "". LAN_YTM_RATE . "" : "". LAN_YTM_RATE_1 . ""; //plural form votes/vote

// checking to see if the first vote has been tallied
// or increment the current number of votes
($sum==0 ? $added=0 : $added=$count+1);

// if it is an array i.e. already has entries the push in another value
((is_array($checkIP)) ? array_push($checkIP,$ip_num) : $checkIP=array($ip_num));
$insertip=serialize($checkIP);

//IP check when voting
$voted=mysql_num_rows(mysql_query("SELECT used_ips FROM $rating_dbname.$rating_tableName WHERE used_ips LIKE '%".$ip."%' AND id='".$id_sent."' "));
if(!$voted) {     //if the user hasn't yet voted, then vote normally...


if (($vote_sent >= 1 && $vote_sent <= $units) && ($ip == $ip_num)) { // keep votes within range
	$update = "UPDATE $rating_dbname.$rating_tableName SET total_votes='".$added."', total_value='".$sum."', used_ips='".$insertip."' WHERE id='$id_sent'";
	$result = mysql_query($update);		
} 
header("Location: $referer"); // go back to the page we came from 
exit;
} //end for the "if(!$voted)"
?>
