//Luca Filosofi > {aSeptik} @gmail.com (c) '09
//Last Update: 16.01.2010
require_once(e_BASE."class2.php");
include_lan(e_PLUGIN."ratings/languages/".e_LANGUAGE.".php"); 
include_once (e_PLUGIN.'ratings/ratings_function.php');
global $e107 , $comrow , $row , $dl , $user;

$c = basename(e_SELF , '.php'); //get category name
$i = explode('.', e_QUERY); //get ALL CAT id




if ( $c == 'news' ) {
$news_item = getcachedvars('current_news_item');
$id = $news_item['news_id']; 
$cat = "news";
} else 

if ( $c == 'comment' ) {
$id = $comrow['comment_id'];
$cat = "comments";
} else 

if ( $c == 'download' ) {
$id = ( $i[0] == 'list' ) ? $row['download_id']  : $dl['download_id'];
$cat = "download";
} else 

if ( $c == 'user' ) {
$id = $user['user_id'];
$cat = "user";
} 

 $count = new db;
 $rtCount = $count->db_Count("ratings","(*)","WHERE rate_id = '$id' AND total_cat = '$cat' AND rate_this = '0' ");

if ( !$rtCount ) {
   
   getAllItems($cat);
   
   }


$units = $parm; //<- $parm
$static = ''; //<- $code_text;
$ip = $e107->getip();

$rating_unitwidth  = 15; //$pref['ratingunitwidth'];

return rating_this( $id , $cat , $units , $static , $ip , $rating_unitwidth );
//Luca Filosofi > {aSeptik} @gmail.com (c) '09