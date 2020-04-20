@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-gift icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    UBAH DATA PENGIRIMAN CUSTOMER
@endsection

@section('subtitle')
Halaman ini untuk mengubah data pengiriman customer.
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
    <button id="triggerModal" type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target="#exampleModal" style="display: none">
        Trigger Modal
    </button>
    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <form novalidate class="needs-validation" method="post" action="/admin/pengirimanCustomer/update/{{$pengirimanCust->id}}" enctype="multipart/form-data">
                @csrf
                    <div class="form-row">
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                <label class="">ID Pengiriman Customer</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="id" 
                                type="text" class="form-control" value="{{$pengirimanCust->id}}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-row"
                    @if (Session::has('loginstatus'))
                        @if (Session::get('loginstatus') == 3)
                            hidden
                        @endif
                    @endif
                    >
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                <label class="">Kota</label>
                                <select id="kota" class="form-control" onchange='isiKantorAsal()' required>
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
                    <div class="form-row"
                    @if (Session::has('loginstatus'))
                        @if (Session::get('loginstatus') == 3)
                            hidden
                        @endif
                    @endif
                    >
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
                                    <input type="radio" class="form-check-input" onclick="showPesanan('penerima','{{$pengirimanCust->resis[0]->id}}')"  name="menuju_penerima" value="1"
                                    @if($pengirimanCust->menuju_penerima == '1')
                                        checked
                                    @endif
                                    > Penerima
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input" onclick="showPesanan('pengirim','{{$pengirimanCust->resis[0]->id}}')" name="menuju_penerima" value="0"
                                    @if($pengirimanCust->menuju_penerima == '0')
                                        checked
                                    @endif
                                    > Pengirim
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
                    <hr>
                    <div class="form-row">
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                <label class="">Status Aktif</label>
                                <select class="form-control" name="is_deleted" id="status" onchange="changeStatus()">
                                    @if ($pengirimanCust->is_deleted)
                                        <option selected class="form-control" value="1">TIDAK AKTIF</option>
                                        <option class="form-control" value="0">AKTIF</option>
                                    @else
                                        <option class="form-control" value="1">TIDAK AKTIF</option>
                                        <option selected class="form-control" value="0">AKTIF</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <button class="mt-2 btn btn-primary"
                                @if ($pengirimanCust->waktu_sampai_kantor != null)
                                    disabled
                                @endif
                                >Ubah</button>
                            </div>
                        </div>
                    </div>
                </form>
                <form novalidate class="needs-validation" method="post" action="/admin/pengirimanCustomer/finishPengiriman/{{$pengirimanCust->id}}" enctype="multipart/form-data">
                    @csrf
                    <button class="btn ml-2 mr-2 btn-danger pull-right"
                    @if($pengirimanCust->waktu_berangkat == null || $pengirimanCust->waktu_sampai_kantor != null)
                        disabled
                    @endif
                    >SELESAI PENGIRIMAN CUSTOMER</button>
                </form>
                <form novalidate class="needs-validation" method="post" action="/admin/pengirimanCustomer/startPengiriman/{{$pengirimanCust->id}}" enctype="multipart/form-data">
                    @csrf
                    <button class="btn ml-2 mr-2 btn-success pull-right"
                    @if($pengirimanCust->waktu_berangkat != null || $pengirimanCust->waktu_sampai_kantor != null)
                        disabled
                    @endif
                    >MULAI PENGIRIMAN CUSTOMER</button>
                </form>
            </div>
        </div>
    </div>
</div>  
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $("#upperlist-pengirimanCustomer").addClass("mm-active");
        $("#btn-pengirimanCustomer").attr("aria-expanded", "true");
        $("#list-pengirimanCustomer").attr("class", "mm-collapse mm-show");
        $("#header-pengirimanCustomer").attr("class", "mm-active");
    
        if ('{{Session::has("fail-detail")}}'){
            triggerNotification('{{Session::get("fail-detail")}}');
            @php
                Session::forget('fail-detail');
            @endphp
        } 

        var idKota = $('#kota').val();
        refreshCombobox(idKota, "null", "{{$pengirimanCust->kantor->id}}", "{{$pengirimanCust->kurir_customer->id}}");
        showPesanan("pengirim",'{{$pengirimanCust->resis[0]->id}}');
    })

    function showPesanan(tipe, idPesanan){
        if(tipe == "pengirim"){
            var idKota = $('#kantor').val();
            $("#formPesanan").removeClass("d-none");
            $("#formPesanan").addClass("d-block");
            $.ajax({
                method : "POST",
                url : '/admin/pengirimanCustomer/lihatPesanan',
                datatype : "json",
                data : { kota : idKota, pesanan : idPesanan, _token : "{{ csrf_token() }}" },
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
        refreshCombobox(idKota, "null", "null", "null");
        if($('#rbPenerima').is(':checked')){
            showPesanan("penerima",'{{$pengirimanCust->resis[0]->id}}');
        }
        else{
            showPesanan("pengirim",'{{$pengirimanCust->resis[0]->id}}');
        }
    }

    //UNTUK KURIR CUSTOMER
    function isiKurirCustomer(){
        var idKota = $('#kota').val();
        var idKantor = $('#kantor').val();
        refreshCombobox(idKota, idKantor,"null","null");
    }

    function refreshCombobox(idKota, idKantor, currKantor, currKurir){
        $.ajax({
            method : "POST",
            url : '/admin/pengirimanCustomer/isiCombobox/{{$pengirimanCust->id}}',
            datatype : "json",
            data : { kota : idKota, kantor : idKantor, kantorCurr : currKantor, kurirCurr : currKurir, _token : "{{ csrf_token() }}" },
            success: function(result){
                if(idKantor == "null"){
                    var hasil = result.split("|");
                    $('#kantor').html(hasil[0]);
                    $('#kurir').html(hasil[1]);
                }
                else{
                    $('#kurir').html(result);
                }
                showPesanan("pengirim",'{{$pengirimanCust->resis[0]->id}}');
            },
            error: function(){
                console.log('error');
            }
        });
    }
</script>
@endsection 