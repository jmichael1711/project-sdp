@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-note2 icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
UBAH DATA RESI
@endsection

@section('subtitle')
Halaman ini untuk mengubah data resi
@endsection

@section('content')
    <div class="tab-content">
    @if (Session::has('success-resi'))
        <ul class="list-group mb-2">
            <li class="list-group-item-success list-group-item">{{Session::get('success-resi')}}</li>
        </ul>
        @php
            Session::forget('success-resi');
        @endphp
    @endif
    @if (Session::has('failed-resi'))
        <ul class="list-group mb-2">
            <li class="list-group-item-danger list-group-item">{{Session::get('failed-resi')}}</li>
        </ul>
        @php
            Session::forget('failed-resi');
        @endphp
    @endif
    <button id="triggerModal" type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target="#exampleModal" style="display: none">
        Trigger Modal
    </button>
    <button onclick="window.location.href='{{url('/admin/resi/print/'.$resi->id)}}';" class="mt-2 btn btn-primary pull-right">&nbsp Print Preview &nbsp</button>
    <form novalidate class="needs-validation" method="post" action="/admin/resi/update/{{$resi->id}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-row">
            <div class="col-md-5">
                <div class="position-relative form-group">
                    <label class="">ID</label>
                    <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="id" id=""
                    placeholder="ID" type="text" class="form-control" value="{{$resi->id}}" readonly>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-5">
                <div class="position-relative form-group">
                    <label class="">Nama Pengirim</label>
                    <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="nama_pengirim"
                    placeholder="NAMA PENGIRIM" type="text" class="form-control" required value="{{$resi->nama_pengirim}}" {{$status}}>
                    <div class="invalid-feedback">Mohon input nama pengirim yang valid.</div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="position-relative form-group">
                    <label class="">Nama Penerima</label>
                    <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="nama_penerima"
                    placeholder="NAMA PENERIMA" type="text" class="form-control" required value="{{$resi->nama_penerima}}" {{$status}}>
                    <div class="invalid-feedback">Mohon input nama penerima yang valid.</div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="position-relative form-group">
                    <label class="">Nomor Telepon Pengirim</label>
                    <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="no_telp_pengirim" 
                    placeholder="NOMOR TELEPON PENGIRIM" type="text" class="form-control" required value="{{$resi->no_telp_pengirim}}" {{$status}}>
                    <div class="invalid-feedback">
                        Mohon input nomor telepon pengirim yang valid.
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="position-relative form-group">
                    <label class="">Nomor Telepon Penerima</label>
                    <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="no_telp_penerima" 
                    placeholder="NOMOR TELEPON PENERIMA" type="text" class="form-control" required value="{{$resi->no_telp_penerima}}" {{$status}}>
                    <div class="invalid-feedback">
                        Mohon input nomor telepon penerima yang valid.
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="position-relative form-group">
                    <label class="">Email Pengirim</label>
                    <input oninput="let p = this.selectionStart; 
                    this.setSelectionRange(p, p);" name="email_pengirim" 
                    placeholder="EMAIL PENGIRIM" type="email" class="form-control" required value="{{$resi->email_pengirim}}" {{$status}}>
                    <div class="invalid-feedback">
                        Mohon input email pengirim yang valid.
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="position-relative form-group">
                    <label class="">Email Penerima</label>
                    <input oninput="let p = this.selectionStart;
                    this.setSelectionRange(p, p);"  name="email_penerima" 
                    placeholder="EMAIL PENERIMA" type="email" class="form-control" required value="{{$resi->email_penerima}}" {{$status}}>
                    <div class="invalid-feedback">
                        Mohon input email pengirim yang valid.
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="position-relative form-group">
                    <label class="">Kota Pengirim</label>
                    <select id="kota_asal" name="kota_asal" class="form-control" required onchange="hitungHarga()" {{$status}}>
                        @foreach ($allKota as $kota)
                            @if($resi->kota_asal == $kota->nama)
                            <option selected class="form-control" value="{{$kota->nama}}">{{$kota->nama}}</option>
                            @else
                            <option class="form-control" value="{{$kota->nama}}">{{$kota->nama}}</option>
                            @endif
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Mohon pilih kota pengirim yang valid.
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="position-relative form-group">
                    <label class="">Kota Penerima</label>
                    <select id="kota_tujuan" name="kota_tujuan" class="form-control" required onchange="hitungHarga()" {{$status}}>
                        @foreach ($allKota as $kota)
                            @if($resi->kota_tujuan == $kota->nama)
                            <option selected class="form-control" value="{{$kota->nama}}">{{$kota->nama}}</option>
                            @else
                            <option class="form-control" value="{{$kota->nama}}">{{$kota->nama}}</option>
                            @endif
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Mohon pilih kota Penerima yang valid.
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="position-relative form-group">
                    <label class="">Alamat Pengirim</label>
                    <textarea style="resize: none;" rows="5" oninput="let p = this.selectionStart; 
                    this.setSelectionRange(p, p);" name="alamat_asal"
                    placeholder="ALAMAT PENGIRIM" type="text" class="form-control" required {{$status}}>{{$resi->alamat_asal}}</textarea>
                    <div class="invalid-feedback">
                        Mohon input alamat pengirim yang valid.
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="position-relative form-group">
                    <label class="">Alamat Penerima</label>
                    <textarea style="resize: none;" rows="5" oninput="let p = this.selectionStart;
                    this.setSelectionRange(p, p);" name="alamat_tujuan"
                    placeholder="ALAMAT PENERIMA" type="text" class="form-control" required {{$status}}>{{$resi->alamat_tujuan}}</textarea>
                    <div class="invalid-feedback">
                        Mohon input alamat penerima yang valid.
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="position-relative form-group">
                    <label class="">Kodepos Pengirim</label>
                    <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="kode_pos_pengirim" 
                    placeholder="KODEPOS PENGIRIM" type="number" class="form-control" required value="{{$resi->kode_pos_pengirim}}" {{$status}}>
                    <div class="invalid-feedback">
                        Mohon input kodepos pengirim yang valid.
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="position-relative form-group">
                    <label class="">Kodepos Penerima</label>
                    <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="kode_pos_penerima" 
                    placeholder="KODEPOS PENERIMA" type="number" class="form-control" required value="{{$resi->kode_pos_penerima}}" {{$status}}>
                    <div class="invalid-feedback">
                        Mohon input kodepos penerima yang valid.
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="form-row">
            <div class="col-md-5">
                <div class="position-relative form-group">
                    <label class="">Keterangan</label>
                    <textarea style="resize: none;" rows="5" oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="keterangan"
                    placeholder="KETERANGAN" type="text" class="form-control" required {{$status}}>{{$resi->keterangan}}</textarea>
                    <div class="invalid-feedback">
                        Mohon input keterangan yang valid.
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-7">
                <div class="position-relative form-group">
                    <label class="">Dimensi Barang (CentiMeter)</label>
                    <div class="form-inline">
                        <input required oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                        this.setSelectionRange(p, p);" style="text-transform:uppercase" name="panjang" 
                        placeholder="PANJANG (CM)" step="1" type="number" max="999.999999" min="0.000000" class="form-control mr-2" value="{{$resi->panjang}}" {{$status}}>X
                        <input required oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                        this.setSelectionRange(p, p);" style="text-transform:uppercase" name="lebar" 
                        placeholder="LEBAR (CM)" step="1" type="number" max="999.999999" min="0.000000" class="form-control ml-2 mr-2" value="{{$resi->lebar}}" {{$status}}>X
                        <input required oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                        this.setSelectionRange(p, p);" style="text-transform:uppercase" name="tinggi" 
                        placeholder="TINGGI (CM)" step="1" type="number" max="999.999999" min="0.000000" class="form-control ml-2" value="{{$resi->tinggi}}" {{$status}}>
                        <div class="invalid-feedback">
                            Mohon input dimensi barang yang valid.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-5">
                <div class="position-relative form-group">
                    <label class="">Berat Barang (KiloGram)</label>
                    <input required oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="berat_barang" id="berat_barang"
                    placeholder="BERAT (KG)" step="0.001" type="number" max="20" min="0.001" class="form-control" value="{{$resi->berat_barang}}" onchange="hitungHarga()" {{$status}}>
                    <div class="invalid-feedback">
                        Mohon input dimensi barang yang valid.
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-5">
                <div class="position-relative form-group">
                    <label class="">Fragility Barang</label>
                    <select id="is_fragile" name="is_fragile" class="form-control" required {{$status}}>
                        @if($resi->is_fragile)
                            <option selected class="form-control" value="1">FRAGILE</option>
                            <option class="form-control" value="0">FINE</option>
                        @else
                            <option selected class="form-control" value="0">FINE</option>
                            <option class="form-control" value="1">FRAGILE</option>
                        @endif
                    </select>
                    <div class="invalid-feedback">
                        Mohon pilih fragility barang yang valid.
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-5">
                <div class="position-relative form-group">
                    <label class="">Harga</label>
                    <input oninput="let p = this.selectionStart; 
                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="harga" id="harga_barang"
                    placeholder="Rp 0.00" type="text" class="form-control" readonly value="{{$resi->harga}}">
                </div>
            </div>
        </div>

        <hr>
        <div class="form-row">
            <div class="col-md-5">
                <div class="position-relative form-group">
                    <label class="">Status Aktif</label>
                    <select class="form-control" name="is_deleted" id="status" onchange="changeStatus()" {{$status}}
                    @if (Session::has('loginstatus'))
                        @if (Session::get('loginstatus') == 4)
                            disabled
                        @endif
                    @endif
                    >
                        @if ($resi->is_deleted)
                            <option selected class="form-control" value="1">TIDAK AKTIF</option>
                            <option class="form-control" value="0">AKTIF</option>
                        @else
                            <option class="form-control" value="1">TIDAK AKTIF</option>
                            <option selected class="form-control" value="0">AKTIF</option>
                        @endif
                    </select>
                </div>
            </div>
            @if($selesai == 1)
            <div class="col-md-5">
                <div class="position-relative form-group">
                    <label class="">OTP</label>
                    <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                    this.setSelectionRange(p, p);" style="text-transform:uppercase" id="otp"
                    placeholder="OTP" type="text" class="form-control" required value="" {{$status}}>
                    <div class="invalid-feedback">Mohon input otp yang valid.</div>
                </div>
            </div>
            @endif
        </div>

        <div class="form-row">
            <div class="col-md-5">
                <div class="position-relative form-group">
                    <button class="mt-2 btn btn-primary" {{$status}}>Ubah</button>
                    @if($resi->status_perjalanan != "BATAL")
                        <button type="button" class="mt-2 btn btn-danger" data-toggle="modal" data-target="#batalResi" {{$status}}>Batal Resi</button>
                    @endif
                </div>
            </div>
            <div class="col-md-5">
                <div class="position-relative form-group">
                    @if($selesai == 1)
                        <button type="button" class="mr-2 mt-2 btn btn-danger pull-right" data-toggle="modal" data-target="#selesaiResi" {{$status}}>Selesai</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </form>
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

{{-- Selesai resi --}}
<div class="modal fade" id="selesaiResi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">APAKAH ANDA YAKIN?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            Apakah anda ingin menyelesaikan resi ini?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" onclick="selesaiResi('{{$resi->id}}')" data-dismiss="modal">Selesai</button>
        </div>
        </div>
    </div>
</div>

{{-- Batal resi --}}
<div class="modal fade" id="batalResi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">APAKAH ANDA YAKIN?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            Apakah anda ingin membatalkan resi ini?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" onclick="batalResi('{{$resi->id}}')" data-dismiss="modal">Selesai</button>
        </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
     $(document).ready(function () {
        $("#upperlist-resi").addClass("mm-active");
        $("#btn-resi").attr("aria-expanded", "true");
        $("#list-resi").attr("class", "mm-collapse mm-show");
        $("#header-resi").attr("class", "mm-active");
    })

    
    function hitungHarga(){
        var kotaAsal = $("#kota_asal").val();
        var kotaTujuan = $("#kota_tujuan").val();
        var berat = $("#berat_barang").val();
        if(kotaAsal != "" && kotaTujuan != "" && (berat > 0 && berat <= 20)){
            $.ajax({
                method : "POST",
                url : "/admin/resi/countCost",
                datatype : "json",
                data : { kotaAsal : kotaAsal,kotaTujuan : kotaTujuan,berat : berat, _token : "{{ csrf_token() }}" },
                success: function(result){
                    $("#harga_barang").val(result);
                },
                error: function(){
                    console.log('error');
                }
            });
        }else if(berat != "" && berat > 20){
            $("#modalContent").html("Berat barang melebihi batas maksimal 20Kg");
            $("#triggerModal").click();
        }else if(berat != "" && berat <= 0){
            $("#modalContent").html("Berat barang minimal adalah 1 gram");
            $("#triggerModal").click();
        }
    }

    function selesaiResi(id){
        var otp = $("#otp").val();
        if(otp == ""){
            triggerNotification("Mohon isi otp terlebih dahulu");
        }else window.location.href = '/admin/resi/selesai/'+id+'/'+otp;
    }
    function batalResi(id){
        window.location.href = '/admin/resi/batal/'+id;
    }

    function changeStatus(){
        var stat = $("#status").val();
        if(stat == "1"){
            var permitted = true;
            @if($resi->kantor_sekarang_id != null)
                permitted = false;
            @endif
            
            if(!permitted){
                triggerNotification("Resi tidak boleh dinonaktifkan.");
                $("#status").val("0");
            }
        }   
    }

    function triggerNotification(text){
        $("#modalContent").html(text);
        $("#triggerModal").click();
    }
    
</script>
@endsection
