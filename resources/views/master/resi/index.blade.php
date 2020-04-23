@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-note2 icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
SEMUA DATA RESI
@endsection

@section('subtitle')
Halaman ini untuk menampilkan semua data resi.
@endsection

@section('content')
<ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
    <li class="nav-item">
        <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0">
            <span>PESANAN BARU</span>
        </a>
    </li>
    <li class="nav-item">
        <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1">
            <span>SEMUA</span>
        </a>
    </li>
</ul>
<button id="triggerModal" type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target="#exampleModal" style="display: none">
    Trigger Modal
</button>
<div class="tab-content">
    @if (Session::has('success-resi'))
        <ul class="list-group mb-2">
            <li class="list-group-item-success list-group-item">{{Session::get('success-resi')}}</li>
        </ul>
        @php
            Session::forget('success-resi');
        @endphp
    @endif
    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel"> 
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="container">
                    <button class="btn btn-primary pull-right" onclick="window.location.href='{{url('/admin/resi/create')}}';">Tambah Data</button>
                    <button type="button" class="btn mr-2 mb-2 btn-primary pull-right" data-toggle="modal" data-target="#exampleModalLong" id="scanPesananBaru" onclick="triggerScanner()">
                        &nbsp Scan &nbsp
                    </button>
                    <button type="button" class="btn mr-2 mb-2 btn-primary pull-right" id="btnPesananBaru" hidden>
                        &nbsp
                    </button>
                    <br><hr>
                    <table class="table table-hover table-striped dataTable dtr-inline" id="tableResiBaru">
                        <thead>
                            <th>ID</th>
                            <th>Alamat Asal</th>
                            <th>Alamat Tujuan</th>
                            <th>Dimensi Barang</th>
                            <th>Berat Barang</th>
                            <th>Fragile</th>
                            <th>Diubah Tanggal</th>
                            <th>Diubah Oleh</th>
                            <th>Dibuat Tanggal</th>
                            <th>Dibuat Oleh</th>
                        </thead>
                        <tbody>
                            @foreach ($allResiBaru as $i)
                            <tr onclick='buatPengirimanCustomer("{{$i->id}}")'>
                                <td>{{$i->id}}</td>
                                <td>{{$i->alamat_asal}}, {{$i->kota_asal}}</td>
                                <td>{{$i->alamat_tujuan}}, {{$i->kota_tujuan}}</td>
                                <td>{{$i->panjang}} cm x {{$i->lebar}} cm x {{$i->tinggi}} cm</td>
                                <td>{{$i->berat_barang}} Kg</td>
                                @if ($i->is_fragile)
                                <td class="text-center text-white">
                                    <div class="badge badge-danger">
                                        FRAGILE
                                    </div>
                                </td>    
                                @else 
                                <td class="text-center text-white">
                                    <div class="badge badge-success">
                                        FINE
                                    </div>
                                </td>
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
    <div class="tab-pane tabs-animation fade show active" id="tab-content-1" role="tabpanel"> 
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="container">
                    <button class="btn btn-primary pull-right" onclick="window.location.href='{{url('/admin/resi/create')}}';">Tambah Data</button>
                    <button type="button" class="btn mr-2 mb-2 btn-primary pull-right" data-toggle="modal" data-target="#exampleModalLong" id="scanResi" onclick="triggerScanner()">
                        &nbsp Scan &nbsp
                    </button>
                    <br><hr>
                    <table class="table table-hover table-striped dataTable dtr-inline" id="tableResi">
                        <thead>
                            <th>ID</th>
                            <th>Alamat Asal</th>
                            <th>Alamat Tujuan</th>
                            <th>Dimensi Barang</th>
                            <th>Berat Barang</th>
                            <th>Fragile</th>
                            <th>Status Verifikasi</th>
                            <th>Status Perjalanan</th>
                            <th>Diubah Tanggal</th>
                            <th>Diubah Oleh</th>
                            <th>Dibuat Tanggal</th>
                            <th>Dibuat Oleh</th>
                        </thead>
                        <tbody>
                            @foreach ($allResi as $i)
                            <tr onclick='editResi("{{$i->id}}")'>
                                <td>{{$i->id}}</td>
                                <td>{{$i->alamat_asal}}, {{$i->kota_asal}}</td>
                                <td>{{$i->alamat_tujuan}}, {{$i->kota_tujuan}}</td>
                                <td>{{$i->panjang}} cm x {{$i->lebar}} cm x {{$i->tinggi}} cm</td>
                                <td>{{$i->berat_barang}} Kg</td>
                                @if ($i->is_fragile)
                                <td class="text-center text-white">
                                    <div class="badge badge-danger">
                                        FRAGILE
                                    </div>
                                </td>    
                                @else 
                                <td class="text-center text-white">
                                    <div class="badge badge-success">
                                        FINE
                                    </div>
                                </td>
                                @endif
                                @if($i->verifikasi)
                                <td class="text-center text-white">
                                    <div class="badge badge-success">
                                        VERIFIKASI
                                    </div>
                                </td>
                                    @if($i->status_perjalanan == "PERJALANAN")
                                    <td class="text-center text-white">
                                        <div class="badge badge-warning">
                                            PERJALANAN
                                        </div>
                                    </td>
                                    @elseif($i->status_perjalanan == "BATAL")
                                    <td class="text-center text-white">
                                        <div class="badge badge-danger">
                                            BATAL
                                        </div>
                                    </td>
                                    @elseif($i->status_perjalanan == "SELESAI")
                                    <td class="text-center text-white">
                                        <div class="badge badge-success">
                                            SELESAI
                                        </div>
                                    </td>
                                    @endif
                                @else
                                <td class="text-center text-white">
                                    <div class="badge badge-danger">
                                        BELUM VERIFKASI
                                    </div>
                                </td>
                                <td class="text-center text-white">
                                    <div class="badge badge-info">
                                        BELUM TERVERIFIKASI
                                    </div>
                                </td>
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

@section('scripts')
<script>
    $(document).ready(function () {
        $("#upperlist-resi").addClass("mm-active");
        $("#btn-resi").attr("aria-expanded", "true");
        $("#list-resi").attr("class", "mm-collapse mm-show");
        $("#header-resi").attr("class", "mm-active");

        $("#tab-content-1").removeClass("show active");
        
        if ('{{Session::has("success-failresi")}}'){
            triggerNotification('{{Session::get("success-failresi")}}');
            @php
                Session::forget('success-failresi');
            @endphp
        } 

        scanner.addListener('scan', function(content) {
            var id = content;
            $("#close").click();
            if($("#tab-0").hasClass("active") == true){
                window.location.href='/admin/pengirimanCustomer/createBaru/' + id;
            }else{
                window.location.href='/admin/resi/edit/' + id;
            }
            
        });
       
    })

    function editResi(id){
        window.location.href='/admin/resi/edit/' + id;
    }

    var table = $('#tableResi').DataTable({
        "pagingType": 'full_numbers',
        'paging': true,
        'lengthMenu': [10,25, 50, 100],
        "scrollX": true
    });

    var table = $('#tableResiBaru').DataTable({
        "pagingType": 'full_numbers',
        'paging': true,
        'lengthMenu': [10,25, 50, 100],
        "scrollX": true
    });

    function buatPengirimanCustomer(id){
        window.location.href='/admin/pengirimanCustomer/createBaru/' + id;
    }

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

    function triggerNotification(text){
        $("#modalContent").html(text);
        $("#triggerModal").click();
    }
</script>
@endsection
