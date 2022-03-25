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
                window.history.pushState('1', 'Title', '/activities');
            });
        </script>
    @endif

    @if ($closeModal)
        <div>
            <script>
                UIkit.modal('#{{ $closeModal }}').hide();
            </script>
        </div>
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
                                    <label><i>*</i> {{ __('LanAge') }}</label>
                                    @error('age')
                                        <div class="uk-alert-danger" data-uk-alert>
                                            <a class="uk-alert-close" data-uk-close></a>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <select wire:model="age" class="uk-select">
                                        <option value="{{ $age }}">{{ __($age) }}</option>
                                        <option value="0+">0+</option>
                                        <option value="6+">6+</option>
                                        <option value="10+">10+</option>
                                        <option value="12+">12+</option>
                                        <option value="16+">16+</option>
                                        <option value="18+">18+</option>
                                        @if (App::isLocale('en'))
                                            <option value="21+">21+</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            
                            <div class="uk-grid-margin uk-first-column">
                                <hr />
                                    <h4 class="uk-text-center">{{ __('LanDateLocation') }}</h4>
                                <hr />
                            </div>

                                <div class="uk-grid-margin uk-first-column uk-width-1-2">
                                    <div class="uk-line-input">
                                        <label><i>*</i> {{ __('lanEventDate') }}</label>
                                        @error('date_event')
                                            <div class="uk-alert-danger" data-uk-alert>
                                                <a class="uk-alert-close" data-uk-close></a>
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        @php $this->date_event = \Carbon\Carbon::createFromTimestamp($this->date_event)->format($this->format); @endphp

                                        <input class="uk-input datepicker-here" wire:model.defer="date_event" type="text" onClick="xCal(this,'.', {{ $this->format_calendar }})" onKeyUp="xCal()" oninput="xCal()" pattern="[0-9]{2}\.[0-9]{2}\.[0-9]{4}" onFocus="maskPhone.call(this);" placeholder="__.__.____"/>

                                    </div>
                                </div>

                                <div class="uk-grid-margin uk-first-column uk-width-1-2">
                                    <div class="uk-line-input">
                                        <label><i>*</i> {{ __('Time') }}</label>
                                        @error('date_time')
                                            <div class="uk-alert-danger" data-uk-alert>
                                                <a class="uk-alert-close" data-uk-close></a>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <input type="text" wire:model.defer="date_time" class="uk-input" onFocus="maskPhone.call(this);" placeholder="__:__">
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
                                <hr />
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
                                    <label><i>*</i> {{ __('LanAge') }}</label>
                                    @error('age')
                                        <div class="uk-alert-danger" data-uk-alert>
                                            <a class="uk-alert-close" data-uk-close></a>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <select wire:model="age" class="uk-select">
                                        <option value="">{{ __('LanSelectAge') }}</option>
                                        <option value="0+">0+</option>
                                        <option value="6+">6+</option>
                                        <option value="10+">10+</option>
                                        <option value="12+">12+</option>
                                        <option value="16+">16+</option>
                                        <option value="18+">18+</option>
                                        @if (App::isLocale('en'))
                                            <option value="21+">21+</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="uk-grid-margin uk-first-column">
                                <hr />
                                    <h4 class="uk-text-center">{{ __('LanDateLocation') }}</h4>
                                <hr />
                            </div>

                                <div class="uk-grid-margin uk-first-column uk-width-1-2">
                                    <div class="uk-line-input">
                                        <label><i>*</i> {{ __('lanEventDate') }}</label>
                                        @error('date_event')
                                            <div class="uk-alert-danger" data-uk-alert>
                                                <a class="uk-alert-close" data-uk-close></a>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        
                                        <input class="uk-input datepicker-here" wire:model.defer="date_event" type="text" onClick="xCal(this,'.', {{ $this->format_calendar }})" onKeyUp="xCal()" oninput="xCal()" pattern="[0-9]{2}\.[0-9]{2}\.[0-9]{4}" onFocus="maskPhone.call(this);" placeholder="__.__.____"/>
                                    </div>
                                </div>
                                <div class="uk-grid-margin uk-first-column uk-width-1-2">
                                    <div class="uk-line-input">
                                        <label><i>*</i> {{ __('Time') }}</label>
                                        @error('date_time')
                                            <div class="uk-alert-danger" data-uk-alert>
                                                <a class="uk-alert-close" data-uk-close></a>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <input type="text" wire:model.defer="date_time" class="uk-input" onFocus="maskPhone.call(this);" placeholder="__:__">
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
                                <hr />
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
    @endif

    @if($callbackModal)
        <div id="crevent" class="uk-modal uk-modal-callback uk-modal-event uk-flex-top uk-open" style="display: flex" data-uk-modal>
            <div class="uk-modal-dialog uk-margin-auto-vertical uk-modal-body uk-animation-slide-top">
                <button class="uk-modal-close-default" type="button" data-uk-close wire:ignore></button>
                <div class="uk-image" data-src="{{ route('storage') }}/{{ $select_calendars->cover_path }}" data-uk-img></div>
                <h2>{{ $select_calendars->name }}</h2>
                <p>{{ $select_calendars->description }}</p>

                <form wire:submit.prevent="sand({{ $select_calendars['id'] }})" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="uk-line-elements">
                        <div class="uk-line uk-line-clean">
                            <input id="personal-{{ $select_calendars['id'] }}" wire:model.defer="personal" type="text" class="uk-input" onkeydown="inputAction.call(this);inputLine.call(this);" required pattern="[А-Яа-яЁёA-z ]{2,}" />
                            <label for="personal-{{ $select_calendars['id'] }}"><span class="uk-icon" data-uk-icon="icon: user"></span> <i>*</i> {{ __('Name') }}</label>
                            <span class="uk-border"></span>
                        </div>
                        @error('personal')
                            <div class="uk-alert-danger" data-uk-alert>
                                <a class="uk-alert-close" data-uk-close></a>
                                {{ $message }}
                            </div>
                        @enderror
                        @if (App::isLocale('ru'))
                            <div class="uk-line uk-line-clean">
                                <input id="phone-{{ $select_calendars['id'] }}" wire:model.defer="phone" type="tel" class="uk-input uk-mask" onFocus="maskPhone.call(this);" onkeydown="inputAction.call(this);inputLine.call(this);" onClick="inputAction.call(this);inputLine.call(this);" placeholder="+7 (9__) ___-__-__" pattern="\+7\s?[\(]{0,1}9[0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}" required="required">
                                <label for="phone-{{ $select_calendars['id'] }}"><span class="uk-icon" data-uk-icon="icon: receiver"></span> <i>*</i> {{ __('LanPhone') }}</label>
                                <span class="uk-border"></span>
                            </div>
                        @elseif (App::isLocale('en'))
                            <div class="uk-line uk-line-clean">
                                <input id="phone-{{ $select_calendars['id'] }}" wire:model.defer="phone" type="tel" class="uk-input uk-mask" onFocus="maskPhone.call(this);" onkeydown="inputAction.call(this);inputLine.call(this);" onClick="inputAction.call(this);inputLine.call(this);" placeholder="+1 (___) ___-__-__" pattern="\+1\s?[\(]{0,1}[0-9][0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}" required="required">
                                <label for="phone-{{ $select_calendars['id'] }}"><span class="uk-icon" data-uk-icon="icon: receiver"></span> <i>*</i> {{ __('LanPhone') }}</label>
                                <span class="uk-border"></span>
                            </div>
                        @endif
                        @error('phone')
                            <div class="uk-alert-danger" data-uk-alert>
                                <a class="uk-alert-close" data-uk-close></a>
                                {{ $message }}
                            </div>
                        @enderror

                        @if($user)
                            <div class="uk-kid-list">
                                <br />
                                <label><strong>{{ __('LanSavedKidList') }}</strong></label>
                                <div class="uk-grid uk-grid-small uk-child-width-1-1@m" data-uk-grid data-uk-height-match="target: > li > .uk-card">
                                    @foreach ($childrenlist as $kid)
                                        @php $kid->birthday = \Carbon\Carbon::createFromTimestamp($kid->birthday)->format($this->format); @endphp
                                        <div>
                                            <div class="uk-card uk-kid" onclick='document.querySelector("textarea[name=text]").value+="{{ $kid->name }} - {{ $kid->birthday }},"'>
                                                <span class="uk-icon" data-uk-icon="icon: plus"></span> <span>{{ $kid->name }} - <strong>{{ $kid->birthday }}</strong></span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="uk-line uk-line-clean">
                            <label for="children-{{ $select_calendars['id'] }}">
                                <span class="uk-icon" data-uk-icon="icon: user"></span> <i>*</i> {{ __('LanChildren') }} <br /> <small>{{ __('LanChildrenSmall') }}</small>
                            </label>
                            <span class="uk-border"></span>
                            <textarea name="text" id="children-{{ $select_calendars['id'] }}" wire:model.defer="children" class="uk-textarea uk-text" required></textarea>
                        </div>
                        @error('children')
                            <div class="uk-alert-danger" data-uk-alert>
                                <a class="uk-alert-close" data-uk-close></a>
                                {{ $message }}
                            </div>
                        @enderror
                        <br />
                        <br />
                        <hr />
                        <livewire:view.agreement-component>
                        <hr />
                    </div>
                    <div class="uk-text-center">
                        <input class="uk-button-callback" type="submit" value="{{ __('LanSand') }}">
                    </div>
                    <div class="uk-block-notification uk-text-center">
                        {{ __('LanPoli1') }} <a class="uk-consent" href="#consent" data-uk-toggle onClick="showContent.call(this);event.preventDefault();" data-link="con-consent" data-load="consentloading" data-position="consentBody">{{ __('LanPoli2') }}</a>.
                    </div>
                </form>
            </div>
        </div>
    @endif
    @if($adminView)
        <div class="uk-text-center uk-margin">
            <div class="uk-button-card uk-button uk-button-mobile-large">
                <a href="/" wire:click.prevent="create()">{{ __('LanCreateEvent') }}</a>
            </div>
        </div>
    @endif
    <div class="uk-position-relative">
        <div class="uk-loading" wire:loading.flex>
            <span class="uk-spinner uk-icon" data-uk-spinner wire:ignore></span>
        </div>
            @php
                $days[] = \Carbon\Carbon::now()->format('Y-m-d');
            @endphp
            
            @foreach ($calendars as $calendar)
                @php $days[] = \Carbon\Carbon::createFromTimestamp($calendar['date_event'])->format('Y-m-d'); @endphp
            @endforeach

            @php
                $result_days = array_unique($days);
                function date_sort($a, $b) {
                    return strtotime($a) - strtotime($b);
                }
                usort($result_days, "date_sort");
                $day_count = array_search(\Carbon\Carbon::now()->format('Y-m-d'), $result_days, $strict = false);
            @endphp

            @if (App::isLocale('ru'))
                @php $weeks = array( 1 => "Пн" , "Вт" , "Ср" , "Чт" , "Пт" , "Сб" , "Вс" ); @endphp
            @elseif (App::isLocale('en'))
                @php $weeks = array( 1 => "Mon" , "Tue" , "Wed" , "Thu" , "Fri" , "Sat" , "Sun" ); @endphp
            @endif

            <style>
                .uk-days-slider .uk-slider-items > li .uk-card-day {
                    background: #f2f2f2;
                    padding: 10px;
                    box-sizing: border-box;
                    min-width: 60px;
                }
                .uk-days-slider .uk-slider-items > li.uk-selected .uk-card-day {
                    background: var(--base);
                    color: #FFF;
                }
                .uk-days-slider .uk-slider-items > li .uk-card-day .uk-day {
                    font-size: 2rem;
                    font-weight: 900;
                }
                .uk-clean-calendat {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    min-height: 50vh;
                }
                .uk-screen-catalog .uk-slidenav {
                    color: rgba(0 0 0 / 50%);
                }
                .uk-screen-catalog .uk-slidenav:hover {
                    color: rgba(0 0 0 / 100%);
                }
                .uk-screen-catalog .uk-slider .uk-slider-items > li {
                    width: auto !important;
                }
            </style>

            <div class="uk-days-slider uk-width-1-1">
                <div class="uk-slider uk-width-1-1" data-uk-slider="center: true; finite: true; index: @php echo $day_count; @endphp">
                    <div class="uk-position-relative">
                        <div class="uk-slider-container">
                            <ul class="uk-slider-items uk-child-width-1-4@xs uk-child-width-auto@m uk-grid-small uk-grid uk-margin-remove" data-uk-grid data-uk-switcher="connect: .uk-switcher; active: @php echo $day_count; @endphp; animation: uk-animation-fade">
                                @foreach ($result_days as $day)
                                    <li>
                                        <div class="uk-card-day uk-text-center">
                                            <small>
                                                @php
                                                    echo $weeks[date(\Carbon\Carbon::createFromFormat('Y-m-d', $day)->format('N'))];
                                                @endphp
                                            </small>
                                            <div class="uk-day">
                                                @php echo \Carbon\Carbon::createFromFormat('Y-m-d', $day)->format('d'); @endphp
                                            </div>
                                            <small>
                                                @php echo \Carbon\Carbon::createFromFormat('Y-m-d', $day)->format('m-Y'); @endphp
                                            </small>
                                        </div>
                                    </li> 
                                @endforeach
                            </ul>
                        </div>
                        <a class="uk-position-center-left-out" href="#" data-uk-slidenav-previous data-uk-slider-item="previous"></a>
                        <a class="uk-position-center-right-out" href="#" data-uk-slidenav-next data-uk-slider-item="next"></a>
                    </div>
                </div>
            </div>

            @php
            function search($array, $key, $value)
            {
                $results = array();
                if (is_array($array)) {
                    if (isset($array[$key]) && $array[$key] == $value) {
                        $results[] = $array;
                    }
                    foreach ($array as $subarray) {
                        $results = array_merge($results, search($subarray, $key, $value));
                    }
                }
                return $results;
            }
            @endphp

            <ul class="uk-switcher">
                @foreach ($result_days as $day)
                    <li>
                        @foreach ($calendars as $calendar)
                            @php
                                $calendar_arr[] = \Carbon\Carbon::createFromTimestamp($calendar['date_event'])->format('Y-m-d');
                            @endphp
                        @endforeach

                        @php
                            $select_day = \Carbon\Carbon::createFromFormat('Y-m-d', $day)->format('Y-m-d');
                            $string_calendars = json_encode($calendar_arr);
                        @endphp

                        @if(strpos($string_calendars, $select_day) != false)
                            <div class="uk-list-event uk-grid uk-child-width-1-3@m uk-grid-small" data-uk-grid data-uk-height-match="target: > div > .uk-card">
                                @foreach ($calendars as $calendar)
                                    
                                    @if(str_contains($calendar->date_time, '08:'))
                                        @php $time = $calendar->date_time . ' am'; @endphp
                                    @elseif(str_contains($calendar->date_time, '09:'))
                                        @php $time = $calendar->date_time . ' am'; @endphp
                                    @elseif(str_contains($calendar->date_time, '10:'))
                                        @php $time = $calendar->date_time . ' am'; @endphp
                                    @elseif(str_contains($calendar->date_time, '11:'))
                                        @php $time = $calendar->date_time . ' am'; @endphp
                                    @elseif(str_contains($calendar->date_time, '12:'))
                                        @php $time = $calendar->date_time . ' pm'; @endphp
                                    @elseif(str_contains($calendar->date_time, '13:'))
                                        @php $time = $calendar->date_time . ' pm'; @endphp
                                    @elseif(str_contains($calendar->date_time, '14:'))
                                        @php $time = $calendar->date_time . ' pm'; @endphp
                                    @elseif(str_contains($calendar->date_time, '15:'))
                                        @php $time = $calendar->date_time . ' pm'; @endphp
                                    @elseif(str_contains($calendar->date_time, '16:'))
                                        @php $time = $calendar->date_time . ' pm'; @endphp
                                    @elseif(str_contains($calendar->date_time, '17:'))
                                        @php $time = $calendar->date_time . ' pm'; @endphp
                                    @elseif(str_contains($calendar->date_time, '18:'))
                                        @php $time = $calendar->date_time . ' pm'; @endphp
                                    @elseif(str_contains($calendar->date_time, '19:'))
                                        @php $time = $calendar->date_time . ' pm'; @endphp
                                    @elseif(str_contains($calendar->date_time, '20:'))s
                                        @php $time = $calendar->date_time . ' pm'; @endphp
                                    @else
                                        @php $time = $calendar->date_time; @endphp
                                    @endif

                                    @if(\Carbon\Carbon::createFromFormat('Y-m-d', $day)->format('Y-m-d') == \Carbon\Carbon::createFromTimestamp($calendar['date_event'])->format('Y-m-d'))
                                        <div>
                                            <div class="uk-card">
                                                <div class="uk-image" data-src="{{ route('storage') }}/{{ $calendar->cover_path }}" data-uk-img wire:ignore>
                                                    @if($calendar->age)
                                                        <span>{{ $calendar->age }}</span>
                                                    @endif
                                                </div>
                                                @if($calendar->date_event > \Carbon\Carbon::now()->timestamp)
                                                    <div class="uk-panel-time" wire:ignore>
                                                        <div class="uk-grid uk-grid-small uk-child-width-auto" data-uk-grid data-uk-countdown="date: @php echo \Carbon\Carbon::createFromTimestamp($calendar['date_event'])->format('Y-m-d'). "T" . $calendar['date_time']; @endphp">
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

                                                    <div class="uk-date @if($calendar->date_event < \Carbon\Carbon::now()->timestamp) uk-passed @endif uk-flex uk-flex-middle">
                                                        <span data-uk-icon="icon: calendar" wire:ignore></span> <span>@php echo \Carbon\Carbon::createFromTimestamp($calendar['date_event'])->format($this->format); @endphp</span>
                                                    </div>

                                                    <h2>{{ $calendar->name }}</h2>
                                                    <ul class="uk-list" wire:ignore>
                                                        <li>{{ __('LanPlace') }}:
                                                            <span>{{ $calendar->location }}</span>
                                                        </li>
                                                    </ul>
                                                    <div class="uk-grid uk-margin-top uk-grid-small uk-flex uk-flex-middle" data-uk-grid>
                                                        <div class="uk-width-1-2@xs">
                                                            @if($calendar->date_event >= \Carbon\Carbon::now()->timestamp)
                                                                <button class="uk-button uk-button-symbol" wire:click="callbackModal({{ $calendar->id }})">
                                                                    {{ __('LanSingup') }}
                                                                </button>
                                                            @else
                                                                <button class="uk-button uk-button-symbol">
                                                                    {{ __('LanNoSingup') }}
                                                                </button>
                                                            @endif
                                                        </div>
                                                        @if ($adminView)
                                                            <div class="uk-width-1-4@xs">
                                                                <button class="uk-button uk-button-symbol" wire:click="edit({{ $calendar->id }})" data-uk-tooltip="title: {{ __('LanEdit') }}; pos: bottom">
                                                                    <span class="uk-icon uk-update" data-uk-icon="icon: pencil" wire:ignore></span>
                                                                </button>
                                                            </div>
                                                            <div class="uk-width-1-4@xs">
                                                                <button class="uk-button uk-button-symbol" wire:click="deleteConfirm({{ $calendar->id }})" data-uk-tooltip="title: {{ __('LanDelete') }}; pos: bottom">
                                                                    <span class="uk-icon uk-update" data-uk-icon="icon: trash" wire:ignore></span>
                                                                </button>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                        @else

                            @if (App::isLocale('ru'))
                                <div class="uk-clean-calendat">
                                    <h2>На эту дату пока нет занятий</h2>
                                </div>
                            @elseif (App::isLocale('en'))
                                <div class="uk-clean-calendat">
                                    <h2>There are no classes for this date yet</h2>
                                </div>
                            @endif

                        @endif
                        
                        
                    </li>
                @endforeach

                <script>
                    document.addEventListener('livewire:load', function () {
                        @this.format = LocaleFormat();
                        if(LocaleFormat() == 'm.d.Y') {
                            @this.format_calendar = 2;
                        } else {
                            @this.format_calendar = 0;
                        }
                    });
                </script>
            </ul>


            @if(App::isLocale('ru'))
            <h1>О сервисе</h1>
            <p>Einsteiners LLC-это глобальная платформа для проведения мероприятий и мероприятий для детей и взрослых. Мы также проводим занятия по развитию детей в нашем офисе в торговом центре Pheasant Lane Nashua NH.</p>
            <h2>Платформа планирования мероприятий</h2>
            <p>Наша бесплатная онлайн-платформа позволит вам создать свое мероприятие, пригласить друзей и добавить списки пожеланий. Сообщите своим друзьям и семье все подробности вашего мероприятия и проинформируйте всех в одном месте. Легко подсчитать количество гостей и увидеть, кто принял ваше приглашение за считанные секунды, без необходимости совершать какие-либо звонки. Поделитесь ссылкой на свое мероприятие по тексту или электронной почте. Персонализируйте события, добавив изображение и полное описание того, что вы планируете делать, где и в какое время. Если вам нужен аниматор, услуги кейтеринга, фотограф или декоратор - обратитесь за помощью к профессионалам в проведении вашего мероприятия. У нас есть много профессионалов, которые могут помочь, просто дайте нам знать, и мы создадим незабываемое событие для вас, ваших друзей и семьи.</p>
            <p>Вечеринки по случаю дня рождения, выпускной, юбилей и свадьбы - у нас есть опыт во всех из них и многое другое.</p>
            <h2>Классы</h2>
            <p>Наши учителя проводят занятия для детей от 6 месяцев до 20 лет по нашему адресу. Мы полны решимости помочь детям получить разнообразные знания и навыки, соответствующие их возрастной группе.</p>
            <p>Новорожденные начинают учиться с помощью зрения и слуха. Они начинают тянуться к вещам и исследовать окружающие их области. Делая это, они учат и узнают о своем окружении. Их когнитивные знания и развитие мозга также учатся запоминать, думать, реагировать, говорить и рассуждать. Это означает, что они изучают звуки и слова. Дети учатся и знакомятся с базовыми навыками и разработками. Они также учатся/развивают перекатывание, ползание и ходьбу по мере развития их общих двигательных навыков. Их когнитивные знания развиваются в том, как думать, решать проблемы, а также осваивать другие важные навыки. Все эти навыки будут совершенно новыми для малышей, они скоро начнут привыкать к их использованию.</p>
            <h2>Малыши</h2>
            <p>На этом этапе они развивают новые двигательные навыки, когнитивное развитие и языковые навыки. Искусство, музыка, математика и наука помогут развить обе стороны мозга и познать мир вокруг вашего ребенка. Каждый класс будет посвящен не только основной теме, но и другим темам, таким как безопасность и поведение. Каждое занятие будет развивать у детей мелкую и грубую моторику, терпение при сидении и способность концентрироваться на одной задаче в течение длительного периода времени. Наши дети учатся у нас, поэтому мы сделаем все возможное, чтобы показать вашим детям примеры и методы, которым они должны следовать.</p>
            <h2>К-8 (5-12 лет)</h2>
            <p>С момента поступления в школу и до полового созревания дети становятся более самодостаточными. Они осваивают социальные навыки, и некоторые дети уже могут сталкиваться с трудностями в общении по многим причинам. Мы помогаем им избавиться от страха и стать более открытыми не только для своих друзей, но и для членов семьи. Уважение и хорошо развитые навыки слушания являются основой для счастливых отношений. На наших занятиях мы научим детей приобретать эту способность и становиться более уверенными в своих действиях.< / p>
            <h2>Подростки</h2>
            <p>Это самый сложный этап развития детей. Они получили много знаний и с этим начинают учиться на собственном опыте. На этом этапе следует привить здоровые привычки, чтобы помочь вашему ребенку перейти к взрослой жизни. Учась заботиться о себе, они учатся заботиться о других. Важно постоянно обсуждать вопросы секса, ИППП, сексуального насилия и насилия. Задавая трудные вопросы своим детям, вы можете избежать неизбежных последствий. Подростки могут связаться с нашими учителями, чтобы помочь с указаниями по их проблемам.</p>
            @else
            <h1>About service</h1>
            <p>Einsteiners LLC is a global platform for events and activities for kids and adults. We also provide classes for kids' development at our location in Pheasant Lane Mall Nashua NH.</p>
            <h2>The event Planning platform</h2>
            <p>Our free online platform will allow you to create your event, invite friends and add wish lists. Let your friends and family know all the details of your event and update everyone in just one place. It is easy to count the number of guests and see who accepted your invitation in seconds without having to make any calls. Share the link to your event via text or email. Personalize events by adding an image and full description of what you are planning to do, where and at what time. If you need an entertainer, catering services, photographer or decorator - ask for pro's help with your event. We have plenty of professionals that might help, just let us know and we will create an unforgettable event for you and your friends and family.</p>
            <p>Birthday parties, graduation, anniversary and weddings - we have experience in all of them and more.</p>
            <h2>Classes</h2>
            <p>Our teachers are providing classes for kids 6 months to 20 years at our location. We are determined to help kids get a variety of knowledge and skills accommodated by their age group.</p>
            <p>Newborns start learning with their vision and hearing. They start to start reaching out for things and explore the areas around them. By doing this they are teaching and learning about their surroundings. Their cognitive knowledge and brain development are also learning how to memorize, think, respond, speak, and reason. This means that they are learning sounds and words. Kids are learning and being introduced to basic skills and developments. They are are also learning/developing rolling, crawling, and walking as their gross motor skills develop. Their cognitive knowledge is developing on how to think, problem-solve, and also learning other important skills. All of these skills will be brand new to the toddlers, they will soon start getting used to using them.</p>  
            <h2>Toddlers</h2>
            <p>At this stage, they develop new motor skills, cognitive development, and language skills. Art, music, math, and science will help to develop both sides of the brain and learn the world around your kid. Each class will not only focus on the main topic but also on other themes such as security and behavior. Each class will develop kids' fine and gross motor skills, patience for sitting and being able to concentrate on one task for an extended period of time. Our kids learn from us so we will do our best to show your kids examples and practices they should follow.</p>
            <h2>K-8 (5-12 yrs)</h2>
            <p>From starting the school to puberty, kids become more self-sufficient. They learn social skills and some kids might already face difficulties with communication due to many reasons. We help to remove their fear and become more open not only to their friends but to family members. Respect and well-developed listening skills are the basis for a happy relationship. Through our classes, we will teach kids to gain this ability and become more confident in their actions.</p>
            <h2>Teenagers</h2>
            <p>Is the hardest stage of kids' development. They gained a lot of knowledge and with that, they start to learn on hands experience. At this stage, healthy habits should be introduced to help your child transition to adults life. By learning how to take care of themselves - they learn how to take care of others. It is important to have ongoing discussions about sex, STIs, sexual abuse, and assault. By defining difficult questions to your kids you might avoid the unalterable consequences. Teens are welcome to contact our teachers to help with directions with their issues.</p>
            @endif
    </div>
</div>