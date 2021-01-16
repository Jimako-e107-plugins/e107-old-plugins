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

/**
* cpage
*
* @package
* @author kealb
* @copyright Copyright (c) 2009
* @version 1.1
* @access public
*/
/**
* cpage
*
* @package
* @author kealb
* @copyright Copyright (c) 2009
* @version $Id$
* @access public
*/
class cpage {
    var $cpage_admin = false; // is user an admin
    var $cpage_creator = false; // permitted to create articles
    var $cpage_reader = false; // allowed to read articles
    var $cpage_prefix = false; // userid prefix
    var $cpage_allowed = 'jpg,png,gif'; // permitted uploads
    var $cpage_maxpic = '50k'; // max size
    var $cpage_poster = true; // show poster or category
    var $cpage_lockthread = false; // lock thread after post
    var $cpage_revisions = false; // make revisons
    /**
    * cpage::cpage()
    *
    * @params void
    * @return void
    * @author Barry Keal
    * @version 1.1
    * @since 1.1
    */
    function cpage()
    {
        // constructor
        global $CPAGE_PREF, $PLUGINS_DIRECTORY;
        $this->load_prefs();
        $this->cpage_admin = check_class($CPAGE_PREF['cpage_adminclass']);
        $this->cpage_creator = check_class($CPAGE_PREF['cpage_submitclass']);
        $this->cpage_reader = check_class($CPAGE_PREF['cpage_readclass']);
        $this->cpage_prefix = $CPAGE_PREF['cpage_prefix'] == 1;
        $this->cpage_poster = intval($CPAGE_PREF['cpage_poster']) == 0;
        $this->cpage_allowed = $CPAGE_PREF['cpage_allowed'] ;
        $this->cpage_maxpic = $CPAGE_PREF['cpage_maxpic'] . "k" ;
        $this->cpage_lockthread = $CPAGE_PREF['cpage_lockthread'] == 1 ;
        $this->cpage_revisions = $CPAGE_PREF['cpage_revisions'] == 1 ;
        if (file_exists(THEME . 'images/bullet2.gif')) {
            $this->bullet = "<img src='" . THEME_ABS . "images/bullet2.gif' style='border:0px;' alt='' title='' />";
        } else {
            $this->bullet = "<img src='" . SITEURL . $PLUGINS_DIRECTORY . "cpage/images/bullet2.gif' style='border:0px;' alt='' title='' />";
        }
    }
    // ********************************************************************************************
    // *
    // * Load and Save prefs
    // *
    // ********************************************************************************************
    /**
    * cpage::getdefaultprefs()
    *
    * @params void
    * @return void
    * @author Barry Keal
    * @since 1.1
    */

    function getdefaultprefs()
    {
        global $CPAGE_PREF, $sql;
        $CPAGE_PREF = array(
            "cpage_autoapprove" => 255,
            "cpage_list" => 1,
            "cpage_seo" => 0,
            "cpage_revisions" => 1,
            "cpage_inmenu" => 5,
            "cpage_rating_flag" => 1,
            "cpage_comment_flag" => 1,
            "cpage_showdate_flag" => 1,
            "cpage_lastdate_flag" => 1,
            "cpage_showauthor_flag" => 1,
            "cpage_email_flag" => 1,
            "cpage_print_flag" => 1,
            "cpage_pdf_flag" => 1,
            "cpage_views_flag" => 1,
            "cpage_unique_flag" => 1,
            "cpage_page_flag" => 1,
            "cpage_menu_flag" => 1,
            "cpage_class" => 0,
            "cpage_ip_restrict" => "",
            "cpage_timeout" => 14400,
            );
        // check what the highest value of core e107 custom page
        $sql->db_Select('page', 'max(page_id) as maxpage', 'where page_theme = ""', 'nowhere', false);
        extract($sql->db_Fetch());
        $maxpage++;
        $sql->db_Select_gen("ALTER TABLE #cpage_page AUTO_INCREMENT = {$maxpage};", false);
        // set autoincrement to 1 higher than that
    }
    /**
    * cpage::save_prefs()
    *
    * @params void
    * @return void
    * @author Barry Keal
    * @since 1.1
    */
    function save_prefs()
    {
        global $sql, $eArrayStorage, $CPAGE_PREF;
        // save preferences to database
        if (!is_object($sql)) {
            $sql = new db;
        }
        $tmp = $eArrayStorage->WriteArray($CPAGE_PREF);
        $sql->db_Update("core", "e107_value='$tmp' where e107_name='cpage'", false);
        return ;
    }
    /**
    * cpage::load_prefs()
    *
    * @params void
    * @return void
    * @author Barry Keal
    * @since 1.1
    */
    function load_prefs()
    {
        global $sql, $eArrayStorage, $CPAGE_PREF;
        // get preferences from database
        if (!is_object($sql)) {
            $sql = new db;
        }
        $num_rows = $sql->db_Select("core", "*", "e107_name='cpage' ");
        $row = $sql->db_Fetch();

        if (empty($row['e107_value'])) {
            // insert default preferences if none exist
            $this->getDefaultPrefs();
            $tmp = $eArrayStorage->WriteArray($CPAGE_PREF);
            $sql->db_Insert("core", "'cpage', '$tmp' ");
            $sql->db_Select("core", "*", "e107_name='cpage' ");
        } else {
            $CPAGE_PREF = $eArrayStorage->ReadArray($row['e107_value']);
        }
        return;
    }
    function make_url($cpage_name = '', $cpage_id = 0, $cpage_sub = 0, $cpage_title = '')
    {
        global $CPAGE_PREF;
        if ($cpage_name != '') {
            $cpage_name = $cpage_name;
        } elseif ($cpage_title != '') {
            $cpage_name = $cpage_title;
        }else {
            $cpage_name = CPAGE_CP111;
        }
        if ($CPAGE_PREF['cpage_seo'] == 1) {
            $match = array('  ', ' ', '~', '#');
            $replace = array('-', '-', '-', '-');
            $retval = str_replace($match, $replace, $cpage_name);
            return "cpage-{$cpage_id}-{$cpage_sub}-" . $retval . '.html';
        } else {
            return "cpage.php?{$cpage_id}.{$cpage_sub}";
        }
    }

    function regen_htaccess($onoff)
    {
        $hta = e_BASE . '.htaccess';
        $pattern = array("\n", "\r");
        $replace = array("", "");
        // if (is_writable($hta) || !file_exists($hta)) {
        // open the file for reading and get the contents
        $file = file($hta);
        $skip_line = false;
        unset($new_line);
        foreach($file as $line) {
            if (strpos($line, '*** CUSTOM PAGE REWRITE BEGIN ***') > 0) {
                // we start skipping
                $skip_line = true;
            }

            if (!$skip_line) {
                // print strlen($line) . '<br>';
                $new_line[] = str_replace($pattern, $replace, $line);
            }
            if (strpos($line, '*** CUSTOM PAGE REWRITE END ***') > 0) {
                $skip_line = false;
            }
        }
        if ($onoff == 'on') {
            // $base_loc = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
            $base_loc = e_HTTP;
            $new_line[] = "#*** CUSTOM PAGE REWRITE BEGIN ***";
            $new_line[] = 'RewriteEngine On';
            $new_line[] = "RewriteBase $base_loc";
            $new_line[] = 'RewriteRule cpage-([0-9]*)-([0-9]*)-([a-zA-Z0-9-]*)\.html(.*)$ cpage.php?$1.$2.$3 [L]';
            $new_line[] = 'RewriteRule cpage.html cpage.php [L]';
            $new_line[] = '#*** CUSTOM PAGE REWRITE END ***';
            $outwrite = implode("\n", $new_line);
        } else {
            $outwrite = implode("\n", $new_line);
        }
        $retval = 0;

        if ($fp = fopen(e_BASE . 'tmp.txt', 'wt')) {
            // we can open the file for reading
            if (fwrite($fp, $outwrite) !== false) {
                fclose($fp);
                // we have written the new data to temp file OK
                if (file_exists(e_BASE . 'old.htaccess')) {
                    // there is an old htaccess file so delete it
                    if (!unlink(e_BASE . 'old.htaccess')) {
                        $retval = 2;
                    }
                }
                if ($retval == 0) {
                    // old one deleted OK so rename the existing to the old one
                    if (is_readable(e_BASE . '.htaccess') && file_exists(e_BASE . 'tmp.txt')) {
                        // if there is an old .htaccess then rename it
                        if (!rename(e_BASE . '.htaccess', e_BASE . 'old.htaccess')) {
                            $retval = 3;
                        }
                    }
                }
                if ($retval == 0) {
                    // successfully renamed existing htaccess to old.htaccess
                    // so rename the temp file to .htaccess
                    if (!rename(e_BASE . 'tmp.txt', e_BASE . '.htaccess')) {
                        $retval = 4;
                    }
                }
            } else {
                // unable to open temporary file
                $retval = 5;
            }
        } else {
            fclose($fp);

            $retval = 1;
        }
        return $retval;
        // }
    }
    function clear_cache()
    {
        global $e107cache;
        $e107cache->clear('nq_cpage_ratemenu');
        $e107cache->clear('nq_cpage_commentmenu');
        $e107cache->clear('nq_cpage_viewmenu');
    }
    function cpage_time()
    {
        return time();
    }
}

?>