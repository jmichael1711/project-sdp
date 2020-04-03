@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-users icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    SEMUA DATA PEGAWAI
@endsection

@section('subtitle')
Halaman ini untuk menampilkan semua data pegawai.
@endsection

@section('content')
<div class="tab-content">
    @if (Session::has('success'))
        <ul class="list-group mb-2">
            <li class="list-group-item-success list-group-item">{{Session::get('success')}}</li>
        </ul>
        @php
            Session::forget('success');
        @endphp
    @endif
    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel"> 
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="container">
                    <button class="btn btn-primary pull-right" onclick="window.location.href='{{url('/admin/pegawai/create')}}';">Tambah Data</button>
                    <br><hr>
                    <table class="table table-hover table-striped dataTable dtr-inline" id="tablePegawai">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ID Kantor</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Nomor Telepon</th>
                                <th>User Created</th>
                                <th>Created At</th>
                                <th>User Updated</th>
                                <th>Updated At</th>
                                <th>Is Deleted</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($allPegawai)
                                @foreach ($allPegawai as $i)
                            <tr onclick='editKantor("{{$i->id}}")'>
                                <td>{{$i->id}}</td>
                                <td>{{$i->kantor_id}}</td>
                                <td>{{$i->nama}}</td>
                                <td>{{$i->jabatan}}</td>
                                <td>
                                    @if ($i->jenis_kelamin == 'P')
                                        PRIA
                                    @else
                                        WANITA
                                    @endif
                                </td>
                                <td>{{$i->alamat}}</td>
                                <td>{{$i->no_telp}}</td>
                                <td>{{$i->user_created}}</td>
                                <td>{{$i->created_at->diffForHumans()}}</td>
                                <td>{{$i->user_updated}}</td>
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
        $("#upperlist-pegawai").addClass("mm-active");
        $("#btn-pegawai").attr("aria-expanded", "true");
        $("#list-pegawai").attr("class", "mm-collapse mm-show");
        $("#header-pegawai").attr("class", "mm-active");
    })

    var table = $('#tablePegawai').DataTable({
        "pagingType": 'full_numbers',
        'paging': true,
        'lengthMenu': [10,25, 50, 100],
        "scrollX": true
    });

    function editKantor(id){
        window.location.href='/admin/pegawai/edit/' + id;
    }

</script>
@endsection 