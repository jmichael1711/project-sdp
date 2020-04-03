@extends('layouts.customer')


@section('content')
<div class="ftco-blocks-cover-1">
    <div class="ftco-cover-1 overlay" style="background-image: url('depot/images/depot_hero_1.jpg')">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-lg-6">
            <h1>Item Expedition</h1>
            <p class="mb-5">Our transportation system spans across East Java. Why don't you take a look at the progress of your item?</p>
            <form action="#" method="get">
              <div class="form-group d-flex">
                @csrf
                <input type="text" class="form-control" placeholder="ID RESI" name="resi_id">
                <input type="submit" class="btn btn-primary text-white px-4" value="Track Now">
              </div>
              <div class="form-group d-flex justify-content-center">
                @csrf
                <input type="submit" class="btn btn-primary text-white px-4" value="Scan Barcode">
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
      {{-- <div class="owl-carousel owl-all">
        <div class="block__35630 text-center">
          <div class="icon mb-0">
            <span class="flaticon-ferry"></span>
          </div>
          <h3 class="mb-3">Sea Freight</h3>
          <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. </p>
        </div>

        <div class="block__35630 text-center">
          <div class="icon mb-0">
            <span class="flaticon-airplane"></span>
          </div>
          <h3 class="mb-3">Air Freight</h3>
          <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. </p>
        </div>

        <div class="block__35630 text-center">
          <div class="icon mb-0">
            <span class="flaticon-box"></span>
          </div>
          <h3 class="mb-3">Package Forwarding</h3>
          <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. </p>
        </div> --}}

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
          <h3 class="mb-3">Delivery</h3>
          <p>Pengiriman akan sampai tepat pada waktunya, tidak molor.</p>
        </div>

      </div>
    </div>
  </div>




  <div class="site-section" id="about-section">

    <div class="container">
      <div class="row mb-5 justify-content-center">
        <div class="col-md-7 text-center">
          <div class="block-heading-1" data-aos="fade-up" data-aos-delay="">
            <h2>About Us</h2>
            <p>TeamAte merupakan perusahaan ekspedisi yang berdiri pada tahun 2019. Pendirinya ada 4 orang yang bernama Enricho Glenn,
              Heinrich Wisesa, Johannes Michael dan William. Mereka adalah pelajar di Institut Sains Terapan dan Teknologi Surabaya
              yang berlokasi di Jl. Ngagel Jaya Tengah No.73-77, Baratajaya, Kec. Gubeng, Kota SBY, Jawa Timur 60284.
            </p>
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
            <img src="depot/images/person_1.jpg" alt="Image" class="img-fluid rounded-circle">
          </figure>
          <h3 class="font-size-20 text-black">Max Carlson</h3>
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
            <img src="depot/images/person_2.jpg" alt="Image" class="img-fluid rounded-circle">
          </figure>
          <h3 class="font-size-20 text-black">Charlotte Pilat</h3>
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
            <img src="depot/images/person_3.jpg" alt="Image" class="img-fluid rounded-circle">
          </figure>
          <h3 class="font-size-20 text-black">Nicole Lewis</h3>
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
            <img src="depot/images/person_3.jpg" alt="Image" class="img-fluid rounded-circle">
          </figure>
          <h3 class="font-size-20 text-black">Nicole Lewis</h3>
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