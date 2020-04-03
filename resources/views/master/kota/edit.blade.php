@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-map-2 icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    UBAH DATA KOTA
@endsection

@section('subtitle')
Halaman ini untuk mengubah data kota.
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
    @if (Session::has('failed-kota'))
    <ul class="list-group mb-2">
        <li class="list-group-item-danger list-group-item">{{Session::get('failed-kota')}}</li>
    </ul>
    @php
        Session::forget('failed-kota');
    @endphp
    @endif
    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <form novalidate class="needs-validation" method="post" action="/admin/kota/update/{{$kota->nama}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                <label class="">Nama Kota</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="nama" id=""
                                placeholder="Nama Kota" type="text" class="form-control" value="{{$kota->nama}}" required {{$kota->is_deleted ? 'disabled' : ''}}>
                                <div class="invalid-feedback">
                                    Mohon input nama kota yang valid.
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                <label class="">Status Aktif</label>
                                <select class="form-control" name="is_deleted">
                                    @if ($kota->is_deleted)
                                        <option selected class="form-control" value="1">TIDAK AKTIF</option>
                                        <option class="form-control" value="0">AKTIF</option>
                                    @else
                                        <option class="form-control" value="1">TIDAK AKTIF</option>
                                        <option selected class="form-control" value="0">AKTIF</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2">
                            <div class="position-relative form-group">
                                <button class="mt-2 btn btn-primary">Ubah</button>
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
        $("#upperlist-kota").addClass("mm-active");
        $("#btn-kota").attr("aria-expanded", "true");
        $("#list-kota").attr("class", "mm-collapse mm-show");
        $("#header-kota").attr("class", "mm-active");
    })
</script>
@endsection
