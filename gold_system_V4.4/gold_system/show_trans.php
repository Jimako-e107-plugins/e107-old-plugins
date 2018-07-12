<?php
require_once('../../class2.php');
if (!defined('e107_INIT'))
{
    exit;
}
require_once(e_PLUGIN.'gold_system/includes/gold_class.php');
$gold_obj=new gold;

$file = e_QUERY;
$filename = $GOLD_PREF['gold_arcloc'] . '/' . $file;

$tmp = explode('_', e_QUERY);
if ($tmp[0] != USERID &&!ADMIN)
{
    print "Invalid";
    exit;
}
if (is_file($filename) && is_readable($filename) && connection_status() == 0)
{
    if (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE"))
    {
        $file = preg_replace('/\./', '%2e', $file, substr_count($file, '.') - 1);
    }
    if (isset($_SERVER['HTTP_RANGE']))
    {
        $seek = intval(substr($_SERVER['HTTP_RANGE'] , strlen('bytes=')));
    }
    $bufsize = 2048;
    ignore_user_abort(true);
    $data_len = filesize($filename);
    if ($seek > ($data_len - 1))
    {
        $seek = 0;
    }
    if ($filename == null)
    {
        $filename = basename($this->data);
    }
    $res = &fopen($filename, 'rb');
    if ($seek)
    {
        fseek($res , $seek);
    }
    $data_len -= $seek;
    header("Expires: 0");
    header("Cache-Control: max-age=30");
    header("Content-Type: application/pdf");
    header("Content-Disposition: inline; filename=\"{$file}\"");
    header("Content-Length: {$data_len}");
    header("Pragma: public");
    if ($seek)
    {
        header("Accept-Ranges: bytes");
        header("HTTP/1.0 206 Partial Content");
        header("status: 206 Partial Content");
        header("Content-Range: bytes {$seek}-" . ($data_len - 1) . "/{$data_len}");
    }
    while (!connection_aborted() && $data_len > 0)
    {
        echo fread($res , $bufsize);
        $data_len -= $bufsize;
    }
    fclose($res);
}
else
{
    print "fail";
}
