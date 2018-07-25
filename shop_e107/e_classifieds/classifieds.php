<?php
/*
+---------------------------------------------------------------+
|        e_Classifieds Classified advert manager for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

require_once('../../class2.php');
if (!defined('e107_INIT')) {
    exit;
}

if (!is_object($eclassf_obj)) {
require_once(e_PLUGIN . 'e_classifieds/includes/eclassifieds_class.php');
    $eclassf_obj = new classifieds;
}
error_reporting(E_ALL);
require_once(e_HANDLER . "userclass_class.php");
require_once(e_HANDLER . "ren_help.php");
require_once(e_HANDLER . "date_handler.php");
require_once(e_HANDLER . "rate_class.php");
require_once(e_HANDLER . "emailprint_class.php");
require_once(e_HANDLER . 'comment_class.php');
// - force a specific category & sub_category
$force_one_cat = varset($ECLASSF_PREF['eclassf_force_main_cat'], 0);
$force_one_sub_cat = varset($ECLASSF_PREF['eclassf_force_sub_cat'], 0);
// define the over ride meta tags
// define("PAGE_NAME", ECLASSF_1);
define('e_PAGETITLE', ECLASSF_1);
if (!empty($ECLASSF_PREF['eclassf_metad'])) {
    define('META_DESCRIPTION', $ECLASSF_PREF['eclassf_metad']);
}
if (!empty($ECLASSF_PREF['eclassf_metak'])) {
    define('META_KEYWORDS', $ECLASSF_PREF['eclassf_metak']);
}
// check if we use the wysiwyg for text areas
$e_wysiwyg = 'eclassf_details';
if ($ECLASSF_PREF['wysiwyg']) {
    $WYSIWYG = true;
}
if (file_exists(e_THEME . 'eclassifieds_template.php')) {
    require_once('eclassifieds_template.php');
} else {
    require_once(e_PLUGIN . 'e_classifieds/templates/eclassifieds_template.php');
}
require_once(e_PLUGIN . 'e_classifieds/includes/eclassifieds_shortcodes.php');
$rater = new rater;
require_once(HEADERF);
// Check that access is permitted to this plugin
$eclassf_access = $eclassf_obj->eclassf_admin || $eclassf_obj->eclassf_creator || $eclassf_obj->eclassf_reader;
if (!$eclassf_access) {
    $eclassf_text = ECLASSF_40;
    $ns->tablerender(ECLASSF_1, $eclassf_text);
    require_once(FOOTERF);
    exit;
}

$eclassf_gen = new convert;

$eclassf_today = mktime(0, 0, 0, date('n', time()), date('j', time()), date('Y', time()));
if ($ECLASSF_PREF['eclassf_valid'] == 1) {
    $eclassf_today = - 1;
}
if ($ECLASSF_PREF['eclassf_approval'] == 1) {
    $eclassf_approved = ' and eclassf_approved > 0';
} else {
    $eclassf_approved = '';
}
// get the parameters passed into the script
// print_a($_REQUEST);
if (e_QUERY) {
    $eclassf_tmp = explode('.', e_QUERY);
    $eclassf_from = intval(varset($eclassf_tmp[0], 0));
    $eclassf_action = varset($eclassf_tmp[1], 'cat');
    $eclassf_catid = intval(varset($eclassf_tmp[2], 0));
    $eclassf_subid = intval(varset($eclassf_tmp[3], 0));
    $eclassf_itemid = intval(varset($eclassf_tmp[4], 0));
    $eclassf_tmp = intval(varset($eclassf_tmp[5], 0));
} else {
    $eclassf_from = intval(varset($_REQUEST['eclassf_from'], 0));
    $eclassf_action = varset($_REQUEST['eclassf_action'], 'cat');
    $eclassf_catid = intval(varset($_REQUEST['eclassf_catid'], 0));
    // $eclassf_subid = intval(varset($_REQUEST['eclassf_subid'], 0));
    foreach($_REQUEST['eclassf_subid'] as $row) {
        if ($row > 0 && $eclassf_subid == 0)
            $eclassf_subid = $row;
    }
    $eclassf_itemid = intval(varset($_REQUEST['eclassf_itemid'], 0));
    $eclassf_tmp = intval(varset($_REQUEST['eclassf_tmp'], 0));
}
// this is used if drop downs are used for sub categories to get the one that was selected
if (is_array($eclassf_subid)) {
    foreach($eclassf_subid as $row) {
        if ($row > 0) {
            $eclassf_subid = $row;
        }
    }
}
// If from not defined then make it zero - already done
// $eclassf_from = ($eclassf_from > 0?$eclassf_from: 0);
// If no per page pref set then default to 10 per page
$ECLASSF_PREF['eclassf_perpage'] = intval(varset($ECLASSF_PREF['eclassf_perpage'], 10));
if ($ECLASSF_PREF['eclassf_perpage'] < 5) $ECLASSF_PREF['eclassf_perpage'] = 10;

$eclassf_text = ''; // Start with an empty string for all cases.

// Override some of the actions if categories or subcats disabled
switch ($eclassf_action) {
    case 'cat' :
        if ($force_one_sub_cat) {
            $eclassf_action = 'list';
            $eclassf_catid = $force_one_cat;
            $eclassf_subid = $force_one_sub_cat;
        } elseif ($force_one_cat) {
            $eclassf_catid = $force_one_cat;
            $eclassf_action = 'sub';
        }
        break;
    case 'sub' :
        if ($force_one_sub_cat) {
            $eclassf_action = 'list';
            $eclassf_catid = $force_one_cat;
            $eclassf_subid = $force_one_sub_cat;
        }
        break;
    case 'list' :
        if ($force_one_sub_cat) {
            $eclassf_catid = $force_one_cat;
            $eclassf_subid = $force_one_sub_cat;
        } elseif ($force_one_cat) {
            $eclassf_catid = $force_one_cat;
        }
        break;
}
// Do the action
switch ($eclassf_action) {
    case 'mge':
    case 'new';
        require_once('add.php');
        exit;
        break;
    case 'tnc':
        $eclassf_text = $tp->parsetemplate($ECLASSF_TC, false, $eclassf_shortcodes);
        $eclassf_text .= $tp->parsetemplate($ECLASSF_FOOTER, false, $eclassf_shortcodes);
        break;

    case 'list':
        // echo "Main cat: ".$eclassf_catid."  Subcat: ".$eclassf_subid."<br />";
        global $eclassf_colspan;
        $eclassf_colspan = $ECLASSF_PREF['eclassf_thumbs'] ? 5 : 4;
        $eclassf_doapproved = ($ECLASSF_PREF['eclassf_approval'] == 1?" and eclassf_approved = 1 ":'');
        // Find name of category and sub-category
        $eclassf_arg = '
			select eclassf_catid,eclassf_catname,eclassf_subname from #eclassf_cats
			left join #eclassf_subcats on eclassf_catid=eclassf_categoryid
			where eclassf_subid="' . $eclassf_subid . '"';
        $sql->db_Select_gen($eclassf_arg, false);
        $eclassf_row = $sql->db_Fetch();
        extract($eclassf_row); // Name of category and sub-category
        // $eclassf_catid - main cat ID
        // $eclassf_subid - sub-cat ID
        // Now select items for display - needs to be this complex for security reasons!
        $eclassf_text = $tp->parsetemplate($ECLASSF_LIST_HEAD, false, $eclassf_shortcodes);
        $eclassf_arg = '
				select * from #eclassf_ads as r
				left join #eclassf_subcats as t on r.eclassf_category=t.eclassf_subid
				left join #eclassf_cats as c on t.eclassf_categoryid=c.eclassf_catid
				where r.eclassf_category="' . $eclassf_subid . '" and find_in_set(c.eclassf_catclass,"' . USERCLASS_LIST . '") ' . $eclassf_doapproved . ' and (eclassf_expires = 0 or eclassf_expires>' . $eclassf_today . ')
				order by eclassf_subname
				limit ' . $eclassf_from . ',' . $ECLASSF_PREF['eclassf_perpage'];
        // $eclassf_count = $sql->db_Count("eclassf_ads", "(*)", "where eclassf_category='{$eclassf_subid}' and $eclassf_approved and (elcassf_posted = 0 or elcassf_posted='' or elcassf_posted is null or elcassf_posted>{$eclassf_today})");
        // echo $eclassf_count." ads found in subcat: ".$eclassf_subid."<br />";
        if ($sql->db_Select_gen($eclassf_arg, false)) {
            while ($eclassf_row = $sql->db_Fetch()) { // Display items row by row
                extract($eclassf_row);
                $eclassf_temp = explode('.', $eclassf_user, 2);
                $eclassf_poster = $eclassf_temp[1];
                $eclassf_text .= $tp->parsetemplate($ECLASSF_LIST_DETAIL, false, $eclassf_shortcodes);
            } // while
        } else {
            $eclassf_text .= $tp->parsetemplate($ECLASSF_LIST_NORES, false, $eclassf_shortcodes);
        }

        $eclassf_npaction = "list.{$eclassf_catid}.{$eclassf_subid}.0";
        $eclassf_npparms = $eclassf_count . "," . $ECLASSF_PREF['eclassf_perpage'] . ',' . $eclassf_from . ',' . e_SELF . '?' . '[FROM].' . $eclassf_npaction;
        $eclassf_nextprev = $tp->parseTemplate("{NEXTPREV={$eclassf_npparms}}") ;
        $eclassf_text .= $tp->parsetemplate($ECLASSF_LIST_FOOTER, false, $eclassf_shortcodes);
        $eclassf_text .= $tp->parsetemplate($ECLASSF_FOOTER, false, $eclassf_shortcodes);
        break;
    // Display an individual item
    case 'item':
        $eclassf_arg = 'select eclassf_catname,eclassf_subname from #eclassf_cats left join #eclassf_subcats on eclassf_catid=eclassf_categoryid where eclassf_subid="' . $eclassf_subid . '"';
        $sql->db_Select_gen($eclassf_arg);
        $eclassf_row = $sql->db_Fetch(); // Get item details
        extract($eclassf_row);
        if ($force_one_sub_cat) {
            $eclassf_itemhead .= ECLASSF_112;
        } else {
            $eclassf_itemhead .= ECLASSF_45 . ' - <strong>';
            if (!$force_one_cat) {
                $eclassf_itemhead .= $tp->toHTML($eclassf_catname) . '</strong>: ' . ECLASSF_91 . ' - <strong>';
            }
            $eclassf_itemhead .= $tp->toHTML($eclassf_subname) . '</strong>';
        }

        $sql->db_Update('eclassf_ads', 'eclassf_views=eclassf_views+1 where eclassf_id=' . $eclassf_itemid . '', false);
        // needs to be this complex for security reasons!
        $eclassf_arg = '
				select *,u.user_id,u.user_name from #eclassf_ads as r
				left join #eclassf_subcats as t on r.eclassf_category=eclassf_subid
				left join #eclassf_cats on eclassf_categoryid=eclassf_catid
				left join #user as u on SUBSTRING_INDEX(r.eclassf_user,".",1) = u.user_id
				where r.eclassf_id=' . $eclassf_itemid . '
				and find_in_set(eclassf_catclass,"' . USERCLASS_LIST . '") ' . $eclassf_approved . ' and (eclassf_expires = 0 or eclassf_expires >' . $eclassf_today . ') ';
        if ($sql->db_Select_gen($eclassf_arg, false)) {
            // Get details of item
            $eclassf_row = $sql->db_Fetch();
            extract($eclassf_row);
            $eclassf_currentad = $eclassf_id;
			
            $eclassf_tmp = explode('.', $eclassf_user, 2);
            $eclassf_postername = $eclassf_tmp[1];
            $eclassf_id = $eclassf_tmp[0];
            $eclassf_pmto = $eclassf_id;
			$eclassf_seller_name = $eclassf_tmp[1];
			$eclassf_name_seller = "<a href='../../user.php?id.$eclassf_id' >" . $tp->toHTML($eclassf_seller_name) . "</a>&nbsp";
            $eclassf_left = false;
            if (empty($user_name)) {
                $eclassf_left = true;
            }
            // get the available pics and build array of pics to show
            require_once(e_HANDLER . 'file_class.php');
            $eclassf_file = new e_file;
            $eclassf_prefix =  '\b'.$eclassf_currentad . "_." ;

            $eclassf_list = $eclassf_file->get_files(e_PLUGIN . 'e_classifieds/images/classifieds/' , $eclassf_prefix, 'standard', 0, 0);
            $eclassf_count = 0;
            $eclassf_numrecs = count($eclassf_list);
            if ($eclassf_numrecs < 2 || $eclassf_gallery == 0) {
                foreach($eclassf_list as $eclassf_piclist) {
                    $eclassf_bigpic =  $eclassf_piclist['fname'];
                    // if there are less than 2 pictures (ie 1 pic)  don't do the java scrolly thingy
                    if (!empty($eclassf_bigpic) && file_exists('./images/classifieds/' . $eclassf_bigpic)) {
                        // if a picture exists then display it otherwise omit the licture line altogether
                    	$url=htmlspecialchars(e_PLUGIN."e_classifieds/image.php?eclassf_picture={$eclassf_bigpic}&eclassf_watermark={$ECLASSF_PREF['eclassf_watermark']}");
                        $eclassf_itempicture .= "
					<a href='" . $url . "&amp;eclassf_height={$ECLASSF_PREF['eclassf_pich']}' rel='lightbox.group' ><img src='" .$url . "&amp;eclassf_height={$ECLASSF_PREF['eclassf_thumbheight']}&amp;eclassf_watermark={$ECLASSF_PREF['eclassf_watermark']}' title='' style='border:0px' alt=''/></a>";
                    } else {
                        // if a picture exists then display it otherwise omit the picture line altogether
                        $eclassf_itempicture .= "";
                    }
                }
            } else {
                $eclassf_bigpicurl = SITEURL . $PLUGINS_DIRECTORY . 'e_classifieds/images/classifieds/';
                foreach($eclassf_list as $eclassf_pic) {
                	$url=htmlspecialchars(e_PLUGIN."e_classifieds/image.php?eclassf_picture={$eclassf_pic['fname']}&amp;eclassf_watermark={$ECLASSF_PREF['eclassf_watermark']}");
                    #$eclassf_bigpic = str_replace('thumb_', '', $eclassf_pic['fname']);
                    #$eclassf_picurl = $eclassf_bigpicurl . $eclassf_bigpic;
                    $eclassf_textybit .= 'leftrightslide[' . $eclassf_count . "]='<a href=\"" . $url . "&amp;eclassf_height={$ECLASSF_PREF['eclassf_pich']}\" rel=\"lightbox\" ><img src=\"" . $url . "&amp;eclassf_height={$ECLASSF_PREF['eclassf_thumbheight']}\" style=\"border:0px\" alt=\"{$eclassf_pic['fname']}\" title=\"{$eclassf_pic['fname']}\"/></a>';";
                    $eclassf_count ++;
                }
                $sliderwidth = $eclassf_numrecs * $ECLASSF_PREF['eclassf_thumbheight'];
                $eclassf_itempicture .= ECLASSF_125 . "<br />
<script type=\"text/javascript\">
<!--
/***********************************************
* Conveyor belt slideshow script- (C) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/
cell = document.getElementById('eclassf_piccell');
//alert(cell.offsetWidth + 'x' + cell.offsetHeight);
// get width of the cell we are displaying in
cellW=cell.offsetWidth ;
if(cellW >" . $sliderwidth . ")
{
	// If the cell width is greater than the size of all the images
	// set the width to the sum of all images
	newWidth=" . $sliderwidth . "
}
else
{
	// otherwise set it to the width of the cell less 5
	newWidth=cellW-5;
}
//Specify the slider's width (in pixels)
var sliderwidth=newWidth+\"px\"

//Specify the slider's height
var sliderheight=\"" . $ECLASSF_PREF['eclassf_thumbheight'] . "px\"
//Specify the slider's slide speed (larger is faster 1-10)
var slidespeed=1
//configure background color:
slidebgcolor=\"#EAEAEA\"

//Specify the slider's images
var leftrightslide=new Array()
var finalslide=''
";
                // build array bit goes in here
                $eclassf_itempicture .= $eclassf_textybit;
                $eclassf_itempicture .= "
//Specify gap between each image (use HTML):
var imagegap=\"&nbsp;&nbsp;&nbsp;\"

//Specify pixels gap between each slideshow rotation (use integer):
var slideshowgap=10


////NO NEED TO EDIT BELOW THIS LINE////////////

var copyspeed=slidespeed
leftrightslide=''+leftrightslide.join(imagegap)+''
var iedom=document.all||document.getElementById
if (iedom)
document.write('<span id=\"temp\" style=\"visibility:hidden;position:absolute;top:-100px;left:-9000px\">'+leftrightslide+'</span>')
var actualwidth=''
var cross_slide, ns_slide

function fillup()
{
	if (iedom)
	{
		cross_slide=document.getElementById? document.getElementById(\"test2\") : document.all.test2
		cross_slide2=document.getElementById? document.getElementById(\"test3\") : document.all.test3
		cross_slide.innerHTML=cross_slide2.innerHTML=leftrightslide
		actualwidth=document.all? cross_slide.offsetWidth : document.getElementById(\"temp\").offsetWidth
		cross_slide2.style.left=actualwidth+slideshowgap+\"px\"
	}
	else if (document.layers)
	{
		ns_slide=document.ns_slidemenu.document.ns_slidemenu2
		ns_slide2=document.ns_slidemenu.document.ns_slidemenu3
		ns_slide.document.write(leftrightslide)
		ns_slide.document.close()
		actualwidth=ns_slide.document.width
		ns_slide2.left=actualwidth+slideshowgap
		ns_slide2.document.write(leftrightslide)
		ns_slide2.document.close()
	}
	lefttime=setInterval(\"slideleft()\",30)
}
window.onload=fillup

function slideleft()
{
	if (iedom)
	{
		if (parseInt(cross_slide.style.left)>(actualwidth*(-1)+8))
			cross_slide.style.left=parseInt(cross_slide.style.left)-copyspeed+\"px\"
		else
			cross_slide.style.left=parseInt(cross_slide2.style.left)+actualwidth+slideshowgap+\"px\"
		if (parseInt(cross_slide2.style.left)>(actualwidth*(-1)+8))
			cross_slide2.style.left=parseInt(cross_slide2.style.left)-copyspeed+\"px\"
		else
			cross_slide2.style.left=parseInt(cross_slide.style.left)+actualwidth+slideshowgap+\"px\"
	}
	else if (document.layers)
	{
		if (ns_slide.left>(actualwidth*(-1)+8))
			ns_slide.left-=copyspeed
		else
			ns_slide.left=ns_slide2.left+actualwidth+slideshowgap

		if (ns_slide2.left>(actualwidth*(-1)+8))
			ns_slide2.left-=copyspeed
		else
			ns_slide2.left=ns_slide.left+actualwidth+slideshowgap
	}
}
if (iedom||document.layers)
{
	with (document)
	{
		//document.write('<table style=\"border:0;\" cellspacing=\"0\" cellpadding=\"0\"><tr><td style=\"text-align:left;\">')
		if (iedom)
		{
			write('<div style=\"position:relative;width:'+sliderwidth+';height:'+sliderheight+';overflow:hidden\">')
			write('<div style=\"position:absolute;width:'+sliderwidth+';height:'+sliderheight+';\" onmouseover=\"copyspeed=0\" onmouseout=\"copyspeed=slidespeed\">')
			write('<div id=\"test2\" style=\"position:absolute;left:0px;top:0px\"></div>')
			write('<div id=\"test3\" style=\"position:absolute;left:-1000px;top:0px\"></div>')
			write('</div></div>')
		}
		else if (document.layers)
		{

			write('<ilayer width='+sliderwidth+' height='+sliderheight+' name=\"ns_slidemenu\" >')
			write('<layer name=\"ns_slidemenu2\" left=0 top=0 onmouseover=\"copyspeed=0\" onmouseout=\"copyspeed=slidespeed\"></layer>')
			write('<layer name=\"ns_slidemenu3\" left=0 top=0 onmouseover=\"copyspeed=0\" onmouseout=\"copyspeed=slidespeed\"></layer>')
			write('</ilayer>')
		}
		//document.write('</td></tr></table>')
	}
}
-->
</script>
";
            }

            $eclassf_view_rating = ''; // In case no ratings displayed
            if ($ECLASSF_PREF['eclassf_userating'] && !$eclassf_left) {
                if ($ratearray = $rater->getrating('classifieds', $eclassf_id)) {
                    $eclassf_view_rating = '<img src="images/rate' . $ratearray[1] . '.png" alt="" />';

                    if ($ratearray[2] == '') {
                        $ratearray[2] = 0;
                    }
                    $eclassf_view_rating .= '&nbsp;' . $ratearray[1] . '.' . $ratearray[2] . ' &nbsp;'. ECLASSF_103a .'&nbsp;'. ECLASSF_103b .'&nbsp; ' . $ratearray[0] . '&nbsp;';
                    $eclassf_view_rating .= ($ratearray[0] == 1 ? ECLASSF_102 : ECLASSF_103);
                } else {
                    $eclassf_view_rating .= ' ' . ECLASSF_105;
                }

                if (!$rater->checkrated('classifieds', $eclassf_id) && USER) {
                    $eclassf_view_rating .= $rater->rateselect('<br /><b>' . ECLASSF_107, 'classifieds', $eclassf_id) . '</b>';
                } elseif (!USER) {
                    $eclassf_view_rating .= '&nbsp;';
                } else {
                    $eclassf_view_rating .= '&nbsp;' . ECLASSF_101;
                }

                $eclassf_namerate = "&nbsp;{$eclassf_view_rating}&nbsp;";
            } elseif ($eclassf_left) {
                $eclassf_namerate = $tp->toHTML($eclassf_postername) . '&nbsp';
            } else {
                $eclassf_namerate = "<a href='../../user.php?id.$eclassf_id' >" . $tp->toHTML($eclassf_postername) . "</a>&nbsp";
            }

            $subject = SITENAME . ECLASSF_113; // Invent an email subject
            // Break up the email address so it isn't seen by spam bot
            $eclassf_addr = explode('@', $eclassf_email);
            $eclassf_jemailaddr .= '
			<script type="text/javascript">
			<!--
			var eclassf_contact="' . $eclassf_addr[0] . ' (at) ' . $eclassf_addr[1] . '"
			var eclassf_email="' . $eclassf_addr[0] . '"
			var eclassf_emailHost="' . $eclassf_addr[1] . '?' . str_replace(' ', '%20', $subject) . '"
			document.write("<a href=" + "mail" + "to:" + eclassf_email + "@" + eclassf_emailHost+ ">" + eclassf_contact + "<\/a>" + "")
			//-->
			</script>';
            // print $ECLASSF_PREF['eclassf_counter'];
            // counter is available for all ads
            if ($ECLASSF_PREF['eclassf_counter'] == 'NONE') {
                $eclassf_itemviews = '';
            }else {
                $eclassf_itemviews = $eclassf_views;
                if ($ECLASSF_PREF['eclassf_counter'] == 'ALL' && !empty($eclassf_counter)) {
                    // user defined counter and one is set
                    $eclassf_itemviews = eclassf_makeimg($eclassf_views, $eclassf_counter);
                }
                if ($ECLASSF_PREF['eclassf_counter'] == 'ALL' && !empty($eclassf_counter)) {
                    // user defined counter and one is set
                    $eclassf_itemviews = eclassf_makeimg($eclassf_views, $eclassf_counter);
                }
                if ($ECLASSF_PREF['eclassf_counter'] != 'ALL' && $ECLASSF_PREF['eclassf_counter'] != 'NONE') {
                    // admin defined setting for counter and ignore the set chosen by the user
                    $eclassf_itemviews = eclassf_makeimg($eclassf_views, $ECLASSF_PREF['eclassf_counter']);
                }
            }
            if ($eclassf_expires > 0) {
                $eclassf_expirydate = $eclassf_gen->convert_date($eclassf_expires, 'short');
            }
        	else{
        		$eclassf_expirydate="";
        		}
            $eclassf_text = $tp->parsetemplate($ECLASSF_ITEM_HEAD, false, $eclassf_shortcodes);
            $eclassf_text .= $tp->parsetemplate($ECLASSF_ITEM_DETAIL, false, $eclassf_shortcodes);
        } else {
            $eclassf_text .= $tp->parsetemplate($ECLASSF_ITEM_NONE, false, $eclassf_shortcodes);
        }

        $eclassf_text .= '</table>';
        $eclassf_text .= $tp->parsetemplate($ECLASSF_FOOTER, false, $eclassf_shortcodes);
        break;

    case 'sub': {
            $eclassf_colspan = $ECLASSF_PREF['eclassf_icons'] > 0?3:2;
            $eclassf_from = 0;
            $eclassf_doapproved = ($ECLASSF_PREF['eclassf_approval'] == 1?" and eclassf_approved = 1 ":'');
            // get the category name
            if ($force_one_cat) {
                $eclassf_catid = $force_one_cat; // SIngle category - set the class ID
                $eclassf_subhead .= ECLASSF_111;
            } else {
                $sql->db_Select('eclassf_cats', 'eclassf_catname', 'where eclassf_catid="' . $eclassf_catid . '" ', 'nowhere', false);
                $eclassf_row = $sql->db_Fetch();
                extract($eclassf_row);
                $eclassf_subhead .= ECLASSF_47 . ' - <strong>' . $tp->toHTML($eclassf_catname) . '</strong>';
            }

            if ($ECLASSF_PREF['eclassf_subdrop'] == 1) {
                $eclassf_selector = '<select class="tbox" name="eclassf_subid[]" onchange="this.form.submit()" >';
                if (!$eclassf_subid > 0) {
                    $eclassf_selector .= '<option value="0">' . $force_one_cat?ECLASSF_98:ECLASSF_96 . '</option>';
                }
                // Now get a sub-cats listing
                $eclassf_arg = '
				select *,sum(eclassf_expires = 0 or eclassf_expires >' . $eclassf_today . ' ' . $eclassf_doapproved . ') as eclassf_count from #eclassf_subcats
				left join #eclassf_cats on eclassf_categoryid=eclassf_catid
				left join #eclassf_ads on eclassf_category = eclassf_subid
				where eclassf_categoryid=' . $eclassf_catid . '
				and find_in_set(eclassf_catclass,"' . USERCLASS_LIST . '")
				group by eclassf_subid
				order by eclassf_subname';
                $sql->db_Select_gen($eclassf_arg, false);
                while ($eclassf_row = $sql->db_Fetch()) {
                    $eclassf_row['eclassf_count'] = ($eclassf_row['eclassf_count'] > 0?$eclassf_row['eclassf_count']:0);
                    $eclassf_selector .= '<option value="' . $eclassf_row['eclassf_subid'] . '" ' . ($eclassf_row['eclassf_subid'] == $eclassf_subid?'selected="selected"':'') . ">" . $eclassf_row['eclassf_subname'] . " &nbsp;(" . $eclassf_row['eclassf_count'] . ")</option>";
                }
                $eclassf_selector .= '</select>';
                $eclassf_text = '
				<form method="post" action="' . e_SELF . '" id="subform">
                	<div>
                		<input type="hidden" name="eclassf_from" value="' . $eclassf_from . '" />
                		<input type="hidden" name="eclassf_action" value="list" />
                		<input type="hidden" name="eclassf_catid" value="' . $eclassf_catid . '" />
                		<input type="hidden" name="eclassf_itemid" value="' . $eclassf_itemid . '" />
                		<input type="hidden" name="eclassf_tmp" value="' . $eclassf_tmp . '" />
                	</div>
				';

                $eclassf_text .= $tp->parsetemplate($ECLASSF_SUB_HEADDROP, false, $eclassf_shortcodes);
                $eclassf_text .= $tp->parsetemplate($ECLASSF_SUB_DETAILDROP, false, $eclassf_shortcodes);
                $eclassf_text .= $tp->parsetemplate($ECLASSF_SUB_FOOTER, false, $eclassf_shortcodes);

                $eclassf_text .= '
			</form>';
                $eclassf_text .= $tp->parsetemplate($ECLASSF_FOOTER, false, $eclassf_shortcodes);
            } else {
                $eclassf_text .= $tp->parsetemplate($ECLASSF_SUB_HEAD, false, $eclassf_shortcodes);
                $eclassf_arg = '
				select *,sum(eclassf_expires = 0 or eclassf_expires > ' . $eclassf_today . ' ' . $eclassf_approved . ') as eclassf_count from #eclassf_subcats
				left join #eclassf_cats on eclassf_categoryid=eclassf_catid
				left join #eclassf_ads on eclassf_category = eclassf_subid
				where eclassf_categoryid=' . $eclassf_catid . '
				and find_in_set(eclassf_catclass,"' . USERCLASS_LIST . '")
				group by eclassf_subid
				order by eclassf_subname';
                if ($sql->db_Select_gen($eclassf_arg, false)) {
                    while ($eclassf_row = $sql->db_Fetch()) {
                        extract($eclassf_row);
                        $eclassf_count = ($eclassf_count > 0?$eclassf_count:0);
                        // $eclassf_count = $sql2->db_Count("eclassf_ads", "(*)", "where eclassf_category=$eclassf_subid $eclassf_approved and (elcassf_posted = 0 or elcassf_posted='' or elcassf_posted is null or elcassf_posted>$eclassf_today) ");
                        $eclassf_text .= $tp->parsetemplate($ECLASSF_SUB_DETAIL, false, $eclassf_shortcodes);
                    } // while
                } else {
                    $eclassf_text .= $tp->parsetemplate($ECLASSF_SUB_NOAD, false, $eclassf_shortcodes);
                }
                $eclassf_text .= $tp->parsetemplate($ECLASSF_SUB_FOOTER, false, $eclassf_shortcodes);
                $eclassf_text .= $tp->parsetemplate($ECLASSF_FOOTER, false, $eclassf_shortcodes);
            }

            break;
        }

    case 'cat':
    default: {
            $eclassf_colspan = ($ECLASSF_PREF['eclassf_icons'] > 0?4:3);
            $eclassf_from = 0;
            $eclassf_doapproved = ($ECLASSF_PREF['eclassf_approval'] == 1?" and eclassf_approved = 1 ":'');
            if ($ECLASSF_PREF['eclassf_subdrop'] == 1) {
                $eclassf_text .= '
				<form id="subform" method="post" action="' . e_SELF . '" >
					<div>
						<input type="hidden" name="eclassf_from" value="' . $eclassf_from . '" />
                		<input type="hidden" name="eclassf_action" value="list" />
                		<input type="hidden" name="eclassf_catid" value="' . $eclassf_catid . '" />
                		<input type="hidden" name="eclassf_itemid" value="' . $eclassf_itemid . '" />
                		<input type="hidden" name="eclassf_tmp" value="' . $eclassf_tmp . '" />
					</div>';
            }
            $eclassf_text .= $tp->parsetemplate($ECLASSF_CAT_HEAD, false, $eclassf_shortcodes);;
            if ($sql->db_Select('eclassf_cats', '*', 'where find_in_set(eclassf_catclass,"' . USERCLASS_LIST . '") order by eclassf_catname', 'nowhere', false)) {
                while ($eclassf_row = $sql->db_Fetch()) {
                    extract($eclassf_row);
                    $catsubs = '';
                    $eclassf_selarg = '
			select eclassf_subid,eclassf_subname,sum(eclassf_expires = 0 or eclassf_expires > ' . $eclassf_today . ' ' . $eclassf_doapproved . ') as eclassf_count from #eclassf_subcats
			left join #eclassf_ads on eclassf_category=eclassf_subid
			where eclassf_categoryid=' . $eclassf_catid . '
			group by eclassf_subid
			order by eclassf_subname';
                    if ($sql2->db_Select_gen($eclassf_selarg, false)) {
                        $eclassf_selector = '<select class="tbox" name="eclassf_subid[]" onchange="this.form.submit()" >';
                        $eclassf_selector .= '<option value="0" selected="selected">' . ECLASSF_98 . '</option>';
                        while ($eclassf_subs = $sql2->db_Fetch()) {
                            extract($eclassf_subs);
                            $eclassf_count = ($eclassf_count > 0?$eclassf_count:0);
                            if ($ECLASSF_PREF['eclassf_subdrop'] == 1) {
                                $eclassf_selector .= '<option value="' . $eclassf_subid . '">' . $eclassf_subname . ' (' . $eclassf_count . ')</option>';
                            } else {
                                $catsubs .= "<a href='" . e_SELF . "?$eclassf_from.list.$eclassf_catid.$eclassf_subid.$eclassf_itemid.$eclassf_tmp' >" . $tp->toHTML($eclassf_subname, false) . " ($eclassf_count)</a><br />";
                            }
                        }
                        $eclassf_selector .= "</select>&nbsp;&nbsp;<input type='button' class='tbox' onclick='this.form.submit()' name='submitit[]' value='" . ECLASSF_97 . "' />";
                    } else {
                        $catsubs = ECLASSF_81;
                    }
                    $eclassf_text .= $tp->parsetemplate($ECLASSF_CAT_DETAIL, false, $eclassf_shortcodes);
                } // while
            }

            $eclassf_text .= $tp->parsetemplate($ECLASSF_CAT_FOOTER, false, $eclassf_shortcodes);
            if ($ECLASSF_PREF['eclassf_subdrop'] == 1) {
                $eclassf_text .= "</form>";
            }
        }
        $eclassf_text .= $tp->parsetemplate($ECLASSF_FOOTER, false, $eclassf_shortcodes);
        break;
}

$ns->tablerender(ECLASSF_1, $eclassf_text);
require_once(FOOTERF);
// .
// functions
// .
function eclassf_footer()
{
    return $eclassf_retval;
}

function eclassf_makeimg($number, $set)
{
    global $ECLASSF_PREF;
    $number = str_pad($number, ($ECLASSF_PREF['eclassf_leadz'] > 0?$ECLASSF_PREF['eclassf_leadz']:0), "0", STR_PAD_LEFT);
    $retval = "";
    $len = strlen($number);
    $url = "./images/counter/";
    for($pos = 0;$pos < $len;$pos++) {
        $retval .= "<img src='" . $url . substr($number, $pos, 1) . "$set.gif' style='border:0;' alt='" . substr($number, $pos, 1) . "' />";
    }
    return $retval;
}
function eclassf_sizeimg($image)
{
    global $ECLASSF_PREF;
    $size = getimagesize($image);
    $height = $size[1];
    $width = $size[0];
    $maxheight = $ECLASSF_PREF['eclassf_pich'];
    $maxwidth = $ECLASSF_PREF['eclassf_picw'];
    if ($height > $maxheight) {
        $height = $maxheight;
        $percent = ($size[1] / $height);
        $width = ($size[0] / $percent);
    } else if ($width > $maxwidth) {
        $width = $maxwidth;
        $percent = ($size[0] / $width);
        $height = ($size[1] / $percent);
    }
    return "<img src=\"$image\" alt='picture of item' style=\"border:0;height:{$height}px;width:{$width}px;\"/>";
}

?>