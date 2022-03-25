<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>
    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>
    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />
                <x-jet-label for="photo" value="{{ __('Photo') }}" />
                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>
                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-full w-20 h-20"
                          x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>
                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-jet-secondary-button>
                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-jet-secondary-button>
                @endif
                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        @endif 
        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Name') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
            <x-jet-input-error for="name" class="mt-2" />
        </div>
        <!-- Last Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="last_name" value="{{ __('Last Name') }}" />
            <x-jet-input id="last_name" type="text" class="mt-1 block w-full" wire:model.defer="state.last_name" />
            <x-jet-input-error for="last_name" class="mt-2" />
        </div>
        <!-- Phone -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="phone" value="{{ __('Phone') }}" />
            @if (App::isLocale('ru'))
                <x-jet-input id="phone" type="text" class="mt-1 block w-full" wire:model.defer="state.phone" onFocus="maskPhone.call(this);" onkeydown="inputAction.call(this);inputLine.call(this);" onClick="inputAction.call(this);inputLine.call(this);" placeholder="+7 (9__) ___-__-__" pattern="\+7\s?[\(]{0,1}9[0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}"/>
            @else
                <x-jet-input id="phone" type="text" class="mt-1 block w-full" wire:model.defer="state.phone" onFocus="maskPhone.call(this);" onkeydown="inputAction.call(this);inputLine.call(this);" onClick="inputAction.call(this);inputLine.call(this);" placeholder="+1 (___) ___-__-__" pattern="\+1\s?[\(]{0,1}[0-9][0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}"/>
            @endif
            <x-jet-input-error for="phone" class="mt-2" />
        </div>
        <!-- Birth -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="birth" value="{{ __('Date of birth') }}" />
            @php $this->state['birth'] = \Carbon\Carbon::createFromTimestamp($this->user['birth'])->format($this->format); @endphp
            <x-jet-input id="birth" type="text" class="mt-1 block w-full datepicker-here" wire:model.defer="state.birth" onClick="xCal(this,'.', {{ $format_calendar }})" onKeyUp="xCal()" oninput="xCal()" pattern="[0-9]{2}\.[0-9]{2}\.[0-9]{4}" onFocus="maskPhone.call(this);" placeholder="__.__.____"/>
            <x-jet-input-error for="birth" class="mt-2" />
        </div>
        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>
        <!-- Vaccine -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="vaccine" value="{{ __('LangVaccine') }}" />
            @php $this->state['vaccine'] = \Carbon\Carbon::createFromTimestamp($this->user['vaccine'])->format($this->format); @endphp
            <x-jet-input id="vaccine" type="text" class="mt-1 block w-full datepicker-here" wire:model.defer="state.vaccine" onClick="xCal(this,'.', {{ $format_calendar }})" onKeyUp="xCal()" oninput="xCal()" pattern="[0-9]{2}\.[0-9]{2}\.[0-9]{4}" onFocus="maskPhone.call(this);" placeholder="__.__.____"/>
            <x-jet-input-error for="vaccine" class="mt-2" />
        </div>
        <!-- Children -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label value="Children" />
            @livewire('user.children-component', ['event_id' => '1'])
        </div>
        <x-jet-input id="format" type="hidden" wire:model.defer="state.format"/>
        <script>
            document.addEventListener('livewire:load', function () {
                var format = document.getElementById('format');
                if(LocaleFormat() == 'm.d.Y') {
                    @this.format_calendar = 2;
                    @this.format = 'm.d.Y';
                    format.value = 'm.d.Y';
                } else {
                    @this.format_calendar = 0;
                    @this.format = 'd.m.Y';
                    format.value = 'd.m.Y';
                }
                format.dispatchEvent(new Event('input'));
            });
        </script>
    </x-slot>
    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>
        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>