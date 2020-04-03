@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-note2 icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    Create Pesanan
@endsection

@section('subtitle')
Page ini adalah untuk menambahkan Pesanan
@endsection

@section('content')
    <div class="tab-content">
    @if (Session::has('success-pesanan'))
        <ul class="list-group mb-2">
            <li class="list-group-item-success list-group-item">{{Session::get('success-pesanan')}}</li>
        </ul>
        @php
            Session::forget('success-pesanan');
        @endphp
    @endif
    @if (Session::has('failed-pesanan'))
        <ul class="list-group mb-2">
            <li class="list-group-item-danger list-group-item">{{Session::get('failed-pesanan')}}</li>
        </ul>
        @php
            Session::forget('failed-pesanan');
        @endphp
    @endif
    <form novalidate class="needs-validation" method="post" action="/admin/pesanan/store" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-row">
            <div class="col-md-4">
                <div class="position-relative form-group">
                    <label class="">ID kurir</label>
                    <select name="kurir_customer_id" class="form-control">
                        @foreach ($listKurID as $i)
                            <option class="form-control" value="{{$i->id}}">{{$i->id}} - {{$i->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-3">
                <div class="position-relative form-group">
                    <label class="">Berat Barang</label>
                    <input style="text-transform:uppercase" name="berat_barang" id=""
                    placeholder="BERAT BARANG" type="text" class="form-control" required>
                    <div class="invalid-feedback">
                        Mohon inputkan Berat Barang yang valid.
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-3">
                <div class="position-relative form-group">
                    <label class="">Alamat Asal</label>
                    <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="alamat_asal" id=""
                    placeholder="ALAMAT ASAL" type="text" class="form-control" required>
                    <div class="invalid-feedback">
                        Mohon inputkan Alamat Asal yang valid.
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-3">
                <div class="position-relative form-group">
                    <label class="">Alamat Tujuan</label>
                    <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="alamat_tujuan" id=""
                    placeholder="ALAMAT TUJUAN" type="text" class="form-control" required>
                    <div class="invalid-feedback">
                        Mohon inputkan Alamat Tujuan yang valid.
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4">
                <div class="position-relative form-group">
                    <label class="">Kota Asal</label>
                    <select name="kota_asal" class="form-control">
                        @foreach ($listKota as $i)
                            <option class="form-control" value="{{$i->nama}}">{{$i->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4">
                <div class="position-relative form-group">
                    <label class="">Kota Tujuan</label>
                    <select name="kota_tujuan" class="form-control">
                        @foreach ($listKota as $i)
                            <option class="form-control" value="{{$i->nama}}">{{$i->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-3">
                <div class="position-relative form-group">
                    <label class="">Nama Pengirim</label>
                    <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="nama_pengirim" id=""
                    placeholder="NAMA PENGIRIM" type="text" class="form-control" required>
                    <div class="invalid-feedback">
                        Mohon inputkan nama pengirim yang valid.
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-3">
                <div class="position-relative form-group">
                    <label class="">Nama Penerima</label>
                    <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="nama_penerima" id=""
                    placeholder="NAMA PENERIMA" type="text" class="form-control" required>
                    <div class="invalid-feedback">
                        Mohon inputkan nama penerima yang valid.
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-3">
                <div class="position-relative form-group">
                    <label class="">Lebar</label>
                    <input style="text-transform:uppercase" name="lebar" id=""
                    placeholder="LEBAR BARANG" type="text" class="form-control" required>
                    <div class="invalid-feedback">
                        Mohon inputkan lebar barang yang valid.
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-3">
                <div class="position-relative form-group">
                    <label class="">Panjang</label>
                    <input style="text-transform:uppercase" name="panjang" id=""
                    placeholder="PANJANG BARANG" type="text" class="form-control" required>
                    <div class="invalid-feedback">
                        Mohon inputkan panjang barang yang valid.
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-3">
                <div class="position-relative form-group">
                    <label class="">Tinggi</label>
                    <input style="text-transform:uppercase" name="tinggi" id=""
                    placeholder="TINGGI BARANG" type="text" class="form-control" required>
                    <div class="invalid-feedback">
                        Mohon inputkan tinggi barang yang valid.
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-3">
                <div class="position-relative form-group">
                    <label class="">No Telpon Pengirim</label>
                    <input style="text-transform:uppercase" name="no_telp_pengirim" id=""
                    placeholder="NO TELPON PENGIRIM" type="text" class="form-control" required>
                    <div class="invalid-feedback">
                        Mohon inputkan nomor telpon pengirim yang valid.
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-3">
                <div class="position-relative form-group">
                    <label class="">No Telpon Penerima</label>
                    <input style="text-transform:uppercase" name="no_telp_penerima" id=""
                    placeholder="NO TELPON PENERIMA" type="text" class="form-control" required>
                    <div class="invalid-feedback">
                        Mohon inputkan nomor telpon penerima yang valid.
                    </div>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-3">
                <div class="position-relative form-group">
                    <label class="">Keterangan</label>
                    <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="keterangan" id=""
                    placeholder="KETERANGAN" type="text" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-3">
                <div class="position-relative form-group">
                    <label class="">Fragile</label>
                    <select name="is_fragile" class="form-control">
                        <option value="0" class="form-control">NOT FRAGILE</option>
                        <option value="1" class="form-control">FRAGILE</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-3">
                <div class="position-relative form-group">
                    <label class="">Email Pengirim</label>
                    <input style="text-transform:uppercase" name="email_pengirim" id=""
                    placeholder="EMAIL PENGIRIM" type="text" class="form-control" required>
                    <div class="invalid-feedback">
                        Mohon inputkan email pengirim yang valid.
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-3">
                <div class="position-relative form-group">
                    <label class="">Email Penerima</label>
                    <input style="text-transform:uppercase" name="email_penerima" id=""
                    placeholder="EMAIL PENERIMA" type="text" class="form-control" required>
                    <div class="invalid-feedback">
                        Mohon inputkan email penerima yang valid.
                    </div>
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
    </div>
    </form>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $("#upperlist-pesanan").addClass("mm-active");
        $("#btn-pesanan").attr("aria-expanded", "true");
        $("#list-pesanan").attr("class", "mm-collapse mm-show");
        $("#header-tambah-pesanan").attr("class", "mm-active");
    })
</script>
@endsection
