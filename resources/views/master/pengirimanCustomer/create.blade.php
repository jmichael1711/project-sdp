@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-gift icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    TAMBAH DATA PENGIRIMAN CUSTOMER
@endsection

@section('subtitle')
Halaman ini untuk menambah data pengiriman customer.
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
                <form novalidate class="needs-validation" method="post" action="/admin/pengirimanCustomer/store" enctype="multipart/form-data">
                @csrf
                    <div class="form-row">
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                <label class="">ID Pengiriman Customer</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="id" 
                                type="text" class="form-control" value="{{$nextId}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                <label class="">Kota</label>
                                <select id="kota" class="form-control" onchange='isiKantorAsal()' required>
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
                                <label class="">Kantor Asal</label>
                                <select name="kantor_id" id="kantor" class="form-control" onchange='isiKurirCustomer()' required></select>
                                <div class="invalid-feedback">
                                    Mohon pilih kantor asal yang valid.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                <label class="">Kurir Customer</label>
                                <select name="kurir_customer_id" id="kurir" class="form-control" required></select>
                                <div class="invalid-feedback">
                                    Mohon pilih kurir customer yang valid.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                <label class="">Tujuan</label>
                                <br>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                      <input type="radio" id="rbPenerima" class="form-check-input" onclick="showPesanan('penerima')" name="menuju_penerima" value="1" checked> Penerima
                                    </label>
                                  </div>
                                  <div class="form-check-inline">
                                    <label class="form-check-label">
                                      <input type="radio" id="rbPengirim" class="form-check-input" onclick="showPesanan('pengirim')" name="menuju_penerima" value="0"> Pengirim
                                    </label>
                                  </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row" id="formPesanan">
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                <label class="">Alamat Pesanan Customer</label>
                                <select name="resi_id" id="pesanan" class="form-control"></select>
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

        var idKota = $('#kota').val();
        refreshCombobox(idKota, "null");
        showPesanan("penerima");
    })

    function showPesanan(tipe){
        if(tipe == "pengirim"){
            var idKota = $('#kota').val();
            $("#formPesanan").removeClass("d-none");
            $("#formPesanan").addClass("d-block");
            $.ajax({
                method : "POST",
                url : '/admin/pengirimanCustomer/lihatPesanan',
                datatype : "json",
                data : { kota : idKota, _token : "{{ csrf_token() }}" },
                success: function(result){
                    $('#pesanan').html(result);
                },
                error: function(){
                    console.log('error');
                }
            });
        }
        else{
            $("#formPesanan").removeClass("d-block");
            $("#formPesanan").addClass("d-none");
        }
    }

    //UNTUK KANTOR
    function isiKantorAsal(){
        var idKota = $('#kota').val();
        refreshCombobox(idKota, "null");
        if($('#rbPengirim').is(':checked')){
            showPesanan("pengirim");
        }
        else{
            showPesanan("penerima");
        }
    }

    //UNTUK KURIR CUSTOMER
    function isiKurirCustomer(){
        var idKota = $('#kota').val();
        var idKantor = $('#kantor').val();
        refreshCombobox(idKota, idKantor);
    }

    function refreshCombobox(idKota, idKantor){
        $.ajax({
            method : "POST",
            url : '/admin/pengirimanCustomer/isiCombobox',
            datatype : "json",
            data : { kota : idKota, kantor : idKantor, kantorCurr : "null", kurirCurr : "null", _token : "{{ csrf_token() }}" },
            success: function(result){
                if(idKantor == "null"){
                    var hasil = result.split("|");
                    $('#kantor').html(hasil[0]);
                    $('#kurir').html(hasil[1]);
                }
                else{
                    $('#kurir').html(result);
                }
            },
            error: function(){
                console.log('error');
            }
        });
    }
</script>
@endsection 