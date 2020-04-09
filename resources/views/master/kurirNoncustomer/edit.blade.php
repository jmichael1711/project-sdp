@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-rocket icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    UBAH DATA KURIR NON CUSTOMER
@endsection

@section('subtitle')
Halaman ini untuk mengubah data kurir non customer.
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

    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <form novalidate class="needs-validation" method="post" action="/admin/kurir_noncustomer/update/{{$kurcust->id}}" enctype="multipart/form-data">
                @csrf
                    <div class="form-row">
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                <label class="">ID</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="id" 
                                type="text" class="form-control" value="{{$kurcust->id}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                <label class="">Nama</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="nama"
                                placeholder="NAMA KURIR" type="text" class="form-control" value="{{$kurcust->nama}}" required {{$kurcust->is_deleted ? 'disabled' : ''}}>
                                <div class="invalid-feedback">
                                    Mohon input nama yang valid.
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
                                    <input type="radio" class="form-check-input" name="jenis_kelamin" value="P"
                                    @if($kurcust->jenis_kelamin == "P")
                                        checked
                                    @endif
                                    {{$kurcust->is_deleted ? 'disabled' : ''}}> Pria
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="jenis_kelamin" value="W"
                                    @if($kurcust->jenis_kelamin == "W")
                                        checked
                                    @endif
                                    {{$kurcust->is_deleted ? 'disabled' : ''}}> Wanita
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
                                placeholder="Nomor Telpon" type="text" class="form-control"  value="{{$kurcust->no_telp}}" required {{$kurcust->is_deleted ? 'disabled' : ''}}>
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
                                placeholder="ALAMAT" type="text" class="form-control" value="{{$kurcust->alamat}}" required {{$kurcust->is_deleted ? 'disabled' : ''}}>
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
                                <label class="">Kota 1</label>
                                <select id="kota1" class="form-control" onchange='isiKantor("1")' required {{$kurcust->is_deleted ? 'disabled' : ''}}>
                                    @foreach ($allKota as $kota)
                                        @if($kota->nama == $kotaNow1)
                                            <option class="form-control" value="{{$kota->nama}}" selected>{{$kota->nama}}</option>
                                        @else 
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
                                <label class="">Alamat Kantor 1</label>
                                <select name="kantor_1_id" id="kantor1" class="form-control" required {{$kurcust->is_deleted ? 'disabled' : ''}}>
                                    <option selected class="form-control" value="{{$kurcust->kantor_1->id}}">{{$kurcust->kantor_1->alamat}}</option>
                                    @foreach($kurcust->kantor_1->getKota->kantor as $kantor)
                                        @if($kurcust->kantor_1->id != $kantor->id)
                                        <option class="form-control" value="{{$kantor->id}}">{{$kantor->alamat}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Mohon pilih kantor yang valid.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                <label class="">Kota 2</label>
                                <select id="kota2" class="form-control" onchange='isiKantor("2")' required {{$kurcust->is_deleted ? 'disabled' : ''}}>
                                    @foreach ($allKota as $kota)
                                        @if($kota->nama == $kotaNow1)
                                            <option class="form-control" value="{{$kota->nama}}" selected>{{$kota->nama}}</option>
                                        @else 
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
                                <label class="">Alamat Kantor 2</label>
                                <select name="kantor_2_id" id="kantor2" class="form-control" required {{$kurcust->is_deleted ? 'disabled' : ''}}>
                                    <option selected class="form-control" value="{{$kurcust->kantor_2->id}}">{{$kurcust->kantor_2->alamat}}</option>
                                    @foreach($kurcust->kantor_2->getKota->kantor as $kantor)
                                        @if($kurcust->kantor_2->id != $kantor->id)
                                        <option class="form-control" value="{{$kantor->id}}">{{$kantor->alamat}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Mohon pilih kantor yang valid.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                <label class="">Posisi</label>
                                <select name="posisi_di_kantor_1" class="form-control" id="kantor2" {{$kurcust->is_deleted ? 'disabled' : ''}}>
                                    @if ($kurcust->posisi_di_kantor_1)
                                        <option selected value="1">Alamat Kantor 1</option>
                                        <option value="0">Alamat Kantor 2</option>
                                    @else
                                        <option value="1">Alamat Kantor 1</option>
                                        <option selected value="0">Alamat Kantor 2</option>
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
                                <select name="is_deleted" class="form-control">
                                    @if ($kurcust['is_deleted'] == 1)
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
        $("#upperlist-kurir_noncustomer").addClass("mm-active");
        $("#btn-kurir_noncustomer").attr("aria-expanded", "true");
        $("#list-kurir_noncustomer").attr("class", "mm-collapse mm-show");
        $("#header-kurir_noncustomer").attr("class", "mm-active");
    })

    function isiKantor(type){
        var kota = $('#kota'+type).val();
        $.ajax({
            method : "POST",
            url : '/admin/pegawai/isiKantor',
            datatype : "json",
            data : { kota : kota, _token : "{{ csrf_token() }}" },
            success: function(result){
                $('#kantor'+type).html(result);
            },
            error: function(){
                console.log('error');
            }
        });
    }
</script>
@endsection
