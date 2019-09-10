    <?php if(Session::has('locale')){
                $lang = Session::get('locale');
        }else{
                $lang ="vi";
        }
        ?>
    <!DOCTYPE html>
    <html lang="{{app()->getlocale()}}">
    <head>
    <title>Web Tin Tuc</title>

    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,600,700%7CSource+Sans+Pro:400,600,700' rel='stylesheet'>
    <base href="{{asset('')}}">
    <!-- Css -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}" />
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/font-icons.css')}}" />
    <!-- Favicons -->
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">


    <!-- Lazyload (must be placed in head in order to work) -->
    <script src="{{asset('js/lazysizes.min.js')}}"></script>
    </head>

    <body class="bg-light style-default style-rounded">

    <!-- Preloader -->
    <div class="loader-mask">
    <div class="loader">
        <div></div>
    </div>
    </div>

    <!-- Bg Overlay -->
    <div class="content-overlay"></div>

    <!-- Sidenav -->
    <header class="sidenav" id="sidenav">

    <!-- close -->
    <div class="sidenav__close">
        <button class="sidenav__close-button" id="sidenav__close-button" aria-label="close sidenav">
        <i class="ui-close sidenav__close-icon"></i>
        </button>
    </div>

    <!-- Nav -->
    <nav class="sidenav__menu-container">
        <ul class="sidenav__menu" role="menubar">
        <li>
            <a href="{{route('index')}}" class="sidenav__menu-url">Trang Chủ</a>
        </li>
        <li>
            <a  class="sidenav__menu-url">Pages</a>
            <button class="sidenav__menu-toggle" aria-haspopup="true" aria-label="Open dropdown"><i class="ui-arrow-down"></i></button>
            <ul class="sidenav__menu-dropdown">
            <li><a href="about.html" class="sidenav__menu-url">About</a></li>
            <li><a href="contact.html" class="sidenav__menu-url">Contact</a></li>
            <li><a href="search-results.html" class="sidenav__menu-url">Search Results</a></li>
            <li><a href="categories.html" class="sidenav__menu-url">Categories</a></li>
            <li><a href="404.html" class="sidenav__menu-url">404</a></li>
            </ul>
        </li>
        <li>
            <a href="#" class="sidenav__menu-url">Features</a>
            <button class="sidenav__menu-toggle" aria-haspopup="true" aria-label="Open dropdown"><i class="ui-arrow-down"></i></button>
            <ul class="sidenav__menu-dropdown">
            <li>
                <a href="#" class="sidenav__menu-url">Single Post</a>
            </li>
            <li><a href="shortcodes.html" class="sidenav__menu-url">Shortcodes</a></li>
            </ul>
        </li>

        <!-- Categories -->
        <li>
            <a href="#" class="sidenav__menu-url">World</a>
        </li>
        <li>
            <a href="#" class="sidenav__menu-url">Business</a>
        </li>
        <li>
            <a href="#" class="sidenav__menu-url">Fashion</a>
        </li>
        <li>
            <a href="#" class="sidenav__menu-url">Lifestyle</a>
        </li>
        <li>
            <a href="#" class="sidenav__menu-url">Advertise</a>
        </li>
        </ul>
    </nav>

    <div class="socials sidenav__socials">
        <a class="social social-facebook" href="#" target="_blank" aria-label="facebook">
        <i class="ui-facebook"></i>
        </a>
        <a class="social social-twitter" href="#" target="_blank" aria-label="twitter">
        <i class="ui-twitter"></i>
        </a>
        <a class="social social-google-plus" href="#" target="_blank" aria-label="google">
        <i class="ui-google"></i>
        </a>
        <a class="social social-youtube" href="#" target="_blank" aria-label="youtube">
        <i class="ui-youtube"></i>
        </a>
        <a class="social social-instagram" href="#" target="_blank" aria-label="instagram">
        <i class="ui-instagram"></i>
        </a>
    </div>
    </header> <!-- end sidenav -->
    <main class="main oh" id="main">
            <!-- Top Bar -->
            <div class="top-bar d-none d-lg-block">
                <div class="container">
                <div class="row">

                    <!-- Top menu -->
                    <div class="col-lg-6">
                        <a href="{{route('language',['lang' => "en"])}}">
                            <img src="{{asset('img/en.png')}}" width="5%" src="flag England"/>
                        </a>

                        <a href="{{route('language',['lang' => "vi"])}}">
                            <img src="{{asset('img/vn.png')}}" width="5%" src="flag VietNam"/>
                        </a>
                    </div>

                    <!-- Socials -->
                    <div class="col-lg-6">
                        <div class="socials nav__socials socials--nobase socials--white justify-content-end">
                            <a class="social social-facebook" href="#" target="_blank" aria-label="facebook">
                                <i class="fas fa-user-secret"></i>
                            </a>
                        </div>
                    </div>

                </div>
                </div>
            </div> <!-- end top bar -->

            <!-- Navigation -->
            <header class="nav">

                <div class="nav__holder nav--sticky">
                <div class="container relative">
                    <div class="flex-parent">

                    <!-- Side Menu Button -->
                    <button class="nav-icon-toggle" id="nav-icon-toggle" aria-label="Open side menu">
                        <span class="nav-icon-toggle__box">
                        <span class="nav-icon-toggle__inner"></span>
                        </span>
                    </button>

                    <!-- Logo -->
                    <a href="{{route('index',['lang' => $lang])}}" class="logo">
                        <img class="logo__img" src="img/logo_default.png" srcset="img/logo_default.png 1x, img/logo_default@2x.png 2x" alt="logo">
                    </a>

                    <!-- Nav-wrap -->
                    <nav class="flex-child nav__wrap d-none d-lg-block">
                        <ul class="nav__menu">
                            <li class="">
                                {{-- <a href="{{route('index')}}">@lang('home.home_menu')</a> --}}
                                <a href="{{route('index',['lang' => $lang])}}">{{trans('home.home_menu')}}</a>
                            </li>
                            @foreach ($category as $tl)
                                <li class="nav__dropdown">
                                    <a>{{$tl->TenTL}}</a>
                                    <ul class="nav__dropdown-menu">
                                        @foreach ($typenews as $lt)
                                            @if ($lt->idTL == $tl->id)
                                                <li><a href="{{route('detailloaitin',['tenkd' => $lt->Ten_KhongDau,'lang' => $lang])}}">{{$lt->Ten}}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                            <li>
                                <a href="{{route('contact',['lang' => $lang])}}">{{trans('home.contact_menu')}}</a>
                            </li>
                            @if (Auth::check())
                                <li>{{Auth::user()->name}}</li>
                                <li><a href="{{route('frontend-logout')}}">Đăng xuất</a></li>
                            @else
                                <li>
                                    <a href="{{route('frontend-login',['lang' => $lang])}}">{{trans('home.login_menu')}}</a>
                                </li>
                                <li>
                                    <a href="{{route('frontend-register',['lang' => $lang])}}">{{trans('home.logout_menu')}}</a>
                                </li>
                            @endif
                        </ul> <!-- end menu -->
                    </nav> <!-- end nav-wrap -->

                    <!-- Nav Right -->
                    <div class="nav__right">

                        <!-- Search -->
                        <div class="nav__right-item nav__search">
                        <a href="#" class="nav__search-trigger" id="nav__search-trigger">
                            <i class="ui-search nav__search-trigger-icon"></i>
                        </a>
                        <div class="nav__search-box" id="nav__search-box">
                            <form action="{{route('search')}}" method="GET" class="nav__search-form">
                                <input type="text" name="txtSearch" placeholder="Nhập Từ Khóa" class="nav__search-input">
                                <button type="submit" class="search-button btn btn-lg btn-color btn-button">
                                    <i class="ui-search nav__search-icon"></i>
                                </button>
                            </form>
                        </div>
                        </div>

                    </div> <!-- end nav right -->

                    </div> <!-- end flex-parent -->
                </div> <!-- end container -->

                </div>
            </header> <!-- end navigation -->
