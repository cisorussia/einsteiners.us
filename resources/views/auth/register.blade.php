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
        <title>Регистрация</title>
    @else
        <title>Registration</title>
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
            <h2>{{ __('LanEnterGuest') }}</h2>
            <img data-src="/images/line.png" data-uk-img>
            <p>{{ __('LanEnterRegistration') }}</p>
        </div>
        <div class="uk-content">
            <x-jet-validation-errors class="uk-error" />
            <form class="uk-user" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="uk-flex uk-flex-middle uk-grid-small" data-uk-grid>
                    <div class="uk-width-auto@m">
                        <span class="uk-title-radio">{{ __('LanAccount') }}</span>
                    </div>
                    <div class="uk-width-expand@m">
                        <div class="uk-radio-panel uk-grid uk-child-width-1-2@m uk-grid-small uk-flex uk-flex-middle" data-uk-grid>
                            <div>
                                <input type="radio" id="role_1" name="role_id" value="1">
                                <label for="role_1">{{ __('LanVendor') }} <span data-uk-icon="icon: question" data-uk-tooltip="title: {{ __('LanVendorDes') }}; pos: bottom"></span></label>
                            </div>
                            <div>
                                <input type="radio" id="role_2" name="role_id" value="2" checked>
                                <label for="role_2">{{ __('LanPrivate') }} <span data-uk-icon="icon: question" data-uk-tooltip="title: {{ __('LanPrivateDes') }}; pos: bottom"></span></label>
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <div class="uk-flex uk-flex-middle uk-grid-small" data-uk-grid>
                    <div class="uk-width-auto@m">
                        <span class="uk-title-radio">{{ __('LanGendor') }}</span>
                    </div>
                    <div class="uk-width-expand@m">
                        <div class="uk-radio-panel uk-grid uk-child-width-1-2@m uk-grid-small uk-flex uk-flex-middle" data-uk-grid>
                            <div>
                                <input type="radio" id="gender_1" name="gender_id" value="1" checked>
                                <label for="gender_1">{{ __('LanGendorMal') }}</label>
                            </div>
                            <div>
                                <input type="radio" id="gender_2" name="gender_id" value="2">
                                <label for="gender_2">{{ __('LanGendorWom') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <div class="uk-line uk-line-clean">
                    <input id="name" class="uk-input" name="name" type="text" :value="old('name')" onkeydown="inputAction.call(this);inputLine.call(this);" required pattern="[А-Яа-яЁёA-z ]{2,}" />
                    <label for="name"><span class="uk-icon" data-uk-icon="icon: user"></span> <i>*</i> {{ __('Name') }}</label>
                    <span class="uk-border"></span>
                </div>
                <br />
                @if (App::isLocale('ru'))
                    <div class="uk-line uk-line-clean">
                        <input id="return-phone" name="phone" type="tel" class="uk-input uk-mask" onFocus="maskPhone.call(this);" onkeydown="inputAction.call(this);inputLine.call(this);" onClick="inputAction.call(this);inputLine.call(this);" placeholder="+7 (9__) ___-__-__" pattern="\+7\s?[\(]{0,1}9[0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}" required="required">
                        <label for="return-phone"><span class="uk-icon" data-uk-icon="icon: receiver"></span> <i>*</i> {{ __('LanPhone') }}</label>
                        <span class="uk-border"></span>
                    </div>
                @elseif (App::isLocale('en'))
                    <div class="uk-line uk-line-clean">
                        <input id="return-phone" name="phone" type="tel" class="uk-input uk-mask" onFocus="maskPhone.call(this);" onkeydown="inputAction.call(this);inputLine.call(this);" onClick="inputAction.call(this);inputLine.call(this);" placeholder="+1 (___) ___-__-__" pattern="\+1\s?[\(]{0,1}[0-9][0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}" required="required">
                        <label for="return-phone"><span class="uk-icon" data-uk-icon="icon: receiver"></span> <i>*</i> {{ __('LanPhone') }}</label>
                        <span class="uk-border"></span>
                    </div>
                @endif
                <br />
                <div class="uk-line uk-line-clean">
                    <input id="email" class="uk-input" name="email" type="email" :value="old('email')" onkeydown="inputAction.call(this);inputLine.call(this);" pattern="([A-z0-9_.-]{1,})@([A-z0-9_.-]{1,}).([A-z]{2,8})" required />
                    <label for="email"><span class="uk-icon" data-uk-icon="icon: mail"></span> <i>*</i> {{ __('Email') }}</label>
                    <span class="uk-border"></span>
                </div>
                <br />
                <div class="uk-line uk-line-clean">
                    <input id="password" class="uk-input" name="password" type="password" onkeydown="inputAction.call(this);inputLine.call(this);" pattern="[A-z0-9]{8,}" required autocomplete="new-password" />
                    <label for="password"><span class="uk-icon" data-uk-icon="icon: lock"></span> <i>*</i> {{ __('Password') }}</label>
                    <span class="uk-border"></span>
                </div>
                <br />
                <div class="uk-line uk-line-clean">
                    <input id="password_confirmation" class="uk-input" name="password_confirmation" type="password" onkeydown="inputAction.call(this);inputLine.call(this);" pattern="[A-z0-9]{8,}" required autocomplete="new-password" />
                    <label for="password_confirmation"><span class="uk-icon" data-uk-icon="icon: lock"></span> <i>*</i> {{ __('Confirm Password') }}</label>
                    <span class="uk-border"></span>
                </div>
                <br />
                <div class="uk-text-center">
                    <div class="uk-button">
                        <input type="submit" value="{{ __('Register') }}">
                    </div>
                    <br />
                    <br />
                    <a class="uk-link" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                </div>
                <br />
                <hr />
                <br />
                <div class="uk-block-notification uk-text-center">
                    {{ __('LanPoli1') }} <a class="uk-consent" href="#consent" data-uk-toggle onClick="showContent.call(this);event.preventDefault();" data-link="con-consent" data-load="consentloading" data-position="consentBody">{{ __('LanPoli2') }}</a>.
                </div>
                {{--
                <div>
                    <x-jet-label for="name" value="{{ __('Name') }}" />
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>
                <div class="mt-4">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" onClick="inputAction.call(this);inputLine.call(this);" pattern="([A-z0-9_.-]{1,})@([A-z0-9_.-]{1,}).([A-z]{2,8})" required />
                </div>
                <div class="mt-4">
                    <x-jet-label for="password" value="{{ __('Password') }}" />
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                </div>
                <div class="mt-4">
                    <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>
                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-jet-label for="terms">
                            <div class="flex items-center">
                                <x-jet-checkbox name="terms" id="terms"/>

                                <div class="ml-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-jet-label>
                    </div>
                @endif
                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-jet-button class="ml-4">
                        {{ __('Register') }}
                    </x-jet-button>
                </div>
                --}}
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
@endsection
