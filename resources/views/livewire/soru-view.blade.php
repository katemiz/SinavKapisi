<x-app-layout>


<section class="section container" >

    <div class="column section container box">
        <h1 class="soru_no">S{{$soru->id}}</h1>

        <div class="column box has-background-light py-4 my-4 is-size-4">
            {!! $soru->soru !!}
        </div>

        <div class="column">
            <div class="columns box my-1 p-0">
                <div class="column is-narrow has-text-weight-bold has-text-info">A)</div>
                <div class="column ">
                    <div class="columns">
                        <div class="column px-3 has-text-weight-light is-size-4">
                            <p>Biz bu yollardan yavaşyavaş buralara geldik.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="columns box my-1 p-0">
                <div class="column is-narrow has-text-weight-bold has-text-info">B)</div>
                <div class="column ">
                    <div class="columns">
                        <div class="column px-3 has-text-weight-light is-size-4">
                            <p>Çolukçocuk, bu işlere bulaşacaksa burada işimiz yok bizim.</p>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="columns box my-1 p-0">
                    <div class="column is-narrow has-text-weight-bold has-text-info">C)</div>
                    <div class="column ">
                        <div class="columns">
                            <div class="column px-3 has-text-weight-light is-size-4">
                                <p>Ömür dediğin düşe kalka büyüyen bir çocuk gibi geçip gider.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="columns box my-1 p-0">
                    <div class="column is-narrow has-text-weight-bold has-text-info">D)</div>
                    <div class="column ">
                        <div class="columns">
                            <div class="column px-3 has-text-weight-light is-size-4">
                                <p>Misafirlerin karşısında süklümpüklüm oturdum.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="columns box my-1 p-0">
                    <div class="column is-narrow has-text-weight-bold has-text-info">E)</div>
                    <div class="column ">
                        <div class="columns">
                            <div class="column px-3 has-text-weight-light is-size-4">
                                <p>Yanayakıla pişmanlıklarından bahsetti.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


















</section>
</x-app-layout>
