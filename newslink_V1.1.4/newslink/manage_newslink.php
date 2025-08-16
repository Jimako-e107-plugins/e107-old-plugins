<?php
// **************************************************************************
// *
// *  Newslink Menu for e107 v7
// *
// **************************************************************************
require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}

require_once(e_PLUGIN."newslink/includes/newslink_class.php");
if (!is_object($newslink_obj))
{
    $newslink_obj = new newslink;
}
if (!defined('USER_WIDTH'))
{
    define(USER_WIDTH, "width:100%;");
}
require_once(HEADERF);

if (!$newslink_obj->newslink_ownedit && !$newslink_obj->newslink_admin && !USER)
{
    print "Not permitted";
}
else
{
    $e_wysiwyg = "newslink_body";
    if ($NEWSLINK_PREF['wysiwyg'])
    {
        $WYSIWYG = true;
    }
    // require_once(e_HANDLER . "ren_help.php");
    // end upload picture
    $newslink_action = $_POST['newslink_action'];
    $newslink_edit = false;
    // * If we are updating then update or insert the record
    if ($newslink_action == 'update')
    {
        $newslink_newslinkid = $_POST['newslink_newslinkid'];
        if ($newslink_obj->newslink_autoapprove)
        {
            $newslink_approved = 1;
        } elseif ($newslink_obj->newslink_admin)
        {
            $newslink_approved = intval($_POST['newslink_approved']);
        }
        else
        {
            $newslink_approved = 0;
        }
        if ($newslink_newslinkid == 0)
        {
            // New record so add it
            $newslink_args = "'0',
		'" . $tp->toDB($_POST['newslink_name']) . "',
		'" . $tp->toDB($_POST['newslink_link']) . "',
		'" . USERID . "." . $tp->toDB(USERNAME) . "',
		'" . $tp->toDB($_POST['newslink_body']) . "',
		'" . $_POST['newslink_select'] . "',
		'1',
		" . time() . ",
		0,
		'',
		0";
            $newslink_newslinkid = $sql->db_Insert("newslink_newslink", $newslink_args, false);
            if ($newslink_newslinkid)
            {
                $newslink_msg .= "<b>" . NEWSLINK_A55 . "</b>";
                $newslink_sn = array("user" => USERNAME, "itemtitle" => $_POST['newslink_name'], "catid" => intval($newslink_newid));
                $e_event->trigger("newslinkpost", $newslink_sn);
            }
            else
            {
                $newslink_msg .= "<b>" . NEWSLINK_A56 . "</b>";
            }
        }
        else
        {
            // Update existing
            $newslink_args = "
		newslink_name='" . $tp->toDB($_POST['newslink_name']) . "',
		newslink_link='" . $tp->toDB($_POST['newslink_link']) . "',
		newslink_category='" . intval($_POST['newslink_select']) . "',
		newslink_approved='" . $newslink_approved . "',
		newslink_posted='" . time() . "',
		newslink_body='" . $tp->toDB($_POST['newslink_body']) . "'
		where newslink_id='$newslink_newslinkid'";

            if ($sql->db_Update("newslink_newslink", $newslink_args))
            {
                // Changes saved
                $newslink_sn = array("user" => USERNAME, "itemtitle" => $_POST['newslink_name'], "catid" => intval($newslink_newslinkid));
                $e_event->trigger("newslinkedit", $newslink_sn);
                $newslink_msg .= "<b>" . NEWSLINK_A53 . "</b>";
            }
            else
            {
                $newslink_msg .= "<b>" . NEWSLINK_A54 . "</b>";
            }
        }
        $e107cache->clear("nq_newslink");
        // Upload pictures
        if (count($_FILES) > 0 && $newslink_newslinkid > 0)
        {
            // unset($_POST['faq_submit']);
            // $faq_imageadded = false;
            while (list($key, $value) = each($_FILES['newslink_gfile']['name']))
            {
                // Check if it is a blank field, if so then skip
                if (!empty($value))
                {
                    $filename = $value; // filename stores the value
                    $add = e_PLUGIN . "newslink/pictures/" . $newslink_newslinkid . "_" . $filename; // set the upload directory path
                    $extn = strtolower(substr($_FILES['newslink_gfile']['name'][$key], -3, 3));
                    if ($extn == "jpg" || $extn == "gif" || $extn == "png" || $extn == "peg")
                    {
                        move_uploaded_file($_FILES['newslink_gfile']['tmp_name'][$key], $add); //  upload the file to the server
                        chmod("$add", 0644); // set permission to the file.
                    }
                    else
                    {
                        print $_FILES['newslink_gfile']['name'][$key] . " has an invalid extention";
                    }
                }
            }
        }
    }
    // We are creating, editing or deleting a record
    if ($_POST['resel'] == 'resel')
    {
        $newslink_action = "";
    }
    $newslink_cat = $_POST['newslink_cat'];

    if ($newslink_action == 'dothings')
    {
        $newslink_newslinkid = $_POST['newslink_selcat'];
        $newslink_do = $_POST['newslink_recdel'];
        $newslink_dodel = false;

        switch ($newslink_do)
        {
            case '1': // Edit existing record
                {
                    // We edit the record
                    $sql->db_Select("newslink_newslink", "*", "newslink_id='$newslink_newslinkid'");
                    $newslink_row = $sql->db_Fetch() ;
                    extract($newslink_row);
                    $newslink_cap1 = NEWSLINK_A24;
                    $newslink_edit = true;
                    break;
                }
            case '2': // New category
                {
                    // Create new record
                    $newslink_newslinkid = 0;
                    // set all fields to zero/blank
                    $newslink_name = "";
                    $newslink_body = "";
                    $newslink_cap1 = NEWSLINK_A23;
                    $newslink_edit = true;
                    break;
                }
            case '3':
                {
                    // delete the record
                    if ($_POST['newslink_okdel'] == '1')
                    {
                        if ($sql->db_Delete("newslink_newslink", " newslink_id='$newslink_newslinkid'"))
                        {
                            $newslink_msg .= "<strong>" . NEWSLINK_A58 . "</strong>";
                            $sql->db_Delete("rate", " rate_table='newslink' and rate_itemid='$newslink_newslinkid'");
                            // delete associated pictures
                            $newslink_filelist = glob("./pictures/{$newslink_newslinkid}_*.*");
                            foreach($newslink_filelist as $newslink_filename)
                            {
                                unlink($newslink_filename);
                            }
                        }
                        else
                        {
                            $newslink_msg .= "<strong>" . NEWSLINK_A57 . "</strong>";
                        }
                    }
                    else
                    {
                        $newslink_msg .= "<strong>" . NEWSLINK_A31 . "</strong>";
                    }
                    $newslink_dodel = true;
                    $newslink_edit = false;
                }
        }

        if (!$newslink_dodel)
        {
            require_once(e_HANDLER . "ren_help.php");
            $newslink_poster = explode(".", $newslink_author);
            $newslink_posterid = $newslink_poster[0];
            $newslink_postername = $newslink_poster[1];
            if ($newslink_newslinkid == 0)
            {
                $newslink_posterid = USERID;
                $newslink_postername = USERNAME;
            }
            $newslink_text .= "
<form id='dataform' action='" . e_SELF . "' method='post' enctype='multipart/form-data'>
	<div>
		<input type='hidden' name='newslink_from' value='$newslink_from' />
		<input type='hidden' name='newslink_newslinkid' value='$newslink_newslinkid' />
		<input type='hidden' name='newslink_newslinkcat' value='$newslink_newslinkcat' />
		<input type='hidden' name='newslink_cat' value='$newslink_cat' />
		<input type='hidden' name='newslink_action' value='update' />
	</div>
	<table class='fborder' style='" . USER_WIDTH . "'>
		<tr>
			<td class='fcaption' colspan='2'>" . NEWSLINK_A52 . "</td>
		</tr>
		<tr>
			<td colspan='2' class='forumheader2'><a href='manage_newslink.php' ><img src='images/updir.png' style='border:0px;' title='" . NEWSLINK_1 . "' alt='" . NEWSLINK_1 . "' /></a></td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:30%;'>" . NEWSLINK_A42 . "</td>
			<td class='forumheader3' style='width:70%;'>" . $newslink_postername . "</td>
		</tr>";
            $newslink_selcat = "<select class='tbox' name='newslink_select'>";
            if ($sql->db_Select("newslink_category", "*", " order by newslink_category_name", "nowhere", false))
            {
                // $newslink_selcat .= "<option value='0' > </option>";
                while ($newslink_row = $sql->db_Fetch())
                {
                    extract($newslink_row);

                    $newslink_selcat .= "<option value='$newslink_category_id'";
                    $newslink_selcat .= ($newslink_category == $newslink_category_id?" selected='selected'":"");

                    $newslink_selcat .= ">" . $tp->toFORM($newslink_category_name) . "</option>";
                } // while
            }
            else
            {
                $newslink_selcat .= "<option value='0'>" . NEWSLINK_A19 . "</option>";
            }
            $newslink_selcat .= "</select>";
            $newslink_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;'>" . NEWSLINK_A12 . "</td>
			<td class='forumheader3' style='width:70%;'>" . $newslink_selcat . "</td>
		</tr>
	    <tr>
			<td class='forumheader3' style='width:30%;vertical-align:top;'>" . NEWSLINK_A50 . "</td>
			<td class='forumheader3' style='width:70%;vertical-align:top;'><input type='text' size='50' class='tbox' name='newslink_name' value='" . $tp->toFORM($newslink_name) . "' /></td>
		</tr>
	    <tr>
			<td class='forumheader3' style='width:30%;vertical-align:top;'>" . NEWSLINK_A51 . "</td>
			<td class='forumheader3' style='width:70%;vertical-align:top;'>";
            $insertjs = (!$NEWSLINK_PREF['wysiwyg'])?"rows='10' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'":
            "rows='20' style='width:100%' ";
            $newslink_body = $tp->toForm($newslink_body);
            $newslink_text .= "<textarea class='tbox' id='newslink_body' name='newslink_body' cols='80'  style='width:95%' $insertjs>" . (strstr($newslink_body, "[img]http") ? $newslink_body : str_replace("[img]../", "[img]", $newslink_body)) . "</textarea>";

            if (!$NEWSLINK_PREF['wysiwyg'])
            {
                $newslink_text .= "<input id='helpb' class='helpbox' type='text' name='helpb' size='100' style='width:95%'/>
			<br />" . display_help("helpb");
            }

            $newslink_text .= "
			</td>
		</tr>
			    <tr>
			<td class='forumheader3' style='width:30%;vertical-align:top;'>" . NEWSLINK_A113 . "</td>
			<td class='forumheader3' style='width:70%;vertical-align:top;'><input type='text' size='50' class='tbox' name='newslink_link' value='" . $tp->toFORM($newslink_link) . "' /></td>
		</tr>";
            if ($newslink_obj->newslink_autoapprove && !$newslink_obj->newslink_admin)
            {
                $newslink_text .= "
			<tr>
				<td class='forumheader3' style='width:30%;'>" . NEWSLINK_A44 . "</td>
				<td class='forumheader3' style='width:70%;'>" . NEWSLINK_A112 . "</td>
			</tr>";
            } elseif ($newslink_obj->newslink_admin)
            {
                $newslink_text .= "
			<tr>
				<td class='forumheader3' style='width:30%;'>" . NEWSLINK_A44 . "</td>
				<td class='forumheader3' style='width:70%;'><input type='checkbox' class='tbox' value='1' name='newslink_approved' " .
                ($newslink_approved > 0?" checked='checked' ":"") . " />
				</td>
			</tr>";
            }
            else
            {
                $newslink_text .= "
			<tr>
				<td class='forumheader3' style='width:30%;'>" . NEWSLINK_A44 . "</td>
				<td class='forumheader3' style='width:70%;'>" . NEWSLINK_A110 . "</td>
			</tr>";
            }

#            $newslink_text .= "
#		<tr>
#			<td class='forumheader3' >" . NEWSLINK_A101 . "</td>
#			<td class='forumheader3' >";
#            $newslink_text .= "<a style='cursor: pointer; cursor: hand' onclick='expandit(this);'>" . NEWSLINK_A102 . "</a>
#		<div style='display: none;'>
#				<div id='up_container' >
#					<span id='upline' style='white-space:nowrap'>
#						<input class='tbox' type='file' name='newslink_gfile[]' size='50%' />\n
#					</span>
#				</div>
#		</div>";

            $newslink_text .= "
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='2'><input type='submit' class='tbox' name='newslink_submit' value='" . NEWSLINK_A17 . "' /></td>
		</tr>
	</table>
</form>";
        }
    }

    if (!$newslink_edit)
    {
        // Get the category names to display in combo box
        // then display actions available
        // check if admin class, if so show all categories else only the users categories
        if (!$newslink_obj->newslink_admin)
        {
            $newslink_restrict = "where find_in_set(newslink_category_read,'" . USERCLASS_LIST . "') ";
            $newslink_filter = "and SUBSTRING_INDEX(newslink_author,'.',2) = " . USERID . "";
        }
        $newslink_sel1 = "<select class='tbox' name='newslink_cat' onchange='this.form.resel.value=\"resel\";this.form.submit()'>";
        if ($sql2->db_Select("newslink_category", "newslink_category_id,newslink_category_name", " $newslink_restrict order by newslink_category_name", "nowhere", false))
        {
            while ($newslink_row = $sql2->db_Fetch())
            {
                extract($newslink_row);
                if ($newslink_cat == 0)
                {
                    $newslink_cat = $newslink_category_id;
                }
                $newslink_sel1 .= "<option value='$newslink_category_id'" .
                ($newslink_cat == $newslink_category_id?" selected='selected'":"") . ">$newslink_category_name</option>";
            }
        }
        else
        {
            $newslink_sel1 .= "<option value='0'>" . NEWSLINK_A19 . "</option>";
        }
        $newslink_sel1 .= "</select>";
        $newslink_yes = false;

        if ($sql2->db_Select("newslink_newslink", "newslink_id,newslink_name", "where newslink_category = $newslink_cat $newslink_filter order by newslink_name", "nowhere", false))
        {
            $newslink_yes = true;
            while ($newslink_row = $sql2->db_Fetch())
            {
                extract($newslink_row);
                $newslink_catopt .= "<option value='$newslink_id'" .
                ($newslink_id == $newslink_id?" selected='selected'":"") . ">$newslink_name</option>";
            }
        }
        else
        {
            $newslink_catopt .= "<option value='0'>" . NEWSLINK_A60 . "</option>";
        }

        $newslink_text .= "
<form id='dataform' method='post' action='" . e_SELF . "'>
	<div>
		<input type='hidden' name='resel' value='do' />
		<input type='hidden' value='dothings' name='newslink_action' />
	</div>
	<table style='" . USER_WIDTH . "' class='fborder'>
		<tr>
			<td colspan='2' class='fcaption'>" . NEWSLINK_A52 . "</td>
		</tr>
		<tr>
			<td colspan='2' class='forumheader2'><a href='newslink.php' ><img src='images/updir.png' style='border:0px;' title='" . NEWSLINK_1 . "' alt='" . NEWSLINK_1 . "' /></a></td>
		</tr>
		<tr>
			<td colspan='2' class='forumheader3'>" . $newslink_msg . "&nbsp;</td>
		</tr>
		<tr>
			<td style='width:20%;' class='forumheader3'>" . NEWSLINK_A12 . "</td><td  class='forumheader3'>" . $newslink_sel1 . "</td>
		</tr>
		<tr>
			<td style='width:20%;' class='forumheader3'>" . NEWSLINK_A49 . "</td><td  class='forumheader3'><select name='newslink_selcat' class='tbox'>$newslink_catopt</select></td>
		</tr>
		<tr>
			<td style='width:20%;' class='forumheader3'>" . NEWSLINK_A18 . "</td><td  class='forumheader3'>
				<input type='radio' name='newslink_recdel' value='1' " . ($newslink_yes?"checked='checked'":"disabled='disabled'") . "  /> " . NEWSLINK_A13 . "<br />
				<input type='radio' name='newslink_recdel' value='2' " . (!$newslink_yes?"checked='checked'":"") . "/> " . NEWSLINK_A14 . "<br />
				<input type='radio' name='newslink_recdel' value='3' /> " . NEWSLINK_A15 . "
				<input type='checkbox' name='newslink_okdel' value='1' />" . NEWSLINK_A16 . "
			</td>
		</tr>
		<tr>
			<td colspan='2' class='fcaption'><input type='submit' name='submits' value='" . NEWSLINK_A17 . "' class='tbox' /></td>
		</tr>
	</table>
</form>";
    }
}
$ns->tablerender(NEWSLINK_1, $newslink_text);
require_once(FOOTERF);

?>