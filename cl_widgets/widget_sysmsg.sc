/* $Id: widget_sysmsg.sc 410 2009-06-06 14:35:57Z secretr $ */

if(!defined('CLW_APP'))
    require_once(e_PLUGIN.'cl_widgets/widget.php');
    
    require_once(CLW_COMPAT_PATH.'message_handler.php');
    $emessage = eMessage::getInstance();
    
    return $emessage->render();