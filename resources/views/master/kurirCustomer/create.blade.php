@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-bicycle icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    TAMBAH DATA KURIR CUSTOMER
@endsection

@section('subtitle')
Halaman ini untuk menambah data kurir customer.
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
            <div class="card-body">
                <form novalidate class="needs-validation" method="post" action="/admin/kurir_customer/store" enctype="multipart/form-data">
                @csrf
                    <div class="form-row">
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                <label class="">Nama</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="nama"
                                placeholder="NAMA KURIR" type="text" class="form-control" required>
                                <div class="invalid-feedback">Mohon input nama yang valid.</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-7">
                            <div class="position-relative form-group">
                                <label class="">Password</label>
                                <br>
                                <div class="form-check-inline col-md-8">
                                <input id="password-field" oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="password" id="pass1" 
                                    placeholder="Password" type="password" class="form-control" required>
                                </div>
                                <div class="form-check-inline">
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                                <div class="invalid-feedback">
                                    Mohon input password yang valid.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-5">
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
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                <label class="">Nomor Telepon</label>
                                <input style="text-transform:uppercase" name="no_telp" id=""
                                placeholder="Nomor Telpon" type="text" class="form-control" required>
                                <div class="invalid-feedback">
                                    Mohon input nomor telepon yang valid.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                <label class="">Alamat</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="alamat"
                                placeholder="ALAMAT" type="text" class="form-control" required>
                                <div class="invalid-feedback">
                                    Mohon input alamat yang valid.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                <label class="">Nomor Polisi</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="nopol"
                                placeholder="NOMOR POLISI" type="text" class="form-control" required>
                                <div class="invalid-feedback">
                                    Mohon input nomor polisi yang valid.
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="col-md-5">
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
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                <label class="">Alamat Kantor</label>
                                <select name="kantor_id" id="kantor" class="form-control" required></select>
                                <div class="invalid-feedback">
                                    Mohon pilih kantor yang valid.
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
    
    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>
@endsection
