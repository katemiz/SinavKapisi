<div class="section container">













    <header class="my-6">
        <h1 class="title has-text-weight-light is-size-1">Kağıt Sınavlar</h1>
        <h2 class="subtitle has-text-weight-light">Tüm Liste</h2>
    </header>

    {{-- NOTIFICATION --}}
    @if ($notification)
        <div class="notification {{$notification["type"]}} is-light">{!! $notification["message"] !!}</div>
    @endif

    <x-table-filter addcommand="Kağıt Sınav Ekle" addlink="/sinav-ekle" showsearch="{{$kagit_sinavlar->total() > 0 ? true:false}}"/>

    @if ($kagit_sinavlar->total() > 0)

        <!-- ************************ -->
        <!-- TABLE                    -->
        <!-- ************************ -->
        <table class="table is-fullwidth">

            <caption>Toplam <b>{{ $kagit_sinavlar->total() }}</b> kağıt sınav vardır.</caption>

            <thead>
                <tr>

                    <th>Sınav</th>
                    <th>Dal/Ders</th>

                    {{-- <th>
                        <span class="icon-text" wire:click="sortBy('title')">
                            <span class="icon {{ $sortDirection === 'asc' ? 'is-hidden' : ''}}">
                                <x-icon icon="arrow-up" fill="{{config('constants.icons.color.active')}}"/>
                            </span>
                            <span class="icon {{ $sortDirection === 'desc' ? 'is-hidden' : ''}}">
                                <x-icon icon="arrow-down" fill="{{config('constants.icons.color.active')}}"/>
                            </span>
                            <span>Soru</span>
                        </span>
                    </th> --}}

                    <th class="is-2">
                        <span class="icon-text" wire:click="sortBy('created_at')">
                            <span class="icon {{ $sortTimeDirection === 'asc' ? 'is-hidden' : ''}}">
                                <x-icon icon="arrow-up" fill="{{config('constants.icons.color.active')}}"/>
                            </span>
                            <span class="icon {{ $sortTimeDirection === 'desc' ? 'is-hidden' : ''}}">
                                <x-icon icon="arrow-down" fill="{{config('constants.icons.color.active')}}"/>
                            </span>
                            <span>Eklenme Zamanı</span>
                        </span>
                    </th>

                    <th class="has-text-right is-2">İşlemler</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($kagit_sinavlar as $ksinav)

                <tr>

                    <td>{{$ksinav->sinavabbr}}</td>
                    <td>{{!blank($ksinav->ders) ? $ksinav->ders : $ksinav->dal }}</td>


                    {{-- <td>
                        <a href="/soru-view/{{$ksinav->id}}">
                            {!! $ksinav->soru !!}
                        </a>
                    </td> --}}

                    <td>
                        {{ $ksinav->created_at }}
                    </td>

                    <td class="has-text-right">
                    <a href="/kagit-sinav-view/{{$ksinav->id}}" class="icon">
                        <x-icon icon="eye" fill="{{config('constants.icons.color.active')}}"/>

                    </a>
                    <a href="/kagit-sinav-view/{{$ksinav->id}}" class="icon">
                        <x-icon icon="edit" fill="{{config('constants.icons.color.active')}}"/>
                    </a>
                    </td>
                </tr>

                @endforeach

            </tbody>

        </table>

        {{ $kagit_sinavlar->links()}}

    @else
        <div class="notification is-warning is-light">Henüz hazırlanmış kağıt sınav yoktur</div>
    @endif

</div>
