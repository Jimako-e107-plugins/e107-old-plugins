<?php
if (e_QUERY) {
    $tmp = explode(e_QUERY);
    $cpage_id = intval($tmp[0]);
    global $sql;
    if ($sql->db_Select('cpage_page', 'cpage_canonical', 'where cpage_id=' . $cpage_id, 'nowhere', false)) {
        extract($sql->db_Fetch());
        if (!empty($cpage_canonical)) {
            echo "<link rel='canonical' href='" . $cpage_canonical . "' />";
        }
    }
}