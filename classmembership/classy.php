<?php
require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "classmembership/languages/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "classmembership/languages/" . e_LANGUAGE . ".php");
}
else
{
    include_once(e_PLUGIN . "classmembership/languages/English.php");
}
define("PAGE_NAME", CLASSY_1);
require_once(HEADERF);
$classy_user = check_class($pref['classy_userclass']);
// Check that valid user class to do this if not tell them
if (!$classy_user)
{
    $ns->tablerender(CLASSY_1, CLASSY_2);
    require_once(FOOTERF);
    exit();
}

$classy_selclass = (isset($_POST['classy_select'])?$_POST['classy_select']:0);

$classy_text .= "<form id='classyform' method='post' action='" . e_SELF . "' >
<div class='fborder' style='width:97%'>
<div class='fcaption'>" . CLASSY_1 . "</div>";
$classy_text .= "<div class='forumheader2'>" . CLASSY_4 . "</div>
<div class='forumheader3'><ul>";
if ($sql->db_Select("userclass_classes", "*", "find_in_set(userclass_id,'" . USERCLASS_LIST . "')"))
{
    while ($classy_in = $sql->db_Fetch())
    {
        $classy_text .= "<li>" . $classy_in['userclass_name'] . "</li>";
    }
}
else
{
    $classy_text .= "<li>".CLASSY_8."</li>";
}

$classy_text .= "</ul></div>
<div class='forumheader2'>" . CLASSY_5 . "&nbsp;
<select name='classy_select' class='tbox' onchange='this.form.submit()'>
<option value='0' " .
($classy_selclass == $classy_row['userclass_name']?"selected='selected'":"") . ">" . CLASSY_6 . "</option>";
$sql->db_Select("userclass_classes", "*", "order by userclass_name", "nowhere");

while ($classy_row = $sql->db_Fetch())
{
    $classy_text .= "<option value='" . $classy_row['userclass_id'] . "'" .
    ($classy_selclass == $classy_row['userclass_id']?" selected='selected'":"") . "
	>" . $classy_row['userclass_name'] . "</option>";
}
$classy_text .= "</select>
</div>
<div class='forumheader3'><ul>";
if ($sql->db_Select("user", "*", "find_in_set('" . $classy_selclass . "',user_class)"))
{
    while ($classy_member = $sql->db_Fetch())
    {
        $classy_text .= "<li><a href='".SITEURL."user.php?id.".$classy_member['user_id']."'>" . $classy_member['user_name'] . "</a></li>";
    }
}
else
{
    $classy_text .= "<li>".CLASSY_7."</li>";
}
$classy_text .= "</ul></div></div>
</form>";
$ns->tablerender(CLASSY_1, $classy_text);
require_once(FOOTERF);

?>