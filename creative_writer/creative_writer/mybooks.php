<?php

require_once("../../class2.php");
// If not a valid call to the script then leave it
if (!defined('e107_INIT'))
{
    exit;
}
include_lan(e_PLUGIN . "creative_writer/languages/" . e_LANGUAGE . ".php");
require_once(e_HANDLER . "userclass_class.php");
$cwriter_admin = check_class($pref['cwriter_admin']);
$cwriter_editor = check_class($pref['cwriter_create']);
if (!$cwriter_admin && !$cwriter_editor)
{
    print "You are not permitted to administer books";
    exit;
}

require_once(e_HANDLER . "date_handler.php");

$cwriter_conv = new convert;
require_once(e_HANDLER . "ren_help.php");
$action = "show";
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $action = $_POST['action'];
    $cw_book_id = intval($_POST['cw_book_id']);
    $cw_chapter_id = intval($_POST['cw_chapter_id']);
} elseif (e_QUERY)
{
    $ecard_tmp = explode(".", e_QUERY);

    $action = $ecard_tmp[0];
    $cw_book_id = intval($ecard_tmp[1]);
    $cw_chapter_id = intval($ecard_tmp[2]);
}
require_once(HEADERF);
if (!empty($_POST['dobookdel']))
{
    $cwriter_arg = "select * from #cw_book
    where cw_book_id = $cw_book_id ";
    $sql->db_Select_gen($cwriter_arg, false);
    extract($sql->db_Fetch());
    // make sure they are allowed to delete the chapter - admin or user who created it.
    if ($cwriter_admin || $cw_book_author == USERID . "." . USERNAME)
    {
        $sql->db_Delete("cw_chapters", " cw_chapter_book ={$cw_book_id} ", false);
        $sql->db_Delete("cw_book", "cw_book_id={$cw_book_id}", false);
        $sql->db_Delete("rate", "rate_table='cwriter' and rate_itemid={$cw_book_id}", false);
        // delete ratings and comments
    }
    $action = "show";
}
if ($action == "delete")
{
    $cwriter_arg = "select *,count(cw_chapter_id) as numchap from #cw_book
    left join #cw_chapters on cw_chapter_book=cw_book_id
    where cw_book_id = $cw_book_id
	group by cw_book_id ";
    $sql->db_Select_gen($cwriter_arg, false);

    extract($sql->db_Fetch());

    $cwriter_text .= "
	<form method='post' action='" . e_SELF . "' id='dataform'>
<div>
	<input type='hidden' name='action' value='show' />
	<input type='hidden' name='cw_chapter_id' value='$cw_chapter_id' />
	<input type='hidden' name='cw_book_id' value='$cw_book_id' />

</div>
<div class='ober-wrapper'>
<table class='fborder' style='width:100%;'>
	<tr>
		<td  class='fcaption' >" . CWRITER_A83 . " - <em>" . $tp->toHTML($cw_book_title) . "</em></td>
	</tr>
		<tr>
		<td class='forumheader3'><a href='" . e_SELF . "?show'><img src='images/updir.png' style='border:0' alt='" . CWRITER_66 . "' title='" . CWRITER_66 . "'  /></a></td>
	</tr>

	<tr>
		<td  class='forumheader3' style='text-align:center;' ><strong>" . CWRITER_A84 . " <em>" . $tp->toHTML($cw_book_title) . "</em> " . CWRITER_A85 . " $numchap " . CWRITER_A86 . "</strong><br />
			<input class='button' type='submit' name='dobookcancel' value='" . CWRITER_A81 . "' />&nbsp;&nbsp;
			<input class='button' type='submit' name='dobookdel' value='" . CWRITER_A82 . "' />
		</td>
	</tr>
</table>
</div>
</form>";
}
if (!empty($_POST['dodel']))
{
    $cwriter_arg = "select * from #cw_chapters
    left join #cw_book on cw_chapter_book=cw_book_id
    where cw_book_id = $cw_book_id and cw_chapter_id=$cw_chapter_id";
    $sql->db_Select_gen($cwriter_arg, false);
    extract($sql->db_Fetch());
    // make sure they are allowed to delete the chapter - admin or user who created it.
    if ($cwriter_admin || $cw_chapter_author == USERID . "." . USERNAME)
    {
        $sql->db_Delete("cw_chapters", " cw_chapter_book ={$cw_book_id} and  cw_chapter_id={$cw_chapter_id}", false);
    }
    $action = "chapters";
}
if ($action == "delchap")
{
    $cwriter_arg = "select * from #cw_chapters
    left join #cw_book on cw_chapter_book=cw_book_id
    where cw_book_id = $cw_book_id and cw_chapter_id=$cw_chapter_id";
    $sql->db_Select_gen($cwriter_arg, false);

    extract($sql->db_Fetch());

    $cwriter_text .= "
<form method='post' action='" . e_SELF . "' id='dataform'>
<div>
	<input type='hidden' name='action' value='chapters' />
	<input type='hidden' name='cw_chapter_id' value='$cw_chapter_id' />
	<input type='hidden' name='cw_book_id' value='$cw_book_id' />

</div>
<div class='ober-wrapper'>
<table class='fborder' style='width:100%;'>
	<tr>
		<td  class='fcaption' >" . CWRITER_300 . " - <em>" . $tp->toHTML($cw_book_title) . "</em></td>
	</tr>
		<tr>
		<td class='forumheader3'> <a href='" . e_SELF . "?chapters.$cw_book_id.$cw_chapter_id'><img src='images/updir.png' style='border:0' alt='" . CWRITER_71 . "' title='" . CWRITER_71 . "'  /></a></td>
	</tr>
	<tr>
		<td  class='forumheader3' style='text-align:center;' ><strong>" . CWRITER_A80 . "</strong> $cw_chapter_number<br />
			<input class='button' type='submit' name='docancel' value='" . CWRITER_A81 . "' />&nbsp;&nbsp;
			<input class='button' type='submit' name='dodel' value='" . CWRITER_A82 . "' />
		</td>
	</tr>
</table>
</div>
</form>";
}
if ($action == "newchap")
{
    $action = "edchap";
    $cw_chapter_id = 0;
}
if ($action == "savechap")
{
    $cwriter_words = $_POST['cw_chapter_body'];
    $cwriter_words = str_replace("<br />", " ", $cwriter_words);
    $cwriter_words = strip_tags($cwriter_words);
    $cwriter_words = preg_replace("/\s\s+/", " ", $cwriter_words);
    $cwriter_temp = explode(" ", $cwriter_words);

    $cwriter_wordcount = count($cwriter_temp);
    if ($cw_chapter_id == 0)
    {
        // new chapter
        $cwriter_arg = "
	0,
	'" . $tp->toDB($_POST['cw_chapter_title']) . "',
	'" . $tp->toDB($_POST['cw_chapter_number']) . "',
	'" . $tp->toDB($_POST['cw_chapter_body']) . "',
	'" . time() . "',
	'" . time() . "',
	'" . intval($cw_book_id) . "',
	'" . USERID . "." . USERNAME . "',
	'" . $cwriter_wordcount . "',
	'0',
	'" . intval($_POST['cw_chapter_payfor']) . "',
	'0',
	'0'";
        $cwriter_insid = $sql->db_Insert("cw_chapters", $cwriter_arg, false);
        update_chapters($cw_book_id);
    }
    else
    {
        // update chapter
        $cwriter_arg = "
	cw_chapter_title = '" . $tp->toDB($_POST['cw_chapter_title']) . "',
	cw_chapter_number = '" . $tp->toDB($_POST['cw_chapter_number']) . "',
	cw_chapter_body = '" . $tp->toDB($_POST['cw_chapter_body']) . "',
	cw_chapter_wordcount = '" . $cwriter_wordcount . "',
	cw_chapter_lastupdate = '" . time() . "',
	cw_chapter_payfor='" . intval($_POST['cw_chapter_payfor']) . "'
	where cw_chapter_id=$cw_chapter_id";
        $sql->db_Update("cw_chapters", $cwriter_arg, false);
    }
    update_chapters($cw_book_id);
    $action = "chapters";
}
if ($action == "edchap")
{
    if ($cw_chapter_id > 0)
    {
        // we are editing
        $cwriter_arg = "select * from #cw_chapters
		left join #cw_book on cw_book_id=cw_chapter_book
		where cw_chapter_id=$cw_chapter_id";
        $sql->db_Select_gen($cwriter_arg, false);
    }
    else
    {
        // just get the book name
        $sql->db_Select("cw_book", "*", "where cw_book_id = $cw_book_id", "nowhere", false);
    }
    extract($sql->db_Fetch());
    $cwriter_text .= "
<form method='post' action='" . e_SELF . "' id='dataform'>
<div>
	<input type='hidden' name='action' value='savechap' />
	<input type='hidden' name='cw_chapter_id' value='$cw_chapter_id' />
	<input type='hidden' name='cw_book_id' value='$cw_book_id' />

</div>
<div class='ober-wrapper'>
<table class='fborder' style='width:100%;'>
	<tr>
		<td colspan='2' class='fcaption' >" . CWRITER_300 . " - <em>" . $tp->toHTML($cw_book_title) . "</em></td>
	</tr>
		<tr>
		<td class='forumheader3' colspan='2'><a href='" . e_SELF . "?chapters.$cw_book_id.$cw_chapter_id'><img src='images/updir.png' style='border:0' alt='" . CWRITER_71 . "' title='" . CWRITER_71 . "' /></a></td>
	</tr>

	<tr>
		<td style='width:25%;' class='forumheader3'>" . CWRITER_309 . "</td>
		<td style='width:75%;' class='forumheader3'>
			<input class='tbox' type='text' name='cw_chapter_number' value='" . $tp->toFORM($cw_chapter_number) . "' />
		</td>
	</tr>
	<tr>
		<td style='width:25%;' class='forumheader3'>" . CWRITER_310 . "</td>
		<td style='width:75%;' class='forumheader3'>
			<input class='tbox' style='width:80%;' type='text' name='cw_chapter_title' value='" . $tp->toFORM($cw_chapter_title) . "' />
		</td>
	</tr>
	<tr>
		<td style='width:25%;' class='forumheader3'>" . CWRITER_312 . "</td>
		<td style='width:75%;' class='forumheader3'>
			<textarea name='cw_chapter_body'  style='width:95%;' cols='50' rows='30' class='tbox'  onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>" . $tp->toFORM($cw_chapter_body) . "</textarea><br /><input class='tbox' style='width:90%;border:0;' id='helpb' /><br />" . display_help("helpb") . "
		</td>
	</tr>";
    // $cwriter_text.="
    // <tr>
    // <td style='width:25%;' class='forumheader3'>" . CWRITER_311 . "</td>
    // <td style='width:75%;' class='forumheader3'>
    // <input class='tbox' style='border:0;' type='checkbox' name='cw_chapter_payfor' value='1' " . ($tp->toFORM($cw_chapter_payfor) > 0?"checked='checked'":"") . " />
    // </td>
    // </tr>";
    $cwriter_text .= "
	<tr>
		<td style='width:25%;' class='forumheader3'>" . CWRITER_313 . "</td>
		<td style='width:75%;' class='forumheader3'>" . $cwriter_conv->convert_date($cw_chapter_created) . "</td>
	</tr>
	<tr>
		<td style='width:25%;' class='forumheader3'>" . CWRITER_314 . "</td>
		<td style='width:75%;' class='forumheader3'>" . $cwriter_conv->convert_date($cw_chapter_lastupdate) . "</td>
	</tr>
	<tr>
		<td style='width:25%;' class='forumheader3'>" . CWRITER_315 . "</td>
		<td style='width:75%;' class='forumheader3'>" . number_format($cw_chapter_wordcount) . " " . CWRITER_77 . "</td>
	</tr>
	<tr>
		<td style='width:25%;' class='forumheader3'>" . CWRITER_316 . "</td>
		<td style='width:75%;' class='forumheader3'>" . $tp->toFORM($cw_chapter_views) . "</td>
	</tr>
		<tr>
		<td colspan='2' class='fcaption'><input type='submit' class='tbox' name='subfrm' value='" . CWRITER_207 . "' />
		</td>
	</tr>
</table>
</div>
</form>";
}
if ($action == "chapters")
{
    $sql->db_Select("cw_book", "*", "where cw_book_id =$cw_book_id", "nowhere", false);
    $cwriter_bookrow = $sql->db_Fetch();
    $cwriter_title = $tp->toHTML($cwriter_bookrow['cw_book_title']);
    $cwriter_text .= "
<div class='ober-wrapper'>
<table class='fborder' style='width:100%;'>
	<tr>
		<td colspan='3' class='fcaption' >" . CWRITER_300 . ": <em>$cwriter_title</em></td>
	</tr>
		<tr>
		<td class='forumheader3' colspan='3'><a href='" . e_SELF . "?show.0'><img src='images/updir.png' style='border:0' alt='" . CWRITER_213 . "' title='" . CWRITER_213 . "' /></a></td>
	</tr>
	<tr>
		<td colspan='3' class='forumheader3' ><a href='" . e_SELF . "?newchap.$cw_book_id' class='btn'>" . CWRITER_303 . "</a></td>
	</tr>
	<tr>
	<td class='fcaption' style='width:5%;'>" . CWRITER_304 . "</td>
		<td class='fcaption' style='width:70%;'>" . CWRITER_301 . "</td>
		<td class='fcaption' style='width:25%;text-align:center;'>" . CWRITER_302 . "</td>
	</tr>";
    $sql->db_Select("cw_chapters", "cw_chapter_id,cw_chapter_title,cw_chapter_number,cw_chapter_book", "where cw_chapter_book=$cw_book_id order by cw_chapter_number asc", "nowhere", false);
    while ($cwriter_row = $sql->db_Fetch())
    {
        extract($cwriter_row);
        $cwriter_text .= "
	<tr>
		<td class='forumheader2' style='width:5%;'>" . $tp->toHTML($cw_chapter_number) . "</td>
		<td class='forumheader2' style='width:70%;'>" . $tp->toHTML($cw_chapter_title) . "</td>
		<td class='forumheader2' style='width:25%;text-align:center;'>
			&nbsp;&nbsp;<a href='" . e_SELF . "?edchap.$cw_chapter_book.$cw_chapter_id' ><img src='" . e_IMAGE . "admin_images/edit_16.png' style='border:0;' alt='' /></a>
			&nbsp;&nbsp;<a href='" . e_SELF . "?delchap.$cw_chapter_book.$cw_chapter_id' ><img src='" . e_IMAGE . "admin_images/delete_16.png' style='border:0;' alt='' /></a>
		</td>
	</tr>";
    } // while
    $cwriter_text .= "
        <tr>
		<td colspan='3' class='fcaption' >" . CWRITER_212 . "
		&nbsp;&nbsp;&nbsp;&nbsp;<img src='" . e_IMAGE . "admin_images/edit_16.png' style='border:0;' alt='" . CWRITER_214 . "' title='" . CWRITER_214 . "' /> " . CWRITER_214 . "
		&nbsp;&nbsp;&nbsp;&nbsp;<img src='" . e_IMAGE . "admin_images/delete_16.png' style='border:0;' alt='" . CWRITER_215 . "' title='" . CWRITER_215 . "' /> " . CWRITER_215 . "
		</td>
	</tr>
</table>
</div>";
}
if ($action == "save")
{
    if ($_POST['cwriter_delpic'] == "1")
    {
        unlink(e_PLUGIN . "creative_writer/pictures/" . $_POST['cw_book_logo']);
        $_POST['cw_book_logo'] = "";
    }
    $cpic = $_POST['cw_book_logo'];
    if (!empty($_FILES['file_userfile']['name']))
    {
        $userid = USERID . "_";
        require_once("upload_pic.php");
        $cwriter_up = cwriter_fileup("file_userfile", e_PLUGIN . "creative_writer/pictures/", $userid);
        switch ($cwriter_up['result'])
        {
            case "0":
            default:
                $cwriter_upmess = BANDER_92;
                $cpic = "";
                $file = "";
                break;
            case "1":
                $cwriter_upmess = "";
                $cpic = $cwriter_up['filename'];
                $file = $cwriter_up['filename'];
                break;
            case "2":
                $cwriter_upmess = BANDER_93;
                $cpic = "";
                $file = "";
                break;
            case "3":
                $cwriter_upmess = BANDER_94;
                $cpic = "";
                $file = "";
                break;
        }
        cwriter_watermark("./pictures/" . $cpic, 200, 200);
    }
    else
    {
        $cpic = $_POST['cw_book_logo'];
    }
    if (!$cwriter_admin && $pref['cwriter_approval'] == 1)
    {
        // if not an admin and approval is required then set to zero
        $_POST['cw_book_approved'] = 0;
    }
    if (!$cwriter_admin && $pref['cwriter_approval'] == 0)
    {
        // if no approval and not an admin is required then approve it automatically
        $_POST['cw_book_approved'] = 1;
    }
    $cwriter_tmparray = explode(",", $_POST['cw_book_characters']);
    foreach($cwriter_tmparray as $cwriter_tname)
    {
        if (!empty($cwriter_tname))
        {
        }
        $cwriter_newarray[] = ucwords(strtolower($cwriter_tname));
    }
    $cwriter_newarray = array_unique($cwriter_newarray);
    $cwriter_newarray = implode(",", $cwriter_newarray);
    if ($cw_book_id > 0)
    {
        $cwriter_arg = "
    	cw_book_title='" . $tp->toDB($_POST['cw_book_title']) . "',
    	cw_book_summary='" . $tp->toDB($_POST['cw_book_summary']) . "',
    	cw_book_logo='" . $cpic . "',
    	cw_book_category='" . intval($_POST['cw_book_category']) . "',
    	cw_book_genre='" . intval($_POST['cw_book_genre']) . "',
    	cw_book_characters='" . $tp->toDB($cwriter_newarray) . "',
    	cw_book_lastupdate='" . time() . "',
    	cw_book_complete='" . intval($_POST['cw_book_complete']) . "',
    	cw_book_series='" . intval($_POST['cw_book_series']) . "',
    	cw_book_warnings='" . $tp->toDB($_POST['cw_book_warnings']) . "',
    	cw_book_title='" . $tp->toDB($_POST['cw_book_title']) . "',
		cw_book_disclaimer='" . $tp->toDB($_POST['cw_book_disclaimer']) . "',
		cw_book_rate='" . intval($_POST['cw_book_rate']) . "',
		cw_book_review='" . $tp->toDB($_POST['cw_book_review']) . "',
		cw_book_comments='" . intval($_POST['cw_book_comments']) . "',
		cw_book_lastupdate='" . time() . "',
		cw_book_price='" . $tp->toDB($_POST['cw_book_price']) . "',
		cw_book_visible='" . intval($_POST['cw_book_visible']) . "',
		cw_book_approved='" . intval($_POST['cw_book_approved']) . "'
		where cw_book_id=$cw_book_id";
        $sql->db_Update("cw_book", $cwriter_arg, false);
        // update_chapters($cw_book_id);
    }
    else
    {
        $cw_book_author = USERID . "." . USERNAME;
        $cwriter_arg = "
		0,
    	'" . $tp->toDB($_POST['cw_book_title']) . "',
    	'" . $tp->toDB($_POST['cw_book_summary']) . "',
    	'" . $cpic . "',
    	'" . $tp->toDB($cw_book_author) . "',
    	'" . intval($_POST['cw_book_category']) . "',
    	'" . intval($_POST['cw_book_genre']) . "',
    	'" . $tp->toDB($cwriter_newarray) . "',
    	'" . time() . "',
    	'" . time() . "',
    	'" . intval($_POST['cw_book_complete']) . "',
    	'0',
    	'" . intval($_POST['cw_book_series']) . "',
    	'0',
    	'" . $tp->toDB($_POST['cw_book_warnings']) . "',
	'0',
	'" . $tp->toDB($_POST['cw_book_disclaimer']) . "',
	'" . intval($_POST['cw_book_rate']) . "',
	'" . intval($_POST['cw_book_review']) . "',
	'" . intval($_POST['cw_book_comments']) . "',
	'" . $tp->toDB($_POST['cw_book_price']) . "',
	'" . intval($_POST['cw_book_visible']) . "',
	'" . intval($_POST['cw_book_approved']) . "',
	'" . intval($_POST['cw_book_unique']) . "',
	'',''
	";
        $cwriter_insertid = $sql->db_Insert("cw_book", $cwriter_arg, false);
        $cwriter_data = array("user" => USERNAME, "itemtitle" => $tp->toDB($_POST['cw_book_title']), "catid" => $cwriter_insertid);
        $e_event->trigger("creativewriternew", $cwriter_data);
    }
    $action = "show";
}
if ($action == "edit")
{
    $cw_book_authorname = USERNAME;
    if ($cw_book_id > 0)
    {
        $sql->db_Select("cw_book", "*", "where cw_book_id=$cw_book_id", "nowhere", false);
        extract($sql->db_Fetch());
    }
    $cwriter_yes = false;
    if ($sql2->db_Select("cw_category", "cw_category_id,cw_category_name", " order by cw_category_name", "nowhere"))
    {
        while ($cwriter_row = $sql2->db_Fetch())
        {
            // extract($cwriter_row);
            $cwriter_catopt .= "<option value='" . $cwriter_row['cw_category_id'] . "'" .
            ($cw_book_category == $cwriter_row['cw_category_id']?" selected='selected'":"") . ">" . $tp->toFORM($cwriter_row['cw_category_name']) . "</option>";
        }
    }
    else
    {
        $cwriter_catopt .= "<option value='0'>" . CWRITER_A31 . "</option>";
    }
    if ($sql2->db_Select("cw_genre", "cw_genre_id,cw_genre_name", " order by cw_genre_name", "nowhere"))
    {
        while ($cwriter_row = $sql2->db_Fetch())
        {
            // extract($cwriter_row);
            $cwriter_genopt .= "<option value='" . $cwriter_row['cw_genre_id'] . "'" .
            ($cw_book_genre == $cwriter_row['cw_genre_id']?" selected='selected'":"") . ">" . $tp->toFORM($cwriter_row['cw_genre_name']) . "</option>";
        }
    }
    else
    {
        $cwriter_genopt .= "<option value='0'>" . CWRITER_A18 . "</option>";
    }
    $cwriter_temp = explode(".", $cw_book_author, 2);
    $cw_book_authorname = $cwriter_temp[1];
    $cw_book_authorname = (empty($cw_book_authorname)?USERNAME: $cw_book_authorname);
    $cwriter_text .= "
<form enctype='multipart/form-data' id='dataform' action='" . e_SELF . "' method='post'>
	<div>
		<input type='hidden' name='action' value='save' />
		<input type='hidden' name='cw_book_id' value='$cw_book_id' />";
    if (!$cwriter_admin)
    {
        $cwriter_text .= "
		<input type='hidden' name='cw_book_rate' value='$cw_book_rate' />
		<input type='hidden' name='cw_book_comments' value='$cw_book_comments' />";
    }
    $cwriter_text .= "
	</div>
<div class='ober-wrapper'>
<table class='fborder' style='width:100%'>
	<tr>
		<td class='fcaption' colspan='2'>" . CWRITER_33 . ": <em>" . $tp->toHTML($cw_book_title) . "</em></td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>
			<a href='" . e_SELF . "?show'><img src='images/updir.png' style='border:0' alt='" . CWRITER_213 . "' title='" . CWRITER_213 . "' /></a>
		</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:25%'>" . CWRITER_34 . "</td>
		<td class='forumheader3' ><input class='tbox' type='text' name='cw_book_title'  style='width:60%;' value='" . $tp->toFORM($cw_book_title) . "' /></td>
	</tr>

	<tr>
		<td class='forumheader3' style='width:25%'>" . CWRITER_35 . "</td>
		<td class='forumheader3' ><input class='tbox'  type='text' name='cw_book_summary'  style='width:60%;' value='" . $tp->toFORM($cw_book_summary) . "' /></td>
	</tr>";
    // If there is no file specified or the image is missing allow an upload
    // Otherwise just display the name of the picture
    if (empty($cw_book_logo) || !file_exists("./pictures/" . $cw_book_logo))
    {
        $cwriter_text .= "
	<tr>
		<td class='forumheader3' style='vertical-align:top;' >" . CWRITER_A87 . ":</td>
		<td class='forumheader3' style='width:80%;text-align:left;vertical-align:top;'>
				<input class='tbox' name='file_userfile' type='file' size='47' />&nbsp;<br /><i>" . CWRITER_A89 . "</i>
		</td>
	</tr>";
    }
    else
    {
        $cwriter_text .= "
	<tr>
		<td class='forumheader3' style='vertical-align:top;' >" . CWRITER_A87 . ":</td>
		<td class='forumheader3' style='width:80%;text-align:left;vertical-align:top;'>
			<img src='./pictures/" . $cw_book_logo . "' alt='picture' />
			<br />" . CWRITER_A88 . "<input type='checkbox' name='cwriter_delpic' value='1' />
			<input type='hidden' name='cw_book_logo' value='$cw_book_logo' />
		</td>
	</tr>";
    }
    $cwriter_text .= "
	<tr>
		<td class='forumheader3' style='width:25%'>" . CWRITER_36 . "</td>
		<td class='forumheader3' ><select name='cw_book_category' class='tbox'>{$cwriter_catopt}</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:25%'>" . CWRITER_37 . "</td>
		<td class='forumheader3' ><select name='cw_book_genre' class='tbox'>{$cwriter_genopt}</select></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:25%'>" . CWRITER_38 . "</td>
		<td class='forumheader3' >" . $tp->toHTML($cw_book_authorname) . "</td>
	</tr>";
	//<tr>
	//	<td class='forumheader3' style='width:25%'>" . CWRITER_39 . "</td>
	//	<td class='forumheader3' ><textarea name='cw_book_characters' style='width:85%;' cols='50' rows='6' class='tbox' >" . $tp->toFORM($cw_book_characters) . "</textarea></td>
	//</tr>
	$cwriter_text .= "<tr>
		<td class='forumheader3' style='width:25%' valign='top'>" . CWRITER_40 . "</td>
		<td class='forumheader3' ><textarea name='cw_book_warnings'  style='width:85%;' cols='50' rows='6' class='tbox'  onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>" . $tp->toHTML($cw_book_warnings) . "</textarea><br /><input type='text' style='width:85%;border:0;' class='tbox' id='helpa' /><br />" . display_help("helpa") . "</td>
	</tr>
		<tr>
		<td class='forumheader3' style='width:25%' valign='top'>" . CWRITER_41 . "</td>
		<td class='forumheader3' ><textarea name='cw_book_disclaimer'  style='width:85%;' cols='50' rows='6' class='tbox' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);' >" . $tp->toHTML($cw_book_disclaimer) . "</textarea><br /><input type='text' style='width:85%;border:0;' class='tbox' id='helpb' /><br />" . display_help("helpb") . "</td>
	</tr>";
	//<tr>
	//	<td class='forumheader3' style='width:25%'>" . CWRITER_46 . "</td>
	//	<td class='forumheader3' ><input class='tbox'  type='text' name='cw_book_price'  style='width:20%;' value='" . $tp->toFORM($cw_book_price) . "' /></td>
	//</tr>
	$cwriter_text .= "<tr>
		<td class='forumheader3' style='width:25%'>" . CWRITER_204 . "</td>
		<td class='forumheader3' ><input type='checkbox' name='cw_book_complete' value='1' class='tbox' " . ($cw_book_complete == 1?"checked='checked'":"") . "/></td>
	</tr>";
	//<tr>
	//	<td class='forumheader3' style='width:25%'>" . CWRITER_208 . "</td>
	//	<td class='forumheader3' ><input type='checkbox' name='cw_book_series' value='1' class='tbox' " . ($cw_book_series == 1?"checked='checked'":"") . "/></td>
	//</tr>
$cwriter_text .= "<tr>
		<td class='forumheader3' style='width:25%'>" . CWRITER_A67 . "</td>
		<td class='forumheader3' ><input type='checkbox' name='cw_book_visible' value='1' class='tbox' " . ($cw_book_visible == 1?"checked='checked'":"") . "/></td>
	</tr>";
    if ($cwriter_admin)
    {
        $cwriter_text .= "
    <tr>
		<td class='forumheader3' style='width:25%'>" . CWRITER_205 . "</td>
		<td class='forumheader3' ><input type='checkbox' name='cw_book_rate' value='1' class='tbox' " . ($cw_book_rate == 1?"checked='checked'":"") . "/></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:25%'>" . CWRITER_206 . "</td>
		<td class='forumheader3' ><input type='checkbox' name='cw_book_comments' value='1' class='tbox' " . ($cw_book_comments == 1?"checked='checked'":"") . "/></td>
	</tr>";
	//Books are ALWAYS approved! 
	$cwriter_text .= "<tr style='display:none;'>
		<td class='forumheader3' style='width:25%'>" . CWRITER_A68 . "</td>
		<td class='forumheader3' ><input type='checkbox' name='cw_book_approved' value='1' class='tbox' checked='checked' /></td>
	</tr>";
    }

    //$cwriter_text .= "
	//<tr>
	//	<td class='forumheader3' style='width:25%'>" . CWRITER_42 . "</td>
	//	<td class='forumheader3' >" . $cw_book_wordcount . "</td>
	//</tr>
	//<tr>
	//	<td class='forumheader3' style='width:25%'>" . CWRITER_43 . "</td>
	//	<td class='forumheader3' >" . $cw_book_chapters . "</td>
	//</tr>
	//	<tr>
	//	<td class='forumheader3' style='width:25%'>" . CWRITER_44 . "</td>
	//	<td class='forumheader3' >" . $cwriter_conv->convert_date($cw_book_created) . "</td>
	//</tr>
	//	<tr>
	//	<td class='forumheader3' style='width:25%'>" . CWRITER_45 . "</td>
	//	<td class='forumheader3' >" . $cwriter_conv->convert_date($cw_book_lastupdate) . "</td>
	//</tr>
	//<tr>
	//	<td class='forumheader3' style='width:25%'>" . CWRITER_48 . "</td>
	//	<td class='forumheader3' >" . $cw_book_views . " (" . CWRITER_59 . " $cw_book_unique)</td>
	//</tr>
    $cwriter_text .= "<tr>
		<td colspan='2' class='fcaption'><input type='submit' class='tbox' name='subfrm' value='" . CWRITER_207 . "' /></td>
	</tr>
</table>
</div>
</form>";
}
/* Listing of all fanfics */ 
if ($action == "show")
{
    $cwriter_text .= "
<div class='ober-wrapper'>
<table class='fborder' style='width:100%;'>
	<tr>
		<td colspan='2' class='fcaption' >" . CWRITER_200 . "</td>
	</tr>
	<tr>
		<td colspan='2' class='forumheader3' >
			<a href='cwriter.php?0.show' ><img src='./images/updir.png' style='border:0;' alt='" . CWRITER_A79 . "' title='" . CWRITER_A79 . "' /></a></td>
	</tr>
	<tr>
		<td colspan='2' class='forumheader3' ><a href='" . e_SELF . "?edit.0' class='btn'>" . CWRITER_203 . "</a></td>
	</tr>
	<tr>
		<td class='fcaption' style='width:75%;'>" . CWRITER_201 . "</td>
		<td class='fcaption' style='width:25%;text-align:center;'>" . CWRITER_202 . "</td>
	</tr>
	<tr>
		<td colspan='2' class='fcaption' >" . CWRITER_212 . "
		&nbsp;&nbsp;&nbsp;&nbsp;<img src='" . e_IMAGE . "admin_images/articles_16.png' style='border:0;' alt='" . CWRITER_209 . "' title='" . CWRITER_209 . "' /> " . CWRITER_209 . "
		&nbsp;&nbsp;&nbsp;&nbsp;<img src='" . e_IMAGE . "admin_images/edit_16.png' style='border:0;' alt='" . CWRITER_210 . "' title='" . CWRITER_210 . "' /> " . CWRITER_210 . "
		&nbsp;&nbsp;&nbsp;&nbsp;<img src='" . e_IMAGE . "admin_images/delete_16.png' style='border:0;' alt='" . CWRITER_211 . "' title='" . CWRITER_211 . "' /> " . CWRITER_211 . "
		</td>
	</tr>";
    if (!$cwriter_admin)
    {
        // if not an admin then only get the users books
        $cwriter_where = "where SUBSTRING_INDEX(cw_book_author,'.',1)='" . USERID . "' ";
    }
    $sql->db_Select("cw_book", "cw_book_id,cw_book_title", "$cwriter_where order by cw_book_title", "nowhere", false);
    while ($cwriter_row = $sql->db_Fetch())
    {
        extract($cwriter_row);
        $cwriter_text .= "
	<tr>
		<td class='forumheader2' style='width:75%;'>" . $tp->toHTML($cw_book_title) . "</td>
		<td class='forumheader2' style='width:25%;text-align:center;'>
			<a href='" . e_SELF . "?chapters.$cw_book_id.0' >&nbsp;&nbsp;<img src='" . e_IMAGE . "admin_images/articles_16.png' style='border:0;' alt='" . CWRITER_209 . "' title='" . CWRITER_209 . "' /></a>
			&nbsp;&nbsp;<a href='" . e_SELF . "?edit.$cw_book_id.0' ><img src='" . e_IMAGE . "admin_images/edit_16.png' style='border:0;' alt='" . CWRITER_210 . "' title='" . CWRITER_210 . "' /></a>
			&nbsp;&nbsp;<a href='" . e_SELF . "?delete.$cw_book_id.0' ><img src='" . e_IMAGE . "admin_images/delete_16.png' style='border:0;' alt='" . CWRITER_211 . "' title='" . CWRITER_211 . "' /></a>
		</td>
	</tr>";
    } // while
    $cwriter_text .= "
    <tr>
		<td colspan='2' class='fcaption' >" . CWRITER_212 . "
		&nbsp;&nbsp;&nbsp;&nbsp;<img src='" . e_IMAGE . "admin_images/articles_16.png' style='border:0;' alt='" . CWRITER_209 . "' title='" . CWRITER_209 . "' /> " . CWRITER_209 . "
		&nbsp;&nbsp;&nbsp;&nbsp;<img src='" . e_IMAGE . "admin_images/edit_16.png' style='border:0;' alt='" . CWRITER_210 . "' title='" . CWRITER_210 . "' /> " . CWRITER_210 . "
		&nbsp;&nbsp;&nbsp;&nbsp;<img src='" . e_IMAGE . "admin_images/delete_16.png' style='border:0;' alt='" . CWRITER_211 . "' title='" . CWRITER_211 . "' /> " . CWRITER_211 . "
		</td>
	</tr>
</table>
</div>";
}
$ns->tablerender(CWRITER_01, $cwriter_text);
require_once(FOOTERF);

function update_chapters($cw_book_uid)
{
    global $sql;
    $cwriter_numwords = $sql->db_Select("cw_chapters", "count(cw_chapter_id) as numchap,sum(cw_chapter_wordcount) as numwords", "where cw_chapter_book=$cw_book_uid", "nowhere", false);
    $cwriter_rowc = $sql->db_Fetch();
    $sql->db_Update("cw_book", "cw_book_chapters=" . $cwriter_rowc['numchap'] . ",cw_book_wordcount=" . $cwriter_rowc['numwords'] . " where cw_book_id=$cw_book_uid", false);
    return;
}

?>