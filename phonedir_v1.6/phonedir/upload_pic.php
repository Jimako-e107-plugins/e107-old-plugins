<?php

function pdir_fileup($field_name, $destination_dir, $destination_prefix)
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

?>