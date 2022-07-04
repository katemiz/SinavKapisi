<div class="section container">

    <header class="my-6">
        <h1 class="title has-text-weight-light is-size-1">Sorular</h1>
        <h2 class="subtitle has-text-weight-light">Henüz Yayımlanmamış Sorular</h2>
    </header>

    {{-- NOTIFICATION --}}
    @if ($notification)
        <div class="notification {{$notification["type"]}} is-light">{!! $notification["message"] !!}</div>
    @endif

    <x-table-filter add="Bina Ekle" addcommand="Soru Ekle" addlink="/bina-form" showsearch="{{$sorular->total() > 0 ? true:false}}"/>

    @if ($sorular->total() > 0)

        <!-- ************************ -->
        <!-- TABLE                    -->
        <!-- ************************ -->
        <table class="table is-fullwidth">

            <caption>Toplam <b>{{ $sorular->total() }}</b> soru vardır</caption>

            <thead>
                <tr>

                    <th>Sınav</th>
                    <th>Ders</th>

                    <th>
                        <span class="icon-text" wire:click="sortBy('title')">
                            <span class="icon {{ $sortDirection === 'asc' ? 'is-hidden' : ''}}">
                                <x-icon icon="arrow-up" fill="{{config('constants.icons.color.active')}}"/>
                            </span>
                            <span class="icon {{ $sortDirection === 'desc' ? 'is-hidden' : ''}}">
                                <x-icon icon="arrow-down" fill="{{config('constants.icons.color.active')}}"/>
                            </span>
                            <span>Soru</span>
                        </span>
                    </th>

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

                @foreach ($sorular as $soru)

                <tr>

                    <td>{{$soru->sinav}}</td>
                    <td>{{$soru->ders}}</td>


                    <td>
                        <a href="/bina-view/{{$soru->id}}">
                            {!! $soru->soru !!}
                        </a>
                    </td>

                    <td>
                        {{ $soru->created_at }}
                    </td>



                    <td class="has-text-right">
                    <a href="/soru-view/{{$soru->id}}" class="icon">
                        <x-icon icon="eye" fill="{{config('constants.icons.color.active')}}"/>

                    </a>
                    <a href="/soru-form/{bina.id}/{item.id}" class="icon">
                        <x-icon icon="edit" fill="{{config('constants.icons.color.active')}}"/>
                    </a>
                    </td>
                </tr>

                @endforeach

            </tbody>

        </table>

        {{ $sorular->links()}}

    @else
        <div class="notification is-warning is-light">Yönettiğiniz bina bulunmamaktadır.</div>
    @endif

</div>
