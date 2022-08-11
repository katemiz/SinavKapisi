<div class="column" >

    <h1 class="title my-6 has-text-weight-light is-size-1 has-text-centered">Harun Durum</h1>
    <h1 class="subtitle has-text-centered">TYT</h1>

    <div id="chart" style="height: 600px;"></div>

    {{-- <div><pre> {{$chart}} </pre></div> --}}

    <!-- Charting library -->
    <script src="https://unpkg.com/chart.js@2.9.3/dist/Chart.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>
    <!-- Your application script -->
    <script>
      const chart = new Chartisan({
        el: '#chart',
        // url: "/js/chartisan.json",
        // You can also pass the data manually instead of the url:
        // data: { ... }

        data: {!! $chart !!},

    //     data:@php
    //    echo $chart
    //     @endphp

        hooks: new ChartisanHooks()
            .colors(['#ECC94B', '#4299E1','#707070',"#16825d","#007acc"])
            .responsive()
            .beginAtZero()
            .legend({ position: 'bottom' })
            .title('TYT')
            .datasets([{ type: 'line', fill: false }, { type: 'line', fill: false }, { type: 'line', fill: true }, { type: 'line', fill: true }, { type: 'line', fill: true }]),
      })


      console.log({!! $chart !!})

    </script>

</div>
