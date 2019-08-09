<?php
include '/srv/panel/inc/util.php';

function isEnabled3($process){
    $service = $process;
    $estado = trim( shell_exec("systemctl is-active $process") );
    if($estado=="active"){
      return true;
    } else {
      return false;
    }
  }

function processExists($processName, $username) {
  $exists= false;
  exec("/bin/ps axo user:20,pid,pcpu,pmem,vsz,rss,tty,stat,start,time,comm,cmd|grep $username | grep -iE $processName | grep -v grep", $pids);
  if (count($pids) > 0) {
    $exists = true;
  }
  return $exists;
}

$webmin = isEnabled3("webmin");
if ($webmin == "1") { $filval = "<span class=\"badge badge-service-running-dot\"></span><span class=\"badge badge-service-running-pulse\"></span>";
} else { $filval = "<span class=\"badge badge-service-disabled-dot\"></span><span class=\"badge badge-service-disabled-pulse\"></span>";
}
echo "$filval";
?> 