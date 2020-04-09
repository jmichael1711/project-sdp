@extends('layouts.kurir')

@section('styles')
    <link href="{{asset('DataTables/datatables.min.css')}}" rel="stylesheet">
@endsection

@section('links')
<li><a href="/kurir" class="nav-link">Home</a></li>
<li><a href="/kurir/history" class="nav-link active">History</a></li>
<li><a href="/logout" class="nav-link">Logout</a></li>
@endsection

@section('content')
<div class="site-section bg-light">
    <div class="container">
        <div class="row">
        <div class="col-12 text-center mb-5" data-aos="fade-up" data-aos-delay="">
            <div class="block-heading-1" data-aos="fade-up" data-aos-delay="">
                <h2 class="mb-5">History</h2>
                <p>Dibawah merupakan sejarah pengiriman yang anda lakukan.</p>
            </div>
        </div>
        </div>
        <div class="row mt-5 mb-5 text-primary">
            <h4>Daftar Pengiriman 30 hari terakhir</h4>
        </div>
        <div class="row mb-5">
            <table class="table table-hover table-striped dataTable dtr-inline" id="myTable">
                <thead>
                    <th>No.</th>
                    <th>Tujuan</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No. Telp</th>
                    <th>Kode Pos</th>
                    <th>Berat (kg)</th>
                    <th>Harga</th>
                    <th>Waktu berangkat</th>
                    <th>Waktu sampai</th>
                    <th>Status Terakhir</th>
                </thead>
                <tbody>
                @php
                    $index = 1;
                @endphp
                @foreach ($pengirimans as $pengiriman)
                    
                    @foreach ($pengiriman->resisOrderedByLastDate as $i)
                    <tr>
                        <td>{{$index}}</td>
                        @if ($pengiriman->menuju_penerima)
                        <td><span class="badge badge-secondary">Penerima</span></td>
                        <td>{{$i->nama_penerima}}</td>
                        <td>{{$i->alamat_tujuan}}</td>
                        <td>{{$i->no_telp_penerima}}</td>
                        <td>{{$i->kode_pos_penerima}}</td>
                        @else
                        <td><span class="badge badge-primary">Pengirim</span></td>
                        <td>{{$i->nama_pengirim}}</td>
                        <td>{{$i->alamat_asal}}</td>
                        <td>{{$i->no_telp_pengirim}}</td>
                        <td>{{$i->kode_pos_pengirim}}</td>
                        @endif
                    <td>{{$i->berat_barang}}</td>
                    <td>Rp. {{$i->harga}}</td>
                    <td>{{$pengiriman->waktu_berangkat ?? '-'}}</td>
                    <td>{{$i->d_pengiriman_customer->waktu_sampai_cust ?? '-'}}</td>
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
                    
                    @php
                        $index++;
                    @endphp
                    </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    
</script>
@endsection
