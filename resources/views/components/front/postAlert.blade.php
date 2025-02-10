@section('customJs')
    <script>
        function showAlert(icon, text) {
            Swal.fire({
                icon: icon,
                text: text,
                showConfirmButton: true,
                confirmButtonText: "OK",
                timer: 1500
            });
        }

        $(document).ready(function () {
            $('#contactForm').on('submit', function (e) {
                e.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: "{{route('app.contact.store')}}",
                    method: "POST",
                    data: formData,
                    success: function () {
                        $('#contactForm')[0].reset();
                        showAlert('success', "{{ __('success_sent_message') }}");
                    },
                    error: function (xhr) {
                        var errors = xhr.responseJSON;
                        $("#emailError").text(errors.message);
                        showAlert('error', "{{ __('error_sent_message') }}");
                    }
                });
            });
        });
    </script>
@endsection