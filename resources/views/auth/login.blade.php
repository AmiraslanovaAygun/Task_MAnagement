<html lang="en">
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('assets/auth/css/style.css')}}">

</head>
<body class="img js-fullheight"
      style="background-image: url({{ asset('assets/auth/images/bg.jpg')}}); object-fit: cover">
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center my-5">
                <h2 class="heading-section">GİRİŞ</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    <form action="{{route('loginPost')}}" method="POST" class="signin-form">
                        @csrf
                        <div class="form-group">
                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                                   name="email" placeholder="E-poçt:" value="{{ old('email') }}" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="password-field" type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password" placeholder="Şifrə:" required>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary submit px-3">DAXİL OL</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

<script src="{{ asset('assets/auth/js/jquery.min.js')}}"></script>
<script src="{{ asset('assets/auth/js/popper.js')}}"></script>
<script src="{{ asset('assets/auth/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/auth/js/main.js')}}"></script>

<script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015"
        integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ=="
        data-cf-beacon='{"rayId":"90c93ecd8f9f5284","serverTiming":{"name":{"cfExtPri":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"version":"2025.1.0","token":"cd0b4b3a733644fc843ef0b185f98241"}'
        crossorigin="anonymous"></script>
</body>
</html>
