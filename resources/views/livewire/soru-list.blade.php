<div class="section container">

    <header class="my-6">
        <h1 class="title has-text-weight-light is-size-1">eSorular</h1>
        <h2 class="subtitle has-text-weight-light">Hazırlanmakta Olan ve Yayınlanmış eSorular</h2>
    </header>

    {{-- NOTIFICATION --}}
    @if ($notification)
        <div class="notification {{$notification["type"]}} is-light">{!! $notification["message"] !!}</div>
    @endif

    <x-table-filter addcommand="eSoru Ekle" addlink="/esoru-form" showsearch="{{$sorular->total() > 0 ? true:false}}"/>

    @if ($sorular->total() > 0)

        <!-- ************************ -->
        <!-- TABLE                    -->
        <!-- ************************ -->
        <table class="table is-fullwidth">

            <caption>Toplam <b>{{ $sorular->total() }}</b> soru vardır</caption>

            <thead>
                <tr>
                    <th>
                        <span class="icon-text" wire:click="sortBy('kapsam_sinav_id')">
                            <span class="icon {{ $sortDirection === 'asc' ? 'is-hidden' : ''}}">
                                <x-icon icon="arrow-up" fill="{{config('constants.icons.color.active')}}"/>
                            </span>
                            <span class="icon {{ $sortDirection === 'desc' ? 'is-hidden' : ''}}">
                                <x-icon icon="arrow-down" fill="{{config('constants.icons.color.active')}}"/>
                            </span>
                            <span>Sınav</span>
                        </span>
                    </th>

                    <th>
                        <span class="icon-text" wire:click="sortBy('kapsam_sinav_id')">
                            <span class="icon {{ $sortDirection === 'asc' ? 'is-hidden' : ''}}">
                                <x-icon icon="arrow-up" fill="{{config('constants.icons.color.active')}}"/>
                            </span>
                            <span class="icon {{ $sortDirection === 'desc' ? 'is-hidden' : ''}}">
                                <x-icon icon="arrow-down" fill="{{config('constants.icons.color.active')}}"/>
                            </span>
                            <span>Konu</span>
                        </span>
                    </th>

                    <th>
                        <span class="icon-text" wire:click="sortBy('soru')">
                            <span class="icon {{ $sortDirection === 'asc' ? 'is-hidden' : ''}}">
                                <x-icon icon="arrow-up" fill="{{config('constants.icons.color.active')}}"/>
                            </span>
                            <span class="icon {{ $sortDirection === 'desc' ? 'is-hidden' : ''}}">
                                <x-icon icon="arrow-down" fill="{{config('constants.icons.color.active')}}"/>
                            </span>
                            <span>eSoru</span>
                        </span>
                    </th>

                    <th>
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

                    <th>
                        <span class="icon-text" wire:click="sortBy('is_published')">
                            <span class="icon {{ $sortTimeDirection === 'asc' ? 'is-hidden' : ''}}">
                                <x-icon icon="arrow-up" fill="{{config('constants.icons.color.active')}}"/>
                            </span>
                            <span class="icon {{ $sortTimeDirection === 'desc' ? 'is-hidden' : ''}}">
                                <x-icon icon="arrow-down" fill="{{config('constants.icons.color.active')}}"/>
                            </span>
                            <span>Durum</span>
                        </span>
                    </th>

                    <th class="has-text-right is-2">İşlemler</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($sorular as $soru)

                    <tr>
                        <td>{{$soru->sinav}}</td>
                        <td>{{ !blank($soru->ders) ? $soru->ders : $soru->dal}}</td>
                        <td><a href="/esoru/{{$soru->id}}">{!! $soru->soru !!}</a></td>
                        <td>{{ $soru->created_at }}</td>
                        <td>{{ $soru->is_published ? 'Yayınlanmış':'Çalışılıyor' }}</td>

                        <td class="has-text-right">
                            <a href="/esoru/{{$soru->id}}" class="icon">
                                <x-icon icon="eye" fill="{{config('constants.icons.color.active')}}"/>
                            </a>

                            @if (!$soru->is_published)
                            <a href="/esoru-form/{{$soru->id}}" class="icon">
                                <x-icon icon="edit" fill="{{config('constants.icons.color.active')}}"/>
                            </a>
                            @endif
                        </td>
                    </tr>

                @endforeach

            </tbody>

        </table>

        {{ $sorular->links()}}

    @else
        <div class="notification is-warning is-light">eSoru bulunmamaktadır.</div>
    @endif

</div>
