<svg
    xmlns="http://www.w3.org/2000/svg"
    width="{{ config('constants.icons.size') }}"
    height="{{ config('constants.icons.size') }}"
    viewBox="0 0 24 24"
    fill="{{ $fill }}">
    @includeIf("icons.$icon")
</svg>
