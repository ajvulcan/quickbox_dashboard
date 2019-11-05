$(document).ready(function() {
 //Arranca todo
  appstat_btsync();
  appstat_couchpotato();
  appstat_deluged();
  appstat_delugeweb();
  appstat_emby();
  appstat_flood();
  appstat_headphones();
  appstat_irssi();
  appstat_jackett();
  appstat_lounge();
  appstat_medusa();
  appstat_netdata();
  appstat_nextcloud();
  appstat_nzbget();
  appstat_nzbhydra();
  appstat_ombi();
  appstat_openvpn();
  appstat_plex();
  appstat_tautulli();
  appstat_pyload();
  appstat_quassel();
  appstat_radarr();
  //appstat_rapidleech();
  appstat_rtorrent();
  appstat_sabnzbd();
  appstat_sickgear();
  appstat_sickchill();
  appstat_sonarr();
  appstat_subsonic();
  appstat_syncthing();
  appstat_webconsole();
  appstat_x2go();
  appstat_znc();
  appstat_bazarr();
  appstat_lidarr();
  appstat_filebrowser();
  appstat_webmin();
  appstat_rclone();
  appstat_plexdrive();
  uptime();
  sload();
  bwtables();
  diskstats();
  ramstats();
  //activefeed();
  msgoutput();
});


  /////////////////////////////////////////////
  // BEGIN AJAX APP CALLS ON SERVICE STATUS //
  ///////////////////////////////////////////

 // <<-------- BAZARR -------->> //
  function appstat_bazarr() {
    $.ajax({url: "widgets/app_status/app_status_bazarr.php", cache:false, success: function (result) {
      $('#appstat_bazarr').html(result);
       if(!GLOBAL.update_hold){ setTimeout(function(){appstat_bazarr()}, 5000); };
    }});
  }

   // <<-------- LIDARR -------->> //
  function appstat_lidarr() {
    $.ajax({url: "widgets/app_status/app_status_lidarr.php", cache:false, success: function (result) {
      $('#appstat_lidarr').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_lidarr()}, 5000); }
    }});
  }

  // <<-------- BTSYNC -------->> //
  function appstat_btsync() {
    $.ajax({url: "widgets/app_status/app_status_btsync.php", cache:false, success: function (result) {
      $('#appstat_btsync').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_btsync()}, 5000); };
    }});
  }


  // <<-------- COUCHPOTATO -------->> //
  function appstat_couchpotato() {
    $.ajax({url: "widgets/app_status/app_status_couchpotato.php", cache:false, success: function (result) {
      $('#appstat_couchpotato').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_couchpotato()}, 5000); };
    }});
  }


  // <<-------- DELUGED -------->> //
  function appstat_deluged() {
    $.ajax({url: "widgets/app_status/app_status_deluged.php", cache:false, success: function (result) {
      $('#appstat_deluged').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_deluged()}, 5000); };
    }});
  }


  // <<-------- DELUGE WEB -------->> //
  function appstat_delugeweb() {
    $.ajax({url: "widgets/app_status/app_status_delugeweb.php", cache:false, success: function (result) {
      $('#appstat_delugeweb').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_delugeweb()}, 5000); };
    }});
  }


  // <<-------- EMBY -------->> //
  function appstat_emby() {
    $.ajax({url: "widgets/app_status/app_status_emby.php", cache:false, success: function (result) {
      $('#appstat_emby').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_emby()}, 5000); };
    }});
  }


  // <<-------- FLOOD -------->> //
  function appstat_flood() {
    $.ajax({url: "widgets/app_status/app_status_flood.php", cache:false, success: function (result) {
      $('#appstat_flood').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_flood()}, 5000); };
    }});
  }

  // <<-------- FILEBROWSER -------->> //
  function appstat_filebrowser() {
    $.ajax({url: "widgets/app_status/app_status_filebrowser.php", cache:false, success: function (result) {
      $('#appstat_filebrowser').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_filebrowser()}, 5000); };
    }});
  }

  // <<-------- WEBMIN -------->> //
  function appstat_webmin() {
    $.ajax({url: "widgets/app_status/app_status_webmin.php", cache:false, success: function (result) {
      $('#appstat_webmin').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_webmin()}, 5000); };
    }});
  }

  // <<-------- HEADPHONES -------->> //
  function appstat_headphones() {
    $.ajax({url: "widgets/app_status/app_status_headphones.php", cache:false, success: function (result) {
      $('#appstat_headphones').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_headphones()}, 5000); };
    }});
  }


  // <<-------- IRSSI -------->> //
  function appstat_irssi() {
    $.ajax({url: "widgets/app_status/app_status_irssi.php", cache:false, success: function (result) {
      $('#appstat_irssi').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_irssi()}, 5000); };
    }});
  }

  // <<-------- RCLONE -------->> //
  function appstat_rclone() {
    $.ajax({url: "widgets/app_status/app_status_rclone.php", cache:false, success: function (result) {
      $('#appstat_rclone').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_rclone()}, 5000); };
    }});
  }

  // <<-------- PLEXDRIVE -------->> //
  function appstat_plexdrive() {
    $.ajax({url: "widgets/app_status/app_status_plexdrive.php", cache:false, success: function (result) {
      $('#appstat_plexdrive').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_plexdrive()}, 5000); };
    }});
  }

  // <<-------- JACKETT -------->> //
  function appstat_jackett() {
    $.ajax({url: "widgets/app_status/app_status_jackett.php", cache:false, success: function (result) {
      $('#appstat_jackett').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_jackett()}, 5000); };
    }});
  }

  // <<-------- THE LOUNGE -------->> //
  function appstat_lounge() {
    $.ajax({url: "widgets/app_status/app_status_lounge.php", cache:false, success: function (result) {
      $('#appstat_lounge').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_lounge()}, 5000); };
    }});
  }


  // <<-------- MEDUSA -------->> //
  function appstat_medusa() {
    $.ajax({url: "widgets/app_status/app_status_medusa.php", cache:false, success: function (result) {
      $('#appstat_medusa').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_medusa()}, 5000); };
    }});
  }


  // <<-------- NETDATA -------->> //
  function appstat_netdata() {
    $.ajax({url: "widgets/app_status/app_status_netdata.php", cache:false, success: function (result) {
      $('#appstat_netdata').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_netdata()}, 5000); };
    }});
  }


  // <<-------- NEXTCLOUD -------->> //
  function appstat_nextcloud() {
    $.ajax({url: "widgets/app_status/app_status_nextcloud.php", cache:false, success: function (result) {
      $('#appstat_nextcloud').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_nextcloud()}, 5000); };
    }});
  }


  // <<-------- NZBGET -------->> //
  function appstat_nzbget() {
    $.ajax({url: "widgets/app_status/app_status_nzbget.php", cache:false, success: function (result) {
      $('#appstat_nzbget').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_nzbget()}, 5000); };
    }});
  }


  // <<-------- NZBHYDRA -------->> //
  function appstat_nzbhydra() {
    $.ajax({url: "widgets/app_status/app_status_nzbhydra.php", cache:false, success: function (result) {
      $('#appstat_nzbhydra').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_nzbhydra()}, 5000); };
    }});
  }


  // <<-------- OMBI -------->> //
  function appstat_ombi() {
    $.ajax({url: "widgets/app_status/app_status_ombi.php", cache:false, success: function (result) {
      $('#appstat_ombi').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_ombi()}, 5000); };
    }});
  }


  // <<-------- OPENVPN -------->> //
  function appstat_openvpn() {
    $.ajax({url: "widgets/app_status/app_status_openvpn.php", cache:false, success: function (result) {
      $('#appstat_openvpn').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_openvpn()}, 5000); };
    }});
  }


  // <<-------- PLEX -------->> //
  function appstat_plex() {
    $.ajax({url: "widgets/app_status/app_status_plex.php", cache:false, success: function (result) {
      $('#appstat_plex').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_plex()}, 5000); };
    }});
  }


  // <<-------- TAUTULLI -------->> //
  function appstat_tautulli() {
    $.ajax({url: "widgets/app_status/app_status_tautulli.php", cache:false, success: function (result) {
      $('#appstat_tautulli').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_tautulli()}, 5000); };
    }});
  }


  // <<-------- PYLOAD -------->> //
  function appstat_pyload() {
    $.ajax({url: "widgets/app_status/app_status_pyload.php", cache:false, success: function (result) {
      $('#appstat_pyload').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_pyload()}, 5000); };
    }});
  }


  // <<-------- QUASSEL -------->> //
  function appstat_quassel() {
    $.ajax({url: "widgets/app_status/app_status_quassel.php", cache:false, success: function (result) {
      $('#appstat_quassel').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_quassel()}, 5000); };
    }});
  }


  // <<-------- RADARR -------->> //
  function appstat_radarr() {
    $.ajax({url: "widgets/app_status/app_status_radarr.php", cache:false, success: function (result) {
      $('#appstat_radarr').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_radarr()}, 5000); };
    }});
  }


  // <<-------- RAPIDLEECH -------->> //
/*  function appstat_rapidleech() {
    $.ajax({url: "widgets/app_status/app_status_rapidleech.php", cache:false, success: function (result) {
      $('#appstat_rapidleech').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_rapidleech()}, 5000); };
    }});
  }
*/


  // <<-------- RTORRENT -------->> //
  function appstat_rtorrent() {
    $.ajax({url: "widgets/app_status/app_status_rtorrent.php", cache:false, success: function (result) {
      $('#appstat_rtorrent').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_rtorrent()}, 5000); };
    }});
  }


  // <<-------- SABNZBD -------->> //
  function appstat_sabnzbd() {
    $.ajax({url: "widgets/app_status/app_status_sabnzbd.php", cache:false, success: function (result) {
      $('#appstat_sabnzbd').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_sabnzbd()}, 5000); };
    }});
  }


  // <<-------- SICKGEAR -------->> //
  function appstat_sickgear() {
    $.ajax({url: "widgets/app_status/app_status_sickgear.php", cache:false, success: function (result) {
      $('#appstat_sickgear').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_sickgear()}, 5000); };
    }});
  }


  // <<-------- sickchill -------->> //
  function appstat_sickchill() {
    $.ajax({url: "widgets/app_status/app_status_sickchill.php", cache:false, success: function (result) {
      $('#appstat_sickchill').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_sickchill()}, 5000); };
    }});
  }


  // <<-------- SONARR -------->> //
  function appstat_sonarr() {
    $.ajax({url: "widgets/app_status/app_status_sonarr.php", cache:false, success: function (result) {
      $('#appstat_sonarr').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_sonarr()}, 5000); };
    }});
  }


  // <<-------- SUBSONIC -------->> //
  function appstat_subsonic() {
    $.ajax({url: "widgets/app_status/app_status_subsonic.php", cache:false, success: function (result) {
      $('#appstat_subsonic').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_subsonic()}, 5000); };
    }});
  }


  // <<-------- SYNCTHING -------->> //
  function appstat_syncthing() {
    $.ajax({url: "widgets/app_status/app_status_syncthing.php", cache:false, success: function (result) {
      $('#appstat_syncthing').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_syncthing()}, 5000); };
    }});
  }


  // <<-------- WEB CONSOLE -------->> //
  function appstat_webconsole() {
    $.ajax({url: "widgets/app_status/app_status_webconsole.php", cache:false, success: function (result) {
      $('#appstat_webconsole').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_webconsole()}, 5000); };
    }});
  }


  // <<-------- X2GO -------->> //
  function appstat_x2go() {
    $.ajax({url: "widgets/app_status/app_status_x2go.php", cache:false, success: function (result) {
      $('#appstat_x2go').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_x2go()}, 5000); };
    }});
  }


  // <<-------- ZNC -------->> //
  function appstat_znc() {
    $.ajax({url: "widgets/app_status/app_status_znc.php", cache:false, success: function (result) {
      $('#appstat_znc').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_znc()}, 5000); };
    }});
  }

  

  ///////////////////////////////////////////
  // END AJAX APP CALLS ON SERVICE STATUS //
  /////////////////////////////////////////

  function uptime() {
    $.ajax({url: "widgets/up.php", cache:true, success: function (result) {
      $('#uptime').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){uptime()}, 1000); };
    }});
  }


  function sload() {
    $.ajax({url: "widgets/load.php", cache:true, success: function (result) {
      $('#cpuload').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){sload()}, 15000); };
    }});
  }


  function bwtables() {
    $.ajax({url: "widgets/bw_tables.php", cache:false, success: function (result) {
      $('#bw_tables').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){bwtables()}, 60000); };
    }});
  }


  function diskstats() {
    $.ajax({url: "widgets/disk_data.php", cache:false, success: function (result) {
      $('#disk_data').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){diskstats()}, 15000); };
    }});
  }


  function ramstats() {
    $.ajax({url: "widgets/ram_stats.php", cache:false, success: function (result) {
      $('#meterram').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){ramstats()}, 15000); };
    }});
  }

  function msgoutput() {
    $.ajax({url: "db/output.log", cache:false, success: function (result) {
      $('#sshoutput').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){msgoutput()}, 1000); };
    }});
    jQuery( function(){
      var pre = jQuery("#sysPre");
      pre.scrollTop( pre.prop("scrollHeight") );
    });
  }


  //success: function (result)
