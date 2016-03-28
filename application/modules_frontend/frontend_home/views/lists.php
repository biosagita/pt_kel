<style type="text/css">
.p-title span{font-size: 14px;}
.icon-box .icon-title {font-size: 12px;}

.modal-dialog {
  width: 90%;
  height: 92%;
  padding: 0;
  margin: 20px auto;
}

.modal-content {
  height: 99%;
  overflow: scroll;
}
h3{min-width: 150px;}
</style>

<div class="row">
    <?php foreach($group_layanan as $vGL): ?>
    <a data-toggle="modal" href="<?php echo site_url('frontend_home/home/get_box_layanan/'.$vGL['gly_id']); ?>" data-target="#myModal<?php echo $vGL['gly_id']; ?>">
        <div class="col-md-3" style="margin-bottom:20px;">
            <div class="panel-box col-xs-6 bg-blue-alt" style="padding:initial !important;">
                <div class="panel-content" style="min-height:180px;">
                    <i class="icon-medium glyph-icon icon-file-text"></i>
                    <h3><?php echo $vGL['gly_name']; ?></h3>
                </div>
            </div>
        </div>
    </a>
    <!-- Modal -->
    <div class="modal fade" id="myModal<?php echo $vGL['gly_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content"></div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <?php endforeach; ?>
</div>