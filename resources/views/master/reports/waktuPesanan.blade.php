@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-file icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
REPORT JANGKA WAKTU PESANAN DIPROSES
@endsection

@section('subtitle')
Halaman ini untuk melihat report jangka waktu pesanan diproses oleh kasir
@endsection

@section('content')
<div class="form-row">
    <div class="col-md-5">
        <div class="position-relative form-group">
            <label class="">Kota</label>
            <select id="kota" class="form-control" required onchange="getKantor()">
                @foreach ($allKota as $kota)
                    <option class="form-control" value="{{$kota->nama}}">{{$kota->nama}}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                Mohon pilih kota yang valid.
            </div>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-5">
        <div class="position-relative form-group">
            <label class="">Kantor</label>
            <select id="kantor" class="form-control" required>
                @foreach ($allKantor as $kantor)
                    <option class="form-control" value="{{$kantor->id}}">{{$kantor->alamat}}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                Mohon pilih kantor yang valid.
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script>
    function getKantor(){
        var kota = $('#kota').val();
        $.ajax({
            method : "POST",
            url : '/admin/reports/getKantor',
            datatype : "json",
            data : { kota: kota, _token : "{{ csrf_token() }}" },
            success: function(result){
                $('#kantor').html(result);
            },
            error: function(){
                console.log('error');
            }
        });
    }
</script>
@endsection
