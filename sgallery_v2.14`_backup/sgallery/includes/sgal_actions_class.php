<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Gallery Render Class: e107_plugins/sgallery/includes/sgal_render_class.php
|        Email: m.yovchev@clabteam.com
|        $Revision: 739 $
|        $Date: 2008-04-22 14:03:31 +0300 (Tue, 22 Apr 2008) $
|        $Author: secretr $
|	     Copyright Corllete Lab ( http://www.clabteam.com ) under GNU GPL License (http://gnu.org)
|        Free Support: http://dev.e107bg.org/
+----------------------------------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }

include_lan(SGAL_LAN.'_sysmsg.php');

class sgal_actions_class
{
	/**
	 * @var	sgal_file
	 */
	public	$flobj	= '';
	
	/**
	 * @desc	Delete Image
	 *
	 * @param	string	$imagepath	relative/absolute path to the images
	 * @param	integer	$del_id		ID of the file to be deleted
	 * @param	string	$mod		user | admin  | approve
	 * @param	integer	$albumid	ID of the album the picture is in
	 * @return	mixed	array msg => message, caption | status boolean => true == success, false == error
	 */
	public function deleteImage($imagepath='', $del_id='', $mod='user', $albumid=0)
	{
		global $sgal_pref, $sql;
		
		$text = array();
		
		if (!$imagepath || !is_string($imagepath) || !$del_id) return false;
		
		if (($mod=='admin' || $mod=='approve') && !getperms('6'))
		{
			$text['status']	= false;
			$text['msg']	= array(SGAL_LANADM_106, LAN_ERROR);
			
			return $text;
			
		} else {
			
			// TO DO check user permissions ?
		}
		
		# Filename check
		$this->checkPath($del_id);        
		
		//if (substr($imagepath, strlen($imagepath)-1, 1) != '/') { $imagepath.= '/'; }
		$imagepath.= ('/' != $imagepath[0]) ? '/' : '';
		
		# Delete file if readable or return File not found error if not
		if(is_readable($imagepath.$del_id))
		{
			$delpath = $imagepath.$del_id;
			chmod($delpath, 0777);
			
			if(unlink($delpath))
			{
				$text['status']	= true;
				$text['msg']	= ('admin' == $mod || 'approve' == $mod) ? array("&quot;$del_id&quot; - ".LAN_DELETED , LAN_DELETED) : SGAL_LANMNG_12;
				
				if($albumid && 'approve' == $mod)
				{
					# Update pic count		// Note: this shouldn't be here - mess up with sgal API
					if(!$this->flobj)
					{
						require_once SGAL_INCPATH.'sgal_file_class.php';
						$this->flobj = new sgal_file();
					}
					
					$imagelist = $this->flobj->sgal_approve_pics($imagepath, $sgal_pref, false);
					
					if(!empty($imagelist))
					{
						$sql->db_Update('sgallery_submit', "submit_picnum='".count($imagelist)."' WHERE submit_album_id='{$albumid}'");
						
					} else {
						
						$sql->db_Delete('sgallery_submit', "submit_album_id='{$albumid}'");
					}
				}
				
			} else {
				
				$text['status']	= false;
				$text['msg']	= ($mod == 'admin' || $mod=='approve') ? array("&quot;$del_id&quot; - ".LAN_DELETED_FAILED, LAN_ERROR) : SGAL_LANMNG_13;
			}
			
		} else {
			
			$text['status'] = false;
			$text['msg'] = $mod == 'admin' || $mod=='approve' ? array("&quot;".$del_id."&quot; - ".SGAL_LANADM_127, LAN_ERROR.' - '.LAN_DELETED_FAILED) : SGAL_LANMNG_14;
		}
		
		return $text;
	}
	
	/**
	 * @desc	Upload Image
	 *
	 * @param	string	$imagepath		relative/absolute path to the images
	 * @param	string	$destination	destination for the resized picture(s)
	 * @param	object	$sgalobj		instance of clgallery class
	 * @param	boolean	$delSource		whether to delete the source image or not
	 * @param	string	$mod			user | admin
	 * @param	array	$limit
	 * @return	array	msg
	 */
	public function uploadImage($imagepath, $destination, $sgalobj, $delSource=false, $mod='admin', $limit=array('total'=>null, 'album'=>null, 'picnum'=>null))
	{
		global $pref, $sgal_pref;
		
		if(!isset($_POST['submitupload'])) return '';
		
		include_lan(SGAL_LAN.'_manager.php');
		
		$text = '';
		
		# Permissions checks
		if (!FILE_UPLOADS)
		{
			$text.= '<br /><strong>'.(ADMIN ? LAN_UPLOAD_SERVEROFF : SGAL_LANRND_108).'</strong><br />';
		}
		elseif('admin' == $mod && !getperms('6'))
		{
			$text.= '<br /><strong>'.SGAL_LANRND_108.': '.SGAL_ALBUMPATH_ABS.'</strong><br />';
		}
		elseif('user' == $mod && (!$pref['upload_enabled'] || !check_class($pref['upload_class']))) 
		{
			$text.= ADMIN ? '<br /><a href="'.e_ADMIN.'upload.php">'.SGAL_LANRND_109.'</a><br />' : '<br /><strong>'.SGAL_LANRND_108.'</strong><br />';
		}
		
		if ($text)	return array($text);
		
		# 
		# The new upload interface - e107 v0.79 / cl gallery v2.02
		#
		if (!function_exists('process_uploaded_files'))
		{
			require_once e_HANDLER.'upload_handler.php';
		}
		
		$uopt		=
		$sysmsg		=
		$nuploaded	=			//not uploaded
		$resize_msg	= array();
		
		$fileinfo	= ($mod=='user' && $sgal_pref['sgal_usermod_picapprove']) ? 'prefix+__app_' : false;
		
		$uopt['filetypes']			= false;		 //$uopt['filetypes'] = ???; - discuss it on e107developer.org
		$uopt['file_mask']			= SGAL_UPFTYPES; //only media file upload is possible
		$uopt['extra_file_types']	= SGAL_UPFTYPES; //upload even when not in allowed list 
		$uopt['final_chmod']		= 0755;			 // discuss it as well
		$uopt['max_file_count']		= ('user' == $mod  && $limit['picnum'] && null !== $sgal_pref['sgal_usermod_piccount']) ? ($tmp = $limit['picnum'] - $sgal_pref['sgal_usermod_piccount'] > 0 ? $tmp : 0) : 0; 
//		$uopt['max_upload_size']	= ''; // not in use yet
//		$uopt['file_array_name']	= ''; // not in use yet
		
		$uploaded	= process_uploaded_files($imagepath, $fileinfo, $uopt);
		
		if($uploaded)
		{
			foreach ($uploaded as $k=>$v)
			{
				# User albums fix
				$fpath = $v['rawname'] != $v['name'] ? realpath($imagepath).'/'.$v['rawname'] : '';
				
				clearstatcache();
				
				if($fpath && is_file($fpath))
				{
					$v['error']		= 250;
					$v['message']	= LANUPLOAD_10;
					$fpath			= realpath($imagepath).'/'.$v['name'];
					
					@chmod($fpath, 0777);
					@unlink($fpath);
				}
				
				# Errors cleanup - writes the errors and removes the files associated
				if($v['error'])
				{
					$nuploaded[] = $v;
					unset($uploaded[$k]);
					
					continue;
				}
			}
			
			$thobj		= $sgalobj->loadObj('thumb_class');
			$resize_msg	= $thobj->imageActions($uploaded, $_POST['uploadtype'], $imagepath, $destination, $delSource);
		}
		
		# Limit check - after the images are successfully resized
		$uploaded		= !empty($uploaded) ? getcachedvars('c_sgal_resized') : false;
		
		$limit_error	= array();
		$limit_acheck	= (null !== $limit['album'] && $sgal_pref['sgal_usermod_albumsize']) ? true : false;
		$limit_tcheck	= (null !== $limit['total'] && $sgal_pref['sgal_usermod_totalsize']) ? true : false;
		
		if ($uploaded && 'user' == $mod && ($limit_tcheck || $limit_acheck))
		{
			$csize		= 0;
			
			foreach($uploaded as $k=>$v)
			{
				$file	= varset($v['resized_path']);
				$fsize	= varset($v['resized_size'], $uploaded['size']);
				
				if(!$limit_error)
				{
					$csize+= $fsize;
					
					if($limit_tcheck && ($csize+$limit['total'] >= $sgal_pref['sgal_usermod_totalsize']))
					{
						$limit_error[] = SGAL_LANMNG_15.' - '.SGAL_LANMNG_12a;
						unlink($file);
						unset($uploaded[$k]);
					}
					
					if($limit_acheck && ($csize+$limit['album'] >= $sgal_pref['sgal_usermod_albumsize']))
					{
						$limit_error[] = SGAL_LANMNG_16.' - '.SGAL_LANMNG_12a;
						unlink($file);
						unset($uploaded[$k]);
					}
					
				} else {
					
					unlink($file);
					unset($uploaded[$k]);
				}
			}
		}
		
		cachevars('c_sgal_resized', $uploaded);		// some files could be already deleted (limit)
		
		if(count($nuploaded))		$sysmsg[] = SGAL_SYSMSG_10.':<br />'.handle_upload_messages($nuploaded);
		if(!empty($resize_msg))		$sysmsg[] = implode('<br />', $resize_msg);
		if(!empty($limit_error))	$sysmsg[] = SGAL_SYSMSG_10.':<br />'.implode('<br />', $limit_error);
		if($uploaded)				$sysmsg[] = count($uploaded).' '.SGAL_LANMNG_19.($mod=='user' && $sgal_pref['sgal_usermod_picapprove'] ? '<br />'.SGAL_LANMNG_20.' ' : '');
		
		return $sysmsg;
	}
	
	/**
	 * @desc	Image rethumb Action
	 *
	 * @param	string	$imagepath	relative/absolute path to the images
	 * @param	string	$thname		picture filename
	 * @param	object	$sgalobj	instance of clgallery class
	 * @param	integer	$checkpath	0 - no check | 1 - check && exit | 2 - check only
	 * @return	array	msg
	 */
	public function rethumbImage($imagepath, $thname, $sgalobj, $checkpath=1)
	{
		global $pref, $sgal_pref;  
		
		$msg = array();
		
		# Check filename
		if($checkpath)
		{
			$ch = 1==$checkpath ? true : false;
			$this->checkPath($thname, $ch);
		}
		
		$thobj = $sgalobj->loadObj('thumb_class'); 
		
		# Auto_resize
		if($sgal_pref['sgal_restrict_size'] || $sgal_pref['sgal_allow_autoresize'])
		{
			$fls[0]['name']	= $thname;
			$tmpaction		= $sgal_pref['sgal_restrict_size'] ? 'restrict_resize' : ($sgal_pref['sgal_allow_autoresize'] ? 'auto_resize' : 'none');
			$msg			= $thobj->imageActions($fls, $tmpaction, $imagepath, '', false);
			
			unset($tmpaction, $thobj);
		} 
		
		return $msg;
	}
	
	/**
	 * @desc	Unique string generator
	 *
	 * @return	string
	 */
	function uniq_str()
	{
		$str = uniqid('', FALSE);
		$str = base_convert($str, 16, 10);
		$str = strrev($str);
		
		while(strlen($str) < 19)
		{
			$str = rand(0, 3).$str;
		}
		
		$str = base_convert($str, 10, 36);
		$str = str_pad($str, 10, '0', STR_PAD_LEFT);
		$str = strtolower($str);
		
		return $str;
	}
	
	/**
	 * @desc	check folder name / filename - security
	 * 
	 * @param	string	$path	- path to be checked
	 * @param	boolean	$break	- whether to break script execution or just return false on mismatch
	 * @return	boolean true - ok / false - error
	 */
	function checkPath($path, $break=true)
	{
		# Check the directory name
		if(!preg_match('/[a-zA-Z0-9._\-]/', $path))
		{
			if($break)
			{
				echo 'e107 [sgallery] said: Bad folder name. Access denied';
				require_once FOOTERF;
				exit;
			}
			
			return false;
		}
		
		return true;
	}
	
}