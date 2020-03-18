@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-tools icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    Edit Pegawai
@endsection

@section('subtitle')
Page ini adalah untuk mengubah data pegawai.
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
            <form novalidate class="needs-validation" method="post" action="/admin/pengirimanCustomer/update/{{$pengirimanCust->id  }}" enctype="multipart/form-data">
                @csrf
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">ID Pengiriman Customer</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="id" 
                                type="text" class="form-control" value="{{$pengirimanCust->id}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Kota</label>
                                <select id="kota" class="form-control" onchange='isiKantorAsal()' required>
                                    <option class="form-control" value="{{$kotaNow}}">{{$kotaNow}}</option>
                                    @foreach ($allKota as $kota)
                                        @if($kota->nama != $kotaNow)
                                            <option class="form-control" value="{{$kota->nama}}">{{$kota->nama}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Kantor Asal</label>
                                <select name="kantor_id" id="kantor" class="form-control" onchange='isiKurirCustomer()' required></select>
                                <div class="invalid-feedback">
                                    Mohon pilih kantor asal.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Kurir Customer</label>
                                <select name="kurir_customer_id" id="kurir" class="form-control" required></select>
                                <div class="invalid-feedback">
                                    Mohon pilih kurir customer.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Apakah kurir menuju ke penerima?</label>
                                <br>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="menuju_penerima" value="1"
                                      @if($pengirimanCust->menuju_penerima == '1')
                                        checked
                                      @endif
                                      > Ya
                                    </label>
                                  </div>
                                  <div class="form-check-inline">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="menuju_penerima" value="0"
                                      @if($pengirimanCust->menuju_penerima == '0')
                                        checked
                                      @endif
                                      > Tidak
                                    </label>
                                  </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2">
                            <div class="position-relative form-group">
                                <button class="mt-2 btn btn-primary">Tambah</button>
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
        $("#upperlist-pegawai").addClass("mm-active");
        $("#btn-pegawai").attr("aria-expanded", "true");
        $("#list-pegawai").attr("class", "mm-collapse mm-show");
        $("#header-pegawai").attr("class", "mm-active");
    })

</script>
@endsection 