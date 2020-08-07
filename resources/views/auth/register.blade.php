<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="assets_reg/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="assets_reg/css/style.css">

    <link rel="stylesheet" href="assets_reg/loader/loader.css">

</head>
<body>

    <!-- Start Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
    </div>
    <!-- End Page Preloder -->

    <div class="main">

        <section class="signup">
            <!-- <img src="assets_reg/images/signup-bg.png" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form method="POST" action="{{ route('register') }}" id="signup-form" class="signup-form">
                    @csrf
                        <h2 class="form-title">Create account</h2>
                        <div class="form-group">
                            <input id="name" type="text" class="form-input" name="name" placeholder="Your Name"/>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Your Email"/>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="password" id="password" placeholder="Password"/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="password_confirmation" id="password-confirm" placeholder="Repeat your password"/>

                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit" id="submit" class="form-submit">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                    <p class="loginhere">
                        Have already an account ? <a href="{{route('login')}}" class="loginhere-link">Login here</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="assets_reg/vendor/jquery/jquery.min.js"></script>
    <script src="assets_reg/js/main.js"></script>
    <script src="assets_reg/loader/loader.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
