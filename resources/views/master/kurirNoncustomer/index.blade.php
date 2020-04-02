@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-tools icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    Semua Kurir Non Customer
@endsection

@section('subtitle')
Page ini adalah untuk melihat semua kurir Non Customer.
@endsection

@section('content')
<div class="tab-content">
    @if (Session::has('success-kurir_noncustomer'))
        <ul class="list-group mb-2">
            <li class="list-group-item-success list-group-item">{{Session::get('success-kurir_noncustomer')}}</li>
        </ul>
        @php
            Session::forget('success-kurir_noncustomer');
        @endphp
    @endif
    @if (Session::has('failed-kurir_noncustomer'))
        <ul class="list-group mb-2">
            <li class="list-group-item-danger list-group-item">{{Session::get('failed-kurir_noncustomer')}}</li>
        </ul>
        @php
            Session::forget('failed-kurir_noncustomer');
        @endphp
    @endif
    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
        <div class="main-card mb-3 card">
            <div style="overflow-x: auto" class="card-body"><h5 class="card-title">Semua Kurir Non Customer</h5>
                <table style="min-width: 100%;" class="table table-hover table-striped dataTable dtr-inline" id="tableKurirNonCustomer">
                    <thead>
                        <th>ID</th>
                        <th>ID kantor 1</th>
                        <th>ID kantor 2</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>No Telpon</th>
                        <th>Posisi di kantor 1</th>
                        <th>Available</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        @foreach ($kurnoncust as $kc)
                            <tr onclick='editkurnoncust("{{$kc->id}}")'>
                                <td>{{$kc['id']}}</td>
                                <td>{{$kc['kantor_1_id']}}</td>
                                <td>{{$kc['kantor_2_id']}}</td>
                                <td>{{$kc['nama']}}</td>
                                @if($kc['jenis_kelamin']== 0)
                                    <td>Laki-Laki</td>
                                @else
                                    <td>Perempuan</td>
                                @endif
                                <td>{{$kc['no_telp']}}</td>
                                @if ($kc['posisi_di_kantor_1'] == 1)
                                <td class="text-center text-white">
                                    <div class="badge badge-success">
                                    TRUE
                                </td>
                                @else
                                <td class="text-center text-white">
                                    <div class="badge badge-danger">
                                    FALSE
                                    </div>
                                </td>
                                @endif
                                @if ($kc['status'] == 1)
                                <td class="text-center text-white">
                                    <div class="badge badge-success">
                                    AVAILABLE
                                    </div>
                                </td>
                                @else
                                <td class="text-center text-white">
                                    <div class="badge badge-danger">
                                    BUSY
                                    </div>
                                </td>
                                @endif
                                @if ($kc['is_deleted'] == 1)
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
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $("#upperlist-kurir_noncustomer").addClass("mm-active");
        $("#btn-kurir_noncustomer").attr("aria-expanded", "true");
        $("#list-kurir_noncustomer").attr("class", "mm-collapse mm-show");
        $("#header-kurir_noncustomer").attr("class", "mm-active");
    })

    function editkurnoncust(id){
        window.location.href='/admin/kurir_noncustomer/edit/' + id;
    }

    var table = $('#tableKurirNonCustomer').DataTable({
        "pagingType": 'full_numbers',
        'paging': true,
        'lengthMenu': [10,25, 50, 100]
    });
</script>
@endsection
