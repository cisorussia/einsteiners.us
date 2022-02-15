@extends('../template/layout')
@section('ogmeta')
    <meta property="og:url" content="{{ route('home') }}">
    @if(App::isLocale('ru'))
        <meta property="og:title" content="Einsteiners - Сервис организации мероприятий">
        <meta property="og:description" content="Einsteiners - Сервис организации мероприятий">
    @else
        <meta property="og:title" content="Einsteiners - Event Management Service">
        <meta property="og:description" content="Einsteiners - Event Management Service">
    @endif
    <meta property="og:image" content="{{ route('home') }}/images/ogimage.jpg">
@endsection
@section('header-style')uk-header-margin @endsection
@section('stylesheet')
    
@endsection
@section('header')
    @if(App::isLocale('ru'))
    <title>Einsteiners - Сервис организации мероприятий</title>
    {{--
    <meta name="description" content="Описание"/>
    <meta name="keywords" content="Ключевые слова"/>
    --}}  
    @else
    <title>Einsteiners - Event Management Service</title>
    {{--
    <meta name="description" content="Описание"/>
    <meta name="keywords" content="Ключевые слова"/>
    --}}
    @endif
@endsection
@section('style')
<style>

</style>
@endsection
@section('content')
<div class="uk-screen-slider uk-video-screen">
    @desktop
    <div class="uk-inline">
        <div class="uk-cover-container uk-flex uk-flex-middle uk-flex-center">
            <video loop muted playsinline data-uk-video="autoplay: inview">
                <source src="/storage/upload/content/background.mp4" type="video/mp4">
            </video>
        </div>
        <div class="uk-overlay uk-position-cover">
            <div class="uk-position-center">
                <div class="uk-container uk-container-center">
                    <h1><strong>{{ __('LanHomeTitle-1-1') }}</strong> - {{ __('LanHomeTitle-1-2') }}</h1>
                    <ul class="uk-list">
                        <li>{{ __('LanHomeSubTitle-1-1') }}</li>
                        <li>{{ __('LanHomeSubTitle-1-2') }}</li>
                        <li>{{ __('LanHomeSubTitle-1-2') }}</li>
                    </ul>
                    @if (Route::has('login'))
                        @auth
                            <div class="uk-button-card uk-button">
                                <a href="{{ route('personal-events') }}?create=1">{{ __('LanStarNow') }}</a>
                            </div>
                        @else
                            <div class="uk-button-card uk-button">
                                <a href="{{ route('login') }}">{{ __('LanStarNow') }}</a>
                            </div>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </div>
    @enddesktop
    @mobile
    <div class="uk-inline uk-text-center">
        <div class="uk-cover-container uk-flex uk-flex-middle uk-flex-center">
            <video loop muted playsinline data-uk-video="autoplay: inview">
                <source src="/storage/upload/content/background.mp4" type="video/mp4">
            </video>
        </div>
        <div class="uk-overlay uk-position-cover">
            <div class="uk-position-center">
                <div class="uk-container uk-container-center">
                    <h1><strong>{{ __('LanHomeTitle-1-1') }}</strong> - {{ __('LanHomeTitle-1-2') }}</h1>
                    <ul class="uk-list">
                        <li>{{ __('LanHomeSubTitle-1-1') }}</li>
                        <li>{{ __('LanHomeSubTitle-1-2') }}</li>
                        <li>{{ __('LanHomeSubTitle-1-2') }}</li>
                    </ul>
                    @if (Route::has('login'))
                        @auth
                            <div class="uk-button-card uk-button">
                                <a href="{{ route('personal-events') }}?create=1">{{ __('LanStarNow') }}</a>
                            </div>
                        @else
                            <div class="uk-button-card uk-button">
                                <a href="{{ route('login') }}">{{ __('LanStarNow') }}</a>
                            </div>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endmobile
</div>
{{--
<div class="uk-screen uk-screen-slider">
    <div class="uk-position-relative" data-uk-slider>
        <ul class="uk-slider-items uk-child-width-1-1">
            <li>
                <div class="uk-container uk-container-center">
                    <div class="uk-child-width-1-2@m uk-grid-small uk-flex uk-flex-middle" data-uk-grid>
                        <div>
                            <h1><strong>{{ __('LanHomeTitle-1-1') }}</strong> - {{ __('LanHomeTitle-1-2') }}</h1>
                            @mobile
                                <div class="uk-image">
                                    <img data-src="/images/thame/persona-2.png" data-uk-img>
                                </div>
                            @endmobile
                            <ul class="uk-list">
                                <li>{{ __('LanHomeSubTitle-1-1') }}</li>
                                <li>{{ __('LanHomeSubTitle-1-2') }}</li>
                                <li>{{ __('LanHomeSubTitle-1-2') }}</li>
                            </ul>
                            @if (Route::has('login'))
                                @auth
                                    <div class="uk-button-card uk-button">
                                        <a href="{{ route('personal-events') }}?create=1">{{ __('LanStarNow') }}</a>
                                    </div>
                                @else
                                    <div class="uk-button-card uk-button">
                                        <a href="{{ route('login') }}">{{ __('LanStarNow') }}</a>
                                    </div>
                                @endauth
                            @endif
                        </div>
                        @desktop
                        <div>
                            <div class="uk-image">
                                <img data-src="/images/thame/persona-2.png" data-uk-img>
                            </div>
                        </div>
                        @enddesktop
                    </div>
                </div>
            </li>
            <li>
                <div class="uk-container uk-container-center">
                    <div class="uk-child-width-1-2@m uk-grid-small uk-flex uk-flex-middle" data-uk-grid>
                        <div>
                            <h1><strong>{{ __('LanHomeTitle-1-1') }}</strong> - {{ __('LanHomeTitle-1-2') }}</h1>
                            @mobile
                                <div class="uk-image">
                                    <img data-src="/images/thame/persona-1.png" data-uk-img>
                                </div>
                            @endmobile
                            <ul class="uk-list">
                                <li>{{ __('LanHomeSubTitle-1-1') }}</li>
                                <li>{{ __('LanHomeSubTitle-1-2') }}</li>
                                <li>{{ __('LanHomeSubTitle-1-2') }}</li>
                            </ul>
                            @if (Route::has('login'))
                                @auth
                                    <div class="uk-button-card uk-button">
                                        <a href="{{ route('personal-events') }}?create=1">{{ __('LanStarNow') }}</a>
                                    </div>
                                @else
                                    <div class="uk-button-card uk-button">
                                        <a href="{{ route('login') }}">{{ __('LanStarNow') }}</a>
                                    </div>
                                @endauth
                            @endif
                        </div>
                        @desktop
                        <div>
                            <div class="uk-image">
                                <img data-src="/images/thame/persona-1.png" data-uk-img>
                            </div>
                        </div>
                        @enddesktop
                    </div>
                </div>
            </li>
        </ul>
        <ul class="uk-slider-nav uk-dotnav uk-grid uk-grid-collapse"></ul>
    </div>
</div>
--}}
<div class="uk-screen uk-screen-catalog">
    <div class="uk-container uk-container-center">
        <div class="uk-title">
            <h2>{{ __('LanHomeScreen-2-Title-1') }}</h2>
            <img data-src="/images/line.png" data-uk-img>
            <p>{{ __('LanHomeScreen-2-Title-2') }}</p>
        </div>
    </div>

    <livewire:view.activitie-component>

    <div class="uk-number-section uk-container uk-container-center">
        <div class="uk-grid uk-grid-small uk-flex uk-flex-middle" data-uk-grid>
            <div class="uk-width-2-5@m">
                <div class="uk-button-card uk-button uk-button-mobile-large">
                    <a href="/list">{{ __('LanMoreView') }}</a>
                </div>
            </div>
            <div class="uk-width-3-5@m">
                <div class="uk-grid uk-grid-small uk-child-width-1-3@m uk-flex uk-flex-middle" data-uk-grid>
                    <div>
                        <div class="uk-panel">
                            <span data-uk-icon="icon: album; ratio: 1.5"></span>
                            <div>
                                <span class="uk-number">231</span>
                                <small>{{ __('LanEvents') }} {{ date("M Y") }}</small>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="uk-panel">
                            <span data-uk-icon="icon: users; ratio: 1.5"></span>
                            <div>
                                <span class="uk-number">138</span>
                                <small>{{ __('LanPartners') }}</small>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="uk-panel">
                            <span data-uk-icon="icon: location; ratio: 1.5"></span>
                            <div>
                                <span class="uk-number">1117</span>
                                <small>{{ __('LanEventsCity') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="uk-screen uk-screen-about">
    <div class="uk-title-background" data-src="/images/thame/line-icon.png" data-uk-img>
        <div class="uk-title">
            <h2>{{ __('LanCompany') }}</h2>
            <img data-src="/images/line.png" data-uk-img>
            <p>{{ __('LanHomeScreen-3-Tittle-1') }}</p>
        </div>
    </div>
    <div class="uk-grid uk-grid-collapse uk-child-width-1-2@m uk-flex uk-flex-middle" data-uk-grid>
        @mobile
        <div>
            <div class="uk-screen-panel" data-src="/images/thame/screen.jpg" data-uk-img>
                <ul class="uk-switcher uk-screen-list">
                    <li>
                        <img data-src="/images/thame/screen-1.jpg" data-uk-img>
                    </li>
                    <li>
                        <img data-src="/images/thame/screen-1.jpg" data-uk-img>
                    </li>
                    <li>
                        <img data-src="/images/thame/screen-1.jpg" data-uk-img>
                    </li>
                    <li>
                        <img data-src="/images/thame/screen-1.jpg" data-uk-img>
                    </li>
                    <li>
                        <img data-src="/images/thame/screen-1.jpg" data-uk-img>
                    </li>
                </ul>
            </div>
        </div>
        @endmobile
        <div class="uk-image uk-flex uk-flex-right@m uk-flex-center" data-src="/images/thame/l-7.png" data-uk-img>
            <ul class="uk-subnav" data-uk-switcher="connect: .uk-screen-list; animation: uk-animation-slide-left, uk-animation-slide-right">
                <li>
                    <a href="#">
                        <h4>{{ __('LanHomeAboutT-1-1') }}</h4>
                        <p>{{ __('LanHomeAboutT-1-2') }}</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <h4>{{ __('LanHomeAboutT-2-1') }}</h4>
                        <p>{{ __('LanHomeAboutT-2-2') }}</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <h4>{{ __('LanHomeAboutT-3-1') }}</h4>
                        <p>{{ __('LanHomeAboutT-3-2') }}</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <h4>{{ __('LanHomeAboutT-4-1') }}</h4>
                        <p>{{ __('LanHomeAboutT-4-2') }}</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <h4>{{ __('LanHomeAboutT-5-1') }}</h4>
                        <p>{{ __('LanHomeAboutT-5-2') }}</p>
                    </a>
                </li>
            </ul>
        </div>
        @desktop
        <div>
            <div class="uk-screen-panel" data-src="/images/thame/screen.jpg" data-uk-img>
                <ul class="uk-switcher uk-screen-list">
                    <li>
                        <img data-src="/images/thame/screen-1.jpg" data-uk-img>
                    </li>
                    <li>
                        <img data-src="/images/thame/screen-1.jpg" data-uk-img>
                    </li>
                    <li>
                        <img data-src="/images/thame/screen-1.jpg" data-uk-img>
                    </li>
                    <li>
                        <img data-src="/images/thame/screen-1.jpg" data-uk-img>
                    </li>
                    <li>
                        <img data-src="/images/thame/screen-1.jpg" data-uk-img>
                    </li>
                </ul>
            </div>
        </div>
        @enddesktop
    </div>
</div>

<livewire:view.partner-component>
{{--
<div class="uk-screen uk-screen-partner">
    <div class="uk-container uk-container-center">
        <div class="uk-title">
            <h2>{{ __('LanPartnerList') }}</h2>
            <img data-src="/images/line.png" data-uk-img>
            <p>{{ __('LanHomeScreen-4-Subtitle') }}</p>
        </div>
    </div>
    <div data-uk-slider="center: true">
        <ul class="uk-slider-items uk-child-width-1-6@m uk-child-width-1-2@xs">
            <li>
                <div class="uk-image" data-src="/images/partner/1.png" data-uk-img></div>
            </li>
            <li>
                <div class="uk-image" data-src="/images/partner/1.png" data-uk-img></div>
            </li>
            <li>
                <div class="uk-image" data-src="/images/partner/1.png" data-uk-img></div>
            </li>
            <li>
                <div class="uk-image" data-src="/images/partner/1.png" data-uk-img></div>
            </li>
            <li>
                <div class="uk-image" data-src="/images/partner/1.png" data-uk-img></div>
            </li>
            <li>
                <div class="uk-image" data-src="/images/partner/1.png" data-uk-img></div>
            </li>
            <li>
                <div class="uk-image" data-src="/images/partner/1.png" data-uk-img></div>
            </li>
            <li>
                <div class="uk-image" data-src="/images/partner/1.png" data-uk-img></div>
            </li>
            <li>
                <div class="uk-image" data-src="/images/partner/1.png" data-uk-img></div>
            </li>
            <li>
                <div class="uk-image" data-src="/images/partner/1.png" data-uk-img></div>
            </li>
        </ul>
    </div>
</div>
--}}
<div class="uk-screen uk-screen-bootom uk-text-left@m uk-text-center@xs">
    <div class="uk-container uk-container-center">
        <div class="uk-grid uk-grid-small uk-child-width-1-2@m uk-flex uk-flex-middle" data-uk-grid>
            @desktop
            <div>
                <div class="uk-image">
                    <img data-src="/images/thame/persona-1.png" data-uk-img>
                </div>
            </div>
            @enddesktop
            <div>
                <h2><span>{{ __('LanHomeScreen-5-Tittle-1') }}</span> <span>{{ __('LanCompany') }} {{ __('LanNow') }}</span></h2>
                <ul>
                    <li>{{ __('LanHomeSubTitle-1-1') }}</li>
                    <li>{{ __('LanHomeSubTitle-1-2') }}</li>
                    <li>{{ __('LanHomeSubTitle-1-2') }}</li>
                </ul>
                @if (Route::has('login'))
                    @auth
                        <div class="uk-button-card uk-button">
                            <a href="{{ route('personal-events') }}?create=1">{{ __('LanCreateEvent') }}</a>
                        </div>
                    @else
                        <div class="uk-button-card uk-button">
                            <a href="{{ route('login') }}">{{ __('LanCreateEvent') }}</a>
                        </div>
                    @endauth
                @endif
            </div>
            @mobile
            <div>
                <div class="uk-image">
                    <img data-src="/images/thame/persona-1.png" data-uk-img>
                </div>
            </div>
            @endmobile
        </div>
    </div>
</div>
@endsection