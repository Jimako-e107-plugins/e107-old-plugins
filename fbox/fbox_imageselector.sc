// $Id: fbox_imageselector.sc 667 2007-11-15 12:49:31Z secretr $
//based on e107 imageselector.sc, v.1.4

global $sql,$parm, $tp;

	if(strstr($parm,"=")){  // query style parms.
    	 parse_str($parm, $tmp);
    	
		 extract($tmp);
	}else{        // comma separated parms.
    	list($name,$path,$default,$width,$height,$multiple,$label,$subdirs,$htpath,$swidth) = explode(",",$parm);
    }

    $width = ($width) ? $width : "*";
    $height = ($height) ? $height : "*";
    $swidth = ($swidth) ? $swidth : "180px";
    $label = ($label) ? $label : " -- ";
    $multi = ($multiple == "TRUE" || $multiple == "1") ? "multiple='multiple' style='height:{$height}; width: {$swidth}'" : "style='float:left; width: 180px'";

	$text = "<select {$multi} class='tbox' name='$name' id='$name' onchange=\"if(document.getElementById('{$name}').value) {document.getElementById('{$name}'+'_prev').src=document.getElementById('{$name}'+'_lnk').href=document.getElementById('{$name}').value; } else {document.getElementById('{$name}'+'_prev').src='".($default ? $default : e_IMAGE."generic/blank.gif")."';document.getElementById('{$name}'+'_lnk').href='javascript: return false;';}\">\n";
	$text .= "<option value=''>&nbsp;</option>\n";
	require_once(e_HANDLER."file_class.php");
	$fl = new e_file;

	//secretr - ajax http paths + multi folder preview
	if(is_array($path)) {
        foreach ($path as $key=>$fpath) {
            $recurse = ($subdirs[$key]) ? $subdirs[$key] : 0;
            $label[$key] = htmlspecialchars($label[$key], ENT_QUOTES, CHARSET);
        	$text .= "<optgroup label='".$label[$key]."' title='".$label[$key]."'>";
        	if(!$htpath[$key]) $htpath[$key] = str_replace(array(e_IMAGE, e_FILE, e_PLUGIN, e_ADMIN), array(e_IMAGE_ABS, e_FILE_ABS, e_PLUGIN_ABS, e_ADMIN_ABS), $fpath);
        
        	if($imagelist = $fl->get_files($fpath,".jpg|.gif|.png|.JPG|.GIF|.PNG", 'standard', $recurse)){
        		sort($imagelist);
        	}
        	foreach($imagelist as $icon)
        	{
        		$dir = str_replace($fpath,'',$icon['path']);
                $dir = $htpath[$key].$dir;
        		$selected = ($default == $dir.$icon['fname']) ? " selected='selected'" : "";
        		$text .= "<option value='".$dir.$icon['fname']."'".$selected." title='{$icon['fname']}'>".$icon['fname']."</option>\n";
        	}
        	$text .= "</optgroup>\n";
    	}
    } else {
	    $recurse = ($subdirs) ? $subdirs : 0;
        $text .= "<option value=''>".$label."</option>\n";

        if(!$htpath) $htpath = str_replace(array(e_IMAGE, e_FILE, e_PLUGIN, e_ADMIN), array(e_IMAGE_ABS, e_FILE_ABS, e_PLUGIN_ABS, e_ADMIN_ABS), $path);
    
    	if($imagelist = $fl->get_files($path,".jpg|.gif|.png|.JPG|.GIF|.PNG", 'standard', $recurse)){
    		sort($imagelist);
        }	    
    	foreach($imagelist as $icon)
    	{
    		$dir = str_replace($path,'',$icon['path']);
    		$dir = $htpath.$dir;
    		$selected = ($default == $dir.$icon['fname']) ? " selected='selected'" : "";
    		$text .= "<option value='".$dir.$icon['fname']."'".$selected.">".$dir.$icon['fname']."</option>\n";
    	}
    }
    $text .= "</select>";
    
	$pvw_default = ($default) ? $default : e_IMAGE_ABS."generic/blank.gif";
  	$text .= "&nbsp;<a href='#' id='{$name}_lnk' rel='external'><img id='{$name}_prev' src='{$pvw_default}' alt='' style='width:{$width};height:{$height}' /></a>\n";
    $text .= "<input type='hidden' id='{$name}_val' value='' />";


 return "\n\n<!-- Start Lightbox Image Selector -->\n\n".$text."\n\n<!-- End Lightbox Image Selector -->\n\n";