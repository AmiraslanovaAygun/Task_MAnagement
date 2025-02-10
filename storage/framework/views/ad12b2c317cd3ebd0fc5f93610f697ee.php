<?php $__env->startSection('customJs'); ?>

    
    <script>
        function showAlert(icon, text) {
            Swal.fire({
                icon: icon,
                text: text,
                showConfirmButton: true,
                confirmButtonText: "OK",
                timer: 6000
            });
        }

        $(document).ready(function () {
            $('.delete-button').on('click', function () {
                let id = $(this).data('id');
                let url = $(this).data('url');

                if (confirm('Silmək istədiyinizə əminsiniz?')) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            _method: 'DELETE',
                            _token: "<?php echo e(csrf_token()); ?>"
                        },
                        success: function (response) {
                            showAlert('success', "<?php echo e('Silinmə müvəffəqiyyətlə yerinə yetirildi'); ?>");
                            let element = $('button[data-id="' + id + '"]');

                            if (element.closest('.col-12').length > 0) {
                                element.closest('.col-12').remove();
                            } else if (element.closest('tr').length > 0) {
                                element.closest('tr').remove();
                            }
                        },
                        error: function (xhr) {
                            var errors = xhr.responseJSON;
                            showAlert('error', errors.message || "<?php echo e('Silinmə zamanı xəta baş verdi'); ?>");
                        }
                    });
                }
            });

            $('.status-change-button').on('click', function () {
                let button = $(this);
                let url = button.data('url');

                let statusCell = button.closest('tr').find('.status-cell');

                $.ajax({
                    url: url,
                    type: "PATCH",
                    data: {
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function (response) {
                        showAlert('success', response.message || '<?php echo app('translator')->get("success_updated"); ?>');

                        if (!response.status) {
                            statusCell.html('<span class="badge btn-danger"><i class="fa-solid fa-xmark"></i></span>');
                        }
                        if (response.status) {
                            statusCell.html('<span class="badge btn-success"><i class="fa-solid fa-check"></i></span>');
                        }
                    },
                    error: function (xhr) {
                        let errors = xhr.responseJSON;
                        showAlert('error', errors.message || '<?php echo app('translator')->get("error_updated"); ?>');
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php /**PATH C:\Users\aygun\PhpstormProjects\TrelloApp\resources\views/components/admin/deleteAlert.blade.php ENDPATH**/ ?>