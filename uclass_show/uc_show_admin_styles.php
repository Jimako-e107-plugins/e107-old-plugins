<?php
/*
+---------------------------------------------------------------+
|	e107 website system
|
|	©Steve Dunstan 2001-2005
|	http://e107.org
|	jalist@e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
|
|
|   uclass_show plugin  ver. 1.02 - 20 nov 2012
|   by Alf - http://www.e107works.org
|   Released under the terms and conditions of the
|   Creative Commons "Attribution-Noncommercial-Share Alike 3.0"
|   http://creativecommons.org/licenses/by-nc-sa/3.0/
+---------------------------------------------------------------+
*/


require_once("../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); }

$td_head_class_img_style = "padding:8px;border-bottom:2px solid #ffffff;border-right:1px solid #ffffff;text-align:center;font-weight:bold;";
$td_class_img_style = "padding:8px;border-bottom:2px solid #ffffff;border-right:1px solid #ffffff;text-align:center";
$div_error_style = "width:300px;position:absolute;top:250px;left:50%;padding:12px 16px;margin:0 0 0 -150px;background:#950110;color:#fff;text-align:center;font-size:16px;border-radius: 5px;-moz-border-radius: 5px;-webkit-border-radius: 5px;";
$div_error_no_class = "width:500px;margin:0 auto;clear:both;padding:12px 16px;background:#950110;color:#fff;text-align:center;font-size:16px;border-radius: 5px;-moz-border-radius: 5px;-webkit-border-radius: 5px;";
$div_error_style_double = "width:300px;position:absolute;top:350px;left:50%;padding:12px 16px;margin:0 0 0 -150px;background:#950110;color:#fff;text-align:center;font-size:16px;border-radius: 5px;-moz-border-radius: 5px;-webkit-border-radius: 5px;";
$tr_roll_over = "onmouseover=\"this.style.backgroundColor='#EDDEDE'\" onmouseout=\"this.style.backgroundColor='#F7F7F7'\" style='background-color:#F7F7F7'";
$magnifica_style = "style='position:absolute;top:-24px;left:-22px;width:auto;height:auto;padding:5px;border:1px solid #999;background:#fff;border-radius: 3px;-moz-border-radius: 3px;-webkit-border-radius: 3px;display:none;'";

?>

