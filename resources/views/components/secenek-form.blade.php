
<div class="column">
    <form action="{{$secenek ? '/secenek-upd/'.$soru->id.'/'.$secenek->id : '/secenek-ins/'.$soru->id }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="field" id="field_editor">
            <input type="hidden" name="editor_data" id="ckeditor" value="{{$secenek ? $secenek->icerik : ''}}">
            <div class="column" id="editor"></div>
        </div>

        <div class="column field">
            <label class="label" for="evsahibi">Bu seçenek doğru mu?</label>

            <div class="control" id="evsahibi">
                <label class="radio">
                <input type="radio" name="dogru_mu" value="0" {{$secenek && $secenek->dogru_mu == 0 ? 'checked' : ''}}>
                Yanlış Seçenek
                </label>
                <br>
                <label class="radio">
                <input type="radio" name="dogru_mu" value="1" {{$secenek && $secenek->dogru_mu == 1 ? 'checked' : ''}}>
                Doğru Seçenek
                </label>
            </div>
        </div>

        <footer class="modal-card-foot">
            <button class="button is-success" type="submit">{{$secenek ? 'Güncelle':'Şık Ekle'}}</button>
            <a class="button"  href="/soru-view/{{$soru->id}}">Vazgeç</a>
        </footer>

    </form>
</div>

<script src="{{ asset('/js/secenek.js') }}"></script>

