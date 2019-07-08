<?php

include ("../inc/localize.php");

define('HTTP_HOST', preg_replace('~^www\.~i', '', $_SERVER['HTTP_HOST']));

$time_start = microtime_float();

function memory_usage() {
  $memory  = ( ! function_exists('memory_get_usage')) ? '0' : round(memory_get_usage()/1024/1024, 2).'MB';
  return $memory;
}

// Timing
function microtime_float() {
  $mtime = microtime();
  $mtime = explode(' ', $mtime);
  return $mtime[1] + $mtime[0];
}

//Esto se basa en la carga del servidor y su número de micros, no en un uso real de CPU.
//$loads = sys_getloadavg();
//$core_nums = trim(shell_exec("grep -P '^processor' /proc/cpuinfo|wc -l"));
//$load = round($loads[0]/($core_nums + 1)*100, 2);

//Obtengo porcentaje de uso de microprocesador real.
$load = trim( shell_exec("echo $[100-$(vmstat 1 2|tail -1|awk '{print $15}')]") );

//Incluimos frecuencia en tiempo real
if (false === ($str = @file("/proc/cpuinfo"))) return false;
$str = implode("", $str);

$frecuencias = trim(shell_exec("sed -n 's/cpu MHz.*://p' /proc/cpuinfo"));
$freq_array = explode(" ",$frecuencias); //slip de la cadena en un array
$tam = count($freq_array); //tamaño del array

$resultado = 0;

for($i=0; $i < $tam ; $i++){
	$resultado = $resultado + $freq_array[$i];
}

$resultado = $resultado / $tam; //media aritmética

?>

{"cpu":<?php echo "$load"; ?>, "cpu_media":<?php echo "$resultado"; ?>}