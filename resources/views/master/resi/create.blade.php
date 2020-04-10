@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-note2 icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
TAMBAH DATA RESI
@endsection

@section('subtitle')
Halaman ini untuk menambah data resi.
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
    <form novalidate class="needs-validation" method="post" action="/admin/resi/store" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-row">
            <div class="col-md-5">
                <div class="position-relative form-group">
                    <label class="">ID</label>
                    <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="id" id=""
                    placeholder="ID" type="text" class="form-control" value="{{$nextId}}" readonly>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-5">
                <div class="position-relative form-group">
                    <label class="">Keterangan</label>
                    <textarea style="resize: none;" rows="5" oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="keterangan"
                    placeholder="KETERANGAN" type="text" class="form-control" required></textarea>
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
                        placeholder="PANJANG (CM)" step="0.000001" type="number" max="999.999999" min="0.000000" class="form-control mr-2">X
                        <input required oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                        this.setSelectionRange(p, p);" style="text-transform:uppercase" name="lebar" 
                        placeholder="LEBAR (CM)" step="0.000001" type="number" max="999.999999" min="0.000000" class="form-control ml-2 mr-2">X
                        <input required oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                        this.setSelectionRange(p, p);" style="text-transform:uppercase" name="tinggi" 
                        placeholder="TINGGI (CM)" step="0.000001" type="number" max="999.999999" min="0.000000" class="form-control ml-2">
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
                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="berat_barang" 
                    placeholder="BERAT (KG)" step="0.000001" type="number" min="0.000000" class="form-control">
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
                    <select id="is_fragile" name="is_fragile" class="form-control" required>
                        <option class="form-control" value="1">FRAGILE</option>
                        <option class="form-control" value="0">FINE</option>
                    </select>
                    <div class="invalid-feedback">
                        Mohon pilih fragility barang yang valid.
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="form-row">
            <div class="col-md-5">
                <div class="position-relative form-group">
                    <label class="">Nama Pengirim</label>
                    <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="nama_pengirim"
                    placeholder="NAMA PENGIRIM" type="text" class="form-control" required>
                    <div class="invalid-feedback">Mohon input nama pengirim yang valid.</div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="position-relative form-group">
                    <label class="">Nama Penerima</label>
                    <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="nama_penerima"
                    placeholder="NAMA PENERIMA" type="text" class="form-control" required>
                    <div class="invalid-feedback">Mohon input nama penerima yang valid.</div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="position-relative form-group">
                    <label class="">Nomor Telepon Pengirim</label>
                    <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="no_telp_pengirim" 
                    placeholder="NOMOR TELEPON PENGIRIM" type="text" class="form-control" required>
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
                    placeholder="NOMOR TELEPON PENERIMA" type="text" class="form-control" required>
                    <div class="invalid-feedback">
                        Mohon input nomor telepon penerima yang valid.
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="position-relative form-group">
                    <label class="">Email Pengirim</label>
                    <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="email_pengirim" 
                    placeholder="EMAIL PENGIRIM" type="text" class="form-control" required>
                    <div class="invalid-feedback">
                        Mohon input email pengirim yang valid.
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="position-relative form-group">
                    <label class="">Email Penerima</label>
                    <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="email_penerima" 
                    placeholder="EMAIL penerima" type="text" class="form-control" required>
                    <div class="invalid-feedback">
                        Mohon input email pengirim yang valid.
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="position-relative form-group">
                    <label class="">Kota Pengirim</label>
                    <select id="kota_asal" name="kota_asal" class="form-control" required>
                        @foreach ($allKota as $kota)
                            <option class="form-control" value="{{$kota->nama}}">{{$kota->nama}}</option>
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
                    <select id="kota_tujuan" name="kota_tujuan" class="form-control" required>
                        @foreach ($allKota as $kota)
                            <option class="form-control" value="{{$kota->nama}}">{{$kota->nama}}</option>
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
                    <textarea style="resize: none;" rows="5" oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="alamat_asal"
                    placeholder="ALAMAT PENGIRIM" type="text" class="form-control" required></textarea>
                    <div class="invalid-feedback">
                        Mohon input alamat pengirim yang valid.
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="position-relative form-group">
                    <label class="">Alamat Penerima</label>
                    <textarea style="resize: none;" rows="5" oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="alamat_tujuan"
                    placeholder="ALAMAT penerima" type="text" class="form-control" required></textarea>
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
                    placeholder="KODEPOS PENGIRIM" type="text" class="form-control" required>
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
                    placeholder="KODEPOS PENERIMA" type="text" class="form-control" required>
                    <div class="invalid-feedback">
                        Mohon input kodepos penerima yang valid.
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
        $("#upperlist-resi").addClass("mm-active");
        $("#btn-resi").attr("aria-expanded", "true");
        $("#list-resi").attr("class", "mm-collapse mm-show");
        $("#header-tambah-resi").attr("class", "mm-active");
    })
</script>
@endsection