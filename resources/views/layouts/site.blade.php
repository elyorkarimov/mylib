<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Title -->
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'AKBT') }}</title>
    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" href="./front/assets/img/favicon.png">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- CSS Implementing Plugins -->
    <link href="{{ asset('front/assets/vendor/font-awesome/css/fontawesome-all.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('front/assets/vendor/flaticon/font/flaticon.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('front/assets/vendor/animate.css/animate.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('front/assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('front/assets/vendor/slick-carousel/slick/slick.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('front/assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') }}"
        rel="stylesheet" type="text/css" />

    <!-- CSS Bookworm Template -->
    <link href="{{ asset('front/assets/css/theme.css') }}" rel="stylesheet" type="text/css" />
    @livewireStyles
</head>

<body class="left-sidebar">

    <!--===== HEADER CONTENT =====-->
    <header id="site-header" class="site-header__v1">
        <div class="topbar border-bottom d-none d-md-block">
            <div class="container-fluid px-2 px-md-5 px-xl-8d75">
                <div class="topbar__nav d-md-flex justify-content-between align-items-center">
                    <ul class="topbar__nav--left nav ml-md-n3">
                        <li class="nav-item"><a href="#" class="nav-link link-black-100"><i
                                    class="glph-icon flaticon-question mr-2"></i>Sizga yordam bera olamizmi?</a></li>
                        <li class="nav-item"><a href="tel:+998993851882" class="nav-link link-black-100"><i
                                    class="glph-icon flaticon-phone mr-2"></i>+99899 385-18-82</a></li>
                    </ul>

                    <ul class="topbar__nav--right nav mr-md-n3">
                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item"><a href="{{ url(app()->getLocale() . '/home') }}"
                                        class="nav-link link-black-100"> {{ __('Home') }}</a></li>
                            @else
                                <li class="nav-item"><a href="{{ route('login', app()->getLocale()) }}"
                                        class="nav-link link-black-100"><i
                                            class="glph-icon flaticon-user"></i>{{ __('Login') }}</a></li>

                                @if (Route::has('register'))
                                    <li class="nav-item"><a href="{{ route('register', app()->getLocale()) }}"
                                            class="nav-link link-black-100"><i
                                                class="glph-icon flaticon-user"></i>{{ __('Register') }}</a></li>
                                @endif
                            @endauth

                        @endif

                        {{-- <li class="nav-item"><a href="#" class="nav-link link-black-100"><i class="glph-icon flaticon-switch"></i></a></li>
                        <li class="nav-item"><a href="#" class="nav-link link-black-100"><i class="glph-icon flaticon-heart"></i></a></li> --}}
                        {{-- <li class="nav-item">
                            <!-- Account Sidebar Toggle Button -->
                            <a id="sidebarNavToggler" href="javascript:;" role="button" class="nav-link link-black-100"
                                aria-controls="sidebarContent"
                                aria-haspopup="true"
                                aria-expanded="false"
                                data-unfold-event="click"
                                data-unfold-hide-on-scroll="false"
                                data-unfold-target="#sidebarContent"
                                data-unfold-type="css-animation"
                                data-unfold-overlay='{
                                    "className": "u-sidebar-bg-overlay",
                                    "background": "rgba(0, 0, 0, .7)",
                                    "animationSpeed": 500
                                }'
                                data-unfold-animation-in="fadeInRight"
                                data-unfold-animation-out="fadeOutRight"
                                data-unfold-duration="500">
                                <i class="glph-icon flaticon-user"></i>
                            </a>
                            <!-- End Account Sidebar Toggle Button -->
                        </li>
                        <li class="nav-item">
                            <!-- Cart Sidebar Toggle Button -->
                            <a id="sidebarNavToggler1" href="javascript:;" role="button" class="nav-link link-black-100 position-relative"
                                aria-controls="sidebarContent1"
                                aria-haspopup="true"
                                aria-expanded="false"
                                data-unfold-event="click"
                                data-unfold-hide-on-scroll="false"
                                data-unfold-target="#sidebarContent1"
                                data-unfold-type="css-animation"
                                data-unfold-overlay='{
                                    "className": "u-sidebar-bg-overlay",
                                    "background": "rgba(0, 0, 0, .7)",
                                    "animationSpeed": 500
                                }'
                                data-unfold-animation-in="fadeInRight"
                                data-unfold-animation-out="fadeOutRight"
                                data-unfold-duration="500">
                                <span class="position-absolute bg-dark width-16 height-16 rounded-circle d-flex align-items-center justify-content-center text-white font-size-n9 right-0">3</span>
                                <i class="glph-icon flaticon-icon-126515"></i>
                            </a>
                            <!-- End Cart Sidebar Toggle Button -->
                        </li> --}}
                    </ul>

                </div>
            </div>
        </div>
        <div class="masthead border-bottom position-relative" style="margin-bottom: -1px;">
            <div class="container-fluid px-3 px-md-5 px-xl-8d75 py-2 py-md-0">

                <div class="d-flex align-items-center position-relative flex-wrap">
                    <div class="offcanvas-toggler mr-4 mr-lg-8">
                        <a id="sidebarNavToggler2" href="javascript:;" role="button" class="cat-menu"
                            aria-controls="sidebarContent2" aria-haspopup="true" aria-expanded="false"
                            data-unfold-event="click" data-unfold-hide-on-scroll="false"
                            data-unfold-target="#sidebarContent2" data-unfold-type="css-animation"
                            data-unfold-overlay='{
                            "className": "u-sidebar-bg-overlay",
                            "background": "rgba(0, 0, 0, .7)",
                            "animationSpeed": 100
                        }'
                            data-unfold-animation-in="fadeInLeft" data-unfold-animation-out="fadeOutLeft"
                            data-unfold-duration="100">
                            <svg width="20px" height="18px">
                                <path fill-rule="evenodd" fill="rgb(25, 17, 11)"
                                    d="M-0.000,-0.000 L20.000,-0.000 L20.000,2.000 L-0.000,2.000 L-0.000,-0.000 Z" />
                                <path fill-rule="evenodd" fill="rgb(25, 17, 11)"
                                    d="M-0.000,8.000 L15.000,8.000 L15.000,10.000 L-0.000,10.000 L-0.000,8.000 Z" />
                                <path fill-rule="evenodd" fill="rgb(25, 17, 11)"
                                    d="M-0.000,16.000 L20.000,16.000 L20.000,18.000 L-0.000,18.000 L-0.000,16.000 Z" />
                            </svg>
                        </a>
                    </div>
                    <div class="site-branding pr-md-4">
                        <a href="/" class="d-block mb-1">
                            <img src="/logo.png" alt="" style="width: 120px;">
                        </a>
                    </div>
                    <div class="site-navigation mr-auto d-none d-xl-block">
                        <ul class="nav">
                            <li class="nav-item dropdown">
                                <a id="homeDropdownInvoker" href="#"
                                    class="dropdown-toggle nav-link link-black-100 mx-4 px-0 py-5 font-weight-medium d-flex align-items-center"
                                    aria-haspopup="true" aria-expanded="false" data-unfold-event="hover"
                                    data-unfold-target="#homeDropdownMenu" data-unfold-type="css-animation"
                                    data-unfold-duration="200" data-unfold-delay="50"
                                    data-unfold-hide-on-scroll="true" data-unfold-animation-in="slideInUp"
                                    data-unfold-animation-out="fadeOut">
                                    Home
                                </a>
                                <ul id="homeDropdownMenu"
                                    class="dropdown-unfold dropdown-menu font-size-2 rounded-0 border-gray-900"
                                    aria-labelledby="homeDropdownInvoker">
                                    <li><a href="/" class="dropdown-item link-black-100">Home v1</a></li>

                                </ul>
                            </li>
                            <li class="nav-item">
                                <a  href="{{ url(app()->getLocale() . '/udcs/') }}" class=" nav-link link-black-100 mx-4 px-0 py-5 font-weight-medium d-flex align-items-center"
                                    aria-haspopup="true" aria-expanded="false" data-unfold-event="hover"
                                    data-unfold-target="#featuresDropdownMenu" data-unfold-type="css-animation"
                                    data-unfold-duration="200" data-unfold-delay="50"
                                    data-unfold-hide-on-scroll="true" data-unfold-animation-in="slideInUp"
                                    data-unfold-animation-out="fadeOut">
                                    {{ __('Udc') }}
                                </a>
                                 
                            </li>
                        </ul>
                    </div>

                    <ul class="d-md-none nav mr-md-n3 ml-auto">
                        <li class="nav-item">
                            <!-- Account Sidebar Toggle Button - Mobile -->
                            <a id="sidebarNavToggler9" href="{{ route('login', app()->getLocale()) }}"
                                role="button" class="px-2 nav-link link-black-100" aria-controls="sidebarContent9"
                                aria-haspopup="true" aria-expanded="false" data-unfold-event="click"
                                data-unfold-hide-on-scroll="false" data-unfold-target="#sidebarContent9"
                                data-unfold-type="css-animation"
                                data-unfold-overlay='{
                                    "className": "u-sidebar-bg-overlay",
                                    "background": "rgba(0, 0, 0, .7)",
                                    "animationSpeed": 500
                                }'
                                data-unfold-animation-in="fadeInRight" data-unfold-animation-out="fadeOutRight"
                                data-unfold-duration="500">
                                <i class="glph-icon flaticon-user"></i>
                            </a>
                            <!-- End Account Sidebar Toggle Button - Mobile -->
                        </li>
                    </ul>
                    <div class="site-search ml-xl-0 ml-md-auto w-r-100 my-2 my-xl-0">
                            <form action="{{ route('site.books', app()->getLocale()) }}" method="GET"
                                accept-charset="UTF-8" role="search" class="form-inline">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <i
                                        class="glph-icon flaticon-loupe input-group-text py-2d75 bg-white-100 border-white-100"></i>
                                </div>
                                <input
                                    class="form-control bg-white-100 min-width-380 py-2d75 height-4 border-white-100"
                                    type="search" placeholder="{{ __('Search by Keyword') }} ..."
                                    aria-label="Search" name="keyword">
                            </div>
                            <button class="btn btn-outline-success my-2 my-sm-0 "
                                type="submit">{{ __('Search') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <!--===== END HEADER CONTENT =====-->
    @yield('content')
    <!-- ========== FOOTER ========== -->
    <footer>
        <div class="border-top space-top-3">
            <div class="border-bottom pb-5 space-bottom-lg-3">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 mb-6 mb-lg-0">
                            <div class="pb-6">
                                <a href="index.html" class="d-inline-block mb-5">

                                    <img src="/logo.png" alt="" style="width: 120px;">

                                </a>
                                <address class="font-size-2 mb-5">
                                    <span class="mb-2 font-weight-normal text-dark">
                                        Toshkent sh. Navoiy ko’chasi, 32 uy, 100011 <br> Toshkent
                                    </span>
                                </address>
                                <div class="mb-4">
                                    <a href="mailto:karimovelyor@gmail.com"
                                        class="font-size-2 d-block link-black-100 mb-1">karimovelyor@gmail.com</a>
                                    <a href="tel:+998993851882" class="font-size-2 d-block link-black-100">+99899
                                        385-18-82</a>
                                </div>
                                <ul class="list-unstyled mb-0 d-flex">
                                    <li class="btn pl-0">
                                        <a class="link-black-100" href="#">
                                            <span class="fab fa-instagram"></span>
                                        </a>
                                    </li>
                                    <li class="btn">
                                        <a class="link-black-100" href="#">
                                            <span class="fab fa-facebook-f"></span>
                                        </a>
                                    </li>
                                    <li class="btn">
                                        <a class="link-black-100" href="#">
                                            <span class="fab fa-youtube"></span>
                                        </a>
                                    </li>
                                    <li class="btn">
                                        <a class="link-black-100" href="#">
                                            <span class="fab fa-twitter"></span>
                                        </a>
                                    </li>
                                    <li class="btn">
                                        <a class="link-black-100" href="#">
                                            <span class="fab fa-pinterest"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2 mb-6 mb-lg-0">
                            <h4 class="font-size-3 font-weight-medium mb-2 mb-xl-5 pb-xl-1">Explore</h4>
                            <ul class="list-unstyled mb-0">
                                <li class="pb-2">
                                    <a class="widgets-hover transition-3d-hover font-size-2 link-black-100"
                                        href="#">About as</a>
                                </li>
                                <li class="py-2">
                                    <a class="widgets-hover transition-3d-hover font-size-2 link-black-100"
                                        href="#">Sitemap</a>
                                </li>
                                <li class="py-2">
                                    <a class="widgets-hover transition-3d-hover font-size-2 link-black-100"
                                        href="#">Bookmarks</a>
                                </li>
                                <li class="pt-2">
                                    <a class="widgets-hover transition-3d-hover font-size-2 link-black-100"
                                        href="#">Sign in/Join</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-2 mb-6 mb-lg-0">
                            <h4 class="font-size-3 font-weight-medium mb-2 mb-xl-5 pb-xl-1">Customer Service</h4>
                            <ul class="list-unstyled mb-0">
                                <li class="pb-2">
                                    <a class="widgets-hover transition-3d-hover font-size-2 link-black-100"
                                        href="#">Help Center</a>
                                </li>
                                <li class="py-2">
                                    <a class="widgets-hover transition-3d-hover font-size-2 link-black-100"
                                        href="#">Returns</a>
                                </li>
                                <li class="py-2">
                                    <a class="widgets-hover transition-3d-hover font-size-2 link-black-100"
                                        href="#">Product Recalls</a>
                                </li>
                                <li class="py-2">
                                    <a class="widgets-hover transition-3d-hover font-size-2 link-black-100"
                                        href="#">Accessibility</a>
                                </li>
                                <li class="py-2">
                                    <a class="widgets-hover transition-3d-hover font-size-2 link-black-100"
                                        href="#">Contact Us</a>
                                </li>
                                <li class="pt-2">
                                    <a class="widgets-hover transition-3d-hover font-size-2 link-black-100"
                                        href="#">Store Pickup</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-2 mb-6 mb-lg-0">
                            <h4 class="font-size-3 font-weight-medium mb-2 mb-xl-5 pb-xl-1">Policy</h4>
                            <ul class="list-unstyled mb-0">
                                <li class="pb-2">
                                    <a class="widgets-hover transition-3d-hover font-size-2 link-black-100"
                                        href="#">Return Policy</a>
                                </li>
                                <li class="py-2">
                                    <a class="widgets-hover transition-3d-hover font-size-2 link-black-100"
                                        href="#">Terms Of Use</a>
                                </li>
                                <li class="py-2">
                                    <a class="widgets-hover transition-3d-hover font-size-2 link-black-100"
                                        href="#">Security</a>
                                </li>
                                <li class="pt-2">
                                    <a class="widgets-hover transition-3d-hover font-size-2 link-black-100"
                                        href="#">Privacy</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-2 mb-6 mb-lg-0">
                            <h4 class="font-size-3 font-weight-medium mb-2 mb-xl-5 pb-xl-1">Categories</h4>
                            <ul class="list-unstyled mb-0">
                                <li class="pb-2">
                                    <a class="widgets-hover transition-3d-hover font-size-2 link-black-100"
                                        href="#">Action</a>
                                </li>
                                <li class="py-2">
                                    <a class="widgets-hover transition-3d-hover font-size-2 link-black-100"
                                        href="#">Comedy</a>
                                </li>
                                <li class="py-2">
                                    <a class="widgets-hover transition-3d-hover font-size-2 link-black-100"
                                        href="#">Drama</a>
                                </li>
                                <li class="py-2">
                                    <a class="widgets-hover transition-3d-hover font-size-2 link-black-100"
                                        href="#">Horror</a>
                                </li>
                                <li class="py-2">
                                    <a class="widgets-hover transition-3d-hover font-size-2 link-black-100"
                                        href="#">Kids</a>
                                </li>
                                <li class="pt-2">
                                    <a class="widgets-hover transition-3d-hover font-size-2 link-black-100"
                                        href="#">Romantic Comedy</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="space-1">
                <div class="container">
                    <div class="d-lg-flex text-center text-lg-center justify-content-center align-items-center">
                        <!-- Copyright -->
                        <p class="mb-3 mb-lg-0 font-size-2">©2022 AKBT. All rights reserved</p>
                        <!-- End Copyright -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ========== END FOOTER ========== -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('front/assets/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('front/assets/vendor/jquery-migrate/dist/jquery-migrate.min.js') }}"></script>
    <script src="{{ asset('front/assets/vendor/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('front/assets/vendor/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('front/assets/vendor/slick-carousel/slick/slick.min.js') }}"></script>
    <script src="{{ asset('front/assets/vendor/multilevel-sliding-mobile-menu/dist/jquery.zeynep.js') }}"></script>
    <script
        src="{{ asset('front/assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}">
    </script>

    <!-- JS HS Components -->
    <script src="{{ asset('front/assets/js/hs.core.js') }}"></script>
    <script src="{{ asset('front/assets/js/components/hs.unfold.js') }}"></script>
    <script src="{{ asset('front/assets/js/components/hs.malihu-scrollbar.js') }}"></script>
    <script src="{{ asset('front/assets/js/components/hs.header.js') }}"></script>
    <script src="{{ asset('front/assets/js/components/hs.slick-carousel.js') }}"></script>
    <script src="{{ asset('front/assets/js/components/hs.slick-carousel.js') }}"></script>
    <script src="{{ asset('front/assets/js/components/hs.selectpicker.js') }}"></script>
    <script src="{{ asset('front/assets/js/components/hs.show-animation.js') }}"></script>
    <!-- JS Bookworm -->
    <!-- <script src="../../front/assets/js/bookworm.js"></script> -->
    <script>
        $(document).on('ready', function() {
            // initialization of unfold component
            $.HSCore.components.HSUnfold.init($('[data-unfold-target]'));

            // initialization of slick carousel
            $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel');

            // initialization of header
            $.HSCore.components.HSHeader.init($('#header'));

            // initialization of malihu scrollbar
            $.HSCore.components.HSMalihuScrollBar.init($('.js-scrollbar'));

            // initialization of show animations
            $.HSCore.components.HSShowAnimation.init('.js-animation-link');

            // init zeynepjs
            var zeynep = $('.zeynep').zeynep({
                onClosed: function() {
                    // enable main wrapper element clicks on any its children element
                    $("body main").attr("style", "");

                    console.log('the side menu is closed.');
                },
                onOpened: function() {
                    // disable main wrapper element clicks on any its children element
                    $("body main").attr("style", "pointer-events: none;");

                    console.log('the side menu is opened.');
                }
            });

            // handle zeynep overlay click
            $(".zeynep-overlay").click(function() {
                zeynep.close();
            });

            // open side menu if the button is clicked
            $(".cat-menu").click(function() {
                if ($("html").hasClass("zeynep-opened")) {
                    zeynep.close();
                } else {
                    zeynep.open();
                }
            });
        });
    </script>
    @livewireScripts


</body>

</html>
