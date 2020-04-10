@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-note2 icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
SEMUA DATA RESI
@endsection

@section('subtitle')
Halaman ini untuk menampilkan semua data resi.
@endsection

@section('content')
<div class="tab-content">
    @if (Session::has('success-resi'))
        <ul class="list-group mb-2">
            <li class="list-group-item-success list-group-item">{{Session::get('success-resi')}}</li>
        </ul>
        @php
            Session::forget('success-resi');
        @endphp
    @endif
    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="container">
                    <button class="btn btn-primary pull-right" onclick="window.location.href='{{url('/admin/resi/create')}}';">Tambah Data</button>
                    <br><hr>
                    <table class="table table-hover table-striped dataTable dtr-inline" id="tablePesanan">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
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
        $("#upperlist-pesanan").addClass("mm-active");
        $("#btn-pesanan").attr("aria-expanded", "true");
        $("#list-pesanan").attr("class", "mm-collapse mm-show");
        $("#header-pesanan").attr("class", "mm-active");
    })

    function editPota(id){
        window.location.href='/admin/pesanan/edit/' + id;
    }

    var table = $('#tablePesanan').DataTable({
        "pagingType": 'full_numbers',
        'paging': true,
        'lengthMenu': [10,25, 50]
    });
</script>
@endsection
