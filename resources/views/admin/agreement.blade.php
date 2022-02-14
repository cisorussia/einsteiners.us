@extends('../template/layout')
@section('ogmeta')
    <meta property="og:url" content="{{ route('home') }}">
    <meta property="og:title" content="Документы - Einsteiners - Сервис организации мероприятий">
    <meta property="og:description" content="Документы - Einsteiners - Сервис организации мероприятий">
    <meta property="og:image" content="{{ route('home') }}/images/ogimage.jpg">
@endsection
@section('stylesheet')
    
@endsection
@section('header')
    <title>Документы - Einsteiners - Сервис организации мероприятий</title>     
    <meta name="description" content="Описание"/>
    <meta name="keywords" content="Ключевые слова"/>
@endsection
@section('style')

@endsection
@section('content')
    <div class="uk-screen uk-screen-page uk-screen-events">
        <div class="uk-container uk-container-center">
            @if (session('success'))
                <div class="uk-alert-success" data-uk-alert>
                    <a class="uk-alert-close" data-uk-close></a>
                    {{ session('success')}}
                </div>
            @endif
            <div>
                <livewire:admin.agreement-component>
            </div>
        </div>
    </div>
@endsection