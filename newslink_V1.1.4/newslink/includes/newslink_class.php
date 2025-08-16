<?php
if (!defined('e107_INIT'))
{
    exit;
}
/**
 * * Get the main requires out of the way
 */
include_lan(e_PLUGIN . "newslink/languages/" . e_LANGUAGE . ".php");

require_once(e_HANDLER . "ren_help.php");
require_once(e_HANDLER . "userclass_class.php");
e107_require_once(e_HANDLER . "secure_img_handler.php");
class newslink
{
    var $newslinks_admin = false; // is user an admin
    var $newslinks_creator = false; // permitted to create newslinks
    var $newslinks_reader = false; // allowed to read newslinks
    var $newslinks_autoapprove = false; // allowed to read newslinks
    var $newslinks_ownedit = 0; // allowed to read newslinks
    function newslink()
    {
        global $NEWSLINK_PREF;
        $this->load_prefs();
        $this->newslink_admin = check_class($NEWSLINK_PREF['newslink_adminclass']);
        $this->newslink_creator = check_class($NEWSLINK_PREF['newslink_submitclass']);
        $this->newslink_reader = check_class($NEWSLINK_PREF['newslink_readclass']);
        $this->newslink_autoapprove = check_class($NEWSLINK_PREF['newslink_autoclass']);
        $this->newslink_ownedit = ($NEWSLINK_PREF['newslink_ownedit']==1?true:false);
    }
    // ********************************************************************************************
    // *
    // * News Link load and Save prefs
    // *
    // ********************************************************************************************
    function getdefaultprefs()
    {
        global $NEWSLINK_PREF;
        $NEWSLINK_PREF = array("newslink_inmenu" => 5,
            "newslink_perpage" => 25,
            "newslink_readclass" => 255,
            "newslink_autoclass" => 255,
            "newslink_submitclass" => 0,
            "newslink_adminclass" => 255,
            "newslink_ownedit" => 0,
            "newslink_deforder" => 0,
            "newslink_metad" => "Father Barry's News Links Menu",
            "newslink_metak" => "Father Barry,news links,news link,news links menu",
            "newslink_rating" =>0,
            "newslink_captcha" =>1,
            );
    }
    function save_prefs()
    {
        global $sql, $eArrayStorage, $NEWSLINK_PREF;
        // save preferences to database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $tmp = $eArrayStorage->WriteArray($NEWSLINK_PREF);
        $sql->db_Update("core", "e107_value='$tmp' where e107_name='newslinks'", false);
        return ;
    }
    function load_prefs()
    {
        global $sql, $eArrayStorage, $NEWSLINK_PREF;
        // get preferences from database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $num_rows = $sql->db_Select("core", "*", "e107_name='newslinks' ");
        $row = $sql->db_Fetch();

        if (empty($row['e107_value']))
        {
            // insert default preferences if none exist
            $this->getDefaultPrefs();
            $tmp = $eArrayStorage->WriteArray($NEWSLINK_PREF);
            $sql->db_Insert("core", "'newslinks', '$tmp' ");
            $sql->db_Select("core", "*", "e107_name='newslinks' ");
        }
        else
        {
            $NEWSLINK_PREF = $eArrayStorage->ReadArray($row['e107_value']);
        }
        return;
    }
}

?>