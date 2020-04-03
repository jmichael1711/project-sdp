@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-tools icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    Create Kurir Customer
@endsection

@section('subtitle')
Page ini adalah untuk menambah Kurir Customer baru.
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
            <div class="card-body"><h5 class="card-title">Kurir Customer</h5>
                <form novalidate class="needs-validation" method="post" action="/admin/kurir_customer/store" enctype="multipart/form-data">
                @csrf
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">ID Kantor</label>
                                <select name="kantor_id" class="form-control">
                                    @foreach ($listKanID as $i)
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
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="nama"
                                placeholder="NAMA KURIR" type="text" class="form-control" required>
                                <div class="invalid-feedback">Mohon inputkan nama kurir.</div>
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
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="alamat"
                                placeholder="ALAMAT" type="text" class="form-control" required>
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
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="nopol"
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
                    <div class="form-row">
                        <div class="col-md-2">
                            <div class="position-relative form-group">
                                <button class="mt-2 btn btn-primary">Tambah</button>
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
        $("#upperlist-kurir_customer").addClass("mm-active");
        $("#btn-kurir_customer").attr("aria-expanded", "true");
        $("#list-kurir_customer").attr("class", "mm-collapse mm-show");
        $("#header-tambah-kurir_customer").attr("class", "mm-active");
    })
</script>
@endsection
