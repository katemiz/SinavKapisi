<x-app-layout>



    <script>

        let cicon = `<x-icon icon="cancel" fill="{{config('constants.icons.color.danger')}}"/>`

        let filesToDelete = {
            'image':[],
            'audio':[],
            'video':[],
            'doc':[],
            'dosya':[]
        }

        let filesToExclude = []

        function removeFile(prefix,id) {

            if (filesToDelete[prefix].includes(id)) {
                filesToDelete[prefix].splice(filesToDelete[prefix].indexOf(id),1)
            } else {
                filesToDelete[prefix].push(id)
            }

            document.getElementById('filesToDelete').value = JSON.stringify(filesToDelete)

            Array.from(document.getElementById(prefix+id).children).forEach(element => {

                if (element.dataset.name !== undefined && element.dataset.name === 'buttons') {

                    Array.from(element.children).forEach(el => {

                        if (Array.from(el.classList).includes('is-hidden')) {
                            el.classList.remove('is-hidden')
                        } else {
                            el.classList.add('is-hidden')
                        }
                    })
                } else {

                    if (Array.from(element.classList).includes('iptal')) {
                        element.classList.remove('iptal')
                    } else {
                        element.classList.add('iptal')
                    }
                }
            });
        }

        function cancelFile(key,fname) {

            document.getElementById(`K${key}`).remove()

            if (filesToExclude.includes(fname)) {
                filesToExclude.splice(filesToExclude.indexOf(fname),1)
            } else {
                filesToExclude.push(fname)
            }

            if (filesToExclude.length > 0) {
                document.getElementById('filesToExclude').value = filesToExclude.join()
            } else {
                document.getElementById('filesToExclude').value = ''
            }

            document.getElementById('filesToUpload').value = document.getElementById('filesToUpload').value-1

            if (document.getElementById('filesToUpload').value == 0) {
                document.getElementById('noFile').classList.remove('is-hidden')
            }
        }

        function getNames() {

            var newFiles = document.getElementById('fupload')

            if (Object.entries(newFiles.files).length < 1) {
                document.getElementById('noFile').classList.remove('is-hidden')
                return true
            }

            document.getElementById('noFile').classList.add('is-hidden')

            let satir = ''
            dosyalar = []

            for (const [key, dosya] of Object.entries(newFiles.files)) {

                satir = satir +`
                <tr id="K${key}">
                    <td>${dosya.name}</td>
                    <td>${dosya.size}</td>
                    <td>${dosya.type}</td>
                    <td><a onclick="cancelFile('${key}','${dosya.name}')">${cicon}</a></td>
                </tr>`

                dosyalar.push({key:dosya})
            }

            document.getElementById('filesToUpload').value = Object.entries(newFiles.files).length
            document.getElementById('filesToExclude').value = ''
            document.getElementById('filesList').innerHTML = satir
        }

    </script>















    <div class="section container">

        <header>
            <h1 class="title is-size-1 has-text-weight-light">Sınav Ekle</h1>
        </header>

        <label class="label my-5" for="evsahibi">Sınav Türünü Seçiniz</label>

        <form action="{{ '/sinav-storefiles' }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="columns">

                @foreach ($kapsam as $sinav)

                    <div class="column field">

                        <div class="control">
                            <label class="radio">
                                <input type="radio" name="sinavturu" value="{{ $sinav->id }}" > {{ $sinav->title }}
                            </label>
                            <br>
                        </div>



                        @if ($sinav->directDersler->count())
                        <div class="column ml-4">
                        @foreach ($sinav->directDersler as $directDers)
                            <div class="control" id="evsahibi">
                                <label class="radio">
                                    <input type="radio" name="sinavturu" value="{{ $directDers->id }}" > {{ $directDers->title }}
                                </label>
                            </div>

                        @endforeach
                        </div>
                        @endif







                        @if ($sinav->dallar->count())
                        <div class="column ml-4">
                        @foreach ($sinav->dallar as $dal)
                            <div class="control" id="evsahibi">
                                <label class="radio">
                                    <input type="radio" name="sinavturu" value="{{ $dal->id }}" > {{ $dal->title }}
                                </label>
                            </div>

                            @if ($dal->dersler->count())

                            <div class="column ml-4">

                                @foreach ($dal->dersler as $ders)

                                <div class="control" id="evsahibi">
                                    <label class="radio">
                                        <input type="radio" name="sinavturu" value="{{ $ders->id }}" > {{ $ders->title }}
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

            <div class="column box mt-6">




                    <input type="hidden" id="id" value="" autocomplete="off">
                    <input type="hidden" id="filesToUpload" value="0" autocomplete="off">
                    <input type="hidden" id="filesToDelete" name="filesToDelete" value="" autocomplete="off">
                    <input type="hidden" id="filesToExclude" name="filesToExclude" value="0" autocomplete="off">


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
                                <span class="file-label">Dosyalar</span>
                            </span>
                            </label>
                        </div>
                        </div>

                        <div class="column">
                            <table class="table is-striped  is-fullwidth" >
                                <thead>
                                    <tr>
                                        <th>Dosya Adı</th>
                                        <th>Boyut</th>
                                        <th>Dosya Türü</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody id="filesList">
                                </tbody>

                                <tfoot id="noFile">
                                <tr>
                                    <td colspan="4" class="has-text-centered">Henüz seçilmiş dosya yok!</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                    </div>

                    <div class="column has-text-right">
                        <button type="submit" class="button is-link is-light">Kaydet</button>
                    </div>


            </div>

        </form>


    </div>

</x-app-layout>
