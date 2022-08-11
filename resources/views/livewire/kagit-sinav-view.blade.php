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
        <h1 class="title is-size-1 has-text-weight-light">Kağıt Sınav Sayfaları</h1>
        <div class="columns" wire:click="editKapsam">

            <div class="column is-narrow">
                <a>
                    @if ($isKapsamEdit)

                    <x-icon icon="eye-closed" fill="{{config('constants.icons.color.active')}}"/>
                    @else
                    <x-icon icon="eye" fill="{{config('constants.icons.color.active')}}"/>


                    @endif
                </a>
            </div>
            <div class="column">
                <h1 class="subtitle has-text-weight-light">
                    {{$sinav->sinav}} {{ $sinav->dal != null ? ' / '.$sinav->dal:''}} {{$sinav->ders != null ? ' / '.$sinav->ders:''}}
                </h1>
            </div>


        </div>
    </header>

    @if ($isKapsamEdit)
        <x-kapsam-select :kapsam="$kapsam" :sinav="$sinav" is_sinav_selectable="1"/>
    @endif


    @if (count($publish_errors) > 0)
    <div class="notification is-danger content">
        <ul>
        @foreach ($publish_errors as $key => $hata)

            @if ($key == 'eksik_sorular')
            <ul>
                @foreach ($hata as $k => $h)
                    <li>{{$k}} - Eksik Sorular :{{implode(',',array_keys($h))}}</li>
                @endforeach
            </ul>

            @else
            <li>{{$hata}}</li>
            @endif

        @endforeach
        </ul>

        <p class="mt-4">Bu hali ile kağıt sınav yayınlanamaz</p>
    </div>
    @endif

    @if ($is_publishable)
    <div class="notification is-success content">
        Herhangi bir eksiklik yoktur. Yayınlanabilir

        <button class="button is-primar">Yayınla</p>
    </div>
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

                    @if ($sayfalar->count() > 0)
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
                                <a wire:click="changePage('{{$sayfa->id}}')">Sayfa {{$sayfa->sira}}</a>
                            @endif

                        @endforeach
                    @else
                        <p>Henüz hiç sayfa yok</p>
                    @endif
                </div>

            </aside>

            <a href="/kagit-sinav/{{$sinav->id}}" class="button is-link is-fullwidth mt-6">Sayfa Ekle</a><br>
            <a wire:click="sinavPublish" class="button is-dark is-fullwidth ">Yayınla</a>

        </div>


        @if ($active_page_id )

            <div class="column">
                <figure class="image" onmouseover="changeCursor(this,true)" onmouseout="changeCursor(this,false)" onclick="showActivePageImg()">
                    <img src="{{ $active_page_data }}" >
                </figure>
            </div>

            @if ($active_dal_id)
            <div class="column is-2">
                @for ($i=1;$i<=$sayfaSayisi;$i++)
                    <div class="columns">
                        <div class="column is-half">
                            <label class="checkbox">
                            <input type="checkbox" {{ !blank($active_page->sorular->where('soruno',$i)) ? 'checked':'' }} onclick="selectSoru(this,'{{$i}}')"> S {{$i}}</label>
                        </div>

                        <div class="column">
                            @foreach ($active_page->sorular as $soru)
                                @if($soru->soruno == $i)
                                    <select onchange="selectDogru(this,'{{$i}}')">
                                        <option>Doğru Şık?</option>
                                        @foreach (config('constants.harfler') as $harf)
                                            <option value="{{$harf}}" {{ $soru->dogrusecenek == $harf ? 'selected':''}}>{{$harf}}</option>
                                        @endforeach
                                    </select>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endfor
            </div>
            @endif

        @else
            <div class="column">

                <h1 class="subtitle has-text-weight-light">Kağıt Sınav İçin Sayfa Düzenlemesi</h1>

                <div class="content">

                    <p>Yapılacaklar</p>

                    <ul>

                        <li>Her sayfa için, sayfada var olan soruların ait olduğu sınav/ders seçilecektir</li>
                        <li>Her sayfa için, sayfada var olan soruların numaraları işaretlenecektir</li>
                        <li>İşaretlenmiş her soru için doğru cevap şıkkı belirlenecektir.</li>
                        <li>Sayfaların sırası (aşağı/yukarı doğru taşınabilirler) sınav sırasındaki sırayı oluşturmaktadır</li>
                    </ul>

                </div>

            </div>
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
