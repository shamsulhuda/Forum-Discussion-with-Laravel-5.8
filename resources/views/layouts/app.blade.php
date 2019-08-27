<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <title>{{ config('app.name', 'Forum') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/forum.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

    <!-- heighlight css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.13.1/styles/atom-one-dark.min.css">
    
    <!-- <link href="{{ asset('assets/css/material-dashboard.css?v=2.1.1')}}" rel="stylesheet" /> -->
    
    
    
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand text-info" href="{{ url('/forum') }}">
                    <span class="fa fa-connectdevelop text-danger"></span>
                    CodeHut
                    <!-- {{ config('app.name', 'CodeHut') }} -->
                </a>
                
                <!-- ==================================================== -->
            
                <!-- ==================================================== -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                            Menus
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('discussions.create')}}">Create Discussion</a>
                            <a class="dropdown-item" href="/forum?filter=solved">Solved Discussions</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/forum?filter=unsolved">Unsolved Discussions</a>
                            </div>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user"></i> {{ Auth::user()->name }}
                                <p class="d-lg-none d-md-block">
                                    Account
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                            <a class="dropdown-item" href="#">{{ Auth::user()->name }} <span class="caret"></span></a>
                            <a class="dropdown-item" href="#">Settings</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            </div>
                        </li>

                            
                        @endguest
                        
                    </ul>
                </div>
            </div>
        </nav>
    <div id="app">
        <div class="py-0 nav2">
            <img src="{{asset('images/edited.png')}}" alt="">
            <span class="text-white display-4">Think twice, code once!</span>
        
        </div>
        <!-- error show -->
        @if($errors->count() > 0)
        <div class="alert alert-warning alert-dismissible fade show text-danger" role="alert">
            @foreach($errors->all() as $error)
            {{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button><br>
            @endforeach
            
        </div>
        @endif

        <main class="py-4 d-flex p-2">
            <div class="container col-md-2 f-div">
                <div class="list-group">
                    <a class="forum-btn form-control btn mb-4" href="{{ route('discussions.create')}}">
                        Create Discussion
                    </a>
                    <a class="nav-link list-group-item" href="{{ url('/forum') }}">
                    <i class="fa fa-home text-default"></i>
                        Home
                    </a>
                    <a class="nav-link list-group-item" href="/forum?filter=all">
                    <i class="fa fa-folder text-info"></i>
                        All Discussions
                    </a>
                    @if(Auth::check())
                    <a class="nav-link list-group-item" href="/forum?filter=me">
                    <i class="fa fa-folder-open text-secondary"></i>
                        My Discussions
                    </a>
                    @endif
                    <a class="nav-link list-group-item" href="/forum?filter=solved">
                    <i class="fa fa-check text-primary"></i>
                        Solved Discussions
                    </a>
                    <a class="nav-link list-group-item" href="/forum?filter=unsolved">
                    <i class="fa fa-times text-danger"></i>
                        Unsolved Discussions
                    </a>
                </div>

                
                @if(Auth::check())
                    @if(Auth::user()->admin)
                    <hr>
                        <p class="text-center">Admin area</p>
                    <hr>
                    <a class="nav-link" href="/channels">
                        <i class="fa fa-crosshairs"></i>
                            All Channels
                    </a>
                    <a class="nav-link" href="/channels/create">
                        <i class="fa fa-plus"></i>
                            Create channel
                    </a>
                    @endif
                @endif
            </div>

            @yield('content')

            <div class="col-md-2 sec-div list-group">
                <h4 class="form-control btn btn-secondary mb-4">Channels</h4>
                    @foreach($channels as $channel)
                    <a class="nav-link list-group-item border-0" href="{{ route('channel', ['slug' => $channel->slug]) }}">
                        <i class="fa fa-crosshairs"></i>
                        {{ $channel->title }}
                    </a>
                    @endforeach
            </div>
            
           
        
        </main>
         
    
<footer>
    <div class="footer" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12  col-md-3 col-sm-6 col-xs-12">
                    
                    <ul class="social">
                        <li> <a href="#"> <i class=" fa fa-facebook">   </i> </a> </li>
                        <li> <a href="#"> <i class="fa fa-twitter">   </i> </a> </li>
                        <li> <a href="#"> <i class="fa fa-github">   </i> </a> </li>
                        <li> <a href="#"> <i class="fa fa-gitlab">   </i> </a> </li>
                        <li> <a href="#"> <i class="fa fa-youtube">   </i> </a> </li>
                    </ul>
                    <span><a class="display-5" href="{{ '/' }}">CODEHUT</a></span>
                </div>
            </div>
            <!--/.row--> 
        </div>
        <!--/.container--> 
    </div>
    <!--/.footer-->
    
    <div class="footer-bottom">
        <div class="container">
            <p class="text-center"> ©Copyright {{ now()->year }} All right reserved. </p>
            
        </div>
    </div>
    <!--/.footer-bottom--> 
</footer>
        
        
</div>
<!-- Footer -->

<!-- Footer -->









<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
<!-- toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
@if(Session::has('success'))
    toastr.success('{{ Session::get('success')}}')
@endif
</script>
<!-- heighlight js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.13.1/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
    <!--   Core JS Files   -->
<!-- <script src="{{asset('assets/js/core/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script> -->
</body>
</html>
