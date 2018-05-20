<?php
require_once("../../class2.php");
$qs = explode("^", e_QUERY);

if (!$qs[0] || USER == FALSE || $qs[3] > 10 || $qs[3] < 1 || strpos($qs[2], '://') !== false)
{
    header("location:".e_BASE."index.php");
    exit;
}

$table = $tp -> toDB($qs[0]);
$itemid = intval($qs[1]);
$returnurl = $tp -> toDB($qs[2]);
$rate = intval($qs[3]);

//rating is now stored as userid-rating (to retain individual users rating)
//$sep = "^";
$sep = chr(1);
$voter = USERID.$sep.intval($qs[3]);

if ($sql->db_Select("rate", "*", "rate_table='{$table}' AND rate_itemid='{$itemid}' ")) {
    $row = $sql->db_Fetch();
    $rate_voters = $row['rate_voters'].".".$voter.".";
    $sql->db_Update("rate", "rate_votes=rate_votes+1, rate_rating=rate_rating+'{$rate}', rate_voters='{$rate_voters}' WHERE rate_id='{$row['rate_id']}' ");
} else {
    $sql->db_Insert("rate", " 0, '$table', '$itemid', '$rate', '1', '.".$voter.".' ");
}

header("location:".$returnurl);
exit;?>
