/* $Id: widget.sc 651 2009-07-17 16:40:35Z secretr $ */

if(!defined('CLW_APP'))
    require_once(e_PLUGIN.'cl_widgets/widget.php');
    
    $parms = array();
    if(!$parm) {
        return '';
    }

    $tmp = explode('|', $parm, 2);
    parse_str(varset($tmp[1]), $parms);
    
    $widget = $tmp[0];
    $scname = varsettrue($parms['sc'], $widget);
    if(!$widget) return '';
    
    $cl_widget = &clw_widget::getInstance();
    return $cl_widget->run_sc($widget, $scname, $parms, $mod);