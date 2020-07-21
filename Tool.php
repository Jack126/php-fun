<?php
/**
* 获取本机ipv4
* @return array() 
* @author Jack126
* @date 2020/07/21 16:00
*/
function get_local_ipv4()
{
    $out = explode(PHP_EOL, shell_exec("/sbin/ifconfig"));
    $local_addrs = array();
    $ifname = 'unknown';
    foreach ($out as $str) {
        $matches = array();
        if (preg_match('/^([a-z0-9]+):/', $str, $matches)) {
            $ifname = $matches[0];
            if (strlen($matches[1]) > 0) {
                $ifname = $matches[1];
            }
        } elseif (preg_match('/inet ((?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:[.](?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3})\s/', $str, $matches)) {
            $local_addrs[$ifname] = $matches[1];
        }
    }
    return $local_addrs;
}
