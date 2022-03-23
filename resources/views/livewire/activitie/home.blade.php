<div id="component">
    <div class="uk-container uk-container-center">
        <ul class="uk-subnav uk-grid-small uk-flex uk-flex-center" data-uk-grid>
            <li @if($selected_categorie == 0) class="uk-active" @endif wire:click="selectedCategorie(0)">
                <span href="#">{{ __('CatAll') }}</span>
            </li>
            @foreach ($categories as $categorie)
                <li @if($selected_categorie == $categorie->id) class="uk-active" @endif>
                    <span wire:click="selectedCategorie({{ $categorie->id }})">
                        {{ __($categorie->name) }}
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="uk-slider" data-uk-slider="center: true; finite: false; sets: true">
        <div class="uk-position-relative">
            <div class="uk-loading" wire:loading.flex>
                <span class="uk-spinner uk-icon" data-uk-spinner wire:ignore></span>
            </div>
            <ul class="uk-slider-items uk-grid uk-grid-small uk-child-width-1-4@m uk-child-width-1-2@xs" data-uk-grid data-uk-height-match="target: > li > .uk-card">
                @foreach ($activities as $activitie)
                <li>
                    <div class="uk-card">
                        <div class="uk-image" data-src="{{ route('storage') }}/{{ $activitie->cover_path }}" data-uk-img wire:ignore>
                            @if($activitie->age)
                                <span>{{ $activitie->age }}</span>
                            @endif
                        </div>
                        @if($activitie->date_event > \Carbon\Carbon::now()->timestamp)
                            <div class="uk-panel-time" wire:ignore>
                                <div class="uk-grid uk-grid-small uk-child-width-auto" data-uk-grid data-uk-countdown="date: @php echo \Carbon\Carbon::createFromTimestamp($activitie['date_event'])->format('Y-m-d'). "T" . $activitie['date_time']; @endphp">
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
                        <div class="uk-content">
                            <div class="uk-date @if($activitie->date_event < \Carbon\Carbon::now()->timestamp) uk-passed @endif uk-flex uk-flex-middle">
                                <span data-uk-icon="icon: calendar" wire:ignore></span> <span>@php echo \Carbon\Carbon::createFromTimestamp($activitie['date_event'])->format($this->format); @endphp</span>
                            </div>
                            <h2>{{ $activitie->name }}</h2>
                            <ul class="uk-list" wire:ignore>
                                <li>{{ __('LanPlace') }}:
                                    <span><livewire:view.citie-component :citie="$activitie->citie_id">, {{ $activitie->location }}</span>
                                </li>
                                <li>{{ __('LanCountPlace') }}: <span>{{ $activitie->number_volume }} / {{ $activitie->number_available }}</span></li>
                                <li>{{ __('LanConditionsPlace') }}: <span>{{ $activitie->paide_id }}</span></li>
                            </ul>
                            <div class="uk-button-card uk-button">
                                <a href="{{ url('/') }}/activities/{{ $activitie->id }}">{{ __('LanMore') }}</a>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <ul class="uk-slider-nav uk-dotnav uk-grid uk-grid-collapse uk-child-width-expand"></ul>
    </div>
    <script>
        document.addEventListener('livewire:load', function () {
            @this.format = LocaleFormat();
        });
    </script>
</div>