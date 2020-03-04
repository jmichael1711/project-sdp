@extends('layouts.admin')

@section('subtitle')
Page ini adalah untuk menambah kantor baru.
@endsection

@section('title-icon')
<i class="pe-7s-tools icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    Halo
@endsection

@section('content')
<div class="tab-content">
    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
        <div class="main-card mb-3 card">
            <div class="card-body"><h5 class="card-title">Kantor Baru</h5>
                <form class="" method="post" action="/admin/kantor/store" enctype="multipart/form-data">
                @csrf
                    <div class="form-row">
                        <div class="col-md-1">
                            <div class="position-relative form-group">
                                <label class="">Id Admin</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="id" placeholder="Kode" 
                                type="text" maxlength="4" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label class="">Nama Admin</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="nama" id="" 
                                placeholder="Nama" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2">
                            <div class="position-relative form-group">
                                <label class="">Role Admin</label>
                                <select name="isSuper" class="form-control">
                                    <option value="0" class="form-control">NORMAL</option>
                                    <option value="1">SUPER</option>
                                </select>
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