@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-file icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
REPORT JANGKA WAKTU PESANAN DIPROSES
@endsection

@section('subtitle')
Halaman ini untuk melihat report jangka waktu pesanan diproses oleh kasir
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

{{-- REPORT --}}
<div class="main-card mb-3 card">
    <div class="card-body">
        <div class="container">
            <canvas id="chart"></canvas>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script>
    function generateReport(){

        var kota = $('#kota').val();
        $.ajax({
            method : "POST",
            url : '/admin/reports/reportWaktuPesanan',
            datatype : "json",
            data : { 
                kota : kota, _token : "{{ csrf_token() }}" 
            },
            success: function(result){
                var chart = document.getElementById('chart').getContext('2d');
                var data = JSON.parse(result);

                kantor = Object.keys(data);
                values = Object.values(data);
                
                var report = {
                labels: kantor,
                datasets: [{
                    label: '',
                    borderColor: window.chartColors.yellow,
                    backgroundColor: window.chartColors.yellow,
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
                            text: 'Grafik rata-rata jangka waktu sebuah pesanan diproses dalam satuan menit'
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
