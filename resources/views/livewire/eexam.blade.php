
<div class="column">

    <script>

        function changeCursor2(el, isIn) {
            el.style.cursor = 'pointer'

            if (isIn) {
                el.classList.add('has-background-success-light')
            } else {
                el.classList.remove('has-background-success-light')
            }
        }

        // function selectOpt(el) {

        //     el.classList.remove('has-background-danger')
        //     el.classList.add('has-background-primary')


        // }

    </script>


    <div class="column content py-4 my-4 is-size-6-mobile">{!! $qprops->soru_background !!}</div>
    <div class="column content box has-background-primary-light py-4 my-4 is-size-6 is-size-6-mobile">{!! $qprops->soru !!}</div>




    @foreach ($qprops->secenekler as $k => $sec)

        <article class="message letter_{{$k}} {{$sec->id == $cur_sel_option ? 'cevap_selected':''}}" onmouseover="changeCursor2(this,true)" onmouseout="changeCursor2(this,false)" wire:click="selectOpt('{{$sec->id}}')">
            <div class="message-body pl-6">
                {!! $sec->icerik !!}
            </div>
        </article>

    @endforeach




</div>
