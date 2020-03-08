@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-tools icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    List Pengiriman Customer
@endsection

@section('subtitle')
Page ini adalah untuk menampilkan semua pengiriman customer.
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
                    <table class="table table-hover table-striped dataTable dtr-inline" id="tablePengirimanCust">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ID Kantor</th>
                                <th>ID Kurir Customer</th>
                                <th>Menuju Penerima</th>
                                <th>Total Muatan</th>
                                <th>User Created</th>
                                <th>Created At</th>
                                <th>User Updated</th>
                                <th>Updated At</th>
                                <th>Is Deleted</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($allPengirimanCust)
                                @foreach ($allPengirimanCust as $i)
                            <tr onclick='editKantor("{{$i->id}}")'>
                                <td>{{$i->id}}</td>
                                <td>{{$i->kantor_id}}</td>
                                <td>{{$i->kurir_customer_id}}</td>
                                <td>{{$i->menuju_penerima}}</td>
                                <td>{{$i->total_muatan}}</td>
                                <td>{{$i->user_created}}</td>
                                <td>{{$i->created_at->diffForHumans()}}</td>
                                <td>{{$i->user_updated}}</td>
                                <td>{{$i->updated_at->diffForHumans()}}</td>
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
</div>  
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $("#upperlist-pengirimanCustomer").addClass("mm-active");
        $("#btn-pengirimanCustomer").attr("aria-expanded", "true");
        $("#list-pengirimanCustomer").attr("class", "mm-collapse mm-show");
        $("#header-pengirimanCustomer").attr("class", "mm-active");
    })

    var table = $('#tablePengirimanCust').DataTable({
        "pagingType": 'full_numbers',
        'paging': true,
        'lengthMenu': [10,25, 50, 100]
    });

    function editKantor(id){
        window.location.href='/admin/pengirimanCustomer/edit/' + id;
    }

</script>
@endsection 