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
                            <div class="uk-date @if($event->date_event < \Carbon\Carbon::now()->timestamp) uk-passed @endif uk-flex uk-flex-middle">
                                <span data-uk-icon="icon: calendar"></span> <span>@php echo Carbon\Carbon::createFromTimestamp($event->date_event)->format('d.m.Y'); @endphp</span>
                            </div>
                        </div>
                        @if($event->date_event > \Carbon\Carbon::now()->timestamp)
                            <div class="uk-panel-time">
                                <div class="uk-grid-small uk-child-width-auto" data-uk-grid data-uk-countdown="date: @php echo \Carbon\Carbon::createFromTimestamp($event->date_event)->format('Y-m-d'). "T" . $event->date_time; @endphp">
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
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection