<?php
/*
   +---------------------------------------------------------------+
   |	Prototype and Scriptaculous Plugin for e107
   |
   |	Copyright (C) Fathr Barry Keal 2003 - 2010
   |	http://www.keal.me.uk
   |
   |	Released under the terms and conditions of the
   |	GNU General Public License (http://gnu.org).
   +---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) {
    exit;
}
/**
* * Get the main requires out of the way
*/
include_lan(e_PLUGIN . "prototype/languages/" . e_LANGUAGE . "_prototype.php");

class prototype {
    var $prototype_active = false; // is user an admin
    function __construct()
    {
        global $PROTOTYPE_PREF;
        $this->load_prefs();
        $this->prototype_active = $PROTOTYPE_PREF['prototype_active'] == 1;
        $this->prototype_mini = $PROTOTYPE_PREF['prototype_mini'];
    }
    /**
    * prototype::getdefaultprefs()
    *
    * @params void
    * @return void
    * @author Barry Keal
    * @since 1.1
    */
    function getdefaultprefs()
    {
        global $PROTOTYPE_PREF;
        $PROTOTYPE_PREF = array(
            "prototype_active" => 0,
            "prototype_mini" => 0,
            );
    }
    /**
    * prototype::load_prefs()
    *
    * @params void
    * @return void
    * @author Barry Keal
    * @since 1.1
    */
    function load_prefs()
    {
        global $sql, $eArrayStorage, $PROTOTYPE_PREF;
        // get preferences from database
        if (!is_object($sql)) {
            $sql = new db;
        }
        $num_rows = $sql->db_Select("core", "*", "e107_name='prototype' ");
        $row = $sql->db_Fetch();

        if (empty($row['e107_value'])) {
            // insert default preferences if none exist
            $this->getDefaultPrefs();
            $tmp = $eArrayStorage->WriteArray($PROTOTYPE_PREF);
            $sql->db_Insert("core", "'prototype', '$tmp' ");
            $sql->db_Select("core", "*", "e107_name='prototype' ");
        } else {
            $PROTOTYPE_PREF = $eArrayStorage->ReadArray($row['e107_value']);
        }
        return;
    }
    /**
    * prototype::save_prefs()
    *
    * @params void
    * @return void
    * @author Barry Keal
    * @since 1.1
    */
    function save_prefs()
    {
        global $sql, $eArrayStorage, $PROTOTYPE_PREF;
        // save preferences to database
        if (!is_object($sql)) {
            $sql = new db;
        }
        $tmp = $eArrayStorage->WriteArray($PROTOTYPE_PREF);
        $sql->db_Update("core", "e107_value='$tmp' where e107_name='prototype'", false);
        return ;
    }
    function message_box($mode = 'blank', $message = '')
    {
        if (!isset($mode) || empty($mode) || $mode == 'blank') {
            $vis = 'none';
        } else {
            $vis = 'block';
        }
        $retval = "<div id='fb_prototype_wrapper' style='display:$vis;width:99%;text-align:left;margin:auto;'>";
        switch ($mode) {
            case 'error':
                $retval .= "<div id='fb_prototype_message' class='fb_error' style='display:block;' >$message</div>";
                break;
            case 'warning':
                $retval .= "<div id='fb_prototype_message' class='fb_warning' style='display:block;' >$message</div>";
                break;
            case 'validation':
                $retval .= "<div id='fb_prototype_message' class='fb_validation' style='display:block;' >$message</div>";
                break;
            case 'success':
                $retval .= "<div id='fb_prototype_message' class='fb_success' style='display:block;' >$message</div>";
                break;
            case 'info':
                $retval .= "<div id='fb_prototype_message' class='fb_info' style='display:block;' >$message</div>";
                break;
            case 'blank':
                $retval .= "<div id='fb_prototype_message' class='fb_blank' style='display:block;' ></div>";
                break;
            default:
                $retval .= "<div id='fb_prototype_message' class='fb_blank' style='display:block;' ></div>";
                break;
        } // switch
        $retval .= "</div>";
        return $retval;
    }
    function help_area($id, $content, $visible = false)
    {
        $help_box = "
<div class='' ><img src='images/help.png' /></div>";
    }
}
/**
*/
class fb_newsfeed {
    /**
    * Constructor
    */
    function __construct()
    {
    }
    function newsfeed_info($which)
    {
        global $tp, $sql, $PROTOTYPE_PREF;
        $qry = "newsfeed_id = " . intval($which);

        $text = "";
        $this->checkUpdate($qry);

        /* get template */
        if (file_exists(THEME . "newsfeed_menu_template.php")) {
            include(THEME . "newsfeed_menu_template.php");
        } else {
            include(e_PLUGIN . "newsfeed/templates/newsfeed_menu_template.php");
        }

        if ($feeds = $sql->db_Select("newsfeed", "*", $qry)) {
            while ($row = $sql->db_Fetch()) {
                extract ($row);
                list($newsfeed_image, $newsfeed_showmenu, $newsfeed_showmain) = explode("::", $newsfeed_image);
                $numtoshow = ($where == 'main' ? $newsfeed_showmain : $newsfeed_showmenu);
                $numtoshow = (intval($numtoshow) > 0 ? $numtoshow : 999);
                $rss = unserialize($newsfeed_data);
                // *
                $numtoshow = $PROTOTYPE_PREF['prototype_newsnumfeed'];
                // *
                // print_a($rss);
                $FEEDNAME = "<a href='" . e_SELF . "?show.$newsfeed_id'>$newsfeed_name</a>";
                $FEEDDESCRIPTION = $newsfeed_description;
                if ($newsfeed_image == "default") {
                    if ($file = fopen ($rss->image['url'], "r")) {
                        /* remote image exists - use it! */
                        $FEEDIMAGE = "<a href='" . $rss->image['link'] . "' rel='external'><img src='" . $rss->image['url'] . "' alt='" . $rss->image['title'] . "' style='border: 0; vertical-align: middle;' /></a>";
                    } else {
                        /* remote image doesn't exist - ghah! */
                        $FEEDIMAGE = "";
                    }
                } else {
                    $FEEDIMAGE = "";
                }
                $FEEDLANGUAGE = $rss->channel['language'];

                if ($rss->channel['lastbuilddate']) {
                    $pubbed = $rss->channel['lastbuilddate'];
                } else if ($rss->channel['dc']['date']) {
                    $pubbed = $rss->channel['dc']['date'];
                } else {
                    $pubbed = NFLAN_34;
                }
                $newsfeed_active = 3; // make it active
                $FEEDLASTBUILDDATE = NFLAN_33 . $pubbed;
                $FEEDCOPYRIGHT = $tp->toHTML($rss->channel['copyright'], true);
                $FEEDTITLE = "<a href='" . $rss->channel['link'] . "' rel='external'>" . $rss->channel['title'] . "</a>";
                $FEEDLINK = $rss->channel['link'];
                if ($newsfeed_active == 2 or $newsfeed_active == 3) {
                    $LINKTOMAIN = "<a  href='" . e_PLUGIN . "newsfeed/newsfeed.php?show.$newsfeed_id'>" . NFLAN_39 . "</a>";
                } else {
                    $LINKTOMAIN = "";
                }

                $data = "";

                $amount = ($items) ? $items : $numtoshow;

                $item_total = array_slice($rss->items, 0, $amount);

                $i = 0;
                while ($i < $numtoshow && $item_total[$i]) {
                    $item = $item_total[$i];
                    $FEEDITEMLINK = "<a href='" . $item['link'] . "' rel='external'>" . $tp->toHTML($item['title'], true) . "</a>\n";
                    $FEEDITEMLINK = str_replace('&', '&amp;', $FEEDITEMLINK);
                    $feeditemtext = preg_replace("#\[[a-z0-9=]+\]|\[\/[a-z]+\]|\{[A-Z_]+\}#si", "", strip_tags($item['description']));
                    $FEEDITEMTEXT = $tp->text_truncate($feeditemtext, $truncate, $truncate_string);

                    $FEEDITEMCREATOR = $tp->toHTML($item['author'], true);
                    if (empty($NEWSFEED_MAIN_CAPTION)) {
                       # $NEWSFEED_MAIN_CAPTION = $newsfeed_name;
                    }
                    $data[] = $NEWSFEED_MAIN_CAPTION . ' <b>' . $rss->image['title'] . ':</b> ' . $FEEDITEMLINK ;
                    $i++;
                }

                $BACKLINK = "<a href='" . e_SELF . "'>" . NFLAN_31 . "</a>";
            }
        }
        $ret['title'] =  $NEWSFEED_MAIN_CAPTION;
        $ret['text'] = $data;
        return $ret;
    }

    function checkUpdate($query = "newsfeed_active=2 OR newsfeed_active=3")
    {
        global $sql, $tp;
        require_once(e_HANDLER . "xml_class.php");
        $xml = new parseXml;
        require_once(e_HANDLER . "magpie_rss.php");

        if ($sql->db_Select("newsfeed", "*", $tp->toDB($query, true))) {
            $feedArray = $sql->db_getList();
            foreach($feedArray as $feed) {
                extract ($feed);
                if ($newsfeed_timestamp + $newsfeed_updateint < time()) {
                    if ($rawData = $xml->getRemoteXmlFile($newsfeed_url)) {
                        $rss = new MagpieRSS($rawData);
                        $serializedArray = addslashes(serialize($rss));

                        $newsfeed_des = false;
                        if ($newsfeed_description == "default") {
                            if ($rss->channel['description']) {
                                $newsfeed_des = $tp->toDB($rss->channel['description']);
                            } else if ($rss->channel['tagline']) {
                                $newsfeed_des = $tp->toDB($rss->channel['tagline']);
                            }
                        }

                        if (!$sql->db_Update('newsfeed', "newsfeed_data='{$serializedArray}', newsfeed_timestamp=" . time() . ($newsfeed_des ? ", newsfeed_description='{$newsfeed_des}'": "") . " WHERE newsfeed_id=" . intval($newsfeed_id))) {
                            echo NFLAN_48 . "<br /><br />" . $serializedArray;
                        }
                    } else {
                        echo $xml->error;
                    }
                }
            }
        }
    }
}