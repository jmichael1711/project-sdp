@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-tools icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    Create Pegawai
@endsection

@section('subtitle')
Page ini adalah untuk menambah pegawai baru.
@endsection

@php
    $messagePass1 = 'Inputkan password.';
    $messagePass2 = 'Inputkan konfirmasi password.';
@endphp

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
            <div class="card-body">
                <form novalidate class="needs-validation" method="post" action="/admin/kantor/store" enctype="multipart/form-data">
                @csrf
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <label class="">ID Pegawai</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="id" id="" 
                                placeholder="NO TELP" type="text" class="form-control" value="{{$nextId}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <label class="">Nama</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="nama" id="" 
                                placeholder="NAMA" type="text" class="form-control">
                                <div class="invalid-feedback">
                                    Mohon inputkan nama.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <label class="">Password</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="password" id="pass1" 
                                placeholder="Password" type="password" class="form-control" required>
                                <div class="invalid-feedback">{{$messagePass1}}</div>
                            </div>
                        </div>
                        <div class="col-md-3 ml-4">
                            <div class="position-relative form-group">
                                <label class="">Konfirmasi Password</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" id="pass2" 
                                placeholder="KONFIRMASI PASSWORD" type="password" class="form-control" required>
                                <div class="invalid-feedback cPass"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Jenis Kelamin</label>
                                <br>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="jenis_kelamin" value="P" checked> Pria
                                    </label>
                                  </div>
                                  <div class="form-check-inline">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="jenis_kelamin" value="W"> Wanita
                                    </label>
                                  </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <label class="">Nomor Telepon</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" id="no_telp" 
                                placeholder="NOMOR TELEPON" type="tel" min='12' max='12' pattern="\(\d\d\d\d\)-\d\d\d\d\d\d\d" class="form-control" required>
                                <div class="invalid-feedback">
                                    Mohon inputkan nomor telepon (12 angka).
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
        $("#upperlist-pegawai").addClass("mm-active");
        $("#btn-pegawai").attr("aria-expanded", "true");
        $("#list-pegawai").attr("class", "mm-collapse mm-show");
        $("#header-tambah-pegawai").attr("class", "mm-active");
    })

    $('#pass1, #pass2').on('keyup', function () {
        var pass1 = $('#pass1');
        var pass2 = $('#pass2');  

    })
</script>
@endsection 