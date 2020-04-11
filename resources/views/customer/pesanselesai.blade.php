@extends('layouts.customer')

@section('content')
<div class="site-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5" data-aos="fade-up" data-aos-delay="">
                <div class="block-heading-1">
                    <h2>Verifikasi Email</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 mb-5" data-aos="fade-up" data-aos-delay="100">
                <p>
                    Sebuah email untuk verifikasi ketersediaan email telah dikirimkan ke email milik anda. Agar pengiriman diproses,
                    Klik link yang terdapat didalam email. Batas waktu adalah 30 menit untuk melakukan verifikasi.
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