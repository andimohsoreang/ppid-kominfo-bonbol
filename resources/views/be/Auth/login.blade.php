<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PPID Bon Bolango</title>
    <link rel="stylesheet" href={{ asset('be/assets/css/bootstrap.css') }}>

    <link rel="shortcut icon" href={{ asset('be/assets/images/favicon.svg') }} type="image/x-icon">
    <link rel="stylesheet" href={{ asset('be/assets/css/app.css') }}>
</head>

@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif


<body>
    <div id="auth">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card pt-4">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <img src={{ asset('be/assets/images/ppidbonebol.png') }} height="48" class='mb-4'>
                                <h3>Sign In</h3>
                                <p>Please sign in to continue to Voler.</p>
                                @if(session()->has('loginError'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('loginError') }}
                                    <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @endif
                            </div>
                            <form action="/login" method="post">
                                @csrf
                                <div class="form-group position-relative has-icon-left">
                                    <label for="email">Email</label>
                                    <div class="position-relative">
                                        <i class="bi bi-person"></i>
                                        <input type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror" id="email"
                                            value="{{ old('email')}}" autofocus required>
                                        @error('email')
                                        <div class="invalid-feedback position-relative">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group position-relative has-icon-left">
                                    <div class="clearfix">
                                        <label for="password">Password</label>
                                    </div>
                                    <div class="position-relative">
                                        <input type="password" name="password" class="form-control" id="password"
                                            required>
                                        <div class="form-control-icon">
                                            <i data-feather="lock"></i>
                                        </div>
                                    </div>
                                </div>


                                <div class="clearfix">
                                    <button class="btn btn-primary float-end">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src={{ asset('be/assets/js/feather-icons/feather.min.js') }}></script>
    <script src={{ asset('be/assets/js/app.js') }}></script>

    <script src={{ asset('be/assets/js/main.js') }}></script>
</body>

</html>