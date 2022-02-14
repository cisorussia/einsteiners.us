@extends('../template/layout')
@section('ogmeta')
    <meta property="og:url" content="{{ route('home') }}">
    <meta property="og:title" content="Помощь - Einsteiners - Сервис организации мероприятий">
    <meta property="og:description" content="Помощь - Einsteiners - Сервис организации мероприятий">
    <meta property="og:image" content="{{ route('home') }}/images/ogimage.jpg">
@endsection
@section('header-style')
    
@endsection
@section('stylesheet')
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
@endsection
@section('header')
    <title>{{ __('LanCalendar') }}</title>     
    <meta name="description" content="Описание"/>
    <meta name="keywords" content="Ключевые слова"/>
@endsection
@section('style')
<style>

</style>
@endsection
@section('script')
    <script src="{{ mix('js/app.js') }}" defer></script>
@endsection
@section('content')
<div class="uk-screen uk-screen-page uk-screen-create">
    <div class="uk-container uk-container-center">
        
        <livewire:appointments-calendar
            year="2021"
            month="08"
            week-starts-at="1"
            drag-and-drop-classes="css classes"
            :day-click-enabled="false"
            :event-click-enabled="false"
            :drag-and-drop-enabled="false"
        />

    </div>
</div>
@endsection