<?php
require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}
$pageear_id = intval(e_QUERY);
$sql->db_Select("pageear_clickthru", "*", "where pageear_clickthru_id=$pageear_id", "nowhere", false);
$row = $sql->db_Fetch();
$pageear_clickthru_link = $row['pageear_clickthru_link'];

if (strpos($pageear_clickthru_link, "http") === false)
{
    $pageear_clickthru_link = "http://" . $pageear_clickthru_link;
}

$pageear_ip = $e107->getip();
$pageear_iplist = explode(",", $row['pageear_clickthru_ips']);
if (!in_array($pageear_ip, $pageear_iplist))
{
    $pageear_iplist[] = $pageear_ip;
    $pageear_clickthru_ips = implode(",", $pageear_iplist);
    $sql->db_Update("pageear_clickthru", "pageear_clickthru_clicks=pageear_clickthru_clicks+1 ,pageear_clickthru_ips='" . $pageear_clickthru_ips . "' where pageear_clickthru_id =$pageear_id", false);
}
header("Location: {$pageear_clickthru_link}");

?>