@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-tools icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    Create Kantor
@endsection

@section('subtitle')
Page ini adalah untuk menambah kota baru.
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
            <div class="card-body"><h5 class="card-title">Kantor Baru</h5>
                <form novalidate class="needs-validation" method="post" action="/admin/kantor/store" enctype="multipart/form-data">
                @csrf
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Kota</label>
                                <select id="kota1" class="form-control" onchange="refreshKantor1()">
                                    @foreach ($listKota as $i)
                                        <option class="form-control" value="{{$i->nama}}">{{$i->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Kantor 1</label>
                                <select name="kantor_1_id" class="form-control" id="kantor1">
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Kota</label>
                                <select id="kota2" class="form-control">
                                    @foreach ($listKota as $i)
                                        <option class="form-control" value="{{$i->nama}}">{{$i->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Kantor 2</label>
                                <select name="kantor_2_id" class="form-control" id="kantor2">
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <label class="">Nomor Telepon</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="no_telp" id="" 
                                placeholder="NO TELP" type="text" class="form-control" required>
                                <div class="invalid-feedback">
                                    Mohon inputkan nomor telepon valid.
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
        $("#upperlist-kendaraan").addClass("mm-active");
        $("#btn-kendaraan").attr("aria-expanded", "true");
        $("#list-kendaraan").attr("class", "mm-collapse mm-show");
        $("#header-tambah-kendaraan").attr("class", "mm-active");
    })

    var refreshKantor1 = function() {
        var kotaId = $('#kota1').val()
        
        @foreach ($listKota as $kota)
            if (kotaId == '{{$kota->nama}}') {
                @php
                    $kantor1 = $kota->kantor;
                @endphp
                @if (count($kantor1) > 0)
                    console.log('KANTOR: ')
                    @foreach ($kantor1 as $kantor)
                        console.log('{{$kantor->id}}');
                    @endforeach
                @endif
            }
        @endforeach
        
       
       
    }
</script>
@endsection 