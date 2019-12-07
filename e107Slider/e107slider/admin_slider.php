<?php
/*
 * e107Slider Plugin v0.1
 *
 * Copyright (C) 2007-2012 Xen Themes (xenthemes.com)
 *
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php) or 
 * GPL Version 2 (http://www.gnu.org/licenses/gpl-2.0.txt) licenses
 *
 * $Source: 
 * $Revision: 1 $
 * $Date: 25/05/2012 $
 * $Author: leonlloyd $
 *
*/
	
require_once( "../../class2.php" );
if ( !defined( 'e107_INIT' ) ) {
    exit;
}

require_once(e_HANDLER.'ren_help.php');

if ( !getperms( "P" ) ) {
    header( "location:" . e_BASE . "index.php" );
    exit;
}

include_lan(e_PLUGIN.'e107slider/languages/".e_LANGUAGE.".php');

require_once( e_ADMIN . "auth.php" );


if (e_QUERY) {
	list($action, $nr, $type) = explode(".", e_QUERY);
}
else
{
	$action = FALSE;
	$nr = FALSE;
}
	
if(isset($_POST['create_ES']))
{
		
			$es_caption = $_POST['es_caption'];
			$es_image = $_POST['es_image'];
			$es_link  = $_POST['es_link'];
			
			$sql->db_Insert("e107slider", "0, '".$es_caption."', '".$es_image."', '".$es_link."'");

}
	
if(isset($_POST['update_ES']))
{	
		
			$es_caption = $_POST['es_caption'];
			$es_image = $_POST['es_image'];
			$es_link  = $_POST['es_link'];
			$es_id	= $_POST['es_id'];
			
			$sql->db_Update("e107slider", "caption='".$tp->toDB($es_caption)."', image='".$tp->toDB($es_image)."', link='".$tp->toDB($es_link)."' WHERE id='".intval($es_id)."'");
			header("location: admin_slider_settings.php");
}
	
	if($action == "edit") {
	
	$sql->db_Select("e107slider", "*","id ='".$nr."'");
	while($row = $sql -> db_Fetch()) {
	$es_caption = $row['caption'];
	$es_image = $row['image'];
	$es_link = $row['link'];
	$es_id = $nr;
	
	
	}
	
	$es_head = ES_PLUGIN_SL_1;
	}
	
	
	if($action == "delete") {
	$sql->db_Delete("e107slider", "id='".$nr."'");
	header("location: admin_slider_settings.php");	
	}
	
	
	
	$i = 0;
	$sql->db_Select("e107slider","*", "ORDER BY id DESC", false);
	while($row = $sql -> db_Fetch()) {
	$id[$i] 		= $row['id'];
	$caption[$i]	= $row['caption'];
	$image[$i]		= $row['image'];
	$link[$i]		= $row['link'];
	$i++;
	}   

	if ($es_head != '') {
		$es_head = ES_PLUGIN_SL_1;	
	}else{
		$es_head =  ES_PLUGIN_SL_2;
	}

//-----------------------------------------------------------------------------------------------------------+

  $file_handle = opendir(e_PLUGIN."e107slider/slides");

  while ($file_name = readdir($file_handle))
  {
    if ($file_name == "." || $file_name == "..") { continue; }

    $iconlist[] = $file_name;
  }

  closedir($file_handle);

  while (list($key, $icon)=each($iconlist))
  					{
    					$icontext .= " <a href='javascript:addtext(\"$icon\")'><img src='".e_PLUGIN."e107slider/slides/$icon' style='border:0px;max-width:200px;max-height:80px;' alt='' /></a>";
 					}

//-----------------------------------------------------------------------------------------------------------+
	
$es_text = "
<form id='dataform' method='post' action='".e_SELF."'>
	<div class='vs-info'>
		" . $es_message . "
	</div>
	<table class='vs-table' style='" . ADMIN_WIDTH . "'>
   		<thead>
   			<tr>
				<th colspan='2'><h3>" . $es_head . "</h3></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td style='width:30%'>".ES_PLUGIN_SL_5."</td>
				<td style='width:70%;'>
					<input class='tbox' type='text' name='es_image' style='width: 40%' value='".$es_image."' maxlength='200' />
					<br /><br />
					<div>".$icontext."
					</div>
				</td>
			</tr>
			<tr>
				<td style='width:30%'>".ES_PLUGIN_SL_4."</td>
				<td style='width:70%;'>
					<textarea  class='tbox' name='es_caption' style='width: 100%'  rows='4' onselect=\"storeCaret(this);\" onclick=\"storeCaret(this);\" onkeyup=\"storeCaret(this);\">".$es_caption."</textarea><br />
";

$es_text .= display_help('helpb')."
				</td>
			</tr>
			<tr>
				<td style='width:30%'>".ES_PLUGIN_SL_6."</td>
				<td style='width:70%;'>
					<input class='tbox' type='text' name='es_link' style='width: 70%' value='".$es_link."' maxlength='200' />
				</td>
			</tr>
			<tr>
				<td colspan='2' class='table-end'>
						".($action == "edit" ? "<input type='hidden' name='es_id' value='".$es_id."' />" : "")."
						<input class='button' type='submit' name='".($action == "edit" ? "update_ES" : "create_ES")."'  value='".($action == "edit" ? ES_PLUGIN_SL_7 : ES_PLUGIN_SL_8)."' />
				</td>
			</tr>
		</tbody>
	</table>
</form>
<p><center>e107Slider v".$pref['plug_installed']['e107slider']." by <a href='http://www.xenthemes.com' target='_blank'>Xen Themes</a></center></p>
";

$ns->tablerender( es_PLUGIN_1, $es_text);
require_once(e_ADMIN."footer.php");