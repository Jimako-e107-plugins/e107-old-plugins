<?php
/**
 * Time.php
 *
 */

define('INT_SECOND', 1);
define('INT_MINUTE', 60);
define('INT_HOUR', 3600);
define('INT_DAY', 86400);
define('INT_WEEK', 604800);

/***************************************************************************************
Time Functions
***************************************************************************************/
function get_formatted_timediff($then, $now = false)
{
    $now      = (!$now) ? time() : $now;
    $timediff = ($now - $then);
    $weeks    = (int) intval($timediff / INT_WEEK);
    $timediff = (int) intval($timediff - (INT_WEEK * $weeks));
    $days     = (int) intval($timediff / INT_DAY);
    $timediff = (int) intval($timediff - (INT_DAY * $days));
    $hours    = (int) intval($timediff / INT_HOUR);
    $timediff = (int) intval($timediff - (INT_HOUR * $hours));
    $mins     = (int) intval($timediff / INT_MINUTE);
    $timediff = (int) intval($timediff - (INT_MINUTE * $mins));
    $sec      = (int) intval($timediff / INT_SECOND);
    $timediff = (int) intval($timediff - ($sec * INT_SECOND));

    $str = '';
    if ( $weeks )
    {
        $str .= intval($weeks).'&nbsp;';
        $str .= ($weeks > 1) ? EB_TIME_L1 : EB_TIME_L2;
    }

    if ( $days )
    {
        $str .= ($str) ? ', ' : '';
        $str .= intval($days).'&nbsp;';
        $str .= ($days > 1) ? EB_TIME_L3 : EB_TIME_L4;
    }

    if ( $hours )
    {
        $str .= ($str) ? ', ' : '';
        $str .= intval($hours).'&nbsp;';
        $str .= ($hours > 1) ? EB_TIME_L5 : EB_TIME_L6;
    }

    if ( $mins )
    {
        $str .= ($str) ? ', ' : '';
        $str .= intval($mins).'&nbsp;';
        $str .= ($mins > 1) ? EB_TIME_L7 : EB_TIME_L8;
    }

/*
    if ( $sec )
    {
        $str .= ($str) ? ', ' : '';
        $str .= intval($sec).'&nbsp;';
        $str .= ($sec > 1) ? EB_TIME_L9 : EB_TIME_L10;
    }
*/
    if ( !$weeks && !$days && !$hours && !$mins && $sec )
    {
        $str .= intval($sec).'&nbsp;';
        $str .= ($sec > 1) ? EB_TIME_L9 : EB_TIME_L10;
    }

    return $str;
}
?>