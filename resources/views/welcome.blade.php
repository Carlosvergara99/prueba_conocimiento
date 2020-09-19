<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{mix('css/app.css')}}" rel="stylesheet">
        
    </head>
    <body>
        <div id="app" class="content">
            <div class="container">
               
        
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="collapse navbar-collapse">
                        <div class="navbar-nav">
                           <router-link to="/" class="nav-item nav-link">Restaurantes</router-link>

                            <router-link to="/reservar" class="nav-item nav-link">reservar </router-link> 

                        </div>
                    </div>
                </nav>
                <br/>
                <router-view></router-view>
            </div>
        </div> 
        <script src="{{mix('js/app.js')}}"></script>

    </body>