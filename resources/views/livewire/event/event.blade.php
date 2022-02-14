<div id="component">
    @if (session()->has('message'))
        <div class="uk-alert-success" data-uk-alert>
            <a class="uk-alert-close" data-uk-close></a>
            {{ session('message') }}
        </div>
    @endif
    @if (isset($_GET['create']))
        <script>
            document.addEventListener('livewire:load', function () {
                @this.create();
                window.history.pushState('1', 'Title', '/events');
            });
        </script>
    @endif
    @if ($confirmEvent)
        <div id="deleteevent" class="uk-modal uk-modal-event uk-open uk-flex-top" style="display: flex" data-uk-modal>
            <div class="uk-modal-dialog uk-margin-auto-vertical uk-modal-body uk-animation-slide-top">
                <button class="uk-modal-close-default" type="button" data-uk-close wire:ignore></button>
                <h2>{{ __('LanDeleteEvent') }}</h2>
                <div class="uk-grid uk-grid-small uk-flex uk-flex-center uk-flex-middle" data-uk-grid>
                    <div>
                        <button class="uk-button uk-modal-close" type="button">{{ __('LanNo') }}</button>
                    </div>
                    <div>
                        <button class="uk-button" wire:click.prevent="delete({{ $confirmEvent }})">{{ __('LanYes') }}</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if ($activeEvent)
        <div id="activeevent" class="uk-modal uk-modal-event uk-open uk-flex-top" style="display: flex" data-uk-modal>
            <div class="uk-modal-dialog uk-margin-auto-vertical uk-modal-body uk-animation-slide-top">
                <button class="uk-modal-close-default" type="button" data-uk-close wire:ignore></button>
                <h2>{{ __('LanActiveEvent') }}</h2>
                <div class="uk-grid uk-grid-small uk-flex uk-flex-center uk-flex-middle" data-uk-grid>
                    <div>
                        <button class="uk-button uk-modal-close" type="button">{{ __('LanNo') }}</button>
                    </div>
                    <div>
                        <button class="uk-button" wire:click.prevent="active({{ $activeEvent }})">{{ __('LanYes') }}</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if ($deactiveEvent)
        <div id="deactiveevent" class="uk-modal uk-modal-event uk-open uk-flex-top" style="display: flex" data-uk-modal>
            <div class="uk-modal-dialog uk-margin-auto-vertical uk-modal-body uk-animation-slide-top">
                <button class="uk-modal-close-default" type="button" data-uk-close wire:ignore></button>
                <h2>{{ __('LanDeactiveEvent') }}</h2>
                <div class="uk-grid uk-grid-small uk-flex uk-flex-center uk-flex-middle" data-uk-grid>
                    <div>
                        <button class="uk-button uk-modal-close" type="button">{{ __('LanNo') }}</button>
                    </div>
                    <div>
                        <button class="uk-button" wire:click.prevent="deactive({{ $deactiveEvent }})">{{ __('LanYes') }}</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if ($updateMode)
        <div id="editevent" class="uk-modal uk-modal-event uk-flex uk-flex-top uk-open" style="display: flex" data-uk-modal>
            <div class="uk-modal-dialog uk-margin-auto-vertical uk-modal-body uk-animation-slide-top">
                <button class="uk-modal-close-default" type="button" data-uk-close wire:ignore></button>
                <h2 class="uk-modal-title">
                    {{ __('LanEditEvent') }}
                </h2>
                <form wire:submit.prevent="update" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="uk-modal-body">
                        <div class="uk-grid uk-child-width-1-1 uk-grid-stack" data-uk-grid>
                            <div class="uk-first-column">
                                <div class="uk-line-input">
                                    <label><i>*</i> {{ __('lanEventName') }}</label>
                                    @error('name')
                                        <div class="uk-alert-danger" data-uk-alert>
                                            <a class="uk-alert-close" data-uk-close></a>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <input type="text" wire:model.defer="name" class="uk-input">
                                </div>
                            </div>
                            @if ($previewMode)
                            <div class="uk-grid-margin uk-first-column">
                                <div class="uk-previe">
                                    <img class="uk-cover" data-uk-cover src="{{ route('storage') }}/{{ $previewMode }}">
                                </div>
                            </div>
                            @else
                            <div class="uk-grid-margin uk-first-column">
                                <div class="uk-previe">
                                    <img class="uk-cover" data-uk-cover src="{{ route('storage') }}/{{ $cover_path }}">
                                </div>
                            </div>
                            @endif
                            <div class="uk-grid-margin uk-first-column">
                                <div class="uk-placeholder uk-placeholder-upload uk-text-center">
                                    <span class="uk-icon" data-uk-icon="icon: cloud-upload" wire:ignore></span>
                                    <span class="uk-text-middle">{{ __('LanUploadImage') }}</span>
                                    <div class="uk-form-custom" data-uk-form-custom>
                                        <input type="file" wire:model.defer="cover_path">
                                        <span class="uk-link">{{ __('LanUploadTo') }}</span>
                                    </div>
                                </div>
                            </div>
                            @error('cover_path')
                            <div class="uk-grid-margin uk-first-column">
                                <div class="uk-alert-danger" data-uk-alert>
                                    <a class="uk-alert-close" data-uk-close></a>
                                    {{ $message }}
                                </div>
                            </div>
                            @enderror
                            <div class="uk-grid-margin uk-first-column">
                                <div class="uk-line-input">
                                    <label><i>*</i> {{ __('lanEventDate') }}</label>
                                    @error('date_event')
                                        <div class="uk-alert-danger" data-uk-alert>
                                            <a class="uk-alert-close" data-uk-close></a>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    {{--
                                    <input type="datetime-local" wire:model.defer="date_event" class="uk-input">
                                    --}}
                                    <input type="text" wire:model.defer="date_event" onFocus="maskPhone.call(this);" placeholder="__.__.__ __:__" class="uk-input">
                                </div>
                            </div>
                            <div class="uk-grid-margin uk-first-column">
                                <div class="uk-line-input">
                                    <label><i>*</i> {{ __('lanEventLocation') }}</label>
                                    @error('location')
                                        <div class="uk-alert-danger" data-uk-alert>
                                            <a class="uk-alert-close" data-uk-close></a>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <input type="text" wire:model.defer="location" class="uk-input">
                                </div>
                            </div>
                            <div class="uk-grid-margin uk-first-column">
                                <div class="uk-line-input">
                                    <label><i>*</i> {{ __('lanDescription') }}</label>
                                    @error('description')
                                        <div class="uk-alert-danger" data-uk-alert>
                                            <a class="uk-alert-close" data-uk-close></a>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <textarea wire:model.defer="description" class="uk-textarea" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="uk-grid-margin uk-first-column">
                                <div class="uk-line-input">
                                    <label><i>*</i> {{ __('lanTags') }}</label>
                                    @error('tags')
                                        <div class="uk-alert-danger" data-uk-alert>
                                            <a class="uk-alert-close" data-uk-close></a>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <input type="text" wire:model.defer="tags" class="uk-input">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-modal-footer">
                        <div class="uk-button uk-button-submit">
                            <input type="submit" value="{{ __('LanSaveUpdate') }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        {{--
        @include('livewire.event.edit')
        --}}
    @else
        @if ($createMode)
        <div id="crevent" class="uk-modal uk-modal-event uk-flex-top uk-open" style="display: flex" data-uk-modal>
            <div class="uk-modal-dialog uk-margin-auto-vertical uk-modal-body uk-animation-slide-top">
                <button class="uk-modal-close-default" type="button" data-uk-close wire:ignore></button>
                <h2 class="uk-modal-title">
                    {{ __('LanCreateEvent') }}
                </h2>
                <form wire:submit.prevent="store" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="uk-modal-body">
                        <div class="uk-grid uk-child-width-1-1 uk-grid-stack" data-uk-grid>
                            <div class="uk-first-column">
                                <div class="uk-line-input">
                                    <label><i>*</i> {{ __('lanEventName') }}</label>
                                    @error('name')
                                        <div class="uk-alert-danger" data-uk-alert>
                                            <a class="uk-alert-close" data-uk-close></a>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <input type="text" wire:model.defer="name" class="uk-input">
                                </div>
                            </div>
                            @if ($previewAddMode)
                            <div class="uk-grid-margin uk-first-column">
                                <div class="uk-previe" wire:loading.class="bg-gray">
                                    <img class="uk-cover" data-uk-cover src="{{ route('storage') }}/{{ $previewAddMode }}">
                                </div>
                            </div>
                            @endif
                            <div class="uk-grid-margin uk-first-column">
                                <div class="uk-placeholder uk-placeholder-upload uk-text-center">
                                    <span class="uk-icon" data-uk-icon="icon: cloud-upload" wire:ignore></span>
                                    <span class="uk-text-middle">{{ __('LanUploadImage') }}</span>
                                    <div class="uk-form-custom" data-uk-form-custom>
                                        <input type="file" wire:model.defer="cover_add">
                                        <span class="uk-link">{{ __('LanUploadTo') }}</span>
                                    </div>
                                </div>
                            </div>
                            @error('cover_add')
                            <div class="uk-grid-margin uk-first-column">
                                <div class="uk-alert-danger" data-uk-alert>
                                    <a class="uk-alert-close" data-uk-close></a>
                                    {{ $message }}
                                </div>
                            </div>
                            @enderror
                            <div class="uk-grid-margin uk-first-column">
                                <div class="uk-line-input">
                                    <label><i>*</i> {{ __('lanEventDate') }}</label>
                                    @error('date_event')
                                        <div class="uk-alert-danger" data-uk-alert>
                                            <a class="uk-alert-close" data-uk-close></a>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    {{--
                                    <input type="datetime-local" wire:model.defer="date_event" class="uk-input">
                                    --}}
                                    <input type="text" wire:model.defer="date_event" onFocus="maskPhone.call(this);" placeholder="__.__.__ __:__" class="uk-input">
                                </div>
                            </div>

                            <div class="uk-grid-margin uk-first-column">
                                <div class="uk-line-input">
                                    <label><i>*</i> {{ __('lanEventLocation') }}</label>
                                    @error('location')
                                        <div class="uk-alert-danger" data-uk-alert>
                                            <a class="uk-alert-close" data-uk-close></a>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <input type="text" wire:model.defer="location" class="uk-input">
                                </div>
                            </div>
                            <div class="uk-grid-margin uk-first-column">
                                <div class="uk-line-input">
                                    <label><i>*</i> {{ __('lanDescription') }}</label>
                                    @error('description')
                                        <div class="uk-alert-danger" data-uk-alert>
                                            <a class="uk-alert-close" data-uk-close></a>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <textarea wire:model.defer="description" class="uk-textarea" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="uk-grid-margin uk-first-column">
                                <div class="uk-line-input">
                                    <label><i>*</i> {{ __('lanTags') }}</label>
                                    @error('tags')
                                        <div class="uk-alert-danger" data-uk-alert>
                                            <a class="uk-alert-close" data-uk-close></a>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <input type="text" wire:model.defer="tags" class="uk-input">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-modal-footer">
                        <div class="uk-button uk-button-submit">
                            <input type="submit" value="{{ __('LanCreateEvent') }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endif
        {{--
        @include('livewire.event.create')
        --}}
    @endif

    @if(count($events) == 0)
        <div class="uk-screen-clean uk-flex uk-flex-middle uk-flex-center">
            <div class="uk-text-center">
                <div>
                    <span class="uk-icon" data-uk-icon="icon: album; ratio: 2"></span>
                </div>
                <h2>{{ __('lanEventClean') }}</h2>
                <p>{{ __('lanEventCleanDesk') }}</p>
                <div class="uk-button-card uk-button">
                    <a href="{{ route('personal-events') }}?create=1">{{ __('LanCreateEvent') }}</a>
                </div>

            </div>
        </div>
    @endif

    <div class="uk-grid uk-grid-small uk-child-width-1-1@m" data-uk-grid>
        @foreach ($events as $event)
        @php
            $date = new DateTime($event->date_event);
        @endphp
        <div id="element-{{ $event->id }}" class="@if($event->active == 0) uk-deactive @endif">
            <div class="uk-panel">
                <div class="uk-loading" wire:loading.flex wire:target="delete({{ $event->id }})">
                    <span data-uk-spinner></span>
                </div>
                @if($event['cover_path'])
                    <div class="uk-image" data-src="{{ route('storage') }}/{{ $event->cover_path }}" data-uk-img>
                        @if($event['reviewed'] > 0)
                            <div class="uk-view uk-flex uk-flex-middle uk-button uk-button-symbol" data-uk-tooltip="title: {{ __('LanRew') }}; pos: bottom">
                                <span class="uk-icon" data-uk-icon="play-circle"></span> <span>{{ $event->reviewed }}</span>
                            </div>
                        @endif
                    </div>
                @endif
                @if($event->date_event > date('Y-m-d H:i:s'))
                    <div class="uk-panel-time" wire:ignore>
                        <div class="uk-grid uk-grid-small uk-child-width-auto" data-uk-grid data-uk-countdown="date: @php echo date_format($date,"Y-m-d") . "T" . date_format($date,"h:m:s"); @endphp">
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
                    <div class="uk-grid uk-flex uk-flex-middle" data-uk-grid>
                        <div class="uk-width-expand@m">
                            <div class="uk-grid uk-grid-small uk-child-width-1-2@m uk-flex uk-flex-middle"" data-uk-grid>
                                <div>
                                    <div class="uk-grid uk-grid-small uk-flex uk-flex-middle" data-uk-grid>
                                        <div>
                                            @if($event->active == 0)
                                                <h2>{{ $event->name }}</h2>
                                            @else
                                                <a href="{{ route('home') }}/event/view/{{ $event->link }}" title="{{ $event->name }}">
                                                    <h2>{{ $event->name }}</h2>
                                                </a>
                                            @endif
                                            @if($adminView)
                                                @foreach ($users as $use)
                                                    @if($use->id == $event->user_id)
                                                        <small>Автор: {{ $use->name }} / {{ $use->email }}</small>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                        @if ($adminView)
                                            <div>
                                                @if($event->active == 0)
                                                    <button class="uk-button uk-button-symbol" wire:click="activeConfirm({{ $event->id }})" data-uk-tooltip="title: {{ __('LanActive') }}; pos: bottom">
                                                        <span class="uk-icon uk-update" data-uk-icon="icon: check"></span>
                                                    </button>
                                                @else
                                                    <button class="uk-button uk-button-symbol" wire:click="deactiveConfirm({{ $event->id }})" data-uk-tooltip="title: {{ __('LanDeactive') }}; pos: bottom">
                                                        <span class="uk-icon uk-update" data-uk-icon="icon: ban"></span>
                                                    </button>
                                                @endif
                                            </div>
                                        @else
                                            <div>
                                                <button class="uk-button uk-button-symbol" wire:click="edit({{ $event->id }})" data-uk-tooltip="title: {{ __('LanEdit') }}; pos: bottom">
                                                    <span class="uk-icon uk-update" data-uk-icon="icon: pencil" wire:ignore></span>
                                                </button>
                                            </div>
                                            <div>
                                                <button class="uk-button uk-button-symbol" wire:click="deleteConfirm({{ $event->id }})" data-uk-tooltip="title: {{ __('LanDelete') }}; pos: bottom">
                                                    <span class="uk-icon uk-update" data-uk-icon="icon: trash" wire:ignore></span>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <div class="uk-link-panel">
                                        <div class="uk-grid uk-grid-collapse uk-flex uk-flex-middle" data-uk-grid>
                                            <div class="uk-width-expand@xs">
                                                <div class="uk-flex uk-flex-middle">
                                                    <span class="uk-icon-link" data-uk-icon="icon: link"></span>
                                                    
                                                    @if($event->active == 0)
                                                        <span class="uk-text-link" id="copy-{{ $event->id }}">{{ __('LanDeactiveAdminMessage') }}</span>
                                                    @else
                                                        <span class="uk-label-link">{{ __('LanShareLink') }}</span>
                                                        <span class="uk-text-link" id="copy-{{ $event->id }}">{{ route('home') }}/event/view/{{ $event->link }}</span>
                                                    @endif
                                                    
                                                </div>
                                            </div>
                                            <div class="uk-width-auto@xs">
                                                @if($event->active == 1)
                                                    <button type="button" data-uk-tooltip="title: {{ __('LanCopyText') }}; pos: bottom" data-copy="copy-{{ $event->id }}" onclick="CopyTo.call(this)"><span class="uk-icon" data-uk-icon="icon: copy" wire:ignore></span></button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-auto@m">
                            <div class="uk-date @if($event->date_event < date('Y-m-d H:i:s')) uk-passed @endif uk-flex uk-flex-middle" data-uk-tooltip="title: {{ __('lanEventDate') }}; pos: bottom">
                                <span data-uk-icon="icon: calendar"></span> <span>@php echo date_format($date,"j.m.Y"); @endphp</span>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="uk-subnav uk-subnav-pill uk-grid uk-grid-collapse uk-child-width-expand" data-uk-switcher="connect: #uk-switcher-{{ $event->id }}; animation: uk-animation-fade; swiping: false" wire:ignore>
                    <li class="uk-active"><a href="#">{{ __('LanGift') }}</a></li>
                    <li><a href="#">{{ __('LanGuest') }}</a></li>
                </ul>
                <div class="uk-gifts">
                    <ul id="uk-switcher-{{ $event->id }}" class="uk-switcher uk-switcher-tab" wire:ignore>
                        <li class="uk-active">
                            @livewire('user.gift-component', ['event_id' => $event->id])
                        </li>
                        <li>
                            @livewire('user.guest-component', ['event_id' => $event->id])
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        @endforeach

        {{ $events->links() }}
    </div>
</div>