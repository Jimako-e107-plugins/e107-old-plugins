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
require_once(e_ADMIN."auth.php");
require(e_PLUGIN."uclass_show/images_def.php");
require(e_PLUGIN."uclass_show/uc_show_admin_styles.php");

include_lan(e_PLUGIN."uclass_show/languages/".e_LANGUAGE.".php");

$config_title = "

	<span style='font-weight:bold;font-size:16px;'>".UC_SHOW_ADM_01."</span>

";


$text = "";

//chmod class_images dir
$cl_image_dir = e_PLUGIN."uclass_show/class_images/";
chmod($cl_image_dir, 0755);

//config preferenze
if($_POST['update_ucshow_settings'])
{
   $pref['uclass_show_active'] = intval($_POST['uclass_show_active']);
   $pref['uclass_show_forum'] = intval($_POST['uclass_show_forum']);
   $pref['uclass_show_comment'] = intval($_POST['uclass_show_comment']);
   $pref['uclass_show_profile'] = intval($_POST['uclass_show_profile']);
   $pref['uclass_show_max_images'] = intval($_POST['uclass_show_max_images']);
   	//se valore max images errato
	if($pref['uclass_show_max_images'] < 5){$pref['uclass_show_max_images'] = 5;}
   $pref['uclass_show_hide_guest'] = intval($_POST['uclass_show_hide_guest']);
   $pref['uclass_show_desc'] = intval($_POST['uclass_show_desc']);
   // upgrade 1.01 12 nov 2012
   $pref['uclass_show_use_custom'] = intval($_POST['uclass_show_use_custom']);
   $pref['uclass_show_use_custom_forum'] = trim($_POST['uclass_show_use_custom_forum']);
   $pref['uclass_show_use_custom_comment'] = trim($_POST['uclass_show_use_custom_comment']);
   $pref['uclass_show_use_custom_user'] = trim($_POST['uclass_show_use_custom_user']);

   save_prefs();

   message_handler("MESSAGE", UC_SHOW_05);
}


//===gestione delle immagini e delle classi

//salvataggio immagine da lista
if($_POST['assign_class_image']){
   
   $sql->db_Update("uclass_show", "uc_show_img = '".$_POST['add_class_image_select']."' WHERE uc_show_id = '".$_POST['id_immagine']."'");   

}


//salvataggio immagine caricata e messaggi errore upload
if (FILE_UPLOADS && $_FILES['file_userfile'] && varsettrue($pref['upload_enabled']) && check_class($pref['upload_class']))
{

   require_once(e_HANDLER.'upload_handler.php');
   $uploaded = process_uploaded_files(e_PLUGIN.'uclass_show/class_images/', FALSE, array('file_mask' => 'jpg,gif,png,jpeg,JPG,tif,bmp', 'max_file_count' => 1));
   $class_img = $_FILES['file_userfile']['name'];
   $sql->db_Update("uclass_show", "uc_show_img = '".$class_img[0]."' WHERE uc_show_id = '".$_POST['id_immagine']."'");
		
   //header("location: ".e_SELF."?".e_QUERY);
   if ($uploaded[0]['error'] == 250) {
      $text .= "
               <div id='err-alert' style='".$div_error_style."'>
               
                  <span style='float:left'>".$ico_warning."</span>".UC_SHOW_ADM_02."
                  
               </div>

               <script type='text/javascript'>
      
                  window.onLoad = setTimeout('document.getElementById(\"err-alert\").style.display=\"none\";',5000);
      
               </script>
               ";
      }
   $error_type = explode("/" , $_FILES['file_userfile']['type'][0]);
   if ($uploaded[0]['error'] == 251) {
      $text .= "
            
            <div id='err-alert' style='".$div_error_style."'>
            
               <span style='float:left'>".$ico_warning."</span>".UC_SHOW_ADM_03." [".$error_type[1]."]<br />".UC_SHOW_ADM_04."               
            
            </div>
            
            <script type='text/javascript'>
      
               window.onLoad = setTimeout('document.getElementById(\"err-alert\").style.display=\"none\";',5000);
      
            </script>
            
            ";            
      }
   
}

//prelevo max width avatar impostata da pref
$max_width = $pref['im_width']."px";

//vede classi esistenti nel sistema e le configura
$text .= "<table style='width:100%;' class='fborder'>

            <tr>
            
               <td colspan='6' style='padding:0 0 10px 0'>
               
                  <div style='float:left;padding:8px 16px;background:#1f6281;color:#fff;font-weight:bold;font-size:16px;border-radius: 5px;-moz-border-radius: 5px;-webkit-border-radius: 5px;'>
                  
                     ".UC_SHOW_ADM_05."
                  
                  </div>
                  
               </td>            
               
            </tr>
            
            <tr>
            
               <td style='width:3%;".$td_head_class_img_style."'>
               
                  id
                  
               </td>            
            
               <td style='width:8%;".$td_head_class_img_style."'>
               
                  ".UC_SHOW_ADM_06."
                  
               </td>
               
               <td style='width:8%;".$td_head_class_img_style."'>
               
                  ".UC_SHOW_ADM_07."
                  
               </td>
               
               <td style='width:15%;".$td_head_class_img_style."'>
               
                  ".UC_SHOW_ADM_08."
                  
               </td>
               
               <td style='width:25%;".$td_head_class_img_style."'>
               
                  ".UC_SHOW_ADM_09."".$max_width.")
                  
               </td>
               
               <td style='width:20%;".$td_head_class_img_style."'>
               
                  ".UC_SHOW_ADM_10."
                  
               </td>               
               
            </tr>

         ";


if($sql -> db_Select("userclass_classes",  "*")){
   
   require(e_PLUGIN."uclass_show/uc_show_admin_funk.php");   
   
   while ($row = $sql->db_Fetch()) {
   
      $id_classe = $row['userclass_id'];
      //utilizzo sotto per pulizia classi rimosse
      $classi_esistenti[] .= $row['userclass_id'];
      $nome_classe = $row['userclass_name'];
      $descrizione_classe = $row['userclass_description'];
   
      //popolo la tabella uclass_show  
      if(!$sql2 -> db_Select("uclass_show",  "*", "uc_show_id='".$id_classe."'")){
   
         $sql2->db_Select_gen("INSERT INTO #uclass_show (uc_show_id, uc_show_name) values ('".$id_classe."', '".$nome_classe."')");
         //ricaricare (!), altrimenti inseisce l'immagine $row2['uc_show_img'] nella classe appena creata e non ancora configurata
         header("location:".e_SELF);
      
      }else{
   
         $row2 = $sql2->db_Fetch();
         if ($row2['uc_show_img']){
         
            $immagine_classe = e_PLUGIN."uclass_show/class_images/".$row2['uc_show_img'];
         
            if (file_exists($immagine_classe)){
               $immagine_classe = "<img src='".e_PLUGIN."uclass_show/class_images/".$row2['uc_show_img']."' alt='' />";
               //per verificare se due record hanno stessa immagine (sotto procede al controllo)
               $controllo_doppi[] .= $row2['uc_show_img'];
            }else{
               $immagine_classe = "<span style='color:#950110;'>".UC_SHOW_ADM_11."</span>";
            }
         
         }else{
         
            $immagine_classe = UC_SHOW_ADM_12;
         
         }
      }
   
      $text .= "
               <tr ".$tr_roll_over.">
               
                  <td style='width:3%;".$td_class_img_style."'>
                  
                     ".$id_classe."
                     
                  </td>            
               
                  <td style='width:8%;".$td_class_img_style.";text-align:left;'>
                  
                     ".$nome_classe."
                     
                  </td>
                  
                  <td style='width:8%;".$td_class_img_style.";text-align:left;'>
                  
                     ".$descrizione_classe."
                     
                  </td>
                  
                  <td style='width:15%;".$td_class_img_style."'>
                  
                     ".$immagine_classe."
                     
                  </td>
                  
                  <td style='width:25%;".$td_class_img_style."'>
                    
                     ".upload_class_img($id_classe)."
                     
                  </td>
                  
                  <td style='width:20%;".$td_class_img_style."'>
                  
                     <form method='post' action='".e_SELF."'>
                     
                        <div style='position:relative'>
                        
                           <div id='magnifica".$id_classe."' ".$magnifica_style."></div>
                        
                           <select class='tbox' name='add_class_image_select' size='3'>
                           
                              <option value=''>--- ".UC_SHOW_ADM_37." ---</option>
                              ".view_class_img_files($id_classe)."
                     
                           </select>
                           
                           <input type='hidden' name='id_immagine' value='".$id_classe."' />
                           <input type='hidden' name='e-token' value='".e_TOKEN."' />
                           <input class='button' type='submit' name='assign_class_image' value='".UC_SHOW_ADM_15."' />                        
                        
                        </div>
                        
                     </form>                  
                     
                  </td>              
                  
               </tr>
               
               ";
   
   }
   
   
   
   //controllo delle immagini eventualmente duplicate
   $clean = array_unique($controllo_doppi);
   
   if ($clean != $controllo_doppi) {

      $text .= "
         
         <div id='err-doppie' style='".$div_error_style_double."'>
               
            <span style='float:left'>".$ico_warning."</span>".UC_SHOW_ADM_16."                
               
         </div>
         
         <script type='text/javascript'>
         
            window.onLoad = setTimeout('document.getElementById(\"err-doppie\").style.display=\"none\";',5000);
         
         </script>         
      ";
         
   }
   
   
   //pulizia alcune classi rimosse
   $sql2 -> db_Select("uclass_show",  "*");
   while ($row2 = $sql2->db_Fetch()) {
      $classi_uc_show[] .= $row2['uc_show_id']; 
   }
   
   $pulisci = array_diff($classi_uc_show , $classi_esistenti);
   
   foreach ($pulisci as $key){
      $sql2->db_Delete("uclass_show", "uc_show_id='".$key."'");
   }
   
   
}else{
 
   $text .= "
   
            <div id='err-alert' style='".$div_error_no_class."'>
               
               <span style='float:left'>".$ico_warning."</span>".UC_SHOW_ADM_17."
                  
            </div>   
   
         ";
         
   //pulizia se vengono rimosse tutte le classi
   $sql2->db_Delete("uclass_show", "uc_show_id");
   
}



$text .= "</table>";


//============gestione preferenze plugin

//animazioni config
if ($pref['uclass_show_active'] == 0) {
	$main_option_disabled = "disabled='disabled'";
	//funzione per attivazione options
	$text .= "

	<script type='text/javascript'>
		function toggleCheck(){
			if(document.getElementById('uclass_show_forum').disabled == false){
				document.getElementById('img_on_off').src='".e_PLUGIN."uclass_show/images/ico_config_off.png';
				document.getElementById('tbox_on_off').value = '0';
				document.getElementById('uclass_show_forum').disabled = true;
				document.getElementById('uclass_show_comment').disabled = true;
				document.getElementById('uclass_show_profile').disabled = true;
				document.getElementById('uclass_show_max_images').disabled = true;
                        document.getElementById('uclass_show_hide_guest').disabled = true;
                        document.getElementById('uclass_show_desc').disabled = true;
				document.getElementById('uclass_show_use_custom').disabled = true;
				document.getElementById('uclass_show_use_custom_forum').disabled = true;
                        document.getElementById('uclass_show_use_custom_comment').disabled = true;
                        document.getElementById('uclass_show_use_custom_user').disabled = true; 
				document.getElementById('ombra').style.opacity='0.4';
				document.getElementById('ombra').style.filter='alpha(opacity=40)';			
			}else{
				document.getElementById('img_on_off').src='".e_PLUGIN."uclass_show/images/ico_config_on.png';
				document.getElementById('tbox_on_off').value = '1';
				document.getElementById('uclass_show_forum').disabled = false;
				document.getElementById('uclass_show_comment').disabled = false;
				document.getElementById('uclass_show_profile').disabled = false;
				document.getElementById('uclass_show_max_images').disabled = false;
                        document.getElementById('uclass_show_hide_guest').disabled = false;
                        document.getElementById('uclass_show_desc').disabled = false;
				document.getElementById('uclass_show_use_custom').disabled = false;
				document.getElementById('uclass_show_use_custom_forum').disabled = false;
                        document.getElementById('uclass_show_use_custom_comment').disabled = false;
                        document.getElementById('uclass_show_use_custom_user').disabled = false;                        
				document.getElementById('ombra').style.opacity='0.9';
				document.getElementById('ombra').style.filter='alpha(opacity=90)';			
			}
		}
	</script>

	";	
	$main_auto_select_options = "	
	onclick = 'toggleCheck();'
	";
	
}else{

	$main_option_disabled = "enabled='enabled'";

	$text .= "

	<script type='text/javascript'>
		function toggleCheckOff(){
			if(document.getElementById('uclass_show_forum').disabled == false){
				document.getElementById('img_on_off').src='".e_PLUGIN."uclass_show/images/ico_config_off.png';
				document.getElementById('tbox_on_off').value = '0';
				document.getElementById('uclass_show_forum').disabled = true;
				document.getElementById('uclass_show_comment').disabled = true;
				document.getElementById('uclass_show_profile').disabled = true;
				document.getElementById('uclass_show_max_images').disabled = true;
                        document.getElementById('uclass_show_hide_guest').disabled = true;
                        document.getElementById('uclass_show_desc').disabled = true;
				document.getElementById('uclass_show_use_custom').disabled = true;
				document.getElementById('uclass_show_use_custom_forum').disabled = true;
                        document.getElementById('uclass_show_use_custom_comment').disabled = true;
                        document.getElementById('uclass_show_use_custom_user').disabled = true;                        
				document.getElementById('ombra').style.opacity='0.4';
				document.getElementById('ombra').style.filter='alpha(opacity=40)';			
			}else{
				document.getElementById('img_on_off').src='".e_PLUGIN."uclass_show/images/ico_config_on.png';
				document.getElementById('tbox_on_off').value = '1';
				document.getElementById('uclass_show_forum').disabled = false;
				document.getElementById('uclass_show_comment').disabled = false;
				document.getElementById('uclass_show_profile').disabled = false;
				document.getElementById('uclass_show_max_images').disabled = false;
                        document.getElementById('uclass_show_hide_guest').disabled = false;
                        document.getElementById('uclass_show_desc').disabled = false;
				document.getElementById('uclass_show_use_custom').disabled = false;
				document.getElementById('uclass_show_use_custom_forum').disabled = false;
                        document.getElementById('uclass_show_use_custom_comment').disabled = false;
                        document.getElementById('uclass_show_use_custom_user').disabled = false;                        
				document.getElementById('ombra').style.opacity='0.9';
				document.getElementById('ombra').style.filter='alpha(opacity=90)';			
			}
		}
	</script>

	";
	
	$main_auto_select_options = "	
	onclick = 'toggleCheckOff();'
	";

}

$ico_ucshow_on_off = ($pref['uclass_show_active'] == 0 ? $ico_ucshow_off."".UC_SHOW_ADM_18." ".UC_SHOW_ADM_19."" : $ico_ucshow_on."".UC_SHOW_ADM_18." ".UC_SHOW_ADM_20."");
$ico_config_on = "<a href='#' title='' ".$main_auto_select_options."><img src='".e_PLUGIN."uclass_show/images/ico_config_on.png' style='vertical-align:middle' id='img_on_off' alt='' /></a>";
$ico_config_off = "<a href='#' title='' ".$main_auto_select_options."><img src='".e_PLUGIN."uclass_show/images/ico_config_off.png' style='vertical-align:middle' id='img_on_off' alt='' /></a>";
$ico_config_on_off = ($pref['uclass_show_active'] == 0 ? $ico_config_off : $ico_config_on);

$text .= "<div style='padding:5px 0;width:100%;margin:0 auto;'>

            <form method='post' action='".e_SELF."'>
            
               <table style='width:100%' class='fborder'>
               
                  <tr>
                  
                     <td colspan='5' style='padding:15px 0 10px 0'>
                     
                        <div style='float:left;padding:8px 16px;background:#1f6281;color:#fff;font-weight:bold;font-size:16px;border-radius: 5px;-moz-border-radius: 5px;-webkit-border-radius: 5px;'>
                        
                           ".UC_SHOW_ADM_21."
                        
                        </div>
                        
                     </td>
                     
                  </tr>
                  
 			<tr ".$tr_roll_over.">
				
			   <td style='width:270px;padding:8px;border-bottom:2px solid #ffffff;border-right:1px solid #ffffff;'>
				".$ico_ucshow_on_off."
			   </td>
	
			   <td style='width:90px;text-align:center;padding:8px;border-bottom:2px solid #ffffff;'>
				".$ico_config_on_off."
				<input type='hidden' name='uclass_show_active' value='".$pref['uclass_show_active']."' id='tbox_on_off' ".$main_auto_select_options." />
			   </td>
							
			   <td  style='text-align:left;padding:8px;border-bottom:2px solid #ffffff;'>
				".UC_SHOW_ADM_22."
			   </td>					
				
			</tr>                 
               
               </table>
               
               <div id='ombra'>
               
				<table style='width:100%' class='fborder'>
				
				   <tr ".$tr_roll_over.">
					
					<td style='width:270px;padding:8px;border-bottom:2px solid #ffffff;border-right:1px solid #ffffff;'>
					   $ico_forum_active&nbsp;&nbsp;".UC_SHOW_ADM_23."
					</td>
							
					<td style='width:160px;text-align:center;padding:8px;border-bottom:2px solid #ffffff;'>
					   <input type='checkbox' name='uclass_show_forum' value='1' id='uclass_show_forum' ".$main_option_disabled." 
					   ".($pref['uclass_show_forum'] == 1?"checked='checked'":"")."/>
					</td>
							
					<td  style='text-align:left;padding:8px;border-bottom:2px solid #ffffff;'>
					   ".UC_SHOW_ADM_24."
					</td>			
					
				   </tr>
                           
				   <tr ".$tr_roll_over.">
					
					<td style='width:270px;padding:8px;border-bottom:2px solid #ffffff;border-right:1px solid #ffffff;'>
					   $ico_comment_active&nbsp;&nbsp;".UC_SHOW_ADM_25."
					</td>
							
					<td style='width:160px;text-align:center;padding:8px;border-bottom:2px solid #ffffff;'>
					   <input type='checkbox' name='uclass_show_comment' value='1' id='uclass_show_comment' ".$main_option_disabled." 
					   ".($pref['uclass_show_comment'] == 1?"checked='checked'":"")."/>
					</td>
							
					<td  style='text-align:left;padding:8px;border-bottom:2px solid #ffffff;'>
					   ".UC_SHOW_ADM_26."
					</td>			
					
				   </tr>
                           
				   <tr ".$tr_roll_over.">
					
					<td style='width:270px;padding:8px;border-bottom:2px solid #ffffff;border-right:1px solid #ffffff;'>
					   $ico_profile_active&nbsp;&nbsp;".UC_SHOW_ADM_27."
					</td>
							
					<td style='width:160px;text-align:center;padding:8px;border-bottom:2px solid #ffffff;'>
					   <input type='checkbox' name='uclass_show_profile' value='1' id='uclass_show_profile' ".$main_option_disabled." 
					   ".($pref['uclass_show_profile'] == 1?"checked='checked'":"")."/>
					</td>
							
					<td  style='text-align:left;padding:8px;border-bottom:2px solid #ffffff;'>
					   ".UC_SHOW_ADM_28."
					</td>			
					
				   </tr>
                           
 				   <tr ".$tr_roll_over.">
					
					<td style='width:270px;padding:8px;border-bottom:2px solid #ffffff;border-right:1px solid #ffffff;'>
					   $ico_max_images&nbsp;".UC_SHOW_ADM_29."
					</td>
							
					<td style='width:160px;text-align:center;padding:8px;border-bottom:2px solid #ffffff;'>
					   <input type='text' name='uclass_show_max_images' value='".$pref['uclass_show_max_images'] ."' style='width:35px;' id='uclass_show_max_images' ".$main_option_disabled." />
					</td>
							
					<td  style='text-align:left;padding:8px;border-bottom:2px solid #ffffff;'>
					   ".UC_SHOW_ADM_30."
					</td>			
					
				   </tr>
                           
				   <tr ".$tr_roll_over.">
					
					<td style='width:270px;padding:8px;border-bottom:2px solid #ffffff;border-right:1px solid #ffffff;'>
					   $ico_show_guest&nbsp;&nbsp;".UC_SHOW_ADM_31."
					</td>
							
					<td style='width:160px;text-align:center;padding:8px;border-bottom:2px solid #ffffff;'>
					   <input type='checkbox' name='uclass_show_hide_guest' value='1' id='uclass_show_hide_guest' ".$main_option_disabled." 
					   ".($pref['uclass_show_hide_guest'] == 1?"checked='checked'":"")."/>
					</td>
							
					<td  style='text-align:left;padding:8px;border-bottom:2px solid #ffffff;'>
					   ".UC_SHOW_ADM_32."
					</td>			
					
				   </tr>
                           
				   <tr ".$tr_roll_over.">
					
					<td style='width:270px;padding:8px;border-bottom:2px solid #ffffff;border-right:1px solid #ffffff;'>
					   $ico_show_desc&nbsp;&nbsp;".UC_SHOW_ADM_33."
					</td>
							
					<td style='width:160px;text-align:center;padding:8px;border-bottom:2px solid #ffffff;'>
					   <input type='checkbox' name='uclass_show_desc' value='1' id='uclass_show_desc' ".$main_option_disabled." 
					   ".($pref['uclass_show_desc'] == 1?"checked='checked'":"")."/>
					</td>
							
					<td  style='text-align:left;padding:8px;border-bottom:2px solid #ffffff;'>
					   ".UC_SHOW_ADM_34."
					</td>			
					
				   </tr>
                           
 				   <tr ".$tr_roll_over.">
					
					<td style='width:270px;padding:8px;border-bottom:2px solid #ffffff;border-right:1px solid #ffffff;'>
					   $ico_custom_templates&nbsp;".UC_SHOW_ADM_38."
					</td>
							
					<td style='width:160px;text-align:center;padding:8px;border-bottom:2px solid #ffffff;'>
                              
                                 <input type='checkbox' name='uclass_show_use_custom' value='1' id='uclass_show_use_custom' ".$main_option_disabled." 
					   ".($pref['uclass_show_use_custom'] == 1?"checked='checked'":"")."/>&nbsp;".UC_SHOW_ADM_39."<br /><br />
                                 
                                 ".UC_SHOW_ADM_40."<br />
					   <input type='text' name='uclass_show_use_custom_forum' value='".$pref['uclass_show_use_custom_forum']."' style='width:120px;' id='uclass_show_use_custom_forum' ".$main_option_disabled." /><br />
                                 ".UC_SHOW_ADM_41."<br />
                                 <input type='text' name='uclass_show_use_custom_comment' value='".$pref['uclass_show_use_custom_comment']."' style='width:120px;' id='uclass_show_use_custom_comment' ".$main_option_disabled." /><br />
                                 ".UC_SHOW_ADM_42."<br />
                                 <input type='text' name='uclass_show_use_custom_user' value='".$pref['uclass_show_use_custom_user']."' style='width:120px;' id='uclass_show_use_custom_user' ".$main_option_disabled." />
                                 
					</td>
							
					<td  style='text-align:left;padding:8px;border-bottom:2px solid #ffffff;'>
					   ".UC_SHOW_ADM_43."<br /><br />".UC_SHOW_ADM_44."
					</td>			
					
				   </tr>                           
                        
                        </table>
               
               </div>
               
 		   <table style='width:100%' class='fborder'>
	
			<tr>
					
			   <td style='text-align:center;padding:10px;' colspan='3'>
				<input type='hidden' name='e-token' value='".e_TOKEN."' />
				<input class='button' type='submit' name='update_ucshow_settings' value='".UC_SHOW_ADM_35."' />
			   </td>
						
			</tr>
	
				
		   </table>              
               
            </form>
            
         </div>
         
      ";
      
if ($pref['uclass_show_active'] == 0) {
	
   $text .="
	
   <script type='text/javascript'>
	if (document.getElementById('ombra')){
	   var oe = document.getElementById('ombra');
	   oe.setAttribute('style', 'opacity:0.4;')
	   if (oe.style.setAttribute)
	   oe.style.setAttribute('filter', 'alpha(opacity=40);')
	}
   </script>	

   ";
	
}      


$ns -> tablerender($config_title , $text);

require_once(e_ADMIN."footer.php");



?>

