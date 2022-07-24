<!DOCTYPE html>
<html lang="tr">
  <head>
    <meta charset="utf-8" />

    <link  rel="icon" type="image/svg+xml" href="{{ asset(Config::get('constants.favicon')) }}" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link  href="{{ asset('/css/app.css') }}" rel="stylesheet" />
    <link  href="{{ asset('/css/bulma.css') }}" rel="stylesheet" />
    <script src="{{ asset('/js/js.js') }}"></script>



    {{-- <script src="https://unpkg.com/chart.js@^2.9.3/dist/Chart.min.js"></script>
    <script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script> --}}

    {{-- <script src="{{ asset('/js/chartisan.js') }}"></script> --}}



  </head>
  <body>


    <section class="section container">

    <!-- Chart's container -->
    <div id="chart" style="height: 300px;"></div>

</section>
    <!-- Charting library -->
    <script src="https://unpkg.com/chart.js@2.9.3/dist/Chart.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>
    <!-- Your application script -->
    <script>
      const chart = new Chartisan({
        el: '#chart',
        url: "/js/chartisan.json",
        // You can also pass the data manually instead of the url:
        // data: { ... }


        hooks: new ChartisanHooks()
            .colors(['#ECC94B', '#4299E1'])
            .responsive()
            .beginAtZero()
            .legend({ position: 'bottom' })
            .title('This is a sample chart using chartisan!')
            .datasets([{ type: 'line', fill: true }, { type: 'line', fill: false }]),




      })






    </script>

  </body>
</html>
