@extends('layouts.kurir')

@section('styles')
    <link href="{{asset('DataTables/datatables.min.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="site-section bg-light">
    <div class="container">
        <div class="row">
        <div class="col-12 text-center mb-5" data-aos="fade-up" data-aos-delay="">
            <div class="block-heading-1" data-aos="fade-up" data-aos-delay="">
                <h2>Pengiriman Sekarang</h2>
                @if (!$pengiriman)
                    <p>Anda sekarang tidak sedang menangani pengiriman apa-apa.</p>
                @else
                    <p>Dibawah merupakan data pengiriman anda.</p>
                @endif
            </div>
        </div>
        </div>
        @if ($pengiriman)
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
                <div class="row mb-2">
                    <table class="table table-hover table-striped dataTable dtr-inline">
                        <thead>
                            <th>ID Resi</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No. Telp</th>
                            <th>Berat</th>
                            <th>Waktu Selesai</th>
                        </thead>
                        <tbody>
                        @if ($pengiriman->resis)
                        @foreach ($pengiriman->resis as $i)
                        <tr>
                            <td>{{$i->id}}</td>
                            @if ($pengiriman->menuju_penerima)
                            <td>{{$i->pesanan->nama_penerima}}</td>
                            <td>{{$i->pesanan->alamat_tujuan}}</td>
                            <td>{{$i->pesanan->no_telp_penerima}}</td>
                            @else
                            <td>{{$i->pesanan->nama_pengirim}}</td>
                            <td>{{$i->pesanan->alamat_asal}}</td>
                            <td>{{$i->pesanan->no_telp_pengirim}}</td>
                            @endif
                        <td>{{$i->pesanan->berat_barang}}</td>
                        <td>
                            @if ($i->d_pengiriman_customer->telah_sampai)
                                {{$i->d_pengiriman_customer->waktu_sampai_cust}}
                            @else
                                <span class="badge badge-warning">Belum Selesai</span>
                            @endif
                            
                            
                        </td>
                        </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="row mt-5 mb-5 text-primary">
                    <h4>Input ID Pesanan / Scan Barcode</h4>
                </div>
                <div class="form-group row mb-2">
                    <label for="">ID Resi</label>
                    <input type="text" class="form-control" id="input_id_resi">
                </div>
                <div class="form-group row mb-3">
                    <label for="">OTP</label>
                    <input type="text" class="form-control" id="input_otp">
                </div>
                <div class="form-group row mb-2 mt-2">
                    <button type="submit" onclick="cariResi()" class="col-md-12 btn btn-primary">Cari</button>
                </div>
            </div>
        </div>
        @endif

        <div class="row justify-content-center" id="formResi">
            
        </div>
        
    </div>
</div>
@endsection

@section('scripts')

<script>
    var cariResi = function () {

        var pengiriman = "{{$pengiriman->id}}";
        console.log(pengiriman)
        var id = $('#input_id_resi').val();
        var pass = $('#input_otp').val();

        //console.log(id)
        //console.log(pass)

        $.ajax({
            method : "POST",
            url : '/kurir/input',
            datatype : "json",
            data : { 
                id_pengiriman: pengiriman,
                id_pesanan: id, 
                pass: pass, 
                _token : "{{ csrf_token() }}" 
            },
            success: function(result){
                result = JSON.parse(result)
                $('formResi').html(result)
            },
            error: function(){
                console.log('error');
            }
        });
    }
</script>
@endsection