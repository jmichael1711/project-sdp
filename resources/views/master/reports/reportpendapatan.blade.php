@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-gift icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
REPORT PENDAPATAN
@endsection

@section('subtitle')
Halaman ini untuk melihat report pendapatan per-tahun setiap kantor.
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
                @csrf
                <div class="form-row">
                    <div class="col-md-5">
                        <div class="position-relative form-group">
                            <label class="">Kota</label>
                            <select id="kota" class="form-control" onchange='isiKantor()' required>
                                @foreach ($kotas as $kota)
                                    <option class="form-control" value="{{$kota->nama}}">{{$kota->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-5">
                        <div class="position-relative form-group">
                            <label class="">Kantor</label>
                            <select name="kantor_id" id="kantor" class="form-control" onchange='isiKurirCustomer()' required></select>
                            <div class="invalid-feedback">
                                Mohon pilih kantor asal yang valid.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        //UNTUK SIDEBAR
        $("#upperlist-pengirimanCustomer").addClass("mm-active");
        $("#btn-pengirimanCustomer").attr("aria-expanded", "true");
        $("#list-pengirimanCustomer").attr("class", "mm-collapse mm-show");
        $("#header-tambah-pengirimanCustomer").attr("class", "mm-active");
       
    })
   
    //UNTUK KANTOR
    function isiKantor(){
        var idKota = $('#kota').val();

        $.ajax({
            method : "POST",
            url : '/admin/reports/carikantor',
            datatype : "json",
            data : { 
                kota : idKota, 
                _token : "{{ csrf_token() }}" 
            },
            success: function(result){
                $('#kantor').html(result);
            },
            error: function(){
                console.log('error');
            }
        });
    }

    function refreshComboboxKantor() {
        
    }

   
</script>
@endsection 