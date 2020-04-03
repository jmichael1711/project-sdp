@extends('layouts.customer')

@section('content')
<div class="site-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5" data-aos="fade-up" data-aos-delay="">
                <div class="block-heading-1">
                    <h2>Pesanan Sedang Diproses</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 mb-5" data-aos="fade-up" data-aos-delay="100">
                <p>
                    Panggilan telepon akan dilakukan oleh kurir yang menjemput barang anda. Jika telepon tidak
                    diangkat / tidak ada panggilan 30 menit kedepan, maka pesanan dianggap batal.
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