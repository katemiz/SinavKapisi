<section class="section container" >

    <script src="{{ asset('/js/ckeditor5/ckeditor.js') }}"></script>
    <script src="{{ asset('/js/soru.js') }}"></script>

    <h1 class="title mb-6 has-text-weight-light is-size-1">Soru Ekle</h1>


    <div class="tabs is-boxed">
        <ul>
            @foreach ($sinavlar as $sinav)

                @if ($sinav['tur'] == 'sinav')
                    <li class="{{$active_sinav == $sinav['id'] ? 'is-active' :''}}" wire:click="sinavSec('{{$sinav['id']}}')">
                        <a>{{$sinav['title']}}</a>
                    </li>
                @endif

            @endforeach
        </ul>

    </div>

    @foreach ($sinavlar as $sinav)

        <div class="columns  is-centered  mt-0 {{$sinav['id'] != $active_sinav ? 'is-hidden' : ''}}">

            @foreach ($dersler as $ders)

                @if($ders['parent_id'] == $sinav['id'])
                    <div class="column is-2 has-background-grey-lighter	mx-1">
                        {{$ders['title']}}
                    </div>
                @endif
            @endforeach

        </div>

    @endforeach












    <form action="{{ $soru ? '/soru-upd/'.$bina->id : '/soru-add' }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{$active_sinav}}


        <div class="field">
            <input type="hidden" name="editor_data" id="ckeditor" value="{{$soru ? $soru->remarks : ''}}">
            <label class="label">Soru arka metin içeriği</label>
            <div class="column" id="editor">{!!$soru ? $soru->remarks: ''!!}</div>
        </div>

        <div class="field">
            <input type="hidden" name="editor_data" id="ckeditor2" value="{{$soru ? $soru->remarks : ''}}">
            <label class="label">Soru metni</label>
            <div class="column" id="editor2">{!!$soru ? $soru->remarks: ''!!}</div>
        </div>







            <div class="column has-text-right">
                <button type="submit" class="button is-link is-light">{{$soru ? 'Güncelle' : 'Kaydet'}}</button>
            </div>

        </form>












</section>

