<?php
/*
   +---------------------------------------------------------------+
   |        Enhanced Custom Pages for e107 v7xx - by Father Barry
   |
   |        This module for the e107 .7+ website system
   |        Copyright Barry Keal 2004-2009
   |
   |        Released under the terms and conditions of the
   |        GNU General Public License (http://gnu.org).
   |
   +---------------------------------------------------------------+
*/
include_lan(e_PLUGIN . "cpage/languages/" . e_LANGUAGE . "_cpage.php");
$cpage_bb['name'] = 'cpage';
$cpage_bb['onclick'] = "expandit";
$cpage_bb['onclick_var'] = "cpage_selector";
$cpage_bb['icon'] = e_PLUGIN . "cpage/images/cpage_bb_22.png";
$cpage_bb['helptext'] = CPAGE_BB_01;
$cpage_bb['function'] = 'cpage_Select';
// $cpage_bb['function_var'] = $myfunction_vars;
// only show the faq button on those pages related to the FAQs
// print $_SERVER['HTTP_REFERER'];
// if (strpos($_SERVER['HTTP_REFERER'], "/cpage") > 0 )
// {
$BBCODE_TEMPLATE .= "{BB=cpage}";
// $BBCODE_TEMPLATE_NEWSPOST .= "{BB=cpage_bb}";
$BBCODE_TEMPLATE_ADMIN .= "{BB=cpage}";
$BBCODE_TEMPLATE_CPAGE .= "{BB=cpage}";
// }

$eplug_bb[] = $cpage_bb; // add to the global list - Very Important!

// *
// *	The function to get the list of images and display them in a pop up
// *
if (!function_exists("cpage_Select")) {
    function cpage_Select($formid)
    {
        global $fl, $tp, $bbcode_imagedir, $sql;
        // if (!is_object($cpage_obj)) {
        // require_once("includes/cpage_class.php");
        // $cpage_obj = new cpage;
        // }
        $sql->db_Select('cpage_page', 'cpage_id,cpage_link', 'order by cpage_link', 'nowhere' , false);
        $page_list = $sql->db_getList();

        $text = "
		<!-- Start of cpage selector -->
		<div style='margin-left:0px;margin-right:0px; position:relative;z-index:1000;float:right;display:none' id='cpage_selector'>";
        $text .= "<div style='position:absolute; bottom:30px; right:100px'>";
        $text .= "
			<table class='fborder' style='background-color: #fff'>
				<tr>
					<td class='forumheader3' style='white-space: nowrap'>";

        if (!count($page_list)) {
            $text .= CPAGE_BB_03 . "<b>" . str_replace("../", "", $path) . "</b>";
        }else {
            $text .= "
		<select class='tbox' name='preimagfaqeselect' onchange=\"addtext(this.value); expandit('cpage_selector')\">
				<option value='' selected='selected'>" . CPAGE_BB_02 . "</option>";
            foreach($page_list as $page) {
               # $e_path = $tp->createConstants($page['path'], 1);
                #$showpath = str_replace($path, "", $page['path']);

                $text .= "<option value=\"[cpage={$page['cpage_id']}]" . $page['cpage_link'] . "[/cpage]\">" . $page['cpage_link'] . "</option>\n";
            }
            $text .= "</select>";
        }
        $text .= "</td></tr>\n
		</table></div>
	</div>\n<!-- End of cpage selector -->\n";
        return $text;
    }
}

?>