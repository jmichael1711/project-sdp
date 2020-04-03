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
<div class="tab-content">
    @if (Session::has('success-bonmuat'))
        <ul class="list-group mb-2">
            <li class="list-group-item-success list-group-item">{{Session::get('success-bonmuat')}}</li>
        </ul>
        @php
            Session::forget('success-bonmuat');
        @endphp
    @endif
    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel"> 
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="container">
                    <button class="btn btn-primary pull-right" onclick="window.location.href='{{url('/admin/bonmuat/create')}}';">Tambah Data</button>
                    <br><hr>
                    <table class="table table-hover table-striped dataTable dtr-inline" id="tableBonMuat">
                            <thead>
                                <th>ID</th>
                                <th>Kantor Asal</th>
                                <th>Kantor Tujuan</th>
                                <th>Kendaraan</th>
                                <th>Kurir</th>
                                <th>Total Muatan</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>User Created</th>
                                <th>User Updated</th>
                                <th>Status</th>
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
                                    <td>{{$i->created_at->diffForHumans()}}</td>
                                    <td>{{$i->updated_at->diffForHumans()}}</td>
                                    <td>{{$i->user_created}}</td>
                                    <td>{{$i->user_updated}}</td>
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

    var table = $('#tableBonMuat').DataTable({
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