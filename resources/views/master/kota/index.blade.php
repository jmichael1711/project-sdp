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
        <div style="overflow-x: auto" class="card-body">
            <table style="min-width: 100%" class="table table-hover table-striped dataTable dtr-inline" id="tableKota">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kota as $city)
                        <tr onclick='editKota("{{$city->nama}}")'>
                            <td>{{$city['nama']}}</td>
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
