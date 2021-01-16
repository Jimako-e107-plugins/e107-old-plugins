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
if (!function_exists('fnmatch')) {
    // code from http://www.phpbuilder.com/board/showthread.php?t=10369351
    /**
    * * Create function ´fnmatch´ if not already exists (if run on a Windows platform before 5.3).
    */
    function fnmatch($pattern, $string)
    {
        /**
        * * Match string in var ´$string´ against pattern in var ´$pattern´ using regular expression.
        *                                 Returns True if string matches pattern, or False if not.
        */
        return preg_match("#^" . strtr(preg_quote($pattern, '#'), array('\*' => '.*', '\?' => '.')) . "$#i", $string);
    }
}

/**
* cpage_show
*
* @package
* @author Barry Keal
* @copyright Copyright (c) 2009
* @version $Id$
* @access public
*/
/**
* cpage_show
*
* @package
* @author Administrator
* @copyright Copyright (c) 2009
* @version $Id$
* @access public
*/
class cpage_show {
    public $cpage_pageid; // the id of the record
    private $cpage_text; // the body text of the whole record
    public $cpage_page; // the body text of the current page
    private $multipage; // multiple pages?
    public $pagetitles; // titles from pages if set in bbcode
    private $pagereplace; // titles from pages if set in bbcode
    public $currentpage; // (int)the current page if multipage to show (from e_QUERY)
    public $cpage_rater;
    public $view_rating;
    public $pagecount;
    public $browser_title;
    public $comment_form; //the comment box
    public $cpage_linktitle;
    public $page_title;

    /**
    * cpage_show::__construct()
    */
    function __construct()
    {
    }
    /**
    * cpage_show::list_pages()
    *
    * @return
    */
    function list_pages()
    {
        global $tp, $cpage_row, $sql, $CPAGE_TEMPLATE, $cpage_shortcodes,$CPAGE_PREF;
        $retval = $tp->parsetemplate($CPAGE_TEMPLATE['HEADER'], false, $cpage_shortcodes);
		switch ($CPAGE_PREF['cpage_list']) {
            case 0:
                // don't get pages ;
                break;
            case 1:
                // don't use categories
                $arg = "select * from #cpage_page
                where cpage_page_flag=1 and find_in_set(cpage_class,'" . USERCLASS_LIST . "') and (cpage_showfrom = 0 OR cpage_showfrom <= " . time() . ") and (cpage_showto=0 or cpage_showto >= " . time() . ")
                order by cpage_id";
                if ($sql->db_Select_gen($arg, false)) {
                    while ($cpage_row = $sql->db_Fetch()) {
                        // check for IP address acceptable {{TO DO}}
                        $retval .= $tp->parsetemplate($CPAGE_TEMPLATE['DETAIL'], true, $cpage_shortcodes);
                    }
                } else {
                    $retval .= $tp->parsetemplate($CPAGE_TEMPLATE['NODETAIL'], true, $cpage_shortcodes);
                }

                $retval .= $tp->parsetemplate($CPAGE_TEMPLATE['FOOTER'], true, $cpage_shortcodes);

                break;
            case 2:
                // list categories in category order
                $arg = "select * from #cpage_page
                left join #cpage_category on cpage_category=cpage_cat_id
                where cpage_page_flag=1 and find_in_set(cpage_class,'" . USERCLASS_LIST . "') and (cpage_showfrom = 0 OR cpage_showfrom <= " . time() . ") and (cpage_showto=0 or cpage_showto >= " . time() . ")
                order by cpage_cat_order,cpage_id";

            	$current_cat='';
                if ($sql->db_Select_gen($arg, false)) {
                    while ($cpage_row = $sql->db_Fetch()) {
                        // check for IP address acceptable {{TO DO}}

                    	if($current_cat !=$cpage_row['cpage_cat_name']){
                    		$current_cat =$cpage_row['cpage_cat_name'];
							$retval .= $tp->parsetemplate($CPAGE_TEMPLATE['CATEGORY'], true, $cpage_shortcodes);
                    	}
						$retval .= $tp->parsetemplate($CPAGE_TEMPLATE['DETAIL'], true, $cpage_shortcodes);
                    }
                } else {
                    $retval .= $tp->parsetemplate($CPAGE_TEMPLATE['NODETAIL'], true, $cpage_shortcodes);
                }

                $retval .= $tp->parsetemplate($CPAGE_TEMPLATE['FOOTER'], true, $cpage_shortcodes); ;
                break;
            case 3:
                // list categories in alpha order
            	$arg = "select * from #cpage_page
                left join #cpage_category on cpage_category=cpage_cat_id
                where cpage_page_flag=1 and find_in_set(cpage_class,'" . USERCLASS_LIST . "') and (cpage_showfrom = 0 OR cpage_showfrom <= " . time() . ") and (cpage_showto=0 or cpage_showto >= " . time() . ")
                order by cpage_cat_name,cpage_id";
            	$current_cat='';
            	if ($sql->db_Select_gen($arg, false)) {
            		while ($cpage_row = $sql->db_Fetch()) {
            			// check for IP address acceptable {{TO DO}}

            			if($current_cat !=$cpage_row['cpage_cat_name']){
            				$current_cat =$cpage_row['cpage_cat_name'];
            				$retval .= $tp->parsetemplate($CPAGE_TEMPLATE['CATEGORY'], true, $cpage_shortcodes);
            			}
            			$retval .= $tp->parsetemplate($CPAGE_TEMPLATE['DETAIL'], true, $cpage_shortcodes);
            		}
            	} else {
            		$retval .= $tp->parsetemplate($CPAGE_TEMPLATE['NODETAIL'], true, $cpage_shortcodes);
            	}

            	$retval .= $tp->parsetemplate($CPAGE_TEMPLATE['FOOTER'], true, $cpage_shortcodes); ;
            	break;
        }
        return $retval;
    }
    /**
    * cpage_show::show_page()
    *
    * @return
    */
    function show_page($cpage_pageid = 0, $ajax)
    {
        global $tp, $cpage_row, $sql, $e107, $CPAGE_PREF, $CPAGE_TEMPLATE, $cpage_shortcodes, $cpage_currentpage;
        $cpage_valid = true;
        $cpage_ip = $e107->getip();
        // get the record to check permitted IP - move this to stored proc on server eventually
        // $sql->db_Select('cpage_page', 'cpage_ip_restrict', "where cpage_id={$cpage_pageid}", 'nowhere', false);
        // $row = $sql->db_Fetch();
        // if (!empty($row[cpage_ip_restrict]) && !$this->check_allowed($row[cpage_ip_restrict], $cpage_ip)) {
        // $retval .= $tp->parsetemplate($CPAGE_TEMPLATE['NOTIP'], false, $cpage_shortcodes);
        // } else {
        if ($sql->db_Select('cpage_view_history', '*', "where cpage_hist_page = '{$cpage_pageid}-{$cpage_ip}' ", 'nowhere' , false)) {
            // update the number of views
            $sql->db_Update('cpage_page', "cpage_views = cpage_views+1 where cpage_id={$cpage_pageid}", false);
        } else {
            // it was a unique view
            // so add to the unique table
            $sql->db_Insert("cpage_view_history", "'{$cpage_pageid}-{$cpage_ip}'", false);
            // update the number of views and unique views
            $sql->db_Update('cpage_page', "cpage_views = cpage_views+1,cpage_unique=cpage_unique+1 where cpage_id={$cpage_pageid}", false);
        }

        $arg = "select * from #cpage_page
        left join #user on substring_index(cpage_author,'.',1) = user_id where cpage_id={$cpage_pageid} and find_in_set(cpage_class,'" . USERCLASS_LIST . "') ";
        if ($cpage_pageid > 0 && $sql->db_Select_gen($arg, false)) {
            $cpage_row = $sql->db_Fetch();
            // check if passworded page
            // print_a($_SESSION);
            $cpage_pword = unserialize($_SESSION['cpage_pword']);
            $cpage_expires = $cpage_pword[$cpage_pageid];
            if (intval($CPAGE_PREF['cpage_timeout']) == 0) {
                $CPAGE_PREF['cpage_timeout'] = 1440;
            }
            $cpage_has_expired = $cpage_expires < (time() - ($CPAGE_PREF['cpage_timeout'] * 60));
            // if($cpage_has_expired)
            // print 'expired';
            if (isset($_POST['cpage_password']) && !empty($cpage_row[cpage_password]) && $cpage_has_expired) {
                // password submitted so check it
                if ($tp->toDB($_POST['cpage_password']) == $cpage_row[cpage_password]) {
                    // password OK so set session for the page and timeout
                    $cpage_pword[$cpage_pageid] = time();
                    $_SESSION['cpage_pword'] = serialize($cpage_pword);
                    $cpage_valid = true;
                    $cpage_has_expired = false;
                } else {
                    // invalid password
                    $cpage_valid = false;
                    $cpage_has_expired = true;
                }
            }
            if ((!empty($cpage_row['cpage_password']) || !$cpage_valid) && $cpage_has_expired) {
                // it is passworded so go get the password
                $retval .= "
<form action='" . e_SELF . "?{$this->cpage_pageid}' method='post' id='cpage_pword' >
	<div>
		<input type='hidden' name='cpage_pageid' value='" . $this->cpage_pageid . "' />
	</div>";
                $retval .= $tp->parsetemplate($CPAGE_TEMPLATE['PASSWORD'], false, $cpage_shortcodes);
                $retval .= "</form>";
            }else {
                // check if page expired
                if (($cpage_row['cpage_showfrom'] == 0 || $cpage_row['cpage_showfrom'] <= time()) && ($cpage_row['cpage_showto'] == 0 || $cpage_row['cpage_showto'] >= time())) {
                    // parse the page for newpage bbcode and get titles (append to page title meta from record)
                    $this->cpage_text = $cpage_row['cpage_text'];
                    if (preg_match_all("/\[newpage.*?\]/si", $this->cpage_text, $pt)) {
                        $pages = preg_split("/\[newpage.*?\]/si", $this->cpage_text, - 1, PREG_SPLIT_NO_EMPTY);
                        $this->multipage = true;
                    }
                    // print_a($pages);
                    foreach($pt[0] as $title) {
                        $this->pagetitles[] = $title;
                    }
                    if (!trim($pages[0])) {
                        $count = 0;
                        foreach($pages as $page) {
                            $pages[$count] = $pages[($count + 1)];
                            $count++;
                        }
                        unset($pages[(count($pages) - 1)]);
                    }
                    $this->cpage_linktitle = $cpage_row['cpage_title'];
                    $pageCount = count($pages);
                    $this->pagecount = $pageCount;
                    $titleCount = count($this->pagetitles);
                    /* if the vars above don't match, page 1 has no [newpage] tag, so we need to create one ... */

                    if ($pageCount != $titleCount) {
                        array_unshift($this->pagetitles, "[newpage]");
                    }

                    /* ok, titles now match pages, rename the titles if needed ... */

                    $count = 0;
                    foreach($this->pagetitles as $title) {
                        $titlep = preg_replace("/\[newpage=(.*?)\]/", "\\1", $title);
                        $this->pagetitles[$count] = ($titlep == "[newpage]" ? CPAGE_05 . " " . ($count + 1) . "&nbsp;" : $tp->toHTML($titlep, true, 'TITLE'));
                        $this->pagereplace[$count] = ($titlep == "[newpage]" ? false : true);
                        $count++;
                    }
                    // now do the meta tags
                    if (!empty($cpage_row[cpage_meta_description])) {
                        define(META_DESCRIPTION, $cpage_row[cpage_meta_description]);
                    }
                    if (!empty($cpage_row[cpage_meta_keywords])) {
                        define(META_KEYWORDS, $cpage_row[cpage_meta_keywords]);
                    }
                    // print_a($this->pagereplace);
                    // print "Current $this->currentpage";
                    if ($this->multipage) {
                        // there are multiple pages so select the necessary page
                        // copy content to page body and then render it
                        // print "current $this->currentpage";
                        $this->cpage_page = $pages[$this->currentpage];
                        $this->page_selector = $this->page_selector();
                        if ($this->pagereplace[$this->currentpage]) {
                            // a page title was defined in the page break bbcode
                            define(e_PAGETITLE, $this->pagetitles[$this->currentpage]);
                        } else {
                            // no pagebeak title so append page nn
                            define(e_PAGETITLE, $cpage_row['cpage_title']); // . ' : ' . $this->pagetitles[$this->currentpage]);
                        }
                        // now create the selector for pages.
                    } else {
                        // copy content to page body and then render it
                        define(e_PAGETITLE, $cpage_row[cpage_meta_title]);
                        $this->cpage_page = $this->cpage_text;
                    }
                    $this->browser_title = e_PAGETITLE;
                    $this->page_title = $cpage_row['cpage_title'];
                    if ($cpage_row[cpage_rating_flag]) {
                        // allowed to rate this page
                        $this->view_rating = '';
                        if ($ratearray = $this->cpage_rater->getrating("cpage", $this->cpage_pageid)) {
                            for($c = 1; $c <= $ratearray[1]; $c++) {
                                $this->view_rating .= "<img src='" . e_IMAGE . "rate/" . IMODE . "/star.png' alt='' />";
                            }
                            if ($ratearray[2]) {
                                $this->view_rating .= "<img src='" . e_IMAGE . "rate/" . IMODE . "/" . $ratearray[2] . ".png'  alt='' />";
                            }
                            if ($ratearray[2] == "") {
                                $ratearray[2] = 0;
                            }
                        } else {
                            $this->view_rating .= CPAGE_07;
                        }
                        if (!$this->cpage_rater->checkrated("cpage", $this->cpage_pageid) && USER) {
                            $this->view_rating .= $this->cpage_rater->rateselect("&nbsp;&nbsp;&nbsp;&nbsp; <b>" . CPAGE_09, "cpage", $this->cpage_pageid, false, $cpage_row['cpage_link']) . "</b>";
                        } else if (!USER) {
                            $this->view_rating .= "";
                        } else {
                            $this->view_rating .= "&nbsp;" . CPAGE_08;
                        }
                    }
                    $this->comment_form = $this->pageComment();
                    if ($ajax) {
                        $retval .= $tp->parsetemplate($CPAGE_TEMPLATE['PAGE_BODY'], true, $cpage_shortcodes);
                    } else {
                        $retval .= $tp->parsetemplate($CPAGE_TEMPLATE['PAGE_HEADER'], true, $cpage_shortcodes);
                        $retval .= $tp->parsetemplate($CPAGE_TEMPLATE['PAGE_BODY'], true, $cpage_shortcodes);
                        $retval .= $tp->parsetemplate($CPAGE_TEMPLATE['PAGE_FOOTER'], true, $cpage_shortcodes);
                    }
                }else {
                    // page expired
                    $retval .= $tp->parsetemplate($CPAGE_TEMPLATE['PAGE_EXPIRED'], true, $cpage_shortcodes);
                }
            }
        } else {
            $retval .= $tp->parsetemplate($CPAGE_TEMPLATE['NOPAGE'], false, $cpage_shortcodes);
        }
        // }
        return $retval;
    }
    function page_selector()
    {
        global $tp, $pref, $cpage_obj;
        $itext = '';
        if (isset($pref['old_np']) && $pref['old_np']) {
            $count = 0;
            foreach($this->pagetitles as $title) {
                if (!$count) {
                    $itext = "<br /><br />";
                }
                $itext .= $this->bullet . " <a class='cpage_pagelinks' id='cpage_goto-$this->cpage_pageid-$count' href='" . $cpage_obj->make_url($this->cpage_linktitle, $this->cpage_pageid, $count) . "' >" . $title . "</a><br />\n";
                $count++;
            }
        } else {
            $total = count($this->pagetitles);
            $count = 0;
            if ($this->currentpage > 0) {
                $prev_page = $this->currentpage - 1;
                $prev = "<a class='tbox npbutton' id='cpage_prev' href='" . $cpage_obj->make_url($this->cpage_linktitle, $this->cpage_pageid, $prev_page) . "' style='text-decoration:none' >&nbsp;&nbsp;&lt;&lt;&nbsp;&nbsp;</a>";
            } else {
                $prev_page = 0;
                $prev = "<a class='tbox npbutton' id='cpage_prev' href='" . $cpage_obj->make_url($this->cpage_linktitle, $this->cpage_pageid, $prev_page) . "' style='visibility:hidden;text-decoration:none' >&nbsp;&nbsp;&lt;&lt;&nbsp;&nbsp;</a>";
            }

            if ($this->currentpage < ($total - 1)) {
                $next_page = $this->currentpage + 1;
                $next = "<a class='tbox npbutton' id='cpage_next' href='" . $cpage_obj->make_url($this->cpage_linktitle, $this->cpage_pageid, $next_page) . "' style='text-decoration:none' >&nbsp;&nbsp;&gt;&gt;&nbsp;&nbsp;</a>";
            } else {
                $next = "<a class='tbox npbutton' id='cpage_next' href='" . $cpage_obj->make_url($this->cpage_linktitle, $this->cpage_pageid, $next_page) . "' style='visibility:hidden;text-decoration:none' >&nbsp;&nbsp;&gt;&gt;&nbsp;&nbsp;</a>";
            }
            $selector = "<select class='tbox npdropdown' name='cpageSelect' id='cpageSelect' style='display:none;' onchange='location.href=this.options[selectedIndex].value'>";
            $count = 0;
            foreach($this->pagetitles as $title) {
                $selector .= "<option value='page.php?{$this->cpage_pageid}.$count' " . ($this->currentpage == $count?"selected='selected'":"") . "> " . $title . ' </option>';
                $count++;
            }
            $selector .= '</select>';

            $itext .= $prev . ' ' . $selector . ' ' . $next;
        }
        return $itext;
    }
    function pageComment()
    {
        global $cobj;
        $retval = $cobj->compose_comment("cpage", "comment", $this->cpage_pageid, 0, CPAGE_10, false, true, true);
        return $retval;
    }
    function print_page($id)
    {
        error_reporting(E_ALL);
        global $tp, $cpage_row, $sql, $sc_style, $e107, $CPAGE_PREF, $cpage_conv, $CPAGE_TEMPLATE, $cpage_shortcodes, $cpage_currentpage;

        $cpage_conv = new convert;
        $cpage_valid = true;
        $cpage_ip = $e107->getip();
        // get the record to check permitted IP - move this to stored proc on server eventually
        $sql->db_Select('cpage_page', 'cpage_ip_restrict', "where cpage_id={$id}", 'nowhere', false);
        $row = $sql->db_Fetch();
        if (!empty($row[cpage_ip_restrict]) && !$this->check_allowed($row[cpage_ip_restrict], $cpage_ip)) {
            $retval .= $tp->parsetemplate($CPAGE_TEMPLATE['NOTIP'], false, $cpage_shortcodes);
        } else {
            $arg = "select * from #cpage_page
        left join #user on substring_index(cpage_author,'.',1) = user_id where cpage_id={$id} and find_in_set(cpage_class,'" . USERCLASS_LIST . "') ";
            if ($id > 0 && $sql->db_Select_gen($arg, false)) {
                $cpage_row = $sql->db_Fetch();
                // check if passworded page
                // print_a($_SESSION);
                $cpage_pword = unserialize($_SESSION['cpage_pword']);
                $cpage_expires = intval($cpage_pword[$id]);
                if (intval($CPAGE_PREF['cpage_timeout']) == 0) {
                    $CPAGE_PREF['cpage_timeout'] = 1440;
                }
                $cpage_has_expired = $cpage_expires < (time() - ($CPAGE_PREF['cpage_timeout'] * 60));

                if (!empty($cpage_row[cpage_password]) && $cpage_has_expired) {
                    // it is passworded so go get the password
                    $retval .= "Password has expired";
                } else {
                    // parse the page for newpage bbcode and get titles (append to page title meta from record)
                    $this->cpage_text = $cpage_row[cpage_text];
                    if (preg_match_all("/\[newpage.*?\]/si", $this->cpage_text, $pt)) {
                        $pages = preg_split("/\[newpage.*?\]/si", $this->cpage_text, - 1, PREG_SPLIT_NO_EMPTY);
                        $this->multipage = true;
                    }
                    // print_a($pages);
                    foreach($pt[0] as $title) {
                        $this->pagetitles[] = $title;
                    }
                    if (!trim($pages[0])) {
                        $count = 0;
                        foreach($pages as $page) {
                            $pages[$count] = $pages[($count + 1)];
                            $count++;
                        }
                        unset($pages[(count($pages) - 1)]);
                    }

                    $pageCount = count($pages);
                    $this->pagecount = $pageCount;
                    $titleCount = count($this->pagetitles);
                    /* if the vars above don't match, page 1 has no [newpage] tag, so we need to create one ... */

                    if ($pageCount != $titleCount) {
                        array_unshift($this->pagetitles, "[newpage]");
                    }

                    /* ok, titles now match pages, rename the titles if needed ... */

                    $count = 0;
                    foreach($this->pagetitles as $title) {
                        $titlep = preg_replace("/\[newpage=(.*?)\]/", "\\1", $title);
                        $this->pagetitles[$count] = ($titlep == "[newpage]" ? CPAGE_05 . " " . ($count + 1) . "&nbsp;" : $tp->toHTML($titlep, true, 'TITLE'));
                        $this->pagereplace[$count] = ($titlep == "[newpage]" ? false : true);
                        $count++;
                    }
                    // now do the meta tags
                    // if (!empty($cpage_row[cpage_meta_description])) {
                    // define(META_DESCRIPTION, $cpage_row[cpage_meta_description]);
                    // }
                    // if (!empty($cpage_row[cpage_meta_keywords])) {
                    // define(META_KEYWORDS, $cpage_row[cpage_meta_keywords]);
                    // }
                    // print_a($this->pagereplace);
                    // print "Current $this->currentpage";
                    if ($this->multipage) {
                        // there are multiple pages so select the necessary page
                        // copy content to page body and then render it
                        // print "current $this->currentpage";
                        foreach($pages as $value) {
                            $this->cpage_page .= $value;
                        }
                        // $this->page_selector = $this->page_selector();
                        if ($this->pagereplace[$this->currentpage]) {
                            // a page title was defined in the page break bbcode
                            define(e_PAGETITLE, $this->pagetitles[$this->currentpage]);
                        } else {
                            // no pagebeak title so append page nn
                            define(e_PAGETITLE, $cpage_row[cpage_meta_title] . ' : ' . $this->pagetitles[$this->currentpage]);
                        }
                        // now create the selector for pages.
                    } else {
                        // copy content to page body and then render it
                        define(e_PAGETITLE, $cpage_row[cpage_meta_title]);
                        $this->cpage_page = $this->cpage_text;
                    }
                    $this->browser_title = e_PAGETITLE;

                    $retval .= $tp->parsetemplate($CPAGE_TEMPLATE['PAGE_PRINT'], false, $cpage_shortcodes);
                }
            }
        }

        return $retval;
    }
    function allowhost($ipaddress, $allowed_host)
    {
        // code from http://www.phpbuilder.com/board/showthread.php?t=10369351
        /**
        * * Call function ´fnmatch´ to see if var ´$hostname´ and/or var ´$ipaddress´ matches the var ´$allowed_host´.
        */
        if (fnmatch($allowed_host, $ipaddress)) {
            return true;
        } else {
            return false;
        }
    }
    function check_allowed($permitted = '', $remote_address)
    {
        /**
        * * Get string of allowed hostnames and IP-addresses from configuration
        *                                 explode $permitted in to array $allowed_list.
        */
        $allowed_list = explode(',', $permitted);
        if (empty($permitted)) {
            // if there is nothing to check then it must be OK
            return true;
        }
        // if ($remote_address == '127.0.0.1') {
        // // running on local server
        // return true;
        // }
        $retval = false;
        /**
        * * Loop through each hostname and IP-address in array $allowed_list and match
        *                                 them against the string of allowed host ips  in var $allowed_list.
        */
        foreach ($allowed_list as $allowed_host) {
            if ($this->allowhost($remote_address, strtolower($allowed_host))) {
                $retval = true;
            }
        }
        return $retval;
    }
}
require_once(e_HANDLER . 'rate_class.php');
/**
*/
class cpage_rater extends rater {
    /**
    * Constructor
    */
    function __construct()
    {
    }
    function rateselect($text, $table, $id, $mode = false, $linkname)
    {
        // we need to change this to support seo urls
        global $CPAGE_PREF, $PLUGINS_DIRECTORY, $cpage_obj;
        // $mode	: if mode is set, no urljump will be used (used in combined comments+rating system)
        $table = preg_replace('/\W/', '', $table);
        $id = intval($id);

        $self = $_SERVER['PHP_SELF'];
        if ($_SERVER['QUERY_STRING']) {
            $self .= "?" . $_SERVER['QUERY_STRING'];
        }
        $jump = "";
        $url = "";
        if ($mode == false) {
            $jump = "onchange='urljump(this.options[selectedIndex].value)'";
            $url = e_BASE . "rate.php?";
        }
        $self = e_BASE . $cpage_obj->make_url($linkname, $id, 0);
        $str = $text . "
			<select name='rateindex' " . $jump . " class='tbox'>
			<option selected='selected'  value='0'>" . RATELAN_5 . "</option>
			<option value='" . $url . "{$table}^{$id}^{$self}^1'>1</option>
			<option value='" . $url . "{$table}^{$id}^{$self}^2'>2</option>
			<option value='" . $url . "{$table}^{$id}^{$self}^3'>3</option>
			<option value='" . $url . "{$table}^{$id}^{$self}^4'>4</option>
			<option value='" . $url . "{$table}^{$id}^{$self}^5'>5</option>
			<option value='" . $url . "{$table}^{$id}^{$self}^6'>6</option>
			<option value='" . $url . "{$table}^{$id}^{$self}^7'>7</option>
			<option value='" . $url . "{$table}^{$id}^{$self}^8'>8</option>
			<option value='" . $url . "{$table}^{$id}^{$self}^9'>9</option>
			<option value='" . $url . "{$table}^{$id}^{$self}^10'>10</option>
			</select>";
        return $str;
    }
}

?>