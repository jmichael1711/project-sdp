@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-tools icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    Edit Kantor
@endsection

@section('subtitle')
Page ini adalah untuk mengubah data kantor.
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
                <form novalidate class="needs-validation" method="post" action="/admin/kantor/update/{{$kantor->id}}" enctype="multipart/form-data">
                @csrf
                    <div class="form-row">
                        <div class="col-md-2">
                            <div class="position-relative form-group">
                                <label class="">ID</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="id" disabled id=""
                                placeholder="ID" type="text" class="form-control" value="{{$kantor->id}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label class="">Alamat</label>
                                <textarea style="resize: none;" rows="5" oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="alamat"
                                placeholder="ALAMAT" type="text" class="form-control" required {{$kantor->is_deleted ? 'disabled' : ''}}>{{$kantor->alamat}}</textarea>
                                <div class="invalid-feedback">
                                    Mohon inputkan alamat valid.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <label class="">Nomor Telepon</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="no_telp" id=""
                                placeholder="NO TELP" type="text" class="form-control" value="{{$kantor->no_telp}}" required {{$kantor->is_deleted ? 'disabled' : ''}}>
                                <div class="invalid-feedback">
                                    Mohon inputkan nomor telepon valid.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <label class="">Jenis Kantor</label>
                                <select name="is_warehouse" class="form-control" {{$kantor->is_deleted ? 'disabled' : ''}}>
                                    @if ($kantor->is_warehouse)
                                        <option value="1" class="form-control">WAREHOUSE</option>
                                    @else
                                        <option value="0" class="form-control">KANTOR CABANG</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Kota</label>
                                <select name="kota" class="form-control" {{$kantor->is_deleted ? 'disabled' : ''}}>
                                    @foreach ($listKota as $i)
                                        @if ($i->nama == $kantor->kota)
                                            <option selected class="form-control" value="{{$i->nama}}">{{$i->nama}}</option>
                                        @else
                                            <option class="form-control" value="{{$i->nama}}">{{$i->nama}}</option>
                                        @endif
                                    @endforeach
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
                                placeholder="0.000000" step="0.000001" type="number" max="999.999999" min="0.000000" class="form-control" value="{{$kantor->longitude}}" {{$kantor->is_deleted ? 'disabled' : ''}}>
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
                                placeholder="0.000000" step="0.000001" type="number" max="999.999999" min="0.000000" class="form-control"  value="{{$kantor->latitude}}" {{$kantor->is_deleted ? 'disabled' : ''}}>
                                <div class="invalid-feedback">
                                    Mohon inputkan latitude valid. Latitude untuk kantor bisa di search di web.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Status</label>
                                <select class="form-control" name="is_deleted">
                                    @if ($kantor->is_deleted)
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
        $("#upperlist-kantor").addClass("mm-active");
        $("#btn-kantor").attr("aria-expanded", "true");
        $("#list-kantor").attr("class", "mm-collapse mm-show");
        $("#header-kantor").attr("class", "mm-active");
    })
</script>
@endsection
