@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-tools icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    Semua Kurir Customer
@endsection

@section('subtitle')
Page ini adalah untuk melihat semua kurir customer.
@endsection

@section('content')
<div class="tab-content">
    @if (Session::has('success-kurir_customer'))
        <ul class="list-group mb-2">
            <li class="list-group-item-success list-group-item">{{Session::get('success-kurir_customer')}}</li>
        </ul>
        @php
            Session::forget('success-kurir_customer');
        @endphp
    @endif
    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
        <div class="main-card mb-3 card">
            <div style="overflow-x: auto" class="card-body"><h5 class="card-title">Semua Kurir Customer</h5>
                <table style="min-width: 100%;" class="table table-hover table-striped dataTable dtr-inline" id="tableKendaraan">
                    <thead>
                        <th>ID</th>
                        <th>ID kantor</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>No Telpon</th>
                        <th>Alamat</th>
                        <th>Nomor Polisi</th>
                        <th>Available</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        @foreach ($kurcust as $kc)
                            <tr onclick='editKurcust("{{$kc->id}}")'>
                                <td>{{$kc['id']}}</td>
                                <td>{{$kc['kantor_id']}}</td>
                                <td>{{$kc['nama']}}</td>
                                <td>{{$kc['jenis_kelamin']}}</td>
                                <td>{{$kc['no_telp']}}</td>
                                <td>{{$kc['nopol']}}</td>
                                @if ($kc['status'] == 1)
                                <td class="bg-danger text-center text-white">BUSY</td>
                                @else
                                <td class="bg-success text-center text-white">AVAILABLE</td>
                                @endif
                                @if ($ck['is_deleted'] == 1)
                                <td class="bg-danger text-center text-white">NOT ACTIVE</td>
                                @else
                                <td class="bg-success text-center text-white">ACTIVE</td>
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
        $("#upperlist-kurir_customer").addClass("mm-active");
        $("#btn-kurir_customer").attr("aria-expanded", "true");
        $("#list-kurir_customer").attr("class", "mm-collapse mm-show");
        $("#header-kurir_customer").attr("class", "mm-active");
    })

    function editKurcust(id){
        window.location.href='/admin/kurir_customer/edit/' + id;
    }

    var table = $('#tableKurcust').DataTable({
        "pagingType": 'full_numbers',
        'paging': true,
        'lengthMenu': [10,25, 50, 100]
    });
</script>
@endsection
