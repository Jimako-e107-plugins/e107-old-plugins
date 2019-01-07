<?php

   require_once("../../class2.php");
   require_once(e_PLUGIN.'tagcloud/tagcloud_class.php');
   $tagcloud = new e107tagcloud;

   if (!getperms("P")) {
      header("location:".e_HTTP."index.php");
      exit;
   }

   require_once(e_ADMIN."auth.php");
   $sql2 = new db;
   $cnt  = 0;


//-------------------------------------------------------
//----------------  Handle form posting



if (isset($_POST['updatesettings']) or isset($_POST['update'])) {

	$pref['tags_appid']         = ($_POST['tags_appid']        ? $_POST['tags_appid'] : 'not entered');
        $pref['tags_peritem']       = ($_POST['tags_peritem']      ? $_POST['tags_peritem'] : 5);
        $pref['tags_overwrite']     = ($_POST['tags_overwrite']    ? $_POST['tags_overwrite'] : 0);
        $pref['tags_yahoolookups']  = ($_POST['tags_yahoolookups'] ? $_POST['tags_yahoolookups'] : 100);
        $pref['excludelist']        = ($_POST['excludelist']       ? $_POST['excludelist'] : '');
        $pref['tags_minlen']        = ($_POST['tags_minlen']       ? $_POST['tags_minlen'] : 3);

        
if($sql->db_select("tag_config","*"))
          { $cnt = 0;
            $cnt++;
            while ($config = $sql->db_fetch())
                 {
                  $tagid = $config['Tag_Config_ID'];
                  if($_POST['tags_area'.$tagid]){$flag=1;}else{$flag=0;}
                  $sql2->db_update("tag_config","Tag_Config_Flag =".$flag." WHERE Tag_Config_ID =".$tagid);
                 }
           }

	save_prefs();
	$e107cache->clear("tagcloud");
	$message = 'Settings Saved!';
}

if (isset($_POST['update'])) {

         $sql->db_select("tag_config","Tag_Config_Type","Tag_Config_Flag=1"); //get cfg table, only where flag is on
         $cfgres  = $sql->db_getList();
         $lookups = 0;

	foreach ($cfgres as $cfg){
              //$a =$cfg['Tag_Config_Type']; echo "type:$a";
              require_once(e_PLUGIN."tagcloud/config/".$cfg['Tag_Config_Type'].".php");
              $sql_query = "SELECT  ".$return_fields."
                            FROM #".$table." 
                            WHERE ".$where."
                            ORDER BY ".$order;

              //echo "<p><b>SQL QUERY:</b>$sql_query";
              if ($sql2->db_select_gen($sql_query))
              {
                 while ($row = $sql2->db_fetch())    //loop through content items
                 {   
                       //print_r ($row);
                       $time     = time();
                       $id_field = $row[0];
                       $skip     = 0;

                       if (!$pref['tags_overwrite'])     //skip yahoo lookup if overwrite is off and tags exist
                          {
                            if ($sql->db_select("tag_main","1","Tag_Item_ID =".$id_field." and Tag_Type='".$cfg['Tag_Config_Type']."'"))
                             {$skip = 1;}
                           }
                       //skip if lookup pref exceeded
                       if ($lookups >= $pref['tags_yahoolookups']){$skip = 1;}

                       if ($skip == 0)
                       {
                                  $lookups++;
                                  $string ="";
                                  foreach ($search_fields as $field)
                                     {
                                     $string .= $row[$field]."+";
                                     }
                                  $keywords =  $tagcloud->yahoo_keywords($string);
                                  //print_r($keywords);//echo "<P><b>STRING:</b>$string";

                                  $sql->db_delete("tag_main","Tag_Item_ID =".$id_field." and Tag_Type='".$cfg['Tag_Config_Type']."'");
                                  $limit = 0;
                                  if ($keywords)
                                      {
                                      foreach ($keywords as $word){
                                      if ($limit>=$pref['tags_peritem']){continue;}
                                      if (strlen($word)<=$pref['tags_minlen']){continue;}
                                       
                                      $needle    = ','.$word.',';
                                      $haystack  = ','.$pref['excludelist'].',';
                                      $word      = preg_replace ("#\s#","_",$word);                         //echo  "$needle and $haystack<p>";
                                      $pos       = strpos($haystack,$needle);
                                      if ($pos===false){
                                           $limit++; $cnt++;
                                           $sql->db_insert("tag_main","null,".$id_field.",'".$cfg['Tag_Config_Type']."','".$word."',$limit,$time");}            //`Tag_ID`  `Tag_Item_ID`  `Tag_Type`  `Tag_Tags`
                                           }
                                      }
                       }
                    }
                    $a=$cfg['Tag_Config_Type'];
                    $message .= "<p>$cnt keywords generated from $a";
                    $cnt=0;
              }

         }



} 


   // Display
   if (isset($message)) {
	$ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}



//------------------------------------------
//----form



$tags_number       = $pref['tags_number'];
$tags_peritem      = $pref['tags_peritem'];
$tags_appid        = $pref['tags_appid'];
$tags_yahoolookups = $pref['tags_yahoolookups'];
$excludelist       = $pref['excludelist'];
$minlen            = $pref['tags_minlen'];
if ($pref['tags_overwrite']) {$tags_overwrite='checked';}


$text = "<div style='text-align:center'>
	<form method='post' action='".e_SELF."' id='cfgform'>
	<table style='".ADMIN_WIDTH."' class='fborder'>
        <tr>
        <td colspan ='2' class='fcaption' style='text-align:center'><b>Yahoo tag generation</b></td>
	</tr>

	<tr>
	<td class='forumheader3' style='width:40%'>Max No. Tags per item:</td>
	<td class='forumheader3' style='width:60%'>
	<input  class='tbox' type='text' name='tags_peritem' value = '".$tags_peritem."' SIZE='2' MAXLENGTH='2'/>
	</td>
	</tr>
	
	<tr>
	<td class='forumheader3' style='width:40%'>Max. No of yahoo requests:</td>
	<td class='forumheader3' style='width:60%'>
	<input  class='tbox' type='text' name='tags_yahoolookups' value = '".$tags_yahoolookups."' SIZE='4' MAXLENGTH='4'/>
	</td>
	</tr>

      	<tr>
	<td class='forumheader3' style='width:40%'>Overwrite tags:</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='checkbox' name='tags_overwrite' ".$tags_overwrite." />
	</td>
	</tr>

        <tr>
	<td class='forumheader3' style='width:40%'>Yahoo appid:</td>
	<td class='forumheader3' style='width:60%'>
	<input  class='tbox' type='text' name='tags_appid' value = '".$tags_appid."' SIZE='100' MAXLENGTH='100'/>
	</td>
	</tr>
	
        <tr>
	<td class='forumheader3' style='width:40%'>Excluded words:<p>(comma seperated list)</td>
	<td class='forumheader3' style='width:60%'>
	<textarea class='fborder' name='excludelist' cols='40' rows='6'>".$excludelist."</textarea>
	</td>
	</tr>

        <tr>
	<td class='forumheader3' style='width:40%'>Min tag length</td>
	<td class='forumheader3' style='width:60%'>
	<input  class='tbox' type='text' name='tags_minlen' value = '".$minlen."' SIZE='2' MAXLENGTH='2'/>
	</td>
	</tr>

	<tr>
	<td  class='forumheader' colspan='2' style='text-align:center'><b>Build tags on the following areas:</b>
	</td>
	</tr>

	<tr>
	<td class='forumheader' style='width:40%'><b>Area</b></td>
	<td class='forumheader' style='width:60%'><b>on/off</b></td>
	</td>
	</tr>
        ";

if($sql->db_select("tag_config","*"))
          { $cnt = 0;
            $cnt++;
            while ($config = $sql->db_fetch())
                 {
                 //build up existing form rows
                 if ($config['Tag_Config_Flag'] == 1)  {$check = 'checked';} else {$check='';}
                 $text .= "
                       	<tr>
	                <td class='forumheader3' style='width:40%'>".$config['Tag_Config_Type']."</td>
	                <td class='forumheader3' style='width:60%'>
	                <input class='tbox' type='checkbox' name='tags_area".$config['Tag_Config_ID']."' ".$check." />
	                </td>
	                </tr>
                        ";
            }
           }
$text .= "
        <tr>
	<td class='forumheader3' style='width:40%'></td>
	<td class='forumheader3' style='width:60%'>
	<input class='button' type='submit' name='updatesettings' value='Save' />
	</td>
	</tr>

        <tr>
        <td colspan ='2' class='fcaption' style='text-align:center'><b>Update tags</b></td>
	</tr>

        <tr>
        <td colspan ='2' class='forumheader3' style='text-align:center'>
	<input class='button' type='submit' name='update' value='Update' />
	</td>
	</tr>

	</table>
	</form>
	</div>";


//------------end


   // The usual, tell e107 what to include on the page
   $ns->tablerender("Prefs", $text);

   require_once(e_ADMIN."footer.php");
?>