<?php
require_once('plugins/login-servers.php');

// Hem getenv hem $_SERVER üzerinden kontrol et
$servers = getenv('ADMINER_SERVERS') ?: ($_SERVER['ADMINER_SERVERS'] ?? '');
$server_list = [];

if (!empty($servers)) {
    foreach (explode(',', $servers) as $s) {
        $parts = explode('=', trim($s));
        if (count($parts) >= 2) {
            $label = trim($parts[0]);
            $host = trim($parts[1]);
            $server_list[$label] = [
                "server" => $host,
                "driver" => "server"
            ];
        }
    }
}

// Eğer hala boşsa, debug amaçlı bir seçenek ekleyelim
if (empty($server_list)) {
    $server_list["Hata: Sunucu Bulunamadı"] = [
        "server" => "localhost",
        "driver" => "server"
    ];
}

return new AdminerLoginServers($server_list);
