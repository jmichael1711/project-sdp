@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-tools icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    Edit Kota
@endsection

@section('subtitle')
    Page ini adalah untuk mengedit Kota
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
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Kota</label>
                                    <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="nama" id=""
                                    placeholder="Nama Kota" type="text" class="form-control" value="{{$kota->nama}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Status</label>
                                <select class="form-control" name="is_deleted">
                                    @if ($kota->is_deleted)
                                        <option selected class="form-control" value="1">NOT ACTIVE</option>
                                        <option class="form-control" value="0">ACTIVE</option>
                                    @else
                                        <option class="form-control" value="1">NOT ACTIVE</option>
                                        <option selected class="form-control" value="0">ACTIVE</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2">
                            <div class="position-relative form-group">
                                <button class="mt-2 btn btn-primary">Edit</button>
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
