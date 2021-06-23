<?php

if (!defined('e107_INIT')) { exit; }

require_once 'topDownloads.php';
include_lan(e_PLUGIN.'top_downloads_menu/languages/'.e_LANGUAGE.'.php');

global $ns, $menu_pref;

if (!$ns)	$ns = new e107table();

$html = '';

$catTree = new tdCategoryTree();
$catTree->loadTree();

if ($catTree->hasTree())
{
	$q_cat = $q_date = '';
	
	if ($catTree->hasNode($menu_pref['top_downloads_cat']))
	{
		$q_cat	= $catTree->getNode($menu_pref['top_downloads_cat']);
		$q_cat	= "
		AND
			d.download_category = '{$q_cat->getData($q_cat->getIDField())}'";
	}
	
	if ($menu_pref['top_downloads_period'])								# Check if something messed up the prefs or prefs not set via menu config
	{
		$s_date	= time();												# Current time(stamp)
		$period = 7 == $menu_pref['top_downloads_period'] ? date('w', $s_date)-1 : date('j', $s_date)-1;
		if (0 > $period) $period = 6;									# $period = -1, if first day of the week, = 0 if first day of the month
		$e_date	= strtotime(date('d F Y', $s_date)) - ($period*86400);	# How mant days backwards
		$q_date	= "
		AND
			dr.download_request_datestamp > {$e_date}
		AND
			dr.download_request_datestamp < {$s_date}";	
	}
	
	$query	= "
		SELECT
			d.*, COUNT(dr.download_request_id) as download_this_period_count
		FROM
			#download as d
		INNER JOIN
			#download_requests as dr
		ON
			d.download_id = dr.download_request_download_id
		WHERE
			d.download_active != 0".
		$q_cat.
		$q_date."
		GROUP BY
			dr.download_request_download_id
		ORDER BY
			download_this_period_count DESC
		LIMIT
			0,{$menu_pref['top_downloads_count']}"
	;
	
	$downloadsTree = new tdDownloadTree();
	$downloadsTree->setParam('query', $query)
		->loadTree();
	
	if ($downloadsTree->hasTree())
	{
		$i = 0;
		$tmpl = CLabClass::getTemplate('top_downloads_menu');
		
		# The subquery counts previous period downloads
		$total_query = '
		SELECT
			d.download_request_download_id AS download_id,
			COUNT(d.download_request_id) AS download_total,
			(
				SELECT
					COUNT(dr.download_request_id)
				FROM
					e107_download_requests as dr
				WHERE
					d.download_request_download_id = dr.download_request_download_id
				AND
					download_request_datestamp > '.($e_date-($menu_pref['top_downloads_period']*86400)).'
				AND
					download_request_datestamp < '.$e_date.'
				GROUP BY
					dr.download_request_download_id
			) as download_last_period_count
		FROM
			e107_download_requests as d
		WHERE
			d.download_request_download_id IN ('.implode(',', $downloadsTree->getNodeIDs()).')
		GROUP BY
			d.download_request_download_id'
		;
		
		$totalTree = new tdDownloadTree();
		$totalTree->setParam('query', $total_query)
			->loadTree();
		
		foreach ($downloadsTree->getTree() as $id=>$model)
		{
			$i++;
			
			$cTree = $totalTree->getNode($id);
			
			if (!is_object($cTree))	continue;
			
			$model->setData('download_position', $i)
				->setData('download_total', $cTree->getData('download_total'))
				->setData('download_period', $menu_pref['top_downloads_period'])
				->setData('download_last_period_count', $cTree->getData('download_last_period_count'))
				->setData('catModel', $catTree->getNode($model->getData('category')));
			
			$html[] = CLabClass::parseTemplate($tmpl['item']['item'], $model);
		}
		
		$html = implode(CLabClass::parseTemplate($tmpl['item']['separator'], $model), $html);
	}
	else
	{
		$html = LAN_TOPDOWNLOADS_NO_DOWNLOADS;
	}
}
else
{
	$html = LAN_TOPDOWNLOADS_NO_DOWNLOADS;
}

$ns->tablerender( LAN_TOPDOWNLOADS_MENU_TITLE, 
	CLabClass::parseTemplate($tmpl['start'], $model).
	$html.
	CLabClass::parseTemplate($tmpl['end'], $model)
);