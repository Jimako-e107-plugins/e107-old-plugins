<?php

function cwriter_fileup($field_name, $destination_dir, $destination_prefix)
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
function cwriter_watermark($source, $height, $width)
{
    if (function_exists("imagegif"))
    {
        print "gif ok";
    }
    if (file_exists('./images/watermark.png'))
    {
        // if there is a watermark
        $watermark = imagecreatefrompng('./images/watermark.png');
        $watermark_width = imagesx($watermark);
        $watermark_height = imagesy($watermark);
        $image = imagecreatetruecolor($watermark_width, $watermark_height);
        $path_info = pathinfo($source);
        print $path_info['extension'];
        switch ($path_info['extension'])
        {
            case "jpg":
                $image = imagecreatefromjpeg($source);
                break;
            case "png":
                $image = imagecreatefrompng($source);
                break;
            case "gif":
                $image = imagecreatefromgif($source);
                break;
        } // switch
        // $image = imagecreatefromjpeg($source);
        // .
        // resize
        // .
        $size = getimagesize($source);
        #$image = imagecreatetruecolor($width, $height);
        #imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
        // .
        // end resize
        // .
        $dest_x = $size[0] - $watermark_width - 5;
        $dest_y = $size[1] - $watermark_height - 5;
        imagecolortransparent($watermark, imagecolorat($watermark, 0, 0));
        imagecopymerge($image, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height, 100);
        switch ($path_info['extension'])
        {
            case "jpg":
                imagejpeg($image, $source);
                break;
            case "png":
                imagepng($image, $source);
                break;
            case "gif":
                print "www";
                imagegif($image, $source);
                break;
        } // switch
        // imagejpeg($image, $source);
        imagedestroy($image);
        imagedestroy($watermark);
    }
}

?>