<?php
require_once("includes/faq_class.php");
if (!is_object($faq_obj)) {
	$faq_obj=new FAQ;
}
global $sql, $tp, $FAQ_PREF;
if (!$faq_obj->faq_read)
{
    exit;
}
require_once(e_HANDLER . "cache_handler.php");


if ($faqdivsl = e107::getCache()->retrieve("nq_faqtop_menu"))
{
    echo $faqdivsl;
}
else
{
    $faqdivsl = "
<script type='text/javascript'>
<!--
function faqDiv(faqdivid) {

	if (document.getElementById('faqmenu'+faqdivid).style.display == 'block')
	{
		document.getElementById('faqmenu'+faqdivid).style.display = 'none';

	}
	else
	{
		document.getElementById('faqmenu'+faqdivid).style.display = 'block';
	}
}
-->
</script>
<table style='width:100%;border:0;'>
<tr>
<td style='width:100%'>
	<div id='faqdivsl0' class=\"fborder\">";

    $faq_gen = new convert;
    $faq_imode = (IMODE == "lite"?"lite/":"dark/");
    $faq_dlurl = e_BASE;
    // ********************************************************************
    // ********************************************************************
    // Top 10 by views
    // ********************************************************************
    // ********************************************************************
    $faqmenu_faqdivid = 1;
    $faqdivsl .= "
		<div class='forumheader3' >
			<div style='width:100%'>
				<div onclick=\"faqDiv(" . $faqmenu_faqdivid . ");\" style='cursor:pointer;float:left;width:80%; '>

						<img src='" . THEME_ABS . "images/bullet2.gif' alt='bullet' style='border:0;' />
							<span class='smalltext'>" . FAQLANTOP_01 . "</span>&nbsp;&nbsp;

				</div>
				<div onclick=\"faqDiv(" . $faqmenu_faqdivid . ");\" style='cursor:pointer;float:right;width:19%;text-align:right;'>

						<img id='faqexpdr" . $faqmenu_faqdivid . "' src='" . e_PLUGIN_ABS . "faq/images/expand.png' title='expand/close' alt='expand/close' style='border:0;'/>

				</div>
				<div style='clear:both;'></div>
			</div>
			<div id='faqmenu" . $faqmenu_faqdivid . "' style='display:none' >
				<div style='padding:10px' >";
    // Get top 10 FAQ
    $faq_arg="select * from #faq
    left join #faq_info on faq_parent=faq_info_id
    where faq_approved>0 and find_in_set(faq_info_class,'".USERCLASS_LIST."') order by faq_views desc limit 0," . $faq_obj->faq_topnum;
    $sql->db_Select_gen($faq_arg, false);
    while ($faq_row = $sql->db_Fetch())
    {
        $faqdivsl .= "<span class='smallblacktext'><a href='" . e_PLUGIN_ABS . "faq/faq.php?0.cat." . $faq_row['faq_parent'] . "." . $faq_row['faq_id'] . "'><strong>" . $tp->toFORM($faq_row['faq_question']) . "</strong></a> (" . $faq_row['faq_views'] . ")</span><br />";
    } // while
    $faqdivsl .= "
				</div>
			</div>
		</div>";
    // end // Top 10 by views
    // ********************************************************************
    // ********************************************************************
    // Top 10 posters
    // ********************************************************************
    // ********************************************************************
    $faqmenu_faqdivid = 2;
    $faqdivsl .= "
		<div  class='forumheader3' >
			<div style='width:100%'>
				<div onclick=\"faqDiv(" . $faqmenu_faqdivid . ");\" style='cursor:pointer;float:left;width:80%; '>

						<img src='" . THEME_ABS . "images/bullet2.gif' alt='bullet' style='border:0;' />
							<span class='smalltext'>" . FAQLANTOP_02 . "</span>&nbsp;&nbsp;

				</div>
				<div onclick=\"faqDiv(" . $faqmenu_faqdivid . ");\" style='cursor:pointer;float:right;width:19%;text-align:right;'>
						<img id='faqexpdr" . $faqmenu_faqdivid . "' src='" . e_PLUGIN_ABS . "faq/images/expand.png' title='expand/close' alt='expand/close' style='border:0;'/>
				</div>
				<div style='clear:both;'></div>
			</div>
			<div id='faqmenu" . $faqmenu_faqdivid . "' style='display:none' >
				<div style='padding:10px' >";
    // Get top 10 authors
    $sql->db_Select("faq", "faq_author, count(faq_author) as numpost", "where faq_approved > 0 group by faq_author order by numpost desc limit 0," . $faq_obj->faq_topnum, "nowhere", false);
    while ($faq_row = $sql->db_Fetch())
    {
        $faq_tmp = explode(".", $faq_row['faq_author'], 2);

        $faqdivsl .= "<span class='smallblacktext'><a href='" . "../../user.php?id." . $faq_tmp[0] . "'><strong>" . $tp->toFORM($faq_tmp[1]) . "</strong>" . "</a> (" . $faq_row['numpost'] . ")</span><br />";
    } // while
    $faqdivsl .= "
				</div>
			</div>
		</div>";
    // end // Top 10 posters
    // ********************************************************************
    if ($faq_obj->faq_rating)
    {
        // ********************************************************************
        // Top 10 by rating
        // ********************************************************************
        // ********************************************************************
        $faqmenu_faqdivid = 3;
        $faqdivsl .= "
		<div  class='forumheader3' >
			<div style='width:100%'>
				<div onclick=\"faqDiv(" . $faqmenu_faqdivid . ");\" style='cursor:pointer;float:left;width:80%; '>
						<img src='" . THEME_ABS . "images/bullet2.gif' alt='bullet' style='border:0;' />
							<span class='smalltext'>" . FAQLANTOP_03 . "</span>&nbsp;&nbsp;
				</div>
				<div onclick=\"faqDiv(" . $faqmenu_faqdivid . ");\" style='cursor:pointer;float:right;width:19%;text-align:right;'>
						<img id='faqexpdr" . $faqmenu_faqdivid . "' src='" . e_PLUGIN_ABS . "faq/images/expand.png' title='expand/close' alt='expand/close' style='border:0;'/>
				</div>
				<div style='clear:both;'></div>
			</div>
			<div id='faqmenu" . $faqmenu_faqdivid . "' style='display:none' >
				<div style='padding:10px' >";
        // Get top 10 authors
        $faq_arg = "select r.*,m.*, r.rate_rating/rate_votes as rating from #rate as r
        left join #faq_info on faq_parent=faq_info_id
left join #faq as m on rate_itemid=faq_id
where rate_table='faq' and faq_approved > 0 and find_in_set(faq_info_class,'".USERCLASS_LIST."')
order by rating desc
limit 0," . $faq_obj->faq_topnum;
        $sql->db_Select_gen($faq_arg, false);
        while ($faq_row = $sql->db_Fetch())
        {
            $faqdivsl .= "<span class='smallblacktext'><a href='" . e_PLUGIN_ABS . "faq/faq.php?0.cat." . $faq_row['faq_parent'] . "." . $faq_row['faq_id'] . "'><strong>" . $tp->toFORM($faq_row['faq_question']) . "</strong></a> (" . $faq_row['rating'] . ")</span><br />";
        } // while
        $faqdivsl .= "
				</div>
			</div>
		</div>";
        // end // Top 10 by rating
        // ********************************************************************
    }
    // Top 10 by comments
    // ********************************************************************
    // ********************************************************************
    $faqmenu_faqdivid = 4;
    $faqdivsl .= "
		<div  class='forumheader3' >
			<div style='width:100%'>
				<div onclick=\"faqDiv(" . $faqmenu_faqdivid . ");\" style='cursor:pointer;float:left;width:80%; '>
						<img src='" . THEME_ABS . "images/bullet2.gif' alt='bullet' style='border:0;' />
							<span class='smalltext'>" . FAQLANTOP_04 . "</span>&nbsp;&nbsp;
				</div>
				<div onclick=\"faqDiv(" . $faqmenu_faqdivid . ");\" style='cursor:pointer;float:right;width:19%;text-align:right;'>
						<img id='faqexpdr" . $faqmenu_faqdivid . "' src='" . e_PLUGIN_ABS . "faq/images/expand.png' title='expand/close' alt='expand/close' style='border:0;'/>
				</div>
				<div style='clear:both;'></div>
			</div>
			<div id='faqmenu" . $faqmenu_faqdivid . "' style='display:none' >
				<div style='padding:10px' >";
    // Get top 10 faq by comments
    $faq_arg = "select count(c.comment_item_id) as numpost,m.* from #comments as c
left join #faq as m on comment_item_id =faq_id
where faq_approved > 0 and comment_type='3' group by comment_item_id order by numpost desc limit 0," . $faq_obj->faq_topnum;

    $sql->db_Select_gen($faq_arg, false);
    while ($faq_row = $sql->db_Fetch())
    {
        $faqdivsl .= "<span class='smallblacktext'><a href='" . e_PLUGIN_ABS . "faq/faq.php?0.cat." . $faq_row['faq_parent'] . "." . $faq_row['faq_id'] . "'><strong>" . $tp->toFORM($faq_row['faq_question']) . "</strong></a> (" . $faq_row['numpost'] . ")</span><br />";
    } // while
    $faqdivsl .= "
				</div>
			</div>
		</div>";
    // end // Top 10 by comments
    // ********************************************************************
    // Top 10 Categories
    // ********************************************************************
    // ********************************************************************
    $faqmenu_faqdivid = 5;
    $faqdivsl .= "
		<div  class='forumheader3' >
			<div style='width:100%'>
				<div onclick=\"faqDiv(" . $faqmenu_faqdivid . ");\" style='cursor:pointer;float:left;width:80%; '>
						<img src='" . THEME_ABS . "images/bullet2.gif' alt='bullet' style='border:0;' />
							<span class='smalltext'>" . FAQLANTOP_05 . "</span>&nbsp;&nbsp;
				</div>
				<div onclick=\"faqDiv(" . $faqmenu_faqdivid . ");\" style='cursor:pointer;float:right;width:19%;text-align:right;'>
						<img id='faqexpdr" . $faqmenu_faqdivid . "' src='" . e_PLUGIN_ABS . "faq/images/expand.png' title='expand/close' alt='expand/close' style='border:0;'/>
				</div>
				<div style='clear:both;'></div>
			</div>
			<div id='faqmenu" . $faqmenu_faqdivid . "' style='display:none' >
				<div style='padding:10px' >";
    // Get top 10 authors
    $faq_arg = "select COUNT(faq_id) as numpost,c.*,r.* from #faq_info as c
left join #faq as r on faq_info_id=faq_parent
where faq_approved > 0  and find_in_set(c.faq_info_class,'".USERCLASS_LIST."')
group by faq_info_id
order by numpost desc
limit 0," . $faq_obj->faq_topnum;
    $sql->db_Select_gen($faq_arg, false);
    while ($faq_row = $sql->db_Fetch())
    {
        $faqdivsl .= "<span class='smallblacktext'><a href='" . e_PLUGIN_ABS . "faq/faq.php?0.cat." . $faq_row['faq_parent'] . "'><strong>" . $tp->toFORM($faq_row['faq_info_title']) . "</strong></a> (" . $faq_row['numpost'] . ")</span><br />";
    } // while
    $faqdivsl .= "
				</div>
			</div>
		</div>";
    // end // Top 10 categories
    // ********************************************************************
    // Top 10 Categories by views
    // ********************************************************************
    // ********************************************************************
    $faqmenu_faqdivid = 6;
    $faqdivsl .= "
		<div  class='forumheader3' >
			<div style='width:100%'>
				<div onclick=\"faqDiv(" . $faqmenu_faqdivid . ");\" style='cursor:pointer;float:left;width:80%; '>
						<img src='" . THEME_ABS . "images/bullet2.gif' alt='bullet' style='border:0;' />
							<span class='smalltext'>" . FAQLANTOP_06 . "</span>&nbsp;&nbsp;
				</div>
				<div onclick=\"faqDiv(" . $faqmenu_faqdivid . ");\" style='cursor:pointer;float:right;width:19%;text-align:right;'>
						<img id='faqexpdr" . $faqmenu_faqdivid . "' src='" . e_PLUGIN_ABS . "faq/images/expand.png' title='expand/close' alt='expand/close' style='border:0;'/>
				</div>
				<div style='clear:both;'></div>
			</div>
			<div id='faqmenu" . $faqmenu_faqdivid . "' style='display:none' >
				<div style='padding:10px' >";
    // Get top 10 by views
    $faq_arg = "select sum(r.faq_views) as numpost,c.*,r.* from #faq_info as c
left join #faq as r on faq_info_id=faq_parent
where faq_approved>0 and faq_views>0 and find_in_set(c.faq_info_class,'".USERCLASS_LIST."')
group by faq_info_id
order by numpost desc
limit 0," . $faq_obj->faq_topnum;
    $sql->db_Select_gen($faq_arg, false);
    while ($faq_row = $sql->db_Fetch())
    {
        $faqdivsl .= "<span class='smallblacktext'><a href='" . e_PLUGIN_ABS . "faq/faq.php?0.cat." . $faq_row['faq_parent'] . "'><strong>" . $tp->toFORM($faq_row['faq_info_title']) . "</strong></a> (" . $faq_row['numpost'] . ")</span><br />";
    } // while
    $faqdivsl .= "
				</div>
			</div>
		</div>
	</div>
	</td></tr></table>";
    ob_start();
    $ns->tablerender(FAQLANTOP_00, $faqdivsl);
    $faq_cache = ob_get_flush();
    e107::getCache()->set("nq_faqtop_menu", $faq_cache);
}

?>