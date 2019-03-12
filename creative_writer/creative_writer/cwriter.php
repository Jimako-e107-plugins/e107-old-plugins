<?php
require_once("../../class2.php");
// If not a valid call to the script then leave it
if (!defined('e107_INIT'))
{
    exit;
}

include_lan(e_PLUGIN . "creative_writer/languages/" . e_LANGUAGE . ".php");
// define the over ride meta tags
// define("PAGE_NAME", ECLASSF_1);
// check if we use the wysiwyg for text areas
$e_wysiwyg = "cwriter_cdetails";
if ($pref['wysiwyg'])
{
    $WYSIWYG = true;
}
require_once(e_HANDLER . "userclass_class.php");
require_once(e_HANDLER . "ren_help.php");
require_once(e_HANDLER . "rate_class.php");
$rater = new rater;
require_once(e_HANDLER . "date_handler.php");
$cwriter_conv = new convert;
require_once(e_HANDLER . "comment_class.php");
$cwriter_com = new comment;
require_once(HEADERF);
$cwriter_from = 0;
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $cwriter_from = intval($_POST['cwriter_from']);
    $action = $_POST['action'];
    $cwriter_bookid = intval($_POST['cwriter_bookid']);
    $cwriter_chapterid = intval($_POST['cwriter_chapterid']);
} elseif (e_QUERY)
{
    $cwriter_temp = explode(".", e_QUERY);
    $cwriter_from = intval($cwriter_temp[0]);
    $action = $cwriter_temp[1];
    $cwriter_bookid = intval($cwriter_temp[2]);
    $cwriter_chapterid = intval($cwriter_temp[3]);
}
if (isset($_POST['commentsubmit']))
{
    $cwriter_tmp = explode(".", e_QUERY);
    $cwriter_from = intval($cwriter_tmp[0]);
    $action = "precis";
    $cwriter_bookid = intval($cwriter_tmp[2]);
    $cwriter_com->enter_comment($_POST['author_name'], $_POST['comment'], "cwbook", $cwriter_bookid, $pid, $_POST['subject']);
}

if (empty($action))
{
    $action = "show";
}
if (!empty($_POST['subbio']))
{
    // saving the biography
    if ($_POST['cwriter_delpic'] == "1")
    {
        unlink(e_PLUGIN . "creative_writer/biopics/" . $_POST['cw_bio_picture']);
        $_POST['cw_bio_picture'] = "";
    }
    $cpic = $_POST['cw_bio_picture'];
    if (!empty($_FILES['file_userfile']['name']))
    {
        $userid = USERID . "_";
        require_once("upload_pic.php");
        $cwriter_up = cwriter_fileup("file_userfile", e_PLUGIN . "creative_writer/biopics/", $userid);
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
        cwriter_watermark("./biopics/" . $cpic, 200, 200);
    }
    else
    {
        $cpic = $_POST['cw_bio_picture'];
    }

    if ($sql->db_Select("cw_biography", "*", "where cw_bio_id={$cwriter_chapterid}", "nowhere", false))
    {
        // exists so update
        $sql->db_Update("cw_biography", "
    	cw_bio_picture='" . $tp->toDB($cpic) . "',
    	cw_bio_biography='" . $tp->toDB($_POST['cw_bio_biography']) . "',
    	cw_bio_contact='" . $tp->toDB($_POST['cw_bio_contact']) . "'
    	where cw_bio_id={$cwriter_chapterid}", false);
    }
    else
    {
        // does not exist so insert
        $sql->db_Insert("cw_biography", "
	$cwriter_chapterid,
	'" . $tp->toDB($_POST['cw_bio_name']) . "',
	'" . $tp->toDB($cpic) . "',
	'" . $tp->toDB($_POST['cw_bio_biography']) . "',
	'',
	'" . $tp->toDB($_POST['cw_bio_contact']) . "'", false);
    }
}
if ($action == "bbio" || $action == "sbio")
{
    $cwriter_nobio = false;
    if ($sql->db_Select("cw_biography", "*", "where cw_bio_id={$cwriter_chapterid}", "nowhere", false))
    {
        $cwriter_biorow = $sql->db_Fetch();
        extract($cwriter_biorow);
    }
    else
    {
        $cwriter_nobio = true;
    }

    if ($action == "sbio")
    {
        $cwriter_updir = "<a href='" . e_SELF . "?0.show'><img src='images/updir.png' style='border:0' alt='" . CWRITER_66 . "' title='" . CWRITER_66 . "' /></a>";
    }
    else
    {
        $cwriter_updir = "<a href='" . e_SELF . "?0.precis.$cwriter_bookid'><img src='images/updir.png' style='border:0'  alt='" . CWRITER_69 . "' title='" . CWRITER_69 . "'/></a>";
    }
    if (USERID == $cwriter_chapterid)
    {
        $cwriter_text = "
<form action='" . e_SELF . "' method='post' id='dataform' enctype='multipart/form-data'>
<div>
	<input type='hidden' name='cwriter_bookid' value='$cwriter_bookid' />
	<input type='hidden' name='cwriter_chapterid' value='$cwriter_chapterid' />
</div>
<div class='ober-wrapper'>
<table class='fborder' style='width:100%'>
	<tr>
		<td class='fcaption' colspan='2'>" . CWRITER_60 . " - " . $tp->toHTML($cw_bio_name) . "</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>$cwriter_updir
		</td>
	</tr>
		<tr>
		<td class='forumheader3' >" . CWRITER_61 . "</td>
		<td class='forumheader3' >" . USERNAME . "</td>
	</tr>
";
        // If there is no file specified or the image is missing allow an upload
        // Otherwise just display the name of the picture
        if (empty($cw_bio_picture) || !file_exists("./biopics/" . $cw_bio_picture))
        {
            $cwriter_text .= "
	<tr>
		<td class='forumheader3' style='width:30%;vertical-align:top;' >" . CWRITER_A90 . ":</td>
		<td class='forumheader3' style='width:80%;text-align:left;vertical-align:top;'>
				<input class='tbox' name='file_userfile' type='file' size='47' />&nbsp;<br /><i>" . CWRITER_A89 . "</i>
		</td>
	</tr>";
        }
        else
        {
            $cwriter_text .= "
	<tr>
		<td class='forumheader3' style='vertical-align:top;' >" . CWRITER_A90 . ":</td>
		<td class='forumheader3' style='width:80%;text-align:left;vertical-align:top;'>
			<img src='./biopics/" . $cw_bio_picture . "' alt='picture' />
			<br />" . CWRITER_A88 . "<input type='checkbox' name='cwriter_delpic' value='1' />
			<input type='hidden' name='cw_bio_picture' value='$cw_bio_picture' />
		</td>
	</tr>";
        }
        $cwriter_text .= "

	<tr>
		<td class='forumheader3' >" . CWRITER_63 . "</td>
		<td class='forumheader3' ><textarea name='cw_bio_biography'  style='width:85%;' cols='50' rows='7' class='tbox' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);' >" . $tp->toFORM($cw_bio_biography) . "</textarea><br /><input type='text' style='width:85%;border:0;' class='tbox' id='helpb' /><br />" . display_help("helpb") . "" . $tp->toFORM($cw_bio_biography) . "</td>
	</tr>

	<tr>
		<td class='forumheader3' >" . CWRITER_65 . "</td>
		<td class='forumheader3' ><textarea name='cw_bio_contact'  style='width:85%;' cols='50' rows='5' class='tbox' >" . $tp->toFORM($cw_bio_contact) . "</textarea></td>
	</tr>
		<tr>
		<td class='fcaption' colspan='2'><input type='submit' class='button' name='subbio' value='" . CWRITER_A91 . "' /></td>
	</tr>
</table>
</div>
</form>";
    }
    else
    {
        $cwriter_text = "
<div class='ober-wrapper'>
<table class='fborder' style='width:100%'>
	<tr>
		<td class='fcaption' colspan='2'>" . CWRITER_60 . " - " . $tp->toHTML($cw_bio_name) . "</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>$cwriter_updir
		</td>
	</tr>";
        if ($cwriter_nobio)
        {
            $cwriter_text .= "
        	<tr>
		<td class='forumheader3' colspan='2' >" . CWRITER_A92 . "</td>
	</tr>";
        }
        else
        {
            $cwriter_text .= "
	<tr>
		<td class='forumheader3' style='width:20%' >" . CWRITER_62 . "</td>
		<td class='forumheader3' ><img src='./biopics/" . $tp->toFORM($cw_bio_picture) . "' style='border:0;' /></td>
	</tr>
	<tr>
		<td class='forumheader3' >" . CWRITER_61 . "</td>
		<td class='forumheader3' >" . $tp->toHTML($cw_bio_name) . "</td>
	</tr>
	<tr>
		<td class='forumheader3' >" . CWRITER_63 . "</td>
		<td class='forumheader3' >" . $tp->toHTML($cw_bio_biography) . "</td>
	</tr>
	<tr>
		<td class='forumheader3' >" . CWRITER_65 . "</td>
		<td class='forumheader3' >" . $tp->toHTML($cw_bio_contact) . "</td>
	</tr>";
        }
        $cwriter_text .= "
</table>
</div>";
    }
}

if (!empty($_POST['subrev']) && USER)
{
    if (!$sql->db_Select("cw_review", "cw_review_id", "where cw_review_book=$cwriter_bookid and substring_index(cw_reviewer," . ",1) = " . USERID, "nowhere", false))
    {
        $sql->db_Insert("cw_review", "
	0,
	$cwriter_bookid,
	'" . USERID . "." . USERNAME . "',
	'" . $tp->toDB($_POST['cwreview']) . "',
	0,
	" . time(), false);
    }
    $action = "review";
}
if ($action == "review")
{
    // review
    $cwriter_updir = "<a href='" . e_SELF . "?0.precis.$cwriter_bookid'><img src='./images/updir.png' alt='" . CWRITER_69 . "' title='" . CWRITER_69 . "' /></a>";
    $sql->db_Select("cw_book", "cw_book_title", "where cw_book_id=$cwriter_bookid", "nowhere", false);
    extract($sql->db_Fetch());
    $cwriter_text = "
<form action='" . e_SELF . "' method='post' id='dataform' >
<div>
	<input type='hidden' name='cwriter_bookid' value='$cwriter_bookid' />
	<input type='hidden' name='cwriter_chapterid' value='$cwriter_chapterid' />
</div>
<div class='ober-wrapper'>
	<table class='fborder' style='width:100%'>
		<tr>
			<td class='fcaption' colspan='2'>" . CWRITER_219 . " - " . $tp->toHTML($cw_book_title) . "</td>
		</tr>
		<tr>
			<td class='forumheader3' colspan='2'>$cwriter_updir&nbsp;</td>
		</tr>";
    $cwriter_arg = "select * from #cw_review
	left join #cw_book on cw_review_book=cw_book_id
	where cw_review_book=$cwriter_bookid
	order by cw_review_posted desc";
    $cwriter_reviewed = false;
    if ($sql->db_Select_gen($cwriter_arg, false))
    {
        while ($cwriter_row = $sql->db_Fetch())
        {
            extract($cwriter_row);
            $cwriter_tm = explode(".", $cw_reviewer, 2);
            if ($cwriter_tm[0] == USERID)
            {
                $cwriter_reviewed = true;
            }
            $cwriter_text .= "
        <tr>
			<td class='forumheader2' colspan='2'>" . CWRITER_220 . " <strong>" . $cwriter_tm[1] . "</strong> " . CWRITER_221 . " <strong>" . $cwriter_conv->convert_date($cw_review_posted, "short") . "</strong></td>
		</tr>
		<tr>
			<td class='forumheader3' colspan='2'>" . $tp->toHTML($cw_review, true) . "</td>
		</tr>
";
        } // while
    }
    else
    {
        $cwriter_text .= "
        <tr>
			<td class='forumheader2' style='text-align:center;' colspan='2'><strong>" . CWRITER_217 . "</strong></td>
		</tr>";
    }
    // If not reviewed then do a form
    if (!$cwriter_reviewed && USER)
    {
        $cwriter_text .= "
        <tr>
			<td class='forumheader2' colspan='2'>" . CWRITER_222 . "</td>
		</tr>
    	<tr>
			<td class='forumheader3' style='width:15%;'>" . CWRITER_223 . "</td>
			<td class='forumheader3' >
				<textarea class='tbox' style='width:90%;' rows='6' cols='50' name='cwreview' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);' ></textarea>
				<br /><input type='text' style='width:85%;border:0;' class='tbox' id='helpb' />
				<br />" . display_help("helpb") . "</td>
		</tr>
        <tr>
			<td class='fcaption' colspan='2'><input class='tbox' type='submit' name='subrev' value='" . CWRITER_224 . "' /></td>
		</tr>";
    }
    else
    {
        $cwriter_text .= "
            <tr>
			<td class='fcaption' colspan='2'>&nbsp;</td>
		</tr>";
    }
    $cwriter_text .= "
	</table>
	</div>
</form>";
}

/* Individual chapter view */
if ($action == "chapter")
{
    $sql->db_Update("cw_chapters", "cw_chapter_views=cw_chapter_views+1 where cw_chapter_book=$cwriter_bookid and cw_chapter_number=$cwriter_chapterid", false);
    $cwriter_arg = "select c.*,b.cw_book_title,b.cw_book_chapters from #cw_chapters as c
    left join #cw_book as b on c.cw_chapter_book = b.cw_book_id
    where cw_chapter_book=$cwriter_bookid and cw_chapter_number=$cwriter_chapterid";
    if ($sql->db_Select_gen($cwriter_arg, false))
    {
        $cwriter_row = $sql->db_Fetch();
        extract($cwriter_row);
        $cwriter_text = "
<div class='ober-wrapper'>
<table class='fborder' style='width:100%'>
	<tr>
		<td class='fcaption' colspan='2'><h3 class='entry-title'>" . $tp->toHTML($cw_book_title) . "</h3></td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>
			<a href='" . e_SELF . "?0.precis.$cwriter_bookid'>
				<img src='images/updir.png' style='border:0'  alt='" . CWRITER_69 . "' title='" . CWRITER_69 . "'/>
			</a>
		</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>";
        if ($cwriter_chapterid > 1)
        {
            $cwriter_chapter_prev = $cwriter_chapterid-1;
            $cwriter_text .= "
			<div style='float: left;width: 49%;text-align:left;'>
				<a href='" . e_SELF . "?0.chapter.$cwriter_bookid.$cwriter_chapter_prev'>
					<img src='./images/prev.png' style='border:0;' title='" . CWRITER_50 . "' alt='" . CWRITER_50 . "' />
				</a>
			</div>";
        }
        else
        {
            $cwriter_text .= "<div style='float: left;width: 49%;text-align:left;'>&nbsp;</div>";
        }
        if ($cwriter_chapterid < $cw_book_chapters)
        {
            $cwriter_chapter_next = $cwriter_chapterid + 1;
            $cwriter_text .= "
			<div style='float: right;width: 49%;text-align:right;'>
				<a href='" . e_SELF . "?0.chapter.$cwriter_bookid.$cwriter_chapter_next'>
					<img src='./images/next.png' style='border:0;' title='" . CWRITER_49 . "' alt='" . CWRITER_49 . "' />
				</a>
			</div>";
        }
        else
        {
            $cwriter_text .= "<div style='float: right;width: 49%;text-align:right;'>&nbsp;</div>";
        }
        $cwriter_text .= "
		</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'><h4>" . CWRITER_51 . " " . $cw_chapter_number . "</h4></td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2' style='text-align:left;' >" . $tp->toHTML($cw_chapter_body, true) . "</td>
	</tr>
		<tr>
		<td class='forumheader3'  style='width:15%;' text-align:left;' >" . CWRITER_76 . "</td>
		<td class='forumheader3'  style='text-align:left;' >" . $tp->toHTML($cw_chapter_views, false) . "</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>";
        if ($cwriter_chapterid > 1)
        {
            $cwriter_chapter_prev = $cwriter_chapterid-1;
            $cwriter_text .= "
			<div style='float: left;width: 49%;text-align:left;'>
				<a href='" . e_SELF . "?0.chapter.$cwriter_bookid.$cwriter_chapter_prev'>
					<img src='./images/prev.png' style='border:0;' title='" . CWRITER_50 . "' alt='" . CWRITER_50 . "' />
				</a>
			</div>";
        }
        else
        {
            $cwriter_text .= "<div style='float: left;width: 49%;text-align:left;'>&nbsp;</div>";
        }
        if ($cwriter_chapterid < $cw_book_chapters)
        {
            $cwriter_chapter_next = $cwriter_chapterid + 1;
            $cwriter_text .= "
			<div style='float: right;width: 49%;text-align:right;'>
				<a href='" . e_SELF . "?0.chapter.$cwriter_bookid.$cwriter_chapter_next'>
					<img src='./images/next.png' style='border:0;' title='" . CWRITER_49 . "' alt='" . CWRITER_49 . "' />
				</a>
			</div>";
        }
        else
        {
            $cwriter_text .= "<div style='float: right;width: 49%;text-align:right;'>&nbsp;</div>";
        }
        $cwriter_text .= "
		</td>
	</tr>
</table>
</div>";
    }
    else
    {
        $cwriter_text .= "
<div class='ober-wrapper'>
<table class='fborder' style='width:100%'>
	<tr>
		<td class='fcaption' colspan='2'>" . CWRITER_52 . " - </td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>
			<a href='" . e_SELF . "?0.precis.$cwriter_bookid'>
				<img src='images/updir.png' style='border:0'  alt='" . CWRITER_69 . "' title='" . CWRITER_69 . "'/>
			</a>
		</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>" . CWRITER_70 . "</td>
	</tr>
	<tr>
		<td class='fcaption' colspan='2'>&nbsp;</td>
	</tr>
</table>
</div>";
    }
}

/* Individual fanfic book view / summary */
if ($action == "precis")
{
    $sql->db_Update("cw_book", "cw_book_views=cw_book_views+1 where cw_book_id=$cwriter_bookid", false);
    if (USER)
    {
        $cwriter_vlist = USERID ;
    }
    else
    {
        $cwriter_vlist = $e107->getip() ;
    }
    $cwriter_vlisting = $cwriter_vlist . ",";
    $sql->db_Update("cw_book", "cw_book_unique=cw_book_unique+1,
	cw_book_viewers=if(cw_book_viewers,concat(cw_book_viewers,'{$cwriter_vlisting}'),'{$cwriter_vlisting}')
	where (isnull(cw_book_viewers) or not find_in_set('{$cwriter_vlist}',cw_book_viewers))  and cw_book_id=$cwriter_bookid", false);
    $cwriter_arg = "select *,count(cw_review_id) as numreviews from #cw_book as b
	left join #cw_category as c on b.cw_book_category=c.cw_category_id
	left join #cw_genre as g on b.cw_book_genre=g.cw_genre_id
	left join #cw_review as r on r.cw_review_book=b.cw_book_id

	where cw_book_id='$cwriter_bookid'
	group by b.cw_book_id";
    if ($sql->db_Select_gen($cwriter_arg, false))
    {
        $cwriter_row = $sql->db_Fetch();
        extract($cwriter_row);
        $cwriter_text = "
<div class='ober-wrapper'>
<table class='fborder' style='width:100%'>
	<tr>
		<td class='fcaption' colspan='2'><h3 class='entry-title'>" . $tp->toHTML($cw_book_title) . "</h3></td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>
			<a href='" . e_SELF . "?0.show'>
				<img src='images/updir.png' style='border:0' alt='" . CWRITER_66 . "' title='" . CWRITER_66 . "' />
			</a>
		</td>
	</tr>";
        if (!empty($cw_book_logo) && is_readable("./pictures/" . $cw_book_logo))
        {
            $cwriter_text .= "
	<tr>
		<td class='forumheader2' style='text-align:center;' colspan='2'>
			<img src='./pictures/" . $cw_book_logo . "' style='border:0' alt='" . CWRITER_68 . "' title='" . CWRITER_68 . "'  />
		</td>
	</tr>";
        }
        $cwriter_text .= "
		<tr>
		<td class='forumheader2' style='text-align:center;' colspan='2'>" . CWRITER_304 . " ";
        for ($cwriter_i = 0;$cwriter_i < $cw_book_chapters;$cwriter_i++)
        {
            $cwriter_chapter = $cwriter_i + 1;
            $cwriter_text .= "<a href='" . e_SELF . "?0.chapter.$cwriter_bookid.$cwriter_chapter'>-$cwriter_chapter-</a>&nbsp;&nbsp;";
        }
        $cwriter_temp = explode(".", $cw_book_author, 2);
        $cw_book_author = "<a href='" . e_BASE . "user.php?id." . $cwriter_temp[0] . "' >" . $tp->toHTML($cwriter_temp[1]) . "</a>";
        $cwriter_text .= "</td>
	</tr>
	<tr>
		<td class='forumheader3 t-header' style='width:15%'>" . CWRITER_35 . "</td>
		<td class='forumheader3' >" . $tp->toHTML($cw_book_summary) . "&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3 t-header' style='width:15%'>" . CWRITER_36 . "</td>
		<td class='forumheader3' >" . $tp->toHTML($cw_category_name) . "&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3 t-header' style='width:15%'>" . CWRITER_37 . "</td>
		<td class='forumheader3' >" . $tp->toHTML($cw_genre_name) . "&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3 t-header' style='width:15%'>" . CWRITER_38 . "</td>
		<td class='forumheader3' >" . $cw_book_author . "&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3 t-header' style='width:15%'>" . CWRITER_40A . "</td>
		<td class='forumheader3' >" . $tp->toHTML($cw_book_warnings, true) . "&nbsp;</td>
	</tr>
		<tr>
		<td class='forumheader3 t-header' style='width:15%'>" . CWRITER_41 . "</td>
		<td class='forumheader3' >" . $tp->toHTML($cw_book_disclaimer, true) . "&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3 t-header' style='width:15%'>" . CWRITER_42 . "</td>
		<td class='forumheader3' >" . number_format($cw_book_wordcount) . " " . CWRITER_77 . "</td>
	</tr>
	<tr>
		<td class='forumheader3 t-header' style='width:15%'>" . CWRITER_43 . "</td>
		<td class='forumheader3' >" . $tp->toHTML($cw_book_chapters) . "</td>
	</tr>
		<tr>
		<td class='forumheader3 t-header' style='width:15%'>" . CWRITER_44 . "</td>
		<td class='forumheader3' >" . $cwriter_conv->convert_date($cw_book_created) . "</td>
	</tr>
		<tr>
		<td class='forumheader3 t-header' style='width:15%'>" . CWRITER_45 . "</td>
		<td class='forumheader3' >" . $cwriter_conv->convert_date($cw_book_lastupdate) . "</td>
	</tr>
	<tr>
		<td class='forumheader3 t-header' style='width:15%'>" . CWRITER_11 . "</td>
		<td class='forumheader3' >" . ($cw_book_complete == 1?"<img src='./images/approve.png' style='border:0;' alt='" . CWRITER_67 . "' title='" . CWRITER_67 . "' />":"&nbsp;") . "</td>
	</tr>
	<tr>
		<td class='forumheader3 t-header' style='width:15%'>" . CWRITER_48 . "</td>
		<td class='forumheader3' >" . $cw_book_views . " (" . CWRITER_59 . " $cw_book_unique)</td>
	</tr>";
        $cwriter_review = "<a href='" . e_SELF . "?0.review.$cw_book_id'>" . ($numreviews == 0?CWRITER_217:CWRITER_218) . "</a>";
        $cwriter_text .= "
	<tr>
		<td class='forumheader3 t-header' style='width:15%'>" . CWRITER_216 . "</td>
		<td class='forumheader3' >" . $cwriter_review . " </td>
	</tr>";
        if ($pref['cwriter_userating'] > 0)
        {
            $cwriter_rating .= "<tr><td class='forumheader3 rate-fanfic' colspan='2'>";
            if ($ratearray = $rater->getrating("cwbook", $cwriter_bookid))
            {
                for($c = 1;
                    $c <= $ratearray[1];
                    $c++)
                {
                    $cwriter_rating .= "<img src='images/star.png' alt='' />";
                }
                if ($ratearray[2])
                {
                    $cwriter_rating .= "<img src='images/" . $ratearray[2] . ".png'  alt='' />";
                }
                if ($ratearray[2] == "")
                {
                    $ratearray[2] = 0;
                }
                $cwriter_rating .= "<span class='smallblacktext'>&nbsp;" . $ratearray[1] . "." . $ratearray[2] . " - " . $ratearray[0] . "&nbsp;";
                $cwriter_rating .= "" . ($ratearray[0] == 1 ? CWRITER_54 : CWRITER_55) . "</span>";
            }
            else
            {
                $cwriter_rating .= CWRITER_57;
            }

            if (!$rater->checkrated("cwbook", $cwriter_bookid) && USER)
            {
                $cwriter_rating .= $rater->rateselect("&nbsp;&nbsp;&nbsp;&nbsp; <b>" . CWRITER_56, "cwbook", $cwriter_bookid) . "</b>";
            }
            else if (!USER)
            {
                $cwriter_rating .= "&nbsp;";
            }
            else
            {
                $cwriter_rating .= "&nbsp;<span class='smallblacktext'>" . CWRITER_58 . "</span>";
            }
            $cwriter_rating .= "&nbsp;</td></tr>";
            if ($cw_book_rate == 1 && $pref['cwriter_userating'] > 0)
            {
                $cwriter_text .= "$cwriter_rating";
            }
        }

        $cwriter_text .= "</table></div>";
        $comment_to = ($cw_book_comments == 1 && $pref['cwriter_usecomments'] == 1 ?$cwriter_bookid:0);
        $comment_sub = "Re: " . $tp->toFORM($cw_book_title, false);
    }
}

/* Main page */
if ($action == "show")
{
    session_start();
    if (!isset($_SESSION['cwriter_category']))
    {
        $_SESSION['cwriter_category'] = 0;
        $_SESSION['cwriter_genre'] = 0;
        $_SESSION['cwriter_characters'] = "";
        $_SESSION['cwriter_author'] = "";
        $_SESSION['cwriter_completion'] = 0;
    } elseif (!empty($_POST['dofilter']))
    {
        $_SESSION['cwriter_category'] = intval($_POST['cwriter_category']);
        $_SESSION['cwriter_genre'] = intval($_POST['cwriter_genre']);
        $_SESSION['cwriter_characters'] = $_POST['cwriter_characters'];
        $_SESSION['cwriter_author'] = $_POST['cwriter_author'];
        $_SESSION['cwriter_completion'] = intval($_POST['cwriter_completion']);
    }
    $cwriter_catsel = "
<select name='cwriter_category' class='tbox'>";
    if ($sql->db_Select("cw_category", "cw_category_id,cw_category_name", "where find_in_set(cw_category_class,'" . USERCLASS_LIST . "') or 1=1 order by cw_category_name", "nowhere", false))
    {
        $cwriter_catsel .= "<option value='0' >" . CWRITER_04 . "</option>";
        while ($cwriter_row = $sql->db_Fetch())
        {
            $cwriter_catsel .= "<option value='" . $cwriter_row['cw_category_id'] . "' " . ($_SESSION['cwriter_category'] == $cwriter_row['cw_category_id']?"selected='selected'":"") . " >" . $tp->toFORM($cwriter_row['cw_category_name']) . "</option>";
        } // while
    }
    else
    {
        $cwriter_catsel .= "<option value='' >" . CWRITER_03 . "</option>";
    }
    $cwriter_catsel .= "</select>";
    $cwriter_gensel = "
		<select name='cwriter_genre' class='tbox'>";
    if ($sql->db_Select("cw_genre", "cw_genre_id,cw_genre_name", " order by cw_genre_name", "nowhere", false))
    {
        $cwriter_gensel .= "<option value='0' >" . CWRITER_05 . "</option>";
        while ($cwriter_row = $sql->db_Fetch())
        {
            $cwriter_gensel .= "<option value='" . $cwriter_row['cw_genre_id'] . "'  " . ($_SESSION['cwriter_genre'] == $cwriter_row['cw_genre_id']?"selected='selected'":"") . " >" . $tp->toFORM($cwriter_row['cw_genre_name']) . "</option>";
        } // while
    }
    else
    {
        $cwriter_gensel .= "<option value='' >" . CWRITER_06 . "</option>";
    }
    $cwriter_gensel .= "</select>";
    $cwriter_charsel = "
		<select name='cwriter_characters' class='tbox selCharacters'>";
    if ($sql->db_Select("cw_book", "cw_book_characters", "", "nowhere", false))
    {
        $cwriter_charsel .= "<option value='' >" . CWRITER_07 . "</option>";
        while ($cwriter_row = $sql->db_Fetch())
        {
            $cwriter_charlist = explode(",", $cwriter_row['cw_book_characters']);
            foreach($cwriter_charlist as $cwriter_charname)
            {
                if (!empty($cwriter_charname))
                {
                    $cwriter_array[] = $cwriter_charname;
                }
            }
        } // while
        $cwriter_array = array_unique($cwriter_array);
        foreach($cwriter_array as $cwriter_name)
        {
            $cwriter_charsel .= "<option value='" . $tp->toFORM($cwriter_name) . "' " . ($_SESSION['cwriter_characters'] == $tp->toFORM($cwriter_name)?"selected='selected'":"") . "  >" . $tp->toFORM($cwriter_name) . "</option>";
        }
    }
    else
    {
        $cwriter_charsel .= "<option value='' >" . CWRITER_08 . "</option>";
    }
    $cwriter_charsel .= "</select>";
    $cwriter_authsel = "
		<select name='cwriter_author' class='tbox'>";
    $cwriter_arg = "select distinct cw_book_author from #cw_book order by substring(cw_book_author,locate('.',cw_book_author))";
    if ($sql->db_Select_gen($cwriter_arg, false))
    {
        $cwriter_authsel .= "<option value='0' >" . CWRITER_20 . "</option>";
        while ($cwriter_row = $sql->db_Fetch())
        {
            $cwriter_tmp = explode(".", $cwriter_row['cw_book_author'], 2);
            $cwriter_author = $cwriter_tmp[1];
            $cwriter_authsel .= "<option value='" . $cwriter_row['cw_book_author'] . "'  " . ($_SESSION['cwriter_author'] == $cwriter_row['cw_book_author']?"selected='selected'":"") . " >" . $tp->toFORM($cwriter_author) . "</option>";
        } // while
    }
    else
    {
        $cwriter_authsel .= "<option value='' >" . CWRITER_08 . "</option>";
    }
    $cwriter_authsel .= "</select>";
    $cwriter_compsel = "<select name='cwriter_completion' class='tbox' >
        <option value='0' " . ($_SESSION['cwriter_completion'] == 0?"selected='selected'":"") . "  >" . CWRITER_09 . "</option>
        <option value='1'  " . ($_SESSION['cwriter_completion'] == 1?"selected='selected'":"") . " >" . CWRITER_10 . "</option>
        <option value='2'  " . ($_SESSION['cwriter_completion'] == 2?"selected='selected'":"") . " >" . CWRITER_11 . "</option>
        </select>";
    // $cwriter_costsel = "<select name='cw_book_price' class='tbox' >
    // <option value='-1' >" . CWRITER_17 . "</option>
    // <option value='0' >" . CWRITER_18 . "</option>
    // <option value='1' >" . CWRITER_19 . "</option>
    // <option value='2' >" . CWRITER_20 . "</option>
    // </select>";
    $cwriter_text = "
<div class='ober-wrapper'>

	<div class='s-message alert alert-block fade in info  alert-info'>
		<i class='s-message-icon s-message-info'></i>
		<h4 class='s-message-title'>Want to submit your fanfiction?</h4>
		<div class='s-message-body'>
			<div class='s-message-item'>
				<p>Read our handy Fanfiction submission guide here: <a href='http://www.obernewtyn.net/e107/e107_plugins/forum/forum_viewtopic.php?id=148853'>Fanfiction FAQ</a>. If there are any problems or questions, please ask in that thread.</p>
			</div>
		</div>
	</div>



    <form action='" . e_SELF . "' method='post' id='cwform' >
<table class='fborder' style='width:100%' >
	<tr>
		<td class='forumheader2 small-mobile'><strong>" . CWRITER_12 . "</strong></td>
		<td class='forumheader2 small-mobile'><strong>" . CWRITER_13 . "</strong></td>";
		//<td class='fcaption'>" . CWRITER_14 . "</td>
		$cwriter_text .= "<td class='forumheader2 small-mobile'><strong>" . CWRITER_25 . "</strong></td>
		<td class='forumheader2 small-mobile'><strong>" . CWRITER_15 . "</strong></td>
		<td class='forumheader2 small-mobile'>&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3'>" . $cwriter_catsel . "</td>
		<td class='forumheader3'>" . $cwriter_gensel . "</td>";
		//<td class='forumheader3'>" . $cwriter_charsel . "</td>
		$cwriter_text .= "<td class='forumheader3'>" . $cwriter_authsel . "</td>
		<td class='forumheader3'>" . $cwriter_compsel . "</td>
		<td class='forumheader3'><input type='submit' class='button' name='dofilter' value='" . CWRITER_31 . "' /></td>
	</tr>
	</table>
	<table class='fborder list-fanfic' style='width:100%' >
	<tr>
		<td class='fcaption'><h3>" . CWRITER_02 . "</h3></td>
	</tr>
";
    // build up complex where for the filtering
    if (intval($_POST['cwriter_category']) > 0)
    {
        $cwriter_where .= " and cw_book_category=" . intval($_POST['cwriter_category']);
    }
    if (intval($_POST['cwriter_genre']) > 0)
    {
        $cwriter_where .= " and cw_book_genre=" . intval($_POST['cwriter_genre']);
    }
    switch (intval($_POST['cwriter_completion']))
    {
        case 1:
            $cwriter_where .= " and cw_book_complete=0";
            break;
        case 2:
            $cwriter_where .= " and cw_book_complete=1";
            break;
    }

    if (!empty($_POST['cwriter_author']))
    {
        $cwriter_where .= " and cw_book_author='" . $_POST['cwriter_author'] . "'";
    }
    if (!empty($_POST['cwriter_characters']))
    {
        $cwriter_where .= " and find_in_set('" . $_POST['cwriter_characters'] . "',cw_book_characters)";
    }
    // $_SESSION['cwriter_characters'] = $_POST['cwriter_characters'];
    $cwriter_arg = "
select * from #cw_book
left join #cw_category on cw_category_id=cw_book_category
left join #cw_genre on cw_genre_id=cw_book_genre
where cw_book_approved=1 and cw_book_visible=1 and find_in_set(cw_category_class,'" . USERCLASS_LIST . "')
$cwriter_where
order by cw_book_created desc";
    $cwriter_count = $sql->db_Select_gen($cwriter_arg, false);
    ($pref['cwriter_perpage'] > 0?$cwriter_arg .= " limit $cwriter_from," . $pref['cwriter_perpage']:"");
    if ($sql->db_Select_gen($cwriter_arg, false))
    {
        while ($cwriter_row = $sql->db_Fetch())
        {
            extract($cwriter_row);
            // If we use rating
            $cwriter_rating = "";
            if ($ratearray = $rater->getrating("cwbook", $cw_book_id))
            {
                for($c = 1;
                    $c <= $ratearray[1];
                    $c++)
                {
                    $cwriter_rating .= "<img src='images/star.png' alt='' />";
                }
                if ($ratearray[2])
                {
                    $cwriter_rating .= "<img src='images/" . $ratearray[2] . ".png'  alt='' />";
                }
                if ($ratearray[2] == "")
                {
                    $ratearray[2] = 0;
                }
                // $cwriter_rating .="&nbsp;" . $ratearray[1] . "." . $ratearray[2] . " - " . $ratearray[0] . "&nbsp;";
                // $cwriter_rating .=($ratearray[0]==1 ? RCPEMENU_89 : RCPEMENU_88);
            }
            else
            {
                $cwriter_rating .= "<span class='smalltext'>" . CWRITER_53 . "</span>";
            }

            $cwriter_tmp = explode(".", $cw_book_author, 2);
			$cwriter_writer = "<a href='" . e_BASE . "user.php?id." . $cwriter_tmp[0] . "' >" . $tp->toHTML($cwriter_tmp[1]) . "</a>";
			
$cwriter_text .= "
	<tr>
		<td class='forumheader2'>
			<h4 class='ff-title'><a href='" . e_SELF . "?$cwriter_from.precis.$cw_book_id'>" . $tp->toHTML($cw_book_title) . "</a> <span class='ff-author'>by " . $cwriter_writer . "</span></h4>
$cw_book_summary		
<div class='muted'>" . $cw_category_name . ", 
". $cw_genre_name . ",
" . CWRITER_29 .": " .$cw_book_chapters .",
Created " . $cwriter_conv->convert_date($cw_book_created, 'dd MM yyyy') .",
" . CWRITER_30 .": " . ($cw_book_complete > 0 ? "Yes":"No");

    if ($pref['cwriter_userating'] == 1 && $cw_book_rate == 1)
    {
        $cwriter_text .= "<br />$cwriter_rating";
    }            
            
    $cwriter_text .= "</div></td>
	</tr>";
        } // while
    }
    $cwriter_npaction = "show";
    $parms = $cwriter_count . "," . $pref['cwriter_perpage'] . "," . $cwriter_from . "," . e_SELF . '?' . "[FROM]." . $cwriter_npaction;
    $cwriter_nextprev = $tp->parseTemplate("{NEXTPREV={$parms}}") . "";
    $cwriter_text .= "
    <tr>
    	<td class='forumheader2'>
    	$cwriter_nextprev";
	$cwriter_text .="</td></tr>";
    if (check_class($pref['cwriter_admin']) || check_class($pref['cwriter_create']))
    {
        $cwriter_text .= "<tr><td class='forumheader2'><a href='mybooks.php' class='btn'>" . CWRITER_32 . "</a></td></tr>";
    }
    $cwriter_text .= "
</table>
</form>
</div>";

}
$ns->tablerender(CWRITER_01, $cwriter_text);
if ($comment_to > 0 && $pref['cwriter_usecomments'] > 0)
{
    $cwriter_com->compose_comment("cwbook", "comment", $comment_to, $width, $comment_sub, false);
}
require_once(FOOTERF);

?>