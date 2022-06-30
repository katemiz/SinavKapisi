

        <div class="columns has-background-warning-light" >

            <div class="column is-1">

                @if (isset($category['children']) && is_array($category['children']))
                    <a class="icon" onclick="toggleShow({{$category['id']}})">
                        <x-icon icon="arrow-right" fill="{{config('constants.icons.color.active')}}"/>
                    </a>
                @else
                    <x-icon icon="tree-dot" fill="{{config('constants.icons.color.inactive')}}"/>
                @endif

            </div>

            <div class="column">
                {{$category['id']}} - {{$category['title']}}

            </div>

            <div class="column is-1" wire:click="deneme()">
                Edit
            </div>
            <div class="column is-1">
                Delete
            </div>
        </div>

        @if ( isset($category['children']) && is_array($category['children']))

        <div class="box py-0" id="box{{$category['id']}}">
            @foreach ($category['children'] as $children)

            <x-category-item :category="$children" />


            @endforeach
            </div>

        @endif



