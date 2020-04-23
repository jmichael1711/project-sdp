<h1 class="display-5">HASIL PENCARIAN TRACKING</h1><br>

<div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
    <div class="main-card mb-3 card">
        <div class="card-body">
            <div class="form-row">
                <div class="col-md-5"><h5>Detail Resi</h5><br>
                    <div class="position-relative form-group">
                        <label class="">ID</label>
                        <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                        this.setSelectionRange(p, p);" style="text-transform:uppercase" name="id" id=""
                        placeholder="ID" type="text" class="form-control" value="{{$resi->id}}" readonly>
                    </div>
                </div>
            </div>
            <div class="collapse" id="collapseEdit">
                <div class="form-row">
                    <div class="col-md-5">
                        <div class="position-relative form-group">
                            <label class="">Nama Pengirim</label>
                            <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                            this.setSelectionRange(p, p);" style="text-transform:uppercase" name="nama_pengirim"
                            placeholder="NAMA PENGIRIM" type="text" class="form-control" value="{{$resi->nama_pengirim}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="position-relative form-group">
                            <label class="">Nama Penerima</label>
                            <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                            this.setSelectionRange(p, p);" style="text-transform:uppercase" name="nama_penerima"
                            placeholder="NAMA PENERIMA" type="text" class="form-control" value="{{$resi->nama_penerima}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="position-relative form-group">
                            <label class="">Nomor Telepon Pengirim</label>
                            <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                            this.setSelectionRange(p, p);" style="text-transform:uppercase" name="no_telp_pengirim" 
                            placeholder="NOMOR TELEPON PENGIRIM" type="text" class="form-control" value="{{$resi->no_telp_pengirim}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="position-relative form-group">
                            <label class="">Nomor Telepon Penerima</label>
                            <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                            this.setSelectionRange(p, p);" style="text-transform:uppercase" name="no_telp_penerima" 
                            placeholder="NOMOR TELEPON PENERIMA" type="text" class="form-control" value="{{$resi->no_telp_penerima}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="position-relative form-group">
                            <label class="">Email Pengirim</label>
                            <input oninput="let p = this.selectionStart; 
                            this.setSelectionRange(p, p);" name="email_pengirim" 
                            placeholder="EMAIL PENGIRIM" type="email" class="form-control" value="{{$resi->email_pengirim}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="position-relative form-group">
                            <label class="">Email Penerima</label>
                            <input oninput="let p = this.selectionStart;
                            this.setSelectionRange(p, p);"  name="email_penerima" 
                            placeholder="EMAIL PENERIMA" type="email" class="form-control" value="{{$resi->email_penerima}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="position-relative form-group">
                            <label class="">Kota Pengirim</label>
                            <input oninput="let p = this.selectionStart;
                            this.setSelectionRange(p, p);"  name="email_penerima" 
                            placeholder="EMAIL PENERIMA" type="email" class="form-control" value="{{$resi->kota_asal}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="position-relative form-group">
                            <label class="">Kota Penerima</label>
                            <input oninput="let p = this.selectionStart;
                            this.setSelectionRange(p, p);"  name="email_penerima" 
                            placeholder="EMAIL PENERIMA" type="email" class="form-control" value="{{$resi->kota_tujuan}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="position-relative form-group">
                            <label class="">Alamat Pengirim</label>
                            <textarea style="resize: none;" rows="5" oninput="let p = this.selectionStart; 
                            this.setSelectionRange(p, p);" name="alamat_asal"
                            placeholder="ALAMAT PENGIRIM" type="text" class="form-control" disabled>{{$resi->alamat_asal}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="position-relative form-group">
                            <label class="">Alamat Penerima</label>
                            <textarea style="resize: none;" rows="5" oninput="let p = this.selectionStart;
                            this.setSelectionRange(p, p);" name="alamat_tujuan"
                            placeholder="ALAMAT PENERIMA" type="text" class="form-control" disabled>{{$resi->alamat_tujuan}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="position-relative form-group">
                            <label class="">Kodepos Pengirim</label>
                            <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                            this.setSelectionRange(p, p);" style="text-transform:uppercase" name="kode_pos_pengirim" 
                            placeholder="KODEPOS PENGIRIM" type="number" class="form-control" value="{{$resi->kode_pos_pengirim}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="position-relative form-group">
                            <label class="">Kodepos Penerima</label>
                            <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                            this.setSelectionRange(p, p);" style="text-transform:uppercase" name="kode_pos_penerima" 
                            placeholder="KODEPOS PENERIMA" type="number" class="form-control" value="{{$resi->kode_pos_penerima}}" disabled>
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
                            placeholder="KETERANGAN" type="text" class="form-control" disabled>{{$resi->keterangan}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-7">
                        <div class="position-relative form-group">
                            <label class="">Dimensi Barang (CentiMeter)</label>
                            <div class="form-inline">
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="panjang" 
                                placeholder="PANJANG (CM)" step="1" type="number" max="999.999999" min="0.000000" class="form-control mr-2" value="{{$resi->panjang}}" disabled>X
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="lebar" 
                                placeholder="LEBAR (CM)" step="1" type="number" max="999.999999" min="0.000000" class="form-control ml-2 mr-2" value="{{$resi->lebar}}" disabled>X
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="tinggi" 
                                placeholder="TINGGI (CM)" step="1" type="number" max="999.999999" min="0.000000" class="form-control ml-2" value="{{$resi->tinggi}}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-5">
                        <div class="position-relative form-group">
                            <label class="">Berat Barang (KiloGram)</label>
                            <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                            this.setSelectionRange(p, p);" style="text-transform:uppercase" name="berat_barang" id="berat_barang"
                            placeholder="BERAT (KG)" step="0.001" type="number" max="20" min="0.001" class="form-control" value="{{$resi->berat_barang}}" onchange="hitungHarga()" disabled>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-5">
                        <div class="position-relative form-group">
                            <label class="">Fragility Barang</label>
                            <select id="is_fragile" name="is_fragile" class="form-control" disabled>
                                @if($resi->is_fragile)
                                    <option selected class="form-control" value="1">FRAGILE</option>
                                    <option class="form-control" value="0">FINE</option>
                                @else
                                    <option selected class="form-control" value="0">FINE</option>
                                    <option class="form-control" value="1">FRAGILE</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-5">
                        <div class="position-relative form-group">
                            <label class="">Harga</label>
                            <input oninput="let p = this.selectionStart; 
                            this.setSelectionRange(p, p);" style="text-transform:uppercase" name="harga" id="harga_barang"
                            placeholder="Rp 0.00" type="text" class="form-control" disabled value="{{$resi->harga}}">
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <button type="button" data-toggle="collapse" href="#collapseEdit" class="btn btn-secondary">Detail Resi</button>
        </div>
    </div>
</div>

<div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
    <div class="main-card mb-3 card">
        <div class="card-body"><h5>History Resi</h5><br>
            <table style="min-width: 100%" class="table table-hover table-striped dataTable dtr-inline" id="tableSejarah">
                <thead>
                    <tr>
                        <th>Keterangan</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @if($allSejarah)
                        @foreach ($allSejarah as $i)
                            <tr>
                                <td>{{$i->keterangan}}</td>
                                <td>{{$i->waktu}}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
