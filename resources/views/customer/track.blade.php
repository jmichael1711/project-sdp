@extends('layouts.customer')

@section('content')
<div class="site-section bg-light">
    <div class="container">
        <div class="row">
        <div class="col-12 text-center mb-5" data-aos="fade-up" data-aos-delay="">
            <div class="block-heading-1" data-aos="fade-up" data-aos-delay="">
                <h2 class="mb-5">Tracking</h2>
                <p>Dibawah merupakan sejarah pengiriman untuk resi anda.</p>
            </div>
        </div>
        </div>
        <div class="row mt-3 mb-2 text-secondary" style="font-size: 20px;">
            <p>ID Resi: {{$resi->id}}</p>
        </div>
        <div class="row mt-2 mb-5 text-secondary" style="font-size: 20px;">
            <p>Harga: Rp. {{$resi->harga}}</p>
        </div>
        <div class="row mt-5 mb-5 text-primary">
            <h4>Sejarah Pengiriman Resi</h4>
        </div>
        <div class="row mb-5">
            <table class="table table-hover table-striped dataTable dtr-inline" id="myTable">
                <thead>
                    <th>No.</th>
                    <th>Keterangan</th>
                    <th>Waktu</th>
                </thead>
                <tbody>
                    @foreach ($sejarah as $i)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>{{$i->keterangan}}</td>
                            <td>{{$i->waktu}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection