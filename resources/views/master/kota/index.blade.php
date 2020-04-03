@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-map-2 icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    SEMUA DATA KOTA
@endsection

@section('subtitle')
Halaman ini untuk menampilkan semua data kota.
@endsection

@section('content')
<div class="tab-content">
    @if (Session::has('success-kota'))
        <ul class="list-group mb-2">
            <li class="list-group-item-success list-group-item">{{Session::get('success-kota')}}</li>
        </ul>
        @php
            Session::forget('success-kota');
        @endphp
    @endif
    @if (Session::has('failed-kota'))
    <ul class="list-group mb-2">
        <li class="list-group-item-danger list-group-item">{{Session::get('failed-kota')}}</li>
    </ul>
    @php
        Session::forget('failed-kota');
    @endphp
@endif
    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel"> 
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="container">
                    <button class="btn btn-primary pull-right" onclick="window.location.href='{{url('/admin/kota/create')}}';">Tambah Data</button>
                    <br><hr>
                    <table class="table table-hover table-striped dataTable dtr-inline" id="tableKota">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Diubah Tanggal</th>
                            <th>Diubah Oleh</th>
                            <th>Dibuat Tanggal</th>
                            <th>Dibuat Oleh</th>
                            <th>Deleted</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kota as $city)
                            <tr onclick='editKota("{{$city->nama}}")'>
                                <td>{{$city['nama']}}</td>
                                <td>{{$city['updated_at']}}</td>
                                <td>{{$city['user_updated']}}</td>
                                <td>{{$city['created_at']}}</td>
                                <td>{{$city['user_created']}}</td>
                                @if ($city['is_deleted'] == 1)
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
        $("#upperlist-kota").addClass("mm-active");
        $("#btn-kota").attr("aria-expanded", "true");
        $("#list-kota").attr("class", "mm-collapse mm-show");
        $("#header-kota").attr("class", "mm-active");
    })

    function editKota(id){
        window.location.href='/admin/kota/edit/' + id;
    }

    var table = $('#tableKota').DataTable({
        "pagingType": 'full_numbers',
        'paging': true,
        'lengthMenu': [10,25,50,100],
        "scrollX": true
    });
</script>
@endsection
