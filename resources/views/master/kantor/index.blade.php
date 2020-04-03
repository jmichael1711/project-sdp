@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-home icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    List Kantor
@endsection

@section('subtitle')
Page ini adalah untuk menampilkan semua kantor.
@endsection

@section('content')
<div class="tab-content">
    @if (Session::has('success-kantor'))
        <ul class="list-group mb-2">
            <li class="list-group-item-success list-group-item">{{Session::get('success-kantor')}}</li>
        </ul>
        @php
            Session::forget('success-kantor');
        @endphp
    @endif
    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel"> 
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="container">
                    <button class="btn btn-primary pull-right" onclick="window.location.href='{{url('/admin/kantor/create')}}';">Tambah Data</button>
                    <br><hr>
                    <table class="table table-hover table-striped dataTable dtr-inline" id="tableKantor">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Alamat</th>
                            <th>No. Telp</th>
                            <th>Kota</th>
                            <th>Jenis</th>
                            <th>Longitude</th>
                            <th>Latitude</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($kantors)
                            @foreach ($kantors as $i)
                            <tr onclick='editKantor("{{$i->id}}")'>
                                <td>{{$i->id}}</td>
                                <td>{{$i->alamat}}</td>
                                <td>{{$i->no_telp}}</td>
                                <td>{{$i->kota}}</td>
                                @if ($i->is_warehouse)
                                <td>
                                    WAREHOUSE
                                </td>    
                                @else 
                                <td>
                                    KANTOR CABANG
                                </td>
                                @endif
                                <td>{{$i->longitude}}</td>
                                <td>{{$i->latitude}}</td>
                                <td>{{$i->created_at->diffForHumans()}}</td>
                                <td>{{$i->updated_at->diffForHumans()}}</td>
                                @if ($i->is_deleted)
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
        $("#upperlist-kantor").addClass("mm-active");
        $("#btn-kantor").attr("aria-expanded", "true");
        $("#list-kantor").attr("class", "mm-collapse mm-show");
        $("#header-kantor").attr("class", "mm-active");
    })

    var table = $('#tableKantor').DataTable({
        "pagingType": 'full_numbers',
        'paging': true,
        'lengthMenu': [10,25, 50, 100],
        "scrollX": true
    });

    function editKantor(id){
        window.location.href='/admin/kantor/edit/' + id;
    }

</script>
@endsection 