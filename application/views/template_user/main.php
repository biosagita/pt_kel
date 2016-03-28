<!DOCTYPE html>
<html lang ="en">
<head>
    <style>
        /* Loading Spinner */
        .spinner{margin:0;width:70px;height:18px;margin:-35px 0 0 -9px;position:absolute;top:50%;left:50%;text-align:center}.spinner > div{width:18px;height:18px;background-color:#333;border-radius:100%;display:inline-block;-webkit-animation:bouncedelay 1.4s infinite ease-in-out;animation:bouncedelay 1.4s infinite ease-in-out;-webkit-animation-fill-mode:both;animation-fill-mode:both}.spinner .bounce1{-webkit-animation-delay:-.32s;animation-delay:-.32s}.spinner .bounce2{-webkit-animation-delay:-.16s;animation-delay:-.16s}@-webkit-keyframes bouncedelay{0%,80%,100%{-webkit-transform:scale(0.0)}40%{-webkit-transform:scale(1.0)}}@keyframes bouncedelay{0%,80%,100%{transform:scale(0.0);-webkit-transform:scale(0.0)}40%{transform:scale(1.0);-webkit-transform:scale(1.0)}}
    </style>
    <meta charset="UTF-8">
<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
<title><?php echo $title; ?></title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<!-- Favicons -->

<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $assets; ?>/images/icons/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $assets; ?>/images/icons/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $assets; ?>/images/icons/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="<?php echo $assets; ?>/images/icons/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="<?php echo $assets; ?>/images/icons/favicon.png">



    <!-- HELPERS -->

<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/helpers/animate.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/helpers/backgrounds.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/helpers/boilerplate.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/helpers/border-radius.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/helpers/grid.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/helpers/page-transitions.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/helpers/spacing.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/helpers/typography.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/helpers/utils.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/helpers/colors.css">

<!-- ELEMENTS -->

<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/badges.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/buttons.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/content-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/dashboard-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/forms.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/images.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/info-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/invoice.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/loading-indicators.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/menus.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/panel-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/response-messages.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/responsive-tables.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/ribbon.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/social-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/tables.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/tile-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/elements/timeline.css">

<!-- FRONTEND ELEMENTS -->

<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/frontend-elements/blog.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/frontend-elements/cta-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/frontend-elements/feature-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/frontend-elements/footer.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/frontend-elements/hero-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/frontend-elements/icon-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/frontend-elements/portfolio-navigation.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/frontend-elements/pricing-table.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/frontend-elements/sliders.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/frontend-elements/testimonial-box.css">

<!-- ICONS -->

<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/icons/fontawesome/fontawesome.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/icons/linecons/linecons.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/icons/spinnericon/spinnericon.css">

<!-- WIDGETS -->

<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/accordion-ui/accordion.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/calendar/calendar.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/carousel/carousel.css">

<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/charts/justgage/justgage.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/charts/morris/morris.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/charts/piegage/piegage.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/charts/xcharts/xcharts.css">

<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/chosen/chosen.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/colorpicker/colorpicker.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/datatable/datatable.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/datepicker/datepicker.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/datepicker-ui/datepicker.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/daterangepicker/daterangepicker.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/dialog/dialog.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/dropdown/dropdown.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/dropzone/dropzone.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/file-input/fileinput.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/input-switch/inputswitch.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/input-switch/inputswitch-alt.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/ionrangeslider/ionrangeslider.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/jcrop/jcrop.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/jgrowl-notifications/jgrowl.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/loading-bar/loadingbar.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/maps/vector-maps/vectormaps.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/markdown/markdown.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/modal/modal.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/multi-select/multiselect.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/multi-upload/fileupload.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/nestable/nestable.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/noty-notifications/noty.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/popover/popover.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/pretty-photo/prettyphoto.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/progressbar/progressbar.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/range-slider/rangeslider.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/slider-ui/slider.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/summernote-wysiwyg/summernote-wysiwyg.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/tabs-ui/tabs.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/theme-switcher/themeswitcher.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/timepicker/timepicker.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/tocify/tocify.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/tooltip/tooltip.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/touchspin/touchspin.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/uniform/uniform.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/wizard/wizard.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/xeditable/xeditable.css">

<!-- FRONTEND WIDGETS -->

<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/layerslider/layerslider.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/owlcarousel/owlcarousel.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/fullpage/fullpage.css">

<!-- SNIPPETS -->

<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/snippets/chat.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/snippets/files-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/snippets/login-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/snippets/notification-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/snippets/progress-box.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/snippets/todo.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/snippets/user-profile.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/snippets/mobile-navigation.css">

<!-- Frontend theme -->

<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/themes/frontend/layout.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/themes/frontend/color-schemes/default.css">

<!-- Components theme -->

<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/themes/components/default.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/themes/components/border-radius.css">

<!-- Frontend responsive -->

<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/helpers/responsive-elements.css">
<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/helpers/frontend-responsive.css">

<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/datatable/buttons.dataTables.css">

<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/custom.css">

    <!-- JS Core -->

    <script type="text/javascript" src="<?php echo $assets; ?>/js-core/jquery-core.js"></script>
    <script type="text/javascript" src="<?php echo $assets; ?>/js-core/jquery-ui-core.js"></script>
    <script type="text/javascript" src="<?php echo $assets; ?>/js-core/jquery-ui-widget.js"></script>
    <script type="text/javascript" src="<?php echo $assets; ?>/js-core/jquery-ui-mouse.js"></script>
    <script type="text/javascript" src="<?php echo $assets; ?>/js-core/jquery-ui-position.js"></script>
    <script type="text/javascript" src="<?php echo $assets; ?>/js-core/transition.js"></script>
    <script type="text/javascript" src="<?php echo $assets; ?>/js-core/modernizr.js"></script>
    <script type="text/javascript" src="<?php echo $assets; ?>/js-core/jquery-cookie.js"></script>

<!-- Uniform -->

<!--<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/uniform/uniform.css">-->
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/uniform/uniform.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/uniform/uniform-demo.js"></script>

<!-- Chosen -->

<!--<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/chosen/chosen.css">-->
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/chosen/chosen.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/chosen/chosen-demo.js"></script>

<script type="text/javascript" src="<?php echo $assets; ?>/widgets/datatable/datatable.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/datatable/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/datatable/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/datatable/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/datatable/vfs_fonts.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/datatable/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/datatable/datatable-bootstrap.js"></script>
<!--<script type="text/javascript" src="<?php echo $assets; ?>/widgets/datatable/dataTables.colVis.js"></script>-->
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/datatable/buttons.colVis.min.js"></script>

<script type="text/javascript">
    $(window).load(function(){
        setTimeout(function() {
            $('#loading').fadeOut( 400, "linear" );
        }, 300);
    });
</script>

</head>

<body>
<div id="page-wrapper">
<div id="loading">
    <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
</div>

<div id="page-wrapper"><div class="top-bar bg-topbar" style="margin-bottom: 10px;">
    <div class="container">
        <div class="float-left">
            <div class="float-left">
                <a href="<?php echo site_url('/'); ?>" class="btn btn-sm" data-placement="bottom" title="logo jakarta">
                    <img src="<?php echo $assets; ?>/images/logojkt.png" width="50px">
                </a>
            </div>
        </div>
        <div class="float-right user-account-btn dropdown">
            <a href="#" title="My Account" class="user-profile clearfix" data-toggle="dropdown" aria-expanded="false">
                <img width="28" src="<?php echo $assets; ?>/image-resources/gravatar.jpg" alt="Profile image">
                <span>Guest</span>
                <i class="glyph-icon icon-angle-down"></i>
            </a>
        </div>
    </div><!-- .container -->
</div><!-- .top-bar -->

<div class="container">
    <?php echo $contents; ?>
</div>

<br /><br />

<!--<div class="main-footer clearfix">
    <div class="footer-pane">
        <div class="container clearfix">
            <div class="logo">&copy; 2014 Monarch. All Rights Reserved.</div>
        </div>
    </div>
</div>-->

</div>


    <!-- FRONTEND ELEMENTS -->

<!-- Skrollr -->

<script type="text/javascript" src="<?php echo $assets; ?>/widgets/skrollr/skrollr.js"></script>

<!-- Owl carousel -->

<script type="text/javascript" src="<?php echo $assets; ?>/widgets/owlcarousel/owlcarousel.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/owlcarousel/owlcarousel-demo.js"></script>

<!-- HG sticky -->

<script type="text/javascript" src="<?php echo $assets; ?>/widgets/sticky/sticky.js"></script>

<!-- WOW -->

<script type="text/javascript" src="<?php echo $assets; ?>/widgets/wow/wow.js"></script>

<!-- VideoBG -->

<script type="text/javascript" src="<?php echo $assets; ?>/widgets/videobg/videobg.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/videobg/videobg-demo.js"></script>

<!-- Mixitup -->

<script type="text/javascript" src="<?php echo $assets; ?>/widgets/mixitup/mixitup.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/mixitup/isotope.js"></script>

<!-- WIDGETS -->

<!-- Bootstrap Dropdown -->

<script type="text/javascript" src="<?php echo $assets; ?>/widgets/dropdown/dropdown.js"></script>

<!-- Bootstrap Tooltip -->

<script type="text/javascript" src="<?php echo $assets; ?>/widgets/tooltip/tooltip.js"></script>

<!-- Bootstrap Popover -->

<script type="text/javascript" src="<?php echo $assets; ?>/widgets/popover/popover.js"></script>

<!-- Bootstrap Progress Bar -->

<script type="text/javascript" src="<?php echo $assets; ?>/widgets/progressbar/progressbar.js"></script>

<!-- Bootstrap Buttons -->

<script type="text/javascript" src="<?php echo $assets; ?>/widgets/button/button.js"></script>

<!-- Bootstrap Collapse -->

<script type="text/javascript" src="<?php echo $assets; ?>/widgets/collapse/collapse.js"></script>

<!-- Superclick -->

<script type="text/javascript" src="<?php echo $assets; ?>/widgets/superclick/superclick.js"></script>

<!-- Input switch alternate -->

<script type="text/javascript" src="<?php echo $assets; ?>/widgets/input-switch/inputswitch-alt.js"></script>

<!-- Slim scroll -->

<script type="text/javascript" src="<?php echo $assets; ?>/widgets/slimscroll/slimscroll.js"></script>

<!-- Content box -->

<script type="text/javascript" src="<?php echo $assets; ?>/widgets/content-box/contentbox.js"></script>

<!-- Overlay -->

<script type="text/javascript" src="<?php echo $assets; ?>/widgets/overlay/overlay.js"></script>

<!-- Widgets init for demo -->

<script type="text/javascript" src="<?php echo $assets; ?>/js-init/widgets-init.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/js-init/frontend-init.js"></script>

<!-- Theme layout -->

<script type="text/javascript" src="<?php echo $assets; ?>/themes/frontend/layout.js"></script>

<!-- Theme switcher -->

<script type="text/javascript" src="<?php echo $assets; ?>/widgets/theme-switcher/themeswitcher.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.perizinan .prt').click(function(e){
            e.preventDefault();

            var me = $(this);
            var me_id = me.attr('id');
            var me_cld = $('#'+me_id+'-cld');
            if(me_cld.css('display') !== 'none') {
                me_cld.hide();
                me.removeClass('activated');
            } else {
                $('.cld').hide();
                $('.prt').removeClass('activated');
                me_cld.show();
                me.addClass('activated');
            }
        });
    })
</script>

</body>
</html>