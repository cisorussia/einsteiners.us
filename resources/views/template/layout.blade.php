<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" prefix="og: http://ogp.me/ns#">
    <head>
        {{-- Component: Common ==================================================== --}}
        @yield('header')
        <base href="/"/>
        <meta name="Robots" content="index, follow">
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <meta name="rights" content="Einsteiners"/>
        <meta name="author" content="Свебикс"/>
        {{-- Component: Common ==================================================== --}}
        {{-- Component: POW ==================================================== --}}
        {{--<link rel="manifest" href="/manifest.json">--}}
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="application-name" content="Einsteiners">
        <meta name="apple-mobile-web-app-title" content="Einsteiners">
        <meta name="theme-color" content="#5ec9de"/>
        <meta name="msapplication-navbutton-color" content="#5ec9de">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <meta name="msapplication-starturl" content="/">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        {{-- Component: POW ==================================================== --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{-- Component: Icon ==================================================== --}}
        <link rel="icon" type="image/png" href="/images/icon/favicon-16x16.png" sizes="16x16">
        <link rel="icon" type="image/png" href="/images/icon/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/images/icon/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="/images/icon/favicon-192x192.png" sizes="192x192">
        <link rel="apple-touch-icon" type="image/png" sizes="57x57" href="/images/icon/favicon-57x57.png">
        <link rel="apple-touch-icon" type="image/png" sizes="60x60" href="/images/icon/favicon-60x60.png">
        <link rel="apple-touch-icon" type="image/png" sizes="72x72" href="/images/icon/favicon-72x72.png">
        <link rel="apple-touch-icon" type="image/png" sizes="76x76" href="/images/icon/favicon-76x76.png">
        <link rel="apple-touch-icon" type="image/png" sizes="114x114" href="/images/icon/favicon-114x114.png">
        <link rel="apple-touch-icon" type="image/png" sizes="120x120" href="/images/icon/favicon-120x120.png">
        <link rel="apple-touch-icon" type="image/png" sizes="144x144" href="/images/icon/favicon-144x144.png">
        <link rel="apple-touch-icon" type="image/png" sizes="152x152" href="/images/icon/favicon-152x152.png">
        <link rel="apple-touch-icon" type="image/png" sizes="180x180" href="/images/icon/favicon-180x180.png">
        <link rel="apple-touch-icon" type="image/png" sizes="192x192" href="/images/icon/favicon-192x192.png">
        <meta name="msapplication-square70x70logo" content="/images/icon/favicon-70x70.png">
        <meta name="msapplication-square150x150logo" content="/images/icon/favicon-150x150.png">
        {{--
        <meta name="msapplication-wide310x150logo" content="/images/icon/favicon-310x150.png">
        --}}
        <meta name="msapplication-square310x310logo" content="/images/icon/favicon-310x310.png">
        {{-- Component: Icon ==================================================== --}}
        {{-- Component: Preload ==================================================== --}}
        <link rel="preload" href="/fonts/Montserrat/Montserrat-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
        <link rel="preload" href="/fonts/Montserrat/Montserrat-Bold.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
        <link rel="preload" href="/fonts/Montserrat/Montserrat-ExtraBold.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
        {{-- Component: AddScript ==================================================== --}}
        {{--<link rel="preload" href="{{ mix('/js/js.min.js') }}" as="script" type="text/javascript"/>--}}
        {{-- Component: AddScript ==================================================== --}}
        {{-- Component: AddScript ==================================================== --}}
        <script src="{{ mix('/js/js.min.js') }}"></script>
        {{-- Component: AddScript ==================================================== --}}
        {{-- Component: Preload ==================================================== --}}
        {{-- Component: Style ==================================================== --}}
        <style>
        body,
        html {
            background: /*#FFF9FB*/ #f9feff;
            overflow-x: hidden;
            max-width: 100%
        }
        .uk-preload {
            background-color: #FFF;
            position: relative;
            background-color: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            position: fixed;
            height: 100vh;
            width: 100vw;
            z-index: 100
        }
        .uk-preload::before {
            content: "";
            position: absolute;
            background-color: #FFF;
            border-radius: 100%;
            width: 200vh;
            height: 200vh;
            z-index: 0;
            left: calc(50% - 100vh);
            top: calc(50% - 100vh);
            transition: All 0.55s ease-in-out;
        }
        .uk-logo-loader {
            position: absolute;
        }
        .uk-logo-loader .uk-frame {
            background: linear-gradient(135deg, #1e5799 15%, #00aeef 35%, #80ddaa 50%, #45de8b 65%, #45de8b 65%, #00aeef 85%, #00aeef 85%);
            background-size: 500% 500%;
            animation: gradient 5s ease infinite;
            position: relative;
            display: block;
            width: 90px;
            height: 90px;
            mask-image: url('/images/symbol-mask-invert.svg');
            -webkit-mask-image: url('/images/symbol-mask-invert.svg');
            mask-repeat: no-repeat;
            -webkit-mask-repeat: no-repeat;
            mask-position: center;
            -webkit-mask-position: center;
            mask-size: cover;
            -webkit-mask-size: cover
        }
        .uk-preload.uk-animation-preload::before  {
            animation: preload .55s ease 1;
        }
        @keyframes preload {
            0% {
                transform: scale(1.0);
            }

            50% {
                transform: scale(0.65);
            }

            100% {
                transform: scale(0.1);
            }
        }
        @keyframes gradient {
            0% {
                background-position: 0 50%
            }

            50% {
                background-position: 100% 50%
            }

            100% {
                background-position: 0 50%
            }
        }
        </style>
        @if(View::hasSection('style'))@yield('style')@endif
        {{-- Component: Style ==================================================== --}}
        @livewireStyles
        {{-- Component: AddStyle ==================================================== --}}
        @mobile
            <link rel="stylesheet" href="{{ mix('/css/mobile.min.css') }}" as="style" type="text/css"/>
        @elsemobile
            <link rel="stylesheet" href="{{ mix('/css/portable.min.css') }}" as="style" type="text/css"/>
        @endmobile
        @if(View::hasSection('stylesheet'))
            @yield('stylesheet')
        @endif
        {{-- Component: AddStyle ==================================================== --}}
        {{-- Component: Open Graph ==================================================== --}}
        @if(View::hasSection('ogmeta'))
            <meta property="og:type" content="website"/>
            <meta property="og:site_name" content="Einsteiners - Сервис организации мероприятий"/>
            @yield('ogmeta')
            <meta property="og:image:width" content="1200"/>
            <meta property="og:image:height" content="630"/>
        @else
            <meta property="og:type" content="website"/>
            <meta property="og:site_name" content="Einsteiners - Сервис организации мероприятий"/>
            <meta property="og:url" content="/">
            <meta property="og:title" content="Главная - Einsteiners - Сервис организации мероприятий">
            <meta property="og:description" content="Einsteiners - Сервис организации мероприятий">
            <meta property="og:image" content="/images/ogimage.jpg">
            <meta property="og:image:width" content="1200"/>
            <meta property="og:image:height" content="630"/>
        @endif
        {{-- Component: Open Graph ==================================================== --}}
    </head>
    <body id="body" onload="load();">
        {{--
        <div id="uk-preload" class="uk-preload">
            <div class="uk-logo-loader">
                <div class="uk-frame"></div>
            </div>
        </div>
        --}}
        {{-- Component: Modal ==================================================== --}}
        <div id="cookie" class="uk-modal-consent" data-uk-modal>
            <div class="uk-modal-dialog uk-margin-auto-vertical" data-uk-scrollspy="cls: uk-animation-shake">
                <div class="uk-modal-padding">
                    <div class="uk-modal-body" data-uk-overflow-auto>
                        <div id="cookieBody">
                            <div id="cookieloading">
                                <div class="uk-flex uk-flex-middle uk-flex-center" data-uk-spinner></div>  
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-modal-footer uk-text-center">
                    <div class="uk-grid uk-grid-collapse uk-child-width-1-2@xs">
                        <div>
                            <button class="uk-button uk-button-consent uk-modal-close" type="button" onClick="agree_cookie();">{{ __('LanIAgree') }}</button>
                        </div>
                        <div>
                            <button class="uk-button uk-button-decline uk-modal-close" type="button" onClick="notify_cookie();">{{ __('Close') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="consent" class="uk-modal-consent" data-uk-modal>
            <div class="uk-modal-dialog uk-margin-auto-vertical" data-uk-scrollspy="cls: uk-animation-shake">
                <div class="uk-modal-padding">
                    <div class="uk-modal-body" data-uk-overflow-auto>
                        <div id="consentBody">
                            <div id="consentloading">
                                <div class="uk-flex uk-flex-middle uk-flex-center" data-uk-spinner></div>  
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-modal-footer uk-text-center">
                    <div class="uk-grid uk-grid-collapse uk-child-width-1-1@xs">
                        <div>
                            <button class="uk-button uk-button-decline uk-modal-close" type="button">{{ __('Close') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Component: Modal ==================================================== --}}
        {{-- Component: Offcanvas ==================================================== --}}
        <div id="offcanvas" class="uk-offcanvas-large" data-uk-offcanvas="overlay: true; mode: none" style="display: none">
            <div class="uk-offcanvas-bar">
                <button class="uk-offcanvas-close" type="button" data-uk-close></button>
                <div class="uk-panel uk-flex uk-flex-middle">
                    <div class="uk-child-width-1-1@m" data-uk-grid>
                        <div class="uk-no">
                            <div class="uk-scroll-overflow">
                                <div>
                                    <div>
                                        @include('includes.menu')
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="uk-flex uk-flex-left uk-margin-bottom uk-margin-top">
                                    <div class="uk-social" data-src="/images/thame/l-3.png" data-uk-img>
                                        @include('includes.social')
                                    </div>
                                </div>
                                <small>
                                    @include('includes.copyright')
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Component: Offcanvas ==================================================== --}}
        @mobile
        <div class="uk-header-mobile">
            <div class="uk-grid uk-grid-small uk-flex uk-flex-middle" data-uk-grid>
                <div class="uk-width-1-4@xs">
                    <button class="uk-button uk-animation-toggle" data-uk-toggle="target: #offcanvas" type="button">
                        <span class="uk-animation-slide-bottom" data-uk-icon="icon: menu; ratio: 2"></span>
                    </button>
                </div>
                <div class="uk-width-1-2@xs">
                    <div class="uk-logo">
                        <a href="/">
                            <img src="/images/logo.png">
                        </a>
                    </div>
                </div>
                <div class="uk-width-1-4@xs">
                    
                </div>
            </div>
        </div>
        @endmobile
        @desktop
        <div class="uk-header-bar uk-visible@l" data-uk-sticky="top: 100vh; animation: uk-animation-slide-left; offset: 0px">
            @if(App::isLocale('ru'))
                <button class="uk-button uk-animation-toggle" data-uk-toggle="target: #offcanvas" type="button" data-uk-tooltip="title: Меню; pos: right; animation: uk-animation-slide-bottom">
                    <span class="uk-animation-slide-bottom" data-uk-icon="icon: menu; ratio: 2"></span>
                </button>
            @else
                <button class="uk-button uk-animation-toggle" data-uk-toggle="target: #offcanvas" type="button" data-uk-tooltip="title: Menu; pos: right; animation: uk-animation-slide-bottom">
                    <span class="uk-animation-slide-bottom" data-uk-icon="icon: menu; ratio: 2"></span>
                </button>
            @endif
        </div>
        @enddesktop
        @desktop
        <div class="uk-header uk-visible@m @if(View::hasSection('header-style'))@yield('header-style')@endif">
            <div class="uk-container uk-container-center">
                <div class="uk-grid uk-grid-collapse" data-uk-grid>
                    <div class="uk-width-1-4@m">
                        <div class="uk-flex uk-flex-bottom uk-grid-small">
                            <div class="uk-small">
                                <div class="uk-social" data-src="/images/thame/l-3.png" data-uk-img></div>
                                <div class="uk-logo">
                                    <a href="/">
                                        <img src="/images/logo.png">
                                    </a>
                                </div>
                            </div>
                            <div class="uk-text">
                                <div class="uk-social-header uk-margin-bottom">
                                    @include('includes.social')
                                </div>
                                {{ __('LanTitleSite') }}
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-3-4@m">
                        <div class="uk-grid uk-grid-collapse uk-flex uk-flex-middle" data-uk-grid>
                            <div class="uk-width-3-5@m">
                                <nav class="uk-navbar-container uk-navbar-transparent" data-uk-navbar>
                                    <div class="uk-navbar-center">
                                        <ul class="uk-navbar-nav">
                                            <li class="{{ request()->is('list') ? 'uk-active' : null }}">
                                                <a href="{{ route('list') }}">{{ __('lanEventsVendor') }}</a>
                                            </li>
                                            <li class="{{ request()->is('calendarlist') ? 'uk-active' : null }}">
                                                <a href="{{ route('calendarlist') }}">{{ __('LanCalendar') }}</a>
                                            </li>
                                            {{--
                                            <li class="{{ request()->is('service') ? 'uk-active' : null }}">
                                                <a href="{{ route('service') }}">{{ __('LanService') }}</a>
                                            </li>
                                            --}}
                                            {{--
                                            <li class="{{ request()->is('help') ? 'uk-active' : null }}">
                                                <a href="{{ route('help') }}">{{ __('LanHelp') }}</a>
                                            </li>
                                            --}}
                                            <li class="{{ request()->is('birtrhday') ? 'uk-active' : null }}">
                                                <a href="{{ route('birtrhday') }}">{{ __('LanBirtrhday') }}</a>
                                            </li>
                                            {{--
                                            <li class="{{ request()->is('conditions') ? 'uk-active' : null }}">
                                                <a href="{{ route('conditions') }}">{{ __('LanConditions') }}</a>
                                            </li>
                                            --}}
                                            <li class="{{ request()->is('contact') ? 'uk-active' : null }}">
                                                <a href="{{ route('contact') }}">{{ __('LanContact') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                            <div class="uk-width-2-5@m uk-flex uk-flex-middle uk-flex-right uk-grid-small uk-link-element">
                                <div>
                                    <ul class="uk-lang">
                                        <li @if (empty(Cookie::get('lang')) || Cookie::get('lang') == 'en') class="uk-active" @endif>
                                            <a href="{{ url('/lang/en/') }}">EN</a>
                                        </li>
                                        <li @if (Cookie::get('lang') == 'ru') class="uk-active" @endif>
                                            <a href="{{ url('/lang/ru/') }}">RU</a>
                                        </li>
                                    </ul>
                                </div>
                                @auth
                                    <div>
                                        @php
                                            $endDate = date("Y-m-d H:i:s", strtotime('+30 days', strtotime(Auth::user()->past_paymant)));
                                            $subDate = substr($endDate,0,10);
                                            $daysDate = ceil((strtotime($subDate)-time())/86400);
                                        @endphp
                                        @if (Auth::user()->role_id == 1)
                                            @if (Auth::user()->past_paymant !== null && strtotime($endDate) > date('Y-m-d H:i:s'))
                                                <span class="uk-paid" data-uk-tooltip="title: {{ __('lanPaymentFalseDesk1') }} @if($daysDate) {{ $daysDate }} @endif {{ __('lanPaymentFalseDesk2') }}; pos: bottom">
                                                    <span data-uk-icon="star"></span>
                                                </span>
                                            @else
                                                <span class="uk-paid uk-false" data-uk-tooltip="title: {{ __('lanPaymantStatus') }}; pos: bottom">
                                                    <span data-uk-icon="star"></span>
                                                </span>
                                            @endif
                                        @endif
                                    </div>
                                @endauth
                                @auth
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <a class="uk-login-link uk-image-link" href="{{ url('/events') }}">
                                            <div class="uk-profile" data-src="{{ Auth::user()->profile_photo_url }}" data-uk-img></div>
                                            <span class="uk-name">{{ Auth::user()->name }}</span>
                                        </a>
                                    @else
                                        <a class="uk-login-link" href="{{ url('/dashboard') }}"><span data-uk-icon="icon: user"></span> {{ __('LanOffice') }}</a>
                                    @endif
                                    <div data-uk-dropdown="pos: bottom-right; mode: hover">

                                        @if (Auth::user()->role_id == 3)
                                        <strong><small>{{ __('LanAdminTitle') }}</small></strong>
                                        <hr />
                                        <ul class="uk-nav uk-dropdown-nav">
                                            <li>
                                                <a href="{{ route('personal-events') }}">
                                                    <span data-uk-icon="album"></span> {{ __('LanListEvents') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('personal-activities') }}">
                                                    <span data-uk-icon="album"></span> {{ __('LanListMassEvent') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('agreement') }}">
                                                    <span data-uk-icon="album"></span> {{ __('LanListAgreement') }}
                                                </a>
                                            </li>
                                        </ul>
                                        <br />
                                        @endif

                                        <strong><small>{{ __('Manage Account') }}</small></strong>
                                        <hr />
                                        <ul class="uk-nav uk-dropdown-nav">

                                            @if (Auth::user()->role_id == 1)
                                                @if (Auth::user()->past_paymant !== null && strtotime($endDate) > date('Y-m-d H:i:s'))
                                                    <li>
                                                        <a href="{{ route('personal-activities') }}?create=1">
                                                            <span data-uk-icon="plus-circle"></span> {{ __('LanСreateMassEvent') }}
                                                        </a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="#" class="uk-link-muted" data-uk-tooltip="title: {{ __('lanPaymantStatus') }}; pos: bottom">
                                                            <span data-uk-icon="cart"></span> {{ __('LanСreatePayment') }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="uk-link-muted" data-uk-tooltip="title: {{ __('lanPaymantStatus') }}; pos: bottom">
                                                            <span data-uk-icon="plus-circle"></span> {{ __('LanСreateMassEvent') }}
                                                        </a>
                                                    </li>
                                                @endif
                                            @endif
                                            @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                                <li>
                                                    <a href="{{ route('personal-events') }}?create=1">
                                                        <span data-uk-icon="plus-circle"></span> {{ __('LanCreateEvent') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('personal-events') }}">
                                                        <span data-uk-icon="album"></span> {{ __('LanMyEvents') }}
                                                    </a>
                                                </li>
                                            @endif
                                            <li>
                                                <a href="{{ route('profile.show') }}">
                                                    <span data-uk-icon="user"></span> {{ __('Profile') }}
                                                </a>
                                            </li>
                                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                                <li>
                                                    <a href="{{ route('api-tokens.index') }}">
                                                        {{ __('API Tokens') }}
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                        <hr />
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();">
                                                <span data-uk-icon="sign-out"></span> {{ __('Log Out') }}
                                            </x-jet-dropdown-link>
                                        </form>
                                    </div>
                                @else
                                    <a class="uk-login-link" href="{{ route('login') }}" data-uk-toggle=""><span data-uk-icon="icon: sign-in"></span> {{ __('Login') }}</a>
                                    @if (Route::has('register'))
                                        <span>/</span>
                                        <a href="{{ route('register') }}" data-uk-toggle="">{{ __('Register') }}</a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                        <div class="uk-grid uk-grid-collapse uk-flex uk-flex-middle" data-uk-grid>
                            <div class="uk-width-3-5@m">
                                @livewire('search')
                                {{--
                                <div class="uk-search">
                                    <form action="/" method="GET">
                                        <div class="uk-grid uk-grid-small">
                                            <div class="uk-width-2-5@xs">
                                                <div class="uk-search-input">
                                                    <div class="uk-inline">
                                                        <span class="uk-form-icon" data-uk-icon="icon: search"></span>
                                                        <input type="text" class="uk-input" placeholder="{{ __('LanEventOrAutor') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="uk-width-2-5@xs">
                                                <div class="uk-search-input">
                                                    <div class="uk-inline">
                                                        <span class="uk-form-icon" data-uk-icon="icon: location"></span>
                                                        <input type="text" class="uk-input" placeholder="{{ __('LanCity') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="uk-width-1-5@xs">
                                                <input class="uk-button-search" type="submit" value="{{ __('LanSerach') }}">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                --}}
                            </div>
                            <div class="uk-width-2-5@m uk-flex uk-flex-right">
                                @if(Route::is('list'))
                                    <div class="uk-button">
                                        @if (Route::has('login'))
                                            @auth
                                                <a href="{{ route('personal-events') }}?create=1">{{ __('LanCreateEvent') }}</a>
                                            @else
                                                <a href="{{ route('login') }}">{{ __('LanCreateEvent') }}</a>
                                            @endauth
                                        @endif
                                    </div>
                                @else

                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @enddesktop

        @yield('content')

        <div class="uk-buttom">
            <div class="uk-container uk-container-center uk-text-center">
                <div class="uk-grid uk-grid-small uk-child-width-auto uk-flex uk-flex-center" data-uk-grid>
                    <div>
                        <a class="uk-consent" href="#consent" data-uk-toggle onClick="showContent.call(this);event.preventDefault();" data-link="con-consent" data-load="consentloading" data-position="consentBody">{{ __('LanPoli') }}</a>
                    </div>
                    <div>
                        <a class="uk-consent" href="{{ route('conditions') }}">{{ __('lanConditionsLink') }}</a>
                    </div>
                </div>
            </div>
        </div>
        @include('includes.cookie-message')
        {{-- Component: AddScript ==================================================== --}}
        {{--<script src="{{ mix('/js/js.min.js') }}"></script>--}}
        {{-- Component: AddScript ==================================================== --}}
        @if(View::hasSection('script'))
            @yield('script')
        @endif
        {{--
        <script>
            let complite = new CustomEvent("complite", {bubbles: true,});document.querySelector("#uk-preload").dispatchEvent(complite);
        </script>
        --}}
        @livewireScripts
        @if(request()->get('privacy') == 'view')
            <script>
                showContentLink();
                UIkit.modal('#consent').show();
            </script>
        @endif
    </body>
</html>