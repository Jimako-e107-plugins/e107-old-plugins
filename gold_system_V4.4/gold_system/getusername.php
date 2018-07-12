<?php
if (isset($_GET['letters']))
{
    require_once('../../class2.php');
    $sql->db_Select('user', 'user_id,user_name', 'where user_name like "' . $_GET['letters'] . '%"', 'nowhere', false);
    while ($row = $sql->db_Fetch())
    {
        $result .= $row['user_id'] . '###' . $row['user_name'] . '|';
    }
    echo $result;
}
else
{
    echo '';
}

?>