<?php
/*
* Copyright (c) e107 Inc e107.org, Licensed under GNU GPL (http://www.gnu.org/licenses/gpl.txt)
* Those shortcodes have to be global for using in core download template 
*/

if(!defined('e107_INIT'))
{
exit;
}


if (!class_exists('jmdownload_shortcodes', false)) 
{
    class jmdownload_shortcodes extends e_shortcode
    {
        public $override = false; // when set to true, existing core/plugin shortcodes matching methods below will be overridden.
        public $settings  = false;

        public function __construct()
        {
        }

        // {JMCORE_DL_CAT: download_category_id}
        // {JMCORE_DL_CAT: download_category_name}
        // {JMCORE_DL_CAT: download_category_icon_path}
        // {JMCORE_DL_CAT: download_category_url}
        public function sc_jmcore_dl_cat($parm = null)
        {
            if (empty($parm)) {
                return '';
            }

            $key = array_keys($parm);
            if ($key) {
                $key = strtolower($key[0]);
            }

            $sc = e107::getScBatch('download', true);

            if ($sc->qry['action'] == "maincats") {
                $data = $sc->dlsubrow;
            }
            if ($sc->qry['action'] == "list") {
                $data = $sc->var;
            }

            switch ($key) 
            {
                case 'download_category_name':
                    $text = $data['download_category_name'];
                break;
                case 'download_category_id':
                    $text = $data['download_category_id'];
                break;
                case 'download_category_description':
                    $text =  e107::getParser()->toHTML($data['download_category_description'], true, 'DESCRIPTION');

                    if ($parm['class']) {
                        $text =  str_replace(array("<p>"), "<p class='".$parm['class']."'>", $text);
                    }
                break;
                case 'download_category_icon_path':
                    $imagepath = $data['download_category_icon'];
                    $text = e107::getParser()->thumbUrl($imagepath, array('w'=>0, 'h'=>0));
                break;
                case 'download_category_url':
                    $text = e107::url('download', 'category', $data);
                    break;
                }
            return $text;
        }

        // Custom download shortcode, in list mode 
        // {JMCORE_DL_SUBCAT: download_category_id}
        // {JMCORE_DL_SUBCAT: download_category_name}
        // {JMCORE_DL_SUBCAT: download_category_icon_path}
        // {JMCORE_DL_SUBCAT: download_category_url}
        public function sc_jmcore_dl_subcat($parm = null)
        {
            if (empty($parm)) {
                return '';
            }
            $key = array_keys($parm);
            if ($key) {
                $key = strtolower($key[0]);
            }
            $sc = e107::getScBatch('download', true);
             
            if ($parm['type'] == "parent") {
                $data = $sc->parent;
            } else {
                $data = $sc->dlsubsubrow;
            } 
            switch ($key) {
                case 'download_category_name':
                $text = $data['download_category_name'];
            break;
            case 'download_category_id':
                $text = $data['download_category_id'];
            break;
            case 'download_category_description':
                $text =  e107::getParser()->toHTML($data['download_category_description'], true, 'DESCRIPTION');
                $texts = explode("<p><!-- pagebreak --></p>", $text);
                /* there is summary */
                $text =  $texts[0];
                if ($parm['class']) {
                    $text =  str_replace(array("<p>"), "<p class='".$parm['class']."'>", $text);
                }
            break;
            case 'download_category_icon_path':
                $imagepath = $data['download_category_icon'];
                $text = e107::getParser()->thumbUrl($imagepath, array('w'=>0, 'h'=>0));
                break;
            case 'download_category_url':
                $text = e107::url('download', 'category', $data);
            break;
        }


            return $text;
        }

        // Custom download shortcode
        // {JMCORE_DOWNLOAD: download_id}
        // {JMCORE_DOWNLOAD: download_name}
        // {JMCORE_DOWNLOAD: download_image}
        // {JMCORE_DOWNLOAD: download_url}
        // {JMCORE_DOWNLOAD: admin_edit}
        public function sc_jmcore_download($parm = null)
        {
            if (empty($parm)) {
                return '';
            }

            $key = array_keys($parm);
            if ($key) {
                $key = strtolower($key[0]);
            }

            $sc = e107::getScBatch('download', true);
            $data = $sc->var;

            switch ($key) {
            case 'download_category_name':
                $text = $datapar['download_category_name'];
            break;

            case 'download_name':
                $text = $data['download_name'];
            break;
            case 'download_id':
                $text = $data['download_id'];
            break;
            case 'download_description':

                $text =  e107::getParser()->toHTML($data['download_description'], true, 'BODY');

                $texts = explode("<p><!-- pagebreak --></p>", $text);
                if ($texts[1]) {
                    $text =  $texts[0];
                } else {
                    return "";
                }
                if ($parm['class']) {
                    $text =  str_replace(array("<p>"), "<p class='".$parm['class']."'>", $text);
                }
            break;
            case 'download_image':
                $imagepath = $data['download_image'];
                if ($imagepath) {
                    $text = e107::getParser()->thumbUrl($imagepath, array('w'=>0, 'h'=>0));
                } else {
                    $logopref = e107::getConfig('core')->get('sitelogo');
                    $logop = e107::getParser()->replaceConstants($logopref, "full");
                    $text = $logop;
                }
            break;
            case 'download_url':
                $text = e107::url('download', 'item', $data);
            break;
            // 6 - Access to Media Manager
            case 'admin_edit':  
                $icon = "<img src='".e_IMAGE_ABS."generic/edit.png' alt='*' style='padding:0px;border:0px' />";
         
                $url = e_PLUGIN_ABS."jmdownload/admin/admin_download.php?action=edit&id=".$data['download_id'];
             
                return (ADMIN && getperms('6')) ? "<a  target='_blank' class='e-tip btn btn-default btn-secondary hidden-print' href='".$url."' title='".LAN_EDIT."'>".$icon."</a>" : "";
            break;
            }
            return $text;
        }
    }
}