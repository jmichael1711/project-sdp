@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-box1 icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    SEMUA DATA BON MUAT
@endsection

@section('subtitle')
Halaman ini untuk menampilkan semua data bon muat.
@endsection

@section('content')
<ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
    <li class="nav-item">
        <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0">
            <span>AKAN DATANG</span>
        </a>
    </li>
    <li class="nav-item">
        <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1">
            <span>KANTOR INI</span>
        </a>
    </li>
</ul>
<div class="tab-content">
    @if (Session::has('success-bonmuat'))
        <ul class="list-group mb-2">
            <li class="list-group-item-success list-group-item">{{Session::get('success-bonmuat')}}</li>
        </ul>
        @php
            Session::forget('success-bonmuat');
        @endphp
    @endif
    <button id="triggerModal" type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target="#exampleModal" style="display: none">
        Trigger Modal
    </button>
    {{-- bonmuat yang akan datang --}}
    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel"> 
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="container">
                    @if (Session::has('loginstatus'))
                        @if (Session::get('loginstatus') != 4)
                    <button class="btn btn-primary mb-2 pull-right" onclick="window.location.href='{{url('/admin/bonmuat/create')}}';">Tambah Data</button>
                        @endif
                    @endif
                    <button type="button" class="btn mr-2 mb-2 btn-primary pull-right" data-toggle="modal" data-target="#exampleModalLong" id="scanEditSuratJalan" onclick="triggerScanner()">
                        &nbsp Scan &nbsp
                    </button>
                    <br><hr>
                    <table class="table table-hover table-striped dataTable dtr-inline" id="tableBonMuatYangAkanDatang">
                        <thead>
                            <th>ID</th>
                            <th>Kantor Asal</th>
                            <th>Kantor Tujuan</th>
                            <th>Kendaraan</th>
                            <th>Kurir</th>
                            <th>Total Muatan</th>
                            <th>Waktu Berangkat</th>
                            <th>Waktu Sampai</th>
                            <th>Status Perjalanan</th>
                            <th>Diubah Tanggal</th>
                            <th>Diubah Oleh</th>
                            <th>Dibuat Tanggal</th>
                            <th>Dibuat Oleh</th>
                        </thead>
                        <tbody>
                            @foreach ($allIncomingBonMuat as $i)
                            <tr onclick='editSuratJalan("{{$i->id}}")'>
                                <td>{{$i->id}}</td>
                                <td>{{$i->kantor_asal->alamat}}, {{$i->kantor_asal->kota}}</td>
                                <td>{{$i->kantor_tujuan->alamat}}, {{$i->kantor_tujuan->kota}}</td>
                                <td>{{$i->kendaraan->nopol}}</td>
                                <td>{{$i->kurir_non_customer->nama}}</td>
                                <td>{{$i->total_muatan.' Kg'}}</td>
                                @if($i->waktu_berangkat == null)
                                    <td>KOSONG</td>    
                                @else
                                    <td class="text-center">{{$i->waktu_berangkat}}</td>    
                                @endif
                                @if($i->waktu_sampai == null)
                                    <td>KOSONG</td>    
                                @else
                                    <td class="text-center">{{$i->waktu_sampai}}</td>    
                                @endif
                                @php
                                $finish = true;
                                @endphp
                                @foreach($i->resis as $j)
                                    @if($j->surat_jalan->telah_sampai == "0")
                                        @php
                                            $finish = false;
                                        @endphp
                                    @endif
                                @endforeach
                                @if($i->waktu_berangkat == null)
                                    <td class="text-center text-white">
                                        <div class="badge badge-warning">
                                            BELUM BERANGKAT
                                        </div>
                                    </td> 
                                @elseif($i->waktu_sampai == null)
                                    <td class="text-center text-white">
                                        <div class="badge badge-danger">
                                            PERJALANAN
                                        </div>
                                    </td> 
                                @else
                                    @if ($finish == false)
                                    <td class="text-center text-white">
                                        <div class="badge badge-warning">
                                            SEDANG PROSES
                                        </div>
                                    </td>    
                                    @else 
                                    <td class="text-center text-white">
                                        <div class="badge badge-success">
                                            SELESAI
                                        </div>
                                    </td>
                                    @endif 
                                @endif
                                <td>{{$i->updated_at}}</td>
                                <td>{{$i->user_updated}}</td>
                                <td>{{$i->created_at}}</td>
                                <td>{{$i->user_created}}</td>
                            </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>  
    </div>

    {{-- bonmuat kantor ini --}}
    <div class="tab-pane tabs-animation fade show active" id="tab-content-1" role="tabpanel"> 
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="container">
                    @if (Session::has('loginstatus'))
                        @if (Session::get('loginstatus') != 4)
                    <button class="btn btn-primary pull-right" onclick="window.location.href='{{url('/admin/bonmuat/create')}}';">Tambah Data</button>
                        @endif
                    @endif
                    <button type="button" class="btn mr-2 mb-2 btn-primary pull-right" data-toggle="modal" data-target="#exampleModalLong" id="scanEdit" onclick="triggerScanner()">
                        &nbsp Scan &nbsp
                    </button>
                    <br><hr>
                    <table class="table table-hover table-striped dataTable dtr-inline" id="tableBonMuatKantorIni">
                        <thead>
                            <th>ID</th>
                            <th>Kantor Asal</th>
                            <th>Kantor Tujuan</th>
                            <th>Kendaraan</th>
                            <th>Kurir</th>
                            <th>Total Muatan</th>
                            <th>Waktu Berangkat</th>
                            <th>Waktu Sampai</th>
                            <th>Status Perjalanan</th>
                            <th>Diubah Tanggal</th>
                            <th>Diubah Oleh</th>
                            <th>Dibuat Tanggal</th>
                            <th>Dibuat Oleh</th>
                        </thead>
                        <tbody>
                            @foreach ($allBonMuat as $i)
                            <tr onclick='editDetailBonMuat("{{$i->id}}")'>
                                <td>{{$i->id}}</td>
                                <td>{{$i->kantor_asal->alamat}}, {{$i->kantor_asal->kota}}</td>
                                <td>{{$i->kantor_tujuan->alamat}}, {{$i->kantor_tujuan->kota}}</td>
                                <td>{{$i->kendaraan->nopol}}</td>
                                <td>{{$i->kurir_non_customer->nama}}</td>
                                <td>{{$i->total_muatan.' Kg'}}</td>
                                @if($i->waktu_berangkat == null)
                                    <td>KOSONG</td>    
                                @else
                                    <td class="text-center">{{$i->waktu_berangkat}}</td>    
                                @endif
                                @if($i->waktu_sampai == null)
                                    <td>KOSONG</td>    
                                @else
                                    <td class="text-center">{{$i->waktu_sampai}}</td>    
                                @endif
                                @php
                                $finish = true;
                                @endphp
                                @foreach($i->resis as $j)
                                    @if($j->surat_jalan->telah_sampai == "0")
                                        @php
                                            $finish = false;
                                        @endphp
                                    @endif
                                @endforeach
                                @if($i->waktu_berangkat == null)
                                    <td class="text-center text-white">
                                        <div class="badge badge-warning">
                                            BELUM BERANGKAT
                                        </div>
                                    </td> 
                                @elseif($i->waktu_sampai == null)
                                    <td class="text-center text-white">
                                        <div class="badge badge-danger">
                                            PERJALANAN
                                        </div>
                                    </td> 
                                @else
                                    @if ($finish == false)
                                    <td class="text-center text-white">
                                        <div class="badge badge-warning">
                                            SEDANG PROSES
                                        </div>
                                    </td>    
                                    @else 
                                    <td class="text-center text-white">
                                        <div class="badge badge-success">
                                            SELESAI
                                        </div>
                                    </td>
                                    @endif 
                                @endif
                                <td>{{$i->updated_at}}</td>
                                <td>{{$i->user_updated}}</td>
                                <td>{{$i->created_at}}</td>
                                <td>{{$i->user_created}}</td>
                            </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>  
    </div>
</div>  
@endsection

{{-- Notification --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Error</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-0" id="modalContent"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- Scanner Video --}}
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Scan Resi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <video id="preview" style="width: 200px; height: 200px; border: 1px solid black;"></video>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeScanner()" id="close">Close</button>
            </div>
        </div>
    </div>
</div>



@section('scripts')
<script>
    $(document).ready(function () {
        //UNTUK SIDEBAR
        $("#upperlist-bonmuat").addClass("mm-active");
        $("#btn-bonmuat").attr("aria-expanded", "true");
        $("#list-bonmuat").attr("class", "mm-collapse mm-show");
        $("#header-bonmuat").attr("class", "mm-active");

        $("#tab-content-1").removeClass("show active");

        if ('{{Session::has("success-failsuratjalan")}}'){
            triggerNotification('{{Session::get("success-failsuratjalan")}}');
            @php
                Session::forget('success-failsuratjalan');
            @endphp
        } 
        
        scanner.addListener('scan', function(content) {
            var id = content;
            $("#close").click();
            if($("#tab-0").hasClass("active") == true){
                window.location.href='/admin/bonmuat/editSuratJalan/' + id;
            }else{
                window.location.href='/admin/bonmuat/edit/' + id;
            }
        });
    })
    
    var table = $('#tableBonMuatYangAkanDatang').DataTable({
        "pagingType": 'full_numbers',
        'paging': true,
        'lengthMenu': [10,25, 50, 100],
        "scrollX": true
    });

    var table2 = $('#tableBonMuatKantorIni').DataTable({
        "pagingType": 'full_numbers',
        'paging': true,
        'lengthMenu': [10,25, 50, 100],
        "scrollX": true
    });

    let scanner = new Instascan.Scanner(
    {
        video: document.getElementById('preview')
    });

    function triggerScanner(){
        Instascan.Camera.getCameras().then(cameras => 
        {
            if(cameras.length > 0){
                scanner.start(cameras[0]);
            } else {
                console.error("Please enable Camera!");
            }
        });
    }
    
    function closeScanner(){
        Instascan.Camera.getCameras().then(cameras => 
        {
            if(cameras.length > 0){
                scanner.stop(cameras[0]);
            } else {
                console.error("Error Stop Camera");
            }
        });
    }

    function editSuratJalan(id){
        window.location.href='/admin/bonmuat/editSuratJalan/' + id;
    }

    function triggerNotification(text){
        $("#modalContent").html(text);
        $("#triggerModal").click();
    }

    function editDetailBonMuat(id){
        window.location.href='/admin/bonmuat/edit/' + id;
    }
</script>
@endsection 