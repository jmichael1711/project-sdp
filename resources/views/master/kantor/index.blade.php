@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-tools icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    Create Kantor
@endsection

@section('subtitle')
Page ini adalah untuk menambah kantor baru.
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
            <div style="overflow-x: auto" class="card-body"><h5 class="card-title">Semua Kantor</h5>
                <table style="min-width: 125%;" class="table table-hover table-responsive bg-light text-dark" id="tableKantor">
                    <thead>
                        <th>ID</th>
                        <th>Alamat</th>
                        <th>No. Telp</th>
                        <th>Kota</th>
                        <th>Jenis</th>
                        <th>Longitude</th>
                        <th>Latitude</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>User Created</th>
                        <th>User Updated</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        @if ($kantors)
                            @foreach ($kantors as $i)
                            
                        <tr>
                            <td> <a href="/admin/kantor/edit/{{$i->id}}">{{$i->id}}</a>  </td>
                            <td>{{$i->alamat}}</td>
                            <td>{{$i->no_telp}}</td>
                            <td>{{$i->kota}}</td>
                            @if ($i->is_warehouse)
                            <td>
                                KANTOR CABANG
                            </td>    
                            @else 
                            <td>
                                WAREHOUSE
                            </td>
                            @endif
                            <td>{{$i->longitude}}</td>
                            <td>{{$i->latitude}}</td>
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
        $("#upperlist-kantor").addClass("mm-active");
        $("#btn-kantor").attr("aria-expanded", "true");
        $("#list-kantor").attr("class", "mm-collapse mm-show");
        $("#header-kantor").attr("class", "mm-active");
    })

    var table = $('#tableKantor').DataTable({
        "pagingType": 'full_numbers',
        'paging': true,
        'lengthMenu': [10,25, 50, 100]
    });

</script>
@endsection 