<div class="column section container box">

    <nav class="level">
        <!-- Left side -->
        <div class="level-left">
            <h1 class="soru_no">S{{$soru->id}} - {{$soru->sinav}} {{$soru->ders}}</h1>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <a onclick="editSoru({{$soru->id}})" class="icon">
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



    {{-- <div class="column is-hidden" id="secenek_form" wire:ignore>

        <h1 class="subtitle" id="hidden_form_header">js dynamic</h1>

        <form onsubmit="submitFormSecenek(event)" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" id="actiontype" value="secenek_add">
            <input type="hidden" id="qid" name="qid" value="{{$soru->id}}">

            <div class="field">
                <input type="hidden" name="editor_data" id="ckeditor1" value="">
                <div class="column" id="editor1"></div>
            </div>

            <div class="column field">
                <label class="label" for="dogruyanlis">Bu seçenek doğru mu?</label>

                <div class="control" id="dogruyanlis">
                    <label class="radio">
                    <input type="radio" name="dogru_mu" value="0">
                    Yanlış Seçenek
                    </label>
                    <br>
                    <label class="radio">
                    <input type="radio" name="dogru_mu" value="1">
                    Doğru Seçenek
                    </label>
                </div>
            </div>

            <footer class="modal-card-foot">
                <button class="button is-success" type="submit">Kaydet</button>
                <a class="button" onclick="cancelSecenekAction()">Cancel</a>
            </footer>

        </form>
    </div> --}}




    <div class="column" id="secenekler">
        @if ($soru->secenekler)
            @foreach ($soru->secenekler as $k => $secenek)
                <div class="columns box my-1 p-0" id="secenek{{$secenek->id}}">
                    <div class="column is-narrow has-text-weight-bold has-text-info">{{$harfler[$k] }})</div>
                    <div class="column px-3 has-text-weight-light is-size-4">{!! $secenek->icerik !!}</div>
                    <div class="column is-narrow has-text-weight-bold has-text-info">
                        <a onclick="editSecenek('{{$secenek->id}}','{{$secenek->icerik}}','{{$secenek->dogru_mu}}')" class="icon">
                            <x-icon icon="edit" fill="{{config('constants.icons.color.active')}}"/>
                        </a>
                        <a onclick="deleteSecenekConfirm({{$soru->id}},{{$secenek->id}})" class="icon">
                            <x-icon icon="delete" fill="{{config('constants.icons.color.danger')}}"/>
                        </a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <div class="column has-text-right">
        <button type="button" onclick="addSecenek()" class="button is-link is-light">Seçenek Ekle</button>
    </div>

    <div class="modal" id="modal" wire:ignore>
        <div class="modal-background" onclick="toggleModal()"></div>
        <div class="modal-card">
          <header class="modal-card-head">
            <p class="modal-card-title">Cevap Seçeneği</p>
            <button class="delete" aria-label="close"  onclick="toggleModal()"></button>
          </header>
          <section class="modal-card-body">
            <form onsubmit="submitFormSecenek(event)" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" id="actiontype" value="secenek_add">
                <input type="hidden" id="qid" name="qid" value="{{$soru->id}}">

                <div class="field">
                    <input type="hidden" name="editor_data" id="ckeditor1" value="">
                    <div class="column" id="editor1"></div>
                </div>

                <div class="column field">
                    <label class="label" for="dogruyanlis">Bu seçenek doğru mu?</label>

                    <div class="control" id="dogruyanlis">
                        <label class="radio">
                        <input type="radio" name="dogru_mu" value="0">
                        Yanlış Seçenek
                        </label>
                        <br>
                        <label class="radio">
                        <input type="radio" name="dogru_mu" value="1">
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

