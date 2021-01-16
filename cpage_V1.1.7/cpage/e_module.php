<?php

require_once(e_BASE . 'class2.php');

if (!is_object($cpage_obj)) {
    require_once(e_PLUGIN . "cpage/includes/cpage_class.php");
    $cpage_obj = new cpage;
}

if ($CPAGE_PREF['cpage_redirect'] == 1 && strpos(e_SELF, '/page.php') !== false) {
    if (e_QUERY) {
        $tmp = explode('.', e_QUERY);
        $page_id = intval($tmp[0]);
        if ($sql->db_Select('cpage_page', 'cpage_id,cpage_link,cpage_title', "where cpage_id={$tmp[0]}", 'nowhere', false)) {
            extract($sql->db_Fetch());
            $newloc = SITEURL . $cpage_obj->make_url($cpage_link, $cpage_id, 0, $cpage_title);
            header("HTTP/1.1 301 Moved Permanently");
            header("Location:{$newloc}");
        }
    } else {
        $newloc = SITEURL . 'cpage.php';
        header("HTTP/1.1 301 Moved Permanently");
        header("Location:{$newloc}");
    }
}