#<?php
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
|   uclass_show plugin  ver. 1.02 - 20 nov 2012 *rev 20 nov 2012
|   by Alf - http://www.e107works.org
|   Released under the terms and conditions of the
|   Creative Commons "Attribution-Noncommercial-Share Alike 3.0"
|   http://creativecommons.org/licenses/by-nc-sa/3.0/
+---------------------------------------------------------------+
*/


global $class2, $pref, $user, $sql2;

//rev 1.02 20 nov 12 id da querystring rev 20 nov 2012
$tmp_id = explode("." , e_QUERY);
$profile_user_id = intval($tmp_id[1]);

if($sql2 -> db_Select("user",  "*",  "user_id='".$profile_user_id."'")){$row2 = $sql2->db_Fetch();}

$classi = explode(',', $row2['user_class']);
foreach($classi as $key){
   
   $class_user[] .= $key;  
   
}


if($sql2 -> db_Select("uclass_show",  "*")){
   
   while ($row2 = $sql2->db_Fetch()) {
      
      $id_uc_class = $row2['uc_show_id'];
      $name_uc_class = $row2['uc_show_name'];
      $img_uc_class = $row2['uc_show_img'];
      ($pref['uclass_show_desc'] == 1) ? $desc = $name_uc_class : "";
      //rev 1.02 20 nov 12 controllo se immagine esiste
      if ((in_array($id_uc_class, $class_user)) && ($img_uc_class != ""))  {
        
         $userucshow .= "
         
            <div style='float:left;margin:5px 5px 5px 0;'>
            
               <img src='".e_PLUGIN."uclass_show/class_images/".$img_uc_class."' alt='e107works' title='".$desc."' />
               
            </div>
         
         ";
         
      }
      
   }
   

} 


return $userucshow;
 
