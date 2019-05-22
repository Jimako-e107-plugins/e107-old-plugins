<?php
/*
+---------------------------------------------------------------+
|        Inbox Email - v 2 by Mohamed Anouar Achoukhy
|        only for e107 website system
|        http://e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

require_once("../../class2.php");
if(!getperms("P")) {
	header("location:".e_BASE."index.php"); exit;
}

require_once(e_HANDLER."calendar/calendar_class.php");
$cal = new DHTML_Calendar(true);
function headerjs(){
	global $cal;
	$js = $cal->load_files();
	return $js;
}

require_once(e_ADMIN."auth.php");
require_once(e_HANDLER.'userclass_class.php');
require_once(e_HANDLER.'form_handler.php');

$rs = new form;
$aj = new textparse;
$cit = new contact;

include_lan(e_PLUGIN."contact/languages/".e_LANGUAGE.".php");


if (e_QUERY) {
	$tmp = explode('.', e_QUERY);
	$action = $tmp[0];
	$sub_action = $tmp[1];
	$id = $tmp[2];
	unset($tmp);
}

// DB --------------------------------------------------------------------------------------------------------------------------------

if (isset($_POST['create'])) {
	$sql->db_Insert("contact", "0, '".$_POST['contact_body']."', '".$_POST['contact_author_name']."',  '".$_POST['contact_time']."', '".$_POST['contact_subject']."', '0'");

	$cit->show_message(LAN_CONTACT_31);
}
if (isset($_POST['send'])) {

	require_once(e_HANDLER."mail.php");

	if (!sendemail($_POST['contact_email_send'],$_POST['contact_subject'],$_POST['contact_body'],ADMIN,SITEADMINEMAIL,$_POST['contact_author_name']))
		$cit->show_message(LAN_CONTACT_36);
	else
		$cit->show_message(LAN_CONTACT_31);
	
}

if ((isset($_POST['update'])) && ($_POST['contact_id'])) {
	$sql->db_Update("contact", "contact_mod='0' WHERE contact_id='".$_POST['contact_id']."'");

	$cit->show_message(LAN_CONTACT_32);
}

// if ((isset($_POST['reply'])) && ($_POST['contact_id'])) {

	// $cit->show_message(LAN_CONTACT_32);
// }

foreach(array_keys($_POST) as $k)
{
	if (preg_match("#(.*?)_(\d+)(.*)#", $k, $matches))
	{
		$post_del = $matches[1];
		$del_id = $matches[2];
	}
}

if ($post_del == 'delete'){
	$sql->db_Delete("contact", "contact_id='".$del_id."'");
	$cit->show_message(LAN_CONTACT_33);
}

if (isset($_POST['updatesettings'])) {
	$pref['contact_caption'] = $_POST['contact_caption'];
	$pref['contact_delay'] = $_POST['contact_delay'];
	$pref['contact_mod'] = $_POST['contact_mod'];
	$pref['contact_plugin_enable'] = $_POST['contact_plugin_enable'];

	save_prefs();
	$cit->show_message(LAN_CONTACT_35);
	$action = "pref";
}


// Display admin main page -----------------------------------------------------------------------------------------------------------
$text = $rs->form_open("post", e_SELF, "postcontact", "", "");
$text .= "
<div style='text-align:center'>
	<table class='fborder' style='width:100%'>
		<tbody>";
			switch ($action) 
			{
				case '':
					if(!$sql -> db_Select("contact", "*", "contact_time ORDER BY contact_mod DESC")) 
					{
						$text .= "<tr><td>".LAN_CONTACT_13."</td></tr>";
					} else 
					{
						$text .= "
						<tr>
						<td class='fcaption' style='width:20%'>".LAN_CONTACT_42."</td>
						<td class='fcaption' style='width:20%'>".LAN_CONTACT_41."</td>
						<td class='fcaption' style='width:10%'>".LAN_CONTACT_43."</td>
						<td class='fcaption' style='width:3%'>".LAN_CONTACT_40."</td>		
						<td class='fcaption' style='width:3%'>".LAN_CONTACT_19."</td>
						<td class='fcaption' style='width:3%'>".LAN_CONTACT_18."</td>
						<td class='fcaption' style='width:3%'>".LAN_CONTACT_27."</td>
						</tr>";

						$i = 1;
						while($row = $sql -> db_Fetch()) 
						{
							extract($row);

							if($contact_mod == 1) 
							{
								$lp = "<font style='color:red;font-weight:bold'>".LAN_CONTACT_28."</font>";
								$icono = E_16_NOTIFY;
								$i = 0;
							} else 
							{
								$lp = ADMIN_TRUE_ICON;
								$icono = E_16_MAIL;								
							}
							//$contact_body = substr($contact_body, 0, 42)."...";
							$text .= "<tr>
							<td class='forumheader'>".$contact_subject."</td>
							<td class='forumheader'><a  href='mailto:".$contact_email_send."' >".$contact_author_name ."</a></td>
							<td class='forumheader'>".$contact_time."</td>
							<td class='forumheader'>".$lp."</td>			
							<td class='forumheader'><a href='".e_SELF."?message.show.{$contact_id}' title='".LAN_CONTACT_19."'>".$icono ."</a></td>
							<td class='forumheader'><a href='".e_SELF."?message.reply.{$contact_id}' title='".LAN_CONTACT_18."'>".E_16_NEWSFEED."</a></td>
							<td class='forumheader'><input type='image' title='".LAN_CONTACT_27."' name='delete_{$contact_id}' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".$tp->toJS(LAN_CONTACT_34)."') \" /></td>
							</tr>";
							$i++;
						}	
					}	
				break;
				case 'message':
					if ($sql -> db_Select("contact", "*", "contact_id='$id'")) 
					{
						$row = $sql -> db_Fetch();
						extract($row);
					}
					switch ($sub_action) 
					{
						case 'show':
							$text .= "
							<tr>
								<td style='width:20%' class='forumheader'>".LAN_CONTACT_41."</td>
								<td style='width:80%' class='forumheader3'>".$contact_author_name."</td>
							</tr>
							<tr>
								<td style='width:20%' class='forumheader'>".LAN_CONTACT_41."</td>
								<td style='width:80%' class='forumheader3'>".$contact_email_send ."</td>
							</tr>
							<tr>
								<td class='forumheader'>".LAN_CONTACT_42."</td>
								<td class='forumheader3'>".$contact_subject."</td>
							</tr>	
							<tr>	
								<td class='forumheader'>".LAN_CONTACT_17."</td>
								<td class='forumheader3'>".$aj -> tpa($contact_body)."</td>
							</tr>
							<tr>
								<td class='forumheader'>".LAN_CONTACT_43."</td>
								<td class='forumheader3'>".$contact_time."</td>
							</tr>
							<tr>
								<td class='forumheader' colspan='2' style='text-align:center'>";			
								if ($contact_mod == 1) 
								{
									$text .= "
									<input class='button' type='submit' name='update' value='".LAN_CONTACT_26."' />
									<input class='button' type='button' name='reply' value='".LAN_CONTACT_16."' onclick=\"window.location.href='?message.reply.{$contact_id}'\" />
									<input class='button' type='submit' name='delete_{$contact_id}' value='".LAN_CONTACT_27."' onclick=\"return jsconfirm('".$tp->tojs(LAN_CONTACT_34)."') \" />
									<input type='hidden' name='contact_id' value='$id' />";
								} 
								else 
								{
									$text .= "
									<input class='button' type='button' name='reply' value='".LAN_CONTACT_16."' onclick=\"window.location.href='?message.reply.{$contact_id}'\" />
									<input class='button' type='submit' name='delete_{$contact_id}' value='".LAN_CONTACT_27."' onclick=\"return jsconfirm('".$tp->tojs(LAN_CONTACT_34)."') \" />		
									<input type='hidden' name='contact_id' value='$id' />";
								}
						break;
						case 'reply':
							$text .= "
							<tr>
								<td class='forumheader'>".LAN_CONTACT_14."</td>
								<td class='forumheader3'>".$rs->form_text("contact_subject", 53, "[".SITENAME."] ". SITEADMINEMAIL , 100)."</td>
							</tr>							
							<tr>
								<td style='width:20%' class='forumheader'>".LAN_CONTACT_15."</td>
								<td style='width:80%' class='forumheader3'>
								".$rs->form_text("contact_email_send", 40, $contact_email_send , 100)."
								".$rs->form_text("contact_author_name", 40, $contact_author_name , 100)."
								</td>
							</tr>
							<tr>
								<td class='forumheader'>".LAN_CONTACT_42."</td>
								<td class='forumheader3'>".$rs->form_text("contact_subject", 53, LAN_CONTACT_16 ." : ".$contact_subject, 100)."</td>
							</tr>							
							<tr>
								<td class='forumheader'>".LAN_CONTACT."</td>
								<td class='forumheader3'>".$rs->form_textarea("contact_body", 100, 20, $tp->post_toForm("\n\n\n-------------------- ". LAN_CONTACT_17 ." --------------------\n".$contact_body."\n------------------------------------------------------\n"), "overflow:hidden")."</td>
							</tr>

							<tr>
								<td class='forumheader' colspan='2' style='text-align:center'>
									<input class='button' type='submit' name='send' value='".LAN_CONTACT_25."' />
								</td>
							</tr>";								
						break;		
						case 'new':
							$text .= "
							<tr>
								<td class='forumheader'>".LAN_CONTACT_14."</td>
								<td class='forumheader3'>".$rs->form_text("contact_subject", 53, "[".SITENAME."] ". SITEADMINEMAIL , 100)."</td>
							</tr>							
							<tr>
								<td style='width:20%' class='forumheader3'>".LAN_CONTACT_15."</td>
								<td style='width:80%' class='forumheader3'>".$rs->form_text("contact_email_send", 53, "", 100)."</td>
							</tr>
							<tr>
								<td class='forumheader'>".LAN_CONTACT_42."</td>
								<td class='forumheader3'>".$rs->form_text("contact_subject", 53, "", 100)."</td>
							</tr>							
							<tr>
								<td class='forumheader'>".LAN_CONTACT."</td>
								<td class='forumheader3'>".$rs->form_textarea("contact_body", 100, 20, $tp->post_toForm(""), "overflow:hidden")."</td>
							</tr>

							<tr>
								<td class='forumheader' colspan='2' style='text-align:center'>
									<input class='button' type='submit' name='send' value='".LAN_CONTACT_25."' />
								</td>
							</tr>";								
						break;							
						case 'unread':
							if(!$sql -> db_Select("contact", "*", "where contact_mod = 1 ", "contact_time ORDER BY contact_mod DESC")) 
							{
								$text .= "<tr><td>".LAN_CONTACT_20."</td></tr>";
							}
							else 
							{
								$text .= "
								<tr>
									<td class='fcaption' style='width:6%'>".LAN_CONTACT_40."</td>
									<td class='fcaption' style='width:51%'>".LAN_CONTACT_42."</td>
									<td class='fcaption' style='width:15%'>".LAN_CONTACT_41."</td>
									<td class='fcaption' style='width:18%'>".LAN_CONTACT_43."</td>
									<td class='fcaption' style='width:3%'>".LAN_CONTACT_19."</td>
									<td class='fcaption' style='width:3%'>".LAN_CONTACT_18."</td>
									<td class='fcaption' style='width:3%'>".LAN_CONTACT_27."</td>
								</tr>";

								$i = 1;
								while($row = $sql -> db_Fetch()) {
									extract($row);

									$contact_body = substr($contact_body, 0, 42)."...";
									$text .= "
									<tr>
									<td class='forumheader3'><font style='color:red;font-weight:bold'>".LAN_CONTACT_28."</font></td>
									<td class='forumheader3'>".$contact_subject."</a></td>
									<td class='forumheader3'><a  href='mailto:".$contact_email_send."' >".$contact_author_name ."</a></td>
									<td class='forumheader3'>".$contact_time."</td>
									<td class='forumheader3'><a href='".e_SELF."?message.show.{$contact_id}' title='".LAN_CONTACT_19."'>".E_16_NOTIFY."</a></td>
									<td class='forumheader3'><a href='".e_SELF."?message.reply.{$contact_id}' title='".LAN_CONTACT_18."'>".E_16_NEWSFEED."</a></td>
									<td class='forumheader3'><input type='image' title='".LAN_CONTACT_27."' name='delete_{$contact_id}' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".$tp->toJS(LAN_CONTACT_34)."') \" /></td>
									</tr>";
									$i++;
								}	
							}						
						break;
					} 		
					$text .= "</td></tr>";	
				break;	
				case 'pref':
					$text .= "
					<tr>
						<td style='width:40%' class='forumheader3'>".LAN_CONTACT_2."</td>
						<td style='width:60%' class='forumheader3'>
							<input type='radio' name='contact_plugin_enable' value='1' ".($pref['contact_plugin_enable'] ? " checked='checked'" : "")." /> ".LAN_ENABLED."&nbsp;&nbsp;
							<input type='radio' name='contact_plugin_enable' value='0' ".(!$pref['contact_plugin_enable'] ? " checked='checked'" : "")." /> ".LAN_DISABLED."<br />
						</td>
					</tr>
					<tr>
						<td class='forumheader' colspan='2' style='text-align:center'><input class='button' type='submit' name='updatesettings' value='".LAN_CONTACT_25."' /></td>
					</tr>";
				break;
			}

$text .= "
		</tbody>
	</table>
</div>";
$text .= $rs->form_close();
// $pref['contact_version'] = "1";
$ns -> tablerender(LAN_CONTACT ." - V. ".  $pref['contact_version'], $text);
require_once(e_ADMIN."footer.php");


class contact
{
	function show_message($message) {
		global $ns;
		$ns->tablerender(LAN_CONTACT_30, "<div style='text-align:center'><b>".$message."</b></div>");
	}
}


function admin_config_adminmenu() {
	global $sql ;
	$reported_contact = $sql->db_count('contact', '(*)', "where contact_mod = 1 ");

	$action = (e_QUERY) ? e_QUERY : "main";
	
	$var['main']['text'] = LAN_CONTACT_22;
	$var['main']['link'] = e_SELF;
	
	$var['create']['text'] = LAN_CONTACT_23  ;
	$var['create']['link'] = e_SELF."?message.new";

	$var['submitted']['text'] = LAN_CONTACT_29 . " ( " . $reported_contact ." ) " ;
	$var['submitted']['link'] = e_SELF."?message.unread";
	
	$var['pref']['text'] = LAN_CONTACT_24;
	$var['pref']['link'] = e_SELF."?pref";

	show_admin_menu(LAN_CONTACT_21, $action, $var);
}

exit;

?>
