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
@section('header-style')

@endsection
@section('stylesheet')
    
@endsection
@section('header')
@if(App::isLocale('ru'))
<title>Авторизация</title>
@else
<title>Login</title>
@endif
@endsection
@section('style')
<style>

</style>
@endsection
@section('content')
<x-guest-layout>
    <x-jet-authentication-card>
        <div class="uk-title">
            <h2>{{ __('Log in') }}</h2>
            <img data-src="/images/line.png" data-uk-img>
            <p>{{ __('LanEnterEvent') }}</p>
        </div>
        <div class="uk-content">
            <x-jet-validation-errors class="uk-error" />
            @if (session('status'))
                <div class="uk-status">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="uk-line uk-line-clean">
                    <input id="email" class="uk-input" name="email" type="email" :value="old('email')" onkeydown="inputAction.call(this);inputLine.call(this);" pattern="([A-z0-9_.-]{1,})@([A-z0-9_.-]{1,}).([A-z]{2,8})" required />
                    <label for="email"><span class="uk-icon" data-uk-icon="icon: mail"></span> <i>*</i> {{ __('Email') }}</label>
                    <span class="uk-border"></span>
                </div>
                <br />
                <div class="uk-line uk-line-clean">
                    <input id="password" class="uk-input" name="password" type="password" onkeydown="inputAction.call(this);inputLine.call(this);" pattern="[A-z0-9]{6,}" required autocomplete="current-password" />
                    <label for="password"><span class="uk-icon" data-uk-icon="icon: lock"></span> <i>*</i> {{ __('Password') }}</label>
                    <span class="uk-border"></span>
                </div>
                <br />
                <div class="uk-grid uk-child-width-1-2@m uk-grid-small uk-flex uk-flex-middle" data-uk-grid>
                    <div>
                        <label for="remember_me" class="flex items-center">
                            <x-jet-checkbox id="remember_me" name="remember" />
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>
                    <div class="uk-flex uk-flex-right">
                        @if (Route::has('password.request'))
                            <a class="uk-link" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                </div>
                <br />
                <div class="uk-text-center">
                    <div class="uk-button">
                        <input type="submit" value="{{ __('Log in') }}">
                    </div>
                </div>
                <br />
                <hr />
                <br />
                <div class="uk-subtitle uk-text-center">
                    <span>{{ __('lanRegistrAccount') }}<a href="{{ route('register') }}">{{ __('Register') }}</a></span>
                </div>
                <br />
                <div class="uk-block-notification uk-text-center">
                    {{ __('LanPoli1') }} <a class="uk-consent" href="#consent" data-uk-toggle onClick="showContent.call(this);event.preventDefault();" data-link="con-consent" data-load="consentloading" data-position="consentBody">{{ __('LanPoli2') }}</a>.
                </div>
            </form>
        </div>
        {{--
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" onClick="inputAction.call(this);inputLine.call(this);" pattern="([A-z0-9_.-]{1,})@([A-z0-9_.-]{1,}).([A-z]{2,8})" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
        --}}
    </x-jet-authentication-card>
</x-guest-layout>
@endsection