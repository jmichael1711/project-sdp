@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-home icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
DASHBOARD
@endsection

@section('subtitle')
Page ini untuk menampilkan report-report penting
@endsection

@section('content')
<div class="tab-content">
    @if (Session::has('success-kantor'))
        <ul class="list-group mb-2">
            <li class="list-group-item-success list-group-item">{{Session::get('success-kantor')}}</li>
        </ul>
        @php
            Session::forget('success-kantor');
        @endphp
    @endif
    <div class="row">
        <div class="col-md-6 col-xl-6">
            <div class="card mb-3 widget-content bg-midnight-bloom">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading  ">Jumlah Kantor Cabang</div>
                            <div class="widget-subheading">Jumlah di seluruh Jawa Timur</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers">{{$jumlahKantorCabang}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-6">
            <div class="card mb-3 widget-content bg-grow-early">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Jumlah Kantor Warehouse</div>
                            <div class="widget-subheading">Jumlah di seluruh Jawa Timur</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white">{{$jumlahKantorWarehouse}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-12">
        <div class="mb-3 card">
            <div class="card-header-tab card-header">
                <div class="card-header-title">
                    <i class="header-icon lnr-rocket icon-gradient bg-tempting-azure"> </i>
                    Laporan Resi
                </div>
                <div class="btn-actions-pane-right">
                    <div class="nav">
                        <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
                            <li class="nav-item">
                                <a role="tab" class="nav-link active" id="tab-1" data-toggle="tab" href="#tab-report-resi-mingguan">
                                    <span>1 Minggu Terakhir (Per Hari)</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a role="tab" class="nav-link" id="tab-2" data-toggle="tab" href="#tab-report-resi-bulanan">
                                    <span>1 Bulan Terakhir (Per Hari)</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a role="tab" class="nav-link" id="tab-3" data-toggle="tab" href="#tab-report-resi-tahunan">
                                    <span>1 Tahun Terakhir (Per Bulan)</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade active show" id="tab-report-resi-mingguan">
                    <div class="widget-chart p-3">
                        <div>
                            <canvas id="report-resi-mingguan"></canvas>
                        </div>
                        <div class="widget-chart-content text-center mt-5">
                            <span class="widget-description mt-0 text-warning">
                                <i class="fa fa-arrow-right"></i>
                                <span class="pl-1">{{array_sum($resiProsesMingguan)}}</span>
                                <span class="text-muted opacity-8 pl-1">Dalam Proses</span>
                            </span>
                            <span class="widget-description mt-0 text-success">
                                <i class="fa fa-arrow-right"></i>
                                <span class="pl-1">{{array_sum($resiSelesaiMingguan)}}</span>
                                <span class="text-muted opacity-8 pl-1">Selesai</span>
                            <span class="widget-description mt-0 text-danger">
                                <i class="fa fa-arrow-right"></i>
                                <span class="pl-1">{{array_sum($resiCancelMingguan)}}</span>
                                <span class="text-muted opacity-8 pl-1">Cancel</span>
                            </span>
                        </div>
                    </div>
                    <div class="pt-2 card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="widget-content">
                                    <div class="widget-content-outer">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left">
                                                <div class="widget-numbers fsize-3 text-muted">{{array_sum($resiTerbentukMingguan) == 0 ? 0 : 
                                                round(array_sum($resiProsesMingguan) * 100 /
                                                array_sum($resiTerbentukMingguan))}}%</div>
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="text-muted opacity-6">Proses</div>
                                            </div>
                                        </div>
                                        <div class="widget-progress-wrapper mt-1">
                                            <div class="progress-bar-sm progress-bar-animated-alt progress">
                                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="63" 
                                                aria-valuemin="0" aria-valuemax="100" style="width: {{array_sum($resiTerbentukMingguan) == 0 ? 0 : 
                                                array_sum($resiProsesMingguan) * 100 /
                                                    array_sum($resiTerbentukMingguan)}}%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="widget-content">
                                    <div class="widget-content-outer">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left">
                                                <div class="widget-numbers fsize-3 text-muted">{{array_sum($resiTerbentukMingguan) == 0 ? 0 : 
                                                round(array_sum($resiSelesaiMingguan) * 100 /
                                                array_sum($resiTerbentukMingguan))}}%</div>
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="text-muted opacity-6">Selesai</div>
                                            </div>
                                        </div>
                                        <div class="widget-progress-wrapper mt-1">
                                            <div class="progress-bar-sm progress-bar-animated-alt progress">
                                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="63" 
                                                aria-valuemin="0" aria-valuemax="100" style="width: {{array_sum($resiTerbentukMingguan) == 0 ? 0 : 
                                                array_sum($resiSelesaiMingguan) * 100 /
                                                    array_sum($resiTerbentukMingguan)}}%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="widget-content">
                                    <div class="widget-content-outer">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left">
                                                <div class="widget-numbers fsize-3 text-muted">{{array_sum($resiTerbentukMingguan) == 0 ? 0 : 
                                                round(array_sum($resiCancelMingguan) * 100 /
                                                array_sum($resiTerbentukMingguan))}}%</div>
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="text-muted opacity-6">Cancel</div>
                                            </div>
                                        </div>
                                        <div class="widget-progress-wrapper mt-1">
                                            <div class="progress-bar-sm progress-bar-animated-alt progress">
                                                <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="63" 
                                                aria-valuemin="0" aria-valuemax="100" style="width: {{array_sum($resiTerbentukMingguan) == 0 ? 0 : 
                                                array_sum($resiCancelMingguan) * 100 /
                                                    array_sum($resiTerbentukMingguan)}}%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade active show" id="tab-report-resi-bulanan">
                    <div class="widget-chart p-3">
                        <div style="">
                            <canvas id="report-resi-bulanan"></canvas>
                        </div>
                        <div class="widget-chart-content text-center mt-5">
                            <span class="widget-description mt-0 text-warning">
                                <i class="fa fa-arrow-right"></i>
                                <span class="pl-1">{{array_sum($resiProsesBulanan)}}</span>
                                <span class="text-muted opacity-8 pl-1">Dalam Proses</span>
                            </span>
                            <span class="widget-description mt-0 text-success">
                                <i class="fa fa-arrow-right"></i>
                                <span class="pl-1">{{array_sum($resiSelesaiBulanan)}}</span>
                                <span class="text-muted opacity-8 pl-1">Selesai</span>
                            <span class="widget-description mt-0 text-danger">
                                <i class="fa fa-arrow-right"></i>
                                <span class="pl-1">{{array_sum($resiCancelBulanan)}}</span>
                                <span class="text-muted opacity-8 pl-1">Cancel</span>
                            </span>
                        </div>
                    </div>
                    <div class="pt-2 card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="widget-content">
                                    <div class="widget-content-outer">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left">
                                                <div class="widget-numbers fsize-3 text-muted">{{array_sum($resiTerbentukBulanan) == 0 ? 0 : 
                                                round(array_sum($resiProsesBulanan) * 100 /
                                                array_sum($resiTerbentukBulanan))}}%</div>
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="text-muted opacity-6">Proses</div>
                                            </div>
                                        </div>
                                        <div class="widget-progress-wrapper mt-1">
                                            <div class="progress-bar-sm progress-bar-animated-alt progress">
                                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="63" 
                                                aria-valuemin="0" aria-valuemax="100" style="width: {{array_sum($resiTerbentukBulanan) == 0 ? 0 : 
                                                array_sum($resiProsesBulanan) * 100 /
                                                    array_sum($resiTerbentukBulanan)}}%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="widget-content">
                                    <div class="widget-content-outer">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left">
                                                <div class="widget-numbers fsize-3 text-muted">{{array_sum($resiTerbentukBulanan) == 0 ? 0 : 
                                                round(array_sum($resiSelesaiBulanan) * 100 /
                                                array_sum($resiTerbentukBulanan))}}%</div>
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="text-muted opacity-6">Selesai</div>
                                            </div>
                                        </div>
                                        <div class="widget-progress-wrapper mt-1">
                                            <div class="progress-bar-sm progress-bar-animated-alt progress">
                                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="63" 
                                                aria-valuemin="0" aria-valuemax="100" style="width: {{array_sum($resiTerbentukBulanan) == 0 ? 0 : 
                                                array_sum($resiSelesaiBulanan) * 100 /
                                                    array_sum($resiTerbentukBulanan)}}%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="widget-content">
                                    <div class="widget-content-outer">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left">
                                                <div class="widget-numbers fsize-3 text-muted">{{array_sum($resiTerbentukBulanan) == 0 ? 0 : 
                                                round(array_sum($resiCancelBulanan) * 100 /
                                                array_sum($resiTerbentukBulanan))}}%</div>
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="text-muted opacity-6">Cancel</div>
                                            </div>
                                        </div>
                                        <div class="widget-progress-wrapper mt-1">
                                            <div class="progress-bar-sm progress-bar-animated-alt progress">
                                                <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="63" 
                                                aria-valuemin="0" aria-valuemax="100" style="width: {{array_sum($resiTerbentukBulanan) == 0 ? 0 : 
                                                array_sum($resiCancelBulanan) * 100 /
                                                    array_sum($resiTerbentukBulanan)}}%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade active show" id="tab-report-resi-tahunan">
                    <div class="widget-chart p-3">
                        <div style="">
                            <canvas id="report-resi-tahunan"></canvas>
                        </div>
                        <div class="widget-chart-content text-center mt-5">
                            <span class="widget-description mt-0 text-warning">
                                <i class="fa fa-arrow-right"></i>
                                <span class="pl-1">{{array_sum($resiProsesTahunan)}}</span>
                                <span class="text-muted opacity-8 pl-1">Dalam Proses</span>
                            </span>
                            <span class="widget-description mt-0 text-success">
                                <i class="fa fa-arrow-right"></i>
                                <span class="pl-1">{{array_sum($resiSelesaiTahunan)}}</span>
                                <span class="text-muted opacity-8 pl-1">Selesai</span>
                            <span class="widget-description mt-0 text-danger">
                                <i class="fa fa-arrow-right"></i>
                                <span class="pl-1">{{array_sum($resiCancelTahunan)}}</span>
                                <span class="text-muted opacity-8 pl-1">Cancel</span>
                            </span>
                        </div>
                    </div>
                    <div class="pt-2 card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="widget-content">
                                    <div class="widget-content-outer">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left">
                                                <div class="widget-numbers fsize-3 text-muted">{{array_sum($resiTerbentukTahunan) == 0 ? 0 : 
                                                round(array_sum($resiProsesTahunan) * 100 /
                                                array_sum($resiTerbentukTahunan))}}%</div>
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="text-muted opacity-6">Proses</div>
                                            </div>
                                        </div>
                                        <div class="widget-progress-wrapper mt-1">
                                            <div class="progress-bar-sm progress-bar-animated-alt progress">
                                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="63" 
                                                aria-valuemin="0" aria-valuemax="100" style="width: {{array_sum($resiTerbentukTahunan) == 0 ? 0 : 
                                                array_sum($resiProsesTahunan) * 100 /
                                                    array_sum($resiTerbentukTahunan)}}%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="widget-content">
                                    <div class="widget-content-outer">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left">
                                                <div class="widget-numbers fsize-3 text-muted">{{array_sum($resiTerbentukTahunan) == 0 ? 0 : 
                                                round(array_sum($resiSelesaiTahunan) * 100 /
                                                array_sum($resiTerbentukTahunan))}}%</div>
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="text-muted opacity-6">Selesai</div>
                                            </div>
                                        </div>
                                        <div class="widget-progress-wrapper mt-1">
                                            <div class="progress-bar-sm progress-bar-animated-alt progress">
                                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="63" 
                                                aria-valuemin="0" aria-valuemax="100" style="width: {{array_sum($resiTerbentukTahunan) == 0 ? 0 : 
                                                array_sum($resiSelesaiTahunan) * 100 /
                                                    array_sum($resiTerbentukTahunan)}}%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="widget-content">
                                    <div class="widget-content-outer">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left">
                                                <div class="widget-numbers fsize-3 text-muted">{{array_sum($resiTerbentukTahunan) == 0 ? 0 : 
                                                round(array_sum($resiCancelTahunan) * 100 /
                                                array_sum($resiTerbentukTahunan))}}%</div>
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="text-muted opacity-6">Cancel</div>
                                            </div>
                                        </div>
                                        <div class="widget-progress-wrapper mt-1">
                                            <div class="progress-bar-sm progress-bar-animated-alt progress">
                                                <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="63" 
                                                aria-valuemin="0" aria-valuemax="100" style="width: {{array_sum($resiTerbentukTahunan) == 0 ? 0 : 
                                                array_sum($resiCancelTahunan) * 100 /
                                                    array_sum($resiTerbentukTahunan)}}%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  
@endsection

@section('scripts')
<script>
$(document).ready(function () {
    $("#tab-report-resi-bulanan").removeClass("show active");
    $("#tab-report-resi-tahunan").removeClass("show active");
})

var reportResiMingguan = document.getElementById('report-resi-mingguan').getContext('2d');
var reportResiMingguanLabel = @json($resiTerbentukMingguanLabel)

var reportResiBulanan = document.getElementById('report-resi-bulanan').getContext('2d');
var reportResiBulananLabel = @json($resiTerbentukBulananLabel)

var reportResiTahunan = document.getElementById('report-resi-tahunan').getContext('2d');
var reportResiTahunanLabel = @json($resiTerbentukTahunanLabel)

var reportResiMingguanData = {
    labels: reportResiMingguanLabel,
    datasets: [{
        label: 'Jumlah Resi Dalam Proses',
        borderColor: window.chartColors.yellow,
        backgroundColor: window.chartColors.yellow,
        fill: false,
        data: @json($resiProsesMingguan),
        yAxisID: 'y-axis-1',
        cubicInterpolationMode: 'monotone'
    }, {
        label: 'Jumlah Resi Selesai',
        borderColor: window.chartColors.green,
        backgroundColor: window.chartColors.green,
        fill: false,
        data: @json($resiSelesaiMingguan),
        yAxisID: 'y-axis-1',
        cubicInterpolationMode: 'monotone'
    }, {
        label: 'Jumlah Resi tercancel',
        borderColor: window.chartColors.red,
        backgroundColor: window.chartColors.red,
        fill: false,
        data: @json($resiCancelMingguan),
        yAxisID: 'y-axis-1',
        cubicInterpolationMode: 'monotone'
    }],
    
};

var reportResiBulananData = {
    labels: reportResiBulananLabel,
    datasets: [{
        label: 'Jumlah Resi Dalam Proses',
        borderColor: window.chartColors.yellow,
        backgroundColor: window.chartColors.yellow,
        fill: false,
        data: @json($resiProsesBulanan),
        yAxisID: 'y-axis-1',
        cubicInterpolationMode: 'monotone'
    }, {
        label: 'Jumlah Resi Selesai',
        borderColor: window.chartColors.green,
        backgroundColor: window.chartColors.green,
        fill: false,
        data: @json($resiSelesaiBulanan),
        yAxisID: 'y-axis-1',
        cubicInterpolationMode: 'monotone'
    }, {
        label: 'Jumlah Resi tercancel',
        borderColor: window.chartColors.red,
        backgroundColor: window.chartColors.red,
        fill: false,
        data: @json($resiCancelBulanan),
        yAxisID: 'y-axis-1',
        cubicInterpolationMode: 'monotone'
    }]
};

var reportResiTahunanData = {
    labels: reportResiTahunanLabel,
    datasets: [{
        label: 'Jumlah Resi Dalam Proses',
        borderColor: window.chartColors.yellow,
        backgroundColor: window.chartColors.yellow,
        fill: false,
        data: @json($resiProsesTahunan),
        yAxisID: 'y-axis-1',
    }, {
        label: 'Jumlah Resi Selesai',
        borderColor: window.chartColors.green,
        backgroundColor: window.chartColors.green,
        fill: false,
        data: @json($resiSelesaiTahunan),
        yAxisID: 'y-axis-1'
    }, {
        label: 'Jumlah Resi tercancel',
        borderColor: window.chartColors.red,
        backgroundColor: window.chartColors.red,
        fill: false,
        data: @json($resiCancelTahunan),
        yAxisID: 'y-axis-1'
    }]
};

window.myLine = Chart.Line(reportResiMingguan, {
    data: reportResiMingguanData,
    options: {
        responsive: true,
        hoverMode: 'index',
        stacked: false,
        title: {
            display: true,
            text: 'Grafik Resi yang terbuat 1 Minggu Terakhir'
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

window.myLine = Chart.Line(reportResiBulanan, {
    data: reportResiBulananData,
    options: {
        responsive: true,
        hoverMode: 'index',
        stacked: false,
        title: {
            display: true,
            text: 'Grafik Resi yang terbuat 1 Bulan Terakhir'
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

window.myLine = Chart.Line(reportResiTahunan, {
    data: reportResiTahunanData,
    options: {
        responsive: true,
        hoverMode: 'index',
        stacked: false,
        title: {
            display: true,
            text: 'Grafik Resi yang terbuat 1 Tahun Terakhir'
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

</script>
@endsection