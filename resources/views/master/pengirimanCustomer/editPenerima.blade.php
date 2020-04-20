@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-gift icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    UBAH DATA DETAIL PENGIRIMAN CUSTOMER
@endsection

@section('subtitle')
Halaman ini untuk mengubah data detail pengiriman customer menuju penerima.
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
                <h5 class="card-title">Total Muatan : {{$pengirimanCust->total_muatan}} / 20 Kg</h5>
                <div class="mb-3 progress">
                    <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" style="width: {{$pengirimanCust->total_muatan*5}}%;"></div>
                </div>
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
                    
                    <div class="collapse" id="collapseEdit">
                        <div class="form-row"
                        @if (Session::has('loginstatus'))
                            @if (Session::get('loginstatus') == 3 || Session::get('loginstatus') == 4)
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
                            @if (Session::get('loginstatus') == 3 || Session::get('loginstatus') == 4)
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
                                    <select name="kurir_customer_id" id="kurir" class="form-control" required
                                    @if (Session::has('loginstatus'))
                                        @if (Session::get('loginstatus') == 4)
                                            disabled
                                        @endif
                                    @endif
                                    ></select>
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
                                        <input type="radio" class="form-check-input" name="menuju_penerima" value="1"
                                        @if (Session::has('loginstatus'))
                                            @if (Session::get('loginstatus') == 4)
                                                disabled
                                            @endif
                                        @endif
                                        @if($pengirimanCust->menuju_penerima == '1')
                                            checked
                                        @endif
                                        > Penerima
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="menuju_penerima" value="0"
                                        @if (Session::has('loginstatus'))
                                            @if (Session::get('loginstatus') == 4)
                                                disabled
                                            @endif
                                        @endif
                                        @if($pengirimanCust->menuju_penerima == '0')
                                            checked
                                        @endif
                                        > Pengirim
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="col-md-5">
                                <div class="position-relative form-group">
                                    <label class="">Status Aktif</label>
                                    <select class="form-control" name="is_deleted" id="status" onchange="changeStatus()"
                                    @if (Session::has('loginstatus'))
                                        @if (Session::get('loginstatus') == 4)
                                            disabled
                                        @endif
                                    @endif
                                    >
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
                                    @if (Session::has('loginstatus'))
                                        @if (Session::get('loginstatus') == 4)
                                            disabled
                                        @endif
                                    @endif
                                    @if ($pengirimanCust->waktu_sampai_kantor != null)
                                        disabled
                                    @endif
                                    >Ubah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form novalidate class="needs-validation" method="post" action="/admin/pengirimanCustomer/finishPengiriman/{{$pengirimanCust->id}}" enctype="multipart/form-data">
                    @csrf
                    <button class="btn ml-2 mr-2 btn-danger pull-right"
                    @if (Session::has('loginstatus'))
                        @if (Session::get('loginstatus') == 4)
                            disabled
                        @endif
                    @endif
                    @if($pengirimanCust->waktu_berangkat == null || $pengirimanCust->waktu_sampai_kantor != null || $status == "")
                        disabled
                    @endif
                    >SELESAI PENGIRIMAN CUSTOMER</button>
                </form>
                <form novalidate class="needs-validation" method="post" action="/admin/pengirimanCustomer/startPengiriman/{{$pengirimanCust->id}}" enctype="multipart/form-data">
                    @csrf
                    <button class="btn ml-2 mr-2 btn-success pull-right"
                    @if (Session::has('loginstatus'))
                        @if (Session::get('loginstatus') == 4)
                            disabled
                        @endif
                    @endif
                    @if($pengirimanCust->waktu_berangkat != null || $pengirimanCust->waktu_sampai_kantor != null)
                        disabled
                    @endif
                    >MULAI PENGIRIMAN CUSTOMER</button>
                </form>
                <button type="button" data-toggle="collapse" href="#collapseEdit" class="btn btn-secondary">Detail Pengiriman Customer</button>
            </div>
        </div>
    </div>

        
    @if (Session::has('success-detail'))
        <ul class="list-group mb-2">
            <li class="list-group-item-success list-group-item">{{Session::get('success-detail')}}</li>
        </ul>
        @php
            Session::forget('success-detail');
        @endphp
    @endif
    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel"> 
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="container">
                    <button type="button" class="btn mr-2 mb-2 btn-primary pull-right" data-toggle="modal" data-target="#exampleModalLong" id="scan" onclick="triggerScanner()" {{$status}}>
                        &nbsp SCAN RESI &nbsp
                    </button>
                    @if ($tipe == "finish")
                    <form novalidate class="needs-validation" method="post" action="/admin/pengirimanCustomer/updateDetailPenerima/{{$pengirimanCust->id}}" enctype="multipart/form-data">
                    @else
                    <form novalidate class="needs-validation" method="post" action="/admin/pengirimanCustomer/addDetail/{{$pengirimanCust->id}}" enctype="multipart/form-data">
                    @endif
                        @csrf
                        <div class="form-row">
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="resi_id" id="resi_id" 
                                    placeholder="Id Resi" type="text" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Id Resi tidak valid.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="position-relative form-group" style="bottom: 10%">
                                    @if ($tipe == "finish")
                                    <button class="mt-2 btn btn-primary" id="updateStatus" {{$status}}>Selesai</button>    
                                    @else
                                    <button class="mt-2 btn btn-primary" id="updateStatus" {{$status}}>Tambah</button>                                        
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>


                    
                    <hr>
                    <table class="table table-hover table-striped dataTable dtr-inline" id="tableDetail">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pengirim</th>
                                <th>Alamat Pengirim</th>
                                <th>Penerima</th>
                                <th>Alamat Penerima</th>
                                <th>Berat</th>
                                <th>Dimensi</th>
                                <th>Fragile</th>
                                <th>Status Pesanan</th>
                                <th>Diubah Tanggal</th>
                                <th>Diubah Oleh</th>
                                <th>Dibuat Tanggal</th>
                                <th>Dibuat Oleh</th>
                                @if($tipe == "add")
                                <th>Perintah</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if($pengirimanCust->resis->count() > 0)
                            @foreach ($pengirimanCust->resis as $i)
                            <tr>
                                <td>{{$i->id}}</td>
                                <td>{{$i->nama_pengirim}}</td>
                                <td>{{$i->alamat_asal}}</td>
                                <td>{{$i->nama_penerima}}</td>
                                <td>{{$i->alamat_tujuan}}</td>
                                <td>{{$i->berat_barang}} Kg</td>
                                <td>{{$i->panjang}} cm x {{$i->lebar}} cm x {{$i->tinggi}} cm</td>
                                @if ($i->is_fragile)
                                <td class="text-center text-white">
                                    <div class="badge badge-danger">
                                        FRAGILE
                                    </div>
                                </td>    
                                @else 
                                <td class="text-center text-white">
                                    <div class="badge badge-success">
                                        FINE
                                    </div>
                                </td>
                                @endif
                                @if ($i->d_pengiriman_customer->telah_sampai)
                                <td class="text-center text-white">
                                    <div class="badge badge-success">
                                        SELESAI
                                    </div>
                                </td>    
                                @else 
                                <td class="text-center text-white">
                                    <div class="badge badge-warning">
                                        BELUM SELESAI
                                    </div>
                                </td>
                                @endif
                                <td>{{$i->d_pengiriman_customer->updated_at}}</td>
                                <td>{{$i->d_pengiriman_customer->user_updated}}</td>
                                <td>{{$i->d_pengiriman_customer->created_at}}</td>
                                <td>{{$i->d_pengiriman_customer->user_created}}</td>
                                @if($tipe == "add")
                                <td><button class="mb-2 mr-2 btn btn-danger" data-toggle="modal" onclick="passValue('{{$i->id}}')" data-target="#deleteDetail" value="{{$i->id}}">Delete</button></td>
                                @endif
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    @if($tipe == "add")
                    <button class="mb-2 mr-2 mt-5 btn btn-danger pull-right" data-toggle="modal" data-target="#deleteAllDetail">DELETE ALL</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>  
@endsection

{{-- Delete all detail --}}
<div class="modal fade" id="deleteAllDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">APAKAH ANDA YAKIN?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            SEMUA DATA AKAN TERHAPUS JIKA MENEKAN TOMBOL DELETE ALL.
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger"onclick="deleteAllDetail()" data-dismiss="modal">DELETE ALL</button>
        </div>
        </div>
    </div>
</div>

{{-- Delete per detail --}}
<div class="modal fade" id="deleteDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">APAKAH ANDA YAKIN?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            DATA INI AKAN TERHAPUS JIKA MENEKAN TOMBOL DELETE.
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="deleteDetail" onclick="deleteDetail()" data-dismiss="modal">Delete</button>
        </div>
        </div>
    </div>
</div>

{{-- Notification --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Error</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-0" id="modalContent"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- Scanner Video --}}
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Scan Resi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <video id="preview" style="width: 200px; height: 200px; border: 1px solid black;"></video>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeScanner()" id="close">Close</button>
            </div>
        </div>
    </div>
</div>

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
        
        scanner.addListener('scan', function(content) {
            $("#resi_id").val(content);
            $("#close").click();
            $("#updateStatus").click();    
        });

        var idKota = $('#kota').val();
        refreshCombobox(idKota, "null", "{{$pengirimanCust->kantor->id}}", "{{$pengirimanCust->kurir_customer->id}}");
    })

    var table = $('#tableDetail').DataTable({
        "pagingType": 'full_numbers',
        'paging': true,
        'lengthMenu': [10,25, 50, 100],
        "scrollX": true
    });

    let scanner = new Instascan.Scanner(
    {
        video: document.getElementById('preview')
    });

    function triggerScanner(){
        Instascan.Camera.getCameras().then(cameras => 
        {
            if(cameras.length > 0){
                scanner.start(cameras[0]);
            } else {
                console.error("Please enable Camera!");
            }
        });
    }
    
    function closeScanner(){
        Instascan.Camera.getCameras().then(cameras => 
        {
            if(cameras.length > 0){
                scanner.stop(cameras[0]);
            } else {
                console.error("Error Stop Camera");
            }
        });
    }
    
    function triggerNotification(text){
        $("#modalContent").html(text);
        $("#triggerModal").click();
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
            },
            error: function(){
                console.log('error');
            }
        });
    }

    //UNTUK KANTOR
    function isiKantorAsal(){
        var idKota = $('#kota').val();
        refreshCombobox(idKota, "null", "null", "null");
    }

    //UNTUK KURIR CUSTOMER
    function isiKurirCustomer(){
        var idKota = $('#kota').val();
        var idKantor = $('#kantor').val();
        refreshCombobox(idKota, idKantor,"null","null");
    }

    function passValue(id){
        $("#deleteDetail").val(id);
    }

    function deleteDetail(){
        var id = $('#deleteDetail').val();
        $.ajax({
            method : "POST",
            url : "/admin/pengirimanCustomer/deleteDetail/{{$pengirimanCust->id}}",
            datatype : "json",
            data : { id : id, _token : "{{ csrf_token() }}" },
            success: function(result){
                window.location.reload();
            },
            error: function(){
                console.log('error');
            }
        });
    }

    function deleteAllDetail(){
        $.ajax({
            method : "POST",
            url : "/admin/pengirimanCustomer/deleteAll/{{$pengirimanCust->id}}",
            datatype : "json",
            data : { _token : "{{ csrf_token() }}" },
            success: function(result){
                window.location.reload();
            },
            error: function(){
                console.log('error');
            }
        });
    }

</script>
@endsection 