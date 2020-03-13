@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-tools icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
    Edit Bon Muat
@endsection

@section('subtitle')
Page ini adalah untuk edit data bon muat.
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
                <form novalidate class="needs-validation" method="post" action="/admin/bonmuat/update/{{$bonmuat->id}}" enctype="multipart/form-data">
                @csrf
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
                                        <option selected class="form-control" value="{{$kantor->id}}">{{$kantor->alamat}}</option>
                                        @endif
                                    @endforeach
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
        $("#upperlist-bonmuat").addClass("mm-active");
        $("#btn-bonmuat").attr("aria-expanded", "true");
        $("#list-bonmuat").attr("class", "mm-collapse mm-show");
        $("#header-bonmuat").attr("class", "mm-active");

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
</script>
@endsection
