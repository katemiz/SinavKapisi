<section class="section container">






    <header class="mb-6">
        <h1 class="title is-size-1 has-text-weight-light">Sınav Kitapçığı Sayfaları</h1>
        <h1 class="subtitle has-text-weight-light">{{$sinav->sinav}}</h1>

    </header>


    <div class="columns">

        <div class="column is-3">

            @if($active_page_id)

            <div class="select mb-4">
                <select>
                  <option>Select dropdown</option>
                  <option>With options</option>
                </select>
              </div>

            @endif




            <aside class="menu">

                <p class="menu-label">{{$sinav->id}}. Sınav Sayfaları </p>

                <div class="menu-list">

                    @foreach ($sayfalar as $sayfa)

                        @if($active_page_id == $sayfa->id)

                        <span class="icon-text">

                            <a wire:click="changePage('{{$sayfa->id}}')" class="{{$active_page_id && $active_page_id == $sayfa->id ? 'is-active':''}}">
                                Sayfa {{$sayfa->sira}}
                            </a>

                            @if($sayfa->sira < count($sayfalar))
                            <a wire:click="movePageDown('{{$sayfa->id}}')">
                                <x-icon icon="arrow-down" fill="{{config('constants.icons.color.active')}}"/>
                            </a>
                            @endif

                            @if($sayfa->sira >1)

                            <a wire:click="movePageUp('{{$sayfa->id}}')">
                                <x-icon icon="arrow-up" fill="{{config('constants.icons.color.active')}}"/>
                            </a>
                            @endif

                        </span>

                        @else

                        <a wire:click="changePage('{{$sayfa->id}}')">
                            Sayfa {{$sayfa->sira}}
                        </a>

                        @endif


                    @endforeach
                </div>

            </aside>


        </div>


        @if ($active_page_id)


        <div class="column">


            <figure class="image" onmouseover="changeCursor(this,true)" onmouseout="changeCursor(this,false)">
                <img src="{{ $active_page_data }}" >
            </figure>

        </div>
        <div class="column is-1">

            @for ($i=1;$i<=40;$i++)


            <label class="checkbox">
                <input type="checkbox">
                S {{$i}}
              </label>

              @endfor

        </div>



        @else

        <p>sss</p>

        @endif





    </div>



</section>
