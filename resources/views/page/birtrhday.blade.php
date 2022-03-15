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
            <div>Формат даты: <span id="format"></span></div>
        @else
            <p>
            Calc
            </p>
            <div>Format date: <span id="format"></span></div>
        @endif

        <script>
            //Create a known date string
            var y = new Date(2020, 9, 25);
            //var lds = y.toLocaleDateString('en-US');
            var lds = y.toLocaleDateString();
            //search for the position of the year, day, and month
            var yPosi = lds.search("2020");
            var dPosi = lds.search("25");
            var mPosi = lds.search("10");
            //Sometimes the month is displayed by the month name so guess where it is
            if(mPosi == -1)
            {
                mPosi = lds.search("9");
                if(mPosi == -1)
                {
                    //if the year and day are not first then maybe month is first
                    if(yPosi != 0 && dPosi != 0)
                    {
                        mPosi = 0;
                    }
                    //if year and day are not last then maybe month is last
                    else if((yPosi+4 <  lds.length) && (dPosi+2 < lds.length)){
                        mPosi = Infinity;
                    }
                    //otherwist is in the middle
                    else  if(yPosi < dPosi){
                        mPosi = ((dPosi - yPosi)/2) + yPosi;            
                    }else if(dPosi < yPosi){
                        mPosi = ((yPosi - dPosi)/2) + dPosi;
                    }   
                }

            }
            var formatString="";
            var order = [yPosi, dPosi, mPosi];
            order.sort(function(a,b){return a-b});

            for(i=0; i < order.length; i++)
            {
                if(order[i] == yPosi)
                {
                    formatString += "Y-";
                }else if(order[i] == dPosi){
                    formatString += "d-";
                }else if(order[i] == mPosi){
                    formatString += "m-";
                }
            }
            formatString = formatString.substring(0, formatString.length-1);
            //alert(formatString);
            document.getElementById('format').innerHTML = formatString;
        </script>
    </div>
</div>
@endsection