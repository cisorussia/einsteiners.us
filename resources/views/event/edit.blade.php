@extends('../template/layout')
@section('ogmeta')
    <meta property="og:url" content="{{ route('home') }}">
    <meta property="og:title" content="Редактирование: {{ $event['name'] }} - Einsteiners - Сервис организации мероприятий">
    <meta property="og:description" content="Редактирование: {{ $event['name'] }} - Einsteiners - Сервис организации мероприятий">
    <meta property="og:image" content="{{ route('home') }}/images/ogimage.jpg">
@endsection
@section('stylesheet')
    
@endsection
@section('header')
    <title>Редактирование: {{ $event['name'] }} - Einsteiners - Сервис организации мероприятий</title>     
    <meta name="description" content="Описание"/>
    <meta name="keywords" content="Ключевые слова"/>
@endsection
@section('style')
<style>

</style>
@endsection
@section('script')
<script>
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
<div class="uk-screen uk-screen-page uk-screen-create">
    <div class="uk-container uk-container-center">
        <div class="uk-panel">
            @if (session('success'))
                <div class="uk-alert-success" data-uk-alert>
                    <a class="uk-alert-close" data-uk-close></a>
                    {{ session('success')}}
                </div>
            @endif
            <form method="POST" action="{{ route('event.update', $event['id']) }}" enctype="multipart/form-data">
                @php
                    $date = new DateTime($event['date_event']);
                @endphp
                @csrf
                @method('PUT')
                <input name="user_id" type="hidden" required value="{{ $user }}"/>
                <div class="uk-grid uk-grid-small uk-child-width-1-1@m" data-uk-grid>
                    <div>
                        <div class="uk-line-input">
                            <label for="name"><i>*</i> {{ __('Name') }}</label>
                            <input id="name" class="uk-input" name="name" type="text" value="{{ $event['name'] }}" required/>
                        </div>
                    </div>
                    <div>
                        @if($event['cover_path'])
                            <div>
                                <div>
                                    <div id="preview" class="uk-preview">
                                        <span>
                                            <img data-src="{{ route('storage') }}/{{ $event['cover_path'] }}" data-uk-img alt="">
                                        </span>
                                    </div>
                                </div>
                                <div class="js-upload uk-placeholder uk-text-center">
                                    <span uk-icon="icon: cloud-upload"></span>
                                    <span class="uk-text-middle">Замените изображение обложки</span>
                                    <div uk-form-custom>
                                        <input  id="file" type="file" name="image">
                                        <span class="uk-link">здесь</span>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div>
                                <div>
                                    <div id="preview" class="uk-preview"></div>
                                </div>
                                <div class="js-upload uk-placeholder uk-text-center">
                                    <span uk-icon="icon: cloud-upload"></span>
                                    <span class="uk-text-middle">Загрузите изображение обложки</span>
                                    <div uk-form-custom>
                                        <input  id="file" type="file" name="image">
                                        <span class="uk-link">здесь</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div>
                        <div class="uk-line-input">
                            <label for="date"><i>*</i> Дата события</label>
                            <input id="date" class="uk-input" name="date_event" type="datetime-local" value="@php echo date_format($date,"Y-m-j") . "T" . date_format($date,"h:m:s"); @endphp" required/>
                        </div>
                    </div>
                    <div>
                        <div class="uk-line-input">
                            <label for="location"><i>*</i> Место проведения</label>
                            <input id="location" class="uk-input" name="location" type="text" value="{{ $event['location'] }}" required/>
                        </div>
                    </div>
                    <div>
                        <div class="uk-line-input">
                            <label for="category"><i>*</i> Категория</label>
                            <select id="category" name="category_id" class="uk-select">
                                @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->id }}" @if($categorie->id == $event['category_id']) selected @endif>{{ $categorie->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <div class="uk-line-input">
                            <label for="description"><i>*</i> Описание</label>
                            <textarea id="description" class="uk-textarea" name="description" rows="5" required>{{ $event['description'] }}</textarea>
                        </div>
                    </div>
                    <div>
                        <div class="uk-line-input">
                            <label for="tags"><i>*</i> Поисковые теги</label>
                            <input id="tags" class="uk-input" name="tags" type="text" value="{{ $event['tags'] }}" required/>
                        </div>
                    </div>
                    <div>
                        <div class="uk-text-center">
                            <div class="uk-button">
                                <input type="submit" value="Сохранить изменения">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection