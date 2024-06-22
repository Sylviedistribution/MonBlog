<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Font Icon -->
    <link rel="stylesheet" href="{{asset("fonts/material-icon/css/material-design-iconic-font.min.css")}}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{asset("css/style.css")}}">
    <link rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}">
</head>

<body>
<div class="main">
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">S'inscrire</h2>
                    <form method="POST" class="register-form" id="register-form" action="{{route('register.save')}}">
                        @csrf
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="nom" id="name" placeholder="Votre nom"
                                   class="@error('nom') is-invalid @enderror">
                            @error('nom')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email" placeholder="Votre Email"
                                   class="@error('email') is-invalid @enderror">
                            @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="pass" placeholder="Mot de passe"
                                   class="@error('password') is-invalid @enderror">
                            @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" name="password_confirmation" id="re_pass"
                                   placeholder="Confirmer votre mot de passe"
                                   class="@error('password_confirmation') is-invalid @enderror">
                            @error('password_confirmation')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group form-button">
                            <button type="submit" name="signup" id="signup" class="form-submit">S'enregistrer</button>
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="{{asset("img/signup-image.jpg")}}" alt="sing up image"></figure>
                    <a href="{{ route('login') }}" class="signup-image-link">Je suis déjà membre</a>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
