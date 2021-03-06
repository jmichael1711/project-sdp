@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-box1 icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    TAMBAH DATA BON MUAT
@endsection

@section('subtitle')
Halaman ini untuk menambah data bon muat.
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
                <form novalidate class="needs-validation" method="post" action="/admin/bonmuat/store" enctype="multipart/form-data">
                @csrf
                    @if (Session::has('loginstatus'))
                        @if (Session::get('loginstatus') != 3)
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Kota Asal</label>
                                <select class="form-control" id="kotaAsal" onchange='isiKantor("Asal")'>
                                    @foreach ($allKota as $kota)
                                        <option class="form-control" value="{{$kota->nama}}">{{$kota->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Kantor Asal</label>
                                <select name="kantor_asal_id" class="form-control" id="kantorAsal" onchange="refreshComboBox()" required>
                                </select>
                            </div>
                        </div>
                    </div>
                        @endif  
                    @endif
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Kota Tujuan</label>
                                <select class="form-control" id='kotaTujuan' onchange='isiKantor("Tujuan")'>
                                    @foreach ($allKota as $kota)
                                        <option class="form-control" value="{{$kota->nama}}">{{$kota->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Kantor Tujuan</label>
                                <select name="kantor_tujuan_id" class="form-control" id="kantorTujuan" onchange="refreshComboBox()" required>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Kurir</label>
                                <select name="kurir_non_customer_id" class="form-control" id="kurir" required>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Kendaraan</label>
                                <select name="kendaraan_id" class="form-control" id="kendaraan" required>
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

@section('scripts')
<script>
    $(document).ready(function () {
        //UNTUK SIDEBAR
        $("#upperlist-bonmuat").addClass("mm-active");
        $("#btn-bonmuat").attr("aria-expanded", "true");
        $("#list-bonmuat").attr("class", "mm-collapse mm-show");
        $("#header-tambah-bonmuat").attr("class", "mm-active");

        var idKota = $('#kotaTujuan').val();
        @if (Session::has('loginstatus'))
            @if (Session::get('loginstatus') != 3)
                refreshKantor(idKota,"Asal");
            @endif
        @endif
        refreshKantor(idKota,"Tujuan");
    })

    function isiKantor(posisi){
        var idKota = $('#kota'+posisi).val();
        refreshKantor(idKota,posisi);
    }
    

    function refreshKantor(idKota, posisi){
        $.ajax({
            method : "POST",
            url : '/admin/bonmuat/cariKantor',
            datatype : "json",
            data : { kota: idKota, _token : "{{ csrf_token() }}" },
            success: function(result){
                $('#kantor'+posisi).html(result);
                refreshComboBox();
            },
            error: function(){
                console.log('error');
            }
        });
    }



    function refreshComboBox(){
        @if (Session::has('loginstatus'))
            @if (Session::get('loginstatus') == 3)
                var kantorAsal = "{{Session::get('pegawai')->kantor->id}}";
            @else
                var kantorAsal = $('#kantorAsal').val();
            @endif
        @endif
        var kantorTujuan = $('#kantorTujuan').val();
        $.ajax({
            method : "POST",
            url : '/admin/bonmuat/find',
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
</script>
@endsection 