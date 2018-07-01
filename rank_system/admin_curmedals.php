<?php
/**
 * $Id: admin_curmedals.php,v 1.3 2009/07/14 19:29:03 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Revision: $Revision: 1.3 $
 * Last Modified: $Date: 2009/07/14 19:29:03 $
 *
 * Change Log:
 * $Log: admin_curmedals.php,v $
 * Revision 1.3  2009/07/14 19:29:03  michiel
 * CVS Merge
 *
 * Revision 1.2.6.1  2009/07/12 12:39:42  michiel
 * MERGE Maint1.3->Dev1.4
 *
 * Revision 1.2.8.1  2009/07/12 11:44:17  michiel
 * Show list of changes after revalidate all
 *
 * Revision 1.2  2009/06/26 09:21:19  michiel
 * *** empty log message ***
 *
 * Revision 1.1.2.1  2009/06/19 13:47:18  michiel
 * Made XHTML compliant
 *
 * Revision 1.1  2009/03/28 13:01:38  michiel
 * Initial CVS revision
 *
 *  
 */
require_once('../../class2.php');
if (!defined('e107_INIT'))
{
    exit;
}
if (!getperms('P'))
{
    header('location:' . e_HTTP . 'index.php');
    exit;
}

require_once(e_ADMIN . 'auth.php');
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, 'width:100%;');
}
include_lan(e_PLUGIN . 'rank_system/languages/admin/' . e_LANGUAGE . '.php');
include_lan(e_PLUGIN . 'rank_system/languages/' . e_LANGUAGE . '.php');

global $RANK_PREF;
$readonly = (getperms('0') || check_class($RANK_PREF['rank_plugclass']) ? false : true);

require_once(e_PLUGIN . 'rank_system/includes/medal_class.php');
global $medal_obj;
if (!$medal_obj) {
	$medal_obj = new medal;
}
$medal_from = 0;

if (
	isset($_POST['save_grant']) 
	|| isset($_POST['save_remark']) 
	|| isset($_POST['medal_filter']) 
	|| isset($_POST['revoke']) 
	|| isset($_POST['grant']) 
	|| isset($_POST['remark']) 
	|| isset($_POST['revalidate'])) {
    $medal_from = intval($_POST['medal_from']);
    $medal_uid = intval($_POST['medal_uid']);
    $medal_action = $_POST['medal_action'];
} else if (isset($_POST['edit']) ) {
    $medal_from = intval($_POST['medal_from']);
    $medal_uid = intval($_POST['medal_uid']);
    $medal_action = 'edit';
} else {
    $medal_tmp = explode('.', e_QUERY);
    $medal_from = intval($medal_tmp[0]);
    $medal_action = $medal_tmp[1];
    $medal_uid = intval($medal_tmp[2]);
}

if(isset($_POST['revoke']))
{
	$tmp = array_keys($_POST['revoke']);
	list($revoke, $rev_id) = explode("_", $tmp[0]);
}

if ($revoke == "medal" && $rev_id) {
	$medal_obj->revokeMedalIndex($rev_id);
	$medal_msg = ADLAN_RS_MD14;
	unset($revoke, $rev_id);
	$medal_action = 'edit';
}

if(isset($_POST['grant']))
{
	$tmp = array_keys($_POST['grant']);
	list($grant, $grant_id) = explode("_", $tmp[0]);
}

if(isset($_POST['remark']))
{
	$tmp = array_keys($_POST['remark']);
	list($remark, $remark_id) = explode("_", $tmp[0]);
}


if ($medal_action == 'save_grant') {
	$grant_id = $_POST['grant_id'];
	$remarks = $tp->toDB($_POST['med_user_remarks']);
	if ($grant_id > 0) {
		$medal_obj->grantMedal($grant_id, $medal_uid, $remarks);
		$medal_msg = ADLAN_RS_MD15;
	}
	unset($grant, $grant_id);
	$medal_action = 'edit';
}

if ($grant == "medal" && $grant_id) {
	
    $medal_text = '
	<form method="post" action="' . e_SELF . '" id="medal_form" >
		<div>
			<input type="hidden" name="medal_from" value="' . $medal_from . '" />
			<input type="hidden" name="medal_uid" value="' . $medal_uid . '" />
			<input type="hidden" name="user_name" value="' . $user_name . '" />
			<input type="hidden" name="grant_id" value="' . $grant_id . '" />
			<input type="hidden" name="medal_action" value="save_grant" />
		</div>
	 	<table class="fborder" style="' . ADMIN_WIDTH . '">
	 		<tr>
	 			<td class="fcaption" colspan="2" style="text-align:left">' . ADLAN_RS_MD17 . ' </td>
	 		</tr>

	 		<tr>
	 			<td class="forumheader2" style="width:30%;text-align:center;" >' . ADLAN_RS_MD16 . '</td>
 				<td class="forumheader2" style="width:70%">
					<textarea class="tbox" rows="4" cols="60" style="width:80%" name="med_user_remarks" ></textarea>
				</td>
			</tr>
	 		
			<tr><td colspan=2>&nbsp;</td></tr>
		<td class="forumheader2" colspan="2" style="text-align:center">
			<input type="submit" class="button" name="save_grant" value="' . ADLAN_RS_MD17 . '" />
			<input type="submit" class="button" name="edit" value="' . ADLAN_RS_MD18 . '" />
		</td>
    
	 	</table>
	</form>';
}

if ($medal_action == 'save_remark') {
	$remark_id = $_POST['remark_id'];
	$remarks = $tp->toDB($_POST['med_user_remarks']);
	if ($remark_id > 0) {
		global $sql;
		
		if ($sql->db_Update("rank_medal_users", "med_user_remarks='".$remarks."' where med_user_index = $remark_id")) {
			$medal_msg = ADLAN_RS_MD20;
		}
	}
	$medal_action = 'edit';
}


if ($remark == "medal" && $remark_id) {
	
	global $sql;
	if ($sql->db_Select("rank_medal_users", "med_user_remarks", "med_user_index = $remark_id")) {
		$row = $sql->db_Fetch();
		
	    $medal_text = '
		<form method="post" action="' . e_SELF . '" id="medal_form" >
			<div>
				<input type="hidden" name="medal_from" value="' . $medal_from . '" />
				<input type="hidden" name="medal_uid" value="' . $medal_uid . '" />
				<input type="hidden" name="user_name" value="' . $user_name . '" />
				<input type="hidden" name="remark_id" value="' . $remark_id . '" />
				<input type="hidden" name="medal_action" value="save_remark" />
			</div>
		 	<table class="fborder" style="' . ADMIN_WIDTH . '">
		 		<tr>
		 			<td class="fcaption" colspan="2" style="text-align:left">' . ADLAN_RS_MD17 . ' </td>
		 		</tr>
	
		 		<tr>
		 			<td class="forumheader2" style="width:30%;text-align:center;" >' . ADLAN_RS_MD16 . '</td>
	 				<td class="forumheader2" style="width:70%">
						<textarea class="tbox" rows="4" cols="60" style="width:80%" name="med_user_remarks" >' . $tp->toForm($row['med_user_remarks']). '</textarea>
					</td>
				</tr>
		 		
				<tr><td colspan="2">&nbsp;</td></tr>
			<td class="forumheader2" colspan="2" style="text-align:center">
				<input type="submit" class="button" name="save_remark" value="' . ADLAN_RS_MD17 . '" />
				<input type="submit" class="button" name="edit" value="' . ADLAN_RS_MD18 . '" />
			</td>
	    
		 	</table>
		</form>';
	} 
}


if (isset($_POST['medal_user']))
{
    $medal_user = '%' . $_POST['medal_user'] . '%';
}
else
{
    $medal_user = '%';
}

if (isset($_POST['revalidate'])) {
	$grants = $medal_obj->validateAll();
	if (isset($grants) && count($grants) > 0) {
		$box = "
			<input class='button' type ='button' style='cursor:pointer' value='".ADLAN_RS_MD22."' onclick='expandit(this)' />
			<div id='validatelst' style='display:none;' >
			<table class='fborder' style='width:100%'>
			<tr>
				<td class='fcaption' style='text-align:center;width:40%'>".ADLAN_RS_MD23."</td> 
				<td class='fcaption' style='text-align:center;width:60%'>".ADLAN_RS_MD24."</td>
			</tr>
		";
		
		while (list($user_id, $granted) = each($grants)) {
			$sql->db_Select("user", "user_name", "user_id = $user_id");
			$row = $sql->db_Fetch();
			$user_name = $row['user_name'];
			$box .= "
				<tr>
				<td class='forumheader2' style='text-align:left'>
					<a href='/user.php?id.$user_id'>$user_name</a>
				</td>
				<td class='forumheader2' style='text-align:left'>
			";
			$isFirst = true;
			while (list($key, $medal_id) = each($granted)) {
				if ($sql->db_Select("rank_medals", "medal_name", "medal_id = $medal_id")) {
					$row = $sql->db_Fetch();
					if ($isFirst) {
						$isFirst = false;
					} else {
						$box .= "<br/>";
					}
					$box .= $tp->toHTML($row['medal_name']);
				}
			}
			$box .= "</td></tr>";
		}
		$box .= "</table></div>";
	} else {
		$box = "<br/>".ADLAN_RS_MD21;
	}
	
	$medal_msg = ADLAN_RS_MD01.$box;
	$medal_action = "show";
}

if ($medal_action == 'edit') {
    $sql->db_Select("user", "user_name", "user_id=".$medal_uid);
    extract($sql->db_Fetch());

    $medal_text = '
<form method="post" action="' . e_SELF . '" id="medal_form" >
	<div>
		<input type="hidden" name="medal_from" value="' . $medal_from . '" />
		<input type="hidden" name="medal_uid" value="' . $medal_uid . '" />
		<input type="hidden" name="user_name" value="' . $user_name . '" />
		<input type="hidden" name="medal_action" value="save" />
	</div>
 	<table class="fborder" style="' . ADMIN_WIDTH . '">
 		<tr>
 			<td class="fcaption" colspan="5" style="text-align:left">' . ADLAN_RS_MD10 . ' ['.$user_name.']</td>
 		</tr>
 		<tr>
 			<td class="forumheader2" colspan="5" style="text-align:center"><b>' . $medal_msg . '</b>&nbsp;</td>
 		</tr>
    
    	<tr>
    		<td class="forumheader2" style="width:20%;text-align:center;" >' . ADLAN_RS_MDF26 . '</td>
    		<td class="forumheader2" style="width:25%;text-align:center;" >' . ADLAN_RS_MDF11 . '</td>
    		<td class="forumheader2" style="width:25%;text-align:center;" >' . ADLAN_RS_MD16 . '</td>
    		<td class="forumheader2" style="width:20%;text-align:center;" >' . ADLAN_RS_MD11 . '</td>
    		<td class="forumheader2" style="width:10%;text-align:center;" >' . ADLAN_RS_MD05 . '</td>
    	</tr>';
 		
    $sql->db_Select("rank_medals","*","1=1 order by medal_type, medal_order");
    $medList = $sql->db_getList();
	foreach($medList as $med_row) {
		extract($med_row);
		
		$medal_text .= '
    	<tr>
    		<td class="forumheader2" style="text-align:center;" >' . ($medal_type == 0 ? ADLAN_RS_MDF31 : ADLAN_RS_MDF15) . '</td>
    		<td class="forumheader2" style="text-align:center;" >' . $medal_name . '</td>';
		
		$index = $medal_obj->userHasMedal($medal_id, $medal_uid);
		if ($index > 0) {
			$sql->db_Select("rank_medal_users", "med_user_date, med_user_remarks", "med_user_index=".$index);
			$row = $sql->db_Fetch();
			$medal_text .= "
			<td class='forumheader2' style='text-align:center;' >" . $tp->toHTML($row['med_user_remarks']) . "</td>
			<td class='forumheader2' style='text-align:center;' >" .
				date("d M Y", $row['med_user_date'])."</td>
				<td class='forumheader2' style='text-align:center;' >
				<input type='image' title='".ADLAN_RS_MD19."' name='remark[medal_{$index}]' src='".ADMIN_EDIT_ICON_PATH."'/>
				<input type='image' title='".ADLAN_RS_MD13."' name='revoke[medal_{$index}]' src='".ADMIN_DELETE_ICON_PATH."'/>
			";
		} else {
			$medal_text .= "
			<td class='forumheader2' style='text-align:center;' >&nbsp;</td>
			<td class='forumheader2' style='text-align:center;' >&nbsp;</td>
				<td class='forumheader2' style='text-align:center;' >
				<input type='image' title='".ADLAN_RS_MD12."' name='grant[medal_{$medal_id}]' src='".e_PLUGIN."rank_system/images/add.gif'/>
			";
		}
		
    	$medal_text .= '</td></tr>';
		
	}

	$medal_text .= '
		<tr><td colspan="5">&nbsp;</td></tr>';
	
	$prev = '';
	$next = '';
	
	if ($sql->db_Select("user", "user_id, user_name", "user_id < $medal_uid order by user_id desc")) {
		$row = $sql->db_Fetch();
		$prev = '<- [<a href="' . e_SELF . '?' . $medal_from . '.edit.' . $row['user_id'] . '" >'.$row['user_name'].'</a>]';
	}
	if ($sql->db_Select("user", "user_id, user_name", "user_id > $medal_uid order by user_id")) {
		$row = $sql->db_Fetch();
		$next = '[<a href="' . e_SELF . '?' . $medal_from . '.edit.' . $row['user_id'] . '" >'.$row['user_name'].'</a>] ->';
	}
	$medal_text .= '
	<tr><td colspan="5">
		<table border="0" style="' . ADMIN_WIDTH . '"><tr border="0">
			<td class="forumheader2" style="border:0;width:50%;text-align:left;">'.$prev.'</td>	
			<td class="forumheader2" style="border:0;width:50%;text-align:right;">'.$next.'</td>
	</tr></table></td></tr> 		
 	</table>
</form>';
}

if ($medal_action == '' || $medal_action == 'show') {
	$medal_arg = "select count(user_id) medal_count from #user where user_name like '{$medal_user}'";
    $sql->db_Select_gen($medal_arg, false);
    extract($sql->db_Fetch());

    $medal_text = '
<form method="post" action="' . e_SELF . '" id="medal_form" >
	<div>
		<input type="hidden" name="medal_from" value="' . $medal_from . '" />
	</div>
	<table class="fborder" style="' . ADMIN_WIDTH . '">
		<tr>
			<td class="fcaption" colspan="5" style="text-align:left">' . ADLAN_RS_MD02 . '</td>
		</tr>
		<tr>
			<td class="forumheader2" colspan="5" style="text-align:center"><b>' . $medal_msg . '</b>&nbsp;</td>
		</tr>
		<tr>
			<td class="forumheader2" style="width:2%;text-align:center;" >' . ADLAN_RS_MD03 . '</td>
			<td class="forumheader2" style="width:15%;text-align:center;">' . ADLAN_RS_MD04 . '</td>
			<td class="forumheader2" style="width:28%;text-align:center;">' . ADLAN_RS_MDF5 . '</td>
			<td class="forumheader2" style="width:50%;text-align:center;">' . ADLAN_RS_MDF4 . '</td>
			<td class="forumheader2" style="width:5%;text-align:center;">&nbsp;</td>
		</tr>	';

    $medal_arg = "select user_name, user_id from #user where user_name like '{$medal_user}' order by user_id limit $medal_from,10";
    $sql->db_Select_gen($medal_arg, false);
    $usrList = $sql->db_getList();
	foreach($usrList as $usr_row) {
    	$medals = $medal_obj->getMedals($usr_row['user_id']);
        $displayed[0] = 0;
        $displayed[1] = 0;
        $data[0] = "";
        $data[1] = "";

        for ($loop = 1; $loop <= $medals['count']; $loop++) {
        	$group=$medals[$loop]['type'];
        	
       		if ($displayed[$group] %4 == 0) {
       			$data[$group] .= "<br />";
       		}
       		$data[$group] .= ' '.$medal_obj->createImage($medals[$loop]['image'], $medals[$loop]['name'], $medals[$loop]['date'], 50);
       		$displayed[$group]++;
        }

        $medal_text .= '
		<tr>
			<td class="forumheader3" style="text-align:right;" >' . $usr_row['user_id'] . '</td>
			<td class="forumheader3" style="text-align:left;" >
				<a href="/user.php?id.'. $usr_row['user_id'] . '">' . $usr_row['user_name'] . '</a>
			</td>
			<td class="forumheader3" style="text-align:center;" >' . $data[0] . '</td>
			<td class="forumheader3" style="text-align:center;" >' . $data[1] . '</td>
			
			<td class="forumheader3" style="text-align:center;" >';
        	
        	if (!$readonly) {
        		$medal_text .= '<a href="' . e_SELF . '?' . $medal_from . '.edit.' . $usr_row['user_id'] . '" ><img src="' . e_IMAGE . 'admin_images/edit_16.png" alt="' . ADLAN_RS_MD06 . '" title="' . ADLAN_GS_MD06 . '" /></a>';
        	}
        	$medal_text .= '
			</td>
		</tr>';
    }
    
    $action = 'show';
    $parms = $medal_count . ',10,' . $medal_from . ',' . e_SELF . '?' . '[FROM].' . $action;
    $medal_nextprev = $tp->parseTemplate("{NEXTPREV={$parms}}") . '';

    $medal_text .= '
		<tr>
			<td class="forumheader2" colspan="5" style="text-align:center">' . ADLAN_RS_MD07 . '&nbsp;
				<input type="text" class="tbox" style="width:140px;" name="medal_user" value="' . $_POST['medal_user'] . '" /> &nbsp;&nbsp;
				<input type="submit" class="button" name="medal_update" value="' . ADLAN_RS_MD08 . '" /></td>
		</tr>
	<tr>
		<td class="forumheader2" colspan="5" style="text-align:left">' . $medal_nextprev . '&nbsp;</td>
	</tr>
 	<tr>
		<td class="forumheader2" colspan="5" style="text-align:left">
			<input type="submit" class="button" name="revalidate" value="' . ADLAN_RS_MD09 . '" />
		</td>
	</tr>
	
	<tr>
		<td class="fcaption" colspan="5" style="text-align:left">&nbsp;</td>
	</tr>
	</table>
</form>';
    
}
$ns->tablerender(ADLAN_RS, $medal_text);
require_once(e_ADMIN . 'footer.php');

?>