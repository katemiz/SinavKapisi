<x-app-layout>
<section class="section container">

    <script src="{{ asset('/js/ckeditor5/ckeditor.js') }}"></script>

    <h1 class="title mb-6 has-text-weight-light is-size-1">eSoru Ekle</h1>

    <form action="/soru-insert" method="POST" enctype="multipart/form-data">
        @csrf

        <x-kapsam-select :kapsam="$kapsam" item="{{false}}" />

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
