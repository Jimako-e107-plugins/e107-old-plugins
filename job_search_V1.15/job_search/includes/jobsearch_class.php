<?php
/*
+---------------------------------------------------------------+
|        Jokes Menu for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT'))
{
    exit;
}
/**
* * Get the main requires out of the way
*/
include_lan(e_PLUGIN . "job_search/languages/" . e_LANGUAGE . ".php");

require_once(e_HANDLER . "ren_help.php");
require_once(e_HANDLER . "userclass_class.php");
class job_search
{
    var $jobsch_admin = false; // is user an admin
    var $jobsch_creator = false; // permitted to
    var $jobsch_reader = false; // allowed to
    var $jobsch_autoapprove = false; // allowed to
    var $jobsch_ownedit = 0; // allowed to edit
    var $jobsch_perpage = 10; //
    var $jobsch_inmenu = 5; //
    var $jobsch_inrand = 5; //
    var $jobsch_vote = false; // use vote plugin
    var $jobsch_icons = false; // use icons
    var $jobsch_subcats = false; // use subcat
    var $jobsch_subscribe = false; // subscriptions enabled
    var $jobsch_reqsalary = false; // require salary
    var $jobsch_filetypes = "";
    var $jobsch_filemax = 100;
    var $jobsch_topmessage = true;
    var $jobsch_maincat = true;

    function job_search()
    {
        global $JOBSCH_PREF;
        $this->load_prefs();
        $this->jobsch_admin = check_class($JOBSCH_PREF['jobsch_admin']);
        $this->jobsch_creator = $this->jobsch_admin || check_class($JOBSCH_PREF['jobsch_create']);
        $this->jobsch_reader = $this->jobsch_creator || check_class($JOBSCH_PREF['jobsch_read']);
        $this->jobsch_autoapprove = check_class($JOBSCH_PREF['jobsch_auto']);
        $this->jobsch_filetypes = $JOBSCH_PREF['jobsch_filetypes'];
        $this->jobsch_filemax = $JOBSCH_PREF['jobsch_filemax'];
        $this->jobsch_perpage = $JOBSCH_PREF['jobsch_perpage'];
        $this->jobsch_inmenu = $JOBSCH_PREF['jobsch_inmenu'];
        $this->jobsch_inrand = $JOBSCH_PREF['jobsch_inrand'];
        $this->jobsch_vote = $JOBSCH_PREF['jobsch_vote'] == 1;
        $this->jobsch_random = $JOBSCH_PREF['jobsch_random'] == 1;
        $this->jobsch_comment = $JOBSCH_PREF['jobsch_comment'] == 1;
        $this->jobsch_icons = $JOBSCH_PREF['jobsch_icons'] == 1;
        $this->jobsch_subcats = $JOBSCH_PREF['jobsch_subcats'] == 1;
        $this->jobsch_reqsalary = $JOBSCH_PREF['jobsch_reqsalary'] == 1;
        $this->jobsch_subscribe = check_class($JOBSCH_PREF['jobsch_subscribe']);
        $this->jobsch_topmessage = strlen($JOBSCH_PREF['jobsch_topmessage']);
        $this->jobsch_maincat = $JOBSCH_PREF['jobsch_maincat'] ==1;
    }
    // ********************************************************************************************
    // *
    // * Load and Save prefs
    // *
    // ********************************************************************************************
    function getdefaultprefs()
    {
        global $JOBSCH_PREF, $pref;
        if (isset($pref['jobsch_email']))
        {
            $JOBSCH_PREF['jobsch_email'] = $pref['jobsch_email'];
            $JOBSCH_PREF['jobsch_approval'] = $pref['jobsch_approval'];
            $JOBSCH_PREF['jobsch_valid'] = $pref['jobsch_valid'];
            $JOBSCH_PREF['jobsch_read'] = $pref['jobsch_read'];
            $JOBSCH_PREF['jobsch_create'] = $pref['jobsch_create'];
            $JOBSCH_PREF['jobsch_admin'] = $pref['jobsch_admin'];
            $JOBSCH_PREF['jobsch_useremail'] = $pref['jobsch_useremail'];
            $JOBSCH_PREF['jobsch_pictype'] = $pref['jobsch_pictype'];
            $JOBSCH_PREF['jobsch_terms'] = $pref['jobsch_terms'];
            $JOBSCH_PREF['jobsch_perpage'] = $pref['jobsch_perpage'];
            $JOBSCH_PREF['jobsch_pich'] = $pref['jobsch_pich'];
            $JOBSCH_PREF['jobsch_picw'] = $pref['jobsch_picw'];
            $JOBSCH_PREF['jobsch_currency'] = $pref['jobsch_currency'];
            $JOBSCH_PREF['jobsch_metad'] = $pref['jobsch_metad'];
            $JOBSCH_PREF['jobsch_metak'] = $pref['jobsch_metak'];
            $JOBSCH_PREF['jobsch_leadz'] = $pref['jobsch_leadz'];
            $JOBSCH_PREF['jobsch_icons'] = $pref['jobsch_icons'];
            $JOBSCH_PREF['jobsch_counter'] = $pref['jobsch_counter'];
            $JOBSCH_PREF['jobsch_thumbheight'] = $pref['jobsch_thumbheight'];
            $JOBSCH_PREF['jobsch_subdrop'] = $pref['jobsch_subdrop'];
            $JOBSCH_PREF['jobsch_subscribe'] = $pref['jobsch_subscribe'];
            $JOBSCH_PREF['jobsch_sysemail'] = $pref['jobsch_sysemail'];
            $JOBSCH_PREF['jobsch_sysfrom'] = $pref['jobsch_sysfrom'];
            $JOBSCH_PREF['jobsch_sort'] = $pref['jobsch_sort'];
            $JOBSCH_PREF['jobsch_usexp'] = $pref['jobsch_usexp'];
            $JOBSCH_PREF['jobsch_dform'] = $pref['jobsch_dform'];
            unset($pref['jobsch_email']);
            unset($pref['jobsch_approval']);
            unset($pref['jobsch_valid']);
            unset($pref['jobsch_read']);
            unset($pref['jobsch_create']);
            unset($pref['jobsch_admin']);
            unset($pref['jobsch_useremail']);
            unset($pref['jobsch_pictype']);
            unset($pref['jobsch_terms']);
            unset($pref['jobsch_perpage']);
            unset($pref['jobsch_pich']);
            unset($pref['jobsch_picw']);
            unset($pref['jobsch_currency']);
            unset($pref['jobsch_metad']);
            unset($pref['jobsch_metak']);
            unset($pref['jobsch_leadz']);
            unset($pref['jobsch_icons']);
            unset($pref['jobsch_counter']);
            unset($pref['jobsch_thumbheight']);
            unset($pref['jobsch_subdrop']);
            unset($pref['jobsch_subscribe']);
            unset($pref['jobsch_sysemail']);
            unset($pref['jobsch_sysfrom']);
            unset($pref['jobsch_sort']);
            unset($pref['jobsch_usexp']);
            unset($pref['jobsch_dform']);
            save_prefs();
        }
        else
        {
            $JOBSCH_PREF = array("jobsch_email" => "youremail@example.com",
                "jobsch_approval" => "yes",
                "jobsch_valid" => "14",
                "jobsch_read" => "0",
                "jobsch_admin" => "255",
                "jobsch_auto" => "255",
                "jobsch_useremail" => "1",
                "jobsch_pictype" => "1",
                "jobsch_perpage" => "10",
                "jobsch_inmenu" => "10",
                "jobsch_random" => "0",
                "jobsch_create" => "255",
                "jobsch_vote" => "0",
                "jobsch_picw" => "100",
                "jobsch_pich" => "100",
                "jobsch_currency" => "£",
                "jobsch_icons" => "1",
                "jobsch_thumbheight" => "50",
                "jobsch_subscribe", 255,
                "jobsch_sysemail", "Site Admin",
                "jobsch_sysfrom", "admin@example.com",
                "jobsch_filetypes=", "rtf,pdf,txt,doc",
                "jobsch_filemax=", 100,
                "jobsch_lastnews" => 0,
                "jobsch_sort" => "DESC",
                "jobsch_usexp" => 1,
                "jobsch_subcats" => 1,
                "jobsch_dform" => "d-m-Y",
                "jobsch_metak" => "father barry,father,barry,job,search,shack,job search,job shack",
                "jobsch_metad" => "Father Barry e107 job shack plugin. You can get all the latest vacancy news from here. ",
                "jobsch_terms" => "Only suitable vacancies will be accepted. Job adverts will be checked. This site is not responsible for the goods or services"
                );
        }
    }
    function save_prefs()
    {
        global $sql, $eArrayStorage, $JOBSCH_PREF;
        // save preferences to database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $tmp = $eArrayStorage->WriteArray($JOBSCH_PREF);
        $sql->db_Update("core", "e107_value='$tmp' where e107_name='jobsearch'", false);
        return ;
    }
    function load_prefs()
    {
        global $sql, $eArrayStorage, $JOBSCH_PREF;
        // get preferences from database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $num_rows = $sql->db_Select("core", "*", "e107_name='jobsearch' ");
        $row = $sql->db_Fetch();
        if (empty($row['e107_value']))
        {
            // insert default preferences if none exist
            $this->getDefaultPrefs();
            $tmp = $eArrayStorage->WriteArray($JOBSCH_PREF);
            $sql->db_Insert("core", "'jobsearch', '$tmp' ");
            $sql->db_Select("core", "*", "e107_name='jobsearch' ");
        }
        else
        {
            $JOBSCH_PREF = $eArrayStorage->ReadArray($row['e107_value']);
        }
        return;
    }

    function cache_clear()
    {
        global $e107cache;
        $e107cache->clear("nq_jobsch_menu");
    }
    function check_writable()
    {
        if ($jobsch_fp = @fopen("./documents/index.html", "w"))
        {
            fwrite($jobsch_fp, "");
            $retval = true;
        }
        else
        {
            $retval = false;
        }
        fclose($jobsch_fp);
        return $retval;
    }
}

?>