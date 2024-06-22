<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap -->
    <link href="{{asset("css/bootstrap.min.css")}}" rel="stylesheet">
    <!-- Font Icon -->
    <link rel="stylesheet" href="{{asset("fonts/material-icon/css/material-design-iconic-font.min.css")}}">
    <!-- Main css -->
    <link rel="stylesheet" href="{{asset("css/style.css")}}">

    <title>Connexion</title>
</head>

<body>

<div class="main">
    @if(session('error'))
        <div class="alert alert-warning text-center">
            {{session('error')}}
        </div>
    @endif
    <!-- Sing in  Form -->
    <section class="sign-in">

        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="{{asset("img/signin-image.jpg")}}" alt="sing up image"></figure>
                    <a href="{{route("register")}}" class="signup-image-link">Créer un compte</a>
                </div>

                <div class="signin-form">
                    <h2 class="form-title">S'identifier</h2>
                    <form method="POST" class="register-form" id="login-form" action="{{route("login.action")}}">
                        @csrf
                        <div class="form-group">
                            <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="email" id="your_name" placeholder="Email"
                                   class="@error('email') is-invalid @enderror" {{ old('email') }}>
                            @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="your_pass" placeholder="Password"
                                   class="@error('password') is-invalid @enderror">
                            @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="remember-me" id="remember-me" class="agree-term"/>
                            <label for="remember-me" class="label-agree-term"><span><span></span></span>Se souvenir de
                                moi</label>
                        </div>
                        <div class="form-group form-button ">
                            <button type="submit" name="signin" id="signin" class="form-submit border-0">Se connecter
                            </button>
                        </div>

                    </form>
                    <div class="social-login">
                        <span class="social-label">Se connecter avec</span>
                        <ul class="socials">
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="{{asset("js/jquery.min.js")}}"></script>
</body>
</html>
