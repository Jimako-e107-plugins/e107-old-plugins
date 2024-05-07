<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.2.0                                            //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002,2003 Gregory DEMAR <gdemar@wanadoo.fr>                 //
// http://www.chezgreg.net/coppermine/                                       //
// ------------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                        //
// (http://coppermine.sf.net/team/)                                          //
// see /docs/credits.html for details                                        //
// ------------------------------------------------------------------------- //
// This program is free software; you can redistribute it and/or modify      //
// it under the terms of the GNU General Public License as published by      //
// the Free Software Foundation; either version 2 of the License, or         //
// (at your option) any later version.                                       //
// ------------------------------------------------------------------------- //

define('IN_COPPERMINE', true);
define('CONFIG_PHP', true);

require('include/init.inc.php');
require('include/sql_parse.php');


if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);

function form_label($text)
{
    echo <<<EOT
        <tr>
                <td class="tableh2" colspan="2">
                        <b>$text</b>
                </td>
        </tr>

EOT;
}

function form_input($text, $name)
{
    global $CONFIG;

    $value = $CONFIG[$name];

    echo <<<EOT
        <tr>
            <td width="60%" class="tableb">
                        $text
        </td>
        <td width="40%" class="tableb" valign="top">
                <input type="text" class="textinput" style="width: 100%" name="$name" value="$value">
                </td>
        </tr>

EOT;
}

function form_yes_no($text, $name)
{
    global $CONFIG, $lang_yes, $lang_no;

    $value = $CONFIG[$name];
    $yes_selected = $value ? 'selected' : '';
    $no_selected = !$value ? 'selected' : '';

    echo <<<EOT
        <tr>
            <td class="tableb">
                        $text
        </td>
        <td class="tableb" valign="top">
                        <select name="$name" class="listbox">
                                <option value="1" $yes_selected>$lang_yes</option>
                                <option value="0" $no_selected>$lang_no</option>
                        </select>
                </td>
        </tr>

EOT;
}

function form_img_pkg($text, $name)
{
    global $CONFIG;

    $value = $CONFIG[$name];
    $im_selected = ($value == 'im') ? 'selected' : '';
    $gd1_selected = ($value == 'gd1') ? 'selected' : '';
    $gd2_selected = ($value == 'gd2') ? 'selected' : '';

    echo <<<EOT
        <tr>
            <td class="tableb">
                        $text
        </td>
        <td class="tableb" valign="top">
                        <select name="$name" class="listbox">
                                <option value="im" $im_selected>Image Magick</option>
                                <option value="gd1" $gd1_selected>GD version 1.x</option>
                                <option value="gd2" $gd2_selected>GD version 2.x</option>
                        </select>
                </td>
        </tr>

EOT;
}

function form_sort_order($text, $name)
{
    global $CONFIG, $lang_config_php;

    $value = $CONFIG[$name];
    $ta_selected = ($value == 'ta') ? 'selected' : '';
    $td_selected = ($value == 'td') ? 'selected' : '';
    $na_selected = ($value == 'na') ? 'selected' : '';
    $nd_selected = ($value == 'nd') ? 'selected' : '';
    $da_selected = ($value == 'da') ? 'selected' : '';
    $dd_selected = ($value == 'dd') ? 'selected' : '';

    echo <<<EOT
        <tr>
            <td class="tableb">
                        $text
        </td>
        <td class="tableb" valign="top">
                        <select name="$name" class="listbox">
                                <option value="ta" $ta_selected>{$lang_config_php['title_a']}</option>
                                <option value="td" $td_selected>{$lang_config_php['title_d']}</option>
                                <option value="na" $na_selected>{$lang_config_php['name_a']}</option>
                                <option value="nd" $nd_selected>{$lang_config_php['name_d']}</option>
                                <option value="da" $da_selected>{$lang_config_php['date_a']}</option>
                                <option value="dd" $dd_selected>{$lang_config_php['date_d']}</option>
                        </select>
                </td>
        </tr>

EOT;
}

function form_charset($text, $name)
{
    global $CONFIG;

    $charsets = array('Default' => 'language file',
        'Arabic' => 'iso-8859-6',
        'Baltic' => 'iso-8859-4',
        'Central European' => 'iso-8859-2',
        'Chinese Simplified' => 'euc-cn',
        'Chinese Traditional' => 'big5',
        'Cyrillic' => 'koi8-r',
        'Greek' => 'iso-8859-7',
        'Hebrew' => 'iso-8859-8-i',
        'Icelandic' => 'x-mac-icelandic',
        'Japanese' => 'euc-jp',
        'Korean' => 'euc-kr',
        'Maltese' => 'iso-8859-3',
        'Thai' => 'windows-874 ',
        'Turkish' => 'iso-8859-9',
        'Unicode' => 'utf-8',
        'Vietnamese' => 'windows-1258',
        'Western' => 'iso-8859-1'
        );

    $value = strtolower($CONFIG[$name]);

    echo <<<EOT
        <tr>
            <td class="tableb">
                        $text
        </td>
        <td class="tableb" valign="top">
                        <select name="$name" class="listbox">

EOT;
    foreach ($charsets as $country => $charset) {
        echo "                                <option value=\"$charset\" " . ($value == $charset ? 'selected' : '') . ">$country ($charset)</option>\n";
    }
    echo <<<EOT
                        </select>
                </td>
        </tr>

EOT;
}

function form_language($text, $name)
{
    global $CONFIG;

    $value = strtolower($CONFIG[$name]);
    $lang_dir = 'lang/';

    $dir = opendir($lang_dir);
    while ($file = readdir($dir)) {
        if (is_file($lang_dir . $file) && strtolower(substr($file, -4)) == '.php') {
            $lang_array[] = strtolower(substr($file, 0 , -4));
        }
    }
    closedir($dir);

    natcasesort($lang_array);

    echo <<<EOT
        <tr>
            <td class="tableb">
                        $text
        </td>
        <td class="tableb" valign="top">
                        <select name="$name" class="listbox">

EOT;
    foreach ($lang_array as $language) {
        echo "                                <option value=\"$language\" " . ($value == $language ? 'selected' : '') . ">" . ucfirst($language) . "</option>\n";
    }
    echo <<<EOT
                        </select>
                </td>
        </tr>

EOT;
}

function form_theme($text, $name)
{
    global $CONFIG;

    $value = $CONFIG[$name];
    $theme_dir = 'themes/';

    $dir = opendir($theme_dir);
    while ($file = readdir($dir)) {
        if (is_dir($theme_dir . $file) && $file != "." && $file != "..") {
            $theme_array[] = $file;
        }
    }
    closedir($dir);

    natcasesort($theme_array);

    echo <<<EOT
        <tr>
            <td class="tableb">
                        $text
        </td>
        <td class="tableb" valign="top">
                        <select name="$name" class="listbox">

EOT;
    foreach ($theme_array as $theme) {
        echo "                                <option value=\"$theme\" " . ($value == $theme ? 'selected' : '') . ">" . strtr(ucfirst($theme), '_', ' ') . "</option>\n";
    }
    echo <<<EOT
                        </select>
                </td>
        </tr>

EOT;
}
// Added for allowing user to select which aspect of thumbnails to scale
function form_scale($text, $name)
{
    global $CONFIG, $lang_config_php;

    $value = $CONFIG[$name];
    $any_selected = ($value == 'max') ? 'selected' : '';
    $ht_selected = ($value == 'ht') ? 'selected' : '';
    $wd_selected = ($value == 'wd') ? 'selected' : '';

    echo <<<EOT
        <tr>
            <td class="tableb">
                        $text
        </td>
        <td class="tableb" valign="top">
                        <select name="$name" class="listbox">
                                <option value="any" $any_selected>{$lang_config_php['th_any']}</option>
                                <option value="ht" $ht_selected>{$lang_config_php['th_ht']}</option>
                                <option value="wd" $wd_selected>{$lang_config_php['th_wd']}</option>
                        </select>
                </td>
        </tr>

EOT;
}

function create_form(&$data)
{
    foreach($data as $element) {
        if ((is_array($element))) {
            switch ($element[2]) {
                case 0 :
                    form_input($element[0], $element[1]);
                    break;
                case 1 :
                    form_yes_no($element[0], $element[1]);
                    break;
                case 2 :
                    form_img_pkg($element[0], $element[1]);
                    break;
                case 3 :
                    form_sort_order($element[0], $element[1]);
                    break;
                case 4 :
                    form_charset($element[0], $element[1]);
                    break;
                case 5 :
                    form_language($element[0], $element[1]);
                    break;
                case 6 :
                    form_theme($element[0], $element[1]);
                    break;
                // Thumbnail scaling
                case 7 :
                    form_scale($element[0], $element[1]);
                    break;
                // Add triple dropdwon later - put back in for compatibility reasons
                case 8 :
                    // do nothing
                    break;
                default:
                    die('Invalid action');
            } // switch
        } else {
            form_label($element);
        }
    }
}

if (count($HTTP_POST_VARS) > 0) {
    if (isset($HTTP_POST_VARS['update_config'])) {
        $need_to_be_positive = array('albums_per_page',
            'album_list_cols',
            'max_tabs',
            'picture_width',
            'subcat_level',
            'thumb_width',
            'thumbcols',
            'thumbrows',
            // Show filmstrip
            'max_film_strip_items');

        foreach ($need_to_be_positive as $parameter)
        $HTTP_POST_VARS[$parameter] = max(1, (int)$HTTP_POST_VARS[$parameter]);

        foreach($lang_config_data as $element) {
            if ((is_array($element))) {
                if ((!isset($HTTP_POST_VARS[$element[1]]))) cpg_die(CRITICAL_ERROR, "Missing config value for '{$element[1]}'", __FILE__, __LINE__);
                $value = addslashes($HTTP_POST_VARS[$element[1]]);
                db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET  value = '$value' WHERE name = '{$element[1]}'");
            }
        }
        pageheader($lang_config_php['title']);
        msg_box($lang_config_php['info'], $lang_config_php['upd_success'], $lang_continue, 'index.php');
        pagefooter();
        exit;
    } elseif (isset($HTTP_POST_VARS['restore_config'])) {
        $default_config = 'sql/restore_config.sql';
        $sql_query = fread(fopen($default_config, 'r'), filesize($default_config));
        $sql_query = preg_replace('/CPG_/', $CONFIG['TABLE_PREFIX'], $sql_query);
        $sql_query = preg_replace('/INSERT /', 'REPLACE ', $sql_query);

        $sql_query = remove_remarks($sql_query);
        $sql_query = split_sql_file($sql_query, ';');

        $sql_count = count($sql_query);
        for($i = 0; $i < $sql_count; $i++) db_query($sql_query[$i]);
    }
    pageheader($lang_config_php['title']);
    msg_box($lang_config_php['info'], $lang_config_php['restore_success'], $lang_continue, $PHP_SELF);
    pagefooter();
}

pageheader($lang_config_php['title']);

$signature = 'Coppermine Photo Gallery ' . COPPERMINE_VERSION;

starttable('100%', "{$lang_config_php['title']} - $signature", 2);
echo <<<EOT
        <form action="$PHP_SELF" method="post">

EOT;
create_form($lang_config_data);
echo <<<EOT
        <tr>
            <td colspan="2" align="center" class="tablef">
                        <input type="submit" class="button" name="update_config" value="{$lang_config_php['save_cfg']}">
                        &nbsp;&nbsp;
                        <input type="submit" class="button" name="restore_config" value="{$lang_config_php['restore_cfg']}">
                </td>
        </form>
        </tr>

EOT;
endtable();
pagefooter();
ob_end_flush();

?>
