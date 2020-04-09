@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
SEMUA DATA KENDARAAN
@endsection

@section('subtitle')
Halaman ini untuk menampilkan semua data kendaraan.
@endsection

@section('content')
<div class="tab-content">
    @if (Session::has('success-kendaraan'))
        <ul class="list-group mb-2">
            <li class="list-group-item-success list-group-item">{{Session::get('success-kendaraan')}}</li>
        </ul>
        @php
            Session::forget('success-kendaraan');
        @endphp
    @endif
    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel"> 
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="container">
                    <button class="btn btn-primary pull-right" onclick="window.location.href='{{url('/admin/kendaraan/create')}}';">Tambah Data</button>
                    <br><hr>
                    <table class="table table-hover table-striped dataTable dtr-inline" id="tableKendaraan">
                    <thead>
                        <th>ID</th>
                        <th>Alamat Kantor 1</th>
                        <th>Alamat Kantor 2</th>
                        <th>Nomor Polisi</th>
                        <th>Status Kendaraan</th>
                        <th>Tahun Pembelian</th>
                        <th>Posisi</th>
                        <th>Diubah Tanggal</th>
                        <th>Diubah Oleh</th>
                        <th>Dibuat Tanggal</th>
                        <th>Dibuat Oleh</th>
                        <th>Status Aktif</th>
                    </thead>
                    <tbody>
                        @if ($kendaraans)
                            @foreach ($kendaraans as $i)
                            
                        <tr onclick='editKendaraan("{{$i->id}}")'>
                            <td> {{$i->id}} </td>
                            <td>{{$i->kantor_1->alamat}}, {{$i->kantor_1->getKota->nama}} </td>
                            <td>{{$i->kantor_2->alamat}}, {{$i->kantor_2->getKota->nama}}</td>
                            <td>{{$i->nopol}}</td>
                            @if ($i->status)
                            <td class="text-center text-white">
                                <div class="badge badge-danger">
                                    TERSEDIA
                                </div>
                            </td>    
                            @else 
                            <td class="text-center text-white">
                                <div class="badge badge-success">
                                    SIBUK
                                </div>
                            </td>
                            @endif
                            <td>{{$i->tahun_pembelian}}</td>
                            @if ($i->posisi_di_kantor_1)
                            <td class="text-center text-white">
                                <div class="badge badge-info">
                                    KANTOR 1
                                </div>
                            </td>    
                            @else 
                            <td class="text-center text-white">
                                <div class="badge badge-secondary">
                                    KANTOR 2
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
                        </tr>
                            @endforeach
                        @endif
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
        $("#upperlist-kendaraan").addClass("mm-active");
        $("#btn-kendaraan").attr("aria-expanded", "true");
        $("#list-kendaraan").attr("class", "mm-collapse mm-show");
        $("#header-kendaraan").attr("class", "mm-active");
    })

    function editKendaraan(id){
        window.location.href='/admin/kendaraan/edit/' + id;
    }

    var table = $('#tableKendaraan').DataTable({
        "pagingType": 'full_numbers',
        'paging': true,
        'lengthMenu': [10,25, 50, 100],
        "scrollX": true
    });

</script>
@endsection 