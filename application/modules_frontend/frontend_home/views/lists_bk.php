<style type="text/css">
.p-title span{font-size: 14px;}
.icon-box .icon-title {font-size: 12px;}
</style>

<div class="row">
    <?php foreach($group_layanan as $vGL): ?>
    <div class="col-md-4">
        <h3 class="p-title title-first frs">
            <span class="box lay"><?php echo $vGL['gly_name']; ?></span>
        </h3>

        <?php $cnt_layanan = 1; ?>
        <?php foreach($layanan as $vL): ?>
        <?php if($vL['lyn_gly_id'] != $vGL['gly_id']) continue; ?>

        <?php if($cnt_layanan == 1 OR ($cnt_layanan % 3) == 1) : ?>
        <div class="row">
        <?php endif; ?>
            <a href="<?php echo site_url('daftar-tamu/' . sanitize_title_with_dashes($vL['lyn_name']) . URL_DELIMITER . $vL['lyn_id']); ?>">
                <div class="icon-box col-md-4">
                    <i class="icon-medium glyph-icon bg-primary icon-file-text hvr-1"></i>
                    <i class="icon-medium glyph-icon bg-primary icon-file-text-o hvr-2"></i>
                    <h3 class="icon-title"><?php echo $vL['lyn_name']; ?></h3>
                    <div class="vrtl-box"></div>
                </div>
            </a>
        <?php if(($cnt_layanan % 3) == 0) : ?>
        </div>
        <?php endif; ?>

        <?php $cnt_layanan++; ?>
        <?php endforeach; ?>

        <?php if($cnt_layanan != 1 AND ($cnt_layanan % 3) > 0) : ?>
        </div>
        <?php endif; ?>

    </div>
    <?php endforeach; ?>
</div>

<script type="text/javascript">
//var idleTime = 0;
$(document).ready(function () {
    //Increment the idle time counter every minute.
    var idleTimeout = setTimeout(updateNotifications, 2000); // 1 minute
    //var idleInterval = setInterval(updateNotifications, 30000); // 1 minute

    //Zero the idle timer on mouse movement.
    /*
    $(this).mousemove(function (e) {
        idleTime = 0;
    });
    $(this).keypress(function (e) {
        idleTime = 0;
    });
    */
});

/*
function timerIncrement() {
    idleTime = idleTime + 1;
    if (idleTime > 60) { // 2 minutes
        window.location.href = 'http://localhost/antrian/index.php/md_home/ProsesLogout/';
    }
}
*/

function updateNotifications() {
    $.ajax({
        dataType: "json",
        url: "<?php echo site_url('frontend_home/home/get_json_layanan'); ?>",
        success: function(data) {
            $('#total_notif').text(data.jumlah);
        }
    });
}
</script>