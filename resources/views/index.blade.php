@extends('layouts.app')

@push('body-class')
main-front
@endpush

@section('content')
    <div class="jumbotron">
        <div class="container">
            <div class="text-center">
                <h1>Hello Pilot!</h1>
                <p>Welcome to the next generation aircraft reservation system.</p>
                <p><a class="btn btn-primary btn-lg" href="{{ route('register') }}" role="button">Join today</a></p>
            </div>
        </div>
    </div>
@endsection
