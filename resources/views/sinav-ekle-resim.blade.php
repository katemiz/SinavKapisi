<x-app-layout>



    <div class="section container">

        <header>
            <h1 class="title is-size-1 has-text-weight-light">Sınav Ekle</h1>

        </header>


        <div class="columns">

            @foreach ($kapsam as $parent)

                <div class="column">
              {{ $parent->title }}
                @if ($parent->children->count())
                  <ul>
                    @foreach ($parent->children as $child)
                      <li>{{ $child->title }}</li>
                    @endforeach
                  </ul>
                @endif
                </div>
            @endforeach
        </div>




        <div class="column field">
            <label class="label" for="evsahibi">Ev Sahibi/Kiracı</label>

            <div class="control" id="evsahibi">
                <label class="radio">
                <input type="radio" name="sahiplik" value="1" {{$sakin && $sakin->is_evsahibi == '1' ? 'checked': ''}}>
                Ev Sahibi
                </label>
                <br>
                <label class="radio">
                <input type="radio" name="sahiplik" value="0" {{$sakin && $sakin->is_evsahibi == '0' ? 'checked': ''}}>
                Kiracı
                </label>
            </div>
        </div>











        <div class="column box mt-6">

            <form action="{{ '/assets-storefiles' }}" method="POST" enctype="multipart/form-data">
            @csrf


            <div class="field">
                <label class="label">Asset title</label>
                <div class="control">
                <input class="input" type="text" name="title"
                    placeholder="eg. My vacation in Istanbul, My birthday party"
                    value="rrr">
                </div>
            </div>

            {{-- @if ($asset) --}}

            {{-- <div class="field">

                <div class="column">
                <table class="table is-striped  is-fullwidth" >
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Size</th>
                            <th>Type</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($asset->images)
                            @foreach ($asset->images as  $image)
                                <x-file-tr :dbfile="$image" prefix='image'/>
                            @endforeach
                        @endif

                        @if ($asset->audio)
                            @foreach ($asset->audio as  $audio)
                                <x-file-tr :dbfile="$audio" prefix='audio'/>
                            @endforeach
                        @endif

                        @if ($asset->video)
                            @foreach ($asset->video as  $video)
                                <x-file-tr :dbfile="$video" prefix='video'/>
                            @endforeach
                        @endif

                        @if ($asset->docs)
                            @foreach ($asset->docs as  $doc)
                                <x-file-tr :dbfile="$doc" prefix='doc'/>
                            @endforeach
                        @endif

                        @if ($asset->dosyalar)
                            @foreach ($asset->dosyalar as  $dosya)
                                <x-file-tr :dbfile="$dosya" prefix='dosya'/>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                </div> --}}
            {{-- @endif --}}

                <div class="columns">

                    <div class="column is-2">
                    <div class="file is-boxed">
                        <label class="file-label">
                        <input
                            class="file-input"
                            type="file"
                            name="assets[]"
                            id="fupload"
                            multiple
                            onchange="getNames()" />
                        <span class="file-cta">
                            <span class="file-icon">
                            <x-icon icon="upload" fill="{{config('constants.icons.color.active')}}"/>
                            </span>
                            <span class="file-label">Files</span>
                        </span>
                        </label>
                    </div>
                    </div>

                    <div class="column">
                        <table class="table is-striped  is-fullwidth" >
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Size</th>
                                    <th>Type</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody id="filesList">
                            </tbody>

                            <tfoot id="noFile">
                            <tr>
                                <td colspan="4" class="has-text-centered">No files selected yet!</td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>

            <div class="field">
                <input type="hidden" name="editor_data" id="ckeditor" value="">
                <label class="label">Notes/Remarks</label>
                <div class="column" id="editor"></div>
            </div>

            <div class="column has-text-right">
                <button type="submit" class="button is-link is-light">Kaydet</button>
            </div>

            </form>

        </div>

    </div>




</x-app-layout>
