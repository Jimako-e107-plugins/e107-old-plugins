<?php
/*
+---------------------------------------------------------------+
|        Reviewer Plugin for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
include_lan(e_PLUGIN . "reviewer/languages/" . e_LANGUAGE . ".php");
// e107_require_once(e_HANDLER . "ren_help.php");
e107_require_once(e_HANDLER . "userclass_class.php");
e107_require_once(e_HANDLER . "cache_handler.php");
e107_require_once(e_HANDLER . "date_handler.php");
e107_require_once(e_HANDLER . "secure_img_handler.php");
class reviewer
{
    var $reviewer_admin = false; // is user an admin
    var $reviewer_creator = false; // permitted to create review
    var $reviewer_read = false; // permitted to read reviews
    var $reviewer_create = false; // permitted to create items
    var $reviewer_auto = false; // permitted to auto approve items
    var $reviewer_upgraded = true; // upgrade done
    var $reviewer_editown = false; // allow edit own?
    var $reviewer_editownitem = false; // allow edit own?
    function reviewer()
    {
        global $REVIEWER_PREF;
        $this->load_prefs();
        $this->reviewer_admin = check_class($REVIEWER_PREF['reviewer_adminclass']);
        $this->reviewer_creator = check_class($REVIEWER_PREF['reviewer_submitclass']);
        $this->reviewer_read = check_class($REVIEWER_PREF['reviewer_readclass']);
        $this->reviewer_create = check_class($REVIEWER_PREF['reviewer_createclass']);
        $this->reviewer_auto = check_class($REVIEWER_PREF['reviewer_autoclass']);
        $this->reviewer_upgraded = $REVIEWER_PREF['reviewer_upgraded'] == 1;
        $this->reviewer_editown = $REVIEWER_PREF['reviewer_editown'] == 1;
        $this->reviewer_editownitem = $REVIEWER_PREF['reviewer_editownitem'] == 1;
    }
    // ********************************************************************************************
    // *
    // * Reviews load and Save prefs
    // *
    // ********************************************************************************************
    function getdefaultprefs()
    {
        global $REVIEWER_PREF;
        // create new default prefs
        $REVIEWER_PREF = $eplug_prefs = array("reviewer_adminclass" => 255,
            "reviewer_readclass" => 255,
            "reviewer_submitclass" => 255,
            "reviewer_use1" => 1,
            "reviewer_use2" => 1,
            "reviewer_use3" => 1,
            "reviewer_use4" => 1,
            "reviewer_use5" => 1,
            "reviewer_use6" => 0,
            "reviewer_use7" => 0,
            "reviewer_use8" => 0,
            "reviewer_use9" => 0,
            "reviewer_use10" => 0,
            "reviewer_catperpage" => 1,
            "reviewer_reviewperpage" => 1,
            "reviewer_comments" => 0,
            "reviewer_disclaimer" => 1,
            "reviewer_rate1" => '{REVIEWER_RATE1}',
            "reviewer_rate2" => '{REVIEWER_RATE2}',
            "reviewer_rate3" => '{REVIEWER_RATE3}',
            "reviewer_rate4" => '{REVIEWER_RATE4}',
            "reviewer_rate5" => '{REVIEWER_RATE5}',
            "reviewer_rate6" => '{REVIEWER_RATE6}',
            "reviewer_rate7" => '{REVIEWER_RATE7}',
            "reviewer_rate8" => '{REVIEWER_RATE8}',
            "reviewer_rate9" => '{REVIEWER_RATE9}',
            "reviewer_rate10" => '{REVIEWER_RATE10}',
            "reviewer_defcat" => 0,
            "reviewer_captcha" => 1,
            'reviewer_upgraded' => 1,
            'reviewer_editown' => 0,
            'reviewer_editownitem' => 0

            );
    }
    function save_prefs()
    {
        global $sql, $eArrayStorage, $REVIEWER_PREF;
        // save preferences to database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $tmp = $eArrayStorage->WriteArray($REVIEWER_PREF);
        $sql->db_Update("core", "e107_value='$tmp' where e107_name='reviewer'", false);
        return ;
    }
    function load_prefs()
    {
        global $sql, $eArrayStorage, $REVIEWER_PREF;
        // get preferences from database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $num_rows = $sql->db_Select("core", "*", "e107_name='reviewer' ");
        $row = $sql->db_Fetch();

        if (empty($row['e107_value']))
        {
            // insert default preferences if none exist
            $this->getDefaultPrefs();
            $tmp = $eArrayStorage->WriteArray($REVIEWER_PREF);
            $sql->db_Insert("core", "'reviewer', '$tmp' ");
            $sql->db_Select("core", "*", "e107_name='reviewer' ");
        }
        else
        {
            $REVIEWER_PREF = $eArrayStorage->ReadArray($row['e107_value']);
        }
        return;
    }
    function clear_cache()
    {
        global $e107cache;
        $e107cache->clear("nq_reviewer_menu");
        $e107cache->clear("nq_reviewer_cat_menu");
        $e107cache->clear("nq_reviewer_cattop_menu");
        $e107cache->clear("nq_reviewer_top_menu");
        $e107cache->clear("nq_reviewer_poster_menu");
        $e107cache->clear("nq_reviewer_items");
        //$e107cache->clear("reviewer_page");
    }
    function recalc_all()
    {
        global $pref, $sql, $REVIEWER_PREF;
        if (substr($pref['plug_installed']['reviewer'], 0, 3) === '1.1' && intval($REVIEWER_PREF['reviewer_upgraded']) == 0)
        {
            print "Upgrading";
            if ($sql->db_Select_gen('update #reviewer_reviewer set
			reviewer_reviewer_rate1 =case when reviewer_reviewer_rate1<6 then reviewer_reviewer_rate1*10 else reviewer_reviewer_rate1 end,
			reviewer_reviewer_rate2 =case when reviewer_reviewer_rate2<6 then reviewer_reviewer_rate2*10 else reviewer_reviewer_rate2 end,
			reviewer_reviewer_rate3 =case when reviewer_reviewer_rate3<6 then reviewer_reviewer_rate3*10 else reviewer_reviewer_rate3 end,
			reviewer_reviewer_rate4 =case when reviewer_reviewer_rate4<6 then reviewer_reviewer_rate4*10 else reviewer_reviewer_rate4 end,
			reviewer_reviewer_rate5 =case when reviewer_reviewer_rate5<6 then reviewer_reviewer_rate5*10 else reviewer_reviewer_rate5 end,
			reviewer_reviewer_rate6 =case when reviewer_reviewer_rate6<6 then reviewer_reviewer_rate6*10 else reviewer_reviewer_rate6 end,
			reviewer_reviewer_rate7 =case when reviewer_reviewer_rate7<6 then reviewer_reviewer_rate7*10 else reviewer_reviewer_rate7 end,
			reviewer_reviewer_rate8 =case when reviewer_reviewer_rate8<6 then reviewer_reviewer_rate8*10 else reviewer_reviewer_rate8 end,
			reviewer_reviewer_rate9 =case when reviewer_reviewer_rate9<6 then reviewer_reviewer_rate9*10 else reviewer_reviewer_rate9 end,
			reviewer_reviewer_rate10 =case when reviewer_reviewer_rate10<6 then reviewer_reviewer_rate10*10 else reviewer_reviewer_rate10 end', false))
            {
                $REVIEWER_PREF['reviewer_upgraded'] = 1;
                $this->save_prefs();
            }
        }
        $sql->db_Select("reviewer_items", "reviewer_items_id", "", "nowhere", false);
        while ($reviewer_row = $sql->db_Fetch())
        {
            $this->update_item($reviewer_row['reviewer_items_id']);
        }
    }

    function update_item($reviewer_toupdate = 0)
    {
        global $sql2, $REVIEWER_PREF;

        $reviewer_arg = "
	select
count(reviewer_reviewer_id) as votes ,
sum(reviewer_reviewer_rate1) as rate1,
sum(reviewer_reviewer_rate2) as rate2,
sum(reviewer_reviewer_rate3) as rate3,
sum(reviewer_reviewer_rate4) as rate4,
sum(reviewer_reviewer_rate5) as rate5,
sum(reviewer_reviewer_rate6) as rate6,
sum(reviewer_reviewer_rate7) as rate7,
sum(reviewer_reviewer_rate8) as rate8,
sum(reviewer_reviewer_rate9) as rate9,
sum(reviewer_reviewer_rate10) as rate10,
reviewer_category_use1,reviewer_category_use2,reviewer_category_use3,reviewer_category_use4,reviewer_category_use5,
reviewer_category_use6,reviewer_category_use7,reviewer_category_use8,reviewer_category_use9,reviewer_category_use10
from #reviewer_reviewer
left join #reviewer_items on reviewer_items_id=reviewer_reviewer_itemid
left join #reviewer_category on reviewer_items_catid=reviewer_category_id
where reviewer_reviewer_itemid ={$reviewer_toupdate}
group by reviewer_reviewer_itemid";
        $sql2->db_Select_gen($reviewer_arg, false);
        extract($sql2->db_Fetch());
        if ($REVIEWER_PREF['reviewer_usecat'] != 1)
        {
            // not using category then get the settings from prefs
            $reviewer_category_use1 = $REVIEWER_PREF['reviewer_use1'];
            $reviewer_category_use2 = $REVIEWER_PREF['reviewer_use2'];
            $reviewer_category_use3 = $REVIEWER_PREF['reviewer_use3'];
            $reviewer_category_use4 = $REVIEWER_PREF['reviewer_use4'];
            $reviewer_category_use5 = $REVIEWER_PREF['reviewer_use5'];
            $reviewer_category_use6 = $REVIEWER_PREF['reviewer_use6'];
            $reviewer_category_use7 = $REVIEWER_PREF['reviewer_use7'];
            $reviewer_category_use8 = $REVIEWER_PREF['reviewer_use8'];
            $reviewer_category_use9 = $REVIEWER_PREF['reviewer_use9'];
            $reviewer_category_use10 = $REVIEWER_PREF['reviewer_use10'];
        }
        $rate1 = $this->make_round($rate1 / $votes);
        $rate2 = $this->make_round($rate2 / $votes);
        $rate3 = $this->make_round($rate3 / $votes);
        $rate4 = $this->make_round($rate4 / $votes);
        $rate5 = $this->make_round($rate5 / $votes);
        $rate6 = $this->make_round($rate6 / $votes);
        $rate7 = $this->make_round($rate7 / $votes);
        $rate8 = $this->make_round($rate8 / $votes);
        $rate9 = $this->make_round($rate9 / $votes);
        $rate10 = $this->make_round($rate10 / $votes);
        $sum = 0;
        $count = 0;
        if ($reviewer_category_use1 == 1)
        {
            $sum = $sum + $rate1;
            $count++;
        }
        if ($reviewer_category_use2 == 1)
        {
            $sum = $sum + $rate2;
            $count++;
        }
        if ($reviewer_category_use3 == 1)
        {
            $sum = $sum + $rate3;
            $count++;
        }
        if ($reviewer_category_use4 == 1)
        {
            $sum = $sum + $rate4;
            $count++;
        }
        if ($reviewer_category_use5 == 1)
        {
            $sum = $sum + $rate5;
            $count++;
        }
        if ($reviewer_category_use6 == 1)
        {
            $sum = $sum + $rate6;
            $count++;
        }
        if ($reviewer_category_use7 == 1)
        {
            $sum = $sum + $rate7;
            $count++;
        }
        if ($reviewer_category_use8 == 1)
        {
            $sum = $sum + $rate8;
            $count++;
        }
        if ($reviewer_category_use9 == 1)
        {
            $sum = $sum + $rate9;
            $count++;
        }
        if ($reviewer_category_use10 == 1)
        {
            $sum = $sum + $rate10;
            $count++;
        }

        if ($count > 0)
        {
            $totrate = $this->make_round($sum / $count);
        }
        else
        {
            $totrate = 0;
            $rate1 = 0;
            $rate2 = 0;
            $rate3 = 0;
            $rate4 = 0;
            $rate5 = 0;
            $rate6 = 0;
            $rate7 = 0;
            $rate8 = 0;
            $rate9 = 0;
            $rate10 = 0;
            $votes = 0;
        }
        $reviewer_arg = "
update #reviewer_items set
reviewer_items_rate=" . intval($totrate) . ",
reviewer_items_rate1=" . intval($rate1) . ",
reviewer_items_rate2=" . intval($rate2) . ",
reviewer_items_rate3=" . intval($rate3) . ",
reviewer_items_rate4=" . intval($rate4) . ",
reviewer_items_rate5=" . intval($rate5) . ",
reviewer_items_rate6=" . intval($rate6) . ",
reviewer_items_rate7=" . intval($rate7) . ",
reviewer_items_rate8=" . intval($rate8) . ",
reviewer_items_rate9=" . intval($rate9) . ",
reviewer_items_rate10=" . intval($rate10) . ",
reviewer_items_votes=" . intval($votes) . "
where reviewer_items_id = {$reviewer_toupdate}
";
        $sql2->db_Select_gen($reviewer_arg, false);
    }
    function make_round($value)
    {
        global $REVIEWR_PREF;
        return $value;
        if ($REVIEWER_PREF['reviewer_half'] == 1)
        {
            $tmp = $value % 10;
            if ($tmp < 5)
            {
                $last = 0;
            }
            else
            {
                $last = 5;
            }
        }
        else
        {
            $last = 0;
        }
        $strvalue = str_pad($value, 2, '0', STR_PAD_LEFT);
        $leftchar = substr($strvalue, 0, 1);
        $retval = $leftchar . $last;
        return (int)$retval;
    }
    function rate_numeric($rate_value){
    	global $REVIEWER_PREF;
        $reviewer_string = str_pad($rate_value, 2, '0', STR_PAD_LEFT);
        // print $reviewer_string . "<br>";;
        $leftchar = substr($reviewer_string, 0, 1);
        $rightchar = substr($reviewer_string, -1);

        if ($REVIEWER_PREF['reviewer_half'] == 1)
        {
            switch ($rightchar)
            {
                case '0':
                case '1':
                case '2':
                case '3':
                case '4':
                    $imgright = '0' ;
                    break;
                case '5':
                case '6':
                case '7':
                case '8':
                case '9':
                    $imgright = '5' ;
                    break;
            } // switch
            $image = $leftchar .'.'. $imgright;
        }
        else
        {
            $image = $leftchar;
        }


return $image;
    }
	function rate_image($rate_value, $small = false)
    {
        global $REVIEWER_PREF;
        $reviewer_string = str_pad($rate_value, 2, '0', STR_PAD_LEFT);
        // print $reviewer_string . "<br>";;
        $leftchar = substr($reviewer_string, 0, 1);
        $rightchar = substr($reviewer_string, -1);

        if ($REVIEWER_PREF['reviewer_half'] == 1)
        {
            switch ($rightchar)
            {
                case '0':
                case '1':
                case '2':
                case '3':
                case '4':
                    $imgright = '0' ;
                    break;
                case '5':
                case '6':
                case '7':
                case '8':
                case '9':
                    $imgright = '5' ;
                    break;
            } // switch
        }
        else
        {
            $imgright = '0';
        }
        $image = $leftchar . $imgright;
        switch ($image)
        {
            case '00':
                $desc = REVIEWER_R00; ;
                break;
            case '05':
                $desc = REVIEWER_R05; ;
                break;

            case '10':
                $desc = REVIEWER_R10; ;
                break;
            case '15':
                $desc = REVIEWER_R15; ;
                break;

            case '20':
                $desc = REVIEWER_R20; ;
                break;
            case '25':
                $desc = REVIEWER_R25; ;
                break;

            case '30':
                $desc = REVIEWER_R30; ;
                break;
            case '35':
                $desc = REVIEWER_R35; ;
                break;

            case '40':
                $desc = REVIEWER_R40; ;
                break;
            case '45':
                $desc = REVIEWER_R45; ;
                break;

            case '50':
                $desc = REVIEWER_R50; ;
                break;
        } // switch
        if ($small)
        {
            $small_suffix = "_s";
        }
        $title = REVIEWER_V025 . ' : ' . $desc . ' (' . $leftchar . '.' . $rightchar . ')';
        $reviewer_items_stars = "<img src='" . e_PLUGIN . "reviewer/images/rate" . $image . $small_suffix . ".png' style='border:0px;' alt=' " . $title . "' title=' " . $title . ' ' . "' />";
        return $reviewer_items_stars;
    }
    function tablerender($caption, $text, $mode = "default", $return = false)
    {
        global $ns, $REVIEWER_PREF;
        // do the mod rewrite steps if installed
        // $modules = apache_get_modules();
        if ($REVIEWER_PREF['reviewer_seo'] == 1)
        {
            $patterns[0] = '/' . $PLUGINS_DIRECTORY . '\/reviewer\/reviewer\.php\?([0-9]+).([a-z]+).([0-9]+).([0-9]+)/';
            $patterns[1] = '/' . $PLUGINS_DIRECTORY . '\/reviewer\/reviewer\.php\?([0-9]+).([a-z]+).([0-9]+)/';
            $patterns[2] = '/' . $PLUGINS_DIRECTORY . '\/reviewer\/reviewer\.php\?([0-9]+).([a-z]+)/';
            $replacements[0] = '/reviewer/reviewer-$1-$2-$3-$4.html';
            $replacements[1] = '/reviewer/reviewer-$1-$2-$3.html';
            $replacements[2] = '/reviewer/reviewer-$1-$2.html';

            $text = preg_replace($patterns, $replacements, $text);
        }
        $ns->tablerender($caption, $text, $mode , $return);
    }
    function regen_htaccess($onoff)
    {
        $hta = '.htaccess';
        $pattern = array("\n", "\r");
        $replace = array("", "");
        if (is_writable($hta) || !file_exists($hta))
        {
            // open the file for reading and get the contents
            $file = file($hta);
            $skip_line = false;
            unset($new_line);
            foreach($file as $line)
            {
                if (strpos($line, '*** REVIEWER REWRITE BEGIN ***') > 0)
                {
                    // we start skipping
                    $skip_line = true;
                }

                if (!$skip_line)
                {
                    // print strlen($line) . '<br>';
                    $new_line[] = str_replace($pattern, $replace, $line);
                }
                if (strpos($line, '*** REVIEWER REWRITE END ***') > 0)
                {
                    $skip_line = false;
                }
            }
            if ($onoff == 'on')
            {
                $base_loc = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
                $new_line[] = "#*** REVIEWER REWRITE BEGIN ***";
                $new_line[] = 'RewriteEngine On';
                $new_line[] = "RewriteBase $base_loc";
                $new_line[] = 'RewriteRule reviewer.html reviewer.php';
                $new_line[] = 'RewriteRule reviewer-([0-9]*)-([a-z]*)\.html(.*)$ reviewer.php?$1.$2.$3';
                $new_line[] = 'RewriteRule reviewer-([0-9]*)-([a-z]*)-([0-9]*)\.html(.*)$ reviewer.php?$1.$2.$3';
                $new_line[] = 'RewriteRule reviewer-([0-9]*)-([a-z]*)-([0-9]*)-([0-9]*)\.html(.*)$ reviewer.php?$1.$2.$3.$4';
                $new_line[] = '#*** REVIEWER REWRITE END ***';
                $outwrite = implode("\n", $new_line);
            }
            else
            {
                $outwrite = implode("\n", $new_line);
            }
            $retval = 0;
            if ($fp = fopen('tmp.txt', 'wt'))
            {
                // we can open the file for reading
                if (fwrite($fp, $outwrite) !== false)
                {
                    fclose($fp);
                    // we have written the new data to temp file OK
                    if (is_readable('old.htaccess'))
                    {
                        // there is an old htaccess file so delete it
                        if (!unlink('old.htaccess'))
                        {
                            $retval = 2;
                        }
                    }
                    if ($retval == 0)
                    {
                        // old one deleted OK so rename the existing to the old one
                        if (is_readable('.htaccess'))
                        {
                            // if there is an old .htaccess then rename it
                            if (!rename('.htaccess', 'old.htaccess'))
                            {
                                $retval = 3;
                            }
                        }
                    }
                    if ($retval == 0)
                    {
                        // successfully renamed existing htaccess to old.htaccess
                        // so rename the temp file to .htaccess
                        if (!rename('tmp.txt', '.htaccess'))
                        {
                            $retval = 4;
                        }
                    }
                }
                else
                {
                    // unable to open temporary file
                    $retval = 5;
                }
            }
            else
            {
                fclose($fp);
                $retval = 1;
            }
            return $retval;
        }
    }
    function gen_keywords($wordy)
    {
        $search = array ('@<script[^>]*?>.*?</script>@si', // Strip out javascript
            '@<[\/\!]*?[^<>]*?>@si', // Strip out HTML tags
            '@{[\/\!]*?[^{}]*?}@si', // Strip out e107 tags
            '@&(quot|#34);@i', // Replace HTML entities
            '@&(amp|#38);@i',
            '@&(lt|#60);@i',
            '@&(gt|#62);@i',
            '@&(nbsp|#160);@i',
            '@&(iexcl|#161);@i',
            '@&(cent|#162);@i',
            '@&(pound|#163);@i',
            '@&(copy|#169);@i',
            '@&#(\d+);@e',
            '|[[\/\!]*?[^\[\]]*?]|si', // strip out bbcode tags
            '@([\t\r\n])[\s]+@', // Strip out white space
            );
        // evaluate as php
        $replace = array (' ',
            ' ',
            ' ',
            ' ',
            ' ',
            ' ',
            ' ',
            ' ',
            ' ',
            ' ',
            ' ',
            ' ',
            ' ',
            ' ',
            ' ');
        $nwordy = preg_replace($search, $replace, strip_tags($wordy));
        $nwordy = str_replace(',,', '', $nwordy);

        $keynames = explode(' ', $nwordy);
        $cleaned = array_filter($keynames, arr_clean);
        $keylist = array_unique($cleaned);
        $keywords = implode(',', $keylist);
        return $keywords;
    }
}
function arr_clean($value)
{

    return strlen($value) > 3;
}
