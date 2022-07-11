<section class="section container" >



    <h1 class="title my-6 has-text-weight-light is-size-1 has-text-centered">Günün Soruları</h1>
    <h1 class="subtitle has-text-centered">Bu soruları kayıt olmadan deneyebilirsiniz</h1>










    <div class="column box has-background-light py-4 my-4 is-size-4">
        {!! $soru->soru_background !!}
    </div>

    <div class="column box has-background-light py-4 my-4 is-size-4">
        {!! $soru->soru !!}
    </div>




    @foreach ($soru->secenekler as $k => $secenek)

        <div class="columns box my-1 p-0">
            <div class="column is-narrow has-text-weight-bold has-text-info">{{$harfler[$k] }})</div>
            <div class="column px-3 has-text-weight-light is-size-4">{!! $secenek->icerik !!}</div>
        </div>

    @endforeach



</section>
