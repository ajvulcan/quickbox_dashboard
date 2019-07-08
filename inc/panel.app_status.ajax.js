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
  appstat_rapidleech();
  appstat_rtorrent();
  appstat_sabnzbd();
  appstat_sickgear();
  appstat_sickrage();
  appstat_sonarr();
  appstat_subsonic();
  appstat_syncthing();
  appstat_webconsole();
  appstat_x2go();
  appstat_znc();
  uptime();
  sload();
  bwtables();
  diskstats();
  ramstats();
  //activefeed();
  msgoutput();
  appstat_bazarr();
  appstat_lidarr();

});


  /////////////////////////////////////////////
  // BEGIN AJAX APP CALLS ON SERVICE STATUS //
  ///////////////////////////////////////////

 // <<-------- BAZARR -------->> //
  function appstat_bazarr() {
    $.ajax({url: "widgets/app_status/app_status_bazarr.php", cache:true, success: function (result) {
      $('#appstat_bazarr').html(result);
       if(!GLOBAL.update_hold){ setTimeout(function(){appstat_bazarr()}, 1000); };
    }});
  }

   // <<-------- LIDARR -------->> //
  function appstat_lidarr() {
    $.ajax({url: "widgets/app_status/app_status_lidarr.php", cache:true, success: function (result) {
      $('#appstat_lidarr').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_lidarr()}, 1000); }
    }});
  }

  // <<-------- BTSYNC -------->> //
  function appstat_btsync() {
    $.ajax({url: "widgets/app_status/app_status_btsync.php", cache:true, success: function (result) {
      $('#appstat_btsync').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_btsync()}, 1000); };
    }});
  }


  // <<-------- COUCHPOTATO -------->> //
  function appstat_couchpotato() {
    $.ajax({url: "widgets/app_status/app_status_couchpotato.php", cache:true, success: function (result) {
      $('#appstat_couchpotato').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_couchpotato()}, 1000); };
    }});
  }


  // <<-------- DELUGED -------->> //
  function appstat_deluged() {
    $.ajax({url: "widgets/app_status/app_status_deluged.php", cache:true, success: function (result) {
      $('#appstat_deluged').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_deluged()}, 1000); };
    }});
  }


  // <<-------- DELUGE WEB -------->> //
  function appstat_delugeweb() {
    $.ajax({url: "widgets/app_status/app_status_delugeweb.php", cache:true, success: function (result) {
      $('#appstat_delugeweb').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_delugeweb()}, 1000); };
    }});
  }


  // <<-------- EMBY -------->> //
  function appstat_emby() {
    $.ajax({url: "widgets/app_status/app_status_emby.php", cache:true, success: function (result) {
      $('#appstat_emby').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_emby()}, 1000); };
    }});
  }


  // <<-------- FLOOD -------->> //
  function appstat_flood() {
    $.ajax({url: "widgets/app_status/app_status_flood.php", cache:true, success: function (result) {
      $('#appstat_flood').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_flood()}, 1000); };
    }});
  }


  // <<-------- HEADPHONES -------->> //
  function appstat_headphones() {
    $.ajax({url: "widgets/app_status/app_status_headphones.php", cache:true, success: function (result) {
      $('#appstat_headphones').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_headphones()}, 1000); };
    }});
  }


  // <<-------- IRSSI -------->> //
  function appstat_irssi() {
    $.ajax({url: "widgets/app_status/app_status_irssi.php", cache:true, success: function (result) {
      $('#appstat_irssi').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_irssi()}, 1000); };
    }});
  }


  // <<-------- JACKETT -------->> //
  function appstat_jackett() {
    $.ajax({url: "widgets/app_status/app_status_jackett.php", cache:true, success: function (result) {
      $('#appstat_jackett').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_jackett()}, 1000); };
    }});
  }


  // <<-------- THE LOUNGE -------->> //
  function appstat_lounge() {
    $.ajax({url: "widgets/app_status/app_status_lounge.php", cache:true, success: function (result) {
      $('#appstat_lounge').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_lounge()}, 1000); };
    }});
  }


  // <<-------- MEDUSA -------->> //
  function appstat_medusa() {
    $.ajax({url: "widgets/app_status/app_status_medusa.php", cache:true, success: function (result) {
      $('#appstat_medusa').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_medusa()}, 1000); };
    }});
  }


  // <<-------- NETDATA -------->> //
  function appstat_netdata() {
    $.ajax({url: "widgets/app_status/app_status_netdata.php", cache:true, success: function (result) {
      $('#appstat_netdata').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_netdata()}, 1000); };
    }});
  }


  // <<-------- NEXTCLOUD -------->> //
  function appstat_nextcloud() {
    $.ajax({url: "widgets/app_status/app_status_nextcloud.php", cache:true, success: function (result) {
      $('#appstat_nextcloud').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_nextcloud()}, 1000); };
    }});
  }


  // <<-------- NZBGET -------->> //
  function appstat_nzbget() {
    $.ajax({url: "widgets/app_status/app_status_nzbget.php", cache:true, success: function (result) {
      $('#appstat_nzbget').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_nzbget()}, 1000); };
    }});
  }


  // <<-------- NZBHYDRA -------->> //
  function appstat_nzbhydra() {
    $.ajax({url: "widgets/app_status/app_status_nzbhydra.php", cache:true, success: function (result) {
      $('#appstat_nzbhydra').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_nzbhydra()}, 1000); };
    }});
  }


  // <<-------- OMBI -------->> //
  function appstat_ombi() {
    $.ajax({url: "widgets/app_status/app_status_ombi.php", cache:true, success: function (result) {
      $('#appstat_ombi').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_ombi()}, 1000); };
    }});
  }


  // <<-------- OPENVPN -------->> //
  function appstat_openvpn() {
    $.ajax({url: "widgets/app_status/app_status_openvpn.php", cache:true, success: function (result) {
      $('#appstat_openvpn').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_openvpn()}, 1000); };
    }});
  }


  // <<-------- PLEX -------->> //
  function appstat_plex() {
    $.ajax({url: "widgets/app_status/app_status_plex.php", cache:true, success: function (result) {
      $('#appstat_plex').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_plex()}, 1000); };
    }});
  }


  // <<-------- TAUTULLI -------->> //
  function appstat_tautulli() {
    $.ajax({url: "widgets/app_status/app_status_tautulli.php", cache:true, success: function (result) {
      $('#appstat_tautulli').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_tautulli()}, 1000); };
    }});
  }


  // <<-------- PYLOAD -------->> //
  function appstat_pyload() {
    $.ajax({url: "widgets/app_status/app_status_pyload.php", cache:true, success: function (result) {
      $('#appstat_pyload').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_pyload()}, 1000); };
    }});
  }


  // <<-------- QUASSEL -------->> //
  function appstat_quassel() {
    $.ajax({url: "widgets/app_status/app_status_quassel.php", cache:true, success: function (result) {
      $('#appstat_quassel').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_quassel()}, 1000); };
    }});
  }


  // <<-------- RADARR -------->> //
  function appstat_radarr() {
    $.ajax({url: "widgets/app_status/app_status_radarr.php", cache:true, success: function (result) {
      $('#appstat_radarr').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_radarr()}, 1000); };
    }});
  }


  // <<-------- RAPIDLEECH -------->> //
  function appstat_rapidleech() {
    $.ajax({url: "widgets/app_status/app_status_rapidleech.php", cache:true, success: function (result) {
      $('#appstat_rapidleech').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_rapidleech()}, 1000); };
    }});
  }


  // <<-------- RTORRENT -------->> //
  function appstat_rtorrent() {
    $.ajax({url: "widgets/app_status/app_status_rtorrent.php", cache:true, success: function (result) {
      $('#appstat_rtorrent').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_rtorrent()}, 1000); };
    }});
  }


  // <<-------- SABNZBD -------->> //
  function appstat_sabnzbd() {
    $.ajax({url: "widgets/app_status/app_status_sabnzbd.php", cache:true, success: function (result) {
      $('#appstat_sabnzbd').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_sabnzbd()}, 1000); };
    }});
  }


  // <<-------- SICKGEAR -------->> //
  function appstat_sickgear() {
    $.ajax({url: "widgets/app_status/app_status_sickgear.php", cache:true, success: function (result) {
      $('#appstat_sickgear').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_sickgear()}, 1000); };
    }});
  }


  // <<-------- SICKRAGE -------->> //
  function appstat_sickrage() {
    $.ajax({url: "widgets/app_status/app_status_sickrage.php", cache:true, success: function (result) {
      $('#appstat_sickrage').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_sickrage()}, 1000); };
    }});
  }


  // <<-------- SONARR -------->> //
  function appstat_sonarr() {
    $.ajax({url: "widgets/app_status/app_status_sonarr.php", cache:true, success: function (result) {
      $('#appstat_sonarr').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_sonarr()}, 1000); };
    }});
  }


  // <<-------- SUBSONIC -------->> //
  function appstat_subsonic() {
    $.ajax({url: "widgets/app_status/app_status_subsonic.php", cache:true, success: function (result) {
      $('#appstat_subsonic').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_subsonic()}, 1000); };
    }});
  }


  // <<-------- SYNCTHING -------->> //
  function appstat_syncthing() {
    $.ajax({url: "widgets/app_status/app_status_syncthing.php", cache:true, success: function (result) {
      $('#appstat_syncthing').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_syncthing()}, 1000); };
    }});
  }


  // <<-------- WEB CONSOLE -------->> //
  function appstat_webconsole() {
    $.ajax({url: "widgets/app_status/app_status_webconsole.php", cache:true, success: function (result) {
      $('#appstat_webconsole').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_webconsole()}, 1000); };
    }});
  }


  // <<-------- X2GO -------->> //
  function appstat_x2go() {
    $.ajax({url: "widgets/app_status/app_status_x2go.php", cache:true, success: function (result) {
      $('#appstat_x2go').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_x2go()}, 1000); };
    }});
  }


  // <<-------- ZNC -------->> //
  function appstat_znc() {
    $.ajax({url: "widgets/app_status/app_status_znc.php", cache:true, success: function (result) {
      $('#appstat_znc').html(result);
      if(!GLOBAL.update_hold){ setTimeout(function(){appstat_znc()}, 1000); };
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
      if(!GLOBAL.update_hold){ setTimeout(function(){sload()}, 1000); };
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
      if(!GLOBAL.update_hold){ setTimeout(function(){ramstats()}, 1000); };
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
