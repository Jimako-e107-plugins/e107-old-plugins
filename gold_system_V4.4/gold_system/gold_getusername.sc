// ***************************************************************************
// Parameters
// $parm[0] : field name & id
// $parm[1] : number of letters before lookup
// $parm[2] : userid to populate the field (default blank name)
global $PLUGINS_DIRECTORY,$gold_obj,$GOLD_PREF,$gold_buyfor,$gold_sql,$tp;

$tmp=explode(',',$parm);
if (isset($gold_obj))
{
	if($tmp[1]>0)
	{
		$gold_numchars=$tmp[1];
	}
	elseif(intval($GOLD_PREF['gold_numchar'])>0)
	{
		$gold_numchars=$GOLD_PREF['gold_numchar'];
	}
	else
	{
		$gold_numchars=2;
	}
	$gold_uname='';
	if( $gold_buyfor > 0 || intval($tmp[2]) > 0)
	{
		if(intval($gold_buyfor)==0)
		{
			$gold_buyfor=intval($tmp[2]);
		}
		if($gold_buyfor !=USERID)
		{
			// can not buy for self
			if($gold_sql->db_Select('user','user_name','where user_id='.$gold_buyfor,'nowhere',false))
			{
				extract($gold_sql->db_Fetch());
				$gold_uname=$tp->toFORM($user_name);
			}
		}
	}

return '
<script type="text/javascript">
var ajaxBox_offsetX = 0;
var ajaxBox_offsetY =0;
var ajax_list_externalFile = \''.SITEURL.$PLUGINS_DIRECTORY.'gold_system/getusername.php\'; // Path to external file
var minimumLettersBeforeLookup = '.$gold_numchars.'; // Number of letters entered before a lookup is performed.
	</script>

		<input type="text"  onmouseover="showToolTip(event,\''.LAN_GS_ACTION08.'\');return true" onmouseout="hideToolTip()" id="'.$tmp[0].'" name="'.$tmp[0].'" class="tbox" value="'.$gold_uname.'" onkeyup="ajax_showOptions(this,\'\',event)" />
';
}
else
{
	return "";
}