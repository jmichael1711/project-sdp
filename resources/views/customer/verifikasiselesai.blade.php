@extends('layouts.customer')

@section('content')
<div class="site-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5" data-aos="fade-up" data-aos-delay="">
                <div class="block-heading-1">
                    <h2>Pengiriman sedang diproses</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 mb-5" data-aos="fade-up" data-aos-delay="100">
                <p>
                    Terimakasih telah melakukan validasi email. Sekarang kantor sedang memproses pesanan anda dan dalam kurun 
                    waktu 30 menit akan ada panggilan telepon dari kurir untuk mengkonfirmasi nomor telepon anda. Jika telepon
                    tidak diangkat, maka pengiriman dianggap batal dan kurir tidak akan datang untuk mengambil barang.
                </p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 mb-5 text-center" data-aos="fade-up" data-aos-delay="100">
                <a href="/"><button class=" btn btn-primary">Back to Home</button></a>
            </div>
        </div>
    </div>
</div>
@endsection