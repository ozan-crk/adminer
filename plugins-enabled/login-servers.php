<?php
require_once('plugins/login-servers.php');

// Agresif tarama: Tüm kaynakları birleştir ve büyük harfle kontrol et
$all_vars = array_merge($_ENV, $_SERVER);
$servers = '';

foreach ($all_vars as $key => $val) {
    if (strtoupper($key) === 'ADMINER_SERVERS') {
        $servers = $val;
        break;
    }
}

if (empty($servers)) {
    $servers = getenv('ADMINER_SERVERS');
}

$server_list = [];

if (!empty($servers) && is_string($servers)) {
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

// Fallback: Sorun devam ediyorsa anlamamıza yarayacak
if (empty($server_list)) {
    $server_list["Hata: Değişken Bulunamadı (" . count($all_vars) . " var)"] = [
        "server" => "localhost",
        "driver" => "server"
    ];
    $server_list["Manuel Giriş (db)"] = [
        "server" => "db",
        "driver" => "server"
    ];
}

return new AdminerLoginServers($server_list);
