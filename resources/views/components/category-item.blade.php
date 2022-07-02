<div class="columns is-gapless mb-0" >

    <div class="column my-0">

        @if (isset($category['children']) && is_array($category['children']))
            <a class="icon" onclick="toggleShow({{$category['id']}})">
                <span class="icon" id="iconright{{$category['id']}}">
                    <x-icon icon="arrow-right" fill="{{config('constants.icons.color.active')}}"/>
                </span>
                <span class="icon is-hidden" id="icondown{{$category['id']}}">
                    <x-icon icon="arrow-down" class="is-hidden" fill="{{config('constants.icons.color.active')}}"/>
                </span>
            </a>
        @else
            <x-icon icon="tree-dot" fill="{{config('constants.icons.color.inactive')}}"/>
        @endif

        <span class="text">{{$category['title']}}</span>

    </div>

    {{-- @if(Auth::check()) --}}
        <div class="column">
            <p class="buttons is-pulled-right">
                <button class="icon" onclick="add({{$category['id']}},'{{$category['tur']}}')">
                <span class="icon is-small">
                    <x-icon icon="plus" fill="{{config('constants.icons.color.active')}}"/>
                </span>
                </button>
                <button class="icon" onclick="edit({{$category['id']}},'{{$category['title']}}','{{$category['parent_id']}}','{{$category['tur']}}')">
                <span class="icon is-small">
                    <x-icon icon="edit" fill="{{config('constants.icons.color.active')}}"/>
                </span>
                </button>

                @if (!isset($category['children']))
                <button class="icon" onclick="deleteItem({{$category['id']}})">
                <span class="icon is-small">
                    <x-icon icon="delete" fill="{{config('constants.icons.color.active')}}"/>
                </span>
                </button>
                @endif
            </p>
        </div>
    {{-- @endif --}}

</div>

@if ( isset($category['children']) && is_array($category['children']))

    <div class="column my-0 py-0" id="box{{$category['id']}}">
        @foreach ($category['children'] as $children)
            <x-category-item :category="$children" />
        @endforeach
    </div>

@endif
