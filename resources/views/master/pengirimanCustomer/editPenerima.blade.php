@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-gift icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    UBAH DATA DETAIL PENGIRIMAN CUSTOMER PENERIMA
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
                        <div class="form-row">
                            <div class="col-md-5">
                                <div class="position-relative form-group">
                                    <label class="">Kantor</label>
                                    <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                    this.setSelectionRange(p, p);" style="text-transform:uppercase" disabled 
                                    placeholder="ID" type="text" class="form-control" value="{{$pengirimanCust->kantor->alamat}}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-5">
                                <div class="position-relative form-group">
                                    <label class="">Kurir Customer</label>
                                    <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                    this.setSelectionRange(p, p);" style="text-transform:uppercase" disabled 
                                    placeholder="ID" type="text" class="form-control" value="{{$pengirimanCust->kurir_customer->nama}} - {{$pengirimanCust->kurir_customer->nopol}}" readonly>
                                </div>
                            </div>
                        </div>
                <hr>
                </div>
                <div class="card-footer">
                    <button type="button" data-toggle="collapse" href="#collapseEdit" class="btn btn-primary">Detail Pengiriman Customer</button>
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
                    <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target="#exampleModalLong" id="scan" onclick="triggerScanner()" {{$status}}>
                        &nbsp Scan &nbsp
                    </button>
                    <form novalidate class="needs-validation" method="post" action="/admin/pengirimanCustomer/updateDetailPenerima/{{$pengirimanCust->id}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="resi_id" id="resi_id" 
                                    placeholder="Id Resi" type="text" class="form-control" required {{$status}}>
                                    <div class="invalid-feedback">
                                        Id Resi tidak valid.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="position-relative form-group" style="bottom: 10%">
                                    <button class="mt-2 btn btn-primary" id="updateStatus" {{$status}}>Selesai</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
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
                                <td>{{$i->pesanan->panjang}} cm x {{$i->pesanan->lebar}} cm x {{$i->pesanan->tinggi}} cm</td>
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
                                <td>{{$i->d_pengiriman_customer->created_at}}</td>
                                <td>{{$i->d_pengiriman_customer->updated_at}}</td>
                                <td>{{$i->d_pengiriman_customer->user_created}}</td>
                                <td>{{$i->d_pengiriman_customer->user_updated}}</td>
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
                                <td><button class="mb-2 mr-2 btn btn-danger" data-toggle="modal" onclick="passValue('{{$i->id}}')" data-target="#deleteDetail" value="{{$i->id}}">Delete</button></td>
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
        $("#upperlist-penerima-pengirimanCustomer").addClass("mm-active");
        $("#btn-penerima-pengirimanCustomer").attr("aria-expanded", "true");
        $("#list-penerima-pengirimanCustomer").attr("class", "mm-collapse mm-show");
        $("#header-penerima-pengirimanCustomer").attr("class", "mm-active");
    
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

</script>
@endsection 