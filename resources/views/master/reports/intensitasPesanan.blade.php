@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-map-2 icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    REPORT INTENSITAS PESANAN TIAP KANTOR
@endsection

@section('subtitle')
    Halaman ini untuk melihat report banyaknya resi yang telah terbentuk di kantor tertentu.
@endsection

@section('content')
<label class="">Kota</label>
<div class="form-row">
    <div class="col-md-5">
        <div class="position-relative form-group">
            <div class="form-check-inline col-md-7">
                <select id="kota" class="form-control" required>
                    @foreach ($allKota as $kota)
                        <option class="form-control" value="{{$kota->nama}}">{{$kota->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-check-inline">
                <button class="mt-2 btn btn-primary" onclick="generateReport()">Generate</button>
            </div>
        </div>
    </div>
</div>

<div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
    <div class="main-card mb-3 card">
        <div class="card-body">
            <div class="container" id="report-container">
                <canvas id="chart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $("#app-sidebar__heading").addClass("mm-active");
        $("#btn-intensitas-pesanan").attr("aria-expanded", "true");
        $("#list-intensitas-pesanan").attr("class", "mm-collapse mm-show");
        $("#header-intensitas-pesanan").attr("class", "mm-active");

    })
    
    function generateReport(){
        $('#report-container').html(`
            <canvas id="chart"></canvas>
        `);

        var kota = $('#kota').val();
        $.ajax({
            method : "POST",
            url : '/admin/reports/reportIntensitasPesanan',
            datatype : "json",
            data : { 
                kota : kota, _token : "{{ csrf_token() }}" 
            },
            success: function(result){
                var chart = document.getElementById('chart').getContext('2d');
                var data = JSON.parse(result);

                kantor = data[0];
                values = data[1];

                console.log(kantor);
                
                var report = {
                labels: kantor,
                datasets: [{
                    label: 'Jumlah Resi yang terbentuk',
                    borderColor: window.chartColors.green,
                    backgroundColor: window.chartColors.green,
                    fill: false,
                    data: values,
                    yAxisID: 'y-axis-1',
                    cubicInterpolationMode: 'monotone'
                    }],
                };

                var myBarChart = new Chart(chart, {
                    type: 'bar',
                    data: report,
                    options: {
                        responsive: true,
                        hoverMode: 'index',
                        stacked: false,
                        title: {
                            display: true,
                            text: 'Grafik banyaknya resi yang terbentuk tiap kantor'
                        },
                        scales: {
                            yAxes: [{
                                type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                                display: true,
                                position: 'left',
                                id: 'y-axis-1',
                            }],
                        }
                    }
                });
            },
            error: function(){
                console.log('error');
            }
        });
    }
</script>
@endsection
