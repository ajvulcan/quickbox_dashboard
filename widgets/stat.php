<?php
$interface = file_get_contents('cat /srv/rutorrent/home/db/interface.txt');
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
$data['rec'] = exec("cat /sys/class/net/$interface/statistics/rx_bytes");
$data['snd'] = exec("cat /sys/class/net/$interface/statistics/tx_bytes");
$output = json_encode($data);
echo "retry: 1000\n";
echo "data: {$output}\n\n";
flush();