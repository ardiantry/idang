<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Aplikasi Kondangan</title>

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
        background: url(http://192.168.1.106:70/image/bg-home.png)!important; 
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
                position: relative;
                right: 10px;
                top: 18px;
                text-align: right;
            }

            .content {
                text-align: center;
            }

            .title {font-size: 28px;
border: 5px solid #fff;
background: rgb(22, 106, 115);
color: #fdfdfd;
padding: 15px;
border-radius: 80px;
box-shadow: 0px 2px 8px 2px rgba(0, 0, 0, 0.11);
width: 500px;
margin: 25px auto 0px auto;
font-weight: bold;
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
            }  
            .content {
  text-align: center;
  z-index: 1;
  position: relative;
} 
.card img {
  height: 202px;
}
.card h4 {
  font-size: 16px;
  text-decoration: ;
  text-transform: capitalize;
}
.card span {
  font-size: 12px;
  margin: 0;
  color: #9f9d9d;
  font-style: italic;
}
.card .card-body
{
    text-align: left;
}
.card p {
  font-size: 14px;
  color: #423d3d;
}
.card {
   
  margin-bottom: 10px;
}
@media(max-width: 500px)
{
   .title {
  width: 79%;
}
  
}
              
              </style>
                <link href="{{asset('asset/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('asset/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/css/bootstrap.css"> 
    </head>
    <body>
         <div class="promo_tematik"></div>
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/admin') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">

                
                {{-- <div class="title m-b-md">
                    APLIKASI KONDANGAN DESA SUDIMAMPIR
                 </div> --}}
                
           <h4 style="margin-top: 50px ">APLIKASI KONDANGAN</h4>  
           <h4 style="margin-top: 10px ">DESA SUDIMAMPIR</h4>  

                <div class="container">
                         
                       
                    
                <div class="row">
                    @foreach($data_list  as $key)
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{$key->foto}}">
                            <div class="card-body">
                                 <span class="date"><i class="fa  fa-table"></i> {{$key->tgl_mulai}}</span>
                                 <span class="lamaacara"><i class="fa fa-clock-o"></i>Sesi Acara {{$key->lama_acara }}</span> 
                                 <h4>{{@$key->nama_kondangan}}</h4>
                                 <p>Alamat : {{$key->alamat}}</p>
                                 {{-- <div class="text-right">  
                                    <a href="{{url('')}}">Detail</a>
                                 </div> --}}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                </div> 
            </div>
        <script src="{{asset('asset/js/bootstrap.bundle.min.js')}}"></script>
    </body>
</html>
