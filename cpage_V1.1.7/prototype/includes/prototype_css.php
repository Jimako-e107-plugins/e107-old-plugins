<?php
#require_once('../../class2.php');
#$prototype_pathto=SITEURL.$PLUGINS_DIRECTORY.'prototype/';
echo"

/*
#fixpic {display:block; width:108px height:145px; position:fixed; bottom:0; left:0;}
* html #fixpic {position:absolute;}
*/

// <!--[if lte IE 6]>
//   /*<![CDATA[html {overflow-x:auto; overflow-y:hidden;}]]>*/
// <![endif] -->


#fb_prototype_message{

}
.fb_info, .fb_success, .fb_warning, .fb_error, .fb_validation, .fb_blank {
border: 1px solid;
margin: 2px;
padding:15px 10px 15px 50px;
background-repeat: no-repeat;
background-position: 10px center;

}

.fb_info {
color: #00529B;

background-color: #BDE5F8;
background-repeat: no-repeat;
background-image: url(".$url."info.png);
}

.fb_success {
color: #4F8A10;
background-color: #DFF2BF;
background-repeat: no-repeat;
background-image:url(".$url."success.png);
}

.fb_warning {
color: #9F6000;
background-color: #FEEFB3;
background-repeat: no-repeat;
background-image: url(".$url."warning.png);
}

.fb_error {
color: #D8000C;
background-color: #FFBABA;
background-repeat: no-repeat;
height:20px;
background-image: url(".$url."error.png);
}

.fb_validation {
color: #D63301;
background-color: #FFCCBA;
background-repeat: no-repeat;
background-image: url(".$url."validation.png);
}

.fb_blank {
border:1px transparent;
background-repeat: no-repeat;
background-image: url(".$url."blank.png);
}

.redit{
border-style:solid;
border-color:#ff0000;
border-width:2px;
}
div.autocomplete {
  position:absolute;
  width:250px;
  background-color:white;
  border:1px solid #888;
  margin:0;
  padding:0;
}
div.autocomplete ul {
  list-style-type:none;
  margin:0;
  padding:0;
}
div.autocomplete ul li.selected { background-color: #ffb;}
div.autocomplete ul li {
  list-style-type:none;
  display:block;
  margin:0;
  padding:2px;
  height:16px;
  cursor:pointer;
}

#fb_newsticker {
	background: #ffffaf;
	position: relative;
	text-align:center;
	clear:both;
}
#fb_newsticker ul {
	border: 1px solid #fcf498;
	list-style: none;
	min-height: 1.6em;
	padding: 10px 15px;
	padding-right: 30px;
}
* html #fb_newsticker ul {
	height: 1.6em;
	overflow: visible;
}
#fb_newsticker li.error {
	color: #f00;
}
#fb_newsticker #togglenewsticker {
	background: transparent url(".$url."icon_closenewsticker.gif) no-repeat 0 0;
	overflow: hidden;
	position: absolute;
	right: 10px;
	top: 12px;
	width: 14px;
	height: 14px;
	text-indent: 20px;
	outline: none;
}
* html #fb_newsticker #togglenewsticker {
	right: 30px;
}

#lightbox{	position: absolute;	left: 0; width: 100%; z-index: 100; text-align: center; line-height: 0;}
#lightbox img{ width: auto; height: auto;}
#lightbox a img{ border: none; }

#outerImageContainer{ position: relative; background-color: #fff; width: 250px; height: 250px; margin: 0 auto; }
#imageContainer{ padding: 10px; }

#loading{ position: absolute; top: 40%; left: 0%; height: 25%; width: 100%; text-align: center; line-height: 0; }
#hoverNav{ position: absolute; top: 0; left: 0; height: 100%; width: 100%; z-index: 10; }
#imageContainer>#hoverNav{ left: 0;}
#hoverNav a{ outline: none;}

#prevLink, #nextLink{ width: 49%; height: 100%; background-image: url(data:image/gif;base64,AAAA); /* Trick IE into showing hover */ display: block; }
#prevLink { left: 0; float: left;}
#nextLink { right: 0; float: right;}
#prevLink:hover, #prevLink:visited:hover { background: url(".$url."prevlabel.gif) left 15% no-repeat; }
#nextLink:hover, #nextLink:visited:hover { background: url(".$url."nextlabel.gif) right 15% no-repeat; }

#imageDataContainer{ font: 10px Verdana, Helvetica, sans-serif; background-color: #fff; margin: 0 auto; line-height: 1.4em; overflow: auto; width: 100%	; }

#imageData{	padding:0 10px; color: #666; }
#imageData #imageDetails{ width: 70%; float: left; text-align: left; }
#imageData #caption{ font-weight: bold;	}
#imageData #numberDisplay{ display: block; clear: left; padding-bottom: 1.0em;	}
#imageData #bottomNavClose{ width: 66px; float: right;  padding-bottom: 0.7em; outline: none;}

#overlay{ position: absolute; top: 0; left: 0; z-index: 90; width: 100%; height: 500px; background-color: #000; }
";