<?php
global $sc_style;
$sc_style['EG_ALBUM_LIST']['pre'] = "<div style='text-align:center;'>";
$sc_style['EG_ALBUM_LIST']['post'] = '</div>';

$sc_style['EG_POSITION']['pre'] = '<b>';
$sc_style['EG_POSITION']['post'] = '</b>';

$sc_style['EG_MAX']['pre'] = '<b>';
$sc_style['EG_MAX']['post'] = '</b>';

$sc_style['EG_IMG_PER_PAGE']['pre'] = '';	$sc_style['EG_IMG_PER_PAGE']['post'] = '';
$sc_style['EG_SORT_ORDER']['pre'] = '';		$sc_style['EG_SORT_ORDER']['post'] = '';
$sc_style['EG_IMAGE_TABLE']['pre'] = '';	$sc_style['EG_IMAGE_TABLE']['post'] = '';
$sc_style['EG_COLUMNS']['pre'] = '';		$sc_style['EG_COLUMNS']['post'] = '';
$sc_style['EG_LINK_PREV']['pre'] = '';		$sc_style['EG_LINK_PREV']['post'] = '';
$sc_style['EG_FIRST_DIVIDE']['pre'] = '';	$sc_style['EG_FIRST_DIVIDE']['post'] = '';
$sc_style['EG_PAGES']['pre'] = '';			$sc_style['EG_PAGES']['post'] = '';
$sc_style['EG_LAST_DIVIDE']['pre'] = '';	$sc_style['EG_LAST_DIVIDE']['post'] = '';
$sc_style['EG_LINK_NEXT']['pre'] = '';		$sc_style['EG_LINK_NEXT']['post'] = '';
$sc_style['EG_TOTAL_PAGES']['pre'] = '';	$sc_style['EG_TOTAL_PAGES']['post'] = '';

$sc_style['EG_VERSION_FOOTER']['pre'] = "<div style='text-align:right;'>";
$sc_style['EG_VERSION_FOOTER']['post'] = '</div';

$sc_style['EG_UPLOAD']['pre'] = '';			$sc_style['EG_UPLOAD']['post'] = '';

if (file_exists(THEME.'eg_style.css'))
{
	$style_folder = THEME;
}
else
{
	$style_folder = e_PLUGIN.'easygallery/templates/';
}

// EasyGallery Thumbnails overview
$EG_THUMBS = "
<link rel='stylesheet' type='text/css' href='".$style_folder."eg_style.css'>
<div class='boldText'>".EG_CORE_12.":</div>
{EG_ALBUM_LIST}
<br />
<table width='100%'>
	<tr>
		<td align='left'>
		<table border='0' cellpadding='0' cellspacing='0'>
			<tr>
				<td colspan='{EG_COLUMNS}' style='padding:3px;text-align:right;' class='eg_border'>
					".EG_CORE_13.": {EG_POSITION} ".EG_CORE_14." {EG_MAX}
				</td>
			</tr>
			<tr>
				<td colspan='{EG_COLUMNS}' style='padding:3px;text-align:center;' class='eg_border'>
					<form name='phpSG'>".EG_CORE_15.": {EG_IMG_PER_PAGE} ".EG_CORE_16.": {EG_SORT_ORDER}</form>
				</td>
			</tr>
			{EG_IMAGE_TABLE}
			<tr>
				<td colspan='{EG_COLUMNS}' style='text-align:center;' height='20' class='eg_border'>
					{EG_LINK_PREV} {EG_FIRST_DIVIDE} {EG_PAGES} {EG_LAST_DIVIDE} {EG_LINK_NEXT}<br/>
					(".EG_CORE_17.": {EG_TOTAL_PAGES})
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
<br />
{EG_VERSION_FOOTER}
{EG_UPLOAD}";

// EasyGallery Image overview
$EG_IMAGE = "
<link rel='stylesheet' type='text/css' href='".$style_folder."eg_style.css'>
<div>
	<table border='0' cellpadding='0' cellspacing='0' align='center'>
		<tr>
			<td style='padding:3px;text-align:center;' class='eg_border' colspan='2'>
				{EG_IMG_FILENAME}
			</td>
		</tr>
		<tr>
			<td colspan='2'>
				&nbsp;
			</td>
		</tr>
		<tr>
			<td align='center' style='padding:3px;' class='eg_border' colspan='2'>
				{EG_IMG_IMAGE}
			</td>
		</tr>
		<tr>
			<td colspan='2'>
				&nbsp;
			</td>
		</tr>
		<tr>
			<td class='eg_leftcell_border' style='padding:3px;width:50%;'>
				".EG_CORE_22.": {EG_IMG_DESCRIPTION}
			</td>
			<td class='eg_border' style='padding:3px;text-align:right;width:50%;' >
				".EG_CORE_23.": {EG_IMG_MODIFIED}
			</td>
		</tr>
		<tr>
			<td align='center' style='padding:3px;' class='eg_side_border' colspan='2'>
				<div class='page' style='text-align:center;'>{EG_IMG_LINK_BACK}</div>
			</td>
		</tr>
		<tr>
			<td class='eg_leftcell_border'>
				<div class='page'>{EG_LINK_PREV}</div>
			</td>
			<td class='eg_border' style='text-align:right;'>
				<div class='page'>{EG_LINK_NEXT}</div>
			</td>
		</tr>
	</table>
	<br />
	<div style='text-align:right;'>{EG_VERSION_FOOTER}</div>
</div>
{EG_IMG_ADD_DESCRIPTION}
{EG_IMG_COMMENT}
{EG_UPLOAD}";
?>