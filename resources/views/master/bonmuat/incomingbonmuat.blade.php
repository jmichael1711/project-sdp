@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-box1 icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    SEMUA DATA BON MUAT YANG AKAN DATANG
@endsection

@section('subtitle')
Halaman ini untuk menampilkan semua data bon muat yang akan datang.
@endsection

@section('content')
<div class="tab-content">
    @if (Session::has('success-bonmuat'))
        <ul class="list-group mb-2">
            <li class="list-group-item-success list-group-item">{{Session::get('success-bonmuat')}}</li>
        </ul>
        @php
            Session::forget('success-bonmuat');
        @endphp
    @endif
    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel"> 
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="container">
                    <button type="button" class="btn mr-2 mb-2 btn-primary pull-right" data-toggle="modal" data-target="#exampleModalLong" id="scan" onclick="triggerScanner()">
                        &nbsp Scan &nbsp
                    </button>
                    <br><hr>
                    <table class="table table-hover table-striped dataTable dtr-inline" id="tableBonMuat">
                            <thead>
                                <th>ID</th>
                                <th>Kantor Asal</th>
                                <th>Kantor Tujuan</th>
                                <th>Kendaraan</th>
                                <th>Kurir</th>
                                <th>Total Muatan</th>
                                <th>Diubah Tanggal</th>
                                <th>Diubah Oleh</th>
                                <th>Dibuat Tanggal</th>
                                <th>Dibuat Oleh</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                @foreach ($allBonMuat as $i)
                                <tr onclick='editSuratJalan("{{$i->id}}")'>
                                    <td>{{$i->id}}</td>
                                    <td>{{$i->kantor_asal->alamat}}</td>
                                    <td>{{$i->kantor_tujuan->alamat}}</td>
                                    <td>{{$i->kendaraan->nopol}}</td>
                                    <td>{{$i->kurir_non_customer->nama}}</td>
                                    <td>{{$i->total_muatan.' Kg'}}</td>
                                    <td>{{$i->updated_at}}</td>
                                    <td>{{$i->user_updated}}</td>
                                    <td>{{$i->created_at}}</td>
                                    <td>{{$i->user_created}}</td>
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
                                    @if ($finish == false)
                                    <td class="text-center text-white">
                                        <div class="badge badge-warning">
                                            BELUM SELESAI
                                        </div>
                                    </td>    
                                    @else 
                                    <td class="text-center text-white">
                                        <div class="badge badge-success">
                                            SELESAI
                                        </div>
                                    </td>
                                    @endif
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
        $("#upperlist-incoming-bonmuat").addClass("mm-active");
        $("#btn-incoming-bonmuat").attr("aria-expanded", "true");
        $("#list-incoming-bonmuat").attr("class", "mm-collapse mm-show");
        $("#header-incoming-bonmuat").attr("class", "mm-active");

        scanner.addListener('scan', function(content) {
            var id = content;
            $("#close").click();
            window.location.href='/admin/bonmuat/editSuratJalan/' + id;
        });
    })

    var table = $('#tableBonMuat').DataTable({
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
</script>
@endsection 