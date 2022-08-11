<div class="column box px-4">
    <label class="label mb-5">Sınav Türünü Seçiniz</label>

    <div class="columns">

        @foreach ($kapsam as $exm)

            <div class="column field">

                @if (isset($attributes['is_sinav_selectable']) && $attributes['is_sinav_selectable'])
                    <div class="control">
                        <label class="radio">
                            <input type="radio" name="kapsamturu" value="{{ $exm->id }}" {{ $sinav && blank($sinav->kapsam_dal_id) && blank($sinav->kapsam_ders_id) && $sinav->kapsam_sinav_id == $exm->id ? 'checked' :''}}> {{ $exm->title }}
                        </label>
                        <br>
                    </div>
                @else
                    <span class="tag is-dark">{{ $exm->title }}</span>
                @endif


                @if ($exm->dallar->count())
                    <div class="column ml-4">
                        @foreach ($exm->dallar as $dal)

                            <div class="control">
                                <label class="radio">
                                    <input type="radio" name="kapsamturu" value="{{ $exm->id }}:{{ $dal->id }}" {{ $sinav && blank($sinav->kapsam_ders_id) && $sinav->kapsam_dal_id == $dal->id ? 'checked' :'' }} > {{ $dal->title }}
                                </label>
                            </div>

                            @if ($dal->dersler->count())

                                <div class="column ml-4">

                                    @foreach ($dal->dersler as $ders)

                                    <div class="control">
                                        <label class="radio">
                                            <input type="radio" name="kapsamturu" value="{{ $exm->id }}:{{ $dal->id }}:{{ $ders->id }}" {{$sinav && $sinav->kapsam_ders_id == $ders->id ? 'checked' :''}}> {{ $ders->title }}
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
