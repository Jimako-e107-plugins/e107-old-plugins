<?php

   require_once("../../class2.php");
   require_once(HEADERF);
   $tp = e107::getParser();
 
   include_lan(e_PLUGIN.'tagcloud/languages/'.e_LANGUAGE.'/lan_tagcloud.php');


//allows the edit of a set of tags from the front end
if (ADMIN)
{

   $tmp    = explode(".", e_QUERY);
   $area   = $tmp[0];
   $id     = intval($tmp[1]);


 if (isset($_POST['update'])) {$text .= "Updated!"; 
       $tmp    = explode(",", $_POST['tags']);
       $sql->db_delete("tag_main","Tag_Type = '".$area."' AND Tag_Item_ID =".$id);
       $cnt = 0;
       foreach ($tmp as $updatetag)
               {
                $cnt++;
                $updatetag = trim($updatetag);
                $updatetag = preg_replace ("#\s#","_",$updatetag);
                if ($updatetag <>''){
                   $insertsting = "null,".$id.",'".$area."','".$updatetag."',".$cnt.",null";
                   $sql->db_insert("tag_main",$insertsting);
                }
                //echo "$updatetag<p>";   
               }

 }


   
   if($sql->select("tag_main","*","Tag_Type = '".$area."' AND Tag_Item_ID =".$id." ORDER BY Tag_Rank"))
          {
            while ($tags = $sql->fetch())
                 {
                 $tagtemp  = preg_replace("#_#"," ",$tags['Tag_Name']);
                 $tagtext .=  $tagtemp.", ";
                 }
           }
           
   $text .= "
        <div style='text-align:center'>
	<form method='post' action='".e_SELF."?".e_QUERY."' id='tageditform'>
	<table style='' class='fborder'>
        <tr>
        <td class='fcaption' style='text-align:center'><b>".LAN_TG3."</b></td>
	</tr>
        <tr>
	<td class='forumheader3' style='width:40%'>
	<textarea class='fborder' name='tags' cols='30' rows='6'>".$tagtext."</textarea>
	</td>
	</tr>

        <tr>
        <td colspan ='2' class='forumheader3' style='text-align:center'>
	<input class='button' type='submit' name='update' value='Update' />
	</td>
	</tr>

	</table>
	</form>
	</div>
        ";

}
else
{$text=LAN_TG2;} //"error!"


//-----------
   $ns->tablerender($pagehead, $text);
   require_once(FOOTERF);



?>

