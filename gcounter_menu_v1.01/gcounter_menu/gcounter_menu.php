<?php
$text = "";
// Get the type of counter
// 1 Total visits today to news / site
// 2 Unique Visits today to news /site
// 3 Total visits ever
// 4 Total unique visits ever
if ($pref['log_activate'])
{
    $date = date("Y-m-d");
    $self = "news.php";
    $gcount_caption = "";
    switch ($pref['gcount_mode'])
    {
        case 2:
            {
                $sql->db_Select("stat_counter", "*", "counter_date='$date' AND counter_url='$self' ");
                $row = $sql->db_Fetch();
                $gcount_val = ($row['counter_unique'] ? $row['counter_unique'] : "0");
                $gcount_caption = GCOUNT_2;
            } 
            break;
        case 3:
            {
                $sql->db_Select("stat_counter", "sum(counter_total) as ctot", "counter_url='$self' ");
                $row = $sql->db_Fetch();
                $gcount_val = ($row['ctot'] ? $row['ctot'] : "0");
                $gcount_caption = GCOUNT_3;
            } 
            break;
        case 4:
            {
                $sql->db_Select("stat_counter", "sum(counter_unique) as ctot", "counter_url='$self' ");
                $row = $sql->db_Fetch();
                $gcount_val = ($row['ctot'] ? $row['ctot'] : "0");
                $gcount_caption = GCOUNT_4;
            } 
            break;
        default:
            {
                $sql->db_Select("stat_counter", "*", "counter_date='$date' AND counter_url='$self' ");
                $row = $sql->db_Fetch();
                $gcount_val = ($row['counter_total'] ? $row['counter_total'] : "0");
                $gcount_caption = GCOUNT_1;
            } 
    } // switch
    if ($pref['gcount_random'] == 1)
    {
     // remember to tidy this up
	    $sql->db_Select("gcount_digits", "gcount_digit_id");
        while ($gcount_row = $sql->db_Fetch())
        {
         	extract($gcount_row);
		    $gcount[] = $gcount_digit_id;
        } 

		$gcount_rand = rand(0,count($gcount)-1);
		$gcount_set=$gcount[$gcount_rand];
    } 
    else
    {
        $gcount_set = $pref['gcount_current'];
    } 
    $text .= "<p style='text-align:center;'>" . gcounter_makeimg($gcount_val, $gcount_set) . "</p>";
    $ns->tablerender($gcount_caption, $text);
} 

if (!$pref['log_activate'] && ADMIN)
{
    $text .= "<br /><br /><span class='smalltext'>" . COUNTER_L5 . "</span><br />
	<a href='" . e_ADMIN . "log.php'>" . COUNTER_L6 . "</a>";

    $ns->tablerender($gcount_caption, $text);
} 

function gcounter_makeimg($number, $set)
{
global $PLUGINS_DIRECTORY;
    $gcount_db = new DB;
    $gcount_db->db_Select("gcount_digits", "*", "where gcount_digit_id=$set", "nowhere");
    $gcount_row = $gcount_db->db_Fetch();
    extract($gcount_row);
    $number = str_pad($number, $gcount_digit_pad, "0", STR_PAD_LEFT);
    $retval = "";
    $len = strlen($number);
    $url = SITEURL . $PLUGINS_DIRECTORY. "gcounter_menu/images/";
    for($pos = 0;$pos < $len;$pos++)
    {
        $retval .= "<img src='" . $url . substr($number, $pos, 1) . "$gcount_digit_postfix' width='$gcount_digit_width' height='$gcount_digit_height' style='border:0;' alt='" . substr($number, $pos, 1) . "'/>";
    } 
    return $retval;
} 

?>