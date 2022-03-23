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
                                <div class="uk-line-input">
                                    <label><i>*</i> {{ __('LanCategory') }}</label>
                                    @error('categorie_id')
                                        <div class="uk-alert-danger" data-uk-alert>
                                            <a class="uk-alert-close" data-uk-close></a>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <select wire:model="categorie_id" class="uk-select">
                                        @foreach ($categories as $categorie)
                                            <option value="{{ $categorie->id }}">{{ __($categorie->name) }}</option>
                                        @endforeach
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
                                        <label><i>*</i> {{ __('LanCountry') }}</label>
                                        @error('countrie_id')
                                            <div class="uk-alert-danger" data-uk-alert>
                                                <a class="uk-alert-close" data-uk-close></a>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <select wire:model.defer="countrie_id" wire:change="selectedCountry" class="uk-select">
                                            <option value="">{{ __('LanSelectCountry') }}</option>
                                            @foreach ($countries as $countrie)
                                                <option value="{{ $countrie->id }}"><span>{{ __($countrie->name) }}</span></option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if($selectedCountry || $countrie_id)
                                <div class="uk-grid-margin uk-first-column">
                                    <div class="uk-line-input">
                                        <label><i>*</i> {{ __('LanCity') }}</label>
                                        @error('citie_id')
                                            <div class="uk-alert-danger" data-uk-alert>
                                                <a class="uk-alert-close" data-uk-close></a>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <select wire:model.defer="citie_id" class="uk-select">
                                            <option value="">{{ __('LanSelectCity') }}</option>
                                            @foreach ($cities as $citie)
                                                <option value="{{ $citie->id }}">{{ __($citie->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endif
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
                                <div class="uk-line-input">
                                    <label><i>*</i> {{ __('LanCategory') }}</label>
                                    @error('categorie_id')
                                        <div class="uk-alert-danger" data-uk-alert>
                                            <a class="uk-alert-close" data-uk-close></a>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <select wire:model.defer="categorie_id" class="uk-select">
                                        <option value="">{{ __('LanCategory') }}</option>
                                        @foreach ($categories as $categorie)
                                            <option value="{{ $categorie->id }}">{{ __($categorie->name) }}</>
                                        @endforeach
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
                                        <label>
                                            <i>*</i> {{ __('lanEventDate') }}
                                        </label>
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
                                        <label><i>*</i> {{ __('LanCountry') }}</label>
                                        @error('countrie_id')
                                            <div class="uk-alert-danger" data-uk-alert>
                                                <a class="uk-alert-close" data-uk-close></a>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <select wire:model.defer="countrie_id" wire:change="selectedCountry" class="uk-select">
                                            <option value="" selected>{{ __('LanSelectCountry') }}</option>
                                            @foreach ($countries as $countrie)
                                                <option value="{{ $countrie->id }}"><span>{{ __($countrie->name) }}</span></option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if($selectedCountry)
                                <div class="uk-grid-margin uk-first-column">
                                    <div class="uk-line-input">
                                        <label><i>*</i> {{ __('LanCity') }}</label>
                                        @error('citie_id')
                                            <div class="uk-alert-danger" data-uk-alert>
                                                <a class="uk-alert-close" data-uk-close></a>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <select wire:model.defer="citie_id" class="uk-select">
                                            <option value="" selected>{{ __('LanSelectCity') }}</option>
                                            @foreach ($cities as $citie)
                                                <option value="{{ $citie->id }}">{{ __($citie->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endif
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
                                    <div class="uk-grid uk-child-width-1-2@m uk-grid-stack" data-uk-grid>

                                        <div class="@if(!$selectedPaid) uk-width-1-1@m @endif uk-first-column">
                                            <div class="uk-line-input">
                                                <label><i>*</i> {{ __('LanSelectTerms') }}</label>
                                                @error('paide_id')
                                                    <div class="uk-alert-danger" data-uk-alert>
                                                        <a class="uk-alert-close" data-uk-close></a>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <select wire:model.defer="paide_id" wire:change="selectedPaid" class="uk-select">
                                                    <option value="" selected>{{ __('LanSelectTerms') }}</option>
                                                    @foreach ($paides as $paide)
                                                        <option value="{{ $paide->id }}"><span>{{ __($paide->name) }}</span></option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @if($selectedPaid)
                                        <div class="uk-grid-margin uk-first-column">
                                            <div class="uk-line-input">
                                                <label><i>*</i> {{ __('LanPrice') }}</label>
                                                @error('price')
                                                    <div class="uk-alert-danger" data-uk-alert>
                                                        <a class="uk-alert-close" data-uk-close></a>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <input type="number" wire:model.defer="price" class="uk-input">
                                            </div>
                                        </div>
                                        @endif
                                        <div class="uk-grid-margin uk-first-column">
                                            <div class="uk-line-input">
                                                <label><i>*</i> {{ __('LanNumber') }}</label>
                                                @error('number_volume')
                                                    <div class="uk-alert-danger" data-uk-alert>
                                                        <a class="uk-alert-close" data-uk-close></a>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <input type="number" wire:model.defer="number_volume" class="uk-input">
                                            </div>
                                        </div>
                                        <div class="uk-grid-margin uk-first-column">
                                            <div class="uk-line-input">
                                                <label><i>*</i> {{ __('LanAvailable') }}</label>
                                                @error('number_available')
                                                    <div class="uk-alert-danger" data-uk-alert>
                                                        <a class="uk-alert-close" data-uk-close></a>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <input type="number" wire:model.defer="number_available" class="uk-input">
                                            </div>
                                        </div>
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
    @endif

    @if(count($activities) == 0)
        <div class="uk-screen-clean uk-flex uk-flex-middle uk-flex-center">
            <div class="uk-text-center">
                <div>
                    <span class="uk-icon" data-uk-icon="icon: album; ratio: 2"></span>
                </div>
                <h2>{{ __('lanEventClean') }}</h2>
                <p>{{ __('lanEventCleanDesk') }}</p>
                <div class="uk-button-card uk-button">
                    <a href="{{ route('personal-activities') }}?create=1">{{ __('LanCreateEvent') }}</a>
                </div>

            </div>
        </div>
    @endif

    <div class="uk-grid uk-grid-small uk-child-width-1-1@m" data-uk-grid>
        @foreach ($activities as $activitie)
        <div id="element-{{ $activitie->id }}" @if($activitie->active == 0) class="uk-deactive" @endif>
            <div class="uk-panel">
                <div class="uk-loading" wire:loading.flex wire:target="delete({{ $activitie->id }})">
                    <span data-uk-spinner></span>
                </div>
                @if($activitie['cover_path'])
                    <div class="uk-image" data-src="{{ route('storage') }}/{{ $activitie->cover_path }}" data-uk-img>
                        @if($activitie['reviewed'] > 0)
                            <div class="uk-view uk-flex uk-flex-middle uk-button uk-button-symbol" data-uk-tooltip="title: {{ __('LanRew') }}; pos: bottom">
                                <span class="uk-icon" data-uk-icon="play-circle"></span> <span>{{ $activitie->reviewed }}</span>
                            </div>
                        @endif
                    </div>
                @endif
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
                    <div class="uk-grid uk-flex uk-flex-middle" data-uk-grid>
                        <div class="uk-width-expand@m">
                            <div class="uk-grid uk-grid-small uk-child-width-1-2@m uk-flex uk-flex-middle"" data-uk-grid>
                                <div>
                                    <div class="uk-grid uk-grid-small uk-flex uk-flex-middle" data-uk-grid>
                                        <div>
                                            @if($activitie->active == 0)
                                                <h2>{{ $activitie->name }} @if($activitie->age)<span>{{ $activitie->age }}</span>@endif</h2>
                                            @else
                                                <a href="{{ route('home') }}/activities/{{ $activitie->id }}" title="{{ $activitie->name }}">
                                                    <h2>{{ $activitie->name }} @if($activitie->age)<span>{{ $activitie->age }}</span>@endif</h2>
                                                </a>
                                            @endif
                                            @if($adminView)
                                                @foreach ($users as $use)
                                                    @if($use->id == $activitie->user_id)
                                                        <small>Автор: {{ $use->name }} / {{ $use->email }}</small>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>

                                        @if ($adminView)
                                            <div>
                                                @if($activitie->active == 0)
                                                    <button class="uk-button uk-button-symbol" wire:click="activeConfirm({{ $activitie->id }})" data-uk-tooltip="title: {{ __('LanActive') }}; pos: bottom">
                                                        <span class="uk-icon uk-update" data-uk-icon="icon: check"></span>
                                                    </button>
                                                @else
                                                    <button class="uk-button uk-button-symbol" wire:click="deactiveConfirm({{ $activitie->id }})" data-uk-tooltip="title: {{ __('LanDeactive') }}; pos: bottom">
                                                        <span class="uk-icon uk-update" data-uk-icon="icon: ban"></span>
                                                    </button>
                                                @endif
                                            </div>
                                        @else
                                            <div>
                                                <button class="uk-button uk-button-symbol" wire:click="edit({{ $activitie->id }})" data-uk-tooltip="title: {{ __('LanEdit') }}; pos: bottom">
                                                    <span class="uk-icon uk-update" data-uk-icon="icon: pencil" wire:ignore></span>
                                                </button>
                                            </div>
                                            <div>
                                                <button class="uk-button uk-button-symbol" wire:click="deleteConfirm({{ $activitie->id }})" data-uk-tooltip="title: {{ __('LanDelete') }}; pos: bottom">
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
                                                    @if($activitie->active == 0)
                                                        <span class="uk-text-link" id="copy-{{ $activitie->id }}">{{ __('LanDeactiveAdminMessage') }}</span>
                                                    @else
                                                        <span class="uk-label-link">{{ __('LanShareLink') }}</span>
                                                        <span class="uk-text-link" id="copy-{{ $activitie->id }}">{{ route('home') }}/activities/{{ $activitie->id }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="uk-width-auto@xs">
                                                @if($activitie->active == 1)
                                                    <button type="button" data-uk-tooltip="title: {{ __('LanCopyText') }}; pos: bottom" data-copy="copy-{{ $activitie->id }}" onclick="CopyTo.call(this)"><span class="uk-icon" data-uk-icon="icon: copy" wire:ignore></span></button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-auto@m">
                            <div class="uk-date @if($activitie->date_event < \Carbon\Carbon::now()->timestamp) uk-passed @endif uk-flex uk-flex-middle">
                                <span data-uk-icon="icon: calendar" wire:ignore></span> <span>@php echo \Carbon\Carbon::createFromTimestamp($activitie['date_event'])->format($this->format); @endphp</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @endforeach
    </div>

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

</div>