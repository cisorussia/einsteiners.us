@extends('../template/layout')
@section('ogmeta')
    <meta property="og:url" content="{{ route('home') }}">
    @if(App::isLocale('ru'))
        <meta property="og:title" content="{{ $event->name }} - Einsteiners - Сервис организации мероприятий">
        <meta property="og:description" content="{{ $event->name }} - Einsteiners - Сервис организации мероприятий">
    @else
        <meta property="og:title" content="{{ $event->name }} - Einsteiners - Event Management Service">
        <meta property="og:description" content="{{ $event->name }} - Einsteiners - Event Management Service">
    @endif
    <meta property="og:image" content="{{ route('home') }}/images/ogimage.jpg">
@endsection
@section('stylesheet')
    
@endsection
@section('header')
@if(App::isLocale('ru'))
<title>{{ $event->name }} - Einsteiners - Сервис организации мероприятий</title>
@else
<title>{{ $event->name }} - Einsteiners - Event Management Service</title>
@endif
@endsection
@section('style')

@endsection
@section('script')
<script>
    function DescriptionGift () {
        UIkit.notification({
            message: this.getAttribute('data-description'),
            status: 'primary uk-message-notification',
            pos: 'bottom-center',
            timeout: 5000
        });
    };
</script>
@endsection
@section('content')
@php
    $date = new DateTime($event->date_event);
@endphp
<div class="uk-screen uk-screen-page uk-screen-events uk-screen-view">
    <div class="uk-container uk-container-center">
        <div>
            <div class="uk-grid-small" data-uk-grid data-uk-height-match="target: .uk-poster">
                <div class="uk-width-3-4@m">
                    <div class="uk-poster" data-src="{{ route('storage') }}/{{ $event->cover_path }}" data-uk-img></div>
                </div>
                <div class="uk-width-1-4@m">
                    <div class="uk-poster">
                        <div class="uk-autor">
                            <div class="uk-title">
                                {{--
                                <h2>Автор</h2>
                                --}}
                                <img data-src="/images/line.png" data-uk-img>
                            </div>
                            <div>
                                @if($autor->profile_photo_path)
                                    <div class="uk-autor-image" data-src="{{ route('storage') }}/{{ $autor->profile_photo_path }}" data-uk-img></div>
                                @else
                                    <div class="uk-autor-image uk-clean">
                                        <span data-uk-icon="icon: user; ratio: 2"></span>
                                    </div>
                                @endif
                            </div>
                            <strong>{{ $autor->name }}</strong>
                        </div>
                        <div class="uk-content-colum">
                            <div class="uk-date @if($event->date_event < date('Y-m-d H:i:s')) uk-passed @endif uk-flex uk-flex-middle" data-uk-tooltip="title: {{ __('lanEventDate') }}; pos: bottom">
                                <span data-uk-icon="icon: calendar"></span> <span>@php echo date_format($date,"j.m.Y"); @endphp</span>
                            </div>
                        </div>
                        @if($event->date_event > date('Y-m-d H:i:s'))
                            <div class="uk-panel-time">
                                <div class="uk-grid-small uk-child-width-auto" data-uk-grid data-uk-countdown="date: @php echo date_format($date,"Y-m-d") . "T" . date_format($date,"h:m:s"); @endphp">
                                    <div>
                                        <div class="uk-countdown-number uk-countdown-days"></div>
                                        <div class="uk-countdown-label uk-margin-small uk-text-center">{{ __('LanDays') }}</div>
                                    </div>
                                    <div class="uk-countdown-separator">:</div>
                                    <div>
                                        <div class="uk-countdown-number uk-countdown-hours"></div>
                                        <div class="uk-countdown-label uk-margin-small uk-text-center">{{ __('LanHourse') }}</div>
                                    </div>
                                    <div class="uk-countdown-separator">:</div>
                                    <div>
                                        <div class="uk-countdown-number uk-countdown-minutes"></div>
                                        <div class="uk-countdown-label uk-margin-small uk-text-center">{{ __('LanMinutes') }}</div>
                                    </div>
                                    <div class="uk-countdown-separator">:</div>
                                    <div>
                                        <div class="uk-countdown-number uk-countdown-seconds"></div>
                                        <div class="uk-countdown-label uk-margin-small uk-text-center">{{ __('LanSecond') }}</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="uk-width-1-1@m">
                    <div class="uk-content">
                        <div class="uk-text">
                            <h1>{{ $event->name }}</h1>
                            @if($event->description)
                                <p>{{ $event->description }}</p>
                            @endif
                        </div>
                        @if(isset($gifts[0]))
                            <div class="uk-gifts">
                                <div class="uk-title">
                                    <h4>Что подарить?</h4>
                                    <img data-src="/images/line.png" data-uk-img>
                                </div>
                                <div data-uk-slider="finite: true">
                                    <ul class="uk-slider-items uk-grid-small uk-flex uk-flex-center" data-uk-grid data-uk-height-match="target: > li > .uk-card">
                                        @foreach ($gifts as $gift)
                                            @if ($gift->event_id == $event->id)
                                                <li>
                                                    <div class="uk-card uk-gift">
                                                        @if($gift->cover_path)
                                                            <div class="uk-gift-image">
                                                                <div data-src="{{ route('storage') }}/{{ $gift->cover_path }}" data-uk-img></div>
                                                            </div>
                                                        @endif
                                                        <p>{{ $gift->name }}</p>
                                                        <div class="uk-grid-small uk-flex uk-flex-middle uk-flex-center" data-uk-grid>
                                                            @if($gift->link_market)
                                                                <div>
                                                                    <a class="uk-button" href="{{ $gift->link_market }}" target="_blank" data-uk-tooltip="title: Ссылка на интернет-магазин; pos: bottom">
                                                                        <span data-uk-icon="link"></span>
                                                                    </a>
                                                                </div>
                                                            @endif
                                                            @if($gift->description)
                                                                <div>
                                                                    <button class="uk-button" data-description="<h2>{{ $gift->name }}</h2><br /> {{ $gift->description }}" onclick="DescriptionGift.call(this)" data-uk-tooltip="title: Описание подарка; pos: bottom">
                                                                        <span data-uk-icon="question"></span>
                                                                    </button>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        @if(isset($guests[0]))
                            <div class="uk-gifts uk-guest">
                                <div class="uk-title">
                                    <h4>Список гостей</h4>
                                    <img data-src="/images/line.png" data-uk-img>
                                </div>
                                <div class="uk-panel-guest">
                                    <div class="uk-grid-small uk-child-width-1-2@m" data-uk-grid data-uk-height-match="target: > li > .uk-card">
                                        @foreach ($guests as $guest)
                                            @if ($guest->event_id == $event->id)
                                                <div>
                                                    <div class="uk-card uk-gift uk-guest">
                                                        <div class="uk-grid-small uk-flex uk-flex-middle" data-uk-grid>
                                                            <div class="uk-width-expand">
                                                                <p>{{ $guest->name }} - <strong>{{ $guest->role }}</strong></p>
                                                            </div>
                                                            @auth
                                                                @if($users->email == $guest->email)
                                                                    <div class="uk-child-auto">
                                                                        <div class="uk-grid-small uk-flex uk-flex-middle uk-flex-center" data-uk-grid>
                                                                            @if($guest->task)
                                                                                <div>
                                                                                    <button class="uk-button" data-description="<h2>{{ $guest->name }}</h2><br /> {{ $guest->task }}" onclick="DescriptionGift.call(this)" data-uk-tooltip="title: Задание; pos: bottom">
                                                                                        <span data-uk-icon="question"></span>
                                                                                    </button>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <div class="uk-child-auto">
                                                                        <div class="uk-grid-small uk-flex uk-flex-middle uk-flex-center" data-uk-grid>
                                                                            @if($guest->task)
                                                                                <div>
                                                                                    <button class="uk-button uk-desable" data-uk-tooltip="title: Авторизуйтесь чтобы увидите Ваше задание: Используя email указанный в приглашении; pos: bottom">
                                                                                        <span data-uk-icon="question"></span>
                                                                                    </button>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @endif

                                                            @endauth
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection