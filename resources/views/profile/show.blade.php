@extends('../template/layout')
@section('ogmeta')
    <meta property="og:url" content="{{ route('home') }}">
    <meta property="og:title" content="Профиль - Einsteiners - Сервис организации мероприятий">
    <meta property="og:description" content="Профиль - Einsteiners - Сервис организации мероприятий">
    <meta property="og:image" content="{{ route('home') }}/images/ogimage.jpg">
@endsection
@section('stylesheet')
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
@endsection
@section('header')     
    @if(App::isLocale('ru'))
    <title>Профиль - Einsteiners - Сервис организации мероприятий</title>
    @else
    <title>Profil - Einsteiners - Event Management Service</title>
    @endif
@endsection
@section('style')
    
@endsection
@section('script')
    <script src="{{ mix('js/app.js') }}" defer></script>
@endsection
@section('content')

<div class="uk-container uk-container-center">
    <br /><br /><br />
    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
        @livewire('profile.update-profile-information-form')
        <x-jet-section-border />
    @endif

    

    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
        <div class="mt-10 sm:mt-0">
            @livewire('profile.update-password-form')
        </div>
        <x-jet-section-border />
    @endif
    @if (!Laravel\Fortify\Features::canManageTwoFactorAuthentication())
        <div class="mt-10 sm:mt-0">
            @livewire('profile.two-factor-authentication-form')
        </div>

        <x-jet-section-border />
    @endif
    <div class="mt-10 sm:mt-0">
        @livewire('profile.logout-other-browser-sessions-form')
    </div>
    @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
        <x-jet-section-border />

        <div class="mt-10 sm:mt-0">
            @livewire('profile.delete-user-form')
        </div>
    @endif
</div>


{{--
<x-app-layout>
    {{--
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    -}}
    
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')
                <x-jet-section-border />
            @endif
            
            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-jet-section-border />
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-jet-section-border />
            @endif

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-jet-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
--}}
@endsection