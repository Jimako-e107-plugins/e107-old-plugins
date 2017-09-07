<?php
if (!function_exists("headerjs")) {
   function headerjs() {
      global $SimpleContent, $tp;
      $adminPage = strpos(e_SELF, "admin_prefs.php") > 0 ? "true" : "false";
      $sc_cats = $SimpleContent->dao->getCategories();
      //debug($sc_cats);
      $labels = array();
      foreach ($sc_cats as $sc_cat) {
         for ($i=1; $i<=9; $i++) {
            if (strlen($sc_cat->getLabel($i)) > 0) {
               $labels[$sc_cat->getId()] .= SCONTENT_LAN_ADMIN_ITEM_FIELD." $i: ".$tp->toJS($sc_cat->getLabel($i))."<br/>";
            }
         }
      }
      $theJS = "
         <script type='text/javascript'>
            var scontentHelper = {
               admin: ".$adminPage.",
               pageid: '".e_QUERY."',
               fieldLabels: {
      ";
      foreach ($labels as $ix => $label) {
         $theJS .= "$ix:'{$label}',";
      }
      $theJS .= "
                  0:''
               }
            };
         </script>
      ";

      return $theJS;
   }
}
?>