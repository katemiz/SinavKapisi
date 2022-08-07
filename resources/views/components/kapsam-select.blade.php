<div class="column box px-4">
    <label class="label mb-5">Sınav Türünü Seçiniz</label>

    <div class="columns">

        @foreach ($kapsam as $sinav)

            <div class="column field">

                <span class="tag is-dark">{{ $sinav->title }}</span>

                @if ($sinav->dallar->count())
                    <div class="column ml-4">
                        @foreach ($sinav->dallar as $dal)

                            <div class="control">
                                <label class="radio">
                                    <input type="radio" name="kapsamturu" value="{{ $sinav->id }}:{{ $dal->id }}" {{ $item && blank($item->kapsam_ders_id) && $item->kapsam_dal_id == $dal->id ? 'checked' :'' }} > {{ $dal->title }}
                                </label>
                            </div>

                            @if ($dal->dersler->count())

                                <div class="column ml-4">

                                    @foreach ($dal->dersler as $ders)

                                    <div class="control">
                                        <label class="radio">
                                            <input type="radio" name="kapsamturu" value="{{ $sinav->id }}:{{ $dal->id }}:{{ $ders->id }}" {{$item && $item->kapsam_ders_id == $ders->id ? 'checked' :''}}> {{ $ders->title }}
                                        </label>
                                    </div>

                                    @endforeach

                                </div>

                            @endif

                        @endforeach
                    </div>
                @endif

            </div>

        @endforeach
    </div>
</div>
