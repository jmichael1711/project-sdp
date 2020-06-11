@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-wallet icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
REPORT PENDAPATAN
@endsection

@section('subtitle')
Halaman ini untuk melihat report pendapatan per-tahun setiap kantor.
@endsection

@section('content')
<div class="tab-content">
    @if (Session::has('success'))
        <ul class="list-group mb-2">
            <li class="list-group-item-success list-group-item">{{Session::get('success')}}</li>
        </ul>
        @php
            Session::forget('success');
        @endphp
    @endif

    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="form-row">
                    <div class="col-md-5">
                        <div class="position-relative form-group">
                            <label class="">Kota</label>
                            <select id="kota" class="form-control" onchange='isiKantor()' required>
                                @foreach ($kotas as $kota)
                                    <option class="form-control" value="{{$kota->nama}}">{{$kota->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-5">
                        <div class="position-relative form-group">
                            <label class="">Kantor</label>
                            <select name="kantor_id" id="kantor" class="form-control" required></select>
                            <div class="invalid-feedback">
                                Mohon pilih kantor asal yang valid.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-5">
                        <div class="position-relative form-group">
                            <label class="">Tahun</label>
                            <select name="tahun" id="tahun" class="form-control" onchange='' required>
                                @if ($tahun ?? false) 
                                    @for ($i = 2020; $i <= $tahun; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                @endif
                            </select>
                            <div class="invalid-feedback">
                                Mohon pilih kantor asal yang valid.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-2">
                        <button style="width: 100%" class="btn btn-primary" onclick="submit()">Lihat Grafik</button>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                        <button style="width: 100%" class="btn btn-primary" onclick="printpreview()">Print Preview</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane tabs-animation fade show active" role="tabpanel">
        <div class="main-card mb-3 card">
            <div class="card-body" id="card-report">
                <canvas id="report-chart"></canvas>
            </div>
        </div>
    </div>
    
</div>  
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        //UNTUK SIDEBAR
        $("#upperlist-pendapatan").addClass("mm-active");
        $("#btn-pendapatan").attr("aria-expanded", "true");
        $("#list-pendapatan").attr("class", "mm-collapse mm-show");
        $("#header-pendapatan").attr("class", "mm-active");
        isiKantor();
    })

    // //UNTUK KANTOR
    function isiKantor() {
        var idKota = $('#kota').val();

        $.ajax({
            method : "GET",
            url : '/admin/reports/carikantor',
            datatype : "json",
            data : { 
                kota : idKota, 
                _token : "{{ csrf_token() }}" 
            },
            success: function(result){
                $('#kantor').html(result);
            },
            error: function(){
                console.log('error');
            }
        });
    }

    function printpreview() {
        var idKantor = $('#kantor').val()
        var tahun = $('#tahun').val()

        if (!idKantor || !tahun) {
            return;
        }

        //console.log(window.location)
        window.location.href = window.location.href + "/print/" + idKantor + "/" + tahun;
    }

    function submit() {
        var idKantor = $('#kantor').val()
        var tahun = $('#tahun').val()
        $('#card-report').html(`
            <canvas id="report-chart"></canvas>
        `);

        if (!idKantor || !tahun) {
            return;
        }

        $.ajax({
            method : "GET",
            url : '/admin/reports/reportpendapatan/getdata',
            datatype : "json",
            data : { 
                idKantor: idKantor,
                tahun: tahun,  
                _token: "{{ csrf_token() }}" 
            },
            success: function(result){

                result = JSON.parse(result);
                //console.log('SUCCESS')
                //console.log(result);

                pendapatan = []
                for (let index = 0; index < result.length; index++) {
                    const element = result[index];
                    pendapatan.push(element['sum'])
                }

                //console.log(pendapatan)

                var report = document.getElementById('report-chart').getContext('2d');
                var reportLabel = @json($labels);
                var reportTitle = 'Pendapatan Kantor '+$('#kantor option:selected').html()+', ' +$('#kota option:selected').html()+' Tahun ' + $('#tahun').val()

                var reportData = {
                labels: reportLabel,
                    datasets: [{
                        label: 'Pendapatan (Rp)',
                        borderColor: window.chartColors.green,
                        backgroundColor: window.chartColors.green,
                        fill: false,
                        data: pendapatan,
                        yAxisID: 'y-axis-1',
                        cubicInterpolationMode: 'monotone'
                    }],
                };

                window.myLine = Chart.Line(report, {
                    data: reportData,
                    options: {
                        responsive: true,
                        stacked: false,
                        title: {
                            display: true,
                            text: reportTitle
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
                })
            },
            error: function(error){
                console.log('ERROR')
                console.log(error);
            }
        });
    }
   
</script>
@endsection 