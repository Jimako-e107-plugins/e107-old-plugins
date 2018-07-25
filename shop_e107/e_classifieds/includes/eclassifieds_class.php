<?php
/*
+---------------------------------------------------------------+
|        e_Classifieds Classified advert manager for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2010
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

include_lan(e_PLUGIN . 'e_classifieds/languages/' . e_LANGUAGE . '.php');

class classifieds
{
    var $eclassf_admin = false; // is user an admin
    var $eclassf_creator = false; // permitted to create recipes
    var $eclassf_reader = false; // allowed to read recipes
    var $eclassf_auto = false; // allowed to auto approve
    function classifieds()
    {
        global $ECLASSF_PREF;
        $this->load_prefs();
        $this->eclassf_admin = check_class($ECLASSF_PREF['eclassf_admin']);
        $this->eclassf_creator = $this->eclassf_admin || check_class($ECLASSF_PREF['eclassf_create']);
        $this->eclassf_reader = check_class($ECLASSF_PREF['eclassf_read']);
        $this->eclassf_auto = check_class($ECLASSF_PREF['eclassf_auto']);
    }
    // ********************************************************************************************
    // *
    // * classifieds load and Save prefs
    // *
    // ********************************************************************************************
    function getdefaultprefs()
    {
        global $ECLASSF_PREF, $e107, $pref, $sql;
        if (isset($pref['eclassf_admin']))
        {
            // if old prefs there, copy to new prefs and delete the old ones
            $ECLASSF_PREF['eclassf_email'] = $pref['eclassf_email'];
            $ECLASSF_PREF['eclassf_approval'] = $pref['eclassf_approval'];
            $ECLASSF_PREF['eclassf_valid'] = $pref['eclassf_valid'];
            $ECLASSF_PREF['eclassf_read'] = $pref['eclassf_read'];
            $ECLASSF_PREF['eclassf_create'] = $pref['eclassf_create'];
            $ECLASSF_PREF['eclassf_admin'] = $pref['eclassf_admin'];
            $ECLASSF_PREF['eclassf_useremail'] = $pref['eclassf_useremail'];
            $ECLASSF_PREF['eclassf_terms'] = $pref['eclassf_terms'];
            $ECLASSF_PREF['eclassf_perpage'] = $pref['eclassf_perpage'];
            $ECLASSF_PREF['eclassf_pich'] = $pref['eclassf_pich'];
            $ECLASSF_PREF['eclassf_picw'] = $pref['eclassf_picw'];
            $ECLASSF_PREF['eclassf_currency'] = $pref['eclassf_currency'];
            $ECLASSF_PREF['eclassf_metad'] = $pref['eclassf_metad'];
            $ECLASSF_PREF['eclassf_metak'] = $pref['eclassf_metak'];
            $ECLASSF_PREF['eclassf_leadz'] = $pref['eclassf_leadz'];
            $ECLASSF_PREF['eclassf_thumbs'] = $pref['eclassf_thumbs'];
            $ECLASSF_PREF['eclassf_icons'] = $pref['eclassf_icons'];
            $ECLASSF_PREF['eclassf_counter'] = $pref['eclassf_counter'];
            $ECLASSF_PREF['eclassf_thumbheight'] = $pref['eclassf_thumbheight'];
            $ECLASSF_PREF['eclassf_subdrop'] = $pref['eclassf_subdrop'];
            $ECLASSF_PREF['eclassf_dformat'] = $pref['eclassf_dformat'];
            $ECLASSF_PREF['eclassf_userating'] = $pref['eclassf_userating'];
            $ECLASSF_PREF['eclassf_force_main_cat'] = $pref['eclassf_force_main_cat'];
            $ECLASSF_PREF['eclassf_force_sub_cat'] = $pref['eclassf_force_sub_cat'];
            $ECLASSF_PREF['eclassf_pictype'] = $pref['eclassf_pictype'];

            unset($pref['eclassf_email']);
            unset($pref['eclassf_approval']);
            unset($pref['eclassf_valid']);
            unset($pref['eclassf_read']);
            unset($pref['eclassf_create']);
            unset($pref['eclassf_admin']);
            unset($pref['eclassf_useremail']);
            unset($pref['eclassf_terms']);
            unset($pref['eclassf_perpage']);
            unset($pref['eclassf_pich']);
            unset($pref['eclassf_picw']);
            unset($pref['eclassf_currency']);
            unset($pref['eclassf_metad']);
            unset($pref['eclassf_metak']);
            unset($pref['eclassf_leadz']);
            unset($pref['eclassf_thumbs']);
            unset($pref['eclassf_icons']);
            unset($pref['eclassf_counter']);
            unset($pref['eclassf_thumbheight']);
            unset($pref['eclassf_subdrop']);
            unset($pref['eclassf_dformat']);
            unset($pref['eclassf_userating']);
            unset($pref['eclassf_force_main_cat']);
            unset($pref['eclassf_force_sub_cat']);
            unset($pref['eclassf_pictype']);
            save_prefs();
        }
        else
        {
            // create new default prefs
            $ECLASSF_PREF = $eplug_prefs = array('eclassf_email' => 'youremail@yourdomain.com',
                'eclassf_approval' => 'yes',
                'eclassf_valid' => 0,
                'eclassf_read' => 0,
                'eclassf_create' => 0,
                'eclassf_admin' => '253',
                'eclassf_useremail' => 1,
                'eclassf_terms' => 'Only suitable material will be allowed. Adverts will be checked. This site is not responsible for the goods or services',
                'eclassf_perpage' => '10',
                'eclassf_create' => '0',
                'eclassf_picw' => '100',
                'eclassf_pich' => '100',
                'eclassf_currency' => '£',
                'eclassf_metad' => 'Father Barry"s e_classifieds plugin for the e107 CMS system',
                'eclassf_metak' => 'father barry,barry keal,e107 plugin,e107 plugins,bazzer',
                'eclassf_icons' => '1',
                'eclassf_thumbs' => '1',
                'eclassf_thumbheight' => '50',
                'eclassf_counter' => 'text',
                'eclassf_userating' => 1,
                'eclassf_dformat' => 'd-m-Y',
                'eclassf_subdrop' => 1,
                "eclassf_force_main_cat" => 0,
                "eclassf_force_sub_cat" => 0,
                "eclassf_pictype" => 0
                );
        }
    }
    function save_prefs()
    {
        global $sql, $eArrayStorage, $ECLASSF_PREF;
        // save preferences to database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $tmp = $eArrayStorage->WriteArray($ECLASSF_PREF);
        $sql->db_Update('core', 'e107_value="' . $tmp . '" where e107_name="classifieds"', false);
        return ;
    }
    function load_prefs()
    {
        global $sql, $eArrayStorage, $ECLASSF_PREF;
        // get preferences from database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $num_rows = $sql->db_Select('core', '*', 'e107_name="classifieds"');
        $row = $sql->db_Fetch();

        if (empty($row['e107_value']))
        {
            // insert default preferences if none exist
            $this->getDefaultPrefs();
            $tmp = $eArrayStorage->WriteArray($ECLASSF_PREF);
            $sql->db_Insert('core', '"classifieds", "' . $tmp . '" ');
            $sql->db_Select('core', '*', 'e107_name="classifieds" ');
        }
        else
        {
            $ECLASSF_PREF = $eArrayStorage->ReadArray($row['e107_value']);
        }
        return;
    }
    function clear_cache()
    {
        global $e107cache;
        $e107cache->clear('nq_recipetop_menu');
        $e107cache->clear('nq_recipe_menu');
    }
	function gen_pic($picture = '', $title = '', $height = 0, $width = 0, $lightbox = false)
	{
		global $RECIPE_PREF;
		// if (empty($this->recipe_watermark)) {
		// // force false if there is no watermark text
		// $watermark = false;
		// }
		$title = htmlspecialchars($title);

		$recipe_picloc = e_PLUGIN . "recipe_menu/images/pictures/" . $picture;
		$height_style = '';
		$width_style = '';

		if ($height > 0) {
			$height_style = "height:{$height}px;";
		}

		if ($width > 0) {
			$width_style = "width:{$width}px;";
		}
		if (!empty($picture) && is_readable($recipe_picloc)) {
			$rel = 'lightbox.rcp_gallery';

			if ($lightbox) {
				// with lightbox
				return "<a href='" . htmlspecialchars(e_PLUGIN . "recipe_menu/image.php?rcp_picture={$picture}") . "' rel='" . $rel . "' title='" . $title . "' ><img src='" . htmlspecialchars(e_PLUGIN . "recipe_menu/image.php?rcp_picture={$picture}&rcp_height=$height&rcp_width=$width") . "' style='border:0; " . $height_style . " " . $width_style . ";' title='" . $title . "' alt='" . $title . "' /></a>";
			} else {
				// without lightbox
				return "<img src='" . htmlspecialchars(e_PLUGIN . "recipe_menu/image.php?&rcp_picture={$picture}&rcp_height=$height&rcp_width=$width") . "' style='border:0; " . $height_style . " " . $width_style . ";' title='" . $title . "' alt='" . $title . "' />";
			}
		} else {
			// picture not found
			return false;
		}
	}
	function regen_htaccess($onoff)
	{
		global $PLUGINS_DIRECTORY;
		$hta = '.htaccess';
		$pattern = array("\n", "\r");
		$replace = array("", "");
		// if (is_writable($hta) || !file_exists($hta)) {
		// open the file for reading and get the contents
		$file = file($hta);
		$skip_line = false;
		unset($new_line);
		foreach($file as $line) {
			if (strpos($line, '*** E_CLASSIFIEDS REWRITE BEGIN ***') > 0) {
				// we start skipping
				$skip_line = true;
			}

			if (!$skip_line) {
				// print strlen($line) . '<br>';
				$new_line[] = str_replace($pattern, $replace, $line);
			}
			if (strpos($line, '*** E_CLASSIFIEDS REWRITE END ***') > 0) {
				$skip_line = false;
			}
		}
		if ($onoff == 'on') {
			// $base_loc = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
			$base_loc = e_HTTP . $PLUGINS_DIRECTORY . 'e_classifieds/';
			$new_line[] = "#*** E_CLASSIFIEDS REWRITE BEGIN ***";
			$new_line[] = 'RewriteEngine On';
			$new_line[] = "RewriteBase $base_loc";
			$new_line[] = 'RewriteRule classified-([0-9]*)-([a-zA-Z0-9-]*)-([0-9]*)-([0-9]*)-([0-9]*)\.html(.*)$ classifieds.php?$1.$2.$3.$4.$5 [L]';
			$new_line[] = 'RewriteRule classified.html classifieds.php [L]';
			$new_line[] = '#*** E_CLASSIFIEDS REWRITE END ***';
			$outwrite = implode("\n", $new_line);
		} else {
			$outwrite = implode("\n", $new_line);
		}
		$retval = 0;
		if ($fp = fopen('tmp.txt', 'wt')) {
			// we can open the file for reading
			if (fwrite($fp, $outwrite) !== false) {
				fclose($fp);
				// we have written the new data to temp file OK
				if (file_exists('old.htaccess')) {
					// there is an old htaccess file so delete it
					if (!unlink('old.htaccess')) {
						$retval = 2;
					}
				}
				if ($retval == 0) {
					// old one deleted OK so rename the existing to the old one
					if (is_readable('.htaccess') && file_exists('tmp.txt')) {
						// if there is an old .htaccess then rename it
						if (!rename('.htaccess', 'old.htaccess')) {
							$retval = 3;
						}
					}
				}
				if ($retval == 0) {
					// successfully renamed existing htaccess to old.htaccess
					// so rename the temp file to .htaccess
					if (!rename('tmp.txt', '.htaccess')) {
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
	function make_url($recipe_from = 0, $recipe_action = '', $recipe_id = 0, $receipe_cat = 0, $recipe_order = 0)
	{
		global $RECIPE_PREF;
		if ($RECIPE_PREF['recipe_menu_useseo'] == 1) {
			return "recipe-{$recipe_from}-{$recipe_action}-{$recipe_id}-{$receipe_cat}-{$recipe_order}.html";
		} else {
			return "recipe.php?{$recipe_from}.{$recipe_action}.{$recipe_id}.{$receipe_cat}.{$recipe_order}";
		}
	}
    function makePic($i_file, $t_ht = 100)
    {
        $o_file = e_PLUGIN . 'e_classifieds/images/classifieds/' . $i_file;
        $resfile = e_PLUGIN . 'e_classifieds/images/classifieds/pic_' . $i_file;
        $image_info = getImageSize($o_file) ; // see EXIF for faster way
        $eclassf_type = '';
        switch ($image_info['mime'])
        {
            case 'image/gif':
                if (imagetypes() &IMG_GIF) // not the same as IMAGETYPE
                    {
                        $o_im = imageCreateFromGIF($o_file) ;
                    $eclassf_type = 'gif';
                }
                else
                {
                    $ermsg = 'GIF images are not supported<br />';
                }
                break;
            case 'image/jpeg':
                if (imagetypes() &IMG_JPG)
                {
                    $o_im = imageCreateFromJPEG($o_file) ;
                    $eclassf_type = 'jpg';
                }
                else
                {
                    $ermsg = 'JPEG images are not supported<br />';
                }
                break;
            case 'image/png':
                if (imagetypes() &IMG_PNG)
                {
                    $o_im = imageCreateFromPNG($o_file) ;
                    $eclassf_type = 'png';
                }
                else
                {
                    $ermsg = 'PNG images are not supported<br />';
                }
                break;
            case 'image/wbmp':
                if (imagetypes() &IMG_WBMP)
                {
                    $o_im = imageCreateFromWBMP($o_file) ;
                    $eclassf_type = 'wbmp';
                }
                else
                {
                    $ermsg = 'WBMP images are not supported<br />';
                }
                break;
            default:
                $ermsg = $image_info['mime'] . ' images are not supported<br />';
                break;
        }

        if (!isset($ermsg))
        {
            $o_wd = imagesx($o_im) ;
            $o_ht = imagesy($o_im) ;
            // thumbnail width = target * original width / original height
            $t_wd = round($o_wd * $t_ht / $o_ht) ;

            $t_im = imageCreateTrueColor($t_wd, $t_ht);

            imageCopyResampled($t_im, $o_im, 0, 0, 0, 0, $t_wd, $t_ht, $o_wd, $o_ht);
            switch ($eclassf_type)
            {
                case 'gif':
                    imagegif($t_im, $resfile);
                    break;
                case 'jpg':
                    imageJPEG($t_im, $resfile);
                    break;
                case 'png':
                    imagepng($t_im, $resfile);
                    break;
                case 'wbmp':
                    imagewbmp($t_im, $resfile);
                    break;
            }

            chmod("./images/classifieds/" . $resfile, 0644);
            imageDestroy($o_im);
            imageDestroy($t_im);
        }
        return isset($ermsg)?false:'pic_' . $i_file;
    }
}

?>