@section('customJs')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.wishlist-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const url = this.getAttribute('data-url');

                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                this.style.backgroundColor = 'orange';
                                this.style.color = 'black';
                            } else {
                                this.style.backgroundColor = '';
                                this.style.color = '';
                            }
                        })
                        .catch(error => console.error('ERROR:', error));
                });
            });

            document.querySelectorAll('.cart-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const url = this.getAttribute('data-url');

                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                this.style.backgroundColor = 'orange';
                                this.style.color = 'black';
                            } else {
                                this.style.backgroundColor = '';
                                this.style.color = '';
                            }
                        })
                        .catch(error => console.error('ERROR:', error));
                });
            });
        });


    </script>
@endsection