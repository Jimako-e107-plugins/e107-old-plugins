<?php

function uploadfile_shortcode($parm)
{
    global $pref;
    
    if(!FILE_UPLOADS)
    {
    	return LAN_UPLOAD_SERVEROFF;
    }
    if(USER_AREA === TRUE && !check_class($pref['upload_class']))
    {
    	return LAN_DISABLED;
    }
    
    
    if($parm && !is_writable($parm))
    {
    	return LAN_UPLOAD_777." <b>".str_replace("../","",$parm)."</b>";
    }
    
    $name = "file_userfile[]";
    //FIXME - XHTML/JS standards
    $text .="
            <!-- Upload Shortcode -->
    		<div>
    			<div class='field-spacer'>
    				<button type='button' class='action duplicate' value=\"".LAN_UPLOAD_ADDFILE."\" onclick=\"duplicateHTML('upline','up_container');\"><span>".LAN_UPLOAD_ADDFILE."</span></button>
    				<button class='upload' type='submit' name='uploadfiles' value=\"".LAN_UPLOAD_FILES."\"><span>".LAN_UPLOAD_FILES."</span></button>
    			</div>
    			<div id='up_container'>
    				<div id='upline' class='nowrap'>
    					<input class='tbox' type='file' name='{$name}' size='40' />
    		        </div>
    			</div>
    		</div>
    		<!-- End Upload Shortcode -->
    	";
    
    return $text;
}