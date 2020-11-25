<?php

global $sc_style, $userjournals_shortcodes, $UJ_BLOGGERS_LIST, $UJ_BLOGGER_SYNOPSIS, $UJ_BLOG, $UJ_BLOG_SHORT, $UJ_CATEGORY_LIST, $UJ_CATEGORY, $UJ_MENU_READER, $UJ_MENU_WRITER, $UJ_RSS, $UJ_MESSAGE, $UJ_MESSAGE_EXTRA;

// Template name - required to identify the template
$userjournals_template_name = "Default";

$sc_style['UJ_BLOGGERS_LIST']['pre'] = "";
$sc_style['UJ_BLOGGERS_LIST']['post'] = "";

$sc_style['UJ_BLOGGER_LINK']['pre'] = "[ ";
$sc_style['UJ_BLOGGER_LINK']['post'] = " ]";

$sc_style['UJ_BLOGGER_MENU_LINK']['pre'] = "<br/>&bull; ";
$sc_style['UJ_BLOGGER_MENU_LINK']['post'] = "";

$sc_style['UJ_BLOG_LINK']['pre'] = "[ ";
$sc_style['UJ_BLOG_LINK']['post'] = " ]";

$sc_style['UJ_BLOG_MOOD']['pre'] = "";
$sc_style['UJ_BLOG_MOOD']['post'] = "";

$sc_style['UJ_BLOG_SUBJECT']['pre'] = "";
$sc_style['UJ_BLOG_SUBJECT']['post'] = "";

$sc_style['UJ_BLOG_DATE']['pre'] = "";
$sc_style['UJ_BLOG_DATE']['post'] = "<hr/>";

$sc_style['UJ_BLOG_CATEGORIES']['pre'] = "";
$sc_style['UJ_BLOG_CATEGORIES']['post'] = "<hr/>";

$sc_style['UJ_BLOG_NOW_PLAYING']['pre'] = "";
$sc_style['UJ_BLOG_NOW_PLAYING']['post'] = "<hr/>";

$sc_style['UJ_BLOG_EDIT_LINK']['pre'] = "[ ";
$sc_style['UJ_BLOG_EDIT_LINK']['post'] = " ]";

$sc_style['UJ_BLOG_DELETE_LINK']['pre'] = "[ ";
$sc_style['UJ_BLOG_DELETE_LINK']['post'] = " ]";

$sc_style['UJ_BLOG_REPORT_LINK']['pre'] = "[ ";
$sc_style['UJ_BLOG_REPORT_LINK']['post'] = " ]";

$sc_style['UJ_BLOG_BLOGGER_LINK']['pre'] = "[ ";
$sc_style['UJ_BLOG_BLOGGER_LINK']['post'] = " ]";

$sc_style['UJ_BLOG_ENTRY']['pre'] = "";
$sc_style['UJ_BLOG_ENTRY']['post'] = "";

$sc_style['UJ_BLOG_COMMENTS']['pre'] = "<div>";
$sc_style['UJ_BLOG_COMMENTS']['post'] = "</div>";

$sc_style['UJ_BLOG_COMMENTS_TOTAL']['pre'] = "<div class='forumheader3' style='text-align:right;'>";
$sc_style['UJ_BLOG_COMMENTS_TOTAL']['post'] = "</div>";

$sc_style['UJ_BLOG_RATINGS']['pre'] = "<div class='forumheader3' style='text-align:right;'>";
$sc_style['UJ_BLOG_RATINGS']['post'] = "</div><br/>";

$sc_style['UJ_CATEGORY_LIST']['pre'] = "<div class='forumheader'>";
$sc_style['UJ_CATEGORY_LIST']['post'] = "</div>";

$sc_style['UJ_CATEGORY_LIST_HEADING']['pre'] = "<div class='forumheader2'>";
$sc_style['UJ_CATEGORY_LIST_HEADING']['post'] = "</div>";

$sc_style['UJ_CATEGORY_START']['pre'] = "<div class='forumheader3'>";
$sc_style['UJ_CATEGORY_START']['post'] = "";

$sc_style['UJ_CATEGORY_END']['pre'] = "";
$sc_style['UJ_CATEGORY_END']['post'] = "</div>";

$sc_style['UJ_CATEGORY_LINK']['pre'] = "";
$sc_style['UJ_CATEGORY_LINK']['post'] = "";

$sc_style['UJ_CATEGORY_MENU_LINK']['pre'] = "<br/>&bull; ";
$sc_style['UJ_CATEGORY_MENU_LINK']['post'] = "";

$sc_style['UJ_CATEGORY_ICON']['pre'] = "";
$sc_style['UJ_CATEGORY_ICON']['post'] = "";

$sc_style['UJ_MENU_READER_CATEGORIES']['pre'] = "<br/><strong>".UJ91."</strong>";
$sc_style['UJ_MENU_READER_CATEGORIES']['post'] = "<br/>";

$sc_style['UJ_MENU_READER_BLOGGERS']['pre'] = "<br/><strong>".UJ43."</strong>";
$sc_style['UJ_MENU_READER_BLOGGERS']['post'] = "<br/>";

$sc_style['UJ_MENU_WRITER_OPTIONS']['pre'] = "<strong>".UJ49."</strong><br/>";
$sc_style['UJ_MENU_WRITER_OPTIONS']['post'] = "<br/>";

$sc_style['UJ_MENU_WRITER_RECENT']['pre'] = "<strong>".UJ33."</strong><br/>";
$sc_style['UJ_MENU_WRITER_RECENT']['post'] = "<br/>";

$sc_style['UJ_MENU_WRITER_UNPUBLISHED']['pre'] = "<strong>".UJ66."</strong><br/>";
$sc_style['UJ_MENU_WRITER_UNPUBLISHED']['post'] = "<br/>";

$sc_style['UJ_RSS']['pre'] = "<br/><div style='text-align:center'>";
$sc_style['UJ_RSS']['post'] = "</div>";

$sc_style['UJ_RSS_1']['pre'] = "";
$sc_style['UJ_RSS_1']['post'] = "";

$sc_style['UJ_RSS_2']['pre'] = "<br/>";
$sc_style['UJ_RSS_2']['post'] = "";

$sc_style['UJ_RSS_3']['pre'] = "<br/>";
$sc_style['UJ_RSS_3']['post'] = "";

$sc_style['UJ_MESSAGE']['pre'] = "<div class='finfobar' style='text-align:center;cursor:pointer' onclick='expandit(\"uj_message\");'>";
$sc_style['UJ_MESSAGE']['post'] = "</div><br/>";

$sc_style['UJ_MESSAGE_EXTRA']['pre'] = "<div class='smalltext' id='uj_message' style='display:none'>";
$sc_style['UJ_MESSAGE_EXTRA']['post'] = "</div>";

$UJ_BLOGGERS_LIST = "
<div class='forumheader'>{UJ_BLOGGER_NAME}</div>
<div class='forumheader3'>
<span class=''>".UJ47."{UJ_BLOGGER_TIMESTAMP}</span>
<hr/>
{UJ_BLOGGER_LINK}
</div><br/>
";

$UJ_BLOGGER_SYNOPSIS = "
<div class='forumheader3'>
   <table><tr>
      <td>{UJ_BLOGGER_PICTURE}
      </td>
      <td class='forumheader2' style='width:100%;'>{UJ_BLOGGER_SYNOPSIS}</td>
   </tr></table>
</div>
<br/>
";

$UJ_BLOG = "
<div class='forumheader'>
   {UJ_BLOG_MOOD} {UJ_BLOG_SUBJECT}
   <div class='forumheader3'>
      {UJ_BLOG_DATE=label}
      <div>
         {UJ_BLOG_CATEGORIES=label}
         {UJ_BLOG_NOW_PLAYING=label}
         <div style='float:right;'>
            {UJ_BLOG_EDIT_LINK}
            {UJ_BLOG_DELETE_LINK}
            {UJ_BLOG_REPORT_LINK}
         </div>
      </div>
      {UJ_BLOG_BLOGGER_LINK}
   </div>
   <div class='forumheader2'>
      {UJ_BLOG_ENTRY}
   </div>
   {UJ_BLOG_RATINGS}
   {UJ_BLOG_COMMENTS}
</div>
<br/>
";

$UJ_BLOG_SHORT = "
<div class='forumheader'>
   {UJ_BLOG_MOOD} {UJ_BLOG_SUBJECT} {UJ_BLOG_LINK}
   <div style='float:right;'>
      {UJ_BLOG_EDIT_LINK}
      {UJ_BLOG_DELETE_LINK}
   </div>
   <div class='forumheader3'>
      {UJ_BLOG_DATE}
      {UJ_BLOG_CATEGORIES=label}
   </div>
   <div class='forumheader2'>
      {UJ_BLOG_ENTRY_SHORT}
   </div>
   {UJ_BLOG_COMMENTS_TOTAL=label}
   {UJ_BLOG_RATINGS}
</div>
";

$UJ_CATEGORY_LIST = "{UJ_CATEGORY_LIST_HEADING}{UJ_CATEGORY_LIST}";

$UJ_CATEGORY = "{UJ_CATEGORY_START}{UJ_CATEGORY_ICON}{UJ_CATEGORY_LINK}{UJ_CATEGORY_END}";

$UJ_MENU_READER = "{UJ_MENU_READER}{UJ_MENU_READER_CATEGORIES}{UJ_MENU_READER_BLOGGERS}{UJ_RSS}";

$UJ_MENU_WRITER = "{UJ_MENU_WRITER_OPTIONS}{UJ_MENU_WRITER_RECENT}{UJ_MENU_WRITER_UNPUBLISHED}";

$UJ_RSS = "{UJ_RSS}";

$UJ_MESSAGE = "{UJ_MESSAGE}";
$UJ_MESSAGE_EXTRA = "{UJ_MESSAGE_EXTRA}";
 