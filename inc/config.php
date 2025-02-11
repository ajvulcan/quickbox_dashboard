<?php
if (isset($_SESSION))
{
  session_destroy();
}

include '/srv/panel/inc/util.php';
include ($_SERVER['DOCUMENT_ROOT'].'/widgets/class.php');
$version = "v1.2.0";
error_reporting(E_ERROR);
$master = file_get_contents('/srv/panel/db/master.txt');
$master=preg_replace('/\s+/', '', $master);
$username = getUser();

require_once ($_SERVER['DOCUMENT_ROOT'].'/inc/localize.php');

// Network Interface
$interface = INETFACE;
$iface_list = array('INETFACE');
$iface_title['INETFACE'] = 'External';
$vnstat_bin = '/usr/bin/vnstat';
$data_dir = './dumps';
$byte_notation = null;

$zconf = '/srv/panel/db/znc.txt';
if (file_exists($zconf)) {
    $zconf_data = file_get_contents($zconf);
    $zport = search($zconf_data, 'Port = ', "\n");
    $zssl = search($zconf_data, 'SSL = ', "\n");
}

function search($data, $find, $end) {
    $pos1 = strpos($data, $find) + strlen($find);
    $pos2 = strpos($data, $end, $pos1);
    return substr($data, $pos1, $pos2 - $pos1);
}

define('HTTP_HOST', preg_replace('~^www\.~i', '', $_SERVER['HTTP_HOST']));

$panel = array(
    'name'              => 'Servidor HD',
    'author'            => 'ajvulcan',
    'robots'            => 'noindex, nofollow',
    'title'             => 'Servidor HD',
    'description'       => 'Servidor privado',
    'active_page'       => basename($_SERVER['PHP_SELF']),
);

$time_start = microtime_float();

// Timing
function microtime_float() {
  $mtime = microtime();
  $mtime = explode(' ', $mtime);
  return $mtime[1] + $mtime[0];
}

//Unit Conversion
function formatsize($size) {
  $danwei=array(' B ',' KB ',' MB ',' GB ',' TB ');
  $allsize=array();
  $i=0;
  for($i = 0; $i <5; $i++) {
    if(floor($size/pow(1024,$i))==0){break;}
  }
  for($l = $i-1; $l >=0; $l--) {
    $allsize1[$l]=floor($size/pow(1024,$l));
    $allsize[$l]=$allsize1[$l]-$allsize1[$l+1]*1024;
  }
  $len=count($allsize);
  for($j = $len-1; $j >=0; $j--) {
    $fsize=$fsize.$allsize[$j].$danwei[$j];
  }
  return $fsize;
}

function GetCoreInformation() {$data = file('/proc/stat');$cores = array();foreach( $data as $line ) {if( preg_match('/^cpu[0-9]/', $line) ){$info = explode(' ', $line);$cores[]=array('user'=>$info[1],'nice'=>$info[2],'sys' => $info[3],'idle'=>$info[4],'iowait'=>$info[5],'irq' => $info[6],'softirq' => $info[7]);}}return $cores;}
function GetCpuPercentages($stat1, $stat2) {if(count($stat1)!==count($stat2)){return;}$cpus=array();for( $i = 0, $l = count($stat1); $i < $l; $i++) { $dif = array(); $dif['user'] = $stat2[$i]['user'] - $stat1[$i]['user'];$dif['nice'] = $stat2[$i]['nice'] - $stat1[$i]['nice'];  $dif['sys'] = $stat2[$i]['sys'] - $stat1[$i]['sys'];$dif['idle'] = $stat2[$i]['idle'] - $stat1[$i]['idle'];$dif['iowait'] = $stat2[$i]['iowait'] - $stat1[$i]['iowait'];$dif['irq'] = $stat2[$i]['irq'] - $stat1[$i]['irq'];$dif['softirq'] = $stat2[$i]['softirq'] - $stat1[$i]['softirq'];$total = array_sum($dif);$cpu = array();foreach($dif as $x=>$y) $cpu[$x] = round($y / $total * 100, 2);$cpus['cpu' . $i] = $cpu;}return $cpus;}
$stat1 = GetCoreInformation();sleep(1);$stat2 = GetCoreInformation();$data = GetCpuPercentages($stat1, $stat2);
$cpu_show = $data['cpu0']['user']."%us,  ".$data['cpu0']['idle']."%id,  ";

// Information obtained depending on the system CPU
switch(PHP_OS)
{
  case "Linux":
    $sysReShow = (false !== ($sysInfo = sys_linux()))?"show":"none";
  break;

  case "FreeBSD":
    $sysReShow = (false !== ($sysInfo = sys_freebsd()))?"show":"none";
  break;

  default:
  break;
}

//linux system detects
function sys_linux()
{
    // CPU
    if (false === ($str = @file("/proc/cpuinfo"))) return false;
    $str = implode("", $str);
    @preg_match_all("/model\s+name\s{0,}\:+\s{0,}([^\:]+)([\r\n]+)/s", $str, $model);
    @preg_match_all("/cpu\s+MHz\s{0,}\:+\s{0,}([\d\.]+)[\r\n]+/", $str, $mhz);
    @preg_match_all("/cache\s+size\s{0,}\:+\s{0,}([\d\.]+\s{0,}[A-Z]+[\r\n]+)/", $str, $cache);
    if (false !== is_array($model[1]))
  {
        $res['cpu']['num'] = sizeof($model[1]);

    if($res['cpu']['num']==1)
      $x1 = '';
    else
      $x1 = ' ×'.$res['cpu']['num'];
    //$mhz[1][0] = ' <span style="color:#999;font-weight:600">Frecuencia (Mhz):</span> '.$mhz[1][0];
    $mhz[1][0] = ' <span style="color:#999;font-weight:600">Frecuencia (Mhz):</span><span id="freq_actual"></span>';
    $cache[1][0] = ' <br /> <span style="color:#999;font-weight:600">Cache secundaria:</span> '.$cache[1][0];
    $res['cpu']['model'][] = '<h4>'.$model[1][0].'</h4>'.$mhz[1][0].$cache[1][0].$x1;
        if (false !== is_array($res['cpu']['model'])) $res['cpu']['model'] = implode("<br />", $res['cpu']['model']);
        if (false !== is_array($res['cpu']['mhz'])) $res['cpu']['mhz'] = implode("<br />", $res['cpu']['mhz']);
        if (false !== is_array($res['cpu']['cache'])) $res['cpu']['cache'] = implode("<br />", $res['cpu']['cache']);
  }

    return $res;
}

//FreeBSD system detects
function sys_freebsd()
{
  //CPU
  if (false === ($res['cpu']['num'] = get_key("hw.ncpu"))) return false;
  $res['cpu']['model'] = get_key("hw.model");
  return $res;
}

//Obtain the parameter values FreeBSD
function get_key($keyName)
{
  return do_command('sysctl', "-n $keyName");
}

//Determining the location of the executable file FreeBSD
function find_command($commandName)
{
  $path = array('/bin', '/sbin', '/usr/bin', '/usr/sbin', '/usr/local/bin', '/usr/local/sbin');
  foreach($path as $p)
  {
    if (@is_executable("$p/$commandName")) return "$p/$commandName";
  }
  return false;
}

//Order Execution System FreeBSD
function do_command($commandName, $args)
{
  $buffer = "";
  if (false === ($command = find_command($commandName))) return false;
  if ($fp = @popen("$command $args", 'r'))
  {
    while (!@feof($fp))
    {
      $buffer .= @fgets($fp, 4096);
    }
    return trim($buffer);
  }
  return false;
}


function GetWMI($wmi,$strClass, $strValue = array()) {
  $arrData = array();

  $objWEBM = $wmi->Get($strClass);
  $arrProp = $objWEBM->Properties_;
  $arrWEBMCol = $objWEBM->Instances_();
  foreach($arrWEBMCol as $objItem) {
    @reset($arrProp);
    $arrInstance = array();
    foreach($arrProp as $propItem) {
      eval("\$value = \$objItem->" . $propItem->Name . ";");
      if (empty($strValue)) {
        $arrInstance[$propItem->Name] = trim($value);
      } else {
        if (in_array($propItem->Name, $strValue)) {
          $arrInstance[$propItem->Name] = trim($value);
        }
      }
    }
    $arrData[] = $arrInstance;
  }
  return $arrData;
}

//NIC flow
$strs = @file("/proc/net/dev");

for ($i = 2; $i < count($strs); $i++ ) {
  preg_match_all( "/([^\s]+):[\s]{0,}(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)/", $strs[$i], $info );
  $NetOutSpeed[$i] = $info[10][0];
  $NetInputSpeed[$i] = $info[2][0];
  $NetInput[$i] = formatsize($info[2][0]);
  $NetOut[$i]  = formatsize($info[10][0]);
}

//Real-time refresh ajax calls
if ($_GET['act'] == "rt") {
  $arr=array('NetOut2'=>"$NetOut[2]",'NetOut3'=>"$NetOut[3]",'NetOut4'=>"$NetOut[4]",'NetOut5'=>"$NetOut[5]",'NetOut6'=>"$NetOut[6]",'NetOut7'=>"$NetOut[7]",'NetOut8'=>"$NetOut[8]",'NetOut9'=>"$NetOut[9]",'NetOut10'=>"$NetOut[10]",'NetInput2'=>"$NetInput[2]",'NetInput3'=>"$NetInput[3]",'NetInput4'=>"$NetInput[4]",'NetInput5'=>"$NetInput[5]",'NetInput6'=>"$NetInput[6]",'NetInput7'=>"$NetInput[7]",'NetInput8'=>"$NetInput[8]",'NetInput9'=>"$NetInput[9]",'NetInput10'=>"$NetInput[10]",'NetOutSpeed2'=>"$NetOutSpeed[2]",'NetOutSpeed3'=>"$NetOutSpeed[3]",'NetOutSpeed4'=>"$NetOutSpeed[4]",'NetOutSpeed5'=>"$NetOutSpeed[5]",'NetInputSpeed2'=>"$NetInputSpeed[2]",'NetInputSpeed3'=>"$NetInputSpeed[3]",'NetInputSpeed4'=>"$NetInputSpeed[4]",'NetInputSpeed5'=>"$NetInputSpeed[5]");
  $jarr=json_encode($arr);
  $_GET['callback'] = htmlspecialchars($_GET['callback']);
  echo $_GET['callback'],'(',$jarr,')';
  exit;
}

function session_start_timeout($timeout=5, $probability=100, $cookie_domain='/') {
  ini_set("session.gc_maxlifetime", $timeout);
  ini_set("session.cookie_lifetime", $timeout);
  $seperator = strstr(strtoupper(substr(PHP_OS, 0, 3)), "WIN") ? "\\" : "/";
  $path = ini_get("session.save_path") . $seperator . "session_" . $timeout . "sec";
  if(!file_exists($path)) {
    if(!mkdir($path, 600)) {
      trigger_error("Failed to create session save path directory '$path'. Check permissions.", E_USER_ERROR);
    }
  }
  ini_set("session.save_path", $path);
  ini_set("session.gc_probability", $probability);
  ini_set("session.gc_divisor", 100);
  session_start();
  if(isset($_COOKIE[session_name()])) {
    setcookie(session_name(), $_COOKIE[session_name()], time() + $timeout, $cookie_domain);
  }
}

session_start_timeout(5);
$MSGFILE = session_id();

function processes($username) {
    $userRunning = shell_exec("ps -fu $username");
    return $userRunning;
  }

function processExists($processName, $userRunning) {
    $exists= false;
    if (stripos($userRunning, $processName) !==false) {
      $exists = true;
    }
    return $exists;
  }
function processExistsOther($processName, $username) {
  $exists= false;
  exec("ps -fu $username | grep -iE $processName | grep -v grep", $pids);  
  if (count($pids) > 0) {
    $exists = true;
  }
  return $exists;
}

$userRunning = processes($username);
$bazarr = processExists("bazarr",$userRunning);
$btsync = processExistsOther("resilio-sync","rslsync");
$deluged = processExists("deluged",$userRunning);
$delugedweb = processExists("deluge-web",$userRunning);
$emby = processExistsOther("EmbyServer","emby");
$filebrowser = processExists("filebrowser",$userRunning);
$flood = processExists("flood",$userRunning);
$headphones = processExists("headphones",$userRunning);
$irssi = processExists("irssi",$userRunning);
$lidarr = processExists("lidarr",$userRunning);
$lounge = processExistsOther("lounge","lounge");
$nzbget = processExists("nzbget",$userRunning);
$nzbhydra = processExists("nzbhydra",$userRunning);
$ombi = processExists("ombi",$userRunning);
$plex = processExists("Plex","plex");
$tautulli = processExistsOther("Tautulli","tautulli");
$pyload = processExists("pyload",$userRunning);
$radarr = processExists("radarr",$userRunning);
$rtorrent = processExists("rtorrent",$userRunning);
$sabnzbd = processExists("sabnzbd",$userRunning);
$sickchill = processExists("sickchill",$userRunning);
$medusa = processExists("medusa",$userRunning);
$netdata = processExistsOther("netdata","netdata");
$sonarr = processExists("nzbdrone",$userRunning);
$subsonic = processExists("subsonic",$userRunning);
$syncthing = processExists("syncthing",$userRunning);
$jackett = processExists("jackett",$userRunning);
$couchpotato = processExists("couchpotato",$userRunning);
$quassel = processExists("quassel",$userRunning);
$shellinabox = processExistsOther("shellinabox","shellinabox");
$csf = processExistsOther("lfd","root");
$sickgear = processExists("sickgear",$userRunning);
$znc = processExists("znc",$userRunning);

$rclone = processExists("rclone",$username);
$plexdrive = processExists("plexdrive",$username);
$webmin = processExists("webmin",$username);

function isEnabled($process, $username){
  $service = $process;
  if(file_exists('/etc/systemd/system/multi-user.target.wants/'.$process.'@'.$username.'.service') || file_exists('/etc/systemd/system/multi-user.target.wants/'.$process.'.service')){
    return " <div class=\"toggle-wrapper text-center\"> <div class=\"toggle-en toggle-light primary\" onclick=\"location.href='?id=77&servicedisable=$service'\"></div></div>";
  } else {
    return " <div class=\"toggle-wrapper text-center\"> <div class=\"toggle-dis toggle-light primary\" onclick=\"location.href='?id=66&serviceenable=$service'\"></div></div>";
  }
}

function isEnabled2($process){
  $service = $process;
  $estado = trim( shell_exec("systemctl is-active $process") );
  if($estado=="active"){
    return " <div class=\"toggle-wrapper text-center\"> <div class=\"toggle-en toggle-light primary\" onclick=\"location.href='?id=77&servicedisable=$service'\"></div></div>";
  } else {
    return " <div class=\"toggle-wrapper text-center\"> <div class=\"toggle-dis toggle-light primary\" onclick=\"location.href='?id=66&serviceenable=$service'\"></div></div>";
  }
}

if(file_exists('/srv/panel/custom/url.override.php')){
  // BEGIN CUSTOM URL OVERRIDES //
  include ($_SERVER['DOCUMENT_ROOT'].'/custom/url.override.php');
  // END CUSTOM URL OVERRIDES ////
} else {
  $organizrURL = "https://" . $_SERVER['HTTP_HOST'] . "/organizr";
  $transmissionURL = "https://" . $_SERVER['HTTP_HOST'] . "/transmission/web/";
  $librespeedURL = "https://" . $_SERVER['HTTP_HOST'] . "/librespeed";
  $jellyfinURL = "https://" . $_SERVER['HTTP_HOST'] . "/jellyfin";
  $webminURL = "https://" . $_SERVER['HTTP_HOST'] . "/webmin";
  $bazarrURL = "https://" . $_SERVER['HTTP_HOST'] . "/bazarr";
  $btsyncURL = "http://" . $_SERVER['HTTP_HOST'] . ":8888/gui/";
  $cpURL = "https://" . $_SERVER['HTTP_HOST'] . "/couchpotato";
  $csfURL = "https://" . $_SERVER['HTTP_HOST'] . ":3443";
  $dwURL = "https://" . $_SERVER['HTTP_HOST'] . "/deluge/";
  $embyURL = "https://" . $_SERVER['HTTP_HOST'] . "/emby";
  $filebrowserURL = "https://" . $_SERVER['HTTP_HOST'] . "/filebrowser";
  $floodURL = "https://" . $_SERVER['HTTP_HOST'] . "/flood/";
  $headphonesURL = "https://" . $_SERVER['HTTP_HOST'] . "/headphones/home";
  $jackettURL = "https://" . $_SERVER['HTTP_HOST'] . "/jackett/";
  $loungeURL = "https://" . $_SERVER['HTTP_HOST'] . "/irc";
  $medusaURL = "https://" . $_SERVER['HTTP_HOST'] . "/medusa";
  $netdataURL = "https://" . $_SERVER['HTTP_HOST'] . "/netdata/";
  $nextcloudURL = "https://" . $_SERVER['HTTP_HOST'] . "/nextcloud";
  $nzbgetURL = "https://" . $_SERVER['HTTP_HOST'] . "/nzbget";
  $nzbhydraURL = "https://" . $_SERVER['HTTP_HOST'] . "/nzbhydra";
  //$plexURL = "https://" . $_SERVER['HTTP_HOST'] . ":32400/web/";
  $plexURL = "https://app.plex.tv/desktop";
  $tautulliURL = "https://" . $_SERVER['HTTP_HOST'] . "/tautulli";
  $ombiURL = "https://" . $_SERVER['HTTP_HOST'] . "/ombi";
  $pyloadURL = "https://" . $_SERVER['HTTP_HOST'] . "/pyload/login";
  $radarrURL = "https://" . $_SERVER['HTTP_HOST'] . "/radarr";
  $rapidleechURL = "https://" . $_SERVER['HTTP_HOST'] . "/rapidleech";
  $rutorrentURL = "https://" . $_SERVER['HTTP_HOST'] . "/rutorrent";
  $sabnzbdURL = "https://" . $_SERVER['HTTP_HOST'] . "/sabnzbd";
  $sickgearURL = "https://" . $_SERVER['HTTP_HOST'] . "/sickgear";
  $sickchillURL = "https://" . $_SERVER['HTTP_HOST'] . "/sickchill";
  $sonarrURL = "https://" . $_SERVER['HTTP_HOST'] . "/sonarr";
  $subsonicURL = "https://" . $_SERVER['HTTP_HOST'] . "/subsonic";
  $syncthingURL = "https://" . $_SERVER['HTTP_HOST'] . "/syncthing/";
  $lidarrURL = "https://" . $_SERVER['HTTP_HOST'] . "/lidarr";
  if ($zssl == "true") { $zncURL = "https://" . $_SERVER['HTTP_HOST'] . ":$zport"; }
  if ($zssl == "false") { $zncURL = "http://" . $_SERVER['HTTP_HOST'] . ":$zport"; }
 }
 
include ($_SERVER['DOCUMENT_ROOT'].'/widgets/lang_select.php');
include ($_SERVER['DOCUMENT_ROOT'].'/widgets/plugin_data.php');
include ($_SERVER['DOCUMENT_ROOT'].'/widgets/package_data.php');
include ($_SERVER['DOCUMENT_ROOT'].'/widgets/sys_data.php');
include ($_SERVER['DOCUMENT_ROOT'].'/widgets/theme_select.php');
$base = 1024;
$location = "/home";

/* check for services */
switch (intval($_GET['id'])) {
case 0:
  $webmin = isEnabled2("webmin");
    $cbodywmin .= $webmin;
  $rclone = isEnabled("rclone", $username);
    $cbodyrclone .= $rclone;
  $plexdrive = isEnabled("plexdrive", $username);
    $cbodyplexdrive .= $plexdrive;
  $rtorrent = isEnabled("rtorrent", $username);
    $cbodyr .= $rtorrent;
  $irssi = isEnabled("irssi", $username);
    $cbodyi .= $irssi;
  $deluged = isEnabled("deluged", $username);
    $cbodyd .= $deluged;
  $delugedweb = isEnabled("deluge-web", $username);
    $cbodydw .= $delugedweb;
  $shellinabox = isEnabled("shellinabox",shellinabox);
    $wcbodyb .= $shellinabox;
  $bazarr = isEnabled("bazarr",$username);
    $cbodybaz .= $bazarr;
  $btsync = isEnabled("resilio-sync",rslsync);
    $cbodyb .= $btsync;
  $couchpotato = isEnabled("couchpotato", $username);
    $cbodycp .= $couchpotato;
  $emby = isEnabled("emby-server", $username);
    $cbodye .= $emby;
  $filebrowser = isEnabled("filebrowser", $username);
    $cbodyfileb .= $filebrowser;
  $flood = isEnabled("flood", $username);
    $cbodyf .= $flood;
  $headphones = isEnabled("headphones", $username);
    $cbodyhp .= $headphones;
  $jackett = isEnabled("jackett", $username);
    $cbodyj .= $jackett;
  $lidarr = isEnabled("lidarr", $username);
    $cbodylidarr .= $lidarr;
  $lounge = isEnabled("lounge", lounge);
    $cbodylounge .= $lounge;
  $medusa = isEnabled("medusa", $username);
    $cbodymed .= $medusa;
  $netdata = isEnabled("netdata", netdata);
    $cbodynet .= $netdata;
  $nzbget = isEnabled("nzbget", $username);
    $cbodynzg .= $nzbget;
  $nzbhydra = isEnabled("nzbhydra", $username);
    $cbodynzb .= $nzbhydra;
  $ombi = isEnabled("ombi", $username);
    $cbodypr .= $ombi;
  $plex = isEnabled("plexmediaserver",plex);
    $cbodyp .= $plex;
  $tautulli = isEnabled("tautulli",tautulli);
    $cbodypp .= $tautulli;
  $pyload = isEnabled("pyload", $username);
    $cbodypl .= $pyload;
  $quassel = isEnabled("quassel", $username);
    $cbodyq .= $quassel;
  $radarr = isEnabled("radarr", $username);
    $cbodyrad .= $radarr;
  $rapidleech = isEnabled("rapidleech", $username);
    $cbodyrl .= $rapidleech;
  $sabnzbd = isEnabled("sabnzbd", $username);
    $cbodysz .= $sabnzbd;
  $sickgear = isEnabled("sickgear", $username);
    $cbodysg .= $sickgear;
  $sickchill = isEnabled("sickchill", $username);
    $cbodysr .= $sickchill;
  $sonarr = isEnabled("sonarr", $username);
    $cbodys .= $sonarr;
  $subsonic = isEnabled("subsonic", root);
    $cbodyss .= $subsonic;
  $syncthing = isEnabled("syncthing", $username);
    $cbodyst .= $syncthing;
  $x2go = isEnabled("x2go", $username);
    $cbodyx .= $x2go;
  $znc = isEnabled("znc", $username);
    $cbodyz .= $znc;

break;

/* enable & start services */
case 66:
  $process = $_GET['serviceenable'];
 if ($process == "filebrowser"){
      shell_exec("sudo systemctl enable $process");
      shell_exec("sudo systemctl start $process");
    } elseif ($process == "resilio-sync"){
      shell_exec("sudo systemctl enable $process");
      shell_exec("sudo systemctl start $process");
    } elseif ($process == "shellinabox"){
      shell_exec("sudo systemctl enable $process");
      shell_exec("sudo systemctl start $process");
    } elseif ($process == "emby-server"){
      shell_exec("sudo systemctl enable $process");
      shell_exec("sudo systemctl start $process");
    } elseif ($process == "headphones"){
      shell_exec("sudo systemctl enable $process");
      shell_exec("sudo systemctl start $process");
    } elseif ($process == "medusa"){
      shell_exec("sudo systemctl disable sickchill@$username");
      shell_exec("sudo systemctl stop sickchill@$username");
      shell_exec("sudo systemctl disable sickgear@$username");
      shell_exec("sudo systemctl stop sickgear@$username");
      shell_exec("sudo systemctl enable $process@$username");
      shell_exec("sudo systemctl start $process@$username");
    } elseif ($process == "netdata"){
      shell_exec("sudo systemctl enable $process");
      shell_exec("sudo systemctl start $process");
    } elseif ($process == "nzbget"){
      shell_exec("sudo systemctl enable $process@$username");
      shell_exec("sudo systemctl start $process@$username");
    } elseif ($process == "plexmediaserver"){
      shell_exec("sudo systemctl enable $process");
      shell_exec("sudo systemctl start $process");
    } elseif ($process == "tautulli"){
      shell_exec("sudo systemctl enable $process");
      shell_exec("sudo systemctl start $process");
    } elseif ($process == "ombi"){
      shell_exec("sudo systemctl enable $process");
      shell_exec("sudo systemctl start $process");
    } elseif ($process == "radarr"){
      shell_exec("sudo systemctl enable $process");
      shell_exec("sudo systemctl start $process");
    } elseif ($process == "sickgear"){
      shell_exec("sudo systemctl disable medusa@$username");
      shell_exec("sudo systemctl stop medusa@$username");
      shell_exec("sudo systemctl disable sickchill@$username");
      shell_exec("sudo systemctl stop sickchill@$username");
      shell_exec("sudo systemctl enable $process@$username");
      shell_exec("sudo systemctl start $process@$username");
    } elseif ($process == "sickchill"){
      shell_exec("sudo systemctl disable medusa@$username");
      shell_exec("sudo systemctl stop medusa@$username");
      shell_exec("sudo systemctl disable sickgear@$username");
      shell_exec("sudo systemctl stop sickgear@$username");
      shell_exec("sudo systemctl enable $process@$username");
      shell_exec("sudo systemctl start $process@$username");
    } elseif ($process == "webmin"){
      shell_exec("sudo systemctl enable $process");
      shell_exec("sudo systemctl start $process");
    } elseif ($process == "subsonic"){
      shell_exec("sudo systemctl enable $process");
      shell_exec("sudo systemctl start $process");
    } else {
      shell_exec("sudo systemctl enable $process@$username");
      shell_exec("sudo systemctl start $process@$username");
    }
  header('Location: https://' . $_SERVER['HTTP_HOST'] . '/');
break;

/* disable & stop services */
case 77:
  $process = $_GET['servicedisable'];
  if ($process == "filebrowser"){
      shell_exec("sudo systemctl stop $process");
      shell_exec("sudo systemctl disable $process");
    } elseif ($process == "resilio-sync"){
      shell_exec("sudo systemctl stop $process");
      shell_exec("sudo systemctl disable $process");
    } elseif ($process == "shellinabox"){
      shell_exec("sudo systemctl stop $process");
      shell_exec("sudo systemctl disable $process");
    } elseif ($process == "emby-server"){
      shell_exec("sudo systemctl stop $process");
      shell_exec("sudo systemctl disable $process");
    } elseif ($process == "headphones"){
      shell_exec("sudo systemctl stop $process");
      shell_exec("sudo systemctl disable $process");
    } elseif ($process == "lounge"){
      shell_exec("sudo systemctl stop $process");
      shell_exec("sudo systemctl disable $process");
    } elseif ($process == "netdata"){
      shell_exec("sudo systemctl stop $process");
      shell_exec("sudo systemctl disable $process");
    } elseif ($process == "plexmediaserver"){
      shell_exec("sudo systemctl stop $process");
      shell_exec("sudo systemctl disable $process");
    } elseif ($process == "tautulli"){
      shell_exec("sudo systemctl stop $process");
      shell_exec("sudo systemctl disable $process");
    } elseif ($process == "ombi"){
      shell_exec("sudo systemctl stop $process");
      shell_exec("sudo systemctl disable $process");
    } elseif ($process == "radarr"){
      shell_exec("sudo systemctl stop $process");
      shell_exec("sudo systemctl disable $process");
    } elseif ($process == "subsonic"){
      shell_exec("sudo systemctl stop $process");
      shell_exec("sudo systemctl disable $process");
    } elseif ($process == "webmin"){
      shell_exec("sudo systemctl stop $process");
      shell_exec("sudo systemctl disable $process");
    } else {
      shell_exec("sudo systemctl stop $process@$username");
      shell_exec("sudo systemctl disable $process@$username");
    }
  header('Location: https://' . $_SERVER['HTTP_HOST'] . '/');
break;

/* restart services */
case 88:
  $process = $_GET['servicestart'];
  if ($process == "filebrowser"){
      shell_exec("sudo systemctl enable $process");
      shell_exec("sudo systemctl restart $process");
    } elseif ($process == "resilio-sync"){
      shell_exec("sudo systemctl enable $process");
      shell_exec("sudo systemctl restart $process");
    } elseif ($process == "shellinabox"){
      shell_exec("sudo systemctl enable $process");
      shell_exec("sudo systemctl restart $process");
    } elseif ($process == "emby-server"){
      shell_exec("sudo systemctl enable $process");
      shell_exec("sudo systemctl restart $process");
    } elseif ($process == "headphones"){
      shell_exec("sudo systemctl enable $process");
      shell_exec("sudo systemctl restart $process");
    } elseif ($process == "lounge"){
      shell_exec("sudo systemctl enable $process");
      shell_exec("sudo systemctl restart $process");
    } elseif ($process == "netdata"){
      shell_exec("sudo systemctl enable $process");
      shell_exec("sudo systemctl restart $process");
    } elseif ($process == "plexmediaserver"){
      shell_exec("sudo systemctl enable $process");
      shell_exec("sudo systemctl restart $process");
    } elseif ($process == "tautulli"){
      shell_exec("sudo systemctl enable $process");
      shell_exec("sudo systemctl restart $process");
    } elseif ($process == "ombi"){
      shell_exec("sudo systemctl enable $process");
      shell_exec("sudo systemctl restart $process");
    } elseif ($process == "radarr"){
      shell_exec("sudo systemctl enable $process");
      shell_exec("sudo systemctl restart $process");
    } elseif ($process == "subsonic"){
      shell_exec("sudo systemctl enable $process");
      shell_exec("sudo systemctl restart $process");
    } elseif ($process == "webmin"){
      shell_exec("sudo systemctl enable $process");
      shell_exec("sudo systemctl restart $process");
    } elseif ($process == "plexdrive"){
      shell_exec("sudo /bin/fusermount -u /home/$username/NUBE/PLEXDRIVE");
      shell_exec("sleep 3");
      shell_exec("sudo systemctl restart $process@$username");
    } else {
      shell_exec("sudo systemctl restart $process@$username");
    }
  header('Location: https://' . $_SERVER['HTTP_HOST'] . '/');
break;

}

?>
