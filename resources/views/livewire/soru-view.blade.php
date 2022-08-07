<x-app-layout>
<section class="section container" >

    @if ($add_form || $secenek)
    <script src="{{ asset('/js/ckeditor5/ckeditor.js') }}"></script>
    @endif

    <script src="{{ asset('/js/esoru_view.js') }}"></script>


    <div class="column section container box">

        <nav class="level">
            <!-- Left side -->
            <div class="level-left">
                <h1 class="soru_no">S{{$soru->id}} - {{$soru->sinav}} {{$soru->ders}}</h1>
            </div>

            @if (!$soru->is_published)
            <!-- Right side -->
            <div class="level-right">
                <a onclick="checkPublish('{{$soru->id}}')" class="icon" data-toggle="tooltip" title='Soru Yayınla'>
                    <x-icon icon="publish" fill="{{config('constants.icons.color.active')}}"/>
                </a>

                <a href="/esoru-form/{{$soru->id}}" class="icon" data-toggle="tooltip" title='Soru İçeriği Değiştir'>
                    <x-icon icon="edit" fill="{{config('constants.icons.color.active')}}"/>
                </a>
            </div>
            @endif
        </nav>

        <div class="column content py-4 my-4 is-size-5">{!! $soru->soru_background !!}</div>
        <div class="column content box has-background-light py-4 my-4 is-size-4">{!! $soru->soru !!}</div>

        @if (!$soru->is_published)
        <div class="column my-3">
            <nav class="level">
                <!-- Left side -->
                <div class="level-left">
                    <h1 class="title has-text-weight-light is-size-3">Cevap Şıkları</h1>
                </div>

                <!-- Right side -->
                <div class="level-right">
                    <a href="/esoru/secenek-form/{{$soru->id}}" class="button is-link is-light">
                        <x-icon icon="plus" fill="{{config('constants.icons.color.active')}}"/>
                        Cevap Şıkkı Ekle
                    </a>
                </div>
            </nav>
        </div>
        @endif


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


                            @if (!$soru->is_published)
                            <div class="column is-narrow has-text-weight-bold has-text-info">

                                <form method="POST" action="/secenek-del/{{$soru->id}}/{{$sec->id}}" id="fs{{$sec->id}}">
                                    @csrf

                                    <x-icon icon="{{$sec->dogru_mu ? 'correct':'wrong'}}" fill="{{config('constants.icons.color.inactive')}}"/>

                                    <a href="/esoru/secenek-form/{{$soru->id}}/{{$sec->id}}" class="icon" data-toggle="tooltip" title='Düzenle'>
                                        <x-icon icon="edit" fill="{{config('constants.icons.color.active')}}"/>
                                    </a>

                                    <a onclick="deleteConfirm({{$sec->id}})" class="icon" data-toggle="tooltip" title='Sil'>
                                        <x-icon icon="delete" fill="{{config('constants.icons.color.danger')}}"/>
                                    </a>
                                </form>
                            </div>
                            @endif
                        </div>

                    @endif
                @endforeach
            @endif
        </div>



        @if ($publish_errors)

            <div class="content notification is-danger is-light">
                <h1 class="subtitle">Eksiklikler</h1>

                <ol>

                @foreach ( $publish_errors as $error)

                <li>{{$error}}</li>

                @endforeach
                </ol>
            </div>

        @endif

    </div>

</section>

</x-app-layout>
