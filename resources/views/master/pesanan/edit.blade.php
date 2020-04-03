@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-note2 icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    Edit Kota
@endsection

@section('subtitle')
    Page ini adalah untuk mengedit Kota
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
                <form novalidate class="needs-validation" method="post" action="/admin/kota/update/{{$pesanan->id}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">ID resi</label>
                                <select name="resi_id" class="form-control">
                                    @foreach ($listResiID as $i)
                                        @if ($i->id == $pesanan->id)
                                            <option selected class="form-control" value="{{$i->id}}">{{$i->id}}</option>
                                        @else
                                            <option class="form-control" value="{{$i->id}}">{{$i->id}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">ID kurir</label>
                                <select name="kurir_customer_id" class="form-control">
                                    @foreach ($listKurID as $i)
                                        @if ($i->id == $pesanan->kurir_customer_id)
                                            <option selected class="form-control" value="{{$i->id}}">{{$i->id}} - {{$i->nama}}</option>
                                        @else
                                            <option class="form-control" value="{{$i->id}}">{{$i->id}} - {{$i->nama}}</option>
                                        @endif
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
                                placeholder="BERAT BARANG" type="text" class="form-control" value={{$pesanan->berat_barang}} required>
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
                                placeholder="ALAMAT ASAL" type="text" class="form-control" value={{$pesanan->alamat_asal}} required>
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
                                placeholder="ALAMAT TUJUAN" type="text" class="form-control" value={{$pesanan->alamat_tujuan}} required>
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
                                placeholder="NAMA PENGIRIM" type="text" class="form-control" value={{$pesanan->nama_pengirim}} required>
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
                                placeholder="NAMA PENERIMA" type="text" class="form-control" value={{$pesanan->nama_penerima}} required>
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
                                placeholder="LEBAR BARANG" type="text" class="form-control" value={{$pesanan->lebar}} required>
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
                                placeholder="PANJANG BARANG" type="text" class="form-control" value={{$pesanan->panjang}} required>
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
                                placeholder="TINGGI BARANG" type="text" class="form-control" value={{$pesanan->tinggi}} required>
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
                                placeholder="NO TELPON PENGIRIM" type="text" class="form-control" value={{$pesanan->no_telp_pengirim}} required>
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
                                placeholder="NO TELPON PENERIMA" type="text" class="form-control" value={{$pesanan->no_telp_penerima}} required>
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
                                <input style="text-transform:uppercase" name="keterangan" id=""
                                placeholder="KETERANGAN" type="text" value={{$pesanan->keterangan}} class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <label class="">Fragile</label>
                                @if ($pesanan->is_fragile)
                                    <option selected class="form-control" value="1">FRAGILE</option>
                                    <option class="form-control" value="0">NOT FRAGILE</option>
                                @else
                                    <option class="form-control" value="1">FRAGILE</option>
                                    <option selected class="form-control" value="0">NOT FRAGILE</option>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <label class="">Email Pengirim</label>
                                <input style="text-transform:uppercase" name="email_pengirim" id=""
                                placeholder="EMAIL PENGIRIM" type="text" class="form-control" value={{$pesanan->email_pengirim}} required>
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
                                placeholder="EMAIL PENERIMA" type="text" class="form-control" value={{$pesanan->email_penerima}} required>
                                <div class="invalid-feedback">
                                    Mohon inputkan email penerima yang valid.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <label class="">Active</label>
                                @if ($pesanan->is_deleted)
                                    <option selected class="form-control" value="1">ACTIVE</option>
                                    <option class="form-control" value="0">NOT ACTIVE</option>
                                @else
                                    <option class="form-control" value="1">ACTIVE</option>
                                    <option selected class="form-control" value="0">NOT ACTIVE</option>
                                @endif
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
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
     $(document).ready(function () {
        $("#upperlist-pesanan").addClass("mm-active");
        $("#btn-pesanan").attr("aria-expanded", "true");
        $("#list-pesanan").attr("class", "mm-collapse mm-show");
        $("#header-pesanan").attr("class", "mm-active");
    })
</script>
@endsection
