@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-gift icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
SEMUA DATA PENGIRIMAN CUSTOMER
@endsection

@section('subtitle')
Halaman ini untuk menampilkan semua data pengiriman customer.
@endsection

@section('content')
<ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
    <li class="nav-item">
        <a role="tab" class="nav-link active" id="tab-1" data-toggle="tab" href="#tab-content-1">
            <span>Semua</span>
        </a>
    </li>
    <li class="nav-item">
        <a role="tab" class="nav-link" id="tab-2" data-toggle="tab" href="#tab-content-2">
            <span>Pengirim</span>
        </a>
    </li>
    <li class="nav-item">
        <a role="tab" class="nav-link" id="tab-3" data-toggle="tab" href="#tab-content-3">
            <span>Penerima</span>
        </a>
    </li>
</ul>
<div class="tab-content">
    @if (Session::has('success'))
        <ul class="list-group mb-2">
            <li class="list-group-item-success list-group-item">{{Session::get('success')}}</li>
        </ul>
        @php
            Session::forget('success');
        @endphp
    @endif
    <div class="tab-pane tabs-animation fade show active" id="tab-content-1" role="tabpanel"> 
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="container">
                    <button class="btn btn-primary pull-right" onclick="window.location.href='{{url('/admin/pengirimanCustomer/create')}}';">Tambah Data</button>
                    <br><hr>
                    <table class="table table-hover table-striped dataTable dtr-inline" id="tablePengirimanCust1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Alamat Kantor</th>
                                <th>Kurir</th>
                                <th>Tujuan</th>
                                <th>Total Muatan</th>
                                <th>Waktu Berangkat</th>
                                <th>Waktu Sampai</th>
                                <th>Status Pengiriman Cust</th>
                                <th>Diubah Tanggal</th>
                                <th>Diubah Oleh</th>
                                <th>Dibuat Tanggal</th>
                                <th>Dibuat Oleh</th>
                                <th>Status Aktif</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allPengirimanCust as $i)
                                <tr onclick='editKantor("{{$i->id}}")'>
                                    <td>{{$i->id}}</td>
                                    <td>{{$i->kantor->alamat}}, {{$i->kantor->getKota->nama}}</td>
                                    <td>{{$i->kurir_customer->nama}} <br> ({{$i->kurir_customer->nopol}})</td>
                                    @if($i->menuju_penerima == 0)
                                    <td class="text-center text-white">
                                        <div class="badge badge-primary">
                                            PENGIRIM
                                        </div>
                                    </td> 
                                    @else
                                    <td class="text-center text-white">
                                        <div class="badge badge-success">
                                            PENERIMA
                                        </div>
                                    </td>    
                                    @endif
                                    <td>{{$i->total_muatan}}</td>
                                    @if($i->waktu_berangkat == null)
                                        <td>KOSONG</td>    
                                    @else
                                        <td class="text-center text-white">{{$i->waktu_berangkat}}</td>    
                                    @endif
                                    @if($i->waktu_sampai_kantor == null)
                                        <td>KOSONG</td>    
                                    @else
                                        <td class="text-center text-white">{{$i->waktu_sampai_kantor}}</td>    
                                    @endif
                                    @if($i->waktu_berangkat == null)
                                        <td class="text-center text-white">
                                            <div class="badge badge-danger">
                                                BELUM BERANGKAT
                                            </div>
                                        </td> 
                                    @elseif($i->waktu_sampai_kantor == null)
                                        <td class="text-center text-white">
                                            <div class="badge badge-danger">
                                                PERJALANAN
                                            </div>
                                        </td> 
                                    @else
                                        <td class="text-center text-white">
                                            <div class="badge badge-danger">
                                                SELESAI
                                            </div>
                                        </td>  
                                    @endif
                                    <td>{{$i->updated_at}}</td>
                                    <td>{{$i->user_updated}}</td>
                                    <td>{{$i->created_at}}</td>
                                    <td>{{$i->user_created}}</td>
                                    @if ($i->is_deleted)
                                    <td class="text-center text-white">
                                        <div class="badge badge-danger">
                                            TIDAK AKTIF
                                        </div>
                                    </td>    
                                    @else 
                                    <td class="text-center text-white">
                                        <div class="badge badge-success">
                                            AKTIF
                                        </div>
                                    </td>
                                    @endif
                                    <td>
                                        @if ($i->waktu_berangkat == null)
                                            <button class="mb-2 mr-2 btn btn-primary" onclick="startPengiriman('{{$i->id}}')">MULAI</button>
                                        @elseif ($i->waktu_sampai_kantor == null)
                                            <button class="mb-2 mr-2 btn btn-success" onclick="finishPengiriman('{{$i->id}}')">SELESAI</button>
                                        @else
                                            SELESAI
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane tabs-animation fade show active" id="tab-content-2" role="tabpanel"> 
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="container">
                    <button class="btn btn-primary pull-right" onclick="window.location.href='{{url('/admin/pengirimanCustomer/create')}}';">Tambah Data</button>
                    <br><hr>
                    <table class="table table-hover table-striped dataTable dtr-inline" id="tablePengirimanCust2">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Alamat Kantor</th>
                                <th>Kurir</th>
                                <th>Tujuan</th>
                                <th>Total Muatan</th>
                                <th>Waktu Berangkat</th>
                                <th>Diubah Tanggal</th>
                                <th>Diubah Oleh</th>
                                <th>Dibuat Tanggal</th>
                                <th>Dibuat Oleh</th>
                                <th>Status Aktif</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengirimanCustPengirim as $i)
                                <tr onclick='editKantor("{{$i->id}}")'>
                                    <td>{{$i->id}}</td>
                                    <td>{{$i->kantor->alamat}}, {{$i->kantor->getKota->nama}}</td>
                                    <td>{{$i->kurir_customer->nama}} <br> ({{$i->kurir_customer->nopol}})</td>
                                    @if($i->menuju_penerima == 0)
                                    <td class="text-center text-white">
                                        <div class="badge badge-primary">
                                            PENGIRIM
                                        </div>
                                    </td> 
                                    @else
                                    <td class="text-center text-white">
                                        <div class="badge badge-success">
                                            PENERIMA
                                        </div>
                                    </td>    
                                    @endif
                                    <td>{{$i->total_muatan}}</td>
                                    @if($i->waktu_berangkat == null)
                                    <td class="text-center text-white">
                                        <div class="badge badge-danger">
                                            Belum Berangkat
                                        </div>
                                    </td> 
                                    @else
                                    <td class="text-center text-white">{{$i->waktu_berangkat}}</td>    
                                    @endif
                                    <td>{{$i->updated_at}}</td>
                                    <td>{{$i->user_updated}}</td>
                                    <td>{{$i->created_at}}</td>
                                    <td>{{$i->user_created}}</td>
                                    @if ($i->is_deleted)
                                    <td class="text-center text-white">
                                        <div class="badge badge-danger">
                                            TIDAK AKTIF
                                        </div>
                                    </td>    
                                    @else 
                                    <td class="text-center text-white">
                                        <div class="badge badge-success">
                                            AKTIF
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

    <div class="tab-pane tabs-animation fade show active" id="tab-content-3" role="tabpanel"> 
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="container">
                    <button class="btn btn-primary pull-right" onclick="window.location.href='{{url('/admin/pengirimanCustomer/create')}}';">Tambah Data</button>
                    <br><hr>
                    <table class="table table-hover table-striped dataTable dtr-inline" id="tablePengirimanCust3">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Alamat Kantor</th>
                                <th>Kurir</th>
                                <th>Tujuan</th>
                                <th>Total Muatan</th>
                                <th>Waktu Berangkat</th>
                                <th>Diubah Tanggal</th>
                                <th>Diubah Oleh</th>
                                <th>Dibuat Tanggal</th>
                                <th>Dibuat Oleh</th>
                                <th>Status Aktif</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengirimanCustPenerima as $i)
                                <tr onclick='editKantor("{{$i->id}}")'>
                                    <td>{{$i->id}}</td>
                                    <td>{{$i->kantor->alamat}}, {{$i->kantor->getKota->nama}}</td>
                                    <td>{{$i->kurir_customer->nama}} <br> ({{$i->kurir_customer->nopol}})</td>
                                    @if($i->menuju_penerima == 0)
                                    <td class="text-center text-white">
                                        <div class="badge badge-primary">
                                            PENGIRIM
                                        </div>
                                    </td> 
                                    @else
                                    <td class="text-center text-white">
                                        <div class="badge badge-success">
                                            PENERIMA
                                        </div>
                                    </td>    
                                    @endif
                                    <td>{{$i->total_muatan}}</td>
                                    @if($i->waktu_berangkat == null)
                                    <td class="text-center text-white">
                                        <div class="badge badge-danger">
                                            Belum Berangkat
                                        </div>
                                    </td> 
                                    @else
                                    <td class="text-center text-white">{{$i->waktu_berangkat}}</td>    
                                    @endif
                                    <td>{{$i->updated_at}}</td>
                                    <td>{{$i->user_updated}}</td>
                                    <td>{{$i->created_at}}</td>
                                    <td>{{$i->user_created}}</td>
                                    @if ($i->is_deleted)
                                    <td class="text-center text-white">
                                        <div class="badge badge-danger">
                                            TIDAK AKTIF
                                        </div>
                                    </td>    
                                    @else 
                                    <td class="text-center text-white">
                                        <div class="badge badge-success">
                                            AKTIF
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

@section('scripts')
<script>
    $(document).ready(function () {
        $("#upperlist-pengirimanCustomer").addClass("mm-active");
        $("#btn-pengirimanCustomer").attr("aria-expanded", "true");
        $("#list-pengirimanCustomer").attr("class", "mm-collapse mm-show");
        $("#header-pengirimanCustomer").attr("class", "mm-active");

        $("#tab-content-2").removeClass("show active");
        $("#tab-content-3").removeClass("show active");
    })

    function startPengiriman(id){

    }

    var table = $('#tablePengirimanCust1').DataTable({
        "pagingType": 'full_numbers',
        'paging': true,
        'lengthMenu': [10,25, 50, 100],
        "scrollX": true
    });

    var table1 = $('#tablePengirimanCust2').DataTable({
        "pagingType": 'full_numbers',
        'paging': true,
        'lengthMenu': [10,25, 50, 100],
        "scrollX": true
    });

    var table2 = $('#tablePengirimanCust3').DataTable({
        "pagingType": 'full_numbers',
        'paging': true,
        'lengthMenu': [10,25, 50, 100],
        "scrollX": true
    });

    function editKantor(id){
        window.location.href='/admin/pengirimanCustomer/edit/' + id;
    }

</script>
@endsection 