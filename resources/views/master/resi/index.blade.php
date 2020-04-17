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

@section('scripts')
<script>
    $(document).ready(function () {
        $("#upperlist-resi").addClass("mm-active");
        $("#btn-resi").attr("aria-expanded", "true");
        $("#list-resi").attr("class", "mm-collapse mm-show");
        $("#header-resi").attr("class", "mm-active");

        $("#tab-content-1").removeClass("show active");
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
</script>
@endsection
