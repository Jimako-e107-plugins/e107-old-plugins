<?php
if (!defined('e107_INIT')) { exit; }
header("Content-type: text/html; charset=".CHARSET, true);
echo "<?xml version='1.0' encoding='utf-8' ?>\n";
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.1//EN' 'http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='bg'>
<head>
<title>Corllete Lab Gallery</title>
<link rel='stylesheet' href='<?php echo SGAL_PUBLISH_ABS; ?>style.css' type='text/css' />
<meta http-equiv='content-type' content='text/html; charset=utf-8' />
<meta http-equiv='content-style-type' content='text/css' />
<?php
// ---------- Favicon ---------
if (file_exists(THEME."favicon.ico")) {
	echo "<link rel='icon' href='".THEME_ABS."favicon.ico' type='image/x-icon' />\n<link rel='shortcut icon' href='".THEME_ABS."favicon.ico' type='image/xicon' />\n";
}elseif (file_exists(e_BASE."favicon.ico")) {
	echo "<link rel='icon' href='".SITEURL."favicon.ico' type='image/x-icon' />\n<link rel='shortcut icon' href='".SITEURL."favicon.ico' type='image/xicon' />\n";
}
?>
<script type='text/javascript' src='<?php echo e_FILE_ABS; ?>e107.js'></script>
<script type='text/javascript'>
// <![CDATA[
var onBackUrl = null;
var submitOnNext = false;
var title='Corllete Lab Gallery<?php echo $_SERVER['HTTP_HOST'] ? ' @ '.$_SERVER['HTTP_HOST']: ''; ?>';
impl = window.external;

function setOnBackUrl(url) {
	onBackUrl = url;
}
function setButtons(backButton, nextButton, finishButton) {
	impl.SetWizardButtons(backButton, nextButton, finishButton);
}
function setSubtitle(subTitle) {
	impl.SetHeaderText(title, subTitle);
}
function OnBack() {
	if (onBackUrl) {
		window.location.href = onBackUrl;
		setButtons(false, true, false);
	} else {
		impl.FinalBack();
	}																																												
}
function setSubmitOnNext(boolValue) {
	submitOnNext = boolValue;
}
function OnNext() {
	if (submitOnNext) {
		document.getElementById('publish').submit();
	}
}

// ]]>
</script>
<?php
// --- Load plugin Meta files and eplug_ before others --------
if (is_array($pref['e_meta_list']))
{
	foreach($pref['e_meta_list'] as $val)
	{
		if($val=='rss' || $val=='log') continue; //dirty fix - some improvements needed here though!
        if(is_readable(e_PLUGIN.$val."/e_meta.php"))
		{
			echo "<!-- $val meta -->\n";
			require_once(e_PLUGIN.$val."/e_meta.php");
		}
	}
}
?>
</head>
<body>