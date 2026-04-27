<?php
require_once('plugins/login-servers.php');

$all_vars = array_merge($_ENV, $_SERVER);
$servers = '';

foreach ($all_vars as $key => $val) {
    if (strtoupper($key) === 'ADMINER_SERVERS') {
        $servers = $val;
        break;
    }
}

$server_list = [];

if (!empty($servers)) {
    foreach (explode(',', $servers) as $s) {
        $parts = explode('=', trim($s));
        if (count($parts) >= 2) {
            $server_list[trim($parts[0])] = ["server" => trim($parts[1]), "driver" => "server"];
        }
    }
}

if (empty($server_list)) {
    $server_list["--- DEBUG: İLK 20 VAR ---"] = ["server" => "localhost", "driver" => "server"];
    $keys = array_keys($all_vars);
    sort($keys);
    foreach (array_slice($keys, 0, 20) as $k) {
        $server_list["K: $k"] = ["server" => "localhost", "driver" => "server"];
    }
}

return new AdminerLoginServers($server_list);
