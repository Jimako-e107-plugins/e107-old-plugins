<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        e107 Meta file: e107_plugins/sgallery/e_meta.php
|        Email: m.yovchev@clabteam.com
|        $Revision: 741 $
|        $Date: 2008-04-23 14:31:38 +0300 (Wed, 23 Apr 2008) $
|        $Author: secretr $
|	     Copyright Corllete Lab ( http://www.clabteam.com )
|        Free Support: http://dev.e107bg.org/
+----------------------------------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }

	
	echo "<script type='text/javascript'>\n";
	echo "<!--\n";
	echo "
	function sgalSmartOpen(url, lvforce, lbel) {
		if(typeof Lightbox != 'undefined' && !lbforce) { //Deprecated
		
            if(lbel) { myLightbox.start(lbel); return 1; }
            return false;
            
  
		}  else if(typeof Shadowbox != 'undefined') {
		
            if(lvforce) {
            	lbel = $(lbel); 
  				Shadowbox.open({
  						content: lbel.href, 
  						title: lbel.title,
  						player: 'img'
  				});
            }
			return false;
			
		} else if(typeof Lightview != 'undefined') { //Deprecated
		
            if(lvforce) {
            	lbel = $(lbel);
  				Lightview.show({
  						href: lbel.href, 
  						title: lbel.title,
  						options: {
  							autosize: true
  						}
  				});
            }
			return false;
		}  else {
		
			pwindow = window.open(url,'preview', 'resizable=yes,width=600,height=400,menubar=no,toolbar=no');
			pwindow.focus();
			return false;
		}
	}
	";
	echo "//-->\n";
	echo "</script>\n";
?>