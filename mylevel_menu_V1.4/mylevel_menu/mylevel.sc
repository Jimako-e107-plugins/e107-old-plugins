
// first param is display type
// second param is the userid - default USERID
include_lan(e_PLUGIN . 'mylevel_menu/languages/' . e_LANGUAGE . '.php');
require_once(e_HANDLER."userclass_class.php");
require_once(e_PLUGIN . "mylevel_menu/includes/mylevel_class.php");
global $tp, $MYLEVEL_PREF, $post_info, $mylevel_obj, $user;
if (!empty($parm))
{
    $mylevel_tmp = explode(",", $parm);
}
if (isset($mylevel_tmp[0]) && !empty($mylevel_tmp[0]))
{
    $mylevel_type = $mylevel_tmp[0];
}
else
{
    $mylevel_type = $mylevel_obj->mylevel_display ;
}

if (isset($mylevel_tmp[1]) && intval($mylevel_tmp[1]) > 0)
{
    // if the parameter 2 is set, this is the user ID to use
    $mylevel_userid = intval($mylevel_tmp[1]);
} elseif (strpos(e_PAGE, "forum") !== false)
{
    $mylevel_userid = $post_info['user_id'];
} elseif (e_PAGE == "user.php")
{
    $mylevel_userid = $user['user_id'];
}
else
{
    $mylevel_userid = USERID;
}
if (isset($mylevel_tmp[2]) && $mylevel_tmp[2] == "true")
{
    $mylevel_docomment = true;
} elseif (isset($mylevel_tmp[2]) && $mylevel_tmp[2] == "false")
{
    $mylevel_docomment = false;
}
else
{
    $mylevel_docomment = true;
}
if (!is_object($mylevel_obj))
{
    $mylevel_obj = new mylevel;
}

if (!is_object($mylevel_db))
{
    // because we don't know where this is called
    $mylevel_db = new DB;
}

if (in_array($mylevel_userid, $mylevel_obj->mylevel_excluded))
{
    // in excluded class so exit the menu
    return "";
}
// Calc their level if automatic
if ($mylevel_obj->mylevel_userate > 0)
{
    // get their current contribution
    $mylevel_cont = $mylevel_obj->get_contribution($mylevel_userid);
    // calculate their level
    $mylevel_calclevel = $mylevel_obj->user_level($mylevel_cont);
    // update their level
    $mylevel_obj->update_user($mylevel_userid, $mylevel_cont, $mylevel_calclevel);
}
// Get their details

if(!$mylevel_db->db_Select("mylevel", "*", "where mylevel_id=$mylevel_userid", "nowhere", false))
{
// user not in table so add then get their info

	$mylevel_obj->update_user($mylevel_userid, 1, $mylevel_obj->user_level(1));
	$mylevel_db->db_Select("mylevel", "*", "where mylevel_id=$mylevel_userid", "nowhere", false);
}

extract($mylevel_db->db_Fetch());

$mylevel_dir = $mylevel_obj->location();
// If the shortcode has a parameter then use that for the type of display else use the standard
switch ($mylevel_type)
{
    case "analogue":
        $mylevel_type = "analogue";
        break;
    case "bar":
        $mylevel_type = "bar";
        break;
    case "digital":
        $mylevel_type = "digital";
        break;
    case "thermo":
        $mylevel_type = "thermo";
        break;
    case "thermovert":
        $mylevel_type = "thermovert";
        break;
    case "thermohoriz":
        $mylevel_type = "thermohoriz";
        break;
    default:
        $mylevel_type = $MYLEVEL_PREF['mylevel_display'];
}

$mylevel_warn = $mylevel_obj->user_warn();
$mylevel_loc = $mylevel_obj->location();
// $mylevel_calclevel = $mylevel_obj->user_level($mylevel_contribution, $mylevel_level);
$mylevel_text = "
<img src='" . e_PLUGIN . "mylevel_menu/images/{$mylevel_loc}/{$mylevel_type}/{$mylevel_level}.png' alt='" . $mylevel_warn[$mylevel_calclevel] . "' title='" . $mylevel_warn[$mylevel_calclevel] . "' />";
if ($mylevel_docomment)
{
    $mylevel_text .= "<br />" . $mylevel_warn[$mylevel_calclevel];
    if (!empty($mylevel_comment))
    {
        $mylevel_text .= "<br />" . $tp->toHTML($mylevel_comment, false);
    }
}

return $mylevel_text;
