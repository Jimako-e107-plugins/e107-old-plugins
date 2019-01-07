<?php
// Fill up array with names


   require_once("../../class2.php");
   
      if (!getperms("P")) {
      header("location:".e_HTTP."index.php");
      exit;
   }
   
   $q    =$_GET["q"];

   $item = intval($item);
   $q    = preg_replace('#\W#', '', $q);
   $q    = $tp->todb($q);       //security - SQL injection risk?
   //echo "item:$i";
   
   include_lan(e_PLUGIN.'forumthanks/languages/'.e_LANGUAGE.'/lan_admin_thanks.php');

   
   echo "<p>";
   echo "".LAN_AT16."<p>";
   if (strlen($q)>2){
       $sql->db_select("user","user_name, user_id","user_name like '%$q%'");

       while ($list = $sql->db_Fetch())

       {
       $name    = $list['user_name'];
       $user_id = $list['user_id'];
       echo "<a href ='admin_moderate.php?mo.$user_id'>$name</a><br />";
       }
 }



?>