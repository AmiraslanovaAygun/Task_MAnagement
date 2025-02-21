<?php $__env->startSection('customJs'); ?>
    <?php if(session('success')): ?>
        <script>
            Swal.fire({
                icon: "success",
                text: "<?php echo e(session('success')); ?>",
                showConfirmButton: true,
                confirmButtonText: "OK",
                timer: 1500
            });
            <?php echo e(session()->forget('success')); ?>

        </script>
    <?php elseif(session('error')): ?>
        <script>
            Swal.fire({
                icon: "error",
                text: "<?php echo e(session('error')); ?>",
                showConfirmButton: true,
                confirmButtonText: "OK",
                timer: 1500
            });
            <?php echo e(session()->forget('error')); ?>

        </script>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php /**PATH C:\Users\aygun\PhpstormProjects\TrelloApp\resources\views/components/admin/sessionAlert.blade.php ENDPATH**/ ?>