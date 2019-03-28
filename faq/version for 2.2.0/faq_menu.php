<?php
if (!defined('e107_INIT'))
{
    exit;
}
require_once("includes/faq_class.php");
if (!is_object($faq_obj))
{
    $faq_obj = new FAQ;
}
global $sql, $tp, $FAQ_PREF,$PLUGIN_DIRECTORY;
if (!$faq_obj->faq_read)
{
    return;
}
$faq_show = false;
$faq_list = array();
$faq_url = SITEURL .$PLUGIN_DIRECTORY . "faq/";
$faq_text = "<div class='fborder' style='text-align:center;padding:3px;'>";
// Random menu item
if ($faq_obj->faq_random)
{
    $faq_show = true;
    $faq_arg = "
	select * from #faq
	left join #faq_info on faq_parent = faq_info_id
	where faq_approved > 0 and find_in_set(faq_info_class,'" . USERCLASS_LIST . "')
	order by rand()
	limit 0,1";

    if ($sql->db_Select_Gen($faq_arg, false))
    {
        $faq_row = $sql->db_Fetch();
        // $faq_text.="<div class='fbroder' style='text-align:center;'>".FAQLAN_85."<br /><strong>". $faq_row['faq_question']."</strong><br /><a href='".$faq_url."faq.php?cat.".$faq_row['faq_parent'].".".$faq_row['faq_id']."' >".FAQLAN_86."</a></div>";
        $faq_text .= "<div class='forumheader3'><strong>" . FAQLAN_104 . "</strong><br /><br /><a href='" . e_PLUGIN . "faq/faq.php?0.cat." . $faq_row['faq_parent'] . "." . $faq_row['faq_id'] . "' >" . $tp->toHTML($faq_row['faq_question']) . "</a><br /><br /></div>";
    }
    else
    {
        $faq_text .= FAQLAN_99;
    }
}
if ($faq_obj->faq_topnum>0)
{
    $faq_show = true;
    if ($faqdivsl = e107::getCache()->retrieve("nq_faq_menu"))
    {
        $faq_text .= $faqdivsl;
    }
    else
    {
        $faq_arg = "select faq_id,faq_question,faq_views,faq_parent from #faq left join #faq_info on faq_parent = faq_info_id where faq_approved>0 and find_in_set(faq_info_class,'" . USERCLASS_LIST . "') order by faq_views desc limit 0," . $faq_obj->faq_topnum;
        if ($sql->db_Select_Gen($faq_arg, false))
        {
            $faq_cache .= "<div class='forumheader3' style='text-align:center;'><strong>" . FAQLAN_98 . " " . $faq_obj->faq_topnum . " " . FAQLAN_97 . "</strong><br /><br />";
            while ($faq_row = $sql->db_Fetch())
            {
                extract($faq_row);
                $faq_quest = substr($faq_question, 0, 20);
                if (strlen($faq_question) > 20)
                {
                    $faq_quest .= " ...";
                }
                $faq_cache .= "<a href='" . e_PLUGIN . "faq/faq.php?0.cat." . $faq_parent . "." . $faq_id . "' title='" . $tp->toHTML($faq_question) . "'>" . $tp->toHTML($faq_quest) . "</a> ($faq_views)<br />";
            }
            $faq_cache .= "</div>";
        }
        else
        {
            $faq_cache .= FAQLAN_100;
        }

        e107::getCache()->set("nq_faq_menu", $faq_cache);
        $faq_text.=$faq_cache;
    }
}
if (!$faq_show)
{
    $faq_text .= FAQLAN_101;
}
$faq_text .= "</div>";

$ns->tablerender($tp->toFORM($FAQ_PREF['faq_title']), $faq_text);

?>