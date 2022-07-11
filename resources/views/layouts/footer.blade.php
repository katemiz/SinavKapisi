
<div class="has-background-grey has-text-white has-text-right pr-3 is-size-7 py-3">
    {{config('constants.company.motto')}}
</div>
<footer class="footer has-background-dark">

    <div class="tile is-ancestor">

        <article class="tile is-child has-text-centered-mobile">
            <img src="/images/{{config('constants.company.logo')}}" width="28px" alt="{{config('constants.company.logo')}}">
            <p class="has-text-weight-light has-text-white">{{config('constants.company.name')}}</p>
        </article>

        <article class="tile is-child is-3 has-text-centered my-6 mx-2">
            <p class="has-text-weight-light has-text-centered-mobile has-text-warning">{{config('constants.app.name')}}</p>

            <figure class="image flex is-centered">
                <img alt="happy end" class="hero-background" src="/images/happy.svg">
            </figure>
            <p class="has-text-weight-light has-text-centered-mobile has-text-white">{{config('constants.app.title')}}</p>
            <p class="has-text-weight-light has-text-centered-mobile has-text-white">{{config('constants.app.description')}}</p>


        </article>


        <article class="tile is-child has-text-right has-text-white">
            <p class="has-text-weight-light has-text-right has-text-centered-mobile">{{config('constants.app.copyright')}}</p>
            <p class="has-text-weight-light has-text-right is-size-7 has-text-centered-mobile">{{config('constants.app.version')}}</p>
        </article>

    </div>

</footer>
