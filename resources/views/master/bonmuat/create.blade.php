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
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                <label class="">ID Bon Muat</label>
                                <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                this.setSelectionRange(p, p);" style="text-transform:uppercase" name="id_pengiriman_customer" id="" 
                                type="text" class="form-control" value="{{$nextId}}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Kota Asal</label>
                                <select name="kotaAsal" class="form-control" id="kotaAsal" onchange='isiKantor("Asal")'>
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
                                <select name="kantorAsal" class="form-control" id="kantorAsal">
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Kota Tujuan</label>
                                <select name="kota" class="form-control" id='kotaTujuan' onchange='isiKantor("Tujuan")'>
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
                                <select name="kota" class="form-control" id="kantorTujuan">
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Kurir</label>
                                <select name="kota" class="form-control" id="kurir">
                                    {{-- @foreach ($listKota as $i)
                                        <option class="form-control" value="{{$i}}">{{$i}}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label class="">Kendaraan</label>
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

        var idKota = $('#kotaAsal').val();
        refreshKantor(idKota,"Asal");
        refreshKantor(idKota,"Tujuan");
        refreshKurir();
    })

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
        @php
            $kantorAsal = '';
            $kantorTujuan = '';
        @endphp
        var foundAsal = false;
        var foundTujuan = false;
        @for($i = 0; $i< $allKota->count(); $i++)
        alert('Kantor Asal : ' + '{{$kantorAsal}}');
        alert('Kota Asal :  '+$("#kotaAsal").val() + ' - {{$allKota[$i]->nama}}');
        alert('Kota Tujuan :  '+$("#kotaTujuan").val() + ' - {{$allKota[$i]->nama}}');
        alert(foundAsal);
            if($("#kotaAsal").val() == '{{$allKota[$i]->nama}}' && foundAsal == false){
                alert('Kota asal sama');
                @php
                    $allKantorAsal = $allKota[$i]->kantor;             
                @endphp
                @foreach($allKantorAsal as $kantor)
                    alert('Kantor : '+$("#kantorAsal").val() + ' - {{$kantor->id}} ');
                    if('{{$kantor->id}}' == $("#kantorAsal").val()){
                        @php
                            $kantorAsal = $kantor;
                        @endphp
                        foundAsal = true;
                    }
                    alert('Hasil Kantor Asal : ' + '{{$kantorAsal->id}}');
                @endforeach   
            }if($("#kotaTujuan").val() == '{{$allKota[$i]->nama}}' && foundTujuan == false){
               alert('Kota tujuan sama');
                @php
                    $allKantorTujuan = $allKota[$i]->kantor;
                @endphp
                @foreach($allKantorTujuan as $kantor)
                    alert('Kantor : '+$("#kantorTujuan").val() + ' - {{$kantor->id}}');
                    if('{{$kantor->id}}' == $("#kantorTujuan").val()){
                        @php
                            $kantorTujuan = $kantor;
                        @endphp
                        foundTujuan = true;
                        alert('Hasil Kantor Tujuan : ' + '{{$kantorTujuan->id}}');
                    }
                @endforeach
            }
            alert('Hasil Kantor Asal 2 : ' + '{{$kantorAsal->id}} - ' + '{{$kantorAsal->alamat}}');
            alert('Hasil Kantor Tujuan 2 : ' + '{{$kantorTujuan->id}} - ' + '{{$kantorTujuan->alamat}}');
            alert(foundAsal + ' - ' + foundTujuan);
            alert('{{$i}}' + ' - ' + '{{$allKota->count()}}');
            
        @endfor
        
        $("#kurir").html('');
        alert('Masuk 1 : {{$kantorAsal->id}} - ' + '{{$kantorTujuan->id}}');
        if('{{$kantorAsal->id}}' != '' && '{{$kantorTujuan->id}}' != 'null'){
            alert('Masuk 2 : {{$kantorAsal->id}} - ' + '{{$kantorTujuan->id}}');
            @foreach($allKurir as $kurir) 
                @php
                    $realKurir = $kurir->sortKurir($kantorAsal->id,$kantorTujuan->id);
                @endphp
                
                alert("Real Kurir : {{$realKurir}}");
                if('{{$realKurir}}'== '1'){
                    console.log("{{$kurir->nama}}");
                    $("#kurir").append('<option class="form-control" value="{{$kurir->id}}">{{$kurir->nama}}</option>');  
                }
            @endforeach
        }
    }

</script>
@endsection 