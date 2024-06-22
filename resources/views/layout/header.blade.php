@php
    //Permet de recuperer la route actuelle
    $routePage = request()->route()->getName();
@endphp

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset("fontawesome/css/all.min.css")}}">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <!-- https://fonts.google.com/ -->
    <link href="{{asset("css/bootstrap.min.css")}}" rel="stylesheet">
    <link href="{{asset("css/templatemo-xtra-blog.css")}}" rel="stylesheet">
</head>

<body>
<header class="tm-header" id="tm-header">
    <div class="tm-header-wrapper">
        <div class="tm-site-header mb-2">
            <div class="mx-auto tm-site-logo"><i class="fas fa-times fa-2x"></i></div>
            <h1 class="text-center">Blog test</h1>
        </div>

        <nav class="tm-nav" id="tm-nav">
            <ul>
                <li class="tm-nav-item {{ $routePage == 'index' ? 'active' : '' }}">
                    <a
                        href="{{route("index")}}" class="tm-nav-link">
                        <i class="fas fa-home"></i>
                        Blog Home
                    </a>
                </li>
                @auth
                    @if(auth()->user()->role == "admin")
                        <li class="tm-nav-item {{ $routePage == 'list.user' ? 'active' : '' }}">
                            <a href="{{route("list.user")}}" class="tm-nav-link">
                                <i class="fas fa-user"></i>
                                Liste des utilisateurs
                            </a>
                        </li>
                        <li class="tm-nav-item {{ $routePage == 'list.post' ? 'active' : '' }}">
                            <a href="{{route("list.post")}}" class="tm-nav-link">
                                <i class="fas fa-blog"></i>
                                Liste de tous les posts
                            </a>
                        </li>
                    @endif
                        <li class="tm-nav-item {{ $routePage == 'list.my.post' ? 'active' : '' }}">
                            <a href="{{route("list.my.post",auth()->user())}}" class="tm-nav-link">
                                <i class="fas fa-blog"></i>
                                Mes posts
                            </a>
                        </li>
                    <li class="justify-content-center" style="display: flex">
                        <a href="{{route("logout")}}" class="tm-nav-link p-2 ml-3">
                            <i class="fas fa-door-open"></i>
                            Déconnexion
                        </a>
                    </li>
                @else
                    <li class="justify-content-center" style="display: flex">
                        <a href="{{route("login")}}" class="tm-nav-link p-2 m-0">
                            <i class="fas fa-user"></i>
                            Login
                        </a>
                        <a href="{{route("register")}}" class="tm-nav-link p-2 m-0">
                            <i class="fas fa-door-open"></i>
                            Sign In
                        </a>
                    </li>
                @endauth

            </ul>
        </nav>
    </div>
</header>

<div class="container-fluid">

    <main class="tm-main">
        <!-- CATEGORIE -->
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif

        <div class="row tm-row">
            <div class="col-3">
                <hr class="tm-hr-primary">
                <div class="dropdown">
                    <a class="tm-post-title tm-color-primary " id="dropdownMenuLink"
                       data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer">
                        Categories
                    </a>
                    <ul class="dropdown-menu tm-mb-75" aria-labelledby="dropdownMenuLink">
                        @foreach($listeCategories as $c)
                            <li style="">
                                <a href="{{ route('show.by.categorie', $c->slug) }}"
                                   class="dropdown-item tm-color-primary p-1">
                                    {{ $c->nom }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <hr class="tm-hr-primary">
            </div>
            <!-- FORMULAIRE DE RECHERCHE -->
            <div class="col-9">
                <form method="GET" class="form-inline tm-mb-80 tm-search-form" action="{{route("search")}}">
                    <input class="form-control tm-search-input" name="motCle" type="text" placeholder="Rechercher..."
                           aria-label="Rechercher">
                    <button class="tm-search-button" type="submit">
                        <i class="fas fa-search tm-search-icon" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
        </div>
