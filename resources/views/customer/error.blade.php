@extends('layouts.customer')

@section('content')
<div class="site-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (Session::has('error'))
                    <ul class="list-group mb-2">
                        <li class="list-group-item-danger list-group-item">{{Session::get('error')}}</li>
                    </ul>
                    @php
                        Session::forget('error');
                    @endphp
                @endif
            </div>
            
        </div>
    </div>
</div>
@endsection