@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@if(Auth::user()->username == 'munoznd' || Auth::user()->username == 'guerrsm' || Auth::user()->username == 'PEREM26' || is_numeric(Auth::user()->username))
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <img src="{{ url('pago-a-talleres/show-calendar/') }}" alt="" />
        </div>
    </div>
</div>
@endif
@endsection
