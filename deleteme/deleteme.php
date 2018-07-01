<?php
/*
+---------------------------------------------------------------+
|       Delete Me for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}
include_lan(e_PLUGIN . "deleteme/languages/" . e_LANGUAGE . ".php");
require_once(HEADERF);
if (!defined('USER_WIDTH'))
{
    define(USER_WIDTH, "width:100%;");
}
// Check we're not using LDAP authentication'
if ($pref['auth_method'] == 'ldap')
{
    // We are so tell user they cant delete their account and exit plugin
    $delme_text .= "
<div style='text-align:center; text-valign:center'>
	<table style ='" . USER_WIDTH . "' class='fborder' >";
    if (file_exists("./images/banner.png"))
    {
        $delme_text .= "
		<tr>
			<td class = 'forumheader3' style='text-align:center;' colspan = '2'><img src='./images/banner.png' style='border:0;' alt='' title='' /></td>
		</tr>";
    }
    $delme_text .= "
		<tr>
			<td class = 'forumheader3' >" . DELETEME_20 . "</td>
		</tr>
		<tr>
			<td  class = 'forumheader3' ><a href = '" . SITEURL . "index.php'>" . DELETEME_10 . "</a></td>
		</tr>
	</table>
</div>";
    $ns->tablerender(DELETEME_12, $delme_text);
    require_once(FOOTERF);
    exit();
}

$delme_use_imagecode = ($pref['deleteme_useseccode'] && extension_loaded("gd"));

if ($delme_use_imagecode)
{
    require_once(e_HANDLER . "secure_img_handler.php");
    $delme_sec_img = new secure_image;
}
// Check if user in correct class and at least logged in
if (!defined('USERNAME') || !check_class($pref['deleteme_userclass']))
{
    $delme_text .= "
<div style='text-align:center; text-valign:center'>
	<table style ='" . USER_WIDTH . "' class='fborder' >";
    if (file_exists("./images/banner.png"))
    {
        $delme_text .= "
		<tr>
			<td class = 'forumheader3' style='text-align:center;' colspan = '2'><img src='./images/banner.png' style='border:0;' alt='' title='' /></td>
		</tr>";
    }
    $delme_text .= "
		<tr>
			<td class = 'forumheader3' >" . DELETEME_19 . "</td>
		</tr>
		<tr>
			<td  class = 'forumheader3' ><a href = '" . SITEURL . "index.php'>" . DELETEME_10 . "</a></td>
		</tr>
	</table>
</div>";
}
else
{
    $delme_continue = "
		<tr>
			<td  class = 'forumheader3' colspan='2'><a href='deleteme.php'>" . DELETEME_17 . "</a></td>
		</tr>";
    $delme_action = $_REQUEST['delme_action'];
    $delme_ok = false;
    if ($delme_action == "deleteme")
    {
        if ($delme_use_imagecode)
        {
            if (!$delme_sec_img->verify_code($_POST['rand_num'], $_POST['code_verify']))
            {
                $error = true;
            }
        }
        $delme_text .= "
	<table style ='" . USER_WIDTH . "' class='fborder' >";
        if (file_exists("./images/banner.png"))
        {
            $delme_text .= "
			<tr>
				<td class = 'forumheader3' style='text-align:center;' colspan = '2'><img src='./images/banner.png' style='border:0;' alt='' title='' /></td>
			</tr>";
        }
        $delme_text .= "
		<tr>
			<td class = 'forumheader3'>";
        if ($error)
        {
            $delme_text .= DELETEME_16;
        }
        else
        {
            // If we are deleting?
            if ($_REQUEST['delme_dook'] <> 1)
            {
                // User has not confirmed
                $delme_text .= DELETEME_5;
            }
            else
            {
                $delme_id = $_REQUEST['delme_id'];
                // Check the username is the same as the person logged in
                if ($delme_id <> USERID)
                {
                    $delme_text .= DELETEME_6;
                }
                else
                {
                    if ($delme_id == 1)
                    {
                        $delme_text .= DELETEME_13;
                    }
                    else
                    {
                        if (ADMIN)
                        {
                            $delme_text .= DELETEME_11;
                        }
                        else
                        {
                            $delme_db = new DB;
                            if ($delme_db->db_Delete("user", "user_id = '" . $delme_id . "' and user_password = '" . md5($_POST['userpass']) . "'",false))
                            {
                                $delme_ok = true;
                                $delme_continue = DELETEME_4 . "<br /><a href='../../index.php?logout'>" . DELETEME_8 . "</a>";
                                $deleteme_args = "0,
								'" . USERID . "',
								'" . USERNAME . "',
								'" . USEREMAIL . "',
								'" . $_REQUEST['deleteme_reason_left'] . "',
								'" . time() . "',
								'".$e107->getip()."'";
                                $delme_db->db_Insert("deleteme_why", $deleteme_args,false);
                                // Send email
                                if ($pref['deleteme_confirmemail'])
                                {
                                    require_once(e_HANDLER . "mail.php");
                                    $deleteme_email = DELETEME_25 . SITENAME . DELETEME_26;
                                    sendemail(USEREMAIL, DELETEME_24, $deleteme_email, USERNAME, SITEADMINEMAIL, SITENAME);
                                }

                                header("Location:" . SITEURL . "index.php?logout");
                            }
                            else
                            {
                                $delme_ok = true;
                                $delme_text .= DELETEME_21;
                            }
                        }
                    }
                }
            }
        }
        $delme_text .= "$delme_continue
			</td>
		</tr>
	</table>";
    }
    else
    {
        $delme_text .= "
<div style='text-align:center; text-valign:center'>
	<form id='uchange' method='post' action='" . e_SELF . "' >
		<table style ='" . USER_WIDTH . "' class='fborder' >";
        if (file_exists("./images/banner.png"))
        {
            $delme_text .= "
			<tr>
				<td class = 'forumheader3' style='text-align:center;' colspan = '2'><img src='./images/banner.png' style='border:0;' alt='' title='' /></td>
			</tr>";
        }
        if (!ADMIN)
        {
            $delme_text .= "
			<tr>
				<td class = 'forumheader3' colspan = '2'>" . DELETEME_7 . "<br /><br />" . DELETEME_9 . "<br /><br /><a href = '" . SITEURL . "index.php'>" . DELETEME_10 . "</a><br /><br />" . (ADMIN?DELETEME_11:"") . "</td>
			</tr>";
            $delme_text .= "
			<tr>
				<td  class = 'forumheader3' style='width:15%;' >" . DELETEME_1 . "</td><td  class = 'forumheader3' style='width:85%;' >" . USERNAME . "</td>
			</tr>
			<tr>
				<td  class = 'forumheader3'>" . DELETEME_18 . "</td>
				<td  class = 'forumheader3'><input class='tbox' type='password' name='userpass' size='20' value='' maxlength='20' /></td>
			</tr>";
            if ($delme_use_imagecode)
            {
                $delme_text .= "
			<tr>
				<td  style='width:15%;vertical-align:top;' class = 'forumheader3'>" . DELETEME_14 . "</td>
				<td  class = 'forumheader3' style='width:85%;vertical-align:top;'>
					<input type = 'hidden' name = 'rand_num' value ='" . $delme_sec_img->random_number . "' />" . $delme_sec_img->r_image() . "<br /><input type = 'text' name = 'code_verify' class = 'tbox' size = '10' />
				</td>
			</tr>" ;
            }
            if ($pref['deleteme_survey'] == 1)
            {
                $delme_text .= "
			<tr>
				<td class = 'forumheader3' style='width:15%;'>" . DELETEME_23 . "</td>
				<td class = 'forumheader3'>" . DELETEME_22 . "<br /><textarea name='deleteme_reason_left' class = 'tbox' rows = '5' cols='90%' ></textarea></td>
			</tr>";
            }
            $delme_text .= "
			<tr>
				<td  class = 'forumheader3' colspan = '2'>
					<input type = 'submit' name = 'newname' class = 'tbox' value = '" . DELETEME_3 . "' />&nbsp;&nbsp;
					<input type = 'checkbox' name='delme_dook' value = '1' class = 'tbox' style='border:0;' />" . DELETEME_2 . "
					<input type = 'hidden' name = 'delme_action' value = 'deleteme' />
					<input type = 'hidden' name='delme_id' value = '" . USERID . "' />
				</td>
			</tr>";
        }
        else
        {
            $delme_text .= "
			<tr>
				<td class = 'forumheader3' colspan = '2'>" . DELETEME_11 . "</td>
			</tr>
			<tr>
			<td  class = 'forumheader3'  colspan = '2'><a href = '" . SITEURL . "index.php'>" . DELETEME_10 . "</a></td>
		</tr>";
        }
        $delme_text .= "
		</table>
	</form>
</div>";
    }
}
$ns->tablerender(DELETEME_12, $delme_text);
require_once(FOOTERF);

?>