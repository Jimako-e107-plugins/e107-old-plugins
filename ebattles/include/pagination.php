<?php
function paginate($rowsPerPage, $pg, $totalItems) {
  /* make sure pagination doesn't interfere with other query 
string variables */
  if(isset($_SERVER['QUERY_STRING']) && trim(
    $_SERVER['QUERY_STRING']) != '') {
    if(stristr($_SERVER['QUERY_STRING'], 'pg='))
      $query_str = '?'.preg_replace('/pg=\d+/', 'pg=', 
        $_SERVER['QUERY_STRING']);
    else
      $query_str = '?'.$_SERVER['QUERY_STRING'].'&amp;pg=';
  } else
    $query_str = '?pg=';
    
  /* find out how many pages we have */
  $pages = ($totalItems <= $rowsPerPage) ? 1 : ceil($totalItems / $rowsPerPage);
    
  /* create the links */
  $first = '<a href="'.$_SERVER['PHP_SELF'].$query_str.'1">&#171;</a>';
  $prev = '<a href="'.$_SERVER['PHP_SELF'].$query_str.($pg - 1).'">&#139;</a>';
  $next = '<a href="'.$_SERVER['PHP_SELF'].$query_str.($pg + 1).'">&#155;</a>';
  $last = '<a href="'.$_SERVER['PHP_SELF'].$query_str.$pages.'">&#187;</a>';
   
  /* display opening navigation */
  $output = '<table><tbody><tr><td>';
  $output .= ($pg > 1) ? "$first : $prev :" : '&#171; : &#139; :';
  
  /* limit the number of page links displayed */
  $begin = $pg - 4;
  while($begin < 1)
    $begin++;
  $end = $pg + 4;
  while($end > $pages)
    $end--;
  for($i=$begin; $i<=$end; $i++)
    $output .= ($i == $pg) ? ' ['.$i.'] ' : ' <a href="'.
      $_SERVER['PHP_SELF'].$query_str.$i.'">'.$i.'</a> ';
    
  /* display ending navigation */
  $output .= ($pg < $pages) ? ": $next : $last" : ': &#155; : &#187;';
  $output .= '</td></tr></tbody></table>';
  
  return $output;
}
?>