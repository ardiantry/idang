<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>kondangan di desa sudimampir</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

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
            .promo_tematik
    {
        background-image:unset!important;
        background: url({{asset('image/bg-home.png')}})!important; 
        background-position: center!important;
        background-repeat: no-repeat!important;
        background-size: cover!important;
        position: fixed;
        width: 100%;
        top: 0;
        bottom: 0;
    }
            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {font-size: 50px;
border: 5px solid #fff;
background: rgb(122, 222, 232);
color: #fff;
padding: 30px;
border-radius: 80px;
box-shadow: 0px 2px 8px 2px rgba(0, 0, 0, 0.11);
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }          </style>
    </head>
    <body>
         <div class="promo_tematik"></div>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Kondangan di desa Sudimampir 
                </div> 
            </div>
        </div>
    </body>
</html>
