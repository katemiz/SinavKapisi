<section class="section container">

    <script>
        function selectDal(secili) {

            if (secili.value < 1) {
                Swal.fire(
                    'Uyarı',
                    'Seçili Bir Dal Var!',
                    'warning'
                )

                secili.value = document.getElementById('activepagedalid').value
                return false
            }

            document.getElementById('activepagedalid').value = secili.value
            window.livewire.emit('selectDal', secili.value)
        }

        function selectSoru(el,soruNo) {

            let islem = 'add'

            if (!el.checked) {
                islem = 'remove'
            }

            window.livewire.emit('soruSayfaRelation', islem,soruNo)
        }

        function selectDogru(el,soruNo) {
            window.livewire.emit('selectDogru', soruNo,el.value)
        }

        function deletePage(pageId) {

            Swal.fire({
                title: 'Sayfa Sil?',
                text: 'Bu sayfa ve ilgili bilgiler silinecektir. Onaylıyor musunuz?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sil',
                cancelButtonText: 'Vazgeç',

            }).then((result) => {
                if (result.isConfirmed) {
                window.livewire.emit('deletePage', pageId)
                } else {
                return false
                }
            })
        }


        function showActivePageImg() {

            document.getElementById('imgModal').classList.add('is-active')

        }

        function closeModal() {
            document.getElementById('imgModal').classList.remove('is-active')

        }
    </script>

    <header class="mb-6">
        <h1 class="title is-size-1 has-text-weight-light">Sınav Kitapçığı Sayfaları</h1>
        <h1 class="subtitle has-text-weight-light">
            {{$sinav->sinav}} {{ !blank($sinav->dal) ? ' / '.$sinav->dal:''}} {{!blank($sinav->ders) ? ' / '.$sinav->ders:''}}
            <a wire:click="editKapsam">
                <x-icon icon="arrow-down" fill="{{config('constants.icons.color.active')}}"/>
            </a>
        </h1>
    </header>


    @if ($isKapsamEdit)

        <x-kapsam-select :kapsam="$kapsam" :item="{{['kapsam_dal_id'=>false,'kapsam_ders_id'=>false]}}"/>


    @endif










    <div class="columns">

        <div class="column is-3">

            @if($active_page_id)

                <input type="hidden" id="activepagedalid" value="{{$active_page->kapsam_dal_id}}"/>

                <div class="select mb-4">
                    <select onchange="selectDal(this)">
                        <option value="0">Dal Seçimi</option>
                        @foreach ($sinav->dallar as $dal)
                        <option value="{{$dal->id}}" {{ $active_page->kapsam_dal_id == $dal->id ? 'selected':''}}>{{$dal->abbr}}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            <aside class="menu">

                <p class="menu-label">{{$sinav->id}}. Sınav Sayfaları </p>

                <div class="menu-list">

                    @foreach ($sayfalar as $sayfa)

                        @if($active_page_id == $sayfa->id)

                            <div class="field has-addons">
                                <a wire:click="changePage('{{$sayfa->id}}')" class="{{$active_page_id && $active_page_id == $sayfa->id ? 'button is-warning is-active':''}}">
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

                                <a onclick="deletePage('{{$sayfa->id}}')">
                                    <x-icon icon="delete" fill="{{config('constants.icons.color.danger')}}"/>
                                </a>
                            </div>

                        @else

                            <a wire:click="changePage('{{$sayfa->id}}')">
                                Sayfa {{$sayfa->sira}}
                            </a>

                        @endif

                    @endforeach
                </div>

            </aside>

            <a href="/sinav-ekle/{{$sinav->id}}" class="button is-link is-fullwidth mt-6">Sayfa Ekle</a>
        </div>


        @if ($active_page_id)

            <div class="column">
                <figure class="image" onmouseover="changeCursor(this,true)" onmouseout="changeCursor(this,false)" onclick="showActivePageImg()">
                    <img src="{{ $active_page_data }}" >
                </figure>
            </div>

            <div class="column is-2">
                @for ($i=1;$i<=$sayfaSayisi;$i++)
                    <div class="columns">
                        <div class="column is-half">
                            <label class="checkbox">
                            <input type="checkbox" {{ !blank($active_page->sorular->where('soruno',$i)) ? 'checked':'' }} onclick="selectSoru(this,'{{$i}}')"> S {{$i}}</label>
                        </div>

                        <div class="column">

                            @if (!blank($active_page->sorular->where('soruno',$i)))
                                <select onchange="selectDogru(this,'{{$i}}')">
                                    <option>Doğru?</option>
                                    @foreach (config('constants.harfler') as $harf)
                                    <option value="{{$harf}}" {{ !blank($active_page->sorular->where('dogrusecenek',$i)) && $active_page->sorular->where('dogrusecenek',$i) == $harf ? 'selected':''}}>{{$harf}}</option>
                                    @endforeach
                                </select>
                            @else
                                <p>&nbsp;</p>
                            @endif
                        </div>
                    </div>
                @endfor
            </div>

        @else
            <p>sss</p>
        @endif

    </div>


    <div class="modal" id="imgModal">
        <div class="modal-background" onclick="closeModal()"></div>
        <div class="modal-content">
          <p class="image">
            <img src="{{ $active_page_data }}" >
          </p>
        </div>
        <button class="modal-close is-large" aria-label="close" onclick="closeModal()"></button>
    </div>









</section>



