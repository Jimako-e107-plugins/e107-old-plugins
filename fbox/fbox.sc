// $Id: fbox.sc 667 2007-11-15 12:49:31Z secretr $
global $sql, $tp, $ns, $pref, $fbox_shortcodes;
//permission check
if(!check_class($pref['fbox_permission']))
    return '';

$lan_file = e_PLUGIN."fbox/languages/".e_LANGUAGE.".php";
include_lan($lan_file);
require_once(e_PLUGIN.'fbox/includes/fbox_utils.php');

$exact = $tp -> createConstants(fbox_abs2rel(str_replace("http://{$_SERVER['HTTP_HOST']}", '', e_SELF)), 1);
$parm = ($parm ? $parm.'&exact=' : 'exact=').$exact;

return fbox_sc($parm);