<?php
/**
 * @file
 * Load libraries and JS/CSS files.
 * If you want to use libraries plugin just upload quick-select folder to e107_web folder 
 * Libraries plugin:  https://github.com/lonalore/libraries 
 */
 
if(!defined('e107_INIT'))
{
	exit;
} 
 
if(USER_AREA && (strpos(e_REQUEST_URI, 'links/manage') !== false))
{                     
  e107::js('links_page','frmediaman/frmediaman-modal.js');
  e107::js('links_page','frmediaman/frmediaman.js');
}           
?>