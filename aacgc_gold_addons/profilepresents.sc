if ($pref['goldaddon_enable_profilepresents'] == "1"){

global $sql, $gpresent, $PLUGINS_DIRECTORY,$tp;

$gpressy_parmlist = explode(',', $parm);


if (intval($gpressy_parmlist[0]) == 0)
{$gpressy_userid = USERID;}

else

{$gpressy_userid = intval($gpressy_parmlist[0]);}


    $tmp = explode('.', e_QUERY);
    $gpressy_userid = intval($tmp[1]);
    require_once(e_HANDLER . 'file_class.php');
    $gpressy_fclass = new e_file;
    $gpressy_omit = array('^\.$', '^\.\.$', '^\/$', '^CVS$', 'thumbs\.db', '.*\._$', '^\.htaccess$', 'index\.html', 'null\.txt', '\.LCK');

    $gpressy_list = $gpressy_fclass->get_files(e_PLUGIN . 'gold_present/presents/', 'present.php', $gpressy_omit, 1);

    foreach($gpressy_list as $gpressy_presentmain)
    {require($gpressy_presentmain['path'] . '/' . $gpressy_presentmain['fname']);}


require_once(e_HANDLER . 'date_handler.php');
$gpressy_conv = new CONVERT;

$sql->mySQLresult = @mysql_query("select gpressy_recipient_id, count(gpressy_present) as presents from ".MPREFIX."gold_present where gpressy_recipient_id= $gpressy_userid;");
$prescount = $sql->db_fetch();

if(intval($gpressy_parmlist[1])==0)
{$grpressy_initial = 0;}

else

{$grpressy_initial = intval($gpressy_parmlist[1])-1;}

switch (intval($gpressy_parmlist[2]))
{
    case 16:
        $gpressy_icon = 'icon_16';
        break;
    case 64:
        $gpressy_icon = 'icon_64';
        break;
    default:
        $gpressy_icon = 'icon_32';
        break;
}

if (intval($gpressy_parmlist[3]) == 0)
{$gpressy_numrow = 16;}

else

{$gpressy_numrow = intval($gpressy_parmlist[3]);}

if (intval($gpressy_parmlist[4]) == 0)
{$gpressy_quant = 32768;}

else

{$gpressy_quant = intval($gpressy_parmlist[4]);}


$gpressy_arg = 'select gp.*,u.user_name from #gold_present as gp left join #user as u on gpressy_sender_id=user_id where gpressy_recipient_id=' . $gpressy_userid . ' order by gpressy_sent desc limit ' . $grpressy_initial.','.$gpressy_quant ;

if($sql->db_Select_gen($gpressy_arg, false))
{

	$gpressy_count = 0;
	$gpressy_list='';
	while ($gpressy_row = $sql->db_Fetch())
	{
	    $gpressy_count++;
	    $gpressy_present = $gpressy_row['gpressy_present'];
	    if(!empty($gpressy_present) && is_readable(e_PLUGIN.'gold_present/presents/'.$gpressy_present.'/present.php'))
		{
		require(e_PLUGIN.'gold_present/presents/'.$gpressy_present.'/present.php');
	    $gpressy_imagesrc = SITEURL . $PLUGINS_DIRECTORY . 'gold_present/presents/' . $gpressy_present . '/' . $gpresent[$gpressy_present][$gpressy_icon];
	    $gpressy_title = htmlentities('<b>' . $tp->toJS($gpresent[$gpressy_present]['title']) . '</b><br />' . $tp->toJS($gpresent[$gpressy_present]['description']));
	    if ($gpressy_userid == USERID)
	    {
	        // users looking at own
	        $gpressy_title .= htmlentities('<br /><br /><i>' . $tp->toJS($gpressy_row['user_name']) . ' ' . GOLD_PRESSY_129 . ' ' . $gpressy_conv->convert_date($gpressy_row['gpressy_sent'], 'short') . '</i><br/>' . $tp->toJS($gpressy_row['gpressy_comment']));
	    }
	    $gpressy_list .= '<span class="tooltip_text"  onmouseover="showToolTip(event,\''.$gpressy_title.'\');return false" onmouseout="hideToolTip()"><img src="'.$gpressy_imagesrc.'" style="border:0px" alt="'.$gpresent[$gpressy_present]['title'].'" title="'.$gpresent[$gpressy_present]['title'].'" />&nbsp;</span>';
	    if ($gpressy_count >= $gpressy_numrow)
	    {
	        $gpressy_count = 0;
	        $gpressy_list .= '<br />';
	    }}}

return "<tr>
<td colspan='2' class='forumheader' style='text-align:left'><b>Presents:</b> ".$prescount['presents']."</td>
</tr><tr>
<td colspan='2' class='forumheader3'>".$gpressy_list."</td>
</tr>";}
else
{return '';}


}