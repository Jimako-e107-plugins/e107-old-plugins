<?php
//Luca Filosofi > {aSeptik} @gmail.com (c) '09

require_once("../../class2.php");

global $pref;

if($_POST['action']){

	
	switch($_POST['action']){
 	case "ratings":

//getting the values
$q = explode(",", $_POST['query']);


$vote_sent = preg_replace("/[^0-9]/","",$q[0]);
$id_sent = preg_replace("/[^0-9a-zA-Z]/","",$q[1]);
$ip_num = preg_replace("/[^0-9\.]/","",$q[2]);
$units = preg_replace("/[^0-9]/","",$q[3]);
$user_rid = preg_replace("/[^0-9a-zA-Z\.]/","",$q[4]);
$ratings_cat = $q[5];

$ip = $_SERVER['REMOTE_ADDR'];
$referer  = $_SERVER['HTTP_REFERER'];
$rating_unitwidth = 15;
if ($vote_sent > $units) die("Sorry, vote appears to be invalid."); // kill the script because normal users will never see this.
$sql = new db;
//connecting to the database to get some information
$sql->db_Select("ratings", "total_votes, total_value, used_ips, user_rid", "rate_id='$id_sent' ");

$numbers = $sql->db_Fetch();

$checkIP = unserialize($numbers['used_ips']);
$checkRID = unserialize($numbers['user_rid']);

$count = $numbers['total_votes']; //how many votes total
$current_rating = $numbers['total_value']; //total number of rating added together and stored
$sum = $vote_sent+$current_rating; // add together the current vote value and the total vote value
$tense = ($count==1) ? "vote" : "votes"; //plural form votes/vote

// checking to see if the first vote has been tallied
// or increment the current number of votes
($sum==0 ? $added=0 : $added=$count+1);

// if it is an array i.e. already has entries the push in another value
((is_array($checkIP)) ? array_push($checkIP,$ip_num) : $checkIP=array($ip_num));
((is_array($checkRID)) ? array_push($checkRID,$user_rid) : $checkRID=array($user_rid));

$insertip=serialize($checkIP);
$insertrid=serialize($checkRID);


$voted = new db;
//check when voting
if ($user_rid == ""){
$votes = $voted->db_count("ratings", "(*)", "WHERE used_ips LIKE '%$insertip%' AND rate_id='$id_sent' AND total_cat = '$ratings_cat'");
} else {
$votes = $voted->db_count("ratings", "(*)", "WHERE user_rid LIKE '%$insertrid%' AND rate_id='$id_sent' AND total_cat = '$ratings_cat' ");
}

if(!$votes) {     //if the user hasn't yet voted, then vote normally...


if (($vote_sent >= 1 && $vote_sent <= $units) && ($ip == $ip_num)) { // keep votes within range

$result = new db;
if ($user_rid == ""){
$result ->db_update("ratings", "total_votes='".$added."', total_value='".$sum."', used_ips='".$insertip."' WHERE rate_id='$id_sent' AND total_cat = '$ratings_cat'");	
  } else {
  $result ->db_update("ratings", "total_votes='".$added."', total_value='".$sum."', used_ips='".$insertip."', user_rid='".$insertrid."' WHERE rate_id='$id_sent' AND total_cat = '$ratings_cat'");
  }
} 

} //end for the "if(!$voted)"
$newtotals = new db;
$newtotals ->db_Select("ratings", "*", "rate_id='$id_sent' AND total_cat = '$ratings_cat' ");

$numbers = $newtotals ->db_Fetch();
$count = $numbers['total_votes'];//how many votes total
$current_rating = $numbers['total_value'];//total number of rating added together and stored
$tense = ($count==1) ? "vote" : "votes"; //plural form votes/vote

$new_back = array();

$new_back[].='<div id="response-'.$id_sent.'">';
$new_back[] .= '<ul class="unit-rating" style="width:'.$units*$rating_unitwidth.'px;">';
$new_back[] .= '<li class="current-rating" style="width:'.@number_format($current_rating/$count,2)*$rating_unitwidth.'px;">Current rating.</li>';
$new_back[] .= '<li class="r1-unit">1</li>';
$new_back[] .= '<li class="r2-unit">2</li>';
$new_back[] .= '<li class="r3-unit">3</li>';
$new_back[] .= '<li class="r4-unit">4</li>';
$new_back[] .= '<li class="r5-unit">5</li>';
$new_back[] .= '<li class="r6-unit">6</li>';
$new_back[] .= '<li class="r7-unit">7</li>';
$new_back[] .= '<li class="r8-unit">8</li>';
$new_back[] .= '<li class="r9-unit">9</li>';
$new_back[] .= '<li class="r10-unit">10</li>';
$new_back[] .= '</ul>';

 if ( $pref['ratings_message_responce'] == 'true' ) {

$new_back[] .= '<p class="voted">'.$id_sent.'. Rating: <strong>'.@number_format($sum/$added,1).'</strong>/'.$units.' ('.$count.' '.$tense.' cast) ';
$new_back[] .= '<span class="thanks">Thanks for voting!</span></p>';

}
$new_back[] .= '</div>';
$allnewback = join("\n", $new_back);

echo $allnewback;

$e107cache->clear();

break;
  
  } 

}
//Luca Filosofi > {aSeptik} @gmail.com (c) '09
?>