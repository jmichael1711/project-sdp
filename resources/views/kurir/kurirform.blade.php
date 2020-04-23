@if ($menuju_penerima)
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="myModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            Selesaikan Pesanan?
        </div>
        <div class="modal-footer">
            <form action="/kurir/selesai" method="post">
                @csrf
                <input type="hidden" name="resi_id" value="{{$pesanan->id}}">
                <input type="hidden" name="pengiriman_id" value="{{$pengiriman_id}}">
                <input type="submit" class="btn btn-success text-white" value="Ya">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </form>
        </div>
        </div>
    </div>
</div>
@else
<form action="/kurir/updatepesanan" method="post">
    <div class="row mt-5 mb-5 text-primary">
        <h4>Data Input Pesanan</h4>
    </div>
    @csrf
    <div class="form-group row mb-3">
        <div class="col-md-4 p-0">
            <label for="">Panjang (cm)</label>
            <input value={{$pesanan->panjang}} type="number" max=999 min=1 class="form-control" name="panjang" required>
        </div>
        <div class="col-md-4 px-1">
            <label for="">Lebar (cm)</label>
            <input value={{$pesanan->lebar}} type="number" max=999 min=1 class="form-control" name="lebar" required>
        </div>
        <div class="col-md-4 p-0">
            <label for="">Tinggi (cm)</label>
            <input value={{$pesanan->tinggi}} type="number" max=999 min=1 class="form-control" name="tinggi" required>
        </div>
    </div>
    <div class="form-group row mb-3">
        <div class="col-md-6 p-0">
            <label for="">Berat Barang (kg)</label>
            <input type="number" step=0.001 value='{{$pesanan->berat_barang}}'min=0.001 max=20.00 class="form-control" name="berat_barang" placeholder="Berat Barang" required oninput="hitungHarga()" id="berat_barang">
        </div>
        <div class="col-md-6 pl-1">
            <label for="">Kondisi Barang</label>
            <select name="is_fragile" class="form-control" required>
                @if ($pesanan->is_fragile)
                <option value="1" selected>MUDAH PECAH</option>
                <option value="0">BIASA</option>
                @else
                <option value="1">MUDAH PECAH</option>
                <option value="0" selected>BIASA</option>
                @endif
            </select>
        </div>
    </div>
    <input type="hidden" name="resi_id" id="resi_id" value="{{$pesanan->id}}">
    <input type="hidden" name="pengiriman_id" value="{{$pengiriman_id}}">
    <div class="row my-4" style="font-size: 24px;">
    Perlu dibayar : Rp &nbsp<b id="harga_barang"> {{$pesanan->harga}}</b>
    </div>
    <div class="row my-2">
        <b>Pastikan Customer untuk membayar dahulu sebelum mengambil barang.</b>
    </div>
    <div class="form-group row mb-2 mt-2">
        <button type="submit" class="col-md-12 btn btn-primary">Update dan Ambil Barang</button>
    </div>
</form>
@endif

