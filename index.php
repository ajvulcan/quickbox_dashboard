<?php
  include ('inc/config.php');
  include ('inc/panel.header.php');
  include ('inc/panel.menu.php');
?>

  <div class="mainpanel">
    <!--<div class="pageheader">
      <h2><i class="fa fa-home"></i> Panel de Control</h2>
    </div>-->
    <div class="contentpanel">
    <iframe name="iFrame" frameborder="0" width="100%" height="100%" style="display:none"></iframe>

      <div class="row" id="p_dash">

        <div class="col-md-8">

          <!--BANDWIDTH CHART & DATA-->
          <div class="panel panel-main panel-inverse">
            <div class="panel-heading">
              <h4 class="panel-title"><?php echo T('BANDWIDTH_DATA'); ?></h4>
            </div>
            <div class="panel-body text-center" style="padding:0 0 0 5px; overflow: hidden !important">
              <div style="margin-right: -30px">
                  <div id="mainbw" style="width:100%;height:350px;"></div>
                </div>
            </div>
            <div class="row panel-footer panel-statistics" style="padding:0">
              <div class="col-md-12">
                <div class="table-responsive">
                  <table class="table table-hover table-bordered nomargin">
                    <thead>
                      <tr>
                        <th style="width:33%;padding: 4px 4px 4px 12px"><?php echo T('NETWORK'); ?></th>
                        <th style="width:33%;padding: 4px 4px 4px 12px"><?php echo T('UPLOAD'); ?></th>
                        <th style="width:33%;padding: 4px 4px 4px 12px"><?php echo T('DOWNLOAD'); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (false !== ($strs = @file("/proc/net/dev"))) : ?>
                      <?php for ($i = 2; $i < count($strs); $i++ ) : ?>
                      <?php preg_match_all( "/([^\s]+):[\s]{0,}(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)/", $strs[$i], $info );?>
                      <tr>
                        <td style="font-size:14px;font-weight:bold;padding: 2px 2px 2px 12px"><?php echo $info[1][0]?></td>
                        <td style="font-size:11px;padding: 2px 2px 2px 12px"><span class="text-success"><span id="NetOutSpeed<?php echo $i?>">0B/s</span></span></td>
                        <td style="font-size:11px;padding: 2px 2px 2px 12px"><span class="text-primary"><span id="NetInputSpeed<?php echo $i?>">0B/s</span></span></td>
                      </tr>
                      <?php endfor; ?>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="panel panel-inverse">
            <div class="panel-heading">
              <h4 class="panel-title"><?php echo T('VIEW_ADDITIONAL_BANDWIDTH_DETAILS'); ?></h4>
            </div>
            <div class="panel-body" style="padding:0">
              <div class="row" style="padding: 0; margin: 0"><div id="bw_tables" style="padding:0;margin:0;"></div></div>
            </div>
          </div>

          <!--SERVICE CONTROL CENTER-->
          <?php include ('widgets/service_control.php'); ?>
          <!-- panel -->

          <?php if (file_exists("/install/.foo.lock")) { ?>
            <!--PACKAGE MANAGEMENT CENTER-->
            <?php include ('widgets/pmc.php'); ?>
            <!-- panel -->
          <?php } ?>

        </div>

        <div class="col-md-4 dash-right">
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-side panel-inverse-full panel-updates">
                <div class="panel-heading">
                  <h4 class="panel-title text-success"><?php echo T('SERVER_LOAD'); ?></h4>
                </div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-sm-9">
                      <h4><span id="cpuload"></span></h4>
                      <p><?php echo T('SL_TXT'); ?></p>
                    </div>
                    <div class="col-sm-3 text-right">
                      <i class="fa fa-heartbeat text-danger" style="font-size: 70px"></i>
                    </div>
                    <div class="row">
                      <div class="col-sm-12 mt20 text-center">
                        <strong><?php echo T('UPTIME'); ?>:</strong> <span id="uptime"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- panel -->
            </div><!-- SERVER LOAD WIDGET -->
	      <div class="col-sm-12">
              <div class="panel panel-side panel-inverse">
                <div class="panel-heading">
                  <h4 class="panel-title"><?php echo T('CPU_STATUS'); ?></h4>
                </div>
                <div class="panel-body" style="overflow:hidden">
                  <div style="padding:0;margin:-15px -30 -15px -15px">
                    <div id="flot-placeholder1" style="width:100%;height:200px;"></div>
                    <!--div id="metercpu"></div-->
                  </div>
                  <hr />
                  <span class="nomargin" style="font-size:14px">
                    <?php echo $sysInfo['cpu']['model'];?><br/>
                    [<span style="color:#999;font-weight:600">x<?php echo $sysInfo['cpu']['num']; ?></span> core]
                  </span>
                </div>
              </div>
            </div><!-- CPU WIDGET -->
            <div class="col-sm-12">
              <div class="panel panel-side panel-inverse">
                <div class="panel-heading">
                  <h4 class="panel-title"><?php echo T('YOUR_DISK_STATUS'); ?></h4>
                </div>
                <div class="panel-body">
                  <div id="disk_data"></div>
                </div>
              </div>
            </div><!-- DISK WIDGET -->
            <div class="col-sm-12">
              <div class="panel panel-side panel-inverse">
                <div class="panel-heading">
                  <h4 class="panel-title"><?php echo T('SYSTEM_RAM_STATUS'); ?></h4>
                </div>
                <div class="panel-body">
                  <div id="meterram"></div>
                </div>
              </div>
            </div><!-- RAM WIDGET -->
          </div><!-- row -->
        </div>
      </div>
    </div><!-- contentpanel -->
  </div><!-- mainpanel -->

  <?php
    include ('inc/panel.scripts.php');
    include ('inc/panel.end.php');
  ?>
