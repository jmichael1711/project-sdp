@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
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
                                <label class="">Kota</label>
                                <select id="kota1" class="form-control" onchange="refreshKantor('kota1', 'kantor1')" required>
                                    @foreach ($listKota as $i)
                                        @if ($kendaraan->kantor_1 && $i->nama == $kendaraan->kantor_1->kota)
                                            <option selected class="form-control" value="{{$i->nama}}">{{$i->nama}}</option>
                                        @else
                                            <option class="form-control" value="{{$i->nama}}">{{$i->nama}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label class="">Kantor 1</label>
                                <select value="{{$i->kantor_1_id}}" name="kantor_1_id" class="form-control" id="kantor1" onchange="kantor1Changed()" required {{$kendaraan->is_deleted ? 'disabled' : ''}}>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Kota</label>
                                <select id="kota2" class="form-control" onchange="refreshKantor('kota2', 'kantor2')" required {{$kendaraan->is_deleted ? 'disabled' : ''}}>
                                    @foreach ($listKota as $i)
                                        @if ($kendaraan->kantor_2 && $i->nama == $kendaraan->kantor_2->kota)
                                            <option selected class="form-control" value="{{$i->nama}}">{{$i->nama}}</option>
                                        @else
                                            <option class="form-control" value="{{$i->nama}}">{{$i->nama}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label class="">Kantor 2</label>
                                <select name="kantor_2_id" class="form-control" id="kantor2" required {{$kendaraan->is_deleted ? 'disabled' : ''}}>
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <label class="">Nomor Polisi</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="nopol" id="" 
                                placeholder="NO POLISI" type="text" class="form-control" maxlength="9" value="{{$kendaraan->nopol}}" required {{$kendaraan->is_deleted ? 'disabled' : ''}}>
                                <div class="invalid-feedback">
                                    Mohon inputkan nomor polisi valid.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <label class="">Tahun Pembelian</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="tahun_pembelian" id="" 
                                placeholder="2010" type="number" class="form-control" max="2020" min="0" value="{{$kendaraan->tahun_pembelian}}" required {{$kendaraan->is_deleted ? 'disabled' : ''}}>
                                <div class="invalid-feedback" >
                                    Mohon inputkan tahun valid.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label class="">Posisi</label>
                                <select name="posisi_di_kantor_1" class="form-control" id="kantor2" {{$kendaraan->is_deleted ? 'disabled' : ''}}>
                                    @if ($kendaraan->posisi_di_kantor_1)
                                        <option selected value="1">Kantor 1</option>
                                        <option value="0">Kantor 2</option>
                                    @else
                                        <option value="1">Kantor 1</option>
                                        <option selected value="0">Kantor 2</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2">
                            <div class="position-relative form-group">
                                <button class="mt-2 btn btn-primary">Edit</button>
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
        refreshKantor('kota1', 'kantor1')
        refreshKantor('kota2', 'kantor2')
    })

    var refreshKantor = function(idKota, idKantor) {
        var kotaId = $('#' +idKota).val()
        var kantorId1 = $('#kantor1').val()
        var kantorId2 = $('#kantor2').val()

        @foreach ($listKota as $kota)
            if (kotaId == '{{$kota->nama}}') {
                @php
                    $kantor1 = $kota->kantor;
                @endphp
                @if (count($kantor1) > 0)
                    s = '';
                    @foreach ($kantor1 as $kantor)
                        if ((idKota == 'kota2' && kantorId1 != '{{$kantor->id}}') || idKota == 'kota1') {
                            s = s + `<option value='{{$kantor->id}}'>{{$kantor->alamat}}</option>`;
                        }
                    @endforeach
                    $('#' +idKantor).html(s)
                @else
                    $('#' + idKantor).empty()
                @endif
            }
        @endforeach
    }

    var kantor1Changed = function() {
        var kantorId1 = $('#kantor1').val()
        var kantorId2 = $('#kantor2').val()

        if (kantorId1 == kantorId2) {
            $('#kantor2').empty()
            refreshKantor('kota2', 'kantor2')
        }
    }
</script>
@endsection 