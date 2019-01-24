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

//upload class images
function upload_class_img($id_classe) {

   global $id_classe;

	$upload_class_image .= "
		
	   <div>		
			
	";

	$upload_class_image .= "
      
	   <form method='post' action='".e_SELF."' enctype='multipart/form-data'>		
			
		<div>
				
		   <input class='tbox' type='file' name='file_userfile[]' />
		   <input type='hidden' name='id_immagine' value='".$id_classe."' />
		   <input type='hidden' name='e-token' value='".e_TOKEN."' />
		   <input class='button' type='submit' name='upload_class_image' value='".UC_SHOW_ADM_13."' />

		</div>

	   </form>

      ";

	$upload_class_image.= "</div>";


	return $upload_class_image;

}


//vedi class images esistenti
function view_class_img_files($id_classe) {

   $cl_image_dir = e_PLUGIN."uclass_show/class_images/";
   $filtro_1 = "html";
   $filtro_2 = "htaccess";
   
   global $id_classe;

   if (is_dir($cl_image_dir)) {
   
      if ($directory_handle = opendir($cl_image_dir)) {
         
         while (($file = readdir($directory_handle)) !== false) {
            
 		$elimina_html = strpos(strtolower($file), $filtro_1); //filtro html
		$elimina_htaccess = strpos(strtolower($file), $filtro_2); //filtro htaccess
            
            if (($elimina_html == false) && ($elimina_htaccess == false) && ($file[0] != ".")){//filtro osx DS_Store)
            
               $img_esistenti .= "<option value='".$file."'
               onmouseover=\"document.getElementById('magnifica".$id_classe."').innerHTML='<img src=\'".e_PLUGIN."uclass_show/class_images/".$file."\' style=\'max-width:50px;\'/>';
               document.getElementById('magnifica".$id_classe."').style.display='block';\"
               onmouseout=\"document.getElementById('magnifica".$id_classe."').innerHTML='';
               document.getElementById('magnifica".$id_classe."').style.display='none';\"
               >".$file."</option>";
            
            }            
            
         }  
         
      }
      
      closedir($directory_handle);
      
   }
   
   ($img_esistenti == "") ? $img_esistenti = "<option value='' disabled='disabled'>".UC_SHOW_ADM_14."</option>" : "";
   
   return $img_esistenti;

}


?>

