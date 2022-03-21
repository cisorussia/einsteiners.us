<div>
    @php
        function date_extract_format( $d, $null = '' ) {
            // check Day -> (0[1-9]|[1-2][0-9]|3[0-1])
            // check Month -> (0[1-9]|1[0-2])
            // check Year -> [0-9]{4} or \d{4}
            $patterns = array(
                '/\b\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}.\d{3,8}Z\b/' => 'Y-m-d\TH:i:s.u\Z', // format DATE ISO 8601
                '/\b\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])\b/' => 'Y-m-d',
                '/\b\d{4}-(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])\b/' => 'Y-d-m',
                '/\b(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-\d{4}\b/' => 'd-m-Y',
                '/\b(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])-\d{4}\b/' => 'm-d-Y',

                '/\b\d{4}\/(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\b/' => 'Y/d/m',
                '/\b\d{4}\/(0[1-9]|1[0-2])\/(0[1-9]|[1-2][0-9]|3[0-1])\b/' => 'Y/m/d',
                '/\b(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/\d{4}\b/' => 'd/m/Y',
                '/\b(0[1-9]|1[0-2])\/(0[1-9]|[1-2][0-9]|3[0-1])\/\d{4}\b/' => 'm/d/Y',

                '/\b\d{4}\.(0[1-9]|1[0-2])\.(0[1-9]|[1-2][0-9]|3[0-1])\b/' => 'Y.m.d',
                '/\b\d{4}\.(0[1-9]|[1-2][0-9]|3[0-1])\.(0[1-9]|1[0-2])\b/' => 'Y.d.m',
                '/\b(0[1-9]|[1-2][0-9]|3[0-1])\.(0[1-9]|1[0-2])\.\d{4}\b/' => 'd.m.Y',
                '/\b(0[1-9]|1[0-2])\.(0[1-9]|[1-2][0-9]|3[0-1])\.\d{4}\b/' => 'm.d.Y',

                // for 24-hour | hours seconds
                '/\b(?:2[0-3]|[01][0-9]):[0-5][0-9](:[0-5][0-9])\.\d{3,6}\b/' => 'H:i:s.u',
                '/\b(?:2[0-3]|[01][0-9]):[0-5][0-9](:[0-5][0-9])\b/' => 'H:i:s',
                '/\b(?:2[0-3]|[01][0-9]):[0-5][0-9]\b/' => 'H:i',

                // for 12-hour | hours seconds
                '/\b(?:1[012]|0[0-9]):[0-5][0-9](:[0-5][0-9])\.\d{3,6}\b/' => 'h:i:s.u',
                '/\b(?:1[012]|0[0-9]):[0-5][0-9](:[0-5][0-9])\b/' => 'h:i:s',
                '/\b(?:1[012]|0[0-9]):[0-5][0-9]\b/' => 'h:i',

                '/\.\d{3}\b/' => '.v'
            );
            //$d = preg_replace('/\b\d{2}:\d{2}\b/', 'H:i',$d);
            $d = preg_replace( array_keys( $patterns ), array_values( $patterns ), $d );

            return preg_match( '/\d/', $d ) ? $null : $d;
        }
    @endphp

    @if ($confirmGuest)
        <div id="guestevent" class="uk-modal uk-modal-event uk-open uk-flex-top" style="display: flex" data-uk-modal>
            <div class="uk-modal-dialog uk-margin-auto-vertical uk-modal-body uk-animation-slide-top">
                <button class="uk-modal-close-default" type="button" data-uk-close wire:ignore></button>
                <h2>{{ __('LangDeleteKid') }}</h2>
                <div class="uk-grid uk-grid-small uk-flex uk-flex-center uk-flex-middle" data-uk-grid>
                    <div>
                        <button class="uk-button uk-modal-close" type="button">{{ __('LangNo') }}</button>
                    </div>
                    <div>
                        <button class="uk-button" wire:click.prevent="delete({{ $confirmGuest }})">{{ __('LangYes') }}</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    <br />

    <div class="uk-panel-children">
        <div class="uk-grid uk-grid-small" data-uk-grid>
            <div class="uk-width-1-1@m">
                @if (session()->has('message-guest'))
                    <div class="uk-alert-success" data-uk-alert>
                        <a class="uk-alert-close" data-uk-close></a>
                        {{ session('message-guest') }}
                    </div>
                @endif
                <div class="uk-grid uk-grid-small uk-child-width-1-1@m" data-uk-grid data-uk-height-match="target: > li > .uk-card">
                    @foreach ($guests as $guest)
                        <div>
                            <div class="uk-card uk-gift uk-guest">
                                <div class="uk-loading" wire:loading.flex wire:target="delete({{ $guest->id }})">
                                    <span data-uk-spinner></span>
                                </div>
                                <div class="uk-grid uk-grid-small uk-flex uk-flex-middle" data-uk-grid>
                                    <div class="uk-width-expand">
                                        @php $guest->birthday = \Carbon\Carbon::createFromTimestamp($guest->birthday)->format($this->format); @endphp
                                        <p>{{ $guest->name }} - <strong>{{ $guest->birthday }}</strong></p>
                                    </div>
                                    <div class="uk-child-auto">
                                        <div class="uk-grid uk-grid-small uk-flex uk-flex-middle uk-flex-center" data-uk-grid>
                                            <div>
                                                <button class="uk-button uk-button-symbol uk-flex uk-flex-middle" wire:click="edit({{ $guest->id }})" data-uk-tooltip="title: {{ __('LanEdit') }}; pos: bottom">
                                                    <span class="uk-icon" data-uk-icon="icon: pencil" wire:ignore></span>
                                                </button>
                                            </div>
                                            <div>
                                                <button class="uk-button uk-button-symbol uk-flex uk-flex-middle" wire:click="deleteConfirm({{ $guest->id }})" data-uk-tooltip="title: {{ __('LanDelete') }}; pos: bottom">
                                                    <span class="uk-icon" data-uk-icon="icon: trash" wire:ignore></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="uk-width-1-1@m">
                @if ($addMode)
                    <div class="uk-card-sand">
                        @if ($updateMode)
                            <div>
                                <form wire:submit.prevent="update" method="POST">
                                    @csrf
                                    <div class="uk-grid uk-grid-small uk-child-width-1-1@m" data-uk-grid>
                                        <div>
                                            <div class="uk-line-input">
                                                <label class="block font-medium text-sm text-gray-700"><i>*</i> {{ __('LanNameFull') }}</label>
                                                @error('name')
                                                    <div class="uk-alert-danger" data-uk-alert>
                                                        <a class="uk-alert-close" data-uk-close></a>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <input class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" wire:model.defer="name" type="text"/>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="uk-line-input">
                                                <label class="block font-medium text-sm text-gray-700"><i>*</i> Birthday</label>
                                                @error('birthday')
                                                    <div class="uk-alert-danger" data-uk-alert>
                                                        <a class="uk-alert-close" data-uk-close></a>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                @php $this->birthday = \Carbon\Carbon::createFromTimestamp($this->birthday)->format($this->format); @endphp
                                                <input class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full datepicker-here" wire:model.defer="birthday" type="text" onClick="xCal(this,'.', {{ $this->format_calendar }})" onKeyUp="xCal()" oninput="xCal()" pattern="[0-9]{2}\.[0-9]{2}\.[0-9]{4}" onFocus="maskPhone.call(this);" placeholder="__.__.____"/>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="uk-text-center">
                                                <div class="uk-button uk-button-submit">
                                                    <input type="submit" value="Save">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div>
                                <form wire:submit.prevent="store" method="POST">
                                    @csrf
                                    <div class="uk-grid uk-grid-small uk-child-width-1-1@m" data-uk-grid>
                                        <div>
                                            <div class="uk-line-input">
                                                <label class="block font-medium text-sm text-gray-700"><i>*</i> {{ __('LanNameFull') }}</label>
                                                @error('name')
                                                    <div class="uk-alert-danger" data-uk-alert>
                                                        <a class="uk-alert-close" data-uk-close></a>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <input class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" wire:model.defer="name" type="text"/>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="uk-line-input">
                                                <label class="block font-medium text-sm text-gray-700"><i>*</i> Birthday</label>
                                                @error('birthday')
                                                    <div class="uk-alert-danger" data-uk-alert>
                                                        <a class="uk-alert-close" data-uk-close></a>
                                                        {{ $message }}
                                                    </div>
                                                @enderror   

                                                <input class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full datepicker-here" wire:model.defer="birthday" type="text" onClick="xCal(this,'.', {{ $this->format_calendar }})" onKeyUp="xCal()" oninput="xCal()" pattern="[0-9]{2}\.[0-9]{2}\.[0-9]{4}" onFocus="maskPhone.call(this);" placeholder="__.__.____"/>

                                            </div>
                                        </div>
                                        <div>
                                            <div class="uk-text-center">
                                                <div class="uk-button uk-button-submit">
                                                    <input type="submit" value="Save">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
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

                @else
                    <div class="uk-flex uk-flex-middle uk-flex-left" wire:click="add()">
                        <button class="uk-button uk-button-add">Add children</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>


