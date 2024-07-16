<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/authcss/login.css') }}">
</head>

<body>
    <div class="center">
        <div class="container">
            <label class="close-btn fas fa-times" title="close"></label>
            <div class="text">Login Here</div>
            @if (Session::has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif
            <form id="loginForm" action="{{ route('login.req') }}" method="POST">
                @csrf
                <div class="data">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email"
                        class="form-control @error('email') is-invalid @enderror" placeholder="Please enter your email"
                        value="{{ old('email') }}">
                    @error('email')
                        <div class="text-danger">
                            <ul>
                                <li><span>{{ $message }}</span></li>
                            </ul>
                        </div>
                    @enderror
                </div>
                <div class="data">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Please enter your password">
                    @error('password')
                        <div class="text-danger">
                            <ul>
                                <li><span>{{ $message }}</span></li>
                            </ul>
                        </div>
                    @enderror
                </div>
                <div class="btn">
                    <div class="inner"></div>
                    <button type="submit">Login</button>
                </div>
                <div class="signup-link">
                    Not a member? <a href="{{ route('signuppage') }}">Register now</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>

</html>
