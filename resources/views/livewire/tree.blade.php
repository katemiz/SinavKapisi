<section class="section container">


    <script src="{{ asset('/js/tree.js') }}"></script>




    <header class="my-6">
        <h1 class="title has-text-weight-light is-size-1">Sınav Konuları</h1>
        <h2 class="subtitle has-text-weight-light">TYT ve AYT Sınav Kapsamı</h2>
    </header>

    <div class="content">
        <div class="box">
            @foreach ($treearray as $category)

    {{-- <div class="ml-{{$branch['level']}}">{{$branch['id']}} {{$branch['title']}}</div> --}}


    <x-category-item :category="$category" />


    @endforeach

        </div>
</div>

</section>
