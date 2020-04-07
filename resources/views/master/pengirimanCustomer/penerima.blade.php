@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-gift icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    SEMUA DATA PENGIRIMAN CUSTOMER MENUJU PENGIRIM
@endsection

@section('subtitle')
Halaman ini untuk menampilkan semua data pengiriman customer yang menuju ke pengirim.
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
                    <button class="btn btn-primary pull-right" onclick="window.location.href='{{url('/admin/pengirimanCustomer/create')}}';">Tambah Data</button>
                    <br><hr>
                    <table class="table table-hover table-striped dataTable dtr-inline" id="tablePengirimanCust">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ID Kantor</th>
                                <th>ID Kurir Customer</th>
                                <th>Total Muatan</th>
                                <th>Diubah Tanggal</th>
                                <th>Diubah Oleh</th>
                                <th>Dibuat Tanggal</th>
                                <th>Dibuat Oleh</th>
                                <th>Status</th>
                                <th>Status Aktif</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($allPengirimanCust)
                                @foreach ($allPengirimanCust as $i)
                            <tr onclick='editKantor("{{$i->id}}")'>
                                <td>{{$i->id}}</td>
                                <td>{{$i->kantor_id}}</td>
                                <td>{{$i->kurir_customer_id}}</td>
                                <td>{{$i->total_muatan}}</td>
                                <td>{{$i->updated_at}}</td>
                                <td>{{$i->user_updated}}</td>
                                <td>{{$i->created_at}}</td>
                                <td>{{$i->user_created}}</td>
                                @php
                                $finish = true;
                                @endphp
                                @foreach($i->resis as $j)
                                    @if($j->d_pengiriman_customer->telah_sampai == "0")
                                        @php
                                            $finish = false;
                                        @endphp
                                    @endif
                                @endforeach
                                @if ($finish == false)
                                <td class="text-center text-white">
                                    <div class="badge badge-warning">
                                        BELUM SELESAI
                                    </div>
                                </td>    
                                @else 
                                <td class="text-center text-white">
                                    <div class="badge badge-success">
                                        SELESAI
                                    </div>
                                </td>
                                @endif
                                @if ($i->is_deleted)
                                <td class="text-center text-white">
                                    <div class="badge badge-danger">
                                        TIDAK AKTIF
                                    </div>
                                </td>    
                                @else 
                                <td class="text-center text-white">
                                    <div class="badge badge-success">
                                        AKTIF
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
        $("#upperlist-penerima-pengirimanCustomer").addClass("mm-active");
        $("#btn-penerima-pengirimanCustomer").attr("aria-expanded", "true");
        $("#list-penerima-pengirimanCustomer").attr("class", "mm-collapse mm-show");
        $("#header-penerima-pengirimanCustomer").attr("class", "mm-active");
    })

    var table = $('#tablePengirimanCust').DataTable({
        "pagingType": 'full_numbers',
        'paging': true,
        'lengthMenu': [10,25, 50, 100],
        "scrollX": true
    });

    function editKantor(id){
        window.location.href='/admin/pengirimanCustomer/editPenerima/' + id;
    }

</script>
@endsection 