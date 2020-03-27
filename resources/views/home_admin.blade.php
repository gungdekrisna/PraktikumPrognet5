@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard Admin</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in as Admin!
                    <br><img src="{{ URL::to('/') }}/images/{{ Auth::user()->profile_image }}" width="120" height="auto">
                </div>
                <div class="card-body">
                    <a href="{{ url("register/admin") }}" class="btn btn-success">Create Admin</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
