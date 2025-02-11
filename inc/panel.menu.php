<?php
  $current_vs = "<span id=\"version-result\"></span>";
?>

<body class="body">
<header>
  <div class="headerpanel">
    <div class="logopanel">
      <h2><?php include("db/branding-l.php"); ?></h2>
    </div><!-- logopanel -->
    <div class="headerbar">
      <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
      <div class="header-right">
        <ul class="headermenu">
          <?php if (file_exists('/install/.developer.lock')) { ?>
          <li>
            <div class="btn-group">
              <button type="button" class="btn btn-logged">
                <a href="#" class="label label-warning" style="">You are on the QuickBox Development Repo</a>
              </button>
            </div>
          </li>
          <?php } ?>
          <?php if ($username == "$master") { ?>
          <li>
            <div id="noticePanel" class="btn-group">
              <button class="btn" data-toggle="dropdown">
                <i class="fa fa-menu"></i> Ajustes <span class="caret"></span>
              </button>
              <div id="noticeDropdown" class="dropdown-menu dm-notice pull-right">
                <div role="tabpanel">
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs nav-justified" role="tablist">
                    <li class="active"><a data-target="#idioma" data-toggle="tab">Idioma</a></li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content" style="width: 200px;">
                   <!--primer tab-->
                    <div role="tabpanel" class="tab-pane active" id="idioma">

                      <ul class="list-group">
                        <li class="list-group-item">
                          <div class="row" style="margin-left: -15px; margin-right: -15px; text-align: center;">

                              <h5><?php echo T('LANG_SELECT'); ?></h5>

                              <div class="col-xs-12" style="padding: 0;display:inline-table">
                                <?php $language = array();
                                    $language[] = array('file' => 'lang_es', 'title' =>'Spanish');
                                    $language[] = array('file' => 'lang_dk', 'title' =>'Danish');
                                    $language[] = array('file' => 'lang_en', 'title' =>'English');
                                    $language[] = array('file' => 'lang_fr', 'title' =>'French');
                                    $language[] = array('file' => 'lang_de', 'title' =>'German'); { ?>
                                
                                <?php foreach($language as $lang) { ?>
                                  <small style="display: inline-table; padding: 3px;"><a href='?langSelect-<?php echo $lang['file'] ?>=true'><img class='lang-flag' src='lang/flag_<?php echo $lang['file'] ?>.png' /><?php echo $lang['title'] ?></a></small>
                                <?php } ?>
                                <?php } ?>
                              </div>

                           </div>
                        </li>
                      </ul>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <?php } ?>
          <li>
            <div class="btn-group">
              <button type="button" class="btn btn-logged" data-toggle="dropdown">
                <?php echo "$username"; ?>
                <span class="caret"></span>
              </button>
              <?php include("db/branding-m.php"); ?>
            </div>
          </li>
        </ul>
      </div><!-- header-right -->
    </div><!-- headerbar -->
  </div><!-- header-->
</header>
<section>
  <div class="leftpanel ps-container">
  <div class="leftpanelinner">
    <?php if (file_exists('/install/.foo.lock')) { ?>
      <ul class="nav nav-tabs nav-justified nav-sidebar">
        <li class="tooltips active" data-toggle="tooltip" title="<?php echo T('MAIN_MENU'); ?>" data-placement="bottom"><a data-toggle="tab" data-target="#mainmenu"><i class="tooltips fa fa-ellipsis-h"></i></a></li>
        <?php if ($username == "$master"){ ?>
          <li class="tooltips" data-toggle="tooltip" title="<?php echo T('RPLUGIN_MENU'); ?>" data-placement="bottom"><a data-toggle="tab" data-target="#plugins"><i class="tooltips fa fa-puzzle-piece"></i></a></li>
        <?php } ?>
        <li class="tooltips" data-toggle="tooltip" title="<?php echo T('HELP_COMMANDS'); ?>" data-placement="bottom"><a data-toggle="tab" data-target="#help"><i class="tooltips fa fa-question-circle"></i></a></li>
      </ul>
      <?php } ?>
      <div class="tab-content">
        <!-- ################# MAIN MENU ################### -->
        <div class="tab-pane active" id="mainmenu">
          <h5 class="sidebar-title"><?php echo T('MAIN_MENU'); ?></h5>
          <ul class="nav nav-pills nav-stacked nav-quirk">
            <li class="grayscale"><a href="javascript:void(0)" onclick="inicio()"><i class="fa fa-home"></i> <span>Inicio</span></a></li>
            <?php if (file_exists('/install/.rutorrent.lock')) { ?>
              <li><a class="grayscale" href="<?php echo "$rutorrentURL"; ?>" target="iFrame" onclick="abre_frame(true)"><img src="img/brands/rtorrent.png" class="brand-ico"> <span>ruTorrent</span></a></li>
            <?php } ?>
            <?php if (processExists("flood",$userRunning) && file_exists('/install/.flood.lock')) { ?>
              <li><a class="grayscale" href="<?php echo "$floodURL"; ?>" target="iFrame" onclick="abre_frame(false)"><img src="img/brands/flood.png" class="brand-ico"> <span>Flood</span></a></li>
            <?php } ?>
            <?php if (processExists("deluge-web",$userRunning) && file_exists('/install/.deluge.lock')) { ?>
              <li><a class="grayscale" href="<?php echo "$dwURL"; ?>" target="iFrame" onclick="abre_frame(false)"><img src="img/brands/deluge.png" class="brand-ico"> <span>Deluge Web</span></a></li>
            <?php } ?>
            <?php if (file_exists('/install/.transmission.lock')) { ?>
              <li><a class="grayscale" href="<?php echo "$transmissionURL"; ?>" target="iFrame" onclick="abre_frame(false)"><img src="img\brands\transmission.png" class="brand-ico"> <span>Transmission</span></a></li>
            <?php } ?>
            <?php if (file_exists('/install/.emby.lock')) { ?>
                <li><a class="grayscale" href="<?php echo "$embyURL"; ?>" target="iFrame" onclick="abre_frame(true)"><img src="img/brands/emby.png" class="brand-ico"> <span>Emby</span></a></li>
            <?php } ?>
            <?php if (file_exists('/install/.plex.lock')) { ?>
                <li><a class="grayscale" href="<?php echo "$plexURL"; ?>" target="_self" onclick="abre_frame(true)"><img src="img/brands/plex.png" class="brand-ico"> <span>Plex</span></a></li>
              <?php } ?>
              <?php if (file_exists('/install/.jellyfin.lock')) { ?>
              <li><a class="grayscale" href="<?php echo "$jellyfinURL"; ?>" target="iFrame" onclick="abre_frame(false)"><img src="img\brands\jellyfin.png" class="brand-ico"> <span>Jellyfin</span></a></li>
            <?php } ?>
            <?php if (file_exists('/install/.nzbget.lock')) { ?>
                <li><a class="grayscale" href="<?php echo "$nzbgetURL"; ?>" target="iFrame" onclick="abre_frame(false)"><img src="img/brands/nzbget.png" class="brand-ico"> <span>NZBGet</span></a></li>
            <?php } ?>
            <?php if (processExistsOther("lounge","lounge") && file_exists('/install/.lounge.lock')) { ?>
              <li><a class="grayscale" href="<?php echo "$loungeURL"; ?>" target="iFrame" onclick="abre_frame(false)"><img src="img/brands/lounge.svg" class="brand-ico"> <span>The Lounge</span></a></li>
            <?php } ?>
            <?php if (file_exists('/install/.filebrowser.lock')) { ?>
                <li><a class="grayscale" href="<?php echo "$filebrowserURL"; ?>" target="iFrame" onclick="abre_frame(false)"><img src="img/brands/filebrowser.png" class="brand-ico"> <span>Filebrowser</span></a></li>
              <?php } ?>

            <?php if ($username == "$master") { ?>  
              <?php if (file_exists('/install/.organizr.lock')) { ?>
                <li><a class="grayscale" href="<?php echo "$organizrURL"; ?>" target="iFrame" onclick="abre_frame(false)"><img src="img\brands\organizr.png" class="brand-ico"> <span>Organizr</span></a></li>
              <?php } ?>
              <?php if (file_exists('/install/.librespeed.lock')) { ?>
                <li><a class="grayscale" href="<?php echo "$librespeedURL"; ?>" target="iFrame" onclick="abre_frame(false)"><img src="img\brands\librespeed.png" class="brand-ico"> <span>LibreSpeed</span></a></li>
              <?php } ?>            
              <?php if (processExistsOther("resilio-sync","rslsync") && file_exists('/install/.btsync.lock')) { ?>
                <li><a class="grayscale" href="<?php echo "$btsyncURL"; ?>" target="iFrame" onclick="abre_frame(false)"><img src="img/brands/btsync.png" class="brand-ico"> <span>BTSync</span></a></li>
              <?php } ?>
              <?php if (file_exists('/install/.bazarr.lock')) { ?>
                <li><a class="grayscale" href="<?php echo "$bazarrURL"; ?>" target="iFrame" onclick="abre_frame(false)"><img src="img/brands/bazarr.png" class="brand-ico"> <span>Bazarr</span></a></li>
              <?php } ?>
              <?php if (file_exists('/install/.couchpotato.lock')) { ?>
                <li><a class="grayscale" href="<?php echo "$cpURL"; ?>" target="iFrame" onclick="abre_frame(false)"><img src="img/brands/couchpotato.png" class="brand-ico"> <span>CouchPotato</span></a></li>
              <?php } ?>
              <?php if (file_exists('/install/.csf.lock')) { ?>
                <li><a class="grayscale" href="<?php echo "$csfURL"; ?>" target="iFrame" onclick="abre_frame(false)"><img src="img/brands/csf.png" class="brand-ico"> <span>CSF (firewall)</span></a></li>
              <?php } ?>
              <?php if (file_exists('/install/.headphones.lock')) { ?>
                <li><a class="grayscale" href="<?php echo "$headphonesURL"; ?>" target="iFrame" onclick="abre_frame(false)"><img src="img/brands/headphones.png" class="brand-ico"> <span>Headphones</span></a></li>
              <?php } ?>
              <?php if (file_exists('/install/.jackett.lock')) { ?>
                <li><a class="grayscale" href="<?php echo "$jackettURL"; ?>" target="iFrame" onclick="abre_frame(false)"><img src="img/brands/jackett.png" class="brand-ico"> <span>Jackett</span></a></li>
              <?php } ?>
              <?php if (file_exists('/install/.lidarr.lock')) { ?>
                <li><a class="grayscale" href="<?php echo "$lidarrURL"; ?>" target="iFrame" onclick="abre_frame(false)"><img src="img/brands/lidarr.png" class="brand-ico"> <span>Lidarr</span></a></li>
              <?php } ?>
              <?php if (processExists("medusa",$userRunning) && file_exists('/install/.medusa.lock')) { ?>
                <li><a class="grayscale" href="<?php echo "$medusaURL"; ?>" target="iFrame" onclick="abre_frame(false)"><img src="img/brands/medusa.png" class="brand-ico"> <span>Medusa</span></a></li>
              <?php } ?>
              <?php if (file_exists('/install/.nextcloud.lock')) { ?>
                <li><a class="grayscale" href="<?php echo "$nextcloudURL"; ?>" target="iFrame" onclick="abre_frame(false)"><img src="img/brands/nextcloud.png" class="brand-ico"> <span>NextCloud</span></a></li>
              <?php } ?>
              <?php if (file_exists('/install/.nzbhydra.lock')) { ?>
                <li><a class="grayscale" href="<?php echo "$nzbhydraURL"; ?>" target="iFrame" onclick="abre_frame(false)"><img src="img/brands/nzbhydra.png" class="brand-ico"> <span>NZBHydra</span></a></li>
              <?php } ?>             
              <?php if (file_exists("/install/.tautulli.lock")) { ?>
                <li><a class="grayscale" href="<?php echo "$tautulliURL"; ?>" target="iFrame" onclick="abre_frame(false)"><img src="img/brands/tautulli.png" class="brand-ico"> <span>Tautulli</span></a></li>
              <?php } ?>
              <?php if (file_exists("/install/.ombi.lock")) { ?>
                <li><a class="grayscale" href="<?php echo "$ombiURL"; ?>" target="iFrame" onclick="abre_frame(false)"><img src="img/brands/plexrequests-net.png" class="brand-ico"> <span>Ombi</span></a></li>
              <?php } ?>
              <?php if (file_exists('/install/.pyload.lock')) { ?>
                <li><a class="grayscale" href="<?php echo "$pyloadURL"; ?>" target="iFrame" onclick="abre_frame(false)"><img src="img/brands/pyload.png" class="brand-ico"> <span>pyLoad</span></a></li>
              <?php } ?>
              <?php if (file_exists('/install/.radarr.lock')) { ?>
                <li><a class="grayscale" href="<?php echo "$radarrURL"; ?>" target="iFrame" onclick="abre_frame(false)"><img src="img/brands/radarr.png" class="brand-ico"> <span>Radarr</span></a></li>
              <?php } ?>
              <?php if (file_exists('/install/.rapidleech.lock')) { ?>
                <li><a class="grayscale" href="<?php echo "$rapidleechURL"; ?>" target="iFrame" onclick="abre_frame(false)"><img src="img/brands/rapidleech.png" class="brand-ico"> <span>Rapidleech</span></a></li>
              <?php } ?>
              <?php if (file_exists('/install/.sabnzbd.lock')) { ?>
                <li><a class="grayscale" href="<?php echo "$sabnzbdURL"; ?>" target="iFrame" onclick="abre_frame(false)"><img src="img/brands/sabnzbd.png" class="brand-ico"> <span>SABnzbd</span></a></li>
              <?php } ?>
              <?php if (processExists("sickgear",$userRunning) && file_exists('/install/.sickgear.lock')) { ?>
                <li><a class="grayscale" href="<?php echo "$sickgearURL"; ?>" target="iFrame" onclick="abre_frame(false)"><img src="img/brands/sickgear.png" class="brand-ico"> <span>SickGear</span></a></li>
              <?php } ?>
              <?php if (processExists("sickchill",$userRunning) && file_exists('/install/.sickchill.lock')) { ?>
                <li><a class="grayscale" href="<?php echo "$sickchillURL"; ?>" target="iFrame" onclick="abre_frame(false)"><img src="img/brands/sickchill.png" class="brand-ico"> <span>SickChill</span></a></li>
              <?php } ?>
              <?php if (processExists("nzbdrone",$userRunning) && file_exists('/install/.sonarr.lock')) { ?>
                <li><a class="grayscale" href="<?php echo "$sonarrURL"; ?>" target="iFrame" onclick="abre_frame(false)"><img src="img/brands/sonarr.png" class="brand-ico"> <span>Sonarr</span></a></li>
              <?php } ?>
              <?php if (file_exists('/install/.subsonic.lock')) { ?>
                <li><a class="grayscale" href="<?php echo "$subsonicURL"; ?>" target="iFrame" onclick="abre_frame(false)"><img src="img/brands/subsonic.png" class="brand-ico"> <span>Subsonic</span></a></li>
              <?php } ?>
              <?php if (file_exists('/install/.syncthing.lock')) { ?>
                <li><a class="grayscale" href="<?php echo "$syncthingURL"; ?>" target="iFrame" onclick="abre_frame(false)"><img src="img/brands/syncthing.png" class="brand-ico"> <span>Syncthing</span></a></li>
              <?php } ?>
              <?php if (file_exists('/install/.znc.lock')) { ?>
                <li><a class="grayscale" href="<?php echo "$zncURL"; ?>" target="iFrame" onclick="abre_frame(false)"><img src="img/brands/znc.png" class="brand-ico"> <span>ZNC</span></a></li>
              <?php } ?>                     
              <?php if (file_exists('/install/.netdata.lock')) { ?>
                <li><a class="grayscale" href="<?php echo "$netdataURL"; ?>" target="iFrame" onclick="abre_frame(false)"><img src="img/brands/netdata.png" class="brand-ico"> <span>Netdata</span></a></li>
              <?php } ?>       

              <?php if (file_exists('/install/.webmin.lock')) { ?>
               <li><a class="grayscale" href="<?php echo "$webminURL"; ?>" target="iFrame" onclick="abre_frame(true)"><img src="img/brands/webmin.png" class="brand-ico"> <span>Webmin</span></a></li>              
              <?php } ?>

            <?php } ?>
            <?php if (file_exists('/install/.rtorrent.lock') || file_exists('/install/.deluge.lock') || file_exists('/install/.flood.lock')) { ?>
            <li class="nav-parent">
              <a href=""><i class="fa fa-download"></i> <span><?php echo T('DOWNLOADS'); ?></span></a>
              <ul class="children">
                <li><a href="/descargas" target="iFrame" onclick="abre_frame(false)">Carpeta común</a></a></li>
                <li><a href="/personal" target="iFrame" onclick="abre_frame(false)">Carpeta privada</a></a></li>
                <li><a href="/nube" target="iFrame" onclick="abre_frame(false)">Carpeta nube</a></a></li>
                <?php if (file_exists('/install/.rutorrent.lock') || file_exists('/install/.flood.lock')) { ?>
                <!--
                <li><a href="/rtorrent.downloads" target="_blank">rTorrent</a></a></li>
                -->
                <?php } ?>
                <?php if (file_exists('/install/.deluge.lock')) { ?>
                  <li><a href="/deluge.downloads" target="iFrame" onclick="abre_frame(false)">Deluge</a></li>
                <?php } ?>
                <?php if (file_exists('/home/'. $username .'/public_html/'. $username .'.zip')) { ?>
                  <li><a href="/~<?php echo "$username"; ?>/<?php echo "$username"; ?>.zip" target="_blank"> <span>OpenVPN Config</span></a></li>
                <?php } ?>
              </ul>
            </li>
            <?php } ?>
            <?php if (processExistsOther("shellinabox","shellinabox") && ($username == "$master")) { ?>
            <li><a class="grayscale" href="/shell" target="iFrame" onclick="abre_frame(false)"><img src="img\brands\shellinabox.png" class="brand-ico"> <span><?php echo T('WEB_CONSOLE'); ?></span></a></li>
            <?php } ?>
            <!-- /// BEGIN INSERT CUSTOM MENU /// -->
            <?php include ($_SERVER['DOCUMENT_ROOT'].'/custom/custom.menu.php'); ?>
            <!-- /// END INSERT CUSTOM MENU /// -->
          </ul>
        </div><!-- tab pane -->

        <!-- ######################## HELP MENU TAB ##################### -->
        <div class="tab-pane" id="help">
          <h5 class="sidebar-title"><?php echo T('QUICK_SYSTEM_TIPS'); ?></h5>
          <?php if ($username == "$master") { ?>
          <ul class="nav nav-pills nav-stacked nav-quirk nav-mail">
            <li style="padding: 7px"><span style="font-size: 12px; color:#eee">disktest</span><br/>
              <small><?php echo T('DISKTEST_TXT'); ?></small>
            </li>
            <li style="padding: 7px"><span style="font-size: 12px; color:#eee">fixhome</span><br/>
              <small><?php echo T('FIXHOME_TXT'); ?></small>
            </li>
          </ul>
          <h5 class="sidebar-title"><?php echo T('ADMIN_COMMANDS'); ?></h5>
          <ul class="nav nav-pills nav-stacked nav-quirk nav-mail">
            <li style="padding: 7px"><span style="font-size: 12px; color:#eee">setdisk</span><br/>
              <small><?php echo T('SETDISK_TXT'); ?></small>
            </li>
            <li style="padding: 7px"><span style="font-size: 12px; color:#eee">createSeedboxUser</span><br/>
              <small><?php echo T('CREATESEEDBOXUSER_TXT'); ?></small>
            </li>
            <li style="padding: 7px"><span style="font-size: 12px; color:#eee">deleteSeedboxUser</span><br/>
              <small><?php echo T('DELETESEEDBOXUSER_TXT'); ?></small>
            </li>
            <li style="padding: 7px"><span style="font-size: 12px; color:#eee">changeUserpass</span><br/>
              <small><?php echo T('CHANGEUSERPASS_TXT'); ?></small>
            </li>
            <li style="padding: 7px"><span style="font-size: 12px; color:#eee">quickVPN</span><br/>
              <small><?php echo T('QUICKVPN_TXT'); ?></small>
            </li>
            <li style="padding: 7px"><span style="font-size: 12px; color:#eee">showspace</span><br/>
              <small><?php echo T('SHOWSPACE_TXT'); ?></small>
            </li>
            <li style="padding: 7px"><span style="font-size: 12px; color:#eee">upgradeBTSync</span><br/>
              <small><?php echo T('UPGRADEBTSYNC_TXT'); ?></small>
            </li>
            <li style="padding: 7px"><span style="font-size: 12px; color:#eee">upgradeDeluge</span><br/>
              <small><?php echo T('UPGRADEDELUGE_TXT'); ?></small>
            </li>
            <li style="padding: 7px"><span style="font-size: 12px; color:#eee">upgradeJackett</span><br/>
              <small><?php echo T('UPGRADEJACKETT_TXT'); ?></small>
            </li>
            <li style="padding: 7px"><span style="font-size: 12px; color:#eee">upgradeOmbi</span><br/>
              <small><?php echo T('UPGRADEOMBI_TXT'); ?></small>
            </li>
            <li style="padding: 7px"><span style="font-size: 12px; color:#eee">upgradePlex</span><br/>
              <small><?php echo T('UPGRADEPLEX_TXT'); ?></small>
            </li>
            <li style="padding: 7px"><span style="font-size: 12px; color:#eee">upgradepyLoad</span><br/>
              <small><?php echo T('UPGRADEPYLOAD_TXT'); ?></small>
            </li>
            <li style="padding: 7px"><span style="font-size: 12px; color:#eee">upgradeSABnzbd</span><br/>
              <small><?php echo T('UPGRADESABNZBD_TXT'); ?></small>
            </li>
            <li style="padding: 7px"><span style="font-size: 12px; color:#eee">setup-pyLoad</span><br/>
              <small><?php echo T('SETUPPYLOAD_TXT'); ?></small>
            </li>
            <li style="padding: 7px"><span style="font-size: 12px; color:#eee">clean_mem</span><br/>
              <small><?php echo T('CLEAN_MEM_TXT'); ?></small>
            </li>
          </ul>
          <?php } ?>
          <h5 class="sidebar-title"><?php echo T('ESSENTIAL_USER_COMMANDS'); ?></h5>
          <ul class="nav nav-pills nav-stacked nav-quirk nav-mail">
            <li style="padding: 7px"><span style="font-size: 12px; color:#eee">systemctl restart rtorrent@<?php echo $username ?>.service</span><br/>
            <small><?php echo T('SCREEN_RTORRNENT_TXT'); ?></small></li>
            <li style="padding: 7px"><span style="font-size: 12px; color:#eee">systemctl restart irssi@<?php echo $username ?>.service</span><br/>
            <small><?php echo T('SCREEN_IRSSI_TXT'); ?></small></li>
          </ul>
        </div><!-- tab-pane -->

        <!-- ######################## RUTORRENT PLUGINS TAB ##################### -->
        <div class="tab-pane" id="plugins">
          <h5 class="sidebar-title"><?php echo T('PLUGIN_MENU'); ?></h5>
          <ul class="nav nav-pills nav-stacked nav-quirk">
            <li class="nav-parent nav-active">
              <a href=""><i class="fa fa-puzzle-piece"></i> <span><?php echo T('PLUGINS'); ?></span></a>
              <ul class="children">
                <li class="info-quote"><p class="info-quote"><?php echo T('PMENU_NOTICE_TXT'); ?></p></li>
                <?php foreach ($plugins as $plugin) { ?>
                  <li>
                  <?php if(file_exists('/srv/rutorrent/plugins/'.$plugin.'/plugin.info')) {
                    echo "<a href=\"javascript:void()\">$plugin</a> <div class=\"toggle-wrapper pull-right\" style=\"margin-right: -10px; margin-top: 5px;\"> <div class=\"toggle-pen toggle-modern\" onclick=\"location.href='?removeplugin-$plugin=true'\"></div></div>";
                  } else {
                    echo "<a href=\"javascript:void()\">$plugin</a> <div class=\"toggle-wrapper pull-right\" style=\"margin-right: -10px; margin-top: 5px;\"> <div class=\"toggle-pdis toggle-modern\" onclick=\"location.href='?installplugin-$plugin=true'\"></div></div>";
                  } ?>
                  </li>
                <?php } ?>
              </ul>
            </li>
          </ul>
        </div><!-- tab-pane -->

      </div><!-- tab-content -->
    </div><!-- leftpanelinner -->
  </div><!-- leftpanel -->
