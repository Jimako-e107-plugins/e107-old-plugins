<?php
if ($menu_pref['onlineinfo_showbdays'] == 1)
{
    $onlineinfo_birthday_sql = new db;

    $onlineinfo_birthday_now = time();
    $onlineinfo_birthday_today = date("Y-m-d", $onlineinfo_birthday_now);
    $onlineinfo_birthday_month = date("m", $onlineinfo_birthday_now);
    $onlineinfo_birthday_day = date("d", $onlineinfo_birthday_now);
    $onlineinfo_birthday_year = date("Y", $onlineinfo_birthday_now);

    $bday_arg = "select * from #user_extended left join #user on user_extended_id = user_id where user_birthday LIKE '%-$onlineinfo_birthday_month-$onlineinfo_birthday_day' " . $bday_find;
    $onlineinfo_birthday_results = $onlineinfo_birthday_sql->db_Select_gen($bday_arg);
    // * Select the appropriate comment depending on the number of birthdays today
    switch ($onlineinfo_birthday_results)
    {
        case 0: // None today
            $BDAY_text .= ONLINEINFO_BDAY_L6 . "<br />";
            break;
        case 1: // one today
            $BDAY_text .= ONLINEINFO_BDAY_L7 . "<br />";
            break;
        default: // many today
            $BDAY_text .= ONLINEINFO_BDAY_L8 . "<br />";
            break;
    } 

    if ($menu_pref['onlineinfo_hidebdays'] == 1)
    {
        $text .= "<br /><div style='cursor:hand' title='" . ONLINEINFO_BDAY_L3 . "' onclick=\"expandit('bdays')\">
		<table style='width:" . $menu_pref['onlineinfo_width'] . "'>
		<tr><td class='smallblacktext' ><a href='javascript:void(0);' title='" . ONLINEINFO_BDAY_L3 . "'><b>&plusmn;&nbsp;" . ONLINEINFO_BDAY_L3 . "</b></a>
		</td></tr></table></div>";
        $text .= "<div id='bdays' style=\"display:none;\">";
        $text .= "<table class='forumheader3' style='width:" . $menu_pref['onlineinfo_width'] . ";'><tr><td>";
    } 
    else
    {
        $text .= "<br /><span class='smallblacktext'><b>" . ONLINEINFO_BDAY_L3 . "</b></span><br />";
    } 

    switch ($onlineinfo_birthday_results)
    {
        case 0:
            $text .= "<p style='text-align:center;'><br />" . ONLINEINFO_BDAY_L6 . "</p>";
            break;
        case 1:
            $text .= "<div style='text-align:center;'><img src='" . e_PLUGIN . "onlineinfo4_menu/images/hb.gif' alt='Happy Birthday' /></div>";
            break;
        default:
            $text .= "<div style='text-align:center;'><img src='" . e_PLUGIN . "onlineinfo4_menu/images/hb.gif' alt='Happy Birthday' /></div>";
            break;
    } 

    if ($onlineinfo_birthday_results)
    {
        while ($onlineinfo_birthday_row = $onlineinfo_birthday_sql->db_Fetch())
        {
            extract($onlineinfo_birthday_row);
            $onlineinfo_birthday_age = date("Y-m-d", $onlineinfo_birthday_now) - $user_birthday;
            $text .= "<div style='text-align:center;'><big><a href='" . e_BASE . "user.php?id." . $user_id . "'>" . $user_name . " (" . $onlineinfo_birthday_age . ")</a><br /></big></div>";
        } 
    } 
    $bday_arg = "select *,YEAR(NOW()) - YEAR(user_birthday) -( DATE_FORMAT(NOW(), '%m-%d') < DATE_FORMAT(user_birthday, '%m-%d')) AS age 
from #user_extended left join #user on user_extended_id = user_id 
where(user_birthday != '0000/00/00' AND ((DAYOFYEAR(CONCAT(DATE_FORMAT(NOW(), '%Y-'), DATE_FORMAT(user_birthday,'%m-%d'))) < DAYOFYEAR(now()))*366)+
DAYOFYEAR(CONCAT(DATE_FORMAT(NOW(), '%Y-'), DATE_FORMAT(user_birthday,'%m-%d')))>=DAYOFYEAR(now())) 
and not (DAYOFMONTH(user_birthday)=DAYOFMONTH(NOW()) and MONTH(user_birthday)=MONTH(NOW()) ) " . $bday_find . "
 ORDER BY
((DAYOFYEAR(CONCAT(DATE_FORMAT(NOW(), '%Y-'), DATE_FORMAT(user_birthday,'%m-%d'))) < DAYOFYEAR(now())) * 366) + DAYOFYEAR(CONCAT(DATE_FORMAT(NOW(), '%Y-'), DATE_FORMAT(user_birthday,'%m-%d'))),date_format(user_birthday,'%m%d') asc
limit 0," . $pref['onlineinfo_nobdays'] . "";
    // print $bday_arg;
    $onlineinfo_birthday_due = $onlineinfo_birthday_sql->db_Select_gen($bday_arg);
    // $onlineinfo_birthday_due = $onlineinfo_birthday_sql->db_Select("user", "*,YEAR(NOW()) - YEAR(user_birthday) - ( DATE_FORMAT(NOW(), '%m-%d') < DATE_FORMAT(user_birthday, '%m-%d')) AS age", "(user_birthday != '0000-00-00' AND
    // ((DAYOFYEAR(user_birthday) < DAYOFYEAR(now()))*366)+DAYOFYEAR(user_birthday)>=DAYOFYEAR(now()))  and not (DAYOFMONTH(user_birthday)=DAYOFMONTH(NOW()) and MONTH(user_birthday)=MONTH(NOW()) )
    // ORDER BY
    // ((DAYOFYEAR(user_birthday) < DAYOFYEAR(now())) * 366) + DAYOFYEAR(user_birthday),date_format(user_birthday,'%m%d') asc limit " . $pref['onlineinfo_nobdays'] . "");
    if ($onlineinfo_birthday_due)
    {
        $text .= "<br />" . ONLINEINFO_BDAY_L5 . "<br />";
        while ($onlineinfo_birthday_row = $onlineinfo_birthday_sql->db_Fetch())
        {
            extract($onlineinfo_birthday_row);
            $onlineinfo_birthday_datepart = explode("-", $user_birthday);
            $onlineinfo_birthday_age = $age + 1;
            if ($pref['onlineinfo_formatbdays'] == "1")
                $text .= "$onlineinfo_birthday_datepart[2]/$onlineinfo_birthday_datepart[1] <a title='" . $user_birthday = "$onlineinfo_birthday_datepart[2].$onlineinfo_birthday_datepart[1].$onlineinfo_birthday_datepart[0]" . "' href='" . e_BASE . "user.php?id." . $user_id . "'>" . $user_name . " (" . $onlineinfo_birthday_age . ")</a><br />";
            else
                $text .= "$onlineinfo_birthday_datepart[1]/$onlineinfo_birthday_datepart[2] <a title='" . $user_birthday = "$onlineinfo_birthday_datepart[2].$onlineinfo_birthday_datepart[1].$onlineinfo_birthday_datepart[0]" . "' href='" . e_BASE . "user.php?id." . $user_id . "'>" . $user_name . " (" . $onlineinfo_birthday_age . ")</a><br />";
        } 
    } 
    if ($menu_pref['onlineinfo_hidebdays'] == 1)
    {
        $text .= "</td></tr></table></div>";
    } 
} 

?>