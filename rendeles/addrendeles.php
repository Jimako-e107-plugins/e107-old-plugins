<?php

require_once("../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); }
require_once(e_HANDLER."calendar/calendar_class.php");
$cal = new DHTML_Calendar(true);
function headerjs()
{
        global $cal;
        return $cal->load_files();
}

if (is_readable(THEME . "rendeles_template.php")){
    require_once(THEME . "rendeles_template.php");}
else{
    require_once(e_PLUGIN . "rendeles/rendeles_template.php");}

require_once(e_HANDLER."userclass_class.php");
include_lan(e_PLUGIN."rendeles/languages/".e_LANGUAGE.".php");

if (!defined("USER_WIDTH")){ define("USER_WIDTH","width:95%"); }
	require_once(HEADERF);

if (isset($_POST['kuldes'])) {
	$sql -> db_Insert("rendeles", "'0', 
		'".strtotime($_POST['rendeles_date_a'])."', 
		'".strtotime($_POST['rendeles_date_b'])."', 
		'".intval($_POST['rendeles_customerid'])."', 
		'".intval($_POST['rendeles_typeid'])."', 
		'".intval($_POST['rendeles_bannerid'])."',  
		'".intval($_POST['rendeles_paid'])."', 
		'".intval($_POST['rendeles_completed'])."', 
		'".intval($_POST['rendeles_bannerscompleted'])."', 
		'".$tp->toDB($_POST['rendeles_comment'])."', 
		'".$tp->toDB($_POST['rendeles_location'])."' ");
	$rid = mysql_insert_id(); 

foreach ($_POST['rendeles_rendflowers_flowerid'] as $key => $value){
	$id = intval($value);
	$db = intval($_POST['rendeles_rendflowers_darab'][$key]);
	$color = intval($_POST['rendeles_rendflowers_colorid'][$key]);
	if (($id>0) && ($db>0)){
	  $sql -> db_Insert("rendeles_rendflowers", "'0', 
	  '$rid', 
	  '$id', 
	  '$color', 
	  '$db'
    ");}}
	
	$eredmeny = calcPrice($rid);
  
	$text = "
           <meta http-equiv='content-type' content='text/html; charset=UTF-8' />   
           <link rel='stylesheet' href='".THEME_ABS."style.css' type='text/css' />
           <link rel='stylesheet' href='".$eplug_folder."style.css' type='text/css' />
           ".$tp->parseTemplate($RENDELES_HEADER, false)."
           <table class='fborder' style='width:100%'>
	           <tr>
               <td style='width:25%; vertical-align:top;' class='forumheader3'>
	               <span class='smalltext'>".RENDELES_ADLAN_18."</span><br /><br />
	             </td>
             </tr>
           </table>
           <div class='forumheader'>".RENDELES_53." ".$eredmeny." ".$pref['rendeles_currency']."</div>
           ";
      
} else {

    $text = "<form action='".e_SELF."' method='post'>
     <link rel='stylesheet' href='".THEME_ABS."style.css' type='text/css' />
     <link rel='stylesheet' href='".$eplug_folder."style.css' type='text/css' />
    ";
    $text .="
	    <table class='fborder' style='width:100%'>			    
        <tr>				    
          <td style='width:25%; vertical-align:top;' class='forumheader3'>
            <span class='smalltext'>".RENDELES_5."</span></td>				    
          <td class='forumheader3' colspan='2'>";

		if(preg_match("#(.*?)/(.*?)/(.*?) (.*?):(.*?):(.*?)$#", $_POST['rendeles_date_a'], $matches))
		{
			$_POST['rendeles_date_a'] = mktime($matches[4], $matches[5], $matches[6], $matches[2], $matches[1], $matches[3]);
		}
		else
		{
			$_POST['rendeles_date_a'] = time();
		}
    
    $_rendeles_date_a = $_POST['rendeles_date_a'] ? strftime('%Y/%m/%d %H:%M', $_POST['rendeles_date_a']) : "";
    unset($cal_options);
		unset($cal_attrib);
    $cal_options['firstDay'] = 1;
    $cal_options['showsTime'] = true;
    $cal_options['showOthers'] = true;
    $cal_options['weekNumbers'] = false;
    $cal_options['ifFormat'] = '%Y/%m/%d %H:%M';
    $cal_options['timeFormat'] = '24';
    $cal_attrib['class'] = 'tbox';
    $cal_attrib['size'] = '19';
    $cal_attrib['name'] = 'rendeles_date_a';
    $cal_attrib['value'] = $_rendeles_date_a;
    
    $text .= $cal->make_input_field($cal_options, $cal_attrib)."".RENDELES_57."
            			    
          </td>			    
        </tr>			    
        <tr>				    
          <td style='width:25%; vertical-align:top;' class='forumheader3'>
            <span class='smalltext'>".RENDELES_6."</span>
          </td>				    
          <td class='forumheader3' colspan='2'>";
          
    $_rendeles_date_b = $_POST['rendeles_date_b'] ? strftime('%Y/%m/%d %H:%M', $_POST['rendeles_date_b']) : "";
    unset($cal_options);
		unset($cal_attrib);
    $cal_options['firstDay'] = 1;
    $cal_options['showsTime'] = true;
    $cal_options['showOthers'] = true;
    $cal_options['weekNumbers'] = false;
    $cal_options['ifFormat'] = '%Y/%m/%d %H:%M';
    $cal_options['timeFormat'] = '24';
    $cal_attrib['class'] = 'tbox';
    $cal_attrib['size'] = '19';
    $cal_attrib['name'] = 'rendeles_date_b';
    $cal_attrib['value'] = $_rendeles_date_b;
    
    $text .= $cal->make_input_field($cal_options, $cal_attrib)."".RENDELES_58."
         
          </td>			    
        </tr>
        <tr>		
          <td style='width:25%; vertical-align:top;' class='forumheader3'>
            <span class='smalltext'>".RENDELES_2."</span>
          </td>	
          <td style='width:40%; vertical-align:top;' class='forumheader3'>";			
        
        
    $rendeles_customerid = $_POST['rendeles_customer_id'];
    $qry = "select * from ".MPREFIX."rendeles_customer order by rendeles_customer_name asc";
    $sql->db_query($qry);
    
    $text .= "<select name='rendeles_customerid' class='tbox'>";
    $text .= "<option ".($rendeles_customerid == 0 ? "selected='selected'" : "")." value='0'>--- ".RENDELES_7." ---</option>";
    
    while($row = $sql-> db_Fetch()){
    
	  $text .= "<option ".($rendeles_customerid == $row['rendeles_customer_id'] ? "selected='selected'" : "")." value='$row[rendeles_customer_id]'>$row[rendeles_customer_name]</option>";};
    $text .= "</select>

          </td>			  
          <td style='width:35%; text-align: center;' class='forumheader3'>
            <a href='".$eplug_folder."addcustomer.php' class='button'>".RENDELES_17."</a>
          </td>		
        </tr>	       
        <tr>				    
          <td style='width:25%; vertical-align:top;' class='forumheader3'>
            <span class='smalltext'>".RENDELES_9."</span>
          </td>				    
          <td class='forumheader3' colspan='2'>";    

    $rendeles_typeid = $_POST['rendeles_type_id'];
    $qry = "select * from ".MPREFIX."rendeles_type order by rendeles_type_name asc";
    $sql->db_query($qry);
    
    $text .= "<select name='rendeles_typeid' class='tbox'>";
    $text .= "<option ".($rendeles_typeid == 0 ? "selected='selected'" : "")." value='0'>--- ".RENDELES_8." ---</option>";
    
    while($row = $sql-> db_Fetch()){
    
	  $text .= "<option ".($rendeles_typeid == $row['rendeles_type_id'] ? "selected='selected'" : "")." value='$row[rendeles_type_id]'>$row[rendeles_type_name]</option>";}
    $text .= "</select>
        
          </td>			    
        </tr>       
        
        <tr>				     				    
          <td style='width:25%; vertical-align:top;' class='forumheader3'>
            <span class='smalltext'>".RENDELES_43."</span>
          </td>				    
          <td style='width:40%; vertical-align:top;' class='forumheader3'>";    
          
    $rendeles_rendflowers_flowerid = $_POST['rendeles_flower_id'];
    $qry = "select * from ".MPREFIX."rendeles_flower order by rendeles_flower_name asc";
    $qry = "select * from ".MPREFIX."rendeles_flower order by rendeles_flower_size asc";
    $sql->db_query($qry);

    $text .= "<div id='vsection'>
                <span id='vopt'><div style='width: 90%; float: left;'>
                
                  <select name='rendeles_rendflowers_flowerid[]' class='tbox' style='width: 40%;'>
                    <option ".($rendeles_rendflowers_flowerid == 0 ? "selected='selected'" : "")." value='0'>--- ".RENDELES_44." ---</option>";
    
    while($row = $sql-> db_Fetch()){
    
	  $text .= "      <option ".($rendeles_rendflowers_flowerid == $row['rendeles_flower_id'] ? "selected='selected'" : "")." value='$row[rendeles_flower_id]'>$row[rendeles_flower_name] $row[rendeles_flower_size] </option>";}
    $text .= "    </select>";
    
    $text .= "    <input type='text' name='rendeles_rendflowers_darab[]' class='tbox' style='width: 10%' value='' />".RENDELES_46."";

    $rendeles_rendflowers_colorid = $_POST['rendeles_color_id'];
    $qry = "select * from ".MPREFIX."rendeles_color order by rendeles_color_name asc";
    $sql->db_query($qry);
    
    $text .= "    <select name='rendeles_rendflowers_colorid[]' class='tbox' style='width: 40%;'>
                    <option ".($rendeles_rendflowers_colorid == 0 ? "selected='selected'" : "")." value='0'>--- ".RENDELES_66." ---</option>";
    
    while($row = $sql-> db_Fetch()){
    
	  $text .= "      <option ".($rendeles_rendflowers_colorid == $row['rendeles_color_id'] ? "selected='selected'" : "")." value='$row[rendeles_color_id]'>$row[rendeles_color_name] </option>";}
    $text .= "    </select>
                </div></span>
              </div>   
    
          </td>			  
          <td style='width:35%; text-align: center; vertical-align: bottom;' class='forumheader3'>
            <input class='button' type='button' name='addoption' value='".RENDELES_45."' onclick=\"duplicateHTML('vopt','vsection')\" />
          </td>	      			    			    		    
        </tr>	    
                 
        <tr>				     				    
          <td style='width:25%; vertical-align:top;' class='forumheader3'>
            <span class='smalltext'>".RENDELES_11."</span>
          </td>				    
          <td class='forumheader3' colspan='2'>";    

    $rendeles_bannerid = $_POST['rendeles_banner_id'];
    $qry = "select * from ".MPREFIX."rendeles_banner order by rendeles_banner_banners asc";
    $sql->db_query($qry);
    
    $text .= "<select name='rendeles_bannerid' class='tbox'>";
    $text .= "<option ".($rendeles_bannerid == 0 ? "selected='selected'" : "")." value='0'>--- ".RENDELES_10." ---</option>";
    
    while($row = $sql-> db_Fetch()){
    
	  $text .= "<option ".($rendeles_bannerid == $row['rendeles_banner_id'] ? "selected='selected'" : "")." value='$row[rendeles_banner_id]'>$row[rendeles_banner_banners]</option>";};
    $text .= "</select>
        
          </td>			    
        </tr>
        <tr>				    
          <td style='width:25%; vertical-align:top;' class='forumheader3'>
            <span class='smalltext'>".RENDELES_15."</span>
          </td>				    
          <td class='forumheader3' colspan='2'>    
            <input type='text' name='rendeles_comment' class='tbox' style='width:100%' value='".RENDELES_40."' />            
          </td>			    
        </tr>	   	   
        <tr>				    
          <td style='width:25%; vertical-align:top;' class='forumheader3'>
            <span class='smalltext'>".RENDELES_16."</span>
          </td>				    
          <td class='forumheader3' colspan='2'>    
            <input type='text' name='rendeles_location' class='tbox' style='width:100%' value='".RENDELES_39."' />            
          </td>			    
        </tr>	  
        <tr style='vertical-align:top'>				    
          <td colspan='3' style='text-align:center' class='forumheader'>					    
            <input class='button' type='submit' name='post' value='".RENDELES_ADLAN_23."' />					    
            <input type='hidden' name='kuldes' value='kuldes' />				    
          </td>			    
        </tr>		    
        <tr style='vertical-align:top'>				    
          <td colspan='3' style='text-align:center' class='forumheader3'>					    
			      <a href='".$eplug_folder."rendeles.php' class='button'>".RENDELES_52."</a>
          </td>			    
        </tr>		
      </table>	    
    ";
    $text .= "</form>";
   }	

   $ns -> tablerender("".RENDELES_1."", $text);	

function calcPrice($rendelesid)
{
	$sql = new db();
	$qry = "
		select
		(sum(flower_sum.fprice) + other_sum.tp + other_sum.bp) as price
		from
			(select
			r.rendeles_id as rid,
			rf.rendeles_rendflowers_darab as fdb,
			rendeles_flower_price as fe,
			rf.rendeles_rendflowers_darab * f.rendeles_flower_price as fprice
			from
				".MPREFIX."rendeles r
				inner join ".MPREFIX."rendeles_rendflowers rf
					on r.rendeles_id = rf.rendeles_rendflowers_rendelesid
				inner join ".MPREFIX."rendeles_flower f
					on rf.rendeles_rendflowers_flowerid = f.rendeles_flower_id
				where rendeles_id = $rendelesid) as flower_sum,
			(select
			t.rendeles_type_price as tp,
			b.rendeles_banner_price as bp
			from
				".MPREFIX."rendeles r
				inner join ".MPREFIX."rendeles_type t
					on r.rendeles_typeid = t.rendeles_type_id
				inner join ".MPREFIX."rendeles_banner b
					on r.rendeles_bannerid = b.rendeles_banner_id
				where rendeles_id = $rendelesid) as other_sum
		";
	$sql->db_query($qry);
	$row = $sql->db_fetch();
	return $row ? $row['price'] : 0;
}

?>