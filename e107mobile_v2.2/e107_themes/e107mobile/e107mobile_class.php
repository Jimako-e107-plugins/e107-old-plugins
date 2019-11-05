<?php
/*
+------------------------------------------------------------------------------+
|     e107 Mobile  v2.2 by Martinj
|	November 2010
|	Visit www.martinj.co.uk for help and support
+------------------------------------------------------------------------------+
*/

function getMobileCSS($E107MOBILE_CS, $E107MOBILE_LS) {

$em_pref=explode("|",$E107MOBILE_CS);
$em_prefSL=explode("|",$E107MOBILE_LS);

$ret= "
body{margin:0px;padding:0px;font-family:'helvetica neue',arial,sans-serif;font-size:". $em_pref[4]."em;color:#333}

.bodytable {margin:0px;padding:0px;font-family:'helvetica neue',arial,sans-serif;font-size:". $em_pref[4]."em;color:#333}
a{color:#111;
	text-decoration:none;
	cursor:pointer;
}

a:hover{text-decoration:underline;}

#header a {
display: block;
background-color: ". $em_pref[1].";
font-weight: bold;
font-size: ". $em_pref[3]."em;
color: ". $em_pref[2].";
text-align: center;
padding-top: 4px;
padding-bottom: 4px;
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
border-top-color: ". $em_pref[2].";
border-right-color-value: ". $em_pref[2].";
border-right-color-ltr-source: physical;
border-right-color-rtl-source: physical;
border-bottom-color: ". $em_pref[2].";
border-left-color-value: ". $em_pref[2].";
border-left-color-ltr-source: physical;
border-left-color-rtl-source: physical;
outline-width: 1px;
outline-style: solid;
outline-color: ". $em_pref[1].";
text-decoration: none;
}

#header a:hover{text-decoration:underline;}

h1{font-size:1.286em;}
h2{font-size:1.143em;}
h3{font-size:1em;}
h4{font-size:0.857em;}
h5{font-size:0.714em;}
h6{font-size:0.571em;}

ul.nav{list-style:none;padding-left:4px;padding-right:4px;}
li.topnav{background:". $em_prefSL[0].";padding:2px 0 2px 0;margin:8px 0;border:1px solid #dbdbdb;border-radius:3px;-moz-border-radius:3px;-webkit-border-radius:3px;}
li.topnav a{display:block;color:". $em_prefSL[1].";font-size:".$em_prefSL[2]."em;font-weight:bold;text-transform:uppercase;text-decoration:none;text-align:center;}
li.topnav a:hover{color:". $em_prefSL[1].";}
li.botnav{background:#111 url(images/h2bg.png) repeat-x;padding:8px 0 8px 10px;margin:4px 0;border:1px solid #111;border-radius:3px;-moz-border-radius:3px;-webkit-border-radius:3px;}
li.botnav a{display:block;color:#fff;font-size:small;font-weight:bold;text-transform:uppercase;text-decoration:none;}
li.botnav a:hover{color:#fff;text-decoration:underline;}

pre{font-family:\"Courier 10 Pitch\",Courier,monospace;background:#eaeaea;color:#464646;margin:5px 10px 15px 10px;padding:1.5em;overflow:scroll;}
div.code-box,code{font-size:small;color:#7d7d7d;font-family:Monaco, Consolas, \"Andale Mono\", \"DejaVu Sans Mono\", monospace;overflow:scroll;}

blockquote{quotes:none;font:". $em_pref[4]."em Georgia,\"Times New Roman\",Times,serif;font-style:italic;padding:20px 20px 15px 15px !important;border-left:none !important;border-top:1px dashed #dbdbdb;border-bottom:1px dashed #dbdbdb;background-color:transparent !important;margin-top:5px !important;margin-bottom:5px !important;margin-left:10px !important;margin-right:10px !important;overflow:scroll;}
";

if($em_pref[7]=='off'){
$ret .=".bodytable img {
max-width: ".$em_pref[5]."px;
max-height: ".$em_pref[6]."px;
border:none;
}";
}
else {
$ret .=".bodytable img{
display:none;
}";
}

return $ret;
}
