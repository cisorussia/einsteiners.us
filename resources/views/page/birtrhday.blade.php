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
            Калькулятор
            </p>
        @else
            <p>
            Calc
            </p>
        @endif
    </div>
</div>
@endsection