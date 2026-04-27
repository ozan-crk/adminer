<?php
// adminer-plugins.php

// Plugin dosyalarını dahil et
require_once('plugins/login-servers.php');
require_once('plugins/tables-filter.php');
require_once('plugins/json-column.php');
require_once('plugins/imagefields.php');
require_once('plugins/readable-dates.php');
require_once('plugins/theme-switcher.php');

// ENV üzerinden sunucu listesini al (Format: Etiket1=host1,Etiket2=host2)
$servers = getenv('ADMINER_SERVERS');
$server_list = [];

if ($servers) {
    foreach (explode(',', $servers) as $s) {
        $parts = explode('=', $s);
        if (count($parts) == 2) {
            $label = $parts[0];
            $host = $parts[1];
            // MySQL/MariaDB için driver 'server' olarak tanımlanır
            $server_list[$label] = [
                "server" => $host,
                "driver" => "server"
            ];
        }
    }
}

return [
    new AdminerTablesFilter(),
    new AdminerLoginServers($server_list),
    new AdminerJsonColumn(),
    new AdminerImagefields(),
    new AdminerReadableDates(),
    new AdminerThemeSwitcher(),
];
