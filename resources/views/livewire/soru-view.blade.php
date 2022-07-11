<x-app-layout>
<section class="section container" >

    @if ($add_form || $secenek)
    <script src="{{ asset('/js/ckeditor5/ckeditor.js') }}"></script>
    @endif

    <script src="{{ asset('/js/delete_secenek.js') }}"></script>


    <div class="column section container box">

        <nav class="level">
            <!-- Left side -->
            <div class="level-left">
                <h1 class="soru_no">S{{$soru->id}} - {{$soru->sinav}} {{$soru->ders}}</h1>
            </div>

            <!-- Right side -->
            <div class="level-right">
                <a href="/soru-edit/{{$soru->id}}" class="icon" data-toggle="tooltip" title='Soru İçeriği Değiştir'>
                    <x-icon icon="edit" fill="{{config('constants.icons.color.active')}}"/>
                </a>
            </div>
        </nav>

        <div class="column box has-background-light py-4 my-4 is-size-4">
            {!! $soru->soru_background !!}
        </div>

        <div class="column box has-background-light py-4 my-4 is-size-4">
            {!! $soru->soru !!}
        </div>


        <div class="column my-3">
            <nav class="level">
                <!-- Left side -->
                <div class="level-left">
                    <h1 class="title has-text-weight-light is-size-1">Cevap Şıkları</h1>
                </div>

                <!-- Right side -->
                <div class="level-right">
                    <a href="/secenek-form/{{$soru->id}}/0" class="button">
                        <x-icon icon="plus" fill="{{config('constants.icons.color.active')}}"/>
                        Cevap Şıkkı Ekle
                    </a>
                </div>
            </nav>
        </div>


        @if ($add_form)
        <x-secenek-form :soru="$soru" secenek="{{false}}"/>
        @endif




        <div class="column">
            @if ($soru->secenekler)
                @foreach ($soru->secenekler as $k => $sec)

                    @if ($secenek && $secenek->id == $sec->id)
                        <x-secenek-form :soru="$soru" :secenek="$sec"/>
                    @else

                        <div class="columns box my-1 p-0">
                            <div class="column is-narrow has-text-weight-bold has-text-info">{{$harfler[$k] }})</div>
                            <div class="column px-3 has-text-weight-light is-size-4">{!! $sec->icerik !!}</div>
                            <div class="column is-narrow has-text-weight-bold has-text-info">


                                <form method="POST" action="/secenek-del/{{$soru->id}}/{{$sec->id}}" id="fs{{$sec->id}}">
                                    @csrf

                                    <a href="/secenek-form/{{$soru->id}}/{{$sec->id}}" class="icon" data-toggle="tooltip" title='Düzenle'>
                                        <x-icon icon="edit" fill="{{config('constants.icons.color.active')}}"/>
                                    </a>

                                    <a onclick="deleteConfirm({{$sec->id}})" class="icon" data-toggle="tooltip" title='Sil'>
                                        <x-icon icon="delete" fill="{{config('constants.icons.color.danger')}}"/>
                                    </a>
                                </form>
                            </div>
                        </div>

                    @endif
                @endforeach
            @endif
        </div>



    </div>



</section>

</x-app-layout>
