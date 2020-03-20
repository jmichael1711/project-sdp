@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-tools icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    Semua Kendaraan
@endsection

@section('subtitle')
Page ini adalah untuk melihat semua kendaraan.
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
            <div style="overflow-x: auto" class="card-body"><h5 class="card-title">Semua Kendaraan</h5>
                <table style="min-width: 100%;" class="table table-hover table-striped dataTable dtr-inline" id="tableKendaraan">
                    <thead>
                        <th>ID</th>
                        <th>Kantor 1</th>
                        <th>Kantor 2</th>
                        <th>Nomor Polisi</th>
                        <th>Status Kendaraan</th>
                        <th>Tahun Pembelian</th>
                        <th>Posisi</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>User Created</th>
                        <th>User Updated</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        @if ($kendaraans)
                            @foreach ($kendaraans as $i)
                            
                        <tr onclick='editKendaraan("{{$i->id}}")'>
                            <td> {{$i->id}} </td>
                            <td><a href="/admin/kantor/edit/{{$i->kantor_1_id}}">{{$i->kantor_1_id}}</a> </td>
                            <td><a href="/admin/kantor/edit/{{$i->kantor_2_id}}">{{$i->kantor_2_id}}</a></td>
                            <td>{{$i->nopol}}</td>
                            @if ($i->status)
                            <td class="text-center text-white">
                                <div class="badge badge-danger">
                                    BUSY
                                </div>
                            </td>    
                            @else 
                            <td class="text-center text-white">
                                <div class="badge badge-success">
                                    FREE
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
                        @endif
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