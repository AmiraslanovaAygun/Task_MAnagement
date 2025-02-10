<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Admin - <?php echo $__env->yieldContent('title', 'Proyekt İdarə Sistemi'); ?></title>

    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/plugins/fontawesome-free/css/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/dist/css/adminlte.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/customCss/1custom.css')); ?>" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <?php echo $__env->yieldContent('customCss'); ?>

</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__wobble" src="<?php echo e(asset('assets/admin/dist/img/AdminLTELogo.png')); ?>" alt="AdminLTELogo"
             height="60" width="60">
    </div>

    <?php echo $__env->make('admin.partials.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('content'); ?>

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?php echo e(asset('assets/admin/plugins/jquery/jquery.min.js')); ?>"></script>
<!-- Bootstrap -->
<script src="<?php echo e(asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<!-- overlayScrollbars -->
<script src="<?php echo e(asset('assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('assets/admin/dist/js/adminlte.js')); ?>"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="<?php echo e(asset('assets/admin/plugins/jquery-mousewheel/jquery.mousewheel.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/raphael/raphael.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/jquery-mapael/jquery.mapael.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/jquery-mapael/maps/usa_states.min.js')); ?>"></script>
<!-- ChartJS -->
<script src="<?php echo e(asset('assets/admin/plugins/chart.js/Chart.min.js')); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo e(asset('assets/admin/dist/js/pages/dashboard2.js')); ?>"></script>

<script src="https://kit.fontawesome.com/aa02fbbfef.js" crossorigin="anonymous"></script>

<?php echo $__env->yieldContent('customJs'); ?>
</body>
</html>
<?php /**PATH C:\Users\aygun\PhpstormProjects\TrelloApp\resources\views/layouts/admin.blade.php ENDPATH**/ ?>