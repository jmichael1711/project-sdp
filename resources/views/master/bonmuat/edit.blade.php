@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-tools icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    Edit Bon Muat
@endsection

@section('subtitle')
Page ini untuk edit data bon muat.
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
    Combobox kurir dan kendaraan masih salah (query salah)
    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Total Muatan : {{$bonmuat->total_muatan}} / 1000 Kg</h5>
                <div class="mb-3 progress">
                <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" style="width: {{$bonmuat->total_muatan/10}}%;"></div>
                </div>
                    <div class="form-row">
                        <div class="col-md-2">
                            <div class="position-relative form-group">
                                <label class="">ID</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="id" disabled id=""
                                placeholder="ID" type="text" class="form-control" value="{{$bonmuat->id}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="collapse" id="collapseEdit">
                    <form novalidate class="needs-validation" method="post" action="/admin/bonmuat/update/{{$bonmuat->id}}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Kota Asal</label>
                                <select class="form-control" id="kotaAsal" onchange='isiKantor("Asal")'>
                                    @foreach ($allKota as $kota)
                                        @if($bonmuat->kantor_asal->kota == $kota->nama)
                                        <option selected class="form-control" value="{{$kota->nama}}">{{$kota->nama}}</option>
                                        @else
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
                                <select name="kantor_asal_id" class="form-control" id="kantorAsal" required>
                                    <option selected class="form-control" value="{{$bonmuat->kantor_asal->id}}">{{$bonmuat->kantor_asal->alamat}}</option>
                                    @foreach($bonmuat->kantor_asal->getKota->kantor as $kantor)
                                        @if($bonmuat->kantor_asal->id != $kantor->id)
                                        <option class="form-control" value="{{$kantor->id}}">{{$kantor->alamat}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Kota Tujuan</label>
                                <select class="form-control" id="kotaTujuan" onchange='isiKantor("Tujuan")'>
                                    @foreach ($allKota as $kota)
                                        @if($bonmuat->kantor_tujuan->kota == $kota->nama)
                                        <option selected class="form-control" value="{{$kota->nama}}">{{$kota->nama}}</option>
                                        @else
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
                                <label class="">Kantor Tujuan</label>
                                <select name="kantor_tujuan_id" class="form-control" id="kantorTujuan" required>
                                    <option selected class="form-control" value="{{$bonmuat->kantor_tujuan->id}}">{{$bonmuat->kantor_tujuan->alamat}}</option>
                                    @foreach($bonmuat->kantor_tujuan->getKota->kantor as $kantor)
                                        @if($bonmuat->kantor_tujuan->id != $kantor->id)
                                        <option class="form-control" value="{{$kantor->id}}">{{$kantor->alamat}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Kurir</label>
                                <select name="kurir_non_customer_id" class="form-control" id="kurir" required>
                                    <option selected class="form-control" value="{{$bonmuat->kurir_non_customer->id}}">{{$bonmuat->kurir_non_customer->nama}}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Kendaraan</label>
                                <select name="kendaraan_id" class="form-control" id="kendaraan" required>
                                    <option selected class="form-control" value="{{$bonmuat->kendaraan->id}}">{{$bonmuat->kendaraan->nopol}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                   
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Status</label>
                                <select class="form-control" name="is_deleted">
                                    @if ($bonmuat->is_deleted)
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
                <div class="card-footer">
                    <button type="button" data-toggle="collapse" href="#collapseEdit" class="btn btn-primary">Toggle</button>
                </div>
            </div>
        </div>
    </div>
    
    @if (Session::has('success-suratjalan'))
        <ul class="list-group mb-2">
            <li class="list-group-item-success list-group-item">{{Session::get('success-suratjalan')}}</li>
        </ul>
        @php
            Session::forget('success-suratjalan');
        @endphp
    @endif
    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel"> 
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="container">
                    <div class="col-md-2">
                        <video id="preview"></video>
                    </div>
                    <form novalidate class="needs-validation" method="post" action="/admin/bonmuat/addSuratJalan" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="resi_id" id="resi_id" 
                                    placeholder="Id Resi" type="text" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Id Resi tidak valid.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="position-relative form-group" style="bottom: 10%">
                                    <button class="mt-2 btn btn-primary">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </form>
                   
                    <table class="table table-hover table-striped dataTable dtr-inline" id="tableSuratJalan">
                        <thead>
                            <tr>
                                <th>Resi ID</th>
                                <th>Pengirim</th>
                                <th>Alamat Asal</th>
                                <th>Penerima</th>
                                <th>Alamat Tujuan</th>
                                <th>Berat</th>
                                <th>Dimensi</th>
                                <th>Fragile</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>User Created</th>
                                <th>User Updated</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bonmuat->resis as $i)
                            <tr>
                                <td>{{$i->id}}</td>
                                <td>{{$i->pesanan->nama_pengirim}}</td>
                                <td>{{$i->pesanan->alamat_asal}}</td>
                                <td>{{$i->pesanan->nama_penerima}}</td>
                                <td>{{$i->pesanan->alamat_tujuan}}</td>
                                <td>{{$i->pesanan->berat_barang}} Kg</td>
                                <td>{{$i->pesanan->panjang}} x {{$i->pesanan->lebar}} x {{$i->pesanan->tinggi}}</td>
                                @if ($i->pesanan->is_fragile)
                                <td class="text-center text-white">
                                    <div class="badge badge-danger">
                                        Fragile
                                    </div>
                                </td>    
                                @else 
                                <td class="text-center text-white">
                                    <div class="badge badge-success">
                                        Fine
                                    </div>
                                </td>
                                @endif
                                <td>{{$i->surat_jalan->created_at->diffForHumans()}}</td>
                                <td>{{$i->surat_jalan->updated_at->diffForHumans()}}</td>
                                <td>{{$i->surat_jalan->user_created}}</td>
                                <td>{{$i->surat_jalan->user_updated}}</td>
                                @if ($i->surat_jalan->telah_sampai)
                                <td class="text-center text-white">
                                    <div class="badge badge-success">
                                        Finish
                                    </div>
                                </td>    
                                @else 
                                <td class="text-center text-white">
                                    <div class="badge badge-warning">
                                        On going
                                    </div>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts') 
<script>
    $(document).ready(function (){
        $("#upperlist-bonmuat").addClass("mm-active");
        $("#btn-bonmuat").attr("aria-expanded", "true");
        $("#list-bonmuat").attr("class", "mm-collapse mm-show");
        $("#header-bonmuat").attr("class", "mm-active");

        var idKota = $('#kotaAsal').val();
        
    })
    
    var table = $('#tableSuratJalan').DataTable({
        "pagingType": 'full_numbers',
        'paging': true,
        'lengthMenu': [10,25, 50, 100]
    });

    function isiKantor(posisi){
        var idKota = $('#kota'+posisi).val();
        refreshKantor(idKota,posisi);
        refreshKurir();
    }
    
    function refreshKantor(idKota, posisi){
        @for ($i = 0; $i < $allKota->count(); $i++)             
            if(idKota == '{{$allKota[$i]->nama}}'){
                @php
                    $allKantor = $allKota[$i]->kantor;
                @endphp
                
                @if(count($allKantor) > 0)
                    $('#kantor'+posisi).html('@foreach ($allKantor as $kantor)<option class="form-control" value="{{$kantor->id}}">{{$kantor->alamat}}</option>@endforeach');
                @else
                    $('#kantor'+posisi).html('<option>-- TIDAK ADA KANTOR --</option>');
                @endif
            }
        @endfor        
    }

    function refreshKurir(){
        var kantorAsal = $('#kantorAsal').val();
        var kantorTujuan = $('#kantorTujuan').val();
        
        $.ajax({
            method : "POST",
            url : '/admin/bonmuat/findKurir',
            datatype : "json",
            data : { kantorAsal : kantorAsal,kantorTujuan : kantorTujuan, _token : "{{ csrf_token() }}" },
            success: function(result){
                var hasil = result.split('|');
                $('#kurir').html(hasil[0]);
                $('#kendaraan').html(hasil[1]);
            },
            error: function(){
                console.log('error');
            }
        });
    }

    let scanner = new Instascan.Scanner(
        {
            video: document.getElementById('preview')
        }
    );
    scanner.addListener('scan', function(content) {
        alert('Do you want to open this page?: ' + content);
        window.open(content, "_blank");
    });

    Instascan.Camera.getCameras().then(cameras => 
    {
        if(cameras.length > 0){
            scanner.start(cameras[0]);
        } else {
            console.error("Please enable Camera!");
        }
    });
</script>
@endsection
