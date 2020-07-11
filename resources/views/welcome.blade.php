<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
        </style>
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
                <router-link to="/" class="navbar-brand">Dashboard</router-link>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <router-link to="/example" class="navbar-brand">About</router-link>
                            <router-link to="/home" class="navbar-brand">Contact</router-link>
                        </li>
                    </ul>
                </div>
            </nav>
            <router-view></router-view>
        </div>
        
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
