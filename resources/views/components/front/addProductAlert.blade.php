@section('customJs')
    <script>
        document.querySelectorAll('.cart-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                const actionUrl = this.action;
                const csrfToken = this.querySelector('input[name="_token"]').value;

                fetch(actionUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({})
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            this.querySelector('button').innerHTML =
                                '<i class="fa-solid fa-cart-shopping mr-2"></i>' + '@lang("added")';
                            this.querySelector('button').classList.remove('btn-primary');
                            this.querySelector('button').classList.add('btn-warning');
                        } else {
                            this.querySelector('button').innerHTML =
                                '<i class="fa-solid fa-cart-shopping mr-2"></i>' + '@lang("add_cart")';
                            this.querySelector('button').classList.remove('btn-warning');
                            this.querySelector('button').classList.add('btn-primary');
                        }
                    })
                    .catch(error => {
                        console.error('Xəta baş verdi:', error);
                    });
            });
        });

        document.querySelectorAll('.wishlist-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                const actionUrl = this.action;
                const csrfToken = this.querySelector('input[name="_token"]').value;

                fetch(actionUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({})
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            this.querySelector('button').innerHTML =
                                '<i class="fa-solid fa-heart mr-2"></i>' + '@lang("added")';
                            this.querySelector('button').classList.remove('btn-outline-danger');
                            this.querySelector('button').classList.add('btn-outline-warning');
                        } else {
                            this.querySelector('button').innerHTML =
                                '<i class="fa-solid fa-heart mr-2"></i>' + '@lang("add_fav")';
                            this.querySelector('button').classList.remove('btn-outline-warning');
                            this.querySelector('button').classList.add('btn-outline-danger');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });
    </script>

@endsection
