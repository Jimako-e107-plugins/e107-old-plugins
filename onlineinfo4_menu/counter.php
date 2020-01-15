<?php
if ($menu_pref['onlineinfo_showcounter'] == 1)
{
    if (!$pref['statActivate'] == 0)
    {
        $logfile = e_PLUGIN . "log/logs/logp_" . date("z.Y", time()) . ".php";
        if (is_readable($logfile))
        {
            require($logfile);
        } 
        $logfile = e_PLUGIN . "log/logs/logi_" . date("z.Y", time()) . ".php";
        if (is_readable($logfile))
        {
            require($logfile);
        } 

        $date = date("Y-m-d");
        $self = substr(strrchr($_SERVER['PHP_SELF'], "/"), 1); 
        // $sql -> db_Select("stat_counter", "*", "counter_date='$date' AND counter_url='$self' ");
        // $row = $sql -> db_Fetch();
        // Get the all time bits
        $sql->db_Select("logstats", "log_data", "log_id='statTotal'");
        $row = $sql->db_Fetch();
        extract($row);
        $log_total = $log_data;
        $sql->db_Select("logstats", "log_data", "log_id='statUnique'");
        $row = $sql->db_Fetch();
        extract($row);
        $log_unique = $log_data;

        if ($menu_pref['onlineinfo_hidecounter'] == 1)
        {
            $text .= "<br /><div style='cursor:hand' title='" . ONLINEINFO_LOGIN_MENU_L42 . "' onclick=\"expandit('counter')\">
			<table style='width:" . $menu_pref['onlineinfo_width'] . "'>
			<tr><td class='smallblacktext' ><a href='javascript:void(0);'  title='" . ONLINEINFO_LOGIN_MENU_L42 . "'><b>&plusmn;&nbsp;" . ONLINEINFO_LOGIN_MENU_L42 . "</b></a>
			</td></tr></table></div>";
            $text .= "<div id='counter' style=\"display:none;\">";
            $text .= "<table class='forumheader3' style='width:" . $menu_pref['onlineinfo_width'] . ";'><tr><td>";
        } 
        else
        {
            $text .= "<br /><span class='smallblacktext'><b>" . ONLINEINFO_LOGIN_MENU_L42 . "</b></span><br />
			<div style='text-align:left'><left>
			<table width='" . $menu_pref['onlineinfo_width'] . ";'>";
        } 

        $text .= "<span class='smalltext'>" . ONLINEINFO_COUNTER_L2 . ": </span>" . ($siteTotal ? $siteTotal : "0") . "<br /><span class='smalltext'>" . ONLINEINFO_COUNTER_L8 . ": </span>" . ($siteUnique ? $siteUnique : "0") . "<span class='smalltext'></span>";
        $total_page_views = intval($log_total) + intval($siteTotal);
        $total_unique_views = $log_unique + $siteUnique;
        $text .= "<br /><span class='smalltext'>" . ONLINEINFO_COUNTER_L3 . ": </span>" . ($total_page_views ? $total_page_views : "0") . " <span class='smalltext'>(" . ONLINEINFO_COUNTER_L7 . ": </span>" . ($total_unique_views ? $total_unique_views : "0") . "<span class='smalltext'>)</span>";
        $sql->db_Select("stat_counter", "*", "counter_url='$self' ORDER BY counter_total DESC");
        $row = $sql->db_Fetch(); 
        // $text .= "<br /><span class='smalltext'>" . ONLINEINFO_COUNTER_L4 . ": </span>" . ($row['counter_total'] ? $row['counter_total'] : "0") . " <span class='smalltext'>(" . ONLINEINFO_COUNTER_L7 . ": </span>" . ($row['counter_unique'] ? $row['counter_unique'] : "0") . "<span class='smalltext'>)</span>";
        if ((MEMBERS_ONLINE + GUESTS_ONLINE) > ($menu_pref['most_members_online'] + $menu_pref['most_guests_online']))
        {
            $menu_pref['most_members_online'] = MEMBERS_ONLINE;
            $menu_pref['most_guests_online'] = GUESTS_ONLINE;
            $menu_pref['most_online_datestamp'] = time();
            $tmp = addslashes(serialize($menu_pref));
            $sql->db_Update("core", "e107_value='$tmp' WHERE e107_name='menu_pref' ");
        } 
        if (!is_object($gen))
        {
            $gen = new convert;
        } 

        $datestamp = $gen->convert_date($menu_pref['most_online_datestamp'], "short");
        $text .= "<br /><span class='smalltext'>" . ONLINE_EL8 . ": </span>" . ($menu_pref['most_members_online'] + $menu_pref['most_guests_online']) . "<br /><span class='smalltext'>(" . strtolower(ONLINE_EL2) . "</span>" . $menu_pref['most_members_online'] . "<span class='smalltext'>, " . strtolower(ONLINE_EL1) . "</span>" . $menu_pref['most_guests_online'] . "<span class='smalltext'>) <br />" . ONLINE_EL9 . " " . $datestamp . "</span><br />";
        $total_members = $sql->db_Count("user");

        if ($menu_pref['onlineinfo_hidecounter'] == 1)
        { 
            // $text .="</span>";
            $text .= "</td></tr></table></div>";
        } 
        else
        {
            $text .= "</table></left></div>"; 
            // $text .="</span>";
        } 
    } 

    if (!$pref['statActivate'] && ADMIN)
    {
        $text .= "<br />&nbsp;&nbsp;<span class='smalltext'>" . ONLINEINFO_COUNTER_L5 . "</span><br />
		&nbsp;&nbsp;<a href='" . e_PLUGIN . "log/admin_config.php'>" . ONLINEINFO_COUNTER_L6 . "</a><br />";
    } 
} 

?>