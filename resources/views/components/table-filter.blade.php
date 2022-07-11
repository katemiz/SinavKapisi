<nav class="level my-6">

    <!-- Left side -->
    <div class="level-left">
        <div class="level-item  has-text-centered">
            <a class="button is-link" href="{{$addlink}}">
                <span class="icon is-small">
                    <x-icon icon="plus" fill="{{config('constants.icons.color.light')}}"/>
                </span>
                <span>{{$addcommand}}</span>
            </a>
        </div>
    </div>

    @if ($showsearch)
    <!-- Right side -->
    <div class="level-right">

        <div class="level-item">
            <!-- Filter Tree Search Box -->
            <div class="field has-addons is-fullwidth is-pulled-right">

                <p class="control has-icons-left">
                    <input class="input" type="text" placeholder="ara..." oninput="searchFunction()" id="queryInput">
                    <span class="icon is-small is-left">
                        <x-icon icon="search" fill="{{config('constants.icons.color.disabled')}}"/>
                    </span>
                </p>
                <p class="control">
                    <a class="button px-1" onclick="resetFilter()">
                        <x-icon icon="cancel" fill="{{config('constants.icons.color.active')}}"/>
                    </a>
                </p>
            </div>
        </div>
    </div>
    @endif


</nav>
