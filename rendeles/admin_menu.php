<?php

if (e_LANGUAGE != "Hungarian" && file_exists(e_PLUGIN . "rendeles/languages/" . e_LANGUAGE . ".php")){ 
include_once(e_PLUGIN . "rendeles/languages/" . e_LANGUAGE . ".php");}
else {include_once(e_PLUGIN . "rendeles/languages/Hungarian.php");}

$action = basename($_SERVER['PHP_SELF'], ".php");

    $var['admin_config']['text'] = RENDELES_ADLAN_1;
    $var['admin_config']['link'] = "admin_config.php";

    $var['admin_banners']['text'] = RENDELES_ADLAN_3;
    $var['admin_banners']['link'] = "admin_banners.php";
    
    $var['admin_flower']['text'] = RENDELES_ADLAN_5;
    $var['admin_flower']['link'] = "admin_flower.php";
    
    $var['admin_color']['text'] = RENDELES_ADLAN_55;
    $var['admin_color']['link'] = "admin_color.php";
    
    $var['admin_type']['text'] = RENDELES_ADLAN_7;
    $var['admin_type']['link'] = "admin_type.php";
    
    $var['admin_customer']['text'] = RENDELES_ADLAN_9;
    $var['admin_customer']['link'] = "admin_customer.php";
    
    $var['admin_rendeles']['text'] = RENDELES_ADLAN_34;
    $var['admin_rendeles']['link'] = "admin_rendeles.php";

    $var['admin_rendflowers']['text'] = RENDELES_ADLAN_37;
    $var['admin_rendflowers']['link'] = "admin_rendflowers.php";
    
show_admin_menu(RENDELES_ADLAN_0, $action, $var);


?>