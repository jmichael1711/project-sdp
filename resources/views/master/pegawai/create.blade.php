@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-users icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    Create Pegawai
@endsection

@section('subtitle')
Page ini adalah untuk menambah pegawai baru.
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
                <form novalidate class="needs-validation" method="post" action="/admin/pegawai/store" enctype="multipart/form-data">
                @csrf
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <label class="">ID Pegawai</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="id" 
                                type="text" class="form-control" value="{{$nextId}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <label class="">Nama</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="nama"
                                placeholder="NAMA" type="text" class="form-control" required>
                                <div class="invalid-feedback">Mohon inputkan nama.</div>
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
                                <div class="invalid-feedback pass">Inputkan password.</div>
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
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="no_telp" 
                                placeholder="NOMOR TELEPON" type="text" class="form-control" required>
                                <div class="invalid-feedback">
                                    Mohon inputkan nomor telepon.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <label class="">Alamat</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="alamat"
                                placeholder="ALAMAT" type="text" class="form-control">
                                <div class="invalid-feedback">
                                    Mohon inputkan alamat.
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <label class="">Kota</label>
                                <select id="kota" class="form-control" onchange='isiKantor()' required>
                                    @foreach ($allKota as $kota)
                                        <option class="form-control" value="{{$kota->nama}}">{{$kota->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <label class="">Kantor</label>
                                <select name="kantor_id" id="kantor" class="form-control" required></select>
                                <div class="invalid-feedback">
                                    Mohon pilih kantor asal.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <label class="">Jabatan</label>
                                <select name="jabatan" class="form-control" required>
                                    <option class="form-control" value="pegawai">Pegawai</option>
                                    <option class="form-control" value="admin">Admin</option>
                                </select> 
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

        isiKantor();
    })

    function isiKantor(){
        var kota = $('#kota').val();
        $.ajax({
            method : "POST",
            url : '/admin/pegawai/isiKantor',
            datatype : "json",
            data : { kota : kota, _token : "{{ csrf_token() }}" },
            success: function(result){
                $('#kantor').html(result);
            },
            error: function(){
                console.log('error');
            }
        });
    }
</script>
@endsection 