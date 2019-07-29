<?php
/* $Id: content_preset.php 13079 2013-03-07 21:17:13Z e107steved $ */
require_once('../../../class2.php');
require_once(e_HANDLER.'form_handler.php');
$rs = new form;

include_lan(e_PLUGIN."content/languages/".e_LANGUAGE."/lan_content.php");
include_lan(e_PLUGIN."content/languages/".e_LANGUAGE."/lan_content_admin.php");

$months = array(CONTENT_ADMIN_DATE_LAN_0, CONTENT_ADMIN_DATE_LAN_1, CONTENT_ADMIN_DATE_LAN_2, CONTENT_ADMIN_DATE_LAN_3, CONTENT_ADMIN_DATE_LAN_4, CONTENT_ADMIN_DATE_LAN_5, CONTENT_ADMIN_DATE_LAN_6, CONTENT_ADMIN_DATE_LAN_7, CONTENT_ADMIN_DATE_LAN_8, CONTENT_ADMIN_DATE_LAN_9, CONTENT_ADMIN_DATE_LAN_10, CONTENT_ADMIN_DATE_LAN_11);

$text = '';
$value = '';

if(isset($_POST['addpreset']))
{
	if(!$_POST['field'])
	{
		$err = "<br /><b>".CONTENT_PRESET_LAN_0."</b><br /><br />";
	}
	else
	{
		$err = '';
		$_POST['field'] = $tp->toDB($_POST['field']);
		switch ($_POST['type'])
		{
			case 'text' :
				if(!($_POST['text_size'] && $_POST['text_maxsize'] && is_numeric($_POST['text_size']) && is_numeric($_POST['text_maxsize'])) )
				{
					$err .= "<br /><b>".CONTENT_PRESET_LAN_1."<br />".CONTENT_PRESET_LAN_3."</b><br />";
				}
				else
				{
					$value = $_POST['field'].'^text^'.intval($_POST['text_size'])."^".intval($_POST['text_maxsize']);
				}
				break;
			case 'area' :
				if(!($_POST['area_cols'] && $_POST['area_rows'] && is_numeric($_POST['area_cols']) && is_numeric($_POST['area_rows'])) ){
					$err .= "<br /><b>".CONTENT_PRESET_LAN_1."<br />".CONTENT_PRESET_LAN_4."</b><br />";
				}
				else
				{
					$value = $_POST['field'].'^area^'.intval($_POST['area_cols'])."^".intval($_POST['area_rows']);
				}
				break;
			case 'select' :
				$options = implode("^", $_POST['options']);
				if(!$_POST['options'][0] && !$_POST['options'][1])
				{
					$err .= "<br /><b>".CONTENT_PRESET_LAN_1."<br />".CONTENT_PRESET_LAN_5."</b><br />";
				}
				else
				{
					$value = $_POST['field'].'^select^'.$options;
				}
				break;
			case 'date' :
				if(!($_POST['date_year_from'] && $_POST['date_year_to'] && is_numeric($_POST['date_year_from']) && is_numeric($_POST['date_year_to'])) )
				{
					$err .= "<br /><b>".CONTENT_PRESET_LAN_1."<br />".CONTENT_PRESET_LAN_6."</b><br />";
				}
				else
				{
					$value = $_POST['field'].'^date^'.intval($_POST['date_year_from']).'^'.intval($_POST['date_year_to']);
				}
				break;
			case 'checkbox' :
				if(!$_POST['checkbox_value'])
				{
					$err .= "<br /><b>".CONTENT_PRESET_LAN_1."<br />".CONTENT_PRESET_LAN_20."</b><br />";
				}
				else
				{
					$value = $_POST['field'].'^checkbox^'.$_POST['checkbox_value'];
				}
				break;
			case 'radio' :
				if(!($_POST['radio_value'] && $_POST['radio_text'] && $_POST['radio_value']!="" && $_POST['radio_text']!=""))
				{
					$err .= "<br /><b>".CONTENT_PRESET_LAN_1."<br />".CONTENT_PRESET_LAN_19."</b><br />";
				}
				else
				{
					if(count($_POST['radio_value']) != count($_POST['radio_text']))
					{
						$err .= CONTENT_PRESET_LAN_19;
					}
					else
					{
						for($i=0;$i<count($_POST['radio_text']);$i++)
						{
							$radio .= $_POST['radio_text'][$i]."^".$_POST['radio_value'][$i]."^";
						}
						$radio = substr($radio,0,-1);
						$value = $_POST['field'].'^radio^'.$radio;
					}
				}
				break;
			default :
				header('location:'.e_BASE.'index.php');
				exit();
		}
	}
	if(!$err)
	{
		$value = $tp->post_toForm($value);

		$js = "		
		<script type='text/javascript'>

		var ecopy		= 'upline_new';
		var epaste		= 'div_content_custom_preset';
		var type		= window.opener.document.getElementById(ecopy).nodeName; // get the tag name of the source copy.
		var br			= window.opener.document.createElement('br');

		var field		= window.opener.document.createElement('input');
		field.type		= 'text';
		field.size		= '50';
		field.name		= 'content_custom_preset_key[]';
		field.value		= '".$value."';
		field.className	= 'tbox';

		var but			= window.opener.document.createElement('input');
		but.type		= 'button';
		but.value		= 'x';
		but.className	= 'button';
		but.onclick		= function(){ this.parentNode.parentNode.removeChild(this.parentNode); };

		var destination = window.opener.document.getElementById(epaste);
		var source      = window.opener.document.getElementById(ecopy).cloneNode(true);
		var newentry	= window.opener.document.createElement(type);

		newentry.appendChild(source);
		newentry.value='';
		newentry.appendChild(br);
		newentry.appendChild(field);
		newentry.appendChild(but);
		newentry.appendChild(br);

		destination.appendChild(newentry);

		window.close();
		</script>\n
		";
	}
}


$text .= "
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd'>\n
<html>\n
<head>\n
<title>".CONTENT_PRESET_LAN_7."</title>\n
<meta http-equiv='content-type' content='text/html; charset=".CHARSET."' />\n
<script type='text/javascript' src='../../../e107_files/e107.js'></script>
".$js."
<style type='text/css'>\n
html,body{
	text-align:center;
	font-family: verdana, arial, helvetica, tahoma, sans-serif;
	font-size: 11px;
	color: #444;
	margin-left: auto;
  	margin-right: auto;	
  	margin-top:0px;
	margin-bottom:0px;
	padding: 0px;
	background-color:#FFF;
	height:100%;
	cursor:default;
}
td{
	padding:5px;
	font-size:11px;
	text-align:left;
}
.fborder{
	width:80%;
	margin:0;
	padding:0;
}
.fcaption{
	font-size:12px;
	font-weight:bold;
	white-space:nowrap;
}
.err{
	font-size:11px;
	font-weight:bold;
	color: #FF0000;
}
.leftcell{
	width:10%;
	white-space:nowrap;
}
.button{
	padding:2px;
	cursor:pointer;
}
.example {
	border: #999 1px dashed;
	padding: 5px;
	margin: 5px;
	background-color: #f7f7f9;
}
</style>
</head>
<body onload=self.focus()>";

$opt = '';
if (e_QUERY)
{
	$qs = explode(".", e_QUERY);
	$opt = $tp->toDB($qs[0]);
}


$text .= "
<form method='post' action='".e_SELF."?".e_QUERY."'>\n
<table class='fborder' style='width:350px;'>
".($err ? "<tr><td colspan='2' class='err' style='padding-bottom:10px;'>".$err."</td></tr>" : "")."
<tr><td colspan='2' class='fcaption' style='padding-bottom:10px;'>".CONTENT_PRESET_LAN_8." : ".$opt."</td></tr>
<tr><td class='leftcell'>".CONTENT_PRESET_LAN_9."</td><td>".$rs -> form_text("field", 40, $_POST['field'], 50)."</td></tr>";

switch ($opt)
{
	case 'text' :
		$text .= "
		<tr><td class='leftcell'>".CONTENT_PRESET_LAN_10."</td><td>".$rs -> form_text("text_size", 3, $_POST['text_size'], 3)."</td></tr>
		<tr><td class='leftcell'>".CONTENT_PRESET_LAN_11."</td><td>".$rs -> form_text("text_maxsize", 3, $_POST['text_maxsize'], 3)."</td></tr>
		";
		$example = CONTENT_PRESET_LAN_32."<br /><br />".$rs -> form_text("extext", 40, CONTENT_PRESET_LAN_9."=".CONTENT_PRESET_LAN_32.", ".CONTENT_PRESET_LAN_10."=40, ".CONTENT_PRESET_LAN_11."=10", 100);
		break;

	case 'area' :
		$text .= "
		<tr><td class='leftcell'>".CONTENT_PRESET_LAN_12."</td><td>".$rs -> form_text("area_cols", 3, $_POST['area_cols'], 3)."</td></tr>
		<tr><td class='leftcell'>".CONTENT_PRESET_LAN_13."</td><td>".$rs -> form_text("area_rows", 3, $_POST['area_rows'], 3)."</td></tr>
		";
		$example = CONTENT_PRESET_LAN_32."<br /><br />".$rs -> form_textarea("exarea", 30, 4, "".CONTENT_PRESET_LAN_9."=".CONTENT_PRESET_LAN_32."\n".CONTENT_PRESET_LAN_12."=30\n".CONTENT_PRESET_LAN_13."=4", $form_js = "", $form_style = "", $form_wrap = "", $form_readonly = "", $form_tooltip = "");
		break;

	case 'date' :
		$text .= "
		<tr><td class='leftcell'>".CONTENT_PRESET_LAN_14."</td><td>".$rs -> form_text("date_year_from", 3, $_POST['date_year_from'], 4)."</td></tr>
		<tr><td class='leftcell'>".CONTENT_PRESET_LAN_15."</td><td>".$rs -> form_text("date_year_to", 3, $_POST['date_year_to'], 4)."</td></tr>
		";
		$example = CONTENT_PRESET_LAN_32." ".CONTENT_PRESET_LAN_14." 1990, ".CONTENT_PRESET_LAN_15." 2000<br /><br />
			".$rs -> form_select_open("exday", "")."
			".$rs -> form_option(CONTENT_ADMIN_DATE_LAN_12, "0", "");
		for($i=1;$i<=31;$i++){
			$example .= $rs -> form_option($i, ($values[$tmp[0]]['day'] == $i ? "1" : "0"), $i, "");
		}
		$example .= $rs -> form_select_close();

		$example .= $rs -> form_select_open("exmonth", "")."
		".$rs -> form_option(CONTENT_ADMIN_DATE_LAN_13, "0", "");
		for($i=1;$i<=12;$i++){
			$example .= $rs -> form_option($months[($i-1)], ($values[$tmp[0]]['month'] == $i ? "1" : "0"), $i, "");
		}
		$example .= $rs -> form_select_close();

		$example .= $rs -> form_select_open("exyear", "")."
		".$rs -> form_option(CONTENT_ADMIN_DATE_LAN_14, "0", "");
		for($i=1990;$i<=2000;$i++){
			$example .= $rs -> form_option($i, "0", $i, "");
		}
		$example .= $rs -> form_select_close();
		break;

	case 'select' :
		$text .= "
		<tr><td class='leftcell' style='vertical-align:top;'>".CONTENT_PRESET_LAN_23."</td>
			<td><input class='tbox' type='text' name='options[0]' size='10' maxlength='100' /> (".CONTENT_PRESET_LAN_24.")</td>
		</tr>
		<tr><td class='leftcell' style='vertical-align:top;'>".CONTENT_PRESET_LAN_16."</td>
			<td>
			<div id='select_container' style='width:40%;white-space:nowrap;'>
			<span id='selectline' style='white-space:nowrap;'>
				<input class='tbox' type='text' name='options[]' size='10' maxlength='100' />
			<input type='button' class='button' value='".CONTENT_PRESET_LAN_17."' onclick=\"duplicateHTML('selectline','select_container');\"  />
			</span><br />
			</div>
		</td></tr>
		";
		$example = CONTENT_PRESET_LAN_32." ".CONTENT_PRESET_LAN_23." = ".CONTENT_PRESET_LAN_32.", options=a,b,c<br /><br />
			".$rs -> form_select_open("exselect", "");
		$example .= $rs -> form_option(CONTENT_PRESET_LAN_32, "0", "", "");
		$example .= $rs -> form_option("a", "0", "a", "");
		$example .= $rs -> form_option("b", "0", "b", "");
		$example .= $rs -> form_option("c", "0", "c", "");
		$example .= $rs -> form_select_close();
		break;


	case 'checkbox' :
		$text .= "<tr><td class='leftcell'>".CONTENT_PRESET_LAN_22."</td><td>".$rs -> form_text("checkbox_value", 3, $_POST['checkbox_value'], 50)."</td></tr>";
		$example = CONTENT_PRESET_LAN_32." ".CONTENT_PRESET_LAN_9." = ".CONTENT_PRESET_LAN_32.", ".CONTENT_PRESET_LAN_22." = 1<br /><br />".CONTENT_PRESET_LAN_32." ".$rs -> form_checkbox("excheckbox", "ex1", $form_checked = 0, $form_tooltip = "", $form_js = "");
		break;
	case 'radio' :
		$text .= "
		<tr><td class='leftcell'></td>
			<td>
			<div id='radio_container' style='width:40%;white-space:nowrap;'>
			<span id='radioline' style='white-space:nowrap;'>
				".CONTENT_PRESET_LAN_21." <input class='tbox' type='text' name='radio_text[]' value='".$_POST['radio_text[]']."' size='8' maxlength='100' />
				".CONTENT_PRESET_LAN_22." <input class='tbox' type='text' name='radio_value[]' value='".$_POST['radio_value[]']."' size='2' maxlength='100' />
			<input type='button' class='button' value='".CONTENT_PRESET_LAN_17."' onclick=\"duplicateHTML('radioline','radio_container');\"  />
			</span><br />
			</div>
		</td></tr>
		";
		$example = CONTENT_PRESET_LAN_32."<br /><br />".$rs -> form_radio("exradio", CONTENT_PRESET_LAN_32." 1", "0", "", "")." ".CONTENT_PRESET_LAN_32." 1 ".$rs -> form_radio("exradio", CONTENT_PRESET_LAN_32." 2", "0", "", "")." ".CONTENT_PRESET_LAN_32." 2";
		break;
}


//process button
$text .= "
<tr><td class='leftcell'>&nbsp;</td><td style='text-align:right;'><input type='hidden' name='type' value='".$opt."' /><input type='submit' class='button' name='addpreset' value='".CONTENT_PRESET_LAN_18."' /><br /><br /></td></tr>\n
<tr><td colspan='2' class='example'>".$example."</td></tr>
</table>\n
</form>\n
</body>\n
</html>\n";

echo $text;

?>