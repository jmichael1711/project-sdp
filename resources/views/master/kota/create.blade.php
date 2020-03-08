@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-tools icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    Create Kota
@endsection

@section('subtitle')
Page ini adalah untuk menambah kota
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
    <form novalidate class="needs-validation" method="post" action="/admin/kota/store" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-row">
            <div class="col-md-3">
                <div class="position-relative form-group">
                    <label class="">Nama Kota</label>
                    <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="nama" id=""
                    placeholder="NAMA KOTA" type="text" class="form-control" required>
                    <div class="invalid-feedback">
                        Mohon inputkan nama kota yang valid.
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
