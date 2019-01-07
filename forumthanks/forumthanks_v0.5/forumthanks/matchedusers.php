<?php
// Fill up array with names




$q    =$_GET["q"];

   require_once("../../class2.php");

   $item = intval($item);
   $q    = preg_replace('#\W#', '', $q);
   $q    = $tp->todb($q);       //security - SQL injection risk?
   //echo "item:$i";
   echo "<p>";
   echo "Users Found:<p>";
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