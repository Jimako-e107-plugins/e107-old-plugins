<?php


if (!defined('e107_INIT'))
{
    exit;
}
include_once(e_HANDLER . 'shortcode_handler.php');

$bday_shortcodes = $tp->e_sc->parse_scbatch(__FILE__);

// * start shortcodes
/*

SC_BEGIN BDAY_TITLE
global $BDAY_results;
    switch ($BDAY_results)
    {
        case 0: // None today
            return '' ;
            break;
        case 1: // one today
            return BDAY_LAN_1a . " " . BDAY_LAN_1b ;
            break;
        default: // many today
            return BDAY_LAN_0 ;
            break;
    }
SC_END

SC_BEGIN BDAY_LOGO
global $BDAY_today;
    if ($BDAY_today && is_readable(e_PLUGIN . "bday_menu/images/bdayanimate.gif"))
    {
        return   "<img src='" . e_PLUGIN . "bday_menu/images/bdayanimate.gif' alt='" . BDAY_LAN_7 . "' title='" . BDAY_LAN_8 . "' /><br />";
    }
    else
    {
    	return '';
    }
SC_END

SC_BEGIN BDAY_AVATAR
global $pref,$bday_avatar;
if($pref['bday_avatar']==1 )
{
	return $bday_avatar;
}
else
{
	return '';
}
SC_END

SC_BEGIN BDAY_USER
global $user_id,$tp,$bday_show,$user_name;
if($parm=='nolink')
{
return $tp->toHTML($user_name, false) ;
}
else
{
return "<a href='" . e_BASE . "user.php?id." . $user_id . "'>" . $tp->toHTML($user_name, false) . "</a>";
}
SC_END

SC_BEGIN BDAY_AGE
global $user_id,$tp,$bday_show;
if($parm=='nolink')
{
	return  $bday_show;
}
else
{
	return "<a href='" . e_BASE . "user.php?id." . $user_id . "'>" . $bday_show . "</a>";
}
SC_END

SC_BEGIN BDAY_UPCOMING
global $user_id,$tp,$bday_show,$BDAY_datepart,$bday_showyear,$user_name;
if($parm=='nolink')
{
return $bday_out. $tp->toHTML($user_name, false) ;
}
else
{
	return $bday_out . " <a title='" . $user_birthday = "$BDAY_datepart[2].{$BDAY_datepart[1]}.{$bday_showyear}" . "' href='" . e_BASE . "user.php?id." . $user_id . "'>" . $tp->toHTML($user_name, false) .  "</a>";

}
SC_END

SC_BEGIN BDAY_UPDATE
global $user_id,$tp,$bday_show,$bday_out,$pref;
if($pref['bday_showdate'] == 1)
{
	if($parm=='nolink')
	{
		return $bday_out;
	}
	else
	{
		return "<a  href='" . e_BASE . "user.php?id." . $user_id . "'>$bday_out</a>";
	}
}
else
{
	return '';
}
SC_END

SC_BEGIN BDATE_UPAGE
global $user_id,$tp,$bday_show,$BDAY_datepart,$bday_showyear,$user_name;
if($parm=='nolink')
{
	return  $bday_show ;
	}
else
{
	return $bday_out . " <a href='" . e_BASE . "user.php?id." . $user_id . "'>" . $bday_show . "</a>";
}
SC_END
SC_BEGIN BDAY_DEMO
global $pref;
if(check_class($pref['bday_demographic']))
{
return '<a href="'.e_PLUGIN.'bday_menu/bday_ages.php" >'.BDAY_LAN_9.'</a>';
}
else
{
return '';
}
SC_END

SC_BEGIN BDAY_RANGE
global $bday_range;
return $bday_range;
SC_END

SC_BEGIN BDAY_TOTAL_RANGE
global $bday_total_range;
return $bday_total_range;
SC_END

SC_BEGIN BDAY_TOTAL
global $bday_total;
return $bday_total;
SC_END

SC_BEGIN BDAY_BAR
global $bday_bar;
return $bday_bar;
SC_END

SC_BEGIN BDAY_UNDEFINED
global $bday_noentry;
return $bday_noentry;
SC_END

SC_BEGIN BDAY_PERCENT
global $bday_percent;
return $bday_percent;
SC_END


*/
