@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-map-2 icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    TAMBAH DATA KOTA
@endsection

@section('subtitle')
Halaman ini untuk menambah data kota.
@endsection

@section('content')
    <div class="tab-content">
    @if (Session::has('success-kota'))
        <ul class="list-group mb-2">
            <li class="list-group-item-success list-group-item">{{Session::get('success-kota')}}</li>
        </ul>
        @php
            Session::forget('success-kota');
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
                <form novalidate class="needs-validation" method="post" action="/admin/kota/store" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-row">
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                <label class="">Nama Kota</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="nama" id=""
                                placeholder="NAMA KOTA" type="text" class="form-control" required>
                                <div class="invalid-feedback">
                                    Mohon input nama kota yang valid.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                <label class="">Id</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="id" id=""
                                placeholder="Id Raja Ongkir" type="number" class="form-control" required>
                                <div class="invalid-feedback">
                                    Mohon input id yang valid.
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
                </div>
                </form>
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
        $("#header-tambah-kota").attr("class", "mm-active");
    })
</script>
@endsection
