@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-rocket icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
SEMUA DATA KURIR NON CUSTOMER
@endsection

@section('subtitle')
Halaman ini untuk menampilkan semua data kurir non customer.
@endsection

@section('content')
<div class="tab-content">
    @if (Session::has('success-kurir_noncustomer'))
        <ul class="list-group mb-2">
            <li class="list-group-item-success list-group-item">{{Session::get('success-kurir_noncustomer')}}</li>
        </ul>
        @php
            Session::forget('success-kurir_noncustomer');
        @endphp
    @endif
    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
        <div class="main-card mb-3 card">
            <div class="card-body">
            <div class="container">
                <button class="btn btn-primary pull-right" onclick="window.location.href='{{url('/admin/kurir_noncustomer/create')}}';">Tambah Data</button>
                <br><hr>
                <table class="table table-hover table-striped dataTable dtr-inline" id="tableKurirNonCustomer">
                    <thead>
                        <th>ID</th>
                        <th>Alamat Kantor 1</th>
                        <th>Alamat Kantor 2</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>No. Telp</th>
                        <th>Posisi</th>
                        <th>Status Kurir</th>
                        <th>Diubah Tanggal</th>
                        <th>Diubah Oleh</th>
                        <th>Dibuat Tanggal</th>
                        <th>Dibuat Oleh</th>
                        <th>Status Aktif</th>
                    </thead>
                    <tbody>
                        @foreach ($kurnoncust as $kc)
                            <tr onclick='editkurnoncust("{{$kc->id}}")'>
                                <td>{{$kc['id']}}</td>
                                <td>{{$kc->kantor_1->alamat}}, {{$kc->kantor_1->getKota->nama}}</td>
                                <td>{{$kc->kantor_2->alamat}}, {{$kc->kantor_2->getKota->nama}}</td>
                                <td>{{$kc['nama']}}</td>
                                @if($kc['jenis_kelamin']== 'P')
                                    <td>PRIA</td>
                                @else
                                    <td>WANITA</td>
                                @endif
                                <td>{{$kc['no_telp']}}</td>
                                @if ($kc['posisi_di_kantor_1'] == 1)
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
                                    NOT ACTIVE
                                    </div>
                                </td>
                                @else
                                <td class="text-center text-white">
                                    <div class="badge badge-success">
                                    ACTIVE
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
        $("#upperlist-kurir_noncustomer").addClass("mm-active");
        $("#btn-kurir_noncustomer").attr("aria-expanded", "true");
        $("#list-kurir_noncustomer").attr("class", "mm-collapse mm-show");
        $("#header-kurir_noncustomer").attr("class", "mm-active");
    })

    function editkurnoncust(id){
        window.location.href='/admin/kurir_noncustomer/edit/' + id;
    }

    var table = $('#tableKurirNonCustomer').DataTable({
        "pagingType": 'full_numbers',
        'paging': true,
        'lengthMenu': [10,25, 50, 100],
        "scrollX": true
    });
</script>
@endsection
