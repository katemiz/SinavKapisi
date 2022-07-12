<section class="section container" >



    <h1 class="title my-6 has-text-weight-light is-size-1 has-text-centered">Günün {{$soru->ders}} Sorusu</h1>
    <h1 class="subtitle has-text-centered">{{$soru->sinav}} {{$soru->ders}} ({{$soru->id}})</h1>









    <div class="column box has-background-lighter py-4 my-4 is-size-4">
        {!! $soru->soru_background !!}
    </div>

    <div class="column box has-background-light py-4 my-4 is-size-4">
        {!! $soru->soru !!}
    </div>






    <div class="column">

        @foreach ($soru->secenekler as $k => $secenek)

            <div
                class="columns box my-1 p-0 {{$secili_cevap && $secili_cevap == $secenek->id ? 'has-background-info-light' : ''}}"
                id="ans_opt{{$secenek->id}}"
                onmouseover="this.style.cursor='pointer'"
                wire:click="cevapSec('{{$secenek->id}}')"
            >
                <div class="column is-narrow has-text-weight-bold has-text-info">{{$harfler[$k] }})</div>
                <div class="column px-3 has-text-weight-light is-size-4">{!! $secenek->icerik !!}</div>

                @if ($is_there_response && $secili_cevap && $secili_cevap == $secenek->id)
                    <div class="column has-text-right">
                        @if($is_response_correct)
                            <x-icon icon="correct" fill="{{config('constants.icons.color.success')}}"/>
                        @else
                            <x-icon icon="wrong" fill="{{config('constants.icons.color.danger')}}"/>
                        @endif
                    </div>
                @endif

            </div>

        @endforeach

        @if ($secili_cevap)
            <div class="column has-text-right">
                <p type="button" class="button is-primary" wire:click="checkCevap('{{$secili_cevap}}')">Cevapla</p>
            </div>
        @endif

    </div>




</section>
