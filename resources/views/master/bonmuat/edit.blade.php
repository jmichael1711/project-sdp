@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-box1 icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    UBAH DATA BON MUAT
@endsection

@section('subtitle')
Halaman ini untuk mengubah data bon muat.
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
                <h5 class="card-title">Total Muatan : {{$bonmuat->total_muatan}} / 1000 Kg</h5>
                <div class="mb-3 progress">
                    <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" style="width: {{$bonmuat->total_muatan/10}}%;"></div>
                </div>
                <div class="form-row">
                    <div class="col-md-5">
                        <div class="position-relative form-group">
                            <label class="">ID</label>
                            <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                            this.setSelectionRange(p, p);" style="text-transform:uppercase" name="id" disabled id="bonmuatId"
                            placeholder="ID" type="text" class="form-control" value="{{$bonmuat->id}}" readonly>
                        </div>
                    </div>
                </div>
                
                <div class="collapse" id="collapseEdit">
                    <form novalidate class="needs-validation" method="post" action="/admin/bonmuat/update/{{$bonmuat->id}}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-row"
                        @if (Session::has('loginstatus'))
                            @if (Session::get('loginstatus') == 3 || Session::get('loginstatus') == 4)
                                hidden
                            @endif
                        @endif
                        >
                            <div class="col-md-5">
                                <div class="position-relative form-group">
                                    <label class="">Kota Asal</label>
                                    <select class="form-control" id="kotaAsal" onchange='isiKantor("Asal")' {{$bonmuat->is_deleted ? 'disabled' : ''}} {{$status}}>
                                        @foreach ($allKota as $kota)
                                            @if($bonmuat->kantor_asal->kota == $kota->nama)
                                            <option selected class="form-control" value="{{$kota->nama}}">{{$kota->nama}}</option>
                                            @else
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
                                    <select name="kantor_asal_id" class="form-control" id="kantorAsal" onchange="refreshComboBox()" required {{$bonmuat->is_deleted ? 'disabled' : ''}} {{$status}}>
                                        <option selected class="form-control" value="{{$bonmuat->kantor_asal->id}}">{{$bonmuat->kantor_asal->alamat}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-5">
                                <div class="position-relative form-group">
                                    <label class="">Kota Tujuan</label>
                                    <select class="form-control" id="kotaTujuan" onchange='isiKantor("Tujuan")' {{$bonmuat->is_deleted ? 'disabled' : ''}} {{$status}}
                                        @if (Session::has('loginstatus'))
                                            @if (Session::get('loginstatus') == 4)
                                                disabled
                                            @endif
                                        @endif
                                        >
                                        @foreach ($allKota as $kota)
                                            @if($bonmuat->kantor_tujuan->kota == $kota->nama)
                                            <option selected class="form-control" value="{{$kota->nama}}">{{$kota->nama}}</option>
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
                                    <label class="">Kantor Tujuan</label>
                                    <select name="kantor_tujuan_id" class="form-control" id="kantorTujuan" onchange="refreshComboBox()" required {{$bonmuat->is_deleted ? 'disabled' : ''}} {{$status}}
                                        @if (Session::has('loginstatus'))
                                            @if (Session::get('loginstatus') == 4)
                                                disabled
                                            @endif
                                        @endif
                                        >
                                        <option selected class="form-control" value="{{$bonmuat->kantor_tujuan->id}}">{{$bonmuat->kantor_tujuan->alamat}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col-md-5">
                                <div class="position-relative form-group">
                                    <label class="">Kurir</label>
                                    <select name="kurir_non_customer_id" class="form-control" id="kurir" required {{$bonmuat->is_deleted ? 'disabled' : ''}} {{$status}}
                                        @if (Session::has('loginstatus'))
                                            @if (Session::get('loginstatus') == 4)
                                                disabled
                                            @endif
                                        @endif
                                        >
                                        <option selected class="form-control" value="{{$bonmuat->kurir_non_customer->id}}">{{$bonmuat->kurir_non_customer->nama}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-5">
                                <div class="position-relative form-group">
                                    <label class="">Kendaraan</label>
                                    <select name="kendaraan_id" class="form-control" id="kendaraan" required {{$bonmuat->is_deleted ? 'disabled' : ''}} {{$status}}
                                        @if (Session::has('loginstatus'))
                                            @if (Session::get('loginstatus') == 4)
                                                disabled
                                            @endif
                                        @endif
                                        >
                                        <option selected class="form-control" value="{{$bonmuat->kendaraan->id}}">{{$bonmuat->kendaraan->nopol}}</option>
                                    </select>
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
                                        @if ($bonmuat->is_deleted)
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
                            <div class="col-md-2">
                                <div class="position-relative form-group">
                                    <button class="mt-2 btn btn-primary"
                                    @if (Session::has('loginstatus'))
                                        @if (Session::get('loginstatus') == 4)
                                            disabled
                                        @endif
                                    @endif
                                    >Ubah</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <hr>
                <form novalidate class="needs-validation" method="post" action="/admin/bonmuat/mulaiBonMuat/{{$bonmuat->id}}" enctype="multipart/form-data">
                    @csrf
                    <button class="btn ml-2 mr-2 btn-primary pull-right" style="display: {{$bonmuat->is_deleted || $status == "disabled" ? 'none' : ''}}"
                        @if (Session::has('loginstatus'))
                            @if (Session::get('loginstatus') == 4)
                                disabled
                            @endif
                        @endif
                        >Mulai Bon Muat</button>
                </form>
                <button class="btn ml-2 mr-2 btn-primary pull-right" onclick="window.location.href='{{url('/admin/bonmuat/print/'.$bonmuat->id)}}';">Print Preview</button>
                <button type="button" data-toggle="collapse" href="#collapseEdit" class="btn btn-secondary">Ubah Bon Muat</button>
            </div>
        </div>
    </div>
    
    @if (Session::has('success-suratjalan'))
        <ul class="list-group mb-2">
            <li class="list-group-item-success list-group-item">{{Session::get('success-suratjalan')}}</li>
        </ul>
        @php
            Session::forget('success-suratjalan');
        @endphp
    @endif
    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel"> 
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="container">
                    <button type="button" class="btn mr-2 mb-2 btn-primary pull-right" data-toggle="modal" data-target="#exampleModalLong" id="scan" onclick="triggerScanner()" {{$bonmuat->is_deleted ? 'disabled' : ''}} {{$status}}>
                        &nbsp Scan &nbsp
                    </button>
                    <form novalidate class="needs-validation" method="post" action="/admin/bonmuat/addSuratJalan/{{$bonmuat->id}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="resi_id" id="resi_id" 
                                    placeholder="Id Resi" type="text" class="form-control" required {{$bonmuat->is_deleted ? 'disabled' : ''}} {{$status}}>
                                    <div class="invalid-feedback">
                                        Id Resi tidak valid.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="position-relative form-group" style="bottom: 10%">
                                    <button class="mt-2 btn btn-primary" id="tambahSuratJalan" {{$bonmuat->is_deleted ? 'disabled' : ''}} {{$status}}>Tambah</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <table class="table table-hover table-striped dataTable dtr-inline" id="tableSuratJalan">
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
                                <th>Waktu Sampai</th>
                                <th>Status</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($bonmuat->resis->count() > 0)
                            @foreach ($bonmuat->resis as $i)
                            <tr>
                                <td>{{$i->id}}</td>
                                <td>{{$i->nama_pengirim}}</td>
                                <td>{{$i->alamat_asal}}</td>
                                <td>{{$i->nama_penerima}}</td>
                                <td>{{$i->alamat_tujuan}}</td>
                                <td>{{$i->berat_barang}} Kg</td>
                                <td>{{$i->panjang}} x {{$i->lebar}} x {{$i->tinggi}}</td>
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
                                <td>{{$i->surat_jalan->created_at}}</td>
                                <td>{{$i->surat_jalan->updated_at}}</td>
                                <td>{{$i->surat_jalan->user_created}}</td>
                                <td>{{$i->surat_jalan->user_updated}}</td>
                                @if($i->surat_jalan->waktu_sampai == null)
                                <td>KOSONG</td>
                                @else
                                <td>{{$i->surat_jalan->waktu_sampai}}</td>
                                @endif
                                @if ($i->surat_jalan->telah_sampai)
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
                                <td><button class="mb-2 mr-2 btn btn-danger" data-toggle="modal" onclick="passValue('{{$i->id}}')" data-target="#deleteDetail" value="{{$i->id}}" {{$bonmuat->is_deleted || $status == "disabled" ? 'disabled' : ''}}>Delete</button></td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    <button class="mb-2 mr-2 mt-5 btn btn-danger pull-right" data-toggle="modal" data-target="#deleteAllDetail" {{$status}} >DELETE ALL</button>
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
            Apakah anda ingin menghapus data ini?
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
    $(document).ready(function (){
        $("#upperlist-bonmuat").addClass("mm-active");
        $("#btn-bonmuat").attr("aria-expanded", "true");
        $("#list-bonmuat").attr("class", "mm-collapse mm-show");
        $("#header-bonmuat").attr("class", "mm-active");
        
        @if (Session::has('loginstatus'))
            @if (Session::get('loginstatus') != 3)
                var idKota = $('#kotaAsal').val();
                refreshKantor(idKota,"Asal");
            @endif
        @endif
        var idKota2 = $('#kotaTujuan').val();
        refreshKantor(idKota2,"Tujuan");
        
        if ('{{Session::has("success-failsuratjalan")}}'){
            triggerNotification('{{Session::get("success-failsuratjalan")}}');
            @php
                Session::forget('success-failsuratjalan');
            @endphp
        } 
        scanner.addListener('scan', function(content) {
            $("#resi_id").val(content);
            $("#close").click();
            $("#tambahSuratJalan").click();
        });
    })
    
    var table = $('#tableSuratJalan').DataTable({
        "pagingType": 'full_numbers',
        'paging': true,
        'lengthMenu': [10,25, 50, 100],
        "scrollX": true
    });
    var previousKotaAsal;
    var previousKotaTujuan;
    
    $("#kotaAsal").on('focus', function () {
        previousKotaAsal = this.value;
    });
    $("#kotaTujuan").on('focus', function () {
        previousKotaTujuan = this.value;
    });
    
    function changeStatus(){
        var stat = $("#status").val();
        if(stat == "1"){
            var permitted = true;
            @foreach ($bonmuat->resis as $i)
                @if($i->surat_jalan->telah_sampai == 0)
                    permitted = false;
                @endif
            @endforeach
            
            if(!permitted){
                triggerNotification("Terdapat Surat Jalan yang belum selesai.");
                $("#status").val("0");
            }
        }   
    }

    function isiKantor(posisi){
        var totalSuratJalan = {{$bonmuat->resis->count()}};
        if(totalSuratJalan == 0){
            var idKota = $('#kota'+posisi).val();
            refreshKantor(idKota,posisi);
        }else{
            triggerNotification("Terdapat Surat Jalan dalam Bon Muat. Hapuslah Surat Jalan terlebih dahulu.");
            if(posisi == "Asal") $('#kotaAsal').val(previousKotaAsal);
            else if(posisi == "Tujuan") $('#kotaTujuan').val(previousKotaTujuan);
        }
    }

    function refreshKantor(idKota, posisi){
        var kantorSekarang = $("#kantor"+posisi).val();
        $.ajax({
            method : "POST",
            url : '/admin/bonmuat/cariKantor',
            datatype : "json",
            data : { kota: idKota,kantorSekarang: kantorSekarang, _token : "{{ csrf_token() }}" },
            success: function(result){
                $('#kantor'+posisi).html(result);
                refreshComboBox();
            },
            error: function(){
                console.log('error');
            }
        });
    }

    function refreshComboBox(){
        @if($status == "")
            var kantorAsal = $('#kantorAsal').val();
            var kantorTujuan = $('#kantorTujuan').val();
            var chosenKurir = $('#kurir').val();
            var chosenKendaraan = $('#kendaraan').val();
            var id = $('#bonmuatId').val();
            $.ajax({
                method : "POST",
                url : '/admin/bonmuat/find',
                datatype : "json",
                data : { status: "EDIT", id: id,kantorAsal : kantorAsal,kantorTujuan : kantorTujuan,kurir: chosenKurir,kendaraan: chosenKendaraan, _token : "{{ csrf_token() }}" },
                success: function(result){
                    var hasil = result.split('|');
                    $('#kurir').html(hasil[0]);
                    $('#kendaraan').html(hasil[1]);
                },
                error: function(){
                    console.log('error');
                }
            });
        @endif
    }

    function passValue(id){
        $("#deleteDetail").val(id);
    }

    function deleteDetail(){
        var id = $("#deleteDetail").val();
        var bonmuat = "{{$bonmuat->id}}";
        $.ajax({
            method : "POST",
            url : '/admin/bonmuat/deleteSuratJalan',
            datatype : "json",
            data : { bonmuat : bonmuat,id : id, _token : "{{ csrf_token() }}" },
            success: function(result){
                window.location.reload();
            },
            error: function(){
                console.log('error');
            }
        });
    }

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
    
    function deleteAllDetail(){
        $.ajax({
            method : "POST",
            url : "/admin/bonmuat/deleteAll/{{$bonmuat->id}}",
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

    function triggerNotification(text){
        $("#modalContent").html(text);
        $("#triggerModal").click();
    }

</script>
@endsection  


