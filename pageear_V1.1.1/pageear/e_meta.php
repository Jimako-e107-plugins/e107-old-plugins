<?php
global $pref;
if (!defined('e107_INIT'))
{
    exit;
}
// print_a($pref);
if ($pref['pageear_active'] == 1 && strpos(e_SELF, "admin") == 0 && strpos(e_SELF, $ADMIN_DIRECTORY) == 0 && check_class($pref['pageear_class']))
{
    // not an admin page - pageear is active and set for the correct class
    if (($pref['pageear_show'] == 0 && pageear_check()) || $pref['pageear_show'] == 1 && !pageear_check())
    {
        // if show on pages and in the list
        $footer_js[] = e_PLUGIN . "pageear/includes/AC_OETags.js";
        $footer_js[] = e_PLUGIN . "pageear/includes/pageear.js";
        // $footer_js[] = e_PLUGIN . "pageear/eolasfix.js";
        /*
<script src= '".e_PLUGIN . "pageear/includes/AC_OETags.js' mce_src= = '".e_PLUGIN . "pageear/includes/AC_OETags.js' type='text/javascript' ></script>
<script src= '".e_PLUGIN . "pageear/includes/pageear.js' mce_src= = '".e_PLUGIN . "pageear/includes/pageear.js' type='text/javascript' ></script>
<script type='text/javascript'>
	writeObjects ();
</script>
*/
        if ($pref['pageear_simplemode'] == 1)
        {
            echo"

<script type='text/javascript'>
	pagear_SmallSwf='" . e_PLUGIN . "pageear/includes/pageear_s.swf';
	pagear_BigSwf='" . e_PLUGIN . "pageear/includes/pageear_b.swf';
	pageear_large='" . e_PLUGIN . "pageear/large/" . $pref['pageear_large'] . "';
	pageear_small='" . e_PLUGIN . "pageear/small/" . $pref['pageear_small'] . "';
	pageear_speed=" . $pref['pageear_speed'] . ";
	pageear_mirror='" . $pref['pageear_mirror'] . "';
	pageear_colour='" . str_replace("#", "", $pref['pageear_colour']) . "';
	pageear_link='" . $pref['pageear_link'] . "';
	pageear_target='" . $pref['pageear_target'] . "';
	pageear_direction='" . $pref['pageear_direction'] . "';
	pageear_openonload=" . $pref['pageear_openonload'] . ";
	pageear_closeonload=" . $pref['pageear_closeonload'] . ";
	pageear_fadein=" . $pref['pageear_fadein'] . ";
</script>
<script defer='defer' src='" . e_PLUGIN . "pageear/eolasfix.js' type='text/javascript'></script>
";
        }
        else
        {
            if ($sql->db_Select("pageear_clickthru", "*", "where
			if (pageear_clickthru_purchased>0,pageear_clickthru_purchased >= pageear_clickthru_shows,1)
			and  pageear_clickthru_active> 0
			and if (pageear_clickthru_expires>0,pageear_clickthru_expires >= " . time() . ",1)
			order by rand() limit 1", "nowhere", false))
            {
                extract($sql->db_Fetch());
                $pageear_clickthru_link = SITEURL . $PLUGINS_DIRECTORY . "pageear/pageear.php?$pageear_clickthru_id";
                $sql->db_Update("pageear_clickthru", "pageear_clickthru_shows=pageear_clickthru_shows+1 where pageear_clickthru_id=$pageear_clickthru_id", false);
            }
            else
            {
                $pageear_clickthru_large = $pref['pageear_large'];
                $pageear_clickthru_small = $pref['pageear_small'];
                $pageear_clickthru_link = $pref['pageear_link'];
            }

            echo"

<script type=\"text/javascript\">
	pagear_SmallSwf='" . e_PLUGIN . "pageear/includes/pageear_s.swf';
	pagear_BigSwf='" . e_PLUGIN . "pageear/includes/pageear_b.swf';
	pageear_large='" .  e_PLUGIN . "pageear/large/" .$pageear_clickthru_large . "';
	pageear_small='" .  e_PLUGIN . "pageear/small/" .$pageear_clickthru_small . "';
	pageear_link='" . $pageear_clickthru_link . "';
	pageear_speed=" . $pref['pageear_speed'] . ";
	pageear_mirror='" . $pref['pageear_mirror'] . "';
	pageear_colour='" . str_replace("#", "", $pref['pageear_colour']) . "';
	pageear_target='" . $pref['pageear_target'] . "';
	pageear_direction='" . $pref['pageear_direction'] . "';
	pageear_openonload=" . $pref['pageear_openonload'] . ";
	pageear_closeonload=" . $pref['pageear_closeonload'] . ";
	pageear_fadein=" . $pref['pageear_fadein'] . ";
</script>
<script defer='defer' src='" . e_PLUGIN . "pageear/eolasfix.js' type='text/javascript'></script>";
        }
    }
}
function pageear_check()
{
    global $pref;
    if (empty($pref['pageear_showpages']))
    {
        if ($pref['pageear_show'] == 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    $pageear_list = explode("\n", $pref['pageear_showpages']);
    foreach($pageear_list as $pageear_page)
    {
        if (strlen($pageear_page) > 0 && strpos(e_SELF, trim($pageear_page)) > 0)
        {
            return true;
        }
    }
    return false;
}

?>