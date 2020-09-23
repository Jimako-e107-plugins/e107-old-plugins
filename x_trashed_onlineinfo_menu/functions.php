<?php

function getuserclassinfo($userid){  // Fuction to get User Colour
global $pref;
	
$usercol='';

if($pref['onlineinfo_onoffcolour']==1){	
	
$script="SELECT user_class,user_admin,user_perms FROM ".MPREFIX."user WHERE user_id=".$userid." ORDER BY user_currentvisit DESC";
	$sql = new db;
	$sql->db_Select_gen($script);	
	while ($row = $sql->db_Fetch())
		{
			$usermodr=0;
			unset($userc);	
			$userc= explode(',',$row['user_class']);
			$user_admin=$row['user_admin'];	
			$user_perms=$row['user_perms'];	
		
			for($z = 0; $z<=count($userc); $z++ ) {
		 
				 $script="SELECT forum_moderators FROM ".MPREFIX."forum WHERE forum_parent <> '0' GROUP BY forum_moderators";
				 $sql2 = new db;
			     $sql2->db_Select_gen($script);
					while ($row2 = $sql2->db_Fetch())
					{
						if($userc[$z]==$row2[0]){$usermodr=1;}		
					}
		 
			}
			
		}

if($pref['onlineinfo_adminactive']==1){ 
if($user_admin==1){$usercol='style="text-decoration: none; font-weight:bold; color:'.$pref['onlineinfo_admincolour'].';"';}
}

if($pref['onlineinfo_headadminactive']==1){
if($user_admin==1 && $user_perms=='0'){$usercol='style="text-decoration: none; font-weight:bold; color:'.$pref['onlineinfo_headadmincolour'].';"';}
}

if($pref['onlineinfo_modactive']==1){
if($usermodr==1 && $user_admin<>1){$usercol='style="text-decoration: none; font-weight:bold; color:'.$pref['onlineinfo_modcolour'].';"';}
}

if($pref['onlineinfo_memactive']==1){
if($usermodr==0 && $user_admin<>1){$usercol='style="text-decoration: none; color:'.$pref['onlineinfo_memcolour'].';"';}	
}
	
if($usercol=="" || $usercol=='style="text-decoration: none; color:'.$pref['onlineinfo_memcolour'].';"'){ // user classes	

	

		$script="SELECT cache FROM ".MPREFIX."onlineinfo_cache Where type='classcolour'";
		$sql3 = new db;
		$sql3->db_Select_gen($script);
		while ($row3 = $sql3->db_Fetch())
		{			
			$buildclasslist=$row3['cache'];
		}

$splitclasslist = explode(',',$buildclasslist);	
$countclasscol = count($splitclasslist);
$countuserclasses = count($userc);	
$orderingclasspri=9999999999999999;


for($c = 0; $c <= $countuserclasses; $c++){
	
	for($a = 0; $a <= $countclasscol; $a++){
		
			$getclasssaveddetails = explode("|",$splitclasslist[$a]);
			
			if($getclasssaveddetails[2]==1){
							
						
					if($userc[$c]==$getclasssaveddetails[0]){
						if($getclasssaveddetails[3] <= $orderingclasspri)	{													
							$usercol='style="text-decoration: none; color:'.$getclasssaveddetails[1].';"';	
							$orderingclasspri=$getclasssaveddetails[3];	
						}
					}
					
			}
	}	
}
	
/*	Code for using a table if Prefs are too slow

	$orderingclasspri=9999999999999999;
	$countuserclasses = count($userc);
	
$script="SELECT ".MPREFIX."onlineinfo_userclasses.*, ".MPREFIX."userclass_classes.userclass_description 
FROM ".MPREFIX."onlineinfo_userclasses 
LEFT JOIN ".MPREFIX."userclass_classes ON ".MPREFIX."onlineinfo_userclasses.userclass_id = ".MPREFIX."userclass_classes.userclass_id";
		$sql3 = new db;
		$sql3->db_Select_gen($script);
		while ($row3 = $sql3->db_Fetch())
		{
			for($c = 0; $c <= $countuserclasses; $c++){
				if($userc[$c]==$row3['userclass_id']){
					if($row3['priority'] <= $orderingclasspri)	{													
					$usercol='style="text-decoration: none; color:'.$row3['colour'].';"';	
					$orderingclasspri=$row3['priority'];	
					}
				}
			}
							
		}
*/	
	
	
	
}

}

return $usercol;	
}





function colourkey($layout){
global $pref;
$colourkey="";

if($pref['onlineinfo_onoffcolour']==1){	

$sql = new db;

		$script="SELECT cache FROM ".MPREFIX."onlineinfo_cache Where type='classcolour'";
		$onlineinfo_classcolour = $sql->db_Select_gen($script);
		while ($row = $sql->db_Fetch())
		{
			
			$buildclasslist=$row['cache'];

		}


$splitclasslist = explode(',',$buildclasslist);
		
  $classcol=0;


$script="SELECT * FROM ".MPREFIX."userclass_classes ORDER BY userclass_id";		
		$sql->db_Select_gen($script);	
		while ($row = $sql->db_Fetch())
        {
        	extract($row);
        	
        	$countclasscol = count($splitclasslist);
        	
        	$foundit=-1;
        	
        	for($a = 0; $a <= $countclasscol; $a++){
				
				$getclasssaveddetails = explode("|",$splitclasslist[$a]);
					
				if($userclass_id==$getclasssaveddetails[0]){
					
					$foundit=$a;
				}
			}
        	        	
        	if($foundit<>-1){
			    $getclasssaveddetails = explode("|",$splitclasslist[$foundit]);   
				if($getclasssaveddetails[2]==1){
					
					if($layout==1){
   						$classdata.='<div style="text-align:left; color:'.$getclasssaveddetails[1].';">'.$userclass_description.'</div>'; 
					}else{
						$classdata.='<span style="text-align:left; color:'.$getclasssaveddetails[1].';">'.$userclass_description.'</span>, ';	
					}
				}	  
        	
			}	
        	$classcol++;   	        	
        }        
        	$classcol=$classcol-1;

if($layout==1){
	$colourkey='<div style="text-align:left;" class="mediumtext"><img src="'.e_PLUGIN.'onlineinfo_menu/images/keys.png" height="18px" /><b>'.ONLINENOW_7.'</b>:</div>';
	
	if($pref['onlineinfo_headadminactive']==1){
		$colourkey.='<div style="text-align:left; font-weight:bold; color:'.$pref['onlineinfo_headadmincolour'].';">'.ONLINENOW_1.'</div>';
	}  
	 
	if($pref['onlineinfo_adminactive']==1){  
		$colourkey.='<div style="text-align:left; font-weight:bold; color:'.$pref['onlineinfo_admincolour'].';">'.ONLINENOW_8.'</div>';
	}
	
	if($pref['onlineinfo_modactive']==1){
		$colourkey.='<div style="text-align:left; font-weight:bold; color:'.$pref['onlineinfo_modcolour'].';">'.ONLINENOW_10.'</div>';
	}
	
	$colourkey.=$classdata;
	
	if($pref['onlineinfo_memactive']==1){
		$colourkey.='<div style="text-align:left; color:'.$pref['onlineinfo_memcolour'].';">'.ONLINENOW_9.'</div>';	
	}

}else{
		
	$colourkey='<div style="text-align:left;" class="mediumtext"><img src="'.e_PLUGIN.'onlineinfo_menu/images/keys.png" height="18px" /><b>'.ONLINENOW_7.'</b>:</div>';
	
	if($pref['onlineinfo_headadminactive']==1){
		$colourkey.='<div style="text-align:left;"><span style="text-align:left; font-weight:bold; color:'.$pref['onlineinfo_headadmincolour'].';">'.ONLINENOW_1.'</span>, ';  
	} 
	
	if($pref['onlineinfo_adminactive']==1){  
		$colourkey.='<span style="text-align:left; font-weight:bold; color:'.$pref['onlineinfo_admincolour'].';">'.ONLINENOW_8.'</span>, ';
	}
	
	if($pref['onlineinfo_modactive']==1){
		$colourkey.='<span style="text-align:left; font-weight:bold; color:'.$pref['onlineinfo_modcolour'].';">'.ONLINENOW_10.'</span>, ';
	}
	
	$colourkey.=$classdata;
	
	if($pref['onlineinfo_memactive']==1){
		$colourkey.='<span style="text-align:left; color:'.$pref['onlineinfo_memcolour'].';">'.ONLINENOW_9.'</span></div>';		
	}
	
	if(substr($colourkey,strlen($colourkey)-2,1)==','){
		
	$colourkey=	substr($colourkey,0,strlen($colourkey)-2);
		
	}
	
	}

}	
	
	
return $colourkey;	
	
}











function cleanup($data){ // to clean data from OIM cache	
$data = preg_replace('#\.+#', '.', $data);
$data = preg_replace('#^\.#', '', $data);
$data = preg_replace('#\.$#', '', $data);
$data = str_replace('.', ',', $data);		
return $data;	
}


function Create_yes_no_dropdown($Selname,$SelectedVal){  // yes/no dropdownbox in admin
	$ret_text='<select class="tbox" name="'.$Selname.'">';
	$sqlotd=new db;
	$sel='';
	if($SelectedVal == '1'){
		$sel=" SELECTED";
	}
	$ret_text.='<option value="1"'.$sel.'>' .ONLINEINFO_LOGIN_dropdown_A1. '</option>';
	$sel='';
	if($SelectedVal == '0' || $SelectedVal == ''){
		$sel=' SELECTED';
	}
	$ret_text.='<option value="0"'.$sel.'>' .ONLINEINFO_LOGIN_dropdown_A2. '</option>';
	$ret_text.='</select>';
	return $ret_text;
}


function Create_sound_dropdown($Selname,$SelectedVal){ // Sound setup in admin
	$ret_text='<select class="tbox" name="'.$Selname.'">';
	$sel='';
	if($SelectedVal == 'none'){
		$sel=' SELECTED';
	}
	$ret_text.='<option value="none"'.$sel.'>' .ONLINEINFO_LOGIN_MENU_A61. '</option>';
	
	$sel='';
	
	$soundhandle=opendir(e_PLUGIN.'onlineinfo_menu/sounds/');
    while ($soundfile = readdir($soundhandle)){
        if($soundfile != '.' && $soundfile != '..'){
       
        $soundlist = $soundfile;
      
        $name = ucwords(ereg_replace('_', ' ',$soundlist));
        $name = ucwords(ereg_replace('.wav', ' (wav)',$name));
        $name = ucwords(ereg_replace('.mp3', ' (mp3)',$name));

		if($SelectedVal == $soundlist){
		$sel=' SELECTED';
	}

        $ret_text.='<option value="'.$soundlist.'"'.$sel.'>' .$name. '</option>';
        $sel='';
        }
    }
    closedir($soundhandle);
	
	$ret_text.='</select>';
	return $ret_text;
}


function Create_no_dropdown($Selname,$SelectedVal){  // no dropdownbox in admin
	$ret_text='<select class="tbox" name="'.$Selname.'">';
	$sqlotd=new db;
	$sel='';
	$sel=' SELECTED';
	$ret_text.='<option value="0"'.$sel.'>' .ONLINEINFO_LOGIN_dropdown_A2. '</option>';
	$ret_text.='</select>';
	return $ret_text;
}


function Create_order_dropdown($Selname,$SelectedVal){  // order of cache in admin
	$ret_text='<select class="tbox" name="'.$Selname.'">';

	$sql=new db;
	$checkcacheno = $sql -> db_Count("onlineinfo_cache", "(*)", "WHERE type ='order'");

	for ($a = 1; $a <= $checkcacheno; $a++)
	{

	if($SelectedVal == $a){
		$sel=' SELECTED';
	}
	$ret_text.='<option value="'.$a.'"'.$sel.'>' .$a. '</option>';
	$sel='';

	}

	$ret_text.='</select>';
	return $ret_text;
}


function Create_eorder_dropdown($Selname,$SelectedVal){ // extra order of cache in admin
	$ret_text='<select class="tbox" name="'.$Selname.'">';

	$sql=new db;
	$checkcacheno = $sql -> db_Count("onlineinfo_cache", "(*)", "WHERE type ='extraorder'");
	
	for ($a = 1; $a <= $checkcacheno; $a++)
	{
	 
	if($SelectedVal == $a){
		$sel=' SELECTED';
	}	
	$ret_text.='<option value="'.$a.'"'.$sel.'>' .$a. '</option>';
	$sel="";
	
	}
	
	$ret_text.='</select>';
	return $ret_text;
}

function Create_colour_dropdown($Selname,$SelectedVal){  // select colour in admin
	$ret_text='<select name="'.$Selname.'">';
	$sqlotd=new db;
	unset($sel);
	if($SelectedVal == 'aliceblue'){
		$sel=' SELECTED';
	}
	$ret_text.='<option value="aliceblue" style="background-color:aliceblue;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
	unset($sel);
	
	if($SelectedVal == 'antiquewhite'){
		$sel=' SELECTED';
	}	
$ret_text.='<option value="antiquewhite" style="background-color:antiquewhite;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'aqua'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="aqua" style="background-color:aqua;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'aquamarine'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="aquamarine" style="background-color:aquamarine;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'azure'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="azure" style="background-color:azure;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'beige'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="beige" style="background-color:beige;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'bisque'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="bisque" style="background-color:bisque;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'black'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="black" style="background-color:black;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'blanchedalmond'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="blanchedalmond" style="background-color:blanchedalmond;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'blue'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="blue" style="background-color:blue;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'blueviolet'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="blueviolet" style="background-color:blueviolet;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'brown'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="brown" style="background-color:brown;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'burlywood'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="burlywood" style="background-color:burlywood;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'cadetblue'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="cadetblue" style="background-color:cadetblue;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'chartreuse'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="chartreuse" style="background-color:chartreuse;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'chocolate'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="chocolate" style="background-color:chocolate;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'coral'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="coral" style="background-color:coral;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'cornflowerblue'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="cornflowerblue" style="background-color:cornflowerblue;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'cornsilk'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="cornsilk" style="background-color:cornsilk;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'crimson'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="crimson" style="background-color:crimson;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'cyan'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="cyan" style="background-color:cyan;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'darkblue'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="darkblue" style="background-color:darkblue;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'darkcyan'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="darkcyan" style="background-color:darkcyan;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'darkgoldenrod'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="darkgoldenrod" style="background-color:darkgoldenrod;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'darkgray'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="darkgray" style="background-color:darkgray;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'darkgreen'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="darkgreen" style="background-color:darkgreen;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'darkhaki'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="darkhaki" style="background-color:darkhaki;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'darkmagenta'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="darkmagenta" style="background-color:darkmagenta;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'darkolivegreen'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="darkolivegreen" style="background-color:darkolivegreen;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'darkorange'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="darkorange" style="background-color:darkorange;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'darkorchid'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="darkorchid" style="background-color:darkorchid;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'darkred'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="darkred" style="background-color:darkred;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'darksalmon'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="darksalmon" style="background-color:darksalmon;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'darkseagreen'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="darkseagreen" style="background-color:darkseagreen;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'darkslateblue'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="darkslateblue" style="background-color:darkslateblue;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'darkslategray'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="darkslategray" style="background-color:darkslategray;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'darkturquoise'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="darkturquoise" style="background-color:darkturquoise;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'darkviolet'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="darkviolet" style="background-color:darkviolet;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'deeppink'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="deeppink" style="background-color:deeppink;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'deepskyblue'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="deepskyblue" style="background-color:deepskyblue;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'dimgray'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="dimgray" style="background-color:dimgray;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'dodgerblue'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="dodgerblue" style="background-color:dodgerblue;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'firebrick'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="firebrick" style="background-color:firebrick;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'floralwhite'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="floralwhite" style="background-color:floralwhite;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'forestgreen'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="forestgreen" style="background-color:forestgreen;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'fuchsia'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="fuchsia" style="background-color:fuchsia;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'gainsboro'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="gainsboro" style="background-color:gainsboro;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'ghostwhite'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="ghostwhite" style="background-color:ghostwhite;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'gold'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="gold" style="background-color:gold;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'goldenrod'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="goldenrod" style="background-color:goldenrod;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'gray'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="gray" style="background-color:gray;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'green'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="green" style="background-color:green;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'greenyellow'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="greenyellow" style="background-color:greenyellow;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'honeydew'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="honeydew" style="background-color:honeydew;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'hotpink'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="hotpink" style="background-color:hotpink;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'indianred'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="indianred" style="background-color:indianred;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'indigo'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="indigo" style="background-color:indigo;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'ivory'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="ivory" style="background-color:ivory;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'khaki'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="khaki" style="background-color:khaki;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'lavender'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="lavender" style="background-color:lavender;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'lavenderblush'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="lavenderblush" style="background-color:lavenderblush;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'lawngreen'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="lawngreen" style="background-color:lawngreen;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'lemonchiffon'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="lemonchiffon" style="background-color:lemonchiffon;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'lightblue'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="lightblue" style="background-color:lightblue;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'lightcoral'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="lightcoral" style="background-color:lightcoral;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'lightcyan'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="lightcyan" style="background-color:lightcyan;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'lightgoldenrodyellow'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="lightgoldenrodyellow" style="background-color:lightgoldenrodyellow;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>'
;
unset($sel);
	
	if($SelectedVal == 'lightgreen'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="lightgreen" style="background-color:lightgreen;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'lightgrey'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="lightgrey" style="background-color:lightgrey;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'lightpink'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="lightpink" style="background-color:lightpink;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'lightsalmon'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="lightsalmon" style="background-color:lightsalmon;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'lightseagreen'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="lightseagreen" style="background-color:lightseagreen;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'lightskyblue'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="lightskyblue" style="background-color:lightskyblue;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'lightslategray'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="lightslategray" style="background-color:lightslategray;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'lightsteelblue'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="lightsteelblue" style="background-color:lightsteelblue;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'lightyellow'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="lightyellow" style="background-color:lightyellow;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'lime'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="lime" style="background-color:lime;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'limegreen'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="limegreen" style="background-color:limegreen;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'linen'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="linen" style="background-color:linen;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'magenta'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="magenta" style="background-color:magenta;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'maroon'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="maroon" style="background-color:maroon;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'mediumaquamarine'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="mediumaquamarine" style="background-color:mediumaquamarine;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'mediumblue'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="mediumblue" style="background-color:mediumblue;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'mediumorchid'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="mediumorchid" style="background-color:mediumorchid;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'mediumpurple'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="mediumpurple" style="background-color:mediumpurple;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'mediumseagreen'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="mediumseagreen" style="background-color:mediumseagreen;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'mediumslateblue'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="mediumslateblue" style="background-color:mediumslateblue;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'mediumspringgreen'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="mediumspringgreen" style="background-color:mediumspringgreen;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'mediumturquoise'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="mediumturquoise" style="background-color:mediumturquoise;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'mediumvioletred'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="mediumvioletred" style="background-color:mediumvioletred; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'midnightblue'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="midnightblue" style="background-color:midnightblue;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'mintgreen'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="mintgreen" style="background-color:mintgreen;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'mistyrose'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="mistyrose" style="background-color:mistyrose;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'moccasin'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="moccasin" style="background-color:moccasin;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'navajowhite'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="navajowhite" style="background-color:navajowhite;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'navy'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="navy" style="background-color:navy;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'oldlace'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="oldlace" style="background-color:oldlace;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'olive'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="olive" style="background-color:olive;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'oliverab'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="oliverab" style="background-color:oliverab;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'orange'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="orange" style="background-color:orange;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'orangered'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="orangered" style="background-color:orangered;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'orchid'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="orchid" style="background-color:orchid;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'palegoldenrod'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="palegoldenrod" style="background-color:palegoldenrod;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'palegreen'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="palegreen" style="background-color:palegreen;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'paleturquoise'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="paleturquoise" style="background-color:paleturquoise;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'palevioletred'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="palevioletred" style="background-color:palevioletred;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'papayawhip'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="papayawhip" style="background-color:papayawhip;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'peachpuff'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="peachpuff" style="background-color:peachpuff;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'peru'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="peru" style="background-color:peru;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'pink'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="pink" style="background-color:pink;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'plum'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="plum" style="background-color:plum;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'powerblue'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="powerblue" style="background-color:powerblue;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'purple'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="purple" style="background-color:purple;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'red'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="red" style="background-color:red;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'rosybrown'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="rosybrown" style="background-color:rosybrown;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'royalblue'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="royalblue" style="background-color:royalblue;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'saddlebrown'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="saddlebrown" style="background-color:saddlebrown;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'salmon'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="salmon" style="background-color:salmon;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'sandybrown'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="sandybrown" style="background-color:sandybrown;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'seagreen'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="seagreen" style="background-color:seagreen;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'seashell'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="seashell" style="background-color:seashell;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'sienna'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="sienna" style="background-color:sienna;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'silver'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="silver" style="background-color:silver;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'skyblue'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="skyblue" style="background-color:skyblue;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'slateblue'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="slateblue" style="background-color:slateblue;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'slategray'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="slategray" style="background-color:slategray;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'snow'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="snow" style="background-color:snow;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'springgreen'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="springgreen" style="background-color:springgreen;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'steelblue'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="steelblue" style="background-color:steelblue;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'tan'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="tan" style="background-color:tan;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'teal'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="teal" style="background-color:teal;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'thistle'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="thistle" style="background-color:thistle;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'tomato'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="tomato" style="background-color:tomato;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'turquoise'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="turquoise" style="background-color:turquoise;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'violet'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="violet" style="background-color:violet;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'wheat'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="wheat" style="background-color:wheat;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'white'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="white" style="background-color:white;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'whitesmoke'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="whitesmoke" style="background-color:whitesmoke;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'yellow'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="yellow" style="background-color:yellow;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);
	
	if($SelectedVal == 'yellowgreen'){
		$sel=' SELECTED';
	}
$ret_text.='<option value="yellowgreen" style="background-color:yellowgreen;" '.$sel.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
unset($sel);	
	
	$ret_text.='</select>';
	return $ret_text;
}




function getpage($pagedata){
	
$pdata = eregi_replace('flashchat',ONLINEINFO_LOGIN_MENU_L62, $pagedata);
$pdata = eregi_replace('getxml',ONLINEINFO_LOGIN_MENU_L62, $pdata);									
$pdata = eregi_replace('sig',ONLINEINFO_LOGIN_MENU_L71, $pdata);
$pdata = eregi_replace('bf2142BF2 Sig Gen',ONLINEINFO_LOGIN_MENU_L85, $pdata);
$pdata = eregi_replace('create_sig Gen',ONLINEINFO_LOGIN_MENU_L85, $pdata);
$pdata = eregi_replace('BF2 Sig Gennup',ONLINEINFO_LOGIN_MENU_L3, $pdata);
$pdata = eregi_replace('bf2stats',ONLINEINFO_LOGIN_MENU_L72, $pdata);
$pdata = eregi_replace('rss',ONLINEINFO_LOGIN_MENU_L73, $pdata);
$pdata = eregi_replace('ratepic',ONLINEINFO_LOGIN_MENU_L74, $pdata);
//$pdata = eregi_replace('thumbnails',ONLINEINFO_LOGIN_MENU_L74, $pdata);
$pdata = eregi_replace('displayimage',ONLINEINFO_LOGIN_MENU_L74, $pdata);
$pdata = eregi_replace('ecard',ONLINEINFO_LOGIN_MENU_L74, $pdata);
$pdata = eregi_replace('addfav',ONLINEINFO_LOGIN_MENU_L74, $pdata);					                
$pdata = eregi_replace('comment.comment.news.', ONLINE_EL12. ' - ', $pdata);
$pdata = eregi_replace('comment.comment.poll.', ONLINEINFO_LOGIN_MENU_L63, $pdata);
$pdata = eregi_replace('comment.comment', 'Comment ', $pdata);	
$pdata = eregi_replace('chatbox2_control', ONLINEINFO_LOGIN_MENU_L123, $pdata);	
$pdata = eregi_replace(SITEURL.'Coppermine', ONLINEINFO_LOGIN_MENU_L74, $pdata);	
	
return $pdata;	
	
}
?>