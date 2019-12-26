<?php
//Luca Filosofi > {aSeptik} @gmail.com (c) '09

$eplug_admin = TRUE;

require_once("../../class2.php");

   if (!getperms("P")) {
      header("location:".e_HTTP."index.php");
      exit;
   }

include_once (e_PLUGIN."ratings/languages/".e_LANGUAGE.".php");
include_once (e_PLUGIN.'ratings/ratings_function.php');
require_once(e_ADMIN."auth.php");

 global $pref, $tp;
 

if ( isset( $_GET['getCat'] ) ) {

switch ( $_GET['getCat'] ){
case "comments":
$pref['getCat'] = "comments";
break;
case "news":
$pref['getCat'] = "news";
break;
case "download":
$pref['getCat'] = "download";
break;
case "user":
$pref['getCat'] = "user";
break;
}
save_prefs();

}

$getcat = $pref['getCat'] ? $pref['getCat'] : "news";

switch ( $getcat ) {
case "comments":
$activecolor = 'rt_comments';
$tab1 = 'rt_comments_tab';
$tableactive = 'rt_comments_table';
$theadactive = 'rt_comments_thead';
break;
case "news":
$activecolor = 'rt_news';
$tab2 = 'rt_news_tab';
$tableactive = 'rt_news_table';
$theadactive = 'rt_news_thead';
break;
case "download":
$activecolor = 'rt_download';
$tab3 = 'rt_download_tab';
$tableactive = 'rt_download_table';
$theadactive = 'rt_download_thead';
break;
case "user":
$activecolor = 'rt_user';
$tab4 = 'rt_user_tab';
$tableactive = 'rt_user_table';
$theadactive = 'rt_user_thead';
break;
}



$newsposts = e107::getDb()->count("ratings","(*)","WHERE total_cat = '$getcat' ");
 
if (e_QUERY) 
{
  //$tmp1 = erexgi_replace("getCat=$getcat","", e_QUERY);
  $tmp1 = preg_replace("getCat=$getcat","", e_QUERY);
  $tmp = explode(".", $tmp1);
  $action = $tmp[0] ? $tmp[0] : $getcat;
  $sub_action = varset($tmp[1],'') ? varset($tmp[1],'') : "id";
  $id = intval(varset($tmp[2],0));
  $sort_order = varset($tmp[2],'desc');
  $from = intval(varset($tmp[3],0));
  unset($tmp);
}

$from = ($from ? $from : 0);
$amount = $pref['ratings_display_per_page'];
 

   getAllItems('news');
   getAllItems('comments');
   getAllItems('download');
   getAllItems('user');
   

if ( isset( $_POST['cleanupratingsbbcode'] ) ) {

   $cat = "news";
   $col = "news_body";
   
 
   
   if ( e107::getDb()->gen("SELECT * FROM #{$cat} WHERE {$col} LIKE '%ratings=%' ") ) {
   
   while ( $row = $sql->fetch() ) {
   
   extract($row);
   
   $b = preg_replace('/(\[ratings=.*?\])(.*?)(\[\/ratings\])/is', '', $news_body);
   
   update_old($cat, $news_id, $b, $col);
   
          }
        }

}



if (isset($_POST['moderate'])) {

global $pref;
	
  if (is_array($_POST['rate_exclude'])) {
	while (list ($key, $cid) = each ($_POST['rate_exclude'])) {
		$p = explode('-',$cid);
		$cat = $p[1];
		$id = $p[0];
		switch($cat){
		case "news":
		$col = "news_id";
		break;
		case "download":
		$col = "download_id";
		break;
		case "comments":
		$col = "comment_id";
		break;
		case "user":
		$col = "user_id";
		break;
		}
        
       
        $where  = "WHERE $col='$id' ";
	if (e107::getDb()->select($cat, "*", $where , true  )) {   
	$row = e107::getDb()->fetch();
 
	exclude_children($row, $cid, $cat, $col);
	
	}
  }
	}
	
	save_prefs();
	

}
 
 
 
/* function delete_children($row, $cid, $b, $col) {
  global $sql;
	$c_del[] = $cid;
  while (list ($key, $cid) = each ($c_del)) {
  $p = explode('-',$cid);
 	$cat = $p[1];
	$id = $p[0];
		$sql->db_Update($cat, "{$col}='$b' WHERE {$cat}_id='$id'");
		$sql->db_Delete("ratings", "id='$id'");
	}
 }*/
 
 
if ( isset( $_POST['update_ratings'] ) )  {
 
 global $sql;
 
 $info = explode('.',$_POST['rt_info']);
 
 $id  = $info[0];
 $rid = $info[1];
 $cat = $info[2];
   
 $sql->db_Update("ratings","total_votes = '".$_POST['total_votes']."', total_value = '".$_POST['total_value']."' WHERE id = '$id' AND rate_id = '$rid' AND total_cat = '$cat' ");

 header('Location: '.e_SELF.'?getCat='.$cat);
}

 
 
if ( isset( $_POST['ratings_save_options'] ) ) {
global $pref;
$pref['ratings_display_per_page'] = $_POST['ratings_display_per_page'];
$pref['ratings_class'] = $_POST['ratings_class'];
$pref['ratings_message_responce'] = $_POST['message_responce_select'];

save_prefs();

}


 


 if ( e_QUERY == 'options') {
  
  require_once(e_HANDLER.'userclass_class.php');
 global $pref;   
if ($pref['ratings_message_responce'] == 'true' ) {
$messageresponce_true = " selected='selected'";
$messageresponce_false = "";
} else {
$messageresponce_false = " selected='selected'";
$messageresponce_true = "";
}
    
    
  $text .= "<form id='ratings_perm_table' name='ratings_perm_table' action='".e_SELF."?".e_QUERY."' method='POST'>
  <table  class='ratings_table' border='0' cellspacing='0' cellpadding='0'>
          <tr>
           <td class='ratingstd'>
           ".LAN_RATINGS_17."
           </td>
           <td class='ratingstd'>
           ".r_userclass("ratings_class", $pref['ratings_class'], "off", "public,member,nobody,classes")."
           </td>
              </tr> 
              <tr>
  <td class='ratingstd'>
  ".LAN_RATINGS_3."
  </td>
  <td class='ratingstd'>
  <select name='message_responce_select'>
  <option value='true' $messageresponce_true >true</option>
  <option value='false' $messageresponce_false>false</option>
  </select>
  </td>
  </tr>
  <tr>
           <td class='ratingstd'>".LAN_RATINGS_27."</td>
           <td class='ratingstd'><input type='text' class='text' name='ratings_display_per_page' value='".$pref['ratings_display_per_page']."' /></td>
              </tr>
  <tr>
  <td>
  </td>
 </tr>
 <tr>
 <td class='ratingstd'></td>
 <td class='ratingstd'> 
 <input class='rt_button' type='submit' id='ratings_save_options' name='ratings_save_options' value='".LAN_RATINGS_15."' />
 </td>
  </tr>
  </table>  
  </form>  
  ";
 
 
 } else 
 
 if ( e_QUERY == 'utils' ) {
 
  $text .= "<form id='ratings_cleanup_table' name='ratings_cleanup_table' action='".e_SELF."?".e_QUERY."' method='POST'>
  <table  class='ratings_table' border='0' cellspacing='0' cellpadding='0'>
        <td class='ratingstd'>
        ".LAN_RATINGS_2."
        </td>
        <td class='ratingstd'>
        <input class='rt_button' type='submit' name='cleanupratingsbbcode' value='".LAN_RATINGS_16."' />
        </td>
  </table>  
  </form>  
  ";
 
 } else 
 
 if ( e_QUERY == 'help' ) {
 
  $text .= "<table  class='ratings_table' cellspacing='0' cellpadding='0'>
 <tr>
  <td class='ratingstd'>".LAN_RATINGS_1."</td>
</tr>
</table>
<table  class='ratings_table' cellspacing='0' cellpadding='0'>
 <tr>
<td class='ratingstd rt_news_thead'>
<b>news</b>
</td>
  <td class='ratingstd ex'>
  theme.php <hr />
  insert the {RATINGS} variable inside the function at right
  </td>
  <td class='ratingstd'>
    <textarea class='rt_code'>
  function news_style(\$news) { //tempalte code... }
  </textarea>   
  </td>
</tr>
<tr>
<td class='ratingstd rt_download_thead'>
<b>download</b>
</td>
  <td class='ratingstd ex'>
  download_template.php  
  <hr />
  replace the two variables at right with {RATINGS}
  </td>
  <td class='ratingstd'>
  {DOWNLOAD_LIST_RATING} 
  {DOWNLOAD_VIEW_RATING}
  </td>
</tr>
<tr>
<td class='ratingstd rt_user_thead'>
<b>user</b>
</td>
  <td class='ratingstd ex'>
  user_template.php
   <hr />
  find -> adjust ( by adding the {RATINGS} and for es.: user ratings: ) -> and paste each code at right, below the respective one you find in the user_template file! 
  </td>
  <td class='ratingstd'>
  
  <textarea class='rt_code'>
  <td class='fcaption' style='width:20%'>\".LAN_145.\"</td>
  </textarea>  
  
  <textarea class='rt_code'>
  	<td class='forumheader3' style='width:20%'>{USER_JOIN}</td>
  </textarea>   
  
  <textarea class='rt_code2'>
  <tr>
	<td  {\$main_colspan} style='width:100%' class='forumheader3'>
		<span style='float:left'>{USER_EMAIL_ICON} \".LAN_112.\"</span>
		<span style='float:right; text-align:right'>{USER_EMAIL_LINK}</span>
	</td>
</tr>
 </textarea> 
  
  </td>
</tr>
<tr>
<td class='ratingstd rt_comments_thead'>
<b>comments</b>
</td>
  <td class='ratingstd ex'>
  comment_template.php
  <hr />
  replace the variable at right with {RATINGS}
  </td>
  <td class='ratingstd'>
  {RATING}
  </td>
</tr>
</table>";
 
 
 } else 
 
// if ( erexgi( 'edit' , e_QUERY ) ) {
 if ( preg_match( '#edit#i' , e_QUERY ) ) {
 
 global $sql;
 
 $id = $_GET['id'];
 $rid = $_GET['rid'];
 $cat = $_GET['cat']; 
 
 $sql->db_Select("ratings","*","id = '$id' AND rate_id = '$rid' AND total_cat = '$cat' ");
 $row=$sql->db_Fetch();
 extract($row);
 $text .="
 <form method='POST' action='".e_SELF."'>
 <table  class='ratings_table' border='0' cellspacing='0' cellpadding='0'>
 <tr>
 <td class='ratingstd'> $cat ".LAN_RATINGS_4."</td> 
 <td class='ratingstd'>
  $id
  </td>
  </tr>
  <tr>
 <td class='ratingstd'>".LAN_RATINGS_26."</td> 
 <td class='ratingstd'>
  $rate_id
  </td>
  </tr>
 <tr> 
 <td class='ratingstd'>".LAN_RATINGS_24."</td> 
 <td class='ratingstd'>
  <input type='text' value='$total_votes' name='total_votes' class='text' />
  </td>
  </tr>
  <tr>
<td class='ratingstd'>".LAN_RATINGS_25."</td>  
<td class='ratingstd'>
  <input type='text' value='$total_value' name='total_value' class='text' />
  <input type='hidden' value='".$id.".".$rid.".".$cat."' name='rt_info' id='rt_info' />
  </td>
</tr> <tr>
<td class='ratingstd'></td>
<td class='ratingstd'>
<input class='rt_button' type='submit' name='update_ratings' value='Update' /> 
</td>
</tr>
</table>
</form>
 ";
 
 
 } else {
 

 $text .= "<form id='ratings_manager_table' name='ratings_manager_table' action='".e_SELF."' method='POST'>

   <table class='ratings_table'  cellspacing='0' cellpadding='0'>
   <tr>
  <td class='ratingscat $tab2'><a href='".e_SELF."?getCat=news'>News &rarr;</a></td> 
  <td class='ratingscat $tab4'><a href='".e_SELF."?getCat=user'>User &rarr;</a></td>
  <td class='ratingscat $tab1'><a href='".e_SELF."?getCat=comments'>Comments &rarr;</a></td>
  <td class='ratingscat $tab3'><a href='".e_SELF."?getCat=download'>Download &rarr;</a></td>
  </tr>
  </table>
          <table class='ratings_table $tableactive'  cellspacing='0' cellpadding='0'>
          
       <thead class='$theadactive'> 
<tr> 
          <th class='ratingstd' >".LAN_RATINGS_4."</th>
          <th class='ratingstd' >".LAN_RATINGS_5."</th>
          <th class='ratingstd' >".LAN_RATINGS_6."</th>         
          <th class='ratingstd' >".LAN_RATINGS_7."</th>
          <th class='ratingstd' >".LAN_RATINGS_8."</th>
          <th class='ratingstd' >".LAN_RATINGS_9."</th>
          <th class='ratingstd' >".LAN_RATINGS_10."</th>
          <th class='ratingstd' >".LAN_RATINGS_11."</th>
          <th class='ratingstd' >".LAN_RATINGS_12."</th>
          </tr> 
</thead> 
<tbody> ";

 // ".getIps($used_ips)."
  
$sql = new db;
 $sql -> db_Select_gen("SELECT * FROM #ratings WHERE total_cat = '$getcat' ORDER BY ".($sub_action ? $sub_action : "id")." ".strtoupper($sort_order)."  LIMIT {$from}, {$amount}");
  while($r = $sql->db_Fetch()){
			extract($r);

    $text .= "<div class='ratingstd_row'>       
  <tr>   	                     
    <td class='ratingstd $activecolor'>".$r['id']."</td>                       
    <td class='ratingstd $activecolor'>".$r['rate_id']."</td>                       
    <td class='ratingstd $activecolor'>".$r['total_cat']."</td>                       
    <td class='ratingstd $activecolor'>".get_status($r['rate_this'])."</td>                       
    <td class='ratingstd rt_td_title $activecolor'>".get_cat($r['rate_id'],$r['total_cat'])."</td>                       
    <td class='ratingstd $activecolor'>".$r['total_votes']."</td>                       
    <td class='ratingstd $activecolor'>".$r['total_value']."</td>                     
    <td class='ratingstd $activecolor'><a class='rt_edit' href='".e_SELF."?edit&cat=".$r['total_cat']."&rid=".$r['rate_id']."&id=".$r['id']."' title=' Edit '>Edit</a></td>                                     
    <td class='ratingstd $activecolor'>      
      <input type='checkbox' name='rate_exclude[]' value='".$r['rate_id']."-".$r['total_cat']."' /></td>                                   
  </tr>  
</div>"; 	  } 	   	  
$text .= "     
</table>    
<table class='ratings_table'  cellspacing='0' cellpadding='0'>    
  <tr>    
    <td class='ratingstd'>
      <input class='rt_button' type='submit' name='moderate' value='".LAN_RATINGS_13."' /></td>    
  </tr>    
  </tbody>      
</table>    
</form>
   ";


       
        $parms = $newsposts.",".$amount.",".$from.",".e_SELF."?".(e_QUERY ? "$action.$sub_action.$sort_order." : "$getcat.id.desc.")."[FROM]";
        $text .= "<br /><div style='text-align:center'>".$tp->parseTemplate("{NEXTPREV={$parms}}")."</div>";
        

    
        }
    
$ns -> tablerender( LAN_RATINGS_14 , $text );

require_once(e_ADMIN."footer.php");
//Luca Filosofi > {aSeptik} @gmail.com (c) '09
?>