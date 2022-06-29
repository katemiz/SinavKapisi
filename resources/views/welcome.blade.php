<x-app-layout>

    <section class="section container">

        <figure class="image is-16by9">
            <img alt="hero" class="hero-background" src="images/hero.svg">
        </figure>

        <h1 class="title mb-6 has-text-weight-light is-size-1 has-text-centered">{{config('constants.app.title')}}k</h1>

        <div class="columns is-centered">
            @foreach (config('html.boxes') as $box)

                <div class="column {{$box['class']}} m-2 p-5">
                    <h1 class="title mb-4 has-text-weight-light has-text-white">{{$box['header']}}</h1>

                    @foreach ($box['content'] as $content)
                        <p class="has-text-weight-light has-text-white mb-3">{{$content}}</p>
                    @endforeach

                    @if ($box['link'])
                        <a href="{{route('register')}}" class="button is-fullwidth">
                            <span class="icon">
                                <x-icon icon="plus" fill="{{config('constants.icons.color.active')}}"/>
                            </span>
                            <span class="ml-1">{{$box['link']['text']}}</span>
                        </a>
                    @endif
                </div>

            @endforeach
        </div>

        <h1 class="title my-6 has-text-weight-light is-size-1 has-text-centered">Günün Soruları</h1>
        <h1 class="subtitle has-text-centered">Bu soruları kayıt olmadan deneyebilirsiniz</h1>

        <div class="columns is-centered">

            @foreach (config('html.gunluk') as $sturu)

                <div class="column has-background-light has-text-centered m-2 p-5">
                    <h1 class="title mb-4 has-text-weight-light ">{{$sturu['header']}}</h1>
                    <img src="/images/{{$sturu['image']}}" alt="soru türü için görüntü">
                    <p class="has-text-weight-light">{{$sturu['motto']}}</p>
                </div>

            @endforeach

        </div>




    </section>

</x-app-layout>
