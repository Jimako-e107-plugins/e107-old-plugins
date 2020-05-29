<?php 
if (!defined('e107_INIT')) { exit; }
include_once(e_HANDLER.'shortcode_handler.php');
global $tp;
$eg_shortcodes = $tp->e_sc->parse_scbatch(__FILE__);
/*
// ------------------------------------------------
SC_BEGIN EG_ALBUM_LIST
	$item = getcachedvars('eg_album_list');
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN EG_POSITION
	$item = getcachedvars('eg_position');
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN EG_MAX
	$item = getcachedvars('eg_max');
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN EG_IMG_PER_PAGE
	$item = getcachedvars('eg_img_per_page');
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN EG_SORT_ORDER
	$item = getcachedvars('eg_sort_order');
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN EG_IMAGE_TABLE
	$item = getcachedvars('eg_image_table');
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN EG_COLUMNS
	$item = getcachedvars('eg_columns');
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN EG_LINK_PREV
	$item = getcachedvars('eg_link_prev');
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN EG_FIRST_DIVIDE
	$item = getcachedvars('eg_first_divide');
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN EG_PAGES
	$item = getcachedvars('eg_pages');
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN EG_LAST_DIVIDE
	$item = getcachedvars('eg_last_divide');
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN EG_LINK_NEXT
	$item = getcachedvars('eg_link_next');
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN EG_TOTAL_PAGES
	$item = getcachedvars('eg_total_pages');
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN EG_VERSION_FOOTER
	$item = getcachedvars('eg_version_footer');
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN EG_UPLOAD
	$item = getcachedvars('eg_upload');
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN EG_IMG_FILENAME
	$item = getcachedvars('eg_img_filename');
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN EG_IMG_DESCRIPTION
	$item = getcachedvars('eg_img_description');
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN EG_IMG_IMAGE
	$item_array = getcachedvars('eg_img_image');
	$item = $item_array[0]."<img src='".$item_array[1]."' style='border:0;' />".$item_array[2];
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN EG_IMG_MODIFIED
	$item = getcachedvars('eg_img_modified');
	$item = date('F d Y H:i:s', $item);
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN EG_IMG_LINK_BACK
	$item = getcachedvars('eg_img_link_back');
	$item = "<a href='".$item."'>".EG_CORE_26."</a>";
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN EG_IMG_ADD_DESCRIPTION
	$item = getcachedvars('eg_img_add_description');
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN EG_IMG_COMMENT
	$item = getcachedvars('eg_img_comment');
	return $item;
SC_END
*/
?>