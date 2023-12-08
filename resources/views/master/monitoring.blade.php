@extends('layout.admin.tabler')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<div class="page-header d-print-none">
    <div class="container-xl">
    <div class="row g-2 align-items-center">
        <div class="col">
        <!-- Page pre-title -->
        <h2 class="page-title">
            Monitoring Vote Caleg
        </h2>
        </div>
        <!-- Page title actions -->
    </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <h3 class="card-title">Traffic Suara</h3>
                        <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                  </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>Nama Kandidat</th>
                                    <th>% Suara</th>
                                    <th>{{ date('H:i:s') }}</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@foreach($caleg as $cd)
    <?php
        foreach($c as $cc){}
    ?>
    @push('myscripct')
        <script>
            $(function(){
                var jam = "{{ $cd->jam }}"
                var jml_vote = "{{ $cc->total }}"
                const xValues = [jam];
                const yValues = [jml_vote];

                new Chart("myChart", {
                type: "line",
                data: {
                    labels: xValues,
                    datasets: [{
                    fill: false,
                    lineTension: 0,
                    backgroundColor: "rgba(0,0,255,1.0)",
                    borderColor: "rgba(0,0,255,0.1)",
                    data: yValues
                    }]
                },
                options: {
                    legend: {display: false},
                    scales: {
                    yAxes: [{ticks: {min: 50, max:1500}}],
                    }
                }
                });
            });


        </script>
    @endpush
@endforeach
