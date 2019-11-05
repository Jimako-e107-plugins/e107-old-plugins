<?php

// non changeable css
header('Content-type: text/css;');

?>

div.mcontent{background-color:#fafafa;padding:4px;margin:0 4px 5px 4px;border:1px solid #eaeaea;}
div.mcontent2{padding:8px;margin:0 4px 5px 4px;}

div.newsitem{display:block;position:relative;margin-bottom:20px;	}
div.newsitem div.more{position:absolute;right:0;top:0;}
div.newsitem h2{margin-right:35px;}
div.newsitem div.more a{padding:5px;}
div.newsitem span.date{font-size:small;font-weight:bold;text-transform:uppercase;margin-right:8px;}
div.newsitem h3{color:#111;font-size:small;margin-right:35px;}
div.newsitem span{font-weight:bold;}

div.MobCom{padding:10px 0;}
div.MobComInfo{border:1px solid #eaeaea;background:#fff url(images/topnavbg.png) repeat-x left bottom;padding:5px 10px;color:#7d7d7d;font-size:small;font-weight:700;margin-top:5px;border-radius:3px;-moz-border-radius:3px;-webkit-border-radius:3px;}

.icons{text-align:center;}
.icons a{text-decoration:none;}
.icons img{margin:0 4px;}

.ads{padding:0;margin-bottom:20px;text-align:center;}

ul,ol,dl{margin-bottom:10px;}
ul{list-style:none;}
ol{list-style:disc;}
dt{font-weight:700;}

.right{float:right;}
.left{float:left;}
.alignright{text-align:right;}
.alignleft{text-align:left;}
.clear{clear:both;}
.smaller{font-size:smaller;}

.searchForm{display:block;margin:20px 10px;text-align:center;}
.searchForm input#s{width:auto;margin-right:5px;border:1px solid #dbdbdb;padding:4px 5px;color:#898989;}
.searchForm input.button{}
div.searchbottom{display:block;height:10px;}

.button,.commentform input.button{background:transparent url(images/infobg.png) repeat-x left -10px;padding:4px 10px;text-transform:uppercase;color:#464646;border:1px solid #dbdbdb;font-weight:700;border-radius:3px;-moz-border-radius:3px;-webkit-border-radius:3px;}
.button:hover,.commentform input.button:hover{background:#111 url(images/h3bg.png) repeat-x;cursor:pointer;color:#fff;border:1px solid #111;}

#dataform{text-align:left;}
#dataform input,#dataform textarea,#dataform .helpbox{margin-left:10px;}

.gap{height:10px;}

hr{background-color:#dbdbdb;border:0;height:1px;margin:15px 0;clear:both;}

cite,em,i{font-style:italic;font-weight:normal;}

sup,sub{height:0;line-height:1;vertical-align:baseline;position:relative;}
sup{bottom:1ex;}
sub{top:0.5ex;}
.entry-content sup,.entry-content sub{font-size:16px;}

abbr,acronym{border-bottom:1px dashed #dbdbdb;cursor:help;}

del{text-decoration:line-through;}

.nextprev{clear:both;text-align:right;font-weight:700;text-transform:uppercase;font-size:small;margin:30px 0;}
.nextprev_link{background:#afafaf;color:#fff;text-decoration:none;padding:7px 12px;}
.nextprev a{color:#fff;text-decoration:none;}
.nextprev a:hover{background:#111;color:#fff;text-decoration:none;}
.nextprev_current{background:#fafafa;cursor:default;border:1px solid #eaeaea;padding:6px 11px;}

.indent{font:small Georgia,"Times New Roman",Times,serif;color: #444;margin:0 10px;padding:10px;border-left: #AFAFAF solid 4px;}
div.code-box ol{margin:0;padding:0 10px;}
div.code_highlight{white-space:normal;}

label{text-transform:uppercase;padding-left:8px;}
input{font:small 'Helvetica Neue', Arial,sans-serif;background:#fafafa;padding:5px 10px;border:1px solid #dbdbdb;color:#898989;margin-top:5px;max-width:235px;}
textarea,.helpbox{font:small 'Helvetica Neue', Arial,sans-serif;background:#fafafa;padding:5px 10px;border:1px solid #dbdbdb;color:#898989;margin-top:5px;max-width:235px;}
.helpbox{width:100%;}
.MobCom textarea,.MobCom helpbox{width:100px;}

div.Forumbox{display:block;position:relative;border:1px solid #eaeaea;background-color:#fff;padding:10px;margin-bottom:20px;border-radius:3px;-moz-border-radius:3px;-webkit-border-radius:3px;}
div.ForumInfo,div.ForumInfo2,div.ForumInfo3{position:relative;border-top:1px dashed #eaeaea;padding:5px 0;color:#7d7d7d;font-size:smaller;margin-top:5px;text-align:right;}
div.ForumInfo2{text-align:left;}
div.ForumInfo3{text-align:left;border-bottom:1px dashed #eaeaea;border-top:0;margin-top:0;margin-bottom:5px;}
div.fReplies{position:absolute;top:5px;right:0;}

pre{font-family:\"Courier 10 Pitch\",Courier,monospace;background:#eaeaea;color:#464646;margin:5px 10px 15px 10px;padding:1.5em;overflow:scroll;}
div.code-box,code{font-size:small;color:#7d7d7d;font-family:Monaco, Consolas, \"Andale Mono\", \"DejaVu Sans Mono\", monospace;overflow:scroll;}

.fborder {border:0;}
.forumheader{background-color:#fff;font-weight:700;padding:5px;border:1px solid #ebebeb;}
.forumheader2{background-color:#fff;padding:4px;border:#eaeaea 1px solid;}
.forumheader3{padding:4px;border:#eaeaea 1px solid;}
.forumborder{border:#eaeaea 1px solid;}
.fcaption {border:#eaeaea 1px solid;padding:2px 0 2px 0;background-color:#fff;}
.finfobar{background-color: #fff;padding: 4px;border: 1px solid #ebebeb;font-size:smaller;}
.nforumholder{padding:0 0 5px 0;}
.nforumcaption {padding: 8px 4px 8px 4px;}
.nforumcaption2{padding: 2px 0px 2px 1px;font-weight: bold;}
.nforumcaption3{border:1px solid #eaeaea;padding:4px;background-color:#fff;}

.nforumview,.nforumview2 {
	padding:4px;
	font-size:smaller;
	border-top-width: 1px;
	border-right-width-value: 1px;
	border-right-width-ltr-source: physical;
	border-right-width-rtl-source: physical;
	border-bottom-width: 1px;
	border-left-width-value: 1px;
	border-left-width-ltr-source: physical;
	border-left-width-rtl-source: physical;
	border-top-style: solid;
	border-right-style-value: solid;
	border-right-style-ltr-source: physical;
	border-right-style-rtl-source: physical;
	border-bottom-style: solid;
	border-left-style-value: solid;
	border-left-style-ltr-source: physical;
	border-left-style-rtl-source: physical;
	border-top-color: #eaeaea;
	border-right-color-value: #eaeaea;
	border-right-color-ltr-source: physical;
	border-right-color-rtl-source: physical;
	border-bottom-color: #eaeaea;
	border-left-color-value: #eaeaea;
	border-left-color-ltr-source: physical;
	border-left-color-rtl-source: physical;
}

.nforumthread,.nforumthread2 {
	padding:4px;
	font-size:smaller;
	border-top-width: 1px;
	border-right-width-value: 1px;
	border-right-width-ltr-source: physical;
	border-right-width-rtl-source: physical;
	border-bottom-width: 1px;
	border-left-width-value: 1px;
	border-left-width-ltr-source: physical;
	border-left-width-rtl-source: physical;
	border-top-style: solid;
	border-right-style-value: solid;
	border-right-style-ltr-source: physical;
	border-right-style-rtl-source: physical;
	border-bottom-style: solid;
	border-left-style-value: solid;
	border-left-style-ltr-source: physical;
	border-left-style-rtl-source: physical;
	border-top-color: #eaeaea;
	border-right-color-value: #eaeaea;
	border-right-color-ltr-source: physical;
	border-right-color-rtl-source: physical;
	border-bottom-color: #eaeaea;
	border-left-color-value: #eaeaea;
	border-left-color-ltr-source: physical;
	border-left-color-rtl-source: physical;
}
.nforumreplycaption{border:1px solid #eaeaea;padding:5px;background-color:#fff;}
.nforumreply{border:1px solid #eaeaea;padding:4px;background-color:#fff;}
.nforumreply2{border:1px solid #eaeaea;padding:5px;background-color:#fff;font-size:smaller;}

.smalltext,.smallblacktext {
font-size:0.7em;
}
