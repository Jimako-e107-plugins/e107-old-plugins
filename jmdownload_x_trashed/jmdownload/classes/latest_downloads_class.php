<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2009 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 *
 *
 * $Source: /cvs_backup/e107_0.8/e107_plugins/download/e_list.php,v $
 * $Revision$
 * $Date$
 * $Author$
 */

if (!defined('e107_INIT')) { exit; }

class latest_downloads_list
{
	protected $plugPrefs = array();
	protected $amount;

	function __construct() {
 
        $this->plugPrefs = e107::getPlugPref('jmdownload');
 

    }


	function getListData($limit = 5 )
	{                            
 
        $limit = ($limit == 0) ? $this->plugPrefs['menus_amount']  : $limit;
        $qry = " AND find_in_set(download_visible,'" . USERCLASS_LIST . "')  ";

		$qry = "SELECT d.*,
            dc.download_category_name, dc.download_category_id, dc.download_category_sef 
			FROM #download AS d
			LEFT JOIN #download_category AS dc ON d.download_category=dc.download_category_id
			WHERE 
			d.download_active > '0' ".$qry."
			ORDER BY download_datestamp DESC LIMIT 0,".intval($limit)." ";
                                                                   
		 	$downloads = e107::getDB()->retrieve($qry, true);

        return $downloads;
	}
 
}
?>