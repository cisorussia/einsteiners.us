@extends('../template/layout')
@section('ogmeta')
    <meta property="og:url" content="{{ route('home') }}">
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
        <title>Контакты</title>
        {{--
        <meta name="description" content="Описание"/>
        <meta name="keywords" content="Ключевые слова"/>
        --}}  
    @else
        <title>Сontact</title>
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
<div class="uk-screen uk-screen-page uk-screen-create uk-screen-contact">
    <div class="uk-container uk-container-center">
        @if(App::isLocale('ru'))
            <h1>Контакты</h1>
            <div class="uk-grid uk-grid-small uk-child-width-1-1" data-uk-grid>
                <div>
                    <div class="uk-grid uk-grid-small uk-flex uk-flex-middle" data-uk-grid>
                        <div class="uk-icon" data-uk-icon="icon: mail"></div> <div>info@einsteiners.us</div>
                    </div>
                </div>
                <div>
                    <div class="uk-grid uk-grid-small uk-flex uk-flex-middle" data-uk-grid>
                        <div class="uk-icon" data-uk-icon="icon: location"></div> <div>Pheasant Lane Mall; 310 Daniel Webster Hwy, Nashua, NH, 03060 <small>(2nd floor, just out of the elevator)</small></div>
                    </div>
                </div>
            </div>
            <div class="uk-map uk-margin-top">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2932.1320402645842!2d-71.43840028204887!3d42.700924847595665!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89e3ba675a27778f%3A0xae3aaad0339c335!2z0KTQtdC30LDQvdGCINCb0LXQudC9INCc0L7Qu9C7!5e0!3m2!1sru!2sru!4v1631357483152!5m2!1sru!2sru" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div>
                <div class="uk-flex uk-flex-center uk-margin-top">
                    <div class="uk-button">
                        <a href="https://g.page/PheasantLaneMall?share" target="_blank">Проложить маршрут</a>
                    </div>
                </div>
            </div>
        @else
            <h1>Сontact</h1>
            <div class="uk-grid uk-grid-small uk-child-width-1-1" data-uk-grid>
                <div>
                    <div class="uk-grid uk-grid-small uk-flex uk-flex-middle" data-uk-grid>
                        <div class="uk-icon" data-uk-icon="icon: mail"></div> <div>info@einsteiners.us</div>
                    </div>
                </div>
                <div>
                    <div class="uk-grid uk-grid-small uk-flex uk-flex-middle" data-uk-grid>
                        <div class="uk-icon" data-uk-icon="icon: location"></div> <div>Pheasant Lane Mall; 310 Daniel Webster Hwy, Nashua, NH, 03060 <small>(2nd floor, just out of the elevator)</small></div>
                    </div>
                </div>
            </div>
            <div class="uk-map uk-margin-top">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2932.1320402645842!2d-71.43840028204887!3d42.700924847595665!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89e3ba675a27778f%3A0xae3aaad0339c335!2z0KTQtdC30LDQvdGCINCb0LXQudC9INCc0L7Qu9C7!5e0!3m2!1sru!2sru!4v1631357483152!5m2!1sru!2sru" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div>
                <div class="uk-flex uk-flex-center uk-margin-top">
                    <div class="uk-button">
                        <a href="https://g.page/PheasantLaneMall?share" target="_blank">build a route</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection