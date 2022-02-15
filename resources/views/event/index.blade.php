@extends('../template/layout')
@section('ogmeta')
    <meta property="og:url" content="{{ route('home') }}">
    <meta property="og:title" content="События - Einsteiners - Сервис организации мероприятий">
    <meta property="og:description" content="События - Einsteiners - Сервис организации мероприятий">
    <meta property="og:image" content="{{ route('home') }}/images/ogimage.jpg">
@endsection
@section('stylesheet')
    
@endsection
@section('header')
    <title>События - Einsteiners - Сервис организации мероприятий</title>     
    <meta name="description" content="Описание"/>
    <meta name="keywords" content="Ключевые слова"/>
@endsection
@section('style')
<style>

</style>
@endsection
@section('script')
<script>
    function confirm() {
        var element = this.getAttribute('data-point'); 
        UIkit.modal.confirm('Удалить событие?').then(function () {
            document.getElementById(element).submit();
        });
    };
    function confirmGift() {
        var element = this.getAttribute('data-point'); 
        UIkit.modal.confirm('Удалить подарок?').then(function () {
            document.getElementById(element).submit();
        });
    };
    function confirmGuest() {
        var element = this.getAttribute('data-point'); 
        UIkit.modal.confirm('Удалить подарок?').then(function () {
            document.getElementById(element).submit();
        });
    };
    function CopyTo() {
        var copy = this.getAttribute('data-copy');
        var range = document.createRange();
        range.selectNode(document.getElementById(copy));
        window.getSelection().removeAllRanges(); // clear current selection
        window.getSelection().addRange(range); // to select text
        document.execCommand("copy");
        window.getSelection().removeAllRanges();// to deselect
        UIkit.notification({
            message: '<span data-uk-icon="icon: copy"></span> Ссылка скопирована',
            status: 'primary uk-message-notification',
            pos: 'top-center',
            timeout: 5000
        });
    };
    function AddGift () {
        document.getElementById('eveid').value = this.getAttribute('data-event');
        UIkit.modal('#addgift').show();
    };
    function AddGuest () {
        document.getElementById('gueid').value = this.getAttribute('data-event');
        UIkit.modal('#addguest').show();
    };
    function DescriptionGift () {
        UIkit.notification({
            message: this.getAttribute('data-description'),
            status: 'primary uk-message-notification',
            pos: 'bottom-center',
            timeout: 5000
        });
    };
    function handleFileSelect(evt) {
        var file = evt.target.files; // FileList object
        var f = file[0];
        // Only process image files.
        if (!f.type.match('image.*')) {
            alert("Image only please....");
        }
        var reader = new FileReader();
        // Closure to capture the file information.
        reader.onload = (function(theFile) {
            document.getElementById('preview').innerHTML = '';
            return function(e) {
                // Render thumbnail.
                var span = document.createElement('span');
                span.innerHTML = ['<img title="', escape(theFile.name), '" data-src="', e.target.result, '" data-uk-img />'].join('');
                document.getElementById('preview').insertBefore(span, null);
            };
        })(f);
        // Read in the image file as a data URL.
        reader.readAsDataURL(f);
    }
    document.getElementById('file').addEventListener('change', handleFileSelect, false);
</script>
@endsection
@section('content')
    <div id="addgift" class="uk-modal-consent uk-modal-add" data-uk-modal>
        <div class="uk-modal-dialog uk-margin-auto-vertical" data-uk-scrollspy="cls: uk-animation-shake">
            <div class="uk-card-modal">
                <button class="uk-modal-close-default" type="button" data-uk-close></button>
                <form method="POST" action="{{ route('gift.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input name="user_id" type="hidden" required value="{{ $user['id'] }}"/>
                    <input id="eveid" name="event_id" type="hidden" required value=""/>
                    <div class="uk-grid uk-grid-small uk-child-width-1-1@m" data-uk-grid>
                        <div>
                            <div class="uk-line-input">
                                <label for="name"><i>*</i> Название подарка</label>
                                <input id="name" class="uk-input" name="name" type="text" required/>
                            </div>
                        </div>
                        <div>
                            <div>
                                <div id="preview" class="uk-preview"></div>
                            </div>
                            <div class="js-upload uk-placeholder uk-text-center">
                                <span uk-icon="icon: cloud-upload"></span>
                                <span class="uk-text-middle">Загрузите изображение подарка</span>
                                <div uk-form-custom>
                                    <input  id="file" type="file" name="image">
                                    <span class="uk-link">здесь</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="uk-line-input">
                                <label for="description"><i>*</i> Описание</label>
                                <textarea id="description" class="uk-textarea" name="description" rows="5" required></textarea>
                            </div>
                        </div>
                        <div>
                            <div class="uk-line-input">
                                <label for="link_market"><i>*</i> Ссылка на товар</label>
                                <input id="link_market" class="uk-input" name="link_market" type="text" required/>
                            </div>
                        </div>
                        <div>
                            <div class="uk-text-center">
                                <div class="uk-button">
                                    <input type="submit" value="Добавить подарок">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="addguest" class="uk-modal-consent uk-modal-add" data-uk-modal>
        <div class="uk-modal-dialog uk-margin-auto-vertical" data-uk-scrollspy="cls: uk-animation-shake">
            <div class="uk-card-modal">
                <button class="uk-modal-close-default" type="button" data-uk-close></button>
                <form method="POST" action="{{ route('guest.store') }}">
                    @csrf
                    <input name="user_id" type="hidden" required value="{{ $user['id'] }}"/>
                    <input id="gueid" name="event_id" type="hidden" required value=""/>
                    <div class="uk-grid uk-grid-small uk-child-width-1-1@m" data-uk-grid>
                        <div>
                            <div class="uk-line-input">
                                <label for="gname"><i>*</i> ФИО <small>(Будет отображено в приглашение)</small></label>
                                <input id="gname" class="uk-input" name="name" type="text" required/>
                            </div>
                        </div>
                        <div>
                            <div class="uk-line-input">
                                <label for="grole"><i>*</i> Роль</label>
                                <input id="grole" class="uk-input" name="role" type="text" required/>
                            </div>
                        </div>
                        <div>
                            <div class="uk-line-input">
                                <label for="task"><i>*</i> Задание</label>
                                <textarea id="task" class="uk-textarea" name="task" rows="5" required></textarea>
                            </div>
                        </div>
                        <div>
                            <div class="uk-line-input">
                                <label for="gemail"><i>*</i> {{ __('Email') }} <small>(На этот адрел будет отправленно приглашение)</small></label>
                                <input id="gemail" class="uk-input" name="email" type="text" required/>
                                
                            </div>
                        </div>
                        <div>
                            <div class="uk-text-center">
                                <div class="uk-button">
                                    <input type="submit" value="Добавить подарок">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="uk-screen uk-screen-page uk-screen-events">
        <div class="uk-container uk-container-center">
            @if (session('success'))
                <div class="uk-alert-success" data-uk-alert>
                    <a class="uk-alert-close" data-uk-close></a>
                    {{ session('success')}}
                </div>
            @endif
            @if($events->count() === 0)
                <div class="uk-message-clean">
                    <div>
                        <span data-uk-icon="icon: album; ratio: 3"></span>
                        <h2>Список событий пуст</h2>
                        <div class="uk-button-card uk-button">
                            <a class="uk-button" href="{{ route('event.create') }}">Создать событие</a>
                        </div>
                    </div>
                </div>
            @else
                <div class="uk-grid uk-grid-small uk-child-width-1-1@m" data-uk-grid>
                    @foreach ($events as $event)
                        @php
                            $date = new DateTime($event['date_event']);
                        @endphp
                        <div id="element-{{ $event['id'] }}">
                            <div class="uk-panel">
                                @if($event['cover_path'])
                                    <div class="uk-image" data-src="{{ route('storage') }}/{{ $event['cover_path'] }}" data-uk-img></div>
                                @endif
                                @if($event['date_event'] > date('Y-m-d H:i:s'))
                                    <div class="uk-panel-time">
                                        <div class="uk-grid uk-grid-small uk-child-width-auto" data-uk-grid data-uk-countdown="date: @php echo date_format($date,"Y-m-d") . "T" . date_format($date,"h:m:s"); @endphp">
                                            <div>
                                                <div class="uk-countdown-number uk-countdown-days"></div>
                                                <div class="uk-countdown-label uk-margin-small uk-text-center">Дни</div>
                                            </div>
                                            <div class="uk-countdown-separator">:</div>
                                            <div>
                                                <div class="uk-countdown-number uk-countdown-hours"></div>
                                                <div class="uk-countdown-label uk-margin-small uk-text-center">Часы</div>
                                            </div>
                                            <div class="uk-countdown-separator">:</div>
                                            <div>
                                                <div class="uk-countdown-number uk-countdown-minutes"></div>
                                                <div class="uk-countdown-label uk-margin-small uk-text-center">Минуты</div>
                                            </div>
                                            <div class="uk-countdown-separator">:</div>
                                            <div>
                                                <div class="uk-countdown-number uk-countdown-seconds"></div>
                                                <div class="uk-countdown-label uk-margin-small uk-text-center">Секунды</div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="uk-content">
                                    <div class="uk-grid uk-flex uk-flex-middle" data-uk-grid>
                                        <div class="uk-width-expand@m">

                                            <div class="uk-grid uk-grid-small uk-child-width-1-2@m uk-flex uk-flex-middle"" data-uk-grid>
                                                <div>
                                                    <div class="uk-grid-small uk-flex uk-flex-middle">
                                                        <div>
                                                            <a href="{{ route('home') }}/event/view/{{ $event['link'] }}" title="{{ $event['name'] }}">
                                                                <h2>{{ $event['name'] }}</h2>
                                                            </a>
                                                        </div>
                                                        <div>
                                                            <a class="uk-button uk-button-symbol" href="{{ route('event.edit', $event['id']) }}" data-uk-tooltip="title: Редактировать; pos: bottom">
                                                                <span data-uk-icon="icon: pencil"></span>
                                                            </a>
                                                        </div>
                                                        <div>
                                                            <form id="event-{{ $event['id'] }}" method="POST" action="{{ route('event.destroy', $event['id']) }}">@csrf @method('DELETE')
                                                                <button class="uk-button uk-button-symbol" type="button" class="uk-confirm" onclick="confirm.call(this);" data-point="event-{{ $event['id'] }}" data-uk-tooltip="title: Удалить; pos: bottom">
                                                                    <span data-uk-icon="icon: trash"></span>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="uk-link-panel">
                                                        <div class="uk-grid uk-grid-collapse uk-flex uk-flex-middle" data-uk-grid>
                                                            <div class="uk-width-expand@xs">
                                                                <div class="uk-flex uk-flex-middle">
                                                                    <span class="uk-icon-link" data-uk-icon="icon: link"></span> <span class="uk-label-link">Поделиться ссылкой:</span> <span class="uk-text-link" id="copy-{{ $event['id'] }}">{{ route('home') }}/event/view/{{ $event['link'] }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="uk-width-auto@xs">
                                                                <button type="button" data-uk-tooltip="title: Копировать; pos: bottom" data-copy="copy-{{ $event['id'] }}" onclick="CopyTo.call(this)"><span data-uk-icon="icon: copy"></span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-auto@m">
                                            <div class="uk-date @if($event['date_event'] < date('Y-m-d H:i:s')) uk-passed @endif uk-flex uk-flex-middle" data-uk-tooltip="title: Дата мероприятия; pos: bottom">
                                                <span data-uk-icon="icon: calendar"></span> <span>@php echo date_format($date,"j.m.Y"); @endphp</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <ul class="uk-subnav uk-subnav-pill uk-grid uk-grid-collapse uk-child-width-expand" data-uk-switcher="connect: .uk-switcher-tab; animation: uk-animation-fade; swiping: false">
                                    <li><a href="#">Подарки</a></li>
                                    <li><a href="#">Гости</a></li>
                                </ul>
                                <div class="uk-gifts">
                                    <ul class="uk-switcher uk-switcher-tab">
                                        <li>
                                            <div data-uk-slider="finite: true">
                                                <ul class="uk-slider-items uk-grid uk-grid-small" data-uk-grid data-uk-height-match="target: > li > .uk-card">
                                                    <li>
                                                        <div class="uk-card uk-flex uk-flex-middle uk-flex-center" data-event="{{ $event['id'] }}" onclick="AddGift.call(this)">
                                                            <span data-uk-icon="icon: plus; ratio: 2.5"></span>
                                                        </div>
                                                    </li>
                                                    @foreach ($gifts as $gift)
                                                        @if ($gift->event_id == $event['id'])
                                                            <li>
                                                                <div class="uk-card uk-gift">
                                                                    @if($gift->cover_path)
                                                                        <div class="uk-gift-image">
                                                                            <div data-src="{{ route('storage') }}/{{ $gift->cover_path }}" data-uk-img></div>
                                                                        </div>
                                                                    @endif
                                                                    <p>{{ $gift->name }}</p>
                                                                    <div class="uk-grid uk-grid-small uk-flex uk-flex-middle uk-flex-center" data-uk-grid>
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
                                                                        <div>
                                                                            <form id="gift-{{ $gift->id }}" method="POST" action="{{ route('gift.destroy', $gift->id) }}">@csrf @method('DELETE')
                                                                                <button class="uk-button" type="button" class="uk-confirm" onclick="confirmGift.call(this);" data-point="gift-{{ $gift->id }}" data-uk-tooltip="title: Удалить; pos: bottom">
                                                                                    <span data-uk-icon="icon: trash"></span>
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                                <ul class="uk-slider-nav uk-dotnav uk-grid uk-grid-collapse uk-child-width-expand"></ul>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="uk-panel-guest">
                                                <div class="uk-grid uk-grid-small" data-uk-grid>
                                                    <div class="uk-child-auto@m">
                                                        <div class="uk-card uk-flex uk-flex-middle uk-flex-center" data-event="{{ $event['id'] }}" onclick="AddGuest.call(this)">
                                                            <span data-uk-icon="icon: plus; ratio: 2.5"></span>
                                                        </div>
                                                    </div>
                                                    <div class="uk-width-expand@m">
                                                        <div class="uk-grid uk-grid-small uk-child-width-1-1" data-uk-grid data-uk-height-match="target: > li > .uk-card">
                                                            @foreach ($guests as $guest)
                                                                @if ($guest->event_id == $event['id'])
                                                                    <div>
                                                                        <div class="uk-card uk-gift uk-guest">
                                                                            <div class="uk-grid uk-grid-small uk-flex uk-flex-middle" data-uk-grid>
                                                                                <div class="uk-width-expand">
                                                                                    <p>{{ $guest->name }} - <strong>{{ $guest->role }}</strong></p>
                                                                                </div>
                                                                                <div class="uk-child-auto">
                                                                                    <div class="uk-grid uk-grid-small uk-flex uk-flex-middle uk-flex-center" data-uk-grid>
                                                                                        @if($guest->task)
                                                                                            <div>
                                                                                                <button class="uk-button" data-description="<h2>{{ $guest->name }}</h2><br /> {{ $guest->task }}" onclick="DescriptionGift.call(this)" data-uk-tooltip="title: Задание; pos: bottom">
                                                                                                    <span data-uk-icon="question"></span>
                                                                                                </button>
                                                                                            </div>
                                                                                        @endif
                                                                                        <div>
                                                                                            <form id="guest-{{ $guest->id }}" method="POST" action="{{ route('guest.destroy', $guest->id) }}">@csrf @method('DELETE')
                                                                                                <button class="uk-button" type="button" class="uk-confirm" onclick="confirmGuest.call(this);" data-point="guest-{{ $guest->id }}" data-uk-tooltip="title: Удалить; pos: bottom">
                                                                                                    <span data-uk-icon="icon: trash"></span>
                                                                                                </button>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            
        </div>
    </div>
@endsection