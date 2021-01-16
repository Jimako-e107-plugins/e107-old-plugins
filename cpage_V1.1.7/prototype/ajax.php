<?php
require_once('../../class2.php');
// for($i = 1;$i < 32000000;$i++) {
// delay just to show the updater
// }
if ($_POST['action'] == 'update') {
    if ($sql->db_Select('chatbox', 'cb_id,cb_nick ,cb_message,cb_datestamp', 'where cb_blocked=0 order by cb_datestamp desc limit 0,5', 'where', false)) {
        while ($row = $sql->db_Fetch()) {
            $tmp = explode('.', $row['cb_nick'], 2);
            // $cbrow .= '<img src="'.SITEURL.$IMAGES_DIRECTORY.'admin_images/chatbox_16.png" /> '.$tmp[1] . ' ' . date('d/M/Y h:m', $row['cb_datestamp']) . '<br />' . $row['cb_message'] . '<br /><br />';
            $cbrow[] = array(
                'cb_id' => $row['cb_id'],
                'cb_nick_id' => $tmp[0],
                'cb_nick_name' => $tmp[1],
                'cb_date' => date('d-M-Y h:m', $row['cb_datestamp']),
                'cb_message' => $row['cb_message']);
        }
    }
    // echo $_POST['action'];
    header('Content-type: application/x-json');
    echo json_encode($cbrow);
} elseif ($_POST['action'] == 'chatpost') {
    $sql->db_Insert('chatbox', '0,"' . USERID . '.' . USERNAME . '","' . $_POST['chat_message'] . '",' . time() . ',0,"192.168.0.999"', false);
} else {
    echo'Huh?';
}