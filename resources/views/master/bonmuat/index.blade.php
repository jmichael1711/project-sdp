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
    {{-- bonmuat1 --}}
    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel"> 
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="container">
                    <button type="button" class="btn mr-2 mb-2 btn-primary pull-right" data-toggle="modal" data-target="#exampleModalLong" id="scan" onclick="triggerScanner()">
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

    {{-- bonmuat1 --}}
    <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel"> 
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="container">
                    <button class="btn btn-primary pull-right" onclick="window.location.href='{{url('/admin/bonmuat/create')}}';">Tambah Data</button>
                    <br><hr>
                    <table class="table table-hover table-striped dataTable dtr-inline" id="tableBonMuatKantorIni">
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
                            <th>Status Aktif</th>
                        </thead>
                        <tbody>
                            @foreach ($allBonMuat as $i)
                            <tr onclick='editDetailBonMuat("{{$i->id}}")'>
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
        //UNTUK SIDEBAR
        $("#upperlist-bonmuat").addClass("mm-active");
        $("#btn-bonmuat").attr("aria-expanded", "true");
        $("#list-bonmuat").attr("class", "mm-collapse mm-show");
        $("#header-bonmuat").attr("class", "mm-active");

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

    var table1 = $('#tableBonMuat1').DataTable({
        "pagingType": 'full_numbers',
        'paging': true,
        'lengthMenu': [10,25, 50, 100],
        "scrollX": true
    });

    function editDetailBonMuat(id){
        window.location.href='/admin/bonmuat/edit/' + id;
    }
</script>
@endsection 