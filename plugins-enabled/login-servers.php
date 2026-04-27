<?php
require_once('plugins/login-servers.php');

$servers = getenv('ADMINER_SERVERS');
$server_list = [];

if ($servers) {
    foreach (explode(',', $servers) as $s) {
        $parts = explode('=', $s);
        if (count($parts) == 2) {
            $server_list[$parts[0]] = [
                "server" => $parts[1],
                "driver" => "server"
            ];
        }
    }
}

return new AdminerLoginServers($server_list);
