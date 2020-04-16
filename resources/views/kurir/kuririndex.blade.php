@extends('layouts.kurir')

@section('styles')
    <link href="{{asset('DataTables/datatables.min.css')}}" rel="stylesheet">
@endsection

@section('links')
<li><a href="/kurir" class="nav-link active">Home</a></li>
<li><a href="/kurir/history" class="nav-link">History</a></li>
<li><a href="/logout" class="nav-link">Logout</a></li>
@endsection

@section('content')
<button id="triggerModal" type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target="#exampleModal" style="display: none">
    Trigger Modal
</button>
<div class="site-section bg-light">
    <div class="container">
        <div class="row">
        <div class="col-12 text-center mb-5" data-aos="fade-up" data-aos-delay="">
            <div class="block-heading-1" data-aos="fade-up" data-aos-delay="">
                <h2 class="mb-5">Pengiriman Sekarang</h2>
                @if (!$pengiriman)
                    <p>Anda sekarang tidak sedang menangani pengiriman apa-apa.</p>
                @elseif ($pengiriman && $pengiriman->telahSampaiSemua())
                    <p>Pengiriman anda sudah selesai.</p>
                @else
                    <p>Dibawah merupakan data pengiriman anda.</p>
                @endif
            </div>
        </div>
        </div>
        @if ($pengiriman && !$pengiriman->telahSampaiSemua())
        <div class="row justify-content-center">
            <div class="col-lg-8 mb-5" data-aos="fade-up" data-aos-delay="100">
                <div class="row mt-3 mb-5 text-primary">
                    <h4>Data Pengiriman</h4>
                </div>
                <div class="row mb-2">
                    <div style="font-size: 20px;">
                        Pengiriman Terhadap: 
                        @if ($pengiriman->menuju_penerima)
                        <span class="badge badge-secondary">  Penerima </span> 
                        @else
                        <span class="badge badge-primary">  Pengirim </span> 
                        @endif
                    </div>
                </div>
                <div class="row mb-2">
                    <div style="font-size: 20px;">
                        Total Muatan: 
                        <span class="badge badge-primary"> {{$pengiriman->total_muatan}} kg </span>
                    </div>
                </div>
                <div class="row mb-2">
                    <div style="font-size: 20px;">
                        Waktu Berangkat: 
                        @if ($pengiriman->waktu_berangkat)
                        <span class="badge badge-primary">{{$pengiriman->waktu_berangkat}}</span>
                        @else
                        <span class="badge badge-warning">{{'Belum dimulai'}}</span>
                        @endif
                    </div>
                </div>

                <div class="row mt-5 mb-5 text-primary">
                    <h4>Daftar Pengiriman</h4>
                </div>
                <div class="row mb-5">
                    @if ($pengiriman->resis && count($pengiriman->resis) > 0)
                    <table class="table table-hover table-striped dataTable dtr-inline">
                        <thead>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No. Telp</th>
                            <th>Kode Pos</th>
                            <th>Berat (kg)</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                        
                        @foreach ($pengiriman->resisOrderedBySampai as $i)
                        <tr>
                            @if ($pengiriman->menuju_penerima)
                            <td>{{$i->nama_penerima}}</td>
                            <td>{{$i->alamat_tujuan}}</td>
                            <td>{{$i->no_telp_penerima}}</td>
                            <td>{{$i->kode_pos_penerima}}</td>
                            @else
                            <td>{{$i->nama_pengirim}}</td>
                            <td>{{$i->alamat_asal}}</td>
                            <td>{{$i->no_telp_pengirim}}</td>
                            <td>{{$i->kode_pos_pengirim}}</td>
                            @endif
                        <td>{{$i->berat_barang}}</td>
                        <td>Rp. {{$i->harga}}</td>
                        <td>
                            @if ($i->d_pengiriman_customer->telah_sampai)
                                @if ($i->d_pengiriman_customer->is_canceled)
                                    <span class="badge badge-danger text-white">Canceled</span>
                                @else
                                    <span class="badge badge-success text-white">Selesai</span>
                                @endif
                            
                            @else
                            <span class="badge badge-warning">Belum Selesai</span>
                            @endif
                        </td>
                        <td>
                            <button
                                @if ($i->d_pengiriman_customer->telah_sampai || !$pengiriman->waktu_berangkat)
                                    {{'disabled'}}
                                @endif
                            class="btn btn-danger" onclick="cancel('{{$i->id}}', '{{$pengiriman->id}}')">
                                Cancel
                            </button>
                        </td>
                        </tr>
                        @endforeach
                        
                        </tbody>
                    </table>
                    @else
                    <div>
                        Tidak ada data pengiriman. Mohon lapor ke kantor.
                    </div>
                    @endif
                </div>
                @if ($pengiriman->waktu_berangkat)
                <div class="row mt-5 mb-5 text-primary">
                    <h4>Input ID Resi / Scan Barcode</h4>
                </div>
                <div class="form-group row mb-2">
                    <label for="">ID Resi</label>
                    <input type="text" class="form-control" id="input_id_resi">
                </div>
                <div class="form-group row mb-3">
                    <label for="">OTP</label>
                    <input type="text" class="form-control" id="input_otp">
                </div>
                <div class="form-group row mb-5 mt-2">
                    <div class="col-md-6 pl-0">
                        <button type="submit" onclick="cariResi()" class="col-md-12 btn btn-primary">Submit</button>
                    </div>
                    <div class="col-md-6 pr-0">
                        <button type="button" data-toggle="modal" data-target="#exampleModalLong" id="scan" onclick="cariResiPakaiBarcode()"  class="col-md-12 btn btn-primary">Scan Barcode</button>
                    </div>
                    
                </div>
                

                <div class="mt-2" id="formResi">
            
                </div>
                
                @else
                <div class="form-group row mb-2 mt-2">
                    <form action="/kurir/setwaktuberangkat" method="post" id="formWaktuBerangkat">
                        @csrf
                        <input type="hidden" name="id" value="{{$pengiriman->id}}">
                    </form>
                    <button 
                    @if (!($pengiriman->resis && count($pengiriman->resis) > 0))
                        {{'disabled'}}
                    @endif
                    type="submit" onclick="submitFormBerangkat()" class="col-md-12 btn btn-primary">Berangkat</button>
                </div>
                @endif
                
            </div>
        </div>
        @endif
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="cancelModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row p-3">
                Cancel Pengiriman?
            </div>
            <div class="row p-3">
                <p>
                    Hanya lakukan cancel pengiriman pada saat tidak ada orang yang dapat menerima di alamat yang
                    diberikan. Pastikan anda sudah melakukan kontak pada customer terlebih dahulu sebelum melakukan
                    cancel. Sekali cancel dilakukan, tidak bisa di-batalkan. 
                </p>
            </div>
        </div>
        <div class="modal-footer">
            <form action="/kurir/cancelpengiriman" method="post">
                @csrf
                <input type="hidden" id="cancelResiId" name="resi_id" value="">
                <input type="hidden" id="cancelPengirimanId" name="pengiriman_id" value="">
                <input type="submit" class="btn btn-danger " value="Cancel">
                <button type="button" class="btn btn-success text-white" data-dismiss="modal">Batal Cancel</button>
            </form>
           
        </div>
        </div>
    </div>
</div>
@endsection

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

@section('scripts')
<script src="{{asset('js/instascan.min.js')}}"></script>
<script>
    $(document).ready(function(){
        scanner.addListener('scan', function(content) {
            $("#input_id_resi").val(content);
            $("#close").click();
            cariResi();
        });
    });
    var cariResi = function () {

        var pengiriman = "{{$pengiriman->id ?? ''}}";
        var id = $('#input_id_resi').val();
        var pass = $('#input_otp').val();

        //console.log(id)
        //console.log(pass)
        $('#myModal').remove();

        $.ajax({
            method : "POST",
            url : '/kurir/input',
            datatype : "json",
            data : { 
                id_pengiriman: pengiriman,
                id_resi: id, 
                pass: pass, 
                _token : "{{ csrf_token() }}" 
            },
            success: function(result){
                $('#formResi').html(result);
                $('body').append($('#myModal'));
                $('#myModal').modal('show');
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

    function cariResiPakaiBarcode(){
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

    var submitFormBerangkat = function () {
        $('#formWaktuBerangkat').submit();
    }

    var cancel = function (resi_id, pengiriman_id) {
        $('#cancelResiId').attr('value', resi_id);
        $('#cancelPengirimanId').attr('value', pengiriman_id);
        $('#cancelModal').modal('show');
    }

    function hitungHarga(){
        var berat = $("#berat_barang").val();
        var id = $("#resi_id").val();
        if(berat > 0 && berat <= 20){
            $.ajax({
                method : "POST",
                url : "/kurir/countCost",
                datatype : "json",
                data : { id: id,berat : berat, _token : "{{ csrf_token() }}" },
                success: function(result){
                    $("#harga_barang").html(result);
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

</script>
@endsection