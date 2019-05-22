<?
require_once(e_BASE."class2.php");
@include_once(e_PLUGIN."categorylink_menu/language/".e_LANGUAGE.".php");
@include_once(e_PLUGIN."categorylink_menu/language/English.php");
unset ($text);
//Check Class
if(check_class($pref['menucategory_class'])){
//If Expandit Is No
if($pref['categorylink_expandit']== "".categorylink_Option_2.""){
//Caption Shown
if($pref['categorylink_display']== "".categorylink_Option_3.""){
$sql2 = new db;
$text .= "<div style='text-align:center;'><table class='".$pref['ctable_class']."' width='95%' >";
$sql -> db_Select("linkcategory", "linkcategory_id, linkcategory_name, linkcategory_pic, linkcategory_class, linkcategory_css", "ORDER BY linkcategory_id ASC", "'no_where'");
while($row = $sql-> db_Fetch()){
extract($row);
if(!$linkcategory_class || check_class($linkcategory_class) || ($linkcategory_class==254 && USER)){
if($pref['categorylink_images']== "".categorylink_Option_1.""){
if($linkcategory_pic== ""){
$text .= "<tr><td  class='".$row[4]."'>".$row[1]."</td></tr>";
}else{
$text .= "<tr><td  class='".$row[4]."'>
<img src='".e_PLUGIN."categorylink_menu/catimages/".$linkcategory_pic."' alt='' />".$row[1]."</td></tr>";
}
}else{
$text .= "<tr><td  class='".$row[4]."'>".$row[1]."</td></tr>";
}
}
//Link Section
$sql2 -> db_Select("categorylink", "categorylink_name, categorylink_link, categorylink_cat, categorylink_pic, categorylink_class, categorylink_open, categorylink_css", "categorylink_cat='".$row[0]."' ORDER BY categorylink_name ASC");
while($row2 = $sql2-> db_Fetch()){
extract($row2);
if(!$categorylink_class || check_class($categorylink_class) || ($categorylink_class==254 && USER)){
if($pref['categorylink_images']== "".categorylink_Option_1.""){
if($categorylink_pic== ""){
$text .= "<tr><td class='".$row2[6]."'>".setlink2($row2[0],$row2[1],$row2[5])."</td></tr>";
}else{
$text .= "<tr><td class='".$row2[6]."'>
<img src='".e_PLUGIN."categorylink_menu/catimages/".$categorylink_pic."' alt='' />".setlink2($row2[0],$row2[1],$row2[5])."</td></tr>";
}
}else{
$text .= "<tr><td class='".$row2[6]."'>".setlink2($row2[0],$row2[1],$row2[5])."</td></tr>";
}
}
}
}
$text .= "</table></div>";
$ns -> tablerender($pref['categorylink_title'], $text, 'categorylink_id');
}else{
unset ($text);
$sql2 = new db;
$sql -> db_Select("linkcategory", "linkcategory_id, linkcategory_name, linkcategory_pic, linkcategory_class", "ORDER BY linkcategory_id ASC", "'no_where'");
while($row = $sql-> db_Fetch()){
extract($row);
if(!$linkcategory_class || check_class($linkcategory_class) || ($linkcategory_class==254 && USER)){
if($pref['categorylink_images']== "".categorylink_Option_1.""){
if($linkcategory_pic== ""){
$caption = "".$row[1]."";
}else{
$caption = "<img src='".e_PLUGIN."categorylink_menu/catimages/".$linkcategory_pic."' alt='' />".$row[1]."";
}
}else{
$caption = "".$row[1]."";
}
}
$text = "<div style='text-align:center;'><table class='".$pref['ctable_class']."' width='95%' >";
//Link Section
$sql2 -> db_Select("categorylink", "categorylink_name, categorylink_link, categorylink_cat, categorylink_pic, categorylink_class, categorylink_open, categorylink_css", "categorylink_cat='".$row[0]."' ORDER BY categorylink_name ASC");
while($row2 = $sql2-> db_Fetch()){
extract($row2);
if(!$categorylink_class || check_class($categorylink_class) || ($categorylink_class==254 && USER)){
if($pref['categorylink_images']== "".categorylink_Option_1.""){
if($categorylink_pic== ""){
$text .= "<tr><td class='".$row2[6]."'>".setlink2($row2[0],$row2[1],$row2[5])."</td></tr>";
}else{
$text .= "<tr><td class='".$row2[6]."'>
<img src='".e_PLUGIN."categorylink_menu/catimages/".$categorylink_pic."' alt='' />".setlink2($row2[0],$row2[1],$row2[5])."</td></tr>";
}
}else{
$text .= "<tr><td class='".$row2[6]."'>".setlink2($row2[0],$row2[1],$row2[5])."</td></tr>";
}
}
}
$text .= "</table></div>";
$ns -> tablerender($caption, $text, 'categorylink_id');
}
}









}else{
//If Expandit Is Yes
$sql2 = new db;
$text .= "<div style='text-align:center;'><table class='".$pref['ctable_class']."' width='95%' ><tr><td  class='".$pref['clink_class']."'>";
$sql -> db_Select("linkcategory", "linkcategory_id, linkcategory_name, linkcategory_pic, linkcategory_class, linkcategory_css", "ORDER BY linkcategory_id ASC", "'no_where'");
while($row = $sql-> db_Fetch()){
extract($row);
if(!$linkcategory_class || check_class($linkcategory_class) || ($linkcategory_class==254 && USER)){
if($pref['categorylink_images']== "".categorylink_Option_1.""){
if($linkcategory_pic== ""){
        $text .= "<a href=\"javascript: void(0);\" onclick=\"expandit(this);\" title=\"".$row[1]."\" style=\"font-weight: bold;\" >".$row[1]."</a>\n
        <div style=\"display: none;\" >";
}else{
$text .= "<img src='".e_PLUGIN."categorylink_menu/catimages/".$linkcategory_pic."' alt='' /><a href=\"javascript: void(0);\" onclick=\"expandit(this);\" title=\"".$row[1]."\" style=\"font-weight: bold;\" >".$row[1]."</a>\n
        <div style=\"display: none;\" >
";
}
}else{
        $text .= "<a href=\"javascript: void(0);\" onclick=\"expandit(this);\" title=\"".$row[1]."\" style=\"font-weight: bold;\" >".$row[1]."</a>\n
        <div style=\"display: none;\" >";
}
$sql2 -> db_Select("categorylink", "categorylink_name, categorylink_link, categorylink_cat, categorylink_pic, categorylink_class, categorylink_open", "categorylink_cat='".$row[0]."' ORDER BY categorylink_name ASC");
while($row2 = $sql2-> db_Fetch()){
extract($row2);
        	if(!$linkcategory_class || check_class($linkcategory_class) || ($linkcategory_class==254 && USER)){
          $text .= ( $categorylink_pic!="" ? "<img src=\"".e_PLUGIN."categorylink_menu/catimages/".$categorylink_pic."\" alt=''  />" : "" )." ".setlink2($row2[0],$row2[1],$row2[4])."<br />";
          }
        }
        $text .= "</div><br />";
      }
    }	
$text .= "</td></tr></table></div>";		
$ns -> tablerender($pref['categorylink_title'], $text, 'categorylink_id');
}
}
//Link Open Code
function setlink2($categorylink_name, $categorylink_link, $categorylink_open){
        switch ($categorylink_open){
                case 1:
                        $link_append = "rel='external'";
                break;
                case 2:
                        $link_append = "";
                break;
                case 3:
                        $link_append = "";
                break;
                default:
                        unset($link_append);
        }
        if(!strstr($categorylink_link, "http:")){ $categorylink_link = e_BASE.$categorylink_link; }
        if($categorylink_open == 4){
                $link =  "<a style='text-decoration:none; font-weight: normal;' href=\"javascript:open_window('".$categorylink_link."')\">".$categorylink_name."</a>\n";
        }else{
                $link =  "<a style='text-decoration:none; font-weight: normal;' href=\"".$categorylink_link."\" ".$link_append.">".$categorylink_name."</a>\n";
        }
        return $link;
}
?>
