@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-tools icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    Semua Pesanan
@endsection

@section('subtitle')
Page ini adalah untuk melihat semua pesanan
@endsection

@section('content')
<div class="tab-content">
    @if (Session::has('success-pesanan'))
        <ul class="list-group mb-2">
            <li class="list-group-item-success list-group-item">{{Session::get('success-pesanan')}}</li>
        </ul>
        @php
            Session::forget('success-pesanan');
        @endphp
    @endif
    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="container">
                    <table class="table table-hover table-striped dataTable dtr-inline" id="tablePesanan">
                    <thead>
                        <tr>
                            <th>Id Pesanan</th>
                            <th>Id Resi</th>
                            <th>Id Kurir</th>
                            <th>Berat Barang</th>
                            <th>Alamat dan Kota Asal</th>
                            <th>Alamat dan Kota Tujuan</th>
                            <th>Nama Pengirim</th>
                            <th>Nama Penerima</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $pesanan)
                            <tr onclick='editPesanan("{{$pesanan->id}}")'>
                                <td>{{$pesanan['id']}}</td>
                                <td>{{$pesanan['resi_id']}}</td>
                                <td>{{$pesanan['kurir_customer_id']}}</td>
                                <td>{{$pesanan['berat_barang']}}</td>
                                <td>{{$pesanan['alamat_asal']}}, {{$pesanan['kota_asal']}}</td>
                                <td>{{$pesanan['alamat_tujuan']}}, {{$pesanan['kota_tujuan']}}</td>
                                <td>{{$pesanan['nama_pengirim']}}</td>
                                <td>{{$pesanan['nama_penerima']}}</td>
                                @if ($pesanan['status'] == 1)
                                <td class="text-center text-white">
                                    <div class="badge badge-success">
                                    FINISH
                                    </div>
                                </td>
                                @else
                                <td class="text-center text-white">
                                    <div class="badge badge-danger">
                                    NOT FINISH
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
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $("#upperlist-pesanan").addClass("mm-active");
        $("#btn-pesanan").attr("aria-expanded", "true");
        $("#list-pesanan").attr("class", "mm-collapse mm-show");
        $("#header-pesanan").attr("class", "mm-active");
    })

    function editPota(id){
        window.location.href='/admin/pesanan/edit/' + id;
    }

    var table = $('#tablePesanan').DataTable({
        "pagingType": 'full_numbers',
        'paging': true,
        'lengthMenu': [10,25, 50]
    });
</script>
@endsection
