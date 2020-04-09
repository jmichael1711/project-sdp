@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-bicycle icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
SEMUA DATA KURIR CUSTOMER
@endsection

@section('subtitle')
Halaman ini untuk menampilkan semua data kurir customer.
@endsection

@section('content')
<div class="tab-content">
    @if (Session::has('success-kurir_customer'))
        <ul class="list-group mb-2">
            <li class="list-group-item-success list-group-item">{{Session::get('success-kurir_customer')}}</li>
        </ul>
        @php
            Session::forget('success-kurir_customer');
        @endphp
    @endif
    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
        <div class="main-card mb-3 card">
            <div class="card-body">
            <div class="container">
                <button class="btn btn-primary pull-right" onclick="window.location.href='{{url('/admin/kurir_customer/create')}}';">Tambah Data</button>
                <br><hr>
                <table class="table table-hover table-striped dataTable dtr-inline" id="tableKurirCustomer">
                    <thead>
                        <th>ID</th>
                        <th>Alamat Kantor</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>No. Telp</th>
                        <th>Nomor Polisi</th>
                        <th>Status Kurir</th>
                        <th>Diubah Tanggal</th>
                        <th>Diubah Oleh</th>
                        <th>Dibuat Tanggal</th>
                        <th>Dibuat Oleh</th>
                        <th>Status Aktif</th>
                    </thead>
                    <tbody>
                        @foreach ($kurcust as $kc)
                            <tr onclick='editKurcust("{{$kc->id}}")'>
                                <td>{{$kc['id']}}</td>
                                <td>{{$kc->kantor->alamat}}, {{$kc->kantor->getKota->nama}}</td>
                                <td>{{$kc['nama']}}</td>
                                <td>
                                @if ($kc->jenis_kelamin == 'P')
                                    <div class="badge badge-primary">
                                        PRIA
                                    </div>
                                @else
                                <div class="badge badge-danger">
                                    WANITA
                                </div>
                                @endif
                                </td>
                                <td>{{$kc['no_telp']}}</td>
                                <td>{{$kc['nopol']}}</td>
                                @if ($kc['status'] == 1)
                                <td class="text-center text-white">
                                    <div class="badge badge-success">
                                    TERSEDIA
                                    </div>
                                </td>
                                @else
                                <td class="text-center text-white">
                                    <div class="badge badge-danger">
                                    SIBUK
                                    </div>
                                </td>
                                @endif
                                <td>{{$kc['updated_at']}}</td>
                                <td>{{$kc['user_updated']}}</td>
                                <td>{{$kc['created_at']}}</td>
                                <td>{{$kc['user_created']}}</td>
                                @if ($kc['is_deleted'] == 1)
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
        $("#upperlist-kurir_customer").addClass("mm-active");
        $("#btn-kurir_customer").attr("aria-expanded", "true");
        $("#list-kurir_customer").attr("class", "mm-collapse mm-show");
        $("#header-kurir_customer").attr("class", "mm-active");
    })

    function editKurcust(id){
        window.location.href='/admin/kurir_customer/edit/' + id;
    }

    var table = $('#tableKurirCustomer').DataTable({
        "pagingType": 'full_numbers',
        'paging': true,
        'lengthMenu': [10,25, 50, 100],
        "scrollX": true
    });
</script>
@endsection
