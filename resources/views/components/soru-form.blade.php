<h1 class="title mb-6 has-text-weight-light is-size-1">{{ $soru ? 'Soru Güncelle' : 'Soru Ekle' }}</h1>

<form onsubmit="submitFormSoru(event)" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="hidden" id="actiontype" value="{{$soru ? 'soru_edit' : 'soru_add'}}">
    <input type="hidden" id="qid" value="{{$soru ? $soru->id : 0}}">

    <input type="hidden" id="selected_ders" name="selected_ders" value="{{$soru ? $soru->parent_id : 0}}">

    <div class="columns">

        <div class="column">
            <div class="navbar-menu is-dark mb-6">

                <div class="navbar-item has-dropdown is-hoverable has-background-light">
                    <a class="navbar-link" id="baslik">
                        {{$ssinav ? $ssinav->abbr.' / '.$sders->title : 'Sınav ve Ders Seçiniz'}}
                    </a>
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

            <nav class="level">
                <div class="level-item has-text-centered">
                <div>
                    <p class="heading" id="active_sinav">{{$ssinav ? $ssinav->title : ''}}</p>
                    <p class="title" id="active_ders">{{$sders ? $sders->title : ''}}</p>
                </div>
                </div>
            </nav>

        </div>
    </div>

    <div class="field">
        <input type="hidden" name="editor_data" id="ckeditor1" value="{{$soru ? $soru->soru_background : ''}}">
        <label class="label">Soru arka metin içeriği</label>
        <div class="column" id="editor1">{!!$soru ? $soru->soru_background: '' !!}</div>
    </div>

    <div class="field">
        <input type="hidden" name="editor_data2" id="ckeditor2" value="{{$soru ? $soru->soru : ''}}">
        <label class="label">Soru metni</label>
        <div class="column" id="editor2">{!!$soru ? $soru->soru: ''!!}</div>
    </div>

    <div class="column has-text-right">
        <button type="submit" class="button is-link is-light">{{$soru ? 'Güncelle' : 'Kaydet'}}</button>
    </div>

</form>


