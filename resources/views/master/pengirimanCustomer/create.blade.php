@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-tools icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    Pengiriman Customer
@endsection

@section('subtitle')
Page ini adalah untuk menambah data pengiriman customer.
@endsection

@php
    $allKantor;
@endphp

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
                <form novalidate class="needs-validation" method="post" action="/admin/pengirimanCustomer/store" enctype="multipart/form-data">
                @csrf
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">ID Pengiriman Customer</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="id_pengiriman_customer" 
                                type="text" class="form-control" value="{{$nextId}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">COBA</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" id="coba" 
                                type="text" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Kota</label>
                                <select name="kota" id="kota" class="form-control" onchange='isiKantorAsal()'>
                                    @foreach ($allKota as $kota)
                                        <option class="form-control" value="{{$kota->nama}}">{{$kota->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Kantor Asal</label>
                                <select name="kantor" id="kantor" class="form-control" onchange='isiKurirCustomer()'></select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Kurir Customer</label>
                                <select name="kurir" id="kurir" class="form-control"></select>
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
        //UNTUK SIDEBAR
        $("#upperlist-pengirimanCustomer").addClass("mm-active");
        $("#btn-pengirimanCustomer").attr("aria-expanded", "true");
        $("#list-pengirimanCustomer").attr("class", "mm-collapse mm-show");
        $("#header-tambah-pengirimanCustomer").attr("class", "mm-active");

        //UNTUK KANTOR
        $('#kantor').html('@foreach ($allKota[0]->kantor as $kantor)<option class="form-control" value="{{$kantor->id}}">{{$kantor->alamat}}</option>@endforeach');
        @php 
            $allKantor = $allKota[0]->kantor;
        @endphp
        
        //UNTUK KURIR CUSTOMER
        $('#kurir').html('@foreach ($allKantor[0]->kurir_customer as $kurir)<option class="form-control" value="{{$kurir->id}}">{{$kurir->nama . " (" . $kurir->nopol . ")"}}</option>@endforeach');

    })

    //UNTUK KANTOR
    function isiKantorAsal(){
        var idKota = $('#kota').val();
        var found = false;
        @for ($i = 0; $i < $allKota->count(); $i++)             
            if(idKota == '{{$allKota[$i]->nama}}'){
                found = true;
                @php
                    $allKantor = $allKota[$i]->kantor;
                @endphp
                $('#kantor').html('@foreach ($allKantor as $kantor)<option class="form-control" value="{{$kantor->id}}">{{$kantor->alamat}}</option>@endforeach');
                $('#kurir').html('@foreach ($allKantor[0]->kurir_customer as $kurir)<option class="form-control" value="{{$kurir->id}}">{{$kurir->nama . " (" . $kurir->nopol . ")"}}</option>@endforeach');
            }
        @endfor
        if(found == false){
            $('#kantor').html('<option>KOSONG</option>');
            $('#kurir').html('<option>KOSONG</option>');
        }
    }

    //UNTUK KURIR CUSTOMER
    function isiKurirCustomer(){
        var idKantor = $('#kantor').val();
        var found = false;
        @for ($i = 0; $i < $allKantor->count(); $i++)
            if(idKantor == '{{$allKantor[$i]->id}}'){
                found = true;
                $('#coba').html('{{$allKantor[$i]->id}}')
                $('#kurir').html('@foreach ($allKantor[$i]->kurir_customer as $kurir)<option class="form-control" value="{{$kurir->id}}">{{$kurir->nama . " (" . $kurir->nopol . ")"}}</option>@endforeach');
            }
        @endfor
        if(found == false){
            $('#kurir').html('<option>KOSONG</option>');
        }
    }
</script>
@endsection 