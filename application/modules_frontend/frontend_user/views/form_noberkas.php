<form method="post" action="<?php echo $ajax_action_noberkas; ?>" id="login_form" data-parsley-validate>
    <input type="hidden" name="hd_berkas" id="hd_berkas" value="1">
    <div class="content-box wow bounceInDown modal-content">
        <h3 class="content-box-header content-box-header-alt bg-default">
            <span class="icon-separator">
                <i class="glyph-icon icon-lock"></i>
            </span>
            <span class="header-wrapper">
                User No Berkas
            </span>
        </h3>

        <?php if(!empty($login_errmsg)) : ?>
            <div class="alert alert-danger">
                <p><?php echo $login_errmsg; ?></p>
            </div>
        <?php endif; ?>

        <div id="login_errmsg" class="alert alert-danger" style="display:none"></div>

        <div class="content-box-wrapper">
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control" name="user_noberkas" id="user_noberkas" placeholder="No Berkas" required>
                    <span class="input-group-addon bg-blue">
                        <i class="glyph-icon icon-user"></i>
                    </span>
                </div>
            </div>
            <button class="btn btn-success btn-block" id="login_btn_signin">Submit</button>
        </div>
    </div>
</form>