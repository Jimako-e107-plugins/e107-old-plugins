<?php
/*
+---------------------------------------------------------------+
|        Portfolio manager for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

include_lan(e_PLUGIN . "portfolio/languages/" . e_LANGUAGE . ".php");

require_once(e_HANDLER . "userclass_class.php");

global $portfolio_shortcodes;
class portfolio
{
    var $portfolio_super = false;
    var $portfolio_post = false;
    var $portfolio_user = false;

    var $portfolio_caption = "";
    var $portfolio_perpage = 0;
    var $portfolio_cat = "";
    var $portfolio_ptl = "";
    var $portfolio_pa = "";
    var $portfolio_subcat = "";
    var $portfolio_leader = "";
    var $portfolio_activities = "";
    var $portfolio_notify = "";
    var $portfolio_show = "";
    // var $portfolio_catpich = 100;
    // var $portfolio_cattpicv = 100;
    var $portfolio_imagepich = 100;
    var $portfolio_imagepicw = 100;
    var $portfolio_lightbox = false;
    var $portfolio_vote = false;
    var $portfolio_comments = false;
    var $portfolio_rate = false;

    function portfolio()
    {
        global $PORTFOLIO_PREF, $pref;
        $this->load_prefs();
        $this->portfolio_super = check_class($PORTFOLIO_PREF['portfolio_adminclass']);
        $this->portfolio_post = (check_class($PORTFOLIO_PREF['portfolio_postclass']) || $this->portfolio_super);
        $this->portfolio_user = (check_class($PORTFOLIO_PREF['portfolio_userclass']) || $this->portfolio_super || $this->portfolio_post);

        $this->portfolio_caption = $PORTFOLIO_PREF['portfolio_caption'];
        $this->portfolio_perpage = $PORTFOLIO_PREF['portfolio_perpage'];
        $this->portfolio_cat = $PORTFOLIO_PREF['portfolio_cat'];
        $this->portfolio_ptl = $PORTFOLIO_PREF['portfolio_ptl'];
        $this->portfolio_pa = $PORTFOLIO_PREF['portfolio_pa'];
        $this->portfolio_subcat = $PORTFOLIO_PREF['portfolio_subcat'];
        $this->portfolio_leader = $PORTFOLIO_PREF['portfolio_leader'];
        $this->portfolio_activities = $PORTFOLIO_PREF['portfolio_activities'];
        $this->portfolio_notify = $PORTFOLIO_PREF['portfolio_notify'];
        $this->portfolio_show = $PORTFOLIO_PREF['portfolio_show'] == 1;
        $this->portfolio_show = true;
        // $this->portfolio_catpich = $PORTFOLIO_PREF['portfolio_catpich'];
        // $this->portfolio_cattpicv = $PORTFOLIO_PREF['portfolio_cattpicv'];
        $this->portfolio_imagepich = $PORTFOLIO_PREF['portfolio_imagepich'];
        $this->portfolio_imagepicw = $PORTFOLIO_PREF['portfolio_imagepicw'];
        $this->portfolio_lightbox = $PORTFOLIO_PREF['portfolio_lightbox'] == 1 && isset($pref['plug_installed']['lightbox']);
        $this->portfolio_vote = $PORTFOLIO_PREF['portfolio_vote'] == 1 && isset($pref['plug_installed']['vote']);
        $this->portfolio_comments = $PORTFOLIO_PREF['portfolio_comments'] == 1;
        $this->portfolio_rate = $PORTFOLIO_PREF['portfolio_rate'] == 1;
    }
    // ********************************************************************************************
    // *
    // * Portfolio load and Save prefs
    // *
    // ********************************************************************************************
    function getdefaultprefs()
    {
        global $PORTFOLIO_PREF, $pref;
        // otherwise create new default prefs
        $PORTFOLIO_PREF = array("portfolio_adminclass" => 255,
            "portfolio_postclass" => 255,
            "portfolio_userclass" => 0,
            "portfolio_notify" => "portfolioadmin@yourdomain.com",
            "portfolio_show" => 1,
            "portfolio_imagepich" => "100",
            "portfolio_imagepicv" => "100",
            "portfolio_caption" => "Who is Who",
            "portfolio_ptl" => "Category Leader",
            "portfolio_pa" => "Category Activity",
            "portfolio_cat" => "Category",
            "portfolio_leader" => "Team Leader",
            "portfolio_subcat" => "Person",
            "portfolio_activities" => "Activities",
            "portfolio_perpage" => "10",
            "portfolio_artisitsperpage" => "10",
            "portfolio_imagepich" => "100",
            "portfolio_imagepicv" => "100",
            "portfolio_metadesc" => "Father Barry's Portfolio",
            "portfolio_metakey" => "father barry",
            "portfolio_maxattach" => "100",
            "portfolio_extnattach" => "pdf,doc,rtf,txt",
            "portfolio_maximage" => "75",
            "portfolio_lightbox" => 0,
            "portfolio_vote" => 0,
            "portfolio_comments" => 0,
            "portfolio_rate" => 0,
            "portfolio_max" => 5,
            "portfolio_extnimage" => "jpg,gif,png");
    }
    function save_prefs()
    {
        global $sql, $eArrayStorage, $PORTFOLIO_PREF;
        // save preferences to database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $tmp = $eArrayStorage->WriteArray($PORTFOLIO_PREF);
        $sql->db_Update("core", "e107_value='$tmp' where e107_name='portfolio'", false);
        return ;
    }
    function load_prefs()
    {
        global $sql, $eArrayStorage, $PORTFOLIO_PREF;
        // get preferences faq_from database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $num_rows = $sql->db_Select("core", "*", "e107_name='portfolio' ");
        $row = $sql->db_Fetch();
        if (empty($row['e107_value']))
        {
            // insert default preferences if none exist
            $this->getDefaultPrefs();
            $tmp = $eArrayStorage->WriteArray($PORTFOLIO_PREF);
            $sql->db_Insert("core", "'portfolio', '$tmp' ");
            $sql->db_Select("core", "*", "e107_name='portfolio' ");
        }
        else
        {
            $PORTFOLIO_PREF = $eArrayStorage->ReadArray($row['e107_value']);
        }
        return;
    }
    function cache_clear()
    {
        global $e107cache;
        $e107cache->clear("portfoliolist");
        $e107cache->clear("portfolioproj");
        $e107cache->clear("portfoliodept");
    }
    function imageresize($portfolio_image = "", $_portfolio_targeth = 0, $_portfolio_targetw = 0)
    {
        $portfolio_size = getimagesize($portfolio_image);

        $portfolio_width = $portfolio_size[0];
        $portfolio_height = $portfolio_size[1];
        if ($_portfolio_targetw == 0)
        {
            $portfolio_percentage = ($_portfolio_targeth / $portfolio_height);
        } elseif ($_portfolio_targeth == 0)
        {
            $portfolio_percentage = ($_portfolio_targetw / $portfolio_width);
        } elseif ($portfolio_width > $portfolio_height)
        {
            $portfolio_percentage = ($_portfolio_targetw / $portfolio_width);
        } elseif (($portfolio_width < $portfolio_height))
        {
            $portfolio_percentage = ($_portfolio_targeth / $portfolio_height);
        } elseif ($portfolio_width == $portfolio_height)
        {
            $portfolio_percentage = ($_portfolio_targeth / $portfolio_height);
        }
        else
        {
            $portfolio_percentage = 1;
        }
        $portfolio_width = round($portfolio_width * $portfolio_percentage);
        $portfolio_height = round($portfolio_height * $portfolio_percentage);

        return "width:{$portfolio_width}px;height:{$portfolio_height}px;";
    }
}

?>
