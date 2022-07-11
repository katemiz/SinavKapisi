<x-app-layout>
<section class="section container">

    <script src="{{ asset('/js/ckeditor5/ckeditor.js') }}"></script>

    <h1 class="title mb-6 has-text-weight-light is-size-1">Soru Ekle</h1>

    <form action="/soru-insert" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" id="sders" name="sders" value="" />

        <div class="columns">

            <div class="column">
                <div class="navbar-menu is-dark mb-6">

                    <div class="navbar-item has-dropdown is-hoverable has-background-light">
                        <a class="navbar-link" id="baslik">Sınav ve Ders Seçiniz</a>
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
                        <p class="heading" id="active_sinav"></p>
                        <p class="title" id="active_ders"></p>
                    </div>
                    </div>
                </nav>

            </div>
        </div>

        <div class="field">
            <input type="hidden" name="editor_data1" id="ckeditor1" value="">
            <label class="label">Soru arka metin içeriği</label>
            <div class="column" id="editor1"></div>
        </div>

        <div class="field">
            <input type="hidden" name="editor_data2" id="ckeditor2" value="">
            <label class="label">Soru metni</label>
            <div class="column" id="editor2"></div>
        </div>

        <div class="column has-text-right">
            <button type="submit" class="button is-link is-light">Kaydet</button>
        </div>

    </form>

    <script src="{{ asset('/js/loadckeditor.js') }}"></script>

</section>
</x-app-layout>
