<section class="section container" >

    <script src="{{ asset('/js/ckeditor5/ckeditor.js') }}"></script>





    @if ($gui_action == 'form')

        <script src="{{ asset('/js/soru.js') }}"></script>

        <h1 class="title mb-6 has-text-weight-light is-size-1">{{ $soru ? 'Soru Güncelle' : 'Soru Ekle' }}</h1>

        <form onsubmit="submitForm(event)" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" id="action" value="{{$soru ? 'upd' : 'add'}}">
            <input type="hidden" id="qid" value="{{$soru ? $soru->id : 0}}">

            <input type="hidden" id="selected_ders" name="selected_ders" value="{{$soru ? $soru->parent_id : 0}}">
            <div class="columns">

                <div class="column">
                    <div class="navbar-menu is-dark mb-6">

                        <div class="navbar-item has-dropdown is-hoverable has-background-light">
                            <a class="navbar-link" id="baslik">{{$selected_sinav ? $selected_sinav->abbr.' / '.$selected_ders->title : 'Sınav ve Ders Seçiniz'}}</a>
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
                                                    <a class="dropdown-item" onclick="select('{{$sinav['abbr']}}','{{$ders['title']}}','{{$ders['id']}}')">{{$ders['title']}}</a>
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
                            <p class="heading" id="active_sinav">{{$selected_sinav ? $selected_sinav->title : ''}}</p>
                            <p class="title" id="active_ders">{{$selected_ders ? $selected_ders->title : ''}}</p>
                        </div>
                        </div>
                    </nav>

                </div>
            </div>

            <div class="field">
                <input type="hidden" name="editor_data" id="ckeditor" value="{{$soru ? $soru->soru_background : $soru_onu}}">
                <label class="label">Soru arka metin içeriği</label>
                <div class="column" id="editor">{!!$soru ? $soru->soru_background: $soru_onu !!}</div>
            </div>

            <div class="field">
                <input type="hidden" name="editor_data2" id="ckeditor2" value="{{$soru ? $soru->soru : $soru_ici}}">
                <label class="label">Soru metni</label>
                <div class="column" id="editor2">{!!$soru ? $soru->soru: $soru_ici!!}</div>
            </div>

            <div class="column has-text-right">
                <button type="submit" class="button is-link is-light">{{$soru ? 'Güncelle' : 'Kaydet'}}</button>
            </div>

        </form>

    @endif


    @if ($gui_action == 'view')

        <script src="{{ asset('/js/secenek.js') }}"></script>


        <div class="column section container box">

            <nav class="level">
                <!-- Left side -->
                <div class="level-left">
                    <h1 class="soru_no">S{{$soru->id}}</h1>
                </div>

                <!-- Right side -->
                <div class="level-right">
                    <a onclick="edit('{{$soru->id}}')" class="icon">
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

            <div class="column">
                @if ($soru->secenekler)
                    @foreach ($soru->secenekler as $k => $secenek)
                        <div class="columns box my-1 p-0">
                            <div class="column is-narrow has-text-weight-bold has-text-info">{{$harfler[$k] }})</div>
                            <div class="column px-3 has-text-weight-light is-size-4">{!! $secenek->icerik !!}</div>
                            <div class="column is-narrow has-text-weight-bold has-text-info">
                                <a href="/secenek-form/{{$secenek->id}}/" class="icon">
                                    <x-icon icon="edit" fill="{{config('constants.icons.color.active')}}"/>
                                </a>
                                <a onclick="deleteConfirm({{$secenek->id}})" class="icon">
                                    <x-icon icon="delete" fill="{{config('constants.icons.color.danger')}}"/>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="column has-text-right">
                <button type="button" onclick="toggleModal()" class="button is-link is-light">Seçenek Ekle</button>
            </div>

            <div class="modal" id="modal">
                <div class="modal-background" onclick="toggleModal()"></div>
                <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Cevap Seçeneği</p>
                    <button class="delete" aria-label="close"  onclick="toggleModal()"></button>
                </header>
                <section class="modal-card-body">
                    <form onsubmit="submitForm(event)" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" id="action" value="add">
                        <input type="hidden" id="qid" name="qid" value="{{$soru->id}}">

                        <div class="field">
                            <input type="hidden" name="editor_data" id="ckeditor" value="{{$soru ? $soru->soru_background : $soru_onu}}">
                            <div class="column" id="editor">{!!$soru ? $soru->soru_background: $soru_onu !!}</div>
                        </div>

                        <div class="column field">
                            <label class="label" for="evsahibi">Bu seçenek doğru mu?</label>

                            <div class="control" id="evsahibi">
                                <label class="radio">
                                <input type="radio" name="dogru_mu" value="0" {{1 == '1' ? 'checked': ''}}>
                                Yanlış Seçenek
                                </label>
                                <br>
                                <label class="radio">
                                <input type="radio" name="dogru_mu" value="1" {{1 == '0' ? 'checked': ''}}>
                                Doğru Seçenek
                                </label>
                            </div>
                        </div>

                        <footer class="modal-card-foot">
                            <button class="button is-success" type="submit">Kaydet</button>
                            <button class="button"  onclick="toggleModal()">Cancel</button>
                        </footer>

                    </form>
                </section>
                </div>
            </div>
        </div>

    @endif


</section>

