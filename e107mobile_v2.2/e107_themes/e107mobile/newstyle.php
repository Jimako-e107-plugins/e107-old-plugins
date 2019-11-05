<?php
// require_once('./../../class2.php');
global $pref;
$em_pref=explode("|",$pref['mobile_colourScheme']);
header('Content-type: text/css;');



?>

#header {
	border-bottom: 1px solid black;
	background-color: <? echo $em_pref[1];?>;
	font: <? echo $em_pref[3];?>em tahoma, arial, helvetica, sans-serif;
	color:<? echo $em_pref[2];?>;
	text-align: center;
}

#quote {
	position: absolute;
	left:6px;
	top:60px;
	color: #176f8f;
}

#banner {
	position: absolute;
	right:6px;
	top:10px;
}


#menuarea {
	font: 11px tahoma, verdana, arial, helvetica, sans-serif;
	color:#000033;
	padding: 0px;
	text-align:left;
}

#menuarea img {
	display:none
}

#centre {
	margin-left: auto;
	margin-right: auto;
	text-align: center;
}


ul{
	list-style: square;
}


#footer {
	border-top: 1px solid #000;
	width: 100%;
	text-align: center;
}

h1 {
  font-size: 1.4em;
  font-weight: bold;
  margin-top: 0em;
  margin-bottom: 0em;
  color: #bbbc;
}

h2 {
	font: 12px arial, verdana, tahoma, helvetica, sans-serif;
	color: #bbb;
	text-transform: uppercase;
	font-weight: bold;
	margin-top: 2px;
	margin-bottom: 0px;
}

h3 {
	font: 14px tahoma, verdana, helvetica, arial, sans-serif;
	color: #000;
	font-weight: bold;
	margin-top: 2px;
	margin-bottom: 0px;
	border: 1px solid #fff;
	padding: 4px;
	background-color: #eceef4;
}

h4 {
	font: 12px tahoma, verdana, helvetica, arial, sans-serif;
	color: #000;
	font-weight: bold;
	text-align:center;
	margin-top: 2px;
	margin-bottom: 0px;
	background-color: #eae6e6;
	padding: 2px;
}


hr {
	border: 1px dotted #bbb;
	height: 1px;
	width: 92%;
	text-align:center;
}

.smalltext {
	font: 9px tahoma, verdana, arial, helvetica, sans-serif;
	color:#5d6e75;
	text-align:center;
}

.bodytable {
	border: 1px solid #fff;
	padding: 4px;
	background-color: #EEF2F7;
	font: <? echo $em_pref[4];?>em verdana, tahoma, arial, helvetica, sans-serif;
	color: #000
}

.bodytable img {
max-width: <? echo $em_pref[5];?>px;
}


.button {
	border: #000 1px solid;
	color: #000;
	font: 9px verdana, tahoma, arial, helvetica, sans-serif;
	text-align:center;
	background-image : url(images/button.png);
}

.button a {
	color: #000;
}
.button a:hover {
	color: #0085b0;
}

body {
	font-size: 12px;
	color: #000;
	font-family: tahoma, verdana, arial, sans-serif;
	background-color: #fff;
	margin:0px;
	padding:0px;
	text-align:left
}
a {
	color: #0085b0;
	font-family: verdana, arial, sans-serif;
	text-decoration: underline;
}
a:hover {
	color: #616060;
	font-family: verdana, arial, sans-serif;
	text-decoration: underline;
}

.smallblacktext {
    background: none;
	font: 10px tahoma, verdana, arial, helvetica, sans-serif;
	color:#000;
}
.indent{
	padding: 10px 10px 10px 10px;
	margin: 5px;
	font: 9px verdana, tahoma, arial, sans-serif;
	color: #838387;
	border: 1px solid #d6d6d6;
}
.defaulttext {
    background: none;
	font: 11px verdana, tahoma, arial, helvetica, sans-serif;
	color:#000;
}

td {
	font: 11px tahoma, verdana, arial, helvetica, sans-serif;
	color:#000033;
	padding: 0px;
	text-align:left;
}


blockquote {
	font-family: verdana, tahoma, arial, helvetica, sans-serif;
	color:#7e96ac;
	border: 1px solid #d6d6d6;
}
.mediumtext {
	font: 11px verdana, tahoma, arial, helvetica, sans-serif;
	color:#000;
}

.tbox{
	background-color: #F4F7FA;
	border: #5e5d63 1px solid;
	color: #000000;
	font: 10px verdana, tahoma, arial, helvetica, sans-serif;
}

.tbox.chatbox{
	background-color: #F4F7FA;
	border: #5e5d63 1px solid;
	color: #000000;
	font: 10px verdana, tahoma, arial, helvetica, sans-serif;
	width: 90%;
}

.nextprev{
	background-color: #eaeef2;
	/* border: #000 1px solid; */
	color: #000000;
	font: 9px verdana, tahoma, arial, helvetica, sans-serif;
	text-align:center;
	padding : 2px;
}

form {
	margin: 2px 0px 0px 0px;
}
.spacer {
	padding: 2px 0 2px 0;
}

.cspacer {
	padding: 6px 0 6px 0;
	margin-left: auto;
	margin-right: auto;
	text-align: center;
}

.border {
	border: #999 1px solid;
	background-color: #F0F1F1;
	padding: 2px;
}


p {
	margin-top: 0px
}

.fborder {
	border: #c1c1c1 1px solid;
}
.forumheader{
	background-color: #f3f3f7;
	font: 12px verdana, tahoma, arial, helvetica, sans-serif;
	color:#000;
	padding: 4px;
	border: 1px solid #ececf2;
}

.forumheader2{
	background-color: #EFEFEF;
	font: 12px verdana, tahoma, arial, helvetica, sans-serif;
	color:#000;
	padding: 4px;
	border: #C3BDBD 1px solid;
}

.forumheader3{
	background-color: #f3f3f7;
	font: 11px verdana, tahoma, arial, helvetica, sans-serif;
	color:#000;
	padding: 4px;
	border: #ececf2 1px solid;
}

.forumborder{
	border: #000080 1px solid;
}

.fcaption {
	border: #f0f2f4 1px solid;
	padding: 2px 0 2px 0;
	background-color: #f9fafb;
	font: 12px verdana, tahoma, arial, helvetica, sans-serif;
	color:#616060;
}

.finfobar{
	background-color: #CCC8C8;
	color:#000;
	padding: 4px;
	border: 1px solid #C3BDBD;
	font-style:normal; font-variant:normal; font-weight:normal; font-size:11px; font-family:verdana, tahoma, arial, helvetica, sans-serif
}

.helpbox {
	color:#000;
	font: 9px tahoma, verdana, arial, helvetica, sans-serif;
	border: 0px none red;
	background-color: transparent;
}

.nforumholder {
	/* border: 1px solid #345487; */
	padding: 0px;
	/* background-color: #fff; */
}

.nforumcaption {
	padding: 8px 4px 8px 4px;
	font: 12px verdana, tahoma, arial, helvetica, sans-serif;
	color: #fff;
}

.nforumcaption2 {
	padding: 2px 0px 2px 1px;
	font: 10px verdana, tahoma, arial, helvetica, sans-serif;
	color: #000;
	font-weight: bold;
}

.nforumcaption3 {
	border: 1px solid #fff;
	padding: 4px;
	background-color: #E4EAF2;
	font: 12px verdana, tahoma, arial, helvetica, sans-serif;
}

.nforumthread {
	border: 1px solid #fff;
	padding: 4px;
	background-color: #EEF2F7;
	font: 12px verdana, tahoma, arial, helvetica, sans-serif;
}

.nforumthread2 {
	border: 1px solid #fff;
	padding: 4px;
	background-color: #D1DCEB;
	font: 10px verdana, tahoma, arial, helvetica, sans-serif;
}

.nforumreplycaption {
	border: 1px solid #fff;
	padding: 4px;
	background-color: #E2EDF2;
	font: 12px verdana, tahoma, arial, helvetica, sans-serif;
}

.nforumreply {
	border: 1px solid #fff;
	padding: 4px;
	background-color: #EDF4F7;
	font: 10px verdana, tahoma, arial, helvetica, sans-serif;
}

.nforumreply2 {
	border: 1px solid #fff;
	padding: 4px;
	background-color: #CFE0EB;
	font: 10px verdana, tahoma, arial, helvetica, sans-serif;
}
.nforumdisclaimer {
	font: 9px verdana, tahoma, arial, helvetica, sans-serif;
	color:#5d6e75;
}

.nforumview1 {
	border: 1px solid #fff;
	padding: 4px;
	background-color: #E4EAF2;
	font: 10px verdana, tahoma, arial, helvetica, sans-serif;
}

.nforumview2 {
	border: 1px solid #fff;
	padding: 4px;
	background-color: #DFE6EF;
	font: 10px verdana, tahoma, arial, helvetica, sans-serif;
}

.nforumview3 {
	padding: 4px;
	background-color: #BCD0ED;
	font: 10px verdana, tahoma, arial, helvetica, sans-serif;
	color: #263448;
}

.nforumview4 {
	padding: 4px;
	background-color: #E4EAF2;
	font: 9px verdana, tahoma, arial, helvetica, sans-serif;
	color: #3A4F6C;
}

a.forumlink{
	color: #000;
	text-decoration: none;
}

a.forumlink:hover {
	color: #bbb;
	text-decoration: underline;
}

.treeclass1 {
	background-color: #F4F7FA;
	border: #5e5d63 1px solid;
	color: #000000;
	font: 9px verdana, tahoma, arial, helvetica, sans-serif;
	padding: 2px 0px 2px 2px;
}

.treeclass2 {
	background-color: #F4F7FA;
	border: #000 1px solid;
	color: #000000;
	font: 9px verdana, tahoma, arial, helvetica, sans-serif;
	padding: 2px 0px 2px 2px;
}

.treeclass3 {
	background-color: #F4F7FA;
	color: #000000;
	font: 9px verdana, tahoma, arial, helvetica, sans-serif;
	padding: 1px;
	width: 100%;
}
