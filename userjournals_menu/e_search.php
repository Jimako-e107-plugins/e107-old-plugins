<?php
if (file_exists(e_PLUGIN."userjournals_menu/languages/".e_LANGUAGE.".php")){
   include_once(e_PLUGIN."userjournals_menu/languages/".e_LANGUAGE.".php");
} else {
   include_once(e_PLUGIN."userjournals_menu/languages/English.php");
}

$search_info[] = array(
   'sfile'     => e_PLUGIN.'userjournals_menu/search.php',
   'qtype'     => UJ1,
   'refpage'   => 'userjournals.php'
);

?>
