<?php
// adminer-plugins.php

// Plugin iskeletini dahil et (Docker imajında bu konumdadır)
if (file_exists('plugins/plugin.php')) {
    require_once('plugins/plugin.php');
}

// Diğer plugin dosyalarını dahil et
require_once('plugins/login-servers.php');
require_once('plugins/tables-filter.php');
require_once('plugins/json-column.php');
require_once('plugins/imagefields.php');
require_once('plugins/readable-dates.php');
require_once('plugins/theme-switcher.php');

/**
 * Adminer resmi Docker imajı bu fonksiyonun varlığını kontrol eder.
 * Varsa, Adminer nesnesini bu fonksiyon üzerinden oluşturur.
 */
function adminer_object() {
    $servers = getenv('ADMINER_SERVERS');
    $server_list = [];

    if ($servers) {
        foreach (explode(',', $servers) as $s) {
            $parts = explode('=', $s);
            if (count($parts) == 2) {
                $label = $parts[0];
                $host = $parts[1];
                $server_list[$label] = [
                    "server" => $host,
                    "driver" => "server"
                ];
            }
        }
    }

    $plugins = [
        new AdminerTablesFilter(),
        new AdminerLoginServers($server_list),
        new AdminerJsonColumn(),
        new AdminerImagefields(),
        new AdminerReadableDates(),
        new AdminerThemeSwitcher(),
    ];
    
    return new AdminerPlugin($plugins);
}
