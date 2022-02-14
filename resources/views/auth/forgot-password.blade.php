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
<title>Напомнить пароль</title> 
@else
<title>Remind me of my password</title>
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
            <h2>{{ __('Email Password Reset Link') }}</h2>
            <img data-src="/images/line.png" data-uk-img>
            <div>{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</div>
        </div>
        <div class="uk-content">
            <x-jet-validation-errors class="uk-error" />
            @if (session('status'))
                <div class="uk-status">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}">
                <div class="uk-line uk-line-clean">
                    <input id="email" class="uk-input" name="email" type="email" :value="old('email')" onkeydown="inputAction.call(this);inputLine.call(this);" pattern="([A-z0-9_.-]{1,})@([A-z0-9_.-]{1,}).([A-z]{2,8})" required />
                    <label for="email"><span class="uk-icon" data-uk-icon="icon: mail"></span> <i>*</i> {{ __('Email') }}</label>
                    <span class="uk-border"></span>
                </div>
                <br />
                <div class="uk-text-center">
                    <div class="uk-button">
                        <input type="submit" value="{{ __('Email Password Reset Link') }}">
                    </div>
                </div>
            </form>
        </div>
        {{--
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
        <x-jet-validation-errors class="mb-4" />
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Email Password Reset Link') }}
                </x-jet-button>
            </div>
        </form>
        --}}
    </x-jet-authentication-card>
</x-guest-layout>
@endsection
