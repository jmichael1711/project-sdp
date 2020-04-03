@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-users icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    Edit Pegawai
@endsection

@section('subtitle')
Page ini adalah untuk mengubah data pegawai.
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
            <form novalidate class="needs-validation" method="post" action="/admin/pegawai/update/{{$pegawai->id  }}" enctype="multipart/form-data">
                @csrf
                    <div class="form-row">
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                <label class="">ID</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="id" 
                                type="text" class="form-control" value="{{$pegawai->id}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                <label class="">Nama</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="nama"
                                placeholder="NAMA" type="text" value="{{$pegawai->nama}}" class="form-control" required>
                                <div class="invalid-feedback">Mohon input nama yang valid.</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                <label class="">Password</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="password" id="pass1" 
                                placeholder="Password" type="password" value="{{$pegawai->password}}" class="form-control" required>
                                <div class="invalid-feedback pass">Mohon input password yang valid.</div>
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
                                      <input type="radio" class="form-check-input" name="jenis_kelamin" value="P"
                                      @if($pegawai->jenis_kelamin == "P")
                                        checked
                                      @endif
                                      > Pria
                                    </label>
                                  </div>
                                  <div class="form-check-inline">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="jenis_kelamin" value="W"
                                      @if($pegawai->jenis_kelamin == "W")
                                        checked
                                      @endif
                                      > Wanita
                                    </label>
                                  </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                <label class="">Nomor Telepon</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="no_telp" 
                                placeholder="NOMOR TELEPON" type="text" value="{{$pegawai->no_telp}}" class="form-control" required>
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
                                placeholder="ALAMAT" type="text" value="{{$pegawai->alamat}}" class="form-control">
                                <div class="invalid-feedback">
                                    Mohon input alamat yang valid.
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
                                    <option class="form-control" value="{{$kotaNow}}">{{$kotaNow}}</option>
                                    @foreach ($allKota as $kota)
                                        @if($kota->nama != $kotaNow)
                                            <option class="form-control" value="{{$kota->nama}}">{{$kota->nama}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                <label class="">Kantor</label>
                                <select name="kantor_id" id="kantor" class="form-control" required>
                                    <option selected class="form-control" value="{{$pegawai->kantor->id}}">{{$pegawai->kantor->alamat}}</option>
                                    @foreach($pegawai->kantor->getKota->kantor as $kantor)
                                        @if($pegawai->kantor->id != $kantor->id)
                                        <option class="form-control" value="{{$kantor->id}}">{{$kantor->alamat}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Mohon pilih kantor asal yang valid.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                <label class="">Jabatan</label>
                                <select name="jabatan" class="form-control" required>
                                    @if($pegawai->jabatan == 'kasir')
                                        <option class="form-control" value="kasir" selected>Kasir</option>
                                        <option class="form-control" value="pegawai">Pegawai Biasa</option>
                                        <option class="form-control" value="admin">Admin</option>
                                    @elseif($pegawai->jabatan == 'pegawai')
                                        <option class="form-control" value="kasir">Kasir</option>
                                        <option class="form-control" value="pegawai" selected>Pegawai Biasa</option>
                                        <option class="form-control" value="admin">Admin</option>
                                    @else
                                        <option class="form-control" value="kasir">Kasir</option>
                                        <option class="form-control" value="pegawai">Pegawai Biasa</option>
                                        <option class="form-control" value="admin" selected>Admin</option>
                                    @endif
                                </select> 
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                <label class="">Status Aktif</label>
                                <select class="form-control" name="is_deleted">
                                    @if ($pegawai->is_deleted)
                                        <option class="form-control" value="0">AKTIF</option>
                                        <option selected class="form-control" value="1">TIDAK AKTIF</option>
                                    @else
                                        <option selected class="form-control" value="0">AKTIF</option>
                                        <option class="form-control" value="1">TIDAK AKTIF</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2">
                            <div class="position-relative form-group">
                                <button class="mt-2 btn btn-primary">Ubah</button>
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
        $("#header-pegawai").attr("class", "mm-active");

    });

    function isiKantor(){
        var kota = $('#kota').val();
        $.ajax({
            method : "POST",
            url : '/admin/pegawai/isiKantor',
            datatype : "json",
            data : { kota : kota, _token : "{{ csrf_token() }}" },
            success: function(result){
                $('#kantor_id').html(result);
            },
            error: function(){
                console.log('error');
            }
        });
    }

</script>
@endsection 