@extends('../template/layout')
@section('ogmeta')
    <meta property="og:url" content="{{ route('home') }}/">
    @if(App::isLocale('ru'))
        <meta property="og:title" content="Einsteiners - Сервис организации мероприятий">
        <meta property="og:description" content="Einsteiners - Сервис организации мероприятий">
    @else
        <meta property="og:title" content="Einsteiners - Event Management Service">
        <meta property="og:description" content="Einsteiners - Event Management Service">
    @endif
    <meta property="og:image" content="{{ route('home') }}/images/ogimage.jpg">
@endsection
@section('header-style')

@endsection
@section('stylesheet')
    
@endsection
@section('header')
    @if(App::isLocale('ru'))
        <title>Закажите вечеринку</title>
        {{--
        <meta name="description" content="Описание"/>
        <meta name="keywords" content="Ключевые слова"/>
        --}}  
    @else
        <title>Book a Party</title>
        {{--
        <meta name="description" content="Описание"/>
        <meta name="keywords" content="Ключевые слова"/>
        --}}
    @endif
@endsection
@section('style')
<style>

</style>
@endsection
@section('content')
<div class="uk-screen uk-screen-page uk-screen-create">
    <div class="uk-container uk-container-center">
        @if(App::isLocale('ru'))
            <p>
                <div class="uk-margin">
                    <div class="uk-inline">
                        <span class="uk-form-icon" data-uk-icon="icon: calendar"></span>
                        <input class="uk-input" type="date" min="1945-01-01">
                    </div>
                </div>
                <div class="uk-margin">
                    <div class="uk-inline">
                        <span class="uk-form-icon" data-uk-icon="icon: clock"></span>
                        <input class="uk-input" type="time">
                    </div>
                </div>
            </p>
        @else
            <p>
                <div class="uk-margin">
                    <div class="uk-inline">
                        <span class="uk-form-icon" data-uk-icon="icon: calendar"></span>
                        <input class="uk-input" type="date" min="1945-01-01">
                    </div>
                </div>
                <div class="uk-margin">
                    <div class="uk-inline">
                        <span class="uk-form-icon" data-uk-icon="icon: clock"></span>
                        <input class="uk-input" type="time">
                    </div>
                </div>
            </p>
        @endif

        <br /><br /><br /><br /><br /><br /><br /><br />

        <input type="date" class="mt-1 block w-full" value="949442017" />
        <pre> Если сервер передает дату 01.02.2000 в формате милисекунд (949442017) напрямую в value input - Дата выводиться не корреткная < input type="date" value="949442017" /> </pre>
        <br /><br /><br /><br /><br /><br /><br /><br />
        <br />
        Если не разбирать дату: То получаем не верный вывод даты меняц->день (Так как сервер не знает что идет первым (DD/MM или MM/DD))<br /><br />
        В обратную сторону данное правило тоже будет работать. При получении данных сервером и переводе даты в (timestamp) серверу необходимо явно сообщить как верно понимать строку где месяц а где день.
        <br /><br /><br /><br />
        Формат YYYY-MM-DD (*Строка 2022-02-01): (Пользователь увидет d.m.Y / {{ \Carbon\Carbon::parse('2022-02-01')->format('d.m.Y') }}) <br />
        <pre> Carbon::parse('2022-02-01')->format('d-m-Y') </pre><br />
        Формат YYYY/MM/DD (*Строка 2022/02/01): (Пользователь увидет d.m.Y / {{ \Carbon\Carbon::parse('2022/02/01')->format('d.m.Y') }}) <br />
        <pre> Carbon::parse('2022/02/01')->format('d-m-Y') </pre><br />
        Формат DD/MM/YYYY (*Строка 01/02/2022): (Пользователь увидет d.m.Y / {{ \Carbon\Carbon::parse('01/02/2022')->format('d.m.Y') }}) - Не верный<br />
        <pre> Carbon::parse('01/02/2022')->format('d-m-Y') </pre><br />
        Формат MM/DD/YYYY (*Строка 02/01/2022): (Пользователь увидет d.m.Y / {{ \Carbon\Carbon::parse('02/01/2022')->format('d.m.Y') }}) - Не верный<br />
        <pre> Carbon::parse('02/01/2022')->format('d-m-Y') </pre><br />
        Формат DD.MM.YYYY (*Строка 01.02.2022): (Пользователь увидет d.m.Y / {{ \Carbon\Carbon::parse('01.02.2022')->format('d.m.Y') }}) <br />
        <pre> Carbon::parse('01.02.2022')->format('d-m-Y') </pre><br />
        Формат MM.DD.YYYY (*Строка 02.01.2022): (Пользователь увидет d.m.Y / {{ \Carbon\Carbon::parse('02.01.2022')->format('d.m.Y') }}) - Не верный<br />
        <pre> Carbon::parse('02.01.2022')->format('d-m-Y') </pre><br />

        <br />
        <small>* Строка - формат датты которую вводить пользователь в поле ввода;</small><br />
        <small>** Carbon аналог Date();</small>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            //alert( new Date().toLocaleDateString('en-US') );
        }, false);
    </script>
</div>
@endsection