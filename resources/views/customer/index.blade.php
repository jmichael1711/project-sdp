@extends('layouts.customer')


@section('content')
<div class="ftco-blocks-cover-1">
    <div class="ftco-cover-1 overlay" style="background-image: url('depot/images/depot_hero_1.jpg')">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-lg-6">
            <h1>Item Expedition</h1>
            <p class="mb-5">Our transportation system spans across East Java. Why don't you take a look at the progress of your item?</p>
            <form action="/track" method="get">
              <div class="form-group d-flex">
                @csrf
                <input type="text" class="form-control" placeholder="ID RESI" name="resi_id" id="resi_id">
                <input type="submit" class="btn btn-primary text-white px-4" value="Track Now" id="track">
              </div>
              <div class="form-group d-flex justify-content-center">
                <button type="button" class="btn mr-2 mb-2 btn-primary pull-right" data-toggle="modal" data-target="#exampleModalLong" id="scan" onclick="triggerScanner()">
                    Scan Barcode
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- END .ftco-cover-1 -->
    <div class="site-section ftco-service-image-1 pb-5">
      <div class="container">
        <div class="owl-carousel owl-all">
          <div class="service text-center">
            <a href="#"><img src="depot/images/depot_img_1.jpg" alt="Image" class="img-fluid"></a>
            <div class="px-md-3">
              <h3><a href="#">Truck Insurance</a></h3>
              <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Beatae distinctio laudantium nulla eos numquam incidunt!</p>
            </div>
          </div>
          <div class="service text-center">
            <a href="#"><img src="depot/images/depot_img_2.jpg" alt="Image" class="img-fluid"></a>
            <div class="px-md-3">
              <h3><a href="#">Plane Transportation</a></h3>
              <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Beatae distinctio laudantium nulla eos numquam incidunt!</p>
            </div>
          </div>
          <div class="service text-center">
            <a href="#"><img src="depot/images/depot_img_3.jpg" alt="Image" class="img-fluid"></a>
            <div class="px-md-3">
              <h3><a href="#">Sea &amp; Ear Freight</a></h3>
              <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Beatae distinctio laudantium nulla eos numquam incidunt!</p>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div class="site-section bg-light" id="services-section">
    <div class="container">
      <div class="row mb-5 justify-content-center">
        <div class="col-md-7 text-center">
          <div class="block-heading-1">
            <h2>Services</h2>
            <p>Berikut adalah fitur-fitur dari pengiriman kami.</p>
          </div>
        </div>
      </div>
        <div class="block__35630 text-center">
          <div class="icon mb-0">
            <span class="flaticon-lorry"></span>
          </div>
          <h3 class="mb-3">Trucking</h3>
          <p>Pengiriman dilakukan dengan menggunakan mobil box yang dapat terjangkau ke seluruh wilayah Jawa Timur.</p>
        </div>

        <div class="block__35630 text-center">
          <div class="icon mb-0">
            <span class="flaticon-warehouse"></span>
          </div>
          <h3 class="mb-3">Warehouse</h3>
          <p>Barang-barang pengiriman disimpan dalam warehouse-warehouse yang aman dengan pegawai-pegawai yang memberikan perlakuan bagus pada barang.</p>
        </div>

        <div class="block__35630 text-center">
          <div class="icon mb-0">
            <span class="flaticon-add"></span>
          </div>
          <h3 class="mb-3">Delivery On-Time</h3>
          <p>Pengiriman akan sampai tepat pada waktunya, tidak molor.</p>
        </div>
        <div class="block__35630 text-center">
          <div class="icon mb-0">
            <span class="flaticon-add"></span>
          </div>
          <h3 class="mb-3">Easy Tracking</h3>
          <p>Barang dapat dilacak dengan mudah dengan menggunakan website ini.</p>
        </div>

      </div>
    </div>
  </div>




  <div class="site-section" id="about-section">

    <div class="container">
      <div class="row mb-5 justify-content-center">
        <div class="col-md-7 text-center">
          <div class="block-heading-1" data-aos="fade-up" data-aos-delay="">
            <h2 class="mb-5">About Us</h2>
            <p>TeamAte merupakan perusahaan ekspedisi yang berdiri pada tahun 2019. Pendirinya ada 4 orang yang bernama Enricho Glenn,
              Heinrich Wisesa, Johannes Michael dan William. Mereka adalah pelajar di Institut Sains Terapan dan Teknologi Surabaya
              yang berlokasi di Jl. Ngagel Jaya Tengah No.73-77, Baratajaya, Kec. Gubeng, Kota SBY, Jawa Timur 60284. Karena gagal
              dalam mengerjakan skripsi, akhirnya 4 orang sahabat ini membuat sebuah perusahaan ekspedisi menggunakan modal dan
              kemampuan programming yang mereka punya.
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mb-5 justify-content-center">
        <div class="col-md-7 text-center">
          <div class="block-heading-1 text-secondary" data-aos="fade-up" data-aos-delay="">
            <h3>Video perusahaan TeamAte:</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="site-section bg-light" id="about-section">
    <div class="container">
      <div class="row justify-content-center mb-4 block-img-video-1-wrap">
        <div class="col-md-12 mb-5">
          <figure class="block-img-video-1" data-aos="fade">
            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" data-fancybox data-ratio="2">
            <span class="icon"><span class="icon-play"></span></span>
            <img src="depot/images/depot_delivery_1.jpg" alt="Image" class="img-fluid">
          </a>
          </figure>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="row">
            <div class="col-6 col-md-6 mb-4 col-lg-0 col-lg-3" data-aos="fade-up" data-aos-delay="">
              <div class="block-counter-1">
                <span class="number"><span data-number="1">0</span>+</span>
                <span class="caption">Years in Service</span>
              </div>
            </div>
            <div class="col-6 col-md-6 mb-4 col-lg-0 col-lg-3" data-aos="fade-up" data-aos-delay="100">
              <div class="block-counter-1">
                <span class="number"><span data-number="2093">0</span>+</span>
                <span class="caption">Employees</span>
              </div>
            </div>
            <div class="col-6 col-md-6 mb-4 col-lg-0 col-lg-3" data-aos="fade-up" data-aos-delay="200">
              <div class="block-counter-1">
                <span class="number"><span data-number="33">0</span>+</span>
                <span class="caption">Covered Cities</span>
              </div>
            </div>
            <div class="col-6 col-md-6 mb-4 col-lg-0 col-lg-3" data-aos="fade-up" data-aos-delay="300">
              <div class="block-counter-1">
                <span class="number"><span data-number="867">0</span>+</span>
                <span class="caption">Couriers</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="site-section" id="team-section">
    <div class="container">
      <div class="row mb-5 justify-content-center">
        <div class="col-md-7 text-center">
          <div class="block-heading-1" data-aos="fade-up" data-aos-delay="">
            <h2>Our Staff</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          </div>
        </div>
      </div>

      <div class="owl-carousel owl-all mb-5">

        <div class="block-team-member-1 text-center rounded h-100">
          <figure>
            <img src="images/EN.PNG" alt="Image" class="img-fluid rounded-circle">
          </figure>
          <h3 class="font-size-20 text-black">Enricho Glenn</h3>
          <span class="d-block font-gray-5 letter-spacing-1 text-uppercase font-size-12 mb-3">Co-Founder</span>
          <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          <div class="block-social-1">
            <a href="#" class="btn border-w-2 rounded primary-primary-outline--hover"><span class="icon-facebook"></span></a>
            <a href="#" class="btn border-w-2 rounded primary-primary-outline--hover"><span class="icon-twitter"></span></a>
            <a href="#" class="btn border-w-2 rounded primary-primary-outline--hover"><span class="icon-instagram"></span></a>
          </div>
        </div>
        

        <div class="block-team-member-1 text-center rounded h-100">
          <figure>
            <img src="images/JM.PNG" alt="Image" class="img-fluid rounded-circle">
          </figure>
          <h3 class="font-size-20 text-black">Johannes Michael</h3>
          <span class="d-block font-gray-5 letter-spacing-1 text-uppercase font-size-12 mb-3">Co-Founder</span>
          <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          <div class="block-social-1">
            <a href="#" class="btn border-w-2 rounded primary-primary-outline--hover"><span class="icon-facebook"></span></a>
            <a href="#" class="btn border-w-2 rounded primary-primary-outline--hover"><span class="icon-twitter"></span></a>
            <a href="#" class="btn border-w-2 rounded primary-primary-outline--hover"><span class="icon-instagram"></span></a>
          </div>
        </div>
       

        <div class="block-team-member-1 text-center rounded h-100">
          <figure>
            <img src="images/WG.PNG" alt="Image" class="img-fluid rounded-circle">
          </figure>
          <h3 class="font-size-20 text-black">William</h3>
          <span class="d-block font-gray-5 letter-spacing-1 text-uppercase font-size-12 mb-3">Co-Founder</span>
          <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          <div class="block-social-1">
            <a href="#" class="btn border-w-2 rounded primary-primary-outline--hover"><span class="icon-facebook"></span></a>
            <a href="#" class="btn border-w-2 rounded primary-primary-outline--hover"><span class="icon-twitter"></span></a>
            <a href="#" class="btn border-w-2 rounded primary-primary-outline--hover"><span class="icon-instagram"></span></a>
          </div>
        </div>

        <div class="block-team-member-1 text-center rounded h-100">
          <figure>
            <img src="images/HW.PNG" alt="Image" class="img-fluid rounded-circle">
          </figure>
          <h3 class="font-size-20 text-black">Heinrich Wisesa</h3>
          <span class="d-block font-gray-5 letter-spacing-1 text-uppercase font-size-12 mb-3">Co-Founder</span>
          <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          <div class="block-social-1">
            <a href="#" class="btn border-w-2 rounded primary-primary-outline--hover"><span class="icon-facebook"></span></a>
            <a href="#" class="btn border-w-2 rounded primary-primary-outline--hover"><span class="icon-twitter"></span></a>
            <a href="#" class="btn border-w-2 rounded primary-primary-outline--hover"><span class="icon-instagram"></span></a>
          </div>
        </div>
    </div>
  </div>




  <div class="site-section bg-light" id="pricing-section">
    <div class="container">
      <div class="row mb-5 justify-content-center text-center">
        <div class="col-md-7">
          <div class="block-heading-1" data-aos="fade-up" data-aos-delay="">
            <h2>Pricing</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
          </div>
        </div>
      </div>
      <div class="row mb-5">
        <div class="col-md-6 mb-4 mb-lg-0 col-lg-4" data-aos="fade-up" data-aos-delay="">
          <div class="pricing">
            <h3 class="text-center text-black">Basic</h3>
            <div class="price text-center mb-4 ">
              <span><span>$47</span> / year</span>
            </div>
            <ul class="list-unstyled ul-check success mb-5">

              <li>Officia quaerat eaque neque</li>
              <li>Possimus aut consequuntur incidunt</li>
              <li class="remove">Lorem ipsum dolor sit amet</li>
              <li class="remove">Consectetur adipisicing elit</li>
              <li class="remove">Dolorum esse odio quas architecto sint</li>
            </ul>
            <p class="text-center">
              <a href="#" class="btn btn-secondary btn-md">Buy Now</a>
            </p>
          </div>
        </div>

        <div class="col-md-6 mb-4 mb-lg-0 col-lg-4" data-aos="fade-up" data-aos-delay="100">
          <div class="pricing">
            <h3 class="text-center text-black">Premium</h3>
            <div class="price text-center mb-4 ">
              <span><span>$200</span> / year</span>
            </div>
            <ul class="list-unstyled ul-check success mb-5">

              <li>Officia quaerat eaque neque</li>
              <li>Possimus aut consequuntur incidunt</li>
              <li>Lorem ipsum dolor sit amet</li>
              <li>Consectetur adipisicing elit</li>
              <li class="remove">Dolorum esse odio quas architecto sint</li>
            </ul>
            <p class="text-center">
              <a href="#" class="btn btn-primary btn-md text-white">Buy Now</a>
            </p>
          </div>
        </div>

        <div class="col-md-6 mb-4 mb-lg-0 col-lg-4" data-aos="fade-up" data-aos-delay="200">
          <div class="pricing">
            <h3 class="text-center text-black">Professional</h3>
            <div class="price text-center mb-4 ">
              <span><span>$750</span> / year</span>
            </div>
            <ul class="list-unstyled ul-check success mb-5">

              <li>Officia quaerat eaque neque</li>
              <li>Possimus aut consequuntur incidunt</li>
              <li>Lorem ipsum dolor sit amet</li>
              <li>Consectetur adipisicing elit</li>
              <li>Dolorum esse odio quas architecto sint</li>
            </ul>
            <p class="text-center">
              <a href="#" class="btn btn-secondary btn-md">Buy Now</a>
            </p>
          </div>
        </div>
      </div>


    </div>
  </div>


  <div class="site-section" id="faq-section">
    <div class="container">
      <div class="row mb-5">
        <div class="block-heading-1 col-12 text-center">
          <h2>Frequently Ask Questions</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">

          <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
            <h3 class="text-black h4 mb-4">Possimus aut consequuntur incidunt?</h3>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
          </div>

          <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
            <h3 class="text-black h4 mb-4">Dolorum esse odio quas architecto sint?</h3>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
          </div>

          <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
            <h3 class="text-black h4 mb-4">Possimus aut consequuntur incidunt?</h3>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
          </div>

          <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
            <h3 class="text-black h4 mb-4">Dolorum esse odio quas architecto sint?</h3>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
          </div>
        </div>
        <div class="col-lg-6">

          <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
            <h3 class="text-black h4 mb-4">Lorem ipsum dolor sit</h3>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
          </div>

          <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
            <h3 class="text-black h4 mb-4">consequuntur incidunt?</h3>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
          </div>

          <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
            <h3 class="text-black h4 mb-4">Possimus aut consequuntur incidunt?</h3>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
          </div>

          <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
            <h3 class="text-black h4 mb-4">Dolorum esse odio quas architecto sint?</h3>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="block__73694 site-section border-top" id="why-us-section">
    <div class="container">
      <div class="row d-flex no-gutters align-items-stretch">

        <div class="col-12 col-lg-6 block__73422 order-lg-2" style="background-image: url('depot/images/depot_delivery_1.jpg');" data-aos="fade-left" data-aos-delay="">
        </div>



        <div class="col-lg-5 mr-auto p-lg-5 mt-4 mt-lg-0 order-lg-1" data-aos="fade-right" data-aos-delay="">
          <h2 class="mb-4 text-black">Why Depot</h2>
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Veniam error aliquid, dolores animi obcaecati quisquam accusamus soluta?</p>

          <ul class="ul-check primary list-unstyled mt-5">
            <li>Cargo express</li>
            <li>Secure Services</li>
            <li>Secure Warehouseing</li>
            <li>Cost savings</li>
            <li>Proven by great companies</li>
          </ul>

        </div>

      </div>
    </div>
  </div>
</div>
@endsection

{{-- Scanner Video --}}
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Scan Resi</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body d-flex justify-content-center">
              <video id="preview" style="width: 200px; height: 200px; border: 1px solid black;"></video>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeScanner()" id="close">Close</button>
          </div>
      </div>
  </div>
</div>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script>
  $(document).ready(function () {        
        if ('{{Session::has("fail-resi")}}'){
            Swal.fire({
              icon: 'error',
              title: 'Error!',
              text: '{{Session::get("fail-resi")}}',
            })
            @php
                Session::forget('fail-resi');
            @endphp
        } 
        
        scanner.addListener('scan', function(content) {
            var id = content;
            $("#resi_id").val(content);
            $("#track").click();
        });
    })


    let scanner = new Instascan.Scanner(
    {
        video: document.getElementById('preview')
    });

    function triggerScanner(){
        Instascan.Camera.getCameras().then(cameras => 
        {
            if(cameras.length > 0){
                scanner.start(cameras[0]);
            } else {
                console.error("Please enable Camera!");
            }
        });
    }
    
    function closeScanner(){
        Instascan.Camera.getCameras().then(cameras => 
        {
            if(cameras.length > 0){
                scanner.stop(cameras[0]);
            } else {
                console.error("Error Stop Camera");
            }
        });
    }
</script>

@endsection