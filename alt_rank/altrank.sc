parse_str($parm);
global $post_info, $user;

$class_1 = 1;
	$class_1_pic = " <img src='".e_PLUGIN."alt_rank/ranks/1.gif' alt='".ALTRANK_01."' title='".ALTRANK_01."' />";
$class_2 = 2;
	$class_2_pic = " <img src='".e_PLUGIN."alt_rank/ranks/2.gif' alt='".ALTRANK_02."' title='".ALTRANK_02."' />";
$class_3 = 3;
	$class_c3_pic = " <img src='".e_PLUGIN."alt_rank/ranks/3.gif' alt='".ALTRANK_03."' title='".ALTRANK_03."' />";
$class_4 = 4;
	$class_4_pic = " <img src='".e_PLUGIN."alt_rank/ranks/4.gif' alt='".ALTRANK_04."' title='".ALTRANK_04."' />";
$class_5 = 5;
	$class_5_pic = " <img src='".e_PLUGIN."alt_rank/ranks/5.gif' alt='".ALTRANK_05."' title='".ALTRANK_05."' />";
$class_6 = 6;
	$class_6_pic = " <img src='".e_PLUGIN."alt_rank/ranks/6.gif' alt='".ALTRANK_06."' title='".ALTRANK_06."' />";
$class_7 = 7;
	$class_7_pic = " <img src='".e_PLUGIN."alt_rank/ranks/7.gif' alt='".ALTRANK_07."' title='".ALTRANK_07."' />";
$class_8 = 8;
	$class_8_pic = " <img src='".e_PLUGIN."alt_rank/ranks/8.gif' alt='".ALTRANK_08."' title='".ALTRANK_08."' />";
$class_9 = 9;
	$class_9_pic = " <img src='".e_PLUGIN."alt_rank/ranks/9.gif' alt='".ALTRANK_09."' title='".ALTRANK_09."' />";
$class_10 = 10;
	$class_10_pic = " <img src='".e_PLUGIN."alt_rank/ranks/10.gif' alt='".ALTRANK_10."' title='".ALTRANK_10."' />";


if(check_class($class_1, $post_info['user_class'], TRUE) || check_class($class_1, $user['user_class'], TRUE))
{
	$output .= $class_1_pic;
}
if(check_class($class_2, $post_info['user_class'], TRUE) || check_class($class_2, $user['user_class'], TRUE))
{
	$output .= $class_2_pic;
}
if(check_class($class_3, $post_info['user_class'], TRUE) || check_class($class_3, $user['user_class'], TRUE))
{
	$output .= $class_3_pic;
}
if(check_class($class_4, $post_info['user_class'], TRUE) || check_class($class_4, $user['user_class'], TRUE))
{
	$output .= $class_4_pic;
}
if(check_class($class_5, $post_info['user_class'], TRUE) || check_class($class_5, $user['user_class'], TRUE))
{
	$output .= $class_5_pic;
}
if(check_class($class_6, $post_info['user_class'], TRUE) || check_class($class_6, $user['user_class'], TRUE))
{
	$output .= $class_6_pic;
}
if(check_class($class_7, $post_info['user_class'], TRUE) || check_class($class_7, $user['user_class'], TRUE))
{
	$output .= $class_7_pic;
}
if(check_class($class_8, $post_info['user_class'], TRUE) || check_class($class_8, $user['user_class'], TRUE))
{
	$output .= $class_8_pic;
}
if(check_class($class_9, $post_info['user_class'], TRUE) || check_class($class_9, $user['user_class'], TRUE))
{
	$output .= $class_9_pic;
}
if(check_class($class_10, $post_info['user_class'], TRUE) || check_class($class_10, $user['user_class'], TRUE))
{
	$output .= $class_10_pic;
}

return $output;