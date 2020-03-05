@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-tools icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    Create Bon Muat
@endsection

@section('subtitle')
Page ini adalah untuk menambah bon muat baru.
@endsection

@section('content')
<div class="tab-content">
    @if (Session::has('success-bonmuat'))
        <ul class="list-group mb-2">
            <li class="list-group-item-success list-group-item">{{Session::get('success-bonmuat')}}</li>
        </ul>
        @php
            Session::forget('success-bonmuat');
        @endphp
    @endif
    
    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <form novalidate class="needs-validation" method="post" action="/admin/pengirimanCustomer/store" enctype="multipart/form-data">
                @csrf
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label class="">Alamat</label>
                                <textarea style="resize: none;" rows="5" oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="alamat"
                                placeholder="ALAMAT" type="text" class="form-control" required></textarea>
                                <div class="invalid-feedback">
                                    Mohon inputkan alamat valid.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                <label class="">ID Pengiriman Customer</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="id_pengiriman_customer" id="" 
                                type="text" class="form-control" value="{{$nextId}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <label class="">Jenis Kantor</label>
                                <select name="is_warehouse" class="form-control">
                                    <option value="0" class="form-control">KANTOR CABANG</option>
                                    <option value="1" class="form-control">WAREHOUSE</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Kota</label>
                                <select name="kota" class="form-control">
                                    {{-- @foreach ($listKota as $i)
                                        <option class="form-control" value="{{$i}}">{{$i}}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2">
                            <div class="position-relative form-group">
                                <label class="">Longitude</label>
                                <input required oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="longitude" 
                                placeholder="0.000000" step="0.000001" type="number" max="999.999999" min="0.000000" class="form-control">
                                <div class="invalid-feedback">
                                    Mohon inputkan longitude valid. Longitude untuk kantor bisa di search di web.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="position-relative form-group">
                                <label class="">Latitude</label>
                                <input required oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="latitude" 
                                placeholder="0.000000" step="0.000001" type="number" max="999.999999" min="0.000000" class="form-control">
                                <div class="invalid-feedback">
                                    Mohon inputkan latitude valid. Latitude untuk kantor bisa di search di web.
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