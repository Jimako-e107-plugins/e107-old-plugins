<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Plugin BBcode file: e107_plugins/sgallery/e_bb.php.php
|        Email: m.yovchev@clabteam.com
|        $Revision: 777 $
|        $Date: 2009-05-13 14:29:38 +0300 (Wed, 13 May 2009) $
|        $Author: secretr $
|	     Copyright Corllete Lab ( http://www.clabteam.com )
|        Free Support: http://dev.e107bg.org/
+----------------------------------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
global $pref;

//widget check
$wcheck = '0';
$wclass = '';
if(array_key_exists('cl_widgets', $pref['plug_installed']) && class_exists('clw_widget')) {
	$cl_widget =& clw_widget::getInstance();
	
	//Shadowbox support
    if(clw_widget::isInstalled('shadowbox'))
    {
        $wdg = $cl_widget->getWidget('shadowbox');
        $wcheck = '1';
        $wclass = $wdg->getPref('shbox_wperms'); //permission check
    }
    //Lightview support
	elseif(clw_widget::isInstalled('lightview'))
	{
        $wdg = $cl_widget->getWidget('lightview');
        $wcheck = '1';
        $wclass = $wdg->getPref('lightv_wperms'); //permission check
    }
}

if(!function_exists('sgalBBcode')) {
	function sgalBBcode($perms) {
		global $pref;
		static $once = false;

		if($once) return '';
		
		include_lan(e_PLUGIN."sgallery/languages/".e_LANGUAGE."_bb.php"); 
		$chck = (check_class($pref['sgal_wperms']) && check_class($pref['sgal_active']) && check_class($perms));
		
		$wscript = "addtext('[thumb=w,h,far|title|group|float][/thumb]');";
		if($chck && class_exists('clw_widget'))
		{        	
        	//Shadowbox support
            if(clw_widget::isInstalled('shadowbox'))
            {
                $wscript = "Shadowbox.open( { content: '".CLW_ABS_SHADOWBOX."ajax_bb.php?ajax_used=1&q=default_sgallery', player: 'ajax', title: '".SGAL_ABBLAN_35." - ".SGAL_ABBLAN_41."' } );";
            }
            //Lightview support
        	else if(clw_widget::isInstalled('lightview'))
        	{
                $wscript = "Lightview.show( {href: '".CLW_ABS_SHADOWBOX."ajax_bb.php?default_sgallery', rel: 'ajax', title: '".SGAL_ABBLAN_35."', caption: '".SGAL_ABBLAN_41."', options: {autosize: true, topclose: true, alertSelected: '".SGAL_ABBLAN_50."'}} );";
            }
        }
		
		$ret = "
            <script type='text/javascript'>
            /* <![CDATA[ */
		    function sgalBBConfirm(perm){ 
                //quick CL Widgets 0.8 compat mod fix	
            	var tarea = typeof e107Helper === 'object' ? e107Helper.BB.__selectedInputArea :  e107_selectedInputArea || null,
                    sperm = ".($chck ? '1' : '0').";
            	
				if(!tarea) {
					alert('".SGAL_ABBLAN_50."');
					return;
				}

		    	if(!perm || !sperm)
		    		addtext('[thumb=w,h,far|title|group|float][/thumb]');
		    	else 
		    		{$wscript}
			}
			/* ]]> */
            </script>
		";

		$once = true;
		return $ret;
	}
}

$bb['name']		= 'clGallery'; 
$bb['onclick']		= "sgalBBConfirm"; 
$bb['onclick_var']	= $wcheck; 

$bb['icon']		= e_PLUGIN_ABS."sgallery/images/bb.png";
$bb['helptext']		= "[thumb=width,height,far|image_title|image_group|image_float]image link[/thumb]";
$bb['function']		= 'sgalBBcode';   
$bb['function_var']     = $wclass;  

// append the bbcode to the default templates:

if(check_class($pref['sgal_active'])) { //hide button if necessary
    $BBCODE_TEMPLATE .= "{BB=clGallery}"; 
    $BBCODE_TEMPLATE_NEWSPOST .= "{BB=clGallery}";
    $BBCODE_TEMPLATE_ADMIN .= "{BB=clGallery}";
    $BBCODE_TEMPLATE_CPAGE .= "{BB=clGallery}"; 
}
$eplug_bb[] = $bb;  // add to the global list - Very Important!    

?>