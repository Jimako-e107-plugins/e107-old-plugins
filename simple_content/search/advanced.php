<?php
/*
+---------------------------------------------------------------+
| SimpleContent by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:/_repository/e107_plugins/simple_content/search/advanced.php,v $
| $Revision: 1.1 $
| $Date: 2008/05/26 23:14:54 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit;}
global $pref;

require_once(e_PLUGIN."simple_content/handlers/scontent_class.php");
require_once(e_PLUGIN."simple_content/handlers/scontent_utils.php");

$SimpleContentDAO       = $SimpleContent->getDAO();
$SimpleContentGroupList = $SimpleContentDAO->getGroups();
$SimpleContentCatList   = $SimpleContentDAO->getCategories();

$advanced_caption['id'] = 'scontent';
$advanced_caption['title']['all'] = $pref["simple_content_pagetitle"];

$advanced['category']['type'] = 'dual';
$advanced['category']['adv_a'] = SCONTENT_LAN_CATEGORY.':';
$advanced['category']['adv_b'] = "<select name='category' id='scontent_search_category' class='tbox'>";
$advanced['category']['adv_b'] .= "<option value=' '>".SCONTENT_LAN_SEARCH_ALL."</option>";
$temp = "";
foreach ($SimpleContentCatList as $SimpleContentCat) {
   $thisGroup = $SimpleContentGroupList[$SimpleContentCat->getGroupId()];
   $selected = "";
   $style = " style='display:none;'";
   if ($_GET["category"] == $SimpleContentCat->getId()) {
      $selected = "selected='selected'";
      $style = "";
   }
   $advanced['category']['adv_b'] .= "<option value='".$SimpleContentCat->getId()."'{$selected}>".$SimpleContentCat->getName()."</option>";

   if (strlen($SimpleContentCat->getLabel(1)) > 0) {
      $catid = "scontent_item_all_fields_".$SimpleContentCat->getID();
      for ($i=1; $i < 10; $i++) {
         $fieldid = "scontent_item_all_fields_".$SimpleContentCat->getID()."_".$i;
         if ($i == 1) {
         //   $checked = (varset($_GET[$catid])) ? " checked='checked'" : "";
            $temp .= "<div class='scontent_search_category_fields' id='scontent_search_category_".$SimpleContentCat->getID()."'{$style}>";
         //   $temp .= SCONTENT_LAN_SEARCH_FIELDS."<br/>";
         //   $temp .= "<input type='checkbox'{$checked} class='tbox scontent_search_fields_all' value='1' name='{$catid}'>".SCONTENT_LAN_SEARCH_ALL."<br/>";
         }
         if (strlen($SimpleContentCat->getLabel($i)) > 0) {
            $checked = (varset($_GET[$fieldid])) ? " checked='checked'" : "";
            $disabled = (varset($_GET[$catid])) ? " disabled='disabled'" : "";
            $temp .= "<input type='checkbox'{$checked}{$disabled}class='tbox' value='1' name='{$fieldid}'>".$SimpleContentCat->getLabel($i)."<br/>";
         }
      }
   }
   if (strlen($SimpleContentCat->getLabel(1)) > 0) {
      $temp .= "</div>\n";
   }
}
$advanced['category']['adv_b'] .= "</select>{$temp}";
?>