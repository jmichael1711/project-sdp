@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-tools icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    Edit Pengiriman Customer
@endsection

@section('subtitle')
Page ini adalah untuk mengubah data pengiriman customer.
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
                <h5 class="card-title">Total Muatan : {{$pengirimanCust->total_muatan}} / 20 Kg</h5>
                <div class="mb-3 progress">
                    <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" style="width: {{$pengirimanCust->total_muatan*5}}%;"></div>
                </div>
                <div class="form-row">
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label class="">ID Pengiriman Customer</label>
                            <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                            this.setSelectionRange(p, p);" style="text-transform:uppercase" name="id" 
                            type="text" class="form-control" value="{{$pengirimanCust->id}}" readonly>
                        </div>
                    </div>
                </div>
                <div class="collapse" id="collapseEdit">
                    <form novalidate class="needs-validation" method="post" action="/admin/pengirimanCustomer/update/{{$pengirimanCust->id  }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-row">
                            <div class="col-md-4">
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
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label class="">Kantor Asal</label>
                                    <select name="kantor_id" id="kantor" class="form-control" onchange='isiKurirCustomer()' required></select>
                                    <div class="invalid-feedback">
                                        Mohon pilih kantor asal.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label class="">Kurir Customer</label>
                                    <select name="kurir_customer_id" id="kurir" class="form-control" required></select>
                                    <div class="invalid-feedback">
                                        Mohon pilih kurir customer.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label class="">Apakah kurir menuju ke penerima?</label>
                                    <br>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="menuju_penerima" value="1"
                                        @if($pengirimanCust->menuju_penerima == '1')
                                            checked
                                        @endif
                                        > Ya
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="menuju_penerima" value="0"
                                        @if($pengirimanCust->menuju_penerima == '0')
                                            checked
                                        @endif
                                        > Tidak
                                        </label>
                                    </div>
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
                <div class="card-footer">
                    <button type="button" data-toggle="collapse" href="#collapseEdit" class="btn btn-primary">Edit Pengiriman Customer</button>
                </div>
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
                    <div class="col-md-3">
                        <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target="#exampleModalLong" id="scan" onclick="triggerScanner()">
                            &nbsp Scan &nbsp
                        </button>
                    </div>
                    <br>
                    <form novalidate class="needs-validation" method="post" action="/admin/pengirimanCustomer/addDetail/{{$pengirimanCust->id}}" enctype="multipart/form-data">
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
                                    <button class="mt-2 btn btn-primary" id="tambahDetail">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <table class="table table-hover table-striped dataTable dtr-inline" id="tableDetail">
                        <thead>
                            <tr>
                                <th>Resi ID</th>
                                <th>Pengirim</th>
                                <th>Alamat Asal</th>
                                <th>Penerima</th>
                                <th>Alamat Tujuan</th>
                                <th>Berat</th>
                                <th>Dimensi</th>
                                <th>Fragile</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>User Created</th>
                                <th>User Updated</th>
                                <th>Status</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($pengirimanCust->resis->count() > 0)
                            @foreach ($pengirimanCust->resis as $i)
                            <tr>
                                <td>{{$i->id}}</td>
                                <td>{{$i->pesanan->nama_pengirim}}</td>
                                <td>{{$i->pesanan->alamat_asal}}</td>
                                <td>{{$i->pesanan->nama_penerima}}</td>
                                <td>{{$i->pesanan->alamat_tujuan}}</td>
                                <td>{{$i->pesanan->berat_barang}} Kg</td>
                                <td>{{$i->pesanan->panjang}} x {{$i->pesanan->lebar}} x {{$i->pesanan->tinggi}}</td>
                                @if ($i->pesanan->is_fragile)
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
                                <td>{{$i->d_pengiriman_customer->created_at->diffForHumans()}}</td>
                                <td>{{$i->d_pengiriman_customer->updated_at->diffForHumans()}}</td>
                                <td>{{$i->d_pengiriman_customer->user_created}}</td>
                                <td>{{$i->d_pengiriman_customer->user_updated}}</td>
                                @if ($i->d_pengiriman_customer->telah_sampai)
                                <td class="text-center text-white">
                                    <div class="badge badge-success">
                                        FINISH 
                                    </div>
                                </td>    
                                @else 
                                <td class="text-center text-white">
                                    <div class="badge badge-warning">
                                        ON GOING
                                    </div>
                                </td>
                                @endif
                                <td><button class="mb-2 mr-2 btn btn-danger deleteBtn" value="{{$i->id}}">Delete</button></td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>  
@endsection


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
            $("#tambahDetail").click();
        });
        
        var idKota = $('#kota').val();
        refreshCombobox(idKota, "null");
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

    //UNTUK KANTOR
    function isiKantorAsal(){
        var idKota = $('#kota').val();
        refreshCombobox(idKota, "null");
    }

    //UNTUK KURIR CUSTOMER
    function isiKurirCustomer(){
        var idKota = $('#kota').val();
        var idKantor = $('#kantor').val();
        refreshCombobox(idKota, idKantor);
    }

    function refreshCombobox(idKota, idKantor){
        @for ($i = 0; $i < $allKota->count(); $i++)
            if(idKota == '{{$allKota[$i]->nama}}'){
                @php
                    $allKantor = $allKota[$i]->kantor;
                @endphp

                if(idKantor == "null"){
                    @if(count($allKantor) > 0)
                        $('#kantor').html('@foreach ($allKantor as $kantor)<option class="form-control" value="{{$kantor->id}}">{{$kantor->alamat}}</option>@endforeach');
                        @if(count($allKantor[0]->kurir_customer) > 0)
                            $('#kurir').html('@foreach ($allKantor[0]->kurir_customer as $kurir)<option class="form-control" value="{{$kurir->id}}">{{$kurir->nama . " (" . $kurir->nopol . ")"}}</option>@endforeach');
                        @else
                            $('#kurir').html('<option value="">-- TIDAK ADA KURIR --</option>');
                        @endif
                    @else
                        $('#kantor').html('<option value="">-- TIDAK ADA KANTOR --</option>');
                        $('#kurir').html('<option value="">-- TIDAK ADA KURIR --</option>');
                    @endif
                }
                else{
                    @for ($j = 0; $j < $allKantor->count(); $j++)
                    if(idKantor == '{{$allKantor[$j]->id}}'){
                        @if(count($allKantor[$j]->kurir_customer) > 0)
                            $('#kurir').html('@foreach ($allKantor[$j]->kurir_customer as $kurir)<option class="form-control" value="{{$kurir->id}}">{{$kurir->nama . " (" . $kurir->nopol . ")"}}</option>@endforeach');
                        @else
                            $('#kurir').html('<option value="">-- TIDAK ADA KURIR --</option>');
                        @endif
                    }
                    @endfor
                }
            }
        @endfor
    }
</script>
@endsection 