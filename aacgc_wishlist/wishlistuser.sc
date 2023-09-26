global $sql,$sql2,$user; 

$suser = "";
$USER_ID = "";

include_lan(e_PLUGIN."aacgc_wishlist/languages/".e_LANGUAGE.".php");

$url = $_SERVER["REQUEST_URI"];
$suser = explode(".", $url);
	if ($suser[1] == 'php?id') {
	$suser = $suser[2];
	}
$SUSER_ID = $suser;

if (USER){


//----------------------------------------------------------------

if ($pref['wishlist_enable_profile'] == "1"){


$sql->db_Select("aacgc_wishlist", "*", "WHERE list_user_id='".$SUSER_ID."'", "");
$row = $sql->db_Fetch();


$wishlist .= "   <tr>
		<td colspan='2' class='forumheader' style='text-align:left'><b>".WL_17.":</b></td>
		</tr>";

if ($row['list_itema'] == ""){}
else
{$wishlist .= "	<tr>
          	<td colspan='2' class='indent' style='text-align:left'>1. <a href='".$row['list_itema_link']."' target='_blank'>".$row['list_itema']."</a></td>
          	</tr>";}

if ($row['list_itemb'] == ""){}
else
{$wishlist .= "	<tr>
	        <td colspan='2' class='indent' style='text-align:left'>2. <a href='".$row['list_itemb_link']."' target='_blank'>".$row['list_itemb']."</a></td>
        	</tr>";}

if ($row['list_itemc'] == ""){}
else
{$wishlist .= "	<tr>
		<td colspan='2' class='indent' style='text-align:left'>3. <a href='".$row['list_itemc_link']."' target='_blank'>".$row['list_itemc']."</a></td>
		</tr>";}

if ($row['list_itemd'] == ""){}
else
{$wishlist .= "	<tr>
		<td colspan='2' class='indent' style='text-align:left'>4. <a href='".$row['list_itemd_link']."' target='_blank'>".$row['list_itemd']."</a></td>
		</tr>";}

if ($row['list_iteme'] == ""){}
else
{$wishlist .= "	<tr>
		<td colspan='2' class='indent' style='text-align:left'>5. <a href='".$row['list_iteme_link']."' target='_blank'>".$row['list_iteme']."</a></td>
		</tr>";}

if ($row['list_itemf'] == ""){}
else
{$wishlist .= "	<tr>
		<td colspan='2' class='indent' style='text-align:left'>6. <a href='".$row['list_itemf_link']."' target='_blank'>".$row['list_itemf']."</a></td>
		</tr>";}

if ($row['list_itemg'] == ""){}
else
{$wishlist .= "	<tr>
		<td colspan='2' class='indent' style='text-align:left'>7. <a href='".$row['list_itemg_link']."' target='_blank'>".$row['list_itemg']."</a></td>
		</tr>";}

if ($row['list_itemh'] == ""){}
else
{$wishlist .= "	<tr>
		<td colspan='2' class='indent' style='text-align:left'>8. <a href='".$row['list_itemh_link']."' target='_blank'>".$row['list_itemh']."</a></td>
		</tr>";}

if ($row['list_itemi'] == ""){}
else
{$wishlist .= "	<tr>
		<td colspan='2' class='indent' style='text-align:left'>9. <a href='".$row['list_itemi_link']."' target='_blank'>".$row['list_itemi']."</a></td>
		</tr>";}

if ($row['list_itemj'] == ""){}
else
{$wishlist .= "	<tr>
		<td colspan='2' class='indent' style='text-align:left'>10. <a href='".$row['list_itemj_link']."' target='_blank'>".$row['list_itemj']."</a></td>
		</tr>";}

if ($row['list_other'] == ""){}
else
{$wishlist .= "	<tr>
		<td colspan='2' class='indent' style='text-align:left'>".WL_19.": <a href='".$row['list_other_link']."' target='_blank'>".$row['list_other']."</a></td>
		</tr>";}


return "".$wishlist."";}}