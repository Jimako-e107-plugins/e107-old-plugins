<?php

global $sc_style, $userjournals_shortcodes, $UJ_BLOGGERS_LIST, $UJ_BLOGGER_SYNOPSIS, $UJ_BLOG, $UJ_BLOG_SHORT, $UJ_CATEGORY_LIST, $UJ_CATEGORY, $UJ_MENU_READER, $UJ_MENU_WRITER, $UJ_RSS, $UJ_MESSAGE, $UJ_MESSAGE_EXTRA;

// Template name - required to identify the template
$userjournals_template_name = "Long";

$sc_style['UJ_BLOGGERS_LIST']['pre'] = "";
$sc_style['UJ_BLOGGERS_LIST']['post'] = "";

$sc_style['UJ_BLOGGER_LINK']['pre'] = " &lt;&lt;";
$sc_style['UJ_BLOGGER_LINK']['post'] = "&gt;&gt; ";

$sc_style['UJ_BLOGGER_MENU_LINK']['pre'] = "<br/>&bull; ";
$sc_style['UJ_BLOGGER_MENU_LINK']['post'] = "";

$sc_style['UJ_BLOG_MOOD']['pre'] = "";
$sc_style['UJ_BLOG_MOOD']['post'] = "";

$sc_style['UJ_BLOG_SUBJECT']['pre'] = "<div class='forumheader2' style='font-size:1.5em;text-align:center'>";
$sc_style['UJ_BLOG_SUBJECT']['post'] = "</div>";

$sc_style['UJ_BLOG_DATE']['pre'] = "<div style='text-align:right'>";
$sc_style['UJ_BLOG_DATE']['post'] = "</div>";

$sc_style['UJ_BLOG_CATEGORIES']['pre'] = "<div style='text-align:center;margin-top:4px;'>";
$sc_style['UJ_BLOG_CATEGORIES']['post'] = "</div>";

$sc_style['UJ_BLOG_NOW_PLAYING']['pre'] = "";
$sc_style['UJ_BLOG_NOW_PLAYING']['post'] = "<hr/>";

$sc_style['UJ_BLOG_LINK']['pre'] = "<div class='' style='text-align:right;margin-bottom:5px;'> &lt;&lt;";
$sc_style['UJ_BLOG_LINK']['post'] = "&gt;&gt; ";

$sc_style['UJ_BLOG_BLOGGER_LINK']['pre'] = "<div class='' style='text-align:right;margin-bottom:5px;'> &lt;&lt;";
$sc_style['UJ_BLOG_BLOGGER_LINK']['post'] = "&gt;&gt; ";

$sc_style['UJ_BLOG_REPORT_LINK']['pre'] = " &lt;&lt;";
$sc_style['UJ_BLOG_REPORT_LINK']['post'] = "&gt;&gt; ";

$sc_style['UJ_BLOG_EDIT_LINK']['pre'] = " &lt;&lt;";
$sc_style['UJ_BLOG_EDIT_LINK']['post'] = "&gt;&gt; ";

$sc_style['UJ_BLOG_DELETE_LINK']['pre'] = " &lt;&lt;";
$sc_style['UJ_BLOG_DELETE_LINK']['post'] = "&gt;&gt; </div>";

$sc_style['UJ_BLOG_ENTRY']['pre'] = "<div style='font-size:1.1em;padding:10px;margin:10px 20px;border-left:3px groove silver;border-right:3px groove silver;'>";
$sc_style['UJ_BLOG_ENTRY']['post'] = "</div>";

$sc_style['UJ_BLOG_COMMENTS']['pre'] = "<div>";
$sc_style['UJ_BLOG_COMMENTS']['post'] = "</div>";

$sc_style['UJ_BLOG_RATINGS']['pre'] = "<div class='forumheader3' style='text-align:right;'>";
$sc_style['UJ_BLOG_RATINGS']['post'] = "</div><br/>";

$sc_style['UJ_BLOG_COMMENTS_TOTAL']['pre'] = "<div class='forumheader3' style='text-align:right;margin-bottom:5px;'>";
$sc_style['UJ_BLOG_COMMENTS_TOTAL']['post'] = "</div>";

$sc_style['UJ_CATEGORY_LIST']['pre'] = "<div style='padding:10px;margin:10px 20px;border-left:3px groove silver;'>";
$sc_style['UJ_CATEGORY_LIST']['post'] = "</div>";

$sc_style['UJ_CATEGORY_LIST_HEADING']['pre'] = "<div class='forumheader2' style='font-size:1.2em;'>";
$sc_style['UJ_CATEGORY_LIST_HEADING']['post'] = "</div>";

$sc_style['UJ_CATEGORY_START']['pre'] = "<div style='font-size:1.2em;margin-bottom:15px;'>";
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

$sc_style['UJ_BLOGGER_PICTURE']['pre'] = "<div class='forumheader2' style='float:left;'>";
$sc_style['UJ_BLOGGER_PICTURE']['post'] = "</div>";

$sc_style['UJ_BLOGGER_SYNOPSIS']['pre'] = "<div style='font-size:1.1em;padding:10px;margin:10px 20px;border-left:3px groove silver;border-right:3px groove silver;'>";
$sc_style['UJ_BLOGGER_SYNOPSIS']['post'] = "</div>";

$UJ_BLOGGERS_LIST = "
<div class='forumheader2'>
<div style='text-align:left;float:left;'>
   <span style='font-size:1.2em;'>{UJ_BLOGGER_NAME}</span>
</div>
<div style='text-align:right;'>
   ".UJ47."{UJ_BLOGGER_TIMESTAMP} {UJ_BLOGGER_LINK}
</div>
</div>
<br/>";

$UJ_BLOGGER_SYNOPSIS = "<div>{UJ_BLOGGER_PICTURE}{UJ_BLOGGER_SYNOPSIS}</div>";

$UJ_BLOG = "
<div class=''>
   {UJ_BLOG_SUBJECT}
   {UJ_BLOG_CATEGORIES}
   {UJ_BLOG_DATE}
   {UJ_BLOG_ENTRY}
   {UJ_BLOG_BLOGGER_LINK}
   {UJ_BLOG_EDIT_LINK}
   {UJ_BLOG_REPORT_LINK}
   {UJ_BLOG_DELETE_LINK}
   {UJ_BLOG_RATINGS}
   {UJ_BLOG_COMMENTS}
</div>
<br/>
";

$UJ_BLOG_SHORT = "
<div class=''>
   {UJ_BLOG_SUBJECT}
   {UJ_BLOG_CATEGORIES}
   {UJ_BLOG_DATE}
   {UJ_BLOG_ENTRY}
   {UJ_BLOG_LINK}
   {UJ_BLOG_EDIT_LINK}
   {UJ_BLOG_DELETE_LINK}
   {UJ_BLOG_RATINGS}
   {UJ_BLOG_COMMENTS_TOTAL=label}
</div>
";

$UJ_CATEGORY_LIST = "{UJ_CATEGORY_LIST_HEADING}{UJ_CATEGORY_LIST}";

$UJ_CATEGORY = "{UJ_CATEGORY_START}{UJ_CATEGORY_LINK} {UJ_CATEGORY_ICON}{UJ_CATEGORY_END}";

$UJ_MENU_READER = "{UJ_MENU_READER}{UJ_MENU_READER_CATEGORIES}{UJ_MENU_READER_BLOGGERS}{UJ_RSS}";

$UJ_MENU_WRITER = "{UJ_MENU_WRITER_OPTIONS}{UJ_MENU_WRITER_RECENT}{UJ_MENU_WRITER_UNPUBLISHED}";

$UJ_RSS = "{UJ_RSS}";

$UJ_MESSAGE = "{UJ_MESSAGE}";
$UJ_MESSAGE_EXTRA = "{UJ_MESSAGE_EXTRA}";
?>