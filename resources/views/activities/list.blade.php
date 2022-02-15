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

@endsection
@section('script')
    <script>
        function DescriptionGift () {
            UIkit.notification({
                message: this.getAttribute('data-description'),
                status: 'primary uk-message-notification',
                pos: 'bottom-center',
                timeout: 5000
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
    </script>
@endsection
@section('content')
    <div class="uk-screen uk-screen-catalog uk-screen-page">
        <div class="uk-container uk-container-center">
            @if (session('success'))
                <div class="uk-alert-success" data-uk-alert>
                    <a class="uk-alert-close" data-uk-close></a>
                    {{ session('success')}}
                </div>
            @endif
            <div>
                <livewire:view.activitielist-component>
            </div>
        </div>
    </div>
@endsection