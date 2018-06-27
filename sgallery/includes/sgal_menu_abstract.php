<?php
/**
 * Corllete Lab Gallery
 * 
 * Copyright (C) 2006-2009 Corllete ltd (clabteam.com)
 * Support and updates at http://www.free-source.net/
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 * 
 * SGallery Abstract menu handler
 * 
 * $Id: sgal_menu_abstract.php 1561 2011-04-21 11:07:58Z berckoff $
 */

class sgal_menu_abstract
{
	/**
	 * @var	e_parse
	 */
	protected	$_tp       = null;
	
	/**
	 * @var e_db
	 */
	protected	$_sql      = null;
	
	protected	$_tmpl     = null;
	
	protected	$_data     = array('img'=>array(), 'alb'=>array(), 'cat'=>array());
	
	protected	$_params   = array();
	
	protected	$_galprefs = array();
	
	public function __construct()
	{	# Prepared for version detection
//		if ('0.7' == $version)
//		{
			global $tp, $sql, $sgal_pref;
			
			$this->_tp       = $tp;
			$this->_sql      = $sql;
			$this->_galprefs = $sgal_pref;
//		}
//		else
//		{
//			$this->_tp       = e107::getParser();
//			$this->_sql      = e107::getDb();
//			$this->_galprefs = clgallery::getPref();
//		}
	}
	
	public function runMenu($menu='default')
	{	# Some initial setup
		$cnt      = 0;
		$ipr      = $this->getParam('ipr', 0);
		$qry      = $this->getParam('db_query');
		$sort     = $this->getParam('sort', true);
		$tmpl     = $this->getTemplate();
		$text     = '';
		
		if (!$qry)   return (defset('e_DEBUG') && true == e_DEBUG ? 'Missing DB query param!' : '');
		if (!$tmpl)  return (defset('e_DEBUG') && true == e_DEBUG ? 'Menu template not set!'  : '');
		
		require_once SGAL_INCPATH.'sgal_file_class.php';
		
		$cl_files = new sgal_file();
		
		if (is_array($tmpl))  $text.= $tmpl['start'];
		
		if ($this->_sql->db_Select_gen($qry))
		{
			if ('latest_pics' == $menu)
			{
				$alldb     = $this->_sql->db_getList('ALL', FALSE, FALSE, 'path');
				$dirmask   = implode('|', array_keys($alldb));
				$allitems  = $cl_files->get_files(e_PLUGIN.'sgallery/pics/', '.jpg|.jpeg|.gif|.png|.bmp|.JPG|.JPEG|.GIF|.PNG|.BMP', '^[_]{2}', 1, $dirmask);
				$allitems  = $cl_files->multiarray_sort($allitems, 'ftime', 'desc', false, false);
				$albPicCnt = array();
				
				if (($limit = $this->getParam('limit')))  $allitems = array_slice($allitems, 0, $limit);
			}
			else
			{
				$allitems  = $this->_sql->db_getList('ALL', FALSE, FALSE);
			}
			
			if ($allitems)
			{
				foreach ($allitems as $item)
				{
					if (is_array($tmpl) && (!$ipr || ($ipr && 0 == $cnt)))
					{
						$text.= $tmpl['list']['row_start'];
						$open = true;
					}
					
					$this->_data = $item;
					
					if ('latest_pics' == $menu)
					{
						$cnt++;
						$dir         = basename($item['path']);
						$row         = $alldb[$dir];
						$img_path    = $item['fname'];
						$img_src     = showThumb($row['path'].'/'.$img_path, $cfgarr);
						$img_alt     = htmlentities($row['title'], ENT_QUOTES, 'UTF-8');
						$items_count = count($allitems);
						
						$IMAGE       = '<img src="'.$img_src.'" alt="'.$img_alt.'" class="image-thumb" />';
						$IMAGE_SRC   = $img_src;
						$IMAGE_OPEN  = '<a href="'.SGAL_ALBUMPATH_ABS.$row['path'].'/'.$img_path.'" rel="shadowbox__latest_gal___" onclick="sgalSmartOpen(\''.showJsThumb($row['path'].'/'.$img_path, $img_alt).'\'); return false;" title="'.$this->_tp->text_truncate($img_alt, 50, '...').'">'.$IMAGE.'</a>';
						$IMAGE_COUNT = !isset($albPicCnt[$dir]) ? $albPicCnt[$dir] = count($row) : $albPicCnt[$dir];
						
						$ALBUM_TITLE = $this->_tp->text_truncate($this->_tp->toHTML($row['title'], FALSE, 'parse_sc,no_hook,emotes_off,no_make_clickable'), 25, '...');
						$ALBUM_HREF  = SGAL_PATH_ABS.'gallery.php?view.'.$row['album_id'].'.1.1';
						$ALBUM_LINK  = '<a href="'.$ALBUM_HREF.'" title="'.$img_alt.'">'.$ALBUM_TITLE.'</a>';
					}
					else
					{
						$img_path  = SGAL_ALBUMPATH.$item['path'].'/';
						$img_list  = $cl_files->sgal_pics($img_path, $this->_galprefs, !$sort);
						$img_count = count($img_list);
						
						if ($img_count)
						{
							$cnt++;
							$rand_key = array_rand($img_list);
							
							$img = $img_list[$rand_key]['fname'];
							$src = showThumb($item['path'].'/'.$img, $cfgarr);
							$alt = str_replace("'", '', ($item['ctitle'] ? $item['ctitle'].' - ' : '').$item['title']);
							
							$IMAGE         = '<img src="'.$src.'" alt="'.$alt.'" style="border: 0px none; vertical-align: middle;" />';
							$IMAGE_SRC     = $src;
							$IMAGE_OPEN    = '<a href="'.SGAL_ALBUMPATH_ABS.$item['path'].'/'.$img.'" class="lightview" rel="gallery_pr" onclick="sgalSmartOpen(\''.showJsThumb($item['path'].'/'.$img, $alt).'\'); return false;" title="'.$alt.'">'.$IMAGE.'</a>';
							$IMAGE_COUNT   = $img_count;
							
							$ALBUM_TITLE   = $this->_tp->toHTML($item['title'], FALSE, 'parse_sc,no_hook,emotes_off,no_make_clickable');
							$ALBUM_HREF    = SGAL_PATH_ABS.'gallery.php?view.'.$item['album_id'].'.1.1';
							$ALBUM_LINK    = '<a href="'.$ALBUM_HREF.'">'.$ALBUM_TITLE.'</a>';
							
							$GALLERY_TITLE = $this->_tp->toHTML($item['ctitle'], FALSE, 'parse_sc,no_hook,emotes_off,no_make_clickable');
							$GALLERY_HREF  = SGAL_PATH_ABS.'gallery.php?list.'.$item['cat_id'].'.1';
							$GALLERY_LINK  = '<a href="'.$GALLERY_HREF.'">'.$GALLERY_TITLE.'</a>';
						}
					}
					
					if (is_string($tmpl))  $text.= preg_replace("/\{(.*?)\}/e", '$\1', $tmpl);
					else  $text.=	preg_replace("/\{(.*?)\}/e", '$\1', $tmpl['list']['item']).
									(!$ipr || $ipr == $cnt ? '' : preg_replace("/\{(.*?)\}/e", '$\1', $tmpl['list']['separator']));
					
					if (is_array($tmpl) && (!$ipr || $ipr == $cnt))
					{
						$text.= $tmpl['list']['row_end'];
						$cnt  = 0;
						$open = false;
					}
				}
				
				if (true == $open)  $text.= $tmpl['list']['row_end'];
			}
		}
		
		if (is_array($tmpl))  $text.= $tmpl['end'];
		
		return $text;
	}
	
	public function getParam($param, $default='')
	{
		return varsettrue($this->_params[$param], $default);
	}
	
	public function setParam($param, $value)
	{
		if     (isset($this->_params[$param]) && null === $value)  unset($this->_params[$param]);
		elseif (is_array($param) && true == $value)                $this->_params[] = $param;
		else   $this->_params[$param] = $value;
		
		return $this;
	}
	
	public function getTemplate()
	{
		return $this->_tmpl;
	}
	
	public function setTemplate($tmpl)
	{
		$this->_tmpl = $tmpl;
		
		return $this;
	}
	
	#
	# Shortcodes
	#
	public function sc_image($parm='')
	{
		if (is_string($parm))                               parse_str($parm, $parm);
		if (isset($parm['count']))                          return $this->_data['img']['count'];
		
		$src = $this->_data['img']['path'].'/'.$this->_data['img']['fname'];
		
		if (isset($parm['src']))                            return $src;
		
		$alt = htmlentities(($this->_data['cat']['title'] ? $this->_data['cat']['title'].' - ' : '').$this->_data['alb']['title'], ENT_QUOTES, 'UTF-8');
		
		if (!$parm)                                         return '
									<img src="'.$src.'" alt="'.$alt.'" class="sgallery-img" />';
		
		# Thumbs width, height, force aspect ratio options
		$thc['w']   = varsettrue($parm['w'],   $this->_galprefs['sgal_thumb_w']);	# int	Width  in px
		$thc['h']   = varsettrue($parm['h'],   $this->_galprefs['sgal_thumb_h']);	# int	Height in px
		$thc['far'] = varsettrue($parm['far'], $this->_galprefs['sgal_far']);		# bool	true|false
		
		$thumb_src  = showThumb($src, $thc);
		
		if (isset($parm['thumb']) && isset($parm['src']))   return $thumb_src;
		
		if (isset($parm['thumb']))                          return '
									<img src="'.$thumb_src.'" alt="'.$alt.'" class="sgallery-thumb" />';
		
		if (isset($parm['link']))                           return '
									<a href="'.SGAL_ALBUMPATH_ABS.$src.'" rel="shadowbox__latest_gal___" onclick="sgalSmartOpen(\''.showJsThumb($src, $alt).'\'); return false;" title="'.$this->_tp->text_truncate($alt, 50, '...').'">
										<img src="'.$src.'" alt="'.$alt.'" class="sgallery-thumb" />
									</a>';
		
		
	}
	
	public function sc_album($parm='')
	{
		return;
	}
	
	public function sc_gallery($parm='')
	{
		return;
	}
	
	protected function _parseTemplate($text)
	{
		if (preg_match_all('/{.+?}/', $text, $matches))
		{
			foreach ($matches[0] as $match)
			{
				if (strpos($match, '='))               list($sc, $parm) = explode('=', $match, 2);
				if (!method_exists($this, 'sc_'.$sc))  continue;
				
				$text = str_replace('{'.$match.'}', $this->{'sc_'.$sc}($parm));
			}
		}
		
		return $this->_tp->parseTemplate($text);
	}
}