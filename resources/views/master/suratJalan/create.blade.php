@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-tools icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    Create Surat Jalan
@endsection

@section('subtitle')
Page ini adalah untuk menambah Surat Jalan.
@endsection

@section('content')
<div class="tab-content">
    @if (Session::has('success-suratJalan'))
        <ul class="list-group mb-2">
            <li class="list-group-item-success list-group-item">{{Session::get('success-suratJalan')}}</li>
        </ul>
        @php
            Session::forget('success-suratJalan');
        @endphp
    @endif
        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
            <div class="main-card mb-3 card">
                <div style="overflow-x: auto" class="card-body"><h5 class="card-title">Semua Bon Muat</h5>
                    <div class="container">
                        <table style="min-width: 100%;" class="table table-hover table-responsive bg-light text-dark" id="tableBonMuat">
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
                                @if ($allBonMuat)
                                    @foreach ($allBonMuat as $i)                                
                                <tr onclick='editDetailBonMuat("{{$i}}")'>
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
                                    <td class="bg-danger text-center text-white">
                                        NOT ACTIVE
                                    </td>    
                                    @else 
                                    <td class="bg-success text-center text-white">
                                        ACTIVE
                                    </td>
                                    @endif
                                </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                </div>
            </div>
            <div class="card-body">
                <div class="main-card mb-3 card">
                    test
                    <br><br><br><br><br>
                    test
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
        $("#upperlist-suratJalan").addClass("mm-active");
        $("#btn-suratJalan").attr("aria-expanded", "true");
        $("#list-suratJalan").attr("class", "mm-collapse mm-show");
        $("#header-tambah-suratJalan").attr("class", "mm-active");
    })

    var table = $('#tableBonMuat').DataTable({
        "pagingType": 'full_numbers',
        'paging': true,
        'lengthMenu': [10,25, 50, 100]
    });

    function editDetailBonMuat(){

    }
</script>
@endsection 