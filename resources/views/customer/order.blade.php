@extends('layouts.customer')

@section('content')
<div class="site-section bg-light">
    <div class="container">
        <div class="row">
        <div class="col-12 text-center mb-5" data-aos="fade-up" data-aos-delay="">
            <div class="block-heading-1">
            <h2>Pesan</h2>
            </div>
        </div>
        </div>
        <div class="row justify-content-center">
        <div class="col-lg-8 mb-5" data-aos="fade-up" data-aos-delay="100">
            <form action="/inputpesanan" method="post">
                @csrf
                <div class="form-group row">
                <div class="col-md-12">
                    <h4>Data Pengirim</h4>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="">Nama Pengirim</label>
                    <input type="text" class="form-control" name="nama_pengirim" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="">Alamat Pengirim</label>
                    <input type="text" class="form-control" name="alamat_asal" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="">Kode Pos Pengirim</label>
                    <input type="text" class="form-control" name="kode_pos_pengirim" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="">Kota Asal</label>
                    <select name="kota_asal" class="form-control" required>
                        @foreach ($listKota as $i)
                            <option value="{{$i->nama}}">{{$i->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="">Email Pengirim</label>
                <input type="email" class="form-control" name="email_pengirim" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="">No Telp Pengirim</label>
                <input type="text" class="form-control" name="no_telp_pengirim" required>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-12">
                    <h4>Data Penerima</h4>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="">Nama Penerima</label>
                    <input type="text" class="form-control" name="nama_penerima" required>
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="">Alamat Tujuan</label>
                    <input type="text" class="form-control" name="alamat_tujuan" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="">Kode Pos Penerima</label>
                    <input type="text" class="form-control" name="kode_pos_penerima" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="">Kota Tujuan</label>
                    <select name="kota_tujuan" class="form-control" required>
                        @foreach ($listKota as $i)
                            <option value="{{$i->nama}}">{{$i->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                <label for="">Email Penerima</label>
                <input type="email" class="form-control" name="email_penerima" required >
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                <label for="">No Telp Penerima</label>
                <input type="text" class="form-control" name="no_telp_penerima" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <h4>Data Barang</h4>
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="">Panjang (cm)</label>
                    <input value=0 type="number" max=999 min=1 class="form-control" name="panjang" required>
                </div>
                <div class="col-md-4">
                    <label for="">Lebar (cm)</label>
                    <input value=0 type="number" max=999 min=1 class="form-control" name="lebar" required>
                </div>
                <div class="col-md-4">
                    <label for="">Tinggi (cm)</label>
                    <input value=0 type="number" max=999 min=1 class="form-control" name="tinggi" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="">Berat Barang (kg)</label>
                    <input type="number" step=0.01 value=0 min=0.00 max=99.00 class="form-control" name="berat_barang" placeholder="Berat Barang" required>
                </div>
                <div class="col-md-6">
                    <label for="">Kondisi Barang</label>
                    <select name="is_fragile" class="form-control" required>
                        <option value="1">MUDAH PECAH</option>
                        <option value="0">BIASA</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-md-12 mr-auto">
                <input type="submit" class="btn btn-block btn-primary text-white py-3 px-5" value="Buat Pesanan">
                </div>
            </div>
            </form>
        </div>
        
        </div>
    </div>
</div>
@endsection