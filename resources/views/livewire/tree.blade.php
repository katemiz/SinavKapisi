<section class="section container">

    <script src="{{ asset('/js/tree.js') }}"></script>

    <header class="my-6">
        <h1 class="title has-text-weight-light is-size-1">Sınav Konuları</h1>
        <h2 class="subtitle has-text-weight-light">TYT ve AYT Sınav Kapsamı</h2>
    </header>

    <input type="hidden" id="action" value="add" />
    <input type="hidden" id="parent_id" value="0"/>
    <input type="hidden" id="id" />
    <input type="hidden" id="tur" value="sinav" />

    @if(Auth::check())
    <x-table-filter addcommand="Sınav Türü Ekle" addlink="add(0,'sinav')" showsearch="0"/>
    @endif

    @if (count($treearray) > 0)
        <div class="content">
            <div class="box">
                @foreach ($treearray as $category)
                    <x-category-item :category="$category"/>
                @endforeach
            </div>
        </div>
    @else
        <div class="notification">
            Kapsamı oluşturan Sınav Türü, Ders İsmi ve Ders konuları bulunamamıştır.
        </div>
    @endif

    <div class="modal" id="modal" wire:ignore.self>
        <div class="modal-background" onclick="toggleModal()"></div>
        <div class="modal-card">

            <header class="modal-card-head">
                <p class="modal-card-title" id="mheader">Js Dynamic</p>
                <button class="delete" aria-label="close" onclick="toggleModal()"></button>
            </header>

            <section class="modal-card-body">

                <form onsubmit="submitForm(event)" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="field">
                        <label class="label" id="finput_label">Js Dynamic</label>
                        <div class="control">
                        <input class="input" type="text" id="title" name="title"
                            placeholder="tanım"
                            value="">
                        </div>
                    </div>

                    <div class="column has-text-right">
                        <button type="submit" class="button is-link is-light" id="submit_button">Js Dynamic</button>
                    </div>

                </form>

            </section>

        </div>
    </div>

</section>
