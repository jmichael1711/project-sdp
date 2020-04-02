@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-tools icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    Edit Kurir Non customer
@endsection

@section('subtitle')
Page ini adalah untuk mengubah kurir Non customer.
@endsection

@section('content')
<div class="tab-content">
    @if (Session::has('success-kurir_noncustomer'))
        <ul class="list-group mb-2">
            <li class="list-group-item-success list-group-item">{{Session::get('success-kurir_noncustomer')}}</li>
        </ul>
        @php
            Session::forget('success-kurir_noncustomer');
        @endphp
    @endif

    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <form novalidate class="needs-validation" method="post" action="/admin/kurir_noncustomer/update/{{$kurnoncust->id}}" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label class="">ID Kantor 1</label>
                            <select name="kantor_1_id" class="form-control">
                                @foreach ($listKanID as $i)
                                    <option class="form-control" value="{{$i->id}}">{{$i->id}} - {{$i->kota}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label class="">ID Kantor 2</label>
                            <select name="kantor_2_id" class="form-control">
                                @foreach ($listKanID as $i)
                                    <option class="form-control" value="{{$i->id}}">{{$i->id}} - {{$i->kota}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-3">
                        <div class="position-relative form-group">
                            <label class="">Nama</label>
                            <input style="text-transform:uppercase" name="nama" id=""
                            placeholder="NAMA KURIR" type="text" class="form-control" value="{{$kurnoncust->nama}}"required>
                            <div class="invalid-feedback">
                                Mohon inputkan Nama Kurir Customer yang valid.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-3">
                        <div class="position-relative form-group">
                            <label class="">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control">
                                @if ($kurnoncust->jenis_kelamin)
                                    <option selected class="form-control" value="1">Laki-Laki</option>
                                    <option class="form-control" value="0">Perempuan</option>
                                @else
                                    <option class="form-control" value="1">Laki-Laki</option>
                                    <option selected class="form-control" value="0">Perempuan</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-3">
                        <div class="position-relative form-group">
                            <label class="">No_telp</label>
                            <input style="text-transform:uppercase" name="no_telp" id=""
                            placeholder="Nomor Telpon" type="text" class="form-control"  value="{{$kurnoncust->no_telp}}" required>
                            <div class="invalid-feedback">
                                Mohon inputkan Nomor Telpon yang valid.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label class="">Alamat</label>
                            <input style="text-transform:uppercase" name="alamat" id=""
                            placeholder="Alamat" type="text" class="form-control"  value="{{$kurnoncust->alamat}}" required>
                            <div class="invalid-feedback">
                                Mohon inputkan alamat yang valid.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label class="">Passsword</label>
                            <input style="text-transform:uppercase" name="password" id=""
                            placeholder="Password" type="text" class="form-control"  value="{{$kurnoncust->password}}" required>
                            <div class="invalid-feedback">
                                Mohon inputkan password yang valid.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-3">
                        <div class="position-relative form-group">
                            <label class="">Active</label>
                            <select name="is_deleted" class="form-control">
                            @if ($kurnoncust->is_deleted)
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
        $("#upperlist-kurir_noncustomer").addClass("mm-active");
        $("#btn-kurir_noncustomer").attr("aria-expanded", "true");
        $("#list-kurir_noncustomer").attr("class", "mm-collapse mm-show");
        $("#header-kurir_noncustomer").attr("class", "mm-active");
    })
</script>
@endsection
