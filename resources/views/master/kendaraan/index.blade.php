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
                <table style="min-width: 100%;" class="table table-hover table-responsive bg-light text-dark" id="tableKendaraan">
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
                            
                        <tr>
                            <td> <a href="/admin/kendaraan/edit/{{$i->id}}">{{$i->id}}</a>  </td>
                            <td>{{$i->kantor_1_id}}</td>
                            <td>{{$i->kantor_2_id}}</td>
                            <td>{{$i->nopol}}</td>
                            @if ($i->status)
                            <td class="bg-danger text-center text-white">
                                BUSY
                            </td>    
                            @else 
                            <td class="bg-success text-center text-white">
                                FREE
                            </td>
                            @endif
                            <td>{{$i->tahun_pembelian}}</td>
                            @if ($i->posisi_di_kantor_1)
                            <td class="bg-primary text-center text-white">
                                KANTOR 1
                            </td>    
                            @else 
                            <td class="bg-secondary text-center text-white">
                                KANTOR 2
                            </td>
                            @endif
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

    var table = $('#tableKendaraan').DataTable({
        "pagingType": 'full_numbers',
        'paging': true,
        'lengthMenu': [10,25, 50, 100]
    });

</script>
@endsection 