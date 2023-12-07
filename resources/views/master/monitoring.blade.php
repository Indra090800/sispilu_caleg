@extends('layout.admin.tabler')

@section('content')
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
                    <canvas id="mataChart" class="chartjs" width="undefined" height="undefined"></canvas>
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

@push('myscripct')
    <script>
        $(function(){

            var ctx = document.getElementById("mataChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ,
                datasets: [{
                label: 'Statistik User',
                backgroundColor: '#ADD8E6',
                borderColor: '#93C3D2',
                data: 
                }],
                options: {
                animation: {
                onProgress: function(animation) {
                    progress.value = animation.animationObject.currentStep / animation.animationObject.numSteps;
                        }
                    }
                }
            },
            });
        });


    </script>
@endpush
