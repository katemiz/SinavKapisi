<x-app-layout>
<section class="section container">

    <script src="{{ asset('/js/ckeditor5/ckeditor.js') }}"></script>

    <h1 class="title mb-6 has-text-weight-light is-size-1">Soru Güncelle</h1>

    <form action="/soru-update/{{$soru->id}}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" id="sders" name="sders" value="{{$soru->kapsam_id}}" />

        <div class="columns">

            <div class="column">
                <div class="navbar-menu is-dark mb-6">

                    <div class="navbar-item has-dropdown is-hoverable has-background-light">
                        <a class="navbar-link" id="baslik">{{$soru->sinav}} - {{$soru->ders}}</a>
                        <div class="navbar-dropdown">

                            @foreach ($sinavlar as $sinav)
                                <div class="nested dropdown">
                                    <a class="navbar-item">
                                        <span class="icon-text ">
                                            <span>{{$sinav['title']}}</span>
                                            <span class="icon">
                                                <x-icon icon="add" fill="{{config('constants.icons.color.light')}}"/>
                                            </span>
                                        </span>
                                    </a>

                                    <div class="dropdown-menu" id="dropdown-menu" role="menu">
                                        <div class="dropdown-content">
                                            @foreach ($dersler as $ders)
                                            @if($ders['parent_id'] == $sinav['id'])
                                                <a class="dropdown-item" onclick="selectSinavDers('{{$sinav['abbr']}}','{{$ders['title']}}','{{$ders['id']}}')">{{$ders['title']}}</a>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>

            <div class="column">

                <nav class="level is-pulled-right">
                    <div class="level-item has-text-right">
                    <div>
                        <p class="heading" id="active_sinav">{{$soru->sinav}}</p>
                        <p class="title" id="active_ders">{{$soru->ders}}</p>
                    </div>
                    </div>
                </nav>

            </div>
        </div>

        <div class="field">
            <input type="hidden" name="editor_data1" id="ckeditor1" value="{{$soru->soru_background}}">
            <label class="label">Soru arka metin içeriği</label>
            <div class="column" id="editor1">{{$soru->soru_background}}</div>
        </div>

        <div class="field">
            <input type="hidden" name="editor_data2" id="ckeditor2" value="{{$soru->soru}}">
            <label class="label">Soru metni</label>
            <div class="column" id="editor2">{{$soru->soru}}</div>
        </div>

        <div class="column has-text-right">
            <button type="submit" class="button is-link is-light">Kaydet</button>
        </div>

    </form>

    <script src="{{ asset('/js/loadckeditor.js') }}"></script>

</section>
</x-app-layout>
