@section('customJs')
    @if(session('success'))
        <script>
            Swal.fire({
                icon: "success",
                text: "{{ session('success') }}",
                showConfirmButton: true,
                confirmButtonText: "OK",
                timer: 1500
            });
            {{ session()->forget('success') }}
        </script>
    @elseif(session('error'))
        <script>
            Swal.fire({
                icon: "error",
                text: "{{ session('error') }}",
                showConfirmButton: true,
                confirmButtonText: "OK",
                timer: 1500
            });
            {{ session()->forget('error') }}
        </script>
    @endif

@endsection
