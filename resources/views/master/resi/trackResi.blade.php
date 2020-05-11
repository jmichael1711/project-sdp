@extends('layouts.admin')

@section('title-icon')
<i class="pe-7s-note2 icon-gradient bg-mean-fruit"></i>
@endsection

@section('title')
TRACKING RESI
@endsection

@section('subtitle')
Halaman ini untuk melacak resi.
@endsection

@section('content')
<button id="triggerModal" type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target="#exampleModal" style="display: none">
    Trigger Modal
</button>
<div class="tab-content">
    @if (Session::has('success-resi'))
        <ul class="list-group mb-2">
            <li class="list-group-item-success list-group-item">{{Session::get('success-resi')}}</li>
        </ul>
        @php
            Session::forget('success-resi');
        @endphp
    @endif
            
    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel"> 
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="container">
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label class="">ID Resi</label>
                                <br>
                                <div class="form-check-inline col-md-5">
                                    <input oninput="let p = this.selectionStart; this.value = this.value.toUpperCase();
                                    this.setSelectionRange(p, p);" style="text-transform:uppercase" name="resi_id"
                                    placeholder="ID Resi" type="text" class="form-control" required" id="resi_id">
                                </div>
                                <div class="form-check-inline">
                                    <button type="button" class="btn mb-2 btn-primary" onclick="trackResi('cari')">
                                        &nbsp Cari &nbsp
                                    </button>
                                </div>
                                <div class="form-check-inline">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong" id="scanResi" onclick="triggerScanner()">
                                        &nbsp Scan &nbsp
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
    <div id="trackingField"></div>
</div>
@endsection

{{-- Scanner Video --}}
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Scan Resi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <video id="preview" style="width: 200px; height: 200px; border: 1px solid black;"></video>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeScanner()" id="close">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- Notification --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Error</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-0" id="modalContent"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    $(document).ready(function () {
        $("#upperlist-track-resi").addClass("mm-active");
        $("#btn-track-resi").attr("aria-expanded", "true");
        $("#list-resi").attr("class", "mm-collapse mm-show");
        $("#header-track-resi").attr("class", "mm-active");
        
        if ('{{Session::has("success-failresi")}}'){
            triggerNotification('{{Session::get("success-failresi")}}');
            @php
                Session::forget('success-failresi');
            @endphp
        } 

        scanner.addListener('scan', function(content) {
            $("#close").click();
            trackResi(content);
        });
       
    })

    let scanner = new Instascan.Scanner(
    {
        video: document.getElementById('preview')
    });

    function triggerScanner(){
        Instascan.Camera.getCameras().then(cameras => 
        {
            if(cameras.length > 0){
                scanner.start(cameras[0]);
            } else {
                console.error("Please enable Camera!");
            }
        });
    }
    
    function closeScanner(){
        Instascan.Camera.getCameras().then(cameras => 
        {
            if(cameras.length > 0){
                scanner.stop(cameras[0]);
            } else {
                console.error("Error Stop Camera");
            }
        });
    }

    function triggerNotification(text){
        $("#modalContent").html(text);
        $("#triggerModal").click();
    }

    function trackResi(id){
        if(id == 'cari') var id = $("#resi_id").val();
        $.ajax({
            method : "POST",
            url : "/admin/resi/isiSejarah",
            datatype : "json",
            data : { id: id, _token : "{{ csrf_token() }}" },
            success: function(result){
                if(id == ""){
                    triggerNotification("Mohon input id resi yang valid.");
                }else if(result == "null"){
                    triggerNotification("Resi tidak terdaftar");
                }else{
                    $("#trackingField").html(result);
                }
            },
            error: function(){
                console.log('error');
            }
        });
    }

</script>
@endsection
