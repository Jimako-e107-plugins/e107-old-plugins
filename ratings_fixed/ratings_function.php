<?php
   function rating_this( $id , $cat , $units , $static , $ip , $rating_unitwidth ) {
  global $e107cache, $e107, $PLUGINS_DIRECTORY, $tp, $pref;
if (!$units) {$units = 5;} //$pref['units'];
if (!$static) {$static = FALSE;}

$sql = new db;
$sql->db_select("ratings", "*", "rate_id='$id' AND total_cat = '$cat'");
$numbers = $sql->db_Fetch();

//extract($numbers);

if ($numbers['total_votes'] < 1) {
	$count = 0;
} else {
	$count=$numbers['total_votes']; //how many votes total
} 
$current_rating=$numbers['total_value']; //total number of rating added together and stored
$tense=($count==1) ? "vote" : "votes"; //plural form votes/vote

// determine whether the user has voted, so we know how to draw the ul/li  
if ( check_class( $pref['ratings_class'] ) ) {

$voted = new db;
if ( $pref['ratings_class'] == 0 ) {
$votes = $voted->db_count("ratings", "(*)", "WHERE used_ips LIKE '%$ip%' AND rate_id='$id' AND total_cat = '$cat'"); 

} else {
$votes = $voted->db_count("ratings", "(*)", "WHERE user_rid LIKE '%".USERID.".".USERNAME."%' AND rate_id='$id' AND total_cat = '$cat'");

}

}

// now draw the rating bar
$rating_width = @number_format($current_rating/$count,2)*$rating_unitwidth;
$rating1 = @number_format($current_rating/$count,1);
$rating2 = @number_format($current_rating/$count,2);
 
$rater ='';

    
if ( $sql->db_select("ratings", "*", "rate_id='$id' AND rate_this='0' AND total_cat = '$cat'") ){
if ($static == 'static') {

		$static_rater = array();
		$static_rater[] .= "\n".'<div class="ratingblock">';
		$static_rater[] .= '<div id="unit_long'.$id.'">';
		$static_rater[] .= '<ul id="unit_ul'.$id.'" class="unit-rating" style="width:'.$rating_unitwidth*$units.'px;">';
		$static_rater[] .= '<li class="current-rating" style="width:'.$rating_width.'px;">Currently '.$rating2.'/'.$units.'</li>';
		$static_rater[] .= '</ul>';
		//$static_rater[] .= '<p class="static">'.$id.'. Rating: <strong> '.$rating1.'</strong>/'.$units.' ('.$count.' '.$tense.' cast) <em>This is \'static\'.</em></p>';
		$static_rater[] .= '</div>';
		$static_rater[] .= '</div>'."\n\n";

		return join("\n", $static_rater);


} else {

      
      $rater.='<div class="ratingblock">';

      $rater.='<div id="unit_long'.$id.'">';
      $rater.='<div id="response-'.$id.'">';
      $rater.='<ul class="unit-rating" style="width:'.$rating_unitwidth*$units.'px;">';
      $rater.='<li class="current-rating" style="width:'.$rating_width.'px;">'.LAN_RATINGS_22.' '.$rating2.'/'.$units.'</li>';

      if ( $pref['ratings_class'] != 255 ) {
      
    switch ( $pref['ratings_class'] ) {
      case 0:
      $USR = "";
      break;
      default:
      $USR = USERID.".".USERNAME;
      }
      
      if ( check_class( $pref['ratings_class'] ) ) {
      
      for ($ncount = 1; $ncount <= $units; $ncount++) { // loop from 1 to the number of units
      
      
           if (!$votes) { // if the user hasn't yet voted, draw the voting stars
              
              $rater.="<li><a onclick=\"rateThis('{$ncount},{$id},{$ip},{$units},{$USR},{$cat}','{$id}');\" href=\"javascript:;\" title=\"{$ncount} ".LAN_RATINGS_21." {$units}\" class=\"r{$ncount}-unit rater\" rel=\"nofollow\">{$ncount}</a></li>";
           }
         }
      }  else {
      
      $rater.= "";
      
      }
    } //if is set nobody class
      $ncount=0; // resets the count

      $rater.='  </ul>';
      
     if ( $pref['ratings_message_responce'] == 'true' ) {
      
      $rater.='  <p';
      if($voted){ 
      $rater.=' class="voted"'; 
      }
      $rater.='> '.LAN_RATINGS_20.' <strong> '.$rating1.'</strong>/'.$units.' ('.$count.' '.$tense.' cast)';
      $rater.='  </p>';
      
      }
      
      $rater.='</div>';
      $rater.='</div>';
      $rater.='</div>';
     // $text = $tp->parseTemplate($rater)."\n";
 }

 } 
 return $rater; 
}

   function getAllItems($cat){
$sql = new db;
$sql->db_select($cat, "*");
   switch($cat){
		case "news":
		$col = "news_id";
		break;
		case "download":
		$col = "download_id";
		break;
		case "comments":
		$col = "comment_id";
		break;
		case "user":
		$col = "user_id";
		break;
		}
while ($row = $sql ->db_fetch()){
$query = new db; 
if (!$query->db_select("ratings", "*", "rate_id='".$row[$col]."' AND total_cat = '$cat' ")) {
$result = new db;
$result->db_Insert("ratings", array("rate_id" => $row[$col], "total_votes" => 0, "total_value" => 0, "total_cat" => $cat, "used_ips" => ''));

}


}
   
   }
   
   function exclude_children($row, $cid, $cat, $col) {
  global $sql;
  $c_del[] = $cid;
  while (list ($key, $cid) = each ($c_del)) {
  $p = explode('-',$cid);
 	$cat = $p[1];
	$id = $p[0];
	if ( $sql->db_Select("ratings", "*", "rate_id='$id' AND rate_this='0' AND total_cat = '$cat'") ){
	$sql->db_Update("ratings","rate_this = '1' WHERE rate_id='$id' AND total_cat = '$cat' ");
	} else {
  $sql->db_Update("ratings","rate_this = '0' WHERE rate_id='$id' AND total_cat = '$cat'");
  }
  }
 }
 
 
  function update_old($cat, $id, $b, $col) {
  
  global $sql;
  
		$sql->db_Update($cat, "{$col}='$b' WHERE {$cat}_id='$id'");
		
 }
 
 function get_cat($id,$cat){
$tab = $cat;
switch ($cat){
case "comments":
$cat = "comment";
}
$sql = new db;
$sql->db_select($tab,"*","{$cat}_id = {$id}");
 while($r = $sql->db_Fetch()){
extract($r);

switch ($cat){
case "news":
$text .= "<a href='".e_BASE."{$cat}.php?item.{$id}'>".$r["{$cat}_title"]."</a>";
break;
case "download":
$text .= "<a href='".e_BASE."{$cat}.php?view.{$id}'>".$r["{$cat}_name"]."</a>";
break;
case "comment":
$text .= "<a href='".e_BASE."{$cat}.php?comment.news.{$id}'>".$r["{$cat}_subject"]."</a>";
break;
case "user":
$text .= "<a href='".e_BASE."{$cat}.php?id.{$id}'>".$r["{$cat}_name"]."</a>";
break;
    }
  } 
  return $text;

}

function getIps($array){
$session_data = unserialize($array);
    
	  if (!is_array($session_data)) {
        // something went wrong, initialize to empty array
        $session_data = array();
    }
    
    
    foreach ($session_data as $data){
    $text .= $data." ";
    }
    return " ".$text;
}
 
 
 function get_status($status){
 
 if ($status == '1'){
 return "<span style='color:red'>".LAN_RATINGS_18."</span>";
 }
 return "<span style='color:green'>".LAN_RATINGS_19."</span>";
 }
?>