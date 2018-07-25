<?php

function evrsn_fileup($field_name, $destination_dir, $destination_prefix)
{
    $return = array("result" => 0, "filename" => "");
    // Get allowed upload filetypes
    if (is_readable(e_ADMIN . 'filetypes.php'))
    {
        $a_filetypes = trim(file_get_contents(e_ADMIN . 'filetypes.php'));
        $a_filetypes = explode(',', $a_filetypes);
        foreach ($a_filetypes as $ftype)
        {
            $allowed_filetypes[] = '.' . trim(str_replace('.', '', $ftype));
        }
    }
    else
    {
        print e_ADMIN . " filetypes.php not readable - check the _ is removed";
    }
    // get file name
    $name = $_FILES[$field_name]["name"];
    // check extn
    $lastpos = strtolower(strrchr($name, "."));
    $allowed = in_array($lastpos, $allowed_filetypes);
    if ($allowed == 1)
    {
        $new_name = $destination_prefix . $name;
        $new_file = $destination_dir . $new_name;
        if (file_exists($new_file))
        {
            $counter = 0;
            while (file_exists($new_file))
            {
                $new_name = $destination_prefix . "(" . $counter . ")_" . $name;
                $new_file = $destination_dir . $new_name;
                $counter++;
            }
            $result = move_uploaded_file($_FILES[$field_name]['tmp_name'], $new_file);
            $return["result"] = 1;
            $return["filename"] = $new_name;
        }
        else
        {
            $result = move_uploaded_file($_FILES[$field_name]['tmp_name'], $new_file);
            if (!$result)
            {
                $return["result"] = 0;
                $return["filename"] = $new_name;
            }
            else
            {
                $return["result"] = 1;
                $return["filename"] = $new_name;
            }
        }
    }
    else
    {
        $return["result"] = 3;
        $return["filename"] = $new_name;
    }
    return $return;
}
function makeThumbnail($i_file, $t_ht = 50)
{
    $o_file = e_PLUGIN . "e_classifieds/images/classifieds/" . $i_file;
    $resfile = e_PLUGIN . "e_classifieds/images/classifieds/thumb_" . $i_file;
    $image_info = getImageSize($o_file) ; // see EXIF for faster way
    // print $image_info['mime'] . "<br>";
    $eclassf_type = "";
    switch ($image_info['mime'])
    {
        case 'image/gif':
            if (imagetypes() &IMG_GIF) // not the same as IMAGETYPE
                {
                    $o_im = imageCreateFromGIF($o_file) ;
                $eclassf_type = "gif";
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
                $eclassf_type = "jpg";
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
                $eclassf_type = "png";
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
                $eclassf_type = "wbmp";
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
        // print $resfile;
        // $repl = array(".gif", ".png", ".bmp", ".jpeg", ".jpg");
        // $resfile = str_replace($repl, ".jpg" , $resfile);
        switch ($eclassf_type)
        {
            case "gif":
                imagegif($t_im, $resfile);
                break;
            case "jpg":
                imageJPEG($t_im, $resfile);
                break;
            case "png":
                imagepng($t_im, $resfile);
                break;
            case "wbmp":
                imagewbmp($t_im, $resfile);
                break;
        }

        chmod("./images/classifieds/" . $resfile, 0644);
        imageDestroy($o_im);
        imageDestroy($t_im);
    }
    return isset($ermsg)?false:"thumb_" . $i_file;
}

?>