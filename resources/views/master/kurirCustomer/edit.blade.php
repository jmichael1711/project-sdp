@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-tools icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    Edit Kendaraan
@endsection

@section('subtitle')
Page ini adalah untuk mengubah kendaraan.
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
            <div class="card-body">
                <form novalidate class="needs-validation" method="post" action="/admin/kendaraan/update/{{$kendaraan->id}}" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label class="">ID Kantor</label>
                            <select name="kurir_customer_id" class="form-control">
                                @foreach ($listkanID as $i)
                                    <option class="form-control" value="{{$i->id}}">{{$i->id}} - {{$i->kota}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-3">
                        <div class="position-relative form-group">
                            <label class="">Nama</label>
                            <input style="text-transform:uppercase" name="email_pengirim" id=""
                            placeholder="EMAIL PENGIRIM" type="text" class="form-control" required>
                            <div class="invalid-feedback">
                                Mohon inputkan email pengirim yang valid.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-3">
                        <div class="position-relative form-group">
                            <label class="">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control">
                                <option value="l" class="form-control">Laki-Laki</option>
                                <option value="p" class="form-control">Perempuan</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-3">
                        <div class="position-relative form-group">
                            <label class="">No_telp</label>
                            <input style="text-transform:uppercase" name="no_telp" id=""
                            placeholder="Nomor Telpon" type="text" class="form-control" required>
                            <div class="invalid-feedback">
                                Mohon inputkan Nomor Telpon yang valid.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label class="">Alamat</label>
                            <input style="text-transform:uppercase" name="alamat" id=""
                            placeholder="Alamat" type="text" class="form-control" required>
                            <div class="invalid-feedback">
                                Mohon inputkan alamat yang valid.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label class="">Nomor Polisi</label>
                            <input style="text-transform:uppercase" name="nopol" id=""
                            placeholder="NOMOR POLISI" type="text" class="form-control" required>
                            <div class="invalid-feedback">
                                Mohon inputkan Nomor Polisi yang valid.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label class="">Passsword</label>
                            <input style="text-transform:uppercase" name="password" id=""
                            placeholder="Password" type="text" class="form-control" required>
                            <div class="invalid-feedback">
                                Mohon inputkan password yang valid.
                            </div>
                        </div>
                    </div>
                </div>
                </form>
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
</script>
@endsection
