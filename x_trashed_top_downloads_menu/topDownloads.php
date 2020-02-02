<?php

require_once 'CLabClasses.php';

class tdCategoryModel extends CLabModel
{
	protected	$_p_key		= 'download_category_id';
	protected	$_table		= 'download_category';
	protected	$_caller	= 'download_category';
	
}

class tdCategoryTree extends CLabTree
{
	/**
	 * @var	CLabModel
	 */
	protected	$_model		= 'tdCategoryModel';
	protected	$_caller	= 'download_category';
	
}

class tdDownloadModel extends CLabModel
{
	protected	$_p_key		= 'download_id';
	protected	$_table		= 'download';
	protected	$_caller	= 'download';
	
	public function sc_download_name($parm='', $mode='')
	{
		if (is_string($parm))		parse_str($parm, $parm);
		if (!isset($parm['link']))	return $this->getData('name');
		
		$rel	= varsettrue($parm['rel']) ? 'rel="'.$parm['rel'].'"' : '';
		$href	= 'href="'.e_BASE.'download.php?view.'.$this->getData($this->getIDField()).'"';
		$link	= $this->getData('name');
		$title	= 'title="'.varsettrue($parm['title'], $link).'"';
		
		return "<a $href $title $rel>$link</a>";
	}
	
	public function sc_download_this_period_count($parm='', $mode='')
	{
		return $this->getData('this_period_count');
	}
	
	public function sc_download_last_period_count($parm='', $mode='')
	{
		return $this->getData('last_period_count', 0);
	}
	
	public function sc_download_total($parm='', $mode='')
	{
		return $this->getData('total');
	}
	
	public function sc_download_period($parm='', $mode='')
	{
		return (7 == $this->getData('period') ? LAN_TOPDOWNLOADS_WEEK : LAN_TOPDOWNLOADS_MONTH);
	}
	
	public function sc_download_position($parm='', $mode='')
	{
		return $this->getData('position');
	}
	
	public function sc_download_filesize($parm='', $mode='')
	{
		if (is_string($parm))			parse_str($parm, $parm);
		if (!isset($parm['format']))	return $this->getData('filesize');
		
		$divide	= ('kb' == $parm['format'] ? 1024 : ('mb' == $parm['format'] ? 1048576 : ('gb' == $parm['format'] ? 1073741824 : 1)));
		$size = str_replace('.', ',', $this->getData('filesize')/$divide);
		
		if (strpos($size, ','))			$size = substr($size, 0, (strpos($size, ',')+3));
		if (isset($parm['separator']))	$size = str_replace(',', $parm['separator'], $size);
		
		return ($size.' '.defset('LAN_TOPDOWNLOADS_'.strtoupper($parm['format']), strtoupper($parm['format'])));
	}
	
	public function sc_download_category($parm='', $mode='')
	{
		$cat_model = $this->getData('catModel');
		
		if (is_string($parm))	parse_str($parm, $parm);
		if (!is_object($cat_model) || !isset($parm['field']))	return '';
		if (!isset($parm['link']))	return $cat_model->getData($parm['field']);
		
		$rel	= varsettrue($parm['rel']) ? 'rel="'.$parm['rel'].'"' : '';
		$href	= 'href="'.e_BASE.'download.php?list.'.$cat_model->getData($cat_model->getIDField()).'"';
		$link	= $cat_model->getData($parm['field']);
		$title	= 'title="'.varsettrue($parm['title'], $link).'"';
		
		return "<a $href $title $rel>$link</a>";
	}
}

class tdDownloadTree extends CLabTree
{
	/**
	 * @var	CLabModel
	 */
	protected	$_model		= 'tdDownloadModel';
	protected	$_caller	= 'download';
	
}