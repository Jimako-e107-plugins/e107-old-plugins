<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.3.2                                            //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002-2004 Gregory DEMAR                                     //
//  http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                        //
// (http://coppermine.sf.net/team/)                                          //
// see /docs/credits.html for details                                        //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
// ------------------------------------------------------------------------- //

// HTML template for main menu
$index_link=e_PLUGIN."coppermine_menu/index.php";
$fav_link = (USER === TRUE) ? "<a href='{FAV_TGT}'>{FAV_LNK}</a>" : "";

$template_main_menu = <<<EOT
          <div class="topmenu admin_menu">
<!-- BEGIN album_list -->
                <a href="{$index_link}" title="{ALB_LIST_TITLE}">{ALB_LIST_LNK}</a>
<!-- END album_list -->
<!-- BEGIN my_gallery -->
                        <a href="{MY_GAL_TGT}" title="{MY_GAL_TITLE}">{MY_GAL_LNK}</a>
<!-- END my_gallery -->
<!-- BEGIN allow_memberlist -->
	<!-- not for e107 <a href="{MEMBERLIST_TGT}" title="{MEMBERLIST_TITLE}">{MEMBERLIST_LNK}</a> -->
<!-- END allow_memberlist -->
<!-- BEGIN my_profile -->
                        <a href="{MY_PROF_TGT}">{MY_PROF_LNK}</a>
<!-- END my_profile -->
<!-- BEGIN faq -->
                        <a href="{FAQ_TGT}" title="{FAQ_TITLE}">{FAQ_LNK}</a>
<!-- END faq -->
<!-- BEGIN enter_admin_mode -->
                        <a href="{ADM_MODE_TGT}" title="{ADM_MODE_TITLE}">{ADM_MODE_LNK}</a>
<!-- END enter_admin_mode -->
<!-- BEGIN leave_admin_mode -->
                        <a href="{USR_MODE_TGT}" title="{USR_MODE_TITLE}">{USR_MODE_LNK}</a>
<!-- END leave_admin_mode -->
<!-- BEGIN upload_pic -->
                        <a href="{UPL_PIC_TGT}" title="{UPL_PIC_TITLE}">{UPL_PIC_LNK}</a>
<!-- END upload_pic -->
<!-- BEGIN register -->
                        <a href="{REGISTER_TGT}" title="{REGISTER_TITLE}">{REGISTER_LNK}</a>
<!-- END register -->
<!-- BEGIN login -->
<!-- END login -->
<!-- BEGIN logout -->
<!-- END logout -->
                        <br />
                        <a href="{LASTUP_TGT}">{LASTUP_LNK}</a>
                        <a href="{LASTCOM_TGT}">{LASTCOM_LNK}</a>
                        <a href="{TOPN_TGT}">{TOPN_LNK}</a>
                        <a href="{TOPRATED_TGT}">{TOPRATED_LNK}</a>
                        {$fav_link}
                        <a href="{SEARCH_TGT}">{SEARCH_LNK}</a>
                </div>
EOT;
// HTML template for gallery admin menu
$template_gallery_admin_menu = <<<EOT

                <div class="admin_menu">
                <!--<table cellpadding="0" cellspacing="1"> <tr>-->
                                <a href="editpics.php?mode=upload_approval" title="">{UPL_APP_LNK}</a>
                                <a href="config.php" title="">{CONFIG_LNK}</a>
                                <a href="albmgr.php{CATL}" title="">{ALBUMS_LNK}</a>
                                <a href="catmgr.php" title="">{CATEGORIES_LNK}</a>
                                <a href="usermgr.php" title="">{USERS_LNK}</a>
                                <a href="groupmgr.php" title="">{GROUPS_LNK}</a>
                                <a href="banning.php" title="">{BAN_LNK}</a>
                                <a href="db_ecard.php" title="">{DB_ECARD_LNK}</a>
                                <a href="reviewcom.php" title="">{COMMENTS_LNK}</a>
                                <a href="searchnew.php" title="">{SEARCHNEW_LNK}</a>
                                <a href="util.php" title="">{UTIL_LNK}</a>
 <!--                               <a href="profile.php?op=edit_profile" title="">{MY_PROF_LNK}</a>-->
                        <!--</tr></table>-->
                </div>

EOT;
//                         <a href="profile.php?op=edit_profile" title="">{MY_PROF_LNK}</a>


// HTML template for user admin menu
$template_user_admin_menu = <<<EOT
                     <div class="admin_menu">
                                <a href="albmgr.php" title="">{ALBMGR_LNK}</a>
                                <a href="modifyalb.php" title="">{MODIFYALB_LNK}</a>
</div>
EOT;
//                                 <<a href="profile.php?op=edit_profile" title="">{MY_PROF_LNK}</a>


// HTML template for the category list
$template_cat_list = <<<EOT
<!-- BEGIN header -->
        <tr>
                <td class="fcaption" width="80%"><b>{CATEGORY}</b></td>
                <td class="fcaption" width="10%" align="center"><b>{ALBUMS}</b></td>
                <td class="fcaption" width="10%" align="center"><b>{PICTURES}</b></td>
        </tr>
<!-- END header -->
<!-- BEGIN catrow_noalb -->
        <tr>
                <td class="tableh2" colspan="3"><table border="0" ><tr><td>{CAT_THUMB}</td><td><span class="catlink"><b>{CAT_TITLE}</b></span>{CAT_DESC}</td></tr></table></td>
        </tr>
<!-- END catrow_noalb -->
<!-- BEGIN catrow -->
        <tr>
                <td class="forumheader2"><table border="0"><tr><td>{CAT_THUMB}</td><td><span class="catlink"><b>{CAT_TITLE}</b></span>{CAT_DESC}</td></tr></table></td>
                <td class="forumheader2" align="center">{ALB_COUNT}</td>
                <td class="forumheader2" align="center">{PIC_COUNT}</td>
        </tr>
     <!--if (isset(CAT_ALBUMS)){-->
          <tr>
            <td class="forumheader2" colspan=3>{CAT_ALBUMS}</td>
      </tr><!--};-->
<!-- END catrow -->
<!-- BEGIN footer -->
        <tr>
                <td colspan="3" class="fcaption" align="center"><span class="statlink"><b>{STATISTICS}</b></span></td>
        </tr>
<!-- END footer -->
<!-- BEGIN spacer -->
        <img src="images/spacer.gif" width="1" height="17" /><br />
<!-- END spacer -->

EOT;
// HTML template for the breadcrumb
$template_breadcrumb = <<<EOT
<!-- BEGIN breadcrumb -->
        <tr>
                <td colspan="3" class="fcaption"><span class="statlink" style='white-space:nowrap'>{BREADCRUMB}</span></td>
        </tr>
<!-- END breadcrumb -->
<!-- BEGIN breadcrumb_user_gal -->
        <tr>
                <td colspan="3" class="fcaption">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                        <td><span class="statlink"><b>{BREADCRUMB}</b></span></td>
                        <td align="right"><span class="statlink"><b>{STATISTICS}</b></span></td>
                </tr>
                </table>
                </td>
        </tr>
<!-- END breadcrumb_user_gal -->

EOT;
// HTML template for the album list
$template_album_list = <<<EOT

<!-- BEGIN stat_row -->
        <tr>
                <td colspan="{COLUMNS}" class="fcaption" align="center"><span class="statlink">{STATISTICS}</span></td>
        </tr>
<!-- END stat_row -->
<!-- BEGIN header -->
        <tr>
<!-- END header -->
<!-- BEGIN album_cell -->
        <td width="{COL_WIDTH}%" height="100%" valign="top">
        <table width="100%" height="100%" cellspacing="0" cellpadding="0">
        <tr>
                <td colspan="3" height="1" valign="top" class="tableh2">
                        <a href="{ALB_LINK_TGT}" class="alblink"><b>{ALBUM_TITLE}</b></a>
                </td>
        </tr>
        <tr>
                <td colspan="3">
                        <img src="images/spacer.gif" width="1" height="1"><br />
                </td>
        </tr>
        <tr height="100%">
                <td align="center" height="100%" valign="middle" class="forumheader2">
                        <img src="images/spacer.gif" width="{THUMB_CELL_WIDTH}" height="1" class="image" style="margin-top: 0px;
 margin-bottom: 0px; border: none;"><br />
<a href="{ALB_LINK_TGT}" class="albums">{ALB_LINK_PIC}<br /></a>
                </td>
                <td height="100%">
                        <img src="images/spacer.gif" width="1" height="1">
                </td>
                <td width="100%" height="100%" valign="top" class="forumheader2">
                        {ADMIN_MENU}
                        <p>{ALB_DESC}</p>
                        <p class="album_stat">{ALB_INFOS}</p>
                </td>
        </tr>
        </table>
        </td>
<!-- END album_cell -->
<!-- BEGIN empty_cell -->
        <td width="{COL_WIDTH}%" height="100%" valign="top">
        <table width="100%" height="100%" cellspacing="0" cellpadding="0">
        <tr>
                <td height="1" valign="top" class="tableh2">
                        <b>&nbsp;</b>
                </td>
        </tr>
        <tr>
                <td>
                        <img src="images/spacer.gif" width="1" height="1"><br />
                </td>
        </tr>
        <tr height="100%">
                <td width="100%" height="100%" valign="top" class="forumheader2">
                        &nbsp;
                </td>
        </tr>
        </table>
        </td>
<!-- END empty_cell -->
<!-- BEGIN row_separator -->
        </tr>
        <tr>
<!-- END row_separator -->
<!-- BEGIN footer -->
        </tr>
<!-- END footer -->
<!-- BEGIN tabs -->
        <tr>
                <td colspan="{COLUMNS}" style="padding: 0px;">
                        <table width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                        {TABS}
                                </tr>
                        </table>
                </td>
        </tr>
<!-- END tabs -->
<!-- BEGIN spacer -->
        <img src="images/spacer.gif" width="1" height="17" /><br />
<!-- END spacer -->

EOT;
// HTML template for filmstrip display
$template_film_strip = <<<EOT

        <!-- <tr>
         <td valign="top" align="center" height='30'>&nbsp;</td>
        </tr> -->
        <tr>
        <td valign="bottom" class="thumbnails" align="center">
          {THUMB_STRIP}
        </td>
        </tr>
        <!-- <tr>
         <td valign="top" align="center" height='30'>&nbsp;</td>
        </tr> -->
<!-- BEGIN thumb_cell -->
                          <a href="{LINK_TGT}">{THUMB}</a>&nbsp;
                                        {CAPTION}
                                        {ADMIN_MENU}
<!-- END thumb_cell -->
<!-- BEGIN empty_cell -->
                <td valign="top" align="center" >1&nbsp;</td>
<!-- END empty_cell -->

EOT;
// HTML template for the album list
$template_album_list_cat = <<<EOT

<!-- BEGIN c_stat_row -->
        <tr>
                <td colspan="{COLUMNS}" class="tableh1" align="center"><span class="statlink"><b>{STATISTICS}</b></span></td>
        </tr>
<!-- END c_stat_row -->
<!-- BEGIN c_header -->
        <tr>
<!-- END c_header -->
<!-- BEGIN c_album_cell -->
        <td width="{COL_WIDTH}%" height="100%" valign="top">
        <table width="100%" height="100%" cellspacing="0" cellpadding="0">
        <tr>
                <td colspan="3" height="1" valign="top" class="tableh2">
                        <a href="{ALB_LINK_TGT}" class="alblink"><b>{ALBUM_TITLE}</b></a>
                </td>
        </tr>
        <tr>
                <td colspan="3">
                        <img src="images/spacer.gif" width="1" height="1"><br />
                </td>
        </tr>
        <tr height="100%">
                <td align="center" height="100%" valign="middle" class="thumbnails">
                        <img src="images/spacer.gif" width="{THUMB_CELL_WIDTH}" height="1" class="image" style="margin-top: 0px;
 margin-bottom: 0px; border: none;"><br />
<a href="{ALB_LINK_TGT}" class="albums">{ALB_LINK_PIC}<br /></a>
                </td>
                <td height="100%">
                        <img src="images/spacer.gif" width="1" height="1">
                </td>
                <td width="100%" height="100%" valign="top" class="tableb_compact">
                        {ADMIN_MENU}
                        <p>{ALB_DESC}</p>
                        <p class="album_stat">{ALB_INFOS}</p>
                </td>
        </tr>
        </table>
        </td>
<!-- END c_album_cell -->
<!-- BEGIN c_empty_cell -->
        <td width="{COL_WIDTH}%" height="100%" valign="top">
        <table width="100%" height="100%" cellspacing="0" cellpadding="0">
        <tr>
                <td height="1" valign="top" class="tableh2">
                        <b>&nbsp;</b>
                </td>
        </tr>
        <tr>
                <td>
                        <img src="images/spacer.gif" width="1" height="1"><br />
                </td>
        </tr>
        <tr height="100%">
                <td width="100%" height="100%" valign="top" class="tableb_compact">
                        &nbsp;
                </td>
        </tr>
        </table>
        </td>
<!-- END c_empty_cell -->
<!-- BEGIN c_row_separator -->
        </tr>
        <tr>
<!-- END c_row_separator -->
<!-- BEGIN c_footer -->
        </tr>
<!-- END c_footer -->
<!-- BEGIN c_tabs -->
        <tr>
                <td colspan="{COLUMNS}" style="padding: 0px;">
                        <table width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                        {TABS}
                                </tr>
                        </table>
                </td>
        </tr>
<!-- END c_tabs -->
<!-- BEGIN c_spacer -->
        <img src="images/spacer.gif" width="1" height="17" /><br />
<!-- END c_spacer -->

EOT;
// HTML template for the ALBUM admin menu displayed in the album list
$template_album_admin_menu = <<<EOT
                                <div class="admin_menu">
                                <a href="delete.php?id={ALBUM_ID}&what=album" onclick="return confirm('{CONFIRM_DELETE}');">{DELETE}</a>
                                <a href="modifyalb.php?album={ALBUM_ID}">{MODIFY}</a>
                                <a href="editpics.php?album={ALBUM_ID}">{EDIT_PICS}</a>
</div>

EOT;
// HTML template for title row of the thumbnail view (album title + sort options)
$template_thumb_view_title_row = <<<EOT

                        <table style='width:100%'>
			<tr>
                                <td class="forumheader"><span class='mediumtext'>{ALBUM_NAME}</span></td>
<td><img src="images/spacer.gif" width="1"></td>
                          <td class='tbox' style='text-align:left'>
                                        <table height="100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                <td class="forumheader3">{TITLE}</td>
                                <td class="forumheader3"><span class="statlink"><a href="thumbnails.php?album={AID}&page={PAGE}&sort=ta" title="{SORT_TA}">&nbsp;+&nbsp;</a></span></td>
                                <td class="forumheader3"><span class="statlink"><a href="thumbnails.php?album={AID}&page={PAGE}&sort=td" title="{SORT_TD}">&nbsp;-&nbsp;</a></span></td>
                                        </tr>
                                    <tr style='text-align:left'>
                                                <td class="forumheader3"><span class="smalltext"><nobr>{NAME}</nobr></span></td>
                                                <td class="forumheader3"><span class="statlink"><a href="thumbnails.php?album={AID}&page={PAGE}&sort=na" title="{SORT_NA}">&nbsp;+&nbsp;</a></span></td>
                                                <td class="forumheader3"><span class="statlink"><a href="thumbnails.php?album={AID}&page={PAGE}&sort=nd" title="{SORT_ND}">&nbsp;-&nbsp;</a></span></td>
  </tr>
  <tr>
                                                <td class="forumheader3"><span class="smalltext">{DATE}</span></td>
                                                <td class="forumheader3"><span class="statlink"><a href="thumbnails.php?album={AID}&page={PAGE}&sort=da" title="{SORT_DA}">&nbsp;+&nbsp;</a></span></td>
                                                <td class="forumheader3"><span class="statlink"><a href="thumbnails.php?album={AID}&page={PAGE}&sort=dd" title="{SORT_DD}">&nbsp;-&nbsp;</a></span></td>
                                        </tr>
                                        </table>
                                </td>
                        </tr>
                        </table>

EOT;


// HTML template for title row of the fav thumbnail view (album title + download)
$template_fav_thumb_view_title_row = <<<EOT

                        <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                                <td width="100%" class="statlink"><h2>{ALBUM_NAME}</h2></td>
                                <td><img src="images/spacer.gif" width="1"></td>
                                <td class="forumheader"><span class='mediumtext'>
                                        <table height="100%" cellpadding="0" cellspacing="0">
                                                <tr>
                                                        <td class="sortorder_options"><span class="statlink"><a href="zipdownload.php">{DOWNLOAD_ZIP}</a></span></td>
                                                </tr>
                                                </table>
                                </span></td>
                        </tr>
                        </table>

EOT;


// HTML template for thumbnails display
$template_thumbnail_view = <<<EOT

<!-- BEGIN header -->
        <tr>
<!-- END header -->
<!-- BEGIN thumb_cell -->
        <td valign="top" class="forumheader2" width ="{CELL_WIDTH}" align="center">
                <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                                <td align="center" style="text-align:center">
                                        <a href="{LINK_TGT}">{THUMB}<br /></a>
                                        {CAPTION}
                                        {ADMIN_MENU}
                                </td>
                        </tr>
                </table>
        </td>
<!-- END thumb_cell -->
<!-- BEGIN empty_cell -->
                <td valign="top" class="forumheader2" align="center">&nbsp;</td>
<!-- END empty_cell -->
<!-- BEGIN row_separator -->
        </tr>
        <tr>
<!-- END row_separator -->
<!-- BEGIN footer -->
        </tr>
<!-- END footer -->
<!-- BEGIN tabs -->
        <tr>
                <td colspan="{THUMB_COLS}" style="padding: 0px;">
                        <table width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                        {TABS}
                                </tr>
                        </table>
                </td>
        </tr>
<!-- END tabs -->
<!-- BEGIN spacer -->
        <img src="images/spacer.gif" width="1" height="17" /><br />
<!-- END spacer -->

EOT;
// HTML template for the thumbnail view when there is no picture to show
$template_no_img_to_display = <<<EOT
        <tr>
                <td class="forumheader2" height="200" align="center">
                        <font size="3"><b>{TEXT}</b></font>
                </td>
        </tr>
<!-- BEGIN spacer -->
        <img src="images/spacer.gif" width="1" height="17" /><br />
<!-- END spacer -->

EOT;
// HTML template for the USER info box in the user list view
$template_user_list_info_box = <<<EOT

        <table cellspacing="1" cellpadding="0" border="0" width="100%" class="user_thumb_infobox">
                <tr>
                        <th><a href="profile.php?uid={USER_ID}">{USER_NAME}</a></th>
                </tr>
                <tr>
                        <td>{ALBUMS}</td>
                </tr>
                <tr>
                        <td>{PICTURES}</td>
                </tr>
        </table>

EOT;
// HTML template for the image navigation bar
$template_img_navbar = <<<EOT

        <tr>
                <td align="center" valign="middle" class="forumheader3" width="48">
                        <a href="{THUMB_TGT}" class="navmenu_pic" title="{THUMB_TITLE}"><img src="images/folder.gif" width="16" height="16" align="absmiddle" border="0" alt="{THUMB_TITLE}" /></a>
                </td>
                <td align="center" valign="middle" class="forumheader3" width="48">
                        <a href="javascript:;" onClick="blocking('picinfo','yes', 'block'); return false;" title="{PIC_INFO_TITLE}"><img src="images/info.gif" width="16" height="16" border="0" align="absmiddle" alt="{PIC_INFO_TITLE}" /></a>
                </td>
                <td align="center" valign="middle" class="forumheader3" width="48">
                        <a href="{SLIDESHOW_TGT}" title="{SLIDESHOW_TITLE}"><img src="images/slideshow.gif" width="16" height="16" border="0" align="absmiddle" alt="{SLIDESHOW_TITLE}" /></a>
                </td>
                <td align="center" valign="middle" class="forumheader" style="text-align:center" width="100%">
                        {PIC_POS}
                </td>
                <td align="center" valign="middle" class="forumheader3" width="48">
                        <a href="{ECARD_TGT}" title="{ECARD_TITLE}"><img src="images/ecard.gif" width="16" height="16" border="0" align="absmiddle" alt="{ECARD_TITLE}"></a>
                </td>
                <td align="center" valign="middle" class="forumheader3" width="48">
                        <a href="{PREV_TGT}" class="navmenu_pic" title="{PREV_TITLE}"><img src="images/prev.gif" width="16" height="16" border="0" align="absmiddle" alt="{PREV_TITLE}" /></a>
                </td>
                <td align="center" valign="middle" class="forumheader3" width="48">
                        <a href="{NEXT_TGT}" class="navmenu_pic" title="{NEXT_TITLE}"><img src="images/next.gif" width="16" height="16" border="0" align="absmiddle" alt="{NEXT_TITLE}" /></a>
                </td>
        </tr>

EOT;
// HTML template for intermediate image display
$template_display_picture = <<<EOT
        <tr>
                <td align="center" class="forumheader2" height="{CELL_HEIGHT}" style="white-space: nowrap; padding: 0px;">
                        <table align="center" cellspacing="2" cellpadding="0" style="border: 1px solid #000000; background-color: #FFFFFF; margin-top: 5px; margin-bottom: 5px;">
                                <tr>
                                        <td  align="center">
                                                {IMAGE}
                                                {ADMIN_MENU}
                                        </td>
                                </tr>
                        </table>
<!-- BEGIN img_desc -->
                        <table cellpadding="0" cellspacing="0" class="img_caption_table">
<!-- BEGIN title -->
                                <tr>
                                        <th>
                                                {TITLE}
                                        </th>
                                </tr>
<!-- END title -->
<!-- BEGIN caption -->
                                <tr>
                                        <td>
                                                {CAPTION}
                                        </td>
                                </tr>
<!-- END caption -->
                        </table>
<!-- END img_desc -->
                </td>
        </tr>

EOT;
// HTML template for the image rating box
$template_image_rating = <<<EOT

        <tr>
                <td colspan="6" class="tableh2_compact"><b>{TITLE}</b> {VOTES}</td>
        </tr>
        <tr>
                <td class="forumheader2" width="16%" align="center"><a href="{RATE0}" title="{RUBBISH}"><img src="images/rating0.gif" alt="{RUBBISH}" border="0" /><br /></a></td>
                <td class="forumheader2" width="16%" align="center"><a href="{RATE1}" title="{POOR}"><img src="images/rating1.gif" alt="{POOR}" border="0" /><br /></a></td>
                <td class="forumheader2" width="16%" align="center"><a href="{RATE2}" title="{FAIR}"><img src="images/rating2.gif" alt="{FAIR}" border="0" /><br /></a></td>
                <td class="forumheader2" width="16%" align="center"><a href="{RATE3}" title="{GOOD}"><img src="images/rating3.gif" alt="{GOOD}" border="0" /><br /></a></td>
                <td class="forumheader2" width="16%" align="center"><a href="{RATE4}" title="{EXCELLENT}"><img src="images/rating4.gif" alt="{EXCELLENT}" border="0" /><br /></a></td>
                <td class="forumheader2" width="16%" align="center"><a href="{RATE5}" title="{GREAT}"><img src="images/rating5.gif" alt="{GREAT}" border="0" /><br /></a></td>
        </tr>

EOT;
// HTML template for the display of comments
$template_image_comments = <<<EOT

        <tr>
                <td>
                        <table width="100%" cellpadding="0" cellspacing="0">
                                <td class="tableh2_compact" nowrap>
                                        <b>{MSG_AUTHOR}</b>
<!-- BEGIN ipinfo -->
                                                                                 ({HDR_IP} [{RAW_IP}])
<!-- END ipinfo -->
                                </td>
                                <td class="tableh2_compact" align="right" width="100%">
<!-- BEGIN buttons -->
                                        <a href="javascript:;" onClick="blocking('cbody{MSG_ID}','', 'block'); blocking('cedit{MSG_ID}','', 'block'); return false;" title="{EDIT_TITLE}"><img src="images/edit.gif" border="0" align="absmiddle" ></a>
                                        <a href="delete.php?msg_id={MSG_ID}&what=comment"  onclick="return confirm('{CONFIRM_DELETE}');"><img src="images/delete.gif" border="0" align="absmiddle" ></a>
<!-- END buttons -->
                                </td>
                                <td class="tableh2_compact" align="right" nowrap>
                                        <span class="comment_date">[{MSG_DATE}]</span>
                                </td>
                        </table>
                </td>
        </tr>
        <tr>
                <td class="forumheader2">
                        <div id="cbody{MSG_ID}" style="display:block">
                                {MSG_BODY}
                        </div>
                        <div id="cedit{MSG_ID}" style="display:none">
<!-- BEGIN edit_box_smilies -->
                                <table width="100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                                <form name="f{MSG_ID}" method="POST" action="db_input.php">
                                                <input type="hidden" name="event" value="comment_update">
                                                <input type="hidden" name="msg_id" value="{MSG_ID}">
                                                <tr>
                                                <td>
                                                   <input type="text" name="msg_author" value="{MSG_AUTHOR}" class="textinput" size="25">
                                                </td>
                                                </tr>
                                                <tr>
                                                <td width="80%">
                                                        <textarea cols="40" rows="2" class="textinput" name="msg_body" onselect="storeCaret_f{MSG_ID}(this);" onclick="storeCaret_f{MSG_ID}(this);" onkeyup="storeCaret_f{MSG_ID}(this);" style="width: 100%;">{MSG_BODY_RAW}</textarea>
                                                </td>
                                                <td class="forumheader2">
                                                </td>
                                                <td>
                                                        <input type="submit" class="comment_button" name="submit" value="{OK}">
                                                </td>
                                                </form>
                                        </tr>
                                        <tr>
                                                <td colspan="3"><img src="images/spacer.gif" width="1" height="2" /><br /></td>
                                        </tr>
                                </table>
                                {SMILIES}
<!-- END edit_box_smilies -->
<!-- BEGIN edit_box_no_smilies -->
                                <table width="100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                                <form name="f{MSG_ID}" method="POST" action="db_input.php">
                                                <input type="hidden" name="event" value="comment_update">
                                                <input type="hidden" name="msg_id" value="{MSG_ID}">
                                                <td>
                                                <input type="text" name="msg_author" value="{MSG_AUTHOR}" class="textinput" size="25">
                                                </td>
                                        </tr>
                                        <tr>
                                                <td width="100%">
                                                        <textarea cols="40" rows="2" class="textinput" name="msg_body" style="width: 100%;">{MSG_BODY_RAW}</textarea>
                                                </td>
                                                <td class="forumheader2">
                                                </td>
                                                <td>
                                                        <input type="submit" class="comment_button" name="submit" value="{OK}">
                                                </td>
                                                </form>
                                        </tr>
                                        <tr>
                                                <td colspan="3"><img src="images/spacer.gif" width="1" height="2" /><br /></td>
                                        </tr>
                                </table>
<!-- END edit_box_no_smilies -->
                        </div>
                </td>
        </tr>

EOT;

$template_add_your_comment = <<<EOT

        <tr>
                <td class="tableh2_compact"><b>{ADD_YOUR_COMMENT}</b></td>
        </tr>
        <tr>
                <form method="post" name="post" action="db_input.php">
                <td colspan="3">
                        <table width="100%" cellpadding="0" cellspacing="0">
                                <input type="hidden" name="event" value="comment">
                                <input type="hidden" name="pid" value="{PIC_ID}">
<!-- BEGIN user_name_input -->
                                <td class="forumheader2">
                                        {NAME}
                                </td>
                                <td class="tableb_compact">
                                        <input type="text" class="textinput" name="msg_author" size="10" maxlength="20" value={USER_NAME}>
                                </td>
<!-- END user_name_input -->
<!-- BEGIN input_box_smilies -->
                                <td class="forumheader2">
                                {COMMENT} </td>
                               <td width="100%" class="forumheader2">
                                <input type="text" class="textinput" id="message" name="msg_body" onselect="storeCaret_post(this);" onclick="storeCaret_post(this);" onkeyup="storeCaret_post(this);" maxlength="{MAX_COM_LENGTH}" style="width: 100%;">                                        <!-- END input_box_smilies -->
<!-- BEGIN input_box_no_smilies -->
                                <input type="text" class="textinput" id="message" name="msg_body"  maxlength="{MAX_COM_LENGTH}" style="width: 100%;">
<!-- END input_box_no_smilies -->
                                </td>
                                <td class="forumheader2">
                                <input type="submit" class="comment_button" name="submit" value="{OK}">
                                </td>
                        </table>
                </td>
                </form>
        </tr>
<!-- BEGIN smilies -->
        <tr>
                <td width="100%" class="forumheader2">
                        {SMILIES}
                </td>
        </tr>
<!-- END smilies -->

EOT;
// HTML template used by the cpg_die function
$template_cpg_die = <<<EOT

        <tr>
              <td class="forumheader2" height="100" align="center">
                        <font size="3"><b>{MESSAGE}</b></font>
<!-- BEGIN file_line -->
                        <br />
                        <br />
                        {FILE_TXT}{FILE} - {LINE_TXT}{LINE}
<!-- END file_line -->
<!-- BEGIN output_buffer -->
                        <br />
                        <br />
                        <div align="left">
                                {OUTPUT_BUFFER}
                        </div>
<!-- END output_buffer -->
                        <br /><br />
                </td>
        </tr>


EOT;
// HTML template used by the msg_box function
$template_msg_box = <<<EOT

        <tr>
              <td class="forumheader2" height="50" align="center">
                        <font size="3"><b>{MESSAGE}</b></font>
                </td>
        </tr>
<!-- BEGIN button -->
                <tr>
                        <td align="center" class="tablef">
                                <table cellpadding="0" cellspacing="0">
                                        <tr>
                                                <td class="admin_menu">
                                                        <a href="{LINK}">{TEXT}</a>
                                                </td>
                                        </tr>
                                </table>
                        </td>
                </tr>
<!-- END button -->

EOT;
// HTML template for e-cards
$template_ecard = <<<EOT
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html dir="{LANG_DIR}">
<head>
<title>{TITLE}</title>
<meta http-equiv="content-type" content="text/html; charset={CHARSET}" />
</head>
<body bgcolor="#FFFFFF" text="#0F5475" link="#0F5475" vlink="#0F5475" alink="#0F5475">
<br />
<p align="center"><a href="{VIEW_ECARD_TGT}"><b>{VIEW_ECARD_LNK}</b></a></p>
<table border="0" cellspacing="0" cellpadding="1" align="center">
  <tr>
    <td bgcolor="#000000">
      <table border="0" cellspacing="0" cellpadding="10" bgcolor="#ffffff">
        <tr>
          <td valign="top">
           <img src="{PIC_URL}" border="1" alt="" /><br />
          </td>
          <td valign="top" width="200" height="250">
            <div align="right"><img src="{URL_PREFIX}images/stamp.gif" alt="" border="0" /></div>
            <br />
            <b><font face="arial" color="#000000" size="4">{GREETINGS}</font></b>
            <br />
            <br />
            <font face="arial" color="#000000" size="2">{MESSAGE}</font>
            <br />
            <br />
            <font face="arial" color="#000000" size="2">{SENDER_NAME}</font>
            (<a href="mailto:{SENDER_EMAIL}"><font face="arial" color="#000000" size="2">{SENDER_EMAIL}</font></a>)
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<p align="center"><a href="{VIEW_MORE_TGT}"><b>{VIEW_MORE_LNK}</b></a></p>
</body>
</html>
EOT;
// Template used for tabbed display
$template_tab_display = array('left_text' => '<td width="100%%" align="left" valign="middle" class="fcaption_compact" style="white-space: nowrap">{LEFT_TEXT}</td>'."\n",
                'tab_header' => '',
                'tab_trailer' => '',
                'active_tab' => '<td><img src="images/spacer.gif" width="1" height="1"></td>'."\n".'<td align="center" valign="middle" class="forumheader2"><b>%d</b></td>',
                'inactive_tab' => '<td><img src="images/spacer.gif" width="1" height="1"></td>'."\n".'<td align="center" valign="middle" class="navmenu"><a href="{LINK}"><b>%d</b></a></td>'."\n"
);

function pageheader($section, $meta = '')
{
        global $CONFIG, $THEME_DIR;
        global $template_header, $lang_charset, $lang_text_dir;
        static $headercount=0;

        if ($headercount!=0) return;  // Can be called twice when cpg_die();
        $headercount++;

    $charset = ($CONFIG['charset'] == 'language file') ? $lang_charset : $CONFIG['charset'];

        header('P3P: CP="CAO DSP COR CURa ADMa DEVa OUR IND PHY ONL UNI COM NAV INT DEM PRE"');
   			header("Content-Type: text/html; charset=$charset");
        user_save_profile();

        $template_vars = array('{LANG_DIR}' => $lang_text_dir,
               '{TITLE}' => $CONFIG['gallery_name'].' - '.$section,
                '{CHARSET}' => $charset,
                '{META}' => $meta,
                '{GAL_NAME}' => $CONFIG['gallery_name'],
                '{GAL_DESCRIPTION}' => $CONFIG['gallery_description'],
                '{MAIN_MENU}' => theme_main_menu(),
                '{ADMIN_MENU}' => theme_admin_mode_menu()
        );

        echo template_eval($template_header, $template_vars);
}

// Function for writing a pagefooter
function pagefooter()
{
        global $HTTP_GET_VARS, $HTTP_POST_VARS, $HTTP_SERVER_VARS;
    global $USER, $USER_DATA, $ALBUM_SET, $CONFIG, $time_start, $query_stats, $queries;;
        global $template_footer;

    if ($CONFIG['debug_mode']==1 || ($CONFIG['debug_mode']==2 && GALLERY_ADMIN_MODE)) {
    cpg_debug_output();
        }

        echo $template_footer;
        if(UDB_INTEGRATION=="e107"){

             require_once(FOOTERF);
             $sql_cpg = new db;
             $sql_cpg -> db_Connect($mySQLserver, $mySQLuser, $mySQLpassword, $mySQLdefaultdb);

        }
}
// Function to start a 'standard' table
function starttable($width = '-1', $title='', $title_colspan='1')
{
        global $CONFIG;

        if ($width == '-1' )   $width = $CONFIG['picture_table_width'];
        if ($width == '100%' ) $width = $CONFIG['main_table_width'];
        echo <<<EOT

<!-- Start standard table -->
<table align="center" width="$width" cellspacing="1" cellpadding="0" class="maintable">

EOT;
        if ($title) {
        echo <<<EOT
        <tr>
                <td class="caption2" colspan="$title_colspan">$title</td>
        </tr>

EOT;
        }
}

function endtable()
{
        echo <<<EOT
</table>
<!-- End standard table -->

EOT;
}

function theme_main_menu()
{
        global $AUTHORIZED, $CONFIG, $album, $actual_cat, $cat, $REFERER, $HTTP_SERVER_VARS;
        global $lang_main_menu, $template_main_menu;

        static $main_menu = '';

        if ($main_menu != '') return $main_menu;

        $album_l = isset($album) ? "?album=$album" : '';
        $cat_l = (isset($actual_cat))? "?cat=$actual_cat"  : (isset($cat) ? "?cat=$cat" : '');
        $cat_l2 = isset($cat) ? "&cat=$cat" : '';
        $my_gallery_id = FIRST_USER_CAT + USER_ID;

        if (USER_ID) {
//        	echo "tmm called by ".getPhpCaller(2)."<br/>";
                template_extract_block($template_main_menu, 'login');
        } else {
                template_extract_block($template_main_menu, 'logout');
                template_extract_block($template_main_menu, 'my_profile');
        }

        if (GALLERY_ADMIN_MODE || USER_ADMIN_MODE) {
                template_extract_block($template_main_menu, 'enter_admin_mode');
        } elseif (USER_CAN_CREATE_ALBUMS || USER_IS_ADMIN) {
                template_extract_block($template_main_menu, 'leave_admin_mode');
        }

        if (!USER_CAN_CREATE_ALBUMS && !USER_IS_ADMIN) {
                template_extract_block($template_main_menu, 'enter_admin_mode');
                template_extract_block($template_main_menu, 'leave_admin_mode');
        }

        if (!USER_CAN_CREATE_ALBUMS) {
                template_extract_block($template_main_menu, 'my_gallery');
        }

        if (USER_CAN_CREATE_ALBUMS) {
                template_extract_block($template_main_menu, 'my_profile');
        }

        if (!USER_CAN_UPLOAD_PICTURES) {
                template_extract_block($template_main_menu, 'upload_pic');
        }

        if (USER_ID || !$CONFIG['allow_user_registration']) {
                template_extract_block($template_main_menu, 'register');
        }

    if (!USER_ID || !$CONFIG['allow_memberlist']) {
        template_extract_block($template_main_menu, 'allow_memberlist');
    }

    if (!$CONFIG['display_faq']) {
        template_extract_block($template_main_menu, 'faq');
    }

    $param = array('{ALB_LIST_TGT}' => "index.php$cat_l",
                '{ALB_LIST_TITLE}' => $lang_main_menu['alb_list_title'],
                '{ALB_LIST_LNK}' => $lang_main_menu['alb_list_lnk'],
                '{MY_GAL_TGT}' => "index.php?cat=$my_gallery_id",
                '{MY_GAL_TITLE}' => $lang_main_menu['my_gal_title'],
                '{MY_GAL_LNK}' => $lang_main_menu['my_gal_lnk'],
        '{MEMBERLIST_TGT}' => "usermgr.php",
        '{MEMBERLIST_TITLE}' => $lang_main_menu['memberlist_title'],
        '{MEMBERLIST_LNK}' => $lang_main_menu['memberlist_lnk'],
                '{MY_PROF_TGT}' => "profile.php?op=edit_profile",
                '{MY_PROF_LNK}' => $lang_main_menu['my_prof_lnk'],
                '{ADM_MODE_TGT}' => "admin.php?admin_mode=1&referer=$REFERER",
                '{ADM_MODE_TITLE}' => $lang_main_menu['adm_mode_title'],
                '{ADM_MODE_LNK}' => $lang_main_menu['adm_mode_lnk'],
                '{USR_MODE_TGT}' => "admin.php?admin_mode=0&referer=$REFERER",
                '{USR_MODE_TITLE}' => $lang_main_menu['usr_mode_title'],
                '{USR_MODE_LNK}' => $lang_main_menu['usr_mode_lnk'],
                '{UPL_PIC_TGT}' => "upload.php",
                '{UPL_PIC_TITLE}' => $lang_main_menu['upload_pic_title'],
                '{UPL_PIC_LNK}' => $lang_main_menu['upload_pic_lnk'],
                '{REGISTER_TGT}' => "register.php",
                '{REGISTER_TITLE}' => $lang_main_menu['register_title'],
                '{REGISTER_LNK}' => $lang_main_menu['register_lnk'],
                '{LOGIN_TGT}' => "login.php?referer=$REFERER",
                '{LOGIN_LNK}' => $lang_main_menu['login_lnk'],
                '{LOGOUT_TGT}' => "logout.php?referer=$REFERER",
                '{LOGOUT_LNK}' => $lang_main_menu['logout_lnk']." [".USER_NAME."]",
        '{FAQ_TGT}' => "faq.php",
        '{FAQ_TITLE}' => $lang_main_menu['faq_title'],
        '{FAQ_LNK}' => $lang_main_menu['faq_lnk'],
                '{LASTUP_TGT}' => "thumbnails.php?album=lastup$cat_l2",
                '{LASTUP_LNK}' => $lang_main_menu['lastup_lnk'],
                '{LASTCOM_TGT}' => "thumbnails.php?album=lastcom$cat_l2",
                '{LASTCOM_LNK}' => $lang_main_menu['lastcom_lnk'],
                '{TOPN_TGT}' => "thumbnails.php?album=topn$cat_l2",
                '{TOPN_LNK}' => $lang_main_menu['topn_lnk'],
                '{TOPRATED_TGT}'=> "thumbnails.php?album=toprated$cat_l2",
                '{TOPRATED_LNK}'=> $lang_main_menu['toprated_lnk'],
			       '{FAV_TGT}' => "thumbnails.php?album=favpics",
        			 '{FAV_LNK}' => $lang_main_menu['fav_lnk'],
                '{SEARCH_TGT}'=> "search.php",
                '{SEARCH_LNK}'=> $lang_main_menu['search_lnk'],
        );

        $main_menu = template_eval($template_main_menu, $param);
        global $ns;
        $main_menu = $ns -> tablerender($CONFIG['gallery_name']." - ".$CONFIG['gallery_description'], $main_menu);
        return $main_menu;
}

function theme_admin_mode_menu()
{
        global $ns;   // Added by Cam
        $menu_title = "Admin Menu";   // Added by Cam.
        global $cat;
        global $lang_gallery_admin_menu, $lang_user_admin_menu;
        global $template_gallery_admin_menu, $template_user_admin_menu;

        $cat_l = isset($cat) ? "?cat=$cat" : '';

        if (GALLERY_ADMIN_MODE) {
                $param = array('{CATL}' => $cat_l,
                        '{UPL_APP_LNK}' => $lang_gallery_admin_menu['upl_app_lnk'],
                        '{CONFIG_LNK}' => $lang_gallery_admin_menu['config_lnk'],
                        '{ALBUMS_LNK}' => $lang_gallery_admin_menu['albums_lnk'],
                        '{CATEGORIES_LNK}' => $lang_gallery_admin_menu['categories_lnk'],
                        '{USERS_LNK}' => $lang_gallery_admin_menu['users_lnk'],
                        '{GROUPS_LNK}' => $lang_gallery_admin_menu['groups_lnk'],
                        '{COMMENTS_LNK}' => $lang_gallery_admin_menu['comments_lnk'],
                        '{SEARCHNEW_LNK}' => $lang_gallery_admin_menu['searchnew_lnk'],
            '{MY_PROF_LNK}' => $lang_user_admin_menu['my_prof_lnk'],
				            '{UTIL_LNK}' => $lang_gallery_admin_menu['util_lnk'],
				            '{BAN_LNK}' => $lang_gallery_admin_menu['ban_lnk'],
            '{DB_ECARD_LNK}' => $lang_gallery_admin_menu['db_ecard_lnk'],
                );

                $html = template_eval($template_gallery_admin_menu, $param);
                $html = $ns -> tablerender($menu_title, $html);  // Added by Cam.
        } elseif (USER_ADMIN_MODE) {
                $param = array('{ALBMGR_LNK}' => $lang_user_admin_menu['albmgr_lnk'],
                        '{MODIFYALB_LNK}' => $lang_user_admin_menu['modifyalb_lnk'],
                        '{MY_PROF_LNK}' => $lang_user_admin_menu['my_prof_lnk']
                );

                $html = template_eval($template_user_admin_menu, $param);
                $html = $ns -> tablerender($menu_title, $html); // Added by Cam.
        }else{
                $html ='';
        }

        return $html;
}

function theme_display_cat_list($breadcrumb, &$cat_data, $statistics)
{
        global $template_cat_list, $lang_cat_list;

        starttable('100%');

        if (count($cat_data)>0) {
                $template = template_extract_block($template_cat_list, 'header');
                $params = array('{CATEGORY}' => $lang_cat_list['category'],
                        '{ALBUMS}' => $lang_cat_list['albums'],
                        '{PICTURES}' => $lang_cat_list['pictures'],
                );
                echo template_eval($template, $params);
        }

        $template_noabl = template_extract_block($template_cat_list, 'catrow_noalb');
        $template = template_extract_block($template_cat_list, 'catrow');
        foreach($cat_data as $category){
                if (count($category) == 3) {
                    $params = array('{CAT_TITLE}' => $category[0],
                    '{CAT_THUMB}' => $category['cat_thumb'],
                                '{CAT_DESC}' => $category[1]
                        );
                        echo template_eval($template_noabl, $params);
        } elseif (isset($category['cat_albums']) && ($category['cat_albums'] != '')) {
            $params = array('{CAT_TITLE}' => $category[0],
                '{CAT_THUMB}' => $category['cat_thumb'],
                '{CAT_DESC}' => $category[1],
                '{CAT_ALBUMS}' => $category['cat_albums'],
                '{ALB_COUNT}' => $category[2],
                '{PIC_COUNT}' => $category[3],
                );
            echo template_eval($template, $params);
                } else {
                   $params = array('{CAT_TITLE}' => $category[0],
                        '{CAT_THUMB}' => $category['cat_thumb'],
                        '{CAT_DESC}' => $category[1],
                        '{CAT_ALBUMS}' => '',
                        '{ALB_COUNT}' => $category[2],
                        '{PIC_COUNT}' => $category[3],
                        );
                        echo template_eval($template, $params);
                }
        }

        if ($statistics && count($cat_data)>0) {
                $template = template_extract_block($template_cat_list, 'footer');
                $params = array('{STATISTICS}' => $statistics);
                echo template_eval($template, $params);
        }
        endtable();

        if (count($cat_data)>0)
                echo template_extract_block($template_cat_list, 'spacer');
}

function theme_display_breadcrumb($breadcrumb, &$cat_data)
{
    /**
     * ** added breadcrumb as a seperate element
     */
    global $template_breadcrumb, $lang_breadcrumb;

    starttable('100%');
    if ($breadcrumb) {
        $template = template_extract_block($template_breadcrumb, 'breadcrumb');
        $params = array('{BREADCRUMB}' => $breadcrumb
            );
        echo template_eval($template, $params);
    }
    endtable();
}

function theme_display_album_list(&$alb_list, $nbAlb, $cat, $page, $total_pages)
{

        global $CONFIG, $STATS_IN_ALB_LIST, $statistics, $template_tab_display, $template_album_list, $lang_album_list;

        $theme_alb_list_tab_tmpl = $template_tab_display;

        $theme_alb_list_tab_tmpl['left_text'] = strtr($theme_alb_list_tab_tmpl['left_text'],array('{LEFT_TEXT}' => $lang_album_list['album_on_page']));
        $theme_alb_list_tab_tmpl['inactive_tab'] = strtr($theme_alb_list_tab_tmpl['inactive_tab'],array('{LINK}' => 'index.php?cat='.$cat.'&page=%d'));

        $tabs = create_tabs($nbAlb, $page, $total_pages, $theme_alb_list_tab_tmpl);

        $album_cell = template_extract_block($template_album_list, 'album_cell');
        $empty_cell = template_extract_block($template_album_list, 'empty_cell');
        $tabs_row = template_extract_block($template_album_list, 'tabs');
        $stat_row = template_extract_block($template_album_list, 'stat_row');
        $spacer = template_extract_block($template_album_list, 'spacer');
        $header = template_extract_block($template_album_list, 'header');
        $footer = template_extract_block($template_album_list, 'footer');
        $rows_separator = template_extract_block($template_album_list, 'row_separator');

        $count = 0;

        $columns = $CONFIG['album_list_cols'];
        $column_width = ceil(100/$columns);
        $thumb_cell_width = $CONFIG['alb_list_thumb_size']+2;

        starttable('100%');

        if ($STATS_IN_ALB_LIST) {
                $params = array('{STATISTICS}' => $statistics,
                        '{COLUMNS}' => $columns,
                );
                echo template_eval($stat_row, $params);
        }

        echo $header;

    if (is_array($alb_list)) {
        foreach($alb_list as $album){
                $count ++;

            $params = array('{COL_WIDTH}' => $column_width,
                        '{ALBUM_TITLE}' => $album['album_title'],
                        '{THUMB_CELL_WIDTH}' => $thumb_cell_width,
                '{ALB_LINK_TGT}' => "thumbnails.php?album={$album['aid']}",
                '{ALB_LINK_PIC}' => $album['thumb_pic'],
                        '{ADMIN_MENU}' => $album['album_adm_menu'],
                        '{ALB_DESC}' => $album['album_desc'],
                        '{ALB_INFOS}' => $album['album_info'],
                );

                echo template_eval($album_cell, $params);

                if ($count % $columns == 0 && $count < count($alb_list)) {
                        echo $rows_separator;
                }
        }
    }

        $params = array('{COL_WIDTH}' => $column_width);
        $empty_cell = template_eval($empty_cell, $params);

        while ($count++ % $columns != 0) {
                echo $empty_cell;
        }

        echo $footer;
        // Tab display
        $params = array('{COLUMNS}' => $columns,
                '{TABS}' => $tabs,
        );
        echo template_eval($tabs_row, $params);

        endtable();

        echo $spacer;
}
// Function to display first level Albums of a category
function theme_display_album_list_cat(&$alb_list, $nbAlb, $cat, $page, $total_pages)
{
    global $CONFIG, $STATS_IN_ALB_LIST, $statistics, $template_tab_display, $template_album_list_cat, $lang_album_list;
    if (!$CONFIG['first_level']) {
        return;
    }

    $theme_alb_list_tab_tmpl = $template_tab_display;

    $theme_alb_list_tab_tmpl['left_text'] = strtr($theme_alb_list_tab_tmpl['left_text'], array('{LEFT_TEXT}' => $lang_album_list['album_on_page']));
    $theme_alb_list_tab_tmpl['inactive_tab'] = strtr($theme_alb_list_tab_tmpl['inactive_tab'], array('{LINK}' => 'index.php?cat=' . $cat . '&page=%d'));

    $tabs = create_tabs($nbAlb, $page, $total_pages, $theme_alb_list_tab_tmpl);
    // echo $template_album_list_cat;
    $template_album_list_cat1 = $template_album_list_cat;
    $album_cell = template_extract_block($template_album_list_cat1, 'c_album_cell');
    $empty_cell = template_extract_block($template_album_list_cat1, 'c_empty_cell');
    $tabs_row = template_extract_block($template_album_list_cat1, 'c_tabs');
    $stat_row = template_extract_block($template_album_list_cat1, 'c_stat_row');
    $spacer = template_extract_block($template_album_list_cat1, 'c_spacer');
    $header = template_extract_block($template_album_list_cat1, 'c_header');
    $footer = template_extract_block($template_album_list_cat1, 'c_footer');
    $rows_separator = template_extract_block($template_album_list_cat1, 'c_row_separator');

    $count = 0;

    $columns = $CONFIG['album_list_cols'];
    $column_width = ceil(100 / $columns);
    $thumb_cell_width = $CONFIG['alb_list_thumb_size'] + 2;

    starttable('100%');

    if ($STATS_IN_ALB_LIST) {
        $params = array('{STATISTICS}' => $statistics,
            '{COLUMNS}' => $columns,
            );
        echo template_eval($stat_row, $params);
    }

    echo $header;

    if (is_array($alb_list)) {
        foreach($alb_list as $album) {
            $count ++;

            $params = array('{COL_WIDTH}' => $column_width,
                '{ALBUM_TITLE}' => $album['album_title'],
                '{THUMB_CELL_WIDTH}' => $thumb_cell_width,
                '{ALB_LINK_TGT}' => "thumbnails.php?album={$album['aid']}",
                '{ALB_LINK_PIC}' => $album['thumb_pic'],
                '{ADMIN_MENU}' => $album['album_adm_menu'],
                '{ALB_DESC}' => $album['album_desc'],
                '{ALB_INFOS}' => $album['album_info'],
                );

            echo template_eval($album_cell, $params);

            if ($count % $columns == 0 && $count < count($alb_list)) {
                echo $rows_separator;
            }
        }
    }

    $params = array('{COL_WIDTH}' => $column_width);
    $empty_cell = template_eval($empty_cell, $params);

    while ($count++ % $columns != 0) {
        echo $empty_cell;
}

    echo $footer;
    // Tab display
    $params = array('{COLUMNS}' => $columns,
        '{TABS}' => $tabs,
        );
    echo template_eval($tabs_row, $params);

    endtable();

    echo $spacer;
}

function theme_display_thumbnails(&$thumb_list, $nbThumb, $album_name, $aid, $cat, $page, $total_pages, $sort_options, $display_tabs, $mode = 'thumb')
{
        global $CONFIG;
    global $template_thumb_view_title_row,$template_fav_thumb_view_title_row, $lang_thumb_view, $template_tab_display, $template_thumbnail_view;

        static $header='';
        static $thumb_cell='';
        static $empty_cell='';
        static $row_separator='';
        static $footer='';
        static $tabs='';
        static $spacer='';

        if ($header == '') {
                $thumb_cell = template_extract_block($template_thumbnail_view, 'thumb_cell');
                $tabs = template_extract_block($template_thumbnail_view, 'tabs');
                $header = template_extract_block($template_thumbnail_view, 'header');
                $empty_cell = template_extract_block($template_thumbnail_view, 'empty_cell');
                $row_separator = template_extract_block($template_thumbnail_view, 'row_separator');
                $footer = template_extract_block($template_thumbnail_view, 'footer');
                $spacer = template_extract_block($template_thumbnail_view, 'spacer');
        }

        $cat_link= is_numeric($aid) ? '' : '&cat='.$cat;

        $theme_thumb_tab_tmpl = $template_tab_display;

        if ($mode == 'thumb') {
                $theme_thumb_tab_tmpl['left_text'] = strtr($theme_thumb_tab_tmpl['left_text'],array('{LEFT_TEXT}' => $lang_thumb_view['pic_on_page']));
                $theme_thumb_tab_tmpl['inactive_tab'] = strtr($theme_thumb_tab_tmpl['inactive_tab'],array('{LINK}' => 'thumbnails.php?album='.$aid.$cat_link.'&page=%d'));
        } else {
                $theme_thumb_tab_tmpl['left_text'] = strtr($theme_thumb_tab_tmpl['left_text'],array('{LEFT_TEXT}' => $lang_thumb_view['user_on_page']));
                $theme_thumb_tab_tmpl['inactive_tab'] = strtr($theme_thumb_tab_tmpl['inactive_tab'],array('{LINK}' => 'index.php?cat='.$cat.'&page=%d'));
        }

        $thumbcols = $CONFIG['thumbcols'];
        $cell_width = ceil(100/$CONFIG['thumbcols']).'%';

        $tabs_html = $display_tabs ? create_tabs($nbThumb, $page, $total_pages, $theme_thumb_tab_tmpl) : '';
        // The sort order options are not available for meta albums
        if ($sort_options){
                $param = array('{ALBUM_NAME}' => $album_name,
                        '{AID}' => $aid,
                        '{PAGE}' => $page,
                        '{NAME}' => $lang_thumb_view['name'],
            '{TITLE}' => $lang_thumb_view['title'],
                        '{DATE}' => $lang_thumb_view['date'],
            '{SORT_TA}' => $lang_thumb_view['sort_ta'],
            '{SORT_TD}' => $lang_thumb_view['sort_td'],
                        '{SORT_NA}' => $lang_thumb_view['sort_na'],
                        '{SORT_ND}' => $lang_thumb_view['sort_nd'],
                        '{SORT_DA}' => $lang_thumb_view['sort_da'],
                        '{SORT_DD}' => $lang_thumb_view['sort_dd'],
                );
                $title = template_eval($template_thumb_view_title_row, $param);
    } else if ($aid == 'favpics' && $CONFIG['enable_zipdownload'] == 1) { //Lots of stuff can be added here later
       $param = array('{ALBUM_NAME}' => $album_name,
                             '{DOWNLOAD_ZIP}'=>$lang_thumb_view['download_zip']
                               );
       $title = template_eval($template_fav_thumb_view_title_row, $param);
        } else {
                $title = $album_name;
        }


        if ($mode == 'thumb') {
                starttable('100%', $title, $thumbcols);
        } else {
                starttable('100%');
        }

        echo $header;

        $i = 0;
        foreach($thumb_list as $thumb){
                $i++;
                if ($mode == 'thumb') {
            if ($aid == 'lastalb') {
                $params = array('{CELL_WIDTH}' => $cell_width,
                    '{LINK_TGT}' => "thumbnails.php?album={$thumb['aid']}",
                    '{THUMB}' => $thumb['image'],
                    '{CAPTION}' => $thumb['caption'],
                    '{ADMIN_MENU}' => $thumb['admin_menu']
                    );
            } else {
                $params = array('{CELL_WIDTH}' => $cell_width,
                                '{LINK_TGT}' => "displayimage.php?album=$aid$cat_link&pos={$thumb['pos']}",
                                '{THUMB}' => $thumb['image'],
                                '{CAPTION}' => $thumb['caption'],
                                '{ADMIN_MENU}' => $thumb['admin_menu']
                        );
            }
                } else {
                        $params =array('{CELL_WIDTH}' => $cell_width,
                                '{LINK_TGT}' => "index.php?cat={$thumb['cat']}",
                                '{THUMB}' => $thumb['image'],
                                '{CAPTION}' => $thumb['caption'],
                                '{ADMIN_MENU}' => ''
                        );
                }
                echo template_eval($thumb_cell, $params);

                if ((($i % $thumbcols) == 0) && ($i < count($thumb_list))) {
                        echo $row_separator;
                }
        }
        for (;($i % $thumbcols); $i++){
                echo $empty_cell;
        }
        echo $footer;

        if ($display_tabs) {
        $params = array('{THUMB_COLS}' => $thumbcols,
                        '{TABS}' => $tabs_html
                );
                echo template_eval($tabs, $params);
        }

        endtable();
        echo $spacer;
}
// Added to display flim_strip
function theme_display_film_strip(&$thumb_list, $nbThumb, $album_name, $aid, $cat, $pos, $sort_options, $mode = 'thumb')
{
    global $CONFIG;
    global $template_film_strip, $lang_film_strip;

    static $template = '';
    static $thumb_cell = '';
    static $empty_cell = '';
    static $spacer = '';

    if ((!$template)) {
        $template = $template_film_strip;
        $thumb_cell = template_extract_block($template, 'thumb_cell');
        $empty_cell = template_extract_block($template, 'empty_cell');
    }

    $cat_link = is_numeric($aid) ? '' : '&cat=' . $cat;

    $thumbcols = $CONFIG['thumbcols'];
    $cell_width = ceil(100 / $CONFIG['max_film_strip_items']) . '%';

    $i = 0;
    $thumb_strip = '';
    foreach($thumb_list as $thumb) {
        $i++;
        if ($mode == 'thumb') {
            $params = array('{CELL_WIDTH}' => $cell_width,
                '{LINK_TGT}' => "displayimage.php?album=$aid$cat_link&pos={$thumb['pos']}",
                '{THUMB}' => $thumb['image'],
                '{CAPTION}' => '',
                '{ADMIN_MENU}' => ''
                );
        } else {
            $params = array('{CELL_WIDTH}' => $cell_width,
                '{LINK_TGT}' => "index.php?cat={$thumb['cat']}",
                '{THUMB}' => $thumb['image'],
                '{CAPTION}' => '',
                '{ADMIN_MENU}' => ''
                );
        }
        $thumb_strip .= template_eval($thumb_cell, $params);
    }

    $params = array('{THUMB_STRIP}' => $thumb_strip,
        '{COLS}' => $i);

    ob_start();
    starttable('');
    echo template_eval($template, $params);
    endtable();
    $film_strip = ob_get_contents();
    ob_end_clean();

    return $film_strip;
}

function theme_no_img_to_display($album_name)
{
    global $lang_errors, $template_no_img_to_display;

    static $template = '';
    static $spacer;

    if ((!$template)) {
        $template = $template_no_img_to_display;
        $spacer = template_extract_block($template, 'spacer');
    }

    $params = array('{TEXT}' => $lang_errors['no_img_to_display']);
    starttable('100%', $album_name);
    echo template_eval($template, $params);
    endtable();
				}

function theme_display_image($nav_menu, $picture, $votes, $pic_info, $comments, $film_strip)
{
    global $HTTP_COOKIE_VARS, $CONFIG;

    starttable();
    echo $nav_menu;
    endtable();

    starttable();
    echo $picture;
    endtable();

    if ($CONFIG['display_film_strip'] == 1) {
        echo $film_strip;
    }

    starttable();
    echo $votes;
    endtable();
    starttable();
    echo $comments;
    endtable();

    $picinfo = isset($HTTP_COOKIE_VARS['picinfo']) ? $HTTP_COOKIE_VARS['picinfo'] : ($CONFIG['display_pic_info'] ? 'block' : 'none');
    echo "<div id=\"picinfo\" style=\"display: $picinfo;\">\n";
    starttable();
    echo $pic_info;
    endtable();
    echo "</div>\n";
    }

function theme_html_picinfo(&$info)
{
    global $lang_picinfo;

    $html = '';

    $html .= "        <tr><td colspan=\"2\" class=\"tableh2_compact\"><b>{$lang_picinfo['title']}</b></td></tr>\n";
    $template = "        <tr><td class=\"tableb_compact\" valign=\"top\" nowrap>%s:</td><td class=\"tableb_compact\">%s</td></tr>\n";
    foreach ($info as $key => $value) $html .= sprintf($template, $key, $value);

    return $html;
}

?>