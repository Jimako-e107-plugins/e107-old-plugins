
global $sql, $post_info, $tp, $gold_obj,$gorb_obj;
if (isset($gold_obj) && isset($gorb_obj) && $gold_obj->plugin_active('gold_orb'))
{
    // gold and orb active
    if ($post_info['user_name'])
    {
        $gold_obj->load_gold($post_info['user_id']);
        return '<a href="' . e_BASE . 'user.php?id.' . $post_info['user_id'] . ' ">' . $gorb_obj->show_orb($post_info['user_id']) . '</a>';
    }
    else
    {
        $x = explode(chr(1), $post_info['thread_user']);
        $tmp = explode('.', $x[0], 2);
        if (!$tmp[1])
        {
            return FORLAN_103;
        }
        else
        {
            return '<b>' . $tp->toHTML($tmp[1]) . '</b>';
        }
    }
}
else
{
    // gold and orb plugin inactive
    if (!empty($post_info['user_name']))
    {
        return '<a href="' . e_BASE . 'user.php?id.' . $post_info['user_id'] . ' ">' . $post_info['user_name'] . '</a>';
    }
    else
    {
        $x = explode(chr(1), $post_info['thread_user']);
        $tmp = explode('.', $x[0], 2);
        if (!$tmp[1])
        {
            return FORLAN_103;
        }
        else
        {
            return '<b>' . $tp->toHTML($tmp[1]) . '</b>';
        }
    }
}
