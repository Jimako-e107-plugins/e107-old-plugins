<?php
/*
+ ----------------------------------------------------------------------------+
| get_files method override, multi array sort
+----------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

require_once(e_HANDLER."file_class.php");

class sgal_file extends e_file
{
	function get_files($path, $fmask = '', $omit='standard', $recurse_level = 0, $dirmask = '', $current_level = 0)
	{
        $ret = array();

		if($recurse_level != 0 && $current_level > $recurse_level)
		{
			return $ret;
		}

		if(substr($path,-1) == '/')
		{
			$path = substr($path, 0, -1);
		}

		if(!$handle = opendir($path))
		{
			return $ret;
		}
		if($omit == 'standard')
		{
			$rejectArray = array('^\.$','^\.\.$','^\/$','^CVS$','thumbs\.db','.*\._$','^\.htaccess$','index\.html','null\.txt');
		}
		else
		{
			if(is_array($omit))
			{
				$rejectArray = $omit;
			}
			else
			{
				$rejectArray = array($omit);
			}
		}
		while (false !== ($file = readdir($handle)))
		{
			if(is_dir($path.'/'.$file))
			{

                if($file != '.' && $file != '..' && $file != '.svn' && $file != 'CVS' && $recurse_level > 0 && $current_level < $recurse_level)
				{
                    if(!$dirmask || preg_match("#".$dirmask."#", $file))
                    {
                        $xx = $this->get_files($path.'/'.$file, $fmask, $omit, $recurse_level, $dirmask, $current_level+1);
    					$ret = array_merge($ret,$xx);
					}
				}
			}
			elseif ($fmask == '' || preg_match("#".$fmask."#", $file))
			{
				$rejected = FALSE;
				foreach($rejectArray as $rmask)
				{
					if(preg_match("#".$rmask."#", $file))
					{
						$rejected = TRUE;
						break;
					}
				}
				if($rejected == FALSE)
				{
                    $finfo['path'] = $path."/";  // important: leave this slash here and update other file instead.
					$finfo['fname'] = $file;
					$finfo['ftime'] = filemtime($finfo['path'].$finfo['fname']);
					$ret[] = $finfo;
				}
			}
		}

		return !empty($ret) ? $ret : array();
	}

	function sgal_pics($path, &$sgal_prefs, $sort=true)
	{

        $farr = $this -> get_files($path, SGAL_PIC_FMASK, SGAL_NOTEMP_REJ);
        return $sort ? $this -> sgal_sort($farr, $sgal_prefs) : $farr;

    }

	function sgal_all_pics($limit, $dirmask='', $sort=true)
	{
        if(!$farr = getcachedvars('sgal_allpics')) {
            $farr = $this -> get_files(SGAL_ALBUMPATH, SGAL_PIC_FMASK, SGAL_NOTEMP_REJ, 1, $dirmask);
            cachevars("sgal_allpics", $farr);
        }

        if($sort)
            $farr = $this -> multiarray_sort($farr, 'ftime', 'desc', false, false);

        if($limit) {
            $limit = explode(',', $limit);
            $lmin = (int) trim(varset($limit[0], 0));
            $lmax = (int) trim(varset($limit[1], 0));

            //if($lmin || $lmax)
                $farr = array_slice($farr, $lmin, $lmax);
        }

        return $farr;
    }

	function sgal_count_allpics($dirmask='')
	{
        if(!$farr = getcachedvars('sgal_allpics')) {
            $farr = $this -> get_files(SGAL_ALBUMPATH, SGAL_PIC_FMASK, SGAL_NOTEMP_REJ, 1, $dirmask);
            cachevars("sgal_allpics", $farr);
        }

        return !empty($farr) && is_array($farr) ? count($farr) : 0;
    }

	function sgal_approve_pics($path, &$sgal_prefs, $sort=true)
	{

        $farr = $this -> get_files($path, SGAL_APPROVE_FMASK);
        return $sort ? $this -> sgal_sort($farr, $sgal_prefs) : $farr;

    }

	function sgal_sort(&$arr, &$sgal_prefs)
	{

        $order = varset($sgal_prefs['sgal_picorder'], 'desc');
        $skey = varset($sgal_prefs['sgal_picorder_type'], 'ftime');
        $natsort = $skey == 'ftime' ? false : true;

        return $this -> multiarray_sort($arr, $skey, $order, $natsort);
    }

    //php.net
    function multiarray_sort(&$array, $key, $order='asc', $natsort=true, $case=true)
    {
        if(!is_array($array)) return $array;

        $order = strtolower($order);

        foreach ($array as $i => $arr) {
           $sort_values[$i] = $arr[$key];
        }

        if(!$natsort) ($order=='asc')? asort($sort_values) : arsort($sort_values);
        else {
             $case ? natsort($sort_values) : natcasesort($sort_values);
             if($order != 'asc') $sort_values = array_reverse($sort_values, true);
        }
        reset ($sort_values);

        while (list ($arr_key, $arr_val) = each ($sort_values)) {
             $sorted_arr[] = $array[$arr_key];
        }
        return $sorted_arr;
    }
}
?>
