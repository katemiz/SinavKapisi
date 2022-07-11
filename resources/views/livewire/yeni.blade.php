<section class="section container" >

    <script src="{{ asset('/js/ckeditor5/ckeditor.js') }}"></script>
    <script src="{{ asset('/js/question.js') }}"></script>


    @switch($actiontype)
        @case('form')
            <x-soru-form
                :soru="$soru"
                :dersler="$dersler"
                :sinavlar="$sinavlar"
                :ssinav="$selected_sinav"
                :sders="$selected_ders"
                :placeholders="$placeholders"
            />
            @break

        @case('view')
            <x-soru-view
                :soru="$soru"
                :harfler="$harfler"
            />
            @break

        @case('list')
            <x-soru-list :sorular="$sorular" />
            @break

        @case('msg')
            <x-soru-msg />
            @break

    @endswitch

</section>
